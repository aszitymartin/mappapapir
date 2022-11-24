<script src="/assets/script/quill/dist/quill.js"></script>
<div class="flex flex-row-d-col-m gap-1">
    <div class="flex flex-col w-fa gap-1 border-soft item-bg box-shadow padding-1">
        <div class="flex flex-col gap-025">
            <div class="flex flex-row flex-align-c flex-justify-con-sb gap-05">
                <span class="text-primary bold">Általános</span>
                <div class="flex flex-row flex-align-c gap-1">
                    <div error-data="general"></div>
                    <div onclick="__saveitem(urlpid, 'general')" class="flex flex-row flex-justify-con-fe w-fa">
                        <div class="flex flex-row flex-align-c flex-justify-con-sb gap-1 primary-bg primary-bg-hover pointer user-select-none padding-05 border-soft-light">
                            <span class="smaller-light">Mentés</span>
                        </div>
                    </div>
                </div>
            </div>
            <hr style="border: 1px solid var(--background);" class="w-100">
        </div>
        <div class="flex flex-col gap-2">
            <div class="flex flex-col gap-05">
                <span class="text-secondary small">Adja meg a termék nevét</span>
                <input type="text" class="adm__input item-bg border-soft w-fa text-secondary outline-none small" id="product-name" name="product-name" placeholder="Termék Neve" required />
                <span class="text-muted small-med">A termék nevét kötelező megadni, illetve ajánlott egyedi neveket használni a termékekhez</span>
            </div>
            <div class="flex flex-col gap-05">
                <span class="text-secondary small">Adja meg a termék leírását</span>
                <div class="flex flex-col">
                    <div id="prod-desc-editor" style="height: 12rem;"></div>
                </div>
                <script>
                    var quill = new Quill('#prod-desc-editor', {
                        modules: {
                            toolbar: [ [{ header: [1, 2, false] }], ['bold', 'italic', 'underline', 'strike'], ['image', 'link'], [{list: 'ordered'}, {list: 'bullet'}] ]
                        }, placeholder: 'Ide írja a termék leírását...', theme: 'snow'
                    });
                </script>
                <span class="text-muted small-med">Adja meg a termék leírását a termék könnyebb elérhetősége érdekében</span>
            </div>
        </div>
    </div>
