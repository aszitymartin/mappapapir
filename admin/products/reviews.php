<?php
$DATABASE_HOST = 'localhost';$DATABASE_USER = 'root';$DATABASE_PASS = 'eKi=0630OG';$DATABASE_NAME = 'mappapapir';$con = mysqli_connect($DATABASE_HOST, $DATABASE_USER, $DATABASE_PASS, $DATABASE_NAME);
$con->query("SET CHARACTER SET utf8mb4"); if (mysqli_connect_errno()) {header ("Location: /500");} $pid = $_POST['pid'];
$pr_sql = "SELECT * FROM `reviews` WHERE pid = $pid"; $pr_res = $con-> query($pr_sql); $revarr = array();
if ($pr_res-> num_rows > 0) { while ($rev = $pr_res-> fetch_assoc()) { $object = new stdClass(); $uid = $rev['uid']; $object->uid = $rev['uid'];$object->rid = $rev['id'];$object->pid = $rev['pid'];$object->description = $rev['description'];$object->stars = $rev['stars'];$object->date = $rev['date'];
    $uin__sql = "SELECT customers.fullname, customers__header.initials, customers__header.color FROM customers INNER JOIN customers__header ON customers__header.uid = customers.id WHERE customers.id = $uid"; $uin__res = $con-> query($uin__sql);
    if ($uin__res-> num_rows > 0) { $uin = $uin__res-> fetch_assoc(); $object->fullname = $uin['fullname']; $object->initials = $uin['initials']; $object->color = $uin['color']; }
    array_push($revarr, $object);
} die(json_encode($revarr));
}
?>