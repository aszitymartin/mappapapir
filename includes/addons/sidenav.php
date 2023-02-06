<?php session_start(); $DATABASE_HOST = 'localhost'; $DATABASE_USER = 'root'; $DATABASE_PASS = 'eKi=0630OG'; $DATABASE_NAME = 'mappapapir'; $con = mysqli_connect($DATABASE_HOST, $DATABASE_USER, $DATABASE_PASS, $DATABASE_NAME);
    if (mysqli_connect_errno()) { header ("Location: /500"); echo "<script>const now = new Date();const notifParams = { notifType : '1', notifIcon : '2', notifTheme : '2', notifTitle : 'Hiba', notifDesc : 'Szerver oldali hiba történt.', expiry : now.setSeconds(60) };localStorage.setItem('NP', JSON.stringify(notifParams));window.location.href= '../';</script>";}
    $stmt = $con->prepare('SELECT customers.id, customers.fullname, customers.email, customers__money.money FROM customers INNER JOIN customers__money ON customers__money.uid = customers.id WHERE customers.id = ?');
    if (isset($_SESSION['loggedin'])) {$id = $_SESSION['id'];} $stmt->bind_param('i', $id);$stmt->execute();$stmt->bind_result($id, $fullname, $email, $money);
    $stmt->fetch();$stmt->close();
