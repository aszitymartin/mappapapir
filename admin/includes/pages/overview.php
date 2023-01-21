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
        <div class="flex flex-col item-bg border-soft w-40 padding-05 gap-2">
            <div class="flex flex-col w-fa gap-05">
                <span class="larger text-primary bold">
                <?php $nus__sql = "SELECT id FROM customers WHERE 1"; $nus__res = $con-> query($nus__sql); echo $nus__res-> num_rows; ?>
                </span>
                <span class="text-muted small-med">Összes felhasználó</span>
            </div>
            <div class="flex flex-col gap-05">
                <span class="small-med text-primary bold">Legújabbak</span>
                <div class="flex flex-row gap-05">
                    <div class="flex flex-row flex-wrap-no" id="curron__con">
                        <?php $nus__sql = "SELECT customers.id, fullname, customers__header.initials, customers__header.color FROM customers INNER JOIN customers__header ON customers__header.uid = customers.id ORDER BY date DESC LIMIT 4"; $nus__res = $con-> query($nus__sql);
                        if ($nus__res-> num_rows > 0) { 
                            while($data = $nus__res-> fetch_assoc()) { echo '<span class="flex flex-row flex-align-c flex-justify-con-c bold text-white box-shadow curron__head circle padding-05 small" title="'.$data['fullname'].'" style="background-color: #'.$data['color'].'">'.$data['initials'].'</span>'; }
                            if ($nus__res-> num_rows > 4) { echo '<span class="flex flex-row flex-align-c flex-justify-con-c text-muted background-bg box-shadow curron__head circle padding-05 small">+'; echo $nus__res-> num_rows - 4; echo '</span>'; }
                        }
                        ?>
                    </div>
                </div>
            </div>
        </div>
        <div class="flex flex-col item-bg border-soft w-40 padding-05 padding-b-0 gap-05">
            <div class="flex flex-col w-fa gap-05">
                <span class="larger text-primary bold" id="lastsvnsales__ind"></span>
                <span class="text-muted small-med">Rendelések</span>
            </div>
            <div class="flex flex-col gap-05 margin-top-a">
                <div class="flex flex-row gap-05">
                    <div class="flex flex-row flex-wrap-no" id="dailysales__chart__con">
                        <canvas id="dailysales__chart" width="150" height="80px"></canvas>
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
        <div class="flex flex-col item-bg border-soft w-40 padding-05 gap-2">
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
<div class="flex flex-row-d-col-m gap-1">
    <div class="flex flex-col w-fa gap-1 border-soft item-bg box-shadow padding-0">
        <div class="flex flex-row flex-align-c flex-justify-con-sb padding-1">
            <span class="text-primary small bold">Havi rendelések</span>
        </div>
        <div class="flex flex-col gap-2 prio__con">
            <div class="flex flex-col padding-1">
                <div class="flex flex-row flex-align-c gap-05">
                    <?php $monthord__sql = "SELECT SUM(subTotal) AS subtotal, DAY(date) AS date FROM `orders` INNER JOIN orders__payment ON orders__payment.oid = orders.id WHERE MONTH(CURRENT_DATE) = MONTH(date) GROUP BY DAY(date)"; $monthord__res = $con-> query($monthord__sql); if ($monthord__res-> num_rows > 0) { $mth__arr = array(); while($data = $monthord__res-> fetch_assoc()) { array_push($mth__arr, [$data['date'],date('F'),$data['subtotal']]); $mthord__total += $data['subtotal']; } } else { $mthord__total = 0; } ?>
                    <span class="text-primary larger bold" id="monthly__orders__money">NaN</span>
                    <script>
                        document.getElementById('monthly__orders__money').textContent = formatter.format(<?php echo $mthord__total; ?>);
                    </script>
                </div>
                <div class="flex flex-row flex-align-c">
                    <span class="small text-muted">Ebben a hónapban szerzett bevételek</span>
                </div>
            </div>
        </div>
        <div class="flex flex-col margin-top-a">
            <?php
                if ($monthord__res-> num_rows > 0) {
                    echo "
                    <canvas id='monthlyorder__chart' width='' height='150' style='margin: -.55%; cursor: crosshair;'></canvas>
                    <script id='dlysls__script'>
                        var mho = document.getElementById('monthlyorder__chart');
                        var mhChart = new Chart(mho, { type: 'line',
                            data: { labels: ["; for ($i = 0; $i < sizeof($mth__arr); $i++) { echo "'"; echo $mth__arr[$i][1]; echo " "; echo $mth__arr[$i][0]; echo "',"; } echo "],
                                datasets: [{ data: ["; for ($i = 0; $i < sizeof($mth__arr); $i++) { echo "'".$mth__arr[$i][2]."',"; } echo "],
                                    fill: { target: 'start', above: '#00fff445' }, pointBackgroundColor: '#1aafa8', borderColor: '#1aafa8', hoverOffset: 2, maxBarThickness: 10, lineTension: 0.5
                                }]
                            }, options: { plugins: { filler: { propagate: true }, legend: { display: false }, tooltip: { displayColors: false } }, scales: { x: { display: false, }, y: { display: false, } } },
                        });
                    </script>
                    ";
                } else { echo '<span class="text-muted padding-1">Nincsen megjeleníthető adat.</span>'; }
            ?>
        </div>
    </div>
    
