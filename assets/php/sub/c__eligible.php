<?php session_start();
$DATABASE_HOST = 'localhost';$DATABASE_USER = 'root';$DATABASE_PASS = 'eKi=0630OG';$DATABASE_NAME = 'mappapapir';
$con = mysqli_connect($DATABASE_HOST, $DATABASE_USER, $DATABASE_PASS, $DATABASE_NAME);
if (mysqli_connect_errno()) {die ("0"); } if (isset($_SESSION['id'])) {$uid = $_SESSION['id'];} else {die("43"); /* Nincs bejelentkezve */ }
$sql = "SELECT * FROM e__subs WHERE uid = $uid";
if ($result = mysqli_query($con, $sql)) { $num = mysqli_num_rows($result); 
    if ($num > 0) { $res = $con-> query("SELECT * FROM e__subs WHERE uid = $uid"); $dsc = $res-> fetch_assoc(); $disc = $dsc['disc'];
        echo $disc; die();
    } else {echo false; die();} 
}
?>