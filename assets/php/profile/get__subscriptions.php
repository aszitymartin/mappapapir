<?php session_start(); include($_SERVER['DOCUMENT_ROOT'].'/includes/inc.connect.php'); if (mysqli_connect_errno()) { die ("0"); } if (isset($_SESSION['id'])) {$uid = $_SESSION['id'];} else {die("43");}
$obj = new stdClass();
if ($stmt = $con->prepare('SELECT * FROM e__subs WHERE uid = ?')) { 
    $stmt->bind_param('i', $uid); $stmt->execute(); $result = $stmt->get_result();
    if ($result->num_rows > 0) {
        $obj->newsletter = true;
    }
}

if ($stmt = $con->prepare('SELECT notify.pid, products.name FROM `notify` INNER JOIN products ON products.id = notify.pid WHERE notify.uid = ?')) { 
    $stmt->bind_param('i', $uid); $stmt->execute(); $notif__res = $stmt->get_result();
    if ($notif__res->num_rows > 0) {
        $obj->notify = $notif__res->num_rows;
    }
}

die(json_encode($obj));