</div>
<div class="flex flex-row-d-col-m gap-1">
    <div class="flex flex-col w-fa gap-1 border-soft item-bg box-shadow padding-1">
        <div class="flex flex-row flex-align-c flex-justify-con-sb">
            <span class="text-primary small bold">Készletjelentés</span>
            <div class="flex flex-row flex-align-c gap-1">
                <div class="flex flex-row flex-align-c gap-05 stock__dropdown relative">
                    <span class="text-muted small-med">Státusz</span>
                    <div class="flex flex-row flex-align-c text-primary stockd__trigger pointer user-select-none" onclick="__stockdrop()">
                        <span class="text-primary small-med bold">Készleten</span>
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M11.4343 12.7344L7.25 8.55005C6.83579 8.13583 6.16421 8.13584 5.75 8.55005C5.33579 8.96426 5.33579 9.63583 5.75 10.05L11.2929 15.5929C11.6834 15.9835 12.3166 15.9835 12.7071 15.5929L18.25 10.05C18.6642 9.63584 18.6642 8.96426 18.25 8.55005C17.8358 8.13584 17.1642 8.13584 16.75 8.55005L12.5657 12.7344C12.2533 13.0468 11.7467 13.0468 11.4343 12.7344Z" fill="currentColor"/></svg>
                    </div>
                    <div class="stockd__in flex-col gap-05 small text-primary item-bg border-soft box-shadow padding-025 w-fa" id="stockd__in">
                        <div class="flex flex-col">
                            <span class="large text-primary bold padding-05" style="border-bottom: 1px solid var(--background)">Rendezés</span>
                        </div>
                        <div class="stockd__item__con flex flex-col gap-025">
                            <span class="flex flex-row pointer border-soft padding-05" onclick="__sortstock('all')">Összes</span>
                            <span class="flex flex-row pointer border-soft padding-05" onclick="__sortstock('stock')">Készleten</span>
                            <span class="flex flex-row pointer border-soft padding-05" onclick="__sortstock('low')">Kifutóban</span>
                            <span class="flex flex-row pointer border-soft padding-05" onclick="__sortstock('out')">Elfogyott</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="flex flex-col gap-2 prio__con">
            <div class="flex flex-row w-fa overflow-x-scroll hide-scroll item-bg padding-05 box-shadow border-soft">
                <table class="sess__history text-muted text-align-c w-fa item-bg padding-05 table-padding-05 table-fixed compare-table text-align-c" style="border-collapse: collapse;" id="stock__table">
                    <tr class="small uppercase sessh__header tr-padding-05" style="line-height: 2;">
                        <th>Azonosító</th><th>Termék</th><th>Szín</th>
                        <th>Felvéve</th><th>Ár</th>
                        <th>Státusz</th><th>Mennyiség</th>
                    </tr>
                    <?php
                        $stock__sql = "SELECT products.id, products.name, products.added, products__variations.color, products__pricing.base, products__inventory.quantity, products__inventory.unit FROM `products` INNER JOIN products__variations ON products__variations.pid = products.id INNER JOIN products__pricing ON products__pricing.pid = products.id INNER JOIN products__inventory ON products__inventory.pid = products.id WHERE 1"; $stock__res = $con-> query($stock__sql);
                        if ($stock__res-> num_rows > 0) { 
                            while($data = $stock__res-> fetch_assoc()) {
                                echo '
                                <tr class="sessh__body">
                                    <td class="padding-tb-1">'.$data['id'].'</td>
                                    <td class="padding-tb-1 text-primary bold">'. mb_substr($data['name'], 0, 45) .'</td>
                                    <td class="padding-tb-1">'.$data['color'].'</td>
                                    <td class="padding-tb-1">'.$data['added'].'</td>
                                    <td class="padding-tb-1">'.$data['base'].' Ft</td>
                                    <td class="padding-tb-1" data-stock="'; if ($data['quantity'] < 1) { echo 'out'; } else if ($data['unit'] < 10) { echo 'low'; } else if ($data['quantity'] > 20) { echo 'stock'; } echo '">'; if ($data['quantity'] < 1) { echo '<span class="label-danger smaller bold padding-025 border-soft">Elfogyott</span>'; } else if ($data['quantity'] < 10) { echo '<span class="label-warning smaller bold padding-025 border-soft">Kifutóban</span>'; } else if ($data['quantity'] > 20) { echo '<span class="label-primary smaller bold padding-025 border-soft">Készleten</span>'; } echo '</td>
                                    <td class="padding-tb-1 text-secondary bold">'.$data['quantity'].' '.$data['unit'].'</td>
                                </tr>
                                ';
                            }
                        }
                    ?>
                </table>
            </div>
            <script>
                function __stockdrop () { document.getElementById('stockd__in').classList.toggle('stockd__show'); }
                function __sortstock (status) { if (document.getElementById('stockd__in').classList.contains('stockd__show')) { document.getElementById('stockd__in').classList.toggle('stockd__show'); }
                    var td, value; var table = document.getElementById('stock__table'); var tr = table.getElementsByTagName('tr');
                    for (let i = 1; i < tr.length; i++) { td = tr[i].getElementsByTagName('td')[5];
                        if (td) { value = td.getAttribute('data-stock'); if (status.toUpperCase() === value.toUpperCase() || status.toUpperCase() == 'ALL') { tr[i].style.display = ''; } else { tr[i].style.display = 'none'; } }
                    }
                }
            </script>
        </div>
    </div>
</div>
<script>var bal__to__form = document.getElementsByClassName('money__form'); for (let i = 0; i < bal__to__form.length; i++) { bal__to__form[i].textContent = formatter.format(bal__to__form[i].getAttribute('default-data')); }</script>