<?php require_once($_SERVER['DOCUMENT_ROOT'].'/includes/inc.php');

$uid = $_POST['uid'];
$ordersArray = array(); $exitObject = new stdClass();

$getOrderDetailsSQL = "SELECT orders.id AS oid, orders.items, orders.status, orders.date AS odate, subTotal FROM orders INNER JOIN orders__payment ON orders__payment.oid = orders.id WHERE orders.uid = " . $uid;
$getOrderDetailsRES = $con->query($getOrderDetailsSQL);
if ($getOrderDetailsRES->num_rows > 0) {
    while ($dt = $getOrderDetailsRES->fetch_assoc()) { $ordersData = new stdClass(); $ordersItemsCon = array();
        $items = explode(';', rtrim($dt['items'], ";")); $orderItemsArray = array();
        for ($i = 0; $i < count($items); $i++) {
            array_push($orderItemsArray, $items[$i]);
        }
        for ($i = 0; $i < count($orderItemsArray); $i++) {
            $pid = explode(":", $orderItemsArray[$i])[0]; $ordersItemData = new stdClass();
            $getOrderedItemDetailsSQL = "SELECT name, thumbnail FROM products WHERE id = " . $pid;
            $getOrderedItemDetailsRES = $con->query($getOrderedItemDetailsSQL); $pdt = $getOrderedItemDetailsRES->fetch_assoc();
            $ordersItemData->name = $pdt['name']; $ordersItemData->thumbnail = $pdt['thumbnail'];
            array_push($ordersItemsCon, $ordersItemData);
            $ordersData->item = $ordersItemsCon;
        }
        $ordersData->oid = $dt['oid']; $ordersData->status = $dt['status'];
        $ordersData->odate = $dt['odate']; $ordersData->subTotal = $dt['subTotal'];
        array_push($ordersArray, $ordersData);
    }
    $exitObject->status = "success";
    $exitObject->data = $ordersArray;
    die(json_encode($exitObject));
} else {
    $exitObject->status = "error";
    $exitObject->msg = "Erről a fiókról nem történt rendelés.";
    die(json_encode($exitObject));
}

?>