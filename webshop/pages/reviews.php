<?php require_once($_SERVER['DOCUMENT_ROOT'].'/includes/inc.php'); ?>
<script src="/assets/script/quill/dist/quill.js"></script>
<div id="review-loader-con">
    <div class="flex flex-col flex-align-c flex-justify-con-c gap-1 small text-muted user-select-none w-fa" id="product-loader">
        <span><svg class='wizard_input_loading' xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="128" height="128" viewBox="0 0 24 24" version="1.1"><g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"><g><polygon points="0 0 24 0 24 24 0 24"/></g><path d="M12,4 L12,6 C8.6862915,6 6,8.6862915 6,12 C6,15.3137085 8.6862915,18 12,18 C15.3137085,18 18,15.3137085 18,12 C18,10.9603196 17.7360885,9.96126435 17.2402578,9.07513926 L18.9856052,8.09853149 C19.6473536,9.28117708 20,10.6161442 20,12 C20,16.418278 16.418278,20 12,20 C7.581722,20 4,16.418278 4,12 C4,7.581722 7.581722,4 12,4 Z" class="svg" fill-rule="nonzero" opacity="0.4" transform="translate(12.000000, 12.000000) scale(-1, 1) translate(-12.000000, -12.000000) "/></g></svg></span>
        <span>Értékelések betöltése</span>
    </div>
</div>
<div class="hidden flex-row-d-col-m gap-1" id="review-con">
    <div class="flex flex-col w-fa border-soft item-bg box-shadow padding-1 gap-2">
        <div class="flex flex-col gap-05">
            <div class="flex flex-col gap-1">
                <?php require_once('includes/header.php'); ?>
            </div>
        </div>
        <div class="flex flex-col gap-05" id="add-review-con"></div>
        <div class="flex flex-col gap-2" id="reviews-container"></div>
    </div>
</div>
<script>var bal__to__form = document.getElementsByClassName('money__form'); for (let i = 0; i < bal__to__form.length; i++) { bal__to__form[i].textContent = formatter.format(bal__to__form[i].getAttribute('default-data')); }</script>
<script>var urldata = new FormData(); urldata.append("pid", urlpid);

if(document.readyState === 'ready' || document.readyState === 'complete') {
    loadReviews();
} else {
  document.onreadystatechange = function () {
    if (document.readyState == "complete") {
        loadReviews();
    }
  }
}

function loadReviews () {
    $.ajax({ enctype: "multipart/form-data", type: "POST", url: "/assets/php/webshop/info.php", data: urldata, dataType: 'json', contentType: false, processData: false,
        success: function(data) {
            document.getElementById('product-title').textContent = data.variations.brand + ' ' + data.variations.model + ' ' + data.general.name + ', ' + data.variations.color;
            __loadreviews(data.variations.model);
            document.getElementById('review-loader-con').remove();
            document.getElementById('review-con').classList.replace('hidden', 'flex');
        }
    });
}

