<?php session_start(); include($_SERVER['DOCUMENT_ROOT'].'/includes/inc.connect.php'); if (mysqli_connect_errno()) { die ("0"); } $uid = $_POST['id'];
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
                            $chprim->bind_param('si', $setprim, $uid); $chprim->execute(); $chprim->store_result();
                            $log_categ = "Felhasználó szerkesztése"; $log_desc = "#".$uid." felhasználónak ".$cid." kártyáját törölte.";
                            if ($log = $con->prepare('INSERT INTO log (uid, ip, category, description) VALUES(?,?,?,?)')) {
                                $log->bind_param('isss', $_SESSION['id'], $_POST['ip'], $log_categ, $log_desc); $log->execute(); $log->close(); die('200');
                            } else { die ("Hiba lépett fel a folyamat közben."); }
                        } else { die ("25"); } 
                    }
                } else { die ("26"); }
            }
        }
    } $stmt->close();
} else { die ("25"); } $con->close();
?>