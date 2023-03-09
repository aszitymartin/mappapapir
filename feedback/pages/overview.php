<?php require_once($_SERVER['DOCUMENT_ROOT'].'/includes/inc.php'); include($_SERVER['DOCUMENT_ROOT'].'/assets/alph.php'); $uid = $_SESSION['id'];
$stmt = $con->prepare('SELECT privilege FROM customers__priv  WHERE uid = ?'); if (isset($_SESSION['loggedin'])) {$id = $_SESSION['id'];} $stmt->bind_param('i', $id);$stmt->execute(); $stmt->bind_result($privilege); $stmt->fetch();$stmt->close();
function get_time_ago( $time ) {
    $time_difference = time() - $time;
    if( $time_difference < 1 ) { return '< 1mp'; }
    $condition = array( 12 * 30 * 24 * 60 * 60 =>  'éve',30 * 24 * 60 * 60 => 'hónapja',24 * 60 * 60 => 'napja',60 * 60 =>  'órája',60 =>  'perce',1 =>  'másodperce');
    foreach( $condition as $secs => $str ) {$d = $time_difference / $secs;if( $d >= 1 ) {$t = round( $d );return $t . ' ' . $str . ( $t > 1 ? '' : '' ) . '';}}
}
?>
<script src="/assets/script/chart/dist/chart.js"></script>
<script>var formatter = new Intl.NumberFormat('hu-HU', {style: 'currency',currency: 'HUF',maximumFractionDigits: 0,minimumFractionDigits: 0});</script>
<div class="flex flex-row flex-align-c flex-justify-con-sb">
    <div class="flex flex-col w-fa gap-1 border-soft item-bg box-shadow">
        <div class="flex flex-col gap-2">
            <div class="flex flex-col w-fa overflow-x-scroll hide-scroll item-bg box-shadow border-soft">
                <div class="flex flex-row flex-align-c flex-justify-con-sb w-fa gap-1 padding-05-1">
                    <div class="flex flex-row flex-align-c gap-1 text-primary">
                        <div class="flex flex-row flex-align-c flex-justify-con-c padding-05" style="margin-right: .5rem;">
                            <label class="cst-chb-lbl">
                                <input type="checkbox" class="absolute chifb" id="sel-fi-all">
                                <span class="cst-checkbox"></span>
                            </label>
                        </div>
                        <div class="flex flex-col flex-align-c flex-justify-con-c padding-025 border-soft-light background-bg background-bg-hover pointer has-tooltip relative" aria-describedby="tooltip-reload">
                            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M14.5 20.7259C14.6 21.2259 14.2 21.826 13.7 21.926C13.2 22.026 12.6 22.0259 12.1 22.0259C9.5 22.0259 6.9 21.0259 5 19.1259C1.4 15.5259 1.09998 9.72592 4.29998 5.82592L5.70001 7.22595C3.30001 10.3259 3.59999 14.8259 6.39999 17.7259C8.19999 19.5259 10.8 20.426 13.4 19.926C13.9 19.826 14.4 20.2259 14.5 20.7259ZM18.4 16.8259L19.8 18.2259C22.9 14.3259 22.7 8.52593 19 4.92593C16.7 2.62593 13.5 1.62594 10.3 2.12594C9.79998 2.22594 9.4 2.72595 9.5 3.22595C9.6 3.72595 10.1 4.12594 10.6 4.02594C13.1 3.62594 15.7 4.42595 17.6 6.22595C20.5 9.22595 20.7 13.7259 18.4 16.8259Z" fill="currentColor"/><path opacity="0.3" d="M2 3.62592H7C7.6 3.62592 8 4.02592 8 4.62592V9.62589L2 3.62592ZM16 14.4259V19.4259C16 20.0259 16.4 20.4259 17 20.4259H22L16 14.4259Z" fill="currentColor"/></svg>
                            <span class="tooltip absolute" id="tooltip-reload"><span key="tooltip-reload" key="tooltip-reload">Frissítés</span></span>
                        </div>
                        <div class="flex flex-col flex-align-c flex-justify-con-c padding-025 border-soft-light background-bg background-bg-hover pointer has-tooltip relative" aria-describedby="tooltip-archive">
                            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path opacity="0.3" d="M10 4H21C21.6 4 22 4.4 22 5V7H10V4Z" fill="currentColor"/><path d="M9.2 3H3C2.4 3 2 3.4 2 4V19C2 19.6 2.4 20 3 20H21C21.6 20 22 19.6 22 19V7C22 6.4 21.6 6 21 6H12L10.4 3.60001C10.2 3.20001 9.7 3 9.2 3Z" fill="currentColor"/></svg>
                            <span class="tooltip absolute" id="tooltip-archive"><span key="tooltip-archive" key="tooltip-archive">Archiválás</span></span>
                        </div>
                        <div class="flex flex-col flex-align-c flex-justify-con-c padding-025 border-soft-light background-bg background-bg-hover pointer has-tooltip relative" aria-describedby="tooltip-delete">
                            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M5 9C5 8.44772 5.44772 8 6 8H18C18.5523 8 19 8.44772 19 9V18C19 19.6569 17.6569 21 16 21H8C6.34315 21 5 19.6569 5 18V9Z" fill="currentColor"/><path opacity="0.5" d="M5 5C5 4.44772 5.44772 4 6 4H18C18.5523 4 19 4.44772 19 5V5C19 5.55228 18.5523 6 18 6H6C5.44772 6 5 5.55228 5 5V5Z" fill="currentColor"/><path opacity="0.5" d="M9 4C9 3.44772 9.44772 3 10 3H14C14.5523 3 15 3.44772 15 4V4H9V4Z" fill="currentColor"/></svg>
                            <span class="tooltip absolute" id="tooltip-delete"><span key="tooltip-delete" key="tooltip-delete">Törlés</span></span>
                        </div>
                    </div>
                    <div class="flex flex-row flex-align-c gap-1 text-primary">
                        <div class="flex flex-col flex-align-c flex-justify-con-c padding-025 border-soft-light background-bg background-bg-hover pointer has-tooltip relative" aria-describedby="tooltip-search">
                            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><rect opacity="0.5" x="17.0365" y="15.1223" width="8.15546" height="2" rx="1" transform="rotate(45 17.0365 15.1223)" fill="currentColor"/><path d="M11 19C6.55556 19 3 15.4444 3 11C3 6.55556 6.55556 3 11 3C15.4444 3 19 6.55556 19 11C19 15.4444 15.4444 19 11 19ZM11 5C7.53333 5 5 7.53333 5 11C5 14.4667 7.53333 17 11 17C14.4667 17 17 14.4667 17 11C17 7.53333 14.4667 5 11 5Z" fill="currentColor"/></svg>
                            <span class="tooltip absolute" id="tooltip-search"><span key="tooltip-search" key="tooltip-search">Keresés</span></span>
                        </div>
                        <div class="flex flex-col flex-align-c flex-justify-con-c padding-025 border-soft-light background-bg background-bg-hover pointer has-tooltip relative" aria-describedby="tooltip-filter">
                            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M19.0759 3H4.72777C3.95892 3 3.47768 3.83148 3.86067 4.49814L8.56967 12.6949C9.17923 13.7559 9.5 14.9582 9.5 16.1819V19.5072C9.5 20.2189 10.2223 20.7028 10.8805 20.432L13.8805 19.1977C14.2553 19.0435 14.5 18.6783 14.5 18.273V13.8372C14.5 12.8089 14.8171 11.8056 15.408 10.964L19.8943 4.57465C20.3596 3.912 19.8856 3 19.0759 3Z" fill="currentColor"/></svg>
                            <span class="tooltip absolute" id="tooltip-filter"><span key="tooltip-filter" key="tooltip-filter">Rendezés</span></span>
                        </div>
                    </div>
                </div>
                <table class="sess__history text-muted text-align-c w-fa item-bg padding-05 table-padding-05 table-fixed compare-table" style="border-collapse: collapse;" id="feedbacks-container">
                    <tr class="sessh__body">
                        <td class="padding-05">
                            <div class="flex flex-row flex-align-c flex-justify-con-c padding-05" style="margin-right: .5rem;">
                                <label class="cst-chb-lbl">
                                    <input type="checkbox" class="absolute chifb" id="sel-fi-1">
                                    <span class="cst-checkbox"></span>
                                </label>
                            </div>
                        </td>
                        <td class="padding-05">
                            <div class="flex flex-row flex-align-c gap-05 text-secondary">
                                <div class="flex flex-col flex-align-c flex-justify-con-c padding-025 border-soft-light bold" style="background-color: #1abc9c; color: #fff;">AM</div>
                                <span>Aszity Martin</span>
                            </div>
                        </td>
                        <td class="padding-05">
                            <div class="flex flex-col flex-align-fs flex-justify-con-fs gap-025">
                                <span>asdkasjdalsdjaskldjaskl jaskdaskldasdjkasjdlaskj asdjasd ja sdasj d</span>
                                <div class="flex flex-row flex-align-fs flex-justify-con-l gap-1">
                                    <span class="background-bg padding-025 border-soft-light smaller-light">Feedback Type</span>
                                    <span class="primary-bg padding-025 border-soft-light smaller-light">Closed</span>
                                </div>
                            </div>
                        </td>
                        <td class="padding-05">
                            <span>March 7</span>
                        </td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
