var c__wrapper = document.createElement('div'); c__wrapper.classList = "wrapper_dark";
var c__box = document.createElement('div'); c__box.classList = "d__confirm fixed flex flex-col border-soft item-bg box-shadow padding-1";

$('#srt__review').click(function () { document.body.append(c__wrapper); c__wrapper.append(c__box); disableScroll();
    c__box.innerHTML = `
    <div class="flex flex-row flex-align-c flex-justify-con-sb">
        <span class="text-primary bold">Értékelések rendezése</span>
        <span class="button button-secondary small-med" id="cl__box">Mégsem</span>
    </div><br>
    <div class="flex flex-col gap-1">
        <span class="text-secondary small">Válassza ki az önnek megfelelő rendezési/szűrési lehetőséget, amellyel rendezni szeretné az értékeléseket.</span>
        <div class="flex flex-col">
            <div class="flex flex-align-c">
                <span class="text-primary bold">Dátum szerint</span>
            </div>
            <div class="flex flex-row flex-align-c flex-justify-con-c gap-2">
                <span class="o__con">
                    <input type="radio" name="revorder" id="datedesc" value="10" />
                    <label for="datedesc">
                        <div class="flex flex-col flex-align-c flex-justify-con-c pointer active-hover-primary">
                            <span class="relative">
                                <span class="svg-faded slct__faded">
                                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="48px" height="48px" viewBox="0 0 24 24" version="1.1"><g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"><rect x="0" y="0" width="24" height="24"/><path d="M12,22 C7.02943725,22 3,17.9705627 3,13 C3,8.02943725 7.02943725,4 12,4 C16.9705627,4 21,8.02943725 21,13 C21,17.9705627 16.9705627,22 12,22 Z" class="svg" opacity="0.3"/><path d="M11.9630156,7.5 L12.0475062,7.5 C12.3043819,7.5 12.5194647,7.69464724 12.5450248,7.95024814 L13,12.5 L16.2480695,14.3560397 C16.403857,14.4450611 16.5,14.6107328 16.5,14.7901613 L16.5,15 C16.5,15.2109164 16.3290185,15.3818979 16.1181021,15.3818979 C16.0841582,15.3818979 16.0503659,15.3773725 16.0176181,15.3684413 L11.3986612,14.1087258 C11.1672824,14.0456225 11.0132986,13.8271186 11.0316926,13.5879956 L11.4644883,7.96165175 C11.4845267,7.70115317 11.7017474,7.5 11.9630156,7.5 Z" class="svg" /></g></svg>
                                </span>
                                <svg class="absolute srto__ind" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="18px" height="18px" viewBox="0 0 24 24" version="1.1"><g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"><polygon points="0 0 24 0 24 24 0 24"/><rect class="svg" opacity="0.3" x="11" y="4" width="2" height="10" rx="1"/><path d="M6.70710678,19.7071068 C6.31658249,20.0976311 5.68341751,20.0976311 5.29289322,19.7071068 C4.90236893,19.3165825 4.90236893,18.6834175 5.29289322,18.2928932 L11.2928932,12.2928932 C11.6714722,11.9143143 12.2810586,11.9010687 12.6757246,12.2628459 L18.6757246,17.7628459 C19.0828436,18.1360383 19.1103465,18.7686056 18.7371541,19.1757246 C18.3639617,19.5828436 17.7313944,19.6103465 17.3242754,19.2371541 L12.0300757,14.3841378 L6.70710678,19.7071068 Z" class="svg" fill-rule="nonzero" transform="translate(12.000003, 15.999999) scale(1, -1) translate(-12.000003, -15.999999) "/></g></svg>
                            </span>
                            <span class="text-secondary small-med hover-actived-primary user-select-none">Csökkenő</span>
                        </div>
                    </label>
                </span>
                <span class="o__con">
                    <input type="radio" name="revorder" id="dateasc" value="11" />
                    <label for="dateasc">
                        <div class="flex flex-col flex-align-c flex-justify-con-c pointer active-hover-primary">
                            <span class="relative">
                                <span class="svg-faded slct__faded">
                                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="48px" height="48px" viewBox="0 0 24 24" version="1.1"><g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"><rect x="0" y="0" width="24" height="24"/><path d="M12,22 C7.02943725,22 3,17.9705627 3,13 C3,8.02943725 7.02943725,4 12,4 C16.9705627,4 21,8.02943725 21,13 C21,17.9705627 16.9705627,22 12,22 Z" class="svg" opacity="0.3"/><path d="M11.9630156,7.5 L12.0475062,7.5 C12.3043819,7.5 12.5194647,7.69464724 12.5450248,7.95024814 L13,12.5 L16.2480695,14.3560397 C16.403857,14.4450611 16.5,14.6107328 16.5,14.7901613 L16.5,15 C16.5,15.2109164 16.3290185,15.3818979 16.1181021,15.3818979 C16.0841582,15.3818979 16.0503659,15.3773725 16.0176181,15.3684413 L11.3986612,14.1087258 C11.1672824,14.0456225 11.0132986,13.8271186 11.0316926,13.5879956 L11.4644883,7.96165175 C11.4845267,7.70115317 11.7017474,7.5 11.9630156,7.5 Z" class="svg" /></g></svg>
                                </span>
                                <svg class="absolute srto__ind" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="18px" height="18px" viewBox="0 0 24 24" version="1.1"><g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"><polygon points="0 0 24 0 24 24 0 24"/><rect class="svg" opacity="0.3" x="11" y="10" width="2" height="10" rx="1"/><path d="M6.70710678,12.7071068 C6.31658249,13.0976311 5.68341751,13.0976311 5.29289322,12.7071068 C4.90236893,12.3165825 4.90236893,11.6834175 5.29289322,11.2928932 L11.2928932,5.29289322 C11.6714722,4.91431428 12.2810586,4.90106866 12.6757246,5.26284586 L18.6757246,10.7628459 C19.0828436,11.1360383 19.1103465,11.7686056 18.7371541,12.1757246 C18.3639617,12.5828436 17.7313944,12.6103465 17.3242754,12.2371541 L12.0300757,7.38413782 L6.70710678,12.7071068 Z" class="svg" fill-rule="nonzero"/></g></svg>
                            </span>
                            <span class="text-secondary small-med hover-actived-primary user-select-none">Növekvő</span>
                        </div>
                    </label>
                </span>
                <span class="o__con">
                    <input type="radio" name="revorder" id="dateaut" value="12" />
                    <label for="dateaut">
                        <div class="flex flex-col flex-align-c flex-justify-con-c pointer active-hover-primary">
                            <span class="relative">
                                <span class="svg-faded slct__faded">
                                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="48px" height="48px" viewBox="0 0 24 24" version="1.1"><g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"><rect x="0" y="0" width="24" height="24"/><path d="M12,22 C7.02943725,22 3,17.9705627 3,13 C3,8.02943725 7.02943725,4 12,4 C16.9705627,4 21,8.02943725 21,13 C21,17.9705627 16.9705627,22 12,22 Z" class="svg" opacity="0.3"/><path d="M11.9630156,7.5 L12.0475062,7.5 C12.3043819,7.5 12.5194647,7.69464724 12.5450248,7.95024814 L13,12.5 L16.2480695,14.3560397 C16.403857,14.4450611 16.5,14.6107328 16.5,14.7901613 L16.5,15 C16.5,15.2109164 16.3290185,15.3818979 16.1181021,15.3818979 C16.0841582,15.3818979 16.0503659,15.3773725 16.0176181,15.3684413 L11.3986612,14.1087258 C11.1672824,14.0456225 11.0132986,13.8271186 11.0316926,13.5879956 L11.4644883,7.96165175 C11.4845267,7.70115317 11.7017474,7.5 11.9630156,7.5 Z" class="svg" /></g></svg>
                                </span>
                                <svg class="absolute srto__ind" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="18px" height="18px" viewBox="0 0 24 24" version="1.1"><g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"><polygon points="0 0 24 0 24 24 0 24"/><rect class="svg" opacity="0.3" transform="translate(12.000000, 12.000000) rotate(-90.000000) translate(-12.000000, -12.000000) " x="7" y="11" width="10" height="2" rx="1"/><path d="M6.70710678,8.70710678 C6.31658249,9.09763107 5.68341751,9.09763107 5.29289322,8.70710678 C4.90236893,8.31658249 4.90236893,7.68341751 5.29289322,7.29289322 L11.2928932,1.29289322 C11.6714722,0.914314282 12.2810586,0.90106866 12.6757246,1.26284586 L18.6757246,6.76284586 C19.0828436,7.13603827 19.1103465,7.76860564 18.7371541,8.17572463 C18.3639617,8.58284362 17.7313944,8.61034655 17.3242754,8.23715414 L12.0300757,3.38413782 L6.70710678,8.70710678 Z" class="svg" fill-rule="nonzero"/><path d="M6.70710678,22.7071068 C6.31658249,23.0976311 5.68341751,23.0976311 5.29289322,22.7071068 C4.90236893,22.3165825 4.90236893,21.6834175 5.29289322,21.2928932 L11.2928932,15.2928932 C11.6714722,14.9143143 12.2810586,14.9010687 12.6757246,15.2628459 L18.6757246,20.7628459 C19.0828436,21.1360383 19.1103465,21.7686056 18.7371541,22.1757246 C18.3639617,22.5828436 17.7313944,22.6103465 17.3242754,22.2371541 L12.0300757,17.3841378 L6.70710678,22.7071068 Z" class="svg" fill-rule="nonzero" transform="translate(12.000003, 18.999999) rotate(-180.000000) translate(-12.000003, -18.999999) "/></g></svg>
                            </span>
                            <span class="text-secondary small-med hover-actived-primary user-select-none">Automatikus</span>
                        </div>
                    </label>
                </span>
            </div>
        </div>
        <div class="flex flex-col">
            <div class="flex flex-align-c">
                <span class="text-primary bold">Értékelések szerint</span>
            </div>
            <div class="flex flex-row flex-align-c flex-justify-con-c gap-2">
                <span class="o__con">
                    <input type="radio" name="revorder" id="revdesc" value="20" />
                    <label for="revdesc">
                        <div class="flex flex-col flex-align-c flex-justify-con-c pointer active-hover-primary">
                            <span class="relative">
                                <span class="svg-faded slct__faded">
                                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="48px" height="48px" viewBox="0 0 24 24" version="1.1"><g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"><polygon points="0 0 24 0 24 24 0 24"></polygon><path d="M12,18 L7.91561963,20.1472858 C7.42677504,20.4042866 6.82214789,20.2163401 6.56514708,19.7274955 C6.46280801,19.5328351 6.42749334,19.309867 6.46467018,19.0931094 L7.24471742,14.545085 L3.94038429,11.3241562 C3.54490071,10.938655 3.5368084,10.3055417 3.92230962,9.91005817 C4.07581822,9.75257453 4.27696063,9.65008735 4.49459766,9.61846284 L9.06107374,8.95491503 L11.1032639,4.81698575 C11.3476862,4.32173209 11.9473121,4.11839309 12.4425657,4.36281539 C12.6397783,4.46014562 12.7994058,4.61977315 12.8967361,4.81698575 L14.9389263,8.95491503 L19.5054023,9.61846284 C20.0519472,9.69788046 20.4306287,10.2053233 20.351211,10.7518682 C20.3195865,10.9695052 20.2170993,11.1706476 20.0596157,11.3241562 L16.7552826,14.545085 L17.5353298,19.0931094 C17.6286908,19.6374458 17.263103,20.1544017 16.7187666,20.2477627 C16.5020089,20.2849396 16.2790408,20.2496249 16.0843804,20.1472858 L12,18 Z" class="svg"></path></g></svg>
                                </span>
                                <svg class="absolute srto__ind" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="18px" height="18px" viewBox="0 0 24 24" version="1.1"><g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"><polygon points="0 0 24 0 24 24 0 24"/><rect class="svg" opacity="0.3" x="11" y="4" width="2" height="10" rx="1"/><path d="M6.70710678,19.7071068 C6.31658249,20.0976311 5.68341751,20.0976311 5.29289322,19.7071068 C4.90236893,19.3165825 4.90236893,18.6834175 5.29289322,18.2928932 L11.2928932,12.2928932 C11.6714722,11.9143143 12.2810586,11.9010687 12.6757246,12.2628459 L18.6757246,17.7628459 C19.0828436,18.1360383 19.1103465,18.7686056 18.7371541,19.1757246 C18.3639617,19.5828436 17.7313944,19.6103465 17.3242754,19.2371541 L12.0300757,14.3841378 L6.70710678,19.7071068 Z" class="svg" fill-rule="nonzero" transform="translate(12.000003, 15.999999) scale(1, -1) translate(-12.000003, -15.999999) "/></g></svg>
                            </span>
                            <span class="text-secondary small-med hover-actived-primary user-select-none">Csökkenő</span>
                        </div>
                    </label>
                </span>
                <span class="o__con">
                    <input type="radio" name="revorder" id="revasc" value="21" />
                    <label for="revasc">
                        <div class="flex flex-col flex-align-c flex-justify-con-c pointer active-hover-primary">
                            <span class="relative">
                                <span class="svg-faded slct__faded">
                                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="48px" height="48px" viewBox="0 0 24 24" version="1.1"><g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"><polygon points="0 0 24 0 24 24 0 24"></polygon><path d="M12,18 L7.91561963,20.1472858 C7.42677504,20.4042866 6.82214789,20.2163401 6.56514708,19.7274955 C6.46280801,19.5328351 6.42749334,19.309867 6.46467018,19.0931094 L7.24471742,14.545085 L3.94038429,11.3241562 C3.54490071,10.938655 3.5368084,10.3055417 3.92230962,9.91005817 C4.07581822,9.75257453 4.27696063,9.65008735 4.49459766,9.61846284 L9.06107374,8.95491503 L11.1032639,4.81698575 C11.3476862,4.32173209 11.9473121,4.11839309 12.4425657,4.36281539 C12.6397783,4.46014562 12.7994058,4.61977315 12.8967361,4.81698575 L14.9389263,8.95491503 L19.5054023,9.61846284 C20.0519472,9.69788046 20.4306287,10.2053233 20.351211,10.7518682 C20.3195865,10.9695052 20.2170993,11.1706476 20.0596157,11.3241562 L16.7552826,14.545085 L17.5353298,19.0931094 C17.6286908,19.6374458 17.263103,20.1544017 16.7187666,20.2477627 C16.5020089,20.2849396 16.2790408,20.2496249 16.0843804,20.1472858 L12,18 Z" class="svg"></path></g></svg>
                                </span>
                                <svg class="absolute srto__ind" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="18px" height="18px" viewBox="0 0 24 24" version="1.1"><g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"><polygon points="0 0 24 0 24 24 0 24"/><rect class="svg" opacity="0.3" x="11" y="10" width="2" height="10" rx="1"/><path d="M6.70710678,12.7071068 C6.31658249,13.0976311 5.68341751,13.0976311 5.29289322,12.7071068 C4.90236893,12.3165825 4.90236893,11.6834175 5.29289322,11.2928932 L11.2928932,5.29289322 C11.6714722,4.91431428 12.2810586,4.90106866 12.6757246,5.26284586 L18.6757246,10.7628459 C19.0828436,11.1360383 19.1103465,11.7686056 18.7371541,12.1757246 C18.3639617,12.5828436 17.7313944,12.6103465 17.3242754,12.2371541 L12.0300757,7.38413782 L6.70710678,12.7071068 Z" class="svg" fill-rule="nonzero"/></g></svg>
                            </span>
                            <span class="text-secondary small-med hover-actived-primary user-select-none">Növekvő</span>
                        </div>
                    </label>
                </span>
                <span class="o__con">
                    <input type="radio" name="revorder" id="revaut" value="22" />
                    <label for="revaut">
                        <div class="flex flex-col flex-align-c flex-justify-con-c pointer active-hover-primary">
                            <span class="relative">
                                <span class="svg-faded slct__faded">
                                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="48px" height="48px" viewBox="0 0 24 24" version="1.1"><g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"><polygon points="0 0 24 0 24 24 0 24"></polygon><path d="M12,18 L7.91561963,20.1472858 C7.42677504,20.4042866 6.82214789,20.2163401 6.56514708,19.7274955 C6.46280801,19.5328351 6.42749334,19.309867 6.46467018,19.0931094 L7.24471742,14.545085 L3.94038429,11.3241562 C3.54490071,10.938655 3.5368084,10.3055417 3.92230962,9.91005817 C4.07581822,9.75257453 4.27696063,9.65008735 4.49459766,9.61846284 L9.06107374,8.95491503 L11.1032639,4.81698575 C11.3476862,4.32173209 11.9473121,4.11839309 12.4425657,4.36281539 C12.6397783,4.46014562 12.7994058,4.61977315 12.8967361,4.81698575 L14.9389263,8.95491503 L19.5054023,9.61846284 C20.0519472,9.69788046 20.4306287,10.2053233 20.351211,10.7518682 C20.3195865,10.9695052 20.2170993,11.1706476 20.0596157,11.3241562 L16.7552826,14.545085 L17.5353298,19.0931094 C17.6286908,19.6374458 17.263103,20.1544017 16.7187666,20.2477627 C16.5020089,20.2849396 16.2790408,20.2496249 16.0843804,20.1472858 L12,18 Z" class="svg"></path></g></svg>
                                </span>
                                <svg class="absolute srto__ind" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="18px" height="18px" viewBox="0 0 24 24" version="1.1"><g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"><polygon points="0 0 24 0 24 24 0 24"/><rect class="svg" opacity="0.3" transform="translate(12.000000, 12.000000) rotate(-90.000000) translate(-12.000000, -12.000000) " x="7" y="11" width="10" height="2" rx="1"/><path d="M6.70710678,8.70710678 C6.31658249,9.09763107 5.68341751,9.09763107 5.29289322,8.70710678 C4.90236893,8.31658249 4.90236893,7.68341751 5.29289322,7.29289322 L11.2928932,1.29289322 C11.6714722,0.914314282 12.2810586,0.90106866 12.6757246,1.26284586 L18.6757246,6.76284586 C19.0828436,7.13603827 19.1103465,7.76860564 18.7371541,8.17572463 C18.3639617,8.58284362 17.7313944,8.61034655 17.3242754,8.23715414 L12.0300757,3.38413782 L6.70710678,8.70710678 Z" class="svg" fill-rule="nonzero"/><path d="M6.70710678,22.7071068 C6.31658249,23.0976311 5.68341751,23.0976311 5.29289322,22.7071068 C4.90236893,22.3165825 4.90236893,21.6834175 5.29289322,21.2928932 L11.2928932,15.2928932 C11.6714722,14.9143143 12.2810586,14.9010687 12.6757246,15.2628459 L18.6757246,20.7628459 C19.0828436,21.1360383 19.1103465,21.7686056 18.7371541,22.1757246 C18.3639617,22.5828436 17.7313944,22.6103465 17.3242754,22.2371541 L12.0300757,17.3841378 L6.70710678,22.7071068 Z" class="svg" fill-rule="nonzero" transform="translate(12.000003, 18.999999) rotate(-180.000000) translate(-12.000003, -18.999999) "/></g></svg>
                            </span>
                            <span class="text-secondary small-med hover-actived-primary user-select-none">Automatikus</span>
                        </div>
                    </label>
                </span>
            </div>
        </div>
        <div class="flex flex-col">
            <div class="flex flex-align-c">
                <span class="text-primary bold">Szavazás szerint</span>
            </div>
            <div class="flex flex-row flex-align-c flex-justify-con-c gap-2">
                <span class="o__con">
                    <input type="radio" name="revorder" id="votedesc" value="30" />
                    <label for="votedesc">
                        <div class="flex flex-col flex-align-c flex-justify-con-c pointer active-hover-primary">
                            <span class="relative">
                                <span class="svg-faded flex flex-col flex-align-c flex-jusify-con-c pointer slct__faded">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"><path d="M 5.7071 15.8929 C 5.0771 16.5229 5.5233 17.6 6.4142 17.6 H 17.5858 C 18.4767 17.6 18.9229 16.5229 18.2929 15.8929 L 12.7 10.3 C 12.3 9.9 11.7 9.9 11.3 10.3 L 5.7071 15.8929 Z" class="svg" opacity="1"></path></svg>
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"><path d="M 5.7071 7.1071 C 5.0771 6.4771 5.5233 5.4 6.4142 5.4 H 17.5858 C 18.4767 5.4 18.9229 6.4771 18.2929 7.1071 L 12.7 12.7 C 12.3 13.1 11.7 13.1 11.3 12.7 L 5.7071 7.1071 Z" class="svg"></path></svg>
                                </span>
                                <svg class="absolute srto__ind" style="right: -50% !important;" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="18px" height="18px" viewBox="0 0 24 24" version="1.1"><g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"><polygon points="0 0 24 0 24 24 0 24"/><rect class="svg" opacity="0.3" x="11" y="4" width="2" height="10" rx="1"/><path d="M6.70710678,19.7071068 C6.31658249,20.0976311 5.68341751,20.0976311 5.29289322,19.7071068 C4.90236893,19.3165825 4.90236893,18.6834175 5.29289322,18.2928932 L11.2928932,12.2928932 C11.6714722,11.9143143 12.2810586,11.9010687 12.6757246,12.2628459 L18.6757246,17.7628459 C19.0828436,18.1360383 19.1103465,18.7686056 18.7371541,19.1757246 C18.3639617,19.5828436 17.7313944,19.6103465 17.3242754,19.2371541 L12.0300757,14.3841378 L6.70710678,19.7071068 Z" class="svg" fill-rule="nonzero" transform="translate(12.000003, 15.999999) scale(1, -1) translate(-12.000003, -15.999999) "/></g></svg>
                            </span>
                            <span class="text-secondary small-med hover-actived-primary user-select-none">Csökkenő</span>
                        </div>
                    </label>
                </span>
                <span class="o__con">
                    <input type="radio" name="revorder" id="voteasc" value="31" />
                    <label for="voteasc">
                        <div class="flex flex-col flex-align-c flex-justify-con-c pointer active-hover-primary">
                            <span class="relative">
                                <span class="svg-faded flex flex-col flex-align-c flex-jusify-con-c pointer slct__faded">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"><path d="M 5.7071 15.8929 C 5.0771 16.5229 5.5233 17.6 6.4142 17.6 H 17.5858 C 18.4767 17.6 18.9229 16.5229 18.2929 15.8929 L 12.7 10.3 C 12.3 9.9 11.7 9.9 11.3 10.3 L 5.7071 15.8929 Z" class="svg" opacity="1"></path></svg>
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"><path d="M 5.7071 7.1071 C 5.0771 6.4771 5.5233 5.4 6.4142 5.4 H 17.5858 C 18.4767 5.4 18.9229 6.4771 18.2929 7.1071 L 12.7 12.7 C 12.3 13.1 11.7 13.1 11.3 12.7 L 5.7071 7.1071 Z" class="svg"></path></svg>
                                </span>
                                <svg class="absolute srto__ind" style="right: -50% !important;" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="18px" height="18px" viewBox="0 0 24 24" version="1.1"><g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"><polygon points="0 0 24 0 24 24 0 24"/><rect class="svg" opacity="0.3" x="11" y="10" width="2" height="10" rx="1"/><path d="M6.70710678,12.7071068 C6.31658249,13.0976311 5.68341751,13.0976311 5.29289322,12.7071068 C4.90236893,12.3165825 4.90236893,11.6834175 5.29289322,11.2928932 L11.2928932,5.29289322 C11.6714722,4.91431428 12.2810586,4.90106866 12.6757246,5.26284586 L18.6757246,10.7628459 C19.0828436,11.1360383 19.1103465,11.7686056 18.7371541,12.1757246 C18.3639617,12.5828436 17.7313944,12.6103465 17.3242754,12.2371541 L12.0300757,7.38413782 L6.70710678,12.7071068 Z" class="svg" fill-rule="nonzero"/></g></svg>
                            </span>
                            <span class="text-secondary small-med hover-actived-primary user-select-none">Növekvő</span>
                        </div>
                    </label>
                </span>
                <span class="o__con">
                    <input type="radio" name="revorder" id="voteaut" value="32" />
                    <label for="voteaut">
                        <div class="flex flex-col flex-align-c flex-justify-con-c pointer active-hover-primary">
                            <span class="relative">
                                <span class="svg-faded flex flex-col flex-align-c flex-jusify-con-c pointer slct__faded">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"><path d="M 5.7071 15.8929 C 5.0771 16.5229 5.5233 17.6 6.4142 17.6 H 17.5858 C 18.4767 17.6 18.9229 16.5229 18.2929 15.8929 L 12.7 10.3 C 12.3 9.9 11.7 9.9 11.3 10.3 L 5.7071 15.8929 Z" class="svg" opacity="1"></path></svg>
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"><path d="M 5.7071 7.1071 C 5.0771 6.4771 5.5233 5.4 6.4142 5.4 H 17.5858 C 18.4767 5.4 18.9229 6.4771 18.2929 7.1071 L 12.7 12.7 C 12.3 13.1 11.7 13.1 11.3 12.7 L 5.7071 7.1071 Z" class="svg"></path></svg>
                                </span>
                                <svg class="absolute srto__ind" style="right: -50% !important;" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="18px" height="18px" viewBox="0 0 24 24" version="1.1"><g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"><polygon points="0 0 24 0 24 24 0 24"/><rect class="svg" opacity="0.3" transform="translate(12.000000, 12.000000) rotate(-90.000000) translate(-12.000000, -12.000000) " x="7" y="11" width="10" height="2" rx="1"/><path d="M6.70710678,8.70710678 C6.31658249,9.09763107 5.68341751,9.09763107 5.29289322,8.70710678 C4.90236893,8.31658249 4.90236893,7.68341751 5.29289322,7.29289322 L11.2928932,1.29289322 C11.6714722,0.914314282 12.2810586,0.90106866 12.6757246,1.26284586 L18.6757246,6.76284586 C19.0828436,7.13603827 19.1103465,7.76860564 18.7371541,8.17572463 C18.3639617,8.58284362 17.7313944,8.61034655 17.3242754,8.23715414 L12.0300757,3.38413782 L6.70710678,8.70710678 Z" class="svg" fill-rule="nonzero"/><path d="M6.70710678,22.7071068 C6.31658249,23.0976311 5.68341751,23.0976311 5.29289322,22.7071068 C4.90236893,22.3165825 4.90236893,21.6834175 5.29289322,21.2928932 L11.2928932,15.2928932 C11.6714722,14.9143143 12.2810586,14.9010687 12.6757246,15.2628459 L18.6757246,20.7628459 C19.0828436,21.1360383 19.1103465,21.7686056 18.7371541,22.1757246 C18.3639617,22.5828436 17.7313944,22.6103465 17.3242754,22.2371541 L12.0300757,17.3841378 L6.70710678,22.7071068 Z" class="svg" fill-rule="nonzero" transform="translate(12.000003, 18.999999) rotate(-180.000000) translate(-12.000003, -18.999999) "/></g></svg>
                            </span>
                            <span class="text-secondary small-med hover-actived-primary user-select-none">Automatikus</span>
                        </div>
                    </label>
                </span>
            </div>
        </div>
    </div><br>
    <div class="flex flex-row flex-align-c flex-justify-con-fe">
        <span id="sr__review" class="button button-disabled small-med">Rendezés</span>
    </div>
    `;

    var radios = document.getElementsByName("revorder"); var selectedValue;
    for(let i = 0; i < radios.length; i++) { radios[i].addEventListener('click', function () { if(this.checked) { selectedValue = this.value; document.getElementById('sr__review').classList.replace('button-disabled','button-primary');} }); }
    $('#sr__review').click(function () { if (selectedValue > 0) { c__wrapper.remove(); enableScroll(); r__order(selectedValue); } });
    $('#cl__box').click(function () { c__wrapper.remove(); enableScroll(); });

    function r__order (orderby) {
        var sort_by_name = function(a, b) {
            if (Number(orderby) === 10 ) { return b.getAttribute('d-id').localeCompare(a.getAttribute('d-id')); }
            if (Number(orderby) === 11 ) { return a.getAttribute('d-id').localeCompare(b.getAttribute('d-id')); }
            if (Number(orderby) === 20 ) { return b.getAttribute('s-id').localeCompare(a.getAttribute('s-id')); }
            if (Number(orderby) === 21 ) { return a.getAttribute('s-id').localeCompare(b.getAttribute('s-id')); }
            if (Number(orderby) === 30 ) { return b.getAttribute('v-id').localeCompare(a.getAttribute('v-id')); }
            if (Number(orderby) === 31 ) { return a.getAttribute('v-id').localeCompare(b.getAttribute('v-id')); }
        }; var list = $("#rvts__container > .rvst__item").get(); list.sort(sort_by_name);
        for (var i = 0; i < list.length; i++) { list[i].parentNode.appendChild(list[i]); }
    }

});