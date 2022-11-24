<?php include($_SERVER['DOCUMENT_ROOT'].'/includes/inc.php');
if (isset($_SESSION['loggedin'])) {
    $stmt = $con->prepare('SELECT privilege FROM customers__priv  WHERE uid = ?'); if (isset($_SESSION['loggedin'])) {$id = $_SESSION['id'];} $stmt->bind_param('i', $id);$stmt->execute(); $stmt->bind_result($privilege); $stmt->fetch();$stmt->close();
    if ($privilege != 2) { echo "<script>window.location.href='/';</script>"; }
} else { header("Location: /"); }
$guid = $_SESSION['guid']; ?>
<div class="flex flex-col gap-1">
    <div class="flex flex-col w-fa gap-1 border-soft item-bg box-shadow padding-1">
        <div class="flex flex-row flex-align-c flex-justify-con-sb">
            <span class="text-primary large bold">Egyenlegek</span>
        </div>
        <div class="flex flex-row flex-align-c flex-justify-con-c gap-2 w-fa">
        <?php
            $pr_sql = "SELECT customers__card.cid, customers__card.cardname, customers__card.cardnum, customers__card.expiry, customers__card.value, customers__card__info.holder FROM customers__card INNER JOIN customers__card__info ON customers__card__info.cid = customers__card.cid WHERE customers__card.uid = $guid"; 
            $pr_res = $con-> query($pr_sql);
            if ($pr_res-> num_rows > 0) { $subtot = 0;
                while ($card = $pr_res-> fetch_assoc()) { if ($card['cardname'] == 'Mappa+ kártya') { $defval = 100000; } else { $defval = 30000; } $valperc = ($card['value'] * 100) / $defval;
                    $now = new DateTime();$future_date = new DateTime($card['expiry']);$interval = $future_date->diff($now);if ($interval-> format('%a') > 0) {$exp = $interval->format("%a nap");}
                    if ($interval->format('%a') < 1) {$exp = $interval->format("%h óra");} if ($interval->format('%h') < 1) {$exp = $interval->format("%i perc");}
                    if ($interval->format('%i') < 1) {$exp = $interval->format("%s mp");}if ($interval->format('%s') < 1) {$exp = 'Lejárt...';}
                    echo '
                    <div class="flex flex-col flex-align-c flex-justify-con-c gap-1 w-fc">
                        <div class="flex flex-col flex-align-fs flex-justify-con-l gap-05 w-fc">
                            <div class="progress-circle';
                                if ($valperc > 50) { echo ' over50 '; }
                                echo ' p'.round($valperc).'" style="margin: 0 !important;">
                                <span class="flex flex-col flex-align-c flex-justify-conc-c text-muted smaller-med" style="line-height: 1;"> ';
                                if ($card['cardname'] == 'Mappa+ kártya') { echo '<svg xmlns="http://www.w3.org/2000/svg" width="48" height="24" viewBox="0 0 24 24" fill="none"><path d="M22 7H2V11H22V7Z" class="svg"/><path opacity="0.3" d="M21 19H3C2.4 19 2 18.6 2 18V6C2 5.4 2.4 5 3 5H21C21.6 5 22 5.4 22 6V18C22 18.6 21.6 19 21 19ZM14 14C14 13.4 13.6 13 13 13H5C4.4 13 4 13.4 4 14C4 14.6 4.4 15 5 15H13C13.6 15 14 14.6 14 14ZM16 15.5C16 16.3 16.7 17 17.5 17H18.5C19.3 17 20 16.3 20 15.5C20 14.7 19.3 14 18.5 14H17.5C16.7 14 16 14.7 16 15.5Z" class="svg"/></svg>'; }
                                if ($card['cardname'] == 'Mastercard') { echo '<svg xmlns="http://www.w3.org/2000/svg" width="48" height="24" viewBox="0 0 80 48" fill="none"><rect width="80" height="48" rx="6"></rect><g clip-path="url(#clip0)"><path d="M47.129 35.9651H33.8779V12.2273H47.1292L47.129 35.9651Z" fill="#FF5F00"></path><path d="M34.718 24.096C34.718 19.2808 36.9798 14.9914 40.502 12.2271C37.8359 10.1316 34.5384 8.99434 31.1432 8.99935C22.7796 8.99935 16 15.7583 16 24.096C16 32.4338 22.7796 39.1927 31.1432 39.1927C34.5385 39.1978 37.8361 38.0605 40.5022 35.9649C36.9803 33.2011 34.718 28.9115 34.718 24.096Z" fill="#EB001B"></path><path d="M65.0061 24.0967C65.0061 32.4345 58.2265 39.1934 49.8629 39.1934C46.4673 39.1984 43.1693 38.0611 40.5027 35.9656C44.0258 33.2013 46.2876 28.9121 46.2876 24.0967C46.2876 19.2813 44.0258 14.9921 40.5027 12.2278C43.1693 10.1324 46.4671 8.9951 49.8627 9.00002C58.2263 9.00002 65.0059 15.7589 65.0059 24.0967" fill="#F79E1B"></path></g><defs><clipPath id="clip0"><rect width="49" height="38" fill="white" transform="translate(16 9)"></rect></clipPath></defs></svg>'; }
                                if ($card['cardname'] == 'Visa') { echo '<svg xmlns="http://www.w3.org/2000/svg" width="48" height="24" viewBox="0 0 80 48" fill="none"><rect width="80" height="48" rx="6"></rect><path d="M36.71 33.6833H32.059L34.9658 15.328H39.6174L36.71 33.6833ZM28.1462 15.328L23.712 27.9529L23.1873 25.2343L23.1878 25.2353L21.6228 16.9807C21.6228 16.9807 21.4336 15.328 19.4165 15.328H12.086L12 15.6388C12 15.6388 14.2417 16.118 16.8652 17.7368L20.906 33.6838H25.7521L33.1518 15.328H28.1462V15.328ZM64.7293 33.6833H69L65.2765 15.3275H61.5376C59.8111 15.3275 59.3906 16.6954 59.3906 16.6954L52.4538 33.6833H57.3023L58.2719 30.9568H64.1845L64.7293 33.6833ZM59.6113 27.1904L62.0552 20.3214L63.43 27.1904H59.6113ZM52.8175 19.742L53.4813 15.8003C53.4813 15.8003 51.4331 15 49.298 15C46.9899 15 41.5088 16.0365 41.5088 21.0765C41.5088 25.8186 47.9418 25.8775 47.9418 28.3683C47.9418 30.8591 42.1716 30.4128 40.2673 28.8421L39.5758 32.9635C39.5758 32.9635 41.6526 34 44.8257 34C47.9996 34 52.7879 32.3115 52.7879 27.7158C52.7879 22.9433 46.297 22.499 46.297 20.424C46.2975 18.3486 50.8272 18.6152 52.8175 19.742V19.742Z" fill="#2566AF"></path><path d="M23.1878 25.2348L21.6228 16.9802C21.6228 16.9802 21.4336 15.3275 19.4165 15.3275H12.086L12 15.6383C12 15.6383 15.5233 16.3886 18.9028 19.1995C22.1341 21.8862 23.1878 25.2348 23.1878 25.2348Z" fill="#E6A540"></path></svg>'; }
                                if ($card['cardname'] == 'PayPal') { echo '<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" id="Layer_1" x="0px" y="0px" width="48" height="24" viewBox="0 0 124 33" enable-background="new 0 0 124 33" xml:space="preserve"><path fill="#253B80" d="M46.211,6.749h-6.839c-0.468,0-0.866,0.34-0.939,0.802l-2.766,17.537c-0.055,0.346,0.213,0.658,0.564,0.658  h3.265c0.468,0,0.866-0.34,0.939-0.803l0.746-4.73c0.072-0.463,0.471-0.803,0.938-0.803h2.165c4.505,0,7.105-2.18,7.784-6.5  c0.306-1.89,0.013-3.375-0.872-4.415C50.224,7.353,48.5,6.749,46.211,6.749z M47,13.154c-0.374,2.454-2.249,2.454-4.062,2.454  h-1.032l0.724-4.583c0.043-0.277,0.283-0.481,0.563-0.481h0.473c1.235,0,2.4,0,3.002,0.704C47.027,11.668,47.137,12.292,47,13.154z"/><path fill="#253B80" d="M66.654,13.075h-3.275c-0.279,0-0.52,0.204-0.563,0.481l-0.145,0.916l-0.229-0.332  c-0.709-1.029-2.29-1.373-3.868-1.373c-3.619,0-6.71,2.741-7.312,6.586c-0.313,1.918,0.132,3.752,1.22,5.031  c0.998,1.176,2.426,1.666,4.125,1.666c2.916,0,4.533-1.875,4.533-1.875l-0.146,0.91c-0.055,0.348,0.213,0.66,0.562,0.66h2.95  c0.469,0,0.865-0.34,0.939-0.803l1.77-11.209C67.271,13.388,67.004,13.075,66.654,13.075z M62.089,19.449  c-0.316,1.871-1.801,3.127-3.695,3.127c-0.951,0-1.711-0.305-2.199-0.883c-0.484-0.574-0.668-1.391-0.514-2.301  c0.295-1.855,1.805-3.152,3.67-3.152c0.93,0,1.686,0.309,2.184,0.892C62.034,17.721,62.232,18.543,62.089,19.449z"/><path fill="#253B80" d="M84.096,13.075h-3.291c-0.314,0-0.609,0.156-0.787,0.417l-4.539,6.686l-1.924-6.425  c-0.121-0.402-0.492-0.678-0.912-0.678h-3.234c-0.393,0-0.666,0.384-0.541,0.754l3.625,10.638l-3.408,4.811  c-0.268,0.379,0.002,0.9,0.465,0.9h3.287c0.312,0,0.604-0.152,0.781-0.408L84.564,13.97C84.826,13.592,84.557,13.075,84.096,13.075z  "/><path fill="#179BD7" d="M94.992,6.749h-6.84c-0.467,0-0.865,0.34-0.938,0.802l-2.766,17.537c-0.055,0.346,0.213,0.658,0.562,0.658  h3.51c0.326,0,0.605-0.238,0.656-0.562l0.785-4.971c0.072-0.463,0.471-0.803,0.938-0.803h2.164c4.506,0,7.105-2.18,7.785-6.5  c0.307-1.89,0.012-3.375-0.873-4.415C99.004,7.353,97.281,6.749,94.992,6.749z M95.781,13.154c-0.373,2.454-2.248,2.454-4.062,2.454  h-1.031l0.725-4.583c0.043-0.277,0.281-0.481,0.562-0.481h0.473c1.234,0,2.4,0,3.002,0.704  C95.809,11.668,95.918,12.292,95.781,13.154z"/><path fill="#179BD7" d="M115.434,13.075h-3.273c-0.281,0-0.52,0.204-0.562,0.481l-0.145,0.916l-0.23-0.332  c-0.709-1.029-2.289-1.373-3.867-1.373c-3.619,0-6.709,2.741-7.311,6.586c-0.312,1.918,0.131,3.752,1.219,5.031  c1,1.176,2.426,1.666,4.125,1.666c2.916,0,4.533-1.875,4.533-1.875l-0.146,0.91c-0.055,0.348,0.213,0.66,0.564,0.66h2.949  c0.467,0,0.865-0.34,0.938-0.803l1.771-11.209C116.053,13.388,115.785,13.075,115.434,13.075z M110.869,19.449  c-0.314,1.871-1.801,3.127-3.695,3.127c-0.949,0-1.711-0.305-2.199-0.883c-0.484-0.574-0.666-1.391-0.514-2.301  c0.297-1.855,1.805-3.152,3.67-3.152c0.93,0,1.686,0.309,2.184,0.892C110.816,17.721,111.014,18.543,110.869,19.449z"/><path fill="#179BD7" d="M119.295,7.23l-2.807,17.858c-0.055,0.346,0.213,0.658,0.562,0.658h2.822c0.469,0,0.867-0.34,0.939-0.803  l2.768-17.536c0.055-0.346-0.213-0.659-0.562-0.659h-3.16C119.578,6.749,119.338,6.953,119.295,7.23z"/><path fill="#253B80" d="M7.266,29.154l0.523-3.322l-1.165-0.027H1.061L4.927,1.292C4.939,1.218,4.978,1.149,5.035,1.1  c0.057-0.049,0.13-0.076,0.206-0.076h9.38c3.114,0,5.263,0.648,6.385,1.927c0.526,0.6,0.861,1.227,1.023,1.917  c0.17,0.724,0.173,1.589,0.007,2.644l-0.012,0.077v0.676l0.526,0.298c0.443,0.235,0.795,0.504,1.065,0.812  c0.45,0.513,0.741,1.165,0.864,1.938c0.127,0.795,0.085,1.741-0.123,2.812c-0.24,1.232-0.628,2.305-1.152,3.183  c-0.482,0.809-1.096,1.48-1.825,2c-0.696,0.494-1.523,0.869-2.458,1.109c-0.906,0.236-1.939,0.355-3.072,0.355h-0.73  c-0.522,0-1.029,0.188-1.427,0.525c-0.399,0.344-0.663,0.814-0.744,1.328l-0.055,0.299l-0.924,5.855l-0.042,0.215  c-0.011,0.068-0.03,0.102-0.058,0.125c-0.025,0.021-0.061,0.035-0.096,0.035H7.266z"/><path fill="#179BD7" d="M23.048,7.667L23.048,7.667L23.048,7.667c-0.028,0.179-0.06,0.362-0.096,0.55  c-1.237,6.351-5.469,8.545-10.874,8.545H9.326c-0.661,0-1.218,0.48-1.321,1.132l0,0l0,0L6.596,26.83l-0.399,2.533  c-0.067,0.428,0.263,0.814,0.695,0.814h4.881c0.578,0,1.069-0.42,1.16-0.99l0.048-0.248l0.919-5.832l0.059-0.32  c0.09-0.572,0.582-0.992,1.16-0.992h0.73c4.729,0,8.431-1.92,9.513-7.476c0.452-2.321,0.218-4.259-0.978-5.622  C24.022,8.286,23.573,7.945,23.048,7.667z"/><path fill="#222D65" d="M21.754,7.151c-0.189-0.055-0.384-0.105-0.584-0.15c-0.201-0.044-0.407-0.083-0.619-0.117  c-0.742-0.12-1.555-0.177-2.426-0.177h-7.352c-0.181,0-0.353,0.041-0.507,0.115C9.927,6.985,9.675,7.306,9.614,7.699L8.05,17.605  l-0.045,0.289c0.103-0.652,0.66-1.132,1.321-1.132h2.752c5.405,0,9.637-2.195,10.874-8.545c0.037-0.188,0.068-0.371,0.096-0.55  c-0.313-0.166-0.652-0.308-1.017-0.429C21.941,7.208,21.848,7.179,21.754,7.151z"/>                                                                <path fill="#253B80" d="M9.614,7.699c0.061-0.393,0.313-0.714,0.652-0.876c0.155-0.074,0.326-0.115,0.507-0.115h7.352  c0.871,0,1.684,0.057,2.426,0.177c0.212,0.034,0.418,0.073,0.619,0.117c0.2,0.045,0.395,0.095,0.584,0.15  c0.094,0.028,0.187,0.057,0.278,0.086c0.365,0.121,0.704,0.264,1.017,0.429c0.368-2.347-0.003-3.945-1.272-5.392  C20.378,0.682,17.853,0,14.622,0h-9.38c-0.66,0-1.223,0.48-1.325,1.133L0.01,25.898c-0.077,0.49,0.301,0.932,0.795,0.932h5.791  l1.454-9.225L9.614,7.699z"/></svg>'; }
                                echo '
                                <label class="money__form" default-data="'.$card['value'].'"></label>
                                </span>
                                <div class="left-half-clipper">
                                    <div class="first50-bar';
                                    if (round($valperc) < 50) { echo ' first50-bar-dng'; }
                                    if (round($valperc) >= 50 && round($valperc) < 75) { echo ' first50-bar-wrn'; }
                                    if (round($valperc) >= 75) { echo ' first50-bar-suc'; }
                                    echo '"></div>
                                    <div class="value-bar ';
                                    if (round($valperc) < 50) { echo ' value-bar-dng'; }
                                    if (round($valperc) >= 50 && round($valperc) < 75) { echo ' value-bar-wrn'; }
                                    if (round($valperc) >= 75) { echo ' value-bar-suc'; }
                                    echo '"></div>
                                </div>
                            </div>
                            <div class="flex flex-col flex-align-c flex-justify-con-c">
                                <span class="text-primary small bold">'.$card['holder'].'</span>
                                <span class="flex flex-row flex-align-c flex-justify-con-c gap-05 text-muted small-med">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" viewBox="0 0 14 21" fill="none"><path opacity="0.3" d="M12 6.20001V1.20001H2V6.20001C2 6.50001 2.1 6.70001 2.3 6.90001L5.6 10.2L2.3 13.5C2.1 13.7 2 13.9 2 14.2V19.2H12V14.2C12 13.9 11.9 13.7 11.7 13.5L8.4 10.2L11.7 6.90001C11.9 6.70001 12 6.50001 12 6.20001Z" fill="currentColor"/><path d="M13 2.20001H1C0.4 2.20001 0 1.80001 0 1.20001C0 0.600012 0.4 0.200012 1 0.200012H13C13.6 0.200012 14 0.600012 14 1.20001C14 1.80001 13.6 2.20001 13 2.20001ZM13 18.2H10V16.2L7.7 13.9C7.3 13.5 6.7 13.5 6.3 13.9L4 16.2V18.2H1C0.4 18.2 0 18.6 0 19.2C0 19.8 0.4 20.2 1 20.2H13C13.6 20.2 14 19.8 14 19.2C14 18.6 13.6 18.2 13 18.2ZM4.4 6.20001L6.3 8.10001C6.7 8.50001 7.3 8.50001 7.7 8.10001L9.6 6.20001H4.4Z" fill="currentColor"/></svg>
                                    <span>'.$exp.'</span>
                                </span>
                                <span class="flex flex-row flex-align-c flex-justify-con-c gap-05 text-muted small-med">
                                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="14" height="14" viewBox="0 0 24 24" version="1.1"><g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"><mask fill="white"><use xlink:href="#path-1"/></mask><g/><path d="M7,10 L7,8 C7,5.23857625 9.23857625,3 12,3 C14.7614237,3 17,5.23857625 17,8 L17,10 L18,10 C19.1045695,10 20,10.8954305 20,12 L20,18 C20,19.1045695 19.1045695,20 18,20 L6,20 C4.8954305,20 4,19.1045695 4,18 L4,12 C4,10.8954305 4.8954305,10 6,10 L7,10 Z M12,5 C10.3431458,5 9,6.34314575 9,8 L9,10 L15,10 L15,8 C15,6.34314575 13.6568542,5 12,5 Z" fill="currentColor"/></g></svg>
                                    <span>'.$card['cardnum'].'</span>
                                </span>
                            </div>
                        </div>
                    </div>
                    ';
                    $allcurval += $card['value']; $allval += $defval;
                }
            }
        ?>
        </div>
    </div>
