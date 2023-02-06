<?php require_once($_SERVER['DOCUMENT_ROOT'].'/includes/header.php');
$DATABASE_HOST = 'localhost';$DATABASE_USER = 'root';$DATABASE_PASS = 'eKi=0630OG';$DATABASE_NAME = 'mappapapir'; $con = mysqli_connect($DATABASE_HOST, $DATABASE_USER, $DATABASE_PASS, $DATABASE_NAME);
if (mysqli_connect_errno()) {exit('Failed to connect to MySQL: ' . mysqli_connect_error());}
$stmt = $con->prepare('SELECT product_id, product_code, product_quantity, product_quantity_unit, product_brand, product_type, product_color, product_name, product_info, product_width, product_width_unit, product_height, product_height_unit, product_length, product_length_unit, product_image, product_price, product_price_unit FROM products WHERE product_id = ?');
// $stmt = $con->prepare('SELECT products.product_id, products.product_code, products.product_quantity, products.product_quantity_unit, products.product_brand, products.product_color, products.product_name, products.product_info, products.product_width, products.product_width_unit, products.product_height, products.product_height_unit, products.product_length, products.product_length_unit, products.product_image, products.product_price, products.product_price_unit, product_discount.discount, product_discount.new_price FROM products INNER JOIN product_discount ON products.product_id = product_discount.product_id WHERE products.product_id = ?');
if (isset($_GET['id']) && $_GET['id'] != "") { $id = $_GET['id']; } else { echo "<script>window.location.href='/404';</script>"; }
$stmt->bind_param('i', $id); $stmt->execute();
$stmt->bind_result($product_id, $product_code, $product_quantity, $product_quantity_unit, $product_brand, $product_type, $product_color, $product_name, $product_info, $product_width, $product_width_unit, $product_height, $product_height_unit, $product_length, $product_length_unit, $product_image, $product_price, $product_price_unit);
$stmt->fetch(); $stmt->close();
$sql = "SELECT * FROM products WHERE product_id = {$_GET['id']} LIMIT 1";
if ($result = $con->query($sql)) {$product = $result->fetch_array();} else {header("Location: /500");}
if (isset($_SESSION['loggedin'])) {if (isset($_SESSION['id'])) {$uid = $_SESSION['id'];}}
$dc_sql = "SELECT products.product_id, product_discount.* FROM products INNER JOIN product_discount ON products.product_id = product_discount.product_id WHERE product_discount.product_id = $product_id AND product_discount.end > NOW()";$dc_res = $con-> query($dc_sql);
if ($dc_res -> num_rows > 0) {$discounted = true; while ($discount = $dc_res-> fetch_assoc()) {$discount_pc = $discount['discount']; $new_price = $discount['new_price']; $discount_start = $discount['start']; $discount_end = $discount['end'];}} 
function get_time_ago( $time ) {
    $time_difference = time() - $time;
    if( $time_difference < 1 ) { return '< 1mp'; }
    $condition = array( 12 * 30 * 24 * 60 * 60 =>  'év',30 * 24 * 60 * 60 =>  'hónap',24 * 60 * 60 =>  'nap',60 * 60 =>  'óra',60 =>  'p',1 =>  'mp');
    foreach( $condition as $secs => $str ) {$d = $time_difference / $secs;if( $d >= 1 ) {$t = round( $d );return $t . ' ' . $str;}}
}
if ($result->num_rows == 1) {    
    ?>
    <script> const html = document.querySelector('html');function switchTheme(theme) {html.dataset.theme = `theme-${theme}`;localStorage.setItem('theme', `theme-${theme}`);} </script>
    <main id="main" class="flex" style="margin-bottom: 16px;">
        <div class="prod-con">
            <div class="leftcolumn">
                <div class="card border-soft box-shadow text-align-c" id="demo-preview">
                    <div class="flex product-preview-con img-magnifier-container">
                        <img id="<?php echo $product_code; ?>" src="/assets/images/uploads/<?php echo $product_image; ?>" alt="<?php echo $product_image; ?>">
                    </div>
                    <span class="text-secondary small"><?php echo $product_name ?></span>
                </div>
                <div class="card border-soft box-shadow gap-1" id="mini-suggestions">
                <?php
                    $sub_code = substr($product_code, 0, -3);
                    $pr_sql = "SELECT * FROM products WHERE product_code LIKE '%$sub_code%' AND product_id != $product_id LIMIT 4"; $pr_res = $con-> query($pr_sql);
                    if ($pr_res-> num_rows > 0) {
                        echo '<span class="text-primary bold">Elérhető színek</span><br><br><div class="flex flex-col w-100"><div class="prod-int-con">';
                        while ($product = $pr_res-> fetch_assoc()) {
                            echo '
                            <div class="product_card product-int flex flex-col padding-05 box-shadow item-bg-light border-soft user-select-none" style="width: 100%; padding: 0;">
                                <label search-key="'; echo $product['product_brand'] . ' '; echo strtr($product['product_brand'], $unwanted_array) . ' '; echo $product['product_name'] . ' '; echo strtr($product['product_name'], $unwanted_array) . ' '; echo $product['product_price'] . ' '; echo $product['product_code']; echo '"></label>
                                <div class="product_card_inner flex flex-col h-100">
                                    <span class="product-link" auid="'; echo $product['product_id']; echo '">
                                        <span class="flex flex-row flex-justify-con-sb flex-align-c padding-05">
                                            <span class="product_title small-med">'; echo $product['product_name']; echo '</span>
                                        </span>
                                        <span class="flex flex-align-c flex-justify-con-c w-100">
                                            <img class="product_image" style="width: 5rem; height: 5rem;" src="/assets/images/uploads/'; echo $product['product_image']; echo '" alt="'; echo $product['product_name']; echo '">
                                        </span>
                                    </span>
                                    <div class="product_price_con flex flex-justify-con-sb margin-top-a" style="padding-bottom: .5rem !important;">
                                        <span class="product_price small">'; echo $product['product_price']; echo ' '; echo strtoupper($product['product_price_unit']); echo '</span>
                                        <div class="flex flex-row flex-justify-con-c flex-align-c">
                                            '; $pid = $product['product_id']; $ssql = "SELECT stars FROM reviews WHERE pid = $pid"; $sres = $con-> query($ssql); $son = 0; $stw = 0; $sth = 0; $sfo = 0; $sfi = 0; $savg = 0;
                                            if ($sres-> num_rows > 0) { while ($star = $sres-> fetch_assoc()) { $stv = $star['stars']; if ($stv == 5) { $sfi += 1; } if ($stv == 4) { $sfo += 1; } if ($stv == 3) { $sth += 1; } if ($stv == 2) { $stw += 1; } if ($stv == 1) { $son += 1; } $dv = ($sfi + $sfo + $sth + $stw + $son); }
                                            $savg = ((5 * $sfi) + (4 * $sfo) + (3 * $sth) + (2 * $stw) + (1 * $son)) / $dv; $st__avg = round($savg * 10) / 10;
                                                echo ' <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="22px" height="22px" viewBox="0 0 24 24" version="1.1"><g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"><polygon points="0 0 24 0 24 24 0 24"></polygon><path d="M12,18 L7.91561963,20.1472858 C7.42677504,20.4042866 6.82214789,20.2163401 6.56514708,19.7274955 C6.46280801,19.5328351 6.42749334,19.309867 6.46467018,19.0931094 L7.24471742,14.545085 L3.94038429,11.3241562 C3.54490071,10.938655 3.5368084,10.3055417 3.92230962,9.91005817 C4.07581822,9.75257453 4.27696063,9.65008735 4.49459766,9.61846284 L9.06107374,8.95491503 L11.1032639,4.81698575 C11.3476862,4.32173209 11.9473121,4.11839309 12.4425657,4.36281539 C12.6397783,4.46014562 12.7994058,4.61977315 12.8967361,4.81698575 L14.9389263,8.95491503 L19.5054023,9.61846284 C20.0519472,9.69788046 20.4306287,10.2053233 20.351211,10.7518682 C20.3195865,10.9695052 20.2170993,11.1706476 20.0596157,11.3241562 L16.7552826,14.545085 L17.5353298,19.0931094 C17.6286908,19.6374458 17.263103,20.1544017 16.7187666,20.2477627 C16.5020089,20.2849396 16.2790408,20.2496249 16.0843804,20.1472858 L12,18 Z" fill="#f6cc00"></path></g></svg> <span class="flex text-primary small bold">'.$st__avg.'</span>';
                                            } else {  echo '<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="22px" height="22px" viewBox="0 0 24 24" version="1.1"><g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"><polygon points="0 0 24 0 24 24 0 24"></polygon><path d="M12,18 L7.91561963,20.1472858 C7.42677504,20.4042866 6.82214789,20.2163401 6.56514708,19.7274955 C6.46280801,19.5328351 6.42749334,19.309867 6.46467018,19.0931094 L7.24471742,14.545085 L3.94038429,11.3241562 C3.54490071,10.938655 3.5368084,10.3055417 3.92230962,9.91005817 C4.07581822,9.75257453 4.27696063,9.65008735 4.49459766,9.61846284 L9.06107374,8.95491503 L11.1032639,4.81698575 C11.3476862,4.32173209 11.9473121,4.11839309 12.4425657,4.36281539 C12.6397783,4.46014562 12.7994058,4.61977315 12.8967361,4.81698575 L14.9389263,8.95491503 L19.5054023,9.61846284 C20.0519472,9.69788046 20.4306287,10.2053233 20.351211,10.7518682 C20.3195865,10.9695052 20.2170993,11.1706476 20.0596157,11.3241562 L16.7552826,14.545085 L17.5353298,19.0931094 C17.6286908,19.6374458 17.263103,20.1544017 16.7187666,20.2477627 C16.5020089,20.2849396 16.2790408,20.2496249 16.0843804,20.1472858 L12,18 Z" fill="#f6cc00" opacity=".6"></path></g></svg><span class="flex text-secondary small bold">0.0</span>'; } echo '
                                        </div>
                                    </div>
                                </div>
                            </div>
                            ';
                        } echo '</div></div>';
                    } else {
                        $pr_sql = "SELECT * FROM products WHERE (product_name LIKE '%$product_name%' OR (product_type LIKE '$product_type' AND product_color LIKE '$product_color')) AND product_code != '$product_code' LIMIT 4"; $pr_res = $con-> query($pr_sql);
                        if ($pr_res-> num_rows > 0) {
                            echo '<span class="text-primary bold">Hasonló termékek</span><br><br><div class="flex flex-col w-100"><div class="prod-int-con">';
                            while ($product = $pr_res-> fetch_assoc()) {
                                echo '
                                <div class="product_card product-int flex flex-col padding-05 box-shadow item-bg-light border-soft user-select-none" style="width: 100%; padding: 0;">
                                    <label search-key="'; echo $product['product_brand'] . ' '; echo strtr($product['product_brand'], $unwanted_array) . ' '; echo $product['product_name'] . ' '; echo strtr($product['product_name'], $unwanted_array) . ' '; echo $product['product_price'] . ' '; echo $product['product_code']; echo '"></label>
                                    <div class="product_card_inner flex flex-col h-100">
                                        <span class="product-link" auid="'; echo $product['product_id']; echo '">
                                            <span class="flex flex-row flex-justify-con-sb flex-align-c padding-05">
                                                <span class="product_title small-med">'; echo $product['product_name']; echo '</span>
                                            </span>
                                            <span class="flex flex-align-c flex-justify-con-c w-100">
                                                <img class="product_image" style="width: 5rem; height: 5rem;" src="/assets/images/uploads/'; echo $product['product_image']; echo '" alt="'; echo $product['product_name']; echo '">
                                            </span>
                                        </span>
                                        <div class="product_price_con flex flex-justify-con-sb margin-top-a" style="padding-bottom: .5rem !important;">
                                            <span class="product_price small">'; echo $product['product_price']; echo ' '; echo strtoupper($product['product_price_unit']); echo '</span>
                                            <div class="product_action_con flex flex-align-c">
                                                <div class="flex flex-row flex-justify-con-c flex-align-c">
                                                    '; $pid = $product['product_id']; $ssql = "SELECT stars FROM reviews WHERE pid = $pid"; $sres = $con-> query($ssql); $son = 0; $stw = 0; $sth = 0; $sfo = 0; $sfi = 0; $savg = 0;
                                                    if ($sres-> num_rows > 0) { while ($star = $sres-> fetch_assoc()) { $stv = $star['stars']; if ($stv == 5) { $sfi += 1; } if ($stv == 4) { $sfo += 1; } if ($stv == 3) { $sth += 1; } if ($stv == 2) { $stw += 1; } if ($stv == 1) { $son += 1; } $dv = ($sfi + $sfo + $sth + $stw + $son); }
                                                    $savg = ((5 * $sfi) + (4 * $sfo) + (3 * $sth) + (2 * $stw) + (1 * $son)) / $dv; $st__avg = round($savg * 10) / 10;
                                                        echo ' <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="22px" height="22px" viewBox="0 0 24 24" version="1.1"><g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"><polygon points="0 0 24 0 24 24 0 24"></polygon><path d="M12,18 L7.91561963,20.1472858 C7.42677504,20.4042866 6.82214789,20.2163401 6.56514708,19.7274955 C6.46280801,19.5328351 6.42749334,19.309867 6.46467018,19.0931094 L7.24471742,14.545085 L3.94038429,11.3241562 C3.54490071,10.938655 3.5368084,10.3055417 3.92230962,9.91005817 C4.07581822,9.75257453 4.27696063,9.65008735 4.49459766,9.61846284 L9.06107374,8.95491503 L11.1032639,4.81698575 C11.3476862,4.32173209 11.9473121,4.11839309 12.4425657,4.36281539 C12.6397783,4.46014562 12.7994058,4.61977315 12.8967361,4.81698575 L14.9389263,8.95491503 L19.5054023,9.61846284 C20.0519472,9.69788046 20.4306287,10.2053233 20.351211,10.7518682 C20.3195865,10.9695052 20.2170993,11.1706476 20.0596157,11.3241562 L16.7552826,14.545085 L17.5353298,19.0931094 C17.6286908,19.6374458 17.263103,20.1544017 16.7187666,20.2477627 C16.5020089,20.2849396 16.2790408,20.2496249 16.0843804,20.1472858 L12,18 Z" fill="#f6cc00"></path></g></svg> <span class="flex text-primary small bold">'.$st__avg.'</span>';
                                                    } else {  echo '<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="22px" height="22px" viewBox="0 0 24 24" version="1.1"><g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"><polygon points="0 0 24 0 24 24 0 24"></polygon><path d="M12,18 L7.91561963,20.1472858 C7.42677504,20.4042866 6.82214789,20.2163401 6.56514708,19.7274955 C6.46280801,19.5328351 6.42749334,19.309867 6.46467018,19.0931094 L7.24471742,14.545085 L3.94038429,11.3241562 C3.54490071,10.938655 3.5368084,10.3055417 3.92230962,9.91005817 C4.07581822,9.75257453 4.27696063,9.65008735 4.49459766,9.61846284 L9.06107374,8.95491503 L11.1032639,4.81698575 C11.3476862,4.32173209 11.9473121,4.11839309 12.4425657,4.36281539 C12.6397783,4.46014562 12.7994058,4.61977315 12.8967361,4.81698575 L14.9389263,8.95491503 L19.5054023,9.61846284 C20.0519472,9.69788046 20.4306287,10.2053233 20.351211,10.7518682 C20.3195865,10.9695052 20.2170993,11.1706476 20.0596157,11.3241562 L16.7552826,14.545085 L17.5353298,19.0931094 C17.6286908,19.6374458 17.263103,20.1544017 16.7187666,20.2477627 C16.5020089,20.2849396 16.2790408,20.2496249 16.0843804,20.1472858 L12,18 Z" fill="#f6cc00" opacity=".6"></path></g></svg><span class="flex text-secondary small bold">0.0</span>'; } echo '
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                ';
                            } echo '</div></div>';
                        } else {
                            $pr_sql = "SELECT * FROM products WHERE (product_price = $product_price OR product_name LIKE '%$product_name%' OR product_brand LIKE '%$product_brand%' OR product_color LIKE '$product_color') AND product_code != '$product_code' ORDER BY FIELD(product_brand, '$product_brand') DESC LIMIT 4"; $pr_res = $con-> query($pr_sql);
                            if ($pr_res-> num_rows > 0) {
                                echo '<span class="text-primary bold">Ezek is érdekelhetik</span><br><br><div class="flex flex-col w-100"><div class="prod-int-con">';
                                while ($product = $pr_res-> fetch_assoc()) {
                                    echo '
                                    <div class="product_card product-int flex flex-col padding-05 box-shadow item-bg-light border-soft user-select-none" style="width: 100%; padding: 0;">
                                        <label search-key="'; echo $product['product_brand'] . ' '; echo strtr($product['product_brand'], $unwanted_array) . ' '; echo $product['product_name'] . ' '; echo strtr($product['product_name'], $unwanted_array) . ' '; echo $product['product_price'] . ' '; echo $product['product_code']; echo '"></label>
                                        <div class="product_card_inner flex flex-col h-100">
                                            <span class="product-link" auid="'; echo $product['product_id']; echo '">
                                                <span class="flex flex-row flex-justify-con-sb flex-align-c padding-05">
                                                    <span class="product_title small-med">'; echo $product['product_name']; echo '</span>
                                                </span>
                                                <span class="flex flex-align-c flex-justify-con-c w-100">
                                                    <img class="product_image" style="width: 5rem; height: 5rem;" src="/assets/images/uploads/'; echo $product['product_image']; echo '" alt="'; echo $product['product_name']; echo '">
                                                </span>
                                            </span>
                                            <div class="product_price_con flex flex-justify-con-sb margin-top-a" style="padding-bottom: .5rem !important;">
                                                <span class="product_price small">'; echo $product['product_price']; echo ' '; echo strtoupper($product['product_price_unit']); echo '</span>
                                                <div class="product_action_con flex flex-align-c">
                                                    <div class="flex flex-row flex-justify-con-c flex-align-c">
                                                        '; $pid = $product['product_id']; $ssql = "SELECT stars FROM reviews WHERE pid = $pid"; $sres = $con-> query($ssql); $son = 0; $stw = 0; $sth = 0; $sfo = 0; $sfi = 0; $savg = 0;
                                                        if ($sres-> num_rows > 0) { while ($star = $sres-> fetch_assoc()) { $stv = $star['stars']; if ($stv == 5) { $sfi += 1; } if ($stv == 4) { $sfo += 1; } if ($stv == 3) { $sth += 1; } if ($stv == 2) { $stw += 1; } if ($stv == 1) { $son += 1; } $dv = ($sfi + $sfo + $sth + $stw + $son); }
                                                        $savg = ((5 * $sfi) + (4 * $sfo) + (3 * $sth) + (2 * $stw) + (1 * $son)) / $dv; $st__avg = round($savg * 10) / 10;
                                                            echo ' <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="22px" height="22px" viewBox="0 0 24 24" version="1.1"><g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"><polygon points="0 0 24 0 24 24 0 24"></polygon><path d="M12,18 L7.91561963,20.1472858 C7.42677504,20.4042866 6.82214789,20.2163401 6.56514708,19.7274955 C6.46280801,19.5328351 6.42749334,19.309867 6.46467018,19.0931094 L7.24471742,14.545085 L3.94038429,11.3241562 C3.54490071,10.938655 3.5368084,10.3055417 3.92230962,9.91005817 C4.07581822,9.75257453 4.27696063,9.65008735 4.49459766,9.61846284 L9.06107374,8.95491503 L11.1032639,4.81698575 C11.3476862,4.32173209 11.9473121,4.11839309 12.4425657,4.36281539 C12.6397783,4.46014562 12.7994058,4.61977315 12.8967361,4.81698575 L14.9389263,8.95491503 L19.5054023,9.61846284 C20.0519472,9.69788046 20.4306287,10.2053233 20.351211,10.7518682 C20.3195865,10.9695052 20.2170993,11.1706476 20.0596157,11.3241562 L16.7552826,14.545085 L17.5353298,19.0931094 C17.6286908,19.6374458 17.263103,20.1544017 16.7187666,20.2477627 C16.5020089,20.2849396 16.2790408,20.2496249 16.0843804,20.1472858 L12,18 Z" fill="#f6cc00"></path></g></svg> <span class="flex text-primary small bold">'.$st__avg.'</span>';
                                                        } else {  echo '<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="22px" height="22px" viewBox="0 0 24 24" version="1.1"><g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"><polygon points="0 0 24 0 24 24 0 24"></polygon><path d="M12,18 L7.91561963,20.1472858 C7.42677504,20.4042866 6.82214789,20.2163401 6.56514708,19.7274955 C6.46280801,19.5328351 6.42749334,19.309867 6.46467018,19.0931094 L7.24471742,14.545085 L3.94038429,11.3241562 C3.54490071,10.938655 3.5368084,10.3055417 3.92230962,9.91005817 C4.07581822,9.75257453 4.27696063,9.65008735 4.49459766,9.61846284 L9.06107374,8.95491503 L11.1032639,4.81698575 C11.3476862,4.32173209 11.9473121,4.11839309 12.4425657,4.36281539 C12.6397783,4.46014562 12.7994058,4.61977315 12.8967361,4.81698575 L14.9389263,8.95491503 L19.5054023,9.61846284 C20.0519472,9.69788046 20.4306287,10.2053233 20.351211,10.7518682 C20.3195865,10.9695052 20.2170993,11.1706476 20.0596157,11.3241562 L16.7552826,14.545085 L17.5353298,19.0931094 C17.6286908,19.6374458 17.263103,20.1544017 16.7187666,20.2477627 C16.5020089,20.2849396 16.2790408,20.2496249 16.0843804,20.1472858 L12,18 Z" fill="#f6cc00" opacity=".6"></path></g></svg><span class="flex text-secondary small bold">0.0</span>'; } echo '
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    ';
                                } echo '</div></div>';
                            } else {
                                $pr_sql = "SELECT products.*, product_discount.discount, product_discount.new_price FROM products INNER JOIN product_discount ON products.product_id = product_discount.product_id WHERE product_discount.end > NOW() AND product_code NOT LIKE '$product_code' ORDER BY RAND() LIMIT 4"; $pr_res = $con-> query($pr_sql);
                                if ($pr_res-> num_rows > 0) {
                                    echo '<span class="text-primary bold">Ezek is érdekelhetik</span><br><br><div class="flex flex-col w-100"><div class="prod-int-con">';
                                    while ($product = $pr_res-> fetch_assoc()) {
                                        echo '
                                        <div class="product_card product-int flex flex-col padding-05 box-shadow item-bg-light border-soft user-select-none" style="width: 100%; padding: 0;">
                                            <label search-key="'; echo $product['product_brand'] . ' '; echo strtr($product['product_brand'], $unwanted_array) . ' '; echo $product['product_name'] . ' '; echo strtr($product['product_name'], $unwanted_array) . ' '; echo $product['product_price'] . ' '; echo $product['product_code']; echo '"></label>
                                            <div class="product_card_inner flex flex-col h-100">
                                                <span class="product-link" auid="'; echo $product['product_id']; echo '">
                                                    <span class="flex flex-row flex-justify-con-sb flex-align-c padding-05">
                                                        <span class="product_title small-med">'; echo $product['product_name']; echo '</span>
                                                    </span>
                                                    <span class="flex flex-align-c flex-justify-con-c w-100">
                                                        <img class="product_image" style="width: 5rem; height: 5rem;" src="/assets/images/uploads/'; echo $product['product_image']; echo '" alt="'; echo $product['product_name']; echo '">
                                                    </span>
                                                </span>
                                                <div class="product_price_con flex flex-justify-con-sb margin-top-a" style="padding-bottom: .5rem !important;">
                                                    <span class="product_price small">'; echo $product['product_price']; echo ' '; echo strtoupper($product['product_price_unit']); echo '</span>
                                                    <div class="product_action_con flex flex-align-c">
                                                        <div class="flex flex-row flex-justify-con-c flex-align-c">
                                                            '; $pid = $product['product_id']; $ssql = "SELECT stars FROM reviews WHERE pid = $pid"; $sres = $con-> query($ssql); $son = 0; $stw = 0; $sth = 0; $sfo = 0; $sfi = 0; $savg = 0;
                                                            if ($sres-> num_rows > 0) { while ($star = $sres-> fetch_assoc()) { $stv = $star['stars']; if ($stv == 5) { $sfi += 1; } if ($stv == 4) { $sfo += 1; } if ($stv == 3) { $sth += 1; } if ($stv == 2) { $stw += 1; } if ($stv == 1) { $son += 1; } $dv = ($sfi + $sfo + $sth + $stw + $son); }
                                                            $savg = ((5 * $sfi) + (4 * $sfo) + (3 * $sth) + (2 * $stw) + (1 * $son)) / $dv; $st__avg = round($savg * 10) / 10;
                                                                echo ' <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="22px" height="22px" viewBox="0 0 24 24" version="1.1"><g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"><polygon points="0 0 24 0 24 24 0 24"></polygon><path d="M12,18 L7.91561963,20.1472858 C7.42677504,20.4042866 6.82214789,20.2163401 6.56514708,19.7274955 C6.46280801,19.5328351 6.42749334,19.309867 6.46467018,19.0931094 L7.24471742,14.545085 L3.94038429,11.3241562 C3.54490071,10.938655 3.5368084,10.3055417 3.92230962,9.91005817 C4.07581822,9.75257453 4.27696063,9.65008735 4.49459766,9.61846284 L9.06107374,8.95491503 L11.1032639,4.81698575 C11.3476862,4.32173209 11.9473121,4.11839309 12.4425657,4.36281539 C12.6397783,4.46014562 12.7994058,4.61977315 12.8967361,4.81698575 L14.9389263,8.95491503 L19.5054023,9.61846284 C20.0519472,9.69788046 20.4306287,10.2053233 20.351211,10.7518682 C20.3195865,10.9695052 20.2170993,11.1706476 20.0596157,11.3241562 L16.7552826,14.545085 L17.5353298,19.0931094 C17.6286908,19.6374458 17.263103,20.1544017 16.7187666,20.2477627 C16.5020089,20.2849396 16.2790408,20.2496249 16.0843804,20.1472858 L12,18 Z" fill="#f6cc00"></path></g></svg> <span class="flex text-primary small bold">'.$st__avg.'</span>';
                                                            } else {  echo '<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="22px" height="22px" viewBox="0 0 24 24" version="1.1"><g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"><polygon points="0 0 24 0 24 24 0 24"></polygon><path d="M12,18 L7.91561963,20.1472858 C7.42677504,20.4042866 6.82214789,20.2163401 6.56514708,19.7274955 C6.46280801,19.5328351 6.42749334,19.309867 6.46467018,19.0931094 L7.24471742,14.545085 L3.94038429,11.3241562 C3.54490071,10.938655 3.5368084,10.3055417 3.92230962,9.91005817 C4.07581822,9.75257453 4.27696063,9.65008735 4.49459766,9.61846284 L9.06107374,8.95491503 L11.1032639,4.81698575 C11.3476862,4.32173209 11.9473121,4.11839309 12.4425657,4.36281539 C12.6397783,4.46014562 12.7994058,4.61977315 12.8967361,4.81698575 L14.9389263,8.95491503 L19.5054023,9.61846284 C20.0519472,9.69788046 20.4306287,10.2053233 20.351211,10.7518682 C20.3195865,10.9695052 20.2170993,11.1706476 20.0596157,11.3241562 L16.7552826,14.545085 L17.5353298,19.0931094 C17.6286908,19.6374458 17.263103,20.1544017 16.7187666,20.2477627 C16.5020089,20.2849396 16.2790408,20.2496249 16.0843804,20.1472858 L12,18 Z" fill="#f6cc00" opacity=".6"></path></g></svg><span class="flex text-secondary small bold">0.0</span>'; } echo '
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        ';
                                    } echo '</div></div>';
                                }
                            }
                        }
                    }
                    ?>
                </div>
            </div>
            <div class="middlecolumn" id="product-main">
                <div class="card border-soft box-shadow" id="product-info">
                    <div class="flex flex-col gap-05">
                        <div class="flex flex-col">
                            <div class="flex flex-row flex-justify-con-sb">
                                <div class="flex flex-col">
                                    <span class="text-primary bold prod-title"><span class="uppercase"><?php echo $product_brand . " "; echo $product_code; ?></span>, <?php echo $product_name; ?> / <?php echo $product_color; ?></span>
                                    <span class="text-primary small">Márka: <span class="uppercase"><?php echo $product_brand; ?></span></span>
                                </div>
                            </div>
                        </div>
                        <?php
                            $sql = "SELECT * FROM reviews WHERE pid = $product_id";
                            if ($result = mysqli_query($con, $sql)) {$num = mysqli_num_rows($result);}
                        ?>
                        <span class="flex flex-row flex-align-c product-star-con">
                            <span id="i__stars"></span>
                            <span class="text-primary bold" id="tr__count"></span>
                        </span>
                    </div><br>
                    <?php
                        if (isset($_GET['method'])) {
                            if ($_GET['method'] == 50) {echo '<span class="flex flex-align-c"><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="16px" height="16px" viewBox="0 0 24 24" version="1.1"><g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"><path d="M13.5,6 C13.33743,8.28571429 12.7799545,9.78571429 11.8275735,10.5 C11.8275735,10.5 12.5,4 10.5734853,2 C10.5734853,2 10.5734853,5.92857143 8.78777106,9.14285714 C7.95071887,10.6495511 7.00205677,12.1418252 7.00205677,14.1428571 C7.00205677,17 10.4697177,18 12.0049375,18 C13.8025422,18 17,17 17,13.5 C17,12.0608202 15.8333333,9.56082016 13.5,6 Z" class="svg"/></g></svg><span class="text-primary small-med">Ezt a terméket a felkapott részlegben találta.</span></span>';}
                            if ($_GET['method'] == 51) {echo '<span class="flex flex-align-c"><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="16px" height="16px" viewBox="0 0 24 24" version="1.1"><g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"><rect x="0" y="0" width="24" height="24"></rect><path d="M8,4 L16,4 C17.1045695,4 18,4.8954305 18,6 L18,17.726765 C18,18.2790497 17.5522847,18.726765 17,18.726765 C16.7498083,18.726765 16.5087052,18.6329798 16.3242754,18.4639191 L12.6757246,15.1194142 C12.2934034,14.7689531 11.7065966,14.7689531 11.3242754,15.1194142 L7.67572463,18.4639191 C7.26860564,18.8371115 6.63603827,18.8096086 6.26284586,18.4024896 C6.09378519,18.2180598 6,17.9769566 6,17.726765 L6,6 C6,4.8954305 6.8954305,4 8,4 Z" class="svg"></path></g></svg><span class="text-primary small-med">Ezt a terméket a könyvjelző részlegben találta.</span></span>';}
                            if ($_GET['method'] == 52) {echo '<span class="flex flex-align-c"><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="16px" height="16px" viewBox="0 0 24 24" version="1.1"><g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"><rect x="0" y="0" width="24" height="24"/><path d="M4,9.67471899 L10.880262,13.6470401 C10.9543486,13.689814 11.0320333,13.7207107 11.1111111,13.740321 L11.1111111,21.4444444 L4.49070127,17.526473 C4.18655139,17.3464765 4,17.0193034 4,16.6658832 L4,9.67471899 Z M20,9.56911707 L20,16.6658832 C20,17.0193034 19.8134486,17.3464765 19.5092987,17.526473 L12.8888889,21.4444444 L12.8888889,13.6728275 C12.9050191,13.6647696 12.9210067,13.6561758 12.9368301,13.6470401 L20,9.56911707 Z" class="svg"/><path d="M4.21611835,7.74669402 C4.30015839,7.64056877 4.40623188,7.55087574 4.5299008,7.48500698 L11.5299008,3.75665466 C11.8237589,3.60013944 12.1762411,3.60013944 12.4700992,3.75665466 L19.4700992,7.48500698 C19.5654307,7.53578262 19.6503066,7.60071528 19.7226939,7.67641889 L12.0479413,12.1074394 C11.9974761,12.1365754 11.9509488,12.1699127 11.9085461,12.2067543 C11.8661433,12.1699127 11.819616,12.1365754 11.7691509,12.1074394 L4.21611835,7.74669402 Z" class="svg" opacity="0.3"/></g></svg><span class="text-primary small-med">Ezt a terméket a javaslatok részlegében találta.</span></span>';}
                            if ($_GET['method'] == 53) {echo '<span class="flex flex-align-c"><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="16px" height="16px" viewBox="0 0 24 24" version="1.1"><g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"><path d="M13.5,6 C13.33743,8.28571429 12.7799545,9.78571429 11.8275735,10.5 C11.8275735,10.5 12.5,4 10.5734853,2 C10.5734853,2 10.5734853,5.92857143 8.78777106,9.14285714 C7.95071887,10.6495511 7.00205677,12.1418252 7.00205677,14.1428571 C7.00205677,17 10.4697177,18 12.0049375,18 C13.8025422,18 17,17 17,13.5 C17,12.0608202 15.8333333,9.56082016 13.5,6 Z" class="svg"/></g></svg><span class="text-primary small-med">Ezt a terméket a bevásárlókosár részlegben találta.</span></span>';}
                            if ($_GET['method'] == 54) {echo '<span class="flex flex-align-c"><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="16px" height="16px" viewBox="0 0 24 24" version="1.1"><g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"><rect x="0" y="0" width="24" height="24"></rect><path d="M5,6 L19,6 C20.1045695,6 21,6.8954305 21,8 L21,17 C21,18.1045695 20.1045695,19 19,19 L5,19 C3.8954305,19 3,18.1045695 3,17 L3,8 C3,6.8954305 3.8954305,6 5,6 Z M18.1444251,7.83964668 L12,11.1481833 L5.85557487,7.83964668 C5.4908718,7.6432681 5.03602525,7.77972206 4.83964668,8.14442513 C4.6432681,8.5091282 4.77972206,8.96397475 5.14442513,9.16035332 L11.6444251,12.6603533 C11.8664074,12.7798822 12.1335926,12.7798822 12.3555749,12.6603533 L18.8555749,9.16035332 C19.2202779,8.96397475 19.3567319,8.5091282 19.1603533,8.14442513 C18.9639747,7.77972206 18.5091282,7.6432681 18.1444251,7.83964668 Z" class="svg"></path></g></svg><span class="text-primary small-med">Ezt a terméket emailben javasolták Önnek.</span></span>';}
                            if ($_GET['method'] == 55) {echo '<span class="flex flex-align-c"><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="16px" height="16px" viewBox="0 0 24 24" version="1.1"><g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"><rect x="0" y="0" width="24" height="24"></rect><path d="M12.4644661,14.5355339 L9.46446609,14.5355339 C8.91218134,14.5355339 8.46446609,14.9832492 8.46446609,15.5355339 C8.46446609,16.0878187 8.91218134,16.5355339 9.46446609,16.5355339 L12.4644661,16.5355339 L12.4644661,17.5355339 C12.4644661,18.6401034 11.5690356,19.5355339 10.4644661,19.5355339 L6.46446609,19.5355339 C5.35989659,19.5355339 4.46446609,18.6401034 4.46446609,17.5355339 L4.46446609,13.5355339 C4.46446609,12.4309644 5.35989659,11.5355339 6.46446609,11.5355339 L10.4644661,11.5355339 C11.5690356,11.5355339 12.4644661,12.4309644 12.4644661,13.5355339 L12.4644661,14.5355339 Z" class="svg" opacity="0.3" transform="translate(8.464466, 15.535534) rotate(-45.000000) translate(-8.464466, -15.535534) "></path><path d="M11.5355339,9.46446609 L14.5355339,9.46446609 C15.0878187,9.46446609 15.5355339,9.01675084 15.5355339,8.46446609 C15.5355339,7.91218134 15.0878187,7.46446609 14.5355339,7.46446609 L11.5355339,7.46446609 L11.5355339,6.46446609 C11.5355339,5.35989659 12.4309644,4.46446609 13.5355339,4.46446609 L17.5355339,4.46446609 C18.6401034,4.46446609 19.5355339,5.35989659 19.5355339,6.46446609 L19.5355339,10.4644661 C19.5355339,11.5690356 18.6401034,12.4644661 17.5355339,12.4644661 L13.5355339,12.4644661 C12.4309644,12.4644661 11.5355339,11.5690356 11.5355339,10.4644661 L11.5355339,9.46446609 Z" class="svg" transform="translate(15.535534, 8.464466) rotate(-45.000000) translate(-15.535534, -8.464466) "></path></g></svg><span class="text-primary small-med">Ezt a terméket a vágólapról másolta.</span></span>';}
                        }
                    ?>
                    <hr style="border: 1px solid var(--background);">
                    <div class="flex flex-col gap-05">
                        <?php 
                            if (isset($discounted)) {
                                echo '<span class="flex flex-row bold" style="align-items: flex-end;"><p class="flex flex-row text-primary" style="font-size: 19.2px;"><span style="margin-right: .5rem">Ár:</span>';
                                echo $new_price. " " . strtoupper($product_price_unit); echo '<span class="text-secondary small flex" style="text-decoration:line-through; margin-left: .32px; align-items:flex-end;">'; echo $product_price; echo ' </span></p></span>';
                            } else {echo '<p class="text-primary" style="font-size: 19.2px;">Ár: <span class="bold uppercase">'; echo $product_price . " " . strtoupper($product_price_unit); echo '</span></p>';}
                        ?>
                        <table class="product-table text-align-l">
                            <tr><th>Márka</th><td><?php echo $product_brand; ?></td></tr>
                            <tr><th>Szín</th><td><?php echo $product_color; ?></td></tr>
                            <tr><th>Szélesség</th><td><?php echo $product_width . " " . $product_width_unit; ?></td></tr>
                            <tr><th>Magasság</th><td><?php echo $product_height . " " . $product_height_unit; ?></td></tr>
                            <tr><th>Hossz</th><td><?php echo $product_length . " " . $product_length_unit; ?></td></tr>
                        </table>
                    </div>
                    <hr style="border: 1px solid var(--background);"><br>
                    <div class="flex flex-col gap-05">
                        <span class="text-primary bold" style="font-size: 1.3rem">A termékek leírása</span>
                        <div class="text-primary"><?php echo $product_info; ?></div>
                    </div><br>
                    <hr style="border: 1px solid var(--background);"><br>
                    <div class="flex flex-col gap-05">
                        <span class="text-primary bold" style="font-size: 1.3rem">További információk erről a termékről</span>
                        <table class="product-table text-align-l">
                            <tr><th>Cikkszám</th><td><?php echo $product_code; ?></td></tr>
                            <tr><th>Raktáron</th><td><?php if ($product_quantity > 0) {echo $product_quantity . " " . $product_quantity_unit;}  else {echo '<span class="bold small-med" style="color: #dc3545;">Nincs raktáron!</span>';}?></td></tr>
                        </table>
                    </div>
                </div>
                <div class="card border-soft box-shadow" id="product-reviews">
                    <div class="flex flex-col gap-05">
                        <div class="flex flex-row flex-align-c flex-justify-con-sb">
                            <span class="flex flex-align-c gap-05 text-primary bold" style="font-size: 1.3rem">Vélemények 
                                <span class="italic small" id="br__count"></span>
                            </span>
                            <?php
                                if (isset($_SESSION['loggedin'])) { $sql = "SELECT reviews.*, customers.* FROM reviews INNER JOIN customers ON reviews.uid = customers.id WHERE reviews.pid = $product_id AND uid NOT LIKE $uid ORDER BY reviews.date DESC"; }
                                else { $sql = "SELECT reviews.*, customers.* FROM reviews INNER JOIN customers ON reviews.uid = customers.id WHERE reviews.pid = $product_id ORDER BY reviews.date DESC"; }
                                $res = $con-> query($sql);
                                if ($res-> num_rows > 1) {
                                    echo '
                                    <div id="srt__review" class="has-tooltip relative"  aria-describedby="s__review" aria-label="Rendezés">
                                        <span class="flex padding-05 border-soft background-bg pointer">
                                            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1"><g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"><rect x="0" y="0" width="24" height="24"/><rect class="svg" x="4" y="5" width="16" height="3" rx="1.5"/><path d="M7.5,11 L16.5,11 C17.3284271,11 18,11.6715729 18,12.5 C18,13.3284271 17.3284271,14 16.5,14 L7.5,14 C6.67157288,14 6,13.3284271 6,12.5 C6,11.6715729 6.67157288,11 7.5,11 Z M10.5,17 L13.5,17 C14.3284271,17 15,17.6715729 15,18.5 C15,19.3284271 14.3284271,20 13.5,20 L10.5,20 C9.67157288,20 9,19.3284271 9,18.5 C9,17.6715729 9.67157288,17 10.5,17 Z" class="svg" opacity="0.3"/></g></svg>
                                        </span>
                                        <span class="tooltip absolute" id="s__review">
                                            <span key="tooltipProfile">Rendezés</span>
                                        </span>
                                    </div>      
                                    ';
                                }
                            ?>
                        </div>
                    </div><hr style="border: 1px solid var(--background);">
                    <div class="flex flex-col">
                        <?php
                            if (isset($_SESSION['loggedin'])) {
                                $sql = "SELECT reviews.*, customers.fullname FROM reviews INNER JOIN customers ON reviews.uid = customers.id WHERE reviews.pid = $product_id AND reviews.uid = $uid ORDER BY reviews.date DESC";
                                $res = $con-> query($sql);
                                if ($res-> num_rows > 0) {
                                    while ($review = $res-> fetch_assoc()) {
                                        $revid = $review['id']; $revpid = $review['pid'];
                                        echo '
                                        <div id="rev'.$review['id'].'" class="flex flex-col gap-05 border-soft outline-secondary padding-1"><a name="review'.$review['id'].'"></a>
                                            <div class="flex flex-row flex-align-c flex-justify-con-sb">
                                                <div class="flex flex-row gap-05 flex-align-c">
                                                    <div class="flex">
                                                        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="2.5rem" height="2.5rem" viewBox="0 0 24 24" version="1.1"><g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"><rect x="0" y="0" width="24" height="24"/><circle class="svg" opacity="0.3" cx="12" cy="12" r="10"/><path d="M12,11 C10.8954305,11 10,10.1045695 10,9 C10,7.8954305 10.8954305,7 12,7 C13.1045695,7 14,7.8954305 14,9 C14,10.1045695 13.1045695,11 12,11 Z M7.00036205,16.4995035 C7.21569918,13.5165724 9.36772908,12 11.9907452,12 C14.6506758,12 16.8360465,13.4332455 16.9988413,16.5 C17.0053266,16.6221713 16.9988413,17 16.5815,17 L7.4041679,17 C7.26484009,17 6.98863236,16.6619875 7.00036205,16.4995035 Z" class="svg" opacity="0.3"/></g></svg>
                                                    </div>
                                                    <div class="flex flex-col">
                                                        <span class="text-primary bold link pointer"><a href="/profile">'. $review['fullname'] .'</a></span>
                                                        <span class="text-secondary smaller" title="">'. $review['date'] .'</span>
                                                    </div>
                                                </div>
                                                <div class="flex ">
                                                    ';
                                                    $rid = $review['id']; 
                                                    $vsqlu__c = "SELECT * FROM rv__u WHERE rv__u.rid = $rid";
                                                    $vsqld__c = "SELECT * FROM rv__d WHERE rv__d.rid = $rid";
                                                    if ($vresu__c = mysqli_query($con, $vsqlu__c)) { $vnumu__c = mysqli_num_rows($vresu__c);
                                                        if ($vresd__c = mysqli_query($con, $vsqld__c)) { $vnumd__c = mysqli_num_rows($vresd__c);
                                                            echo '
                                                            <div class="flex ">
                                                                <span class="flex flex-col flex-align-c flex-justify-con-c user-select-none">
                                                                    <span class="flex" ><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"><path d="M 5.7071 15.8929 C 5.0771 16.5229 5.5233 17.6 6.4142 17.6 H 17.5858 C 18.4767 17.6 18.9229 16.5229 18.2929 15.8929 L 12.7 10.3 C 12.3 9.9 11.7 9.9 11.3 10.3 L 5.7071 15.8929 Z" class="svg" opacity=".3"></path></svg></span>
                                                                    <span class="text-secondary small" id="u__count'.$review['id'].'">'.$vnumu__c-$vnumd__c.'</span>
                                                                    <span class="flex"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"><path d="M 5.7071 7.1071 C 5.0771 6.4771 5.5233 5.4 6.4142 5.4 H 17.5858 C 18.4767 5.4 18.9229 6.4771 18.2929 7.1071 L 12.7 12.7 C 12.3 13.1 11.7 13.1 11.3 12.7 L 5.7071 7.1071 Z" class="svg" opacity=".3"/></svg></span>
                                                                </span>
                                                            </div>
                                                            ';
                                                        }
                                                    }
                                                    echo '
                                                </div>
                                            </div>
                                            <div class="flex flex-col">
                                                <div class="flex flex-row flex-align-c">
                                                    <span class="product-star-con" id="r__stars__'.$review['id'].'"></span>
                                                    ';
                                                    $cu__sql = "SELECT id FROM orders WHERE uid = $revid AND pid = $revpid";
                                                    $cu__res = $con-> query($cu__sql);
                                                    if ($cu__res-> num_rows > 0) { echo '<span class="flex flex-row label label-primary border-soft bold">Hitelesített vásárlás</span>'; }
                                                    echo '
                                                </div>
                                                <div class="flex flex-col">
                                                    <span class="text-secondary small-med">'. $review['description'] .'</span>
                                                </div>
                                            </div>
                                            <div class="flex flex-row flex-justify-con-fe gap-1" style="margin-top: .5rem;">
                                                <span onclick="sh__review('.$review['id'].', '.$review['pid'].');" class="flex flex-col flex-align-c user-select-none pointer active-hover-primary">
                                                    <span class="flex">
                                                        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="18px" height="18px" viewBox="0 0 24 24" version="1.1"><g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"><rect x="0" y="0" width="24" height="24"/><path d="M10.9,2 C11.4522847,2 11.9,2.44771525 11.9,3 C11.9,3.55228475 11.4522847,4 10.9,4 L6,4 C4.8954305,4 4,4.8954305 4,6 L4,18 C4,19.1045695 4.8954305,20 6,20 L18,20 C19.1045695,20 20,19.1045695 20,18 L20,16 C20,15.4477153 20.4477153,15 21,15 C21.5522847,15 22,15.4477153 22,16 L22,18 C22,20.209139 20.209139,22 18,22 L6,22 C3.790861,22 2,20.209139 2,18 L2,6 C2,3.790861 3.790861,2 6,2 L10.9,2 Z" class="svg" fill-rule="nonzero" opacity="0.3"/><path d="M24.0690576,13.8973499 C24.0690576,13.1346331 24.2324969,10.1246259 21.8580869,7.73659596 C20.2600137,6.12944276 17.8683518,5.85068794 15.0081639,5.72356847 L15.0081639,1.83791555 C15.0081639,1.42370199 14.6723775,1.08791555 14.2581639,1.08791555 C14.0718537,1.08791555 13.892213,1.15726043 13.7542266,1.28244533 L7.24606818,7.18681951 C6.93929045,7.46513642 6.9162184,7.93944934 7.1945353,8.24622707 C7.20914339,8.26232899 7.22444472,8.27778811 7.24039592,8.29256062 L13.7485543,14.3198102 C14.0524605,14.6012598 14.5269852,14.5830551 14.8084348,14.2791489 C14.9368329,14.140506 15.0081639,13.9585047 15.0081639,13.7695393 L15.0081639,9.90761477 C16.8241562,9.95755456 18.1177196,10.0730665 19.2929978,10.4469645 C20.9778605,10.9829796 22.2816185,12.4994368 23.2042718,14.996336 L23.2043032,14.9963244 C23.313119,15.2908036 23.5938372,15.4863432 23.9077781,15.4863432 L24.0735976,15.4863432 C24.0735976,15.0278051 24.0690576,14.3014082 24.0690576,13.8973499 Z" class="svg" fill-rule="nonzero" transform="translate(15.536799, 8.287129) scale(-1, 1) translate(-15.536799, -8.287129) "/></g></svg>
                                                    </span>
                                                    <span class="text-secondary smaller hover-actived-primary">Megosztás</span>
                                                </span>
                                                <span id="d__review" rid="'.$review['id'].'" pid="'.$review['pid'].'" class="flex flex-col flex-align-c user-select-none pointer active-hover-primary">
                                                    <span class="flex">
                                                        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="18px" height="18px" viewBox="0 0 24 24" version="1.1"><g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"><rect x="0" y="0" width="24" height="24"/><path d="M6,8 L18,8 L17.106535,19.6150447 C17.04642,20.3965405 16.3947578,21 15.6109533,21 L8.38904671,21 C7.60524225,21 6.95358004,20.3965405 6.89346498,19.6150447 L6,8 Z M8,10 L8.45438229,14.0894406 L15.5517885,14.0339036 L16,10 L8,10 Z" class="svg" fill-rule="nonzero"/><path d="M14,4.5 L14,3.5 C14,3.22385763 13.7761424,3 13.5,3 L10.5,3 C10.2238576,3 10,3.22385763 10,3.5 L10,4.5 L5.5,4.5 C5.22385763,4.5 5,4.72385763 5,5 L5,5.5 C5,5.77614237 5.22385763,6 5.5,6 L18.5,6 C18.7761424,6 19,5.77614237 19,5.5 L19,5 C19,4.72385763 18.7761424,4.5 18.5,4.5 L14,4.5 Z" class="svg" opacity="0.3"/></g></svg>
                                                    </span>
                                                    <span class="text-secondary smaller hover-actived-primary">Törlés</span>
                                                </span>
                                                <span id="e__review" rid="'.$review['id'].'" pid="'.$review['pid'].'" class="flex flex-col flex-align-c user-select-none pointer active-hover-primary">
                                                    <span class="flex">
                                                        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="18px" height="18px" viewBox="0 0 24 24" version="1.1"><g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"><rect x="0" y="0" width="24" height="24"/><path d="M8,17.9148182 L8,5.96685884 C8,5.56391781 8.16211443,5.17792052 8.44982609,4.89581508 L10.965708,2.42895648 C11.5426798,1.86322723 12.4640974,1.85620921 13.0496196,2.41308426 L15.5337377,4.77566479 C15.8314604,5.0588212 16,5.45170806 16,5.86258077 L16,17.9148182 C16,18.7432453 15.3284271,19.4148182 14.5,19.4148182 L9.5,19.4148182 C8.67157288,19.4148182 8,18.7432453 8,17.9148182 Z" class="svg" fill-rule="nonzero" transform="translate(12.000000, 10.707409) rotate(-135.000000) translate(-12.000000, -10.707409) "/><rect class="svg" opacity="0.3" x="5" y="20" width="15" height="2" rx="1"/></g></svg>
                                                    </span>
                                                    <span class="text-secondary smaller hover-actived-primary">Szerkeszt</span>
                                                </span>
                                            </div>
                                        </div>
                                        <script>
                                            for (let i = 1; i <= '.$review['stars'].'; i++) { document.getElementById("r__stars__'.$review['id'].'").innerHTML += `<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="22.4px" height="22.4px" viewBox="0 0 24 24" version="1.1"><g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"><polygon points="0 0 24 0 24 24 0 24"/><path d="M12,18 L7.91561963,20.1472858 C7.42677504,20.4042866 6.82214789,20.2163401 6.56514708,19.7274955 C6.46280801,19.5328351 6.42749334,19.309867 6.46467018,19.0931094 L7.24471742,14.545085 L3.94038429,11.3241562 C3.54490071,10.938655 3.5368084,10.3055417 3.92230962,9.91005817 C4.07581822,9.75257453 4.27696063,9.65008735 4.49459766,9.61846284 L9.06107374,8.95491503 L11.1032639,4.81698575 C11.3476862,4.32173209 11.9473121,4.11839309 12.4425657,4.36281539 C12.6397783,4.46014562 12.7994058,4.61977315 12.8967361,4.81698575 L14.9389263,8.95491503 L19.5054023,9.61846284 C20.0519472,9.69788046 20.4306287,10.2053233 20.351211,10.7518682 C20.3195865,10.9695052 20.2170993,11.1706476 20.0596157,11.3241562 L16.7552826,14.545085 L17.5353298,19.0931094 C17.6286908,19.6374458 17.263103,20.1544017 16.7187666,20.2477627 C16.5020089,20.2849396 16.2790408,20.2496249 16.0843804,20.1472858 L12,18 Z" class="svg"/></g></svg>`; }
                                            for (let i = 0; i < (5 - '.$review['stars'].'); i++) { document.getElementById("r__stars__'.$review['id'].'").innerHTML += `<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="22.4px" height="22.4px" viewBox="0 0 24 24" version="1.1"><g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"><polygon points="0 0 24 0 24 24 0 24"/><path d="M12,18 L7.91561963,20.1472858 C7.42677504,20.4042866 6.82214789,20.2163401 6.56514708,19.7274955 C6.46280801,19.5328351 6.42749334,19.309867 6.46467018,19.0931094 L7.24471742,14.545085 L3.94038429,11.3241562 C3.54490071,10.938655 3.5368084,10.3055417 3.92230962,9.91005817 C4.07581822,9.75257453 4.27696063,9.65008735 4.49459766,9.61846284 L9.06107374,8.95491503 L11.1032639,4.81698575 C11.3476862,4.32173209 11.9473121,4.11839309 12.4425657,4.36281539 C12.6397783,4.46014562 12.7994058,4.61977315 12.8967361,4.81698575 L14.9389263,8.95491503 L19.5054023,9.61846284 C20.0519472,9.69788046 20.4306287,10.2053233 20.351211,10.7518682 C20.3195865,10.9695052 20.2170993,11.1706476 20.0596157,11.3241562 L16.7552826,14.545085 L17.5353298,19.0931094 C17.6286908,19.6374458 17.263103,20.1544017 16.7187666,20.2477627 C16.5020089,20.2849396 16.2790408,20.2496249 16.0843804,20.1472858 L12,18 Z" class="svg" opacity=".3" /></g></svg>`; }
                                        </script>
                                        <script src="/assets/script/review/delete.js"></script>
                                        <script src="/assets/script/review/edit.js"></script>
                                        ';
                                    }
                                } else {
                                    echo '
                                        <div id="rv__form" class="flex flex-col border-soft outline-secondary padding-1">
                                            <div class="flex flex-row flex-align-c flex-justify-con-sb user-select-none pointer">
                                                <span class="text-primary small bold">Írjon vásárlói véleményt</span>
                                                <span class="flex padding-05 border-soft background-bg"><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="22.4px" height="22.4px" viewBox="0 0 24 24" version="1.1"><g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"><polygon points="0 0 24 0 24 24 0 24"></polygon><path d="M12,18 L7.91561963,20.1472858 C7.42677504,20.4042866 6.82214789,20.2163401 6.56514708,19.7274955 C6.46280801,19.5328351 6.42749334,19.309867 6.46467018,19.0931094 L7.24471742,14.545085 L3.94038429,11.3241562 C3.54490071,10.938655 3.5368084,10.3055417 3.92230962,9.91005817 C4.07581822,9.75257453 4.27696063,9.65008735 4.49459766,9.61846284 L9.06107374,8.95491503 L11.1032639,4.81698575 C11.3476862,4.32173209 11.9473121,4.11839309 12.4425657,4.36281539 C12.6397783,4.46014562 12.7994058,4.61977315 12.8967361,4.81698575 L14.9389263,8.95491503 L19.5054023,9.61846284 C20.0519472,9.69788046 20.4306287,10.2053233 20.351211,10.7518682 C20.3195865,10.9695052 20.2170993,11.1706476 20.0596157,11.3241562 L16.7552826,14.545085 L17.5353298,19.0931094 C17.6286908,19.6374458 17.263103,20.1544017 16.7187666,20.2477627 C16.5020089,20.2849396 16.2790408,20.2496249 16.0843804,20.1472858 L12,18 Z" class="svg"></path></g></svg></span>
                                            </div>
                                            <div class="flex flex-col padding-1 gap-1" style="padding-bottom: 0;">
                                                <div id="s__con" class="flex flex-col">
                                                    <div class="flex">
                                                        <span class="text-primary bold small-med">Értékelje a terméket</span>
                                                    </div>
                                                    <div class="flex flex-row product-star-con" id="w__stars"></div>
                                                </div>
                                                <div class="flex flex-col gap-05">
                                                    <div class="flex">
                                                        <span class="text-primary bold small-med">Rövid összefoglalás</span>
                                                    </div>
                                                    <div class="flex flex-col gap-05">
                                                        <textarea id="r__textarea" class="textarea w-100 resize-none mx-height-un height-un padding-05" name="review-title" id="review-desc" rows="6" maxlength="2048" placeholder="Írja meg, miért ajánlaná a terméket másoknak, illetve miért nem, milyen tapasztalatai vannak a termék használatával kapcsolatosan és mire érdemes odafigyelni a termékvásárlásánál!"></textarea>
                                                    </div>
                                                </div>
                                                <div class="flex">
                                                    <span class="text-secondary small-med">A vélemény elküldésével hozzájárul ahhoz, hogy megadott e-mail címét a Mappa Papír Kft. (6400 Kiskunhalas, Kossuth utca 13-15; mappapapir.hu) adatkezelőként kezelje. Az adatkezelésről további tájékoztatások <a href="#" target="_blank" class="link text-primary">itt érhetőek el</a>.</span>
                                                </div>
                                                <div class="flex flex-row flex-justify-con-fe w-100">
                                                    <span id="s__review" class="button button-primary small" pid="'.$product_id.'">Vélemény elküldése</span>
                                                </div>
                                            </div>
                                        </div>
                                        <script src="/assets/script/review/post.js"></script>
                                    ';
                                }
                            } else {
                                echo '<span class="button button-secondary hover-bold w-50 margin-auto text-align-c" style="margin: 2rem auto;" onclick="openHeaderProfileAction();">Írjon vásárlói véleményt</span>';
                            }
                        ?>
                    </div>
                    <div class="flex flex-col padding-1 gap-2" id='rvts__container'>
                        <?php
                            if (isset($_SESSION['loggedin'])) { $sql = "SELECT reviews.description, reviews.stars, reviews.id, reviews.pid, reviews.date, customers.id AS 'uid', customers.fullname FROM reviews INNER JOIN customers ON reviews.uid = customers.id WHERE reviews.pid = $product_id AND reviews.uid != $uid ORDER BY reviews.date DESC"; }
                            else { $sql = "SELECT reviews.*, customers.* FROM reviews INNER JOIN customers ON reviews.uid = customers.id WHERE reviews.pid = $product_id ORDER BY reviews.date DESC"; }
                            $res = $con-> query($sql);
                            if ($res-> num_rows > 0) {
                                while ($review = $res-> fetch_assoc()) { $rid = $review['id'];
                                    $vsql__u = "SELECT * FROM rv__u WHERE rv__u.rid = $rid"; if ($vres__u = mysqli_query($con, $vsql__u)) { $vnum__u = mysqli_num_rows($vres__u); }
                                    $vsql__d = "SELECT * FROM rv__d WHERE rv__d.rid = $rid"; if ($vres__d = mysqli_query($con, $vsql__d)) { $vnum__d = mysqli_num_rows($vres__d); }
                                    $revid = $review['id']; $revpid = $review['pid'];
                                    echo '
                                    <div v-id="'.$vnum__u - $vnum__d.'" s-id="'.$review['stars'].'" d-id="'.$review['date'].'" class="flex flex-col gap-05 rvst__item"><a name="review'.$review['id'].'"></a>
                                        <div class="flex flex-row flex-align-c flex-justify-con-sb">
                                            <div class="flex flex-row gap-05 flex-align-c">
                                                <div class="flex">
                                                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="2.5rem" height="2.5rem" viewBox="0 0 24 24" version="1.1"><g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"><rect x="0" y="0" width="24" height="24"/><circle class="svg" opacity="0.3" cx="12" cy="12" r="10"/><path d="M12,11 C10.8954305,11 10,10.1045695 10,9 C10,7.8954305 10.8954305,7 12,7 C13.1045695,7 14,7.8954305 14,9 C14,10.1045695 13.1045695,11 12,11 Z M7.00036205,16.4995035 C7.21569918,13.5165724 9.36772908,12 11.9907452,12 C14.6506758,12 16.8360465,13.4332455 16.9988413,16.5 C17.0053266,16.6221713 16.9988413,17 16.5815,17 L7.4041679,17 C7.26484009,17 6.98863236,16.6619875 7.00036205,16.4995035 Z" class="svg" opacity="0.3"/></g></svg>
                                                </div>
                                                <div class="flex flex-col">
                                                    <span class="text-primary bold link pointer">'. $review['fullname'] .'</span>
                                                    <span class="text-secondary smaller" title="">'. $review['date'] .'</span>
                                                </div>
                                            </div>';
                                                if (isset($_SESSION['loggedin']) && isset($_SESSION['id'])) {
                                                    
                                                    $vsqlu__c = "SELECT * FROM rv__u WHERE rv__u.rid = $rid AND uid = $uid";
                                                    $vsqld__c = "SELECT * FROM rv__d WHERE rv__d.rid = $rid AND uid = $uid";
                                                    if ($vresu__c = mysqli_query($con, $vsqlu__c)) { $vnumu__c = mysqli_num_rows($vresu__c);
                                                        if ($vresd__c = mysqli_query($con, $vsqld__c)) { $vnumd__c = mysqli_num_rows($vresd__c);
                                                            if ($vnumu__c > $vnumd__c) {
                                                                echo '
                                                                <div class="flex ">
                                                                    <span class="flex flex-col flex-align-c flex-justify-con-c user-select-none pointer active-hover-primary">
                                                                        <span class="flex" onclick="r__up('.$review['id'].')"><svg id="req__up'.$review['id'].'" class="svg-active req__up" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"><path d="M 5.7071 15.8929 C 5.0771 16.5229 5.5233 17.6 6.4142 17.6 H 17.5858 C 18.4767 17.6 18.9229 16.5229 18.2929 15.8929 L 12.7 10.3 C 12.3 9.9 11.7 9.9 11.3 10.3 L 5.7071 15.8929 Z" class="svg"/></svg></span>
                                                                        <span class="text-secondary small" id="u__count'.$review['id'].'">'.$vnum__u-$vnum__d.'</span>
                                                                        <span class="flex" onclick="u__down('.$review['id'].')"><svg id="req__down'.$review['id'].'" class="svg-hover req__down" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"><path d="M 5.7071 7.1071 C 5.0771 6.4771 5.5233 5.4 6.4142 5.4 H 17.5858 C 18.4767 5.4 18.9229 6.4771 18.2929 7.1071 L 12.7 12.7 C 12.3 13.1 11.7 13.1 11.3 12.7 L 5.7071 7.1071 Z" class="svg"/></svg></span>
                                                                    </span>
                                                                </div>
                                                                ';
                                                            } else if ($vnumu__c < $vnumd__c) {
                                                                echo '
                                                                <div class="flex ">
                                                                    <span class="flex flex-col flex-align-c flex-justify-con-c user-select-none pointer active-hover-primary">
                                                                        <span class="flex" onclick="u__up('.$review['id'].')"><svg id="req__up'.$review['id'].'" class="svg-hover req__up" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"><path d="M 5.7071 15.8929 C 5.0771 16.5229 5.5233 17.6 6.4142 17.6 H 17.5858 C 18.4767 17.6 18.9229 16.5229 18.2929 15.8929 L 12.7 10.3 C 12.3 9.9 11.7 9.9 11.3 10.3 L 5.7071 15.8929 Z" class="svg"/></svg></span>
                                                                        <span class="text-secondary small" id="u__count'.$review['id'].'">'.$vnum__u-$vnum__d.'</span>
                                                                        <span class="flex" onclick="r__down('.$review['id'].')"><svg id="req__down'.$review['id'].'" class="svg-active req__down" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"><path d="M 5.7071 7.1071 C 5.0771 6.4771 5.5233 5.4 6.4142 5.4 H 17.5858 C 18.4767 5.4 18.9229 6.4771 18.2929 7.1071 L 12.7 12.7 C 12.3 13.1 11.7 13.1 11.3 12.7 L 5.7071 7.1071 Z" class="svg"/></svg></span>
                                                                    </span>
                                                                </div>
                                                                ';
                                                            } else if ($vnumu__c == $vnumd__c) {
                                                                echo '
                                                                <div class="flex ">
                                                                    <span class="flex flex-col flex-align-c flex-justify-con-c user-select-none pointer active-hover-primary">
                                                                        <span class="flex" onclick="u__up('.$review['id'].')"><svg id="req__up'.$review['id'].'" class="svg-hover req__up" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"><path d="M 5.7071 15.8929 C 5.0771 16.5229 5.5233 17.6 6.4142 17.6 H 17.5858 C 18.4767 17.6 18.9229 16.5229 18.2929 15.8929 L 12.7 10.3 C 12.3 9.9 11.7 9.9 11.3 10.3 L 5.7071 15.8929 Z" class="svg"/></svg></span>
                                                                        <span class="text-secondary small" id="u__count'.$review['id'].'">'.$vnum__u-$vnum__d.'</span>
                                                                        <span class="flex" onclick="u__down('.$review['id'].')"><svg id="req__down'.$review['id'].'" class="svg-hover req__down" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"><path d="M 5.7071 7.1071 C 5.0771 6.4771 5.5233 5.4 6.4142 5.4 H 17.5858 C 18.4767 5.4 18.9229 6.4771 18.2929 7.1071 L 12.7 12.7 C 12.3 13.1 11.7 13.1 11.3 12.7 L 5.7071 7.1071 Z" class="svg"/></svg></span>
                                                                    </span>
                                                                </div>
                                                                ';
                                                            }
                                                        }
                                                    }
                                                } else {
                                                    echo '
                                                    <div class="flex ">
                                                        <span class="flex flex-col flex-align-c flex-justify-con-c user-select-none pointer active-hover-primary">
                                                            <span class="flex" onclick="openHeaderProfileAction();"><svg class="svg-hover" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"><path d="M 5.7071 15.8929 C 5.0771 16.5229 5.5233 17.6 6.4142 17.6 H 17.5858 C 18.4767 17.6 18.9229 16.5229 18.2929 15.8929 L 12.7 10.3 C 12.3 9.9 11.7 9.9 11.3 10.3 L 5.7071 15.8929 Z" class="svg"></path></svg></span>
                                                            <span class="text-secondary small" id="u__count'.$review['id'].'">'.$vnum__u-$vnum__d.'</span>
                                                            <span class="flex" onclick="openHeaderProfileAction();"><svg class="svg-hover" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"><path d="M 5.7071 7.1071 C 5.0771 6.4771 5.5233 5.4 6.4142 5.4 H 17.5858 C 18.4767 5.4 18.9229 6.4771 18.2929 7.1071 L 12.7 12.7 C 12.3 13.1 11.7 13.1 11.3 12.7 L 5.7071 7.1071 Z" class="svg"></path></svg></span>
                                                        </span>
                                                    </div>
                                                    ';
                                                }
                                            echo '
                                        </div>
                                        <div class="flex flex-col">
                                            <div class="flex flex-row flex-align-c">
                                            <span class="product-star-con" id="r__stars__'.$review['id'].'"></span>
                                            ';
                                            $cu__sql = "SELECT id FROM orders WHERE uid = $revid AND pid = $revpid";
                                            $cu__res = $con-> query($cu__sql);
                                            if ($cu__res-> num_rows > 0) { echo '<span class="flex flex-row label label-primary border-soft bold">Hitelesített vásárlás</span>'; }
                                            echo '
                                            </div>
                                            <div class="flex flex-col">
                                                <span class="text-secondary small-med">'. $review['description'] .'</span>
                                            </div>
                                        </div>
                                        <div class="flex flex-row flex-justify-con-sb gap-1" style="margin-top: .5rem;">
                                            <div class="flex flex-row"></div>
                                            <div class="flex gap-1">
                                                <span onclick="sh__review('.$review['id'].', '.$review['pid'].');" class="flex flex-col flex-align-c user-select-none pointer active-hover-primary">
                                                    <span class="flex">
                                                        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="18px" height="18px" viewBox="0 0 24 24" version="1.1"><g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"><rect x="0" y="0" width="24" height="24"/><path d="M10.9,2 C11.4522847,2 11.9,2.44771525 11.9,3 C11.9,3.55228475 11.4522847,4 10.9,4 L6,4 C4.8954305,4 4,4.8954305 4,6 L4,18 C4,19.1045695 4.8954305,20 6,20 L18,20 C19.1045695,20 20,19.1045695 20,18 L20,16 C20,15.4477153 20.4477153,15 21,15 C21.5522847,15 22,15.4477153 22,16 L22,18 C22,20.209139 20.209139,22 18,22 L6,22 C3.790861,22 2,20.209139 2,18 L2,6 C2,3.790861 3.790861,2 6,2 L10.9,2 Z" class="svg" fill-rule="nonzero" opacity="0.3"/><path d="M24.0690576,13.8973499 C24.0690576,13.1346331 24.2324969,10.1246259 21.8580869,7.73659596 C20.2600137,6.12944276 17.8683518,5.85068794 15.0081639,5.72356847 L15.0081639,1.83791555 C15.0081639,1.42370199 14.6723775,1.08791555 14.2581639,1.08791555 C14.0718537,1.08791555 13.892213,1.15726043 13.7542266,1.28244533 L7.24606818,7.18681951 C6.93929045,7.46513642 6.9162184,7.93944934 7.1945353,8.24622707 C7.20914339,8.26232899 7.22444472,8.27778811 7.24039592,8.29256062 L13.7485543,14.3198102 C14.0524605,14.6012598 14.5269852,14.5830551 14.8084348,14.2791489 C14.9368329,14.140506 15.0081639,13.9585047 15.0081639,13.7695393 L15.0081639,9.90761477 C16.8241562,9.95755456 18.1177196,10.0730665 19.2929978,10.4469645 C20.9778605,10.9829796 22.2816185,12.4994368 23.2042718,14.996336 L23.2043032,14.9963244 C23.313119,15.2908036 23.5938372,15.4863432 23.9077781,15.4863432 L24.0735976,15.4863432 C24.0735976,15.0278051 24.0690576,14.3014082 24.0690576,13.8973499 Z" class="svg" fill-rule="nonzero" transform="translate(15.536799, 8.287129) scale(-1, 1) translate(-15.536799, -8.287129) "/></g></svg>
                                                    </span>
                                                    <span class="text-secondary smaller hover-actived-primary">Megosztás</span>
                                                </span>
                                                ';
                                                if (isset($_SESSION['loggedin'])) {
                                                    echo '
                                                    <span onclick="rv__report('.$review['id'].');" class="flex flex-col flex-align-c user-select-none pointer active-hover-primary">
                                                        <span class="flex">
                                                            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="18px" height="18px" viewBox="0 0 24 24" version="1.1"><g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"><rect x="0" y="0" width="24" height="24"/><path d="M3.5,3 L5,3 L5,19.5 C5,20.3284271 4.32842712,21 3.5,21 L3.5,21 C2.67157288,21 2,20.3284271 2,19.5 L2,4.5 C2,3.67157288 2.67157288,3 3.5,3 Z" class="svg"/><path d="M6.99987583,2.99995344 L19.754647,2.99999303 C20.3069317,2.99999474 20.7546456,3.44771138 20.7546439,3.99999613 C20.7546431,4.24703684 20.6631995,4.48533385 20.497938,4.66895776 L17.5,8 L20.4979317,11.3310353 C20.8673908,11.7415453 20.8341123,12.3738351 20.4236023,12.7432941 C20.2399776,12.9085564 20.0016794,13 19.7546376,13 L6.99987583,13 L6.99987583,2.99995344 Z" class="svg" opacity="0.3"/></g></svg>
                                                        </span>
                                                        <span class="text-secondary smaller hover-actived-primary">Jelentés</span>
                                                    </span>
                                                    ';
                                                } else {
                                                    echo '
                                                    <span onclick="openHeaderProfileAction();" class="flex flex-col flex-align-c user-select-none pointer active-hover-primary">
                                                        <span class="flex">
                                                            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="18px" height="18px" viewBox="0 0 24 24" version="1.1"><g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"><rect x="0" y="0" width="24" height="24"/><path d="M3.5,3 L5,3 L5,19.5 C5,20.3284271 4.32842712,21 3.5,21 L3.5,21 C2.67157288,21 2,20.3284271 2,19.5 L2,4.5 C2,3.67157288 2.67157288,3 3.5,3 Z" class="svg"/><path d="M6.99987583,2.99995344 L19.754647,2.99999303 C20.3069317,2.99999474 20.7546456,3.44771138 20.7546439,3.99999613 C20.7546431,4.24703684 20.6631995,4.48533385 20.497938,4.66895776 L17.5,8 L20.4979317,11.3310353 C20.8673908,11.7415453 20.8341123,12.3738351 20.4236023,12.7432941 C20.2399776,12.9085564 20.0016794,13 19.7546376,13 L6.99987583,13 L6.99987583,2.99995344 Z" class="svg" opacity="0.3"/></g></svg>
                                                        </span>
                                                        <span class="text-secondary smaller hover-actived-primary">Jelentés</span>
                                                    </span>
                                                    ';
                                                }
                                                echo '
                                            </div>
                                        </div>
                                    </div>
                                    <script> // Csillagok megjelenitese
                                        for (let i = 1; i <= '.$review['stars'].'; i++) { document.getElementById("r__stars__'.$review['id'].'").innerHTML += `<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="22.4px" height="22.4px" viewBox="0 0 24 24" version="1.1"><g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"><polygon points="0 0 24 0 24 24 0 24"/><path d="M12,18 L7.91561963,20.1472858 C7.42677504,20.4042866 6.82214789,20.2163401 6.56514708,19.7274955 C6.46280801,19.5328351 6.42749334,19.309867 6.46467018,19.0931094 L7.24471742,14.545085 L3.94038429,11.3241562 C3.54490071,10.938655 3.5368084,10.3055417 3.92230962,9.91005817 C4.07581822,9.75257453 4.27696063,9.65008735 4.49459766,9.61846284 L9.06107374,8.95491503 L11.1032639,4.81698575 C11.3476862,4.32173209 11.9473121,4.11839309 12.4425657,4.36281539 C12.6397783,4.46014562 12.7994058,4.61977315 12.8967361,4.81698575 L14.9389263,8.95491503 L19.5054023,9.61846284 C20.0519472,9.69788046 20.4306287,10.2053233 20.351211,10.7518682 C20.3195865,10.9695052 20.2170993,11.1706476 20.0596157,11.3241562 L16.7552826,14.545085 L17.5353298,19.0931094 C17.6286908,19.6374458 17.263103,20.1544017 16.7187666,20.2477627 C16.5020089,20.2849396 16.2790408,20.2496249 16.0843804,20.1472858 L12,18 Z" class="svg"/></g></svg>`; }
                                        for (let i = 0; i < (5 - '.$review['stars'].'); i++) { document.getElementById("r__stars__'.$review['id'].'").innerHTML += `<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="22.4px" height="22.4px" viewBox="0 0 24 24" version="1.1"><g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"><polygon points="0 0 24 0 24 24 0 24"/><path d="M12,18 L7.91561963,20.1472858 C7.42677504,20.4042866 6.82214789,20.2163401 6.56514708,19.7274955 C6.46280801,19.5328351 6.42749334,19.309867 6.46467018,19.0931094 L7.24471742,14.545085 L3.94038429,11.3241562 C3.54490071,10.938655 3.5368084,10.3055417 3.92230962,9.91005817 C4.07581822,9.75257453 4.27696063,9.65008735 4.49459766,9.61846284 L9.06107374,8.95491503 L11.1032639,4.81698575 C11.3476862,4.32173209 11.9473121,4.11839309 12.4425657,4.36281539 C12.6397783,4.46014562 12.7994058,4.61977315 12.8967361,4.81698575 L14.9389263,8.95491503 L19.5054023,9.61846284 C20.0519472,9.69788046 20.4306287,10.2053233 20.351211,10.7518682 C20.3195865,10.9695052 20.2170993,11.1706476 20.0596157,11.3241562 L16.7552826,14.545085 L17.5353298,19.0931094 C17.6286908,19.6374458 17.263103,20.1544017 16.7187666,20.2477627 C16.5020089,20.2849396 16.2790408,20.2496249 16.0843804,20.1472858 L12,18 Z" class="svg" opacity=".3" /></g></svg>`; }
                                    </script>
                                    ';
                                }
                            } else {
                                if (isset($_SESSION['loggedin'])) {
                                    $sql = "SELECT reviews.*, customers.* FROM reviews INNER JOIN customers ON reviews.uid = customers.id WHERE reviews.pid = $product_id ORDER BY reviews.date DESC";
                                    $res = $con-> query($sql);
                                    if ($res-> num_rows == 0) { echo '<span class="flex w-100 flex-align-c flex-justify-con-c text-secondary">Nincsenek ehhez a termékhez értékelések.</span>'; }
                                } else { echo '<span class="flex w-100 flex-align-c flex-justify-con-c text-secondary">Nincsenek ehhez a termékhez értékelések.</span>'; }
                            }
                        ?>
                        
                    </div>
                </div>
            </div>
            <div class="rightcolumn flex flex-col flex-wrap" id="product-side">
                <div class="flex flex-col flex-wrap card border-soft box-shadow">
                    <div class="flex flex-col gap-1">
                        <div class="flex flex-col flex-align-l flex-justify-con-l gap-1">
                            <?php 
                                if (isset($discounted)) {
                                    $now = new DateTime();$future_date = new DateTime($discount_end);$interval = $future_date->diff($now);if ($interval-> format('%a') > 0) {$exp = $interval->format("%a nap");}
                                    if ($interval->format('%a') < 1) {$exp = $interval->format("%h óra");} if ($interval->format('%h') < 1) {$exp = $interval->format("%i perc");}
                                    if ($interval->format('%i') < 1) {$exp = $interval->format("%s mp");}if ($interval->format('%s') < 1) {$exp = 'Lejárt...';}
                                    echo '<div class="flex flex-col"><span class="flex flex-row bold" style="align-items: flex-end;"><span class="flex flex-row text-primary" style="font-size: 19.2px;"><span style="margin-right: .5rem">Ár:</span>';
                                    echo $new_price. " " . strtoupper($product_price_unit); echo '<span class="text-secondary small flex" style="text-decoration:line-through; margin-left: .32px; align-items:flex-end;">'; echo $product_price; echo ' </span></span></span>';
                                    echo '<div class="flex flex-row border-soft bold small danger has-tooltip relative" aria-describedby="tooltipDiscountEnd">Akció vége: '; echo $exp; echo '<span class="tooltip absolute" id="tooltipDiscountEnd"><span key="tooltipDiscountEnd" key="tooltipDiscountEnd">'. $discount_end .'</span></span></div></div>';
                                } else {echo '<span class="text-primary" style="font-size: 19.2px;">Ár: <span class="bold uppercase">'; echo $product_price . " " . strtoupper($product_price_unit); echo '</span></span>';}
                            ?>
                        </div>
                        <div class="flex flex-col gap-05">
                            <div>
                            <?php
                                if ($product_quantity > 15) {echo '<div class="flex flex-row flex-align-c"><span class="bold small" style="color: #198754;">Raktáron!</span></div>';}
                                if ($product_quantity > 5 && $product_quantity < 15) {echo '<div class="flex flex-row flex-align-c"><span class="bold small" style="color: #ff9800;">Kifutó termék!</span></div>';}
                                if ($product_quantity < 5 && $product_quantity > 0) {echo '<div class="flex flex-row flex-align-c"><span class="bold small" style="color: #dc3545;">Utolsó darabok!</span></div>';}
                                if ($product_quantity == 0) {echo '<div class="flex flex-row flex-align-c"><span class="bold small" style="color: #dc3545;">Nincs raktáron!</span></div>';}
                            ?> <span class="text-primary small">Szállítás <span class="bold">max 1-2</span> munkanapon belül</span>
                            </div>
                            <span class="text-secondary small-med">Ingyenes kiszállítás Bács-Kiskun megyében. Az ország többi megyéjében szállítási díjat számolunk fel.</span>
                            <span class="text-secondary small-med">A szállítási költségekről szóló tájékoztatónkat <a onclick="feat__learn('shipping');" class="underline pointer user-select-none" style="color: var(--section-title) !important;">itt tekintheti meg</a>.</span>
                        </div>
                        <div class="flex flex-col gap-05">
                            <?php
                                if (isset($uid)) {
                                    if ($product_quantity == 0) {
                                        $bksql = "SELECT * FROM notify WHERE uid = '". $uid ."' AND pid = '".$product_id."' AND email = '".$email."'";
                                        $bkres = $con-> query($bksql);
                                        if ($bkres-> num_rows > 0) {echo '<span class="flex flex-row flex-align-c gap-05 notify" notify-event="1"><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="16px" height="16px" viewBox="0 0 24 24" version="1.1"><g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"><rect x="0" y="0" width="24" height="24"/><path d="M7.14319965,19.3575259 C7.67122143,19.7615175 8.25104409,20.1012165 8.87097532,20.3649307 L7.89205065,22.0604779 C7.61590828,22.5387706 7.00431787,22.7026457 6.52602525,22.4265033 C6.04773263,22.150361 5.88385747,21.5387706 6.15999985,21.0604779 L7.14319965,19.3575259 Z M15.1367085,20.3616573 C15.756345,20.0972995 16.3358198,19.7569961 16.8634386,19.3524415 L17.8320512,21.0301278 C18.1081936,21.5084204 17.9443184,22.1200108 17.4660258,22.3961532 C16.9877332,22.6722956 16.3761428,22.5084204 16.1000004,22.0301278 L15.1367085,20.3616573 Z" class="svg"/><path d="M12,21 C7.581722,21 4,17.418278 4,13 C4,8.581722 7.581722,5 12,5 C16.418278,5 20,8.581722 20,13 C20,17.418278 16.418278,21 12,21 Z M19.068812,3.25407593 L20.8181344,5.00339833 C21.4039208,5.58918477 21.4039208,6.53893224 20.8181344,7.12471868 C20.2323479,7.71050512 19.2826005,7.71050512 18.696814,7.12471868 L16.9474916,5.37539627 C16.3617052,4.78960984 16.3617052,3.83986237 16.9474916,3.25407593 C17.5332781,2.66828949 18.4830255,2.66828949 19.068812,3.25407593 Z M5.29862906,2.88207799 C5.8844155,2.29629155 6.83416297,2.29629155 7.41994941,2.88207799 C8.00573585,3.46786443 8.00573585,4.4176119 7.41994941,5.00339833 L5.29862906,7.12471868 C4.71284263,7.71050512 3.76309516,7.71050512 3.17730872,7.12471868 C2.59152228,6.53893224 2.59152228,5.58918477 3.17730872,5.00339833 L5.29862906,2.88207799 Z" class="svg" opacity="0.3"/><path d="M11.9630156,7.5 L12.0475062,7.5 C12.3043819,7.5 12.5194647,7.69464724 12.5450248,7.95024814 L13,12.5 L16.2480695,14.3560397 C16.403857,14.4450611 16.5,14.6107328 16.5,14.7901613 L16.5,15 C16.5,15.2109164 16.3290185,15.3818979 16.1181021,15.3818979 C16.0841582,15.3818979 16.0503659,15.3773725 16.0176181,15.3684413 L11.3986612,14.1087258 C11.1672824,14.0456225 11.0132986,13.8271186 11.0316926,13.5879956 L11.4644883,7.96165175 C11.4845267,7.70115317 11.7017474,7.5 11.9630156,7.5 Z" class="svg"/></g></svg><span class="text-primary small-med bold pointer link">Ne értesítsen, ha elérhető</span></span>';} 
                                        else {echo '<span class="flex flex-row flex-align-c gap-05 notify" notify-event="0"><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="16px" height="16px" viewBox="0 0 24 24" version="1.1"><g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"><rect x="0" y="0" width="24" height="24"/><path d="M7.14319965,19.3575259 C7.67122143,19.7615175 8.25104409,20.1012165 8.87097532,20.3649307 L7.89205065,22.0604779 C7.61590828,22.5387706 7.00431787,22.7026457 6.52602525,22.4265033 C6.04773263,22.150361 5.88385747,21.5387706 6.15999985,21.0604779 L7.14319965,19.3575259 Z M15.1367085,20.3616573 C15.756345,20.0972995 16.3358198,19.7569961 16.8634386,19.3524415 L17.8320512,21.0301278 C18.1081936,21.5084204 17.9443184,22.1200108 17.4660258,22.3961532 C16.9877332,22.6722956 16.3761428,22.5084204 16.1000004,22.0301278 L15.1367085,20.3616573 Z" class="svg"/><path d="M12,21 C7.581722,21 4,17.418278 4,13 C4,8.581722 7.581722,5 12,5 C16.418278,5 20,8.581722 20,13 C20,17.418278 16.418278,21 12,21 Z M19.068812,3.25407593 L20.8181344,5.00339833 C21.4039208,5.58918477 21.4039208,6.53893224 20.8181344,7.12471868 C20.2323479,7.71050512 19.2826005,7.71050512 18.696814,7.12471868 L16.9474916,5.37539627 C16.3617052,4.78960984 16.3617052,3.83986237 16.9474916,3.25407593 C17.5332781,2.66828949 18.4830255,2.66828949 19.068812,3.25407593 Z M5.29862906,2.88207799 C5.8844155,2.29629155 6.83416297,2.29629155 7.41994941,2.88207799 C8.00573585,3.46786443 8.00573585,4.4176119 7.41994941,5.00339833 L5.29862906,7.12471868 C4.71284263,7.71050512 3.76309516,7.71050512 3.17730872,7.12471868 C2.59152228,6.53893224 2.59152228,5.58918477 3.17730872,5.00339833 L5.29862906,2.88207799 Z" class="svg" opacity="0.3"/><path d="M11.9630156,7.5 L12.0475062,7.5 C12.3043819,7.5 12.5194647,7.69464724 12.5450248,7.95024814 L13,12.5 L16.2480695,14.3560397 C16.403857,14.4450611 16.5,14.6107328 16.5,14.7901613 L16.5,15 C16.5,15.2109164 16.3290185,15.3818979 16.1181021,15.3818979 C16.0841582,15.3818979 16.0503659,15.3773725 16.0176181,15.3684413 L11.3986612,14.1087258 C11.1672824,14.0456225 11.0132986,13.8271186 11.0316926,13.5879956 L11.4644883,7.96165175 C11.4845267,7.70115317 11.7017474,7.5 11.9630156,7.5 Z" class="svg"/></g></svg><span class="text-primary small-med bold pointer link">Értesítsen, ha elérhető</span></span>';}
                                        
                                        echo '<span class="button button-disabled flex flex-align-c flex-justify-con-sb"><span>Megvásárlás</span><span class="flex"><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1"><g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"><rect x="0" y="0" width="24" height="24"/><rect fill="#7f7e83" opacity="0.3" x="2" y="5" width="20" height="14" rx="2"/><rect fill="#7f7e83" x="2" y="8" width="20" height="3"/><rect fill="#7f7e83" opacity="0.3" x="16" y="14" width="4" height="2" rx="1"/></g></svg></span></span>';
                                    } else {echo '<span class="button button-primary flex flex-align-c flex-justify-con-sb" onclick="__ch('.$product_id.')"><span>Megvásárlás</span><span class="flex"><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1"><g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"><rect x="0" y="0" width="24" height="24"/><rect class="svg-contrast" opacity="0.3" x="2" y="5" width="20" height="14" rx="2"/><rect class="svg-contrast" x="2" y="8" width="20" height="3"/><rect class="svg-contrast" opacity="0.3" x="16" y="14" width="4" height="2" rx="1"/></g></svg></span></span>';}
                                } else {
                                    if ($product_quantity == 0) {
                                        echo '<span class="flex flex-row flex-align-c gap-05 notify"><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="16px" height="16px" viewBox="0 0 24 24" version="1.1"><g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"><rect x="0" y="0" width="24" height="24"/><path d="M7.14319965,19.3575259 C7.67122143,19.7615175 8.25104409,20.1012165 8.87097532,20.3649307 L7.89205065,22.0604779 C7.61590828,22.5387706 7.00431787,22.7026457 6.52602525,22.4265033 C6.04773263,22.150361 5.88385747,21.5387706 6.15999985,21.0604779 L7.14319965,19.3575259 Z M15.1367085,20.3616573 C15.756345,20.0972995 16.3358198,19.7569961 16.8634386,19.3524415 L17.8320512,21.0301278 C18.1081936,21.5084204 17.9443184,22.1200108 17.4660258,22.3961532 C16.9877332,22.6722956 16.3761428,22.5084204 16.1000004,22.0301278 L15.1367085,20.3616573 Z" class="svg"/><path d="M12,21 C7.581722,21 4,17.418278 4,13 C4,8.581722 7.581722,5 12,5 C16.418278,5 20,8.581722 20,13 C20,17.418278 16.418278,21 12,21 Z M19.068812,3.25407593 L20.8181344,5.00339833 C21.4039208,5.58918477 21.4039208,6.53893224 20.8181344,7.12471868 C20.2323479,7.71050512 19.2826005,7.71050512 18.696814,7.12471868 L16.9474916,5.37539627 C16.3617052,4.78960984 16.3617052,3.83986237 16.9474916,3.25407593 C17.5332781,2.66828949 18.4830255,2.66828949 19.068812,3.25407593 Z M5.29862906,2.88207799 C5.8844155,2.29629155 6.83416297,2.29629155 7.41994941,2.88207799 C8.00573585,3.46786443 8.00573585,4.4176119 7.41994941,5.00339833 L5.29862906,7.12471868 C4.71284263,7.71050512 3.76309516,7.71050512 3.17730872,7.12471868 C2.59152228,6.53893224 2.59152228,5.58918477 3.17730872,5.00339833 L5.29862906,2.88207799 Z" class="svg" opacity="0.3"/><path d="M11.9630156,7.5 L12.0475062,7.5 C12.3043819,7.5 12.5194647,7.69464724 12.5450248,7.95024814 L13,12.5 L16.2480695,14.3560397 C16.403857,14.4450611 16.5,14.6107328 16.5,14.7901613 L16.5,15 C16.5,15.2109164 16.3290185,15.3818979 16.1181021,15.3818979 C16.0841582,15.3818979 16.0503659,15.3773725 16.0176181,15.3684413 L11.3986612,14.1087258 C11.1672824,14.0456225 11.0132986,13.8271186 11.0316926,13.5879956 L11.4644883,7.96165175 C11.4845267,7.70115317 11.7017474,7.5 11.9630156,7.5 Z" class="svg"/></g></svg><span class="text-primary small-med bold pointer link">Értesítsen, ha elérhető</span></span>';
                                        echo '<span class="button button-disabled flex flex-align-c flex-justify-con-sb"><span>Megvásárlás</span><span class="flex"><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1"><g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"><rect x="0" y="0" width="24" height="24"/><rect fill="#7f7e83" opacity="0.3" x="2" y="5" width="20" height="14" rx="2"/><rect fill="#7f7e83" x="2" y="8" width="20" height="3"/><rect fill="#7f7e83" opacity="0.3" x="16" y="14" width="4" height="2" rx="1"/></g></svg></span></span>';
                                    } else {echo '<span class="button button-primary flex flex-align-c flex-justify-con-sb"><span>Megvásárlás</span><span class="flex"><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1"><g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"><rect x="0" y="0" width="24" height="24"/><rect class="svg-contrast" opacity="0.3" x="2" y="5" width="20" height="14" rx="2"/><rect class="svg-contrast" x="2" y="8" width="20" height="3"/><rect class="svg-contrast" opacity="0.3" x="16" y="14" width="4" height="2" rx="1"/></g></svg></span></span>';}
                                }
                            ?>
                            <div class="flex flex-row flex-align-c w-100 gap-1">
                                <div class="flex flex-align-c pointer">
                                    <?php
                                        if (isset($uid)) {
                                            $bksql = "SELECT * FROM bookmarks WHERE uid = '". $uid ."' AND product_id = '".$product_id."'";
                                            $bkres = $con-> query($bksql);
                                            if ($bkres-> num_rows > 0) {echo '<div class="product_act_btn product_bookmark product__bm__trig" action="1" code="'; echo $product_code; echo'" keyid="'; echo $product_id; echo'"><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="32px" height="32px" viewBox="0 0 24 24" version="1.1"><g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"><rect x="0" y="0" width="24" height="24"/><path d="M8,4 L16,4 C17.1045695,4 18,4.8954305 18,6 L18,17.726765 C18,18.2790497 17.5522847,18.726765 17,18.726765 C16.7498083,18.726765 16.5087052,18.6329798 16.3242754,18.4639191 L12.6757246,15.1194142 C12.2934034,14.7689531 11.7065966,14.7689531 11.3242754,15.1194142 L7.67572463,18.4639191 C7.26860564,18.8371115 6.63603827,18.8096086 6.26284586,18.4024896 C6.09378519,18.2180598 6,17.9769566 6,17.726765 L6,6 C6,4.8954305 6.8954305,4 8,4 Z" class="svg"/></g></svg></div>';} 
                                            else {echo '<div class="flex flex-align-c product_act_btn product_bookmark product__bm__trig" action="0" code="'; echo $product_code; echo'" keyid="'; echo $product_id; echo'"><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="32px" height="32px" viewBox="0 0 24 24" version="1.1"><g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"><rect x="0" y="0" width="24" height="24"/><path d="M8,4 L16,4 C17.1045695,4 18,4.8954305 18,6 L18,17.726765 C18,18.2790497 17.5522847,18.726765 17,18.726765 C16.7498083,18.726765 16.5087052,18.6329798 16.3242754,18.4639191 L12.6757246,15.1194142 C12.2934034,14.7689531 11.7065966,14.7689531 11.3242754,15.1194142 L7.67572463,18.4639191 C7.26860564,18.8371115 6.63603827,18.8096086 6.26284586,18.4024896 C6.09378519,18.2180598 6,17.9769566 6,17.726765 L6,6 C6,4.8954305 6.8954305,4 8,4 Z" class="svg-stroke"/></g></svg></div>';}
                                        } else {echo '<div class="product_act_btn" onclick="openHeaderProfileAction();"><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="32px" height="32px" viewBox="0 0 24 24" version="1.1"><g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"><rect x="0" y="0" width="24" height="24"/><path d="M8,4 L16,4 C17.1045695,4 18,4.8954305 18,6 L18,17.726765 C18,18.2790497 17.5522847,18.726765 17,18.726765 C16.7498083,18.726765 16.5087052,18.6329798 16.3242754,18.4639191 L12.6757246,15.1194142 C12.2934034,14.7689531 11.7065966,14.7689531 11.3242754,15.1194142 L7.67572463,18.4639191 C7.26860564,18.8371115 6.63603827,18.8096086 6.26284586,18.4024896 C6.09378519,18.2180598 6,17.9769566 6,17.726765 L6,6 C6,4.8954305 6.8954305,4 8,4 Z" class="svg-stroke"/></g></svg></div>';}
                                    ?>
                                </div>
                                <?php
                                    if (isset($uid)) {
                                        if ($product_quantity == 0) {echo '<span class="button button-disabled flex flex-align-c flex-justify-con-sb w-100"><span>Kosárba</span><span class="flex"><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="19.2px" height="19.2px" viewBox="0 0 24 24" version="1.1"><g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"><rect x="0" y="0" width="24" height="24"></rect><path d="M12,4.56204994 L7.76822128,9.6401844 C7.4146572,10.0644613 6.7840925,10.1217854 6.3598156,9.76822128 C5.9355387,9.4146572 5.87821464,8.7840925 6.23177872,8.3598156 L11.2317787,2.3598156 C11.6315738,1.88006147 12.3684262,1.88006147 12.7682213,2.3598156 L17.7682213,8.3598156 C18.1217854,8.7840925 18.0644613,9.4146572 17.6401844,9.76822128 C17.2159075,10.1217854 16.5853428,10.0644613 16.2317787,9.6401844 L12,4.56204994 Z" fill="#727272" fill-rule="nonzero" opacity="0.3"></path><path d="M3.28077641,9 L20.7192236,9 C21.2715083,9 21.7192236,9.44771525 21.7192236,10 C21.7192236,10.0817618 21.7091962,10.163215 21.6893661,10.2425356 L19.5680983,18.7276069 C19.234223,20.0631079 18.0342737,21 16.6576708,21 L7.34232922,21 C5.96572629,21 4.76577697,20.0631079 4.43190172,18.7276069 L2.31063391,10.2425356 C2.17668518,9.70674072 2.50244587,9.16380623 3.03824078,9.0298575 C3.11756139,9.01002735 3.1990146,9 3.28077641,9 Z M12,12 C11.4477153,12 11,12.4477153 11,13 L11,17 C11,17.5522847 11.4477153,18 12,18 C12.5522847,18 13,17.5522847 13,17 L13,13 C13,12.4477153 12.5522847,12 12,12 Z M6.96472382,12.1362967 C6.43125772,12.2792385 6.11467523,12.8275755 6.25761704,13.3610416 L7.29289322,17.2247449 C7.43583503,17.758211 7.98417199,18.0747935 8.51763809,17.9318517 C9.05110419,17.7889098 9.36768668,17.2405729 9.22474487,16.7071068 L8.18946869,12.8434035 C8.04652688,12.3099374 7.49818992,11.9933549 6.96472382,12.1362967 Z M17.0352762,12.1362967 C16.5018101,11.9933549 15.9534731,12.3099374 15.8105313,12.8434035 L14.7752551,16.7071068 C14.6323133,17.2405729 14.9488958,17.7889098 15.4823619,17.9318517 C16.015828,18.0747935 16.564165,17.758211 16.7071068,17.2247449 L17.742383,13.3610416 C17.8853248,12.8275755 17.5687423,12.2792385 17.0352762,12.1362967 Z" fill="#727272" ></path></g></svg></span></span>';}
                                        else {
                                            $bksql = "SELECT * FROM cart WHERE uid = '". $uid ."' AND pid = '".$product_id."'";
                                            $bkres = $con-> query($bksql);
                                            if ($bkres-> num_rows > 0) {echo '<span class="button button-secondary flex flex-align-c flex-justify-con-sb w-100" id="add-to-cart" key-event="1"><span>Kosárban</span><span class="flex"><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="19.2px" height="19.2px" viewBox="0 0 24 24" version="1.1"><g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"><rect x="0" y="0" width="24" height="24"></rect><path d="M12,4.56204994 L7.76822128,9.6401844 C7.4146572,10.0644613 6.7840925,10.1217854 6.3598156,9.76822128 C5.9355387,9.4146572 5.87821464,8.7840925 6.23177872,8.3598156 L11.2317787,2.3598156 C11.6315738,1.88006147 12.3684262,1.88006147 12.7682213,2.3598156 L17.7682213,8.3598156 C18.1217854,8.7840925 18.0644613,9.4146572 17.6401844,9.76822128 C17.2159075,10.1217854 16.5853428,10.0644613 16.2317787,9.6401844 L12,4.56204994 Z" class="svg" fill-rule="nonzero" opacity="0.3"></path><path d="M3.28077641,9 L20.7192236,9 C21.2715083,9 21.7192236,9.44771525 21.7192236,10 C21.7192236,10.0817618 21.7091962,10.163215 21.6893661,10.2425356 L19.5680983,18.7276069 C19.234223,20.0631079 18.0342737,21 16.6576708,21 L7.34232922,21 C5.96572629,21 4.76577697,20.0631079 4.43190172,18.7276069 L2.31063391,10.2425356 C2.17668518,9.70674072 2.50244587,9.16380623 3.03824078,9.0298575 C3.11756139,9.01002735 3.1990146,9 3.28077641,9 Z M12,12 C11.4477153,12 11,12.4477153 11,13 L11,17 C11,17.5522847 11.4477153,18 12,18 C12.5522847,18 13,17.5522847 13,17 L13,13 C13,12.4477153 12.5522847,12 12,12 Z M6.96472382,12.1362967 C6.43125772,12.2792385 6.11467523,12.8275755 6.25761704,13.3610416 L7.29289322,17.2247449 C7.43583503,17.758211 7.98417199,18.0747935 8.51763809,17.9318517 C9.05110419,17.7889098 9.36768668,17.2405729 9.22474487,16.7071068 L8.18946869,12.8434035 C8.04652688,12.3099374 7.49818992,11.9933549 6.96472382,12.1362967 Z M17.0352762,12.1362967 C16.5018101,11.9933549 15.9534731,12.3099374 15.8105313,12.8434035 L14.7752551,16.7071068 C14.6323133,17.2405729 14.9488958,17.7889098 15.4823619,17.9318517 C16.015828,18.0747935 16.564165,17.758211 16.7071068,17.2247449 L17.742383,13.3610416 C17.8853248,12.8275755 17.5687423,12.2792385 17.0352762,12.1362967 Z" class="svg"></path></g></svg></span></span>';} 
                                            else {echo '<span class="button button-secondary flex flex-align-c flex-justify-con-sb w-100" id="add-to-cart" key-event="0"><span>Kosárba</span><span class="flex"><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="19.2px" height="19.2px" viewBox="0 0 24 24" version="1.1"><g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"><rect x="0" y="0" width="24" height="24"></rect><path d="M12,4.56204994 L7.76822128,9.6401844 C7.4146572,10.0644613 6.7840925,10.1217854 6.3598156,9.76822128 C5.9355387,9.4146572 5.87821464,8.7840925 6.23177872,8.3598156 L11.2317787,2.3598156 C11.6315738,1.88006147 12.3684262,1.88006147 12.7682213,2.3598156 L17.7682213,8.3598156 C18.1217854,8.7840925 18.0644613,9.4146572 17.6401844,9.76822128 C17.2159075,10.1217854 16.5853428,10.0644613 16.2317787,9.6401844 L12,4.56204994 Z" class="svg" fill-rule="nonzero" opacity="0.3"></path><path d="M3.28077641,9 L20.7192236,9 C21.2715083,9 21.7192236,9.44771525 21.7192236,10 C21.7192236,10.0817618 21.7091962,10.163215 21.6893661,10.2425356 L19.5680983,18.7276069 C19.234223,20.0631079 18.0342737,21 16.6576708,21 L7.34232922,21 C5.96572629,21 4.76577697,20.0631079 4.43190172,18.7276069 L2.31063391,10.2425356 C2.17668518,9.70674072 2.50244587,9.16380623 3.03824078,9.0298575 C3.11756139,9.01002735 3.1990146,9 3.28077641,9 Z M12,12 C11.4477153,12 11,12.4477153 11,13 L11,17 C11,17.5522847 11.4477153,18 12,18 C12.5522847,18 13,17.5522847 13,17 L13,13 C13,12.4477153 12.5522847,12 12,12 Z M6.96472382,12.1362967 C6.43125772,12.2792385 6.11467523,12.8275755 6.25761704,13.3610416 L7.29289322,17.2247449 C7.43583503,17.758211 7.98417199,18.0747935 8.51763809,17.9318517 C9.05110419,17.7889098 9.36768668,17.2405729 9.22474487,16.7071068 L8.18946869,12.8434035 C8.04652688,12.3099374 7.49818992,11.9933549 6.96472382,12.1362967 Z M17.0352762,12.1362967 C16.5018101,11.9933549 15.9534731,12.3099374 15.8105313,12.8434035 L14.7752551,16.7071068 C14.6323133,17.2405729 14.9488958,17.7889098 15.4823619,17.9318517 C16.015828,18.0747935 16.564165,17.758211 16.7071068,17.2247449 L17.742383,13.3610416 C17.8853248,12.8275755 17.5687423,12.2792385 17.0352762,12.1362967 Z" class="svg"></path></g></svg></span></span>';}
                                        }
                                    } else {
                                        if ($product_quantity == 0) {echo '<span class="button button-disabled flex flex-align-c flex-justify-con-sb w-100"><span>Kosárba</span><span class="flex"><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="19.2px" height="19.2px" viewBox="0 0 24 24" version="1.1"><g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"><rect x="0" y="0" width="24" height="24"></rect><path d="M12,4.56204994 L7.76822128,9.6401844 C7.4146572,10.0644613 6.7840925,10.1217854 6.3598156,9.76822128 C5.9355387,9.4146572 5.87821464,8.7840925 6.23177872,8.3598156 L11.2317787,2.3598156 C11.6315738,1.88006147 12.3684262,1.88006147 12.7682213,2.3598156 L17.7682213,8.3598156 C18.1217854,8.7840925 18.0644613,9.4146572 17.6401844,9.76822128 C17.2159075,10.1217854 16.5853428,10.0644613 16.2317787,9.6401844 L12,4.56204994 Z" fill="#727272" fill-rule="nonzero" opacity="0.3"></path><path d="M3.28077641,9 L20.7192236,9 C21.2715083,9 21.7192236,9.44771525 21.7192236,10 C21.7192236,10.0817618 21.7091962,10.163215 21.6893661,10.2425356 L19.5680983,18.7276069 C19.234223,20.0631079 18.0342737,21 16.6576708,21 L7.34232922,21 C5.96572629,21 4.76577697,20.0631079 4.43190172,18.7276069 L2.31063391,10.2425356 C2.17668518,9.70674072 2.50244587,9.16380623 3.03824078,9.0298575 C3.11756139,9.01002735 3.1990146,9 3.28077641,9 Z M12,12 C11.4477153,12 11,12.4477153 11,13 L11,17 C11,17.5522847 11.4477153,18 12,18 C12.5522847,18 13,17.5522847 13,17 L13,13 C13,12.4477153 12.5522847,12 12,12 Z M6.96472382,12.1362967 C6.43125772,12.2792385 6.11467523,12.8275755 6.25761704,13.3610416 L7.29289322,17.2247449 C7.43583503,17.758211 7.98417199,18.0747935 8.51763809,17.9318517 C9.05110419,17.7889098 9.36768668,17.2405729 9.22474487,16.7071068 L8.18946869,12.8434035 C8.04652688,12.3099374 7.49818992,11.9933549 6.96472382,12.1362967 Z M17.0352762,12.1362967 C16.5018101,11.9933549 15.9534731,12.3099374 15.8105313,12.8434035 L14.7752551,16.7071068 C14.6323133,17.2405729 14.9488958,17.7889098 15.4823619,17.9318517 C16.015828,18.0747935 16.564165,17.758211 16.7071068,17.2247449 L17.742383,13.3610416 C17.8853248,12.8275755 17.5687423,12.2792385 17.0352762,12.1362967 Z" fill="#727272" ></path></g></svg></span></span>';}
                                        else {echo '<span class="button button-secondary flex flex-align-c flex-justify-con-sb w-100" onclick="openHeaderProfileAction();"><span>Kosárba</span><span class="flex"><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="19.2px" height="19.2px" viewBox="0 0 24 24" version="1.1"><g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"><rect x="0" y="0" width="24" height="24"></rect><path d="M12,4.56204994 L7.76822128,9.6401844 C7.4146572,10.0644613 6.7840925,10.1217854 6.3598156,9.76822128 C5.9355387,9.4146572 5.87821464,8.7840925 6.23177872,8.3598156 L11.2317787,2.3598156 C11.6315738,1.88006147 12.3684262,1.88006147 12.7682213,2.3598156 L17.7682213,8.3598156 C18.1217854,8.7840925 18.0644613,9.4146572 17.6401844,9.76822128 C17.2159075,10.1217854 16.5853428,10.0644613 16.2317787,9.6401844 L12,4.56204994 Z" class="svg" fill-rule="nonzero" opacity="0.3"></path><path d="M3.28077641,9 L20.7192236,9 C21.2715083,9 21.7192236,9.44771525 21.7192236,10 C21.7192236,10.0817618 21.7091962,10.163215 21.6893661,10.2425356 L19.5680983,18.7276069 C19.234223,20.0631079 18.0342737,21 16.6576708,21 L7.34232922,21 C5.96572629,21 4.76577697,20.0631079 4.43190172,18.7276069 L2.31063391,10.2425356 C2.17668518,9.70674072 2.50244587,9.16380623 3.03824078,9.0298575 C3.11756139,9.01002735 3.1990146,9 3.28077641,9 Z M12,12 C11.4477153,12 11,12.4477153 11,13 L11,17 C11,17.5522847 11.4477153,18 12,18 C12.5522847,18 13,17.5522847 13,17 L13,13 C13,12.4477153 12.5522847,12 12,12 Z M6.96472382,12.1362967 C6.43125772,12.2792385 6.11467523,12.8275755 6.25761704,13.3610416 L7.29289322,17.2247449 C7.43583503,17.758211 7.98417199,18.0747935 8.51763809,17.9318517 C9.05110419,17.7889098 9.36768668,17.2405729 9.22474487,16.7071068 L8.18946869,12.8434035 C8.04652688,12.3099374 7.49818992,11.9933549 6.96472382,12.1362967 Z M17.0352762,12.1362967 C16.5018101,11.9933549 15.9534731,12.3099374 15.8105313,12.8434035 L14.7752551,16.7071068 C14.6323133,17.2405729 14.9488958,17.7889098 15.4823619,17.9318517 C16.015828,18.0747935 16.564165,17.758211 16.7071068,17.2247449 L17.742383,13.3610416 C17.8853248,12.8275755 17.5687423,12.2792385 17.0352762,12.1362967 Z" class="svg"></path></g></svg></span></span>';}
                                    }
                                ?>
                            </div>
                            <span class="flex flex-row flex-align-c gap-05 small text-primary"><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="14.4px" height="14.4px" viewBox="0 0 24 24" version="1.1"><g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"><mask fill="white"><use xlink:href="#path-1"/></mask><g/><path d="M7,10 L7,8 C7,5.23857625 9.23857625,3 12,3 C14.7614237,3 17,5.23857625 17,8 L17,10 L18,10 C19.1045695,10 20,10.8954305 20,12 L20,18 C20,19.1045695 19.1045695,20 18,20 L6,20 C4.8954305,20 4,19.1045695 4,18 L4,12 C4,10.8954305 4.8954305,10 6,10 L7,10 Z M12,5 C10.3431458,5 9,6.34314575 9,8 L9,10 L15,10 L15,8 C15,6.34314575 13.6568542,5 12,5 Z" class="svg"/></g></svg><span class="flex">Biztonságos tranzakció</span></span>
                        </div>
                        <div class="flex flex-col">
                            <table class="text-align-l">
                                <tr class="text-primary small"><th>Szállítás</th><td>Mappa Papír Kft.</td></tr>
                                <tr class="text-primary small"><th>Eladó</th><td>Mappa Papír Kft.</td></tr>
                            </table>
                        </div>
                        <hr style="border: 1px solid var(--background); width: 100%;">
                        <div class="flex flex-col flex-align-c">
                            <span class="text-secondary small-med textl-align-c">Problémája akadt a termékkel?</span>
                            <a class="text-secondary small-med bold underline pointer">Írjon ügyfélszolgálatunknak</a>
                        </div>
                    </div>
                </div>
                <!-- Visszaterites -->
                <div class="card border-soft box-shadow">
                    <div class="flex flex-col">
                        <span class="text-primary bold">Visszatérési lehetőség</span>
                        <div>
                            <?php
                                if (substr( $product_code, 0, 3) === "CAS") {echo '<span class="text-secondary small-med">Ez a termék nem jogosult visszatérítésre. További információért tekintse meg <a class="text-primary underline pointer">termékvisszaküldési szabályzatunkat</a>.</span>';}
                                else {echo '<span class="text-secondary small-med">Ez a termék 30 napon belüli visszatérítésre vagy cserére jogosult nyugta ellenében. A termék visszatérítését <a class="text-primary underline pointer" id="pr__pan">itt kérheti</a>.</span>';}
                            ?>
                        </div>
                    </div>
                </div>
                <!-- Termek megosztasa -->
                <div class="card border-soft box-shadow">
                    <div class="flex flex-col gap-05">
                        <span class="text-primary bold">Tetszik a termék?</span>
                        <div class="flex flex-row flex-align-c flex-justify-con-c gap-1">
                            <div class="share-item flex flex-col flex-align-c flex-justify-con-c gap-05" share-action="email" share-id="<?php echo $product_id; ?>" share-code="<?php echo $product_code; ?>" onclick="shareProduct(this.getAttribute('share-action'), this.getAttribute('share-id'), this.getAttribute('share-code'))">
                                <div class="share-item-inner flex flex-align-c flex-justify-con-c box-shadow">
                                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                        <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"><rect x="0" y="0" width="24" height="24"/><path d="M5,6 L19,6 C20.1045695,6 21,6.8954305 21,8 L21,17 C21,18.1045695 20.1045695,19 19,19 L5,19 C3.8954305,19 3,18.1045695 3,17 L3,8 C3,6.8954305 3.8954305,6 5,6 Z M18.1444251,7.83964668 L12,11.1481833 L5.85557487,7.83964668 C5.4908718,7.6432681 5.03602525,7.77972206 4.83964668,8.14442513 C4.6432681,8.5091282 4.77972206,8.96397475 5.14442513,9.16035332 L11.6444251,12.6603533 C11.8664074,12.7798822 12.1335926,12.7798822 12.3555749,12.6603533 L18.8555749,9.16035332 C19.2202779,8.96397475 19.3567319,8.5091282 19.1603533,8.14442513 C18.9639747,7.77972206 18.5091282,7.6432681 18.1444251,7.83964668 Z" class="svg" /></g>
                                    </svg>
                                </div>
                                <span class="text-secondary smaller">Email</span>
                            </div>
                            <div class="share-item flex flex-col flex-align-c flex-justify-con-c gap-05">
                                <div class="share-item-inner flex flex-align-c flex-justify-con-c box-shadow">
                                    <img src="/assets/icons/facebook-circular.svg" alt="Facebook">
                                </div>
                                <span class="text-secondary smaller">Facebook</span>
                            </div>
                            <div class="share-item flex flex-col flex-align-c flex-justify-con-c gap-05">
                                <div class="share-item-inner flex flex-align-c flex-justify-con-c box-shadow">
                                    <img src="/assets/icons/twitter-circular.svg" alt="Twitter">
                                </div>
                                <span class="text-secondary smaller">Twitter</span>
                            </div>
                            <div class="share-item flex flex-col flex-align-c flex-justify-con-c gap-05" share-action="copy" share-id="<?php echo $product_id; ?>" share-code="<?php echo $product_code; ?>" onclick="shareProduct(this.getAttribute('share-action'), this.getAttribute('share-id'), this.getAttribute('share-code'))">
                                <div class="share-item-inner flex flex-align-c flex-justify-con-c box-shadow">
                                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                        <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"><rect x="0" y="0" width="24" height="24"/><path d="M12.4644661,14.5355339 L9.46446609,14.5355339 C8.91218134,14.5355339 8.46446609,14.9832492 8.46446609,15.5355339 C8.46446609,16.0878187 8.91218134,16.5355339 9.46446609,16.5355339 L12.4644661,16.5355339 L12.4644661,17.5355339 C12.4644661,18.6401034 11.5690356,19.5355339 10.4644661,19.5355339 L6.46446609,19.5355339 C5.35989659,19.5355339 4.46446609,18.6401034 4.46446609,17.5355339 L4.46446609,13.5355339 C4.46446609,12.4309644 5.35989659,11.5355339 6.46446609,11.5355339 L10.4644661,11.5355339 C11.5690356,11.5355339 12.4644661,12.4309644 12.4644661,13.5355339 L12.4644661,14.5355339 Z" class="svg" opacity="0.3" transform="translate(8.464466, 15.535534) rotate(-45.000000) translate(-8.464466, -15.535534) "/><path d="M11.5355339,9.46446609 L14.5355339,9.46446609 C15.0878187,9.46446609 15.5355339,9.01675084 15.5355339,8.46446609 C15.5355339,7.91218134 15.0878187,7.46446609 14.5355339,7.46446609 L11.5355339,7.46446609 L11.5355339,6.46446609 C11.5355339,5.35989659 12.4309644,4.46446609 13.5355339,4.46446609 L17.5355339,4.46446609 C18.6401034,4.46446609 19.5355339,5.35989659 19.5355339,6.46446609 L19.5355339,10.4644661 C19.5355339,11.5690356 18.6401034,12.4644661 17.5355339,12.4644661 L13.5355339,12.4644661 C12.4309644,12.4644661 11.5355339,11.5690356 11.5355339,10.4644661 L11.5355339,9.46446609 Z" class="svg" transform="translate(15.535534, 8.464466) rotate(-45.000000) translate(-15.535534, -8.464466) "/></g>
                                    </svg>
                                </div>
                                <span class="text-secondary smaller">Másolás</span>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Ertekelesek diagramm -->
                <div class="card border-soft box-shadow">
                    <div class="flex flex-col">
                        <span class="text-primary bold">Értékelések <em id="ch__avg"></em></span><br>
                        <div class="flex flex-col gap-1">
                            <div class="flex flex-row gap-05">
                                <span class="flex flex-row flex-align-c flex-justify-con-c text-primary">5 <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="18px" height="18px" viewBox="0 0 24 24" version="1.1"><g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"><polygon points="0 0 24 0 24 24 0 24"></polygon><path d="M12,18 L7.91561963,20.1472858 C7.42677504,20.4042866 6.82214789,20.2163401 6.56514708,19.7274955 C6.46280801,19.5328351 6.42749334,19.309867 6.46467018,19.0931094 L7.24471742,14.545085 L3.94038429,11.3241562 C3.54490071,10.938655 3.5368084,10.3055417 3.92230962,9.91005817 C4.07581822,9.75257453 4.27696063,9.65008735 4.49459766,9.61846284 L9.06107374,8.95491503 L11.1032639,4.81698575 C11.3476862,4.32173209 11.9473121,4.11839309 12.4425657,4.36281539 C12.6397783,4.46014562 12.7994058,4.61977315 12.8967361,4.81698575 L14.9389263,8.95491503 L19.5054023,9.61846284 C20.0519472,9.69788046 20.4306287,10.2053233 20.351211,10.7518682 C20.3195865,10.9695052 20.2170993,11.1706476 20.0596157,11.3241562 L16.7552826,14.545085 L17.5353298,19.0931094 C17.6286908,19.6374458 17.263103,20.1544017 16.7187666,20.2477627 C16.5020089,20.2849396 16.2790408,20.2496249 16.0843804,20.1472858 L12,18 Z" class="svg"></path></g></svg></span>
                                <div class="flex background-bg border-soft w-100 rvc__ind"><span class="flex border-soft dark-primary-bg ease" id="rvcfi__ind"></span></div>
                                <em class="text-primary">(<span id="rvc__five">0</span>)</em>
                            </div>
                            <div class="flex flex-row gap-05">
                                <span class="flex flex-row flex-align-c flex-justify-con-c text-primary">4 <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="18px" height="18px" viewBox="0 0 24 24" version="1.1"><g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"><polygon points="0 0 24 0 24 24 0 24"></polygon><path d="M12,18 L7.91561963,20.1472858 C7.42677504,20.4042866 6.82214789,20.2163401 6.56514708,19.7274955 C6.46280801,19.5328351 6.42749334,19.309867 6.46467018,19.0931094 L7.24471742,14.545085 L3.94038429,11.3241562 C3.54490071,10.938655 3.5368084,10.3055417 3.92230962,9.91005817 C4.07581822,9.75257453 4.27696063,9.65008735 4.49459766,9.61846284 L9.06107374,8.95491503 L11.1032639,4.81698575 C11.3476862,4.32173209 11.9473121,4.11839309 12.4425657,4.36281539 C12.6397783,4.46014562 12.7994058,4.61977315 12.8967361,4.81698575 L14.9389263,8.95491503 L19.5054023,9.61846284 C20.0519472,9.69788046 20.4306287,10.2053233 20.351211,10.7518682 C20.3195865,10.9695052 20.2170993,11.1706476 20.0596157,11.3241562 L16.7552826,14.545085 L17.5353298,19.0931094 C17.6286908,19.6374458 17.263103,20.1544017 16.7187666,20.2477627 C16.5020089,20.2849396 16.2790408,20.2496249 16.0843804,20.1472858 L12,18 Z" class="svg"></path></g></svg></span>
                                <div class="flex background-bg border-soft w-100 rvc__ind"><span class="flex border-soft dark-primary-bg ease" id="rvcfo__ind"></span></div>
                                <em class="text-primary">(<span id="rvc__four">0</span>)</em>
                            </div>
                            <div class="flex flex-row gap-05">
                                <span class="flex flex-row flex-align-c flex-justify-con-c text-primary">3 <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="18px" height="18px" viewBox="0 0 24 24" version="1.1"><g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"><polygon points="0 0 24 0 24 24 0 24"></polygon><path d="M12,18 L7.91561963,20.1472858 C7.42677504,20.4042866 6.82214789,20.2163401 6.56514708,19.7274955 C6.46280801,19.5328351 6.42749334,19.309867 6.46467018,19.0931094 L7.24471742,14.545085 L3.94038429,11.3241562 C3.54490071,10.938655 3.5368084,10.3055417 3.92230962,9.91005817 C4.07581822,9.75257453 4.27696063,9.65008735 4.49459766,9.61846284 L9.06107374,8.95491503 L11.1032639,4.81698575 C11.3476862,4.32173209 11.9473121,4.11839309 12.4425657,4.36281539 C12.6397783,4.46014562 12.7994058,4.61977315 12.8967361,4.81698575 L14.9389263,8.95491503 L19.5054023,9.61846284 C20.0519472,9.69788046 20.4306287,10.2053233 20.351211,10.7518682 C20.3195865,10.9695052 20.2170993,11.1706476 20.0596157,11.3241562 L16.7552826,14.545085 L17.5353298,19.0931094 C17.6286908,19.6374458 17.263103,20.1544017 16.7187666,20.2477627 C16.5020089,20.2849396 16.2790408,20.2496249 16.0843804,20.1472858 L12,18 Z" class="svg"></path></g></svg></span>
                                <div class="flex background-bg border-soft w-100 rvc__ind"><span class="flex border-soft dark-primary-bg ease" id="rvcth__ind"></span></div>
                                <em class="text-primary">(<span id="rvc__three">0</span>)</em>
                            </div>
                            <div class="flex flex-row gap-05">
                                <span class="flex flex-row flex-align-c flex-justify-con-c text-primary">2 <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="18px" height="18px" viewBox="0 0 24 24" version="1.1"><g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"><polygon points="0 0 24 0 24 24 0 24"></polygon><path d="M12,18 L7.91561963,20.1472858 C7.42677504,20.4042866 6.82214789,20.2163401 6.56514708,19.7274955 C6.46280801,19.5328351 6.42749334,19.309867 6.46467018,19.0931094 L7.24471742,14.545085 L3.94038429,11.3241562 C3.54490071,10.938655 3.5368084,10.3055417 3.92230962,9.91005817 C4.07581822,9.75257453 4.27696063,9.65008735 4.49459766,9.61846284 L9.06107374,8.95491503 L11.1032639,4.81698575 C11.3476862,4.32173209 11.9473121,4.11839309 12.4425657,4.36281539 C12.6397783,4.46014562 12.7994058,4.61977315 12.8967361,4.81698575 L14.9389263,8.95491503 L19.5054023,9.61846284 C20.0519472,9.69788046 20.4306287,10.2053233 20.351211,10.7518682 C20.3195865,10.9695052 20.2170993,11.1706476 20.0596157,11.3241562 L16.7552826,14.545085 L17.5353298,19.0931094 C17.6286908,19.6374458 17.263103,20.1544017 16.7187666,20.2477627 C16.5020089,20.2849396 16.2790408,20.2496249 16.0843804,20.1472858 L12,18 Z" class="svg"></path></g></svg></span>
                                <div class="flex background-bg border-soft w-100 rvc__ind"><span class="flex border-soft dark-primary-bg ease" id="rvctw__ind"></span></div>
                                <em class="text-primary">(<span id="rvc__two">0</span>)</em>
                            </div>
                            <div class="flex flex-row gap-05">
                                <span class="flex flex-row flex-align-c flex-justify-con-c text-primary">1 <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="18px" height="18px" viewBox="0 0 24 24" version="1.1"><g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"><polygon points="0 0 24 0 24 24 0 24"></polygon><path d="M12,18 L7.91561963,20.1472858 C7.42677504,20.4042866 6.82214789,20.2163401 6.56514708,19.7274955 C6.46280801,19.5328351 6.42749334,19.309867 6.46467018,19.0931094 L7.24471742,14.545085 L3.94038429,11.3241562 C3.54490071,10.938655 3.5368084,10.3055417 3.92230962,9.91005817 C4.07581822,9.75257453 4.27696063,9.65008735 4.49459766,9.61846284 L9.06107374,8.95491503 L11.1032639,4.81698575 C11.3476862,4.32173209 11.9473121,4.11839309 12.4425657,4.36281539 C12.6397783,4.46014562 12.7994058,4.61977315 12.8967361,4.81698575 L14.9389263,8.95491503 L19.5054023,9.61846284 C20.0519472,9.69788046 20.4306287,10.2053233 20.351211,10.7518682 C20.3195865,10.9695052 20.2170993,11.1706476 20.0596157,11.3241562 L16.7552826,14.545085 L17.5353298,19.0931094 C17.6286908,19.6374458 17.263103,20.1544017 16.7187666,20.2477627 C16.5020089,20.2849396 16.2790408,20.2496249 16.0843804,20.1472858 L12,18 Z" class="svg"></path></g></svg></span>
                                <div class="flex background-bg border-soft w-100 rvc__ind"><span class="flex border-soft dark-primary-bg ease" id="rvcon__ind"></span></div>
                                <em class="text-primary">(<span id="rvc__one">0</span>)</em>
                            </div>
                        </div><br>
                        <span class="text-primary link small-med pointer text-align-c" id="rvw__panel">Vásárlói vélemények és értékelések működése</span>
                    </div>
                </div>
            </div>
        </div>
    </main>
    <script>
        function __ch (pid) { window.location.href = "/webshop/checkout?item="+pid; }
        var product_card = document.getElementsByClassName('product-link');
        for (let i = 0; i < product_card.length; i++) {product_card[i].addEventListener("click", function () { window.location.href = "/webshop/?id=" + product_card[i].getAttribute('auid')+"&method=52"; /* A termek az ajanlasokbol szekciobol lett megnyitva */});}
        var product_bookmark = document.getElementsByClassName('product__bm__trig'); var svg_size; var form_data = new FormData();
        for (let i = 0; i < product_bookmark.length; i++) {
            product_bookmark[i].addEventListener('click', function (e) { console.log();
                svg_size = product_bookmark[i].getElementsByTagName('svg')[0].getAttribute('width');
                form_data.append("id", product_bookmark[i].getAttribute('keyid')); form_data.append("code", product_bookmark[i].getAttribute('code')); form_data.append("action", product_bookmark[i].getAttribute('action'));
                $.ajax({
                    enctype: "multipart/form-data", type: "POST", url: "/includes/webshop/bookmark.php", data: form_data, dataType: 'json', contentType: false, processData: false,
                    success: function(data) { var respCode = String(data).slice(0, 3); var respId = String(data).slice(3, 5); // A responsebol kapott erteket szet daraboljuk, hogy a kapott ertekeket valtozokba mentsuk a tovabbi hasznalathoz
                        if (Number(respCode) === 410) {  // A statusz kod 410 (Sikeres torles)
                            for (let j = 0; j < $("[keyid="+respId+"]").length; j++) { // Az osszes olyan elem attributumat valtoztassuk meg az oldalon, amelynek az erteke a fent kapott keyId-val egyenlo.
                                $("[keyid="+respId+"]")[j].setAttribute('action', '0'); // A gomb action attributumat nullara allitjuk, ami azt jelenti, hogy mostmar hozza lehet adni a konyvjelzokhoz
                                $("[keyid="+respId+"]")[j].innerHTML = `<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="`+svg_size+`" height="`+svg_size+`" viewBox="0 0 24 24" version="1.1"><g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"><rect x="0" y="0" width="24" height="24"></rect><path d="M8,4 L16,4 C17.1045695,4 18,4.8954305 18,6 L18,17.726765 C18,18.2790497 17.5522847,18.726765 17,18.726765 C16.7498083,18.726765 16.5087052,18.6329798 16.3242754,18.4639191 L12.6757246,15.1194142 C12.2934034,14.7689531 11.7065966,14.7689531 11.3242754,15.1194142 L7.67572463,18.4639191 C7.26860564,18.8371115 6.63603827,18.8096086 6.26284586,18.4024896 C6.09378519,18.2180598 6,17.9769566 6,17.726765 L6,6 C6,4.8954305 6.8954305,4 8,4 Z" class="svg-stroke"></path></g></svg>`;
                            }
                        } if (Number(respCode) === 200) {
                            for (let j = 0; j < $("[keyid="+respId+"]").length; j++) { // Az osszes olyan elem attributumat valtoztassuk meg az oldalon, amelynek az erteke a fent kapott keyId-val egyenlo.
                                $("[keyid="+respId+"]")[j].setAttribute('action', '1'); // A gomb action attributumat nullara allitjuk, ami azt jelenti, hogy mostmar hozza lehet adni a konyvjelzokhoz
                                $("[keyid="+respId+"]")[j].innerHTML = `<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="`+svg_size+`" height="`+svg_size+`" viewBox="0 0 24 24" version="1.1"><g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"><rect x="0" y="0" width="24" height="24"></rect><path d="M8,4 L16,4 C17.1045695,4 18,4.8954305 18,6 L18,17.726765 C18,18.2790497 17.5522847,18.726765 17,18.726765 C16.7498083,18.726765 16.5087052,18.6329798 16.3242754,18.4639191 L12.6757246,15.1194142 C12.2934034,14.7689531 11.7065966,14.7689531 11.3242754,15.1194142 L7.67572463,18.4639191 C7.26860564,18.8371115 6.63603827,18.8096086 6.26284586,18.4024896 C6.09378519,18.2180598 6,17.9769566 6,17.726765 L6,6 C6,4.8954305 6.8954305,4 8,4 Z" class="svg"></path></g></svg>`;
                            }
                        }
                    }, error: function (data) {notificationSystem(0, 1, 0, "Hiba", "Sikertelen művelet!");}
                });
            });
        }
        <?php
        if (isset($uid)) {
            echo '
            var cart_button = document.getElementById("add-to-cart"); 
            if (cart_button) {
                var cart_data = new FormData(); cart_data.append("pid", '; echo $product_id; echo'); cart_data.append("event", cart_button.getAttribute("key-event"));
                cart_button.addEventListener("click", function () {
                    $.ajax({
                        enctype: "multipart/form-data", type: "POST", url: "/includes/webshop/cart.php", data: cart_data, dataType: "json", contentType: false, processData: false,
                        success: function(data) {
                            var respCode = String(data).slice(0, 3); var respId = String(data).slice(3, 5); // A responsebol kapott erteket szet daraboljuk, hogy a kapott ertekeket valtozokba mentsuk a tovabbi hasznalathoz
                            if (Number(respCode) === 410) {  // A statusz kod 410 (Sikeres torles) 
                                cart_button.setAttribute("key-event", "0");
                                if (Number(document.getElementById("bspc__ind").textContent) === 1) { document.getElementById("bspc__ind").remove(); } 
                                else { document.getElementById("bspc__ind").textContent = Number(document.getElementById("bspc__ind").textContent) - 1; }
                                cart_button.innerHTML = `<span>Kosárba</span><span class="flex"><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="19.2px" height="19.2px" viewBox="0 0 24 24" version="1.1"><g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"><rect x="0" y="0" width="24" height="24"></rect><path d="M12,4.56204994 L7.76822128,9.6401844 C7.4146572,10.0644613 6.7840925,10.1217854 6.3598156,9.76822128 C5.9355387,9.4146572 5.87821464,8.7840925 6.23177872,8.3598156 L11.2317787,2.3598156 C11.6315738,1.88006147 12.3684262,1.88006147 12.7682213,2.3598156 L17.7682213,8.3598156 C18.1217854,8.7840925 18.0644613,9.4146572 17.6401844,9.76822128 C17.2159075,10.1217854 16.5853428,10.0644613 16.2317787,9.6401844 L12,4.56204994 Z" class="svg" fill-rule="nonzero" opacity="0.3"></path><path d="M3.28077641,9 L20.7192236,9 C21.2715083,9 21.7192236,9.44771525 21.7192236,10 C21.7192236,10.0817618 21.7091962,10.163215 21.6893661,10.2425356 L19.5680983,18.7276069 C19.234223,20.0631079 18.0342737,21 16.6576708,21 L7.34232922,21 C5.96572629,21 4.76577697,20.0631079 4.43190172,18.7276069 L2.31063391,10.2425356 C2.17668518,9.70674072 2.50244587,9.16380623 3.03824078,9.0298575 C3.11756139,9.01002735 3.1990146,9 3.28077641,9 Z M12,12 C11.4477153,12 11,12.4477153 11,13 L11,17 C11,17.5522847 11.4477153,18 12,18 C12.5522847,18 13,17.5522847 13,17 L13,13 C13,12.4477153 12.5522847,12 12,12 Z M6.96472382,12.1362967 C6.43125772,12.2792385 6.11467523,12.8275755 6.25761704,13.3610416 L7.29289322,17.2247449 C7.43583503,17.758211 7.98417199,18.0747935 8.51763809,17.9318517 C9.05110419,17.7889098 9.36768668,17.2405729 9.22474487,16.7071068 L8.18946869,12.8434035 C8.04652688,12.3099374 7.49818992,11.9933549 6.96472382,12.1362967 Z M17.0352762,12.1362967 C16.5018101,11.9933549 15.9534731,12.3099374 15.8105313,12.8434035 L14.7752551,16.7071068 C14.6323133,17.2405729 14.9488958,17.7889098 15.4823619,17.9318517 C16.015828,18.0747935 16.564165,17.758211 16.7071068,17.2247449 L17.742383,13.3610416 C17.8853248,12.8275755 17.5687423,12.2792385 17.0352762,12.1362967 Z" class="svg"></path></g></svg></span>`;
                            } if (Number(respCode) === 200) { cart_button.setAttribute("key-event", "1");
                                var badge = document.getElementById("bspc__ind");
                                if (badge) { document.getElementById("bspc__ind").textContent += Number(document.getElementById("bspc__ind").textContent) + 1; }
                                else { var crbdspc__ind = document.createElement("div"); crbdspc__ind.id = "bspc__ind"; crbdspc__ind.classList = "badge badge-basket bold sidenav-badge label-danger flex flex-align-c flex-justify-con-c absolute box-shadow"; document.getElementById("deskBask").prepend(crbdspc__ind); crbdspc__ind.textContent = 1; }
                                cart_button.innerHTML = `<span>Kosárban</span><span class="flex"><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="19.2px" height="19.2px" viewBox="0 0 24 24" version="1.1"><g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"><rect x="0" y="0" width="24" height="24"></rect><path d="M12,4.56204994 L7.76822128,9.6401844 C7.4146572,10.0644613 6.7840925,10.1217854 6.3598156,9.76822128 C5.9355387,9.4146572 5.87821464,8.7840925 6.23177872,8.3598156 L11.2317787,2.3598156 C11.6315738,1.88006147 12.3684262,1.88006147 12.7682213,2.3598156 L17.7682213,8.3598156 C18.1217854,8.7840925 18.0644613,9.4146572 17.6401844,9.76822128 C17.2159075,10.1217854 16.5853428,10.0644613 16.2317787,9.6401844 L12,4.56204994 Z" class="svg" fill-rule="nonzero" opacity="0.3"></path><path d="M3.28077641,9 L20.7192236,9 C21.2715083,9 21.7192236,9.44771525 21.7192236,10 C21.7192236,10.0817618 21.7091962,10.163215 21.6893661,10.2425356 L19.5680983,18.7276069 C19.234223,20.0631079 18.0342737,21 16.6576708,21 L7.34232922,21 C5.96572629,21 4.76577697,20.0631079 4.43190172,18.7276069 L2.31063391,10.2425356 C2.17668518,9.70674072 2.50244587,9.16380623 3.03824078,9.0298575 C3.11756139,9.01002735 3.1990146,9 3.28077641,9 Z M12,12 C11.4477153,12 11,12.4477153 11,13 L11,17 C11,17.5522847 11.4477153,18 12,18 C12.5522847,18 13,17.5522847 13,17 L13,13 C13,12.4477153 12.5522847,12 12,12 Z M6.96472382,12.1362967 C6.43125772,12.2792385 6.11467523,12.8275755 6.25761704,13.3610416 L7.29289322,17.2247449 C7.43583503,17.758211 7.98417199,18.0747935 8.51763809,17.9318517 C9.05110419,17.7889098 9.36768668,17.2405729 9.22474487,16.7071068 L8.18946869,12.8434035 C8.04652688,12.3099374 7.49818992,11.9933549 6.96472382,12.1362967 Z M17.0352762,12.1362967 C16.5018101,11.9933549 15.9534731,12.3099374 15.8105313,12.8434035 L14.7752551,16.7071068 C14.6323133,17.2405729 14.9488958,17.7889098 15.4823619,17.9318517 C16.015828,18.0747935 16.564165,17.758211 16.7071068,17.2247449 L17.742383,13.3610416 C17.8853248,12.8275755 17.5687423,12.2792385 17.0352762,12.1362967 Z" class="svg"></path></g></svg></span>`;
                            }
                        }, error: function (data) {console.log(data);notificationSystem(0, 1, 0, "Hiba", "Sikertelen művelet!");}
                    });
                });
            }
            ';
        }
        ?>
        var notify = document.getElementsByClassName('notify'); var notify_data = new FormData();
        for (let i = 0; i < notify.length; i++) {
            notify[i].addEventListener('click', function () {
                if (notify[i].hasAttribute('notify-event')) {
                    notify_data.append('pid', Number(<?php echo $product_id; ?>)); notify_data.append('email', '<?php echo $email; ?>'); notify_data.append("action", Number(notify[i].getAttribute('notify-event')));
                    $.ajax({
                        enctype: "multipart/form-data", type: "POST", url: "/includes/webshop/notify.php", data: notify_data, dataType: 'json', contentType: false, processData: false,
                        success: function(data) {
                            var respCode = String(data).slice(0, 3); var respId = String(data).slice(3, 5); // A responsebol kapott erteket szet daraboljuk, hogy a kapott ertekeket valtozokba mentsuk a tovabbi hasznalathoz
                            if (Number(respCode) === 200) {notify[i].setAttribute('notify-event', 1);notify[i].lastChild.textContent = 'Ne értesítsen, ha elérhető';}
                            if (Number(respCode) === 410) {notify[i].setAttribute('notify-event', 0);notify[i].lastChild.textContent = 'Értesítsen, ha elérhető';}
                            if (Number(respCode) === 30) {notificationSystem(0, 1, 0, "Figyelem!", "Már fel van iratkozva!");}
                        }, error: function (data) {notificationSystem(0, 1, 0, "Hiba", "Sikertelen művelet!");}
                    });
                } else {openHeaderProfileAction();}
            });
        }
        function insertAfter(newNode, referenceNode) {referenceNode.insertBefore(newNode, referenceNode.nextSibling);}
        if( /Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent) || window.innerWidth <= 600) {$("#product-side").insertBefore($('#product-main')); $('#mini-suggestions').remove();}
    </script>
    <!-- Csillagok kezelesere szolgalo script -->
    <script src="/assets/script/stars.js"></script><script>let review = new reviews(<?php echo $product_id; ?>); review.__init();</script>
    <!-- Panelek -->
    <script src="/assets/script/review/vote.js"></script><script src="/assets/script/review/share.js"></script>
    <script src="/assets/script/review/sort.js"></script><script src="/assets/script/review/report.js"></script>
    <script src="/assets/script/features/panel.js"></script><script src="/assets/script/webshop/panels.js"></script>
    <script src="/assets/script/share.js"></script>
    <?php
} else { echo "<script>location.href='/404';</script>"; }
require_once($_SERVER['DOCUMENT_ROOT'].'/includes/footer.php');
?>
