<?php session_start();
include($_SERVER['DOCUMENT_ROOT'].'/includes/inc.connect.php'); if (mysqli_connect_errno()) { die ("0"); } $pid = $_POST['pid'];
if (isset($_SESSION['id'])) { $uid = $_SESSION['id'];} else {die("43"); }
if ($stmt = $con->prepare('SELECT * FROM products WHERE product_id = ? AND product_quantity >= ?')) {
    $stmt->bind_param('ii', $pid, $_POST['quantity']); $stmt->execute(); $stmt->store_result();
    if ($stmt->num_rows > 0) { die ("2001"); } else { die ("31"); exit; } $stmt->close();
} else { die ("25"); } $con->close();

?>