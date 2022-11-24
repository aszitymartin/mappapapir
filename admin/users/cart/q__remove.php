<?php session_start(); $DATABASE_HOST = 'localhost';$DATABASE_USER = 'root';$DATABASE_PASS = 'eKi=0630OG';$DATABASE_NAME = 'mappapapir'; $con = mysqli_connect($DATABASE_HOST, $DATABASE_USER, $DATABASE_PASS, $DATABASE_NAME);
if (mysqli_connect_errno()) { die("Connection failed: " . mysqli_connect_error()); }
if (isset($_POST['uid'])) {$uid = $_POST['uid'];} else { die("Nem bejelentkezett felhasználó"); }
if ($stmt = $con->prepare('SELECT pid FROM cart WHERE uid = ? AND pid = ?')) {
    $stmt->bind_param('ii', $uid, $_POST['pid']); $stmt->execute(); $stmt->store_result();
    if ($stmt->num_rows > 0) {
        if ($stmt = $con->prepare('DELETE FROM cart WHERE pid = ? AND uid = ?')) {
            $stmt->bind_param('ii', $_POST['pid'], $uid);$stmt->execute(); $pid = $_POST['pid'];
            $log_categ = "Felhasználó szerkesztése"; $log_desc = "#".$uid." felhasználó kosarából terméket törölt:  #".$pid;
            if ($log = $con->prepare('INSERT INTO log (uid, ip, category, description) VALUES(?,?,?,?)')) {
                $log->bind_param('isss', $_SESSION['id'], $_POST['ip'], $log_categ, $log_desc); $log->execute(); $log->close(); die('0');
            } else { die ("Hiba történt a logolás közben."); } die('0');
        } else { die ("Hiba lépett fel az adatbázisban feldolgozás közben"); }
    } else { die ("Hiba lépett fel az adatbázisban feldolgozás közben"); } $stmt->close();
} else { die ("Hiba lépett fel az adatbázisban feldolgozás közben"); } $con->close();
?>