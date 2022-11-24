<?php require_once($_SERVER['DOCUMENT_ROOT'].'/includes/inc.php'); if(!$con) { die("Connection failed: " . mysqli_connect_error()); } $pid = $_POST['pid']; 
$sql = "SELECT title, description, keywords FROM products__meta WHERE pid = $pid"; $res = $con->query($sql);
if ($res->num_rows > 0) { $ct = $res->fetch_assoc(); $old__title = $ct['title']; $old__desc = $ct['description']; $old__keyw = $ct['keywords'];
    if ($old__title == $_POST['product-meta-title'] && $old__desc == $_POST['product-meta-desc'] && $old__keyw == $_POST['product-meta-keyw']) {
        die('Nem történt változtatás');
    } else {
        $ctg = $con->prepare("UPDATE products__meta SET title = ?, description = ?, keywords = ? WHERE pid = ?"); $ctg->bind_param('sssi', $_POST['product-meta-title'], $_POST['product-meta-desc'], $_POST['product-meta-keyw'], $pid); $ctg->execute(); $ctg->free_result(); $ctg->close();
        if ($ctg) { $log_categ = "Termék szerkesztése"; $log_desc = "#".$pid." termék meta adatai sikeresen meg lettek változtatva (Név: ".$old__title." -> ".$_POST['product-meta-title'].", Leírás: ".$old__desc." -> ".$_POST['product-meta-desc'].", Kulcsszavak: ". $old__keyw ." -> ".$_POST['product-meta-keyw'].").";
            $log = $con->prepare("INSERT INTO log (uid, ip, category, description) VALUES (?, ?, ?, ?)"); $log->bind_param('isss', $_SESSION['id'], $_POST['ip'], $log_categ, $log_desc); $log->execute(); $log->free_result(); $log->close();
            die ('0');
        } else { die("A termék nem lett módosítva"); }
    }
} else { die('Ez a termék nem létezik'); }
?>