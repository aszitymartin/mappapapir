<?php require_once($_SERVER['DOCUMENT_ROOT'].'/includes/header.php'); if (!isset($_SESSION['loggedin'])) { echo "<script>window.location.href='/';</script>"; die(); }
    $stmt = $con->prepare('SELECT privilege FROM customers__priv  WHERE uid = ?'); if (isset($_SESSION['loggedin'])) {$id = $_SESSION['id'];} $stmt->bind_param('i', $id);$stmt->execute(); $stmt->bind_result($privilege); $stmt->fetch();$stmt->close();
    function get_time_ago( $time ) {
        $time_difference = time() - $time;
        if( $time_difference < 1 ) { return '< 1mp'; }
        $condition = array( 12 * 30 * 24 * 60 * 60 =>  'éve',30 * 24 * 60 * 60 => 'hónapja',24 * 60 * 60 => 'napja',60 * 60 =>  'órája',60 =>  'perce',1 =>  'másodperce');
        foreach( $condition as $secs => $str ) {$d = $time_difference / $secs;if( $d >= 1 ) {$t = round( $d );return $t . ' ' . $str . ( $t > 1 ? '' : '' ) . '';}}
    }
?>
<script>var formatter = new Intl.NumberFormat('hu-HU', {style: 'currency',currency: 'HUF',maximumFractionDigits: 0,minimumFractionDigits: 0}); var guid = <?= $id; ?></script>
<main>
<div class="prod-con" id="tabs">
    <div class="leftcolumn">
        <div class="card border-soft box-shadow relative">
            <div class="flex flex-row flex-align-c flex-justify-con-c gap-1 w-100">
                <div class="flex flex-row">
                    <img src="/assets/images/blank.png" class="border-soft box-shadow" style="border: 3px solid #fff; width: 120px; height: 120px;">
                </div>
                <div class="flex flex-col flex-align-c flex-justify-con-c gap-05">
                    <div class="flex flex-col">
                        <div class="flex flex-row flex-align-c gap-05">
                            <span class="text-primary larger bold" id="tab__fullname"><?php echo $fullname; ?></span>
                        </div>
                        <span class="text-secondary small-med text-align-c" id="tab__email"><?php echo $email; ?></span>
                    </div>
                    <span class="flex flex-row flex-align-c flex-justify-con-c w-fc gap-05 primary-bg primary-bg-hover border-soft padding-05 user-select-none pointer small-med bold" onclick="showPanel(event, 'tab-write')">
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path opacity="0.3" d="M21.4 8.35303L19.241 10.511L13.485 4.755L15.643 2.59595C16.0248 2.21423 16.5426 1.99988 17.0825 1.99988C17.6224 1.99988 18.1402 2.21423 18.522 2.59595L21.4 5.474C21.7817 5.85581 21.9962 6.37355 21.9962 6.91345C21.9962 7.45335 21.7817 7.97122 21.4 8.35303ZM3.68699 21.932L9.88699 19.865L4.13099 14.109L2.06399 20.309C1.98815 20.5354 1.97703 20.7787 2.03189 21.0111C2.08674 21.2436 2.2054 21.4561 2.37449 21.6248C2.54359 21.7934 2.75641 21.9115 2.989 21.9658C3.22158 22.0201 3.4647 22.0084 3.69099 21.932H3.68699Z" fill="currentColor"></path><path d="M5.574 21.3L3.692 21.928C3.46591 22.0032 3.22334 22.0141 2.99144 21.9594C2.75954 21.9046 2.54744 21.7864 2.3789 21.6179C2.21036 21.4495 2.09202 21.2375 2.03711 21.0056C1.9822 20.7737 1.99289 20.5312 2.06799 20.3051L2.696 18.422L5.574 21.3ZM4.13499 14.105L9.891 19.861L19.245 10.507L13.489 4.75098L4.13499 14.105Z" fill="currentColor"></path></svg>
                        <span class="flex flex-col flex-align-c flex-justify-con-c">Visszajelzés írása</span>
                    </span>
                </div>
            </div><br>
            <div class="flex flex-col">
                <div class="flex flex-col gap-05 padding-1 prfc__con">
                    <ul class="flex flex-col gap-05 user-select-none">
                        <li><a>
                            <div class="flex flex-row flex-align-c padding-05 border-soft gap-1 pointer prfc__item prfc__item__active" onclick="showPanel(event, 'tab-overview')" id="tabs-overview" tab-data="overview">
                                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24" height="24" viewBox="0 0 24 24" version="1.1"><g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"><polygon points="0 0 24 0 24 24 0 24"></polygon><path d="M12.9336061,16.072447 L19.36,10.9564761 L19.5181585,10.8312381 C20.1676248,10.3169571 20.2772143,9.3735535 19.7629333,8.72408713 C19.6917232,8.63415859 19.6104327,8.55269514 19.5206557,8.48129411 L12.9336854,3.24257445 C12.3871201,2.80788259 11.6128799,2.80788259 11.0663146,3.24257445 L4.47482784,8.48488609 C3.82645598,9.00054628 3.71887192,9.94418071 4.23453211,10.5925526 C4.30500305,10.6811601 4.38527899,10.7615046 4.47382636,10.8320511 L4.63,10.9564761 L11.0659024,16.0730648 C11.6126744,16.5077525 12.3871218,16.5074963 12.9336061,16.072447 Z" class="svg-blank" fill-rule="nonzero"></path><path d="M11.0563554,18.6706981 L5.33593024,14.122919 C4.94553994,13.8125559 4.37746707,13.8774308 4.06710397,14.2678211 C4.06471678,14.2708238 4.06234874,14.2738418 4.06,14.2768747 L4.06,14.2768747 C3.75257288,14.6738539 3.82516916,15.244888 4.22214834,15.5523151 C4.22358765,15.5534297 4.2250303,15.55454 4.22647627,15.555646 L11.0872776,20.8031356 C11.6250734,21.2144692 12.371757,21.2145375 12.909628,20.8033023 L19.7677785,15.559828 C20.1693192,15.2528257 20.2459576,14.6784381 19.9389553,14.2768974 C19.9376429,14.2751809 19.9363245,14.2734691 19.935,14.2717619 L19.935,14.2717619 C19.6266937,13.8743807 19.0546209,13.8021712 18.6572397,14.1104775 C18.654352,14.112718 18.6514778,14.1149757 18.6486172,14.1172508 L12.9235044,18.6705218 C12.377022,19.1051477 11.6029199,19.1052208 11.0563554,18.6706981 Z" class="svg-blank" opacity="0.3"></path></g></svg>
                                <span class="small">Áttekintés</span>
                            </div>
                        </a></li>
                        <li><a>
                            <div class="flex flex-row flex-align-c padding-05 border-soft gap-1 pointer prfc__item" onclick="showPanel(event, 'tab-new')" id="tabs-new" tab-data="new">
                                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path opacity="0.3" d="M21.4 8.35303L19.241 10.511L13.485 4.755L15.643 2.59595C16.0248 2.21423 16.5426 1.99988 17.0825 1.99988C17.6224 1.99988 18.1402 2.21423 18.522 2.59595L21.4 5.474C21.7817 5.85581 21.9962 6.37355 21.9962 6.91345C21.9962 7.45335 21.7817 7.97122 21.4 8.35303ZM3.68699 21.932L9.88699 19.865L4.13099 14.109L2.06399 20.309C1.98815 20.5354 1.97703 20.7787 2.03189 21.0111C2.08674 21.2436 2.2054 21.4561 2.37449 21.6248C2.54359 21.7934 2.75641 21.9115 2.989 21.9658C3.22158 22.0201 3.4647 22.0084 3.69099 21.932H3.68699Z" class="svg-blank"></path><path d="M5.574 21.3L3.692 21.928C3.46591 22.0032 3.22334 22.0141 2.99144 21.9594C2.75954 21.9046 2.54744 21.7864 2.3789 21.6179C2.21036 21.4495 2.09202 21.2375 2.03711 21.0056C1.9822 20.7737 1.99289 20.5312 2.06799 20.3051L2.696 18.422L5.574 21.3ZM4.13499 14.105L9.891 19.861L19.245 10.507L13.489 4.75098L4.13499 14.105Z" class="svg-blank"></path></svg>
                                <span class="small">Új visszajelzés</span>
                            </div>
                        </a></li>
                        <li><a>
                            <div class="flex flex-row flex-align-c padding-05 border-soft gap-1 pointer prfc__item" onclick="showPanel(event, 'tab-sent')" id="tabs-sent" tab-data="sent">
                                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path opacity="0.3" d="M2 4V16C2 16.6 2.4 17 3 17H13L16.6 20.6C17.1 21.1 18 20.8 18 20V17H21C21.6 17 22 16.6 22 16V4C22 3.4 21.6 3 21 3H3C2.4 3 2 3.4 2 4Z" class="svg-blank"/><path d="M18 9H6C5.4 9 5 8.6 5 8C5 7.4 5.4 7 6 7H18C18.6 7 19 7.4 19 8C19 8.6 18.6 9 18 9ZM16 12C16 11.4 15.6 11 15 11H6C5.4 11 5 11.4 5 12C5 12.6 5.4 13 6 13H15C15.6 13 16 12.6 16 12Z" class="svg-blank"/></svg>
                                <span class="small">Elküldött</span>
                            </div>
                        </a></li>
                        <li><a>
                            <div class="flex flex-row flex-align-c padding-05 border-soft gap-1 pointer prfc__item relative" onclick="showPanel(event, 'tab-archived')" id="tabs-archived" tab-data="archived">
                                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path opacity="0.3" d="M10 4H21C21.6 4 22 4.4 22 5V7H10V4Z" class="svg-blank"/><path d="M9.2 3H3C2.4 3 2 3.4 2 4V19C2 19.6 2.4 20 3 20H21C21.6 20 22 19.6 22 19V7C22 6.4 21.6 6 21 6H12L10.4 3.60001C10.2 3.20001 9.7 3 9.2 3Z" class="svg-blank"/></svg>
                                <span class="small">Archivált</span>
                                <div class="label label-warning border-soft-light absolute right-5 center-y">Béta</div>
                            </div>
                        </a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <div class="spancolumn">
        <div id="tab-overview" class="tab__content flex-col card gap-1" style="background: transparent; padding: 0;"></div>
        <div id="tab-new" class="tab__content flex-col card gap-1" style="background: transparent; padding: 0;"></div>
        <div id="tab-sent" class="tab__content flex-col card gap-1" style="background: transparent; padding: 0;"></div>
        <div id="tab-archived" class="tab__content flex-col card gap-1" style="background: transparent; padding: 0;"></div>
    </div>
</div>
</main>
<script src="/assets/script/feedback/pages.js" content-type="application/javascript"></script>
<?php require_once($_SERVER['DOCUMENT_ROOT'].'/includes/footer.php'); ?>