<?php require_once($_SERVER['DOCUMENT_ROOT'].'/includes/inc.php');
if(!$con) { die("Connection failed: " . mysqli_connect_error()); } $uploaded = array();
function check ($type) { $exten = ['png', 'jpg', 'jpeg']; if (in_array($type, $exten)) { return true; } else { return false; } }
function upload ($file) { $target_dir = $_SERVER['DOCUMENT_ROOT'].'/assets/images/uploads/'; $name = basename($file['name']); $type = $file['type']; $tmp = $file['tmp_name']; $doc = substr(md5(rand()), 0, 7) . '' . date('YmdHis') . '.' . basename($type); if (move_uploaded_file($tmp, $target_dir . '' . $doc)) { return $doc; } else { return false; die('Miniatűr feltöltése meghiusúlt, a termék nem lett létrehozva.'); } }
$pid = $_POST['pid'];
if ($_FILES['miniature1']) { $min1 = $_FILES['miniature1']; } if ($_FILES['miniature2']) { $min2 = $_FILES['miniature2']; } if ($_FILES['miniature3']) { $min3 = $_FILES['miniature3']; } if ($_FILES['miniature4']) { $min4 = $_FILES['miniature4']; } if ($_FILES['miniature5']) { $min5 = $_FILES['miniature5']; }


if (isset($min1)) { if (check(basename($min1['type']))) { array_push($uploaded, upload($min1)); } }
if (isset($min2)) { if (check(basename($min2['type']))) { array_push($uploaded, upload($min2)); } } if (isset($min3)) { if (check(basename($min3['type']))) { array_push($uploaded, upload($min3)); } }
if (isset($min4)) { if (check(basename($min4['type']))) { array_push($uploaded, upload($min4)); } } if (isset($min5)) { if (check(basename($min5['type']))) { array_push($uploaded, upload($min5)); } }
$miniatures = implode(",", $uploaded);

$sql = "SELECT images FROM products__media WHERE pid = $pid"; $res = $con->query($sql); 
if ($res->num_rows > 0) {
    $thm = $res->fetch_assoc(); $mins = explode(',', $thm['images']);

    $log_categ = "Termék szerkesztése"; $log_desc = "#".$pid." termék miniatűrjei sikeresen meg lettek változtatva. (".$thm['images']." -> ".$miniatures.")";
    $gen = $con->prepare("UPDATE products__media SET images = ? WHERE pid = ?"); $gen->bind_param('si', $miniatures, $pid); $gen->execute(); $gen->free_result(); $gen->close();
    if ($gen) { $log = $con->prepare("INSERT INTO log (uid, ip, category, description) VALUES (?, ?, ?, ?)"); $log->bind_param('isss', $_SESSION['id'], $_POST['ip'], $log_categ, $log_desc); $log->execute(); $log->free_result(); $log->close();
        for ($i = 0; $i < sizeof($mins); $i++) {
            if (file_exists($_SERVER['DOCUMENT_ROOT'].'/assets/images/uploads/'.$mins[$i])) {
                unlink($_SERVER['DOCUMENT_ROOT'].'/assets/images/uploads/'.$mins[$i]);
            } else { die('Az eltávolítandó kép(ek) nem található(ak) a szerveren'); }
        } die('0');
    } else { die('Kép(ek) feltöltése sikertelen'); }
} else { die('Ez a termék nem létezik'); }
?>