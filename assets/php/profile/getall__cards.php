<?php require_once($_SERVER['DOCUMENT_ROOT'].'/config/db.inc.php'); $uid = $_SESSION['id'];
if ($stmt = $con->prepare('SELECT cardname FROM customers__card WHERE uid = ? AND cardname NOT LIKE "Mappa+ kártya"')) {
    $stmt->bind_param('i', $uid); $stmt->execute(); $result = $stmt->get_result();
    if($result->num_rows > 0) { $arr = array();
        while ($dt = $result->fetch_assoc()) { array_push($arr, $dt['cardname']); } die(json_encode($arr));
    } else { die('30'); }
} else { die ("26"); } $stmt->close();
?>