$('#add__card').click(() => { var c__wrapper = document.createElement('div'); c__wrapper.classList = "wrapper_dark fadein"; var c__box = document.createElement('div'); c__box.classList = "d__confirm popup fixed flex flex-col border-soft item-bg box-shadow padding-1";
    c__wrapper.classList.add("fadein"); c__wrapper.classList.remove("fadeout"); document.body.append(c__wrapper); c__box.classList.add('padding-t-0'); c__box.classList.add('popup'); c__box.classList.remove('popout'); c__wrapper.append(c__box); $('html').css("overflow-y", "hidden");
    c__box.innerHTML = `
    <div class="flex flex-row flex-align-c flex-justify-con-sb padding-t-1" id="cbh__con">
        <span class="text-primary bold">Új kártya felvétele</span>
        <div class="flex flex-row flex-align-c gap-05">
            <span class="text-primary pointer" aria-label="Bezárás" id="cl__box"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"><rect opacity="0.3" x="2" y="2" width="20" height="20" rx="5" fill="currentColor"/><rect x="7" y="15.3137" width="12" height="2" rx="1" transform="rotate(-45 7 15.3137)" fill="currentColor"/><rect x="8.41422" y="7" width="12" height="2" rx="1" transform="rotate(45 8.41422 7)" fill="currentColor"/></svg></span>
        </div>
    </div><br><hr style="border: 1px solid var(--background);" class="w-fa"><br>
    <div class="flex flex-col flex-align-c gap-1">
        <div class="flex flex-col gap-05 w-100">
            <span class="text-primary small-med">Kártyatulajdonos Neve</span>
            <input type="text" class="text-primary border-soft background-bg padding-1-05 outline-none border-none small-med" name="cardholder" id="cardholder" placeholder="Minta Misi" important  />
        </div>
        <div class="flex flex-col gap-05 w-100">
            <span class="text-primary small-med">Kártyaszám</span>
            <div class="flex flex-row flex-align-c border-soft overflow-hidden w-100">
                <input type="number" class="w-fa text-primary background-bg padding-1-05 outline-none border-none small-med" name="cardnumber" id="cardnumber" placeholder="1234 5678 1234 5678" important  />
                <span class="w-20 text-primary background-bg outline-none border-none small-med" id="cardt__con"></span>
            </div>
        </div>
        <div class="flex flex-row flex-align-c flex-justify-con-sa gap-1 w-fa">
            <div class="flex flex-col gap-05 w-fa">
                <span class="text-primary small-med">Lejárati dátum</span>
                <input type="date" class="text-primary border-soft background-bg padding-1-05 outline-none border-none small-med" name="cardexpiry" id="cardexpiry" important  />
            </div>
            <div class="flex flex-col gap-05">
                <span class="text-primary small-med">CVC</span>
                <input type="number" class="text-primary border-soft background-bg padding-1-05 outline-none border-none small-med" name="cardcvc" id="cardcvc" min="100" max="999" placeholder="CVC" important  />
            </div>
        </div>
    </div><br>
    <div class="flex flex-col gap-05">
        <div class="flex flex-row flex-align-c w-100 gap-1">
            <span class="text-secondary small-med" style="font-size: .95rem !important;">Állítsa be elsődleges kártyának</span>
            <div class="flex flex-col">
                <label class="switch switch-smaller">
                    <input type="checkbox" name="setcardprimary" id="setcardprimary">
                    <span class="slider slider-smaller round"></span>
                </label>
            </div>
        </div>
        <div class="flex flex-row-d-col-m flex-align-c flex-justify-con-sb border-soft border-primary-light-dotted primary-bg padding-1">
            <div class="flex flex-row-d-col-m flex-align-c gap-1">
                <div class="flex flex-row flex-align-c gap-1">
                    <div class="flex flex-col flex-align-c flex-justify-con-fs">
                        <span class="bold w-100 small-med" style="font-size: .95rem !important;">Fontos felhívás!</span>
                        <span class="text-secondary smaller-light">Ne adja meg valós kártya adatait, ez a funkció csak egy <b>demó</b> változat, nem fog tudni tranzakciót végrehajtani az eredeti kártyájáról, csak az automatikusan ehhez a kártyához hozzárendelt 30 000 Ft keret áll majd rendelkezésére.</span>
                    </div>
                </div>
            </div>
        </div>
        <div class="flex flex-row flex-align-c flex-justify-con-fe">
            <span class="button button-primary" id="add__newcard">Mentés</span>
        </div>
    </div>
    `;
    var con = document.getElementById('cbh__con');var mc = new Hammer(con);mc.get('pan').set({ direction: Hammer.DIRECTION_ALL });mc.on("pandown", function(ev) { $('#cl__box').click(); });
    document.getElementById('cardt__con').innerHTML = `
    <select class="cardtype w-fa text-primary background-bg outline-none border-none small-med pointer padding-1-05" id="cardtype" style="-webkit-appearance: none;">
        <option value="mastercard">Mastercard</option>
        <option value="paypal">PayPal</option>
        <option value="visa">Visa</option>
    </select>
    `;
    $("#add__newcard").click(() => { const card__errs = []; if (!$('#cardholder').val().match(/^([A-Za-zÀ-ÖØ-öø-ÿ]{3,})+\s+([\w\s]{3,})+$/i) || $("#cardholder").val().length < 5) { card__errs.push({field: "Kártyatulajdonos", error: "Érvénytelen formátumot adott meg"}); }if ($("#cardnumber").val().length !== 16) { card__errs.push({field: "Kártyaszám", error: "Érvénytelen formátumot adott meg"}); }if (!$("#cardexpiry").val()) { card__errs.push({field: "Lejárati dátum", error: "Érvénytelen formátumot adott meg"}); }if ($("#cardcvc").val().length !== 3) { card__errs.push({field: "CVC", error: "Érvénytelen formátumot adott meg"}); }
    if (card__errs.length > 0) { var ce__wrapper = document.createElement('div'); ce__wrapper.classList = "wrapper_dark fadein"; var ce__box = document.createElement('div'); ce__box.id = "adcrd__incon"; ce__box.classList = "d__confirm de__confirm popup fixed flex flex-col border-soft item-bg box-shadow padding-1";
            c__wrapper.append(ce__wrapper); ce__wrapper.append(ce__box); $('html').css("overflow-y", "hidden");
            ce__box.innerHTML = `<div class="flex flex-col gap-1 feat__body prs__con" id="prs__con"><div class="flex flex-col flex-align-c flex-justify-con-c"><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="8rem" height="8rem" viewBox="0 0 24 24" version="1.1"><g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"><rect x="0" y="0" width="24" height="24"></rect><circle fill="#F64E60" opacity="0.3" cx="12" cy="12" r="10"></circle><path d="M12.0355339,10.6213203 L14.863961,7.79289322 C15.2544853,7.40236893 15.8876503,7.40236893 16.2781746,7.79289322 C16.6686989,8.18341751 16.6686989,8.81658249 16.2781746,9.20710678 L13.4497475,12.0355339 L16.2781746,14.863961 C16.6686989,15.2544853 16.6686989,15.8876503 16.2781746,16.2781746 C15.8876503,16.6686989 15.2544853,16.6686989 14.863961,16.2781746 L12.0355339,13.4497475 L9.20710678,16.2781746 C8.81658249,16.6686989 8.18341751,16.6686989 7.79289322,16.2781746 C7.40236893,15.8876503 7.40236893,15.2544853 7.79289322,14.863961 L10.6213203,12.0355339 L7.79289322,9.20710678 C7.40236893,8.81658249 7.40236893,8.18341751 7.79289322,7.79289322 C8.18341751,7.40236893 8.81658249,7.40236893 9.20710678,7.79289322 L12.0355339,10.6213203 Z" fill="#F64E60"></path></g></svg><span class="bold small" style="color: #F64E60;">Hibás adatok!</span></div><div class="flex flex-col flex-align-c flex-justify-con-c"><span class="text-secondary w-100 text-align-c small-med"><ul class="flex flex-col flex-align-c flex-justify-con-c gap-05 list-style-none" id="cderr__con" style="padding: 0;"></ul></span><span class="text-primary pointer" aria-label="Bezárás" id="cl__ebox"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"><rect opacity="0.3" x="2" y="2" width="20" height="20" rx="5" fill="currentColor"/><rect x="7" y="15.3137" width="12" height="2" rx="1" transform="rotate(-45 7 15.3137)" fill="currentColor"/><rect x="8.41422" y="7" width="12" height="2" rx="1" transform="rotate(45 8.41422 7)" fill="currentColor"/></svg></span></div></div>`;
            for (let i = 0; i < card__errs.length; i++) { document.getElementById("cderr__con").innerHTML += `<li class="text-secondary smaller-light"><span><span>${card__errs[0].error}</span> a(z) <b>${card__errs[i].field}</b> mezőben!</span></li>`; }
            $("#cl__ebox").click(() => { ce__box.classList.replace("popup", "popout"); ce__wrapper.classList.add("fadeout"); setTimeout(() => {ce__wrapper.remove();},235); });
        } else { var crd__primary = document.getElementById("setcardprimary").checked ? true : false; var card__data = new FormData(); 
            card__data.append("cardholder", $("#cardholder").val()); card__data.append("cardnum", $("#cardnumber").val()); 
            card__data.append("expiry", $("#cardexpiry").val());card__data.append("cvc", $("#cardcvc").val());
            card__data.append("type", $("#cardtype").val()); card__data.append("primary", crd__primary); card__data.append("uid", guid); let apiKey = '739837e232548988c86b954108794b57bd3e1dbcd6eb550bfa53e544';
            $.getJSON('https://api.ipdata.co?api-key=' + apiKey, function(data) { card__data.append("ip", data.ip);
                $.ajax({ enctype: "multipart/form-data", type: "POST", url: "/assets/php/profile/add__card__a.php", data: card__data, dataType: 'json', contentType: false, processData: false,
                    success: function(data) { var ce__wrapper = document.createElement('div'); ce__wrapper.classList = "wrapper_dark fadein"; var ce__box = document.createElement('div'); ce__box.classList = "d__confirm de__confirm popup fixed flex flex-col border-soft item-bg box-shadow padding-1";
                        if (data === 200) { c__wrapper.append(ce__wrapper); ce__wrapper.append(ce__box);
                            ce__box.innerHTML = `
                            <div class="flex flex-col flex-align-c flex-justify-con-c">
                                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="8rem" height="8rem" viewBox="0 0 24 24" version="1.1"><g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"><rect x="0" y="0" width="24" height="24"/><circle fill="#0f5132" opacity="0.3" cx="12" cy="12" r="10"/><path d="M16.7689447,7.81768175 C17.1457787,7.41393107 17.7785676,7.39211077 18.1823183,7.76894473 C18.5860689,8.1457787 18.6078892,8.77856757 18.2310553,9.18231825 L11.2310553,16.6823183 C10.8654446,17.0740439 10.2560456,17.107974 9.84920863,16.7592566 L6.34920863,13.7592566 C5.92988278,13.3998345 5.88132125,12.7685345 6.2407434,12.3492086 C6.60016555,11.9298828 7.23146553,11.8813212 7.65079137,12.2407434 L10.4229928,14.616916 L16.7689447,7.81768175 Z" fill="#0f5132" fill-rule="nonzero"/></g></svg>
                                <div class="flex flex-col gap-1 flex-align-c w-100">
                                    <span class="bold text-success small">Sikeres felvétel!</span>
                                    <span class="success-bg success-bg-hover padding-05 border-soft pointer user-select-none" id="cl__ebox">Bezárás</span>
                                </div>
                            </div>`;
                            $('#cl__ebox').click(function () { ce__box.classList.replace("popup", "popout"); ce__wrapper.classList.add("fadeout"); setTimeout(() => {c__wrapper.remove(); ce__box.remove(); ce__wrapper.remove(); $("#tab-credit").load('/includes/profile/credit.php'); $('html').css("overflow-y", "unset");},235); });
                        } else {
                            ce__box.innerHTML = `
                            <div class="flex flex-col flex-align-c flex-justify-con-c"><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="8rem" height="8rem" viewBox="0 0 24 24" version="1.1"><g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"><rect x="0" y="0" width="24" height="24"/><circle fill="#F64E60" opacity="0.3" cx="12" cy="12" r="10"/><path d="M12.0355339,10.6213203 L14.863961,7.79289322 C15.2544853,7.40236893 15.8876503,7.40236893 16.2781746,7.79289322 C16.6686989,8.18341751 16.6686989,8.81658249 16.2781746,9.20710678 L13.4497475,12.0355339 L16.2781746,14.863961 C16.6686989,15.2544853 16.6686989,15.8876503 16.2781746,16.2781746 C15.8876503,16.6686989 15.2544853,16.6686989 14.863961,16.2781746 L12.0355339,13.4497475 L9.20710678,16.2781746 C8.81658249,16.6686989 8.18341751,16.6686989 7.79289322,16.2781746 C7.40236893,15.8876503 7.40236893,15.2544853 7.79289322,14.863961 L10.6213203,12.0355339 L7.79289322,9.20710678 C7.40236893,8.81658249 7.40236893,8.18341751 7.79289322,7.79289322 C8.18341751,7.40236893 8.81658249,7.40236893 9.20710678,7.79289322 L12.0355339,10.6213203 Z" fill="#F64E60"/></g></svg><span class="bold text-danger small">Hiba történt a folyamat közben</span></div><div class="flex flex-col"><div class="flex flex-col gap-05"><span class="flex flex-align-c flex-justify-con-c w-fc margin-auto danger-bg danger-bg-hover padding-05 border-soft pointer user-select-none" id="cl__ebox">Bezárás</span></div></div>`;
                            $('#cl__ebox').click(function () { ce__box.classList.replace("popup", "popout"); ce__wrapper.classList.add("fadeout"); setTimeout(() => {c__wrapper.remove(); $("#tab-credit").load('/includes/profile/credit.php'); $('html').css("overflow-y", "unset");},235); });
                        }
                    }
                });
            }); 
        }
        var con = document.getElementById('adcrd__incon');var mc = new Hammer(con);mc.get('pan').set({ direction: Hammer.DIRECTION_ALL });mc.on("pandown", function(ev) { $('#cl__ebox').click(); });
    });
    $('#cl__box').click(function () { c__box.classList.replace("popup", "popout"); c__wrapper.classList.add("fadeout"); setTimeout(() => {c__wrapper.remove(); $("#tab-credit").load('/includes/profile/credit.php'); $('html').css("overflow-y", "unset");},235); });
});

