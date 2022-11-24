<?php require_once($_SERVER['DOCUMENT_ROOT'].'/includes/inc.php');
if(!$con) { die("Connection failed: " . mysqli_connect_error()); } $uid = $_SESSION['id'];
$sql = "SELECT * FROM cart WHERE uid = $uid";
if ($result = mysqli_query($con, $sql)) {$num = mysqli_num_rows($result); echo $num; die(); }
?>