<?php
require_once($_SERVER['DOCUMENT_ROOT'].'/includes/header.php');

?>
<script>
    var link = document.createElement('link');
    link.setAttribute('rel', 'stylesheet');
    link.setAttribute('href', '/assets/style/settings.css');
    document.head.append(link);
</script>
<main>
    <div class='settingsGrid'>
        <div class="settingsMenu grid-left" id='settingsMenu'>
            <div class="settingsTabLinks" onclick="settingsMenu(event, 'General')" id="defaultSettingsMenu">
                <span class='settingsTabLinkIcon'>
                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                        <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                            <rect x="0" y="0" width="24" height="24"/>
                            <path d="M5,8.6862915 L5,5 L8.6862915,5 L11.5857864,2.10050506 L14.4852814,5 L19,5 L19,9.51471863 L21.4852814,12 L19,14.4852814 L19,19 L14.4852814,19 L11.5857864,21.8994949 L8.6862915,19 L5,19 L5,15.3137085 L1.6862915,12 L5,8.6862915 Z M12,15 C13.6568542,15 15,13.6568542 15,12 C15,10.3431458 13.6568542,9 12,9 C10.3431458,9 9,10.3431458 9,12 C9,13.6568542 10.3431458,15 12,15 Z" class="svg"/>
                        </g>
                    </svg>
                </span>
                <span class='settingsTabLinkName'>Általános</span>
            </div>
            <div class="settingsTabLinks" onclick="settingsMenu(event, 'Security')">
                <span class='settingsTabLinkIcon'>
                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                        <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                            <rect x="0" y="0" width="24" height="24"/>
                            <path d="M4,4 L11.6314229,2.5691082 C11.8750185,2.52343403 12.1249815,2.52343403 12.3685771,2.5691082 L20,4 L20,13.2830094 C20,16.2173861 18.4883464,18.9447835 16,20.5 L12.5299989,22.6687507 C12.2057287,22.8714196 11.7942713,22.8714196 11.4700011,22.6687507 L8,20.5 C5.51165358,18.9447835 4,16.2173861 4,13.2830094 L4,4 Z" class="svg" opacity="0.3"/>
                            <path d="M11.1750002,14.75 C10.9354169,14.75 10.6958335,14.6541667 10.5041669,14.4625 L8.58750019,12.5458333 C8.20416686,12.1625 8.20416686,11.5875 8.58750019,11.2041667 C8.97083352,10.8208333 9.59375019,10.8208333 9.92916686,11.2041667 L11.1750002,12.45 L14.3375002,9.2875 C14.7208335,8.90416667 15.2958335,8.90416667 15.6791669,9.2875 C16.0625002,9.67083333 16.0625002,10.2458333 15.6791669,10.6291667 L11.8458335,14.4625 C11.6541669,14.6541667 11.4145835,14.75 11.1750002,14.75 Z" fill="#000000"/>
                        </g>
                    </svg>
                </span>
                <span class='settingsTabLinkName'>Biztonság és Bejelentkezés</span>
            </div>
            <div class="settingsTabLinks" onclick="settingsMenu(event, 'Privacy')">
                <span class='settingsTabLinkIcon'>
                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                        <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                            <mask fill="white">
                                <use xlink:href="#path-1"/>
                            </mask>
                            <g/>
                            <path d="M7,10 L7,8 C7,5.23857625 9.23857625,3 12,3 C14.7614237,3 17,5.23857625 17,8 L17,10 L18,10 C19.1045695,10 20,10.8954305 20,12 L20,18 C20,19.1045695 19.1045695,20 18,20 L6,20 C4.8954305,20 4,19.1045695 4,18 L4,12 C4,10.8954305 4.8954305,10 6,10 L7,10 Z M12,5 C10.3431458,5 9,6.34314575 9,8 L9,10 L15,10 L15,8 C15,6.34314575 13.6568542,5 12,5 Z" class="svg"/>
                        </g>
                    </svg>
                </span>
                <span class='settingsTabLinkName'>Privacy</span>
            </div>
            <div class="settingsTabLinks" onclick="settingsMenu(event, 'Cookies')">
                <span class='settingsTabLinkIcon'>
                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                        <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                            <rect x="0" y="0" width="24" height="24"/>
                            <polygon class="svg" opacity="0.3" points="12 20.6599888 9.46440699 20.6354368 7.31805655 19.2852462 5.19825383 17.8937466 4.12259707 15.5974894 3.09160702 13.2808335 3.42815736 10.7675551 3.81331204 8.26126488 5.45521712 6.32891335 7.13423264 4.4287182 9.5601992 3.69080156 12 3 14.4398008 3.69080156 16.8657674 4.4287182 18.5447829 6.32891335 20.186688 8.26126488 20.5718426 10.7675551 20.908393 13.2808335 19.8774029 15.5974894 18.8017462 17.8937466 16.6819434 19.2852462 14.535593 20.6354368"/>
                            <circle class="svg" opacity="0.3" cx="8.5" cy="13.5" r="1.5"/>
                            <circle class="svg" opacity="0.3" cx="13.5" cy="7.5" r="1.5"/>
                            <circle class="svg" opacity="0.3" cx="14.5" cy="15.5" r="1.5"/>
                        </g>
                    </svg>
                </span>
                <span class='settingsTabLinkName'>Sütik</span>
            </div>
            <div class="settingsTabLinks" onclick="settingsMenu(event, 'DarkMode')">
                <span class='settingsTabLinkIcon'>
                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                        <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                            <rect x="0" y="0" width="24" height="24"/>
                            <path d="M12.0700837,4.0003006 C11.3895108,5.17692613 11,6.54297551 11,8 C11,12.3948932 14.5439081,15.9620623 18.9299163,15.9996994 C17.5467214,18.3910707 14.9612535,20 12,20 C7.581722,20 4,16.418278 4,12 C4,7.581722 7.581722,4 12,4 C12.0233848,4 12.0467462,4.00010034 12.0700837,4.0003006 Z" class="svg"/>
                        </g>
                    </svg>
                </span>
                <span class='settingsTabLinkName'>Sötét mód</span>
            </div>
            <div class="settingsTabLinks" onclick="settingsMenu(event, 'Language')">
                <span class='settingsTabLinkIcon'>
                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                        <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                            <rect x="0" y="0" width="24" height="24"/>
                            <circle class="svg" opacity="0.3" cx="12" cy="12" r="9"/>
                            <path d="M11.7357634,20.9961946 C6.88740052,20.8563914 3,16.8821712 3,12 C3,11.9168367 3.00112797,11.8339369 3.00336944,11.751315 C3.66233009,11.8143341 4.85636818,11.9573854 4.91262842,12.4204038 C4.9904938,13.0609191 4.91262842,13.8615942 5.45804656,14.101772 C6.00346469,14.3419498 6.15931561,13.1409372 6.6267482,13.4612567 C7.09418079,13.7815761 8.34086797,14.0899175 8.34086797,14.6562185 C8.34086797,15.222396 8.10715168,16.1034596 8.34086797,16.2636193 C8.57458427,16.423779 9.5089688,17.54465 9.50920913,17.7048097 C9.50956962,17.8649694 9.83857487,18.6793513 9.74040201,18.9906563 C9.65905192,19.2487394 9.24857641,20.0501554 8.85059781,20.4145589 C9.75315358,20.7620621 10.7235846,20.9657742 11.7357634,20.9960544 L11.7357634,20.9961946 Z M8.28272988,3.80112099 C9.4158415,3.28656421 10.6744554,3 12,3 C15.5114513,3 18.5532143,5.01097452 20.0364482,7.94408274 C20.069657,8.72412177 20.0638332,9.39135321 20.2361262,9.6327358 C21.1131932,10.8600506 18.0995147,11.7043158 18.5573343,13.5605384 C18.7589671,14.3794892 16.5527814,14.1196773 16.0139722,14.886394 C15.4748026,15.6527403 14.1574598,15.137809 13.8520064,14.9904917 C13.546553,14.8431744 12.3766497,15.3341497 12.4789081,14.4995164 C12.5805657,13.664636 13.2922889,13.6156126 14.0555619,13.2719546 C14.8184743,12.928667 15.9189236,11.7871741 15.3781918,11.6380045 C12.8323064,10.9362407 11.963771,8.47852395 11.963771,8.47852395 C11.8110443,8.44901109 11.8493762,6.74109366 11.1883616,6.69207022 C10.5267462,6.64279981 10.170464,6.88841096 9.20435656,6.69207022 C8.23764828,6.49572949 8.44144409,5.85743687 8.2887174,4.48255778 C8.25453994,4.17415686 8.25619136,3.95717082 8.28272988,3.80112099 Z M20.9991771,11.8770357 C20.9997251,11.9179585 21,11.9589471 21,12 C21,16.9406923 17.0188468,20.9515364 12.0895088,20.9995641 C16.970233,20.9503326 20.9337111,16.888438 20.9991771,11.8770357 Z" class="svg" opacity="0.3"/>
                        </g>
                    </svg>
                </span>
                <span class='settingsTabLinkName'>Nyelv</span>
            </div>
            <div class="settingsTabLinks" onclick="settingsMenu(event, 'Notifications')">
                <span class='settingsTabLinkIcon'>
                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                        <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                            <path d="M17,12 L18.5,12 C19.3284271,12 20,12.6715729 20,13.5 C20,14.3284271 19.3284271,15 18.5,15 L5.5,15 C4.67157288,15 4,14.3284271 4,13.5 C4,12.6715729 4.67157288,12 5.5,12 L7,12 L7.5582739,6.97553494 C7.80974924,4.71225688 9.72279394,3 12,3 C14.2772061,3 16.1902508,4.71225688 16.4417261,6.97553494 L17,12 Z" class="svg"/>
                            <rect class="svg" opacity="0.3" x="10" y="16" width="4" height="4" rx="2"/>
                        </g>
                    </svg>
                </span>
                <span class='settingsTabLinkName'>Értesítések</span>
            </div>
            <div class="settingsTabLinks" onclick="settingsMenu(event, 'Webshop')">
                <span class='settingsTabLinkIcon'>
                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                        <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                            <rect x="0" y="0" width="24" height="24"/>
                            <path d="M18.1446364,11.84388 L17.4471627,16.0287218 C17.4463569,16.0335568 17.4455155,16.0383857 17.4446387,16.0432083 C17.345843,16.5865846 16.8252597,16.9469884 16.2818833,16.8481927 L4.91303792,14.7811299 C4.53842737,14.7130189 4.23500006,14.4380834 4.13039941,14.0719812 L2.30560137,7.68518803 C2.28007524,7.59584656 2.26712532,7.50338343 2.26712532,7.4104669 C2.26712532,6.85818215 2.71484057,6.4104669 3.26712532,6.4104669 L16.9929851,6.4104669 L17.606173,3.78251876 C17.7307772,3.24850086 18.2068633,2.87071314 18.7552257,2.87071314 L20.8200821,2.87071314 C21.4717328,2.87071314 22,3.39898039 22,4.05063106 C22,4.70228173 21.4717328,5.23054898 20.8200821,5.23054898 L19.6915238,5.23054898 L18.1446364,11.84388 Z" class="svg" opacity="0.3"/>
                            <path d="M6.5,21 C5.67157288,21 5,20.3284271 5,19.5 C5,18.6715729 5.67157288,18 6.5,18 C7.32842712,18 8,18.6715729 8,19.5 C8,20.3284271 7.32842712,21 6.5,21 Z M15.5,21 C14.6715729,21 14,20.3284271 14,19.5 C14,18.6715729 14.6715729,18 15.5,18 C16.3284271,18 17,18.6715729 17,19.5 C17,20.3284271 16.3284271,21 15.5,21 Z" class="svg"/>
                        </g>
                    </svg>
                </span>
                <span class='settingsTabLinkName'>Webshop</span>
            </div>
            <div class="settingsTabLinks" onclick="settingsMenu(event, 'Orders')">
                <span class='settingsTabLinkIcon'>
                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                        <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                            <rect x="0" y="0" width="24" height="24"/>
                            <path d="M20.4061385,6.73606154 C20.7672665,6.89656288 21,7.25468437 21,7.64987309 L21,16.4115967 C21,16.7747638 20.8031081,17.1093844 20.4856429,17.2857539 L12.4856429,21.7301984 C12.1836204,21.8979887 11.8163796,21.8979887 11.5143571,21.7301984 L3.51435707,17.2857539 C3.19689188,17.1093844 3,16.7747638 3,16.4115967 L3,7.64987309 C3,7.25468437 3.23273352,6.89656288 3.59386153,6.73606154 L11.5938615,3.18050598 C11.8524269,3.06558805 12.1475731,3.06558805 12.4061385,3.18050598 L20.4061385,6.73606154 Z" class="svg" opacity="0.3"/>
                            <polygon class="svg" points="14.9671522 4.22441676 7.5999999 8.31727912 7.5999999 12.9056825 9.5999999 13.9056825 9.5999999 9.49408582 17.25507 5.24126912"/>
                        </g>
                    </svg>
                </span>
                <span class='settingsTabLinkName'>Rendelések</span>
            </div>
        </div>
        <div class='settingsDisplay grid-main'>
            <div id='General' class='settingsTabContent'>
                <div class='settings_breadcrumbs settings_sp'>
                    <ul>
                        <li><a href="/settings">Beállítások</a>/</li>
                        <li><a class='default_link'>Általános</a></li>
                    </ul>
                </div>
                <div class='settignsDisplayMain'>
                    <form method="POST" action="">
                        <div class='settingsElementsContainer'>
                            <div class='settingsConTitle'>Alapvető Információk</div>
                            <div class='settCon'>
                                <div class='settCol'>
                                    <div class='settRow'>
                                        <div class='settSectTitle'>Teljes Név</div>
                                        <div class='settSectAnsw'><?php echo $fullname; ?></div>
                                    </div>
                                </div>
                                <div class='settCol'>
                                    <div class='settRow'>
                                        <div class='settSectTitle'>Település</div>
                                        <div class='settSectAnsw'><?php echo $settlement; ?></div>
                                    </div>
                                </div>
                                <div class='settCol'>
                                    <div class='settRow'>
                                        <div class='settSectTitle'>Irányítószám</div>
                                        <div class='settSectAnsw'><?php echo $postal; ?></div>
                                    </div>
                                </div>
                                <div class='settCol'>
                                    <div class='settRow'>
                                        <div class='settSectTitle'>Adószám</div>
                                        <div class='settSectAnsw'><?php echo $tax; ?></div>
                                    </div>
                                </div>
                                <div class='settCol'>
                                    <div class='settRow'>
                                        <div class='settSectTitle'>Cégnév</div>
                                        <div class='settSectAnsw'><?php echo $company; ?></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class='settingsElementsContainer'>
                            <div class='settingsConTitle'>Elérhetőségek</div>
                            <div class='settCon'>
                                <div class='settCol'>
                                    <div class='settRow'>
                                        <div class='settSectTitle'>Email</div>
                                        <div class='settSectAnsw'><?php echo $email; ?></div>
                                    </div>
                                </div>
                                <div class='settCol'>
                                    <div class='settRow'>
                                        <div class='settSectTitle'>Telefon</div>
                                        <div class='settSectAnsw'><?php echo $phone; ?></div>
                                    </div>
                                </div>
                                <div class='settCol'>
                                    <div class='settRow'>
                                        <div class='settSectTitle'>Fax</div>
                                        <div class='settSectAnsw'><?php echo $fax; ?></div>
                                    </div>
                                </div>
                                <div class='settCol'>
                                    <div class='settRow'>
                                        <div class='settSectTitle'>Cím</div>
                                        <div class='settSectAnsw'><?php echo $address; ?></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class='settingsElementsContainer'>
                            <div class='settingsConTitle'>Szállítási információk</div>
                            <div class='settCon'>
                                <div class='settCol'>
                                    <div class='settRow'>
                                        <div class='settSectTitle'>Település</div>
                                        <div class='settSectAnsw'><?php echo $shipsettlement; ?></div>
                                    </div>
                                </div>
                                <div class='settCol'>
                                    <div class='settRow'>
                                        <div class='settSectTitle'>Irányítószám</div>
                                        <div class='settSectAnsw'><?php echo $shippostal; ?></div>
                                    </div>
                                </div>
                                <div class='settCol'>
                                    <div class='settRow'>
                                        <div class='settSectTitle'>Cím</div>
                                        <div class='settSectAnsw'><?php echo $shipaddress; ?></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <div id='Security' class='settingsTabContent'>
                <div class='settings_breadcrumbs'>
                    <ul>
                        <li><a href="/settings">Beállítások</a>/</li>
                        <li><a class='default_link'>Biztonság és Bejelentkezés</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</main>
