<?php require_once($_SERVER['DOCUMENT_ROOT'].'/includes/header.php'); if (!isset($_SESSION['loggedin'])) { echo "<script>window.location.href='/';</script>"; die(); }
    $stmt = $con->prepare('SELECT privilege FROM customers__priv  WHERE uid = ?'); if (isset($_SESSION['loggedin'])) {$id = $_SESSION['id'];} $stmt->bind_param('i', $id);$stmt->execute(); $stmt->bind_result($privilege); $stmt->fetch();$stmt->close();
    if (isset($params['id'])) {

        $feedbackStmt = $con->prepare('SELECT uid, status FROM feedbacks WHERE id = ?'); $feedbackStmt->bind_param('i', $params['id']);$feedbackStmt->execute();
        $feedbackStmt->bind_result($fuid, $fstatus); $feedbackStmt->fetch();$feedbackStmt->close();
        if (!$fuid) { echo "<script>window.location.href='/404';</script>"; }
        else {
            if ($privilege < 1) {
                if ($_SESSION['id'] != $fuid) { echo "<script>window.location.href='/';</script>"; }
            }
        }
    } else { echo "<script>window.location.href='/';</script>"; die(); }
    function get_time_ago( $time ) {
        $time_difference = time() - $time;
        if( $time_difference < 1 ) { return '< 1mp'; }
        $condition = array( 12 * 30 * 24 * 60 * 60 =>  'éve',30 * 24 * 60 * 60 => 'hónapja',24 * 60 * 60 => 'napja',60 * 60 =>  'órája',60 =>  'perce',1 =>  'másodperce');
        foreach( $condition as $secs => $str ) {$d = $time_difference / $secs;if( $d >= 1 ) {$t = round( $d );return $t . ' ' . $str . ( $t > 1 ? '' : '' ) . '';}}
    }
