function addCredit (cid) { var creditData = new FormData(); creditData.append('cid', cid); creditData.append("uid", guid);
    var c__wrapper = document.createElement('div'); c__wrapper.classList = "wrapper_dark fadein"; var c__box = document.createElement('div'); c__box.classList = "d__confirm popup fixed flex flex-col border-soft item-bg box-shadow padding-1";
    c__wrapper.classList.add('fadein'); c__wrapper.classList.remove('fadeout'); c__box.classList.add("padding-t-0"); c__box.classList.add('popup'); c__box.classList.remove('popout'); document.body.append(c__wrapper);  c__wrapper.append(c__box); $('html').css("overflow-y", "hidden");
    c__box.innerHTML = `
    <div class="flex flex-row flex-align-c flex-justify-con-sb padding-t-1" id="cbh__con">
        <span class="text-primary bold" id="prs__title">Összeg jóváírása</span>
        <span class="flex text-primary pointer" aria-label="Bezárás" id="cl__box"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"><rect opacity="0.3" x="2" y="2" width="20" height="20" rx="5" fill="currentColor"/><rect x="7" y="15.3137" width="12" height="2" rx="1" transform="rotate(-45 7 15.3137)" fill="currentColor"/><rect x="8.41422" y="7" width="12" height="2" rx="1" transform="rotate(45 8.41422 7)" fill="currentColor"/></svg></span></div>
    </div><br>
    <div class="flex flex-col gap-1 feat__body prs__con" id="prs__con">
        <div class="flex flex-row flex-align-c flex-justify-con-c gap-2 w-fa">
            <div class="flex flex-col flex-justify-con-c flex-align-c">
                <span class="text-primary-light bold text-xxl" id="crd-def">0</span>
                <span class="text-muted smaller-light">Eredeti összeg</span>
            </div>
            <div class="text-primary">
                <svg width="42" height="42" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><rect opacity="0.5" x="18" y="13" width="13" height="2" rx="1" transform="rotate(-180 18 13)" fill="currentColor"/><path d="M15.4343 12.5657L11.25 16.75C10.8358 17.1642 10.8358 17.8358 11.25 18.25C11.6642 18.6642 12.3358 18.6642 12.75 18.25L18.2929 12.7071C18.6834 12.3166 18.6834 11.6834 18.2929 11.2929L12.75 5.75C12.3358 5.33579 11.6642 5.33579 11.25 5.75C10.8358 6.16421 10.8358 6.83579 11.25 7.25L15.4343 11.4343C15.7467 11.7467 15.7467 12.2533 15.4343 12.5657Z" fill="currentColor"/></svg>
            </div>
            <div class="flex flex-col flex-justify-con-c flex-align-c">
                <span class="text-primary-light bold text-xxl" id="crd-new">0</span>
                <span class="text-muted smaller-light">Új egyenleg</span>
            </div>
        </div>
        <div class="flex flex-col flex-align-c flex-justify-con-c margin-auto gap-1 w-60d-100m">
            <textarea id="crd-desc" class="text-primary border-soft-light background-bg padding-05 outline-none border-none w-fa" rows="4" maxlength="2048" placeholder="Egyenleg jóváírásának indoklása" style="font-size: .8rem !important; resize: none;"></textarea>
            <div class="flex flex-row flex-align-c w-fa gap-1">
                <input type="number" class="w-fc text-primary border-soft-light small-med background-bg padding-05 outline-none border-none w-fa" id="crd-inp" min="1" placeholder="Jóváírni kívánt összeg">
                <span class="flex flex-row flex-align-c flex-justify-con-c padding-05 border-soft-light primary-bg primary-bg-hover pointer user-select-none small-med" id="crd-add-cred">Mentés</span>
            </div>
        </div>
    </div><br>
    <div class="flex flex-row flex-align-fe flex-justify-con-r gap-05"><span class="flex smaller-light text-danger user-select-none" id="crd-err"></span></div>
    `; var con = document.getElementById('cbh__con');var mc = new Hammer(con);mc.get('pan').set({ direction: Hammer.DIRECTION_ALL });mc.on("pandown", function(ev) { $('#cl__box').click(); });
    $.ajax({ enctype: "multipart/form-data", type: "POST", url: "/assets/php/profile/get__card__a.php", data: creditData, dataType: 'json', contentType: false, processData: false,
        success: function(data) {
            if (data.value) {
                document.getElementById('crd-def').textContent = formatter.format(data.value);
                $('#crd-inp').on('input', () => {
                    if (document.getElementById('crd-inp').value > 0) {
                        document.getElementById('crd-new').textContent = formatter.format(Number(data.value) + Number(document.getElementById('crd-inp').value));
                    } else { document.getElementById('crd-new').textContent = formatter.format(Number(data.value)); }
                });
                $("#crd-add-cred").click(() => {
                    let nval = Number(document.getElementById('crd-inp').value);
                    var desc = document.getElementById('crd-desc').value;
                    if (nval > 0 && ( desc.length > 32 && desc.length <= 2048) ) { document.getElementById('crd-err').innerHTML = ``; creditData.append("value", nval); creditData.append("desc", desc);
                        $.ajax({url: "https://api.ipdata.co?api-key=739837e232548988c86b954108794b57bd3e1dbcd6eb550bfa53e544", dataType: 'json',
                            beforeSend: function () {
                                document.getElementById("prs__con").innerHTML = `
                                    <div class="flex flex-col flex-align-c flex-justify-con-c text-muted">
                                        <svg class='wizard_input_loading' xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="8rem" height="8rem" viewBox="0 0 24 24" version="1.1"><g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"><g><polygon points="0 0 24 0 24 24 0 24"/></g><path d="M12,4 L12,6 C8.6862915,6 6,8.6862915 6,12 C6,15.3137085 8.6862915,18 12,18 C15.3137085,18 18,15.3137085 18,12 C18,10.9603196 17.7360885,9.96126435 17.2402578,9.07513926 L18.9856052,8.09853149 C19.6473536,9.28117708 20,10.6161442 20,12 C20,16.418278 16.418278,20 12,20 C7.581722,20 4,16.418278 4,12 C4,7.581722 7.581722,4 12,4 Z" fill="currentColor" fill-rule="nonzero" opacity="0.4" transform="translate(12.000000, 12.000000) scale(-1, 1) translate(-12.000000, -12.000000) "/></g></svg>
                                        <span class="bold text-muted smaller-med text-align-c" id="bfs-load-txt">Betöltés</span>
                                    </div>
                                `;
                                setTimeout(() => {
                                    if (document.getElementById('bfs-load-txt')) { document.getElementById('bfs-load-txt').innerHTML += `<br><span>Úgy tűnik, hogy lassú az internetkapcsolata, így a kapcsolódás a szerverhez  több időt vehet igénybe.</span>`; }
                                }, 5000);
                            }, success: function (api) { creditData.append("ip", api.ip);
                                $.ajax({ enctype: "multipart/form-data", type: "POST", url: "/assets/php/profile/credit__card__add.php", data: creditData, dataType: 'json', contentType: false, processData: false,
                                    success: function(data) {
                                        document.getElementById('prs__con').innerHTML = `
                                        <div class="flex flex-col flex-align-c flex-justify-con-c text-success user-select-none">
                                            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="128px" height="128px" viewBox="0 0 24 24" version="1.1"><g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"><rect x="0" y="0" width="24" height="24"/><circle fill="#0f5132" opacity="0.3" cx="12" cy="12" r="10"/><path d="M16.7689447,7.81768175 C17.1457787,7.41393107 17.7785676,7.39211077 18.1823183,7.76894473 C18.5860689,8.1457787 18.6078892,8.77856757 18.2310553,9.18231825 L11.2310553,16.6823183 C10.8654446,17.0740439 10.2560456,17.107974 9.84920863,16.7592566 L6.34920863,13.7592566 C5.92988278,13.3998345 5.88132125,12.7685345 6.2407434,12.3492086 C6.60016555,11.9298828 7.23146553,11.8813212 7.65079137,12.2407434 L10.4229928,14.616916 L16.7689447,7.81768175 Z" fill="#0f5132" fill-rule="nonzero"/></g></svg>
                                            <span class="small-med text-align-c">Sikeres jóváírás.</span>
                                        </div>`;
                                    }, error: function (data) {
                                        document.getElementById('prs__con').innerHTML = `
                                        <div class="flex flex-col flex-align-c flex-justify-con-c text-danger user-select-none">
                                            <svg width="128" height="128" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><rect opacity="0.3" x="2" y="2" width="20" height="20" rx="10" fill="currentColor"/><rect x="11" y="14" width="7" height="2" rx="1" transform="rotate(-90 11 14)" fill="currentColor"/><rect x="11" y="17" width="2" height="2" rx="1" transform="rotate(-90 11 17)" fill="currentColor"/></svg>
                                            <span class="small-med text-align-c">Hiba történt a folyamat közben.</span>
                                        </div>`;
                                    }
                                });
                            }, error: function (apid) {
                                document.getElementById('prs__con').innerHTML = `
                                <div class="flex flex-col flex-align-c flex-justify-con-c text-danger user-select-none">
                                    <svg width="128" height="128" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><rect opacity="0.3" x="2" y="2" width="20" height="20" rx="10" fill="currentColor"/><rect x="11" y="14" width="7" height="2" rx="1" transform="rotate(-90 11 14)" fill="currentColor"/><rect x="11" y="17" width="2" height="2" rx="1" transform="rotate(-90 11 17)" fill="currentColor"/></svg>
                                    <span class="small-med text-align-c">Nem tudtuk kapcsolni a szolgáltatóhoz.<br>Kérjük próbálja újra később.</span>
                                </div>`;
                            }
                        });
                    } else { document.getElementById('crd-err').innerHTML = `Hibás kitöltés!`; }
                });
            } else {
                document.getElementById('prs__con').innerHTML = `
                <div class="flex flex-col flex-align-c flex-justify-con-c text-danger user-select-none">
                    <svg width="128" height="128" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><rect opacity="0.3" x="2" y="2" width="20" height="20" rx="10" fill="currentColor"/><rect x="11" y="14" width="7" height="2" rx="1" transform="rotate(-90 11 14)" fill="currentColor"/><rect x="11" y="17" width="2" height="2" rx="1" transform="rotate(-90 11 17)" fill="currentColor"/></svg>
                    <span class="small-med">Hiba történt az adatok lekérdezése közben. Kérjük próbálja újra</span>
                </div>`;
            }
        }, error: function (data) {
            document.getElementById('prs__con').innerHTML = `
            <div class="flex flex-col flex-align-c flex-justify-con-c text-danger user-select-none">
                <svg width="128" height="128" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><rect opacity="0.3" x="2" y="2" width="20" height="20" rx="10" fill="currentColor"/><rect x="11" y="14" width="7" height="2" rx="1" transform="rotate(-90 11 14)" fill="currentColor"/><rect x="11" y="17" width="2" height="2" rx="1" transform="rotate(-90 11 17)" fill="currentColor"/></svg>
                <span class="small-med">Hiba történt az adatok lekérdezése közben. Kérjük próbálja újra</span>
            </div>`;
        }
    });
    $('#cl__box').click(function () { c__wrapper.classList.add('fadeout'); c__box.classList.add('popout'); setTimeout(() => { c__wrapper.remove(); $('html').css("overflow-y", "unset"); }, 200); });
} function deductCredit (cid) { var creditData = new FormData(); creditData.append('cid', cid); creditData.append("uid", guid);
    var c__wrapper = document.createElement('div'); c__wrapper.classList = "wrapper_dark fadein"; var c__box = document.createElement('div'); c__box.classList = "d__confirm popup fixed flex flex-col border-soft item-bg box-shadow padding-1";
    c__wrapper.classList.add('fadein'); c__wrapper.classList.remove('fadeout'); c__box.classList.add("padding-t-0"); c__box.classList.add('popup'); c__box.classList.remove('popout'); document.body.append(c__wrapper);  c__wrapper.append(c__box); $('html').css("overflow-y", "hidden");
    c__box.innerHTML = `
    <div class="flex flex-row flex-align-c flex-justify-con-sb padding-t-1" id="cbh__con">
        <span class="text-primary bold" id="prs__title">Összeg levonása</span>
        <span class="flex text-primary pointer" aria-label="Bezárás" id="cl__box"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"><rect opacity="0.3" x="2" y="2" width="20" height="20" rx="5" fill="currentColor"/><rect x="7" y="15.3137" width="12" height="2" rx="1" transform="rotate(-45 7 15.3137)" fill="currentColor"/><rect x="8.41422" y="7" width="12" height="2" rx="1" transform="rotate(45 8.41422 7)" fill="currentColor"/></svg></span></div>
    </div><br>
    <div class="flex flex-col gap-1 feat__body prs__con" id="prs__con">
        <div class="flex flex-row flex-align-c flex-justify-con-c gap-2 w-fa">
            <div class="flex flex-col flex-justify-con-c flex-align-c">
                <span class="text-primary-light bold text-xxl" id="crd-def">0</span>
                <span class="text-muted smaller-light">Eredeti összeg</span>
            </div>
            <div class="text-primary">
                <svg width="42" height="42" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><rect opacity="0.5" x="18" y="13" width="13" height="2" rx="1" transform="rotate(-180 18 13)" fill="currentColor"/><path d="M15.4343 12.5657L11.25 16.75C10.8358 17.1642 10.8358 17.8358 11.25 18.25C11.6642 18.6642 12.3358 18.6642 12.75 18.25L18.2929 12.7071C18.6834 12.3166 18.6834 11.6834 18.2929 11.2929L12.75 5.75C12.3358 5.33579 11.6642 5.33579 11.25 5.75C10.8358 6.16421 10.8358 6.83579 11.25 7.25L15.4343 11.4343C15.7467 11.7467 15.7467 12.2533 15.4343 12.5657Z" fill="currentColor"/></svg>
            </div>
            <div class="flex flex-col flex-justify-con-c flex-align-c">
                <span class="text-primary-light bold text-xxl" id="crd-new">0</span>
                <span class="text-muted smaller-light">Új egyenleg</span>
            </div>
        </div>
        <div class="flex flex-col flex-align-c flex-justify-con-c margin-auto gap-1 w-60d-100m">
            <textarea id="crd-desc" class="text-primary border-soft-light background-bg padding-05 outline-none border-none w-fa" rows="4" maxlength="2048" placeholder="Egyenleg levonásának indoklása" style="font-size: .8rem !important; resize: none;"></textarea>
            <div class="flex flex-row flex-align-c w-fa gap-1">
                <input type="number" class="w-fc text-primary border-soft-light small-med background-bg padding-05 outline-none border-none w-fa" id="crd-inp" min="1" placeholder="Levonni kívánt összeg">
                <span class="flex flex-row flex-align-c flex-justify-con-c padding-05 border-soft-light primary-bg primary-bg-hover pointer user-select-none small-med" id="crd-add-cred">Mentés</span>
            </div>
        </div>
    </div><br>
    <div class="flex flex-row flex-align-fe flex-justify-con-r gap-05"><span class="flex smaller-light text-danger user-select-none" id="crd-err"></span></div>
    `; var con = document.getElementById('cbh__con');var mc = new Hammer(con);mc.get('pan').set({ direction: Hammer.DIRECTION_ALL });mc.on("pandown", function(ev) { $('#cl__box').click(); });
    $.ajax({ enctype: "multipart/form-data", type: "POST", url: "/assets/php/profile/get__card__a.php", data: creditData, dataType: 'json', contentType: false, processData: false,
        success: function(data) {
            if (data.value) {
                document.getElementById('crd-def').textContent = formatter.format(data.value);
                document.getElementById('crd-inp').setAttribute('max', data.value);
                $('#crd-inp').on('input', () => {
                    if (document.getElementById('crd-inp').value > 0) {
                        document.getElementById('crd-new').textContent = formatter.format(Number(data.value) - Number(document.getElementById('crd-inp').value));
                    } else { document.getElementById('crd-new').textContent = formatter.format(Number(data.value)); }
                    if (document.getElementById('crd-inp').value > data.value) { document.getElementById('crd-new').textContent = formatter.format(0); document.getElementById('crd-inp').value = data.value; }
                });
                $("#crd-add-cred").click(() => {
                    let nval = Number(document.getElementById('crd-inp').value);
                    var desc = document.getElementById('crd-desc').value;
                    if (nval > 0 && nval <= data.value && ( desc.length > 32 && desc.length <= 2048) ) { document.getElementById('crd-err').innerHTML = ``; creditData.append("value", nval); creditData.append("desc", desc);
                        $.ajax({url: "https://api.ipdata.co?api-key=739837e232548988c86b954108794b57bd3e1dbcd6eb550bfa53e544", dataType: 'json',
                            beforeSend: function () {
                                document.getElementById("prs__con").innerHTML = `
                                    <div class="flex flex-col flex-align-c flex-justify-con-c text-muted">
                                        <svg class='wizard_input_loading' xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="8rem" height="8rem" viewBox="0 0 24 24" version="1.1"><g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"><g><polygon points="0 0 24 0 24 24 0 24"/></g><path d="M12,4 L12,6 C8.6862915,6 6,8.6862915 6,12 C6,15.3137085 8.6862915,18 12,18 C15.3137085,18 18,15.3137085 18,12 C18,10.9603196 17.7360885,9.96126435 17.2402578,9.07513926 L18.9856052,8.09853149 C19.6473536,9.28117708 20,10.6161442 20,12 C20,16.418278 16.418278,20 12,20 C7.581722,20 4,16.418278 4,12 C4,7.581722 7.581722,4 12,4 Z" fill="currentColor" fill-rule="nonzero" opacity="0.4" transform="translate(12.000000, 12.000000) scale(-1, 1) translate(-12.000000, -12.000000) "/></g></svg>
                                        <span class="bold text-muted smaller-med text-align-c" id="bfs-load-txt">Betöltés</span>
                                    </div>
                                `;
                                setTimeout(() => {
                                    if (document.getElementById('bfs-load-txt')) { document.getElementById('bfs-load-txt').innerHTML += `<br><span>Úgy tűnik, hogy lassú az internetkapcsolata, így a kapcsolódás a szerverhez  több időt vehet igénybe.</span>`; }
                                }, 5000);
                            }, success: function (api) { creditData.append("ip", api.ip);
                                $.ajax({ enctype: "multipart/form-data", type: "POST", url: "/assets/php/profile/credit__card__deduct.php", data: creditData, dataType: 'json', contentType: false, processData: false,
                                    success: function(data) {
                                        document.getElementById('prs__con').innerHTML = `
                                        <div class="flex flex-col flex-align-c flex-justify-con-c text-success user-select-none">
                                            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="128px" height="128px" viewBox="0 0 24 24" version="1.1"><g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"><rect x="0" y="0" width="24" height="24"/><circle fill="#0f5132" opacity="0.3" cx="12" cy="12" r="10"/><path d="M16.7689447,7.81768175 C17.1457787,7.41393107 17.7785676,7.39211077 18.1823183,7.76894473 C18.5860689,8.1457787 18.6078892,8.77856757 18.2310553,9.18231825 L11.2310553,16.6823183 C10.8654446,17.0740439 10.2560456,17.107974 9.84920863,16.7592566 L6.34920863,13.7592566 C5.92988278,13.3998345 5.88132125,12.7685345 6.2407434,12.3492086 C6.60016555,11.9298828 7.23146553,11.8813212 7.65079137,12.2407434 L10.4229928,14.616916 L16.7689447,7.81768175 Z" fill="#0f5132" fill-rule="nonzero"/></g></svg>
                                            <span class="small-med text-align-c">Sikeres levonás.</span>
                                        </div>`;
                                    }, error: function (data) { console.log(data);
                                        document.getElementById('prs__con').innerHTML = `
                                        <div class="flex flex-col flex-align-c flex-justify-con-c text-danger user-select-none">
                                            <svg width="128" height="128" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><rect opacity="0.3" x="2" y="2" width="20" height="20" rx="10" fill="currentColor"/><rect x="11" y="14" width="7" height="2" rx="1" transform="rotate(-90 11 14)" fill="currentColor"/><rect x="11" y="17" width="2" height="2" rx="1" transform="rotate(-90 11 17)" fill="currentColor"/></svg>
                                            <span class="small-med text-align-c">Hiba történt a folyamat közben.</span>
                                        </div>`;
                                    }
                                });
                            }, error: function (apid) {
                                document.getElementById('prs__con').innerHTML = `
                                <div class="flex flex-col flex-align-c flex-justify-con-c text-danger user-select-none">
                                    <svg width="128" height="128" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><rect opacity="0.3" x="2" y="2" width="20" height="20" rx="10" fill="currentColor"/><rect x="11" y="14" width="7" height="2" rx="1" transform="rotate(-90 11 14)" fill="currentColor"/><rect x="11" y="17" width="2" height="2" rx="1" transform="rotate(-90 11 17)" fill="currentColor"/></svg>
                                    <span class="small-med text-align-c">Nem tudtuk kapcsolni a szolgáltatóhoz.<br>Kérjük próbálja újra később.</span>
                                </div>`;
                            }
                        });
                    } else { document.getElementById('crd-err').innerHTML = `Hibás kitöltés!`; }
                });
            } else {
                document.getElementById('prs__con').innerHTML = `
                <div class="flex flex-col flex-align-c flex-justify-con-c text-danger user-select-none">
                    <svg width="128" height="128" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><rect opacity="0.3" x="2" y="2" width="20" height="20" rx="10" fill="currentColor"/><rect x="11" y="14" width="7" height="2" rx="1" transform="rotate(-90 11 14)" fill="currentColor"/><rect x="11" y="17" width="2" height="2" rx="1" transform="rotate(-90 11 17)" fill="currentColor"/></svg>
                    <span class="small-med">Hiba történt az adatok lekérdezése közben. Kérjük próbálja újra</span>
                </div>`;
            }
        }, error: function (data) {
            document.getElementById('prs__con').innerHTML = `
            <div class="flex flex-col flex-align-c flex-justify-con-c text-danger user-select-none">
                <svg width="128" height="128" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><rect opacity="0.3" x="2" y="2" width="20" height="20" rx="10" fill="currentColor"/><rect x="11" y="14" width="7" height="2" rx="1" transform="rotate(-90 11 14)" fill="currentColor"/><rect x="11" y="17" width="2" height="2" rx="1" transform="rotate(-90 11 17)" fill="currentColor"/></svg>
                <span class="small-med">Hiba történt az adatok lekérdezése közben. Kérjük próbálja újra</span>
            </div>`;
        }
    });
    $('#cl__box').click(function () { c__wrapper.classList.add('fadeout'); c__box.classList.add('popout'); setTimeout(() => { c__wrapper.remove(); $('html').css("overflow-y", "unset"); }, 200); });
}