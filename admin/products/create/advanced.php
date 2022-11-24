<?php require_once($_SERVER['DOCUMENT_ROOT'].'/includes/inc.php'); ?>
<script src="/assets/script/quill/dist/quill.js"></script><script src="/assets/script/tagify/dist/tagify.js"></script>
<div class="flex flex-row-d-col-m gap-1">
    <div class="flex flex-col w-fa gap-1 border-soft item-bg box-shadow padding-1">
        <div class="flex flex-col gap-025">
            <div class="flex flex-row flex-align-c flex-justify-con-sb gap-05">
                <span class="text-primary bold">Ratkár</span>
                <div error-data="inventory"></div>
            </div>
        </div>
        <div id="in-er-ls-cn"></div>
        <div class="flex flex-col gap-2">
            <div class="flex flex-col gap-05">
                <span class="text-secondary small">Termékazonosító</span>
                <input type="text" class="adm__input item-bg border-soft w-fa text-secondary outline-none small prd-ch-fr-er" id="product-code" name="product-code" placeholder="Termékazonosító" required />
                <span class="text-muted small-med">Adja meg a kiválaszott termék azonosító kódját</span>
            </div>
            <div class="flex flex-col gap-05">
                <span class="text-secondary small">Mennyiség</span>
                <div class="flex flex-row-d-col-m gap-05 w-fa">
                    <div class="flex flex-col w-33d-100m gap-025">
                        <input type="number" class="adm__input item-bg border-soft w-fa text-secondary outline-none small prd-ch-fr-er" id="product-quantity" name="product-quantity" placeholder="Készleten" required />
                        <span class="text-muted small-med">Adja meg a termék készleten lévő mennyiségét</span>
                    </div>
                    <div class="flex flex-col w-33d-100m gap-025">
                        <input type="number" class="adm__input item-bg border-soft w-fa text-secondary outline-none small prd-ch-fr-er" id="product-quantity-wh" name="product-quantity-wh" placeholder="Raktáron" required />
                        <span class="text-muted small-med">Adja meg a termék raktárban tárolt mennyiségét</span>
                    </div>
                    <div class="flex flex-col w-33d-100m gap-025">
                        <input name='product-quantity-unit' id='product-quantity-unit' class='adm__input w-fa border-soft cst-drp-fts prd-ch-fr-er' placeholder='Mértékegység'>
                        <script>
                            var prd_pqu_inp = document.querySelector('input[name="product-quantity-unit"]'),
                            tagify = new Tagify(prd_pqu_inp, { maxTags: 1, originalInputValueFormat: valuesArr => valuesArr.map(item => item.value).join(',') })
                        </script>
                        <span class="text-muted small-med">Adja meg a termék raktárban tárolt mennyiségét</span>
                    </div>
                </div>
            </div>
            <div class="flex flex-col">
                <span class="text-secondary small">Utólagos rendelések</span>
                <div class="flex flex-row flex-align-c gap-1">
                    <label class="cst-chb-lbl">
                        <input type="checkbox" class="absolute" name="product-backorder" id="product-backorder">
                        <span class="cst-checkbox"></span>
                    </label>
                    <span class="text-secondary small" style="line-height: 2rem;">Bekapcsolás</span>
                </div>
                <span class="text-muted small-med">A termék akkor is rendelhető lesz, ha nincsen raktáron</span>
            </div>
        </div>
    </div>
