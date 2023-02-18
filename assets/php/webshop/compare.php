<?php
include($_SERVER['DOCUMENT_ROOT'].'/includes/inc.connect.php');
$con->query("SET CHARACTER SET utf8mb4"); if (mysqli_connect_errno()) {header ("Location: /500");} $pid = $_POST['pid']; $category = $_POST['category']; $tags = $_POST['tags']; $pmodel = $_POST['pmodel'];
$pr_sql = "SELECT DISTINCT products__variations.model, products__category.category FROM `products` INNER JOIN products__category ON products__category.pid = products.id INNER JOIN products__variations ON products__variations.pid = products.id 
WHERE products__category.category LIKE '$category' AND products.id != $pid AND products__variations.model NOT LIKE '$pmodel' ORDER BY RAND() LIMIT 4";
$pr_res = $con-> query($pr_sql);
if ($pr_res-> num_rows > 0) { $arr = array();
    while ($product = $pr_res-> fetch_assoc()) { $model = $product['model'];
        $sql = "SELECT products.id, products.name, products.thumbnail, products__category.category, products__pricing.base, products__pricing.discounted, products__pricing.discount, products__pricing.start, products__pricing.end, products__variations.color, products__variations.brand, products__shipping.physical, products__shipping.weight, products__shipping.w__unit, products__shipping.width, products__shipping.height, products__shipping.length, products__shipping.d__unit, products__status.status FROM `products` INNER JOIN products__category ON products__category.pid = products.id INNER JOIN products__pricing ON products__pricing.pid = products.id INNER JOIN products__variations ON products__variations.pid = products.id INNER JOIN products__shipping ON products__shipping.pid = products.id INNER JOIN products__status ON products__status.pid = products.id WHERE products__variations.model LIKE '$model' AND products__status.status = 1 AND products.id != $pid LIMIT 1";
        $res = $con-> query($sql);
        while ($dt = $res-> fetch_assoc()) { $object = new stdClass(); $general = new stdClass();$category = new stdClass();$pricing = new stdClass();$shipping = new stdClass();$variations = new stdClass();
            $general->pid = $dt['id']; $general->name = $dt['name']; $general->thumbnail = $dt['thumbnail'];
            $pricing->price = $dt['base']; $pricing->discounted = $dt['discounted']; $pricing->discount = $dt['discount']; $pricing->start = $dt['start']; $pricing->end = $dt['end'];
            $variations->color = $dt['color']; $variations->brand = $dt['brand'];
            $shipping->physical = $dt['physical']; $shipping->weight = $dt['weight'];$shipping->w__unit = $dt['w__unit']; $shipping->width = $dt['width']; $shipping->height = $dt['height']; $shipping->length = $dt['length']; $shipping->d__unit = $dt['d__unit'];
            $object->general = $general;$object->pricing = $pricing; $object->variations = $variations;$object->shipping = $shipping; array_push($arr, $object);
        }
    } die(json_encode($arr));
}
?>