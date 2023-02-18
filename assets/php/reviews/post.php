<?php session_start();
include($_SERVER['DOCUMENT_ROOT'].'/includes/inc.connect.php');
if (mysqli_connect_errno()) { die ("0"); }
if (isset($_SESSION['id'])) {$uid = $_SESSION['id'];} else {die("43"); /* Nincs bejelentkezve */}
if ($stmt = $con->prepare('INSERT INTO reviews (uid, pid, description, stars) VALUES (?, ?, ?, ?)')) {
    $stmt->bind_param('iisi', $uid, $_POST['pid'], htmlspecialchars($_POST['description'], ENT_QUOTES), $_POST['stars']);
    $stmt->execute(); echo "200";
} else { die ("26"); }
$stmt->close();
?>