<?php session_start();
$DATABASE_HOST = 'localhost';$DATABASE_USER = 'root';$DATABASE_PASS = 'eKi=0630OG';$DATABASE_NAME = 'mappapapir';
$con = mysqli_connect($DATABASE_HOST, $DATABASE_USER, $DATABASE_PASS, $DATABASE_NAME);
if (mysqli_connect_errno()) {die ("0"); } $uid = $_SESSION['id']; $rid = $_POST['rid'];
$sql = "SELECT * FROM rv__r WHERE rid = $rid AND uid = $uid";
if ($result = mysqli_query($con, $sql)) { $num = mysqli_num_rows($result); 
    if ($num > 0) { $object = new stdClass(); 
        while ($review = $result-> fetch_assoc()) { 
            $object->num = $num; $object->date = $review['date']; 
        } die(json_encode($object)); 
    } else {echo 0; die();}
}
?>