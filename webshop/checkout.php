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
                    <span class="ch-step text-primary">Számlázás</span>
                </div>
                <div class="flex flex-row flex-align-c flex-justify-con-c gap-05 padding-0-05 ch-hd-it">
                    <span class="flex flex-row flex-align-c flex-justify-con-c text-align-c circle background-bg padding-1 text-primary" style="width: .25rem; height: .25rem;">4</span>
                    <span class="ch-step text-primary">Fizetés</span>
                </div>
                <div class="flex flex-row flex-align-c flex-justify-con-c gap-05 padding-0-05 ch-hd-it">
                    <span class="flex flex-row flex-align-c flex-justify-con-c text-align-c circle background-bg padding-1 text-primary" style="width: .25rem; height: .25rem;">5</span>
                    <span class="ch-step text-primary">Rendelés</span>
                </div>
            </div>
        </div>
        <hr style="border: 1px solid var(--background);" class="w-100"><br>
        <div id="ch-con">
            <div id="chi-con">
                <div class="flex flex-row-d-col-m gap-1 w-fa">
                    <div id="ch-it-con" class="flex flex-col gap-1 w-fa w-70d-100m border-primary-right-d padding-05">
                        <div class="flex flex-col flex-align-c flex-justify-con-c gap-1 text-muted user-select-none">
                            <svg class='wizard_input_loading' xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="128" height="128" viewBox="0 0 24 24" version="1.1"><g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"><g><polygon points="0 0 24 0 24 24 0 24"/></g><path d="M12,4 L12,6 C8.6862915,6 6,8.6862915 6,12 C6,15.3137085 8.6862915,18 12,18 C15.3137085,18 18,15.3137085 18,12 C18,10.9603196 17.7360885,9.96126435 17.2402578,9.07513926 L18.9856052,8.09853149 C19.6473536,9.28117708 20,10.6161442 20,12 C20,16.418278 16.418278,20 12,20 C7.581722,20 4,16.418278 4,12 C4,7.581722 7.581722,4 12,4 Z" class="svg" fill-rule="nonzero" opacity="0.4" transform="translate(12.000000, 12.000000) scale(-1, 1) translate(-12.000000, -12.000000) "/></g></svg>
                            <span>Betöltés folyamatban</span>
                        </div>
                    </div>
                    <div class="flex flex-col gap-1 w-fa">
                        <div class="ch-tab flex-col gap-2 w-fa text-primary">
                            <div class="flex flex-col gap-05 w-fa">
                                <span class="text-primary bold">Teljes név</span>
                                <input type="text" value="<?= $fullname; ?>" class="w-fa text-primary border-soft background-bg padding-1-05 outline-none border-none" placeholder="Adja meg a teljes nevét" autocomplete="fullname">
                            </div>
                            <div class="flex flex-col gap-05 w-fa">
                                <span class="text-primary"><strong>Cég</strong> <em class="small-med">(opcionális)</em></span>
                                <input type="text" value="<?= $company; ?>" class="w-fa text-primary border-soft background-bg padding-1-05 outline-none border-none" placeholder="Adja meg a cége megnevezését" autocomplete="organization">
                            </div>
                            <div class="flex flex-col gap-05 w-fa">
                                <span class="text-primary bold">E-mail cím</span>
                                <input type="email" value="<?= $email; ?>" class="w-fa text-primary border-soft background-bg padding-1-05 outline-none border-none" placeholder="Adja meg az e-mail címét" autocomplete="email">
                            </div>
                            <div class="flex flex-col gap-05 w-fa">
                                <span class="text-primary bold">Telefonszám</span>
                                <input type="tel" value="<?= $phone; ?>" class="w-fa text-primary border-soft background-bg padding-1-05 outline-none border-none" placeholder="Adja meg a telefonszámát" autocomplete="tel">
                            </div>
                        </div>
                        <div class="ch-tab flex-col gap-2 w-fa text-primary">
                            <div class="flex flex-col gap-1 w-fa">
                                <span class="text-primary bold">Szállítási mód kiválasztása</span>
                                <div class="flex flex-col gap-1 outline-none border-none small text-muted user-select-none" style="accent-color: #3699FF;">
                                    <div class="flex flex-row flex-align-c gap-1">
                                        <input type="radio" id="gls" name="ship" ship-price="2000" value="gls" checked />
                                        <label for="gls">GLS - A csomag közvetlenül az otthonáig lesz szállítva - 2 000 Ft</label>
                                    </div>
                                    <div class="flex flex-row flex-align-c gap-1">
                                        <input type="radio" id="fedex" name="ship" ship-price="2000" value="fedex" />
                                        <label for="fedex">FedEx - A csomag közvetlenül az otthonáig lesz szállítva - 2 000 Ft</label>
                                    </div>
                                    <div class="flex flex-row flex-align-c gap-1">
                                        <input type="radio" id="dhl" name="ship" ship-price="2000" value="dhl" />
                                        <label for="dhl">DHL - A csomag közvetlenül az otthonáig lesz szállítva - 2 000 Ft</label>
                                    </div>
                                </div>
                            </div>
                            <div class="flex flex-col gap-05 w-fa">
                                <span class="text-primary bold">Irányítószám</span>
                                <input type="number" value="<?= $postal; ?>" max="9999" class="w-fa text-primary border-soft background-bg padding-1-05 outline-none border-none" placeholder="Adja meg az irányítószámát" autocomplete="postal-code">
                            </div>
                            <div class="flex flex-col gap-05 w-fa">
                                <span class="text-primary bold">Település</span>
                                <input type="text" value="<?= $settlement; ?>" class="w-fa text-primary border-soft background-bg padding-1-05 outline-none border-none" placeholder="Adja meg a települését" autocomplete="country-name">
                            </div>
                            <div class="flex flex-col gap-05 w-fa">
                                <span class="text-primary bold">Utca, házszám</span>
                                <input type="text" value="<?= $address ?>" class="w-fa text-primary border-soft background-bg padding-1-05 outline-none border-none" placeholder="Adja meg a címet, ahova kiszállítsuk a terméket" autocomplete="street-address">
                            </div>
                            <div class="flex flex-col gap-05 w-fa">
                                <span class="text-primary bold">Megjegyzés</span>
                                <textarea class="background-bg text-primary border-none outline-none border-soft w-fa resize-none mx-height-un height-un padding-05" rows="6" maxlength="2048" placeholder="Írja le röviden a futárnak a megjegyzését. Pl: 2. emelet"></textarea>
                            </div>
                        </div>
                        <div class="ch-tab flex-col gap-2 w-fa text-primary">
                            <div class="flex flex-col gap-05 w-fa">
                                <span class="text-primary bold">Irányítószám</span>
                                <input type="number" value="<?= $inv_postal; ?>" max="9999" class="w-fa text-primary border-soft background-bg padding-1-05 outline-none border-none" placeholder="Adja meg a számlázási irányítószámát" autocomplete="postal-code">
                            </div>
                            <div class="flex flex-col gap-05 w-fa">
                                <span class="text-primary bold">Település</span>
                                <input type="text" value="<?= $inv_settlement; ?>" class="w-fa text-primary border-soft background-bg padding-1-05 outline-none border-none" placeholder="Adja meg számlázási települését" autocomplete="country-name">
                            </div>
                            <div class="flex flex-col gap-05 w-fa">
                                <span class="text-primary bold">Utca, házszám</span>
                                <input type="text" value="<?= $inv_address; ?>" class="w-fa text-primary border-soft background-bg padding-1-05 outline-none border-none" placeholder="Adja meg a számlázási címét" autocomplete="address-line1">
                            </div>
                            <div class="flex flex-col gap-05 w-fa">
                                <span class="text-primary bold">Adószám</span>
                                <input type="number" value="<?= $inv_tax; ?>" class="w-fa text-primary border-soft background-bg padding-1-05 outline-none border-none" placeholder="Adja meg a számlázási adószámát">
                            </div>
                        </div>
                        <div class="ch-tab flex-col gap-2 w-fa text-primary">
                            <div class="flex flex-col gap-1 w-fa">
                                <div class="flex flex-row flex-align-c flex-justify-con-sb">
                                    <span class="text-primary bold large">Fizetési lehetőségek</span>
                                </div>
                                <span class="small text-muted">Kérjük, válassza ki a kívánt fizetési módot.</span>
                                <div class="flex flex-col gap-1">
                                    <div class="flex flex-row flex-wrap flex-justify-con-c gap-1">
                                    <?php $uid = $_SESSION['id'];
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
                                                            if ($stmt->num_rows < 1) { echo '<span class="splash primary-bg primary-bg-hover padding-05 border-soft-light text-secondary smaller user-select-none pointer" id="card_'.$card['cid'].'" onclick="setPaymentMethod(this.id);">Használ</span>'; }
                                                        }
                                                        echo '
                                                        </div>
                                                    </div>
                                                    <div class="flex flex-row flex-align-c gap-1">
                                                        <div class="flex flex-row flex-align-c gap-1">
                                                            ';
                                                            if ($stmt = $con->prepare('SELECT * FROM customers__card__primary WHERE uid = ? AND cid LIKE ?')) {
                                                                $stmt->bind_param('is', $uid, $card['cid']);$stmt->execute();$stmt->store_result(); 
                                                                if ($stmt->num_rows < 1) { echo '<div class="flex flex-col flex-align-c flex-justify-con-c border-soft item-bg padding-05 box-shadow-sh">'; }
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
                            <div class="flex flex-col gap-1">
                                <span class="text-primary bold">Utalványok</span>
                                <div class="flex flex-col flex-align-fs flex-justify-con-c gap-025 w-fa">
                                    <div class="flex flex-row gap-05 w-fa">
                                        <input type="text" id="voucher-input" class="w-fa text-primary border-soft background-bg padding-1-05 outline-none border-none" placeholder="XXXXXXXX">
                                        <span  class="splash flex flex-row flex-align-c w-fc gap-1 primary-bg primary-bg-hover border-soft-light padding-05 pointer user-select-none">
                                            <div class="flex flex-row flex-align-c flex-justify-con-c gap-1 w-fa" id="vd-vc-ac-cn" onclick="validateVoucher()">
                                                <span></span>
                                                <span class="flex flex-row flex-align-c gap-05" id="av-ac-ic-cn">Beváltás</span>
                                                <span></span>
                                            </div>
                                        </span>
                                    </div>
                                    <span id="vc-ec-cn"></span>
                                </div>
                            </div>
                        </div>
                        <div class="ch-tab flex-col gap-2 w-fa text-primary">
                            <span class="text-primary bold large">Összesítés</span>
                            <div class="flex flex-row w-fa gap-1">
                                <div class="flex flex-col gap-05 w-50d-fam ">
                                    <span class="bold small">Számlázás</span>
                                    <div class="flex flex-col gap-025 small-med">
                                        <span>Ászity Martin</span>
                                        <span>Minta Kft</span>
                                        <span>Minta utca 3</span>
                                        <span>6000 Kecskemet</span>
                                        <span>123456789</span>
                                        <span>martinaszity@icloud.com</span>
                                        <span>06301234567</span>
                                    </div>
                                </div>
                                <div class="flex flex-col gap-05 w-50d-fam ">
                                    <span class="bold small">Szállítás</span>
                                    <div class="flex flex-col gap-025 small-med">
                                        <span>Aszity Martin</span>
                                        <span>Minta Kft</span>
                                        <span>Minta utca 3</span>
                                        <span>6000 Kecskemet</span>
                                    </div>
                                </div>
                            </div>
                            <div class="flex flex-col gap-1">
                                <div class="flex flex-col">
                                    <div class="flex flex-row flex-align-c gap-1">
                                        <label class="cst-chb-lbl">
                                            <input type="checkbox" class="absolute" name="product-review-auth" id="product-review-auth">
                                            <span class="cst-checkbox"></span>
                                        </label>
                                        <span class="text-primary small" style="line-height: 2rem;">Hírlevél</span>
                                    </div>
                                    <span class="text-muted small-med">Feliratkozás a hírlevélre, hogy értesűljön az új ajánlatainkról.</span>
                                </div>
                                <div class="flex flex-col">
                                    <div class="flex flex-row flex-align-c gap-1">
                                        <label class="cst-chb-lbl">
                                            <input type="checkbox" class="absolute" name="product-review-auth" id="product-review-auth">
                                            <span class="cst-checkbox"></span>
                                        </label>
                                        <span class="text-primary small" style="line-height: 2rem;">Általános Szerződési Feltételek</span>
                                    </div>
                                    <span class="text-muted small-med">Ezúton megerősítem, hogy az általam megadott információk helyesek, és elfogadom az általános szerődési feltételeket</span>
                                </div>
                            </div>
                        </div>
                        <div class="flex flex-row flex-align-c flex-justify-con-sb gap-1 small margin-top-a">
                            <span id="ch-ac-pv">
                                <span onclick="__chAction(-1)" id="ch-prev" class="splash flex-row flex-align-c gap-1 primary-bg primary-bg-hover border-soft-light padding-05 pointer user-select-none">
                                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M11.2657 11.4343L15.45 7.25C15.8642 6.83579 15.8642 6.16421 15.45 5.75C15.0358 5.33579 14.3642 5.33579 13.95 5.75L8.40712 11.2929C8.01659 11.6834 8.01659 12.3166 8.40712 12.7071L13.95 18.25C14.3642 18.6642 15.0358 18.6642 15.45 18.25C15.8642 17.8358 15.8642 17.1642 15.45 16.75L11.2657 12.5657C10.9533 12.2533 10.9533 11.7467 11.2657 11.4343Z" fill="currentColor"/></svg>
                                    <span>Előző</span>
                                </span>
                            </span>
                            <span id="ch-ac-nx">
                                <span onclick="__chAction(1)" id="ch-next" class="splash flex flex-row flex-align-c gap-1 primary-bg primary-bg-hover border-soft-light padding-05 pointer user-select-none">
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