<?php require_once($_SERVER['DOCUMENT_ROOT'].'/includes/inc.php');
if(!$con) { die("Connection failed: " . mysqli_connect_error()); } $uid = $_SESSION['id'];
$sql = "SELECT cart.*, products__inventory.quantity AS maxquantity, products__pricing.base, products__pricing.discount FROM cart INNER JOIN products__inventory ON products__inventory.pid = cart.pid INNER JOIN products__pricing ON products__pricing.pid = cart.pid WHERE uid = $uid"; $res = $con->query($sql);
if ($res->num_rows > 0) { $data = array();
    while ($dt = $res->fetch_assoc()) { $obj = new stdClass();
        if ($dt['base'] > 0) { $obj->price = $dt['base'] - (($dt['discount'] * $dt['base']) / 100); } else { $obj->price = $dt['base']; }
        $obj->pid = $dt['pid']; $obj->quantity = $dt['quantity']; $obj->max = $dt['maxquantity'];
        array_push($data, $obj);
    } die(json_encode($data));
    
} else { die('Ismeretlen termék'); }
?>