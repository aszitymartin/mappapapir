<?php require_once($_SERVER['DOCUMENT_ROOT'].'/includes/header.php'); if (!isset($_SESSION['loggedin'])) { echo "<script>window.location.href='/';</script>"; die(); }
    $stmt = $con->prepare('SELECT privilege FROM customers__priv  WHERE uid = ?'); if (isset($_SESSION['loggedin'])) {$id = $_SESSION['id'];} $stmt->bind_param('i', $id);$stmt->execute(); $stmt->bind_result($privilege); $stmt->fetch();$stmt->close();
    if (isset($params['id'])) {

        $feedbackStmt = $con->prepare('SELECT uid, status, title FROM feedbacks WHERE id = ?'); $feedbackStmt->bind_param('i', $params['id']);$feedbackStmt->execute();
        $feedbackStmt->bind_result($fuid, $fstatus, $ftitle); $feedbackStmt->fetch();$feedbackStmt->close();
        if (!$fuid) { echo "<script>window.location.href='/404';</script>"; }
        else {
            if ($privilege < 1) {
                if ($_SESSION['id'] != $fuid) { echo "<script>window.location.href='/';</script>"; }
            }
        }
    } else { echo "<script>window.location.href='/';</script>"; die(); }
?>
<script src="/assets/script/quill/dist/quill.js"></script><script src="/assets/script/tagify/dist/tagify.js"></script>
<main>
    <?php            
        $query = explode('&', $_SERVER['QUERY_STRING']); $queryVal; $queryFound = false;
        for ($i = 0; $i < count($query); $i++) { if (explode('=', $query[$i])[0] == 'f') { $queryVal = explode('=', $query[$i])[1]; $queryFound = true; } }
        if ($queryFound == true) {
            switch ($queryVal) {
                case 'a':
                    if ($privilege > 0) { echo '<div class="flex flex-row flex-align-c padding-1 padding-l-0 padding-b-0" id="breadcrumbs-con"><span class="text-muted small-med"><a class="link link-color pointer" href="/admin/">Admin</a> / <a class="link link-color pointer" href="/admin/?tab=feedbacks">Visszajelzések</a> / '. $ftitle .'</span></div>'; }
                    else { echo '<div class="flex flex-row flex-align-c padding-1 padding-l-0 padding-b-0" id="breadcrumbs-con"><span class="text-muted small-med"><a class="link link-color pointer" href="/feedback/">Visszajelzések</a> / '. $ftitle .'</span></div>'; }
                break;
                default : echo '<div class="flex flex-row flex-align-c padding-1 padding-l-0 padding-b-0" id="breadcrumbs-con"><span class="text-muted small-med"><a class="link link-color pointer" href="/feedback/">Visszajelzések</a> / '. $ftitle .'</span></div>'; break;
            }
        } else { echo '<div class="flex flex-row flex-align-c padding-1 padding-l-0 padding-b-0" id="breadcrumbs-con"><span class="text-muted small-med"><a class="link link-color pointer" href="/feedback/">Visszajelzések</a> / '. $ftitle .'</span></div>'; }
    ?>
    <div class="prod-con" id="tabs">
        <div class="leftcolumn">
            <div class="flex flex-row flex-align-c flex-justify-con-sb gap-1 w-fa padding-t-1">
                <div class="flex flex-row flex-align-c gap-1 text-primary">
                    <div class="flex flex-col flex-align-c flex-justify-con-c padding-025 border-soft-light background-bg background-bg-hover pointer has-tooltip relative" aria-describedby="tooltip-reload" onclick="loadMessages(<?= $params['id']; ?>);">
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M14.5 20.7259C14.6 21.2259 14.2 21.826 13.7 21.926C13.2 22.026 12.6 22.0259 12.1 22.0259C9.5 22.0259 6.9 21.0259 5 19.1259C1.4 15.5259 1.09998 9.72592 4.29998 5.82592L5.70001 7.22595C3.30001 10.3259 3.59999 14.8259 6.39999 17.7259C8.19999 19.5259 10.8 20.426 13.4 19.926C13.9 19.826 14.4 20.2259 14.5 20.7259ZM18.4 16.8259L19.8 18.2259C22.9 14.3259 22.7 8.52593 19 4.92593C16.7 2.62593 13.5 1.62594 10.3 2.12594C9.79998 2.22594 9.4 2.72595 9.5 3.22595C9.6 3.72595 10.1 4.12594 10.6 4.02594C13.1 3.62594 15.7 4.42595 17.6 6.22595C20.5 9.22595 20.7 13.7259 18.4 16.8259Z" fill="currentColor"></path><path opacity="0.3" d="M2 3.62592H7C7.6 3.62592 8 4.02592 8 4.62592V9.62589L2 3.62592ZM16 14.4259V19.4259C16 20.0259 16.4 20.4259 17 20.4259H22L16 14.4259Z" fill="currentColor"></path></svg>
                        <span class="tooltip absolute" id="tooltip-reload"><span key="tooltip-reload">Frissítés</span></span>
                    </div>
                    <div class="flex flex-col flex-align-c flex-justify-con-c padding-025 border-soft-light background-bg background-bg-hover pointer has-tooltip relative" aria-describedby="tooltip-archive">
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path opacity="0.3" d="M10 4H21C21.6 4 22 4.4 22 5V7H10V4Z" fill="currentColor"></path><path d="M9.2 3H3C2.4 3 2 3.4 2 4V19C2 19.6 2.4 20 3 20H21C21.6 20 22 19.6 22 19V7C22 6.4 21.6 6 21 6H12L10.4 3.60001C10.2 3.20001 9.7 3 9.2 3Z" fill="currentColor"></path></svg>
                        <span class="tooltip absolute" id="tooltip-archive"><span key="tooltip-archive">Archiválás</span></span>
                    </div>
                    <?php if ($fstatus != 2) : ?>
                        <div id="delete-feedback" class="flex flex-col flex-align-c flex-justify-con-c padding-025 border-soft-light background-bg background-bg-hover pointer has-tooltip relative" aria-describedby="tooltip-delete">
                            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M5 9C5 8.44772 5.44772 8 6 8H18C18.5523 8 19 8.44772 19 9V18C19 19.6569 17.6569 21 16 21H8C6.34315 21 5 19.6569 5 18V9Z" fill="currentColor"></path><path opacity="0.5" d="M5 5C5 4.44772 5.44772 4 6 4H18C18.5523 4 19 4.44772 19 5V5C19 5.55228 18.5523 6 18 6H6C5.44772 6 5 5.55228 5 5V5Z" fill="currentColor"></path><path opacity="0.5" d="M9 4C9 3.44772 9.44772 3 10 3H14C14.5523 3 15 3.44772 15 4V4H9V4Z" fill="currentColor"></path></svg>
                            <span class="tooltip absolute" id="tooltip-delete"><span key="tooltip-delete">Törlés</span></span>
                        </div>
                    <?php endif; ?>
                </div>
                <?php if ($_SESSION['id'] == $fuid) : ?>
                    <a href="/feedback/?tab=new" class="flex flex-row flex-align-c flex-justify-con-c w-fc gap-05 primary-bg primary-bg-hover border-soft padding-05 user-select-none pointer small-med bold">
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path opacity="0.3" d="M21.4 8.35303L19.241 10.511L13.485 4.755L15.643 2.59595C16.0248 2.21423 16.5426 1.99988 17.0825 1.99988C17.6224 1.99988 18.1402 2.21423 18.522 2.59595L21.4 5.474C21.7817 5.85581 21.9962 6.37355 21.9962 6.91345C21.9962 7.45335 21.7817 7.97122 21.4 8.35303ZM3.68699 21.932L9.88699 19.865L4.13099 14.109L2.06399 20.309C1.98815 20.5354 1.97703 20.7787 2.03189 21.0111C2.08674 21.2436 2.2054 21.4561 2.37449 21.6248C2.54359 21.7934 2.75641 21.9115 2.989 21.9658C3.22158 22.0201 3.4647 22.0084 3.69099 21.932H3.68699Z" fill="currentColor"></path><path d="M5.574 21.3L3.692 21.928C3.46591 22.0032 3.22334 22.0141 2.99144 21.9594C2.75954 21.9046 2.54744 21.7864 2.3789 21.6179C2.21036 21.4495 2.09202 21.2375 2.03711 21.0056C1.9822 20.7737 1.99289 20.5312 2.06799 20.3051L2.696 18.422L5.574 21.3ZM4.13499 14.105L9.891 19.861L19.245 10.507L13.489 4.75098L4.13499 14.105Z" fill="currentColor"></path></svg>
                        <span class="flex flex-col flex-align-c flex-justify-con-c">Visszajelzés írása</span>
                    </a>
                <?php else :  ?>
                    <span id="manage-feedback" class="flex flex-row flex-align-c flex-justify-con-c w-fc gap-05 primary-bg primary-bg-hover border-soft padding-05 user-select-none pointer small-med bold">
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path opacity="0.3" d="M22.1 11.5V12.6C22.1 13.2 21.7 13.6 21.2 13.7L19.9 13.9C19.7 14.7 19.4 15.5 18.9 16.2L19.7 17.2999C20 17.6999 20 18.3999 19.6 18.7999L18.8 19.6C18.4 20 17.8 20 17.3 19.7L16.2 18.9C15.5 19.3 14.7 19.7 13.9 19.9L13.7 21.2C13.6 21.7 13.1 22.1 12.6 22.1H11.5C10.9 22.1 10.5 21.7 10.4 21.2L10.2 19.9C9.4 19.7 8.6 19.4 7.9 18.9L6.8 19.7C6.4 20 5.7 20 5.3 19.6L4.5 18.7999C4.1 18.3999 4.1 17.7999 4.4 17.2999L5.2 16.2C4.8 15.5 4.4 14.7 4.2 13.9L2.9 13.7C2.4 13.6 2 13.1 2 12.6V11.5C2 10.9 2.4 10.5 2.9 10.4L4.2 10.2C4.4 9.39995 4.7 8.60002 5.2 7.90002L4.4 6.79993C4.1 6.39993 4.1 5.69993 4.5 5.29993L5.3 4.5C5.7 4.1 6.3 4.10002 6.8 4.40002L7.9 5.19995C8.6 4.79995 9.4 4.39995 10.2 4.19995L10.4 2.90002C10.5 2.40002 11 2 11.5 2H12.6C13.2 2 13.6 2.40002 13.7 2.90002L13.9 4.19995C14.7 4.39995 15.5 4.69995 16.2 5.19995L17.3 4.40002C17.7 4.10002 18.4 4.1 18.8 4.5L19.6 5.29993C20 5.69993 20 6.29993 19.7 6.79993L18.9 7.90002C19.3 8.60002 19.7 9.39995 19.9 10.2L21.2 10.4C21.7 10.5 22.1 11 22.1 11.5ZM12.1 8.59998C10.2 8.59998 8.6 10.2 8.6 12.1C8.6 14 10.2 15.6 12.1 15.6C14 15.6 15.6 14 15.6 12.1C15.6 10.2 14 8.59998 12.1 8.59998Z" fill="currentColor"/><path d="M17.1 12.1C17.1 14.9 14.9 17.1 12.1 17.1C9.30001 17.1 7.10001 14.9 7.10001 12.1C7.10001 9.29998 9.30001 7.09998 12.1 7.09998C14.9 7.09998 17.1 9.29998 17.1 12.1ZM12.1 10.1C11 10.1 10.1 11 10.1 12.1C10.1 13.2 11 14.1 12.1 14.1C13.2 14.1 14.1 13.2 14.1 12.1C14.1 11 13.2 10.1 12.1 10.1Z" fill="currentColor"/></svg>
                        <span class="flex flex-col flex-align-c flex-justify-con-c">Kezelés</span>
                    </span>
                <?php endif; ?>
            </div>
            <div class="flex flex-col gap-1 card border-soft box-shadow">
                <div class="flex flex-col w-fa">
                    <span class="text-primary bold">Hasonló kérdések</span>
                    <hr style="border: 1px solid var(--background);" class="w-100">
                </div>
                <div class="flex flex-row w-fa">
                    <a class="text-primary small link pointer">Hasonlo kerdesek link...</a>
                </div>
                <div class="flex flex-row w-fa">
                    <a class="text-primary small link pointer">Hasonlo kerdesek link...</a>
                </div>
                <div class="flex flex-row w-fa">
                    <a class="text-primary small link pointer">Hasonlo kerdesek link...</a>
                </div>
                <div class="flex flex-row w-fa">
                    <a class="text-primary small link pointer">Hasonlo kerdesek link...</a>
                </div>
                <div class="flex flex-row w-fa">
                    <a class="text-primary small link pointer">Hasonlo kerdesek link...</a>
                </div>
                <div class="flex flex-row w-fa">
                    <a class="text-primary small link pointer">Hasonlo kerdesek link...</a>
                </div>
            </div>
        </div>
        <div class="spancolumn">
            <div class="flex flex-col card w-fa border-soft box-shadow padding-1">
                <div class="flex flex-row w-fa">
                    <span class="text-primary bold"><?= $ftitle; ?></span>
                </div><hr style="border: 1px solid var(--background);" class="w-100">
                <div class="flex flex-col gap-1 w-fa padding-1 feedback-message-con overflow-x-hidden" id="feedback-message-con"></div>
                <?php if ($fstatus != 2) : ?>
                    <div class="flex flex-col gap-05 padding-t-1">
                        <div class="flex flex-col">
                            <div id="feedback-reply-editor" class="border-soft prd-ch-fr-er-ce" style="height: 4rem;"></div>
                        </div>
                        <script>
                            var quill = new Quill('#feedback-reply-editor', {
                                modules: { toolbar: false }, placeholder: 'Szöveg írása...', theme: 'snow'
                            });
                        </script>
                        <div class="flex flex-row flex-align-c flex-justify-con-sb w-fa">
                            <div class="flex flex-row flex-align-c w-fa gap-1 padding-0-1">
                                <div class="flex flex-row flex-align-c gap-1 w-fa">
                                    <div class="flex flex-row gap-1" id="miniatures-con"></div>
                                    <div id="min-upl-con">
                                        <div id="miniature-uploader" class="flex flex-row-d-col-m flex-align-c flex-justify-con-c text-primary user-select-none w-fc pointer has-tooltip relative" aria-describedby="tooltip-add-image" onclick="__inituploader()">
                                            <div class="flex flex-row-d-col-m flex-align-c gap-1">
                                                <div class="flex flex-row flex-align-c gap-1">
                                                    <div class="flex flex-col flex-align-c flex-justify-con-c">
                                                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path opacity="0.3" d="M22 5V19C22 19.6 21.6 20 21 20H19.5L11.9 12.4C11.5 12 10.9 12 10.5 12.4L3 20C2.5 20 2 19.5 2 19V5C2 4.4 2.4 4 3 4H21C21.6 4 22 4.4 22 5ZM7.5 7C6.7 7 6 7.7 6 8.5C6 9.3 6.7 10 7.5 10C8.3 10 9 9.3 9 8.5C9 7.7 8.3 7 7.5 7Z" fill="currentColor"/><path d="M19.1 10C18.7 9.60001 18.1 9.60001 17.7 10L10.7 17H2V19C2 19.6 2.4 20 3 20H21C21.6 20 22 19.6 22 19V12.9L19.1 10Z" fill="currentColor"/></svg>
                                                    </div>
                                                </div>
                                            </div>
                                            <span class="tooltip absolute" id="tooltip-add-image"><span key="tooltip-add-image">Kép csatolása</span></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <span id="send-feedback-reply" class="flex flex-row flex-align-c flex-justify-con-c w-fc gap-05 primary-bg primary-bg-hover border-soft padding-05 user-select-none pointer small-med bold">
                                <span class="flex flex-col flex-align-c flex-justify-con-c">Elküldés</span>
                                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M12.6343 12.5657L8.45001 16.75C8.0358 17.1642 8.0358 17.8358 8.45001 18.25C8.86423 18.6642 9.5358 18.6642 9.95001 18.25L15.4929 12.7071C15.8834 12.3166 15.8834 11.6834 15.4929 11.2929L9.95001 5.75C9.5358 5.33579 8.86423 5.33579 8.45001 5.75C8.0358 6.16421 8.0358 6.83579 8.45001 7.25L12.6343 11.4343C12.9467 11.7467 12.9467 12.2533 12.6343 12.5657Z" fill="currentColor"></path></svg>
                            </span>
                        </div>
                    </div>
                <?php endif; if ($fstatus == 2) : ?>
                    <div class="flex flex-row flex-align-c flex-justify-con-c w-fa small-med text-muted user-select-none padding-t-1">
                        <span>Lezárt visszajelzéshez már nem tud több üzenetet küldeni.</span>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</main>
