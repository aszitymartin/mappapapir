<script src="/assets/script/quill/dist/quill.js"></script><script>var formatter = new Intl.NumberFormat('hu-HU', {style: 'currency',currency: 'HUF',maximumFractionDigits: 0,minimumFractionDigits: 0});</script>
<div class="flex flex-row-d-col-m gap-1">
    <div class="flex flex-col w-fa border-soft item-bg box-shadow padding-1 gap-1">
        <?php require_once('includes/header.php'); ?>
        <div class="flex flex-col gap-1">
            <div class="flex flex-col gap-05">
                <div id="price-con"></div>
            </div>
            <div class="flex flex-col gap-05">
                <span class="text-muted small-med">Ingyenes szállítás <b>Bács-Kiskun</b> megyében, illetve 30 000 Ft felett a szállítási díjat átvállaljuk.</span>
            </div>
            <div class="flex flex-col gap-05">
                <div class="flex flex-row flex-align-c gap-2 small">
                    <div class="flex flex-row flex-align-c gap-05 small">
                        <span class="text-secondary">Szín:</span><span class="text-primary bold small-med" id="product-color"></span>
                    </div>
                </div>
                <div class="flex flex-row flex-align-c gap-05" id="product-color-var"></div>
            </div>
            <div class="flex flex-col gap-05">
                <div class="flex flex-row flex-align-c gap-05 small">
                    <span class="text-secondary">Stílus:</span><span class="text-primary bold small-med" id="product-style"></span>
                </div>
            </div>
            <div class="flex flex-col gap-05">
                <div class="flex flex-row flex-align-c gap-05 small">
                    <span class="text-secondary">Márka:</span><span class="text-primary bold small-med" id="product-brand"></span>
                </div>
            </div>
            <div class="flex flex-col gap-05">
                <div class="flex flex-row flex-align-c gap-05 small">
                    <span class="text-secondary">Model:</span><span class="text-primary bold small-med" id="product-model"></span>
                </div>
            </div>
        </div><hr style="border: 1px solid var(--background);" class="w-100">
        <div class="flex flex-col gap-1">
            <h4 class="text-primary margin-none">Termék leírása</h4>
            <div class="text-primary" id="product-description"></div>
            <div class="flex flex-row flex-align-c gap-05 text-primary small-med">
                <span><strong>Megjegyzés: </strong>Az elektromos csatlakozóval ellátott termékeket az Egyesült Államokban való használatra tervezték. A csatlakozóaljzatok és a feszültség nemzetközi szinten különbözik, és ehhez a termékhez adapterre vagy átalakítóra lehet szükség a rendeltetési helyén való használathoz. Kérjük, vásárlás előtt ellenőrizze a kompatibilitást.</span>
            </div>
        </div>
    </div>
</div>
<div class="flex flex-col" id="prod-var-cus-con">
    <div class="flex flex-col w-fa gap-1 border-soft item-bg box-shadow padding-1 gap-1">
        <h3 class="text-primary margin-none">Termékinformációk</h3>
        <table class="product-table" id="product-table"></table>
    </div>
</div>
<div class="flex flex-row-d-col-m gap-1" id="product-compare-section">
    <div class="flex flex-col w-fa gap-1 border-soft item-bg box-shadow padding-1">
        <h3 class="text-primary margin-none">Összehasonlítás hasonló termékekkel</h3>
        <div class="flex flex-row w-fa overflow-x-scroll hide-scroll">
            <table class="table-fixed compare-table text-align-c" id="compare-table" style="border-collapse: collapse;">
                <tr class="text-muted small" id="cp-prod">
                    <th class="w-5"></th>
                </tr>
                <tr class="text-muted small" id="cp-review">
                    <th class="w-5 text-align-l padding-05">Értékelések</th>
                </tr>
                <tr class="text-muted small" id="cp-price">
                    <th class="w-5 text-align-l padding-05">Ár</th>
                </tr>
                <tr class="text-muted small" id="cp-brand">
                    <th class="w-5 text-align-l padding-05">Márka</th>
                </tr>
                <tr class="text-muted small" id="cp-color">
                    <th class="w-5 text-align-l padding-05">Szín</th>
                </tr>
                <tr class="text-muted small" id="cp-weight">
                    <th class="w-5 text-align-l padding-05">Súly</th>
                </tr>
                <tr class="text-muted small" id="cp-dimensions">
                    <th class="w-5 text-align-l padding-05">Dimenziók</th>
                </tr>
            </table>
        </div>
    </div>
