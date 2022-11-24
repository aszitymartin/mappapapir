<?php require_once($_SERVER['DOCUMENT_ROOT'].'/includes/inc.php');
if(!$con) { die("Connection failed: " . mysqli_connect_error()); } $uid = $_SESSION['id']; $pid = $_POST['pid'];
$sql = "SELECT cart.*, products__inventory.quantity AS maxquantity FROM cart INNER JOIN products__inventory ON products__inventory.pid = cart.pid WHERE uid = $uid AND cart.pid = $pid"; $res = $con->query($sql); $obj = new stdClass();
if ($res->num_rows > 0) { $dt = $res->fetch_assoc();
    $obj->pid = $dt['pid']; $obj->quantity = $dt['quantity']; $obj->max = $dt['maxquantity']; die(json_encode($obj));
} else { die('Ismeretlen termék'); }
?>