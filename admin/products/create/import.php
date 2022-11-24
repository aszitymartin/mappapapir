<?php require_once($_SERVER['DOCUMENT_ROOT'].'/includes/inc.php'); ?>
<script src="/assets/script/quill/dist/quill.js"></script><script src="/assets/script/tagify/dist/tagify.js"></script>
<div class="flex flex-col gap-1">
    <div class="hidden" id="import-status"></div>
    <div class="flex flex-col w-fa gap-1 border-soft item-bg box-shadow padding-1">
        <div class="flex flex-col gap-025">
            <div class="flex flex-row flex-align-c flex-justify-con-sb gap-05">
                <span class="text-primary bold">Importálás</span>
            </div>
        </div>
        <div id="gn-er-ls-cn"></div>
        <div class="flex flex-col gap-1">
            <div class="flex flex-col gap-2 prio__con">
                <input type='hidden' id='current_page' /><input type='hidden' id='show_per_page' />
                <ul class="text-muted small-med text-align-l w-fa padding-0 margin-none" id="pagingBox">
                    <?php $prod__sql = "SELECT products.id, products.name, products.thumbnail, products.added, products__variations.color, products__variations.brand, products__variations.model, products__pricing.base, products__inventory.quantity, products__inventory.unit FROM `products` INNER JOIN products__variations ON products__variations.pid = products.id INNER JOIN products__pricing ON products__pricing.pid = products.id INNER JOIN products__inventory ON products__inventory.pid = products.id WHERE 1 ORDER BY added DESC"; $prod__res = $con-> query($prod__sql); while($data = $prod__res-> fetch_assoc()) { $thmb = "'/assets/images/uploads/".$data['thumbnail']."'"; 
                        echo '
                        <li class="flex flex-row flex-align-c w-fa">
                            <div class="padding-05 w-60">
                                <div class="flex flex-row flex-align-c gap-05">
                                    <div class="product-miniature border-primary pointer" style="background-image: url('.$thmb.');"></div>
                                    <div class="flex flex-col gap-025">
                                        <span>'.$data['name'].'</span>
                                        <div class="flex flex-row small-med">'.$data['color'].'</div>
                                    </div>
                                </div>
                            </div>
                            <div class="flex flex-row w-40">
                                <div class="flex flex-row flex-align-c w-fa padding-05">#'.$data['id'].'</div>
                                <div class="flex flex-row flex-align-c w-fa padding-05">'.$data['added'].'</div>
                                <div class="flex flex-row flex-align-c w-fa padding-05 relative">
                                    <div onclick="__import(this.id)" id="edt_'.$data['id'].'" class="flex flex-row flex-align-c w-fc stockd__trigger pointer user-select-none smaller background-bg backaground-bg-hover text-primary border-soft padding-05">
                                        <span">Importálás</span>
                                    </div>
                                </div>
                            </div>
                        </li>
                        ';
                    }
                    ?>
                </ul>
                <script>
                    jQuery(document).ready(function () {
                        var show_per_page = 8; 
                        var number_of_items = $('#pagingBox').children().length;
                        var number_of_pages = Math.ceil(number_of_items/show_per_page);
                        $('#current_page').val(0); $('#show_per_page').val(show_per_page);
                        var navigation_html = `<a href="javascript:previous();" class="previous_link flex flex-col flex-align-c flex-justify-con-c padding-05 border-soft-light text-primary background-bg background-bg-hover pointer user-select-none" id="prev_link"><svg width="18" height="18" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M11.2657 11.4343L15.45 7.25C15.8642 6.83579 15.8642 6.16421 15.45 5.75C15.0358 5.33579 14.3642 5.33579 13.95 5.75L8.40712 11.2929C8.01659 11.6834 8.01659 12.3166 8.40712 12.7071L13.95 18.25C14.3642 18.6642 15.0358 18.6642 15.45 18.25C15.8642 17.8358 15.8642 17.1642 15.45 16.75L11.2657 12.5657C10.9533 12.2533 10.9533 11.7467 11.2657 11.4343Z" fill="currentColor"/></svg></a>`;
                        var current_link = 0;
                        while(number_of_pages > current_link) {navigation_html += '<a class="page_link flex flex-col flex-align-c flex-justify-con-c padding-05 border-soft-light text-primary background-bg background-bg-hover pointer user-select-none" href="javascript:go_to_page(' + current_link +')" longdesc="' + current_link +'">'+ (current_link + 1) +'</a>'; current_link++; }
                        navigation_html += `<a href="javascript:next();" class="next_link flex flex-col flex-align-c flex-justify-con-c padding-05 border-soft-light text-primary background-bg background-bg-hover pointer user-select-none" id="next_link"><svg width="18" height="18" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M12.6343 12.5657L8.45001 16.75C8.0358 17.1642 8.0358 17.8358 8.45001 18.25C8.86423 18.6642 9.5358 18.6642 9.95001 18.25L15.4929 12.7071C15.8834 12.3166 15.8834 11.6834 15.4929 11.2929L9.95001 5.75C9.5358 5.33579 8.86423 5.33579 8.45001 5.75C8.0358 6.16421 8.0358 6.83579 8.45001 7.25L12.6343 11.4343C12.9467 11.7467 12.9467 12.2533 12.6343 12.5657Z" fill="currentColor"/></svg></a>`;
                        $('#page_navigation').html(navigation_html); $('#page_navigation .page_link:first').addClass('pagination-active');
                        $('#pagingBox').children().css('display', 'none'); $('#pagingBox').children().slice(0, show_per_page).css('display', 'flex');
                    });
                    function previous(){ new_page = parseInt($('#current_page').val()) - 1; if($('.pagination-active').prev('.page_link').length==true){ go_to_page(new_page); } }
                    function next(){ new_page = parseInt($('#current_page').val()) + 1; if($('.pagination-active').next('.page_link').length==true ){ go_to_page(new_page); } }
                    function go_to_page(page_num) { var show_per_page = parseInt($('#show_per_page').val()); start_from = page_num * show_per_page; end_on = start_from + show_per_page;
                        $('#pagingBox').children().css('display', 'none').slice(start_from, end_on).css('display', 'flex');
                        $('.page_link[longdesc=' + page_num +']').addClass('pagination-active').siblings('.pagination-active').removeClass('pagination-active');
                        $('#current_page').val(page_num);
                    }               
                    
                    function __import (item) { var itid = item.split("_")[1];
                        if (item.split("_")[0] == 'edt') {
                            if (__isnum(__isnum(itid)[1])) { var importData = new FormData(); importData.append("pid", itid);
                                $.ajax({ enctype: "multipart/form-data", type: "POST", url: "/admin/products/info.php", data: importData, dataType: 'json', contentType: false, processData: false,
                                    success: function(data) { var importend = false;
                                        document.getElementById('product-name').value = data.name; document.getElementById('prod-desc-editor').getElementsByClassName('ql-editor')[0].innerHTML = data.description;
                                        document.getElementById('product-status').value = data.status; __setstatus(data.status); document.getElementById('prd-st-con').getElementsByClassName('cst-sl-it')[0].querySelectorAll('div')[(data.status)-1].click(); document.getElementById('prd-st-con').getElementsByClassName('cst-sl-sltd')[0].click();
                                        document.getElementById('product-category').value = data.category; document.getElementById('product-tags').value = data.tags;
                                        document.getElementById('product-price').value = data.price; if (Number(data.discounted) == 1) { document.getElementById('pd-perc').click(); document.getElementById('discount-range').value = data.discount; document.getElementById('disc-ind').value = data.discount; }
                                        document.getElementById('product-code').value = data.code; document.getElementById('product-quantity').value = data.quantity;
                                        document.getElementById('product-quantity-wh').value = data.q__warehouse; document.getElementById('product-quantity-unit').value = data.q__unit;
                                        if (Number(data.backorder) == 1) { document.getElementById('product-backorder').click(); }
                                        document.getElementById('product-color').value = data.color; document.getElementById('product-material').value = data.material; document.getElementById('product-style').value = data.style; document.getElementById('product-brand').value = data.brand; document.getElementById('product-model').value = data.model;
                                        if (data.custom) { var custom = data.custom.split(',');
                                            for (let i = 0; i < custom.length; i++) { document.getElementById('add-variations').click();
                                                document.getElementById('var-name-'+(i+1)).value = custom[i].split(':')[0]; document.getElementById('var-val-'+(i+1)).value = custom[i].split(':')[1];
                                            }
                                        } if (Number(data.physical) == 1) { document.getElementById('product-physical').click(); 
                                            document.getElementById('product-weight').value = data.weight; document.getElementById('product-weight-unit').value = data.w__unit;
                                            document.getElementById('product-width').value = data.width; document.getElementById('product-height').value = data.height; document.getElementById('product-length').value = data.length; document.getElementById('product-dimension-unit').value = data.d__unit;
                                        } if (Number(data.refund) == 1) { document.getElementById('product-refund').click(); }
                                        document.getElementById('product-meta-title').value = data.meta__title; document.getElementById('prod-meta-editor').getElementsByClassName('ql-editor')[0].innerHTML = data.meta__desc; document.getElementById('product-meta-keywords').value = data.meta__keyw;
                                        if (Number(data.review__enable) == 1 && !document.getElementById('product-review-stat').checked) { document.getElementById('product-review-stat').click(); }
                                        if (Number(data.review__auth) == 1 && !document.getElementById('product-review-auth').checked) { document.getElementById('product-review-auth').click(); }
                                        if (Number(data.review__vote) == 1 && !document.getElementById('product-review-vote').checked) { document.getElementById('product-review-vote').click(); }
                                        if (Number(data.review__privacy) == 1 && !document.getElementById('product-review-privacy').checked) { document.getElementById('product-review-privacy').click(); }
                                        imported = true;
                                        if (imported == true) { document.getElementById('import-status').classList.remove('hidden'); document.getElementById('import-status').innerHTML = `<div class="flex flex-row-d-col-m flex-align-c flex-justify-con-sb border-soft border-success-dotted success-bg padding-1"><div class="flex flex-row-d-col-m flex-align-c gap-1"><div class="flex flex-row flex-align-c gap-1 w-fa"><div class="flex"><svg class="drop-shadow" width="36" height="36" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><rect opacity="0.3" x="2" y="2" width="20" height="20" rx="10" fill="currentColor"/><rect x="11" y="14" width="7" height="2" rx="1" transform="rotate(-90 11 14)" fill="currentColor"/><rect x="11" y="17" width="2" height="2" rx="1" transform="rotate(-90 11 17)" fill="currentColor"/></svg></div><div class="flex flex-col flex-align-c flex-justify-con-fs w-fa"><span class="bold w-100 small">Sikeres importálás</span><span class="small-med">A termék importálása sikeresen megtörtént.</span></div></div></div></div>`;
                                                setTimeout(() => { document.getElementById('import-status').classList.add('hidden'); document.getElementById('import-status').innerHTML = ``; }, 5000);
                                        } else { document.getElementById('import-status').classList.remove('hidden'); document.getElementById('import-status').innerHTML = `<div class="flex flex-row-d-col-m flex-align-c flex-justify-con-sb border-soft border-danger-dotted danger-bg padding-1"><div class="flex flex-row-d-col-m flex-align-c gap-1"><div class="flex flex-row flex-align-c gap-1 w-fa"><div class="flex"><svg class="drop-shadow" width="36" height="36" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><rect opacity="0.3" x="2" y="2" width="20" height="20" rx="10" fill="currentColor"/><rect x="11" y="14" width="7" height="2" rx="1" transform="rotate(-90 11 14)" fill="currentColor"/><rect x="11" y="17" width="2" height="2" rx="1" transform="rotate(-90 11 17)" fill="currentColor"/></svg></div><div class="flex flex-col flex-align-c flex-justify-con-fs w-fa"><span class="bold w-100 small">Sikertelen importálás</span><span class="small-med">A termék importálása nem történt meg.</span></div></div></div></div>`; setTimeout(() => { document.getElementById('import-status').classList.add('hidden'); document.getElementById('import-status').innerHTML = ``; }, 5000); }
                                    }, error: function (data) { document.getElementById('import-status').classList.remove('hidden'); document.getElementById('import-status').innerHTML = `<div class="flex flex-row-d-col-m flex-align-c flex-justify-con-sb border-soft border-danger-dotted danger-bg padding-1"><div class="flex flex-row-d-col-m flex-align-c gap-1"><div class="flex flex-row flex-align-c gap-1 w-fa"><div class="flex"><svg class="drop-shadow" width="36" height="36" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><rect opacity="0.3" x="2" y="2" width="20" height="20" rx="10" fill="currentColor"/><rect x="11" y="14" width="7" height="2" rx="1" transform="rotate(-90 11 14)" fill="currentColor"/><rect x="11" y="17" width="2" height="2" rx="1" transform="rotate(-90 11 17)" fill="currentColor"/></svg></div><div class="flex flex-col flex-align-c flex-justify-con-fs w-fa"><span class="bold w-100 small">Sikertelen importálás</span><span class="small-med">A termék importálása nem történt meg.</span></div></div></div></div>`; setTimeout(() => { document.getElementById('import-status').classList.add('hidden'); document.getElementById('import-status').innerHTML = ``; }, 5000); }
                                });
                            } else { console.log('Érvénytelen azonosítót használt.'); }
                        }
                    }
                    function __isnum (val) { return [typeof val === 'number', val]; }
                </script>
            </div>
            <div class="flex flex-row flex-align-c flex-justify-con-fe gap-1 w-fa">
                <div id='page_navigation' class="flex flex-row flex-align-c gap-05"></div>
            </div>
        </div>
    </div>
</div>
