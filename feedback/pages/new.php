<?php require_once($_SERVER['DOCUMENT_ROOT'].'/includes/inc.php'); include($_SERVER['DOCUMENT_ROOT'].'/assets/alph.php'); $uid = $_SESSION['id'];
$stmt = $con->prepare('SELECT privilege FROM customers__priv  WHERE uid = ?'); if (isset($_SESSION['loggedin'])) {$id = $_SESSION['id'];} $stmt->bind_param('i', $id);$stmt->execute(); $stmt->bind_result($privilege); $stmt->fetch();$stmt->close();
function get_time_ago( $time ) {
    $time_difference = time() - $time;
    if( $time_difference < 1 ) { return '< 1mp'; }
    $condition = array( 12 * 30 * 24 * 60 * 60 =>  'éve',30 * 24 * 60 * 60 => 'hónapja',24 * 60 * 60 => 'napja',60 * 60 =>  'órája',60 =>  'perce',1 =>  'másodperce');
    foreach( $condition as $secs => $str ) {$d = $time_difference / $secs;if( $d >= 1 ) {$t = round( $d );return $t . ' ' . $str . ( $t > 1 ? '' : '' ) . '';}}
}
?>
<script src="/assets/script/quill/dist/quill.js"></script>
<script src="/assets/script/tagify/dist/tagify.js"></script>
<script>var formatter = new Intl.NumberFormat('hu-HU', {style: 'currency',currency: 'HUF',maximumFractionDigits: 0,minimumFractionDigits: 0});</script>
<div class="flex flex-row flex-align-c flex-justify-con-sb">
    <div class="flex flex-col w-fa gap-1 border-soft item-bg box-shadow padding-1">
        <div class="flex flex-col gap-05">
            <span class="text-secondary small">Visszajelzés címe</span>
            <input type="text" class="adm__input item-bg border-soft w-fa text-secondary outline-none small prd-ch-fr-er" id="feedback-title" name="feedback-title" placeholder="Visszajeltés címe" required="">
            <span class="text-muted small-med">Foglalja össze pár kulcsszóban a visszajelzés témáját</span>
        </div>
        <form>
            <input type="file" id="product-thumbnail" class="hidden prd-ch-fr-er" accept=".png, .jpg, .jpeg">
            <div id="thumbnail-con" class="flex"></div>
            <div id="thumbnail-form-con">
                <div id="thumbnail-form" class="drag-area flex flex-row-d-col-m flex-align-c flex-justify-con-sb border-soft border-primary-light-dotted primary-bg padding-1 user-select-none pointer">
                    <div class="flex flex-row-d-col-m flex-align-c gap-1">
                        <div class="flex flex-row flex-align-c gap-1">
                            <div class="drag-icon flex">
                                <svg class="drop-shadow" width="36" height="36" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path opacity="0.3" d="M19 22H5C4.4 22 4 21.6 4 21V3C4 2.4 4.4 2 5 2H14L20 8V21C20 21.6 19.6 22 19 22ZM14.5 12L12.7 9.3C12.3 8.9 11.7 8.9 11.3 9.3L10 12H11.5V17C11.5 17.6 11.4 18 12 18C12.6 18 12.5 17.6 12.5 17V12H14.5Z" fill="currentColor"></path><path d="M13 11.5V17.9355C13 18.2742 12.6 19 12 19C11.4 19 11 18.2742 11 17.9355V11.5H13Z" fill="currentColor"></path><path d="M8.2575 11.4411C7.82942 11.8015 8.08434 12.5 8.64398 12.5H15.356C15.9157 12.5 16.1706 11.8015 15.7425 11.4411L12.4375 8.65789C12.1875 8.44737 11.8125 8.44737 11.5625 8.65789L8.2575 11.4411Z" fill="currentColor"></path><path d="M15 8H20L14 2V7C14 7.6 14.4 8 15 8Z" fill="currentColor"></path></svg>
                            </div>
                            <div class="drag-text flex flex-col flex-align-c flex-justify-con-fs">
                                <span class="bold w-100 small">Húzza ide ide a feltölteni kívánt képet, vagy kattintson.</span>
                                <span class="text-muted small-med w-fa">Állítsa be a termék miniatűrjét. Csak *.png, *.jpg és *.jpeg képfájlokat fogadunk el.</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
        <div class="flex flex-col gap-05">
            <span class="text-secondary small">Visszejelzés leírása</span>
            <div class="flex flex-col">
                <div id="prod-meta-editor" class="border-soft prd-ch-fr-er-ce" style="height: 18rem;"></div>
            </div>
            <script>
                var quill = new Quill('#prod-meta-editor', {
                    modules: { toolbar: false }, placeholder: 'Ide írja a leírását...', theme: 'snow'
                });
            </script>
            <span class="text-muted small-med">Ebben a mezőben részletesen fejtse ki véleményét, észrevételeit.</span>
        </div>
        <div class="flex flex-col gap-05">
            <span class="text-secondary small">Visszajelzés típusa</span>
            <input name='feedback-type' id='feedback-type' class='adm__input w-fa border-soft cst-drp-fts prd-ch-fr-er' placeholder='Visszajelzés típusa'>
            <script>
                var prd_mtk_inp = document.querySelector('input[name="feedback-type"]'),
                tagify = new Tagify(prd_mtk_inp, { 
                    userInput: false,
                    whitelist: [
                        {
                            "value"    : "Webáruház",
                            "readonly" : true
                        },
                        {
                            "value"    : "Termékek",
                            "readonly" : true
                        },
                        {
                            "value"    : "Rendelés",
                            "readonly" : true
                        },
                        {
                            "value"    : "Szállítás",
                            "readonly" : true
                        },
                        {
                            "value"    : "Felhasználó",
                            "readonly" : true
                        },
                        {
                            "value"    : "Weboldal",
                            "readonly" : true
                        },
                        {
                            "value"    : "Egyéb",
                            "readonly" : true
                        },
                    ],
                    maxTags: 1, dropdown: { maxItems: 7, classname: "tags-look", enabled: 0, closeOnSelect: false }, originalInputValueFormat: valuesArr => valuesArr.map(item => item.value).join(',')
                });
            </script>
            <span class="text-muted small-med">Válassza ki a visszajelzés típusát.</span>
        </div>
        <div class="flex flex-row flex-align-c flex-justify-con-fe w-fa">
            <span class="flex flex-row flex-align-c flex-justify-con-c w-fc gap-05 primary-bg primary-bg-hover border-soft padding-05 user-select-none pointer small-med bold">
                <span class="flex flex-col flex-align-c flex-justify-con-c">Elküldés</span>
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M12.6343 12.5657L8.45001 16.75C8.0358 17.1642 8.0358 17.8358 8.45001 18.25C8.86423 18.6642 9.5358 18.6642 9.95001 18.25L15.4929 12.7071C15.8834 12.3166 15.8834 11.6834 15.4929 11.2929L9.95001 5.75C9.5358 5.33579 8.86423 5.33579 8.45001 5.75C8.0358 6.16421 8.0358 6.83579 8.45001 7.25L12.6343 11.4343C12.9467 11.7467 12.9467 12.2533 12.6343 12.5657Z" fill="currentColor"/></svg>
            </span>
        </div>
    </div>
</div>