</div>
<div class="flex flex-col gap-1">
    <div class="flex flex-col w-fa gap-1 border-soft item-bg box-shadow padding-1">
        <div class="flex flex-row flex-align-c flex-justify-con-sb">
            <span class="text-primary large bold">Rendelések</span>
            <div class="flex flex-row flex-align-c gap-1">
                <div>
                    <span class="flex flex-col flex-align-c padding-025 text-muted primary-bg-hover border-soft pointer">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><rect opacity="0.5" x="17.0365" y="15.1223" width="8.15546" height="2" rx="1" transform="rotate(45 17.0365 15.1223)" fill="currentColor"></rect><path d="M11 19C6.55556 19 3 15.4444 3 11C3 6.55556 6.55556 3 11 3C15.4444 3 19 6.55556 19 11C19 15.4444 15.4444 19 11 19ZM11 5C7.53333 5 5 7.53333 5 11C5 14.4667 7.53333 17 11 17C14.4667 17 17 14.4667 17 11C17 7.53333 14.4667 5 11 5Z" fill="currentColor"></path></svg>
                    </span>
                </div>
                <div class="flex flex-row">
                    <span class="flex flex-col flex-align-c padding-025 text-muted primary-bg-hover border-soft pointer" id="load-list">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path opacity="0.3" d="M17.1 10.5H11.1C10.5 10.5 10.1 10.1 10.1 9.5V8.5C10.1 7.9 10.5 7.5 11.1 7.5H17.1C17.7 7.5 18.1 7.9 18.1 8.5V9.5C18.1 10.1 17.7 10.5 17.1 10.5ZM22.1 4.5V3.5C22.1 2.9 21.7 2.5 21.1 2.5H11.1C10.5 2.5 10.1 2.9 10.1 3.5V4.5C10.1 5.1 10.5 5.5 11.1 5.5H21.1C21.7 5.5 22.1 5.1 22.1 4.5ZM22.1 15.5V14.5C22.1 13.9 21.7 13.5 21.1 13.5H11.1C10.5 13.5 10.1 13.9 10.1 14.5V15.5C10.1 16.1 10.5 16.5 11.1 16.5H21.1C21.7 16.5 22.1 16.1 22.1 15.5ZM18.1 20.5V19.5C18.1 18.9 17.7 18.5 17.1 18.5H11.1C10.5 18.5 10.1 18.9 10.1 19.5V20.5C10.1 21.1 10.5 21.5 11.1 21.5H17.1C17.7 21.5 18.1 21.1 18.1 20.5Z" fill="currentColor"/><path d="M5.60001 10.5C5.30001 10.5 5.00002 10.4 4.80002 10.2C4.60002 9.99995 4.5 9.70005 4.5 9.30005V5.40002C3.7 5.90002 3.40001 6 3.10001 6C2.90001 6 2.6 5.89995 2.5 5.69995C2.3 5.49995 2.20001 5.3 2.20001 5C2.20001 4.6 2.4 4.40005 2.5 4.30005C2.6 4.20005 2.80001 4.10002 3.10001 3.90002C3.50001 3.70002 3.8 3.50005 4 3.30005C4.2 3.10005 4.40001 2.89995 4.60001 2.69995C4.80001 2.39995 4.9 2.19995 5 2.19995C5.1 2.09995 5.30001 2 5.60001 2C5.90001 2 6.10002 2.10002 6.30002 2.40002C6.50002 2.60002 6.5 2.89995 6.5 3.19995V9C6.6 10.4 5.90001 10.5 5.60001 10.5ZM7.10001 21.5C7.40001 21.5 7.69999 21.4 7.89999 21.2C8.09999 21 8.20001 20.8 8.20001 20.5C8.20001 20.2 8.10002 19.9 7.80002 19.8C7.60002 19.6 7.3 19.6 7 19.6H5.10001C5.30001 19.4 5.50002 19.2 5.80002 19C6.30002 18.6 6.69999 18.3 6.89999 18.1C7.09999 17.9 7.40001 17.6 7.60001 17.2C7.80001 16.8 8 16.3 8 15.9C8 15.6 7.90002 15.3 7.80002 15C7.70002 14.7 7.50002 14.5 7.30002 14.2C7.10002 14 6.80001 13.8 6.60001 13.7C6.20001 13.5 5.70001 13.4 5.10001 13.4C4.60001 13.4 4.20002 13.5 3.80002 13.6C3.40002 13.7 3.09999 13.9 2.89999 14.2C2.69999 14.4 2.50002 14.7 2.30002 15C2.20002 15.3 2.10001 15.6 2.10001 15.9C2.10001 16.3 2.29999 16.5 2.39999 16.6C2.59999 16.8 2.80001 16.9 3.10001 16.9C3.50001 16.9 3.70002 16.7 3.80002 16.6C3.90002 16.4 4.00001 16.2 4.10001 16C4.20001 15.8 4.20001 15.7 4.20001 15.7C4.40001 15.4 4.59999 15.3 4.89999 15.3C4.99999 15.3 5.20002 15.3 5.30002 15.4C5.40002 15.5 5.50001 15.5 5.60001 15.7C5.70001 15.8 5.70001 15.9 5.70001 16.1C5.70001 16.2 5.70001 16.4 5.60001 16.6C5.50001 16.8 5.40001 16.9 5.20001 17.1C5.00001 17.3 4.80001 17.5 4.60001 17.6C4.40001 17.7 4.20002 17.9 3.80002 18.3C3.40002 18.6 3.00001 19 2.60001 19.5C2.50001 19.6 2.30001 19.8 2.20001 20.1C2.10001 20.4 2 20.6 2 20.7C2 21 2.10002 21.3 2.30002 21.5C2.50002 21.7 2.80001 21.8 3.20001 21.8H7.10001V21.5Z" fill="currentColor"/></svg>
                    </span>
                </div>
            </div>
        </div>
        <div class="flex flex-col gap-2 prio__con">
            <?php
            $pr_sql = "SELECT products.id, products.name, products.thumbnail, SUM(orders.quantity) AS 'ord__quant' FROM products INNER JOIN orders ON orders.pid = products.id WHERE orders.uid = $guid GROUP BY orders.pid";
            $pr_res = $con-> query($pr_sql);
            if ($pr_res-> num_rows > 0) { $subtot = 0; $product = $pr_res-> fetch_assoc(); $pid = $product['id'];
                $pd__sql = "SELECT products.id, products.name, products.thumbnail, products__variations.color, products__variations.brand, products__inventory.code, products__pricing.base FROM products INNER JOIN products__variations ON products__variations.pid = products.id INNER JOIN products__inventory ON products__inventory.pid = products.id INNER JOIN products__pricing ON products__pricing.pid = products.id WHERE products.id = $pid";
                $pd__res = $con-> query($pd__sql);
                while ($prd = $pd__res-> fetch_assoc()) { $thmb = "'/assets/images/uploads/".$prd['thumbnail']."'";
                    echo '
                        <div class="flex flex-row flex-align-c flex-justify-con-sb gap-05">
                            <div class="flex flex-row gap-05">
                                <div class="flex flex-align-c flex-justify-con-c pri__con border-soft padding-05">
                                    <div class="product-miniature" style="background-image: url('.$thmb.');"></div>
                                </div>
                                <div class="flex flex-col gap-025">
                                    <span class="text-primary bold link pointer user-select-none"><a href="/product/'.$prd['id'].'/'; echo str_replace(',', '', str_replace(' ', '-',strtolower(strtr($prd['brand'], $unwanted_array)))).'-'.str_replace(',', '', str_replace(' ', '-',strtolower(strtr($prd['name'], $unwanted_array)))).'-'.str_replace(',', '', str_replace(' ', '-', strtolower(strtr($prd['color'], $unwanted_array)))); echo '" target="_blank">'.$prd['brand'].' - '.$prd['name'].'</a></span>
                                    <span class="text-secondary small capitalize">'.$prd['color'].' - '.$prd['code'].'</span>
                                    <span class="text-secondary small-med">Rendelve: <b>'.$product['ord__quant'].'</b> db.</span>
                                </div>
                            </div>
                            <div class="flex flex-col flex-align-c flex-justify-con-c">
                                <span class="text-primary small bold" id="prip__ind'.$prd['id'].'">NaN Ft</span>
                                <span class="text-secondary small-med">Összesen</span>
                            </div>
                        </div>
                        <script>document.getElementById("prip__ind'.$prd['id'].'").textContent = formatter.format('.$prd['base'] * $product['ord__quant'].');</script>
                    '; $subtot += ($prd['base'] * $product['ord__quant']);
                }
            } else { echo '<span class="text-secondary small-med">Ez a felhasználó még nem vásárolt semmilyen terméket...</span>'; }
            ?>
        </div>
    </div>
