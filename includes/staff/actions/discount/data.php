<?php session_start();
include($_SERVER['DOCUMENT_ROOT'].'/includes/inc.connect.php');
if (mysqli_connect_errno()) { die ("0"); } $id = $_POST['pid'];
if ($stmt = $con->prepare('SELECT * FROM product_discount WHERE product_id = ? AND product_discount.end > NOW()')) {
    $stmt->bind_param('i', $id); $stmt->execute(); $stmt->store_result();
    if ($stmt->num_rows > 0) {$pr_sql = "SELECT * FROM product_discount WHERE product_id = $id AND product_discount.end > NOW()";$pr_res = $con-> query($pr_sql);
        if ($pr_res-> num_rows > 0) {while ($product = $pr_res-> fetch_assoc()) {$object = new stdClass();$object->status = true;$object->pid = $product['product_id'];$object->dis = $product['discount'];$object->sta = $product['start'];$object->end = $product['end'];die(json_encode($object));}}
    } else {die ("30"); exit;} $stmt->close();
} else { die ("25"); /* 25: Hiba tortent a PREPARE kozben */} $con->close();
?>