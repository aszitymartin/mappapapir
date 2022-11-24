<?php  require_once($_SERVER['DOCUMENT_ROOT'].'/includes/inc.php'); include($_SERVER['DOCUMENT_ROOT'].'/assets/alph.php');
if(!$con) { die("Connection failed: " . mysqli_connect_error()); }
$darr = array();

$sql = "SELECT id, fullname, email FROM customers GROUP BY id";
$res = $con->query($sql);
while ($dt = $res->fetch_assoc()) { $uid = $dt['id']; $info = new stdClass();
    $osql = "SELECT COUNT(uid) AS 'orders' FROM orders WHERE uid = $uid"; $ores = $con->query($osql); $odt = $ores->fetch_assoc(); $orders = $odt['orders'];
    $rsql = "SELECT COUNT(uid) AS 'reviews' FROM reviews WHERE uid = $uid"; $rres = $con->query($rsql); $rdt = $rres->fetch_assoc(); $reviews = $rdt['reviews'];
    $csql = "SELECT COUNT(uid) AS 'cards' FROM customers__card WHERE uid = $uid"; $cres = $con->query($csql); $cdt = $cres->fetch_assoc(); $cards = $cdt['cards'];
    $hsql = "SELECT initials, color FROM customers__header WHERE uid = $uid"; $hres = $con->query($hsql); $hdt = $hres->fetch_assoc(); $initials = $hdt['initials']; $color = $hdt['color'];
    $esql = "SELECT valid FROM u__email WHERE uid = $uid"; $eres = $con->query($esql); $edt = $eres->fetch_assoc(); $emailvalid = $edt['valid'];
    $esql = "SELECT privilege FROM customers__priv WHERE uid = $uid"; $eres = $con->query($esql); $edt = $eres->fetch_assoc(); $priv = $edt['privilege'];
    // $esql = "SELECT sub FROM customers__card__subscription WHERE uid = $uid"; $eres = $con->query($esql); $edt = $eres->fetch_assoc(); $emailvalid = $edt['valid'];
    $info->uid = $uid; $info->name = $dt['fullname']; $info->email = $dt['email']; $info->emailvaild = $emailvalid; $info->priv = $priv;
    $info->orders = $orders; $info->reviews = $reviews; $info->cards = $cards; $info->initials = $initials; $info->color = $color;
    array_push($darr, $info);
} die(json_encode($darr));

?>