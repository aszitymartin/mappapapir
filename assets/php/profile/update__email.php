<?php session_start(); include($_SERVER['DOCUMENT_ROOT'].'/includes/inc.connect.php'); if (mysqli_connect_errno()) { die ("0"); } if (isset($_SESSION['id'])) {$uid = $_SESSION['id'];} else {die("43"); }
if ($stmt = $con->prepare('UPDATE customers SET email = ? WHERE id = ?')) {
    $stmt->bind_param('si', $_POST['email'], $uid); $stmt->execute();
    if ($stmt = $con->prepare('UPDATE notify SET email = ? WHERE uid = ?')) {
        $stmt->bind_param('si', $_POST['email'], $uid); $stmt->execute();
        if ($stmt = $con->prepare('UPDATE orders__sh SET email = ? WHERE uid = ?')) {
            $stmt->bind_param('si', $_POST['email'], $uid); $stmt->execute();
            if ($stmt = $con->prepare('UPDATE u__email SET email = ?, date = NOW() WHERE uid = ?')) {
                $stmt->bind_param('si', $_POST['email'], $uid); $stmt->execute(); 
                if (isset($_POST['subscribe'])) { $e__banned = 1;
                    if ($stmt = $con->prepare('SELECT * FROM e__banned WHERE uid = ? AND email = ?')) { $stmt->bind_param('is', $uid, $_POST['email']); $stmt->execute(); $result = $stmt->get_result(); if($result->num_rows > 0) { $e__banned = 1; } else { $e__banned = 0; }
                        if ($stmt = $con->prepare('INSERT INTO e__subs (uid, email, disc) VALUES (?, ?, ?)')) { $stmt->bind_param('isi', $uid, $_POST['email'], $e__banned); $stmt->execute(); die("200"); }
                    }
                } else { die("200"); }
            } else { 
                if ($stmt = $con->prepare('UPDATE customers SET email = ? WHERE id = ?')) { $stmt->bind_param('si', $_POST['original'], $uid); $stmt->execute();
                    if ($stmt = $con->prepare('UPDATE notify SET email = ? WHERE uid = ?')) { $stmt->bind_param('si', $_POST['original'], $uid); $stmt->execute(); 
                        if ($stmt = $con->prepare('UPDATE orders__sh SET email = ? WHERE uid = ?')) { $stmt->bind_param('si', $_POST['original'], $uid); $stmt->execute(); die("410"); }
                    }
                }
            }
        } else { 
            if ($stmt = $con->prepare('UPDATE customers SET email = ? WHERE id = ?')) { $stmt->bind_param('si', $_POST['original'], $uid); $stmt->execute();
                if ($stmt = $con->prepare('UPDATE notify SET email = ? WHERE uid = ?')) { $stmt->bind_param('si', $_POST['original'], $uid); $stmt->execute(); die("410"); }
            }
        }
    } else { if ($stmt = $con->prepare('UPDATE customers SET email = ? WHERE id = ?')) { $stmt->bind_param('si', $_POST['original'], $uid); $stmt->execute(); die("410");} die ("26"); }
} else { die ("26"); }
$stmt->close();
?>