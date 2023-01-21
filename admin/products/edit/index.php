<?php require_once($_SERVER['DOCUMENT_ROOT'].'/includes/header.php'); if (!isset($_SESSION['loggedin'])) { echo "<script>window.location.href='/';</script>"; die(); }
    $sql = "SELECT products.id, products.name, products.thumbnail, products.added, products__variations.color, products__pricing.base, products__inventory.quantity, products__inventory.unit, products__category.category, products__category.tags, products__status.status, products__status.schedule FROM `products` INNER JOIN products__variations ON products__variations.pid = products.id INNER JOIN products__pricing ON products__pricing.pid = products.id INNER JOIN products__inventory ON products__inventory.pid = products.id INNER JOIN products__category ON products__category.pid = products.id INNER JOIN products__status ON products__status.pid = products.id WHERE products.id = {$params['id']}"; if ($result = $con->query($sql)) {$product = $result->fetch_array();} else {header("Location: /500");}
    switch ($product['status']) {
        case 1: $status = '<span class="border-soft-light primary-bg padding-025 smaller-light">Aktív</span>'; break;
        case 2: $status = '<span class="border-soft-light background-bg padding-025 smaller-light">Vázlat</span>'; break;
        case 3: $status = '<span class="border-soft-light warning-bg padding-025 smaller-light">Ütemezett</span>'; $schedule = date("Y-m-d\TH:i", strtotime($product['schedule'])); break;
        case 4: $status = '<span class="border-soft-light danger-bg padding-025 smaller-light">Inaktív</span>'; break;
    }
