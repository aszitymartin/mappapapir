                        <?php
                            function get_time_ago( $time ) {
                                $time_difference = time() - $time;
                                if( $time_difference < 1 ) { return '< 1s ago'; }
                                $condition = array( 12 * 30 * 24 * 60 * 60 =>  'year',30 * 24 * 60 * 60 => 'month',24 * 60 * 60 => 'day',60 * 60 =>  'hour',60 =>  'minute',1 =>  'second');
                                foreach( $condition as $secs => $str ) {$d = $time_difference / $secs;if( $d >= 1 ) {$t = round( $d );return $t . ' ' . $str . ( $t > 1 ? 's' : '' ) . ' ago';}}
                            }
                        ?>
                        <script>function showMain() {$('#staff_auth_con').load('/includes/staff/feedback.php');}</script>
                        <div class='padding-1 flex flex-col h-100'>
                            <div class="menuLoad">
                                <div class="flex flex-col flex-align-c flex-justify-con-c padding-1">
                                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="3rem" height="3rem" viewBox="0 0 24 24" version="1.1">
                                        <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"><g><polygon points="0 0 24 0 24 24 0 24"/></g><path d="M12,4 L12,6 C8.6862915,6 6,8.6862915 6,12 C6,15.3137085 8.6862915,18 12,18 C15.3137085,18 18,15.3137085 18,12 C18,10.9603196 17.7360885,9.96126435 17.2402578,9.07513926 L18.9856052,8.09853149 C19.6473536,9.28117708 20,10.6161442 20,12 C20,16.418278 16.418278,20 12,20 C7.581722,20 4,16.418278 4,12 C4,7.581722 7.581722,4 12,4 Z" class="svg" fill-rule="nonzero" opacity="0.3" transform="translate(12.000000, 12.000000) scale(-1, 1) translate(-12.000000, -12.000000) "/></g>
                                    </svg>
                                </div>
                            </div>
                            <div class="menuLoaded flex flex-col h-100">
                                <div class="sidenav-header w-100 flex flex-row flex-align-c flex-justify-con-sb" id="feedbacks-header">
                                    <span class="flex flex-col">
                                        <span class="header_title_heading">Visszajelzések</span>
                                    </span>
                                    <span class="flex">
                                        <span class="text-primary pointer" onclick="closeAuth()">
                                            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                                <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"><rect x="0" y="0" width="24" height="24"/><circle class="svg" opacity="0.3" cx="12" cy="12" r="10"/><path d="M12.0355339,10.6213203 L14.863961,7.79289322 C15.2544853,7.40236893 15.8876503,7.40236893 16.2781746,7.79289322 C16.6686989,8.18341751 16.6686989,8.81658249 16.2781746,9.20710678 L13.4497475,12.0355339 L16.2781746,14.863961 C16.6686989,15.2544853 16.6686989,15.8876503 16.2781746,16.2781746 C15.8876503,16.6686989 15.2544853,16.6686989 14.863961,16.2781746 L12.0355339,13.4497475 L9.20710678,16.2781746 C8.81658249,16.6686989 8.18341751,16.6686989 7.79289322,16.2781746 C7.40236893,15.8876503 7.40236893,15.2544853 7.79289322,14.863961 L10.6213203,12.0355339 L7.79289322,9.20710678 C7.40236893,8.81658249 7.40236893,8.18341751 7.79289322,7.79289322 C8.18341751,7.40236893 8.81658249,7.40236893 9.20710678,7.79289322 L12.0355339,10.6213203 Z" class="svg" /></g>
                                            </svg>
                                        </span>
                                    </span>
                                </div>
                                <div class="theme-body flex flex-col gap-1" id="feedbacks-body">
                                    <div class="theme-button-con flex flex-col relative" id="new-feedbacks">
                                        <script>
                                            $(document).ready(function () {
                                                $.ajax({
                                                    type: "GET", url: "actions/feedback-all.php",
                                                    // Sikeres/Sikertelen akciok kimenetelenek lekezelese ertesitesekkel, hogy emberbaratabb legyen az oldal.
                                                    success: function(data) {
                                                        if (Number(data) > 0) {
                                                            var badge = document.createElement('div');badge.classList = 'badge flex flex-align-c flex-justify-con-c absolute box-shadow';
                                                            badge.innerHTML = `<span class="badge-text" id="feedback-badge">${Number(data)}</span>`; document.getElementById('new-feedbacks').prepend(badge);
                                                        }
                                                    }, error: function (err) { console.log(err); }
                                                });
                                            });
                                        </script>
                                        <div class="product-button flex flex-row padding-1 item-bg-light border-soft ease user-select-none pointer">
                                            <div class="flex flex-row flex-align-c flex-justify-con-sb">
                                                <div class="flex" style="margin-right: 1rem;">
                                                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="3rem" height="3rem" viewBox="0 0 24 24" version="1.1">
                                                        <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"><rect x="0" y="0" width="24" height="24"/><path d="M5,6 L19,6 C20.1045695,6 21,6.8954305 21,8 L21,17 C21,18.1045695 20.1045695,19 19,19 L5,19 C3.8954305,19 3,18.1045695 3,17 L3,8 C3,6.8954305 3.8954305,6 5,6 Z M18.1444251,7.83964668 L12,11.1481833 L5.85557487,7.83964668 C5.4908718,7.6432681 5.03602525,7.77972206 4.83964668,8.14442513 C4.6432681,8.5091282 4.77972206,8.96397475 5.14442513,9.16035332 L11.6444251,12.6603533 C11.8664074,12.7798822 12.1335926,12.7798822 12.3555749,12.6603533 L18.8555749,9.16035332 C19.2202779,8.96397475 19.3567319,8.5091282 19.1603533,8.14442513 C18.9639747,7.77972206 18.5091282,7.6432681 18.1444251,7.83964668 Z" class="svg" /></g>
                                                    </svg>
                                                </div>
                                                <div class="flex flex-col">
                                                    <span class="text-primary bold">Kezeletlen visszajelzések</span>
                                                    <span class="text-secondary small">Függőben lévő visszajelzések kezelése</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="theme-button-con flex flex-col relative" id="closed-feedbacks">
                                        <div class="product-button flex flex-row padding-1 item-bg-light border-soft ease user-select-none pointer">
                                            <div class="flex flex-row flex-align-c flex-justify-con-sb">
                                                <div class="flex" style="margin-right: 1rem;">
                                                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="3rem" height="3rem" viewBox="0 0 24 24" version="1.1">
                                                        <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"><rect x="0" y="0" width="24" height="24"/><path d="M6,2 L18,2 C18.5522847,2 19,2.44771525 19,3 L19,12 C19,12.5522847 18.5522847,13 18,13 L6,13 C5.44771525,13 5,12.5522847 5,12 L5,3 C5,2.44771525 5.44771525,2 6,2 Z M7.5,5 C7.22385763,5 7,5.22385763 7,5.5 C7,5.77614237 7.22385763,6 7.5,6 L13.5,6 C13.7761424,6 14,5.77614237 14,5.5 C14,5.22385763 13.7761424,5 13.5,5 L7.5,5 Z M7.5,7 C7.22385763,7 7,7.22385763 7,7.5 C7,7.77614237 7.22385763,8 7.5,8 L10.5,8 C10.7761424,8 11,7.77614237 11,7.5 C11,7.22385763 10.7761424,7 10.5,7 L7.5,7 Z" class="svg" opacity="0.3"/><path d="M3.79274528,6.57253826 L12,12.5 L20.2072547,6.57253826 C20.4311176,6.4108595 20.7436609,6.46126971 20.9053396,6.68513259 C20.9668779,6.77033951 21,6.87277228 21,6.97787787 L21,17 C21,18.1045695 20.1045695,19 19,19 L5,19 C3.8954305,19 3,18.1045695 3,17 L3,6.97787787 C3,6.70173549 3.22385763,6.47787787 3.5,6.47787787 C3.60510559,6.47787787 3.70753836,6.51099993 3.79274528,6.57253826 Z" class="svg"/></g>
                                                    </svg>
                                                </div>
                                                <div class="flex flex-col">
                                                    <span class="text-primary bold">Lezárt visszajelzések</span>
                                                    <span class="text-secondary small">Lezárt visszajelzések megtekintése</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="theme-button-con flex flex-col relative" id="archived-feedbacks">
                                        <div class="product-button flex flex-row padding-1 item-bg-light border-soft ease user-select-none pointer">
                                            <div class="flex flex-row flex-align-c flex-justify-con-sb">
                                                <div class="flex" style="margin-right: 1rem;">
                                                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="3rem" height="3rem" viewBox="0 0 24 24" version="1.1">
                                                        <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"><rect x="0" y="0" width="24" height="24"/><path d="M4.5,3 L19.5,3 C20.3284271,3 21,3.67157288 21,4.5 L21,19.5 C21,20.3284271 20.3284271,21 19.5,21 L4.5,21 C3.67157288,21 3,20.3284271 3,19.5 L3,4.5 C3,3.67157288 3.67157288,3 4.5,3 Z M8,5 C7.44771525,5 7,5.44771525 7,6 C7,6.55228475 7.44771525,7 8,7 L16,7 C16.5522847,7 17,6.55228475 17,6 C17,5.44771525 16.5522847,5 16,5 L8,5 Z" class="svg"/></g>
                                                    </svg>
                                                </div>
                                                <div class="flex flex-col">
                                                    <span class="text-primary bold">Archivált elemek</span>
                                                    <span class="text-secondary small">Archivált elemek kezelése vagy megtekintése</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <script>
                            // Loading icon megjelenitese, hogy legyen ideje a kivalasztott nyelvnek betoltodni az oldalon
                            $('.menuLoaded').hide();$('.menuLoad').show();
                            setTimeout(() => {$('.menuLoaded').show();$('.menuLoad').remove();}, 150);

                            $('#new-feedbacks').click(function () {
                                document.getElementById('feedbacks-header').innerHTML = `
                                    <span class="flex flex-align-c">
                                        <span class="text-primary pointer" onclick="showMain()">
                                            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                                <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"><rect x="0" y="0" width="24" height="24"/><circle class="svg" opacity="0.3" cx="12" cy="12" r="10"/><path d="M6.96323356,15.1775211 C6.62849853,15.5122561 6.08578582,15.5122561 5.75105079,15.1775211 C5.41631576,14.842786 5.41631576,14.3000733 5.75105079,13.9653383 L10.8939067,8.82248234 C11.2184029,8.49798619 11.7409054,8.4866328 12.0791905,8.79672747 L17.2220465,13.5110121 C17.5710056,13.8308912 17.5945795,14.3730917 17.2747004,14.7220508 C16.9548212,15.0710098 16.4126207,15.0945838 16.0636617,14.7747046 L11.5257773,10.6149773 L6.96323356,15.1775211 Z" class="svg" fill-rule="nonzero" transform="translate(11.500001, 12.000001) scale(-1, 1) rotate(-270.000000) translate(-11.500001, -12.000001) "/></g>
                                            </svg>
                                        </span>
                                        <span class="header_title_heading" style="margin-left: 1rem;">Kezeletlen</span>
                                    </span>
                                    <span class="flex">
                                        <span class="text-primary pointer" onclick="closeAuth()">
                                            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                                <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"><rect x="0" y="0" width="24" height="24"/><circle class="svg" opacity="0.3" cx="12" cy="12" r="10"/><path d="M12.0355339,10.6213203 L14.863961,7.79289322 C15.2544853,7.40236893 15.8876503,7.40236893 16.2781746,7.79289322 C16.6686989,8.18341751 16.6686989,8.81658249 16.2781746,9.20710678 L13.4497475,12.0355339 L16.2781746,14.863961 C16.6686989,15.2544853 16.6686989,15.8876503 16.2781746,16.2781746 C15.8876503,16.6686989 15.2544853,16.6686989 14.863961,16.2781746 L12.0355339,13.4497475 L9.20710678,16.2781746 C8.81658249,16.6686989 8.18341751,16.6686989 7.79289322,16.2781746 C7.40236893,15.8876503 7.40236893,15.2544853 7.79289322,14.863961 L10.6213203,12.0355339 L7.79289322,9.20710678 C7.40236893,8.81658249 7.40236893,8.18341751 7.79289322,7.79289322 C8.18341751,7.40236893 8.81658249,7.40236893 9.20710678,7.79289322 L12.0355339,10.6213203 Z" class="svg" /></g>
                                            </svg>
                                        </span>
                                    </span>
                                `;

                                document.getElementById('feedbacks-body').innerHTML = `
                                    <div class="menuLoad">
                                        <div class="flex flex-col flex-align-c flex-justify-con-c padding-1">
                                            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="3rem" height="3rem" viewBox="0 0 24 24" version="1.1">
                                                <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"><g><polygon points="0 0 24 0 24 24 0 24"/></g><path d="M12,4 L12,6 C8.6862915,6 6,8.6862915 6,12 C6,15.3137085 8.6862915,18 12,18 C15.3137085,18 18,15.3137085 18,12 C18,10.9603196 17.7360885,9.96126435 17.2402578,9.07513926 L18.9856052,8.09853149 C19.6473536,9.28117708 20,10.6161442 20,12 C20,16.418278 16.418278,20 12,20 C7.581722,20 4,16.418278 4,12 C4,7.581722 7.581722,4 12,4 Z" class="svg" fill-rule="nonzero" opacity="0.3" transform="translate(12.000000, 12.000000) scale(-1, 1) translate(-12.000000, -12.000000) "/></g>
                                            </svg>
                                        </div>
                                    </div>
                                    <div class="menuLoaded flex flex-col gap-1 h-100">
                                        <div class="theme-button-con flex flex-col relative" id="feedback-webpage">
                                                <?php
                                                    include($_SERVER['DOCUMENT_ROOT'].'/includes/inc.connect.php');
                                                    if (mysqli_connect_errno()) {die ("0");}
                                                    $sql = "SELECT * FROM feedbacks WHERE status = 0 AND type = 6";
                                                    if ($result = mysqli_query($con, $sql)) {$num = mysqli_num_rows($result);
                                                        if ($num > 0) {echo '<div class="badge flex flex-align-c flex-justify-con-c absolute box-shadow"><span class="badge-text" id="feedback-badge">'. $num . '</span></div>';}
                                                    }
                                                ?>
                                                <div class="product-button flex flex-row padding-1 item-bg-light border-soft ease user-select-none pointer">
                                                    <div class="flex flex-row flex-align-c flex-justify-con-sb">
                                                        <div class="flex" style="margin-right: 1rem;">
                                                            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="3rem" height="3rem" viewBox="0 0 24 24" version="1.1">
                                                                <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"><rect x="0" y="0" width="24" height="24"/><path d="M11.575,21.2 C6.175,21.2 2.85,17.4 2.85,12.575 C2.85,6.875 7.375,3.05 12.525,3.05 C17.45,3.05 21.125,6.075 21.125,10.85 C21.125,15.2 18.825,16.925 16.525,16.925 C15.4,16.925 14.475,16.4 14.075,15.65 C13.3,16.4 12.125,16.875 11,16.875 C8.25,16.875 6.85,14.925 6.85,12.575 C6.85,9.55 9.05,7.1 12.275,7.1 C13.2,7.1 13.95,7.35 14.525,7.775 L14.625,7.35 L17,7.35 L15.825,12.85 C15.6,13.95 15.85,14.825 16.925,14.825 C18.25,14.825 19.025,13.725 19.025,10.8 C19.025,6.9 15.95,5.075 12.5,5.075 C8.625,5.075 5.05,7.75 5.05,12.575 C5.05,16.525 7.575,19.1 11.575,19.1 C13.075,19.1 14.625,18.775 15.975,18.075 L16.8,20.1 C15.25,20.8 13.2,21.2 11.575,21.2 Z M11.4,14.525 C12.05,14.525 12.7,14.35 13.225,13.825 L14.025,10.125 C13.575,9.65 12.925,9.425 12.3,9.425 C10.65,9.425 9.45,10.7 9.45,12.375 C9.45,13.675 10.075,14.525 11.4,14.525 Z" class="svg" /></g>
                                                            </svg>
                                                        </div>
                                                        <div class="flex flex-col">
                                                            <span class="text-primary bold">Weboldal problémák</span>
                                                            <span class="text-secondary small">Visszajelzések weboldal problémáival kapcsolatban</span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="theme-button-con flex flex-col relative" id="feedback-webshop">
                                                <?php
                                                    include($_SERVER['DOCUMENT_ROOT'].'/includes/inc.connect.php');
                                                    if (mysqli_connect_errno()) {die ("0"); }
                                                    $sql = "SELECT * FROM feedbacks WHERE status = 0 AND type = 0";
                                                    if ($result = mysqli_query($con, $sql)) {$num = mysqli_num_rows($result);
                                                        if ($num > 0) {echo '<div class="badge flex flex-align-c flex-justify-con-c absolute box-shadow"><span class="badge-text" id="feedback-badge">'. $num . '</span></div>';}
                                                    }
                                                ?>
                                                <div class="product-button flex flex-row padding-1 item-bg-light border-soft ease user-select-none pointer">
                                                    <div class="flex flex-row flex-align-c flex-justify-con-sb">
                                                        <div class="flex" style="margin-right: 1rem;">
                                                            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="3rem" height="3rem" viewBox="0 0 24 24" version="1.1">
                                                                <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"><rect x="0" y="0" width="24" height="24"/><path d="M12,4.56204994 L7.76822128,9.6401844 C7.4146572,10.0644613 6.7840925,10.1217854 6.3598156,9.76822128 C5.9355387,9.4146572 5.87821464,8.7840925 6.23177872,8.3598156 L11.2317787,2.3598156 C11.6315738,1.88006147 12.3684262,1.88006147 12.7682213,2.3598156 L17.7682213,8.3598156 C18.1217854,8.7840925 18.0644613,9.4146572 17.6401844,9.76822128 C17.2159075,10.1217854 16.5853428,10.0644613 16.2317787,9.6401844 L12,4.56204994 Z" class="svg" fill-rule="nonzero" opacity="0.3"/><path d="M3.28077641,9 L20.7192236,9 C21.2715083,9 21.7192236,9.44771525 21.7192236,10 C21.7192236,10.0817618 21.7091962,10.163215 21.6893661,10.2425356 L19.5680983,18.7276069 C19.234223,20.0631079 18.0342737,21 16.6576708,21 L7.34232922,21 C5.96572629,21 4.76577697,20.0631079 4.43190172,18.7276069 L2.31063391,10.2425356 C2.17668518,9.70674072 2.50244587,9.16380623 3.03824078,9.0298575 C3.11756139,9.01002735 3.1990146,9 3.28077641,9 Z M12,12 C11.4477153,12 11,12.4477153 11,13 L11,17 C11,17.5522847 11.4477153,18 12,18 C12.5522847,18 13,17.5522847 13,17 L13,13 C13,12.4477153 12.5522847,12 12,12 Z M6.96472382,12.1362967 C6.43125772,12.2792385 6.11467523,12.8275755 6.25761704,13.3610416 L7.29289322,17.2247449 C7.43583503,17.758211 7.98417199,18.0747935 8.51763809,17.9318517 C9.05110419,17.7889098 9.36768668,17.2405729 9.22474487,16.7071068 L8.18946869,12.8434035 C8.04652688,12.3099374 7.49818992,11.9933549 6.96472382,12.1362967 Z M17.0352762,12.1362967 C16.5018101,11.9933549 15.9534731,12.3099374 15.8105313,12.8434035 L14.7752551,16.7071068 C14.6323133,17.2405729 14.9488958,17.7889098 15.4823619,17.9318517 C16.015828,18.0747935 16.564165,17.758211 16.7071068,17.2247449 L17.742383,13.3610416 C17.8853248,12.8275755 17.5687423,12.2792385 17.0352762,12.1362967 Z" class="svg"/></g>
                                                            </svg>
                                                        </div>
                                                        <div class="flex flex-col">
                                                            <span class="text-primary bold">Webshop problémák</span>
                                                            <span class="text-secondary small">Visszajelzések webshop problémáival kapcsolatban</span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="theme-button-con flex flex-col relative" id="feedback-product">
                                                <?php
                                                    $sql = "SELECT * FROM feedbacks WHERE status = 0 AND type = 1";
                                                    if ($result = mysqli_query($con, $sql)) {$num = mysqli_num_rows($result);
                                                        if ($num > 0) {echo '<div class="badge flex flex-align-c flex-justify-con-c absolute box-shadow"><span class="badge-text" id="feedback-badge">'. $num . '</span></div>';}
                                                    }
                                                ?>
                                                <div class="product-button flex flex-row padding-1 item-bg-light border-soft ease user-select-none pointer">
                                                    <div class="flex flex-row flex-align-c flex-justify-con-sb">
                                                        <div class="flex" style="margin-right: 1rem;">
                                                            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="3rem" height="3rem" viewBox="0 0 24 24" version="1.1">
                                                                <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"><rect x="0" y="0" width="24" height="24"/><path d="M4,6 L20,6 C20.5522847,6 21,6.44771525 21,7 L21,8 C21,8.55228475 20.5522847,9 20,9 L4,9 C3.44771525,9 3,8.55228475 3,8 L3,7 C3,6.44771525 3.44771525,6 4,6 Z M5,11 L10,11 C10.5522847,11 11,11.4477153 11,12 L11,19 C11,19.5522847 10.5522847,20 10,20 L5,20 C4.44771525,20 4,19.5522847 4,19 L4,12 C4,11.4477153 4.44771525,11 5,11 Z M14,11 L19,11 C19.5522847,11 20,11.4477153 20,12 L20,19 C20,19.5522847 19.5522847,20 19,20 L14,20 C13.4477153,20 13,19.5522847 13,19 L13,12 C13,11.4477153 13.4477153,11 14,11 Z" class="svg"/><path d="M14.4452998,2.16794971 C14.9048285,1.86159725 15.5256978,1.98577112 15.8320503,2.4452998 C16.1384028,2.90482849 16.0142289,3.52569784 15.5547002,3.83205029 L12,6.20185043 L8.4452998,3.83205029 C7.98577112,3.52569784 7.86159725,2.90482849 8.16794971,2.4452998 C8.47430216,1.98577112 9.09517151,1.86159725 9.5547002,2.16794971 L12,3.79814957 L14.4452998,2.16794971 Z" class="svg" fill-rule="nonzero" opacity="0.3"/></g>
                                                            </svg>
                                                        </div>
                                                        <div class="flex flex-col">
                                                            <span class="text-primary bold">Termék problémák</span>
                                                            <span class="text-secondary small">Visszajelzések termékekkel kapcsolatos problémákra</span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="theme-button-con flex flex-col relative" id="feedback-order">
                                                <?php
                                                    $sql = "SELECT * FROM feedbacks WHERE status = 0 AND type = 2";
                                                    if ($result = mysqli_query($con, $sql)) {$num = mysqli_num_rows($result);
                                                        if ($num > 0) {echo '<div class="badge flex flex-align-c flex-justify-con-c absolute box-shadow"><span class="badge-text" id="feedback-badge">'. $num . '</span></div>';}
                                                    }
                                                ?>
                                                <div class="product-button flex flex-row padding-1 item-bg-light border-soft ease user-select-none pointer">
                                                    <div class="flex flex-row flex-align-c flex-justify-con-sb">
                                                        <div class="flex" style="margin-right: 1rem;">
                                                            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="3rem" height="3rem" viewBox="0 0 24 24" version="1.1">
                                                                <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"><rect x="0" y="0" width="24" height="24"></rect><path d="M20.4061385,6.73606154 C20.7672665,6.89656288 21,7.25468437 21,7.64987309 L21,16.4115967 C21,16.7747638 20.8031081,17.1093844 20.4856429,17.2857539 L12.4856429,21.7301984 C12.1836204,21.8979887 11.8163796,21.8979887 11.5143571,21.7301984 L3.51435707,17.2857539 C3.19689188,17.1093844 3,16.7747638 3,16.4115967 L3,7.64987309 C3,7.25468437 3.23273352,6.89656288 3.59386153,6.73606154 L11.5938615,3.18050598 C11.8524269,3.06558805 12.1475731,3.06558805 12.4061385,3.18050598 L20.4061385,6.73606154 Z" class="svg" opacity="0.3"></path><polygon class="svg" points="14.9671522 4.22441676 7.5999999 8.31727912 7.5999999 12.9056825 9.5999999 13.9056825 9.5999999 9.49408582 17.25507 5.24126912"></polygon></g>
                                                            </svg>
                                                        </div>
                                                        <div class="flex flex-col">
                                                            <span class="text-primary bold">Rendelési problémák</span>
                                                            <span class="text-secondary small">Visszajelzések rendeléssel kapcsolatos problémákra</span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="theme-button-con flex flex-col relative" id="feedback-ship">
                                                <?php
                                                    $sql = "SELECT * FROM feedbacks WHERE status = 0 AND type = 3";
                                                    if ($result = mysqli_query($con, $sql)) { $num = mysqli_num_rows($result);
                                                        if ($num > 0) {echo '<div class="badge flex flex-align-c flex-justify-con-c absolute box-shadow"><span class="badge-text" id="feedback-badge">'. $num . '</span></div>';}
                                                    }
                                                ?>
                                                <div class="product-button flex flex-row padding-1 item-bg-light border-soft ease user-select-none pointer">
                                                    <div class="flex flex-row flex-align-c flex-justify-con-sb">
                                                        <div class="flex" style="margin-right: 1rem;">
                                                            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="3rem" height="3rem" viewBox="0 0 24 24" version="1.1">
                                                                <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"><rect x="0" y="0" width="24" height="24"></rect><path d="M18.1446364,11.84388 L17.4471627,16.0287218 C17.4463569,16.0335568 17.4455155,16.0383857 17.4446387,16.0432083 C17.345843,16.5865846 16.8252597,16.9469884 16.2818833,16.8481927 L4.91303792,14.7811299 C4.53842737,14.7130189 4.23500006,14.4380834 4.13039941,14.0719812 L2.30560137,7.68518803 C2.28007524,7.59584656 2.26712532,7.50338343 2.26712532,7.4104669 C2.26712532,6.85818215 2.71484057,6.4104669 3.26712532,6.4104669 L16.9929851,6.4104669 L17.606173,3.78251876 C17.7307772,3.24850086 18.2068633,2.87071314 18.7552257,2.87071314 L20.8200821,2.87071314 C21.4717328,2.87071314 22,3.39898039 22,4.05063106 C22,4.70228173 21.4717328,5.23054898 20.8200821,5.23054898 L19.6915238,5.23054898 L18.1446364,11.84388 Z" class="svg" opacity="0.3"></path><path d="M6.5,21 C5.67157288,21 5,20.3284271 5,19.5 C5,18.6715729 5.67157288,18 6.5,18 C7.32842712,18 8,18.6715729 8,19.5 C8,20.3284271 7.32842712,21 6.5,21 Z M15.5,21 C14.6715729,21 14,20.3284271 14,19.5 C14,18.6715729 14.6715729,18 15.5,18 C16.3284271,18 17,18.6715729 17,19.5 C17,20.3284271 16.3284271,21 15.5,21 Z" class="svg"></path></g>
                                                            </svg>
                                                        </div>
                                                        <div class="flex flex-col">
                                                            <span class="text-primary bold">Szállítási problémák</span>
                                                            <span class="text-secondary small">Visszajelzések szállítással kapcsolatos problémákra</span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="theme-button-con flex flex-col relative" id="feedback-user">
                                                <?php
                                                    $sql = "SELECT * FROM feedbacks WHERE status = 0 AND type = 4";
                                                    if ($result = mysqli_query($con, $sql)) {$num = mysqli_num_rows($result);
                                                        if ($num > 0) {echo '<div class="badge flex flex-align-c flex-justify-con-c absolute box-shadow"><span class="badge-text" id="feedback-badge">'. $num . '</span></div>';}
                                                    }
                                                ?>
                                                <div class="product-button flex flex-row padding-1 item-bg-light border-soft ease user-select-none pointer">
                                                    <div class="flex flex-row flex-align-c flex-justify-con-sb">
                                                        <div class="flex" style="margin-right: 1rem;">
                                                            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="3rem" height="3rem" viewBox="0 0 24 24" version="1.1">
                                                                <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"><polygon points="0 0 24 0 24 24 0 24"></polygon><path d="M12,11 C9.790861,11 8,9.209139 8,7 C8,4.790861 9.790861,3 12,3 C14.209139,3 16,4.790861 16,7 C16,9.209139 14.209139,11 12,11 Z" class="svg" fill-rule="nonzero" opacity="0.3"></path><path d="M3.00065168,20.1992055 C3.38825852,15.4265159 7.26191235,13 11.9833413,13 C16.7712164,13 20.7048837,15.2931929 20.9979143,20.2 C21.0095879,20.3954741 20.9979143,21 20.2466999,21 C16.541124,21 11.0347247,21 3.72750223,21 C3.47671215,21 2.97953825,20.45918 3.00065168,20.1992055 Z" class="svg" fill-rule="nonzero"></path></g>
                                                            </svg>
                                                        </div>
                                                        <div class="flex flex-col">
                                                            <span class="text-primary bold">Felhasználói problémák</span>
                                                            <span class="text-secondary small">Visszajelzések fiókal kapcsolatos problémákra</span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="theme-button-con flex flex-col relative" id="feedback-other" style="margin-bottom: 1rem;">
                                                <?php
                                                    $sql = "SELECT * FROM feedbacks WHERE status = 0 AND type = 5";
                                                    if ($result = mysqli_query($con, $sql)) { $num = mysqli_num_rows($result);
                                                        if ($num > 0) {echo '<div class="badge flex flex-align-c flex-justify-con-c absolute box-shadow"><span class="badge-text" id="feedback-badge">'. $num . '</span></div>';}
                                                    }
                                                ?>
                                                <div class="product-button flex flex-row padding-1 item-bg-light border-soft ease user-select-none pointer">
                                                    <div class="flex flex-row flex-align-c flex-justify-con-sb">
                                                        <div class="flex" style="margin-right: 1rem;">
                                                            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="3rem" height="3rem" viewBox="0 0 24 24" version="1.1">
                                                                <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"><rect x="0" y="0" width="24" height="24"/><circle class="svg" cx="5" cy="12" r="2"/><circle class="svg" cx="12" cy="12" r="2"/><circle class="svg" cx="19" cy="12" r="2"/></g>
                                                            </svg>
                                                        </div>
                                                        <div class="flex flex-col">
                                                            <span class="text-primary bold">Egyéb problémák</span>
                                                            <span class="text-secondary small">Egyéb problémákkal kapcsolatos visszajelzések</span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                `;
                                $('.menuLoaded').hide();$('.menuLoad').show();
                                setTimeout(() => {$('.menuLoaded').show();$('.menuLoad').remove();}, 150);
                                $('#feedback-webshop').click(function () {
                                    document.getElementById('feedbacks-body').innerHTML = `
                                        <?php
                                            $fw_sql = "SELECT feedbacks.*, customers.id, customers.fullname FROM feedbacks INNER JOIN customers ON (feedbacks.uid = customers.id) WHERE status = 0 AND type = 0 ORDER BY feedbacks.created";
                                            $fw_res = $con-> query($fw_sql);
                                            if ($fw_res-> num_rows > 0) {
                                                while ($fw_item = $fw_res-> fetch_assoc()) {
                                                    echo '
                                                    <div class="theme-button-con flex flex-col relative" id="fw_item'; echo $fw_item['id']; echo '" feedback="'; echo $fw_item['id']; echo '">
                                                        <div class="product-button flex flex-row padding-1 item-bg-light border-soft ease user-select-none pointer">
                                                            <div class="feedback-id text-primary bold underline absolute">#'; echo $fw_item['id']; echo '</div>
                                                            <div class="flex flex-row flex-align-c flex-justify-con-sb">
                                                            <div class="flex flex-col flex-align-c flex-justify-con-c" style="margin-right: 1rem;">
                                                                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="3rem" height="3rem" viewBox="0 0 24 24" version="1.1"><g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"><rect x="0" y="0" width="24" height="24"></rect><path d="M5,6 L19,6 C20.1045695,6 21,6.8954305 21,8 L21,17 C21,18.1045695 20.1045695,19 19,19 L5,19 C3.8954305,19 3,18.1045695 3,17 L3,8 C3,6.8954305 3.8954305,6 5,6 Z M18.1444251,7.83964668 L12,11.1481833 L5.85557487,7.83964668 C5.4908718,7.6432681 5.03602525,7.77972206 4.83964668,8.14442513 C4.6432681,8.5091282 4.77972206,8.96397475 5.14442513,9.16035332 L11.6444251,12.6603533 C11.8664074,12.7798822 12.1335926,12.7798822 12.3555749,12.6603533 L18.8555749,9.16035332 C19.2202779,8.96397475 19.3567319,8.5091282 19.1603533,8.14442513 C18.9639747,7.77972206 18.5091282,7.6432681 18.1444251,7.83964668 Z" class="svg"></path></g></svg>
                                                                    <span class="smaller text-secondary white-space-nowrap">'; echo $fw_item['full_name']; echo '</span>
                                                                </div>
                                                                <div class="flex flex-col"><span class="text-primary bold">'; echo substr($fw_item['title'], 0, 25). '...'; echo '</span><span class="text-secondary overflow-wrap-bw small">'; echo substr($fw_item['description'], 0, 55). '...'; echo '</span></div>
                                                            </div>
                                                        </div>
                                                        <span class="feedback-item-time text-secondary absolute" title="'; echo $fw_item['created']; echo '">'; echo get_time_ago(strtotime($fw_item['created'])); echo '</span>
                                                    </div>
                                                    ';
                                                }
                                            } else {echo "<div class='padding-1 bold text-primary'>Nincsenek webshoppal kapcsolatos visszajelzések...</div>";}
                                        ?>
                                    `;
                                }); $('#feedback-product').click(function () {
                                    document.getElementById('feedbacks-body').innerHTML = `
                                        <?php
                                            $fw_sql = "SELECT feedbacks.*, customers.id, customers.fullname FROM feedbacks INNER JOIN customers ON (feedbacks.uid = customers.id) WHERE status = 0 AND type = 1 ORDER BY feedbacks.created";
                                            $fw_res = $con-> query($fw_sql);
                                            if ($fw_res-> num_rows > 0) {
                                                while ($fw_item = $fw_res-> fetch_assoc()) {
                                                    echo '
                                                    <div class="theme-button-con flex flex-col relative" id="fw_item'; echo $fw_item['id']; echo '"';?> feedbackID = "<?php echo $fw_item['id']; ?>" feedbackStatus = "<?php echo $fw_item['status'] ?>" feedbackType = "<?php echo $fw_item['type']; ?>" <?php echo '>
                                                        <div class="product-button flex flex-row padding-1 item-bg-light border-soft ease user-select-none pointer">
                                                            <div class="feedback-id text-primary bold underline absolute">#'; echo $fw_item['id']; echo '</div>
                                                            <div class="flex flex-row flex-align-c flex-justify-con-sb">
                                                                <div class="flex flex-col flex-align-c flex-justify-con-c" style="margin-right: 1rem;">
                                                                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="3rem" height="3rem" viewBox="0 0 24 24" version="1.1"><g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"><rect x="0" y="0" width="24" height="24"></rect><path d="M5,6 L19,6 C20.1045695,6 21,6.8954305 21,8 L21,17 C21,18.1045695 20.1045695,19 19,19 L5,19 C3.8954305,19 3,18.1045695 3,17 L3,8 C3,6.8954305 3.8954305,6 5,6 Z M18.1444251,7.83964668 L12,11.1481833 L5.85557487,7.83964668 C5.4908718,7.6432681 5.03602525,7.77972206 4.83964668,8.14442513 C4.6432681,8.5091282 4.77972206,8.96397475 5.14442513,9.16035332 L11.6444251,12.6603533 C11.8664074,12.7798822 12.1335926,12.7798822 12.3555749,12.6603533 L18.8555749,9.16035332 C19.2202779,8.96397475 19.3567319,8.5091282 19.1603533,8.14442513 C18.9639747,7.77972206 18.5091282,7.6432681 18.1444251,7.83964668 Z" class="svg"></path></g></svg>
                                                                    <span class="smaller text-secondary white-space-nowrap">'; echo $fw_item['full_name']; echo '</span>
                                                                </div>
                                                                <div class="flex flex-col"><span class="text-primary bold">'; echo substr($fw_item['title'], 0, 25). '...'; echo '</span><span class="text-secondary overflow-wrap-bw small">'; echo substr($fw_item['description'], 0, 55). '...'; echo '</span></div>
                                                            </div>
                                                        </div>
                                                        <span class="feedback-item-time text-secondary absolute" title="'; echo $fw_item['created']; echo '">'; echo get_time_ago(strtotime($fw_item['created'])); echo '</span>
                                                    </div>
                                                    ';
                                                }
                                            } else {echo "<div class='padding-1 bold text-primary'>Nincsenek termékekkel kapcsolatos visszajelzések...</div>";}
                                        ?>
                                    `;
                                    const feedback_items = document.querySelectorAll('[feedbackID]');var object = {};
                                    for (let i = 0; i < feedback_items.length; i++) {object[i] = {id: feedback_items[i].getAttribute('feedbackID'), status: feedback_items[i].getAttribute('feedbackStatus'), type: feedback_items[i].getAttribute('feedbackType')};
                                    } $(feedback_items).click(function () {var item = this;closeAuth();openFeedback(item);});
                                });
                            }); $('#closed-feedbacks').click(function () {
                                document.getElementById('feedbacks-header').innerHTML = `
                                    <span class="flex flex-align-c">
                                        <span class="text-primary pointer" onclick="showMain()">
                                            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                                <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"><rect x="0" y="0" width="24" height="24"/><circle class="svg" opacity="0.3" cx="12" cy="12" r="10"/><path d="M6.96323356,15.1775211 C6.62849853,15.5122561 6.08578582,15.5122561 5.75105079,15.1775211 C5.41631576,14.842786 5.41631576,14.3000733 5.75105079,13.9653383 L10.8939067,8.82248234 C11.2184029,8.49798619 11.7409054,8.4866328 12.0791905,8.79672747 L17.2220465,13.5110121 C17.5710056,13.8308912 17.5945795,14.3730917 17.2747004,14.7220508 C16.9548212,15.0710098 16.4126207,15.0945838 16.0636617,14.7747046 L11.5257773,10.6149773 L6.96323356,15.1775211 Z" class="svg" fill-rule="nonzero" transform="translate(11.500001, 12.000001) scale(-1, 1) rotate(-270.000000) translate(-11.500001, -12.000001) "/></g>
                                            </svg>
                                        </span>
                                        <span class="header_title_heading" style="margin-left: 1rem;">Lezárt</span>
                                    </span>
                                    <span class="flex">
                                        <span class="text-primary pointer" onclick="closeAuth()">
                                            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                                <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"><rect x="0" y="0" width="24" height="24"/><circle class="svg" opacity="0.3" cx="12" cy="12" r="10"/><path d="M12.0355339,10.6213203 L14.863961,7.79289322 C15.2544853,7.40236893 15.8876503,7.40236893 16.2781746,7.79289322 C16.6686989,8.18341751 16.6686989,8.81658249 16.2781746,9.20710678 L13.4497475,12.0355339 L16.2781746,14.863961 C16.6686989,15.2544853 16.6686989,15.8876503 16.2781746,16.2781746 C15.8876503,16.6686989 15.2544853,16.6686989 14.863961,16.2781746 L12.0355339,13.4497475 L9.20710678,16.2781746 C8.81658249,16.6686989 8.18341751,16.6686989 7.79289322,16.2781746 C7.40236893,15.8876503 7.40236893,15.2544853 7.79289322,14.863961 L10.6213203,12.0355339 L7.79289322,9.20710678 C7.40236893,8.81658249 7.40236893,8.18341751 7.79289322,7.79289322 C8.18341751,7.40236893 8.81658249,7.40236893 9.20710678,7.79289322 L12.0355339,10.6213203 Z" class="svg" /></g>
                                            </svg>
                                        </span>
                                    </span>
                                `;

                                document.getElementById('feedbacks-body').innerHTML = `
                                    <?php
                                        $fw_sql = "SELECT feedbacks.*, customers.id, customers.fullname FROM feedbacks INNER JOIN customers ON (feedbacks.uid = customers.id) WHERE status = 1 ORDER BY feedbacks.created";
                                        $fw_res = $con-> query($fw_sql);
                                        if ($fw_res-> num_rows > 0) {
                                            while ($fw_item = $fw_res-> fetch_assoc()) {
                                                echo '
                                                <div class="theme-button-con flex flex-col relative" id="fw_item'; echo $fw_item['id']; echo '" feedback="'; echo $fw_item['id']; echo '">
                                                    <div class="product-button flex flex-row padding-1 item-bg-light border-soft ease user-select-none pointer">
                                                        <div class="feedback-id text-secondary bold underline absolute">#'; echo $fw_item['id']; echo '</div>
                                                        <div class="flex flex-row flex-align-c flex-justify-con-sb">
                                                            <div class="flex flex-col flex-align-c flex-justify-con-c" style="margin-right: 1rem;">
                                                                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="3rem" height="3rem" viewBox="0 0 24 24" version="1.1"><g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"><rect x="0" y="0" width="24" height="24"></rect><path d="M6,2 L18,2 C18.5522847,2 19,2.44771525 19,3 L19,12 C19,12.5522847 18.5522847,13 18,13 L6,13 C5.44771525,13 5,12.5522847 5,12 L5,3 C5,2.44771525 5.44771525,2 6,2 Z M7.5,5 C7.22385763,5 7,5.22385763 7,5.5 C7,5.77614237 7.22385763,6 7.5,6 L13.5,6 C13.7761424,6 14,5.77614237 14,5.5 C14,5.22385763 13.7761424,5 13.5,5 L7.5,5 Z M7.5,7 C7.22385763,7 7,7.22385763 7,7.5 C7,7.77614237 7.22385763,8 7.5,8 L10.5,8 C10.7761424,8 11,7.77614237 11,7.5 C11,7.22385763 10.7761424,7 10.5,7 L7.5,7 Z" class="svg" opacity="0.3"></path><path d="M3.79274528,6.57253826 L12,12.5 L20.2072547,6.57253826 C20.4311176,6.4108595 20.7436609,6.46126971 20.9053396,6.68513259 C20.9668779,6.77033951 21,6.87277228 21,6.97787787 L21,17 C21,18.1045695 20.1045695,19 19,19 L5,19 C3.8954305,19 3,18.1045695 3,17 L3,6.97787787 C3,6.70173549 3.22385763,6.47787787 3.5,6.47787787 C3.60510559,6.47787787 3.70753836,6.51099993 3.79274528,6.57253826 Z" class="svg-secondary"></path></g></svg>
                                                                <span class="smaller text-secondary white-space-nowrap">'; echo $fw_item['full_name']; echo '</span>
                                                            </div>
                                                            <div class="flex flex-col">
                                                                <span class="text-secondary bold">'; echo $fw_item['title']; echo '</span>
                                                                <span class="text-secondary overflow-wrap-bw small">'; echo substr($fw_item['description'], 0, 55). '...'; echo '</span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <span class="feedback-item-time text-secondary absolute" title="'; echo $fw_item['created']; echo '">'; echo get_time_ago(strtotime($fw_item['created'])); echo '</span>
                                                </div>
                                                ';
                                            }
                                        } else {echo "<div class='padding-1 bold text-primary'>Nincsenek lezárt visszajelzések...</div>";}
                                    ?>
                                `;
                            }); $('#archived-feedbacks').click(function () {
                                document.getElementById('feedbacks-header').innerHTML = `
                                    <span class="flex flex-align-c">
                                        <span class="text-primary pointer" onclick="showMain()">
                                            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                                <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"><rect x="0" y="0" width="24" height="24"/><circle class="svg" opacity="0.3" cx="12" cy="12" r="10"/><path d="M6.96323356,15.1775211 C6.62849853,15.5122561 6.08578582,15.5122561 5.75105079,15.1775211 C5.41631576,14.842786 5.41631576,14.3000733 5.75105079,13.9653383 L10.8939067,8.82248234 C11.2184029,8.49798619 11.7409054,8.4866328 12.0791905,8.79672747 L17.2220465,13.5110121 C17.5710056,13.8308912 17.5945795,14.3730917 17.2747004,14.7220508 C16.9548212,15.0710098 16.4126207,15.0945838 16.0636617,14.7747046 L11.5257773,10.6149773 L6.96323356,15.1775211 Z" class="svg" fill-rule="nonzero" transform="translate(11.500001, 12.000001) scale(-1, 1) rotate(-270.000000) translate(-11.500001, -12.000001) "/></g>
                                            </svg>
                                        </span>
                                        <span class="header_title_heading" style="margin-left: 1rem;">Archivált</span>
                                    </span>
                                    <span class="flex">
                                        <span class="text-primary pointer" onclick="closeAuth()">
                                            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                                <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"><rect x="0" y="0" width="24" height="24"/><circle class="svg" opacity="0.3" cx="12" cy="12" r="10"/><path d="M12.0355339,10.6213203 L14.863961,7.79289322 C15.2544853,7.40236893 15.8876503,7.40236893 16.2781746,7.79289322 C16.6686989,8.18341751 16.6686989,8.81658249 16.2781746,9.20710678 L13.4497475,12.0355339 L16.2781746,14.863961 C16.6686989,15.2544853 16.6686989,15.8876503 16.2781746,16.2781746 C15.8876503,16.6686989 15.2544853,16.6686989 14.863961,16.2781746 L12.0355339,13.4497475 L9.20710678,16.2781746 C8.81658249,16.6686989 8.18341751,16.6686989 7.79289322,16.2781746 C7.40236893,15.8876503 7.40236893,15.2544853 7.79289322,14.863961 L10.6213203,12.0355339 L7.79289322,9.20710678 C7.40236893,8.81658249 7.40236893,8.18341751 7.79289322,7.79289322 C8.18341751,7.40236893 8.81658249,7.40236893 9.20710678,7.79289322 L12.0355339,10.6213203 Z" class="svg" /></g>
                                            </svg>
                                        </span>
                                    </span>
                                `;
                                document.getElementById('feedbacks-body').innerHTML = `
                                    <?php
                                        $fw_sql = "SELECT feedbacks.*, customers.id, customers.fullname FROM feedbacks INNER JOIN customers ON (feedbacks.uid = customers.id) WHERE status = 2 ORDER BY feedbacks.created";
                                        $fw_res = $con-> query($fw_sql);
                                        if ($fw_res-> num_rows > 0) {
                                            while ($fw_item = $fw_res-> fetch_assoc()) {
                                                echo '
                                                <div class="theme-button-con flex flex-col relative" id="fw_item'; echo $fw_item['id']; echo '" feedback="'; echo $fw_item['id']; echo '">
                                                    <div class="product-button flex flex-row padding-1 item-bg-light border-soft ease user-select-none pointer">
                                                        <div class="feedback-id text-secondary bold underline absolute">#'; echo $fw_item['id']; echo '</div>
                                                        <div class="flex flex-row flex-align-c flex-justify-con-sb">
                                                            <div class="flex flex-col flex-align-c flex-justify-con-c" style="margin-right: 1rem;">
                                                                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="3rem" height="3rem" viewBox="0 0 24 24" version="1.1"><g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"><rect x="0" y="0" width="24" height="24"></rect><path d="M4.5,3 L19.5,3 C20.3284271,3 21,3.67157288 21,4.5 L21,19.5 C21,20.3284271 20.3284271,21 19.5,21 L4.5,21 C3.67157288,21 3,20.3284271 3,19.5 L3,4.5 C3,3.67157288 3.67157288,3 4.5,3 Z M8,5 C7.44771525,5 7,5.44771525 7,6 C7,6.55228475 7.44771525,7 8,7 L16,7 C16.5522847,7 17,6.55228475 17,6 C17,5.44771525 16.5522847,5 16,5 L8,5 Z" class="svg-secondary"></path></g></svg>
                                                                <span class="smaller text-secondary white-space-nowrap">'; echo $fw_item['full_name']; echo '</span>
                                                            </div>
                                                            <div class="flex flex-col">
                                                                <span class="text-secondary bold">'; echo $fw_item['title']; echo '</span>
                                                                <span class="text-secondary overflow-wrap-bw small">'; echo substr($fw_item['description'], 0, 55). '...'; echo '</span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <span class="feedback-item-time text-secondary absolute" title="'; echo $fw_item['created']; echo '">'; echo get_time_ago(strtotime($fw_item['created'])); echo '</span>
                                                </div>
                                                ';
                                            }
                                        } else { echo "<div class='padding-1 bold text-primary'>Nincsenek lezárt visszajelzések...</div>";}
                                    ?>
                                `;
                            });
                        </script>
                        <!-- Visszalejzesek kezelese -->
                        <script src="script/feedback.js"></script>
                        <!-- Multinacionalitast elosegito script importalasa -->
                        <script src="/assets/script/internationalize/jquery.MultiLanguage.js"></script>