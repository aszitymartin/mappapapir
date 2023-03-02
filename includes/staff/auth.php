<?php session_start(); ?>
<div class="sidenav-theme flex flex-col flex-justify-con-sb h-fa">
    <div class="flex flex-col gap-1 w-fa">
        <div class="sidenav-header flex flec-row flex-align-c flex-justify-con-sb">
            <span class="flex flex-col">
                <span class="header_title_heading">Hitelesítés</span>
            </span>
            <span class="flex">
                <span class="text-primary pointer" onclick="closeStaffAddon()">
                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                        <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"><rect x="0" y="0" width="24" height="24"/><circle class="svg" opacity="0.3" cx="12" cy="12" r="10"/><path d="M12.0355339,10.6213203 L14.863961,7.79289322 C15.2544853,7.40236893 15.8876503,7.40236893 16.2781746,7.79289322 C16.6686989,8.18341751 16.6686989,8.81658249 16.2781746,9.20710678 L13.4497475,12.0355339 L16.2781746,14.863961 C16.6686989,15.2544853 16.6686989,15.8876503 16.2781746,16.2781746 C15.8876503,16.6686989 15.2544853,16.6686989 14.863961,16.2781746 L12.0355339,13.4497475 L9.20710678,16.2781746 C8.81658249,16.6686989 8.18341751,16.6686989 7.79289322,16.2781746 C7.40236893,15.8876503 7.40236893,15.2544853 7.79289322,14.863961 L10.6213203,12.0355339 L7.79289322,9.20710678 C7.40236893,8.81658249 7.40236893,8.18341751 7.79289322,7.79289322 C8.18341751,7.40236893 8.81658249,7.40236893 9.20710678,7.79289322 L12.0355339,10.6213203 Z" class="svg" /></g>
                    </svg>
                </span>
            </span>
        </div>
        <div class="theme-desc text-align-c">
            <span class="text-secondary text-small">A magas szintű mód eléréséhez meg kell adnia a jelszót. Csak háromszor próbálkozhat, mielőtt a rendszer kitiltja.</span>
        </div>
    </div>
    <div class="theme-body flex flex-col h-fa" id="staff-body">
        <div id="staffBody" class="flex flex-col h-fa"></div>
        <script>
            // const isStaffLock = localStorage.getItem('staffLock');
            // const getlockParams = JSON.parse(localStorage.getItem('staffLock'));
            if (!localStorage.getItem('staffLock')) {
                document.getElementById('staffBody').innerHTML = `
                    <div class="flex flex-col h-fa margin-top-a">
                        <div class="staff-password-con flex w-100">
                            <input type="password" name="staff-auth" class="staff-auth" id="staff-auth" placeholder="Jelszó megadása" />
                        </div>
                        <div class="flex flex-col w-fa margin-top-a">
                            <div class="staff-indicator" id="staff-indicator"></div>
                            <div class="theme-button-con flex flex-col" style="background-color: transparent;">
                                <div class="theme-item pointer flex flex-row" style="padding: 1rem;" id="staff-auth-btton">
                                    <div class="flex flex-align-c flex-justify-con-sb w-100">
                                        <span class="text-primary" style="font-size: 1.2rem">Folytatás</span>
                                        <label class="flex" id="staffLockIcon">
                                            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="2rem" height="2rem" viewBox="0 0 24 24" version="1.1">
                                                <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"><polygon points="0 0 24 0 24 24 0 24"/><rect class="svg" opacity="0.3" transform="translate(12.000000, 12.000000) rotate(-90.000000) translate(-12.000000, -12.000000) " x="11" y="5" width="2" height="14" rx="1"/><path d="M9.70710318,15.7071045 C9.31657888,16.0976288 8.68341391,16.0976288 8.29288961,15.7071045 C7.90236532,15.3165802 7.90236532,14.6834152 8.29288961,14.2928909 L14.2928896,8.29289093 C14.6714686,7.914312 15.281055,7.90106637 15.675721,8.26284357 L21.675721,13.7628436 C22.08284,14.136036 22.1103429,14.7686034 21.7371505,15.1757223 C21.3639581,15.5828413 20.7313908,15.6103443 20.3242718,15.2371519 L15.0300721,10.3841355 L9.70710318,15.7071045 Z" class="svg" fill-rule="nonzero" transform="translate(14.999999, 11.999997) scale(1, -1) rotate(90.000000) translate(-14.999999, -11.999997) "/></g>
                                            </svg>
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                `;
            } else {
                var c = new Date(JSON.parse(localStorage.getItem('staffLock')).lockExpiry).getTime();
                var t = setInterval(function() {
                    var n = new Date().getTime();var d = c - n;
                    var da = Math.floor(d / (1000 * 60 * 60 * 24));var h = Math.floor((d % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
                    var m = Math.floor((d % (1000 * 60 * 60)) / (1000 * 60));var s = Math.floor((d % (1000 * 60)) / 1000);
                    document.getElementById("counterLocked").innerHTML = da + ":" + h + ":"+ m + ":" + s;
                    if (d < 0) {clearInterval(t);localStorage.removeItem('staffLock');localStorage.setItem('staffTries', 3);localStorage.removeItem('staffTries');}
                }, 1000);
                document.getElementById('staffBody').innerHTML = `
                <div class="theme-desc text-align-c">
                    <span class="text-secondary text-small">Túl sokszor írt be rossz jelszót, ezért 15 perc várakozási időt kapott.</span>
                </div>
                <div class="theme-button-con flex flex-col" style="background-color: transparent;">
                <div class="theme-item flex flex-row flex-align-c flex-justify-con-sb" style="padding: 1rem;" id="staffLockedButton>
                    <div class="theme-button flex flex-align-c flex-justify-con-sb w-100">
                        <span class="text-primary" style="font-size: 1.2rem" id="counterLocked">--:--:--:--</span>
                        <label class="flex">
                            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="2rem" height="2rem" viewBox="0 0 24 24" version="1.1">
                                <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"><rect x="0" y="0" width="24" height="24"/><path d="M12,22 C7.02943725,22 3,17.9705627 3,13 C3,8.02943725 7.02943725,4 12,4 C16.9705627,4 21,8.02943725 21,13 C21,17.9705627 16.9705627,22 12,22 Z" class="svg" opacity="0.3"/><path d="M11.9630156,7.5 L12.0475062,7.5 C12.3043819,7.5 12.5194647,7.69464724 12.5450248,7.95024814 L13,12.5 L16.2480695,14.3560397 C16.403857,14.4450611 16.5,14.6107328 16.5,14.7901613 L16.5,15 C16.5,15.2109164 16.3290185,15.3818979 16.1181021,15.3818979 C16.0841582,15.3818979 16.0503659,15.3773725 16.0176181,15.3684413 L11.3986612,14.1087258 C11.1672824,14.0456225 11.0132986,13.8271186 11.0316926,13.5879956 L11.4644883,7.96165175 C11.4845267,7.70115317 11.7017474,7.5 11.9630156,7.5 Z" class="svg"/></g>
                            </svg>
                        </label>
                    </div>
                </div>
                `;
            }

        </script>
    </div>
</div>
<script>
if (document.getElementById('staff-auth')) {document.getElementById('staff-auth').focus();}
document.getElementById('staff-auth').addEventListener("keyup", function(event) {if (event.keyCode === 13) {event.preventDefault();$('#staff-auth-btton').click();}});
$('#staff-auth-btton').click(function () {
    if (document.getElementById('staff-auth').value) {
        const getStaffTries = localStorage.getItem('staffTries');
        if (!getStaffTries) {localStorage.setItem('staffTries', JSON.stringify(staffTries));}
        $.ajax({
            type: "POST",url: "/includes/staff/au.php",data: {password: document.getElementById('staff-auth').value,id: <?php if (isset($_SESSION['loggedin'])) {echo $_SESSION['id'];} else {echo "0";}?>},cache: false,
            success: function(data) {
                if (data === 'true') {
                    <?php $_SESSION["token"] = hash_hmac('sha256', "tokenString", "t2o0k0e0n3");$_SESSION['token_expiry'] = time(); ?>
                    document.getElementById('staffLockIcon').innerHTML = `<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="2rem" height="2rem" viewBox="0 0 24 24" version="1.1"><g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"><g><polygon points="0 0 24 0 24 24 0 24"/></g><path d="M12,4 L12,6 C8.6862915,6 6,8.6862915 6,12 C6,15.3137085 8.6862915,18 12,18 C15.3137085,18 18,15.3137085 18,12 C18,10.9603196 17.7360885,9.96126435 17.2402578,9.07513926 L18.9856052,8.09853149 C19.6473536,9.28117708 20,10.6161442 20,12 C20,16.418278 16.418278,20 12,20 C7.581722,20 4,16.418278 4,12 C4,7.581722 7.581722,4 12,4 Z" class="svg" fill-rule="nonzero" opacity="0.3" transform="translate(12.000000, 12.000000) scale(-1, 1) translate(-12.000000, -12.000000) "/></g></svg>`;
                    document.getElementById('staff-auth-btton').classList.add('pointer-event-none');
                    setTimeout(function () {location.href="/admin";document.getElementById('staff-auth-btton').classList.remove('pointer-event-none');}, 350);
                } else {
                    const triesParams = JSON.parse(localStorage.getItem('staffTries'));
                    const newTries = {triesNum: JSON.parse(localStorage.getItem('staffTries')).triesNum - 1,triesExpiry: JSON.parse(localStorage.getItem('staffTries')).triesExpiry};
                    localStorage.setItem('staffTries', JSON.stringify(newTries));const getNewTries = localStorage.getItem('staffTries');const newParams = JSON.parse(getNewTries);
                    if (newParams.triesNum < 1) {
                        const now = new Date();const staffLock = {lockType : "1",lockExpiry : now.setSeconds(900)};
                        localStorage.setItem('staffLock', JSON.stringify(staffLock));const getStaffLock = localStorage.getItem('staffLock');const lockParams = JSON.parse(getStaffLock);
                        var c = new Date(lockParams.lockExpiry).getTime();var t = setInterval(function() {var n = new Date().getTime();var d = c - n;
                            var da = Math.floor(d / (1000 * 60 * 60 * 24));var h = Math.floor((d % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));var m = Math.floor((d % (1000 * 60 * 60)) / (1000 * 60));
                            var s = Math.floor((d % (1000 * 60)) / 1000);document.getElementById("counter").innerHTML = da + ":" + h + ":"+ m + ":" + s;
                            if (d < 0) {
                                clearInterval(t);localStorage.removeItem('staffLock');localStorage.setItem('staffTries', 3);
                                localStorage.removeItem('staffTries');document.getElementById("counter").innerHTML = 'Most újra próbálkozhat.';
                            }
                        }, 1000);
                        document.getElementById('staff-body').innerHTML = `
                        <div class="theme-desc text-align-c">
                            <span class="text-secondary text-small">Túl sokszor írt be rossz jelszót, ezért 15 perc várakozási időt kapott.</span>
                        </div>
                        <div class="theme-button-con flex flex-col" style="background-color: transparent;">
                        <div class="theme-item flex flex-row" style="padding: 1rem;" id="staff-auth-btton">
                            <div class="theme-button flex flex-align-c flex-justify-con-sb w-100">
                                <span class="text-primary" style="font-size: 1.2rem" id="counter">--:--:--:--</span>
                                <label class="flex">
                                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="2rem" height="2rem" viewBox="0 0 24 24" version="1.1">
                                        <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"><rect x="0" y="0" width="24" height="24"/><path d="M12,22 C7.02943725,22 3,17.9705627 3,13 C3,8.02943725 7.02943725,4 12,4 C16.9705627,4 21,8.02943725 21,13 C21,17.9705627 16.9705627,22 12,22 Z" class="svg" opacity="0.3"/><path d="M11.9630156,7.5 L12.0475062,7.5 C12.3043819,7.5 12.5194647,7.69464724 12.5450248,7.95024814 L13,12.5 L16.2480695,14.3560397 C16.403857,14.4450611 16.5,14.6107328 16.5,14.7901613 L16.5,15 C16.5,15.2109164 16.3290185,15.3818979 16.1181021,15.3818979 C16.0841582,15.3818979 16.0503659,15.3773725 16.0176181,15.3684413 L11.3986612,14.1087258 C11.1672824,14.0456225 11.0132986,13.8271186 11.0316926,13.5879956 L11.4644883,7.96165175 C11.4845267,7.70115317 11.7017474,7.5 11.9630156,7.5 Z" class="svg"/></g>
                                    </svg>
                                </label>
                            </div>
                        </div>
                        `;
                    } else {
                        document.getElementById('staff-indicator').innerHTML = `
                        <span class="warning-card flex flex-row flex-align-c" style="margin-bottom: 1rem;">
                            <span class="warning-icon flex">
                                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="1rem" height="1rem" viewBox="0 0 24 24" version="1.1">
                                    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"><rect x="0" y="0" width="24" height="24"></rect><circle class="svg" opacity="0.3" cx="12" cy="12" r="10"></circle><rect class="svg" x="11" y="7" width="2" height="8" rx="1"></rect><rect class="svg" x="11" y="16" width="2" height="2" rx="1"></rect></g>
                                </svg>
                            </span>
                            <span class="warning-text flex">Hibás adatok! (${triesParams.triesNum - 1})</span>
                        </span>
                        `;   
                    }
                }
            },
            error: function () {console.log('error');}
        });
    } else {document.getElementById('staff-auth').focus();}
});
</script>