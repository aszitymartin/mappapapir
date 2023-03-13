<?php require_once($_SERVER['DOCUMENT_ROOT'].'/includes/inc.php'); include($_SERVER['DOCUMENT_ROOT'].'/assets/alph.php'); $uid = $_SESSION['id'];
$stmt = $con->prepare('SELECT privilege FROM customers__priv  WHERE uid = ?'); if (isset($_SESSION['loggedin'])) {$id = $_SESSION['id'];} $stmt->bind_param('i', $id);$stmt->execute(); $stmt->bind_result($privilege); $stmt->fetch();$stmt->close();
function get_time_ago( $time ) {
    $time_difference = time() - $time;
    if( $time_difference < 1 ) { return '< 1mp'; }
    $condition = array( 12 * 30 * 24 * 60 * 60 =>  'éve',30 * 24 * 60 * 60 => 'hónapja',24 * 60 * 60 => 'napja',60 * 60 =>  'órája',60 =>  'perce',1 =>  'másodperce');
    foreach( $condition as $secs => $str ) {$d = $time_difference / $secs;if( $d >= 1 ) {$t = round( $d );return $t . ' ' . $str . ( $t > 1 ? '' : '' ) . '';}}
}
?>
<script src="/assets/script/chart/dist/chart.js"></script>
<script>var formatter = new Intl.NumberFormat('hu-HU', {style: 'currency',currency: 'HUF',maximumFractionDigits: 0,minimumFractionDigits: 0});</script>
<div class="flex flex-col flex-align-c gap-1">
    <div class="flex flex-col w-fa gap-1 border-soft item-bg box-shadow padding-1">
        <div class="flex flex-row flex-align-c flex-justify-con-sb">
            <span class="flex flex-row flex-align-c gap-05 text-primary large bold">
                <span>Profil Adatok</span>
            </span>
            <span class="flex flex-row flex-align-c gap-05 primary-bg primary-bg-hover border-soft padding-05 user-select-none pointer small-med bold" onclick="showPanel(event, 'tab-personal')">
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path opacity="0.3" d="M21.4 8.35303L19.241 10.511L13.485 4.755L15.643 2.59595C16.0248 2.21423 16.5426 1.99988 17.0825 1.99988C17.6224 1.99988 18.1402 2.21423 18.522 2.59595L21.4 5.474C21.7817 5.85581 21.9962 6.37355 21.9962 6.91345C21.9962 7.45335 21.7817 7.97122 21.4 8.35303ZM3.68699 21.932L9.88699 19.865L4.13099 14.109L2.06399 20.309C1.98815 20.5354 1.97703 20.7787 2.03189 21.0111C2.08674 21.2436 2.2054 21.4561 2.37449 21.6248C2.54359 21.7934 2.75641 21.9115 2.989 21.9658C3.22158 22.0201 3.4647 22.0084 3.69099 21.932H3.68699Z" fill="currentColor"/><path d="M5.574 21.3L3.692 21.928C3.46591 22.0032 3.22334 22.0141 2.99144 21.9594C2.75954 21.9046 2.54744 21.7864 2.3789 21.6179C2.21036 21.4495 2.09202 21.2375 2.03711 21.0056C1.9822 20.7737 1.99289 20.5312 2.06799 20.3051L2.696 18.422L5.574 21.3ZM4.13499 14.105L9.891 19.861L19.245 10.507L13.489 4.75098L4.13499 14.105Z" fill="currentColor"/></svg>
                Szerkesztés
            </span>
        </div><hr style="border: 1px solid var(--background);" class="w-fa margin-none">
        <div class="flex flex-col w-fa gap-1"><br>
            <div class="flex flex-row flex-align-c prst__row">
                <span class="text-secondary small prst__trig">Teljes Név</span>
                <span class="text-primary bold small prst__trig">Aszity Martin</span>
            </div>
            <div class="flex flex-row flex-align-c prst__row">
                <span class="text-secondary small prst__trig">Cég</span>
                <span class="text-primary bold small prst__trig">Minta Kft.</span>
            </div>
            <div class="flex flex-row flex-align-c prst__row">
                <span class="text-secondary small prst__trig">Telefonszám</span>
                <span class="text-primary bold small prst__trig">06 40 710 6140</span>
            </div>
            <div class="flex flex-row flex-align-c prst__row">
                <div class="flex flex-row flex-align-c gap-1 prst__trig">
                    <span class="text-secondary small">E-mail cím</span>
                    <span class="text-muted pointer user-select-none" onclick="showPanel(event, 'tab-email')">
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path opacity="0.3" d="M4.7 17.3V7.7C4.7 6.59543 5.59543 5.7 6.7 5.7H9.8C10.2694 5.7 10.65 5.31944 10.65 4.85C10.65 4.38056 10.2694 4 9.8 4H5C3.89543 4 3 4.89543 3 6V19C3 20.1046 3.89543 21 5 21H18C19.1046 21 20 20.1046 20 19V14.2C20 13.7306 19.6194 13.35 19.15 13.35C18.6806 13.35 18.3 13.7306 18.3 14.2V17.3C18.3 18.4046 17.4046 19.3 16.3 19.3H6.7C5.59543 19.3 4.7 18.4046 4.7 17.3Z" fill="currentColor"/><rect x="21.9497" y="3.46448" width="13" height="2" rx="1" transform="rotate(135 21.9497 3.46448)" fill="currentColor"/><path d="M19.8284 4.97161L19.8284 9.93937C19.8284 10.5252 20.3033 11 20.8891 11C21.4749 11 21.9497 10.5252 21.9497 9.93937L21.9497 3.05029C21.9497 2.498 21.502 2.05028 20.9497 2.05028L14.0607 2.05027C13.4749 2.05027 13 2.52514 13 3.11094C13 3.69673 13.4749 4.17161 14.0607 4.17161L19.0284 4.17161C19.4702 4.17161 19.8284 4.52978 19.8284 4.97161Z" fill="currentColor"/></svg>
                    </span>
                </div>
                <div class="flex flex-row flex-align-c gap-1 prst__trig">
                    <span class="text-primary bold small">martinaszity@icloud.com</span>
                    <span class="label-warning border-soft-light padding-025 smaller-light bold">Nincs aktiválva</span>
                </div>
            </div>
            <div class="flex flex-row flex-align-c prst__row">
                <span class="text-secondary small prst__trig">Ország</span>
                <span class="text-primary bold small prst__trig">Magyarország</span>
            </div>
            <div class="flex flex-row flex-align-c prst__row">
                <span class="text-secondary small prst__trig">Adószám</span>
                <span class="text-primary bold small prst__trig">123456789</span>
            </div>
        </div><br>
        <div class="flex flex-col w-fa gap-1">
            <div class="flex flex-row-d-col-m flex-align-c flex-justify-con-sb border-soft border-warning-dotted warning-bg padding-1">
                <div class="flex flex-row-d-col-m flex-align-c gap-1">
                    <div class="flex flex-row flex-align-c gap-1">
                        <div class="flex">
                            <svg xmlns="http://www.w3.org/2000/svg" width="36" height="36" viewBox="0 0 24 24" fill="none"><rect opacity="0.3" x="2" y="2" width="20" height="20" rx="10" fill="currentColor"></rect><rect x="11" y="14" width="7" height="2" rx="1" transform="rotate(-90 11 14)" fill="currentColor"></rect><rect x="11" y="17" width="2" height="2" rx="1" transform="rotate(-90 11 17)" fill="currentColor"></rect></svg>
                        </div>
                        <div class="flex flex-col flex-align-c flex-justify-con-fs">
                            <span class="bold w-100 small">Nem aktivált e-mail cím</span>
                            <span class="text-secondary small-med">E-mail címének megerősítése elengedhetetlen, hogy biztosítsa a fiókjának biztonságát. <span class="text-primary-light pointer link user-select-none bold">Email hitelesítése</span></span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php

        $sql = "SELECT items FROM orders WHERE uid = " . $_SESSION['id']; $res = $con->query($sql);
        if ($res->num_rows > 0) {
            
            $itemsArray = array();
            $uniqueItems = array();
            $itemsCounted = array();
            $itemNames = array();
            $itemUniqueName = array();
            $itemUnique = array();
            $itemsUniqued = array();
            $itemsQuantity = 0;
            $uniqueQuantity = 0;

            while ($dt = $res->fetch_assoc()) {
                $ritems = rtrim($dt['items'], ';');
                $eritems = explode(';', $ritems);
                for ($i = 0; $i < count($eritems); $i++) {
                    $eeritems = explode(':', $eritems[$i]);
                    if (!empty($eeritems)) {
                        array_push($itemsArray, ($eeritems[0] . ':' . $eeritems[1]));
                    }
                }
            }

            for ($i = 0; $i < count($itemsArray); $i++) { $itemsQuantity = 0;
                if (!in_array(explode(':', $itemsArray[$i])[0], $uniqueItems)) {
                    array_push($uniqueItems, explode(':', $itemsArray[$i])[0]);
                }
            }
        
            for ($i = 0; $i < count($uniqueItems); $i++) { $itemsQuantity = 0;
                for ($j = 0; $j < count($itemsArray); $j++) {
                    if ($uniqueItems[$i] === explode(':', $itemsArray[$j])[0]) {
                        $itemsQuantity += explode(':', $itemsArray[$j])[1];
                    }
                }
                array_push($itemsCounted, ($uniqueItems[$i] . ':' . $itemsQuantity));
            }
            
            for ($i = 0; $i < count($itemsCounted); $i++) {
                $sql = "SELECT category FROM products__category WHERE pid = " . explode(':', $itemsCounted[$i])[0];
                $res = $con->query($sql);
                while ($dt = $res->fetch_assoc()) {
                    array_push($itemNames, ($dt['category'] . ':' . explode(':', $itemsCounted[$i])[1]));
                }
            }
        
            for ($i = 0; $i < count($itemNames); $i++) {
                array_push($itemUniqueName, explode(':', $itemNames[$i])[0]);
            }
        
            
            for ($i = 0; $i < count($itemUniqueName); $i++) { $uniqueQuantity = 0;
                for ($j = 0; $j < count($itemNames); $j++) {
                    if ($itemUniqueName[$i] == explode(':', $itemNames[$j])[0]) {
                        $uniqueQuantity += explode(':', $itemNames[$j])[1];
                    }
                }
                array_push($itemUnique, ($itemUniqueName[$i] . ':' . $uniqueQuantity));
            }
        
            for ($i = 0; $i < count(($itemUnique)); $i++) {
                if (!in_array($itemUnique[$i], $itemsUniqued)) {
                    array_push($itemsUniqued, $itemUnique[$i]);
                }
            }

        }

    ?>
    <div class="flex flex-row flex-justify-con-c flex-wrap-m gap-1 prio__con w-fa">
        <div class="flex flex-col item-bg border-soft w-60d-fam padding-05 gap-2">
            <div class="flex flex-col w-fa gap-05">
                <span class="larger text-primary bold">Rendelt Kategóriák</span>
                <span class="text-muted small-med"><span id="ordered-category-count">NaN</span> db kategóriából rendelt</span>
            </div>
            <div class="flex flex-col gap-05 margin-auto">
                <div class="flex flex-row gap-05">
                    <?php  if (count($itemsUniqued) > 0) : ?>
                    <div class="flex flex-row flex-align-c flex-justify-con-c flex-wrap-no w-fa" id="dailysales__chart__con">
                        <canvas id="dailysales__chart" class="w-fa" height="76" style="display: block; box-sizing: border-box; height: 76px; width: 286px; max-height: 20rem;" width="286"></canvas>
                        <script id="dlysls__script">
                            var recentchart = document.getElementById('dailysales__chart');
                            var footer = (tooltipItems) => { let sum = 0; tooltipItems.forEach(function(tooltipItem) { sum += tooltipItem.parsed.y; }); return tooltipItems[0].label + ' : ' + tooltipItems[0].formattedValue };
                            var rcChart = new Chart(recentchart, { type: 'pie',
                                data: {
                                    labels : [ <?php for ($i = 0; $i < count($itemsUniqued); $i++) { echo '"' . explode(':', $itemsUniqued[$i])[0] . '",'; } ?> ],
                                    datasets: [{
                                        data: [ <?php for ($i = 0; $i < count($itemsUniqued); $i++) { echo '"' . explode(':', $itemsUniqued[$i])[1] . '",'; } ?> ],
                                        backgroundColor: 'rgb(54, 153, 255)',
                                        hoverOffset: 2, borderRadius: 7, maxBarThickness: 10
                                    }]
                                },
                                options: { 
                                    plugins: { legend: { display: false },
                                    tooltip: {
                                        callbacks: { footer: footer, },
                                        bodySpacing: 0,
                                        bodyFont: { size: '0' },
                                        bodyColor: 'transparent', displayColors: false
                                    } 
                                }, scales: { x: { display: false, }, y: { display: false, } } }
                            }); document.getElementById('ordered-category-count').textContent = <?= count($itemsUniqued); ?>
                        </script>
                    </div>
                    <?php endif; if (count($itemsUniqued) < 1) : ?>
                        <div class="flex flex-col flex-align-c flex-justify-con-c w-fa text-muted user-select-none">
                            <svg width="128" height="128" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path opacity="0.3" d="M18 10V20C18 20.6 18.4 21 19 21C19.6 21 20 20.6 20 20V10H18Z" fill="currentColor"/><path opacity="0.3" d="M11 10V17H6V10H4V20C4 20.6 4.4 21 5 21H12C12.6 21 13 20.6 13 20V10H11Z" fill="currentColor"/><path opacity="0.3" d="M10 10C10 11.1 9.1 12 8 12C6.9 12 6 11.1 6 10H10Z" fill="currentColor"/><path opacity="0.3" d="M18 10C18 11.1 17.1 12 16 12C14.9 12 14 11.1 14 10H18Z" fill="currentColor"/><path opacity="0.3" d="M14 4H10V10H14V4Z" fill="currentColor"/><path opacity="0.3" d="M17 4H20L22 10H18L17 4Z" fill="currentColor"/><path opacity="0.3" d="M7 4H4L2 10H6L7 4Z" fill="currentColor"/><path d="M6 10C6 11.1 5.1 12 4 12C2.9 12 2 11.1 2 10H6ZM10 10C10 11.1 10.9 12 12 12C13.1 12 14 11.1 14 10H10ZM18 10C18 11.1 18.9 12 20 12C21.1 12 22 11.1 22 10H18ZM19 2H5C4.4 2 4 2.4 4 3V4H20V3C20 2.4 19.6 2 19 2ZM12 17C12 16.4 11.6 16 11 16H6C5.4 16 5 16.4 5 17C5 17.6 5.4 18 6 18H11C11.6 18 12 17.6 12 17Z" fill="currentColor"/></svg>
                            <span class="bold">Nincsen megjeleníthető rendelés.</span>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
        <div class="flex flex-col item-bg border-soft w-40d-fam padding-05 gap-2">
            <div class="flex flex-col w-fa gap-05">
                <span class="larger text-primary bold">Termék Rendelések</span>
                <div class="flex flex-col w-fa">
                    <span class="text-muted small-med"><span id="delivered-sum"></span> Rendelés lett kiszállítva eddig</span>
                </div>
            </div>
            <div class="flex flex-col gap-1 w-fa prio__con" style="max-height: 450px !important;" id="orders-container">
            </div>
        </div>
    </div>
