<?php session_start(); $DATABASE_HOST = 'localhost';$DATABASE_USER = 'root';$DATABASE_PASS = 'eKi=0630OG';$DATABASE_NAME = 'mappapapir'; $con = mysqli_connect($DATABASE_HOST, $DATABASE_USER, $DATABASE_PASS, $DATABASE_NAME); if (mysqli_connect_errno()) { die ("0"); } if (isset($_SESSION['id'])) {$uid = $_SESSION['id'];} else {die("43"); }
$arr = array(); array_push($arr, $_POST); $narr = array(); foreach($_POST as $key=>$value) { array_push($narr, "$key=$value"); }
for ($i = 0; $i < count($narr); $i++) { $key = (explode("=", $narr[$i])[0]); $val = (explode("=", $narr[$i])[1]); $tab = (explode("__", $key)); $tkey = $tab[0]; $tskey = $tab[1];
    if (count($tab) > 1) { if ($stmt = $con->prepare('UPDATE customers__'.$tkey.' SET '.$tskey.' = ? WHERE id = ?')) { $stmt->bind_param('si', $val, $uid); $stmt->execute(); } else { die ("26"); } }
    else { if ($stmt = $con->prepare('UPDATE customers SET '.$key.' = ? WHERE id = ?')) { $stmt->bind_param('si', $val, $uid); $stmt->execute(); } else { die ("26"); } }
} die("200");
?>