<script>
    function loadMessages (fid) {

        var feedbackData = new FormData(); 
        const feedbackObject = {
            action : 'showMessage',
            fid    : fid
        };
        feedbackData.append('feedback', JSON.stringify(feedbackObject));
        const ajaxObject = {
            url : '/assets/php/classes/class.Feedbacks.php',
            data : feedbackData,
            loaderContainer : {
                isset : true,
                id : 'feedback-message-con',
                type : 'panel',
                iconSize : {
                    iconWidth : '128',
                    iconHeight : '128'
                },
                iconColor : {
                    isset : false,
                    color : 'currentColor'
                },
                loaderText : {
                    custom : true,
                    customText : 'Üzenetek megjelenítése folyamatban...'
                }
            }
        };

        let response = getFromAjaxRequest(ajaxObject)
        .then((data) => {
            if (data.status == 'success') {
                document.getElementById('feedback-message-con').innerHTML = ``;
                for (let i = 0; i < data.data.length; i++) { var diff = 0;
                    if (i > 0) { var sentDate = new Date(data.data[i-1].fsent); var replyDate = new Date(data.data[i].fsent); diff = (replyDate - sentDate) * 1.66667E-5; }
                    if (diff >= 10) {
                        const month = ["Jan.","Feb.","Márc.","Ápr.","Máj.","Jún.","Júl.","Aug.","Szep.","Okt.","Nov.","Dec."]; const weekday = ["Vasárnap","Hétfő","Kedd","Szerda","Csütörtök","Péntek","Szombat"];
                        document.getElementById('feedback-message-con').innerHTML += `
                            <span class="flex flex-row flex-align-c flex-justify-con-c w-fa text-muted smaller user-select-none">
                                ${
                                    replyDate.getFullYear() == new Date().getFullYear()
                                    ? (
                                        replyDate.getMonth() == new Date().getMonth()
                                        ? (
                                            replyDate.getDate() == new Date().getDate()
                                            ? 'Ma, ' + ((replyDate.getHours() < 10) ? '0' + replyDate.getHours() : replyDate.getHours()) + ':' + ((replyDate.getMinutes() < 10) ? '0' + replyDate.getMinutes() : replyDate.getMinutes())
                                            : (
                                                new Date().getDate() - replyDate.getDate() == 1
                                                ? 'Tegnap, ' + ((replyDate.getHours() < 10) ? '0' + replyDate.getHours() : replyDate.getHours()) + ':' + ((replyDate.getMinutes() < 10) ? '0' + replyDate.getMinutes() : replyDate.getMinutes())
                                                : weekday[replyDate.getDay()] + ',' + ((replyDate.getHours() < 10) ? '0' + replyDate.getHours() : replyDate.getHours()) + ':' + ((replyDate.getMinutes() < 10) ? '0' + replyDate.getMinutes() : replyDate.getMinutes())
                                            )
                                        ) : month[replyDate.getMonth()] + ' ' + replyDate.getDate() + ', ' + ((replyDate.getHours() < 10) ? '0' + replyDate.getHours() : replyDate.getHours()) + ':' + ((replyDate.getMinutes() < 10) ? '0' + replyDate.getMinutes() : replyDate.getMinutes())
                                    ) : replyDate.getFullYear() + ' ' + month[replyDate.getMonth()] + ' ' + replyDate.getDate() + ', ' + ((replyDate.getHours() < 10) ? '0' + replyDate.getHours() : replyDate.getHours()) + ':' + ((replyDate.getMinutes() < 10) ? '0' + replyDate.getMinutes() : replyDate.getMinutes())
                                }
                            </span>
                        `;
                    }

                    if (data.data[i].ftype == 1) {
                        if (data.data[i].fmessage.length > 0) {
                            document.getElementById('feedback-message-con').innerHTML += `
                            <div class="flex flex-row flex-justify-con-fe gap-05 w-fa">
                                <div class="flex flex-row flex-justify-con-fe w-fa small">
                                    <div class="flex flex-row flex-align-fe flex-justify-con-fe w-fc padding-1 border-soft feedback-chat-item-user has-tooltip relative" aria-describedby="tooltip-feedback-item-${data.data[i].frid}">
                                        <span>${data.data[i].fmessage}</span>
                                        <span class="tooltip absolute" id="tooltip-feedback-item-${data.data[i].frid}"><span key="tooltip-feedback-item-${data.data[i].frid}" key="tooltip-feedback-item-${data.data[i].frid}">${data.data[i].fsent}</span></span>
                                    </div>
                                </div>
                                <div class="flex flex-row flex-align-fe">
                                    <span class="flex flex-row flex-align-c flex-justify-con-c bold text-white box-shadow curron__head circle padding-05 small-med" title="${data.data[i].sender.fullname}" style="background-color: #${data.data[i].sender.color}">${data.data[i].sender.initials}</span>
                                </div>
                            </div>
                            `;
                        }
                        if (data.data[i].fattachment.length > 0) {
                            if (data.data[i].fattachment.split(';').length > 1) {
                                document.getElementById('feedback-message-con').innerHTML += `
                                    <div class="flex flex-row flex-justify-con-fe gap-05 w-fa">
                                        <div class="flex flex-row flex-align-c flex-justify-con-fe flex-wrap w-fa gap-1" id="feedback-chat-imagegroup-${data.data[i].frid}"></div>
                                        <div class="flex flex-row flex-align-fe">
                                            <span class="flex flex-row flex-align-c flex-justify-con-c bold text-white box-shadow curron__head circle padding-05 small-med" title="${data.data[i].sender.fullname}" style="background-color: #${data.data[i].sender.color}">${data.data[i].sender.initials}</span>
                                        </div>        
                                    </div>
                                `;
                                for (let j = 0; j < data.data[i].fattachment.split(';').length; j++) {
                                    document.getElementById('feedback-chat-imagegroup-' + data.data[i].frid).innerHTML += `
                                        <img loading="lazy" class="flex feedback-chat-img feedback-chat-img-user pointer user-select-none border-soft drop-shadow" alt="${data.data[i].fattachment.split(';')[j]}" title="${data.data[i].fattachment.split(';')[j]}" src="/assets/images/feedbacks/${data.data[i].fattachment.split(';')[j]}" onError="chatBrokenImage(this)" onclick="openImage(this)" />
                                    `;
                                }
                            } else {
                                document.getElementById('feedback-message-con').innerHTML += `
                                <div class="flex flex-row flex-justify-con-fe gap-05 w-fa">
                                    <div class="flex flex-row flex-justify-con-fe w-fa small">
                                        <img loading="lazy" class="flex feedback-chat-img feedback-chat-img-user pointer user-select-none border-soft drop-shadow" alt="${data.data[i].fattachment.split(';')[j]}" title="${data.data[i].fattachment.split(';')[j]}" src="/assets/images/feedbacks/${data.data[i].fattachment}" onError="chatBrokenImage(this)" onclick="openImage(this)" />
                                    </div>
                                    <div class="flex flex-row flex-align-fe">
                                        <span class="flex flex-row flex-align-c flex-justify-con-c bold text-white box-shadow curron__head circle padding-05 small-med" title="${data.data[i].sender.fullname}" style="background-color: #${data.data[i].sender.color}">${data.data[i].sender.initials}</span>
                                    </div>
                                </div>
                                `;
                            }
                        }
                    } else {
                        if (data.data[i].fmessage.length > 0) {
                            document.getElementById('feedback-message-con').innerHTML += `
                            <div class="flex flex-row flex-justify-con-fs gap-05 w-fa">
                                <div class="flex flex-row flex-align-fs">
                                    <span class="flex flex-row flex-align-c flex-justify-con-c bold text-white box-shadow curron__head circle padding-05 small-med" title="${data.data[i].sender.fullname}" style="background-color: #${data.data[i].sender.color}">${data.data[i].sender.initials}</span>
                                </div>
                                <div class="flex flex-row flex-justify-con-fs w-fa small">
                                    <div class="flex flex-row flex-align-fs flex-justify-con-fs w-fc padding-1 border-soft feedback-chat-item-support has-tooltip relative" aria-describedby="tooltip-feedback-item-${data.data[i].frid}">
                                        <span>${data.data[i].fmessage}</span>
                                        <span class="tooltip absolute" id="tooltip-feedback-item-${data.data[i].frid}"><span key="tooltip-feedback-item-${data.data[i].frid}" key="tooltip-feedback-item-${data.data[i].frid}">${data.data[i].fsent}</span></span>
                                    </div>
                                </div>
                            </div>
                            `;
                        }
                        if (data.data[i].fattachment.length > 0) {
                            if (data.data[i].fattachment.split(';').length > 1) {
                                document.getElementById('feedback-message-con').innerHTML += `
                                    <div class="flex flex-row flex-justify-con-fs gap-05 w-fa">
                                        <div class="flex flex-row flex-align-fs">
                                            <span class="flex flex-row flex-align-c flex-justify-con-c bold text-white box-shadow curron__head circle padding-05 small-med" title="${data.data[i].sender.fullname}" style="background-color: #${data.data[i].sender.color}">${data.data[i].sender.initials}</span>
                                        </div>
                                        <div class="flex flex-row flex-align-c flex-justify-con-fs flex-wrap w-fa gap-1" id="feedback-chat-imagegroup-${data.data[i].frid}"></div>
                                    </div>
                                `;
                                for (let j = 0; j < data.data[i].fattachment.split(';').length; j++) {
                                    document.getElementById('feedback-chat-imagegroup-' + data.data[i].frid).innerHTML += `
                                        <img loading="lazy" class="flex feedback-chat-img pointer user-select-none border-soft drop-shadow" alt="${data.data[i].fattachment.split(';')[j]}" title="${data.data[i].fattachment.split(';')[j]}" src="/assets/images/feedbacks/${data.data[i].fattachment.split(';')[j]}" onError="chatBrokenImage(this)" onclick="openImage(this)" />
                                    `;
                                }
                            } else {
                                document.getElementById('feedback-message-con').innerHTML += `
                                <div class="flex flex-row flex-justify-con-fs gap-05 w-fa">
                                    <div class="flex flex-row flex-align-fs">
                                        <span class="flex flex-row flex-align-c flex-justify-con-c bold text-white box-shadow curron__head circle padding-05 small-med" title="${data.data[i].sender.fullname}" style="background-color: #${data.data[i].sender.color}">${data.data[i].sender.initials}</span>
                                    </div>
                                    <div class="flex flex-row flex-justify-con-fs w-fa small">
                                        <img loading="lazy" class="flex feedback-chat-img pointer user-select-none border-soft drop-shadow" alt="${data.data[i].fattachment.split(';')[j]}" title="${data.data[i].fattachment.split(';')[j]}" src="/assets/images/feedbacks/${data.data[i].fattachment}" onError="chatBrokenImage(this)" onclick="openImage(this)" />
                                    </div>
                                </div>
                                `;
                            }
                        }
                    }

                }
                document.getElementById('feedback-message-con').scrollTop = document.getElementById('feedback-message-con').scrollHeight - document.getElementById('feedback-message-con').clientHeight;
            }
        }) .catch((reason) => { console.log(reason); });

    } $(document).ready(() => { loadMessages(<?= $params['id']; ?>); });
    function chatBrokenImage (e) {
        if (e.parentElement) {
            e.parentElement.innerHTML = `
                <div class="flex flex-row flex-align-c flex-justify-con-fe w-fa gap-05 text-danger small-med">
                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><rect opacity="0.3" x="2" y="2" width="20" height="20" rx="10" fill="currentColor"/><rect x="11" y="14" width="7" height="2" rx="1" transform="rotate(-90 11 14)" fill="currentColor"/><rect x="11" y="17" width="2" height="2" rx="1" transform="rotate(-90 11 17)" fill="currentColor"/></svg>
                    <span>Kép betöltése sikertelen.</span>
                </div>
            `;
        }
    } function openImage (e) {

        $('html').css("overflow-y", "hidden");
        var ce__wrapper = document.createElement('div');
        ce__wrapper.classList = "wrapper_dark fadein z-index-100";
        document.body.append(ce__wrapper);

        ce__wrapper.innerHTML = `
            <div class="flex flex-col flex-align-c flex-justify-con-c gap-1 w-fa h-fa relative">
                <div class="flex flex-row flex-align-c flex-justify-con-fe absolute top-5 right-5 border-soft-light padding-1 pointer user-select-none" id="close-container" title="Bezárás">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path opacity="1" d="M6.7 19.4L5.3 18C4.9 17.6 4.9 17 5.3 16.6L16.6 5.3C17 4.9 17.6 4.9 18 5.3L19.4 6.7C19.8 7.1 19.8 7.7 19.4 8.1L8.1 19.4C7.8 19.8 7.1 19.8 6.7 19.4Z" fill="currentColor"/><path d="M19.5 18L18.1 19.4C17.7 19.8 17.1 19.8 16.7 19.4L5.40001 8.1C5.00001 7.7 5.00001 7.1 5.40001 6.7L6.80001 5.3C7.20001 4.9 7.80001 4.9 8.20001 5.3L19.5 16.6C19.9 16.9 19.9 17.6 19.5 18Z" fill="currentColor"/></svg>
                </div>
                <div style="overflow: auto; max-width: 100vw; max-height: 100vh;">
                    <img class="margin-a" src="${e.src}"/>
                </div>
            </div>
        `;

        document.getElementById('close-container').addEventListener('click', () => {
            closePanel();
        });

        function closePanel () {

            $('html').css("overflow-y", "auto");
            ce__wrapper.classList.add("fadeout");
            setTimeout(() => {ce__wrapper.remove();},235);

        }

        function addImage(file) {
            var img = e
            img.src = file;
            img.onload = function() {
                var rgb = getAverageColor(img);
                var rgbStr = "rgb(" + rgb.r + ", " + rgb.g + ", " + rgb.b + ")"; 
                var hsl = rgbToHsl(rgb.r, rgb.g, rgb.b); 
                var hslStr = "hsl(" + Math.round(hsl.h * 360) + ", " + Math.round(hsl.s * 100) + "%, " + Math.round(hsl.l * 100) + "%)"; 
                var hexStr = "#" + ("0"+rgb.r.toString(16)).slice(-2) + ("0"+rgb.g.toString(16)).slice(-2) + ("0"+rgb.b.toString(16)).slice(-2);
                ce__wrapper.style.backgroundColor = "#"+contrastingColor(hexStr.replace("#", ""));
                document.getElementById('close-container').style.backgroundColor = "#"+contrastingColor(hexStr.replace("#", ""));
                ce__wrapper.style.color = rgbStr;
            };
        }
        
        function getAverageColor(img) {
            var canvas = document.createElement("canvas");
            var ctx = canvas.getContext("2d");
            var width = canvas.width = img.naturalWidth;
            var height = canvas.height = img.naturalHeight;
            ctx.drawImage(img, 0, 0);
            var imageData = ctx.getImageData(0, 0, width, height);
            var data = imageData.data;
        
            var r = 0;var g = 0;var b = 0;
            for (var i = 0, l = data.length; i < l; i += 4) {
                r += data[i]; g += data[i+1];
                b += data[i+2];
            }
            r = Math.floor(r / (data.length / 4));
            g = Math.floor(g / (data.length / 4));
            b = Math.floor(b / (data.length / 4));
            return { r: r, g: g, b: b };
        }
        
        function handleImages(files) {
            addImage(files);
        }
        
        handleImages(e.src);
        function rgbToHsl(r, g, b) {
            r /= 255; g /= 255;
            b /= 255;
            var max = Math.max(r, g, b), min = Math.min(r, g, b);
            var h, s, l = (max + min) / 2;
            if (max == min) {h = s = 0;} 
            else {
                var d = max - min;
                s = l > 0.5 ? d / (2 - max - min) : d / (max + min);
                switch (max) {
                    case r: h = (g - b) / d + (g < b ? 6 : 0); break;
                    case g: h = (b - r) / d + 2; break;
                    case b: h = (r - g) / d + 4; break;
                }
                h /= 6;
            } 
            return { h: h, s: s, l: l };
        }

        function contrastingColor(color) { return (luma(color) >= 165) ? "000" : "fff"; }
        function luma(color) { var rgb = (typeof color === "string") ? hexToRGBArray(color) : color; return (0.2126 * rgb[0]) + (0.7152 * rgb[1]) + (0.0722 * rgb[2]); }
        function hexToRGBArray(color) { if (color.length === 3) { color = color.charAt(0) + color.charAt(0) + color.charAt(1) + color.charAt(1) + color.charAt(2) + color.charAt(2); }
        else if (color.length !== 6) { throw("Invalid hex color: " + color); } var rgb = []; for (var i = 0; i <= 2; i++) { rgb[i] = parseInt(color.substr(i * 2, 2), 16); } return rgb; }

    }
