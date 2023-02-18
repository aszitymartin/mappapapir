<?php
include($_SERVER['DOCUMENT_ROOT'].'/includes/inc.connect.php');
if (mysqli_connect_errno()) {die ("0"); } $rid = $_POST['rid'];
$sql = "SELECT * FROM rv__u WHERE rid = $rid";
if ($result = mysqli_query($con, $sql)) {$num = mysqli_num_rows($result); if ($num > 0) {echo "true"; die();} else {echo "false"; die();} }
?>