<script>
    function settingsMenu(evt, settingsName) {
    var i, tabcontent, tablinks;
    tabcontent = document.getElementsByClassName("settingsTabContent");
    for (i = 0; i < tabcontent.length; i++) {
        tabcontent[i].style.display = "none";
    }
    tablinks = document.getElementsByClassName("settingsTabLinks");
    for (i = 0; i < tablinks.length; i++) {
        tablinks[i].className = tablinks[i].className.replace(" settingMenuActive", "");
    }
    document.getElementById(settingsName).style.display = "block";
    evt.currentTarget.className += " settingMenuActive";
    }
    document.getElementById("defaultSettingsMenu").click();

    var x = document.getElementsByClassName('settSectAnsw');
    var y = new Array(x.length);
    var z = new Array(x.length);
    for (let i = 0; i < x.length; i++) {
        y[i] = x[i].innerHTML;
        x[i].innerHTML = x[i].innerHTML + `<span class="settignsEditButton" title="Szerkesztés" onclick="createSettingsEditPanel('`+ x[i].innerHTML +`', this)"><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="16px" height="16px" viewBox="0 0 24 24" version="1.1"><g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"><rect x="0" y="0" width="24" height="24"/><path d="M8,17.9148182 L8,5.96685884 C8,5.56391781 8.16211443,5.17792052 8.44982609,4.89581508 L10.965708,2.42895648 C11.5426798,1.86322723 12.4640974,1.85620921 13.0496196,2.41308426 L15.5337377,4.77566479 C15.8314604,5.0588212 16,5.45170806 16,5.86258077 L16,17.9148182 C16,18.7432453 15.3284271,19.4148182 14.5,19.4148182 L9.5,19.4148182 C8.67157288,19.4148182 8,18.7432453 8,17.9148182 Z" class="svg" fill-rule="nonzero" transform="translate(12.000000, 10.707409) rotate(-135.000000) translate(-12.000000, -10.707409) "/><rect class="svg" opacity="0.3" x="5" y="20" width="15" height="2" rx="1"/></g></svg></span>`;
        z[i] = x[i];
    }

    function createSettingsEditPanel (value, item) {
        var type;
        if (!isNaN(value)) {
            type = 'number';
        } else {
            type = 'text';
        }
        var itemBackup;
        item.parentNode.innerHTML = `
            <form method='POSt' action=''>
                <input type='` + type + `' name='editSettings' placeholder='` + value + `' />
                <span>
                    <span class='editSettingsCancel' onclick='closeSettingsEditPanel("asd")'>Mégse</span>
                    <input type='submit' name='editSettingsSubmit' value='Mentés' />
                </span>
            </form>
        `;
    }

    function closeSettingsEditPanel (item) {
        item.parentNode.innerHTML = y[0];
    }

    const html = document.querySelector('html');
    //html.dataset.theme = `theme-light`;

    function switchTheme(theme) {
    html.dataset.theme = `theme-${theme}`;
    localStorage.setItem('theme', `theme-${theme}`);
    }

