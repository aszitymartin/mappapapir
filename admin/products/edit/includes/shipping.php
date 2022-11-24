<?php require_once($_SERVER['DOCUMENT_ROOT'].'/includes/inc.php'); if(!$con) { die("Connection failed: " . mysqli_connect_error()); } $pid = $_POST['pid']; 
if ($_POST['physical'] == 1) { $weight = $_POST['product-weight']; $weightU = $_POST['product-weight-unit']; $width = $_POST['product-width']; $height = $_POST['product-height']; $length = $_POST['product-length']; $dimension = $_POST['product-dimension']; }
else { $weight = NULL; $weightU = NULL; $width = NULL; $height = NULL; $length = NULL; $dimension = NULL; }
$sql = "SELECT physical, weight, w__unit, width, height, length, d__unit, refund FROM products__shipping WHERE pid = $pid"; $res = $con->query($sql);
if ($res->num_rows > 0) { $ct = $res->fetch_assoc(); $old__physical = $ct['physical']; $old__weight = $ct['weight']; $old__wu = $ct['w__unit']; $old__width = $ct['width']; $old__height = $ct['height']; $old__length = $ct['length']; $old__dimen = $ct['d__unit']; $old__refund = $ct['refund'];
    if ($old__physical == $_POST['product-physical'] && $old__weight == $_POST['product-weight'] && $old__wu == $_POST['product-weight-unit'] && $old__width == $_POST['product-width'] && $old__height == $_POST['product-height'] && $old__length == $_POST['product-length'] && $old__dimen == $_POST['product-dimension'] && $old__refund == $_POST['product-refund']) {
        die('Nem történt változtatás');
    } else {
        $ctg = $con->prepare("UPDATE products__shipping SET physical = ?, weight = ?, w__unit = ?, width = ?, height = ?, length = ?, d__unit = ?, refund = ? WHERE pid = ?"); $ctg->bind_param('iisiiisii', $_POST['product-physical'], $_POST['product-weight'], $_POST['product-weight-unit'], $_POST['product-width'], $_POST['product-height'], $_POST['product-length'], $_POST['product-dimension'], $_POST['product-refund'], $pid); $ctg->execute(); $ctg->free_result(); $ctg->close();
        if ($ctg) { $log_categ = "Termék szerkesztése"; $log_desc = "#".$pid." termék szállítási adatai sikeresen meg lettek változtatva (Fizikai: ".$old__physical." -> ".$_POST['product-physical'].", Súly: ".$old__weight." -> ".$_POST['product-weight'].", Súly mért: ". $old__wu ." -> ".$_POST['product-weight-unit'].", Hossz: ".$old__width." -> ".$_POST['product-width'].", Magasság: ".$old__height." -> ".$_POST['product-height'].", Szélesség: ". $old__length ." -> ". $_POST['product-length'] .", Dimenzió mért: ". $old__dimen ." -> ". $_POST['product-dimension'] .", Visszatérítés: ". $old__refund ." -> ". $_POST['product-refund'] .").";
            $log = $con->prepare("INSERT INTO log (uid, ip, category, description) VALUES (?, ?, ?, ?)"); $log->bind_param('isss', $_SESSION['id'], $_POST['ip'], $log_categ, $log_desc); $log->execute(); $log->free_result(); $log->close();
            $srch = $con->prepare("UPDATE products__search SET refund = ? WHERE pid = ?"); $srch->bind_param('ii', $_POST['product-refund'], $pid); $srch->execute(); $srch->free_result(); $srch->close();
            die ('0');
        } else { die("A termék nem lett módosítva"); }
    }
} else { die('Ez a termék nem létezik'); }
?>