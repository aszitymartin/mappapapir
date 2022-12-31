<?php require_once($_SERVER['DOCUMENT_ROOT'].'/includes/inc.php');

$jsonUserData = json_decode($_POST['user'], true);
$jsonItemsData = json_decode($_POST['items'], true);
$jsonVoucherData = json_decode($_POST['voucher'], true);

$jsonInventoryCheck = isset($_POST['inventory']) ? json_decode($_POST['inventory'], true) : null;

// die(print_r($jsonInventoryCheck));

// die(print_r($jsonUserData['general']));

// die('SUID : ' . $_SESSION['id'] . ' PUID : ' . $jsonUserData['general']['uid']);

/*
    [*] session ellenorzese
    [*] felhasznalo ellenorzese
    [*] kartyak ellenorzese
    [*] kartya ervenyessege
    [*] egyenleg ellenorzese
        [X] fedezethiany eseten tobbi kartya ajanlasa ha van
    
    [] keszlet ellenorzese (ratkaron levo termekek szama, backorder engedelyezve van-e)
        [] ha a termek nincsen keszleten, hasonlo termekek ajanlasa helyette
    
*/
function dieProcess ($msg) { die($msg); }
function cancelProcess ($msg) {
    die('cancelled : ' . $msg);
}
if (isset($_SESSION['id'])) {
    if ($checkUserSQL = $con->prepare('SELECT id FROM customers WHERE id = ?')) {
        $checkUserSQL->bind_param('i', $jsonUserData['general']['uid']); $checkUserSQL->execute(); $checkUserSQL->store_result(); $checkUserSQL->bind_result($checkedUID); $checkUserSQL->fetch();
        if ($_SESSION['id'] == $checkedUID) {
            if ($checkUserPaymentSQL = $con->prepare('SELECT cid FROM customers__card WHERE uid = ? AND cid LIKE ?')) {
                $checkUserPaymentSQL->bind_param('is', $jsonUserData['general']['uid'], $jsonUserData['payment']['paymentMethod']); $checkUserPaymentSQL->execute(); $checkUserPaymentSQL->store_result(); $checkUserPaymentSQL->bind_result($userPaymentCardId); $checkUserPaymentSQL->fetch();
                if ($checkUserPaymentSQL->num_rows > 0) {
                    if ($checkUserCardExpirySQL = $con->prepare('SELECT expiry FROM customers__card WHERE uid = ? AND cid LIKE ?')) {
                        $checkUserCardExpirySQL->bind_param('is', $jsonUserData['general']['uid'], $jsonUserData['payment']['paymentMethod']); $checkUserCardExpirySQL->execute(); $checkUserCardExpirySQL->store_result(); $checkUserCardExpirySQL->bind_result($userCardExpiryDate); $checkUserCardExpirySQL->fetch();
                        if (date("Y-m-d" ,strtotime($userCardExpiryDate)) > date('Y-m-d')) {
                            if ($checkUserCardBalanceSQL = $con->prepare('SELECT value FROM customers__card WHERE uid = ? AND cid LIKE ?')) {
                                $checkUserCardBalanceSQL->bind_param('is', $jsonUserData['general']['uid'], $jsonUserData['payment']['paymentMethod']); $checkUserCardBalanceSQL->execute(); $checkUserCardBalanceSQL->store_result(); $checkUserCardBalanceSQL->bind_result($userCardBalance); $checkUserCardBalanceSQL->fetch();
                                // termekek aranak kiszamolasa, osszehasonlitas az egyenleggel
                                $itemKeys = array_keys((array)$jsonItemsData); $itemsArray = array();
                                for ($i = 0; $i < count($itemKeys); $i++) { $itemKeyId = explode('_', $itemKeys[$i])[1]; array_push($itemsArray, $jsonItemsData['item_'.$itemKeyId]['general']); } 
                                $grossTotal = 1000;
                                for ($i = 0; $i < count($itemsArray); $i++) {
                                    if ($getDynamicItemPrice = $con->prepare('SELECT base, discount FROM products__pricing WHERE pid = ?')) {
                                        $getDynamicItemPrice->bind_param('i', $itemsArray[$i]['id']); $getDynamicItemPrice->execute(); $getDynamicItemPrice->store_result(); $getDynamicItemPrice->bind_result($dynamicItemPrice, $dynamicItemDiscount); $getDynamicItemPrice->fetch();
                                        $grossTotal += (($dynamicItemPrice - (($dynamicItemPrice * $dynamicItemDiscount) / 100)) * $itemsArray[$i]['quantity']);
                                    }
                                } $grossTotal <= 30000 ? $grossTotal += 2000 : $grossTotal;
                                if ($userCardBalance >= round($grossTotal)) {
                                    // keszlet megtekintese
                                    $warehouseItemsArray = array(); $unavailableItemsArray = array(); $backorderItemsArray = array();
                                    if (is_null($jsonInventoryCheck)) {
                                        for ($i = 0; $i < count($itemsArray); $i++) {
                                            if ($checkAvailableItemsSQL = $con->prepare('SELECT name, quantity, q__warehouse, backorder FROM products__inventory INNER JOIN products ON products.id = products__inventory.pid WHERE pid = ?')) {
                                                $checkAvailableItemsSQL->bind_param('i', $itemsArray[$i]['id']); $checkAvailableItemsSQL->execute(); $checkAvailableItemsSQL->store_result(); $checkAvailableItemsSQL->bind_result($itemName, $itemQuantity, $itemQuantityWarehouse, $itemQuantityBackorder); $checkAvailableItemsSQL->fetch();
                                                if ($itemQuantityBackorder == 0) {
                                                    if ($itemQuantity < $itemsArray[$i]['quantity'] && $itemQuantityWarehouse < $itemsArray[$i]['quantity']) {
                                                        array_push($unavailableItemsArray,
                                                            [
                                                                "pid" => $itemsArray[$i]['id'],
                                                                "name" => $itemName,
                                                                "orderedQuantity" => $itemsArray[$i]['quantity'],
                                                                "inventoryQuantity" => $itemQuantity,
                                                                "warehouseQuantity" => $itemQuantityWarehouse
                                                            ]
                                                        );
                                                    }
                                                    if ($itemQuantity < $itemsArray[$i]['quantity'] && $itemQuantityWarehouse > $itemsArray[$i]['quantity']) {
                                                        array_push($warehouseItemsArray, 
                                                            [
                                                                "pid" => $itemsArray[$i]['id'],
                                                                "name" => $itemName,
                                                                "orderedQuantity" => $itemsArray[$i]['quantity'],
                                                                "inventoryQuantity" => $itemQuantity,
                                                                "warehouseQuantity" => $itemQuantityWarehouse
                                                            ]
                                                        );
                                                    }
                                                } else {
                                                    if (
                                                        ($itemQuantity < $itemsArray[$i]['quantity'] && $itemQuantityWarehouse < $itemsArray[$i]['quantity'])
                                                        ||
                                                        ($itemQuantity < $itemsArray[$i]['quantity'] && $itemQuantityWarehouse > $itemsArray[$i]['quantity'])
                                                    ) {
                                                        array_push($backorderItemsArray,
                                                            [
                                                                "pid" => $itemsArray[$i]['id'],
                                                                "name" => $itemName,
                                                                "orderedQuantity" => $itemsArray[$i]['quantity'],
                                                                "inventoryQuantity" => $itemQuantity,
                                                                "warehouseQuantity" => $itemQuantityWarehouse
                                                            ]
                                                        );
                                                    }
                                                }
                                            } else { dieProcess('A folyamat elvégzését nem sikerült végrehajtani.'); }
                                        }
                                    }
                                    if (count($warehouseItemsArray) === 0 && count($unavailableItemsArray) === 0 && count($backorderItemsArray) === 0) {
                                        
                                        /*
                                            Feldolgozas folytatasa:
                                                Keszlet frissitese:
                                                    -> Megnezni hogy van-e keszleten termek
                                                        -> Van keszleten:
                                                            -> Keszlet frissitese
                                                        -> Nincs keszleten:
                                                            -> Raktar keszlet ellenorzese:
                                                                -> Van raktaton:
                                                                    -> Raktrar frissitese:
                                                                        -> Szallitasi ido: +3 nap
                                                                -> Nincs raktaton:
                                                                    -> Elerheto-e a termek
                                                                    -> Backorder elerheto-e a termeknel:
                                                                        -> Elerheto backorder:
                                                                            -> Uj rendeles letrehozasa a backorderes termekeknel
                                                                                -> Rendeles befagyasztasa, amig nincs keszleten/raktaron a termek
                                                Egyenleg frissitese
                                        */

                                        /*
                                            Adatbazis EK diagramm:

                                            orders [
                                                id - int -> PRIMARY KEY
                                                uid - int
                                                pid - varchar 
                                                    -> Termekek listaja ';'-vel elvalasztva tobb termek eseten
                                                    -> Backorderes termekek nem ide kerulnek
                                                status - int
                                                    -> 0: Osszekeszites alatt
                                                    -> 1: Kiszallitas alatt
                                                    -> 2: Kiszallitva
                                                    -> 3: Befagyasztott / temp rendeles
                                                    -> 4: Sikertelen kiszallitas
                                                date - timestamp
                                            ]
                                            orders__user [
                                                id - int -> PRIMARY KEY
                                                oid - int -> orders.id
                                                fullname - varchar
                                                company - varchar
                                                email - varchar
                                                phone - varchar
                                            ]
                                            orders__ship [
                                                id - int -> PRIMARY KEY
                                                oid - int -> orders.id
                                                method -> varchar // Szallitasi mod (gls,fedex,dhl)
                                                zip - int
                                                settlement - varchar
                                                address - varchar
                                                note - varchar
                                            ]
                                            orders__invoice [
                                                id - int -> PRIMARY KEY
                                                oid - int -> orders.id
                                                zip - int
                                                settlement - varchar
                                                address - varchar
                                                tax - int
                                            ]
                                            orders__payment [
                                                id - int -> PRIMARY KEY
                                                oid - int -> orders.id
                                                cid - varchar -> customers__card.cid
                                                voucherUsed - tinyint
                                                    -> 0: Nem hasznalt
                                                    -> 1: Hasznalt
                                                voucherCode - varchar
                                                voucherDiscount - int
                                            ]
                                        */

                                        if (!is_null($jsonInventoryCheck)) {
                                            die('check inventory..');
                                        } else {
                                            die('continue order');
                                        }

                                    } else { $inventoryExitObject = new stdClass();
                                        $inventoryExitObject->data = 
                                            count($warehouseItemsArray) > 0 ? $warehouseItemsArray : 
                                            (count($unavailableItemsArray) > 0 ? $unavailableItemsArray : 
                                            $backorderItemsArray)
                                        ; $inventoryExitObject->status = "error"; $inventoryExitObject->category = "inventory";
                                        $inventoryExitObject->alt = 
                                            count($warehouseItemsArray) > 0 ? 'warehouse' : 
                                            (count($unavailableItemsArray) > 0 ? 'unavailable' : 'backorder')
                                        ; die(json_encode($inventoryExitObject));
                                    } 
                                } else {
                                    // tobbi kartya ajanlasa
                                    $cardExitObject = new stdClass();
                                    $cardExitObject->status = "error"; $cardExitObject->category = "payment";
                                    $cardExitObject->alt = "notEnoughMoney";
                                    dieProcess($cardExitObject); 
                                }
                                // die(round($userCardBalance) . ' Card Balance');
                                // die(round($grossTotal) . ' Gross Total');
                                // die(print_r($itemsArray));
                                // die(print_r($jsonItemsData));
                            } else { dieProcess('A folyamat elvégzését nem sikerült végrehajtani.'); }
                        } else { dieProcess('A kártájának lejárt az érvényessége, ezért már nem használható tovább fizetéseknél.'); }
                    } else { dieProcess('A folyamat elvégzését nem sikerült végrehajtani.'); }
                } else { dieProcess('Az a kártya, amellyel fizetni szeretett volna, nem létezik a fiókján.'); }
            } else { dieProcess('A folyamat elvégzését nem sikerült végrehajtani.'); }
        } else { dieProcess('Érvénytelen felhasználói azonosítót használt.'); }
    } else { dieProcess('A folyamat elvégzését nem sikerült végrehajtani.'); }
} else { dieProcess('Érvénytelen felhasználói azonosítót használt.'); }

?>