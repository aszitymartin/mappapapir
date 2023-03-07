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
<h3 class="text-primary">/admin/includes/pages/default.php</h3>
<script src="/assets/script/quill/dist/quill.js"></script>
<div class="flex flex-col gap-1">
    <?php $dsql = "SELECT * FROM def__page"; $dres = $con->query($dsql); $ddt = $dres->fetch_assoc(); ?>
    <div class="flex flex-col w-fa gap-1 border-soft item-bg box-shadow padding-1">
        <div class="flex flex-row flex-align-c flex-justify-con-sb">
            <span class="text-primary large bold">Alap beállítások</span>
            <span class="primary-bg primary-bg-hover border-soft-light padding-05 small pointer">Mentés</span>
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
                <span class="text-primary bold">Oldal ikonja</span>
                <div class="flex flex-row gap-1 w-fa">
                <?php $iurl = "'/assets/icons/". $ddt['icon'] ."'"; ?>
                    <div class="flex flex-col flex-align-c gap-025 text-primary small-med">
                        <div style="background-image: url(<?= $iurl; ?>); background-size: cover; background-repeat: no-repeat;" class="flex flex-row-d-col-m flex-align-c flex-justify-con-c border-soft border-secondary-dotted background-bg background-bg-hover text-primary padding-1 user-select-none w-fc pointer miniature-fixed"></div>
                        <em>Jelenlegi</em>
                    </div>
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
    <?php $dsql = "SELECT * FROM def__page"; $dres = $con->query($dsql); $ddt = $dres->fetch_assoc(); ?>
    <div class="flex flex-col w-fa gap-1 border-soft item-bg box-shadow padding-1">
        <div class="flex flex-row flex-align-c flex-justify-con-sb">
            <span class="text-primary large bold">Webmester</span>
            <span class="primary-bg primary-bg-hover border-soft-light padding-05 small pointer">Mentés</span>
        </div><hr style="border: 1px solid var(--background);" class="w-100">
        <div class="flex flex-col flex-align-c flex-justify-con-c gap-1 padding-1">
            <div class="flex flex-col gap-1 w-fa">
                <span class="text-primary bold">Megnevezés</span>
                <input type="text" value="<?= $ddt['webmester']; ?>" class="w-fa text-primary border-soft background-bg padding-1-05 outline-none border-none" placeholder="Webmester" autocomplete="off">
            </div>
            <div class="flex flex-col gap-1 w-fa">
                <span class="text-primary bold">Elérhetőség</span>
                <input type="email" value="<?= $ddt['email']; ?>" class="w-fa text-primary border-soft background-bg padding-1-05 outline-none border-none" placeholder="Webmester elérhetőségei" autocomplete="off">
            </div>
        </div>
    </div>
</div>
<div class="flex flex-col gap-1">
    <?php $dsql = "SELECT * FROM def__page"; $dres = $con->query($dsql); $ddt = $dres->fetch_assoc(); ?>
    <div class="flex flex-col w-fa gap-1 border-soft item-bg box-shadow padding-1">
        <div class="flex flex-row flex-align-c flex-justify-con-sb">
            <span class="text-primary large bold">Meta tagok</span>
            <span class="primary-bg primary-bg-hover border-soft-light padding-05 small pointer">Mentés</span>
        </div><hr style="border: 1px solid var(--background);" class="w-100">
        <div class="flex flex-col flex-align-c flex-justify-con-c gap-1 padding-1 w-fa">
            <div class="flex flex-col flex-align-c flex-justify-con-c gap-1 w-fa" id="mt-it-con">
            <?php $ma = explode(";", $ddt['meta']);
                for ($i = 0; $i < count($ma); $i++) {
                    echo '
                    <div class="flex flex-col gap-1 w-fa mt-it-sl" id="meta-cons-item-'.$i.'">
                        <div class="flex flex-row gap-05 w-fa cst-var-con">
                            <div class="flex flex-col w-30 gap-025">
                                <input type="text" value="'. explode("=",$ma[$i])[0] .'" class="cst-var-name adm__input w-fa border-soft cst-drp-fts item-bg outline-none text-primary" placeholder="Meta tag neve">
                            </div>
                            <div class="flex flex-row w-70 gap-05">
                                <input type="text" value="'. explode("=",$ma[$i])[1] .'" id="met-val-'.$i.'" class="cst-var-val adm__input outline-none w-fa border-soft item-bg text-primary" placeholder="Meta tag adatai">
                                <span class="flex flex-col flex-align-c flex-justify-con-c danger-bg danger-bg-hover border-soft small pointer" style="padding: .65rem;" aria-label="Eltávolítás" role="button" title="Eltávolítás" onclick="__removemeta('. $i .')">
                                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M6.7 19.4L5.3 18C4.9 17.6 4.9 17 5.3 16.6L16.6 5.3C17 4.9 17.6 4.9 18 5.3L19.4 6.7C19.8 7.1 19.8 7.7 19.4 8.1L8.1 19.4C7.8 19.8 7.1 19.8 6.7 19.4Z" fill="currentColor"></path><path d="M19.5 18L18.1 19.4C17.7 19.8 17.1 19.8 16.7 19.4L5.40001 8.1C5.00001 7.7 5.00001 7.1 5.40001 6.7L6.80001 5.3C7.20001 4.9 7.80001 4.9 8.20001 5.3L19.5 16.6C19.9 16.9 19.9 17.6 19.5 18Z" fill="currentColor"></path></svg>
                                </span>
                            </div>
                        </div>
                    </div>
                    ';
                }
            ?>
            </div>
            <div class="flex flex-col w-fa gap-1" id="meta-cons"></div>
            <div class="flex flex-row w-fa">
                <span id="add-meta" class="primary-bg primary-bg-hover border-soft pointer user-select-none small w-fc" style="padding: .65rem;">Meta hozzáadása</span>
            </div>
        </div>
    </div>
