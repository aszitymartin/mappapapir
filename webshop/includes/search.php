<?php include($_SERVER['DOCUMENT_ROOT'].'/config/db.inc.php'); $term = $_POST['term']; $pdArr = array();

// die(print_r($_POST));

if ($_POST) {
    if (isset($_POST['brand'])) { $brnd = $_POST['brand'];
        $bi = explode(',', $_POST['brand']);
        for ($i = 0; $i < sizeof($bi); $i++) {
            $bsi .= "'$bi[$i]',";
        }
        $bim = substr($bsi, 0, strlen($bsi)-1);
        $bims = "AND products__search.brand IN ($bim)";
    } else { $bsi = ''; }

    if (isset($_POST['review'])) {
        $rsh = " INNER JOIN reviews ON reviews.pid = products__search.pid ";
        $ri = $_POST['review']; $rsi = ' AND savg IN ('.$ri.')';
    } else { $rsh = ''; $rsi = ''; }


    if (isset($_POST['mxi'])) { $pi = explode('+', $_POST['mxi']);
        if (($pi[0] == 0 && $pi[1] == 0) || ($pi[0] == $pi[1])) { $mxsi = ''; }
        else { $mxsi = ' AND products__search.price BETWEEN '.$pi[0].' AND '.$pi[1].''; }
    } else { $mxsi = ''; }
    
    if (isset($_POST['refund'])) {
        $rfs = ' AND products__shipping.refund = 1';
    } else { $rfs = ''; }
    if (isset($_POST['backorder'])) {
        $brdo = ' AND products__inventory.backorder = 1';
    } else { $brdo = ''; }

    if (!isset($_POST['method'])) {
        $sql = "SELECT DISTINCT products__variations.model 
        FROM `products__search`
        ".$rsh."
        INNER JOIN products__variations ON products__variations.pid = products__search.pid 
        INNER JOIN products__category ON products__category.pid = products__search.pid 
        INNER JOIN products__status ON products__status.pid = products__search.pid 
        INNER JOIN products__inventory ON products__inventory.pid = products__search.pid 
        INNER JOIN products__shipping ON products__shipping.pid = products__search.pid 
        WHERE MATCH (products__search.name, products__search.category, products__search.tags, products__search.brand) AGAINST ('$term') ".$bims." ".$mxsi." ".$rfs." ".$brdo." ".$rsi." AND products__status.status = 1";

    } else {
        $sql = "SELECT DISTINCT products__variations.model 
        FROM `products__search` 
        INNER JOIN products__variations ON products__variations.pid = products__search.pid
        INNER JOIN products__category ON products__category.pid = products__search.pid 
        INNER JOIN products__status ON products__status.pid = products__search.pid 
        INNER JOIN products__inventory ON products__inventory.pid = products__search.pid 
        INNER JOIN products__shipping ON products__shipping.pid = products__search.pid 
        WHERE MATCH (products__search.name, products__search.category, products__search.tags, products__search.brand) AGAINST ('$term') OR products__search.name LIKE '%$term%' OR products__search.category LIKE '%$term%' OR products__search.tags LIKE '%$term%' OR products__search.brand LIKE '%$term%' AND products__status.status = 1";
    }

    // die($sql);

    $res = $con->query($sql); $nm = 0;
    while ($dt = $res->fetch_assoc()) { $model = $dt['model'];
        $gsql = "SELECT products.id, products.name, products.description, products.thumbnail, products__inventory.quantity, products__inventory.code, products__variations.color, products__variations.brand, products__variations.model, products__pricing.base, products__pricing.discounted, products__pricing.discount, products__category.tags, products__category.category FROM products INNER JOIN products__inventory ON products__inventory.pid = products.id INNER JOIN products__variations ON products__variations.pid = products.id INNER JOIN products__pricing ON products__pricing.pid = products.id INNER JOIN products__category ON products__category.pid = products.id WHERE model LIKE '$model' LIMIT 1";
        $gres = $con->query($gsql);
        while ($gd = $gres->fetch_assoc()) { $pdObj = new stdClass(); $nm++; $pid = $gd['id'];
            $ssql = "SELECT stars FROM reviews WHERE pid = $pid"; $sres = $con-> query($ssql); $son = 0; $stw = 0; $sth = 0; $sfo = 0; $sfi = 0; $savg = 0;
            if ($sres-> num_rows > 0) { while ($star = $sres-> fetch_assoc()) { $stv = $star['stars']; if ($stv == 5) { $sfi += 1; } if ($stv == 4) { $sfo += 1; } if ($stv == 3) { $sth += 1; } if ($stv == 2) { $stw += 1; } if ($stv == 1) { $son += 1; } $dv = ($sfi + $sfo + $sth + $stw + $son); }
            $savg = ((5 * $sfi) + (4 * $sfo) + (3 * $sth) + (2 * $stw) + (1 * $son)) / $dv; $st__avg = round($savg * 10) / 10; $pdObj->rev = $st__avg; } else { $pdObj->rev = 0; }
            $pdObj->pid = $gd['id']; $pdObj->name = $gd['name']; $pdObj->thumbnail = $gd['thumbnail']; $pdObj->quantity = $gd['quantity']; $pdObj->code = $gd['code']; $pdObj->color = $gd['color'];
            $pdObj->brand = $gd['brand']; $pdObj->model = $gd['model']; $pdObj->base = $gd['base']; $pdObj->discounted = $gd['discounted']; $pdObj->discount = $gd['discount']; $pdObj->tags = $gd['tags']; $pdObj->category = $gd['category'];
            array_push($pdArr, $pdObj);
        }
    } array_push($pdArr, $nm); die(json_encode($pdArr));
} else { die('No filter'); }
?>
