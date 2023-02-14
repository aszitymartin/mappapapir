                            <?php require_once($_SERVER['DOCUMENT_ROOT'].'/includes/inc.php'); ?>
                            <script>function switchTheme(theme) {html.dataset.theme = `theme-${theme}`;localStorage.setItem('theme', `theme-${theme}`);}</script>
                            <div class='profileActionCon flex flex-col absolute'>
                                <div class="menuLoad">
                                    <div class="flex flex-col flex-align-c flex-justify-con-c padding-1">
                                        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="3rem" height="3rem" viewBox="0 0 24 24" version="1.1">
                                            <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"><g><polygon points="0 0 24 0 24 24 0 24"/></g><path d="M12,4 L12,6 C8.6862915,6 6,8.6862915 6,12 C6,15.3137085 8.6862915,18 12,18 C15.3137085,18 18,15.3137085 18,12 C18,10.9603196 17.7360885,9.96126435 17.2402578,9.07513926 L18.9856052,8.09853149 C19.6473536,9.28117708 20,10.6161442 20,12 C20,16.418278 16.418278,20 12,20 C7.581722,20 4,16.418278 4,12 C4,7.581722 7.581722,4 12,4 Z" class="svg" fill-rule="nonzero" opacity="0.3" transform="translate(12.000000, 12.000000) scale(-1, 1) translate(-12.000000, -12.000000) "/></g>
                                        </svg>
                                    </div>
                                </div>
                                <div class="menuLoaded">
                                    <div class='flex flex-row flex-align-c profileActionItemHead flex-justify-con-l'>
                                        <span class='actionConIcon flex'>
                                            <svg class='pointer' onclick='profileActionPanel("settings");' xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                                <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"><rect x="0" y="0" width="24" height="24"/><circle class="svg" opacity="0.3" cx="12" cy="12" r="10"/><path d="M6.96323356,15.1775211 C6.62849853,15.5122561 6.08578582,15.5122561 5.75105079,15.1775211 C5.41631576,14.842786 5.41631576,14.3000733 5.75105079,13.9653383 L10.8939067,8.82248234 C11.2184029,8.49798619 11.7409054,8.4866328 12.0791905,8.79672747 L17.2220465,13.5110121 C17.5710056,13.8308912 17.5945795,14.3730917 17.2747004,14.7220508 C16.9548212,15.0710098 16.4126207,15.0945838 16.0636617,14.7747046 L11.5257773,10.6149773 L6.96323356,15.1775211 Z" class="svg" fill-rule="nonzero" transform="translate(11.500001, 12.000001) scale(-1, 1) rotate(-270.000000) translate(-11.500001, -12.000001) "/></g>
                                            </svg>
                                        </span>
                                        <span class='profileActionTitle flex menuThemeSettings'>
                                            <span key="menuThemeSettings">Téma beállítása</span>
                                        </span>
                                    </div>
                                    <div class="theme-body">
                                        <div class="theme-desc text-align-c">
                                            <span class="text-secondary text-small menuThemeDesc">
                                                <span key="menuThemeDesc">Módosítsa az oldal megjelenését, hogy csökkentse a rikító fényt, és pihentesse a szemét.</span>
                                            </span>
                                        </div>
                                        <div class="theme-button-con flex flex-col">
                                            <div class="theme-item flex flex-row">
                                                <div class="theme-button flex flex-align-c flex-justify-con-sb w-100">
                                                    <span class="text-primary themeDark">
                                                        <span key="themeDark">Sötét mód</span>
                                                    </span>
                                                    <label class="radio">
                                                        <input type="radio" name="radio" id="theme-dark" onclick="setTheme(this.id);">
                                                        <span class="checkmark"></span>
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="theme-item flex flex-row">
                                                <div class="theme-button flex flex-align-c flex-justify-con-sb w-100">
                                                    <span class="text-primary themeLight">
                                                        <span key="themeLight">Fényes mód</span>
                                                    </span>
                                                    <label class="radio">
                                                        <input type="radio" name="radio" id="theme-light" onclick="setTheme(this.id);">
                                                        <span class="checkmark"></span>
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="theme-item flex flex-row">
                                                <div class="theme-button flex flex-align-c flex-justify-con-sb w-100">
                                                    <span class="text-primary themeLight">
                                                        <span key="themeLight">Ütemezett mód</span>
                                                    </span>
                                                    <label class="radio">
                                                        <input type="radio" name="radio" id="theme-schedule" onclick="setTheme(this.id);">
                                                        <span class="checkmark"></span>
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="theme-item flex flex-row">
                                                <div class="theme-button flex flex-align-c flex-justify-con-sb w-100">
                                                    <span class="text-primary themeAuto">
                                                        <span key="themeAuto">Automatikus</span>
                                                    </span>
                                                    <label class="switch">
                                                        <input type="checkbox" id="theme-auto" checked="" onclick="setTheme(this.id);">
                                                        <span class="slider round"></span>
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <script>
                                $('.menuLoaded').hide();$('.menuLoad').show();setTimeout(() => {$('.menuLoaded').show();$('.menuLoad').remove();}, 150);
                                $('#desktopChangeTheme').click(function () {$('#profileHeaderContainer').load('/includes/header-menu/theme.php');});
                            </script>
                            <?php
                                echo "
                                    <script>
                                        if ('". $theme ."' === 'auto') {const darkThemeMq = window.matchMedia('(prefers-color-scheme: light)');
                                            if (darkThemeMq.matches) {document.querySelector('html').dataset.theme = `theme-light`;
                                            } else {document.querySelector('html').dataset.theme = `theme-dark`;}
                                        } else {document.querySelector('html').dataset.theme = 'theme-' + '". $theme ."';}
                                    </script>
                                ";
                                $DATABASE_HOST = 'localhost';$DATABASE_USER = 'root';$DATABASE_PASS = 'eKi=0630OG';$DATABASE_NAME = 'mappapapir';
                                $con = mysqli_connect($DATABASE_HOST, $DATABASE_USER, $DATABASE_PASS, $DATABASE_NAME);
                                $stmt = $con->prepare('SELECT theme FROM customers WHERE id = ?');
                                $stmt->bind_param('i', $_SESSION['id']);$stmt->execute();$stmt->bind_result($getTheme);
                                $stmt->fetch();$stmt->close();
                                echo "
                                    <script> var curTheme = '"; echo $getTheme; echo "';
                                        if (localStorage.getItem('theme')) { localStorage.removeItem('theme');}
                                        var auto = document.getElementById('theme-auto');var dark = document.getElementById('theme-dark');var light = document.getElementById('theme-light');
                                        auto.removeAttribute('onclick');dark.removeAttribute('onclcik');light.removeAttribute('onclick');
                                        dark.setAttribute('onclick', 'setTheme(this.id);');light.setAttribute('onclick', 'setTheme(this.id);');auto.setAttribute('onclick', 'setTheme(this.id);');
                                        if (curTheme === 'light') {auto.checked = false;dark.checked = false;light.checked = true;}
                                        if (curTheme === 'dark') {auto.checked = false;dark.checked = true;light.checked = false;} 
                                        if (curTheme === 'auto') {auto.checked = true;dark.checked = false;light.checked = false;}
                                        $('#theme-dark').click(function () {document.getElementById('theme-auto').checked = false;document.getElementById('theme-dark').checked = true;document.getElementById('theme-light').checked = false;}); 
                                        $('#theme-light').click(function () {document.getElementById('theme-auto').checked = false;document.getElementById('theme-dark').checked = false;document.getElementById('theme-light').checked = true;}); 
                                        $('#theme-auto').click(function () {document.getElementById('theme-auto').checked = true;document.getElementById('theme-dark').checked = false;document.getElementById('theme-light').checked = false;});
                                    </script>
                                ";
                            ?>
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
                            <script src="/assets/script/internationalize/jquery.MultiLanguage.js"></script>