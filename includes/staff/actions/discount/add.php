<?php session_start();
$DATABASE_HOST = 'localhost';$DATABASE_USER = 'root';$DATABASE_PASS = 'eKi=0630OG';$DATABASE_NAME = 'mappapapir';
$con = mysqli_connect($DATABASE_HOST, $DATABASE_USER, $DATABASE_PASS, $DATABASE_NAME);
if (mysqli_connect_errno()) { die ("0"); } $code = $_POST['code']; $id = $_POST['id']; $price; $discounted;
if ($stmt = $con->prepare('SELECT product_id FROM product_discount WHERE product_id = ? AND product_discount.end > NOW()')) {
    $stmt->bind_param('i', $_POST['id']); $stmt->execute(); $stmt->store_result();
    if ($stmt->num_rows > 0) {die ("30"); exit;}
    else {
        $pr_sql = "SELECT products.* FROM products WHERE product_id = '".$id."' AND product_code = '".$code."'";
        $pr_res = $con-> query($pr_sql);
        if ($pr_res-> num_rows > 0) {while ($product = $pr_res-> fetch_assoc()) {$price = $product['product_price'];} } 
        $discounted = ceil(($price - (($price * $_POST['discount']) / 100)) / 5) * 5;
        if ($stmt = $con->prepare('INSERT INTO product_discount (code, product_id, discount, new_price, start, end) VALUES (?, ?, ?, ?, ?, ?)')) {
            $stmt->bind_param('siiiss', $_POST['code'], $_POST['id'], $_POST['discount'], $discounted, $_POST['start'], $_POST['end']);
            $stmt->execute(); echo "1"; // 1: Sikeres muvelet
        } else { die ("26"); /* 26: Hiba tortent az INSERT kozben */ }
    } $stmt->close();
} else { die ("25"); /* 25: Hiba tortent a PREPARE kozben */ } $con->close();
?>