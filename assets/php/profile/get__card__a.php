<?php session_start(); include($_SERVER['DOCUMENT_ROOT'].'/includes/inc.connect.php'); if (mysqli_connect_errno()) { die ("0"); } if (isset($_POST['uid'])) {$uid = $_POST['uid'];} else {die("43");}
if ($stmt = $con->prepare('SELECT customers__card.cardname, customers__card.cid AS "ccid", customers__card.value, customers__card.expiry, customers__card.cardname, customers__card.cvc, customers__card__info.number, customers__card__info.holder, customers__card__primary.cid FROM customers__card INNER JOIN customers__card__info ON customers__card__info.cid = customers__card.cid INNER JOIN customers__card__primary ON customers__card__primary.uid = customers__card.uid WHERE customers__card__info.cid = ? AND customers__card__info.uid = ? AND customers__card.cid = ? AND customers__card.uid = ? AND customers__card__primary.uid = ?;')) {
    $stmt->bind_param('sisii', $_POST['cid'],$uid,$_POST['cid'],$uid,$uid); $stmt->execute(); $result = $stmt->get_result();
    if($result->num_rows > 0) { $dt = $result->fetch_assoc(); $obj = new stdClass();
        $obj->cardname = $dt['cardname']; $obj->expiry = $dt['expiry']; $obj->cvc = $dt['cvc']; $obj->cid = $dt['ccid'];
        $obj->cardnum = $dt['number']; $obj->holder = $dt['holder']; $obj->primary = $dt['cid']; $obj->value = $dt['value'];
        die(json_encode($obj));
    } else { die('30'); }
} else { die ("26"); } $stmt->close();
?>