</div>
<script>

    $(document).ready(() => {
        var feedbackData = new FormData(); 
        const feedbackObject = {
            action : 'list'
        };
        feedbackData.append('feedback', JSON.stringify(feedbackObject));
        const ajaxObject = { 
            url : '/assets/php/classes/class.Feedbacks.php',
            data : feedbackData,
            loaderContainer : { isset : false }
        }
        
        let response = getFromAjaxRequest(ajaxObject)
        .then((data) => {
            console.log(data);
        })
        .catch((reason) => {
            console.log(reason);
        });

    });


    /*
    var orderData = new FormData(); orderData.append("uid", <?= $_SESSION['id']; ?>)
    $.ajax({ enctype: "multipart/form-data", type: "POST", url: "/webshop/includes/checkout/getOrderDetails.php", data: orderData, dataType: 'json', contentType: false, processData: false,
        beforeSend : function () {
            document.getElementById('feedbacks-container').innerHTML = `
            <div class="flex flex-col flex-align-c flex-justify-con-c gap-1 small text-muted user-select-none w-fa">
                <span><svg class='wizard_input_loading' xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="128" height="128" viewBox="0 0 24 24" version="1.1"><g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"><g><polygon points="0 0 24 0 24 24 0 24"/></g><path d="M12,4 L12,6 C8.6862915,6 6,8.6862915 6,12 C6,15.3137085 8.6862915,18 12,18 C15.3137085,18 18,15.3137085 18,12 C18,10.9603196 17.7360885,9.96126435 17.2402578,9.07513926 L18.9856052,8.09853149 C19.6473536,9.28117708 20,10.6161442 20,12 C20,16.418278 16.418278,20 12,20 C7.581722,20 4,16.418278 4,12 C4,7.581722 7.581722,4 12,4 Z" class="svg" fill-rule="nonzero" opacity="0.4" transform="translate(12.000000, 12.000000) scale(-1, 1) translate(-12.000000, -12.000000) "/></g></svg></span>
                <span>Rendelések megjelenítése</span>
            </div>
            `;
        }, success : function (s) { document.getElementById('feedbacks-container').innerHTML = ``;
            if (s.status == 'success') { let dels = 0
                for (let i = 0; i < s.data.length; i++) {
                    document.getElementById('feedbacks-container').innerHTML += `
                    <div class="flex flex-col flex-align-c w-fa gap-05 border-soft-light border-muted padding-05">
                        <div class="flex flex-row w-fa gap-05">
                            <div class="bsc__img flex flex-col flex-align-c flex-justify-con-c gap-05">
                                <div id="order-preview-con-${s.data[i].oid}">
                                    <div class="flex flex-col flex-align-c flex-justify-con-c gap-1 small text-muted user-select-none w-fa">
                                        <span><svg class='wizard_input_loading' xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="64" height="64" viewBox="0 0 24 24" version="1.1"><g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"><g><polygon points="0 0 24 0 24 24 0 24"/></g><path d="M12,4 L12,6 C8.6862915,6 6,8.6862915 6,12 C6,15.3137085 8.6862915,18 12,18 C15.3137085,18 18,15.3137085 18,12 C18,10.9603196 17.7360885,9.96126435 17.2402578,9.07513926 L18.9856052,8.09853149 C19.6473536,9.28117708 20,10.6161442 20,12 C20,16.418278 16.418278,20 12,20 C7.581722,20 4,16.418278 4,12 C4,7.581722 7.581722,4 12,4 Z" class="svg" fill-rule="nonzero" opacity="0.4" transform="translate(12.000000, 12.000000) scale(-1, 1) translate(-12.000000, -12.000000) "/></g></svg></span>
                                    </div>
                                </div>
                            </div>
                            <div class="flex flex-col gap-05">
                                <div class="flex flex-col">
                                    <a class="text-primary small pointer link bold" href="/orders/v/${s.data[i].oid}" target="_blank">(#${s.data[i].oid}) <span id="order-items-name-${s.data[i].oid}"></span></a>
                                    <span class="text-muted small-med">${s.data[i].odate}</span>
                                </div>
                            </div>
                        </div>
                        <div class="flex flex-row flex-align-c flex-justify-con-sb w-fa gap-05 padding-025">
                            <span class="text-primary bold" id="order-subtotal-${s.data[i].oid}"></span>
                            <div id="order-status-${s.data[i].oid}"></div>
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
                        case '2': dels++;
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
                    document.getElementById('order-items-name-' + s.data[i].oid).textContent = (s.data[i].item[0].name.length > 80 ? s.data[i].item[0].name.substring(1, 80) + '...' : s.data[i].item[0].name);
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
                } document.getElementById('delivered-sum').textContent = dels;
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
    */
</script>