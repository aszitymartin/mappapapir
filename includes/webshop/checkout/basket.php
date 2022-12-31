<?php require_once($_SERVER['DOCUMENT_ROOT'].'/assets/alph.php'); require_once($_SERVER['DOCUMENT_ROOT'].'/includes/inc.php');
// ini_set('display_errors', 1); ini_set('display_startup_errors', 1); error_reporting(E_ALL);
if (isset($_SESSION['loggedin'])) {
    if (!isset($_GET['id'])) { $sumQuantity = 0; $sumBasePrice = 0; $sumPriceByProduct = 0; $sumDeductions = 0; $subTotal = 1000;
        $sql = "SELECT pid FROM cart WHERE uid = " . $_SESSION['id'];
        $res = $con->query($sql);
        echo '<script>var dynamicItemsObject = {};</script>';
        echo '<div id="checkout-basket-prio-con-out" class="relative"><div id="checkout-basket-prio-con" class="flex flex-col prio__con gap-025 relative" style="max-height: 290px !important;">';
        while ($dt = $res->fetch_assoc()) {
            $stmt = $con->prepare('SELECT products.id, name, thumbnail, base, discount, color, style, brand, model, cart.quantity, unit FROM products INNER JOIN products__pricing ON products__pricing.pid = products.id INNER JOIN products__variations ON products__variations.pid = products.id INNER JOIN cart ON cart.pid = products.id INNER JOIN products__inventory ON products__inventory.pid = products.id WHERE products.id = ?');
            $stmt->bind_param('i', $dt['pid']);$stmt->execute(); $stmt -> store_result();
            $stmt->bind_result($pid, $name, $thumbnail, $base, $discount, $color, $style, $brand, $model, $quantity, $unit); $stmt->fetch();
            if ($stmt->num_rows > 0) { $sumQuantity += $quantity; $sumBasePrice += $base; $sumPriceByProduct += ($base - (($base * $discount) / 100)) * $quantity; $sumDeductions += (($base * $discount) / 100);
                echo '
                    <script>
                    dynamicItemsObject["item_'.$pid.'"] = {
                        general : {
                            id : '.$pid.',
                            quantity : '.$quantity.'
                        }
                    };
                    </script>
                    <div class="flex flex-row-d-col-m gap-1 text-align-c-m">
                        <div class="flex flex-col flex-align-c flex-justify-con-c gap-1">
                            <img src="/assets/images/uploads/'.$thumbnail.'" class="drop-shadow" style="width: 5rem; height: 5rem; object-fit: contain;" />
                            <div class="flex flex-row flex-align-c gap-1 user-select-none">
                                <!--
                                    <span onclick="remMultiple('.$pid.')" title="Csökkentés" aria-label="Csökkentés" class="splash flex flex-col flex-align-c padding-025 text-muted primary-bg primary-bg-hover border-soft pointer" id="load-card">
                                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><rect x="6" y="11" width="12" height="2" rx="1" fill="currentColor"/></svg>
                                    </span>
                                -->
                                <span class="text-secondary">'.$quantity.' '.$unit.'</span>
                                <!--
                                    <span onclick="addMultiple('.$pid.')" title="Növelés" aria-label="Növelés" class="splash flex flex-col flex-align-c padding-025 text-muted primary-bg primary-bg-hover border-soft pointer" id="load-card">
                                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><rect opacity="1" x="11" y="18" width="12" height="2" rx="1" transform="rotate(-90 11 18)" fill="currentColor"/><rect x="6" y="11" width="12" height="2" rx="1" fill="currentColor"/></svg>
                                    </span>
                                -->
                            </div>
                        </div>
                        <div class="flex flex-col w-fa gap-1 text-primary">
                            <div class="flex flex-col gap-025">
                                <a class="bold link pointer user-select-none" href="/product/'.$pid.'/'; echo str_replace(',', '', str_replace(' ', '-',strtolower(strtr($brand, $unwanted_array)))).'-'.str_replace(',', '', str_replace(' ', '-',strtolower(strtr($name, $unwanted_array)))).'-'.str_replace(',', '', str_replace(' ', '-', strtolower(strtr($color, $unwanted_array)))); echo '" target="_blank">'.$name.'</a>
                                <div class="flex flex-row flex-align-c w-fa gap-1">
                                    ';
                                        if ($discount > 0) {
                                            echo '
                                                <div class="flex flex-row flex-align-c gap-05">
                                                    <span class="text-secondary fbe" data-value="'. $base - (($base * $discount) / 100) .'"></span>
                                                    <span class="flex flex-row flex-align-c flex-justify-con-c danger-bg border-soft-light padding-025 bold user-select-none smaller">-'.$discount.'%</span>
                                                </div>
                                                <span class="text-secondary fbe linethrough small-med" data-value="'.$base.'"></span>
                                            ';
                                        } else {
                                            echo '<span class="text-secondary fbe" data-value="'.$base.'"></span>';
                                        }
                                    echo '
                                </div>
                            </div>
                            <div class="flex flex-row flex-align-c flex-justify-con-sb w-fa">
                                <div class="flex flex-col gap-025 small">
                                    <div class="flex flex-row gap-05 flex-align-c w-fa">
                                        <span class="bold">Márka:</span>
                                        <span class="text-secondary">'.$brand.'</span>
                                    </div>
                                    <div class="flex flex-row gap-05 flex-align-c w-fa">
                                        <span class="bold">Szín:</span>
                                        <span class="text-secondary">'.$color.'</span>
                                    </div>
                                </div>
                                <div class="flex flex-col gap-025 small">
                                    <div class="flex flex-row gap-05 flex-align-c w-fa">
                                        <span class="bold">Stílus:</span>
                                        <span class="text-secondary">'.$style.'</span>
                                    </div>
                                    <div class="flex flex-row gap-05 flex-align-c w-fa">
                                        <span class="bold">Modell:</span>
                                        <span class="text-secondary">'.$model.'</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div><hr style="border: 1px solid var(--background);" class="w-100">
                ';
            } else { echo 'nincs ilyen termek'; }
            $stmt->close();
        }
        echo '</div></div>';
        $subTotal += $sumPriceByProduct;
        if ($sumPriceByProduct < 30000) { $subTotal += 2000; }
        echo '
        <div class="flex flex-col flex-align-fe flex-justify-con-fe text-muted padding-05 gap-1">
            <div class="flex flex-col gap-025 small">
                <div class="flex flex-row gap-05 flex-align-fe flex-justify-con-fe w-fa">
                    <span class="bold">Mennyiség:</span>
                    <span class="text-secondary" id="ch-mt-qt">'.$sumQuantity.' darab</span>
                </div>
                <div class="flex flex-row gap-05 flex-align-fe flex-justify-con-fe w-fa">
                    <span class="bold">Alapár:</span>
                    <span class="text-secondary fbe" data-value="'.$sumPriceByProduct.'" id="ch-mt-bs-st">0 Ft</span>
                </div>
            </div>
            <div class="flex flex-col gap-025 small">
                <div class="flex flex-row gap-05 flex-align-fe flex-justify-con-fe w-fa">
                    <span class="bold">Szállítási díj:</span>
                    <span class="text-secondary" id="ch-mt-sh-fe">2 000 Ft</span>
                </div>
                <div class="flex flex-row gap-05 flex-align-fe flex-justify-con-fe w-fa">
                    <span class="bold">Kezelési költség:</span>
                    <span class="text-secondary">1 000 Ft</span>
                </div>
            </div>
            <div class="flex flex-col gap-025 small">
                <div class="flex flex-row gap-05 flex-align-fe flex-justify-con-fe w-fa">
                    <span class="bold">Levonások:</span>
                    <span class="text-secondary fbe" data-value="'.$sumDeductions.'" id="ch-mt-su">0 Ft</span>
                </div>
                <div class="flex flex-row gap-05 flex-align-fe flex-justify-con-fe w-fa">
                    <span class="bold">Fizetendő:</span>
                    <span class="text-secondary fbe" data-value="'.$subTotal.'" id="ch-mt-st">0 Ft</span>
                </div>
            </div>
            <div class="flex flex-col gap-1 w-fa" id="st-dc-cn">
                <div class="flex flex-col gap-05" id="st-dc-in-cn"></div>
            </div>
        </div>
        <script>
        var btn = document.querySelectorAll(".splash");
        for (let i = 0; i < btn.length; i++) { btn[i].addEventListener("click", createRipple); }
        function createRipple(e) { let btn = e.target; if (btn?.tagName == "svg") { btn = btn.parentNode; } if (btn?.tagName == "rect") { btn = btn.parentNode.parentNode; }
            let boundingBox = btn.getBoundingClientRect(); let x = e.clientX - boundingBox.left; let y = e.clientY - boundingBox.top; let ripple = document.createElement("span"); ripple.classList.add("ripple");
            ripple.style.left = `${x}px`; ripple.style.top = `${y}px`; btn.appendChild(ripple); ripple.addEventListener("animationend", () => { ripple.remove() });
        }
        </script>
        ';
    } else { echo '<script>window.location.href = "/404"</script>'; }
} else { echo '<script>window.location.href = "/"</script>'; }
?>
<script>
    let fbe = document.getElementsByClassName('fbe');
    for (let i = 0; i < fbe.length; i++) {
        fbe[i].innerHTML = formatter.format(fbe[i].getAttribute('data-value'));
    }
    // function remMultiple (p) {
    //     console.log('-- ' + p);
    // } function addMultiple (p) {
    //     console.log('++ ' + p);
    // }

    var ship = document.getElementsByName('ship'); let sfa = false; var shpMethod = 'gls';
    for(let i = 0; i < ship.length; i++) {
        ship[i].addEventListener('click', () => { shpMethod = ship[i].value;
            document.getElementById('shp_method').textContent = ship[i].value.toUpperCase();
            if (<?= $sumPriceByProduct ?> < 30000) {
                if (sfa = false) { csubt += Number(ship[i].getAttribute('ship-price')); } sfa = true;
            } else { document.getElementById('ch-mt-su').textContent = formatter.format(<?= $sumDeductions; ?> + 2000); }
            document.getElementById('ch-mt-sh-fe').textContent = formatter.format(ship[i].getAttribute('ship-price'));
            document.getElementById('pd-st-cn').textContent = formatter.format(csubt);
        });
    }
    if (<?= $sumPriceByProduct ?> < 30000) {

    } else { document.getElementById('ch-mt-sh-fe').classList.add('linethrough'); document.getElementById('ch-mt-su').textContent = formatter.format(<?= $sumDeductions; ?> + 2000);
        document.getElementById('st-dc-in-cn').innerHTML += `
            <div class="flex flex-row w-fa small-med border-secondary border-soft-light overflow-hidden" id="pd-dc-it-sh">
                <span class="flex flex-row flex-align-c text-align-c padding-05 background-bg text-primary w-20">Szállítási díj</span>
                <span class="flex flex-row flex-align-c padding-05 text-secondary w-80">30 000 Ft után átvállaljuk a szállítás díját.</span>
            </div>
        `;
    }

    var itemDataVoucer_VoucherUsed = false; var itemDataVoucer_VoucherCode; var itemDataVoucer_VoucherPercentage;
    function validateVoucher () { var vData = new FormData(); vData.append('checkout', 'basket'); vData.append("code", document.getElementById('voucher-input').value);
        $.ajax({ enctype: "multipart/form-data", type: "POST", url: "/includes/webshop/checkout/assets/vouchers/get.php", data: vData, dataType: 'json', contentType: false, processData: false,
            beforeSend: function () { document.getElementById('av-ac-ic-cn').innerHTML = `Beváltás <svg class='wizard_input_loading' xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24" height="24" viewBox="0 0 24 24" version="1.1"><g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"><g><polygon points="0 0 24 0 24 24 0 24"/></g><path d="M12,4 L12,6 C8.6862915,6 6,8.6862915 6,12 C6,15.3137085 8.6862915,18 12,18 C15.3137085,18 18,15.3137085 18,12 C18,10.9603196 17.7360885,9.96126435 17.2402578,9.07513926 L18.9856052,8.09853149 C19.6473536,9.28117708 20,10.6161442 20,12 C20,16.418278 16.418278,20 12,20 C7.581722,20 4,16.418278 4,12 C4,7.581722 7.581722,4 12,4 Z" fill="currentColor" fill-rule="nonzero" transform="translate(12.000000, 12.000000) scale(-1, 1) translate(-12.000000, -12.000000) "/></g></svg>`; },
            success: function(data) { svc = true; itemDataVoucer_VoucherUsed = true; itemDataVoucer_VoucherCode = data.code; itemDataVoucer_VoucherPercentage = data.value;

                if (document.getElementById('voucher-input').value == data.code) { document.getElementById('av-ac-ic-cn').innerHTML = `Beváltva`;
                    document.getElementById('vd-vc-ac-cn').removeAttribute('onclick'); document.getElementById('vd-vc-ac-cn').classList.remove('primary-bg-hover');
                    document.getElementById('vd-vc-ac-cn').classList.remove('splash'); document.getElementById('vd-vc-ac-cn').classList.replace('pointer', 'not-allowed');

                    document.getElementById('vc-rm-cn').innerHTML = `<span class="text-primary small-med pointer user-select-none link" onclick="removeVoucher()">Kupon eltávolítása</span>`;
                    document.getElementById('st-dc-in-cn').innerHTML += `
                    <div class="flex flex-row w-fa small-med border-secondary border-soft-light overflow-hidden relative" id="st-dc-vc-cn">
                        <span class="flex flex-row flex-align-c text-align-c padding-05 background-bg text-primary w-20">Kuponkód</span>
                        <div class="flex flex-row flex-align-c flex-justify-con-sa gap-1 w-fa">
                            <span class="flex flex-row flex-align-c padding-05 text-secondary w-80">${data.description}</span>
                            <span class="background-bg background-bg-hover text-primary pointer user-select-none box-shadow" onclick="removeVoucher()" title="Kupon eltávolítása">
                                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><rect opacity="0.3" x="2" y="2" width="20" height="20" rx="5" fill="currentColor"/><rect x="7" y="15.3137" width="12" height="2" rx="1" transform="rotate(-45 7 15.3137)" fill="currentColor"/><rect x="8.41422" y="7" width="12" height="2" rx="1" transform="rotate(45 8.41422 7)" fill="currentColor"/></svg>
                            </span>
                        </div>
                    </div>
                    `; document.getElementById('vc-ec-cn').innerHTML = `<span class="flex flex-align-c flex-row gap-05 w-fa text-success small-med"><svg width="16" height="16" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><rect opacity="0.3" x="2" y="2" width="20" height="20" rx="10" fill="currentColor"/><path d="M10.4343 12.4343L8.75 10.75C8.33579 10.3358 7.66421 10.3358 7.25 10.75C6.83579 11.1642 6.83579 11.8358 7.25 12.25L10.2929 15.2929C10.6834 15.6834 11.3166 15.6834 11.7071 15.2929L17.25 9.75C17.6642 9.33579 17.6642 8.66421 17.25 8.25C16.8358 7.83579 16.1642 7.83579 15.75 8.25L11.5657 12.4343C11.2533 12.7467 10.7467 12.7467 10.4343 12.4343Z" fill="currentColor"/></svg><span>Kuponkód sikeresen hozzáadva.</span></span>`;
                    document.getElementById('ch-mt-st').textContent = formatter.format(<?= $sumPriceByProduct; ?> - ((<?= $sumPriceByProduct; ?> * data.value) / 100));
                } else { document.getElementById('av-ac-ic-cn').innerHTML = `Beváltás`; document.getElementById('vc-ec-cn').innerHTML = `<span class="flex flex-align-c flex-row gap-05 w-fa text-danger small-med"><svg width="16" height="16" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><rect opacity="0.3" x="2" y="2" width="20" height="20" rx="10" fill="currentColor"/><rect x="11" y="14" width="7" height="2" rx="1" transform="rotate(-90 11 14)" fill="currentColor"/><rect x="11" y="17" width="2" height="2" rx="1" transform="rotate(-90 11 17)" fill="currentColor"/></svg><span>Érvénytelen kuponkódot adott meg.</span></span>`; }
            }, error: function (data) { document.getElementById('av-ac-ic-cn').innerHTML = `Beváltás`; document.getElementById('vc-ec-cn').innerHTML = `<span class="flex flex-align-c flex-row gap-05 w-fa text-danger small-med"><svg width="16" height="16" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><rect opacity="0.3" x="2" y="2" width="20" height="20" rx="10" fill="currentColor"/><rect x="11" y="14" width="7" height="2" rx="1" transform="rotate(-90 11 14)" fill="currentColor"/><rect x="11" y="17" width="2" height="2" rx="1" transform="rotate(-90 11 17)" fill="currentColor"/></svg><span>${data.responseText}</span></span>`; }
        });
    } function removeVoucher () { svc = false; itemDataVoucer_VoucherUsed = false;
        document.getElementById('ch-mt-st').textContent = formatter.format(<?= $subTotal; ?>);
        document.getElementById('st-dc-vc-cn')?.remove(); document.getElementById('voucher-input').value = ''; document.getElementById('vc-rm-cn').innerHTML = ``; document.getElementById('vc-ec-cn').innerHTML = ``;
        document.getElementById('vd-vc-ac-cn').setAttribute('onclick', 'validateVoucher()'); document.getElementById('vd-vc-ac-cn').classList.add('primary-bg-hover');
        document.getElementById('vd-vc-ac-cn').classList.add('splash'); document.getElementById('vd-vc-ac-cn').classList.replace('not-allowed', 'pointer');
    }

    if (document.getElementById('checkout-basket-prio-con')) {
        if ($('#checkout-basket-prio-con').css('overflow-y') == 'scroll' || $('#checkout-basket-prio-con').css('overflow-y') == 'auto') {
            document.getElementById('checkout-basket-prio-con-out').innerHTML += `
                <span id="basket-item-scroll-indicator" class="flex flex-col flex-align-c flex-justify-con-c absolute box-shadow-sh circle primary-dark-bg user-select-none padding-025 center-x" style="bottom: -6%;">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M11.4343 12.7344L7.25 8.55005C6.83579 8.13583 6.16421 8.13584 5.75 8.55005C5.33579 8.96426 5.33579 9.63583 5.75 10.05L11.2929 15.5929C11.6834 15.9835 12.3166 15.9835 12.7071 15.5929L18.25 10.05C18.6642 9.63584 18.6642 8.96426 18.25 8.55005C17.8358 8.13584 17.1642 8.13584 16.75 8.55005L12.5657 12.7344C12.2533 13.0468 11.7467 13.0468 11.4343 12.7344Z" fill="currentColor"/></svg>
                </span>
            `;
        }
    }
    // $('#checkout-basket-prio-con').on("scroll", function() {
    //     var scrollHeight = $('#checkout-basket-prio-con').height();
    //     var scrollPosition = $('#checkout-basket-prio-con').height() + $('#checkout-basket-prio-con').scrollTop();
    //     if ((scrollHeight - scrollPosition) / scrollHeight === 0) {
    //         $("#basket-item-scroll-indicator").delay(1000).show(0);
    //     }
    //     console.log((scrollPosition - scrollHeight) / scrollPosition);
    // });


    document.getElementById('checkout-basket-prio-con').addEventListener('scroll', event => {
        const {scrollHeight, scrollTop, clientHeight} = event.target;

        if (Math.abs(scrollHeight - clientHeight - scrollTop) < 1) {
            document.getElementById("basket-item-scroll-indicator").style.opacity = 0;
        } else { document.getElementById("basket-item-scroll-indicator").style.opacity = 1; }
    });
</script>