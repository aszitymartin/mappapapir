<?php session_start();
include($_SERVER['DOCUMENT_ROOT'].'/includes/inc.connect.php');
if (mysqli_connect_errno()) { die("Connection failed: " . mysqli_connect_error()); }
if (isset($_SESSION['id'])) {$uid = $_SESSION['id'];} else { die("Nem bejelentkezett felhasználó"); }
if ($stmt = $con->prepare('SELECT pid FROM cart WHERE uid = ? AND pid = ?')) {
    $stmt->bind_param('ii', $uid, $_POST['pid']); $stmt->execute(); $stmt->store_result();
    if ($stmt->num_rows > 0) {
        if ($stmt = $con->prepare('DELETE FROM cart WHERE pid = ? AND uid = ?')) {
            $stmt->bind_param('ii', $_POST['pid'], $uid);$stmt->execute(); die('0');
        } else { die ("Hiba lépett fel az adatbázisban feldolgozás közben"); }
    } else { die ("Hiba lépett fel az adatbázisban feldolgozás közben"); } $stmt->close();
} else { die ("Hiba lépett fel az adatbázisban feldolgozás közben"); } $con->close();
?>