</div>
<script>var bal__to__form = document.getElementsByClassName('money__form'); for (let i = 0; i < bal__to__form.length; i++) { bal__to__form[i].textContent = formatter.format(bal__to__form[i].getAttribute('default-data')); }</script>
<script>
var urldata = new FormData(); urldata.append("pid", urlpid);
$.ajax({ enctype: "multipart/form-data", type: "POST", url: "/assets/php/webshop/info.php", data: urldata, dataType: 'json', contentType: false, processData: false,
    success: function(data) {
        document.getElementById('product-color').textContent = data.variations.color; document.getElementById('product-style').textContent = data.variations.style;
        if (data.variations.clr__variations) {
            for (let i = 0; i < data.variations.clr__variations.length; i++) {
                var clrpid = new FormData(); clrpid.append('pid', data.variations.clr__variations[i]);
                $.ajax({ enctype: "multipart/form-data", type: "POST", url: "/assets/php/webshop/info.php", data: clrpid, dataType: 'json', contentType: false, processData: false,
                    success: function(variation) {
                        document.getElementById('product-color-var').innerHTML += `<a href="/product/${variation.general.pid}/${variation.variations.brand.latinize().toLowerCase().replace(/\s/g , "-").replace(/,/g, '')}-${variation.general.name.latinize().toLowerCase().replace(/\s/g , "-").replace(/,/g, '')}-${variation.variations.color.latinize().toLowerCase().replace(/\s/g , "-").replace(/,/g, '')}"><div class="product-miniature-variation border-primary pointer" data-image="${variation.general.thumbnail}" style="background-image: url(&quot;/assets/images/uploads/${variation.general.thumbnail}&quot;);" title="${variation.variations.color}"></div></a>`;
                        var varMiniature = document.getElementsByClassName('product-miniature-variation');
                        for (let i = 0 ; i < varMiniature.length; i++) {
                            varMiniature[i].addEventListener('mouseenter', () => {
                                document.getElementById('product-thumbnail').src = '/assets/images/uploads/'+varMiniature[i].getAttribute('data-image');
                                if (document.getElementById('product-thumbnail').src.split(".")[1] == "png") { document.getElementById('product-thumbnail').classList.add('drop-shadow'); }
                                else { document.getElementById('product-thumbnail').classList.remove('drop-shadow'); }
                            }); varMiniature[i].addEventListener('mouseout', () => {
                                document.getElementById('product-thumbnail').src = '/assets/images/uploads/'+data.general.thumbnail;
                                if (document.getElementById('product-thumbnail').src.split(".")[1] == "png") { document.getElementById('product-thumbnail').classList.add('drop-shadow'); }
                                else { document.getElementById('product-thumbnail').classList.remove('drop-shadow'); }
                            });
                        }
                    }
                });
            }
        } document.getElementById('product-brand').textContent = data.variations.brand;document.getElementById('product-model').textContent = data.variations.model +', '+ data.variations.color; document.getElementById('product-description').innerHTML = data.general.description;
        if (data.variations.custom.length > 1) {
            data.variations.custom.forEach(showCustom);
            function showCustom (item) { document.getElementById('product-table').innerHTML += `<tr><th>${item.split(':')[0]}</th><td>${item.split(':')[1]}</td></tr>`; }
        } else { document.getElementById('prod-var-cus-con').remove(); } var name = data.general.name; if (name.length > 90) { name = name.slice(0, 90)+'...'; }
        document.getElementById('cp-prod').innerHTML += `
            <td class="w-5 background-bg padding-05 white-space-normal border-muted-side border-muted-top">
                <div class="flex flex-col gap-05">
                    <div class="flex flex-col flex-align-c flex-justify-con-c relative">
                        <img src="/assets/images/uploads/${data.general.thumbnail}" class="product-thumbnail drop-shadow" style="height: 6rem; width: 6rem; object-fit: contain;">
                    </div>
                    <span class="text-primary smaller-light white-space-normal">${name}</span>
                </div>
            </td>
        `; document.getElementById('cp-review').innerHTML += `
            <td class="w-5 background-bg padding-05 white-space-normal border-muted-side text-primary">
                <div class="flex flex-row flex-align-c flex-justify-con-c gap-05 text-align-l w-fa">
                    <div class="flex flex-row flex-align-c">
                        <span class="small-med" id="cp__star__ind">
                            <span class="text-primary"><svg class='wizard_input_loading' xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1"><g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"><g><polygon points="0 0 24 0 24 24 0 24"/></g><path d="M12,4 L12,6 C8.6862915,6 6,8.6862915 6,12 C6,15.3137085 8.6862915,18 12,18 C15.3137085,18 18,15.3137085 18,12 C18,10.9603196 17.7360885,9.96126435 17.2402578,9.07513926 L18.9856052,8.09853149 C19.6473536,9.28117708 20,10.6161442 20,12 C20,16.418278 16.418278,20 12,20 C7.581722,20 4,16.418278 4,12 C4,7.581722 7.581722,4 12,4 Z" class="svg" fill-rule="nonzero" opacity="0.4" transform="translate(12.000000, 12.000000) scale(-1, 1) translate(-12.000000, -12.000000) "/></g></svg></span>
                        </span>
                        <span class="small-med bold" id="cp__star__count"></span>
                    </div>
                    <span class="text-primary-light link user-select-none pointer small-med" id="cp__rvc__ind" onclick="document.getElementById('tabs-reviews').click();"></span>
                </div>
            </td>
        `; document.getElementById('cp-price').innerHTML += `<td class="w-5 text-primary background-bg padding-05 border-muted-side"><span class="text-primary money__form" id="cp-mn-price"></span></td>`;
        document.getElementById('cp-brand').innerHTML += `<td class="w-5 text-primary background-bg padding-05 border-muted-side">${data.variations.brand}</td>`;
        document.getElementById('cp-color').innerHTML += `<td class="w-5 text-primary background-bg padding-05 border-muted-side">${data.variations.color}</td>`;
        document.getElementById('cp-weight').innerHTML += `<td class="w-5 text-primary background-bg padding-05 border-muted-side">${data.shipping.weight} ${data.shipping.w__unit}</td>`;
        document.getElementById('cp-dimensions').innerHTML += `<td class="w-5 text-primary background-bg padding-05 border-muted-side border-muted-bot">${data.shipping.width} x ${data.shipping.height} x ${data.shipping.length} ${data.shipping.d__unit}</td>`;
        urldata.append("category", data.category.category); urldata.append("tags", data.category.tags); urldata.append("pmodel", data.variations.model);
        $.ajax({ enctype: "multipart/form-data", type: "POST", url: "/assets/php/webshop/compare.php", data: urldata, dataType: 'json', contentType: false, processData: false,
            success: function(data) {
                if (data.length > 0) {
                    for (let i = 0; i < data.length; i++) { var name = data[i].general.name; if (name.length > 90) { name = name.slice(0, 90)+'...'; }
                        document.getElementById('cp-prod').innerHTML += `
                            <td class="w-5 padding-05 white-space-normal">
                                <a href="/product/${data[i].general.pid}/${data[i].variations.brand.latinize().toLowerCase().replace(/\s/g , "-").replace(/,/g, '')}-${data[i].general.name.latinize().toLowerCase().replace(/\s/g , "-").replace(/,/g, '')}-${data[i].variations.color.latinize().toLowerCase().replace(/\s/g , "-").replace(/,/g, '')}" target="_blank">
                                <div class="flex flex-col gap-05">
                                    <div class="flex flex-col flex-align-c flex-justify-con-c relative">
                                        <img src="/assets/images/uploads/${data[i].general.thumbnail}" class="product-thumbnail drop-shadow" style="height: 6rem; width: 6rem; object-fit: contain;">
                                    </div>
                                    <span class="text-primary smaller-light white-space-normal">${name}</span>
                                </div>
                                </a>
                            </td>
                        `;
                        document.getElementById('cp-review').innerHTML += `
                            <td class="w-5 padding-05 white-space-normal">
                                <div class="flex flex-row flex-align-c flex-justify-con-c gap-05 text-align-l w-fa">
                                    <div class="flex flex-row flex-align-c">
                                        <span class="small-med" id="star__ind__${data[i].general.pid}"><span class="text-muted"><svg class='wizard_input_loading' xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1"><g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"><g><polygon points="0 0 24 0 24 24 0 24"/></g><path d="M12,4 L12,6 C8.6862915,6 6,8.6862915 6,12 C6,15.3137085 8.6862915,18 12,18 C15.3137085,18 18,15.3137085 18,12 C18,10.9603196 17.7360885,9.96126435 17.2402578,9.07513926 L18.9856052,8.09853149 C19.6473536,9.28117708 20,10.6161442 20,12 C20,16.418278 16.418278,20 12,20 C7.581722,20 4,16.418278 4,12 C4,7.581722 7.581722,4 12,4 Z" class="svg" fill-rule="nonzero" opacity="0.4" transform="translate(12.000000, 12.000000) scale(-1, 1) translate(-12.000000, -12.000000) "/></g></svg></span></span>
                                        <span class="small-med bold" id="star__count__${data[i].general.pid}"></span>
                                    </div>
                                    <a href="/webshop/?id=${data[i].general.pid}&tab=reviews" target="_blank"><span class="text-primary-light link user-select-none pointer small-med" id="rvc__ind__${data[i].general.pid}"></span></a>
                                </div>
                            </td>
                        `; document.getElementById('cp-price').innerHTML += `<td class="w-5 padding-05"><span class="text-primary money__form" id="cp-prod-price-${data[i].general.pid}">${formatter.format(data[i].pricing.price)}</span></td>`;
                        document.getElementById('cp-brand').innerHTML += `<td class="w-5 padding-05">${data[i].variations.brand}</td>`;
                        document.getElementById('cp-color').innerHTML += `<td class="w-5 padding-05">${data[i].variations.color}</td>`;
                        document.getElementById('cp-weight').innerHTML += `<td class="w-5 padding-05">${data[i].shipping.weight} ${data[i].shipping.w__unit}</td>`;
                        document.getElementById('cp-dimensions').innerHTML += `<td class="w-5 padding-05">${data[i].shipping.width} x ${data[i].shipping.height} x ${data[i].shipping.length} ${data[i].shipping.d__unit}</td>`;
                        var strData = new FormData(); strData.append("pid", data[i].general.pid);
                        $.ajax({ enctype: "multipart/form-data", type: "POST", url: "/assets/php/webshop/stars.php", data: strData, dataType: 'json', contentType: false, processData: false,
                            success: function(star) {
                                if (star.count > 0) { document.getElementById('star__ind__'+data[i].general.pid).innerHTML = `<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="22px" height="22px" viewBox="0 0 24 24" version="1.1"><g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"><polygon points="0 0 24 0 24 24 0 24"></polygon><path d="M12,18 L7.91561963,20.1472858 C7.42677504,20.4042866 6.82214789,20.2163401 6.56514708,19.7274955 C6.46280801,19.5328351 6.42749334,19.309867 6.46467018,19.0931094 L7.24471742,14.545085 L3.94038429,11.3241562 C3.54490071,10.938655 3.5368084,10.3055417 3.92230962,9.91005817 C4.07581822,9.75257453 4.27696063,9.65008735 4.49459766,9.61846284 L9.06107374,8.95491503 L11.1032639,4.81698575 C11.3476862,4.32173209 11.9473121,4.11839309 12.4425657,4.36281539 C12.6397783,4.46014562 12.7994058,4.61977315 12.8967361,4.81698575 L14.9389263,8.95491503 L19.5054023,9.61846284 C20.0519472,9.69788046 20.4306287,10.2053233 20.351211,10.7518682 C20.3195865,10.9695052 20.2170993,11.1706476 20.0596157,11.3241562 L16.7552826,14.545085 L17.5353298,19.0931094 C17.6286908,19.6374458 17.263103,20.1544017 16.7187666,20.2477627 C16.5020089,20.2849396 16.2790408,20.2496249 16.0843804,20.1472858 L12,18 Z" fill="#f6cc00" opacity=".6"></path></g></svg>`; document.getElementById('star__count__'+data[i].general.pid).textContent = star.count;
                                } else { document.getElementById('star__ind__'+data[i].general.pid).innerHTML = `<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="22px" height="22px" viewBox="0 0 24 24" version="1.1"><g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"><polygon points="0 0 24 0 24 24 0 24"></polygon><path d="M12,18 L7.91561963,20.1472858 C7.42677504,20.4042866 6.82214789,20.2163401 6.56514708,19.7274955 C6.46280801,19.5328351 6.42749334,19.309867 6.46467018,19.0931094 L7.24471742,14.545085 L3.94038429,11.3241562 C3.54490071,10.938655 3.5368084,10.3055417 3.92230962,9.91005817 C4.07581822,9.75257453 4.27696063,9.65008735 4.49459766,9.61846284 L9.06107374,8.95491503 L11.1032639,4.81698575 C11.3476862,4.32173209 11.9473121,4.11839309 12.4425657,4.36281539 C12.6397783,4.46014562 12.7994058,4.61977315 12.8967361,4.81698575 L14.9389263,8.95491503 L19.5054023,9.61846284 C20.0519472,9.69788046 20.4306287,10.2053233 20.351211,10.7518682 C20.3195865,10.9695052 20.2170993,11.1706476 20.0596157,11.3241562 L16.7552826,14.545085 L17.5353298,19.0931094 C17.6286908,19.6374458 17.263103,20.1544017 16.7187666,20.2477627 C16.5020089,20.2849396 16.2790408,20.2496249 16.0843804,20.1472858 L12,18 Z" fill="#A1A5B7" opacity=".6"></path></g></svg>`; document.getElementById('star__count__'+data[i].general.pid).textContent = star.count + '.0';
                                } document.getElementById('rvc__ind__'+data[i].general.pid).textContent = "("+star.revs+")"; 
                            }
                        });

                        if (data[i].pricing.discounted == 0 || !data[i].pricing.discounted || data[i].pricing.discount == 0) {
                            document.getElementById('cp-prod-price-'+data[i].general.pid).textContent = formatter.format(data[i].pricing.price);
                        } else {
                            document.getElementById('cp-prod-price-'+data[i].general.pid).innerHTML = `
                            <div class="flex flex-row flex-align-c gap-05">
                                <span class="linethrough smaller-light text-muted">${formatter.format(data[i].pricing.price)}</span>
                                <span class="text-primary money__form small">${formatter.format(data[i].pricing.price - ((data[i].pricing.discount * data[i].pricing.price) / 100))}</span>
                            </div>
                            `;
                        }
                    }
                } else { document.getElementById('product-compare-section').remove(); }
            }, error: function (data) { console.log(data); }
        });
        if (data.pricing.discounted == 0 || !data.pricing.discounted || data.pricing.discount == 0) {
            document.getElementById('price-con').innerHTML = `<div class="flex flex-row"><span class="text-primary larger money__form" id="product-price">NaN Ft</span></div>`;
            document.getElementById('cp-mn-price').textContent = formatter.format(data.pricing.price);
            document.getElementById('product-price').textContent = formatter.format(data.pricing.price);
        } else {
            document.getElementById('cp-mn-price').innerHTML = `
            <div class="flex flex-row flex-align-c gap-05">
                <span class="linethrough smaller-light text-muted">${formatter.format(data.pricing.price)}</span>
                <span class="text-primary money__form small">${formatter.format(data.pricing.price - ((data.pricing.discount * data.pricing.price) / 100))}</span>
            </div>
            `;
            document.getElementById('price-con').innerHTML = `
                <div class="flex flex-col">
                    <div class="flex flex-row flex-align-c gap-05 larger">
                        <span class="text-danger">-${data.pricing.discount}%</span>
                        <span class="text-primary money__form" id="product-price-new">NaN Ft</span>
                    </div>
                    <div class="flex flex-row flex-align-c gap-05 small-med text-muted">
                        <span>Listaár:</span>
                        <span class="linethrough" id="product-price">${data.pricing.price}</span>
                    </div>
                </div>
            `; document.getElementById('product-price').textContent = formatter.format(data.pricing.price);
            document.getElementById('product-price-new').textContent = formatter.format(data.pricing.price - ((data.pricing.discount * data.pricing.price) / 100));
        }
    }
});
</script>
<?php require_once('includes/footer.php'); ?>