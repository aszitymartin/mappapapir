<?php session_start(); include($_SERVER['DOCUMENT_ROOT'].'/includes/inc.connect.php'); if (mysqli_connect_errno()) { die ("0"); } $uid = $_POST['uid'];
$arr = array(); array_push($arr, $_POST); $narr = array(); foreach($_POST as $key=>$value) { if ($key != 'uid' && $key != 'ip') { array_push($narr, "$key=$value"); } }
for ($i = 0; $i < count($narr); $i++) { $key = (explode("=", $narr[$i])[0]); $val = (explode("=", $narr[$i])[1]); $tab = (explode("__", $key)); $tkey = $tab[0]; $tskey = $tab[1];
    if (count($tab) > 1) { if ($stmt = $con->prepare('UPDATE customers__'.$tkey.' SET '.$tskey.' = ? WHERE uid = ?')) { $stmt->bind_param('si', $val, $uid); $stmt->execute(); } else { die ("26"); } }
    else { if ($stmt = $con->prepare('UPDATE customers SET '.$key.' = ? WHERE id = ?')) { $stmt->bind_param('si', $val, $uid); $stmt->execute(); } else { die ("26"); } }
} $log_categ = "Felhasználó szerkesztése"; $log_desc = "#".$uid." felhasználónak szerkesztette a személyes információit.";
if ($log = $con->prepare('INSERT INTO log (uid, ip, category, description) VALUES(?,?,?,?)')) {
    $log->bind_param('isss', $_SESSION['id'], $_POST['ip'], $log_categ, $log_desc); $log->execute(); $log->close(); die('200');
} else { die ("Hiba lépett fel a folyamat közben."); }
?>