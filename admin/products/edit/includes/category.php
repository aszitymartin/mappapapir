<?php require_once($_SERVER['DOCUMENT_ROOT'].'/includes/inc.php');
if(!$con) { die("Connection failed: " . mysqli_connect_error()); }
$pid = $_POST['pid']; 

$sql = "SELECT category, tags FROM products__category WHERE pid = $pid"; $res = $con->query($sql);
if ($res->num_rows > 0) { $ct = $res->fetch_assoc(); $old__cat = $ct['category']; $old__tags = $ct['tags'];
    if ($old__cat !== $_POST['product-category'] && $old__tags !== $_POST['product-tags']) {
        $ctg = $con->prepare("UPDATE products__category SET category = ?, tags = ? WHERE pid = ?"); $ctg->bind_param('ssi', $_POST['product-category'], $_POST['product-tags'], $pid); $ctg->execute(); $ctg->free_result(); $ctg->close();
        if ($ctg) { $log_categ = "Termék szerkesztése"; $log_desc = "#".$pid." termék kategóriája sikeresen meg lett változtatva (Kategória: ".$old_cat." -> ".$_POST['product-category'].", Címkék: ".$old__tags." -> ".$_POST['product-tags'].").";
            $log = $con->prepare("INSERT INTO log (uid, ip, category, description) VALUES (?, ?, ?, ?)"); $log->bind_param('isss', $_SESSION['id'], $_POST['ip'], $log_categ, $log_desc); $log->execute(); $log->free_result(); $log->close();
            $newcateg = str_replace(' ', '-',strtolower(strtr($_POST['product-category'], $unwanted_array))); $newtag = str_replace(' ', '-',strtolower(strtr($_POST['product-tags'], $unwanted_array)));
            $srch = $con->prepare("UPDATE products__search SET category = ?, tags = ? WHERE pid = ?"); $srch->bind_param('ssi', $newcateg, $newtag, $pid); $srch->execute(); $srch->free_result(); $srch->close();
            die ('0');
        } else { die("A termék kategóriája nem lett módosítva"); }
    } else { die('Nem történt változtatás'); }
} else { die('Ez a termék nem létezik'); }
?>