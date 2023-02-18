<?php include($_SERVER['DOCUMENT_ROOT'].'/includes/inc.connect.php');
if(!$con) { die("Connection failed: " . mysqli_connect_error()); } $pid = $_POST['pid']; $thmb = array();
    $sql = "SELECT thumbnail FROM products WHERE id = '$pid'";
    $res = $con-> query($sql);
    while($data = $res->fetch_assoc()) { array_push($thmb, $data['thumbnail']); } die(json_encode($thmb));
?>