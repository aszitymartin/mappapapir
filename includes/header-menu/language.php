                        <?php
                            require_once($_SERVER['DOCUMENT_ROOT'].'/includes/inc.php'); 
                        ?>
                        <div class='profileActionCon flex flex-col absolute'>
                            <div class="menuLoad">
                                <div class="flex flex-col flex-align-c flex-justify-con-c padding-1">
                                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="3rem" height="3rem" viewBox="0 0 24 24" version="1.1">
                                        <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"><g><polygon points="0 0 24 0 24 24 0 24"/></g><path d="M12,4 L12,6 C8.6862915,6 6,8.6862915 6,12 C6,15.3137085 8.6862915,18 12,18 C15.3137085,18 18,15.3137085 18,12 C18,10.9603196 17.7360885,9.96126435 17.2402578,9.07513926 L18.9856052,8.09853149 C19.6473536,9.28117708 20,10.6161442 20,12 C20,16.418278 16.418278,20 12,20 C7.581722,20 4,16.418278 4,12 C4,7.581722 7.581722,4 12,4 Z" class="svg" fill-rule="nonzero" opacity="0.3" transform="translate(12.000000, 12.000000) scale(-1, 1) translate(-12.000000, -12.000000) "/></g>
                                    </svg>
                                </div>
                            </div>
                            <div class="menuLoaded">
                                <div class='flex flex-row flex-align-c profileActionItemHead flex-justify-con-l'>
                                    <span class='actionConIcon flex'>
                                        <svg class='pointer' onclick='profileActionPanel("settings");' xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                            <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"><rect x="0" y="0" width="24" height="24"/><circle class="svg" opacity="0.3" cx="12" cy="12" r="10"/><path d="M6.96323356,15.1775211 C6.62849853,15.5122561 6.08578582,15.5122561 5.75105079,15.1775211 C5.41631576,14.842786 5.41631576,14.3000733 5.75105079,13.9653383 L10.8939067,8.82248234 C11.2184029,8.49798619 11.7409054,8.4866328 12.0791905,8.79672747 L17.2220465,13.5110121 C17.5710056,13.8308912 17.5945795,14.3730917 17.2747004,14.7220508 C16.9548212,15.0710098 16.4126207,15.0945838 16.0636617,14.7747046 L11.5257773,10.6149773 L6.96323356,15.1775211 Z" class="svg" fill-rule="nonzero" transform="translate(11.500001, 12.000001) scale(-1, 1) rotate(-270.000000) translate(-11.500001, -12.000001) "/></g>
                                        </svg>
                                    </span>
                                    <span class='profileActionTitle flex menuLanguageSettings'>
                                        <span key="menuLanguageSettings">Nyelv beállítása</span>
                                    </span>
                                </div>
                                <div class="theme-body">
                                    <div class="theme-desc text-align-c">
                                        <span class="text-secondary text-small menuLanguageDesc">
                                            <span key="menuLanguageDesc">Válassza ki az önnek megfelelő megjelenési a nyelvet, ami a továbbiakban az alapértelmezett nyelv lesz az oldalon.</span>
                                        </span>
                                    </div>
                                    <div class="theme-button-con flex flex-col">
                                        <div class="theme-item flex flex-row" onclick="setLanguage('hu')">
                                            <div class="theme-button flex flex-align-c flex-justify-con-sb w-100">
                                                <span class="text-primary">Magyar</span>
                                                <label class="radio">
                                                    <input type="radio" name="radio" id='language-hu' checked>
                                                    <span class="checkmark"></span>
                                                </label>
                                            </div>
                                        </div>
                                        <div class="theme-item flex flex-row" onclick="setLanguage('en')">
                                            <div class="theme-button flex flex-align-c flex-justify-con-sb w-100">
                                                <span class="text-primary">English</span>
                                                <label class="radio">
                                                    <input type="radio" name="radio" id='language-en'>
                                                    <span class="checkmark"></span>
                                                </label>
                                            </div>
                                        </div>
                                        <div class="theme-item flex flex-row" onclick="setLanguage('de')">
                                            <div class="theme-button flex flex-align-c flex-justify-con-sb w-100">
                                                <span class="text-primary">Deutsch</span>
                                                <label class="radio">
                                                    <input type="radio" name="radio" id='language-de'>
                                                    <span class="checkmark"></span>
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <script>
                            $('.menuLoaded').hide();$('.menuLoad').show();
                            setTimeout(() => {$('.menuLoaded').show();$('.menuLoad').remove();}, 150);
                        </script>
                        <script src="/assets/script/internationalize/jquery.MultiLanguage.js"></script>