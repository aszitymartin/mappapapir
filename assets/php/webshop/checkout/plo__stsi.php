<?php session_start();
include($_SERVER['DOCUMENT_ROOT'].'/includes/inc.connect.php'); if (mysqli_connect_errno()) { die ("0"); } $pid = $_POST['pid'];
if (isset($_SESSION['id'])) { $uid = $_SESSION['id'];} else {die("43"); } $quantity = $_POST['quantity'];
if ($stmt = $con->prepare('SELECT * FROM customers WHERE id = ?')) {
    $stmt->bind_param('i', $uid); $stmt->execute(); $stmt->store_result();
    if ($stmt->num_rows > 0) { $subt = $_POST['subtotal'];
        $sql = "SELECT * FROM customers WHERE id = $uid";
        if ($result = mysqli_query($con, $sql)) { $num = mysqli_num_rows($result);
            if ($num > 0) { 
                $uimn = $result-> fetch_assoc(); $gmoney = $uimn['money']; $nmoney = $gmoney - $subt;
                if ($stmt = $con->prepare('UPDATE customers__monet SET money = ? WHERE uid = ?')) {
                    $stmt->bind_param('ii', $nmoney, $uid);
                    $stmt->execute(); $stmt->store_result(); die("2005");
                } else { die ("25"); } $con->close();       
            } else {die("25");}
        }
    } else { die ("25"); exit; } $stmt->close();
} else { die ("25"); } $con->close();
?>