</div>
<div class="flex flex-row-d-col-m gap-1">
    <div class="flex flex-col w-fa gap-1 border-soft item-bg box-shadow padding-1">
        <div class="flex flex-col gap-025">
            <div class="flex flex-row flex-align-c flex-justify-con-sb gap-05">
                <span class="text-primary bold">Árazás</span>
                <div class="flex flex-row flex-align-c gap-1">
                    <div error-data="price"></div>
                    <div class="flex flex-row flex-justify-con-fe w-fa">
                        <div onclick="__saveitem(urlpid, 'price')" class="flex flex-row flex-align-c flex-justify-con-sb gap-1 primary-bg primary-bg-hover pointer user-select-none padding-05 border-soft-light">
                            <span class="smaller-light">Mentés</span>
                        </div>
                    </div>
                </div>
            </div>
            <hr style="border: 1px solid var(--background);" class="w-100">
        </div>
        <div class="flex flex-col gap-2">
            <div class="flex flex-col gap-05">
                <span class="text-secondary small">Adja meg a termék alapárát</span>
                <input type="number" class="adm__input item-bg border-soft w-fa text-secondary outline-none small" id="product-price" name="product-price" placeholder="Termék alapára" required />
                <span class="text-muted small-med">Állítsa be a termékhez tartozó alapárat</span>
            </div>
            <div class="flex flex-col gap-05">
                <span class="text-secondary small">Leárazás típusa</span>
                <div class="flex flex-col gap-2">
                    <div class="flex flex-row-d-col-m gap-1 user-select-none">
                        <label class="flex flex-row flex-align-c prim-bg-hover border-secondary-dotted border-sec-hov-prim-dotted border-soft padding-105 gap-1 pointer w-50d-fam" for="pd-no">
                            <input type="radio" class="discount_input ndi__trigg discount-radio box-shadow" name="product-discount" value="no" id="pd-no" />
                            <span class="text-primary bold">Nincs leárazás</span>
                        </label>
                        <label class="flex flex-row flex-align-c prim-bg-hover border-secondary-dotted border-sec-hov-prim-dotted border-soft padding-105 gap-1 pointer w-50d-fam" for="pd-perc">
                            <input type="radio" class="discount_input ndi__trigg discount-radio box-shadow" name="product-discount" value="perc" id="pd-perc" />
                            <span class="text-primary bold">Százalékos %</span>
                        </label>
                    </div>
                    <div id="dsc-per-con" class="hidden flex-col gap-1">
                        <div class="flex flex-col gap-1">
                            <div class="flex flex-col flex-align-c flex-justify-con-c gap-1">
                                <span class="flex flex-row flex-justify-con-c gap-025 w-fa text-primary">
                                    <span id="disc-ind" class="bold" style="font-size: 2.4rem;">0</span>
                                    <sup class="large bold">%</sup>
                                </span>
                                <div class="flex flex-col flex-align-c gap-1 w-fa">
                                    <div class="flex flex-row relative w-fa">
                                        <input type="range" min="1" max="100" value="0" class="ds--slider w-fa border-soft background-bg" id="discount-range">
                                    </div>
                                    <span class="text-muted small-med w-fa">Válassza ki a megfelelő százalékot a leértékelés beállításához</span>
                                </div>
                            </div>
                        </div>
                        <div class="flex flex-row flex-align-c gap-1 w-fa">
                            <div class="flex flex-col w-50 gap-05">
                                <span class="text-secondary small">Akció kezdete</span>
                                <input type="datetime-local" name="discount-start" class="adm__input item-bg border-soft w-fa text-secondary outline-none small" id="discount-start">
                            </div>
                            <div class="flex flex-col w-50 gap-05">
                                <span class="text-secondary small">Akció vége</span>
                                <div class="cst-select-pe w-fa relative" id="disc-end-con">
                                    <select class="hidden relative" id="discount-end">
                                        <option value="0">Válasszon időpontot:</option>
                                        <option value="1">1 nap</option>
                                        <option value="7">1 hét</option>
                                        <option value="30">1 hónap</option>
                                        <option value="60">2 hónap</option>
                                        <option value="90">3 hónap</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <script>
                    var trigger = document.getElementsByName('product-discount');
                    for (let i = 0; i < trigger.length; i++) {
                        trigger[i].addEventListener("click", () => {
                            if(trigger[i].checked) { trigger[i].parentNode.classList.replace('prim-bg-hover', 'primary-bg'); trigger[i].parentNode.classList.replace('border-secondary-dotted', 'border-primary-light-dotted');
                                for (let j = 0; j < trigger.length; j++) {
                                    if (i != j) { trigger[j].parentNode.classList.replace('primary-bg', 'prim-bg-hover'); trigger[j].parentNode.classList.replace('border-primary-light-dotted', 'border-secondary-dotted'); }
                                }
                            }
                        });
                    }
                </script>
            </div>
        </div>
    </div>
</div>
<div class="flex flex-row-d-col-m gap-1">
    <div class="flex flex-col w-fa gap-1 border-soft item-bg box-shadow padding-1">
        <div class="flex flex-col gap-025">
            <div class="flex flex-row flex-align-c flex-justify-con-sb gap-05">
                <span class="text-primary bold">Média</span>
                <div class="flex flex-row flex-align-c gap-1">
                    <div error-data="media">
                    </div>
                    <div onclick="__saveitem(urlpid, 'media')" class="flex flex-row flex-align-c flex-justify-con-sb gap-1 primary-bg primary-bg-hover pointer user-select-none padding-05 border-soft-light">
                        <span class="smaller-light">Mentés</span>
                    </div>
                </div>
            </div>
            <hr style="border: 1px solid var(--background);" class="w-100">
        </div>
        <span class="text-muted small-med"><strong>Figyelem!</strong> A miniatűröket átmenetileg nem lehet egyesével szerkeszteni. Ha változtatni szeretne a miniatűrökön, újra fel kell venni az összes képet, amikkel ki szeretné cserélni az előzőket.</span>
        <div class="flex flex-row flex-wrap gap-1 w-fa">
            <div class="flex flex-row flex-wrap gap-1" id="miniatures-cur-con"></div>
            <div id="min-upl-con">
                <div id="miniature-uploader" class="flex flex-row-d-col-m flex-align-c flex-justify-con-c border-soft border-secondary-dotted background-bg background-bg-hover text-primary padding-1 user-select-none w-fc pointer miniature-fixed" onclick="__inituploader()">
                    <div class="flex flex-row-d-col-m flex-align-c gap-1">
                        <div class="flex flex-row flex-align-c gap-1">
                            <div class="flex flex-col flex-align-c flex-justify-con-c">
                                <svg width="48" height="48" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M3 13V11C3 10.4 3.4 10 4 10H20C20.6 10 21 10.4 21 11V13C21 13.6 20.6 14 20 14H4C3.4 14 3 13.6 3 13Z" fill="currentColor"/><path d="M13 21H11C10.4 21 10 20.6 10 20V4C10 3.4 10.4 3 11 3H13C13.6 3 14 3.4 14 4V20C14 20.6 13.6 21 13 21Z" fill="currentColor"/></svg>
                                <span class="text-muted small-med w-fa text-align-c">Hozzáadás</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="flex flex-row gap-1 w-fa">
            <div class="flex flex-row flex-wrap gap-1" id="miniatures-con"></div>
        </div>
    </div>
