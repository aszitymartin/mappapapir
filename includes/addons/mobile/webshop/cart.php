<?php require_once($_SERVER['DOCUMENT_ROOT'].'/includes/inc.php'); ?>
<div class="sidenav-theme">
    <div class="sidenav-header flex flec-row flex-align-c flex-justify-con-sb">
        <span class="flex flex-col">
            <span class="header_title_heading">Bevásárlókosár</span>
        </span>
        <span class="flex">
            <span class="text-primary pointer" onclick="closeSidenavAddons('all')">
                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"><rect x="0" y="0" width="24" height="24"/><circle class="svg" opacity="0.3" cx="12" cy="12" r="10"/><path d="M12.0355339,10.6213203 L14.863961,7.79289322 C15.2544853,7.40236893 15.8876503,7.40236893 16.2781746,7.79289322 C16.6686989,8.18341751 16.6686989,8.81658249 16.2781746,9.20710678 L13.4497475,12.0355339 L16.2781746,14.863961 C16.6686989,15.2544853 16.6686989,15.8876503 16.2781746,16.2781746 C15.8876503,16.6686989 15.2544853,16.6686989 14.863961,16.2781746 L12.0355339,13.4497475 L9.20710678,16.2781746 C8.81658249,16.6686989 8.18341751,16.6686989 7.79289322,16.2781746 C7.40236893,15.8876503 7.40236893,15.2544853 7.79289322,14.863961 L10.6213203,12.0355339 L7.79289322,9.20710678 C7.40236893,8.81658249 7.40236893,8.18341751 7.79289322,7.79289322 C8.18341751,7.40236893 8.81658249,7.40236893 9.20710678,7.79289322 L12.0355339,10.6213203 Z" class="svg" /></g>
                </svg>
            </span>
        </span>
    </div>
    <div class="theme-body flex flex-row flex-align-c flex-justify-con-c flex-wrap gap-1">
        <?php
            if (isset($_SESSION['loggedin'])) {if (isset($_SESSION['id'])) {$uid = $_SESSION['id'];}}
            if (isset($uid)) {
                $pr_sql = "SELECT products.*, cart.* FROM products INNER JOIN cart ON products.product_id = cart.pid WHERE cart.uid = '".$uid."'";
                $pr_res = $con-> query($pr_sql);
                if ($pr_res-> num_rows > 0) {
                    while ($product = $pr_res-> fetch_assoc()) {
                        echo '
                        <div class="product_card flex flex-col padding-05 box-shadow background-bg border-soft user-select-none" style="width: 7rem;">
                            <label search-key="'; echo $product['product_brand'] . ' '; echo strtr($product['product_brand'], $unwanted_array) . ' '; echo $product['product_name'] . ' '; echo strtr($product['product_name'], $unwanted_array) . ' '; echo $product['product_price'] . ' '; echo $product['product_code']; echo '"></label>
                            <div class="product_card_inner flex flex-col h-100">
                                <span class="flex flex-row flex-justify-con-sb flex-align-c">
                                    <span class="product_brand small-med">'; echo $product['product_brand']; echo '</span>
                                    <span class="flex flex-align-c flex-justify-con-c remove-cart-item" pcode="'.$product['pcode'].'" pid="'.$product['pid'].'" key-event="1">
                                        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="1.2rem" height="1.2rem" viewBox="0 0 24 24" version="1.1">
                                            <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"><rect x="0" y="0" width="24" height="24"/><path d="M6,8 L18,8 L17.106535,19.6150447 C17.04642,20.3965405 16.3947578,21 15.6109533,21 L8.38904671,21 C7.60524225,21 6.95358004,20.3965405 6.89346498,19.6150447 L6,8 Z M8,10 L8.45438229,14.0894406 L15.5517885,14.0339036 L16,10 L8,10 Z" class="svg" fill-rule="nonzero"/><path d="M14,4.5 L14,3.5 C14,3.22385763 13.7761424,3 13.5,3 L10.5,3 C10.2238576,3 10,3.22385763 10,3.5 L10,4.5 L5.5,4.5 C5.22385763,4.5 5,4.72385763 5,5 L5,5.5 C5,5.77614237 5.22385763,6 5.5,6 L18.5,6 C18.7761424,6 19,5.77614237 19,5.5 L19,5 C19,4.72385763 18.7761424,4.5 18.5,4.5 L14,4.5 Z" class="svg" opacity="0.3"/></g>
                                        </svg>
                                    </span>
                                </span>
                                <span class="product-link" auid="'; echo $product['product_id']; echo '">
                                    <span class="flex flex-align-c flex-justify-con-c w-100">
                                        <img class="product_image" style="width: 5rem; height: 5rem;" src="/assets/images/uploads/'; echo $product['product_image']; echo '" alt="'; echo $product['product_name']; echo '">
                                    </span>
                                    <div class="product_info">
                                        <span class="product_title small-med">'; echo $product['product_name']; echo '</span>
                                        <span class="product_desc">'; echo str_replace("�", " ", substr($product['product_info'],0, 32)); echo '...</span>
                                    </div>
                                </span>
                                <div class="product_price_con flex flex-justify-con-sb margin-top-a">
                                    <span class="product_price">'; echo $product['product_price']; echo ' '; echo strtoupper($product['product_price_unit']); echo '</span>
                                </div>
                            </div>
                        </div> 
                        ';
                    }
                } else {
                    echo '
                    <div class="text-align-c">
                        <span class="text-secondary text-small">Úgy tűnik, a bevásárlókosara üres. A termékeket a webáruházon keresztül kosárba helyezheti.</span>
                    </div>
                    <div class="flex flex-col w-100">
                        <span class="text-secondary" style="margin-bottom: .5rem;">Termékek, amelyek tetszhetnek</span>
                        <div class="theme-body flex flex-row flex-align-c flex-justify-con-c flex-wrap gap-1">
                            ';
                            $pr_sql = "SELECT * FROM products WHERE 1 ORDER BY RAND() LIMIT 4"; $pr_res = $con-> query($pr_sql);
                            if ($pr_res-> num_rows > 0) {
                                while ($product = $pr_res-> fetch_assoc()) {
                                    echo '
                                    <div class="product_card flex flex-col padding-05 box-shadow background-bg border-soft user-select-none" style="width: 7rem;">
                                        <label search-key="'; echo $product['product_brand'] . ' '; echo strtr($product['product_brand'], $unwanted_array) . ' '; echo $product['product_name'] . ' '; echo strtr($product['product_name'], $unwanted_array) . ' '; echo $product['product_price'] . ' '; echo $product['product_code']; echo '"></label>
                                        <div class="product_card_inner flex flex-col h-100">
                                            <span class="flex flex-row flex-justify-con-sb flex-align-c">
                                                <span class="product_brand small-med">'; echo $product['product_brand']; echo '</span>
                                            </span>
                                            <span class="product-link" auid="'; echo $product['product_id']; echo '">
                                                <span class="flex flex-align-c flex-justify-con-c w-100">
                                                    <img class="product_image" style="width: 5rem; height: 5rem;" src="/assets/images/uploads/'; echo $product['product_image']; echo '" alt="'; echo $product['product_name']; echo '">
                                                </span>
                                                <div class="product_info">
                                                    <span class="product_title small-med">'; echo $product['product_name']; echo '</span>
                                                    <span class="product_desc">'; echo str_replace("�", " ", substr($product['product_info'],0, 32)); echo '...</span>
                                                </div>
                                            </span>
                                            <div class="product_price_con flex flex-justify-con-sb margin-top-a">
                                                <span class="product_price">'; echo $product['product_price']; echo ' '; echo strtoupper($product['product_price_unit']); echo '</span>
                                            </div>
                                        </div>
                                    </div> 
                                    ';
                                }
                            }
                            echo '
                        </div>
                    </div>
                    ';
                }
            }else {echo '<div class="text-align-c"><div class="flex flex-col flex-align-c flex-justify-con-c gap-1"><span><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="8rem" height="8rem" viewBox="0 0 24 24" version="1.1"><g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"><mask fill="white"><use xlink:href="#path-1"/></mask><g/><path d="M7,10 L7,8 C7,5.23857625 9.23857625,3 12,3 C14.7614237,3 17,5.23857625 17,8 L17,10 L18,10 C19.1045695,10 20,10.8954305 20,12 L20,18 C20,19.1045695 19.1045695,20 18,20 L6,20 C4.8954305,20 4,19.1045695 4,18 L4,12 C4,10.8954305 4.8954305,10 6,10 L7,10 Z M12,5 C10.3431458,5 9,6.34314575 9,8 L9,10 L15,10 L15,8 C15,6.34314575 13.6568542,5 12,5 Z" class="svg" /></g></svg></span><span class="text-secondary text-small flex flex-col flex-align-c flex-justify-con-c"><span>A Bevásárlókosár használatához be kell jelentkeznie. <a class="underline" style="color: var(--section-title) !important;" onclick="openHeaderProfileAction();">Ide kattintva tud bejelentkezni</a>.</span></div></div>';}
        ?>
    </div>
