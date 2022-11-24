$('#prsv__personal').click(() => { const per__array = [];
    var c__wrapper = document.createElement('div'); c__wrapper.classList = "wrapper_dark fadein"; var c__box = document.createElement('div'); c__box.classList = "d__confirm popup fixed flex flex-col border-soft item-bg box-shadow padding-1";
    c__wrapper.classList.add('fadein'); c__wrapper.classList.remove('fadeout'); c__box.classList.add("padding-t-0"); c__box.classList.add('popup'); c__box.classList.remove('popout'); document.body.append(c__wrapper);  c__wrapper.append(c__box); $('html').css("overflow-y", "hidden");
    c__box.innerHTML = `
    <div class="flex flex-row flex-align-c flex-justify-con-sb padding-t-1" id="cbh__con">
        <span class="text-primary bold" id="prs__title"></span>
        <span class="flex text-primary pointer" aria-label="Bezárás" id="cl__box"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"><rect opacity="0.3" x="2" y="2" width="20" height="20" rx="5" fill="currentColor"/><rect x="7" y="15.3137" width="12" height="2" rx="1" transform="rotate(-45 7 15.3137)" fill="currentColor"/><rect x="8.41422" y="7" width="12" height="2" rx="1" transform="rotate(45 8.41422 7)" fill="currentColor"/></svg></span></div>
    </div><br>
    <div class="flex flex-col gap-1 feat__body prs__con" id="prs__con"></div><br>
    <div class="flex flex-row flex-align-fe flex-justify-con-r gap-05"><span class="flex" id="prsb__con"></span>
    `; var con = document.getElementById('cbh__con');var mc = new Hammer(con);mc.get('pan').set({ direction: Hammer.DIRECTION_ALL });mc.on("pandown", function(ev) { $('#cl__box').click(); });
    var fname__bool, comp__bool, fax__bool, phone__bool, email__bool, settlement__bool, address__bool, postal__bool, tax__bool, shsettl__bool, shaddr__bool, shpostal__bool = false;
    if ($('#chpr__fullname').val().match(/^([A-Za-zÀ-ÖØ-öø-ÿ]{3,})+\s+([\w\s]{3,})+$/i) && $("#chpr__fullname").val().length > 0) { fname__bool = true; } else { fname__bool = false; per__array.push({input: "Teljes név", type: "Érvénytelen formátumot használt"}); }
    if ($("#chpr__company").val().length > 6) { comp__bool = true; } else { comp__bool = false; per__array.push({input: "Cég neve", type: "Érvénytelen formátumot használt"}); }
    if ($("#chpr__fax").val().length === 9) { fax__bool = true; } else { fax__bool = false; per__array.push({input: "Fax szám", type: "Érvénytelen formátumot használt"}); }
    if ($("#chpr__phone").val().match(/\b\d{9}\b/g)) { phone__bool = true; } else { phone__bool = false; per__array.push({input: "Telefonszám", type: "Érvénytelen formátumot használt"}); }
    if ($("#chpr__settlement").val().length > 3) { settlement__bool = true; } else { settlement__bool = false; per__array.push({input: "Számlázási Település", type: "Érvénytelen formátumot használt"}); }
    if ($("#chpr__address").val().length > 3) { address__bool = true; } else { address__bool = false; per__array.push({input: "Számlázási Cím", type: "Érvénytelen formátumot használt"}); }
    if ($("#chpr__postal").val().match(/^[0-9]{4}$/)) { postal__bool = true; } else { postal__bool = false; per__array.push({input: "Számlázási Irányítószám", type: "Érvénytelen formátumot használt"}); }
    if ($("#chpr__tax").val().match(/^[0-9]{9}$/)) { tax__bool = true; } else { tax__bool = false; per__array.push({input: "Számlázási Adószám", type: "Érvénytelen formátumot használt"}); }
    if ($("#chpr__sh__settlement").val().length > 3) { shsettl__bool = true; } else { shsettl__bool = false; per__array.push({input: "Szállítási Település", type: "Érvénytelen formátumot használt"}); }
    if ($("#chpr__sh__address").val().length > 3) { shaddr__bool = true; } else { shaddr__bool = false; per__array.push({input: "Szállítási Cím", type: "Érvénytelen formátumot használt"}); }
    if ($("#chpr__sh__postal").val().match(/^[0-9]{4}$/)) { shpostal__bool = true; } else { shpostal__bool = false; per__array.push({input: "Szállítási Irányítószám", type: "Érvénytelen formátumot használt"}); }

    if (per__array.length > 0) {
        document.getElementById("prs__con").innerHTML = `<div class="flex flex-col flex-align-c flex-justify-con-c"><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="8rem" height="8rem" viewBox="0 0 24 24" version="1.1"><g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"><rect x="0" y="0" width="24" height="24"/><circle fill="#F64E60" opacity="0.3" cx="12" cy="12" r="10"/><path d="M12.0355339,10.6213203 L14.863961,7.79289322 C15.2544853,7.40236893 15.8876503,7.40236893 16.2781746,7.79289322 C16.6686989,8.18341751 16.6686989,8.81658249 16.2781746,9.20710678 L13.4497475,12.0355339 L16.2781746,14.863961 C16.6686989,15.2544853 16.6686989,15.8876503 16.2781746,16.2781746 C15.8876503,16.6686989 15.2544853,16.6686989 14.863961,16.2781746 L12.0355339,13.4497475 L9.20710678,16.2781746 C8.81658249,16.6686989 8.18341751,16.6686989 7.79289322,16.2781746 C7.40236893,15.8876503 7.40236893,15.2544853 7.79289322,14.863961 L10.6213203,12.0355339 L7.79289322,9.20710678 C7.40236893,8.81658249 7.40236893,8.18341751 7.79289322,7.79289322 C8.18341751,7.40236893 8.81658249,7.40236893 9.20710678,7.79289322 L12.0355339,10.6213203 Z" fill="#F64E60"/></g></svg><span class="bold text-danger small">Hibás adatokat adott meg!</span></div><div class="flex flex-col"><div class="flex flex-col gap-05"><ul class="flex flex-col flex-align-c flex-justify-con-c gap-05 list-style-none" id="prs__errcon" style="padding: 0;"></ul></div></div>`;
        for (let i = 0; i < per__array.length; i++) { document.getElementById("prs__errcon").innerHTML += `<li class="text-secondary smaller-light"><span><span>${per__array[i].type}</span> a(z) <b>${per__array[i].input}</b> mezőben!</span></li>`; }
    } else { var entries = []; var chpr__data = new FormData(); 
        chpr__data.append("fullname", $('#chpr__fullname').val());chpr__data.append("inv__company", $('#chpr__company').val());chpr__data.append("fax", $('#chpr__fax').val());chpr__data.append("phone", $('#chpr__phone').val());/*chpr__data.append("email", $('#chpr__email').val());*/chpr__data.append("inv__settlement", $('#chpr__settlement').val());chpr__data.append("inv__address", $('#chpr__address').val());chpr__data.append("inv__postal", $('#chpr__postal').val());chpr__data.append("inv__tax", $('#chpr__tax').val());chpr__data.append("ship__settlement", $('#chpr__sh__settlement').val());chpr__data.append("ship__address", $('#chpr__sh__address').val());chpr__data.append("ship__postal", $('#chpr__sh__postal').val());
        entries.push({inv__address: $('#chpr__address').val(),inv__company: $('#chpr__company').val(),fax: $('#chpr__fax').val(),inv__tax: $('#chpr__tax').val(),fullname: $('#chpr__fullname').val(),phone: $('#chpr__phone').val(),inv__postal: $('#chpr__postal').val(),inv__settlement: $('#chpr__settlement').val(),ship__address: $('#chpr__sh__address').val(),ship__postal: $('#chpr__sh__postal').val(),ship__settlement: $('#chpr__sh__settlement').val()}); chpr__data.append("uid", guid);
        $.ajax({ enctype: "multipart/form-data", type: "POST", url: "/assets/php/profile/get__profile__a.php", data: chpr__data, dataType: 'json', contentType: false, processData: false,
            success: function(data) { var data__entries = []; data__entries.push({inv__address: data.address,inv__company: data.company,fax: String(data.fax),inv__tax: String(data.tax),fullname: data.fullname,phone: String(data.phone),inv__postal: String(data.postal),inv__settlement: data.settlement,ship__address: data.sh__address,ship__postal: String(data.sh__postal),ship__settlement: data.sh__settlement});
                let sec = arraysEqual(entries, data__entries);
                if (sec.length < 1) { document.getElementById("prs__con").innerHTML = `<div class="flex flex-col flex-align-c flex-justify-con-c"><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="8rem" height="8rem" viewBox="0 0 24 24" version="1.1"><g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"><rect x="0" y="0" width="24" height="24"></rect><path d="M11.1669899,4.49941818 L2.82535718,19.5143571 C2.557144,19.9971408 2.7310878,20.6059441 3.21387153,20.8741573 C3.36242953,20.9566895 3.52957021,21 3.69951446,21 L21.2169432,21 C21.7692279,21 22.2169432,20.5522847 22.2169432,20 C22.2169432,19.8159952 22.1661743,19.6355579 22.070225,19.47855 L12.894429,4.4636111 C12.6064401,3.99235656 11.9909517,3.84379039 11.5196972,4.13177928 C11.3723594,4.22181902 11.2508468,4.34847583 11.1669899,4.49941818 Z" fill="#e29702" opacity="0.3"></path><rect fill="#e29702" x="11" y="9" width="2" height="7" rx="1"></rect><rect fill="#e29702" x="11" y="17" width="2" height="2" rx="1"></rect></g></svg><span class="bold small" style="color: #e29702;">Nem történt változtatás!</span></div><div class="flex flex-col flex-align-c flex-justify-con-c"><span class="text-secondary w-100 text-align-c small-med">A megadott értékei alapján nincs mit megváltoztatni. Nem történt változtatás, így nyugodtan bezárhatja ezt a panelt.</span></div>`; }
                else { document.getElementById("prs__title").textContent = "Változtatni kívánt adatok"; document.getElementById("prsb__con").innerHTML = `<span class="primary-bg primary-bg-hover border-soft-light padding-05 pointer user-select-none small-med" id="fch__mod">Mentés</span>`; document.getElementById("prs__con").innerHTML += `<table class="ch__table" id="sc__table" style="text-align: center !important;">`;
                    var chan__data = new FormData();
                    for (let i = 0; i < sec.length; i++) {
                        for (let s__keys in sec[i]) { var ch__title = document.querySelector("input[data-key='"+revConst(sec[i],sec[i][s__keys])+"']");
                            document.getElementById("sc__table").innerHTML += `
                            <tr class="background-bg text-secondary small-med" style="text-align: center !important;">
                                <th style="text-align: center !important;">`+ch__title.parentNode.getElementsByClassName("text-primary")[0].textContent+`</th>
                                <td style="text-align: center !important;"><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1"><g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"><polygon points="0 0 24 0 24 24 0 24"/><rect fill="#3699FF" opacity="0.3" transform="translate(8.500000, 12.000000) rotate(-90.000000) translate(-8.500000, -12.000000) " x="7.5" y="7.5" width="2" height="9" rx="1"/><path d="M9.70710318,15.7071045 C9.31657888,16.0976288 8.68341391,16.0976288 8.29288961,15.7071045 C7.90236532,15.3165802 7.90236532,14.6834152 8.29288961,14.2928909 L14.2928896,8.29289093 C14.6714686,7.914312 15.281055,7.90106637 15.675721,8.26284357 L21.675721,13.7628436 C22.08284,14.136036 22.1103429,14.7686034 21.7371505,15.1757223 C21.3639581,15.5828413 20.7313908,15.6103443 20.3242718,15.2371519 L15.0300721,10.3841355 L9.70710318,15.7071045 Z" fill="#3699FF" fill-rule="nonzero" transform="translate(14.999999, 11.999997) scale(1, -1) rotate(90.000000) translate(-14.999999, -11.999997) "/></g></svg></td>
                                <td style="text-align: center !important;">`+sec[i][s__keys].replace(/<\/?[^>]+(>|$)/g, "")+`</td>
                            </tr>
                            `;
                            chan__data.append(revConst(sec[i],sec[i][s__keys]), sec[i][s__keys].replace(/<\/?[^>]+(>|$)/g, ""));
                        } document.getElementById("prs__con").innerHTML += `</table>`;
                    } function revConst(cons, val) { return Object.keys(cons).find(key => cons[key] === val); }
                    $('#fch__mod').click(() => { chan__data.append("uid", guid);
                        $.ajax({url: "https://api.ipdata.co?api-key=739837e232548988c86b954108794b57bd3e1dbcd6eb550bfa53e544", dataType: 'json',
                            beforeSend: function () {
                                document.getElementById("prs__con").innerHTML = `
                                    <div class="flex flex-col flex-align-c flex-justify-con-c text-muted">
                                        <svg class='wizard_input_loading' xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="8rem" height="8rem" viewBox="0 0 24 24" version="1.1"><g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"><g><polygon points="0 0 24 0 24 24 0 24"/></g><path d="M12,4 L12,6 C8.6862915,6 6,8.6862915 6,12 C6,15.3137085 8.6862915,18 12,18 C15.3137085,18 18,15.3137085 18,12 C18,10.9603196 17.7360885,9.96126435 17.2402578,9.07513926 L18.9856052,8.09853149 C19.6473536,9.28117708 20,10.6161442 20,12 C20,16.418278 16.418278,20 12,20 C7.581722,20 4,16.418278 4,12 C4,7.581722 7.581722,4 12,4 Z" fill="currentColor" fill-rule="nonzero" opacity="0.4" transform="translate(12.000000, 12.000000) scale(-1, 1) translate(-12.000000, -12.000000) "/></g></svg>
                                        <span class="bold text-muted smaller-med">Betöltés</span>
                                    </div>
                                `;
                            }, success: function (api) { chan__data.append("ip", api.ip);
                                $.ajax({ enctype: "multipart/form-data", type: "POST", url: "/assets/php/profile/change__profile__a.php", data: chan__data, dataType: 'json', contentType: false, processData: false,
                                    success: function(data) { document.getElementById('fch__mod').remove();
                                        document.getElementById("tab__fullname").textContent = $('#chpr__fullname').val();
                                        if (document.getElementById("tab__company")) { document.getElementById("tab__company").textContent = $('#chpr__company').val(); }
                                        if (document.getElementById("tab__location")) { document.getElementById("tab__location").textContent = $('#chpr__postal').val() +' '+ $('#chpr__settlement').val() + ', ' + $('#chpr__address').val(); }
                                        if (document.getElementById("pr__phone")) { document.getElementById("pr__phone").textContent = "+36 " + $('#chpr__phone').val().slice(0, 2) + "/" + $('#chpr__phone').val().slice(2, 5) + "-" + $('#chpr__phone').val().slice(5, 9); }
                                        if (data == 200) {
                                            document.getElementById("prs__con").innerHTML = `
                                                <div class="flex flex-col flex-align-c flex-justify-con-c">
                                                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="8rem" height="8rem" viewBox="0 0 24 24" version="1.1"><g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"><rect x="0" y="0" width="24" height="24"/><circle fill="#0f5132" opacity="0.3" cx="12" cy="12" r="10"/><path d="M16.7689447,7.81768175 C17.1457787,7.41393107 17.7785676,7.39211077 18.1823183,7.76894473 C18.5860689,8.1457787 18.6078892,8.77856757 18.2310553,9.18231825 L11.2310553,16.6823183 C10.8654446,17.0740439 10.2560456,17.107974 9.84920863,16.7592566 L6.34920863,13.7592566 C5.92988278,13.3998345 5.88132125,12.7685345 6.2407434,12.3492086 C6.60016555,11.9298828 7.23146553,11.8813212 7.65079137,12.2407434 L10.4229928,14.616916 L16.7689447,7.81768175 Z" fill="#0f5132" fill-rule="nonzero"/></g></svg>
                                                    <span class="bold text-success small">Sikeres változtazás!</span>
                                                </div>
                                            `;
                                        } else {
                                            document.getElementById("prs__con").innerHTML = `
                                                <div class="flex flex-col flex-align-c flex-justify-con-c text-danger">
                                                    <svg width="8rem" height="8rem" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><rect opacity="0.3" x="2" y="2" width="20" height="20" rx="10" fill="currentColor"/><rect x="11" y="14" width="7" height="2" rx="1" transform="rotate(-90 11 14)" fill="currentColor"/><rect x="11" y="17" width="2" height="2" rx="1" transform="rotate(-90 11 17)" fill="currentColor"/></svg>
                                                    <span class="bold text-danger small">Sikertelen változtatás.</span>
                                                </div>
                                            `;
                                        }
                                    }, error: function (data) { console.log(data.responseText);
                                        document.getElementById("prs__con").innerHTML = `
                                            <div class="flex flex-col flex-align-c flex-justify-con-c text-danger">
                                                <svg width="8rem" height="8rem" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><rect opacity="0.3" x="2" y="2" width="20" height="20" rx="10" fill="currentColor"/><rect x="11" y="14" width="7" height="2" rx="1" transform="rotate(-90 11 14)" fill="currentColor"/><rect x="11" y="17" width="2" height="2" rx="1" transform="rotate(-90 11 17)" fill="currentColor"/></svg>
                                                <span class="bold text-danger small">Hiba történt a folyamat közben.</span>
                                            </div>
                                        `; document.getElementById('prsb__con').innerHTML = ``;
                                    }
                                });
                            }, error: function () {
                                document.getElementById("prs__con").innerHTML = `
                                    <div class="flex flex-col flex-align-c flex-justify-con-c text-danger">
                                        <svg width="8rem" height="8rem" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><rect opacity="0.3" x="2" y="2" width="20" height="20" rx="10" fill="currentColor"/><rect x="11" y="14" width="7" height="2" rx="1" transform="rotate(-90 11 14)" fill="currentColor"/><rect x="11" y="17" width="2" height="2" rx="1" transform="rotate(-90 11 17)" fill="currentColor"/></svg>
                                        <span class="bold text-danger small">Hiba történt a folyamat közben.</span>
                                    </div>
                                `; document.getElementById('prsb__con').innerHTML = ``;
                            }
                        });
                    });
                }
            }, error: function (data) { console.log(data);
                document.getElementById("prs__con").innerHTML = `
                    <div class="flex flex-col flex-align-c flex-justify-con-c text-danger">
                        <svg width="8rem" height="8rem" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><rect opacity="0.3" x="2" y="2" width="20" height="20" rx="10" fill="currentColor"/><rect x="11" y="14" width="7" height="2" rx="1" transform="rotate(-90 11 14)" fill="currentColor"/><rect x="11" y="17" width="2" height="2" rx="1" transform="rotate(-90 11 17)" fill="currentColor"/></svg>
                        <span class="bold text-danger small">Hiba történt a folyamat közben.</span>
                    </div>
                `; document.getElementById('prsb__con').innerHTML = ``;
            }
        });
    }
    function arraysEqual(a, b) { var diff = []; const a__matches = []; for (let key of Object.keys(a[0])) { a__matches.push([key, a[0][key]]); } const b__matches = []; for (let key of Object.keys(b[0])) { b__matches.push([key, b[0][key]]); }
        for (let i = 0; i < a__matches.length; i++) { if (a__matches[i][1] !== b__matches[i][1]) { var diff__key = a__matches[i][0]; diff__val = a__matches[i][1]; const item = {}; item[diff__key] = diff__val; diff.push(item);} } return (diff);
    } $('#cl__box').click(function () { c__wrapper.classList.add('fadeout'); c__box.classList.add('popout'); setTimeout(() => { c__wrapper.remove(); $('html').css("overflow-y", "unset"); }, 200); });
});
$("#prcc__personal").click(() => { var gpfData = new FormData(); gpfData.append("uid", guid); $.ajax({ enctype: "multipart/form-data", type: "POST", url: "/assets/php/profile/get__profile__a.php", data: gpfData, dataType: 'json', contentType: false, processData: false, success: function(data) { document.getElementById("chpr__fullname").value = data.fullname;document.getElementById("chpr__company").value = data.company;document.getElementById("chpr__fax").value = data.fax;document.getElementById("chpr__phone").value = data.phone;/*document.getElementById("chpr__email").value = data.email*/;document.getElementById("chpr__settlement").value = data.settlement;document.getElementById("chpr__address").value = data.address;document.getElementById("chpr__postal").value = data.postal;document.getElementById("chpr__tax").value = data.tax;document.getElementById("chpr__sh__settlement").value = data.sh__settlement;document.getElementById("chpr__sh__address").value = data.sh__address;document.getElementById("chpr__sh__postal").value = data.sh__postal;} }); });
