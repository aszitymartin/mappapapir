 <!-- Legnepszerubb termek szekcio -->
 <?php
    $mp_sql = "SELECT COUNT(id), pid FROM `reviews` WHERE stars > 4 GROUP BY pid;";
    $mp_res = $con-> query($mp_sql);
    if ($mp_res-> num_rows > 0) { $prs = $mp_res-> fetch_assoc(); $prspid = $prs['pid']; echo '
        <section class="dom__color main_section padding-1 border-soft relative" id="dom__color'.$prspid.'">';
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
                        var mpnwplink = document.getElementById("nwpr__link'.$mpp['id'].'"); mpnwplink.addEventListener("click", function () { window.location.href = "/webshop/?id="+mpnwplink.getAttribute("pid")+"&method=50"; });

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
        </section> ';
    }
?>
<!-- Uj termekek szekcioja -->
<section id='new_products' class='main_section'>
    <script>
        let wdt = document.getElementById('new_products').offsetWidth;
        $.ajax({ type: "POST", url: "/assets/php/resp.php", data: {"width": wdt} });
    </script>
    <div class='flex flex-align-c flex-justify-con-sb'>
        <span class='section_title'>Új Termékek</span>
    </div>
    <div class='section_body flex gap-1 overflow-auto' id="c__desk">
        <?php
            include '/assets/php/resp.php';
            if (isset($_SESSION['loggedin'])) { if (isset($_SESSION['id'])) { $uid = $_SESSION['id']; } } $row = 3; $offset = ((floor(($_SESSION['e__width']/184)/1)*1)*3)-1;
            if ($_SESSION['e__width'] < 365) { 
                $pr_sql = "SELECT products.id, products.name, products.description, products.thumbnail, products__inventory.quantity, products__inventory.code, products__variations.color, products__variations.brand, products__pricing.base FROM products INNER JOIN products__inventory ON products__inventory.pid = products.id INNER JOIN products__variations ON products__variations.pid = products.id INNER JOIN products__pricing ON products__pricing.pid = products.id WHERE products.id NOT IN (SELECT products__pricing.pid FROM products__pricing WHERE discounted IS TRUE) AND quantity > 5 ORDER BY added DESC LIMIT 1, 12";
            }
            else {
                if ((184*(round(($_SESSION['e__width'])/184))+1) < $_SESSION['e__width']) { echo "<script>document.getElementById('c__desk').classList.add('flex-justify-con-c');</script>";
                    $pr_sql = "SELECT products.id, products.name, products.description, products.thumbnail, products__inventory.quantity, products__inventory.code, products__variations.color, products__variations.brand, products__pricing.base FROM products INNER JOIN products__inventory ON products__inventory.pid = products.id INNER JOIN products__variations ON products__variations.pid = products.id INNER JOIN products__pricing ON products__pricing.pid = products.id WHERE products.id NOT IN (SELECT products__pricing.pid FROM products__pricing WHERE discounted IS TRUE) AND quantity > 5 ORDER BY added DESC LIMIT 1, $offset";
                } else { echo "<script>document.getElementById('c__desk').classList.add('flex-justify-con-c');</script>";
                    $offset = $offset; $pr_sql = "SELECT products.id, products.name, products.description, products.thumbnail, products__inventory.quantity, products__inventory.code, products__variations.color, products__variations.brand, products__pricing.base FROM products INNER JOIN products__inventory ON products__inventory.pid = products.id INNER JOIN products__variations ON products__variations.pid = products.id INNER JOIN products__pricing ON products__pricing.pid = products.id WHERE products.id NOT IN (SELECT products__pricing.pid FROM products__pricing WHERE discounted IS TRUE) AND quantity > 5 ORDER BY added DESC LIMIT 1, $offset";
                }
            }
            $pr_res = $con-> query($pr_sql);
            if ($pr_res-> num_rows > 0) {
                while ($product = $pr_res-> fetch_assoc()) { $pid = $product['id'];
                    echo '
                    <div class="flex flex-col item-bg border-softer box-shadow nwp__card">
                        <label search-key="'; echo $product['brand'] . ' '; echo strtr($product['brand'], $unwanted_array) . ' '; echo $product['name'] . ' '; echo strtr($product['name'], $unwanted_array) . ' '; echo $product['base'] . ' '; echo $product['code']; echo '"></label>
                        <div class="flex flex-row flex-align-c flex-justify-con-sb padding-05">
                            <div class="flex flex-row flex-justify-con-c flex-align-c">
                                '; $ssql = "SELECT stars FROM reviews WHERE pid = $pid"; $sres = $con-> query($ssql); $son = 0; $stw = 0; $sth = 0; $sfo = 0; $sfi = 0; $savg = 0;
                                if ($sres-> num_rows > 0) { while ($star = $sres-> fetch_assoc()) { $stv = $star['stars']; if ($stv == 5) { $sfi += 1; } if ($stv == 4) { $sfo += 1; } if ($stv == 3) { $sth += 1; } if ($stv == 2) { $stw += 1; } if ($stv == 1) { $son += 1; } $dv = ($sfi + $sfo + $sth + $stw + $son); }
                                $savg = ((5 * $sfi) + (4 * $sfo) + (3 * $sth) + (2 * $stw) + (1 * $son)) / $dv; $st__avg = round($savg * 10) / 10;
                                    echo ' <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="22px" height="22px" viewBox="0 0 24 24" version="1.1"><g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"><polygon points="0 0 24 0 24 24 0 24"></polygon><path d="M12,18 L7.91561963,20.1472858 C7.42677504,20.4042866 6.82214789,20.2163401 6.56514708,19.7274955 C6.46280801,19.5328351 6.42749334,19.309867 6.46467018,19.0931094 L7.24471742,14.545085 L3.94038429,11.3241562 C3.54490071,10.938655 3.5368084,10.3055417 3.92230962,9.91005817 C4.07581822,9.75257453 4.27696063,9.65008735 4.49459766,9.61846284 L9.06107374,8.95491503 L11.1032639,4.81698575 C11.3476862,4.32173209 11.9473121,4.11839309 12.4425657,4.36281539 C12.6397783,4.46014562 12.7994058,4.61977315 12.8967361,4.81698575 L14.9389263,8.95491503 L19.5054023,9.61846284 C20.0519472,9.69788046 20.4306287,10.2053233 20.351211,10.7518682 C20.3195865,10.9695052 20.2170993,11.1706476 20.0596157,11.3241562 L16.7552826,14.545085 L17.5353298,19.0931094 C17.6286908,19.6374458 17.263103,20.1544017 16.7187666,20.2477627 C16.5020089,20.2849396 16.2790408,20.2496249 16.0843804,20.1472858 L12,18 Z" fill="#f6cc00"></path></g></svg> <span class="flex text-primary small bold">'.$st__avg.'</span>';
                                } else {  echo '<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="22px" height="22px" viewBox="0 0 24 24" version="1.1"><g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"><polygon points="0 0 24 0 24 24 0 24"></polygon><path d="M12,18 L7.91561963,20.1472858 C7.42677504,20.4042866 6.82214789,20.2163401 6.56514708,19.7274955 C6.46280801,19.5328351 6.42749334,19.309867 6.46467018,19.0931094 L7.24471742,14.545085 L3.94038429,11.3241562 C3.54490071,10.938655 3.5368084,10.3055417 3.92230962,9.91005817 C4.07581822,9.75257453 4.27696063,9.65008735 4.49459766,9.61846284 L9.06107374,8.95491503 L11.1032639,4.81698575 C11.3476862,4.32173209 11.9473121,4.11839309 12.4425657,4.36281539 C12.6397783,4.46014562 12.7994058,4.61977315 12.8967361,4.81698575 L14.9389263,8.95491503 L19.5054023,9.61846284 C20.0519472,9.69788046 20.4306287,10.2053233 20.351211,10.7518682 C20.3195865,10.9695052 20.2170993,11.1706476 20.0596157,11.3241562 L16.7552826,14.545085 L17.5353298,19.0931094 C17.6286908,19.6374458 17.263103,20.1544017 16.7187666,20.2477627 C16.5020089,20.2849396 16.2790408,20.2496249 16.0843804,20.1472858 L12,18 Z" fill="#f6cc00" opacity=".6"></path></g></svg><span class="flex text-secondary small bold">0.0</span>'; } echo '
                            </div>
                            <div class="flex pointer" aria-label="Termék mentése">
                                ';
                                if (isset($uid)) { $bksql = "SELECT * FROM bookmarks WHERE uid = '". $uid ."' AND product_id = '".$product['id']."'"; $bkres = $con-> query($bksql);
                                    if ($bkres-> num_rows > 0) {echo '<div class="product_act_btn product_bookmark" action="1" code="'; echo $product['code']; echo'" keyid="'; echo $product['id']; echo'"><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1"><g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"><rect x="0" y="0" width="24" height="24"/><path d="M8,4 L16,4 C17.1045695,4 18,4.8954305 18,6 L18,17.726765 C18,18.2790497 17.5522847,18.726765 17,18.726765 C16.7498083,18.726765 16.5087052,18.6329798 16.3242754,18.4639191 L12.6757246,15.1194142 C12.2934034,14.7689531 11.7065966,14.7689531 11.3242754,15.1194142 L7.67572463,18.4639191 C7.26860564,18.8371115 6.63603827,18.8096086 6.26284586,18.4024896 C6.09378519,18.2180598 6,17.9769566 6,17.726765 L6,6 C6,4.8954305 6.8954305,4 8,4 Z" class="svg"/></g></svg></div>';} 
                                    else {echo '<div class="product_act_btn product_bookmark" action="0" code="'; echo $product['code']; echo'" keyid="'; echo $product['id']; echo'"><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1"><g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"><rect x="0" y="0" width="24" height="24"/><path d="M8,4 L16,4 C17.1045695,4 18,4.8954305 18,6 L18,17.726765 C18,18.2790497 17.5522847,18.726765 17,18.726765 C16.7498083,18.726765 16.5087052,18.6329798 16.3242754,18.4639191 L12.6757246,15.1194142 C12.2934034,14.7689531 11.7065966,14.7689531 11.3242754,15.1194142 L7.67572463,18.4639191 C7.26860564,18.8371115 6.63603827,18.8096086 6.26284586,18.4024896 C6.09378519,18.2180598 6,17.9769566 6,17.726765 L6,6 C6,4.8954305 6.8954305,4 8,4 Z" class="svg-stroke"/></g></svg></div>';}
                                } else {echo '<div class="product_act_btn" onclick="openHeaderProfileAction();"><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1"><g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"><rect x="0" y="0" width="24" height="24"/><path d="M8,4 L16,4 C17.1045695,4 18,4.8954305 18,6 L18,17.726765 C18,18.2790497 17.5522847,18.726765 17,18.726765 C16.7498083,18.726765 16.5087052,18.6329798 16.3242754,18.4639191 L12.6757246,15.1194142 C12.2934034,14.7689531 11.7065966,14.7689531 11.3242754,15.1194142 L7.67572463,18.4639191 C7.26860564,18.8371115 6.63603827,18.8096086 6.26284586,18.4024896 C6.09378519,18.2180598 6,17.9769566 6,17.726765 L6,6 C6,4.8954305 6.8954305,4 8,4 Z" class="svg-stroke"/></g></svg></div>';}
                                echo '
                            </div>
                        </div>
                        <div class="flex flex-col flex-align-c product-link pointer" auid="'.$product['id'].'">
                            <img src="/assets/images/uploads/'.$product['thumbnail'].'" alt="'.mb_substr($product['description'], 0, 60).'" style="width: 8rem;" />
                            <span class="text-secondary bold small-med uppercase">'.strtoupper($product['brand']).'</span>
                        </div>
                        <div class="flex flex-row flex-justify-con-sb">
                            <div class="flex flex-col gap-05 padding-05">';
                                if (strlen($product['name']) >= 15) { echo '<span class="text-primary small bold pointer product-link" auid="'.$product['id'].'">'.$product['name'].'</span>';
                                } else { echo '<span class="text-primary small bold pointer capitalize product-link" auid="'.$product['id'].'">'.$product['color'].' '.$product['name'].'</span>'; }
                                echo '
                                <span class="text-secondary small formatted-price bold" id="formatted-price-'.$product['id'].'">'.$product['base'].'</span>
                            </div>
                            <div class="flex flex-col flex-justify-con-c flex-align-c border-softer pointer product-basket" aria-label="Kosárhoz adás">
                                ';
                                if (isset($uid)) { $bksql = "SELECT * FROM cart WHERE uid = '". $uid ."' AND pid = '".$product['id']."'"; $bkres = $con-> query($bksql);
                                    if ($bkres-> num_rows > 0) { echo '<div class="product_act_btn flex flex-col flex-align-c flex-justify-con-c cart__button" action="1" code="'; echo $product['code']; echo'" bkeyid="'; echo $product['id']; echo'"><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1"><g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"><rect x="0" y="0" width="24" height="24"></rect><path d="M12,4.56204994 L7.76822128,9.6401844 C7.4146572,10.0644613 6.7840925,10.1217854 6.3598156,9.76822128 C5.9355387,9.4146572 5.87821464,8.7840925 6.23177872,8.3598156 L11.2317787,2.3598156 C11.6315738,1.88006147 12.3684262,1.88006147 12.7682213,2.3598156 L17.7682213,8.3598156 C18.1217854,8.7840925 18.0644613,9.4146572 17.6401844,9.76822128 C17.2159075,10.1217854 16.5853428,10.0644613 16.2317787,9.6401844 L12,4.56204994 Z" class="svg" fill-rule="nonzero" opacity="0.3"></path><path d="M3.28077641,9 L20.7192236,9 C21.2715083,9 21.7192236,9.44771525 21.7192236,10 C21.7192236,10.0817618 21.7091962,10.163215 21.6893661,10.2425356 L19.5680983,18.7276069 C19.234223,20.0631079 18.0342737,21 16.6576708,21 L7.34232922,21 C5.96572629,21 4.76577697,20.0631079 4.43190172,18.7276069 L2.31063391,10.2425356 C2.17668518,9.70674072 2.50244587,9.16380623 3.03824078,9.0298575 C3.11756139,9.01002735 3.1990146,9 3.28077641,9 Z M12,12 C11.4477153,12 11,12.4477153 11,13 L11,17 C11,17.5522847 11.4477153,18 12,18 C12.5522847,18 13,17.5522847 13,17 L13,13 C13,12.4477153 12.5522847,12 12,12 Z M6.96472382,12.1362967 C6.43125772,12.2792385 6.11467523,12.8275755 6.25761704,13.3610416 L7.29289322,17.2247449 C7.43583503,17.758211 7.98417199,18.0747935 8.51763809,17.9318517 C9.05110419,17.7889098 9.36768668,17.2405729 9.22474487,16.7071068 L8.18946869,12.8434035 C8.04652688,12.3099374 7.49818992,11.9933549 6.96472382,12.1362967 Z M17.0352762,12.1362967 C16.5018101,11.9933549 15.9534731,12.3099374 15.8105313,12.8434035 L14.7752551,16.7071068 C14.6323133,17.2405729 14.9488958,17.7889098 15.4823619,17.9318517 C16.015828,18.0747935 16.564165,17.758211 16.7071068,17.2247449 L17.742383,13.3610416 C17.8853248,12.8275755 17.5687423,12.2792385 17.0352762,12.1362967 Z" class="svg"></path></g></svg><span class="product-basket-ind"></span></div>';} 
                                    else { echo '<div class="flex flex-col flex-align-c flex-justify-con-c product_act_btn cart__button" action="0" code="'; echo $product['code']; echo'" bkeyid="'; echo $product['id']; echo'"><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1"><g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"><rect x="0" y="0" width="24" height="24"></rect><path d="M12,4.56204994 L7.76822128,9.6401844 C7.4146572,10.0644613 6.7840925,10.1217854 6.3598156,9.76822128 C5.9355387,9.4146572 5.87821464,8.7840925 6.23177872,8.3598156 L11.2317787,2.3598156 C11.6315738,1.88006147 12.3684262,1.88006147 12.7682213,2.3598156 L17.7682213,8.3598156 C18.1217854,8.7840925 18.0644613,9.4146572 17.6401844,9.76822128 C17.2159075,10.1217854 16.5853428,10.0644613 16.2317787,9.6401844 L12,4.56204994 Z" class="svg" fill-rule="nonzero" opacity="0.3"></path><path d="M3.28077641,9 L20.7192236,9 C21.2715083,9 21.7192236,9.44771525 21.7192236,10 C21.7192236,10.0817618 21.7091962,10.163215 21.6893661,10.2425356 L19.5680983,18.7276069 C19.234223,20.0631079 18.0342737,21 16.6576708,21 L7.34232922,21 C5.96572629,21 4.76577697,20.0631079 4.43190172,18.7276069 L2.31063391,10.2425356 C2.17668518,9.70674072 2.50244587,9.16380623 3.03824078,9.0298575 C3.11756139,9.01002735 3.1990146,9 3.28077641,9 Z M12,12 C11.4477153,12 11,12.4477153 11,13 L11,17 C11,17.5522847 11.4477153,18 12,18 C12.5522847,18 13,17.5522847 13,17 L13,13 C13,12.4477153 12.5522847,12 12,12 Z M6.96472382,12.1362967 C6.43125772,12.2792385 6.11467523,12.8275755 6.25761704,13.3610416 L7.29289322,17.2247449 C7.43583503,17.758211 7.98417199,18.0747935 8.51763809,17.9318517 C9.05110419,17.7889098 9.36768668,17.2405729 9.22474487,16.7071068 L8.18946869,12.8434035 C8.04652688,12.3099374 7.49818992,11.9933549 6.96472382,12.1362967 Z M17.0352762,12.1362967 C16.5018101,11.9933549 15.9534731,12.3099374 15.8105313,12.8434035 L14.7752551,16.7071068 C14.6323133,17.2405729 14.9488958,17.7889098 15.4823619,17.9318517 C16.015828,18.0747935 16.564165,17.758211 16.7071068,17.2247449 L17.742383,13.3610416 C17.8853248,12.8275755 17.5687423,12.2792385 17.0352762,12.1362967 Z" class="svg"></path></g></svg></div>';}
                                } else { echo '<div class="product_act_btn" onclick="openHeaderProfileAction();"><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1"><g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"><rect x="0" y="0" width="24" height="24"></rect><path d="M12,4.56204994 L7.76822128,9.6401844 C7.4146572,10.0644613 6.7840925,10.1217854 6.3598156,9.76822128 C5.9355387,9.4146572 5.87821464,8.7840925 6.23177872,8.3598156 L11.2317787,2.3598156 C11.6315738,1.88006147 12.3684262,1.88006147 12.7682213,2.3598156 L17.7682213,8.3598156 C18.1217854,8.7840925 18.0644613,9.4146572 17.6401844,9.76822128 C17.2159075,10.1217854 16.5853428,10.0644613 16.2317787,9.6401844 L12,4.56204994 Z" class="svg" fill-rule="nonzero" opacity="0.3"></path><path d="M3.28077641,9 L20.7192236,9 C21.2715083,9 21.7192236,9.44771525 21.7192236,10 C21.7192236,10.0817618 21.7091962,10.163215 21.6893661,10.2425356 L19.5680983,18.7276069 C19.234223,20.0631079 18.0342737,21 16.6576708,21 L7.34232922,21 C5.96572629,21 4.76577697,20.0631079 4.43190172,18.7276069 L2.31063391,10.2425356 C2.17668518,9.70674072 2.50244587,9.16380623 3.03824078,9.0298575 C3.11756139,9.01002735 3.1990146,9 3.28077641,9 Z M12,12 C11.4477153,12 11,12.4477153 11,13 L11,17 C11,17.5522847 11.4477153,18 12,18 C12.5522847,18 13,17.5522847 13,17 L13,13 C13,12.4477153 12.5522847,12 12,12 Z M6.96472382,12.1362967 C6.43125772,12.2792385 6.11467523,12.8275755 6.25761704,13.3610416 L7.29289322,17.2247449 C7.43583503,17.758211 7.98417199,18.0747935 8.51763809,17.9318517 C9.05110419,17.7889098 9.36768668,17.2405729 9.22474487,16.7071068 L8.18946869,12.8434035 C8.04652688,12.3099374 7.49818992,11.9933549 6.96472382,12.1362967 Z M17.0352762,12.1362967 C16.5018101,11.9933549 15.9534731,12.3099374 15.8105313,12.8434035 L14.7752551,16.7071068 C14.6323133,17.2405729 14.9488958,17.7889098 15.4823619,17.9318517 C16.015828,18.0747935 16.564165,17.758211 16.7071068,17.2247449 L17.742383,13.3610416 C17.8853248,12.8275755 17.5687423,12.2792385 17.0352762,12.1362967 Z" class="svg"></path></g></svg></div>';}
                                echo '
                            </div>
                        </div>
                    </div>
                    <script>document.getElementById("formatted-price-'.$product['id'].'").textContent = formatter.format('.$product['base'].');</script>
                    ';
                }
            } else { echo "<script>document.getElementById('new_products').remove();</script>"; }
        ?>
        <div class='product_card flex'>
            <div class="flex flex-col flex-align-c flex-justify-con-c h-100">
                <span><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="64px" height="64px" viewBox="0 0 24 24" version="1.1"><g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"><polygon points="0 0 24 0 24 24 0 24"/><rect class="svg" opacity="0.3" transform="translate(8.500000, 12.000000) rotate(-90.000000) translate(-8.500000, -12.000000) " x="7.5" y="7.5" width="2" height="9" rx="1"/><path d="M9.70710318,15.7071045 C9.31657888,16.0976288 8.68341391,16.0976288 8.29288961,15.7071045 C7.90236532,15.3165802 7.90236532,14.6834152 8.29288961,14.2928909 L14.2928896,8.29289093 C14.6714686,7.914312 15.281055,7.90106637 15.675721,8.26284357 L21.675721,13.7628436 C22.08284,14.136036 22.1103429,14.7686034 21.7371505,15.1757223 C21.3639581,15.5828413 20.7313908,15.6103443 20.3242718,15.2371519 L15.0300721,10.3841355 L9.70710318,15.7071045 Z" class="svg" fill-rule="nonzero" transform="translate(14.999999, 11.999997) scale(1, -1) rotate(90.000000) translate(-14.999999, -11.999997) "/></g></svg></span>
                <span class="text-primary text-align-c">Összes megtekintése</span>
            </div>
        </div>
    </div>
