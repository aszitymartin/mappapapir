<?php session_start(); include($_SERVER['DOCUMENT_ROOT'].'/includes/inc.connect.php'); if (mysqli_connect_errno()) { die ("0"); }
if (isset($_POST['uid'])) {$uid = $_POST['uid'];} else { die("Nem létező felhasználó"); } $pid = $_POST['pid'];
$sql = "SELECT pid FROM bookmarks WHERE uid = ".$uid." AND pid IN ($pid)"; $result = $con->query($sql);
if ($result->num_rows > 0) {
    while ($cdt = $result->fetch_assoc()) { $dsql = "DELETE FROM bookmarks WHERE uid = ".$uid." AND pid = ".$cdt['pid'].""; $dres = $con->query($dsql); } 
    $log_categ = "Felhasználó szerkesztése"; $log_desc = "#".$uid." felhasználó mentett #".$pid." termék törlése.";
    if ($log = $con->prepare('INSERT INTO log (uid, ip, category, description) VALUES(?,?,?,?)')) {
        $log->bind_param('isss', $_SESSION['id'], $_POST['ip'], $log_categ, $log_desc); $log->execute(); $log->close(); die('0');
    } else { die ("Hiba történt a logolás közben."); } die('0');
} else { die('Valamelyik termék nincs a kosárhoz adva.'); }
?>