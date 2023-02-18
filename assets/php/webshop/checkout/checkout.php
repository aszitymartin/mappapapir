<?php session_start(); include($_SERVER['DOCUMENT_ROOT'].'/includes/inc.connect.php'); if (mysqli_connect_errno()) { die ("0"); } if (isset($_SESSION['id'])) {$uid = $_SESSION['id'];} else {die("43");}
if ($stmt = $con->prepare('SELECT * FROM cart WHERE uid = ?')) {
    $stmt->bind_param('i', $uid); $stmt->execute(); $stmt->store_result();
    if ($stmt->num_rows > 0) {
        $sql = "SELECT cart.*, products.* FROM cart INNER JOIN products ON products.product_id = cart.pid WHERE uid = $uid";
        if ($result = mysqli_query($con, $sql)) { $num = mysqli_num_rows($result); $arr = array();
            if ($num > 0) { 
                while ($bsi = $result-> fetch_assoc()) { $object = new stdClass(); $pid = $bsi['pid'];
                    $disc_sql = "SELECT product_discount.new_price FROM product_discount WHERE product_discount.product_id = $pid"; $disc_res = $con-> query($disc_sql);
                    if ($disc_res-> num_rows > 0) { $disc = $disc_res-> fetch_assoc(); $object->price = $disc['new_price'];
                    } else { $object->price = $bsi['product_price']; }
                    $object->id = $bsi['id']; $object->pid = $bsi['pid']; $object->quantity = $bsi['quantity']; $object->pquantity = $bsi['product_quantity']; $object->name = $bsi['product_name']; $object->brand = $bsi['product_brand']; $object->color = $bsi['product_color'];
                    array_push($arr, $object);
                } die(json_encode($arr)); 
            } else {die("30");}
        }
    } else { die ("30"); exit; } $stmt->close();
} else { die ("25"); } $con->close();
?>