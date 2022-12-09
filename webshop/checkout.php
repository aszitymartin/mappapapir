<?php require_once($_SERVER['DOCUMENT_ROOT'].'/includes/header.php'); if (!isset($_SESSION['loggedin'])) { echo "<script>window.location.href='/';</script>"; die(); } ?>
<script content-type="application/javascript">var formatter = new Intl.NumberFormat('hu-HU', {style: 'currency',currency: 'HUF',maximumFractionDigits: 0,minimumFractionDigits: 0});</script>
<main id="main" style="margin-bottom: 5rem;">
    <div class="flex flex-col card gap-1 border-soft box-shadow">
        <div class="flex flex-row w-fa">
            <div class="flex flex-row flex-align-c flex-justify-con-sa w-fa flex-wrap gap-1">
                <div class="flex flex-row flex-align-c flex-justify-con-c gap-05 padding-0-05 ch-hd-it">
                    <span class="flex flex-row flex-align-c flex-justify-con-c text-align-c circle background-bg padding-1 text-primary" style="width: .25rem; height: .25rem;">1</span>
                    <span class="ch-step text-primary padding-bot-025">Vevő adatai</span>
                </div>
                <div class="flex flex-row flex-align-c flex-justify-con-c gap-05 padding-0-05 ch-hd-it">
                    <span class="flex flex-row flex-align-c flex-justify-con-c text-align-c circle background-bg padding-1 text-primary" style="width: .25rem; height: .25rem;">2</span>
                    <span class="ch-step text-primary">Szállítás</span>
                </div>
                <div class="flex flex-row flex-align-c flex-justify-con-c gap-05 padding-0-05 ch-hd-it">
                    <span class="flex flex-row flex-align-c flex-justify-con-c text-align-c circle background-bg padding-1 text-primary" style="width: .25rem; height: .25rem;">3</span>
                    <span class="ch-step text-primary">Fizetés</span>
                </div>
                <div class="flex flex-row flex-align-c flex-justify-con-c gap-05 padding-0-05 ch-hd-it">
                    <span class="flex flex-row flex-align-c flex-justify-con-c text-align-c circle background-bg padding-1 text-primary" style="width: .25rem; height: .25rem;">4</span>
                    <span class="ch-step text-primary">Rendelés</span>
                </div>
            </div>
        </div>
        <hr style="border: 1px solid var(--background);" class="w-100"><br>
        <div id="ch-con">
            <div id="chi-con">
                <div class="flex flex-row-d-col-m gap-1 w-fa">
                    <div id="ch-it-con" class="flex flex-col gap-1 w-fa w-70d-100m border-primary-right-d padding-05"></div>
                    <div class="flex flex-col gap-1 w-fa">
                        <div class="ch-tab flex-col gap-2 w-fa text-primary">
                            <div class="flex flex-col gap-05 w-fa">
                                <span class="text-primary bold">Teljes név</span>
                                <input type="text" class="w-fa text-primary border-soft background-bg padding-1-05 outline-none border-none" placeholder="Adja meg a teljes nevét" autocomplete="fullname">
                            </div>
                            <div class="flex flex-col gap-05 w-fa">
                                <span class="text-primary bold">E-mail cím</span>
                                <input type="email" class="w-fa text-primary border-soft background-bg padding-1-05 outline-none border-none" placeholder="Adja meg az e-mail címét" autocomplete="email">
                            </div>
                            <div class="flex flex-col gap-05 w-fa">
                                <span class="text-primary bold">Telefonszám</span>
                                <input type="email" class="w-fa text-primary border-soft background-bg padding-1-05 outline-none border-none" placeholder="Adja meg a telefonszámát" autocomplete="tel">
                            </div>
                        </div>
                        <div class="ch-tab flex-col gap-2 w-fa text-primary">
                            <div class="flex flex-col gap-1 w-fa">
                                <span class="text-primary bold">Szállítási mód kiválasztása</span>
                                <div class="flex flex-col gap-1 outline-none border-none small text-muted" style="accent-color: #3699FF;">
                                    <div class="flex flex-row flex-align-c gap-1">
                                        <input type="radio" id="gls" name="ship" value="gls" />
                                        <label for="gls">GLS - A csomag közvetlenül az otthonáig lesz szállítva - 2 000 Ft</label>
                                    </div>
                                    <div class="flex flex-row flex-align-c gap-1">
                                        <input type="radio" id="fedex" name="ship" value="fedex" />
                                        <label for="fedex">FedEx - A csomag közvetlenül az otthonáig lesz szállítva - 2 000 Ft</label>
                                    </div>
                                    <div class="flex flex-row flex-align-c gap-1">
                                        <input type="radio" id="dhl" name="ship" value="dhl" />
                                        <label for="dhl">DHL - A csomag közvetlenül az otthonáig lesz szállítva - 2 500 Ft</label>
                                    </div>
                                </div>
                            </div>
                            <div class="flex flex-col gap-05 w-fa">
                                <span class="text-primary bold">Irányítószám</span>
                                <input type="number" max="9999" class="w-fa text-primary border-soft background-bg padding-1-05 outline-none border-none" placeholder="Adja meg az irányítószámát" autocomplete="postal-code">
                            </div>
                            <div class="flex flex-col gap-05 w-fa">
                                <span class="text-primary bold">Település</span>
                                <input type="text" class="w-fa text-primary border-soft background-bg padding-1-05 outline-none border-none" placeholder="Adja meg a települését" autocomplete="settlement">
                            </div>
                            <div class="flex flex-col gap-05 w-fa">
                                <span class="text-primary bold">Utca, házszám</span>
                                <input type="text" class="w-fa text-primary border-soft background-bg padding-1-05 outline-none border-none" placeholder="Adja meg a címet, ahova kiszállítsuk a terméket" autocomplete="street-address">
                            </div>
                        </div>
                        <div class="flex flex-row flex-align-c flex-justify-con-sb gap-1 small margin-top-a">
                            <span id="ch-ac-pv">
                                <span onclick="__chAction(-1)" id="ch-prev" class="flex-row flex-align-c gap-1 primary-bg primary-bg-hover border-soft-light padding-05 pointer user-select-none">
                                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M11.2657 11.4343L15.45 7.25C15.8642 6.83579 15.8642 6.16421 15.45 5.75C15.0358 5.33579 14.3642 5.33579 13.95 5.75L8.40712 11.2929C8.01659 11.6834 8.01659 12.3166 8.40712 12.7071L13.95 18.25C14.3642 18.6642 15.0358 18.6642 15.45 18.25C15.8642 17.8358 15.8642 17.1642 15.45 16.75L11.2657 12.5657C10.9533 12.2533 10.9533 11.7467 11.2657 11.4343Z" fill="currentColor"/></svg>
                                    <span>Előző</span>
                                </span>
                            </span>
                            <span id="ch-ac-nx">
                                <span onclick="__chAction(1)" id="ch-next" class="flex flex-row flex-align-c gap-1 primary-bg primary-bg-hover border-soft-light padding-05 pointer user-select-none">
                                    <span>Következő</span>
                                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M12.6343 12.5657L8.45001 16.75C8.0358 17.1642 8.0358 17.8358 8.45001 18.25C8.86423 18.6642 9.5358 18.6642 9.95001 18.25L15.4929 12.7071C15.8834 12.3166 15.8834 11.6834 15.4929 11.2929L9.95001 5.75C9.5358 5.33579 8.86423 5.33579 8.45001 5.75C8.0358 6.16421 8.0358 6.83579 8.45001 7.25L12.6343 11.4343C12.9467 11.7467 12.9467 12.2533 12.6343 12.5657Z" fill="currentColor"/></svg>
                                </span>
                            </span>
                        </div>
                    </div>
                </div>
            </div>
            <div id="ch-load">
                <div class="flex flex-col flex-align-c flex-justify-con-c gap-1 text-muted user-select-none">
                    <svg class='wizard_input_loading' xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="128" height="128" viewBox="0 0 24 24" version="1.1"><g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"><g><polygon points="0 0 24 0 24 24 0 24"/></g><path d="M12,4 L12,6 C8.6862915,6 6,8.6862915 6,12 C6,15.3137085 8.6862915,18 12,18 C15.3137085,18 18,15.3137085 18,12 C18,10.9603196 17.7360885,9.96126435 17.2402578,9.07513926 L18.9856052,8.09853149 C19.6473536,9.28117708 20,10.6161442 20,12 C20,16.418278 16.418278,20 12,20 C7.581722,20 4,16.418278 4,12 C4,7.581722 7.581722,4 12,4 Z" class="svg" fill-rule="nonzero" opacity="0.4" transform="translate(12.000000, 12.000000) scale(-1, 1) translate(-12.000000, -12.000000) "/></g></svg>
                    <span>Betöltés folyamatban</span>
                </div>
            </div>
        </div>
        <!-- <div class="flex flex-row flex-align-c flex-justify-con-sb gap-1 small">
            <span id="ch-ac-pv">
                <span onclick="__chAction(-1)" id="ch-prev" class="flex-row flex-align-c gap-1 primary-bg primary-bg-hover border-soft-light padding-05 pointer user-select-none">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M11.2657 11.4343L15.45 7.25C15.8642 6.83579 15.8642 6.16421 15.45 5.75C15.0358 5.33579 14.3642 5.33579 13.95 5.75L8.40712 11.2929C8.01659 11.6834 8.01659 12.3166 8.40712 12.7071L13.95 18.25C14.3642 18.6642 15.0358 18.6642 15.45 18.25C15.8642 17.8358 15.8642 17.1642 15.45 16.75L11.2657 12.5657C10.9533 12.2533 10.9533 11.7467 11.2657 11.4343Z" fill="currentColor"/></svg>
                    <span>Előző</span>
                </span>
            </span>
            <span id="ch-ac-nx">
                <span onclick="__chAction(1)" id="ch-next" class="flex flex-row flex-align-c gap-1 primary-bg primary-bg-hover border-soft-light padding-05 pointer user-select-none">
                    <span>Következő</span>
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M12.6343 12.5657L8.45001 16.75C8.0358 17.1642 8.0358 17.8358 8.45001 18.25C8.86423 18.6642 9.5358 18.6642 9.95001 18.25L15.4929 12.7071C15.8834 12.3166 15.8834 11.6834 15.4929 11.2929L9.95001 5.75C9.5358 5.33579 8.86423 5.33579 8.45001 5.75C8.0358 6.16421 8.0358 6.83579 8.45001 7.25L12.6343 11.4343C12.9467 11.7467 12.9467 12.2533 12.6343 12.5657Z" fill="currentColor"/></svg>
                </span>
            </span>
        </div> -->
    </div>
