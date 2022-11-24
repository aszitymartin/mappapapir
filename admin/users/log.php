<?php include($_SERVER['DOCUMENT_ROOT'].'/includes/inc.php');
if (isset($_SESSION['loggedin'])) { $stmt = $con->prepare('SELECT privilege FROM customers__priv  WHERE uid = ?'); if (isset($_SESSION['loggedin'])) {$id = $_SESSION['id'];} $stmt->bind_param('i', $id);$stmt->execute(); $stmt->bind_result($privilege); $stmt->fetch();$stmt->close();
if ($privilege != 2) { echo "<script>window.location.href='/';</script>"; } } else { header("Location: /"); } $guid = $_SESSION['guid']; $gname = $_SESSION['gname']; ?>
<div class="flex flex-col gap-1">
    <div class="flex flex-col w-fa gap-1 border-soft item-bg box-shadow padding-1">
        <div class="flex flex-row flex-align-c flex-justify-con-sb">
            <span class="text-primary large bold">Tevékenységnapló</span>
            <div class="flex flex-row flex-align-c gap-1">
                <span class="flex flex-col flex-align-c padding-025 text-muted primary-bg-hover border-soft pointer" id="open-log-search" aria-label="Keresés" title="Keresés">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><rect opacity="0.5" x="17.0365" y="15.1223" width="8.15546" height="2" rx="1" transform="rotate(45 17.0365 15.1223)" fill="currentColor"></rect><path d="M11 19C6.55556 19 3 15.4444 3 11C3 6.55556 6.55556 3 11 3C15.4444 3 19 6.55556 19 11C19 15.4444 15.4444 19 11 19ZM11 5C7.53333 5 5 7.53333 5 11C5 14.4667 7.53333 17 11 17C14.4667 17 17 14.4667 17 11C17 7.53333 14.4667 5 11 5Z" fill="currentColor"></path></svg>
                </span>
            </div>
        </div><br>
        <div class="flex flex-col flex-align-c gap-1">
            <div class="flex flex-col flex-align-c gap-1 w-100" id="log-con">
            <?php
                $sql = "SELECT * FROM log WHERE uid = $guid ORDER BY DATE DESC"; $res = $con->query($sql);
                if ($res->num_rows > 0) {
                    while ($log = $res->fetch_assoc()) {
                        echo '
                        <div class="flex flex-row gap-1 w-fa">
                            <label search-key="'.$log['category'].' '.$log['ip'].' '.$log['date'].'"></label>
                            <div class="flex flex-col flex-align-c flex-justify-con-c padding-05 border-soft background-bg gap-025" style="min-width: 3rem;">';
                                if (strpos($log['category'], "Termék") !== false) { echo '<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="38px" height="38px" viewBox="0 0 24 24" version="1.1"><g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"><rect x="0" y="0" width="24" height="24"></rect><path d="M4,6 L20,6 C20.5522847,6 21,6.44771525 21,7 L21,8 C21,8.55228475 20.5522847,9 20,9 L4,9 C3.44771525,9 3,8.55228475 3,8 L3,7 C3,6.44771525 3.44771525,6 4,6 Z M5,11 L10,11 C10.5522847,11 11,11.4477153 11,12 L11,19 C11,19.5522847 10.5522847,20 10,20 L5,20 C4.44771525,20 4,19.5522847 4,19 L4,12 C4,11.4477153 4.44771525,11 5,11 Z M14,11 L19,11 C19.5522847,11 20,11.4477153 20,12 L20,19 C20,19.5522847 19.5522847,20 19,20 L14,20 C13.4477153,20 13,19.5522847 13,19 L13,12 C13,11.4477153 13.4477153,11 14,11 Z" class="svg"></path><path d="M14.4452998,2.16794971 C14.9048285,1.86159725 15.5256978,1.98577112 15.8320503,2.4452998 C16.1384028,2.90482849 16.0142289,3.52569784 15.5547002,3.83205029 L12,6.20185043 L8.4452998,3.83205029 C7.98577112,3.52569784 7.86159725,2.90482849 8.16794971,2.4452998 C8.47430216,1.98577112 9.09517151,1.86159725 9.5547002,2.16794971 L12,3.79814957 L14.4452998,2.16794971 Z" class="svg" fill-rule="nonzero" opacity="0.3"></path></g></svg><span class="text-muted smaller-light">Termékek</span>'; }
                                else if (strpos($log['category'], "Felhasználó") !== false || strpos($log['category'], "Regisztráció") !== false) { echo '<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="38px" height="38px" viewBox="0 0 24 24" version="1.1"><g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"><polygon points="0 0 24 0 24 24 0 24"></polygon><path d="M12,11 C9.790861,11 8,9.209139 8,7 C8,4.790861 9.790861,3 12,3 C14.209139,3 16,4.790861 16,7 C16,9.209139 14.209139,11 12,11 Z" class="svg" fill-rule="nonzero" opacity="0.3"></path><path d="M3.00065168,20.1992055 C3.38825852,15.4265159 7.26191235,13 11.9833413,13 C16.7712164,13 20.7048837,15.2931929 20.9979143,20.2 C21.0095879,20.3954741 20.9979143,21 20.2466999,21 C16.541124,21 11.0347247,21 3.72750223,21 C3.47671215,21 2.97953825,20.45918 3.00065168,20.1992055 Z" class="svg" fill-rule="nonzero"></path></g></svg><span class="text-muted smaller-light">Fiók</span>'; }
                                echo '
                            </div>
                            <div class="flex flex-col gap-025">
                                <span class="text-primary bold small" style="line-height: 2">'.$log['category'].'</span>
                                <span class="text-muted small-med">'; if (strlen($log['description']) >= 65) { echo mb_substr($log['description'], 0, 65) . '...'; } else { echo $log['description']; } echo '</span>
                                <div class="flex flex-row flex-align-c gap-025 text-muted small-med">
                                    <span>'.$log['ip'].'</span>
                                    <span> · </span>
                                    <span>'.$log['date'].'</span>
                                    '; if (strlen($log['description']) >= 65) { echo '<span> · </span><span class="text-primary user-select-none link pointer" onclick="__showexpanded('.$log['id'].')">Megtekintés</span>'; } echo '
                                </div>
                            </div>
                        </div>';
                    }
                } else { echo '<div class="text-align-c"><div class="flex flex-col flex-align-c flex-justify-con-c gap-1"><span><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="8rem" height="8rem" viewBox="0 0 24 24" version="1.1"><g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"><rect x="0" y="0" width="24" height="24"/><path d="M10.9630156,7.5 L11.0475062,7.5 C11.3043819,7.5 11.5194647,7.69464724 11.5450248,7.95024814 L12,12.5 L15.2480695,14.3560397 C15.403857,14.4450611 15.5,14.6107328 15.5,14.7901613 L15.5,15 C15.5,15.2109164 15.3290185,15.3818979 15.1181021,15.3818979 C15.0841582,15.3818979 15.0503659,15.3773725 15.0176181,15.3684413 L10.3986612,14.1087258 C10.1672824,14.0456225 10.0132986,13.8271186 10.0316926,13.5879956 L10.4644883,7.96165175 C10.4845267,7.70115317 10.7017474,7.5 10.9630156,7.5 Z" class="svg"/><path d="M7.38979581,2.8349582 C8.65216735,2.29743306 10.0413491,2 11.5,2 C17.2989899,2 22,6.70101013 22,12.5 C22,18.2989899 17.2989899,23 11.5,23 C5.70101013,23 1,18.2989899 1,12.5 C1,11.5151324 1.13559454,10.5619345 1.38913364,9.65805651 L3.31481075,10.1982117 C3.10672013,10.940064 3,11.7119264 3,12.5 C3,17.1944204 6.80557963,21 11.5,21 C16.1944204,21 20,17.1944204 20,12.5 C20,7.80557963 16.1944204,4 11.5,4 C10.54876,4 9.62236069,4.15592757 8.74872191,4.45446326 L9.93948308,5.87355717 C10.0088058,5.95617272 10.0495583,6.05898805 10.05566,6.16666224 C10.0712834,6.4423623 9.86044965,6.67852665 9.5847496,6.69415008 L4.71777931,6.96995273 C4.66931162,6.97269931 4.62070229,6.96837279 4.57348157,6.95710938 C4.30487471,6.89303938 4.13906482,6.62335149 4.20313482,6.35474463 L5.33163823,1.62361064 C5.35654118,1.51920756 5.41437908,1.4255891 5.49660017,1.35659741 C5.7081375,1.17909652 6.0235153,1.2066885 6.2010162,1.41822583 L7.38979581,2.8349582 Z" class="svg" opacity="0.3"/></g></svg></span><span class="text-secondary text-small flex flex-col flex-align-c flex-justify-con-c"><span>Úgy tűnik, hogy '.$gname.' nem rendelkezik feljegyzett tevékenységgel.</span></div></div>'; }
            ?><div id="lgsnr"></div>
            </div>
        </div>
    </div>
