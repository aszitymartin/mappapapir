<?php session_start();
echo $_SESSION['token']; $def = false;
if (!isset($_POST['token']) || $_POST['token'] != $_SESSION['token']) {echo false; die('invalid in def');
} else { $defe = true; echo true; die ('valid in def');}
?>