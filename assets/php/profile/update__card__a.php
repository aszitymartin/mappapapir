<?php require_once($_SERVER['DOCUMENT_ROOT'].'/includes/inc.php'); session_start(); include($_SERVER['DOCUMENT_ROOT'].'/includes/inc.connect.php'); if (mysqli_connect_errno()) { die ("0"); } if (isset($_POST['uid'])) {$uid = $_POST['uid'];} else {die("43"); } $cid= $_POST['cid'];
$arr = array(); array_push($arr, $_POST); $narr = array(); $iarr = array(); $tarr = array();

foreach($_POST as $key=>$value) { 
    if ($key == 'number' || $key == 'holder') { array_push($narr, "$key=$value"); 
        if ($key == 'number') { $cardnum = substr($value, -4); array_push($iarr, "cardnum=$cardnum"); }
    } if ($key == 'cardname' || $key == 'expiry' || $key == 'cvc') {
        if ($key == 'cardname') { $value = ucfirst($value); array_push($iarr, "$key=$value");
            switch (strtolower($value)) {
                case 'mastercard': array_push($tarr, "type=Mastercard kredit kártya"); array_push($tarr, "provider=Mastercard Inc."); break;
                case 'paypal': array_push($tarr, "type=PayPal virtuális kártya"); array_push($tarr, "provider=PayPal Inc."); break;
                case 'visa': array_push($tarr, "type=Visa kredit kártya"); array_push($tarr, "provider=Visa Inc."); break;
            }
        } else { array_push($iarr, "$key=$value"); }
    }
}
$isql = ""; $sqlArr = array(); $usqlArr = array(); $sisql = ""; $sqliArr = array(); $usqliArr = array(); $tsal = ""; $usqltArr = array(); $tsqlArr = array();
if (count($tarr) > 0) {
    for ($i = 0; $i < count($tarr); $i++) {
        $key = explode("=",$tarr[$i])[0]; $value = "'". explode("=",$tarr[$i])[1] . "'"; $tisqlArr = array(); array_push($tisqlArr, $key); array_push($tisqlArr, $value); array_push($tsqlArr, implode(" = ", $tisqlArr));
    } array_push($usqltArr, implode(", ", $tsqlArr)); for ($i = 0; $i < count($usqltArr); $i++) { $tsal .= $usqltArr[$i]; }
} if (count($narr) > 0) {
    for ($i = 0; $i < count($narr); $i++) {
        $key = explode("=",$narr[$i])[0]; $value = "'". explode("=",$narr[$i])[1] . "'"; $isqlArr = array(); array_push($isqlArr, $key); array_push($isqlArr, $value); array_push($sqlArr, implode(" = ", $isqlArr));
    } array_push($usqlArr, implode(", ", $sqlArr)); for ($i = 0; $i < count($usqlArr); $i++) { $isql .= $usqlArr[$i]; }
} if (count($iarr) > 0)  {
    for ($i = 0; $i < count($iarr); $i++) {
        $key = explode("=",$iarr[$i])[0]; $value = "'". explode("=",$iarr[$i])[1] . "'"; $sisqlArr = array(); array_push($sisqlArr, $key); array_push($sisqlArr, $value); array_push($sqliArr, implode(" = ", $sisqlArr));
    } array_push($usqliArr, implode(", ", $sqliArr)); for ($i = 0; $i < count($usqliArr); $i++) { $sisql .= $usqliArr[$i]; }
}
$ciArr = array(); array_push($ciArr, $tsal); array_push($ciArr, $isql); if (strlen($tsal) > 0) { if (strlen($isql) > 0) { $isql = implode(", ", $ciArr); } else { $isql = $tsal; } }
if (count($usqlArr) > 0 || count($usqltArr) > 0) { $sql = "UPDATE customers__card__info SET $isql WHERE uid = $uid AND cid = '$cid'"; $res = $con->query($sql); }
if (count($usqliArr) > 0) { $ssql = "UPDATE customers__card SET $sisql WHERE uid = $uid AND cid = '$cid'"; $sres = $con->query($ssql); }
$log_categ = "Felhasználó szerkesztése"; $log_desc = "#".$uid." felhasználónak ".$cid." kártyáját szerkesztette.";
if ($log = $con->prepare('INSERT INTO log (uid, ip, category, description) VALUES(?,?,?,?)')) {
    $log->bind_param('isss', $_SESSION['id'], $_POST['ip'], $log_categ, $log_desc); $log->execute(); $log->close(); die('200');
} else { die ("Hiba lépett fel a folyamat közben."); }

?>