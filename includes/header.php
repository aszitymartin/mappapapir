<?php require_once($_SERVER['DOCUMENT_ROOT'].'/includes/inc.php'); ?>
<!DOCTYPE html>
<html lang="HU">
    <head>
        <meta http-equiv="content-type" content="text/html; charset=utf-8" /><meta charset="utf-8" />
        <meta name="keywords" content="tuzogép,fénymásolópapír,békéscsaba,eagle,kiszállítás,békéscsaba,írószer,irodaszer,nagyker, nagykereskedelem,ingyen,cd,dvd,zebra,boríték,füzet,dosszié,toll, golyóstoll,papír,atbt,iratrendezo,verbatim,import" />
        <meta name="rights" content="Mappa Papír" /><meta name="description" content="Mappa Papír Irodaszer nagykereskedelem. Kiskunhalason és környékén ingyenes kiszállítás." />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" /><meta name="apple-mobile-web-app-capable" content="yes" />
        <link rel="stylesheet" href="/assets/style/main.css" content-type="text/css" />
        <link href="/assets/icons/favicon.ico" rel="shortcut icon" type="image/vnd.microsoft.icon" />
        <link rel="stylesheet" href="/assets/script/swiper/swiper-bundle.min.css" content-type="text/css" />
        <link href="/assets/script/quill/dist/quill.snow.css" rel="stylesheet">
        <link href="/assets/script/tagify/dist/tagify.css" rel="stylesheet">
        <script src="/assets/script/jquery/jquery.js" content-type="application/javascript"></script>
        <script src="/assets/script/hammer.js"></script>
        <title>Mappa Papír</title>
    </head>
    <body>
        <?php
            if (isset($_SESSION['loggedin'])) {
                echo "
                    <script content-type='application/javascript'>const theme = '". $theme ."';
                        if (theme === 'auto') {const darkThemeMq = window.matchMedia('(prefers-color-scheme: light)');
                            if (darkThemeMq.matches) {document.querySelector('html').dataset.theme = `theme-light`;}
                            else {document.querySelector('html').dataset.theme = `theme-dark`;}
                        } else {document.querySelector('html').dataset.theme = 'theme-' + theme;   }
                    </script>
                ";
            } else {
                echo "
                    <script content-type='application/javascript'>const darkThemeMq = window.matchMedia('(prefers-color-scheme: light)');
                        if (!localStorage.getItem('theme')) {
                            if (darkThemeMq.matches) {document.querySelector('html').dataset.theme = `theme-light`;                            
                            } else {document.querySelector('html').dataset.theme = `theme-dark`;   }
                        } else {document.querySelector('html').dataset.theme = localStorage.getItem('theme');}
                    </script>
                ";
            }
        ?>
        <header>
            <div id='header_con' class='container padding-1 border-soft item-bg box-shadow'>
                <div id='header_title' class='header_title flex flex-row flex-align-c flex-justify-con-sb'>
                    <a href="/" class='flex flex-align-l flex-justify-con-l flex-col pointer'>
                        <span class='header_title_heading'>Mappa Papír</span>
                        <span class='header_title_desc'>
                            <span key="header-title-desc">Minden ami írószer.</span>
                        </span>
                    </a>
                    <div id='header_middle' class='header_middle_con flex flex-col'>
                        <div class="flex flex-row flex-align-c gap-2 small text-primary">
                            <span class="pointer link"><a href="/browse">Webáruház</a></span>
                            <span class="pointer link">Fórum</span>
                            <span class="pointer link">Rólunk</span>
                        </div>
                    </div>
                    <div id="header-search" class="user_action_button pointer flex flex-align-c flex-justify-con-c has-tooltip padding-05 relative" aria-describedby="tooltip-search">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><rect opacity="0.5" x="17.0365" y="15.1223" width="8.15546" height="2" rx="1" transform="rotate(45 17.0365 15.1223)" class="svg"/><path d="M11 19C6.55556 19 3 15.4444 3 11C3 6.55556 6.55556 3 11 3C15.4444 3 19 6.55556 19 11C19 15.4444 15.4444 19 11 19ZM11 5C7.53333 5 5 7.53333 5 11C5 14.4667 7.53333 17 11 17C14.4667 17 17 14.4667 17 11C17 7.53333 14.4667 5 11 5Z" class="svg"/></svg>
                        <span class="tooltip absolute" id="tooltip-search"><span key="tooltip-search" key="tooltip-search">Keresés az oldalon</span></span>
                    </div>
                    <div id="hd-rb-con" class="flex flex-row"></div>
                </div>
                <div id="hs--con"></div>
            </div>
        </header>