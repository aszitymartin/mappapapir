<?php require_once($_SERVER['DOCUMENT_ROOT'].'/includes/header.php');
if (!isset($params['id'])) { header('Location: /404.php'); }
$csql = "SELECT id FROM products WHERE id = {$params['id']}"; $cres = $con->query($csql);
if ($cres->num_rows < 1) { header('Location: /404.php'); } if (isset($_SESSION['loggedin'])) { $uid = $_SESSION['id']; }
$sql = "SELECT products.id, products.name, products.description, products.thumbnail, products__category.category, products__category.tags, products__pricing.base, products__pricing.discounted, products__pricing.discount, products__pricing.start, products__pricing.end, products__media.images, products__inventory.code, products__inventory.quantity, products__inventory.q__warehouse, products__inventory.unit, products__inventory.backorder, products__variations.color, products__variations.material, products__variations.style, products__variations.brand, products__variations.model, products__variations.custom, products__shipping.physical, products__shipping.weight, products__shipping.w__unit, products__shipping.width, products__shipping.height, products__shipping.length, products__shipping.d__unit, products__shipping.refund, products__meta.title AS 'meta__title', products__meta.description AS 'meta__desc', products__meta.keywords AS 'meta__keyw', products__review.enable, products__review.auth, products__review.vote, products__review.privacy, products__status.status, products__status.schedule FROM `products` INNER JOIN products__category ON products__category.pid = products.id INNER JOIN products__pricing ON products__pricing.pid = products.id INNER JOIN products__media ON products__media.pid = products.id INNER JOIN products__inventory ON products__inventory.pid = products.id INNER JOIN products__variations ON products__variations.pid = products.id INNER JOIN products__shipping ON products__shipping.pid = products.id INNER JOIN products__meta ON products__meta.pid = products.id INNER JOIN products__review ON products__review.pid = products.id INNER JOIN products__status ON products__status.pid = products.id WHERE products.id = {$params['id']}"; if ($result = $con->query($sql)) {$product = $result->fetch_array();} else {header("Location: /500");} $pid = $product['id']; ?>
<script>var formatter = new Intl.NumberFormat('hu-HU', {style: 'currency',currency: 'HUF',maximumFractionDigits: 0,minimumFractionDigits: 0});</script>
<script>
    function magnify(imgID, zoom) {
        var img, glass, w, h, bw; img = document.getElementById(imgID);
        glass = document.createElement("DIV"); glass.setAttribute("class", "img-magnifier-glass");
        if (!img.parentElement.contains(glass)) {
            img.parentElement.insertBefore(glass, img);   
        } 
        glass.style.backgroundImage = "url('" + img.src + "')";
        glass.style.backgroundRepeat = "no-repeat"; glass.style.backgroundSize = (img.width * zoom) + "px " + (img.height * zoom) + "px"; bw = 3;
        w = glass.offsetWidth / 2; h = glass.offsetHeight / 2;
        glass.addEventListener("mousemove", moveMagnifier); img.addEventListener("mousemove", moveMagnifier);
        glass.addEventListener("touchmove", moveMagnifier); img.addEventListener("touchmove", moveMagnifier);
        function moveMagnifier(e) { var pos, x, y;
            e.preventDefault(); pos = getCursorPos(e);
            x = pos.x; y = pos.y; if (x > img.width - (w / zoom)) {x = img.width - (w / zoom);}
            if (x < w / zoom) {x = w / zoom;} if (y > img.height - (h / zoom)) {y = img.height - (h / zoom);}
            if (y < h / zoom) {y = h / zoom;} glass.style.left = (x - w) + "px"; glass.style.top = (y - h) + "px";
            glass.style.backgroundPosition = "-" + ((x * zoom) - w + bw) + "px -" + ((y * zoom) - h + bw) + "px";
        }
        function getCursorPos(e) {
            var a, x = 0, y = 0; e = e || window.event; a = img.getBoundingClientRect(); x = e.pageX - a.left;y = e.pageY - a.top;
            x = x - window.pageXOffset; y = y - window.pageYOffset;
            return {x : x, y : y};
        }
    }
