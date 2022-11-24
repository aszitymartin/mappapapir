<?php require_once($_SERVER['DOCUMENT_ROOT'].'/includes/inc.php');
if(!$con) { die("Connection failed: " . mysqli_connect_error()); }
function check ($type) { $exten = ['png', 'jpg', 'jpeg']; if (in_array($type, $exten)) { return true; } else { return false; } }
function upload ($file) { $target_dir = $_SERVER['DOCUMENT_ROOT'].'/assets/images/uploads/'; $name = basename($file['name']); $type = $file['type']; $tmp = $file['tmp_name']; $doc = substr(md5(rand()), 0, 7) . '' . date('YmdHis') . '.' . basename($type); if (move_uploaded_file($tmp, $target_dir . '' . $doc)) { return $doc; } else { return false; die('Miniatűr feltöltése meghiusúlt, a termék nem lett létrehozva.'); } }
$pid = $_POST['pid']; $thumbArr = array(); $thumbnail = $_FILES['product-thumbnail'];
if (!isset($thumbnail['name'])) { die('Hibás képfeltöltés'); }
$sql = "SELECT thumbnail FROM products WHERE id = $pid"; $res = $con->query($sql); 
if ($res->num_rows > 0) {
    $thm = $res->fetch_assoc();
    if (file_exists($_SERVER['DOCUMENT_ROOT'].'/assets/images/uploads/'.$thm['thumbnail'])) {
        unlink($_SERVER['DOCUMENT_ROOT'].'/assets/images/uploads/'.$thm['thumbnail']);
        if (check(basename($thumbnail['type']))) { array_push($thumbArr, upload($thumbnail)); $thumbn = $thumbArr[0]; 
            $log_categ = "Termék szerkesztése"; $log_desc = "#".$pid." termék thumbnailja sikeresen meg lett változtatva.";
            $gen = $con->prepare("UPDATE products SET thumbnail = ? WHERE id = ?"); $gen->bind_param('si', $thumbn, $pid); $gen->execute(); $gen->free_result(); $gen->close();
            if ($gen) { $log = $con->prepare("INSERT INTO log (uid, ip, category, description) VALUES (?, ?, ?, ?)"); $log->bind_param('isss', $_SESSION['id'], $_POST['ip'], $log_categ, $log_desc); $log->execute(); $log->free_result(); $log->close(); }
            die('0');
        } else { die('Kép feltöltése sikertelen'); }
    } else { die('A törölni kívánt kép nem létezik'); }
} else { die('Ez a termék nem létezik'); }

?>