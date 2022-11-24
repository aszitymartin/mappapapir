<?php require_once($_SERVER['DOCUMENT_ROOT'].'/includes/inc.php'); if(!$con) { die("Connection failed: " . mysqli_connect_error()); }$id = $_POST['id'];
$sql = "SELECT * FROM log WHERE id = $id"; $res = $con->query($sql); $obj = new stdClass();
if ($res->num_rows > 0) { $dt = $res->fetch_assoc();
    $obj->id = $dt['id']; $obj->uid = $dt['uid']; $obj->ip = $dt['ip']; $obj->category = $dt['category']; $obj->description = $dt['description']; $obj->date = $dt['date']; die(json_encode($obj));
} else { die('Ismeretlen feljegyzés.'); }
?>