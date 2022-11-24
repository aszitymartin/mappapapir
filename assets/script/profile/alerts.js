var c__wrapper = document.createElement('div'); c__wrapper.classList = "wrapper_dark"; var c__box = document.createElement('div'); c__box.id = "chc__con"; c__box.classList = "d__confirm fixed flex flex-col border-soft item-bg box-shadow padding-1";
function cls__alert (a__item) { var al__fd = new FormData(); al__fd.append("alert", a__item); $.ajax({ enctype: "multipart/form-data", type: "POST", url: "/assets/php/profile/cookies.php", data: al__fd , dataType: 'json', contentType: false, processData: false, success: function(data) { document.querySelector("[alert-id="+a__item+"]").remove(); } }); }
var cho__err = document.createElement("div"); cho__err.classList = "text-danger smaller-med text-align-r"; cho__err.id = "cho__err"; cho__err.textContent = "A megadott email-cím érvénytelen!";
var chn__err = document.createElement("div"); chn__err.classList = "text-danger smaller-med w-100 text-align-r"; chn__err.id = "chn__err"; chn__err.textContent = "A megadott email-cím érvénytelen!";
var chc__err = document.createElement("div"); chc__err.classList = "text-danger smaller-med w-100 text-align-r"; chc__err.id = "chc__err"; chc__err.textContent = "Érvénytelen jelszó!";
if (document.getElementById("ch__email")) {
    document.getElementById("ch__email").addEventListener("click", function() { document.body.append(c__wrapper); c__wrapper.append(c__box); disableScroll();
        c__box.innerHTML = `
            <div class="flex flex-row flex-align-c flex-justify-con-sb">
                <span class="text-primary bold">Email-cím megváltoztatása</span>
                <span class="button button-secondary small-med" id="cl__box">Mégsem</span>
            </div><br>
            <span class="text-secondary text-align-c smaller-med"><b>Figyelem!</b> Az email-címének megváltoztatásával nem lesz újból jogosult a hírlevelünkre való feliratkozásért járó akciónkra, ha már egyszer igénybe vette másik email címmel ezen a fiókon.</span><br>
            <div class="flex flex-col flex-align-c flex-justify-con-c gap-1">
                <div class="flex flex-col flex-align-c flex-justify-con-c gap-05 w-50d-100m">
                    <label class="w-100 text-secondary small">Jelenlegi e-mail cím</label>
                    <input type="email" class="wizard_input border-soft border-primary" id="cho__email" name="cho__email" placeholder="mintamisi@email.com" required>
                </div>
                <div class="flex flex-col flex-align-c flex-justify-con-c gap-05 w-50d-100m">
                    <label class="w-100 text-secondary small">Új e-mail cím</label>
                    <input type="email" class="wizard_input border-soft border-primary" id="chn__email" name="chn__email" placeholder="mintamisi@email.com" required>
                </div>
            </div><br>
            <div class="flex flex-col flex-align-c flex-justify-con-c gap-05" id="chb__news"></div><br>
            <div class="flex flex-row flex-align-fe flex-justify-con-fe">
                <span class="button button-primary small-med" id="gn__email">Megváltoztatás</span>
            </div>
        `;
        $.ajax({ enctype: "multipart/form-data", type: "POST", url: "/assets/php/profile/che__subs.php", dataType: 'json', contentType: false, processData: false,
            success: function(data) { 
                if (data !== 30) { document.getElementById("chb__news").innerHTML = `<div class="flex flex-row flex-align-c"><label class='text-secondary smaller-med user-select-none'>Ön jelenleg fel van iratkozva hírlevelünkre a(z) <b>${data.email}</b> email-címmel. Hírlevelünkről való leiratkozását <a id="unsub__mail" class="link bold pointer">ide kattintva teheti meg</a>.</label></div>`;
                    var uns__box = document.createElement('div'); uns__box.classList = "d__confirm fixed flex flex-col border-soft border-primary item-bg box-shadow padding-1";
                    $('#unsub__mail').click(function () { c__wrapper.append(uns__box); disableScroll(); document.getElementById("chc__con").classList += " blured-ex opacity-05";
                        uns__box.innerHTML = `
                            <div class="flex flex-row flex-align-c">
                                <span class="text-primary bold">Leiratkozás a hírlevélről</span>
                            </div><br>
                            <div class="flex flex-col">
                                <span class="text-secondary small">Mielőtt leiratkozna, olvassa el az alábbi információkat a leiratkozás következményeiről.</span>
                                <ul class="flex flex-col gap-05 text-secondary r__list">
                                    <li>A leiratkozás után <b>nem kapja meg</b> a heti híreket, de bármikor újra feliratkozhat.</li>
                                    <li>A leiratkozás után <b>nem veheti többet igénybe különleges akciónkat</b> erről a fiókról, amely 2 000 Ft kedvezményt biztosított Önnek.</li>
                                </ul>
                                <div id="uns__err"></div>
                                <span class="flex flex-row flex-align-c gap-05">
                                    <input type="checkbox" name="uns__conf" id="uns__conf" />
                                    <label class="text-secondary small-med user-select-none" id="uns__conf__lbl" for="uns__conf">Elolvastam a következményeket, és beleegyeztem, hogy többé nem használhatom ezt a promóciót.</label>
                                </span>
                            </div><br>
                            <div class="flex flex-row flex-align-c flex-justify-con-sb"><span class="button button-secondary small-med" id="clun__box">Mégsem</span><span class="button button-disabled small-med" id="co__box">Leiratkozás</span></div>
                        `;
                        $('#clun__box').click(function () { uns__box.remove(); document.getElementById("chc__con").classList.remove("opacity-05"); document.getElementById("chc__con").classList.remove("blured-ex"); });
                        $('#co__box').click(function () {
                            if ($('#uns__conf').is(':checked')) { var uns__data = new FormData(); uns__data.append("e__action", "1");
                                $.ajax({ enctype: "multipart/form-data", type: "POST", url: "/assets/php/sub/email.php", data: uns__data, dataType: 'json', contentType: false, processData: false,
                                    success: function(data) { uns__box.remove(); document.getElementById("chc__con").classList.remove("opacity-05"); document.getElementById("chc__con").classList.remove("blured-ex");
                                        document.getElementById("chb__news").innerHTML = `<div class="flex flex-row flex-align-c"><input type="checkbox" class="wizard_input_checkbox" name="che__subnews" id="che__subnews" /><label for='che__subnews' class='text-secondary smaller-med user-select-none'>Iratkozzon fel hírlevelünkre az új email-címével.</label></div>`;
                                    },
                                    error: function(data) { document.getElementById('uns__err').innerHTML = `<div class="flex flex-row flex-align-c flex-justify-con-sb alert alert-danger padding-05 border-soft small-med"><span class="flex flex-row flex-align-c gap-05"><span class="flex"><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="18px" height="18px" viewBox="0 0 24 24" version="1.1"><g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"><rect x="0" y="0" width="24" height="24"/><path d="M11.1669899,4.49941818 L2.82535718,19.5143571 C2.557144,19.9971408 2.7310878,20.6059441 3.21387153,20.8741573 C3.36242953,20.9566895 3.52957021,21 3.69951446,21 L21.2169432,21 C21.7692279,21 22.2169432,20.5522847 22.2169432,20 C22.2169432,19.8159952 22.1661743,19.6355579 22.070225,19.47855 L12.894429,4.4636111 C12.6064401,3.99235656 11.9909517,3.84379039 11.5196972,4.13177928 C11.3723594,4.22181902 11.2508468,4.34847583 11.1669899,4.49941818 Z" fill="#ce3746" opacity="0.3"/><rect fill="#ce3746" x="11" y="9" width="2" height="7" rx="1"/><rect fill="#ce3746" x="11" y="17" width="2" height="2" rx="1"/></g></svg></span><span class="flex text-danger">Hiba történt, próbálja újra később.</span></span><span class="flex flex-align-c pointer" id="cls__err">`+i__cls+`</span></div>`; $('#cls__err').click(() => { document.getElementById('uns__err').innerHTML = ``; });}
                                });
                            } else { $('#uns__conf__lbl').css('color', '#ce3746'); }
                        });
                        $('#uns__conf').click(() => { if ($('#uns__conf').is(':checked')) { $('#uns__conf__lbl').css('color', 'var(--secondary-light-color)'); document.getElementById('co__box').classList.replace('button-disabled', 'button-primary'); }
                            else { document.getElementById('co__box').classList.replace('button-primary', 'button-disabled'); }
                        });
                    });
                } else { document.getElementById("chb__news").innerHTML = `<div class="flex flex-row flex-align-c"><input type="checkbox" class="wizard_input_checkbox" name="che__subnews" id="che__subnews" /><label for='che__subnews' class='text-secondary smaller-med user-select-none'>Iratkozzon fel hírlevelünkre az új email-címével.</label></div>`; }
            }, error: function (data) { console.log(data); }
        });
        $('#cl__box').click(function () { c__wrapper.remove(); enableScroll(); });
        $('#gn__email').click(function () { if (document.getElementById("che__subnews")) { var subnews = document.getElementById("che__subnews").checked ? true : false; } var chn,cho,chs = false;
            if (!$('input[name="cho__email"]')[0].value.match(/^([a-z\d!#$%&'*+\-\/=?^_`{|}~\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]+(\.[a-z\d!#$%&'*+\-\/=?^_`{|}~\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]+)*|"((([ \t]*\r\n)?[ \t]+)?([\x01-\x08\x0b\x0c\x0e-\x1f\x7f\x21\x23-\x5b\x5d-\x7e\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]|\\[\x01-\x09\x0b\x0c\x0d-\x7f\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]))*(([ \t]*\r\n)?[ \t]+)?")@(([a-z\d\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]|[a-z\d\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF][a-z\d\-._~\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]*[a-z\d\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])\.)+([a-z\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]|[a-z\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF][a-z\d\-._~\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]*[a-z\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])\.?$/i) || $('input[name="cho__email"]')[0].value.length < 1) {
                if (!document.getElementById("cho__email").parentNode.contains(cho__err)) { document.getElementById("cho__email").parentNode.append(cho__err); } chn = false;
            } else { if (document.getElementById("cho__err")) {document.getElementById("cho__err").remove();} chn = true; }
            if (!$('input[name="chn__email"]')[0].value.match(/^([a-z\d!#$%&'*+\-\/=?^_`{|}~\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]+(\.[a-z\d!#$%&'*+\-\/=?^_`{|}~\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]+)*|"((([ \t]*\r\n)?[ \t]+)?([\x01-\x08\x0b\x0c\x0e-\x1f\x7f\x21\x23-\x5b\x5d-\x7e\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]|\\[\x01-\x09\x0b\x0c\x0d-\x7f\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]))*(([ \t]*\r\n)?[ \t]+)?")@(([a-z\d\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]|[a-z\d\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF][a-z\d\-._~\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]*[a-z\d\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])\.)+([a-z\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]|[a-z\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF][a-z\d\-._~\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]*[a-z\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])\.?$/i) || $('input[name="chn__email"]')[0].value.length < 1) {
                if (!document.getElementById("chn__email").parentNode.contains(chn__err)) { document.getElementById("chn__email").parentNode.append(chn__err); cho = false; }
            } else { if (document.getElementById("chn__err")) {document.getElementById("chn__err").remove();} cho = true; }
            if ($('input[name="cho__email"]')[0].value === $('input[name="chn__email"]')[0].value) {
                if (!document.getElementById("chn__email").parentNode.contains(chn__err)) { chn__err.textContent =  "A megadott email-címek nem egyezhetnek!"; document.getElementById("chn__email").parentNode.append(chn__err); } chs = false;
            } else { if (document.getElementById("chn__err")) { document.getElementById("chn__err").remove(); } chs = true; }
            if (chn && cho && chs) { var ch__data = new FormData(); ch__data.append("email", document.getElementById("cho__email").value);
                $.ajax({ enctype: "multipart/form-data", type: "POST", url: "/assets/php/profile/get__email.php", data: ch__data, dataType: 'json', contentType: false, processData: false,
                    success: function(data) {
                        if (data === 410) { if (!document.getElementById("cho__email").parentNode.contains(cho__err)) { cho__err.textContent =  "A megadott email cím nem az Ön fiókjához tartozik."; document.getElementById("cho__email").parentNode.append(cho__err); } }
                        if (data === 200) { var chn__data = new FormData(); chn__data.append("email", document.getElementById("chn__email").value); chn__data.append("original", document.getElementById("cho__email").value); 
                            if (subnews == true) { chn__data.append("subscribe", subnews); }
                            $.ajax({ enctype: "multipart/form-data", type: "POST", url: "/assets/php/profile/update__email.php", data: chn__data, dataType: 'json', contentType: false, processData: false,
                                success: function(data) { c__wrapper.remove(); enableScroll(); notificationSystem(0, 0, 0, 'Email-cím!', 'Sikeresen frissítette email-címét.'); }, 
                                error: function (data) { notificationSystem(0, 1, 0, 'Email-cím!', 'Sikertelen művelet.'); }
                            });         
                        }
                    }, error: function (data) { if (!document.getElementById("chn__email").parentNode.contains(chn__err)) { chn__err.textContent =  "Hiba történt, próbálja meg később!"; document.getElementById("chn__email").parentNode.append(chn__err); } }
                });
            }
        });
    });
}

if (document.getElementById("ch__password")) {
    document.getElementById("ch__password").addEventListener("click", function() { document.body.append(c__wrapper); c__wrapper.append(c__box); disableScroll();
        c__box.innerHTML = `
            <div class="flex flex-row flex-align-c flex-justify-con-sb">
                <span class="text-primary bold">Jelszó módosítása</span>
                <span class="button button-secondary small-med" id="clp__box">Mégsem</span>
            </div><br>
            <span class="text-secondary text-align-c smaller-med">Az erős, és biztonságos jelszóhoz szükséges <b>minimum 8</b> karakter, <b>legalább 1</b> szám, <b>minimum egy <span class="uppercase">nagy betű</span></b>, valamint egy <b>szimbólum</b> is. Ezen karakterek felhasználásával jelszava közel feltörhetetlen lesz, így megőrizve fiókja, valamint adatainak biztonságát is.</span><br>
            <div class="flex flex-col flex-align-c flex-justify-con-c gap-1">
                <div class="flex flex-col flex-align-c flex-justify-con-c gap-05 w-50d-100m">
                    <label class="w-100 text-secondary small">Jelenlegi jelszó</label>
                    <input type="password" class="wizard_input border-soft border-primary" id="cho__password" name="cho__password" placeholder="Jelenlegi jelszava" required>
                    <div class="flex flex-row flex-align-c flex-justify-con-sb w-100" id="chop__ind">
                        <span class="text-primary link pointer user-select-none" style="font-size: .75rem !important;">Elfelejtett jelszó?</span>
                    </div>
                </div>
                <div class="flex flex-col flex-align-c flex-justify-con-c gap-05 w-50d-100m">
                    <label class="w-100 text-secondary small">Új jelszó</label>
                    <input type="password" class="wizard_input border-soft border-primary" id="chn__password" name="chn__password" placeholder="Új jelszó" required>
                </div>
                <div class="flex flex-col flex-align-c flex-justify-con-c gap-05 w-50d-100m">
                    <label class="w-100 text-secondary small">Jelszó megerősítése</label>
                    <input type="password" class="wizard_input border-soft border-primary" id="chnc__password" name="chnc__password" placeholder="Jelszó megismétlése" required>
                </div>
            </div><br>
            <div class="flex flex-row flex-align-fe flex-justify-con-fe">
                <span class="button button-primary small-med" id="gn__password">Megváltoztatás</span>
            </div>
        `;
        $('#clp__box').click(function () { c__wrapper.remove(); enableScroll(); });
        $("#gn__password").click(function () { var chop,chnp,chnpc = false;
            if (!$("#cho__password").val().match(/^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*[!@#=\$%\^&\*])(?=.{8,})/) && $('#cho__password').val().length < 8) { chop = false; cho__err.textContent = "Érvénytelen jelszó.";
                if (!document.getElementById("chop__ind").contains(cho__err)) { document.getElementById("chop__ind").append(cho__err); }
            } else { if (document.getElementById("cho__err")) {document.getElementById("cho__err").remove();} chop = true; }
            if (!$("#chn__password").val().match(/^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*[!@#=\$%\^&\*])(?=.{8,})/) && $('#chn__password').val().length < 8) { chnp = false; chn__err.textContent = "Érvénytelen jelszó.";
                if (!document.getElementById("chn__password").parentNode.contains(chn__err)) { document.getElementById("chn__password").parentNode.append(chn__err); }
            } else { if (document.getElementById("chn__err")) {document.getElementById("chn__err").remove();} chnp = true; }
            if (!$("#chnc__password").val().match(/^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*[!@#=\$%\^&\*])(?=.{8,})/) && $('#chnc__password').val().length < 8) { chnpc = false; chc__err.textContent = "Érvénytelen jelszó.";
                if (!document.getElementById("chnc__password").parentNode.contains(chc__err)) { document.getElementById("chnc__password").parentNode.append(chc__err); }
            } else { if (document.getElementById("chc__err")) {document.getElementById("chc__err").remove();} chnpc = true; }
            if (chop && chnp && chnpc) { var chp__data = new FormData(); chp__data.append("password", document.getElementById("cho__password").value);
                if ($("#chn__password").val() === $("#chnc__password").val()) {
                    if ($("#chn__password").val() !== $("#cho__password").val() && $("#chnc__password").val() !== $("#cho__password").val()) {
                        $.ajax({ enctype: "multipart/form-data", type: "POST", url: "/assets/php/profile/get__password.php", data: chp__data, dataType: 'json', contentType: false, processData: false,
                            success: function(data) {
                                if (data === 410) { cho__err.textContent = "A megadott jelszó helytelen."; if (!document.getElementById("chop__ind").contains(cho__err)) { document.getElementById("chop__ind").append(cho__err); } }
                                if (data === 200) { var chp__data = new FormData(); chp__data.append("password", document.getElementById("chn__password").value); chp__data.append("confirm", document.getElementById("chnc__password").value); chp__data.append("original", document.getElementById("cho__password").value);
                                    $.ajax({ enctype: "multipart/form-data", type: "POST", url: "/assets/php/profile/update__password.php", data: chp__data, dataType: 'json', contentType: false, processData: false,
                                        beforeSend: function () { document.getElementById("gn__password").textContent = "Változtatás..";  },
                                        success: function(data) { document.getElementById("gn__password").textContent = "Megváltoztatva";  document.getElementById("gn__password").id = "";
                                            c__wrapper.remove(); enableScroll(); notificationSystem(0, 0, 0, 'Jelszó!', 'Sikeresen frissítette jelszavát.'); document.getElementById("pw__notif").remove();
                                        }, error: function (data) { if (!document.getElementById("chnc__password").parentNode.contains(chc__err)) { chc__err.textContent =  "Hiba történt, próbálja meg később!"; document.getElementById("chnc__password").parentNode.append(chc__err); } }
                                    });
                                }
                            }, error: function (data) { if (!document.getElementById("chnc__password").parentNode.contains(chc__err)) { chc__err.textContent =  "Hiba történt, próbálja meg később!"; document.getElementById("chnc__password").parentNode.append(chc__err); } }
                        });
                    } else { chc__err.textContent = "Nem használhatja a jelenlegi jelszavát."; if (!document.getElementById("chnc__password").parentNode.contains(chc__err)) { document.getElementById("chnc__password").parentNode.append(chc__err); } }
                } else { chc__err.textContent = "A jelszavak nem egyeznek."; if (!document.getElementById("chnc__password").parentNode.contains(chc__err)) { document.getElementById("chnc__password").parentNode.append(chc__err); } }
            }
        });
    });
}