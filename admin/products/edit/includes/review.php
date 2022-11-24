<?php require_once($_SERVER['DOCUMENT_ROOT'].'/includes/inc.php'); if(!$con) { die("Connection failed: " . mysqli_connect_error()); } $pid = $_POST['pid']; 
$sql = "SELECT enable, auth, vote, privacy FROM products__review WHERE pid = $pid"; $res = $con->query($sql);
if ($res->num_rows > 0) { $ct = $res->fetch_assoc(); $old__enable = $ct['enable']; $old__auth = $ct['auth']; $old__vote = $ct['vote']; $old__privacy = $ct['privacy'];
    if ($old__enable == $_POST['enable'] && $old__auth == $_POST['auth'] && $old__vote == $_POST['vote'] && $old__privacy == $_POST['privacy']) {
        die('Nem történt változtatás');
    } else {
        $ctg = $con->prepare("UPDATE products__review SET enable = ?, auth = ?, vote = ?, privacy = ? WHERE pid = ?"); $ctg->bind_param('iiiii', $_POST['enable'], $_POST['auth'], $_POST['vote'], $_POST['privacy'], $pid); $ctg->execute(); $ctg->free_result(); $ctg->close();
        if ($ctg) { $log_categ = "Termék szerkesztése"; $log_desc = "#".$pid." termék véleményezésének beállításai sikeresen meg lettek változtatva (Engedélyezés: ".$old__enable." -> ".$_POST['enable'].", Hitelesítés: ".$old__auth." -> ".$_POST['auth'].", Szavazás: ". $old__vote ." -> ".$_POST['vote'].", Nevek feltűntetése: ". $old__privacy ."  -> ".$_POST['privacy'].").";
            $log = $con->prepare("INSERT INTO log (uid, ip, category, description) VALUES (?, ?, ?, ?)"); $log->bind_param('isss', $_SESSION['id'], $_POST['ip'], $log_categ, $log_desc); $log->execute(); $log->free_result(); $log->close();
            die ('0');
        } else { die("A termék nem lett módosítva"); }
    }
} else { die('Ez a termék nem létezik'); }
?>