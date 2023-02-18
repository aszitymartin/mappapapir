<?php session_start();
include($_SERVER['DOCUMENT_ROOT'].'/includes/inc.connect.php');
if (mysqli_connect_errno()) { die ("0"); }
if (isset($_SESSION['id'])) {$uid = $_SESSION['id'];} else {die("43"); /* Nincs bejelentkezve */}

if ($_POST['r__action'] == 1) {
    if ($stmt = $con->prepare('SELECT rid FROM rv__u WHERE uid = ? AND rid = ?')) {
        $stmt->bind_param('ii', $uid, $_POST['rid']); $stmt->execute(); $stmt->store_result();
        if ($stmt->num_rows > 0) {
            if ($stmt = $con->prepare('DELETE FROM rv__u WHERE rid = ? AND uid = ?')) {
                $stmt->bind_param('ii', $_POST['rid'], $uid);
                $stmt->execute();
                if ($delstmt = $con->prepare('SELECT rid FROM rv__d WHERE uid = ? AND rid = ?')) {
                    $delstmt->bind_param('ii', $uid, $_POST['rid']); $delstmt->execute(); $delstmt->store_result();
                    if ($delstmt->num_rows > 0) {
                        if ($delstmt = $con->prepare('DELETE FROM rv__d WHERE rid = ? AND uid = ?')) {
                            $delstmt->bind_param('ii', $_POST['rid'], $uid);
                            $delstmt->execute();
                            $rid = $_POST['rid'];
                            $csql__u = "SELECT * FROM rv__u WHERE rid = $rid"; $csql__d = "SELECT * FROM rv__d WHERE rid = $rid";
                            if ($cu__res = mysqli_query($con, $csql__u)) { $cu__num = mysqli_num_rows($cu__res);
                                if ($cd__res = mysqli_query($con, $csql__d)) {$cd__num = mysqli_num_rows($cd__res); $object = new stdClass(); $object->up = $cu__num; $object->down = $cd__num; die(json_encode($object)); }
                            }
                        } else { die ("26"); }
                    } else {die("30"); exit;} $delstmt->close();
                } else { die ("25"); }
            } else { die ("26"); }
        }
        else { die ("30"); exit; } $stmt->close();
    } else { die ("25"); } $con->close();
}

if ($_POST['r__action'] == 0) {
    if ($stmt = $con->prepare('SELECT rid FROM rv__d WHERE uid = ? AND rid = ?')) {
        $stmt->bind_param('ii', $uid, $_POST['rid']); $stmt->execute(); $stmt->store_result();
        if ($stmt->num_rows > 0) {
            if ($stmt = $con->prepare('DELETE FROM rv__d WHERE rid = ? AND uid = ?')) {
                $stmt->bind_param('ii', $_POST['rid'], $uid);
                $stmt->execute(); die("200");
            } else { die ("26"); }
        }
        else { die ("30"); exit; } $stmt->close();
    } else { die ("25"); } $con->close();
}

?>