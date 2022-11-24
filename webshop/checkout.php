<?php require_once($_SERVER['DOCUMENT_ROOT'].'/includes/header.php'); if (!isset($_SESSION['loggedin'])) { echo "<script>window.location.href='/';</script>"; die(); } ?>
<script>"use strict"; const html = document.querySelector('html');function switchTheme(theme) {html.dataset.theme = `theme-${theme}`;localStorage.setItem('theme', `theme-${theme}`);} </script>
<script>var formatter = new Intl.NumberFormat('hu-HU', {style: 'currency',currency: 'HUF',maximumFractionDigits: 0,minimumFractionDigits: 0});</script>
<main id="main" style="margin-bottom: 5rem;">
    <section class='flex flex-justify-con-c main_section ch__section margin-auto' style="margin: 0 auto;">
        <div class="flex flex-col prod-con margin-auto card border-soft box-shadow w-fa">
            <div class="ch__tab">
                <div class="flex flex-col gap-1 w-100">
                    <div class="flex flex-row flex-align-c flex-justify-con-sb">
                        <span class="text-primary bold large">Számlázási adatok</span>
                        <span class="flex"><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1"><g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"><rect x="0" y="0" width="24" height="24"/><path d="M8,3 L8,3.5 C8,4.32842712 8.67157288,5 9.5,5 L14.5,5 C15.3284271,5 16,4.32842712 16,3.5 L16,3 L18,3 C19.1045695,3 20,3.8954305 20,5 L20,21 C20,22.1045695 19.1045695,23 18,23 L6,23 C4.8954305,23 4,22.1045695 4,21 L4,5 C4,3.8954305 4.8954305,3 6,3 L8,3 Z" class="svg" opacity="0.3"/><path d="M11,2 C11,1.44771525 11.4477153,1 12,1 C12.5522847,1 13,1.44771525 13,2 L14.5,2 C14.7761424,2 15,2.22385763 15,2.5 L15,3.5 C15,3.77614237 14.7761424,4 14.5,4 L9.5,4 C9.22385763,4 9,3.77614237 9,3.5 L9,2.5 C9,2.22385763 9.22385763,2 9.5,2 L11,2 Z" class="svg"/><rect class="svg" opacity="0.3" x="10" y="9" width="7" height="2" rx="1"/><rect class="svg" opacity="0.3" x="7" y="9" width="2" height="2" rx="1"/><rect class="svg" opacity="0.3" x="7" y="13" width="2" height="2" rx="1"/><rect class="svg" opacity="0.3" x="10" y="13" width="7" height="2" rx="1"/><rect class="svg" opacity="0.3" x="7" y="17" width="2" height="2" rx="1"/><rect class="svg" opacity="0.3" x="10" y="17" width="7" height="2" rx="1"/></g></svg></span>
                    </div><hr style="border: 1px solid var(--background); width: 100%;">
                    <div class="flex flex-col gap-1">
                        <div class="flex flex-row flex-justify-con-c gap-1">
                            <div class="flex flex-col gap-05">
                                <label class="text-secondary small">Teljes név</label>
                                <input type="text" class="wizard_input border-soft border-primary" id="ch__fullname" name="ch__fullname" placeholder="Mina Misi" value="<?php echo $fullname; ?>" />
                            </div>
                            <div class="flex flex-col gap-05">
                                <label class="text-secondary small">E-mail cím</label>
                                <input type="email" class="wizard_input border-soft border-primary" id="ch__email" name="ch__email" placeholder="mintamisi@email.com" value="<?php echo $email; ?>" />
                            </div>
                        </div>
                        <div class="flex flex-row flex-justify-con-c gap-1">
                            <div class="flex flex-col gap-05">
                                <label class="text-secondary small">Település</label>
                                <input type="text" class="wizard_input border-soft border-primary" id="ch__shcity" name="ch__shcity" placeholder="Kecskemét" value="<?php echo $settlement; ?>" />
                            </div>
                            <div class="flex flex-col gap-05">
                                <label class="text-secondary small">Szállítási cím</label>
                                <input type="text" class="wizard_input border-soft border-primary" id="ch__shaddr" name="ch__shaddr" placeholder="Minta utca 3" value="<?php echo $address; ?>" />
                            </div>
                        </div>
                        <div class="flex flex-row flex-justify-con-c gap-1">
                            <div class="flex flex-col gap-05">
                                <label class="text-secondary small">Irányítószám</label>
                                <input type="number" class="wizard_input border-soft border-primary" id="ch__shzip" name="ch__shzip" min="1011" placeholder="6000" value="<?php echo $postal; ?>" />
                            </div>
                            <div class="flex flex-col gap-05">
                                <label class="text-secondary small">Telefonszám</label>
                                <input type="tel" class="wizard_input border-soft border-primary" id="ch__phone" name="ch__phone" placeholder="+36 12 345 6789" value="<?php echo $phone; ?>" />
                            </div>
                        </div>
                        <div class="flex flex-col flex-align-c flex-justify-con-c gap-05">
                            <label class="flex flex-row flex-align-c flex-justify-con-fs w-100 text-secondary small">Megjegyzés</label>
                            <textarea class="wizard_input border-soft border-primary resize-none w-100" maxlength="512" rows="6"  id="ch__note" placeholder="Rendeléssel kapcsolatos megjegyzések"></textarea>
                        </div>
                    </div>
                </div>
            </div>
            <div class="ch__tab">
                <div class="flex flex-col gap-1 w-100">
                    <div class="flex flex-row flex-align-c flex-justify-con-sb">
                        <span class="text-primary bold large">Rendelési adatok</span>
                        <span class="flex"><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1"><g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"><rect x="0" y="0" width="24" height="24"/><path d="M4,6 L20,6 C20.5522847,6 21,6.44771525 21,7 L21,8 C21,8.55228475 20.5522847,9 20,9 L4,9 C3.44771525,9 3,8.55228475 3,8 L3,7 C3,6.44771525 3.44771525,6 4,6 Z M5,11 L10,11 C10.5522847,11 11,11.4477153 11,12 L11,19 C11,19.5522847 10.5522847,20 10,20 L5,20 C4.44771525,20 4,19.5522847 4,19 L4,12 C4,11.4477153 4.44771525,11 5,11 Z M14,11 L19,11 C19.5522847,11 20,11.4477153 20,12 L20,19 C20,19.5522847 19.5522847,20 19,20 L14,20 C13.4477153,20 13,19.5522847 13,19 L13,12 C13,11.4477153 13.4477153,11 14,11 Z" class="svg"/><path d="M14.4452998,2.16794971 C14.9048285,1.86159725 15.5256978,1.98577112 15.8320503,2.4452998 C16.1384028,2.90482849 16.0142289,3.52569784 15.5547002,3.83205029 L12,6.20185043 L8.4452998,3.83205029 C7.98577112,3.52569784 7.86159725,2.90482849 8.16794971,2.4452998 C8.47430216,1.98577112 9.09517151,1.86159725 9.5547002,2.16794971 L12,3.79814957 L14.4452998,2.16794971 Z" class="svg" fill-rule="nonzero" opacity="0.3"/></g></svg></span>
                    </div><hr style="border: 1px solid var(--background); width: 100%;">
                    <div class="flex flex-col gap-1">
                        <div class="flex flex-row flex-justify-con-sb gap-1 w-fa">
                            <div class="flex flex-col gap-025">
                                <span class="text-secondary bold small">Szállítási adatok</span>
                                <div class="flex flex-row flex-align-c text-primary smaller-med gap-05">
                                    <span class="text-muted smaller-med" id="shp__postal"><?php echo $postal; ?></span>
                                    <span class="text-muted smaller-med" id="shp__settlement"><?php echo $settlement; ?></span>
                                </div>
                                <span class="text-muted smaller-med" id="shp__county">Megye</span>
                                <span class="text-muted smaller-med" id="shp__address"><?php echo $address; ?></span>
                            </div>
                            <div class="flex flex-col flex-justify-con-fe text-align-r gap-025">
                                <span class="text-secondary bold small">Rendelő adatai</span>
                                <span class="text-muted smaller-med" id="cust__name"><?php echo $fullname; ?></span>
                                <span class="text-muted smaller-med" id="cust__email"><?php echo $email; ?></span>
                                <span class="text-muted smaller-med" id="cust__phone"><?php echo $phone; ?></span>
                            </div>
                        </div>
                        <div class="flex flex-col">
                            <table class="ch__table">
                                <tr class="text-muted bold small text-align-r" id="ch__table">
                                    <th class=" w-70" style="width: 70%;">Termék</th>
                                    <th class="text-align-r w-10">Darab</th>
                                    <th class="text-align-r w-20">Összeg</th>
                                </tr>
                            </table>
                            <div class="flex flex-col" id="chtbl__con"></div>
                            <table class="ch__table">
                                <tr class="text-muted bold small-med text-align-r" id="ch__table">
                                    <td class=" w-70" style="width: 70%;"></td>
                                    <td class="text-align-r w-10">Összeg:</td>
                                    <td class="text-align-r w-20 money__form" id="subt__taxfree">NaN Ft</td>
                                </tr>
                                <tr class="text-muted bold small-med text-align-r" id="ch__table">
                                    <td class=" w-70" style="width: 70%;"></td>
                                    <td class="text-align-r w-10">Szállítás:</td>
                                    <td class="text-align-r w-20 money__form" id="ship__fee" data-default="0">NaN Ft</td>
                                </tr>
                                <tr class="text-muted bold small-med text-align-r" id="ch__table">
                                    <td class=" w-70" style="width: 70%;"></td>
                                    <td class="text-align-r w-10">Kedvezmény:</td>
                                    <td class="text-align-r w-20 money__form" id="disc__fee">NaN Ft</td>
                                </tr>
                                <tr class="text-primary bold small-med text-align-r" id="ch__table">
                                    <td class=" w-70" style="width: 70%;"></td>
                                    <td class="text-align-r w-10">Végösszeg:</td>
                                    <td class="text-align-r w-20 money__form" id="ch__subtotal">NaN Ft</td>
                                </tr>
                            </table>
                            <div class="flex flex-row flex-align-c gap-1 padding-05">
                                <div class="flex flex-col flex-align-c flex-justify-con-c text-muted">
                                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1"><g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"><rect x="0" y="0" width="24" height="24"></rect><path d="M4,6 L20,6 C20.5522847,6 21,6.44771525 21,7 L21,8 C21,8.55228475 20.5522847,9 20,9 L4,9 C3.44771525,9 3,8.55228475 3,8 L3,7 C3,6.44771525 3.44771525,6 4,6 Z M5,11 L10,11 C10.5522847,11 11,11.4477153 11,12 L11,19 C11,19.5522847 10.5522847,20 10,20 L5,20 C4.44771525,20 4,19.5522847 4,19 L4,12 C4,11.4477153 4.44771525,11 5,11 Z M14,11 L19,11 C19.5522847,11 20,11.4477153 20,12 L20,19 C20,19.5522847 19.5522847,20 19,20 L14,20 C13.4477153,20 13,19.5522847 13,19 L13,12 C13,11.4477153 13.4477153,11 14,11 Z" fill="currentColor"></path><path d="M14.4452998,2.16794971 C14.9048285,1.86159725 15.5256978,1.98577112 15.8320503,2.4452998 C16.1384028,2.90482849 16.0142289,3.52569784 15.5547002,3.83205029 L12,6.20185043 L8.4452998,3.83205029 C7.98577112,3.52569784 7.86159725,2.90482849 8.16794971,2.4452998 C8.47430216,1.98577112 9.09517151,1.86159725 9.5547002,2.16794971 L12,3.79814957 L14.4452998,2.16794971 Z" fill="currentColor" fill-rule="nonzero" opacity="0.3"></path></g></svg>
                                    <span class="smaller">Kedvezmény</span>
                                </div>
                                <hr class="feat__hr" style="width: 1.5rem;">
                                <div class="flex flex-row flex-align-c gap-05" id="disc__ind"></div>
                            </div>
                        </div>
                    </div>
                </div>
                <?php
                $pr_sql = "SELECT disc FROM e__subs WHERE uid = $uid"; $pr_res = $con-> query($pr_sql); $subdisc = 0;
                if ($pr_res-> num_rows > 0) { $subs = $pr_res-> fetch_assoc(); if ($subs['disc'] == 0) { $subdisc = 1; } else { $subdisc = 0; }
                } else { $subdisc = 0; }
                ?>
                <script>
                    $("#ch__fullname").on("load input change", () => { document.getElementById('cust__name').textContent = $("#ch__fullname").val(); });$("#ch__email").on("load input change", () => { document.getElementById('cust__email').textContent = $("#ch__email").val(); });$("#ch__shaddr").on("load input change", () => { document.getElementById('shp__address').textContent = $("#ch__shaddr").val(); });$("#ch__phone").on("load input change", () => { document.getElementById('cust__phone').textContent = $("#ch__phone").val(); });
                    $.ajax({ enctype: "multipart/form-data", type: "POST", url: "/assets/php/webshop/checkout/checkout.php", dataType: "json", contentType: false, processData: false,
                        success: function(data) { let subt__taxfree = 0; var subtotal;
                            for (let i = 0; i < data.length; i++) { var pcolor = data[i].color.charAt(0).toUpperCase() +  data[i].color.slice(1);
                                document.getElementById("chtbl__con").innerHTML += `
                                <table class="ch__table">
                                    <tr class="text-muted bold small-med text-align-r">
                                        <td class=" w-70" style="width: 70%;"><a class="link pointer user-select-none" href="/webshop/?id=${data[i].pid}" target="_blank">${data[i].brand}  ${data[i].name} - ${pcolor}</a></td>
                                        <td class="text-align-r w-10">${data[i].quantity}</td>
                                        <td class="text-align-r w-20 money__form" default-data="${data[i].price}">${data[i].price}</td>
                                    </tr>
                                </table>
                                `; subt__taxfree += Number(data[i].price) * Number(data[i].quantity); 
                                
                            } console.log(subt__taxfree); subtotal = subt__taxfree;
                            document.getElementById('subt__taxfree').setAttribute('default-data', subt__taxfree);
                            if (subt__taxfree > 30000) { document.getElementById('disc__fee').setAttribute('default-data', '-2000'); document.getElementById('ship__fee').setAttribute('default-data', '0'); }
                            var bal__to__form = document.getElementsByClassName('money__form'); for (let i = 0; i < bal__to__form.length; i++) { bal__to__form[i].textContent = formatter.format(bal__to__form[i].getAttribute('default-data')); }

                            var subdisc = <?php echo $subdisc; ?>; let accdisc = 0; var disc__arr = new Array(); if (subdisc == 1 && subt__taxfree >= 5000) { disc__arr.push("2 000 Ft különleges kedvezmény"); accdisc += 2000; }
                            function getJSON(path) { return fetch(path).then(response => response.json()); }
                            getJSON('/assets/json/zip.json').then(data => { for (let i = 0; i < data.length; i++) { if (data[i].county == "Bács-Kiskun" || subt__taxfree > 30000) { disc__arr.push("Szállítási díj átvállalása"); accdisc+= 2000; break; } }  });

                            setTimeout(() => {
                                if (disc__arr.length > 0) {
                                    for (let i = 0; i < disc__arr.length; i++) {
                                        document.getElementById('disc__ind').innerHTML += `<span class="primary-bg smaller border-soft padding-05" id="discind_${i}">${disc__arr[i]}</span>`;
                                    }
                                }  document.getElementById('disc__fee').setAttribute('default-data', accdisc*(-1)); document.getElementById('disc__fee').textContent = formatter.format(accdisc*(-1));
                            }, 250);

                            document.getElementById('ch__subtotal').textContent = formatter.format((subdisc = 1) ? (subt__taxfree + accdisc*(-1)) : subt__taxfree);

                            $("#ch__shcity").on("blur", () => {
                                function getJSON(path) { return fetch(path).then(response => response.json()); }
                                getJSON('/assets/json/zip.json').then(data => { 
                                    for (let i = 0; i < data.length; i++) { 
                                        if (data[i].settlement == document.getElementById("ch__shcity").value) { document.getElementById("ch__shcity").value = data[i].settlement; document.getElementById("ch__shzip").value = data[i].zip;document.getElementById('shp__settlement').textContent = data[i].settlement;document.getElementById('shp__postal').textContent = data[i].zip;document.getElementById('shp__county').textContent = data[i].county; 
                                            if (data[i].county === "Bács-Kiskun") {
                                                document.getElementById("ship__fee").setAttribute("default-data", "0"); if (!document.getElementById('discind_1')) { document.getElementById('disc__ind').innerHTML += `<span class="primary-bg smaller border-soft padding-05" id="discind_1">Szállítási díj átvállalása</span>`; }
                                            } else {
                                                 if (subt__taxfree > 30000) { 
                                                    document.getElementById("ship__fee").setAttribute("default-data", "0"); if (!document.getElementById('discind_1')) { document.getElementById('disc__ind').innerHTML += `<span class="primary-bg smaller border-soft padding-05" id="discind_1">Szállítási díj átvállalása</span>`; }
                                                } else { 
                                                    document.getElementById("ship__fee").setAttribute("default-data", "2000");

                                                    console.log(Number(document.getElementById('disc__fee').getAttribute('default-data'))*(-1));

                                                    // document.getElementById('disc__fee').setAttribute('default-data', Number(document.getElementById('disc__fee').getAttribute('default-data')*(-1))+2000); 
                                                    disc__arr.splice(1, 1); if (document.getElementById('discind_1')){ document.getElementById('discind_1').remove(); }
                                                } 
                                            }
                                            var bal__to__form = document.getElementsByClassName('money__form'); for (let i = 0; i < bal__to__form.length; i++) { bal__to__form[i].textContent = formatter.format(bal__to__form[i].getAttribute('default-data')); }
                                        }
                                    } 
                                }); console.log(subtotal);
                            });
                            $("#ch__shzip").on("blur", () => {
                                function getJSON(path) { return fetch(path).then(response => response.json()); }
                                getJSON('/assets/json/zip.json').then(data => { 
                                    for (let i = 0; i < data.length; i++) {
                                        if (data[i].zip == document.getElementById("ch__shzip").value) {
                                            document.getElementById("ch__shcity").value = data[i].settlement; document.getElementById("ch__shzip").value = data[i].zip; document.getElementById('shp__settlement').textContent = data[i].settlement; document.getElementById('shp__postal').textContent = data[i].zip; document.getElementById('shp__county').textContent = data[i].county;
                                            if (data[i].county === "Bács-Kiskun") { document.getElementById("ship__fee").setAttribute("default-data", "0"); if (!document.getElementById('discind_1')) { document.getElementById('disc__ind').innerHTML += `<span class="primary-bg smaller border-soft padding-05" id="discind_1">Szállítási díj átvállalása</span>`; } } else { if (subt__taxfree > 30000) { document.getElementById("ship__fee").setAttribute("default-data", "0"); if (!document.getElementById('discind_1')) { document.getElementById('disc__ind').innerHTML += `<span class="primary-bg smaller border-soft padding-05" id="discind_1">Szállítási díj átvállalása</span>`; } } else { document.getElementById("ship__fee").setAttribute("default-data", "2000"); disc__arr.splice(1, 1); if (document.getElementById('discind_1')){ document.getElementById('discind_1').remove(); } } }
                                            var bal__to__form = document.getElementsByClassName('money__form'); for (let i = 0; i < bal__to__form.length; i++) { bal__to__form[i].textContent = formatter.format(bal__to__form[i].getAttribute('default-data')); }
                                        }
                                    }
                                }); 
                            }); 
                        }
                    });
                </script>
            </div>
            <div class="ch__tab">
                <div class="flex flex-col gap-1 w-100">
                    <div class="flex flex-row flex-align-c flex-justify-con-sb">
                        <span class="text-primary bold large">Fizetési lehetőségek</span>
                        <span class="flex"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"><path d="M22 7H2V11H22V7Z" class="svg"></path><path opacity="0.3" d="M21 19H3C2.4 19 2 18.6 2 18V6C2 5.4 2.4 5 3 5H21C21.6 5 22 5.4 22 6V18C22 18.6 21.6 19 21 19ZM14 14C14 13.4 13.6 13 13 13H5C4.4 13 4 13.4 4 14C4 14.6 4.4 15 5 15H13C13.6 15 14 14.6 14 14ZM16 15.5C16 16.3 16.7 17 17.5 17H18.5C19.3 17 20 16.3 20 15.5C20 14.7 19.3 14 18.5 14H17.5C16.7 14 16 14.7 16 15.5Z" class="svg"></path></svg></span>
                    </div><hr style="border: 1px solid var(--background); width: 100%;">
                    <div class="flex flex-col gap-1">
                        <div class="flex flex-row flex-wrap flex-justify-con-c gap-1">
                        <?php
                            $pr_sql = "SELECT customers__card.cid AS 'cid', customers__card.cardname AS 'cardname', customers__card.cardnum AS 'shortnum', customers__card.expiry AS 'expiry', customers__card.value,customers__card__info.holder, customers__card__info.type, customers__card__info.provider
                            FROM customers__card INNER JOIN customers__card__info ON customers__card__info.cid = customers__card.cid WHERE customers__card.uid = $uid AND customers__card__info.uid = $uid"; $pr_res = $con-> query($pr_sql);
                            if ($pr_res-> num_rows > 0) { $subtot = 0;
                                while ($card = $pr_res-> fetch_assoc()) {
                                    if ($stmt = $con->prepare('SELECT * FROM customers__card__primary WHERE uid = ? AND cid LIKE ?')) {
                                        $stmt->bind_param('is', $uid, $card['cid']);$stmt->execute();$stmt->store_result(); 
                                        if ($stmt->num_rows > 0) { echo '<div class="flex flex-col gap-1 paymnt__con border-soft primary-bg border-primary-light-dotted padding-105 w-40d-100m" style="height: 84px;" id="paycon_'.$card['cid'].'">'; }
                                        else { echo '<div class="flex flex-col gap-1 paymnt__con border-soft border-secondary-dotted padding-105 w-40d-100m" style="height: 84px;" id="paycon_'.$card['cid'].'">'; }
                                    }
                                    echo '
                                        <div class="flex flex-row flex-align-c flex-justify-con-sb gap-05">
                                            <div class="flex flex-row flex-align-c gap-1">
                                                <span class="text-primary bold">'.$card['holder'].'</span>
                                            </div>
                                            <div class="flex paymbtn__con">
                                            ';
                                            if ($stmt = $con->prepare('SELECT * FROM customers__card__primary WHERE uid = ? AND cid LIKE ?')) {
                                                $stmt->bind_param('is', $uid, $card['cid']);$stmt->execute();$stmt->store_result(); 
                                                if ($stmt->num_rows < 1) { echo '<span class="primary-bg primary-bg-hover padding-05 border-soft text-secondary smaller user-select-none pointer" id="card_'.$card['cid'].'" onclick="setPaymentMethod(this.id);">Használ</span>'; }
                                            }
                                            echo '
                                            </div>
                                        </div>
                                        <div class="flex flex-row flex-align-c gap-1">
                                            <div class="flex flex-row flex-align-c gap-1">
                                                ';
                                                if ($stmt = $con->prepare('SELECT * FROM customers__card__primary WHERE uid = ? AND cid LIKE ?')) {
                                                    $stmt->bind_param('is', $uid, $card['cid']);$stmt->execute();$stmt->store_result(); 
                                                    if ($stmt->num_rows < 1) { echo '<div class="flex flex-col flex-align-c flex-justify-con-c border-soft primary-bg padding-05 box-shadow-sh">'; }
                                                    else { echo '<div class="flex flex-col flex-align-c flex-justify-con-c border-soft item-bg padding-05 box-shadow-sh">'; }
                                                }
                                                if ($card['cardname'] == 'Mappa+ kártya') { echo '<svg xmlns="http://www.w3.org/2000/svg" width="48" height="24" viewBox="0 0 24 24" fill="none"><path d="M22 7H2V11H22V7Z" class="svg"></path><path opacity="0.3" d="M21 19H3C2.4 19 2 18.6 2 18V6C2 5.4 2.4 5 3 5H21C21.6 5 22 5.4 22 6V18C22 18.6 21.6 19 21 19ZM14 14C14 13.4 13.6 13 13 13H5C4.4 13 4 13.4 4 14C4 14.6 4.4 15 5 15H13C13.6 15 14 14.6 14 14ZM16 15.5C16 16.3 16.7 17 17.5 17H18.5C19.3 17 20 16.3 20 15.5C20 14.7 19.3 14 18.5 14H17.5C16.7 14 16 14.7 16 15.5Z" class="svg"></path></svg>'; }
                                                if ($card['cardname'] == 'Mastercard') { echo '<svg xmlns="http://www.w3.org/2000/svg" width="48" height="24" viewBox="0 0 80 48" fill="none"><rect width="80" height="48" rx="6"></rect><g clip-path="url(#clip0)"><path d="M47.129 35.9651H33.8779V12.2273H47.1292L47.129 35.9651Z" fill="#FF5F00"></path><path d="M34.718 24.096C34.718 19.2808 36.9798 14.9914 40.502 12.2271C37.8359 10.1316 34.5384 8.99434 31.1432 8.99935C22.7796 8.99935 16 15.7583 16 24.096C16 32.4338 22.7796 39.1927 31.1432 39.1927C34.5385 39.1978 37.8361 38.0605 40.5022 35.9649C36.9803 33.2011 34.718 28.9115 34.718 24.096Z" fill="#EB001B"></path><path d="M65.0061 24.0967C65.0061 32.4345 58.2265 39.1934 49.8629 39.1934C46.4673 39.1984 43.1693 38.0611 40.5027 35.9656C44.0258 33.2013 46.2876 28.9121 46.2876 24.0967C46.2876 19.2813 44.0258 14.9921 40.5027 12.2278C43.1693 10.1324 46.4671 8.9951 49.8627 9.00002C58.2263 9.00002 65.0059 15.7589 65.0059 24.0967" fill="#F79E1B"></path></g><defs><clipPath id="clip0"><rect width="49" height="38" fill="white" transform="translate(16 9)"></rect></clipPath></defs></svg>'; }
                                                if ($card['cardname'] == 'Visa') { echo '<svg xmlns="http://www.w3.org/2000/svg" width="48" height="24" viewBox="0 0 80 48" fill="none"><rect width="80" height="48" rx="6"></rect><path d="M36.71 33.6833H32.059L34.9658 15.328H39.6174L36.71 33.6833ZM28.1462 15.328L23.712 27.9529L23.1873 25.2343L23.1878 25.2353L21.6228 16.9807C21.6228 16.9807 21.4336 15.328 19.4165 15.328H12.086L12 15.6388C12 15.6388 14.2417 16.118 16.8652 17.7368L20.906 33.6838H25.7521L33.1518 15.328H28.1462V15.328ZM64.7293 33.6833H69L65.2765 15.3275H61.5376C59.8111 15.3275 59.3906 16.6954 59.3906 16.6954L52.4538 33.6833H57.3023L58.2719 30.9568H64.1845L64.7293 33.6833ZM59.6113 27.1904L62.0552 20.3214L63.43 27.1904H59.6113ZM52.8175 19.742L53.4813 15.8003C53.4813 15.8003 51.4331 15 49.298 15C46.9899 15 41.5088 16.0365 41.5088 21.0765C41.5088 25.8186 47.9418 25.8775 47.9418 28.3683C47.9418 30.8591 42.1716 30.4128 40.2673 28.8421L39.5758 32.9635C39.5758 32.9635 41.6526 34 44.8257 34C47.9996 34 52.7879 32.3115 52.7879 27.7158C52.7879 22.9433 46.297 22.499 46.297 20.424C46.2975 18.3486 50.8272 18.6152 52.8175 19.742V19.742Z" fill="#2566AF"></path><path d="M23.1878 25.2348L21.6228 16.9802C21.6228 16.9802 21.4336 15.3275 19.4165 15.3275H12.086L12 15.6383C12 15.6383 15.5233 16.3886 18.9028 19.1995C22.1341 21.8862 23.1878 25.2348 23.1878 25.2348Z" fill="#E6A540"></path></svg>'; }
                                                if ($card['cardname'] == 'PayPal') { echo '<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" id="Layer_1" x="0px" y="0px" width="48" height="24" viewBox="0 0 124 33" enable-background="new 0 0 124 33" xml:space="preserve"><path fill="#253B80" d="M46.211,6.749h-6.839c-0.468,0-0.866,0.34-0.939,0.802l-2.766,17.537c-0.055,0.346,0.213,0.658,0.564,0.658  h3.265c0.468,0,0.866-0.34,0.939-0.803l0.746-4.73c0.072-0.463,0.471-0.803,0.938-0.803h2.165c4.505,0,7.105-2.18,7.784-6.5  c0.306-1.89,0.013-3.375-0.872-4.415C50.224,7.353,48.5,6.749,46.211,6.749z M47,13.154c-0.374,2.454-2.249,2.454-4.062,2.454  h-1.032l0.724-4.583c0.043-0.277,0.283-0.481,0.563-0.481h0.473c1.235,0,2.4,0,3.002,0.704C47.027,11.668,47.137,12.292,47,13.154z"/><path fill="#253B80" d="M66.654,13.075h-3.275c-0.279,0-0.52,0.204-0.563,0.481l-0.145,0.916l-0.229-0.332  c-0.709-1.029-2.29-1.373-3.868-1.373c-3.619,0-6.71,2.741-7.312,6.586c-0.313,1.918,0.132,3.752,1.22,5.031  c0.998,1.176,2.426,1.666,4.125,1.666c2.916,0,4.533-1.875,4.533-1.875l-0.146,0.91c-0.055,0.348,0.213,0.66,0.562,0.66h2.95  c0.469,0,0.865-0.34,0.939-0.803l1.77-11.209C67.271,13.388,67.004,13.075,66.654,13.075z M62.089,19.449  c-0.316,1.871-1.801,3.127-3.695,3.127c-0.951,0-1.711-0.305-2.199-0.883c-0.484-0.574-0.668-1.391-0.514-2.301  c0.295-1.855,1.805-3.152,3.67-3.152c0.93,0,1.686,0.309,2.184,0.892C62.034,17.721,62.232,18.543,62.089,19.449z"/><path fill="#253B80" d="M84.096,13.075h-3.291c-0.314,0-0.609,0.156-0.787,0.417l-4.539,6.686l-1.924-6.425  c-0.121-0.402-0.492-0.678-0.912-0.678h-3.234c-0.393,0-0.666,0.384-0.541,0.754l3.625,10.638l-3.408,4.811  c-0.268,0.379,0.002,0.9,0.465,0.9h3.287c0.312,0,0.604-0.152,0.781-0.408L84.564,13.97C84.826,13.592,84.557,13.075,84.096,13.075z  "/><path fill="#179BD7" d="M94.992,6.749h-6.84c-0.467,0-0.865,0.34-0.938,0.802l-2.766,17.537c-0.055,0.346,0.213,0.658,0.562,0.658  h3.51c0.326,0,0.605-0.238,0.656-0.562l0.785-4.971c0.072-0.463,0.471-0.803,0.938-0.803h2.164c4.506,0,7.105-2.18,7.785-6.5  c0.307-1.89,0.012-3.375-0.873-4.415C99.004,7.353,97.281,6.749,94.992,6.749z M95.781,13.154c-0.373,2.454-2.248,2.454-4.062,2.454  h-1.031l0.725-4.583c0.043-0.277,0.281-0.481,0.562-0.481h0.473c1.234,0,2.4,0,3.002,0.704  C95.809,11.668,95.918,12.292,95.781,13.154z"/><path fill="#179BD7" d="M115.434,13.075h-3.273c-0.281,0-0.52,0.204-0.562,0.481l-0.145,0.916l-0.23-0.332  c-0.709-1.029-2.289-1.373-3.867-1.373c-3.619,0-6.709,2.741-7.311,6.586c-0.312,1.918,0.131,3.752,1.219,5.031  c1,1.176,2.426,1.666,4.125,1.666c2.916,0,4.533-1.875,4.533-1.875l-0.146,0.91c-0.055,0.348,0.213,0.66,0.564,0.66h2.949  c0.467,0,0.865-0.34,0.938-0.803l1.771-11.209C116.053,13.388,115.785,13.075,115.434,13.075z M110.869,19.449  c-0.314,1.871-1.801,3.127-3.695,3.127c-0.949,0-1.711-0.305-2.199-0.883c-0.484-0.574-0.666-1.391-0.514-2.301  c0.297-1.855,1.805-3.152,3.67-3.152c0.93,0,1.686,0.309,2.184,0.892C110.816,17.721,111.014,18.543,110.869,19.449z"/><path fill="#179BD7" d="M119.295,7.23l-2.807,17.858c-0.055,0.346,0.213,0.658,0.562,0.658h2.822c0.469,0,0.867-0.34,0.939-0.803  l2.768-17.536c0.055-0.346-0.213-0.659-0.562-0.659h-3.16C119.578,6.749,119.338,6.953,119.295,7.23z"/><path fill="#253B80" d="M7.266,29.154l0.523-3.322l-1.165-0.027H1.061L4.927,1.292C4.939,1.218,4.978,1.149,5.035,1.1  c0.057-0.049,0.13-0.076,0.206-0.076h9.38c3.114,0,5.263,0.648,6.385,1.927c0.526,0.6,0.861,1.227,1.023,1.917  c0.17,0.724,0.173,1.589,0.007,2.644l-0.012,0.077v0.676l0.526,0.298c0.443,0.235,0.795,0.504,1.065,0.812  c0.45,0.513,0.741,1.165,0.864,1.938c0.127,0.795,0.085,1.741-0.123,2.812c-0.24,1.232-0.628,2.305-1.152,3.183  c-0.482,0.809-1.096,1.48-1.825,2c-0.696,0.494-1.523,0.869-2.458,1.109c-0.906,0.236-1.939,0.355-3.072,0.355h-0.73  c-0.522,0-1.029,0.188-1.427,0.525c-0.399,0.344-0.663,0.814-0.744,1.328l-0.055,0.299l-0.924,5.855l-0.042,0.215  c-0.011,0.068-0.03,0.102-0.058,0.125c-0.025,0.021-0.061,0.035-0.096,0.035H7.266z"/><path fill="#179BD7" d="M23.048,7.667L23.048,7.667L23.048,7.667c-0.028,0.179-0.06,0.362-0.096,0.55  c-1.237,6.351-5.469,8.545-10.874,8.545H9.326c-0.661,0-1.218,0.48-1.321,1.132l0,0l0,0L6.596,26.83l-0.399,2.533  c-0.067,0.428,0.263,0.814,0.695,0.814h4.881c0.578,0,1.069-0.42,1.16-0.99l0.048-0.248l0.919-5.832l0.059-0.32  c0.09-0.572,0.582-0.992,1.16-0.992h0.73c4.729,0,8.431-1.92,9.513-7.476c0.452-2.321,0.218-4.259-0.978-5.622  C24.022,8.286,23.573,7.945,23.048,7.667z"/><path fill="#222D65" d="M21.754,7.151c-0.189-0.055-0.384-0.105-0.584-0.15c-0.201-0.044-0.407-0.083-0.619-0.117  c-0.742-0.12-1.555-0.177-2.426-0.177h-7.352c-0.181,0-0.353,0.041-0.507,0.115C9.927,6.985,9.675,7.306,9.614,7.699L8.05,17.605  l-0.045,0.289c0.103-0.652,0.66-1.132,1.321-1.132h2.752c5.405,0,9.637-2.195,10.874-8.545c0.037-0.188,0.068-0.371,0.096-0.55  c-0.313-0.166-0.652-0.308-1.017-0.429C21.941,7.208,21.848,7.179,21.754,7.151z"/>                                                                <path fill="#253B80" d="M9.614,7.699c0.061-0.393,0.313-0.714,0.652-0.876c0.155-0.074,0.326-0.115,0.507-0.115h7.352  c0.871,0,1.684,0.057,2.426,0.177c0.212,0.034,0.418,0.073,0.619,0.117c0.2,0.045,0.395,0.095,0.584,0.15  c0.094,0.028,0.187,0.057,0.278,0.086c0.365,0.121,0.704,0.264,1.017,0.429c0.368-2.347-0.003-3.945-1.272-5.392  C20.378,0.682,17.853,0,14.622,0h-9.38c-0.66,0-1.223,0.48-1.325,1.133L0.01,25.898c-0.077,0.49,0.301,0.932,0.795,0.932h5.791  l1.454-9.225L9.614,7.699z"/></svg>'; }
                                                echo '
                                                </div>
                                                <div class="flex flex-col flex-align-c gap-05">
                                                    <span class="text-primary bold w-100">'.$card['cardname'].' ** '.$card['shortnum'].'</span>
                                                    <span class="text-secondary small-med w-100">Érvényes: '.$card['expiry'].'</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    ';
                                }
                            }
                        ?>
                        </div>
                    </div>
                </div>
            </div><br>
            <div class="flex flex-row flex-align-c flex-justify-con-fe gap-1">
                <span class="button button-secondary" id="ch__prev" onclick="__chact(-1)">Vissza</span>
                <span class="button button-primary" id="ch__next" onclick="__chact(1)">Következő</span>
            </div>
        </div>
    </seciton>