</section>
<!-- Legnagyobb akcioval rendelkezo termek szekcioja -->
<?php
    $pr_sql = "SELECT products.*, product_discount.discount, product_discount.new_price, product_discount.end FROM products INNER JOIN product_discount ON products.product_id = product_discount.product_id WHERE product_quantity > 5 AND product_discount.end > NOW() ORDER BY product_discount.discount DESC LIMIT 1";
    $pr_res = $con-> query($pr_sql);
    if ($pr_res-> num_rows > 0) { $product = $pr_res-> fetch_assoc(); $prid = $product['product_id']; echo '
        <section class="dom__color main_section padding-1 border-soft relative" id="dom__color'.$prid.'">';
            $pr_sql = "SELECT products.*, product_discount.discount, product_discount.new_price, product_discount.end FROM products INNER JOIN product_discount ON products.product_id = product_discount.product_id WHERE product_quantity > 5 AND product_discount.end > NOW() ORDER BY product_discount.discount DESC LIMIT 1";
            $pr_res = $con-> query($pr_sql);
            if ($pr_res-> num_rows > 0) {
                $product = $pr_res-> fetch_assoc(); $pcs = $product['product_code']; $pc = substr($product['product_code'],0,-3);
                $sm__sql = "SELECT * FROM products WHERE product_code LIKE '%$pc%' AND product_code NOT LIKE '$pcs'"; echo '
                    <img id="nwpr__img'.$prid.'" class="dc__img drop-shadow floating absolute" src="/assets/images/uploads/'.$product['product_image'].'">
                    <div class="nwpr__info flex flex-col padding-1 gap-1 nwst__info" id="nwst__info'.$prid.'">
                        <div class="flex flex-row flex-align-c gap-1">
                            <span class="text-xxl flex flex-row flex-align-c gap-1 bold">'.$product['product_brand'].' '.$product['product_code'].','.$product['product_name'].' - '.$product['product_color'].'</span>
                        </div>
                        <span class="nwpri__desc">'.mb_substr($product['product_info'], 0, 205).'...</span>
                        <div class="flex flex-col gap-05">
                            <div class="flex flex-row flex-align-c gap-1">
                                <div id="nwpr__link'.$prid.'" class="button button-dgcp nwpr__link flex w-fc" pid="'.$product['product_id'].'">Termék megtekintése</div>
                                <span class="product_ribbon bold w-fc" style="font-size: 1rem;">'.$product['discount'].'%</span>
                            </div>
                            <span class="small-med">Az akció <b>'.$product['end'].'</b>-ig, illetve a készlet erejéig tart.</span>
                        </div>
                        '; $sm_res = $con-> query($sm__sql);
                        if ($sm_res-> num_rows > 0) { 
                            echo '<div class="pcsi__con flex flex-col flex-align-c gap-1">
                            <span class="bold">Elérhető szín variációk</span>
                            <div class="flex flex-row gap-1">
                            ';
                            while ($smp = $sm_res-> fetch_assoc()) {
                                echo '
                                    <div class="flex flex-col flex-align-c flex-justify-con-c">
                                        <a class="pointer ease scale-1" href="/webshop/?id='.$smp['product_id'].'&method=50"><img class="pcs__image drop-shadow" src="/assets/images/uploads/'.$smp['product_image'].'" alt="'.$smp['product_color'].'"></a>
                                        <span class="small-med bold capitalize">'.$smp['product_color'].'</span>
                                    </div>
                                ';
                            } echo '</div></div>';
                        } echo '
                    </div>
                ';
            } echo '
            <script content-type="application/javascript">
                var nwplink = document.getElementById("nwpr__link'.$prid.'"); nwplink.addEventListener("click", function () { window.location.href = "/webshop/?id="+nwplink.getAttribute("pid")+"&method=50"; });

                function addImage(file) { var img = document.getElementById("nwpr__img'.$prid.'"); img.src = file; img.onload = function() { var rgb = getAverageColor(img); var rgbStr = "rgb(" + rgb.r + ", " + rgb.g + ", " + rgb.b + ")"; var hsl = rgbToHsl(rgb.r, rgb.g, rgb.b); var hslStr = "hsl(" + Math.round(hsl.h * 360) + ", " + Math.round(hsl.s * 100) + "%, " + Math.round(hsl.l * 100) + "%)"; var hexStr = "#" + ("0"+rgb.r.toString(16)).slice(-2) + ("0"+rgb.g.toString(16)).slice(-2) + ("0"+rgb.b.toString(16)).slice(-2); $("#dom__color'.$prid.'").css("background-color", rgbStr); document.getElementById("nwst__info'.$prid.'").style.color = "#"+contrastingColor(hexStr.replace("#", "")); var bdgcp = document.getElementsByClassName("button-dgcp"); for (let i = 0; i < bdgcp.length; i++) { bdgcp[i].style.border = "1px solid #"+contrastingColor(hexStr.replace("#", "")); } }; }
                function getAverageColor(img) { var canvas = document.createElement("canvas"); var ctx = canvas.getContext("2d");var width = canvas.width = img.naturalWidth;var height = canvas.height = img.naturalHeight; ctx.drawImage(img, 0, 0); var imageData = ctx.getImageData(0, 0, width, height); var data = imageData.data;
                var r = 0;var g = 0;var b = 0; for (var i = 0, l = data.length; i < l; i += 4) { r += data[i]; g += data[i+1]; b += data[i+2]; } r = Math.floor(r / (data.length / 4)); g = Math.floor(g / (data.length / 4)); b = Math.floor(b / (data.length / 4)); return { r: r, g: g, b: b }; }
                function handleImages(files) {addImage(files); } handleImages($("#nwpr__img'.$prid.'").attr("src")); function rgbToHsl(r, g, b) { r /= 255; g /= 255; b /= 255;var max = Math.max(r, g, b), min = Math.min(r, g, b);var h, s, l = (max + min) / 2;if (max == min) {h = s = 0;} else {var d = max - min;s = l > 0.5 ? d / (2 - max - min) : d / (max + min);switch (max) {case r: h = (g - b) / d + (g < b ? 6 : 0); break;case g: h = (b - r) / d + 2; break;case b: h = (r - g) / d + 4; break;}h /= 6;} return { h: h, s: s, l: l }; }

                function contrastingColor(color) { return (luma(color) >= 165) ? "000" : "fff"; }
                function luma(color) { var rgb = (typeof color === "string") ? hexToRGBArray(color) : color; return (0.2126 * rgb[0]) + (0.7152 * rgb[1]) + (0.0722 * rgb[2]); }
                function hexToRGBArray(color) { if (color.length === 3) { color = color.charAt(0) + color.charAt(0) + color.charAt(1) + color.charAt(1) + color.charAt(2) + color.charAt(2); }
                else if (color.length !== 6) { throw("Invalid hex color: " + color); } var rgb = []; for (var i = 0; i <= 2; i++) { rgb[i] = parseInt(color.substr(i * 2, 2), 16); } return rgb; }
            </script>
        </section> ';
    }