function __editcard (cid) { var card__data = new FormData(); card__data.append("cid", cid); card__data.append("uid", guid);
    var c__wrapper = document.createElement('div'); c__wrapper.classList = "wrapper_dark fadein"; var c__box = document.createElement('div'); c__box.classList = "d__confirm popup fixed flex flex-col border-soft item-bg box-shadow padding-1";
    $.ajax({ enctype: "multipart/form-data", type: "POST", url: "/assets/php/profile/get__card__a.php", data: card__data, dataType: 'json', contentType: false, processData: false,
        success: function(data) {
            if (data !== 30) {
                document.body.append(c__wrapper); c__wrapper.classList.add("fadein"); c__wrapper.classList.remove("fadeout"); c__box.classList.add('popup'); c__box.classList.add('padding-t-0'); c__box.classList.remove('popout'); c__wrapper.append(c__box); $('html').css("overflow-y", "hidden");
                c__box.innerHTML = `
                <div class="flex flex-row flex-align-c flex-justify-con-sb padding-t-1" id="cbh__con">
                    <span class="text-primary bold">Kártya szerkesztése</span>
                    <div class="flex flex-row flex-align-c gap-05">
                        <span class="text-primary pointer" aria-label="Bezárás" id="cl__box"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"><rect opacity="0.3" x="2" y="2" width="20" height="20" rx="5" fill="currentColor"/><rect x="7" y="15.3137" width="12" height="2" rx="1" transform="rotate(-45 7 15.3137)" fill="currentColor"/><rect x="8.41422" y="7" width="12" height="2" rx="1" transform="rotate(45 8.41422 7)" fill="currentColor"/></svg></span>
                    </div>
                </div><br><hr style="border: 1px solid var(--background);" class="w-fa"><br>
                <div class="flex flex-col flex-align-c gap-1">
                    <div class="flex flex-col gap-05 w-100">
                        <span class="text-primary small-med">Kártyatulajdonos Neve</span>
                        <input type="text" class="text-primary border-soft background-bg padding-1-05 outline-none border-none small-med" name="cardholder" id="cardholder" value="${data.holder}" placeholder="Minta Misi" required  />
                    </div>
                    <div class="flex flex-col gap-05 w-100">
                        <span class="text-primary small-med">Kártyaszám</span>
                        <div class="flex flex-row flex-align-c border-soft overflow-hidden w-100">
                            <input type="number" class="w-fa text-primary background-bg padding-1-05 outline-none border-none small-med" name="cardnumber" id="cardnumber" value="${data.cardnum}" placeholder="1234 5678 1234 5678" required  />
                            <input type="hidden" data-key="cardname" />
                            <span class="w-20 text-primary background-bg outline-none border-none small-med" id="cardt__con"></span>
                        </div>
                    </div>
                    <div class="flex flex-row flex-align-c flex-justify-con-sa gap-1 w-fa">
                        <div class="flex flex-col gap-05 w-fa">
                            <span class="text-primary small-med">Lejárati dátum</span>
                            <input type="date" class="text-primary border-soft background-bg padding-1-05 outline-none border-none small-med" name="cardexpiry" id="cardexpiry" value="${data.expiry}" reuqired  />
                        </div>
                        <div class="flex flex-col gap-05">
                            <span class="text-primary small-med">CVC</span>
                            <input type="number" class="text-primary border-soft background-bg padding-1-05 outline-none border-none small-med" name="cardcvc" id="cardcvc" min="100" max="999" value="${data.cvc}" placeholder="CVC" required  />
                        </div>
                    </div>
                </div><br>
                <div class="flex flex-col gap-1">
                    <div class="flex flex-row-d-col-m flex-align-c flex-justify-con-sb border-soft border-primary-light-dotted primary-bg padding-1">
                        <div class="flex flex-row-d-col-m flex-align-c gap-1">
                            <div class="flex flex-row flex-align-c gap-1">
                                <div class="flex flex-col flex-align-c flex-justify-con-fs">
                                    <span class="bold w-100 small-med" style="font-size: .95rem !important;">Fontos felhívás!</span>
                                    <span class="text-secondary smaller-light">Ne adja meg valós kártya adatait, ez a funkció csak egy <b>demó</b> változat, nem fog tudni tranzakciót végrehajtani az eredeti kártyájáról, csak az automatikusan ehhez a kártyához hozzárendelt 30 000 Ft keret áll majd rendelkezésére.</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="flex flex-row flex-align-c flex-justify-con-fe">
                        <span class="primary-bg primary-bg-hover border-soft-light padding-05 user-select-none pointer" id="update__card">Mentés</span>
                    </div>
                </div>
                `;
                document.getElementById('cardt__con').innerHTML = `
                <select class="cardtype w-fa text-primary background-bg outline-none border-none small-med pointer padding-1-05" id="cardtype" style="-webkit-appearance: none;">
                    <option value="mastercard">Mastercard</option>
                    <option value="paypal">PayPal</option>
                    <option value="visa">Visa</option>
                </select>
                `;
                var con = document.getElementById('cbh__con');var mc = new Hammer(con);mc.get('pan').set({ direction: Hammer.DIRECTION_ALL });mc.on("pandown", function(ev) { $('#cl__box').click(); });
                if (data.cardname.toLowerCase() === 'mastercard') { document.getElementById('cardtype').options[0].selected = true; }if (data.cardname.toLowerCase() === 'visa') { document.getElementById('cardtype').options[2].selected = true; }if (data.cardname.toLowerCase() === 'paypal') { document.getElementById('cardtype').options[1].selected = true; }
                $('#update__card').click(() => { const card__errs = []; if (!$("#cardholder").val().match(/^([A-Za-zÀ-ÖØ-öø-ÿ]{3,})+\s+([\w\s]{3,})+$/i) || $("#cardholder").val().length < 5) { card__errs.push({field: "Kártyatulajdonos", error: "Érvénytelen formátumot adott meg"}); }if ($("#cardnumber").val().length !== 16) { card__errs.push({field: "Kártyaszám", error: "Érvénytelen formátumot adott meg"}); }if (!$("#cardexpiry").val()) { card__errs.push({field: "Lejárati dátum", error: "Érvénytelen formátumot adott meg"}); }if ($("#cardcvc").val().length !== 3) { card__errs.push({field: "CVC", error: "Érvénytelen formátumot adott meg"});}if (card__errs.length > 0) { var ce__wrapper = document.createElement('div'); ce__wrapper.classList = "wrapper_dark"; var ce__box = document.createElement('div'); ce__box.classList = "d__confirm de__confirm popup fixed flex flex-col border-soft item-bg box-shadow padding-1"; c__wrapper.append(ce__wrapper); ce__wrapper.append(ce__box); $('html').css("overflow-y", "hidden");
                    ce__box.innerHTML = `<div class="flex flex-col gap-1 feat__body prs__con" id="prs__con"><div class="flex flex-col flex-align-c flex-justify-con-c"><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="8rem" height="8rem" viewBox="0 0 24 24" version="1.1"><g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"><rect x="0" y="0" width="24" height="24"></rect><circle fill="#F64E60" opacity="0.3" cx="12" cy="12" r="10"></circle><path d="M12.0355339,10.6213203 L14.863961,7.79289322 C15.2544853,7.40236893 15.8876503,7.40236893 16.2781746,7.79289322 C16.6686989,8.18341751 16.6686989,8.81658249 16.2781746,9.20710678 L13.4497475,12.0355339 L16.2781746,14.863961 C16.6686989,15.2544853 16.6686989,15.8876503 16.2781746,16.2781746 C15.8876503,16.6686989 15.2544853,16.6686989 14.863961,16.2781746 L12.0355339,13.4497475 L9.20710678,16.2781746 C8.81658249,16.6686989 8.18341751,16.6686989 7.79289322,16.2781746 C7.40236893,15.8876503 7.40236893,15.2544853 7.79289322,14.863961 L10.6213203,12.0355339 L7.79289322,9.20710678 C7.40236893,8.81658249 7.40236893,8.18341751 7.79289322,7.79289322 C8.18341751,7.40236893 8.81658249,7.40236893 9.20710678,7.79289322 L12.0355339,10.6213203 Z" fill="#F64E60"></path></g></svg><span class="bold small" style="color: #F64E60;">Hibás adatok!</span></div><div class="flex flex-col flex-align-c flex-justify-con-c"><span class="text-secondary w-100 text-align-c small-med"><ul class="flex flex-col flex-align-c flex-justify-con-c gap-05 list-style-none" id="cderr__con" style="padding: 0;"></ul></span><span class="button button-secondary" style="font-size: .75rem !important;" id="cl__ebox">Bezárás</span></div></div>`;
                    for (let i = 0; i < card__errs.length; i++) { document.getElementById("cderr__con").innerHTML += `<li class="text-secondary smaller-light"><span><span>${card__errs[0].error}</span> a(z) <b>${card__errs[i].field}</b> mezőben!</span></li>`; } $("#cl__ebox").click(() => { ce__box.classList.replace("popup", "popout"); ce__wrapper.classList.add("fadeout"); setTimeout(() => {ce__wrapper.remove();},235); });
                    } else { var gc__data = new FormData(); gc__data.append("cid", cid); gc__data.append("uid", guid);
                        $.ajax({ enctype: "multipart/form-data", type: "POST", url: "/assets/php/profile/get__card__a.php", data: gc__data, dataType: 'json', contentType: false, processData: false,
                            success: function(res) { function arraysEqual(a, b) { var diff = []; const a__matches = []; for (let key of Object.keys(a[0])) { a__matches.push([key, a[0][key]]);} const b__matches = []; for (let key of Object.keys(b[0])) { b__matches.push([key, b[0][key]]);} for (let i = 0; i < a__matches.length; i++) {if (a__matches[i][1] !== b__matches[i][1]) { var diff__key = a__matches[i][0]; diff__val = a__matches[i][1]; const item = {}; item[diff__key] = diff__val; diff.push(item);}} return (diff);} 
                                var get__cinfo = []; var db__vals = []; 
                                get__cinfo.push({holder: $("#cardholder").val(), number: Number($("#cardnumber").val()), cardname: $("#cardtype").val().toLowerCase(), expiry: $("#cardexpiry").val(), cvc: Number($("#cardcvc").val())});
                                db__vals.push({holder: res.holder, number: Number(res.cardnum), cardname: res.cardname.toLowerCase(), expiry: res.expiry, cvc: Number(res.cvc)});
                                let sec = arraysEqual(get__cinfo, db__vals);
                                if (sec.length < 1) {  var ce__wrapper = document.createElement('div'); ce__wrapper.classList = "wrapper_dark fadein"; var ce__box = document.createElement('div'); ce__box.classList = "d__confirm de__confirm popup fixed flex flex-col border-soft item-bg box-shadow padding-1"; c__wrapper.append(ce__wrapper); ce__wrapper.append(ce__box); $('html').css("overflow-y", "hidden");
                                    ce__box.id = "chcpp__con"; ce__box.innerHTML = `<div class="flex flex-row w-100 flex-align-fe flex-justify-con-fe"><span class="text-primary pointer" aria-label="Értem" id="cl__ebox"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"><rect opacity="0.3" x="2" y="2" width="20" height="20" rx="5" fill="currentColor"/><rect x="7" y="15.3137" width="12" height="2" rx="1" transform="rotate(-45 7 15.3137)" fill="currentColor"/><rect x="8.41422" y="7" width="12" height="2" rx="1" transform="rotate(45 8.41422 7)" fill="currentColor"/></svg></span></div><div class="flex flex-col flex-align-c flex-justify-con-c"><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="8rem" height="8rem" viewBox="0 0 24 24" version="1.1"><g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"><rect x="0" y="0" width="24" height="24"></rect><path d="M11.1669899,4.49941818 L2.82535718,19.5143571 C2.557144,19.9971408 2.7310878,20.6059441 3.21387153,20.8741573 C3.36242953,20.9566895 3.52957021,21 3.69951446,21 L21.2169432,21 C21.7692279,21 22.2169432,20.5522847 22.2169432,20 C22.2169432,19.8159952 22.1661743,19.6355579 22.070225,19.47855 L12.894429,4.4636111 C12.6064401,3.99235656 11.9909517,3.84379039 11.5196972,4.13177928 C11.3723594,4.22181902 11.2508468,4.34847583 11.1669899,4.49941818 Z" fill="#e29702" opacity="0.3"></path><rect fill="#e29702" x="11" y="9" width="2" height="7" rx="1"></rect><rect fill="#e29702" x="11" y="17" width="2" height="2" rx="1"></rect></g></svg><span class="bold small" style="color: #e29702;">Nem történt változtatás!</span></div><div class="flex flex-col flex-align-c flex-justify-con-c"><span class="text-secondary w-100 text-align-c small-med">A megadott értékei alapján nincs mit megváltoztatni. Nem történt változtatás, így nyugodtan bezárhatja ezt a panelt.</span></div>`;
                                    $('#cl__ebox').click(function () { ce__box.classList.replace("popup", "popout"); ce__wrapper.classList.add("fadeout"); setTimeout(() => {ce__wrapper.remove();},235); });
                                    var con = document.getElementById('chcpp__con');var mc = new Hammer(con);mc.get('pan').set({ direction: Hammer.DIRECTION_ALL });mc.on("pandown", function(ev) { $('#cl__ebox').click(); });
                                } else { var ce__wrapper = document.createElement('div'); ce__wrapper.classList = "wrapper_dark fadein"; var ce__box = document.createElement('div'); ce__box.classList = "d__confirm de__confirm popup fixed flex flex-col border-soft item-bg box-shadow padding-1 w-fc"; c__wrapper.append(ce__wrapper); ce__wrapper.append(ce__box); $('html').css("overflow-y", "hidden");
                                    ce__box.id = "chcpp__con"; ce__box.innerHTML = `<div class="flex flex-row w-100 flex-align-c flex-justify-con-sb"><span class="text-primary bold small">Változtatni kívánt adatok</span><span class="text-primary pointer" aria-label="Mégsem" id="cl__ebox"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"><rect opacity="0.3" x="2" y="2" width="20" height="20" rx="5" fill="currentColor"/><rect x="7" y="15.3137" width="12" height="2" rx="1" transform="rotate(-45 7 15.3137)" fill="currentColor"/><rect x="8.41422" y="7" width="12" height="2" rx="1" transform="rotate(45 8.41422 7)" fill="currentColor"/></svg></span></div><br><div class="flex flex-col flex-align-c flex-justify-con-c feat__body"><table class="ch__table w-fa" id="sc__table" style="text-align: center !important;"></table></div>`;
                                    var chan__data = new FormData(); chan__data.append("cid", cid);
                                    for (let i = 0; i < sec.length; i++) {
                                        for (let s__keys in sec[i]) { var ch__title = document.querySelector("input[data-key='"+revConst(sec[i],sec[i][s__keys])+"']");
                                            document.getElementById("sc__table").innerHTML += `<tr class="background-bg text-secondary small-med" style="text-align: center !important;">
                                                <th style="text-align: center !important;">`+revConst(sec[i],sec[i][s__keys])+`</th>
                                                <td style="text-align: center !important;"><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1"><g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"><polygon points="0 0 24 0 24 24 0 24"/><rect fill="#3699FF" opacity="0.3" transform="translate(8.500000, 12.000000) rotate(-90.000000) translate(-8.500000, -12.000000) " x="7.5" y="7.5" width="2" height="9" rx="1"/><path d="M9.70710318,15.7071045 C9.31657888,16.0976288 8.68341391,16.0976288 8.29288961,15.7071045 C7.90236532,15.3165802 7.90236532,14.6834152 8.29288961,14.2928909 L14.2928896,8.29289093 C14.6714686,7.914312 15.281055,7.90106637 15.675721,8.26284357 L21.675721,13.7628436 C22.08284,14.136036 22.1103429,14.7686034 21.7371505,15.1757223 C21.3639581,15.5828413 20.7313908,15.6103443 20.3242718,15.2371519 L15.0300721,10.3841355 L9.70710318,15.7071045 Z" fill="#3699FF" fill-rule="nonzero" transform="translate(14.999999, 11.999997) scale(1, -1) rotate(90.000000) translate(-14.999999, -11.999997) "/></g></svg></td>
                                                <td style="text-align: center !important;" id="td__chto__${s__keys}">`+sec[i][s__keys]+`</td>
                                            </tr>`;
                                            if (s__keys === 'type' || s__keys === 'cardholder') { document.getElementById("td__chto__"+s__keys).textContent = sec[i][s__keys].replace(/<\/?[^>]+(>|$)/g, ""); }
                                            else { document.getElementById("td__chto__"+s__keys).textContent = sec[i][s__keys]; } chan__data.append(revConst(sec[i],sec[i][s__keys]), sec[i][s__keys]);
                                        }
                                    } function revConst(cons, val) { return Object.keys(cons).find(key => cons[key] === val); }
                                    ce__box.innerHTML += `<br><div class="flex flex-row flex-align-fe flex-justify-con-fe"><span class="primary-bg primary-bg-hover border-soft padding-05 user-select-none pointer" id="svch__card">Mentés</span></div>`;
                                    $('#cl__ebox').click(function () { ce__box.classList.replace("popup", "popout"); ce__wrapper.classList.add("fadeout"); setTimeout(() => {ce__wrapper.remove();},235); });
                                    $('#svch__card').click(function () { chan__data.append("uid", guid); let apiKey = '739837e232548988c86b954108794b57bd3e1dbcd6eb550bfa53e544';
                                        document.getElementById('svch__card').classList = "label-secondary border-soft padding-05 user-select-none"; document.getElementById('svch__card').textContent = `Folyamatban`;
                                        $.ajax({url: "https://api.ipdata.co?api-key=739837e232548988c86b954108794b57bd3e1dbcd6eb550bfa53e544", dataType: 'json',
                                            success: function (api) { chan__data.append("ip", api.ip);
                                                $.ajax({ enctype: "multipart/form-data", type: "POST", url: "/assets/php/profile/update__card__a.php", data: chan__data, dataType: 'json', contentType: false, processData: false,
                                                    success: function(data) {
                                                        if (data === 200) {
                                                            ce__box.innerHTML = `
                                                            <div class="flex flex-col flex-align-c flex-justify-con-c">
                                                                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="8rem" height="8rem" viewBox="0 0 24 24" version="1.1"><g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"><rect x="0" y="0" width="24" height="24"/><circle fill="#0f5132" opacity="0.3" cx="12" cy="12" r="10"/><path d="M16.7689447,7.81768175 C17.1457787,7.41393107 17.7785676,7.39211077 18.1823183,7.76894473 C18.5860689,8.1457787 18.6078892,8.77856757 18.2310553,9.18231825 L11.2310553,16.6823183 C10.8654446,17.0740439 10.2560456,17.107974 9.84920863,16.7592566 L6.34920863,13.7592566 C5.92988278,13.3998345 5.88132125,12.7685345 6.2407434,12.3492086 C6.60016555,11.9298828 7.23146553,11.8813212 7.65079137,12.2407434 L10.4229928,14.616916 L16.7689447,7.81768175 Z" fill="#0f5132" fill-rule="nonzero"/></g></svg>
                                                                <div class="flex flex-col gap-1 flex-align-c w-100">
                                                                    <span class="bold text-success small">Sikeres változtazás!</span>
                                                                    <span class="success-bg success-bg-hover padding-05 border-soft pointer user-select-none" id="cl__ebox">Bezárás</span>
                                                                </div>
                                                            </div>`;$('#cl__ebox').click(function () { ce__box.classList.replace("popup", "popout"); ce__wrapper.classList.add("fadeout"); setTimeout(() => {c__wrapper.remove(); ce__box.remove(); ce__wrapper.remove(); $("#tab-credit").load('/includes/profile/credit.php'); $('html').css("overflow-y", "unset");},235); });
                                                        } else {
                                                            ce__box.innerHTML = `<div class="flex flex-col flex-align-c flex-justify-con-c"><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="8rem" height="8rem" viewBox="0 0 24 24" version="1.1"><g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"><rect x="0" y="0" width="24" height="24"/><circle fill="#F64E60" opacity="0.3" cx="12" cy="12" r="10"/><path d="M12.0355339,10.6213203 L14.863961,7.79289322 C15.2544853,7.40236893 15.8876503,7.40236893 16.2781746,7.79289322 C16.6686989,8.18341751 16.6686989,8.81658249 16.2781746,9.20710678 L13.4497475,12.0355339 L16.2781746,14.863961 C16.6686989,15.2544853 16.6686989,15.8876503 16.2781746,16.2781746 C15.8876503,16.6686989 15.2544853,16.6686989 14.863961,16.2781746 L12.0355339,13.4497475 L9.20710678,16.2781746 C8.81658249,16.6686989 8.18341751,16.6686989 7.79289322,16.2781746 C7.40236893,15.8876503 7.40236893,15.2544853 7.79289322,14.863961 L10.6213203,12.0355339 L7.79289322,9.20710678 C7.40236893,8.81658249 7.40236893,8.18341751 7.79289322,7.79289322 C8.18341751,7.40236893 8.81658249,7.40236893 9.20710678,7.79289322 L12.0355339,10.6213203 Z" fill="#F64E60"/></g></svg><span class="bold text-danger small">Hiba történt a folyamat közben</span></div><div class="flex flex-col"><div class="flex flex-col gap-05"><span class="flex flex-align-c flex-justify-con-c w-fc margin-auto danger-bg danger-bg-hover padding-05 border-soft pointer user-select-none" id="cl__ebox">Bezárás</span></div></div>`;
                                                            $('#cl__ebox').click(function () { ce__box.classList.replace("popup", "popout"); ce__wrapper.classList.add("fadeout"); setTimeout(() => {c__wrapper.remove(); $("#tab-credit").load('/includes/profile/credit.php'); $('html').css("overflow-y", "unset");},235); });
                                                        } $('#intab-cards').click();
                                                    }, error: function (data) {
                                                        ce__box.innerHTML = `<div class="flex flex-col flex-align-c flex-justify-con-c"><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="8rem" height="8rem" viewBox="0 0 24 24" version="1.1"><g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"><rect x="0" y="0" width="24" height="24"/><circle fill="#F64E60" opacity="0.3" cx="12" cy="12" r="10"/><path d="M12.0355339,10.6213203 L14.863961,7.79289322 C15.2544853,7.40236893 15.8876503,7.40236893 16.2781746,7.79289322 C16.6686989,8.18341751 16.6686989,8.81658249 16.2781746,9.20710678 L13.4497475,12.0355339 L16.2781746,14.863961 C16.6686989,15.2544853 16.6686989,15.8876503 16.2781746,16.2781746 C15.8876503,16.6686989 15.2544853,16.6686989 14.863961,16.2781746 L12.0355339,13.4497475 L9.20710678,16.2781746 C8.81658249,16.6686989 8.18341751,16.6686989 7.79289322,16.2781746 C7.40236893,15.8876503 7.40236893,15.2544853 7.79289322,14.863961 L10.6213203,12.0355339 L7.79289322,9.20710678 C7.40236893,8.81658249 7.40236893,8.18341751 7.79289322,7.79289322 C8.18341751,7.40236893 8.81658249,7.40236893 9.20710678,7.79289322 L12.0355339,10.6213203 Z" fill="#F64E60"/></g></svg><span class="bold text-danger small">Hiba történt a folyamat közben</span></div><div class="flex flex-col"><div class="flex flex-col gap-05"><span class="flex flex-align-c flex-justify-con-c w-fc margin-auto danger-bg danger-bg-hover padding-05 border-soft pointer user-select-none" id="cl__ebox">Bezárás</span></div></div>`;
                                                        $('#cl__ebox').click(function () { ce__box.classList.replace("popup", "popout"); ce__wrapper.classList.add("fadeout"); setTimeout(() => {c__wrapper.remove(); $("#tab-credit").load('/includes/profile/credit.php'); $('html').css("overflow-y", "unset");},235); }); $('#intab-cards').click();
                                                    }
                                                });
                                            }, error: function (e) {
                                                ce__box.innerHTML = `
                                                <div class="flex flex-col flex-align-c flex-justify-con-c text-danger">
                                                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="8rem" height="8rem" viewBox="0 0 24 24" version="1.1"><g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"><rect x="0" y="0" width="24" height="24"></rect><path d="M11.1669899,4.49941818 L2.82535718,19.5143571 C2.557144,19.9971408 2.7310878,20.6059441 3.21387153,20.8741573 C3.36242953,20.9566895 3.52957021,21 3.69951446,21 L21.2169432,21 C21.7692279,21 22.2169432,20.5522847 22.2169432,20 C22.2169432,19.8159952 22.1661743,19.6355579 22.070225,19.47855 L12.894429,4.4636111 C12.6064401,3.99235656 11.9909517,3.84379039 11.5196972,4.13177928 C11.3723594,4.22181902 11.2508468,4.34847583 11.1669899,4.49941818 Z" fill="currentColor" opacity="0.3"></path><rect fill="currentColor" x="11" y="9" width="2" height="7" rx="1"></rect><rect fill="currentColor" x="11" y="17" width="2" height="2" rx="1"></rect></g></svg>
                                                    <div class="flex flex-col gap-1 flex-align-c w-100">
                                                        <span class="bold text-danger small">Hiba történt!</span>
                                                        <span class="danger-bg danger-bg-hover padding-05 border-soft pointer user-select-none" id="cl__ebox">Bezárás</span>
                                                    </div>
                                                </div>`;$('#cl__ebox').click(function () { ce__box.classList.replace("popup", "popout"); ce__wrapper.classList.add("fadeout"); setTimeout(() => {c__wrapper.remove(); ce__box.remove(); ce__wrapper.remove(); $("#tab-credit").load('/includes/profile/credit.php'); $('html').css("overflow-y", "unset");},235); });
                                            }
                                        });
                                    });
                                    var con = document.getElementById('chcpp__con');var mc = new Hammer(con);mc.get('pan').set({ direction: Hammer.DIRECTION_ALL });mc.on("pandown", function(ev) { $('#cl__ebox').click(); });
                                }
                            }
                        });
                    }
                }); $('#cl__box').click(function () { c__box.classList.replace("popup", "popout"); c__wrapper.classList.add("fadeout"); setTimeout(() => {c__wrapper.remove(); $("#tab-credit").load('/includes/profile/credit.php'); $('html').css("overflow-y", "unset");},235); });
            } else { var ce__wrapper = document.createElement('div'); ce__wrapper.classList = "wrapper_dark fadein"; var ce__box = document.createElement('div'); ce__box.classList = "d__confirm de__confirm popup fixed flex flex-col border-soft item-bg box-shadow padding-1"; document.body.append(ce__wrapper); ce__wrapper.append(ce__box); $('html').css("overflow-y", "hidden"); ce__box.innerHTML = `<div class="flex flex-row w-100 flex-align-fe flex-justify-con-fe"><span class="text-primary pointer" aria-label="Értem" id="cl__ebox"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"><rect opacity="0.3" x="2" y="2" width="20" height="20" rx="5" fill="currentColor"/><rect x="7" y="15.3137" width="12" height="2" rx="1" transform="rotate(-45 7 15.3137)" fill="currentColor"/><rect x="8.41422" y="7" width="12" height="2" rx="1" transform="rotate(45 8.41422 7)" fill="currentColor"/></svg></span></div><div class="flex flex-col flex-align-c flex-justify-con-c"><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="8rem" height="8rem" viewBox="0 0 24 24" version="1.1"><g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"><rect x="0" y="0" width="24" height="24"></rect><path d="M11.1669899,4.49941818 L2.82535718,19.5143571 C2.557144,19.9971408 2.7310878,20.6059441 3.21387153,20.8741573 C3.36242953,20.9566895 3.52957021,21 3.69951446,21 L21.2169432,21 C21.7692279,21 22.2169432,20.5522847 22.2169432,20 C22.2169432,19.8159952 22.1661743,19.6355579 22.070225,19.47855 L12.894429,4.4636111 C12.6064401,3.99235656 11.9909517,3.84379039 11.5196972,4.13177928 C11.3723594,4.22181902 11.2508468,4.34847583 11.1669899,4.49941818 Z" fill="#e29702" opacity="0.3"></path><rect fill="#e29702" x="11" y="9" width="2" height="7" rx="1"></rect><rect fill="#e29702" x="11" y="17" width="2" height="2" rx="1"></rect></g></svg><span class="bold small" style="color: #e29702;">Ismeretlen kártyaadatok!</span></div><div class="flex flex-col flex-align-c flex-justify-con-c"><span class="text-secondary w-100 text-align-c small-med">A megadott adatok alapján nem találtunk egy olyan kártyát sem amely a profiljához tartozik a megadott adatokkal.</span></div>`; $('#cl__ebox').click(function () { ce__box.classList.replace("popup", "popout"); ce__wrapper.classList.add("fadeout"); setTimeout(() => {ce__wrapper.remove(); $('html').css("overflow-y", "unset");},235); }); }
        }, error: function (data) { console.log(data); }
    });
}

