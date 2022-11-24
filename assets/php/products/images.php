<?php $DATABASE_HOST = 'localhost';$DATABASE_USER = 'root';$DATABASE_PASS = 'eKi=0630OG';$DATABASE_NAME = 'mappapapir';$con = mysqli_connect($DATABASE_HOST, $DATABASE_USER, $DATABASE_PASS, $DATABASE_NAME);
if(!$con) { die("Connection failed: " . mysqli_connect_error()); } $thumbArr = array(); $model = $_POST['model'];
    $sql = "SELECT thumbnail FROM products INNER JOIN products__variations ON products__variations.pid = products.id WHERE model = '$model'";
    $res = $con-> query($sql);
    while($data = $res->fetch_assoc()) {
        array_push($thumbArr, $data['thumbnail']);
    }
    die(json_encode($thumbArr));
?>