</div>
<div class="flex flex-col gap-1">
    <div class="flex flex-col w-fa gap-1 border-soft item-bg box-shadow padding-1">
        <div class="flex flex-row flex-align-c flex-justify-con-sb">
            <span class="text-primary large bold">Tranzakciók</span>
            <div class="flex flex-row flex-align-c gap-1">
                <div>
                    <span class="flex flex-col flex-align-c padding-025 text-muted primary-bg-hover border-soft pointer">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><rect opacity="0.5" x="17.0365" y="15.1223" width="8.15546" height="2" rx="1" transform="rotate(45 17.0365 15.1223)" fill="currentColor"></rect><path d="M11 19C6.55556 19 3 15.4444 3 11C3 6.55556 6.55556 3 11 3C15.4444 3 19 6.55556 19 11C19 15.4444 15.4444 19 11 19ZM11 5C7.53333 5 5 7.53333 5 11C5 14.4667 7.53333 17 11 17C14.4667 17 17 14.4667 17 11C17 7.53333 14.4667 5 11 5Z" fill="currentColor"></path></svg>
                    </span>
                </div>
                <div class="flex flex-row">
                    <span class="flex flex-col flex-align-c padding-025 text-muted primary-bg-hover border-soft pointer" id="load-list">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path opacity="0.3" d="M17.1 10.5H11.1C10.5 10.5 10.1 10.1 10.1 9.5V8.5C10.1 7.9 10.5 7.5 11.1 7.5H17.1C17.7 7.5 18.1 7.9 18.1 8.5V9.5C18.1 10.1 17.7 10.5 17.1 10.5ZM22.1 4.5V3.5C22.1 2.9 21.7 2.5 21.1 2.5H11.1C10.5 2.5 10.1 2.9 10.1 3.5V4.5C10.1 5.1 10.5 5.5 11.1 5.5H21.1C21.7 5.5 22.1 5.1 22.1 4.5ZM22.1 15.5V14.5C22.1 13.9 21.7 13.5 21.1 13.5H11.1C10.5 13.5 10.1 13.9 10.1 14.5V15.5C10.1 16.1 10.5 16.5 11.1 16.5H21.1C21.7 16.5 22.1 16.1 22.1 15.5ZM18.1 20.5V19.5C18.1 18.9 17.7 18.5 17.1 18.5H11.1C10.5 18.5 10.1 18.9 10.1 19.5V20.5C10.1 21.1 10.5 21.5 11.1 21.5H17.1C17.7 21.5 18.1 21.1 18.1 20.5Z" fill="currentColor"/><path d="M5.60001 10.5C5.30001 10.5 5.00002 10.4 4.80002 10.2C4.60002 9.99995 4.5 9.70005 4.5 9.30005V5.40002C3.7 5.90002 3.40001 6 3.10001 6C2.90001 6 2.6 5.89995 2.5 5.69995C2.3 5.49995 2.20001 5.3 2.20001 5C2.20001 4.6 2.4 4.40005 2.5 4.30005C2.6 4.20005 2.80001 4.10002 3.10001 3.90002C3.50001 3.70002 3.8 3.50005 4 3.30005C4.2 3.10005 4.40001 2.89995 4.60001 2.69995C4.80001 2.39995 4.9 2.19995 5 2.19995C5.1 2.09995 5.30001 2 5.60001 2C5.90001 2 6.10002 2.10002 6.30002 2.40002C6.50002 2.60002 6.5 2.89995 6.5 3.19995V9C6.6 10.4 5.90001 10.5 5.60001 10.5ZM7.10001 21.5C7.40001 21.5 7.69999 21.4 7.89999 21.2C8.09999 21 8.20001 20.8 8.20001 20.5C8.20001 20.2 8.10002 19.9 7.80002 19.8C7.60002 19.6 7.3 19.6 7 19.6H5.10001C5.30001 19.4 5.50002 19.2 5.80002 19C6.30002 18.6 6.69999 18.3 6.89999 18.1C7.09999 17.9 7.40001 17.6 7.60001 17.2C7.80001 16.8 8 16.3 8 15.9C8 15.6 7.90002 15.3 7.80002 15C7.70002 14.7 7.50002 14.5 7.30002 14.2C7.10002 14 6.80001 13.8 6.60001 13.7C6.20001 13.5 5.70001 13.4 5.10001 13.4C4.60001 13.4 4.20002 13.5 3.80002 13.6C3.40002 13.7 3.09999 13.9 2.89999 14.2C2.69999 14.4 2.50002 14.7 2.30002 15C2.20002 15.3 2.10001 15.6 2.10001 15.9C2.10001 16.3 2.29999 16.5 2.39999 16.6C2.59999 16.8 2.80001 16.9 3.10001 16.9C3.50001 16.9 3.70002 16.7 3.80002 16.6C3.90002 16.4 4.00001 16.2 4.10001 16C4.20001 15.8 4.20001 15.7 4.20001 15.7C4.40001 15.4 4.59999 15.3 4.89999 15.3C4.99999 15.3 5.20002 15.3 5.30002 15.4C5.40002 15.5 5.50001 15.5 5.60001 15.7C5.70001 15.8 5.70001 15.9 5.70001 16.1C5.70001 16.2 5.70001 16.4 5.60001 16.6C5.50001 16.8 5.40001 16.9 5.20001 17.1C5.00001 17.3 4.80001 17.5 4.60001 17.6C4.40001 17.7 4.20002 17.9 3.80002 18.3C3.40002 18.6 3.00001 19 2.60001 19.5C2.50001 19.6 2.30001 19.8 2.20001 20.1C2.10001 20.4 2 20.6 2 20.7C2 21 2.10002 21.3 2.30002 21.5C2.50002 21.7 2.80001 21.8 3.20001 21.8H7.10001V21.5Z" fill="currentColor"/></svg>
                    </span>
                </div>
            </div>
        </div>
        <div class="flex flex-col gap-2 prio__con">
            <?php
            if ($mn__stmt = $con->prepare('SELECT customers__transactions.*, customers__card.cardname FROM customers__transactions INNER JOIN customers__card ON customers__card.cid = customers__transactions.cid WHERE customers__transactions.uid = ? ORDER BY customers__transactions.date DESC')) {
                $mn__stmt->bind_param('i', $guid); $mn__stmt->execute(); $mn__res = $mn__stmt->get_result();
                if($mn__res->num_rows > 0) { $mnh__subt = 0;
                    while ($mn = $mn__res->fetch_assoc()) {
                        echo '
                            <div class="flex flex-row flex-align-c flex-justify-con-sb gap-1">
                                <div class="flex flex-row gap-1">
                                    <div class="flex flex-align-c flex-justify-con-c pri__con border-soft padding-05 relative">';
                                        if ($mn['type']) {
                                            echo '<span class="flex flex-align-c flex-justify-con-c" style="color:#3db875;"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"><path d="M17.8 8.79999L13 13.6L9.7 10.3C9.3 9.89999 8.7 9.89999 8.3 10.3L2.3 16.3C1.9 16.7 1.9 17.3 2.3 17.7C2.5 17.9 2.7 18 3 18C3.3 18 3.5 17.9 3.7 17.7L9 12.4L12.3 15.7C12.7 16.1 13.3 16.1 13.7 15.7L19.2 10.2L17.8 8.79999Z" fill="currentColor"/><path opacity="0.3" d="M22 13.1V7C22 6.4 21.6 6 21 6H14.9L22 13.1Z" fill="currentColor"/></svg></span>';
                                        } else {
                                            echo '<span class="flex flex-align-c flex-justify-con-c text-danger"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"><path d="M19.2 13.8L13.7 8.3C13.3 7.9 12.7 7.9 12.3 8.3L9 11.6L3.7 6.3C3.3 5.9 2.7 5.9 2.3 6.3C1.9 6.7 1.9 7.3 2.3 7.7L8.3 13.7C8.7 14.1 9.3 14.1 9.7 13.7L13 10.4L17.8 15.2L19.2 13.8Z" fill="currentColor"/><path opacity="0.3" d="M22 10.9V17C22 17.6 21.6 18 21 18H14.9L22 10.9Z" fill="currentColor"/></svg></span>';
                                        }
                                        echo '
                                    </div>
                                    <div class="flex flex-col gap-05">
                                        ';
                                        if (explode("_", $mn['item'])[0] == 'su') {
                                            if (explode("_", $mn['item'])[1] == 1) { $subname = 'Ingyenes'; } if (explode("_", $mn['item'])[1] == 2) { $subname = 'Törzsvásárló'; } if (explode("_", $mn['item'])[1] == 3) { $subname = 'Vállalati'; }
                                            if ($ctr__stmt = $con->prepare('SELECT * FROM customers__transactions WHERE uid = ? AND id = ?')) {
                                                $ctr__stmt->bind_param('ii', $guid, $mn['id']); $ctr__stmt->execute(); $ctr__res = $ctr__stmt->get_result(); $ctr = $ctr__res->fetch_assoc();
                                                echo '<span class="text-primary small"><em>'.$subname.'</em> '.$ctr['note'].'</span>';
                                            }
                                                    
                                        } else if (explode("_", $mn['item'])[0] == 'pr') {
                                            if ($ctr__stmt = $con->prepare('SELECT * FROM products WHERE products.id = ?')) {
                                                $ctr__stmt->bind_param('i', explode("_", $mn['item'])[1]); $ctr__stmt->execute(); $ctr__res = $ctr__stmt->get_result(); $ctr = $ctr__res->fetch_assoc();
                                                echo '<span class="text-primary small"><em><a href="/webshop/?id='.$ctr['id'].'">'.$ctr['name'].'</a></em> '.$mn['note'].'</span>';
                                            }
                                                    
                                        } else {
                                            if ($ctr__stmt = $con->prepare('SELECT * FROM customers__transactions WHERE uid = ? AND id = ?')) {
                                                $ctr__stmt->bind_param('ii', $guid, $mn['id']); $ctr__stmt->execute(); $ctr__res = $ctr__stmt->get_result(); $ctr = $ctr__res->fetch_assoc();
                                                echo '<span class="text-primary small capitalize">'.$ctr['note'].'</span>';
                                            }
                                        }
                                        echo '
                                        <span class="text-secondary small-med">'.$mn['date'].'</span>
                                    </div>
                                </div>
                                <div class="flex flex-col flex-align-c flex-justify-con-c">
                                    ';
                                    if ($mn['cardname'] == 'Mappa+ kártya') { echo '<svg xmlns="http://www.w3.org/2000/svg" width="32" height="24" viewBox="0 0 24 24" fill="none"><path d="M22 7H2V11H22V7Z" class="svg"></path><path opacity="0.3" d="M21 19H3C2.4 19 2 18.6 2 18V6C2 5.4 2.4 5 3 5H21C21.6 5 22 5.4 22 6V18C22 18.6 21.6 19 21 19ZM14 14C14 13.4 13.6 13 13 13H5C4.4 13 4 13.4 4 14C4 14.6 4.4 15 5 15H13C13.6 15 14 14.6 14 14ZM16 15.5C16 16.3 16.7 17 17.5 17H18.5C19.3 17 20 16.3 20 15.5C20 14.7 19.3 14 18.5 14H17.5C16.7 14 16 14.7 16 15.5Z" class="svg"></path></svg>'; }
                                    if ($mn['cardname'] == 'Mastercard') { echo '<svg xmlns="http://www.w3.org/2000/svg" width="32" height="24" viewBox="0 0 80 48" fill="none"><rect width="80" height="48" rx="6"></rect><g clip-path="url(#clip0)"><path d="M47.129 35.9651H33.8779V12.2273H47.1292L47.129 35.9651Z" fill="#FF5F00"></path><path d="M34.718 24.096C34.718 19.2808 36.9798 14.9914 40.502 12.2271C37.8359 10.1316 34.5384 8.99434 31.1432 8.99935C22.7796 8.99935 16 15.7583 16 24.096C16 32.4338 22.7796 39.1927 31.1432 39.1927C34.5385 39.1978 37.8361 38.0605 40.5022 35.9649C36.9803 33.2011 34.718 28.9115 34.718 24.096Z" fill="#EB001B"></path><path d="M65.0061 24.0967C65.0061 32.4345 58.2265 39.1934 49.8629 39.1934C46.4673 39.1984 43.1693 38.0611 40.5027 35.9656C44.0258 33.2013 46.2876 28.9121 46.2876 24.0967C46.2876 19.2813 44.0258 14.9921 40.5027 12.2278C43.1693 10.1324 46.4671 8.9951 49.8627 9.00002C58.2263 9.00002 65.0059 15.7589 65.0059 24.0967" fill="#F79E1B"></path></g><defs><clipPath id="clip0"><rect width="49" height="38" fill="white" transform="translate(16 9)"></rect></clipPath></defs></svg>'; }
                                    if ($mn['cardname'] == 'Visa') { echo '<svg xmlns="http://www.w3.org/2000/svg" width="32" height="24" viewBox="0 0 80 48" fill="none"><rect width="80" height="48" rx="6"></rect><path d="M36.71 33.6833H32.059L34.9658 15.328H39.6174L36.71 33.6833ZM28.1462 15.328L23.712 27.9529L23.1873 25.2343L23.1878 25.2353L21.6228 16.9807C21.6228 16.9807 21.4336 15.328 19.4165 15.328H12.086L12 15.6388C12 15.6388 14.2417 16.118 16.8652 17.7368L20.906 33.6838H25.7521L33.1518 15.328H28.1462V15.328ZM64.7293 33.6833H69L65.2765 15.3275H61.5376C59.8111 15.3275 59.3906 16.6954 59.3906 16.6954L52.4538 33.6833H57.3023L58.2719 30.9568H64.1845L64.7293 33.6833ZM59.6113 27.1904L62.0552 20.3214L63.43 27.1904H59.6113ZM52.8175 19.742L53.4813 15.8003C53.4813 15.8003 51.4331 15 49.298 15C46.9899 15 41.5088 16.0365 41.5088 21.0765C41.5088 25.8186 47.9418 25.8775 47.9418 28.3683C47.9418 30.8591 42.1716 30.4128 40.2673 28.8421L39.5758 32.9635C39.5758 32.9635 41.6526 34 44.8257 34C47.9996 34 52.7879 32.3115 52.7879 27.7158C52.7879 22.9433 46.297 22.499 46.297 20.424C46.2975 18.3486 50.8272 18.6152 52.8175 19.742V19.742Z" fill="#2566AF"></path><path d="M23.1878 25.2348L21.6228 16.9802C21.6228 16.9802 21.4336 15.3275 19.4165 15.3275H12.086L12 15.6383C12 15.6383 15.5233 16.3886 18.9028 19.1995C22.1341 21.8862 23.1878 25.2348 23.1878 25.2348Z" fill="#E6A540"></path></svg>'; }
                                    if ($mn['cardname'] == 'PayPal') { echo '<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" id="Layer_1" x="0px" y="0px" width="32" height="24" viewBox="0 0 124 33" enable-background="new 0 0 124 33" xml:space="preserve"><path fill="#253B80" d="M46.211,6.749h-6.839c-0.468,0-0.866,0.34-0.939,0.802l-2.766,17.537c-0.055,0.346,0.213,0.658,0.564,0.658  h3.265c0.468,0,0.866-0.34,0.939-0.803l0.746-4.73c0.072-0.463,0.471-0.803,0.938-0.803h2.165c4.505,0,7.105-2.18,7.784-6.5  c0.306-1.89,0.013-3.375-0.872-4.415C50.224,7.353,48.5,6.749,46.211,6.749z M47,13.154c-0.374,2.454-2.249,2.454-4.062,2.454  h-1.032l0.724-4.583c0.043-0.277,0.283-0.481,0.563-0.481h0.473c1.235,0,2.4,0,3.002,0.704C47.027,11.668,47.137,12.292,47,13.154z"/><path fill="#253B80" d="M66.654,13.075h-3.275c-0.279,0-0.52,0.204-0.563,0.481l-0.145,0.916l-0.229-0.332  c-0.709-1.029-2.29-1.373-3.868-1.373c-3.619,0-6.71,2.741-7.312,6.586c-0.313,1.918,0.132,3.752,1.22,5.031  c0.998,1.176,2.426,1.666,4.125,1.666c2.916,0,4.533-1.875,4.533-1.875l-0.146,0.91c-0.055,0.348,0.213,0.66,0.562,0.66h2.95  c0.469,0,0.865-0.34,0.939-0.803l1.77-11.209C67.271,13.388,67.004,13.075,66.654,13.075z M62.089,19.449  c-0.316,1.871-1.801,3.127-3.695,3.127c-0.951,0-1.711-0.305-2.199-0.883c-0.484-0.574-0.668-1.391-0.514-2.301  c0.295-1.855,1.805-3.152,3.67-3.152c0.93,0,1.686,0.309,2.184,0.892C62.034,17.721,62.232,18.543,62.089,19.449z"/><path fill="#253B80" d="M84.096,13.075h-3.291c-0.314,0-0.609,0.156-0.787,0.417l-4.539,6.686l-1.924-6.425  c-0.121-0.402-0.492-0.678-0.912-0.678h-3.234c-0.393,0-0.666,0.384-0.541,0.754l3.625,10.638l-3.408,4.811  c-0.268,0.379,0.002,0.9,0.465,0.9h3.287c0.312,0,0.604-0.152,0.781-0.408L84.564,13.97C84.826,13.592,84.557,13.075,84.096,13.075z  "/><path fill="#179BD7" d="M94.992,6.749h-6.84c-0.467,0-0.865,0.34-0.938,0.802l-2.766,17.537c-0.055,0.346,0.213,0.658,0.562,0.658  h3.51c0.326,0,0.605-0.238,0.656-0.562l0.785-4.971c0.072-0.463,0.471-0.803,0.938-0.803h2.164c4.506,0,7.105-2.18,7.785-6.5  c0.307-1.89,0.012-3.375-0.873-4.415C99.004,7.353,97.281,6.749,94.992,6.749z M95.781,13.154c-0.373,2.454-2.248,2.454-4.062,2.454  h-1.031l0.725-4.583c0.043-0.277,0.281-0.481,0.562-0.481h0.473c1.234,0,2.4,0,3.002,0.704  C95.809,11.668,95.918,12.292,95.781,13.154z"/><path fill="#179BD7" d="M115.434,13.075h-3.273c-0.281,0-0.52,0.204-0.562,0.481l-0.145,0.916l-0.23-0.332  c-0.709-1.029-2.289-1.373-3.867-1.373c-3.619,0-6.709,2.741-7.311,6.586c-0.312,1.918,0.131,3.752,1.219,5.031  c1,1.176,2.426,1.666,4.125,1.666c2.916,0,4.533-1.875,4.533-1.875l-0.146,0.91c-0.055,0.348,0.213,0.66,0.564,0.66h2.949  c0.467,0,0.865-0.34,0.938-0.803l1.771-11.209C116.053,13.388,115.785,13.075,115.434,13.075z M110.869,19.449  c-0.314,1.871-1.801,3.127-3.695,3.127c-0.949,0-1.711-0.305-2.199-0.883c-0.484-0.574-0.666-1.391-0.514-2.301  c0.297-1.855,1.805-3.152,3.67-3.152c0.93,0,1.686,0.309,2.184,0.892C110.816,17.721,111.014,18.543,110.869,19.449z"/><path fill="#179BD7" d="M119.295,7.23l-2.807,17.858c-0.055,0.346,0.213,0.658,0.562,0.658h2.822c0.469,0,0.867-0.34,0.939-0.803  l2.768-17.536c0.055-0.346-0.213-0.659-0.562-0.659h-3.16C119.578,6.749,119.338,6.953,119.295,7.23z"/><path fill="#253B80" d="M7.266,29.154l0.523-3.322l-1.165-0.027H1.061L4.927,1.292C4.939,1.218,4.978,1.149,5.035,1.1  c0.057-0.049,0.13-0.076,0.206-0.076h9.38c3.114,0,5.263,0.648,6.385,1.927c0.526,0.6,0.861,1.227,1.023,1.917  c0.17,0.724,0.173,1.589,0.007,2.644l-0.012,0.077v0.676l0.526,0.298c0.443,0.235,0.795,0.504,1.065,0.812  c0.45,0.513,0.741,1.165,0.864,1.938c0.127,0.795,0.085,1.741-0.123,2.812c-0.24,1.232-0.628,2.305-1.152,3.183  c-0.482,0.809-1.096,1.48-1.825,2c-0.696,0.494-1.523,0.869-2.458,1.109c-0.906,0.236-1.939,0.355-3.072,0.355h-0.73  c-0.522,0-1.029,0.188-1.427,0.525c-0.399,0.344-0.663,0.814-0.744,1.328l-0.055,0.299l-0.924,5.855l-0.042,0.215  c-0.011,0.068-0.03,0.102-0.058,0.125c-0.025,0.021-0.061,0.035-0.096,0.035H7.266z"/><path fill="#179BD7" d="M23.048,7.667L23.048,7.667L23.048,7.667c-0.028,0.179-0.06,0.362-0.096,0.55  c-1.237,6.351-5.469,8.545-10.874,8.545H9.326c-0.661,0-1.218,0.48-1.321,1.132l0,0l0,0L6.596,26.83l-0.399,2.533  c-0.067,0.428,0.263,0.814,0.695,0.814h4.881c0.578,0,1.069-0.42,1.16-0.99l0.048-0.248l0.919-5.832l0.059-0.32  c0.09-0.572,0.582-0.992,1.16-0.992h0.73c4.729,0,8.431-1.92,9.513-7.476c0.452-2.321,0.218-4.259-0.978-5.622  C24.022,8.286,23.573,7.945,23.048,7.667z"/><path fill="#222D65" d="M21.754,7.151c-0.189-0.055-0.384-0.105-0.584-0.15c-0.201-0.044-0.407-0.083-0.619-0.117  c-0.742-0.12-1.555-0.177-2.426-0.177h-7.352c-0.181,0-0.353,0.041-0.507,0.115C9.927,6.985,9.675,7.306,9.614,7.699L8.05,17.605  l-0.045,0.289c0.103-0.652,0.66-1.132,1.321-1.132h2.752c5.405,0,9.637-2.195,10.874-8.545c0.037-0.188,0.068-0.371,0.096-0.55  c-0.313-0.166-0.652-0.308-1.017-0.429C21.941,7.208,21.848,7.179,21.754,7.151z"/>                                                                <path fill="#253B80" d="M9.614,7.699c0.061-0.393,0.313-0.714,0.652-0.876c0.155-0.074,0.326-0.115,0.507-0.115h7.352  c0.871,0,1.684,0.057,2.426,0.177c0.212,0.034,0.418,0.073,0.619,0.117c0.2,0.045,0.395,0.095,0.584,0.15  c0.094,0.028,0.187,0.057,0.278,0.086c0.365,0.121,0.704,0.264,1.017,0.429c0.368-2.347-0.003-3.945-1.272-5.392  C20.378,0.682,17.853,0,14.622,0h-9.38c-0.66,0-1.223,0.48-1.325,1.133L0.01,25.898c-0.077,0.49,0.301,0.932,0.795,0.932h5.791  l1.454-9.225L9.614,7.699z"/></svg>'; }
                                    echo '
                                    <span class="flex flex-row flex-align-c gap-025 text-primary bold smaller-light">'; if ($mn['type']) {echo '+';}else{echo '-';} echo' <span class="text-primary bold" id="form-mn-his-'.$mn['id'].'">NaN Ft</span></span>
                                </div>
                            </div>
                            <script>document.getElementById("form-mn-his-'.$mn['id'].'").textContent = formatter.format('.$mn['price'].');</script>
                        '; $mnh__subt += $mn['subtotal'] * $mn['quantity'];
                    }
                } else {
                    echo '
                    <div class="flex flex-col gap-2 prio__con">
                        <span class="text-secondary small-med">Ez a felhasználó még nem bonyolított le egy tranzakciót sem...</span>
                    </div>';
                }
            }
            ?>
        </div>
    </div>
