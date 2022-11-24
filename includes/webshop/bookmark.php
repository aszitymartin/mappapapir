<?php session_start();
$DATABASE_HOST = 'localhost';$DATABASE_USER = 'root';$DATABASE_PASS = 'eKi=0630OG';$DATABASE_NAME = 'mappapapir';
$con = mysqli_connect($DATABASE_HOST, $DATABASE_USER, $DATABASE_PASS, $DATABASE_NAME);
if (mysqli_connect_errno()) { die ("0"); }
if (isset($_SESSION['id'])) {$uid = $_SESSION['id'];} else {die("43"); /* Nincs bejelentkezve */}

if ($_POST['action'] == 0) { // Hozzaadas a konyvjelzohoz
    if ($stmt = $con->prepare('SELECT product_id FROM bookmarks WHERE uid = ? AND product_id = ? AND product_code = ?')) {
        $stmt->bind_param('iis', $uid, $_POST['id'], $_POST['code']); $stmt->execute(); $stmt->store_result();
        if ($stmt->num_rows > 0) {die ("30"); exit;}
        else {
            if ($stmt = $con->prepare('INSERT INTO bookmarks (uid, product_id, product_code) VALUES (?, ?, ?)')) {
                $stmt->bind_param('iis', $uid, $_POST['id'], $_POST['code']);
                $stmt->execute(); echo "200" . $_POST['id']; // 1: Hozzaadva a konyvjelzohoz
            } else { die ("26"); /* 26: Hiba tortent az INSERT kozben */ }
        } $stmt->close();
    } else { die ("25"); /* 25: Hiba tortent a PREPARE kozben */ } $con->close();
} if ($_POST['action'] == 1) { // Eltavolitas a konyvjelzok kozul
    if ($stmt = $con->prepare('SELECT product_id FROM bookmarks WHERE uid = ? AND product_id = ? AND product_code = ?')) {
        $stmt->bind_param('iis', $uid, $_POST['id'], $_POST['code']); $stmt->execute(); $stmt->store_result();
        if ($stmt->num_rows > 0) {
            if ($stmt = $con->prepare('DELETE FROM bookmarks WHERE uid = ? AND product_id = ? AND product_code = ?')) {
                $stmt->bind_param('iis', $uid, $_POST['id'], $_POST['code']);
                $stmt->execute(); echo "410" . $_POST['id']; // 1: Torolve a konyvjelzokbol
            } else { die ("26"); /* 26: Hiba tortent az INSERT kozben */ }
        }
        else {die ("57"); exit; } /* Ez a termek nincs a konyvjelzok kozott */ $stmt->close();
    } else { die ("25"); /* 25: Hiba tortent a PREPARE kozben */ } $con->close();
}

?>