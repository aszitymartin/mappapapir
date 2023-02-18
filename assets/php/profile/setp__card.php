<?php session_start(); include($_SERVER['DOCUMENT_ROOT'].'/includes/inc.connect.php'); if (mysqli_connect_errno()) { die ("0"); } if (isset($_SESSION['id'])) {$uid = $_SESSION['id'];} else {die("43"); }
if ($stmt = $con->prepare('SELECT * FROM customers__card WHERE uid = ? AND cid = ?')) {
    $stmt->bind_param('is', $uid, $_POST['cid']);$stmt->execute();$stmt->store_result();
    if ($stmt->num_rows > 0) {
        if ($setp = $con->prepare('UPDATE customers__card__primary SET cid = ? WHERE uid = ?')) { $setp->bind_param('si', $_POST['cid'], $uid); $setp->execute(); die("200"); }
    } else { die('410'); }
} else { die('43'); }
?>