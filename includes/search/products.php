<?php session_start(); include($_SERVER['DOCUMENT_ROOT'].'/includes/inc.connect.php'); if (mysqli_connect_errno()) { die ("Hiba történt a termékek megjelenításe közben."); }
if ($stmt = $con->prepare('SELECT products.id, products.name, products.thumbnail, products__variations.color, products__variations.brand, products__variations.model FROM products INNER JOIN products__variations ON products__variations.pid = products.id ORDER BY products.added DESC LIMIT 4')) {
    $stmt->execute(); $result = $stmt->get_result();
    if($result->num_rows > 0) { $arr = array(); 
        while ($dt = $result->fetch_assoc()) { $obj = new stdClass(); 
            
            $obj->pid = $dt['id']; $obj->name = $dt['name']; $obj->thumbnail = $dt['thumbnail']; $obj->color = $dt['color']; $obj->brand = $dt['brand']; $obj->model = $dt['model'];
            array_push($arr, $obj); 
        } die(json_encode($arr));
    } else { die('Hiba történt a termékek megjelenításe közben.'); }
} else { die ("Hiba történt a termékek megjelenításe közben."); } $stmt->close();
?>