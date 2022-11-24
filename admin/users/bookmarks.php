<?php include($_SERVER['DOCUMENT_ROOT'].'/includes/inc.php');
if (isset($_SESSION['loggedin'])) {
    $stmt = $con->prepare('SELECT privilege FROM customers__priv  WHERE uid = ?'); if (isset($_SESSION['loggedin'])) {$id = $_SESSION['id'];} $stmt->bind_param('i', $id);$stmt->execute(); $stmt->bind_result($privilege); $stmt->fetch();$stmt->close();
    if ($privilege != 2) { echo "<script>window.location.href='/';</script>"; }
} else { header("Location: /"); }
$guid = $_SESSION['guid']; $gname = $_SESSION['gname'];
?>
<div class="flex flex-col gap-1">
    <div class="flex flex-col w-fa gap-1 border-soft item-bg box-shadow padding-1">
        <div class="flex flex-row flex-align-c flex-justify-con-sb">
            <span class="text-primary large bold"><?= $gname; ?> mentett termékei</span>
            <div class="flex flex-row flex-align-c gap-1">
                <span class="flex flex-row flex-align-c flex-justify-con-c padding-05 border-soft-light primary-bg primary-bg-hover pointer user-select-none small-med" id="add__bmarked__item">Hozzáadás</span>
            </div>
        </div><br>
        <div class="flex flex-col flex-align-c gap-1">
            <div class="flex flex-col flex-align-c gap-1 w-100" id="usc__con">
            <?php include "/assets/php/basket/q__up.php";
                if (isset($_SESSION['loggedin'])) {if (isset($_SESSION['guid'])) {$uid = $_SESSION['guid'];}}
                if (isset($uid)) { $pr_sql = "SELECT products.id AS `pid`, products.name, products.thumbnail, products__inventory.quantity AS invquantity, products__inventory.q__warehouse, products__variations.color, products__variations.brand, products__pricing.base, bookmarks.added FROM bookmarks INNER JOIN products__inventory ON products__inventory.pid = bookmarks.pid INNER JOIN products ON products.id = bookmarks.pid INNER JOIN products__variations ON products__variations.pid = bookmarks.pid INNER JOIN products__pricing ON products__pricing.pid = bookmarks.pid WHERE bookmarks.uid = '".$uid."'"; $pr_res = $con-> query($pr_sql);
                    if ($pr_res-> num_rows > 0) { $subtot = 0;
                        echo '
                        <div class="flex flex-row gap-1 w-fa">
                            <div class="flex flex-row w-fa gap-05 small text-muted">
                                <div class="flex flex-row flex-align-c gap-1">
                                    <label class="cst-chb-lbl">
                                        <input type="checkbox" class="absolute" id="check_all_bmarked">
                                        <span class="cst-checkbox"></span>
                                    </label>
                                    <span>Összes kijelölése ('.$pr_res-> num_rows.')</span>
                                </div>
                            </div>
                            <span class="text-secondary user-select-none small" id="dlt-bmi-slt">Eltávolítás</span>
                        </div>
                        ';
                        while ($product = $pr_res-> fetch_assoc()) { $pid = $product['pid'];
                            $disc_sql = "SELECT bookmarks.added, products__pricing.pid AS pid, products__pricing.discount, products__pricing.base FROM bookmarks INNER JOIN products__pricing ON products__pricing.pid = bookmarks.pid WHERE bookmarks.uid = $uid AND bookmarks.pid = $pid"; $disc_res = $con-> query($disc_sql);
                            if ($disc_res-> num_rows > 0) { $disc = $disc_res-> fetch_assoc(); $newprice = ($disc['discount'] * $disc['base']) / 100; $dprice = $product['base'] - $newprice; $subtot += $newprice * $product['quantity'];
                            } else { $subtot += $product['base'] * $product['quantity']; $dprice = $product['base']; }
                            echo '
                                <div class="flex flex-row flex-align-c flex-justify-con-sb gap-05 padding-05 w-fa border-soft-light" id="bm__item'.$product['pid'].'">
                                    <div class="flex flex-row flex-align-c gap-05">
                                        <div class="flex flex-row flex-align-c flex-justify-con-c padding-05" style="margin-right: .5rem;">
                                            <label class="cst-chb-lbl">
                                                <input type="checkbox" class="absolute chifb" id="sel-bm-'.$product['pid'].'" onclick="__selectbmitem('.$product['pid'].')">
                                                <span class="cst-checkbox"></span>
                                            </label>
                                        </div>
                                        <div class="bsc__img flex flex-col flex-align-c flex-justify-con-c gap-025">
                                            <img class="bs__img drop-shadow" src="/assets/images/uploads/'.$product['thumbnail'].'" alt="'.$product['name'].'" style="height: 4rem; object-fit: contain;" />
                                            <span onclick="rtubm('.$product['pid'].')" id="rm__bmi'.$product['pid'].'" class="text-primary small-med pointer link">Eltávolítás</span>
                                        </div>
                                        <div class="flex flex-col gap-05">
                                            <div class="flex flex-col gap-025">
                                                <a class="text-primary small pointer link bold" href="/product/'.$product['pid'].'/'; echo str_replace(',', '', str_replace(' ', '-',strtolower(strtr($product['brand'], $unwanted_array)))).'-'.str_replace(',', '', str_replace(' ', '-',strtolower(strtr($product['name'], $unwanted_array)))).'-'.str_replace(',', '', str_replace(' ', '-', strtolower(strtr($product['color'], $unwanted_array)))); echo '" target="_blank">'. $product['name'] .'</a>
                                                <span class="text-muted small-med">'.$product['brand'].' - '.$product['color'].'</span>
                                                <span class="text-muted small-med">'.$product['added'].'</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            ';
                        }
                    } else { echo '<div class="text-align-c user-select-none"><div class="flex flex-col flex-align-c flex-justify-con-c gap-1"><span class="text-muted"><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="10rem" height="10rem" viewBox="0 0 24 24" version="1.1"><g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"><rect x="0" y="0" width="24" height="24"></rect><path d="M8,4 L16,4 C17.1045695,4 18,4.8954305 18,6 L18,17.726765 C18,18.2790497 17.5522847,18.726765 17,18.726765 C16.7498083,18.726765 16.5087052,18.6329798 16.3242754,18.4639191 L12.6757246,15.1194142 C12.2934034,14.7689531 11.7065966,14.7689531 11.3242754,15.1194142 L7.67572463,18.4639191 C7.26860564,18.8371115 6.63603827,18.8096086 6.26284586,18.4024896 C6.09378519,18.2180598 6,17.9769566 6,17.726765 L6,6 C6,4.8954305 6.8954305,4 8,4 Z" fill="currentColor"></path></g></svg></span><span class="text-secondary text-small flex flex-col flex-align-c flex-justify-con-c"><span>Úgy tűnik, hogy '.$gname.' még nem mentett egy terméket sem.</span></div></div>'; }
                } else { echo '<div class="text-align-c"><div class="flex flex-col flex-align-c flex-justify-con-c gap-1"><span><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="8rem" height="8rem" viewBox="0 0 24 24" version="1.1"><g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"><mask fill="white"><use xlink:href="#path-1"/></mask><g/><path d="M7,10 L7,8 C7,5.23857625 9.23857625,3 12,3 C14.7614237,3 17,5.23857625 17,8 L17,10 L18,10 C19.1045695,10 20,10.8954305 20,12 L20,18 C20,19.1045695 19.1045695,20 18,20 L6,20 C4.8954305,20 4,19.1045695 4,18 L4,12 C4,10.8954305 4.8954305,10 6,10 L7,10 Z M12,5 C10.3431458,5 9,6.34314575 9,8 L9,10 L15,10 L15,8 C15,6.34314575 13.6568542,5 12,5 Z" class="svg" /></g></svg></span><span class="text-secondary text-small flex flex-col flex-align-c flex-justify-con-c"><span>A Bevásárlókosár használatához be kell jelentkeznie. <a class="underline" style="color: var(--section-title) !important;" onclick="openHeaderProfileAction();">Ide kattintva tud bejelentkezni</a>.</span></div></div>'; }
            ?>
            </div>
        </div>
    </div>
