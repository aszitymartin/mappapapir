<?php
$DATABASE_HOST = 'localhost';$DATABASE_USER = 'root';$DATABASE_PASS = 'eKi=0630OG';$DATABASE_NAME = 'mappapapir';
$con = mysqli_connect($DATABASE_HOST, $DATABASE_USER, $DATABASE_PASS, $DATABASE_NAME); if (mysqli_connect_errno()) { die ("0"); }
$id = $_POST['pid'];
$sql = "SELECT * FROM products WHERE product_id = $id";
$resp = $con-> query($sql);
if ($resp-> num_rows > 0) {
    while ($info = $resp-> fetch_assoc()) {
        $object = new stdClass();
        $object->code = $info['product_code']; $object->brand = $info['product_brand'];
        $object->name = $info['product_name']; $object->price = $info['product_price'];
        $object->unit = $info['product_price_unit']; $object->id = $info['product_id'];
        $object->color = $info['product_color'];
        die(json_encode($object));
    }
}
?>