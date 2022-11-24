<?php session_start(); ?>
<div class="sidenav-theme feedback-container h-100">
    <div class="sidenav-header flex flec-row flex-align-c flex-justify-con-sb" style="margin-bottom: .5rem !important;">
        <span class="flex flex-col">
            <span class="header_title_heading">Értesítések</span>
        </span>
        <span class="flex">
            <span class="text-primary" onclick="closeSidenavAddons()">
                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                        <rect x="0" y="0" width="24" height="24"/>
                        <circle class="svg" opacity="0.3" cx="12" cy="12" r="10"/>
                        <path d="M12.0355339,10.6213203 L14.863961,7.79289322 C15.2544853,7.40236893 15.8876503,7.40236893 16.2781746,7.79289322 C16.6686989,8.18341751 16.6686989,8.81658249 16.2781746,9.20710678 L13.4497475,12.0355339 L16.2781746,14.863961 C16.6686989,15.2544853 16.6686989,15.8876503 16.2781746,16.2781746 C15.8876503,16.6686989 15.2544853,16.6686989 14.863961,16.2781746 L12.0355339,13.4497475 L9.20710678,16.2781746 C8.81658249,16.6686989 8.18341751,16.6686989 7.79289322,16.2781746 C7.40236893,15.8876503 7.40236893,15.2544853 7.79289322,14.863961 L10.6213203,12.0355339 L7.79289322,9.20710678 C7.40236893,8.81658249 7.40236893,8.18341751 7.79289322,7.79289322 C8.18341751,7.40236893 8.81658249,7.40236893 9.20710678,7.79289322 L12.0355339,10.6213203 Z" class="svg" />
                    </g>
                </svg>
            </span>
        </span>
    </div>
    <div class="theme-body">
        <div class="theme-desc text-align-c" style="margin-bottom: 1rem;">
            <span class="text-secondary text-small">Az összes olvasatlan értesítése, itt, az értesítési központban fognak megjelenni.</span>
        </div>
        <div class="flex flex-col gap-1 h-100" id="sidenav-notification-con">
            <?php
                if (isset($_SESSION['loggedin'])) {
                    if ($_SESSION['id'] == 1) {
                        echo '
                        <script>
                            $(document).ready(function () {
                                $.ajax({
                                    type: "GET", url: "/includes/staff/actions/feedback-all.php",
                                    success: function(data) {
                                        if (Number(data) > 0) {
                                            var notification_item = document.createElement("div");
                                            notification_item.classList = "flex flex-row flex-align-c gap-1 padding-05 border-soft box-shadow background-bg";
                                            notification_item.innerHTML = `
                                            <div class="flex flex-col">
                                                <div class="flex flex-justify-con-c flex-align-c">
                                                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="2rem" height="2rem" viewBox="0 0 24 24" version="1.1">
                                                        <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"><rect x="0" y="0" width="24" height="24"></rect><path d="M3.5,3 L5,3 L5,19.5 C5,20.3284271 4.32842712,21 3.5,21 L3.5,21 C2.67157288,21 2,20.3284271 2,19.5 L2,4.5 C2,3.67157288 2.67157288,3 3.5,3 Z" class="svg"></path><path d="M6.99987583,2.99995344 L19.754647,2.99999303 C20.3069317,2.99999474 20.7546456,3.44771138 20.7546439,3.99999613 C20.7546431,4.24703684 20.6631995,4.48533385 20.497938,4.66895776 L17.5,8 L20.4979317,11.3310353 C20.8673908,11.7415453 20.8341123,12.3738351 20.4236023,12.7432941 C20.2399776,12.9085564 20.0016794,13 19.7546376,13 L6.99987583,13 L6.99987583,2.99995344 Z" class="svg" opacity="0.3"></path></g>
                                                    </svg>
                                                </div>
                                            </div>
                                            <div class="flex flex-col">
                                                <span class="text-primary bold" style="font-size: 1.2rem; margin-bottom: .25rem;">Visszajelzések</span>
                                                <span class="text-secondary small">Önnek <span class="text-primary bold">${data}</span> olvasatlan értesítése van.</span>
                                            </div>
                                            `;
                                            document.getElementById("sidenav-notification-con").prepend(notification_item);
                                        }
                                    }, error: function (err) { console.log(err); }
                                });
                            });
                        </script>
                        ';
                    }
                }            
            ?>
        </div>
    </div>
</div>