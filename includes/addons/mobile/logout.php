<?php session_start(); ?>
<div class="sidenav-theme">
    <div class="sidenav-header flex flec-row flex-align-c flex-justify-con-sb">
        <span class="flex flex-col">
            <span class="header_title_heading">Kijelentkezés</span>
        </span>
        <span class="flex">
            <span class="text-primary pointer" onclick="closeSidenavAddons('logout')">
                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"><rect x="0" y="0" width="24" height="24"/><circle class="svg" opacity="0.3" cx="12" cy="12" r="10"/><path d="M12.0355339,10.6213203 L14.863961,7.79289322 C15.2544853,7.40236893 15.8876503,7.40236893 16.2781746,7.79289322 C16.6686989,8.18341751 16.6686989,8.81658249 16.2781746,9.20710678 L13.4497475,12.0355339 L16.2781746,14.863961 C16.6686989,15.2544853 16.6686989,15.8876503 16.2781746,16.2781746 C15.8876503,16.6686989 15.2544853,16.6686989 14.863961,16.2781746 L12.0355339,13.4497475 L9.20710678,16.2781746 C8.81658249,16.6686989 8.18341751,16.6686989 7.79289322,16.2781746 C7.40236893,15.8876503 7.40236893,15.2544853 7.79289322,14.863961 L10.6213203,12.0355339 L7.79289322,9.20710678 C7.40236893,8.81658249 7.40236893,8.18341751 7.79289322,7.79289322 C8.18341751,7.40236893 8.81658249,7.40236893 9.20710678,7.79289322 L12.0355339,10.6213203 Z" class="svg" /></g>
                </svg>
            </span>
        </span>
    </div>
    <div class="theme-body">
        <div class="flex flex-col w-fa gap-1" id="logout-con">
            <div class="flex flex-row flex-align-c flex-justify-con-c w-fa gap-1 item-bg item-bg-hover pointer border-soft border-muted padding-1 login-history-item" data-action="logout">
                <div class="flex flex-col flex-align-l flex-justify-con-c w-fa gap-025">
                    <span class="text-primary bold small">Adatok mentése</span>
                    <span class="text-secondary small-med">Bejelentkezési e-mail cím elmentése, hogy a következő bejelentkezésnél csak a jelszavát kelljen megadni.</span>
                </div>
                <div class="flex flex-col flex-align-c flex-justify-con-c text-muted login-history-icon-con">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><rect opacity="0.3" x="2" y="2" width="20" height="20" rx="10" fill="currentColor"/></svg>
                </div>
            </div>
            <div class="flex flex-row flex-align-c flex-justify-con-c w-fa gap-1 item-bg item-bg-hover pointer border-soft border-muted padding-1 login-history-item" data-action="logOutNoSave">
                <div class="flex flex-col flex-align-l flex-justify-con-c w-fa gap-025">
                    <span class="text-primary bold small">Kijelentkezés</span>
                    <span class="text-secondary small-med">Ha ezt az opciót választja, a következő bejelentkezésnél nem fogja ajánlani az Ön fiókját a bejelentkezéshez, meg kell adni újra bejelentkezési adatait a belépéshez.</span>
                </div>
                <div class="flex flex-col flex-align-c flex-justify-con-c text-muted login-history-icon-con">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><rect opacity="0.3" x="2" y="2" width="20" height="20" rx="10" fill="currentColor"/></svg>
                </div>
            </div>
        </div>
    </div>
</div>

