<?php session_start(); $DATABASE_HOST = 'localhost';$DATABASE_USER = 'root';$DATABASE_PASS = 'eKi=0630OG';$DATABASE_NAME = 'mappapapir'; $con = mysqli_connect($DATABASE_HOST, $DATABASE_USER, $DATABASE_PASS, $DATABASE_NAME); if (mysqli_connect_errno()) { die ("0"); } if (isset($_SESSION['id'])) {$uid = $_SESSION['id'];} else {die("43");}
if ($stmt = $con->prepare('SELECT customers__card.cardname, customers__card.expiry, customers__card.cardname, customers__card.cvc, customers__card__info.number, customers__card__info.holder, customers__card__primary.cid FROM customers__card INNER JOIN customers__card__info ON customers__card__info.cid = customers__card.cid INNER JOIN customers__card__primary ON customers__card__primary.uid = customers__card.uid WHERE customers__card__info.cid = ? AND customers__card__info.uid = ? AND customers__card.cid = ? AND customers__card.uid = ? AND customers__card__primary.uid = ?;')) {
    $stmt->bind_param('sisii', $_POST['cid'],$uid,$_POST['cid'],$uid,$uid); $stmt->execute(); $result = $stmt->get_result();
    if($result->num_rows > 0) { $dt = $result->fetch_assoc(); $obj = new stdClass();
        $obj->cardname = $dt['cardname']; $obj->expiry = $dt['expiry']; $obj->cvc = $dt['cvc'];
        $obj->cardnum = $dt['number']; $obj->holder = $dt['holder']; $obj->primary = $dt['cid'];
        die(json_encode($obj));
    } else { die('30'); }
} else { die ("26"); } $stmt->close();
?>