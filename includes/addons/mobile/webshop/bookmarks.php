<?php require_once($_SERVER['DOCUMENT_ROOT'].'/includes/inc.php'); ?>
<div id="bm__bod" class="sidenav-theme">
    <div class="sidenav-header flex flec-row flex-align-c flex-justify-con-sb">
        <span class="flex flex-col">
            <span class="header_title_heading">Mentett elemek</span>
        </span>
        <span class="flex">
            <span class="text-primary pointer" onclick="closeSidenavAddons('all')" aria-label="Bezárás">
                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1"><g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"><rect x="0" y="0" width="24" height="24"/><circle class="svg" opacity="0.3" cx="12" cy="12" r="10"/><path d="M12.0355339,10.6213203 L14.863961,7.79289322 C15.2544853,7.40236893 15.8876503,7.40236893 16.2781746,7.79289322 C16.6686989,8.18341751 16.6686989,8.81658249 16.2781746,9.20710678 L13.4497475,12.0355339 L16.2781746,14.863961 C16.6686989,15.2544853 16.6686989,15.8876503 16.2781746,16.2781746 C15.8876503,16.6686989 15.2544853,16.6686989 14.863961,16.2781746 L12.0355339,13.4497475 L9.20710678,16.2781746 C8.81658249,16.6686989 8.18341751,16.6686989 7.79289322,16.2781746 C7.40236893,15.8876503 7.40236893,15.2544853 7.79289322,14.863961 L10.6213203,12.0355339 L7.79289322,9.20710678 C7.40236893,8.81658249 7.40236893,8.18341751 7.79289322,7.79289322 C8.18341751,7.40236893 8.81658249,7.40236893 9.20710678,7.79289322 L12.0355339,10.6213203 Z" class="svg" /></g></svg>
            </span>
        </span>
    </div>
    <div id="bm__items" class="theme-body flex flex-col flex-align-c flex-justify-con-l gap-1">
        <?php
            if (isset($_SESSION['loggedin'])) {if (isset($_SESSION['id'])) {$uid = $_SESSION['id'];}}
            if (isset($uid)) {
                $pr_sql = "SELECT products.*, bookmarks.* FROM products INNER JOIN bookmarks ON products.product_id = bookmarks.product_id WHERE bookmarks.uid = '".$uid."'";
                $pr_res = $con-> query($pr_sql);
                if ($pr_res-> num_rows > 0) {
                    while ($product = $pr_res-> fetch_assoc()) {
                        echo '
                        <div class="flex flex-row flex-align-c flex-justify-con-sb gap-05 padding-05 w-fa" id="sv__item'.$product['product_id'].'">
                            <div class="flex flex-row flex-align-c gap-05">
                                <div class="bsc__img flex flex-col flex-align-c flex-justify-con-c">
                                    <img class="bs__img drop-shadow" src="/assets/images/uploads/'.$product['product_image'].'" alt="'.$product['product_name'].'" />
                                    <span id="rm__svi'.$product['product_id'].'" class="text-primary small-med pointer link remove-bookmark" action="1" code="'; echo $product['product_code']; echo'" keyid="'; echo $product['product_id']; echo'">Eltávolítás</span>
                                </div>
                                <div class="flex flex-col gap-05">
                                    <a class="text-primary small pointer link bold" href="/webshop/?id='.$product['product_id'].'&method=51">'.$product['product_name'].' - '.$product['product_color'].'<br>'.$product['product_brand'].'</a>
                                    <span class="flex flex-row gap-05 text-primary bold">'.$product['product_price'].'<span class="uppercase">'.$product['product_price_unit'].'</span>
                                        '; if ($product['quantity'] > 1) { echo '<span id="bsp__quantity'.$product['product_id'].'">x '.$product['quantity'].'</span>'; }
                                        else { echo '<span id="bsp__quantity'.$product['product_id'].'"></span>'; } echo '
                                    </span>
                                </div>
                            </div>
                        </div>
                        ';
                    }
                } else { echo '<div class="text-align-c"><div class="flex flex-col flex-align-c flex-justify-con-c gap-1"><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="8rem" height="8rem" viewBox="0 0 24 24" version="1.1"><g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"><rect x="0" y="0" width="24" height="24"></rect><path d="M8,4 L16,4 C17.1045695,4 18,4.8954305 18,6 L18,17.726765 C18,18.2790497 17.5522847,18.726765 17,18.726765 C16.7498083,18.726765 16.5087052,18.6329798 16.3242754,18.4639191 L12.6757246,15.1194142 C12.2934034,14.7689531 11.7065966,14.7689531 11.3242754,15.1194142 L7.67572463,18.4639191 C7.26860564,18.8371115 6.63603827,18.8096086 6.26284586,18.4024896 C6.09378519,18.2180598 6,17.9769566 6,17.726765 L6,6 C6,4.8954305 6.8954305,4 8,4 Z" class="svg-stroke"></path></g></svg></span><span class="text-secondary text-small flex flex-col flex-align-c flex-justify-con-c"><span class="flex flex-align-c gap-05">Úgy tűnik, hogy Ön jelenleg nem rendelkezik mentett termékkel. Termékeinket a könyvjelző ikonra kattintva mentheti le.</span></div></div>'; }
            } else {echo '<div class="text-align-c"><div class="flex flex-col flex-align-c flex-justify-con-c gap-1"><span><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="8rem" height="8rem" viewBox="0 0 24 24" version="1.1"><g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"><mask fill="white"><use xlink:href="#path-1"/></mask><g/><path d="M7,10 L7,8 C7,5.23857625 9.23857625,3 12,3 C14.7614237,3 17,5.23857625 17,8 L17,10 L18,10 C19.1045695,10 20,10.8954305 20,12 L20,18 C20,19.1045695 19.1045695,20 18,20 L6,20 C4.8954305,20 4,19.1045695 4,18 L4,12 C4,10.8954305 4.8954305,10 6,10 L7,10 Z M12,5 C10.3431458,5 9,6.34314575 9,8 L9,10 L15,10 L15,8 C15,6.34314575 13.6568542,5 12,5 Z" class="svg" /></g></svg></span><span class="text-secondary text-small flex flex-col flex-align-c flex-justify-con-c"><span>A Bevásárlókosár használatához be kell jelentkeznie. <a class="underline" style="color: var(--section-title) !important;" onclick="openHeaderProfileAction();">Ide kattintva tud bejelentkezni</a>.</span></div></div>';}
        ?>
    </div>
