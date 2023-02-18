<?php session_start();
include($_SERVER['DOCUMENT_ROOT'].'/includes/inc.connect.php');
if (mysqli_connect_errno()) {die ("0"); } if (isset($_SESSION['id'])) {$uid = $_SESSION['id'];} else {die("43"); /* Nincs bejelentkezve */ }
$sql = "SELECT * FROM e__subs WHERE uid = $uid";
if ($result = mysqli_query($con, $sql)) { $num = mysqli_num_rows($result); 
    if ($num > 0) { $res = $con-> query("SELECT * FROM e__subs WHERE uid = $uid"); $dsc = $res-> fetch_assoc(); $disc = $dsc['disc'];
        echo $disc; die();
    } else {echo false; die();} 
}
?>