</main>
<script>
    let __shquant = 1; let __shpfee = 0; let subtotal = 0; let __iprice = 0;
    var __chctab = 0; __chsht(__chctab);
    function __chsht(n) { var x = document.getElementsByClassName("ch__tab"); x[n].style.display = "flex";
        if (n == 0) { document.getElementById("ch__prev").style.display = "none"; } else { document.getElementById("ch__prev").style.display = "flex"; }
        if (n == (x.length - 1)) { document.getElementById("ch__next").innerHTML = "Megrendelés leadása"; document.getElementById("ch__next").setAttribute("onclick", "__chplcrd()"); document.getElementById("ch__next").classList.add("ch__sh"); } else { document.getElementById("ch__next").innerHTML = "Következő"; document.getElementById("ch__next").setAttribute("onclick", "__chact(1)"); document.getElementById("ch__next").classList.remove("ch__sh"); }
    } function __chact(n) { var x = document.getElementsByClassName("ch__tab");
        if (n == 1 && !__chvld()) return false; x[__chctab].style.display = "none"; __chctab = __chctab + n; if (__chctab >= x.length) { return false; } __chsht(__chctab);
    } function __chvld() { var x, y, i, valid = true; x = document.getElementsByClassName("ch__tab"); y = x[0].getElementsByTagName("input");
        for (i = 0; i < y.length; i++) { if (y[i].value == "") { valid = false; } if ($("#ch__shzip").val() < 1011 || $("#ch__shzip").val() > 9985) { valid = false; }
        } return valid;
    }

    const county = { budapest: {name: "Budapest", minmax: [1011,1806]},__pest: {name: "Pest", minmax: [2000, 2760]},__fejer: {name: "Fejér", minmax: [2400, 2490]},__fejer2: {name: "Fejér", minmax: [8000, 8157]},__komarom: {name: "Komárom-Esztergom", minmax: [2500,2545]},__komarom2: {name: "Komárom-Esztergom", minmax: [2800, 2949]},__nograd: {name: "Nógrád", minmax: [2640, 2699]},__nograd2: {name: "Nógrád", minmax: [3041, 3253]},__heves: {name: "Heves", minmax: [3000, 3036]},__heves2: {name: "Heves", minmax: [3200, 3399]},__baz: {name: "Borsod-Abaúj-Zemplén", minmax: [3400, 3999]},__hajdu: {name: "Hajdú-Bihar", minmax: [4000, 4288]},__szabolcs: {name: "Szabolcs-Szatmár-Bereg", minmax: [4300, 4977]},__jasz: {name: "Jász-Nagykun-Szolnok", minmax: [5000, 5476]},__bekes: {name: "Békés", minmax: [5500, 5948]},__bacs: {name: "Bács-Kiskun", minmax: [6000, 6528]},__csongrad: {name: "Csongrád", minmax: [6600, 6932]},__tolna: {name: "Tolna", minmax: [7020, 7228]},__baranya: {name: "Baranya", minmax: [7300, 7396]},__baranya2: {name: "Baranya", minmax: [7600, 7985]},__somogy: {name: "Somogy", minmax: [7400, 7589]},__somogy2: {name: "Somogy", minmax: [8600, 8739]},__veszprem: {name: "Veszprém", minmax: [8161, 8598]},__zala: {name: "Zala", minmax: [8353, 8395]},__zala2: {name: "Zala", minmax: [8741, 8999]},__gyor: {name: "Győr-Moson-Sopron", minmax: [9001, 9495]},__vas: {name: "Vas", minmax: [9500, 9985]} };
    var __shpcounty; let zip = document.getElementById("ch__shzip").value; function inRange(x, min, max) { return ((x - min) * (x - max) <= 0); }
    const matches = []; for (let key of Object.keys(county)) { matches.push([key, county[key]]); }
    for (let i = 0; i < matches.length; i++) {
        if (inRange(Number(<?php echo $postal; ?>), matches[i][1].minmax[0], matches[i][1].minmax[1])) {
            document.getElementById("shp__county").textContent = matches[i][1].name;
            /*
            if (matches[i][1].name === "Bács-Kiskun") { __shpfee = 0; document.getElementById("ch__shfee").textContent = __shpfee + " Ft"; } 
            else { __shpfee = 2200; } __shpcounty = matches[i][1].name; document.getElementById("ch__shfee").textContent = __shpfee + " Ft"; 
            */
        }
    }   
    
    function __chplcrd () { console.log("subt: " + (subt + __shpfee)); console.log("darab: " + __shquant);
        var c__wrapper = document.createElement('div'); c__wrapper.classList = "wrapper_dark"; var c__box = document.createElement('div'); c__box.classList = "d__confirm fixed flex flex-col border-soft item-bg box-shadow padding-1";
        document.body.append(c__wrapper); c__wrapper.append(c__box); disableScroll();
        c__box.innerHTML = `
        <div class="flex flex-row flex-align-c flex-justify-con-sb">
            <span class="text-primary bold">Rendelés összeállítása</span>
            <span class="button button-secondary" id="cl__box">Mégsem</span>
        </div><br>
        <div class="flex flex-col w-100">
            <div id="chpo__icon" class="flex flex-row flex-align-c flex-justify-con-c w-100">
            <svg class='wizard_input_loading' xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="8rem" height="8rem" viewBox="0 0 24 24" version="1.1"><g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"><g><polygon points="0 0 24 0 24 24 0 24"/></g><path d="M12,4 L12,6 C8.6862915,6 6,8.6862915 6,12 C6,15.3137085 8.6862915,18 12,18 C15.3137085,18 18,15.3137085 18,12 C18,10.9603196 17.7360885,9.96126435 17.2402578,9.07513926 L18.9856052,8.09853149 C19.6473536,9.28117708 20,10.6161442 20,12 C20,16.418278 16.418278,20 12,20 C7.581722,20 4,16.418278 4,12 C4,7.581722 7.581722,4 12,4 Z" class="svg" fill-rule="nonzero" opacity="0.4" transform="translate(12.000000, 12.000000) scale(-1, 1) translate(-12.000000, -12.000000) "/></g></svg>
            </div>
            <div class="flex flex-col flex-align-c flex-justify-con-c">
                <span id="chpo__ind" class="text-secondary small-med">Egyenleg megtekintése...</span>
                <span id="chro__ind" class="text-secondary small-med"></span>
            </div>
        </div>
        `; 
        <?php if (isset($_GET['item'])) {
            echo "let ch__pid = ".$_GET['item']."; var sch__single = document.createElement('script'); sch__single.src = '/assets/script/checkout/single.js'; document.body.append(sch__single); ";
        }  else {
            echo "var sch__cart = document.createElement('script'); sch__cart.src = '/assets/script/checkout/cart.js'; document.body.append(sch__cart); ";
        }
        ?>
        
        $('#cl__box').click(function () { c__wrapper.remove(); enableScroll(); });
    }

    <?php
        /*
        if (isset($_GET['item'])) { $ch__pid = $_GET['item'];
            $sql = "SELECT * FROM products WHERE product_id = $ch__pid";
            if ($result = mysqli_query($con, $sql)) { $num = mysqli_num_rows($result); if ($num > 0) { $uimn = $result-> fetch_assoc(); $prquantity = $uimn['product_quantity']; } }
            echo 'var chi__data = new FormData(); chi__data.append("pid", Number('.$ch__pid.')); document.getElementById("chabsi__con").remove();
                $.ajax({ enctype: "multipart/form-data", type: "POST", url: "/assets/php/webshop/checkout/c__product.php", data: chi__data, dataType: "json", contentType: false, processData: false,
                    success: function(data) { var qnt; var newValue;
                        $("#ch__shzip").on("change", () => { 
                            if ($("#ch__shzip").val() > 1011 && $("#ch__shzip").val() < 9985) { subtotal -= __shpfee; __iprice = data[0].price * __shquant;
                                for (let i = 0; i < matches.length; i++) { 
                                    if (inRange(Number($("#ch__shzip").val()), matches[i][1].minmax[0], matches[i][1].minmax[1])) { __shpcounty = matches[i][1].name;
                                        if (matches[i][1].name === "Bács-Kiskun") { __shpfee = 0; document.getElementById("ch__shfee").textContent = formatter.format(__shpfee); } 
                                        else { __shpfee = 2200;
                                            if ((__iprice - __shpfee) > 30000) { document.getElementById("ch__subt").textContent = formatter.format(__iprice); 
                                                document.getElementById("ch__shfee").innerHTML = `<span class="linethrough small" style="margin-right: 1rem;" title="30 ezer forint feletti vásárlásért járó kedvezmény">`+ __shpfee + `</span>` + formatter.format(0);
                                            } else { document.getElementById("ch__shfee").textContent = formatter.format(__shpfee); document.getElementById("ch__subt").textContent = formatter.format(__iprice + __shpfee); } 
                                        }
                                    }
                                } // subt = __shpfee;subtotal = __iprice; subtotal += subt; document.getElementById("ch__subt").textContent = formatter.format(__iprice);
                                document.getElementById("ch__subt").textContent = formatter.format(__iprice+__shpfee);
                            }
                        });
                        for (let i = 0; i < data.length; i++) {
                            document.getElementById("bsi__con").innerHTML += `
                            <tr class="user-select-none">
                                <td class="text-secondary"><a class="link pointer" href="/webshop/?id=${data[i].pid}">${data[i].brand}  ${data[i].name}-${data[i].color}</a></td>
                                <td class="text-secondary" style="text-align: right; padding-right: 1.5rem;">${data[i].price} Ft</td>
                                <td class="text-secondary flex flex-row flex-align-c flex-justify-con-fe">
                                    <div class="flex flex-row flex-align-c gap-1">
                                        <div id="bspq__down${data[i].pid}" class="flex flex-align-c flex-justify-con-c pointer bs__button border-soft background-bg" aria-label="Mennyiség csökkentése">
                                            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="1rem" height="1rem" viewBox="0 0 24 24" version="1.1"><g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"><rect class="svg" x="4" y="11" width="16" height="2" rx="1"></rect></g></svg>
                                        </div>
                                        <b class="user-select-none" data-pid="'.$ch__pid.'" id="chi__id" aria-label="Termék darabszáma">${__shquant}</b>
                                        <div id="bspq__up${data[i].pid}" class="flex flex-align-c flex-justify-con-c pointer bs__button border-soft background-bg" aria-label="Mennyiség növelése">
                                            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="1rem" height="1rem" viewBox="0 0 24 24" version="1.1"><g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"><rect class="svg" x="4" y="11" width="16" height="2" rx="1"></rect><rect class="svg" transform="translate(12.000000, 12.000000) rotate(-270.000000) translate(-12.000000, -12.000000) " x="4" y="11" width="16" height="2" rx="1"></rect></g></svg>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            `; 
                            document.getElementById("bspq__down"+data[0].pid).addEventListener("click", function () { if (__shquant > 1) { __shquant--; } newValue = __shquant;
                                if (newValue >= 1) { document.getElementById("chi__id").textContent = newValue; subt = Number((data[i].price) * newValue); document.getElementById("ch__subt").textContent = formatter.format(subt + __shpfee); }
                                console.log(subt + ": subtotal");
                                if ((subt - __shpfee) < 30000) { document.getElementById("ch__shfee").textContent = formatter.format(__shpfee); }
                            });
                            document.getElementById("bspq__up"+data[0].pid).addEventListener("click", function () { if (__shquant < '.$prquantity.') { __shquant++; } newValue = __shquant;
                                if (newValue <= Number(data[0].quantity)) { document.getElementById("chi__id").textContent = newValue; subt = Number((data[0].price) * (newValue)); document.getElementById("ch__subt").textContent = formatter.format(subt + __shpfee);
                                    if ((subt - __shpfee) > 30000) { document.getElementById("ch__subt").textContent = formatter.format(subt); if (__shpcounty !== "Bács-Kiskun") { document.getElementById("ch__shfee").innerHTML = `<span class="linethrough small" style="margin-right: 1rem;" title="30 ezer forint feletti vásárlásért járó kedvezmény">`+ __shpfee + `</span>` + formatter.format(0); } }
                                    else { document.getElementById("ch__shfee").textContent = formatter.format(__shpfee); }
                                }
                            });
                            subt += Number((data[i].price) * __shquant);
                        } subt += __shpfee; subtotal += subt; document.getElementById("ch__subt").textContent = formatter.format(subtotal);
                        if ((subtotal - __shpfee) > 30000) { subtotal -= __shpfee; document.getElementById("ch__subt").textContent = formatter.format(subtotal); }
                    }, error: function (data) { console.log(data); document.getElementById("bsi__con").innerHTML = `<span class="bold">Hiba történt, kérjük próbálja meg késöbb.</span>`; }
                });
            ';
        }
        if (isset($_GET['basket'])) {
            echo ' document.getElementById("chabsi__con").remove(); document.getElementById("chth__bt").remove(); $("#chth__st").css("padding-right", "1.5rem");
            $.ajax({ enctype: "multipart/form-data", type: "POST", url: "/assets/php/webshop/checkout/c__basket.php", dataType: "json", contentType: false, processData: false,
                success: function(data) { var qnt;
                    for (let i = 0; i < data.length; i++) { qnt = data[i].quantity;
                        document.getElementById("bsi__con").innerHTML += `
                        <tr class="bsi__added user-select-none">
                            <td class="text-secondary"><a class="link pointer" href="/webshop/?id=${data[i].pid}">${data[i].brand}  ${data[i].name}-${data[i].color}</a> <b>x${data[i].quantity}</b></td>
                            <td class="text-secondary" style="text-align: right; padding-right: 1.5rem;">${data[i].price} Ft</td>
                        </tr>
                        `;
                        subt += Number((data[i].price * data[i].quantity));
                    }  subt += __shpfee; subtotal += subt; document.getElementById("ch__subt").textContent = formatter.format(subtotal); if ((subtotal - __shpfee) > 30000) { subtotal -= __shpfee; document.getElementById("ch__subt").textContent = formatter.format(subtotal); }
                    $("#ch__shzip").on("blur", () => {
                        for (let i = 0; i < matches.length; i++) { 
                            if (inRange(Number($("#ch__shzip").val()), matches[i][1].minmax[0], matches[i][1].minmax[1])) { 
                                if (matches[i][1].name === "Bács-Kiskun") { __shpfee = 0; } 
                                else { __shpfee = 2200; } 
                                __shpcounty = matches[i][1].name; document.getElementById("ch__shfee").textContent = formatter.format(__shpfee);
                            }
                        } subt = __shpfee; subtotal += subt; document.getElementById("ch__subt").textContent = formatter.format(subtotal);
                        if ((subtotal - subt) > 30000) { document.getElementById("ch__subt").textContent = formatter.format(subtotal - subt); if (__shpcounty !== "Bács-Kiskun") { document.getElementById("ch__shfee").innerHTML = `<span class="linethrough small" style="margin-right: 1rem;" title="30 ezer forint feletti vásárlásért járó kedvezmény">`+document.getElementById("ch__shfee").textContent + `</span>` + formatter.format(0); } }
                        document.getElementById("ch__subt").textContent = formatter.format(__iprice+__shpfee);
                    });
                }, error: function (data) { document.getElementById("bsi__con").innerHTML = `<span class="bold">Hiba történt, kérjük próbálja meg késöbb.</span>`; }
            });
            ';
        }
        */



