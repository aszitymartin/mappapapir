<?php require_once($_SERVER['DOCUMENT_ROOT'].'/includes/inc.php'); ?>
<div class="flex flex-row-d-col-m gap-1">
    <div class="flex flex-col w-fa gap-1 border-soft item-bg box-shadow padding-1">
        <div class="flex flex-col gap-025">
            <div class="flex flex-row flex-align-c flex-justify-con-sb gap-05">
                <span class="text-primary bold">Termék létrehozása</span>
                <span class="flex flex-row primary-bg primary-bg-hover pointer border-soft-light padding-05 w-fc user-select-none" id="add-product" onclick="saveProduct()">Mentés</span>
            </div>
            <hr style="border: 1px solid var(--background);" class="w-100">
        </div>
        <div class="flex flex-col gap-1">
            <div class="flex flex-col gap-1">
                <div id="pd-st-ind-final">
                    <div class="flex flex-row-d-col-m flex-align-c flex-justify-con-sb border-soft border-secondary-dotted text-secondary background-bg padding-1">
                        <div class="flex flex-row-d-col-m flex-align-c gap-1">
                            <div class="flex flex-row flex-align-c gap-1 w-fa">
                                <div class="flex">
                                    <svg class="drop-shadow" width="36" height="36" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><rect opacity="0.3" x="2" y="2" width="20" height="20" rx="10" fill="currentColor"/><rect x="11" y="14" width="7" height="2" rx="1" transform="rotate(-90 11 14)" fill="currentColor"/><rect x="11" y="17" width="2" height="2" rx="1" transform="rotate(-90 11 17)" fill="currentColor"/></svg>
                                </div>
                                <div class="flex flex-col flex-align-c flex-justify-con-fs w-fa">
                                    <span class="bold w-100 small">A termék státusza nem lett beállítva.</span>
                                    <span class="text-warning small-med">A termék státuszának beállítása elengedhetetlen a termék publikálásához. Ezt a státusz-beállítást bármikor módosíthatja a <em>Termékek szerkesztése</em> menüpontban, vagy <span class="link bold pointer user-select-none" onclick="document.getElementById('tabs-general').click();">ide kattintva megváltoztathatja</span> most is.</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div id="en-er-rev" class="hidden"></div>
            <div id="pd-er-gen" class="hidden"></div>
            <div id="up-er-all" class="hidden"></div>
            <div id="up-sc-cn"></div>
            <div class="flex flex-col flex-align-c flex-justify-con-c gap-1 w-fa text-muted user-select-none">
                <svg class="drop-shadow" width="128" height="128" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path opacity="0.3" d="M18 10V20C18 20.6 18.4 21 19 21C19.6 21 20 20.6 20 20V10H18Z" fill="currentColor"/><path opacity="0.3" d="M11 10V17H6V10H4V20C4 20.6 4.4 21 5 21H12C12.6 21 13 20.6 13 20V10H11Z" fill="currentColor"/><path opacity="0.3" d="M10 10C10 11.1 9.1 12 8 12C6.9 12 6 11.1 6 10H10Z" fill="currentColor"/><path opacity="0.3" d="M18 10C18 11.1 17.1 12 16 12C14.9 12 14 11.1 14 10H18Z" fill="currentColor"/><path opacity="0.3" d="M14 4H10V10H14V4Z" fill="currentColor"/><path opacity="0.3" d="M17 4H20L22 10H18L17 4Z" fill="currentColor"/><path opacity="0.3" d="M7 4H4L2 10H6L7 4Z" fill="currentColor"/><path d="M6 10C6 11.1 5.1 12 4 12C2.9 12 2 11.1 2 10H6ZM10 10C10 11.1 10.9 12 12 12C13.1 12 14 11.1 14 10H10ZM18 10C18 11.1 18.9 12 20 12C21.1 12 22 11.1 22 10H18ZM19 2H5C4.4 2 4 2.4 4 3V4H20V3C20 2.4 19.6 2 19 2ZM12 17C12 16.4 11.6 16 11 16H6C5.4 16 5 16.4 5 17C5 17.6 5.4 18 6 18H11C11.6 18 12 17.6 12 17Z" fill="currentColor"/></svg>
                <span class="small-med w-60 text-align-c">Köszönjük, hogy bővíti webáruházunk kínálatát.</span>
            </div>
        </div>
    </div>
</div>
<script>
    function __displayApprEr (app) { 
        if (app > 0) { document.getElementById('pd-er-gen').classList.remove('hidden');
            document.getElementById('pd-er-gen').innerHTML = `
            <div class="flex flex-row-d-col-m flex-align-c flex-justify-con-sb border-soft border-warning-dotted warning-bg padding-1">
                <div class="flex flex-row-d-col-m flex-align-c gap-1">
                    <div class="flex flex-row flex-align-c gap-1 w-fa">
                        <div class="flex">
                            <svg class="drop-shadow" width="36" height="36" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path opacity="0.3" d="M19 22H5C4.4 22 4 21.6 4 21V3C4 2.4 4.4 2 5 2H14V4H6V20H18V8H20V21C20 21.6 19.6 22 19 22Z" fill="currentColor"/><path d="M15 8H20L14 2V7C14 7.6 14.4 8 15 8Z" fill="currentColor"/></svg>
                        </div>
                        <div class="flex flex-col flex-align-c flex-justify-con-fs w-fa">
                            <span class="bold w-100 small">Megközelítőleg ${app} db mezőt hagyott üresen.</span>
                            <span class="text-warning small-med">Úgy számoljuk, hogy Ön jelenleg nem töltött ki minden mezőt, amely szükséges a termék létrehozásához. Figyelem! Ez a számítás eltérhet a ténylegesen üresen hagyott mezők számától, ez csak egy megközelítő érték. Amennyiben úgy gondolja, hogy Ön kitöltött minden szükséges mezőt, hagyja figyelmen kívűl ezt az értesítést.</span>
                        </div>
                    </div>
                </div>
            </div>`;
        } else { document.getElementById('pd-er-gen').innerHTML = ``; document.getElementById('pd-er-gen').classList.add('hidden'); }
    }

    var apprInput = document.getElementsByClassName("prd-ch-fr-er"); var apprErr = 0; var apprCE = document.getElementsByClassName("prd-ch-fr-er-ce"); let emptyCE = 0; let emptyInp = 0;
    for (let i = 0; i < apprInput.length; i++) {
        if (apprInput[i].tagName !== 'TAGS') { if (apprInput[i].value.length < 1) { emptyInp++; }
            apprInput[i].addEventListener('input', () => { if (apprInput[i].value.length > 0) { emptyInp = emptyInp -1; __displayApprEr(emptyInp + emptyCE); } }, { once: true });
        }
    } for (let i = 0; i < apprCE.length; i++) { if (apprCE[i].getElementsByClassName('ql-editor')[0].textContent.length < 1) { emptyCE++; }
        apprCE[i].addEventListener('input', () => { if (apprCE[i].getElementsByClassName('ql-editor')[0].textContent.length > 0) { emptyCE = emptyCE -1; __displayApprEr(emptyCE + emptyInp); } }, { once: true });
    } __displayApprEr(emptyInp+emptyCE);

    
</script>
<script src="/assets/script/products/create.js"></script>