<script content-type="application/javascript">
var loginHistoryItem = document.getElementsByClassName('login-history-item');
    for (let i = 0; i < loginHistoryItem.length; i++) {
        loginHistoryItem[i].addEventListener('mouseenter', () => {
            if (!loginHistoryItem[i].classList.contains('login-history-item-active')) {
                loginHistoryItem[i].getElementsByClassName('login-history-icon-con')[0].classList.replace('text-muted', 'text-primary');
                loginHistoryItem[i].getElementsByClassName('login-history-icon-con')[0].innerHTML = `
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><rect opacity="0.3" x="2" y="2" width="20" height="20" rx="10" fill="currentColor"/><path d="M11.9343 12.5657L9.53696 14.963C9.22669 15.2733 9.18488 15.7619 9.43792 16.1204C9.7616 16.5789 10.4211 16.6334 10.8156 16.2342L14.3054 12.7029C14.6903 12.3134 14.6903 11.6866 14.3054 11.2971L10.8156 7.76582C10.4211 7.3666 9.7616 7.42107 9.43792 7.87962C9.18488 8.23809 9.22669 8.72669 9.53696 9.03696L11.9343 11.4343C12.2467 11.7467 12.2467 12.2533 11.9343 12.5657Z" fill="currentColor"/></svg>
                `;
            }
        });
        loginHistoryItem[i].addEventListener('mouseleave', () => {
            if (!loginHistoryItem[i].classList.contains('login-history-item-active')) {
                loginHistoryItem[i].getElementsByClassName('login-history-icon-con')[0].classList.replace('text-primary', 'text-muted');
                loginHistoryItem[i].getElementsByClassName('login-history-icon-con')[0].innerHTML = `
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><rect opacity="0.3" x="2" y="2" width="20" height="20" rx="10" fill="currentColor"/></svg>
                `;
            }
        });
        loginHistoryItem[i].addEventListener('click', () => {
            for (let j = 0; j < loginHistoryItem.length; j++) {
                loginHistoryItem[j].getElementsByClassName('login-history-icon-con')[0].classList.replace('text-primary', 'text-muted');
                loginHistoryItem[j].getElementsByClassName('login-history-icon-con')[0].innerHTML = `
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><rect opacity="0.3" x="2" y="2" width="20" height="20" rx="10" fill="currentColor"/></svg>
                `;
                loginHistoryItem[j].classList.remove('login-history-item-active');
            }
            loginHistoryItem[i].classList.add('login-history-item-active');
            loginHistoryItem[i].getElementsByClassName('login-history-icon-con')[0].classList.replace('text-muted', 'text-primary');
            loginHistoryItem[i].getElementsByClassName('login-history-icon-con')[0].innerHTML = `<svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><rect opacity="0.3" x="2" y="2" width="20" height="20" rx="10" fill="currentColor"/><path d="M11.9343 12.5657L9.53696 14.963C9.22669 15.2733 9.18488 15.7619 9.43792 16.1204C9.7616 16.5789 10.4211 16.6334 10.8156 16.2342L14.3054 12.7029C14.6903 12.3134 14.6903 11.6866 14.3054 11.2971L10.8156 7.76582C10.4211 7.3666 9.7616 7.42107 9.43792 7.87962C9.18488 8.23809 9.22669 8.72669 9.53696 9.03696L11.9343 11.4343C12.2467 11.7467 12.2467 12.2533 11.9343 12.5657Z" fill="currentColor"/></svg>`;

            var authData = new FormData();
            const authObject = { 
                action : loginHistoryItem[i].getAttribute('data-action'),
                uid : <?= isset($_SESSION['id']) ? $_SESSION['id'] : 0 ?>
            };
            authData.append('auth', JSON.stringify(authObject));

            const ajaxObject = {
                url : '/assets/php/classes/class.Authentication.php', data : authData,
                loaderContainer : {
                    isset : true,
                    id : 'logout-con',
                    type : 'panel',
                    iconSize : {
                        iconWidth : '128',
                        iconHeight : '128'
                    },
                    iconColor : {
                        isset : false,
                        color : ''
                    },
                    loaderText : {
                        custom : true,
                        customText : 'Kijelentkezés folyamatban.'
                    }
                }
            }
            
            let response = getFromAjaxRequest(ajaxObject)
            .then((data) => {
                if (data.status == 'success') {
                    const now = new Date();
                    const notifParams = {
                        notifType : '0', notifIcon : '3', notifTheme : '0',
                        notifTitle : 'Üzenet', notifDesc : 'Sikeres kijelentkezés.',
                        expiry : now.setSeconds(60)
                    }; localStorage.setItem('NP', JSON.stringify(notifParams));
                    window.location.reload(true);
                } else { notificationSystem(0, 3, 0, 'Üzenet', data.message); }
            }) .catch((reason) => { notificationSystem(0, 3, 0, 'Üzenet', reason.message); });

        });

    }
</script>