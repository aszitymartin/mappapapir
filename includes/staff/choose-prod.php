                        <?php require_once($_SERVER['DOCUMENT_ROOT'].'/assets/alph.php'); ?>
                        <div class='padding-1 flex flex-col h-100'>
                            <div class="menuLoad">
                                <div class="flex flex-col flex-align-c flex-justify-con-c padding-1">
                                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="3rem" height="3rem" viewBox="0 0 24 24" version="1.1">
                                        <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"><g><polygon points="0 0 24 0 24 24 0 24"/></g><path d="M12,4 L12,6 C8.6862915,6 6,8.6862915 6,12 C6,15.3137085 8.6862915,18 12,18 C15.3137085,18 18,15.3137085 18,12 C18,10.9603196 17.7360885,9.96126435 17.2402578,9.07513926 L18.9856052,8.09853149 C19.6473536,9.28117708 20,10.6161442 20,12 C20,16.418278 16.418278,20 12,20 C7.581722,20 4,16.418278 4,12 C4,7.581722 7.581722,4 12,4 Z" class="svg" fill-rule="nonzero" opacity="0.3" transform="translate(12.000000, 12.000000) scale(-1, 1) translate(-12.000000, -12.000000) "/></g>
                                    </svg>
                                </div>
                            </div>
                            <div class="menuLoaded flex flex-col h-100">
                                <div class="sidenav-header w-100 flex flex-row flex-align-c flex-justify-con-sb" style="margin-bottom: 1rem;">
                                    <span class="flex flex-col" id="section-header">
                                        <span class="header_title_heading">Termékek</span>
                                    </span>
                                    <span class="flex">
                                        <span class="text-primary pointer" onclick="closeAuth()" aria-label="Bezárás">
                                            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                                <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"><rect x="0" y="0" width="24" height="24"/><circle class="svg" opacity="0.3" cx="12" cy="12" r="10"/><path d="M12.0355339,10.6213203 L14.863961,7.79289322 C15.2544853,7.40236893 15.8876503,7.40236893 16.2781746,7.79289322 C16.6686989,8.18341751 16.6686989,8.81658249 16.2781746,9.20710678 L13.4497475,12.0355339 L16.2781746,14.863961 C16.6686989,15.2544853 16.6686989,15.8876503 16.2781746,16.2781746 C15.8876503,16.6686989 15.2544853,16.6686989 14.863961,16.2781746 L12.0355339,13.4497475 L9.20710678,16.2781746 C8.81658249,16.6686989 8.18341751,16.6686989 7.79289322,16.2781746 C7.40236893,15.8876503 7.40236893,15.2544853 7.79289322,14.863961 L10.6213203,12.0355339 L7.79289322,9.20710678 C7.40236893,8.81658249 7.40236893,8.18341751 7.79289322,7.79289322 C8.18341751,7.40236893 8.81658249,7.40236893 9.20710678,7.79289322 L12.0355339,10.6213203 Z" class="svg" /></g>
                                            </svg>
                                        </span>
                                    </span>
                                </div>
                                <div class="theme-body flex flex-col" id="product-body">
                                    <div class="flex flex-col gap-1">
                                        <div class="theme-button-con flex flex-col" id="manage-products">
                                            <div class="product-button flex flex-row padding-1 item-bg-light border-soft ease user-select-none pointer">
                                                <div class="flex flex-row flex-align-c flex-justify-con-sb">
                                                    <div class="flex" style="margin-right: 1rem;">
                                                        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="3rem" height="3rem" viewBox="0 0 24 24" version="1.1">
                                                            <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"><rect x="0" y="0" width="24" height="24"></rect><path d="M8,3 L8,3.5 C8,4.32842712 8.67157288,5 9.5,5 L14.5,5 C15.3284271,5 16,4.32842712 16,3.5 L16,3 L18,3 C19.1045695,3 20,3.8954305 20,5 L20,21 C20,22.1045695 19.1045695,23 18,23 L6,23 C4.8954305,23 4,22.1045695 4,21 L4,5 C4,3.8954305 4.8954305,3 6,3 L8,3 Z" class="svg" opacity="0.3"></path><path d="M11,2 C11,1.44771525 11.4477153,1 12,1 C12.5522847,1 13,1.44771525 13,2 L14.5,2 C14.7761424,2 15,2.22385763 15,2.5 L15,3.5 C15,3.77614237 14.7761424,4 14.5,4 L9.5,4 C9.22385763,4 9,3.77614237 9,3.5 L9,2.5 C9,2.22385763 9.22385763,2 9.5,2 L11,2 Z" class="svg"></path><rect class="svg" opacity="0.3" x="7" y="10" width="5" height="2" rx="1"></rect><rect class="svg" opacity="0.3" x="7" y="14" width="9" height="2" rx="1"></rect></g>
                                                        </svg>
                                                    </div>
                                                    <div class="flex flex-col">
                                                        <span class="text-primary bold">Termék kezelése</span>
                                                        <span class="text-secondary small">Termékek és adatainak kezelése</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="theme-button-con flex flex-col" id="manage-discount">
                                            <div class="product-button flex flex-row padding-1 item-bg-light border-soft ease user-select-none pointer">
                                                <div class="flex flex-row flex-align-c flex-justify-con-sb">
                                                    <div class="flex" style="margin-right: 1rem;">
                                                        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="3rem" height="3rem" viewBox="0 0 24 24" version="1.1">
                                                            <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"><rect x="0" y="0" width="24" height="24"/><polygon class="svg" opacity="0.3" points="12 20.0218549 8.47346039 21.7286168 6.86905972 18.1543453 3.07048824 17.1949849 4.13894342 13.4256452 1.84573388 10.2490577 5.08710286 8.04836581 5.3722735 4.14091196 9.2698837 4.53859595 12 1.72861679 14.7301163 4.53859595 18.6277265 4.14091196 18.9128971 8.04836581 22.1542661 10.2490577 19.8610566 13.4256452 20.9295118 17.1949849 17.1309403 18.1543453 15.5265396 21.7286168"/><polygon class="svg" points="14.0890818 8.60255815 8.36079737 14.7014391 9.70868621 16.049328 15.4369707 9.950447"/><path d="M10.8543431,9.1753866 C10.8543431,10.1252593 10.085524,10.8938719 9.13585777,10.8938719 C8.18793881,10.8938719 7.41737243,10.1252593 7.41737243,9.1753866 C7.41737243,8.22551387 8.18793881,7.45690126 9.13585777,7.45690126 C10.085524,7.45690126 10.8543431,8.22551387 10.8543431,9.1753866" class="svg" opacity="0.3"/><path d="M14.8641422,16.6221564 C13.9162233,16.6221564 13.1456569,15.8535438 13.1456569,14.9036711 C13.1456569,13.9520555 13.9162233,13.1851857 14.8641422,13.1851857 C15.8138085,13.1851857 16.5826276,13.9520555 16.5826276,14.9036711 C16.5826276,15.8535438 15.8138085,16.6221564 14.8641422,16.6221564 Z" class="svg" opacity="0.3"/></g>
                                                        </svg>
                                                    </div>
                                                    <div class="flex flex-col">
                                                        <span class="text-primary bold">Kedvezmények kezelése</span>
                                                        <span class="text-secondary small">Termékkedvezmények kezelése</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="theme-button-con flex flex-col">
                                            <div class="product-button flex flex-row padding-1 item-bg-light border-soft ease user-select-none pointer">
                                                <div class="flex flex-row flex-align-c flex-justify-con-sb">
                                                    <div class="flex" style="margin-right: 1rem;">
                                                        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="3rem" height="3rem" viewBox="0 0 24 24" version="1.1">
                                                            <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"><polygon points="0 0 24 0 24 24 0 24"></polygon><path d="M12,18 L7.91561963,20.1472858 C7.42677504,20.4042866 6.82214789,20.2163401 6.56514708,19.7274955 C6.46280801,19.5328351 6.42749334,19.309867 6.46467018,19.0931094 L7.24471742,14.545085 L3.94038429,11.3241562 C3.54490071,10.938655 3.5368084,10.3055417 3.92230962,9.91005817 C4.07581822,9.75257453 4.27696063,9.65008735 4.49459766,9.61846284 L9.06107374,8.95491503 L11.1032639,4.81698575 C11.3476862,4.32173209 11.9473121,4.11839309 12.4425657,4.36281539 C12.6397783,4.46014562 12.7994058,4.61977315 12.8967361,4.81698575 L14.9389263,8.95491503 L19.5054023,9.61846284 C20.0519472,9.69788046 20.4306287,10.2053233 20.351211,10.7518682 C20.3195865,10.9695052 20.2170993,11.1706476 20.0596157,11.3241562 L16.7552826,14.545085 L17.5353298,19.0931094 C17.6286908,19.6374458 17.263103,20.1544017 16.7187666,20.2477627 C16.5020089,20.2849396 16.2790408,20.2496249 16.0843804,20.1472858 L12,18 Z" class="svg"></path></g>
                                                        </svg>
                                                    </div>
                                                    <div class="flex flex-col">
                                                        <span class="text-primary bold">Termékértékelések ellenőrzése</span>
                                                        <span class="text-secondary small">Kezelje a termékek értékelését</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <script>
                            // Loading icon megjelenitese, hogy legyen ideje a kivalasztott nyelvnek betoltodni az oldalon
                            $('.menuLoaded').hide();$('.menuLoad').show();setTimeout(() => {$('.menuLoaded').show();$('.menuLoad').remove();}, 150);
                            $('#manage-products').click(function () { $('#product-body').load('products/load.php');});
                            $("#manage-discount").click(function () { $('#product-body').load('discount/load.php');});
                        </script>
                        <script>
                            function productHome () {$('#staff_auth_con').load('/includes/staff/choose-prod.php');}
                            function productMain () {$('#product-body').load('products/load.php');}
                            function discountMain () {$('#product-body').load('discount/load.php');}
                        </script>
                        <script>function searchDiscount () {var input, filter, con, item, i, txtValue;input = document.getElementById("discount-search");filter = input.value.toUpperCase();con = document.getElementById("discount-items-con");item = con.getElementsByTagName("label");for (i = 0; i < item.length; i++) {txtValue = item[i].getAttribute('search-key');if (txtValue.toUpperCase().indexOf(filter) > -1) {item[i].parentNode.style.display = "";}else {item[i].parentNode.style.display = "none";}}}</script>
                        <script src="/assets/script/internationalize/jquery.MultiLanguage.js"></script>