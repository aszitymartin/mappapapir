<?php require_once($_SERVER['DOCUMENT_ROOT'].'/assets/alph.php'); ?>
<script>
document.getElementById('section-header').innerHTML = `<div class="flex flex-row flex-align-c gap-1"><span class="flex pointer" onclick="productHome()"><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1"><g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"><rect x="0" y="0" width="24" height="24"></rect><circle class="svg" opacity="0.3" cx="12" cy="12" r="10"></circle><path d="M6.96323356,15.1775211 C6.62849853,15.5122561 6.08578582,15.5122561 5.75105079,15.1775211 C5.41631576,14.842786 5.41631576,14.3000733 5.75105079,13.9653383 L10.8939067,8.82248234 C11.2184029,8.49798619 11.7409054,8.4866328 12.0791905,8.79672747 L17.2220465,13.5110121 C17.5710056,13.8308912 17.5945795,14.3730917 17.2747004,14.7220508 C16.9548212,15.0710098 16.4126207,15.0945838 16.0636617,14.7747046 L11.5257773,10.6149773 L6.96323356,15.1775211 Z" class="svg" fill-rule="nonzero" transform="translate(11.500001, 12.000001) scale(-1, 1) rotate(-270.000000) translate(-11.500001, -12.000001) "></path></g></svg></span><span class="flex header_title_heading">Kedvezmények</span></div>`;
$('#product-body').css('height', '100%');
document.getElementById('product-body').innerHTML = `
    <div class="flex flex-col gap-1">
        <div class="theme-button-con flex flex-col" id="set-discount">
            <div class="product-button flex flex-row padding-1 item-bg-light border-soft ease user-select-none pointer">
                <div class="flex flex-row flex-align-c flex-justify-con-sb">
                    <div class="flex" style="margin-right: 1rem;">
                        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="3rem" height="3rem" viewBox="0 0 24 24" version="1.1">
                            <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"><rect x="0" y="0" width="24" height="24"/><polygon class="svg" opacity="0.3" points="12 20.0218549 8.47346039 21.7286168 6.86905972 18.1543453 3.07048824 17.1949849 4.13894342 13.4256452 1.84573388 10.2490577 5.08710286 8.04836581 5.3722735 4.14091196 9.2698837 4.53859595 12 1.72861679 14.7301163 4.53859595 18.6277265 4.14091196 18.9128971 8.04836581 22.1542661 10.2490577 19.8610566 13.4256452 20.9295118 17.1949849 17.1309403 18.1543453 15.5265396 21.7286168"/><polygon class="svg" points="14.0890818 8.60255815 8.36079737 14.7014391 9.70868621 16.049328 15.4369707 9.950447"/><path d="M10.8543431,9.1753866 C10.8543431,10.1252593 10.085524,10.8938719 9.13585777,10.8938719 C8.18793881,10.8938719 7.41737243,10.1252593 7.41737243,9.1753866 C7.41737243,8.22551387 8.18793881,7.45690126 9.13585777,7.45690126 C10.085524,7.45690126 10.8543431,8.22551387 10.8543431,9.1753866" class="svg" opacity="0.3"/><path d="M14.8641422,16.6221564 C13.9162233,16.6221564 13.1456569,15.8535438 13.1456569,14.9036711 C13.1456569,13.9520555 13.9162233,13.1851857 14.8641422,13.1851857 C15.8138085,13.1851857 16.5826276,13.9520555 16.5826276,14.9036711 C16.5826276,15.8535438 15.8138085,16.6221564 14.8641422,16.6221564 Z" class="svg" opacity="0.3"/></g>
                        </svg>
                    </div>
                    <div class="flex flex-col">
                        <span class="text-primary bold">Kedvezmény hozzáadása</span>
                        <span class="text-secondary small">Válassza ki azt a terméket, amelyhez kedvezményt szeretne adni</span>
                    </div>
                </div>
            </div>
        </div>
        <div class="theme-button-con flex flex-col" id="remove-discount">
            <div class="product-button flex flex-row padding-1 item-bg-light border-soft ease user-select-none pointer">
                <div class="flex flex-row flex-align-c flex-justify-con-sb">
                    <div class="flex" style="margin-right: 1rem;">
                        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="3rem" height="3rem" viewBox="0 0 24 24" version="1.1">
                            <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"><rect x="0" y="0" width="24" height="24"/><polygon class="svg" opacity="0.3" points="12 20.0218549 8.47346039 21.7286168 6.86905972 18.1543453 3.07048824 17.1949849 4.13894342 13.4256452 1.84573388 10.2490577 5.08710286 8.04836581 5.3722735 4.14091196 9.2698837 4.53859595 12 1.72861679 14.7301163 4.53859595 18.6277265 4.14091196 18.9128971 8.04836581 22.1542661 10.2490577 19.8610566 13.4256452 20.9295118 17.1949849 17.1309403 18.1543453 15.5265396 21.7286168"/><polygon class="svg" points="14.0890818 8.60255815 8.36079737 14.7014391 9.70868621 16.049328 15.4369707 9.950447"/><path d="M10.8543431,9.1753866 C10.8543431,10.1252593 10.085524,10.8938719 9.13585777,10.8938719 C8.18793881,10.8938719 7.41737243,10.1252593 7.41737243,9.1753866 C7.41737243,8.22551387 8.18793881,7.45690126 9.13585777,7.45690126 C10.085524,7.45690126 10.8543431,8.22551387 10.8543431,9.1753866" class="svg" opacity="0.3"/><path d="M14.8641422,16.6221564 C13.9162233,16.6221564 13.1456569,15.8535438 13.1456569,14.9036711 C13.1456569,13.9520555 13.9162233,13.1851857 14.8641422,13.1851857 C15.8138085,13.1851857 16.5826276,13.9520555 16.5826276,14.9036711 C16.5826276,15.8535438 15.8138085,16.6221564 14.8641422,16.6221564 Z" class="svg" opacity="0.3"/></g>
                        </svg>
                    </div>
                    <div class="flex flex-col">
                        <span class="text-primary bold">Kedvezmény eltávolítása</span>
                        <span class="text-secondary small">Válassza ki azt a terméket, amelyről el szeretné távolítani a kedvezményt</span>
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
                        <span class="text-primary bold">Kedvezmény kezelése</span>
                        <span class="text-secondary small">Válassza ki azt a terméket, amelynek kedvezményét kezelni szeretné</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
`;
$("#set-discount").click(function () {
    document.getElementById('section-header').innerHTML = `<div class="flex flex-row flex-align-c gap-1"><span class="flex pointer" onclick="discountMain()" aria-label="Vissza"><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1"><g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"><rect x="0" y="0" width="24" height="24"></rect><circle class="svg" opacity="0.3" cx="12" cy="12" r="10"></circle><path d="M6.96323356,15.1775211 C6.62849853,15.5122561 6.08578582,15.5122561 5.75105079,15.1775211 C5.41631576,14.842786 5.41631576,14.3000733 5.75105079,13.9653383 L10.8939067,8.82248234 C11.2184029,8.49798619 11.7409054,8.4866328 12.0791905,8.79672747 L17.2220465,13.5110121 C17.5710056,13.8308912 17.5945795,14.3730917 17.2747004,14.7220508 C16.9548212,15.0710098 16.4126207,15.0945838 16.0636617,14.7747046 L11.5257773,10.6149773 L6.96323356,15.1775211 Z" class="svg" fill-rule="nonzero" transform="translate(11.500001, 12.000001) scale(-1, 1) rotate(-270.000000) translate(-11.500001, -12.000001) "></path></g></svg></span><span class="flex header_title_heading">Kedvezmények</span></div>`;
    const dscript = document.createElement('script');dscript.id = "dformJS";dscript.setAttribute('src', 'script/discount/add.js');document.body.append(dscript);
    document.getElementById('product-body').innerHTML = `
        <form id="discount-form" enctype="multipart/form-data" method="POST" >
        <div class="product-tab flex flex-col gap-1">
            <div class="flex flex-col w-100">
                <input type="search" class="sidenav-search-input" style="background-color: var(--background);" onInput="searchDiscount()" id="discount-search" name="discount-search" placeholder="Keresés a termékek között..">
                <div class="products-con padding-bot-05 flex flex-row flex-align-c flex-justify-con-c flex-wrap gap-05" id="discount-items-con">
                    <?php
                        include($_SERVER['DOCUMENT_ROOT'].'/includes/inc.connect.php');
                        $con->query("SET CHARACTER SET utf8mb4"); if (mysqli_connect_errno()) {header ("Location: /500");}
                        $pr_sql = "SELECT * FROM `products` WHERE product_id NOT IN (SELECT product_discount.product_id FROM product_discount WHERE product_discount.end > NOW())";
                        $pr_res = $con-> query($pr_sql);
                        if ($pr_res-> num_rows > 0) {
                            while ($product = $pr_res-> fetch_assoc()) {
                                echo '
                                <div class="product_card flex flex-col padding-05 box-shadow background-bg border-soft user-select-none" style="width: 8rem;">
                                    <label search-key="'; echo $product['product_brand'] . ' '; echo strtr($product['product_brand'], $unwanted_array) . ' '; echo $product['product_name'] . ' '; echo strtr($product['product_name'], $unwanted_array) . ' '; echo $product['product_price'] . ' '; echo $product['product_code']; echo '"></label>
                                    <div class="product_card_inner flex flex-col h-100">
                                        <span class="flex flex-row flex-justify-con-sb flex-align-c">
                                            <span class="product_brand small">'; echo $product['product_brand']; echo '</span>
                                            <input type="radio" class="discount_input discount-radio box-shadow" name="discountable" code="'; echo $product['product_code']; echo'" value="'; echo $product['product_id']; echo'" required>
                                        </span>
                                        <span class="flex flex-align-c flex-justify-con-c w-100">
                                            <img class="product_image" style="width: 5rem; height: 5rem;" src="/assets/images/uploads/'; echo $product['product_image']; echo '" alt="'; echo $product['product_name']; echo '">
                                        </span>
                                        <div class="product_info">
                                            <span class="product_title small">'; echo $product['product_name']; echo '</span>
                                        </div>
                                        <div class="product_price_con flex flex-justify-con-sb margin-top-a">
                                            <span class="product_price">'; echo $product['product_price']; echo ' '; echo strtoupper($product['product_price_unit']); echo '</span>
                                        </div>
                                    </div>
                                </div> 
                                ';
                            }
                        } else { echo '<span class="text-primary">Nincsenek megjeleníthető termékek.</span>';}
                    ?>                                                   
                </div>
            </div>
        </div>
        <div class="product-tab">
            <div class="flex flex-col gap-1 w-100">
                <div class="flex flex-col w-100 gap-05">
                    <span class="text-secondary" style="margin-bottom: .5rem;">Adja meg a kedvezmény százalékát</span>
                    <div class="flex flex-row flex-align-c flex-justify-con-sb gap-1">
                        <input type="number" name="discount-percentage" class="staff-auth checkable" id="discount-percentage" placeholder="15" required>
                        <span class="flex flex-align-c flex-justify-con-c staff-auth user-select-none" style="width: fit-content !important;">
                            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="1.2rem" height="1.2rem" viewBox="0 0 24 24" version="1.1">
                                <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"><rect x="0" y="0" width="24" height="24"/><path d="M16.0322024,5.68722152 L5.75790403,15.945742 C5.12139076,16.5812778 5.12059836,17.6124773 5.75613416,18.2489906 C5.75642891,18.2492858 5.75672377,18.2495809 5.75701875,18.2498759 L5.75701875,18.2498759 C6.39304347,18.8859006 7.42424328,18.8859006 8.060268,18.2498759 C8.06056298,18.2495809 8.06085784,18.2492858 8.0611526,18.2489906 L18.3196731,7.9746922 C18.9505124,7.34288268 18.9501191,6.31942463 18.3187946,5.68810005 L18.3187946,5.68810005 C17.68747,5.05677547 16.6640119,5.05638225 16.0322024,5.68722152 Z" class="svg" fill-rule="nonzero"/><path d="M9.85714286,6.92857143 C9.85714286,8.54730513 8.5469533,9.85714286 6.93006028,9.85714286 C5.31316726,9.85714286 4,8.54730513 4,6.92857143 C4,5.30983773 5.31316726,4 6.93006028,4 C8.5469533,4 9.85714286,5.30983773 9.85714286,6.92857143 Z M20,17.0714286 C20,18.6901623 18.6898104,20 17.0729174,20 C15.4560244,20 14.1428571,18.6901623 14.1428571,17.0714286 C14.1428571,15.4497247 15.4560244,14.1428571 17.0729174,14.1428571 C18.6898104,14.1428571 20,15.4497247 20,17.0714286 Z" class="svg" opacity="0.3"/></g>
                            </svg>
                        </span>
                    </div>
                    <span class="danger small-med bold" id="discount-empty"></span>
                </div>
                <div class="flex flex-col w-100">
                    <span class="text-secondary" style="margin-bottom: .5rem;">Adja meg a kezdési dátumot</span>
                    <div class="flex flex-row flex-align-c flex-justify-con-sb gap-1">
                        <input type="datetime-local" name="discount-start" class="staff-auth checkable" id="discount-start" placeholder="15" required>
                        <span class="flex flex-align-c flex-justify-con-c staff-auth user-select-none" style="width: fit-content !important;">
                            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="1.2rem" height="1.2rem" viewBox="0 0 24 24" version="1.1">
                                <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"><rect x="0" y="0" width="24" height="24"/><path d="M7.14319965,19.3575259 C7.67122143,19.7615175 8.25104409,20.1012165 8.87097532,20.3649307 L7.89205065,22.0604779 C7.61590828,22.5387706 7.00431787,22.7026457 6.52602525,22.4265033 C6.04773263,22.150361 5.88385747,21.5387706 6.15999985,21.0604779 L7.14319965,19.3575259 Z M15.1367085,20.3616573 C15.756345,20.0972995 16.3358198,19.7569961 16.8634386,19.3524415 L17.8320512,21.0301278 C18.1081936,21.5084204 17.9443184,22.1200108 17.4660258,22.3961532 C16.9877332,22.6722956 16.3761428,22.5084204 16.1000004,22.0301278 L15.1367085,20.3616573 Z" class="svg"/><path d="M12,21 C7.581722,21 4,17.418278 4,13 C4,8.581722 7.581722,5 12,5 C16.418278,5 20,8.581722 20,13 C20,17.418278 16.418278,21 12,21 Z M19.068812,3.25407593 L20.8181344,5.00339833 C21.4039208,5.58918477 21.4039208,6.53893224 20.8181344,7.12471868 C20.2323479,7.71050512 19.2826005,7.71050512 18.696814,7.12471868 L16.9474916,5.37539627 C16.3617052,4.78960984 16.3617052,3.83986237 16.9474916,3.25407593 C17.5332781,2.66828949 18.4830255,2.66828949 19.068812,3.25407593 Z M5.29862906,2.88207799 C5.8844155,2.29629155 6.83416297,2.29629155 7.41994941,2.88207799 C8.00573585,3.46786443 8.00573585,4.4176119 7.41994941,5.00339833 L5.29862906,7.12471868 C4.71284263,7.71050512 3.76309516,7.71050512 3.17730872,7.12471868 C2.59152228,6.53893224 2.59152228,5.58918477 3.17730872,5.00339833 L5.29862906,2.88207799 Z" class="svg" opacity="0.3"/><path d="M11.9630156,7.5 L12.0475062,7.5 C12.3043819,7.5 12.5194647,7.69464724 12.5450248,7.95024814 L13,12.5 L16.2480695,14.3560397 C16.403857,14.4450611 16.5,14.6107328 16.5,14.7901613 L16.5,15 C16.5,15.2109164 16.3290185,15.3818979 16.1181021,15.3818979 C16.0841582,15.3818979 16.0503659,15.3773725 16.0176181,15.3684413 L11.3986612,14.1087258 C11.1672824,14.0456225 11.0132986,13.8271186 11.0316926,13.5879956 L11.4644883,7.96165175 C11.4845267,7.70115317 11.7017474,7.5 11.9630156,7.5 Z" class="svg"/></g>
                            </svg>
                        </span>
                    </div>
                    <span class="danger small-med bold" id="start-empty"></span>
                </div>
                <div class="flex flex-col w-100">
                    <span class="text-secondary" style="margin-bottom: .5rem;">Adja meg a kedvezmény lejárati dátumát</span>
                    <div class="flex flex-row flex-align-c flex-justify-con-sb gap-1">
                        <input type="datetime-local" name="discount-end" class="staff-auth checkable" id="discount-end" placeholder="15" required>
                        <span class="flex flex-align-c flex-justify-con-c staff-auth user-select-none" style="width: fit-content !important;">
                            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="1.2rem" height="1.2rem" viewBox="0 0 24 24" version="1.1">
                                <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"><rect x="0" y="0" width="24" height="24"/><path d="M7.14319965,19.3575259 C7.67122143,19.7615175 8.25104409,20.1012165 8.87097532,20.3649307 L7.89205065,22.0604779 C7.61590828,22.5387706 7.00431787,22.7026457 6.52602525,22.4265033 C6.04773263,22.150361 5.88385747,21.5387706 6.15999985,21.0604779 L7.14319965,19.3575259 Z M15.1367085,20.3616573 C15.756345,20.0972995 16.3358198,19.7569961 16.8634386,19.3524415 L17.8320512,21.0301278 C18.1081936,21.5084204 17.9443184,22.1200108 17.4660258,22.3961532 C16.9877332,22.6722956 16.3761428,22.5084204 16.1000004,22.0301278 L15.1367085,20.3616573 Z" class="svg"/><path d="M12,21 C7.581722,21 4,17.418278 4,13 C4,8.581722 7.581722,5 12,5 C16.418278,5 20,8.581722 20,13 C20,17.418278 16.418278,21 12,21 Z M19.068812,3.25407593 L20.8181344,5.00339833 C21.4039208,5.58918477 21.4039208,6.53893224 20.8181344,7.12471868 C20.2323479,7.71050512 19.2826005,7.71050512 18.696814,7.12471868 L16.9474916,5.37539627 C16.3617052,4.78960984 16.3617052,3.83986237 16.9474916,3.25407593 C17.5332781,2.66828949 18.4830255,2.66828949 19.068812,3.25407593 Z M5.29862906,2.88207799 C5.8844155,2.29629155 6.83416297,2.29629155 7.41994941,2.88207799 C8.00573585,3.46786443 8.00573585,4.4176119 7.41994941,5.00339833 L5.29862906,7.12471868 C4.71284263,7.71050512 3.76309516,7.71050512 3.17730872,7.12471868 C2.59152228,6.53893224 2.59152228,5.58918477 3.17730872,5.00339833 L5.29862906,2.88207799 Z" class="svg" opacity="0.3"/><path d="M11.9630156,7.5 L12.0475062,7.5 C12.3043819,7.5 12.5194647,7.69464724 12.5450248,7.95024814 L13,12.5 L16.2480695,14.3560397 C16.403857,14.4450611 16.5,14.6107328 16.5,14.7901613 L16.5,15 C16.5,15.2109164 16.3290185,15.3818979 16.1181021,15.3818979 C16.0841582,15.3818979 16.0503659,15.3773725 16.0176181,15.3684413 L11.3986612,14.1087258 C11.1672824,14.0456225 11.0132986,13.8271186 11.0316926,13.5879956 L11.4644883,7.96165175 C11.4845267,7.70115317 11.7017474,7.5 11.9630156,7.5 Z" class="svg"/></g>
                            </svg>
                        </span>
                    </div>
                    <span class="danger small-med bold" id="end-empty"></span>
                </div>
            </div>
        </div>
    </form>
    <div class="flex flex-col margin-top-a">
        <div class="flex flex-row gap-1 flex-align-c flex-justify-con-c">
            <span class="step"></span>
            <span class="step"></span>
        </div>
        <div class="flex flex-row flex-align-c flex-justify-con-sb" style="margin-top: 1rem;">
            <div>
                <div class="button button-secondary user-select-none" id="prod-back" onclick="productForm(-1)">Vissza</div>
            </div>
            <div class="button button-primary button-disabled user-select-none" id="prod-next">Következő</div>
        </div>
    </div>
    `;
    $(document).ready(function () {
        var box = document.getElementsByName("discountable"); var today = new Date();
        for (let i = 0; i < box.length; i ++) {box[i].parentNode.parentNode.parentNode.addEventListener("click", function () {box[i].click(); $('#prod-next').removeClass('button-disabled'); $('#prod-next').attr('onclick', 'productForm(1)');});}
        document.getElementById("discount-start").setAttribute('min', today.getFullYear() + '-' + ("0" + (today.getMonth() + 1)).slice(-2) + '-'+ today.getUTCDate() +'T'+ today.getHours()+':'+today.getMinutes()+':00');
        $("#discount-start").val(today.getFullYear() + '-' + ("0" + (today.getMonth() + 1)).slice(-2) + '-'+ today.getUTCDate() +'T'+ ((today.getHours()<10?'0':'')+today.getMinutes())+':'+today.getMinutes()+':00');
        document.getElementById("discount-end").setAttribute('min', $('#discount-start').val());
        $("#discount-start").on("change input", function () {document.getElementById("discount-end").setAttribute('min', $('#discount-start').val());});
    });
}); $("#remove-discount").click(function () {
    document.getElementById('section-header').innerHTML = `<div class="flex flex-row flex-align-c gap-1"><span class="flex pointer" onclick="discountMain()" aria-label="Vissza"><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1"><g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"><rect x="0" y="0" width="24" height="24"></rect><circle class="svg" opacity="0.3" cx="12" cy="12" r="10"></circle><path d="M6.96323356,15.1775211 C6.62849853,15.5122561 6.08578582,15.5122561 5.75105079,15.1775211 C5.41631576,14.842786 5.41631576,14.3000733 5.75105079,13.9653383 L10.8939067,8.82248234 C11.2184029,8.49798619 11.7409054,8.4866328 12.0791905,8.79672747 L17.2220465,13.5110121 C17.5710056,13.8308912 17.5945795,14.3730917 17.2747004,14.7220508 C16.9548212,15.0710098 16.4126207,15.0945838 16.0636617,14.7747046 L11.5257773,10.6149773 L6.96323356,15.1775211 Z" class="svg" fill-rule="nonzero" transform="translate(11.500001, 12.000001) scale(-1, 1) rotate(-270.000000) translate(-11.500001, -12.000001) "></path></g></svg></span><span class="flex header_title_heading">Kedvezmények</span></div>`;
    const dscript = document.createElement('script');dscript.id = "removeForm";dscript.setAttribute('src', 'script/discount/remove.js');document.body.append(dscript);
    document.getElementById('product-body').innerHTML = `
        <form id="discount-form" enctype="multipart/form-data" method="POST" >
        <div class="product-tab flex flex-col">
            <div class="flex flex-col w-100">
                <input type="search" class="sidenav-search-input" style="background-color: var(--background);" onkeyup="searchDiscount()" id="discount-search" name="discount-search" placeholder="Keresés a termékek között..">
                <div class="products-con padding-bot-05 flex flex-row flex-align-c flex-justify-con-c flex-wrap gap-05" id="discount-items-con">
                    <?php
                        include($_SERVER['DOCUMENT_ROOT'].'/includes/inc.connect.php');
                        $con->query("SET CHARACTER SET utf8mb4"); if (mysqli_connect_errno()) {header ("Location: /500");}
                        $pr_sql = "SELECT products.*, product_discount.discount, product_discount.new_price FROM `products` INNER JOIN product_discount ON products.product_id = product_discount.product_id WHERE products.product_id IN (SELECT product_discount.product_id FROM product_discount WHERE product_discount.end > NOW())";
                        $pr_res = $con-> query($pr_sql);
                        if ($pr_res-> num_rows > 0) {
                            while ($product = $pr_res-> fetch_assoc()) {
                                echo '
                                <div class="product_card flex flex-col padding-05 box-shadow background-bg border-soft user-select-none" style="width: 8rem;">
                                    <label search-key="'; echo $product['product_brand'] . ' '; echo strtr($product['product_brand'], $unwanted_array) . ' '; echo $product['product_name'] . ' '; echo strtr($product['product_name'], $unwanted_array) . ' '; echo $product['product_price'] . ' '; echo $product['product_code']; echo '"></label>
                                    <div class="product_card_inner flex flex-col h-100">
                                        <span class="flex flex-row flex-justify-con-sb flex-align-c">
                                            <span class="product_brand small">'; echo $product['product_brand']; echo '</span>
                                            <input type="radio" class="discount_input discount-radio box-shadow" name="discountable" code="'; echo $product['product_code']; echo'" value="'; echo $product['product_id']; echo'" required>
                                        </span>
                                        <span class="flex flex-align-c flex-justify-con-c w-100">
                                            <img class="product_image" style="width: 5rem; height: 5rem;" src="/assets/images/uploads/'; echo $product['product_image']; echo '" alt="'; echo $product['product_name']; echo '">
                                        </span>
                                        <div class="product_info">
                                            <span class="product_title small">'; echo $product['product_name']; echo '</span>
                                        </div>
                                        <div class="product_price_con flex flex-row margin-top-a">
                                            <span class="flex flex-row text-primary small bold">'; echo $product['new_price']. ' ' . strtoupper($product['product_price_unit']); echo '</small><span class="text-secondary small-med flex" style="text-decoration:line-through; margin-left: .2rem; align-items:flex-end;">'; echo $product['product_price']; echo ' </span></span></span>
                                        </div>
                                    </div>
                                </div> 
                                ';
                            }
                        } else { echo '<span class="text-primary">Nincsenek megjeleníthető termékek.</span>';}
                    ?>                                                   
                </div>
            </div>
        </div>
        <div class="product-tab">
            <div class="flex flex-col gap-1 w-100">
                <div class="flex flex-col w-100">
                    <span class="text-secondary" style="margin-bottom: .5rem;">Erősítse meg tevékenységét</span>
                    <div class="flex flex-row flex-align-c flex-justify-con-sb gap-1">
                        <input type="password" name="disc-confirm" class="staff-auth checkable" id="disc-confirm" placeholder="Adja meg a jelszót" required>
                        <span class="flex flex-align-c flex-justify-con-c staff-auth user-select-none" style="width: fit-content !important;">
                            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="1.2rem" height="1.2rem" viewBox="0 0 24 24" version="1.1"><g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"><mask fill="white"><use xlink:href="#path-1"></use></mask><g></g><path d="M7,10 L7,8 C7,5.23857625 9.23857625,3 12,3 C14.7614237,3 17,5.23857625 17,8 L17,10 L18,10 C19.1045695,10 20,10.8954305 20,12 L20,18 C20,19.1045695 19.1045695,20 18,20 L6,20 C4.8954305,20 4,19.1045695 4,18 L4,12 C4,10.8954305 4.8954305,10 6,10 L7,10 Z M12,5 C10.3431458,5 9,6.34314575 9,8 L9,10 L15,10 L15,8 C15,6.34314575 13.6568542,5 12,5 Z" class="svg"></path></g></svg>
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </form>
    <div class="flex flex-col margin-top-a">
        <div class="flex flex-row gap-1 flex-align-c flex-justify-con-c">
            <span class="step"></span>
            <span class="step"></span>
        </div>
        <div class="flex flex-row flex-align-c flex-justify-con-sb" style="margin-top: 1rem;">
            <div>
                <div class="button button-secondary user-select-none" id="prod-back" onclick="productForm(-1)">Vissza</div>
            </div>
            <div class="button button-primary button-disabled user-select-none" id="prod-next">Következő</div>
        </div>
    </div>
    `;
    $(document).ready(function () {
        var box = document.getElementsByName("discountable");for (let i = 0; i < box.length; i ++) {box[i].parentNode.parentNode.parentNode.addEventListener("click", function () {box[i].click();$('#prod-next').attr('onclick', 'productForm(1)'); $('#prod-next').removeClass('button-disabled');});}
    });
}); $("#manage-discount").click(function () {
    document.getElementById('section-header').innerHTML = `<div class="flex flex-row flex-align-c gap-1"><span class="flex pointer" onclick="discountMain()" aria-label="Vissza"><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1"><g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"><rect x="0" y="0" width="24" height="24"></rect><circle class="svg" opacity="0.3" cx="12" cy="12" r="10"></circle><path d="M6.96323356,15.1775211 C6.62849853,15.5122561 6.08578582,15.5122561 5.75105079,15.1775211 C5.41631576,14.842786 5.41631576,14.3000733 5.75105079,13.9653383 L10.8939067,8.82248234 C11.2184029,8.49798619 11.7409054,8.4866328 12.0791905,8.79672747 L17.2220465,13.5110121 C17.5710056,13.8308912 17.5945795,14.3730917 17.2747004,14.7220508 C16.9548212,15.0710098 16.4126207,15.0945838 16.0636617,14.7747046 L11.5257773,10.6149773 L6.96323356,15.1775211 Z" class="svg" fill-rule="nonzero" transform="translate(11.500001, 12.000001) scale(-1, 1) rotate(-270.000000) translate(-11.500001, -12.000001) "></path></g></svg></span><span class="flex header_title_heading">Kedvezmények</span></div>`;
    const dscript = document.createElement('script');dscript.id = "manageForm";dscript.setAttribute('src', 'script/discount/manage.js');document.body.append(dscript);
    document.getElementById('product-body').innerHTML = `
        <form id="discount-form" enctype="multipart/form-data" method="POST" >
            <div class="product-tab flex flex-col gap-1">
                <div class="flex flex-col w-100">
                    <input type="search" class="sidenav-search-input" style="background-color: var(--background);" onkeyup="searchDiscount()" id="discount-search" name="discount-search" placeholder="Keresés a termékek között..">
                    <div class="products-con padding-bot-05 flex flex-row flex-align-c flex-justify-con-c flex-wrap gap-05" id="discount-items-con">
                        <?php
                            include($_SERVER['DOCUMENT_ROOT'].'/includes/inc.connect.php');
                            $con->query("SET CHARACTER SET utf8mb4"); if (mysqli_connect_errno()) {header ("Location: /500");}
                            $pr_sql = "SELECT products.*, product_discount.discount, product_discount.new_price FROM `products` INNER JOIN product_discount ON products.product_id = product_discount.product_id WHERE products.product_id IN (SELECT product_discount.product_id FROM product_discount WHERE product_discount.end > NOW())";
                            $pr_res = $con-> query($pr_sql);
                            if ($pr_res-> num_rows > 0) {
                                while ($product = $pr_res-> fetch_assoc()) {
                                    echo '
                                    <div class="product_card flex flex-col padding-05 box-shadow background-bg border-soft user-select-none" style="width: 8rem;" pid="'; echo $product['product_id']; echo'" pcode="'; echo $product['product_code']; echo'" pnp="';echo $product['new_price']; echo'" dis="';echo $product['discount']; echo'">
                                        <label search-key="'; echo $product['product_brand'] . ' '; echo strtr($product['product_brand'], $unwanted_array) . ' '; echo $product['product_name'] . ' '; echo strtr($product['product_name'], $unwanted_array) . ' '; echo $product['product_price'] . ' '; echo $product['product_code']; echo '"></label>
                                        <div class="product_card_inner flex flex-col h-100">
                                            <span class="flex flex-row flex-justify-con-sb flex-align-c">
                                                <span class="product_brand small">'; echo $product['product_brand']; echo '</span>
                                                <input type="radio" class="discount_input discount-radio box-shadow" name="discountable" code="'; echo $product['product_code']; echo'" value="'; echo $product['product_id']; echo'" required>
                                            </span>
                                            <span class="flex flex-align-c flex-justify-con-c w-100">
                                                <img class="product_image" style="width: 5rem; height: 5rem;" src="/assets/images/uploads/'; echo $product['product_image']; echo '" alt="'; echo $product['product_name']; echo '">
                                            </span>
                                            <div class="product_info">
                                                <span class="product_title small">'; echo $product['product_name']; echo '</span>
                                            </div>
                                            <div class="product_price_con flex flex-row margin-top-a">
                                                <span class="flex flex-row text-primary small bold">'; echo $product['new_price']. ' ' . strtoupper($product['product_price_unit']); echo '</small><span class="text-secondary small-med flex" style="text-decoration:line-through; margin-left: .2rem; align-items:flex-end;">'; echo $product['product_price']; echo ' </span></span></span>
                                            </div>
                                        </div>
                                    </div> 
                                    ';
                                }
                            } else { echo '<span class="text-primary">Nincsenek megjeleníthető termékek.</span>';}
                        ?>                                                   
                    </div>
                </div>
            </div>
            <div class="product-tab">
                <div class="flex flex-col gap-1 w-100">
                    <div class="flex flex-col w-100 gap-05">
                        <span class="text-secondary" style="margin-bottom: .5rem;">Adja meg a kedvezmény százalékát</span>
                        <div class="flex flex-row flex-align-c flex-justify-con-sb gap-1">
                            <input type="number" name="discount-percentage" class="staff-auth checkable" id="discount-percentage" placeholder="15" required>
                            <span class="flex flex-align-c flex-justify-con-c staff-auth user-select-none" style="width: fit-content !important;">
                                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="1.2rem" height="1.2rem" viewBox="0 0 24 24" version="1.1">
                                    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"><rect x="0" y="0" width="24" height="24"/><path d="M16.0322024,5.68722152 L5.75790403,15.945742 C5.12139076,16.5812778 5.12059836,17.6124773 5.75613416,18.2489906 C5.75642891,18.2492858 5.75672377,18.2495809 5.75701875,18.2498759 L5.75701875,18.2498759 C6.39304347,18.8859006 7.42424328,18.8859006 8.060268,18.2498759 C8.06056298,18.2495809 8.06085784,18.2492858 8.0611526,18.2489906 L18.3196731,7.9746922 C18.9505124,7.34288268 18.9501191,6.31942463 18.3187946,5.68810005 L18.3187946,5.68810005 C17.68747,5.05677547 16.6640119,5.05638225 16.0322024,5.68722152 Z" class="svg" fill-rule="nonzero"/><path d="M9.85714286,6.92857143 C9.85714286,8.54730513 8.5469533,9.85714286 6.93006028,9.85714286 C5.31316726,9.85714286 4,8.54730513 4,6.92857143 C4,5.30983773 5.31316726,4 6.93006028,4 C8.5469533,4 9.85714286,5.30983773 9.85714286,6.92857143 Z M20,17.0714286 C20,18.6901623 18.6898104,20 17.0729174,20 C15.4560244,20 14.1428571,18.6901623 14.1428571,17.0714286 C14.1428571,15.4497247 15.4560244,14.1428571 17.0729174,14.1428571 C18.6898104,14.1428571 20,15.4497247 20,17.0714286 Z" class="svg" opacity="0.3"/></g>
                                </svg>
                            </span>
                        </div>
                        <span class="danger small-med bold" id="discount-empty"></span>
                    </div>
                    <div class="flex flex-col w-100">
                        <span class="text-secondary" style="margin-bottom: .5rem;">Adja meg a kezdési dátumot</span>
                        <div class="flex flex-row flex-align-c flex-justify-con-sb gap-1">
                            <input type="datetime-local" name="discount-start" class="staff-auth checkable" id="discount-start" placeholder="15" required>
                            <span class="flex flex-align-c flex-justify-con-c staff-auth user-select-none" style="width: fit-content !important;">
                                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="1.2rem" height="1.2rem" viewBox="0 0 24 24" version="1.1">
                                    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"><rect x="0" y="0" width="24" height="24"/><path d="M7.14319965,19.3575259 C7.67122143,19.7615175 8.25104409,20.1012165 8.87097532,20.3649307 L7.89205065,22.0604779 C7.61590828,22.5387706 7.00431787,22.7026457 6.52602525,22.4265033 C6.04773263,22.150361 5.88385747,21.5387706 6.15999985,21.0604779 L7.14319965,19.3575259 Z M15.1367085,20.3616573 C15.756345,20.0972995 16.3358198,19.7569961 16.8634386,19.3524415 L17.8320512,21.0301278 C18.1081936,21.5084204 17.9443184,22.1200108 17.4660258,22.3961532 C16.9877332,22.6722956 16.3761428,22.5084204 16.1000004,22.0301278 L15.1367085,20.3616573 Z" class="svg"/><path d="M12,21 C7.581722,21 4,17.418278 4,13 C4,8.581722 7.581722,5 12,5 C16.418278,5 20,8.581722 20,13 C20,17.418278 16.418278,21 12,21 Z M19.068812,3.25407593 L20.8181344,5.00339833 C21.4039208,5.58918477 21.4039208,6.53893224 20.8181344,7.12471868 C20.2323479,7.71050512 19.2826005,7.71050512 18.696814,7.12471868 L16.9474916,5.37539627 C16.3617052,4.78960984 16.3617052,3.83986237 16.9474916,3.25407593 C17.5332781,2.66828949 18.4830255,2.66828949 19.068812,3.25407593 Z M5.29862906,2.88207799 C5.8844155,2.29629155 6.83416297,2.29629155 7.41994941,2.88207799 C8.00573585,3.46786443 8.00573585,4.4176119 7.41994941,5.00339833 L5.29862906,7.12471868 C4.71284263,7.71050512 3.76309516,7.71050512 3.17730872,7.12471868 C2.59152228,6.53893224 2.59152228,5.58918477 3.17730872,5.00339833 L5.29862906,2.88207799 Z" class="svg" opacity="0.3"/><path d="M11.9630156,7.5 L12.0475062,7.5 C12.3043819,7.5 12.5194647,7.69464724 12.5450248,7.95024814 L13,12.5 L16.2480695,14.3560397 C16.403857,14.4450611 16.5,14.6107328 16.5,14.7901613 L16.5,15 C16.5,15.2109164 16.3290185,15.3818979 16.1181021,15.3818979 C16.0841582,15.3818979 16.0503659,15.3773725 16.0176181,15.3684413 L11.3986612,14.1087258 C11.1672824,14.0456225 11.0132986,13.8271186 11.0316926,13.5879956 L11.4644883,7.96165175 C11.4845267,7.70115317 11.7017474,7.5 11.9630156,7.5 Z" class="svg"/></g>
                                </svg>
                            </span>
                        </div>
                        <span class="danger small-med bold" id="start-empty"></span>
                    </div>
                    <div class="flex flex-col w-100">
                        <span class="text-secondary" style="margin-bottom: .5rem;">Adja meg a kedvezmény lejárati dátumát</span>
                        <div class="flex flex-row flex-align-c flex-justify-con-sb gap-1">
                            <input type="datetime-local" name="discount-end" class="staff-auth checkable" id="discount-end" placeholder="15" required>
                            <span class="flex flex-align-c flex-justify-con-c staff-auth user-select-none" style="width: fit-content !important;">
                                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="1.2rem" height="1.2rem" viewBox="0 0 24 24" version="1.1">
                                    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"><rect x="0" y="0" width="24" height="24"/><path d="M7.14319965,19.3575259 C7.67122143,19.7615175 8.25104409,20.1012165 8.87097532,20.3649307 L7.89205065,22.0604779 C7.61590828,22.5387706 7.00431787,22.7026457 6.52602525,22.4265033 C6.04773263,22.150361 5.88385747,21.5387706 6.15999985,21.0604779 L7.14319965,19.3575259 Z M15.1367085,20.3616573 C15.756345,20.0972995 16.3358198,19.7569961 16.8634386,19.3524415 L17.8320512,21.0301278 C18.1081936,21.5084204 17.9443184,22.1200108 17.4660258,22.3961532 C16.9877332,22.6722956 16.3761428,22.5084204 16.1000004,22.0301278 L15.1367085,20.3616573 Z" class="svg"/><path d="M12,21 C7.581722,21 4,17.418278 4,13 C4,8.581722 7.581722,5 12,5 C16.418278,5 20,8.581722 20,13 C20,17.418278 16.418278,21 12,21 Z M19.068812,3.25407593 L20.8181344,5.00339833 C21.4039208,5.58918477 21.4039208,6.53893224 20.8181344,7.12471868 C20.2323479,7.71050512 19.2826005,7.71050512 18.696814,7.12471868 L16.9474916,5.37539627 C16.3617052,4.78960984 16.3617052,3.83986237 16.9474916,3.25407593 C17.5332781,2.66828949 18.4830255,2.66828949 19.068812,3.25407593 Z M5.29862906,2.88207799 C5.8844155,2.29629155 6.83416297,2.29629155 7.41994941,2.88207799 C8.00573585,3.46786443 8.00573585,4.4176119 7.41994941,5.00339833 L5.29862906,7.12471868 C4.71284263,7.71050512 3.76309516,7.71050512 3.17730872,7.12471868 C2.59152228,6.53893224 2.59152228,5.58918477 3.17730872,5.00339833 L5.29862906,2.88207799 Z" class="svg" opacity="0.3"/><path d="M11.9630156,7.5 L12.0475062,7.5 C12.3043819,7.5 12.5194647,7.69464724 12.5450248,7.95024814 L13,12.5 L16.2480695,14.3560397 C16.403857,14.4450611 16.5,14.6107328 16.5,14.7901613 L16.5,15 C16.5,15.2109164 16.3290185,15.3818979 16.1181021,15.3818979 C16.0841582,15.3818979 16.0503659,15.3773725 16.0176181,15.3684413 L11.3986612,14.1087258 C11.1672824,14.0456225 11.0132986,13.8271186 11.0316926,13.5879956 L11.4644883,7.96165175 C11.4845267,7.70115317 11.7017474,7.5 11.9630156,7.5 Z" class="svg"/></g>
                                </svg>
                            </span>
                        </div><span class="danger small-med bold" id="end-empty"></span>
                    </div>
                    <div class="flex flex-col w-100">
                        <span class="text-secondary" style="margin-bottom: .5rem;">Erősítse meg tevékenységét</span>
                        <div class="flex flex-row flex-align-c flex-justify-con-sb gap-1">
                            <input type="password" name="disc-confirm" class="staff-auth checkable" id="disc-confirm" placeholder="Adja meg a jelszót" required>
                            <span class="flex flex-align-c flex-justify-con-c staff-auth user-select-none" style="width: fit-content !important;">
                                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="1.2rem" height="1.2rem" viewBox="0 0 24 24" version="1.1"><g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"><mask fill="white"><use xlink:href="#path-1"></use></mask><g></g><path d="M7,10 L7,8 C7,5.23857625 9.23857625,3 12,3 C14.7614237,3 17,5.23857625 17,8 L17,10 L18,10 C19.1045695,10 20,10.8954305 20,12 L20,18 C20,19.1045695 19.1045695,20 18,20 L6,20 C4.8954305,20 4,19.1045695 4,18 L4,12 C4,10.8954305 4.8954305,10 6,10 L7,10 Z M12,5 C10.3431458,5 9,6.34314575 9,8 L9,10 L15,10 L15,8 C15,6.34314575 13.6568542,5 12,5 Z" class="svg"></path></g></svg>
                            </span>
                        </div><span class="danger small-med bold" id="pass-empty"></span>
                    </div>
                </div>
            </div>
        </form>
        <div class="flex flex-col margin-top-a">
            <div class="flex flex-row gap-1 flex-align-c flex-justify-con-c">
                <span class="step"></span><span class="step"></span>
            </div>
            <div class="flex flex-row flex-align-c flex-justify-con-sb" style="margin-top: 1rem;">
                <div><div class="button button-secondary user-select-none" id="prod-back" onclick="productForm(-1)">Vissza</div></div>
                <div class="button button-primary button-disabled user-select-none" id="prod-next">Következő</div>
            </div>
        </div>
    `;
    $(document).ready(function () {
        var box = document.getElementsByName("discountable"); var today = new Date(); collData = new FormData();
        for (let i = 0; i < box.length; i ++) {box[i].parentNode.parentNode.parentNode.addEventListener("click", function () {box[i].click(); $('#prod-next').removeClass('button-disabled'); collData.append('pid', box[i].parentNode.parentNode.parentNode.getAttribute('pid')); 
            $.ajax({enctype: "multipart/form-data", type: "POST", url: "actions/discount/data.php", data: collData, dataType: 'json', contentType: false, processData: false, 
                success: function(data){if (data.status) {$('#discount-percentage').attr('value', data.dis); $('#discount-start').val(new Date(data.sta).toLocaleString("sv-SE", {year: "numeric",month: "2-digit",day: "2-digit",hour: "2-digit",minute: "2-digit"}).replace(" ", "T"));$('#discount-end').val(new Date(data.end).toLocaleString("sv-SE", {year: "numeric",month: "2-digit",day: "2-digit",hour: "2-digit",minute: "2-digit"}).replace(" ", "T"));$('#discount-start').attr('min', $("#discount-start").val()); $('#discount-end').attr('min', $("#discount-start").val()); $('#prod-next').attr('onclick', 'productForm(1)');}else{closeAuth(); notificationSystem(1, 2, 0, 'Hiba', 'Érvénytelen adatok.');}},
                error: function(data){console.log(data);}
            });
        });} document.getElementById("discount-end").setAttribute('min', $('#discount-start').val()); $("#discount-start").on("change input", function () {document.getElementById("discount-end").setAttribute('min', $('#discount-start').val());});
    });
});
</script>