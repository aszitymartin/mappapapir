<?php require_once($_SERVER['DOCUMENT_ROOT'].'/includes/inc.php');

$uid = $_POST['uid'];
$ordersArray = array(); $exitObject = new stdClass();

$getOrderDetailsSQL = "SELECT orders.id AS oid, orders.item, orders.status, orders.data AS odate, subTotal, FROM orders INNER JOIN orders__payment ON orders__payment.oid = orders.id WHERE orders.uid = " . $uid;
$getOrderDetailsRES = $con->query($getOrderDetailsSQL);
if ($getOrderDetailsRES->num_rows > 0) {
    while ($dt = $$getOrderDetailsRES->fetch_assoc()) {
        // get items pid
    }
} else {
    $exitObject->status = "error";
    $exitObject->msg = "Erről a fiókról nem történt rendelés.";
    die(json_encode($exitObject));
}

?>