</script>
<?php

echo "
<script>

    var profileActionsContainer = document.createElement('div');
    var transWrapper = document.createElement('div');
    transWrapper.classList.add('transWrapper');
    profileActionsContainer.id = 'profileHeaderContainer';
    let cC = 1;
    function openHeaderProfileActionLogged  () {
        cC++;
        if (cC % 2 == 0) {
            document.getElementById('header_con').classList.add('relative');
            showProfileActionPanel();
            document.body.append(transWrapper);
            document.getElementById('header_con').append(profileActionsContainer);
        } else {
            profileActionsContainer.remove();
            cC = 1;
        }
    }

    window.onclick = function(event) {
        if (event.target == transWrapper) {
            profileActionsContainer.remove();
            transWrapper.remove();
            cC = 1;
        }
    }

    function showProfileActionPanel () {
        profileActionsContainer.innerHTML = `
            <div class='profileActionCon flex flex-col absolute'>
                <div class='flex flex-col'>
                    <span class='flex flex-row flex-justify-con-sa'>
                        <div class='flex flex-col profileActionItemHead flex-justify-con-l'>
                            <span class='profileActionTitle'> ". $fullname ." </span>
                            <span class='secondary small'> ". $email ."</span>
                        </div>
                        <div class='flex flex-align-c profileIconCon'>
                            <span class='iconCon'>
                                <img src='/assets/images/svg/profile.png' alt='' class='pointer'>
                            </span>
                        </div>
                    </span>
                    <hr class='profacthr'>
                    <div class='flex flex-col profileActionItem' style='margin-bottom: 1rem;'>
                        <span class='flex flex-row w-100 flex-align-c'>
                            <span class='actionConIcon flex'>
                                <svg xmlns='http://www.w3.org/2000/svg' xmlns:xlink='http://www.w3.org/1999/xlink' width='24px' height='24px' viewBox='0 0 24 24' version='1.1'>
                                    <g stroke='none' stroke-width='1' fill='none' fill-rule='evenodd'>
                                        <rect x='0' y='0' width='24' height='24'/>
                                        <path d='M3.5,3 L5,3 L5,19.5 C5,20.3284271 4.32842712,21 3.5,21 L3.5,21 C2.67157288,21 2,20.3284271 2,19.5 L2,4.5 C2,3.67157288 2.67157288,3 3.5,3 Z' class='svg'/>
                                        <path d='M6.99987583,2.99995344 L19.754647,2.99999303 C20.3069317,2.99999474 20.7546456,3.44771138 20.7546439,3.99999613 C20.7546431,4.24703684 20.6631995,4.48533385 20.497938,4.66895776 L17.5,8 L20.4979317,11.3310353 C20.8673908,11.7415453 20.8341123,12.3738351 20.4236023,12.7432941 C20.2399776,12.9085564 20.0016794,13 19.7546376,13 L6.99987583,13 L6.99987583,2.99995344 Z' class='svg' opacity='0.3'/>
                                    </g>
                                </svg>
                            </span>
                            <span class='actionConText flex'>Visszajelzés küldése</span>
                        </span>
                    </div>
                    <div class='flex flex-col profileActionItem' onclick='profileActionPanel('support');'>
                        <span class='flex flex-row w-100 flex-align-c flex-justify-con-sb'>
                            <span class='flex flex-row flex-align-c'>
                                <span class='actionConIcon flex'>
                                    <svg xmlns='http://www.w3.org/2000/svg' xmlns:xlink='http://www.w3.org/1999/xlink' width='24px' height='24px' viewBox='0 0 24 24' version='1.1'>
                                        <g stroke='none' stroke-width='1' fill='none' fill-rule='evenodd'>
                                            <rect x='0' y='0' width='24' height='24'/>
                                            <circle class='svg' opacity='0.3' cx='12' cy='12' r='10'/>
                                            <path d='M12,16 C12.5522847,16 13,16.4477153 13,17 C13,17.5522847 12.5522847,18 12,18 C11.4477153,18 11,17.5522847 11,17 C11,16.4477153 11.4477153,16 12,16 Z M10.591,14.868 L10.591,13.209 L11.851,13.209 C13.447,13.209 14.602,11.991 14.602,10.395 C14.602,8.799 13.447,7.581 11.851,7.581 C10.234,7.581 9.121,8.799 9.121,10.395 L7.336,10.395 C7.336,7.875 9.31,5.922 11.851,5.922 C14.392,5.922 16.387,7.875 16.387,10.395 C16.387,12.915 14.392,14.868 11.851,14.868 L10.591,14.868 Z' class='svg'/>
                                        </g>
                                    </svg>
                                </span>
                                <span class='actionConText flex'>Segítség és támogatás</span>
                            </span>
                            <span class='actionConIcon flex'>
                                <svg xmlns='http://www.w3.org/2000/svg' xmlns:xlink='http://www.w3.org/1999/xlink' width='24px' height='24px' viewBox='0 0 24 24' version='1.1'>
                                    <g stroke='none' stroke-width='1' fill='none' fill-rule='evenodd'>
                                        <polygon points='0 0 24 0 24 24 0 24'/>
                                        <path d='M6.70710678,15.7071068 C6.31658249,16.0976311 5.68341751,16.0976311 5.29289322,15.7071068 C4.90236893,15.3165825 4.90236893,14.6834175 5.29289322,14.2928932 L11.2928932,8.29289322 C11.6714722,7.91431428 12.2810586,7.90106866 12.6757246,8.26284586 L18.6757246,13.7628459 C19.0828436,14.1360383 19.1103465,14.7686056 18.7371541,15.1757246 C18.3639617,15.5828436 17.7313944,15.6103465 17.3242754,15.2371541 L12.0300757,10.3841378 L6.70710678,15.7071068 Z' class='svg' fill-rule='nonzero' transform='translate(12.000003, 11.999999) rotate(-270.000000) translate(-12.000003, -11.999999) '/>
                                    </g>
                                </svg>
                            </span>
                        </span>
                    </div>
                    <div class='flex flex-col profileActionItem' onclick='profileActionPanel('privacy');'>
                        <span class='flex flex-row w-100 flex-align-c flex-justify-con-sb'>
                            <span class='flex flex-row flex-align-c'>
                                <span class='actionConIcon flex'>
                                    <svg xmlns='http://www.w3.org/2000/svg' xmlns:xlink='http://www.w3.org/1999/xlink' width='24px' height='24px' viewBox='0 0 24 24' version='1.1'>
                                        <g stroke='none' stroke-width='1' fill='none' fill-rule='evenodd'>
                                            <mask fill='white'>
                                                <use xlink:href='#path-1'/>
                                            </mask>
                                            <g/>
                                            <path d='M7,10 L7,8 C7,5.23857625 9.23857625,3 12,3 C14.7614237,3 17,5.23857625 17,8 L17,10 L18,10 C19.1045695,10 20,10.8954305 20,12 L20,18 C20,19.1045695 19.1045695,20 18,20 L6,20 C4.8954305,20 4,19.1045695 4,18 L4,12 C4,10.8954305 4.8954305,10 6,10 L7,10 Z M12,5 C10.3431458,5 9,6.34314575 9,8 L9,10 L15,10 L15,8 C15,6.34314575 13.6568542,5 12,5 Z' class='svg'/>
                                        </g>
                                    </svg>
                                </span>
                                <span class='actionConText flex'>Privacy</span>
                            </span>
                            <span class='actionConIcon flex'>
                                <svg xmlns='http://www.w3.org/2000/svg' xmlns:xlink='http://www.w3.org/1999/xlink' width='24px' height='24px' viewBox='0 0 24 24' version='1.1'>
                                    <g stroke='none' stroke-width='1' fill='none' fill-rule='evenodd'>
                                        <polygon points='0 0 24 0 24 24 0 24'/>
                                        <path d='M6.70710678,15.7071068 C6.31658249,16.0976311 5.68341751,16.0976311 5.29289322,15.7071068 C4.90236893,15.3165825 4.90236893,14.6834175 5.29289322,14.2928932 L11.2928932,8.29289322 C11.6714722,7.91431428 12.2810586,7.90106866 12.6757246,8.26284586 L18.6757246,13.7628459 C19.0828436,14.1360383 19.1103465,14.7686056 18.7371541,15.1757246 C18.3639617,15.5828436 17.7313944,15.6103465 17.3242754,15.2371541 L12.0300757,10.3841378 L6.70710678,15.7071068 Z' class='svg' fill-rule='nonzero' transform='translate(12.000003, 11.999999) rotate(-270.000000) translate(-12.000003, -11.999999) '/>
                                    </g>
                                </svg>
                            </span>
                        </span>
                    </div>
                    <div class='flex flex-col profileActionItem' id='settings' onclick='profileActionPanel(this.id);'>
                        <span class='flex flex-row w-100 flex-align-c flex-justify-con-sb'>
                            <span class='flex flex-row flex-align-c'>
                                <span class='actionConIcon flex'>
                                    <svg xmlns='http://www.w3.org/2000/svg' xmlns:xlink='http://www.w3.org/1999/xlink' width='24px' height='24px' viewBox='0 0 24 24' version='1.1'>
                                        <g stroke='none' stroke-width='1' fill='none' fill-rule='evenodd'>
                                            <rect x='0' y='0' width='24' height='24'/>
                                            <path d='M7,3 L17,3 C19.209139,3 21,4.790861 21,7 C21,9.209139 19.209139,11 17,11 L7,11 C4.790861,11 3,9.209139 3,7 C3,4.790861 4.790861,3 7,3 Z M7,9 C8.1045695,9 9,8.1045695 9,7 C9,5.8954305 8.1045695,5 7,5 C5.8954305,5 5,5.8954305 5,7 C5,8.1045695 5.8954305,9 7,9 Z' class='svg'/>
                                            <path d='M7,13 L17,13 C19.209139,13 21,14.790861 21,17 C21,19.209139 19.209139,21 17,21 L7,21 C4.790861,21 3,19.209139 3,17 C3,14.790861 4.790861,13 7,13 Z M17,19 C18.1045695,19 19,18.1045695 19,17 C19,15.8954305 18.1045695,15 17,15 C15.8954305,15 15,15.8954305 15,17 C15,18.1045695 15.8954305,19 17,19 Z' class='svg' opacity='0.3'/>
                                        </g>
                                    </svg>
                                </span>
                                <span class='actionConText flex'>Beállítások</span>
                            </span>
                            <span class='actionConIcon flex'>
                                <svg xmlns='http://www.w3.org/2000/svg' xmlns:xlink='http://www.w3.org/1999/xlink' width='24px' height='24px' viewBox='0 0 24 24' version='1.1'>
                                    <g stroke='none' stroke-width='1' fill='none' fill-rule='evenodd'>
                                        <polygon points='0 0 24 0 24 24 0 24'/>
                                        <path d='M6.70710678,15.7071068 C6.31658249,16.0976311 5.68341751,16.0976311 5.29289322,15.7071068 C4.90236893,15.3165825 4.90236893,14.6834175 5.29289322,14.2928932 L11.2928932,8.29289322 C11.6714722,7.91431428 12.2810586,7.90106866 12.6757246,8.26284586 L18.6757246,13.7628459 C19.0828436,14.1360383 19.1103465,14.7686056 18.7371541,15.1757246 C18.3639617,15.5828436 17.7313944,15.6103465 17.3242754,15.2371541 L12.0300757,10.3841378 L6.70710678,15.7071068 Z' class='svg' fill-rule='nonzero' transform='translate(12.000003, 11.999999) rotate(-270.000000) translate(-12.000003, -11.999999) '/>
                                    </g>
                                </svg>
                            </span>
                        </span>
                    </div>
                    <div class='flex flex-col profileActionItem' style='margin-top: 1rem;' id='actions/logout' onclick='redirect(this.id);'>
                        <span class='flex flex-row w-100 flex-align-c'>
                            <span class='actionConIcon'>
                                <svg xmlns='http://www.w3.org/2000/svg' xmlns:xlink='http://www.w3.org/1999/xlink' width='24px' height='24px' viewBox='0 0 24 24' version='1.1'>
                                    <g stroke='none' stroke-width='1' fill='none' fill-rule='evenodd'>
                                        <rect x='0' y='0' width='24' height='24'/>
                                        <path d='M14.0069431,7.00607258 C13.4546584,7.00607258 13.0069431,6.55855153 13.0069431,6.00650634 C13.0069431,5.45446114 13.4546584,5.00694009 14.0069431,5.00694009 L15.0069431,5.00694009 C17.2160821,5.00694009 19.0069431,6.7970243 19.0069431,9.00520507 L19.0069431,15.001735 C19.0069431,17.2099158 17.2160821,19 15.0069431,19 L3.00694311,19 C0.797804106,19 -0.993056895,17.2099158 -0.993056895,15.001735 L-0.993056895,8.99826498 C-0.993056895,6.7900842 0.797804106,5 3.00694311,5 L4.00694793,5 C4.55923268,5 5.00694793,5.44752105 5.00694793,5.99956624 C5.00694793,6.55161144 4.55923268,6.99913249 4.00694793,6.99913249 L3.00694311,6.99913249 C1.90237361,6.99913249 1.00694311,7.89417459 1.00694311,8.99826498 L1.00694311,15.001735 C1.00694311,16.1058254 1.90237361,17.0008675 3.00694311,17.0008675 L15.0069431,17.0008675 C16.1115126,17.0008675 17.0069431,16.1058254 17.0069431,15.001735 L17.0069431,9.00520507 C17.0069431,7.90111468 16.1115126,7.00607258 15.0069431,7.00607258 L14.0069431,7.00607258 Z' fill='#ce3746' fill-rule='nonzero' opacity='1' transform='translate(9.006943, 12.000000) scale(-1, 1) rotate(-90.000000) translate(-9.006943, -12.000000) '/>
                                        <rect fill='#ce3746' opacity='1' transform='translate(14.000000, 12.000000) rotate(-270.000000) translate(-14.000000, -12.000000) ' x='13' y='6' width='2' height='12' rx='1'/>
                                        <path d='M21.7928932,9.79289322 C22.1834175,9.40236893 22.8165825,9.40236893 23.2071068,9.79289322 C23.5976311,10.1834175 23.5976311,10.8165825 23.2071068,11.2071068 L20.2071068,14.2071068 C19.8165825,14.5976311 19.1834175,14.5976311 18.7928932,14.2071068 L15.7928932,11.2071068 C15.4023689,10.8165825 15.4023689,10.1834175 15.7928932,9.79289322 C16.1834175,9.40236893 16.8165825,9.40236893 17.2071068,9.79289322 L19.5,12.0857864 L21.7928932,9.79289322 Z' fill='#ce3746' fill-rule='nonzero' transform='translate(19.500000, 12.000000) rotate(-90.000000) translate(-19.500000, -12.000000) '/>
                                    </g>
                                </svg>
                            </span>
                            <span class='actionConText danger'>Kijelentkezés</span>
                        </span>
                    </div>
                    <span class='profcondesc flex flex-row'>
                        <ul class='flex flex-row w-100 flex-justify-con-sb'>
                            <li><a href='#'>Privacy</a></li>
                            <li><a href='#'>Terms</a></li>
                            <li><a href='#'>Cookies</a></li>
                            <li>Mappa Papír &copy; 2022</li>
                        </ul>
                    </span>
                </div>
            </div>
        `;
    }

    function profileActionPanel (panel) {

        if (panel == 'settings') {
            profileActionsContainer.innerHTML = `
                <div class='profileActionCon flex flex-col absolute'>
                    <div class='flex flex-row flex-align-c profileActionItemHead flex-justify-con-l'>
                        <span class='actionConIcon flex'>
                            <svg class='pointer' onclick='showProfileActionPanel();' xmlns='http://www.w3.org/2000/svg' xmlns:xlink='http://www.w3.org/1999/xlink' width='24px' height='24px' viewBox='0 0 24 24' version='1.1'>
                                <g stroke='none' stroke-width='1' fill='none' fill-rule='evenodd'>
                                    <rect x='0' y='0' width='24' height='24'/>
                                    <circle class='svg' opacity='0.3' cx='12' cy='12' r='10'/>
                                    <path d='M6.96323356,15.1775211 C6.62849853,15.5122561 6.08578582,15.5122561 5.75105079,15.1775211 C5.41631576,14.842786 5.41631576,14.3000733 5.75105079,13.9653383 L10.8939067,8.82248234 C11.2184029,8.49798619 11.7409054,8.4866328 12.0791905,8.79672747 L17.2220465,13.5110121 C17.5710056,13.8308912 17.5945795,14.3730917 17.2747004,14.7220508 C16.9548212,15.0710098 16.4126207,15.0945838 16.0636617,14.7747046 L11.5257773,10.6149773 L6.96323356,15.1775211 Z' class='svg' fill-rule='nonzero' transform='translate(11.500001, 12.000001) scale(-1, 1) rotate(-270.000000) translate(-11.500001, -12.000001) '/>
                                </g>
                            </svg>
                        </span>
                        <span class='profileActionTitle flex'>Beállítások</span>
                    </div>
                    <div class='flex flex-col profileActionItem'>
                        <span class='flex flex-row w-100 flex-align-c flex-justify-con-sb'>
                            <span class='flex flex-row flex-align-c'>
                                <span class='actionConIcon flex'>
                                    <svg xmlns='http://www.w3.org/2000/svg' xmlns:xlink='http://www.w3.org/1999/xlink' width='24px' height='24px' viewBox='0 0 24 24' version='1.1'>
                                        <g stroke='none' stroke-width='1' fill='none' fill-rule='evenodd'>
                                            <rect x='0' y='0' width='24' height='24'/>
                                            <path d='M7,3 L17,3 C19.209139,3 21,4.790861 21,7 C21,9.209139 19.209139,11 17,11 L7,11 C4.790861,11 3,9.209139 3,7 C3,4.790861 4.790861,3 7,3 Z M7,9 C8.1045695,9 9,8.1045695 9,7 C9,5.8954305 8.1045695,5 7,5 C5.8954305,5 5,5.8954305 5,7 C5,8.1045695 5.8954305,9 7,9 Z' class='svg'/>
                                            <path d='M7,13 L17,13 C19.209139,13 21,14.790861 21,17 C21,19.209139 19.209139,21 17,21 L7,21 C4.790861,21 3,19.209139 3,17 C3,14.790861 4.790861,13 7,13 Z M17,19 C18.1045695,19 19,18.1045695 19,17 C19,15.8954305 18.1045695,15 17,15 C15.8954305,15 15,15.8954305 15,17 C15,18.1045695 15.8954305,19 17,19 Z' class='svg' opacity='0.3'/>
                                        </g>
                                    </svg>
                                </span>
                                <span class='actionConText flex'>Profil beállítások</span>
                            </span>
                        </span>
                    </div>
                    <div class='flex flex-col profileActionItem' id='settings' onclick='redirect(this.id)'>
                        <span class='flex flex-row w-100 flex-align-c flex-justify-con-sb'>
                            <span class='flex flex-row flex-align-c'>
                                <span class='actionConIcon flex'>
                                    <svg xmlns='http://www.w3.org/2000/svg' xmlns:xlink='http://www.w3.org/1999/xlink' width='24px' height='24px' viewBox='0 0 24 24' version='1.1'>
                                        <g stroke='none' stroke-width='1' fill='none' fill-rule='evenodd'>
                                            <rect x='0' y='0' width='24' height='24'/>
                                            <path d='M18.1446364,11.84388 L17.4471627,16.0287218 C17.4463569,16.0335568 17.4455155,16.0383857 17.4446387,16.0432083 C17.345843,16.5865846 16.8252597,16.9469884 16.2818833,16.8481927 L4.91303792,14.7811299 C4.53842737,14.7130189 4.23500006,14.4380834 4.13039941,14.0719812 L2.30560137,7.68518803 C2.28007524,7.59584656 2.26712532,7.50338343 2.26712532,7.4104669 C2.26712532,6.85818215 2.71484057,6.4104669 3.26712532,6.4104669 L16.9929851,6.4104669 L17.606173,3.78251876 C17.7307772,3.24850086 18.2068633,2.87071314 18.7552257,2.87071314 L20.8200821,2.87071314 C21.4717328,2.87071314 22,3.39898039 22,4.05063106 C22,4.70228173 21.4717328,5.23054898 20.8200821,5.23054898 L19.6915238,5.23054898 L18.1446364,11.84388 Z' class='svg' opacity='0.3'/>
                                            <path d='M6.5,21 C5.67157288,21 5,20.3284271 5,19.5 C5,18.6715729 5.67157288,18 6.5,18 C7.32842712,18 8,18.6715729 8,19.5 C8,20.3284271 7.32842712,21 6.5,21 Z M15.5,21 C14.6715729,21 14,20.3284271 14,19.5 C14,18.6715729 14.6715729,18 15.5,18 C16.3284271,18 17,18.6715729 17,19.5 C17,20.3284271 16.3284271,21 15.5,21 Z' class='svg'/>
                                        </g>
                                    </svg>
                                </span>
                                <span class='actionConText flex'>Webshop beállítások</span>
                            </span>
                        </span>
                    </div>
                    <div class='flex flex-col profileActionItem'>
                        <span class='flex flex-row w-100 flex-align-c flex-justify-con-sb'>
                            <span class='flex flex-row flex-align-c'>
                                <span class='actionConIcon flex'>
                                    <svg xmlns='http://www.w3.org/2000/svg' xmlns:xlink='http://www.w3.org/1999/xlink' width='24px' height='24px' viewBox='0 0 24 24' version='1.1'>
                                        <g stroke='none' stroke-width='1' fill='none' fill-rule='evenodd'>
                                            <rect x='0' y='0' width='24' height='24'/>
                                            <path d='M12.0700837,4.0003006 C11.3895108,5.17692613 11,6.54297551 11,8 C11,12.3948932 14.5439081,15.9620623 18.9299163,15.9996994 C17.5467214,18.3910707 14.9612535,20 12,20 C7.581722,20 4,16.418278 4,12 C4,7.581722 7.581722,4 12,4 C12.0233848,4 12.0467462,4.00010034 12.0700837,4.0003006 Z' class='svg'/>
                                        </g>
                                    </svg>
                                </span>
                                <span class='actionConText flex'>Téma beállítása</span>
                            </span>
                        </span>
                    </div>
                    <div class='flex flex-col profileActionItem'>
                        <span class='flex flex-row w-100 flex-align-c flex-justify-con-sb'>
                            <span class='flex flex-row flex-align-c'>
                                <span class='actionConIcon flex'>
                                    <svg xmlns='http://www.w3.org/2000/svg' xmlns:xlink='http://www.w3.org/1999/xlink' width='24px' height='24px' viewBox='0 0 24 24' version='1.1'>
                                        <g stroke='none' stroke-width='1' fill='none' fill-rule='evenodd'>
                                            <rect x='0' y='0' width='24' height='24'/>
                                            <circle class='svg' opacity='0.3' cx='12' cy='12' r='9'/>
                                            <path d='M11.7357634,20.9961946 C6.88740052,20.8563914 3,16.8821712 3,12 C3,11.9168367 3.00112797,11.8339369 3.00336944,11.751315 C3.66233009,11.8143341 4.85636818,11.9573854 4.91262842,12.4204038 C4.9904938,13.0609191 4.91262842,13.8615942 5.45804656,14.101772 C6.00346469,14.3419498 6.15931561,13.1409372 6.6267482,13.4612567 C7.09418079,13.7815761 8.34086797,14.0899175 8.34086797,14.6562185 C8.34086797,15.222396 8.10715168,16.1034596 8.34086797,16.2636193 C8.57458427,16.423779 9.5089688,17.54465 9.50920913,17.7048097 C9.50956962,17.8649694 9.83857487,18.6793513 9.74040201,18.9906563 C9.65905192,19.2487394 9.24857641,20.0501554 8.85059781,20.4145589 C9.75315358,20.7620621 10.7235846,20.9657742 11.7357634,20.9960544 L11.7357634,20.9961946 Z M8.28272988,3.80112099 C9.4158415,3.28656421 10.6744554,3 12,3 C15.5114513,3 18.5532143,5.01097452 20.0364482,7.94408274 C20.069657,8.72412177 20.0638332,9.39135321 20.2361262,9.6327358 C21.1131932,10.8600506 18.0995147,11.7043158 18.5573343,13.5605384 C18.7589671,14.3794892 16.5527814,14.1196773 16.0139722,14.886394 C15.4748026,15.6527403 14.1574598,15.137809 13.8520064,14.9904917 C13.546553,14.8431744 12.3766497,15.3341497 12.4789081,14.4995164 C12.5805657,13.664636 13.2922889,13.6156126 14.0555619,13.2719546 C14.8184743,12.928667 15.9189236,11.7871741 15.3781918,11.6380045 C12.8323064,10.9362407 11.963771,8.47852395 11.963771,8.47852395 C11.8110443,8.44901109 11.8493762,6.74109366 11.1883616,6.69207022 C10.5267462,6.64279981 10.170464,6.88841096 9.20435656,6.69207022 C8.23764828,6.49572949 8.44144409,5.85743687 8.2887174,4.48255778 C8.25453994,4.17415686 8.25619136,3.95717082 8.28272988,3.80112099 Z M20.9991771,11.8770357 C20.9997251,11.9179585 21,11.9589471 21,12 C21,16.9406923 17.0188468,20.9515364 12.0895088,20.9995641 C16.970233,20.9503326 20.9337111,16.888438 20.9991771,11.8770357 Z' class='svg' opacity='0.3'/>
                                        </g>
                                    </svg>
                                </span>
                                <span class='actionConText flex'>Nyelv kiválasztása</span>
                            </span>
                        </span>
                    </div>
                </div>
            `;
        }

    }

    function redirect (link) {
        window.location.href = '/' + link;
    }


</script>
";

//require_once($_SERVER['DOCUMENT_ROOT'].'/includes/footer.php');

?>

<?php

        if (isset($_SESSION['loggedin'])) {
            echo "
                <script>
                const theme = '". $theme ."';
                if (theme === 'auto') {
                    const darkThemeMq = window.matchMedia('(prefers-color-scheme: light)');
                    if (darkThemeMq.matches) {
                        html.dataset.theme = `theme-light`;                            
                    } else {
                        html.dataset.theme = `theme-dark`;   
                    }
                } else {
                    html.dataset.theme = 'theme-' + theme;   
                }
                </script>
            ";
        } else {
            echo "
                <script>
                    const darkThemeMq = window.matchMedia('(prefers-color-scheme: light)');
                    if (!localStorage.getItem('theme')) {
                        if (darkThemeMq.matches) {
                            html.dataset.theme = `theme-light`;                            
                        } else {
                            html.dataset.theme = `theme-dark`;   
                        }
                    } else {
                        html.dataset.theme = localStorage.getItem('theme');
                    }
                </script>
            ";
        }

        ?>
        <script src="/assets/script/swiper/swiper-bundle.min.js"></script>
        <script src="/assets/script/main.js"></script>   