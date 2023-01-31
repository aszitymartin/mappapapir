<?php require_once($_SERVER['DOCUMENT_ROOT'].'/includes/inc.php'); require_once($_SERVER['DOCUMENT_ROOT'].'/assets/alph.php'); $uid = $_SESSION['id'];
$stmt = $con->prepare('SELECT privilege FROM customers__priv  WHERE uid = ?'); if (isset($_SESSION['loggedin'])) {$id = $_SESSION['id'];} $stmt->bind_param('i', $id);$stmt->execute(); $stmt->bind_result($privilege); $stmt->fetch();$stmt->close();
function get_time_ago( $time ) {
    $time_difference = time() - $time;
    if( $time_difference < 1 ) { return '< 1mp'; }
    $condition = array( 12 * 30 * 24 * 60 * 60 =>  'éve',30 * 24 * 60 * 60 => 'hónapja',24 * 60 * 60 => 'napja',60 * 60 =>  'órája',60 =>  'perce',1 =>  'másodperce');
    foreach( $condition as $secs => $str ) {$d = $time_difference / $secs;if( $d >= 1 ) {$t = round( $d );return $t . ' ' . $str . ( $t > 1 ? '' : '' ) . '';}}
}
$gsql = "SELECT "
?>
<script>var formatter = new Intl.NumberFormat('hu-HU', {style: 'currency',currency: 'HUF',maximumFractionDigits: 0,minimumFractionDigits: 0});</script>
<div class="flex flex-col gap-1">
    <div class="flex flex-col w-fa gap-1 border-soft item-bg box-shadow padding-1">
        <div class="flex flex-row flex-align-c flex-justify-con-sb">
            <span class="text-primary large bold">Felhasználók</span>
            <div class="flex flex-row flex-align-c gap-1">
                <div>
                    <span class="flex flex-col flex-align-c padding-025 text-muted primary-bg-hover border-soft pointer">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><rect opacity="0.5" x="17.0365" y="15.1223" width="8.15546" height="2" rx="1" transform="rotate(45 17.0365 15.1223)" fill="currentColor"></rect><path d="M11 19C6.55556 19 3 15.4444 3 11C3 6.55556 6.55556 3 11 3C15.4444 3 19 6.55556 19 11C19 15.4444 15.4444 19 11 19ZM11 5C7.53333 5 5 7.53333 5 11C5 14.4667 7.53333 17 11 17C14.4667 17 17 14.4667 17 11C17 7.53333 14.4667 5 11 5Z" fill="currentColor"></path></svg>
                    </span>
                </div>
                <div class="flex flex-row gap-05">
                    <span class="flex flex-col flex-align-c padding-025 text-muted primary-bg-hover border-soft pointer" id="load-card" onclick="__loadusers('card');">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24px" height="24px" viewBox="0 0 24 24"><g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"><rect x="5" y="5" width="5" height="5" rx="1" fill="currentColor"></rect><rect x="14" y="5" width="5" height="5" rx="1" fill="currentColor" opacity="0.3"></rect><rect x="5" y="14" width="5" height="5" rx="1" fill="currentColor" opacity="0.3"></rect><rect x="14" y="14" width="5" height="5" rx="1" fill="currentColor" opacity="0.3"></rect></g></svg>
                    </span>
                    <span class="flex flex-col flex-align-c padding-025 text-muted primary-bg border-soft pointer" id="load-list" onclick="__loadusers('list');">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M21 7H3C2.4 7 2 6.6 2 6V4C2 3.4 2.4 3 3 3H21C21.6 3 22 3.4 22 4V6C22 6.6 21.6 7 21 7Z" fill="currentColor"></path><path opacity="0.3" d="M21 14H3C2.4 14 2 13.6 2 13V11C2 10.4 2.4 10 3 10H21C21.6 10 22 10.4 22 11V13C22 13.6 21.6 14 21 14ZM22 20V18C22 17.4 21.6 17 21 17H3C2.4 17 2 17.4 2 18V20C2 20.6 2.4 21 3 21H21C21.6 21 22 20.6 22 20Z" fill="currentColor"></path></svg>
                    </span>
                </div>
            </div>
        </div>
        <div class="flex flex-col flex-align-c flex-justify-con-c gap-1">
            <div class="flex flex-row flex-align-c gap-1 flex-align-c flex-justify-con-c flex-wrap">
                <div class="flex flex-col gap-025 border-soft padding-05 background-bg border-secondary-dotted text-primary">
                    <div class="flex flex-row flex-align-c gap-05 larger">
                        <svg width="28" height="28" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M16.0173 9H15.3945C14.2833 9 13.263 9.61425 12.7431 10.5963L12.154 11.7091C12.0645 11.8781 12.1072 12.0868 12.2559 12.2071L12.6402 12.5183C13.2631 13.0225 13.7556 13.6691 14.0764 14.4035L14.2321 14.7601C14.2957 14.9058 14.4396 15 14.5987 15H18.6747C19.7297 15 20.4057 13.8774 19.912 12.945L18.6686 10.5963C18.1487 9.61425 17.1285 9 16.0173 9Z" fill="currentColor"/><rect opacity="0.3" x="14" y="4" width="4" height="4" rx="2" fill="currentColor"/><path d="M4.65486 14.8559C5.40389 13.1224 7.11161 12 9 12C10.8884 12 12.5961 13.1224 13.3451 14.8559L14.793 18.2067C15.3636 19.5271 14.3955 21 12.9571 21H5.04292C3.60453 21 2.63644 19.5271 3.20698 18.2067L4.65486 14.8559Z" fill="currentColor"/><rect opacity="0.3" x="6" y="5" width="6" height="6" rx="3" fill="currentColor"/></svg>
                        <span class="bold"><?php $ausql = "SELECT COUNT(id) AS au FROM customers"; $aures = $con->query($ausql); $au = $aures->fetch_assoc(); $auc = $au['au']; echo $auc; ?></span>
                    </div>
                    <span class="text-secondary small">Összes felhasználó</span>
                </div>
                <div class="flex flex-col gap-025 border-soft padding-05 background-bg border-secondary-dotted text-primary">
                    <div class="flex flex-row flex-align-c gap-05 larger">
                        <svg width="28" height="28" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M16.0173 9H15.3945C14.2833 9 13.263 9.61425 12.7431 10.5963L12.154 11.7091C12.0645 11.8781 12.1072 12.0868 12.2559 12.2071L12.6402 12.5183C13.2631 13.0225 13.7556 13.6691 14.0764 14.4035L14.2321 14.7601C14.2957 14.9058 14.4396 15 14.5987 15H18.6747C19.7297 15 20.4057 13.8774 19.912 12.945L18.6686 10.5963C18.1487 9.61425 17.1285 9 16.0173 9Z" fill="currentColor"/><rect opacity="0.3" x="14" y="4" width="4" height="4" rx="2" fill="currentColor"/><path d="M4.65486 14.8559C5.40389 13.1224 7.11161 12 9 12C10.8884 12 12.5961 13.1224 13.3451 14.8559L14.793 18.2067C15.3636 19.5271 14.3955 21 12.9571 21H5.04292C3.60453 21 2.63644 19.5271 3.20698 18.2067L4.65486 14.8559Z" fill="currentColor"/><rect opacity="0.3" x="6" y="5" width="6" height="6" rx="3" fill="currentColor"/></svg>
                        <span class="bold">3</span>
                    </div>
                    <span class="text-secondary small">Elérhető</span>
                </div>
                <div class="flex flex-col gap-025 border-soft padding-05 background-bg border-secondary-dotted text-primary">
                    <div class="flex flex-row flex-align-c gap-05 larger">
                        <svg width="28" height="28" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M16.0173 9H15.3945C14.2833 9 13.263 9.61425 12.7431 10.5963L12.154 11.7091C12.0645 11.8781 12.1072 12.0868 12.2559 12.2071L12.6402 12.5183C13.2631 13.0225 13.7556 13.6691 14.0764 14.4035L14.2321 14.7601C14.2957 14.9058 14.4396 15 14.5987 15H18.6747C19.7297 15 20.4057 13.8774 19.912 12.945L18.6686 10.5963C18.1487 9.61425 17.1285 9 16.0173 9Z" fill="currentColor"/><rect opacity="0.3" x="14" y="4" width="4" height="4" rx="2" fill="currentColor"/><path d="M4.65486 14.8559C5.40389 13.1224 7.11161 12 9 12C10.8884 12 12.5961 13.1224 13.3451 14.8559L14.793 18.2067C15.3636 19.5271 14.3955 21 12.9571 21H5.04292C3.60453 21 2.63644 19.5271 3.20698 18.2067L4.65486 14.8559Z" fill="currentColor"/><rect opacity="0.3" x="6" y="5" width="6" height="6" rx="3" fill="currentColor"/></svg>
                        <span class="bold"><?php $ausql = "SELECT COUNT(id) AS au FROM customers__deactivated"; $aures = $con->query($ausql); $au = $aures->fetch_assoc(); $auc = $au['au']; echo $auc; ?></span>
                    </div>
                    <span class="text-secondary small">Deaktivált</span>
                </div>
                <div class="flex flex-col gap-025 border-soft padding-05 background-bg border-secondary-dotted text-primary">
                    <div class="flex flex-row flex-align-c gap-05 larger">
                        <svg width="28" height="28" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M16.0173 9H15.3945C14.2833 9 13.263 9.61425 12.7431 10.5963L12.154 11.7091C12.0645 11.8781 12.1072 12.0868 12.2559 12.2071L12.6402 12.5183C13.2631 13.0225 13.7556 13.6691 14.0764 14.4035L14.2321 14.7601C14.2957 14.9058 14.4396 15 14.5987 15H18.6747C19.7297 15 20.4057 13.8774 19.912 12.945L18.6686 10.5963C18.1487 9.61425 17.1285 9 16.0173 9Z" fill="currentColor"/><rect opacity="0.3" x="14" y="4" width="4" height="4" rx="2" fill="currentColor"/><path d="M4.65486 14.8559C5.40389 13.1224 7.11161 12 9 12C10.8884 12 12.5961 13.1224 13.3451 14.8559L14.793 18.2067C15.3636 19.5271 14.3955 21 12.9571 21H5.04292C3.60453 21 2.63644 19.5271 3.20698 18.2067L4.65486 14.8559Z" fill="currentColor"/><rect opacity="0.3" x="6" y="5" width="6" height="6" rx="3" fill="currentColor"/></svg>
                        <span class="bold"><?php $ausql = "SELECT COUNT(id) AS au FROM customers WHERE DATE(NOW()) = DATE(date)"; $aures = $con->query($ausql); $au = $aures->fetch_assoc(); $auc = $au['au']; echo $auc; ?></span>
                    </div>
                    <span class="text-secondary small">Ma regisztált</span>
                </div>
            </div>
            <div class="flex flex-row gap-05">
                <div class="flex flex-row flex-wrap-no" id="curron__con">
                    <?php
                        $ausql = "SELECT initials, color FROM customers__header LIMIT 15"; $aures = $con->query($ausql);
                        while ($au = $aures->fetch_assoc()) { $init = $au['initials']; $color = $au['color'];
                            echo '
                            <span class="flex flex-row flex-align-c flex-justify-con-c bold text-white box-shadow curron__head circle padding-05 small" style="background-color: #'.$color.'">'.$init.'</span>
                            ';
                        } if ($aures->num_rows > 15) {
                            echo '
                                <span class="flex flex-row flex-align-c flex-justify-con-c bold box-shadow curron__head circle padding-05 small white-contrast-pf">+'.(($aures->num_rows)-15).'</span>
                            ';
                        }
                    ?>
                </div>
            </div>
        </div>
    </div>
    <div class="flex flex-row-d-col-m flex-align-c flex-justify-con-sb border-soft border-primary-light-dotted primary-bg padding-105 w-fa">
        <div class="flex flex-row-d-col-m flex-align-c gap-1 w-fa">
            <div class="flex flex-row flex-align-c gap-1 w-fa">
                <div class="flex flex-col flex-align-c flex-justify-con-fs gap-05 w-fa">
                    <div class="flex flex-row flex-align-c flex-justify-con-sb gap-1 w-fa">
                        <span class="bold w-fa">Felhasználó Regisztrálása</span>
                        <div class="flex flex-col flex-align-fe" onclick="document.getElementById('tabs-credit').click();">
                            <span class="primary-dark-bg padding-05 border-soft text-secondary small user-select-none pointer" onclick="registerUser();">Regisztrálás</span>
                        </div>
                    </div>
                    <span class="text-secondary small-med w-fa text-align-l">Új felhasználó regisztrálása az oldalra</span>
                </div>
            </div>
        </div>
    </div>
    <div class="flex flex-row flex-align-c flex-justify-con-c flex-wrap w-fa gap-1">
        <div class="flex flex-row flex-align-c flex-justify-con-c flex-wrap w-fa gap-1" id="users-con"></div>
    </div>
