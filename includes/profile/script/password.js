$("#prsv__password").click(() => { const per__array = [];
    var c__wrapper = document.createElement('div'); c__wrapper.classList = "wrapper_dark fadein"; var c__box = document.createElement('div'); c__box.classList = "d__confirm popup fixed flex flex-col border-soft item-bg box-shadow padding-1";
    c__wrapper.classList.add('fadein'); c__wrapper.classList.remove('fadeout'); c__box.classList.add('padding-t-0'); c__box.classList.add('popup'); c__box.classList.remove('popout'); document.body.append(c__wrapper); c__wrapper.append(c__box); $('html').css("overflow-y", "hidden"); var pwd__data = new FormData(); pwd__data.append("original", $("#chpr__cpassword").val());
    c__box.innerHTML = `<div class="flex flex-row flex-align-c flex-justify-con-sb padding-t-1" id="cbh__con"><span class="text-primary bold" id="prs__title"></span><div class="flex flex-row flex-align-c gap-05"><span class="flex" id="prsb__con"></span><span class="text-primary pointer" aria-label="Bezárás" id="cl__box"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"><rect opacity="0.3" x="2" y="2" width="20" height="20" rx="5" fill="currentColor"/><rect x="7" y="15.3137" width="12" height="2" rx="1" transform="rotate(-45 7 15.3137)" fill="currentColor"/><rect x="8.41422" y="7" width="12" height="2" rx="1" transform="rotate(45 8.41422 7)" fill="currentColor"/></svg></span></div></div><br><div class="flex flex-col gap-1 feat__body prs__con" id="prs__con"></div>`;
    var con = document.getElementById('cbh__con');var mc = new Hammer(con);mc.get('pan').set({ direction: Hammer.DIRECTION_ALL });mc.on("pandown", function(ev) { $('#cl__box').click(); });
    $.ajax({ enctype: "multipart/form-data", type: "POST", url: "/assets/php/profile/get__password.php", data: pwd__data, dataType: 'json', contentType: false, processData: false,
        success: function(data) { console.log(data);
            if (data == 410) { wrp = false; } else { wrp = true; }
            if (wrp == false) { per__array.push({input: "Jelenlegi jelszó", type: "Helytelen jelszót adott meg"}); }
            if (!$("#chpr__cpassword").val().match(/^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*[!@#=\$%\^&\*])(?=.{8,})/)) { per__array.push({input: "Jelenlegi jelszó", type: "Érvénytelen formátumot használt"}); }
            if (!$("#chpr__npassword").val().match(/^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*[!@#=\$%\^&\*])(?=.{8,})/)) { per__array.push({input: "Új jelszó", type: "Érvénytelen formátumot használt"}); }
            if (!$("#chpr__ncpassword").val().match(/^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*[!@#=\$%\^&\*])(?=.{8,})/)) { per__array.push({input: "Jelszó megerősítése", type: "Érvénytelen formátumot használt"}); }
            if ($("#chpr__cpassword").val() == $("#chpr__npassword").val() && $("#chpr__npassword").val().length > 0) { per__array.push({input: "Új jelszó", type: "Nem használhatja jelenlegi jelszavát"}); }
            if ($("#chpr__npassword").val() !== $("#chpr__ncpassword").val()) { per__array.push({input: "Jelszó megerősítése", type: "A jelszavak nem egyeznek"}); }
            if (per__array.length > 0) {
                document.getElementById("prs__con").innerHTML = `<div class="flex flex-col flex-align-c flex-justify-con-c"><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="8rem" height="8rem" viewBox="0 0 24 24" version="1.1"><g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"><rect x="0" y="0" width="24" height="24"/><circle fill="#F64E60" opacity="0.3" cx="12" cy="12" r="10"/><path d="M12.0355339,10.6213203 L14.863961,7.79289322 C15.2544853,7.40236893 15.8876503,7.40236893 16.2781746,7.79289322 C16.6686989,8.18341751 16.6686989,8.81658249 16.2781746,9.20710678 L13.4497475,12.0355339 L16.2781746,14.863961 C16.6686989,15.2544853 16.6686989,15.8876503 16.2781746,16.2781746 C15.8876503,16.6686989 15.2544853,16.6686989 14.863961,16.2781746 L12.0355339,13.4497475 L9.20710678,16.2781746 C8.81658249,16.6686989 8.18341751,16.6686989 7.79289322,16.2781746 C7.40236893,15.8876503 7.40236893,15.2544853 7.79289322,14.863961 L10.6213203,12.0355339 L7.79289322,9.20710678 C7.40236893,8.81658249 7.40236893,8.18341751 7.79289322,7.79289322 C8.18341751,7.40236893 8.81658249,7.40236893 9.20710678,7.79289322 L12.0355339,10.6213203 Z" fill="#F64E60"/></g></svg><span class="bold text-danger small">Hibás adatokat adott meg!</span></div><div class="flex flex-col"><div class="flex flex-col gap-05"><ul class="flex flex-col flex-align-c flex-justify-con-c gap-05 list-style-none" id="prs__errcon" style="padding: 0;"></ul></div></div>`;
                for (let i = 0; i < per__array.length; i++) { document.getElementById("prs__errcon").innerHTML += `<li class="text-secondary smaller-light"><span><span>${per__array[i].type}</span> a(z) <b>${per__array[i].input}</b> mezőben!</span></li>`; }
                __chplog(0);
            } else { pwd__data.append("password", $("#chpr__npassword").val());
                $.ajax({ enctype: "multipart/form-data", type: "POST", url: "/assets/php/profile/update__password.php", data: pwd__data, dataType: 'json', contentType: false, processData: false,
                    success: function(data) {
                        document.getElementById("prs__con").innerHTML = `
                            <div class="flex flex-col flex-align-c flex-justify-con-c">
                                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="8rem" height="8rem" viewBox="0 0 24 24" version="1.1"><g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"><rect x="0" y="0" width="24" height="24"/><circle fill="#0f5132" opacity="0.3" cx="12" cy="12" r="10"/><path d="M16.7689447,7.81768175 C17.1457787,7.41393107 17.7785676,7.39211077 18.1823183,7.76894473 C18.5860689,8.1457787 18.6078892,8.77856757 18.2310553,9.18231825 L11.2310553,16.6823183 C10.8654446,17.0740439 10.2560456,17.107974 9.84920863,16.7592566 L6.34920863,13.7592566 C5.92988278,13.3998345 5.88132125,12.7685345 6.2407434,12.3492086 C6.60016555,11.9298828 7.23146553,11.8813212 7.65079137,12.2407434 L10.4229928,14.616916 L16.7689447,7.81768175 Z" fill="#0f5132" fill-rule="nonzero"/></g></svg>
                                <span class="bold text-success small">Sikeres változtazás!</span>
                            </div>
                        `; __chplog(1);
                        if (document.getElementById("tbp__pass")) { document.getElementById("tbp__pass").remove(); }
                        if (document.getElementById("tbp__pass__ind")) { document.getElementById("tbp__pass__ind").remove(); }
                        document.getElementById("chpr__cpassword").value = ""; document.getElementById("chpr__npassword").value = ""; document.getElementById("chpr__ncpassword").value = "";
                    }
                });
            }
        }
    });
    $('#cl__box').click(function () { c__wrapper.classList.add('fadeout'); c__box.classList.add('popout'); setTimeout(() => { c__wrapper.remove(); $('html').css("overflow-y", "unset"); $("#tab-password").load('/includes/profile/password.php'); }, 200); });
}); $("#prcc__password").click(() => { document.getElementById("chpr__cpassword").value = ""; document.getElementById("chpr__npassword").value = ""; document.getElementById("chpr__ncpassword").value = ""; });
function __chplog(stat) { let apiKey = '739837e232548988c86b954108794b57bd3e1dbcd6eb550bfa53e544';
    $.getJSON('https://api.ipdata.co?api-key=' + apiKey, function(data) {
        const getDeviceType = () => { const ua = navigator.userAgent; if (/(tablet|ipad|playbook|silk)|(android(?!.*mobi))/i.test(ua)) { return "tablet"; } if ( /Mobile|iP(hone|od)|Android|BlackBerry|IEMobile|Kindle|Silk-Accelerated|(hpw|web)OS|Opera M(obi|ini)/.test(ua)) { return "mobile";} return "desktop";
        }; var log__data = new FormData(); log__data.append("device", getDeviceType()); log__data.append("ip", data.ip); log__data.append("city", data.city); log__data.append("region", data.region); log__data.append("country", data.country_name); log__data.append("status", stat);
        $.ajax({ enctype: "multipart/form-data", type: "POST", url: "/assets/php/profile/chpr__log.php", data: log__data, dataType: 'json', contentType: false, processData: false});
    }); 
}