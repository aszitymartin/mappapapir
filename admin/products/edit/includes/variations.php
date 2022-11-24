<?php require_once($_SERVER['DOCUMENT_ROOT'].'/includes/inc.php'); if(!$con) { die("Connection failed: " . mysqli_connect_error()); } $pid = $_POST['pid']; 
$sql = "SELECT color, material, style, brand, model, custom FROM products__variations WHERE pid = $pid"; $res = $con->query($sql);
if ($res->num_rows > 0) { $ct = $res->fetch_assoc(); $old__color = $ct['color']; $old__material = $ct['material']; $old__style = $ct['style']; $old__brand = $ct['brand']; $old__model = $ct['model']; $old__custom = $ct['custom'];
    if ($old__color == $_POST['product-color'] && $old__material == $_POST['product-material'] && $old__style == $_POST['product-style'] && $old__brand == $_POST['product-brand'] && $old__model == $_POST['product-model'] && $old__custom == $_POST['custom']) {
        die('Nem történt változtatás');
    } else {
        $ctg = $con->prepare("UPDATE products__variations SET color = ?, material = ?, style = ?, brand = ?, model = ?, custom = ? WHERE pid = ?"); $ctg->bind_param('ssssssi', $_POST['product-color'], $_POST['product-material'], $_POST['product-style'], $_POST['product-brand'], $_POST['product-model'], $_POST['custom'], $pid); $ctg->execute(); $ctg->free_result(); $ctg->close();
        if ($ctg) { $log_categ = "Termék szerkesztése"; $log_desc = "#".$pid." termék variációi sikeresen meg lettek változtatva (Szín: ".$old__color." -> ".$_POST['product-color'].", Anyag: ".$old__material." -> ".$_POST['product-material'].", Stílus: ". $old__style ." -> ".$_POST['product-style'].", Márka: ".$old__brand." -> ".$_POST['product-brand'].", Egyedi: ".$old__custom." -> ".$_POST['custom'].").";
            $log = $con->prepare("INSERT INTO log (uid, ip, category, description) VALUES (?, ?, ?, ?)"); $log->bind_param('isss', $_SESSION['id'], $_POST['ip'], $log_categ, $log_desc); $log->execute(); $log->free_result(); $log->close();
            $newbrand = str_replace(' ', '-',strtolower(strtr($_POST['product-brand'], $unwanted_array)));
            $srch = $con->prepare("UPDATE products__search SET brand = ? WHERE pid = ?"); $srch->bind_param('si', $newbrand, $pid); $srch->execute(); $srch->free_result(); $srch->close();
            die ('0');
        } else { die("A termék nem lett módosítva"); }
    }
} else { die('Ez a termék nem létezik'); }
?>