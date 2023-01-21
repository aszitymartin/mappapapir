<?php session_start(); $DATABASE_HOST = 'localhost';$DATABASE_USER = 'root';$DATABASE_PASS = 'eKi=0630OG';$DATABASE_NAME = 'mappapapir'; $con = mysqli_connect($DATABASE_HOST, $DATABASE_USER, $DATABASE_PASS, $DATABASE_NAME);
$SQL = $con->prepare("UPDATE customers SET theme = ? WHERE id = ?");
$SQL->bind_param('si', $_POST['theme'], $_SESSION['id']);$SQL->execute();
?>