</script>
<main id="main">
<div class="prod-con" id="tabs">
    <div class="leftcolumn w-25d-100m">
        <div class="border-soft relative">
            <br><br>
            <div class="flex flex-row flex-align-c flex-justify-con-c gap-1 w-100">
                <div class="flex flex-col flex-align-c flex-justify-con-c gap-1">
                    <div class="flex flex-col flex-align-c flex-justify-con-c relative img-magnifier-container" style="height: 240px;">
                        <img id="product-thumbnail" src="/assets/images/uploads/<?php echo $product['thumbnail'] ?>" class="product-thumbnail">
                        <div style="top: -10%; right: -10%;" class="flex flex-align-c flex-justify-con-c padding-025 absolute item-bg circle text-secondary link-color box-shadow-dark pointer" aria-label="Megosztás" title="Megosztás">
                            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><rect opacity="0.3" x="12.75" y="4.25" width="12" height="2" rx="1" transform="rotate(90 12.75 4.25)" fill="currentColor"/><path d="M12.0573 6.11875L13.5203 7.87435C13.9121 8.34457 14.6232 8.37683 15.056 7.94401C15.4457 7.5543 15.4641 6.92836 15.0979 6.51643L12.4974 3.59084C12.0996 3.14332 11.4004 3.14332 11.0026 3.59084L8.40206 6.51643C8.0359 6.92836 8.0543 7.5543 8.44401 7.94401C8.87683 8.37683 9.58785 8.34458 9.9797 7.87435L11.4427 6.11875C11.6026 5.92684 11.8974 5.92684 12.0573 6.11875Z" fill="currentColor"/><path opacity="0.3" d="M18.75 8.25H17.75C17.1977 8.25 16.75 8.69772 16.75 9.25C16.75 9.80228 17.1977 10.25 17.75 10.25C18.3023 10.25 18.75 10.6977 18.75 11.25V18.25C18.75 18.8023 18.3023 19.25 17.75 19.25H5.75C5.19772 19.25 4.75 18.8023 4.75 18.25V11.25C4.75 10.6977 5.19771 10.25 5.75 10.25C6.30229 10.25 6.75 9.80228 6.75 9.25C6.75 8.69772 6.30229 8.25 5.75 8.25H4.75C3.64543 8.25 2.75 9.14543 2.75 10.25V19.25C2.75 20.3546 3.64543 21.25 4.75 21.25H18.75C19.8546 21.25 20.75 20.3546 20.75 19.25V10.25C20.75 9.14543 19.8546 8.25 18.75 8.25Z" fill="currentColor"/></svg>
                        </div>
                    </div>
                    <div class="flex flex-row flex-justify-con-c gap-05">
                        <?php for ($i = 0; $i < sizeof(explode(',', $product['images'])); $i++) { echo '<div class="product-miniature border-primary pointer" data-image="/assets/images/uploads/'.explode(',', $product['images'])[$i].'"></div>'; } ?>
                    </div>
                </div>
            </div>
        </div>
        <div class="card flex flex-col border-soft box-shadow gap-2">
            <div class="flex flex-col gap-05">
                <div class="flex flex-row flex-align-c flex-justify-con-sb gap-05">
                    <div id="main-price-con">
                        <?php if ($product['discounted']) { echo '
                            <div class="flex flex-col">
                                <div class="flex flex-row flex-align-c gap-05 larger">
                                    <span class="text-danger">-'.$product['discount'].'%</span>
                                    <span class="text-primary money__form" id="main-product-price-new" default-data="'. $product['base'] - ($product['discount'] * $product['base'] / 100) .'">NaN Ft</span>
                                </div>
                                <div class="flex flex-row flex-align-c gap-05 small-med text-muted">
                                    <span>Listaár:</span><span class="linethrough money__form" id="main-product-price" default-data="'.$product['base'].'"></span>
                                </div>
                            </div>'; } else { echo '<div class="flex flex-row"><span class="text-primary larger money__form" id="main-product-price" default-data="'.$product['base'].'">Ft</span></div><script>document.getElementById("main-product-price").textContent = formatter.format('.$product['base'].');</script>'; }
                        ?>
                    </div>
                    <div class="flex flex-row">
                        <div class="flex flex-align-c pointer">
                            <?php
                                if (isset($uid)) {
                                    $bksql = "SELECT * FROM bookmarks WHERE uid = '". $uid ."' AND pid = '".$params['id']."'";
                                    $bkres = $con-> query($bksql);
                                    if ($bkres-> num_rows > 0) {echo '<div class="product_act_btn product_bookmark product__bm__trig" action="1" keyid="'; echo $params['id']; echo'"><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="32px" height="32px" viewBox="0 0 24 24" version="1.1"><g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"><rect x="0" y="0" width="24" height="24"/><path d="M8,4 L16,4 C17.1045695,4 18,4.8954305 18,6 L18,17.726765 C18,18.2790497 17.5522847,18.726765 17,18.726765 C16.7498083,18.726765 16.5087052,18.6329798 16.3242754,18.4639191 L12.6757246,15.1194142 C12.2934034,14.7689531 11.7065966,14.7689531 11.3242754,15.1194142 L7.67572463,18.4639191 C7.26860564,18.8371115 6.63603827,18.8096086 6.26284586,18.4024896 C6.09378519,18.2180598 6,17.9769566 6,17.726765 L6,6 C6,4.8954305 6.8954305,4 8,4 Z" class="svg"/></g></svg></div>';} 
                                    else {echo '<div class="flex flex-align-c product_act_btn product_bookmark product__bm__trig" action="0" keyid="'; echo $params['id']; echo'"><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="32px" height="32px" viewBox="0 0 24 24" version="1.1"><g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"><rect x="0" y="0" width="24" height="24"/><path d="M8,4 L16,4 C17.1045695,4 18,4.8954305 18,6 L18,17.726765 C18,18.2790497 17.5522847,18.726765 17,18.726765 C16.7498083,18.726765 16.5087052,18.6329798 16.3242754,18.4639191 L12.6757246,15.1194142 C12.2934034,14.7689531 11.7065966,14.7689531 11.3242754,15.1194142 L7.67572463,18.4639191 C7.26860564,18.8371115 6.63603827,18.8096086 6.26284586,18.4024896 C6.09378519,18.2180598 6,17.9769566 6,17.726765 L6,6 C6,4.8954305 6.8954305,4 8,4 Z" class="svg-stroke"/></g></svg></div>';}
                                } else {echo '<div class="product_act_btn" onclick="openHeaderProfileAction();"><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="32px" height="32px" viewBox="0 0 24 24" version="1.1"><g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"><rect x="0" y="0" width="24" height="24"/><path d="M8,4 L16,4 C17.1045695,4 18,4.8954305 18,6 L18,17.726765 C18,18.2790497 17.5522847,18.726765 17,18.726765 C16.7498083,18.726765 16.5087052,18.6329798 16.3242754,18.4639191 L12.6757246,15.1194142 C12.2934034,14.7689531 11.7065966,14.7689531 11.3242754,15.1194142 L7.67572463,18.4639191 C7.26860564,18.8371115 6.63603827,18.8096086 6.26284586,18.4024896 C6.09378519,18.2180598 6,17.9769566 6,17.726765 L6,6 C6,4.8954305 6.8954305,4 8,4 Z" class="svg-stroke"/></g></svg></div>';}
                            ?>
                        </div>
                    </div>
                </div>
                <div class="flex flex-col gap-05">
                    <span class="text-muted small-med">Ingyenes szállítás <b>Bács-Kiskun</b> megyében, illetve 30 ezer forint felett a szállítási díjat átvállaljuk.</span>
                </div>
            </div>
            <div class="flex flex-col gap-05">
                <!-- <div class="csts-select w-fa relative">
                    <?php 
                        // if ($product['status'] == 1) {
                        //     if ($product['quantity'] > 0 || $product['q__warehouse'] > 0) {
                        //         echo '<select class="hidden relative" id="product-quantity">
                        //             <option value="0">Mennyiség</option>';
                        //             for ($i = 1; $i <= $product['quantity']; $i++) { echo '<option value="'.$i.'">'.$i.' '.$product['unit'].'</option>'; }
                        //             echo '</select>';
                        //             echo '<script src="/assets/script/cst-drd.js"></script>';
                        //     } else { if ($product['backorder']) { echo '<input type="number" min="1" name="product-quantity" class="adm__input item-bg border-soft w-fa text-secondary outline-none small" id="product-quantity" placeholder="Mennyiség">'; } }
                        // }
                    ?>
                </div> -->
                <div class="flex flex-row w-fa">
                    <?php
                    if ($product['status'] == 1) {
                        if (isset($_SESSION['loggedin'])) {
                            if ($product['quantity'] > 0 || $product['q__warehouse'] > 0) {
                                echo '<span class="button button-primary flex flex-align-c flex-justify-con-sb w-fa" onclick="__ch('.$product['id'].')"><span>Megvásárlás</span><span class="flex"><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1"><g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"><rect x="0" y="0" width="24" height="24"/><rect class="svg-contrast" opacity="0.3" x="2" y="5" width="20" height="14" rx="2"/><rect class="svg-contrast" x="2" y="8" width="20" height="3"/><rect class="svg-contrast" opacity="0.3" x="16" y="14" width="4" height="2" rx="1"/></g></svg></span></span>';
                            } else {
                                if ($product['backorder']) {
                                    echo '<span class="button button-primary flex flex-align-c flex-justify-con-sb w-fa" onclick="__ch('.$product['id'].')"><span>Megvásárlás</span><span class="flex"><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1"><g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"><rect x="0" y="0" width="24" height="24"/><rect class="svg-contrast" opacity="0.3" x="2" y="5" width="20" height="14" rx="2"/><rect class="svg-contrast" x="2" y="8" width="20" height="3"/><rect class="svg-contrast" opacity="0.3" x="16" y="14" width="4" height="2" rx="1"/></g></svg></span></span>';
                                } else {
                                    echo '<div class="flex flex-col w-fa gap-05">
                                    <span class="flex flex-row flex-align-c gap-05 notify w-fa"><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="16px" height="16px" viewBox="0 0 24 24" version="1.1"><g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"><rect x="0" y="0" width="24" height="24"/><path d="M7.14319965,19.3575259 C7.67122143,19.7615175 8.25104409,20.1012165 8.87097532,20.3649307 L7.89205065,22.0604779 C7.61590828,22.5387706 7.00431787,22.7026457 6.52602525,22.4265033 C6.04773263,22.150361 5.88385747,21.5387706 6.15999985,21.0604779 L7.14319965,19.3575259 Z M15.1367085,20.3616573 C15.756345,20.0972995 16.3358198,19.7569961 16.8634386,19.3524415 L17.8320512,21.0301278 C18.1081936,21.5084204 17.9443184,22.1200108 17.4660258,22.3961532 C16.9877332,22.6722956 16.3761428,22.5084204 16.1000004,22.0301278 L15.1367085,20.3616573 Z" class="svg"/><path d="M12,21 C7.581722,21 4,17.418278 4,13 C4,8.581722 7.581722,5 12,5 C16.418278,5 20,8.581722 20,13 C20,17.418278 16.418278,21 12,21 Z M19.068812,3.25407593 L20.8181344,5.00339833 C21.4039208,5.58918477 21.4039208,6.53893224 20.8181344,7.12471868 C20.2323479,7.71050512 19.2826005,7.71050512 18.696814,7.12471868 L16.9474916,5.37539627 C16.3617052,4.78960984 16.3617052,3.83986237 16.9474916,3.25407593 C17.5332781,2.66828949 18.4830255,2.66828949 19.068812,3.25407593 Z M5.29862906,2.88207799 C5.8844155,2.29629155 6.83416297,2.29629155 7.41994941,2.88207799 C8.00573585,3.46786443 8.00573585,4.4176119 7.41994941,5.00339833 L5.29862906,7.12471868 C4.71284263,7.71050512 3.76309516,7.71050512 3.17730872,7.12471868 C2.59152228,6.53893224 2.59152228,5.58918477 3.17730872,5.00339833 L5.29862906,2.88207799 Z" class="svg" opacity="0.3"/><path d="M11.9630156,7.5 L12.0475062,7.5 C12.3043819,7.5 12.5194647,7.69464724 12.5450248,7.95024814 L13,12.5 L16.2480695,14.3560397 C16.403857,14.4450611 16.5,14.6107328 16.5,14.7901613 L16.5,15 C16.5,15.2109164 16.3290185,15.3818979 16.1181021,15.3818979 C16.0841582,15.3818979 16.0503659,15.3773725 16.0176181,15.3684413 L11.3986612,14.1087258 C11.1672824,14.0456225 11.0132986,13.8271186 11.0316926,13.5879956 L11.4644883,7.96165175 C11.4845267,7.70115317 11.7017474,7.5 11.9630156,7.5 Z" class="svg"/></g></svg><span class="text-primary small-med bold pointer link">Értesítsen, ha elérhető</span></span>
                                    <span class="button button-disabled flex flex-align-c flex-justify-con-sb w-fa"><span>Megvásárlás</span><span class="flex"><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1"><g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"><rect x="0" y="0" width="24" height="24"/><rect fill="#7f7e83" opacity="0.3" x="2" y="5" width="20" height="14" rx="2"/><rect fill="#7f7e83" x="2" y="8" width="20" height="3"/><rect fill="#7f7e83" opacity="0.3" x="16" y="14" width="4" height="2" rx="1"/></g></svg></span></span>
                                    </div>';
                                }
                            }
                        } else { echo '<span class="button button-primary flex flex-align-c flex-justify-con-sb w-fa" onclick="openHeaderProfileAction();"><span>Megvásárlás</span><span class="flex"><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1"><g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"><rect x="0" y="0" width="24" height="24"/><rect class="svg-contrast" opacity="0.3" x="2" y="5" width="20" height="14" rx="2"/><rect class="svg-contrast" x="2" y="8" width="20" height="3"/><rect class="svg-contrast" opacity="0.3" x="16" y="14" width="4" height="2" rx="1"/></g></svg></span></span>'; }
                    }
                    ?>
                </div>
                <div class="flex flex-row">
                    <?php
                        if ($product['status'] == 1) {
                            if (isset($_SESSION['loggedin'])) {
                                if ($product['quantity'] > 0) {
                                    $bksql = "SELECT * FROM cart WHERE uid = '". $uid ."' AND pid = '".$pid."'";
                                    $bkres = $con-> query($bksql);
                                    if ($bkres-> num_rows > 0) {echo '<span class="button button-secondary flex flex-align-c flex-justify-con-sb w-100" id="add-to-cart" key-event="delete"><span>Kosárban</span><span class="flex"><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="19.2px" height="19.2px" viewBox="0 0 24 24" version="1.1"><g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"><rect x="0" y="0" width="24" height="24"></rect><path d="M12,4.56204994 L7.76822128,9.6401844 C7.4146572,10.0644613 6.7840925,10.1217854 6.3598156,9.76822128 C5.9355387,9.4146572 5.87821464,8.7840925 6.23177872,8.3598156 L11.2317787,2.3598156 C11.6315738,1.88006147 12.3684262,1.88006147 12.7682213,2.3598156 L17.7682213,8.3598156 C18.1217854,8.7840925 18.0644613,9.4146572 17.6401844,9.76822128 C17.2159075,10.1217854 16.5853428,10.0644613 16.2317787,9.6401844 L12,4.56204994 Z" class="svg" fill-rule="nonzero" opacity="0.3"></path><path d="M3.28077641,9 L20.7192236,9 C21.2715083,9 21.7192236,9.44771525 21.7192236,10 C21.7192236,10.0817618 21.7091962,10.163215 21.6893661,10.2425356 L19.5680983,18.7276069 C19.234223,20.0631079 18.0342737,21 16.6576708,21 L7.34232922,21 C5.96572629,21 4.76577697,20.0631079 4.43190172,18.7276069 L2.31063391,10.2425356 C2.17668518,9.70674072 2.50244587,9.16380623 3.03824078,9.0298575 C3.11756139,9.01002735 3.1990146,9 3.28077641,9 Z M12,12 C11.4477153,12 11,12.4477153 11,13 L11,17 C11,17.5522847 11.4477153,18 12,18 C12.5522847,18 13,17.5522847 13,17 L13,13 C13,12.4477153 12.5522847,12 12,12 Z M6.96472382,12.1362967 C6.43125772,12.2792385 6.11467523,12.8275755 6.25761704,13.3610416 L7.29289322,17.2247449 C7.43583503,17.758211 7.98417199,18.0747935 8.51763809,17.9318517 C9.05110419,17.7889098 9.36768668,17.2405729 9.22474487,16.7071068 L8.18946869,12.8434035 C8.04652688,12.3099374 7.49818992,11.9933549 6.96472382,12.1362967 Z M17.0352762,12.1362967 C16.5018101,11.9933549 15.9534731,12.3099374 15.8105313,12.8434035 L14.7752551,16.7071068 C14.6323133,17.2405729 14.9488958,17.7889098 15.4823619,17.9318517 C16.015828,18.0747935 16.564165,17.758211 16.7071068,17.2247449 L17.742383,13.3610416 C17.8853248,12.8275755 17.5687423,12.2792385 17.0352762,12.1362967 Z" class="svg"></path></g></svg></span></span>';} 
                                    else {echo '<span class="button button-secondary flex flex-align-c flex-justify-con-sb w-100" id="add-to-cart" key-event="add"><span>Kosárba</span><span class="flex"><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="19.2px" height="19.2px" viewBox="0 0 24 24" version="1.1"><g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"><rect x="0" y="0" width="24" height="24"></rect><path d="M12,4.56204994 L7.76822128,9.6401844 C7.4146572,10.0644613 6.7840925,10.1217854 6.3598156,9.76822128 C5.9355387,9.4146572 5.87821464,8.7840925 6.23177872,8.3598156 L11.2317787,2.3598156 C11.6315738,1.88006147 12.3684262,1.88006147 12.7682213,2.3598156 L17.7682213,8.3598156 C18.1217854,8.7840925 18.0644613,9.4146572 17.6401844,9.76822128 C17.2159075,10.1217854 16.5853428,10.0644613 16.2317787,9.6401844 L12,4.56204994 Z" class="svg" fill-rule="nonzero" opacity="0.3"></path><path d="M3.28077641,9 L20.7192236,9 C21.2715083,9 21.7192236,9.44771525 21.7192236,10 C21.7192236,10.0817618 21.7091962,10.163215 21.6893661,10.2425356 L19.5680983,18.7276069 C19.234223,20.0631079 18.0342737,21 16.6576708,21 L7.34232922,21 C5.96572629,21 4.76577697,20.0631079 4.43190172,18.7276069 L2.31063391,10.2425356 C2.17668518,9.70674072 2.50244587,9.16380623 3.03824078,9.0298575 C3.11756139,9.01002735 3.1990146,9 3.28077641,9 Z M12,12 C11.4477153,12 11,12.4477153 11,13 L11,17 C11,17.5522847 11.4477153,18 12,18 C12.5522847,18 13,17.5522847 13,17 L13,13 C13,12.4477153 12.5522847,12 12,12 Z M6.96472382,12.1362967 C6.43125772,12.2792385 6.11467523,12.8275755 6.25761704,13.3610416 L7.29289322,17.2247449 C7.43583503,17.758211 7.98417199,18.0747935 8.51763809,17.9318517 C9.05110419,17.7889098 9.36768668,17.2405729 9.22474487,16.7071068 L8.18946869,12.8434035 C8.04652688,12.3099374 7.49818992,11.9933549 6.96472382,12.1362967 Z M17.0352762,12.1362967 C16.5018101,11.9933549 15.9534731,12.3099374 15.8105313,12.8434035 L14.7752551,16.7071068 C14.6323133,17.2405729 14.9488958,17.7889098 15.4823619,17.9318517 C16.015828,18.0747935 16.564165,17.758211 16.7071068,17.2247449 L17.742383,13.3610416 C17.8853248,12.8275755 17.5687423,12.2792385 17.0352762,12.1362967 Z" class="svg"></path></g></svg></span></span>';}
                                } else { echo '<span class="button button-disabled flex flex-align-c flex-justify-con-sb w-100"><span>Kosárba</span><span class="flex"><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="19.2px" height="19.2px" viewBox="0 0 24 24" version="1.1"><g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"><rect x="0" y="0" width="24" height="24"></rect><path d="M12,4.56204994 L7.76822128,9.6401844 C7.4146572,10.0644613 6.7840925,10.1217854 6.3598156,9.76822128 C5.9355387,9.4146572 5.87821464,8.7840925 6.23177872,8.3598156 L11.2317787,2.3598156 C11.6315738,1.88006147 12.3684262,1.88006147 12.7682213,2.3598156 L17.7682213,8.3598156 C18.1217854,8.7840925 18.0644613,9.4146572 17.6401844,9.76822128 C17.2159075,10.1217854 16.5853428,10.0644613 16.2317787,9.6401844 L12,4.56204994 Z" fill="currentColor" fill-rule="nonzero" opacity="0.3"></path><path d="M3.28077641,9 L20.7192236,9 C21.2715083,9 21.7192236,9.44771525 21.7192236,10 C21.7192236,10.0817618 21.7091962,10.163215 21.6893661,10.2425356 L19.5680983,18.7276069 C19.234223,20.0631079 18.0342737,21 16.6576708,21 L7.34232922,21 C5.96572629,21 4.76577697,20.0631079 4.43190172,18.7276069 L2.31063391,10.2425356 C2.17668518,9.70674072 2.50244587,9.16380623 3.03824078,9.0298575 C3.11756139,9.01002735 3.1990146,9 3.28077641,9 Z M12,12 C11.4477153,12 11,12.4477153 11,13 L11,17 C11,17.5522847 11.4477153,18 12,18 C12.5522847,18 13,17.5522847 13,17 L13,13 C13,12.4477153 12.5522847,12 12,12 Z M6.96472382,12.1362967 C6.43125772,12.2792385 6.11467523,12.8275755 6.25761704,13.3610416 L7.29289322,17.2247449 C7.43583503,17.758211 7.98417199,18.0747935 8.51763809,17.9318517 C9.05110419,17.7889098 9.36768668,17.2405729 9.22474487,16.7071068 L8.18946869,12.8434035 C8.04652688,12.3099374 7.49818992,11.9933549 6.96472382,12.1362967 Z M17.0352762,12.1362967 C16.5018101,11.9933549 15.9534731,12.3099374 15.8105313,12.8434035 L14.7752551,16.7071068 C14.6323133,17.2405729 14.9488958,17.7889098 15.4823619,17.9318517 C16.015828,18.0747935 16.564165,17.758211 16.7071068,17.2247449 L17.742383,13.3610416 C17.8853248,12.8275755 17.5687423,12.2792385 17.0352762,12.1362967 Z" fill="currentColor"></path></g></svg></span></span>'; }
                            } else { echo '<span class="button button-secondary flex flex-align-c flex-justify-con-sb w-100" onclick="openHeaderProfileAction();"><span>Kosárba</span><span class="flex"><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="19.2px" height="19.2px" viewBox="0 0 24 24" version="1.1"><g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"><rect x="0" y="0" width="24" height="24"></rect><path d="M12,4.56204994 L7.76822128,9.6401844 C7.4146572,10.0644613 6.7840925,10.1217854 6.3598156,9.76822128 C5.9355387,9.4146572 5.87821464,8.7840925 6.23177872,8.3598156 L11.2317787,2.3598156 C11.6315738,1.88006147 12.3684262,1.88006147 12.7682213,2.3598156 L17.7682213,8.3598156 C18.1217854,8.7840925 18.0644613,9.4146572 17.6401844,9.76822128 C17.2159075,10.1217854 16.5853428,10.0644613 16.2317787,9.6401844 L12,4.56204994 Z" class="svg" fill-rule="nonzero" opacity="0.3"></path><path d="M3.28077641,9 L20.7192236,9 C21.2715083,9 21.7192236,9.44771525 21.7192236,10 C21.7192236,10.0817618 21.7091962,10.163215 21.6893661,10.2425356 L19.5680983,18.7276069 C19.234223,20.0631079 18.0342737,21 16.6576708,21 L7.34232922,21 C5.96572629,21 4.76577697,20.0631079 4.43190172,18.7276069 L2.31063391,10.2425356 C2.17668518,9.70674072 2.50244587,9.16380623 3.03824078,9.0298575 C3.11756139,9.01002735 3.1990146,9 3.28077641,9 Z M12,12 C11.4477153,12 11,12.4477153 11,13 L11,17 C11,17.5522847 11.4477153,18 12,18 C12.5522847,18 13,17.5522847 13,17 L13,13 C13,12.4477153 12.5522847,12 12,12 Z M6.96472382,12.1362967 C6.43125772,12.2792385 6.11467523,12.8275755 6.25761704,13.3610416 L7.29289322,17.2247449 C7.43583503,17.758211 7.98417199,18.0747935 8.51763809,17.9318517 C9.05110419,17.7889098 9.36768668,17.2405729 9.22474487,16.7071068 L8.18946869,12.8434035 C8.04652688,12.3099374 7.49818992,11.9933549 6.96472382,12.1362967 Z M17.0352762,12.1362967 C16.5018101,11.9933549 15.9534731,12.3099374 15.8105313,12.8434035 L14.7752551,16.7071068 C14.6323133,17.2405729 14.9488958,17.7889098 15.4823619,17.9318517 C16.015828,18.0747935 16.564165,17.758211 16.7071068,17.2247449 L17.742383,13.3610416 C17.8853248,12.8275755 17.5687423,12.2792385 17.0352762,12.1362967 Z" class="svg"></path></g></svg></span></span>'; }
                        }
                    ?>
                </div>
                <span class="flex flex-row flex-align-c gap-05 small-med text-primary"><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="14.4px" height="14.4px" viewBox="0 0 24 24" version="1.1"><g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"><mask fill="white"><use xlink:href="#path-1"/></mask><g/><path d="M7,10 L7,8 C7,5.23857625 9.23857625,3 12,3 C14.7614237,3 17,5.23857625 17,8 L17,10 L18,10 C19.1045695,10 20,10.8954305 20,12 L20,18 C20,19.1045695 19.1045695,20 18,20 L6,20 C4.8954305,20 4,19.1045695 4,18 L4,12 C4,10.8954305 4.8954305,10 6,10 L7,10 Z M12,5 C10.3431458,5 9,6.34314575 9,8 L9,10 L15,10 L15,8 C15,6.34314575 13.6568542,5 12,5 Z" class="svg"/></g></svg><span class="flex">Biztonságos tranzakció</span></span>
            </div>
            <div class="flex flex-col gap-05">
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
        <div class="card border-soft box-shadow">
            <div class="flex flex-col">
                <h3 class="text-primary margin-none">Visszatérési lehetőség</h3>
                <div>
                    <?php
                        if (!$product['refund']) {echo '<span class="text-secondary small-med">Ez a termék nem jogosult visszatérítésre. További információért tekintse meg <a class="text-primary underline pointer">termékvisszaküldési szabályzatunkat</a>.</span>';}
                        else {echo '<span class="text-secondary small-med">Ez a termék 30 napon belüli visszatérítésre vagy cserére jogosult nyugta ellenében. A termék visszatérítését <a class="text-primary underline pointer" id="pr__pan">itt kérheti</a>.</span>';}
                    ?>
                </div>
            </div>
        </div>
        <div class="card border-soft box-shadow">
            <div class="flex flex-col gap-05">
                <h3 class="text-primary margin-none">Tetszik a termék?</h3>
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
    </div>
    <div class="spancolumn w-75d-100m">
        <div class="flex flex-row flex-align-c padding-1 padding-b-0">
            <span class="text-muted small-med"><a class="link link-color pointer" href="/browse">Webáruház</a> / <a class="link link-color pointer" href="/search/<?= $product['category'] ?>"><?= $product['category'] ?></a> / <a class="text-muted"><?php echo $product['name']; ?></a></span>
        </div>
        <div class="flex flex-row flex-align-c gap-2 padding-1 text-muted user-select-none">
            <span onclick="showPanel(event, 'tab-overview')" id="tabs-overview" tab-data="overview" class="pr__item padding-b-1 pointer">Általános</span>
            <span onclick="showPanel(event, 'tab-reviews')" id="tabs-reviews" tab-data="reviews" class="pr__item padding-b-1 pointer">Vélemények</span>
            <span onclick="showPanel(event, 'tab-similar')" id="tabs-similar" tab-data="similar" class="pr__item padding-b-1 pointer">Hasonló termékek</span>
        </div>
        <div id="tab-overview" class="tab__content flex flex-col card gap-1" style="background-color: transparent !important;">
            <div class="flex flex-col flex-align-c flex-justify-con-c w-fa text-muted">
                <svg class='wizard_input_loading' xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="128px" height="128px" viewBox="0 0 24 24" version="1.1"><g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"><g><polygon points="0 0 24 0 24 24 0 24"/></g><path d="M12,4 L12,6 C8.6862915,6 6,8.6862915 6,12 C6,15.3137085 8.6862915,18 12,18 C15.3137085,18 18,15.3137085 18,12 C18,10.9603196 17.7360885,9.96126435 17.2402578,9.07513926 L18.9856052,8.09853149 C19.6473536,9.28117708 20,10.6161442 20,12 C20,16.418278 16.418278,20 12,20 C7.581722,20 4,16.418278 4,12 C4,7.581722 7.581722,4 12,4 Z" fill="currentColor" fill-rule="nonzero" opacity="0.4" transform="translate(12.000000, 12.000000) scale(-1, 1) translate(-12.000000, -12.000000) "/></g></svg>
                <span>Betöltés folyamatban...</span>
            </div>
        </div>
        <div id="tab-reviews" class="tab__content flex-col card gap-1" style="background: transparent; padding: 0;"></div>
        <div id="tab-similar" class="tab__content flex-col card gap-1" style="background: transparent; padding: 0;"></div>
    </div>
</div>
</main>
<?php $pid = $params['id']; $gmsql = "SELECT model FROM products__variations WHERE pid = $pid"; $gmres = $con->query($gmsql); $gmdt = $gmres->fetch_assoc(); $model = $gmdt['model']; ?>
<script src="/assets/script/webshop/item.js" content-type="application/javascript"></script>
<script>
    var miniature = document.getElementsByClassName('product-miniature');
    for (let i = 0 ; i < miniature.length; i++) {
        miniature[i].style.backgroundImage = 'url("'+miniature[i].getAttribute('data-image')+'")';
        miniature[i].addEventListener('mouseenter', () => {
            document.getElementById('product-thumbnail').src = miniature[i].getAttribute('data-image');
            if (document.getElementById('product-thumbnail').src.split(".")[1] == "png") { document.getElementById('product-thumbnail').classList.add('drop-shadow'); }
            else { document.getElementById('product-thumbnail').classList.remove('drop-shadow'); }
        });
    }
    if (document.getElementById('product-thumbnail').src.split(".")[1] == "png") { document.getElementById('product-thumbnail').classList.add('drop-shadow'); } else { document.getElementById('product-thumbnail').classList.remove('drop-shadow'); }
    var urlpid = <?= $params['id']; ?>; var urlmodel = '<?= $model ?>';
</script>
<script>var bal__to__form = document.getElementsByClassName('money__form'); for (let i = 0; i < bal__to__form.length; i++) { bal__to__form[i].textContent = formatter.format(bal__to__form[i].getAttribute('default-data')); }</script>
<script>
    function __ch (pid) { 
        // let sq = document.getElementById('product-quantity').value > 0 ? Number(document.getElementById('product-quantity').value) : 1;
        // console.log("/webshop/checkout/"+pid + "/?q="+sq);
        window.location.href = "/webshop/checkout/"+pid;
    }
    var product_card = document.getElementsByClassName('product-link');
    for (let i = 0; i < product_card.length; i++) {product_card[i].addEventListener("click", function () { window.location.href = "/webshop/?id=" + product_card[i].getAttribute('auid')+"&method=52"; /* A termek az ajanlasokbol szekciobol lett megnyitva */});}
    var product_bookmark = document.getElementsByClassName('product__bm__trig'); var svg_size; var form_data = new FormData();
    for (let i = 0; i < product_bookmark.length; i++) {
        product_bookmark[i].addEventListener('click', function (e) {
            svg_size = product_bookmark[i].getElementsByTagName('svg')[0].getAttribute('width');
            form_data.append("id", <?= $params['id']; ?>); form_data.append("action", product_bookmark[i].getAttribute('action'));
            $.ajax({ enctype: "multipart/form-data", type: "POST", url: "/includes/webshop/bookmark.php", data: form_data, dataType: 'json', contentType: false, processData: false,
                success: function(data) { var respCode = String(data).slice(0, 3); var respId = <?= $params['id']; ?>; // A responsebol kapott erteket szet daraboljuk, hogy a kapott ertekeket valtozokba mentsuk a tovabbi hasznalathoz
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
                }, error: function (data) { console.log(data); notificationSystem(0, 1, 0, "Hiba", "Sikertelen művelet!");}
            });
        });
    }
    <?php
    if (isset($uid)) {
        echo '
        // var cart_button = document.getElementById("add-to-cart"); 
        // if (cart_button) {
        //     var cart_data = new FormData(); cart_data.append("pid", '; echo $product['id']; echo'); cart_data.append("event", cart_button.getAttribute("key-event"));
        //     cart_button.addEventListener("click", function () {
        //         $.ajax({
        //             enctype: "multipart/form-data", type: "POST", url: "/includes/webshop/cart.php", data: cart_data, dataType: "json", contentType: false, processData: false,
        //             success: function(data) {
        //                 var respCode = String(data).slice(0, 3); var respId = String(data).slice(3, 5); // A responsebol kapott erteket szet daraboljuk, hogy a kapott ertekeket valtozokba mentsuk a tovabbi hasznalathoz
        //                 if (Number(respCode) === 410) {  // A statusz kod 410 (Sikeres torles) 
        //                     cart_button.setAttribute("key-event", "0");
        //                     if (Number(document.getElementById("bspc__ind").textContent) === 1) { document.getElementById("bspc__ind").remove(); } 
        //                     else { document.getElementById("bspc__ind").textContent = Number(Number(document.getElementById("bspc__ind").textContent) - 1); }
        //                     cart_button.innerHTML = `<span>Kosárba</span><span class="flex"><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="19.2px" height="19.2px" viewBox="0 0 24 24" version="1.1"><g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"><rect x="0" y="0" width="24" height="24"></rect><path d="M12,4.56204994 L7.76822128,9.6401844 C7.4146572,10.0644613 6.7840925,10.1217854 6.3598156,9.76822128 C5.9355387,9.4146572 5.87821464,8.7840925 6.23177872,8.3598156 L11.2317787,2.3598156 C11.6315738,1.88006147 12.3684262,1.88006147 12.7682213,2.3598156 L17.7682213,8.3598156 C18.1217854,8.7840925 18.0644613,9.4146572 17.6401844,9.76822128 C17.2159075,10.1217854 16.5853428,10.0644613 16.2317787,9.6401844 L12,4.56204994 Z" class="svg" fill-rule="nonzero" opacity="0.3"></path><path d="M3.28077641,9 L20.7192236,9 C21.2715083,9 21.7192236,9.44771525 21.7192236,10 C21.7192236,10.0817618 21.7091962,10.163215 21.6893661,10.2425356 L19.5680983,18.7276069 C19.234223,20.0631079 18.0342737,21 16.6576708,21 L7.34232922,21 C5.96572629,21 4.76577697,20.0631079 4.43190172,18.7276069 L2.31063391,10.2425356 C2.17668518,9.70674072 2.50244587,9.16380623 3.03824078,9.0298575 C3.11756139,9.01002735 3.1990146,9 3.28077641,9 Z M12,12 C11.4477153,12 11,12.4477153 11,13 L11,17 C11,17.5522847 11.4477153,18 12,18 C12.5522847,18 13,17.5522847 13,17 L13,13 C13,12.4477153 12.5522847,12 12,12 Z M6.96472382,12.1362967 C6.43125772,12.2792385 6.11467523,12.8275755 6.25761704,13.3610416 L7.29289322,17.2247449 C7.43583503,17.758211 7.98417199,18.0747935 8.51763809,17.9318517 C9.05110419,17.7889098 9.36768668,17.2405729 9.22474487,16.7071068 L8.18946869,12.8434035 C8.04652688,12.3099374 7.49818992,11.9933549 6.96472382,12.1362967 Z M17.0352762,12.1362967 C16.5018101,11.9933549 15.9534731,12.3099374 15.8105313,12.8434035 L14.7752551,16.7071068 C14.6323133,17.2405729 14.9488958,17.7889098 15.4823619,17.9318517 C16.015828,18.0747935 16.564165,17.758211 16.7071068,17.2247449 L17.742383,13.3610416 C17.8853248,12.8275755 17.5687423,12.2792385 17.0352762,12.1362967 Z" class="svg"></path></g></svg></span>`;
        //                 } if (Number(respCode) === 200) { cart_button.setAttribute("key-event", "1");
        //                     var badge = document.getElementById("bspc__ind");
        //                     if (badge) { document.getElementById("bspc__ind").textContent = Number(Number(document.getElementById("bspc__ind").textContent) + 1); }
        //                     else { var crbdspc__ind = document.createElement("div"); crbdspc__ind.id = "bspc__ind"; crbdspc__ind.classList = "badge badge-basket bold sidenav-badge label-danger flex flex-align-c flex-justify-con-c absolute"; document.getElementById("deskBask").prepend(crbdspc__ind); crbdspc__ind.textContent = 1; }
        //                     cart_button.innerHTML = `<span>Kosárban</span><span class="flex"><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="19.2px" height="19.2px" viewBox="0 0 24 24" version="1.1"><g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"><rect x="0" y="0" width="24" height="24"></rect><path d="M12,4.56204994 L7.76822128,9.6401844 C7.4146572,10.0644613 6.7840925,10.1217854 6.3598156,9.76822128 C5.9355387,9.4146572 5.87821464,8.7840925 6.23177872,8.3598156 L11.2317787,2.3598156 C11.6315738,1.88006147 12.3684262,1.88006147 12.7682213,2.3598156 L17.7682213,8.3598156 C18.1217854,8.7840925 18.0644613,9.4146572 17.6401844,9.76822128 C17.2159075,10.1217854 16.5853428,10.0644613 16.2317787,9.6401844 L12,4.56204994 Z" class="svg" fill-rule="nonzero" opacity="0.3"></path><path d="M3.28077641,9 L20.7192236,9 C21.2715083,9 21.7192236,9.44771525 21.7192236,10 C21.7192236,10.0817618 21.7091962,10.163215 21.6893661,10.2425356 L19.5680983,18.7276069 C19.234223,20.0631079 18.0342737,21 16.6576708,21 L7.34232922,21 C5.96572629,21 4.76577697,20.0631079 4.43190172,18.7276069 L2.31063391,10.2425356 C2.17668518,9.70674072 2.50244587,9.16380623 3.03824078,9.0298575 C3.11756139,9.01002735 3.1990146,9 3.28077641,9 Z M12,12 C11.4477153,12 11,12.4477153 11,13 L11,17 C11,17.5522847 11.4477153,18 12,18 C12.5522847,18 13,17.5522847 13,17 L13,13 C13,12.4477153 12.5522847,12 12,12 Z M6.96472382,12.1362967 C6.43125772,12.2792385 6.11467523,12.8275755 6.25761704,13.3610416 L7.29289322,17.2247449 C7.43583503,17.758211 7.98417199,18.0747935 8.51763809,17.9318517 C9.05110419,17.7889098 9.36768668,17.2405729 9.22474487,16.7071068 L8.18946869,12.8434035 C8.04652688,12.3099374 7.49818992,11.9933549 6.96472382,12.1362967 Z M17.0352762,12.1362967 C16.5018101,11.9933549 15.9534731,12.3099374 15.8105313,12.8434035 L14.7752551,16.7071068 C14.6323133,17.2405729 14.9488958,17.7889098 15.4823619,17.9318517 C16.015828,18.0747935 16.564165,17.758211 16.7071068,17.2247449 L17.742383,13.3610416 C17.8853248,12.8275755 17.5687423,12.2792385 17.0352762,12.1362967 Z" class="svg"></path></g></svg></span>`;
        //                 }
        //             }, error: function (data) {console.log(data);notificationSystem(0, 1, 0, "Hiba", "Sikertelen művelet!");}
        //         });
        //     });
        // }
        ';
    }
    ?>
</script>
<script>
    $('#add-to-cart').click(() => {
        $.ajax({url: "https://api.ipdata.co?api-key=739837e232548988c86b954108794b57bd3e1dbcd6eb550bfa53e544", dataType: 'json',
            beforeSend: function() {
                document.getElementById("add-to-cart").innerHTML = `
                    <span>Kosárba</span>
                    <svg class='wizard_input_loading' xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="19.2px" height="19.2px" viewBox="0 0 24 24" version="1.1"><g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"><g><polygon points="0 0 24 0 24 24 0 24"/></g><path d="M12,4 L12,6 C8.6862915,6 6,8.6862915 6,12 C6,15.3137085 8.6862915,18 12,18 C15.3137085,18 18,15.3137085 18,12 C18,10.9603196 17.7360885,9.96126435 17.2402578,9.07513926 L18.9856052,8.09853149 C19.6473536,9.28117708 20,10.6161442 20,12 C20,16.418278 16.418278,20 12,20 C7.581722,20 4,16.418278 4,12 C4,7.581722 7.581722,4 12,4 Z" class="svg" fill-rule="nonzero" opacity="0.4" transform="translate(12.000000, 12.000000) scale(-1, 1) translate(-12.000000, -12.000000) "/></g></svg>
                `;
            }, success : function (api) {
                var cartData = new FormData(); 
                const cartObject = {
                    uid : <?= isset($_SESSION['id']) ? $_SESSION['id'] : 'false'; ?>,
                    pid : <?= $params['id']; ?>,
                    ip  : api.ip,
                    action : document.getElementById('add-to-cart').getAttribute('key-event') == 'add' ? 'add' : 'delete'
                };
                cartData.append('cart', JSON.stringify(cartObject));
                const ajaxObject = { 
                    url : '/assets/php/classes/class.Cart.php',
                    data : cartData,
                    loaderContainer : {
                        isset : true,
                        id : 'add-to-cart',
                        type : 'button',
                        iconSize : {
                            iconWidth : '19.2',
                            iconHeight : '19.2'
                        },
                        loaderText : {
                            custom : true,
                            customText : 'Kosárba'
                        }
                    }
                }
                
                let response = getFromAjaxRequest(ajaxObject)
                .then((data) => {
                    if (data.status == 'success') {
                        if (document.getElementById('add-to-cart').getAttribute('key-event') == 'add') {
                            document.getElementById("add-to-cart").innerHTML = `
                                <span>Kosárban</span>
                                <svg width="19.2px" height="19.2px" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><rect opacity="0.3" x="2" y="2" width="20" height="20" rx="10" fill="currentColor"/><path d="M10.4343 12.4343L8.75 10.75C8.33579 10.3358 7.66421 10.3358 7.25 10.75C6.83579 11.1642 6.83579 11.8358 7.25 12.25L10.2929 15.2929C10.6834 15.6834 11.3166 15.6834 11.7071 15.2929L17.25 9.75C17.6642 9.33579 17.6642 8.66421 17.25 8.25C16.8358 7.83579 16.1642 7.83579 15.75 8.25L11.5657 12.4343C11.2533 12.7467 10.7467 12.7467 10.4343 12.4343Z" fill="currentColor"/></svg>
                            `;
                            document.getElementById('add-to-cart').setAttribute('key-event', 'delete');
                        } else {
                            document.getElementById('add-to-cart').setAttribute('key-event', 'add');
                            document.getElementById("add-to-cart").innerHTML = `
                                <span>Kosárba</span>
                                <svg width="19.2px" height="19.2px" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><rect opacity="0.3" x="2" y="2" width="20" height="20" rx="10" fill="currentColor"/><path d="M10.4343 12.4343L8.75 10.75C8.33579 10.3358 7.66421 10.3358 7.25 10.75C6.83579 11.1642 6.83579 11.8358 7.25 12.25L10.2929 15.2929C10.6834 15.6834 11.3166 15.6834 11.7071 15.2929L17.25 9.75C17.6642 9.33579 17.6642 8.66421 17.25 8.25C16.8358 7.83579 16.1642 7.83579 15.75 8.25L11.5657 12.4343C11.2533 12.7467 10.7467 12.7467 10.4343 12.4343Z" fill="currentColor"/></svg>
                            `;
                        }
                        cartObject.action = "count";
                        cartData.append('cart', JSON.stringify(cartObject));
                        ajaxObject.loaderContainer.isset = false;
                        let response = getFromAjaxRequest(ajaxObject)
                        .then((data) => {
                            if (data.status == 'success') {
                                document.getElementById("bspc__ind").innerHTML = data.count;
                            }
                        });
                    } else {
                        document.getElementById("add-to-cart").innerHTML = `
                            <span>Hiba történt</span>
                            <svg width="19.2px" height="19.2px" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><rect opacity="0.3" x="2" y="2" width="20" height="20" rx="10" fill="currentColor"/><rect x="11" y="14" width="7" height="2" rx="1" transform="rotate(-90 11 14)" fill="currentColor"/><rect x="11" y="17" width="2" height="2" rx="1" transform="rotate(-90 11 17)" fill="currentColor"/></svg>
                        `;
                    }
                })
                .catch((reason) => {
                    document.getElementById("add-to-cart").innerHTML = `
                        <span>Hiba történt</span>
                        <svg width="19.2px" height="19.2px" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><rect opacity="0.3" x="2" y="2" width="20" height="20" rx="10" fill="currentColor"/><rect x="11" y="14" width="7" height="2" rx="1" transform="rotate(-90 11 14)" fill="currentColor"/><rect x="11" y="17" width="2" height="2" rx="1" transform="rotate(-90 11 17)" fill="currentColor"/></svg>
                    `;
                });
            }, error : function () {
                document.getElementById("add-to-cart").innerHTML = `
                    <span>Hiba történt</span>
                    <svg width="19.2px" height="19.2px" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><rect opacity="0.3" x="2" y="2" width="20" height="20" rx="10" fill="currentColor"/><rect x="11" y="14" width="7" height="2" rx="1" transform="rotate(-90 11 14)" fill="currentColor"/><rect x="11" y="17" width="2" height="2" rx="1" transform="rotate(-90 11 17)" fill="currentColor"/></svg>
                `;
            }
        });
    });
</script>
<script>var Latinise={};Latinise.latin_map={"Á":"A","Ă":"A","Ắ":"A","Ặ":"A","Ằ":"A","Ẳ":"A","Ẵ":"A","Ǎ":"A","Â":"A","Ấ":"A","Ậ":"A","Ầ":"A","Ẩ":"A","Ẫ":"A","Ä":"A","Ǟ":"A","Ȧ":"A","Ǡ":"A","Ạ":"A","Ȁ":"A","À":"A","Ả":"A","Ȃ":"A","Ā":"A","Ą":"A","Å":"A","Ǻ":"A","Ḁ":"A","Ⱥ":"A","Ã":"A","Ꜳ":"AA","Æ":"AE","Ǽ":"AE","Ǣ":"AE","Ꜵ":"AO","Ꜷ":"AU","Ꜹ":"AV","Ꜻ":"AV","Ꜽ":"AY","Ḃ":"B","Ḅ":"B","Ɓ":"B","Ḇ":"B","Ƀ":"B","Ƃ":"B","Ć":"C","Č":"C","Ç":"C","Ḉ":"C","Ĉ":"C","Ċ":"C","Ƈ":"C","Ȼ":"C","Ď":"D","Ḑ":"D","Ḓ":"D","Ḋ":"D","Ḍ":"D","Ɗ":"D","Ḏ":"D","ǲ":"D","ǅ":"D","Đ":"D","Ƌ":"D","Ǳ":"DZ","Ǆ":"DZ","É":"E","Ĕ":"E","Ě":"E","Ȩ":"E","Ḝ":"E","Ê":"E","Ế":"E","Ệ":"E","Ề":"E","Ể":"E","Ễ":"E","Ḙ":"E","Ë":"E","Ė":"E","Ẹ":"E","Ȅ":"E","È":"E","Ẻ":"E","Ȇ":"E","Ē":"E","Ḗ":"E","Ḕ":"E","Ę":"E","Ɇ":"E","Ẽ":"E","Ḛ":"E","Ꝫ":"ET","Ḟ":"F","Ƒ":"F","Ǵ":"G","Ğ":"G","Ǧ":"G","Ģ":"G","Ĝ":"G","Ġ":"G","Ɠ":"G","Ḡ":"G","Ǥ":"G","Ḫ":"H","Ȟ":"H","Ḩ":"H","Ĥ":"H","Ⱨ":"H","Ḧ":"H","Ḣ":"H","Ḥ":"H","Ħ":"H","Í":"I","Ĭ":"I","Ǐ":"I","Î":"I","Ï":"I","Ḯ":"I","İ":"I","Ị":"I","Ȉ":"I","Ì":"I","Ỉ":"I","Ȋ":"I","Ī":"I","Į":"I","Ɨ":"I","Ĩ":"I","Ḭ":"I","Ꝺ":"D","Ꝼ":"F","Ᵹ":"G","Ꞃ":"R","Ꞅ":"S","Ꞇ":"T","Ꝭ":"IS","Ĵ":"J","Ɉ":"J","Ḱ":"K","Ǩ":"K","Ķ":"K","Ⱪ":"K","Ꝃ":"K","Ḳ":"K","Ƙ":"K","Ḵ":"K","Ꝁ":"K","Ꝅ":"K","Ĺ":"L","Ƚ":"L","Ľ":"L","Ļ":"L","Ḽ":"L","Ḷ":"L","Ḹ":"L","Ⱡ":"L","Ꝉ":"L","Ḻ":"L","Ŀ":"L","Ɫ":"L","ǈ":"L","Ł":"L","Ǉ":"LJ","Ḿ":"M","Ṁ":"M","Ṃ":"M","Ɱ":"M","Ń":"N","Ň":"N","Ņ":"N","Ṋ":"N","Ṅ":"N","Ṇ":"N","Ǹ":"N","Ɲ":"N","Ṉ":"N","Ƞ":"N","ǋ":"N","Ñ":"N","Ǌ":"NJ","Ó":"O","Ŏ":"O","Ǒ":"O","Ô":"O","Ố":"O","Ộ":"O","Ồ":"O","Ổ":"O","Ỗ":"O","Ö":"O","Ȫ":"O","Ȯ":"O","Ȱ":"O","Ọ":"O","Ő":"O","Ȍ":"O","Ò":"O","Ỏ":"O","Ơ":"O","Ớ":"O","Ợ":"O","Ờ":"O","Ở":"O","Ỡ":"O","Ȏ":"O","Ꝋ":"O","Ꝍ":"O","Ō":"O","Ṓ":"O","Ṑ":"O","Ɵ":"O","Ǫ":"O","Ǭ":"O","Ø":"O","Ǿ":"O","Õ":"O","Ṍ":"O","Ṏ":"O","Ȭ":"O","Ƣ":"OI","Ꝏ":"OO","Ɛ":"E","Ɔ":"O","Ȣ":"OU","Ṕ":"P","Ṗ":"P","Ꝓ":"P","Ƥ":"P","Ꝕ":"P","Ᵽ":"P","Ꝑ":"P","Ꝙ":"Q","Ꝗ":"Q","Ŕ":"R","Ř":"R","Ŗ":"R","Ṙ":"R","Ṛ":"R","Ṝ":"R","Ȑ":"R","Ȓ":"R","Ṟ":"R","Ɍ":"R","Ɽ":"R","Ꜿ":"C","Ǝ":"E","Ś":"S","Ṥ":"S","Š":"S","Ṧ":"S","Ş":"S","Ŝ":"S","Ș":"S","Ṡ":"S","Ṣ":"S","Ṩ":"S","Ť":"T","Ţ":"T","Ṱ":"T","Ț":"T","Ⱦ":"T","Ṫ":"T","Ṭ":"T","Ƭ":"T","Ṯ":"T","Ʈ":"T","Ŧ":"T","Ɐ":"A","Ꞁ":"L","Ɯ":"M","Ʌ":"V","Ꜩ":"TZ","Ú":"U","Ŭ":"U","Ǔ":"U","Û":"U","Ṷ":"U","Ü":"U","Ǘ":"U","Ǚ":"U","Ǜ":"U","Ǖ":"U","Ṳ":"U","Ụ":"U","Ű":"U","Ȕ":"U","Ù":"U","Ủ":"U","Ư":"U","Ứ":"U","Ự":"U","Ừ":"U","Ử":"U","Ữ":"U","Ȗ":"U","Ū":"U","Ṻ":"U","Ų":"U","Ů":"U","Ũ":"U","Ṹ":"U","Ṵ":"U","Ꝟ":"V","Ṿ":"V","Ʋ":"V","Ṽ":"V","Ꝡ":"VY","Ẃ":"W","Ŵ":"W","Ẅ":"W","Ẇ":"W","Ẉ":"W","Ẁ":"W","Ⱳ":"W","Ẍ":"X","Ẋ":"X","Ý":"Y","Ŷ":"Y","Ÿ":"Y","Ẏ":"Y","Ỵ":"Y","Ỳ":"Y","Ƴ":"Y","Ỷ":"Y","Ỿ":"Y","Ȳ":"Y","Ɏ":"Y","Ỹ":"Y","Ź":"Z","Ž":"Z","Ẑ":"Z","Ⱬ":"Z","Ż":"Z","Ẓ":"Z","Ȥ":"Z","Ẕ":"Z","Ƶ":"Z","Ĳ":"IJ","Œ":"OE","ᴀ":"A","ᴁ":"AE","ʙ":"B","ᴃ":"B","ᴄ":"C","ᴅ":"D","ᴇ":"E","ꜰ":"F","ɢ":"G","ʛ":"G","ʜ":"H","ɪ":"I","ʁ":"R","ᴊ":"J","ᴋ":"K","ʟ":"L","ᴌ":"L","ᴍ":"M","ɴ":"N","ᴏ":"O","ɶ":"OE","ᴐ":"O","ᴕ":"OU","ᴘ":"P","ʀ":"R","ᴎ":"N","ᴙ":"R","ꜱ":"S","ᴛ":"T","ⱻ":"E","ᴚ":"R","ᴜ":"U","ᴠ":"V","ᴡ":"W","ʏ":"Y","ᴢ":"Z","á":"a","ă":"a","ắ":"a","ặ":"a","ằ":"a","ẳ":"a","ẵ":"a","ǎ":"a","â":"a","ấ":"a","ậ":"a","ầ":"a","ẩ":"a","ẫ":"a","ä":"a","ǟ":"a","ȧ":"a","ǡ":"a","ạ":"a","ȁ":"a","à":"a","ả":"a","ȃ":"a","ā":"a","ą":"a","ᶏ":"a","ẚ":"a","å":"a","ǻ":"a","ḁ":"a","ⱥ":"a","ã":"a","ꜳ":"aa","æ":"ae","ǽ":"ae","ǣ":"ae","ꜵ":"ao","ꜷ":"au","ꜹ":"av","ꜻ":"av","ꜽ":"ay","ḃ":"b","ḅ":"b","ɓ":"b","ḇ":"b","ᵬ":"b","ᶀ":"b","ƀ":"b","ƃ":"b","ɵ":"o","ć":"c","č":"c","ç":"c","ḉ":"c","ĉ":"c","ɕ":"c","ċ":"c","ƈ":"c","ȼ":"c","ď":"d","ḑ":"d","ḓ":"d","ȡ":"d","ḋ":"d","ḍ":"d","ɗ":"d","ᶑ":"d","ḏ":"d","ᵭ":"d","ᶁ":"d","đ":"d","ɖ":"d","ƌ":"d","ı":"i","ȷ":"j","ɟ":"j","ʄ":"j","ǳ":"dz","ǆ":"dz","é":"e","ĕ":"e","ě":"e","ȩ":"e","ḝ":"e","ê":"e","ế":"e","ệ":"e","ề":"e","ể":"e","ễ":"e","ḙ":"e","ë":"e","ė":"e","ẹ":"e","ȅ":"e","è":"e","ẻ":"e","ȇ":"e","ē":"e","ḗ":"e","ḕ":"e","ⱸ":"e","ę":"e","ᶒ":"e","ɇ":"e","ẽ":"e","ḛ":"e","ꝫ":"et","ḟ":"f","ƒ":"f","ᵮ":"f","ᶂ":"f","ǵ":"g","ğ":"g","ǧ":"g","ģ":"g","ĝ":"g","ġ":"g","ɠ":"g","ḡ":"g","ᶃ":"g","ǥ":"g","ḫ":"h","ȟ":"h","ḩ":"h","ĥ":"h","ⱨ":"h","ḧ":"h","ḣ":"h","ḥ":"h","ɦ":"h","ẖ":"h","ħ":"h","ƕ":"hv","í":"i","ĭ":"i","ǐ":"i","î":"i","ï":"i","ḯ":"i","ị":"i","ȉ":"i","ì":"i","ỉ":"i","ȋ":"i","ī":"i","į":"i","ᶖ":"i","ɨ":"i","ĩ":"i","ḭ":"i","ꝺ":"d","ꝼ":"f","ᵹ":"g","ꞃ":"r","ꞅ":"s","ꞇ":"t","ꝭ":"is","ǰ":"j","ĵ":"j","ʝ":"j","ɉ":"j","ḱ":"k","ǩ":"k","ķ":"k","ⱪ":"k","ꝃ":"k","ḳ":"k","ƙ":"k","ḵ":"k","ᶄ":"k","ꝁ":"k","ꝅ":"k","ĺ":"l","ƚ":"l","ɬ":"l","ľ":"l","ļ":"l","ḽ":"l","ȴ":"l","ḷ":"l","ḹ":"l","ⱡ":"l","ꝉ":"l","ḻ":"l","ŀ":"l","ɫ":"l","ᶅ":"l","ɭ":"l","ł":"l","ǉ":"lj","ſ":"s","ẜ":"s","ẛ":"s","ẝ":"s","ḿ":"m","ṁ":"m","ṃ":"m","ɱ":"m","ᵯ":"m","ᶆ":"m","ń":"n","ň":"n","ņ":"n","ṋ":"n","ȵ":"n","ṅ":"n","ṇ":"n","ǹ":"n","ɲ":"n","ṉ":"n","ƞ":"n","ᵰ":"n","ᶇ":"n","ɳ":"n","ñ":"n","ǌ":"nj","ó":"o","ŏ":"o","ǒ":"o","ô":"o","ố":"o","ộ":"o","ồ":"o","ổ":"o","ỗ":"o","ö":"o","ȫ":"o","ȯ":"o","ȱ":"o","ọ":"o","ő":"o","ȍ":"o","ò":"o","ỏ":"o","ơ":"o","ớ":"o","ợ":"o","ờ":"o","ở":"o","ỡ":"o","ȏ":"o","ꝋ":"o","ꝍ":"o","ⱺ":"o","ō":"o","ṓ":"o","ṑ":"o","ǫ":"o","ǭ":"o","ø":"o","ǿ":"o","õ":"o","ṍ":"o","ṏ":"o","ȭ":"o","ƣ":"oi","ꝏ":"oo","ɛ":"e","ᶓ":"e","ɔ":"o","ᶗ":"o","ȣ":"ou","ṕ":"p","ṗ":"p","ꝓ":"p","ƥ":"p","ᵱ":"p","ᶈ":"p","ꝕ":"p","ᵽ":"p","ꝑ":"p","ꝙ":"q","ʠ":"q","ɋ":"q","ꝗ":"q","ŕ":"r","ř":"r","ŗ":"r","ṙ":"r","ṛ":"r","ṝ":"r","ȑ":"r","ɾ":"r","ᵳ":"r","ȓ":"r","ṟ":"r","ɼ":"r","ᵲ":"r","ᶉ":"r","ɍ":"r","ɽ":"r","ↄ":"c","ꜿ":"c","ɘ":"e","ɿ":"r","ś":"s","ṥ":"s","š":"s","ṧ":"s","ş":"s","ŝ":"s","ș":"s","ṡ":"s","ṣ":"s","ṩ":"s","ʂ":"s","ᵴ":"s","ᶊ":"s","ȿ":"s","ɡ":"g","ᴑ":"o","ᴓ":"o","ᴝ":"u","ť":"t","ţ":"t","ṱ":"t","ț":"t","ȶ":"t","ẗ":"t","ⱦ":"t","ṫ":"t","ṭ":"t","ƭ":"t","ṯ":"t","ᵵ":"t","ƫ":"t","ʈ":"t","ŧ":"t","ᵺ":"th","ɐ":"a","ᴂ":"ae","ǝ":"e","ᵷ":"g","ɥ":"h","ʮ":"h","ʯ":"h","ᴉ":"i","ʞ":"k","ꞁ":"l","ɯ":"m","ɰ":"m","ᴔ":"oe","ɹ":"r","ɻ":"r","ɺ":"r","ⱹ":"r","ʇ":"t","ʌ":"v","ʍ":"w","ʎ":"y","ꜩ":"tz","ú":"u","ŭ":"u","ǔ":"u","û":"u","ṷ":"u","ü":"u","ǘ":"u","ǚ":"u","ǜ":"u","ǖ":"u","ṳ":"u","ụ":"u","ű":"u","ȕ":"u","ù":"u","ủ":"u","ư":"u","ứ":"u","ự":"u","ừ":"u","ử":"u","ữ":"u","ȗ":"u","ū":"u","ṻ":"u","ų":"u","ᶙ":"u","ů":"u","ũ":"u","ṹ":"u","ṵ":"u","ᵫ":"ue","ꝸ":"um","ⱴ":"v","ꝟ":"v","ṿ":"v","ʋ":"v","ᶌ":"v","ⱱ":"v","ṽ":"v","ꝡ":"vy","ẃ":"w","ŵ":"w","ẅ":"w","ẇ":"w","ẉ":"w","ẁ":"w","ⱳ":"w","ẘ":"w","ẍ":"x","ẋ":"x","ᶍ":"x","ý":"y","ŷ":"y","ÿ":"y","ẏ":"y","ỵ":"y","ỳ":"y","ƴ":"y","ỷ":"y","ỿ":"y","ȳ":"y","ẙ":"y","ɏ":"y","ỹ":"y","ź":"z","ž":"z","ẑ":"z","ʑ":"z","ⱬ":"z","ż":"z","ẓ":"z","ȥ":"z","ẕ":"z","ᵶ":"z","ᶎ":"z","ʐ":"z","ƶ":"z","ɀ":"z","ﬀ":"ff","ﬃ":"ffi","ﬄ":"ffl","ﬁ":"fi","ﬂ":"fl","ĳ":"ij","œ":"oe","ﬆ":"st","ₐ":"a","ₑ":"e","ᵢ":"i","ⱼ":"j","ₒ":"o","ᵣ":"r","ᵤ":"u","ᵥ":"v","ₓ":"x"};
String.prototype.latinise=function(){return this.replace(/[^A-Za-z0-9\[\] ]/g,function(a){return Latinise.latin_map[a]||a})}; String.prototype.latinize=String.prototype.latinise; String.prototype.isLatin=function(){return this==this.latinise()}
</script>
<?php require_once($_SERVER['DOCUMENT_ROOT'].'/includes/footer.php'); ?>