</div>
<div class="flex flex-row-d-col-m gap-1">
    <div class="flex flex-col w-fa gap-1 border-soft item-bg box-shadow padding-1">
        <div class="flex flex-col gap-025">
            <div class="flex flex-row flex-align-c flex-justify-con-sb gap-05">
                <span class="text-primary bold">Variációk</span>
                <div error-data="variations"></div>
            </div>
        </div>
        <div id="vr-er-ls-cn"></div>
        <div class="flex flex-col gap-2">
            <div class="flex flex-col gap-1">
                <span class="text-secondary small">Termékvariációk</span>
                <div class="flex flex-row gap-05 w-fa">
                    <div class="flex flex-col w-30 gap-025">
                        <span type="number" class="adm__input item-bg border-soft w-fa text-secondary outline-none small">Szín</span>
                    </div>
                    <div class="flex flex-col w-70 gap-025">
                        <input name='product-color' id='product-color' class='adm__input w-fa border-soft cst-drp-fts prd-ch-fr-er' placeholder='Szín kiválasztása'>
                        <script>
                            var prd_clr_inp = document.querySelector('input[name="product-color"]'),
                            tagify = new Tagify(prd_clr_inp, {
                                whitelist: [<?php $clr__sql = "SELECT DISTINCT color FROM products__variations"; $clr__res = $con-> query($clr__sql); while ($clr = $clr__res-> fetch_assoc()) { echo "'".ucfirst($clr['color'])."',"; } ?>],
                                maxTags: 5, dropdown: { maxItems: 10, classname: "tags-look", enabled: 0, closeOnSelect: false }, originalInputValueFormat: valuesArr => valuesArr.map(item => item.value).join(',')
                            })
                        </script>
                    </div>
                </div>
                <div class="flex flex-row gap-05 w-fa">
                    <div class="flex flex-col w-30 gap-025">
                        <span type="number" class="adm__input item-bg border-soft w-fa text-secondary outline-none small">Anyag</span>
                    </div>
                    <div class="flex flex-col w-70 gap-025">
                        <input name='product-material' id='product-material' class='adm__input w-fa border-soft cst-drp-fts prd-ch-fr-er' placeholder='Anyag kiválasztása'>
                        <script>
                            var prd_mtr_inp = document.querySelector('input[name="product-material"]'),
                            tagify = new Tagify(prd_mtr_inp, {
                                whitelist: [<?php $clr__sql = "SELECT DISTINCT material FROM products__variations"; $clr__res = $con-> query($clr__sql); while ($clr = $clr__res-> fetch_assoc()) { echo "'".ucfirst($clr['material'])."',"; } ?>],
                                maxTags: 5, dropdown: { maxItems: 10, classname: "tags-look", enabled: 0, closeOnSelect: false }, originalInputValueFormat: valuesArr => valuesArr.map(item => item.value).join(',')
                            })
                        </script>
                    </div>
                </div>
                <div class="flex flex-row gap-05 w-fa">
                    <div class="flex flex-col w-30 gap-025">
                        <span type="number" class="adm__input item-bg border-soft w-fa text-secondary outline-none small">Stílus</span>
                    </div>
                    <div class="flex flex-col w-70 gap-025">
                        <input name='product-style' id='product-style' class='adm__input w-fa border-soft cst-drp-fts prd-ch-fr-er' placeholder='Stílus kiválasztása'>
                        <script>
                            var prd_stl_inp = document.querySelector('input[name="product-style"]'),
                            tagify = new Tagify(prd_stl_inp, { maxTags: 5, originalInputValueFormat: valuesArr => valuesArr.map(item => item.value).join(',') })
                        </script>
                    </div>
                </div>
                <div class="flex flex-row gap-05 w-fa">
                    <div class="flex flex-col w-30 gap-025">
                        <span type="number" class="adm__input item-bg border-soft w-fa text-secondary outline-none small">Márka</span>
                    </div>
                    <div class="flex flex-col w-70 gap-025">
                        <input name='product-brand' id='product-brand' class='adm__input w-fa border-soft cst-drp-fts prd-ch-fr-er' placeholder='Márka kiválasztása'>
                        <script>
                            var prd_brn_inp = document.querySelector('input[name="product-brand"]'),
                            tagify = new Tagify(prd_brn_inp, {
                                whitelist: [<?php $brn__sql = "SELECT DISTINCT brand FROM products__variations"; $brn__res = $con-> query($brn__sql); while ($brn = $brn__res-> fetch_assoc()) { echo "'".ucfirst($brn['brand'])."',"; } ?>],
                                maxTags: 1, dropdown: { maxItems: 25, classname: "tags-look", enabled: 0, closeOnSelect: false }, originalInputValueFormat: valuesArr => valuesArr.map(item => item.value).join(',')
                            })
                        </script>
                    </div>
                </div>
                <div class="flex flex-row gap-05 w-fa">
                    <div class="flex flex-col w-30 gap-025">
                        <span type="number" class="adm__input item-bg border-soft w-fa text-secondary outline-none small">Modell</span>
                    </div>
                    <div class="flex flex-col w-70 gap-025">
                        <input type="text" name='product-model' id='product-model' class='adm__input cst-drp-fts outline-none w-fa border-soft item-bg text-primary prd-ch-fr-er' placeholder='Modell kiválasztása'>
                    </div>
                </div>
                <div id="cst-vrs-con" class="flex flex-col gap-1">
                </div>
                <div class="flex flex-row gap-05 w-fa">
                    <div class="flex flex-col w-70 gap-025">
                        <span id='add-variations' class='primary-bg primary-bg-hover border-soft pointer user-select-none small w-fc' style="padding: .65rem;">Variáció hozzáadása</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="flex flex-row-d-col-m gap-1">
    <div class="flex flex-col w-fa gap-1 border-soft item-bg box-shadow padding-1">
        <div class="flex flex-col gap-025">
            <div class="flex flex-row flex-align-c flex-justify-con-sb gap-05">
                <span class="text-primary bold">Szállítás</span>
                <div error-data="shipping"></div>
            </div>
        </div>
        <div id="sh-er-ls-cn"></div>
        <div class="flex flex-col gap-2">
            <div class="flex flex-col">
                <div class="flex flex-row flex-align-c gap-1">
                    <label class="cst-chb-lbl" id="product-physical-bx">
                        <input type="checkbox" class="absolute" name="product-physical" id="product-physical">
                        <span class="cst-checkbox"></span>
                    </label>
                    <span class="text-secondary small" style="line-height: 2rem;">Ez egy fizikai termék</span>
                </div>
                <span class="text-muted small-med">Válassza ki, hogy fizikai vagy digitális a termék. Fizikai tárgy szállítást igényelhet.</span>
            </div>
            <div class="flex flex-col">
                <div class="flex flex-row flex-align-c gap-1">
                    <label class="cst-chb-lbl" id="product-refund-bx">
                        <input type="checkbox" class="absolute" name="product-refund" id="product-refund">
                        <span class="cst-checkbox"></span>
                    </label>
                    <span class="text-secondary small" style="line-height: 2rem;">Visszatérítésre alkalmas</span>
                </div>
                <span class="text-muted small-med">Válassza ki, hogy a vevő igényelhet-e visszatérítést erre a termékre.</span>
            </div>
            <div id="dimension-con" class="hidden flex-col gap-1">
                <div class="flex flex-row-d-col-m gap-05">
                    <div class="flex flex-col gap-05 w-50d-100m">
                        <span class="text-secondary small">Súly</span>
                        <input type="number" class="adm__input item-bg border-soft w-fa text-secondary outline-none small" id="product-weight" name="product-weight" placeholder="Termék súlya" required />
                        <span class="text-muted small-med">Adja meg a kiválaszott termék súlyát</span>
                    </div>
                    <div class="flex flex-col gap-05 w-50d-100m">
                        <span class="text-secondary small">Mértékegység</span>
                        <input name='product-weight-unit' id='product-weight-unit' class='adm__input w-fa border-soft cst-drp-fts' placeholder='Mértékegység kiválasztása'>
                        <script>
                            var prd_weu_inp = document.querySelector('input[name="product-weight-unit"]'),
                            tagify = new Tagify(prd_weu_inp, {
                                whitelist: ['Gramm', 'Dekagramm', 'Kilógramm'],
                                maxTags: 1, dropdown: { maxItems: 10, classname: "tags-look", enabled: 0, closeOnSelect: false }, originalInputValueFormat: valuesArr => valuesArr.map(item => item.value).join(',')
                            })
                        </script>
                    </div>
                </div>
                <div class="flex flex-col gap-05">
                    <span class="text-secondary small">Dimenziók</span>
                    <div class="flex flex-row-d-col-m w-fa">
                        <div class="flex flex-row-d-col-m flex-align-c flex-justify-con-c gap-05 w-100">
                            <div class="flex flex-col w-24d-100m">
                                <input type="number" class="adm__input item-bg border-soft w-fa text-secondary outline-none small" id="product-width" name="product-width" placeholder="Szélesség" required />
                            </div>
                            <div class="flex flex-col w-24d-100m">
                                <input type="number" class="adm__input item-bg border-soft w-fa text-secondary outline-none small" id="product-height" name="product-height" placeholder="Magasság" required />
                            </div>
                            <div class="flex flex-col w-24d-100m">
                                <input type="number" class="adm__input item-bg border-soft w-fa text-secondary outline-none small" id="product-length" name="product-length" placeholder="Hossz" required />
                            </div>
                            <div class="flex flex-col w-24d-100m">
                                <input name='product-dimension-unit' id='product-dimension-unit' class='adm__input w-fa border-soft cst-drp-fts' placeholder='Mértékegység'>
                                <script>
                                    var prd_diu_inp = document.querySelector('input[name="product-dimension-unit"]'),
                                    tagify = new Tagify(prd_diu_inp, {
                                        whitelist: ['Miliméter', 'Centiméter', 'Deciméter', 'Méter'],
                                        maxTags: 1, dropdown: { maxItems: 10, classname: "tags-look", enabled: 0, closeOnSelect: false }, originalInputValueFormat: valuesArr => valuesArr.map(item => item.value).join(',')
                                    })
                                </script>
                            </div>
                        </div>
                    </div>
                    <span class="text-muted small-med">Adja meg a termék dimenzióit</span>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="flex flex-row-d-col-m gap-1">
    <div class="flex flex-col w-fa gap-1 border-soft item-bg box-shadow padding-1">
        <div class="flex flex-col gap-025">
            <div class="flex flex-row flex-align-c flex-justify-con-sb gap-05">
                <span class="text-primary bold">Meta beállítások</span>
                <div error-data="meta"></div>
            </div>
        </div>
        <div id="mt-er-ls-cn"></div>
        <div class="flex flex-col gap-2">
            <div class="flex flex-col gap-05">
                <span class="text-secondary small">Meta címke neve</span>
                <input type="text" class="adm__input item-bg border-soft w-fa text-secondary outline-none small prd-ch-fr-er" id="product-meta-title" name="product-meta-title" placeholder="Meta címke neve" required />
                <span class="text-muted small-med">Ajánlott egyszerű és pontos kulcsszó használata</span>
            </div>
            <div class="flex flex-col gap-05">
                <span class="text-secondary small">Meta címke leírása</span>
                <div class="flex flex-col">
                    <div id="prod-meta-editor" class="border-soft prd-ch-fr-er-ce" style="height: 8rem;"></div>
                </div>
                <script>
                    var quill = new Quill('#prod-meta-editor', {
                        modules: { toolbar: false }, placeholder: 'Ide írja a leírását...', theme: 'snow'
                    });
                </script>
                <span class="text-muted small-med">Állítsa be a meta címke leírását, hogy növelje a SEO besorolását</span>
            </div>
            <div class="flex flex-col gap-05">
                <span class="text-secondary small">Meta címke kulcsszavai</span>
                <input name='product-meta-keywords' id='product-meta-keywords' class='adm__input w-fa border-soft cst-drp-fts prd-ch-fr-er' placeholder='Meta címke kulcsszavai'>
                <script>
                    var prd_mtk_inp = document.querySelector('input[name="product-meta-keywords"]'),
                    tagify = new Tagify(prd_mtk_inp, { maxTags: 25, originalInputValueFormat: valuesArr => valuesArr.map(item => item.value).join(',') })
                </script>
                <span class="text-muted small-med">Állítsa be a terméket leíró kulcsszavakat.</span>
            </div>
        </div>
    </div>
