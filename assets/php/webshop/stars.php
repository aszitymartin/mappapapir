<?php
include($_SERVER['DOCUMENT_ROOT'].'/includes/inc.connect.php');
$con->query("SET CHARACTER SET utf8mb4"); if (mysqli_connect_errno()) {header ("Location: /500");} $pid = $_POST['pid'];
$msql = "SELECT model FROM products__variations WHERE pid = $pid"; $mres = $con-> query($msql); while($data = $mres-> fetch_assoc()) { $model = $data['model']; }
$ssql = "SELECT stars FROM reviews INNER JOIN products__variations ON products__variations.pid = reviews.pid WHERE model = '$model'"; $sres = $con-> query($ssql); $son = 0; $stw = 0; $sth = 0; $sfo = 0; $sfi = 0; $savg = 0; $strs = new stdClass();
if ($sres-> num_rows > 0) { $strs->revs = $sres->num_rows;
    while ($star = $sres-> fetch_assoc()) { $stv = $star['stars']; if ($stv == 5) { $sfi += 1; } if ($stv == 4) { $sfo += 1; } if ($stv == 3) { $sth += 1; } if ($stv == 2) { $stw += 1; } if ($stv == 1) { $son += 1; } $dv = ($sfi + $sfo + $sth + $stw + $son); }
    $savg = ((5 * $sfi) + (4 * $sfo) + (3 * $sth) + (2 * $stw) + (1 * $son)) / $dv; $st__avg = round($savg * 10) / 10;
    $strs->count = $st__avg;
} else { $strs->count = 0; $strs->revs = 0; }
die(json_encode($strs));
?>