?>
<script src="/assets/script/quill/dist/quill.js"></script>
<script src="/assets/script/tagify/dist/tagify.js"></script>
<main>
    <?php            
        $query = explode('&', $_SERVER['QUERY_STRING']); $queryVal; $queryFound = false;
        for ($i = 0; $i < count($query); $i++) { if (explode('=', $query[$i])[0] == 'f') { $queryVal = explode('=', $query[$i])[1]; $queryFound = true; } }
        if ($queryFound == true) {
            switch ($queryVal) {
                case 'a':
                    if ($privilege > 0) { echo '<div class="flex flex-row flex-align-c padding-1 padding-l-0 padding-b-0" id="breadcrumbs-con"><span class="text-muted small-med"><a class="link link-color pointer" href="/admin/">Admin</a> / <a class="link link-color pointer" href="/admin/?tab=feedbacks">Visszajelzések</a> / A "Hozzáadás a kedvencekhez" funkció nem működik a websop-ban</span></div>'; }
                    else { echo '<div class="flex flex-row flex-align-c padding-1 padding-l-0 padding-b-0" id="breadcrumbs-con"><span class="text-muted small-med"><a class="link link-color pointer" href="/feedback/">Visszajelzések</a> / A "Hozzáadás a kedvencekhez" funkció nem működik a websop-ban</span></div>'; }
                break;
                default : echo '<div class="flex flex-row flex-align-c padding-1 padding-l-0 padding-b-0" id="breadcrumbs-con"><span class="text-muted small-med"><a class="link link-color pointer" href="/feedback/">Visszajelzések</a> / A "Hozzáadás a kedvencekhez" funkció nem működik a websop-ban</span></div>'; break;
            }
        } else { echo '<div class="flex flex-row flex-align-c padding-1 padding-l-0 padding-b-0" id="breadcrumbs-con"><span class="text-muted small-med"><a class="link link-color pointer" href="/feedback/">Visszajelzések</a> / A "Hozzáadás a kedvencekhez" funkció nem működik a websop-ban</span></div>'; }
    ?>
    <div class="prod-con" id="tabs">
        <div class="leftcolumn">
            <div class="flex flex-row flex-align-c flex-justify-con-sb gap-1 w-fa padding-t-1">
                <div class="flex flex-row flex-align-c gap-1 text-primary">
                    <div class="flex flex-col flex-align-c flex-justify-con-c padding-025 border-soft-light background-bg background-bg-hover pointer has-tooltip relative" aria-describedby="tooltip-reload">
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M14.5 20.7259C14.6 21.2259 14.2 21.826 13.7 21.926C13.2 22.026 12.6 22.0259 12.1 22.0259C9.5 22.0259 6.9 21.0259 5 19.1259C1.4 15.5259 1.09998 9.72592 4.29998 5.82592L5.70001 7.22595C3.30001 10.3259 3.59999 14.8259 6.39999 17.7259C8.19999 19.5259 10.8 20.426 13.4 19.926C13.9 19.826 14.4 20.2259 14.5 20.7259ZM18.4 16.8259L19.8 18.2259C22.9 14.3259 22.7 8.52593 19 4.92593C16.7 2.62593 13.5 1.62594 10.3 2.12594C9.79998 2.22594 9.4 2.72595 9.5 3.22595C9.6 3.72595 10.1 4.12594 10.6 4.02594C13.1 3.62594 15.7 4.42595 17.6 6.22595C20.5 9.22595 20.7 13.7259 18.4 16.8259Z" fill="currentColor"></path><path opacity="0.3" d="M2 3.62592H7C7.6 3.62592 8 4.02592 8 4.62592V9.62589L2 3.62592ZM16 14.4259V19.4259C16 20.0259 16.4 20.4259 17 20.4259H22L16 14.4259Z" fill="currentColor"></path></svg>
                        <span class="tooltip absolute" id="tooltip-reload"><span key="tooltip-reload">Frissítés</span></span>
                    </div>
                    <div class="flex flex-col flex-align-c flex-justify-con-c padding-025 border-soft-light background-bg background-bg-hover pointer has-tooltip relative" aria-describedby="tooltip-archive">
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path opacity="0.3" d="M10 4H21C21.6 4 22 4.4 22 5V7H10V4Z" fill="currentColor"></path><path d="M9.2 3H3C2.4 3 2 3.4 2 4V19C2 19.6 2.4 20 3 20H21C21.6 20 22 19.6 22 19V7C22 6.4 21.6 6 21 6H12L10.4 3.60001C10.2 3.20001 9.7 3 9.2 3Z" fill="currentColor"></path></svg>
                        <span class="tooltip absolute" id="tooltip-archive"><span key="tooltip-archive">Archiválás</span></span>
                    </div>
                    <div class="flex flex-col flex-align-c flex-justify-con-c padding-025 border-soft-light background-bg background-bg-hover pointer has-tooltip relative" aria-describedby="tooltip-delete">
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M5 9C5 8.44772 5.44772 8 6 8H18C18.5523 8 19 8.44772 19 9V18C19 19.6569 17.6569 21 16 21H8C6.34315 21 5 19.6569 5 18V9Z" fill="currentColor"></path><path opacity="0.5" d="M5 5C5 4.44772 5.44772 4 6 4H18C18.5523 4 19 4.44772 19 5V5C19 5.55228 18.5523 6 18 6H6C5.44772 6 5 5.55228 5 5V5Z" fill="currentColor"></path><path opacity="0.5" d="M9 4C9 3.44772 9.44772 3 10 3H14C14.5523 3 15 3.44772 15 4V4H9V4Z" fill="currentColor"></path></svg>
                        <span class="tooltip absolute" id="tooltip-delete"><span key="tooltip-delete">Törlés</span></span>
                    </div>
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
                    <span class="text-primary bold">A "Hozzáadás a kedvencekhez" funkció nem működik a websop-ban</span>
                </div><hr style="border: 1px solid var(--background);" class="w-100">
                <div class="flex flex-col gap-1 w-fa padding-1 feedback-message-con" id="feedback-message-con">
                    <div class="flex flex-row flex-justify-con-fe w-fa small">
                        <div class="flex flex-row flex-align-fe flex-justify-con-fe w-fc padding-1 border-soft feedback-chat-item-user has-tooltip relative" aria-describedby="tooltip-feedback-item-1">
                            <span>Küldjön visszajelzést fejlesztőinknek, hogy kijavíthassák az Ön által talált hibákat.</span>
                            <span class="tooltip absolute" id="tooltip-feedback-item-1"><span key="tooltip-feedback-item-1" key="tooltip-feedback-item-1">2022-04-16 18:44:29</span></span>
                        </div>
                    </div>
                    <div class="flex flex-row flex-justify-con-fe w-fa small">
                        <img class="flex feedback-chat-img pointer user-select-none border-soft drop-shadow" src="/assets/images/feedbacks/abd14df20220417140157.png" />
                    </div>
                    <div class="flex flex-row flex-justify-con-fs w-fa small">
                        <div class="flex flex-row flex-align-fs flex-justify-con-fs w-fc padding-1 border-soft feedback-chat-item-support has-tooltip relative" aria-describedby="tooltip-feedback-item-1">
                            <span>Küldjön visszajelzést fejlesztőinknek, hogy kijavíthassák az Ön által talált hibákat.</span>
                            <span class="tooltip absolute" id="tooltip-feedback-item-1"><span key="tooltip-feedback-item-1" key="tooltip-feedback-item-1">2022-04-16 18:44:29</span></span>
                        </div>
                    </div>
                </div>
                <?php if ($fstatus != 2 && $privilege > 0 && $fuid != $_SESSION['id']): ?>
                    <div class="flex flex-col gap-05 padding-t-1">
                        <div class="flex flex-col">
                            <div id="feedback-response-editor" class="border-soft prd-ch-fr-er-ce" style="height: 4rem;"></div>
                        </div>
                        <script>
                            var quill = new Quill('#feedback-response-editor', {
                                modules: { toolbar: false }, placeholder: 'Válasz írása...', theme: 'snow'
                            });
                        </script>
                        <div class="flex flex-row flex-align-c flex-justify-con-sb w-fa">
                            <div class="flex flex-row flex-align-c w-fa gap-1 padding-0-1">
                                <div class="flex flex-col flex-align-c flex-justify-con-c padding-025 border-soft-light text-secondary text-primary-hover pointer user-select-none has-tooltip relative" aria-describedby="tooltip-add-image">
                                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path opacity="0.3" d="M22 5V19C22 19.6 21.6 20 21 20H19.5L11.9 12.4C11.5 12 10.9 12 10.5 12.4L3 20C2.5 20 2 19.5 2 19V5C2 4.4 2.4 4 3 4H21C21.6 4 22 4.4 22 5ZM7.5 7C6.7 7 6 7.7 6 8.5C6 9.3 6.7 10 7.5 10C8.3 10 9 9.3 9 8.5C9 7.7 8.3 7 7.5 7Z" fill="currentColor"/><path d="M19.1 10C18.7 9.60001 18.1 9.60001 17.7 10L10.7 17H2V19C2 19.6 2.4 20 3 20H21C21.6 20 22 19.6 22 19V12.9L19.1 10Z" fill="currentColor"/></svg>
                                    <span class="tooltip absolute" id="tooltip-add-image"><span key="tooltip-add-image">Kép csatolása</span></span>
                                </div>
                                <div class="flex flex-col flex-align-c flex-justify-con-c padding-025 border-soft-light text-secondary text-primary-hover pointer user-select-none has-tooltip relative" aria-describedby="tooltip-add-files">
                                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path opacity="0.3" d="M18.4 5.59998C18.7766 5.9772 18.9881 6.48846 18.9881 7.02148C18.9881 7.55451 18.7766 8.06577 18.4 8.44299L14.843 12C14.466 12.377 13.9547 12.5887 13.4215 12.5887C12.8883 12.5887 12.377 12.377 12 12C11.623 11.623 11.4112 11.1117 11.4112 10.5785C11.4112 10.0453 11.623 9.53399 12 9.15698L15.553 5.604C15.9302 5.22741 16.4415 5.01587 16.9745 5.01587C17.5075 5.01587 18.0188 5.22741 18.396 5.604L18.4 5.59998ZM20.528 3.47205C20.0614 3.00535 19.5074 2.63503 18.8977 2.38245C18.288 2.12987 17.6344 1.99988 16.9745 1.99988C16.3145 1.99988 15.661 2.12987 15.0513 2.38245C14.4416 2.63503 13.8876 3.00535 13.421 3.47205L9.86801 7.02502C9.40136 7.49168 9.03118 8.04568 8.77863 8.6554C8.52608 9.26511 8.39609 9.91855 8.39609 10.5785C8.39609 11.2384 8.52608 11.8919 8.77863 12.5016C9.03118 13.1113 9.40136 13.6653 9.86801 14.132C10.3347 14.5986 10.8886 14.9688 11.4984 15.2213C12.1081 15.4739 12.7616 15.6039 13.4215 15.6039C14.0815 15.6039 14.7349 15.4739 15.3446 15.2213C15.9543 14.9688 16.5084 14.5986 16.975 14.132L20.528 10.579C20.9947 10.1124 21.3649 9.55844 21.6175 8.94873C21.8701 8.33902 22.0001 7.68547 22.0001 7.02551C22.0001 6.36555 21.8701 5.71201 21.6175 5.10229C21.3649 4.49258 20.9947 3.93867 20.528 3.47205Z" fill="currentColor"/><path d="M14.132 9.86804C13.6421 9.37931 13.0561 8.99749 12.411 8.74695L12 9.15698C11.6234 9.53421 11.4119 10.0455 11.4119 10.5785C11.4119 11.1115 11.6234 11.6228 12 12C12.3766 12.3772 12.5881 12.8885 12.5881 13.4215C12.5881 13.9545 12.3766 14.4658 12 14.843L8.44699 18.396C8.06999 18.773 7.55868 18.9849 7.02551 18.9849C6.49235 18.9849 5.98101 18.773 5.604 18.396C5.227 18.019 5.0152 17.5077 5.0152 16.9745C5.0152 16.4413 5.227 15.93 5.604 15.553L8.74701 12.411C8.28705 11.233 8.28705 9.92498 8.74701 8.74695C8.10159 8.99737 7.5152 9.37919 7.02499 9.86804L3.47198 13.421C2.52954 14.3635 2.00009 15.6417 2.00009 16.9745C2.00009 18.3073 2.52957 19.5855 3.47202 20.528C4.41446 21.4704 5.69269 21.9999 7.02551 21.9999C8.35833 21.9999 9.63656 21.4704 10.579 20.528L14.132 16.975C14.5987 16.5084 14.9689 15.9544 15.2215 15.3447C15.4741 14.735 15.6041 14.0815 15.6041 13.4215C15.6041 12.7615 15.4741 12.108 15.2215 11.4983C14.9689 10.8886 14.5987 10.3347 14.132 9.86804Z" fill="currentColor"/></svg>
                                    <span class="tooltip absolute" id="tooltip-add-files"><span key="tooltip-add-files">Fájlok csatolása</span></span>
                                </div>
                            </div>
                            <span class="flex flex-row flex-align-c flex-justify-con-c w-fc gap-05 primary-bg primary-bg-hover border-soft padding-05 user-select-none pointer small-med bold">
                                <span class="flex flex-col flex-align-c flex-justify-con-c">Elküldés</span>
                                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M12.6343 12.5657L8.45001 16.75C8.0358 17.1642 8.0358 17.8358 8.45001 18.25C8.86423 18.6642 9.5358 18.6642 9.95001 18.25L15.4929 12.7071C15.8834 12.3166 15.8834 11.6834 15.4929 11.2929L9.95001 5.75C9.5358 5.33579 8.86423 5.33579 8.45001 5.75C8.0358 6.16421 8.0358 6.83579 8.45001 7.25L12.6343 11.4343C12.9467 11.7467 12.9467 12.2533 12.6343 12.5657Z" fill="currentColor"></path></svg>
                            </span>
                        </div>
                    </div>
                <?php else: ?>
                    <div class="flex flex-row flex-align-c flex-justify-con-c w-fa small-med text-muted user-select-none">
                        <span>Ez a funkció még nem érhető el felhasználók számára</span>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</main>
