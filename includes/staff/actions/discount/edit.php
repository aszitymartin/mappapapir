<?php session_start();
include($_SERVER['DOCUMENT_ROOT'].'/includes/inc.connect.php');
if (mysqli_connect_errno()) { die ("0"); } $code = $_POST['code']; $id = $_POST['id']; $price; $discounted;
if ($stmt = $con->prepare('SELECT product_id FROM product_discount WHERE product_id = ? AND product_discount.end > NOW()')) {
    $stmt->bind_param('i', $_POST['id']); $stmt->execute(); $stmt->store_result();
    if ($stmt->num_rows > 0) {
        $pr_sql = "SELECT products.* FROM products WHERE product_id = '".$id."'";
        $pr_res = $con-> query($pr_sql);
        if ($pr_res-> num_rows > 0) {while ($product = $pr_res-> fetch_assoc()) {$price = $product['product_price'];} } 
        $discounted = ceil(($price - (($price * $_POST['discount']) / 100)) / 5) * 5;
        if ($stmt = $con->prepare('UPDATE product_discount SET discount = ?, new_price = ?, start = ?, end = ? WHERE product_id = '.$id.'')) {
            $stmt->bind_param('iiss', $_POST['discount'], $discounted, $_POST['start'], $_POST['end']);
            $stmt->execute(); echo "1"; // 1: Sikeres muvelet
        } else { die ("26"); /* 26: Hiba tortent az INSERT kozben */ }
    } else {die ("30"); exit;} $stmt->close();
} else { die ("25"); /* 25: Hiba tortent a PREPARE kozben */ } $con->close();
?>