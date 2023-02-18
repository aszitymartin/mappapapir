<?php
include($_SERVER['DOCUMENT_ROOT'].'/includes/inc.connect.php');
if (mysqli_connect_errno()) {die ("0"); } $pid = $_POST['pid'];
$sql = "SELECT * FROM reviews WHERE pid = $pid";
if ($result = mysqli_query($con, $sql)) {$num = mysqli_num_rows($result); if ($num > 0) {echo $num; die();} else {echo 0; die();} }
?>