<?php require_once($_SERVER['DOCUMENT_ROOT'].'/includes/header.php'); if (!isset($_SESSION['loggedin'])) { header("Location: /"); die(); } $guid = $params['id']; $_SESSION['guid'] = $guid;
    $stmt = $con->prepare('SELECT privilege FROM customers__priv  WHERE uid = ?'); if (isset($_SESSION['loggedin'])) {$id = $_SESSION['id'];} $stmt->bind_param('i', $id);$stmt->execute(); $stmt->bind_result($privilege); $stmt->fetch();$stmt->close();
    if ($privilege != 2) { header("Location: /"); }
    function get_time_ago( $time ) { $time_difference = time() - $time; if( $time_difference < 1 ) { return '< 1mp'; }
        $condition = array( 12 * 30 * 24 * 60 * 60 =>  'éve',30 * 24 * 60 * 60 => 'hónapja',24 * 60 * 60 => 'napja',60 * 60 =>  'órája',60 =>  'perce',1 =>  'másodperce');
        foreach( $condition as $secs => $str ) {$d = $time_difference / $secs;if( $d >= 1 ) {$t = round( $d );return $t . ' ' . $str . ( $t > 1 ? '' : '' ) . '';}}
    } include('conf/data.inc.php'); $_SESSION['gname'] = $gname;
?>
<main id="main">
<div class="flex flex-row flex-align-c padding-1 padding-l-0 padding-b-0">
    <span class="text-muted small-med"><a class="link link-color pointer" href="/admin/">Admin</a> / <a class="link link-color pointer" href="/admin/?tab=users">Felhasználók</a> / <?php echo $gname; ?></span>
