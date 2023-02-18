<?php
session_start(); include($_SERVER['DOCUMENT_ROOT'].'/includes/inc.connect.php');
$con = mysqli_connect($DATABASE_HOST, $DATABASE_USER, $DATABASE_PASS, $DATABASE_NAME); if (mysqli_connect_errno()) {die ("0"); }

$upload_location = $_SERVER['DOCUMENT_ROOT'].'/assets/images/feedbacks/'; $imageOK = false;

$filename = $_FILES['image']['name'];
$ext = strtolower(pathinfo($filename, PATHINFO_EXTENSION)); $valid_ext = array("png","jpeg","jpg");
if(in_array($ext, $valid_ext)){
	$path = $upload_location.$filename; $coded_name = substr(md5(rand()), 0, 7).''.date('YmdHis').'.'.$ext;
	if(move_uploaded_file($_FILES['image']['tmp_name'],$upload_location.''.$coded_name)){ $imageOK = true; }
}
if ($imageOK) {
	if ($stmt = $con->prepare('SELECT title FROM feedbacks WHERE title = ?')) {
		$stmt->bind_param('s', $_POST['title']);
		$stmt->execute();
		$stmt->store_result();
		if ($stmt->num_rows > 0) {
			die ("30"); // 30: Ez a visszajelzes mar letezik
			exit;
		} else {
			if ($stmt = $con->prepare('INSERT INTO feedbacks (uid, target_id, title, description, image, type) VALUES (?, ?, ?, ?, ?, ?)')) {
				$stmt->bind_param('iisssi', $_POST['id'], $_POST['uid'], $_POST['title'], $_POST['description'], $coded_name, $_POST['tags']);
				$stmt->execute();
				echo "1"; // 1: Sikeres muvelet
			} else {
				die ("26"); // 26: Hiba tortent az INSERT kozben
			}
		} $stmt->close();
	} else {
		die ("25"); // 25: Hiba tortent a PREPARE kozben
	}
	$con->close();
}
?>