</div>
<div class="flex flex-col gap-1">
    <?php $sql = "SELECT def__news.*, def__news__status.status, customers.fullname FROM def__news INNER JOIN def__news__status ON def__news__status.nid = def__news.id INNER JOIN customers ON customers.id = def__news.uid";$res = $con->query($sql); ?>
    <div class="flex flex-col w-fa gap-1 border-soft item-bg box-shadow padding-1">
        <div class="flex flex-row flex-align-c flex-justify-con-sb">
            <span class="text-primary large bold">Kiemelt Hírek <em>(<?= $res->num_rows; ?>)</em></span>
            <span class="primary-bg primary-bg-hover border-soft-light padding-05 small pointer">Hozzáadás</span>
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
                                        <div class="flex flex-row flex-align-c gap-05">
                                            <span class="flex flex-col flex-align-c padding-025 text-muted text-primary-hover border-soft pointer" title="Eltávolítás" onclick="__deletenews('.$dt['id'].');">
                                                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M5 9C5 8.44772 5.44772 8 6 8H18C18.5523 8 19 8.44772 19 9V18C19 19.6569 17.6569 21 16 21H8C6.34315 21 5 19.6569 5 18V9Z" fill="currentColor"/><path opacity="0.5" d="M5 5C5 4.44772 5.44772 4 6 4H18C18.5523 4 19 4.44772 19 5V5C19 5.55228 18.5523 6 18 6H6C5.44772 6 5 5.55228 5 5V5Z" fill="currentColor"/><path opacity="0.5" d="M9 4C9 3.44772 9.44772 3 10 3H14C14.5523 3 15 3.44772 15 4V4H9V4Z" fill="currentColor"/></svg>
                                            </span>
                                            <span class="flex flex-col flex-align-c padding-025 text-muted text-primary-hover border-soft pointer" title="Szerkesztés" onclick="__editnews('.$dt['id'].');">
                                                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path opacity="0.3" fill-rule="evenodd" clip-rule="evenodd" d="M2 4.63158C2 3.1782 3.1782 2 4.63158 2H13.47C14.0155 2 14.278 2.66919 13.8778 3.04006L12.4556 4.35821C11.9009 4.87228 11.1726 5.15789 10.4163 5.15789H7.1579C6.05333 5.15789 5.15789 6.05333 5.15789 7.1579V16.8421C5.15789 17.9467 6.05333 18.8421 7.1579 18.8421H16.8421C17.9467 18.8421 18.8421 17.9467 18.8421 16.8421V13.7518C18.8421 12.927 19.1817 12.1387 19.7809 11.572L20.9878 10.4308C21.3703 10.0691 22 10.3403 22 10.8668V19.3684C22 20.8218 20.8218 22 19.3684 22H4.63158C3.1782 22 2 20.8218 2 19.3684V4.63158Z" fill="currentColor"/><path d="M10.9256 11.1882C10.5351 10.7977 10.5351 10.1645 10.9256 9.77397L18.0669 2.6327C18.8479 1.85165 20.1143 1.85165 20.8953 2.6327L21.3665 3.10391C22.1476 3.88496 22.1476 5.15129 21.3665 5.93234L14.2252 13.0736C13.8347 13.4641 13.2016 13.4641 12.811 13.0736L10.9256 11.1882Z" fill="currentColor"/><path d="M8.82343 12.0064L8.08852 14.3348C7.8655 15.0414 8.46151 15.7366 9.19388 15.6242L11.8974 15.2092C12.4642 15.1222 12.6916 14.4278 12.2861 14.0223L9.98595 11.7221C9.61452 11.3507 8.98154 11.5055 8.82343 12.0064Z" fill="currentColor"/></svg>
                                            </span>
                                        </div>
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
            <span class="primary-bg primary-bg-hover border-soft-light padding-05 small pointer user-select-none" id="sv-hd-ln">Mentés</span>
        </div><hr style="border: 1px solid var(--background);" class="w-100">
        <div class="flex flex-col flex-align-c flex-justify-con-c gap-1 w-fa">
            <div class="flex flex-col flex-align-c flex-justify-con-c gap-1 w-fa" id="ln-it-con">
            <?php
                $hsql = "SELECT * FROM def__header"; $hres = $con->query($hsql);
                $hdt = $hres->fetch_assoc();
                $ha = explode(";",$hdt['links']);
                for ($i = 0; $i < count($ha); $i++) {
                    echo '
                    <div class="flex flex-col gap-1 w-fa ln-it-sl hd-ln-df" id="link-cons-item-'.$i.'">
                        <div class="flex flex-row gap-05 w-fa cst-var-con">
                            <div class="flex flex-col w-30 gap-025">
                                <input type="text" value="'. explode("=",$ha[$i])[0] .'" id="link-name-'.($i+1).'" class="cst-var-name adm__input w-fa border-soft cst-drp-fts item-bg outline-none text-primary" placeholder="Meta tag neve">
                            </div>
                            <div class="flex flex-row w-70 gap-05">
                                <input type="text" value="'. explode("=",$ha[$i])[1] .'" id="link-val-'.($i+1).'" class="cst-var-val adm__input outline-none w-fa border-soft item-bg text-primary" placeholder="Meta tag adatai">
                                <span class="flex flex-col flex-align-c flex-justify-con-c danger-bg danger-bg-hover border-soft small pointer" style="padding: .65rem;" aria-label="Eltávolítás" role="button" title="Eltávolítás" onclick="__removelinks('. $i .')">
                                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M6.7 19.4L5.3 18C4.9 17.6 4.9 17 5.3 16.6L16.6 5.3C17 4.9 17.6 4.9 18 5.3L19.4 6.7C19.8 7.1 19.8 7.7 19.4 8.1L8.1 19.4C7.8 19.8 7.1 19.8 6.7 19.4Z" fill="currentColor"></path><path d="M19.5 18L18.1 19.4C17.7 19.8 17.1 19.8 16.7 19.4L5.40001 8.1C5.00001 7.7 5.00001 7.1 5.40001 6.7L6.80001 5.3C7.20001 4.9 7.80001 4.9 8.20001 5.3L19.5 16.6C19.9 16.9 19.9 17.6 19.5 18Z" fill="currentColor"></path></svg>
                                </span>
                            </div>
                        </div>
                        <div class="hd-ln-el-er-cn" id="hd-ln-el-er-cn-'.$i.'"></div>
                    </div>      
                    ';
                }
            ?>
            </div>
            <div class="flex flex-col w-fa gap-1" id="link-cons"></div>
            <div class="flex flex-row w-fa">
                <span id="add-links" class="primary-bg primary-bg-hover border-soft pointer user-select-none small w-fc" style="padding: .65rem;">Link hozzáadása</span>
            </div>
        </div>
    </div>