</div>
<div class="prod-con" id="tabs">
    <div class="leftcolumn">
        <div class="card border-soft box-shadow relative">
            <div class="flex flex-row flex-align-c flex-justify-con-c gap-1 w-100">
                <div class="flex flex-row user-select-none">
                    <span class="flex flex-col flex-align-c flex-justify-con-c border-soft box-shadow bold larger text-white" style="border: 3px solid #fff; width: 120px; height: 120px; background-color: #<?= $gcolor; ?>;">
                        <?= $ginitials; ?>
                    </span>
                </div>
                <div class="flex flex-col gap-05">
                    <div class="flex flex-col">
                        <div class="flex flex-row flex-align-c gap-05">
                            <span class="text-primary larger bold" id="tab__fullname"><?php echo $gname; ?></span>
                        </div>
                        <span class="text-secondary small-med text-align-c" id="tab__email"><?php echo $gemail; ?></span>
                    </div>
                    <div class="flex flex-row flex-align-c flex-justify-con-c gap-05 background-bg padding-05 border-soft text-primary">
                        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="18px" height="18px" viewBox="0 0 24 24" version="1.1"><g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"><rect x="0" y="0" width="24" height="24"></rect><rect fill="currentColor" x="2" y="5" width="19" height="4" rx="1"></rect><rect fill="currentColor" opacity="0.3" x="2" y="11" width="19" height="10" rx="1"></rect></g></svg>
                        <span class="text-primary bold small-med user-select-none"><?php
                            if ($gsub === 1) { echo 'Ingyenes'; } if ($gsub === 2) { echo 'Törzsvásárló'; } if ($gsub === 3) { echo 'Vállalati'; }
                        ?></span>
                    </div>
                </div>
            </div><br>
            <div class="flex flex-col"><hr style="border: 1px solid var(--background);" class="w-100">
                <div class="flex flex-col gap-05 padding-1 padding-tb-0 prfc__con">
                    <ul class="flex flex-col gap-05 user-select-none">
                        <li><a>
                            <div class="flex flex-row flex-align-c padding-05 border-soft gap-1 pointer usprfc prfc__item prfc__item__active relative" onclick="showPanel('tab-overview', this.getAttribute('tab-data'))" id="tabs-overview" tab-data="tabs-overview">
                                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1"><g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"><polygon points="0 0 24 0 24 24 0 24"></polygon><path d="M12.9336061,16.072447 L19.36,10.9564761 L19.5181585,10.8312381 C20.1676248,10.3169571 20.2772143,9.3735535 19.7629333,8.72408713 C19.6917232,8.63415859 19.6104327,8.55269514 19.5206557,8.48129411 L12.9336854,3.24257445 C12.3871201,2.80788259 11.6128799,2.80788259 11.0663146,3.24257445 L4.47482784,8.48488609 C3.82645598,9.00054628 3.71887192,9.94418071 4.23453211,10.5925526 C4.30500305,10.6811601 4.38527899,10.7615046 4.47382636,10.8320511 L4.63,10.9564761 L11.0659024,16.0730648 C11.6126744,16.5077525 12.3871218,16.5074963 12.9336061,16.072447 Z" class="svg-blank" fill-rule="nonzero"></path><path d="M11.0563554,18.6706981 L5.33593024,14.122919 C4.94553994,13.8125559 4.37746707,13.8774308 4.06710397,14.2678211 C4.06471678,14.2708238 4.06234874,14.2738418 4.06,14.2768747 L4.06,14.2768747 C3.75257288,14.6738539 3.82516916,15.244888 4.22214834,15.5523151 C4.22358765,15.5534297 4.2250303,15.55454 4.22647627,15.555646 L11.0872776,20.8031356 C11.6250734,21.2144692 12.371757,21.2145375 12.909628,20.8033023 L19.7677785,15.559828 C20.1693192,15.2528257 20.2459576,14.6784381 19.9389553,14.2768974 C19.9376429,14.2751809 19.9363245,14.2734691 19.935,14.2717619 L19.935,14.2717619 C19.6266937,13.8743807 19.0546209,13.8021712 18.6572397,14.1104775 C18.654352,14.112718 18.6514778,14.1149757 18.6486172,14.1172508 L12.9235044,18.6705218 C12.377022,19.1051477 11.6029199,19.1052208 11.0563554,18.6706981 Z" class="svg-blank" opacity="0.3"></path></g></svg>
                                <span class="small">Áttekintés</span>
                                <div class="label label-warning border-soft-light absolute right-5 center-y">Béta</div>
                            </div>
                        </a></li>
                        <li><a>
                            <div class="flex flex-row flex-align-c padding-05 border-soft gap-1 pointer usprfc prfc__item relative" onclick="showPanel('tab-cart', this.getAttribute('tab-data'))" id="tabs-cart" tab-data="tabs-cart">
                                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1"><g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"><rect x="0" y="0" width="24" height="24"></rect><path d="M12,4.56204994 L7.76822128,9.6401844 C7.4146572,10.0644613 6.7840925,10.1217854 6.3598156,9.76822128 C5.9355387,9.4146572 5.87821464,8.7840925 6.23177872,8.3598156 L11.2317787,2.3598156 C11.6315738,1.88006147 12.3684262,1.88006147 12.7682213,2.3598156 L17.7682213,8.3598156 C18.1217854,8.7840925 18.0644613,9.4146572 17.6401844,9.76822128 C17.2159075,10.1217854 16.5853428,10.0644613 16.2317787,9.6401844 L12,4.56204994 Z" class="svg-blank" fill-rule="nonzero" opacity="0.3"></path><path d="M3.28077641,9 L20.7192236,9 C21.2715083,9 21.7192236,9.44771525 21.7192236,10 C21.7192236,10.0817618 21.7091962,10.163215 21.6893661,10.2425356 L19.5680983,18.7276069 C19.234223,20.0631079 18.0342737,21 16.6576708,21 L7.34232922,21 C5.96572629,21 4.76577697,20.0631079 4.43190172,18.7276069 L2.31063391,10.2425356 C2.17668518,9.70674072 2.50244587,9.16380623 3.03824078,9.0298575 C3.11756139,9.01002735 3.1990146,9 3.28077641,9 Z M12,12 C11.4477153,12 11,12.4477153 11,13 L11,17 C11,17.5522847 11.4477153,18 12,18 C12.5522847,18 13,17.5522847 13,17 L13,13 C13,12.4477153 12.5522847,12 12,12 Z M6.96472382,12.1362967 C6.43125772,12.2792385 6.11467523,12.8275755 6.25761704,13.3610416 L7.29289322,17.2247449 C7.43583503,17.758211 7.98417199,18.0747935 8.51763809,17.9318517 C9.05110419,17.7889098 9.36768668,17.2405729 9.22474487,16.7071068 L8.18946869,12.8434035 C8.04652688,12.3099374 7.49818992,11.9933549 6.96472382,12.1362967 Z M17.0352762,12.1362967 C16.5018101,11.9933549 15.9534731,12.3099374 15.8105313,12.8434035 L14.7752551,16.7071068 C14.6323133,17.2405729 14.9488958,17.7889098 15.4823619,17.9318517 C16.015828,18.0747935 16.564165,17.758211 16.7071068,17.2247449 L17.742383,13.3610416 C17.8853248,12.8275755 17.5687423,12.2792385 17.0352762,12.1362967 Z" class="svg-blank"></path></g></svg>
                                <span class="small">Kosár</span>
                            </div>
                        </a></li>
                        <li><a>
                            <div class="flex flex-row flex-align-c padding-05 border-soft gap-1 pointer usprfc prfc__item relative" onclick="showPanel('tab-bookmarks', this.getAttribute('tab-data'))" id="tabs-bookmarks" tab-data="tabs-bookmarks">
                                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1"><g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"><rect x="0" y="0" width="24" height="24"></rect><path d="M8,4 L16,4 C17.1045695,4 18,4.8954305 18,6 L18,17.726765 C18,18.2790497 17.5522847,18.726765 17,18.726765 C16.7498083,18.726765 16.5087052,18.6329798 16.3242754,18.4639191 L12.6757246,15.1194142 C12.2934034,14.7689531 11.7065966,14.7689531 11.3242754,15.1194142 L7.67572463,18.4639191 C7.26860564,18.8371115 6.63603827,18.8096086 6.26284586,18.4024896 C6.09378519,18.2180598 6,17.9769566 6,17.726765 L6,6 C6,4.8954305 6.8954305,4 8,4 Z" class="svg-blank"></path></g></svg>
                                <span class="small">Mentett Termékek</span>
                            </div>
                        </a></li>
                        <li><a>
                            <div class="flex flex-row flex-align-c padding-05 border-soft gap-1 pointer usprfc prfc__item relative" onclick="showPanel('tab-feedbacks', this.getAttribute('tab-data'))" id="tabs-feedbacks" tab-data="tabs-feedbacks">
                                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1"><g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"><rect x="0" y="0" width="24" height="24"></rect><path d="M3.5,3 L5,3 L5,19.5 C5,20.3284271 4.32842712,21 3.5,21 L3.5,21 C2.67157288,21 2,20.3284271 2,19.5 L2,4.5 C2,3.67157288 2.67157288,3 3.5,3 Z" class="svg-blank"></path><path d="M6.99987583,2.99995344 L19.754647,2.99999303 C20.3069317,2.99999474 20.7546456,3.44771138 20.7546439,3.99999613 C20.7546431,4.24703684 20.6631995,4.48533385 20.497938,4.66895776 L17.5,8 L20.4979317,11.3310353 C20.8673908,11.7415453 20.8341123,12.3738351 20.4236023,12.7432941 C20.2399776,12.9085564 20.0016794,13 19.7546376,13 L6.99987583,13 L6.99987583,2.99995344 Z" class="svg-blank" opacity="0.3"></path></g></svg>
                                <span class="small">Visszajelzések</span>
                            </div>
                        </a></li>
                        <li><a>
                            <div class="flex flex-row flex-align-c padding-05 border-soft gap-1 pointer usprfc prfc__item relative" onclick="showPanel('tab-crediting', this.getAttribute('tab-data'))" id="tabs-crediting" tab-data="tabs-crediting">
                                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path opacity="0.3" d="M3.20001 5.91897L16.9 3.01895C17.4 2.91895 18 3.219 18.1 3.819L19.2 9.01895L3.20001 5.91897Z" class="svg-blank"/><path opacity="0.3" d="M13 13.9189C13 12.2189 14.3 10.9189 16 10.9189H21C21.6 10.9189 22 11.3189 22 11.9189V15.9189C22 16.5189 21.6 16.9189 21 16.9189H16C14.3 16.9189 13 15.6189 13 13.9189ZM16 12.4189C15.2 12.4189 14.5 13.1189 14.5 13.9189C14.5 14.7189 15.2 15.4189 16 15.4189C16.8 15.4189 17.5 14.7189 17.5 13.9189C17.5 13.1189 16.8 12.4189 16 12.4189Z" class="svg-blank"/><path d="M13 13.9189C13 12.2189 14.3 10.9189 16 10.9189H21V7.91895C21 6.81895 20.1 5.91895 19 5.91895H3C2.4 5.91895 2 6.31895 2 6.91895V20.9189C2 21.5189 2.4 21.9189 3 21.9189H19C20.1 21.9189 21 21.0189 21 19.9189V16.9189H16C14.3 16.9189 13 15.6189 13 13.9189Z" class="svg-blank"/></svg>
                                <span class="small">Jóváírások</span>
                            </div>
                        </a></li>
                        <li><a>
                            <div class="flex flex-row flex-align-c padding-05 border-soft gap-1 pointer usprfc prfc__item relative" onclick="showPanel('tab-privilege', this.getAttribute('tab-data'))" id="tabs-privilege" tab-data="tabs-privilege">
                                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path opacity="0.3" d="M18 22C19.7 22 21 20.7 21 19C21 18.5 20.9 18.1 20.7 17.7L15.3 6.30005C15.1 5.90005 15 5.5 15 5C15 3.3 16.3 2 18 2H6C4.3 2 3 3.3 3 5C3 5.5 3.1 5.90005 3.3 6.30005L8.7 17.7C8.9 18.1 9 18.5 9 19C9 20.7 7.7 22 6 22H18Z" class="svg-blank"/><path d="M18 2C19.7 2 21 3.3 21 5H9C9 3.3 7.7 2 6 2H18Z" class="svg-blank"/><path d="M9 19C9 20.7 7.7 22 6 22C4.3 22 3 20.7 3 19H9Z" class="svg-blank"/></svg>
                                <span class="small">Jogosultság</span>
                            </div>
                        </a></li>
                        <li><a>
                            <div class="flex flex-row flex-align-c padding-05 border-soft gap-1 pointer usprfc prfc__item relative" onclick="showPanel('tab-delete', this.getAttribute('tab-data'))" id="tabs-delete" tab-data="tabs-delete">
                                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M5 9C5 8.44772 5.44772 8 6 8H18C18.5523 8 19 8.44772 19 9V18C19 19.6569 17.6569 21 16 21H8C6.34315 21 5 19.6569 5 18V9Z" class="svg-blank"/><path opacity="0.5" d="M5 5C5 4.44772 5.44772 4 6 4H18C18.5523 4 19 4.44772 19 5V5C19 5.55228 18.5523 6 18 6H6C5.44772 6 5 5.55228 5 5V5Z" class="svg-blank"/><path opacity="0.5" d="M9 4C9 3.44772 9.44772 3 10 3H14C14.5523 3 15 3.44772 15 4V4H9V4Z" class="svg-blank"/></svg>
                                <span class="small">Eltávolítás</span>
                                <div class="label label-warning border-soft-light absolute right-5 center-y">Béta</div>
                            </div>
                        </a></li>
                        <li><a>
                            <div class="flex flex-row flex-align-c padding-05 border-soft gap-1 pointer usprfc prfc__item relative" onclick="showPanel('tab-log', this.getAttribute('tab-data'))" id="tabs-log" tab-data="tabs-log">
                                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1"><g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"><rect x="0" y="0" width="24" height="24"/><path d="M10.9630156,7.5 L11.0475062,7.5 C11.3043819,7.5 11.5194647,7.69464724 11.5450248,7.95024814 L12,12.5 L15.2480695,14.3560397 C15.403857,14.4450611 15.5,14.6107328 15.5,14.7901613 L15.5,15 C15.5,15.2109164 15.3290185,15.3818979 15.1181021,15.3818979 C15.0841582,15.3818979 15.0503659,15.3773725 15.0176181,15.3684413 L10.3986612,14.1087258 C10.1672824,14.0456225 10.0132986,13.8271186 10.0316926,13.5879956 L10.4644883,7.96165175 C10.4845267,7.70115317 10.7017474,7.5 10.9630156,7.5 Z" class="svg-blank"/><path d="M7.38979581,2.8349582 C8.65216735,2.29743306 10.0413491,2 11.5,2 C17.2989899,2 22,6.70101013 22,12.5 C22,18.2989899 17.2989899,23 11.5,23 C5.70101013,23 1,18.2989899 1,12.5 C1,11.5151324 1.13559454,10.5619345 1.38913364,9.65805651 L3.31481075,10.1982117 C3.10672013,10.940064 3,11.7119264 3,12.5 C3,17.1944204 6.80557963,21 11.5,21 C16.1944204,21 20,17.1944204 20,12.5 C20,7.80557963 16.1944204,4 11.5,4 C10.54876,4 9.62236069,4.15592757 8.74872191,4.45446326 L9.93948308,5.87355717 C10.0088058,5.95617272 10.0495583,6.05898805 10.05566,6.16666224 C10.0712834,6.4423623 9.86044965,6.67852665 9.5847496,6.69415008 L4.71777931,6.96995273 C4.66931162,6.97269931 4.62070229,6.96837279 4.57348157,6.95710938 C4.30487471,6.89303938 4.13906482,6.62335149 4.20313482,6.35474463 L5.33163823,1.62361064 C5.35654118,1.51920756 5.41437908,1.4255891 5.49660017,1.35659741 C5.7081375,1.17909652 6.0235153,1.2066885 6.2010162,1.41822583 L7.38979581,2.8349582 Z" class="svg-blank" opacity="0.3"/></g></svg>
                                <span class="small">Aktivitás</span>
                            </div>
                        </a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <div class="spancolumn">
        <div class="flex flex-col flex-align-c flex-justify-con-c w-fa gap-1 user-select-none text-muted small" id="load-wait">
            <svg class='wizard_input_loading' xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="8rem" height="8rem" viewBox="0 0 24 24" version="1.1"><g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"><g><polygon points="0 0 24 0 24 24 0 24"/></g><path d="M12,4 L12,6 C8.6862915,6 6,8.6862915 6,12 C6,15.3137085 8.6862915,18 12,18 C15.3137085,18 18,15.3137085 18,12 C18,10.9603196 17.7360885,9.96126435 17.2402578,9.07513926 L18.9856052,8.09853149 C19.6473536,9.28117708 20,10.6161442 20,12 C20,16.418278 16.418278,20 12,20 C7.581722,20 4,16.418278 4,12 C4,7.581722 7.581722,4 12,4 Z" fill="currentColor" fill-rule="nonzero" opacity="0.4" transform="translate(12.000000, 12.000000) scale(-1, 1) translate(-12.000000, -12.000000) "/></g></svg>
            <span>Betöltés folyamatban</span>
        </div>
        <div id="tab-overview" class="tab__content flex-col card gap-1" style="background: transparent; padding: 0;"></div>
        <div id="tab-cart" class="tab__content flex-col card gap-1" style="background: transparent; padding: 0;"></div>
        <div id="tab-bookmarks" class="tab__content flex-col card gap-1" style="background: transparent; padding: 0;"></div>
        <div id="tab-feedbacks" class="tab__content flex-col card gap-1" style="background: transparent; padding: 0;"></div>
        <div id="tab-crediting" class="tab__content flex-col card gap-1" style="background: transparent; padding: 0;"></div>
        <div id="tab-privilege" class="tab__content flex-col card gap-1" style="background: transparent; padding: 0;"></div>
        <div id="tab-delete" class="tab__content flex-col card gap-1" style="background: transparent; padding: 0;"></div>
        <div id="tab-log" class="tab__content flex-col card gap-1" style="background: transparent; padding: 0;"></div>
    </div>
