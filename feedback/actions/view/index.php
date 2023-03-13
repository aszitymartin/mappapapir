<?php require_once($_SERVER['DOCUMENT_ROOT'].'/includes/header.php'); if (!isset($_SESSION['loggedin'])) { echo "<script>window.location.href='/';</script>"; die(); }
    if (isset($params['id'])) {

        // if feedback id valid ? continue : exit
            // if feedback author id == uid ? continue : exit

    } else { echo "<script>window.location.href='/';</script>"; die(); }
    function get_time_ago( $time ) {
        $time_difference = time() - $time;
        if( $time_difference < 1 ) { return '< 1mp'; }
        $condition = array( 12 * 30 * 24 * 60 * 60 =>  'éve',30 * 24 * 60 * 60 => 'hónapja',24 * 60 * 60 => 'napja',60 * 60 =>  'órája',60 =>  'perce',1 =>  'másodperce');
        foreach( $condition as $secs => $str ) {$d = $time_difference / $secs;if( $d >= 1 ) {$t = round( $d );return $t . ' ' . $str . ( $t > 1 ? '' : '' ) . '';}}
    }
?>
<script>var formatter = new Intl.NumberFormat('hu-HU', {style: 'currency',currency: 'HUF',maximumFractionDigits: 0,minimumFractionDigits: 0}); var guid = <?= $id; ?></script>
<main>
    <div class="flex flex-row flex-align-c padding-1 padding-l-0 padding-b-0">
        <span class="text-muted small-med"><a class="link link-color pointer" href="/feedback/">Visszajelzések</a> / A "Hozzáadás a kedvencekhez" funkció nem működik a websop-ban</span>
    </div>
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
                <a href="/feedback/?tab=new" class="flex flex-row flex-align-c flex-justify-con-c w-fc gap-05 primary-bg primary-bg-hover border-soft padding-05 user-select-none pointer small-med bold">
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path opacity="0.3" d="M21.4 8.35303L19.241 10.511L13.485 4.755L15.643 2.59595C16.0248 2.21423 16.5426 1.99988 17.0825 1.99988C17.6224 1.99988 18.1402 2.21423 18.522 2.59595L21.4 5.474C21.7817 5.85581 21.9962 6.37355 21.9962 6.91345C21.9962 7.45335 21.7817 7.97122 21.4 8.35303ZM3.68699 21.932L9.88699 19.865L4.13099 14.109L2.06399 20.309C1.98815 20.5354 1.97703 20.7787 2.03189 21.0111C2.08674 21.2436 2.2054 21.4561 2.37449 21.6248C2.54359 21.7934 2.75641 21.9115 2.989 21.9658C3.22158 22.0201 3.4647 22.0084 3.69099 21.932H3.68699Z" fill="currentColor"></path><path d="M5.574 21.3L3.692 21.928C3.46591 22.0032 3.22334 22.0141 2.99144 21.9594C2.75954 21.9046 2.54744 21.7864 2.3789 21.6179C2.21036 21.4495 2.09202 21.2375 2.03711 21.0056C1.9822 20.7737 1.99289 20.5312 2.06799 20.3051L2.696 18.422L5.574 21.3ZM4.13499 14.105L9.891 19.861L19.245 10.507L13.489 4.75098L4.13499 14.105Z" fill="currentColor"></path></svg>
                    <span class="flex flex-col flex-align-c flex-justify-con-c">Visszajelzés írása</span>
                </a>
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
                <div class="flex flex-row flex-align-c flex-justify-con-c w-fa small-med text-muted user-select-none">
                    <span>A további üzenet küldése funkció még nem érhető el az oldalon.</span>
                </div>
            </div>
        </div>
    </div>
</main>
<?php require_once($_SERVER['DOCUMENT_ROOT'].'/includes/footer.php'); ?>