</div>
<script>
    function __loadusers (layout) {
        $.ajax({ enctype: "multipart/form-data", type: "POST", url: "/admin/assets/users/crd-inf.php", dataType: 'json', contentType: false, processData: false,
            beforeSend: function () {
                document.getElementById('users-con').innerHTML = `
                <div class="flex flex-col flex-align-c w-fa gap-05 text-muted">
                    <span><svg class='wizard_input_loading' xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="128" height="128" viewBox="0 0 24 24" version="1.1"><g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"><g><polygon points="0 0 24 0 24 24 0 24"/></g><path d="M12,4 L12,6 C8.6862915,6 6,8.6862915 6,12 C6,15.3137085 8.6862915,18 12,18 C15.3137085,18 18,15.3137085 18,12 C18,10.9603196 17.7360885,9.96126435 17.2402578,9.07513926 L18.9856052,8.09853149 C19.6473536,9.28117708 20,10.6161442 20,12 C20,16.418278 16.418278,20 12,20 C7.581722,20 4,16.418278 4,12 C4,7.581722 7.581722,4 12,4 Z" class="svg" fill-rule="nonzero" opacity="0.4" transform="translate(12.000000, 12.000000) scale(-1, 1) translate(-12.000000, -12.000000) "/></g></svg></span>
                    <span>Felhasználók megjelenítése folyamatban</span>
                </div>
                `;
            }, success: function(data) {
                switch (layout) {
                    case 'card': document.getElementById('users-con').innerHTML = ``; document.getElementById('load-card').classList.add('primary-bg'); document.getElementById('load-card').classList.remove('primary-bg-hover'); document.getElementById('load-list').classList.remove('primary-bg'); document.getElementById('load-list').classList.add('primary-bg-hover');
                        for (let i = 0; i < data.length; i++) {
                            document.getElementById('users-con').innerHTML += `
                            <div class="flex flex-col flex-justify-con-c flex-align-c border-soft item-bg padding-05 w-40d-100m box-shadow">
                                <div class="flex flex-row flex-align-c flex-justify-con-sb flex-wrap gap-05 w-fa">
                                    <?php
                                        if ($privilege == 2) {
                                            echo '<span class="primary-bg primary-bg-hover padding-05 border-soft-light small-med pointer user-select-none" onclick="__moderate(${data[i].uid})">Moderálás</span>';
                                        }
                                    ?>
                                    <div class="flex flex-row gap-1" id="user-alert-con-${data[i].uid}"></div>
                                </div>
                                <div class="flex flex-col flex-justify-con-c flex-align-c gap-1">
                                    <div class="flex flex-col flex-align-c gap-05">
                                        <span class="flex flex-row flex-align-c flex-justify-con-c bold text-white curron__head circle padding-1 large relative" title="${data[i].name}" style="background-color: #${data[i].color}; width: 2rem !important; height: 2rem !important;">
                                            ${data[i].initials}
                                            <span class="flex flex-col flex-align-c flex-justify-con-c box-shadow absolute badge-small border-soft status-indicator background-bg text-primary smaller bold" style="bottom: 0px; right: 0px;">3 perce</span>
                                        </span>
                                        <div class="flex flex-col flex-align-c gap-025">
                                            <span class="text-primary bold large">${data[i].name}</span>
                                            <span class="text-muted small">${data[i].email}</span>
                                        </div>
                                    </div>
                                    <div class="flex flex-row flex-align-c flex-justify-con-c gap-1 flex-wrap">
                                        <div class="flex flex-col flex-justify-con-c flex-align-c gap-025 border-soft padding-05 background-bg border-secondary-dotted text-primary">
                                            <div class="flex flex-row flex-align-c gap-05">
                                                <span class="bold">${data[i].orders}</span>
                                            </div>
                                            <span class="text-secondary small">Rendelések</span>
                                        </div>
                                        <div class="flex flex-col flex-justify-con-c flex-align-c gap-025 border-soft padding-05 background-bg border-secondary-dotted text-primary">
                                            <div class="flex flex-row flex-align-c gap-05">
                                                <span class="bold">${data[i].reviews}</span>
                                            </div>
                                            <span class="text-secondary small">Értékelések</span>
                                        </div>
                                        <div class="flex flex-col flex-justify-con-c flex-align-c gap-025 border-soft padding-05 background-bg border-secondary-dotted text-primary">
                                            <div class="flex flex-row flex-align-c gap-05">
                                                <span class="bold">${data[i].cards}</span>
                                            </div>
                                            <span class="text-secondary small">Kártyák</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            `;
                            if (Number(data[i].emailvaild) === 0) { document.getElementById('user-alert-con-'+data[i].uid).innerHTML += `<div class="text-warning-light"><svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 24 24" fill="none"><rect opacity="0.3" x="2" y="2" width="20" height="20" rx="10" fill="currentColor"></rect><rect x="11" y="14" width="7" height="2" rx="1" transform="rotate(-90 11 14)" fill="currentColor"></rect><rect x="11" y="17" width="2" height="2" rx="1" transform="rotate(-90 11 17)" fill="currentColor"></rect></svg></div>`; }
                            
                        }
                    break;
                    case 'list': document.getElementById('load-list').classList.add('primary-bg'); document.getElementById('load-list').classList.remove('primary-bg-hover'); document.getElementById('load-card').classList.remove('primary-bg'); document.getElementById('load-card').classList.add('primary-bg-hover');
                        document.getElementById('users-con').innerHTML = `
                        <div class="flex flex-row w-fa overflow-x-scroll hide-scroll item-bg box-shadow border-soft">
                            <table class="sess__history text-muted text-align-c w-fa item-bg padding-05 table-padding-05 table-fixed compare-table text-align-c" style="border-collapse: collapse;" id="users-table">
                                <tr class="small uppercase sessh__header" style="line-height: 2;">
                                    <th>ID</th>
                                    <th>Név</th>
                                    <th>Rendelések</th>
                                    <th>Értékelések</th>
                                    <th>Kártyák</th>
                                    <th></th>
                                </tr>
                            </table>
                        `;
                        for (let i = 0; i < data.length; i++) {
                            document.getElementById('users-table').innerHTML += `
                                <tr class="sessh__body small" id="user-row-${data[i].uid}">
                                    <td>
                                        <div class="flex flex-row flex-align-c flex-justify-con-c gap-05" id="user-id-${data[i].uid}">
                                            <span>${data[i].uid}</span>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="flex flex-col">
                                            <span class="text-secondary">${data[i].name}</span>
                                            <span class="text-muted small-med">${data[i].email}</span>
                                        </div>
                                    </td>
                                    <td>${data[i].orders}</td>
                                    <td>${data[i].reviews}</td>
                                    <td>${data[i].cards}</td>
                                    <td id="user-cnf-${data[i].uid}"></td>
                                </tr>
                            `; if (Number(data[i].emailvaild) === 0) { document.getElementById('user-id-'+data[i].uid).innerHTML += `<div class="text-warning-light"><svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none"><rect opacity="0.3" x="2" y="2" width="20" height="20" rx="10" fill="currentColor"></rect><rect x="11" y="14" width="7" height="2" rx="1" transform="rotate(-90 11 14)" fill="currentColor"></rect><rect x="11" y="17" width="2" height="2" rx="1" transform="rotate(-90 11 17)" fill="currentColor"></rect></svg></div>`; }   
                            if (data[i].uid == <?= $uid; ?>) {
                                document.getElementById('user-row-'+data[i].uid).style.border = "2px solid #A1A5B7";
                                document.getElementById('user-row-'+data[i].uid).classList.add('background-bg');
                                document.getElementById('user-row-'+data[i].uid).classList.add('bold');
                            } <?php
                                if ($privilege == 2) {
                                    echo '
                                        document.getElementById("user-cnf-"+data[i].uid).innerHTML = `<span class="text-primary pointer" title="Moderálás" onclick="__moderate(${data[i].uid})"><svg width="18" height="18" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path opacity="0.3" d="M22.1 11.5V12.6C22.1 13.2 21.7 13.6 21.2 13.7L19.9 13.9C19.7 14.7 19.4 15.5 18.9 16.2L19.7 17.2999C20 17.6999 20 18.3999 19.6 18.7999L18.8 19.6C18.4 20 17.8 20 17.3 19.7L16.2 18.9C15.5 19.3 14.7 19.7 13.9 19.9L13.7 21.2C13.6 21.7 13.1 22.1 12.6 22.1H11.5C10.9 22.1 10.5 21.7 10.4 21.2L10.2 19.9C9.4 19.7 8.6 19.4 7.9 18.9L6.8 19.7C6.4 20 5.7 20 5.3 19.6L4.5 18.7999C4.1 18.3999 4.1 17.7999 4.4 17.2999L5.2 16.2C4.8 15.5 4.4 14.7 4.2 13.9L2.9 13.7C2.4 13.6 2 13.1 2 12.6V11.5C2 10.9 2.4 10.5 2.9 10.4L4.2 10.2C4.4 9.39995 4.7 8.60002 5.2 7.90002L4.4 6.79993C4.1 6.39993 4.1 5.69993 4.5 5.29993L5.3 4.5C5.7 4.1 6.3 4.10002 6.8 4.40002L7.9 5.19995C8.6 4.79995 9.4 4.39995 10.2 4.19995L10.4 2.90002C10.5 2.40002 11 2 11.5 2H12.6C13.2 2 13.6 2.40002 13.7 2.90002L13.9 4.19995C14.7 4.39995 15.5 4.69995 16.2 5.19995L17.3 4.40002C17.7 4.10002 18.4 4.1 18.8 4.5L19.6 5.29993C20 5.69993 20 6.29993 19.7 6.79993L18.9 7.90002C19.3 8.60002 19.7 9.39995 19.9 10.2L21.2 10.4C21.7 10.5 22.1 11 22.1 11.5ZM12.1 8.59998C10.2 8.59998 8.6 10.2 8.6 12.1C8.6 14 10.2 15.6 12.1 15.6C14 15.6 15.6 14 15.6 12.1C15.6 10.2 14 8.59998 12.1 8.59998Z" fill="currentColor"/><path d="M17.1 12.1C17.1 14.9 14.9 17.1 12.1 17.1C9.30001 17.1 7.10001 14.9 7.10001 12.1C7.10001 9.29998 9.30001 7.09998 12.1 7.09998C14.9 7.09998 17.1 9.29998 17.1 12.1ZM12.1 10.1C11 10.1 10.1 11 10.1 12.1C10.1 13.2 11 14.1 12.1 14.1C13.2 14.1 14.1 13.2 14.1 12.1C14.1 11 13.2 10.1 12.1 10.1Z" fill="currentColor"/></svg></span>`;
                                    ';
                                }
                            ?>
                        }
                    break;
                }
            }, error: function (data) { console.log(data); }
        });
    } __loadusers('list');
    function __moderate (uid) {
        window.location.href = "/admin/moderate/"+uid+'/';
    }
    function registerUser() {
        openHeaderProfileAction();
        setTimeout(() => {
            openRegisterForm();
            setTimeout(() => {
                document.getElementById('wizard_back_to_main').setAttribute('onclick', 'closeHeaderProfileAction()');
            }, 100);
        }, 100);
    }
</script>