<?php require_once($_SERVER['DOCUMENT_ROOT'].'/includes/inc.php'); ?>
<div class="flex flex-row-d-col-m gap-1">
    <div class="flex flex-col w-fa gap-1 border-soft item-bg box-shadow padding-1">
        <div class="flex flex-col gap-025">
            <div class="flex flex-row flex-align-c flex-justify-con-sb gap-05">
                <span class="text-primary bold">Vásárlók véleményei</span>
            </div>
            <hr style="border: 1px solid var(--background);" class="w-100">
        </div>
        <div class="flex flex-col gap-2">
            <div class="flex flex-col">
                <div class="flex flex-row flex-align-c gap-1">
                    <label class="cst-chb-lbl">
                        <input type="checkbox" class="absolute" name="product-review-stat" id="product-review-stat" checked>
                        <span class="cst-checkbox"></span>
                    </label>
                    <span class="text-secondary small" style="line-height: 2rem;">Vélemények engedélyezése</span>
                </div>
                <span class="text-muted small-med">Engedélyezze, vagy tiltsa le a termék véleményezését.</span>
            </div>
            <div class="flex flex-col">
                <div class="flex flex-row flex-align-c gap-1">
                    <label class="cst-chb-lbl">
                        <input type="checkbox" class="absolute" name="product-review-auth" id="product-review-auth">
                        <span class="cst-checkbox"></span>
                    </label>
                    <span class="text-secondary small" style="line-height: 2rem;">Hitelesítés</span>
                </div>
                <span class="text-muted small-med">Csak hitelesített vásárlóktól fogadható el értékelés.</span>
            </div>
            <div class="flex flex-col">
                <div class="flex flex-row flex-align-c gap-1">
                    <label class="cst-chb-lbl">
                        <input type="checkbox" class="absolute" name="product-review-vote" id="product-review-vote">
                        <span class="cst-checkbox"></span>
                    </label>
                    <span class="text-secondary small" style="line-height: 2rem;">Szavazás</span>
                </div>
                <span class="text-muted small-med">Értékelések szavazásának engedélyezése.</span>
            </div>
            <div class="flex flex-col">
                <div class="flex flex-row flex-align-c gap-1">
                    <label class="cst-chb-lbl">
                        <input type="checkbox" class="absolute" name="product-review-privacy" id="product-review-privacy" checked>
                        <span class="cst-checkbox"></span>
                    </label>
                    <span class="text-secondary small" style="line-height: 2rem;">Nevek feltüntetése</span>
                </div>
                <span class="text-muted small-med">Értékelők neveinek mutatása / rejtése.</span>
            </div>
        </div>
    </div>
</div>
<script>
    document.getElementById('product-review-stat').addEventListener("click", () => {
        if (!document.getElementById('product-review-stat').checked) { document.getElementById('en-er-rev').classList.remove('hidden');
            document.getElementById('en-er-rev').innerHTML = `
            <div class="flex flex-row-d-col-m flex-align-c flex-justify-con-sb border-soft border-secondary-dotted text-secondary background-bg padding-1">
                <div class="flex flex-row-d-col-m flex-align-c gap-1">
                    <div class="flex flex-row flex-align-c gap-1 w-fa">
                        <div class="flex">
                            <svg class="drop-shadow" width="36" height="36" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M11.1359 4.48359C11.5216 3.82132 12.4784 3.82132 12.8641 4.48359L15.011 8.16962C15.1523 8.41222 15.3891 8.58425 15.6635 8.64367L19.8326 9.54646C20.5816 9.70867 20.8773 10.6186 20.3666 11.1901L17.5244 14.371C17.3374 14.5803 17.2469 14.8587 17.2752 15.138L17.7049 19.382C17.7821 20.1445 17.0081 20.7069 16.3067 20.3978L12.4032 18.6777C12.1463 18.5645 11.8537 18.5645 11.5968 18.6777L7.69326 20.3978C6.99192 20.7069 6.21789 20.1445 6.2951 19.382L6.7248 15.138C6.75308 14.8587 6.66264 14.5803 6.47558 14.371L3.63339 11.1901C3.12273 10.6186 3.41838 9.70867 4.16744 9.54646L8.3365 8.64367C8.61089 8.58425 8.84767 8.41222 8.98897 8.16962L11.1359 4.48359Z" fill="currentColor"/></svg>
                        </div>
                        <div class="flex flex-col flex-align-c flex-justify-con-fs w-fa">
                            <span class="bold w-100 small">A termék véleményezései ki lettek kapcsolva.</span>
                            <span class="text-warning small-med">Ön kikapcsolta a véleményezés funkciót ez a termék alatt. A vásárlóknak nem lesz lehetőségük értékelni ezt a terméket amíg ez a funkció le van tiltva. Ezt a beállítást bármikor módosíthatja a <em>Termékek szerkesztése</em> menüpontban, vagy <span class="link bold pointer user-select-none" onclick="document.getElementById('tabs-reviews').click();">ide kattintva megváltoztathatja</span> most is.</span>
                        </div>
                    </div>
                </div>
            </div>
            `;
        } else { document.getElementById('en-er-rev').innerHTML = ``; document.getElementById('en-er-rev').classList.add('hidden'); }
    });
</script>