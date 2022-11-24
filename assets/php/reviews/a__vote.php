<?php session_start();
$DATABASE_HOST = 'localhost';$DATABASE_USER = 'root';$DATABASE_PASS = 'eKi=0630OG';$DATABASE_NAME = 'mappapapir';
$con = mysqli_connect($DATABASE_HOST, $DATABASE_USER, $DATABASE_PASS, $DATABASE_NAME);
if (mysqli_connect_errno()) { die ("0"); }
if (isset($_SESSION['id'])) {$uid = $_SESSION['id'];} else {die("43"); /* Nincs bejelentkezve */}

if ($_POST['a__action'] == 1) {
    if ($stmt = $con->prepare('SELECT rid FROM rv__u WHERE uid = ? AND rid = ?')) {
        $stmt->bind_param('ii', $uid, $_POST['rid']); $stmt->execute(); $stmt->store_result();
        if ($stmt->num_rows > 0) { die ("30"); exit; }
        else {
            if ($stmt = $con->prepare('INSERT INTO rv__u (rid, uid) VALUES (?, ?)')) {
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
                    } else { 
                        $rid = $_POST['rid'];
                        $csql__u = "SELECT * FROM rv__u WHERE rid = $rid"; $csql__d = "SELECT * FROM rv__d WHERE rid = $rid";
                        if ($cu__res = mysqli_query($con, $csql__u)) { $cu__num = mysqli_num_rows($cu__res);
                            if ($cd__res = mysqli_query($con, $csql__d)) {$cd__num = mysqli_num_rows($cd__res); $object = new stdClass(); $object->up = $cu__num; $object->down = $cd__num; die(json_encode($object)); }
                        }
                    } $delstmt->close();
                } else { die ("25"); }
            } else { die ("26"); /* 26: Hiba tortent az INSERT kozben */ }
        } $stmt->close();
    } else { die ("25"); /* 25: Hiba tortent a PREPARE kozben */ } $con->close();
}
if ($_POST['a__action'] == 0) {
    if ($stmt = $con->prepare('SELECT rid FROM rv__d WHERE uid = ? AND rid = ?')) {
        $stmt->bind_param('ii', $uid, $_POST['rid']); $stmt->execute(); $stmt->store_result();
        if ($stmt->num_rows > 0) {die ("30"); exit;}
        else {
            if ($stmt = $con->prepare('INSERT INTO rv__d (rid, uid) VALUES (?, ?)')) {
                $stmt->bind_param('ii', $_POST['rid'], $uid);
                $stmt->execute(); 
                if ($delstmt = $con->prepare('SELECT rid FROM rv__u WHERE uid = ? AND rid = ?')) {
                    $delstmt->bind_param('ii', $uid, $_POST['rid']); $delstmt->execute(); $delstmt->store_result();
                    if ($delstmt->num_rows > 0) {
                        if ($delstmt = $con->prepare('DELETE FROM rv__u WHERE rid = ? AND uid = ?')) {
                            $delstmt->bind_param('ii', $_POST['rid'], $uid);
                            $delstmt->execute();
                            $rid = $_POST['rid'];
                            $csql__u = "SELECT * FROM rv__u WHERE rid = $rid"; $csql__d = "SELECT * FROM rv__d WHERE rid = $rid";
                            if ($cu__res = mysqli_query($con, $csql__u)) { $cu__num = mysqli_num_rows($cu__res);
                                if ($cd__res = mysqli_query($con, $csql__d)) {$cd__num = mysqli_num_rows($cd__res); $object = new stdClass(); $object->up = $cu__num; $object->down = $cd__num; die(json_encode($object)); }
                            }
                        } else { die ("26"); }
                    }
                    else { 
                        $rid = $_POST['rid'];
                        $csql__u = "SELECT * FROM rv__u WHERE rid = $rid"; $csql__d = "SELECT * FROM rv__d WHERE rid = $rid";
                        if ($cu__res = mysqli_query($con, $csql__u)) { $cu__num = mysqli_num_rows($cu__res);
                            if ($cd__res = mysqli_query($con, $csql__d)) {$cd__num = mysqli_num_rows($cd__res); $object = new stdClass(); $object->up = $cu__num; $object->down = $cd__num; die(json_encode($object)); }
                        }
                    } $delstmt->close();
                } else { die ("25"); }
            } else { die ("26"); /* 26: Hiba tortent az INSERT kozben */ }
        } $stmt->close();
    } else { die ("25"); /* 25: Hiba tortent a PREPARE kozben */ } $con->close();
}

?>