?>
<!-- Leertekelt termekek szekcioja -->
<section id='discounted_products' class='main_section'>
    <div class='flex flex-align-c flex-justify-con-sb'>
        <span class='section_title'>Akciós Termékek</span>
    </div>
    <div class='section_body flex gap-1 overflow-auto'>
        <?php
            $pr_sql = "SELECT products.*, product_discount.discount, product_discount.new_price FROM products INNER JOIN product_discount ON products.product_id = product_discount.product_id WHERE product_quantity > 5 AND product_discount.end > NOW() ORDER BY product_discount.discount DESC LIMIT 1, 13";
            $pr_res = $con-> query($pr_sql);
            if ($pr_res-> num_rows > 0) {
                while ($product = $pr_res-> fetch_assoc()) { $pid = $product['product_id'];
                    echo '
                    <div class="flex flex-col item-bg border-softer box-shadow nwp__card">
                        <label search-key="'; echo $product['product_brand'] . ' '; echo strtr($product['product_brand'], $unwanted_array) . ' '; echo $product['product_name'] . ' '; echo strtr($product['product_name'], $unwanted_array) . ' '; echo $product['product_price'] . ' '; echo $product['product_code']; echo '"></label>
                        <div class="flex flex-row flex-align-c flex-justify-con-sb padding-05">
                            <div class="flex flex-row flex-justify-con-c flex-align-c">
                                '; $ssql = "SELECT stars FROM reviews WHERE pid = $pid"; $sres = $con-> query($ssql); $son = 0; $stw = 0; $sth = 0; $sfo = 0; $sfi = 0; $savg = 0;
                                if ($sres-> num_rows > 0) { while ($star = $sres-> fetch_assoc()) { $stv = $star['stars']; if ($stv == 5) { $sfi += 1; } if ($stv == 4) { $sfo += 1; } if ($stv == 3) { $sth += 1; } if ($stv == 2) { $stw += 1; } if ($stv == 1) { $son += 1; } $dv = ($sfi + $sfo + $sth + $stw + $son); }
                                $savg = ((5 * $sfi) + (4 * $sfo) + (3 * $sth) + (2 * $stw) + (1 * $son)) / $dv; $st__avg = round($savg * 10) / 10;
                                    echo ' <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="22px" height="22px" viewBox="0 0 24 24" version="1.1"><g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"><polygon points="0 0 24 0 24 24 0 24"></polygon><path d="M12,18 L7.91561963,20.1472858 C7.42677504,20.4042866 6.82214789,20.2163401 6.56514708,19.7274955 C6.46280801,19.5328351 6.42749334,19.309867 6.46467018,19.0931094 L7.24471742,14.545085 L3.94038429,11.3241562 C3.54490071,10.938655 3.5368084,10.3055417 3.92230962,9.91005817 C4.07581822,9.75257453 4.27696063,9.65008735 4.49459766,9.61846284 L9.06107374,8.95491503 L11.1032639,4.81698575 C11.3476862,4.32173209 11.9473121,4.11839309 12.4425657,4.36281539 C12.6397783,4.46014562 12.7994058,4.61977315 12.8967361,4.81698575 L14.9389263,8.95491503 L19.5054023,9.61846284 C20.0519472,9.69788046 20.4306287,10.2053233 20.351211,10.7518682 C20.3195865,10.9695052 20.2170993,11.1706476 20.0596157,11.3241562 L16.7552826,14.545085 L17.5353298,19.0931094 C17.6286908,19.6374458 17.263103,20.1544017 16.7187666,20.2477627 C16.5020089,20.2849396 16.2790408,20.2496249 16.0843804,20.1472858 L12,18 Z" fill="#f6cc00"></path></g></svg> <span class="flex text-primary small bold">'.$st__avg.'</span>';
                                } else {  echo '<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="22px" height="22px" viewBox="0 0 24 24" version="1.1"><g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"><polygon points="0 0 24 0 24 24 0 24"></polygon><path d="M12,18 L7.91561963,20.1472858 C7.42677504,20.4042866 6.82214789,20.2163401 6.56514708,19.7274955 C6.46280801,19.5328351 6.42749334,19.309867 6.46467018,19.0931094 L7.24471742,14.545085 L3.94038429,11.3241562 C3.54490071,10.938655 3.5368084,10.3055417 3.92230962,9.91005817 C4.07581822,9.75257453 4.27696063,9.65008735 4.49459766,9.61846284 L9.06107374,8.95491503 L11.1032639,4.81698575 C11.3476862,4.32173209 11.9473121,4.11839309 12.4425657,4.36281539 C12.6397783,4.46014562 12.7994058,4.61977315 12.8967361,4.81698575 L14.9389263,8.95491503 L19.5054023,9.61846284 C20.0519472,9.69788046 20.4306287,10.2053233 20.351211,10.7518682 C20.3195865,10.9695052 20.2170993,11.1706476 20.0596157,11.3241562 L16.7552826,14.545085 L17.5353298,19.0931094 C17.6286908,19.6374458 17.263103,20.1544017 16.7187666,20.2477627 C16.5020089,20.2849396 16.2790408,20.2496249 16.0843804,20.1472858 L12,18 Z" fill="#f6cc00" opacity=".6"></path></g></svg><span class="flex text-secondary small bold">0.0</span>'; } echo '
                            </div>
                            <div class="flex flex-row flex-align-c gap-05">
                                <span class="product_ribbon">'; echo strtoupper($product['discount']); echo '%</span>
                                <div class="flex flex-align-c pointer" aria-label="Termék mentése">
                                    ';
                                    if (isset($uid)) { $bksql = "SELECT * FROM bookmarks WHERE uid = '". $uid ."' AND product_id = '".$product['product_id']."'"; $bkres = $con-> query($bksql);
                                        if ($bkres-> num_rows > 0) {echo '<div class="flex flex-align-c product_act_btn product_bookmark" action="1" code="'; echo $product['product_code']; echo'" keyid="'; echo $product['product_id']; echo'"><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1"><g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"><rect x="0" y="0" width="24" height="24"/><path d="M8,4 L16,4 C17.1045695,4 18,4.8954305 18,6 L18,17.726765 C18,18.2790497 17.5522847,18.726765 17,18.726765 C16.7498083,18.726765 16.5087052,18.6329798 16.3242754,18.4639191 L12.6757246,15.1194142 C12.2934034,14.7689531 11.7065966,14.7689531 11.3242754,15.1194142 L7.67572463,18.4639191 C7.26860564,18.8371115 6.63603827,18.8096086 6.26284586,18.4024896 C6.09378519,18.2180598 6,17.9769566 6,17.726765 L6,6 C6,4.8954305 6.8954305,4 8,4 Z" class="svg"/></g></svg></div>';} 
                                        else {echo '<div class="flex flex-align-c product_act_btn product_bookmark" action="0" code="'; echo $product['product_code']; echo'" keyid="'; echo $product['product_id']; echo'"><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1"><g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"><rect x="0" y="0" width="24" height="24"/><path d="M8,4 L16,4 C17.1045695,4 18,4.8954305 18,6 L18,17.726765 C18,18.2790497 17.5522847,18.726765 17,18.726765 C16.7498083,18.726765 16.5087052,18.6329798 16.3242754,18.4639191 L12.6757246,15.1194142 C12.2934034,14.7689531 11.7065966,14.7689531 11.3242754,15.1194142 L7.67572463,18.4639191 C7.26860564,18.8371115 6.63603827,18.8096086 6.26284586,18.4024896 C6.09378519,18.2180598 6,17.9769566 6,17.726765 L6,6 C6,4.8954305 6.8954305,4 8,4 Z" class="svg-stroke"/></g></svg></div>';}
                                    } else {echo '<div class="flex flex-align-c product_act_btn" onclick="openHeaderProfileAction();"><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1"><g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"><rect x="0" y="0" width="24" height="24"/><path d="M8,4 L16,4 C17.1045695,4 18,4.8954305 18,6 L18,17.726765 C18,18.2790497 17.5522847,18.726765 17,18.726765 C16.7498083,18.726765 16.5087052,18.6329798 16.3242754,18.4639191 L12.6757246,15.1194142 C12.2934034,14.7689531 11.7065966,14.7689531 11.3242754,15.1194142 L7.67572463,18.4639191 C7.26860564,18.8371115 6.63603827,18.8096086 6.26284586,18.4024896 C6.09378519,18.2180598 6,17.9769566 6,17.726765 L6,6 C6,4.8954305 6.8954305,4 8,4 Z" class="svg-stroke"/></g></svg></div>';}
                                    echo '
                                </div>
                            </div>
                        </div>
                        <div class="flex flex-col flex-align-c product-link pointer" auid="'.$product['product_id'].'">
                            <img src="/assets/images/uploads/'.$product['product_image'].'" alt="'.mb_substr($product['product_info'], 0, 60).'" style="width: 8rem;" />
                            <span class="text-secondary bold small-med uppercase">'.strtoupper($product['product_brand']).'</span>
                        </div>
                        <div class="flex flex-row flex-justify-con-sb">
                            <div class="flex flex-col gap-05 padding-05">';
                                if (strlen($product['product_name']) >= 15) { echo '<span class="text-primary small bold pointer product-link" auid="'.$product['product_id'].'">'.$product['product_name'].'</span>';
                                } else { echo '<span class="text-primary small bold pointer capitalize product-link" auid="'.$product['product_id'].'">'.$product['product_color'].' '.$product['product_name'].'</span>'; }
                                echo '
                                <div class="flex flex-row flex-align-c gap-05">
                                    <del><em><span class="text-secondary small-med formatted-price" id="ds-formatted-price-'.$product['product_id'].'">'.$product['product_price'].'</span></em></del>
                                    <span class="text-secondary small bold formatted price" id="dsn-formatted-price-'.$product['product_id'].'""></span>
                                </div>
                            </div>
                            <div class="flex flex-col flex-justify-con-c flex-align-c border-softer pointer product-basket" aria-label="Kosárhoz adás">
                                ';
                                if (isset($uid)) { $bksql = "SELECT * FROM cart WHERE uid = '". $uid ."' AND pid = '".$product['product_id']."'"; $bkres = $con-> query($bksql);
                                    if ($bkres-> num_rows > 0) { echo '<div class="product_act_btn flex flex-col flex-align-c flex-justify-con-c cart__button" action="1" code="'; echo $product['product_code']; echo'" bkeyid="'; echo $product['product_id']; echo'"><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1"><g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"><rect x="0" y="0" width="24" height="24"></rect><path d="M12,4.56204994 L7.76822128,9.6401844 C7.4146572,10.0644613 6.7840925,10.1217854 6.3598156,9.76822128 C5.9355387,9.4146572 5.87821464,8.7840925 6.23177872,8.3598156 L11.2317787,2.3598156 C11.6315738,1.88006147 12.3684262,1.88006147 12.7682213,2.3598156 L17.7682213,8.3598156 C18.1217854,8.7840925 18.0644613,9.4146572 17.6401844,9.76822128 C17.2159075,10.1217854 16.5853428,10.0644613 16.2317787,9.6401844 L12,4.56204994 Z" class="svg" fill-rule="nonzero" opacity="0.3"></path><path d="M3.28077641,9 L20.7192236,9 C21.2715083,9 21.7192236,9.44771525 21.7192236,10 C21.7192236,10.0817618 21.7091962,10.163215 21.6893661,10.2425356 L19.5680983,18.7276069 C19.234223,20.0631079 18.0342737,21 16.6576708,21 L7.34232922,21 C5.96572629,21 4.76577697,20.0631079 4.43190172,18.7276069 L2.31063391,10.2425356 C2.17668518,9.70674072 2.50244587,9.16380623 3.03824078,9.0298575 C3.11756139,9.01002735 3.1990146,9 3.28077641,9 Z M12,12 C11.4477153,12 11,12.4477153 11,13 L11,17 C11,17.5522847 11.4477153,18 12,18 C12.5522847,18 13,17.5522847 13,17 L13,13 C13,12.4477153 12.5522847,12 12,12 Z M6.96472382,12.1362967 C6.43125772,12.2792385 6.11467523,12.8275755 6.25761704,13.3610416 L7.29289322,17.2247449 C7.43583503,17.758211 7.98417199,18.0747935 8.51763809,17.9318517 C9.05110419,17.7889098 9.36768668,17.2405729 9.22474487,16.7071068 L8.18946869,12.8434035 C8.04652688,12.3099374 7.49818992,11.9933549 6.96472382,12.1362967 Z M17.0352762,12.1362967 C16.5018101,11.9933549 15.9534731,12.3099374 15.8105313,12.8434035 L14.7752551,16.7071068 C14.6323133,17.2405729 14.9488958,17.7889098 15.4823619,17.9318517 C16.015828,18.0747935 16.564165,17.758211 16.7071068,17.2247449 L17.742383,13.3610416 C17.8853248,12.8275755 17.5687423,12.2792385 17.0352762,12.1362967 Z" class="svg"></path></g></svg><span class="product-basket-ind"></span></div>';} 
                                    else { echo '<div class="flex flex-col flex-align-c flex-justify-con-c product_act_btn cart__button" action="0" code="'; echo $product['product_code']; echo'" bkeyid="'; echo $product['product_id']; echo'"><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1"><g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"><rect x="0" y="0" width="24" height="24"></rect><path d="M12,4.56204994 L7.76822128,9.6401844 C7.4146572,10.0644613 6.7840925,10.1217854 6.3598156,9.76822128 C5.9355387,9.4146572 5.87821464,8.7840925 6.23177872,8.3598156 L11.2317787,2.3598156 C11.6315738,1.88006147 12.3684262,1.88006147 12.7682213,2.3598156 L17.7682213,8.3598156 C18.1217854,8.7840925 18.0644613,9.4146572 17.6401844,9.76822128 C17.2159075,10.1217854 16.5853428,10.0644613 16.2317787,9.6401844 L12,4.56204994 Z" class="svg" fill-rule="nonzero" opacity="0.3"></path><path d="M3.28077641,9 L20.7192236,9 C21.2715083,9 21.7192236,9.44771525 21.7192236,10 C21.7192236,10.0817618 21.7091962,10.163215 21.6893661,10.2425356 L19.5680983,18.7276069 C19.234223,20.0631079 18.0342737,21 16.6576708,21 L7.34232922,21 C5.96572629,21 4.76577697,20.0631079 4.43190172,18.7276069 L2.31063391,10.2425356 C2.17668518,9.70674072 2.50244587,9.16380623 3.03824078,9.0298575 C3.11756139,9.01002735 3.1990146,9 3.28077641,9 Z M12,12 C11.4477153,12 11,12.4477153 11,13 L11,17 C11,17.5522847 11.4477153,18 12,18 C12.5522847,18 13,17.5522847 13,17 L13,13 C13,12.4477153 12.5522847,12 12,12 Z M6.96472382,12.1362967 C6.43125772,12.2792385 6.11467523,12.8275755 6.25761704,13.3610416 L7.29289322,17.2247449 C7.43583503,17.758211 7.98417199,18.0747935 8.51763809,17.9318517 C9.05110419,17.7889098 9.36768668,17.2405729 9.22474487,16.7071068 L8.18946869,12.8434035 C8.04652688,12.3099374 7.49818992,11.9933549 6.96472382,12.1362967 Z M17.0352762,12.1362967 C16.5018101,11.9933549 15.9534731,12.3099374 15.8105313,12.8434035 L14.7752551,16.7071068 C14.6323133,17.2405729 14.9488958,17.7889098 15.4823619,17.9318517 C16.015828,18.0747935 16.564165,17.758211 16.7071068,17.2247449 L17.742383,13.3610416 C17.8853248,12.8275755 17.5687423,12.2792385 17.0352762,12.1362967 Z" class="svg"></path></g></svg></div>';}
                                } else { echo '<div class="product_act_btn" onclick="openHeaderProfileAction();"><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1"><g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"><rect x="0" y="0" width="24" height="24"></rect><path d="M12,4.56204994 L7.76822128,9.6401844 C7.4146572,10.0644613 6.7840925,10.1217854 6.3598156,9.76822128 C5.9355387,9.4146572 5.87821464,8.7840925 6.23177872,8.3598156 L11.2317787,2.3598156 C11.6315738,1.88006147 12.3684262,1.88006147 12.7682213,2.3598156 L17.7682213,8.3598156 C18.1217854,8.7840925 18.0644613,9.4146572 17.6401844,9.76822128 C17.2159075,10.1217854 16.5853428,10.0644613 16.2317787,9.6401844 L12,4.56204994 Z" class="svg" fill-rule="nonzero" opacity="0.3"></path><path d="M3.28077641,9 L20.7192236,9 C21.2715083,9 21.7192236,9.44771525 21.7192236,10 C21.7192236,10.0817618 21.7091962,10.163215 21.6893661,10.2425356 L19.5680983,18.7276069 C19.234223,20.0631079 18.0342737,21 16.6576708,21 L7.34232922,21 C5.96572629,21 4.76577697,20.0631079 4.43190172,18.7276069 L2.31063391,10.2425356 C2.17668518,9.70674072 2.50244587,9.16380623 3.03824078,9.0298575 C3.11756139,9.01002735 3.1990146,9 3.28077641,9 Z M12,12 C11.4477153,12 11,12.4477153 11,13 L11,17 C11,17.5522847 11.4477153,18 12,18 C12.5522847,18 13,17.5522847 13,17 L13,13 C13,12.4477153 12.5522847,12 12,12 Z M6.96472382,12.1362967 C6.43125772,12.2792385 6.11467523,12.8275755 6.25761704,13.3610416 L7.29289322,17.2247449 C7.43583503,17.758211 7.98417199,18.0747935 8.51763809,17.9318517 C9.05110419,17.7889098 9.36768668,17.2405729 9.22474487,16.7071068 L8.18946869,12.8434035 C8.04652688,12.3099374 7.49818992,11.9933549 6.96472382,12.1362967 Z M17.0352762,12.1362967 C16.5018101,11.9933549 15.9534731,12.3099374 15.8105313,12.8434035 L14.7752551,16.7071068 C14.6323133,17.2405729 14.9488958,17.7889098 15.4823619,17.9318517 C16.015828,18.0747935 16.564165,17.758211 16.7071068,17.2247449 L17.742383,13.3610416 C17.8853248,12.8275755 17.5687423,12.2792385 17.0352762,12.1362967 Z" class="svg"></path></g></svg></div>';}
                                echo '
                            </div>
                        </div>
                    </div>
                    <script>document.getElementById("ds-formatted-price-'.$product['product_id'].'").textContent = formatter.format('.$product['product_price'].'); document.getElementById("dsn-formatted-price-'.$product['product_id'].'").textContent = formatter.format('.$product['new_price'].');</script>
                    ';
                }
            } else { echo "<script>document.getElementById('new_products').remove();</script>"; }
        ?>
        <div class='product_card'>
            <div class="flex flex-col flex-align-c flex-justify-con-c h-100">
                <span><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="64px" height="64px" viewBox="0 0 24 24" version="1.1"><g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"><polygon points="0 0 24 0 24 24 0 24"/><rect class="svg" opacity="0.3" transform="translate(8.500000, 12.000000) rotate(-90.000000) translate(-8.500000, -12.000000) " x="7.5" y="7.5" width="2" height="9" rx="1"/><path d="M9.70710318,15.7071045 C9.31657888,16.0976288 8.68341391,16.0976288 8.29288961,15.7071045 C7.90236532,15.3165802 7.90236532,14.6834152 8.29288961,14.2928909 L14.2928896,8.29289093 C14.6714686,7.914312 15.281055,7.90106637 15.675721,8.26284357 L21.675721,13.7628436 C22.08284,14.136036 22.1103429,14.7686034 21.7371505,15.1757223 C21.3639581,15.5828413 20.7313908,15.6103443 20.3242718,15.2371519 L15.0300721,10.3841355 L9.70710318,15.7071045 Z" class="svg" fill-rule="nonzero" transform="translate(14.999999, 11.999997) scale(1, -1) rotate(90.000000) translate(-14.999999, -11.999997) "/></g></svg></span>
                <span class="text-primary text-align-c">Összes megtekintése</span>
            </div>
        </div>
    </div>
