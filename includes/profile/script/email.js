$("#prsv__email").click(() => { const per__array = [];
    document.body.append(c__wrapper); c__wrapper.append(c__box); $('html').css("overflow-y", "hidden"); var pwd__data = new FormData(); pwd__data.append("password", $("#chpr__cpassword").val());
    c__box.innerHTML = `<div class="flex flex-row flex-align-c flex-justify-con-sb" id="cbh__con"><span class="text-primary bold" id="prs__title"></span><div class="flex flex-row flex-align-c gap-05"><span class="flex" id="prsb__con"></span><span class="button button-secondary small-med" id="cl__box">Bezárás</span></div></div><br><div class="flex flex-col gap-1 feat__body prs__con" id="prs__con"></div>`;
    var notif = document.getElementById("em__notif").checked ? true : false;
    var sm__new__notify = document.getElementById("sm__new__notify").checked ? true : false;
    var sm__upd__profile = document.getElementById("sm__upd__profile").checked ? true : false;
    var sm__new__feedback = document.getElementById("sm__new__feedback").checked ? true : false;
    var sm__oth__order = document.getElementById("sm__oth__order").checked ? true : false;
    var sm__oth__news = document.getElementById("sm__oth__news").checked ? true : false;
    var sm__oth__tips = document.getElementById("sm__oth__tips").checked ? true : false;
    $('#cl__box').click(function () { c__wrapper.remove(); $('html').css("overflow-y", "unset"); });
});

if (document.getElementById("conf__email")) {
    document.getElementById("conf__email").addEventListener("click", function () { document.body.append(c__wrapper); c__wrapper.append(c__box); disableScroll();
        c__box.innerHTML = `
            <div class="flex flex-row flex-align-c flex-justify-con-sb">
                <span class="text-primary bold">Email-cím megerősítése</span>
                <span class="button button-secondary small-med" id="clp__box">Mégsem</span>
            </div><br>
            <div class="flex flex-row flex-align-c flex-justify-con-c text-align-c">
                <span class="text-secondary smaller-light"><b>TIPP:</b> Ha hitelesítő kód nem érkezik meg az e-mail címére, próbálja megnézni a SPAM mappáját.</span>
            </div><br>
            <div class="flex flex-col flex-align-c flex-justify-con-c gap-05 w-50d-100m margin-auto">
                <span class="text-align-l bold small-med w-100" style="color: var(--section-title);">Megerősítő kód</span>
                <input type="text" class="border-soft border-primary uppercase padding-1 large text-align-c flex w-fa" maxlength="9" style="letter-spacing: 0.5rem;" />
                <div class="flex flex-row flex-align-c flex-justify-con-sb w-fa">
                    <span class="flex flex-row flex-align-c text-secondary smaller-light gap-05">Érvényes: <span class="bold" id="emcv__ind">3:00</span></span>
                    <span class="text-align-r bold smaller-light pointer link" style="color: var(--section-title);">Kód újraküldése</span>
                </div>
            </div><br>
        `;
        $('#clp__box').click(function () { c__wrapper.remove(); enableScroll(); });
    });
}