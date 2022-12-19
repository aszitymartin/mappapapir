<?php require_once($_SERVER['DOCUMENT_ROOT'].'/includes/inc.php'); require_once($_SERVER['DOCUMENT_ROOT'].'/includes/header.php');
function get_time_ago( $time ) {
    $time_difference = time() - $time;
    if( $time_difference < 1 ) { return '< 1mp'; }
    $condition = array( 12 * 30 * 24 * 60 * 60 =>  'éve',30 * 24 * 60 * 60 => 'hónapja',24 * 60 * 60 => 'napja',60 * 60 =>  'órája',60 =>  'perce',1 =>  'másodperce');
    foreach( $condition as $secs => $str ) {$d = $time_difference / $secs;if( $d >= 1 ) {$t = round( $d );return $t . ' ' . $str . ( $t > 1 ? '' : '' ) . '';}}
}
?>
<script> const html = document.querySelector('html');function switchTheme(theme) {html.dataset.theme = `theme-${theme}`;localStorage.setItem('theme', `theme-${theme}`);} </script>
<script>var formatter = new Intl.NumberFormat('hu-HU', {style: 'currency',currency: 'HUF',maximumFractionDigits: 0,minimumFractionDigits: 0});</script>
<main id="main">
    <!-- Features szekcio -->
    <section class="main_section padding-1 border-soft" style="background-color: var(--hl-bg);">
        <div class="feat__con flex flex-row flex-align-c flex-justify-con-c flex-wrap padding-1 gap-1">
            <div class="flex flex-col flex-align-c gap-05 feat__item" onclick="feat__learn('print');">
                <div class="flex feat__hover">
                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="64px" height="64px" viewBox="0 0 24 24" version="1.1"><g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"><rect x="0" y="0" width="24" height="24"/><path d="M16,17 L16,21 C16,21.5522847 15.5522847,22 15,22 L9,22 C8.44771525,22 8,21.5522847 8,21 L8,17 L5,17 C3.8954305,17 3,16.1045695 3,15 L3,8 C3,6.8954305 3.8954305,6 5,6 L19,6 C20.1045695,6 21,6.8954305 21,8 L21,15 C21,16.1045695 20.1045695,17 19,17 L16,17 Z M17.5,11 C18.3284271,11 19,10.3284271 19,9.5 C19,8.67157288 18.3284271,8 17.5,8 C16.6715729,8 16,8.67157288 16,9.5 C16,10.3284271 16.6715729,11 17.5,11 Z M10,14 L10,20 L14,20 L14,14 L10,14 Z" class="svg"/><rect class="svg" opacity="0.3" x="8" y="2" width="8" height="2" rx="1"/></g></svg>
                </div>
                <div class="flex">
                    <span class="text-primary bold">Nyomtatás</span>
                </div>
                <div class="flex flex-col flex-align-c flex-justify-con-c">
                    <span class="text-secondary small-med">Fekete vagy színes digitális fénymásolás</span>
                    <span class="c__small text-primary link pointer user-select-none">Tudj meg többet</span>
                </div>
            </div>
            <hr class="feat__hr">
            <div class="flex flex-col flex-align-c gap-05 feat__item" onclick="feat__learn('design');">
                <div class="flex feat__hover">
                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="64px" height="64px" viewBox="0 0 24 24" version="1.1"><g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"><rect x="0" y="0" width="24" height="24"/><path d="M3,16 L5,16 C5.55228475,16 6,15.5522847 6,15 C6,14.4477153 5.55228475,14 5,14 L3,14 L3,12 L5,12 C5.55228475,12 6,11.5522847 6,11 C6,10.4477153 5.55228475,10 5,10 L3,10 L3,8 L5,8 C5.55228475,8 6,7.55228475 6,7 C6,6.44771525 5.55228475,6 5,6 L3,6 L3,4 C3,3.44771525 3.44771525,3 4,3 L10,3 C10.5522847,3 11,3.44771525 11,4 L11,19 C11,19.5522847 10.5522847,20 10,20 L4,20 C3.44771525,20 3,19.5522847 3,19 L3,16 Z" class="svg" opacity="0.3"/><path d="M16,3 L19,3 C20.1045695,3 21,3.8954305 21,5 L21,15.2485298 C21,15.7329761 20.8241635,16.200956 20.5051534,16.565539 L17.8762883,19.5699562 C17.6944473,19.7777745 17.378566,19.7988332 17.1707477,19.6169922 C17.1540423,19.602375 17.1383289,19.5866616 17.1237117,19.5699562 L14.4948466,16.565539 C14.1758365,16.200956 14,15.7329761 14,15.2485298 L14,5 C14,3.8954305 14.8954305,3 16,3 Z" class="svg"/></g></svg>
                </div>
                <div class="flex">
                    <span class="text-primary bold">Tervezés és kivitelezés</span>
                </div>
                <div class="flex flex-col flex-align-c flex-justify-con-c">
                    <span class="text-secondary small-med">Tervezések és kivitelezések határidőre.</span>
                    <span class="c__small text-primary link pointer user-select-none">Tudj meg többet</span>
                </div>
            </div>
            <hr class="feat__hr">
            <div class="flex flex-col flex-align-c gap-05 feat__item" onclick="feat__learn('knitting');">
                <div class="flex feat__hover">
                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="64px" height="64px" viewBox="0 0 24 24" version="1.1"><g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"><rect x="0" y="0" width="24" height="24"/><path d="M13.6855025,18.7082217 C15.9113859,17.8189707 18.682885,17.2495635 22,17 C22,16.9325178 22,13.1012863 22,5.50630526 L21.9999762,5.50630526 C21.9999762,5.23017604 21.7761292,5.00632908 21.5,5.00632908 C21.4957817,5.00632908 21.4915635,5.00638247 21.4873465,5.00648922 C18.658231,5.07811173 15.8291155,5.74261533 13,7 C13,7.04449645 13,10.79246 13,18.2438906 L12.9999854,18.2438906 C12.9999854,18.520041 13.2238496,18.7439052 13.5,18.7439052 C13.5635398,18.7439052 13.6264972,18.7317946 13.6855025,18.7082217 Z" class="svg"/><path d="M10.3144829,18.7082217 C8.08859955,17.8189707 5.31710038,17.2495635 1.99998542,17 C1.99998542,16.9325178 1.99998542,13.1012863 1.99998542,5.50630526 L2.00000925,5.50630526 C2.00000925,5.23017604 2.22385621,5.00632908 2.49998542,5.00632908 C2.50420375,5.00632908 2.5084219,5.00638247 2.51263888,5.00648922 C5.34175439,5.07811173 8.17086991,5.74261533 10.9999854,7 C10.9999854,7.04449645 10.9999854,10.79246 10.9999854,18.2438906 L11,18.2438906 C11,18.520041 10.7761358,18.7439052 10.4999854,18.7439052 C10.4364457,18.7439052 10.3734882,18.7317946 10.3144829,18.7082217 Z" class="svg" opacity="0.3"/></g></svg>
                </div>
                <div class="flex">
                    <span class="text-primary bold">Kötészet</span>
                </div>
                <div class="flex flex-col flex-align-c flex-justify-con-c">
                    <span class="text-secondary small-med">Aranyozás vagy spirálkötések.</span>
                    <span class="c__small text-primary link pointer user-select-none">Tudj meg többet</span>
                </div>
            </div>
            <hr class="feat__hr">
            <div class="flex flex-col flex-align-c gap-05 feat__item" onclick="feat__learn('shipping');">
                <div class="flex feat__hover">
                    <svg xmlns="http://www.w3.org/2000/svg" width="64px" height="64px" viewBox="0 0 24 24" fill="none"><path d="M20 8H16C15.4 8 15 8.4 15 9V16H10V17C10 17.6 10.4 18 11 18H16C16 16.9 16.9 16 18 16C19.1 16 20 16.9 20 18H21C21.6 18 22 17.6 22 17V13L20 8Z" class="svg"/><path opacity="0.3" d="M20 18C20 19.1 19.1 20 18 20C16.9 20 16 19.1 16 18C16 16.9 16.9 16 18 16C19.1 16 20 16.9 20 18ZM15 4C15 3.4 14.6 3 14 3H3C2.4 3 2 3.4 2 4V13C2 13.6 2.4 14 3 14H15V4ZM6 16C4.9 16 4 16.9 4 18C4 19.1 4.9 20 6 20C7.1 20 8 19.1 8 18C8 16.9 7.1 16 6 16Z" class="svg"/></svg>
                </div>
                <div class="flex">
                    <span class="text-primary bold">Kiszállítás</span>
                </div>
                <div class="flex flex-col flex-align-c flex-justify-con-c">
                    <span class="text-secondary small-med">A szállítási költséget átvállaljuk.</span>
                    <span class="c__small text-primary link pointer user-select-none">Tudj meg többet</span>
                </div>
            </div>
        </div>
        <script src="/assets/script/features/panel.js"></script>
    </section>
    <!-- Hirek szekcioja -->
    <section id='news_section' class='main_section'>
        <div class='flex flex-align-c flex-justify-con-sb'>
            <span class='section_title'>Kiemelt Híreink</span>
        </div>
        <div class='section_body flex flex-justify-con-sb overflow-auto'>
            <div class="swiper-news">
                <div class="swiper-wrapper">
                    <?php $sql = "SELECT def__news.*, customers.fullname FROM def__news INNER JOIN customers ON customers.id = def__news.uid WHERE 1 ORDER BY NO ASC"; $res = $con->query($sql);
                        while ($dt = $res->fetch_assoc()) {
                            echo '
                            <div class="swiper-slide">
                                <div class="news_container flex flex-col flex-align-c relative flex flex-col flex-align-c relative" id="main_news_no_'.$dt['id'].'">
                                    <div class="news_con_wrapper">
                                        <div class="news_desc_con flex flex-col absolute flex flex-col absolute gap-1">
                                            <div class="flex flex-col text-align-j gap-05">
                                                <span class="news_desc_title">'.$dt['title'].'</span>
                                                <span class="news_desc_info">'.$dt['description'].'</span>
                                            </div>
                                            <div class="flex flex-row flex-align-c flex-justify-con-sb gap-1 news_desc_info small-med">
                                                <span>'.$dt['fullname'].'</span>
                                                <span>'. get_time_ago(strtotime($dt['date'])) .'</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            ';
                        }
                    ?>
                    
                </div>
                <div class="swiper-pagination" style='bottom: 92% !important;'></div>
            </div>
        </div>
    </section>
    <!-- Kiemelt kategoriak szekcioja -->
    <section id='categories' class='main_section padding-1 border-soft' style="background-color: var(--hl-bg);">
        <div class='flex flex-align-c flex-justify-con-sb'>
            <span class='section_title'>Kiemelt Kategóriák</span>
        </div>
        <div class="flex flex-align-c flex-wrap flex-justify-con-c gap-2 padding-1">
            <?php
                $pr_sql = "SELECT COUNT(pid) AS 'amount', category FROM products__category GROUP BY category ORDER BY amount DESC LIMIT 5";
                $pr_res = $con-> query($pr_sql);
                if ($pr_res-> num_rows > 0) {
                    while ($hl = $pr_res-> fetch_assoc()) { $type = $hl['category']; $newname = strtr(strtolower(preg_replace('/\s+/', '', $hl['category'])), $unwanted_array);
                        $sql = "SELECT thumbnail FROM products INNER JOIN products__category ON products__category.pid = products.id WHERE products__category.category LIKE '$type' ORDER BY RAND() LIMIT 1";
                        $res = $con-> query($sql);
                        if ($res-> num_rows > 0) {
                            while ($hls = $res-> fetch_assoc()) {
                                echo '
                                <div class="flex flex-col padding-1 highlited-container">
                                    <div class="flex">
                                        <img src="/assets/images/uploads/'.$hls['thumbnail'].'" id="'.$newname.'-thumbnail" class="highlighted-image pointer" />
                                    </div>
                                    <div class="flex flex-col flex-align-c gap-05">
                                        <span class="white-contrast pointer">'.$hl['category'].'</span>
                                        <span class="text-primary small bold">('.$hl['amount'].')</span>
                                    </div>
                                </div>
                                ';
                            }
                        }
                    }
                }
            ?>
        </div>
    </section>
    <!-- Legnepszerubb termek szekcio -->
    <?php
        $mp_sql = "SELECT COUNT(id), pid FROM `reviews` WHERE stars > 4 GROUP BY pid;";
        $mp_res = $con-> query($mp_sql);
        if ($mp_res-> num_rows > 0) { $prs = $mp_res-> fetch_assoc(); $prspid = $prs['pid']; echo '
            <section class="dom__color main_section padding-1 border-soft relative text-align-c" id="dom__color'.$prspid.'">';
                $mps_sql = "SELECT products.id, products.name, products.description, products.thumbnail, products__variations.brand, products__variations.color, reviews.stars FROM products INNER JOIN products__variations ON products__variations.pid = products.id INNER JOIN reviews ON reviews.pid = products.id WHERE products.id = $prspid";
                $mps_res = $con-> query($mps_sql);
                if ($mps_res-> num_rows > 0) {
                    $mpp = $mps_res-> fetch_assoc(); echo '
                        <img id="nwpr__img'.$mpp['id'].'" class="dc__img drop-shadow floating absolute" src="/assets/images/uploads/'.$mpp['thumbnail'].'">
                        <div class="nwpr__info flex flex-col padding-1 gap-1 nwst__info" id="nwst__info'.$prspid.'">
                            <div class="flex flex-col gap-1">
                                <span class="text-xxl flex flex-row flex-align-c gap-1 bold">'.$mpp['brand'].' '.$mpp['name'].' - '.$mpp['color'].'</span>
                                <div class="flex flex-row flex-align-c gap-1 fjcc-mb">
                                    <span id="i__stars" class="dgc__stars"></span>
                                    <span class="bold" id="tr__count"></span>
                                </div>
                            </div>
                            <span class="nwpri__desc" id="nwpri__desc"></span>
                            <div class="flex flex-col gap-05">
                                <div class="flex flex-row flex-align-c gap-1">
                                    <div id="nwpr__link'.$mpp['id'].'" class="button button-dgcp nwpr__link flex w-fc" pid="'.$mpp['id'].'">Termék megtekintése</div>
                                </div>
                            </div>
                        </div>
                        <script content-type="application/javascript">
                            var mpnwplink = document.getElementById("nwpr__link'.$mpp['id'].'"); mpnwplink.addEventListener("click", function () { window.location.href = "/product/"+mpnwplink.getAttribute("pid")+"/'; echo str_replace(',', '', str_replace(' ', '-',strtolower(strtr($mpp['brand'], $unwanted_array)))).'-'.str_replace(',', '', str_replace(' ', '-',strtolower(strtr($mpp['name'], $unwanted_array)))).'-'.str_replace(',', '', str_replace(' ', '-',strtolower(strtr($mpp['color'], $unwanted_array))));  echo '"; });

                            function addImage(file) { var img = document.getElementById("nwpr__img'.$mpp['id'].'"); img.src = file; img.onload = function() { var rgb = getAverageColor(img); var rgbStr = "rgb(" + rgb.r + ", " + rgb.g + ", " + rgb.b + ")"; var hsl = rgbToHsl(rgb.r, rgb.g, rgb.b); var hslStr = "hsl(" + Math.round(hsl.h * 360) + ", " + Math.round(hsl.s * 100) + "%, " + Math.round(hsl.l * 100) + "%)"; var hexStr = "#" + ("0"+rgb.r.toString(16)).slice(-2) + ("0"+rgb.g.toString(16)).slice(-2) + ("0"+rgb.b.toString(16)).slice(-2); $("#dom__color'.$prspid.'").css("background-color", rgbStr); document.getElementById("nwst__info'.$prspid.'").style.color = "#"+contrastingColor(hexStr.replace("#", "")); var bdgcp = document.getElementsByClassName("button-dgcp"); for (let i = 0; i < bdgcp.length; i++) { bdgcp[i].style.border = "1px solid #"+contrastingColor(hexStr.replace("#", "")); } }; }
                            function getAverageColor(img) { var canvas = document.createElement("canvas"); var ctx = canvas.getContext("2d");var width = canvas.width = img.naturalWidth;var height = canvas.height = img.naturalHeight; ctx.drawImage(img, 0, 0); var imageData = ctx.getImageData(0, 0, width, height); var data = imageData.data;
                            var r = 0;var g = 0;var b = 0; for (var i = 0, l = data.length; i < l; i += 4) { r += data[i]; g += data[i+1]; b += data[i+2]; } r = Math.floor(r / (data.length / 4)); g = Math.floor(g / (data.length / 4)); b = Math.floor(b / (data.length / 4)); return { r: r, g: g, b: b }; }
                            function handleImages(files) {addImage(files); } handleImages($("#nwpr__img'.$mpp['id'].'").attr("src")); function rgbToHsl(r, g, b) { r /= 255; g /= 255; b /= 255;var max = Math.max(r, g, b), min = Math.min(r, g, b);var h, s, l = (max + min) / 2;if (max == min) {h = s = 0;} else {var d = max - min;s = l > 0.5 ? d / (2 - max - min) : d / (max + min);switch (max) {case r: h = (g - b) / d + (g < b ? 6 : 0); break;case g: h = (b - r) / d + 2; break;case b: h = (r - g) / d + 4; break;}h /= 6;} return { h: h, s: s, l: l }; }

                            function contrastingColor(color) { return (luma(color) >= 165) ? "000" : "fff"; }
                            function luma(color) { var rgb = (typeof color === "string") ? hexToRGBArray(color) : color; return (0.2126 * rgb[0]) + (0.7152 * rgb[1]) + (0.0722 * rgb[2]); }
                            function hexToRGBArray(color) { if (color.length === 3) { color = color.charAt(0) + color.charAt(0) + color.charAt(1) + color.charAt(1) + color.charAt(2) + color.charAt(2); }
                            else if (color.length !== 6) { throw("Invalid hex color: " + color); } var rgb = []; for (var i = 0; i <= 2; i++) { rgb[i] = parseInt(color.substr(i * 2, 2), 16); } return rgb; }
                        </script>
                        <script>
                                document.getElementById("nwpri__desc").innerHTML = "'.mb_substr($mpp['description'], 0, 205).'";
                        </script>
                        <script src="/assets/script/stars.js"></script>
                        <script>let review = new reviews('.$mpp['id'].'); review.__init();</script>
                    ';
                } echo '
            </section>';
        }
    ?>
    <!-- Uj termekek szekcioja -->
    <!--
    <section id='new_products' class='main_section'>
        <div class='flex flex-align-c flex-justify-con-sb'>
            <span class='section_title'>Új Termékek</span>
        </div>
        <div class='section_body flex gap-1 overflow-auto flex-justify-con-c-d' id="c__desk">
            <?php
                $pr_sql = "SELECT COUNT(pid) AS 'amount', model, AVG(products.added) AS date FROM products__variations INNER JOIN products ON products.id = products__variations.pid GROUP BY model ORDER BY date DESC";
                $pr_res = $con-> query($pr_sql);
                if ($pr_res-> num_rows > 0) {
                    while ($hl = $pr_res-> fetch_assoc()) { $model = $hl['model'];
                        $sql = "SELECT products.id, products.name, products.description, products.thumbnail, products__inventory.quantity, products__inventory.code, products__variations.color, products__variations.brand, products__pricing.base FROM products INNER JOIN products__inventory ON products__inventory.pid = products.id INNER JOIN products__variations ON products__variations.pid = products.id INNER JOIN products__pricing ON products__pricing.pid = products.id WHERE products__variations.model LIKE '$model' AND products.id NOT IN (SELECT products__pricing.pid FROM products__pricing WHERE discounted IS TRUE) AND quantity > 5 LIMIT 1";
                        $res = $con-> query($sql);
                        if ($res-> num_rows > 0) {
                            while ($product = $res-> fetch_assoc()) { $pid = $product['id'];
                                echo '
                                <div class="flex flex-col item-bg border-soft-light box-shadow nwp__card">
                                    <label search-key="'; echo $product['brand'] . ' '; echo strtr($product['brand'], $unwanted_array) . ' '; echo $product['name'] . ' '; echo strtr($product['name'], $unwanted_array) . ' '; echo $product['base'] . ' '; echo $product['code']; echo '"></label>
                                    <div class="flex flex-col flex-align-c flex-justify-con-sb padding-1 gap-05">
                                        <span class="text-secondary bold small uppercase w-fa text-align-c">'.strtoupper($product['brand']).'</span>
                                        <div class="flex flex-row flex-align-c gap-05">
                                            <div class="flex flex-row flex-justify-con-sb">
                                                <div class="flex flex-col gap-05">
                                                    <span class="text-secondary small formatted-price bold" data-price="'.$product['base'].'" id="formatted-price-'.$product['id'].'">'.$product['base'].'</span>
                                                </div>
                                            </div>
                                            <div class="flex flex-row flex-justify-con-c flex-align-c">
                                                '; $ssql = "SELECT stars FROM reviews WHERE pid = $pid"; $sres = $con-> query($ssql); $son = 0; $stw = 0; $sth = 0; $sfo = 0; $sfi = 0; $savg = 0;
                                                if ($sres-> num_rows > 0) { while ($star = $sres-> fetch_assoc()) { $stv = $star['stars']; if ($stv == 5) { $sfi += 1; } if ($stv == 4) { $sfo += 1; } if ($stv == 3) { $sth += 1; } if ($stv == 2) { $stw += 1; } if ($stv == 1) { $son += 1; } $dv = ($sfi + $sfo + $sth + $stw + $son); }
                                                $savg = ((5 * $sfi) + (4 * $sfo) + (3 * $sth) + (2 * $stw) + (1 * $son)) / $dv; $st__avg = round($savg * 10) / 10;
                                                    echo ' <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="22px" height="22px" viewBox="0 0 24 24" version="1.1"><g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"><polygon points="0 0 24 0 24 24 0 24"></polygon><path d="M12,18 L7.91561963,20.1472858 C7.42677504,20.4042866 6.82214789,20.2163401 6.56514708,19.7274955 C6.46280801,19.5328351 6.42749334,19.309867 6.46467018,19.0931094 L7.24471742,14.545085 L3.94038429,11.3241562 C3.54490071,10.938655 3.5368084,10.3055417 3.92230962,9.91005817 C4.07581822,9.75257453 4.27696063,9.65008735 4.49459766,9.61846284 L9.06107374,8.95491503 L11.1032639,4.81698575 C11.3476862,4.32173209 11.9473121,4.11839309 12.4425657,4.36281539 C12.6397783,4.46014562 12.7994058,4.61977315 12.8967361,4.81698575 L14.9389263,8.95491503 L19.5054023,9.61846284 C20.0519472,9.69788046 20.4306287,10.2053233 20.351211,10.7518682 C20.3195865,10.9695052 20.2170993,11.1706476 20.0596157,11.3241562 L16.7552826,14.545085 L17.5353298,19.0931094 C17.6286908,19.6374458 17.263103,20.1544017 16.7187666,20.2477627 C16.5020089,20.2849396 16.2790408,20.2496249 16.0843804,20.1472858 L12,18 Z" fill="#f6cc00"></path></g></svg> <span class="flex text-primary small bold">'.$st__avg.'</span>';
                                                } else {  echo '<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="22px" height="22px" viewBox="0 0 24 24" version="1.1"><g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"><polygon points="0 0 24 0 24 24 0 24"></polygon><path d="M12,18 L7.91561963,20.1472858 C7.42677504,20.4042866 6.82214789,20.2163401 6.56514708,19.7274955 C6.46280801,19.5328351 6.42749334,19.309867 6.46467018,19.0931094 L7.24471742,14.545085 L3.94038429,11.3241562 C3.54490071,10.938655 3.5368084,10.3055417 3.92230962,9.91005817 C4.07581822,9.75257453 4.27696063,9.65008735 4.49459766,9.61846284 L9.06107374,8.95491503 L11.1032639,4.81698575 C11.3476862,4.32173209 11.9473121,4.11839309 12.4425657,4.36281539 C12.6397783,4.46014562 12.7994058,4.61977315 12.8967361,4.81698575 L14.9389263,8.95491503 L19.5054023,9.61846284 C20.0519472,9.69788046 20.4306287,10.2053233 20.351211,10.7518682 C20.3195865,10.9695052 20.2170993,11.1706476 20.0596157,11.3241562 L16.7552826,14.545085 L17.5353298,19.0931094 C17.6286908,19.6374458 17.263103,20.1544017 16.7187666,20.2477627 C16.5020089,20.2849396 16.2790408,20.2496249 16.0843804,20.1472858 L12,18 Z" fill="#f6cc00" opacity=".6"></path></g></svg><span class="flex text-secondary small bold">0.0</span>'; } echo '
                                            </div>
                                        </div>
                                    </div>
                                    <div class="flex flex-col flex-align-c gap-1">
                                        <div class="flex flex-col flex-align-c product-link pointer" auid="'.$product['id'].'">
                                            <img src="/assets/images/uploads/'.$product['thumbnail'].'" alt="'.mb_substr($product['description'], 0, 60).'" class="ind-prd-crd-img drop-shadow" />
                                        </div>
                                        <div class="flex flex-row flex-justify-con-sb">
                                            <div class="flex flex-col flex-align-c flex-justify-con-c gap-05 padding-05 w-fa">
                                                <span class="text-primary small-med bold pointer product-link w-fa text-align-c" auid="'.$product['id'].'">'.$product['name'].'</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <script>document.getElementById("formatted-price-'.$product['id'].'").textContent = formatter.format('.$product['base'].');</script>
                                ';
                            }
                        }
                    }
                }
            ?>
        </div>
    </section>
    --><br><br>
    <?php
        $pd_ct_sql = "SELECT COUNT(pid) AS 'amount', category, AVG(products.added) AS date FROM products__category INNER JOIN products ON products.id = products__category.pid GROUP BY category ORDER BY amount DESC LIMIT 6";
        $pd_ct_res = $con-> query($pd_ct_sql);
        if ($pd_ct_res-> num_rows > 0) {
            while ($pdct = $pd_ct_res-> fetch_assoc()) { $category = $pdct['category']; $newname = strtr(strtolower(preg_replace('/\s+/', '', $pdct['category'])), $unwanted_array);
                echo '
                <section class="main_section">
                    <div class="flex flex-align-c flex-justify-con-sb">
                        <span class="section_title">'.$category.'</span>
                    </div>
                    <div class="flex gap-1 overflow-auto padding-05 hide-scroll">
                ';
                $pd_ct_in_sql = "SELECT COUNT(products__variations.pid) AS 'amount', model, AVG(products.added) AS date FROM products__variations INNER JOIN products ON products.id = products__variations.pid INNER JOIN products__category ON products__category.pid = products__variations.pid WHERE category LIKE '$category' GROUP BY model ORDER BY date DESC;";
                $pd_ct_in_res = $con-> query($pd_ct_in_sql);
                if ($pd_ct_in_res-> num_rows > 0) {
                    while ($pdctin = $pd_ct_in_res-> fetch_assoc()) { $model = $pdctin['model'];
                        $sql = "SELECT products.id, products.name, products.description, products.thumbnail, products__inventory.quantity, products__inventory.code, products__variations.color, products__variations.brand, products__pricing.base, products__pricing.discounted, products__pricing.discount FROM products INNER JOIN products__inventory ON products__inventory.pid = products.id INNER JOIN products__variations ON products__variations.pid = products.id INNER JOIN products__pricing ON products__pricing.pid = products.id WHERE products__variations.model LIKE '$model' LIMIT 1";
                        $res = $con-> query($sql);
                        if ($res-> num_rows > 0) {
                            while ($product = $res-> fetch_assoc()) { $pid = $product['id'];
                                echo '
                                <a class="flex flex-col item-bg border-soft-light box-shadow nwp__card  pointer" href="/product/'.$product['id'].'/'; echo str_replace(',', '', str_replace(' ', '-',strtolower(strtr($product['brand'], $unwanted_array)))).'-'.str_replace(',', '', str_replace(' ', '-',strtolower(strtr($product['name'], $unwanted_array)))).'-'.str_replace(',', '', str_replace(' ', '-', strtolower(strtr($product['color'], $unwanted_array)))); echo '">
                                    <div class="product-hover" auid="'.$product['id'].'" data-pid="'.$product['id'].'" data-model="'.$model.'" id="'.$newname.'-'.$product['id'].'">
                                        <label search-key="'; echo $product['brand'] . ' '; echo strtr($product['brand'], $unwanted_array) . ' '; echo $product['name'] . ' '; echo strtr($product['name'], $unwanted_array) . ' '; echo $product['base'] . ' '; echo $product['code']; echo '"></label>
                                        <div class="flex flex-col flex-align-c flex-justify-con-sb padding-1 gap-05">
                                            <span class="text-secondary bold small uppercase w-fa text-align-c">'.strtoupper($product['brand']).'</span>
                                            <div class="flex flex-row flex-align-c gap-05">
                                                <div class="flex flex-row flex-justify-con-sb">
                                                    <div class="flex flex-col gap-05">';
                                                        if ($product['discounted'] == 0) {
                                                            echo '<span class="text-secondary small formatted-price bold" data-price="'.$product['base'].'" id="formatted-price-'.$product['id'].'">'.$product['base'].'</span>';
                                                        } else { $newprice = $product['base'] - ($product['base'] * $product['discount']) / 100;
                                                            echo '
                                                                <div class="flex flex-row flex-align-c gap-025">
                                                                    <span class="text-secondary smaller-med formatted-price linethrough" data-price="'.$product['base'].'"></span>
                                                                    <span class="text-secondary small formatted-price bold" data-price="'.$newprice.'"></span>
                                                                </div>
                                                            ';
                                                        }
                                                        echo '
                                                    </div>
                                                </div>
                                                <div class="flex flex-row flex-justify-con-c flex-align-c">
                                                    '; $ssql = "SELECT stars FROM reviews WHERE pid = $pid"; $sres = $con-> query($ssql); $son = 0; $stw = 0; $sth = 0; $sfo = 0; $sfi = 0; $savg = 0;
                                                    if ($sres-> num_rows > 0) { while ($star = $sres-> fetch_assoc()) { $stv = $star['stars']; if ($stv == 5) { $sfi += 1; } if ($stv == 4) { $sfo += 1; } if ($stv == 3) { $sth += 1; } if ($stv == 2) { $stw += 1; } if ($stv == 1) { $son += 1; } $dv = ($sfi + $sfo + $sth + $stw + $son); }
                                                    $savg = ((5 * $sfi) + (4 * $sfo) + (3 * $sth) + (2 * $stw) + (1 * $son)) / $dv; $st__avg = round($savg * 10) / 10;
                                                        echo ' <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="22px" height="22px" viewBox="0 0 24 24" version="1.1"><g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"><polygon points="0 0 24 0 24 24 0 24"></polygon><path d="M12,18 L7.91561963,20.1472858 C7.42677504,20.4042866 6.82214789,20.2163401 6.56514708,19.7274955 C6.46280801,19.5328351 6.42749334,19.309867 6.46467018,19.0931094 L7.24471742,14.545085 L3.94038429,11.3241562 C3.54490071,10.938655 3.5368084,10.3055417 3.92230962,9.91005817 C4.07581822,9.75257453 4.27696063,9.65008735 4.49459766,9.61846284 L9.06107374,8.95491503 L11.1032639,4.81698575 C11.3476862,4.32173209 11.9473121,4.11839309 12.4425657,4.36281539 C12.6397783,4.46014562 12.7994058,4.61977315 12.8967361,4.81698575 L14.9389263,8.95491503 L19.5054023,9.61846284 C20.0519472,9.69788046 20.4306287,10.2053233 20.351211,10.7518682 C20.3195865,10.9695052 20.2170993,11.1706476 20.0596157,11.3241562 L16.7552826,14.545085 L17.5353298,19.0931094 C17.6286908,19.6374458 17.263103,20.1544017 16.7187666,20.2477627 C16.5020089,20.2849396 16.2790408,20.2496249 16.0843804,20.1472858 L12,18 Z" fill="#f6cc00"></path></g></svg> <span class="flex text-primary small bold">'.$st__avg.'</span>';
                                                    } else {  echo '<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="22px" height="22px" viewBox="0 0 24 24" version="1.1"><g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"><polygon points="0 0 24 0 24 24 0 24"></polygon><path d="M12,18 L7.91561963,20.1472858 C7.42677504,20.4042866 6.82214789,20.2163401 6.56514708,19.7274955 C6.46280801,19.5328351 6.42749334,19.309867 6.46467018,19.0931094 L7.24471742,14.545085 L3.94038429,11.3241562 C3.54490071,10.938655 3.5368084,10.3055417 3.92230962,9.91005817 C4.07581822,9.75257453 4.27696063,9.65008735 4.49459766,9.61846284 L9.06107374,8.95491503 L11.1032639,4.81698575 C11.3476862,4.32173209 11.9473121,4.11839309 12.4425657,4.36281539 C12.6397783,4.46014562 12.7994058,4.61977315 12.8967361,4.81698575 L14.9389263,8.95491503 L19.5054023,9.61846284 C20.0519472,9.69788046 20.4306287,10.2053233 20.351211,10.7518682 C20.3195865,10.9695052 20.2170993,11.1706476 20.0596157,11.3241562 L16.7552826,14.545085 L17.5353298,19.0931094 C17.6286908,19.6374458 17.263103,20.1544017 16.7187666,20.2477627 C16.5020089,20.2849396 16.2790408,20.2496249 16.0843804,20.1472858 L12,18 Z" fill="#f6cc00" opacity=".6"></path></g></svg><span class="flex text-secondary small bold">0.0</span>'; } echo '
                                                </div>
                                            </div>
                                            ';
                                                if ($product['quantity'] < 10) {
                                                    echo '<span class="label-danger smaller border-soft-light padding-025 ">Utolsó darabok</span>';
                                                }
                                            echo '
                                        </div>
                                        <div class="flex flex-col flex-align-c gap-1">
                                            <div class="flex flex-col flex-align-c pointer product-image-container" style="max-width: 8rem !important;">
                                                <img src="/assets/images/uploads/'.$product['thumbnail'].'" alt="'.mb_substr($product['description'], 0, 60).'" class="ind-prd-crd-img drop-shadow" />
                                            </div>
                                            <div class="flex flex-row flex-justify-con-sb">
                                                <div class="flex flex-col flex-align-c flex-justify-con-c gap-05 padding-05 w-fa">
                                                    <span class="text-primary small-med bold pointer w-fa text-align-c">'; 
                                                    if (strlen($product['name']) > 120) {
                                                        echo mb_substr($product['name'], 0, 120).'...';
                                                    } else { echo $product['name']; }
                                                    echo '</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                                ';
                            }
                        }
                    }
                } 
                echo '
                    </div>
                </section>
                ';
            }
        }
    ?>
