<?php
$DATABASE_HOST = 'localhost';$DATABASE_USER = 'root';$DATABASE_PASS = 'eKi=0630OG';$DATABASE_NAME = 'mappapapir';
$con = mysqli_connect($DATABASE_HOST, $DATABASE_USER, $DATABASE_PASS, $DATABASE_NAME);
if (mysqli_connect_errno()) {die ("0"); }
$sql = "SELECT * FROM feedbacks WHERE status = 0";
if ($result = mysqli_query($con, $sql)) {$num = mysqli_num_rows($result);echo $num;die();}
?>