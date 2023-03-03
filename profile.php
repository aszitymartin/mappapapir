<?php require_once($_SERVER['DOCUMENT_ROOT'].'/includes/header.php'); if (!isset($_SESSION['loggedin'])) { echo "<script>window.location.href='/';</script>"; die(); }
    $stmt = $con->prepare('SELECT privilege FROM customers__priv  WHERE uid = ?'); if (isset($_SESSION['loggedin'])) {$id = $_SESSION['id'];} $stmt->bind_param('i', $id);$stmt->execute(); $stmt->bind_result($privilege); $stmt->fetch();$stmt->close();
    function get_time_ago( $time ) {
        $time_difference = time() - $time;
        if( $time_difference < 1 ) { return '< 1mp'; }
        $condition = array( 12 * 30 * 24 * 60 * 60 =>  'éve',30 * 24 * 60 * 60 => 'hónapja',24 * 60 * 60 => 'napja',60 * 60 =>  'órája',60 =>  'perce',1 =>  'másodperce');
        foreach( $condition as $secs => $str ) {$d = $time_difference / $secs;if( $d >= 1 ) {$t = round( $d );return $t . ' ' . $str . ( $t > 1 ? '' : '' ) . '';}}
    }
?>
<script>var formatter = new Intl.NumberFormat('hu-HU', {style: 'currency',currency: 'HUF',maximumFractionDigits: 0,minimumFractionDigits: 0}); var guid = <?= $id; ?></script>
<main>
<div class="prod-con" id="tabs">
    <div class="leftcolumn">
        <div class="card border-soft box-shadow relative">
            <div class="flex flex-row flex-align-c flex-justify-con-c gap-1 w-100">
                <div class="flex flex-row">
                    <img src="/assets/images/blank.png" class="border-soft box-shadow" style="border: 3px solid #fff; width: 120px; height: 120px;">
                </div>
                <div class="flex flex-col gap-05">
                    <div class="flex flex-col">
                        <div class="flex flex-row flex-align-c gap-05">
                            <span class="text-primary larger bold" id="tab__fullname"><?php echo $fullname; ?></span>
                        </div>
                        <span class="text-secondary small-med text-align-c" id="tab__email"><?php echo $email; ?></span>
                    </div>
                    <div class="flex flex-row flex-align-c flex-justify-con-c gap-1 background-bg padding-05 border-soft">
                    <?php $uid = $_SESSION['id']; $allcurval = 0;
                    $pr_sql = "SELECT customers__card.cid, customers__card.cardname, customers__card.cardnum, customers__card.expiry, customers__card.value, customers__card__info.holder FROM customers__card INNER JOIN customers__card__info ON customers__card__info.cid = customers__card.cid WHERE customers__card.uid = $uid"; 
                    $pr_res = $con-> query($pr_sql);
                    if ($pr_res-> num_rows > 0) { $subtot = 0; while ($card = $pr_res-> fetch_assoc()) { $allcurval += $card['value']; } }
                    ?>
                        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width=".8rem" height=".8rem" viewBox="0 0 24 24" version="1.1"><g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"><rect x="0" y="0" width="24" height="24"/><circle class="svg" opacity="0.3" cx="20.5" cy="12.5" r="1.5"/><rect class="svg" opacity="0.3" transform="translate(12.000000, 6.500000) rotate(-15.000000) translate(-12.000000, -6.500000) " x="3" y="3" width="18" height="7" rx="1"/><path d="M22,9.33681558 C21.5453723,9.12084552 21.0367986,9 20.5,9 C18.5670034,9 17,10.5670034 17,12.5 C17,14.4329966 18.5670034,16 20.5,16 C21.0367986,16 21.5453723,15.8791545 22,15.6631844 L22,18 C22,19.1045695 21.1045695,20 20,20 L4,20 C2.8954305,20 2,19.1045695 2,18 L2,6 C2,4.8954305 2.8954305,4 4,4 L20,4 C21.1045695,4 22,4.8954305 22,6 L22,9.33681558 Z" class="svg"/></g></svg>
                        <span class="text-primary bold small-med user-select-none" id="pr__balance"></span>
                    </div>
                </div>
            </div><br>
            <div class="flex flex-col">
                <div class="flex flex-col gap-05">
                    <?php
                        if ($stmt = $con->prepare('SELECT * FROM u__email WHERE uid = ?')) { $stmt->bind_param('i', $uid); $stmt->execute(); $result = $stmt->get_result(); $data = $result->fetch_assoc();
                            if ($data['valid'] == false) {
                                echo '
                                <div class="flex flex-row flex-align-c flex-justify-con-sb padding-05 gap-1 border-soft danger-bg">
                                    <div class="smaller-light">Email-címének hitelesítése még nem történt meg. Email-címének megerősítésével lehetősége nyílik, hogy fiókját vissza tudja állítani.</div>
                                </div>
                                ';
                            }
                        }
                        if (!isset($_COOKIE['__al__oupw'])) { 
                            if ($stmt = $con->prepare('SELECT date FROM u__password WHERE uid = ?')) { $stmt->bind_param('i', $uid); $stmt->execute(); $result = $stmt->get_result(); $data = $result->fetch_assoc();
                                $myDate = date("Y-m-d", strtotime( date( "Y-m-d", strtotime( date("Y-m-d") ) ) . "-1 month" ) );
                                if (strtotime($data['date']) <= strtotime($myDate)) {
                                    echo '
                                    <div class="flex flex-row flex-align-c flex-justify-con-sb padding-05 gap-1 border-soft warning-bg" alert-id="outdpw">
                                        <div class="smaller-light">Jelszava több, mint 1 hónapja nem lett megváltoztatva. Fiókja biztonságának növelése érdekében javasoljuk, hogy rendszeresen változtassa meg jelszavát.</div>
                                        <div class="flex pointer" aria-label="Bezárás" id="outdpw" onclick="cls__alert(this.id)">
                                            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="18px" height="18px" viewBox="0 0 24 24" version="1.1"><g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"><rect x="0" y="0" width="24" height="24"/><circle fill="#e29702" opacity="0.3" cx="12" cy="12" r="10"/><path d="M12.0355339,10.6213203 L14.863961,7.79289322 C15.2544853,7.40236893 15.8876503,7.40236893 16.2781746,7.79289322 C16.6686989,8.18341751 16.6686989,8.81658249 16.2781746,9.20710678 L13.4497475,12.0355339 L16.2781746,14.863961 C16.6686989,15.2544853 16.6686989,15.8876503 16.2781746,16.2781746 C15.8876503,16.6686989 15.2544853,16.6686989 14.863961,16.2781746 L12.0355339,13.4497475 L9.20710678,16.2781746 C8.81658249,16.6686989 8.18341751,16.6686989 7.79289322,16.2781746 C7.40236893,15.8876503 7.40236893,15.2544853 7.79289322,14.863961 L10.6213203,12.0355339 L7.79289322,9.20710678 C7.40236893,8.81658249 7.40236893,8.18341751 7.79289322,7.79289322 C8.18341751,7.40236893 8.81658249,7.40236893 9.20710678,7.79289322 L12.0355339,10.6213203 Z" fill="#e29702"/></g></svg>
                                        </div>
                                    </div>
                                    ';
                                }
                            }
                        }
                        if (!isset($_COOKIE['__al__emrem'])) { 
                            if ($stmt = $con->prepare('SELECT email,date FROM u__email WHERE uid = ?')) { $stmt->bind_param('i', $uid); $stmt->execute(); $result = $stmt->get_result(); $data = $result->fetch_assoc();
                                $myDate = date("Y-m-d", strtotime( date( "Y-m-d", strtotime( date("Y-m-d") ) ) . "-3 month" ) );
                                if (strtotime($data['date']) <= strtotime($myDate)) {
                                    echo '
                                    <div class="flex flex-row flex-align-c flex-justify-con-sb padding-05 gap-1 border-soft warning-bg" alert-id="outdem">
                                        <div class="smaller-light"><b><em>'.$data['email'].'</em></b> email címet használja már több, mint 6 hónapja. Ha még mindig az említett email címet használja, hagyja figyelmen kívűl ezt az értesítést, viszont amennyiben mér nem fér hozzá az email címéhez, <a class="link bold pointer user-select-none" id="ch__email">itt tudja megváltoztatni</a>.</div>
                                        <div class="flex pointer" aria-label="Bezárás" id="outdem" onclick="cls__alert(this.id)">
                                            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="18px" height="18px" viewBox="0 0 24 24" version="1.1"><g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"><rect x="0" y="0" width="24" height="24"/><circle fill="#e29702" opacity="0.3" cx="12" cy="12" r="10"/><path d="M12.0355339,10.6213203 L14.863961,7.79289322 C15.2544853,7.40236893 15.8876503,7.40236893 16.2781746,7.79289322 C16.6686989,8.18341751 16.6686989,8.81658249 16.2781746,9.20710678 L13.4497475,12.0355339 L16.2781746,14.863961 C16.6686989,15.2544853 16.6686989,15.8876503 16.2781746,16.2781746 C15.8876503,16.6686989 15.2544853,16.6686989 14.863961,16.2781746 L12.0355339,13.4497475 L9.20710678,16.2781746 C8.81658249,16.6686989 8.18341751,16.6686989 7.79289322,16.2781746 C7.40236893,15.8876503 7.40236893,15.2544853 7.79289322,14.863961 L10.6213203,12.0355339 L7.79289322,9.20710678 C7.40236893,8.81658249 7.40236893,8.18341751 7.79289322,7.79289322 C8.18341751,7.40236893 8.81658249,7.40236893 9.20710678,7.79289322 L12.0355339,10.6213203 Z" fill="#e29702"/></g></svg>
                                        </div>
                                    </div>
                                    ';
                                }
                            }
                        }
                    ?>
                </div><hr style="border: 1px solid var(--background);" class="w-100">
                <div class="flex flex-col gap-1">
                    <div class="flex flex-row flex-align-c gap-1">
                        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="1rem" height="1rem" viewBox="0 0 24 24" version="1.1"><g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"><rect x="0" y="0" width="24" height="24"/><rect class="svg" opacity="0.3" x="2" y="2" width="20" height="20" rx="10"/><path d="M6.16794971,14.5547002 C5.86159725,14.0951715 5.98577112,13.4743022 6.4452998,13.1679497 C6.90482849,12.8615972 7.52569784,12.9857711 7.83205029,13.4452998 C8.9890854,15.1808525 10.3543313,16 12,16 C13.6456687,16 15.0109146,15.1808525 16.1679497,13.4452998 C16.4743022,12.9857711 17.0951715,12.8615972 17.5547002,13.1679497 C18.0142289,13.4743022 18.1384028,14.0951715 17.8320503,14.5547002 C16.3224187,16.8191475 14.3543313,18 12,18 C9.64566871,18 7.67758127,16.8191475 6.16794971,14.5547002 Z" class="svg"/></g></svg>
                        <span class="text-primary small-med bold" id="tab__company"><?php echo $company; ?></span>
                    </div>
                    <div class="flex flex-row flex-align-c gap-1">
                        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="1rem" height="1rem" viewBox="0 0 24 24" version="1.1"><g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"><rect x="0" y="0" width="24" height="24"/><path d="M5,10.5 C5,6 8,3 12.5,3 C17,3 20,6.75 20,10.5 C20,12.8325623 17.8236613,16.03566 13.470984,20.1092932 C12.9154018,20.6292577 12.0585054,20.6508331 11.4774555,20.1594925 C7.15915182,16.5078313 5,13.2880005 5,10.5 Z M12.5,12 C13.8807119,12 15,10.8807119 15,9.5 C15,8.11928813 13.8807119,7 12.5,7 C11.1192881,7 10,8.11928813 10,9.5 C10,10.8807119 11.1192881,12 12.5,12 Z" class="svg" fill-rule="nonzero"/></g></svg>
                        <span class="text-primary small-med bold" id="tab__location"><?php echo $postal .' '. $settlement .', '. $address; ?></span>
                    </div>
                    <div class="flex flex-row flex-align-c gap-1">
                        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="1rem" height="1rem" viewBox="0 0 24 24" version="1.1"><g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"><rect x="0" y="0" width="24" height="24"></rect><path d="M11.914857,14.1427403 L14.1188827,11.9387145 C14.7276032,11.329994 14.8785122,10.4000511 14.4935235,9.63007378 L14.3686433,9.38031323 C13.9836546,8.61033591 14.1345636,7.680393 14.7432841,7.07167248 L17.4760882,4.33886839 C17.6713503,4.14360624 17.9879328,4.14360624 18.183195,4.33886839 C18.2211956,4.37686904 18.2528214,4.42074752 18.2768552,4.46881498 L19.3808309,6.67676638 C20.2253855,8.3658756 19.8943345,10.4059034 18.5589765,11.7412615 L12.560151,17.740087 C11.1066115,19.1936265 8.95659008,19.7011777 7.00646221,19.0511351 L4.5919826,18.2463085 C4.33001094,18.1589846 4.18843095,17.8758246 4.27575484,17.613853 C4.30030124,17.5402138 4.34165566,17.4733009 4.39654309,17.4184135 L7.04781491,14.7671417 C7.65653544,14.1584211 8.58647835,14.0075122 9.35645567,14.3925008 L9.60621621,14.5173811 C10.3761935,14.9023698 11.3061364,14.7514608 11.914857,14.1427403 Z" class="svg"></path></g></svg>
                        <span class="text-primary small-med bold" id="pr__phone"></span>
                    </div>
                </div><hr style="border: 1px solid var(--background);" class="w-100">
                <div class="flex flex-col gap-05 padding-1 prfc__con">
                    <ul class="flex flex-col gap-05 user-select-none">
                        <li><a>
                            <div class="flex flex-row flex-align-c padding-05 border-soft gap-1 pointer prfc__item prfc__item__active" onclick="showPanel(event, 'tab-overview')" id="tabs-overview" tab-data="overview">
                                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1"><g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"><polygon points="0 0 24 0 24 24 0 24"></polygon><path d="M12.9336061,16.072447 L19.36,10.9564761 L19.5181585,10.8312381 C20.1676248,10.3169571 20.2772143,9.3735535 19.7629333,8.72408713 C19.6917232,8.63415859 19.6104327,8.55269514 19.5206557,8.48129411 L12.9336854,3.24257445 C12.3871201,2.80788259 11.6128799,2.80788259 11.0663146,3.24257445 L4.47482784,8.48488609 C3.82645598,9.00054628 3.71887192,9.94418071 4.23453211,10.5925526 C4.30500305,10.6811601 4.38527899,10.7615046 4.47382636,10.8320511 L4.63,10.9564761 L11.0659024,16.0730648 C11.6126744,16.5077525 12.3871218,16.5074963 12.9336061,16.072447 Z" class="svg-blank" fill-rule="nonzero"></path><path d="M11.0563554,18.6706981 L5.33593024,14.122919 C4.94553994,13.8125559 4.37746707,13.8774308 4.06710397,14.2678211 C4.06471678,14.2708238 4.06234874,14.2738418 4.06,14.2768747 L4.06,14.2768747 C3.75257288,14.6738539 3.82516916,15.244888 4.22214834,15.5523151 C4.22358765,15.5534297 4.2250303,15.55454 4.22647627,15.555646 L11.0872776,20.8031356 C11.6250734,21.2144692 12.371757,21.2145375 12.909628,20.8033023 L19.7677785,15.559828 C20.1693192,15.2528257 20.2459576,14.6784381 19.9389553,14.2768974 C19.9376429,14.2751809 19.9363245,14.2734691 19.935,14.2717619 L19.935,14.2717619 C19.6266937,13.8743807 19.0546209,13.8021712 18.6572397,14.1104775 C18.654352,14.112718 18.6514778,14.1149757 18.6486172,14.1172508 L12.9235044,18.6705218 C12.377022,19.1051477 11.6029199,19.1052208 11.0563554,18.6706981 Z" class="svg-blank" opacity="0.3"></path></g></svg>
                                <span class="small">Profil Áttekintése</span>
                            </div>
                        </a></li>
                        <li><a>
                            <div class="flex flex-row flex-align-c padding-05 border-soft gap-1 pointer prfc__item" onclick="showPanel(event, 'tab-personal')" id="tabs-personal" tab-data="personal">
                                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1"><g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"><polygon points="0 0 24 0 24 24 0 24"></polygon><path d="M12,11 C9.790861,11 8,9.209139 8,7 C8,4.790861 9.790861,3 12,3 C14.209139,3 16,4.790861 16,7 C16,9.209139 14.209139,11 12,11 Z" class="svg-blank" fill-rule="nonzero" opacity="0.3"></path><path d="M3.00065168,20.1992055 C3.38825852,15.4265159 7.26191235,13 11.9833413,13 C16.7712164,13 20.7048837,15.2931929 20.9979143,20.2 C21.0095879,20.3954741 20.9979143,21 20.2466999,21 C16.541124,21 11.0347247,21 3.72750223,21 C3.47671215,21 2.97953825,20.45918 3.00065168,20.1992055 Z" class="svg-blank" fill-rule="nonzero"></path></g></svg>
                                <span class="small">Személyes Információk</span>
                            </div>
                        </a></li>
                        <li><a>
                            <div class="flex flex-row flex-align-c padding-05 border-soft gap-1 pointer prfc__item" onclick="showPanel(event, 'tab-account')" id="tabs-account" tab-data="account">
                                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1"><g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"><rect x="0" y="0" width="24" height="24"></rect><path d="M2.56066017,10.6819805 L4.68198052,8.56066017 C5.26776695,7.97487373 6.21751442,7.97487373 6.80330086,8.56066017 L8.9246212,10.6819805 C9.51040764,11.267767 9.51040764,12.2175144 8.9246212,12.8033009 L6.80330086,14.9246212 C6.21751442,15.5104076 5.26776695,15.5104076 4.68198052,14.9246212 L2.56066017,12.8033009 C1.97487373,12.2175144 1.97487373,11.267767 2.56066017,10.6819805 Z M14.5606602,10.6819805 L16.6819805,8.56066017 C17.267767,7.97487373 18.2175144,7.97487373 18.8033009,8.56066017 L20.9246212,10.6819805 C21.5104076,11.267767 21.5104076,12.2175144 20.9246212,12.8033009 L18.8033009,14.9246212 C18.2175144,15.5104076 17.267767,15.5104076 16.6819805,14.9246212 L14.5606602,12.8033009 C13.9748737,12.2175144 13.9748737,11.267767 14.5606602,10.6819805 Z" class="svg-blank" opacity="0.3"></path><path d="M8.56066017,16.6819805 L10.6819805,14.5606602 C11.267767,13.9748737 12.2175144,13.9748737 12.8033009,14.5606602 L14.9246212,16.6819805 C15.5104076,17.267767 15.5104076,18.2175144 14.9246212,18.8033009 L12.8033009,20.9246212 C12.2175144,21.5104076 11.267767,21.5104076 10.6819805,20.9246212 L8.56066017,18.8033009 C7.97487373,18.2175144 7.97487373,17.267767 8.56066017,16.6819805 Z M8.56066017,4.68198052 L10.6819805,2.56066017 C11.267767,1.97487373 12.2175144,1.97487373 12.8033009,2.56066017 L14.9246212,4.68198052 C15.5104076,5.26776695 15.5104076,6.21751442 14.9246212,6.80330086 L12.8033009,8.9246212 C12.2175144,9.51040764 11.267767,9.51040764 10.6819805,8.9246212 L8.56066017,6.80330086 C7.97487373,6.21751442 7.97487373,5.26776695 8.56066017,4.68198052 Z" class="svg-blank"></path></g></svg>
                                <span class="small">Fiók Információk</span>
                            </div>
                        </a></li>
                        <li><a>
                            <div class="flex flex-row flex-align-c padding-05 border-soft gap-1 pointer prfc__item relative" onclick="showPanel(event, 'tab-face')" id="tabs-face" tab-data="face">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"><path opacity="0.3" d="M3 6C2.4 6 2 5.6 2 5V3C2 2.4 2.4 2 3 2H5C5.6 2 6 2.4 6 3C6 3.6 5.6 4 5 4H4V5C4 5.6 3.6 6 3 6ZM22 5V3C22 2.4 21.6 2 21 2H19C18.4 2 18 2.4 18 3C18 3.6 18.4 4 19 4H20V5C20 5.6 20.4 6 21 6C21.6 6 22 5.6 22 5ZM6 21C6 20.4 5.6 20 5 20H4V19C4 18.4 3.6 18 3 18C2.4 18 2 18.4 2 19V21C2 21.6 2.4 22 3 22H5C5.6 22 6 21.6 6 21ZM22 21V19C22 18.4 21.6 18 21 18C20.4 18 20 18.4 20 19V20H19C18.4 20 18 20.4 18 21C18 21.6 18.4 22 19 22H21C21.6 22 22 21.6 22 21ZM16 11V9C16 6.8 14.2 5 12 5C9.8 5 8 6.8 8 9V11C7.2 11 6.5 11.7 6.5 12.5C6.5 13.3 7.2 14 8 14V15C8 17.2 9.8 19 12 19C14.2 19 16 17.2 16 15V14C16.8 14 17.5 13.3 17.5 12.5C17.5 11.7 16.8 11 16 11ZM13.4 15C13.7 15 14 15.3 13.9 15.6C13.6 16.4 12.9 17 12 17C11.1 17 10.4 16.5 10.1 15.7C10 15.4 10.2 15 10.6 15H13.4Z" class="svg-blank"/><path d="M9.2 12.9C9.1 12.8 9.10001 12.7 9.10001 12.6C9.00001 12.2 9.3 11.7 9.7 11.6C10.1 11.5 10.6 11.8 10.7 12.2C10.7 12.3 10.7 12.4 10.7 12.5L9.2 12.9ZM14.8 12.9C14.9 12.8 14.9 12.7 14.9 12.6C15 12.2 14.7 11.7 14.3 11.6C13.9 11.5 13.4 11.8 13.3 12.2C13.3 12.3 13.3 12.4 13.3 12.5L14.8 12.9ZM16 7.29998C16.3 6.99998 16.5 6.69998 16.7 6.29998C16.3 6.29998 15.8 6.30001 15.4 6.20001C15 6.10001 14.7 5.90001 14.4 5.70001C13.8 5.20001 13 5.00002 12.2 4.90002C9.9 4.80002 8.10001 6.79997 8.10001 9.09997V11.4C8.90001 10.7 9.40001 9.8 9.60001 9C11 9.1 13.4 8.69998 14.5 8.29998C14.7 9.39998 15.3 10.5 16.1 11.4V9C16.1 8.5 16 8 15.8 7.5C15.8 7.5 15.9 7.39998 16 7.29998Z" class="svg-blank"/></svg>
                                <span class="small">Arcfelismerés</span>
                                <div class="label label-warning border-soft-light absolute right-5 center-y">Béta</div>
                            </div>
                        </a></li>
                        <li><a>
                            <div class="flex flex-row flex-align-c padding-05 border-soft gap-1 pointer prfc__item relative" onclick="showPanel(event, 'tab-security')" id="tabs-security" tab-data="security">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"><rect opacity="0.3" x="2" y="2" width="20" height="20" rx="10" class="svg-blank"/><path d="M15.8054 11.639C15.6757 11.5093 15.5184 11.4445 15.3331 11.4445H15.111V10.1111C15.111 9.25927 14.8055 8.52784 14.1944 7.91672C13.5833 7.30557 12.8519 7 12 7C11.148 7 10.4165 7.30557 9.80547 7.9167C9.19432 8.52784 8.88885 9.25924 8.88885 10.1111V11.4445H8.66665C8.48153 11.4445 8.32408 11.5093 8.19444 11.639C8.0648 11.7685 8 11.926 8 12.1112V16.1113C8 16.2964 8.06482 16.4539 8.19444 16.5835C8.32408 16.7131 8.48153 16.7779 8.66665 16.7779H15.3333C15.5185 16.7779 15.6759 16.7131 15.8056 16.5835C15.9351 16.4539 16 16.2964 16 16.1113V12.1112C16.0001 11.926 15.9351 11.7686 15.8054 11.639ZM13.7777 11.4445H10.2222V10.1111C10.2222 9.6204 10.3958 9.20138 10.7431 8.85421C11.0903 8.507 11.5093 8.33343 12 8.33343C12.4909 8.33343 12.9097 8.50697 13.257 8.85421C13.6041 9.20135 13.7777 9.6204 13.7777 10.1111V11.4445Z" class="svg-blank"/></svg>
                                <span class="small">Biztonság</span>
                            </div>
                        </a></li>
                        <li><a>
                            <div class="flex flex-row flex-align-c padding-05 border-soft gap-1 pointer prfc__item relative" onclick="showPanel(event, 'tab-password')" id="tabs-password" tab-data="password">
                                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1"><g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"><rect x="0" y="0" width="24" height="24"></rect><path d="M4,4 L11.6314229,2.5691082 C11.8750185,2.52343403 12.1249815,2.52343403 12.3685771,2.5691082 L20,4 L20,13.2830094 C20,16.2173861 18.4883464,18.9447835 16,20.5 L12.5299989,22.6687507 C12.2057287,22.8714196 11.7942713,22.8714196 11.4700011,22.6687507 L8,20.5 C5.51165358,18.9447835 4,16.2173861 4,13.2830094 L4,4 Z" class="svg-blank" opacity="0.3"></path><path d="M12,11 C10.8954305,11 10,10.1045695 10,9 C10,7.8954305 10.8954305,7 12,7 C13.1045695,7 14,7.8954305 14,9 C14,10.1045695 13.1045695,11 12,11 Z" class="svg-blank" opacity="0.3"></path><path d="M7.00036205,16.4995035 C7.21569918,13.5165724 9.36772908,12 11.9907452,12 C14.6506758,12 16.8360465,13.4332455 16.9988413,16.5 C17.0053266,16.6221713 16.9988413,17 16.5815,17 C14.5228466,17 11.463736,17 7.4041679,17 C7.26484009,17 6.98863236,16.6619875 7.00036205,16.4995035 Z" class="svg-blank" opacity="0.3"></path></g></svg>
                                <span class="small">Jelszó kezelése</span>
                                <?php
                                    if ($stmt = $con->prepare('SELECT date FROM u__password WHERE uid = ?')) { $stmt->bind_param('i', $uid); $stmt->execute(); $result = $stmt->get_result(); $data = $result->fetch_assoc();
                                        $myDate = date("Y-m-d", strtotime( date( "Y-m-d", strtotime( date("Y-m-d") ) ) . "-1 month" ) );
                                        if (strtotime($data['date']) <= strtotime($myDate)) {
                                            echo '<span class="badge badge-small padding-0 badge-warning center-y right-5 absolute" id="tbp__pass__ind"></span>';
                                        }
                                    }
                                ?>
                            </div>
                        </a></li>
                        <li><a>
                            <div class="flex flex-row flex-align-c padding-05 border-soft gap-1 pointer prfc__item relative" onclick="showPanel(event, 'tab-email')" id="tabs-email" tab-data="email">
                                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1"><g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"><rect x="0" y="0" width="24" height="24"></rect><path d="M6,2 L18,2 C18.5522847,2 19,2.44771525 19,3 L19,12 C19,12.5522847 18.5522847,13 18,13 L6,13 C5.44771525,13 5,12.5522847 5,12 L5,3 C5,2.44771525 5.44771525,2 6,2 Z M7.5,5 C7.22385763,5 7,5.22385763 7,5.5 C7,5.77614237 7.22385763,6 7.5,6 L13.5,6 C13.7761424,6 14,5.77614237 14,5.5 C14,5.22385763 13.7761424,5 13.5,5 L7.5,5 Z M7.5,7 C7.22385763,7 7,7.22385763 7,7.5 C7,7.77614237 7.22385763,8 7.5,8 L10.5,8 C10.7761424,8 11,7.77614237 11,7.5 C11,7.22385763 10.7761424,7 10.5,7 L7.5,7 Z" class="svg-blank" opacity="0.3"></path><path d="M3.79274528,6.57253826 L12,12.5 L20.2072547,6.57253826 C20.4311176,6.4108595 20.7436609,6.46126971 20.9053396,6.68513259 C20.9668779,6.77033951 21,6.87277228 21,6.97787787 L21,17 C21,18.1045695 20.1045695,19 19,19 L5,19 C3.8954305,19 3,18.1045695 3,17 L3,6.97787787 C3,6.70173549 3.22385763,6.47787787 3.5,6.47787787 C3.60510559,6.47787787 3.70753836,6.51099993 3.79274528,6.57253826 Z" class="svg-blank"></path></g></svg>
                                <span class="small">Email beállítások</span>
                                <?php
                                    if ($stmt = $con->prepare('SELECT * FROM u__email WHERE uid = ?')) { $stmt->bind_param('i', $uid); $stmt->execute(); $result = $stmt->get_result(); $data = $result->fetch_assoc();
                                        if ($data['valid'] == false) {
                                            echo '<span class="badge badge-small padding-0 badge-danger right-5 center-y absolute"></span>';
                                        }
                                    }
                                ?>
                            </div>
                        </a></li>
                        <li><a>
                            <div class="flex flex-row flex-align-c padding-05 border-soft gap-1 pointer prfc__item relative" onclick="showPanel(event, 'tab-credit')" id="tabs-credit" tab-data="credit">
                                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1"><g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"><rect x="0" y="0" width="24" height="24"></rect><rect class="svg-blank" x="2" y="5" width="19" height="4" rx="1"></rect><rect class="svg-blank" opacity="0.3" x="2" y="11" width="19" height="10" rx="1"></rect></g></svg>
                                <span class="small">Mentett kártyák</span>
                            </div>
                        </a></li>
                        <li><a>
                            <div class="flex flex-row flex-align-c padding-05 border-soft gap-1 pointer prfc__item relative" onclick="showPanel(event, 'tab-invoice')" id="tabs-invoice" tab-data="invoice">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"><path opacity="0.3" d="M3 3V17H7V21H15V9H20V3H3Z" fill="currentColor"/><path d="M20 22H3C2.4 22 2 21.6 2 21V3C2 2.4 2.4 2 3 2H20C20.6 2 21 2.4 21 3V21C21 21.6 20.6 22 20 22ZM19 4H4V8H19V4ZM6 18H4V20H6V18ZM6 14H4V16H6V14ZM6 10H4V12H6V10ZM10 18H8V20H10V18ZM10 14H8V16H10V14ZM10 10H8V12H10V10ZM14 18H12V20H14V18ZM14 14H12V16H14V14ZM14 10H12V12H14V10ZM19 14H17V20H19V14ZM19 10H17V12H19V10Z" class="svg-blank"/></svg>
                                <span class="small">Számláim</span>
                                <div class="label label-primary border-soft-light absolute right-5 center-y">Új</div>
                            </div>
                        </a></li>
                        <li><a>
                            <div class="flex flex-row flex-align-c padding-05 border-soft gap-1 pointer prfc__item relative" onclick="showPanel(event, 'tab-deactivate')" id="tabs-deactivate" tab-data="deactivate">
                                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1"><g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"><rect x="0" y="0" width="24" height="24"/><path d="M7.62302337,5.30262097 C8.08508802,5.000107 8.70490146,5.12944838 9.00741543,5.59151303 C9.3099294,6.05357769 9.18058801,6.67339112 8.71852336,6.97590509 C7.03468892,8.07831239 6,9.95030239 6,12 C6,15.3137085 8.6862915,18 12,18 C15.3137085,18 18,15.3137085 18,12 C18,9.99549229 17.0108275,8.15969002 15.3875704,7.04698597 C14.9320347,6.73472706 14.8158858,6.11230651 15.1281448,5.65677076 C15.4404037,5.20123501 16.0628242,5.08508618 16.51836,5.39734508 C18.6800181,6.87911023 20,9.32886071 20,12 C20,16.418278 16.418278,20 12,20 C7.581722,20 4,16.418278 4,12 C4,9.26852332 5.38056879,6.77075716 7.62302337,5.30262097 Z" class="svg-blank" fill-rule="nonzero"/><rect class="svg-blank" opacity="0.3" x="11" y="3" width="2" height="10" rx="1"/></g></svg>
                                <span class="small">Felfüggesztés</span>
                            </div>
                        </a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <div class="spancolumn">
        <div id="tab-overview" class="tab__content flex-col card gap-1" style="background: transparent; padding: 0;"></div>
        <div id="tab-personal" class="tab__content flex-col card gap-1" style="background: transparent; padding: 0;"></div>
        <div id="tab-account" class="tab__content flex-col card gap-1" style="background: transparent; padding: 0;"></div>
        <div id="tab-face" class="tab__content flex-col card gap-1" style="background: transparent; padding: 0;"></div>
        <div id="tab-security" class="tab__content flex-col card gap-1" style="background: transparent; padding: 0;"></div>
        <div id="tab-password" class="tab__content flex-col card gap-1" style="background: transparent; padding: 0;"></div>
        <div id="tab-email" class="tab__content flex-col card gap-1" style="background: transparent; padding: 0;"></div>
        <div id="tab-credit" class="tab__content flex-col card gap-1" style="background: transparent; padding: 0;"></div>
        <div id="tab-invoice" class="tab__content flex-col card gap-1" style="background: transparent; padding: 0;"></div>
        <div id="tab-deactivate" class="tab__content flex-col card gap-1" style="background: transparent; padding: 0;"></div>
    </div>
