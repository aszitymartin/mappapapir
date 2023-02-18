<?php session_start();
include($_SERVER['DOCUMENT_ROOT'].'/includes/inc.connect.php');
if (mysqli_connect_errno()) {die ("0"); } $uid = $_SESSION['id'];
$sql = "SELECT * FROM rvr__w WHERE uid = $uid";
if ($result = mysqli_query($con, $sql)) {$num = mysqli_num_rows($result); if ($num > 0) {echo $num; die();} else {echo 0; die();} }
?>