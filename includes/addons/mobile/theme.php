<?php session_start(); ?>
<div class="sidenav-theme">
    <div class="sidenav-header flex flec-row flex-align-c flex-justify-con-sb">
        <span class="flex flex-col">
            <span class="header_title_heading">Téma beállítása</span>
        </span>
        <span class="flex">
            <span class="text-primary" onclick="closeSidenavAddons('theme')">
                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"><rect x="0" y="0" width="24" height="24"/><circle class="svg" opacity="0.3" cx="12" cy="12" r="10"/><path d="M12.0355339,10.6213203 L14.863961,7.79289322 C15.2544853,7.40236893 15.8876503,7.40236893 16.2781746,7.79289322 C16.6686989,8.18341751 16.6686989,8.81658249 16.2781746,9.20710678 L13.4497475,12.0355339 L16.2781746,14.863961 C16.6686989,15.2544853 16.6686989,15.8876503 16.2781746,16.2781746 C15.8876503,16.6686989 15.2544853,16.6686989 14.863961,16.2781746 L12.0355339,13.4497475 L9.20710678,16.2781746 C8.81658249,16.6686989 8.18341751,16.6686989 7.79289322,16.2781746 C7.40236893,15.8876503 7.40236893,15.2544853 7.79289322,14.863961 L10.6213203,12.0355339 L7.79289322,9.20710678 C7.40236893,8.81658249 7.40236893,8.18341751 7.79289322,7.79289322 C8.18341751,7.40236893 8.81658249,7.40236893 9.20710678,7.79289322 L12.0355339,10.6213203 Z" class="svg" /></g>
                </svg>
            </span>
        </span>
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
                        <input type="radio" name="radio" id='theme-dark' onclick="switchTheme('dark')">
                        <span class="checkmark"></span>
                      </label>
                </div>
            </div>
            <div class="theme-item flex flex-col">
                <div class="theme-button flex flex-row flex-align-c flex-justify-con-sb w-100">
                    <span class="text-primary">Fényes mód</span>
                    <label class="radio">
                        <input type="radio" name="radio" id='theme-light' onclick="switchTheme('light')">
                        <span class="checkmark"></span>
                    </label>
                </div>
            </div>
            <div class="theme-item flex flex-col">
                <div class="theme-button flex flex-row flex-align-c flex-justify-con-sb w-100">
                    <span class="text-primary themeLight">
                        <span key="themeLight">Ütemezett mód</span>
                    </span>
                    <label class="radio">
                        <input type="radio" name="radio" id="theme-schedule" onclick="setTheme(this.id);">
                        <span class="checkmark"></span>
                    </label>
                </div>
                <span class="text-primary smaller">6 - 20 óra között világos téma, utánna sötét.</span>
            </div>
            <div class="theme-item flex flex-row">
                <div class="theme-button flex flex-align-c flex-justify-con-sb w-100">
                    <span class="text-primary">Automatikus</span>
                    <label class="switch">
                        <input type="checkbox" id='theme-auto' checked>
                        <span class="slider round"></span>
                    </label>
                </div>
            </div>
        </div>
    </div>
