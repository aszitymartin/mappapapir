<?php session_start();
include($_SERVER['DOCUMENT_ROOT'].'/includes/inc.connect.php');
if (mysqli_connect_errno()) { die ("0"); } $id = $_POST['id'];
if ($stmt = $con->prepare('SELECT product_id FROM product_discount WHERE product_id = ?')) {
    $stmt->bind_param('i', $_POST['id']); $stmt->execute(); $stmt->store_result();
    if ($stmt->num_rows > 0) {
        if ($stmt = $con->prepare('DELETE FROM product_discount WHERE product_id = ?')) {
            $stmt->bind_param('i', $_POST['id']);
            $stmt->execute(); echo "1"; // 1: Sikeres muvelet
        } else { die ("26"); /* 26: Hiba tortent az INSERT kozben */ }
    } else {die('30');} $stmt->close();
} else { die ("25"); /* 25: Hiba tortent a PREPARE kozben */ } $con->close();
?>