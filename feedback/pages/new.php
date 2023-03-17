<?php require_once($_SERVER['DOCUMENT_ROOT'].'/includes/inc.php'); include($_SERVER['DOCUMENT_ROOT'].'/assets/alph.php'); $uid = $_SESSION['id']; $stmt = $con->prepare('SELECT privilege FROM customers__priv  WHERE uid = ?'); if (isset($_SESSION['loggedin'])) {$id = $_SESSION['id'];} $stmt->bind_param('i', $id);$stmt->execute(); $stmt->bind_result($privilege); $stmt->fetch();$stmt->close(); ?>
<script src="/assets/script/quill/dist/quill.js"></script><script src="/assets/script/tagify/dist/tagify.js"></script>
<div class="flex flex-row flex-align-c flex-justify-con-sb">
    <div class="flex flex-col w-fa gap-2 border-soft item-bg box-shadow padding-1">
        <div class="flex flex-col gap-05">
            <span class="text-secondary small">Visszajelzés címe</span>
            <input type="text" class="adm__input item-bg border-soft w-fa text-secondary outline-none small prd-ch-fr-er" id="feedback-title" name="feedback-title" placeholder="Visszajelzés címe" required="">
            <span class="text-muted small-med">Foglalja össze pár kulcsszóban a visszajelzés témáját</span>
            <div class="flex flex-row flex-align-c flex-justify-con-fe w-fa feedback-error-con" id="feedback-error-title"></div>
        </div>
        <div class="flex flex-row-d-col-m gap-1">
            <div class="flex flex-col w-fa gap-1">
                <div class="flex flex-col gap-025">
                    <div class="flex flex-row flex-align-c gap-1">
                        <span class="text-secondary small">Kép csatolása</span>
                        <div class="label label-danger border-soft-light user-select-none">Demo</div>
                    </div>
                </div>
                <div class="flex flex-row gap-1 w-fa">
                    <div class="flex flex-row gap-1" id="miniatures-con"></div>
                    <div id="min-upl-con">
                        <div id="miniature-uploader" class="flex flex-row-d-col-m flex-align-c flex-justify-con-c border-soft border-secondary-dotted background-bg background-bg-hover text-primary padding-1 user-select-none w-fc pointer miniature-fixed" onclick="__inituploader()">
                            <div class="flex flex-row-d-col-m flex-align-c gap-1">
                                <div class="flex flex-row flex-align-c gap-1">
                                    <div class="flex flex-col flex-align-c flex-justify-con-c">
                                        <svg width="48" height="48" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M3 13V11C3 10.4 3.4 10 4 10H20C20.6 10 21 10.4 21 11V13C21 13.6 20.6 14 20 14H4C3.4 14 3 13.6 3 13Z" fill="currentColor"/><path d="M13 21H11C10.4 21 10 20.6 10 20V4C10 3.4 10.4 3 11 3H13C13.6 3 14 3.4 14 4V20C14 20.6 13.6 21 13 21Z" fill="currentColor"/></svg>
                                        <span class="text-muted small-med w-fa text-align-c">Hozzáadás</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="flex flex-col gap-05">
            <span class="text-secondary small">Visszejelzés leírása</span>
            <div class="flex flex-col">
                <div id="prod-meta-editor" class="border-soft prd-ch-fr-er-ce" style="height: 18rem;"></div>
            </div>
            <script>var quill = new Quill('#prod-meta-editor', { modules: { toolbar: false }, placeholder: 'Ide írja a leírását...', theme: 'snow' });</script>
            <span class="text-muted small-med">Ebben a mezőben részletesen fejtse ki véleményét, észrevételeit.</span>
            <div class="flex flex-row flex-align-c flex-justify-con-fe w-fa feedback-error-con" id="feedback-error-description"></div>
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
                    ], maxTags: 1, dropdown: { maxItems: 7, classname: "tags-look", enabled: 0, closeOnSelect: false }, originalInputValueFormat: valuesArr => valuesArr.map(item => item.value).join(',')
                });
            </script>
            <span class="text-muted small-med">Válassza ki a visszajelzés típusát.</span>
            <div class="flex flex-row flex-align-c flex-justify-con-fe w-fa feedback-error-con" id="feedback-error-type"></div>
        </div>
        <div class="flex flex-row flex-align-c flex-justify-con-fe w-fa">
            <span id="send-review" class="flex flex-row flex-align-c flex-justify-con-c w-fc gap-05 primary-bg primary-bg-hover border-soft padding-05 user-select-none pointer small-med bold">
                <span class="flex flex-col flex-align-c flex-justify-con-c">Elküldés</span>
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M12.6343 12.5657L8.45001 16.75C8.0358 17.1642 8.0358 17.8358 8.45001 18.25C8.86423 18.6642 9.5358 18.6642 9.95001 18.25L15.4929 12.7071C15.8834 12.3166 15.8834 11.6834 15.4929 11.2929L9.95001 5.75C9.5358 5.33579 8.86423 5.33579 8.45001 5.75C8.0358 6.16421 8.0358 6.83579 8.45001 7.25L12.6343 11.4343C12.9467 11.7467 12.9467 12.2533 12.6343 12.5657Z" fill="currentColor"/></svg>
            </span>
        </div>
    </div>
