<?php session_start();
$DATABASE_HOST = 'localhost';$DATABASE_USER = 'root';$DATABASE_PASS = 'eKi=0630OG';$DATABASE_NAME = 'mappapapir';
$con = mysqli_connect($DATABASE_HOST, $DATABASE_USER, $DATABASE_PASS, $DATABASE_NAME);
if (mysqli_connect_errno()) { die ("0"); }
if (isset($_SESSION['id'])) {$uid = $_SESSION['id'];} else {die("43"); /* Nincs bejelentkezve */}

if ($stmt = $con->prepare('SELECT uid FROM reviews WHERE uid = ? AND pid = ?')) {
    $stmt->bind_param('ii', $uid, $_POST['pid']); $stmt->execute(); $stmt->store_result();
    if ($stmt->num_rows < 1) {die ("30"); exit;}
    else {
        if ($stmt = $con->prepare('DELETE FROM reviews WHERE pid = ? AND uid = ?')) {
            $stmt->bind_param('ii', $_POST['pid'], $uid);
            $stmt->execute(); echo "200";
        } else { die ("26"); /* 26: Hiba tortent az INSERT kozben */ }
    } $stmt->close();
} else { die ("25"); /* 25: Hiba tortent a PREPARE kozben */ } $con->close();

?>