?>
<script>var formatter = new Intl.NumberFormat('hu-HU', {style: 'currency',currency: 'HUF',maximumFractionDigits: 0,minimumFractionDigits: 0});</script>
<script src="/assets/script/chart/dist/chart.js"></script><script src="/assets/script/tagify/dist/tagify.js"></script>
<main id="main">
<div class="prod-con" id="tabs">
    <div class="leftcolumn w-25d-100m">
        <div class="card border-soft box-shadow relative">
            <div class="flex flex-row flex-justify-con-fe w-fa">
                <div class="flex flex-row flex-align-c gap-1">
                    <div error-data="thumbnail"></div>
                    <div class="flex flex-row flex-justify-con-fe w-fa">
                        <div onclick="__saveitem(<?= $params['id'] ?>, 'thumbnail')" class="flex flex-row flex-align-c flex-justify-con-sb gap-1 primary-bg primary-bg-hover pointer user-select-none padding-05 border-soft-light">
                            <span class="smaller-light">Mentés</span>
                        </div>
                    </div>
                </div>
            </div><br><br>
            <div class="flex flex-row flex-align-c flex-justify-con-c gap-1 w-100">
                <div class="flex flex-col flex-align-c flex-justify-con-c gap-1">
                    <div class="relative">
                        <div id="thumbnail-preview">
                            <img src="/assets/images/uploads/<?= $product['thumbnail'] ?>" id="product-thumbnail-demo" class="drop-shadow-dark border-soft" style="width: 120px;">
                        </div>
                        <label style="top: -10%; right: -10%;" class="flex flex-align-c flex-justify-con-c padding-025 absolute item-bg circle text-muted link-color box-shadow-dark pointer" title="Szerkesztés" aria-label="Szerkesztés" role="button">
                            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path opacity="0.3" d="M21.4 8.35303L19.241 10.511L13.485 4.755L15.643 2.59595C16.0248 2.21423 16.5426 1.99988 17.0825 1.99988C17.6224 1.99988 18.1402 2.21423 18.522 2.59595L21.4 5.474C21.7817 5.85581 21.9962 6.37355 21.9962 6.91345C21.9962 7.45335 21.7817 7.97122 21.4 8.35303ZM3.68699 21.932L9.88699 19.865L4.13099 14.109L2.06399 20.309C1.98815 20.5354 1.97703 20.7787 2.03189 21.0111C2.08674 21.2436 2.2054 21.4561 2.37449 21.6248C2.54359 21.7934 2.75641 21.9115 2.989 21.9658C3.22158 22.0201 3.4647 22.0084 3.69099 21.932H3.68699Z" fill="currentColor"/><path d="M5.574 21.3L3.692 21.928C3.46591 22.0032 3.22334 22.0141 2.99144 21.9594C2.75954 21.9046 2.54744 21.7864 2.3789 21.6179C2.21036 21.4495 2.09202 21.2375 2.03711 21.0056C1.9822 20.7737 1.99289 20.5312 2.06799 20.3051L2.696 18.422L5.574 21.3ZM4.13499 14.105L9.891 19.861L19.245 10.507L13.489 4.75098L4.13499 14.105Z" fill="currentColor"/></svg>
                            <input type="file" id="product-thumbnail" class="hidden">
                        </label>
                    </div>
                    <span class="text-muted small-med w-70 text-align-c">Állítsa be a termék miniatűrjét. Csak *.png, *.jpg és *.jpeg képfájlokat fogadunk el.</span>
                </div>
            </div>
        </div>
        <div class="card border-soft box-shadow">
            <div class="flex flex-col gap-1">
                <div class="flex flex-row flex-align-c flex-justify-con-sb gap-05">
                    <span class="text-primary small">Státusz</span>
                    <div class="flex flex-row flex-align-c gap-1">
                        <div error-data="status"></div>
                        <div class="flex flex-row flex-justify-con-fe w-fa">
                            <div onclick="__saveitem(<?= $params['id'] ?>, 'status')" class="flex flex-row flex-align-c flex-justify-con-sb gap-1 primary-bg primary-bg-hover pointer user-select-none padding-05 border-soft-light">
                                <span class="smaller-light">Mentés</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="flex flex-col gap-1">
                    <div class="flex flex-row flex-align-c flex-justify-con-c gap-05">
                        <div class="flex w-fa user-select-none">
                            <div class="csts-select csts-select-fnc w-fa relative" id="prd-st-con">
                                <select class="hidden relative" id="product-status">
                                    <option value="0">Státusz</option>
                                    <option value="1">Aktív</option>
                                    <option value="2">Vázlat</option>
                                    <option value="3">Ütemezett</option>
                                    <option value="4">Inaktív</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div id="prd-st-sch-con"></div>
                    <div class="flex flex-row flex-align-c flex-justify-con-c gap-05">
                        <span class="text-muted small-med">Jelenlegi státusz:</span>
                        <?= $status; ?>
                    </div>
                </div>
            </div>
        </div>
        <div class="card border-soft flex flex-col box-shadow gap-1">
            <div class="flex flex-col gap-1">
                <div class="flex flex-row flex-align-c flex-justify-con-sb gap-05">
                    <span class="text-primary small">Kategória</span>
                    <div class="flex flex-row flex-align-c gap-1">
                        <div error-data="category"></div>
                        <div class="flex flex-row flex-justify-con-fe w-fa">
                            <div onclick="__saveitem(<?= $params['id'] ?>, 'category')" class="flex flex-row flex-align-c flex-justify-con-sb gap-1 primary-bg primary-bg-hover pointer user-select-none padding-05 border-soft-light">
                                <span class="smaller-light">Mentés</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="flex flex-col gap-1">
                    <div class="flex flex-col flex-align-c flex-justify-con-c gap-05">
                        <input name="product-category" id="product-category" class="adm__input w-fa border-soft cst-drp-fts small prd-ch-fr-er" value="<?= $product['category']; ?>" placeholder="Kategória" tabindex="-1">
                        <script>
                            var categ__inp = document.querySelector('input[name="product-category"]'),
                            tagify = new Tagify(categ__inp, {
                                whitelist: [<?php $clr__sql = "SELECT DISTINCT category FROM `products__category` WHERE 1"; $clr__res = $con-> query($clr__sql); while ($clr = $clr__res-> fetch_assoc()) { echo "'".ucfirst($clr['category'])."',"; } ?>],
                                maxTags: 1, dropdown: { maxItems: 10, classname: "tags-look", enabled: 0, closeOnSelect: false },
                                originalInputValueFormat: valuesArr => valuesArr.map(item => item.value).join(',')
                            })
                        </script>
                        <div class="flex flex-row flex-align-c flex-justify-con-c w-fa">
                            <span class="text-muted small-med w-fa">Sorolja be a terméket egy új kategóriába.</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="flex flex-col gap-1">
                <div class="flex flex-row flex-align-c flex-justify-con-sb gap-05">
                    <span class="text-primary small">Címkék</span>
                </div>
                <div class="flex flex-row w-fa">
                    <input name='input-custom-dropdown' id="product-tags" class='w-fa border-soft small-med' placeholder='Címkék hozzáadása' value='<?php echo $product['tags']; ?>'>
                </div>
                <script>
                    var input = document.querySelector('input[name="input-custom-dropdown"]'),
                    tagify = new Tagify(input, {
                    whitelist: [
                        'Limitált', 'Új termék', 'Kelendő', 'Népszerű',
                        <?php $pid = $params['id']; $dsc_sql = "SELECT * FROM `products__pricing` WHERE id = $pid AND discounted IS TRUE AND end > NOW()"; $dsc_res = $con-> query($dsc_sql);
                        echo "'".ucfirst($product['color']). "',"; echo "'".ucfirst($product['category']). "',"; 
                        if ($dsc_res-> num_rows > 0) { echo "'Akciós',"; }
                        if ($product['quantity'] < 1) { echo "'Elfogyott',"; } else if ($product['quantity'] > 0 && $product['quantity'] < 10) { echo "'Kifutó termék',"; } else { echo "'Raktáron',"; }
                        if ($product['base'] < 2500) { echo "'2 500 Ft alatti',"; }
                        ?>
                    ], maxTags: 10, dropdown: { maxItems: 10, classname: "tags-look", enabled: 0, closeOnSelect: false }, originalInputValueFormat: valuesArr => valuesArr.map(item => item.value).join(',')
                    })
                </script>
            </div>
        </div>
        <!-- <div id="ims__chrt" class="card border-soft box-shadow padding-0">
            <div class="flex flex-col gap-1">
                <div class="flex flex-col w-fa gap-05 padding-1">
                    <span class="larger text-primary bold" id="lastsvnsales__ind"></span>
                    <span class="text-muted small-med">Havi eladások</span>
                </div>
                <div class="flex flex-col gap-05 margin-top-a">
                    <div class="flex flex-row gap-05">
                        <div class="flex flex-row flex-wrap-no">
                        <canvas id="dailysales__chart" width="" height="80px"></canvas>
                        <script id="dlysls__script">
                            var recentchart = document.getElementById('dailysales__chart');
                            var footer = (tooltipItems) => { let sum = 0; tooltipItems.forEach(function(tooltipItem) { sum += tooltipItem.parsed.y; }); return 'Eladva: ' + sum; };
                            var rcChart = new Chart(recentchart, { type: 'bar',
                                data: {
                                    labels: [
                                        <?php
                                            // $lastsevenqty = 0; $dly__sql = "SELECT DAY(date) AS date FROM `orders` WHERE MONTH(CURRENT_DATE) = MONTH(date) AND pid = {$product['id']} GROUP BY DAY(date)"; $dly__res = $con-> query($dly__sql);
                                            // if ($dly__res-> num_rows > 0) { while ($data = $dly__res-> fetch_assoc()) { echo "'". date("F")." ".$data['date']."',"; } }
                                        ?>
                                    ],
                                    datasets: [{
                                        data: [
                                            <?php
                                                // $dly__sql = "SELECT SUM(quantity) AS qty FROM `orders` WHERE MONTH(CURRENT_DATE) = MONTH(date) AND pid = {$product['id']} GROUP BY DAY(date)"; $dly__res = $con-> query($dly__sql);
                                                // if ($dly__res-> num_rows > 0) { while ($data = $dly__res-> fetch_assoc()) { echo "'".$data['qty']."',"; $lastsevenqty += $data['qty']; } }
                                            ?>
                                        ], backgroundColor: 'rgb(0, 158, 247)', hoverOffset: 2, borderRadius: 50, maxBarThickness: 10
                                    }]
                                }, options: { plugins: { legend: { display: false }, tooltip: { callbacks: { footer: footer, }, bodySpacing: 0, bodyFont: { size: '0' }, bodyColor: 'transparent', displayColors: false } }, scales: { x: { display: false, }, y: { display: false, } } }
                            }); document.getElementById('lastsvnsales__ind').textContent = <?php // echo $lastsevenqty; ?>;
                        </script>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <script>let sales = <?php // echo $lastsevenqty; ?>;
            if (sales < 1) { document.getElementById('ims__chrt').remove(); }
        </script> -->
    </div>
    <div class="spancolumn w-75d-100m">
        <div class="flex flex-row flex-align-c padding-1 padding-b-0">
            <span class="text-muted small-med"><a class="link link-color pointer" href="/admin/">Admin</a> / <a class="link link-color pointer" href="/admin/?tab=products">Termékek</a> / Szerkesztés / <a class="text-muted"><?php echo $product['name']; ?></a></span>
        </div>
        <div class="flex flex-row flex-align-c gap-2 padding-1 text-muted user-select-none">
            <span onclick="showPanel(event, 'tab-general')" id="tabs-general" tab-data="general" class="pr__item padding-b-1 pointer">Általános</span>
            <span onclick="showPanel(event, 'tab-advanced')" id="tabs-advanced" tab-data="advanced" class="pr__item padding-b-1 pointer">Haladó</span>
            <span onclick="showPanel(event, 'tab-reviews')" id="tabs-reviews" tab-data="reviews" class="pr__item padding-b-1 pointer">Vélemények</span>
            <span onclick="showPanel(event, 'tab-delete')" id="tabs-delete" tab-data="delete" class="pr__item padding-b-1 text-danger pointer">Törlés</span>
        </div>
        <div id="tab-general" class="tab__content flex-col card gap-1" style="background: transparent; padding: 0;"></div>
        <div id="tab-advanced" class="tab__content flex-col card gap-1" style="background: transparent; padding: 0;"></div>
        <div id="tab-reviews" class="tab__content flex-col card gap-1" style="background: transparent; padding: 0;"></div>
        <div id="tab-delete" class="tab__content flex-col card gap-1" style="background: transparent; padding: 0;"></div>
    </div>
