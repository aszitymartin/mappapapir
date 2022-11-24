<?php require_once($_SERVER['DOCUMENT_ROOT'].'/includes/inc.php'); if(!$con) { die("Connection failed: " . mysqli_connect_error()); } $pid = $_POST['pid']; 
$sql = "SELECT code, quantity, q__warehouse, unit, backorder FROM products__inventory WHERE pid = $pid"; $res = $con->query($sql);
if ($res->num_rows > 0) { $ct = $res->fetch_assoc(); $old__code = $ct['code']; $old__quantity = $ct['quantity']; $old__qwh = $ct['q__warehouse']; $old__unit = $ct['unit']; $old__backorder = $ct['backorder'];
    if ($old__code == $_POST['product-code'] && $old__quantity == $_POST['product-quantity'] && $old__qwh == $_POST['product-quantity-wh'] && $old__unit == $_POST['product-quantity-unit'] && $old__backorder == $_POST['product-backorder']) {
        die('Nem történt változtatás');
    } else {
        $ctg = $con->prepare("UPDATE products__inventory SET code = ?, quantity = ?, q__warehouse = ?, unit = ?, backorder = ? WHERE pid = ?"); $ctg->bind_param('siisii', $_POST['product-code'], $_POST['product-quantity'], $_POST['product-quantity-wh'], $_POST['product-quantity-unit'], $_POST['product-backorder'], $pid); $ctg->execute(); $ctg->free_result(); $ctg->close();
        if ($ctg) { $log_categ = "Termék szerkesztése"; $log_desc = "#".$pid." termék raktár adatai sikeresen meg lettek változtatva (Azonosító: ".$old_code." -> ".$_POST['product-code'].", Mennyiség: ".$old__quantity." -> ".$_POST['product-quantity'].", Raktár mennyiség: ". $old__qwh ." -> ".$_POST['product-quantity-wh'].", Mértékegység: ".$old__unit." -> ".$_POST['product-quantity-unit'].", Utólagos rendelések: ".$old__backorder." -> ".$_POST['product-backorder'].").";
            $log = $con->prepare("INSERT INTO log (uid, ip, category, description) VALUES (?, ?, ?, ?)"); $log->bind_param('isss', $_SESSION['id'], $_POST['ip'], $log_categ, $log_desc); $log->execute(); $log->free_result(); $log->close();
            $srch = $con->prepare("UPDATE products__search SET backorder = ? WHERE pid = ?"); $srch->bind_param('ii', $_POST['product-backorder'], $pid); $srch->execute(); $srch->free_result(); $srch->close();
            die ('0');
        } else { die("A termék nem lett módosítva"); }
    }
} else { die('Ez a termék nem létezik'); }
?>