</main>
<script>
    var formInp = document.getElementsByClassName('formatted-price'); var prcon = document.getElementsByClassName('product-hover');
    for (let i = 0; i < formInp.length; i++) { formInp[i].textContent = formatter.format(formInp[i].getAttribute('data-price')); }
    /*
    for (let i = 0; i < prcon.length; i++) {
        prcon[i].addEventListener('mouseenter', () => { var swcon = prcon[i].querySelector('div.product-image-container');
            swcon.innerHTML = `<div class="swiper product-swiper" style="height: 8rem !important; width: 8rem !important; background-color: transparent; box-shadow: unset !important; margin-top: 0 !important;"><div class="swiper-wrapper" id="swpr-sld-${i}" style="max-width: 8rem !important; max-height: 8rem !important;"></div></div>`;
            var modelData = new FormData(); modelData.append("model", prcon[i].getAttribute('data-model'));
            $.ajax({ enctype: "multipart/form-data", type: "POST", url: "/assets/php/products/images.php", data: modelData, dataType: 'json', contentType: false, processData: false,
                success: function(data) {
                    for (let j = 0; j < data.length; j++) { document.getElementById('swpr-sld-'+i).innerHTML += `<div class="swiper-slide"><img src="/assets/images/uploads/${data[j]}" class="ind-prd-crd-img drop-shadow" /></div> `;
                    } const swiper = new Swiper('.product-swiper', {direction: 'horizontal', loop: true, autoplay: { delay: 2000, disableOnInteraction: false,}, });
                }, error: function (data) { console.log(data); }
            });
        }); prcon[i].addEventListener('mouseleave', () => { var modelData = new FormData(); modelData.append("pid", prcon[i].getAttribute('data-pid'));
            $.ajax({ enctype: "multipart/form-data", type: "POST", url: "/assets/php/products/thumbnail.php", data: modelData, dataType: 'json', contentType: false, processData: false,
                success: function(data) { prcon[i].querySelector('div.product-image-container').innerHTML = `<img src="/assets/images/uploads/${data[0]}" class="ind-prd-crd-img drop-shadow" />`; }, error: function (data) { console.log(data); }
            });
        });
    }
    */
</script>
<!-- Konyvjelzok kezelese -->
<script src="/assets/script/pr__bookmark.js" content-type="application/javascript"></script>
<!-- Termekek kosarba helyezese / eltavolitasa -->
<script src="/assets/script/pr__basket.js" content-type="application/javascript"></script>
<!-- Hirlevel feliratkozas -->
<script src="/assets/script/e__sub/e__sub.js" content-type="application/javascript"></script>
<?php require_once($_SERVER['DOCUMENT_ROOT'].'/includes/footer.php'); ?>