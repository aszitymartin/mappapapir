<?php session_start(); include($_SERVER['DOCUMENT_ROOT'].'/includes/inc.connect.php'); if (mysqli_connect_errno()) { die ("0"); } if (isset($_SESSION['id'])) {$uid = $_SESSION['id'];} else {die("43"); }
$password = password_hash($_POST['password'], PASSWORD_DEFAULT); $original = password_hash($_POST['original'], PASSWORD_DEFAULT);
if ($stmt = $con->prepare('UPDATE customers SET password = ? WHERE id = ?')) {
    $stmt->bind_param('si', $password, $uid); $stmt->execute();
    if ($stmt = $con->prepare('UPDATE u__password SET password = ?, date = NOW() WHERE uid = ?')) { $stmt->bind_param('si', $password, $uid); $stmt->execute(); die("200"); }
    else { if ($stmt = $con->prepare('UPDATE customers SET password = ? WHERE id = ?')) { $stmt->bind_param('si', $original, $uid); $stmt->execute(); die("410");} die ("26"); }
} else { die ("26"); }
$stmt->close();
?>