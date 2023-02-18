<?php require_once($_SERVER['DOCUMENT_ROOT'].'/includes/header.php'); ?>
<script>var formatter = new Intl.NumberFormat('hu-HU', {style: 'currency',currency: 'HUF',maximumFractionDigits: 0,minimumFractionDigits: 0});</script>
<main id="main">
<div class="prod-con w-fa" id="tabs">
    <div class="flex flex-col w-fa">
        <section class="main_section">
            <div class="swiper br-shc-swiper relative w-fa border-soft">
                <div class="swiper-wrapper w-fa">
                    <div class="swiper-slide w-fa">
                        <div class="news_container_noscript flex flex-col flex-align-c relative flex flex-col flex-align-c relative" style="background: linear-gradient(to right, rgb(0 0 0 / 0.5), rgb(0 0 0/ 0.2)), url(&quot;/assets/images/banners/sl-1.jpg&quot;);">
                            <div class="news_con_wrapper">
                                <div class="news_desc_con_nobg flex flex-col absolute flex flex-col absolute gap-1 padding-1">
                                    <div class="flex flex-col text-align-j gap-05 padding-1">
                                        <span class="news_desc_title text-xxl">Karácsonyi leárazás</span>
                                        <span class="news_desc_info">50% kedvezmény minden termékünkre karácsony alkalmából.</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="swiper-slide w-fa">
                        <div class="news_container_noscript flex flex-col flex-align-c relative flex flex-col flex-align-c relative" style="background: linear-gradient(to right, rgb(0 0 0 / 0.5), rgb(0 0 0/ 0.2)), url(&quot;/assets/images/banners/sl-2.jpg&quot;);">
                            <div class="news_con_wrapper">
                                <div class="news_desc_con_nobg flex flex-col absolute flex flex-col absolute gap-1 padding-1">
                                    <div class="flex flex-col text-align-j gap-05 padding-1">
                                        <span class="news_desc_title text-xxl">Karácsonyi leárazás</span>
                                        <span class="news_desc_info">50% kedvezmény minden termékünkre karácsony alkalmából.</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="swiper-button-pr h-fa flex-align-c flex flex-col flex-justify-con-c absolute text-white border-white-bold-hover border-trans-bold padding-025 border-soft-light h-fa center-y z-90" style="left: 0; margin-top: 0 !important;"><svg width="32" height="32" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M11.2657 11.4343L15.45 7.25C15.8642 6.83579 15.8642 6.16421 15.45 5.75C15.0358 5.33579 14.3642 5.33579 13.95 5.75L8.40712 11.2929C8.01659 11.6834 8.01659 12.3166 8.40712 12.7071L13.95 18.25C14.3642 18.6642 15.0358 18.6642 15.45 18.25C15.8642 17.8358 15.8642 17.1642 15.45 16.75L11.2657 12.5657C10.9533 12.2533 10.9533 11.7467 11.2657 11.4343Z" fill="currentColor"/></svg></div>
                <div class="swiper-button-ne h-fa flex-align-c flex flex-col flex-justify-con-c absolute text-white border-white-bold-hover border-trans-bold padding-025 border-soft-light h-fa center-y z-90" style="right: 0; margin-top: 0 !important;"><svg width="32" height="32" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M12.6343 12.5657L8.45001 16.75C8.0358 17.1642 8.0358 17.8358 8.45001 18.25C8.86423 18.6642 9.5358 18.6642 9.95001 18.25L15.4929 12.7071C15.8834 12.3166 15.8834 11.6834 15.4929 11.2929L9.95001 5.75C9.5358 5.33579 8.86423 5.33579 8.45001 5.75C8.0358 6.16421 8.0358 6.83579 8.45001 7.25L12.6343 11.4343C12.9467 11.7467 12.9467 12.2533 12.6343 12.5657Z" fill="currentColor"/></svg></div>
            </div>
        </section>
        <section class="main_section padding-1 border-soft" style="background-color: var(--hl-bg);">
            <div class="section_body overflow-auto flex gap-1">
                <?php
                    $sql = "SELECT DISTINCT category FROM products__category ORDER BY RAND()"; $res = $con->query($sql);
                    while ($dt = $res->fetch_assoc()) { $categ = $dt['category'];
                        $tsql = "SELECT thumbnail FROM `products` INNER JOIN products__category ON products__category.pid = products.id WHERE category LIKE '$categ' ORDER BY RAND() LIMIT 1";
                        $tres = $con->query($tsql); $th = $tres->fetch_assoc(); $thumb = $th['thumbnail'];
                        echo '
                        <span class="flex flex-col flex-align-c flex-justify-con-sb gap-1 padding-1 border-soft pointer background-bg-hover mn-ctg-sh">
                            <div class="product-miniature drop-shadow pointer" style="background-image: url(&quot;/assets/images/uploads/'.$thumb.'&quot;); width: 2rem; height: 2rem;"></div>
                            <span>'.$categ.'</span>
                        </span>
                        ';
                    }
                ?>
            </div>
        </section>
        <section class="main_section">
            <div class="flex flex-align-c flex-justify-con-sb">
                <span class="section_title">Leárazott termékek</span>
            </div>
            <div class="section_body overflow-auto flex gap-1" style="flex-wrap: nowrap !important;">
                <?php
                    $pd_ct_in_sql = "SELECT products.id AS gpid FROM products__pricing INNER JOIN products ON products.id = products__pricing.pid WHERE discounted = 1";
                    $pd_ct_in_res = $con-> query($pd_ct_in_sql);
                    if ($pd_ct_in_res-> num_rows > 0) {
                        while ($pdctin = $pd_ct_in_res-> fetch_assoc()) { $gpid = $pdctin['gpid'];
                            $sql = "SELECT products.id, products.name, products.description, products.thumbnail, products__inventory.quantity, products__inventory.code, products__variations.color, products__variations.brand, products__pricing.base, products__pricing.discounted, products__pricing.discount FROM products INNER JOIN products__inventory ON products__inventory.pid = products.id INNER JOIN products__variations ON products__variations.pid = products.id INNER JOIN products__pricing ON products__pricing.pid = products.id WHERE products.id = $gpid";
                            $res = $con-> query($sql);
                            if ($res-> num_rows > 0) {
                                while ($product = $res-> fetch_assoc()) { $pid = $product['id'];
                                    echo '
                                    <div class="">
                                        <a class="flex flex-col item-bg border-soft-light box-shadow nwp__card__sm  pointer" href="/product/'.$product['id'].'/'; echo str_replace(',', '', str_replace(' ', '-',strtolower(strtr($product['brand'], $unwanted_array)))).'-'.str_replace(',', '', str_replace(' ', '-',strtolower(strtr($product['name'], $unwanted_array)))).'-'.str_replace(',', '', str_replace(' ', '-', strtolower(strtr($product['color'], $unwanted_array)))); echo '">
                                            <div class="product-hover" auid="'.$product['id'].'" data-pid="'.$product['id'].'" data-model="'.$model.'" id="'.$newname.'-'.$product['id'].'">
                                                <label search-key="'; echo $product['brand'] . ' '; echo strtr($product['brand'], $unwanted_array) . ' '; echo $product['name'] . ' '; echo strtr($product['name'], $unwanted_array) . ' '; echo $product['base'] . ' '; echo $product['code']; echo '"></label>
                                                <div class="flex flex-col flex-align-c flex-justify-con-sb padding-1 gap-05">
                                                    <span class="text-secondary bold small uppercase w-fa text-align-c">'.strtoupper($product['brand']).'</span>
                                                    <div class="flex flex-row flex-align-c gap-05">
                                                        <div class="flex flex-row flex-justify-con-sb">
                                                            <div class="flex flex-col gap-05">'; $newprice = $product['base'] - ($product['base'] * $product['discount']) / 100;
                                                            echo '
                                                                <div class="flex flex-row flex-align-c gap-025">
                                                                    <span class="text-secondary smaller-med formatted-price linethrough" data-price="'.$product['base'].'"></span>
                                                                    <span class="text-secondary small formatted-price bold" data-price="'.$newprice.'"></span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="flex flex-row flex-justify-con-c flex-align-c">
                                                            '; $ssql = "SELECT stars FROM reviews WHERE pid = $pid"; $sres = $con-> query($ssql); $son = 0; $stw = 0; $sth = 0; $sfo = 0; $sfi = 0; $savg = 0;
                                                            if ($sres-> num_rows > 0) { while ($star = $sres-> fetch_assoc()) { $stv = $star['stars']; if ($stv == 5) { $sfi += 1; } if ($stv == 4) { $sfo += 1; } if ($stv == 3) { $sth += 1; } if ($stv == 2) { $stw += 1; } if ($stv == 1) { $son += 1; } $dv = ($sfi + $sfo + $sth + $stw + $son); }
                                                            $savg = ((5 * $sfi) + (4 * $sfo) + (3 * $sth) + (2 * $stw) + (1 * $son)) / $dv; $st__avg = round($savg * 10) / 10;
                                                                echo ' <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="22px" height="22px" viewBox="0 0 24 24" version="1.1"><g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"><polygon points="0 0 24 0 24 24 0 24"></polygon><path d="M12,18 L7.91561963,20.1472858 C7.42677504,20.4042866 6.82214789,20.2163401 6.56514708,19.7274955 C6.46280801,19.5328351 6.42749334,19.309867 6.46467018,19.0931094 L7.24471742,14.545085 L3.94038429,11.3241562 C3.54490071,10.938655 3.5368084,10.3055417 3.92230962,9.91005817 C4.07581822,9.75257453 4.27696063,9.65008735 4.49459766,9.61846284 L9.06107374,8.95491503 L11.1032639,4.81698575 C11.3476862,4.32173209 11.9473121,4.11839309 12.4425657,4.36281539 C12.6397783,4.46014562 12.7994058,4.61977315 12.8967361,4.81698575 L14.9389263,8.95491503 L19.5054023,9.61846284 C20.0519472,9.69788046 20.4306287,10.2053233 20.351211,10.7518682 C20.3195865,10.9695052 20.2170993,11.1706476 20.0596157,11.3241562 L16.7552826,14.545085 L17.5353298,19.0931094 C17.6286908,19.6374458 17.263103,20.1544017 16.7187666,20.2477627 C16.5020089,20.2849396 16.2790408,20.2496249 16.0843804,20.1472858 L12,18 Z" fill="#f6cc00"></path></g></svg> <span class="flex text-primary small bold">'.$st__avg.'</span>';
                                                            } else {  echo '<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="22px" height="22px" viewBox="0 0 24 24" version="1.1"><g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"><polygon points="0 0 24 0 24 24 0 24"></polygon><path d="M12,18 L7.91561963,20.1472858 C7.42677504,20.4042866 6.82214789,20.2163401 6.56514708,19.7274955 C6.46280801,19.5328351 6.42749334,19.309867 6.46467018,19.0931094 L7.24471742,14.545085 L3.94038429,11.3241562 C3.54490071,10.938655 3.5368084,10.3055417 3.92230962,9.91005817 C4.07581822,9.75257453 4.27696063,9.65008735 4.49459766,9.61846284 L9.06107374,8.95491503 L11.1032639,4.81698575 C11.3476862,4.32173209 11.9473121,4.11839309 12.4425657,4.36281539 C12.6397783,4.46014562 12.7994058,4.61977315 12.8967361,4.81698575 L14.9389263,8.95491503 L19.5054023,9.61846284 C20.0519472,9.69788046 20.4306287,10.2053233 20.351211,10.7518682 C20.3195865,10.9695052 20.2170993,11.1706476 20.0596157,11.3241562 L16.7552826,14.545085 L17.5353298,19.0931094 C17.6286908,19.6374458 17.263103,20.1544017 16.7187666,20.2477627 C16.5020089,20.2849396 16.2790408,20.2496249 16.0843804,20.1472858 L12,18 Z" fill="#f6cc00" opacity=".6"></path></g></svg><span class="flex text-secondary small bold">0.0</span>'; } echo '
                                                        </div>
                                                    </div>
                                                    ';
                                                        if ($product['quantity'] < 10) {
                                                            echo '<span class="label-danger smaller border-soft-light padding-025 ">Utolsó darabok</span>';
                                                        }
                                                    echo '
                                                </div>
                                                <div class="flex flex-col flex-align-c gap-1">
                                                    <div class="flex flex-col flex-align-c pointer product-image-container" style="max-width: 8rem !important;">
                                                        <img src="/assets/images/uploads/'.$product['thumbnail'].'" alt="'.mb_substr($product['description'], 0, 60).'" class="ind-prd-crd-img drop-shadow" />
                                                    </div>
                                                    <div class="flex flex-row flex-justify-con-sb">
                                                        <div class="flex flex-col flex-align-c flex-justify-con-c gap-05 padding-05 w-fa">
                                                            <span class="text-primary small-med bold pointer w-fa text-align-c">'; 
                                                            if (strlen($product['name']) > 120) {
                                                                echo mb_substr($product['name'], 0, 120).'...';
                                                            } else { echo $product['name']; }
                                                            echo '</span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </a>
                                    </div>
                                    ';
                                }
                            }
                        }
                    } 
                ?>
            </div>
        </section>
        <!-- Hirlevel szekcio -->
        <section class="main_section relative">
            <div class='border-soft' id="su__con">
                <?php
                    if (isset($_SESSION['loggedin'])) { $uid = $_SESSION['id'];
                        $pr_sql = "SELECT uid, email, disc FROM e__subs WHERE uid = $uid";
                        $pr_res = $con-> query($pr_sql);
                        if ($pr_res-> num_rows > 0) {
                            $mail = $pr_res-> fetch_assoc();
                            if ($mail['disc'] == 0) {
                                echo '
                                <div class="border-soft" id="su__con">
                                    <div class="absolute glass su__gls flex flex-col border-soft padding-1">
                                        <h3 margin-bottom: 0; padding-bottom: 0;">Köszönjük, hogy feliratkozott hírlevelünkre</h3>
                                        <div class="flex flex-col gap-05">
                                            <span class="small">Hírleveleinket minden hétvégén megkapja. Néhány e-mailt a többi napon küldünk, az egyéb feliratkozásaitól függően.</span>
                                            <span class="small-med">*A feliratkozásait <a class="bold link pointer" id="ch__subs">ide kattintva</a> kezelheti, vagy a beállítások menüben módosíthatja.</span>
                                            <span class="small"><b>Figyelem!</b> Úgy tűnik, feliratkozott hírlevelünkre, de még nem vette igénybe akciónkat. Nézzen körül webáruházunkban, hátha talál valamit, és fel tudja használni ezt az akciót.</span>
                                        </div><br>
                                        <div class="flex flex-col">
                                            <span class="small-med" >Ön feliratkozott hírlevelünkre a(z) <b>'.$mail['email'].'</b> címen. Amennyiben le szeretne iratkozni, <a class="bold link pointer" id="unsub__mail">ide kattintva megteheti</a>.</span>
                                            <span class="small-med user-select-none">**<span class="link pointer underline" id="su__lm">Tudjon meg többet</span> a promóció felhasználásáról</span>
                                        </div>
                                    </div>
                                </div>
                                ';
                            } else {
                                echo '
                                <div class="border-soft" id="su__con">
                                    <div class="absolute glass su__gls flex flex-col border-soft padding-1">
                                        <h3 margin-bottom: 0; padding-bottom: 0;">Köszönjük, hogy feliratkozott hírlevelünkre</h3>
                                        <div class="flex flex-col gap-05">
                                            <span class="small">Hírleveleinket minden hétvégén megkapja. Néhány e-mailt a többi napon küldünk, az egyéb feliratkozásaitól függően.</span>
                                            <span class="small-med">*A feliratkozásait <a class="bold link pointer" id="ch__subs">ide kattintva</a> kezelheti, vagy a beállítások menüben módosíthatja.</span>
                                        </div><br>
                                        <div class="flex flex-col">
                                            <span class="small-med" >Ön feliratkozott hírlevelünkre a(z) <b>'.$mail['email'].'</b> címen. Amennyiben le szeretne iratkozni, <a class="bold link pointer" id="unsub__mail">ide kattintva megteheti</a>.</span>
                                            <span class="small-med user-select-none">**<span class="link pointer underline" id="su__lm">Tudjon meg többet</span> a promóció felhasználásáról</span>
                                        </div>
                                    </div>
                                </div>
                                ';
                            }
                        } else {
                            echo '
                            <div class="absolute glass su__gls flex flex-col border-soft padding-1 gap-1">
                                <h3 class="" style="color: #fff; margin-bottom: 0; padding-bottom: 0;">Szeretne 2000 Ft kedvezményt az első rendeléséből?</h3>
                                <span class="small">Iratkozzon fel a hírlevelünkre, hogy igénybe vegye ezt a különleges ajánlatot!</span>
                                <div class="flex flex-col" style="gap: .25rem;">
                                    <span class="small-med user-select-none"><span class="link pointer underline" id="su__lm">Tudjon meg többet</span> erről az ajánlatról</span>
                                    <div class="flex flex-row gap-05">
                                        <input type="email" name="sub__mail" id="sub__mail" pattern="[A-Za-z0-9._%+-]+@[A-Za-z0-9.-]+\.[A-Za-z]{1,63}$" placeholder="Email cím" class="border-soft sub__inp item-bg w-100 padding-05" />
                                        <span class="button button-primary" id="sub__act">Küld</span>
                                    </div>
                                </div>
                            </div>
                            ';
                        }
                    } else {
                        echo '
                        <div class="absolute glass su__gls flex flex-col border-soft padding-1 gap-1">
                            <h3 class="" style="color: #fff; margin-bottom: 0; padding-bottom: 0;">Szeretne 2000 Ft kedvezményt az első rendeléséből?</h3>
                            <span class="small">Iratkozzon fel a hírlevelünkre, hogy igénybe vegye ezt a különleges ajánlatot!</span>
                            <div class="flex flex-col" style="gap: .25rem;">
                                <span class="small-med user-select-none"><span class="link pointer underline" id="su__lm">Tudjon meg többet</span> erről az ajánlatról</span>
                                <div class="flex flex-row gap-05">
                                    <input type="email" name="sub__mail" id="sub__mail" pattern="[A-Za-z0-9._%+-]+@[A-Za-z0-9.-]+\.[A-Za-z]{1,63}$" placeholder="Email cím" class="border-soft sub__inp item-bg w-100 padding-05" />
                                    <span class="button button-primary" id="sub__act">Küld</span>
                                </div>
                            </div>
                        </div>
                        ';
                    }
                ?>
            </div>
        </section>
        <?php
            $pd_ct_sql = "SELECT COUNT(pid) AS 'amount', category, AVG(products.added) AS date FROM products__category INNER JOIN products ON products.id = products__category.pid GROUP BY category ORDER BY amount DESC LIMIT 6";
            $pd_ct_res = $con-> query($pd_ct_sql);
            if ($pd_ct_res-> num_rows > 0) {
                while ($pdct = $pd_ct_res-> fetch_assoc()) { $category = $pdct['category']; $newname = strtr(strtolower(preg_replace('/\s+/', '', $pdct['category'])), $unwanted_array);
                    echo '
                    <section class="main_section">
                        <div class="flex flex-align-c flex-justify-con-sb">
                            <span class="section_title">'.$category.'</span>
                        </div>
                        <div class="section_body overflow-auto flex gap-1" style="flex-wrap: nowrap !important;">
                    ';
                    $pd_ct_in_sql = "SELECT COUNT(products__variations.pid) AS 'amount', model, AVG(products.added) AS date FROM products__variations INNER JOIN products ON products.id = products__variations.pid INNER JOIN products__category ON products__category.pid = products__variations.pid WHERE category LIKE '$category' GROUP BY model ORDER BY date DESC;";
                    $pd_ct_in_res = $con-> query($pd_ct_in_sql);
                    if ($pd_ct_in_res-> num_rows > 0) {
                        while ($pdctin = $pd_ct_in_res-> fetch_assoc()) { $model = $pdctin['model'];
                            $sql = "SELECT products.id, products.name, products.description, products.thumbnail, products__inventory.quantity, products__inventory.code, products__variations.color, products__variations.brand, products__pricing.base, products__pricing.discounted, products__pricing.discount FROM products INNER JOIN products__inventory ON products__inventory.pid = products.id INNER JOIN products__variations ON products__variations.pid = products.id INNER JOIN products__pricing ON products__pricing.pid = products.id WHERE products__variations.model LIKE '$model' LIMIT 1";
                            $res = $con-> query($sql);
                            if ($res-> num_rows > 0) {
                                while ($product = $res-> fetch_assoc()) { $pid = $product['id'];
                                    echo '
                                    <a class="flex flex-col item-bg border-soft-light box-shadow nwp__card__sm  pointer" href="/product/'.$product['id'].'/'; echo str_replace(',', '', str_replace(' ', '-',strtolower(strtr($product['brand'], $unwanted_array)))).'-'.str_replace(',', '', str_replace(' ', '-',strtolower(strtr($product['name'], $unwanted_array)))).'-'.str_replace(',', '', str_replace(' ', '-', strtolower(strtr($product['color'], $unwanted_array)))); echo '">
                                        <div class="product-hover" auid="'.$product['id'].'" data-pid="'.$product['id'].'" data-model="'.$model.'" id="'.$newname.'-'.$product['id'].'">
                                            <label search-key="'; echo $product['brand'] . ' '; echo strtr($product['brand'], $unwanted_array) . ' '; echo $product['name'] . ' '; echo strtr($product['name'], $unwanted_array) . ' '; echo $product['base'] . ' '; echo $product['code']; echo '"></label>
                                            <div class="flex flex-col flex-align-c flex-justify-con-sb padding-1 gap-05">
                                                <span class="text-secondary bold small uppercase w-fa text-align-c">'.strtoupper($product['brand']).'</span>
                                                <div class="flex flex-row flex-align-c gap-05">
                                                    <div class="flex flex-row flex-justify-con-sb">
                                                        <div class="flex flex-col gap-05">';
                                                            if ($product['discounted'] == 0) {
                                                                echo '<span class="text-secondary small formatted-price bold" data-price="'.$product['base'].'" id="formatted-price-'.$product['id'].'">'.$product['base'].'</span>';
                                                            } else { $newprice = $product['base'] - ($product['base'] * $product['discount']) / 100;
                                                                echo '
                                                                    <div class="flex flex-row flex-align-c gap-025">
                                                                        <span class="text-secondary smaller-med formatted-price linethrough" data-price="'.$product['base'].'"></span>
                                                                        <span class="text-secondary small formatted-price bold" data-price="'.$newprice.'"></span>
                                                                    </div>
                                                                ';
                                                            }
                                                            echo '
                                                        </div>
                                                    </div>
                                                    <div class="flex flex-row flex-justify-con-c flex-align-c">
                                                        '; $ssql = "SELECT stars FROM reviews WHERE pid = $pid"; $sres = $con-> query($ssql); $son = 0; $stw = 0; $sth = 0; $sfo = 0; $sfi = 0; $savg = 0;
                                                        if ($sres-> num_rows > 0) { while ($star = $sres-> fetch_assoc()) { $stv = $star['stars']; if ($stv == 5) { $sfi += 1; } if ($stv == 4) { $sfo += 1; } if ($stv == 3) { $sth += 1; } if ($stv == 2) { $stw += 1; } if ($stv == 1) { $son += 1; } $dv = ($sfi + $sfo + $sth + $stw + $son); }
                                                        $savg = ((5 * $sfi) + (4 * $sfo) + (3 * $sth) + (2 * $stw) + (1 * $son)) / $dv; $st__avg = round($savg * 10) / 10;
                                                            echo ' <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="22px" height="22px" viewBox="0 0 24 24" version="1.1"><g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"><polygon points="0 0 24 0 24 24 0 24"></polygon><path d="M12,18 L7.91561963,20.1472858 C7.42677504,20.4042866 6.82214789,20.2163401 6.56514708,19.7274955 C6.46280801,19.5328351 6.42749334,19.309867 6.46467018,19.0931094 L7.24471742,14.545085 L3.94038429,11.3241562 C3.54490071,10.938655 3.5368084,10.3055417 3.92230962,9.91005817 C4.07581822,9.75257453 4.27696063,9.65008735 4.49459766,9.61846284 L9.06107374,8.95491503 L11.1032639,4.81698575 C11.3476862,4.32173209 11.9473121,4.11839309 12.4425657,4.36281539 C12.6397783,4.46014562 12.7994058,4.61977315 12.8967361,4.81698575 L14.9389263,8.95491503 L19.5054023,9.61846284 C20.0519472,9.69788046 20.4306287,10.2053233 20.351211,10.7518682 C20.3195865,10.9695052 20.2170993,11.1706476 20.0596157,11.3241562 L16.7552826,14.545085 L17.5353298,19.0931094 C17.6286908,19.6374458 17.263103,20.1544017 16.7187666,20.2477627 C16.5020089,20.2849396 16.2790408,20.2496249 16.0843804,20.1472858 L12,18 Z" fill="#f6cc00"></path></g></svg> <span class="flex text-primary small bold">'.$st__avg.'</span>';
                                                        } else {  echo '<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="22px" height="22px" viewBox="0 0 24 24" version="1.1"><g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"><polygon points="0 0 24 0 24 24 0 24"></polygon><path d="M12,18 L7.91561963,20.1472858 C7.42677504,20.4042866 6.82214789,20.2163401 6.56514708,19.7274955 C6.46280801,19.5328351 6.42749334,19.309867 6.46467018,19.0931094 L7.24471742,14.545085 L3.94038429,11.3241562 C3.54490071,10.938655 3.5368084,10.3055417 3.92230962,9.91005817 C4.07581822,9.75257453 4.27696063,9.65008735 4.49459766,9.61846284 L9.06107374,8.95491503 L11.1032639,4.81698575 C11.3476862,4.32173209 11.9473121,4.11839309 12.4425657,4.36281539 C12.6397783,4.46014562 12.7994058,4.61977315 12.8967361,4.81698575 L14.9389263,8.95491503 L19.5054023,9.61846284 C20.0519472,9.69788046 20.4306287,10.2053233 20.351211,10.7518682 C20.3195865,10.9695052 20.2170993,11.1706476 20.0596157,11.3241562 L16.7552826,14.545085 L17.5353298,19.0931094 C17.6286908,19.6374458 17.263103,20.1544017 16.7187666,20.2477627 C16.5020089,20.2849396 16.2790408,20.2496249 16.0843804,20.1472858 L12,18 Z" fill="#f6cc00" opacity=".6"></path></g></svg><span class="flex text-secondary small bold">0.0</span>'; } echo '
                                                    </div>
                                                </div>
                                                ';
                                                    if ($product['quantity'] < 10) {
                                                        echo '<span class="label-danger smaller border-soft-light padding-025 ">Utolsó darabok</span>';
                                                    }
                                                echo '
                                            </div>
                                            <div class="flex flex-col flex-align-c gap-1">
                                                <div class="flex flex-col flex-align-c pointer product-image-container" style="max-width: 8rem !important;">
                                                    <img src="/assets/images/uploads/'.$product['thumbnail'].'" alt="'.mb_substr($product['description'], 0, 60).'" class="ind-prd-crd-img drop-shadow" />
                                                </div>
                                                <div class="flex flex-row flex-justify-con-sb">
                                                    <div class="flex flex-col flex-align-c flex-justify-con-c gap-05 padding-05 w-fa">
                                                        <span class="text-primary small-med bold pointer w-fa text-align-c">'; 
                                                        if (strlen($product['name']) > 120) {
                                                            echo mb_substr($product['name'], 0, 120).'...';
                                                        } else { echo $product['name']; }
                                                        echo '</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </a>
                                    ';
                                }
                            }
                        }
                    } 
                    echo '
                        </div>
                    </section>
                    ';
                }
            }
        ?>
    </div>
