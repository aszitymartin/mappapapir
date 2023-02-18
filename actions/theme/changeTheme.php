<?php session_start(); include($_SERVER['DOCUMENT_ROOT'].'/includes/inc.connect.php');
$SQL = $con->prepare("UPDATE customers SET theme = ? WHERE id = ?");
$SQL->bind_param('si', $_POST['theme'], $_SESSION['id']);$SQL->execute();
?>