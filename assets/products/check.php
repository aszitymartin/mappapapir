<?php
include($_SERVER['DOCUMENT_ROOT'].'/includes/inc.connect.php');if (mysqli_connect_errno()) { die ("0"); }
$id = $_POST['id']; $code = $_POST['code'];
$sql = "SELECT * FROM products WHERE product_id = $id AND product_code LIKE '$code'";
if ($result = mysqli_query($con, $sql)) {$num = mysqli_num_rows($result);echo $num;die();}
?>