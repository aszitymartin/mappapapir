<?php session_start(); include($_SERVER['DOCUMENT_ROOT'].'/includes/inc.connect.php'); if (mysqli_connect_errno()) { die ("0"); } if (isset($_SESSION['id'])) {$uid = $_SESSION['id'];} else {die("43"); }
$arr = array(); array_push($arr, $_POST); $narr = array(); foreach($_POST as $key=>$value) { if ($key != 'cardname') {array_push($narr, "$key=$value");} }
for ($i = 0; $i < count($narr); $i++) { if($narr[$i] != 'cid') { $key = (explode("=", $narr[$i])[0]); $val = (explode("=", $narr[$i])[1]); $tab = (explode("__", $key)); $tkey = $tab[0]; $tskey = $tab[1]; }
    if (count($tab) > 1) {
        if ($stmt = $con->prepare('UPDATE customers__card__'.$tkey.' SET '.$tskey.' = ? WHERE uid = ? AND cid = ?')) { $stmt->bind_param('sis', $val, $uid, $_POST['cid']); $stmt->execute(); } else { die ("26"); }
        if ($tskey == 'number') { if ($stmt = $con->prepare('UPDATE customers__card SET cardnum = ? WHERE uid = ? AND cid = ?')) { $stmt->bind_param('sis', substr($_POST['info__number'], -4), $uid, $_POST['cid']); $stmt->execute(); } else { die ("26"); } }
        if ($tkey == 'cardname') { if ($_POST['cardname'] == "Mastercard") { $cardname = "Mastercard";$type = "Mastercard kredit kártya";$provider = "Mastercard Inc."; }if ($_POST['cardname'] == "Visa") { $cardname = "Visa";$type = "Visa kredit kártya";$provider = "Visa Inc."; }if ($_POST['cardname'] == "Paypal") { $cardname = "PayPal";$type = "PayPal virtuális kártya";$provider = "PayPal Inc."; }
            if ($stmt = $con->prepare('UPDATE customers__card, customers__card__info SET customers__card.cardname = ?, customers__card__info.type = ?,customers__card__info.provider = ? WHERE customers__card.uid = ? AND customers__card.cid LIKE ? AND customers__card__info.uid = ?  AND customers__card__info.cid LIKE ?')) { $stmt->bind_param('sssisis', $cardname, $type, $provider, $uid, $_POST['cid'], $uid, $_POST['cid']); $stmt->execute(); } else { die ("26"); }
        }
    } else {
        if (isset($_POST['cardname'])) { if ($_POST['cardname'] == "Mastercard") { $cardname = "Mastercard";$type = "Mastercard kredit kártya";$provider = "Mastercard Inc."; }if ($_POST['cardname'] == "Visa") { $cardname = "Visa";$type = "Visa kredit kártya";$provider = "Visa Inc."; }if ($_POST['cardname'] == "Paypal") { $cardname = "PayPal";$type = "PayPal virtuális kártya";$provider = "PayPal Inc."; }
            if ($stmt = $con->prepare('UPDATE customers__card, customers__card__info SET customers__card.cardname = ?, customers__card__info.type = ?,customers__card__info.provider = ? WHERE customers__card.uid = ? AND customers__card.cid LIKE ? AND customers__card__info.uid = ?  AND customers__card__info.cid LIKE ?')) { $stmt->bind_param('sssisis', $cardname, $type, $provider, $uid, $_POST['cid'], $uid, $_POST['cid']); $stmt->execute(); } else { die ("26"); }
        }
        if(explode("=", $narr[$i])[0] != 'cid') { if ($stmt = $con->prepare('UPDATE customers__card SET '.$key.' = ? WHERE uid = ? AND cid = ?')) { $stmt->bind_param('sis', $val, $uid, $_POST['cid']); $stmt->execute(); } else { die ("26"); } }
    }
} die('200');
?>