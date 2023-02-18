<?php session_start(); include($_SERVER['DOCUMENT_ROOT'].'/includes/inc.connect.php'); if (mysqli_connect_errno()) { die ("0"); } if (isset($_POST['id'])) {$uid = $_POST['id'];} else {die("43"); }
$password = password_hash($_POST['password'], PASSWORD_DEFAULT);
if ($stmt = $con->prepare('UPDATE customers SET password = ? WHERE id = ?')) {
    $stmt->bind_param('si', $password, $uid); $stmt->execute();
    if ($stmt = $con->prepare('UPDATE u__password SET password = ?, date = NOW() WHERE uid = ?')) { $stmt->bind_param('si', $password, $uid); $stmt->execute();
        $log_categ = "Felhasználó szerkesztése"; $log_desc = "#".$uid." felhasználó jelszavát megváltoztatta";
        if ($log = $con->prepare('INSERT INTO log (uid, ip, category, description) VALUES(?,?,?,?)')) {
            $log->bind_param('isss', $_SESSION['id'], $_POST['ip'], $log_categ, $log_desc); $log->execute(); $log->close(); die('200');
        } else { die ("Hiba történt a logolás közben."); }
    }
    else { if ($stmt = $con->prepare('UPDATE customers SET password = ? WHERE id = ?')) { $stmt->bind_param('si', $password, $uid); $stmt->execute(); die("410");} die ("26"); }
} else { die ("26"); }
$stmt->close();
?>