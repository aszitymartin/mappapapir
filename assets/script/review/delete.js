var c__wrapper = document.createElement('div'); c__wrapper.classList = "wrapper_dark";
var c__box = document.createElement('div'); c__box.classList = "d__confirm fixed flex flex-col border-soft item-bg box-shadow padding-1";
$('#d__review').click(function () { document.body.append(c__wrapper); c__wrapper.append(c__box); disableScroll();
    c__box.innerHTML = `
        <div class="flex flex-row flex-align-c">
            <span class="text-primary bold">Biztosas töröli ezt az értékelést?</span>
        </div><br>
        <div class="flex flex-col">
            <span class="text-secondary small">Törlés előtt olvassa el a következő információkat a fennmaradó adatok kezelésről.</span>
            <ul class="flex flex-col gap-05 text-secondary r__list">
                <li>A törlés után nem lesz mód a visszavonásra, a <b>törlés végleges</b>.</li>
                <li>A törölt értékelést a jövőben felhasználhatjuk <b>statisztikákhoz</b>, de ezeket az adatokat <b>teljesen névtelenül</b> fogjuk kezelni.</li>
            </ul>
        </div><br>
        <div id="rv__inf"></div>`; var rev__info = new FormData(); rev__info.append("rid", $('#d__review').attr('rid'));
        $.ajax({ enctype: "multipart/form-data", type: "POST", url: "/assets/php/reviews/ru__count.php", data: rev__info, dataType: 'json', contentType: false, processData: false,
            success: function(data) { if (data > 0) { document.getElementById('rv__inf').innerHTML = `<div class="alert alert-danger border-soft padding-05" style="font-size: .8rem;"><b>${data}</b> ember találta hasznosnak a véleményét. Biztos benne, hogy így is kívánja eltávolítani?</div><br></br>`; } },
            error: function (data) { notificationSystem(0, 1, 0, 'Hiba!', 'Az értékelés törlése sikertelen volt.'); }
        });
        c__box.innerHTML += `
        <div class="flex flex-row flex-align-c flex-justify-con-sb">
            <span class="button button-secondary small-med" id="cl__box">Mégsem</span>
            <span class="button button-primary small-med" id="co__box">Törlés</span>
        </div>
    `;
    $('#cl__box').click(function () { c__wrapper.remove(); enableScroll(); });
    $('#co__box').click(function () { var dr__data = new FormData(); dr__data.append("pid", $('#d__review').attr("pid")); dr__data.append("rid", $('#d__review').attr("rid"));
        $.ajax({ enctype: "multipart/form-data", type: "POST", url: "/assets/php/reviews/delete.php", data: dr__data, dataType: 'json', contentType: false, processData: false,
            success: function(data) { c__wrapper.remove(); document.getElementById('rev'+$('#d__review').attr("rid")).remove(); enableScroll(); window.location.reload(true); },
            error: function (data) { notificationSystem(0, 1, 0, 'Hiba!', 'Az értékelés törlése sikertelen volt.'); }
        });
    });
});