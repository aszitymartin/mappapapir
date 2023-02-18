<?php include($_SERVER['DOCUMENT_ROOT'].'/includes/inc.connect.php');
unset($_COOKIE['__au__login']); setcookie("__au__login", null, -1, '/');
session_start(); session_destroy(); die('200');
?>