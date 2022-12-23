<?php require_once($_SERVER['DOCUMENT_ROOT'].'/includes/inc.php');

if ($cc = $con->prepare('SELECT category, cf FROM `vouchers` WHERE code LIKE ? AND active = 1 AND expiry > DATE(NOW())')) {
    $cc->bind_param('s', $_POST['code']); $cc->execute(); $cc->store_result(); $cc->bind_result($category, $cf); $cc->fetch();
    if ($cc->num_rows > 0) {
        if ($cf == 1) { // Category free
            if ($ccf = $con->prepare('SELECT description, value FROM `vouchers` WHERE code LIKE ?')) {
                $ccf->bind_param('s', $_POST['code']); $ccf->execute(); $ccf->store_result(); $ccf->bind_result($description, $value); $ccf->fetch();
                $obj = new stdClass(); $obj->description = $description; $obj->value = $value; $obj->code = $_POST['code']; die(json_encode($obj));
            } else { die ("Hiba történt a kuponkód beváltása közben. Próbálja újra később."); } $ccf->close();
        } else {
            if ($_POST['checkout'] == 'single') {
                if ($ccd = $con->prepare('SELECT value, description FROM `vouchers` WHERE (SELECT category FROM products__category WHERE pid = ?) LIKE category AND code LIKE ?')) {
                    $ccd->bind_param('is', $_POST['pid'] ,$_POST['code']); $ccd->execute(); $ccd->store_result(); $ccd->bind_result($value, $description); $ccd->fetch();
                    $obj = new stdClass(); $obj->description = $description; $obj->value = $value; $obj->code = $_POST['code']; die(json_encode($obj));
                } else { die ("Hiba történt a kuponkód beváltása közben. Próbálja újra később."); } $ccd->close();
            } else {
                die ('Csak kategória független kuponkódokat használhat fel, amikor a kosár tartalmát szeretné megvásárolni.');
            }
        }
    } else { die ('Érvénytelen kuponkódot adott meg.'); }
} else { die ("Hiba történt a kuponkód beváltása közben. Próbálja újra később."); } $cc->close();

// $sql = "SELECT vouchers.pid, code, value, description, valid, category
// FROM vouchers 
// INNER JOIN products__category ON products__category.pid = vouchers.id 
// WHERE (SELECT category FROM products__category WHERE pid = ".$_POST['pid'].") LIKE category";
// $res = $con->query($sql);
// if ($res->num_rows > 0) {
//     $dt = $res->fetch_assoc(); $obj = new stdClass();
//     $obj->code = $dt['code']; $obj->value = $dt['value']; $obj->description = $dt['description'];
//     $obj->valid = $dt['valid']; $obj->category = $dt['category'];
//     die(json_encode($obj));
// } else { die('Érvénytelen kuponkódot adott meg.'); }
?>