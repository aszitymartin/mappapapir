<?php require_once($_SERVER['DOCUMENT_ROOT'].'/includes/inc.php');

$sql = "SELECT name, thumbnail, brand, color, style, model, base, discount, quantity, unit, backorder FROM products
INNER JOIN products__variations ON products__variations.pid = products.id INNER JOIN products__pricing ON products__pricing.pid = products.id
INNER JOIN products__inventory ON products__inventory.pid = products.id WHERE products.id = " . $_GET['pid'];
$res = $con->query($sql); $obj = new stdClass();
while ($dt = $res->fetch_assoc()) {
    $obj->name = $dt['name']; $obj->thumbnail = $dt['thumbnail'];
    $obj->brand = $dt['brand']; $obj->color = $dt['color'];
    $obj->style = $dt['style']; $obj->model = $dt['model'];
    $obj->base = $dt['base']; $obj->discount = $dt['discount'];
    $obj->quantity = $dt['quantity']; $obj->unit = $dt['unit']; $obj->backorder = $dt['backorder'];
} die(json_encode($obj));

?>