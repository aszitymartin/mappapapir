<?php include($_SERVER['DOCUMENT_ROOT'].'/includes/inc.php');
if (isset($_SESSION['loggedin'])) {
    $stmt = $con->prepare('SELECT privilege FROM customers__priv  WHERE uid = ?'); if (isset($_SESSION['loggedin'])) {$id = $_SESSION['id'];} $stmt->bind_param('i', $id);$stmt->execute(); $stmt->bind_result($privilege); $stmt->fetch();$stmt->close();
    if ($privilege != 2) { echo "<script>window.location.href='/';</script>"; }
} else { header("Location: /"); }
$guid = $_SESSION['guid']; $gname = $_SESSION['gname'];
?>
<div class="flex flex-col gap-1">
    <div class="flex flex-col w-fa gap-1 border-soft item-bg box-shadow padding-1">
        <div class="flex flex-row flex-align-c flex-justify-con-sb">
            <span class="text-primary large bold"><?= $gname; ?> fiókjának eltávolítása</span>
        </div>
        <div class="flex flex-col flex-align-c gap-1">
            <div class="flex flex-row">
                <ul class="flex flex-col gap-1 padding-0 list-style-none">
                    <li class="flex flex-col gap-1">
                        <span class="text-secondary small bold">Fiók deaktiválása</span>
                        <ul class="flex flex-col gap-05 list-style-none">
                            <li>
                                <span class="text-secondary small-med">Fiókja felfüggesztését követően profilját deaktiváljuk, és kiküldünk egy utolsó emailt, abban az esetben, ha nem Ön kezdeményezte volna a fiókja felfüggesztését, hogy legyen lehetősége reagálni. Az email kiküldése után megszakítunk Önnel minden értesítési kapcsolatot, amire fel volt iratkozva.</span>
                            </li>
                            <li>
                                <span class="text-secondary small-med">Az aktív rendelései még kiszállításra kerülnek, de az utolsó termék kiszállításával a fiókja nem lesz jogosult rendelések leadására, amíg nem aktiválja újra a profilját.</span>
                            </li>
                            <li>
                                <span class="text-secondary small-med">Fiókját újra aktiválhatja, ha újból bejelentkezik a felfüggesztett profilba. Bejelentkezés után azonnal minden megszakított kapcsolatokat visszaállítunk, és újból jogosult lesz a profilja rendelések leadására.</span>
                            </li>
                        </ul>
                    </li>
                    <li class="flex flex-col gap-1">
                        <span class="text-secondary small bold">Fiók törlése</span>
                        <ul class="flex flex-col gap-05 list-style-none">
                            <li>
                                <span class="text-secondary small-med">Fiókja törlésénél kijelentkeztetjük Önt, majd a kijelentkezéstől számított 30 napig még tároljuk fiókja adatait. Ez a 30 nap alatt bármikor bejelentkezhet, ezzel megszakítva a törlési folyamatot.</span>
                            </li>
                            <li>
                                <span class="text-secondary small-med">30 nap elteltével az Ön fiókja véglegesen törlésre kerül, és minden adatot, ami a fiókjával kapcsolatban áll, töröljük adatbázisunkból.</span>
                            </li>
                            <li>
                                <span class="text-secondary small-med">Fiókját a 30. nap elteltével már nem tudja újra aktiválni, új profilt kell regisztrálnia, ha mégis tag szeretne lenni.</span>
                            </li>
                            <li>
                                <span class="text-secondary small-med">A folyamatban lévő termékeit még kiszállítjuk a fiókja törlése után is.</span>
                            </li>
                        </ul>
                    </li>
                </ul>
            </div>
            <hr style="border: 1px solid var(--background);" class="w-100">
            <div class="flex flex-row flex-align-c flex-justify-con-sb w-fa">
                <div class="flex flex-row w-100">
                    <label class="checkbox__con flex flex-align-c" id="profcana__con">
                        <label class="text-secondary small-med pointer user-select-none" for="profcan__accept">Elolvastam, és elfogadom a fiók törlésére / felfüggesztésére vonatkozó feltételeket, és kívánom elvégezni a következő műveleteket.</label>
                        <input type="checkbox" name="profcan__accept" id="profcan__accept">
                        <span class="ch__checkmark"></span>
                    </label>
                </div>
                <div class="flex flex-row flex-align-fe flex-justify-con-fe">
                    <span class="danger-bg-disabled padding-05 border-soft not-allowed user-select-none bold" style="font-size: .9rem;" id="cncl__account">Folytatás</span>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    var dcheck = document.getElementById('profcan__accept');
    $('#profcan__accept').click(() => {
        if (dcheck.checked) {
            document.getElementById('cncl__account').classList.replace('danger-bg-disabled', 'danger-bg');
            document.getElementById('cncl__account').classList.replace('not-allowed', 'pointer');
            $('#cncl__account').click(() => { var c__wrapper = document.createElement('div'); c__wrapper.classList = "wrapper_dark fadein"; var c__box = document.createElement('div'); c__box.classList = "d__confirm popup fixed flex flex-col border-soft item-bg box-shadow padding-1";
                c__wrapper.classList.add('fadein'); c__wrapper.classList.remove('fadeout'); c__box.classList.add('padding-t-0'); c__box.classList.add('popup'); c__box.classList.remove('popout'); document.body.append(c__wrapper); c__wrapper.append(c__box); $('html').css("overflow-y", "hidden");
                c__box.innerHTML = `
                    <div class="flex flex-row flex-align-c flex-justify-con-sb padding-t-1" id="cbh__con">
                        <span class="text-primary small bold">Fiókja deaktiválása vagy törlése</span>
                        <div class="flex flex-row flex-align-c gap-05">
                            <span class="text-primary pointer" aria-label="Bezárás" id="cl__box"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"><rect opacity="0.3" x="2" y="2" width="20" height="20" rx="5" fill="currentColor"/><rect x="7" y="15.3137" width="12" height="2" rx="1" transform="rotate(-45 7 15.3137)" fill="currentColor"/><rect x="8.41422" y="7" width="12" height="2" rx="1" transform="rotate(45 8.41422 7)" fill="currentColor"/></svg></span>
                        </div>
                    </div><br>
                    <div class="flex flex-row flex-align-c flex-justify-con-c">
                        <span class="text-secondary" style="font-size: .75rem !important;">Ha szünetet szeretne tartani, deaktiválhatja fiókját. Ha véglegesen törölni szeretné fiókját adatbázisunkból, tudassa velünk.</span>
                    </div><br>
                    <div class="flex flex-col flex-align-c flex-justify-con-c gap-1">
                        <div class="flex flex-row flex-align-c gap-1 border-soft border-primary padding-1 pointer primary-bg-hover-light" id="pf__deactivate">
                            <div class="flex flex-col flex-align-c">
                                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="48px" height="48px" viewBox="0 0 24 24" version="1.1"><g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"><rect x="0" y="0" width="24" height="24"/><path d="M18.2641169,18 L9.90940412,10.9507111 C8.24477845,9.54618316 8.03392756,7.05814259 9.43845547,5.39351691 C10.1267688,4.57773816 11.1163612,4.07580669 12.1811979,4.00236967 C14.1700425,3.86520797 15.8935112,5.36629356 16.0306728,7.35513817 C16.1048325,8.43045309 15.6945681,9.48264626 14.9120861,10.223945 L13.5365968,8.77203961 C13.8855318,8.44146963 14.0684825,7.97226137 14.0354122,7.49274235 C13.9742472,6.60584978 13.2056947,5.93646532 12.3188021,5.99763033 C11.7939961,6.03382384 11.3062744,6.28120132 10.9670384,6.68325879 C10.2748153,7.5036714 10.3787334,8.72990496 11.199146,9.4221281 L20.5993649,17.3535628 C20.9371521,17.6385708 21.1320585,18.0580387 21.1320585,18.5 C21.1320585,19.3284271 20.4604856,20 19.6320585,20 L4.0273216,20 C3.54950629,20 3.10027672,19.7723581 2.81771411,19.3870455 C2.32781241,18.7189977 2.47222833,17.7802942 3.14027611,17.2903925 L9.40863634,12.693595 L10.5913637,14.306405 L5.5546432,18 L18.2641169,18 Z" fill="#3699FF" fill-rule="nonzero"/></g></svg>
                            </div>
                            <div class="flex flex-col flex-align-c w-fa">
                                <div class="flex flex-row flex-align-c gap-1 w-fa">
                                    <span class="text-primary-light small bold">Fiók deaktiválása</span>
                                    <span class="label label-primary border-soft bold">Ideiglenes</span>
                                </div>
                                <span class="text-secondary smaller-light">Fiókja fel lesz függesztve, minden tevékenysége el lesz tüntetve az oldalról, amíg vissza nem jelentkezik. A termék értkékelései el lesznek tüntetve az oldalról. így nem fognak beleszámítani a termék átlagába.</span>
                            </div>
                        </div>
                        <div class="flex flex-row flex-align-c gap-1 border-soft border-danger padding-1 pointer danger-bg-hover-light" id="pf__delete">
                            <div class="flex flex-col flex-align-c">
                                <svg xmlns="http://www.w3.org/2000/svg" width="48" height="48" viewBox="0 0 24 24" fill="none"><path d="M5 9C5 8.44772 5.44772 8 6 8H18C18.5523 8 19 8.44772 19 9V18C19 19.6569 17.6569 21 16 21H8C6.34315 21 5 19.6569 5 18V9Z" fill="#F64E60"></path><path opacity="0.5" d="M5 5C5 4.44772 5.44772 4 6 4H18C18.5523 4 19 4.44772 19 5V5C19 5.55228 18.5523 6 18 6H6C5.44772 6 5 5.55228 5 5V5Z" fill="#F64E60"></path><path opacity="0.5" d="M9 4C9 3.44772 9.44772 3 10 3H14C14.5523 3 15 3.44772 15 4V4H9V4Z" fill="#F64E60"></path></svg>
                            </div>
                            <div class="flex flex-col flex-align-c w-fa">
                                <div class="flex flex-row flex-align-c gap-1 w-fa">
                                    <span class="text-danger small bold">Fiók eltávolítása</span>
                                    <span class="label label-danger border-soft bold">Visszavonhatatlan</span>
                                </div>
                                <span class="text-secondary smaller-light">Amikor törli fiókját, nem lesz lehetősége többet megnézni fiókja adatait. 30 nap múlva az összes adata el lesz távolítva adatbázisunkból.</span>
                            </div>
                        </div>
                    </div>
                `;
                var con = document.getElementById('cbh__con');var mc = new Hammer(con);mc.get('pan').set({ direction: Hammer.DIRECTION_ALL });mc.on("pandown", function(ev) { $('#cl__box').click(); });
                var ce__wrapper = document.createElement('div'); ce__wrapper.classList = "wrapper_dark fadein"; var ce__box = document.createElement('div');
                $("#pf__deactivate").click(() => { ce__wrapper.classList.remove('fadeout');
                    ce__box.classList = "d__confirm de__confirm popup fixed flex flex-col border-soft item-bg box-shadow padding-1 padding-t-0"; c__wrapper.append(ce__wrapper); ce__wrapper.append(ce__box); $('html').css("overflow-y", "hidden");
                    ce__box.innerHTML = `
                    <div class="flex flex-row flex-align-c flex-justify-con-sb padding-t-1" id="cbh__incon">
                        <span class="text-primary bold" id="prs__title">Felfüggesztés</span>
                        <div class="flex flex-row flex-align-c gap-05"><span class="flex" id="prsb__con"></span><span class="text-primary pointer" id="cl__ebox" aria-label="Mégsem"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"><rect opacity="0.3" x="2" y="2" width="20" height="20" rx="5" fill="currentColor"/><rect x="7" y="15.3137" width="12" height="2" rx="1" transform="rotate(-45 7 15.3137)" fill="currentColor"/><rect x="8.41422" y="7" width="12" height="2" rx="1" transform="rotate(45 8.41422 7)" fill="currentColor"/></svg></span></div>
                    </div><br>
                    <div class="flex flex-col gap-1 feat__body prs__con">
                        <div class="flex flex-row flex-align-c flex-justify-con-c w-fa">
                            <span class="text-secondary text-align-c" style="font-size: .75rem !important;">Fiókját újra aktiválhatja, ha ismét bejelentkezik fiókjába. Deaktiválást követően nem kapja meg emailen a heti hírlevelünket.</span>
                        </div>
                        <div class="flex flex-col flex-align-c w-fa col-05">
                            <span class="text-primary prst__trig w-fa" style="font-size: .80rem !important;">Adja meg jelszavát</span>
                            <input type="password" class="flex w-fa text-primary border-soft background-bg padding-1-05 outline-none border-none" style="font-size: .75rem !important;" name="chpr__cpassword" id="chpr__cpassword" placeholder="Jelenlegi jelszó" autocomplete='password' />
                            <span class="flex flex-row flex-align-fe flex-justify-con-fe w-fa text-danger" id="deactpe__ind" style="font-size: .75rem !important;"></span>
                        </div>
                        <div class="flex flex-row-d-col-m flex-align-c flex-justify-con-sb border-soft border-primary-light-dotted primary-bg padding-1">
                            <div class="flex flex-row-d-col-m flex-align-c gap-1">
                                <div class="flex flex-row flex-align-c gap-1">
                                    <div class="flex flex-col flex-align-c flex-justify-con-fs">
                                        <span class="bold w-100" style="font-size: .9rem !important;">Adatai biztonságának megőrzése</span>
                                        <span class="text-secondary" style="font-size: .75rem !important;">Semmi sem fontosabb számunkra, mint a felhasználóink biztonsága. Ön kényes információkat oszt meg velünk, amit nagy becsben tartunk, így soha nem fogunk kompromisszumot kötni adatai védelmében.</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div><br>
                    <div class="flex flex-row flex-align-fe flex-justify-con-fe">
                        <span class="danger-bg-disabled padding-05 border-soft not-allowed user-select-none smaller-light" id="sbmt__cncl">Felfüggesztés</span>
                    </div>
                    `;
                    var con = document.getElementById('cbh__incon');var mc = new Hammer(con);mc.get('pan').set({ direction: Hammer.DIRECTION_ALL });mc.on("pandown", function(ev) { $('#cl__ebox').click(); });
                    $('#chpr__cpassword').on("change input", () => {
                        if ($("#chpr__cpassword").val().length >= 8) { document.getElementById("sbmt__cncl").classList.remove("danger-bg-disabled");document.getElementById("sbmt__cncl").classList.remove("not-allowed");document.getElementById("sbmt__cncl").classList.add("danger-bg");document.getElementById("sbmt__cncl").classList.add("danger-bg-hover");document.getElementById("sbmt__cncl").classList.add("pointer");
                            $("#sbmt__cncl").click(() => {
                                if ($("#chpr__cpassword").val().length >= 8) {
                                    var pwd__data = new FormData(); pwd__data.append("original", $("#chpr__cpassword").val());
                                    $.ajax({ enctype: "multipart/form-data", type: "POST", url: "/assets/php/profile/get__password.php", data: pwd__data, dataType: 'json', contentType: false, processData: false,
                                        success: function(data) {
                                            if (data === 200) { document.getElementById("deactpe__ind").textContent = ""; var deact__data = new FormData(); pwd__data.append('uid', <?= $guid; ?>);
                                            $.ajax({ enctype: "multipart/form-data", type: "POST", url: "/assets/php/profile/deactivate__a.php", data: deact__data, dataType: 'json', contentType: false, processData: false,
                                                success: function(data) {
                                                    ce__box.innerHTML = `
                                                    <div class="flex flex-col flex-align-c flex-justify-con-c">
                                                        <svg class="wizard_input_loading" xmlns="http://www.w3.org/2000/svg" width="128" height="128" viewBox="0 0 24 24" fill="none"><path d="M12.6 7C12 7 11.6 6.6 11.6 6V3C11.6 2.4 12 2 12.6 2C13.2 2 13.6 2.4 13.6 3V6C13.6 6.6 13.2 7 12.6 7ZM10 7.59998C10.5 7.29998 10.6 6.69995 10.4 6.19995L9 3.80005C8.7 3.30005 8.10001 3.20002 7.60001 3.40002C7.10001 3.70002 7.00001 4.30005 7.20001 4.80005L8.60001 7.19995C8.80001 7.49995 9.1 7.69995 9.5 7.69995C9.7 7.69995 9.9 7.69998 10 7.59998ZM8 9.30005C8.3 8.80005 8.10001 8.20002 7.60001 7.90002L5.5 6.69995C5 6.39995 4.40001 6.59998 4.10001 7.09998C3.80001 7.59998 4 8.2 4.5 8.5L6.60001 9.69995C6.80001 9.79995 6.90001 9.80005 7.10001 9.80005C7.50001 9.80005 7.9 9.70005 8 9.30005ZM7.20001 12C7.20001 11.4 6.80001 11 6.20001 11H4C3.4 11 3 11.4 3 12C3 12.6 3.4 13 4 13H6.20001C6.70001 13 7.20001 12.6 7.20001 12Z" fill="#3699FF"/><path opacity="0.3" d="M17.4 5.5C17.4 6.1 17 6.5 16.4 6.5C15.8 6.5 15.4 6.1 15.4 5.5C15.4 4.9 15.8 4.5 16.4 4.5C17 4.5 17.4 5 17.4 5.5ZM5.80001 17.1L7.40001 16.1C7.90001 15.8 8.00001 15.2 7.80001 14.7C7.50001 14.2 6.90001 14.1 6.40001 14.3L4.80001 15.3C4.30001 15.6 4.20001 16.2 4.40001 16.7C4.60001 17 4.90001 17.2 5.30001 17.2C5.50001 17.3 5.60001 17.2 5.80001 17.1ZM8.40001 20.2C8.20001 20.2 8.10001 20.2 7.90001 20.1C7.40001 19.8 7.3 19.2 7.5 18.7L8.30001 17.3C8.60001 16.8 9.20002 16.7 9.70002 16.9C10.2 17.2 10.3 17.8 10.1 18.3L9.30001 19.7C9.10001 20 8.70001 20.2 8.40001 20.2ZM12.6 21.2C12 21.2 11.6 20.8 11.6 20.2V18.8C11.6 18.2 12 17.8 12.6 17.8C13.2 17.8 13.6 18.2 13.6 18.8V20.2C13.6 20.7 13.2 21.2 12.6 21.2ZM16.7 19.9C16.4 19.9 16 19.7 15.8 19.4L15.2 18.5C14.9 18 15.1 17.4 15.6 17.1C16.1 16.8 16.7 17 17 17.5L17.6 18.4C17.9 18.9 17.7 19.5 17.2 19.8C17 19.9 16.8 19.9 16.7 19.9ZM19.4 17C19.2 17 19.1 17 18.9 16.9L18.2 16.5C17.7 16.2 17.6 15.6 17.8 15.1C18.1 14.6 18.7 14.5 19.2 14.7L19.9 15.1C20.4 15.4 20.5 16 20.3 16.5C20.1 16.8 19.8 17 19.4 17ZM20.4 13H19.9C19.3 13 18.9 12.6 18.9 12C18.9 11.4 19.3 11 19.9 11H20.4C21 11 21.4 11.4 21.4 12C21.4 12.6 20.9 13 20.4 13ZM18.9 9.30005C18.6 9.30005 18.2 9.10005 18 8.80005C17.7 8.30005 17.9 7.70002 18.4 7.40002L18.6 7.30005C19.1 7.00005 19.7 7.19995 20 7.69995C20.3 8.19995 20.1 8.79998 19.6 9.09998L19.4 9.19995C19.3 9.19995 19.1 9.30005 18.9 9.30005Z" fill="#3699FF"/></svg>
                                                        <span class="bold text-primary-light small"><?= $gname; ?> felfüggesztve</span>
                                                    </div><br>
                                                    <div class="flex flex-row flex-align-c flex-justify-con-c w-100">
                                                        <span class="text-secondary" style="font-size: .70rem !important;"">Kijelentkeztetés....</span>
                                                    </div>
                                                    `;
                                                    setTimeout(() => {
                                                        $.ajax({ enctype: "multipart/form-data", type: "POST", url: "/actions/ajax__logout.php", dataType: 'json', contentType: false, processData: false,
                                                            success: function(data) { window.location.href="/"; }
                                                        });
                                                    }, 1000);
                                                },
                                                error: function (data) { ce__box.innerHTML = `<div class="flex flex-col flex-align-c flex-justify-con-c"><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="8rem" height="8rem" viewBox="0 0 24 24" version="1.1"><g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"><rect x="0" y="0" width="24" height="24"/><circle fill="#F64E60" opacity="0.3" cx="12" cy="12" r="10"/><path d="M12.0355339,10.6213203 L14.863961,7.79289322 C15.2544853,7.40236893 15.8876503,7.40236893 16.2781746,7.79289322 C16.6686989,8.18341751 16.6686989,8.81658249 16.2781746,9.20710678 L13.4497475,12.0355339 L16.2781746,14.863961 C16.6686989,15.2544853 16.6686989,15.8876503 16.2781746,16.2781746 C15.8876503,16.6686989 15.2544853,16.6686989 14.863961,16.2781746 L12.0355339,13.4497475 L9.20710678,16.2781746 C8.81658249,16.6686989 8.18341751,16.6686989 7.79289322,16.2781746 C7.40236893,15.8876503 7.40236893,15.2544853 7.79289322,14.863961 L10.6213203,12.0355339 L7.79289322,9.20710678 C7.40236893,8.81658249 7.40236893,8.18341751 7.79289322,7.79289322 C8.18341751,7.40236893 8.81658249,7.40236893 9.20710678,7.79289322 L12.0355339,10.6213203 Z" fill="#F64E60"/></g></svg><span class="bold text-danger small">Hiba történt a művelet közben!</span></div><br><span class="w-fa text-align-c text-primary link pointer user-select-none" style="font-size: .80rem !important;" onclick="window.location.reload(true);">Próbálja újra</span></div>`; }
                                            });
                                            } else { document.getElementById("deactpe__ind").textContent = "Hibás jelszót adott meg."; document.getElementById("chpr__cpassword").value = ""; document.getElementById("sbmt__cncl").classList.add("danger-bg-disabled");document.getElementById("sbmt__cncl").classList.add("not-allowed");document.getElementById("sbmt__cncl").classList.remove("danger-bg");document.getElementById("sbmt__cncl").classList.remove("danger-bg-hover");document.getElementById("sbmt__cncl").classList.remove("pointer"); }
                                        }
                                    });
                                }
                            });
                        } else { $('#sbmt__cncl').off('click'); document.getElementById("sbmt__cncl").classList.add("danger-bg-disabled");document.getElementById("sbmt__cncl").classList.add("not-allowed");document.getElementById("sbmt__cncl").classList.remove("danger-bg");document.getElementById("sbmt__cncl").classList.remove("danger-bg-hover");document.getElementById("sbmt__cncl").classList.remove("pointer"); }
                    });
                    $("#cl__ebox").click(() => { ce__box.classList.replace("popup", "popout"); ce__wrapper.classList.add("fadeout"); setTimeout(() => {ce__wrapper.remove();},235); });
                });
                $("#pf__delete").click(() => { ce__wrapper.classList.remove('fadeout');
                    ce__box.classList = "d__confirm de__confirm popup fixed flex flex-col border-soft item-bg box-shadow padding-1 padding-t-0"; c__wrapper.append(ce__wrapper); ce__wrapper.append(ce__box); $('html').css("overflow-y", "hidden");
                    ce__box.innerHTML = `
                    <div class="flex flex-row flex-align-c flex-justify-con-sb padding-t-1" id="cbh__incon">
                        <span class="text-primary bold" id="prs__title">Eltávolítás</span>
                        <div class="flex flex-row flex-align-c gap-05"><span class="flex" id="prsb__con"></span><span class="text-primary pointer" id="cl__ebox" aria-label="Mégsem"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"><rect opacity="0.3" x="2" y="2" width="20" height="20" rx="5" fill="currentColor"/><rect x="7" y="15.3137" width="12" height="2" rx="1" transform="rotate(-45 7 15.3137)" fill="currentColor"/><rect x="8.41422" y="7" width="12" height="2" rx="1" transform="rotate(45 8.41422 7)" fill="currentColor"/></svg></span></div>
                    </div><br>
                    <div class="flex flex-col gap-1 feat__body prs__con">
                        <div class="flex flex-row flex-align-c flex-justify-con-c w-fa">
                            <span class="text-secondary text-align-c" style="font-size: .75rem !important;">Fiókját újra aktiválhatja, ha ismét bejelentkezik fiókjába. 30 nap elteltével nem tudja többet aktiválni fiókját, és minden adat elveszik.</span>
                        </div>
                        <div class="flex flex-col flex-align-c w-fa col-05">
                            <span class="text-primary prst__trig w-fa" style="font-size: .80rem !important;">Adja meg jelszavát</span>
                            <input type="password" class="flex w-fa text-primary border-soft background-bg padding-1-05 outline-none border-none" style="font-size: .75rem !important;" name="chpr__cpassword" id="chpr__cpassword" placeholder="Jelenlegi jelszó" autocomplete='password' />
                            <span class="flex flex-row flex-align-fe flex-justify-con-fe w-fa text-danger" id="deactpe__ind" style="font-size: .75rem !important;"></span>
                        </div>
                        <div class="flex flex-row-d-col-m flex-align-c flex-justify-con-sb border-soft border-primary-light-dotted primary-bg padding-1">
                            <div class="flex flex-row-d-col-m flex-align-c gap-1">
                                <div class="flex flex-row flex-align-c gap-1">
                                    <div class="flex flex-col flex-align-c flex-justify-con-fs">
                                        <span class="bold w-100" style="font-size: .9rem !important;">Adatai biztonságának megőrzése</span>
                                        <span class="text-secondary" style="font-size: .75rem !important;">Semmi sem fontosabb számunkra, mint a felhasználóink biztonsága. Ön kényes információkat oszt meg velünk, amit nagy becsben tartunk, így soha nem fogunk kompromisszumot kötni adatai védelmében.</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div><br>
                    <div class="flex flex-row flex-align-fe flex-justify-con-fe">
                        <span class="danger-bg-disabled padding-05 border-soft not-allowed user-select-none smaller-light" id="sbmt__rmv">Eltávolítás</span>
                    </div>
                    `;
                    var con = document.getElementById('cbh__incon');var mc = new Hammer(con);mc.get('pan').set({ direction: Hammer.DIRECTION_ALL });mc.on("pandown", function(ev) { $('#cl__ebox').click(); });
                    $("#cl__ebox").click(() => { ce__box.classList.replace("popup", "popout"); ce__wrapper.classList.add("fadeout"); setTimeout(() => {ce__wrapper.remove();},235); });
                });
                $("#cl__box").click(() => { c__box.classList.replace("popup", "popout"); c__wrapper.classList.add("fadeout"); setTimeout(() => {c__wrapper.remove();},235); });
            });
        } else {
            $('#cncl__account').off('click');
            document.getElementById('cncl__account').classList.replace('danger-bg', 'danger-bg-disabled');
            document.getElementById('cncl__account').classList.replace('pointer', 'not-allowed');
        }
    });
</script>