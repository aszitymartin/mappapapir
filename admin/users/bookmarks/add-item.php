<?php session_start(); $DATABASE_HOST = 'localhost';$DATABASE_USER = 'root';$DATABASE_PASS = 'eKi=0630OG';$DATABASE_NAME = 'mappapapir'; $con = mysqli_connect($DATABASE_HOST, $DATABASE_USER, $DATABASE_PASS, $DATABASE_NAME); if (mysqli_connect_errno()) { die ("0"); }
if (isset($_POST['uid'])) {$uid = $_POST['uid'];} else { die("Nem létező felhasználó"); }
if ($stmt = $con->prepare('SELECT pid FROM bookmarks WHERE uid = ? AND pid = ?')) {
    $stmt->bind_param('ii', $uid, $_POST['pid']); $stmt->execute(); $stmt->store_result();
    if ($stmt->num_rows > 0) { die ('Már a könyvjelzőkhöz van adva a termék'); } 
    else {
        if ($istmt = $con->prepare('INSERT INTO bookmarks (uid, pid) VALUES (?, ?)')) {
            $istmt->bind_param('ii', $uid, $_POST['pid']); $istmt->execute(); $istmt->close(); $ppid = $_POST['pid'];
            $log_categ = "Felhasználó szerkesztése"; $log_desc = "#".$uid." felhasználó mentett #".$ppid." termék hozzáadása.";
            if ($log = $con->prepare('INSERT INTO log (uid, ip, category, description) VALUES(?,?,?,?)')) {
                $log->bind_param('isss', $_SESSION['id'], $_POST['ip'], $log_categ, $log_desc); $log->execute(); $log->close(); die('0');
            } else { die ("Hiba történt a logolás közben."); }
        } else { die ("Hiba történt a feldolgozás közben"); }
    } $stmt->close();
} else { die ("Hiba történt a feldolgozás közben"); } $con->close();
?>