</section>
<!-- Hirlevel szekcio -->
<section class="main_section relative">
    <div class='border-soft' id="su__con">
        <?php
            if (isset($_SESSION['loggedin'])) {
                $pr_sql = "SELECT uid, email, disc FROM e__subs WHERE uid = $uid";
                $pr_res = $con-> query($pr_sql);
                if ($pr_res-> num_rows > 0) {
                    $mail = $pr_res-> fetch_assoc();
                    if ($mail['disc'] == 0) {
                        echo '
                        <div class="border-soft" id="su__con">
                            <div class="absolute glass su__gls flex flex-col border-soft padding-1">
                                <h3 margin-bottom: 0; padding-bottom: 0;">Köszönjük, hogy feliratkozott hírlevelünkre</h3>
                                <div class="flex flex-col gap-05">
                                    <span class="small">Hírleveleinket minden hétvégén megkapja. Néhány e-mailt a többi napon küldünk, az egyéb feliratkozásaitól függően.</span>
                                    <span class="small-med">*A feliratkozásait <a class="bold link pointer" id="ch__subs">ide kattintva</a> kezelheti, vagy a beállítások menüben módosíthatja.</span>
                                    <span class="small"><b>Figyelem!</b> Úgy tűnik, feliratkozott hírlevelünkre, de még nem vette igénybe akciónkat. Nézzen körül webáruházunkban, hátha talál valamit, és fel tudja használni ezt az akciót.</span>
                                </div><br>
                                <div class="flex flex-col">
                                    <span class="small-med" >Ön feliratkozott hírlevelünkre a(z) <b>'.$mail['email'].'</b> címen. Amennyiben le szeretne iratkozni, <a class="bold link pointer" id="unsub__mail">ide kattintva megteheti</a>.</span>
                                    <span class="small-med user-select-none">**<span class="link pointer underline" id="su__lm">Tudjon meg többet</span> a promóció felhasználásáról</span>
                                </div>
                            </div>
                        </div>
                        ';
                    } else {
                        echo '
                        <div class="border-soft" id="su__con">
                            <div class="absolute glass su__gls flex flex-col border-soft padding-1">
                                <h3 margin-bottom: 0; padding-bottom: 0;">Köszönjük, hogy feliratkozott hírlevelünkre</h3>
                                <div class="flex flex-col gap-05">
                                    <span class="small">Hírleveleinket minden hétvégén megkapja. Néhány e-mailt a többi napon küldünk, az egyéb feliratkozásaitól függően.</span>
                                    <span class="small-med">*A feliratkozásait <a class="bold link pointer" id="ch__subs">ide kattintva</a> kezelheti, vagy a beállítások menüben módosíthatja.</span>
                                </div><br>
                                <div class="flex flex-col">
                                    <span class="small-med" >Ön feliratkozott hírlevelünkre a(z) <b>'.$mail['email'].'</b> címen. Amennyiben le szeretne iratkozni, <a class="bold link pointer" id="unsub__mail">ide kattintva megteheti</a>.</span>
                                    <span class="small-med user-select-none">**<span class="link pointer underline" id="su__lm">Tudjon meg többet</span> a promóció felhasználásáról</span>
                                </div>
                            </div>
                        </div>
                        ';
                    }
                } else {
                    echo '
                    <div class="absolute glass su__gls flex flex-col border-soft padding-1 gap-1">
                        <h3 class="" style="color: #fff; margin-bottom: 0; padding-bottom: 0;">Szeretne 2000 Ft kedvezményt az első rendeléséből?</h3>
                        <span class="small">Iratkozzon fel a hírlevelünkre, hogy igénybe vegye ezt a különleges ajánlatot!</span>
                        <div class="flex flex-col" style="gap: .25rem;">
                            <span class="small-med user-select-none"><span class="link pointer underline" id="su__lm">Tudjon meg többet</span> erről az ajánlatról</span>
                            <div class="flex flex-row gap-05">
                                <input type="email" name="sub__mail" id="sub__mail" pattern="[A-Za-z0-9._%+-]+@[A-Za-z0-9.-]+\.[A-Za-z]{1,63}$" placeholder="Email cím" class="border-soft sub__inp item-bg w-100 padding-05" />
                                <span class="button button-primary" id="sub__act">Küld</span>
                            </div>
                        </div>
                    </div>
                    ';
                }
            } else {
                echo '
                <div class="absolute glass su__gls flex flex-col border-soft padding-1 gap-1">
                    <h3 class="" style="color: #fff; margin-bottom: 0; padding-bottom: 0;">Szeretne 2000 Ft kedvezményt az első rendeléséből?</h3>
                    <span class="small">Iratkozzon fel a hírlevelünkre, hogy igénybe vegye ezt a különleges ajánlatot!</span>
                    <div class="flex flex-col" style="gap: .25rem;">
                        <span class="small-med user-select-none"><span class="link pointer underline" id="su__lm">Tudjon meg többet</span> erről az ajánlatról</span>
                        <div class="flex flex-row gap-05">
                            <input type="email" name="sub__mail" id="sub__mail" pattern="[A-Za-z0-9._%+-]+@[A-Za-z0-9.-]+\.[A-Za-z]{1,63}$" placeholder="Email cím" class="border-soft sub__inp item-bg w-100 padding-05" />
                            <span class="button button-primary" id="sub__act">Küld</span>
                        </div>
                    </div>
                </div>
                ';
            }
        ?>
    </div>
