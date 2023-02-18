<?php session_start(); include($_SERVER['DOCUMENT_ROOT'].'/includes/inc.connect.php'); if (mysqli_connect_errno()) { die ("0"); } if (isset($_SESSION['id'])) {$uid = $_SESSION['id'];} else {die("43"); }
$arr = array(); array_push($arr, $_POST); $narr = array(); foreach($_POST as $key=>$value) { array_push($narr, "$key=$value"); }
if ($narr[0] == "email=".$_POST['email']) {
    unset($narr[0]);
    if ($stmt = $con->prepare('UPDATE customers, u__email SET customers.email = ?, u__email.valid = 0, u__email.email = ?, u__email.date = NOW() WHERE customers.id = ? AND u__email.uid = ?')) {
        $stmt->bind_param('ssii', $_POST['email'],$_POST['email'], $uid,$uid); $stmt->execute();
        for ($i = 1; $i <= count($narr); $i++) { 
            $key = (explode("=", $narr[$i])[0]); $val = (explode("=", $narr[$i])[1]); $tab = (explode("__", $key)); $tkey = $tab[0]; $tskey = $tab[1];
            if ($stmt = $con->prepare('UPDATE customers__lang SET '.$tkey.' = ? WHERE id = ?')) { $stmt->bind_param('si', $val, $uid); $stmt->execute(); } else { die ("26"); }
        } die("200");
    } else { die ("26"); }
} else {
    for ($i = 0; $i < count($narr); $i++) { 
        $key = (explode("=", $narr[$i])[0]); $val = (explode("=", $narr[$i])[1]); $tab = (explode("__", $key)); $tkey = $tab[0]; $tskey = $tab[1];
        if ($stmt = $con->prepare('UPDATE customers__lang SET '.$tkey.' = ? WHERE id = ?')) { $stmt->bind_param('si', $val, $uid); $stmt->execute(); } else { die ("26"); }
    } die("200");
}
?>