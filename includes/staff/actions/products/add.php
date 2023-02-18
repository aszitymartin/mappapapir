<?php session_start();
include($_SERVER['DOCUMENT_ROOT'].'/includes/inc.connect.php');
if (mysqli_connect_errno()) { die ("0"); }
$countfiles = count($_FILES['product-image-input']['name']); $upload_location = $_SERVER['DOCUMENT_ROOT'].'/assets/images/uploads/'; $coded_name; $files_arr = array();
for($index = 0; $index < $countfiles;$index++){
   if(isset($_FILES['product-image-input']['name'][$index]) && $_FILES['product-image-input']['name'][$index] != '') {
      $filename = $_FILES['product-image-input']['name'][$index]; $ext = strtolower(pathinfo($filename, PATHINFO_EXTENSION)); $valid_ext = array("png","jpeg","jpg");
      if(in_array($ext, $valid_ext)){ $path = $upload_location.$filename; $coded_name = substr(md5(rand()), 0, 7).''.date('YmdHis').'.'.$ext; if(move_uploaded_file($_FILES['product-image-input']['tmp_name'][$index],$upload_location.''.$coded_name)){ $files_arr[] = $coded_name; }       }
   }
}
if (!empty($files_arr)) {
	if ($stmt = $con->prepare('SELECT product_code FROM products WHERE product_code = ?')) {
		$stmt->bind_param('s', $_POST['product-id']); $stmt->execute(); $stmt->store_result();
		if ($stmt->num_rows > 0) {die ("30"); exit;
		} else {
			if ($stmt = $con->prepare('INSERT INTO products (product_code, product_quantity, product_quantity_unit, product_brand, product_color, product_name, product_info, product_width, product_width_unit, product_height, product_height_unit, product_length, product_length_unit, product_image, product_price, product_price_unit) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)')) {
				$stmt->bind_param('sisssssisisissis', $_POST['product-id'], $_POST['product-quantity'],$_POST['quantity-unit'],$_POST['product-brand'],$_POST['product-color'], $_POST['product-name'], $_POST['product-description'], $_POST['product-width'], $_POST['width-unit'], $_POST['product-height'], $_POST['height-unit'], $_POST['product-length'], $_POST['length-unit'], $coded_name, $_POST['product-price'], $_POST['price-unit']);
				$stmt->execute(); echo "1"; // 1: Sikeres muvelet
			} else {
				die ("26"); // 26: Hiba tortent az INSERT kozben
			}
		} $stmt->close();
	} else {
		die ("25"); // 25: Hiba tortent a PREPARE kozben
	}
	$con->close();
}
?>