</div>
<script src="/admin/users/profile/script/bookmarks.js"></script>
<script>
$('#add__bmarked__item').click(() => {
    var c__wrapper = document.createElement('div'); c__wrapper.classList = "wrapper_dark fadein"; var c__box = document.createElement('div'); c__box.classList = "d__confirm popup fixed flex flex-col border-soft item-bg box-shadow padding-1";
    c__wrapper.classList.add('fadein'); c__wrapper.classList.remove('fadeout'); c__box.classList.add('padding-t-0'); c__box.classList.add('popup'); c__box.classList.remove('popout'); document.body.append(c__wrapper); c__wrapper.append(c__box); $('html').css("overflow-y", "hidden");
    c__box.innerHTML = `
    <div class="flex flex-row flex-align-c flex-justify-con-sb padding-t-1" id="cbh__con">
        <span class="text-primary small bold">Termékek kiválasztása</span>
        <div class="flex flex-row flex-align-c gap-05">
            <span class="text-primary pointer" aria-label="Bezárás" id="cl__box"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"><rect opacity="0.3" x="2" y="2" width="20" height="20" rx="5" fill="currentColor"/><rect x="7" y="15.3137" width="12" height="2" rx="1" transform="rotate(-45 7 15.3137)" fill="currentColor"/><rect x="8.41422" y="7" width="12" height="2" rx="1" transform="rotate(45 8.41422 7)" fill="currentColor"/></svg></span>
        </div>
    </div><br>
    <div class="flex flex-col flex-align-c flex-justify-con-c gap-1">
        <div class="flex flex-row gap-05 w-fa">
            <span class="sidenav-search w-fa">
                <input type="search" name="sidenav-search" class="sidenav-search-input w-fa background-bg" id="bookmarks-search" placeholder="Keresés..." onkeyup="__searchbookmarks()">
            </span>
        </div>
        <div class="flex flex-row flex-justify-con-c flex-wrap gap-1 hide-scroll" id="subm-con" style="max-height: 50vh; overflow:scroll;"></div>
    </div>
    `; var selData = new FormData(); selData.append("uid", <?= $guid; ?>);
    $.ajax({ enctype: "multipart/form-data", type: "POST", url: "/admin/users/bookmarks/sel-new.php", data: selData, dataType: "json", contentType: false, processData: false,
        beforeSend: function () {
            document.getElementById('subm-con').innerHTML = `<div class="flex flex-col flex-align-c w-fa gap-05 text-muted"><span><svg class='wizard_input_loading' xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="64" height="64" viewBox="0 0 24 24" version="1.1"><g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"><g><polygon points="0 0 24 0 24 24 0 24"/></g><path d="M12,4 L12,6 C8.6862915,6 6,8.6862915 6,12 C6,15.3137085 8.6862915,18 12,18 C15.3137085,18 18,15.3137085 18,12 C18,10.9603196 17.7360885,9.96126435 17.2402578,9.07513926 L18.9856052,8.09853149 C19.6473536,9.28117708 20,10.6161442 20,12 C20,16.418278 16.418278,20 12,20 C7.581722,20 4,16.418278 4,12 C4,7.581722 7.581722,4 12,4 Z" class="svg" fill-rule="nonzero" opacity="0.4" transform="translate(12.000000, 12.000000) scale(-1, 1) translate(-12.000000, -12.000000) "/></g></svg></span><span>Termékek megjelenítése folyamatban</span></div>`;
        }, success: function(data) { document.getElementById('subm-con').innerHTML = ``;
            for (let i = 0; i < data.length; i++) {
                document.getElementById('subm-con').innerHTML += `
                    <span class="flex flex-col item-bg border-soft-light border-secondary user-select-none" style="width: 45%;">
                        <label search-key="${data[i].name.toUpperCase().replaceAll(/ /g, '')}" class="hidden"></label>
                        <div class="product-hover">
                            <div class="flex flex-col flex-align-c flex-justify-con-sb padding-1 gap-05">
                                <span class="text-secondary bold small uppercase w-fa text-align-c">${data[i].brand}</span>
                            </div>
                            <div class="flex flex-col flex-align-c gap-1">
                                <div class="flex flex-col flex-align-c product-image-container" style="max-width: 8rem !important;">
                                    <img src="/assets/images/uploads/${data[i].thumbnail}" alt="${data[i].name}" class="ind-prd-crd-img drop-shadow">
                                </div>
                                <div class="flex flex-row flex-justify-con-sb">
                                    <div class="flex flex-col flex-align-c flex-justify-con-c gap-05 padding-05 w-fa">
                                        <span class="text-primary small-med bold w-fa text-align-c">${data[i].name.substring(0, 80)}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="flex flex-row flex-justify-con-c padding-025 margin-top-a">
                            <span class="flex flex-row flex-align-c flex-justify-con-sb gap-1 label-primary primary-bg-hover border-soft-light padding-025-05 pointer" style="font-size: .85rem;" id="atubm-${data[i].id}" onclick="atubm(${data[i].id})">Hozzáadás</span>
                        </div>
                    </span>
                `;
            }
        }, error: function (data) { console.log(data); document.getElementById('subm-con').innerHTML = `<div class="flex flex-col flex-align-c w-fa gap-05 text-muted"><span><svg width="64" height="64" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><rect opacity="0.5" x="17.0365" y="15.1223" width="8.15546" height="2" rx="1" transform="rotate(45 17.0365 15.1223)" class="svg"></rect><path d="M11 19C6.55556 19 3 15.4444 3 11C3 6.55556 6.55556 3 11 3C15.4444 3 19 6.55556 19 11C19 15.4444 15.4444 19 11 19ZM11 5C7.53333 5 5 7.53333 5 11C5 14.4667 7.53333 17 11 17C14.4667 17 17 14.4667 17 11C17 7.53333 14.4667 5 11 5Z" class="svg"></path></svg></span><span>Hiba lépett fel a termékek megjelenítése közben.</span></div>`; }
    });
    var con = document.getElementById('cbh__con');var mc = new Hammer(con);mc.get('pan').set({ direction: Hammer.DIRECTION_ALL });mc.on("pandown", function(ev) { $('#cl__box').click(); });
    $('#cl__box').click(function () { c__wrapper.classList.add('fadeout'); c__box.classList.add('popout'); setTimeout(() => { c__wrapper.remove(); $('html').css("overflow-y", "unset"); }, 200); });
});
function atubm (id) {
    var atubmData = new FormData(); atubmData.append('uid', <?= $guid; ?>); atubmData.append('pid', id); let apiKey = "739837e232548988c86b954108794b57bd3e1dbcd6eb550bfa53e544";
    $.getJSON("https://api.ipdata.co?api-key=" + apiKey, function(gip) { atubmData.append("ip", gip.ip);
        $.ajax({ enctype: "multipart/form-data", type: "POST", url: "/admin/users/bookmarks/add-item.php", data: atubmData, dataType: "json", contentType: false, processData: false,
            beforeSend: function () {
                document.getElementById('atubm-'+id).classList = "flex flex-row flex-align-c flex-justify-con-sb gap-1 label-secondary border-soft-light padding-025-05";
                document.getElementById('atubm-'+id).innerHTML = `<span>Folyamatban</span><svg class='wizard_input_loading' xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="18" height="18" viewBox="0 0 24 24" version="1.1"><g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"><g><polygon points="0 0 24 0 24 24 0 24"/></g><path d="M12,4 L12,6 C8.6862915,6 6,8.6862915 6,12 C6,15.3137085 8.6862915,18 12,18 C15.3137085,18 18,15.3137085 18,12 C18,10.9603196 17.7360885,9.96126435 17.2402578,9.07513926 L18.9856052,8.09853149 C19.6473536,9.28117708 20,10.6161442 20,12 C20,16.418278 16.418278,20 12,20 C7.581722,20 4,16.418278 4,12 C4,7.581722 7.581722,4 12,4 Z" fill="currentColor" fill-rule="nonzero" opacity="0.4" transform="translate(12.000000, 12.000000) scale(-1, 1) translate(-12.000000, -12.000000) "/></g></svg>`; document.getElementById('atubm-'+id).removeAttribute('onclick');
            }, success: function(data) { document.getElementById('tabs-bookmarks').click();
                document.getElementById('atubm-'+id).classList = "flex flex-row flex-align-c flex-justify-con-sb gap-1 label-success border-soft-light padding-025-05";
                document.getElementById('atubm-'+id).innerHTML = `<span>Hozzáadva</span><svg width="18" height="18" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><rect opacity="0.3" x="2" y="2" width="20" height="20" rx="10" fill="currentColor"/><path d="M10.4343 12.4343L8.75 10.75C8.33579 10.3358 7.66421 10.3358 7.25 10.75C6.83579 11.1642 6.83579 11.8358 7.25 12.25L10.2929 15.2929C10.6834 15.6834 11.3166 15.6834 11.7071 15.2929L17.25 9.75C17.6642 9.33579 17.6642 8.66421 17.25 8.25C16.8358 7.83579 16.1642 7.83579 15.75 8.25L11.5657 12.4343C11.2533 12.7467 10.7467 12.7467 10.4343 12.4343Z" fill="currentColor"/></svg>`;
            }, error: function(data) {
                document.getElementById('atubm-'+id).classList = "flex flex-row flex-align-c flex-justify-con-sb gap-1 label-danger border-soft-light padding-025-05";
                document.getElementById('atubm-'+id).innerHTML = `<span>Hiba</span><svg width="18" height="18" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><rect opacity="0.3" x="2" y="2" width="20" height="20" rx="10" fill="currentColor"/><rect x="11" y="14" width="7" height="2" rx="1" transform="rotate(-90 11 14)" fill="currentColor"/><rect x="11" y="17" width="2" height="2" rx="1" transform="rotate(-90 11 17)" fill="currentColor"/></svg>`;
            }
        });
    });
} function rtubm (pid) {
    var c__wrapper = document.createElement('div'); c__wrapper.classList = "wrapper_dark fadein"; var c__box = document.createElement('div'); c__box.classList = "d__confirm popup fixed flex flex-col border-soft item-bg box-shadow padding-1";
    c__wrapper.classList.add('fadein'); c__wrapper.classList.remove('fadeout'); c__box.classList.add('padding-t-0'); c__box.classList.add('popup'); c__box.classList.remove('popout'); document.body.append(c__wrapper); c__wrapper.append(c__box); $('html').css("overflow-y", "hidden");
    let bmic = pid.length ? pid.length : 1;
    c__box.innerHTML = `
    <div class="flex flex-row flex-align-c flex-justify-con-sb padding-t-1" id="cbh__con">
        <span class="text-primary small bold">Termékek eltávolítása</span>
        <div class="flex flex-row flex-align-c gap-05">
            <span class="text-primary pointer" aria-label="Bezárás" id="cl__box"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"><rect opacity="0.3" x="2" y="2" width="20" height="20" rx="5" fill="currentColor"/><rect x="7" y="15.3137" width="12" height="2" rx="1" transform="rotate(-45 7 15.3137)" fill="currentColor"/><rect x="8.41422" y="7" width="12" height="2" rx="1" transform="rotate(45 8.41422 7)" fill="currentColor"/></svg></span>
        </div>
    </div><br>
    <div class="flex flex-col gap-2">
        <div class="flex flex-col flex-align-c flex-justify-con-c text-align-c text-muted user-select-none w-fa">
            <div id="rm-st-bkmi-svg">
                <svg width="128" height="128" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M5 9C5 8.44772 5.44772 8 6 8H18C18.5523 8 19 8.44772 19 9V18C19 19.6569 17.6569 21 16 21H8C6.34315 21 5 19.6569 5 18V9Z" fill="currentColor"/><path opacity="0.5" d="M5 5C5 4.44772 5.44772 4 6 4H18C18.5523 4 19 4.44772 19 5V5C19 5.55228 18.5523 6 18 6H6C5.44772 6 5 5.55228 5 5V5Z" fill="currentColor"/><path opacity="0.5" d="M9 4C9 3.44772 9.44772 3 10 3H14C14.5523 3 15 3.44772 15 4V4H9V4Z" fill="currentColor"/></svg>
            </div>
            <span style="font-size: .9rem !important;" id="rm-st-bkmi-inf">Biztos benne, hogy törölni kívánja a kijelölt <strong>`+bmic+`</strong> elemet?</span>
        </div>
        <div class="flex flex-row flex-align-c flex-justify-con-fe gap-1 user-select-none" style="font-size: .7rem !important;">
            <span class="text-primary pointer user-select-none link" onclick="document.getElementById('cl__box').click()" id="rm-st-bkmi-cncl">Mégsem</span>
            <span class="danger-bg danger-bg-hover border-soft-light padding-05 user-select-none pointer" id="rm-st-bkmi">Eltávolítás</span>
        </div>
    </div>
    `;
    var con = document.getElementById('cbh__con');var mc = new Hammer(con);mc.get('pan').set({ direction: Hammer.DIRECTION_ALL });mc.on("pandown", function(ev) { $('#cl__box').click(); });
    $('#cl__box').click(function () { c__wrapper.classList.add('fadeout'); c__box.classList.add('popout'); setTimeout(() => { c__wrapper.remove(); $('html').css("overflow-y", "unset"); }, 200); });
    $('#rm-st-bkmi').click(() => {
        var rtubmData = new FormData(); rtubmData.append("uid", <?= $guid; ?>); rtubmData.append('pid', pid); let apiKey = "739837e232548988c86b954108794b57bd3e1dbcd6eb550bfa53e544";
        $.getJSON("https://api.ipdata.co?api-key=" + apiKey, function(gip) { rtubmData.append("ip", gip.ip);
            $.ajax({ enctype: "multipart/form-data", type: "POST", url: "/admin/users/bookmarks/remove-item.php", data: rtubmData, dataType: "json", contentType: false, processData: false,
                beforeSend: function () {
                    document.getElementById('rm-st-bkmi').classList = "flex flex-row flex-align-c flex-justify-con-sb gap-1 label-secondary border-soft-light padding-025-05"; $('#rm-st-bkmi').off('click');
                    document.getElementById('rm-st-bkmi').innerHTML = `<span>Folyamatban</span><svg class='wizard_input_loading' xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="18" height="18" viewBox="0 0 24 24" version="1.1"><g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"><g><polygon points="0 0 24 0 24 24 0 24"/></g><path d="M12,4 L12,6 C8.6862915,6 6,8.6862915 6,12 C6,15.3137085 8.6862915,18 12,18 C15.3137085,18 18,15.3137085 18,12 C18,10.9603196 17.7360885,9.96126435 17.2402578,9.07513926 L18.9856052,8.09853149 C19.6473536,9.28117708 20,10.6161442 20,12 C20,16.418278 16.418278,20 12,20 C7.581722,20 4,16.418278 4,12 C4,7.581722 7.581722,4 12,4 Z" fill="currentColor" fill-rule="nonzero" opacity="0.4" transform="translate(12.000000, 12.000000) scale(-1, 1) translate(-12.000000, -12.000000) "/></g></svg>`;
                    document.getElementById('rm-st-bkmi-cncl').textContent = "Bezárás";
                }, success: function(data) { document.getElementById('tabs-bookmarks').click();
                    document.getElementById('rm-st-bkmi').classList = "flex flex-row flex-align-c flex-justify-con-sb gap-1 label-success border-soft-light padding-025-05";
                    document.getElementById('rm-st-bkmi').remove();
                    document.getElementById('rm-st-bkmi-svg').parentNode.classList.replace('text-muted', 'text-success');
                    document.getElementById('rm-st-bkmi-inf').innerHTML = `A termékeket sikeresen eltávolította a felhasználó kosarából.`;
                    document.getElementById('rm-st-bkmi-svg').innerHTML = `<svg width="128" height="128" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><rect opacity="0.3" x="2" y="2" width="20" height="20" rx="10" fill="currentColor"/><path d="M10.4343 12.4343L8.75 10.75C8.33579 10.3358 7.66421 10.3358 7.25 10.75C6.83579 11.1642 6.83579 11.8358 7.25 12.25L10.2929 15.2929C10.6834 15.6834 11.3166 15.6834 11.7071 15.2929L17.25 9.75C17.6642 9.33579 17.6642 8.66421 17.25 8.25C16.8358 7.83579 16.1642 7.83579 15.75 8.25L11.5657 12.4343C11.2533 12.7467 10.7467 12.7467 10.4343 12.4343Z" fill="currentColor"/></svg>`;
                }, error: function(data) { console.log(data);
                    document.getElementById('rm-st-bkmi').remove();
                    document.getElementById('rm-st-bkmi-svg').parentNode.classList.replace('text-muted', 'text-danger');
                    document.getElementById('rm-st-bkmi-inf').innerHTML = `Hiba történt a termékek eltávolítása közben. Kérjük ellenőrizze, hogy minden adat megfelel-e, majd próbálja újra.`;
                    document.getElementById('rm-st-bkmi-svg').innerHTML = `<svg width="128" height="128" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><rect opacity="0.3" x="2" y="2" width="20" height="20" rx="10" fill="currentColor"/><rect x="11" y="14" width="7" height="2" rx="1" transform="rotate(-90 11 14)" fill="currentColor"/><rect x="11" y="17" width="2" height="2" rx="1" transform="rotate(-90 11 17)" fill="currentColor"/></svg>`;
                }
            });
        });
    });
} function __searchbookmarks () {
    var input, filter, con, item, i, txtValue; input = document.getElementById("bookmarks-search");filter = input.value.toUpperCase();
    con = document.getElementById("subm-con");item = con.getElementsByTagName("label");
    for (i = 0; i < item.length; i++) {txtValue = item[i].getAttribute('search-key');
        if (txtValue.toUpperCase().indexOf(filter) > -1) {item[i].parentNode.style.display = "";}
        else {item[i].parentNode.style.display = "none";}
    }
}
</script>