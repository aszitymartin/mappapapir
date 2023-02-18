<?php session_start(); include($_SERVER['DOCUMENT_ROOT'].'/includes/inc.connect.php'); if (mysqli_connect_errno()) { die ("0"); } if (isset($_SESSION['id'])) {$uid = $_SESSION['id'];} else {die("43");}
if ($stmt = $con->prepare('SELECT cid FROM customers__card__info WHERE provider = "Mappa Papír Kft." AND uid = ?')) { $stmt->bind_param('i', $uid); $stmt->execute(); $result = $stmt->get_result();
    if($result->num_rows > 0) { $dt = $result->fetch_assoc(); $obj = new stdClass(); $obj->cid = $dt['cid']; die(json_encode($obj)); } else { die('30'); }
} else { die ("26"); } $stmt->close();
?>