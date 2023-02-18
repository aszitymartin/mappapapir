<?php session_start();
include($_SERVER['DOCUMENT_ROOT'].'/includes/inc.connect.php');
if (mysqli_connect_errno()) { die ("0"); } $id = $_POST['pid'];
if ($stmt = $con->prepare('SELECT * FROM products WHERE product_id = ?')) {
    $stmt->bind_param('i', $id); $stmt->execute(); $stmt->store_result();
    if ($stmt->num_rows > 0) {$pr_sql = "SELECT * FROM products WHERE product_id = $id";$pr_res = $con-> query($pr_sql);
        if ($pr_res-> num_rows > 0) {while ($product = $pr_res-> fetch_assoc()) {$object = new stdClass();$object->status = true;$object->pid = $product['product_id'];$object->pcode = $product['product_code'];$object->quantity = $product['product_quantity'];$object->qunit = $product['product_quantity_unit'];$object->brand = $product['product_brand'];$object->type = $product['product_type'];$object->color = $product['product_color'];$object->name = $product['product_name'];$object->info = $product['product_info'];$object->width = $product['product_width'];$object->wunit = $product['product_width_unit'];$object->height = $product['product_height'];$object->hunit = $product['product_height_unit'];$object->length = $product['product_length'];$object->lunit = $product['product_length_unit'];$object->image = $product['product_image'];$object->price = $product['product_price'];$object->punit = $product['product_price_unit'];die(json_encode($object));}}
    } else {die ("30"); exit;} $stmt->close();
} else { die ("25"); /* 25: Hiba tortent a PREPARE kozben */} $con->close();
?>