<?php require_once($_SERVER['DOCUMENT_ROOT'].'/assets/alph.php'); require_once($_SERVER['DOCUMENT_ROOT'].'/includes/inc.php');

if (isset($_SESSION['loggedin'])) {
    if (isset($_GET['id'])) {
        if (is_numeric($_GET['id'])) {
            $stmt = $con->prepare('SELECT products.id, name, thumbnail, base, discount, color, style, brand, model, unit FROM products INNER JOIN products__inventory ON products__inventory.pid = products.id INNER JOIN products__pricing ON products__pricing.pid = products.id INNER JOIN products__variations ON products__variations.pid = products.id WHERE products.id = ?');
            $stmt->bind_param('i', $_GET['id']);$stmt->execute(); $stmt -> store_result();
            $stmt->bind_result($pid, $name, $thumbnail, $base, $discount, $color, $style, $brand, $model, $unit); $stmt->fetch();
            if ($stmt->num_rows > 0) {
                echo '
                    <div class="flex flex-row-d-col-m gap-1 text-align-c-m">
                        <div class="flex flex-col flex-align-c flex-justify-con-c gap-1">
                            <img src="/assets/images/uploads/'.$thumbnail.'" class="drop-shadow" style="width: 10rem; height: 10rem; object-fit: contain;" />
                            <div class="flex flex-row flex-align-c gap-1 user-select-none">
                                <span onclick="remSingle()" title="Csökkentés" aria-label="Csökkentés" class="splash flex flex-col flex-align-c padding-025 text-muted primary-bg primary-bg-hover border-soft pointer" id="load-card">
                                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><rect x="6" y="11" width="12" height="2" rx="1" fill="currentColor"/></svg>
                                </span>
                                <span class="text-secondary" id="sq-in">1</span>
                                <span onclick="addSingle()" title="Növelés" aria-label="Növelés" class="splash flex flex-col flex-align-c padding-025 text-muted primary-bg primary-bg-hover border-soft pointer" id="load-card">
                                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><rect opacity="1" x="11" y="18" width="12" height="2" rx="1" transform="rotate(-90 11 18)" fill="currentColor"/><rect x="6" y="11" width="12" height="2" rx="1" fill="currentColor"/></svg>
                                </span>
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
                    </div><hr style="border: 1px solid var(--background); width: 100%;">
                    <div class="flex flex-col flex-align-fe flex-justify-con-fe text-muted padding-05 gap-1">
                        <div class="flex flex-col gap-025 small">
                            <div class="flex flex-row gap-05 flex-align-fe flex-justify-con-fe w-fa">
                                <span class="bold">Mennyiség:</span>
                                <span class="text-secondary"><span id="pd-qn-cn">1</span> '.$unit.'</span>
                            </div>
                            <div class="flex flex-row gap-05 flex-align-fe flex-justify-con-fe w-fa">
                                <span class="bold">Alapár:</span>
                                <span class="text-secondary fbe" id="pd-def-val" data-value="'.$base.'"></span>
                            </div>
                        </div>
                        <div class="flex flex-col gap-025 small">
                            <div class="flex flex-row gap-05 flex-align-fe flex-justify-con-fe w-fa">
                                <span class="bold">Szállítási díj:</span>
                                <span class="text-secondary fbe" data-value="2000" id="pd-sh-cn"></span>
                            </div>
                            <div class="flex flex-row gap-05 flex-align-fe flex-justify-con-fe w-fa">
                                <span class="bold">Kezelési költség:</span>
                                <span class="text-secondary fbe" data-value="1000"></span>
                            </div>
                        </div>
                        <div class="flex flex-col gap-025 small">
                            <div class="flex flex-row gap-05 flex-align-fe flex-justify-con-fe w-fa">
                                <span class="bold">Levonások:</span>
                                <span class="text-secondary fbe" id="pd-dc-cn">0 Ft</span>
                            </div>
                            <div class="flex flex-row gap-05 flex-align-fe flex-justify-con-fe w-fa">
                                <span class="bold">Fizetendő:</span>
                                <span class="text-secondary fbe" id="pd-st-cn">0 Ft</span>
                            </div>
                        </div>
                        <div class="hidden flex-col gap-1 w-fa" id="st-dc-cn">
                            <div class="flex flex-col gap-05" id="st-dc-in-cn"></div>
                        </div>
                    </div>
                    <script>
                    var btn = document.querySelectorAll(".splash");
                    for (let i = 0; i < btn.length; i++) { btn[i].addEventListener("click", createRipple); }
                    function createRipple(e) { let btn = e.target; if (btn.tagName == "svg") { btn = btn.parentNode; } if (btn.tagName == "rect") { btn = btn.parentNode.parentNode; }
                        let boundingBox = btn.getBoundingClientRect(); let x = e.clientX - boundingBox.left; let y = e.clientY - boundingBox.top; let ripple = document.createElement("span"); ripple.classList.add("ripple");
                        ripple.style.left = `${x}px`; ripple.style.top = `${y}px`; btn.appendChild(ripple); ripple.addEventListener("animationend", () => { ripple.remove() });
                    }
                    </script>
                ';
            } else { echo 'nincs ilyen termek'; } $stmt->close();
        } else { echo '<script>window.location.href = "/404"</script>'; }
    } else { echo '<script>window.location.href = "/404"</script>'; }
} else { echo '<script>window.location.href = "/"</script>'; }

