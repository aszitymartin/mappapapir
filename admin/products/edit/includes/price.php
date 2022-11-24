<?php require_once($_SERVER['DOCUMENT_ROOT'].'/includes/inc.php');
if(!$con) { die("Connection failed: " . mysqli_connect_error()); } $pid = $_POST['pid']; 
if ($_POST['discounted'] === 'true') { $discounted = 1; $st__discount = date ('Y-m-d H:i:s', strtotime($_POST['discount-start'])); $ed__discount = date ('Y-m-d H:i:s', strtotime('+' . $_POST['discount-end'] . ' day'. $_POST['discount-start'])); }
else { $discounted = 0; $st__discount = NULL; $ed__discount = NULL; }

$sql = "SELECT base, discounted, discount, start, end FROM products__pricing WHERE pid = $pid"; $res = $con->query($sql);
if ($res->num_rows > 0) { $ct = $res->fetch_assoc(); $old__base = $ct['base']; $old__dcd = $ct['discounted']; $old__discount = $ct['discount']; $old__start = $ct['start']; $old__end = $ct['end'];
    if ($old__base == $_POST['product-price'] && $old__dcd == $discounted && $old__discount == $_POST['product-discount'] && $old__start == $st__discount && $old__end == $ed__discount) { die('Nem történt változtatás'); } 
    else { $ctg = $con->prepare("UPDATE products__pricing SET base = ?, discounted = ?, discount = ?, start = ?, end = ? WHERE pid = ?"); $ctg->bind_param('iiissi', $_POST['product-price'], $discounted, $_POST['product-discount'], $st__discount, $ed__discount, $pid); $ctg->execute(); $ctg->free_result(); $ctg->close();
        if ($ctg) { $log_categ = "Termék szerkesztése"; $log_desc = "#".$pid." termék árazása sikeresen meg lett változtatva (Alapár: ".$old__base." -> ".$_POST['product-price'].", Leárazva: ".$old__dcd." -> ".$_POST['discounted'].", Leárazás: ".$old__discount." -> ".$_POST['product-discount'].", Leárazás kezdete: ".$old__start." -> ".$st__discount.", Leárazás vége: ".$old__end." -> ".$ed__discount.").";
            $log = $con->prepare("INSERT INTO log (uid, ip, category, description) VALUES (?, ?, ?, ?)"); $log->bind_param('isss', $_SESSION['id'], $_POST['ip'], $log_categ, $log_desc); $log->execute(); $log->free_result(); $log->close();
            $srch = $con->prepare("UPDATE products__search SET price = ? WHERE pid = ?"); $srch->bind_param('ii', $_POST['product-price'], $pid); $srch->execute(); $srch->free_result(); $srch->close();
            die ('0');
        } else { die("A termék kategóriája nem lett módosítva"); }
    }
} else { die('Ez a termék nem létezik'); }
?>