<?php require_once($_SERVER['DOCUMENT_ROOT'].'/includes/inc.php'); ?>
<div class="sidenav-theme">
    <div class="sidenav-header flex flec-row flex-align-c flex-justify-con-sb">
        <span class="flex flex-col">
            <span class="header_title_heading">Rendeléseim</span>
        </span>
        <span class="flex">
            <span class="text-primary pointer" onclick="closeSidenavAddons('all')">
                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"><rect x="0" y="0" width="24" height="24"/><circle class="svg" opacity="0.3" cx="12" cy="12" r="10"/><path d="M12.0355339,10.6213203 L14.863961,7.79289322 C15.2544853,7.40236893 15.8876503,7.40236893 16.2781746,7.79289322 C16.6686989,8.18341751 16.6686989,8.81658249 16.2781746,9.20710678 L13.4497475,12.0355339 L16.2781746,14.863961 C16.6686989,15.2544853 16.6686989,15.8876503 16.2781746,16.2781746 C15.8876503,16.6686989 15.2544853,16.6686989 14.863961,16.2781746 L12.0355339,13.4497475 L9.20710678,16.2781746 C8.81658249,16.6686989 8.18341751,16.6686989 7.79289322,16.2781746 C7.40236893,15.8876503 7.40236893,15.2544853 7.79289322,14.863961 L10.6213203,12.0355339 L7.79289322,9.20710678 C7.40236893,8.81658249 7.40236893,8.18341751 7.79289322,7.79289322 C8.18341751,7.40236893 8.81658249,7.40236893 9.20710678,7.79289322 L12.0355339,10.6213203 Z" class="svg" /></g>
                </svg>
            </span>
        </span>
    </div>
    <div class="theme-body flex flex-row flex-align-c flex-justify-con-c flex-wrap gap-1" id="orders-container"></div>
