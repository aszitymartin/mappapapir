<?php require_once($_SERVER['DOCUMENT_ROOT'].'/includes/inc.php'); if (mysqli_connect_errno()) { die ("0"); } if (isset($_SESSION['id'])) {$uid = $_SESSION['id'];} else {die("43"); }
$header = str_replace("=", "", base64_encode($fullname)); $cid =  strtolower(mb_substr(bin2hex($header), 1, 6) . '' . bin2hex(openssl_random_pseudo_bytes(6))); $cardshort = substr($_POST['cardnum'], -4); $value = 30000;
if ($_POST['type'] == "mastercard") { $cardname = "Mastercard";$type = "Mastercard kredit kártya";$provider = "Mastercard Inc."; }
if ($_POST['type'] == "visa") { $cardname = "Visa";$type = "Visa kredit kártya";$provider = "Visa Inc."; }
if ($_POST['type'] == "paypal") { $cardname = "PayPal";$type = "PayPal virtuális kártya";$provider = "PayPal Inc."; }
if ($stmt = $con->prepare('SELECT id FROM customers WHERE id = ?')) {
    $stmt->bind_param('i', $uid);$stmt->execute();$stmt->store_result();
    if ($pr__stmt = $con->prepare('INSERT INTO customers__card (uid, cid, cardname, cardnum, expiry, cvc, value) VALUES (?, ?, ?, ?, ?, ?, ?)')) {
        $pr__stmt->bind_param('issisii', $uid, $cid, $cardname, $cardshort, $_POST['expiry'], $_POST['cvc'], $value); $pr__stmt->execute();
        if ($pr__stmt = $con->prepare('INSERT INTO customers__card__info (uid, cid, number, holder, type, provider) VALUES (?, ?, ?, ?, ?, ?)')) {
            $pr__stmt->bind_param('isisss', $uid, $cid, $_POST['cardnum'], $_POST['cardholder'], $type, $provider); $pr__stmt->execute();
            if ($_POST['primary'] == "true") {
                if ($stmt = $con->prepare('UPDATE customers__card__primary SET cid = ? WHERE uid = ?')) { $stmt->bind_param('si', $cid, $uid); $stmt->execute(); die("200"); }
            } else { die("200"); }
        } else {
            if ($stmt = $con->prepare('DELETE FROM customers__card WHERE uid = ?')) { $stmt->bind_param('i', $uid); $stmt->execute(); die("410"); }
        } $pr__stmt->close();
    } $pr__stmt->close();
} else { die('43'); }
?>