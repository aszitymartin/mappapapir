<?php require_once($_SERVER['DOCUMENT_ROOT'].'/includes/inc.php');
if(!$con) { die("Connection failed: " . mysqli_connect_error()); }
if (isset($_SESSION['id'])) { $uid = $_SESSION['id']; } else { die("Nem bejelentkezett felhasználó"); }
if ($stmt = $con->prepare('SELECT pid, quantity FROM cart WHERE uid = ? AND pid = ?')) {
    $stmt->bind_param('ii', $uid, $_POST['pid']); $stmt->execute(); $stmt->store_result();
    if ($stmt->num_rows > 0) {
        if ($stmt = $con->prepare('UPDATE cart SET quantity = ? WHERE pid = ? AND uid = ?')) {
            $stmt->bind_param('iii', $quantity, $_POST['pid'], $uid); $quantity = $_POST['quantity'] + 1; $stmt->execute(); die($quantity.'');
        } else { die ("Hiba lépett fel az adatbázisban feldolgozás közben"); }
    } else { die ("Hiba lépett fel az adatbázisban feldolgozás közben"); exit; } $stmt->close();
} else { die ("Hiba lépett fel az adatbázisban feldolgozás közben"); } $con->close();
?>