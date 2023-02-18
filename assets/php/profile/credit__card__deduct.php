<?php session_start(); include($_SERVER['DOCUMENT_ROOT'].'/includes/inc.connect.php'); if (mysqli_connect_errno()) { die ("0"); } $uid = $_POST['uid'];
if ($stmt = $con->prepare('SELECT customers__card.value FROM customers__card WHERE customers__card.cid = ? AND customers__card.uid = ?')) {
    $stmt->bind_param('si', $_POST['cid'],$uid); $stmt->execute(); $result = $stmt->get_result();
    if($result->num_rows > 0) { $dt = $result->fetch_assoc(); $value = $dt['value']; $nv = $value - $_POST['value'];
        if ($stmt = $con->prepare("UPDATE customers__card SET value = ? WHERE uid = ? AND cid = ?")) {
            $stmt->bind_param("iis", $nv, $uid, $_POST['cid']); $stmt->execute(); $stmt->close();
            $ct_item = "cr_0"; $ct_price = $_POST['value']; $ct_note = $_POST['desc'];
            if ($stmt = $con->prepare("INSERT INTO customers__transactions (uid, cid, item, price, type, note) VALUES (?, ?, ?, ?, 0, ?)")) {
                $stmt->bind_param("issis", $uid, $_POST['cid'], $ct_item, $ct_price, $ct_note); $stmt->execute(); $stmt->close();
                $log_categ = "Felhasználó szerkesztése"; $log_desc = "#".$uid." felhasználónak ". $_POST['value'] ." forintot vont le. Új egyenleg: " . $nv . " Ft";
                if ($log = $con->prepare('INSERT INTO log (uid, ip, category, description) VALUES(?,?,?,?)')) {
                    $log->bind_param('isss', $_SESSION['id'], $_POST['ip'], $log_categ, $log_desc); $log->execute(); $log->close(); die('200');
                } else { die ("Hiba lépett fel a folyamat közben."); }
            }
        }
    } else { die('Nem létezik ilyen kártya'); }
} else { die ("Hiba lépett fel a folyamat közben"); } $stmt->close();
?>