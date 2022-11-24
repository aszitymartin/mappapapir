<?php require_once($_SERVER['DOCUMENT_ROOT'].'/includes/inc.php');
if(!$con) { die("Connection failed: " . mysqli_connect_error()); }
$pid = $_POST['pid']; 

$sql = "SELECT name, description FROM products WHERE id = $pid"; $res = $con->query($sql);
if ($res->num_rows > 0) { $ct = $res->fetch_assoc(); $old__name = $ct['name']; $old__desc = $ct['description'];
    if ($old__name !== $_POST['product-name'] || $old__desc !== $_POST['product-description']) {
        $ctg = $con->prepare("UPDATE products SET name = ?, description = ? WHERE id = ?"); $ctg->bind_param('ssi', $_POST['product-name'], $_POST['product-description'], $pid); $ctg->execute(); $ctg->free_result(); $ctg->close();
        if ($ctg) { $log_categ = "Termék szerkesztése"; $log_desc = "#".$pid." termék neve / leírása sikeresen meg lett változtatva (Név: ".$old_name." -> ".$_POST['product-name'].", Leírás: ".$old__desc." -> ".$_POST['product-description'].").";
            $log = $con->prepare("INSERT INTO log (uid, ip, category, description) VALUES (?, ?, ?, ?)"); $log->bind_param('isss', $_SESSION['id'], $_POST['ip'], $log_categ, $log_desc); $log->execute(); $log->free_result(); $log->close();
            $newname = str_replace(' ', '-',strtolower(strtr($_POST['product-name'], $unwanted_array)));
            $srch = $con->prepare("UPDATE products__search SET name = ? WHERE pid = ?"); $srch->bind_param('si', $newname, $pid); $srch->execute(); $srch->free_result(); $srch->close();
            die ('0');
        } else { die("Nem történt változtatás"); }
    } else { die('Nem történt változtatás'); }
} else { die('Ez a termék nem létezik'); }
?>