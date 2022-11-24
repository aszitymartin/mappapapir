<?php require_once($_SERVER['DOCUMENT_ROOT'].'/config/db.inc.php'); $uid = $_POST['uid'];
if ($csub__stmt = $con->prepare('SELECT sub FROM customers__card__subscription WHERE uid = ?')) {
    $csub__stmt->bind_param('i', $uid);$csub__stmt->execute();$csub__stmt->execute(); $cs__result = $csub__stmt->get_result();
    $cs = $cs__result->fetch_assoc(); $cursub = $cs['sub']; die($cursub.'');
} die('30');

?>