/*
        if (isset($_GET['basket']) && !isset($_GET['item'])) {
            echo "document.getElementById('chabsi__con').remove();";
        } if (!isset($_GET['basket']) && isset($_GET['item'])) {
            echo '
                document.getElementById("ch__absi").addEventListener("click", function () {
                    if(document.getElementById("ch__absi").checked) { let subt = 0; 
                        $.ajax({
                            enctype: "multipart/form-data", type: "POST", url: "/assets/php/webshop/checkout/c__basket.php", dataType: "json", contentType: false, processData: false,
                            success: function(data) { var qnt;
                                for (let i = 0; i < data.length; i++) { qnt = data[i].quantity;
                                    document.getElementById("bsi__con").innerHTML += `
                                    <tr class="bsi__added">
                                        <td class="text-secondary"><a class="link pointer" href="/webshop/?id=${data[i].pid}">${data[i].brand}  ${data[i].name}-${data[i].color}</a></td>
                                        <td class="text-secondary" style="text-align: right; padding-right: 1.5rem;">${data[i].price} Ft</td>
                                        <td class="text-secondary flex flex-row flex-align-c flex-justify-con-fe">
                                            <div class="flex flex-row flex-align-c gap-1">
                                                <div id="bspq__down${data[i].pid}" class="flex flex-align-c flex-justify-con-c pointer bs__button border-soft background-bg" aria-label="Mennyiség csökkentése">
                                                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="1rem" height="1rem" viewBox="0 0 24 24" version="1.1"><g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"><rect class="svg" x="4" y="11" width="16" height="2" rx="1"></rect></g></svg>
                                                </div>
                                                <b class="user-select-none">${qnt}</b>
                                                <div id="bspq__up${data[i].pid}" class="flex flex-align-c flex-justify-con-c pointer bs__button border-soft background-bg" aria-label="Mennyiség növelése">
                                                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="1rem" height="1rem" viewBox="0 0 24 24" version="1.1"><g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"><rect class="svg" x="4" y="11" width="16" height="2" rx="1"></rect><rect class="svg" transform="translate(12.000000, 12.000000) rotate(-270.000000) translate(-12.000000, -12.000000) " x="4" y="11" width="16" height="2" rx="1"></rect></g></svg>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                    `;
                                    subt += Number((data[i].price * data[i].quantity));
                                } subt += __shpfee; subtotal += subt; document.getElementById("ch__subt").textContent = formatter.format(subtotal);
                            }, error: function (data) { document.getElementById("bsi__con").innerHTML = `<span class="bold">Hiba történt, kérjük próbálja meg késöbb.</span>`; }
                        });
                    } else { var del__item = document.querySelectorAll(".bsi__added"); for(let i = 0; i < del__item.length; i++) { del__item[i].remove(); } subtotal -= subt; console.log(subt); document.getElementById("ch__subt").textContent = formatter.format(subtotal); }
                });
            ';
        }
*/
?>
function setPaymentMethod (cid) { var credid = cid.split('_')[1]; var cid__data = new FormData(); cid__data.append('cid', credid);
    $.ajax({ enctype: "multipart/form-data", type: "POST", url: "/assets/php/profile/setp__card.php", data: cid__data, dataType: 'json', contentType: false, processData: false,
        success: function(data) {
            if (data === 200) { var actcid = cid; var paycon = document.getElementsByClassName('paymnt__con');                    
                for (let i = 0; i < paycon.length; i++) {
                    if (paycon[i].id.split('_')[1] != credid) { paycon[i].classList.remove("primary-bg"); paycon[i].classList.replace("border-primary-light-dotted", "border-secondary-dotted");
                        paycon[i].lastElementChild.firstElementChild.firstElementChild.classList.replace("item-bg", "primary-bg");
                        var crtsetbtn = document.createElement('span'); crtsetbtn.classList = "primary-bg primary-bg-hover padding-05 border-soft text-secondary smaller user-select-none pointer";
                        crtsetbtn.id = "card_"+paycon[i].id.split('_')[1]; crtsetbtn.setAttribute('onclick', 'setPaymentMethod(this.id)'); crtsetbtn.textContent = "Használ"; 
                        var payb = document.getElementsByClassName('paymbtn__con'); var paycbtn = document.getElementById("card_"+paycon[i].id.split('_')[1]);
                        if (!paycon[i].contains(paycbtn)) { paycon[i].firstElementChild.lastElementChild.append(crtsetbtn); }
                    }
                } document.getElementById(cid).parentNode.parentNode.parentNode.classList.replace("border-secondary-dotted", "border-primary-light-dotted");document.getElementById(cid).parentNode.parentNode.parentNode.classList.add("primary-bg");document.getElementById(cid).parentNode.parentNode.parentNode.lastElementChild.lastElementChild.firstElementChild.classList.replace("primary-bg", "item-bg"); document.getElementById(cid).remove();
            } else { var ce__wrapper = document.createElement('div'); ce__wrapper.classList = "wrapper_dark fadein"; var ce__box = document.createElement('div'); ce__box.classList = "d__confirm de__confirm popup fixed flex flex-col border-soft item-bg box-shadow padding-1"; document.body.append(ce__wrapper); ce__wrapper.append(ce__box); $('html').css("overflow-y", "hidden");
                ce__box.innerHTML = `<div class="flex flex-col gap-1 feat__body prs__con" id="prs__con"><div class="flex flex-col flex-align-c flex-justify-con-c"><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="8rem" height="8rem" viewBox="0 0 24 24" version="1.1"><g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"><rect x="0" y="0" width="24" height="24"></rect><circle fill="#F64E60" opacity="0.3" cx="12" cy="12" r="10"></circle><path d="M12.0355339,10.6213203 L14.863961,7.79289322 C15.2544853,7.40236893 15.8876503,7.40236893 16.2781746,7.79289322 C16.6686989,8.18341751 16.6686989,8.81658249 16.2781746,9.20710678 L13.4497475,12.0355339 L16.2781746,14.863961 C16.6686989,15.2544853 16.6686989,15.8876503 16.2781746,16.2781746 C15.8876503,16.6686989 15.2544853,16.6686989 14.863961,16.2781746 L12.0355339,13.4497475 L9.20710678,16.2781746 C8.81658249,16.6686989 8.18341751,16.6686989 7.79289322,16.2781746 C7.40236893,15.8876503 7.40236893,15.2544853 7.79289322,14.863961 L10.6213203,12.0355339 L7.79289322,9.20710678 C7.40236893,8.81658249 7.40236893,8.18341751 7.79289322,7.79289322 C8.18341751,7.40236893 8.81658249,7.40236893 9.20710678,7.79289322 L12.0355339,10.6213203 Z" fill="#F64E60"></path></g></svg><span class="bold small" style="color: #F64E60;">Sikertelen művelet!</span></div><div class="flex flex-col flex-align-c flex-justify-con-c"><span class="text-secondary w-100 text-align-c small-med"></span><span class="button button-secondary" style="font-size: .75rem !important;" id="cl__ebox">Bezárás</span></div></div>`;
                $('#cl__ebox').click(function () { ce__box.classList.replace("popup", "popout"); ce__wrapper.classList.add("fadeout"); setTimeout(() => {ce__wrapper.remove(); $("#tab-credit").load('/includes/profile/credit.php'); $('html').css("overflow-y", "unset");},235); });
            }
        }, error: function (data) { var ce__wrapper = document.createElement('div'); ce__wrapper.classList = "wrapper_dark fadein"; var ce__box = document.createElement('div'); ce__box.classList = "d__confirm de__confirm popup fixed flex flex-col border-soft item-bg box-shadow padding-1"; document.body.append(ce__wrapper); ce__wrapper.append(ce__box); $('html').css("overflow-y", "hidden");
            ce__box.innerHTML = `<div class="flex flex-col gap-1 feat__body prs__con" id="prs__con"><div class="flex flex-col flex-align-c flex-justify-con-c"><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="8rem" height="8rem" viewBox="0 0 24 24" version="1.1"><g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"><rect x="0" y="0" width="24" height="24"></rect><circle fill="#F64E60" opacity="0.3" cx="12" cy="12" r="10"></circle><path d="M12.0355339,10.6213203 L14.863961,7.79289322 C15.2544853,7.40236893 15.8876503,7.40236893 16.2781746,7.79289322 C16.6686989,8.18341751 16.6686989,8.81658249 16.2781746,9.20710678 L13.4497475,12.0355339 L16.2781746,14.863961 C16.6686989,15.2544853 16.6686989,15.8876503 16.2781746,16.2781746 C15.8876503,16.6686989 15.2544853,16.6686989 14.863961,16.2781746 L12.0355339,13.4497475 L9.20710678,16.2781746 C8.81658249,16.6686989 8.18341751,16.6686989 7.79289322,16.2781746 C7.40236893,15.8876503 7.40236893,15.2544853 7.79289322,14.863961 L10.6213203,12.0355339 L7.79289322,9.20710678 C7.40236893,8.81658249 7.40236893,8.18341751 7.79289322,7.79289322 C8.18341751,7.40236893 8.81658249,7.40236893 9.20710678,7.79289322 L12.0355339,10.6213203 Z" fill="#F64E60"></path></g></svg><span class="bold small" style="color: #F64E60;">Sikertelen művelet!</span></div><div class="flex flex-col flex-align-c flex-justify-con-c"><span class="text-secondary w-100 text-align-c small-med"></span><span class="button button-secondary" style="font-size: .75rem !important;" id="cl__ebox">Bezárás</span></div></div>`;
            $('#cl__ebox').click(function () { ce__box.classList.replace("popup", "popout"); ce__wrapper.classList.add("fadeout"); setTimeout(() => {ce__wrapper.remove(); $("#tab-credit").load('/includes/profile/credit.php'); $('html').css("overflow-y", "unset");},235); });
        }
    });
}
</script>
<?php require_once($_SERVER['DOCUMENT_ROOT'].'/includes/footer.php'); ?>