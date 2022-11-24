<?php require_once($_SERVER['DOCUMENT_ROOT'].'/includes/inc.php'); include('conf/data.inc.php');
if (isset($_SESSION['loggedin'])) {
    $stmt = $con->prepare('SELECT privilege FROM customers__priv  WHERE uid = ?'); if (isset($_SESSION['loggedin'])) {$id = $_SESSION['id'];} $stmt->bind_param('i', $id);$stmt->execute(); $stmt->bind_result($privilege); $stmt->fetch();$stmt->close();
    if ($privilege != 2) { echo "<script>window.location.href='/';</script>"; }
} else { header("Location: /"); }
$uid = $_SESSION['guid']; $gname = $_SESSION['gname'];
function get_time_ago( $time ) { $time_difference = time() - $time; if( $time_difference < 1 ) { return '< 1mp'; }
$condition = array( 12 * 30 * 24 * 60 * 60 =>  'éve',30 * 24 * 60 * 60 => 'hónapja',24 * 60 * 60 => 'napja',60 * 60 =>  'órája',60 =>  'perce',1 =>  'másodperce');
foreach( $condition as $secs => $str ) {$d = $time_difference / $secs;if( $d >= 1 ) {$t = round( $d );return $t . ' ' . $str . ( $t > 1 ? '' : '' ) . '';}}
}
?>
<div class="flex flex-col gap-1">
    <div class="flex flex-col w-fa gap-1 border-soft item-bg box-shadow padding-1">
        <div class="flex flex-row flex-align-c flex-justify-con-sb">
            <div class="flex flex-col">
                <span class="text-primary small bold">Jelszó kezelése</span>
                <span class="text-secondary smaller-light">Szerkessze <?= $gname; ?> jelszavát.</span>
            </div>
            <div class="flex flex-row flex-align-c gap-1">
                <span class="flex flex-row flex-align-c flex-justify-con-c padding-05 border-soft-light primary-bg primary-bg-hover pointer user-select-none small-med" id="prsv__password">Mentés</span>
            </div>
        </div><hr style="border: 1px solid var(--background);" class="w-fa">
        <div class="flex flex-col gap-3 w-70d-100m">
            <div class="flex flex-col gap-2">
                <div class="flex flex-row-d-col-m flex-align-c prst__row">
                    <span class="text-primary small w-20d-100m prst__trig">Új jelszó</span>
                    <input type="password" class="w-60d-90m text-primary border-soft background-bg padding-1-05 outline-none border-none" name="chpr__npassword" id="chpr__npassword" placeholder="Új jelszó" autocomplete='password' />
                </div>
                <div class="flex flex-row-d-col-m flex-align-c prst__row">
                    <span class="text-primary small w-25d-100m prst__trig">Jelszó megerősítése</span>
                    <input type="password" class="w-60d-90m text-primary border-soft background-bg padding-1-05 outline-none border-none" name="chpr__ncpassword" id="chpr__ncpassword" placeholder="Jelszó megerősítése" autocomplete='password' />
                </div>
            </div>
        </div>
    </div>
    <div class="flex flex-col w-fa gap-1 border-soft item-bg box-shadow padding-1">
        <?php
        if ($sec__stmt = $con->prepare('SELECT * FROM u__pass__history WHERE uid = ? ORDER BY date DESC')) {
            $sec__stmt->bind_param('i', $uid); $sec__stmt->execute(); $sec__result = $sec__stmt->get_result();
            if ($sec__result->num_rows > 0) {
                echo '
                <div class="flex flex-col gap-1">
                <div class="flex flex-row flex-align-c flex-justify-con-sb gap-1">
                    <div class="flex flex-col">
                        <span class="text-primary bold">Jelszó változtatási előzmények</span>
                    </div>
                </div>
                <div class="flex flex-col gap-2">
                <table class="sess__history w-100">
                    <tr class="sessh__header">
                        <th>Terület</th>
                        <th>Státusz</th>
                        <th>Készülék</th>
                        <th>IP Cím</th>
                        <th>Idő</th>
                    </tr>
                ';
                while ($log = $sec__result->fetch_assoc()) {
                    echo '
                    <tr class="sessh__body">
                        <td>'.$log['location'].'</td>
                        <td>';
                        if ($log['status'] == 1) { echo '<span class="label label-success border-soft-light padding-05 bold">OK</span>'; }
                        else { echo '<span class="label label-danger border-soft-light padding-05 bold">ERR</span>'; }
                        echo '
                        </td>
                        <td>'.$log['browser'].' - '.$log['sys'].'</td>
                        <td>'.$log['ip'].'</td>
                        <td>'; echo get_time_ago(strtotime($log['date'])); echo '</td>
                    </tr>
                    ';
                }
                echo '</table></div></div>';
            } else { echo '
                <span class="flex flex-col flex-align-c flex-justify-con-c gap-1 text-muted user-select-none">
                    <svg width="128" height="128" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path opacity="0.3" d="M19 22H5C4.4 22 4 21.6 4 21V3C4 2.4 4.4 2 5 2H14L20 8V21C20 21.6 19.6 22 19 22Z" fill="currentColor"/><path d="M15 8H20L14 2V7C14 7.6 14.4 8 15 8Z" fill="currentColor"/></svg>
                    <span>A felhasználó még nem változtatta meg a jelszavát, így nincsen megjeleníthető adat.</span>
                </span>';
            }
        }
        ?>
    </div>
</div>
<script>var guid = <?= $uid ?>;</script>
<script src="/includes/profile/script/password-a.js"></script>