</div>
</main>
<script>
var bal__to__form = document.getElementsByClassName('money__form'); for (let i = 0; i < bal__to__form.length; i++) { bal__to__form[i].textContent = formatter.format(bal__to__form[i].getAttribute('default-data')); }
</script>
<script src="/assets/script/admin/edit.js" content-type="application/javascript"></script>
<script> var urlpid = <?= $params['id']; ?>;</script>
<script src="/admin/assets/script/cst-drd.js"></script>
<script> 
    document.getElementById('product-status').value = <?= $product['status'] ?>; __setstatus(<?= $product['status'] ?>); document.getElementById('prd-st-con').getElementsByClassName('cst-sl-it')[0].querySelectorAll('div')[(<?= $product['status'] ?>)-1].click();  document.getElementById('prd-st-con').getElementsByClassName('cst-sl-sltd')[0].click();
    function __setstatus (index) {
        switch (index) {
            case 1: document.getElementById('prd-st-sch-con').innerHTML = ``; break;
            case 2: document.getElementById('prd-st-sch-con').innerHTML = ``; break;
            case 3: var today = new Date().toISOString().split('T')[0];
                document.getElementById('prd-st-sch-con').innerHTML = `
                <div class="flex flex-col w-fa gap-05">
                    <span class="text-secondary small">Ütemezés ideje</span>
                    <input type="datetime-local" value="<?= $schedule ?>" name="schedule-end" class="adm__input item-bg border-soft w-fa text-secondary outline-none small prd-ch-fr-er" min="${today} 00:00:00" id="schedule-end">
                </div>`;
            break;
            case 4:document.getElementById('prd-st-sch-con').innerHTML = ``; break;
            default: document.getElementById('prd-st-sch-con').innerHTML = ``;
        }
    }
