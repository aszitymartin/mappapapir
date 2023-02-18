<?php session_start();
include($_SERVER['DOCUMENT_ROOT'].'/includes/inc.connect.php');
if (mysqli_connect_errno()) { die ("0"); }
if (isset($_SESSION['id'])) {$uid = $_SESSION['id'];} else {die("43"); /* Nincs bejelentkezve */ } $email = $_POST['email']; $dsc = 1;

if ($_POST['e__action'] == 0) {
    if ($stmt = $con->prepare('SELECT email FROM e__subs WHERE uid = ?')) {
        $stmt->bind_param('i', $uid); $stmt->execute(); $stmt->store_result();
        if ($stmt->num_rows > 0) { die ("406"); exit; }
        else {
            if ($stmt = $con->prepare('SELECT email FROM e__subs WHERE email = ?')) {
                $stmt->bind_param('s', $email); $stmt->execute(); $stmt->store_result();
                if ($stmt->num_rows > 0) { die ("30"); exit; }
                else { 
                    
                    if ($stmt = $con->prepare('SELECT uid FROM e__banned WHERE uid = ?')) {
                        $stmt->bind_param('i', $uid); $stmt->execute(); $stmt->store_result();
                        if ($stmt->num_rows > 0) {
                            if ($bstmt = $con->prepare('INSERT INTO e__subs (uid, email, disc) VALUES (?, ?, ?)')) {
                                $bstmt->bind_param('isi', $uid, $email, $dsc); $bstmt->execute(); die('200');
                            } else { die ("26"); }
                        } else { 
                            if ($nstmt = $con->prepare('INSERT INTO e__subs (uid, email) VALUES (?, ?)')) {
                                $nstmt->bind_param('is', $uid, $email); $nstmt->execute(); die('200');
                            } else { die ("26"); }
                        }
                    }

                } $stmt->close();
            } else { die ("25"); }
        }
    } else { die ("25"); } $con->close();
} else if ($_POST['e__action'] == 1) {
    if ($stmt = $con->prepare('SELECT uid, email FROM e__subs WHERE uid = ?')) {
        $stmt->bind_param('i', $uid); $stmt->execute(); $stmt->store_result();
        if ($stmt->num_rows > 0) { $res = $con-> query("SELECT uid, email FROM e__subs WHERE uid = $uid"); $mail = $res-> fetch_assoc(); $eml = $mail['email'];
            if ($stmt = $con->prepare('DELETE FROM e__subs WHERE uid = ?')) { $stmt->bind_param('i', $uid); $stmt->execute();
                // A torolt email cimet es uid-t elmentjuk az 'e__banned' tablaba, hogy kesobb tudjuk, hogy ez az email nem jogosult promociora
                if ($stmt = $con->prepare('SELECT uid, email FROM e__banned WHERE uid = ? AND email = ?')) { $stmt->bind_param('is', $uid, $eml); $stmt->execute(); $stmt->store_result();
                    if ($stmt->num_rows < 1) { if ($stmt = $con->prepare('INSERT INTO e__banned (uid, email) VALUES (?, ?)')) { $stmt->bind_param('is', $uid, $eml); $stmt->execute(); die("200"); } }
                } die('200');
            } else { die ("26"); }
        } else { die ("406"); exit; }
    } else { die ("25"); } $con->close();
} else { die("400"); }
?>