</div>
<div class="flex flex-col gap-1">
    <?php $sql = "SELECT def__news.*, def__news__status.status, customers.fullname FROM def__news INNER JOIN def__news__status ON def__news__status.nid = def__news.id INNER JOIN customers ON customers.id = def__news.uid LIMIT 2";$res = $con->query($sql); ?>
    <div class="flex flex-col w-fa gap-1 border-soft item-bg box-shadow padding-1">
        <div class="flex flex-row flex-align-c flex-justify-con-sb">
            <span class="text-primary large bold">Webáruház oldal slider <em>(<?= $res->num_rows; ?>)</em></span>
            <span class="primary-bg primary-bg-hover border-soft-light padding-05 small pointer">Hozzáadás</span>
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
                                        <div class="flex flex-row flex-align-c gap-05">
                                            <span class="flex flex-col flex-align-c padding-025 text-muted text-primary-hover border-soft pointer" title="Eltávolítás" onclick="__deletenews('.$dt['id'].');">
                                                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M5 9C5 8.44772 5.44772 8 6 8H18C18.5523 8 19 8.44772 19 9V18C19 19.6569 17.6569 21 16 21H8C6.34315 21 5 19.6569 5 18V9Z" fill="currentColor"/><path opacity="0.5" d="M5 5C5 4.44772 5.44772 4 6 4H18C18.5523 4 19 4.44772 19 5V5C19 5.55228 18.5523 6 18 6H6C5.44772 6 5 5.55228 5 5V5Z" fill="currentColor"/><path opacity="0.5" d="M9 4C9 3.44772 9.44772 3 10 3H14C14.5523 3 15 3.44772 15 4V4H9V4Z" fill="currentColor"/></svg>
                                            </span>
                                            <span class="flex flex-col flex-align-c padding-025 text-muted text-primary-hover border-soft pointer" title="Szerkesztés" onclick="__editnews('.$dt['id'].');">
                                                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path opacity="0.3" fill-rule="evenodd" clip-rule="evenodd" d="M2 4.63158C2 3.1782 3.1782 2 4.63158 2H13.47C14.0155 2 14.278 2.66919 13.8778 3.04006L12.4556 4.35821C11.9009 4.87228 11.1726 5.15789 10.4163 5.15789H7.1579C6.05333 5.15789 5.15789 6.05333 5.15789 7.1579V16.8421C5.15789 17.9467 6.05333 18.8421 7.1579 18.8421H16.8421C17.9467 18.8421 18.8421 17.9467 18.8421 16.8421V13.7518C18.8421 12.927 19.1817 12.1387 19.7809 11.572L20.9878 10.4308C21.3703 10.0691 22 10.3403 22 10.8668V19.3684C22 20.8218 20.8218 22 19.3684 22H4.63158C3.1782 22 2 20.8218 2 19.3684V4.63158Z" fill="currentColor"/><path d="M10.9256 11.1882C10.5351 10.7977 10.5351 10.1645 10.9256 9.77397L18.0669 2.6327C18.8479 1.85165 20.1143 1.85165 20.8953 2.6327L21.3665 3.10391C22.1476 3.88496 22.1476 5.15129 21.3665 5.93234L14.2252 13.0736C13.8347 13.4641 13.2016 13.4641 12.811 13.0736L10.9256 11.1882Z" fill="currentColor"/><path d="M8.82343 12.0064L8.08852 14.3348C7.8655 15.0414 8.46151 15.7366 9.19388 15.6242L11.8974 15.2092C12.4642 15.1222 12.6916 14.4278 12.2861 14.0223L9.98595 11.7221C9.61452 11.3507 8.98154 11.5055 8.82343 12.0064Z" fill="currentColor"/></svg>
                                            </span>
                                        </div>
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
<script>var c__wrapper = document.createElement('div'); c__wrapper.classList = "wrapper_dark fadein"; var c__box = document.createElement('div'); c__box.classList = "d__confirm popup fixed flex flex-col border-soft item-bg box-shadow padding-1"; var metacount = <?= count($ma); ?>; var linkcount = <?= count($ha); ?>;
    $('#add-meta').click(() => { if (document.getElementById('mt-cn-it-em-in')) { document.getElementById('mt-cn-it-em-in').remove(); }
        metacount++; var cstitem = document.createElement('div'); cstitem.id = "meta-cons-item-"+metacount; cstitem.classList = "flex flex-col gap-1 w-fa mt-it-sl"; document.getElementById('meta-cons').append(cstitem);
        document.getElementById('meta-cons-item-'+metacount).innerHTML = `
        <div class="flex flex-row gap-05 w-fa cst-var-con" id="cst-var-${metacount}">
            <div class="flex flex-col w-30 gap-025">
                <input type="text" id="var-name-${metacount}" class='cst-var-name adm__input w-fa border-soft cst-drp-fts item-bg outline-none text-primary' placeholder='Meta tag neve'>
            </div>
            <div class="flex flex-row w-70 gap-05">
                <input type="text" id="var-val-${metacount}" class='cst-var-val adm__input outline-none w-fa border-soft item-bg text-primary' placeholder='Meta tag adatai'>
                <span class="flex flex-col flex-align-c flex-justify-con-c danger-bg danger-bg-hover border-soft small pointer" style="padding: .65rem;" aria-label="Eltávolítás" role="button" title="Eltávolítás" onclick="__removemeta(${metacount})">
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M6.7 19.4L5.3 18C4.9 17.6 4.9 17 5.3 16.6L16.6 5.3C17 4.9 17.6 4.9 18 5.3L19.4 6.7C19.8 7.1 19.8 7.7 19.4 8.1L8.1 19.4C7.8 19.8 7.1 19.8 6.7 19.4Z" fill="currentColor"/><path d="M19.5 18L18.1 19.4C17.7 19.8 17.1 19.8 16.7 19.4L5.40001 8.1C5.00001 7.7 5.00001 7.1 5.40001 6.7L6.80001 5.3C7.20001 4.9 7.80001 4.9 8.20001 5.3L19.5 16.6C19.9 16.9 19.9 17.6 19.5 18Z" fill="currentColor"/></svg>
                </span>
            </div>
        </div>
        `;
    }); function __removemeta (index) { document.getElementById('meta-cons-item-'+index).remove(); var mdiv = document.getElementsByClassName('mt-it-sl');
        if (mdiv.length < 1) { document.getElementById('mt-it-con').innerHTML = `<span class="text-muted user-select-none text-align-c" id="mt-cn-it-em-in">Egy meta tag sem található, vagy el lett távolítva. Amennyiben fel szeretne venni új meta tagokat, kattintson a <strong>Meta hozzáadása</strong> gombra.</span>`; }
    } $('#add-links').click(() => { if (document.getElementById('ln-cn-it-em-in')) { document.getElementById('ln-cn-it-em-in').remove(); }
        linkcount++; var cstitem = document.createElement('div'); cstitem.id = "link-cons-item-"+linkcount; cstitem.classList = "flex flex-col gap-1 ln-it-sl";
        document.getElementById('link-cons').append(cstitem);
        document.getElementById('link-cons-item-'+linkcount).innerHTML = `
        <div class="flex flex-row gap-05 w-fa cst-var-con hd-ln-df" id="cst-var-${linkcount}">
            <div class="flex flex-col w-30 gap-025">
                <input type="text" id="link-name-${linkcount}" class='cst-var-name adm__input w-fa border-soft cst-drp-fts item-bg outline-none text-primary' placeholder='Link neve'>
            </div>
            <div class="flex flex-row w-70 gap-05">
                <input type="text" id="link-val-${linkcount}" class='cst-var-val adm__input outline-none w-fa border-soft item-bg text-primary' placeholder='Link útvonal'>
                <span class="flex flex-col flex-align-c flex-justify-con-c danger-bg danger-bg-hover border-soft small pointer" style="padding: .65rem;" aria-label="Eltávolítás" role="button" title="Eltávolítás" onclick="__removelinks(${linkcount})">
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M6.7 19.4L5.3 18C4.9 17.6 4.9 17 5.3 16.6L16.6 5.3C17 4.9 17.6 4.9 18 5.3L19.4 6.7C19.8 7.1 19.8 7.7 19.4 8.1L8.1 19.4C7.8 19.8 7.1 19.8 6.7 19.4Z" fill="currentColor"/><path d="M19.5 18L18.1 19.4C17.7 19.8 17.1 19.8 16.7 19.4L5.40001 8.1C5.00001 7.7 5.00001 7.1 5.40001 6.7L6.80001 5.3C7.20001 4.9 7.80001 4.9 8.20001 5.3L19.5 16.6C19.9 16.9 19.9 17.6 19.5 18Z" fill="currentColor"/></svg>
                </span>
            </div>
        </div>
        <div class="hd-ln-el-er-cn" id="hd-ln-el-er-cn-${(linkcount-1)}"></div>
        `;
    }); function __removelinks (index) { document.getElementById('link-cons-item-'+index).remove(); var ldiv = document.getElementsByClassName('ln-it-sl');
        if (ldiv.length < 1) { document.getElementById('ln-it-con').innerHTML = `<span class="text-muted user-select-none text-align-c" id="ln-cn-it-em-in">Egy link sem található, vagy el lett távolítva. Amennyiben fel szeretne venni új linket, kattintson a <strong>Link hozzáadása</strong> gombra.</span>`; }
    } var minActive = 0; var miniArr = [];  var newsminActive = 0; var newsMiniArr = [];
    function __inituploader () { var minIndex = document.getElementsByClassName('miniature-upload').length;  minActive++; minIndex++; 
        if (minIndex <= 1) {
            document.getElementById('miniatures-con').innerHTML += `
            <div id="miniature-upload-${minActive}" class="miniature-upload flex flex-row-d-col-m flex-align-c flex-justify-con-c border-soft background-bg background-bg-hover text-primary padding-1 user-select-none w-fc pointer miniature-fixed relative">
                <input type="file" id="miniature-input-${minActive}" class="hidden miniature-input">
                <div class="miniature-upload-inner flex flex-row-d-col-m flex-align-c gap-1" onclick="__minupload(${minActive})">
                    <div class="flex flex-row flex-align-c gap-1">
                        <div class="flex flex-col flex-align-c flex-justify-con-c">
                            <span id="min-icon-${minActive}"><svg width="48" height="48" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path opacity="0.3" d="M19 22H5C4.4 22 4 21.6 4 21V3C4 2.4 4.4 2 5 2H14L20 8V21C20 21.6 19.6 22 19 22ZM14.5 12L12.7 9.3C12.3 8.9 11.7 8.9 11.3 9.3L10 12H11.5V17C11.5 17.6 11.4 18 12 18C12.6 18 12.5 17.6 12.5 17V12H14.5Z" fill="currentColor"/><path d="M13 11.5V17.9355C13 18.2742 12.6 19 12 19C11.4 19 11 18.2742 11 17.9355V11.5H13Z" fill="currentColor"/><path d="M8.2575 11.4411C7.82942 11.8015 8.08434 12.5 8.64398 12.5H15.356C15.9157 12.5 16.1706 11.8015 15.7425 11.4411L12.4375 8.65789C12.1875 8.44737 11.8125 8.44737 11.5625 8.65789L8.2575 11.4411Z" fill="currentColor"/><path d="M15 8H20L14 2V7C14 7.6 14.4 8 15 8Z" fill="currentColor"/></svg></span>
                            <span class="text-muted small-med w-fa text-align-c">Kép választása</span>
                        </div>
                    </div>
                </div>
                <div id="miniature-prop-con-${minActive}" class=" absolute"></div>
                <div style="top: -10%; right: -10%;" class="mini-action flex flex-align-c flex-justify-con-c padding-025 absolute item-bg circle text-muted link-color box-shadow-dark pointer" aria-label="Eltávolítás" title="Eltávolítás" role="button" data-active="${minActive}">
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M6.7 19.4L5.3 18C4.9 17.6 4.9 17 5.3 16.6L16.6 5.3C17 4.9 17.6 4.9 18 5.3L19.4 6.7C19.8 7.1 19.8 7.7 19.4 8.1L8.1 19.4C7.8 19.8 7.1 19.8 6.7 19.4Z" fill="currentColor"></path><path d="M19.5 18L18.1 19.4C17.7 19.8 17.1 19.8 16.7 19.4L5.40001 8.1C5.00001 7.7 5.00001 7.1 5.40001 6.7L6.80001 5.3C7.20001 4.9 7.80001 4.9 8.20001 5.3L19.5 16.6C19.9 16.9 19.9 17.6 19.5 18Z" fill="currentColor"></path></svg>
                </div>
            </div>
            `; var remBtn = document.getElementsByClassName('mini-action');
            for (let i = 0; i < remBtn.length; i++) { remBtn[i].setAttribute('onclick', '__removeminiature('+minIndex+', '+remBtn[i].getAttribute('data-active')+')'); }
        } if (minIndex == 1 || minIndex > 1) { document.getElementById('miniature-uploader').remove(); document.getElementById('miniatures-con').innerHTML += ``; }
    } function __minupload (e) {
        document.getElementById('miniature-input-'+e).addEventListener('click', () => {
            document.getElementById('min-icon-'+e).innerHTML = `<svg width="48" height="48" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path opacity="0.3" d="M19 22H5C4.4 22 4 21.6 4 21V3C4 2.4 4.4 2 5 2H14L20 8V21C20 21.6 19.6 22 19 22Z" fill="currentColor"/><g clip-path="url(#clip0_787_1289)"><path d="M9.56133 15.7161C9.72781 15.5251 9.5922 15.227 9.33885 15.227H8.58033C8.57539 15.1519 8.57262 15.0763 8.57262 15C8.57262 13.1101 10.1101 11.5726 12 11.5726C12.7576 11.5726 13.4585 11.8198 14.0265 12.2377C14.2106 12.3731 14.4732 12.3609 14.6216 12.1872L15.1671 11.5491C15.3072 11.3852 15.2931 11.1382 15.1235 11.005C14.2353 10.3077 13.1468 9.92944 12 9.92944C10.6456 9.92944 9.37229 10.4569 8.41458 11.4146C7.4569 12.3723 6.92945 13.6456 6.92945 15C6.92945 15.0759 6.93135 15.1516 6.93465 15.2269H6.29574C6.0424 15.2269 5.90677 15.5251 6.07326 15.7161L7.51455 17.3693L7.81729 17.7166L8.90421 16.4698L9.56133 15.7161Z" fill="currentColor"/><path d="M17.9268 14.7516L16.8518 13.5185L16.1828 12.7511L15.2276 13.8468L14.4388 14.7516C14.2723 14.9426 14.4079 15.2407 14.6612 15.2407H15.4189C15.2949 17.0187 13.809 18.4274 12.0001 18.4274C11.347 18.4274 10.736 18.2437 10.216 17.9253C10.0338 17.8138 9.79309 17.8362 9.6543 17.9985L9.10058 18.6463C8.95391 18.8179 8.97742 19.0782 9.16428 19.2048C9.99513 19.7678 10.9743 20.0706 12.0001 20.0706C13.3545 20.0706 14.6278 19.5432 15.5855 18.5855C16.4863 17.6847 17.0063 16.5047 17.0649 15.2407H17.7043C17.9577 15.2407 18.0933 14.9426 17.9268 14.7516Z" fill="currentColor"/></g><path d="M15 8H20L14 2V7C14 7.6 14.4 8 15 8Z" fill="currentColor"/><defs><clipPath id="clip0_787_1289"><rect width="12" height="12" fill="white" transform="translate(6 9)"/></clipPath></defs></svg>`;
            document.getElementById('miniature-input-'+e).addEventListener('change', () => { var minInput = document.getElementById('miniature-input-'+e);
                if (minInput.value.length > 0) { let validExtensions = ["image/jpeg", "image/jpg", "image/png"];
                    if (validExtensions.includes(minInput.files[0].type)) { var allMinInp = document.getElementsByClassName('miniature-input'); var duplicate = false;
                        if (miniArr.length > 0) { for (let i = 0; i < miniArr.length; i++) { if (miniArr[i].name == minInput.files[0].name && miniArr[i].type == minInput.files[0].type && miniArr[i].size == minInput.files[0].size) { duplicate = true; } }
                            if (duplicate == true) { document.getElementById('min-icon-'+e).innerHTML = `<svg width="48" height="48" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path opacity="0.3" d="M5 22H19C19.6 22 20 21.6 20 21V8L14 2H5C4.4 2 4 2.4 4 3V21C4 21.6 4.4 22 5 22Z" fill="currentColor"/><path d="M15 8H20L14 2V7C14 7.6 14.4 8 15 8Z" fill="currentColor"/><rect x="7.55518" y="16.7585" width="10.144" height="2" rx="1" transform="rotate(-45 7.55518 16.7585)" fill="currentColor"/><rect x="9.0174" y="9.60327" width="10.0952" height="2" rx="1" transform="rotate(45 9.0174 9.60327)" fill="currentColor"/></svg>`; document.getElementById('miniature-upload-'+e).getElementsByClassName('text-muted')[0].textContent = "Duplikáció"; }
                            else { miniArr.push(minInput.files[0]); __loadpreview(e); }
                        } else { miniArr.push(minInput.files[0]); __loadpreview(e); }
                    } else { document.getElementById('min-icon-'+e).innerHTML = `<svg width="48" height="48" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path opacity="0.3" d="M5 22H19C19.6 22 20 21.6 20 21V8L14 2H5C4.4 2 4 2.4 4 3V21C4 21.6 4.4 22 5 22Z" fill="currentColor"/><path d="M15 8H20L14 2V7C14 7.6 14.4 8 15 8Z" fill="currentColor"/><rect x="7.55518" y="16.7585" width="10.144" height="2" rx="1" transform="rotate(-45 7.55518 16.7585)" fill="currentColor"/><rect x="9.0174" y="9.60327" width="10.0952" height="2" rx="1" transform="rotate(45 9.0174 9.60327)" fill="currentColor"/></svg>`; document.getElementById('miniature-upload-'+e).getElementsByClassName('text-muted')[0].textContent = "Hibás feltöltés"; }
                }
            });
        }); document.getElementById('miniature-input-'+e).click();
    } function __loadpreview (e) { let fileReader = new FileReader(); var minInput = document.getElementById('miniature-input-'+e);
        fileReader.onload = () => { let fileURL = fileReader.result; document.getElementById('miniature-upload-'+e).getElementsByClassName('miniature-upload-inner')[0].innerHTML = ``;
            document.getElementById('miniature-upload-'+e).style.background = 'url('+fileURL+')';
             document.getElementById('miniature-upload-'+e).addEventListener('mouseleave', () => { document.getElementById('miniature-prop-con-'+e).classList = 'absolute'; document.getElementById('miniature-prop-con-'+e).innerHTML =``; });
        }; fileReader.readAsDataURL(minInput.files[0]);
    } function __removeminiature (index, e) { miniArr = []; index--; var remBtn = document.getElementsByClassName('mini-action');
        for (let i = 0; i < remBtn.length; i++) {
            remBtn[i].setAttribute('onclick', '__removeminiature('+index+', '+remBtn[i].getAttribute('data-active')+')');
        }
        document.getElementById('miniature-upload-'+e).remove();
        if (index < 5) { // Hozzaadas gomb megjelenitese
            document.getElementById('min-upl-con').innerHTML = `
            <div id="miniature-uploader" class="flex flex-row-d-col-m flex-align-c flex-justify-con-c border-soft border-secondary-dotted background-bg background-bg-hover text-primary padding-1 user-select-none w-fc pointer miniature-fixed" onclick="__inituploader()">
                <div class="flex flex-row-d-col-m flex-align-c gap-1">
                    <div class="flex flex-row flex-align-c gap-1">
                        <div class="flex flex-col flex-align-c flex-justify-con-c">
                            <svg width="48" height="48" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M3 13V11C3 10.4 3.4 10 4 10H20C20.6 10 21 10.4 21 11V13C21 13.6 20.6 14 20 14H4C3.4 14 3 13.6 3 13Z" fill="currentColor"/><path d="M13 21H11C10.4 21 10 20.6 10 20V4C10 3.4 10.4 3 11 3H13C13.6 3 14 3.4 14 4V20C14 20.6 13.6 21 13 21Z" fill="currentColor"/></svg>
                            <span class="text-muted small-med w-fa text-align-c">Hozzáadás</span>
                        </div>
                    </div>
                </div>
            </div>
            `;
        }
    } function __deletenews (nid) {
        c__wrapper.classList.add('fadein'); c__wrapper.classList.remove('fadeout'); c__box.classList.add('padding-t-0'); c__box.classList.add('popup'); c__box.classList.remove('popout'); document.body.append(c__wrapper); c__wrapper.append(c__box); $('html').css("overflow-y", "hidden");
        c__box.innerHTML = `
            <div class="flex flex-col gap-1">
                <div class="flex flex-row flex-align-c flex-justify-con-sb padding-t-1" id="cbh__con">
                    <span class="text-primary small bold">Hír eltávolítása</span>
                    <div class="flex flex-row flex-align-c gap-05">
                        <span class="text-primary pointer" aria-label="Bezárás" id="cl__box"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"><rect opacity="0.3" x="2" y="2" width="20" height="20" rx="5" fill="currentColor"/><rect x="7" y="15.3137" width="12" height="2" rx="1" transform="rotate(-45 7 15.3137)" fill="currentColor"/><rect x="8.41422" y="7" width="12" height="2" rx="1" transform="rotate(45 8.41422 7)" fill="currentColor"/></svg></span>
                    </div>
                </div>
                <div class="flex flex-col flex-align-c flex-justify-con-c gap-1 text-muted">
                    <svg width="128" height="128" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><rect opacity="0.3" x="2" y="2" width="20" height="20" rx="10" fill="currentColor"/><rect x="11" y="14" width="7" height="2" rx="1" transform="rotate(-90 11 14)" fill="currentColor"/><rect x="11" y="17" width="2" height="2" rx="1" transform="rotate(-90 11 17)" fill="currentColor"/></svg>
                    <span class="text-muted small text-align-c">A hír eltávolítása után már nem lesz lehetősége visszavonni a törlést.</span>
                    <span class="flex flex-col flex-align-c flex-justify-con-c danger-bg danger-bg-hover border-soft small-med pointer" style="padding: .65rem;" aria-label="Eltávolítás" role="button" title="Eltávolítás">Eltávolítás</span>
                </div>
            </div>
        `; var con = document.getElementById('cbh__con'); var mc = new Hammer(con);mc.get('pan').set({ direction: Hammer.DIRECTION_ALL });mc.on("pandown", function(ev) { $('#cl__box').click(); });
        $('#cl__box').click(function () { c__wrapper.classList.add('fadeout'); c__box.classList.add('popout'); setTimeout(() => { c__wrapper.remove(); $('html').css("overflow-y", "unset"); }, 200); });
    } function __editnews (nid) {
        c__wrapper.classList.add('fadein'); c__wrapper.classList.remove('fadeout'); c__box.classList.add('padding-t-0'); c__box.classList.add('popup'); c__box.classList.remove('popout'); document.body.append(c__wrapper); c__wrapper.append(c__box); $('html').css("overflow-y", "hidden");
        c__box.innerHTML = `
            <div class="flex flex-col gap-1">
                <div class="flex flex-row flex-align-c flex-justify-con-sb padding-t-1" id="cbh__con">
                    <span class="text-primary small bold">Hír szerkesztése</span>
                    <div class="flex flex-row flex-align-c gap-05">
                        <span class="text-primary pointer" aria-label="Bezárás" id="cl__box"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"><rect opacity="0.3" x="2" y="2" width="20" height="20" rx="5" fill="currentColor"/><rect x="7" y="15.3137" width="12" height="2" rx="1" transform="rotate(-45 7 15.3137)" fill="currentColor"/><rect x="8.41422" y="7" width="12" height="2" rx="1" transform="rotate(45 8.41422 7)" fill="currentColor"/></svg></span>
                    </div>
                </div>
                <div class="flex flex-col gap-05">
                    <span class="text-primary bold small-med">Hír képe</span>
                    <div class="flex flex-row-d-col-m flex-align-c flex-justify-con-c gap-1 w-fa">
                        <div class="flex flex-row flex-align-c flex-justify-con-c w-50d-100m">
                            <div class="flex flex-col flex-align-c flex-justify-con-c w-fa relative">
                                <div class="news_container flex flex-col flex-align-c relative flex flex-col flex-align-c relative w-fa border-soft" id="main_news_no_2" style="background-image: url(&quot;/assets/images/news/2.jpg&quot;); height: 6rem !important;"></div>
                            </div>
                        </div>
                        <div class="flex flex-row w-50d-100m gap-1" style="font-size: .65rem !important;">
                            <div class="flex flex-row gap-1" id="news-miniatures-con"></div>
                            <div id="news-min-upl-con">
                                <div id="news-miniature-uploader" class="flex flex-row-d-col-m flex-align-c flex-justify-con-c border-soft border-secondary-dotted background-bg background-bg-hover text-primary padding-1 user-select-none w-fc pointer miniature-fixed" onclick="__initnewsuploader()">
                                    <div class="flex flex-row-d-col-m flex-align-c gap-1">
                                        <div class="flex flex-row flex-align-c gap-1">
                                            <div class="flex flex-col flex-align-c flex-justify-con-c">
                                                <svg width="48" height="48" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M3 13V11C3 10.4 3.4 10 4 10H20C20.6 10 21 10.4 21 11V13C21 13.6 20.6 14 20 14H4C3.4 14 3 13.6 3 13Z" fill="currentColor"></path><path d="M13 21H11C10.4 21 10 20.6 10 20V4C10 3.4 10.4 3 11 3H13C13.6 3 14 3.4 14 4V20C14 20.6 13.6 21 13 21Z" fill="currentColor"></path></svg>
                                                <span class="text-muted w-fa text-align-c" style="font-size: .9rem !important;">Hozzáadás</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="flex flex-col gap-05">
                    <span class="text-primary bold small-med">Hír státusza</span>
                    <div class="flex flex-row flex-align-c gap-1 w-fa user-select-none" style="font-size: .65rem !important;">
                        <span class="flex flex-row flex-align-c flex-justify-con-c border-soft padding-05 primary-bg text-primary border-primary-hover border-primary-dk pointer prim-bg-hover">Aktiv</span>
                        <span class="flex flex-row flex-align-c flex-justify-con-c border-soft padding-05 primary-bg text-primary border-primary-hover border-primary-dk pointer prim-bg-hover">Inaktiv</span>
                    </div>
                </div>
                <div class="flex flex-col gap-05">
                    <span class="text-primary bold small-med">Hír tartalma</span>
                    <div id="prod-del-editor" class="background-bg border-soft" style="height: 10rem;"></div>
                </div>
                <div class="flex flex-row flex-align-c flex-justify-con-fe gap-1 w-fa">
                    <span error-data="delete"></span>
                    <div id="cnf-pd-del" class="flex flex-row flex-align-c flex-justify-con-sb gap-1 primary-bg primary-bg-hover pointer user-select-none padding-05 border-soft-light">
                        <span class="smaller-light">Mentés</span>
                    </div>
                </div>
            </div>
        `; var quill = new Quill('#prod-del-editor', { modules: { toolbar: false }, placeholder: 'Ide írja a hír tartalmát...', theme: 'snow' });
        var con = document.getElementById('cbh__con'); var mc = new Hammer(con);mc.get('pan').set({ direction: Hammer.DIRECTION_ALL });mc.on("pandown", function(ev) { $('#cl__box').click(); });
        $('#cl__box').click(function () { c__wrapper.classList.add('fadeout'); c__box.classList.add('popout'); setTimeout(() => { c__wrapper.remove(); $('html').css("overflow-y", "unset"); }, 200); });
    } function __initnewsuploader () { var minIndex = document.getElementsByClassName('news-miniature-upload').length;  newsminActive++; minIndex++; 
        if (minIndex <= 1) {
            document.getElementById('news-miniatures-con').innerHTML += `
            <div id="news-miniature-upload-${newsminActive}" class="news-miniature-upload flex flex-row-d-col-m flex-align-c flex-justify-con-c border-soft background-bg background-bg-hover text-primary padding-1 user-select-none w-fc pointer miniature-fixed relative">
                <input type="file" id="news-miniature-input-${newsminActive}" class="hidden miniature-input">
                <div class="news-miniature-upload-inner flex flex-row-d-col-m flex-align-c gap-1" onclick="__minnewsupload(${newsminActive})">
                    <div class="flex flex-row flex-align-c gap-1">
                        <div class="flex flex-col flex-align-c flex-justify-con-c">
                            <span id="news-min-icon-${newsminActive}"><svg width="48" height="48" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path opacity="0.3" d="M19 22H5C4.4 22 4 21.6 4 21V3C4 2.4 4.4 2 5 2H14L20 8V21C20 21.6 19.6 22 19 22ZM14.5 12L12.7 9.3C12.3 8.9 11.7 8.9 11.3 9.3L10 12H11.5V17C11.5 17.6 11.4 18 12 18C12.6 18 12.5 17.6 12.5 17V12H14.5Z" fill="currentColor"/><path d="M13 11.5V17.9355C13 18.2742 12.6 19 12 19C11.4 19 11 18.2742 11 17.9355V11.5H13Z" fill="currentColor"/><path d="M8.2575 11.4411C7.82942 11.8015 8.08434 12.5 8.64398 12.5H15.356C15.9157 12.5 16.1706 11.8015 15.7425 11.4411L12.4375 8.65789C12.1875 8.44737 11.8125 8.44737 11.5625 8.65789L8.2575 11.4411Z" fill="currentColor"/><path d="M15 8H20L14 2V7C14 7.6 14.4 8 15 8Z" fill="currentColor"/></svg></span>
                            <span class="text-muted small-med w-fa text-align-c">Kép választása</span>
                        </div>
                    </div>
                </div>
                <div id="news-miniature-prop-con-${newsminActive}" class=" absolute"></div>
                <div style="top: -10%; right: -10%;" class="news-mini-action flex flex-align-c flex-justify-con-c padding-025 absolute item-bg circle text-muted link-color box-shadow-dark pointer" aria-label="Eltávolítás" title="Eltávolítás" role="button" data-active="${newsminActive}">
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M6.7 19.4L5.3 18C4.9 17.6 4.9 17 5.3 16.6L16.6 5.3C17 4.9 17.6 4.9 18 5.3L19.4 6.7C19.8 7.1 19.8 7.7 19.4 8.1L8.1 19.4C7.8 19.8 7.1 19.8 6.7 19.4Z" fill="currentColor"></path><path d="M19.5 18L18.1 19.4C17.7 19.8 17.1 19.8 16.7 19.4L5.40001 8.1C5.00001 7.7 5.00001 7.1 5.40001 6.7L6.80001 5.3C7.20001 4.9 7.80001 4.9 8.20001 5.3L19.5 16.6C19.9 16.9 19.9 17.6 19.5 18Z" fill="currentColor"></path></svg>
                </div>
            </div>
            `; var remBtn = document.getElementsByClassName('news-mini-action');
            for (let i = 0; i < remBtn.length; i++) { remBtn[i].setAttribute('onclick', '__removenewsminiature('+minIndex+', '+remBtn[i].getAttribute('data-active')+')'); }
        } if (minIndex == 1 || minIndex > 1) { document.getElementById('news-miniature-uploader').remove(); document.getElementById('news-miniatures-con').innerHTML += ``; }
    } function __minnewsupload (e) {
        document.getElementById('news-miniature-input-'+e).addEventListener('click', () => {
            document.getElementById('news-min-icon-'+e).innerHTML = `<svg width="48" height="48" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path opacity="0.3" d="M19 22H5C4.4 22 4 21.6 4 21V3C4 2.4 4.4 2 5 2H14L20 8V21C20 21.6 19.6 22 19 22Z" fill="currentColor"/><g clip-path="url(#clip0_787_1289)"><path d="M9.56133 15.7161C9.72781 15.5251 9.5922 15.227 9.33885 15.227H8.58033C8.57539 15.1519 8.57262 15.0763 8.57262 15C8.57262 13.1101 10.1101 11.5726 12 11.5726C12.7576 11.5726 13.4585 11.8198 14.0265 12.2377C14.2106 12.3731 14.4732 12.3609 14.6216 12.1872L15.1671 11.5491C15.3072 11.3852 15.2931 11.1382 15.1235 11.005C14.2353 10.3077 13.1468 9.92944 12 9.92944C10.6456 9.92944 9.37229 10.4569 8.41458 11.4146C7.4569 12.3723 6.92945 13.6456 6.92945 15C6.92945 15.0759 6.93135 15.1516 6.93465 15.2269H6.29574C6.0424 15.2269 5.90677 15.5251 6.07326 15.7161L7.51455 17.3693L7.81729 17.7166L8.90421 16.4698L9.56133 15.7161Z" fill="currentColor"/><path d="M17.9268 14.7516L16.8518 13.5185L16.1828 12.7511L15.2276 13.8468L14.4388 14.7516C14.2723 14.9426 14.4079 15.2407 14.6612 15.2407H15.4189C15.2949 17.0187 13.809 18.4274 12.0001 18.4274C11.347 18.4274 10.736 18.2437 10.216 17.9253C10.0338 17.8138 9.79309 17.8362 9.6543 17.9985L9.10058 18.6463C8.95391 18.8179 8.97742 19.0782 9.16428 19.2048C9.99513 19.7678 10.9743 20.0706 12.0001 20.0706C13.3545 20.0706 14.6278 19.5432 15.5855 18.5855C16.4863 17.6847 17.0063 16.5047 17.0649 15.2407H17.7043C17.9577 15.2407 18.0933 14.9426 17.9268 14.7516Z" fill="currentColor"/></g><path d="M15 8H20L14 2V7C14 7.6 14.4 8 15 8Z" fill="currentColor"/><defs><clipPath id="clip0_787_1289"><rect width="12" height="12" fill="white" transform="translate(6 9)"/></clipPath></defs></svg>`;
            document.getElementById('news-miniature-input-'+e).addEventListener('change', () => { var minInput = document.getElementById('news-miniature-input-'+e);
                if (minInput.value.length > 0) { let validExtensions = ["image/jpeg", "image/jpg", "image/png"];
                    if (validExtensions.includes(minInput.files[0].type)) { var allMinInp = document.getElementsByClassName('news-miniature-input'); var duplicate = false;
                        if (newsMiniArr.length > 0) { for (let i = 0; i < newsMiniArr.length; i++) { if (newsMiniArr[i].name == minInput.files[0].name && newsMiniArr[i].type == minInput.files[0].type && newsMiniArr[i].size == minInput.files[0].size) { duplicate = true; } }
                            if (duplicate == true) { document.getElementById('news-min-icon-'+e).innerHTML = `<svg width="48" height="48" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path opacity="0.3" d="M5 22H19C19.6 22 20 21.6 20 21V8L14 2H5C4.4 2 4 2.4 4 3V21C4 21.6 4.4 22 5 22Z" fill="currentColor"/><path d="M15 8H20L14 2V7C14 7.6 14.4 8 15 8Z" fill="currentColor"/><rect x="7.55518" y="16.7585" width="10.144" height="2" rx="1" transform="rotate(-45 7.55518 16.7585)" fill="currentColor"/><rect x="9.0174" y="9.60327" width="10.0952" height="2" rx="1" transform="rotate(45 9.0174 9.60327)" fill="currentColor"/></svg>`; document.getElementById('news-miniature-upload-'+e).getElementsByClassName('text-muted')[0].textContent = "Duplikáció"; }
                            else { newsMiniArr.push(minInput.files[0]); __loadnewspreview(e); }
                        } else { newsMiniArr.push(minInput.files[0]); __loadnewspreview(e); }
                    } else { document.getElementById('news-min-icon-'+e).innerHTML = `<svg width="48" height="48" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path opacity="0.3" d="M5 22H19C19.6 22 20 21.6 20 21V8L14 2H5C4.4 2 4 2.4 4 3V21C4 21.6 4.4 22 5 22Z" fill="currentColor"/><path d="M15 8H20L14 2V7C14 7.6 14.4 8 15 8Z" fill="currentColor"/><rect x="7.55518" y="16.7585" width="10.144" height="2" rx="1" transform="rotate(-45 7.55518 16.7585)" fill="currentColor"/><rect x="9.0174" y="9.60327" width="10.0952" height="2" rx="1" transform="rotate(45 9.0174 9.60327)" fill="currentColor"/></svg>`; document.getElementById('news-miniature-upload-'+e).getElementsByClassName('text-muted')[0].textContent = "Hibás feltöltés"; }
                }
            });
        }); document.getElementById('news-miniature-input-'+e).click();
    } function __loadnewspreview (e) { let fileReader = new FileReader(); var minInput = document.getElementById('news-miniature-input-'+e);
        fileReader.onload = () => { let fileURL = fileReader.result; document.getElementById('news-miniature-upload-'+e).getElementsByClassName('news-miniature-upload-inner')[0].innerHTML = ``;
            document.getElementById('news-miniature-upload-'+e).style.background = 'url('+fileURL+')'; document.getElementById('news-miniature-upload-'+e).style.backgroundSize = "contain";
            document.getElementById('news-miniature-upload-'+e).addEventListener('mouseleave', () => { document.getElementById('news-miniature-prop-con-'+e).classList = 'absolute'; document.getElementById('news-miniature-prop-con-'+e).innerHTML =``; });
        }; fileReader.readAsDataURL(minInput.files[0]);
    } function __removenewsminiature (index, e) { newsMiniArr = []; index--; var remBtn = document.getElementsByClassName('news-mini-action');
        for (let i = 0; i < remBtn.length; i++) {
            remBtn[i].setAttribute('onclick', '__removenewsminiature('+index+', '+remBtn[i].getAttribute('data-active')+')');
        }
        document.getElementById('news-miniature-upload-'+e).remove();
        if (index < 5) { // Hozzaadas gomb megjelenitese
            document.getElementById('news-min-upl-con').innerHTML = `
            <div id="news-miniature-uploader" class="flex flex-row-d-col-m flex-align-c flex-justify-con-c border-soft border-secondary-dotted background-bg background-bg-hover text-primary padding-1 user-select-none w-fc pointer miniature-fixed" onclick="__initnewsuploader()">
                <div class="flex flex-row-d-col-m flex-align-c gap-1">
                    <div class="flex flex-row flex-align-c gap-1">
                        <div class="flex flex-col flex-align-c flex-justify-con-c">
                            <svg width="48" height="48" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M3 13V11C3 10.4 3.4 10 4 10H20C20.6 10 21 10.4 21 11V13C21 13.6 20.6 14 20 14H4C3.4 14 3 13.6 3 13Z" fill="currentColor"/><path d="M13 21H11C10.4 21 10 20.6 10 20V4C10 3.4 10.4 3 11 3H13C13.6 3 14 3.4 14 4V20C14 20.6 13.6 21 13 21Z" fill="currentColor"/></svg>
                            <span class="text-muted small-med w-fa text-align-c">Hozzáadás</span>
                        </div>
                    </div>
                </div>
            </div>
            `;
        }
    }

    // Linkek mentese
    $('#sv-hd-ln').click(() => {
        let dec = <?= count($ha); ?>;
        var de = document.getElementsByClassName('hd-ln-df');
        const defl = [
            <?php
                for ($i = 0; $i < count($ha); $i++) {
                    echo "
                    {
                        name: '".explode("=",$ha[$i])[0]."',
                        link: '".explode("=",$ha[$i])[1]."'
                    },
                    ";
                }
            ?>
        ]; var adefla = [];

        for (let i = 0; i < de.length; i++) {
            adefla.push(
                {
                    name: de[i].querySelector('#link-name-'+(i+1)).value,
                    link: de[i].querySelector('#link-val-'+(i+1)).value
                }
            );
        }
        
        var adefle = [];

        for (let i = 0; i < defl.length; i++) {
            for (let j = 0; j < adefla.length; j++) {
                if (defl[i].name == adefla[j].name) {
                    adefle.push(
                        {
                            id: j,
                            name: adefla[j].name
                        }
                    );
                } if (defl[i].link == adefla[j].link) {
                    adefle.push(
                        {
                            id: j,
                            link: adefla[j].link
                        }
                    );
                }
            }
        }

        const groupAdefle = (adefle = []) => { let result = [];
        result = adefle.reduce((r, a) => {
            r[a.id] = r[a.id] || []; r[a.id].push(a); return r;
        }, Object.create(null)); return result;
        }; const gadefle = [{items: groupAdefle(adefle)}];

        var ec = document.getElementsByClassName('hd-ln-el-er-cn'); for (let i = 0; i < ec.length; i++) { ec[i].innerHTML = ``; } var cnid = Object.keys(gadefle[0].items);

        for (let i = 0; i < cnid.length; i++) {
            console.log(cnid[i]);
            var gname = gadefle[0].items[cnid[i]][0]?.name ? 'név (<em>' + gadefle[0].items[cnid[i]][0]?.name + '</em>)' : '';
            var glink = gadefle[0].items[cnid[i]][1]?.link ? 'link (<em>' + gadefle[0].items[cnid[i]][1]?.link + '</em>)' : '';
            document.getElementById('hd-ln-el-er-cn-'+cnid[i]).innerHTML = `
            <div class="flex flex-row flex-align-c w-fa gap-1 user-select-none small-med text-danger">
                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><rect opacity="0.3" x="2" y="2" width="20" height="20" rx="10" fill="currentColor"/><rect x="11" y="14" width="7" height="2" rx="1" transform="rotate(-90 11 14)" fill="currentColor"/><rect x="11" y="17" width="2" height="2" rx="1" transform="rotate(-90 11 17)" fill="currentColor"/></svg>
                <span>A megadott ${gname} ${glink}</span>
            </div>
            `;
        }
    });
</script>