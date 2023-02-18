<?php session_start();

print_r($_POST['product-image-input']);

/*
echo $_POST['product-id'] . ' ';
echo $_POST['product-code'] . ' ';
echo $_POST['product-quantity'] . ' ';
echo $_POST['quantity-unit'] . ' ';
echo $_POST['color'] . ' ';
echo $_POST['name'] . ' ';
echo $_POST['info'] . ' ';
echo $_POST['product-width'] . ' ';
echo $_POST['width-unit'] . ' ';
echo $_POST['product-height'] . ' ';
echo $_POST['height-unit'] . ' ';
echo $_POST['product-length'] . ' ';
echo $_POST['length-unit'] . ' ';
echo $_POST['product-type'] . ' ';
echo $_POST['image'] . ' ';
echo $_POST['product-price'] . ' ';
echo $_POST['price-unit'] . ' ';
echo $_POST['product-brand'] . ' ';
*/

include($_SERVER['DOCUMENT_ROOT'].'/includes/inc.connect.php');
if (mysqli_connect_errno()) { die ("0"); }
if ($_POST['product-image-input'] == "" || $_POST['product-image-input'] == " " || empty($_POST['product-image-input'])) {
    $coded_name = $_POST['image'];
} else {
    $countfiles = count($_FILES['product-image-input']['name']); $upload_location = $_SERVER['DOCUMENT_ROOT'].'/assets/images/test/'; $files_arr = array();
    for($index = 0; $index < $countfiles;$index++){
       if(isset($_FILES['product-image-input']['name'][$index]) && $_FILES['product-image-input']['name'][$index] != '') {
          $filename = $_FILES['product-image-input']['name'][$index]; $ext = strtolower(pathinfo($filename, PATHINFO_EXTENSION)); $valid_ext = array("png","jpeg","jpg");
          if(in_array($ext, $valid_ext)){ $path = $upload_location.$filename; $coded_name = substr(md5(rand()), 0, 7).''.date('YmdHis').'.'.$ext; if(move_uploaded_file($_FILES['product-image-input']['tmp_name'][$index],$upload_location.''.$coded_name)){ $files_arr[] = $coded_name; }       }
       }
    }
}
if ($stmt = $con->prepare('SELECT product_code FROM products WHERE product_code = ?')) {
    $stmt->bind_param('s', $_POST['product-id']); $stmt->execute(); $stmt->store_result();
    if ($stmt->num_rows > 0) {die ("30"); exit;
    } else {
        if ($stmt = $con->prepare('UPDATE products SET product_code = "'.$_POST['product-code'].'", product_quantity = "'.$_POST['product-quantity'].'", product_quantity_unit = "'.$_POST['quantity-unit'].'", product_brand = "'.$_POST['product-brand'].'", product_color = "'.$_POST['color'].'", product_name = "'.$_POST['name'].'", product_info = "'.$_POST['info'].'", product_width = "'.$_POST['product-width'].'", product_width_unit = "'.$_POST['width-unit'].'", product_height = "'.$_POST['product-height'].'", product_height_unit = "'.$_POST['height-unit'].'", product_length = "'.$_POST['product-length'].'", product_length_unit = "'.$_POST['length-unit'].'", product_image = "'.$coded_name.'", product_price = "'.$_POST['product-price'].'", product_price_unit = "'.$_POST['price-unit'].'" WHERE product_id = "'.$_POST['product-id'].'"')) {
            $stmt->execute(); echo "1"; // 1: Sikeres muvelet
        } else {
            die ("26"); // 26: Hiba tortent az INSERT kozben
        }
    } $stmt->close();
} else {
    die ("25"); // 25: Hiba tortent a PREPARE kozben
}
$con->close();
?>