<?php session_start(); include($_SERVER['DOCUMENT_ROOT'].'/includes/inc.connect.php'); if (mysqli_connect_errno()) { die ("0"); } if (isset($_SESSION['id'])) {$uid = $_SESSION['id'];} else {die("43");}
if ($stmt = $con->prepare('SELECT email FROM customers  WHERE id = ?')) {
    $stmt->bind_param('i', $uid); $stmt->execute(); $result = $stmt->get_result();
    if($result->num_rows > 0) { $data = $result->fetch_assoc(); if ($data['email'] == $_POST['email']) { die ("200"); } else { die("410"); } }
    else { die('30'); }
} else { die ("26"); } $stmt->close();
?>