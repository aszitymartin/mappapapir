<?php require_once($_SERVER['DOCUMENT_ROOT'].'/includes/inc.php'); require_once($_SERVER['DOCUMENT_ROOT'].'/assets/alph.php'); $uid = $_SESSION['id'];
if (!isset($_SESSION['loggedin'])) { header('Location: /'); }
$stmt = $con->prepare('SELECT privilege FROM customers__priv  WHERE uid = ?'); if (isset($_SESSION['loggedin'])) {$id = $_SESSION['id'];} $stmt->bind_param('i', $id);$stmt->execute(); $stmt->bind_result($privilege); $stmt->fetch();$stmt->close();
if ($privilege !== 2) { header('Location: /'); }
function get_time_ago( $time ) {
    $time_difference = time() - $time;
    if( $time_difference < 1 ) { return '< 1mp'; }
    $condition = array( 12 * 30 * 24 * 60 * 60 =>  'éve',30 * 24 * 60 * 60 => 'hónapja',24 * 60 * 60 => 'napja',60 * 60 =>  'órája',60 =>  'perce',1 =>  'másodperce');
    foreach( $condition as $secs => $str ) {$d = $time_difference / $secs;if( $d >= 1 ) {$t = round( $d );return $t . ' ' . $str . ( $t > 1 ? '' : '' ) . '';}}
}
?>
<div class="flex flex-col gap-1">
    <?php $dsql = "SELECT * FROM def__page"; $dres = $con->query($dsql); $ddt = $dres->fetch_assoc(); ?>
    <div class="flex flex-col w-fa gap-1 border-soft item-bg box-shadow padding-1">
        <div class="flex flex-row flex-align-c flex-justify-con-sb">
            <span class="text-primary large bold">Alap beállítások</span>
            <span class="primary-bg primary-bg-hover border-soft-light padding-025 small pointer">Mentés</span>
        </div><hr style="border: 1px solid var(--background);" class="w-100">
        <div class="flex flex-col flex-align-c flex-justify-con-c gap-1 padding-1">
            <div class="flex flex-col gap-1 w-fa">
                <span class="text-primary bold">Oldal neve</span>
                <input type="text" value="<?= $ddt['title']; ?>" class="w-fa text-primary border-soft background-bg padding-1-05 outline-none border-none" placeholder="Oldal neve" autocomplete="off">
            </div>
            <div class="flex flex-col gap-1 w-fa">
                <span class="text-primary bold">Oldal leírása</span>
                <input type="text" value="<?= $ddt['description']; ?>" class="w-fa text-primary border-soft background-bg padding-1-05 outline-none border-none" placeholder="Oldal leírása" autocomplete="off">
            </div>
            <div class="flex flex-col gap-1 w-fa">
                <span class="text-primary bold">Webmester</span>
                <input type="text" value="<?= $ddt['webmester']; ?>" class="w-fa text-primary border-soft background-bg padding-1-05 outline-none border-none" placeholder="Webmester" autocomplete="off">
            </div>
            <div class="flex flex-col gap-1 w-fa">
                <span class="text-primary bold">Webmester elérhetőségei</span>
                <input type="email" value="<?= $ddt['email']; ?>" class="w-fa text-primary border-soft background-bg padding-1-05 outline-none border-none" placeholder="Webmester elérhetőségei" autocomplete="off">
            </div>
            <?php
                $ma = explode(";", $ddt['meta']);
                for ($i = 0; $i < count($ma); $i++) {
                    echo '
                    <div class="flex flex-col gap-1 w-fa">
                        <span class="text-primary bold">'. explode("=",$ma[$i])[0] .'</span>
                        <input type="text" value="'. explode("=",$ma[$i])[1] .'" class="w-fa text-primary border-soft background-bg padding-1-05 outline-none border-none" autocomplete="off">
                    </div>  
                    ';
                    // echo explode("=",$ma[$i])[0] . ' - ' . explode("=",$ma[$i])[1] . '<br>';
                }
            ?>
            <h4 class="text-primary">Tobbi meta tag eltavolitasa</h4>
            <div class="flex flex-col gap-1 w-fa">
                <span class="text-primary bold">Oldal ikonja</span>
                <div class="flex flex-row gap-1 w-fa">
                    <div class="flex flex-row gap-1" id="miniatures-con"></div>
                    <div id="min-upl-con">
                        <div id="miniature-uploader" class="flex flex-row-d-col-m flex-align-c flex-justify-con-c border-soft border-secondary-dotted background-bg background-bg-hover text-primary padding-1 user-select-none w-fc pointer miniature-fixed" onclick="__inituploader()">
                            <div class="flex flex-row-d-col-m flex-align-c gap-1">
                                <div class="flex flex-row flex-align-c gap-1">
                                    <div class="flex flex-col flex-align-c flex-justify-con-c">
                                        <svg width="48" height="48" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M3 13V11C3 10.4 3.4 10 4 10H20C20.6 10 21 10.4 21 11V13C21 13.6 20.6 14 20 14H4C3.4 14 3 13.6 3 13Z" fill="currentColor"></path><path d="M13 21H11C10.4 21 10 20.6 10 20V4C10 3.4 10.4 3 11 3H13C13.6 3 14 3.4 14 4V20C14 20.6 13.6 21 13 21Z" fill="currentColor"></path></svg>
                                        <span class="text-muted small-med w-fa text-align-c">Hozzáadás</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="flex flex-col gap-1">
    <?php $sql = "SELECT def__news.*, def__news__status.status, customers.fullname FROM def__news INNER JOIN def__news__status ON def__news__status.nid = def__news.id INNER JOIN customers ON customers.id = def__news.uid";$res = $con->query($sql); ?>
    <div class="flex flex-col w-fa gap-1 border-soft item-bg box-shadow padding-1">
        <div class="flex flex-row flex-align-c flex-justify-con-sb">
            <span class="text-primary large bold">Kiemelt Hírek <em>(<?= $res->num_rows; ?>)</em></span>
            <span class="primary-bg primary-bg-hover border-soft-light padding-025 small pointer">Hozzáadás</span>
        </div><hr style="border: 1px solid var(--background);" class="w-100">
        <div class="flex flex-col flex-align-c flex-justify-con-c gap-1">
            <?php
                if ($res->num_rows > 0) {
                    while ($dt = $res->fetch_assoc()) {
                        echo '
                        <div class="flex flex-row-d-col-m gap-1 w-fa">
                            <div class="flex flex-row flex-align-c flex-justify-con-c w-30d-100m">
                                <div class="flex flex-col flex-align-c flex-justify-con-c w-fa relative">
                                    <div class="news_container flex flex-col flex-align-c relative flex flex-col flex-align-c relative w-fa border-soft" id="main_news_no_'.$dt['id'].'" style="background-image: url(&quot;/assets/images/news/'.$dt['image'].'&quot;); height: 6rem !important;"></div>
                                </div>
                            </div>
                            <div class="flex flex-col w-70d-100m gap-1">
                                <div class="flex flex-col gap-025 w-fa">
                                    <div class="flex flex-row flex-align-c flex-justify-con-sb w-fa gap-1">
                                        <div class="flex flex-row flex-align-c gap-1">
                                            <span class="text-primary bold">'.$dt['title'].'</span>
                                            ';
                                                switch ($dt['status']) {
                                                    case 1: echo '<span class="primary-bg border-soft-light padding-025 small-med">Aktív</span>'; break;
                                                    case 0: echo '<span class="warning-bg border-soft-light padding-025 small-med">Inaktív</span>'; break;
                                                }
                                            echo '
                                        </div>
                                        <span class="flex flex-col flex-align-c padding-025 text-muted text-primary-hover border-soft pointer">
                                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path opacity="0.3" fill-rule="evenodd" clip-rule="evenodd" d="M2 4.63158C2 3.1782 3.1782 2 4.63158 2H13.47C14.0155 2 14.278 2.66919 13.8778 3.04006L12.4556 4.35821C11.9009 4.87228 11.1726 5.15789 10.4163 5.15789H7.1579C6.05333 5.15789 5.15789 6.05333 5.15789 7.1579V16.8421C5.15789 17.9467 6.05333 18.8421 7.1579 18.8421H16.8421C17.9467 18.8421 18.8421 17.9467 18.8421 16.8421V13.7518C18.8421 12.927 19.1817 12.1387 19.7809 11.572L20.9878 10.4308C21.3703 10.0691 22 10.3403 22 10.8668V19.3684C22 20.8218 20.8218 22 19.3684 22H4.63158C3.1782 22 2 20.8218 2 19.3684V4.63158Z" fill="currentColor"/><path d="M10.9256 11.1882C10.5351 10.7977 10.5351 10.1645 10.9256 9.77397L18.0669 2.6327C18.8479 1.85165 20.1143 1.85165 20.8953 2.6327L21.3665 3.10391C22.1476 3.88496 22.1476 5.15129 21.3665 5.93234L14.2252 13.0736C13.8347 13.4641 13.2016 13.4641 12.811 13.0736L10.9256 11.1882Z" fill="currentColor"/><path d="M8.82343 12.0064L8.08852 14.3348C7.8655 15.0414 8.46151 15.7366 9.19388 15.6242L11.8974 15.2092C12.4642 15.1222 12.6916 14.4278 12.2861 14.0223L9.98595 11.7221C9.61452 11.3507 8.98154 11.5055 8.82343 12.0064Z" fill="currentColor"/></svg>
                                        </span>
                                    </div>
                                    <div class="flex flex-row flex-align-c gap-1 text-muted small-med user-select-none">
                                        <span>'. $dt['fullname'] .'</span>
                                        <span>·</span>
                                        <span>'. get_time_ago(strtotime($dt['date'])) .'</span>
                                    </div>
                                </div>
                                <span class="text-primary small">'.$dt['description'].'</span>
                            </div>
                        </div>
                        ';
                    }
                } else {
                    echo '
                        <div class="flex flex-col flex-align-c flex-justify-con-c w-fa text-muted user-select-none">
                            <svg width="128" height="128" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path opacity="0.3" d="M19 22H5C4.4 22 4 21.6 4 21V3C4 2.4 4.4 2 5 2H14L20 8V21C20 21.6 19.6 22 19 22ZM12.5 18C12.5 17.4 12.6 17.5 12 17.5H8.5C7.9 17.5 8 17.4 8 18C8 18.6 7.9 18.5 8.5 18.5L12 18C12.6 18 12.5 18.6 12.5 18ZM16.5 13C16.5 12.4 16.6 12.5 16 12.5H8.5C7.9 12.5 8 12.4 8 13C8 13.6 7.9 13.5 8.5 13.5H15.5C16.1 13.5 16.5 13.6 16.5 13ZM12.5 8C12.5 7.4 12.6 7.5 12 7.5H8C7.4 7.5 7.5 7.4 7.5 8C7.5 8.6 7.4 8.5 8 8.5H12C12.6 8.5 12.5 8.6 12.5 8Z" fill="currentColor"/><rect x="7" y="17" width="6" height="2" rx="1" fill="currentColor"/><rect x="7" y="12" width="10" height="2" rx="1" fill="currentColor"/><rect x="7" y="7" width="6" height="2" rx="1" fill="currentColor"/><path d="M15 8H20L14 2V7C14 7.6 14.4 8 15 8Z" fill="currentColor"/></svg>
                            <span class="text-align-c w-60 small">Nincsenek megjeleníthető hírek az oldalon. A hozzáadott hírek itt fognak megjelenni, amelyeket tud majd szerkeszteni.</span>
                        </div>
                    ';
                }
            ?>
        </div>
    </div>
