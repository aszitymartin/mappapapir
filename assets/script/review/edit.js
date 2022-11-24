var c__wrapper = document.createElement('div'); c__wrapper.classList = "wrapper_dark";
var c__box = document.createElement('div'); c__box.classList = "d__confirm fixed flex flex-col border-soft item-bg box-shadow padding-1";
$('#e__review').click(function (e) { document.body.append(c__wrapper); c__wrapper.append(c__box); disableScroll();
    var i__data = new FormData(); i__data.append('pid', $('#e__review').attr('pid')); i__data.append('rid', $('#e__review').attr('rid'));
    $.ajax({
        enctype: "multipart/form-data", type: "POST", url: "/assets/php/reviews/r__info.php", data: i__data, dataType: 'json', contentType: false, processData: false,
        success: function(data) { var rt__error = document.createElement('div'); rt__error.classList = "flex flex-align-c gap-05 small-med text-danger"; var sc__error = document.createElement('div'); sc__error.classList = "flex flex-align-c gap-05 small-med text-danger";
            c__box.innerHTML = `
                <div class="flex flex-row flex-align-c">
                    <span class="text-primary bold">Értékelés szerkesztése</span>
                </div><br>
                <div id="rv__form" class="flex flex-col border-soft outline-secondary">
                    <div class="flex flex-col padding-1 gap-1">
                        <div id="s__con" class="flex flex-col">
                            <div class="flex">
                                <span class="text-primary bold small-med">Értékelje a terméket</span>
                            </div>
                            <div class="flex flex-row product-star-con" id="e__stars"></div>
                        </div>
                        <div class="flex flex-col gap-05">
                            <div class="flex">
                                <span class="text-primary bold small-med">Rövid összefoglalás</span>
                            </div>
                            <div class="flex flex-col gap-05">
                                <textarea id="r__textarea" class="textarea resize-none mx-height-un height-un padding-05" name="review-title" id="review-desc" rows="6" maxlength="2048" placeholder="Írja meg, miért ajánlaná a terméket másoknak, illetve miért nem, milyen tapasztalatai vannak a termék használatával kapcsolatosan és mire érdemes odafigyelni a termékvásárlásánál!"></textarea>
                            </div>
                        </div>
                        <div class="flex">
                            <span class="text-secondary smaller">A vélemény elküldésével hozzájárul ahhoz, hogy megadott e-mail címét a Mappa Papír Kft. (6400 Kiskunhalas, Kossuth utca 13-15; mappapapir.hu) adatkezelőként kezelje. Az adatkezelésről további tájékoztatások <a href="#" target="_blank" class="link text-primary">itt érhetőek el</a>.</span>
                        </div>
                        <div class="flex flex-row flex-justify-con-sb w-100">
                            <span class="button button-secondary small-med" id="cl__box">Mégsem</span>
                            <span id="sav__review" class="button button-primary small-med">Mentés</span>
                        </div>
                    </div>
                </div>
            `; $('#r__textarea').val(data.desc);
            function getSiblings(element, type) { var arraySib = [];
                if ( type == "prev" ) { while ( element = element.previousSibling ) { arraySib.push(element); } }
                else if ( type == "next" ) { while ( element = element.nextSibling ) { arraySib.push(element); } }
                return arraySib;
            }
            for (var i = 1; i <= 5; i++) { document.getElementById("e__stars").innerHTML += `<span class="r__icon"><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="32px" height="32px" viewBox="0 0 24 24" version="1.1"><g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"><polygon points="0 0 24 0 24 24 0 24"></polygon><path d="M12,18 L7.91561963,20.1472858 C7.42677504,20.4042866 6.82214789,20.2163401 6.56514708,19.7274955 C6.46280801,19.5328351 6.42749334,19.309867 6.46467018,19.0931094 L7.24471742,14.545085 L3.94038429,11.3241562 C3.54490071,10.938655 3.5368084,10.3055417 3.92230962,9.91005817 C4.07581822,9.75257453 4.27696063,9.65008735 4.49459766,9.61846284 L9.06107374,8.95491503 L11.1032639,4.81698575 C11.3476862,4.32173209 11.9473121,4.11839309 12.4425657,4.36281539 C12.6397783,4.46014562 12.7994058,4.61977315 12.8967361,4.81698575 L14.9389263,8.95491503 L19.5054023,9.61846284 C20.0519472,9.69788046 20.4306287,10.2053233 20.351211,10.7518682 C20.3195865,10.9695052 20.2170993,11.1706476 20.0596157,11.3241562 L16.7552826,14.545085 L17.5353298,19.0931094 C17.6286908,19.6374458 17.263103,20.1544017 16.7187666,20.2477627 C16.5020089,20.2849396 16.2790408,20.2496249 16.0843804,20.1472858 L12,18 Z" class="svg" opacity=".3"></path></g></svg></span>`; }
            var icon = document.getElementsByClassName("r__icon");
            for (var i = 0; i < icon.length; i++) {
                icon[i].addEventListener("click", function () {
                    this.innerHTML = `<svg class="s__active" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="32px" height="32px" viewBox="0 0 24 24" version="1.1"><g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"><polygon points="0 0 24 0 24 24 0 24"></polygon><path d="M12,18 L7.91561963,20.1472858 C7.42677504,20.4042866 6.82214789,20.2163401 6.56514708,19.7274955 C6.46280801,19.5328351 6.42749334,19.309867 6.46467018,19.0931094 L7.24471742,14.545085 L3.94038429,11.3241562 C3.54490071,10.938655 3.5368084,10.3055417 3.92230962,9.91005817 C4.07581822,9.75257453 4.27696063,9.65008735 4.49459766,9.61846284 L9.06107374,8.95491503 L11.1032639,4.81698575 C11.3476862,4.32173209 11.9473121,4.11839309 12.4425657,4.36281539 C12.6397783,4.46014562 12.7994058,4.61977315 12.8967361,4.81698575 L14.9389263,8.95491503 L19.5054023,9.61846284 C20.0519472,9.69788046 20.4306287,10.2053233 20.351211,10.7518682 C20.3195865,10.9695052 20.2170993,11.1706476 20.0596157,11.3241562 L16.7552826,14.545085 L17.5353298,19.0931094 C17.6286908,19.6374458 17.263103,20.1544017 16.7187666,20.2477627 C16.5020089,20.2849396 16.2790408,20.2496249 16.0843804,20.1472858 L12,18 Z" class="svg"></path></g></svg>`;
                    var prev = getSiblings(this, "prev"); var next = getSiblings(this, "next");
                    for(p = 0; p < prev.length; p++) { prev[p].innerHTML = `<svg class="s__active" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="32px" height="32px" viewBox="0 0 24 24" version="1.1"><g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"><polygon points="0 0 24 0 24 24 0 24"></polygon><path d="M12,18 L7.91561963,20.1472858 C7.42677504,20.4042866 6.82214789,20.2163401 6.56514708,19.7274955 C6.46280801,19.5328351 6.42749334,19.309867 6.46467018,19.0931094 L7.24471742,14.545085 L3.94038429,11.3241562 C3.54490071,10.938655 3.5368084,10.3055417 3.92230962,9.91005817 C4.07581822,9.75257453 4.27696063,9.65008735 4.49459766,9.61846284 L9.06107374,8.95491503 L11.1032639,4.81698575 C11.3476862,4.32173209 11.9473121,4.11839309 12.4425657,4.36281539 C12.6397783,4.46014562 12.7994058,4.61977315 12.8967361,4.81698575 L14.9389263,8.95491503 L19.5054023,9.61846284 C20.0519472,9.69788046 20.4306287,10.2053233 20.351211,10.7518682 C20.3195865,10.9695052 20.2170993,11.1706476 20.0596157,11.3241562 L16.7552826,14.545085 L17.5353298,19.0931094 C17.6286908,19.6374458 17.263103,20.1544017 16.7187666,20.2477627 C16.5020089,20.2849396 16.2790408,20.2496249 16.0843804,20.1472858 L12,18 Z" class="svg"></path></g></svg>`; }
                    for (n = 0; n < next.length; n++) { next[n].innerHTML = `<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="32px" height="32px" viewBox="0 0 24 24" version="1.1"><g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"><polygon points="0 0 24 0 24 24 0 24"></polygon><path d="M12,18 L7.91561963,20.1472858 C7.42677504,20.4042866 6.82214789,20.2163401 6.56514708,19.7274955 C6.46280801,19.5328351 6.42749334,19.309867 6.46467018,19.0931094 L7.24471742,14.545085 L3.94038429,11.3241562 C3.54490071,10.938655 3.5368084,10.3055417 3.92230962,9.91005817 C4.07581822,9.75257453 4.27696063,9.65008735 4.49459766,9.61846284 L9.06107374,8.95491503 L11.1032639,4.81698575 C11.3476862,4.32173209 11.9473121,4.11839309 12.4425657,4.36281539 C12.6397783,4.46014562 12.7994058,4.61977315 12.8967361,4.81698575 L14.9389263,8.95491503 L19.5054023,9.61846284 C20.0519472,9.69788046 20.4306287,10.2053233 20.351211,10.7518682 C20.3195865,10.9695052 20.2170993,11.1706476 20.0596157,11.3241562 L16.7552826,14.545085 L17.5353298,19.0931094 C17.6286908,19.6374458 17.263103,20.1544017 16.7187666,20.2477627 C16.5020089,20.2849396 16.2790408,20.2496249 16.0843804,20.1472858 L12,18 Z" class="svg" opacity=".3"></path></g></svg>`; }
                });
            }
            $('#cl__box').click(function () { c__wrapper.remove(); enableScroll(); });
            $("#sav__review").click(function () {
                if ($('#r__textarea').val().length < 128) { document.getElementById('r__textarea').parentNode.append(rt__error); rt__error.innerHTML = `<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="18px" height="18px" viewBox="0 0 24 24" version="1.1"><g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"><rect x="0" y="0" width="24" height="24"/><path d="M11.1669899,4.49941818 L2.82535718,19.5143571 C2.557144,19.9971408 2.7310878,20.6059441 3.21387153,20.8741573 C3.36242953,20.9566895 3.52957021,21 3.69951446,21 L21.2169432,21 C21.7692279,21 22.2169432,20.5522847 22.2169432,20 C22.2169432,19.8159952 22.1661743,19.6355579 22.070225,19.47855 L12.894429,4.4636111 C12.6064401,3.99235656 11.9909517,3.84379039 11.5196972,4.13177928 C11.3723594,4.22181902 11.2508468,4.34847583 11.1669899,4.49941818 Z" fill="#ce3746" opacity="0.3"/><rect fill="#ce3746" x="11" y="9" width="2" height="7" rx="1"/><rect fill="#ce3746" x="11" y="17" width="2" height="2" rx="1"/></g></svg><span class="flex">Többet kell írnia az értékelés közzétételéhez.<em style="margin-left: .5rem;">(min 128 karakter)</em></span>`; }
                else if ($('#r__textarea').val().length > 2048) { document.getElementById('r__textarea').parentNode.append(rt__error); rt__error.innerHTML = `<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="18px" height="18px" viewBox="0 0 24 24" version="1.1"><g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"><rect x="0" y="0" width="24" height="24"/><path d="M11.1669899,4.49941818 L2.82535718,19.5143571 C2.557144,19.9971408 2.7310878,20.6059441 3.21387153,20.8741573 C3.36242953,20.9566895 3.52957021,21 3.69951446,21 L21.2169432,21 C21.7692279,21 22.2169432,20.5522847 22.2169432,20 C22.2169432,19.8159952 22.1661743,19.6355579 22.070225,19.47855 L12.894429,4.4636111 C12.6064401,3.99235656 11.9909517,3.84379039 11.5196972,4.13177928 C11.3723594,4.22181902 11.2508468,4.34847583 11.1669899,4.49941818 Z" fill="#ce3746" opacity="0.3"/><rect fill="#ce3746" x="11" y="9" width="2" height="7" rx="1"/><rect fill="#ce3746" x="11" y="17" width="2" height="2" rx="1"/></g></svg><span class="flex">Kevesebbet kell írnia az értékelés közzétételéhez.<em style="margin-left: .5rem;">(max 2046 karakter)</em></span>`; }
                else { rt__error.remove();
                    let stars = document.getElementsByClassName('s__active').length; console.log(stars);
                    if (!stars) { document.getElementById('s__con').append(sc__error); sc__error.innerHTML = `<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="18px" height="18px" viewBox="0 0 24 24" version="1.1"><g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"><rect x="0" y="0" width="24" height="24"/><path d="M11.1669899,4.49941818 L2.82535718,19.5143571 C2.557144,19.9971408 2.7310878,20.6059441 3.21387153,20.8741573 C3.36242953,20.9566895 3.52957021,21 3.69951446,21 L21.2169432,21 C21.7692279,21 22.2169432,20.5522847 22.2169432,20 C22.2169432,19.8159952 22.1661743,19.6355579 22.070225,19.47855 L12.894429,4.4636111 C12.6064401,3.99235656 11.9909517,3.84379039 11.5196972,4.13177928 C11.3723594,4.22181902 11.2508468,4.34847583 11.1669899,4.49941818 Z" fill="#ce3746" opacity="0.3"/><rect fill="#ce3746" x="11" y="9" width="2" height="7" rx="1"/><rect fill="#ce3746" x="11" y="17" width="2" height="2" rx="1"/></g></svg><span class="flex">Válassza ki a megfelelő csillagot!</span>`; }
                    else { sc__error.remove(); var rv__data = new FormData(); rv__data.append("pid", $('#e__review').attr('pid')); rv__data.append("rid", $('#e__review').attr('rid')); rv__data.append("stars", stars); rv__data.append("description", $('#r__textarea').val());
                        $.ajax({
                            enctype: "multipart/form-data", type: "POST", url: "/assets/php/reviews/edit.php", data: rv__data, dataType: 'json', contentType: false, processData: false,
                            success: function(data) { console.log(data); document.getElementById('rv__form').remove(); enableScroll(); window.location.reload(true); },
                            error: function (data) { notificationSystem(0, 1, 0, 'Hiba!', 'Az értékelés közzététele meghiúsult'); }
                        });
                    }
                }
            });
        },
        error: function (data) { console.log('error:'); console.log(data); }
    });
});