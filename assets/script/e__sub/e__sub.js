var i__cls = `<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="18px" height="18px" viewBox="0 0 24 24" version="1.1"><g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"><rect x="0" y="0" width="24" height="24"/><circle fill="#ce3746" opacity="0.3" cx="12" cy="12" r="10"/><path d="M12.0355339,10.6213203 L14.863961,7.79289322 C15.2544853,7.40236893 15.8876503,7.40236893 16.2781746,7.79289322 C16.6686989,8.18341751 16.6686989,8.81658249 16.2781746,9.20710678 L13.4497475,12.0355339 L16.2781746,14.863961 C16.6686989,15.2544853 16.6686989,15.8876503 16.2781746,16.2781746 C15.8876503,16.6686989 15.2544853,16.6686989 14.863961,16.2781746 L12.0355339,13.4497475 L9.20710678,16.2781746 C8.81658249,16.6686989 8.18341751,16.6686989 7.79289322,16.2781746 C7.40236893,15.8876503 7.40236893,15.2544853 7.79289322,14.863961 L10.6213203,12.0355339 L7.79289322,9.20710678 C7.40236893,8.81658249 7.40236893,8.18341751 7.79289322,7.79289322 C8.18341751,7.40236893 8.81658249,7.40236893 9.20710678,7.79289322 L12.0355339,10.6213203 Z" fill="#ce3746"/></g></svg>`;
$('#sub__act').click(function () { var sub__error = document.createElement('div'); sub__error.classList = 'flex flex-row flex-align-c flex-justify-con-sb border-soft alert-danger small-med '; sub__error.style.padding = '.25rem'; var sub__succ = document.createElement('div'); sub__succ.classList = 'flex flex-row flex-align-c flex-justify-con-sb border-soft alert-success small-med '; sub__succ.style.padding = '.25rem';
    if ($('#sub__mail').val().length > 0 && $('#sub__mail').val().match(/^\w+@[a-zA-Z_]+?\.[a-zA-Z]{2,3}$/)) { var mail = $('#sub__mail').val(); var em__data = new FormData(); em__data.append('email', mail); em__data.append('e__action', '0');
        $.ajax({
            enctype: "multipart/form-data", type: "POST", url: "/assets/php/sub/email.php", data: em__data, dataType: 'json', contentType: false, processData: false,
            success: function(data) {
                if (data === 200) {
                    document.getElementById('su__con').innerHTML = `
                    <div class="border-soft" id="su__con">
                        <div class="absolute glass su__gls flex flex-col border-soft padding-1">
                            <h3 margin-bottom: 0; padding-bottom: 0;">Köszönjük, hogy feliratkozott hírlevelünkre</h3>
                            <div class="flex flex-col gap-05">
                                <span class="small">Hírleveleinket minden hétvégén megkapja. Néhány e-mailt a többi napon küldünk, az egyéb feliratkozásaitól függően.</span>
                                <span class="small-med">*A feliratkozásait <a class="bold link pointer" id="ch__subs">ide kattintva</a> kezelheti, vagy a beállítások menüben módosíthatja.</span>
                                <span id="eb__info"></span>
                            </div><br>
                            <div class="flex flex-col">
                                <span class="small-med" >Ön feliratkozott hírlevelünkre a(z) <b>${mail}</b> címen. Amennyiben le szeretne iratkozni, <a class="bold link pointer" id="unsub__mail">ide kattintva megteheti</a>.</span>
                                <span class="small-med user-select-none">**<span class="link pointer underline" id="su__lm">Tudjon meg többet</span> a promóció felhasználásáról</span>
                            </div>
                        </div>
                    </div>
                    `;
                    $.ajax({ enctype: "multipart/form-data", type: "POST", url: "/assets/php/sub/c__eligible.php", dataType: 'json', contentType: false, processData: false,
                        success: function(data) { if (data === 0) { document.getElementById('eb__info').innerHTML = `<span class="small"><b>Figyelem!</b> Úgy tűnik, feliratkozott hírlevelünkre, de még nem vette igénybe akciónkat. Nézzen körül webáruházunkban, hátha talál valamit, és fel tudja használni ezt az akciót.</span>`; } }
                    });
                }if (data === 406) { sub__error.innerHTML = `<span class="flex flex-row flex-align-c gap-05"><span class="flex"><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="18px" height="18px" viewBox="0 0 24 24" version="1.1"><g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"><rect x="0" y="0" width="24" height="24"/><path d="M11.1669899,4.49941818 L2.82535718,19.5143571 C2.557144,19.9971408 2.7310878,20.6059441 3.21387153,20.8741573 C3.36242953,20.9566895 3.52957021,21 3.69951446,21 L21.2169432,21 C21.7692279,21 22.2169432,20.5522847 22.2169432,20 C22.2169432,19.8159952 22.1661743,19.6355579 22.070225,19.47855 L12.894429,4.4636111 C12.6064401,3.99235656 11.9909517,3.84379039 11.5196972,4.13177928 C11.3723594,4.22181902 11.2508468,4.34847583 11.1669899,4.49941818 Z" fill="#ce3746" opacity="0.3"/><rect fill="#ce3746" x="11" y="9" width="2" height="7" rx="1"/><rect fill="#ce3746" x="11" y="17" width="2" height="2" rx="1"/></g></svg></span><span class="flex text-danger">Ezzel a fiókkal már feliratkozott hírlevelünkre</span></span><span class="flex flex-align-c pointer" id="cls__err">`+i__cls+`</span>`; document.getElementById('sub__mail').parentElement.parentElement.append(sub__error); $('#cls__err').click(() => { sub__error.remove(); $('#sub__mail').focus(); }); }
                if (data === 30) { sub__error.innerHTML = `<span class="flex flex-row flex-align-c gap-05"><span class="flex"><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="18px" height="18px" viewBox="0 0 24 24" version="1.1"><g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"><rect x="0" y="0" width="24" height="24"/><path d="M11.1669899,4.49941818 L2.82535718,19.5143571 C2.557144,19.9971408 2.7310878,20.6059441 3.21387153,20.8741573 C3.36242953,20.9566895 3.52957021,21 3.69951446,21 L21.2169432,21 C21.7692279,21 22.2169432,20.5522847 22.2169432,20 C22.2169432,19.8159952 22.1661743,19.6355579 22.070225,19.47855 L12.894429,4.4636111 C12.6064401,3.99235656 11.9909517,3.84379039 11.5196972,4.13177928 C11.3723594,4.22181902 11.2508468,4.34847583 11.1669899,4.49941818 Z" fill="#ce3746" opacity="0.3"/><rect fill="#ce3746" x="11" y="9" width="2" height="7" rx="1"/><rect fill="#ce3746" x="11" y="17" width="2" height="2" rx="1"/></g></svg></span><span class="flex text-danger">Ez az e-mail cím már foglalt</span></span><span class="flex flex-align-c pointer" id="cls__err">`+i__cls+`</span>`;document.getElementById('sub__mail').parentElement.parentElement.append(sub__error); $('#cls__err').click(() => { sub__error.remove(); $('#sub__mail').focus(); }); }
                if (data === 43) { sub__error.innerHTML = `<span class="flex flex-row flex-align-c gap-05"><span class="flex"><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="18px" height="18px" viewBox="0 0 24 24" version="1.1"><g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"><rect x="0" y="0" width="24" height="24"/><path d="M11.1669899,4.49941818 L2.82535718,19.5143571 C2.557144,19.9971408 2.7310878,20.6059441 3.21387153,20.8741573 C3.36242953,20.9566895 3.52957021,21 3.69951446,21 L21.2169432,21 C21.7692279,21 22.2169432,20.5522847 22.2169432,20 C22.2169432,19.8159952 22.1661743,19.6355579 22.070225,19.47855 L12.894429,4.4636111 C12.6064401,3.99235656 11.9909517,3.84379039 11.5196972,4.13177928 C11.3723594,4.22181902 11.2508468,4.34847583 11.1669899,4.49941818 Z" fill="#ce3746" opacity="0.3"/><rect fill="#ce3746" x="11" y="9" width="2" height="7" rx="1"/><rect fill="#ce3746" x="11" y="17" width="2" height="2" rx="1"/></g></svg></span><span class="flex text-danger">A feliratkozáshoz be kell jelentkeznie</span></span><span class="flex flex-align-c pointer" id="cls__err">`+i__cls+`</span>`;document.getElementById('sub__mail').parentElement.parentElement.append(sub__error); $('#cls__err').click(() => { sub__error.remove(); $('#sub__mail').focus(); }); }
                if (data === 400) { sub__error.innerHTML = `<span class="flex flex-row flex-align-c gap-05"><span class="flex"><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="18px" height="18px" viewBox="0 0 24 24" version="1.1"><g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"><rect x="0" y="0" width="24" height="24"/><path d="M11.1669899,4.49941818 L2.82535718,19.5143571 C2.557144,19.9971408 2.7310878,20.6059441 3.21387153,20.8741573 C3.36242953,20.9566895 3.52957021,21 3.69951446,21 L21.2169432,21 C21.7692279,21 22.2169432,20.5522847 22.2169432,20 C22.2169432,19.8159952 22.1661743,19.6355579 22.070225,19.47855 L12.894429,4.4636111 C12.6064401,3.99235656 11.9909517,3.84379039 11.5196972,4.13177928 C11.3723594,4.22181902 11.2508468,4.34847583 11.1669899,4.49941818 Z" fill="#ce3746" opacity="0.3"/><rect fill="#ce3746" x="11" y="9" width="2" height="7" rx="1"/><rect fill="#ce3746" x="11" y="17" width="2" height="2" rx="1"/></g></svg></span><span class="flex text-danger">Kérés blokkolva</span></span><span class="flex flex-align-c pointer" id="cls__err">`+i__cls+`</span>`;document.getElementById('sub__mail').parentElement.parentElement.append(sub__error); $('#cls__err').click(() => { sub__error.remove(); $('#sub__mail').focus(); }); }
             }, error: function(data) { sub__error.innerHTML = `<span class="flex flex-row flex-align-c gap-05"><span class="flex"><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="18px" height="18px" viewBox="0 0 24 24" version="1.1"><g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"><rect x="0" y="0" width="24" height="24"/><path d="M11.1669899,4.49941818 L2.82535718,19.5143571 C2.557144,19.9971408 2.7310878,20.6059441 3.21387153,20.8741573 C3.36242953,20.9566895 3.52957021,21 3.69951446,21 L21.2169432,21 C21.7692279,21 22.2169432,20.5522847 22.2169432,20 C22.2169432,19.8159952 22.1661743,19.6355579 22.070225,19.47855 L12.894429,4.4636111 C12.6064401,3.99235656 11.9909517,3.84379039 11.5196972,4.13177928 C11.3723594,4.22181902 11.2508468,4.34847583 11.1669899,4.49941818 Z" fill="#ce3746" opacity="0.3"/><rect fill="#ce3746" x="11" y="9" width="2" height="7" rx="1"/><rect fill="#ce3746" x="11" y="17" width="2" height="2" rx="1"/></g></svg></span><span class="flex text-danger">Sikertelen művelet!</span></span><span class="flex flex-align-c pointer" id="cls__err">`+i__cls+`</span>`;document.getElementById('sub__mail').parentElement.parentElement.append(sub__error); $('#cls__err').click(() => { sub__error.remove(); $('#sub__mail').focus(); }); }
        });
    } else { sub__error.innerHTML = `<span class="flex flex-row flex-align-c gap-05"><span class="flex"><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="18px" height="18px" viewBox="0 0 24 24" version="1.1"><g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"><rect x="0" y="0" width="24" height="24"/><path d="M11.1669899,4.49941818 L2.82535718,19.5143571 C2.557144,19.9971408 2.7310878,20.6059441 3.21387153,20.8741573 C3.36242953,20.9566895 3.52957021,21 3.69951446,21 L21.2169432,21 C21.7692279,21 22.2169432,20.5522847 22.2169432,20 C22.2169432,19.8159952 22.1661743,19.6355579 22.070225,19.47855 L12.894429,4.4636111 C12.6064401,3.99235656 11.9909517,3.84379039 11.5196972,4.13177928 C11.3723594,4.22181902 11.2508468,4.34847583 11.1669899,4.49941818 Z" fill="#ce3746" opacity="0.3"/><rect fill="#ce3746" x="11" y="9" width="2" height="7" rx="1"/><rect fill="#ce3746" x="11" y="17" width="2" height="2" rx="1"/></g></svg></span><span class="flex text-danger">Érvénytelen e-mail cím</span></span><span class="flex flex-align-c pointer" id="cls__err">`+i__cls+`</span>`; document.getElementById('sub__mail').parentElement.parentElement.append(sub__error); $('#cls__err').click(() => { sub__error.remove(); $('#sub__mail').focus(); }); }
});
// Informacios panel az akcio felhasznalasaval kapcsolatban.
$('#su__lm').click(function () {
    var c__wrapper = document.createElement('div'); c__wrapper.classList = "wrapper_dark";
    var c__box = document.createElement('div'); c__box.classList = "d__confirm fixed flex flex-col border-soft item-bg box-shadow padding-1";
    document.body.append(c__wrapper); c__wrapper.append(c__box); disableScroll();
    c__box.innerHTML = `
        <div class="flex flex-row flex-align-c flex-justify-con-sb">
            <span class="text-primary bold">Különleges ajánlat</span>
            <span class="button button-secondary small-med" id="cl__box">Értem</span>
        </div><br>
        <div class="flex flex-col gap-1">
            <span class="text-secondary small">E-mail címének megadásával feliratkozik hírlevelünkre, és jogosult akciónkra, amely 2000 Ft értékű kedvezményt biztosít első vásárlásakor.</span>
            <div class="flex flex-col gap-05">
                <span class="text-secondary c__small">* Az első vásárlást a hírlevélre való feliratkozása után számítjuk. Ez a kedvezmény <b>kizárólag csak ezen az fiókon</b> lesz felhasználható.</span>
                <span class="text-secondary c__small">** A kedvezmény minimum 5000 Ft értékű vásárlás esetén kerül felhasználásra.</span>
            </div>
        </div>
    `;
    $('#cl__box').click(function () { c__wrapper.remove(); enableScroll(); });
});