</div>
<div class="flex flex-col gap-1">
    <div class="flex flex-col w-fa gap-1 border-soft item-bg box-shadow padding-1">
        <div class="flex flex-row flex-align-c flex-justify-con-sb">
            <span class="text-primary large bold">Fejléc linkek</span>
            <span class="primary-bg primary-bg-hover border-soft-light padding-025 small pointer">Mentés</span>
        </div>
        <div class="flex flex-col flex-align-c flex-justify-con-c gap-1">
            <div class="flex flex-row gap-1 w-fa">
                <div></div>
            </div>
        </div>
    </div>
</div>
<div class="flex flex-col gap-1">
    <div class="flex flex-col w-fa gap-1 border-soft item-bg box-shadow padding-1">
        <div class="flex flex-row flex-align-c flex-justify-con-sb">
            <span class="text-primary large bold">Menü jelvények</span>
            <span class="primary-bg primary-bg-hover border-soft-light padding-025 small pointer">Mentés</span>
        </div>
        <div class="flex flex-col flex-align-c flex-justify-con-c gap-1">
            <div class="flex flex-row gap-1 w-fa">
                <div></div>
            </div>
        </div>
    </div>
</div>
<script>
    $('#add-variations').click(() => { varcount++;
        var cstitem = document.createElement('div'); cstitem.id = "cst-vrs-itm-"+varcount; cstitem.classList = "flex flex-col gap-1";
        document.getElementById('cst-vrs-con').append(cstitem);
        document.getElementById('cst-vrs-itm-'+varcount).innerHTML = `
        <div class="flex flex-row gap-05 w-fa cst-var-con" id="cst-var-${varcount}">
            <div class="flex flex-col w-30 gap-025">
                <input type="text" id="var-name-${varcount}" class='cst-var-name adm__input w-fa border-soft cst-drp-fts item-bg outline-none text-secondary' placeholder='Variáció'>
            </div>
            <div class="flex flex-row w-70 gap-05">
                <input type="text" id="var-val-${varcount}" class='cst-var-val adm__input outline-none w-fa border-soft item-bg text-primary' placeholder='Variáció kiválasztása'>
                <span class="flex flex-col flex-align-c flex-justify-con-c danger-bg danger-bg-hover border-soft small pointer" style="padding: .65rem;" aria-label="Eltávolítás" role="button" title="Eltávolítás" onclick="__removevariation(${varcount})">
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M6.7 19.4L5.3 18C4.9 17.6 4.9 17 5.3 16.6L16.6 5.3C17 4.9 17.6 4.9 18 5.3L19.4 6.7C19.8 7.1 19.8 7.7 19.4 8.1L8.1 19.4C7.8 19.8 7.1 19.8 6.7 19.4Z" fill="currentColor"/><path d="M19.5 18L18.1 19.4C17.7 19.8 17.1 19.8 16.7 19.4L5.40001 8.1C5.00001 7.7 5.00001 7.1 5.40001 6.7L6.80001 5.3C7.20001 4.9 7.80001 4.9 8.20001 5.3L19.5 16.6C19.9 16.9 19.9 17.6 19.5 18Z" fill="currentColor"/></svg>
                </span>
            </div>
        </div>
        `;
    });
    function __removevariation (index) { document.getElementById('cst-vrs-itm-'+index).remove(); }
</script>