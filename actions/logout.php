<?php include($_SERVER['DOCUMENT_ROOT'].'/includes/inc.connect.php');
unset($_COOKIE['__au__login']); setcookie("__au__login", null, -1, '/');
$_SESSION['loggedin'] = FALSE; unset($_SESSION['id']);
session_start(); session_destroy();
echo "<script>const now = new Date();const notifParams = {notifType : '0',notifIcon : '0',notifTheme : '0',notifTitle : 'Kijelentkezés',notifDesc : 'Sikeresen kijelentkezett!',expiry : now.setSeconds(60)};localStorage.setItem('NP', JSON.stringify(notifParams));window.location.href= '../';</script>";
?>