</div>
</main>
<script>
const matches = []; const county = { budapest: {name: "Budapest", minmax: [1011,1806]},__pest: {name: "Pest", minmax: [2000, 2760]},__fejer: {name: "Fejér", minmax: [2400, 2490]},__fejer2: {name: "Fejér", minmax: [8000, 8157]},__komarom: {name: "Komárom-Esztergom", minmax: [2500,2545]},__komarom2: {name: "Komárom-Esztergom", minmax: [2800, 2949]},__nograd: {name: "Nógrád", minmax: [2640, 2699]},__nograd2: {name: "Nógrád", minmax: [3041, 3253]},__heves: {name: "Heves", minmax: [3000, 3036]},__heves2: {name: "Heves", minmax: [3200, 3399]},__baz: {name: "Borsod-Abaúj-Zemplén", minmax: [3400, 3999]},__hajdu: {name: "Hajdú-Bihar", minmax: [4000, 4288]},__szabolcs: {name: "Szabolcs-Szatmár-Bereg", minmax: [4300, 4977]},__jasz: {name: "Jász-Nagykun-Szolnok", minmax: [5000, 5476]},__bekes: {name: "Békés", minmax: [5500, 5948]},__bacs: {name: "Bács-Kiskun", minmax: [6000, 6528]},__csongrad: {name: "Csongrád", minmax: [6600, 6932]},__tolna: {name: "Tolna", minmax: [7020, 7228]},__baranya: {name: "Baranya", minmax: [7300, 7396]},__baranya2: {name: "Baranya", minmax: [7600, 7985]},__somogy: {name: "Somogy", minmax: [7400, 7589]},__somogy2: {name: "Somogy", minmax: [8600, 8739]},__veszprem: {name: "Veszprém", minmax: [8161, 8598]},__zala: {name: "Zala", minmax: [8353, 8395]},__zala2: {name: "Zala", minmax: [8741, 8999]},__gyor: {name: "Győr-Moson-Sopron", minmax: [9001, 9495]},__vas: {name: "Vas", minmax: [9500, 9985]} };
var num__to__form = document.getElementsByClassName('phone__form'); for (let i = 0; i < num__to__form.length; i++) { num__to__form[i].textContent = "+36 " + num__to__form[i].getAttribute("default-data").slice(0, 2) + "/" + num__to__form[i].getAttribute("default-data").slice(2, 5) + "-" + num__to__form[i].getAttribute("default-data").slice(5, 9); }
var bal__to__form = document.getElementsByClassName('money__form'); for (let i = 0; i < bal__to__form.length; i++) { bal__to__form[i].textContent = formatter.format(bal__to__form[i].getAttribute('default-data')); }
</script>
<script>let phone = String(<?php echo $phone; ?>); document.getElementById('pr__balance').textContent = formatter.format(<?php echo $allcurval; ?>); document.getElementById('pr__phone').textContent = "+36 " + phone.slice(0, 2) + "/" + phone.slice(2, 5) + "-" + phone.slice(5, 9);</script>
<script src="/assets/script/profile/changes.js" content-type="application/javascript"></script>
<!-- <script src="/assets/script/profile/mn__history.js" content-type="application/javascript"></script> -->
<script src="/assets/script/profile/alerts.js" content-type="application/javascript"></script>
<?php require_once($_SERVER['DOCUMENT_ROOT'].'/includes/footer.php'); ?>