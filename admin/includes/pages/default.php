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
    <div class="flex flex-col w-fa gap-1 border-soft item-bg box-shadow padding-1">
        <div class="flex flex-row flex-align-c flex-justify-con-sb">
            <span class="text-primary large bold">Alap beállítások</span>
            <span class="primary-bg primary-bg-hover border-soft-light padding-025 small pointer">Mentés</span>
        </div>
        <div class="flex flex-col flex-align-c flex-justify-con-c gap-1 padding-1">
            <div class="flex flex-col gap-1 w-fa">
                <span class="text-primary bold">Oldal neve</span>
                <input type="text" data-key="fullname" class="w-fa text-primary border-soft background-bg padding-1-05 outline-none border-none" id="def-ws-name" placeholder="Oldal neve" autocomplete="off">
            </div>
            <div class="flex flex-col gap-1 w-fa">
                <span class="text-primary bold">Oldal leírása</span>
                <input type="text" data-key="fullname" class="w-fa text-primary border-soft background-bg padding-1-05 outline-none border-none" id="def-ws-name" placeholder="Oldal neve" autocomplete="off">
            </div>
            <div class="flex flex-col gap-1 w-fa">
                <span class="text-primary bold">Webmester</span>
                <input type="text" data-key="fullname" class="w-fa text-primary border-soft background-bg padding-1-05 outline-none border-none" id="def-ws-name" placeholder="Oldal neve" autocomplete="off">
            </div>
            <div class="flex flex-col gap-1 w-fa">
                <span class="text-primary bold">Webmester elérhetőségei</span>
                <input type="text" data-key="fullname" class="w-fa text-primary border-soft background-bg padding-1-05 outline-none border-none" id="def-ws-name" placeholder="Oldal neve" autocomplete="off">
            </div>
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
    <div class="flex flex-col w-fa gap-1 border-soft item-bg box-shadow padding-1">
        <div class="flex flex-row flex-align-c flex-justify-con-sb">
            <span class="text-primary large bold">Kiemelt Hírek <em>(4)</em></span>
            <span class="primary-bg primary-bg-hover border-soft-light padding-025 small pointer">Mentés</span>
        </div>
        <div class="flex flex-col flex-align-c flex-justify-con-c gap-1">
            <div class="flex flex-row-d-col-m gap-1 w-fa">
                <div class="flex flex-row flex-align-c flex-justify-con-c w-30d-100m">
a
                </div>
                <div class="flex flex-row w-70d-100m">
 asd                   
                </div>
            </div>
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