</div>
<script>
    var del = document.getElementsByClassName('remove-cart-item');var del_bk_data = new FormData(); var all_bk_wp = document.getElementsByClassName('product_bookmark');
    for (let i = 0; i < del.length; i++) {
        del[i].addEventListener('click', function () {
            // del_bk_data.append("id", del[i].getAttribute('keyid')); del_bk_data.append("code", del[i].getAttribute('code')); del_bk_data.append("action", del[i].getAttribute('action'));
            del_bk_data.append("pid", del[i].getAttribute('pid')); del_bk_data.append("pcode", del[i].getAttribute('pcode')); del_bk_data.append("event", del[i].getAttribute('key-event'));
            $.ajax({
                enctype: "multipart/form-data", type: "POST", url: "/includes/webshop/cart.php", data: del_bk_data, dataType: 'json', contentType: false, processData: false,
                beforeSend: function () {document.getElementById('sidenavAddon').innerHTML = `<span class="sidenav-loader" id="sidenav-loader"><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="64px" height="64px" viewBox="0 0 24 24" version="1.1"><g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"><g><polygon points="0 0 24 0 24 24 0 24"/></g><path d="M12,4 L12,6 C8.6862915,6 6,8.6862915 6,12 C6,15.3137085 8.6862915,18 12,18 C15.3137085,18 18,15.3137085 18,12 C18,10.9603196 17.7360885,9.96126435 17.2402578,9.07513926 L18.9856052,8.09853149 C19.6473536,9.28117708 20,10.6161442 20,12 C20,16.418278 16.418278,20 12,20 C7.581722,20 4,16.418278 4,12 C4,7.581722 7.581722,4 12,4 Z" class="svg" fill-rule="nonzero" opacity="0.3" transform="translate(12.000000, 12.000000) scale(-1, 1) translate(-12.000000, -12.000000) "/></g></svg></span>`;},
                success: function(data) { // Sikeres/Sikertelen akciok kimenetelenek lekezelese ertesitesekkel, hogy emberbaratabb legyen az oldal.
                    console.log(data);var respCode = String(data).slice(0, 3); var respId = String(data).slice(3, 5); // A responsebol kapott erteket szet daraboljuk, hogy a kapott ertekeket valtozokba mentsuk a tovabbi hasznalathoz
                    if (Number(respCode) === 410) {  // A statusz kod 410 (Sikeres torles)
                        $('#sidenavAddon').load('/includes/addons/mobile/webshop/cart.php'); // Ujratoltjuk a 'Cart' menut, hogy csak az jelenjen meg, amit nem toroltunk ki.
                        document.getElementById('add-to-cart').setAttribute('key-event', '0');
                        document.getElementById('add-to-cart').innerHTML = `<span>Kosárba</span><span class="flex"><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="1.2rem" height="1.2rem" viewBox="0 0 24 24" version="1.1"><g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"><rect x="0" y="0" width="24" height="24"></rect><path d="M12,4.56204994 L7.76822128,9.6401844 C7.4146572,10.0644613 6.7840925,10.1217854 6.3598156,9.76822128 C5.9355387,9.4146572 5.87821464,8.7840925 6.23177872,8.3598156 L11.2317787,2.3598156 C11.6315738,1.88006147 12.3684262,1.88006147 12.7682213,2.3598156 L17.7682213,8.3598156 C18.1217854,8.7840925 18.0644613,9.4146572 17.6401844,9.76822128 C17.2159075,10.1217854 16.5853428,10.0644613 16.2317787,9.6401844 L12,4.56204994 Z" class="svg" fill-rule="nonzero" opacity="0.3"></path><path d="M3.28077641,9 L20.7192236,9 C21.2715083,9 21.7192236,9.44771525 21.7192236,10 C21.7192236,10.0817618 21.7091962,10.163215 21.6893661,10.2425356 L19.5680983,18.7276069 C19.234223,20.0631079 18.0342737,21 16.6576708,21 L7.34232922,21 C5.96572629,21 4.76577697,20.0631079 4.43190172,18.7276069 L2.31063391,10.2425356 C2.17668518,9.70674072 2.50244587,9.16380623 3.03824078,9.0298575 C3.11756139,9.01002735 3.1990146,9 3.28077641,9 Z M12,12 C11.4477153,12 11,12.4477153 11,13 L11,17 C11,17.5522847 11.4477153,18 12,18 C12.5522847,18 13,17.5522847 13,17 L13,13 C13,12.4477153 12.5522847,12 12,12 Z M6.96472382,12.1362967 C6.43125772,12.2792385 6.11467523,12.8275755 6.25761704,13.3610416 L7.29289322,17.2247449 C7.43583503,17.758211 7.98417199,18.0747935 8.51763809,17.9318517 C9.05110419,17.7889098 9.36768668,17.2405729 9.22474487,16.7071068 L8.18946869,12.8434035 C8.04652688,12.3099374 7.49818992,11.9933549 6.96472382,12.1362967 Z M17.0352762,12.1362967 C16.5018101,11.9933549 15.9534731,12.3099374 15.8105313,12.8434035 L14.7752551,16.7071068 C14.6323133,17.2405729 14.9488958,17.7889098 15.4823619,17.9318517 C16.015828,18.0747935 16.564165,17.758211 16.7071068,17.2247449 L17.742383,13.3610416 C17.8853248,12.8275755 17.5687423,12.2792385 17.0352762,12.1362967 Z" class="svg"></path></g></svg></span>`;
                    }
                }, error: function (data) {notificationSystem(0, 1, 0, "Hiba", "Sikertelen művelet!");}
            });
        });
    }
    var product_card = document.getElementsByClassName('product-link');
    for (let i = 0; i < product_card.length; i++) {
        product_card[i].addEventListener("click", function () {
            window.location.href = "/webshop/?id=" + product_card[i].getAttribute('auid')+"&method=53"; // A termek a kosar szekciobol lett megnyitva
        });
    }
</script>