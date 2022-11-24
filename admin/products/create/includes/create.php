<?php  require_once($_SERVER['DOCUMENT_ROOT'].'/includes/inc.php'); include($_SERVER['DOCUMENT_ROOT'].'/assets/alph.php');
if(!$con) { die("Connection failed: " . mysqli_connect_error()); } $uploaded = array(); $thumbArr = array(); $thumbStat = false; $errArr = array(); $errors = new stdClass(); $errGeneral = new stdClass(); $errAdvanced = new stdClass(); 

$eGeneral = new stdClass(); $eStatus = new stdClass(); $eCategory = new stdClass(); $ePricing = new stdClass();
$eInventory = new stdClass(); $eVariations = new stdClass(); $eShipping = new stdClass(); $eMeta = new stdClass();
if ($_FILES['miniature1']) { $min1 = $_FILES['miniature1']; } if ($_FILES['miniature2']) { $min2 = $_FILES['miniature2']; } if ($_FILES['miniature3']) { $min3 = $_FILES['miniature3']; } if ($_FILES['miniature4']) { $min4 = $_FILES['miniature4']; } if ($_FILES['miniature5']) { $min5 = $_FILES['miniature5']; }
function check ($type) { $exten = ['png', 'jpg', 'jpeg']; if (in_array($type, $exten)) { return true; } else { return false; } }
function upload ($file) { $target_dir = $_SERVER['DOCUMENT_ROOT'].'/assets/images/uploads/'; $name = basename($file['name']); $type = $file['type']; $tmp = $file['tmp_name']; $doc = substr(md5(rand()), 0, 7) . '' . date('YmdHis') . '.' . basename($type); if (move_uploaded_file($tmp, $target_dir . '' . $doc)) { return $doc; } else { return false; die('Miniatűr feltöltése meghiusúlt, a termék nem lett létrehozva.'); } }

$thumbnail = $_FILES['thumbnail'];
$name = mysqli_real_escape_string($con, $_POST['name']);
$description = mysqli_real_escape_string($con, $_POST['description']);
$status = mysqli_real_escape_string($con, $_POST['status']); if ($status == 3) { $schedule = $_POST['schedule']; }
$category = mysqli_real_escape_string($con, $_POST['category']);
$tags = mysqli_real_escape_string($con, $_POST['tags']);
$price = mysqli_real_escape_string($con, $_POST['price']);
$discount = mysqli_real_escape_string($con, $_POST['discount']);
if ($discount == 1) { $discount__range = mysqli_real_escape_string($con, $_POST['discount__range']); $discount__start = mysqli_real_escape_string($con, $_POST['discount__start']); $discount__end = mysqli_real_escape_string($con, $_POST['discount__end']); }
$code = mysqli_real_escape_string($con, $_POST['code']);
$quantity = mysqli_real_escape_string($con, $_POST['quantity']);
$quantity__wh = mysqli_real_escape_string($con, $_POST['quantity__wh']);
$quantity__unit = mysqli_real_escape_string($con, $_POST['quantity__unit']);
$backorder = mysqli_real_escape_string($con, $_POST['backorder']); if ($backorder === 'false') { $backorder = '0'; } else { $backorder = '1'; }
$color = mysqli_real_escape_string($con, $_POST['color']);
$material = mysqli_real_escape_string($con, $_POST['material']);
$style = mysqli_real_escape_string($con, $_POST['style']);
$brand = mysqli_real_escape_string($con, $_POST['brand']);
$model = mysqli_real_escape_string($con, $_POST['model']);
if (isset($_POST['variations'])) { $variations = mysqli_real_escape_string($con, $_POST['variations']); } else { $variations = NULL; }
$physical = mysqli_real_escape_string($con, $_POST['physical']); if ($physical === 'false') { $physical = '0'; } else { $physical = '1'; }
if ($physical) { $weight = mysqli_real_escape_string($con, $_POST['weight']); $weight__unit = mysqli_real_escape_string($con, $_POST['weight__unit']); $width = mysqli_real_escape_string($con, $_POST['width']); $height = mysqli_real_escape_string($con, $_POST['height']); $length = mysqli_real_escape_string($con, $_POST['length']); $dimension__unit = mysqli_real_escape_string($con, $_POST['dimension__unit']); }
$refund = mysqli_real_escape_string($con, $_POST['refund']);
$meta__title = mysqli_real_escape_string($con, $_POST['meta__title']);
$meta__description = mysqli_real_escape_string($con, $_POST['meta__description']);
$meta__keywords = mysqli_real_escape_string($con, $_POST['meta__keywords']);
$review__allow = mysqli_real_escape_string($con, $_POST['review__allow']);
$review__auth = mysqli_real_escape_string($con, $_POST['review__auth']);
$review__vote = mysqli_real_escape_string($con, $_POST['review__vote']);
$review__privacy = mysqli_real_escape_string($con, $_POST['review__privacy']);

