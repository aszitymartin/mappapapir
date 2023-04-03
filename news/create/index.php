<?php
require_once($_SERVER['DOCUMENT_ROOT'].'/includes/inc.php'); require_once($_SERVER['DOCUMENT_ROOT'].'/includes/header.php'); include($_SERVER['DOCUMENT_ROOT'].'/assets/alph.php'); $uid = $_SESSION['id']; $stmt = $con->prepare('SELECT privilege FROM customers__priv  WHERE uid = ?'); if (isset($_SESSION['loggedin'])) {$id = $_SESSION['id'];} $stmt->bind_param('i', $id);$stmt->execute(); $stmt->bind_result($privilege); $stmt->fetch();$stmt->close();
if ($privilege < 1) { echo '<script>window.location.href = "/"</script>'; header('Location: /'); die(); exit(); }
?>
<script src="/assets/script/quill/dist/quill.js"></script><script src="/assets/script/tagify/dist/tagify.js"></script>

<main id="main">
    <div class="flex flex-col flex-align-c gap-2 w-fa">
        <form class="w-fa" action="" method="post" enctype="multipart/form-data">
            <div class="flex flex-col w-fa gap-2 border-soft item-bg box-shadow padding-1">
                <div class="flex flex-row flex-align-c flex-justify-con-sb">
                    <span class="text-primary larger bold">Hír létrehozása</span>
                    <span id="news-create" class="flex flex-row flex-align-c flex-justify-con-c w-fc gap-05 primary-bg primary-bg-hover border-soft padding-05 user-select-none pointer small-med bold">
                        <span class="flex flex-col flex-align-c flex-justify-con-c">Létrehozás</span>
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M12.6343 12.5657L8.45001 16.75C8.0358 17.1642 8.0358 17.8358 8.45001 18.25C8.86423 18.6642 9.5358 18.6642 9.95001 18.25L15.4929 12.7071C15.8834 12.3166 15.8834 11.6834 15.4929 11.2929L9.95001 5.75C9.5358 5.33579 8.86423 5.33579 8.45001 5.75C8.0358 6.16421 8.0358 6.83579 8.45001 7.25L12.6343 11.4343C12.9467 11.7467 12.9467 12.2533 12.6343 12.5657Z" fill="currentColor"/></svg>
                    </span>
                </div>
                <div class="flex flex-col gap-05">
                    <span class="text-secondary small">Hír címe</span>
                    <input type="text" class="adm__input item-bg border-soft w-fa text-secondary outline-none small prd-ch-fr-er" id="news-title" name="news-title" placeholder="Adja meg a hír címét" required="">
                    <span class="text-muted small-med">Foglalja össze pár kulcsszóban a hír témáját</span>
                    <div class="flex flex-row flex-align-c flex-justify-con-fe w-fa feedback-error-con" id="news-error-title"></div>
                </div>
                <div class="flex flex-row-d-col-m gap-1">
                    <div class="flex flex-col w-fa gap-1">
                        <div class="flex flex-col gap-025">
                            <div class="flex flex-row flex-align-c gap-1">
                                <span class="text-secondary small">Kép csatolása</span>
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
                    <span class="text-secondary small">Hír rövid leírása</span>
                    <input name='news-brief-desc' type="text" id='news-brief-desc' class='adm__input w-fa border-soft cst-drp-fts prd-ch-fr-er outline-none' placeholder='Adja meg a hír leírását röviden'>
                    <span class="text-muted small-med">Ez a szöveg fog megjelenni a hír főcíme alatt.</span>
                    <div class="flex flex-row flex-align-c flex-justify-con-fe w-fa feedback-error-con" id="news-bief-desc-error-type"></div>
                </div>
            </div>
        </form>
        <div class="flex flex-row flex-align-c flex-justify-con-fs user-select-none text-muted w-fa gap-05">
            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path opacity="0.3" d="M22.1 11.5V12.6C22.1 13.2 21.7 13.6 21.2 13.7L19.9 13.9C19.7 14.7 19.4 15.5 18.9 16.2L19.7 17.2999C20 17.6999 20 18.3999 19.6 18.7999L18.8 19.6C18.4 20 17.8 20 17.3 19.7L16.2 18.9C15.5 19.3 14.7 19.7 13.9 19.9L13.7 21.2C13.6 21.7 13.1 22.1 12.6 22.1H11.5C10.9 22.1 10.5 21.7 10.4 21.2L10.2 19.9C9.4 19.7 8.6 19.4 7.9 18.9L6.8 19.7C6.4 20 5.7 20 5.3 19.6L4.5 18.7999C4.1 18.3999 4.1 17.7999 4.4 17.2999L5.2 16.2C4.8 15.5 4.4 14.7 4.2 13.9L2.9 13.7C2.4 13.6 2 13.1 2 12.6V11.5C2 10.9 2.4 10.5 2.9 10.4L4.2 10.2C4.4 9.39995 4.7 8.60002 5.2 7.90002L4.4 6.79993C4.1 6.39993 4.1 5.69993 4.5 5.29993L5.3 4.5C5.7 4.1 6.3 4.10002 6.8 4.40002L7.9 5.19995C8.6 4.79995 9.4 4.39995 10.2 4.19995L10.4 2.90002C10.5 2.40002 11 2 11.5 2H12.6C13.2 2 13.6 2.40002 13.7 2.90002L13.9 4.19995C14.7 4.39995 15.5 4.69995 16.2 5.19995L17.3 4.40002C17.7 4.10002 18.4 4.1 18.8 4.5L19.6 5.29993C20 5.69993 20 6.29993 19.7 6.79993L18.9 7.90002C19.3 8.60002 19.7 9.39995 19.9 10.2L21.2 10.4C21.7 10.5 22.1 11 22.1 11.5ZM12.1 8.59998C10.2 8.59998 8.6 10.2 8.6 12.1C8.6 14 10.2 15.6 12.1 15.6C14 15.6 15.6 14 15.6 12.1C15.6 10.2 14 8.59998 12.1 8.59998Z" fill="currentColor"/><path d="M17.1 12.1C17.1 14.9 14.9 17.1 12.1 17.1C9.30001 17.1 7.10001 14.9 7.10001 12.1C7.10001 9.29998 9.30001 7.09998 12.1 7.09998C14.9 7.09998 17.1 9.29998 17.1 12.1ZM12.1 10.1C11 10.1 10.1 11 10.1 12.1C10.1 13.2 11 14.1 12.1 14.1C13.2 14.1 14.1 13.2 14.1 12.1C14.1 11 13.2 10.1 12.1 10.1Z" fill="currentColor"/></svg>
            <span>Beállítások</span>
        </div>
        <div class="flex flex-col w-fa gap-2 border-soft item-bg box-shadow padding-1">
            <div class="flex flex-col">
                <div class="flex flex-row flex-align-c gap-1">
                    <label class="cst-chb-lbl">
                        <input type="checkbox" class="absolute" name="news-config-body" id="news-config-body">
                        <span class="cst-checkbox"></span>
                    </label>
                    <span class="text-secondary small" style="line-height: 2rem;">Hír törzse</span>
                </div>
                <span class="text-muted small-med">Amennyiben a hírnek van törse, jelölje be ezt az opciót</span>
            </div>
            <div class="hidden flex-col gap-05" id="news-body-con">
                <span class="text-secondary small">Hír törzse</span>
                <div class="flex flex-col">
                    <div id="news-body-editor" class="border-soft prd-ch-fr-er-ce" style="height: 32rem;"></div>
                </div>
                <script>var quill = new Quill('#news-body-editor', { modules: { toolbar: false }, placeholder: 'Ide írja a hír törzsét...', theme: 'snow' });</script>
                <span class="text-muted small-med">Ebben a mezőben részletesen fejtse ki véleményét, észrevételeit.</span>
                <div class="flex flex-row flex-align-c flex-justify-con-fe w-fa feedback-error-con" id="news-error-body"></div>
            </div>
        </div>
        <div class="flex flex-col w-fa gap-2 border-soft item-bg box-shadow padding-1">
            <div class="flex flex-col">
                <div class="flex flex-row flex-align-c gap-1">
                    <label class="cst-chb-lbl">
                        <input type="checkbox" class="absolute" name="news-config-related" id="news-config-related">
                        <span class="cst-checkbox"></span>
                    </label>
                    <span class="text-secondary small" style="line-height: 2rem;">Kapcsolódó termékek</span>
                </div>
                <span class="text-muted small-med">Amennyiben a hírben termékeket jelenít meg, jelölje be ezt az opciót, hogy a hasonló termékeket ajánlani tudjuk.</span>
            </div>
        </div>
    </div>
