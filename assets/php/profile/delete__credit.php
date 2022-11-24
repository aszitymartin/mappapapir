<?php session_start(); $DATABASE_HOST = 'localhost';$DATABASE_USER = 'root';$DATABASE_PASS = 'eKi=0630OG';$DATABASE_NAME = 'mappapapir'; $con = mysqli_connect($DATABASE_HOST, $DATABASE_USER, $DATABASE_PASS, $DATABASE_NAME); if (mysqli_connect_errno()) { die ("0"); } if (isset($_SESSION['id'])) {$uid = $_SESSION['id'];} else {die("43"); }
if ($csub__stmt = $con->prepare('SELECT sub FROM customers__card__subscription WHERE uid = ?')) { $csub__stmt->bind_param('i', $uid);$csub__stmt->execute();$csub__stmt->execute(); $cs__result = $csub__stmt->get_result();$cs = $cs__result->fetch_assoc(); $cursub = $cs['sub'];}
if ($cursub < 2) { if ($setdelc = $con->prepare('INSERT INTO customers__card__deleted (cid, uid) VALUES (?, ?)')) { $setdelc->bind_param('si', $_POST['cid'], $uid); $setdelc->execute(); $setdelc->store_result(); } else { die ("25"); }  }
if ($stmt = $con->prepare('SELECT cid FROM customers__card WHERE uid = ? AND cid = ?')) {
    $stmt->bind_param('is', $uid, $_POST['cid']); $stmt->execute(); $stmt->store_result();
    if ($stmt->num_rows < 1) { die ("30"); exit; }
    else {
        if ($stmt = $con->prepare('SELECT cid FROM customers__card__info WHERE provider = "Mappa Papír Kft." AND uid = ?')) {
            $stmt->bind_param('i', $uid); $stmt->execute(); $result = $stmt->get_result();
            if($result->num_rows > 0) { $dt = $result->fetch_assoc(); $defcid = $dt['cid']; } else { die('30'); }
        } if ($defcid == $_POST['cid']) { die('403'); }
        else {
            if ($getpr__stmt = $con->prepare('SELECT cid FROM customers__card__primary WHERE uid = ?')) {
                $getpr__stmt->bind_param('i', $uid); $getpr__stmt->execute(); $getp__result = $getpr__stmt->get_result();
                $primc = $getp__result->fetch_assoc(); $primcard = $primc['cid']; 
                $setprim = ($primcard == $_POST['cid'] ? $defcid : $primcard);
                if ($stmt = $con->prepare('DELETE FROM customers__card WHERE customers__card.uid = ? AND customers__card.cid LIKE ? AND customers__card.cid NOT LIKE ?')) {
                    $stmt->bind_param('iss', $uid, $_POST['cid'], $defcid); $stmt->execute();
                    if ($stmt = $con->prepare('DELETE FROM customers__card__primary WHERE uid = ?')) {
                        $stmt->bind_param('i', $uid); $stmt->execute();
                        if ($chprim = $con->prepare('INSERT INTO customers__card__primary (cid, uid) VALUES (?, ?)')) {
                            $chprim->bind_param('si', $setprim, $uid); $chprim->execute(); $chprim->store_result(); die('200');
                        } else { die ("25"); } 
                    }
                } else { die ("26"); }
            }
        }
    } $stmt->close();
} else { die ("25"); } $con->close();
?>