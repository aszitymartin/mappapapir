<?php session_start();
include($_SERVER['DOCUMENT_ROOT'].'/includes/inc.connect.php');
if (mysqli_connect_errno()) { die ("0"); }
if (isset($_SESSION['id'])) {$uid = $_SESSION['id'];} else {die("43"); /* Nincs bejelentkezve */}
if ($stmt = $con->prepare('INSERT INTO rv__r (rid, uid) VALUES (?, ?)')) {
    $stmt->bind_param('ii', $_POST['rid'], $uid);
    $stmt->execute(); echo "200"; die();
} else { die ("26"); }
$stmt->close();
?>