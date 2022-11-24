<?php require_once($_SERVER['DOCUMENT_ROOT'].'/config/db.inc.php'); $uid = $_SESSION['id'];

$card__stmt = $con->prepare('SELECT customers__card.cid, customers__card.cardname, customers__card.cardnum, customers__card.expiry, customers__card.value, customers__card__info.holder, customers__card__info.type, customers__card__info.provider FROM customers__card INNER JOIN customers__card__info ON customers__card__info.cid = customers__card.cid WHERE customers__card.cid LIKE (SELECT cid FROM customers__card__primary WHERE customers__card__primary.uid = ?)');
$card__stmt->bind_param('i', $uid);$card__stmt->execute();
$card__stmt->get_result();  $res = $card__stmt->get_result();
while ($ci = $res->fetch_assoc()) { $obj = new stdClass();
    $obj->cid = $ci['cid']; $obj->cardname = $ci['cardname']; $obj->cardnum = $ci['cardnum']; $obj->expiry = $ci['expiry']; $obj->value = $ci['value'];
    $obj->holder = $ci['holder']; $obj->type = $ci['type']; $obj->provider = $ci['provider'];
} die(json_encode($obj));