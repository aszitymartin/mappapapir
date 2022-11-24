<?php require_once($_SERVER['DOCUMENT_ROOT'].'/includes/inc.php'); ?>
<script src="/assets/script/quill/dist/quill.js"></script>
<div class="section_body flex gap-1 overflow-auto flex-justify-con-c-d" id="similar-brand"></div>
<script>var urldata = new FormData(); urldata.append("pid", urlpid);</script>
<script>
    $.ajax({ enctype: "multipart/form-data", type: "POST", url: "/webshop/includes/similar/brand.php", data: urldata, dataType: 'json', contentType: false, processData: false,
        success: function(data) { console.log(data);
            if (data.length > 0) {
                document.getElementById('similar-brand').innerHTML = `
                <div class="flex flex-col w-fa padding-1 gap-1">
                    <h3 class="text-primary margin-none">${data[0].brand} ${data[0].category}</h3>
                    <div class="flex flex-row gap-05" id="brand-con"></div>
                </div>`;
                for (let i = 0; i < data.length; i++) { if (data[i].name.length > 120) { var newname = data[i].name.slice(0, 120) + '...'; } else { var newname = data[i].name }
                    document.getElementById('brand-con').innerHTML += `
                    <div class="flex flex-col item-bg border-soft-light box-shadow nwp__card product-hover product-link pointer">
                        <div class="flex flex-col flex-align-c flex-justify-con-sb padding-1 gap-05">
                            <span class="text-secondary bold small uppercase w-fa text-align-c">${data[i].brand}</span>
                            <div class="flex flex-row flex-align-c gap-05">
                                <div class="flex flex-row flex-justify-con-sb">
                                    <div class="flex flex-col gap-05"><span class="text-secondary small formatted-price bold">${formatter.format(data[i].price)}</span>
                                    </div>
                                </div>
                                <div class="flex flex-row flex-justify-con-c flex-align-c">
                                    <span class="small-med" id="star__ind__${data[i].pid}"><span class="text-muted"><svg class='wizard_input_loading' xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1"><g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"><g><polygon points="0 0 24 0 24 24 0 24"/></g><path d="M12,4 L12,6 C8.6862915,6 6,8.6862915 6,12 C6,15.3137085 8.6862915,18 12,18 C15.3137085,18 18,15.3137085 18,12 C18,10.9603196 17.7360885,9.96126435 17.2402578,9.07513926 L18.9856052,8.09853149 C19.6473536,9.28117708 20,10.6161442 20,12 C20,16.418278 16.418278,20 12,20 C7.581722,20 4,16.418278 4,12 C4,7.581722 7.581722,4 12,4 Z" class="svg" fill-rule="nonzero" opacity="0.4" transform="translate(12.000000, 12.000000) scale(-1, 1) translate(-12.000000, -12.000000) "/></g></svg></span></span>
                                    <span class="small-med bold text-primary" id="star__count__${data[i].pid}"></span>
                                </div>
                            </div>
                        </div>
                        <div class="flex flex-col flex-align-c gap-1">
                            <div class="flex flex-col flex-align-c pointer product-image-container" style="max-width: 8rem !important;">
                                <img src="/assets/images/uploads/${data[i].thumbnail}" class="ind-prd-crd-img drop-shadow">
                            </div>
                            <div class="flex flex-row flex-justify-con-sb">
                                <div class="flex flex-col flex-align-c flex-justify-con-c gap-05 padding-05 w-fa">
                                    <span class="text-primary small-med bold pointer w-fa text-align-c">${newname}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    `;
                    var strData = new FormData(); strData.append("pid", data[i].pid);
                    $.ajax({ enctype: "multipart/form-data", type: "POST", url: "/assets/php/webshop/stars.php", data: strData, dataType: 'json', contentType: false, processData: false,
                        success: function(star) {
                            if (star.count > 0) { document.getElementById('star__ind__'+data[i].pid).innerHTML = `<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="22px" height="22px" viewBox="0 0 24 24" version="1.1"><g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"><polygon points="0 0 24 0 24 24 0 24"></polygon><path d="M12,18 L7.91561963,20.1472858 C7.42677504,20.4042866 6.82214789,20.2163401 6.56514708,19.7274955 C6.46280801,19.5328351 6.42749334,19.309867 6.46467018,19.0931094 L7.24471742,14.545085 L3.94038429,11.3241562 C3.54490071,10.938655 3.5368084,10.3055417 3.92230962,9.91005817 C4.07581822,9.75257453 4.27696063,9.65008735 4.49459766,9.61846284 L9.06107374,8.95491503 L11.1032639,4.81698575 C11.3476862,4.32173209 11.9473121,4.11839309 12.4425657,4.36281539 C12.6397783,4.46014562 12.7994058,4.61977315 12.8967361,4.81698575 L14.9389263,8.95491503 L19.5054023,9.61846284 C20.0519472,9.69788046 20.4306287,10.2053233 20.351211,10.7518682 C20.3195865,10.9695052 20.2170993,11.1706476 20.0596157,11.3241562 L16.7552826,14.545085 L17.5353298,19.0931094 C17.6286908,19.6374458 17.263103,20.1544017 16.7187666,20.2477627 C16.5020089,20.2849396 16.2790408,20.2496249 16.0843804,20.1472858 L12,18 Z" fill="#f6cc00" opacity=".6"></path></g></svg>`; document.getElementById('star__count__'+data[i].pid).textContent = star.count;
                            } else { document.getElementById('star__ind__'+data[i].pid).innerHTML = `<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="22px" height="22px" viewBox="0 0 24 24" version="1.1"><g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"><polygon points="0 0 24 0 24 24 0 24"></polygon><path d="M12,18 L7.91561963,20.1472858 C7.42677504,20.4042866 6.82214789,20.2163401 6.56514708,19.7274955 C6.46280801,19.5328351 6.42749334,19.309867 6.46467018,19.0931094 L7.24471742,14.545085 L3.94038429,11.3241562 C3.54490071,10.938655 3.5368084,10.3055417 3.92230962,9.91005817 C4.07581822,9.75257453 4.27696063,9.65008735 4.49459766,9.61846284 L9.06107374,8.95491503 L11.1032639,4.81698575 C11.3476862,4.32173209 11.9473121,4.11839309 12.4425657,4.36281539 C12.6397783,4.46014562 12.7994058,4.61977315 12.8967361,4.81698575 L14.9389263,8.95491503 L19.5054023,9.61846284 C20.0519472,9.69788046 20.4306287,10.2053233 20.351211,10.7518682 C20.3195865,10.9695052 20.2170993,11.1706476 20.0596157,11.3241562 L16.7552826,14.545085 L17.5353298,19.0931094 C17.6286908,19.6374458 17.263103,20.1544017 16.7187666,20.2477627 C16.5020089,20.2849396 16.2790408,20.2496249 16.0843804,20.1472858 L12,18 Z" fill="#A1A5B7" opacity=".6"></path></g></svg>`; document.getElementById('star__count__'+data[i].pid).textContent = star.count + '.0'; }
                        }
                    });
                }
            } else { document.getElementById('similar-brand').remove(); }
        }, error: function (data) { console.log(data); }
    });
</script>