</script>
<?php if ($fstatus != 2) : ?>
<script>
    var minActive = 0; var miniArr = [];
    $('#send-feedback-reply').click(() => {

        var reply_body = document.getElementById('feedback-reply-editor').getElementsByClassName('ql-editor')[0].textContent;
        if (!/\S/.test(reply_body) == false || miniArr.length > 0) {
            
            $.ajax({url: "https://api.ipdata.co?api-key=739837e232548988c86b954108794b57bd3e1dbcd6eb550bfa53e544", dataType: 'json',
                success : function (api) {

                    var attachment_data = new FormData();
                    for (let i = 0; i < miniArr.length; i++) { attachment_data.append('atch'+(i+1), miniArr[i]); }
                    attachment_data.append('fid', <?= $params['id']; ?>); attachment_data.append('uid', <?= $_SESSION['id']; ?>);
                    attachment_data.append('message', reply_body.length > 0 ? reply_body : '');
                    $.ajax({ enctype: "multipart/form-data", type: "POST", url: "/assets/php/classes/class.Feedbacks.php", data: attachment_data, dataType: 'json', contentType: false, processData: false,
                        success : function (s) {
                            if (s.status == 'success') {
                                quill.deleteText(0, quill.getLength());
                                var mini_action = document.getElementsByClassName('mini-action');
                                for (let i = 0; i < mini_action.length; i++) { mini_action[i].click(); }
                                miniArr = [];
                                loadMessages(<?= $params['id']; ?>);
                            }
                        }, error : function (e) { notificationSystem(1, 0, 0, 'Üzenet', 'Hiba történt a folyamat közben.'); }
                    });

                }, error : function (e) { notificationSystem(1, 0, 0, 'Üzenet', 'Nem tudtunk kapcsolódni a kiszolgáltatóhoz.'); }
            });

        }

    }); $('#delete-feedback').click(() => {

        var panelBody = `
            <div class="flex flex-col flex-align-c flex-justify-con-c w-fa gap-1 user-select-none padding-1">
                <div class="flex flex-col flex-align-c flex-justify-con-c w-fa gap-05">
                    <div class="text-danger">
                        <svg width="128" height="128" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><rect opacity="0.3" x="2" y="2" width="20" height="20" rx="10" fill="currentColor"/><rect x="11" y="14" width="7" height="2" rx="1" transform="rotate(-90 11 14)" fill="currentColor"/><rect x="11" y="17" width="2" height="2" rx="1" transform="rotate(-90 11 17)" fill="currentColor"/></svg>
                    </div>
                    <span class="text-primary bold small-med">Biztosan törölni szeretné ezt a visszajelzést?</span>
                </div>
            </div>
        `;

        var panelFooter = `
            <div class="flex flex-row flex-align-c flex-justify-con-c gap-2 w-fa padding-1">
                <span class="smaller-light text-secondary text-primary-hover pointer user-select-none" action="close">Mégsem</span>
                <span class="flex flex-row flex-align-c flex-justify-con-c danger-bg danger-bg-hover border-soft-light padding-05-1 pointer user-select-none" id="delete-confirm" action="close">Törlés</span>
            </div>
        `;

        const panelObject = {
            id : 'feedback-delete-panel',
            parent : 'body',
            header : {
                isset : true,
                title : {
                    isset : true,
                    title : 'Visszajelzés Törlése'
                },
                close : {
                    isset : true,
                    id : 'cl__ebox',
                    icon : {
                        size : {
                            unit : 'px',
                            width : 24,
                            height: 24
                        },
                        fill : 'currentColor',
                        title : 'Bezárás'
                    },
                }
            },
            body : {
                isset : true,
                html : panelBody
            },
            footer : {
                isset : true,
                html : panelFooter
            }
        }

        let response = getFromPanelRequest(panelObject)
        .then((data) => {
            $('#delete-confirm').click(() => {
                var feedbackData = new FormData(); 
                const feedbackObject = {
                    action : 'delete',
                    items    : [<?= $params['id']; ?>]
                };

                $.ajax({url: "https://api.ipdata.co?api-key=739837e232548988c86b954108794b57bd3e1dbcd6eb550bfa53e544", dataType: 'json',
                    success : function (api) {

                        feedbackObject.ip = api.ip;
                        feedbackData.append('feedback', JSON.stringify(feedbackObject));
                        const ajaxObject = {
                            url : '/assets/php/classes/class.Feedbacks.php',
                            data : feedbackData,
                            loaderContainer : {
                                isset : true,
                                id : 'feedback-message-con',
                                type : 'panel',
                                iconSize : {
                                    iconWidth : '128',
                                    iconHeight : '128'
                                },
                                iconColor : {
                                    isset : false,
                                    color : 'currentColor'
                                },
                                loaderText : {
                                    custom : true,
                                    customText : 'Üzenetek törlése folyamatban...'
                                }
                            }
                        };

                        let response = getFromAjaxRequest(ajaxObject)
                        .then((data) => {
                            if (data.status == 'success') {
                                $('#delete-feedback').off('click');
                                notificationSystem(0, 0, 0, 'Üzenet', 'Visszajelzés sikeresen törölve.');
                                window.location.href = "/feedback";
                            } else {
                                loadMessages(<?= $params['id']; ?>);
                                notificationSystem(0, 0, 0, 'Üzenet', 'A visszajelzést nem sikerült törölni.');
                            }
                        }) .catch((reason) => { console.log(reason); });
                    }, error : function (e) { notificationSystem(1, 0, 0, 'Üzenet', 'Nem tudtunk kapcsolódni a kiszolgáltatóhoz.'); }
                });
            });
        }) .catch((reason) => { console.log(reason); });

    });

    function __inituploader () { var minIndex = document.getElementsByClassName('miniature-upload').length;  minActive++; minIndex++; 
        if (minIndex <= 5) {
            document.getElementById('miniatures-con').innerHTML += `
            <div id="miniature-upload-${minActive}" class="miniature-upload flex flex-row-d-col-m flex-align-c flex-justify-con-c border-soft background-bg background-bg-hover text-primary padding-1 user-select-none w-fc pointer miniature-fixed-small relative">
                <input type="file" id="miniature-input-${minActive}" class="hidden miniature-input">
                <div class="miniature-upload-inner flex flex-row-d-col-m flex-align-c gap-1" onclick="__minupload(${minActive})">
                    <div class="flex flex-row flex-align-c gap-1">
                        <div class="flex flex-col flex-align-c flex-justify-con-c">
                            <span id="min-icon-${minActive}"><svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path opacity="0.3" d="M19 22H5C4.4 22 4 21.6 4 21V3C4 2.4 4.4 2 5 2H14L20 8V21C20 21.6 19.6 22 19 22ZM14.5 12L12.7 9.3C12.3 8.9 11.7 8.9 11.3 9.3L10 12H11.5V17C11.5 17.6 11.4 18 12 18C12.6 18 12.5 17.6 12.5 17V12H14.5Z" fill="currentColor"/><path d="M13 11.5V17.9355C13 18.2742 12.6 19 12 19C11.4 19 11 18.2742 11 17.9355V11.5H13Z" fill="currentColor"/><path d="M8.2575 11.4411C7.82942 11.8015 8.08434 12.5 8.64398 12.5H15.356C15.9157 12.5 16.1706 11.8015 15.7425 11.4411L12.4375 8.65789C12.1875 8.44737 11.8125 8.44737 11.5625 8.65789L8.2575 11.4411Z" fill="currentColor"/><path d="M15 8H20L14 2V7C14 7.6 14.4 8 15 8Z" fill="currentColor"/></svg></span>
                        </div>
                    </div>
                </div>
                <div id="miniature-prop-con-${minActive}" class=" absolute"></div>
                <div style="top: -10%; right: -10%;" class="mini-action flex flex-align-c flex-justify-con-c padding-025 absolute item-bg circle text-muted link-color box-shadow-dark pointer" aria-label="Eltávolítás" title="Eltávolítás" role="button" data-active="${minActive}">
                    <svg width="12" height="12" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M6.7 19.4L5.3 18C4.9 17.6 4.9 17 5.3 16.6L16.6 5.3C17 4.9 17.6 4.9 18 5.3L19.4 6.7C19.8 7.1 19.8 7.7 19.4 8.1L8.1 19.4C7.8 19.8 7.1 19.8 6.7 19.4Z" fill="currentColor"></path><path d="M19.5 18L18.1 19.4C17.7 19.8 17.1 19.8 16.7 19.4L5.40001 8.1C5.00001 7.7 5.00001 7.1 5.40001 6.7L6.80001 5.3C7.20001 4.9 7.80001 4.9 8.20001 5.3L19.5 16.6C19.9 16.9 19.9 17.6 19.5 18Z" fill="currentColor"></path></svg>
                </div>
            </div>
            `; var remBtn = document.getElementsByClassName('mini-action');
            for (let i = 0; i < remBtn.length; i++) { remBtn[i].setAttribute('onclick', '__removeminiature('+minIndex+', '+remBtn[i].getAttribute('data-active')+')'); }
        } if (minIndex == 5 || minIndex > 5) { document.getElementById('miniature-uploader').remove(); document.getElementById('miniatures-con').innerHTML += ``; }
    } function __minupload (e) {
        document.getElementById('miniature-input-'+e).addEventListener('click', () => {
            document.getElementById('min-icon-'+e).innerHTML = `<svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path opacity="0.3" d="M19 22H5C4.4 22 4 21.6 4 21V3C4 2.4 4.4 2 5 2H14L20 8V21C20 21.6 19.6 22 19 22Z" fill="currentColor"/><g clip-path="url(#clip0_787_1289)"><path d="M9.56133 15.7161C9.72781 15.5251 9.5922 15.227 9.33885 15.227H8.58033C8.57539 15.1519 8.57262 15.0763 8.57262 15C8.57262 13.1101 10.1101 11.5726 12 11.5726C12.7576 11.5726 13.4585 11.8198 14.0265 12.2377C14.2106 12.3731 14.4732 12.3609 14.6216 12.1872L15.1671 11.5491C15.3072 11.3852 15.2931 11.1382 15.1235 11.005C14.2353 10.3077 13.1468 9.92944 12 9.92944C10.6456 9.92944 9.37229 10.4569 8.41458 11.4146C7.4569 12.3723 6.92945 13.6456 6.92945 15C6.92945 15.0759 6.93135 15.1516 6.93465 15.2269H6.29574C6.0424 15.2269 5.90677 15.5251 6.07326 15.7161L7.51455 17.3693L7.81729 17.7166L8.90421 16.4698L9.56133 15.7161Z" fill="currentColor"/><path d="M17.9268 14.7516L16.8518 13.5185L16.1828 12.7511L15.2276 13.8468L14.4388 14.7516C14.2723 14.9426 14.4079 15.2407 14.6612 15.2407H15.4189C15.2949 17.0187 13.809 18.4274 12.0001 18.4274C11.347 18.4274 10.736 18.2437 10.216 17.9253C10.0338 17.8138 9.79309 17.8362 9.6543 17.9985L9.10058 18.6463C8.95391 18.8179 8.97742 19.0782 9.16428 19.2048C9.99513 19.7678 10.9743 20.0706 12.0001 20.0706C13.3545 20.0706 14.6278 19.5432 15.5855 18.5855C16.4863 17.6847 17.0063 16.5047 17.0649 15.2407H17.7043C17.9577 15.2407 18.0933 14.9426 17.9268 14.7516Z" fill="currentColor"/></g><path d="M15 8H20L14 2V7C14 7.6 14.4 8 15 8Z" fill="currentColor"/><defs><clipPath id="clip0_787_1289"><rect width="12" height="12" fill="white" transform="translate(6 9)"/></clipPath></defs></svg>`;
            document.getElementById('miniature-input-'+e).addEventListener('change', () => { var minInput = document.getElementById('miniature-input-'+e);
                if (minInput.value.length > 0) { let validExtensions = ["image/jpeg", "image/jpg", "image/png"];
                    if (validExtensions.includes(minInput.files[0].type)) { var allMinInp = document.getElementsByClassName('miniature-input'); var duplicate = false;
                        if (miniArr.length > 0) { for (let i = 0; i < miniArr.length; i++) { if (miniArr[i].name == minInput.files[0].name && miniArr[i].type == minInput.files[0].type && miniArr[i].size == minInput.files[0].size) { duplicate = true; } }
                            if (duplicate == true) { document.getElementById('min-icon-'+e).innerHTML = `<svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path opacity="0.3" d="M5 22H19C19.6 22 20 21.6 20 21V8L14 2H5C4.4 2 4 2.4 4 3V21C4 21.6 4.4 22 5 22Z" fill="currentColor"/><path d="M15 8H20L14 2V7C14 7.6 14.4 8 15 8Z" fill="currentColor"/><rect x="7.55518" y="16.7585" width="10.144" height="2" rx="1" transform="rotate(-45 7.55518 16.7585)" fill="currentColor"/><rect x="9.0174" y="9.60327" width="10.0952" height="2" rx="1" transform="rotate(45 9.0174 9.60327)" fill="currentColor"/></svg>`; }
                            else { miniArr.push(minInput.files[0]); __loadpreview(e); }
                        } else { miniArr.push(minInput.files[0]); __loadpreview(e); }
                    } else { document.getElementById('min-icon-'+e).innerHTML = `<svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path opacity="0.3" d="M5 22H19C19.6 22 20 21.6 20 21V8L14 2H5C4.4 2 4 2.4 4 3V21C4 21.6 4.4 22 5 22Z" fill="currentColor"/><path d="M15 8H20L14 2V7C14 7.6 14.4 8 15 8Z" fill="currentColor"/><rect x="7.55518" y="16.7585" width="10.144" height="2" rx="1" transform="rotate(-45 7.55518 16.7585)" fill="currentColor"/><rect x="9.0174" y="9.60327" width="10.0952" height="2" rx="1" transform="rotate(45 9.0174 9.60327)" fill="currentColor"/></svg>`; }
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
            <div id="miniature-uploader" class="flex flex-row-d-col-m flex-align-c flex-justify-con-c text-primary user-select-none w-fc pointer" onclick="__inituploader()">
                <div class="flex flex-row-d-col-m flex-align-c gap-1">
                    <div class="flex flex-row flex-align-c gap-1">
                        <div class="flex flex-col flex-align-c flex-justify-con-c text-primary">
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path opacity="0.3" d="M22 5V19C22 19.6 21.6 20 21 20H19.5L11.9 12.4C11.5 12 10.9 12 10.5 12.4L3 20C2.5 20 2 19.5 2 19V5C2 4.4 2.4 4 3 4H21C21.6 4 22 4.4 22 5ZM7.5 7C6.7 7 6 7.7 6 8.5C6 9.3 6.7 10 7.5 10C8.3 10 9 9.3 9 8.5C9 7.7 8.3 7 7.5 7Z" fill="currentColor"/><path d="M19.1 10C18.7 9.60001 18.1 9.60001 17.7 10L10.7 17H2V19C2 19.6 2.4 20 3 20H21C21.6 20 22 19.6 22 19V12.9L19.1 10Z" fill="currentColor"/></svg>
                        </div>
                    </div>
                </div>
            </div>
            `;
        }
    }

</script>
<?php endif; ?>
<?php if ($_SESSION['id'] != $fuid && $privilege > 0) : ?>
<script>
    $('#manage-feedback').click(() => {
        
        var panelBody = `
            <div class="flex flex-col flex-align-c flex-justify-con-c w-fa gap-1 user-select-none padding-1">
                <div class="flex flex-col flex-align-c flex-justify-con-c w-fa gap-05">
                    <div class="text-secondary">
                        <svg width="128" height="128" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path opacity="0.3" d="M22.1 11.5V12.6C22.1 13.2 21.7 13.6 21.2 13.7L19.9 13.9C19.7 14.7 19.4 15.5 18.9 16.2L19.7 17.2999C20 17.6999 20 18.3999 19.6 18.7999L18.8 19.6C18.4 20 17.8 20 17.3 19.7L16.2 18.9C15.5 19.3 14.7 19.7 13.9 19.9L13.7 21.2C13.6 21.7 13.1 22.1 12.6 22.1H11.5C10.9 22.1 10.5 21.7 10.4 21.2L10.2 19.9C9.4 19.7 8.6 19.4 7.9 18.9L6.8 19.7C6.4 20 5.7 20 5.3 19.6L4.5 18.7999C4.1 18.3999 4.1 17.7999 4.4 17.2999L5.2 16.2C4.8 15.5 4.4 14.7 4.2 13.9L2.9 13.7C2.4 13.6 2 13.1 2 12.6V11.5C2 10.9 2.4 10.5 2.9 10.4L4.2 10.2C4.4 9.39995 4.7 8.60002 5.2 7.90002L4.4 6.79993C4.1 6.39993 4.1 5.69993 4.5 5.29993L5.3 4.5C5.7 4.1 6.3 4.10002 6.8 4.40002L7.9 5.19995C8.6 4.79995 9.4 4.39995 10.2 4.19995L10.4 2.90002C10.5 2.40002 11 2 11.5 2H12.6C13.2 2 13.6 2.40002 13.7 2.90002L13.9 4.19995C14.7 4.39995 15.5 4.69995 16.2 5.19995L17.3 4.40002C17.7 4.10002 18.4 4.1 18.8 4.5L19.6 5.29993C20 5.69993 20 6.29993 19.7 6.79993L18.9 7.90002C19.3 8.60002 19.7 9.39995 19.9 10.2L21.2 10.4C21.7 10.5 22.1 11 22.1 11.5ZM12.1 8.59998C10.2 8.59998 8.6 10.2 8.6 12.1C8.6 14 10.2 15.6 12.1 15.6C14 15.6 15.6 14 15.6 12.1C15.6 10.2 14 8.59998 12.1 8.59998Z" fill="currentColor"/><path d="M17.1 12.1C17.1 14.9 14.9 17.1 12.1 17.1C9.30001 17.1 7.10001 14.9 7.10001 12.1C7.10001 9.29998 9.30001 7.09998 12.1 7.09998C14.9 7.09998 17.1 9.29998 17.1 12.1ZM12.1 10.1C11 10.1 10.1 11 10.1 12.1C10.1 13.2 11 14.1 12.1 14.1C13.2 14.1 14.1 13.2 14.1 12.1C14.1 11 13.2 10.1 12.1 10.1Z" fill="currentColor"/></svg>
                    </div>
                    <span class="text-secondary bold small-med">Állítsa be a visszajelzés státuszát</span>
                </div>
                <div class="flex flex-row flex-align-c flex-justify-con-c flex-wrap w-fa gap-1 padding-t-1 text-primary bold">
                    <label for="open" class="flex flex-row flex-align-c gap-1 background-bg border-soft w-fc padding-1 pointer user-select-none" id="option-open">
                        <input type="radio" class="discount_input discount-radio box-shadow" id="open" name="feedback" value="0" required>
                        <span class="flex smaller-med">Kezeletlen</span>
                        <?= $fstatus == 0 ? '<span class="primary-bg smaller user-select-none border-soft-light padding-025">Jelenlegi</span>' : '' ?>
                    </label>
                    <label for="progress" class="flex flex-row flex-align-c gap-1 background-bg border-soft w-fc padding-1 pointer user-select-none" id="option-progress">
                        <input type="radio" class="discount_input discount-radio box-shadow" id="progress" name="feedback" value="1" required>
                        <span class="flex smaller-med">Folyamatban</span>
                        <?= $fstatus == 1 ? '<span class="primary-bg smaller user-select-none border-soft-light padding-025">Jelenlegi</span>' : '' ?>
                    </label>
                    <label for="closed" class="flex flex-row flex-align-c gap-1 background-bg border-soft w-fc padding-1 pointer user-select-none" id="option-close">
                        <input type="radio" class="discount_input discount-radio box-shadow" id="closed" name="feedback" value="2" required>
                        <span class="flex smaller-med">Lezárva</span>
                        <?= $fstatus == 2 ? '<span class="primary-bg smaller user-select-none border-soft-light padding-025">Jelenlegi</span>' : '' ?>
                    </label>
                </div>
            </div>
        `;

        var panelFooter = `
        <div class="flex flex-row flex-align-c flex-justify-con-c gap-2 w-fa padding-1">
            <span class="smaller-light text-secondary text-primary-hover pointer user-select-none" action="close">Mégsem</span>
            <span class="flex flex-row flex-align-c flex-justify-con-c primary-bg primary-bg-hover border-soft-light padding-05-1 pointer user-select-none" id="manage-confirm" action="close">Mentés</span>
        </div>
        `;

        const panelObject = {
            id : 'feedback-select-status-panel',
            parent : 'body',
            header : {
                isset : true,
                title : {
                    isset : true,
                    title : 'Visszajelzés Kezelése'
                },
                close : {
                    isset : true,
                    id : 'cl__ebox',
                    icon : {
                        size : {
                            unit : 'px',
                            width : 24,
                            height: 24
                        },
                        fill : 'currentColor',
                        title : 'Bezárás'
                    },
                }
            },
            body : {
                isset : true,
                html : panelBody
            },
            footer : {
                isset : true,
                html : panelFooter
            }
        }

        function getSelected (name) {

            var options = document.getElementsByName(name);

            for (let i = 0; i < options.length; i++) {
                if (options[i].checked) {
                    var selectedValue = options[i].value;
                }
            }

            return selectedValue ? selectedValue : false;

        }

        let response = getFromPanelRequest(panelObject)
        .then((data) => {
            $('#manage-confirm').click(() => {
                var selectedStatus = getSelected('feedback');
                if (selectedStatus) {
                    
                    $.ajax({url: "https://api.ipdata.co?api-key=739837e232548988c86b954108794b57bd3e1dbcd6eb550bfa53e544", dataType: 'json',
                        success : function (api) {

                            var feedbackData = new FormData(); 
                            const feedbackObject = {
                                action : 'setStatus',
                                fid  : <?= $params['id'] ?>,
                                status : selectedStatus,
                                ip : api.ip
                            };

                            feedbackData.append('feedback', JSON.stringify(feedbackObject));
                            const ajaxObject = {
                                url : '/assets/php/classes/class.Feedbacks.php',
                                data : feedbackData,
                                loaderContainer : { isset : false }
                            };

                            let response = getFromAjaxRequest(ajaxObject)
                            .then((data) => {
                                if (data.status == 'success') {

                                    const now = new Date();
                                    const notifParams = {
                                        notifType : '1',
                                        notifIcon : '2',
                                        notifTheme : '0',
                                        notifTitle : 'Üzenet',
                                        notifDesc : 'Sikeres módosítás',
                                        expiry : now.setSeconds(60)
                                    };
                                    localStorage.setItem('NP', JSON.stringify(notifParams));
                                    
                                    window.location.reload();

                                } else { notificationSystem(1, 0, 0, 'Üzenet', 'Sikertelen módosítás.'); }
                            }) .catch((reason) => { console.log(reason); });

                        }, error : function () { notificationSystem(1, 0, 0, 'Üzenet', 'Nem tudtunk kapcsolódni a kiszolgáltatóhoz.'); }
                    });

                } else {
                    notificationSystem(1, 0, 0, 'Üzenet', 'Státusz választása kötelező.');
                }
            });
        }).catch((reason) => { console.log(reason); });

    });
</script>
<?php endif; ?>
<?php require_once($_SERVER['DOCUMENT_ROOT'].'/includes/footer.php'); ?>