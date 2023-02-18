<?php session_start();
include($_SERVER['DOCUMENT_ROOT'].'/includes/inc.connect.php'); if (mysqli_connect_errno()) { die ("0"); } $pid = $_POST['pid'];
if (isset($_SESSION['id'])) { $uid = $_SESSION['id'];} else {die("43"); } $quantity = $_POST['quantity'];
if ($stmt = $con->prepare('INSERT INTO orders (uid, pid, quantity, subtotal) VALUES (?, ?, ?, ?)')) {
    $stmt->bind_param('iiii', $uid, $pid, $quantity, $_POST['subtotal']); $stmt->execute(); $stmt->store_result(); die("2003");
} else { die ("25"); } $con->close();
?>