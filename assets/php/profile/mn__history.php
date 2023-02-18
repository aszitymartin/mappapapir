<?php session_start();
include($_SERVER['DOCUMENT_ROOT'].'/includes/inc.connect.php');
if (mysqli_connect_errno()) { die ("0"); }
if (isset($_SESSION['id'])) {$uid = $_SESSION['id'];} else {die("43");}
if ($stmt = $con->prepare('SELECT orders.*, products.product_name FROM orders INNER JOIN products ON orders.pid = products.product_id WHERE uid = ?')) {
    $stmt->bind_param('i', $uid); $stmt->execute(); $result = $stmt->get_result(); $arr = array();
    if($result->num_rows > 0) {
        while ($data = $result->fetch_assoc()) { $object = new stdClass();
            $object->id = $data['id']; $object->pid = $data['pid']; $object->pname = $data['product_name']; $object->quantity = $data['quantity']; $object->subtotal = $data['subtotal']; $object->date = $data['date'];
            array_push($arr, $object);
        } die(json_encode($arr));
    } else { die('30'); }
} else { die ("26"); }
$stmt->close();
?>