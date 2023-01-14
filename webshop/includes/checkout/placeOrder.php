<?php require_once($_SERVER['DOCUMENT_ROOT'].'/includes/inc.php');

ini_set('display_errors', 1); ini_set('display_startup_errors', 1); error_reporting(E_ALL);

$jsonUserData = json_decode($_POST['user'], true);
$jsonItemsData = json_decode($_POST['items'], true);
$jsonVoucherData = json_decode($_POST['voucher'], true);
$jsonLogData = json_decode($_POST['log'], true);

$jsonInventoryCheck = isset($_POST['inventory']) ? (count((array)json_decode($_POST['inventory'])) > 1 ? json_decode($_POST['inventory'], true) : null) : null;

// die(print_r($jsonUserData['general']));

/*
    [*] session ellenorzese
    [*] felhasznalo ellenorzese
    [*] kartyak ellenorzese
    [*] kartya ervenyessege
    [*] egyenleg ellenorzese
        [X] fedezethiany eseten tobbi kartya ajanlasa ha van
    
    [*] keszlet ellenorzese (ratkaron levo termekek szama, backorder engedelyezve van-e)
        [] ha a termek nincsen keszleten, hasonlo termekek ajanlasa helyette
    
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
        subtotal - int
    ]
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

                                        if (!is_null($jsonInventoryCheck)) {
                                            // Rendeles folytatasa a kivalasztott opciokkal pl. rendeles csak raktarbol, keszletbol es raktarbol vagy adott termek visszavonasa
                                            $inventoryKeys = array_keys((array)$jsonInventoryCheck); $inventoryItems = array(); 
                                            $inventoryOptions = array(); $orderedItemsArray = array(); $inventoryErrorData = array();
                                            for ($i = 0; $i < count($inventoryKeys); $i++) {
                                                $inventoryItemId = explode('_', $inventoryKeys[$i])[1];
                                                array_push($inventoryItems, $jsonInventoryCheck['item_'.$inventoryItemId]);
                                            }
                                            for ($i = 0; $i < count($inventoryItems); $i++) {
                                                $options = new stdClass(); $options->id = explode('-', $inventoryItems[$i])[1]; $options->option = explode('-', $inventoryItems[$i])[0];
                                                array_push($inventoryOptions, $options);
                                            }
                                            for ($i = 0; $i < count($inventoryOptions); $i++) {
                                                // Megrendeles folytatasa a megadott opciokkal
                                                // Funkcio meghivasa a rendeles tobbi reszehez -> penz levonasa stb, majd a megadott opciokkal befejezni a rendelest
                                                switch ($inventoryOptions[$i]->option) {
                                                    case 'skipOrderItem': unset($jsonItemsData['item_'.$inventoryOptions[$i]->id]); break;
                                                    case 'orderMinimumInventoryAvailable':
                                                        // csak az elerheto darab megrendelese a keszletbol
                                                        $orderedQuantity = $jsonItemsData['item_'.$inventoryOptions[$i]->id]['general']['quantity'];
                                                        $getAvailableInventoryQuantitySQL = "SELECT quantity FROM products__inventory WHERE pid = ". $jsonItemsData['item_'.$inventoryOptions[$i]->id]['general']['id'];
                                                        $getAvailableInventoryQuantityRes = $con->query($getAvailableInventoryQuantitySQL); $getAvailableInventoryQuantityData = $getAvailableInventoryQuantityRes->fetch_assoc();
                                                        $inventoryAvailableQuantity = $getAvailableInventoryQuantityData['quantity'];
                                                        if ($inventoryAvailableQuantity - $orderedQuantity < 0) { $orderQuantity = $inventoryAvailableQuantity; } else { $orderQuantity = $orderedQuantity; }
                                                        if ($orderOnlyAvailableItemsFromInventorySQL = $con->prepare('UPDATE products__inventory SET quantity = (quantity - ?) WHERE pid = ?')) {
                                                            $orderOnlyAvailableItemsFromInventorySQL->bind_param('ii', $orderQuantity, $jsonItemsData['item_'.$inventoryOptions[$i]->id]['general']['id']); $orderOnlyAvailableItemsFromInventorySQL->execute();
                                                            $jsonItemsData['item_'.$inventoryOptions[$i]->id]['general']['quantity'] = $orderQuantity;
                                                            $jsonItemsData['item_'.$inventoryOptions[$i]->id]['general']['option'] = "orderMinimumInventoryAvailable";
                                                            $jsonItemsData['item_'.$inventoryOptions[$i]->id]['general']['extras'] = $orderQuantity . "db, " . $orderedQuantity . " helyett.";
                                                        } else { 
                                                            array_push($inventoryErrorData, 
                                                                [
                                                                    "pid" => $jsonItemsData['item_'.$inventoryOptions[$i]->id]['general']['id'],
                                                                    "quantity" => $orderQuantity,
                                                                    "alt" => "Hiba történt a folyamat közben."
                                                                ]
                                                            ); 
                                                        }
                                                    break;
                                                    case 'orderMinimumInventoryAndOrderRestWarehouse':
                                                        // csak az elerheto termek megrendelese keszletbol, a tobbit a raktarbol
                                                        $orderedQuantity = $jsonItemsData['item_'.$inventoryOptions[$i]->id]['general']['quantity'];
                                                        $getAvailableInventoryQuantitySQL = "SELECT quantity, q__warehouse, backorder FROM products__inventory WHERE pid = ". $jsonItemsData['item_'.$inventoryOptions[$i]->id]['general']['id'];
                                                        $getAvailableInventoryQuantityRes = $con->query($getAvailableInventoryQuantitySQL); $getAvailableInventoryQuantityData = $getAvailableInventoryQuantityRes->fetch_assoc();
                                                        $inventoryAvailableQuantity = $getAvailableInventoryQuantityData['quantity']; $warehouseAvailableQuantity = $getAvailableInventoryQuantityData['q__warehouse']; $itemBackorderStatus = $getAvailableInventoryQuantityData['backorder'];
                                                        if ($inventoryAvailableQuantity - $orderedQuantity < 0) { $orderQuantity = $inventoryAvailableQuantity; } else { $orderQuantity = $orderedQuantity; }
                                                        // check if warehouse has enough products && if not check if backorder available
                                                        if ($warehouseAvailableQuantity - ($jsonItemsData['item_'.$inventoryOptions[$i]->id]['general']['quantity'] - $orderQuantity) >= 0) {
                                                            if ($orderAvailableItemsInventoryRestWarehouseSQL = $con->prepare('UPDATE products__inventory SET quantity = (quantity - ?), q__warehouse = (q__warehouse - ?) WHERE pid = ?')) {
                                                                $orderWarehouseQuantity = $jsonItemsData['item_'.$inventoryOptions[$i]->id]['general']['quantity'] - $orderQuantity;
                                                                $orderAvailableItemsInventoryRestWarehouseSQL->bind_param('iii', $orderQuantity, $orderWarehouseQuantity, $jsonItemsData['item_'.$inventoryOptions[$i]->id]['general']['id']); $orderAvailableItemsInventoryRestWarehouseSQL->execute();
                                                                $jsonItemsData['item_'.$inventoryOptions[$i]->id]['general']['quantity'] = $orderQuantity;
                                                                $jsonItemsData['item_'.$inventoryOptions[$i]->id]['general']['option'] = "orderMinimumInventoryAndOrderRestWarehouse";
                                                                $jsonItemsData['item_'.$inventoryOptions[$i]->id]['general']['extras'] = $orderQuantity . " termék készletből, " . $orderWarehouseQuantity . " raktárból.";
                                                                $jsonItemsData['item_'.$inventoryOptions[$i]->id]['general']['shipping'] = " +3 nap szállítási idő";
                                                            } else { 
                                                                array_push($inventoryErrorData, 
                                                                    [
                                                                        "pid" => $jsonItemsData['item_'.$inventoryOptions[$i]->id]['general']['id'],
                                                                        "quantity" => $orderQuantity,
                                                                        "alt" => "Hiba történt a folyamat közben."
                                                                    ]
                                                                ); 
                                                            }
                                                        } elseif ($itemBackorderStatus == 1) {
                                                            //backorder TRUE
                                                        } else {
                                                            array_push($inventoryErrorData, 
                                                                [
                                                                    "pid" => $jsonItemsData['item_'.$inventoryOptions[$i]->id]['general']['id'],
                                                                    "quantity" => $orderQuantity,
                                                                    "alt" => "Nincs elegendő termék a raktáron, és az Utólagos Rendelés opció nem elérhető ennél a terméknél."
                                                                ]
                                                            ); 
                                                        }
                                                    break;
                                                    case 'orderCurrentOrderedQuantityWarehouse':
                                                        // az mennyiseg megrendelese a raktrarbol
                                                        $orderedQuantity = $jsonItemsData['item_'.$inventoryOptions[$i]->id]['general']['quantity'];
                                                        $getAvailableWarehouseQuantitySQL = "SELECT q__warehouse FROM products__inventory WHERE pid = ". $jsonItemsData['item_'.$inventoryOptions[$i]->id]['general']['id'];
                                                        $getAvailableWarehouseQuantityRes = $con->query($getAvailableWarehouseQuantitySQL); $getAvailableWarehouseQuantityData = $getAvailableWarehouseQuantityRes->fetch_assoc();
                                                        $warehouseAvailableQuantity = $getAvailableWarehouseQuantityData['q__warehouse'];
                                                        if ($warehouseAvailableQuantity - $orderedQuantity < 0) { $orderQuantity = $warehouseAvailableQuantity; } else { $orderQuantity = $orderedQuantity; }
                                                        if ($orderOnlyAvailableItemsFromInventorySQL = $con->prepare('UPDATE products__inventory SET q__warehouse = (q__warehouse - ?) WHERE pid = ?')) {
                                                            $orderOnlyAvailableItemsFromInventorySQL->bind_param('ii', $orderQuantity, $jsonItemsData['item_'.$inventoryOptions[$i]->id]['general']['id']); $orderOnlyAvailableItemsFromInventorySQL->execute();
                                                            $jsonItemsData['item_'.$inventoryOptions[$i]->id]['general']['quantity'] = $orderQuantity;
                                                            $jsonItemsData['item_'.$inventoryOptions[$i]->id]['general']['option'] = "orderCurrentOrderedQuantityWarehouse";
                                                            $jsonItemsData['item_'.$inventoryOptions[$i]->id]['general']['extras'] = $orderQuantity . " termék raktárból.";
                                                            $jsonItemsData['item_'.$inventoryOptions[$i]->id]['general']['shipping'] = " +3 nap szállítási idő";
                                                        } else { 
                                                            array_push($inventoryErrorData, 
                                                                [
                                                                    "pid" => $jsonItemsData['item_'.$inventoryOptions[$i]->id]['general']['id'],
                                                                    "quantity" => $orderQuantity,
                                                                    "alt" => "Hiba történt a folyamat közben."
                                                                ]
                                                            ); 
                                                        }

                                                    break;
                                                    default: die('Érvénytelen opciót választott.'); break;
                                                }
                                            }
                                            // $jsonItemsData -> Ide vannak mentve a megrendelt termekek, az atirt mennyisegek es az option tag is a logolashoz
                                            /*
                                                [X] A valasztott opciok alapjan ujraszamolni az egyenleget
                                                [] Felhasznalo egyenlegenek frissitese
                                                [] Rendelesi adatok elmentese adatbazisba
                                                [] Naplozas vegrehajtasa
                                            */

                                            $changedSubtotal = 1000; $changedItemsArray = array();
                                            $changedItemKeys = array_keys((array)$jsonItemsData);
                                            for ($i = 0; $i < count($changedItemKeys); $i++) { $itemKeyId = explode('_', $changedItemKeys[$i])[1]; array_push($changedItemsArray, $jsonItemsData['item_'.$itemKeyId]['general']); } 
                                            for ($i = 0; $i < count($changedItemsArray); $i++) {
                                                if ($getDynamicItemPrice = $con->prepare('SELECT base, discount FROM products__pricing WHERE pid = ?')) {
                                                    $getDynamicItemPrice->bind_param('i', $changedItemsArray[$i]['id']); $getDynamicItemPrice->execute(); $getDynamicItemPrice->store_result(); $getDynamicItemPrice->bind_result($dynamicItemPrice, $dynamicItemDiscount); $getDynamicItemPrice->fetch();
                                                    $changedSubtotal += (($dynamicItemPrice - (($dynamicItemPrice * $dynamicItemDiscount) / 100)) * $changedItemsArray[$i]['quantity']);
                                                }
                                            } $changedSubtotal <= 30000 ? $changedSubtotal += 2000 : $changedSubtotal;
                                            
                                            $inventoryContinueOrderExit = new stdClass();
                                            $inventoryContinueOrderExit->data = $jsonItemsData;
                                            $inventoryContinueOrderExit->alt = "inventoryChecked";
                                            die(json_encode($inventoryContinueOrderExit));
                                            
                                            die(print_r($jsonItemsData));
                                            die($changedSubtotal . ' cst');
                                            die(print_r($jsonItemsData));

                                            
                                            die('continue order after inventory check..');
                                        } else {
                                            /*
                                                Felhasznalo egyenlegenek frissitese
                                                Rendelesi adatok elmentese adatbazisba
                                                Naplozas vegrehajtasa
                                            */
                                            die('continue order without inventory check');
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