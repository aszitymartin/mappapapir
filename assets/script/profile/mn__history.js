var bt__trigger = document.getElementById("prb__trigger"); var c__wrapper = document.createElement('div'); c__wrapper.classList = "wrapper_dark"; var c__box = document.createElement('div'); c__box.classList = "d__confirm fixed flex flex-col border-soft item-bg box-shadow padding-1";
bt__trigger.addEventListener("click", function () { document.body.append(c__wrapper); c__wrapper.append(c__box); disableScroll();
    c__box.innerHTML = `
    <div class="flex flex-row flex-align-c flex-justify-con-sb">
        <span class="text-primary bold">Tranzakciós előzmények</span>
        <span class="button button-secondary small-med" id="cl__box">Mégsem</span>
    </div>
    <div class="flex flex-col gap-1 feat__body">
        <div class="flex flex-row"></div>
        <div class="flex flex-col" id="mnh__orders">
            <table class="ch__table" id="mnho__table">
                <tr>
                    <th class="text-primary small-med padding-t-0 padding-bot-05">#</th>
                    <th class="text-primary small-med padding-t-0 padding-bot-05">Termék</th>
                    <th class="text-primary small-med padding-t-0 padding-bot-05">Darab</th>
                    <th class="text-primary small-med padding-t-0 padding-bot-05">Összeg</th>
                    <th class="text-primary small-med padding-t-0 padding-bot-05">Dátum</th>
                </tr>
            </table>
        </div>
    </div>
    `;
    $.ajax({
        enctype: "multipart/form-data", type: "POST", url: "/assets/php/profile/mn__history.php", dataType: 'json', contentType: false, processData: false,
        success: function(data) { 
            if (data === 30) { document.getElementById("mnho__table").innerHTML = `<span class="flex text-secondary text-align-c w-100">Nem található feljegyzett tranzakciós esemény.</span>`; }
            else {
                for (let i = 0; i < data.length; i++) { 
                    document.getElementById("mnho__table").innerHTML += `
                        <tr>
                            <td class="text-secondary smaller-med">#${data[i].id}</td>
                            <td class="text-secondary link pointer smaller-med"><a href="/webshop/?id=${data[i].pid}" target="_blank">${data[i].pname}</a></td>
                            <td class="text-secondary smaller-med">${data[i].quantity}</td>
                            <td class="text-secondary smaller-med" id="fmoh__subt${data[i].id}">${data[i].subtotal}</td>
                            <td class="text-secondary smaller-med">${data[i].date}</td>
                        </tr>
                    `; document.getElementById("fmoh__subt"+data[i].id).textContent = formatter.format(data[i].subtotal);
                }
            }
        },
        error: function (data) { document.getElementById("mnho__table").innerHTML = `<span class="flex text-secondary text-align-c w-100">Hiba történt az előzmények lekérdezése közben. Próbálja újra később.</span>`; }
    });
    $('#cl__box').click(function () { c__wrapper.remove(); enableScroll(); });
});