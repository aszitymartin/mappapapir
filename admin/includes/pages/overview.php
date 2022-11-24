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
                <span class="text-muted small-med">Legújabb eladások</span>
            </div>
            <div class="flex flex-col gap-05 margin-top-a">
                <div class="flex flex-row gap-05">
                    <div class="flex flex-row flex-wrap-no" id="dailysales__chart__con">
                        <canvas id="dailysales__chart" width="150" height="80px"></canvas>
                        <script id="dlysls__script">
                            var recentchart = document.getElementById('dailysales__chart');
                            var footer = (tooltipItems) => { let sum = 0; tooltipItems.forEach(function(tooltipItem) { sum += tooltipItem.parsed.y; }); return 'Eladva: ' + sum; };
                            var rcChart = new Chart(recentchart, { type: 'bar',
                                data: {
                                    labels: [
                                        <?php $dly__sql = "SELECT SUM(quantity) AS qty, DATE(date) AS date FROM `orders` WHERE 1 GROUP BY DATE(date) ORDER BY DATE(date) ASC LIMIT 7"; $dly__res = $con-> query($dly__sql);
                                        if ($dly__res-> num_rows > 0) { while ($data = $dly__res-> fetch_assoc()) { echo "'".$data['date']."',"; } } ?>
                                    ],
                                    datasets: [{
                                        data: [
                                            <?php $dly__sql = "SELECT SUM(quantity) AS qty FROM `orders` WHERE 1 GROUP BY DATE(date) ORDER BY DATE(date) ASC LIMIT 7"; $dly__res = $con-> query($dly__sql);
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
                <?php $nus__sql = "SELECT * FROM orders WHERE DATE_FORMAT(CURDATE(), '%m') = MONTH(date);"; $nus__res = $con-> query($nus__sql); if ($nus__res-> num_rows > 0) { while ($data = $nus__res-> fetch_assoc()) {$monthly__earn += $data['subtotal'];} } else { $monthly__earn = 0; } ?>
                <span class="larger text-primary bold" id="mnth__earn"></span>
                <script>document.getElementById('mnth__earn').textContent = formatter.format(<?php echo $monthly__earn; ?>);</script>
                <span class="text-muted small-med">Havi bevétel</span>
            </div>
            <div class="flex flex-col gap-05 margin-top-a w-fa">
                <div class="flex flex-row gap-05 w-fa">
                    <div class="flex flex-row flex-wrap-no flex-align-c flex-justify-con-sb gap-025 w-fa">
                        <?php
                            if ($nus__res-> num_rows > 0) {
                                echo '
                                <div class="flex flex-col"><canvas id="monthlyearn__chart" width="50" height="50"></canvas></div>
                                <div class="flex flex-col gap-05 w-100">
                                    <div class="flex flex-row flex-align-c flex-justify-con-sb w-100">
                                        ';
                                        $sql = "SELECT name, SUM(subtotal) AS sumtotal FROM orders INNER JOIN products ON products.id = orders.pid WHERE DATE_FORMAT(CURDATE(), '%m') = MONTH(orders.date) GROUP BY name ORDER BY sumtotal DESC LIMIT 1"; $res = $con-> query($sql); $data = $res-> fetch_assoc();
                                        echo '
                                        <div class="flex flex-row flex-align-c gap-05">
                                            <span class="chart__ind chart__ind__red"></span>
                                            <span class="text-muted bold smaller">'. $data["name"] .'</span>
                                        </div>
                                        <div class="flex flex-row flex-align-c">
                                            <span class="text-primary smaller bold money__form" default-data="'.$data['sumtotal'].'"></span>
                                        </div>
                                    </div>';
                                    $sql = "SELECT name, SUM(subtotal) AS sumtotal FROM orders INNER JOIN products ON products.id = orders.pid WHERE DATE_FORMAT(CURDATE(), '%m') = MONTH(orders.date) GROUP BY name ORDER BY sumtotal DESC LIMIT 1 OFFSET 1"; $res = $con-> query($sql); $data = $res-> fetch_assoc();
                                    if ($res-> num_rows > 0) {
                                        echo '
                                        <div class="flex flex-row flex-align-c flex-justify-con-sb w-100">
                                            <div class="flex flex-row flex-align-c gap-05">
                                                <span class="chart__ind chart__ind__blue"></span>
                                                <span class="text-muted bold smaller">'. $data['name'] .'</span>
                                            </div>
                                            <div class="flex flex-row flex-align-c">
                                                <span class="text-primary smaller bold money__form" default-data="'. $data['sumtotal'] .'"></span>
                                            </div>
                                        </div>
                                        ';
                                    }
                                    $sql = "SELECT name, SUM(subtotal) AS sumtotal FROM orders INNER JOIN products ON products.id = orders.pid WHERE DATE_FORMAT(CURDATE(), '%m') = MONTH(orders.date) GROUP BY name ORDER BY sumtotal DESC LIMIT 1 OFFSET 2;"; $res = $con-> query($sql); $data = $res-> fetch_assoc();
                                    if ($res-> num_rows > 0) {
                                        echo '
                                        <div class="flex flex-row flex-align-c flex-justify-con-sb w-100">
                                            <div class="flex flex-row flex-align-c gap-05">
                                                <span class="chart__ind chart__ind__gray"></span>
                                                <span class="text-muted bold smaller">'. $data['name'] .'</span>
                                            </div>
                                            <div class="flex flex-row flex-align-c">
                                                <span class="text-primary smaller bold money__form" default-data="'. $data['sumtotal'] .'></span>
                                            </div>
                                        </div>
                                        ';
                                    }
                                    echo '
                                </div>
                                <script id="monthlyearn__script">
                                    var mte = document.getElementById("monthlyearn__chart");
                                    var mteChart = new Chart(mte, { type: "doughnut",
                                        data: {
                                            labels: [
                                                '; $sql = "SELECT name, SUM(subtotal) AS sumtotal FROM orders INNER JOIN products ON products.id = orders.pid WHERE DATE_FORMAT(CURDATE(), '%m') = MONTH(orders.date) GROUP BY name ORDER BY sumtotal DESC LIMIT 3;";$res = $con-> query($sql); 
                                                while ($data = $res-> fetch_assoc()) { echo "'".$data['name']."',"; } echo '
                                            ],
                                            datasets: [{
                                                data: [
                                                    '; $sql = "SELECT name, SUM(subtotal) AS sumtotal FROM orders INNER JOIN products ON products.id = orders.pid WHERE DATE_FORMAT(CURDATE(), '%m') = MONTH(orders.date) GROUP BY name ORDER BY sumtotal DESC LIMIT 3";$res = $con-> query($sql); 
                                                    while ($data = $res-> fetch_assoc()) { echo "'".$data['sumtotal']."',"; } echo '
                                                ], borderColor: "transparent",
                                                backgroundColor: ["rgb(241, 65, 108)", "rgb(0, 158, 247)", "rgb(181 181 195)"], hoverOffset: 2, borderRadius: 50, maxBarThickness: 10
                                            }]
                                        }, options: { plugins: { legend: { display: false }, tooltip: { enabled: false } }, scales: { x: { display: false, }, y: { display: false, } } }
                                    });
                                    document.getElementById("lastsvnsales__ind").textContent = '. $lastsevenqty .';
                                </script>
                                ';
                            } else { echo "<span class='text-muted small-med'>Nincs megjeleníthető adat</span>"; }                            
                        ?>
                    </div>
                </div>
            </div>
        </div>
        <div class="flex flex-col item-bg border-soft w-40 padding-05 gap-2">
            <div class="flex flex-col w-fa gap-05">
                <span class="larger text-primary bold">
                    <?php $nus__sql = "SELECT * FROM orders WHERE DATE_FORMAT(CURDATE(), '%m') = MONTH(date);"; $nus__res = $con-> query($nus__sql); echo $nus__res-> num_rows; $cm__orders = $nus__res-> num_rows; ?>
                </span>
                <span class="text-muted small-med">Rendelések a hónapban</span>
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
    <div class="flex flex-col w-50d-fam gap-1 border-soft item-bg box-shadow padding-0">
        <div class="flex flex-row flex-align-c flex-justify-con-sb padding-1">
            <span class="text-primary small bold">Havi rendelések</span>
        </div>
        <div class="flex flex-col gap-2 prio__con">
            <div class="flex flex-col padding-1">
                <div class="flex flex-row flex-align-c gap-05">
                    <?php $monthord__sql = "SELECT SUM(subtotal) AS subtotal, DAY(date) AS date FROM `orders` WHERE MONTH(CURRENT_DATE) = MONTH(date) GROUP BY DAY(date)"; $monthord__res = $con-> query($monthord__sql); if ($monthord__res-> num_rows > 0) { $mth__arr = array(); while($data = $monthord__res-> fetch_assoc()) { array_push($mth__arr, [$data['date'],date('F'),$data['subtotal']]); $mthord__total += $data['subtotal']; } } else { $mthord__total = 0; } ?>
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
                    <canvas id='monthlyorder__chart' width='' height='150' style='margin: -1.1%; cursor: crosshair;'></canvas>
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
    <?php
        $top__sql = "SELECT `id` FROM `products` WHERE `id` = ( SELECT `pid` FROM `orders` GROUP BY `pid` ORDER BY SUM(`quantity`) DESC LIMIT 1 );";
        $top__res = $con-> query($top__sql); 
        if ($top__res-> num_rows > 0) { $data = $top__res-> fetch_assoc(); $top__id = $data['id'];
            $top__sql = "SELECT products.id, products.name, products.thumbnail, products__variations.color, products__variations.brand, products__inventory.unit FROM `products` INNER JOIN products__variations ON products__variations.pid = products.id INNER JOIN products__inventory ON products__inventory.pid = products.id WHERE products.id = $top__id"; $top__res = $con-> query($top__sql);
            if ($top__res-> num_rows > 0) { $data = $top__res-> fetch_assoc(); $topitem__sql = "SELECT SUM(`quantity`) AS quantity FROM orders WHERE pid = $top__id"; $topitem__res = $con-> query($topitem__sql); $topitem__data = $topitem__res-> fetch_assoc(); $topitem__quantity = $topitem__data['quantity'];
                echo '
                <div class="flex flex-col w-50d-fam gap-1 border-soft item-bg box-shadow padding-1 dom__color" id="dom__color'.$data['id'].'">
                    <div id="nwst__info'.$data['id'].'">
                        <div class="flex flex-row flex-align-c flex-justify-con-sb">
                            <span class="small bold">Legkelendőbb termék</span>
                        </div>
                        <div class="flex flex-col flex-align-c">
                            <div class="flex flex-col flex-aling-c flex-justify-con-c">
                                <img id="nwpr__img'.$data['id'].'" class="drop-shadow" style="width: 10rem;" src="/assets/images/uploads/'.$data['thumbnail'].'">
                            </div>
                            <div class="flex flex-col flex-align-c flex-justify-con-c w-fa">
                                <span class="small bold">'.$data['brand'].' '.$data['name'].' - '.$data['color'].'</span>
                                <span class="smaller-light">Összesen <b>'.$topitem__quantity.'</b> '.$data['unit'].'. lett eladva ebből a termékből.</span>
                            </div>
                        </div>
                    </div>
                </div>
                <script content-type="application/javascript">
                    var mpnwplink = document.getElementById("nwpr__link'.$data['id'].'");
                    function addImage(file) { var img = document.getElementById("nwpr__img'.$data['id'].'"); img.src = file; img.onload = function() { var rgb = getAverageColor(img); var rgbStr = "rgb(" + rgb.r + ", " + rgb.g + ", " + rgb.b + ")"; var hsl = rgbToHsl(rgb.r, rgb.g, rgb.b); var hslStr = "hsl(" + Math.round(hsl.h * 360) + ", " + Math.round(hsl.s * 100) + "%, " + Math.round(hsl.l * 100) + "%)"; var hexStr = "#" + ("0"+rgb.r.toString(16)).slice(-2) + ("0"+rgb.g.toString(16)).slice(-2) + ("0"+rgb.b.toString(16)).slice(-2); $("#dom__color'.$data['id'].'").css("background-color", rgbStr); document.getElementById("nwst__info'.$data['id'].'").style.color = "#"+contrastingColor(hexStr.replace("#", "")); var bdgcp = document.getElementsByClassName("button-dgcp"); for (let i = 0; i < bdgcp.length; i++) { bdgcp[i].style.border = "1px solid #"+contrastingColor(hexStr.replace("#", "")); } }; }
                    function getAverageColor(img) { var canvas = document.createElement("canvas"); if(!ctx) { var ctx = canvas.getContext("2d"); }var width = canvas.width = img.naturalWidth;var height = canvas.height = img.naturalHeight; ctx.drawImage(img, 0, 0); var imageData = ctx.getImageData(0, 0, width, height); var data = imageData.data;
                    var r = 0;var g = 0;var b = 0; for (var i = 0, l = data.length; i < l; i += 4) { r += data[i]; g += data[i+1]; b += data[i+2]; } r = Math.floor(r / (data.length / 4)); g = Math.floor(g / (data.length / 4)); b = Math.floor(b / (data.length / 4)); return { r: r, g: g, b: b }; }
                    function handleImages(files) {addImage(files); } handleImages($("#nwpr__img'.$data['id'].'").attr("src")); function rgbToHsl(r, g, b) { r /= 255; g /= 255; b /= 255;var max = Math.max(r, g, b), min = Math.min(r, g, b);var h, s, l = (max + min) / 2;if (max == min) {h = s = 0;} else {var d = max - min;s = l > 0.5 ? d / (2 - max - min) : d / (max + min);switch (max) {case r: h = (g - b) / d + (g < b ? 6 : 0); break;case g: h = (b - r) / d + 2; break;case b: h = (r - g) / d + 4; break;}h /= 6;} return { h: h, s: s, l: l }; }

                    function contrastingColor(color) { return (luma(color) >= 165) ? "000" : "fff"; }
                    function luma(color) { var rgb = (typeof color === "string") ? hexToRGBArray(color) : color; return (0.2126 * rgb[0]) + (0.7152 * rgb[1]) + (0.0722 * rgb[2]); }
                    function hexToRGBArray(color) { if (color.length === 3) { color = color.charAt(0) + color.charAt(0) + color.charAt(1) + color.charAt(1) + color.charAt(2) + color.charAt(2); }
                    else if (color.length !== 6) { throw("Invalid hex color: " + color); } var rgb = []; for (var i = 0; i <= 2; i++) { rgb[i] = parseInt(color.substr(i * 2, 2), 16); } return rgb; }
                </script>
                ';
            }
        } else { echo 'asd'; }
    ?>
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