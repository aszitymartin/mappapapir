<?php require_once($_SERVER['DOCUMENT_ROOT'].'/includes/inc.php'); require_once($_SERVER['DOCUMENT_ROOT'].'/assets/alph.php'); $uid = $_SESSION['id'];
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
<div class="flex flex-row flex-align-c gap-1">
    <div class="flex flex-row flex-justify-con-c flex-wrap-m gap-05 prio__con w-100">
        <div class="flex flex-col item-bg border-soft w-50d-fam padding-05 padding-b-0 gap-05">
            <div class="flex flex-col w-fa gap-05">
                <span class="larger text-primary bold" id="lastsvnsales__ind"></span>
                <span class="text-muted small-med">Visszajelzések</span>
            </div>
            <div class="flex flex-col gap-05 margin-top-a">
                <div class="flex flex-row gap-05 w-fa">
                    <div class="flex flex-row flex-wrap-no w-fa" id="dailysales__chart__con">
                        <canvas id="dailysales__chart" class="w-fa" height="80px"></canvas>
                        <script id="dlysls__script">
                            var recentchart = document.getElementById('dailysales__chart');
                            var footer = (tooltipItems) => { let sum = 0; tooltipItems.forEach(function(tooltipItem) { sum += tooltipItem.parsed.y; }); return 'Összesen: ' + sum; };
                            var rcChart = new Chart(recentchart, { type: 'bar',
                                data: {
                                    labels: [
                                        <?php $dly__sql = "SELECT DATE(created) AS date FROM `feedbacks` WHERE 1 GROUP BY DATE(created) ORDER BY DATE(created) ASC LIMIT 31"; $dly__res = $con-> query($dly__sql);
                                        if ($dly__res-> num_rows > 0) { while ($data = $dly__res-> fetch_assoc()) { echo "'".$data['date']."',"; } } ?>
                                    ],
                                    datasets: [{
                                        data: [
                                            <?php $dly__sql = "SELECT COUNT(id) AS qty FROM `feedbacks` WHERE 1 GROUP BY DATE(created) ORDER BY DATE(created) ASC LIMIT 31"; $dly__res = $con-> query($dly__sql);
                                            if ($dly__res-> num_rows > 0) { while ($data = $dly__res-> fetch_assoc()) { echo "'".$data['qty']."',"; $lastsevenqty += $data['qty']; } } ?>
                                        ], backgroundColor: 'rgb(0, 158, 247)', hoverOffset: 2, borderRadius: 50, maxBarThickness: 10
                                    }]
                                }, options: { plugins: { legend: { display: false }, tooltip: { callbacks: { footer: footer, }, bodySpacing: 0, bodyFont: { size: '0' }, bodyColor: 'transparent', displayColors: false } }, scales: { x: { display: false, }, y: { display: false, } } }
                            });<?php if ($lastsevenqty) { echo "document.getElementById('lastsvnsales__ind').textContent = ".$lastsevenqty.""; } else { echo "document.getElementById('dailysales__chart').remove; document.getElementById('dlysls__script').remove(); document.getElementById('dailysales__chart__con').innerHTML = `<span class='text-muted small-med padding-05'>Nincs megjeleníthető adat</span>`;"; } ?>
                        </script>
                    </div>
                </div>
            </div>
        </div>
        <div class="flex flex-col item-bg border-soft w-50d-fam padding-05 gap-2">
            <div class="flex flex-col w-fa gap-05">
                <span class="larger text-primary bold">
                    <?php $nus__sql = "SELECT * FROM feedbacks WHERE DATE_FORMAT(CURDATE(), '%m') = MONTH(created) AND status = 2;"; $nus__res = $con-> query($nus__sql); echo $nus__res-> num_rows; $cm__orders = $nus__res-> num_rows; ?>
                </span>
                <div class="flex flex-col w-fa">
                    <span class="text-muted small-med">Lezárt visszajelzések a hónapban</span>
                    <span class="text-muted smaller">* Minden év elején nullázódik</span>
                </div>
            </div>
            <div class="flex flex-col gap-05 margin-top-a">
                <div class="flex flex-row flex-align-c flex-justify-con-sb">
                    <span class="small-med text-primary bold">Előző havi: <span class="bold" id="orders__goal"><?php $nus__sql = "SELECT * FROM feedbacks WHERE DATE_FORMAT(CURDATE(), '%m')-1 = MONTH(created) AND status = 2;"; $nus__res = $con-> query($nus__sql); echo $nus__res-> num_rows; $lm__orders = $nus__res-> num_rows; ?></span></span>
                    <span class="small text-muted"> <?php $ordperc = $lm__orders > 0 ? round((100 * $cm__orders) / $lm__orders) : 0; echo $ordperc.'%'; ?></span>
                </div>
                <div class="flex flex-row gap-05">
                    <div class="flex flex-row border-soft background-bg w-fa">
                        <div class="flex flex-row padding-025 border-soft 
                        <?php if ($ordperc > 50) { echo "loader-success"; } if ($ordperc > 25 && $ordperc <= 50) { echo "loader-warning"; } if ($ordperc < 25) { echo "loader-danger"; } ?>
                        " style="width: <?php echo $ordperc; ?>%;"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="flex flex-row flex-align-c gap-1">
    <div class="flex flex-row flex-justify-con-c flex-wrap-m gap-05 prio__con w-100">
        <?php
            $nus__sql = "SELECT * FROM feedbacks WHERE 1";
            $nus__res = $con-> query($nus__sql); $ordersCount = $nus__res-> num_rows;
        ?>
        <div class="flex flex-col item-bg border-soft w-40d-fam padding-05 gap-2">
            <div class="flex flex-col w-fa gap-05">
                <span class="larger text-primary bold">
                    <?php
                        $nus__sql = "SELECT * FROM feedbacks WHERE status = 0";
                        $nus__res = $con-> query($nus__sql);
                        $cm__orders = $nus__res-> num_rows;
                        echo $nus__res-> num_rows; 
                    ?>
                </span>
                <div class="flex flex-col w-fa">
                    <span class="text-muted small-med">Kezeletlen</span>
                </div>
            </div>
            <div class="flex flex-col gap-05 margin-top-a">
                <div class="flex flex-row flex-align-c flex-justify-con-sb">
                    <span class="small-med text-primary bold">Összes visszajelzés: <span class="bold"><?= $ordersCount; ?></span></span>
                    <span class="small text-muted"><?= $ordperc = round((($cm__orders * 100) / $ordersCount), 1); ?>%</span>
                </div>
                <div class="flex flex-row gap-05">
                    <div class="flex flex-row border-soft background-bg w-fa">
                        <div class="flex flex-row padding-025 border-soft 
                        <?php if ($ordperc > 50) { echo "loader-danger"; } if ($ordperc > 25 && $ordperc <= 50) { echo "loader-warning"; } if ($ordperc < 25) { echo "loader-success"; } ?>
                        " style="width: <?php echo $ordperc; ?>%;"></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="flex flex-col item-bg border-soft w-40d-fam padding-05 gap-2">
            <div class="flex flex-col w-fa gap-05">
                <span class="larger text-primary bold">
                    <?php
                        $nus__sql = "SELECT * FROM feedbacks WHERE status = 1";
                        $nus__res = $con-> query($nus__sql);
                        $cm__orders = $nus__res-> num_rows;
                        echo $nus__res-> num_rows; 
                    ?>
                </span>
                <div class="flex flex-col w-fa">
                    <span class="text-muted small-med">Folyamatan</span>
                </div>
            </div>
            <div class="flex flex-col gap-05 margin-top-a">
                <div class="flex flex-row flex-align-c flex-justify-con-sb">
                    <span class="small-med text-primary bold">Összes visszajelzés: <span class="bold"><?= $ordersCount; ?></span></span>
                    <span class="small text-muted"><?= $ordperc = round((($cm__orders * 100) / $ordersCount), 1); ?>%</span>
                </div>
                <div class="flex flex-row gap-05">
                    <div class="flex flex-row border-soft background-bg w-fa">
                        <div class="flex flex-row padding-025 border-soft 
                        <?php if ($ordperc > 50) { echo "loader-success"; } if ($ordperc > 25 && $ordperc <= 50) { echo "loader-warning"; } if ($ordperc < 25) { echo "loader-danger"; } ?>
                        " style="width: <?php echo $ordperc; ?>%;"></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="flex flex-col item-bg border-soft w-40d-fam padding-05 gap-2">
            <div class="flex flex-col w-fa gap-05">
                <span class="larger text-primary bold">
                    <?php
                        $nus__sql = "SELECT * FROM feedbacks WHERE status = 2";
                        $nus__res = $con-> query($nus__sql);
                        $cm__orders = $nus__res-> num_rows;
                        echo $nus__res-> num_rows; 
                    ?>
                </span>
                <div class="flex flex-col w-fa">
                    <span class="text-muted small-med">Lezárva</span>
                </div>
            </div>
            <div class="flex flex-col gap-05 margin-top-a">
                <div class="flex flex-row flex-align-c flex-justify-con-sb">
                    <span class="small-med text-primary bold">Összes visszajelzés: <span class="bold"><?= $ordersCount; ?></span></span>
                    <span class="small text-muted"><?= $ordperc = round((($cm__orders * 100) / $ordersCount), 1); ?>%</span>
                </div>
                <div class="flex flex-row gap-05">
                    <div class="flex flex-row border-soft background-bg w-fa">
                        <div class="flex flex-row padding-025 border-soft 
                        <?php if ($ordperc > 50) { echo "loader-success"; } if ($ordperc > 25 && $ordperc <= 50) { echo "loader-warning"; } if ($ordperc < 25) { echo "loader-danger"; } ?>
                        " style="width: <?php echo $ordperc; ?>%;"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="flex flex-row flex-align-c flex-justify-con-sb">
    <div class="flex flex-col w-fa gap-1 border-soft item-bg box-shadow">
        <div class="flex flex-col gap-2">
            <div class="flex flex-col w-fa overflow-x-scroll hide-scroll item-bg box-shadow border-soft">
                <div class="flex flex-row flex-align-c flex-justify-con-sb w-fa gap-1 padding-05-1">
                    <div class="flex flex-row flex-align-c gap-1 text-primary">
                        <div class="flex flex-row flex-align-c flex-justify-con-c padding-05" style="margin-right: .5rem;">
                            <label class="cst-chb-lbl">
                                <input type="checkbox" class="absolute" id="check_all_item">
                                <span class="cst-checkbox"></span>
                            </label>
                        </div>
                        <div class="flex flex-col flex-align-c flex-justify-con-c padding-025 border-soft-light background-bg background-bg-hover pointer has-tooltip relative" aria-describedby="tooltip-reload" onclick="listFeedbacks();">
                            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M14.5 20.7259C14.6 21.2259 14.2 21.826 13.7 21.926C13.2 22.026 12.6 22.0259 12.1 22.0259C9.5 22.0259 6.9 21.0259 5 19.1259C1.4 15.5259 1.09998 9.72592 4.29998 5.82592L5.70001 7.22595C3.30001 10.3259 3.59999 14.8259 6.39999 17.7259C8.19999 19.5259 10.8 20.426 13.4 19.926C13.9 19.826 14.4 20.2259 14.5 20.7259ZM18.4 16.8259L19.8 18.2259C22.9 14.3259 22.7 8.52593 19 4.92593C16.7 2.62593 13.5 1.62594 10.3 2.12594C9.79998 2.22594 9.4 2.72595 9.5 3.22595C9.6 3.72595 10.1 4.12594 10.6 4.02594C13.1 3.62594 15.7 4.42595 17.6 6.22595C20.5 9.22595 20.7 13.7259 18.4 16.8259Z" fill="currentColor"/><path opacity="0.3" d="M2 3.62592H7C7.6 3.62592 8 4.02592 8 4.62592V9.62589L2 3.62592ZM16 14.4259V19.4259C16 20.0259 16.4 20.4259 17 20.4259H22L16 14.4259Z" fill="currentColor"/></svg>
                            <span class="tooltip absolute" id="tooltip-reload"><span key="tooltip-reload" key="tooltip-reload">Frissítés</span></span>
                        </div>
                        <div class="flex flex-col flex-align-c flex-justify-con-c padding-025 border-soft-light background-bg background-bg-hover pointer has-tooltip relative" aria-describedby="tooltip-archive">
                            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path opacity="0.3" d="M10 4H21C21.6 4 22 4.4 22 5V7H10V4Z" fill="currentColor"/><path d="M9.2 3H3C2.4 3 2 3.4 2 4V19C2 19.6 2.4 20 3 20H21C21.6 20 22 19.6 22 19V7C22 6.4 21.6 6 21 6H12L10.4 3.60001C10.2 3.20001 9.7 3 9.2 3Z" fill="currentColor"/></svg>
                            <span class="tooltip absolute" id="tooltip-archive"><span key="tooltip-archive" key="tooltip-archive">Archiválás</span></span>
                        </div>
                        <div id="feedback-delete" class="flex flex-col flex-align-c flex-justify-con-c padding-025 border-soft-light background-bg text-muted has-tooltip relative" aria-describedby="tooltip-delete">
                            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M5 9C5 8.44772 5.44772 8 6 8H18C18.5523 8 19 8.44772 19 9V18C19 19.6569 17.6569 21 16 21H8C6.34315 21 5 19.6569 5 18V9Z" fill="currentColor"/><path opacity="0.5" d="M5 5C5 4.44772 5.44772 4 6 4H18C18.5523 4 19 4.44772 19 5V5C19 5.55228 18.5523 6 18 6H6C5.44772 6 5 5.55228 5 5V5Z" fill="currentColor"/><path opacity="0.5" d="M9 4C9 3.44772 9.44772 3 10 3H14C14.5523 3 15 3.44772 15 4V4H9V4Z" fill="currentColor"/></svg>
                            <span class="tooltip absolute" id="tooltip-delete"><span key="tooltip-delete" key="tooltip-delete">Törlés</span></span>
                        </div>
                    </div>
                    <div class="flex flex-row flex-align-c gap-1 text-primary">
                        <div class="flex flex-col flex-align-c flex-justify-con-c padding-025 border-soft-light background-bg background-bg-hover pointer has-tooltip relative" aria-describedby="tooltip-search">
                            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><rect opacity="0.5" x="17.0365" y="15.1223" width="8.15546" height="2" rx="1" transform="rotate(45 17.0365 15.1223)" fill="currentColor"/><path d="M11 19C6.55556 19 3 15.4444 3 11C3 6.55556 6.55556 3 11 3C15.4444 3 19 6.55556 19 11C19 15.4444 15.4444 19 11 19ZM11 5C7.53333 5 5 7.53333 5 11C5 14.4667 7.53333 17 11 17C14.4667 17 17 14.4667 17 11C17 7.53333 14.4667 5 11 5Z" fill="currentColor"/></svg>
                            <span class="tooltip absolute" id="tooltip-search"><span key="tooltip-search" key="tooltip-search">Keresés</span></span>
                        </div>
                        <div class="flex flex-col flex-align-c flex-justify-con-c padding-025 border-soft-light background-bg background-bg-hover pointer has-tooltip relative" aria-describedby="tooltip-filter">
                            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M19.0759 3H4.72777C3.95892 3 3.47768 3.83148 3.86067 4.49814L8.56967 12.6949C9.17923 13.7559 9.5 14.9582 9.5 16.1819V19.5072C9.5 20.2189 10.2223 20.7028 10.8805 20.432L13.8805 19.1977C14.2553 19.0435 14.5 18.6783 14.5 18.273V13.8372C14.5 12.8089 14.8171 11.8056 15.408 10.964L19.8943 4.57465C20.3596 3.912 19.8856 3 19.0759 3Z" fill="currentColor"/></svg>
                            <span class="tooltip absolute" id="tooltip-filter"><span key="tooltip-filter" key="tooltip-filter">Rendezés</span></span>
                        </div>
                    </div>
                </div>
                <table class="sess__history text-muted text-align-c w-fa item-bg padding-05 table-padding-05 table-fixed compare-table" style="border-collapse: collapse;" id="feedbacks-container"></table>
            </div>
        </div>
    </div>