?>
<script>
    let fbe = document.getElementsByClassName('fbe'); for (let i = 0; i < fbe.length; i++) { fbe[i].innerHTML = formatter.format(fbe[i].getAttribute('data-value')); }
    let dval = 1; let csubt = <?= $base; ?>; let cdisc = <?= $discount; ?>; let vova = 0; let vope = 0; let gt = 0;
    var dcCon = document.getElementById('st-dc-cn'); var dciCon = document.getElementById('st-dc-in-cn');
    document.getElementById('pd-dc-cn').textContent = formatter.format(<?= ( $base * $discount) / 100 ?>);
    document.getElementById('pd-st-cn').textContent = csubt >= 30000 ? formatter.format(<?= $base - ( $base * $discount) / 100 ?> + 1000) : formatter.format(<?= $base - ( $base * $discount) / 100 ?> + 3000);
    <?php
        if ($discount > 0) {
            echo '
                dcCon.classList.replace("hidden", "flex");    
                document.getElementById("st-dc-in-cn").innerHTML = `
                    <div class="flex flex-row w-fa small-med border-secondary border-soft-light overflow-hidden">
                        <span class="flex flex-row flex-align-c text-align-c padding-05 background-bg text-primary w-20">Leárazás</span>
                        <span class="flex flex-row flex-align-c padding-05 text-secondary w-80">A termék, amit várásolni szeretne, le van árazva, így levonjuk az összeg '.$discount.'%-át.</span>
                    </div>
                `;
            ';
        }
    ?>
    function addSingle () {
        dval++; vova > 0 ? csubt = (vova * dval) + (((<?= $base - ( $base * $discount) / 100 ?>) * vope) / 100) : csubt = dval * <?= $base; ?>;
        // console.log('vova: ' + vova);
        // console.log("gt : " + (((<?= $base - ( $base * $discount) / 100 ?>) * vope) / 100));
        console.log('vd csubt: ' + csubt);
        document.getElementById('sq-in').textContent = dval; document.getElementById('pd-qn-cn').textContent = dval;
        document.getElementById('pd-dc-cn').textContent = formatter.format((<?= ( $base * $discount) / 100 ?>) * dval);
        
        gt = ((<?= $base ?> * dval) - (<?= ($base * $discount) / 100 ?>) * dval) - ((((<?= $base ?> * dval) - (<?= ($base * $discount) / 100 ?>) * dval) * vope) / 100)+1000;

        document.getElementById('pd-def-val').setAttribute('data-value', dval * <?= $base; ?>);
        document.getElementById('pd-def-val').textContent = formatter.format(dval * <?= $base; ?>);
        if (csubt >= 30000) {
            dcCon.classList.replace('hidden', 'flex');
            if (!dciCon.contains(document.getElementById('pd-dc-it-sh'))) {
                dciCon.innerHTML += `
                <div class="flex flex-row w-fa small-med border-secondary border-soft-light overflow-hidden" id="pd-dc-it-sh">
                    <span class="flex flex-row flex-align-c text-align-c padding-05 background-bg text-primary w-20">Szállítási díj</span>
                    <span class="flex flex-row flex-align-c padding-05 text-secondary w-80">30 000 Ft után átvállaljuk a szállítás díját.</span>
                </div>
                `;
            }
            document.getElementById('pd-dc-cn').textContent = formatter.format(((<?= ( $base * $discount) / 100 ?>) * dval) + 2000);
            document.getElementById('pd-sh-cn').textContent = formatter.format(ship[i].getAttribute('ship-price'));
            document.getElementById('pd-sh-cn').classList.add('linethrough');
        } else { gt+= 2000;
            document.getElementById('pd-dc-it-sh')?.remove();
            document.getElementById('pd-sh-cn').classList.remove('linethrough');
        }
        console.log(csubt);
        document.getElementById('pd-st-cn').innerHTML = formatter.format(gt);
    }

    function remSingle () {
        if (dval > 1) {
            dval--; vova > 0 ? csubt = (vova * dval) - (((<?= $base - ( $base * $discount) / 100 ?>) * vope) / 100) : csubt = dval * <?= $base; ?>;
            gt = ((<?= $base ?> * dval) - (<?= ($base * $discount) / 100 ?>) * dval) - ((((<?= $base ?> * dval) - (<?= ($base * $discount) / 100 ?>) * dval) * vope) / 100)+1000;
            document.getElementById('sq-in').textContent = dval; document.getElementById('pd-qn-cn').textContent = dval;
            document.getElementById('sq-in').textContent = dval; document.getElementById('pd-qn-cn').textContent = dval;
            document.getElementById('pd-dc-cn').textContent = formatter.format((<?= ( $base * $discount) / 100 ?>) * dval);
            document.getElementById('pd-def-val').setAttribute('data-value', dval * <?= $base; ?>);
            document.getElementById('pd-def-val').textContent = formatter.format(dval * <?= $base; ?>);
            console.log(csubt);
            if (csubt >= 30000) {
                dcCon.classList.replace('hidden', 'flex');
                document.getElementById('pd-dc-cn').textContent = formatter.format(((<?= ( $base * $discount) / 100 ?>) * dval) + 2000);
                document.getElementById('pd-sh-cn').textContent = formatter.format(ship[i].getAttribute('ship-price'));
                document.getElementById('pd-sh-cn').classList.add('linethrough');
            } else { gt+= 2000;
                document.getElementById('pd-dc-it-sh')?.remove(); document.getElementById('pd-sh-cn').classList.remove('linethrough');
            } document.getElementById('pd-st-cn').innerHTML = formatter.format(gt);
        }
    }

    function validateVoucher() { csubt = dval * <?= $base; ?>; var vData = new FormData(); vData.append("pid", <?= $pid; ?>); vData.append("code", document.getElementById('voucher-input').value);
        if (document.getElementById('voucher-input').value.length > 0) {
            $.ajax({ enctype: "multipart/form-data", type: "POST", url: "/includes/webshop/checkout/assets/vouchers/get.php", data: vData, dataType: 'json', contentType: false, processData: false,
                beforeSend: function () { document.getElementById('av-ac-ic-cn').innerHTML = `Beváltás <svg class='wizard_input_loading' xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24" height="24" viewBox="0 0 24 24" version="1.1"><g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"><g><polygon points="0 0 24 0 24 24 0 24"/></g><path d="M12,4 L12,6 C8.6862915,6 6,8.6862915 6,12 C6,15.3137085 8.6862915,18 12,18 C15.3137085,18 18,15.3137085 18,12 C18,10.9603196 17.7360885,9.96126435 17.2402578,9.07513926 L18.9856052,8.09853149 C19.6473536,9.28117708 20,10.6161442 20,12 C20,16.418278 16.418278,20 12,20 C7.581722,20 4,16.418278 4,12 C4,7.581722 7.581722,4 12,4 Z" fill="currentColor" fill-rule="nonzero" transform="translate(12.000000, 12.000000) scale(-1, 1) translate(-12.000000, -12.000000) "/></g></svg>`; },
                success: function(data) { console.log(data);
                    if (document.getElementById('voucher-input').value == data.code) {
                        document.getElementById('av-ac-ic-cn').innerHTML = `Beváltva`;

                        document.getElementById('vd-vc-ac-cn').removeAttribute('onclick');
                        document.getElementById('vd-vc-ac-cn').classList.remove('primary-bg-hover');
                        document.getElementById('vd-vc-ac-cn').classList.remove('splash');
                        document.getElementById('vd-vc-ac-cn').classList.replace('pointer', 'not-allowed');
                        
                        gt = ((<?= $base ?> * dval) - (<?= ($base * $discount) / 100 ?>) * dval) - ((((<?= $base ?> * dval) - (<?= ($base * $discount) / 100 ?>) * dval) * data.value) / 100) + 1000;
                        
                        console.log('dd csubt: ' + csubt);
                        
                        if (csubt < 30000) { gt += 2000; document.getElementById('pd-dc-it-sh')?.remove(); document.getElementById('pd-sh-cn').classList.remove('linethrough'); }
                        else {
                            if (!dciCon.contains(document.getElementById('pd-dc-it-sh'))) {
                                dciCon.innerHTML += `
                                <div class="flex flex-row w-fa small-med border-secondary border-soft-light overflow-hidden" id="pd-dc-it-sh">
                                    <span class="flex flex-row flex-align-c text-align-c padding-05 background-bg text-primary w-20">Szállítási díj</span>
                                    <span class="flex flex-row flex-align-c padding-05 text-secondary w-80">30 000 Ft után átvállaljuk a szállítás díját.</span>
                                </div>
                                `;
                            }
                        }
                        document.getElementById('pd-st-cn').innerHTML = formatter.format(gt);

                        vova = ((<?= $base ?> * dval) - (<?= ($base * $discount) / 100 ?>) * dval) - ((((<?= $base ?> * dval) - (<?= ($base * $discount) / 100 ?>) * dval) * data.value) / 100);
                        vope = data.value;

                        console.log(vova + ' vova');
                        console.log(vope + ' vope');

                        dcCon.classList.replace('hidden', 'flex');
                        dciCon.innerHTML += `
                        <div class="flex flex-row w-fa small-med border-secondary border-soft-light overflow-hidden">
                            <span class="flex flex-row flex-align-c text-align-c padding-05 background-bg text-primary w-20">Kuponkód</span>
                            <span class="flex flex-row flex-align-c padding-05 text-secondary w-80">${data.description}</span>
                        </div>
                        `;

                        document.getElementById('vc-ec-cn').innerHTML = `<span class="flex flex-align-c flex-row gap-05 w-fa text-success small-med"><svg width="16" height="16" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><rect opacity="0.3" x="2" y="2" width="20" height="20" rx="10" fill="currentColor"/><path d="M10.4343 12.4343L8.75 10.75C8.33579 10.3358 7.66421 10.3358 7.25 10.75C6.83579 11.1642 6.83579 11.8358 7.25 12.25L10.2929 15.2929C10.6834 15.6834 11.3166 15.6834 11.7071 15.2929L17.25 9.75C17.6642 9.33579 17.6642 8.66421 17.25 8.25C16.8358 7.83579 16.1642 7.83579 15.75 8.25L11.5657 12.4343C11.2533 12.7467 10.7467 12.7467 10.4343 12.4343Z" fill="currentColor"/></svg><span>Kuponkód sikeresen hozzáadva.</span></span>`;
                    } else { document.getElementById('av-ac-ic-cn').innerHTML = `Beváltás`; document.getElementById('vc-ec-cn').innerHTML = `<span class="flex flex-align-c flex-row gap-05 w-fa text-danger small-med"><svg width="16" height="16" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><rect opacity="0.3" x="2" y="2" width="20" height="20" rx="10" fill="currentColor"/><rect x="11" y="14" width="7" height="2" rx="1" transform="rotate(-90 11 14)" fill="currentColor"/><rect x="11" y="17" width="2" height="2" rx="1" transform="rotate(-90 11 17)" fill="currentColor"/></svg><span>Érvénytelen kuponkódot adott meg.</span></span>`; }
                },
                error: function (data) { console.log(data); document.getElementById('av-ac-ic-cn').innerHTML = `Beváltás`; document.getElementById('vc-ec-cn').innerHTML = `<span class="flex flex-align-c flex-row gap-05 w-fa text-danger small-med"><svg width="16" height="16" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><rect opacity="0.3" x="2" y="2" width="20" height="20" rx="10" fill="currentColor"/><rect x="11" y="14" width="7" height="2" rx="1" transform="rotate(-90 11 14)" fill="currentColor"/><rect x="11" y="17" width="2" height="2" rx="1" transform="rotate(-90 11 17)" fill="currentColor"/></svg><span>${data.responseText}</span></span>`; }
            });
        } else { document.getElementById('vc-ec-cn').innerHTML = `<span class="flex flex-align-c flex-row gap-05 w-fa text-danger small-med"><svg width="16" height="16" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><rect opacity="0.3" x="2" y="2" width="20" height="20" rx="10" fill="currentColor"/><rect x="11" y="14" width="7" height="2" rx="1" transform="rotate(-90 11 14)" fill="currentColor"/><rect x="11" y="17" width="2" height="2" rx="1" transform="rotate(-90 11 17)" fill="currentColor"/></svg><span>A kupon beváltásához adja meg a kuponkódot.</span></span>`; }
    }

    var ship = document.getElementsByName('ship'); let sfa = false;
    for(let i = 0; i < ship.length; i++) {
        ship[i].addEventListener('click', () => {
            if (csubt < 30000) {
                if (sfa = false) { csubt += Number(ship[i].getAttribute('ship-price')); } sfa = true;
                console.log(ship[i].getAttribute('ship-price'));
            } else { document.getElementById('pd-dc-cn').textContent = formatter.format(((<?= ( $base * $discount) / 100 ?>) * dval) + 2000); }
            document.getElementById('pd-sh-cn').textContent = formatter.format(ship[i].getAttribute('ship-price'));
            document.getElementById('pd-st-cn').textContent = formatter.format(csubt);
        });
    }

</script>