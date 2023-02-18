<?php session_start();
include($_SERVER['DOCUMENT_ROOT'].'/includes/inc.connect.php');
if (mysqli_connect_errno()) { die ("0"); }
if (isset($_SESSION['id'])) {$uid = $_SESSION['id'];} else {die("43"); /* Nincs bejelentkezve */}
if ($stmt = $con->prepare('UPDATE reviews SET description = ?, stars = ? WHERE id = ? AND pid = ?')) {
    $stmt->bind_param('siii', htmlspecialchars($_POST['description'], ENT_QUOTES), $_POST['stars'], $_POST['rid'], $_POST['pid']);
    $stmt->execute(); echo "200";
} else { die ("26"); }
$stmt->close();
?>