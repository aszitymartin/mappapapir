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
                <span class="text-muted small-med">Rendelések</span>
            </div>
            <div class="flex flex-col gap-05 margin-top-a">
                <div class="flex flex-row gap-05 w-fa">
                    <div class="flex flex-row flex-wrap-no w-fa" id="dailysales__chart__con">
                        <canvas id="dailysales__chart" class="w-fa" height="80px"></canvas>
                        <script id="dlysls__script">
                            var recentchart = document.getElementById('dailysales__chart');
                            var footer = (tooltipItems) => { let sum = 0; tooltipItems.forEach(function(tooltipItem) { sum += tooltipItem.parsed.y; }); return 'Rendelve: ' + sum; };
                            var rcChart = new Chart(recentchart, { type: 'bar',
                                data: {
                                    labels: [
                                        <?php $dly__sql = "SELECT DATE(date) AS date FROM `orders` WHERE 1 GROUP BY DATE(date) ORDER BY DATE(date) ASC LIMIT 7"; $dly__res = $con-> query($dly__sql);
                                        if ($dly__res-> num_rows > 0) { while ($data = $dly__res-> fetch_assoc()) { echo "'".$data['date']."',"; } } ?>
                                    ],
                                    datasets: [{
                                        data: [
                                            <?php $dly__sql = "SELECT COUNT(id) AS qty FROM `orders` WHERE 1 GROUP BY DATE(date) ORDER BY DATE(date) ASC LIMIT 7"; $dly__res = $con-> query($dly__sql);
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
                    <?php $nus__sql = "SELECT * FROM orders WHERE DATE_FORMAT(CURDATE(), '%m') = MONTH(date);"; $nus__res = $con-> query($nus__sql); echo $nus__res-> num_rows; $cm__orders = $nus__res-> num_rows; ?>
                </span>
                <div class="flex flex-col w-fa">
                    <span class="text-muted small-med">Rendelések a hónapban</span>
                    <span class="text-muted smaller">* Minden év elején nullázódik</span>
                </div>
            </div>
            <div class="flex flex-col gap-05 margin-top-a">
                <div class="flex flex-row flex-align-c flex-justify-con-sb">
                    <span class="small-med text-primary bold">Előző havi: <span class="bold" id="orders__goal"><?php $nus__sql = "SELECT * FROM orders WHERE DATE_FORMAT(CURDATE(), '%m')-1 = MONTH(date);"; $nus__res = $con-> query($nus__sql); echo $nus__res-> num_rows; $lm__orders = $nus__res-> num_rows; ?></span></span>
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
<div class="flex flex-row flex-align-c flex-justify-con-c flex-wrap w-fa gap-1">
    <div class="flex flex-row flex-align-c flex-justify-con-c flex-wrap w-fa gap-1" id="orders-con">
        <div class="flex flex-row w-fa overflow-x-scroll hide-scroll item-bg box-shadow border-soft">
            <table class="sess__history text-muted text-align-c w-fa item-bg padding-05 table-padding-05 table-fixed compare-table text-align-c" style="border-collapse: collapse;" id="users-table">
                <tr class="small uppercase sessh__header" style="line-height: 2;">
                    <th>OID</th>
                    <th>Vásárló</th>
                    <th>Státusz</th>
                    <th>Összeg</th>
                    <th>Dátum</th>
                    <th></th>
                </tr>
                <?php
                    $selectOrdersSQL = "SELECT orders.id, orders.date, fullname, status, subTotal FROM orders INNER JOIN customers ON customers.id = orders.uid INNER JOIN orders__payment ON orders__payment.oid = orders.id ORDER BY orders.status, orders.date ASC";
                    $selectOrdersRes = $con->query($selectOrdersSQL);
                    if ($selectOrdersRes->num_rows > 0) {
                        while ($o = $selectOrdersRes->fetch_assoc()) {
                            echo '
                            <tr class="sessh__body small">
                                <td>'.$o['id'].'</td>
                                <td>'.$o['fullname'].'</td>
                                <td>';
                                    switch ($o['status']) {
                                        case '0': echo '<span class="label-warning smaller bold padding-025 border-soft-light">Összekészítés</span>'; break;
                                        case '1': echo '<span class="label-primary smaller bold padding-025 border-soft-light">Kiszállítás</span>'; break;
                                        case '2': echo '<span class="label-success smaller bold padding-025 border-soft-light">Kiszállítva</span>'; break;
                                        case '3': echo '<span class="label-warning smaller bold padding-025 border-soft-light">Befagyasztott</span>'; break;
                                        case '4': echo '<span class="label-danger smaller bold padding-025 border-soft-light">Sikertelen</span>'; break;
                                    }
                                    echo '
                                </td>
                                <td>'.$o['subTotal'].' Ft</td>
                                <td>'.$o['date'].'</td>
                                <td><a href="/orders/v/'.$o['id'].'" class="label-primary pointer user-select-none smaller bold padding-025 border-soft-light">Megtekintés</a></td>
                            </tr>
                            ';
                        }
                    }
                ?>
            </table>
        </div>
    </div>
</div>