function __loadreviews (model) { urldata.append("model", model);
    $.ajax({ enctype: "multipart/form-data", type: "POST", url: "/assets/php/webshop/rev.php", data: urldata, dataType: 'json', contentType: false, processData: false,
        beforeSend: function () {
            document.getElementById('reviews-container').innerHTML = `
            <div class="flex flex-col flex-align-c w-fa gap-05 text-muted">
                <span><svg class='wizard_input_loading' xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="128" height="128" viewBox="0 0 24 24" version="1.1"><g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"><g><polygon points="0 0 24 0 24 24 0 24"/></g><path d="M12,4 L12,6 C8.6862915,6 6,8.6862915 6,12 C6,15.3137085 8.6862915,18 12,18 C15.3137085,18 18,15.3137085 18,12 C18,10.9603196 17.7360885,9.96126435 17.2402578,9.07513926 L18.9856052,8.09853149 C19.6473536,9.28117708 20,10.6161442 20,12 C20,16.418278 16.418278,20 12,20 C7.581722,20 4,16.418278 4,12 C4,7.581722 7.581722,4 12,4 Z" class="svg" fill-rule="nonzero" opacity="0.4" transform="translate(12.000000, 12.000000) scale(-1, 1) translate(-12.000000, -12.000000) "/></g></svg></span>
                <span>Értékelések megjelenítése folyamatban</span>
            </div>
            `;
        }, success: function(data) { var aunum = 0; document.getElementById('reviews-container').innerHTML = '';
            for (let i = 0; i < data.length; i++) {
                document.getElementById('reviews-container').innerHTML += `
                <div class="flex flex-col w-60d-100m gap-1">
                    <a name="review${data[i].review.id}"></a>
                    <div class="flex flex-col gap-025">
                        <div class="flex flex-row flex-align-c gap-05 small">
                            <span class="flex flex-row flex-align-c flex-justify-con-c bold text-white box-shadow curron__head circle padding-05 small-med" id="review-init-${data[i].review.id}"></span>
                            <div class="flex flex-col text-muted">
                                <div class="flex flex-row flex-align-c gap-1" id="review-fullname-con-${data[i].review.id}">
                                    <span class="bold text-primary" id="review-fullname-${data[i].review.id}"></span>
                                </div>
                                <span class="small-med">${data[i].review.date}</span>
                            </div>
                        </div>
                        <div class="flex flex-row flex-align-c gap-1" id="review-bot-header-${data[i].review.id}">
                            <div class="flex flex-row" id="review-stars-${data[i].review.id}"></div>
                        </div>
                        <div class="flex flex-row flex-align-c text-muted small-med gap-05 review-tag-con">
                            <span>Szín: ${data[i].variations.color}</span>
                            <span>Model: ${data[i].variations.model}</span>
                        </div>
                    </div>
                    <div class="flex flex-col">
                        <div class="text-secondary review-desc" id="review-description-${data[i].review.id}"></div>
                    </div>
                    <div class="flex flex-col gap-05">
                        <span class="text-muted small-med" id="review-helpful-ind-${data[i].review.id}"></span>
                        <div class="flex flex-row flex-align-c gap-1 small-med">
                            <span class="background-bg background-bg-hover border-soft text-secondary user-select-none pointer box-shadow" style="padding: .5rem 1rem;" id="review-action-${data[i].review.id}"></span>
                            <span class="text-muted user-select-none pointer" id="review-secact-${data[i].review.id}"></span>
                        </div>
                    </div>
                </div>
                `;
                for (let j = 0; j < data[i].review.stars; j++) { document.getElementById('review-stars-'+data[i].review.id).innerHTML += `<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="18px" height="18px" viewBox="0 0 24 24" version="1.1"><g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"><polygon points="0 0 24 0 24 24 0 24"></polygon><path d="M12,18 L7.91561963,20.1472858 C7.42677504,20.4042866 6.82214789,20.2163401 6.56514708,19.7274955 C6.46280801,19.5328351 6.42749334,19.309867 6.46467018,19.0931094 L7.24471742,14.545085 L3.94038429,11.3241562 C3.54490071,10.938655 3.5368084,10.3055417 3.92230962,9.91005817 C4.07581822,9.75257453 4.27696063,9.65008735 4.49459766,9.61846284 L9.06107374,8.95491503 L11.1032639,4.81698575 C11.3476862,4.32173209 11.9473121,4.11839309 12.4425657,4.36281539 C12.6397783,4.46014562 12.7994058,4.61977315 12.8967361,4.81698575 L14.9389263,8.95491503 L19.5054023,9.61846284 C20.0519472,9.69788046 20.4306287,10.2053233 20.351211,10.7518682 C20.3195865,10.9695052 20.2170993,11.1706476 20.0596157,11.3241562 L16.7552826,14.545085 L17.5353298,19.0931094 C17.6286908,19.6374458 17.263103,20.1544017 16.7187666,20.2477627 C16.5020089,20.2849396 16.2790408,20.2496249 16.0843804,20.1472858 L12,18 Z" fill="#f6cc00" opacity=".6"></path></g></svg>`; }
                for (let j = 0; j < 5-data[i].review.stars; j++) { document.getElementById('review-stars-'+data[i].review.id).innerHTML += `<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="18px" height="18px" viewBox="0 0 24 24" version="1.1"><g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"><polygon points="0 0 24 0 24 24 0 24"></polygon><path d="M12,18 L7.91561963,20.1472858 C7.42677504,20.4042866 6.82214789,20.2163401 6.56514708,19.7274955 C6.46280801,19.5328351 6.42749334,19.309867 6.46467018,19.0931094 L7.24471742,14.545085 L3.94038429,11.3241562 C3.54490071,10.938655 3.5368084,10.3055417 3.92230962,9.91005817 C4.07581822,9.75257453 4.27696063,9.65008735 4.49459766,9.61846284 L9.06107374,8.95491503 L11.1032639,4.81698575 C11.3476862,4.32173209 11.9473121,4.11839309 12.4425657,4.36281539 C12.6397783,4.46014562 12.7994058,4.61977315 12.8967361,4.81698575 L14.9389263,8.95491503 L19.5054023,9.61846284 C20.0519472,9.69788046 20.4306287,10.2053233 20.351211,10.7518682 C20.3195865,10.9695052 20.2170993,11.1706476 20.0596157,11.3241562 L16.7552826,14.545085 L17.5353298,19.0931094 C17.6286908,19.6374458 17.263103,20.1544017 16.7187666,20.2477627 C16.5020089,20.2849396 16.2790408,20.2496249 16.0843804,20.1472858 L12,18 Z" fill="#A1A5B7" opacity=".6"></path></g></svg>`; }
                if (data[i].user.auth) { document.getElementById('review-bot-header-'+data[i].review.id).innerHTML += `<span class="primary-bg border-soft-light padding-025 smaller">Hitelesített vásárló</span>`; }
                document.getElementById('review-description-'+data[i].review.id).innerHTML = data[i].review.description;
                if (data[i].user.author == true) { document.getElementById('review-action-'+data[i].review.id).textContent = "Szerkesztés";document.getElementById('review-secact-'+data[i].review.id).textContent = "Eltávolítás"; document.getElementById('review-secact-'+data[i].review.id).setAttribute('onclick', '__removereview('+data[i].review.id+')');
                    document.getElementById('review-action-'+data[i].review.id).setAttribute('onclick', '__editreview('+data[i].review.id+', "'+data[i].review.description.replaceAll('"', "'")+'", '+data[i].review.priv_ena+', '+data[i].user.private+')');
                    document.getElementById('review-fullname-'+data[i].review.id).textContent = data[i].user.fullname; document.getElementById('review-init-'+data[i].review.id).title = data[i].user.fullname; document.getElementById('review-init-'+data[i].review.id).textContent = data[i].initials.initials; document.getElementById('review-init-'+data[i].review.id).style.background = '#'+data[i].initials.color;
                    if (data[i].user.private == true) { document.getElementById('review-bot-header-'+data[i].review.id).innerHTML += `<span class="flex flex-row gap-025 background-bg text-muted border-soft-light padding-025 smaller"><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="10px" height="10px" viewBox="0 0 24 24" version="1.1"><g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"><mask fill="white"><use xlink:href="#path-1"/></mask><g/><path d="M7,10 L7,8 C7,5.23857625 9.23857625,3 12,3 C14.7614237,3 17,5.23857625 17,8 L17,10 L18,10 C19.1045695,10 20,10.8954305 20,12 L20,18 C20,19.1045695 19.1045695,20 18,20 L6,20 C4.8954305,20 4,19.1045695 4,18 L4,12 C4,10.8954305 4.8954305,10 6,10 L7,10 Z M12,5 C10.3431458,5 9,6.34314575 9,8 L9,10 L15,10 L15,8 C15,6.34314575 13.6568542,5 12,5 Z" fill="currentColor"/></g></svg><span>Privát fiók</span></span>`; }
                } else { document.getElementById('review-action-'+data[i].review.id).textContent = "Hasznos";document.getElementById('review-secact-'+data[i].review.id).textContent = "Visszaélés jelentése";document.getElementById('review-secact-'+data[i].review.id).setAttribute('onclick', '__reportreview('+data[i].review.id+')');document.getElementById('review-action-'+data[i].review.id).setAttribute('onclick', '__flagreview('+data[i].review.id+')');
                    if (data[i].user.private == true) {document.getElementById('review-bot-header-'+data[i].review.id).innerHTML += `<span class="flex flex-row gap-025 background-bg text-muted border-soft-light padding-025 smaller"><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="10px" height="10px" viewBox="0 0 24 24" version="1.1"><g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"><mask fill="white"><use xlink:href="#path-1"/></mask><g/><path d="M7,10 L7,8 C7,5.23857625 9.23857625,3 12,3 C14.7614237,3 17,5.23857625 17,8 L17,10 L18,10 C19.1045695,10 20,10.8954305 20,12 L20,18 C20,19.1045695 19.1045695,20 18,20 L6,20 C4.8954305,20 4,19.1045695 4,18 L4,12 C4,10.8954305 4.8954305,10 6,10 L7,10 Z M12,5 C10.3431458,5 9,6.34314575 9,8 L9,10 L15,10 L15,8 C15,6.34314575 13.6568542,5 12,5 Z" fill="currentColor"/></g></svg><span>Privát fiók</span></span>`;
                        document.getElementById('review-fullname-'+data[i].review.id).textContent = 'Privát fiók';document.getElementById('review-init-'+data[i].review.id).title = 'Privát fiók';
                        document.getElementById('review-init-'+data[i].review.id).textContent = 'PF';document.getElementById('review-init-'+data[i].review.id).style.background = '#9c9d9f';
                    } else { document.getElementById('review-fullname-'+data[i].review.id).textContent = data[i].user.fullname;document.getElementById('review-init-'+data[i].review.id).title = data[i].user.fullname;document.getElementById('review-init-'+data[i].review.id).textContent = data[i].initials.initials;document.getElementById('review-init-'+data[i].review.id).style.background = '#'+data[i].initials.color; }
                    if (data[i].review.flagged) { document.getElementById('review-action-'+data[i].review.id).textContent = 'Nem hasznos'; } else { document.getElementById('review-action-'+data[i].review.id).textContent = 'Hasznos'; }
                    if (data[i].review.reported) { document.getElementById('review-secact-'+data[i].review.id).textContent = 'Jelentve'; document.getElementById('review-secact-'+data[i].review.id).classList.remove('pointer'); document.getElementById('review-secact-'+data[i].review.id).removeAttribute('onclick'); } else { document.getElementById('review-secact-'+data[i].review.id).textContent = 'Visszaélés jelentése'; }
                } document.getElementById('review-helpful-ind-'+data[i].review.id).textContent = Number(data[i].review.helpful) + ' ember találta ezt hasznosnak';
                if (data[i].user.author == true) { aunum++; }
            }
            if (aunum == 0) {
                document.getElementById('add-review-con').classList.replace('display-none', 'flex');
                document.getElementById('add-review-con').innerHTML = `<span class="text-primary small bold">Értékelje ezt a terméket</span>
                <span class="text-secondary small-med">Ossza meg véleményét erről a termérkől más vásárlókkal is.</span>
                <div class="flex flex-row flex-align-c gap-1" id="write-review-act-con">
                    <span id="write-review" onclick="__addreview()" class="background-bg background-bg-hover text-primary padding-05-105 border-soft-light box-shadow-sh small-med pointer user-select-none w-fc">Értékelés írása</span>
                </div>
                <div id="write-review-con" class="flex flex-col gap-1 w-fa"></div>`;
            } else { if (document.getElementById('add-review-con')) { document.getElementById('add-review-con').innerHTML = ``; document.getElementById('add-review-con').classList.replace('flex', 'display-none'); } }
            <?php if (!isset($_SESSION['id'])) { echo 'document.getElementById("add-review-con").innerHTML = ``; document.getElementById("add-review-con").classList.replace("flex", "display-none");'; } ?>
            __loadstars();
        }, error: function (data) { console.log(data); }
    });
} function __addreview () {
    document.getElementById('write-review-act-con').innerHTML += `<span class="text-muted small-med user-select-none pointer" id="review-cancel" onclick="__canceladdreview();">Mégsem</span>`;
    document.getElementById('write-review').textContent = "Küldés";
    document.getElementById('write-review').removeAttribute('onclick');
    document.getElementById('write-review').classList.remove('pointer');document.getElementById('write-review').classList.remove('background-bg-hover'); document.getElementById('write-review').classList.add('not-allowed');
    document.getElementById('write-review-con').innerHTML = `
    <div class="flex flex-col gap-1 w-60d-100m">
        <div class="flex flex-row flex-align-c flex-justify-con-sb">
            <div id="e__stars"></div>
            <div class="flex flex-col"><div class="flex flex-row flex-align-c gap-1"><label class="cst-chb-lbl"><input type="checkbox" class="absolute" name="product-review-privacy" id="product-review-privacy"><span class="cst-checkbox"></span></label><span class="text-secondary small" style="line-height: 2rem;">Nevem feltüntetése</span></div><span class="text-muted small-med">Nevem mutatása / rejtése.</span></div>
        </div>
        <div class="flex flex-col">
            <div id="add-review-editor" style="height: 12rem;"></div>
        </div>
    </div>
    `;
    var quill = new Quill('#add-review-editor', { modules: { toolbar: [ [{ header: [1, 2, false] }], ['bold', 'italic', 'underline', 'strike'], ['image', 'link'], [{list: 'ordered'}, {list: 'bullet'}] ] }, placeholder: 'Ide írja az értékelését...', theme: 'snow' });
    function getSiblings(element, type) { var arraySib = []; if ( type == "prev" ) { while ( element = element.previousSibling ) { arraySib.push(element); } } else if ( type == "next" ) { while ( element = element.nextSibling ) { arraySib.push(element); } } return arraySib; }
    for (var i = 1; i <= 5; i++) { document.getElementById("e__stars").innerHTML += `<span class="r__icon"><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="32px" height="32px" viewBox="0 0 24 24" version="1.1"><g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"><polygon points="0 0 24 0 24 24 0 24"></polygon><path d="M12,18 L7.91561963,20.1472858 C7.42677504,20.4042866 6.82214789,20.2163401 6.56514708,19.7274955 C6.46280801,19.5328351 6.42749334,19.309867 6.46467018,19.0931094 L7.24471742,14.545085 L3.94038429,11.3241562 C3.54490071,10.938655 3.5368084,10.3055417 3.92230962,9.91005817 C4.07581822,9.75257453 4.27696063,9.65008735 4.49459766,9.61846284 L9.06107374,8.95491503 L11.1032639,4.81698575 C11.3476862,4.32173209 11.9473121,4.11839309 12.4425657,4.36281539 C12.6397783,4.46014562 12.7994058,4.61977315 12.8967361,4.81698575 L14.9389263,8.95491503 L19.5054023,9.61846284 C20.0519472,9.69788046 20.4306287,10.2053233 20.351211,10.7518682 C20.3195865,10.9695052 20.2170993,11.1706476 20.0596157,11.3241562 L16.7552826,14.545085 L17.5353298,19.0931094 C17.6286908,19.6374458 17.263103,20.1544017 16.7187666,20.2477627 C16.5020089,20.2849396 16.2790408,20.2496249 16.0843804,20.1472858 L12,18 Z" class="svg" opacity=".3"></path></g></svg></span>`; } var icon = document.getElementsByClassName("r__icon");
    for (var i = 0; i < icon.length; i++) {
        icon[i].addEventListener("click", function () { this.innerHTML = `<svg class="s__active" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="32px" height="32px" viewBox="0 0 24 24" version="1.1"><g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"><polygon points="0 0 24 0 24 24 0 24"></polygon><path d="M12,18 L7.91561963,20.1472858 C7.42677504,20.4042866 6.82214789,20.2163401 6.56514708,19.7274955 C6.46280801,19.5328351 6.42749334,19.309867 6.46467018,19.0931094 L7.24471742,14.545085 L3.94038429,11.3241562 C3.54490071,10.938655 3.5368084,10.3055417 3.92230962,9.91005817 C4.07581822,9.75257453 4.27696063,9.65008735 4.49459766,9.61846284 L9.06107374,8.95491503 L11.1032639,4.81698575 C11.3476862,4.32173209 11.9473121,4.11839309 12.4425657,4.36281539 C12.6397783,4.46014562 12.7994058,4.61977315 12.8967361,4.81698575 L14.9389263,8.95491503 L19.5054023,9.61846284 C20.0519472,9.69788046 20.4306287,10.2053233 20.351211,10.7518682 C20.3195865,10.9695052 20.2170993,11.1706476 20.0596157,11.3241562 L16.7552826,14.545085 L17.5353298,19.0931094 C17.6286908,19.6374458 17.263103,20.1544017 16.7187666,20.2477627 C16.5020089,20.2849396 16.2790408,20.2496249 16.0843804,20.1472858 L12,18 Z" fill="#f6cc00"></path></g></svg>`;
            var prev = getSiblings(this, "prev"); var next = getSiblings(this, "next");
            for(p = 0; p < prev.length; p++) { prev[p].innerHTML = `<svg class="s__active" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="32px" height="32px" viewBox="0 0 24 24" version="1.1"><g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"><polygon points="0 0 24 0 24 24 0 24"></polygon><path d="M12,18 L7.91561963,20.1472858 C7.42677504,20.4042866 6.82214789,20.2163401 6.56514708,19.7274955 C6.46280801,19.5328351 6.42749334,19.309867 6.46467018,19.0931094 L7.24471742,14.545085 L3.94038429,11.3241562 C3.54490071,10.938655 3.5368084,10.3055417 3.92230962,9.91005817 C4.07581822,9.75257453 4.27696063,9.65008735 4.49459766,9.61846284 L9.06107374,8.95491503 L11.1032639,4.81698575 C11.3476862,4.32173209 11.9473121,4.11839309 12.4425657,4.36281539 C12.6397783,4.46014562 12.7994058,4.61977315 12.8967361,4.81698575 L14.9389263,8.95491503 L19.5054023,9.61846284 C20.0519472,9.69788046 20.4306287,10.2053233 20.351211,10.7518682 C20.3195865,10.9695052 20.2170993,11.1706476 20.0596157,11.3241562 L16.7552826,14.545085 L17.5353298,19.0931094 C17.6286908,19.6374458 17.263103,20.1544017 16.7187666,20.2477627 C16.5020089,20.2849396 16.2790408,20.2496249 16.0843804,20.1472858 L12,18 Z" fill="#f6cc00"></path></g></svg>`; }
            for (n = 0; n < next.length; n++) { next[n].innerHTML = `<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="32px" height="32px" viewBox="0 0 24 24" version="1.1"><g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"><polygon points="0 0 24 0 24 24 0 24"></polygon><path d="M12,18 L7.91561963,20.1472858 C7.42677504,20.4042866 6.82214789,20.2163401 6.56514708,19.7274955 C6.46280801,19.5328351 6.42749334,19.309867 6.46467018,19.0931094 L7.24471742,14.545085 L3.94038429,11.3241562 C3.54490071,10.938655 3.5368084,10.3055417 3.92230962,9.91005817 C4.07581822,9.75257453 4.27696063,9.65008735 4.49459766,9.61846284 L9.06107374,8.95491503 L11.1032639,4.81698575 C11.3476862,4.32173209 11.9473121,4.11839309 12.4425657,4.36281539 C12.6397783,4.46014562 12.7994058,4.61977315 12.8967361,4.81698575 L14.9389263,8.95491503 L19.5054023,9.61846284 C20.0519472,9.69788046 20.4306287,10.2053233 20.351211,10.7518682 C20.3195865,10.9695052 20.2170993,11.1706476 20.0596157,11.3241562 L16.7552826,14.545085 L17.5353298,19.0931094 C17.6286908,19.6374458 17.263103,20.1544017 16.7187666,20.2477627 C16.5020089,20.2849396 16.2790408,20.2496249 16.0843804,20.1472858 L12,18 Z" class="svg" opacity=".3"></path></g></svg>`; }
            document.getElementById('write-review').classList.add('pointer');document.getElementById('write-review').classList.add('background-bg-hover'); document.getElementById('write-review').classList.remove('not-allowed'); document.getElementById('write-review').setAttribute('onclick', '__postreview('+Number(prev.length+1)+')');
        });
    }
} function __postreview (stars) {
    if (stars > 0) { 
        $.ajax({url: "https://api.ipdata.co?api-key=739837e232548988c86b954108794b57bd3e1dbcd6eb550bfa53e544", dataType: 'json',
            success : function (api) {
                var reviewData = new FormData(); 
                const reviewObject = {
                    ip  : api.ip,
                    action : 'post',
                    
                    pid:  urlpid,
                    description:  document.getElementById('add-review-editor').getElementsByClassName('ql-editor')[0].innerHTML,
                    stars:  stars,
                    privacy : (document.getElementById('product-review-privacy')) ? (document.getElementById('product-review-privacy').checked ? 0 : 1) : false

                }; reviewData.append('review', JSON.stringify(reviewObject));
                const ajaxObject = { 
                    url : '/assets/php/classes/class.Reviews.php',
                    data : reviewData,
                    loaderContainer : { isset : false }
                }
                let response = getFromAjaxRequest(ajaxObject)
                .then((data) => {
                    document.getElementById('add-review-con').innerHTML = ``;
                    document.getElementById('add-review-con').classList.replace('flex', 'display-none'); 
                    __loadreviews(urlmodel);
                    if (data.status == 'success') {
                        notificationSystem(0, 3, 0, 'Üzenet', 'Sikeres publikálás.');
                    } else {
                        notificationSystem(0, 2, 0, 'Üzenet', 'Sikertelen publikálás.');
                    }
                }) .catch((reason) => {
                    document.getElementById('add-review-con').innerHTML = ``;
                    document.getElementById('add-review-con').classList.replace('flex', 'display-none'); 
                    __loadreviews(urlmodel);
                    notificationSystem(0, 2, 0, 'Üzenet', 'Sikertelen publikálás.');
                });
            }
        });
    }
} function __canceladdreview () {
    document.getElementById('write-review-con').innerHTML = ``; document.getElementById('review-cancel').remove();
    document.getElementById('write-review').textContent = "Értékelés írása"; document.getElementById('write-review').classList.add('pointer');document.getElementById('write-review').classList.add('background-bg-hover'); document.getElementById('write-review').classList.remove('not-allowed'); document.getElementById('write-review').setAttribute('onclick', '__addreview()');
} function __flagreview (rid) {

    $.ajax({url: "https://api.ipdata.co?api-key=739837e232548988c86b954108794b57bd3e1dbcd6eb550bfa53e544", dataType: 'json',
        success : function (api) {
            var reviewData = new FormData(); 
            const reviewObject = {
                ip  : api.ip,
                action : 'flag',
                
                rid:  rid
            }; reviewData.append('review', JSON.stringify(reviewObject));
            const ajaxObject = { 
                url : '/assets/php/classes/class.Reviews.php',
                data : reviewData,
                loaderContainer : { isset : false }
            }
            let response = getFromAjaxRequest(ajaxObject)
            .then((data) => {
                if (data.status == 'success') {
                    if (data.result == 'flagged') {
                        document.getElementById('review-action-'+rid).textContent = 'Nem hasznos';
                    } if (data.result == 'unflagged') {
                        document.getElementById('review-action-'+rid).textContent = 'Hasznos';
                    }
                    reviewObject.action = 'flagCount';
                    reviewData.append('review', JSON.stringify(reviewObject));
                    const ajaxObject = { 
                        url : '/assets/php/classes/class.Reviews.php',
                        data : reviewData,
                        loaderContainer : { isset : false }
                    }
                    let response = getFromAjaxRequest(ajaxObject)
                    .then((data) => {
                        if (data.status == 'success') {
                            document.getElementById('review-helpful-ind-'+rid).textContent = data.count + ' ember találta ezt hasznosnak';
                        } else {
                            document.getElementById('review-helpful-ind-'+rid).textContent = 'Hiba történt a megjelenítés közben.';
                        }
                    }) .catch((reason) => {
                        document.getElementById('review-helpful-ind-'+rid).textContent = 'Hiba történt a megjelenítés közben.';
                    });
                } else {
                    notificationSystem(0, 2, 0, 'Üzenet', 'Sikertelen művelet.');
                }
            }) .catch((reason) => {
                notificationSystem(0, 2, 0, 'Üzenet', 'Sikertelen művelet.');
            });
        }
    });

} function __editreview (rid, desc, privacy, upriv) {
    document.getElementById('review-description-'+rid).innerHTML = `
    <hr style="border: 1px solid var(--background);" class="w-100">
    <div class="flex flex-col gap-1">
        <div class="flex flex-row flex-align-c flex-justify-con-sb">
            <div class="flex flex-row" id="e__stars"></div>
            <div class="flex flex-row" id="review-priv-mode"></div>
        </div>
        <div><div id="review-editor" style="height: 12rem;"></div></div>
    </div>`;
    function getSiblings(element, type) { var arraySib = []; if ( type == "prev" ) { while ( element = element.previousSibling ) { arraySib.push(element); } } else if ( type == "next" ) { while ( element = element.nextSibling ) { arraySib.push(element); } } return arraySib; }
    for (var i = 1; i <= 5; i++) { document.getElementById("e__stars").innerHTML += `<span class="r__icon"><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="32px" height="32px" viewBox="0 0 24 24" version="1.1"><g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"><polygon points="0 0 24 0 24 24 0 24"></polygon><path d="M12,18 L7.91561963,20.1472858 C7.42677504,20.4042866 6.82214789,20.2163401 6.56514708,19.7274955 C6.46280801,19.5328351 6.42749334,19.309867 6.46467018,19.0931094 L7.24471742,14.545085 L3.94038429,11.3241562 C3.54490071,10.938655 3.5368084,10.3055417 3.92230962,9.91005817 C4.07581822,9.75257453 4.27696063,9.65008735 4.49459766,9.61846284 L9.06107374,8.95491503 L11.1032639,4.81698575 C11.3476862,4.32173209 11.9473121,4.11839309 12.4425657,4.36281539 C12.6397783,4.46014562 12.7994058,4.61977315 12.8967361,4.81698575 L14.9389263,8.95491503 L19.5054023,9.61846284 C20.0519472,9.69788046 20.4306287,10.2053233 20.351211,10.7518682 C20.3195865,10.9695052 20.2170993,11.1706476 20.0596157,11.3241562 L16.7552826,14.545085 L17.5353298,19.0931094 C17.6286908,19.6374458 17.263103,20.1544017 16.7187666,20.2477627 C16.5020089,20.2849396 16.2790408,20.2496249 16.0843804,20.1472858 L12,18 Z" class="svg" opacity=".3"></path></g></svg></span>`; } var icon = document.getElementsByClassName("r__icon");
    for (var i = 0; i < icon.length; i++) {
        icon[i].addEventListener("click", function () { this.innerHTML = `<svg class="s__active" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="32px" height="32px" viewBox="0 0 24 24" version="1.1"><g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"><polygon points="0 0 24 0 24 24 0 24"></polygon><path d="M12,18 L7.91561963,20.1472858 C7.42677504,20.4042866 6.82214789,20.2163401 6.56514708,19.7274955 C6.46280801,19.5328351 6.42749334,19.309867 6.46467018,19.0931094 L7.24471742,14.545085 L3.94038429,11.3241562 C3.54490071,10.938655 3.5368084,10.3055417 3.92230962,9.91005817 C4.07581822,9.75257453 4.27696063,9.65008735 4.49459766,9.61846284 L9.06107374,8.95491503 L11.1032639,4.81698575 C11.3476862,4.32173209 11.9473121,4.11839309 12.4425657,4.36281539 C12.6397783,4.46014562 12.7994058,4.61977315 12.8967361,4.81698575 L14.9389263,8.95491503 L19.5054023,9.61846284 C20.0519472,9.69788046 20.4306287,10.2053233 20.351211,10.7518682 C20.3195865,10.9695052 20.2170993,11.1706476 20.0596157,11.3241562 L16.7552826,14.545085 L17.5353298,19.0931094 C17.6286908,19.6374458 17.263103,20.1544017 16.7187666,20.2477627 C16.5020089,20.2849396 16.2790408,20.2496249 16.0843804,20.1472858 L12,18 Z" fill="#f6cc00"></path></g></svg>`;
            var prev = getSiblings(this, "prev"); var next = getSiblings(this, "next");
            for(p = 0; p < prev.length; p++) { prev[p].innerHTML = `<svg class="s__active" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="32px" height="32px" viewBox="0 0 24 24" version="1.1"><g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"><polygon points="0 0 24 0 24 24 0 24"></polygon><path d="M12,18 L7.91561963,20.1472858 C7.42677504,20.4042866 6.82214789,20.2163401 6.56514708,19.7274955 C6.46280801,19.5328351 6.42749334,19.309867 6.46467018,19.0931094 L7.24471742,14.545085 L3.94038429,11.3241562 C3.54490071,10.938655 3.5368084,10.3055417 3.92230962,9.91005817 C4.07581822,9.75257453 4.27696063,9.65008735 4.49459766,9.61846284 L9.06107374,8.95491503 L11.1032639,4.81698575 C11.3476862,4.32173209 11.9473121,4.11839309 12.4425657,4.36281539 C12.6397783,4.46014562 12.7994058,4.61977315 12.8967361,4.81698575 L14.9389263,8.95491503 L19.5054023,9.61846284 C20.0519472,9.69788046 20.4306287,10.2053233 20.351211,10.7518682 C20.3195865,10.9695052 20.2170993,11.1706476 20.0596157,11.3241562 L16.7552826,14.545085 L17.5353298,19.0931094 C17.6286908,19.6374458 17.263103,20.1544017 16.7187666,20.2477627 C16.5020089,20.2849396 16.2790408,20.2496249 16.0843804,20.1472858 L12,18 Z" fill="#f6cc00"></path></g></svg>`; }
            for (n = 0; n < next.length; n++) { next[n].innerHTML = `<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="32px" height="32px" viewBox="0 0 24 24" version="1.1"><g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"><polygon points="0 0 24 0 24 24 0 24"></polygon><path d="M12,18 L7.91561963,20.1472858 C7.42677504,20.4042866 6.82214789,20.2163401 6.56514708,19.7274955 C6.46280801,19.5328351 6.42749334,19.309867 6.46467018,19.0931094 L7.24471742,14.545085 L3.94038429,11.3241562 C3.54490071,10.938655 3.5368084,10.3055417 3.92230962,9.91005817 C4.07581822,9.75257453 4.27696063,9.65008735 4.49459766,9.61846284 L9.06107374,8.95491503 L11.1032639,4.81698575 C11.3476862,4.32173209 11.9473121,4.11839309 12.4425657,4.36281539 C12.6397783,4.46014562 12.7994058,4.61977315 12.8967361,4.81698575 L14.9389263,8.95491503 L19.5054023,9.61846284 C20.0519472,9.69788046 20.4306287,10.2053233 20.351211,10.7518682 C20.3195865,10.9695052 20.2170993,11.1706476 20.0596157,11.3241562 L16.7552826,14.545085 L17.5353298,19.0931094 C17.6286908,19.6374458 17.263103,20.1544017 16.7187666,20.2477627 C16.5020089,20.2849396 16.2790408,20.2496249 16.0843804,20.1472858 L12,18 Z" class="svg" opacity=".3"></path></g></svg>`; }
            document.getElementById('review-action-'+rid).setAttribute('onclick', '__savereview('+rid+', '+privacy+', '+(prev.length+1)+')'); 
            document.getElementById('review-action-'+rid).classList.add('background-bg-hover'); document.getElementById('review-action-'+rid).classList.add('pointer'); document.getElementById('review-action-'+rid).classList.remove('not-allowed');
        });
    } document.getElementById('review-action-'+rid).classList.remove('background-bg-hover'); document.getElementById('review-action-'+rid).classList.remove('pointer'); document.getElementById('review-action-'+rid).classList.add('not-allowed');
    document.getElementById('review-priv-mode').innerHTML = privacy == false ? `<div class="flex flex-col"><div class="flex flex-row flex-align-c gap-1"><label class="cst-chb-lbl"><input type="checkbox" class="absolute" name="product-review-privacy" id="product-review-privacy"><span class="cst-checkbox"></span></label><span class="text-secondary small" style="line-height: 2rem;">Nevem feltüntetése</span></div><span class="text-muted small-med">Nevem mutatása / rejtése.</span></div>` : ``;
    if (privacy == false) { upriv == false ? document.getElementById('product-review-privacy').setAttribute('checked', 'checked') : document.getElementById('product-review-privacy').removeAttribute('checked'); }
    var quill = new Quill('#review-editor', { modules: { toolbar: [ [{ header: [1, 2, false] }], ['bold', 'italic', 'underline', 'strike'], ['image', 'link'], [{list: 'ordered'}, {list: 'bullet'}] ] }, placeholder: 'Ide írja az értékelését...', theme: 'snow' });
    document.getElementById('review-editor').getElementsByClassName('ql-editor')[0].innerHTML = desc;
    document.getElementById('review-action-'+rid).removeAttribute('onclick');  document.getElementById('review-secact-'+rid).setAttribute('onclick', '__cancelreview('+rid+', "'+desc+'", '+privacy+', '+upriv+')');
    document.getElementById('review-action-'+rid).textContent = "Mentés"; document.getElementById('review-secact-'+rid).textContent = "Mégsem";
} function __savereview (rid, privacy, stars) {
    $.ajax({url: "https://api.ipdata.co?api-key=739837e232548988c86b954108794b57bd3e1dbcd6eb550bfa53e544", dataType: 'json',
        success : function (api) {
            var reviewData = new FormData(); 
            const reviewObject = {
                ip  : api.ip,
                action : 'update',
                
                rid:  rid,
                stars : stars,
                description : document.getElementById('review-editor').getElementsByClassName('ql-editor')[0].innerHTML,
                privacy : (document.getElementById('product-review-privacy')) ? (document.getElementById('product-review-privacy').checked ? 0 : 1) : false
            }; reviewData.append('review', JSON.stringify(reviewObject));
            const ajaxObject = { 
                url : '/assets/php/classes/class.Reviews.php',
                data : reviewData,
                loaderContainer : { isset : false }
            }
            let response = getFromAjaxRequest(ajaxObject)
            .then((data) => {
                __loadreviews(urlmodel);
                if (data.status == 'success') {
                    notificationSystem(0, 3, 0, 'Üzenet', 'Sikeres szerkesztés.');
                } else {
                    notificationSystem(0, 2, 0, 'Üzenet', 'Sikertelen szerkesztés.');
                }
            }) .catch((reason) => {
                __loadreviews(urlmodel);
                notificationSystem(0, 2, 0, 'Üzenet', 'Sikertelen szerkesztés.');
            });
        }
    });

} function __cancelreview (rid, desc, privacy, upriv) { document.getElementById('review-action-'+rid).classList.add('background-bg-hover'); document.getElementById('review-action-'+rid).classList.add('pointer'); document.getElementById('review-action-'+rid).classList.remove('not-allowed');
    document.getElementById('review-description-'+rid).innerHTML = desc;document.getElementById('review-action-'+rid).setAttribute('onclick', '__editreview('+rid+', "'+desc+'", '+privacy+', '+upriv+')'); document.getElementById('review-secact-'+rid).setAttribute('onclick', '__removereview('+rid+')');
    document.getElementById('review-action-'+rid).textContent = "Szerkesztés"; document.getElementById('review-secact-'+rid).textContent = "Eltávolítás"; document.getElementById('review-secact-'+rid).setAttribute('onclick', '__removereview('+rid+')');
} function __removereview (rid) {
    if (confirm('Biztosan törölni szeretné értékelését?') == true) {
        $.ajax({url: "https://api.ipdata.co?api-key=739837e232548988c86b954108794b57bd3e1dbcd6eb550bfa53e544", dataType: 'json',
            success : function (api) {
                var reviewData = new FormData(); 
                const reviewObject = {
                    ip  : api.ip,
                    action : 'delete',
                    
                    rid:  rid

                }; reviewData.append('review', JSON.stringify(reviewObject));
                const ajaxObject = { 
                    url : '/assets/php/classes/class.Reviews.php',
                    data : reviewData,
                    loaderContainer : { isset : false }
                }
                let response = getFromAjaxRequest(ajaxObject)
                .then((data) => {
                    __loadreviews(urlmodel);
                    if (data.status == 'success') {
                        notificationSystem(0, 3, 0, 'Üzenet', 'Sikeres törlés.');
                    } else {
                        notificationSystem(0, 2, 0, 'Üzenet', 'Sikertelen törlés.');
                    }
                }) .catch((reason) => {
                    __loadreviews(urlmodel);
                    notificationSystem(0, 2, 0, 'Üzenet', 'Sikertelen törlés.');
                });
            }
        });
    }
} function __reportreview (rid) {
    if (confirm('Biztosan jelenteni szeretné ezt az értékelést?')) {
        
        $.ajax({url: "https://api.ipdata.co?api-key=739837e232548988c86b954108794b57bd3e1dbcd6eb550bfa53e544", dataType: 'json',
            success : function (api) {
                var reviewData = new FormData(); 
                const reviewObject = {
                    ip  : api.ip,
                    action : 'report',
                    
                    rid:  rid

                }; reviewData.append('review', JSON.stringify(reviewObject));
                const ajaxObject = { 
                    url : '/assets/php/classes/class.Reviews.php',
                    data : reviewData,
                    loaderContainer : { isset : false }
                }
                let response = getFromAjaxRequest(ajaxObject)
                .then((data) => {
                    if (data.status == 'success') {
                        document.getElementById('review-secact-'+rid).textContent = 'Jelentve';
                        document.getElementById('review-secact-'+rid).removeAttribute('onclick');
                        document.getElementById('review-secact-'+rid).classList.remove('pointer');
                    } else {
                        notificationSystem(0, 2, 0, 'Üzenet', 'Sikertelen jelentés.');
                    }
                }) .catch((reason) => {
                    notificationSystem(0, 2, 0, 'Üzenet', 'Sikertelen jelentés.');
                });
            }
        });        

    }
} function __loadstars () {
    $.ajax({ enctype: "multipart/form-data", type: "POST", url: "/assets/php/webshop/stars.php", data: urldata, dataType: 'json', contentType: false, processData: false,
        success: function(data) {
            if (data.count > 0) { document.getElementById('star__ind').innerHTML = `<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="22px" height="22px" viewBox="0 0 24 24" version="1.1"><g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"><polygon points="0 0 24 0 24 24 0 24"></polygon><path d="M12,18 L7.91561963,20.1472858 C7.42677504,20.4042866 6.82214789,20.2163401 6.56514708,19.7274955 C6.46280801,19.5328351 6.42749334,19.309867 6.46467018,19.0931094 L7.24471742,14.545085 L3.94038429,11.3241562 C3.54490071,10.938655 3.5368084,10.3055417 3.92230962,9.91005817 C4.07581822,9.75257453 4.27696063,9.65008735 4.49459766,9.61846284 L9.06107374,8.95491503 L11.1032639,4.81698575 C11.3476862,4.32173209 11.9473121,4.11839309 12.4425657,4.36281539 C12.6397783,4.46014562 12.7994058,4.61977315 12.8967361,4.81698575 L14.9389263,8.95491503 L19.5054023,9.61846284 C20.0519472,9.69788046 20.4306287,10.2053233 20.351211,10.7518682 C20.3195865,10.9695052 20.2170993,11.1706476 20.0596157,11.3241562 L16.7552826,14.545085 L17.5353298,19.0931094 C17.6286908,19.6374458 17.263103,20.1544017 16.7187666,20.2477627 C16.5020089,20.2849396 16.2790408,20.2496249 16.0843804,20.1472858 L12,18 Z" fill="#f6cc00" opacity=".6"></path></g></svg>`; document.getElementById('star__count').textContent = data.count; }
            else { document.getElementById('star__ind').innerHTML = `<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="22px" height="22px" viewBox="0 0 24 24" version="1.1"><g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"><polygon points="0 0 24 0 24 24 0 24"></polygon><path d="M12,18 L7.91561963,20.1472858 C7.42677504,20.4042866 6.82214789,20.2163401 6.56514708,19.7274955 C6.46280801,19.5328351 6.42749334,19.309867 6.46467018,19.0931094 L7.24471742,14.545085 L3.94038429,11.3241562 C3.54490071,10.938655 3.5368084,10.3055417 3.92230962,9.91005817 C4.07581822,9.75257453 4.27696063,9.65008735 4.49459766,9.61846284 L9.06107374,8.95491503 L11.1032639,4.81698575 C11.3476862,4.32173209 11.9473121,4.11839309 12.4425657,4.36281539 C12.6397783,4.46014562 12.7994058,4.61977315 12.8967361,4.81698575 L14.9389263,8.95491503 L19.5054023,9.61846284 C20.0519472,9.69788046 20.4306287,10.2053233 20.351211,10.7518682 C20.3195865,10.9695052 20.2170993,11.1706476 20.0596157,11.3241562 L16.7552826,14.545085 L17.5353298,19.0931094 C17.6286908,19.6374458 17.263103,20.1544017 16.7187666,20.2477627 C16.5020089,20.2849396 16.2790408,20.2496249 16.0843804,20.1472858 L12,18 Z" fill="#A1A5B7" opacity=".6"></path></g></svg>`; document.getElementById('star__count').textContent = data.count + '.0'; }
            document.getElementById('rvc__ind').textContent = data.revs+" értékelés alapján";
        }
    });
}
</script>
<?php require_once('includes/footer.php'); ?>