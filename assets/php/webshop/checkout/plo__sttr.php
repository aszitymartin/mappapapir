<?php session_start();
$DATABASE_HOST = 'localhost';$DATABASE_USER = 'root';$DATABASE_PASS = 'eKi=0630OG';$DATABASE_NAME = 'mappapapir';
$con = mysqli_connect($DATABASE_HOST, $DATABASE_USER, $DATABASE_PASS, $DATABASE_NAME); if (mysqli_connect_errno()) { die ("0"); } $pid = $_POST['pid'];
if (isset($_SESSION['id'])) { $uid = $_SESSION['id'];} else {die("43"); } $quantity = $_POST['quantity'];
if ($stmt = $con->prepare('SELECT * FROM products WHERE product_id = ? AND product_quantity >= ?')) {
    $stmt->bind_param('ii', $pid, $quantity); $stmt->execute(); $stmt->store_result();
    if ($stmt->num_rows > 0) {
        $sql = "SELECT * FROM products WHERE product_id = $pid AND product_quantity >= $quantity";
        if ($result = mysqli_query($con, $sql)) { $num = mysqli_num_rows($result);
            if ($num > 0) { $uimn = $result-> fetch_assoc(); $prquantity = $uimn['product_quantity']; $npquantity = $prquantity - $quantity;
                if ($stmt = $con->prepare('UPDATE products SET product_quantity = ? WHERE product_id = ?')) {
                    $stmt->bind_param('ii', $npquantity, $pid); $stmt->execute(); $stmt->store_result(); die ("2002"); $stmt->close();
                } else { die ("25"); } $con->close();
            } else {die("30");}
        }
    } else { die ("31"); exit; } $stmt->close();
} else { die ("25"); } $con->close();
?>