<?php session_start(); $DATABASE_HOST = 'localhost';$DATABASE_USER = 'root';$DATABASE_PASS = 'eKi=0630OG';$DATABASE_NAME = 'mappapapir'; $con = mysqli_connect($DATABASE_HOST, $DATABASE_USER, $DATABASE_PASS, $DATABASE_NAME); if (mysqli_connect_errno()) { die ("0"); } if (isset($_SESSION['id'])) {$uid = $_SESSION['id'];} else {die("43");}
if ($stmt = $con->prepare('SELECT password FROM customers  WHERE id = ?')) {
    $stmt->bind_param('i', $uid); $stmt->execute(); $result = $stmt->get_result();
    if($result->num_rows > 0) { $data = $result->fetch_assoc();
        if (password_verify($_POST['original'], $data['password'])) { die ("200"); } else { die("410"); } }
    else { die('30'); }
} else { die ("26"); } $stmt->close();
?>