</div>
</main>
<script>
var bal__to__form = document.getElementsByClassName('money__form'); for (let i = 0; i < bal__to__form.length; i++) { bal__to__form[i].textContent = formatter.format(bal__to__form[i].getAttribute('default-data')); }
</script>
<script src="/assets/script/admin/users.js" content-type="application/javascript"></script>
<script content-type="application/javascript">
<?php
    $bs_sql = "SELECT id FROM cart WHERE uid = ".$guid.""; $bs_res = $con-> query($bs_sql); if ($bs_res->num_rows > 0) { echo 'document.getElementById("tabs-cart").innerHTML += `<div class="label label-primary border-soft-light absolute right-5 center-y">'.$bs_res->num_rows.'</div>`;'; }
    $bm_sql = "SELECT id FROM bookmarks WHERE uid = ".$guid.""; $bm_res = $con-> query($bm_sql); if ($bm_res->num_rows > 0) { echo 'document.getElementById("tabs-bookmarks").innerHTML += `<div class="label label-primary border-soft-light absolute right-5 center-y">'.$bm_res->num_rows.'</div>`;'; }
    $fd_sql = "SELECT id FROM feedbacks WHERE uid = ".$guid.""; $fd_res = $con-> query($fd_sql); if ($fd_res->num_rows > 0) { echo 'document.getElementById("tabs-feedbacks").innerHTML += `<div class="label label-primary border-soft-light absolute right-5 center-y">'.$fd_res->num_rows.'</div>`;'; }
    $cr_sql = "SELECT id FROM customers__transactions WHERE item LIKE 'cr_%' AND uid = ".$guid.""; $cr_res = $con-> query($cr_sql); if ($cr_res->num_rows > 0) { echo 'document.getElementById("tabs-crediting").innerHTML += `<div class="label label-primary border-soft-light absolute right-5 center-y">'.$cr_res->num_rows .'</div>`;'; }
    $ac_sql = "SELECT id FROM log WHERE uid = ".$guid.""; $ac_res = $con-> query($ac_sql); if ($ac_res->num_rows > 0) { echo 'document.getElementById("tabs-log").innerHTML += `<div class="label label-primary border-soft-light absolute right-5 center-y">'.$ac_res->num_rows .'</div>`;'; }
?>
</script>
<?php require_once($_SERVER['DOCUMENT_ROOT'].'/includes/footer.php'); ?>