</main>

<script>
    var minActive = 0; var miniArr = [];
    $('#news-create').click(() => {

        var newsData = new FormData(); 
        $.ajax({url: "https://api.ipdata.co?api-key=739837e232548988c86b954108794b57bd3e1dbcd6eb550bfa53e544", dataType: 'json',
            success : function (api) {

                newsData.append('title', document.getElementById('news-title').value);
                newsData.append('image', miniArr[0]);
                newsData.append('desc', document.getElementById('news-brief-desc').value);
                newsData.append("ip", api.ip);
                const ajaxObject = {
                    url : '/assets/php/classes/class.Feedbacks.php',
                    data : newsData,
                    loaderContainer : {
                        isset : true,
                        id : 'send-feedback',
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
                        let response = getFromAjaxRequest(ajaxObject)
                        .then((data) => {
                            if (data.status == 'success') {
                                var attachment_data = new FormData();
                                for (let i = 0; i < miniArr.length; i++) { attachment_data.append('atch'+(i+1), miniArr[i]); }
                                attachment_data.append('fid', data.data.fid); attachment_data.append('uid', <?= $_SESSION['id']; ?>);
                                attachment_data.append('message', feedbackObject.description);
                                $.ajax({ enctype: "multipart/form-data", type: "POST", url: "/assets/php/classes/class.Feedbacks.php", data: attachment_data, dataType: 'json', contentType: false, processData: false,
                                    success : function (s) {
                                        if (s.status == 'success') {
                                            $('#send-feedback').off('click');
                                            notificationSystem(0, 0, 0, 'Üzenet', 'Visszajelzés sikeresen elküldve.');
                                            showPanel(0, 'tab-overview');
                                        }
                                    }, error : function (e) { notificationSystem(1, 0, 0, 'Üzenet', 'Hiba történt a folyamat közben.'); }
                                });
                            }
                        }).catch((reason) => { notificationSystem(1, 0, 0, 'Üzenet', 'Hiba történt a folyamat közben.'); });
                    }
                }).catch((reason) => { notificationSystem(1, 0, 0, 'Üzenet', 'Hiba történt a folyamat közben.'); });

            }, error : function (e) { notificationSystem(1, 0, 0, 'Üzenet', 'Nem tudtunk kapcsolódni a kiszolgáltatóhoz.'); }
        });

    });

    $('#news-config-body').click(() => {
        if (document.getElementById('news-config-body').checked) {
            document.getElementById('news-body-con').classList.replace('hidden', 'flex');
        } else {
            document.getElementById('news-body-con').classList.replace('flex', 'hidden');
        }
    });

    function __inituploader () { var minIndex = document.getElementsByClassName('miniature-upload').length;  minActive++; minIndex++; 
        if (minIndex <= 1) {
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
        } if (minIndex == 1 || minIndex > 1) { document.getElementById('miniature-uploader').remove(); document.getElementById('miniatures-con').innerHTML += ``; }
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
<?php require_once($_SERVER['DOCUMENT_ROOT'].'/includes/footer.php'); ?>