</section>
<!-- Olcso termekek szekcioja -->
<section class='main_section'>
    <div class='flex flex-align-c flex-justify-con-sb'>
        <span class='section_title'>2500 Forint alatti termékek</span>
    </div>
    <div class='section_body flex gap-1 overflow-auto' id="cheap__products">
        <script>
            let cwdt = document.getElementById('cheap__products').offsetWidth;
            $.ajax({ type: "POST", url: "/assets/php/resp.php", data: {"width": cwdt} });
        </script>
        <?php include '/assets/php/resp.php';
            if (isset($_SESSION['loggedin'])) { if (isset($_SESSION['id'])) { $uid = $_SESSION['id']; } } $row = 3; $offset = ((floor(($_SESSION['e__width']/184)/1)*1)*3)-1;
            if ($_SESSION['e__width'] < 365) { $pr_sql = "SELECT products.* FROM products WHERE product_price < 2500 AND products.product_id NOT IN (SELECT product_discount.product_id FROM product_discount WHERE 1) ORDER BY product_price ASC LIMIT 1, 12"; }
            else {
                if ((184*(round(($_SESSION['e__width'])/184))+1) < $_SESSION['e__width']) { echo "<script>document.getElementById('cheap__products').classList.add('flex-justify-con-c');</script>";
                    $pr_sql = "SELECT products.* FROM products WHERE product_price < 2500 AND products.product_id NOT IN (SELECT product_discount.product_id FROM product_discount WHERE 1) ORDER BY product_price ASC LIMIT 1, $offset";
                } else { echo "<script>document.getElementById('cheap__products').classList.add('flex-justify-con-c');</script>";
                    $offset = $offset;  $pr_sql = "SELECT products.* FROM products WHERE product_price < 2500 AND products.product_id NOT IN (SELECT product_discount.product_id FROM product_discount WHERE 1) ORDER BY product_price ASC LIMIT 1, $offset";
                }
            }
            $pr_res = $con-> query($pr_sql);
            if ($pr_res-> num_rows > 0) {
                while ($product = $pr_res-> fetch_assoc()) { $pid = $product['product_id'];
                    echo '
                    <div class="flex flex-col item-bg border-softer box-shadow nwp__card">
                        <label search-key="'; echo $product['product_brand'] . ' '; echo strtr($product['product_brand'], $unwanted_array) . ' '; echo $product['product_name'] . ' '; echo strtr($product['product_name'], $unwanted_array) . ' '; echo $product['product_price'] . ' '; echo $product['product_code']; echo '"></label>
                        <div class="flex flex-row flex-align-c flex-justify-con-sb padding-05">
                            <div class="flex flex-row flex-justify-con-c flex-align-c">
                                '; $ssql = "SELECT stars FROM reviews WHERE pid = $pid"; $sres = $con-> query($ssql); $son = 0; $stw = 0; $sth = 0; $sfo = 0; $sfi = 0; $savg = 0;
                                if ($sres-> num_rows > 0) { while ($star = $sres-> fetch_assoc()) { $stv = $star['stars']; if ($stv == 5) { $sfi += 1; } if ($stv == 4) { $sfo += 1; } if ($stv == 3) { $sth += 1; } if ($stv == 2) { $stw += 1; } if ($stv == 1) { $son += 1; } $dv = ($sfi + $sfo + $sth + $stw + $son); }
                                $savg = ((5 * $sfi) + (4 * $sfo) + (3 * $sth) + (2 * $stw) + (1 * $son)) / $dv; $st__avg = round($savg * 10) / 10;
                                    echo ' <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="22px" height="22px" viewBox="0 0 24 24" version="1.1"><g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"><polygon points="0 0 24 0 24 24 0 24"></polygon><path d="M12,18 L7.91561963,20.1472858 C7.42677504,20.4042866 6.82214789,20.2163401 6.56514708,19.7274955 C6.46280801,19.5328351 6.42749334,19.309867 6.46467018,19.0931094 L7.24471742,14.545085 L3.94038429,11.3241562 C3.54490071,10.938655 3.5368084,10.3055417 3.92230962,9.91005817 C4.07581822,9.75257453 4.27696063,9.65008735 4.49459766,9.61846284 L9.06107374,8.95491503 L11.1032639,4.81698575 C11.3476862,4.32173209 11.9473121,4.11839309 12.4425657,4.36281539 C12.6397783,4.46014562 12.7994058,4.61977315 12.8967361,4.81698575 L14.9389263,8.95491503 L19.5054023,9.61846284 C20.0519472,9.69788046 20.4306287,10.2053233 20.351211,10.7518682 C20.3195865,10.9695052 20.2170993,11.1706476 20.0596157,11.3241562 L16.7552826,14.545085 L17.5353298,19.0931094 C17.6286908,19.6374458 17.263103,20.1544017 16.7187666,20.2477627 C16.5020089,20.2849396 16.2790408,20.2496249 16.0843804,20.1472858 L12,18 Z" fill="#f6cc00"></path></g></svg> <span class="flex text-primary small bold">'.$st__avg.'</span>';
                                } else {  echo '<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="22px" height="22px" viewBox="0 0 24 24" version="1.1"><g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"><polygon points="0 0 24 0 24 24 0 24"></polygon><path d="M12,18 L7.91561963,20.1472858 C7.42677504,20.4042866 6.82214789,20.2163401 6.56514708,19.7274955 C6.46280801,19.5328351 6.42749334,19.309867 6.46467018,19.0931094 L7.24471742,14.545085 L3.94038429,11.3241562 C3.54490071,10.938655 3.5368084,10.3055417 3.92230962,9.91005817 C4.07581822,9.75257453 4.27696063,9.65008735 4.49459766,9.61846284 L9.06107374,8.95491503 L11.1032639,4.81698575 C11.3476862,4.32173209 11.9473121,4.11839309 12.4425657,4.36281539 C12.6397783,4.46014562 12.7994058,4.61977315 12.8967361,4.81698575 L14.9389263,8.95491503 L19.5054023,9.61846284 C20.0519472,9.69788046 20.4306287,10.2053233 20.351211,10.7518682 C20.3195865,10.9695052 20.2170993,11.1706476 20.0596157,11.3241562 L16.7552826,14.545085 L17.5353298,19.0931094 C17.6286908,19.6374458 17.263103,20.1544017 16.7187666,20.2477627 C16.5020089,20.2849396 16.2790408,20.2496249 16.0843804,20.1472858 L12,18 Z" fill="#f6cc00" opacity=".6"></path></g></svg><span class="flex text-secondary small bold">0.0</span>'; } echo '
                            </div>
                            <div class="flex pointer" aria-label="Termék mentése">
                                ';
                                if (isset($uid)) { $bksql = "SELECT * FROM bookmarks WHERE uid = '". $uid ."' AND product_id = '".$product['product_id']."'"; $bkres = $con-> query($bksql);
                                    if ($bkres-> num_rows > 0) {echo '<div class="product_act_btn product_bookmark" action="1" code="'; echo $product['product_code']; echo'" keyid="'; echo $product['product_id']; echo'"><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1"><g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"><rect x="0" y="0" width="24" height="24"/><path d="M8,4 L16,4 C17.1045695,4 18,4.8954305 18,6 L18,17.726765 C18,18.2790497 17.5522847,18.726765 17,18.726765 C16.7498083,18.726765 16.5087052,18.6329798 16.3242754,18.4639191 L12.6757246,15.1194142 C12.2934034,14.7689531 11.7065966,14.7689531 11.3242754,15.1194142 L7.67572463,18.4639191 C7.26860564,18.8371115 6.63603827,18.8096086 6.26284586,18.4024896 C6.09378519,18.2180598 6,17.9769566 6,17.726765 L6,6 C6,4.8954305 6.8954305,4 8,4 Z" class="svg"/></g></svg></div>';} 
                                    else {echo '<div class="product_act_btn product_bookmark" action="0" code="'; echo $product['product_code']; echo'" keyid="'; echo $product['product_id']; echo'"><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1"><g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"><rect x="0" y="0" width="24" height="24"/><path d="M8,4 L16,4 C17.1045695,4 18,4.8954305 18,6 L18,17.726765 C18,18.2790497 17.5522847,18.726765 17,18.726765 C16.7498083,18.726765 16.5087052,18.6329798 16.3242754,18.4639191 L12.6757246,15.1194142 C12.2934034,14.7689531 11.7065966,14.7689531 11.3242754,15.1194142 L7.67572463,18.4639191 C7.26860564,18.8371115 6.63603827,18.8096086 6.26284586,18.4024896 C6.09378519,18.2180598 6,17.9769566 6,17.726765 L6,6 C6,4.8954305 6.8954305,4 8,4 Z" class="svg-stroke"/></g></svg></div>';}
                                } else {echo '<div class="product_act_btn" onclick="openHeaderProfileAction();"><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1"><g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"><rect x="0" y="0" width="24" height="24"/><path d="M8,4 L16,4 C17.1045695,4 18,4.8954305 18,6 L18,17.726765 C18,18.2790497 17.5522847,18.726765 17,18.726765 C16.7498083,18.726765 16.5087052,18.6329798 16.3242754,18.4639191 L12.6757246,15.1194142 C12.2934034,14.7689531 11.7065966,14.7689531 11.3242754,15.1194142 L7.67572463,18.4639191 C7.26860564,18.8371115 6.63603827,18.8096086 6.26284586,18.4024896 C6.09378519,18.2180598 6,17.9769566 6,17.726765 L6,6 C6,4.8954305 6.8954305,4 8,4 Z" class="svg-stroke"/></g></svg></div>';}
                                echo '
                            </div>
                        </div>
                        <div class="flex flex-col flex-align-c product-link pointer" auid="'.$product['product_id'].'">
                            <img src="/assets/images/uploads/'.$product['product_image'].'" alt="'.mb_substr($product['product_info'], 0, 60).'" style="width: 8rem;" />
                            <span class="text-secondary bold small-med uppercase">'.strtoupper($product['product_brand']).'</span>
                        </div>
                        <div class="flex flex-row flex-justify-con-sb">
                            <div class="flex flex-col gap-05 padding-05">';
                                if (strlen($product['product_name']) >= 15) { echo '<span class="text-primary small bold pointer product-link" auid="'.$product['product_id'].'">'.$product['product_name'].'</span>';
                                } else { echo '<span class="text-primary small bold pointer capitalize product-link" auid="'.$product['product_id'].'">'.$product['product_color'].' '.$product['product_name'].'</span>'; }
                                echo '
                                <span class="text-secondary small formatted-price bold" id="formatted-price-'.$product['product_id'].'">'.$product['product_price'].'</span>
                            </div>
                            <div class="flex flex-col flex-justify-con-c flex-align-c border-softer pointer product-basket" aria-label="Kosárhoz adás">
                                ';
                                if (isset($uid)) { $bksql = "SELECT * FROM cart WHERE uid = '". $uid ."' AND pid = '".$product['product_id']."'"; $bkres = $con-> query($bksql);
                                    if ($bkres-> num_rows > 0) { echo '<div class="product_act_btn flex flex-col flex-align-c flex-justify-con-c cart__button" action="1" code="'; echo $product['product_code']; echo'" bkeyid="'; echo $product['product_id']; echo'"><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1"><g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"><rect x="0" y="0" width="24" height="24"></rect><path d="M12,4.56204994 L7.76822128,9.6401844 C7.4146572,10.0644613 6.7840925,10.1217854 6.3598156,9.76822128 C5.9355387,9.4146572 5.87821464,8.7840925 6.23177872,8.3598156 L11.2317787,2.3598156 C11.6315738,1.88006147 12.3684262,1.88006147 12.7682213,2.3598156 L17.7682213,8.3598156 C18.1217854,8.7840925 18.0644613,9.4146572 17.6401844,9.76822128 C17.2159075,10.1217854 16.5853428,10.0644613 16.2317787,9.6401844 L12,4.56204994 Z" class="svg" fill-rule="nonzero" opacity="0.3"></path><path d="M3.28077641,9 L20.7192236,9 C21.2715083,9 21.7192236,9.44771525 21.7192236,10 C21.7192236,10.0817618 21.7091962,10.163215 21.6893661,10.2425356 L19.5680983,18.7276069 C19.234223,20.0631079 18.0342737,21 16.6576708,21 L7.34232922,21 C5.96572629,21 4.76577697,20.0631079 4.43190172,18.7276069 L2.31063391,10.2425356 C2.17668518,9.70674072 2.50244587,9.16380623 3.03824078,9.0298575 C3.11756139,9.01002735 3.1990146,9 3.28077641,9 Z M12,12 C11.4477153,12 11,12.4477153 11,13 L11,17 C11,17.5522847 11.4477153,18 12,18 C12.5522847,18 13,17.5522847 13,17 L13,13 C13,12.4477153 12.5522847,12 12,12 Z M6.96472382,12.1362967 C6.43125772,12.2792385 6.11467523,12.8275755 6.25761704,13.3610416 L7.29289322,17.2247449 C7.43583503,17.758211 7.98417199,18.0747935 8.51763809,17.9318517 C9.05110419,17.7889098 9.36768668,17.2405729 9.22474487,16.7071068 L8.18946869,12.8434035 C8.04652688,12.3099374 7.49818992,11.9933549 6.96472382,12.1362967 Z M17.0352762,12.1362967 C16.5018101,11.9933549 15.9534731,12.3099374 15.8105313,12.8434035 L14.7752551,16.7071068 C14.6323133,17.2405729 14.9488958,17.7889098 15.4823619,17.9318517 C16.015828,18.0747935 16.564165,17.758211 16.7071068,17.2247449 L17.742383,13.3610416 C17.8853248,12.8275755 17.5687423,12.2792385 17.0352762,12.1362967 Z" class="svg"></path></g></svg><span class="product-basket-ind"></span></div>';} 
                                    else { echo '<div class="flex flex-col flex-align-c flex-justify-con-c product_act_btn cart__button" action="0" code="'; echo $product['product_code']; echo'" bkeyid="'; echo $product['product_id']; echo'"><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1"><g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"><rect x="0" y="0" width="24" height="24"></rect><path d="M12,4.56204994 L7.76822128,9.6401844 C7.4146572,10.0644613 6.7840925,10.1217854 6.3598156,9.76822128 C5.9355387,9.4146572 5.87821464,8.7840925 6.23177872,8.3598156 L11.2317787,2.3598156 C11.6315738,1.88006147 12.3684262,1.88006147 12.7682213,2.3598156 L17.7682213,8.3598156 C18.1217854,8.7840925 18.0644613,9.4146572 17.6401844,9.76822128 C17.2159075,10.1217854 16.5853428,10.0644613 16.2317787,9.6401844 L12,4.56204994 Z" class="svg" fill-rule="nonzero" opacity="0.3"></path><path d="M3.28077641,9 L20.7192236,9 C21.2715083,9 21.7192236,9.44771525 21.7192236,10 C21.7192236,10.0817618 21.7091962,10.163215 21.6893661,10.2425356 L19.5680983,18.7276069 C19.234223,20.0631079 18.0342737,21 16.6576708,21 L7.34232922,21 C5.96572629,21 4.76577697,20.0631079 4.43190172,18.7276069 L2.31063391,10.2425356 C2.17668518,9.70674072 2.50244587,9.16380623 3.03824078,9.0298575 C3.11756139,9.01002735 3.1990146,9 3.28077641,9 Z M12,12 C11.4477153,12 11,12.4477153 11,13 L11,17 C11,17.5522847 11.4477153,18 12,18 C12.5522847,18 13,17.5522847 13,17 L13,13 C13,12.4477153 12.5522847,12 12,12 Z M6.96472382,12.1362967 C6.43125772,12.2792385 6.11467523,12.8275755 6.25761704,13.3610416 L7.29289322,17.2247449 C7.43583503,17.758211 7.98417199,18.0747935 8.51763809,17.9318517 C9.05110419,17.7889098 9.36768668,17.2405729 9.22474487,16.7071068 L8.18946869,12.8434035 C8.04652688,12.3099374 7.49818992,11.9933549 6.96472382,12.1362967 Z M17.0352762,12.1362967 C16.5018101,11.9933549 15.9534731,12.3099374 15.8105313,12.8434035 L14.7752551,16.7071068 C14.6323133,17.2405729 14.9488958,17.7889098 15.4823619,17.9318517 C16.015828,18.0747935 16.564165,17.758211 16.7071068,17.2247449 L17.742383,13.3610416 C17.8853248,12.8275755 17.5687423,12.2792385 17.0352762,12.1362967 Z" class="svg"></path></g></svg></div>';}
                                } else { echo '<div class="product_act_btn" onclick="openHeaderProfileAction();"><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1"><g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"><rect x="0" y="0" width="24" height="24"></rect><path d="M12,4.56204994 L7.76822128,9.6401844 C7.4146572,10.0644613 6.7840925,10.1217854 6.3598156,9.76822128 C5.9355387,9.4146572 5.87821464,8.7840925 6.23177872,8.3598156 L11.2317787,2.3598156 C11.6315738,1.88006147 12.3684262,1.88006147 12.7682213,2.3598156 L17.7682213,8.3598156 C18.1217854,8.7840925 18.0644613,9.4146572 17.6401844,9.76822128 C17.2159075,10.1217854 16.5853428,10.0644613 16.2317787,9.6401844 L12,4.56204994 Z" class="svg" fill-rule="nonzero" opacity="0.3"></path><path d="M3.28077641,9 L20.7192236,9 C21.2715083,9 21.7192236,9.44771525 21.7192236,10 C21.7192236,10.0817618 21.7091962,10.163215 21.6893661,10.2425356 L19.5680983,18.7276069 C19.234223,20.0631079 18.0342737,21 16.6576708,21 L7.34232922,21 C5.96572629,21 4.76577697,20.0631079 4.43190172,18.7276069 L2.31063391,10.2425356 C2.17668518,9.70674072 2.50244587,9.16380623 3.03824078,9.0298575 C3.11756139,9.01002735 3.1990146,9 3.28077641,9 Z M12,12 C11.4477153,12 11,12.4477153 11,13 L11,17 C11,17.5522847 11.4477153,18 12,18 C12.5522847,18 13,17.5522847 13,17 L13,13 C13,12.4477153 12.5522847,12 12,12 Z M6.96472382,12.1362967 C6.43125772,12.2792385 6.11467523,12.8275755 6.25761704,13.3610416 L7.29289322,17.2247449 C7.43583503,17.758211 7.98417199,18.0747935 8.51763809,17.9318517 C9.05110419,17.7889098 9.36768668,17.2405729 9.22474487,16.7071068 L8.18946869,12.8434035 C8.04652688,12.3099374 7.49818992,11.9933549 6.96472382,12.1362967 Z M17.0352762,12.1362967 C16.5018101,11.9933549 15.9534731,12.3099374 15.8105313,12.8434035 L14.7752551,16.7071068 C14.6323133,17.2405729 14.9488958,17.7889098 15.4823619,17.9318517 C16.015828,18.0747935 16.564165,17.758211 16.7071068,17.2247449 L17.742383,13.3610416 C17.8853248,12.8275755 17.5687423,12.2792385 17.0352762,12.1362967 Z" class="svg"></path></g></svg></div>';}
                                echo '
                            </div>
                        </div>
                    </div>
                    <script>document.getElementById("formatted-price-'.$product['product_id'].'").textContent = formatter.format('.$product['product_price'].');</script>
                    ';
                }
            } else { echo "<script>document.getElementById('new_products').remove();</script>"; }
        ?>
        <div class='product_card'>
            <div class="flex flex-col flex-align-c flex-justify-con-c h-100">
                <span>
                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="64px" height="64px" viewBox="0 0 24 24" version="1.1">
                        <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"><polygon points="0 0 24 0 24 24 0 24"/><rect class="svg" opacity="0.3" transform="translate(8.500000, 12.000000) rotate(-90.000000) translate(-8.500000, -12.000000) " x="7.5" y="7.5" width="2" height="9" rx="1"/><path d="M9.70710318,15.7071045 C9.31657888,16.0976288 8.68341391,16.0976288 8.29288961,15.7071045 C7.90236532,15.3165802 7.90236532,14.6834152 8.29288961,14.2928909 L14.2928896,8.29289093 C14.6714686,7.914312 15.281055,7.90106637 15.675721,8.26284357 L21.675721,13.7628436 C22.08284,14.136036 22.1103429,14.7686034 21.7371505,15.1757223 C21.3639581,15.5828413 20.7313908,15.6103443 20.3242718,15.2371519 L15.0300721,10.3841355 L9.70710318,15.7071045 Z" class="svg" fill-rule="nonzero" transform="translate(14.999999, 11.999997) scale(1, -1) rotate(90.000000) translate(-14.999999, -11.999997) "/></g>
                    </svg>
                </span>
                <span class="text-primary text-align-c">Összes megtekintése</span>
            </div>
        </div>
    </div>

