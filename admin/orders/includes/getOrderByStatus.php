<?php require_once($_SERVER['DOCUMENT_ROOT'].'/includes/inc.php');

if ($_POST['status'] == -1) { $where = ""; }
else { $where = "WHERE orders.status = ". $_POST['status']; }

$selectOrdersSQL = "SELECT orders.id, orders.date, fullname, status, subTotal FROM orders INNER JOIN customers ON customers.id = orders.uid INNER JOIN orders__payment ON orders__payment.oid = orders.id ". $where ." ORDER BY orders.status, orders.date ASC";
$selectOrdersRes = $con->query($selectOrdersSQL); $itemArray = array(); $exitObject = new stdClass();
if ($selectOrdersRes->num_rows > 0) {
    while ($o = $selectOrdersRes->fetch_assoc()) { $object = new stdClass();
        $object->id = $o['id'];
        $object->date = $o['date'];
        $object->fullname = $o['fullname'];
        $object->status = $o['status'];
        $object->subTotal = $o['subTotal'];
        array_push($itemArray, $object);
    } $exitObject->status = "success"; $exitObject->data = $itemArray;
} else { $exitObject->status = "error"; }
die(json_encode($exitObject));
?>