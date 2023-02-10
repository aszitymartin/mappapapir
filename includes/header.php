<?php
ini_set('display_errors', 1); ini_set('display_startup_errors', 1); error_reporting(E_ALL);
require_once($_SERVER['DOCUMENT_ROOT'].'/includes/inc.php');
?>
<!DOCTYPE html>
<html lang="HU">
    <head>
        <meta http-equiv="content-type" content="text/html; charset=utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <meta name="apple-mobile-web-app-capable" content="yes" />
        <?php
            $sql = "SELECT meta, webmester, email, description FROM def__page"; $res = $con->query($sql);
            while ($hdt = $res->fetch_assoc()) {
                $ma = explode(";", $hdt['meta']);
                for ($i = 0; $i < count($ma); $i++) {
                    if (explode("=",$ma[$i])[0] == 'charset') {
                        echo '<meta '. explode("=",$ma[$i])[0] .'="'.explode("=",$ma[$i])[1].'" />';
                    } else {
                        echo '<meta name="'. explode("=",$ma[$i])[0] .'" content="'.explode("=",$ma[$i])[1].'" />';
                    }
                }
                echo '<meta name="description" content="'. $hdt['description'] .'" />';
                echo '<meta name="webmaster" content="'. $hdt['webmester'] .'" />';
                echo '<meta name="contact" content="'. $hdt['email'] .'" />';
            } $hsql = "SELECT title, icon FROM def__page"; $hres = $con->query($hsql); $hsdt = $hres->fetch_assoc();
        ?>
                
        <link rel="stylesheet" href="/assets/style/main.css" content-type="text/css" />
        <link href="/assets/icons/<?= $hsdt['icon']; ?>" rel="shortcut icon" type="image/vnd.microsoft.icon" />
        <link rel="stylesheet" href="/assets/script/swiper/swiper-bundle.min.css" content-type="text/css" />
        <link href="/assets/script/quill/dist/quill.snow.css" rel="stylesheet">
        <link href="/assets/script/tagify/dist/tagify.css" rel="stylesheet">
        <script src="/assets/script/jquery/jquery.js" content-type="application/javascript"></script>
        <script src="/assets/script/hammer.js"></script>
        <script src="/assets/script/classes/class.ajax.js"></script>
        <title><?= $hsdt['title']; ?></title>
    </head>
    <body>
        <?php
            if (isset($_SESSION['loggedin'])) {
                echo "
                    <script content-type='application/javascript'>const theme = '". $theme ."';
                        switch (theme) {
                            case 'auto' :
                                const darkThemeMq = window.matchMedia('(prefers-color-scheme: light)');
                                if (darkThemeMq.matches) {document.querySelector('html').dataset.theme = `theme-light`;}
                                else {document.querySelector('html').dataset.theme = `theme-dark`;}
                            break;
                            case 'schedule' :
                                var hours = new Date().getHours(); var isDayTime = hours > 6 && hours < 20;
                                document.querySelector('html').dataset.theme = isDayTime == true ? 'theme-light' : 'theme-dark';
                            break;
                            case 'dark' :
                                document.querySelector('html').dataset.theme = `theme-dark`;
                            break;
                            case 'light' :
                                document.querySelector('html').dataset.theme = `theme-light`;
                            break;
                            default :
                                var themeData = new FormData(); themeData.append('action', 'get'); themeData.append('uid', ".$_SESSION['id'].");
                                $.ajax({ type: 'POST',url: '/assets/php/classes/class.Themes.php',data: themeData, cache: false,
                                    success: function(s) {
                                        if (s.satus == 'success') { document.querySelector('html').dataset.theme = `theme-`+s.theme; }
                                        else { document.querySelector('html').dataset.theme = `theme-light`; } 
                                    }, error: function (e) { document.querySelector('html').dataset.theme = `theme-light`; }
                                });
                            break;
                        }
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
                            <?php $dhsql = "SELECT links FROM def__header"; $dhres = $con->query($dhsql); $dhdt = $dhres->fetch_assoc(); $ha = explode(";", $dhdt['links']);
                                for ($i = 0; $i < count($ha); $i++) { echo '<span class="pointer link"><a href="'. explode('=', $ha[$i])[1] .'">'.explode('=', $ha[$i])[0].'</a></span>'; }
                            ?>
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
        <span class="primary-bg padding-025 border-soft pointer user-select-none" id="atc">ADD TO CART</span>
        <script>
            var cartData = new FormData(); 
            $('#atc').click(() => {
                var ipAddress = '192.168.1.1';

                /*
                    ADD / DELETE / EMPTY / COUNT / INFO / NOT IN CART
                    const cartObject = {
                        uid : 1,
                        pid : 1,
                        ip  : ipAddress,
                        action : 'delete'
                    };


                    UPDATE
                    const cartObject = {
                        uid : 1,
                        pid : 1,
                        ip  : ipAddress,
                        action : 'update'
                        subaction : 'add' / 'delete'
                    };

                */

                const cartObject = {
                    uid : 1,
                    pid : 1,
                    ip  : ipAddress,
                    action : 'count',
                };
                
                cartData.append('cart', JSON.stringify(cartObject));

                const ajaxObject = {
                    url : '/assets/php/classes/class.Cart.php',
                    data : cartData
                }
                const ajaxCall = new sendAjaxRequest(ajaxObject);
                const ajaxResult = ajaxCall.sendRequest();
                var asd = { ...ajaxResult };

                console.log(asd);
                

                // cartData.append('cart', JSON.stringify(cartObject));
                // $.ajax({ type: 'POST', url: '/assets/php/classes/class.Cart.php', data: cartData, dataType: 'json', contentType: false, processData: false,
                //     success: function(s) {
                //         console.log(s);
                //     }, error: function (e) { console.log(e); }
                // });
            });
        </script>