<?php session_start();
$DATABASE_HOST = 'localhost';$DATABASE_USER = 'root';$DATABASE_PASS = 'eKi=0630OG';$DATABASE_NAME = 'mappapapir';
$con = mysqli_connect($DATABASE_HOST, $DATABASE_USER, $DATABASE_PASS, $DATABASE_NAME); if (mysqli_connect_errno()) { die ("0"); } $pid = $_POST['pid'];
if (isset($_SESSION['id'])) { $uid = $_SESSION['id'];} else {die("43"); } $quantity = $_POST['quantity'];
if ($stmt = $con->prepare('SELECT * FROM products WHERE product_id = ? AND product_quantity >= ?')) {
    $stmt->bind_param('ii', $pid, $quantity); $stmt->execute(); $stmt->store_result();
    if ($stmt->num_rows > 0) {
        $sql = "SELECT * FROM products WHERE product_id = $pid AND product_quantity >= $quantity";
        if ($result = mysqli_query($con, $sql)) { $num = mysqli_num_rows($result);
            if ($num > 0) { $uimn = $result-> fetch_assoc(); $prquantity = $uimn['product_quantity']; $npquantity = $prquantity + $quantity; $subt = $_POST['subtotal'];
                $sql = "SELECT * FROM orders WHERE uid = $uid AND pid = $pid AND quantity = $quantity AND subtotal = $subt";
                if ($result = mysqli_query($con, $sql)) { $num = mysqli_num_rows($result);
                    if ($num > 0) { 
                        $uimn = $result-> fetch_assoc(); $oid = $uimn['id'];
                        if ($stmt = $con->prepare('DELETE FROM orders__sh WHERE oid = ? AND uid = ?')) {
                            $stmt->bind_param('ii', $oid, $uid); $stmt->execute(); $stmt->store_result();
                            if ($stmt = $con->prepare('UPDATE products SET product_quantity = ? WHERE product_id = ?')) {
                                $stmt->bind_param('ii', $npquantity, $pid); $stmt->execute(); $stmt->store_result(); $stmt->close();
                                if ($stmt = $con->prepare('DELETE FROM orders WHERE uid = ? AND pid = ? AND quantity = ? AND subtotal = ?')) {
                                    $stmt->bind_param('iiii', $uid, $pid, $quantity, $_POST['subtotal']); $stmt->execute(); $stmt->store_result(); die("3003");
                                } else { die ("25"); } $con->close();
                            } else { die ("25"); } $con->close();
                        } else { die ("25"); } $con->close();
                    }
                }
            } else {die("30");}
        }
    } else { die ("31"); exit; } $stmt->close();
} else { die ("25"); } $con->close();
?>