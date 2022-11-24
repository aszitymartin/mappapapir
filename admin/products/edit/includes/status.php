<?php require_once($_SERVER['DOCUMENT_ROOT'].'/includes/inc.php');
if(!$con) { die("Connection failed: " . mysqli_connect_error()); }
$pid = $_POST['pid']; 
$status = $_POST['product-status'];
if ($status == 3) { $stat__schedule = date ('Y-m-d H:i:s', strtotime($_POST['product-schedule'])); } else { $stat__schedule = NULL; }

$sql = "SELECT status FROM products__status WHERE pid = $pid"; $res = $con->query($sql);
if ($res->num_rows > 0) { $st = $res->fetch_assoc(); $old_stat = $st['status'];
    $sts = $con->prepare("UPDATE products__status SET status = ?, schedule = ? WHERE pid = ?"); $sts->bind_param('isi', $status, $stat__schedule, $pid); $sts->execute(); $sts->free_result(); $sts->close();
    if ($sts) { $log_categ = "Termék szerkesztése"; $log_desc = "#".$pid." termék státusza sikeresen meg lett változtatva (".$old_stat." -> ".$status.").";
        $log = $con->prepare("INSERT INTO log (uid, ip, category, description) VALUES (?, ?, ?, ?)"); $log->bind_param('isss', $_SESSION['id'], $_POST['ip'], $log_categ, $log_desc); $log->execute(); $log->free_result(); $log->close();
        die ('0');
    } else { die("A termék státuszának módosítása sikertelen volt"); }
} else { die('Ez a termék nem létezik'); }
?>