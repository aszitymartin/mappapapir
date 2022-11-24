<?php
    session_start(); require_once($_SERVER['DOCUMENT_ROOT'].'/assets/alph.php');

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
       echo "<script>if (localStorage.getItem('staffLock')) {localStorage.removeItem('staffLock');}</script>";
    }

    $DATABASE_HOST = 'localhost';$DATABASE_USER = 'root';$DATABASE_PASS = 'eKi=0630OG';$DATABASE_NAME = 'mappapapir';
    $con = mysqli_connect($DATABASE_HOST, $DATABASE_USER, $DATABASE_PASS, $DATABASE_NAME);
    if (mysqli_connect_errno()) {header ("Location: /500");echo "<script>const now = new Date();const notifParams = {notifType : '1',notifIcon : '2',notifTheme : '2',notifTitle : 'Hiba',notifDesc : 'Szerver oldali hiba történt.',expiry : now.setSeconds(60)};localStorage.setItem('NP', JSON.stringify(notifParams));window.location.href= '../';</script>";}

    $stmt = $con->prepare('SELECT id, fullname, email, theme FROM customers WHERE id = ?');
    if (isset($_SESSION['loggedin'])) {$id = $_SESSION['id']; if ($id != 1) {header('Location: /');}
    } else {header('Location: /');}
    $stmt->bind_param('i', $id);$stmt->execute(); $stmt->bind_result($id, $fullname, $email, $theme); $stmt->fetch();$stmt->close();
