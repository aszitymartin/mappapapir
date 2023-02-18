<?php
include($_SERVER['DOCUMENT_ROOT'].'/includes/inc.connect.php');
$con->query("SET CHARACTER SET utf8mb4"); if (mysqli_connect_errno()) {header ("Location: /500");} $pid = $_POST['pid'];
$colors = ['fehér' => 'white','sárga' => 'yellow','narancssárga' => 'orange','rózsaszínű' => 'pink','piros' => 'red','barna' => 'brown','zöld' => 'green','kék' => 'blue','lila' => 'purple','szürke' => 'grey','fekete' => 'black','ezüst' => 'silver','arany' => 'gold','rózsaszín' => 'pink'];
$pr_sql = "SELECT products.id, products.name, products.description, products.thumbnail, products__category.category, products__category.tags, products__pricing.base, products__pricing.discounted, products__pricing.discount, products__pricing.start, products__pricing.end, products__media.images, products__inventory.code, products__inventory.quantity, products__inventory.q__warehouse, products__inventory.unit, products__inventory.backorder, products__variations.color, products__variations.material, products__variations.style, products__variations.brand, products__variations.model, products__variations.custom, products__shipping.physical, products__shipping.weight, products__shipping.w__unit, products__shipping.width, products__shipping.height, products__shipping.length, products__shipping.d__unit, products__meta.title AS 'meta__title', products__meta.description AS 'meta__desc', products__meta.keywords AS 'meta__keyw', products__review.enable, products__review.auth, products__review.vote, products__review.privacy, products__status.status, products__status.schedule FROM `products` INNER JOIN products__category ON products__category.pid = products.id INNER JOIN products__pricing ON products__pricing.pid = products.id INNER JOIN products__media ON products__media.pid = products.id INNER JOIN products__inventory ON products__inventory.pid = products.id INNER JOIN products__variations ON products__variations.pid = products.id INNER JOIN products__shipping ON products__shipping.pid = products.id INNER JOIN products__meta ON products__meta.pid = products.id INNER JOIN products__review ON products__review.pid = products.id INNER JOIN products__status ON products__status.pid = products.id WHERE products.id = $pid"; $pr_res = $con-> query($pr_sql); $object = new stdClass();
if ($pr_res-> num_rows > 0) { $tags__arr = array();
    $general = new stdClass();$category = new stdClass();$inventory = new stdClass();$media = new stdClass();$meta = new stdClass();$pricing = new stdClass();$review = new stdClass();$shipping = new stdClass();$status = new stdClass();$variations = new stdClass();
    while ($product = $pr_res-> fetch_assoc()) { 
        $general->pid = $product['id'];
        $general->name = $product['name'];
        $general->description = $product['description'];
        $general->thumbnail = $product['thumbnail'];
        $pricing->price = $product['base'];
        $pricing->discounted = $product['discounted'];
        $pricing->discount = $product['discount'];
        $pricing->start = $product['start'];
        $pricing->end = $product['end'];
        $media->media = $product['images'];
        $inventory->code = $product['code'];
        $inventory->quantity = $product['quantity'];
        $inventory->q__warehouse = $product['q__warehouse'];
        $inventory->q__unit = $product['unit'];
        $inventory->backorder = $product['backorder'];
        $variations->color = $product['color'];
        $variations->material = $product['material'];
        $variations->style = $product['style'];
        $variations->brand = $product['brand'];
        $variations->model = $product['model'];
        $shipping->physical = $product['physical'];
        $shipping->weight = $product['weight'];
        $shipping->w__unit = $product['w__unit'];
        $shipping->width = $product['width'];
        $shipping->height = $product['height'];
        $shipping->length = $product['length'];
        $shipping->d__unit = $product['d__unit'];
        $meta->title = $product['meta__title'];
        $meta->description = $product['meta__desc'];
        $meta->keywords = $product['meta__keyw'];
        $review->enable = $product['enable'];
        $review->auth = $product['auth'];
        $review->vote = $product['vote'];
        $review->privacy = $product['privacy'];

        $custom = explode(',', $product['custom']); $custom__array = array();for ($i = 0; $i < sizeof($custom); $i++) { array_push($custom__array, $custom[$i]); }$variations->custom = $custom__array;
        $tags = explode(',', $product['tags']); for ($i = 0; $i < sizeof($tags); $i++) { array_push($tags__arr, $tags[$i]); }
        $category->tags = $tags__arr; $category->category = $product['category']; $color = $product['color'];
        // $clr__sql = "SELECT DISTINCT color FROM products__variations WHERE color NOT LIKE '$color'"; $clr__res = $con-> query($clr__sql);
        // if ($clr__res-> num_rows > 0) { $clr__arr = array(); $clrnm__arr = array(); while ($clr = $clr__res-> fetch_assoc()) { $clro = new stdClass(); array_push($clr__arr, strtr(strtolower($clr['color']), $colors)); } $variations->clr__variations = $clr__arr; }
        $model = $product['model'];
        $clr__sql = "SELECT pid FROM products__variations WHERE pid != $pid AND model LIKE '$model'"; $clr__res = $con-> query($clr__sql);
        if ($clr__res-> num_rows > 0) { $clr__arr = array(); $clrnm__arr = array(); while ($clr = $clr__res-> fetch_assoc()) { $clro = new stdClass(); array_push($clr__arr, $clr['pid']); } $variations->clr__variations = $clr__arr; }


        $object->general = $general;$object->pricing = $pricing;$object->media = $media;
        $object->inventory = $inventory;$object->variations = $variations;$object->shipping = $shipping;
        $object->meta = $meta; $object->review = $review;$object->category = $category;
    }
    die(json_encode($object));
}
?>