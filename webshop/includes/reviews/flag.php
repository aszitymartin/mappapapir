<?php session_start(); include($_SERVER['DOCUMENT_ROOT'].'/includes/inc.connect.php');
if (mysqli_connect_errno()) { die ("0"); } if (isset($_SESSION['id'])) {$uid = $_SESSION['id'];} else {die("43"); }
$rid = $_POST['rid']; $sql = "SELECT id FROM reviews WHERE id = $rid"; $res = $con-> query($sql);
if ($res-> num_rows > 0) { $act__sql = "SELECT rid FROM rv__u WHERE rid = $rid AND uid = $uid"; $act__res = $con-> query($act__sql);
    if ($act__res-> num_rows > 0) { if ($stmt = $con->prepare('DELETE FROM rv__u WHERE rid = ? AND uid = ?')) { $stmt->bind_param('ii', $_POST['rid'], $uid); $stmt->execute(); die("200"); } else { die ("26"); }
    } else { if ($stmt = $con->prepare('INSERT INTO rv__u (rid, uid) VALUES (?, ?)')) { $stmt->bind_param('ii', $_POST['rid'], $uid); $stmt->execute(); die("201"); } else { die ("26"); } }
} else { die ('30'); } ?>