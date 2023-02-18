<?php session_start();
include($_SERVER['DOCUMENT_ROOT'].'/includes/inc.connect.php'); if (mysqli_connect_errno()) { die ("0"); } $pid = $_POST['pid'];
if (isset($_SESSION['id'])) { $uid = $_SESSION['id'];} else {die("43"); } $quantity = $_POST['quantity'];
if ($stmt = $con->prepare('SELECT * FROM orders WHERE uid = ? AND pid = ? AND quantity = ? AND subtotal = ?')) {
    $stmt->bind_param('iiii', $uid, $pid, $quantity, $_POST['subtotal']); $stmt->execute(); $stmt->store_result();
    if ($stmt->num_rows > 0) { $subt = $_POST['subtotal'];
        $sql = "SELECT * FROM orders WHERE uid = $uid AND pid = $pid AND quantity = $quantity AND subtotal = $subt";
        if ($result = mysqli_query($con, $sql)) { $num = mysqli_num_rows($result); $arr = array();
            if ($num > 0) { 
                $uimn = $result-> fetch_assoc(); $oid = $uimn['id'];
                if ($stmt = $con->prepare('INSERT INTO orders__sh (oid, uid, fullname, email, settlement, address, postal, phone, note) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)')) {
                    $stmt->bind_param('iissssiis', $oid, $uid, $_POST['fullname'], $_POST['email'], $_POST['settlement'], $_POST['address'], $_POST['postal'], $_POST['phone'], $_POST['note']);
                    $stmt->execute(); $stmt->store_result(); die("2004");
                } else { die ("25"); } $con->close();       
            } else {die("25");}
        }
    } else { die ("25"); exit; } $stmt->close();
} else { die ("25"); } $con->close();
?>