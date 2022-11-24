<?php
$DATABASE_HOST = 'localhost';$DATABASE_USER = 'root';$DATABASE_PASS = 'eKi=0630OG';$DATABASE_NAME = 'mappapapir';
$con = mysqli_connect($DATABASE_HOST, $DATABASE_USER, $DATABASE_PASS, $DATABASE_NAME);
if (mysqli_connect_errno()) {die ("0"); }
$id = $_POST['id'];$status = $_POST['status'];$type = $_POST['type'];
$sql = "SELECT feedbacks.*, customers.id, customers.fullname, customers.email FROM feedbacks INNER JOIN customers ON (feedbacks.uid = customers.id) WHERE feedbacks.status = $status AND feedbacks.id = $id";
if ($result = mysqli_query($con, $sql)) {
    $num = mysqli_num_rows($result);
    if ($num > 0) {
        while ($res = mysqli_fetch_assoc($result)) {
            $data['feedbacks_id'] = $res['id'];$data['uid'] = $res['uid'];
            $data['feedback_title'] = $res['title'];$data['feedback_desc'] = $res['description'];
            $data['feedback_image'] = $res['image'];$data['feedback_type'] = $res['type'];
            $data['feedback_status'] = $res['status'];$data['feedback_created'] = $res['created'];
            $data['author_name'] = $res['full_name'];$data['author_email'] = $res['email_address'];
            die(json_encode($data));
        }
    } else {die ('33'); /* 32: Nem letezik az adatbazisban */}
} else {die ('41'); /* 41: Hibas sql feltetel(ek)*/}
?>