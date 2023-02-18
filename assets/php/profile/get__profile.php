<?php session_start(); include($_SERVER['DOCUMENT_ROOT'].'/includes/inc.connect.php'); if (mysqli_connect_errno()) { die ("0"); } if (isset($_SESSION['id'])) {$uid = $_SESSION['id'];} else {die("43");}
if ($stmt = $con->prepare('SELECT customers.fullname, customers.email, customers.phone, customers.fax, customers__ship.settlement AS "sh__settlement", customers__ship.address AS "sh__address", customers__ship.postal AS "sh__postal",customers__inv.company, customers__inv.settlement, customers__inv.address, customers__inv.postal, customers__inv.tax FROM `customers` INNER JOIN customers__ship ON customers__ship.uid = customers.id INNER JOIN customers__inv ON customers__inv.uid = customers.id WHERE customers.id = ? AND customers__ship.uid = ? AND customers__inv.uid = ?')) {
    $stmt->bind_param('iii', $uid,$uid,$uid); $stmt->execute(); $result = $stmt->get_result();
    if($result->num_rows > 0) { $dt = $result->fetch_assoc(); $obj = new stdClass();
        $obj->fullname = $dt['fullname']; /*$obj->email = $dt['email'];*/ $obj->phone = $dt['phone'];$obj->fax = $dt['fax']; $obj->tax = $dt['tax']; $obj->settlement = $dt['settlement']; $obj->address = $dt['address'];
        $obj->postal = $dt['postal']; $obj->company = $dt['company']; $obj->sh__settlement = $dt['sh__settlement'];$obj->sh__address = $dt['sh__address']; $obj->sh__postal = $dt['sh__postal']; die(json_encode($obj));
    } else { die('30'); }
} else { die ("26"); } $stmt->close();
?>