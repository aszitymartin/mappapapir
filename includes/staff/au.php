<?php session_start(); include($_SERVER['DOCUMENT_ROOT'].'/includes/inc.connect.php');
if ($_POST['id'] == 0) {die ('false');}
if ($stmt = $con->prepare('SELECT password FROM customers WHERE id = ?')) {
    $stmt->bind_param('i', $_POST['id']);$stmt->execute();$stmt->store_result();
    if ($stmt->num_rows > 0) { $stmt->bind_result($password);$stmt->fetch();
        if (password_verify($_POST['password'], $password)) {$_SESSION["token"] = hash_hmac('sha256', "tokenString", "t2o0k0e0n3");$_SESSION['token_expiry'] = time();die('true');
        } else {die('false');}
    } else {die('false');} $stmt->close();
} ?>