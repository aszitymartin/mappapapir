<?php require_once($_SERVER['DOCUMENT_ROOT'].'/includes/inc.php'); ?>
<script>var formatter = new Intl.NumberFormat('hu-HU', {style: 'currency',currency: 'HUF',maximumFractionDigits: 0,minimumFractionDigits: 0});</script>
<div class="sidenav-theme">
    <div class="sidenav-header flex flec-row flex-align-c flex-justify-con-sb">
        <span class="flex flex-col">
            <span class="header_title_heading">Bevásárlókosár</span>
        </span>
        <span class="flex">
            <span class="text-primary pointer" onclick="cl__basket()">
                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"><rect x="0" y="0" width="24" height="24"/><circle class="svg" opacity="0.3" cx="12" cy="12" r="10"/><path d="M12.0355339,10.6213203 L14.863961,7.79289322 C15.2544853,7.40236893 15.8876503,7.40236893 16.2781746,7.79289322 C16.6686989,8.18341751 16.6686989,8.81658249 16.2781746,9.20710678 L13.4497475,12.0355339 L16.2781746,14.863961 C16.6686989,15.2544853 16.6686989,15.8876503 16.2781746,16.2781746 C15.8876503,16.6686989 15.2544853,16.6686989 14.863961,16.2781746 L12.0355339,13.4497475 L9.20710678,16.2781746 C8.81658249,16.6686989 8.18341751,16.6686989 7.79289322,16.2781746 C7.40236893,15.8876503 7.40236893,15.2544853 7.79289322,14.863961 L10.6213203,12.0355339 L7.79289322,9.20710678 C7.40236893,8.81658249 7.40236893,8.18341751 7.79289322,7.79289322 C8.18341751,7.40236893 8.81658249,7.40236893 9.20710678,7.79289322 L12.0355339,10.6213203 Z" class="svg" /></g>
                </svg>
            </span>
        </span>
    </div>
    <div id="bsc__items" class="theme-body flex flex-col flex-align-c gap-1">
        <div class="flex flex-col flex-align-c gap-1 w-100">
        <?php include "/assets/php/basket/q__up.php";
            if (isset($_SESSION['loggedin'])) {if (isset($_SESSION['id'])) {$uid = $_SESSION['id'];}}
            if (isset($uid)) { $pr_sql = "SELECT products.*, products__inventory.quantity AS invquantity, products__inventory.q__warehouse, products__inventory.backorder, products__variations.color, products__variations.brand, cart.*, products__pricing.base FROM products INNER JOIN products__inventory ON products__inventory.pid = products.id INNER JOIN cart ON products.id = cart.pid INNER JOIN products__variations ON products__variations.pid = cart.pid INNER JOIN products__pricing ON products__pricing.pid = products.id WHERE cart.uid = '".$uid."'"; $pr_res = $con-> query($pr_sql);
                if ($pr_res-> num_rows > 0) { $subtot = 0;
                    while ($product = $pr_res-> fetch_assoc()) { $pid = $product['pid'];
                        $disc_sql = "SELECT cart.*, products__pricing.pid AS pid, products__pricing.discount, products__pricing.base FROM cart INNER JOIN products__pricing ON products__pricing.pid = cart.pid WHERE cart.uid = $uid AND cart.pid = $pid"; $disc_res = $con-> query($disc_sql);
                        if ($disc_res-> num_rows > 0) { $disc = $disc_res-> fetch_assoc(); $newprice = ($disc['discount'] * $disc['base']) / 100; $dprice = $product['base'] - $newprice; $subtot += $newprice * $product['quantity'];
                        } else { $subtot += $product['base'] * $product['quantity']; $dprice = $product['base']; }
                        echo '
                            <div class="flex flex-row flex-align-c flex-justify-con-sb gap-05 padding-05 w-fa" id="bs__item'.$product['pid'].'">
                                <div class="flex flex-row flex-align-c gap-05">
                                    <div class="bsc__img flex flex-col flex-align-c flex-justify-con-c gap-025">
                                        <img class="bs__img drop-shadow" src="/assets/images/uploads/'.$product['thumbnail'].'" alt="'.$product['name'].'" style="height: 4rem; object-fit: contain;" />
                                        <span onclick="__delcart('.$product['pid'].')" id="rm__bsi'.$product['pid'].'" class="text-primary small-med pointer link">Eltávolítás</span>
                                    </div>
                                    <div class="flex flex-col gap-05">
                                        <div class="flex flex-col">
                                            <a class="text-primary small pointer link bold" href="/product/'.$product['pid'].'/'; echo str_replace(',', '', str_replace(' ', '-',strtolower(strtr($product['brand'], $unwanted_array)))).'-'.str_replace(',', '', str_replace(' ', '-',strtolower(strtr($product['name'], $unwanted_array)))).'-'.str_replace(',', '', str_replace(' ', '-', strtolower(strtr($product['color'], $unwanted_array)))); echo '" target="_blank">'; if (strlen($product['name']) > 40) { echo mb_substr($product['name'], 0, 40).'...'; } else { echo $product['name']; } echo '</a>
                                            <span class="text-muted small-med">'.$product['brand'].' - '.$product['color'].'</span>
                                        </div>
                                        <span class="flex flex-row gap-05 text-primary bold">
                                            <span id="prod-prc-'.$product['pid'].'"></span>
                                            <span id="bsp__quantity'.$product['pid'].'">x '.$product['quantity'].'</span>
                                        </span>
                                    </div>
                                </div>
                                <div>
                                    <div class="flex flex-col gap-05">
                                        <div onclick="__incbask('.$product['pid'].')" id="bspq__up'.$product['pid'].'" class="flex flex-align-c flex-justify-con-c pointer bs__button border-soft background-bg" aria-label="Mennyiség növelése">
                                            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="1rem" height="1rem" viewBox="0 0 24 24" version="1.1"><g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"><rect class="svg" x="4" y="11" width="16" height="2" rx="1"/><rect class="svg" transform="translate(12.000000, 12.000000) rotate(-270.000000) translate(-12.000000, -12.000000) " x="4" y="11" width="16" height="2" rx="1"/></g></svg>
                                        </div>
                                        <span class="flex flex-col flex-align-c flex-justify-con-c overflow-hidden">
                                            <span  id="bspq__inp'.$product['pid'].'" class="bs__val text-muted small outline-none text-align-c">1</span>
                                        </span>
                                        <div onclick="__decbask('.$product['pid'].')" id="bspq__down'.$product['pid'].'" class="flex flex-align-c flex-justify-con-c pointer bs__button border-soft background-bg" aria-label="Mennyiség csökkentése">
                                            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="1rem" height="1rem" viewBox="0 0 24 24" version="1.1"><g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"><rect class="svg" x="4" y="11" width="16" height="2" rx="1"/></g></svg>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        ';
                    }
                } else { echo '<div class="text-align-c"><div class="flex flex-col flex-align-c flex-justify-con-c gap-1"><span><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="8rem" height="8rem" viewBox="0 0 24 24" version="1.1"><g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"><rect x="0" y="0" width="24" height="24"/><path d="M18.1446364,11.84388 L17.4471627,16.0287218 C17.4463569,16.0335568 17.4455155,16.0383857 17.4446387,16.0432083 C17.345843,16.5865846 16.8252597,16.9469884 16.2818833,16.8481927 L4.91303792,14.7811299 C4.53842737,14.7130189 4.23500006,14.4380834 4.13039941,14.0719812 L2.30560137,7.68518803 C2.28007524,7.59584656 2.26712532,7.50338343 2.26712532,7.4104669 C2.26712532,6.85818215 2.71484057,6.4104669 3.26712532,6.4104669 L16.9929851,6.4104669 L17.606173,3.78251876 C17.7307772,3.24850086 18.2068633,2.87071314 18.7552257,2.87071314 L20.8200821,2.87071314 C21.4717328,2.87071314 22,3.39898039 22,4.05063106 C22,4.70228173 21.4717328,5.23054898 20.8200821,5.23054898 L19.6915238,5.23054898 L18.1446364,11.84388 Z" class="svg" opacity="0.3"/><path d="M6.5,21 C5.67157288,21 5,20.3284271 5,19.5 C5,18.6715729 5.67157288,18 6.5,18 C7.32842712,18 8,18.6715729 8,19.5 C8,20.3284271 7.32842712,21 6.5,21 Z M15.5,21 C14.6715729,21 14,20.3284271 14,19.5 C14,18.6715729 14.6715729,18 15.5,18 C16.3284271,18 17,18.6715729 17,19.5 C17,20.3284271 16.3284271,21 15.5,21 Z" class="svg"/></g></svg></span><span class="text-secondary text-small flex flex-col flex-align-c flex-justify-con-c"><span>Úgy tűnik, hogy az Ön bevásárlókosara jelenleg üres. A kosárba rakott termékei itt fognak megjelenni és innen tud majd továbbnavigálni a fizetéshez is. <br><a class="underline" style="color: var(--section-title) !important;">Ide kattintva</a> fedezheti fel webshopunk által kínált termékeinket.</span></div></div>'; }
            } else { echo '<div class="text-align-c"><div class="flex flex-col flex-align-c flex-justify-con-c gap-1"><span><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="8rem" height="8rem" viewBox="0 0 24 24" version="1.1"><g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"><mask fill="white"><use xlink:href="#path-1"/></mask><g/><path d="M7,10 L7,8 C7,5.23857625 9.23857625,3 12,3 C14.7614237,3 17,5.23857625 17,8 L17,10 L18,10 C19.1045695,10 20,10.8954305 20,12 L20,18 C20,19.1045695 19.1045695,20 18,20 L6,20 C4.8954305,20 4,19.1045695 4,18 L4,12 C4,10.8954305 4.8954305,10 6,10 L7,10 Z M12,5 C10.3431458,5 9,6.34314575 9,8 L9,10 L15,10 L15,8 C15,6.34314575 13.6568542,5 12,5 Z" class="svg" /></g></svg></span><span class="text-secondary text-small flex flex-col flex-align-c flex-justify-con-c"><span>A Bevásárlókosár használatához be kell jelentkeznie. <a class="underline" style="color: var(--section-title) !important;" onclick="openHeaderProfileAction();">Ide kattintva tud bejelentkezni</a>.</span></div></div>'; }
        ?>
        </div>
    </div>
    <div class="flex flex-col gap-05 padding-tb-05">
        <div class="flex flex-col">
            <?php $ic__sql = "SELECT * FROM cart WHERE uid = $uid"; $ic__res = $con-> query($ic__sql); $num = $ic__res -> num_rows; ?>
            <span class="text-secondary small-med"><b class="text-primary" id="bsp__in"><?= $num; ?></b> termék</span>
            <div class="flex flex-row flex-align-c flex-justify-con-sb gap-05">
                <span class="text-secondary">Összesen:</span>
                <b id="subtotal" class="text-primary">0 Ft</b>
            </div>
        </div>
        <div class="flex flex-col gap-1">
            <div class="button button-secondary button-hover large bold flex flex-align-c flex-justify-con-sb" style="padding: 1rem;" onclick="window.location.href='/webshop/checkout?basket'"><span>Pénztár</span><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1"><g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"><rect x="0" y="0" width="24" height="24"></rect><rect fill="currentColor" opacity="0.3" x="2" y="5" width="20" height="14" rx="2"></rect><rect fill="currentColor" x="2" y="8" width="20" height="3"></rect><rect fill="currentColor" opacity="0.3" x="16" y="14" width="4" height="2" rx="1"></rect></g></svg></div>
        </div>
    </div>