<?php if ($_SESSION['id'] != $fuid && $privilege > 0) : ?>
<script>
    $('#manage-feedback').click(() => {
        var c__wrapper = document.createElement('div'); c__wrapper.classList = "wrapper_dark fadein"; var c__box = document.createElement('div'); c__box.classList = "d__confirm popup fixed flex flex-col border-soft item-bg box-shadow padding-1";
        c__wrapper.classList.add("fadein"); c__wrapper.classList.remove("fadeout"); document.body.append(c__wrapper); c__box.classList.add('padding-t-0'); c__box.classList.add('popup'); c__box.classList.remove('popout'); c__wrapper.append(c__box); $('html').css("overflow-y", "hidden");
        c__box.innerHTML = `
        <div class="flex flex-row flex-align-c flex-justify-con-sb padding-t-1" id="cbh__con">
            <span class="text-primary bold">Visszajelzés kezelése</span>
            <div class="flex flex-row flex-align-c gap-05">
                <span class="text-primary pointer" aria-label="Bezárás" id="cl__box"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"><rect opacity="0.3" x="2" y="2" width="20" height="20" rx="5" fill="currentColor"/><rect x="7" y="15.3137" width="12" height="2" rx="1" transform="rotate(-45 7 15.3137)" fill="currentColor"/><rect x="8.41422" y="7" width="12" height="2" rx="1" transform="rotate(45 8.41422 7)" fill="currentColor"/></svg></span>
            </div>
        </div>
        <div class="flex flex-row flex-align-c flex-justify-con-c flex-wrap w-fa gap-1 padding-t-1 text-primary bold small-med">
            <label for="open" class="flex flex-row flex-align-c gap-1 secondary-bg border-soft w-fc padding-1 pointer">
                <input type="radio" class="discount_input discount-radio box-shadow" id="open" name="feedback" value="1" required>
                <span class="flex">Kezeletlen</span>
            </label>
            <label for="progress" class="flex flex-row flex-align-c gap-1 secondary-bg border-soft w-fc padding-1 pointer">
                <input type="radio" class="discount_input discount-radio box-shadow" id="progress" name="feedback" value="1" required>
                <span class="flex">Folyamatban</span>
            </label>
            <label for="closed" class="flex flex-row flex-align-c gap-1 secondary-bg border-soft w-fc padding-1 pointer">
                <input type="radio" class="discount_input discount-radio box-shadow" id="closed" name="feedback" value="1" required>
                <span class="flex">Lezárva</span>
            </label>
        </div>
        <div class="flex flex-row flex-align-c flex-justify-con-fe w-fa padding-t-1">
            <span class="flex flex-row flex-align-c flex-justify-con-c w-fc gap-05 primary-bg primary-bg-hover border-soft padding-05 user-select-none pointer small-med bold">
                <span class="flex flex-col flex-align-c flex-justify-con-c">Mentés</span>
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M12.6343 12.5657L8.45001 16.75C8.0358 17.1642 8.0358 17.8358 8.45001 18.25C8.86423 18.6642 9.5358 18.6642 9.95001 18.25L15.4929 12.7071C15.8834 12.3166 15.8834 11.6834 15.4929 11.2929L9.95001 5.75C9.5358 5.33579 8.86423 5.33579 8.45001 5.75C8.0358 6.16421 8.0358 6.83579 8.45001 7.25L12.6343 11.4343C12.9467 11.7467 12.9467 12.2533 12.6343 12.5657Z" fill="currentColor"></path></svg>
            </span>
        </div>
        `;
        var con = document.getElementById('cbh__con');var mc = new Hammer(con);mc.get('pan').set({ direction: Hammer.DIRECTION_ALL });mc.on("pandown", function(ev) { $('#cl__box').click(); });
        $('#cl__box').click(function () { c__box.classList.replace("popup", "popout"); c__wrapper.classList.add("fadeout"); setTimeout(() => {c__wrapper.remove(); $('html').css("overflow-y", "unset");},235); });
    });
</script>
<?php endif; ?>
<?php require_once($_SERVER['DOCUMENT_ROOT'].'/includes/footer.php'); ?>