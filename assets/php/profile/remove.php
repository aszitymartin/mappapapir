<?php session_start(); include($_SERVER['DOCUMENT_ROOT'].'/includes/inc.connect.php'); if (mysqli_connect_errno()) { die ("0"); } if (isset($_SESSION['id'])) {$uid = $_SESSION['id'];} else {die("43"); }
if ($stmt = $con->prepare('INSERT INTO customers__deleted (uid, reason) VALUES (?, ?)')) { $stmt->bind_param('is', $uid, $_POST['reason']); $stmt->execute(); die('200'); } else { die ("410"); }
?>