var c__wrapper = document.createElement('div'); c__wrapper.classList = "wrapper_dark";
var c__box = document.createElement('div'); c__box.classList = "d__confirm fixed flex flex-col border-soft item-bg box-shadow padding-1";
$('#unsub__mail').click(function () { document.body.append(c__wrapper); c__wrapper.append(c__box); disableScroll();
    c__box.innerHTML = `
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
        <div class="flex flex-row flex-align-c flex-justify-con-sb">
            <span class="button button-secondary small-med" id="cl__box">Mégsem</span>
            <span class="button button-disabled small-med" id="co__box">Leiratkozás</span>
        </div>
    `;
    $('#cl__box').click(function () { c__wrapper.remove(); enableScroll(); });
    $('#co__box').click(function () {
        if ($('#uns__conf').is(':checked')) { var uns__data = new FormData(); uns__data.append("e__action", "1");
            $.ajax({
                enctype: "multipart/form-data", type: "POST", url: "/assets/php/sub/email.php", data: uns__data, dataType: 'json', contentType: false, processData: false,
                success: function(data) { c__wrapper.remove(); enableScroll(); window.location.reload(true); },
                error: function(data) { document.getElementById('uns__err').innerHTML = `<div class="flex flex-row flex-align-c flex-justify-con-sb alert alert-danger padding-05 border-soft small-med"><span class="flex flex-row flex-align-c gap-05"><span class="flex"><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="18px" height="18px" viewBox="0 0 24 24" version="1.1"><g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"><rect x="0" y="0" width="24" height="24"/><path d="M11.1669899,4.49941818 L2.82535718,19.5143571 C2.557144,19.9971408 2.7310878,20.6059441 3.21387153,20.8741573 C3.36242953,20.9566895 3.52957021,21 3.69951446,21 L21.2169432,21 C21.7692279,21 22.2169432,20.5522847 22.2169432,20 C22.2169432,19.8159952 22.1661743,19.6355579 22.070225,19.47855 L12.894429,4.4636111 C12.6064401,3.99235656 11.9909517,3.84379039 11.5196972,4.13177928 C11.3723594,4.22181902 11.2508468,4.34847583 11.1669899,4.49941818 Z" fill="#ce3746" opacity="0.3"/><rect fill="#ce3746" x="11" y="9" width="2" height="7" rx="1"/><rect fill="#ce3746" x="11" y="17" width="2" height="2" rx="1"/></g></svg></span><span class="flex text-danger">Hiba történt, próbálja újra később.</span></span><span class="flex flex-align-c pointer" id="cls__err">`+i__cls+`</span></div>`; $('#cls__err').click(() => { document.getElementById('uns__err').innerHTML = ``; });}
            });
        } else { $('#uns__conf__lbl').css('color', '#ce3746'); }
    });
    $('#uns__conf').click(() => { 
        if ($('#uns__conf').is(':checked')) { $('#uns__conf__lbl').css('color', 'var(--secondary-light-color)'); document.getElementById('co__box').classList.replace('button-disabled', 'button-primary'); }
        else { document.getElementById('co__box').classList.replace('button-primary', 'button-disabled'); }
    });
});