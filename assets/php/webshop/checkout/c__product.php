<?php session_start();
$DATABASE_HOST = 'localhost';$DATABASE_USER = 'root';$DATABASE_PASS = 'eKi=0630OG';$DATABASE_NAME = 'mappapapir';
$con = mysqli_connect($DATABASE_HOST, $DATABASE_USER, $DATABASE_PASS, $DATABASE_NAME);
if (mysqli_connect_errno()) { die ("0"); } $pid = $_POST['pid'];
if (isset($_SESSION['id'])) {$uid = $_SESSION['id'];} else {die("43"); /* Nincs bejelentkezve */}
if ($stmt = $con->prepare('SELECT * FROM products WHERE product_id = ?')) {
    $stmt->bind_param('i', $pid); $stmt->execute(); $stmt->store_result();
    if ($stmt->num_rows > 0) {
        $sql = "SELECT * FROM products WHERE product_id = $pid";
        if ($result = mysqli_query($con, $sql)) { $num = mysqli_num_rows($result); $arr = array();
            if ($num > 0) { 
                while ($bsi = $result-> fetch_assoc()) { $object = new stdClass();
                    $object->pid = $bsi['product_id']; $object->name = $bsi['product_name']; $object->brand = $bsi['product_brand']; $object->color = $bsi['product_color']; $object->price = $bsi['product_price']; $object->quantity = $bsi['product_quantity'];
                    array_push($arr, $object);
                } die(json_encode($arr)); 
            } else {die("30");}
        }
    } else { die ("30"); exit; } $stmt->close();
} else { die ("25"); /* 25: Hiba tortent a PREPARE kozben */ } $con->close();
?>