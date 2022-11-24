<?php session_start();
$DATABASE_HOST = 'localhost';$DATABASE_USER = 'root';$DATABASE_PASS = 'eKi=0630OG';$DATABASE_NAME = 'mappapapir';
$con = mysqli_connect($DATABASE_HOST, $DATABASE_USER, $DATABASE_PASS, $DATABASE_NAME);
if (mysqli_connect_errno()) { die ("0"); }
if (isset($_SESSION['id'])) {$uid = $_SESSION['id'];} else {die("43"); /* Nincs bejelentkezve */}
if ($stmt = $con->prepare('INSERT INTO rv__r (rid, uid) VALUES (?, ?)')) {
    $stmt->bind_param('ii', $_POST['rid'], $uid);
    $stmt->execute(); echo "200"; die();
} else { die ("26"); }
$stmt->close();
?>