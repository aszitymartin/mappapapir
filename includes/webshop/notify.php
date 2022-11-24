<?php session_start();
$DATABASE_HOST = 'localhost';$DATABASE_USER = 'root';$DATABASE_PASS = 'eKi=0630OG';$DATABASE_NAME = 'mappapapir';
$con = mysqli_connect($DATABASE_HOST, $DATABASE_USER, $DATABASE_PASS, $DATABASE_NAME);
if (mysqli_connect_errno()) { die ("0"); }
if (isset($_SESSION['id'])) {$uid = $_SESSION['id'];} else {die("43"); /* Nincs bejelentkezve */}

if ($_POST['action'] == 0) { // Feliratkozas a termek ertesiteseire
    if ($stmt = $con->prepare('SELECT pid FROM notify WHERE pid = ? AND uid = ? AND email = ?')) {
        $stmt->bind_param('iis', $_POST['pid'], $uid, $_POST['email']); $stmt->execute(); $stmt->store_result();
        if ($stmt->num_rows > 0) {die ("30"); exit;} // Erre az ertesitesre mar fel van iratkozva
        else {
            if ($stmt = $con->prepare('INSERT INTO notify (pid, uid, email) VALUES (?, ?, ?)')) {
                $stmt->bind_param('iis', $_POST['pid'], $uid, $_POST['email']);
                $stmt->execute(); echo "200" . $_POST['pid']; // 1: Feliratkozva az ertesitesekre
            } else { die ("26"); /* 26: Hiba tortent az INSERT kozben */ }
        } $stmt->close();
    } else { die ("25"); /* 25: Hiba tortent a PREPARE kozben */ } $con->close();
} if ($_POST['action'] == 1) { // Leiratkozas az ertesitesekrol
    if ($stmt = $con->prepare('SELECT pid FROM notify WHERE pid = ? AND uid = ? AND email = ?')) {
        $stmt->bind_param('iis', $_POST['pid'], $uid, $_POST['email']); $stmt->execute(); $stmt->store_result();
        if ($stmt->num_rows > 0) {
            if ($stmt = $con->prepare('DELETE FROM notify WHERE pid = ? AND uid = ? AND email = ?')) {
                $stmt->bind_param('iis', $_POST['pid'], $uid, $_POST['email']);
                $stmt->execute(); echo "410" . $_POST['pid']; // 1: Leiratkozva az ertesitesekrol
            } else { die ("26"); /* 26: Hiba tortent az INSERT kozben */ }
        }
        else {die ("57"); exit; } /* Erre az ertesitesre nincs feliratkozva */ $stmt->close();
    } else { die ("25"); /* 25: Hiba tortent a PREPARE kozben */ } $con->close();
}

?>