<?php session_start();
    if (!isset($_SESSION['token'])) {header ("Location: /");
    } else {
        if (time() - $_SESSION['token_expiry'] > 3600){unset($_SESSION['token']);
            echo "
                <script>
                    const now = new Date();
                    const notifParams = {notifType : '0',notifIcon : '0',notifTheme : '0',notifTitle : 'Figyelem',notifDesc : 'Lejárt a munkamenet.',expiry : now.setSeconds(60)};
                    localStorage.setItem('NP', JSON.stringify(notifParams));window.location.href= '/';
                </script>
            ";
       }
       echo "
        <script>
            const now = new Date();
            if (localStorage.getItem('staffLock')) {localStorage.removeItem('staffLock');
            } if (!localStorage.getItem('userToken')) {location.href = '/';
            } else {if (now.getTime() > localStorage.getItem('userToken').expiry) {localStorage.removeItem('userToken');location.href = '/';}}
        </script>
       ";
    }
    include($_SERVER['DOCUMENT_ROOT'].'/includes/inc.connect.php');
    if (mysqli_connect_errno()) {header ("Location: /500");
        echo "
            <script>
                const now = new Date();
                const notifParams = {notifType : '1',notifIcon : '2',notifTheme : '2',notifTitle : 'Hiba',notifDesc : 'Szerver oldali hiba történt.',expiry : now.setSeconds(60)};
                localStorage.setItem('NP', JSON.stringify(notifParams));window.location.href= '../';
            </script>
        ";
    }
    $stmt = $con->prepare('SELECT id, fullname, email, theme FROM customers WHERE id = ?');
    // In this case we can use the account ID to get the account info.
    if (isset($_SESSION['loggedin'])) {$id = $_SESSION['id'];
        if ($id != 1) {header('Location: /'); }
    } else {header('Location: /');} $stmt->bind_param('i', $id);$stmt->execute(); $stmt->bind_result($id, $fullname, $email, $theme); $stmt->fetch();$stmt->close();
