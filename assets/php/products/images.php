<?php include($_SERVER['DOCUMENT_ROOT'].'/includes/inc.connect.php');
if(!$con) { die("Connection failed: " . mysqli_connect_error()); } $thumbArr = array(); $model = $_POST['model'];
    $sql = "SELECT thumbnail FROM products INNER JOIN products__variations ON products__variations.pid = products.id WHERE model = '$model'";
    $res = $con-> query($sql);
    while($data = $res->fetch_assoc()) {
        array_push($thumbArr, $data['thumbnail']);
    }
    die(json_encode($thumbArr));
?>