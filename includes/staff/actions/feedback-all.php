<?php
include($_SERVER['DOCUMENT_ROOT'].'/includes/inc.connect.php');
if (mysqli_connect_errno()) {die ("0"); }
$sql = "SELECT * FROM feedbacks WHERE status = 0";
if ($result = mysqli_query($con, $sql)) {$num = mysqli_num_rows($result);echo $num;die();}
?>