<?php session_start(); include($_SERVER['DOCUMENT_ROOT'].'/includes/inc.connect.php'); if (mysqli_connect_errno()) { die ("0"); } if (isset($_SESSION['id'])) {$uid = $_SESSION['id'];} else {die("43");}
if ($stmt = $con->prepare('SELECT customers.email, customers__lang.language, customers__lang.capital, customers__lang.offset FROM customers INNER JOIN customers__lang ON customers__lang.uid = customers.id WHERE customers.id = ? AND customers__lang.uid = ?')) {
    $stmt->bind_param('ii', $uid,$uid); $stmt->execute(); $result = $stmt->get_result();
    if($result->num_rows > 0) { $dt = $result->fetch_assoc(); $obj = new stdClass();
        $obj->email = $dt['email'];$obj->language = $dt['language'];$obj->capital = $dt['capital'];$obj->offset = $dt['offset']; die(json_encode($obj));
    } else { die('30'); }
} else { die ("26"); } $stmt->close();
?>