</div>
<?php

    if (!isset($_SESSION['loggedin'])) {
        echo "
            <script content-type='application/javascript'>
                if (!localStorage.getItem('theme')) {}
                else {
                    document.getElementById('theme-auto').checked = false;
                    document.getElementById(localStorage.getItem('theme')).checked = true;
                    $('#theme-auto').click(function () {
                        localStorage.removeItem('theme');
                        document.getElementById('theme-auto').checked = true;
                        document.getElementById('theme-dark').checked = false;
                        document.getElementById('theme-light').checked = false;
                        document.getElementById('theme-schedule').checked = false;
                        const darkThemeMq = window.matchMedia('(prefers-color-scheme: light)');
                        if (darkThemeMq.matches) {
                            html.dataset.theme = 'theme-light';
                        } else {
                            html.dataset.theme = 'theme-dark';
                        }
                    });
                }
                $('#theme-dark').click(function () {
                    document.getElementById('theme-auto').checked = false;
                    document.getElementById('theme-dark').checked = true;
                    document.getElementById('theme-light').checked = false;
                    document.getElementById('theme-schedule').checked = false;
                });
                $('#theme-light').click(function () {
                    document.getElementById('theme-auto').checked = false;
                    document.getElementById('theme-dark').checked = false;
                    document.getElementById('theme-light').checked = true;
                    document.getElementById('theme-schedule').checked = false;
                });
                $('#theme-schedule').click(function () {
                    document.getElementById('theme-auto').checked = false;
                    document.getElementById('theme-dark').checked = false;
                    document.getElementById('theme-light').checked = false;
                    document.getElementById('theme-schedule').checked = true;
                });
            </script>
        ";
    } else {
        include($_SERVER['DOCUMENT_ROOT'].'/includes/inc.connect.php');
        $getUserUITheme = $con->prepare('SELECT theme FROM customers WHERE id = ?'); $getUserUITheme->bind_param('i', $_SESSION['id']);$getUserUITheme->execute();$getUserUITheme->bind_result($getTheme);$getUserUITheme->fetch();$getUserUITheme->close();
        echo "
            <script>var curTheme = '"; echo $getTheme; echo "';
                if (localStorage.getItem('theme')) {localStorage.removeItem('theme');}
                
                var auto = document.getElementById('theme-auto');
                var dark = document.getElementById('theme-dark');
                var light = document.getElementById('theme-light');
                var schedule = document.getElementById('theme-schedule');

                auto.removeAttribute('onclick');
                dark.removeAttribute('onclcik');
                light.removeAttribute('onclick');
                schedule.removeAttribute('onclick');


                dark.setAttribute('onclick', 'setTheme(this.id);');
                light.setAttribute('onclick', 'setTheme(this.id);');
                auto.setAttribute('onclick', 'setTheme(this.id);');
                schedule.setAttribute('onclick', 'setTheme(this.id);');

                if (curTheme === 'light') {
                    auto.checked = false;
                    dark.checked = false;
                    light.checked = true;
                    schedule.checked = false;
                }
                if (curTheme === 'dark') {
                    auto.checked = false;
                    dark.checked = true;
                    light.checked = false;
                    schedule.checked = false;
                }
                if (curTheme === 'auto') {
                    auto.checked = true;
                    dark.checked = false;
                    light.checked = false;
                    schedule.checked = false;
                }
                if (curTheme === 'schedule') {
                    auto.checked = false;
                    dark.checked = false;
                    light.checked = false;
                    schedule.checked = true;
                }

                $('#theme-dark').click(function () {
                    document.getElementById('theme-auto').checked = false;
                    document.getElementById('theme-dark').checked = true;
                    document.getElementById('theme-light').checked = false;
                    document.getElementById('theme-schedule').checked = false;
                });
                $('#theme-light').click(function () {
                    document.getElementById('theme-auto').checked = false;
                    document.getElementById('theme-dark').checked = false;
                    document.getElementById('theme-light').checked = true;
                    document.getElementById('theme-schedule').checked = false;
                });
                $('#theme-auto').click(function () {
                    document.getElementById('theme-auto').checked = true;
                    document.getElementById('theme-dark').checked = false;
                    document.getElementById('theme-light').checked = false;
                    document.getElementById('theme-schedule').checked = false;
                });
                $('#theme-schedule').click(function () {
                    document.getElementById('theme-auto').checked = false;
                    document.getElementById('theme-dark').checked = false;
                    document.getElementById('theme-light').checked = false;
                    document.getElementById('theme-schedule').checked = true;
                });
            </script>
        ";
    }
?>

<script content-type="application/javascript">

    function setTheme (themeType) {
        var themeValue = themeType.split('-')[1];
        const themeData = {
            action : "set",
            theme  : themeValue,
            uid    : <?= $_SESSION['id']; ?>
        };

        var themeFormData = new FormData();
        themeFormData.append('theme', JSON.stringify(themeData));

        const ajaxObject = { 
            url : '/assets/php/classes/class.Themes.php',
            data : themeFormData,
            loaderContainer : { isset : false, }
        }

        let response = getFromAjaxRequest(ajaxObject)
        .then((data) => {
            if (data.status == 'success') {
                switch (data.theme) {
                    case 'auto' :
                        const darkThemeMq = window.matchMedia('(prefers-color-scheme: light)');
                        if (darkThemeMq.matches) { document.querySelector('html').dataset.theme = 'theme-light'; }
                        else {document.querySelector('html').dataset.theme = 'theme-dark';}
                    break;
                    case 'dark' :
                        document.querySelector('html').dataset.theme = 'theme-dark';
                    break;
                    case 'light' :
                        document.querySelector('html').dataset.theme = 'theme-light';
                    break;
                    case 'schedule' :
                        var hours = new Date().getHours(); var isDayTime = hours > 6 && hours < 20;
                        document.querySelector('html').dataset.theme = isDayTime == true ? 'theme-light' : 'theme-dark';
                    break;
                    default :
                        document.querySelector('html').dataset.theme = 'theme-light';
                    break;
                }
            } else { document.querySelector('html').dataset.theme = 'theme-light'; }
        }) .catch((reason) => {
            document.querySelector('html').dataset.theme = 'theme-light';
        });
    }

</script>