</div>
<script>
    
    var sltd = [];
    function listFeedbacks () {

        $(document).ready(() => {

            sltd = [];
            document.getElementById('check_all_item').checked = false;
            resetDeleteButton();

            
            var feedbackData = new FormData(); 
            const feedbackObject = { action : 'list' };
            feedbackData.append('feedback', JSON.stringify(feedbackObject));
            const ajaxObject = {
                url : '/assets/php/classes/class.Feedbacks.php',
                data : feedbackData,
                loaderContainer : {
                    isset : true,
                    id : 'feedbacks-container',
                    type : 'panel',
                    iconSize : {
                        iconWidth : '128',
                        iconHeight : '128'
                    },
                    iconColor : {
                        isset : false,
                        color : 'currentColor'
                    },
                    loaderText : {
                        custom : true,
                        customText : 'Visszajelzések megjelenítése folyamatban...'
                    }
                }
            }
            let response = getFromAjaxRequest(ajaxObject)
            .then((data) => { document.getElementById('feedbacks-container').innerHTML = ``;
                if (data.status == 'success') {
                    for (let i = 0; i < data.data.length; i++) {
                        var options = { year: 'numeric', month: 'short', day: 'numeric' }; var today  = new Date(data.data[i].created);
                        document.getElementById('feedbacks-container').innerHTML += `
                            <tr class="sessh__body">
                                <td class="padding-05">
                                    <div class="flex flex-row flex-align-c flex-justify-con-c padding-05" style="margin-right: .5rem;">
                                        <label class="cst-chb-lbl">
                                            <input type="checkbox" class="absolute chifb" id="sel-fi-${data.data[i].id}" onclick="__selectcitem(${data.data[i].id})">
                                            <span class="cst-checkbox"></span>
                                        </label>
                                    </div>
                                </td>
                                <td class="padding-05">
                                    <div class="flex flex-row flex-align-c gap-05 text-secondary">
                                        <div class="flex flex-col flex-align-c flex-justify-con-c padding-025 border-soft-light bold" style="background-color: #${data.data[i].color}; color: #fff;">${data.data[i].initials}</div>
                                        <span>${data.data[i].name}</span>
                                    </div>
                                </td>
                                <td class="padding-05">
                                    <div class="flex flex-col flex-align-fs flex-justify-con-fs gap-025">
                                        <a class="link pointer user-select-none" href="/feedback/v/${data.data[i].id}?f=a">${data.data[i].title}</a>
                                        <div class="flex flex-row flex-align-fs flex-justify-con-l gap-1">
                                            <span class="background-bg padding-025 border-soft-light smaller-light user-select-none">
                                                ${
                                                    data.data[i].type == 0 ? 'Webáruház'
                                                    : (
                                                        data.data[i].type == 1 ? 'Termékek'
                                                        : (
                                                            data.data[i].type == 2 ? 'Rendelés'
                                                            : (
                                                                data.data[i].type == 3 ? 'Szállítás'
                                                                : (
                                                                    data.data[i].type == 4 ? 'Felhasználó'
                                                                    : (
                                                                        data.data[i].type == 5 ? 'Egyéb'
                                                                        : (
                                                                            data.data[i].type == 6 ? 'Weboldal'
                                                                            : 'Ismeretlen'
                                                                        )
                                                                    )
                                                                )
                                                            )
                                                        )   
                                                    )
                                                }
                                            </span>
                                            ${
                                                data.data[i].status == 0 ? `<span class="warning-bg padding-025 border-soft-light smaller-light user-select-none">Kezeletlen</span>`
                                                : (
                                                    data.data[i].status == 1 ? `<span class="primary-bg padding-025 border-soft-light smaller-light user-select-none">Folyamatban</span>`
                                                    : `<span class="success-bg padding-025 border-soft-light smaller-light user-select-none">Lezárva</span>`
                                                )
                                            }
                                        </div>
                                    </div>
                                </td>
                                <td class="padding-05">
                                    <span>${today.toLocaleDateString("hu-HU", options)}</span>
                                </td>
                            </tr>
                        `;
                    }
                } else {
                    if (data.status == 'empty') {
                        document.getElementById('feedbacks-container').innerHTML = `
                            <div class="flex flex-col flex-align-c flex-justify-con-c w-fa text-muted user-select-none gap-1 padding-1 w-fa">
                                <svg width="128" height="128" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path opacity="0.3" d="M20 3H4C2.89543 3 2 3.89543 2 5V16C2 17.1046 2.89543 18 4 18H4.5C5.05228 18 5.5 18.4477 5.5 19V21.5052C5.5 22.1441 6.21212 22.5253 6.74376 22.1708L11.4885 19.0077C12.4741 18.3506 13.6321 18 14.8167 18H20C21.1046 18 22 17.1046 22 16V5C22 3.89543 21.1046 3 20 3Z" fill="currentColor"/><rect x="6" y="12" width="7" height="2" rx="1" fill="currentColor"/><rect x="6" y="7" width="12" height="2" rx="1" fill="currentColor"/></svg>
                                <span class="small-med w-50d-fam">Nincsen megjeleníthető visszajelzés az adazbázisban.</span>
                            </div>
                        `;
                    } else {
                        document.getElementById('feedbacks-container').innerHTML = `
                            <div class="flex flex-col flex-align-c flex-justify-con-c w-fa text-muted user-select-none gap-1 padding-1 w-fa">
                                <svg width="128" height="128" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><rect opacity="0.3" x="2" y="2" width="20" height="20" rx="10" fill="currentColor"/><rect x="11" y="14" width="7" height="2" rx="1" transform="rotate(-90 11 14)" fill="currentColor"/><rect x="11" y="17" width="2" height="2" rx="1" transform="rotate(-90 11 17)" fill="currentColor"/></svg>
                                <span class="small-med w-50d-fam">Hiba történt a megjelenítés közben.</span>
                            </div>
                        `;
                    }
                }
            })
            .catch((reason) => {
                document.getElementById('feedbacks-container').innerHTML = `
                    <div class="flex flex-col flex-align-c flex-justify-con-c w-fa text-muted user-select-none gap-1 padding-1 w-fa">
                        <svg width="128" height="128" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><rect opacity="0.3" x="2" y="2" width="20" height="20" rx="10" fill="currentColor"/><rect x="11" y="14" width="7" height="2" rx="1" transform="rotate(-90 11 14)" fill="currentColor"/><rect x="11" y="17" width="2" height="2" rx="1" transform="rotate(-90 11 17)" fill="currentColor"/></svg>
                        <span class="small-med w-50d-fam">Hiba történt a megjelenítés közben.</span>
                    </div>
                `;
            });

        });

    } listFeedbacks();

    function __selectcitem (pid) {
        if (document.getElementById('sel-fi-'+pid).checked) { sltd.indexOf(pid) === -1 ? sltd.push(pid) : console.log(); }
        else { if (sltd.indexOf(pid) > -1) { sltd.splice(sltd.indexOf(pid), 1); } }
        checkFeedbackStatus(sltd);
    }
    $('#check_all_item').click(() => { sltd = []; var items = document.getElementsByClassName('chifb');
        if (document.getElementById('check_all_item').checked) {
            for (let i = 0; i < items.length; i++) { sltd.push(Number(items[i].id.split('-')[2])); document.getElementById(items[i].id).checked = true; }
        } else { for (let i = 0; i < items.length; i++) { document.getElementById(items[i].id).checked = false; sltd = []; } }
        checkFeedbackStatus(sltd);
    });

    function resetDeleteButton () {

        document.getElementById('feedback-delete').classList.add('text-muted');
        document.getElementById('feedback-delete').classList.remove('pointer');
        document.getElementById('feedback-delete').classList.remove('background-bg-hover');   
        $('#feedback-delete').off('click');

    }

    function checkFeedbackStatus (list) {

        if (list.length > 0) {
            document.getElementById('feedback-delete').classList.remove('text-muted');
            document.getElementById('feedback-delete').classList.add('pointer');
            document.getElementById('feedback-delete').classList.add('background-bg-hover');

            $('#feedback-delete').off('click');

            $('#feedback-delete').click(() => {

                var feedbackData = new FormData(); 
                const feedbackObject = { action : 'status', items : list };
                feedbackData.append('feedback', JSON.stringify(feedbackObject));
                const ajaxObject = {
                    url : '/assets/php/classes/class.Feedbacks.php',
                    data : feedbackData,
                    loaderContainer : {
                        isset : false,
                        id : 'feedbacks-container',
                        type : 'panel',
                        iconSize : {
                            iconWidth : '128',
                            iconHeight : '128'
                        },
                        iconColor : {
                            isset : false,
                            color : 'currentColor'
                        },
                        loaderText : {
                            custom : true,
                            customText : 'Visszajelzések megjelenítése folyamatban...'
                        }
                    }
                }
                let response = getFromAjaxRequest(ajaxObject)
                .then((data) => {
                    if (data.status == 'success') {
                        let closedIssues = [];
                        for (let i = 0; i < data.data.length; i++) {
                            if (data.data[i].status == 2) {
                                closedIssues.push(
                                    {
                                        fid : data.data[i].fid,
                                        status : data.data[i].status
                                    }
                                );
                            }
                        }

                        if (closedIssues.length > 0) {

                            var panelBody = `
                                <div class="flex flex-col flex-align-c flex-justify-con-c w-fa gap-1 user-select-none padding-1">
                                    <div class="flex flex-col flex-align-c flex-justify-con-c w-fa gap-05">
                                        <div class="text-danger">
                                            <svg width="128" height="128" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><rect opacity="0.3" x="2" y="2" width="20" height="20" rx="10" fill="currentColor"/><rect x="11" y="14" width="7" height="2" rx="1" transform="rotate(-90 11 14)" fill="currentColor"/><rect x="11" y="17" width="2" height="2" rx="1" transform="rotate(-90 11 17)" fill="currentColor"/></svg>
                                        </div>
                                        <div class="flex flex-col flex-align-c flex-justify-con-c gap-05 w-fa">
                                            <span class="text-primary bold small-med">Biztosan törölni szeretné ezt a visszajelzést?</span>
                                            <span class="text-align-c text-secondary smaller-med">Olyan visszajelzést is törölni, szeretne, amelyik már le lett zárva. A törlés folytatásával ezek a visszajelzések nem lesznek törölve.</span>
                                        </div>
                                    </div>
                                </div>
                            `;

                        } else {

                            var panelBody = `
                                <div class="flex flex-col flex-align-c flex-justify-con-c w-fa gap-1 user-select-none padding-1">
                                    <div class="flex flex-col flex-align-c flex-justify-con-c w-fa gap-05">
                                        <div class="text-danger">
                                            <svg width="128" height="128" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><rect opacity="0.3" x="2" y="2" width="20" height="20" rx="10" fill="currentColor"/><rect x="11" y="14" width="7" height="2" rx="1" transform="rotate(-90 11 14)" fill="currentColor"/><rect x="11" y="17" width="2" height="2" rx="1" transform="rotate(-90 11 17)" fill="currentColor"/></svg>
                                        </div>
                                        <span class="text-primary bold small-med">Biztosan törölni szeretné ezt a visszajelzést?</span>
                                    </div>
                                </div>
                            `;
                        }

                        var panelFooter = `
                            <div class="flex flex-row flex-align-c flex-justify-con-c gap-2 w-fa padding-1">
                                <span class="smaller-light text-secondary text-primary-hover pointer user-select-none" action="close">Mégsem</span>
                                <span class="flex flex-row flex-align-c flex-justify-con-c danger-bg danger-bg-hover border-soft-light padding-05-1 pointer user-select-none" id="delete-confirm" action="close">Törlés</span>
                            </div>
                        `;

                        const panelObject = {
                            id : 'feedback-select-delete-panel',
                            parent : 'body',
                            header : {
                                isset : true,
                                title : {
                                    isset : true,
                                    title : 'Visszajelzés Törlése'
                                },
                                close : {
                                    isset : true,
                                    id : 'cl__ebox',
                                    icon : {
                                        size : {
                                            unit : 'px',
                                            width : 24,
                                            height: 24
                                        },
                                        fill : 'currentColor',
                                        title : 'Bezárás'
                                    },
                                }
                            },
                            body : {
                                isset : true,
                                html : panelBody
                            },
                            footer : {
                                isset : true,
                                html : panelFooter
                            }
                        }

                        let response = getFromPanelRequest(panelObject)
                        .then((data) => {
                            $('#delete-confirm').click(() => {

                                for (let i = 0; i < closedIssues.length; i++) {
                                    if (closedIssues[i].status == 2) {
                                        if (sltd.indexOf(closedIssues[i].fid) > -1) { sltd.splice(sltd.indexOf(closedIssues[i].fid), 1); }
                                    }
                                }

                                var feedbackData = new FormData(); 
                                const feedbackObject = {
                                    action : 'delete',
                                    items  : sltd
                                };

                                $.ajax({url: "https://api.ipdata.co?api-key=739837e232548988c86b954108794b57bd3e1dbcd6eb550bfa53e544", dataType: 'json',
                                    success : function (api) {

                                        feedbackObject.ip = api.ip;
                                        feedbackData.append('feedback', JSON.stringify(feedbackObject));
                                        const ajaxObject = {
                                            url : '/assets/php/classes/class.Feedbacks.php',
                                            data : feedbackData,
                                            loaderContainer : {
                                                isset : false,
                                                id : 'feedback-message-con',
                                                type : 'panel',
                                                iconSize : {
                                                    iconWidth : '128',
                                                    iconHeight : '128'
                                                },
                                                iconColor : {
                                                    isset : false,
                                                    color : 'currentColor'
                                                },
                                                loaderText : {
                                                    custom : true,
                                                    customText : 'Üzenetek törlése folyamatban...'
                                                }
                                            }
                                        };

                                        let response = getFromAjaxRequest(ajaxObject)
                                        .then((data) => {
                                            if (data.status == 'success') {
                                                resetDeleteButton(); listFeedbacks();
                                                notificationSystem(0, 0, 0, 'Üzenet', 'Sikeres törlés.');
                                            } else {
                                                listFeedbacks();
                                                notificationSystem(0, 0, 0, 'Üzenet', 'A visszajelzést nem sikerült törölni.');
                                            }
                                        }) .catch((reason) => { console.log(reason); });
                                    }, error : function (e) { notificationSystem(1, 0, 0, 'Üzenet', 'Nem tudtunk kapcsolódni a kiszolgáltatóhoz.'); }
                                });

                            });
                        }).catch((reason) => { console.log(reason); });

                    }
                })
                .catch((reason) => {
                    console.log(reason);
                });

            });

        } else { resetDeleteButton(); }

    }

</script>
