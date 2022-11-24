<?php session_start();
$DATABASE_HOST = 'localhost';$DATABASE_USER = 'root';$DATABASE_PASS = 'eKi=0630OG';$DATABASE_NAME = 'mappapapir';
$con = mysqli_connect($DATABASE_HOST, $DATABASE_USER, $DATABASE_PASS, $DATABASE_NAME); if (mysqli_connect_errno()) { die ("0"); } $pid = $_POST['pid'];
if (isset($_SESSION['id'])) { $uid = $_SESSION['id'];} else {die("43"); }
if ($stmt = $con->prepare('SELECT * FROM products WHERE product_id = ? AND product_quantity >= ?')) {
    $stmt->bind_param('ii', $pid, $_POST['quantity']); $stmt->execute(); $stmt->store_result();
    if ($stmt->num_rows > 0) { die ("2001"); } else { die ("31"); exit; } $stmt->close();
} else { die ("25"); } $con->close();

?>