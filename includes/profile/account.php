<?php require_once($_SERVER['DOCUMENT_ROOT'].'/includes/inc.php'); $uid = $_SESSION['id'];
$pers_sql = "SELECT customers.email, customers.fullname, customers__inv.settlement AS 'inv__settlement', customers__inv.address AS 'inv__address', customers__inv.postal AS 'inv__postal', customers__ship.*, customers__lang.language, customers__lang.capital, customers__lang.offset, u__password.factor FROM customers INNER JOIN customers__lang ON customers__lang.uid = customers.id INNER JOIN u__password ON u__password.uid = customers.id INNER JOIN customers__inv ON customers__inv.uid = customers.id INNER JOIN customers__ship ON customers__ship.uid = customers.id WHERE customers.id = $uid AND customers__lang.uid = $uid AND u__password.uid = $uid AND customers__inv.uid = $uid AND customers__ship.uid = $uid"; $pers_res = $con-> query($pers_sql);
if ($pers_res-> num_rows > 0) { $datas = $pers_res-> fetch_assoc(); }
?>
<div class="flex flex-row-d-col-m gap-1">
    <div class="flex flex-col w-fa gap-1 border-soft item-bg box-shadow padding-1">
        <div class="flex flex-row flex-align-c flex-justify-con-sb">
            <div class="flex flex-col">
                <span class="text-primary small bold">Fiók Információk</span>
                <span class="text-secondary smaller-light">Szerkessze fiókjához tartozó adatokat.</span>
            </div>
            <div class="flex flex-row gap-1">
                <span class="primary-bg primary-bg-hover border-soft-light padding-05-1 small-med pointer user-select-none flex flex-col flex-align-c flex-justify-con-c" id="prsv__account">Mentés</span>
                <span class="text-primary pointer user-select-none small-med flex flex-col flex-align-c flex-justify-con-c" id="prcc__account">Mégsem</span>
            </div>
        </div><hr style="border: 1px solid var(--background);" class="w-fa">
        <div class="flex flex-col gap-2 w-70d-100m">
            <div class="flex flex-col gap-1">
                <div class="flex flex-row">
                    <span class="text-primary bold">Fiók adatok</span>
                </div>
                <div class="flex flex-row-d-col-m flex-align-c prst__row" data-key="email" data-title="Email cím">
                    <span class="text-primary small w-20d-100m prst__trig">Email cím</span>
                    <input type="email" data-key="email" class="w-60d-90m text-primary border-soft background-bg padding-1-05 outline-none border-none" name="chpr__email" id="chpr__email" value="<?php echo $datas['email']; ?>" placeholder="mintamisi@email.com" autocomplete='email' />
                </div>
                <div class="flex flex-row-d-col-m flex-align-c prst__row" data-key="language" data-title="Nyelv">
                    <span class="text-primary small w-20d-100m prst__trig">Nyelv beállítása</span>
                    <div class="flex flex-row w-63d-93m">
                        <select style="-webkit-appearance: none;" class="w-100 text-primary border-soft background-bg padding-1-05 outline-none border-none" id="chpr__language">
                            <option value="id">Bahasa Indonesia - Indonesian</option>
                            <option value="msa">Bahasa Melayu - Malay</option>
                            <option value="ca">Català - Catalan</option>
                            <option value="cs">Čeština - Czech</option>
                            <option value="da">Dansk - Danish</option>
                            <option value="de">Deutsch - German</option>
                            <option value="en">English</option>
                            <option value="en-gb">English UK - British English</option>
                            <option value="es">Español - Spanish</option>
                            <option value="eu">Euskara - Basque (beta)</option>
                            <option value="fil">Filipino</option>
                            <option value="fr">Français - French</option>
                            <option value="ga">Gaeilge - Irish (beta)</option>
                            <option value="gl">Galego - Galician (beta)</option>
                            <option value="hr">Hrvatski - Croatian</option>
                            <option value="it">Italiano - Italian</option>
                            <option value="hu">Magyar - Hungarian</option>
                            <option value="nl">Nederlands - Dutch</option>
                            <option value="no">Norsk - Norwegian</option>
                            <option value="pl">Polski - Polish</option>
                            <option value="pt">Português - Portuguese</option>
                            <option value="ro">Română - Romanian</option>
                            <option value="sk">Slovenčina - Slovak</option>
                            <option value="fi">Suomi - Finnish</option>
                            <option value="sv">Svenska - Swedish</option>
                            <option value="vi">Tiếng Việt - Vietnamese</option>
                            <option value="tr">Türkçe - Turkish</option>
                            <option value="el">Ελληνικά - Greek</option>
                            <option value="bg">Български език - Bulgarian</option>
                            <option value="ru">Русский - Russian</option>
                            <option value="sr">Српски - Serbian</option>
                            <option value="uk">Українська мова - Ukrainian</option>
                            <option value="he">עִבְרִית - Hebrew</option>
                            <option value="ur">اردو - Urdu (beta)</option>
                            <option value="ar">العربية - Arabic</option>
                            <option value="fa">فارسی - Persian</option>
                            <option value="mr">मराठी - Marathi</option>
                            <option value="hi">हिन्दी - Hindi</option>
                            <option value="bn">বাংলা - Bangla</option>
                            <option value="gu">ગુજરાતી - Gujarati</option>
                            <option value="ta">தமிழ் - Tamil</option>
                            <option value="kn">ಕನ್ನಡ - Kannada</option>
                            <option value="th">ภาษาไทย - Thai</option>
                            <option value="ko">한국어 - Korean</option>
                            <option value="ja">日本語 - Japanese</option>
                            <option value="zh-cn">简体中文 - Simplified Chinese</option>
                            <option value="zh-tw">繁體中文 - Traditional Chinese</option>
                        </select><script>var lang__select = document.getElementById("chpr__language"); for (let i = 0; i < lang__select.options.length; i++) { if (lang__select.options[i].value.length > 0) { if (lang__select.options[i].value === "<?php echo $datas['language']; ?>") { lang__select.options[i].setAttribute("selected", "selected"); } } }</script>
                    </div>
                </div>
                <div class="flex flex-row-d-col-m flex-align-c prst__row" data-key="offset" data-title="Eltolódás">
                    <div data-key="capital" data-title="Főváros" class="hidden"></div>
                    <span class="text-primary small w-20d-100m prst__trig">Időzóna beállítása</span>
                    <div class="flex flex-row w-63d-93m">
                        <select style="-webkit-appearance: none; width: 100%;" class="w-100 text-primary border-soft background-bg padding-1-05 outline-none border-none" id="chpr__offset">
                            <option data-offset="-39600" value="International Date Line West">(GMT-11:00) International Date Line West</option>
                            <option data-offset="-39600" value="Midway Island">(GMT-11:00) Midway Island</option>
                            <option data-offset="-39600" value="Samoa">(GMT-11:00) Samoa</option>
                            <option data-offset="-36000" value="Hawaii">(GMT-10:00) Hawaii</option>
                            <option data-offset="-28800" value="Alaska">(GMT-08:00) Alaska</option>
                            <option data-offset="-25200" value="Pacific Time (US &amp; Canada)">(GMT-07:00) Pacific Time (US &amp; Canada)</option>
                            <option data-offset="-25200" value="Tijuana">(GMT-07:00) Tijuana</option>
                            <option data-offset="-25200" value="Arizona">(GMT-07:00) Arizona</option>
                            <option data-offset="-21600" value="Mountain Time (US &amp; Canada)">(GMT-06:00) Mountain Time (US &amp; Canada)</option>
                            <option data-offset="-21600" value="Chihuahua">(GMT-06:00) Chihuahua</option>
                            <option data-offset="-21600" value="Mazatlan">(GMT-06:00) Mazatlan</option>
                            <option data-offset="-21600" value="Saskatchewan">(GMT-06:00) Saskatchewan</option>
                            <option data-offset="-21600" value="Central America">(GMT-06:00) Central America</option>
                            <option data-offset="-18000" value="Central Time (US &amp; Canada)">(GMT-05:00) Central Time (US &amp; Canada)</option>
                            <option data-offset="-18000" value="Guadalajara">(GMT-05:00) Guadalajara</option>
                            <option data-offset="-18000" value="Mexico City">(GMT-05:00) Mexico City</option>
                            <option data-offset="-18000" value="Monterrey">(GMT-05:00) Monterrey</option>
                            <option data-offset="-18000" value="Bogota">(GMT-05:00) Bogota</option>
                            <option data-offset="-18000" value="Lima">(GMT-05:00) Lima</option>
                            <option data-offset="-18000" value="Quito">(GMT-05:00) Quito</option>
                            <option data-offset="-14400" value="Eastern Time (US &amp; Canada)">(GMT-04:00) Eastern Time (US &amp; Canada)</option>
                            <option data-offset="-14400" value="Indiana (East)">(GMT-04:00) Indiana (East)</option>
                            <option data-offset="-14400" value="Caracas">(GMT-04:00) Caracas</option>
                            <option data-offset="-14400" value="La Paz">(GMT-04:00) La Paz</option>
                            <option data-offset="-14400" value="Georgetown">(GMT-04:00) Georgetown</option>
                            <option data-offset="-10800" value="Atlantic Time (Canada)">(GMT-03:00) Atlantic Time (Canada)</option>
                            <option data-offset="-10800" value="Santiago">(GMT-03:00) Santiago</option>
                            <option data-offset="-10800" value="Brasilia">(GMT-03:00) Brasilia</option>
                            <option data-offset="-10800" value="Buenos Aires">(GMT-03:00) Buenos Aires</option>
                            <option data-offset="-9000" value="Newfoundland">(GMT-02:30) Newfoundland</option>
                            <option data-offset="-7200" value="Greenland">(GMT-02:00) Greenland</option>
                            <option data-offset="-7200" value="Mid-Atlantic">(GMT-02:00) Mid-Atlantic</option>
                            <option data-offset="-3600" value="Cape Verde Is.">(GMT-01:00) Cape Verde Is.</option>
                            <option data-offset="0" value="Azores">(GMT) Azores</option>
                            <option data-offset="0" value="Monrovia">(GMT) Monrovia</option>
                            <option data-offset="0" value="UTC">(GMT) UTC</option>
                            <option data-offset="3600" value="Dublin">(GMT+01:00) Dublin</option>
                            <option data-offset="3600" value="Edinburgh">(GMT+01:00) Edinburgh</option>
                            <option data-offset="3600" value="Lisbon">(GMT+01:00) Lisbon</option>
                            <option data-offset="3600" value="London">(GMT+01:00) London</option>
                            <option data-offset="3600" value="Casablanca">(GMT+01:00) Casablanca</option>
                            <option data-offset="3600" value="West Central Africa">(GMT+01:00) West Central Africa</option>
                            <option data-offset="7200" value="Belgrade">(GMT+02:00) Belgrade</option>
                            <option data-offset="7200" value="Bratislava">(GMT+02:00) Bratislava</option>
                            <option data-offset="7200" value="Budapest">(GMT+02:00) Budapest</option>
                            <option data-offset="7200" value="Ljubljana">(GMT+02:00) Ljubljana</option>
                            <option data-offset="7200" value="Prague">(GMT+02:00) Prague</option>
                            <option data-offset="7200" value="Sarajevo">(GMT+02:00) Sarajevo</option>
                            <option data-offset="7200" value="Skopje">(GMT+02:00) Skopje</option>
                            <option data-offset="7200" value="Warsaw">(GMT+02:00) Warsaw</option>
                            <option data-offset="7200" value="Zagreb">(GMT+02:00) Zagreb</option>
                            <option data-offset="7200" value="Brussels">(GMT+02:00) Brussels</option>
                            <option data-offset="7200" value="Copenhagen">(GMT+02:00) Copenhagen</option>
                            <option data-offset="7200" value="Madrid">(GMT+02:00) Madrid</option>
                            <option data-offset="7200" value="Paris">(GMT+02:00) Paris</option>
                            <option data-offset="7200" value="Amsterdam">(GMT+02:00) Amsterdam</option>
                            <option data-offset="7200" value="Berlin">(GMT+02:00) Berlin</option>
                            <option data-offset="7200" value="Bern">(GMT+02:00) Bern</option>
                            <option data-offset="7200" value="Rome">(GMT+02:00) Rome</option>
                            <option data-offset="7200" value="Stockholm">(GMT+02:00) Stockholm</option>
                            <option data-offset="7200" value="Vienna">(GMT+02:00) Vienna</option>
                            <option data-offset="7200" value="Cairo">(GMT+02:00) Cairo</option>
                            <option data-offset="7200" value="Harare">(GMT+02:00) Harare</option>
                            <option data-offset="7200" value="Pretoria">(GMT+02:00) Pretoria</option>
                            <option data-offset="10800" value="Bucharest">(GMT+03:00) Bucharest</option>
                            <option data-offset="10800" value="Helsinki">(GMT+03:00) Helsinki</option>
                            <option data-offset="10800" value="Kiev">(GMT+03:00) Kiev</option>
                            <option data-offset="10800" value="Kyiv">(GMT+03:00) Kyiv</option>
                            <option data-offset="10800" value="Riga">(GMT+03:00) Riga</option>
                            <option data-offset="10800" value="Sofia">(GMT+03:00) Sofia</option>
                            <option data-offset="10800" value="Tallinn">(GMT+03:00) Tallinn</option>
                            <option data-offset="10800" value="Vilnius">(GMT+03:00) Vilnius</option>
                            <option data-offset="10800" value="Athens">(GMT+03:00) Athens</option>
                            <option data-offset="10800" value="Istanbul">(GMT+03:00) Istanbul</option>
                            <option data-offset="10800" value="Minsk">(GMT+03:00) Minsk</option>
                            <option data-offset="10800" value="Jerusalem">(GMT+03:00) Jerusalem</option>
                            <option data-offset="10800" value="Moscow">(GMT+03:00) Moscow</option>
                            <option data-offset="10800" value="St. Petersburg">(GMT+03:00) St. Petersburg</option>
                            <option data-offset="10800" value="Volgograd">(GMT+03:00) Volgograd</option>
                            <option data-offset="10800" value="Kuwait">(GMT+03:00) Kuwait</option>
                            <option data-offset="10800" value="Riyadh">(GMT+03:00) Riyadh</option>
                            <option data-offset="10800" value="Nairobi">(GMT+03:00) Nairobi</option>
                            <option data-offset="10800" value="Baghdad">(GMT+03:00) Baghdad</option>
                            <option data-offset="14400" value="Abu Dhabi">(GMT+04:00) Abu Dhabi</option>
                            <option data-offset="14400" value="Muscat">(GMT+04:00) Muscat</option>
                            <option data-offset="14400" value="Baku">(GMT+04:00) Baku</option>
                            <option data-offset="14400" value="Tbilisi">(GMT+04:00) Tbilisi</option>
                            <option data-offset="14400" value="Yerevan">(GMT+04:00) Yerevan</option>
                            <option data-offset="16200" value="Tehran">(GMT+04:30) Tehran</option>
                            <option data-offset="16200" value="Kabul">(GMT+04:30) Kabul</option>
                            <option data-offset="18000" value="Ekaterinburg">(GMT+05:00) Ekaterinburg</option>
                            <option data-offset="18000" value="Islamabad">(GMT+05:00) Islamabad</option>
                            <option data-offset="18000" value="Karachi">(GMT+05:00) Karachi</option>
                            <option data-offset="18000" value="Tashkent">(GMT+05:00) Tashkent</option>
                            <option data-offset="19800" value="Chennai">(GMT+05:30) Chennai</option>
                            <option data-offset="19800" value="Kolkata">(GMT+05:30) Kolkata</option>
                            <option data-offset="19800" value="Mumbai">(GMT+05:30) Mumbai</option>
                            <option data-offset="19800" value="New Delhi">(GMT+05:30) New Delhi</option>
                            <option data-offset="19800" value="Sri Jayawardenepura">(GMT+05:30) Sri Jayawardenepura</option>
                            <option data-offset="20700" value="Kathmandu">(GMT+05:45) Kathmandu</option>
                            <option data-offset="21600" value="Astana">(GMT+06:00) Astana</option>
                            <option data-offset="21600" value="Dhaka">(GMT+06:00) Dhaka</option>
                            <option data-offset="21600" value="Almaty">(GMT+06:00) Almaty</option>
                            <option data-offset="21600" value="Urumqi">(GMT+06:00) Urumqi</option>
                            <option data-offset="23400" value="Rangoon">(GMT+06:30) Rangoon</option>
                            <option data-offset="25200" value="Novosibirsk">(GMT+07:00) Novosibirsk</option>
                            <option data-offset="25200" value="Bangkok">(GMT+07:00) Bangkok</option>
                            <option data-offset="25200" value="Hanoi">(GMT+07:00) Hanoi</option>
                            <option data-offset="25200" value="Jakarta">(GMT+07:00) Jakarta</option>
                            <option data-offset="25200" value="Krasnoyarsk">(GMT+07:00) Krasnoyarsk</option>
                            <option data-offset="28800" value="Beijing">(GMT+08:00) Beijing</option>
                            <option data-offset="28800" value="Chongqing">(GMT+08:00) Chongqing</option>
                            <option data-offset="28800" value="Hong Kong">(GMT+08:00) Hong Kong</option>
                            <option data-offset="28800" value="Kuala Lumpur">(GMT+08:00) Kuala Lumpur</option>
                            <option data-offset="28800" value="Singapore">(GMT+08:00) Singapore</option>
                            <option data-offset="28800" value="Taipei">(GMT+08:00) Taipei</option>
                            <option data-offset="28800" value="Perth">(GMT+08:00) Perth</option>
                            <option data-offset="28800" value="Irkutsk">(GMT+08:00) Irkutsk</option>
                            <option data-offset="28800" value="Ulaan Bataar">(GMT+08:00) Ulaan Bataar</option>
                            <option data-offset="32400" value="Seoul">(GMT+09:00) Seoul</option>
                            <option data-offset="32400" value="Osaka">(GMT+09:00) Osaka</option>
                            <option data-offset="32400" value="Sapporo">(GMT+09:00) Sapporo</option>
                            <option data-offset="32400" value="Tokyo">(GMT+09:00) Tokyo</option>
                            <option data-offset="32400" value="Yakutsk">(GMT+09:00) Yakutsk</option>
                            <option data-offset="34200" value="Darwin">(GMT+09:30) Darwin</option>
                            <option data-offset="34200" value="Adelaide">(GMT+09:30) Adelaide</option>
                            <option data-offset="36000" value="Canberra">(GMT+10:00) Canberra</option>
                            <option data-offset="36000" value="Melbourne">(GMT+10:00) Melbourne</option>
                            <option data-offset="36000" value="Sydney">(GMT+10:00) Sydney</option>
                            <option data-offset="36000" value="Brisbane">(GMT+10:00) Brisbane</option>
                            <option data-offset="36000" value="Hobart">(GMT+10:00) Hobart</option>
                            <option data-offset="36000" value="Vladivostok">(GMT+10:00) Vladivostok</option>
                            <option data-offset="36000" value="Guam">(GMT+10:00) Guam</option>
                            <option data-offset="36000" value="Port Moresby">(GMT+10:00) Port Moresby</option>
                            <option data-offset="36000" value="Solomon Is.">(GMT+10:00) Solomon Is.</option>
                            <option data-offset="39600" value="Magadan">(GMT+11:00) Magadan</option>
                            <option data-offset="39600" value="New Caledonia">(GMT+11:00) New Caledonia</option>
                            <option data-offset="43200" value="Fiji">(GMT+12:00) Fiji</option>
                            <option data-offset="43200" value="Kamchatka">(GMT+12:00) Kamchatka</option>
                            <option data-offset="43200" value="Marshall Is.">(GMT+12:00) Marshall Is.</option>
                            <option data-offset="43200" value="Auckland">(GMT+12:00) Auckland</option>
                            <option data-offset="43200" value="Wellington">(GMT+12:00) Wellington</option>
                            <option data-offset="46800" value="Nuku'alofa">(GMT+13:00) Nuku'alofa</option>
                        </select><script>var offset__select = document.getElementById("chpr__offset"); for (let i = 0; i < offset__select.options.length; i++) { if (offset__select.options[i].dataset.offset.length > 0) { if (offset__select.options[i].dataset.offset === "<?php echo $datas['offset']; ?>" && offset__select.options[i].value === "<?php echo $datas['capital']; ?>") { offset__select.options[i].setAttribute("selected", "selected"); } } }</script>
                    </div>
                </div>
            </div>
        </div>
        <div class="flex flex-col gap-1">
            <div class="flex flex-row">
                <span class="text-primary bold">Mentett kártyáim</span>
            </div>
            <div class="flex flex-row flex-wrap flex-align-c flex-justify-con-c gap-1">
                <?php
                $pr_sql = "SELECT customers__card.cid AS 'cid', customers__card.cardname AS 'cardname', customers__card.cardnum AS 'shortnum', customers__card.expiry AS 'expiry', customers__card.value,customers__card__info.holder, customers__card__info.type, customers__card__info.provider
                FROM customers__card INNER JOIN customers__card__info ON customers__card__info.cid = customers__card.cid WHERE customers__card.uid = $uid AND customers__card__info.uid = $uid"; $pr_res = $con-> query($pr_sql);
                if ($pr_res-> num_rows > 0) { $subtot = 0;
                    while ($card = $pr_res-> fetch_assoc()) {
                        echo '
                        <div class="flex flex-col gap-1 border-soft border-secondary-dotted padding-105 w-40d-100m" style="height: 84px;">
                            <div class="flex flex-row flex-align-c flex-justify-con-sb gap-05">
                                <div class="flex flex-row flex-align-c gap-1">
                                    <span class="text-primary bold">'.$card['holder'].'</span>
                                    ';
                                    if ($stmt = $con->prepare('SELECT * FROM customers__card__primary WHERE uid = ? AND cid LIKE ?')) {
                                        $stmt->bind_param('is', $uid, $card['cid']);$stmt->execute();$stmt->store_result(); 
                                        if ($stmt->num_rows > 0) { echo '<span class="label label-primary border-soft-light">Elsődleges</span>'; }
                                    }
                                    echo '
                                </div>
                                <div class="flex">
                                    <span class="background-bg padding-05 border-soft text-secondary smaller user-select-none pointer" onclick="gotoCredit();">Megtekintés</span>
                                </div>
                            </div>
                            <div class="flex flex-row flex-align-c gap-1">
                                <div class="flex flex-row flex-align-c gap-1">
                                    <div class="flex flex-col flex-align-c flex-justify-con-c border-soft background-bg padding-05">
                                    ';
                                    if ($card['cardname'] == 'Mappa+ kártya') { echo '<svg xmlns="http://www.w3.org/2000/svg" width="48" height="24" viewBox="0 0 24 24" fill="none"><path d="M22 7H2V11H22V7Z" class="svg"></path><path opacity="0.3" d="M21 19H3C2.4 19 2 18.6 2 18V6C2 5.4 2.4 5 3 5H21C21.6 5 22 5.4 22 6V18C22 18.6 21.6 19 21 19ZM14 14C14 13.4 13.6 13 13 13H5C4.4 13 4 13.4 4 14C4 14.6 4.4 15 5 15H13C13.6 15 14 14.6 14 14ZM16 15.5C16 16.3 16.7 17 17.5 17H18.5C19.3 17 20 16.3 20 15.5C20 14.7 19.3 14 18.5 14H17.5C16.7 14 16 14.7 16 15.5Z" class="svg"></path></svg>'; }
                                    if ($card['cardname'] == 'Mastercard') { echo '<svg xmlns="http://www.w3.org/2000/svg" width="48" height="24" viewBox="0 0 80 48" fill="none"><rect width="80" height="48" rx="6"></rect><g clip-path="url(#clip0)"><path d="M47.129 35.9651H33.8779V12.2273H47.1292L47.129 35.9651Z" fill="#FF5F00"></path><path d="M34.718 24.096C34.718 19.2808 36.9798 14.9914 40.502 12.2271C37.8359 10.1316 34.5384 8.99434 31.1432 8.99935C22.7796 8.99935 16 15.7583 16 24.096C16 32.4338 22.7796 39.1927 31.1432 39.1927C34.5385 39.1978 37.8361 38.0605 40.5022 35.9649C36.9803 33.2011 34.718 28.9115 34.718 24.096Z" fill="#EB001B"></path><path d="M65.0061 24.0967C65.0061 32.4345 58.2265 39.1934 49.8629 39.1934C46.4673 39.1984 43.1693 38.0611 40.5027 35.9656C44.0258 33.2013 46.2876 28.9121 46.2876 24.0967C46.2876 19.2813 44.0258 14.9921 40.5027 12.2278C43.1693 10.1324 46.4671 8.9951 49.8627 9.00002C58.2263 9.00002 65.0059 15.7589 65.0059 24.0967" fill="#F79E1B"></path></g><defs><clipPath id="clip0"><rect width="49" height="38" fill="white" transform="translate(16 9)"></rect></clipPath></defs></svg>'; }
                                    if ($card['cardname'] == 'Visa') { echo '<svg xmlns="http://www.w3.org/2000/svg" width="48" height="24" viewBox="0 0 80 48" fill="none"><rect width="80" height="48" rx="6"></rect><path d="M36.71 33.6833H32.059L34.9658 15.328H39.6174L36.71 33.6833ZM28.1462 15.328L23.712 27.9529L23.1873 25.2343L23.1878 25.2353L21.6228 16.9807C21.6228 16.9807 21.4336 15.328 19.4165 15.328H12.086L12 15.6388C12 15.6388 14.2417 16.118 16.8652 17.7368L20.906 33.6838H25.7521L33.1518 15.328H28.1462V15.328ZM64.7293 33.6833H69L65.2765 15.3275H61.5376C59.8111 15.3275 59.3906 16.6954 59.3906 16.6954L52.4538 33.6833H57.3023L58.2719 30.9568H64.1845L64.7293 33.6833ZM59.6113 27.1904L62.0552 20.3214L63.43 27.1904H59.6113ZM52.8175 19.742L53.4813 15.8003C53.4813 15.8003 51.4331 15 49.298 15C46.9899 15 41.5088 16.0365 41.5088 21.0765C41.5088 25.8186 47.9418 25.8775 47.9418 28.3683C47.9418 30.8591 42.1716 30.4128 40.2673 28.8421L39.5758 32.9635C39.5758 32.9635 41.6526 34 44.8257 34C47.9996 34 52.7879 32.3115 52.7879 27.7158C52.7879 22.9433 46.297 22.499 46.297 20.424C46.2975 18.3486 50.8272 18.6152 52.8175 19.742V19.742Z" fill="#2566AF"></path><path d="M23.1878 25.2348L21.6228 16.9802C21.6228 16.9802 21.4336 15.3275 19.4165 15.3275H12.086L12 15.6383C12 15.6383 15.5233 16.3886 18.9028 19.1995C22.1341 21.8862 23.1878 25.2348 23.1878 25.2348Z" fill="#E6A540"></path></svg>'; }
                                    if ($card['cardname'] == 'PayPal') { echo '<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" id="Layer_1" x="0px" y="0px" width="48" height="24" viewBox="0 0 124 33" enable-background="new 0 0 124 33" xml:space="preserve"><path fill="#253B80" d="M46.211,6.749h-6.839c-0.468,0-0.866,0.34-0.939,0.802l-2.766,17.537c-0.055,0.346,0.213,0.658,0.564,0.658  h3.265c0.468,0,0.866-0.34,0.939-0.803l0.746-4.73c0.072-0.463,0.471-0.803,0.938-0.803h2.165c4.505,0,7.105-2.18,7.784-6.5  c0.306-1.89,0.013-3.375-0.872-4.415C50.224,7.353,48.5,6.749,46.211,6.749z M47,13.154c-0.374,2.454-2.249,2.454-4.062,2.454  h-1.032l0.724-4.583c0.043-0.277,0.283-0.481,0.563-0.481h0.473c1.235,0,2.4,0,3.002,0.704C47.027,11.668,47.137,12.292,47,13.154z"/><path fill="#253B80" d="M66.654,13.075h-3.275c-0.279,0-0.52,0.204-0.563,0.481l-0.145,0.916l-0.229-0.332  c-0.709-1.029-2.29-1.373-3.868-1.373c-3.619,0-6.71,2.741-7.312,6.586c-0.313,1.918,0.132,3.752,1.22,5.031  c0.998,1.176,2.426,1.666,4.125,1.666c2.916,0,4.533-1.875,4.533-1.875l-0.146,0.91c-0.055,0.348,0.213,0.66,0.562,0.66h2.95  c0.469,0,0.865-0.34,0.939-0.803l1.77-11.209C67.271,13.388,67.004,13.075,66.654,13.075z M62.089,19.449  c-0.316,1.871-1.801,3.127-3.695,3.127c-0.951,0-1.711-0.305-2.199-0.883c-0.484-0.574-0.668-1.391-0.514-2.301  c0.295-1.855,1.805-3.152,3.67-3.152c0.93,0,1.686,0.309,2.184,0.892C62.034,17.721,62.232,18.543,62.089,19.449z"/><path fill="#253B80" d="M84.096,13.075h-3.291c-0.314,0-0.609,0.156-0.787,0.417l-4.539,6.686l-1.924-6.425  c-0.121-0.402-0.492-0.678-0.912-0.678h-3.234c-0.393,0-0.666,0.384-0.541,0.754l3.625,10.638l-3.408,4.811  c-0.268,0.379,0.002,0.9,0.465,0.9h3.287c0.312,0,0.604-0.152,0.781-0.408L84.564,13.97C84.826,13.592,84.557,13.075,84.096,13.075z  "/><path fill="#179BD7" d="M94.992,6.749h-6.84c-0.467,0-0.865,0.34-0.938,0.802l-2.766,17.537c-0.055,0.346,0.213,0.658,0.562,0.658  h3.51c0.326,0,0.605-0.238,0.656-0.562l0.785-4.971c0.072-0.463,0.471-0.803,0.938-0.803h2.164c4.506,0,7.105-2.18,7.785-6.5  c0.307-1.89,0.012-3.375-0.873-4.415C99.004,7.353,97.281,6.749,94.992,6.749z M95.781,13.154c-0.373,2.454-2.248,2.454-4.062,2.454  h-1.031l0.725-4.583c0.043-0.277,0.281-0.481,0.562-0.481h0.473c1.234,0,2.4,0,3.002,0.704  C95.809,11.668,95.918,12.292,95.781,13.154z"/><path fill="#179BD7" d="M115.434,13.075h-3.273c-0.281,0-0.52,0.204-0.562,0.481l-0.145,0.916l-0.23-0.332  c-0.709-1.029-2.289-1.373-3.867-1.373c-3.619,0-6.709,2.741-7.311,6.586c-0.312,1.918,0.131,3.752,1.219,5.031  c1,1.176,2.426,1.666,4.125,1.666c2.916,0,4.533-1.875,4.533-1.875l-0.146,0.91c-0.055,0.348,0.213,0.66,0.564,0.66h2.949  c0.467,0,0.865-0.34,0.938-0.803l1.771-11.209C116.053,13.388,115.785,13.075,115.434,13.075z M110.869,19.449  c-0.314,1.871-1.801,3.127-3.695,3.127c-0.949,0-1.711-0.305-2.199-0.883c-0.484-0.574-0.666-1.391-0.514-2.301  c0.297-1.855,1.805-3.152,3.67-3.152c0.93,0,1.686,0.309,2.184,0.892C110.816,17.721,111.014,18.543,110.869,19.449z"/><path fill="#179BD7" d="M119.295,7.23l-2.807,17.858c-0.055,0.346,0.213,0.658,0.562,0.658h2.822c0.469,0,0.867-0.34,0.939-0.803  l2.768-17.536c0.055-0.346-0.213-0.659-0.562-0.659h-3.16C119.578,6.749,119.338,6.953,119.295,7.23z"/><path fill="#253B80" d="M7.266,29.154l0.523-3.322l-1.165-0.027H1.061L4.927,1.292C4.939,1.218,4.978,1.149,5.035,1.1  c0.057-0.049,0.13-0.076,0.206-0.076h9.38c3.114,0,5.263,0.648,6.385,1.927c0.526,0.6,0.861,1.227,1.023,1.917  c0.17,0.724,0.173,1.589,0.007,2.644l-0.012,0.077v0.676l0.526,0.298c0.443,0.235,0.795,0.504,1.065,0.812  c0.45,0.513,0.741,1.165,0.864,1.938c0.127,0.795,0.085,1.741-0.123,2.812c-0.24,1.232-0.628,2.305-1.152,3.183  c-0.482,0.809-1.096,1.48-1.825,2c-0.696,0.494-1.523,0.869-2.458,1.109c-0.906,0.236-1.939,0.355-3.072,0.355h-0.73  c-0.522,0-1.029,0.188-1.427,0.525c-0.399,0.344-0.663,0.814-0.744,1.328l-0.055,0.299l-0.924,5.855l-0.042,0.215  c-0.011,0.068-0.03,0.102-0.058,0.125c-0.025,0.021-0.061,0.035-0.096,0.035H7.266z"/><path fill="#179BD7" d="M23.048,7.667L23.048,7.667L23.048,7.667c-0.028,0.179-0.06,0.362-0.096,0.55  c-1.237,6.351-5.469,8.545-10.874,8.545H9.326c-0.661,0-1.218,0.48-1.321,1.132l0,0l0,0L6.596,26.83l-0.399,2.533  c-0.067,0.428,0.263,0.814,0.695,0.814h4.881c0.578,0,1.069-0.42,1.16-0.99l0.048-0.248l0.919-5.832l0.059-0.32  c0.09-0.572,0.582-0.992,1.16-0.992h0.73c4.729,0,8.431-1.92,9.513-7.476c0.452-2.321,0.218-4.259-0.978-5.622  C24.022,8.286,23.573,7.945,23.048,7.667z"/><path fill="#222D65" d="M21.754,7.151c-0.189-0.055-0.384-0.105-0.584-0.15c-0.201-0.044-0.407-0.083-0.619-0.117  c-0.742-0.12-1.555-0.177-2.426-0.177h-7.352c-0.181,0-0.353,0.041-0.507,0.115C9.927,6.985,9.675,7.306,9.614,7.699L8.05,17.605  l-0.045,0.289c0.103-0.652,0.66-1.132,1.321-1.132h2.752c5.405,0,9.637-2.195,10.874-8.545c0.037-0.188,0.068-0.371,0.096-0.55  c-0.313-0.166-0.652-0.308-1.017-0.429C21.941,7.208,21.848,7.179,21.754,7.151z"/>                                                                <path fill="#253B80" d="M9.614,7.699c0.061-0.393,0.313-0.714,0.652-0.876c0.155-0.074,0.326-0.115,0.507-0.115h7.352  c0.871,0,1.684,0.057,2.426,0.177c0.212,0.034,0.418,0.073,0.619,0.117c0.2,0.045,0.395,0.095,0.584,0.15  c0.094,0.028,0.187,0.057,0.278,0.086c0.365,0.121,0.704,0.264,1.017,0.429c0.368-2.347-0.003-3.945-1.272-5.392  C20.378,0.682,17.853,0,14.622,0h-9.38c-0.66,0-1.223,0.48-1.325,1.133L0.01,25.898c-0.077,0.49,0.301,0.932,0.795,0.932h5.791  l1.454-9.225L9.614,7.699z"/></svg>'; }
                                    echo '
                                    </div>
                                    <div class="flex flex-col flex-align-c gap-05">
                                        <span class="text-primary bold w-100">'.$card['cardname'].' **** '.$card['shortnum'].'</span>
                                        <span class="text-secondary small-med w-100">Érvényes: '.$card['expiry'].'</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        ';
                    }
                }
                ?>
                <div class="flex flex-row-d-col-m flex-align-c flex-justify-con-sb border-soft border-primary-light-dotted primary-bg padding-105 w-40d-100m" style="height: 84px;">
                    <div class="flex flex-row-d-col-m flex-align-c gap-1">
                        <div class="flex flex-row flex-align-c gap-1">
                            <div class="flex flex-col flex-align-c flex-justify-con-fs gap-1">
                                <div class="flex flex-row flex-align-c flex-justify-con-sb gap-1 w-100">
                                    <span class="bold w-100">Fontos felhívás!</span>
                                    <div class="flex flex-col flex-align-fe" onclick="document.getElementById('tabs-credit').click();">
                                        <span class="primary-dark-bg padding-05 border-soft text-secondary smaller user-select-none pointer" onclick="document.getElementById('tabs-credit').click();">Hozzáadás</span>
                                    </div>
                                </div>
                                <span class="text-secondary smaller-light">Kérjük, olvassa el a <a class="text-primary-light link pointer user-select-none">Bankkártyák felvételéről szóló nyilatkozatunkat</a> új fizetési kártya hozzáadása esetén.</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div><br>
        <div class="flex flex-col gap-1">
            <div class="flex flex-row">
                <span class="text-primary bold">Mentett címek</span>
            </div>
            <div class="flex flex-row flex-wrap flex-align-c flex-justify-con-c gap-1">
                <div class="flex flex-col gap-1 border-soft border-secondary-dotted padding-105 w-40d-100m">
                    <div class="flex flex-row flex-align-c flex-justify-con-sb gap-2">
                        <div class="flex flex-row flex-align-c">
                            <span class="text-primary bold">Számlázási cím</span>
                        </div>
                        <div class="flex">
                            <span class="background-bg padding-05 border-soft text-secondary smaller user-select-none pointer" onclick="document.getElementById('tabs-personal').click();">Megtekintés</span>
                        </div>
                    </div>
                    <div class="flex flex-row flex-align-c gap-1">
                        <div class="flex flex-row flex-align-c gap-1">
                            <div class="flex flex-col flex-align-c gap-05">
                                <span class="text-secondary small-med bold w-100"><?php echo $datas['inv__postal'] . ' ' . $datas['inv__settlement'] . ', ' .  $datas['inv__address']; ?></span>
                                <span class="text-secondary small-med bold w-100"><span id="inv__county"></span>, <span class="uppercase"><?php echo $datas['language']; ?></span></span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="flex flex-col gap-1 border-soft border-secondary-dotted padding-105 w-40d-100m">
                    <div class="flex flex-row flex-align-c flex-justify-con-sb gap-2">
                        <div class="flex flex-row flex-align-c gap-1">
                            <span class="text-primary bold">Szállítási cím</span>
                        </div>
                        <div class="flex">
                            <span class="background-bg padding-05 border-soft text-secondary smaller user-select-none pointer" onclick="document.getElementById('tabs-personal').click();">Megtekintés</span>
                        </div>
                    </div>
                    <div class="flex flex-row flex-align-c gap-1">
                        <div class="flex flex-row flex-align-c gap-1">
                            <div class="flex flex-col flex-align-c gap-05">
                                <span class="text-secondary small-med bold w-100"><?php echo $datas['postal'] . ' ' . $datas['settlement'] . ', ' . $datas['address']; ?></span>
                                <span class="text-secondary small-med bold w-100"><span id="ship__county"></span>, <span class="uppercase"><?php echo $datas['language']; ?></span></span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        function inRange(x, min, max) { return ((x - min) * (x - max) <= 0); }
        for (let key of Object.keys(county)) { matches.push([key, county[key]]); }
        for (let i = 0; i < matches.length; i++) {
            if (inRange(Number(<?php echo $datas['inv__postal']; ?>), matches[i][1].minmax[0], matches[i][1].minmax[1])) { 
                document.getElementById("inv__county").textContent = matches[i][1].name;
            }
            if (inRange(Number(<?php echo $datas['postal']; ?>), matches[i][1].minmax[0], matches[i][1].minmax[1])) { 
                document.getElementById("ship__county").textContent = matches[i][1].name;
            }
        }  
    </script>
</div><script src="/includes/profile/script/account.js"></script>