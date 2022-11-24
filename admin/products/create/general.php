<?php require_once($_SERVER['DOCUMENT_ROOT'].'/includes/inc.php'); ?>
<script src="/assets/script/quill/dist/quill.js"></script><script src="/assets/script/tagify/dist/tagify.js"></script>
<div class="flex flex-row-d-col-m gap-1">
    <div class="flex flex-col w-fa gap-1 border-soft item-bg box-shadow padding-1">
        <div class="flex flex-col gap-025">
            <div class="flex flex-row flex-align-c flex-justify-con-sb gap-05">
                <span class="text-primary bold">Általános</span>
                <div error-data="general"></div>
            </div>
        </div>
        <div id="gn-er-ls-cn"></div>
        <div class="flex flex-col gap-2">
            <div class="flex flex-col gap-05">
                <span class="text-secondary small">Adja meg a termék nevét</span>
                <input type="text" class="adm__input item-bg border-soft w-fa text-secondary outline-none small prd-ch-fr-er" id="product-name" name="product-name" placeholder="Termék Neve" required />
                <span class="text-muted small-med">A termék nevét kötelező megadni, illetve ajánlott egyedi neveket használni a termékekhez</span>
            </div>
            <form>
                <input type="file" id="product-thumbnail" class="hidden prd-ch-fr-er" accept=".png, .jpg, .jpeg">
                <div id="thumbnail-con" class="flex"></div>
                <div id="thumbnail-form-con">
                    <div id="thumbnail-form" class="drag-area flex flex-row-d-col-m flex-align-c flex-justify-con-sb border-soft border-primary-light-dotted primary-bg padding-1 user-select-none pointer">
                        <div class="flex flex-row-d-col-m flex-align-c gap-1">
                            <div class="flex flex-row flex-align-c gap-1">
                                <div class="drag-icon flex">
                                    <svg class="drop-shadow" width="36" height="36" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path opacity="0.3" d="M19 22H5C4.4 22 4 21.6 4 21V3C4 2.4 4.4 2 5 2H14L20 8V21C20 21.6 19.6 22 19 22ZM14.5 12L12.7 9.3C12.3 8.9 11.7 8.9 11.3 9.3L10 12H11.5V17C11.5 17.6 11.4 18 12 18C12.6 18 12.5 17.6 12.5 17V12H14.5Z" fill="currentColor"/><path d="M13 11.5V17.9355C13 18.2742 12.6 19 12 19C11.4 19 11 18.2742 11 17.9355V11.5H13Z" fill="currentColor"/><path d="M8.2575 11.4411C7.82942 11.8015 8.08434 12.5 8.64398 12.5H15.356C15.9157 12.5 16.1706 11.8015 15.7425 11.4411L12.4375 8.65789C12.1875 8.44737 11.8125 8.44737 11.5625 8.65789L8.2575 11.4411Z" fill="currentColor"/><path d="M15 8H20L14 2V7C14 7.6 14.4 8 15 8Z" fill="currentColor"/></svg>
                                </div>
                                <div class="drag-text flex flex-col flex-align-c flex-justify-con-fs">
                                    <span class="bold w-100 small">Húzza ide ide a feltölteni kívánt képet, vagy kattintson.</span>
                                    <span class="text-muted small-med w-fa">Állítsa be a termék miniatűrjét. Csak *.png, *.jpg és *.jpeg képfájlokat fogadunk el.</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
            <div class="flex flex-col gap-05">
                <span class="text-secondary small">Adja meg a termék leírását</span>
                <div class="flex flex-col">
                    <div id="prod-desc-editor" class="prd-ch-fr-er-ce" style="height: 12rem;"></div>
                </div>
                <script>
                    var descEditor = new Quill('#prod-desc-editor', {
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
                <span class="text-primary bold">Státusz</span>
                <div error-data="status"></div>
            </div>
        </div>
        <div id="st-er-ls-cn"></div>
        <div class="flex flex-col w-fa gap-1">
            <div class="flex flex-col w-fa gap-1">
                <div class="flex flex-col w-fa gap-05">
                    <div class="csts-select csts-select-fnc w-fa relative" id="prd-st-con">
                        <select class="hidden relative" id="product-status">
                            <option value="0">Státusz</option>
                            <option value="1">Aktív</option>
                            <option value="2">Vázlat</option>
                            <option value="3">Ütemezett</option>
                            <option value="4">Inaktív</option>
                        </select>
                    </div>
                    <span class="text-muted small-med">Állítsa be a termék státuszát</span>
                </div>
                <div id="prd-st-sch-con"></div>
            </div>
        </div>
    </div>
</div>
<div class="flex flex-row-d-col-m gap-1">
    <div class="flex flex-col w-fa gap-1 border-soft item-bg box-shadow padding-1">
        <div class="flex flex-col gap-025">
            <div class="flex flex-row flex-align-c flex-justify-con-sb gap-05">
                <span class="text-primary bold">Kategória</span>
                <div error-data="category"></div>
            </div>
        </div>
        <div id="ct-er-ls-cn"></div>
        <div class="flex flex-col w-fa gap-025">
            <input name='product-category' id='product-category' class='adm__input w-fa border-soft cst-drp-fts small prd-ch-fr-er' placeholder='Kategória'>
            <script>
                var categ__inp = document.querySelector('input[name="product-category"]'),
                tagify = new Tagify(categ__inp, {
                    whitelist: [<?php $clr__sql = "SELECT DISTINCT category FROM `products__category` WHERE 1"; $clr__res = $con-> query($clr__sql); while ($clr = $clr__res-> fetch_assoc()) { echo "'".ucfirst($clr['category'])."',"; } ?>],
                    maxTags: 1, dropdown: { maxItems: 10, classname: "tags-look", enabled: 0, closeOnSelect: false },
                    originalInputValueFormat: valuesArr => valuesArr.map(item => item.value).join(',')
                })
            </script>
            <span class="text-muted small-med">Állítsa be a termék kategóriáját</span>
        </div>
        <div class="flex flex-col gap-05">
            <div class="flex flex-row flex-align-c flex-justify-con-sb gap-05">
                <span class="text-primary small">Címkék</span>
            </div>
            <div class="flex flex-row w-fa">
                <input name="product-tags" id="product-tags" class="w-fa border-soft small prd-ch-fr-er" placeholder="Címkék hozzáadása" tabindex="-1">
            </div>
            <script>
                var tags__input = document.querySelector('input[name="product-tags"]'),
                tagify = new Tagify(tags__input, {
                whitelist: ['Limitált', 'Új termék', 'Kelendő', 'Népszerű', 'Színes','Iratrendező','Akciós','Raktáron','2 500 Ft alatti'],
                maxTags: 10, dropdown: { maxItems: 10, classname: "tags-look", enabled: 0, closeOnSelect: false },
                originalInputValueFormat: valuesArr => valuesArr.map(item => item.value).join(',')
                })
            </script>
        </div>
    </div>
</div>
<div class="flex flex-row-d-col-m gap-1">
    <div class="flex flex-col w-fa gap-1 border-soft item-bg box-shadow padding-1">
        <div class="flex flex-col gap-025">
            <div class="flex flex-row flex-align-c flex-justify-con-sb gap-05">
                <span class="text-primary bold">Árazás</span>
                <div error-data="pricing"></div>
            </div>
        </div>
        <div id="pc-er-ls-cn"></div>
        <div class="flex flex-col gap-2">
            <div class="flex flex-col gap-05">
                <span class="text-secondary small">Adja meg a termék alapárát</span>
                <input type="number" class="adm__input item-bg border-soft w-fa text-secondary outline-none small prd-ch-fr-er" id="product-price" name="product-price" placeholder="Termék alapára" required />
                <span class="text-muted small-med">Állítsa be a termékhez tartozó alapárat</span>
            </div>
            <div class="flex flex-col gap-05">
                <span class="text-secondary small">Leárazás típusa</span>
                <div class="flex flex-col gap-2">
                    <div class="flex flex-row-d-col-m gap-1 user-select-none">
                        <label class="flex flex-row flex-align-c prim-bg-hover border-secondary-dotted border-sec-hov-prim-dotted border-soft padding-105 gap-1 pointer w-50d-fam" for="pd-no">
                            <input type="radio" class="discount_input ndi__trigg discount-radio box-shadow" name="product-discount" value="0" id="pd-no" />
                            <span class="text-primary bold">Nincs leárazás</span>
                        </label>
                        <label class="flex flex-row flex-align-c prim-bg-hover border-secondary-dotted border-sec-hov-prim-dotted border-soft padding-105 gap-1 pointer w-50d-fam" for="pd-perc">
                            <input type="radio" class="discount_input ndi__trigg discount-radio box-shadow" name="product-discount" value="1" id="pd-perc" />
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
                                        <input type="range" min="0" max="100" value="0" class="ds--slider w-fa border-soft background-bg" id="discount-range">
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
                                <div class="csts-select w-fa relative">
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
            </div>
            
        </div>
        <div class="flex flex-row gap-1 w-fa">
            <div class="flex flex-row gap-1" id="miniatures-con"></div>
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
    </div>
</div>
<script src="/admin/assets/script/cst-drd.js"></script>
<script>
    $('#pd-perc').on('click', () => { document.getElementById('dsc-per-con').classList.replace('hidden', 'flex');
        var today = new Date().toISOString().split('T')[0]; document.getElementById('discount-start').setAttribute('min', today + ' 00:00:00');
        $('#discount-range').on('input change', () => { document.getElementById('disc-ind').textContent = document.getElementById('discount-range').value; });
    }); $('#pd-no').on('click', () => { document.getElementById('dsc-per-con').classList.replace('flex', 'hidden'); }); $('#pd-no').click();
</script>
<script> 
    function __setstatus (index) {
        switch (index) {
            case 2: document.getElementById('pd-st-ind-final').innerHTML = `
                <div class="flex flex-row-d-col-m flex-align-c flex-justify-con-sb border-soft border-primary-light-dotted primary-bg padding-1">
                    <div class="flex flex-row-d-col-m flex-align-c gap-1">
                        <div class="flex flex-row flex-align-c gap-1 w-fa">
                            <div class="flex">
                                <svg class="drop-shadow" width="36" height="36" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path opacity="0.3" d="M21.4 8.35303L19.241 10.511L13.485 4.755L15.643 2.59595C16.0248 2.21423 16.5426 1.99988 17.0825 1.99988C17.6224 1.99988 18.1402 2.21423 18.522 2.59595L21.4 5.474C21.7817 5.85581 21.9962 6.37355 21.9962 6.91345C21.9962 7.45335 21.7817 7.97122 21.4 8.35303ZM3.68699 21.932L9.88699 19.865L4.13099 14.109L2.06399 20.309C1.98815 20.5354 1.97703 20.7787 2.03189 21.0111C2.08674 21.2436 2.2054 21.4561 2.37449 21.6248C2.54359 21.7934 2.75641 21.9115 2.989 21.9658C3.22158 22.0201 3.4647 22.0084 3.69099 21.932H3.68699Z" fill="currentColor"/><path d="M5.574 21.3L3.692 21.928C3.46591 22.0032 3.22334 22.0141 2.99144 21.9594C2.75954 21.9046 2.54744 21.7864 2.3789 21.6179C2.21036 21.4495 2.09202 21.2375 2.03711 21.0056C1.9822 20.7737 1.99289 20.5312 2.06799 20.3051L2.696 18.422L5.574 21.3ZM4.13499 14.105L9.891 19.861L19.245 10.507L13.489 4.75098L4.13499 14.105Z" fill="currentColor"/></svg>
                            </div>
                            <div class="flex flex-col flex-align-c flex-justify-con-fs w-fa">
                                <span class="bold w-100 small">A termék státusza vázlatra lett állítva.</span>
                                <span class="text-primary small-med">A termék meg fog jelenni a webshopban, de nem lesz megvásárolható, vagy megrendelhető. Ezt a státusz-beállítást bármikor módosíthatja a <em>Termékek szerkesztése</em> menüpontban, vagy <span class="link bold pointer user-select-none" onclick="document.getElementById('tabs-general').click();">ide kattintva megváltoztathatja</span> most is.</span>
                            </div>
                        </div>
                    </div>
                </div>`; document.getElementById('prd-st-sch-con').innerHTML = ``;
            break;
            case 3: var today = new Date().toISOString().split('T')[0];
                document.getElementById('prd-st-sch-con').innerHTML = `
                <div class="flex flex-col w-fa gap-05">
                    <span class="text-secondary small">Ütemezés ideje</span>
                    <input type="datetime-local" name="schedule-end" class="adm__input item-bg border-soft w-fa text-secondary outline-none small prd-ch-fr-er" min="${today} 00:00:00" id="schedule-end">
                </div>`;
                document.getElementById('pd-st-ind-final').innerHTML = `
                <div class="flex flex-row-d-col-m flex-align-c flex-justify-con-sb border-soft border-warning-dotted warning-bg padding-1">
                    <div class="flex flex-row-d-col-m flex-align-c gap-1">
                        <div class="flex flex-row flex-align-c gap-1 w-fa">
                            <div class="flex">
                                <svg class="drop-shadow" width="29" height="36" viewBox="0 0 14 21" fill="none" xmlns="http://www.w3.org/2000/svg"><path opacity="0.3" d="M12 6.20001V1.20001H2V6.20001C2 6.50001 2.1 6.70001 2.3 6.90001L5.6 10.2L2.3 13.5C2.1 13.7 2 13.9 2 14.2V19.2H12V14.2C12 13.9 11.9 13.7 11.7 13.5L8.4 10.2L11.7 6.90001C11.9 6.70001 12 6.50001 12 6.20001Z" fill="currentColor"/><path d="M13 2.20001H1C0.4 2.20001 0 1.80001 0 1.20001C0 0.600012 0.4 0.200012 1 0.200012H13C13.6 0.200012 14 0.600012 14 1.20001C14 1.80001 13.6 2.20001 13 2.20001ZM13 18.2H10V16.2L7.7 13.9C7.3 13.5 6.7 13.5 6.3 13.9L4 16.2V18.2H1C0.4 18.2 0 18.6 0 19.2C0 19.8 0.4 20.2 1 20.2H13C13.6 20.2 14 19.8 14 19.2C14 18.6 13.6 18.2 13 18.2ZM4.4 6.20001L6.3 8.10001C6.7 8.50001 7.3 8.50001 7.7 8.10001L9.6 6.20001H4.4Z" fill="currentColor"/></svg>
                            </div>
                            <div class="flex flex-col flex-align-c flex-justify-con-fs w-fa">
                                <span class="bold w-100 small">A termék státusza ütemezettre lett állítva.</span>
                                <span class="text-warning small-med">A termék nem fog megjelenni a webshopban, csak a megadott dátum lejártával lesz elérhető ( <em id="pd-st-sc-ind">NaN</em> ), és megrendelhető. Ezt a státusz-beállítást bármikor módosíthatja a <em>Termékek szerkesztése</em> menüpontban, vagy <span class="link bold pointer user-select-none" onclick="document.getElementById('tabs-general').click();">ide kattintva megváltoztathatja</span> most is.</span>
                            </div>
                        </div>
                    </div>
                </div>`;
                $('#schedule-end').on('change', () => {
                    document.getElementById('pd-st-sc-ind').innerHTML = $('#schedule-end').val();
                });
            break;
            case 4: document.getElementById('pd-st-ind-final').innerHTML = `
                <div class="flex flex-row-d-col-m flex-align-c flex-justify-con-sb border-soft border-danger-dotted danger-bg padding-1">
                    <div class="flex flex-row-d-col-m flex-align-c gap-1">
                        <div class="flex flex-row flex-align-c gap-1 w-fa">
                            <div class="flex">
                                <svg class="drop-shadow" width="36" height="36" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><rect opacity="0.3" x="2" y="2" width="20" height="20" rx="10" fill="currentColor"/><path d="M15.8054 11.639C15.6757 11.5093 15.5184 11.4445 15.3331 11.4445H15.111V10.1111C15.111 9.25927 14.8055 8.52784 14.1944 7.91672C13.5833 7.30557 12.8519 7 12 7C11.148 7 10.4165 7.30557 9.80547 7.9167C9.19432 8.52784 8.88885 9.25924 8.88885 10.1111V11.4445H8.66665C8.48153 11.4445 8.32408 11.5093 8.19444 11.639C8.0648 11.7685 8 11.926 8 12.1112V16.1113C8 16.2964 8.06482 16.4539 8.19444 16.5835C8.32408 16.7131 8.48153 16.7779 8.66665 16.7779H15.3333C15.5185 16.7779 15.6759 16.7131 15.8056 16.5835C15.9351 16.4539 16 16.2964 16 16.1113V12.1112C16.0001 11.926 15.9351 11.7686 15.8054 11.639ZM13.7777 11.4445H10.2222V10.1111C10.2222 9.6204 10.3958 9.20138 10.7431 8.85421C11.0903 8.507 11.5093 8.33343 12 8.33343C12.4909 8.33343 12.9097 8.50697 13.257 8.85421C13.6041 9.20135 13.7777 9.6204 13.7777 10.1111V11.4445Z" fill="currentColor"/></svg>
                            </div>
                            <div class="flex flex-col flex-align-c flex-justify-con-fs w-fa">
                                <span class="bold w-100 small">A termék státusza inaktívra lett állítva.</span>
                                <span class="text-danger small-med">A termék nem fog megjelenni a webshopban, nem lesz elérhető a vásárlók számára. Ezt a státusz-beállítást bármikor módosíthatja a <em>Termékek szerkesztése</em> menüpontban, vagy <span class="link bold pointer user-select-none" onclick="document.getElementById('tabs-general').click();">ide kattintva megváltoztathatja</span> most is.</span>
                            </div>
                        </div>
                    </div>
                </div>`; document.getElementById('prd-st-sch-con').innerHTML = ``;
            break;
            default: document.getElementById('prd-st-sch-con').innerHTML = ``; document.getElementById('pd-st-ind-final').innerHTML = ``;
        }
    }
</script>
<script>
    function dropInit () { const dropArea = document.querySelector(".drag-area"), dragText = dropArea.querySelector(".drag-text"), dragIcon = dropArea.querySelector(".drag-icon"), input = document.getElementById('product-thumbnail'); let file;
        $('#product-thumbnail').on('change', () => { file = input.files[0]; showFile(); });
        dropArea.onclick = () => { input.click(); };
        dropArea.addEventListener("dragover", (event) => {
            dropArea.classList.replace("droparea-error", "droparea-hover"); dropArea.classList.replace("border-danger-dotted", "border-primary-light-dotted");
            event.preventDefault(); dropArea.classList.add("droparea-hover");dragText.innerHTML = "<strong>Endedje fel a kép feltöltéséhez.</strong>";
            dragIcon.innerHTML = `<svg class="drop-shadow" width="36" height="36" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M19.4 13.9411L10.7 5.24112C10.4 4.94112 10 4.84104 9.60001 5.04104C9.20001 5.24104 9 5.54107 9 5.94107V18.2411C9 18.6411 9.20001 18.941 9.60001 19.141C9.70001 19.241 9.9 19.2411 10 19.2411C10.2 19.2411 10.4 19.141 10.6 19.041C11.4 18.441 12.1 17.941 12.9 17.541L14.4 21.041C14.6 21.641 15.2 21.9411 15.8 21.9411C16 21.9411 16.2 21.9411 16.4 21.8411C17.2 21.5411 17.5 20.6411 17.2 19.8411L15.7 16.2411C16.7 15.9411 17.7 15.741 18.8 15.541C19.2 15.541 19.5 15.2411 19.6 14.8411C19.8 14.6411 19.7 14.2411 19.4 13.9411Z" fill="currentColor"/><path opacity="0.3" d="M15 6.941C14.8 6.941 14.7 6.94102 14.6 6.84102C14.1 6.64102 13.9 6.04097 14.2 5.54097L15.2 3.54097C15.4 3.04097 16 2.84095 16.5 3.14095C17 3.34095 17.2 3.941 16.9 4.441L15.9 6.441C15.7 6.741 15.4 6.941 15 6.941ZM18.4 9.84102L20.4 8.84102C20.9 8.64102 21.1 8.04097 20.8 7.54097C20.6 7.04097 20 6.84095 19.5 7.14095L17.5 8.14095C17 8.34095 16.8 8.941 17.1 9.441C17.3 9.841 17.6 10.041 18 10.041C18.2 9.94097 18.3 9.94102 18.4 9.84102ZM7.10001 10.941C7.10001 10.341 6.70001 9.941 6.10001 9.941H4C3.4 9.941 3 10.341 3 10.941C3 11.541 3.4 11.941 4 11.941H6.10001C6.70001 11.941 7.10001 11.541 7.10001 10.941ZM4.89999 17.1409L6.89999 16.1409C7.39999 15.9409 7.59999 15.341 7.29999 14.841C7.09999 14.341 6.5 14.141 6 14.441L4 15.441C3.5 15.641 3.30001 16.241 3.60001 16.741C3.80001 17.141 4.1 17.341 4.5 17.341C4.6 17.241 4.79999 17.2409 4.89999 17.1409Z" fill="currentColor"/></svg>`;
        }); dropArea.addEventListener("dragleave", () => { defaultdrop(); }); dropArea.addEventListener("drop", (event) => { event.preventDefault(); file = event.dataTransfer.files[0]; showFile(); });
        function defaultdrop () { dropArea.classList.replace("droparea-error", "droparea-hover"); dropArea.classList.replace("border-danger-dotted", "border-primary-light-dotted");
            dragText.innerHTML = `<span class="bold w-100 small">Húzza ide ide a feltölteni kívánt képet, vagy kattintson.</span><span class="text-muted small-med w-fa">Állítsa be a termék miniatűrjét. Csak *.png, *.jpg és *.jpeg képfájlokat fogadunk el.</span>`;
            dragIcon.innerHTML = `<svg class="drop-shadow" width="36" height="36" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path opacity="0.3" d="M19 22H5C4.4 22 4 21.6 4 21V3C4 2.4 4.4 2 5 2H14L20 8V21C20 21.6 19.6 22 19 22ZM14.5 12L12.7 9.3C12.3 8.9 11.7 8.9 11.3 9.3L10 12H11.5V17C11.5 17.6 11.4 18 12 18C12.6 18 12.5 17.6 12.5 17V12H14.5Z" fill="currentColor"/><path d="M13 11.5V17.9355C13 18.2742 12.6 19 12 19C11.4 19 11 18.2742 11 17.9355V11.5H13Z" fill="currentColor"/><path d="M8.2575 11.4411C7.82942 11.8015 8.08434 12.5 8.64398 12.5H15.356C15.9157 12.5 16.1706 11.8015 15.7425 11.4411L12.4375 8.65789C12.1875 8.44737 11.8125 8.44737 11.5625 8.65789L8.2575 11.4411Z" fill="currentColor"/><path d="M15 8H20L14 2V7C14 7.6 14.4 8 15 8Z" fill="currentColor"/></svg>`;
        } function errordrop () { dropArea.classList.replace("droparea-hover", "droparea-error"); dropArea.classList.replace("border-primary-light-dotted", "border-danger-dotted");
            dragText.innerHTML = `<strong>Hiba történt a kép feltöltése közben. Kérjük próbálja újra.</strong>`;
            dragIcon.innerHTML = `<svg class="drop-shadow" width="36" height="36" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path opacity="0.3" d="M5 22H19C19.6 22 20 21.6 20 21V8L14 2H5C4.4 2 4 2.4 4 3V21C4 21.6 4.4 22 5 22Z" fill="currentColor"/><path d="M15 8H20L14 2V7C14 7.6 14.4 8 15 8Z" fill="currentColor"/><rect x="7.55518" y="16.7585" width="10.144" height="2" rx="1" transform="rotate(-45 7.55518 16.7585)" fill="currentColor"/><rect x="9.0174" y="9.60327" width="10.0952" height="2" rx="1" transform="rotate(45 9.0174 9.60327)" fill="currentColor"/></svg>`;
        } function showFile () {
            if (file && file.type) { let fileType = file.type; let validExtensions = ["image/jpeg", "image/jpg", "image/png"];
                if(validExtensions.includes(fileType)) { let fileReader = new FileReader();
                    fileReader.onload = () => { let fileURL = fileReader.result;
                        let preview = `
                        <div class="relative">
                            <img src="${fileURL}" alt="${file.name}" class="drop-shadow-dark border-soft" style="width: 120px;">
                            <div style="top: -10%; right: -10%;" id="thumbnail-action" class="flex flex-align-c flex-justify-con-c padding-025 absolute item-bg circle text-muted link-color box-shadow-dark pointer" aria-label="Eltávolítás" title="Eltávolítás" role="button">
                                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M6.7 19.4L5.3 18C4.9 17.6 4.9 17 5.3 16.6L16.6 5.3C17 4.9 17.6 4.9 18 5.3L19.4 6.7C19.8 7.1 19.8 7.7 19.4 8.1L8.1 19.4C7.8 19.8 7.1 19.8 6.7 19.4Z" fill="currentColor"></path><path d="M19.5 18L18.1 19.4C17.7 19.8 17.1 19.8 16.7 19.4L5.40001 8.1C5.00001 7.7 5.00001 7.1 5.40001 6.7L6.80001 5.3C7.20001 4.9 7.80001 4.9 8.20001 5.3L19.5 16.6C19.9 16.9 19.9 17.6 19.5 18Z" fill="currentColor"></path></svg>
                            </div>
                        </div>`; document.getElementById('thumbnail-con').innerHTML = preview;
                        document.getElementById('thumbnail-action').onclick = () => { input.value = ''; file = ``;
                            document.getElementById('thumbnail-form-con').innerHTML = `
                            <div id="thumbnail-form" class="drag-area flex flex-row-d-col-m flex-align-c flex-justify-con-sb border-soft border-primary-light-dotted primary-bg padding-1 user-select-none pointer">
                                <div class="flex flex-row-d-col-m flex-align-c gap-1">
                                    <div class="flex flex-row flex-align-c gap-1">
                                        <div class="drag-icon flex"><svg class="drop-shadow" width="36" height="36" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path opacity="0.3" d="M19 22H5C4.4 22 4 21.6 4 21V3C4 2.4 4.4 2 5 2H14L20 8V21C20 21.6 19.6 22 19 22ZM14.5 12L12.7 9.3C12.3 8.9 11.7 8.9 11.3 9.3L10 12H11.5V17C11.5 17.6 11.4 18 12 18C12.6 18 12.5 17.6 12.5 17V12H14.5Z" fill="currentColor"/><path d="M13 11.5V17.9355C13 18.2742 12.6 19 12 19C11.4 19 11 18.2742 11 17.9355V11.5H13Z" fill="currentColor"/><path d="M8.2575 11.4411C7.82942 11.8015 8.08434 12.5 8.64398 12.5H15.356C15.9157 12.5 16.1706 11.8015 15.7425 11.4411L12.4375 8.65789C12.1875 8.44737 11.8125 8.44737 11.5625 8.65789L8.2575 11.4411Z" fill="currentColor"/><path d="M15 8H20L14 2V7C14 7.6 14.4 8 15 8Z" fill="currentColor"/></svg></div>
                                        <div class="drag-text flex flex-col flex-align-c flex-justify-con-fs">
                                            <span class="bold w-100 small">Húzza ide ide a feltölteni kívánt képet, vagy kattintson.</span>
                                            <span class="text-muted small-med w-fa">Állítsa be a termék miniatűrjét. Csak *.png, *.jpg és *.jpeg képfájlokat fogadunk el.</span>
                                        </div>
                                    </div>
                                </div>
                            </div>`; document.getElementById('thumbnail-con').innerHTML = ``; dropInit();
                        };
                    }; fileReader.readAsDataURL(file); defaultdrop(); document.getElementById('thumbnail-form-con').innerHTML = ``;
                } else { defaultdrop(); }
            } else { errordrop(); }
        }
    } dropInit();
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