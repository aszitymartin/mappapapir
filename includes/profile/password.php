<?php require_once($_SERVER['DOCUMENT_ROOT'].'/includes/inc.php'); $uid = $_SESSION['id'];
function get_time_ago( $time ) { $time_difference = time() - $time; if( $time_difference < 1 ) { return '< 1mp'; }
$condition = array( 12 * 30 * 24 * 60 * 60 =>  'éve',30 * 24 * 60 * 60 => 'hónapja',24 * 60 * 60 => 'napja',60 * 60 =>  'órája',60 =>  'perce',1 =>  'másodperce');
foreach( $condition as $secs => $str ) {$d = $time_difference / $secs;if( $d >= 1 ) {$t = round( $d );return $t . ' ' . $str . ( $t > 1 ? '' : '' ) . '';}}
}
?>
<div class="flex flex-row-d-col-m gap-1">
    <div class="flex flex-col w-fa gap-1 border-soft item-bg box-shadow padding-1">
        <div class="flex flex-row flex-align-c flex-justify-con-sb">
            <div class="flex flex-col">
                <span class="text-primary small bold">Jelszó kezelése</span>
                <span class="text-secondary smaller-light">Szerkessze fiókjához tartozó jelszavát.</span>
            </div>
            <div class="flex flex-row gap-1">
                <span class="primary-bg primary-bg-hover border-soft-light padding-05-1 small-med pointer user-select-none flex flex-col flex-align-c flex-justify-con-c" id="prsv__password">Mentés</span>
                <span class="text-primary pointer user-select-none small-med flex flex-col flex-align-c flex-justify-con-c" id="prcc__password">Mégsem</span>
            </div>
        </div><hr style="border: 1px solid var(--background);" class="w-fa">
        <?php
            if ($stmt = $con->prepare('SELECT date FROM u__password WHERE uid = ?')) { $stmt->bind_param('i', $uid); $stmt->execute(); $result = $stmt->get_result(); $data = $result->fetch_assoc();
                $myDate = date("Y-m-d", strtotime( date( "Y-m-d", strtotime( date("Y-m-d") ) ) . "-1 month" ) );
                if (strtotime($data['date']) <= strtotime($myDate)) {
                    echo '
                    <div class="flex flex-col gap-1">
                        <div class="flex flex-row-d-col-m flex-align-c flex-justify-con-sb border-soft border-warning-dotted warning-bg padding-1">
                            <div class="flex flex-row-d-col-m flex-align-c gap-1">
                                <div class="flex flex-row flex-align-c gap-1">
                                    <div class="flex">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="36" height="36" viewBox="0 0 24 24" fill="none"><rect opacity="0.3" x="2" y="2" width="20" height="20" rx="10" fill="currentColor"></rect><rect x="11" y="14" width="7" height="2" rx="1" transform="rotate(-90 11 14)" fill="currentColor"></rect><rect x="11" y="17" width="2" height="2" rx="1" transform="rotate(-90 11 17)" fill="currentColor"></rect></svg>
                                    </div>
                                    <div class="flex flex-col flex-align-c flex-justify-con-fs">
                                        <span class="bold w-100 small">Fiókjához használt jelszava elavult</span>
                                        <span class="text-secondary small-med">Jelszava több, mint 1 hónapja nem lett megváltoztatva. Fiókja biztonságának növelése érdekében javasoljuk, hogy rendszeresen változtassa meg jelszavát.</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    ';
                }
            }
        ?>
        <div class="flex flex-col gap-3 w-70d-100m">
            <div class="flex flex-col gap-2">
                <div class="flex flex-row-d-col-m flex-align-c prst__row">
                    <span class="text-primary small w-20d-100m prst__trig">Jelenlegi jelszó</span>
                    <input type="password" class="w-60d-90m text-primary border-soft background-bg padding-1-05 outline-none border-none" name="chpr__cpassword" id="chpr__cpassword" placeholder="Jelenlegi jelszó" autocomplete='password' />
                </div>
                <div class="flex flex-row-d-col-m flex-align-c prst__row">
                    <span class="text-primary small w-20d-100m prst__trig">Új jelszó</span>
                    <input type="password" class="w-60d-90m text-primary border-soft background-bg padding-1-05 outline-none border-none" name="chpr__npassword" id="chpr__npassword" placeholder="Új jelszó" autocomplete='password' />
                </div>
                <div class="flex flex-row-d-col-m flex-align-c prst__row">
                    <span class="text-primary small w-25d-100m prst__trig">Jelszó megismétlése</span>
                    <input type="password" class="w-60d-90m text-primary border-soft background-bg padding-1-05 outline-none border-none" name="chpr__ncpassword" id="chpr__ncpassword" placeholder="Jelszó megismétlése" autocomplete='password' />
                </div>
                <div class="flex flex-row-d-col-m flex-align-c prst__row">
                    <span class="text-primary small w-20d-100m prst__trig">Elfelejtett jelszó</span>
                    <div class="flex flex-col mw-60d-100m gap-05">
                        <div class="flex flex-row flex-align-c">
                            <span class="primary-bg primary-bg-hover border-soft padding-05 user-select-none pointer small-med">Jelszó visszaállítása</span>                                    </div>
                        <span class="text-secondary smaller-light">Elfelejtett jelszó esetében egy megerősítő kódot fogunk küldeni email címére, amit, ha sikeresen vissza igazol, megváltoztathatja jelszavát.</span>
                    </div>
                </div>
            </div>
        </div>
        <?php
        if ($stmt = $con->prepare('SELECT factor, factor__type FROM u__password WHERE uid = ?')) { $stmt->bind_param('i', $uid); $stmt->execute(); $result = $stmt->get_result(); $data = $result->fetch_assoc();
            if ($data['factor'] == false) {
                echo '
                <div class="flex flex-row-d-col-m flex-align-c flex-justify-con-sb border-soft border-primary-light-dotted primary-bg padding-1">
                    <div class="flex flex-row-d-col-m flex-align-c gap-1">
                        <div class="flex flex-row flex-align-c gap-1">
                            <div class="flex">
                                <svg xmlns="http://www.w3.org/2000/svg" width="36" height="36" viewBox="0 0 24 24" fill="none"><path opacity="0.3" d="M20.5543 4.37824L12.1798 2.02473C12.0626 1.99176 11.9376 1.99176 11.8203 2.02473L3.44572 4.37824C3.18118 4.45258 3 4.6807 3 4.93945V13.569C3 14.6914 3.48509 15.8404 4.4417 16.984C5.17231 17.8575 6.18314 18.7345 7.446 19.5909C9.56752 21.0295 11.6566 21.912 11.7445 21.9488C11.8258 21.9829 11.9129 22 12.0001 22C12.0872 22 12.1744 21.983 12.2557 21.9488C12.3435 21.912 14.4326 21.0295 16.5541 19.5909C17.8169 18.7345 18.8277 17.8575 19.5584 16.984C20.515 15.8404 21 14.6914 21 13.569V4.93945C21 4.6807 20.8189 4.45258 20.5543 4.37824Z" fill="currentColor"></path><path d="M10.5606 11.3042L9.57283 10.3018C9.28174 10.0065 8.80522 10.0065 8.51412 10.3018C8.22897 10.5912 8.22897 11.0559 8.51412 11.3452L10.4182 13.2773C10.8099 13.6747 11.451 13.6747 11.8427 13.2773L15.4859 9.58051C15.771 9.29117 15.771 8.82648 15.4859 8.53714C15.1948 8.24176 14.7183 8.24176 14.4272 8.53714L11.7002 11.3042C11.3869 11.6221 10.874 11.6221 10.5606 11.3042Z" fill="currentColor"></path></svg>
                            </div>
                            <div class="flex flex-col flex-align-c flex-justify-con-fs">
                                <span class="bold w-100 small">Növelje fiókja biztonságát</span>
                                <span class="text-secondary small-med">A két lépcsős hitelesítés további biztonsági réteget ad fiókjához. A bejelentkezéshez meg kell adnia egy 6 számjegyű kódot is</span>
                            </div>
                        </div>
                        <div class="flex flex-col flex-align-fe" onclick="gotoTabSecu()">
                            <span class="primary-dark-bg border-soft padding-05 pointer user-select-none w-fc">Bekapcsolás</span>
                        </div>
                    </div>
                </div>
                ';
            }
        }
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
            }
        }
        ?>
    </div>
</div><script src="/includes/profile/script/password.js"></script>