</div>
<script content-type="application/javascript">
    $('#open-log-search').click(() => {
        var c__wrapper = document.createElement('div'); c__wrapper.classList = "wrapper_dark fadein"; var c__box = document.createElement('div'); c__box.classList = "d__confirm popup fixed flex flex-col border-soft item-bg box-shadow padding-1";
        c__wrapper.classList.add('fadein'); c__wrapper.classList.remove('fadeout'); c__box.classList.add('padding-t-0'); c__box.classList.add('popup'); c__box.classList.remove('popout'); document.body.append(c__wrapper); c__wrapper.append(c__box); $('html').css("overflow-y", "hidden");
        c__box.innerHTML = `
        <div class="flex flex-row flex-align-c flex-justify-con-sb padding-t-1" id="cbh__con">
            <span class="text-primary small bold">Tevékenység keresése</span>
            <div class="flex flex-row flex-align-c gap-05">
                <span class="text-primary pointer" aria-label="Bezárás" id="cl__box"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"><rect opacity="0.3" x="2" y="2" width="20" height="20" rx="5" fill="currentColor"/><rect x="7" y="15.3137" width="12" height="2" rx="1" transform="rotate(-45 7 15.3137)" fill="currentColor"/><rect x="8.41422" y="7" width="12" height="2" rx="1" transform="rotate(45 8.41422 7)" fill="currentColor"/></svg></span>
            </div>
        </div><br>
        <div class="flex flex-col gap-2">
            <div class="flex flex-col flex-align-c flex-justify-con-c text-align-c text-muted user-select-none w-fa">
                <div id="rm-st-bmi-svg">
                    <svg width="128" height="128" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><rect opacity="0.5" x="17.0365" y="15.1223" width="8.15546" height="2" rx="1" transform="rotate(45 17.0365 15.1223)" fill="currentColor"></rect><path d="M11 19C6.55556 19 3 15.4444 3 11C3 6.55556 6.55556 3 11 3C15.4444 3 19 6.55556 19 11C19 15.4444 15.4444 19 11 19ZM11 5C7.53333 5 5 7.53333 5 11C5 14.4667 7.53333 17 11 17C14.4667 17 17 14.4667 17 11C17 7.53333 14.4667 5 11 5Z" fill="currentColor"></path></svg>
                </div>
                <div class="flex flex-col flex-justify-con-c flex-align-c gap-1 w-fa">
                    <div class="flex flex-row w-80">
                        <input type="text" class="adm__input w-fa outline-none border-soft text-secondary bold" id="log-search-input" placeholder="Tevékenység keresése" autocomplete="off">
                    </div>
                    <div style="font-size: .8rem !important;">
                        <span>Keressen a tevékenységek között a következők alapján:</span>
                        <div class="flex flex-row flex-align-c flex-justify-con-c gap-025 w-fa">
                            <span>Kategória</span>
                            <span> · </span>
                            <span>IP cím</span>
                            <span> · </span>
                            <span>Dátum</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="flex flex-row flex-align-c flex-justify-con-fe gap-1 user-select-none" style="font-size: .7rem !important;">
                <span class="text-primary pointer user-select-none link small-med" onclick="document.getElementById('cl__box').click()">Bezárás</span>
                <span class="primary-bg primary-bg-hover border-soft-light padding-05 user-select-none pointer" onclick="__searchlog()">Keresés</span>
            </div>
        </div>
        `;
        var con = document.getElementById('cbh__con');var mc = new Hammer(con);mc.get('pan').set({ direction: Hammer.DIRECTION_ALL });mc.on("pandown", function(ev) { $('#cl__box').click(); });
        $('#cl__box').click(function () { c__wrapper.classList.add('fadeout'); c__box.classList.add('popout'); setTimeout(() => { c__wrapper.remove(); $('html').css("overflow-y", "unset"); }, 200); });
    });
    function __showexpanded (id) { var exData = new FormData(); exData.append('id', id);
        var c__wrapper = document.createElement('div'); c__wrapper.classList = "wrapper_dark fadein"; var c__box = document.createElement('div'); c__box.classList = "d__confirm popup fixed flex flex-col border-soft item-bg box-shadow padding-1";
        c__wrapper.classList.add('fadein'); c__wrapper.classList.remove('fadeout'); c__box.classList.add('padding-t-0'); c__box.classList.add('popup'); c__box.classList.remove('popout'); document.body.append(c__wrapper); c__wrapper.append(c__box); $('html').css("overflow-y", "hidden");
        c__box.innerHTML = `
        <div class="flex flex-col w-fa gap-1">
            <div class="flex flex-row flex-align-c flex-justify-con-sb padding-t-1" id="cbh__con">
                <span class="text-primary small bold" id="c_title"></span>
                <div class="flex flex-row flex-align-c gap-05">
                    <span class="text-primary pointer" aria-label="Bezárás" id="cl__box"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"><rect opacity="0.3" x="2" y="2" width="20" height="20" rx="5" fill="currentColor"/><rect x="7" y="15.3137" width="12" height="2" rx="1" transform="rotate(-45 7 15.3137)" fill="currentColor"/><rect x="8.41422" y="7" width="12" height="2" rx="1" transform="rotate(45 8.41422 7)" fill="currentColor"/></svg></span>
                </div>
            </div>
            <div class="flex flex-col gap-2 hide-scroll" id="c_body" style="max-height: 40vh !important; overflow-y: scroll;">
                <div class="flex flex-col flex-align-c flex-justify-con-c text-align-c text-muted user-select-none w-fa">
                    <div id="rm-st-bmi-svg">
                        <svg class='wizard_input_loading' xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="64" height="64" viewBox="0 0 24 24" version="1.1"><g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"><g><polygon points="0 0 24 0 24 24 0 24"/></g><path d="M12,4 L12,6 C8.6862915,6 6,8.6862915 6,12 C6,15.3137085 8.6862915,18 12,18 C15.3137085,18 18,15.3137085 18,12 C18,10.9603196 17.7360885,9.96126435 17.2402578,9.07513926 L18.9856052,8.09853149 C19.6473536,9.28117708 20,10.6161442 20,12 C20,16.418278 16.418278,20 12,20 C7.581722,20 4,16.418278 4,12 C4,7.581722 7.581722,4 12,4 Z" class="svg" fill-rule="nonzero" opacity="0.4" transform="translate(12.000000, 12.000000) scale(-1, 1) translate(-12.000000, -12.000000) "/></g></svg>
                    </div>
                    <span style="font-size: .9rem !important;">Adatok betöltése folyamatban.</span>
                </div>
            </div>
            <div class="flex flex-row flex-align-c flex-justify-con-fe gap-1 user-select-none" style="font-size: .7rem !important;">
                <span class="text-primary pointer user-select-none link small-med" onclick="document.getElementById('cl__box').click()">Bezárás</span>
            </div>
        </div>
        `;
        $.ajax({ enctype: "multipart/form-data", type: "POST", url: "/admin/users/log/data.php", data: exData, dataType: "json", contentType: false, processData: false,
            success: function(data) {
                document.getElementById('c_title').innerHTML = data.category;
                document.getElementById('c_body').innerHTML = `<span class="text-muted" style="font-size: .8rem;">${data.description}</span>`;
            }, error: function (data) {
                document.getElementById('c_body').innerHTML = `
                <div class="flex flex-col flex-align-c flex-justify-con-c text-align-c text-muted user-select-none w-fa">
                    <div id="rm-st-bmi-svg">
                        <svg width="128" height="128" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><rect opacity="0.5" x="17.0365" y="15.1223" width="8.15546" height="2" rx="1" transform="rotate(45 17.0365 15.1223)" fill="currentColor"></rect><path d="M11 19C6.55556 19 3 15.4444 3 11C3 6.55556 6.55556 3 11 3C15.4444 3 19 6.55556 19 11C19 15.4444 15.4444 19 11 19ZM11 5C7.53333 5 5 7.53333 5 11C5 14.4667 7.53333 17 11 17C14.4667 17 17 14.4667 17 11C17 7.53333 14.4667 5 11 5Z" fill="currentColor"></path></svg>
                    </div>
                    <span style="font-size: .9rem !important;">Hiba történt az adatok betöltése közben.</span>
                </div>
                `;
            }
        });
        var con = document.getElementById('cbh__con');var mc = new Hammer(con);mc.get('pan').set({ direction: Hammer.DIRECTION_ALL });mc.on("pandown", function(ev) { $('#cl__box').click(); });
        $('#cl__box').click(function () { c__wrapper.classList.add('fadeout'); c__box.classList.add('popout'); setTimeout(() => { c__wrapper.remove(); $('html').css("overflow-y", "unset"); }, 200); });
    } function __searchlog () {
        var input, filter, con, item, i, txtValue; input = document.getElementById("log-search-input");filter = input.value.toUpperCase();
        con = document.getElementById("log-con");item = con.getElementsByTagName("label"); $('#cl__box').click();
        for (i = 0; i < item.length; i++) {txtValue = item[i].getAttribute('search-key');
            if (txtValue.toUpperCase().indexOf(filter) > -1) { item[i].parentNode.style.display = ""; document.getElementById('lgsnr').innerHTML = ``; }
            else { item[i].parentNode.style.display = "none";
                document.getElementById('lgsnr').innerHTML = `
                <div class="flex flex-col flex-align-c flex-justify-con-c gap-1 w-fa text-muted user-select-none">
                    <svg width="128" height="128" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><rect opacity="0.5" x="17.0365" y="15.1223" width="8.15546" height="2" rx="1" transform="rotate(45 17.0365 15.1223)" fill="currentColor"></rect><path d="M11 19C6.55556 19 3 15.4444 3 11C3 6.55556 6.55556 3 11 3C15.4444 3 19 6.55556 19 11C19 15.4444 15.4444 19 11 19ZM11 5C7.53333 5 5 7.53333 5 11C5 14.4667 7.53333 17 11 17C14.4667 17 17 14.4667 17 11C17 7.53333 14.4667 5 11 5Z" fill="currentColor"></path></svg>
                    <span class="small">Nem találtunk feljegyzést, a következő keresésre: "<strong>${filter}</strong>"</span>
                    <span class="text-primary small-med link pointer" onclick="$('#tabs-log').click();">Keresési feltétel eltávolítása</span>
                </div>
                `;
            }
        }
    }
</script>