</div>
<script>
    var isMobile; if( /Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent) ) {isMobile = true;} else {isMobile = false;}
    if (isMobile) { document.getElementById('bm__bod').style.height = (document.getElementById('header_menu').offsetHeight * 85)/100+'px'; } else { document.getElementById('bm__items').style.height = (document.getElementById('header_menu').offsetHeight * 85)/100+'px'; }

    var del = document.getElementsByClassName('remove-bookmark');var del_bk_data = new FormData(); var all_bk_wp = document.getElementsByClassName('product_bookmark');
    for (let i = 0; i < del.length; i++) {
        del[i].addEventListener('click', function () { del_bk_data.append("id", del[i].getAttribute('keyid')); del_bk_data.append("code", del[i].getAttribute('code')); del_bk_data.append("action", del[i].getAttribute('action'));
            $.ajax({
                enctype: "multipart/form-data", type: "POST", url: "/includes/webshop/bookmark.php", data: del_bk_data, dataType: 'json', contentType: false, processData: false,
                beforeSend: function () {document.getElementById('sidenavAddon').innerHTML = `<span class="sidenav-loader" id="sidenav-loader"><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="64px" height="64px" viewBox="0 0 24 24" version="1.1"><g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"><g><polygon points="0 0 24 0 24 24 0 24"/></g><path d="M12,4 L12,6 C8.6862915,6 6,8.6862915 6,12 C6,15.3137085 8.6862915,18 12,18 C15.3137085,18 18,15.3137085 18,12 C18,10.9603196 17.7360885,9.96126435 17.2402578,9.07513926 L18.9856052,8.09853149 C19.6473536,9.28117708 20,10.6161442 20,12 C20,16.418278 16.418278,20 12,20 C7.581722,20 4,16.418278 4,12 C4,7.581722 7.581722,4 12,4 Z" class="svg" fill-rule="nonzero" opacity="0.3" transform="translate(12.000000, 12.000000) scale(-1, 1) translate(-12.000000, -12.000000) "/></g></svg></span>`;},
                success: function(data) { // Sikeres/Sikertelen akciok kimenetelenek lekezelese ertesitesekkel, hogy emberbaratabb legyen az oldal.
                    var respCode = String(data).slice(0, 3); var respId = String(data).slice(3, 5); // A responsebol kapott erteket szet daraboljuk, hogy a kapott ertekeket valtozokba mentsuk a tovabbi hasznalathoz
                    if (Number(respCode) === 410) {  // A statusz kod 410 (Sikeres torles)
                        $('#sidenavAddon').load('/includes/addons/mobile/webshop/bookmarks.php'); // Ujratoltjuk a 'Bookmarks' menut, hogy csak az jelenjen meg, amit nem toroltunk ki.
                        for (let j = 0; j < $("[keyid="+respId+"]").length; j++) { // Az osszes olyan elem attributumat valtoztassuk meg az oldalon, amelynek az erteke a fent kapott keyId-val egyenlo.
                            $("[keyid="+respId+"]")[j].setAttribute('action', '0'); // A gomb action attributumat nullara allitjuk, ami azt jelenti, hogy mostmar hozza lehet adni a konyvjelzokhoz
                            $("[keyid="+respId+"]")[j].innerHTML = `<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="1.5rem" height="1.5rem" viewBox="0 0 24 24" version="1.1"><g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"><rect x="0" y="0" width="24" height="24"></rect><path d="M8,4 L16,4 C17.1045695,4 18,4.8954305 18,6 L18,17.726765 C18,18.2790497 17.5522847,18.726765 17,18.726765 C16.7498083,18.726765 16.5087052,18.6329798 16.3242754,18.4639191 L12.6757246,15.1194142 C12.2934034,14.7689531 11.7065966,14.7689531 11.3242754,15.1194142 L7.67572463,18.4639191 C7.26860564,18.8371115 6.63603827,18.8096086 6.26284586,18.4024896 C6.09378519,18.2180598 6,17.9769566 6,17.726765 L6,6 C6,4.8954305 6.8954305,4 8,4 Z" class="svg-stroke"></path></g></svg>`;
                        }
                    }
                }, error: function (data) {notificationSystem(0, 1, 0, "Hiba", "Sikertelen művelet!");}
            });
        });
    }
</script>