?>
<!DOCTYPE html>
<html lang="HU">
    <head>
        <meta http-equiv="content-type" content="text/html; charset=utf-8" />
        <meta name="keywords" content="tuzogép,fénymásolópapír,békéscsaba,eagle,kiszállítás,békéscsaba,írószer,irodaszer,nagyker, nagykereskedelem,ingyen,cd,dvd,zebra,boríték,füzet,dosszié,toll, golyóstoll,papír,atbt,iratrendezo,verbatim,import" />
        <meta name="rights" content="Mappa Papír" />
        <meta name="description" content="Mappa Papír Irodaszer nagykereskedelem. Kiskunhalason és környékén ingyenes kiszállítás." />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <meta name="apple-mobile-web-app-capable" content="yes" />
        <link rel="stylesheet" content-type="text/css" href="/assets/style/main.css" />
        <link href="/assets/icons/favicon.ico" rel="shortcut icon" type="image/vnd.microsoft.icon" />
        <script src="/assets/script/jquery/jquery.js" content-type="application/javascript"></script>
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
                <div class="staff-main-header flex flex-align-c flex-justify-con-c flex-wrap flex-row">
                    <div class="staff-header-item flex flex-col padding-1 border-soft item-bg">
                        <div class="staff-info-header flex flex-row flex-align-c flex-justify-con-sb">
                            <div class="staff-info-icon flex flex-align-c border-box padding-05 item-bg-light border-soft">
                                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="1.5rem" height="1.5rem" viewBox="0 0 24 24" version="1.1">
                                    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"><rect x="0" y="0" width="24" height="24"></rect><path d="M20.4061385,6.73606154 C20.7672665,6.89656288 21,7.25468437 21,7.64987309 L21,16.4115967 C21,16.7747638 20.8031081,17.1093844 20.4856429,17.2857539 L12.4856429,21.7301984 C12.1836204,21.8979887 11.8163796,21.8979887 11.5143571,21.7301984 L3.51435707,17.2857539 C3.19689188,17.1093844 3,16.7747638 3,16.4115967 L3,7.64987309 C3,7.25468437 3.23273352,6.89656288 3.59386153,6.73606154 L11.5938615,3.18050598 C11.8524269,3.06558805 12.1475731,3.06558805 12.4061385,3.18050598 L20.4061385,6.73606154 Z" class="svg" opacity="0.3"></path><polygon class="svg" points="14.9671522 4.22441676 7.5999999 8.31727912 7.5999999 12.9056825 9.5999999 13.9056825 9.5999999 9.49408582 17.25507 5.24126912"></polygon></g>
                                </svg>
                            </div>
                            <div class="flex flex-align-c border-box padding-05 pointer staff-widget-setting relative">
                                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="1.5rem" height="1.5rem" viewBox="0 0 24 24" version="1.1">
                                    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"><rect x="0" y="0" width="24" height="24"/><circle class="svg" cx="5" cy="12" r="2"/><circle class="svg" cx="12" cy="12" r="2"/><circle class="svg" cx="19" cy="12" r="2"/></g>
                                </svg>
                            </div>
                        </div>
                        <div class="staff-info-body flex flex-col">
                            <div class="staff-info-value flex flex-col w-100 flex-align-c flex-justify-con-c">
                                <span class="text-primary bold">28 db</span>
                                <span class="small text-secondary light">30 nap</span>
                            </div>
                        </div>
                        <div class="staff-info-footer flex flex-col">
                            <div class="staff-info-chart flex flex-row flex-align-c">
                                <span class="staff-info-chart-icon flex">
                                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="1.5rem" height="1.5rem" viewBox="0 0 24 24" version="1.1">
                                        <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"><rect x="0" y="0" width="24" height="24"/><path d="M5,19 L20,19 C20.5522847,19 21,19.4477153 21,20 C21,20.5522847 20.5522847,21 20,21 L4,21 C3.44771525,21 3,20.5522847 3,20 L3,4 C3,3.44771525 3.44771525,3 4,3 C4.55228475,3 5,3.44771525 5,4 L5,19 Z" class="svg" fill-rule="nonzero"/><path d="M8.7295372,14.6839411 C8.35180695,15.0868534 7.71897114,15.1072675 7.31605887,14.7295372 C6.9131466,14.3518069 6.89273254,13.7189711 7.2704628,13.3160589 L11.0204628,9.31605887 C11.3857725,8.92639521 11.9928179,8.89260288 12.3991193,9.23931335 L15.358855,11.7649545 L19.2151172,6.88035571 C19.5573373,6.44687693 20.1861655,6.37289714 20.6196443,6.71511723 C21.0531231,7.05733733 21.1271029,7.68616551 20.7848828,8.11964429 L16.2848828,13.8196443 C15.9333973,14.2648593 15.2823707,14.3288915 14.8508807,13.9606866 L11.8268294,11.3801628 L8.7295372,14.6839411 Z" class="svg" fill-rule="nonzero" opacity="0.3"/></g>
                                    </svg>
                                </span>
                                <span class="staff-info-chart-value flex">
                                    <span class="text-success">+3.50%</span>
                                </span>
                            </div>
                        </div>
                        <div class="staff-info-title primary-bg box-shadow border-soft flex absolute">
                            <span class="contrast-color">Rendelések</span>
                        </div>
                    </div>
                    <div class="staff-header-item flex flex-col padding-1 border-soft item-bg">
                        <div class="staff-info-header flex flex-row flex-align-c flex-justify-con-sb">
                            <div class="staff-info-icon flex flex-align-c border-box padding-05 item-bg-light border-soft">
                                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="1.5rem" height="1.5rem" viewBox="0 0 24 24" version="1.1">
                                    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"><rect x="0" y="0" width="24" height="24"/><path d="M2,6 L21,6 C21.5522847,6 22,6.44771525 22,7 L22,17 C22,17.5522847 21.5522847,18 21,18 L2,18 C1.44771525,18 1,17.5522847 1,17 L1,7 C1,6.44771525 1.44771525,6 2,6 Z M11.5,16 C13.709139,16 15.5,14.209139 15.5,12 C15.5,9.790861 13.709139,8 11.5,8 C9.290861,8 7.5,9.790861 7.5,12 C7.5,14.209139 9.290861,16 11.5,16 Z" class="svg" opacity="0.3" transform="translate(11.500000, 12.000000) rotate(-345.000000) translate(-11.500000, -12.000000) "/><path d="M2,6 L21,6 C21.5522847,6 22,6.44771525 22,7 L22,17 C22,17.5522847 21.5522847,18 21,18 L2,18 C1.44771525,18 1,17.5522847 1,17 L1,7 C1,6.44771525 1.44771525,6 2,6 Z M11.5,16 C13.709139,16 15.5,14.209139 15.5,12 C15.5,9.790861 13.709139,8 11.5,8 C9.290861,8 7.5,9.790861 7.5,12 C7.5,14.209139 9.290861,16 11.5,16 Z M11.5,14 C12.6045695,14 13.5,13.1045695 13.5,12 C13.5,10.8954305 12.6045695,10 11.5,10 C10.3954305,10 9.5,10.8954305 9.5,12 C9.5,13.1045695 10.3954305,14 11.5,14 Z" class="svg"/></g>
                                </svg>
                            </div>
                            <div class="flex flex-align-c border-box padding-05 pointer staff-widget-setting relative">
                                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="1.5rem" height="1.5rem" viewBox="0 0 24 24" version="1.1">
                                    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"><rect x="0" y="0" width="24" height="24"/><circle class="svg" cx="5" cy="12" r="2"/><circle class="svg" cx="12" cy="12" r="2"/><circle class="svg" cx="19" cy="12" r="2"/></g>
                                </svg>
                            </div>
                        </div>
                        <div class="staff-info-body flex flex-col">
                            <div class="staff-info-value flex flex-col w-100 flex-align-c flex-justify-con-c">
                                <span class="text-primary bold">35.000 Ft</span>
                                <span class="small text-secondary light">30 nap</span>
                            </div>
                        </div>
                        <div class="staff-info-footer flex flex-col">
                            <div class="staff-info-chart flex flex-row flex-align-c">
                                <span class="staff-info-chart-icon flex">
                                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="1.5rem" height="1.5rem" viewBox="0 0 24 24" version="1.1">
                                        <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"><rect x="0" y="0" width="24" height="24"/><path d="M5,19 L20,19 C20.5522847,19 21,19.4477153 21,20 C21,20.5522847 20.5522847,21 20,21 L4,21 C3.44771525,21 3,20.5522847 3,20 L3,4 C3,3.44771525 3.44771525,3 4,3 C4.55228475,3 5,3.44771525 5,4 L5,19 Z" class="svg" fill-rule="nonzero"/><path d="M8.7295372,14.6839411 C8.35180695,15.0868534 7.71897114,15.1072675 7.31605887,14.7295372 C6.9131466,14.3518069 6.89273254,13.7189711 7.2704628,13.3160589 L11.0204628,9.31605887 C11.3857725,8.92639521 11.9928179,8.89260288 12.3991193,9.23931335 L15.358855,11.7649545 L19.2151172,6.88035571 C19.5573373,6.44687693 20.1861655,6.37289714 20.6196443,6.71511723 C21.0531231,7.05733733 21.1271029,7.68616551 20.7848828,8.11964429 L16.2848828,13.8196443 C15.9333973,14.2648593 15.2823707,14.3288915 14.8508807,13.9606866 L11.8268294,11.3801628 L8.7295372,14.6839411 Z" class="svg" fill-rule="nonzero" opacity="0.3"/></g>
                                    </svg>
                                </span>
                                <span class="staff-info-chart-value flex">
                                    <span class="text-success">+13.75%</span>
                                </span>
                            </div>
                        </div>
                        <div class="staff-info-title primary-bg box-shadow border-soft flex absolute">
                            <span class="contrast-color">Profit</span>
                        </div>
                    </div>
                    <div class="staff-header-item flex flex-col padding-1 border-soft item-bg">
                        <div class="staff-info-header flex flex-row flex-align-c flex-justify-con-sb">
                            <div class="staff-info-icon flex flex-align-c border-box padding-05 item-bg-light border-soft">
                                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="1.5rem" height="1.5rem" viewBox="0 0 24 24" version="1.1">
                                    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"><rect x="0" y="0" width="24" height="24"/><rect class="svg" opacity="0.3" x="11.5" y="2" width="2" height="4" rx="1"/><rect class="svg" opacity="0.3" x="11.5" y="16" width="2" height="5" rx="1"/><path d="M15.493,8.044 C15.2143319,7.68933156 14.8501689,7.40750104 14.4005,7.1985 C13.9508311,6.98949895 13.5170021,6.885 13.099,6.885 C12.8836656,6.885 12.6651678,6.90399981 12.4435,6.942 C12.2218322,6.98000019 12.0223342,7.05283279 11.845,7.1605 C11.6676658,7.2681672 11.5188339,7.40749914 11.3985,7.5785 C11.2781661,7.74950085 11.218,7.96799867 11.218,8.234 C11.218,8.46200114 11.2654995,8.65199924 11.3605,8.804 C11.4555005,8.95600076 11.5948324,9.08899943 11.7785,9.203 C11.9621676,9.31700057 12.1806654,9.42149952 12.434,9.5165 C12.6873346,9.61150047 12.9723317,9.70966616 13.289,9.811 C13.7450023,9.96300076 14.2199975,10.1308324 14.714,10.3145 C15.2080025,10.4981676 15.6576646,10.7419985 16.063,11.046 C16.4683354,11.3500015 16.8039987,11.7268311 17.07,12.1765 C17.3360013,12.6261689 17.469,13.1866633 17.469,13.858 C17.469,14.6306705 17.3265014,15.2988305 17.0415,15.8625 C16.7564986,16.4261695 16.3733357,16.8916648 15.892,17.259 C15.4106643,17.6263352 14.8596698,17.8986658 14.239,18.076 C13.6183302,18.2533342 12.97867,18.342 12.32,18.342 C11.3573285,18.342 10.4263378,18.1741683 9.527,17.8385 C8.62766217,17.5028317 7.88033631,17.0246698 7.285,16.404 L9.413,14.238 C9.74233498,14.6433354 10.176164,14.9821653 10.7145,15.2545 C11.252836,15.5268347 11.7879973,15.663 12.32,15.663 C12.5606679,15.663 12.7949989,15.6376669 13.023,15.587 C13.2510011,15.5363331 13.4504991,15.4540006 13.6215,15.34 C13.7925009,15.2259994 13.9286662,15.0740009 14.03,14.884 C14.1313338,14.693999 14.182,14.4660013 14.182,14.2 C14.182,13.9466654 14.1186673,13.7313342 13.992,13.554 C13.8653327,13.3766658 13.6848345,13.2151674 13.4505,13.0695 C13.2161655,12.9238326 12.9248351,12.7908339 12.5765,12.6705 C12.2281649,12.5501661 11.8323355,12.420334 11.389,12.281 C10.9583312,12.141666 10.5371687,11.9770009 10.1255,11.787 C9.71383127,11.596999 9.34650161,11.3531682 9.0235,11.0555 C8.70049838,10.7578318 8.44083431,10.3968355 8.2445,9.9725 C8.04816568,9.54816454 7.95,9.03200304 7.95,8.424 C7.95,7.67666293 8.10199848,7.03700266 8.406,6.505 C8.71000152,5.97299734 9.10899753,5.53600171 9.603,5.194 C10.0970025,4.85199829 10.6543302,4.60183412 11.275,4.4435 C11.8956698,4.28516587 12.5226635,4.206 13.156,4.206 C13.9160038,4.206 14.6918294,4.34533194 15.4835,4.624 C16.2751706,4.90266806 16.9686637,5.31433061 17.564,5.859 L15.493,8.044 Z" class="svg"/></g>
                                </svg>
                            </div>
                            <div class="flex flex-align-c border-box padding-05 pointer staff-widget-setting relative">
                                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="1.5rem" height="1.5rem" viewBox="0 0 24 24" version="1.1">
                                    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"><rect x="0" y="0" width="24" height="24"/><circle class="svg" cx="5" cy="12" r="2"/><circle class="svg" cx="12" cy="12" r="2"/><circle class="svg" cx="19" cy="12" r="2"/></g>
                                </svg>
                            </div>
                        </div>
                        <div class="staff-info-body flex flex-col">
                            <div class="staff-info-value flex flex-col w-100 flex-align-c flex-justify-con-c">
                                <span class="text-primary bold">28 db</span>
                                <span class="small text-secondary light">30 nap</span>
                            </div>
                        </div>
                        <div class="staff-info-footer flex flex-col">
                            <div class="staff-info-chart flex flex-row flex-align-c">
                                <span class="staff-info-chart-icon flex">
                                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="1.5rem" height="1.5rem" viewBox="0 0 24 24" version="1.1">
                                        <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"><rect x="0" y="0" width="24" height="24"/><path d="M5,19 L20,19 C20.5522847,19 21,19.4477153 21,20 C21,20.5522847 20.5522847,21 20,21 L4,21 C3.44771525,21 3,20.5522847 3,20 L3,4 C3,3.44771525 3.44771525,3 4,3 C4.55228475,3 5,3.44771525 5,4 L5,19 Z" class="svg" fill-rule="nonzero"/><path d="M8.7295372,14.6839411 C8.35180695,15.0868534 7.71897114,15.1072675 7.31605887,14.7295372 C6.9131466,14.3518069 6.89273254,13.7189711 7.2704628,13.3160589 L11.0204628,9.31605887 C11.3857725,8.92639521 11.9928179,8.89260288 12.3991193,9.23931335 L15.358855,11.7649545 L19.2151172,6.88035571 C19.5573373,6.44687693 20.1861655,6.37289714 20.6196443,6.71511723 C21.0531231,7.05733733 21.1271029,7.68616551 20.7848828,8.11964429 L16.2848828,13.8196443 C15.9333973,14.2648593 15.2823707,14.3288915 14.8508807,13.9606866 L11.8268294,11.3801628 L8.7295372,14.6839411 Z" class="svg" fill-rule="nonzero" opacity="0.3"/></g>
                                    </svg>
                                </span>
                                <span class="staff-info-chart-value flex">
                                    <span class="text-success">+3.50%</span>
                                </span>
                            </div>
                        </div>
                        <div class="staff-info-title primary-bg box-shadow border-soft flex absolute">
                            <span class="contrast-color">Bevétel</span>
                        </div>
                    </div>
                    <div class="staff-header-item flex flex-col padding-1 border-soft item-bg">
                        <div class="staff-info-header flex flex-row flex-align-c flex-justify-con-sb">
                            <div class="staff-info-icon flex flex-align-c border-box padding-05 item-bg-light border-soft">
                                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="1.5rem" height="1.5rem" viewBox="0 0 24 24" version="1.1">
                                    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"><polygon points="0 0 24 0 24 24 0 24"></polygon><path d="M12,11 C9.790861,11 8,9.209139 8,7 C8,4.790861 9.790861,3 12,3 C14.209139,3 16,4.790861 16,7 C16,9.209139 14.209139,11 12,11 Z" class="svg" fill-rule="nonzero" opacity="0.3"></path><path d="M3.00065168,20.1992055 C3.38825852,15.4265159 7.26191235,13 11.9833413,13 C16.7712164,13 20.7048837,15.2931929 20.9979143,20.2 C21.0095879,20.3954741 20.9979143,21 20.2466999,21 C16.541124,21 11.0347247,21 3.72750223,21 C3.47671215,21 2.97953825,20.45918 3.00065168,20.1992055 Z" class="svg" fill-rule="nonzero"></path></g>
                                </svg>
                            </div>
                            <div class="flex flex-align-c border-box padding-05 pointer staff-widget-setting relative">
                                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="1.5rem" height="1.5rem" viewBox="0 0 24 24" version="1.1">
                                    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"><rect x="0" y="0" width="24" height="24"/><circle class="svg" cx="5" cy="12" r="2"/><circle class="svg" cx="12" cy="12" r="2"/><circle class="svg" cx="19" cy="12" r="2"/></g>
                                </svg>
                            </div>
                        </div>
                        <div class="staff-info-body flex flex-col">
                            <div class="staff-info-value flex flex-col w-100 flex-align-c flex-justify-con-c">
                                <span class="text-primary bold"> 
                                    <?php
                                    $DATABASE_HOST = 'localhost';$DATABASE_USER = 'root';$DATABASE_PASS = 'eKi=0630OG';$DATABASE_NAME = 'mappapapir';
                                    $con = mysqli_connect($DATABASE_HOST, $DATABASE_USER, $DATABASE_PASS, $DATABASE_NAME);
                                    if (mysqli_connect_errno()) {die ("0");}$sql = "SELECT * FROM customers WHERE 1";
                                    if ($result = mysqli_query($con, $sql)) {$num = mysqli_num_rows($result);}echo $num;
                                    ?>
                                    fő
                                </span>
                                <span class="small text-secondary light">30 nap</span>
                            </div>
                        </div>
                        <div class="staff-info-footer flex flex-col">
                            <div class="staff-info-chart flex flex-row flex-align-c">
                                <span class="staff-info-chart-icon flex">
                                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="1.5rem" height="1.5rem" viewBox="0 0 24 24" version="1.1">
                                        <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"><rect x="0" y="0" width="24" height="24"/><path d="M5,19 L20,19 C20.5522847,19 21,19.4477153 21,20 C21,20.5522847 20.5522847,21 20,21 L4,21 C3.44771525,21 3,20.5522847 3,20 L3,4 C3,3.44771525 3.44771525,3 4,3 C4.55228475,3 5,3.44771525 5,4 L5,19 Z" class="svg" fill-rule="nonzero"/><path d="M8.7295372,14.6839411 C8.35180695,15.0868534 7.71897114,15.1072675 7.31605887,14.7295372 C6.9131466,14.3518069 6.89273254,13.7189711 7.2704628,13.3160589 L11.0204628,9.31605887 C11.3857725,8.92639521 11.9928179,8.89260288 12.3991193,9.23931335 L15.358855,11.7649545 L19.2151172,6.88035571 C19.5573373,6.44687693 20.1861655,6.37289714 20.6196443,6.71511723 C21.0531231,7.05733733 21.1271029,7.68616551 20.7848828,8.11964429 L16.2848828,13.8196443 C15.9333973,14.2648593 15.2823707,14.3288915 14.8508807,13.9606866 L11.8268294,11.3801628 L8.7295372,14.6839411 Z" class="svg" fill-rule="nonzero" opacity="0.3" transform="translate(14.000019, 10.749981) scale(1, -1) translate(-14.000019, -10.749981) "/></g>
                                    </svg>
                                </span>
                                <span class="staff-info-chart-value flex">
                                    <span class="text-danger">+13.75%</span>
                                </span>
                            </div>
                        </div>
                        <div class="staff-info-title primary-bg box-shadow border-soft flex absolute">
                            <span class="contrast-color">Felhasználók</span>
                        </div>
                    </div>
                </div>
            </section>
            <section class="main_section staff-section flex flex-col flex-wrap flex-align-c flex-justify-con-c" style="margin-bottom: 4rem;">
                <div class="staff-home flex flex-col flex-align-c flex-justify-con-c flex-wrap">
                    <div class="staff-home-body flex flex-wrap flex-justify-con-c flex-row">
                        <div class="staff-home-action flex flex-row flex-align-c user-select-none flex-justify-con-c flex-100 relative" onclick="staffAuth()">
                            <div class="staff-label flex flex-align-c absolute">
                                <div class="has-tooltip relative" aria-describedby="admin-only">
                                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="1rem" height="1rem" viewBox="0 0 24 24" version="1.1">
                                        <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"><rect x="0" y="0" width="24" height="24"></rect><polygon class="svg" opacity="0.3" transform="translate(8.885842, 16.114158) rotate(-315.000000) translate(-8.885842, -16.114158) " points="6.89784488 10.6187476 6.76452164 19.4882481 8.88584198 21.6095684 11.0071623 19.4882481 9.59294876 18.0740345 10.9659914 16.7009919 9.55177787 15.2867783 11.0071623 13.8313939 10.8837471 10.6187476"></polygon><path d="M15.9852814,14.9852814 C12.6715729,14.9852814 9.98528137,12.2989899 9.98528137,8.98528137 C9.98528137,5.67157288 12.6715729,2.98528137 15.9852814,2.98528137 C19.2989899,2.98528137 21.9852814,5.67157288 21.9852814,8.98528137 C21.9852814,12.2989899 19.2989899,14.9852814 15.9852814,14.9852814 Z M16.1776695,9.07106781 C17.0060967,9.07106781 17.6776695,8.39949494 17.6776695,7.57106781 C17.6776695,6.74264069 17.0060967,6.07106781 16.1776695,6.07106781 C15.3492424,6.07106781 14.6776695,6.74264069 14.6776695,7.57106781 C14.6776695,8.39949494 15.3492424,9.07106781 16.1776695,9.07106781 Z" class="svg" transform="translate(15.985281, 8.985281) rotate(-315.000000) translate(-15.985281, -8.985281) "></path></g>
                                    </svg>
                                    <span class="tooltip absolute" id="admin-only">Rendszergazda</span>
                                </div>
                            </div>
                            <div class="staff-action-header">
                                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="3rem" height="3rem" viewBox="0 0 24 24" version="1.1">
                                    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"><polygon points="0 0 24 0 24 24 0 24"/><path d="M12,11 C9.790861,11 8,9.209139 8,7 C8,4.790861 9.790861,3 12,3 C14.209139,3 16,4.790861 16,7 C16,9.209139 14.209139,11 12,11 Z" class="svg" fill-rule="nonzero" opacity="0.3"/><path d="M3.00065168,20.1992055 C3.38825852,15.4265159 7.26191235,13 11.9833413,13 C16.7712164,13 20.7048837,15.2931929 20.9979143,20.2 C21.0095879,20.3954741 20.9979143,21 20.2466999,21 C16.541124,21 11.0347247,21 3.72750223,21 C3.47671215,21 2.97953825,20.45918 3.00065168,20.1992055 Z" class="svg" fill-rule="nonzero"/></g>
                                </svg>
                            </div>
                            <div class="staff-action-body flex flex-col">
                                <span class="staff-action-title text-primary bold">Felhasználókezelés</span>
                                <span class="staff-action-info text-secondary">Felhasználói beállítások kezelése</span>
                            </div>
                        </div>
                        <div class="staff-home-action flex flex-row flex-align-c user-select-none relative" id="feedbacks">
                            <script content-type="application/javascript">
                                $(document).ready(function () {
                                    $.ajax({
                                        type: "GET", url: "actions/feedback-all.php",
                                        // Sikeres/Sikertelen akciok kimenetelenek lekezelese ertesitesekkel, hogy emberbaratabb legyen az oldal.
                                        success: function(data) {
                                            if (Number(data) > 0) {var badge = document.createElement('div');badge.classList = 'badge flex flex-align-c flex-justify-con-c absolute box-shadow';badge.innerHTML = `<span class="badge-text" id="feedback-badge">${Number(data)}</span>`; document.getElementById('feedbacks').prepend(badge);}
                                        }, error: function (err) { console.log(err); }
                                    });
                                });
                            </script>
                            <div class="staff-action-header">
                                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="3rem" height="3rem" viewBox="0 0 24 24" version="1.1">
                                    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"><rect x="0" y="0" width="24" height="24"/><path d="M3.5,3 L5,3 L5,19.5 C5,20.3284271 4.32842712,21 3.5,21 L3.5,21 C2.67157288,21 2,20.3284271 2,19.5 L2,4.5 C2,3.67157288 2.67157288,3 3.5,3 Z" class="svg"/><path d="M6.99987583,2.99995344 L19.754647,2.99999303 C20.3069317,2.99999474 20.7546456,3.44771138 20.7546439,3.99999613 C20.7546431,4.24703684 20.6631995,4.48533385 20.497938,4.66895776 L17.5,8 L20.4979317,11.3310353 C20.8673908,11.7415453 20.8341123,12.3738351 20.4236023,12.7432941 C20.2399776,12.9085564 20.0016794,13 19.7546376,13 L6.99987583,13 L6.99987583,2.99995344 Z" class="svg" opacity="0.3"/></g>
                                </svg>
                            </div>
                            <div class="staff-action-body flex flex-col">
                                <span class="staff-action-title text-primary bold">Visszajelzések kezelése</span>
                                <span class="staff-action-info text-secondary">Kezelje az oldallal kapcsolatos visszajelzéseket</span>
                            </div>
                        </div>
                        <div class="staff-home-action flex flex-row flex-align-c user-select-none" id="products">
                            <div class="staff-action-header">
                                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="3rem" height="3rem" viewBox="0 0 24 24" version="1.1">
                                    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"><rect x="0" y="0" width="24" height="24"/><path d="M8,3 L8,3.5 C8,4.32842712 8.67157288,5 9.5,5 L14.5,5 C15.3284271,5 16,4.32842712 16,3.5 L16,3 L18,3 C19.1045695,3 20,3.8954305 20,5 L20,21 C20,22.1045695 19.1045695,23 18,23 L6,23 C4.8954305,23 4,22.1045695 4,21 L4,5 C4,3.8954305 4.8954305,3 6,3 L8,3 Z" class="svg" opacity="0.3"/><path d="M11,2 C11,1.44771525 11.4477153,1 12,1 C12.5522847,1 13,1.44771525 13,2 L14.5,2 C14.7761424,2 15,2.22385763 15,2.5 L15,3.5 C15,3.77614237 14.7761424,4 14.5,4 L9.5,4 C9.22385763,4 9,3.77614237 9,3.5 L9,2.5 C9,2.22385763 9.22385763,2 9.5,2 L11,2 Z" class="svg"/><rect class="svg" opacity="0.3" x="7" y="10" width="5" height="2" rx="1"/><rect class="svg" opacity="0.3" x="7" y="14" width="9" height="2" rx="1"/></g>
                                </svg>
                            </div>
                            <div class="staff-action-body flex flex-col">
                                <span class="staff-action-title text-primary bold">Termékek kezelése</span>
                                <span class="staff-action-info text-secondary">Termékek hozzáadása, eltávolítása vagy szerkesztése</span>
                            </div>
                        </div>
                        <div class="staff-home-action flex flex-row flex-align-c user-select-none" id="orders">
                            <div class="staff-action-header">
                                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="3rem" height="3rem" viewBox="0 0 24 24" version="1.1">
                                    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                        <rect x="0" y="0" width="24" height="24"></rect>
                                        <path d="M20.4061385,6.73606154 C20.7672665,6.89656288 21,7.25468437 21,7.64987309 L21,16.4115967 C21,16.7747638 20.8031081,17.1093844 20.4856429,17.2857539 L12.4856429,21.7301984 C12.1836204,21.8979887 11.8163796,21.8979887 11.5143571,21.7301984 L3.51435707,17.2857539 C3.19689188,17.1093844 3,16.7747638 3,16.4115967 L3,7.64987309 C3,7.25468437 3.23273352,6.89656288 3.59386153,6.73606154 L11.5938615,3.18050598 C11.8524269,3.06558805 12.1475731,3.06558805 12.4061385,3.18050598 L20.4061385,6.73606154 Z" class="svg" opacity="0.3"></path>
                                        <polygon class="svg" points="14.9671522 4.22441676 7.5999999 8.31727912 7.5999999 12.9056825 9.5999999 13.9056825 9.5999999 9.49408582 17.25507 5.24126912"></polygon>
                                    </g>
                                </svg>
                            </div>
                            <div class="staff-action-body flex flex-col">
                                <span class="staff-action-title text-primary bold">Megrendelések kezelése</span>
                                <span class="staff-action-info text-secondary">Megrendelések ellenőrzése és kezelése vagy elvetése</span>
                            </div>
                        </div>
                        <div class="staff-home-action flex flex-row flex-align-c user-select-none">
                            <div class="staff-action-header">
                                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="3rem" height="3rem" viewBox="0 0 24 24" version="1.1">
                                    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                        <rect x="0" y="0" width="24" height="24"></rect>
                                        <path d="M18.1446364,11.84388 L17.4471627,16.0287218 C17.4463569,16.0335568 17.4455155,16.0383857 17.4446387,16.0432083 C17.345843,16.5865846 16.8252597,16.9469884 16.2818833,16.8481927 L4.91303792,14.7811299 C4.53842737,14.7130189 4.23500006,14.4380834 4.13039941,14.0719812 L2.30560137,7.68518803 C2.28007524,7.59584656 2.26712532,7.50338343 2.26712532,7.4104669 C2.26712532,6.85818215 2.71484057,6.4104669 3.26712532,6.4104669 L16.9929851,6.4104669 L17.606173,3.78251876 C17.7307772,3.24850086 18.2068633,2.87071314 18.7552257,2.87071314 L20.8200821,2.87071314 C21.4717328,2.87071314 22,3.39898039 22,4.05063106 C22,4.70228173 21.4717328,5.23054898 20.8200821,5.23054898 L19.6915238,5.23054898 L18.1446364,11.84388 Z" class="svg" opacity="0.3"></path>
                                        <path d="M6.5,21 C5.67157288,21 5,20.3284271 5,19.5 C5,18.6715729 5.67157288,18 6.5,18 C7.32842712,18 8,18.6715729 8,19.5 C8,20.3284271 7.32842712,21 6.5,21 Z M15.5,21 C14.6715729,21 14,20.3284271 14,19.5 C14,18.6715729 14.6715729,18 15.5,18 C16.3284271,18 17,18.6715729 17,19.5 C17,20.3284271 16.3284271,21 15.5,21 Z" class="svg"></path>
                                    </g>
                                </svg>
                            </div>
                            <div class="staff-action-body flex flex-col">
                                <span class="staff-action-title text-primary bold">Szállítás kezelése</span>
                                <span class="staff-action-info text-secondary">Ellenőrizze a szállítási állapotokat</span>
                            </div>
                        </div>
                        <div class="staff-home-action flex flex-row flex-align-c user-select-none">
                            <div class="staff-action-header">
                                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="3rem" height="3rem" viewBox="0 0 24 24" version="1.1">
                                    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                        <rect x="0" y="0" width="24" height="24"/>
                                        <path d="M4.00246329,12.2004927 L13,14 L13,4.06189375 C16.9463116,4.55399184 20,7.92038235 20,12 C20,16.418278 16.418278,20 12,20 C7.64874861,20 4.10886412,16.5261253 4.00246329,12.2004927 Z" class="svg" opacity="0.3"/>
                                        <path d="M3.0603968,10.0120794 C3.54712466,6.05992157 6.91622084,3 11,3 L11,11.6 L3.0603968,10.0120794 Z" class="svg"/>
                                    </g>
                                </svg>
                            </div>
                            <div class="staff-action-body flex flex-col">
                                <span class="staff-action-title text-primary bold">Statisztika megtekintése</span>
                                <span class="staff-action-info text-secondary">Tekintse meg az oldal statisztikáit és visszajelzéseit</span>
                            </div>
                        </div>
                        <div class="staff-home-action flex flex-row flex-align-c user-select-none">
                            <div class="staff-action-header">
                                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="3rem" height="3rem" viewBox="0 0 24 24" version="1.1">
                                    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"><rect x="0" y="0" width="24" height="24"></rect><path d="M19,16 L19,12 C19,8.13400675 15.8659932,5 12,5 C8.13400675,5 5,8.13400675 5,12 L5,16 L19,16 Z M21,16 L3,16 L3,12 C3,7.02943725 7.02943725,3 12,3 C16.9705627,3 21,7.02943725 21,12 L21,16 Z" class="svg" fill-rule="nonzero" opacity="0.3"></path><path d="M5,14 L6,14 C7.1045695,14 8,14.8954305 8,16 L8,19 C8,20.1045695 7.1045695,21 6,21 L5,21 C3.8954305,21 3,20.1045695 3,19 L3,16 C3,14.8954305 3.8954305,14 5,14 Z M18,14 L19,14 C20.1045695,14 21,14.8954305 21,16 L21,19 C21,20.1045695 20.1045695,21 19,21 L18,21 C16.8954305,21 16,20.1045695 16,19 L16,16 C16,14.8954305 16.8954305,14 18,14 Z" class="svg"></path></g>
                                </svg>
                            </div>
                            <div class="staff-action-body flex flex-col">
                                <span class="staff-action-title text-primary bold">Ügyfélszolgálat</span>
                                <span class="staff-action-info text-secondary">Tekintse meg az oldal statisztikáit és visszajelzéseit</span>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </main>
    <div>
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
                    <script content-type='application/javascript'>
                    const theme = '". $theme ."';
                    if (theme === 'auto') {
                        const darkThemeMq = window.matchMedia('(prefers-color-scheme: light)');
                        if (darkThemeMq.matches) {
                            document.querySelector('html').dataset.theme = `theme-light`;                            
                        } else {
                            document.querySelector('html').dataset.theme = `theme-dark`;   
                        }
                    } else {
                        document.querySelector('html').dataset.theme = 'theme-' + theme;   
                    }
                    </script>
                ";
            } else {
                echo "
                    <script content-type='application/javascript'>
                        const darkThemeMq = window.matchMedia('(prefers-color-scheme: light)');
                        if (!localStorage.getItem('theme')) {
                            if (darkThemeMq.matches) {
                                document.querySelector('html').dataset.theme = `theme-light`;                            
                            } else {
                                document.querySelector('html').dataset.theme = `theme-dark`;   
                            }
                        } else {
                            document.querySelector('html').dataset.theme = localStorage.getItem('theme');
                        }
                    </script>
                ";
            }
        ?>
        <!-- Letfontossagu funkciok kezelese -->
        <script src="script/actions.js" content-type="application/javascript"></script>
        <!-- Fejlec kezelese -->
        <script src="/assets/script/header.js" content-type="application/javascript"></script>
        <!-- Panelek kezelese -->
        <script content-type="application/javascript">
            var profileActionsContainer = document.createElement('div');var transWrapper = document.createElement('div');
            transWrapper.classList.add('transWrapper');profileActionsContainer.id = 'profileHeaderContainer';let cC = 1;
            function openHeaderProfileActionLogged  () {cC++;
                if (cC % 2 == 0) {
                    document.getElementById('header_con').classList.add('relative');showProfileActionPanel();
                    document.body.append(transWrapper);document.getElementById('header_con').append(profileActionsContainer);
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
                                                <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                    <rect x="0" y="0" width="24" height="24"/>
                                                    <path d="M12.0700837,4.0003006 C11.3895108,5.17692613 11,6.54297551 11,8 C11,12.3948932 14.5439081,15.9620623 18.9299163,15.9996994 C17.5467214,18.3910707 14.9612535,20 12,20 C7.581722,20 4,16.418278 4,12 C4,7.581722 7.581722,4 12,4 C12.0233848,4 12.0467462,4.00010034 12.0700837,4.0003006 Z" class="svg"/>
                                                </g>
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
                                                <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                    <rect x="0" y="0" width="24" height="24"/>
                                                    <circle class="svg" opacity="0.3" cx="12" cy="12" r="9"/>
                                                    <path d="M11.7357634,20.9961946 C6.88740052,20.8563914 3,16.8821712 3,12 C3,11.9168367 3.00112797,11.8339369 3.00336944,11.751315 C3.66233009,11.8143341 4.85636818,11.9573854 4.91262842,12.4204038 C4.9904938,13.0609191 4.91262842,13.8615942 5.45804656,14.101772 C6.00346469,14.3419498 6.15931561,13.1409372 6.6267482,13.4612567 C7.09418079,13.7815761 8.34086797,14.0899175 8.34086797,14.6562185 C8.34086797,15.222396 8.10715168,16.1034596 8.34086797,16.2636193 C8.57458427,16.423779 9.5089688,17.54465 9.50920913,17.7048097 C9.50956962,17.8649694 9.83857487,18.6793513 9.74040201,18.9906563 C9.65905192,19.2487394 9.24857641,20.0501554 8.85059781,20.4145589 C9.75315358,20.7620621 10.7235846,20.9657742 11.7357634,20.9960544 L11.7357634,20.9961946 Z M8.28272988,3.80112099 C9.4158415,3.28656421 10.6744554,3 12,3 C15.5114513,3 18.5532143,5.01097452 20.0364482,7.94408274 C20.069657,8.72412177 20.0638332,9.39135321 20.2361262,9.6327358 C21.1131932,10.8600506 18.0995147,11.7043158 18.5573343,13.5605384 C18.7589671,14.3794892 16.5527814,14.1196773 16.0139722,14.886394 C15.4748026,15.6527403 14.1574598,15.137809 13.8520064,14.9904917 C13.546553,14.8431744 12.3766497,15.3341497 12.4789081,14.4995164 C12.5805657,13.664636 13.2922889,13.6156126 14.0555619,13.2719546 C14.8184743,12.928667 15.9189236,11.7871741 15.3781918,11.6380045 C12.8323064,10.9362407 11.963771,8.47852395 11.963771,8.47852395 C11.8110443,8.44901109 11.8493762,6.74109366 11.1883616,6.69207022 C10.5267462,6.64279981 10.170464,6.88841096 9.20435656,6.69207022 C8.23764828,6.49572949 8.44144409,5.85743687 8.2887174,4.48255778 C8.25453994,4.17415686 8.25619136,3.95717082 8.28272988,3.80112099 Z M20.9991771,11.8770357 C20.9997251,11.9179585 21,11.9589471 21,12 C21,16.9406923 17.0188468,20.9515364 12.0895088,20.9995641 C16.970233,20.9503326 20.9337111,16.888438 20.9991771,11.8770357 Z" class="svg" opacity="0.3"/>
                                                </g>
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
                                            <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                <rect x="0" y="0" width="24" height="24"/>
                                                <circle class="svg" opacity="0.3" cx="12" cy="12" r="10"/>
                                                <path d="M6.96323356,15.1775211 C6.62849853,15.5122561 6.08578582,15.5122561 5.75105079,15.1775211 C5.41631576,14.842786 5.41631576,14.3000733 5.75105079,13.9653383 L10.8939067,8.82248234 C11.2184029,8.49798619 11.7409054,8.4866328 12.0791905,8.79672747 L17.2220465,13.5110121 C17.5710056,13.8308912 17.5945795,14.3730917 17.2747004,14.7220508 C16.9548212,15.0710098 16.4126207,15.0945838 16.0636617,14.7747046 L11.5257773,10.6149773 L6.96323356,15.1775211 Z" class="svg" fill-rule="nonzero" transform="translate(11.500001, 12.000001) scale(-1, 1) rotate(-270.000000) translate(-11.500001, -12.000001) "/>
                                            </g>
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
                                if (stafftheme === 'auto') {
                                    const darkThemeMq = window.matchMedia('(prefers-color-scheme: light)');
                                    if (darkThemeMq.matches) {document.querySelector('html').dataset.theme = `theme-light`;                            
                                    } else {document.querySelector('html').dataset.theme = `theme-dark`;   }
                                } else {document.querySelector('html').dataset.theme = 'theme-' + stafftheme;   }
                            ";
                            $DATABASE_HOST = 'localhost';$DATABASE_USER = 'root';$DATABASE_PASS = 'eKi=0630OG';$DATABASE_NAME = 'mappapapir';
                            $con = mysqli_connect($DATABASE_HOST, $DATABASE_USER, $DATABASE_PASS, $DATABASE_NAME);
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
        <!-- Temak kezelese -->
        <script src="script/themes.js" content-type="application/javascript"></script>
        <!-- Widgetek kezelese -->
        <script src="script/widgets.js" content-type="application/javascript"></script>
        <!-- Ertesitesek kezelese -->
        <script src="script/notifications.js" content-type="application/javascript"></script>
    </body>
</html>