</div>
<script>
    var minActive = 0; var miniArr = [];
    $('#send-review').click(() => {
        
        var error_con = document.getElementsByClassName('feedback-error-con');
        for (let i = 0; i < error_con.length; i++) {
            error_con[i].innerHTML = ``;
        }

        var feedbackData = new FormData(); 
        const feedbackObject = {
            action : 'send',
            uid : <?= isset($_SESSION['id']) ? $_SESSION['id'] : '0'; ?>,
            title : document.getElementById('feedback-title').value,
            description : document.getElementById('prod-meta-editor').getElementsByClassName('ql-editor')[0].innerHTML,
            type : document.getElementById('feedback-type').value,
            attachment : []
        };

        console.log(miniArr);

        var attachment_items = document.getElementsByClassName('miniature-input');

        for (let i = 0; i < attachment_items.length; i++) {
            feedbackObject.attachment.push(attachment_items[i].files[0]);
        }

        feedbackData.append('feedback', JSON.stringify(feedbackObject));
        const ajaxObject = {
            url : '/assets/php/classes/class.Feedbacks.php',
            data : feedbackData,
            loaderContainer : {
                isset : true,
                id : 'send-review',
                type : 'button',
                iconSize : {
                    iconWidth : '19.2',
                    iconHeight : '19.2'
                },
                iconColor : {
                    isset : true,
                    color : 'currentColor'
                },
                loaderText : {
                    custom : true,
                    customText : 'Elküldés'
                }
            }
        };

        let response = getFromAjaxValidate(ajaxObject, 'feedback')
        .then((data) => {
            if (data.length > 0) { for (let i = 0; i < data.length; i++) { document.getElementById('feedback-error-' + data[i]).innerHTML = `<span class="small-med text-danger">Ez a mező kitöltése kötelező!</span>`; } }
            else {

                console.log(ajaxObject.data.get('feedback'));

                let response = getFromAjaxRequest(ajaxObject)
                .then((data) => {
                    console.log(data);
                })
                .catch((reason) => {
                    console.log(reason);
                });
            }
        })
        .catch((reason) => {
            console.log(reason);
        });

    });

    function __inituploader () { var minIndex = document.getElementsByClassName('miniature-upload').length;  minActive++; minIndex++; 
        if (minIndex <= 5) {
            document.getElementById('miniatures-con').innerHTML += `
            <div id="miniature-upload-${minActive}" class="miniature-upload flex flex-row-d-col-m flex-align-c flex-justify-con-c border-soft background-bg background-bg-hover text-primary padding-1 user-select-none w-fc pointer miniature-fixed relative">
                <input type="file" id="miniature-input-${minActive}" class="hidden miniature-input">
                <div class="miniature-upload-inner flex flex-row-d-col-m flex-align-c gap-1" onclick="__minupload(${minActive})">
                    <div class="flex flex-row flex-align-c gap-1">
                        <div class="flex flex-col flex-align-c flex-justify-con-c">
                            <span id="min-icon-${minActive}"><svg width="48" height="48" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path opacity="0.3" d="M19 22H5C4.4 22 4 21.6 4 21V3C4 2.4 4.4 2 5 2H14L20 8V21C20 21.6 19.6 22 19 22ZM14.5 12L12.7 9.3C12.3 8.9 11.7 8.9 11.3 9.3L10 12H11.5V17C11.5 17.6 11.4 18 12 18C12.6 18 12.5 17.6 12.5 17V12H14.5Z" fill="currentColor"/><path d="M13 11.5V17.9355C13 18.2742 12.6 19 12 19C11.4 19 11 18.2742 11 17.9355V11.5H13Z" fill="currentColor"/><path d="M8.2575 11.4411C7.82942 11.8015 8.08434 12.5 8.64398 12.5H15.356C15.9157 12.5 16.1706 11.8015 15.7425 11.4411L12.4375 8.65789C12.1875 8.44737 11.8125 8.44737 11.5625 8.65789L8.2575 11.4411Z" fill="currentColor"/><path d="M15 8H20L14 2V7C14 7.6 14.4 8 15 8Z" fill="currentColor"/></svg></span>
                            <span class="text-muted small-med w-fa text-align-c">Kép választása</span>
                        </div>
                    </div>
                </div>
                <div id="miniature-prop-con-${minActive}" class=" absolute"></div>
                <div style="top: -10%; right: -10%;" class="mini-action flex flex-align-c flex-justify-con-c padding-025 absolute item-bg circle text-muted link-color box-shadow-dark pointer" aria-label="Eltávolítás" title="Eltávolítás" role="button" data-active="${minActive}">
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M6.7 19.4L5.3 18C4.9 17.6 4.9 17 5.3 16.6L16.6 5.3C17 4.9 17.6 4.9 18 5.3L19.4 6.7C19.8 7.1 19.8 7.7 19.4 8.1L8.1 19.4C7.8 19.8 7.1 19.8 6.7 19.4Z" fill="currentColor"></path><path d="M19.5 18L18.1 19.4C17.7 19.8 17.1 19.8 16.7 19.4L5.40001 8.1C5.00001 7.7 5.00001 7.1 5.40001 6.7L6.80001 5.3C7.20001 4.9 7.80001 4.9 8.20001 5.3L19.5 16.6C19.9 16.9 19.9 17.6 19.5 18Z" fill="currentColor"></path></svg>
                </div>
            </div>
            `; var remBtn = document.getElementsByClassName('mini-action');
            for (let i = 0; i < remBtn.length; i++) { remBtn[i].setAttribute('onclick', '__removeminiature('+minIndex+', '+remBtn[i].getAttribute('data-active')+')'); }
        } if (minIndex == 5 || minIndex > 5) { document.getElementById('miniature-uploader').remove(); document.getElementById('miniatures-con').innerHTML += ``; }
    } function __minupload (e) {
        document.getElementById('miniature-input-'+e).addEventListener('click', () => {
            document.getElementById('min-icon-'+e).innerHTML = `<svg width="48" height="48" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path opacity="0.3" d="M19 22H5C4.4 22 4 21.6 4 21V3C4 2.4 4.4 2 5 2H14L20 8V21C20 21.6 19.6 22 19 22Z" fill="currentColor"/><g clip-path="url(#clip0_787_1289)"><path d="M9.56133 15.7161C9.72781 15.5251 9.5922 15.227 9.33885 15.227H8.58033C8.57539 15.1519 8.57262 15.0763 8.57262 15C8.57262 13.1101 10.1101 11.5726 12 11.5726C12.7576 11.5726 13.4585 11.8198 14.0265 12.2377C14.2106 12.3731 14.4732 12.3609 14.6216 12.1872L15.1671 11.5491C15.3072 11.3852 15.2931 11.1382 15.1235 11.005C14.2353 10.3077 13.1468 9.92944 12 9.92944C10.6456 9.92944 9.37229 10.4569 8.41458 11.4146C7.4569 12.3723 6.92945 13.6456 6.92945 15C6.92945 15.0759 6.93135 15.1516 6.93465 15.2269H6.29574C6.0424 15.2269 5.90677 15.5251 6.07326 15.7161L7.51455 17.3693L7.81729 17.7166L8.90421 16.4698L9.56133 15.7161Z" fill="currentColor"/><path d="M17.9268 14.7516L16.8518 13.5185L16.1828 12.7511L15.2276 13.8468L14.4388 14.7516C14.2723 14.9426 14.4079 15.2407 14.6612 15.2407H15.4189C15.2949 17.0187 13.809 18.4274 12.0001 18.4274C11.347 18.4274 10.736 18.2437 10.216 17.9253C10.0338 17.8138 9.79309 17.8362 9.6543 17.9985L9.10058 18.6463C8.95391 18.8179 8.97742 19.0782 9.16428 19.2048C9.99513 19.7678 10.9743 20.0706 12.0001 20.0706C13.3545 20.0706 14.6278 19.5432 15.5855 18.5855C16.4863 17.6847 17.0063 16.5047 17.0649 15.2407H17.7043C17.9577 15.2407 18.0933 14.9426 17.9268 14.7516Z" fill="currentColor"/></g><path d="M15 8H20L14 2V7C14 7.6 14.4 8 15 8Z" fill="currentColor"/><defs><clipPath id="clip0_787_1289"><rect width="12" height="12" fill="white" transform="translate(6 9)"/></clipPath></defs></svg>`;
            document.getElementById('miniature-input-'+e).addEventListener('change', () => { var minInput = document.getElementById('miniature-input-'+e);
                if (minInput.value.length > 0) { let validExtensions = ["image/jpeg", "image/jpg", "image/png"];
                    if (validExtensions.includes(minInput.files[0].type)) { var allMinInp = document.getElementsByClassName('miniature-input'); var duplicate = false;
                        if (miniArr.length > 0) { for (let i = 0; i < miniArr.length; i++) { if (miniArr[i].name == minInput.files[0].name && miniArr[i].type == minInput.files[0].type && miniArr[i].size == minInput.files[0].size) { duplicate = true; } }
                            if (duplicate == true) { document.getElementById('min-icon-'+e).innerHTML = `<svg width="48" height="48" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path opacity="0.3" d="M5 22H19C19.6 22 20 21.6 20 21V8L14 2H5C4.4 2 4 2.4 4 3V21C4 21.6 4.4 22 5 22Z" fill="currentColor"/><path d="M15 8H20L14 2V7C14 7.6 14.4 8 15 8Z" fill="currentColor"/><rect x="7.55518" y="16.7585" width="10.144" height="2" rx="1" transform="rotate(-45 7.55518 16.7585)" fill="currentColor"/><rect x="9.0174" y="9.60327" width="10.0952" height="2" rx="1" transform="rotate(45 9.0174 9.60327)" fill="currentColor"/></svg>`; document.getElementById('miniature-upload-'+e).getElementsByClassName('text-muted')[0].textContent = "Duplikáció"; }
                            else { miniArr.push(minInput.files[0]); __loadpreview(e); }
                        } else { miniArr.push(minInput.files[0]); __loadpreview(e); }
                    } else { document.getElementById('min-icon-'+e).innerHTML = `<svg width="48" height="48" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path opacity="0.3" d="M5 22H19C19.6 22 20 21.6 20 21V8L14 2H5C4.4 2 4 2.4 4 3V21C4 21.6 4.4 22 5 22Z" fill="currentColor"/><path d="M15 8H20L14 2V7C14 7.6 14.4 8 15 8Z" fill="currentColor"/><rect x="7.55518" y="16.7585" width="10.144" height="2" rx="1" transform="rotate(-45 7.55518 16.7585)" fill="currentColor"/><rect x="9.0174" y="9.60327" width="10.0952" height="2" rx="1" transform="rotate(45 9.0174 9.60327)" fill="currentColor"/></svg>`; document.getElementById('miniature-upload-'+e).getElementsByClassName('text-muted')[0].textContent = "Hibás feltöltés"; }
                }
            });
        }); document.getElementById('miniature-input-'+e).click();
    } function __loadpreview (e) { let fileReader = new FileReader(); var minInput = document.getElementById('miniature-input-'+e);
        fileReader.onload = () => { let fileURL = fileReader.result; document.getElementById('miniature-upload-'+e).getElementsByClassName('miniature-upload-inner')[0].innerHTML = ``;
            document.getElementById('miniature-upload-'+e).style.background = 'url('+fileURL+')';
             document.getElementById('miniature-upload-'+e).addEventListener('mouseleave', () => { document.getElementById('miniature-prop-con-'+e).classList = 'absolute'; document.getElementById('miniature-prop-con-'+e).innerHTML =``; });
        }; fileReader.readAsDataURL(minInput.files[0]);
    } function __removeminiature (index, e) { miniArr.splice(e-1, 1); index--; var remBtn = document.getElementsByClassName('mini-action');
        for (let i = 0; i < remBtn.length; i++) {
            remBtn[i].setAttribute('onclick', '__removeminiature('+index+', '+remBtn[i].getAttribute('data-active')+')');
        }
        document.getElementById('miniature-upload-'+e).remove();
        if (index < 5) { // Hozzaadas gomb megjelenitese
            document.getElementById('min-upl-con').innerHTML = `
            <div id="miniature-uploader" class="flex flex-row-d-col-m flex-align-c flex-justify-con-c border-soft border-secondary-dotted background-bg background-bg-hover text-primary padding-1 user-select-none w-fc pointer miniature-fixed" onclick="__inituploader()">
                <div class="flex flex-row-d-col-m flex-align-c gap-1">
                    <div class="flex flex-row flex-align-c gap-1">
                        <div class="flex flex-col flex-align-c flex-justify-con-c">
                            <svg width="48" height="48" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M3 13V11C3 10.4 3.4 10 4 10H20C20.6 10 21 10.4 21 11V13C21 13.6 20.6 14 20 14H4C3.4 14 3 13.6 3 13Z" fill="currentColor"/><path d="M13 21H11C10.4 21 10 20.6 10 20V4C10 3.4 10.4 3 11 3H13C13.6 3 14 3.4 14 4V20C14 20.6 13.6 21 13 21Z" fill="currentColor"/></svg>
                            <span class="text-muted small-med w-fa text-align-c">Hozzáadás</span>
                        </div>
                    </div>
                </div>
            </div>
            `;
        }
    }
</script>