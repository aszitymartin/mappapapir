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
    <div class="flex flex-row flex-justify-con-c flex-wrap-m gap-1 prio__con w-fa">
        <div class="flex flex-col item-bg border-soft w-60d-fam padding-05 gap-2">
            <div class="flex flex-col w-fa gap-05">
                <span class="larger text-primary bold">Rendelt Kategóriák</span>
                <span class="text-muted small-med">38db kategóriából rendelt</span>
            </div>
            <div class="flex flex-col gap-05">
                <div class="flex flex-row gap-05">
                    <div class="flex flex-row flex-wrap-no w-fa" id="dailysales__chart__con">
                        <canvas id="dailysales__chart" class="w-fa" height="76" style="display: block; box-sizing: border-box; height: 76px; width: 286px;" width="286"></canvas>
                        <script id="dlysls__script">
                            var recentchart = document.getElementById('dailysales__chart');
                            var footer = (tooltipItems) => { let sum = 0; tooltipItems.forEach(function(tooltipItem) { sum += tooltipItem.parsed.y; }); return 'Rendelve: ' + sum; };
                            var rcChart = new Chart(recentchart, { type: 'polarArea',
                                data: {
                                    // labels: ['2023-01-18','2023-01-19','2023-01-20','2023-01-21','2023-01-22','2023-01-23','2023-01-24'],
                                    labels : ['as', 'sa', 'ab'],
                                    datasets: [{
                                        data: ['1', '2', ' 3'], backgroundColor: 'rgb(0, 158, 247)', hoverOffset: 2, borderRadius: 50, maxBarThickness: 10
                                    }]
                                },
                                options: { plugins: { legend: { display: false },
                                tooltip: {
                                    tooltipItems: ['asd', 'dsa', 'asd'],
                                    // callbacks: { footer: footer, },
                                    bodySpacing: 0,
                                    bodyFont: { size: '0' },
                                    bodyColor: 'transparent', displayColors: false
                                } 
                            }, scales: { x: { display: false, }, y: { display: false, } } }
                            });
                        </script>
                    </div>
                </div>
            </div>
        </div>
        <div class="flex flex-col item-bg border-soft w-40d-fam padding-05 gap-2">
            <div class="flex flex-col w-fa gap-05">
                <span class="larger text-primary bold">6</span>
                <div class="flex flex-col w-fa">
                    <span class="text-muted small-med">Rendelések a hónapban</span>
                    <span class="text-muted smaller">* Minden év elején nullázódik</span>
                </div>
            </div>
            <div class="flex flex-col gap-05 margin-top-a">
                <div class="flex flex-row flex-align-c flex-justify-con-sb">
                    <span class="small-med text-primary bold">Előző havi: <span class="bold" id="orders__goal">25</span></span>
                    <span class="small text-muted">24%</span>
                </div>
                <div class="flex flex-row gap-05">
                    <div class="flex flex-row border-soft background-bg w-fa">
                        <div class="flex flex-row padding-025 border-soft loader-danger" style="width: 24%;"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
        
</div>