</div>
<div class="flex flex-col gap-1">
    <div class="flex flex-col w-fa gap-1 border-soft item-bg box-shadow padding-1">
        <div class="flex flex-row flex-align-c flex-justify-con-sb">
            <span class="text-primary large bold">Értékelések</span>
            <div class="flex flex-row flex-align-c gap-1">
                <div>
                    <span class="flex flex-col flex-align-c padding-025 text-muted primary-bg-hover border-soft pointer">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><rect opacity="0.5" x="17.0365" y="15.1223" width="8.15546" height="2" rx="1" transform="rotate(45 17.0365 15.1223)" fill="currentColor"></rect><path d="M11 19C6.55556 19 3 15.4444 3 11C3 6.55556 6.55556 3 11 3C15.4444 3 19 6.55556 19 11C19 15.4444 15.4444 19 11 19ZM11 5C7.53333 5 5 7.53333 5 11C5 14.4667 7.53333 17 11 17C14.4667 17 17 14.4667 17 11C17 7.53333 14.4667 5 11 5Z" fill="currentColor"></path></svg>
                    </span>
                </div>
                <div class="flex flex-row">
                    <span class="flex flex-col flex-align-c padding-025 text-muted primary-bg-hover border-soft pointer" id="load-list">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path opacity="0.3" d="M17.1 10.5H11.1C10.5 10.5 10.1 10.1 10.1 9.5V8.5C10.1 7.9 10.5 7.5 11.1 7.5H17.1C17.7 7.5 18.1 7.9 18.1 8.5V9.5C18.1 10.1 17.7 10.5 17.1 10.5ZM22.1 4.5V3.5C22.1 2.9 21.7 2.5 21.1 2.5H11.1C10.5 2.5 10.1 2.9 10.1 3.5V4.5C10.1 5.1 10.5 5.5 11.1 5.5H21.1C21.7 5.5 22.1 5.1 22.1 4.5ZM22.1 15.5V14.5C22.1 13.9 21.7 13.5 21.1 13.5H11.1C10.5 13.5 10.1 13.9 10.1 14.5V15.5C10.1 16.1 10.5 16.5 11.1 16.5H21.1C21.7 16.5 22.1 16.1 22.1 15.5ZM18.1 20.5V19.5C18.1 18.9 17.7 18.5 17.1 18.5H11.1C10.5 18.5 10.1 18.9 10.1 19.5V20.5C10.1 21.1 10.5 21.5 11.1 21.5H17.1C17.7 21.5 18.1 21.1 18.1 20.5Z" fill="currentColor"/><path d="M5.60001 10.5C5.30001 10.5 5.00002 10.4 4.80002 10.2C4.60002 9.99995 4.5 9.70005 4.5 9.30005V5.40002C3.7 5.90002 3.40001 6 3.10001 6C2.90001 6 2.6 5.89995 2.5 5.69995C2.3 5.49995 2.20001 5.3 2.20001 5C2.20001 4.6 2.4 4.40005 2.5 4.30005C2.6 4.20005 2.80001 4.10002 3.10001 3.90002C3.50001 3.70002 3.8 3.50005 4 3.30005C4.2 3.10005 4.40001 2.89995 4.60001 2.69995C4.80001 2.39995 4.9 2.19995 5 2.19995C5.1 2.09995 5.30001 2 5.60001 2C5.90001 2 6.10002 2.10002 6.30002 2.40002C6.50002 2.60002 6.5 2.89995 6.5 3.19995V9C6.6 10.4 5.90001 10.5 5.60001 10.5ZM7.10001 21.5C7.40001 21.5 7.69999 21.4 7.89999 21.2C8.09999 21 8.20001 20.8 8.20001 20.5C8.20001 20.2 8.10002 19.9 7.80002 19.8C7.60002 19.6 7.3 19.6 7 19.6H5.10001C5.30001 19.4 5.50002 19.2 5.80002 19C6.30002 18.6 6.69999 18.3 6.89999 18.1C7.09999 17.9 7.40001 17.6 7.60001 17.2C7.80001 16.8 8 16.3 8 15.9C8 15.6 7.90002 15.3 7.80002 15C7.70002 14.7 7.50002 14.5 7.30002 14.2C7.10002 14 6.80001 13.8 6.60001 13.7C6.20001 13.5 5.70001 13.4 5.10001 13.4C4.60001 13.4 4.20002 13.5 3.80002 13.6C3.40002 13.7 3.09999 13.9 2.89999 14.2C2.69999 14.4 2.50002 14.7 2.30002 15C2.20002 15.3 2.10001 15.6 2.10001 15.9C2.10001 16.3 2.29999 16.5 2.39999 16.6C2.59999 16.8 2.80001 16.9 3.10001 16.9C3.50001 16.9 3.70002 16.7 3.80002 16.6C3.90002 16.4 4.00001 16.2 4.10001 16C4.20001 15.8 4.20001 15.7 4.20001 15.7C4.40001 15.4 4.59999 15.3 4.89999 15.3C4.99999 15.3 5.20002 15.3 5.30002 15.4C5.40002 15.5 5.50001 15.5 5.60001 15.7C5.70001 15.8 5.70001 15.9 5.70001 16.1C5.70001 16.2 5.70001 16.4 5.60001 16.6C5.50001 16.8 5.40001 16.9 5.20001 17.1C5.00001 17.3 4.80001 17.5 4.60001 17.6C4.40001 17.7 4.20002 17.9 3.80002 18.3C3.40002 18.6 3.00001 19 2.60001 19.5C2.50001 19.6 2.30001 19.8 2.20001 20.1C2.10001 20.4 2 20.6 2 20.7C2 21 2.10002 21.3 2.30002 21.5C2.50002 21.7 2.80001 21.8 3.20001 21.8H7.10001V21.5Z" fill="currentColor"/></svg>
                    </span>
                </div>
            </div>
        </div>
        <div class="flex flex-col gap-2 prio__con">
            <?php
            $pr_sql = "SELECT reviews.pid, reviews.stars, reviews.description, reviews.privacy, reviews.date, products.name, products.thumbnail, products__variations.brand, products__variations.color
            FROM reviews INNER JOIN products ON products.id = reviews.pid INNER JOIN products__variations ON products__variations.pid = products.id WHERE reviews.uid = $guid ORDER BY reviews.date DESC"; $pr_res = $con-> query($pr_sql);
            if ($pr_res-> num_rows > 0) {
                while ($rev = $pr_res-> fetch_assoc()) {
                    echo '
                    <div class="flex flex-row flex-align-c flex-justify-con-sb gap-05">
                        <div class="flex flex-row gap-05">
                            <div class="flex flex-align-c flex-justify-con-c pri__con border-soft padding-05">
                                <div class="product-miniature" style="background-image: url(/assets/images/uploads/'.$rev['thumbnail'].')"></div>
                            </div>
                            <div class="flex flex-col gap-025">
                                <span class="text-primary bold link pointer user-select-none"><a href="/product/'.$rev['pid'].'/'; echo str_replace(',', '', str_replace(' ', '-',strtolower(strtr($rev['brand'], $unwanted_array)))).'-'.str_replace(',', '', str_replace(' ', '-',strtolower(strtr($rev['name'], $unwanted_array)))).'-'.str_replace(',', '', str_replace(' ', '-', strtolower(strtr($rev['color'], $unwanted_array)))); echo '?tab=reviews">'.$rev['name'].'</a></span>
                                <span class="text-secondary small capitalize">'.$rev['color'].' - '.$rev['brand'].'</span>
                            </div>
                        </div>
                    </div>
                    ';
                }
            } else { echo '<span class="text-secondary">Ez a felhasználó még nem értékelt terméket...</span>'; }
            ?>
        </div>
    </div>
</div>
<script>var bal__to__form = document.getElementsByClassName('money__form'); for (let i = 0; i < bal__to__form.length; i++) { bal__to__form[i].textContent = formatter.format(bal__to__form[i].getAttribute('default-data')); }</script>