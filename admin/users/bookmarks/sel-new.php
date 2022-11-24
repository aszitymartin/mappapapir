<?php require_once($_SERVER['DOCUMENT_ROOT'].'/includes/inc.php');
if(!$con) { die("Connection failed: " . mysqli_connect_error()); } $uid = $_POST['uid']; $pid = $_POST['pid'];
$gbisql = "SELECT pid FROM bookmarks WHERE uid = $uid"; $gbires = $con->query($gbisql); $gbitems = array();
while ($gbi = $gbires->fetch_assoc()) { array_push($gbitems, $gbi['pid']); }
if (count($gbitems) > 0) { $gbimp = implode(',', $gbitems); $exsql = " WHERE products.id NOT IN (".$gbimp.") "; } else { $exsql = " WHERE 1 "; }
$gbasql = "SELECT products.id, products.name, products.thumbnail, products__variations.brand, products__category.category FROM products INNER JOIN products__category ON products__category.pid = products.id INNER JOIN products__variations ON products__variations.pid = products.id $exsql";
$gbares = $con->query($gbasql); $gbaitem = array();
while ($gba = $gbares->fetch_assoc()) { $gbaObj = new stdClass();
    $gbaObj->id = $gba['id']; $gbaObj->name = $gba['name']; $gbaObj->thumbnail = $gba['thumbnail']; $gbaObj->brand = $gba['brand']; $gbaObj->category = $gba['category']; array_push($gbaitem, $gbaObj);
} die(json_encode($gbaitem));
?>