<?php session_start(); include($_SERVER['DOCUMENT_ROOT'].'/includes/inc.connect.php');
if (mysqli_connect_errno()) { die ("0"); } if (isset($_SESSION['id'])) {$uid = $_SESSION['id'];} else {die("43"); }
$rid = $_POST['rid']; $sql = "SELECT COUNT(id) AS 'amount' FROM rv__u WHERE rid = $rid"; $res = $con-> query($sql); $am = $res-> fetch_assoc(); die($am['amount']); ?>