</script>
<script>
    $('#product-thumbnail').on('change', () => { let validExtensions = ["image/jpeg", "image/jpg", "image/png"];
        if (validExtensions.includes(document.getElementById('product-thumbnail').files[0].type)) {
            let fileReader = new FileReader();
            fileReader.onload = () => { let fileURL = fileReader.result;
                document.getElementById('thumbnail-preview').innerHTML = `
                    <img src="${fileURL}" id="product-thumbnail-demo" class="drop-shadow-dark border-soft" style="width: 120px;">
                `;
            }; fileReader.readAsDataURL(document.getElementById('product-thumbnail').files[0]);
        } else { document.getElementById('product-thumbnail').value = ''; 
            document.getElementById('thumbnail-preview').innerHTML = `<div class="flex flex-col flex-align-c text-muted small"><svg width="128" height="128" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path opacity="0.3" d="M5 22H19C19.6 22 20 21.6 20 21V8L14 2H5C4.4 2 4 2.4 4 3V21C4 21.6 4.4 22 5 22Z" fill="currentColor"></path><path d="M15 8H20L14 2V7C14 7.6 14.4 8 15 8Z" fill="currentColor"></path><rect x="7.55518" y="16.7585" width="10.144" height="2" rx="1" transform="rotate(-45 7.55518 16.7585)" fill="currentColor"></rect><rect x="9.0174" y="9.60327" width="10.0952" height="2" rx="1" transform="rotate(45 9.0174 9.60327)" fill="currentColor"></rect></svg><span><strong>Hibás formátum</strong></span></div>`;
        }
    });
