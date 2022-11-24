var c__wrapper = document.createElement('div'); c__wrapper.classList = "wrapper_dark";
var c__box = document.createElement('div'); c__box.classList = "d__confirm fixed flex flex-col border-soft item-bg box-shadow padding-1";
function rv__report(rid) { document.body.append(c__wrapper); c__wrapper.append(c__box); disableScroll();
    var chr__report = new FormData(); chr__report.append("rid", rid);
    c__box.innerHTML = `
        <div class="flex flex-row flex-align-c flex-justify-con-sb">
            <span class="text-primary bold">Értékelés jelentése</span>
            <span class="button button-secondary small-med" id="cl__box">Mégsem</span>
        </div><br>`;
    $.ajax({
        enctype: "multipart/form-data", type: "POST", url: "/assets/php/reviews/chr__report.php", data: chr__report, dataType: 'json', contentType: false, processData: false,
        success: function(data) { 
            if (data.num > 0) { 
                c__box.innerHTML += `
                    <div class="flex flex-col gap-1">
                        <span class="text-secondary small">Ezt az értékelést már bejelentette. Kérjük, várja meg, amíg ügyfélszolgálatunk megvizsgálja beküldését.</span>
                        <span class="text-secondary small-med">Beküldésének dátuma: <b>${data.date}</b></span>
                    </div>
                `;
                $('#cl__box').click(function () { c__wrapper.remove(); enableScroll(); });
            } else {
                c__box.innerHTML += `
                    <div class="flex flex-col gap-1">
                        <span class="text-secondary small">Ha ezt a tartalmat nem találja megfelelőnek, és úgy gondolja, hogy el kell távolítani az oldalról, tudassa velünk az alábbi gombra kattintva.</span>
                        <span class="text-secondary small-med"><b>Figyelem! &nbsp;</b> A vizsgálat befejeztével, ha a bejelentett véleményt visszaéléstől mentesnek találjuk, az Ön profilja figyelmeztetésben fog részesülni. Egy bizonyos számú figyelmeztetés után a fiókját felfüggesztjük.</span>
                    </div><br>
                    <div id="rvr__alert"></div>
                    `; var cr__warn = new FormData(); cr__warn.append("rid", rid);
                    $.ajax({
                        enctype: "multipart/form-data", type: "POST", url: "/assets/php/reviews/c__warnings.php", dataType: 'json', contentType: false, processData: false,
                        success: function(data) { if (data > 0) { document.getElementById('rvr__alert').innerHTML += `<div class="alert alert-danger flex padding-05 border-soft small-med"><span>Már van <b>&nbsp;${data}&nbsp;</b> figyelmeztetése. Biztos, hogy ez a vélemény sértő?</span></div><br>`; } }
                    });
                    c__box.innerHTML += `
                    <div class="flex flex-row flex-align-c flex-justify-con-fe">
                        <span class="button button-primary small-med" id="rv__report">Jelentés</span>
                    </div>
                `;
                $('#cl__box').click(function () { c__wrapper.remove(); enableScroll(); });
                $('#rv__report').click(function () { var cr__report = new FormData(); cr__report.append("rid", rid);
                    $.ajax({
                        enctype: "multipart/form-data", type: "POST", url: "/assets/php/reviews/c__review.php", data: cr__report, dataType: 'json', contentType: false, processData: false,
                        success: function(data) { 
                            $.ajax({
                                enctype: "multipart/form-data", type: "POST", url: "/assets/php/reviews/report.php", data: cr__report, dataType: 'json', contentType: false, processData: false,
                                success: function(data) { c__wrapper.remove(); enableScroll(); notificationSystem(0, 0, 0, 'Siker!', 'Sikeresen jelentve!'); }, 
                                error: function (data) { notificationSystem(0, 1, 0, 'Hiba!', 'Sikertelen művelet.'); }
                            });     
                        }, error: function (data) { notificationSystem(0, 1, 0, 'Hiba!', 'Ismeretlen értékelés.'); }
                    });
                });
            }
        }
    });
}