</div>

<?php

    // ini_set('display_errors', 1); ini_set('display_startup_errors', 1); error_reporting(E_ALL);

?>

<script>
    var orderData = new FormData(); orderData.append("uid", <?= $_SESSION['id']; ?>)
    $.ajax({ enctype: "multipart/form-data", type: "POST", url: "/webshop/includes/checkout/getOrderDetails.php", data: orderData, dataType: 'json', contentType: false, processData: false,
        beforeSend : function () {
            document.getElementById('orders-container').innerHTML = `
            <div class="flex flex-col flex-align-c flex-justify-con-c gap-1 small text-muted user-select-none w-fa">
                <span><svg class='wizard_input_loading' xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="128" height="128" viewBox="0 0 24 24" version="1.1"><g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"><g><polygon points="0 0 24 0 24 24 0 24"/></g><path d="M12,4 L12,6 C8.6862915,6 6,8.6862915 6,12 C6,15.3137085 8.6862915,18 12,18 C15.3137085,18 18,15.3137085 18,12 C18,10.9603196 17.7360885,9.96126435 17.2402578,9.07513926 L18.9856052,8.09853149 C19.6473536,9.28117708 20,10.6161442 20,12 C20,16.418278 16.418278,20 12,20 C7.581722,20 4,16.418278 4,12 C4,7.581722 7.581722,4 12,4 Z" class="svg" fill-rule="nonzero" opacity="0.4" transform="translate(12.000000, 12.000000) scale(-1, 1) translate(-12.000000, -12.000000) "/></g></svg></span>
                <span>Rendelések megjelenítése</span>
            </div>
            `;
        }, success : function (s) { document.getElementById('orders-container').innerHTML = ``;
            if (s.status == 'success') { let dels = 0
                for (let i = 0; i < s.data.length; i++) {
                    document.getElementById('orders-container').innerHTML += `
                    <div class="flex flex-col flex-align-c w-fa gap-05 border-soft-light border-muted padding-05">
                        <div class="flex flex-row w-fa gap-05">
                            <div class="bsc__img flex flex-col flex-align-c flex-justify-con-c gap-05">
                                <div id="order-preview-con-${s.data[i].oid}">
                                    <div class="flex flex-col flex-align-c flex-justify-con-c gap-1 small text-muted user-select-none w-fa">
                                        <span><svg class='wizard_input_loading' xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="64" height="64" viewBox="0 0 24 24" version="1.1"><g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"><g><polygon points="0 0 24 0 24 24 0 24"/></g><path d="M12,4 L12,6 C8.6862915,6 6,8.6862915 6,12 C6,15.3137085 8.6862915,18 12,18 C15.3137085,18 18,15.3137085 18,12 C18,10.9603196 17.7360885,9.96126435 17.2402578,9.07513926 L18.9856052,8.09853149 C19.6473536,9.28117708 20,10.6161442 20,12 C20,16.418278 16.418278,20 12,20 C7.581722,20 4,16.418278 4,12 C4,7.581722 7.581722,4 12,4 Z" class="svg" fill-rule="nonzero" opacity="0.4" transform="translate(12.000000, 12.000000) scale(-1, 1) translate(-12.000000, -12.000000) "/></g></svg></span>
                                    </div>
                                </div>
                            </div>
                            <div class="flex flex-col gap-05">
                                <div class="flex flex-col">
                                    <a class="text-primary small pointer link bold" href="/orders/v/${s.data[i].oid}" target="_blank">(#${s.data[i].oid}) <span id="order-items-name-${s.data[i].oid}"></span></a>
                                    <span class="text-muted small-med">${s.data[i].odate}</span>
                                </div>
                            </div>
                        </div>
                        <div class="flex flex-row flex-align-c flex-justify-con-sb w-fa gap-05 padding-025">
                            <span class="text-primary bold" id="order-subtotal-${s.data[i].oid}"></span>
                            <div id="order-status-${s.data[i].oid}"></div>
                        </div>
                    </div>
                    `;
                    document.getElementById('order-subtotal-'+s.data[i].oid).textContent = formatter.format(s.data[i].subTotal);
                    switch (s.data[i].status) {
                        case '0':
                            document.getElementById('order-status-'+s.data[i].oid).innerHTML = `
                                <span class="label label-warning border-soft-light padding-025 smaller-light">Összekészítés</span>
                            `;
                        break;
                        case '1':
                            document.getElementById('order-status-'+s.data[i].oid).innerHTML = `
                                <span class="label label-primary border-soft-light padding-025 smaller-light">Kiszállítás</span>
                            `;
                        break;
                        case '2': dels++;
                            document.getElementById('order-status-'+s.data[i].oid).innerHTML = `
                                <span class="label label-success border-soft-light padding-025 smaller-light">Kiszállítva</span>
                            `;
                        break;
                        case '4':
                            document.getElementById('order-status-'+s.data[i].oid).innerHTML = `
                                <span class="label label-danger border-soft-light padding-025 smaller-light">Sikertelen</span>
                            `;
                        break;
                        default:
                            document.getElementById('order-status-'+s.data[i].oid).innerHTML = `
                                <span class="label label-warning border-soft-light padding-025 smaller-light">Összekészítés</span>
                            `;
                        break;
                    }
                    document.getElementById('order-items-name-' + s.data[i].oid).textContent = (s.data[i].item[0].name.length > 80 ? s.data[i].item[0].name.substring(1, 80) + '...' : s.data[i].item[0].name);
                    switch (s.data[i].item.length) {
                        case 1:
                            document.getElementById('order-preview-con-'+s.data[i].oid).innerHTML = `
                            <div class="flex flex-row flex-align-c flex-justify-con-c text-align-c flex-wrap gap-025 w-fa" style="width: 7rem;">
                                <img class="bs__img drop-shadow" src="/assets/images/uploads/${s.data[i].item[0].thumbnail}" alt="${s.data[i].item[0].name}" style="height: 4rem; object-fit: contain;">
                            </div>
                            `;
                        break;
                        case 2:
                            document.getElementById('order-preview-con-'+s.data[i].oid).innerHTML = `
                            <div class="flex flex-row flex-align-c flex-justify-con-c text-align-c flex-wrap-no gap-025 w-fa" style="width: 7rem;" id="order-preview-inner-con-${s.data[i].oid}">
                                <img class="bs__img drop-shadow" src="/assets/images/uploads/${s.data[i].item[0].thumbnail}" alt="${s.data[i].item[0].name}" style="height: 4rem; object-fit: contain;">
                                <img class="bs__img drop-shadow" src="/assets/images/uploads/${s.data[i].item[1].thumbnail}" alt="${s.data[i].item[1].name}" style="height: 4rem; object-fit: contain; margin-left: -10px; margin-top: 5px;">
                            </div>
                            `;
                        break;
                        case 3:
                            document.getElementById('order-preview-con-'+s.data[i].oid).innerHTML = `
                            <div class="flex flex-row flex-align-c flex-justify-con-c text-align-c flex-wrap-no gap-025 w-fa" style="width: 7rem;" id="order-preview-inner-con-${s.data[i].oid}">
                                <img class="bs__img drop-shadow" src="/assets/images/uploads/${s.data[i].item[0].thumbnail}" alt="${s.data[i].item[0].name}" style="width: 2rem; object-fit: contain;">
                                <img class="bs__img drop-shadow" src="/assets/images/uploads/${s.data[i].item[1].thumbnail}" alt="${s.data[i].item[1].name}" style="width: 2rem; object-fit: contain; margin-left: -10px; margin-top: 5px;">
                                <img class="bs__img drop-shadow" src="/assets/images/uploads/${s.data[i].item[2].thumbnail}" alt="${s.data[i].item[2].name}" style="width: 2rem; object-fit: contain; margin-left: -10px; margin-top: 15px;">
                            </div>
                            `;
                        break;
                        case 4:
                            document.getElementById('order-preview-con-'+s.data[i].oid).innerHTML = `
                            <div class="flex flex-row flex-align-c flex-justify-con-c text-align-c flex-wrap gap-025 w-fa" style="width: 7rem;">
                                <img class="bs__img drop-shadow" src="/assets/images/uploads/${s.data[i].item[0].thumbnail}" alt="${s.data[i].item[0].name}" style="height: 2.5rem; width: 2.5rem; object-fit: contain;">
                                <img class="bs__img drop-shadow" src="/assets/images/uploads/${s.data[i].item[1].thumbnail}" alt="${s.data[i].item[1].name}" style="height: 2.5rem; width: 2.5rem; object-fit: contain;">
                                <img class="bs__img drop-shadow" src="/assets/images/uploads/${s.data[i].item[2].thumbnail}" alt="${s.data[i].item[2].name}" style="height: 2.5rem; width: 2.5rem; object-fit: contain;">
                                <img class="bs__img drop-shadow" src="/assets/images/uploads/${s.data[i].item[3].thumbnail}" alt="${s.data[i].item[3].name}" style="height: 2.5rem; width: 2.5rem; object-fit: contain;">
                            </div>
                            `;
                        break;
                        default:
                            document.getElementById('order-preview-con-'+s.data[i].oid).innerHTML = `
                            <div class="flex flex-row flex-align-c flex-justify-con-c text-align-c flex-wrap gap-025 w-fa" style="width: 7rem;">
                                <img class="bs__img drop-shadow" src="/assets/images/uploads/${s.data[i].item[0].thumbnail}" alt="${s.data[i].item[0].name}" style="height: 2.5rem; width: 2.5rem; object-fit: contain;">
                                <img class="bs__img drop-shadow" src="/assets/images/uploads/${s.data[i].item[1].thumbnail}" alt="${s.data[i].item[1].name}" style="height: 2.5rem; width: 2.5rem; object-fit: contain;">
                                <img class="bs__img drop-shadow" src="/assets/images/uploads/${s.data[i].item[2].thumbnail}" alt="${s.data[i].item[2].name}" style="height: 2.5rem; width: 2.5rem; object-fit: contain;">
                                <span class="flex flex-col flex-align-c flex-justify-con-c small border-soft large text-muted background-bg bold pointer" title="${(s.data[i].item.length) - 3} További termék" style="height: 2.5rem; width: 2rem;">+${(s.data[i].item.length) - 3}</span>
                            </div>
                            `;
                        break;
                    }
                } document.getElementById('delivered-sum').textContent = dels;
            } else {
                document.getElementById('orders-container').innerHTML = `
                <div class="flex flex-col flex-align-c flex-justify-con-c gap-1 small text-muted user-select-none w-fa">
                    <svg width="128" height="128" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><rect opacity="0.3" x="2" y="2" width="20" height="20" rx="10" fill="currentColor"/><rect x="11" y="14" width="7" height="2" rx="1" transform="rotate(-90 11 14)" fill="currentColor"/><rect x="11" y="17" width="2" height="2" rx="1" transform="rotate(-90 11 17)" fill="currentColor"/></svg>
                    <span>Hiba történt a rendelések betöltése közben.</span>
                </div>
                `;
            }
        }, error : function (e) {
            document.getElementById('orders-container').innerHTML = `
            <div class="flex flex-col flex-align-c flex-justify-con-c gap-1 small text-muted user-select-none w-fa">
                <svg width="128" height="128" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><rect opacity="0.3" x="2" y="2" width="20" height="20" rx="10" fill="currentColor"/><rect x="11" y="14" width="7" height="2" rx="1" transform="rotate(-90 11 14)" fill="currentColor"/><rect x="11" y="17" width="2" height="2" rx="1" transform="rotate(-90 11 17)" fill="currentColor"/></svg>
                <span>Hiba történt a rendelések betöltése közben.</span>
            </div>
            `;
        }
    });
</script>