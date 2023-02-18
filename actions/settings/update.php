<?php include($_SERVER['DOCUMENT_ROOT'].'/includes/inc.connect.php');
session_start();
$col =$_POST['col'];$typ = $_POST['typ'];
$SQL = $con->prepare("UPDATE customers SET $col = ? WHERE id = ?");
if (is_numeric($typ)) {$SQL->bind_param('ii', $_POST['val'], $_SESSION['id']);}
else {$SQL->bind_param('si', $_POST['val'], $_SESSION['id']);}
$SQL->execute();
?>