function __removecard (cid) {
    $.ajax({
        enctype: "multipart/form-data", type: "POST", url: "/assets/php/profile/get__defcard.php", dataType: 'json', contentType: false, processData: false,
        success: function(data) { var credid = cid.split('_')[1]; var defcard = data.cid; var c__wrapper = document.createElement('div'); c__wrapper.classList = "wrapper_dark fadein"; var c__box = document.createElement('div'); c__box.classList = "d__confirm popup fixed flex flex-col border-soft item-bg box-shadow padding-1 padding-t-0";
            if (credid === defcard) { document.body.append(ce__wrapper); c__wrapper.append(c__box); $('html').css("overflow-y", "hidden");
            c__box.innerHTML = `<div class="flex flex-row flex-align-c flex-justify-con-sb"><span class="text-primary bold small-med">Kártya törlése</span><span class="text-primary pointer" aria-label="Bezárás" id="cl__ebox"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"><rect opacity="0.3" x="2" y="2" width="20" height="20" rx="5" fill="currentColor"/><rect x="7" y="15.3137" width="12" height="2" rx="1" transform="rotate(-45 7 15.3137)" fill="currentColor"/><rect x="8.41422" y="7" width="12" height="2" rx="1" transform="rotate(45 8.41422 7)" fill="currentColor"/></svg></span></div><br><div class="flex flex-col gap-1 feat__body prs__con" id="prs__con"><div class="flex flex-col flex-align-c flex-justify-con-c"><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="8rem" height="8rem" viewBox="0 0 24 24" version="1.1"><g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"><rect x="0" y="0" width="24" height="24"></rect><circle fill="#F64E60" opacity="0.3" cx="12" cy="12" r="10"></circle><path d="M12.0355339,10.6213203 L14.863961,7.79289322 C15.2544853,7.40236893 15.8876503,7.40236893 16.2781746,7.79289322 C16.6686989,8.18341751 16.6686989,8.81658249 16.2781746,9.20710678 L13.4497475,12.0355339 L16.2781746,14.863961 C16.6686989,15.2544853 16.6686989,15.8876503 16.2781746,16.2781746 C15.8876503,16.6686989 15.2544853,16.6686989 14.863961,16.2781746 L12.0355339,13.4497475 L9.20710678,16.2781746 C8.81658249,16.6686989 8.18341751,16.6686989 7.79289322,16.2781746 C7.40236893,15.8876503 7.40236893,15.2544853 7.79289322,14.863961 L10.6213203,12.0355339 L7.79289322,9.20710678 C7.40236893,8.81658249 7.40236893,8.18341751 7.79289322,7.79289322 C8.18341751,7.40236893 8.81658249,7.40236893 9.20710678,7.79289322 L12.0355339,10.6213203 Z" fill="#F64E60"></path></g></svg><span class="bold small" style="color: #F64E60;">Hibás adatok!</span></div></div>`; $('#cl__ebox').click(function () { ce__box.classList.replace("popup", "popout"); ce__wrapper.classList.add("fadeout"); setTimeout(() => {ce__wrapper.remove(); $("#tab-credit").load('/includes/profile/credit.php'); $('html').css("overflow-y", "unset");},235); });
            } else { document.body.append(c__wrapper); c__wrapper.append(c__box); $('html').css("overflow-y", "hidden");
                c__box.innerHTML = `
                    <div class="flex flex-row flex-align-c flex-justify-con-sb padding-t-1" id="delc__con">
                        <span class="text-primary bold small-med">Kártya törlése</span>
                        <span class="text-primary pointer" aria-label="Bezárás" id="cl__box"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"><rect opacity="0.3" x="2" y="2" width="20" height="20" rx="5" fill="currentColor"/><rect x="7" y="15.3137" width="12" height="2" rx="1" transform="rotate(-45 7 15.3137)" fill="currentColor"/><rect x="8.41422" y="7" width="12" height="2" rx="1" transform="rotate(45 8.41422 7)" fill="currentColor"/></svg></span>
                    </div><br>
                    <div class="flex flex-col gap-1 feat__body prs__con" id="prs__con">
                        <span class="text-secondary text-align-c w-100" style="font-size: .80rem !important">Kártyája törléséhez meg kell adni a fiókja jelszavát, hogy igazolja azonosságát. Törlés után kártyáját már nem használhatja fel további tranzakciók során.</span>
                        <div class="flex flex-col flex-align-c w-fa col-05">
                            <span class="text-primary prst__trig w-fa" style="font-size: .80rem !important;">Adja meg jelszavát</span>
                            <input type="password" class="flex w-fa text-primary border-soft background-bg padding-1-05 outline-none border-none" style="font-size: .75rem !important;" name="delcrd__confp" id="delcrd__confp" placeholder="Jelenlegi jelszó" autocomplete="password"><div class="flex flex-row w-fa flex-align-e flex-justify-con-fe"><span class="text-danger smaller-light" id="delcardp__ind"></span></div>
                        </div>
                        <div class="flex flex-row w-100">
                            <label class="checkbox__con flex flex-align-c" id="delcard__conf">
                                <label class="text-secondary small-med pointer user-select-none" for="delcard__accept">Kívánom elvégezni a következő kártya törlését.</label>
                                <input type="checkbox" name="delcard__accept" id="delcard__accept"><span class="ch__checkmark"></span>
                            </label>
                        </div>
                        <div id="fredel__warn"></div>
                        <div class="flex flex-row flex-align-fe flex-justify-con-fe"><span class="button button-disabled pointer" style="font-size: .80rem !important;" id="delcard__button">Törlés</span></div>
                    </div>
                `;
                $.ajax({ enctype: "multipart/form-data", type: "POST", url: "/assets/php/profile/get__subscription.php", dataType: 'json', contentType: false, processData: false,
                    success: function(subdata) {
                        if (subdata < 2) {
                            document.getElementById('fredel__warn').innerHTML = `
                            <div class="flex flex-row-d-col-m flex-align-c flex-justify-con-sb border-soft border-warning-dotted warning-bg padding-1">
                                <div class="flex flex-row-d-col-m flex-align-c gap-1">
                                    <div class="flex flex-row flex-align-c gap-1">
                                        <div class="flex flex-col flex-align-c flex-justify-con-fs gap-05">
                                            <span class="bold w-100" style="font-size: 1rem !important;">Kártya eltávolítása</span>
                                            <span class="text-secondary" style="font-size: .75rem !important;">Ön jelenleg nincs előfizetve egy kártyabővítő csomagunkra sem, így a kártyája törlésénel, nem tud majd újabb kártyát hozzáadni a törölt helyett. Amennyiben mégis szeretne több kártyát csatolni fiókjához, váltson csomagot, vagy 3 hónap után automatikusan felszabadul 1 törölt kártyája által lefoglalt hely.</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            `;
                        }
                    }
                });
                var con = document.getElementById('delc__con');var mc = new Hammer(con);mc.get('pan').set({ direction: Hammer.DIRECTION_ALL });mc.on("pandown", function(ev) { $('#cl__box').click(); });
                $("#delcard__conf").click(() => {
                    if (document.getElementById("delcard__accept").checked) { document.getElementById("delcard__button").classList.replace("button-disabled", "button-primary");
                    $("#delcard__button").click(() => { const delcard__err = [];
                        if (!$("#delcrd__confp").val().match(/^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*[!@#=\$%\^&\*])(?=.{8,})/)) { document.getElementById("delcardp__ind").textContent = "Érvénytelen kitöltés";  delcard__err.push("password"); } else { document.getElementById("delcardp__ind").textContent = ""; }
                        if (delcard__err.length < 1) { var delcp__data = new FormData(); delcp__data.append("original", $("#delcrd__confp").val()); delcp__data.append('id', guid); var ce__wrapper = document.createElement('div'); ce__wrapper.classList = "wrapper_dark fadein"; var ce__box = document.createElement('div'); ce__box.classList = "d__confirm de__confirm popup fixed flex flex-col border-soft item-bg box-shadow padding-1"; ce__box.id = "delc__incon";
                            $.ajax({ enctype: "multipart/form-data", type: "POST", url: "/admin/users/credit/get__password.php", data: delcp__data, dataType: 'json', contentType: false, processData: false,
                                beforeSend: function () { document.body.append(ce__wrapper); ce__wrapper.append(ce__box);
                                ce__box.innerHTML = `
                                <div class="flex flex-col flex-align-c flex-justify-con-c text-muted gap-1">
                                    <svg class='wizard_input_loading' xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="128px" height="128px" viewBox="0 0 24 24" version="1.1"><g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"><g><polygon points="0 0 24 0 24 24 0 24"/></g><path d="M12,4 L12,6 C8.6862915,6 6,8.6862915 6,12 C6,15.3137085 8.6862915,18 12,18 C15.3137085,18 18,15.3137085 18,12 C18,10.9603196 17.7360885,9.96126435 17.2402578,9.07513926 L18.9856052,8.09853149 C19.6473536,9.28117708 20,10.6161442 20,12 C20,16.418278 16.418278,20 12,20 C7.581722,20 4,16.418278 4,12 C4,7.581722 7.581722,4 12,4 Z" fill="currentColor" fill-rule="nonzero" opacity="0.4" transform="translate(12.000000, 12.000000) scale(-1, 1) translate(-12.000000, -12.000000) "/></g></svg>
                                    <div class="flex flex-col gap-025 flex-align-c w-100">
                                        <span class="bold small">Kártya eltávolítása</span>
                                        <span class="small-med italics">Jelszó hitelesítése folyamatban...</span>
                                    </div>
                                    <div class="flex flex-row flex-justify-con-fe w-fa">
                                        <span class="button button-primary pointer" style="font-size: .80rem !important;" id="cl__ebox">Bezárás</span>
                                    </div>
                                </div>`;  $('#cl__ebox').click(function () { ce__box.classList.replace("popup", "popout"); ce__wrapper.classList.add("fadeout"); setTimeout(() => {ce__wrapper.remove();},235); });
                                $('#cl__ebox').click(function () { ce__box.classList.replace("popup", "popout"); ce__wrapper.classList.add("fadeout"); setTimeout(() => {c__wrapper.remove(); ce__box.remove(); ce__wrapper.remove(); $("#tab-credit").load('/includes/profile/credit.php'); $('html').css("overflow-y", "unset");},235); });
                                }, success: function(data) { console.log(data);
                                    if (data === 200) { var cid__data = new FormData(); cid__data.append("cid", credid); cid__data.append("id", guid);
                                        $.ajax({url: "https://api.ipdata.co?api-key=739837e232548988c86b954108794b57bd3e1dbcd6eb550bfa53e544", dataType: 'json',
                                            success: function (api) { cid__data.append("ip", api.ip);
                                                $.ajax({ enctype: "multipart/form-data", type: "POST", url: "/admin/users/credit/delete__credit.php", data: cid__data, dataType: 'json', contentType: false, processData: false,
                                                    success: function(data) { console.log(data);
                                                        if (data === 200) {
                                                            ce__box.innerHTML = `
                                                            <div class="flex flex-col flex-align-c flex-justify-con-c text-success gap-1">
                                                                <svg width="128" height="128" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><rect opacity="0.3" x="2" y="2" width="20" height="20" rx="10" fill="currentColor"/><path d="M10.4343 12.4343L8.75 10.75C8.33579 10.3358 7.66421 10.3358 7.25 10.75C6.83579 11.1642 6.83579 11.8358 7.25 12.25L10.2929 15.2929C10.6834 15.6834 11.3166 15.6834 11.7071 15.2929L17.25 9.75C17.6642 9.33579 17.6642 8.66421 17.25 8.25C16.8358 7.83579 16.1642 7.83579 15.75 8.25L11.5657 12.4343C11.2533 12.7467 10.7467 12.7467 10.4343 12.4343Z" fill="currentColor"/></svg>
                                                                <div class="flex flex-col gap-025 flex-align-c w-100">
                                                                    <span class="bold small">Kártya eltávolítása</span>
                                                                    <span class="small-med italics">Kártya eltávolítása sikeresen megtörtént</span>
                                                                </div>
                                                                <div class="flex flex-row flex-justify-con-fe w-fa">
                                                                    <span class="button button-primary pointer" style="font-size: .80rem !important;" id="cl__ebox">Bezárás</span>
                                                                </div>
                                                            </div>`; $('#intab-cards').click();
                                                            $('#cl__ebox').click(function () { ce__box.classList.replace("popup", "popout"); ce__wrapper.classList.add("fadeout"); setTimeout(() => {c__wrapper.remove(); ce__box.remove(); ce__wrapper.remove(); $("#tab-credit").load('/includes/profile/credit.php'); $('html').css("overflow-y", "unset");},235); });
                                                        } else { ce__box.innerHTML = `<div class="flex flex-col flex-align-c flex-justify-con-c"><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="8rem" height="8rem" viewBox="0 0 24 24" version="1.1"><g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"><rect x="0" y="0" width="24" height="24"/><circle fill="#F64E60" opacity="0.3" cx="12" cy="12" r="10"/><path d="M12.0355339,10.6213203 L14.863961,7.79289322 C15.2544853,7.40236893 15.8876503,7.40236893 16.2781746,7.79289322 C16.6686989,8.18341751 16.6686989,8.81658249 16.2781746,9.20710678 L13.4497475,12.0355339 L16.2781746,14.863961 C16.6686989,15.2544853 16.6686989,15.8876503 16.2781746,16.2781746 C15.8876503,16.6686989 15.2544853,16.6686989 14.863961,16.2781746 L12.0355339,13.4497475 L9.20710678,16.2781746 C8.81658249,16.6686989 8.18341751,16.6686989 7.79289322,16.2781746 C7.40236893,15.8876503 7.40236893,15.2544853 7.79289322,14.863961 L10.6213203,12.0355339 L7.79289322,9.20710678 C7.40236893,8.81658249 7.40236893,8.18341751 7.79289322,7.79289322 C8.18341751,7.40236893 8.81658249,7.40236893 9.20710678,7.79289322 L12.0355339,10.6213203 Z" fill="#F64E60"/></g></svg><span class="bold text-danger small">Hiba történt a folyamat közben</span></div><div class="flex flex-col"><div class="flex flex-col gap-05"><span class="flex flex-align-c flex-justify-con-c w-fc margin-auto danger-bg danger-bg-hover padding-05 border-soft pointer user-select-none" id="cl__ebox">Bezárás</span></div></div>`;
                                                            $('#cl__ebox').click(function () { ce__box.classList.replace("popup", "popout"); ce__wrapper.classList.add("fadeout"); setTimeout(() => {c__wrapper.remove(); $("#tab-credit").load('/includes/profile/credit.php'); $('html').css("overflow-y", "unset");},235); });
                                                        }
                                                    }, error: function(data) { console.log(data);
                                                        ce__box.innerHTML = `
                                                        <div class="flex flex-col flex-align-c flex-justify-con-c text-danger gap-1">
                                                            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="8rem" height="8rem" viewBox="0 0 24 24" version="1.1"><g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"><rect x="0" y="0" width="24" height="24"></rect><path d="M11.1669899,4.49941818 L2.82535718,19.5143571 C2.557144,19.9971408 2.7310878,20.6059441 3.21387153,20.8741573 C3.36242953,20.9566895 3.52957021,21 3.69951446,21 L21.2169432,21 C21.7692279,21 22.2169432,20.5522847 22.2169432,20 C22.2169432,19.8159952 22.1661743,19.6355579 22.070225,19.47855 L12.894429,4.4636111 C12.6064401,3.99235656 11.9909517,3.84379039 11.5196972,4.13177928 C11.3723594,4.22181902 11.2508468,4.34847583 11.1669899,4.49941818 Z" fill="currentColor" opacity="0.3"></path><rect fill="currentColor" x="11" y="9" width="2" height="7" rx="1"></rect><rect fill="currentColor" x="11" y="17" width="2" height="2" rx="1"></rect></g></svg>
                                                            <div class="flex flex-col gap-025 flex-align-c w-100">
                                                                <span class="bold small">Kártya eltávolítása</span>
                                                                <span class="small-med italics">Kártya eltávolítása sikertelen.</span>
                                                            </div>
                                                            <div class="flex flex-row flex-justify-con-fe w-fa">
                                                                <span class="button button-primary pointer" style="font-size: .80rem !important;" id="cl__ebox">Bezárás</span>
                                                            </div>
                                                        </div>`;
                                                    }
                                                });
                                            }, error: function (e) {
                                                ce__box.innerHTML = `
                                                <div class="flex flex-col flex-align-c flex-justify-con-c text-danger">
                                                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="8rem" height="8rem" viewBox="0 0 24 24" version="1.1"><g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"><rect x="0" y="0" width="24" height="24"></rect><path d="M11.1669899,4.49941818 L2.82535718,19.5143571 C2.557144,19.9971408 2.7310878,20.6059441 3.21387153,20.8741573 C3.36242953,20.9566895 3.52957021,21 3.69951446,21 L21.2169432,21 C21.7692279,21 22.2169432,20.5522847 22.2169432,20 C22.2169432,19.8159952 22.1661743,19.6355579 22.070225,19.47855 L12.894429,4.4636111 C12.6064401,3.99235656 11.9909517,3.84379039 11.5196972,4.13177928 C11.3723594,4.22181902 11.2508468,4.34847583 11.1669899,4.49941818 Z" fill="currentColor" opacity="0.3"></path><rect fill="currentColor" x="11" y="9" width="2" height="7" rx="1"></rect><rect fill="currentColor" x="11" y="17" width="2" height="2" rx="1"></rect></g></svg>
                                                    <div class="flex flex-col gap-1 flex-align-c w-100">
                                                        <span class="bold text-danger small">Hiba történt!</span>
                                                        <span class="danger-bg danger-bg-hover padding-05 border-soft pointer user-select-none" id="cl__ebox">Bezárás</span>
                                                    </div>
                                                </div>`;$('#cl__ebox').click(function () { ce__box.classList.replace("popup", "popout"); ce__wrapper.classList.add("fadeout"); setTimeout(() => {c__wrapper.remove(); ce__box.remove(); ce__wrapper.remove(); $("#tab-credit").load('/includes/profile/credit.php'); $('html').css("overflow-y", "unset");},235); });
                                            }
                                        });
                                        var con = document.getElementById('delc__incon');var mc = new Hammer(con);mc.get('pan').set({ direction: Hammer.DIRECTION_ALL });mc.on("pandown", function(ev) { $('#cl__ebox').click(); });
                                    } else {
                                        ce__box.innerHTML = `
                                        <div class="flex flex-col flex-align-c flex-justify-con-c text-danger gap-1">
                                            <svg width="128" height="128" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><rect opacity="0.3" x="2" y="2" width="20" height="20" rx="10" fill="currentColor"/><rect x="11" y="14" width="7" height="2" rx="1" transform="rotate(-90 11 14)" fill="currentColor"/><rect x="11" y="17" width="2" height="2" rx="1" transform="rotate(-90 11 17)" fill="currentColor"/></svg>
                                            <div class="flex flex-col gap-025 flex-align-c w-100">
                                                <span class="bold small">Kártya eltávolítása</span>
                                                <span class="small-med italics">A megadott jelszava helytelen!</span>
                                            </div>
                                            <div class="flex flex-row flex-justify-con-fe w-fa">
                                                <span class="button button-primary pointer" style="font-size: .80rem !important;" id="cl__ebox">Bezárás</span>
                                            </div>
                                        </div>`;
                                        $('#cl__ebox').click(function () { ce__box.classList.replace("popup", "popout"); ce__wrapper.classList.add("fadeout"); setTimeout(() => {ce__wrapper.remove();},235); });
                                    }
                                }, error: function (data) { console.log(data);
                                    ce__box.innerHTML = `
                                    <div class="flex flex-col flex-align-c flex-justify-con-c text-danger">
                                        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="8rem" height="8rem" viewBox="0 0 24 24" version="1.1"><g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"><rect x="0" y="0" width="24" height="24"></rect><path d="M11.1669899,4.49941818 L2.82535718,19.5143571 C2.557144,19.9971408 2.7310878,20.6059441 3.21387153,20.8741573 C3.36242953,20.9566895 3.52957021,21 3.69951446,21 L21.2169432,21 C21.7692279,21 22.2169432,20.5522847 22.2169432,20 C22.2169432,19.8159952 22.1661743,19.6355579 22.070225,19.47855 L12.894429,4.4636111 C12.6064401,3.99235656 11.9909517,3.84379039 11.5196972,4.13177928 C11.3723594,4.22181902 11.2508468,4.34847583 11.1669899,4.49941818 Z" fill="currentColor" opacity="0.3"></path><rect fill="currentColor" x="11" y="9" width="2" height="7" rx="1"></rect><rect fill="currentColor" x="11" y="17" width="2" height="2" rx="1"></rect></g></svg>
                                        <div class="flex flex-col gap-1 flex-align-c w-100">
                                            <span class="bold text-danger small">Hiba történt!</span>
                                            <span class="danger-bg danger-bg-hover padding-05 border-soft pointer user-select-none" id="cl__ebox">Bezárás</span>
                                        </div>
                                    </div>`;$('#cl__ebox').click(function () { ce__box.classList.replace("popup", "popout"); ce__wrapper.classList.add("fadeout"); setTimeout(() => {c__wrapper.remove(); ce__box.remove(); ce__wrapper.remove(); $("#tab-credit").load('/includes/profile/credit.php'); $('html').css("overflow-y", "unset");},235); });
                                }
                            })
                        }
                    });
                    } else { $("#delcard__button").off('click'); document.getElementById("delcard__button").classList.replace("button-primary", "button-disabled"); }
                });
                $('#cl__box').click(function () { c__box.classList.replace("popup", "popout"); c__wrapper.classList.add("fadeout"); setTimeout(() => {c__wrapper.remove(); $("#tab-credit").load('/includes/profile/credit.php'); $('html').css("overflow-y", "unset");},235); });
            }
        }, error: function (data) { return 0; }
    });
}
var pr__con = document.createElement('div'); pr__con.classList = "flex flex-col fadein card__primcon border-soft box-shadow-sh background-bg padding-05 absolute w-mc user-select-none"; var primCc = 1;
function __setprimary (cid) { var credid = cid.split('_')[1]; primCc++; pr__con.classList.replace('fadeout', 'fadein');
    if (primCc % 2 == 0) { 
        $.ajax({ enctype: "multipart/form-data", type: "POST", url: "/assets/php/profile/get__subscription.php", dataType: 'json', contentType: false, processData: false,
            success: function(data) {
                if (data < 3) { pr__con.innerHTML = `<span class="flex flex-row padding-05 border-soft text-primary smaller-light" id="setpbtn${credid}">Beállítás elsődlegesnek</span>`; }
                if (data > 2) { pr__con.innerHTML = `
                    <span class="flex flex-row padding-05 border-soft text-primary smaller-light" id="setpbtn${credid}">Beállítás elsődlegesnek</span>
                    <span class="flex flex-row padding-05 border-soft text-primary smaller-light" id="setsbtn${credid}">Beállítás másodlagosnak</span>
                    `;
                }
                document.getElementById(cid).append(pr__con);
                $("#setpbtn"+credid).click(() => { var cid__data = new FormData(); cid__data.append('cid', credid);
                    $.ajax({ enctype: "multipart/form-data", type: "POST", url: "/assets/php/profile/setp__card.php", data: cid__data, dataType: 'json', contentType: false, processData: false,
                        success: function(data) {
                            if (data === 200) { $("#tab-credit").load('/includes/profile/credit.php'); }
                            else { var ce__wrapper = document.createElement('div'); ce__wrapper.classList = "wrapper_dark fadein"; var ce__box = document.createElement('div'); ce__box.classList = "d__confirm de__confirm popup fixed flex flex-col border-soft item-bg box-shadow padding-1"; document.body.append(ce__wrapper); ce__wrapper.append(ce__box); $('html').css("overflow-y", "hidden");
                                ce__box.innerHTML = `<div class="flex flex-col gap-1 feat__body prs__con" id="prs__con"><div class="flex flex-col flex-align-c flex-justify-con-c"><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="8rem" height="8rem" viewBox="0 0 24 24" version="1.1"><g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"><rect x="0" y="0" width="24" height="24"></rect><circle fill="#F64E60" opacity="0.3" cx="12" cy="12" r="10"></circle><path d="M12.0355339,10.6213203 L14.863961,7.79289322 C15.2544853,7.40236893 15.8876503,7.40236893 16.2781746,7.79289322 C16.6686989,8.18341751 16.6686989,8.81658249 16.2781746,9.20710678 L13.4497475,12.0355339 L16.2781746,14.863961 C16.6686989,15.2544853 16.6686989,15.8876503 16.2781746,16.2781746 C15.8876503,16.6686989 15.2544853,16.6686989 14.863961,16.2781746 L12.0355339,13.4497475 L9.20710678,16.2781746 C8.81658249,16.6686989 8.18341751,16.6686989 7.79289322,16.2781746 C7.40236893,15.8876503 7.40236893,15.2544853 7.79289322,14.863961 L10.6213203,12.0355339 L7.79289322,9.20710678 C7.40236893,8.81658249 7.40236893,8.18341751 7.79289322,7.79289322 C8.18341751,7.40236893 8.81658249,7.40236893 9.20710678,7.79289322 L12.0355339,10.6213203 Z" fill="#F64E60"></path></g></svg><span class="bold small" style="color: #F64E60;">Sikertelen művelet!</span></div><div class="flex flex-col flex-align-c flex-justify-con-c"><span class="text-secondary w-100 text-align-c small-med"></span><span class="button button-secondary" style="font-size: .75rem !important;" id="cl__ebox">Bezárás</span></div></div>`;
                                $('#cl__ebox').click(function () { ce__box.classList.replace("popup", "popout"); ce__wrapper.classList.add("fadeout"); setTimeout(() => {ce__wrapper.remove(); $("#tab-credit").load('/includes/profile/credit.php'); $('html').css("overflow-y", "unset");},235); });
                            }
                        }, error: function (data) {
                            var ce__wrapper = document.createElement('div'); ce__wrapper.classList = "wrapper_dark fadein"; var ce__box = document.createElement('div'); ce__box.classList = "d__confirm de__confirm popup fixed flex flex-col border-soft item-bg box-shadow padding-1"; document.body.append(ce__wrapper); ce__wrapper.append(ce__box); $('html').css("overflow-y", "hidden");
                            ce__box.innerHTML = `<div class="flex flex-col gap-1 feat__body prs__con" id="prs__con"><div class="flex flex-col flex-align-c flex-justify-con-c"><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="8rem" height="8rem" viewBox="0 0 24 24" version="1.1"><g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"><rect x="0" y="0" width="24" height="24"></rect><circle fill="#F64E60" opacity="0.3" cx="12" cy="12" r="10"></circle><path d="M12.0355339,10.6213203 L14.863961,7.79289322 C15.2544853,7.40236893 15.8876503,7.40236893 16.2781746,7.79289322 C16.6686989,8.18341751 16.6686989,8.81658249 16.2781746,9.20710678 L13.4497475,12.0355339 L16.2781746,14.863961 C16.6686989,15.2544853 16.6686989,15.8876503 16.2781746,16.2781746 C15.8876503,16.6686989 15.2544853,16.6686989 14.863961,16.2781746 L12.0355339,13.4497475 L9.20710678,16.2781746 C8.81658249,16.6686989 8.18341751,16.6686989 7.79289322,16.2781746 C7.40236893,15.8876503 7.40236893,15.2544853 7.79289322,14.863961 L10.6213203,12.0355339 L7.79289322,9.20710678 C7.40236893,8.81658249 7.40236893,8.18341751 7.79289322,7.79289322 C8.18341751,7.40236893 8.81658249,7.40236893 9.20710678,7.79289322 L12.0355339,10.6213203 Z" fill="#F64E60"></path></g></svg><span class="bold small" style="color: #F64E60;">Sikertelen művelet!</span></div><div class="flex flex-col flex-align-c flex-justify-con-c"><span class="text-secondary w-100 text-align-c small-med"></span><span class="button button-secondary" style="font-size: .75rem !important;" id="cl__ebox">Bezárás</span></div></div>`;
                            $('#cl__ebox').click(function () { ce__box.classList.replace("popup", "popout"); ce__wrapper.classList.add("fadeout"); setTimeout(() => {ce__wrapper.remove(); $("#tab-credit").load('/includes/profile/credit.php'); $('html').css("overflow-y", "unset");},235); });
                        }
                    });
                });
            }, error: function (err) { console.log(err); }
        });
    } else { pr__con.classList.replace('fadein', 'fadeout'); setTimeout(() => { pr__con.remove(); }, 200); }

}

function changeSubs(sub) { var subto = sub.split('_')[1]; var gsData = new FormData(); gsData.append("uid", guid);
    $.ajax({ enctype: "multipart/form-data", type: "POST", url: "/assets/php/profile/get__subscription__a.php", data: gsData, dataType: 'json', contentType: false, processData: false,
        success: function(subdata) {
            var c__wrapper = document.createElement('div'); c__wrapper.classList = "wrapper_dark fadein"; var c__box = document.createElement('div'); c__box.id = "setsb__con"; c__box.classList = "d__confirm popup fixed flex flex-col border-soft item-bg box-shadow padding-1 padding-t-0";
            if (subto == 'free') { subid = 1; } else if (subto == 'loyal') { subid = 2; } else if (subto == 'enterprise') { subid = 3; }
            if (subid == subdata) {
                c__box.innerHTML = `<div class="flex flex-col flex-align-c flex-justify-con-c"><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="8rem" height="8rem" viewBox="0 0 24 24" version="1.1"><g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"><rect x="0" y="0" width="24" height="24"/><circle fill="#F64E60" opacity="0.3" cx="12" cy="12" r="10"/><path d="M12.0355339,10.6213203 L14.863961,7.79289322 C15.2544853,7.40236893 15.8876503,7.40236893 16.2781746,7.79289322 C16.6686989,8.18341751 16.6686989,8.81658249 16.2781746,9.20710678 L13.4497475,12.0355339 L16.2781746,14.863961 C16.6686989,15.2544853 16.6686989,15.8876503 16.2781746,16.2781746 C15.8876503,16.6686989 15.2544853,16.6686989 14.863961,16.2781746 L12.0355339,13.4497475 L9.20710678,16.2781746 C8.81658249,16.6686989 8.18341751,16.6686989 7.79289322,16.2781746 C7.40236893,15.8876503 7.40236893,15.2544853 7.79289322,14.863961 L10.6213203,12.0355339 L7.79289322,9.20710678 C7.40236893,8.81658249 7.40236893,8.18341751 7.79289322,7.79289322 C8.18341751,7.40236893 8.81658249,7.40236893 9.20710678,7.79289322 L12.0355339,10.6213203 Z" fill="#F64E60"/></g></svg><span class="bold text-danger small">Erre a csomagra már fel van iratkozva.</span></div><div class="flex flex-col"><div class="flex flex-col gap-05"><br><span class="flex flex-align-c flex-justify-con-c w-fc margin-auto danger-bg danger-bg-hover padding-05 border-soft pointer user-select-none" id="cl__box">Bezárás</span></div></div>`;
                document.body.append(c__wrapper); c__wrapper.append(c__box); $('html').css("overflow-y", "hidden");
                var con = document.getElementById('setsb__con');var mc = new Hammer(con);mc.get('pan').set({ direction: Hammer.DIRECTION_ALL });mc.on("pandown", function(ev) { $('#cl__box').click(); });
            } else {
                c__box.innerHTML = `
                <div class="flex flex-row flex-align-c flex-justify-con-sb padding-t-1" id="setsb__con">
                    <span class="text-primary bold">Előfizetés módosítása</span>
                    <div class="flex flex-row flex-align-c gap-05">
                        <span class="text-primary pointer" role="button" aria-label="Bezárás" id="cl__box"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"><rect opacity="0.3" x="2" y="2" width="20" height="20" rx="5" fill="currentColor"/><rect x="7" y="15.3137" width="12" height="2" rx="1" transform="rotate(-45 7 15.3137)" fill="currentColor"/><rect x="8.41422" y="7" width="12" height="2" rx="1" transform="rotate(45 8.41422 7)" fill="currentColor"/></svg></span>
                    </div>
                </div><br><hr style="border: 1px solid var(--background);" class="w-fa"><br>
                <div class="flex flex-col gap-1 w-fa">
                    <span class="text-muted text-align-c w-fa" style="font-size: .85rem !important;">A csomagváltást követően a bizonyos funkciók elérhetőek és/vagy elérhetetlenek lesznek a felhasználó számára.</span>
                    <div class="flex flex-col flex-align-c gap-05" id="subdet__con"></div>
                </div><br>
                <div class="flex flex-row flex-align-c flex-justify-con-fe">
                    <span class="button button-primary" style="font-size: .75rem !important;" id="subc__payment">Váltás</span>
                </div>
                `;
                var subd__dt = new FormData(); subd__dt.append("subid", subid);
                $.ajax({ enctype: "multipart/form-data", type: "POST", url: "/assets/php/profile/sub__details.php", data: subd__dt, dataType: 'json', contentType: false, processData: false,
                    success: function(det) { var subdet = det[0].available;
                        for (let i = 0; i < subdet.length; i++) {
                            document.getElementById('subdet__con').innerHTML += `<span class="flex flex-row flex-align-c flex-justify-con-sb w-fa">
                                <span class="text-primary bold" style="font-size: .75rem !important;">${subdet[i]}</span>
                                <span style="color:#3db875;"><svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none"><rect opacity="0.3" x="2" y="2" width="20" height="20" rx="10" fill="currentColor"></rect><path d="M10.4343 12.4343L8.75 10.75C8.33579 10.3358 7.66421 10.3358 7.25 10.75C6.83579 11.1642 6.83579 11.8358 7.25 12.25L10.2929 15.2929C10.6834 15.6834 11.3166 15.6834 11.7071 15.2929L17.25 9.75C17.6642 9.33579 17.6642 8.66421 17.25 8.25C16.8358 7.83579 16.1642 7.83579 15.75 8.25L11.5657 12.4343C11.2533 12.7467 10.7467 12.7467 10.4343 12.4343Z" fill="currentColor"></path></svg></span>
                            </span>`;
                        }
                        $("#subc__payment").click(() => { var ce__wrapper = document.createElement('div'); ce__wrapper.classList = "wrapper_dark fadein"; var ce__box = document.createElement('div'); ce__box.id = "setsb__incon"; ce__box.classList = "d__confirm de__confirm popup fixed flex flex-col border-soft item-bg box-shadow padding-1 padding-t-0"; ce__box.classList.replace("popout", "popup");
                            var passdata = new FormData(); passdata.append('sub', subto);
                            $.ajax({url: "https://api.ipdata.co?api-key=739837e232548988c86b954108794b57bd3e1dbcd6eb550bfa53e544", dataType: 'json',
                                beforeSend: function () {
                                    ce__box.innerHTML = `
                                    <div class="flex flex-row flex-align-c flex-justify-con-fe padding-t-1" id="setscp__incon">
                                        <div class="flex flex-row flex-align-c gap-05">
                                            <span class="text-primary pointer" role="button" aria-label="Bezárás" id="cl__ebox"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"><rect opacity="0.3" x="2" y="2" width="20" height="20" rx="5" fill="currentColor"/><rect x="7" y="15.3137" width="12" height="2" rx="1" transform="rotate(-45 7 15.3137)" fill="currentColor"/><rect x="8.41422" y="7" width="12" height="2" rx="1" transform="rotate(45 8.41422 7)" fill="currentColor"/></svg></span>
                                        </div>
                                    </div><br>
                                    <div class="flex flex-col gap-1">
                                        <div class="flex flex-row flex-wrap flex-justify-con-c gap-1" id="chfcard__con">
                                            <div class="flex flex-col flex-align-c flex-juftify-con-c w-fa text-muted">
                                                <svg class='wizard_input_loading' xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="64px" height="64px" viewBox="0 0 24 24" version="1.1"><g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"><g><polygon points="0 0 24 0 24 24 0 24"/></g><path d="M12,4 L12,6 C8.6862915,6 6,8.6862915 6,12 C6,15.3137085 8.6862915,18 12,18 C15.3137085,18 18,15.3137085 18,12 C18,10.9603196 17.7360885,9.96126435 17.2402578,9.07513926 L18.9856052,8.09853149 C19.6473536,9.28117708 20,10.6161442 20,12 C20,16.418278 16.418278,20 12,20 C7.581722,20 4,16.418278 4,12 C4,7.581722 7.581722,4 12,4 Z" fill="currentColor" fill-rule="nonzero" opacity="0.4" transform="translate(12.000000, 12.000000) scale(-1, 1) translate(-12.000000, -12.000000) "/></g></svg>
                                                <small>Betöltés</small>
                                            </div>
                                        </div>
                                    </div>
                                    `; c__wrapper.append(ce__wrapper); ce__wrapper.append(ce__box); var con = document.getElementById('setscp__incon');var mc = new Hammer(con);mc.get('pan').set({ direction: Hammer.DIRECTION_ALL });mc.on("pandown", function(ev) { $('#cl__ebox').click(); }); $('#cl__ebox').click(function () { ce__box.classList.replace("popup", "popout"); ce__wrapper.classList.add("fadeout"); setTimeout(() => {ce__wrapper.remove();},235); });
                                }, success: function (api) { passdata.append('ip', api.ip); passdata.append('id', guid);
                                    $.ajax({ enctype: "multipart/form-data", type: "POST", url: "/assets/php/profile/set__subscription__a.php", data: passdata, dataType: "json", contentType: false, processData: false,
                                        beforeSend: function () {
                                            ce__box.innerHTML = `
                                            <div class="flex flex-row flex-align-c flex-justify-con-fe padding-t-1" id="setscp__incon">
                                                <div class="flex flex-row flex-align-c gap-05">
                                                    <span class="text-primary pointer" role="button" aria-label="Bezárás" id="cl__ebox"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"><rect opacity="0.3" x="2" y="2" width="20" height="20" rx="5" fill="currentColor"/><rect x="7" y="15.3137" width="12" height="2" rx="1" transform="rotate(-45 7 15.3137)" fill="currentColor"/><rect x="8.41422" y="7" width="12" height="2" rx="1" transform="rotate(45 8.41422 7)" fill="currentColor"/></svg></span>
                                                </div>
                                            </div><br>
                                            <div class="flex flex-col gap-1">
                                                <div class="flex flex-row flex-wrap flex-justify-con-c gap-1" id="chfcard__con">
                                                    <div class="flex flex-col flex-align-c flex-juftify-con-c w-fa text-muted">
                                                        <svg class='wizard_input_loading' xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="64px" height="64px" viewBox="0 0 24 24" version="1.1"><g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"><g><polygon points="0 0 24 0 24 24 0 24"/></g><path d="M12,4 L12,6 C8.6862915,6 6,8.6862915 6,12 C6,15.3137085 8.6862915,18 12,18 C15.3137085,18 18,15.3137085 18,12 C18,10.9603196 17.7360885,9.96126435 17.2402578,9.07513926 L18.9856052,8.09853149 C19.6473536,9.28117708 20,10.6161442 20,12 C20,16.418278 16.418278,20 12,20 C7.581722,20 4,16.418278 4,12 C4,7.581722 7.581722,4 12,4 Z" fill="currentColor" fill-rule="nonzero" opacity="0.4" transform="translate(12.000000, 12.000000) scale(-1, 1) translate(-12.000000, -12.000000) "/></g></svg>
                                                        <small>Betöltés</small>
                                                    </div>
                                                </div>
                                            </div>
                                            `; c__wrapper.append(ce__wrapper); ce__wrapper.append(ce__box); var con = document.getElementById('setscp__incon');var mc = new Hammer(con);mc.get('pan').set({ direction: Hammer.DIRECTION_ALL });mc.on("pandown", function(ev) { $('#cl__ebox').click(); }); $('#cl__ebox').click(function () { ce__box.classList.replace("popup", "popout"); ce__wrapper.classList.add("fadeout"); setTimeout(() => {ce__wrapper.remove();},235); });
                                        }, success: function (data) { console.log(data);
                                            if (data === 200) {
                                                ce__box.innerHTML = `
                                                <div class="flex flex-row flex-align-c flex-justify-con-fe padding-t-1" id="setscp__incon">
                                                    <div class="flex flex-row flex-align-c gap-05">
                                                        <span class="text-primary pointer" role="button" aria-label="Bezárás" id="cl__ebox"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"><rect opacity="0.3" x="2" y="2" width="20" height="20" rx="5" fill="currentColor"/><rect x="7" y="15.3137" width="12" height="2" rx="1" transform="rotate(-45 7 15.3137)" fill="currentColor"/><rect x="8.41422" y="7" width="12" height="2" rx="1" transform="rotate(45 8.41422 7)" fill="currentColor"/></svg></span>
                                                    </div>
                                                </div><br>
                                                <div class="flex flex-col gap-1">
                                                    <div class="flex flex-row flex-wrap flex-justify-con-c gap-1" id="chfcard__con">
                                                        <div class="flex flex-col flex-align-c flex-juftify-con-c w-fa text-success">
                                                            <svg width="128" height="128" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><rect opacity="0.3" x="2" y="2" width="20" height="20" rx="10" fill="currentColor"/><path d="M10.4343 12.4343L8.75 10.75C8.33579 10.3358 7.66421 10.3358 7.25 10.75C6.83579 11.1642 6.83579 11.8358 7.25 12.25L10.2929 15.2929C10.6834 15.6834 11.3166 15.6834 11.7071 15.2929L17.25 9.75C17.6642 9.33579 17.6642 8.66421 17.25 8.25C16.8358 7.83579 16.1642 7.83579 15.75 8.25L11.5657 12.4343C11.2533 12.7467 10.7467 12.7467 10.4343 12.4343Z" fill="currentColor"/></svg>
                                                            <span class="bold">Sikeres váltás</span>
                                                        </div>
                                                    </div>
                                                </div><br>
                                                <div class="flex flex-row flex-align-c flex-justify-con-fe" id="plsubb__con">
                                                    <span class="button button-primary" style="font-size: .75rem !important;" onclick="document.getElementById('cl__ebox').click();">Bezárás</span>
                                                </div>
                                                `; c__wrapper.append(ce__wrapper); ce__wrapper.append(ce__box); var con = document.getElementById('setscp__incon');var mc = new Hammer(con);mc.get('pan').set({ direction: Hammer.DIRECTION_ALL });mc.on("pandown", function(ev) { $('#cl__ebox').click(); }); $('#cl__ebox').click(function () { ce__box.classList.replace("popup", "popout"); ce__wrapper.classList.add("fadeout"); setTimeout(() => {ce__wrapper.remove();},235); }); $('#intab-cards').click();
                                            } else {
                                                ce__box.innerHTML = `
                                                <div class="flex flex-row flex-align-c flex-justify-con-fe padding-t-1" id="setscp__incon">
                                                    <div class="flex flex-row flex-align-c gap-05">
                                                        <span class="text-primary pointer" role="button" aria-label="Bezárás" id="cl__ebox"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"><rect opacity="0.3" x="2" y="2" width="20" height="20" rx="5" fill="currentColor"/><rect x="7" y="15.3137" width="12" height="2" rx="1" transform="rotate(-45 7 15.3137)" fill="currentColor"/><rect x="8.41422" y="7" width="12" height="2" rx="1" transform="rotate(45 8.41422 7)" fill="currentColor"/></svg></span>
                                                    </div>
                                                </div><br>
                                                <div class="flex flex-col gap-1">
                                                    <div class="flex flex-row flex-wrap flex-justify-con-c gap-1" id="chfcard__con">
                                                        <div class="flex flex-col flex-align-c flex-juftify-con-c w-fa text-danger">
                                                            <svg width="128" height="128" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><rect opacity="0.3" x="2" y="2" width="20" height="20" rx="10" fill="currentColor"/><rect x="11" y="14" width="7" height="2" rx="1" transform="rotate(-90 11 14)" fill="currentColor"/><rect x="11" y="17" width="2" height="2" rx="1" transform="rotate(-90 11 17)" fill="currentColor"/></svg>
                                                            <span class="bold">Sikertelen váltás</span>
                                                        </div>
                                                    </div>
                                                </div><br>
                                                <div class="flex flex-row flex-align-c flex-justify-con-fe" id="plsubb__con">
                                                    <span class="button button-primary" style="font-size: .75rem !important;" onclick="document.getElementById('cl__ebox').click();">Bezárás</span>
                                                </div>
                                                `; c__wrapper.append(ce__wrapper); ce__wrapper.append(ce__box); var con = document.getElementById('setscp__incon');var mc = new Hammer(con);mc.get('pan').set({ direction: Hammer.DIRECTION_ALL });mc.on("pandown", function(ev) { $('#cl__ebox').click(); }); $('#cl__ebox').click(function () { ce__box.classList.replace("popup", "popout"); ce__wrapper.classList.add("fadeout"); setTimeout(() => {ce__wrapper.remove();},235); });
                                            }
                                        }, error: function (data) { console.log(data);
                                            ce__box.innerHTML = `
                                                <div class="flex flex-row flex-align-c flex-justify-con-fe padding-t-1" id="setscp__incon">
                                                    <div class="flex flex-row flex-align-c gap-05">
                                                        <span class="text-primary pointer" role="button" aria-label="Bezárás" id="cl__ebox"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"><rect opacity="0.3" x="2" y="2" width="20" height="20" rx="5" fill="currentColor"/><rect x="7" y="15.3137" width="12" height="2" rx="1" transform="rotate(-45 7 15.3137)" fill="currentColor"/><rect x="8.41422" y="7" width="12" height="2" rx="1" transform="rotate(45 8.41422 7)" fill="currentColor"/></svg></span>
                                                    </div>
                                                </div><br>
                                                <div class="flex flex-col gap-1">
                                                    <div class="flex flex-row flex-wrap flex-justify-con-c gap-1" id="chfcard__con">
                                                        <div class="flex flex-col flex-align-c flex-juftify-con-c w-fa text-danger">
                                                            <svg width="128" height="128" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><rect opacity="0.3" x="2" y="2" width="20" height="20" rx="10" fill="currentColor"/><rect x="11" y="14" width="7" height="2" rx="1" transform="rotate(-90 11 14)" fill="currentColor"/><rect x="11" y="17" width="2" height="2" rx="1" transform="rotate(-90 11 17)" fill="currentColor"/></svg>
                                                            <span class="bold">Sikertelen váltás</span>
                                                        </div>
                                                    </div>
                                                </div><br>
                                                <div class="flex flex-row flex-align-c flex-justify-con-fe" id="plsubb__con">
                                                    <span class="button button-primary" style="font-size: .75rem !important;" onclick="document.getElementById('cl__ebox').click();">Bezárás</span>
                                                </div>
                                            `; c__wrapper.append(ce__wrapper); ce__wrapper.append(ce__box); var con = document.getElementById('setscp__incon');var mc = new Hammer(con);mc.get('pan').set({ direction: Hammer.DIRECTION_ALL });mc.on("pandown", function(ev) { $('#cl__ebox').click(); }); $('#cl__ebox').click(function () { ce__box.classList.replace("popup", "popout"); ce__wrapper.classList.add("fadeout"); setTimeout(() => {ce__wrapper.remove();},235); });
                                        }
                                    });
                                }, error: function (e) {
                                    ce__box.innerHTML = `
                                    <div class="flex flex-col flex-align-c flex-justify-con-c text-danger">
                                        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="8rem" height="8rem" viewBox="0 0 24 24" version="1.1"><g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"><rect x="0" y="0" width="24" height="24"></rect><path d="M11.1669899,4.49941818 L2.82535718,19.5143571 C2.557144,19.9971408 2.7310878,20.6059441 3.21387153,20.8741573 C3.36242953,20.9566895 3.52957021,21 3.69951446,21 L21.2169432,21 C21.7692279,21 22.2169432,20.5522847 22.2169432,20 C22.2169432,19.8159952 22.1661743,19.6355579 22.070225,19.47855 L12.894429,4.4636111 C12.6064401,3.99235656 11.9909517,3.84379039 11.5196972,4.13177928 C11.3723594,4.22181902 11.2508468,4.34847583 11.1669899,4.49941818 Z" fill="currentColor" opacity="0.3"></path><rect fill="currentColor" x="11" y="9" width="2" height="7" rx="1"></rect><rect fill="currentColor" x="11" y="17" width="2" height="2" rx="1"></rect></g></svg>
                                        <div class="flex flex-col gap-1 flex-align-c w-100">
                                            <span class="bold text-danger small">Hiba történt!</span>
                                            <span class="danger-bg danger-bg-hover padding-05 border-soft pointer user-select-none" id="cl__ebox">Bezárás</span>
                                        </div>
                                    </div>`;$('#cl__ebox').click(function () { ce__box.classList.replace("popup", "popout"); ce__wrapper.classList.add("fadeout"); setTimeout(() => {c__wrapper.remove(); ce__box.remove(); ce__wrapper.remove(); $("#tab-credit").load('/includes/profile/credit.php'); $('html').css("overflow-y", "unset");},235); });
                                }
                            });
                        });
                    }
                });
                document.body.append(c__wrapper); c__wrapper.append(c__box); $('html').css("overflow-y", "hidden");
                var con = document.getElementById('setsb__con');var mc = new Hammer(con);mc.get('pan').set({ direction: Hammer.DIRECTION_ALL });mc.on("pandown", function(ev) { $('#cl__box').click(); });
            }
            $('#cl__box').click(function () { c__box.classList.replace("popup", "popout"); c__wrapper.classList.add("fadeout"); setTimeout(() => {c__wrapper.remove(); $("#tab-credit").load('/includes/profile/credit.php'); $('html').css("overflow-y", "unset");},235); });
        }
    });
}

function setPaymentMethod (cid) { var credid = cid.split('_')[1]; var cid__data = new FormData(); cid__data.append('cid', credid);
    $.ajax({ enctype: "multipart/form-data", type: "POST", url: "/assets/php/profile/setp__card.php", data: cid__data, dataType: 'json', contentType: false, processData: false,
        success: function(data) {
            if (data === 200) { var actcid = cid; var paycon = document.getElementsByClassName('paymnt__con');                    
                for (let i = 0; i < paycon.length; i++) {
                    if (paycon[i].id.split('_')[1] != credid) { paycon[i].classList.remove("primary-bg"); paycon[i].classList.replace("border-primary-light-dotted", "border-secondary-dotted");
                        paycon[i].lastElementChild.firstElementChild.firstElementChild.classList.replace("item-bg", "primary-bg");
                        var crtsetbtn = document.createElement('span'); crtsetbtn.classList = "primary-bg primary-bg-hover padding-025 border-soft-light text-secondary smaller user-select-none pointer";
                        crtsetbtn.id = "card_"+paycon[i].id.split('_')[1]; crtsetbtn.setAttribute('onclick', 'setPaymentMethod(this.id)'); crtsetbtn.textContent = "Használ"; 
                        var payb = document.getElementsByClassName('paymbtn__con'); var paycbtn = document.getElementById("card_"+paycon[i].id.split('_')[1]);
                        if (!paycon[i].contains(paycbtn)) { paycon[i].firstElementChild.lastElementChild.append(crtsetbtn); } paycon[i].setAttribute('item-status', 'inactive');
                    }
                } document.getElementById(cid).parentNode.parentNode.parentNode.setAttribute('item-status', 'active'); document.getElementById(cid).parentNode.parentNode.parentNode.classList.replace("border-secondary-dotted", "border-primary-light-dotted");document.getElementById(cid).parentNode.parentNode.parentNode.classList.add("primary-bg");document.getElementById(cid).parentNode.parentNode.parentNode.lastElementChild.lastElementChild.firstElementChild.classList.replace("primary-bg", "item-bg"); document.getElementById(cid).remove();
            } else { var ce__wrapper = document.createElement('div'); ce__wrapper.classList = "wrapper_dark fadein"; var ce__box = document.createElement('div'); ce__box.classList = "d__confirm de__confirm popup fixed flex flex-col border-soft item-bg box-shadow padding-1"; document.body.append(ce__wrapper); ce__wrapper.append(ce__box); $('html').css("overflow-y", "hidden");
                ce__box.innerHTML = `<div class="flex flex-col gap-1 feat__body prs__con" id="prs__con"><div class="flex flex-col flex-align-c flex-justify-con-c"><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="8rem" height="8rem" viewBox="0 0 24 24" version="1.1"><g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"><rect x="0" y="0" width="24" height="24"></rect><circle fill="#F64E60" opacity="0.3" cx="12" cy="12" r="10"></circle><path d="M12.0355339,10.6213203 L14.863961,7.79289322 C15.2544853,7.40236893 15.8876503,7.40236893 16.2781746,7.79289322 C16.6686989,8.18341751 16.6686989,8.81658249 16.2781746,9.20710678 L13.4497475,12.0355339 L16.2781746,14.863961 C16.6686989,15.2544853 16.6686989,15.8876503 16.2781746,16.2781746 C15.8876503,16.6686989 15.2544853,16.6686989 14.863961,16.2781746 L12.0355339,13.4497475 L9.20710678,16.2781746 C8.81658249,16.6686989 8.18341751,16.6686989 7.79289322,16.2781746 C7.40236893,15.8876503 7.40236893,15.2544853 7.79289322,14.863961 L10.6213203,12.0355339 L7.79289322,9.20710678 C7.40236893,8.81658249 7.40236893,8.18341751 7.79289322,7.79289322 C8.18341751,7.40236893 8.81658249,7.40236893 9.20710678,7.79289322 L12.0355339,10.6213203 Z" fill="#F64E60"></path></g></svg><span class="bold small" style="color: #F64E60;">Sikertelen művelet!</span></div><div class="flex flex-col flex-align-c flex-justify-con-c"><span class="text-secondary w-100 text-align-c small-med"></span><span class="button button-secondary" style="font-size: .75rem !important;" id="cl__ebox">Bezárás</span></div></div>`;
                $('#cl__ebox').click(function () { ce__box.classList.replace("popup", "popout"); ce__wrapper.classList.add("fadeout"); setTimeout(() => {ce__wrapper.remove(); $("#tab-credit").load('/includes/profile/credit.php'); $('html').css("overflow-y", "unset");},235); });
            }
        }, error: function (data) { var ce__wrapper = document.createElement('div'); ce__wrapper.classList = "wrapper_dark fadein"; var ce__box = document.createElement('div'); ce__box.classList = "d__confirm de__confirm popup fixed flex flex-col border-soft item-bg box-shadow padding-1"; document.body.append(ce__wrapper); ce__wrapper.append(ce__box); $('html').css("overflow-y", "hidden");
            ce__box.innerHTML = `<div class="flex flex-col gap-1 feat__body prs__con" id="prs__con"><div class="flex flex-col flex-align-c flex-justify-con-c"><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="8rem" height="8rem" viewBox="0 0 24 24" version="1.1"><g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"><rect x="0" y="0" width="24" height="24"></rect><circle fill="#F64E60" opacity="0.3" cx="12" cy="12" r="10"></circle><path d="M12.0355339,10.6213203 L14.863961,7.79289322 C15.2544853,7.40236893 15.8876503,7.40236893 16.2781746,7.79289322 C16.6686989,8.18341751 16.6686989,8.81658249 16.2781746,9.20710678 L13.4497475,12.0355339 L16.2781746,14.863961 C16.6686989,15.2544853 16.6686989,15.8876503 16.2781746,16.2781746 C15.8876503,16.6686989 15.2544853,16.6686989 14.863961,16.2781746 L12.0355339,13.4497475 L9.20710678,16.2781746 C8.81658249,16.6686989 8.18341751,16.6686989 7.79289322,16.2781746 C7.40236893,15.8876503 7.40236893,15.2544853 7.79289322,14.863961 L10.6213203,12.0355339 L7.79289322,9.20710678 C7.40236893,8.81658249 7.40236893,8.18341751 7.79289322,7.79289322 C8.18341751,7.40236893 8.81658249,7.40236893 9.20710678,7.79289322 L12.0355339,10.6213203 Z" fill="#F64E60"></path></g></svg><span class="bold small" style="color: #F64E60;">Sikertelen művelet!</span></div><div class="flex flex-col flex-align-c flex-justify-con-c"><span class="text-secondary w-100 text-align-c small-med"></span><span class="button button-secondary" style="font-size: .75rem !important;" id="cl__ebox">Bezárás</span></div></div>`;
            $('#cl__ebox').click(function () { ce__box.classList.replace("popup", "popout"); ce__wrapper.classList.add("fadeout"); setTimeout(() => {ce__wrapper.remove(); $("#tab-credit").load('/includes/profile/credit.php'); $('html').css("overflow-y", "unset");},235); });
        }
    });
}