</div>
<script>var varcount = 0;
    $('#add-variations').click(() => { varcount++;
        var cstitem = document.createElement('div'); cstitem.id = "cst-vrs-itm-"+varcount; cstitem.classList = "flex flex-col gap-1";
        document.getElementById('cst-vrs-con').append(cstitem);
        document.getElementById('cst-vrs-itm-'+varcount).innerHTML = `
        <div class="flex flex-row gap-05 w-fa cst-var-con" id="cst-var-${varcount}">
            <div class="flex flex-col w-30 gap-025">
                <input type="text" id="var-name-${varcount}" class='cst-var-name adm__input w-fa border-soft cst-drp-fts item-bg outline-none text-secondary' placeholder='Variáció'>
            </div>
            <div class="flex flex-row w-70 gap-05">
                <input type="text" id="var-val-${varcount}" class='cst-var-val adm__input outline-none w-fa border-soft item-bg text-primary' placeholder='Variáció kiválasztása'>
                <span class="flex flex-col flex-align-c flex-justify-con-c danger-bg danger-bg-hover border-soft small pointer" style="padding: .65rem;" aria-label="Eltávolítás" role="button" title="Eltávolítás" onclick="__removevariation(${varcount})">
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M6.7 19.4L5.3 18C4.9 17.6 4.9 17 5.3 16.6L16.6 5.3C17 4.9 17.6 4.9 18 5.3L19.4 6.7C19.8 7.1 19.8 7.7 19.4 8.1L8.1 19.4C7.8 19.8 7.1 19.8 6.7 19.4Z" fill="currentColor"/><path d="M19.5 18L18.1 19.4C17.7 19.8 17.1 19.8 16.7 19.4L5.40001 8.1C5.00001 7.7 5.00001 7.1 5.40001 6.7L6.80001 5.3C7.20001 4.9 7.80001 4.9 8.20001 5.3L19.5 16.6C19.9 16.9 19.9 17.6 19.5 18Z" fill="currentColor"/></svg>
                </span>
            </div>
        </div>
        `;
    });
    function __removevariation (index) { document.getElementById('cst-vrs-itm-'+index).remove(); }
</script>
<script>
    document.getElementById('product-physical').addEventListener('click', () => {
        if (document.getElementById('product-physical').checked) { document.getElementById('dimension-con').classList.remove('hidden'); document.getElementById('dimension-con').classList.add('flex'); }
        else { document.getElementById('dimension-con').classList.add('hidden'); document.getElementById('dimension-con').classList.remove('flex'); }
    });
</script>