?>
<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="content-type" content="text/html; charset=utf-8" />
        <meta name="keywords" content="tuzogép,fénymásolópapír,békéscsaba,eagle,kiszállítás,békéscsaba,írószer,irodaszer,nagyker, nagykereskedelem,ingyen,cd,dvd,zebra,boríték,füzet,dosszié,toll, golyóstoll,papír,atbt,iratrendezo,verbatim,import" />
        <meta name="rights" content="Mappa Papír" />
        <meta name="description" content="Mappa Papír Irodaszer nagykereskedelem. Kiskunhalason és környékén ingyenes kiszállítás." />
        <meta name="viewport" content="user-scalable=no, width=device-width, initial-scale=1.0" />
        <meta name="apple-mobile-web-app-capable" content="yes" />
        <link rel="stylesheet" href="/assets/style/main.css" />
        <link href="/assets/icons/favicon.ico" rel="shortcut icon" type="image/vnd.microsoft.icon" />
        <script src="/assets/script/jquery/jquery.js"></script>
        <title>Mappa Papír</title>
    </head>
    <body>
        <script>const html = document.querySelector('html');function switchTheme(theme) {html.dataset.theme = `theme-${theme}`;localStorage.setItem('theme', `theme-${theme}`);}</script>
    <header>
            <div id="header_con" class="container">
                <div id="header_title" class="header_title flex flex-row flex-align-c flex-justify-con-sb">
                    <div class="flex flex-align-c flex-justify-con-l flex-col pointer" onclick="window.location.href='/'">
                        <span class="header_title_heading">Mappa Papír</span>
                        <span class="header_title_desc">Minden ami írószer.</span>
                    </div>
                    <div id="header_middle" class="header_middle_con flex flex-col">
                        <div id="header_search" class="flex width-100">
                            <div class="flex width-100">
                                <input type="text" class="header_input flex width-100 outline-none border-none" id="main_search" name="main_search" placeholder="Keresés az alkalmazások között..">
                            </div>
                        </div>
                    </div>
                    <div id="header_desktop_button" class="header_heading_button user_action_button pointer flex flex-align-c flex-justify-con-c has-tooltip relative" aria-describedby="tooltipProfile" onclick="openHeaderProfileActionLogged();">
                        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                            <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"><rect x="0" y="0" width="24" height="24"></rect><rect class="svg" x="0" y="5" width="24" height="3" rx="1.5"></rect><rect class="svg" x="0" y="12" width="24" height="3" rx="1.5"></rect><rect class="svg" x="0" y="19" width="24" height="3" rx="1.5"></rect></g>
                        </svg>
                        <span class="tooltip absolute" id="tooltipProfile">Menü</span>
                    </div>
                </div>
            </div>
        </header>
        <main>
            <section class="main_section staff-header-section flex flex-align-c flex-justify-con-c">
                
            </section>
        </main>
    <div role="footer">
        <footer>
            <div class='footer_inner'>
                <div class='footer_contacts'>
                    <span class='footer_title'>Kapcsolat</span>
                    <div class='footer_contacts_item_con'>
                        <div class='footer_contacts_item'>
                            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="18px" height="18px" viewBox="0 0 24 24" version="1.1">
                                <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                    <rect x="0" y="0" width="18" height="18"/>
                                    <path d="M5,10.5 C5,6 8,3 12.5,3 C17,3 20,6.75 20,10.5 C20,12.8325623 17.8236613,16.03566 13.470984,20.1092932 C12.9154018,20.6292577 12.0585054,20.6508331 11.4774555,20.1594925 C7.15915182,16.5078313 5,13.2880005 5,10.5 Z M12.5,12 C13.8807119,12 15,10.8807119 15,9.5 C15,8.11928813 13.8807119,7 12.5,7 C11.1192881,7 10,8.11928813 10,9.5 C10,10.8807119 11.1192881,12 12.5,12 Z" class="svg" fill-rule="nonzero"/>
                                </g>
                            </svg>
                            6400 Kiskunhalas, Kossuth utca 13-15.
                        </div>
                    </div>
                    <div class='footer_contacts_item_con'>
                        <div class='footer_contacts_item'>
                            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                    <rect x="0" y="0" width="24" height="24"/>
                                    <path d="M11.914857,14.1427403 L14.1188827,11.9387145 C14.7276032,11.329994 14.8785122,10.4000511 14.4935235,9.63007378 L14.3686433,9.38031323 C13.9836546,8.61033591 14.1345636,7.680393 14.7432841,7.07167248 L17.4760882,4.33886839 C17.6713503,4.14360624 17.9879328,4.14360624 18.183195,4.33886839 C18.2211956,4.37686904 18.2528214,4.42074752 18.2768552,4.46881498 L19.3808309,6.67676638 C20.2253855,8.3658756 19.8943345,10.4059034 18.5589765,11.7412615 L12.560151,17.740087 C11.1066115,19.1936265 8.95659008,19.7011777 7.00646221,19.0511351 L4.5919826,18.2463085 C4.33001094,18.1589846 4.18843095,17.8758246 4.27575484,17.613853 C4.30030124,17.5402138 4.34165566,17.4733009 4.39654309,17.4184135 L7.04781491,14.7671417 C7.65653544,14.1584211 8.58647835,14.0075122 9.35645567,14.3925008 L9.60621621,14.5173811 C10.3761935,14.9023698 11.3061364,14.7514608 11.914857,14.1427403 Z" class="svg"/>
                                </g>
                            </svg>
                            +36 77/421-134
                        </div>
                    </div>
                    <div class='footer_contacts_item_con'>
                        <div class='footer_contacts_item'>
                            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                    <rect x="0" y="0" width="24" height="24"/>
                                    <path d="M7.13888889,4 L7.13888889,19 L16.8611111,19 L16.8611111,4 L7.13888889,4 Z M7.83333333,1 L16.1666667,1 C17.5729473,1 18.25,1.98121694 18.25,3.5 L18.25,20.5 C18.25,22.0187831 17.5729473,23 16.1666667,23 L7.83333333,23 C6.42705272,23 5.75,22.0187831 5.75,20.5 L5.75,3.5 C5.75,1.98121694 6.42705272,1 7.83333333,1 Z" class="svg" fill-rule="nonzero"/>
                                    <polygon class="svg" opacity="0.3" points="7 4 7 19 17 19 17 4"/>
                                    <circle class="svg" cx="12" cy="21" r="1"/>
                                </g>
                            </svg>
                            +36 30/515-7175
                        </div>
                    </div>
                    <div class='footer_contacts_item_con'>
                        <div class='footer_contacts_item'>
                            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                    <rect x="0" y="0" width="24" height="24"/>
                                    <path d="M5,6 L19,6 C20.1045695,6 21,6.8954305 21,8 L21,17 C21,18.1045695 20.1045695,19 19,19 L5,19 C3.8954305,19 3,18.1045695 3,17 L3,8 C3,6.8954305 3.8954305,6 5,6 Z M18.1444251,7.83964668 L12,11.1481833 L5.85557487,7.83964668 C5.4908718,7.6432681 5.03602525,7.77972206 4.83964668,8.14442513 C4.6432681,8.5091282 4.77972206,8.96397475 5.14442513,9.16035332 L11.6444251,12.6603533 C11.8664074,12.7798822 12.1335926,12.7798822 12.3555749,12.6603533 L18.8555749,9.16035332 C19.2202779,8.96397475 19.3567319,8.5091282 19.1603533,8.14442513 C18.9639747,7.77972206 18.5091282,7.6432681 18.1444251,7.83964668 Z" class="svg"/>
                                </g>
                            </svg>
                            <a href="mailto:info@mappapapir.hu">info@mappapapir.hu</a>
                        </div>
                    </div>
                </div>
                <div class='footer_cert'>
                    <div class='footer_cert_item'>
                        <img class='footer_cert_img' src='/assets/images/footer/certificate.png' alt='Bisnode tanúsítvány' />
                        <span class='footer_cert_img_label'>Bisnode tanúsítvány</span>
                    </div>
                    <div class='footer_cert_item'>
                        <img class='footer_cert_img' src='/assets/images/footer/gop_tabla_kicsi.jpg' alt='Bisnode tanúsítvány' />
                        <span class='footer_cert_img_label'>Közreműködő szervezet - MAG Zrt.</span>
                    </div>
                </div>
            </div>
            <div class='footer_bottom'>
                <div class='footer_logo'>
                    <img src='/assets/icons/logo.png' alt='LOGO'>
                </div>
                <div class='footer_copyright'>Copyright © 2021 Mappa Papír Írószer.  Minden jog fenntartva.</div>
            </div>
        </footer>
    </div>
        <?php
            if (isset($_SESSION['loggedin'])) {
                echo "
                    <script>
                    const theme = '". $theme ."';
                    if (theme === 'auto') {const darkThemeMq = window.matchMedia('(prefers-color-scheme: light)');
                        if (darkThemeMq.matches) {document.querySelector('html').dataset.theme = `theme-light`;                            
                        } else {document.querySelector('html').dataset.theme = `theme-dark`;   }
                    } else {document.querySelector('html').dataset.theme = 'theme-' + theme;   }
                    </script>
                ";
            } else {
                echo "
                    <script>
                        const darkThemeMq = window.matchMedia('(prefers-color-scheme: light)');
                        if (!localStorage.getItem('theme')) {
                            if (darkThemeMq.matches) {document.querySelector('html').dataset.theme = `theme-light`;                            
                            } else {document.querySelector('html').dataset.theme = `theme-dark`;   }
                        } else {document.querySelector('html').dataset.theme = localStorage.getItem('theme');}
                    </script>
                ";
            }
        ?>
        <script>
            const staff_auth_con = document.createElement('div');staff_auth_con.classList = 'staff_auth_con';staff_auth_con.id = "staff_auth_con";document.body.prepend(staff_auth_con);
            function staffAuth () {
                document.body.classList.add('stop-scroll');document.getElementsByTagName('main')[0].classList.add('blured');
                document.getElementsByTagName('main')[0].classList.add('pointer-event-none');document.getElementsByTagName('main')[0].classList.add('user-select-none');
                $('#staff_auth_con').load('/includes/staff/staffauth.php');$('#staff_auth_con').css('height', '80vh');
            }
            function closeAuth() {
                document.body.classList.remove('stop-scroll');document.getElementsByTagName('main')[0].classList.remove('blured');
                document.getElementsByTagName('main')[0].classList.remove('pointer-event-none');document.getElementsByTagName('main')[0].classList.remove('user-select-none');
                staff_auth_con.innerHTML = '';$('#staff_auth_con').css('height', '0');
            }
        </script>
        <script src="/assets/script/header.js"></script>
        <script>
            var profileActionsContainer = document.createElement('div');var transWrapper = document.createElement('div');
            transWrapper.classList.add('transWrapper');profileActionsContainer.id = 'profileHeaderContainer';let cC = 1;
            function openHeaderProfileActionLogged  () {cC++;
                if (cC % 2 == 0) {document.getElementById('header_con').classList.add('relative');showProfileActionPanel();document.body.append(transWrapper);document.getElementById('header_con').append(profileActionsContainer);
                } else {profileActionsContainer.remove();transWrapper.remove();cC = 1;}
            } window.onclick = function(event) {if (event.target == transWrapper) {profileActionsContainer.remove();transWrapper.remove();cC = 1;}}

            function showProfileActionPanel () {
                profileActionsContainer.innerHTML = `
                    <div class='profileActionCon flex flex-col absolute'>
                        <div class='flex flex-col'>
                            <span class='flex flex-row flex-justify-con-sa'>
                                <div class='flex flex-col profileActionItemHead flex-justify-con-l'>
                                    <span class='profileActionTitle'> <?php echo $fullname; ?> </span>
                                    <span class='secondary small'><?php echo $email ?></span>
                                </div>
                                <div class='flex flex-align-c profileIconCon'>
                                    <span class='iconCon flex flex-align-c flex-justify-con-c'>
                                        <img src='/assets/images/svg/profile.png' alt='' class='pointer'>
                                    </span>
                                </div>
                            </span>
                            <hr class='profacthr'>
                            <div class='flex flex-col profileActionItem' onclick='profileActionPanel("settings");'>
                                <span class='flex flex-row w-100 flex-align-c flex-justify-con-sb'>
                                    <span class='flex flex-row flex-align-c'>
                                        <span class='actionConIcon flex'>
                                            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                                <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"><rect x="0" y="0" width="24" height="24"/><path d="M7,3 L17,3 C19.209139,3 21,4.790861 21,7 C21,9.209139 19.209139,11 17,11 L7,11 C4.790861,11 3,9.209139 3,7 C3,4.790861 4.790861,3 7,3 Z M7,9 C8.1045695,9 9,8.1045695 9,7 C9,5.8954305 8.1045695,5 7,5 C5.8954305,5 5,5.8954305 5,7 C5,8.1045695 5.8954305,9 7,9 Z" class="svg"/><path d="M7,13 L17,13 C19.209139,13 21,14.790861 21,17 C21,19.209139 19.209139,21 17,21 L7,21 C4.790861,21 3,19.209139 3,17 C3,14.790861 4.790861,13 7,13 Z M17,19 C18.1045695,19 19,18.1045695 19,17 C19,15.8954305 18.1045695,15 17,15 C15.8954305,15 15,15.8954305 15,17 C15,18.1045695 15.8954305,19 17,19 Z" class="svg" opacity="0.3"/></g>
                                            </svg>
                                        </span>
                                        <span class='actionConText flex'>Beállítások</span>
                                    </span>
                                    <span class='actionConIcon flex'>
                                        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                            <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"><polygon points="0 0 24 0 24 24 0 24"/><path d="M6.70710678,15.7071068 C6.31658249,16.0976311 5.68341751,16.0976311 5.29289322,15.7071068 C4.90236893,15.3165825 4.90236893,14.6834175 5.29289322,14.2928932 L11.2928932,8.29289322 C11.6714722,7.91431428 12.2810586,7.90106866 12.6757246,8.26284586 L18.6757246,13.7628459 C19.0828436,14.1360383 19.1103465,14.7686056 18.7371541,15.1757246 C18.3639617,15.5828436 17.7313944,15.6103465 17.3242754,15.2371541 L12.0300757,10.3841378 L6.70710678,15.7071068 Z" class="svg" fill-rule="nonzero" transform="translate(12.000003, 11.999999) rotate(-270.000000) translate(-12.000003, -11.999999) "/></g>
                                        </svg>
                                    </span>
                                </span>
                            </div>
                            <div class='flex flex-col profileActionItem' style='margin-top: 1rem;'>
                                <span class='flex flex-row w-100 flex-align-c'>
                                    <span class='actionConIcon flex'>
                                        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                            <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"><rect x="0" y="0" width="24" height="24"/><path d="M3.5,3 L5,3 L5,19.5 C5,20.3284271 4.32842712,21 3.5,21 L3.5,21 C2.67157288,21 2,20.3284271 2,19.5 L2,4.5 C2,3.67157288 2.67157288,3 3.5,3 Z" class="svg"/><path d="M6.99987583,2.99995344 L19.754647,2.99999303 C20.3069317,2.99999474 20.7546456,3.44771138 20.7546439,3.99999613 C20.7546431,4.24703684 20.6631995,4.48533385 20.497938,4.66895776 L17.5,8 L20.4979317,11.3310353 C20.8673908,11.7415453 20.8341123,12.3738351 20.4236023,12.7432941 C20.2399776,12.9085564 20.0016794,13 19.7546376,13 L6.99987583,13 L6.99987583,2.99995344 Z" class="svg" opacity="0.3"/></g>
                                        </svg>
                                    </span>
                                    <span class='actionConText flex'>Visszajelzés küldése</span>
                                </span>
                            </div>
                            <div class='flex flex-col profileActionItem' onclick="window.location.href='/'">
                                <span class='flex flex-row w-100 flex-align-c'>
                                    <span class='actionConIcon'>
                                        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                            <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"><rect x="0" y="0" width="24" height="24"/><path d="M14.0069431,7.00607258 C13.4546584,7.00607258 13.0069431,6.55855153 13.0069431,6.00650634 C13.0069431,5.45446114 13.4546584,5.00694009 14.0069431,5.00694009 L15.0069431,5.00694009 C17.2160821,5.00694009 19.0069431,6.7970243 19.0069431,9.00520507 L19.0069431,15.001735 C19.0069431,17.2099158 17.2160821,19 15.0069431,19 L3.00694311,19 C0.797804106,19 -0.993056895,17.2099158 -0.993056895,15.001735 L-0.993056895,8.99826498 C-0.993056895,6.7900842 0.797804106,5 3.00694311,5 L4.00694793,5 C4.55923268,5 5.00694793,5.44752105 5.00694793,5.99956624 C5.00694793,6.55161144 4.55923268,6.99913249 4.00694793,6.99913249 L3.00694311,6.99913249 C1.90237361,6.99913249 1.00694311,7.89417459 1.00694311,8.99826498 L1.00694311,15.001735 C1.00694311,16.1058254 1.90237361,17.0008675 3.00694311,17.0008675 L15.0069431,17.0008675 C16.1115126,17.0008675 17.0069431,16.1058254 17.0069431,15.001735 L17.0069431,9.00520507 C17.0069431,7.90111468 16.1115126,7.00607258 15.0069431,7.00607258 L14.0069431,7.00607258 Z" fill="#ce3746" fill-rule="nonzero" opacity="1" transform="translate(9.006943, 12.000000) scale(-1, 1) rotate(-90.000000) translate(-9.006943, -12.000000) "/><rect fill="#ce3746" opacity="1" transform="translate(14.000000, 12.000000) rotate(-270.000000) translate(-14.000000, -12.000000) " x="13" y="6" width="2" height="12" rx="1"/><path d="M21.7928932,9.79289322 C22.1834175,9.40236893 22.8165825,9.40236893 23.2071068,9.79289322 C23.5976311,10.1834175 23.5976311,10.8165825 23.2071068,11.2071068 L20.2071068,14.2071068 C19.8165825,14.5976311 19.1834175,14.5976311 18.7928932,14.2071068 L15.7928932,11.2071068 C15.4023689,10.8165825 15.4023689,10.1834175 15.7928932,9.79289322 C16.1834175,9.40236893 16.8165825,9.40236893 17.2071068,9.79289322 L19.5,12.0857864 L21.7928932,9.79289322 Z" fill="#ce3746" fill-rule="nonzero" transform="translate(19.500000, 12.000000) rotate(-90.000000) translate(-19.500000, -12.000000) "/></g>
                                        </svg>
                                    </span>
                                    <span class='actionConText text-danger'>Kijelentkezés</span>
                                </span>
                            </div>
                            <span class='profcondesc flex flex-row'>
                                <ul class='flex flex-row w-100 flex-justify-con-sb'>
                                    <li>Mappa Papír &copy; 2022</li>
                                </ul>
                            </span>
                        </div>
                    </div>
                `;
            }
            function profileActionPanel (panel) {
                if (panel === 'staffMenu') {

                }if (panel == 'settings') {
                    profileActionsContainer.innerHTML = `
                        <div class='profileActionCon flex flex-col absolute'>
                            <div class='flex flex-row flex-align-c profileActionItemHead flex-justify-con-l'>
                                <span class='actionConIcon flex'>
                                    <svg class='pointer' onclick='showProfileActionPanel();' xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                        <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"><rect x="0" y="0" width="24" height="24"/><circle class="svg" opacity="0.3" cx="12" cy="12" r="10"/><path d="M6.96323356,15.1775211 C6.62849853,15.5122561 6.08578582,15.5122561 5.75105079,15.1775211 C5.41631576,14.842786 5.41631576,14.3000733 5.75105079,13.9653383 L10.8939067,8.82248234 C11.2184029,8.49798619 11.7409054,8.4866328 12.0791905,8.79672747 L17.2220465,13.5110121 C17.5710056,13.8308912 17.5945795,14.3730917 17.2747004,14.7220508 C16.9548212,15.0710098 16.4126207,15.0945838 16.0636617,14.7747046 L11.5257773,10.6149773 L6.96323356,15.1775211 Z" class="svg" fill-rule="nonzero" transform="translate(11.500001, 12.000001) scale(-1, 1) rotate(-270.000000) translate(-11.500001, -12.000001) "/></g>
                                    </svg>
                                </span>
                                <span class='profileActionTitle flex'>Beállítások</span>
                            </div>
                            <div class='flex flex-col profileActionItem' id="desktopChangeTheme">
                                <span class='flex flex-row w-100 flex-align-c flex-justify-con-sb'>
                                    <span class='flex flex-row flex-align-c'>
                                        <span class='actionConIcon flex'>
                                            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                                <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"><rect x="0" y="0" width="24" height="24"/><path d="M12.0700837,4.0003006 C11.3895108,5.17692613 11,6.54297551 11,8 C11,12.3948932 14.5439081,15.9620623 18.9299163,15.9996994 C17.5467214,18.3910707 14.9612535,20 12,20 C7.581722,20 4,16.418278 4,12 C4,7.581722 7.581722,4 12,4 C12.0233848,4 12.0467462,4.00010034 12.0700837,4.0003006 Z" class="svg"/></g>
                                            </svg>
                                        </span>
                                        <span class='actionConText flex'>Téma beállítása</span>
                                    </span>
                                </span>
                            </div>
                            <div class='flex flex-col profileActionItem'>
                                <span class='flex flex-row w-100 flex-align-c flex-justify-con-sb'>
                                    <span class='flex flex-row flex-align-c'>
                                        <span class='actionConIcon flex'>
                                            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                                <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"><rect x="0" y="0" width="24" height="24"/><circle class="svg" opacity="0.3" cx="12" cy="12" r="9"/><path d="M11.7357634,20.9961946 C6.88740052,20.8563914 3,16.8821712 3,12 C3,11.9168367 3.00112797,11.8339369 3.00336944,11.751315 C3.66233009,11.8143341 4.85636818,11.9573854 4.91262842,12.4204038 C4.9904938,13.0609191 4.91262842,13.8615942 5.45804656,14.101772 C6.00346469,14.3419498 6.15931561,13.1409372 6.6267482,13.4612567 C7.09418079,13.7815761 8.34086797,14.0899175 8.34086797,14.6562185 C8.34086797,15.222396 8.10715168,16.1034596 8.34086797,16.2636193 C8.57458427,16.423779 9.5089688,17.54465 9.50920913,17.7048097 C9.50956962,17.8649694 9.83857487,18.6793513 9.74040201,18.9906563 C9.65905192,19.2487394 9.24857641,20.0501554 8.85059781,20.4145589 C9.75315358,20.7620621 10.7235846,20.9657742 11.7357634,20.9960544 L11.7357634,20.9961946 Z M8.28272988,3.80112099 C9.4158415,3.28656421 10.6744554,3 12,3 C15.5114513,3 18.5532143,5.01097452 20.0364482,7.94408274 C20.069657,8.72412177 20.0638332,9.39135321 20.2361262,9.6327358 C21.1131932,10.8600506 18.0995147,11.7043158 18.5573343,13.5605384 C18.7589671,14.3794892 16.5527814,14.1196773 16.0139722,14.886394 C15.4748026,15.6527403 14.1574598,15.137809 13.8520064,14.9904917 C13.546553,14.8431744 12.3766497,15.3341497 12.4789081,14.4995164 C12.5805657,13.664636 13.2922889,13.6156126 14.0555619,13.2719546 C14.8184743,12.928667 15.9189236,11.7871741 15.3781918,11.6380045 C12.8323064,10.9362407 11.963771,8.47852395 11.963771,8.47852395 C11.8110443,8.44901109 11.8493762,6.74109366 11.1883616,6.69207022 C10.5267462,6.64279981 10.170464,6.88841096 9.20435656,6.69207022 C8.23764828,6.49572949 8.44144409,5.85743687 8.2887174,4.48255778 C8.25453994,4.17415686 8.25619136,3.95717082 8.28272988,3.80112099 Z M20.9991771,11.8770357 C20.9997251,11.9179585 21,11.9589471 21,12 C21,16.9406923 17.0188468,20.9515364 12.0895088,20.9995641 C16.970233,20.9503326 20.9337111,16.888438 20.9991771,11.8770357 Z" class="svg" opacity="0.3"/></g>
                                            </svg>
                                        </span>
                                        <span class='actionConText flex'>Nyelv kiválasztása</span>
                                    </span>
                                </span>
                            </div>
                        </div>
                    `;
                    $('#desktopChangeTheme').click(function () {
                        profileActionsContainer.innerHTML = `
                            <div class='profileActionCon flex flex-col absolute'>
                                <div class='flex flex-row flex-align-c profileActionItemHead flex-justify-con-l'>
                                    <span class='actionConIcon flex'>
                                        <svg class='pointer' onclick='showProfileActionPanel();' xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                            <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"><rect x="0" y="0" width="24" height="24"/><circle class="svg" opacity="0.3" cx="12" cy="12" r="10"/><path d="M6.96323356,15.1775211 C6.62849853,15.5122561 6.08578582,15.5122561 5.75105079,15.1775211 C5.41631576,14.842786 5.41631576,14.3000733 5.75105079,13.9653383 L10.8939067,8.82248234 C11.2184029,8.49798619 11.7409054,8.4866328 12.0791905,8.79672747 L17.2220465,13.5110121 C17.5710056,13.8308912 17.5945795,14.3730917 17.2747004,14.7220508 C16.9548212,15.0710098 16.4126207,15.0945838 16.0636617,14.7747046 L11.5257773,10.6149773 L6.96323356,15.1775211 Z" class="svg" fill-rule="nonzero" transform="translate(11.500001, 12.000001) scale(-1, 1) rotate(-270.000000) translate(-11.500001, -12.000001) "/></g>
                                        </svg>
                                    </span>
                                    <span class='profileActionTitle flex'>Téma beállítása</span>
                                </div>
                                <div class="theme-body">
                                    <div class="theme-desc text-align-c">
                                        <span class="text-secondary text-small">Módosítsa az oldal megjelenését, hogy csökkentse a rikító fényt, és pihentesse a szemét.</span>
                                    </div>
                                    <div class="theme-button-con flex flex-col">
                                        <div class="theme-item flex flex-row">
                                            <div class="theme-button flex flex-align-c flex-justify-con-sb w-100">
                                                <span class="text-primary">Sötét mód</span>
                                                <label class="radio">
                                                    <input type="radio" name="radio" id="theme-dark" onclick="setTheme(this.id);">
                                                    <span class="checkmark"></span>
                                                </label>
                                            </div>
                                        </div>
                                        <div class="theme-item flex flex-row">
                                            <div class="theme-button flex flex-align-c flex-justify-con-sb w-100">
                                                <span class="text-primary">Fényes mód</span>
                                                <label class="radio">
                                                    <input type="radio" name="radio" id="theme-light" onclick="setTheme(this.id);">
                                                    <span class="checkmark"></span>
                                                </label>
                                            </div>
                                        </div>
                                        <div class="theme-item flex flex-row">
                                            <div class="theme-button flex flex-align-c flex-justify-con-sb w-100">
                                                <span class="text-primary">Automatikus</span>
                                                <label class="switch">
                                                    <input type="checkbox" id="theme-auto" checked="" onclick="setTheme(this.id);">
                                                    <span class="slider round"></span>
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        `;
                        <?php
                            echo "
                                const stafftheme = '". $theme ."';
                                if (stafftheme === 'auto') {const darkThemeMq = window.matchMedia('(prefers-color-scheme: light)');
                                    if (darkThemeMq.matches) {document.querySelector('html').dataset.theme = `theme-light`;                            
                                    } else {document.querySelector('html').dataset.theme = `theme-dark`;   }
                                } else {document.querySelector('html').dataset.theme = 'theme-' + stafftheme;   }
                            ";
                            include($_SERVER['DOCUMENT_ROOT'].'/includes/inc.connect.php');
                            $stmt = $con->prepare('SELECT theme FROM customers WHERE id = ?');
                            $stmt->bind_param('i', $_SESSION['id']);$stmt->execute();$stmt->bind_result($getTheme);
                            $stmt->fetch();$stmt->close();
                            echo "
                                var curTheme = '"; echo $getTheme; echo "';
                                if (localStorage.getItem('theme')) {localStorage.removeItem('theme');}
                                var auto = document.getElementById('theme-auto');var dark = document.getElementById('theme-dark');var light = document.getElementById('theme-light');
                                auto.removeAttribute('onclick');dark.removeAttribute('onclcik');light.removeAttribute('onclick');
                                dark.setAttribute('onclick', 'setTheme(this.id);');light.setAttribute('onclick', 'setTheme(this.id);');auto.setAttribute('onclick', 'setTheme(this.id);');
                                if (curTheme === 'light') {auto.checked = false;dark.checked = false;light.checked = true;} 
                                if (curTheme === 'dark') {auto.checked = false;dark.checked = true;light.checked = false;} 
                                if (curTheme === 'auto') {auto.checked = true;dark.checked = false;light.checked = false;}
                                $('#theme-dark').click(function () {document.getElementById('theme-auto').checked = false;document.getElementById('theme-dark').checked = true;document.getElementById('theme-light').checked = false;}); 
                                $('#theme-light').click(function () {document.getElementById('theme-auto').checked = false;document.getElementById('theme-dark').checked = false;document.getElementById('theme-light').checked = true;});
                                 $('#theme-auto').click(function () {document.getElementById('theme-auto').checked = true;document.getElementById('theme-dark').checked = false;document.getElementById('theme-light').checked = false;});
                            ";
                        ?>
                    });
                }
            };
        </script>
        <script>
            const staff_widget_button = document.getElementsByClassName('staff-widget-setting');
            for (let i = 0; i < staff_widget_button.length; i++) {staff_widget_button[i].id = "staff_widget_button" + i;
                const staff_widget_settings = document.createElement('div');staff_widget_settings.classList = 'staff_widget_settings flex flex-col border-soft item-bg box-shadow-dark absolute';staff_widget_settings.id = 'staff_widget_setting' + i;
                staff_widget_settings.innerHTML = `
                    <div class="staff_widget_item border-soft pointer">
                        <span class="text-primary flex flex-align-c justify-con-c">
                            <span>1 év</span>
                            <span></span>
                        </span>
                    </div>
                    <div class="staff_widget_item border-soft pointer flex flex-row">
                        <span class="text-primary flex flex-align-c flex-justify-con-sb w-100">
                            <span class="flex flex-align-c">30 nap</span>
                            <span class="flex flex-align-c">
                                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="1rem" height="1rem" viewBox="0 0 24 24" version="1.1">
                                    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"><polygon points="0 0 24 0 24 24 0 24"/><path d="M6.26193932,17.6476484 C5.90425297,18.0684559 5.27315905,18.1196257 4.85235158,17.7619393 C4.43154411,17.404253 4.38037434,16.773159 4.73806068,16.3523516 L13.2380607,6.35235158 C13.6013618,5.92493855 14.2451015,5.87991302 14.6643638,6.25259068 L19.1643638,10.2525907 C19.5771466,10.6195087 19.6143273,11.2515811 19.2474093,11.6643638 C18.8804913,12.0771466 18.2484189,12.1143273 17.8356362,11.7474093 L14.0997854,8.42665306 L6.26193932,17.6476484 Z" class="svg" fill-rule="nonzero" transform="translate(11.999995, 12.000002) rotate(-180.000000) translate(-11.999995, -12.000002) "/></g>
                                </svg>
                            </span>
                        </span>
                    </div>
                    <div class="staff_widget_item border-soft pointer">
                        <span class="text-primary flex flex-align-c justify-con-c">
                            <span>1 hét</span>
                            <span></span>
                        </span>
                    </div>
                    <div class="staff_widget_item border-soft pointer">
                        <span class="text-primary flex flex-align-c justify-con-c">
                            <span>Mai nap</span>
                            <span></span>
                        </span>
                    </div>
                `;

                let cc = 0;
                document.getElementById('staff_widget_button' + i).addEventListener('click', (e) => {cc++;
                    if (cc % 2 == 0) {document.getElementById('staff_widget_button' + i).classList.remove('widget-active');staff_widget_settings.remove();
                    } else {document.getElementById('staff_widget_button' + i).classList.add('widget-active');document.getElementById('staff_widget_button' + i).parentNode.parentNode.append(staff_widget_settings);}
                });
            }
        </script>
    </body>
</html>