</div>
<script>
    <?php if ($num > 0) { echo '__subcart();'; } ?>
    function __incbask (pid) {
        var bsi__data = new FormData(); bsi__data.append("pid", pid);
        $.ajax({
            enctype: "multipart/form-data", type: "POST", url: "/assets/php/basket/info.php", data: bsi__data, dataType: "json", contentType: false, processData: false,
            success: function(info) {
                if (Number(info.quantity) < Number(info.max)) { bsi__data.append("quantity", info.quantity); allquant = info.quantity;
                    $.ajax({ enctype: "multipart/form-data", type: "POST", url: "/assets/php/basket/q__up.php", data: bsi__data, dataType: "json", contentType: false, processData: false,
                        success: function(data) { document.getElementById("bsp__quantity"+pid).textContent = "x " + data; document.getElementById("bspq__inp"+pid).textContent = data; __subcart(); },
                        error: function (data) { console.log(data); }
                    });
                }
            }, error: function (data) { console.log(data); }
        });
    } function __decbask (pid) {
        var bsi__data = new FormData(); bsi__data.append("pid", pid);
        $.ajax({
            enctype: "multipart/form-data", type: "POST", url: "/assets/php/basket/info.php", data: bsi__data, dataType: "json", contentType: false, processData: false,
            success: function(info) {
                if (Number(info.quantity) > 1) { bsi__data.append("quantity", info.quantity);
                    $.ajax({ enctype: "multipart/form-data", type: "POST", url: "/assets/php/basket/q__down.php", data: bsi__data, dataType: "json", contentType: false, processData: false,
                        success: function(data) { document.getElementById("bsp__quantity"+pid).textContent = "x " + data; document.getElementById("bspq__inp"+pid).textContent = data; __subcart(); },
                        error: function (data) { console.log(data); }
                    });
                }
            }, error: function (data) { console.log(data); }
        });
    } function __delcart (pid) {
        var bsrmi__data = new FormData(); bsrmi__data.append("pid", pid);
        $.ajax({
            enctype: "multipart/form-data", type: "POST", url: "/assets/php/basket/q__remove.php", data: bsrmi__data, dataType: "json", contentType: false, processData: false,
            success: function(data) { document.getElementById('bs__item'+pid).remove(); __subcart();
                if (Number(document.getElementById("bspc__ind").textContent) === 1) { document.getElementById("bspc__ind").remove(); } 
                else { document.getElementById("bspc__ind").textContent = Number(document.getElementById("bspc__ind").textContent) - 1; }
                document.getElementById("bsp__in").textContent = Number(document.getElementById("bsp__in").textContent) - 1;
            }, error: function (data) { console.log(data); }
        });
    } function __subcart () {
        $.ajax({ enctype: "multipart/form-data", type: "POST", url: "/assets/php/basket/subinfo.php", dataType: "json", contentType: false, processData: false,
            success: function(data) { let allquant = 0; let allbase = 0; let subtotal = 0;
                if (data.length == 0) { document.getElementById("subtotal").textContent = "0 Ft"; }
                for (let i = 0; i < data.length; i++) { document.getElementById("bspq__inp"+data[i].pid).textContent = data[i].quantity; document.getElementById("prod-prc-"+data[i].pid).textContent = formatter.format(data[i].price); subtotal += Number(data[i].quantity) * Number(data[i].price);  } su__refresh(subtotal);
            }, error: function (data) { console.log(data); document.getElementById("subtotal").textContent = "0 Ft"; }
        });
    }
</script>
<script> 
function su__refresh (total) { document.getElementById("subtotal").textContent = formatter.format(total); } var isMobile; if( /Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent) ) {isMobile = true;} else {isMobile = false;}
if (isMobile) { document.getElementById('bsc__items').style.height = (document.getElementById('hib__container').offsetHeight * 70)/100+'px'; } else { document.getElementById('bsc__items').style.height = (document.getElementById('hib__container').offsetHeight * 68)/100+'px'; }
</script>