</div>
<script>
    var orderData = new FormData(); orderData.append("uid", <?= $_SESSION['id']; ?>)
    $.ajax({ enctype: "multipart/form-data", type: "POST", url: "/webshop/includes/checkout/getOrderDetails.php", data: orderData, dataType: 'json', contentType: false, processData: false,
        beforeSend : function () {
            document.getElementById('orders-container').innerHTML = `
            <div class="flex flex-col flex-align-c flex-justify-con-c gap-1 small text-muted user-select-none w-fa">
                <span><svg class='wizard_input_loading' xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="128" height="128" viewBox="0 0 24 24" version="1.1"><g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"><g><polygon points="0 0 24 0 24 24 0 24"/></g><path d="M12,4 L12,6 C8.6862915,6 6,8.6862915 6,12 C6,15.3137085 8.6862915,18 12,18 C15.3137085,18 18,15.3137085 18,12 C18,10.9603196 17.7360885,9.96126435 17.2402578,9.07513926 L18.9856052,8.09853149 C19.6473536,9.28117708 20,10.6161442 20,12 C20,16.418278 16.418278,20 12,20 C7.581722,20 4,16.418278 4,12 C4,7.581722 7.581722,4 12,4 Z" class="svg" fill-rule="nonzero" opacity="0.4" transform="translate(12.000000, 12.000000) scale(-1, 1) translate(-12.000000, -12.000000) "/></g></svg></span>
                <span>Rendelések megjelenítése</span>
            </div>
            `;
        }, success : function (s) { document.getElementById('orders-container').innerHTML = ``;
            if (s.status == 'success') {
                for (let i = 0; i < s.data.length; i++) {
                    document.getElementById('orders-container').innerHTML += `
                        <div class="flex flex-row w-fa gap-05">
                            <div class="bsc__img flex flex-col flex-align-c flex-justify-con-c gap-05">
                                <div id="order-preview-con-${s.data[i].oid}">
                                    <div class="flex flex-col flex-align-c flex-justify-con-c gap-1 small text-muted user-select-none w-fa">
                                        <span><svg class='wizard_input_loading' xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="64" height="64" viewBox="0 0 24 24" version="1.1"><g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"><g><polygon points="0 0 24 0 24 24 0 24"/></g><path d="M12,4 L12,6 C8.6862915,6 6,8.6862915 6,12 C6,15.3137085 8.6862915,18 12,18 C15.3137085,18 18,15.3137085 18,12 C18,10.9603196 17.7360885,9.96126435 17.2402578,9.07513926 L18.9856052,8.09853149 C19.6473536,9.28117708 20,10.6161442 20,12 C20,16.418278 16.418278,20 12,20 C7.581722,20 4,16.418278 4,12 C4,7.581722 7.581722,4 12,4 Z" class="svg" fill-rule="nonzero" opacity="0.4" transform="translate(12.000000, 12.000000) scale(-1, 1) translate(-12.000000, -12.000000) "/></g></svg></span>
                                    </div>
                                </div>
                                <div id="order-status-${s.data[i].oid}"></div>
                            </div>
                            <div class="flex flex-col gap-05">
                                <div class="flex flex-col">
                                    <a class="text-primary small pointer link bold" href="/orders/v/${s.data[i].oid}" target="_blank">(#${s.data[i].oid}) Titan Guide sorozatú hűtő hátizsák</a>
                                    <span class="text-muted small-med">${s.data[i].odate}</span>
                                </div>
                                <span class="flex flex-row gap-05 text-primary bold">
                                    <span id="order-subtotal-${s.data[i].oid}"></span>
                                </span>
                            </div>
                        </div>
                    `;
                    document.getElementById('order-subtotal-'+s.data[i].oid).textContent = formatter.format(s.data[i].subTotal);
                    switch (s.data[i].status) {
                        case '0':
                            document.getElementById('order-status-'+s.data[i].oid).innerHTML = `
                                <span class="label label-warning border-soft-light padding-025 smaller-light">Összekészítés</span>
                            `;
                        break;
                        case '1':
                            document.getElementById('order-status-'+s.data[i].oid).innerHTML = `
                                <span class="label label-primary border-soft-light padding-025 smaller-light">Kiszállítás</span>
                            `;
                        break;
                        case '2':
                            document.getElementById('order-status-'+s.data[i].oid).innerHTML = `
                                <span class="label label-success border-soft-light padding-025 smaller-light">Kiszállítva</span>
                            `;
                        break;
                        case '4':
                            document.getElementById('order-status-'+s.data[i].oid).innerHTML = `
                                <span class="label label-danger border-soft-light padding-025 smaller-light">Sikertelen</span>
                            `;
                        break;
                        default:
                            document.getElementById('order-status-'+s.data[i].oid).innerHTML = `
                                <span class="label label-warning border-soft-light padding-025 smaller-light">Összekészítés</span>
                            `;
                        break;
                    }
                    switch (s.data[i].item.length) {
                        case 1:
                            document.getElementById('order-preview-con-'+s.data[i].oid).innerHTML = `
                            <div class="flex flex-row flex-align-c flex-justify-con-c text-align-c flex-wrap gap-025 w-fa" style="width: 7rem;">
                                <img class="bs__img drop-shadow" src="/assets/images/uploads/${s.data[i].item[0].thumbnail}" alt="${s.data[i].item[0].name}" style="height: 4rem; object-fit: contain;">
                            </div>
                            `;
                        break;
                        case 2:
                            document.getElementById('order-preview-con-'+s.data[i].oid).innerHTML = `
                            <div class="flex flex-row flex-align-c flex-justify-con-c text-align-c flex-wrap-no gap-025 w-fa" style="width: 7rem;" id="order-preview-inner-con-${s.data[i].oid}">
                                <img class="bs__img drop-shadow" src="/assets/images/uploads/${s.data[i].item[0].thumbnail}" alt="${s.data[i].item[0].name}" style="height: 4rem; object-fit: contain;">
                                <img class="bs__img drop-shadow" src="/assets/images/uploads/${s.data[i].item[1].thumbnail}" alt="${s.data[i].item[1].name}" style="height: 4rem; object-fit: contain; margin-left: -10px; margin-top: 5px;">
                            </div>
                            `;
                        break;
                        case 3:
                            document.getElementById('order-preview-con-'+s.data[i].oid).innerHTML = `
                            <div class="flex flex-row flex-align-c flex-justify-con-c text-align-c flex-wrap-no gap-025 w-fa" style="width: 7rem;" id="order-preview-inner-con-${s.data[i].oid}">
                                <img class="bs__img drop-shadow" src="/assets/images/uploads/${s.data[i].item[0].thumbnail}" alt="${s.data[i].item[0].name}" style="width: 2rem; object-fit: contain;">
                                <img class="bs__img drop-shadow" src="/assets/images/uploads/${s.data[i].item[1].thumbnail}" alt="${s.data[i].item[1].name}" style="width: 2rem; object-fit: contain; margin-left: -10px; margin-top: 5px;">
                                <img class="bs__img drop-shadow" src="/assets/images/uploads/${s.data[i].item[2].thumbnail}" alt="${s.data[i].item[2].name}" style="width: 2rem; object-fit: contain; margin-left: -10px; margin-top: 15px;">
                            </div>
                            `;
                        break;
                        case 4:
                            document.getElementById('order-preview-con-'+s.data[i].oid).innerHTML = `
                            <div class="flex flex-row flex-align-c flex-justify-con-c text-align-c flex-wrap gap-025 w-fa" style="width: 7rem;">
                                <img class="bs__img drop-shadow" src="/assets/images/uploads/${s.data[i].item[0].thumbnail}" alt="${s.data[i].item[0].name}" style="height: 2.5rem; width: 2.5rem; object-fit: contain;">
                                <img class="bs__img drop-shadow" src="/assets/images/uploads/${s.data[i].item[1].thumbnail}" alt="${s.data[i].item[1].name}" style="height: 2.5rem; width: 2.5rem; object-fit: contain;">
                                <img class="bs__img drop-shadow" src="/assets/images/uploads/${s.data[i].item[2].thumbnail}" alt="${s.data[i].item[2].name}" style="height: 2.5rem; width: 2.5rem; object-fit: contain;">
                                <img class="bs__img drop-shadow" src="/assets/images/uploads/${s.data[i].item[3].thumbnail}" alt="${s.data[i].item[3].name}" style="height: 2.5rem; width: 2.5rem; object-fit: contain;">
                            </div>
                            `;
                        break;
                        default:
                            document.getElementById('order-preview-con-'+s.data[i].oid).innerHTML = `
                            <div class="flex flex-row flex-align-c flex-justify-con-c text-align-c flex-wrap gap-025 w-fa" style="width: 7rem;">
                                <img class="bs__img drop-shadow" src="/assets/images/uploads/${s.data[i].item[0].thumbnail}" alt="${s.data[i].item[0].name}" style="height: 2.5rem; width: 2.5rem; object-fit: contain;">
                                <img class="bs__img drop-shadow" src="/assets/images/uploads/${s.data[i].item[1].thumbnail}" alt="${s.data[i].item[1].name}" style="height: 2.5rem; width: 2.5rem; object-fit: contain;">
                                <img class="bs__img drop-shadow" src="/assets/images/uploads/${s.data[i].item[2].thumbnail}" alt="${s.data[i].item[2].name}" style="height: 2.5rem; width: 2.5rem; object-fit: contain;">
                                <span class="flex flex-col flex-align-c flex-justify-con-c small border-soft large text-muted background-bg bold pointer" title="${(s.data[i].item.length) - 3} További termék" style="height: 2.5rem; width: 2rem;">+${(s.data[i].item.length) - 3}</span>
                            </div>
                            `;
                        break;
                    }
                }
            } else {
                document.getElementById('orders-container').innerHTML = `
                <div class="flex flex-col flex-align-c flex-justify-con-c gap-1 small text-muted user-select-none w-fa">
                    <svg width="128" height="128" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><rect opacity="0.3" x="2" y="2" width="20" height="20" rx="10" fill="currentColor"/><rect x="11" y="14" width="7" height="2" rx="1" transform="rotate(-90 11 14)" fill="currentColor"/><rect x="11" y="17" width="2" height="2" rx="1" transform="rotate(-90 11 17)" fill="currentColor"/></svg>
                    <span>Hiba történt a rendelések betöltése közben.</span>
                </div>
                `;
            }
        }, error : function (e) {
            document.getElementById('orders-container').innerHTML = `
            <div class="flex flex-col flex-align-c flex-justify-con-c gap-1 small text-muted user-select-none w-fa">
                <svg width="128" height="128" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><rect opacity="0.3" x="2" y="2" width="20" height="20" rx="10" fill="currentColor"/><rect x="11" y="14" width="7" height="2" rx="1" transform="rotate(-90 11 14)" fill="currentColor"/><rect x="11" y="17" width="2" height="2" rx="1" transform="rotate(-90 11 17)" fill="currentColor"/></svg>
                <span>Hiba történt a rendelések betöltése közben.</span>
            </div>
            `;
        }
    });
</script>