</div>
<script>
var urldata = new FormData(); urldata.append("pid", urlpid);
$.ajax({ enctype: "multipart/form-data", type: "POST", url: "/admin/products/info.php", data: urldata, dataType: 'json', contentType: false, processData: false,
    success: function(data) { document.getElementById('product-name').value = data.name;document.getElementById('prod-desc-editor').getElementsByClassName('ql-editor')[0].innerHTML = data.description;document.getElementById('product-price').value = data.price;
        if (data.discounted != '0' && data.discount != 0 && !!data.discounted) {
            document.getElementById('pd-perc').click();  document.getElementById('discount-range').value = data.discount; document.getElementById('discount-start').value = data.start; document.getElementById('disc-ind').textContent = data.discount; 
            var end = new Date(data.end.split(' ')[0]); var start = new Date(data.start.split(' ')[0]);
            var diff = Math.ceil(end - start) / (1000 * 60 * 60 * 24); var so = document.getElementById('disc-end-con').getElementsByClassName('cst-sl-it')[0].querySelectorAll('div[data-diff]');
            for (let i = 0; i < so.length; i++) { if (so[i].getAttribute('data-diff') == diff) { so[i].click(); document.getElementById('disc-end-con').getElementsByClassName('cst-sl-sltd-pe')[0].click(); } }
            
        } else { document.getElementById('pd-no').click(); }
        if (data.media.length > 0) { var mins = data.media.split(","); for (let i = 0; i < mins.length; i++) { document.getElementById('miniatures-cur-con').innerHTML += `<div class="flex flex-row-d-col-m flex-align-c flex-justify-con-c border-soft background-bg background-bg-hover text-primary padding-1 user-select-none w-fc pointer miniature-fixed relative" style="background-image: url('/assets/images/uploads/${mins[i]}'); background-size: contain; background-repeat: no-repeat; background-position: center;"></div>`; } }
    }
});
$('#pd-perc').on('click', () => { document.getElementById('dsc-per-con').classList.replace('hidden', 'flex');
    var today = new Date().toISOString().split('T')[0]; document.getElementById('discount-start').setAttribute('min', today + ' 00:00:00');
    $('#discount-range').on('input change', () => { document.getElementById('disc-ind').textContent = document.getElementById('discount-range').value; });
}); $('#pd-no').on('click', () => { document.getElementById('dsc-per-con').classList.replace('flex', 'hidden'); });
</script>
<script>
    var x, i, j, l, ll, selElmnt, a, b, c; x = document.getElementsByClassName("cst-select-pe"); l = x.length;
    for (i = 0; i < l; i++) {
    selElmnt = x[i].getElementsByTagName("select")[0]; ll = selElmnt.length; a = document.createElement("DIV"); a.setAttribute("class", "cst-sl-sltd-pe adm__input item-bg border-soft text-secondary outline-none small pointer");
    a.innerHTML = selElmnt.options[selElmnt.selectedIndex].innerHTML; x[i].appendChild(a); b = document.createElement("DIV");
    b.setAttribute("class", "absolute w-fa cst-sl-it box-shadow item-bg border-soft text-secondary small select-hide user-select-none");
    for (j = 1; j < ll; j++) {
        c = document.createElement("DIV"); c.innerHTML = selElmnt.options[j].innerHTML; c.setAttribute('data-diff', selElmnt.options[j].value);
        c.addEventListener("click", function(e) { var y, i, k, s, h, sl, yl;
            s = this.parentNode.parentNode.getElementsByTagName("select")[0];
            sl = s.length; h = this.parentNode.previousSibling;
            for (i = 0; i < sl; i++) {
            if (s.options[i].innerHTML == this.innerHTML) {
                s.selectedIndex = i; h.innerHTML = this.innerHTML;
                y = this.parentNode.getElementsByClassName("same-as-selected"); yl = y.length;
                for (k = 0; k < yl; k++) { y[k].removeAttribute("class"); }
                this.setAttribute("class", "same-as-selected");
                break;
            }
            }h.click();
        }); b.appendChild(c);
    } x[i].appendChild(b); a.addEventListener("click", function(e) { e.stopPropagation(); closeAllSelect(this); this.nextSibling.classList.toggle("select-hide"); this.classList.toggle("select-arrow-active"); });
    }
    function closeAllSelect(elmnt) { var x, y, i, xl, yl, arrNo = []; x = document.getElementsByClassName("select-items"); y = document.getElementsByClassName("cst-sl-sltd-pe"); xl = x.length; yl = y.length;
    for (i = 0; i < yl; i++) { if (elmnt == y[i]) { arrNo.push(i) } else { y[i].classList.remove("select-arrow-active"); } }
    for (i = 0; i < xl; i++) { if (arrNo.indexOf(i)) { x[i].classList.add("select-hide"); } }
    } document.addEventListener("click", closeAllSelect);