if (strlen($name) < 3) { $eGeneral->name = "A termék neve mező érvénytelenül lett kitöltve"; }
if (!isset($thumbnail['name'])) { $eGeneral->thumbnail = "A termék fő képét nem töltötte fel"; }
if (strlen($description) < 64) { $eGeneral->description = "A termék leírása mező érvénytelenül lett kitöltve"; }
if ($status < 1) { $eStatus->status = "Nem választotta ki a termék státuszát"; }
if ($status == 3) { if (strlen($schedule) < 3) { $eStatus->schedule = "A termék ütemezése érvénytelenül lett megadva"; } }
if (strlen($category) < 3) { $eCategory->category = "A termék kategóriája érvénytelenül lett megadva"; }
if (strlen($tags) < 3) { $eCategory->tags = "A címkék mező érvénytelenül lett kitöltve"; }
if ($price < 1) { $ePricing->price = "A termék ára érvénytelenül lett megadva"; }
if ($discount == 1) { 
    if ($discount__range <= 0 || $discount__range > 100) { $ePricing->discount__range = "A leárazás százaléka érvénytelenül lett megadva"; } 
    if (strlen($discount__start) < 3) { $ePricing->discount__start = "A leárazás kezdete érvénytelenül lett kitöltve"; }
    if ($discount__end < 1) { $ePricing->discount__end = "A leárazás vége érvénytelenül lett kitöltve"; } } else { $discount__start = NULL; $discount__end = NULL; $discount__range = 0; }

if (strlen($code) < 3) { $eInventory->code = "A termékazonosító mező érvénytelenül lett kitöltve"; }
if ($quantity < 1) { $eInventory->quantity = "A termék mennyisége mező érvénytelenül lett kitöltve"; }
if ($quantity__wh < 1) { $eInventory->quantity__wh = "A termék raktáron lévő mennyisége érvénytelenül lett megadva"; }
if (strlen($quantity__unit) < 2) { $eInventory->quantity__unit = "A termék mennyiségét jelző mértékegység érvénytelenül lett kitöltve"; }
if (strlen($color) < 3) { $eVariations->color = "A termék színe érvénytelenül lett megadva"; }
if (strlen($material) < 3) { $eVariations->material = "A termék anyaga érvénytelenül lett kitöltve"; }
if (strlen($style) < 3) { $eVariations->style = "A termék stílusa érvénytelenül lett kitöltve"; }
if (strlen($brand) < 3) { $eVariations->brand = "A termék márkája érvénytelenül lett kitöltve"; }
if (strlen($model) < 3) { $eVariations->model = "A termék modell száma érvénytelenül lett kitöltve"; }
if ($physical === 'true') {
    if ($weight < 1) { $eShipping->weight = "A termék súlya érvénytelenül lett megadva"; }
    if (strlen($weight__unit) < 3) { $eShipping->weight__unit = "A termék anyagát jelző mértékegység érvénytelenül lett megadva"; }
    if ($width < 1) { $eShipping->width = "A termék szélessége érvénytelenül lett megadva"; }
    if ($height < 1) { $eShipping->height = "A termék magassága érvénytelenül lett megadva"; }
    if ($length < 1) { $eShipping->length = "A termék hossza érvénytelenül lett megadva"; }
    if (strlen($dimension__unit) < 3) { $eShipping->dimension__unit = "A termék dimenzióit jelző mértékegység érvénytelenül lett megadva"; }
} if ($refund === 'true') { $refund = 1; } else { $refund = 0; }
if (strlen($meta__title) < 3) { $eMeta->meta__title = "A termék meta címkéjének nevét érvénytelenül adta meg"; }
if (strlen($meta__description) < 64) { $eMeta->meta__description = "A termék meta címkéjének leírását érvénytelenül adta meg"; }
if (strlen($meta__keywords) < 3) { $eMeta->meta__keywords = "A termék meta címkéjének kulcsszavait érvénytelenül adta meg"; }

