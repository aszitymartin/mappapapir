<?php
session_start();mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
$DATABASE_HOST = 'localhost';$DATABASE_USER = 'root';$DATABASE_PASS = 'eKi=0630OG';$DATABASE_NAME = 'mappapapir';
$con = mysqli_connect($DATABASE_HOST, $DATABASE_USER, $DATABASE_PASS, $DATABASE_NAME);
$col =$_POST['col'];$typ = $_POST['typ'];
$SQL = $con->prepare("UPDATE customers SET $col = ? WHERE id = ?");
if (is_numeric($typ)) {$SQL->bind_param('ii', $_POST['val'], $_SESSION['id']);}
else {$SQL->bind_param('si', $_POST['val'], $_SESSION['id']);}
$SQL->execute();
?>