?>
<script>var formatter = new Intl.NumberFormat('hu-HU', {style: 'currency',currency: 'HUF',maximumFractionDigits: 0,minimumFractionDigits: 0});</script>
<div class="sidenav-inner">
    <div class="sidenav-header flex flex-row flex-align-c flex-justify-con-sb">
        <span class="flex flex-col" onclick="window.location.href='/';">
            <span class="header_title_heading">Mappa Papír</span>
            <span class="header_title_desc">Minden ami írószer.</span>
        </span>
        <span class="flex">
            <span class="text-primary hide-on-desktop" onclick="closeSidenav()">
                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"><rect x="0" y="0" width="24" height="24"/><circle class="svg" opacity="0.3" cx="12" cy="12" r="10"/><path d="M12.0355339,10.6213203 L14.863961,7.79289322 C15.2544853,7.40236893 15.8876503,7.40236893 16.2781746,7.79289322 C16.6686989,8.18341751 16.6686989,8.81658249 16.2781746,9.20710678 L13.4497475,12.0355339 L16.2781746,14.863961 C16.6686989,15.2544853 16.6686989,15.8876503 16.2781746,16.2781746 C15.8876503,16.6686989 15.2544853,16.6686989 14.863961,16.2781746 L12.0355339,13.4497475 L9.20710678,16.2781746 C8.81658249,16.6686989 8.18341751,16.6686989 7.79289322,16.2781746 C7.40236893,15.8876503 7.40236893,15.2544853 7.79289322,14.863961 L10.6213203,12.0355339 L7.79289322,9.20710678 C7.40236893,8.81658249 7.40236893,8.18341751 7.79289322,7.79289322 C8.18341751,7.40236893 8.81658249,7.40236893 9.20710678,7.79289322 L12.0355339,10.6213203 Z" class="svg" /></g>
                </svg>
            </span>
        </span>
    </div>
    <div class="sidenav-body flex flex-col" id="sidenav-body">
        <span class="sidenav-search hide-on-desktop">
            <input type="search" name="sidenav-search" class="sidenav-search-input" id="sidenav-search" placeholder="Keresés" onkeyup="searchSettings()" />
        </span>
        <span class="sidenav-item sidenav-item-sb flex flex-row no-tm-des">
            <?php
                if (isset($_SESSION['loggedin'])) {
                    echo '
                    <div class="flex flex-col w-fa">
                        <span class="flex flex-row flex-align-c" id="profile" onclick="sidenavRedirect()">
                            <span class="sidenav-item-in flex">
                                <img src="/assets/images/svg/profile.png">
                            </span>
                            <span class="sidenav-item-in flex flex-col">
                                <span class="text-primary sidenav-item-primary">'. $fullname .'</span>
                                <span class="text-secondary sm-des">'. $email .'</span>
                            </span>
                        </span>
                    </div>
                    ';
                } else {
                    echo '
                    <span class="flex flex-row" id="login" onclick="loadWizard();">
                        <span class="sidenav-item-in flex">
                            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="48px" height="48px" viewBox="0 0 24 24" version="1.1">
                                <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"><polygon points="0 0 24 0 24 24 0 24"/><path d="M12,11 C9.790861,11 8,9.209139 8,7 C8,4.790861 9.790861,3 12,3 C14.209139,3 16,4.790861 16,7 C16,9.209139 14.209139,11 12,11 Z" class="svg" fill-rule="nonzero" opacity="0.3"/><path d="M3.00065168,20.1992055 C3.38825852,15.4265159 7.26191235,13 11.9833413,13 C16.7712164,13 20.7048837,15.2931929 20.9979143,20.2 C21.0095879,20.3954741 20.9979143,21 20.2466999,21 C16.541124,21 11.0347247,21 3.72750223,21 C3.47671215,21 2.97953825,20.45918 3.00065168,20.1992055 Z" class="svg" fill-rule="nonzero"/></g>
                            </svg>
                        </span>
                        <span class="sidenav-item-in flex flex-col">
                            <span class="text-primary sidenav-item-primary">Bejelentkezés</span>
                            <span class="text-secondary">Új felhasználó</span>
                        </span>
                    </span>
                ';
                }
            ?>
            <span class="sidenav-item-in flex flex-col">
                <span class="flex sidenav-notif-con relative" onclick="openSidenavAddons('notifications')">
                    <span class="badge badge-small sidenav-badge padding-0 flex flex-align-c flex-justify-con-c absolute box-shadow"></span>
                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                        <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"><path d="M17,12 L18.5,12 C19.3284271,12 20,12.6715729 20,13.5 C20,14.3284271 19.3284271,15 18.5,15 L5.5,15 C4.67157288,15 4,14.3284271 4,13.5 C4,12.6715729 4.67157288,12 5.5,12 L7,12 L7.5582739,6.97553494 C7.80974924,4.71225688 9.72279394,3 12,3 C14.2772061,3 16.1902508,4.71225688 16.4417261,6.97553494 L17,12 Z" class="svg" opacity=".3" /><rect class="svg" opacity="0.3" x="10" y="16" width="4" height="4" rx="2"/></g>
                    </svg>
                </span>
            </span>
        </span>
        <?php
            if (isset($_SESSION['loggedin'])) {
                if ($_SESSION['id'] == 1) {
                    echo '
                    <span class="sidenav-item sidenav-item-sb flex flex-row" onclick="staffMode()" style="margin: 0 !important;">
                        <span class="sidenav-item-group-item">
                            <span class="flex flex-row flex-align-c">
                                <span class="sidenav-item-in flex">
                                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="32px" height="32px" viewBox="0 0 24 24" version="1.1">
                                        <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                            <rect x="0" y="0" width="24" height="24"/>
                                            <polygon class="svg" opacity="0.3" transform="translate(8.885842, 16.114158) rotate(-315.000000) translate(-8.885842, -16.114158) " points="6.89784488 10.6187476 6.76452164 19.4882481 8.88584198 21.6095684 11.0071623 19.4882481 9.59294876 18.0740345 10.9659914 16.7009919 9.55177787 15.2867783 11.0071623 13.8313939 10.8837471 10.6187476"/>
                                            <path d="M15.9852814,14.9852814 C12.6715729,14.9852814 9.98528137,12.2989899 9.98528137,8.98528137 C9.98528137,5.67157288 12.6715729,2.98528137 15.9852814,2.98528137 C19.2989899,2.98528137 21.9852814,5.67157288 21.9852814,8.98528137 C21.9852814,12.2989899 19.2989899,14.9852814 15.9852814,14.9852814 Z M16.1776695,9.07106781 C17.0060967,9.07106781 17.6776695,8.39949494 17.6776695,7.57106781 C17.6776695,6.74264069 17.0060967,6.07106781 16.1776695,6.07106781 C15.3492424,6.07106781 14.6776695,6.74264069 14.6776695,7.57106781 C14.6776695,8.39949494 15.3492424,9.07106781 16.1776695,9.07106781 Z" class="svg" transform="translate(15.985281, 8.985281) rotate(-315.000000) translate(-15.985281, -8.985281) "/>
                                        </g>
                                    </svg>
                                </span>
                                <span class="sidenav-item-in flex flex-col">
                                    <span class="text-primary sidenav-item-primary-light">Személyzeti mód</span>
                                </span>
                            </span>
                        </span>
                    </span>
                    ';
                }
            }
        ?>
        <div id="sidenav-body-seach">
            <span class="sidenav-item flex flex-row">
                <label class="Webáruház webshop vasarlas vasarol bevasarol shop kocsi Kosár kosar termekek mentettek kedvencek likeolt konyvjelzo"></label>
                <span class="sidenav-item-group flex flex-col">
                    <span class="sidenav-item-group-item" onclick="window.location.href='/browse'">
                        <span class="flex flex-row flex-align-c">
                            <span class="sidenav-item-in flex">
                                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="32px" height="32px" viewBox="0 0 24 24" version="1.1">
                                    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                        <rect x="0" y="0" width="24" height="24"></rect>
                                        <path d="M18.1446364,11.84388 L17.4471627,16.0287218 C17.4463569,16.0335568 17.4455155,16.0383857 17.4446387,16.0432083 C17.345843,16.5865846 16.8252597,16.9469884 16.2818833,16.8481927 L4.91303792,14.7811299 C4.53842737,14.7130189 4.23500006,14.4380834 4.13039941,14.0719812 L2.30560137,7.68518803 C2.28007524,7.59584656 2.26712532,7.50338343 2.26712532,7.4104669 C2.26712532,6.85818215 2.71484057,6.4104669 3.26712532,6.4104669 L16.9929851,6.4104669 L17.606173,3.78251876 C17.7307772,3.24850086 18.2068633,2.87071314 18.7552257,2.87071314 L20.8200821,2.87071314 C21.4717328,2.87071314 22,3.39898039 22,4.05063106 C22,4.70228173 21.4717328,5.23054898 20.8200821,5.23054898 L19.6915238,5.23054898 L18.1446364,11.84388 Z" class="svg" opacity="0.3"></path>
                                        <path d="M6.5,21 C5.67157288,21 5,20.3284271 5,19.5 C5,18.6715729 5.67157288,18 6.5,18 C7.32842712,18 8,18.6715729 8,19.5 C8,20.3284271 7.32842712,21 6.5,21 Z M15.5,21 C14.6715729,21 14,20.3284271 14,19.5 C14,18.6715729 14.6715729,18 15.5,18 C16.3284271,18 17,18.6715729 17,19.5 C17,20.3284271 16.3284271,21 15.5,21 Z" class="svg"></path>
                                    </g>
                                </svg>
                            </span>
                            <span class="sidenav-item-in flex flex-col">
                                <span class="text-primary sidenav-item-primary-light">Webáruház</span>
                            </span>
                        </span>
                    </span>
                    <span style="text-align: center;">
                        <hr class="sidenav-group-divider" style="text-align: right;">
                    </span>
                    <span class="sidenav-item-group-item relative" onclick="openSidenavAddons('webshop/orders')">
                        <span class="flex flex-row flex-align-c">
                            <span class="sidenav-item-in flex">
                                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="32px" height="32px" viewBox="0 0 24 24" version="1.1"><g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"><rect x="0" y="0" width="24" height="24"/><path d="M4,6 L20,6 C20.5522847,6 21,6.44771525 21,7 L21,8 C21,8.55228475 20.5522847,9 20,9 L4,9 C3.44771525,9 3,8.55228475 3,8 L3,7 C3,6.44771525 3.44771525,6 4,6 Z M5,11 L10,11 C10.5522847,11 11,11.4477153 11,12 L11,19 C11,19.5522847 10.5522847,20 10,20 L5,20 C4.44771525,20 4,19.5522847 4,19 L4,12 C4,11.4477153 4.44771525,11 5,11 Z M14,11 L19,11 C19.5522847,11 20,11.4477153 20,12 L20,19 C20,19.5522847 19.5522847,20 19,20 L14,20 C13.4477153,20 13,19.5522847 13,19 L13,12 C13,11.4477153 13.4477153,11 14,11 Z" class="svg"/><path d="M14.4452998,2.16794971 C14.9048285,1.86159725 15.5256978,1.98577112 15.8320503,2.4452998 C16.1384028,2.90482849 16.0142289,3.52569784 15.5547002,3.83205029 L12,6.20185043 L8.4452998,3.83205029 C7.98577112,3.52569784 7.86159725,2.90482849 8.16794971,2.4452998 C8.47430216,1.98577112 9.09517151,1.86159725 9.5547002,2.16794971 L12,3.79814957 L14.4452998,2.16794971 Z" class="svg" fill-rule="nonzero" opacity="0.3"/></g></svg>
                            </span>
                            <span class="sidenav-item-in flex flex-col">
                                <span class="text-primary sidenav-item-primary-light">Rendeléseim</span>
                            </span>
                        </span>
                        <?php if (isset($_SESSION['loggedin'])) { $uid = $_SESSION['id']; 
                            $bm_sql = "SELECT * FROM orders WHERE uid = $uid"; $bm_res = $con-> query($bm_sql);
                            if ($bm_res-> num_rows > 0) { $bnum = $bm_res -> num_rows;
                                echo '<span class="badge bold label-danger flex flex-align-c flex-justify-con-c absolute" style="right: 0%;">'.$bnum.'</span>';
                            }
                            }
                        ?>
                    </span>
                    <span style="text-align: center;">
                        <hr class="sidenav-group-divider" style="text-align: right;">
                    </span>
                    <span class="sidenav-item-group-item relative" onclick="openSidenavAddons('webshop/bookmarks')">
                        <span class="flex flex-row flex-align-c">
                            <span class="sidenav-item-in flex">
                                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="32px" height="32px" viewBox="0 0 24 24" version="1.1"><g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"><rect x="0" y="0" width="24" height="24"/><path d="M8,4 L16,4 C17.1045695,4 18,4.8954305 18,6 L18,17.726765 C18,18.2790497 17.5522847,18.726765 17,18.726765 C16.7498083,18.726765 16.5087052,18.6329798 16.3242754,18.4639191 L12.6757246,15.1194142 C12.2934034,14.7689531 11.7065966,14.7689531 11.3242754,15.1194142 L7.67572463,18.4639191 C7.26860564,18.8371115 6.63603827,18.8096086 6.26284586,18.4024896 C6.09378519,18.2180598 6,17.9769566 6,17.726765 L6,6 C6,4.8954305 6.8954305,4 8,4 Z" class="svg"/></g></svg>
                            </span>
                            <span class="sidenav-item-in flex flex-col relative">
                                <span class="text-primary sidenav-item-primary-light">Mentett elemek</span>
                            </span>
                        </span>
                        <?php if (isset($_SESSION['loggedin'])) { $uid = $_SESSION['id']; 
                            $bm_sql = "SELECT * FROM bookmarks WHERE uid = $uid"; $bm_res = $con-> query($bm_sql);
                            if ($bm_res-> num_rows > 0) { $bnum = $bm_res -> num_rows;
                                echo '<span class="badge bold label-danger flex flex-align-c flex-justify-con-c absolute" style="right: 0%;">'.$bnum.'</span>';
                            }
                            }
                        ?>
                    </span>
                </span>
            </span>
            <span class="sidenav-item flex flex-row">
                <label class="Forum ugyfelszolgalat segitseg visszajelzes help panasz"></label>
                <span class="sidenav-item-group flex flex-col">
                    <span class="sidenav-item-group-item">
                        <span class="flex flex-row flex-align-c">
                            <span class="sidenav-item-in flex">
                                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="32px" height="32px" viewBox="0 0 24 24" version="1.1"><g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"><rect x="0" y="0" width="24" height="24"/><path d="M3,4 L20,4 C20.5522847,4 21,4.44771525 21,5 L21,7 C21,7.55228475 20.5522847,8 20,8 L3,8 C2.44771525,8 2,7.55228475 2,7 L2,5 C2,4.44771525 2.44771525,4 3,4 Z M10,10 L20,10 C20.5522847,10 21,10.4477153 21,11 L21,19 C21,19.5522847 20.5522847,20 20,20 L10,20 C9.44771525,20 9,19.5522847 9,19 L9,11 C9,10.4477153 9.44771525,10 10,10 Z" class="svg"/><rect class="svg" opacity="0.3" x="2" y="10" width="5" height="10" rx="1"/></g></svg>
                            </span>
                            <span class="sidenav-item-in flex flex-col">
                                <span class="text-primary sidenav-item-primary-light">Fórum (béta)</span>
                            </span>
                        </span>
                    </span>
                    <span style="text-align: center;">
                        <hr class="sidenav-group-divider" style="text-align: right;">
                    </span>
                    <span class="sidenav-item-group-item">
                        <span class="flex flex-row flex-align-c">
                            <span class="sidenav-item-in flex">
                                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="32px" height="32px" viewBox="0 0 24 24" version="1.1">
                                    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                        <rect x="0" y="0" width="24" height="24"/>
                                        <path d="M19,16 L19,12 C19,8.13400675 15.8659932,5 12,5 C8.13400675,5 5,8.13400675 5,12 L5,16 L19,16 Z M21,16 L3,16 L3,12 C3,7.02943725 7.02943725,3 12,3 C16.9705627,3 21,7.02943725 21,12 L21,16 Z" class="svg" fill-rule="nonzero" opacity="0.3"/>
                                        <path d="M5,14 L6,14 C7.1045695,14 8,14.8954305 8,16 L8,19 C8,20.1045695 7.1045695,21 6,21 L5,21 C3.8954305,21 3,20.1045695 3,19 L3,16 C3,14.8954305 3.8954305,14 5,14 Z M18,14 L19,14 C20.1045695,14 21,14.8954305 21,16 L21,19 C21,20.1045695 20.1045695,21 19,21 L18,21 C16.8954305,21 16,20.1045695 16,19 L16,16 C16,14.8954305 16.8954305,14 18,14 Z" class="svg"/>
                                    </g>
                                </svg>
                            </span>
                            <span class="sidenav-item-in flex flex-col">
                                <span class="text-primary sidenav-item-primary-light">Ügyfélszolgálat</span>
                            </span>
                        </span>
                    </span>
                    <span style="text-align: center;">
                        <hr class="sidenav-group-divider" style="text-align: right;">
                    </span>
                    <span class="sidenav-item-group-item" onclick="openSidenavAddons('feedback')">
                        <span class="flex flex-row flex-align-c">
                            <span class="sidenav-item-in flex">
                                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="32px" height="32px" viewBox="0 0 24 24" version="1.1">
                                    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"><rect x="0" y="0" width="24" height="24"></rect><path d="M3.5,3 L5,3 L5,19.5 C5,20.3284271 4.32842712,21 3.5,21 L3.5,21 C2.67157288,21 2,20.3284271 2,19.5 L2,4.5 C2,3.67157288 2.67157288,3 3.5,3 Z" class="svg"></path><path d="M6.99987583,2.99995344 L19.754647,2.99999303 C20.3069317,2.99999474 20.7546456,3.44771138 20.7546439,3.99999613 C20.7546431,4.24703684 20.6631995,4.48533385 20.497938,4.66895776 L17.5,8 L20.4979317,11.3310353 C20.8673908,11.7415453 20.8341123,12.3738351 20.4236023,12.7432941 C20.2399776,12.9085564 20.0016794,13 19.7546376,13 L6.99987583,13 L6.99987583,2.99995344 Z" class="svg" opacity="0.3"></path></g>
                                </svg>
                            </span>
                            <span class="sidenav-item-in flex flex-col">
                                <span class="text-primary sidenav-item-primary-light">Visszajelzés küldése</span>
                            </span>
                        </span>
                    </span>
                </span>
            </span>
            <span class="sidenav-item flex flex-row">
                <label class="adatvedelem privacy sutik cookie cookies terms feltetelek hasznalat"></label>
                <span class="sidenav-item-group flex flex-col">
                    <span class="sidenav-item-group-item">
                        <span class="flex flex-row flex-align-c">
                            <span class="sidenav-item-in flex">
                                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="32px" height="32px" viewBox="0 0 24 24" version="1.1">
                                    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"><mask fill="white"><use xlink:href="#path-1"></use></mask><g></g><path d="M7,10 L7,8 C7,5.23857625 9.23857625,3 12,3 C14.7614237,3 17,5.23857625 17,8 L17,10 L18,10 C19.1045695,10 20,10.8954305 20,12 L20,18 C20,19.1045695 19.1045695,20 18,20 L6,20 C4.8954305,20 4,19.1045695 4,18 L4,12 C4,10.8954305 4.8954305,10 6,10 L7,10 Z M12,5 C10.3431458,5 9,6.34314575 9,8 L9,10 L15,10 L15,8 C15,6.34314575 13.6568542,5 12,5 Z" class="svg"></path></g>
                                </svg>
                            </span>
                            <span class="sidenav-item-in flex flex-col">
                                <span class="text-primary sidenav-item-primary-light">Adatvédelem</span>
                            </span>
                        </span>
                    </span>
                    <span style="text-align: center;">
                        <hr class="sidenav-group-divider" style="text-align: right;">
                    </span>
                    <span class="sidenav-item-group-item">
                        <span class="flex flex-row flex-align-c">
                            <span class="sidenav-item-in flex">
                                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="32px" height="32px" viewBox="0 0 24 24" version="1.1">
                                    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"><rect x="0" y="0" width="24" height="24"/><path d="M8,3 L8,3.5 C8,4.32842712 8.67157288,5 9.5,5 L14.5,5 C15.3284271,5 16,4.32842712 16,3.5 L16,3 L18,3 C19.1045695,3 20,3.8954305 20,5 L20,21 C20,22.1045695 19.1045695,23 18,23 L6,23 C4.8954305,23 4,22.1045695 4,21 L4,5 C4,3.8954305 4.8954305,3 6,3 L8,3 Z" class="svg" opacity="0.3"/><path d="M10.875,15.75 C10.6354167,15.75 10.3958333,15.6541667 10.2041667,15.4625 L8.2875,13.5458333 C7.90416667,13.1625 7.90416667,12.5875 8.2875,12.2041667 C8.67083333,11.8208333 9.29375,11.8208333 9.62916667,12.2041667 L10.875,13.45 L14.0375,10.2875 C14.4208333,9.90416667 14.9958333,9.90416667 15.3791667,10.2875 C15.7625,10.6708333 15.7625,11.2458333 15.3791667,11.6291667 L11.5458333,15.4625 C11.3541667,15.6541667 11.1145833,15.75 10.875,15.75 Z" class="svg"/><path d="M11,2 C11,1.44771525 11.4477153,1 12,1 C12.5522847,1 13,1.44771525 13,2 L14.5,2 C14.7761424,2 15,2.22385763 15,2.5 L15,3.5 C15,3.77614237 14.7761424,4 14.5,4 L9.5,4 C9.22385763,4 9,3.77614237 9,3.5 L9,2.5 C9,2.22385763 9.22385763,2 9.5,2 L11,2 Z" class="svg"/></g>
                                </svg>
                            </span>
                            <span class="sidenav-item-in flex flex-col">
                                <span class="text-primary sidenav-item-primary-light">Használati Feltételek</span>
                            </span>
                        </span>
                    </span>
                    <span style="text-align: center;">
                        <hr class="sidenav-group-divider" style="text-align: right;">
                    </span>
                    <span class="sidenav-item-group-item">
                        <span class="flex flex-row flex-align-c">
                            <span class="sidenav-item-in flex">
                                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="32px" height="32px" viewBox="0 0 24 24" version="1.1">
                                    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"><rect x="0" y="0" width="24" height="24"/><polygon class="svg" opacity="0.3" points="12 20.6599888 9.46440699 20.6354368 7.31805655 19.2852462 5.19825383 17.8937466 4.12259707 15.5974894 3.09160702 13.2808335 3.42815736 10.7675551 3.81331204 8.26126488 5.45521712 6.32891335 7.13423264 4.4287182 9.5601992 3.69080156 12 3 14.4398008 3.69080156 16.8657674 4.4287182 18.5447829 6.32891335 20.186688 8.26126488 20.5718426 10.7675551 20.908393 13.2808335 19.8774029 15.5974894 18.8017462 17.8937466 16.6819434 19.2852462 14.535593 20.6354368"/><circle class="svg" opacity="0.3" cx="8.5" cy="13.5" r="1.5"/><circle class="svg" opacity="0.3" cx="13.5" cy="7.5" r="1.5"/><circle class="svg" opacity="0.3" cx="14.5" cy="15.5" r="1.5"/></g>
                                </svg>
                            </span>
                            <span class="sidenav-item-in flex flex-col">
                                <span class="text-primary sidenav-item-primary-light">Cookies</span>
                            </span>
                        </span>
                    </span>
                </span>
            </span>
            <span class="sidenav-item flex flex-row">
                <label class="beallitasok tema nyelv magyar angol english fekete feher dark dark mode light light mode darkmode lightmode"></label>
                <span class="sidenav-item-group flex flex-col">
                    <span class="sidenav-item-group-item" onclick="window.location.href='/settings'">
                        <span class="flex flex-row flex-align-c">
                            <span class="sidenav-item-in flex">
                                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="32px" height="32px" viewBox="0 0 24 24" version="1.1">
                                    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"><rect x="0" y="0" width="24" height="24"></rect><path d="M7,3 L17,3 C19.209139,3 21,4.790861 21,7 C21,9.209139 19.209139,11 17,11 L7,11 C4.790861,11 3,9.209139 3,7 C3,4.790861 4.790861,3 7,3 Z M7,9 C8.1045695,9 9,8.1045695 9,7 C9,5.8954305 8.1045695,5 7,5 C5.8954305,5 5,5.8954305 5,7 C5,8.1045695 5.8954305,9 7,9 Z" class="svg"></path><path d="M7,13 L17,13 C19.209139,13 21,14.790861 21,17 C21,19.209139 19.209139,21 17,21 L7,21 C4.790861,21 3,19.209139 3,17 C3,14.790861 4.790861,13 7,13 Z M17,19 C18.1045695,19 19,18.1045695 19,17 C19,15.8954305 18.1045695,15 17,15 C15.8954305,15 15,15.8954305 15,17 C15,18.1045695 15.8954305,19 17,19 Z" class="svg" opacity="0.3"></path></g>
                                </svg>
                            </span>
                            <span class="sidenav-item-in flex flex-col">
                                <span class="text-primary sidenav-item-primary-light">Beállítások</span>
                            </span>
                        </span>
                    </span>
                    <span style="text-align: center;">
                        <hr class="sidenav-group-divider" style="text-align: right;">
                    </span>
                    <span class="sidenav-item-group-item" onclick="openSidenavAddons('theme')">
                        <span class="flex flex-row flex-align-c">
                            <span class="sidenav-item-in flex">
                                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="32px" height="32px" viewBox="0 0 24 24" version="1.1">
                                    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"><rect x="0" y="0" width="24" height="24"></rect><path d="M12.0700837,4.0003006 C11.3895108,5.17692613 11,6.54297551 11,8 C11,12.3948932 14.5439081,15.9620623 18.9299163,15.9996994 C17.5467214,18.3910707 14.9612535,20 12,20 C7.581722,20 4,16.418278 4,12 C4,7.581722 7.581722,4 12,4 C12.0233848,4 12.0467462,4.00010034 12.0700837,4.0003006 Z" class="svg"></path></g>
                                </svg>
                            </span>
                            <span class="sidenav-item-in flex flex-col">
                                <span class="text-primary sidenav-item-primary-light">Téma beállítása</span>
                            </span>
                        </span>
                    </span>
                    <span style="text-align: center;">
                        <hr class="sidenav-group-divider" style="text-align: right;">
                    </span>
                    <span class="sidenav-item-group-item" onclick="openSidenavAddons('language')">
                        <span class="flex flex-row flex-align-c">
                            <span class="sidenav-item-in flex">
                                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="32px" height="32px" viewBox="0 0 24 24" version="1.1">
                                    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"><rect x="0" y="0" width="24" height="24"></rect><circle class="svg" opacity="0.3" cx="12" cy="12" r="9"></circle><path d="M11.7357634,20.9961946 C6.88740052,20.8563914 3,16.8821712 3,12 C3,11.9168367 3.00112797,11.8339369 3.00336944,11.751315 C3.66233009,11.8143341 4.85636818,11.9573854 4.91262842,12.4204038 C4.9904938,13.0609191 4.91262842,13.8615942 5.45804656,14.101772 C6.00346469,14.3419498 6.15931561,13.1409372 6.6267482,13.4612567 C7.09418079,13.7815761 8.34086797,14.0899175 8.34086797,14.6562185 C8.34086797,15.222396 8.10715168,16.1034596 8.34086797,16.2636193 C8.57458427,16.423779 9.5089688,17.54465 9.50920913,17.7048097 C9.50956962,17.8649694 9.83857487,18.6793513 9.74040201,18.9906563 C9.65905192,19.2487394 9.24857641,20.0501554 8.85059781,20.4145589 C9.75315358,20.7620621 10.7235846,20.9657742 11.7357634,20.9960544 L11.7357634,20.9961946 Z M8.28272988,3.80112099 C9.4158415,3.28656421 10.6744554,3 12,3 C15.5114513,3 18.5532143,5.01097452 20.0364482,7.94408274 C20.069657,8.72412177 20.0638332,9.39135321 20.2361262,9.6327358 C21.1131932,10.8600506 18.0995147,11.7043158 18.5573343,13.5605384 C18.7589671,14.3794892 16.5527814,14.1196773 16.0139722,14.886394 C15.4748026,15.6527403 14.1574598,15.137809 13.8520064,14.9904917 C13.546553,14.8431744 12.3766497,15.3341497 12.4789081,14.4995164 C12.5805657,13.664636 13.2922889,13.6156126 14.0555619,13.2719546 C14.8184743,12.928667 15.9189236,11.7871741 15.3781918,11.6380045 C12.8323064,10.9362407 11.963771,8.47852395 11.963771,8.47852395 C11.8110443,8.44901109 11.8493762,6.74109366 11.1883616,6.69207022 C10.5267462,6.64279981 10.170464,6.88841096 9.20435656,6.69207022 C8.23764828,6.49572949 8.44144409,5.85743687 8.2887174,4.48255778 C8.25453994,4.17415686 8.25619136,3.95717082 8.28272988,3.80112099 Z M20.9991771,11.8770357 C20.9997251,11.9179585 21,11.9589471 21,12 C21,16.9406923 17.0188468,20.9515364 12.0895088,20.9995641 C16.970233,20.9503326 20.9337111,16.888438 20.9991771,11.8770357 Z" class="svg" opacity="0.3"></path></g>
                                </svg>
                            </span>
                            <span class="sidenav-item-in flex flex-col">
                                <span class="text-primary sidenav-item-primary-light">Nyelv kiválasztása</span>
                            </span>
                        </span>
                    </span>
                </span>
            </span>
        </div>
        <?php
            if (isset($_SESSION['loggedin'])) {
                echo '
                    <span class="sidenav-item sidenav-item-sb flex flex-row no-bm-des" onclick="logout();">
                        <span class="sidenav-item-group-item">
                            <span class="flex flex-row flex-align-c">
                                <span class="sidenav-item-in flex">
                                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="32px" height="32px" viewBox="0 0 24 24" version="1.1">
                                        <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"><rect x="0" y="0" width="24" height="24"></rect><path d="M14.0069431,7.00607258 C13.4546584,7.00607258 13.0069431,6.55855153 13.0069431,6.00650634 C13.0069431,5.45446114 13.4546584,5.00694009 14.0069431,5.00694009 L15.0069431,5.00694009 C17.2160821,5.00694009 19.0069431,6.7970243 19.0069431,9.00520507 L19.0069431,15.001735 C19.0069431,17.2099158 17.2160821,19 15.0069431,19 L3.00694311,19 C0.797804106,19 -0.993056895,17.2099158 -0.993056895,15.001735 L-0.993056895,8.99826498 C-0.993056895,6.7900842 0.797804106,5 3.00694311,5 L4.00694793,5 C4.55923268,5 5.00694793,5.44752105 5.00694793,5.99956624 C5.00694793,6.55161144 4.55923268,6.99913249 4.00694793,6.99913249 L3.00694311,6.99913249 C1.90237361,6.99913249 1.00694311,7.89417459 1.00694311,8.99826498 L1.00694311,15.001735 C1.00694311,16.1058254 1.90237361,17.0008675 3.00694311,17.0008675 L15.0069431,17.0008675 C16.1115126,17.0008675 17.0069431,16.1058254 17.0069431,15.001735 L17.0069431,9.00520507 C17.0069431,7.90111468 16.1115126,7.00607258 15.0069431,7.00607258 L14.0069431,7.00607258 Z" class="svg" fill-rule="nonzero" opacity="1" transform="translate(9.006943, 12.000000) scale(-1, 1) rotate(-90.000000) translate(-9.006943, -12.000000) "></path><rect class="svg" opacity="1" transform="translate(14.000000, 12.000000) rotate(-270.000000) translate(-14.000000, -12.000000) " x="13" y="6" width="2" height="12" rx="1"></rect><path d="M21.7928932,9.79289322 C22.1834175,9.40236893 22.8165825,9.40236893 23.2071068,9.79289322 C23.5976311,10.1834175 23.5976311,10.8165825 23.2071068,11.2071068 L20.2071068,14.2071068 C19.8165825,14.5976311 19.1834175,14.5976311 18.7928932,14.2071068 L15.7928932,11.2071068 C15.4023689,10.8165825 15.4023689,10.1834175 15.7928932,9.79289322 C16.1834175,9.40236893 16.8165825,9.40236893 17.2071068,9.79289322 L19.5,12.0857864 L21.7928932,9.79289322 Z" class="svg" fill-rule="nonzero" transform="translate(19.500000, 12.000000) rotate(-90.000000) translate(-19.500000, -12.000000) "></path></g>
                                    </svg>
                                </span>
                                <span class="sidenav-item-in flex flex-col">
                                    <span class="text-primary sidenav-item-primary-light">Kijelentkezés</span>
                                </span>
                            </span>
                        </span>
                    </div>
                ';
            }
        ?>
    </div>
    <div class="sidenav-footer"></div>