</main>
<script src="/assets/script/checkout/checkout.js" content-type="application/javascript"></script>
<script content-type="application/javascript">
    var currentTab = 0; __chshowTab(currentTab);

    function __chshowTab(n) {
    var x = document.getElementsByClassName("ch-tab"); x[n].style.display = "flex";
    if (n == 0) { document.getElementById("ch-prev").style.display = "none"; }
    else { document.getElementById("ch-prev").style.display = "flex"; }
    if (n == (x.length - 1)) { document.getElementById("ch-next").innerHTML = `<span>Megrendelés</span><svg width="20" height="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M12.6343 12.5657L8.45001 16.75C8.0358 17.1642 8.0358 17.8358 8.45001 18.25C8.86423 18.6642 9.5358 18.6642 9.95001 18.25L15.4929 12.7071C15.8834 12.3166 15.8834 11.6834 15.4929 11.2929L9.95001 5.75C9.5358 5.33579 8.86423 5.33579 8.45001 5.75C8.0358 6.16421 8.0358 6.83579 8.45001 7.25L12.6343 11.4343C12.9467 11.7467 12.9467 12.2533 12.6343 12.5657Z" fill="currentColor"/></svg>`; }
    else { document.getElementById("ch-next").innerHTML = `<span>Következő</span><svg width="20" height="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M12.6343 12.5657L8.45001 16.75C8.0358 17.1642 8.0358 17.8358 8.45001 18.25C8.86423 18.6642 9.5358 18.6642 9.95001 18.25L15.4929 12.7071C15.8834 12.3166 15.8834 11.6834 15.4929 11.2929L9.95001 5.75C9.5358 5.33579 8.86423 5.33579 8.45001 5.75C8.0358 6.16421 8.0358 6.83579 8.45001 7.25L12.6343 11.4343C12.9467 11.7467 12.9467 12.2533 12.6343 12.5657Z" fill="currentColor"/></svg>`; }
    __chfixStepIndicator(n)
    }

    function __chAction(n) {
    var x = document.getElementsByClassName("ch-tab");
    if (n == 1 && !__chValidateForm()) return false;
    x[currentTab].style.display = "none";
    currentTab = currentTab + n;
    if (currentTab >= x.length) {
        console.log('submitted');
        // document.getElementById("regForm").submit();
        return false;
    }
    __chshowTab(currentTab);
    }

    function __chValidateForm() {
    var x, y, i, valid = true;
    //   x = document.getElementsByClassName("ch-tab");
    //   y = x[currentTab].getElementsByTagName("input");
    //   for (i = 0; i < y.length; i++) {
    //     if (y[i].value == "") {
    //       y[i].className += " invalid";
    //       valid = false;
    //     }
    //   }
    //   if (valid) {
    //     document.getElementsByClassName("ch-step")[currentTab].className += " finish";
    //   }
    return valid;
    }

    function __chfixStepIndicator(n) {
    var i, x = document.getElementsByClassName("ch-step");
    for (i = 0; i < x.length; i++) {
        x[i].className = x[i].className.replace(" pr__item__active", "");
    }
    x[n].className += " pr__item__active";
    }
</script>
<?php require_once($_SERVER['DOCUMENT_ROOT'].'/includes/footer.php'); ?>