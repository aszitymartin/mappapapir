<?php require_once($_SERVER['DOCUMENT_ROOT'].'/includes/inc.php');

$sql = "SELECT vouchers.pid, code, value, description, valid, category
FROM vouchers 
INNER JOIN products__category ON products__category.pid = vouchers.id 
WHERE (SELECT category FROM products__category WHERE pid = ".$_POST['pid'].") LIKE category";
$res = $con->query($sql);
if ($res->num_rows > 0) {
    $dt = $res->fetch_assoc(); $obj = new stdClass();
    $obj->code = $dt['code']; $obj->value = $dt['value']; $obj->description = $dt['description'];
    $obj->valid = $dt['valid']; $obj->category = $dt['category'];
    die(json_encode($obj));
} else { die('Érvénytelen kuponkódot adott meg.'); }
?>