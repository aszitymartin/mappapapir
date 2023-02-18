<?php session_start(); include($_SERVER['DOCUMENT_ROOT'].'/includes/inc.connect.php'); if (mysqli_connect_errno()) { die ("0"); }
if (isset($_POST['uid'])) {$uid = $_POST['uid'];} else { die("Nem létező felhasználó"); }
if ($stmt = $con->prepare('SELECT pid FROM cart WHERE uid = ? AND pid = ?')) {
    $stmt->bind_param('ii', $uid, $_POST['pid']); $stmt->execute(); $stmt->store_result();
    if ($stmt->num_rows > 0) { die ('Már a kosárhoz van adva a termék'); } 
    else {
        if ($istmt = $con->prepare('INSERT INTO cart (uid, pid, quantity) VALUES (?, ?, 1)')) {
            $istmt->bind_param('ii', $uid, $_POST['pid']); $istmt->execute(); $istmt->close(); $pid = $_POST['pid'];
            $log_categ = "Felhasználó szerkesztése"; $log_desc = "#".$uid." felhasználó kosarába új terméket vett fel:  #".$pid;
            if ($log = $con->prepare('INSERT INTO log (uid, ip, category, description) VALUES(?,?,?,?)')) {
                $log->bind_param('isss', $_SESSION['id'], $_POST['ip'], $log_categ, $log_desc); $log->execute(); $log->close(); die('0');
            } else { die ("Hiba történt a logolás közben."); } die('0');
        } else { die ("Hiba történt a feldolgozás közben"); }
    } $stmt->close();
} else { die ("Hiba történt a feldolgozás közben"); } $con->close();
?>