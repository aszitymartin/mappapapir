<?php $DATABASE_HOST = 'localhost';$DATABASE_USER = 'root';$DATABASE_PASS = 'eKi=0630OG';$DATABASE_NAME = 'mappapapir';$con = mysqli_connect($DATABASE_HOST, $DATABASE_USER, $DATABASE_PASS, $DATABASE_NAME);
if(!$con) { die("Connection failed: " . mysqli_connect_error()); } $pid = $_POST['pid']; $thmb = array();
    $sql = "SELECT thumbnail FROM products WHERE id = '$pid'";
    $res = $con-> query($sql);
    while($data = $res->fetch_assoc()) { array_push($thmb, $data['thumbnail']); } die(json_encode($thmb));
?>