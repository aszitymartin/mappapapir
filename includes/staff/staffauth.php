<?php
session_start();
?>

<div class="sidenav-theme staffBodyDeskCon">
    <div class="sidenav-header flex flec-row flex-align-c flex-justify-con-sb">
        <span class="flex flex-col">
            <span class="header_title_heading">Hitelesítés</span>
        </span>
        <span class="flex">
            <span class="text-primary pointer" onclick="closeAuth()">
                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"><rect x="0" y="0" width="24" height="24"/><circle class="svg" opacity="0.3" cx="12" cy="12" r="10"/><path d="M12.0355339,10.6213203 L14.863961,7.79289322 C15.2544853,7.40236893 15.8876503,7.40236893 16.2781746,7.79289322 C16.6686989,8.18341751 16.6686989,8.81658249 16.2781746,9.20710678 L13.4497475,12.0355339 L16.2781746,14.863961 C16.6686989,15.2544853 16.6686989,15.8876503 16.2781746,16.2781746 C15.8876503,16.6686989 15.2544853,16.6686989 14.863961,16.2781746 L12.0355339,13.4497475 L9.20710678,16.2781746 C8.81658249,16.6686989 8.18341751,16.6686989 7.79289322,16.2781746 C7.40236893,15.8876503 7.40236893,15.2544853 7.79289322,14.863961 L10.6213203,12.0355339 L7.79289322,9.20710678 C7.40236893,8.81658249 7.40236893,8.18341751 7.79289322,7.79289322 C8.18341751,7.40236893 8.81658249,7.40236893 9.20710678,7.79289322 L12.0355339,10.6213203 Z" class="svg" /></g>
                </svg>
            </span>
        </span>
    </div>
    <div class="theme-body h-100-desk" id="staff-body">
        <div id="staffBody" class="staffBodyDesk">
            <div class="theme-desc text-align-c">
                <span class="text-secondary text-small">A funkció jelszóval van biztosítva. A folytatáshoz adja meg a jelszót.</span>
            </div>
            <div class="staff-password-con flex w-100">
                <input type="password" name="staff-auth" class="staff-auth" id="staff-auth" placeholder="Jelszó megadása" />
            </div>
            <div class="staff-indicator" id="staff-indicator"></div>
            <div class="theme-button-con flex flex-col margin-top-a-desk pointer" style="background-color: transparent;">
                <div class="theme-item flex flex-row" style="padding: 1rem;" id="staff-auth-btton">
                    <div class="theme-button flex flex-align-c flex-justify-con-sb w-100">
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
</div>
<script>
if (document.getElementById('staff-auth')) {document.getElementById('staff-auth').focus();}
$('#staff-auth').on('change input', function () { // Folytatas
    document.getElementById('staff-auth-btton').innerHTML = `<div class="theme-button flex flex-align-c flex-justify-con-sb w-100"><span class="text-primary" style="font-size: 1.2rem">Folytatás</span><label class="flex" id="staffLockIcon"><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="2rem" height="2rem" viewBox="0 0 24 24" version="1.1"><g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"><polygon points="0 0 24 0 24 24 0 24"/><rect class="svg" opacity="0.3" transform="translate(12.000000, 12.000000) rotate(-90.000000) translate(-12.000000, -12.000000) " x="11" y="5" width="2" height="14" rx="1"/><path d="M9.70710318,15.7071045 C9.31657888,16.0976288 8.68341391,16.0976288 8.29288961,15.7071045 C7.90236532,15.3165802 7.90236532,14.6834152 8.29288961,14.2928909 L14.2928896,8.29289093 C14.6714686,7.914312 15.281055,7.90106637 15.675721,8.26284357 L21.675721,13.7628436 C22.08284,14.136036 22.1103429,14.7686034 21.7371505,15.1757223 C21.3639581,15.5828413 20.7313908,15.6103443 20.3242718,15.2371519 L15.0300721,10.3841355 L9.70710318,15.7071045 Z" class="svg" fill-rule="nonzero" transform="translate(14.999999, 11.999997) scale(1, -1) rotate(90.000000) translate(-14.999999, -11.999997) "/></g></svg></label></div>`;
});
$('#staff-auth-btton').click(function () {
    if (document.getElementById('staff-auth').value) { // Feldolgozas
        this.innerHTML = `<div class="theme-button flex flex-align-c flex-justify-con-sb w-100"><span class="text-primary" style="font-size: 1.2rem">Feldolgozás</span><label class="flex" id="staffLockIcon"><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="2rem" height="2rem" viewBox="0 0 24 24" version="1.1"><g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"><rect x="0" y="0" width="24" height="24"/><path d="M12,22 C7.02943725,22 3,17.9705627 3,13 C3,8.02943725 7.02943725,4 12,4 C16.9705627,4 21,8.02943725 21,13 C21,17.9705627 16.9705627,22 12,22 Z" class="svg" opacity="0.3"/><path d="M11.9630156,7.5 L12.0475062,7.5 C12.3043819,7.5 12.5194647,7.69464724 12.5450248,7.95024814 L13,12.5 L16.2480695,14.3560397 C16.403857,14.4450611 16.5,14.6107328 16.5,14.7901613 L16.5,15 C16.5,15.2109164 16.3290185,15.3818979 16.1181021,15.3818979 C16.0841582,15.3818979 16.0503659,15.3773725 16.0176181,15.3684413 L11.3986612,14.1087258 C11.1672824,14.0456225 11.0132986,13.8271186 11.0316926,13.5879956 L11.4644883,7.96165175 C11.4845267,7.70115317 11.7017474,7.5 11.9630156,7.5 Z" class="svg"/></g></svg></label></div>`;
        $.ajax({
            type: "POST",url: "/includes/staff/au.php",
            data: {password: document.getElementById('staff-auth').value,id: <?php if (isset($_SESSION['loggedin'])) {echo $_SESSION['id'];} else {echo "0";}?>},
            cache: false,
            success: function(data) {
                if (data === 'true') { // Jovahagyva
                    document.getElementById('staff-auth-btton').innerHTML = `<div class="theme-button flex flex-align-c flex-justify-con-sb w-100"><span class="text-primary" style="font-size: 1.2rem">Jóváhagyva</span><label class="flex" id="staffLockIcon"><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="2rem" height="2rem" viewBox="0 0 24 24" version="1.1"><g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"><polygon points="0 0 24 0 24 24 0 24"/><path d="M6.26193932,17.6476484 C5.90425297,18.0684559 5.27315905,18.1196257 4.85235158,17.7619393 C4.43154411,17.404253 4.38037434,16.773159 4.73806068,16.3523516 L13.2380607,6.35235158 C13.6013618,5.92493855 14.2451015,5.87991302 14.6643638,6.25259068 L19.1643638,10.2525907 C19.5771466,10.6195087 19.6143273,11.2515811 19.2474093,11.6643638 C18.8804913,12.0771466 18.2484189,12.1143273 17.8356362,11.7474093 L14.0997854,8.42665306 L6.26193932,17.6476484 Z" class="svg" fill-rule="nonzero" transform="translate(11.999995, 12.000002) rotate(-180.000000) translate(-11.999995, -12.000002) "/></g></svg></label></div>`;
                    const now = new Date(); const staffParams = { id: <?php echo $_SESSION['id']; ?>,expiry : now.setSeconds(3600)};
                    localStorage.setItem('userToken', JSON.stringify(staffParams)); location.href="users";
                } else {document.getElementById('staff-auth-btton').innerHTML = `<div class="theme-button flex flex-align-c flex-justify-con-sb w-100"><span class="text-primary" style="font-size: 1.2rem">Elutasítva</span><label class="flex" id="staffLockIcon"><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="2rem" height="2rem" viewBox="0 0 24 24" version="1.1"><g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"><g transform="translate(12.000000, 12.000000) rotate(-45.000000) translate(-12.000000, -12.000000) translate(4.000000, 4.000000)" class="svg"><rect x="0" y="7" width="16" height="2" rx="1"/><rect opacity="0.3" transform="translate(8.000000, 8.000000) rotate(-270.000000) translate(-8.000000, -8.000000) " x="0" y="7" width="16" height="2" rx="1"/></g></g></svg></label></div>`;}
            }, error: function (data) {document.getElementById('staff-auth-btton').innerHTML = `<div class="theme-button flex flex-align-c flex-justify-con-sb w-100"><span class="text-primary" style="font-size: 1.2rem">Hiba</span><label class="flex" id="staffLockIcon"><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="2rem" height="2rem" viewBox="0 0 24 24" version="1.1"><g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"><g transform="translate(12.000000, 12.000000) rotate(-45.000000) translate(-12.000000, -12.000000) translate(4.000000, 4.000000)" class="svg"><rect x="0" y="7" width="16" height="2" rx="1"/><rect opacity="0.3" transform="translate(8.000000, 8.000000) rotate(-270.000000) translate(-8.000000, -8.000000) " x="0" y="7" width="16" height="2" rx="1"/></g></g></svg></label></div>`;}
        });
    } else {document.getElementById('staff-auth').focus();}
});
</script>