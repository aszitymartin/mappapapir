<?php session_start(); $DATABASE_HOST = 'localhost';$DATABASE_USER = 'root';$DATABASE_PASS = 'eKi=0630OG';$DATABASE_NAME = 'mappapapir'; $con = mysqli_connect($DATABASE_HOST, $DATABASE_USER, $DATABASE_PASS, $DATABASE_NAME); if (mysqli_connect_errno()) { die ("0"); } $uid = $_POST['uid'];
$arr = array(); array_push($arr, $_POST); $narr = array(); foreach($_POST as $key=>$value) { if ($key != 'ip' && $key != 'uid') { array_push($narr, "$key=$value"); } }
if ($narr[0] == "email=".$_POST['email']) {
    unset($narr[0]);
    if ($stmt = $con->prepare('UPDATE customers, u__email SET customers.email = ?, u__email.valid = 0, u__email.email = ?, u__email.date = NOW() WHERE customers.id = ? AND u__email.uid = ?')) {
        $stmt->bind_param('ssii', $_POST['email'],$_POST['email'], $uid,$uid); $stmt->execute();
        for ($i = 1; $i <= count($narr); $i++) { 
            $key = (explode("=", $narr[$i])[0]); $val = (explode("=", $narr[$i])[1]); $tab = (explode("__", $key)); $tkey = $tab[0]; $tskey = $tab[1];
            if ($stmt = $con->prepare('UPDATE customers__lang SET '.$tkey.' = ? WHERE uid = ?')) { $stmt->bind_param('si', $val, $uid); $stmt->execute(); } else { die ("26"); }
        } $log_categ = "Felhasználó szerkesztése"; $log_desc = "#".$uid." felhasználónak szerkesztette a fiók információit.";
        if ($log = $con->prepare('INSERT INTO log (uid, ip, category, description) VALUES(?,?,?,?)')) {
            $log->bind_param('isss', $_SESSION['id'], $_POST['ip'], $log_categ, $log_desc); $log->execute(); $log->close(); die('200');
        } else { die ("Hiba lépett fel a folyamat közben."); }
    } else { die ("26"); }
} else {
    for ($i = 0; $i < count($narr); $i++) { 
        $key = (explode("=", $narr[$i])[0]); $val = (explode("=", $narr[$i])[1]); $tab = (explode("__", $key)); $tkey = $tab[0]; $tskey = $tab[1];
        if ($stmt = $con->prepare('UPDATE customers__lang SET '.$tkey.' = ? WHERE uid = ?')) { $stmt->bind_param('si', $val, $uid); $stmt->execute(); } else { die ("26"); }
    } $log_categ = "Felhasználó szerkesztése"; $log_desc = "#".$uid." felhasználónak szerkesztette a fiók információit.";
    if ($log = $con->prepare('INSERT INTO log (uid, ip, category, description) VALUES(?,?,?,?)')) {
        $log->bind_param('isss', $_SESSION['id'], $_POST['ip'], $log_categ, $log_desc); $log->execute(); $log->close(); die('200');
    } else { die ("Hiba lépett fel a folyamat közben."); }
}
?>