</script>
<script>
    function __saveitem (id, category) {
        document.querySelectorAll('div[error-data="'+category+'"]')[0].innerHTML = `<span class="text-muted" title="Mentés folyamatban"><svg class='wizard_input_loading' xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1"><g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"><g><polygon points="0 0 24 0 24 24 0 24"/></g><path d="M12,4 L12,6 C8.6862915,6 6,8.6862915 6,12 C6,15.3137085 8.6862915,18 12,18 C15.3137085,18 18,15.3137085 18,12 C18,10.9603196 17.7360885,9.96126435 17.2402578,9.07513926 L18.9856052,8.09853149 C19.6473536,9.28117708 20,10.6161442 20,12 C20,16.418278 16.418278,20 12,20 C7.581722,20 4,16.418278 4,12 C4,7.581722 7.581722,4 12,4 Z" class="svg" fill-rule="nonzero" opacity="0.4" transform="translate(12.000000, 12.000000) scale(-1, 1) translate(-12.000000, -12.000000) "/></g></svg></span>`;
        if (id == <?= $params['id'] ?>) {
            function __post (changes, file) { let apiKey = '739837e232548988c86b954108794b57bd3e1dbcd6eb550bfa53e544';
                if (navigator.onLine) {
                    if (
                        !$.getJSON('https://api.ipdata.co?api-key=' + apiKey, function(gip) { var fd = new FormData(); fd.append("ip", gip.ip); fd.append('pid', <?= $params['id'] ?>);
                            for (let i = 0; i < changes.length; i++) { fd.append(changes[i].name, changes[i].value); }
                            $.ajax({ enctype: "multipart/form-data", type: "POST", url: "/admin/products/edit/includes/"+file+".php", data: fd, dataType: 'json', contentType: false, processData: false,
                                success: function(data) {
                                    if (data == 0) { document.querySelectorAll('div[error-data="'+file+'"]')[0].innerHTML = `<span class="relative user-select-none"><span class="flex flex-row flex-align-c flex-justify-con-c badge-small success-bg circle padding-025 small-med bold" title="Sikeres mentés"><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="18" height="18" viewBox="0 0 24 24" version="1.1"><g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"><polygon points="0 0 24 0 24 24 0 24"/><path d="M6.26193932,17.6476484 C5.90425297,18.0684559 5.27315905,18.1196257 4.85235158,17.7619393 C4.43154411,17.404253 4.38037434,16.773159 4.73806068,16.3523516 L13.2380607,6.35235158 C13.6013618,5.92493855 14.2451015,5.87991302 14.6643638,6.25259068 L19.1643638,10.2525907 C19.5771466,10.6195087 19.6143273,11.2515811 19.2474093,11.6643638 C18.8804913,12.0771466 18.2484189,12.1143273 17.8356362,11.7474093 L14.0997854,8.42665306 L6.26193932,17.6476484 Z" fill="currentColor" fill-rule="nonzero" transform="translate(11.999995, 12.000002) rotate(-180.000000) translate(-11.999995, -12.000002) "/></g></svg></span></span>`; setTimeout(() => { document.querySelectorAll('div[error-data="'+file+'"]')[0].innerHTML = ``; }, 3000); }
                                    else { document.querySelectorAll('div[error-data="'+file+'"]')[0].innerHTML = `<span class="relative user-select-none"><span class="flex flex-row flex-align-c flex-justify-con-c badge-small danger-bg circle padding-025 small-med bold" title="${data.responseText}">!</span></span>`; }
                                }, error : function (data) { document.querySelectorAll('div[error-data="'+file+'"]')[0].innerHTML = `<span class="relative user-select-none"><span class="flex flex-row flex-align-c flex-justify-con-c badge-small danger-bg circle padding-025 small-med bold" title="${data.responseText}">!</span></span>`; }
                            });
                        })
                    ) { throw 'Sikertelen csatlakozás az API-hoz.'; }
                } else { throw 'Csatlakozás a hálózathoz sikertelen.'; }
            } function __abort (data, message) { document.querySelectorAll('div[error-data="'+data+'"]')[0].innerHTML = `<span class="relative user-select-none"><span class="flex flex-row flex-align-c flex-justify-con-c badge-small danger-bg circle padding-025 smaller-light bold" title="${message}">!</span></span>`; return 0; }
            switch (category) {
                case 'thumbnail':
                    document.querySelectorAll('div[error-data="'+category+'"]')[0].innerHTML = `<span class="text-muted"><svg class='wizard_input_loading' xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1"><g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"><g><polygon points="0 0 24 0 24 24 0 24"/></g><path d="M12,4 L12,6 C8.6862915,6 6,8.6862915 6,12 C6,15.3137085 8.6862915,18 12,18 C15.3137085,18 18,15.3137085 18,12 C18,10.9603196 17.7360885,9.96126435 17.2402578,9.07513926 L18.9856052,8.09853149 C19.6473536,9.28117708 20,10.6161442 20,12 C20,16.418278 16.418278,20 12,20 C7.581722,20 4,16.418278 4,12 C4,7.581722 7.581722,4 12,4 Z" class="svg" fill-rule="nonzero" opacity="0.4" transform="translate(12.000000, 12.000000) scale(-1, 1) translate(-12.000000, -12.000000) "/></g></svg></span>`;
                    if (document.getElementById('product-thumbnail').value.length > 0) {
                        let validExtensions = ["image/jpeg", "image/jpg", "image/png"];
                        if (validExtensions.includes(document.getElementById('product-thumbnail').files[0].type)) {
                            var changes = []; const thumbnail = {name: "product-thumbnail", value: document.getElementById('product-thumbnail').files[0]}; changes.push(thumbnail);
                            try { __post (changes, 'thumbnail'); }
                            catch (e) { document.querySelectorAll('div[error-data="'+category+'"]')[0].innerHTML = `<span class="relative user-select-none"><span class="flex flex-row flex-align-c flex-justify-con-c badge-small danger-bg circle padding-025 smaller-light bold" title="${e}">!</span></span>`; }
                            
                            document.querySelectorAll('div[error-data="'+category+'"]')[0].innerHTML = ``;
                        } else { __abort(category, "Nem engedélyezett formátum"); }
                    } else { __abort(category, "Nem töltött fel képet"); }
                break;
                case 'status':
                    document.querySelectorAll('div[error-data="'+category+'"]')[0].innerHTML = `<span class="text-muted"><svg class='wizard_input_loading' xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1"><g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"><g><polygon points="0 0 24 0 24 24 0 24"/></g><path d="M12,4 L12,6 C8.6862915,6 6,8.6862915 6,12 C6,15.3137085 8.6862915,18 12,18 C15.3137085,18 18,15.3137085 18,12 C18,10.9603196 17.7360885,9.96126435 17.2402578,9.07513926 L18.9856052,8.09853149 C19.6473536,9.28117708 20,10.6161442 20,12 C20,16.418278 16.418278,20 12,20 C7.581722,20 4,16.418278 4,12 C4,7.581722 7.581722,4 12,4 Z" class="svg" fill-rule="nonzero" opacity="0.4" transform="translate(12.000000, 12.000000) scale(-1, 1) translate(-12.000000, -12.000000) "/></g></svg></span>`;
                    if (document.getElementById('product-status').value > 0) { var changes = [];
                        const status = {name: "product-status", value: document.getElementById('product-status').value};
                        if (document.getElementById('product-status').value == 3) { 
                            if (document.getElementById('schedule-end').value.length > 0) {
                                const schedule = {name: "product-schedule", value: document.getElementById('schedule-end').value}; changes.push(schedule);
                                changes.push(status); 
                                try { __post (changes, 'status'); }
                                catch (e) { document.querySelectorAll('div[error-data="'+category+'"]')[0].innerHTML = `<span class="relative user-select-none"><span class="flex flex-row flex-align-c flex-justify-con-c badge-small danger-bg circle padding-025 smaller-light bold" title="${e}">!</span></span>`; }
                                
                            } else { __abort(category, "Az ütemezés idejét nem adta meg"); }
                        } else { changes.push(status);
                            try { __post (changes, 'status'); }
                            catch (e) { document.getElementById('throw-con').innerHTML = `<div class="flex flex-row-d-col-m flex-align-c flex-justify-con-sb border-soft border-danger-dotted text-danger danger-bg padding-1"><div class="flex flex-row-d-col-m flex-align-c gap-1"><div class="flex flex-row gap-1 w-fa"><div class="flex"><svg class="drop-shadow" width="36" height="36" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><rect opacity="0.3" x="2" y="2" width="20" height="20" rx="10" fill="currentColor"></rect><rect x="11" y="14" width="7" height="2" rx="1" transform="rotate(-90 11 14)" fill="currentColor"></rect><rect x="11" y="17" width="2" height="2" rx="1" transform="rotate(-90 11 17)" fill="currentColor"></rect></svg></div><div class="flex flex-col flex-align-c flex-justify-con-fs w-fa gap-025"><span class="bold w-100 small">Hiba történt feltöltése közben..</span><span class="w-100 small">${e}</span></div></div></div></div>`; }
                            
                        }
                    } else { __abort(category, "Nem választott státuszt"); }
                break;
                case 'category':
                    document.querySelectorAll('div[error-data="'+category+'"]')[0].innerHTML = `<span class="text-muted"><svg class='wizard_input_loading' xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1"><g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"><g><polygon points="0 0 24 0 24 24 0 24"/></g><path d="M12,4 L12,6 C8.6862915,6 6,8.6862915 6,12 C6,15.3137085 8.6862915,18 12,18 C15.3137085,18 18,15.3137085 18,12 C18,10.9603196 17.7360885,9.96126435 17.2402578,9.07513926 L18.9856052,8.09853149 C19.6473536,9.28117708 20,10.6161442 20,12 C20,16.418278 16.418278,20 12,20 C7.581722,20 4,16.418278 4,12 C4,7.581722 7.581722,4 12,4 Z" class="svg" fill-rule="nonzero" opacity="0.4" transform="translate(12.000000, 12.000000) scale(-1, 1) translate(-12.000000, -12.000000) "/></g></svg></span>`;
                    var categ = document.getElementById('product-category').value; var tag = document.getElementById('product-tags').value;
                    if (categ.length > 0 && tag.length > 0) { var changes = [];
                        const pcat = { name: "product-category", value: categ }; const tags = { name: "product-tags", value: tag };
                        changes.push(pcat); changes.push(tags); 
                        try { __post (changes, 'category'); }
                        catch (e) { document.querySelectorAll('div[error-data="'+category+'"]')[0].innerHTML = `<span class="relative user-select-none"><span class="flex flex-row flex-align-c flex-justify-con-c badge-small danger-bg circle padding-025 smaller-light bold" title="${e}">!</span></span>`; }
                        
                    } else { __abort(category, "A mezők kitöltése kötelező"); }
                break;
                case 'general':
                    document.querySelectorAll('div[error-data="'+category+'"]')[0].innerHTML = `<span class="text-muted"><svg class='wizard_input_loading' xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1"><g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"><g><polygon points="0 0 24 0 24 24 0 24"/></g><path d="M12,4 L12,6 C8.6862915,6 6,8.6862915 6,12 C6,15.3137085 8.6862915,18 12,18 C15.3137085,18 18,15.3137085 18,12 C18,10.9603196 17.7360885,9.96126435 17.2402578,9.07513926 L18.9856052,8.09853149 C19.6473536,9.28117708 20,10.6161442 20,12 C20,16.418278 16.418278,20 12,20 C7.581722,20 4,16.418278 4,12 C4,7.581722 7.581722,4 12,4 Z" class="svg" fill-rule="nonzero" opacity="0.4" transform="translate(12.000000, 12.000000) scale(-1, 1) translate(-12.000000, -12.000000) "/></g></svg></span>`;
                    var pname = document.getElementById('product-name').value; var pdesc = document.getElementById('prod-desc-editor').getElementsByClassName('ql-editor')[0].innerHTML;
                    if (pname.length > 5 && pdesc.length > 64) { var changes = [];
                        const pnm = { name: "product-name", value: pname }; const pds = { name: "product-description", value: pdesc };
                        changes.push(pnm); changes.push(pds);
                        try { __post (changes, 'general'); }
                        catch (e) { document.querySelectorAll('div[error-data="'+category+'"]')[0].innerHTML = `<span class="relative user-select-none"><span class="flex flex-row flex-align-c flex-justify-con-c badge-small danger-bg circle padding-025 smaller-light bold" title="${e}">!</span></span>`; }
                    } else { __abort(category, "A mezők kitöltése kötelező"); }
                break;
                case 'price':
                    var pbase = document.getElementById('product-price').value;
                    var pdiscount = document.getElementById('pd-perc').checked ? document.getElementById('discount-range').value : null;
                    var dcstart = document.getElementById('pd-perc').checked ? document.getElementById('discount-start').value : null; var dcend = document.getElementById('pd-perc').checked ? document.getElementById('discount-end').value : null;
                    if (pbase > 1) { var changes = [];
                        const base = { name: "product-price", value: pbase }; const discount = { name: "product-discount", value: pdiscount };
                        const start = { name: "discount-start", value: dcstart }; const end = { name: "discount-end", value: dcend };
                        if (document.getElementById('pd-perc').checked) { const isdisc = { name: "discounted", value: true }; changes.push(isdisc);  
                            if (dcstart.length < 1 || dcend < 1) { __abort(category, "A mezők kitöltése kötelező"); }
                            else { changes.push(base); changes.push(discount); changes.push(start); changes.push(end);
                                try { __post (changes, 'price'); } catch (e) { document.querySelectorAll('div[error-data="'+category+'"]')[0].innerHTML = `<span class="relative user-select-none"><span class="flex flex-row flex-align-c flex-justify-con-c badge-small danger-bg circle padding-025 smaller-light bold" title="${e}">!</span></span>`; }
                            }
                        } else { const isdisc = { name: "discounted", value: false }; changes.push(isdisc); changes.push(base); changes.push(discount); changes.push(start); changes.push(end);
                            try { __post (changes, 'price'); } catch (e) { document.querySelectorAll('div[error-data="'+category+'"]')[0].innerHTML = `<span class="relative user-select-none"><span class="flex flex-row flex-align-c flex-justify-con-c badge-small danger-bg circle padding-025 smaller-light bold" title="${e}">!</span></span>`; }
                        }
                    } else { __abort(category, "A mezők kitöltése kötelező"); }
                break;
                case 'media':
                    document.querySelectorAll('div[error-data="'+category+'"]')[0].innerHTML = `<span class="text-muted"><svg class='wizard_input_loading' xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1"><g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"><g><polygon points="0 0 24 0 24 24 0 24"/></g><path d="M12,4 L12,6 C8.6862915,6 6,8.6862915 6,12 C6,15.3137085 8.6862915,18 12,18 C15.3137085,18 18,15.3137085 18,12 C18,10.9603196 17.7360885,9.96126435 17.2402578,9.07513926 L18.9856052,8.09853149 C19.6473536,9.28117708 20,10.6161442 20,12 C20,16.418278 16.418278,20 12,20 C7.581722,20 4,16.418278 4,12 C4,7.581722 7.581722,4 12,4 Z" class="svg" fill-rule="nonzero" opacity="0.4" transform="translate(12.000000, 12.000000) scale(-1, 1) translate(-12.000000, -12.000000) "/></g></svg></span>`;
                    if (miniArr.length > 0) { var changes = [];
                        for (let i = 0; i < miniArr.length; i++) { const miniatures = { name: 'miniature'+(i+1), value: miniArr[i] }; changes.push(miniatures); }
                        try { __post (changes, 'media'); } catch (e) { document.querySelectorAll('div[error-data="'+category+'"]')[0].innerHTML = `<span class="relative user-select-none"><span class="flex flex-row flex-align-c flex-justify-con-c badge-small danger-bg circle padding-025 smaller-light bold" title="${e}">!</span></span>`; }
                    } else { __abort(category, "Képek felöltése kötelező a mentéshez"); }
                break;
                case 'inventory':
                    var pcode = document.getElementById('product-code').value; var pquan = document.getElementById('product-quantity').value; var pqtyw = document.getElementById('product-quantity-wh').value; var pqtyu = document.getElementById('product-quantity-unit').value; var backo = document.getElementById('product-backorder').checked ? 1 : 0;
                    if (pcode.length > 0 && pqtyu.length > 0) { var changes = [];
                        const code = { name: "product-code", value: pcode }; const quantity = { name: "product-quantity", value: pquan }; const quantityWh = { name: "product-quantity-wh", value: pqtyw }; const quantityU = { name: "product-quantity-unit", value: pqtyu };
                        const backorder = { name: "product-backorder", value: backo }; changes.push(code); changes.push(quantity); changes.push(quantityWh); changes.push(quantityU); changes.push(backorder);
                        try { __post (changes, 'inventory'); }
                        catch (e) { document.querySelectorAll('div[error-data="'+category+'"]')[0].innerHTML = `<span class="relative user-select-none"><span class="flex flex-row flex-align-c flex-justify-con-c badge-small danger-bg circle padding-025 smaller-light bold" title="${e}">!</span></span>`; }
                    } else { __abort(category, "A mezők kitöltése kötelező"); }
                break;
                case 'variations':
                    var pcolor = document.getElementById('product-color').value; var pmaterial = document.getElementById('product-material').value; var pstyle = document.getElementById('product-style').value; var pbrand = document.getElementById('product-brand').value; var pmodel = document.getElementById('product-model').value;
                    if (pcolor.length > 0 && pmaterial.length > 0 && pstyle.length > 0 && pbrand.length > 0 && pmodel.length > 0) { var changes = [];
                        var variations = document.getElementsByClassName('cst-var-con');
                        if (variations.length > 0) { var variationArray = [];
                            for (let i = 0; i < variations.length; i++) { var varname = variations[i].getElementsByClassName('cst-var-name')[0].value.replace(/,/g, ';'); var varvalue = variations[i].getElementsByClassName('cst-var-val')[0].value.replace(/,/g, ';');
                                if (varname.length > 0 && varvalue.length > 0) { var varitem = varname + ':' + varvalue; variationArray.push(varitem); }
                            }
                        } const color = { name: "product-color", value: pcolor }; const material = { name: "product-material", value: pmaterial }; const style = { name: "product-style", value: pstyle }; const brand = { name: "product-brand", value: pbrand }; const model = { name: "product-model", value: pmodel }; const vars = { name: "custom", value: variationArray };
                        changes.push(color); changes.push(material); changes.push(style); changes.push(brand); changes.push(model); changes.push(vars);
                        try { __post (changes, 'variations'); }
                        catch (e) { document.querySelectorAll('div[error-data="'+category+'"]')[0].innerHTML = `<span class="relative user-select-none"><span class="flex flex-row flex-align-c flex-justify-con-c badge-small danger-bg circle padding-025 smaller-light bold" title="${e}">!</span></span>`; }
                    } else { __abort(category, "A mezők kitöltése kötelező"); }
                break;
                case 'shipping':
                    var pphysical = document.getElementById('product-physical').checked ? 1 : 0;
                    var prefund = document.getElementById('product-refund').checked ? 1 : 0;

                    if (document.getElementById('product-physical').checked) { var changes = [];
                        var pweight = document.getElementById('product-weight').value; var pweightu = document.getElementById('product-weight-unit').value; var pwidth = document.getElementById('product-width').value; var pheight = document.getElementById('product-height').value; var plength = document.getElementById('product-length').value; var pdimens = document.getElementById('product-dimension-unit').value;
                        if (pweight > 0 && pweightu.length > 0 && pwidth > 0 && pheight > 0 && plength > 0 && pdimens.length > 0) {
                            const weight = { name: "product-weight", value: pweight }; const weightUnit = { name: "product-weight-unit", value: pweightu }; const width = { name: "product-width", value: pwidth }; const height = { name: "product-height", value: pheight }; const length = { name: "product-length", value: plength }; const dimensions = { name: "product-dimension", value: pdimens }; const physical = { name: "product-physical", value: pphysical }; const refund = { name: "product-refund", value: prefund };
                            changes.push(weight); changes.push(weightUnit); changes.push(width); changes.push(height); changes.push(length); changes.push(dimensions); changes.push(physical); changes.push(refund);
                            try { __post (changes, 'shipping'); }
                            catch (e) { document.querySelectorAll('div[error-data="'+category+'"]')[0].innerHTML = `<span class="relative user-select-none"><span class="flex flex-row flex-align-c flex-justify-con-c badge-small danger-bg circle padding-025 smaller-light bold" title="${e}">!</span></span>`; }
                        } else { __abort(category, "A mezők kitöltése kötelező"); }
                    } else { var changes = [];
                        const physical = { name: "product-physical", value: pphysical }; const refund = { name: "product-refund", value: prefund }; changes.push(physical); changes.push(refund);
                        try { __post (changes, 'shipping'); }
                        catch (e) { document.querySelectorAll('div[error-data="'+category+'"]')[0].innerHTML = `<span class="relative user-select-none"><span class="flex flex-row flex-align-c flex-justify-con-c badge-small danger-bg circle padding-025 smaller-light bold" title="${e}">!</span></span>`; }
                    }
                break;
                case 'meta':
                    var pmtitle = document.getElementById('product-meta-title').value; 
                    var pmdesc = document.getElementById('prod-meta-editor').getElementsByClassName('ql-editor')[0].textContent;
                    var pmkeyw = document.getElementById('product-meta-keywords').value; 
                    if (pmtitle.length > 5 && pmdesc.length > 64 && pmkeyw.length > 5) { var changes = [];
                        const title = { name: "product-meta-title", value: pmtitle }; const desc = { name: "product-meta-desc", value: pmdesc }; const keywords = { name: "product-meta-keyw", value: pmkeyw };
                        changes.push(title); changes.push(desc); changes.push(keywords);
                        try { __post (changes, 'meta'); }
                        catch (e) { document.querySelectorAll('div[error-data="'+category+'"]')[0].innerHTML = `<span class="relative user-select-none"><span class="flex flex-row flex-align-c flex-justify-con-c badge-small danger-bg circle padding-025 smaller-light bold" title="${e}">!</span></span>`; }
                    } else { __abort(category, "A mezők kitöltése kötelező"); }
                break;
                case 'review':
                    var pren = document.getElementById('product-review-stat').checked ? 1 : 0; var prau = document.getElementById('product-review-auth').checked ? 1 : 0; var prvo = document.getElementById('product-review-vote').checked ? 1 : 0; var prpr = document.getElementById('product-review-privacy').checked ? 1 : 0; var changes = [];
                    const enable = { name: "enable", value: pren }; const auth = { name: "auth", value: prau }; const vote = { name: "vote", value: prvo }; const privacy = { name: "privacy", value: prpr };
                    changes.push(enable); changes.push(auth); changes.push(vote); changes.push(privacy); try { __post (changes, 'review'); } catch (e) { document.querySelectorAll('div[error-data="'+category+'"]')[0].innerHTML = `<span class="relative user-select-none"><span class="flex flex-row flex-align-c flex-justify-con-c badge-small danger-bg circle padding-025 smaller-light bold" title="${e}">!</span></span>`; }                    
                break;
                default:;
            }
        } else { document.querySelectorAll('div[error-data="'+data+'"]')[0].innerHTML = `<span class="relative user-select-none"><span class="flex flex-row flex-align-c flex-justify-con-c badge-small danger-bg circle padding-025 smaller-light bold" title="Érvénytelen termékazonosító">!</span></span>`; }
    }
</script>
<?php require_once($_SERVER['DOCUMENT_ROOT'].'/includes/footer.php'); ?>
