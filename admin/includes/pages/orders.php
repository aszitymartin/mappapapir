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
                                        <?php $dly__sql = "SELECT DATE(date) AS date FROM `orders` WHERE 1 GROUP BY DATE(date) ORDER BY DATE(date) ASC LIMIT 31"; $dly__res = $con-> query($dly__sql);
                                        if ($dly__res-> num_rows > 0) { while ($data = $dly__res-> fetch_assoc()) { echo "'".$data['date']."',"; } } ?>
                                    ],
                                    datasets: [{
                                        data: [
                                            <?php $dly__sql = "SELECT COUNT(id) AS qty FROM `orders` WHERE 1 GROUP BY DATE(date) ORDER BY DATE(date) ASC LIMIT 31"; $dly__res = $con-> query($dly__sql);
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
<div class="flex flex-col gap-1">
    <div class="flex flex-col w-fa gap-1 border-soft item-bg box-shadow padding-0">
        <div class="flex flex-row flex-align-c flex-justify-con-sb gap-1">
            <div class="flex flex-col padding-1">
                <div class="flex flex-row flex-align-c gap-05">
                    <?php $monthord__sql = "SELECT SUM(subTotal) AS subtotal, DAY(date) AS date FROM `orders` INNER JOIN orders__payment ON orders__payment.oid = orders.id WHERE MONTH(CURRENT_DATE) = MONTH(date) GROUP BY DAY(date)"; $monthord__res = $con-> query($monthord__sql); if ($monthord__res-> num_rows > 0) { $mth__arr = array(); while($data = $monthord__res-> fetch_assoc()) { array_push($mth__arr, [$data['date'],date('F'),$data['subtotal']]); $mthord__total += $data['subtotal']; } } else { $mthord__total = 0; } ?>
                    <span class="text-primary larger bold" id="monthly__orders__money">NaN</span>
                    <script>document.getElementById('monthly__orders__money').textContent = formatter.format(<?php echo $mthord__total; ?>);</script>
                </div>
                <div class="flex flex-row flex-align-c">
                    <span class="small text-muted">Ebben a hónapban szerzett bevételek</span>
                </div>
            </div>
            <div class="flex flex-col padding-1">
                <div class="flex flex-row flex-align-c gap-05">
                    <?php $allt__sql = "SELECT SUM(subTotal) AS subtotal FROM `orders` INNER JOIN orders__payment ON orders__payment.oid = orders.id WHERE 1"; $allt__res = $con-> query($allt__sql); if ($allt__res-> num_rows > 0) { $alltmth__arr = array(); while($data = $allt__res-> fetch_assoc()) { array_push($alltmth__arr, [$data['date'],date('F'),$data['subtotal']]); $allt__total += $data['subtotal']; } } else { $allt__total = 0; } ?>
                    <span class="text-primary larger bold" id="alltime__orders__money">NaN</span>
                    <script>document.getElementById('alltime__orders__money').textContent = formatter.format(<?php echo $allt__total; ?>);</script>
                </div>
                <div class="flex flex-row flex-align-c">
                    <span class="small text-muted">Összes bevétel</span>
                </div>
            </div>
        </div>
        <?php
            if ($monthord__res->num_rows > 0) {
                echo '
                <div class="flex flex-col flex-align-l flex-justify-con-fs padding-1 gap-2 w-30d-fam">
                ';
                $sql = "SELECT SUM(subTotal) AS subTotal FROM orders__payment INNER JOIN orders ON orders.id = orders__payment.oid WHERE orders.status = 2";
                $res = $con-> query($sql); $dt = $res->fetch_assoc(); $cm = $dt['subTotal'];
                $ordperc = round((($cm*100)/$mthord__total));
                echo '
                <div class="flex flex-col gap-05 margin-top-a">
                    <div class="flex flex-row flex-align-c flex-justify-con-sb">
                        <span class="small-med text-primary bold">Befejezett tranzakciók</span>
                        <span class="small text-muted" id="cm"><script>document.getElementById("cm").textContent = (formatter.format('. $cm .'));</script></span>
                    </div>
                    <div class="flex flex-row gap-05">
                        <div class="flex flex-row border-soft background-bg w-fa">
                            <div class="flex flex-row padding-025 border-soft 
                            ';if ($ordperc > 50) { echo "loader-success"; } if ($ordperc > 25 && $ordperc <= 50) { echo "loader-warning"; } if ($ordperc < 25) { echo "loader-danger"; } echo '
                            " style="width: '. $ordperc .'%;"></div>
                        </div>
                    </div>
                </div>
                ';
                $sql = "SELECT SUM(subTotal) AS subTotal FROM orders__payment INNER JOIN orders ON orders.id = orders__payment.oid WHERE orders.status = 0 OR orders.status = 1";
                $res = $con-> query($sql); $dt = $res->fetch_assoc(); $pm = $dt['subTotal'];
                $ordperc = round((($pm*100)/$mthord__total));
                echo '
                <div class="flex flex-col gap-05 margin-top-a">
                    <div class="flex flex-row flex-align-c flex-justify-con-sb">
                        <span class="small-med text-primary bold">Függő tranzakciók</span>
                        <span class="small text-muted" id="pm"><script>document.getElementById("pm").textContent = (formatter.format('. $pm .'));</script></span>
                    </div>
                    <div class="flex flex-row gap-05">
                        <div class="flex flex-row border-soft background-bg w-fa">
                            <div class="flex flex-row padding-025 border-soft 
                            '; if ($ordperc > 50) { echo "loader-warning"; } if ($ordperc > 25 && $ordperc <= 50) { echo "loader-warning"; } if ($ordperc < 25) { echo "loader-danger"; } echo '
                            " style="width: '. $ordperc .'%;"></div>
                        </div>
                    </div>
                </div>
                ';
                $sql = "SELECT SUM(subTotal) AS subTotal FROM orders__payment INNER JOIN orders ON orders.id = orders__payment.oid WHERE orders.status = 4";
                $res = $con-> query($sql); $dt = $res->fetch_assoc(); $fm = $dt['subTotal'];
                $ordperc = round((($fm*100)/$mthord__total));
                echo '
                <div class="flex flex-col gap-05 margin-top-a">
                    <div class="flex flex-row flex-align-c flex-justify-con-sb">
                        <span class="small-med text-primary bold">Sikertelen tranzakciók</span>
                        <span class="small text-muted" id="fm"><script>document.getElementById("fm").textContent = (formatter.format('. $fm .'));</script></span>
                    </div>
                    <div class="flex flex-row gap-05">
                        <div class="flex flex-row border-soft background-bg w-fa">
                            <div class="flex flex-row padding-025 border-soft 
                            '; if ($ordperc > 50) { echo "loader-danger"; } if ($ordperc > 25 && $ordperc <= 50) { echo "loader-warning"; } if ($ordperc < 25) { echo "loader-success"; } echo '
                            " style="width: '. $ordperc .'%;"></div>
                        </div>
                    </div>
                </div>
                ';
            }
        ?>
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
                } else {
                    echo '
                        <div class="flex flex-col flex-align-c flex-justify-con-c text-muted user-select-none padding-1">
                            <svg width="128" height="128" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M11.2166 8.50002L10.5166 7.80007C10.1166 7.40007 10.1166 6.80005 10.5166 6.40005L13.4166 3.50002C15.5166 1.40002 18.9166 1.50005 20.8166 3.90005C22.5166 5.90005 22.2166 8.90007 20.3166 10.8001L17.5166 13.6C17.1166 14 16.5166 14 16.1166 13.6L15.4166 12.9C15.0166 12.5 15.0166 11.9 15.4166 11.5L18.3166 8.6C19.2166 7.7 19.1166 6.30002 18.0166 5.50002C17.2166 4.90002 16.0166 5.10007 15.3166 5.80007L12.4166 8.69997C12.2166 8.89997 11.6166 8.90002 11.2166 8.50002ZM11.2166 15.6L8.51659 18.3001C7.81659 19.0001 6.71658 19.2 5.81658 18.6C4.81658 17.9 4.71659 16.4 5.51659 15.5L8.31658 12.7C8.71658 12.3 8.71658 11.7001 8.31658 11.3001L7.6166 10.6C7.2166 10.2 6.6166 10.2 6.2166 10.6L3.6166 13.2C1.7166 15.1 1.4166 18.1 3.1166 20.1C5.0166 22.4 8.51659 22.5 10.5166 20.5L13.3166 17.7C13.7166 17.3 13.7166 16.7001 13.3166 16.3001L12.6166 15.6C12.3166 15.2 11.6166 15.2 11.2166 15.6Z" fill="currentColor"/><path opacity="0.3" d="M5.0166 9L2.81659 8.40002C2.31659 8.30002 2.0166 7.79995 2.1166 7.19995L2.31659 5.90002C2.41659 5.20002 3.21659 4.89995 3.81659 5.19995L6.0166 6.40002C6.4166 6.60002 6.6166 7.09998 6.5166 7.59998L6.31659 8.30005C6.11659 8.80005 5.5166 9.1 5.0166 9ZM8.41659 5.69995H8.6166C9.1166 5.69995 9.5166 5.30005 9.5166 4.80005L9.6166 3.09998C9.6166 2.49998 9.2166 2 8.5166 2H7.81659C7.21659 2 6.71659 2.59995 6.91659 3.19995L7.31659 4.90002C7.41659 5.40002 7.91659 5.69995 8.41659 5.69995ZM14.6166 18.2L15.1166 21.3C15.2166 21.8 15.7166 22.2 16.2166 22L17.6166 21.6C18.1166 21.4 18.4166 20.8 18.1166 20.3L16.7166 17.5C16.5166 17.1 16.1166 16.9 15.7166 17L15.2166 17.1C14.8166 17.3 14.5166 17.7 14.6166 18.2ZM18.4166 16.3L19.8166 17.2C20.2166 17.5 20.8166 17.3 21.0166 16.8L21.3166 15.9C21.5166 15.4 21.1166 14.8 20.5166 14.8H18.8166C18.0166 14.8 17.7166 15.9 18.4166 16.3Z" fill="currentColor"/></svg>
                            <span>Nincsen megjeleníthető adat.</span>
                        </div>
                    ';
                }
            ?>
        </div>
    </div>
    
</div>
<div class="flex flex-row flex-align-c gap-1">
    <div class="flex flex-row flex-justify-con-c flex-wrap-m gap-05 prio__con w-100">
        <?php
            $nus__sql = "SELECT * FROM orders WHERE 1";
            $nus__res = $con-> query($nus__sql); $ordersCount = $nus__res-> num_rows;
        ?>
        <div class="flex flex-col item-bg border-soft w-40 padding-05 gap-2">
            <div class="flex flex-col w-fa gap-05">
                <span class="larger text-primary bold">
                    <?php
                        $nus__sql = "SELECT * FROM orders WHERE status = 0";
                        $nus__res = $con-> query($nus__sql);
                        $cm__orders = $nus__res-> num_rows;
                        echo $nus__res-> num_rows; 
                    ?>
                </span>
                <div class="flex flex-col w-fa">
                    <span class="text-muted small-med">Összekészítés alatt</span>
                </div>
            </div>
            <div class="flex flex-col gap-05 margin-top-a">
                <div class="flex flex-row flex-align-c flex-justify-con-sb">
                    <span class="small-med text-primary bold">Összes rendelések: <span class="bold"><?= $ordersCount; ?></span></span>
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
        <div class="flex flex-col item-bg border-soft w-40 padding-05 gap-2">
            <div class="flex flex-col w-fa gap-05">
                <span class="larger text-primary bold">
                    <?php
                        $nus__sql = "SELECT * FROM orders WHERE status = 1";
                        $nus__res = $con-> query($nus__sql);
                        $cm__orders = $nus__res-> num_rows;
                        echo $nus__res-> num_rows; 
                    ?>
                </span>
                <div class="flex flex-col w-fa">
                    <span class="text-muted small-med">Kiszállítás alatt</span>
                </div>
            </div>
            <div class="flex flex-col gap-05 margin-top-a">
                <div class="flex flex-row flex-align-c flex-justify-con-sb">
                    <span class="small-med text-primary bold">Összes rendelések: <span class="bold"><?= $ordersCount; ?></span></span>
                    <span class="small text-muted"><?= $ordperc = round((($cm__orders * 100) / $ordersCount), 1); ?>%</span>
                </div>
                <div class="flex flex-row gap-05">
                    <div class="flex flex-row border-soft background-bg w-fa">
                        <div class="flex flex-row padding-025 border-soft 
                        <?php if ($ordperc > 50) { echo "loader-success"; } if ($ordperc > 25 && $ordperc <= 50) { echo "loader-warning"; } if ($ordperc < 25) { echo "loader-warning"; } ?>
                        " style="width: <?php echo $ordperc; ?>%;"></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="flex flex-col item-bg border-soft w-40 padding-05 gap-2">
            <div class="flex flex-col w-fa gap-05">
                <span class="larger text-primary bold">
                    <?php
                        $nus__sql = "SELECT * FROM orders WHERE status = 2";
                        $nus__res = $con-> query($nus__sql);
                        $cm__orders = $nus__res-> num_rows;
                        echo $nus__res-> num_rows; 
                    ?>
                </span>
                <div class="flex flex-col w-fa">
                    <span class="text-muted small-med">Kiszállítva</span>
                </div>
            </div>
            <div class="flex flex-col gap-05 margin-top-a">
                <div class="flex flex-row flex-align-c flex-justify-con-sb">
                    <span class="small-med text-primary bold">Összes rendelések: <span class="bold"><?= $ordersCount; ?></span></span>
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
        <div class="flex flex-col item-bg border-soft w-40 padding-05 gap-2">
            <div class="flex flex-col w-fa gap-05">
                <span class="larger text-primary bold">
                    <?php
                        $nus__sql = "SELECT * FROM orders WHERE status = 4";
                        $nus__res = $con-> query($nus__sql);
                        $cm__orders = $nus__res-> num_rows;
                        echo $nus__res-> num_rows; 
                    ?>
                </span>
                <div class="flex flex-col w-fa">
                    <span class="text-muted small-med">Sikertelen</span>
                </div>
            </div>
            <div class="flex flex-col gap-05 margin-top-a">
                <div class="flex flex-row flex-align-c flex-justify-con-sb">
                    <span class="small-med text-primary bold">Összes rendelések: <span class="bold"><?= $ordersCount; ?></span></span>
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
    </div>
</div>
<div class="flex flex-row flex-align-c flex-justify-con-c flex-wrap w-fa gap-1" id="home-os-con"></div>
<script>
    function __loadOrders (id, m, s = -1) {
        document.getElementById(id).innerHTML = `
            <div class="flex flex-row flex-align-c flex-justify-con-c flex-wrap w-fa gap-1" id="orders-con">
                <div class="flex flex-row w-fa overflow-x-scroll hide-scroll item-bg box-shadow border-soft">
                    <table class="sess__history text-muted text-align-c w-fa item-bg padding-05 table-padding-05 table-fixed compare-table text-align-c" style="border-collapse: collapse;" id="orders-table">
                        <tr class="small uppercase sessh__header" style="line-height: 2;">
                            <th>OID</th>
                            <th>Vásárló</th>
                            <th>Státusz</th>
                            <th>Összeg</th>
                            <th>Dátum</th>
                            <th></th>
                        </tr>
                    </table>
                </div>
            </div>
        `;
        var orderData = new FormData(); orderData.append("status", s);
        $.ajax({ enctype: "multipart/form-data", type: "POST", url: "/admin/orders/includes/getOrderByStatus.php", data: orderData, dataType: 'json', contentType: false, processData: false,
            beforeSend : function () {
                document.getElementById('orders-table').innerHTML += `
                    <tr class="sessh__body small" id="order-table-loader"><td></td><td></td>
                        <td>
                            <div class="flex flex-col flex-align-c flex-justify-con-c gap-1 small text-muted user-select-none w-fa">
                                <span><svg class='wizard_input_loading' xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="128" height="128" viewBox="0 0 24 24" version="1.1"><g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"><g><polygon points="0 0 24 0 24 24 0 24"/></g><path d="M12,4 L12,6 C8.6862915,6 6,8.6862915 6,12 C6,15.3137085 8.6862915,18 12,18 C15.3137085,18 18,15.3137085 18,12 C18,10.9603196 17.7360885,9.96126435 17.2402578,9.07513926 L18.9856052,8.09853149 C19.6473536,9.28117708 20,10.6161442 20,12 C20,16.418278 16.418278,20 12,20 C7.581722,20 4,16.418278 4,12 C4,7.581722 7.581722,4 12,4 Z" class="svg" fill-rule="nonzero" opacity="0.4" transform="translate(12.000000, 12.000000) scale(-1, 1) translate(-12.000000, -12.000000) "/></g></svg></span>
                                <span>Rendelések megjelenítése</span>
                            </div>
                        </td><td></td><td></td><td></td>
                    </tr>
                `;
            }, success : function (e) {
                document.getElementById('order-table-loader').remove();
                if (e.status == 'success') {
                    for (let i = 0; i < e.data.length; i++) {
                        document.getElementById('orders-table').innerHTML += `
                            <tr class="sessh__body small">
                                <td>${e.data[i].id}</td>
                                <td>${e.data[i].fullname}</td>
                                <td id="odts-${e.data[i].id}"></td>
                                <td>${formatter.format(e.data[i].subTotal)}</td>
                                <td>${e.data[i].date}</td>
                                <td><a data-link="${e.data[i].id}" class="op-od-mt label-primary pointer user-select-none smaller bold padding-025 border-soft-light">Megtekintés</a></td>
                            </tr>
                        `;
                        switch (e.data[i].status) {
                            case '0': document.getElementById('odts-'+e.data[i].id).innerHTML = `<span class="label-warning smaller bold padding-025 border-soft-light">Összekészítés</span>`; break;
                            case '1': document.getElementById('odts-'+e.data[i].id).innerHTML = `<span class="label-primary smaller bold padding-025 border-soft-light">Kiszállítás</span>`; break;
                            case '2': document.getElementById('odts-'+e.data[i].id).innerHTML = `<span class="label-success smaller bold padding-025 border-soft-light">Kiszállítva</span>`; break;
                            case '3': document.getElementById('odts-'+e.data[i].id).innerHTML = `<span class="label-warning smaller bold padding-025 border-soft-light">Befagyasztott</span>`; break;
                            case '4': document.getElementById('odts-'+e.data[i].id).innerHTML = `<span class="label-danger smaller bold padding-025 border-soft-light">Sikertelen</span>`; break;
                        }
                    }
                    var opd = document.getElementsByClassName('op-od-mt');
                    switch (m) {
                        case 'v': for (let i = 0; i < opd.length; i++) { opd[i].href = "/orders/v/" + opd[i].getAttribute('data-link'); } break;
                        case 'e': for (let i = 0; i < opd.length; i++) { opd[i].href = "/orders/e/" + opd[i].getAttribute('data-link'); } break;
                        default: for (let i = 0; i < opd.length; i++) { opd[i].href = "/orders/v/" + opd[i].getAttribute('data-link'); } break;
                    }
                } else {
                    document.getElementById('orders-table').innerHTML += `
                        <tr class="sessh__body small" id="order-table-loader"><td></td><td></td>
                            <td>
                                <div class="flex flex-col flex-align-c flex-justify-con-c gap-1 text-muted user-select-none w-fa">
                                    <svg width="128" height="128" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><rect opacity="0.3" x="2" y="2" width="20" height="20" rx="10" fill="currentColor"/><rect x="11" y="14" width="7" height="2" rx="1" transform="rotate(-90 11 14)" fill="currentColor"/><rect x="11" y="17" width="2" height="2" rx="1" transform="rotate(-90 11 17)" fill="currentColor"/></svg>
                                    <div class="flex flex-col flex-align-c flex-justify-con-c gap-025 w-fa">
                                        <strong>Sikertelen megjelenítés. Próbálja újra később.</strong>
                                    </div>
                                </div>
                            </td><td></td><td></td><td></td>
                        </tr>
                    `;
                }
            }, error : function (e) {
                document.getElementById('order-table-loader').remove();
                document.getElementById('orders-table').innerHTML += `
                    <tr class="sessh__body small" id="order-table-loader"><td></td><td></td>
                        <td>
                            <div class="flex flex-col flex-align-c flex-justify-con-c gap-1 text-muted user-select-none w-fa">
                                <svg width="128" height="128" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><rect opacity="0.3" x="2" y="2" width="20" height="20" rx="10" fill="currentColor"/><rect x="11" y="14" width="7" height="2" rx="1" transform="rotate(-90 11 14)" fill="currentColor"/><rect x="11" y="17" width="2" height="2" rx="1" transform="rotate(-90 11 17)" fill="currentColor"/></svg>
                                <div class="flex flex-col flex-align-c flex-justify-con-c gap-025 w-fa">
                                    <strong>Sikertelen megjelenítés. Próbálja újra később.</strong>
                                </div>
                            </div>
                        </td><td></td><td></td><td></td>
                    </tr>
                `;
            }
        });

        // var c__wrapper = document.createElement('div'); c__wrapper.classList = "wrapper_dark fadein"; var c__box = document.createElement('div'); c__box.classList = "d__confirm popup fixed flex flex-col border-soft item-bg box-shadow padding-1";
        // c__wrapper.classList.add('fadein'); c__wrapper.classList.remove('fadeout'); c__box.classList.add("padding-t-0"); c__box.classList.add('popup'); c__box.classList.remove('popout'); document.body.append(c__wrapper);  c__wrapper.append(c__box); $('html').css("overflow-y", "hidden");
        // c__box.innerHTML = `
        // <div class="flex flex-row flex-align-c flex-justify-con-sb padding-t-1" id="cbh__con">
        //     <span class="text-primary bold" id="prs__title"></span>
        //     <span class="flex text-primary pointer" aria-label="Bezárás" id="cl__box"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"><rect opacity="0.3" x="2" y="2" width="20" height="20" rx="5" fill="currentColor"/><rect x="7" y="15.3137" width="12" height="2" rx="1" transform="rotate(-45 7 15.3137)" fill="currentColor"/><rect x="8.41422" y="7" width="12" height="2" rx="1" transform="rotate(45 8.41422 7)" fill="currentColor"/></svg></span></div>
        // </div><br>
        // <div class="flex flex-col gap-1 feat__body prs__con" id="prs__con"></div><br>
        // <div class="flex flex-row flex-align-fe flex-justify-con-r gap-05"><span class="flex" id="prsb__con"></span>
        // `; var con = document.getElementById('cbh__con');var mc = new Hammer(con);mc.get('pan').set({ direction: Hammer.DIRECTION_ALL });mc.on("pandown", function(ev) { $('#cl__box').click(); });
        // $('#cl__box').click(function () { c__wrapper.classList.add('fadeout'); c__box.classList.add('popout'); setTimeout(() => { c__wrapper.remove(); $('html').css("overflow-y", "unset"); }, 200); });

    }
    __loadOrders('home-os-con', 'v');
</script>