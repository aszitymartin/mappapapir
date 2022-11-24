<?php session_start();
$DATABASE_HOST = 'localhost';$DATABASE_USER = 'root';$DATABASE_PASS = 'eKi=0630OG';$DATABASE_NAME = 'mappapapir';
$con = mysqli_connect($DATABASE_HOST, $DATABASE_USER, $DATABASE_PASS, $DATABASE_NAME);
if (mysqli_connect_errno()) { die ("0"); }
if (isset($_SESSION['id'])) {$uid = $_SESSION['id'];} else {die("43"); /* Nincs bejelentkezve */}
if ($stmt = $con->prepare('SELECT * FROM cart WHERE uid = ?')) {
    $stmt->bind_param('i', $uid); $stmt->execute(); $stmt->store_result();
    if ($stmt->num_rows > 0) {
        $sql = "SELECT cart.*, products.* FROM cart INNER JOIN products ON products.product_id = cart.pid WHERE uid = $uid";
        if ($result = mysqli_query($con, $sql)) { $num = mysqli_num_rows($result); $arr = array();
            if ($num > 0) { 
                while ($bsi = $result-> fetch_assoc()) { $object = new stdClass();
                    $object->id = $bsi['id']; $object->pid = $bsi['pid']; $object->quantity = $bsi['quantity']; $object->pquantity = $bsi['product_quantity']; $object->name = $bsi['product_name']; $object->brand = $bsi['product_brand']; $object->color = $bsi['product_color']; $object->price = $bsi['product_price'];
                    array_push($arr, $object);
                } die(json_encode($arr)); 
            } else {die("30");}
        }
    } else { die ("30"); exit; } $stmt->close();
} else { die ("25"); /* 25: Hiba tortent a PREPARE kozben */ } $con->close();
?>