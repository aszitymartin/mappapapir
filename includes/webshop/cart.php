<?php session_start();
$DATABASE_HOST = 'localhost';$DATABASE_USER = 'root';$DATABASE_PASS = 'eKi=0630OG';$DATABASE_NAME = 'mappapapir';
$con = mysqli_connect($DATABASE_HOST, $DATABASE_USER, $DATABASE_PASS, $DATABASE_NAME);
if (mysqli_connect_errno()) { die ("0"); }
if (isset($_SESSION['id'])) {$uid = $_SESSION['id'];} else {die("43"); /* Nincs bejelentkezve */}
if ($stmt = $con->prepare('SELECT pid FROM cart WHERE uid = ? AND pid = ?')) {
    $stmt->bind_param('ii', $uid, $_POST['pid']); $stmt->execute(); $stmt->store_result();
    if ($stmt->num_rows > 0) {
        if ($dstmt = $con->prepare('DELETE FROM cart WHERE uid = ? AND pid = ?')) {
            $dstmt->bind_param('ii', $uid, $_POST['pid']); $dstmt->execute(); $dstmt->close(); echo "410" . $_POST['pid']; // 1: Torolve a kosarbol
        } else { die ("26"); }
    } else {
        if ($istmt = $con->prepare('INSERT INTO cart (uid, pid, quantity) VALUES (?, ?, 1)')) {
            $istmt->bind_param('ii', $uid, $_POST['pid']); $istmt->execute(); $istmt->close(); echo "200" . $_POST['pid']; // 1: Hozzaadva a kosahroz
        } else { die ("26"); /* 26: Hiba tortent az INSERT kozben */ }
    } $stmt->close();
} else { die ("25"); /* 25: Hiba tortent a PREPARE kozben */ } $con->close();
?>