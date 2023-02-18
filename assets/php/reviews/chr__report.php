<?php session_start();
include($_SERVER['DOCUMENT_ROOT'].'/includes/inc.connect.php');
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