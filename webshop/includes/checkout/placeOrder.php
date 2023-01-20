<?php require_once($_SERVER['DOCUMENT_ROOT'].'/includes/inc.php');

$jsonUserData = json_decode($_POST['user'], true);
$jsonItemsData = json_decode($_POST['items'], true);
$jsonVoucherData = json_decode($_POST['voucher'], true);
$jsonLogData = json_decode($_POST['log'], true);
$jsonInventoryCheck = isset($_POST['inventory']) ? (count((array)json_decode($_POST['inventory'])) > 1 ? json_decode($_POST['inventory'], true) : null) : null;

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

function proceedOrder ($e) {
    $dieArguments = new stdClass();
    if (count($e->errors) < 1) {
        $finalSubTotal = $e->voucher['voucherUsed'] == 1 ? round(($e->subTotal - (($e->subTotal * $e->voucher['voucherPercentage']) / 100))) : round($e->subTotal); $orderStatus = 0;
        $DATABASE_HOST = 'localhost';$DATABASE_USER = 'root';$DATABASE_PASS = 'eKi=0630OG';$DATABASE_NAME = 'mappapapir'; $con = mysqli_connect($DATABASE_HOST, $DATABASE_USER, $DATABASE_PASS, $DATABASE_NAME);
        $orderedItemsImplode = ""; for ($i = 0; $i < count($e->items); $i++) { $orderedItemsImplode .= $e->items[$i]['id'] . ':' . $e->items[$i]['quantity'] . ';'; }
        if ($updateUserBalance = $con->prepare('UPDATE customers__card SET value = (value - ?) WHERE uid = ? AND cid LIKE ?')) {
            $updateUserBalance->bind_param('iis', $finalSubTotal, $e->user['general']['uid'], $e->user['payment']['paymentMethod']); $updateUserBalance->execute();
            if (
                $saveOrders = $con->prepare('INSERT INTO orders (uid, items, status) VALUES (?, ?, ?)') &&
                $saveOrdersUser = $con->prepare('INSERT INTO orders__user (oid, fullname, company, email, phone) VALUES (?, ?, ?, ?, ?)') &&
                $saveOrdersShip = $con->prepare('INSERT INTO orders__ship (oid, method, zip, settlement, address, note) VALUES (?, ?, ?, ?, ?, ?)') &&
                $saveOrdersInvoice = $con->prepare('INSERT INTO orders__invoice (oid, zip, settlement, address, tax) VALUES (?, ?, ?, ?, ?)') &&
                $saveOrdersPayment = $con->prepare('INSERT INTO orders__payment (oid, cid, voucherUsed, voucherCode, voucherDiscount, subTotal) VALUES (?, ?, ?, ?, ?, ?)')
            ) { 
                $saveOrders = $con->prepare('INSERT INTO orders (uid, items, status) VALUES (?, ?, ?)');
                $saveOrdersUser = $con->prepare('INSERT INTO orders__user (oid, fullname, company, email, phone) VALUES (?, ?, ?, ?, ?)');
                $saveOrdersShip = $con->prepare('INSERT INTO orders__ship (oid, method, zip, settlement, address, note) VALUES (?, ?, ?, ?, ?, ?)');
                $saveOrdersInvoice = $con->prepare('INSERT INTO orders__invoice (oid, zip, settlement, address, tax) VALUES (?, ?, ?, ?, ?)');
                $saveOrdersPayment = $con->prepare('INSERT INTO orders__payment (oid, cid, voucherUsed, voucherCode, voucherDiscount, subTotal) VALUES (?, ?, ?, ?, ?, ?)');

                $saveOrders->bind_param('isi', $e->user['general']['uid'], $orderedItemsImplode, $orderStatus); $saveOrders->execute(); $lastId = $con->insert_id;
                $saveOrdersUser->bind_param('issss', $lastId, $e->user['general']['fullname'], $e->user['general']['company'], $e->user['general']['email'], $e->user['general']['phone']);
                $saveOrdersShip->bind_param('isisss', $lastId, $e->user['shipping']['shpMethod'], $e->user['shipping']['zip'], $e->user['shipping']['settlement'], $e->user['shipping']['address'], $e->user['shipping']['note']);
                $saveOrdersInvoice->bind_param('iissi', $lastId, $e->user['invoice']['zip'], $e->user['invoice']['settlement'], $e->user['invoice']['address'], $e->user['invoice']['tax']);
                $saveOrdersPayment->bind_param('isisii', $lastId, $e->user['payment']['paymentMethod'], $e->voucher['voucherUsed'], $e->voucher['voucherCode'], $e->voucher['voucherPercentage'], $finalSubTotal);
                $saveOrdersUser->execute(); $saveOrdersShip->execute(); $saveOrdersInvoice->execute(); $saveOrdersPayment->execute();

                $log_categ = "Rendelés"; $log_desc = "A következő termék(ek) sikeresen meg lettek rendelve: " . $orderedItemsImplode;
                $orderLog = $con->prepare("INSERT INTO log (uid, ip, category, description) VALUES (?, ?, ?, ?)"); $orderLog->bind_param('isss', $e->user['general']['uid'], $e->log['ip'], $log_categ, $log_desc); $orderLog->execute(); $orderLog->free_result(); $orderLog->close();
                $getOrderCreationSQL = "SELECT date FROM orders WHERE id = ". $lastId; $getOrderCreationRes = $con->query($getOrderCreationSQL); $getOrderCreationData = $getOrderCreationRes->fetch_assoc(); $getOrderCreationValue = $getOrderCreationData['date'];
                $dieArguments->alt = "success"; $dieArguments->data = [
                    "oid" => $lastId, "status" => "0",
                    "items" => $orderedItemsImplode, "fullname" => $e->user['general']['fullname'],
                    "email" => $e->user['general']['email'], "zip" => $e->user['invoice']['zip'],
                    "settlement" => $e->user['invoice']['settlement'], "address" => $e->user['invoice']['address'],
                    "payment" => $e->user['payment']['paymentMethod'], "subtotal" => round($finalSubTotal),
                    "voucher" => $e->voucher['voucherPercentage'], "created" => $getOrderCreationValue
                ];
                if ($e->user['extras']['method'] == 'basket') {
                    for ($i = 0; $i < count($e->items); $i++) {
                        if($getCartDetails = $con->prepare('SELECT quantity FROM cart WHERE pid = ? AND uid = ?')) {
                            $getCartDetails->bind_param('ii', $e->items[$i]['id'], $e->user['general']['uid']); $getCartDetails->execute(); $getCartDetails->store_result();
                            if ($getCartDetails->num_rows > 0) { $getCartDetails->bind_result($getCartItemQuantity); $getCartDetails->fetch(); $getCartDetails->free_result(); $getCartDetails->close(); $con->next_result();
                                if (($getCartItemQuantity - $e->items[$i]['quantity']) > 0) {
                                    $updateCartItemDetails = $con->prepare('UPDATE cart SET quantity = (quantity - ?) WHERE pid = ? AND uid = ?');
                                    $updateCartItemDetails->bind_param('iii', $e->items[$i]['quantity'], $e->items[$i]['id'], $e->user['general']['uid']); $updateCartItemDetails->execute(); $updateCartItemDetails->store_result(); $updateCartItemDetails->free_result(); $updateCartItemDetails->close(); $con->next_result();
                                } else {
                                    $deleteCartItemDetails = $con->prepare('DELETE FROM cart WHERE pid = ? AND uid = ?');
                                    $deleteCartItemDetails->bind_param('ii', $e->items[$i]['id'], $e->user['general']['uid']); $deleteCartItemDetails->execute(); $deleteCartItemDetails->store_result(); $deleteCartItemDetails->free_result(); $deleteCartItemDetails->close(); $con->next_result();
                                }
                            }
                        }
                    }
                } die(json_encode($dieArguments));
            } else { $dieArguments->alt = "orderError"; $dieArguments->type = "saveOrder"; }
        } else { $dieArguments->alt = "orderError"; $dieArguments->type = "payment"; }
    } else { $dieArguments->data = $e->errors; $dieArguments->alt = "orderError"; $dieArguments->type = "items"; die(json_encode($dieArguments)); }
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
                                        if (!is_null($jsonInventoryCheck)) {
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
                                                switch ($inventoryOptions[$i]->option) {
                                                    case 'skipOrderItem': unset($jsonItemsData['item_'.$inventoryOptions[$i]->id]); break;
                                                    case 'orderMinimumInventoryAvailable':
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
                                            $changedSubtotal = 1000; $changedItemsArray = array(); $changedItemKeys = array_keys((array)$jsonItemsData);
                                            for ($i = 0; $i < count($changedItemKeys); $i++) { $itemKeyId = explode('_', $changedItemKeys[$i])[1]; array_push($changedItemsArray, $jsonItemsData['item_'.$itemKeyId]['general']); } 
                                            for ($i = 0; $i < count($changedItemsArray); $i++) {
                                                if ($updateInventoryOthers = $con->prepare('UPDATE products__inventory SET quantity = (quantity - ?) WHERE pid = ?')) {
                                                    $updateInventoryOthers->bind_param('ii', $changedItemsArray[$i]['quantity'], $changedItemsArray[$i]['id']); $updateInventoryOthers->execute();
                                                } else {
                                                    array_push($inventoryErrorData, 
                                                        [
                                                            "pid" => $changedItemsArray[$i]['id'],
                                                            "quantity" => $changedItemsArray[$i]['quantity'],
                                                            "alt" => "Hiba történt a folyamat közben."
                                                        ]
                                                    );
                                                }

                                                if ($getDynamicItemPrice = $con->prepare('SELECT base, discount FROM products__pricing WHERE pid = ?')) {
                                                    $getDynamicItemPrice->bind_param('i', $changedItemsArray[$i]['id']); $getDynamicItemPrice->execute(); $getDynamicItemPrice->store_result(); $getDynamicItemPrice->bind_result($dynamicItemPrice, $dynamicItemDiscount); $getDynamicItemPrice->fetch();
                                                    $changedSubtotal += (($dynamicItemPrice - (($dynamicItemPrice * $dynamicItemDiscount) / 100)) * $changedItemsArray[$i]['quantity']);
                                                }
                                            } $changedSubtotal <= 30000 ? $changedSubtotal += 2000 : $changedSubtotal;
                                            $proceedOrderArguments = new stdClass(); $proceedOrderArguments->items = $changedItemsArray; $proceedOrderArguments->user = $jsonUserData; $proceedOrderArguments->voucher = $jsonVoucherData['voucher']; $proceedOrderArguments->log = $jsonLogData;
                                            $proceedOrderArguments->subTotal = $changedSubtotal; $proceedOrderArguments->errors = $inventoryErrorData;
                                            proceedOrder($proceedOrderArguments);
                                        } else {
                                            $inventoryKeys = array_keys((array)$jsonItemsData); $inventoryItems = array(); 
                                            $inventoryOptions = array(); $orderedItemsArray = array(); $inventoryErrorData = array();                                            
                                            for ($i = 0; $i < count($inventoryKeys); $i++) {
                                                $inventoryItemId = explode('_', $inventoryKeys[$i])[1];
                                                array_push($inventoryItems, 
                                                [
                                                    "id" => $jsonItemsData['item_'.$inventoryItemId]['general']['id'],
                                                    "quantity" => $jsonItemsData['item_'.$inventoryItemId]['general']['quantity'],
                                                    ]
                                                );
                                            }
                                            for ($i = 0; $i < count($inventoryItems); $i++) {
                                                $updateInventoryData = $con->prepare("UPDATE products__inventory SET quantity = (quantity - ?) WHERE pid = ?");
                                                $updateInventoryData->bind_param('ii', $inventoryItems[$i]['quantity'], $inventoryItems[$i]['id']); $updateInventoryData->execute(); $updateInventoryData->store_result(); $updateInventoryData->close();
                                            }

                                            $proceedOrderArguments = new stdClass(); $proceedOrderArguments->items = $inventoryItems; $proceedOrderArguments->user = $jsonUserData; $proceedOrderArguments->voucher = $jsonVoucherData['voucher']; $proceedOrderArguments->log = $jsonLogData;
                                            $proceedOrderArguments->subTotal = $grossTotal; $proceedOrderArguments->errors = $inventoryErrorData;
                                            proceedOrder($proceedOrderArguments);
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
                            } else { dieProcess('A folyamat elvégzését nem sikerült végrehajtani.'); }
                        } else { dieProcess('A kártájának lejárt az érvényessége, ezért már nem használható tovább fizetéseknél.'); }
                    } else { dieProcess('A folyamat elvégzését nem sikerült végrehajtani.'); }
                } else { dieProcess('Az a kártya, amellyel fizetni szeretett volna, nem létezik a fiókján.'); }
            } else { dieProcess('A folyamat elvégzését nem sikerült végrehajtani.'); }
        } else { dieProcess('Érvénytelen felhasználói azonosítót használt.'); }
    } else { dieProcess('A folyamat elvégzését nem sikerült végrehajtani.'); }
} else { dieProcess('Érvénytelen felhasználói azonosítót használt.'); }

?>