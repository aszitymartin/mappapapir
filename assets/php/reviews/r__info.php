<?php session_start();
include($_SERVER['DOCUMENT_ROOT'].'/includes/inc.connect.php');
if (mysqli_connect_errno()) { die ("0"); } $uid = $_SESSION['id']; $pid = $_POST['pid']; $rid = $_POST['rid'];
$sql = "SELECT * FROM reviews WHERE pid = $pid AND id = $rid AND uid = $uid";
if ($result = mysqli_query($con, $sql)) { $object = new stdClass(); while($row = mysqli_fetch_array($result)) { $object->star = $row['stars'];$object->desc = $row['description'];} die(json_encode($object)); }
?>