</script>
<script>
    let minActive = 0; let miniArr = [];
    function __inituploader () { var minIndex = document.getElementsByClassName('miniature-upload').length;  minActive++; minIndex++; 
        if (minIndex <= 5) {
            document.getElementById('miniatures-con').innerHTML += `
            <div id="miniature-upload-${minActive}" class="miniature-upload flex flex-row-d-col-m flex-align-c flex-justify-con-c border-soft background-bg background-bg-hover text-primary padding-1 user-select-none w-fc pointer miniature-fixed relative">
                <input type="file" id="miniature-input-${minActive}" class="hidden miniature-input">
                <div class="miniature-upload-inner flex flex-row-d-col-m flex-align-c gap-1" onclick="__minupload(${minActive})">
                    <div class="flex flex-row flex-align-c gap-1">
                        <div class="flex flex-col flex-align-c flex-justify-con-c">
                            <span id="min-icon-${minActive}"><svg width="48" height="48" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path opacity="0.3" d="M19 22H5C4.4 22 4 21.6 4 21V3C4 2.4 4.4 2 5 2H14L20 8V21C20 21.6 19.6 22 19 22ZM14.5 12L12.7 9.3C12.3 8.9 11.7 8.9 11.3 9.3L10 12H11.5V17C11.5 17.6 11.4 18 12 18C12.6 18 12.5 17.6 12.5 17V12H14.5Z" fill="currentColor"/><path d="M13 11.5V17.9355C13 18.2742 12.6 19 12 19C11.4 19 11 18.2742 11 17.9355V11.5H13Z" fill="currentColor"/><path d="M8.2575 11.4411C7.82942 11.8015 8.08434 12.5 8.64398 12.5H15.356C15.9157 12.5 16.1706 11.8015 15.7425 11.4411L12.4375 8.65789C12.1875 8.44737 11.8125 8.44737 11.5625 8.65789L8.2575 11.4411Z" fill="currentColor"/><path d="M15 8H20L14 2V7C14 7.6 14.4 8 15 8Z" fill="currentColor"/></svg></span>
                            <span class="text-muted small-med w-fa text-align-c">Kép választása</span>
                        </div>
                    </div>
                </div>
                <div id="miniature-prop-con-${minActive}" class=" absolute"></div>
                <div style="top: -10%; right: -10%;" class="mini-action flex flex-align-c flex-justify-con-c padding-025 absolute item-bg circle text-muted link-color box-shadow-dark pointer" aria-label="Eltávolítás" title="Eltávolítás" role="button" data-active="${minActive}">
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M6.7 19.4L5.3 18C4.9 17.6 4.9 17 5.3 16.6L16.6 5.3C17 4.9 17.6 4.9 18 5.3L19.4 6.7C19.8 7.1 19.8 7.7 19.4 8.1L8.1 19.4C7.8 19.8 7.1 19.8 6.7 19.4Z" fill="currentColor"></path><path d="M19.5 18L18.1 19.4C17.7 19.8 17.1 19.8 16.7 19.4L5.40001 8.1C5.00001 7.7 5.00001 7.1 5.40001 6.7L6.80001 5.3C7.20001 4.9 7.80001 4.9 8.20001 5.3L19.5 16.6C19.9 16.9 19.9 17.6 19.5 18Z" fill="currentColor"></path></svg>
                </div>
            </div>
            `; var remBtn = document.getElementsByClassName('mini-action');
            for (let i = 0; i < remBtn.length; i++) { remBtn[i].setAttribute('onclick', '__removeminiature('+minIndex+', '+remBtn[i].getAttribute('data-active')+')'); }
        } if (minIndex == 5 || minIndex > 5) { document.getElementById('miniature-uploader').remove(); document.getElementById('miniatures-con').innerHTML += ``; }
    } function __minupload (e) {
        document.getElementById('miniature-input-'+e).addEventListener('click', () => {
            document.getElementById('min-icon-'+e).innerHTML = `<svg width="48" height="48" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path opacity="0.3" d="M19 22H5C4.4 22 4 21.6 4 21V3C4 2.4 4.4 2 5 2H14L20 8V21C20 21.6 19.6 22 19 22Z" fill="currentColor"/><g clip-path="url(#clip0_787_1289)"><path d="M9.56133 15.7161C9.72781 15.5251 9.5922 15.227 9.33885 15.227H8.58033C8.57539 15.1519 8.57262 15.0763 8.57262 15C8.57262 13.1101 10.1101 11.5726 12 11.5726C12.7576 11.5726 13.4585 11.8198 14.0265 12.2377C14.2106 12.3731 14.4732 12.3609 14.6216 12.1872L15.1671 11.5491C15.3072 11.3852 15.2931 11.1382 15.1235 11.005C14.2353 10.3077 13.1468 9.92944 12 9.92944C10.6456 9.92944 9.37229 10.4569 8.41458 11.4146C7.4569 12.3723 6.92945 13.6456 6.92945 15C6.92945 15.0759 6.93135 15.1516 6.93465 15.2269H6.29574C6.0424 15.2269 5.90677 15.5251 6.07326 15.7161L7.51455 17.3693L7.81729 17.7166L8.90421 16.4698L9.56133 15.7161Z" fill="currentColor"/><path d="M17.9268 14.7516L16.8518 13.5185L16.1828 12.7511L15.2276 13.8468L14.4388 14.7516C14.2723 14.9426 14.4079 15.2407 14.6612 15.2407H15.4189C15.2949 17.0187 13.809 18.4274 12.0001 18.4274C11.347 18.4274 10.736 18.2437 10.216 17.9253C10.0338 17.8138 9.79309 17.8362 9.6543 17.9985L9.10058 18.6463C8.95391 18.8179 8.97742 19.0782 9.16428 19.2048C9.99513 19.7678 10.9743 20.0706 12.0001 20.0706C13.3545 20.0706 14.6278 19.5432 15.5855 18.5855C16.4863 17.6847 17.0063 16.5047 17.0649 15.2407H17.7043C17.9577 15.2407 18.0933 14.9426 17.9268 14.7516Z" fill="currentColor"/></g><path d="M15 8H20L14 2V7C14 7.6 14.4 8 15 8Z" fill="currentColor"/><defs><clipPath id="clip0_787_1289"><rect width="12" height="12" fill="white" transform="translate(6 9)"/></clipPath></defs></svg>`;
            document.getElementById('miniature-input-'+e).addEventListener('change', () => { var minInput = document.getElementById('miniature-input-'+e);
                if (minInput.value.length > 0) { let validExtensions = ["image/jpeg", "image/jpg", "image/png"];
                    if (validExtensions.includes(minInput.files[0].type)) { var allMinInp = document.getElementsByClassName('miniature-input'); var duplicate = false;
                        if (miniArr.length > 0) { for (let i = 0; i < miniArr.length; i++) { if (miniArr[i].name == minInput.files[0].name && miniArr[i].type == minInput.files[0].type && miniArr[i].size == minInput.files[0].size) { duplicate = true; } }
                            if (duplicate == true) { document.getElementById('min-icon-'+e).innerHTML = `<svg width="48" height="48" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path opacity="0.3" d="M5 22H19C19.6 22 20 21.6 20 21V8L14 2H5C4.4 2 4 2.4 4 3V21C4 21.6 4.4 22 5 22Z" fill="currentColor"/><path d="M15 8H20L14 2V7C14 7.6 14.4 8 15 8Z" fill="currentColor"/><rect x="7.55518" y="16.7585" width="10.144" height="2" rx="1" transform="rotate(-45 7.55518 16.7585)" fill="currentColor"/><rect x="9.0174" y="9.60327" width="10.0952" height="2" rx="1" transform="rotate(45 9.0174 9.60327)" fill="currentColor"/></svg>`; document.getElementById('miniature-upload-'+e).getElementsByClassName('text-muted')[0].textContent = "Duplikáció"; }
                            else { miniArr.push(minInput.files[0]); __loadpreview(e); }
                        } else { miniArr.push(minInput.files[0]); __loadpreview(e); }
                    } else { document.getElementById('min-icon-'+e).innerHTML = `<svg width="48" height="48" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path opacity="0.3" d="M5 22H19C19.6 22 20 21.6 20 21V8L14 2H5C4.4 2 4 2.4 4 3V21C4 21.6 4.4 22 5 22Z" fill="currentColor"/><path d="M15 8H20L14 2V7C14 7.6 14.4 8 15 8Z" fill="currentColor"/><rect x="7.55518" y="16.7585" width="10.144" height="2" rx="1" transform="rotate(-45 7.55518 16.7585)" fill="currentColor"/><rect x="9.0174" y="9.60327" width="10.0952" height="2" rx="1" transform="rotate(45 9.0174 9.60327)" fill="currentColor"/></svg>`; document.getElementById('miniature-upload-'+e).getElementsByClassName('text-muted')[0].textContent = "Hibás feltöltés"; }
                }
            });
        }); document.getElementById('miniature-input-'+e).click();
    } function __loadpreview (e) { let fileReader = new FileReader(); var minInput = document.getElementById('miniature-input-'+e);
        fileReader.onload = () => { let fileURL = fileReader.result; document.getElementById('miniature-upload-'+e).getElementsByClassName('miniature-upload-inner')[0].innerHTML = ``;
            document.getElementById('miniature-upload-'+e).style.background = 'url('+fileURL+')';
             document.getElementById('miniature-upload-'+e).addEventListener('mouseleave', () => { document.getElementById('miniature-prop-con-'+e).classList = 'absolute'; document.getElementById('miniature-prop-con-'+e).innerHTML =``; });
        }; fileReader.readAsDataURL(minInput.files[0]);
    } function __removeminiature (index, e) { miniArr.splice(e-1, 1); index--; var remBtn = document.getElementsByClassName('mini-action');
        for (let i = 0; i < remBtn.length; i++) {
            remBtn[i].setAttribute('onclick', '__removeminiature('+index+', '+remBtn[i].getAttribute('data-active')+')');
        }
        document.getElementById('miniature-upload-'+e).remove();
        if (index < 5) { // Hozzaadas gomb megjelenitese
            document.getElementById('min-upl-con').innerHTML = `
            <div id="miniature-uploader" class="flex flex-row-d-col-m flex-align-c flex-justify-con-c border-soft border-secondary-dotted background-bg background-bg-hover text-primary padding-1 user-select-none w-fc pointer miniature-fixed" onclick="__inituploader()">
                <div class="flex flex-row-d-col-m flex-align-c gap-1">
                    <div class="flex flex-row flex-align-c gap-1">
                        <div class="flex flex-col flex-align-c flex-justify-con-c">
                            <svg width="48" height="48" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M3 13V11C3 10.4 3.4 10 4 10H20C20.6 10 21 10.4 21 11V13C21 13.6 20.6 14 20 14H4C3.4 14 3 13.6 3 13Z" fill="currentColor"/><path d="M13 21H11C10.4 21 10 20.6 10 20V4C10 3.4 10.4 3 11 3H13C13.6 3 14 3.4 14 4V20C14 20.6 13.6 21 13 21Z" fill="currentColor"/></svg>
                            <span class="text-muted small-med w-fa text-align-c">Hozzáadás</span>
                        </div>
                    </div>
                </div>
            </div>
            `;
        }
    }
</script>