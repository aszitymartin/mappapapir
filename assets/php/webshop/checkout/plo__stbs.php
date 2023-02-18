<?php session_start();
include($_SERVER['DOCUMENT_ROOT'].'/includes/inc.connect.php'); if (mysqli_connect_errno()) { die ("0"); }
if (isset($_SESSION['id'])) { $uid = $_SESSION['id'];} else {die("43"); }
if ($stmt = $con->prepare('SELECT * FROM customers WHERE id = ?')) {
    $stmt->bind_param('i', $uid); $stmt->execute(); $stmt->store_result();
    if ($stmt->num_rows > 0) { 
        $sql = "SELECT * FROM customers__money WHERE uid = $uid";
        if ($result = mysqli_query($con, $sql)) { $num = mysqli_num_rows($result); $arr = array();
            if ($num > 0) { 
                $uimn = $result-> fetch_assoc();
                if ($uimn["money"] < ($_POST['subtotal'] + $_POST['shipfee'])) { die ("29"); } else { die("1999"); }
            } else {die("30");}
        }
    } else { die ("29"); exit; } $stmt->close();
} else { die ("25"); } $con->close();

?>