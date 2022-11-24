<?php require_once($_SERVER['DOCUMENT_ROOT'].'/config/db.inc.php'); $pid = $_POST['pid'];
    $gb_sql = "SELECT brand, model FROM products__variations WHERE pid = $pid"; $gb_res = $con->query($gb_sql);
    $bd = $gb_res->fetch_assoc(); $brand = $bd['brand']; $model = $bd['model'];
    $ou_sql = "SELECT DISTINCT model FROM products__variations WHERE brand LIKE '$brand' AND model NOT LIKE '$model' AND pid != $pid LIMIT 14";
    $ou_res = $con->query($ou_sql); $arr = array();
    while ($oud = $ou_res->fetch_assoc()) { $dis_mod = $oud['model'];
        $sql = "SELECT products.id, products.name, products.thumbnail, products__pricing.base, products__pricing.discounted, products__pricing.discount, products__variations.brand, products__category.category FROM products INNER JOIN products__pricing ON products__pricing.pid = products.id INNER JOIN products__variations ON products__variations.pid = products.id INNER JOIN products__category ON products__category.pid = products.id WHERE products__variations.model LIKE '$dis_mod' LIMIT 1";
        $res = $con->query($sql);
        if ($res->num_rows > 0) {
            while ($bnd = $res->fetch_assoc()) { $items = new stdClass();
                $items->pid = $bnd['id']; $items->name = $bnd['name']; $items->thumbnail = $bnd['thumbnail']; $items->price = $bnd['base'];
                $items->discounted = $bnd['discounted']; $items->discount = $bnd['discount']; $items->brand = $bnd['brand']; $items->category = $bnd['category']; array_push($arr, $items);
            }
        } else { die('0'); }
    } die(json_encode($arr));
?>