$errGeneral->general = $eGeneral; $errGeneral->status = $eStatus; $errGeneral->category = $eCategory; $errGeneral->pricing = $ePricing;
$errAdvanced->inventory = $eInventory; $errAdvanced->variations = $eVariations; $errAdvanced->shipping = $eShipping; $errAdvanced->meta = $eMeta;
$errors->general = $errGeneral; $errors->advanced = $errAdvanced; array_push($errArr, json_encode($errors));
if (count((array)$eGeneral) < 1 && count((array)$eStatus) < 1  && count((array)$eCategory) < 1 && count((array)$ePricing) < 1 && count((array)$eInventory) < 1
&& count((array)$eVariations) < 1 && count((array)$eShipping) < 1 && count((array)$eMeta) < 1) { $errArr = array(); }
if (sizeof($errArr) < 1) {

    if ($status == 3) { $stat__schedule = date ('Y-m-d H:i:s', strtotime($schedule)); } else { $stat__schedule = NULL; }
    if ($discount == 1) { $st__discount = date ('Y-m-d H:i:s', strtotime($discount__start)); $ed__discount = date ('Y-m-d H:i:s', strtotime('+' . $discount__end . ' day'. $discount__start)); }
    else { $st__discount = NULL; $ed__discount = NULL; }
    if ($review__allow === 'true') { $review__allow = 1; } else { $review__allow = 0; } if ($review__auth === 'true') { $review__auth = 1; } else { $review__auth = 0; } if ($review__vote === 'true') { $review__vote = 1; } else { $review__vote = 0; } if ($review__privacy === 'true') { $review__privacy = 1; } else { $review__privacy = 0; }
    
    if (check(basename($thumbnail['type']))) { array_push($thumbArr, upload($thumbnail)); $thumbn = $thumbArr[0]; } if (isset($min1)) { if (check(basename($min1['type']))) { array_push($uploaded, upload($min1)); } }
    if (isset($min2)) { if (check(basename($min2['type']))) { array_push($uploaded, upload($min2)); } } if (isset($min3)) { if (check(basename($min3['type']))) { array_push($uploaded, upload($min3)); } }
    if (isset($min4)) { if (check(basename($min4['type']))) { array_push($uploaded, upload($min4)); } } if (isset($min5)) { if (check(basename($min5['type']))) { array_push($uploaded, upload($min5)); } }
    $miniatures = implode(",", $uploaded);

    $stmt = $con->prepare("INSERT INTO products (name, description, thumbnail) VALUES (?, ?, ?)");
    $stmt->bind_param('sss', $name, $description, $thumbn); $stmt->execute(); $stmt->free_result(); $stmt->close(); $con->next_result();
    if ($stmt) {
        $gp = $con->prepare("SELECT id FROM products WHERE name = ? AND description = ? AND thumbnail = ?");
        $gp->bind_param('sss', $name, $description, $thumbn); $gp->execute(); 
        $gp->bind_result($pid); $gp->fetch(); $gp->free_result(); $gp->close(); $con->next_result();
        if ($gp) { $gpid = $pid;
            function prepError () { $rm = $con->prepare("DELETE FROM products WHERE id = ?"); $rm->bind_param('i', $gpid); $rm->execute(); die('Sikertelen művelet! (MYSQL INSERT ERROR)'); }
            try {
                $cat = $con->prepare("INSERT INTO products__category (pid, category, tags) VALUES (?, ?, ?)");
                $cat->bind_param('iss', $gpid, $category, $tags); $cat->execute(); $cat->free_result(); $cat->close(); $con->next_result();
                if ($cat) {
                    $inv = $con->prepare("INSERT INTO products__inventory (pid, code, quantity, q__warehouse, unit, backorder) VALUES (?, ?, ?, ?, ?, ?)");
                    $inv->bind_param('isiisi', $gpid, $code, $quantity, $quantity__wh, $quantity__unit, $backorder); $inv->execute(); $inv->free_result(); $inv->close(); $con->next_result();
                    if ($inv) {
                        $med = $con->prepare("INSERT INTO products__media (pid, images) VALUES (?, ?)");
                        $med->bind_param('is', $gpid, $miniatures); $med->execute(); $med->free_result(); $med->close(); $con->next_result();
                        if ($med) {
                            $met = $con->prepare("INSERT INTO products__meta (pid, title, description, keywords) VALUES (?, ?, ?, ?)");
                            $met->bind_param('isss', $gpid, $meta__title, $meta__description, $meta__keywords); $met->execute(); $met->free_result(); $met->close(); $con->next_result();
                            if ($met) {
                                $pri = $con->prepare("INSERT INTO products__pricing (pid, base, discounted, discount, start, end) VALUES (?, ?, ?, ?, ?, ?)");
                                $pri->bind_param('iiiiss', $gpid, $price, $discount, $discount__range, $st__discount, $ed__discount); $pri->execute(); $pri->free_result(); $pri->close(); $con->next_result();
                                if ($pri) {
                                    $rev = $con->prepare("INSERT INTO products__review (pid, enable, auth, vote, privacy) VALUES (?, ?, ?, ?, ?)");
                                    $rev->bind_param('iiiii', $gpid, $review__allow, $review__auth, $review__vote, $review__privacy); $rev->execute(); $rev->free_result(); $rev->close(); $con->next_result();
                                    if ($rev) {
                                        $shi = $con->prepare("INSERT INTO products__shipping (pid, physical, weight, w__unit, width, height, length, d__unit, refund) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
                                        $shi->bind_param('iiisiiisi', $gpid, $physical, $weight, $weight__unit, $width, $height, $length, $dimension__unit, $refund); $shi->execute(); $shi->free_result(); $shi->close(); $con->next_result();
                                        if ($shi) {
                                            $sta = $con->prepare("INSERT INTO products__status (pid, status, schedule) VALUES (?, ?, ?)");
                                            $sta->bind_param('iis', $gpid, $status, $stat__schedule); $sta->execute(); $sta->free_result(); $sta->close(); $con->next_result();
                                            if ($sta) {
                                                $var = $con->prepare("INSERT INTO products__variations (pid, color, material, style, brand, model, custom) VALUES (?, ?, ?, ?, ?, ?, ?)");
                                                $var->bind_param('issssss', $gpid, $color, $material, $style, $brand, $model, $variations); $var->execute(); $var->free_result(); $var->close(); $con->next_result();
                                                if ($var) { $log_categ = "Termék létrehozása"; $log_desc = "#".$gpid." termék sikeresen fel lett véve az adatbázisba.";
                                                    $log = $con->prepare("INSERT INTO log (uid, ip, category, description) VALUES (?, ?, ?, ?)"); $log->bind_param('isss', $_SESSION['id'], $_POST['ip'], $log_categ, $log_desc); $log->execute(); $log->free_result(); $log->close(); $con->next_result();
                                                    if ($log) {
                                                        $gd = $con->prepare("SELECT products.id, name, category, tags, brand, base, refund, backorder FROM products INNER JOIN products__category ON products__category.pid = products.id INNER JOIN products__variations ON products__variations.pid = products.id INNER JOIN products__pricing ON products__pricing.pid = products.id INNER JOIN products__inventory ON products__inventory.pid = products.id INNER JOIN products__shipping ON products__shipping.pid = products.id WHERE products.id = ?");
                                                        $gd->bind_param('i', $gpid); $gd->execute(); $gd->bind_result($pid, $gname, $gcateg, $gtags, $gbrand, $gprice, $grefund, $gbackorder); $gd->fetch(); $gd->free_result(); $gd->close(); $con->next_result();
                                                        $nbrand = str_replace(',', '', str_replace(' ', '-',strtolower(strtr($gbrand, $unwanted_array)))); $nname = str_replace(',', '', str_replace(' ', '-',strtolower(strtr($gname, $unwanted_array)))); $ntags = str_replace(' ', '-', strtolower(strtr($gtags, $unwanted_array))); $ncateg = str_replace(',', '', str_replace(' ', '-',strtolower(strtr($gcateg, $unwanted_array))));
                                                        $src = $con->prepare("INSERT INTO products__search (pid, name, category, tags, brand, price, refund, backorder) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
                                                        $src->bind_param('issssiii', $gpid, $gname, $gcateg, $gtags, $gbrand, $gprice, $grefund, $gbackorder); $src->execute(); $src->free_result(); $src->close();
                                                        if ($src) { die('1'); } else { prepError(); }
                                                    } else { prepError(); }
                                                } else { prepError(); }
                                            } else { prepError(); }
                                        } else { prepError(); }
                                    } else { prepError(); }
                                } else { prepError(); }
                            } else { prepError(); }
                        } else { prepError(); }
                    } else { prepError(); }
                } else { prepError(); }
            } catch (Exception $ex) { die($ex->getMessage()); }
        } else { die('Sikertelen művelet! (x500)'); }
    } else { die('Sikertelen művelet! (x500)'); }

} else { die(json_encode($errors)); }

?>