</div>
</main>
<script src="/assets/script/swiper/swiper-bundle.min.js" content-type="application/javascript"></script>
<script src="/assets/script/e__sub/e__sub.js" content-type="application/javascript"></script>
<script content-type="application/javascript">
    var brswiper = new Swiper(".br-shc-swiper", { navigation: { nextEl: ".swiper-button-ne", prevEl: ".swiper-button-pr", },
        direction: 'horizontal', loop: true,autoplay: {delay: 5000,disableOnInteraction: false }
    });
    var swiper = new Swiper(".browse-swiper", {
        slidesPerView: 1, spaceBetween: 10, navigation: { nextEl: ".swiper-button-next", prevEl: ".swiper-button-prev", },
        breakpoints: {
          520: { slidesPerView: 2, spaceBetween: 20, },
          720: { slidesPerView: 2, spaceBetween: 20, },
          1400: { slidesPerView: 2, spaceBetween: 20, },
          1415: { slidesPerView: 3, spaceBetween: 10, },
          1725: { slidesPerView: 4, spaceBetween: 10, },
        },
    });
    var formInp = document.getElementsByClassName('formatted-price');
    for (let i = 0; i < formInp.length; i++) { formInp[i].textContent = formatter.format(formInp[i].getAttribute('data-price')); }
</script>
<?php require_once($_SERVER['DOCUMENT_ROOT'].'/includes/footer.php'); ?>