</section>
<!-- Kifuto termekek szekcioja -->
<section id='last_products' class='main_section'>
    <div class='flex flex-align-c flex-justify-con-sb'>
        <span class='section_title'>Kifutó Termékek</span>
    </div>
    <div class='section_body flex gap-1 overflow-auto'>
        <?php
            if (isset($_SESSION['loggedin'])) {if (isset($_SESSION['id'])) {$uid = $_SESSION['id'];}}
            $pr_sql = "SELECT * FROM products WHERE product_quantity < 5 AND product_quantity > 0 AND products.product_id NOT IN (SELECT product_discount.product_id FROM product_discount WHERE 1) ORDER BY added DESC LIMIT 13";
            $pr_res = $con-> query($pr_sql);
            if ($pr_res-> num_rows > 0) {
                while ($product = $pr_res-> fetch_assoc()) { $pid = $product['product_id'];
                    echo '
                    <div class="flex flex-col item-bg border-softer box-shadow nwp__card">
                        <label search-key="'; echo $product['product_brand'] . ' '; echo strtr($product['product_brand'], $unwanted_array) . ' '; echo $product['product_name'] . ' '; echo strtr($product['product_name'], $unwanted_array) . ' '; echo $product['product_price'] . ' '; echo $product['product_code']; echo '"></label>
                        <div class="flex flex-row flex-align-c flex-justify-con-sb padding-05">
                            <div class="flex flex-row flex-justify-con-c flex-align-c">
                                '; $ssql = "SELECT stars FROM reviews WHERE pid = $pid"; $sres = $con-> query($ssql); $son = 0; $stw = 0; $sth = 0; $sfo = 0; $sfi = 0; $savg = 0;
                                if ($sres-> num_rows > 0) { while ($star = $sres-> fetch_assoc()) { $stv = $star['stars']; if ($stv == 5) { $sfi += 1; } if ($stv == 4) { $sfo += 1; } if ($stv == 3) { $sth += 1; } if ($stv == 2) { $stw += 1; } if ($stv == 1) { $son += 1; } $dv = ($sfi + $sfo + $sth + $stw + $son); }
                                $savg = ((5 * $sfi) + (4 * $sfo) + (3 * $sth) + (2 * $stw) + (1 * $son)) / $dv; $st__avg = round($savg * 10) / 10;
                                    echo ' <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="22px" height="22px" viewBox="0 0 24 24" version="1.1"><g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"><polygon points="0 0 24 0 24 24 0 24"></polygon><path d="M12,18 L7.91561963,20.1472858 C7.42677504,20.4042866 6.82214789,20.2163401 6.56514708,19.7274955 C6.46280801,19.5328351 6.42749334,19.309867 6.46467018,19.0931094 L7.24471742,14.545085 L3.94038429,11.3241562 C3.54490071,10.938655 3.5368084,10.3055417 3.92230962,9.91005817 C4.07581822,9.75257453 4.27696063,9.65008735 4.49459766,9.61846284 L9.06107374,8.95491503 L11.1032639,4.81698575 C11.3476862,4.32173209 11.9473121,4.11839309 12.4425657,4.36281539 C12.6397783,4.46014562 12.7994058,4.61977315 12.8967361,4.81698575 L14.9389263,8.95491503 L19.5054023,9.61846284 C20.0519472,9.69788046 20.4306287,10.2053233 20.351211,10.7518682 C20.3195865,10.9695052 20.2170993,11.1706476 20.0596157,11.3241562 L16.7552826,14.545085 L17.5353298,19.0931094 C17.6286908,19.6374458 17.263103,20.1544017 16.7187666,20.2477627 C16.5020089,20.2849396 16.2790408,20.2496249 16.0843804,20.1472858 L12,18 Z" fill="#f6cc00"></path></g></svg> <span class="flex text-primary small bold">'.$st__avg.'</span>';
                                } else {  echo '<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="22px" height="22px" viewBox="0 0 24 24" version="1.1"><g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"><polygon points="0 0 24 0 24 24 0 24"></polygon><path d="M12,18 L7.91561963,20.1472858 C7.42677504,20.4042866 6.82214789,20.2163401 6.56514708,19.7274955 C6.46280801,19.5328351 6.42749334,19.309867 6.46467018,19.0931094 L7.24471742,14.545085 L3.94038429,11.3241562 C3.54490071,10.938655 3.5368084,10.3055417 3.92230962,9.91005817 C4.07581822,9.75257453 4.27696063,9.65008735 4.49459766,9.61846284 L9.06107374,8.95491503 L11.1032639,4.81698575 C11.3476862,4.32173209 11.9473121,4.11839309 12.4425657,4.36281539 C12.6397783,4.46014562 12.7994058,4.61977315 12.8967361,4.81698575 L14.9389263,8.95491503 L19.5054023,9.61846284 C20.0519472,9.69788046 20.4306287,10.2053233 20.351211,10.7518682 C20.3195865,10.9695052 20.2170993,11.1706476 20.0596157,11.3241562 L16.7552826,14.545085 L17.5353298,19.0931094 C17.6286908,19.6374458 17.263103,20.1544017 16.7187666,20.2477627 C16.5020089,20.2849396 16.2790408,20.2496249 16.0843804,20.1472858 L12,18 Z" fill="#f6cc00" opacity=".6"></path></g></svg><span class="flex text-secondary small bold">0.0</span>'; } echo '
                            </div>
                            <div class="flex pointer" aria-label="Termék mentése">
                                ';
                                if (isset($uid)) { $bksql = "SELECT * FROM bookmarks WHERE uid = '". $uid ."' AND product_id = '".$product['product_id']."'"; $bkres = $con-> query($bksql);
                                    if ($bkres-> num_rows > 0) {echo '<div class="product_act_btn product_bookmark" action="1" code="'; echo $product['product_code']; echo'" keyid="'; echo $product['product_id']; echo'"><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1"><g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"><rect x="0" y="0" width="24" height="24"/><path d="M8,4 L16,4 C17.1045695,4 18,4.8954305 18,6 L18,17.726765 C18,18.2790497 17.5522847,18.726765 17,18.726765 C16.7498083,18.726765 16.5087052,18.6329798 16.3242754,18.4639191 L12.6757246,15.1194142 C12.2934034,14.7689531 11.7065966,14.7689531 11.3242754,15.1194142 L7.67572463,18.4639191 C7.26860564,18.8371115 6.63603827,18.8096086 6.26284586,18.4024896 C6.09378519,18.2180598 6,17.9769566 6,17.726765 L6,6 C6,4.8954305 6.8954305,4 8,4 Z" class="svg"/></g></svg></div>';} 
                                    else {echo '<div class="product_act_btn product_bookmark" action="0" code="'; echo $product['product_code']; echo'" keyid="'; echo $product['product_id']; echo'"><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1"><g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"><rect x="0" y="0" width="24" height="24"/><path d="M8,4 L16,4 C17.1045695,4 18,4.8954305 18,6 L18,17.726765 C18,18.2790497 17.5522847,18.726765 17,18.726765 C16.7498083,18.726765 16.5087052,18.6329798 16.3242754,18.4639191 L12.6757246,15.1194142 C12.2934034,14.7689531 11.7065966,14.7689531 11.3242754,15.1194142 L7.67572463,18.4639191 C7.26860564,18.8371115 6.63603827,18.8096086 6.26284586,18.4024896 C6.09378519,18.2180598 6,17.9769566 6,17.726765 L6,6 C6,4.8954305 6.8954305,4 8,4 Z" class="svg-stroke"/></g></svg></div>';}
                                } else {echo '<div class="product_act_btn" onclick="openHeaderProfileAction();"><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1"><g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"><rect x="0" y="0" width="24" height="24"/><path d="M8,4 L16,4 C17.1045695,4 18,4.8954305 18,6 L18,17.726765 C18,18.2790497 17.5522847,18.726765 17,18.726765 C16.7498083,18.726765 16.5087052,18.6329798 16.3242754,18.4639191 L12.6757246,15.1194142 C12.2934034,14.7689531 11.7065966,14.7689531 11.3242754,15.1194142 L7.67572463,18.4639191 C7.26860564,18.8371115 6.63603827,18.8096086 6.26284586,18.4024896 C6.09378519,18.2180598 6,17.9769566 6,17.726765 L6,6 C6,4.8954305 6.8954305,4 8,4 Z" class="svg-stroke"/></g></svg></div>';}
                                echo '
                            </div>
                        </div>
                        <div class="flex flex-col flex-align-c product-link pointer" auid="'.$product['product_id'].'">
                            <img src="/assets/images/uploads/'.$product['product_image'].'" alt="'.mb_substr($product['product_info'], 0, 60).'" style="width: 8rem;" />
                            <span class="text-secondary bold small-med uppercase">'.strtoupper($product['product_brand']).'</span>
                        </div>
                        <div class="flex flex-row flex-justify-con-sb">
                            <div class="flex flex-col gap-05 padding-05">';
                                if (strlen($product['product_name']) >= 15) { echo '<span class="text-primary small bold pointer product-link" auid="'.$product['product_id'].'">'.$product['product_name'].'</span>';
                                } else { echo '<span class="text-primary small bold pointer capitalize product-link" auid="'.$product['product_id'].'">'.$product['product_color'].' '.$product['product_name'].'</span>'; }
                                echo '
                                <span class="text-secondary small formatted-price bold" id="formatted-price-'.$product['product_id'].'">'.$product['product_price'].'</span>
                            </div>
                            <div class="flex flex-col flex-justify-con-c flex-align-c border-softer pointer product-basket" aria-label="Kosárhoz adás">
                                ';
                                if (isset($uid)) { $bksql = "SELECT * FROM cart WHERE uid = '". $uid ."' AND pid = '".$product['product_id']."'"; $bkres = $con-> query($bksql);
                                    if ($bkres-> num_rows > 0) { echo '<div class="product_act_btn flex flex-col flex-align-c flex-justify-con-c cart__button" action="1" code="'; echo $product['product_code']; echo'" bkeyid="'; echo $product['product_id']; echo'"><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1"><g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"><rect x="0" y="0" width="24" height="24"></rect><path d="M12,4.56204994 L7.76822128,9.6401844 C7.4146572,10.0644613 6.7840925,10.1217854 6.3598156,9.76822128 C5.9355387,9.4146572 5.87821464,8.7840925 6.23177872,8.3598156 L11.2317787,2.3598156 C11.6315738,1.88006147 12.3684262,1.88006147 12.7682213,2.3598156 L17.7682213,8.3598156 C18.1217854,8.7840925 18.0644613,9.4146572 17.6401844,9.76822128 C17.2159075,10.1217854 16.5853428,10.0644613 16.2317787,9.6401844 L12,4.56204994 Z" class="svg" fill-rule="nonzero" opacity="0.3"></path><path d="M3.28077641,9 L20.7192236,9 C21.2715083,9 21.7192236,9.44771525 21.7192236,10 C21.7192236,10.0817618 21.7091962,10.163215 21.6893661,10.2425356 L19.5680983,18.7276069 C19.234223,20.0631079 18.0342737,21 16.6576708,21 L7.34232922,21 C5.96572629,21 4.76577697,20.0631079 4.43190172,18.7276069 L2.31063391,10.2425356 C2.17668518,9.70674072 2.50244587,9.16380623 3.03824078,9.0298575 C3.11756139,9.01002735 3.1990146,9 3.28077641,9 Z M12,12 C11.4477153,12 11,12.4477153 11,13 L11,17 C11,17.5522847 11.4477153,18 12,18 C12.5522847,18 13,17.5522847 13,17 L13,13 C13,12.4477153 12.5522847,12 12,12 Z M6.96472382,12.1362967 C6.43125772,12.2792385 6.11467523,12.8275755 6.25761704,13.3610416 L7.29289322,17.2247449 C7.43583503,17.758211 7.98417199,18.0747935 8.51763809,17.9318517 C9.05110419,17.7889098 9.36768668,17.2405729 9.22474487,16.7071068 L8.18946869,12.8434035 C8.04652688,12.3099374 7.49818992,11.9933549 6.96472382,12.1362967 Z M17.0352762,12.1362967 C16.5018101,11.9933549 15.9534731,12.3099374 15.8105313,12.8434035 L14.7752551,16.7071068 C14.6323133,17.2405729 14.9488958,17.7889098 15.4823619,17.9318517 C16.015828,18.0747935 16.564165,17.758211 16.7071068,17.2247449 L17.742383,13.3610416 C17.8853248,12.8275755 17.5687423,12.2792385 17.0352762,12.1362967 Z" class="svg"></path></g></svg><span class="product-basket-ind"></span></div>';} 
                                    else { echo '<div class="flex flex-col flex-align-c flex-justify-con-c product_act_btn cart__button" action="0" code="'; echo $product['product_code']; echo'" bkeyid="'; echo $product['product_id']; echo'"><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1"><g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"><rect x="0" y="0" width="24" height="24"></rect><path d="M12,4.56204994 L7.76822128,9.6401844 C7.4146572,10.0644613 6.7840925,10.1217854 6.3598156,9.76822128 C5.9355387,9.4146572 5.87821464,8.7840925 6.23177872,8.3598156 L11.2317787,2.3598156 C11.6315738,1.88006147 12.3684262,1.88006147 12.7682213,2.3598156 L17.7682213,8.3598156 C18.1217854,8.7840925 18.0644613,9.4146572 17.6401844,9.76822128 C17.2159075,10.1217854 16.5853428,10.0644613 16.2317787,9.6401844 L12,4.56204994 Z" class="svg" fill-rule="nonzero" opacity="0.3"></path><path d="M3.28077641,9 L20.7192236,9 C21.2715083,9 21.7192236,9.44771525 21.7192236,10 C21.7192236,10.0817618 21.7091962,10.163215 21.6893661,10.2425356 L19.5680983,18.7276069 C19.234223,20.0631079 18.0342737,21 16.6576708,21 L7.34232922,21 C5.96572629,21 4.76577697,20.0631079 4.43190172,18.7276069 L2.31063391,10.2425356 C2.17668518,9.70674072 2.50244587,9.16380623 3.03824078,9.0298575 C3.11756139,9.01002735 3.1990146,9 3.28077641,9 Z M12,12 C11.4477153,12 11,12.4477153 11,13 L11,17 C11,17.5522847 11.4477153,18 12,18 C12.5522847,18 13,17.5522847 13,17 L13,13 C13,12.4477153 12.5522847,12 12,12 Z M6.96472382,12.1362967 C6.43125772,12.2792385 6.11467523,12.8275755 6.25761704,13.3610416 L7.29289322,17.2247449 C7.43583503,17.758211 7.98417199,18.0747935 8.51763809,17.9318517 C9.05110419,17.7889098 9.36768668,17.2405729 9.22474487,16.7071068 L8.18946869,12.8434035 C8.04652688,12.3099374 7.49818992,11.9933549 6.96472382,12.1362967 Z M17.0352762,12.1362967 C16.5018101,11.9933549 15.9534731,12.3099374 15.8105313,12.8434035 L14.7752551,16.7071068 C14.6323133,17.2405729 14.9488958,17.7889098 15.4823619,17.9318517 C16.015828,18.0747935 16.564165,17.758211 16.7071068,17.2247449 L17.742383,13.3610416 C17.8853248,12.8275755 17.5687423,12.2792385 17.0352762,12.1362967 Z" class="svg"></path></g></svg></div>';}
                                } else { echo '<div class="product_act_btn" onclick="openHeaderProfileAction();"><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1"><g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"><rect x="0" y="0" width="24" height="24"></rect><path d="M12,4.56204994 L7.76822128,9.6401844 C7.4146572,10.0644613 6.7840925,10.1217854 6.3598156,9.76822128 C5.9355387,9.4146572 5.87821464,8.7840925 6.23177872,8.3598156 L11.2317787,2.3598156 C11.6315738,1.88006147 12.3684262,1.88006147 12.7682213,2.3598156 L17.7682213,8.3598156 C18.1217854,8.7840925 18.0644613,9.4146572 17.6401844,9.76822128 C17.2159075,10.1217854 16.5853428,10.0644613 16.2317787,9.6401844 L12,4.56204994 Z" class="svg" fill-rule="nonzero" opacity="0.3"></path><path d="M3.28077641,9 L20.7192236,9 C21.2715083,9 21.7192236,9.44771525 21.7192236,10 C21.7192236,10.0817618 21.7091962,10.163215 21.6893661,10.2425356 L19.5680983,18.7276069 C19.234223,20.0631079 18.0342737,21 16.6576708,21 L7.34232922,21 C5.96572629,21 4.76577697,20.0631079 4.43190172,18.7276069 L2.31063391,10.2425356 C2.17668518,9.70674072 2.50244587,9.16380623 3.03824078,9.0298575 C3.11756139,9.01002735 3.1990146,9 3.28077641,9 Z M12,12 C11.4477153,12 11,12.4477153 11,13 L11,17 C11,17.5522847 11.4477153,18 12,18 C12.5522847,18 13,17.5522847 13,17 L13,13 C13,12.4477153 12.5522847,12 12,12 Z M6.96472382,12.1362967 C6.43125772,12.2792385 6.11467523,12.8275755 6.25761704,13.3610416 L7.29289322,17.2247449 C7.43583503,17.758211 7.98417199,18.0747935 8.51763809,17.9318517 C9.05110419,17.7889098 9.36768668,17.2405729 9.22474487,16.7071068 L8.18946869,12.8434035 C8.04652688,12.3099374 7.49818992,11.9933549 6.96472382,12.1362967 Z M17.0352762,12.1362967 C16.5018101,11.9933549 15.9534731,12.3099374 15.8105313,12.8434035 L14.7752551,16.7071068 C14.6323133,17.2405729 14.9488958,17.7889098 15.4823619,17.9318517 C16.015828,18.0747935 16.564165,17.758211 16.7071068,17.2247449 L17.742383,13.3610416 C17.8853248,12.8275755 17.5687423,12.2792385 17.0352762,12.1362967 Z" class="svg"></path></g></svg></div>';}
                                echo '
                            </div>
                        </div>
                    </div>
                    <script>document.getElementById("formatted-price-'.$product['product_id'].'").textContent = formatter.format('.$product['product_price'].');</script>
                    ';
                }
            } else { echo "<script>document.getElementById('new_products').remove();</script>"; }
        ?>
        <div class='product_card'>
            <div class="flex flex-col flex-align-c flex-justify-con-c h-100">
                <span>
                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="64px" height="64px" viewBox="0 0 24 24" version="1.1">
                        <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"><polygon points="0 0 24 0 24 24 0 24"/><rect class="svg" opacity="0.3" transform="translate(8.500000, 12.000000) rotate(-90.000000) translate(-8.500000, -12.000000) " x="7.5" y="7.5" width="2" height="9" rx="1"/><path d="M9.70710318,15.7071045 C9.31657888,16.0976288 8.68341391,16.0976288 8.29288961,15.7071045 C7.90236532,15.3165802 7.90236532,14.6834152 8.29288961,14.2928909 L14.2928896,8.29289093 C14.6714686,7.914312 15.281055,7.90106637 15.675721,8.26284357 L21.675721,13.7628436 C22.08284,14.136036 22.1103429,14.7686034 21.7371505,15.1757223 C21.3639581,15.5828413 20.7313908,15.6103443 20.3242718,15.2371519 L15.0300721,10.3841355 L9.70710318,15.7071045 Z" class="svg" fill-rule="nonzero" transform="translate(14.999999, 11.999997) scale(1, -1) rotate(90.000000) translate(-14.999999, -11.999997) "/></g>
                    </svg>
                </span>
                <span class="text-primary text-align-c">Összes megtekintése</span>
            </div>
        </div>
    </div>
</section>