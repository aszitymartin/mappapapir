<?php
$DATABASE_HOST = 'localhost';$DATABASE_USER = 'root';$DATABASE_PASS = 'eKi=0630OG';$DATABASE_NAME = 'mappapapir';$con = mysqli_connect($DATABASE_HOST, $DATABASE_USER, $DATABASE_PASS, $DATABASE_NAME);
$con->query("SET CHARACTER SET utf8mb4"); if (mysqli_connect_errno()) {header ("Location: /500");} $pid = $_POST['pid'];
$pr_sql = "SELECT products.id, products.name, products.description, products__category.category, products__category.tags, products__status.status, products__pricing.base, products__pricing.discounted, products__pricing.discount, products__pricing.start, products__pricing.end, products__media.images, products__inventory.code, products__inventory.quantity, products__inventory.q__warehouse, products__inventory.unit, products__inventory.backorder, products__variations.color, products__variations.material, products__variations.style, products__variations.brand, products__variations.model, products__variations.custom, products__shipping.physical, products__shipping.weight, products__shipping.w__unit, products__shipping.width, products__shipping.height, products__shipping.length, products__shipping.d__unit, products__shipping.refund, products__meta.title AS 'meta__title', products__meta.description AS 'meta__desc', products__meta.keywords AS 'meta__keyw', products__review.enable, products__review.auth, products__review.vote, products__review.privacy FROM `products` INNER JOIN products__category ON products__category.pid = products.id INNER JOIN products__status ON products__status.pid = products.id INNER JOIN products__pricing ON products__pricing.pid = products.id INNER JOIN products__media ON products__media.pid = products.id INNER JOIN products__inventory ON products__inventory.pid = products.id INNER JOIN products__variations ON products__variations.pid = products.id INNER JOIN products__shipping ON products__shipping.pid = products.id INNER JOIN products__meta ON products__meta.pid = products.id INNER JOIN products__review ON products__review.pid = products.id WHERE products.id = $pid"; $pr_res = $con-> query($pr_sql); $object = new stdClass();
if ($pr_res-> num_rows > 0) { $tags__arr = array();
    while ($product = $pr_res-> fetch_assoc()) { 
        $object->pid = $product['id'];
        $object->name = $product['name'];
        $object->description = $product['description'];
        $object->status = $product['status'];
        $object->price = $product['base'];
        $object->discounted = $product['discounted'];
        $object->discount = $product['discount'];
        $object->start = $product['start'];
        $object->end = $product['end'];
        $object->media = $product['images'];
        $object->code = $product['code'];
        $object->quantity = $product['quantity'];
        $object->q__warehouse = $product['q__warehouse'];
        $object->q__unit = $product['unit'];
        $object->backorder = $product['backorder'];
        $object->color = $product['color'];
        $object->material = $product['material'];
        $object->style = $product['style'];
        $object->brand = $product['brand'];
        $object->model = $product['model'];
        $object->custom = $product['custom'];
        $object->physical = $product['physical'];
        $object->weight = $product['weight'];
        $object->w__unit = $product['w__unit'];
        $object->width = $product['width'];
        $object->height = $product['height'];
        $object->length = $product['length'];
        $object->d__unit = $product['d__unit'];
        $object->refund = $product['refund'];
        $object->meta__title = $product['meta__title'];
        $object->meta__desc = $product['meta__desc'];
        $object->meta__keyw = $product['meta__keyw'];
        $object->review__enable = $product['enable'];
        $object->review__auth = $product['auth'];
        $object->review__vote = $product['vote'];
        $object->review__privacy = $product['privacy'];
        
        $tags = explode(',', $product['tags']); for ($i = 0; $i < sizeof($tags); $i++) { array_push($tags__arr, $tags[$i]); }
        $object->tags = $tags__arr;
        $object->category = $product['category'];

    }
    die(json_encode($object));
}
?>