</div>
<script>
    function searchSettings () {
        var input, filter, con, item, i, txtValue;input = document.getElementById("sidenav-search");filter = input.value.toUpperCase();con = document.getElementById("sidenav-body-seach");item = con.getElementsByTagName("label");
        for (i = 0; i < item.length; i++) {txtValue = item[i].className;
            if (txtValue.toUpperCase().indexOf(filter) > -1) {item[i].parentNode.style.display = "";}
            else {item[i].parentNode.style.display = "none";}
        }
    }
    async function fetchCart(peek) {return await (await fetch(peek)).text();}
    async function loadCart() {const contentDiv = document.getElementById("sidenav-body");contentDiv.innerHTML = await fetchCart("/includes/addons/webshop/cart.php");}
    function sidenavMain () {
        document.getElementsByTagName( 'html' )[0].classList.add('stop-scroll');
        document.getElementById('sidenav').innerHTML = `<span class="sidenav-loader" id="sidenav-loader"><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="64px" height="64px" viewBox="0 0 24 24" version="1.1"><g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"><g><polygon points="0 0 24 0 24 24 0 24"/></g><path d="M12,4 L12,6 C8.6862915,6 6,8.6862915 6,12 C6,15.3137085 8.6862915,18 12,18 C15.3137085,18 18,15.3137085 18,12 C18,10.9603196 17.7360885,9.96126435 17.2402578,9.07513926 L18.9856052,8.09853149 C19.6473536,9.28117708 20,10.6161442 20,12 C20,16.418278 16.418278,20 12,20 C7.581722,20 4,16.418278 4,12 C4,7.581722 7.581722,4 12,4 Z" class="svg" fill-rule="nonzero" opacity="0.3" transform="translate(12.000000, 12.000000) scale(-1, 1) translate(-12.000000, -12.000000) "/></g></svg></span>`;
        setTimeout(function () {$('#sidenav').load('/includes/addons/sidenav.php');}, 400);
    }
    function logout () {location.href = '/actions/logout';}
    function sidenavRedirect () {location.href = "/profile";}
    async function fetchHtmlAsText(url) {return await (await fetch(url)).text();}
    async function loadWizard() {const contentDiv = document.getElementById("sidenav-body");contentDiv.innerHTML = await fetchHtmlAsText("/includes/addons/mobile/wizard.html");}
    async function fetchRegister(regurl) {return await (await fetch(regurl)).text();}
    async function loadRegister() {const contentDiv = document.getElementById("sidenav-body");contentDiv.innerHTML = await fetchRegister("/includes/addons/mobile/register.html");}
    async function fetchLogin(regurl) {return await (await fetch(regurl)).text(); }
    async function loadLogin() {const contentDiv = document.getElementById("sidenav-body"); contentDiv.innerHTML = await fetchRegister("/includes/addons/mobile/login.html");}
    function staffMode() {
        let num = document.getElementsByClassName('sidenav-body')[0].children;
        for (let i = 0; i < num.length; i++) {num[i].classList.add('pointer-event-none');}
        if (!document.getElementsByClassName('sidenav-inner')[0].contains(staffAddon)) {document.getElementsByClassName('sidenav-inner')[0].prepend(staffAddon)}
        document.getElementsByTagName( 'html' )[0].classList.add('stop-scroll');
        document.getElementsByClassName('sidenav-body')[0].classList.add('blured');
        staffAddon.innerHTML = `<span class="sidenav-loader" id="sidenav-loader"><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="64px" height="64px" viewBox="0 0 24 24" version="1.1"><g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"><g><polygon points="0 0 24 0 24 24 0 24"/></g><path d="M12,4 L12,6 C8.6862915,6 6,8.6862915 6,12 C6,15.3137085 8.6862915,18 12,18 C15.3137085,18 18,15.3137085 18,12 C18,10.9603196 17.7360885,9.96126435 17.2402578,9.07513926 L18.9856052,8.09853149 C19.6473536,9.28117708 20,10.6161442 20,12 C20,16.418278 16.418278,20 12,20 C7.581722,20 4,16.418278 4,12 C4,7.581722 7.581722,4 12,4 Z" class="svg" fill-rule="nonzero" opacity="0.3" transform="translate(12.000000, 12.000000) scale(-1, 1) translate(-12.000000, -12.000000) "/></g></svg></span>`;
        setTimeout(function () {
            <?php if (isset($_SESSION['loggedin'])) {if ($_SESSION['id'] == 1) {echo "$('#staffAddon').load('/includes/staff/auth.php');";}else {echo "$('#staffAddon').load('/403.php');";}} ?>
        }, 500); staffAddon.style.height = "60vh";

    } function closeStaffAddon () {
        document.getElementsByClassName('sidenav-body')[0].classList.remove('blured'); document.getElementsByTagName( 'html' )[0].classList.remove('stop-scroll');
        staffAddon.innerHTML = ``; staffAddon.style.height = "0"; let num = document.getElementsByClassName('sidenav-body')[0].children;
        for (let i = 0; i < num.length; i++) { num[i].classList.remove('pointer-event-none'); }
    }
</script>