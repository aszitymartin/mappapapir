<?php require_once($_SERVER['DOCUMENT_ROOT'].'/includes/inc.php');
if (isset($_SESSION['loggedin'])) {
    $stmt = $con->prepare('SELECT privilege FROM customers__priv  WHERE uid = ?'); if (isset($_SESSION['loggedin'])) {$id = $_SESSION['id'];} $stmt->bind_param('i', $id);$stmt->execute(); $stmt->bind_result($privilege); $stmt->fetch();$stmt->close();
    if ($privilege != 2) { echo "<script>window.location.href='/';</script>"; }
} else { header("Location: /"); }
$uid = $_SESSION['guid']; ?>
<div class="flex flex-row-d-col-m gap-1">
    <div class="flex flex-col w-fa gap-1 border-soft item-bg box-shadow padding-1">
        <div class="flex flex-row flex-align-c flex-justify-con-sb">
            <div class="flex flex-col">
                <span class="text-primary small bold">Email beállítésok</span>
                <span class="text-secondary smaller-light">Szerkessze email beállításait.</span>
            </div>
            <div class="flex flex-row flex-align-c gap-1">
                <span class="text-muted small-med pointer user-select-none link" id="prcc__email">Mégsem</span>
                <span class="flex flex-row flex-align-c flex-justify-con-c padding-05 border-soft-light primary-bg primary-bg-hover pointer user-select-none small-med" id="prsv__email">Mentés</span>
            </div>
        </div><hr style="border: 1px solid var(--background);" class="w-fa">
        <div class="flex flex-col gap-2">
            <div class="flex flex-col gap-2">
                <span class="text-primary bold">E-mail értesítés beállítása</span>
                <div class="flex flex-col gap-1">
                    <?php
                    if ($stmt = $con->prepare('SELECT * FROM u__email WHERE uid = ?')) { $stmt->bind_param('i', $uid); $stmt->execute(); $result = $stmt->get_result(); $data = $result->fetch_assoc();
                        if ($data['valid'] == false) {
                            echo '
                            <div class="flex flex-row-d-col-m flex-align-c prst__row">
                                <div class="flex flex-row flex-align-c gap-1 w-20d-100m prst__trig">
                                    <span class="text-primary small">Email cím hitelesítése</span>
                                    <div class="flex">
                                        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="18px" height="18px" viewBox="0 0 24 24" version="1.1"><g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"><rect x="0" y="0" width="24" height="24"/><path d="M11.1669899,4.49941818 L2.82535718,19.5143571 C2.557144,19.9971408 2.7310878,20.6059441 3.21387153,20.8741573 C3.36242953,20.9566895 3.52957021,21 3.69951446,21 L21.2169432,21 C21.7692279,21 22.2169432,20.5522847 22.2169432,20 C22.2169432,19.8159952 22.1661743,19.6355579 22.070225,19.47855 L12.894429,4.4636111 C12.6064401,3.99235656 11.9909517,3.84379039 11.5196972,4.13177928 C11.3723594,4.22181902 11.2508468,4.34847583 11.1669899,4.49941818 Z" fill="#F64E60" opacity="0.3"/><rect fill="#F64E60" x="11" y="9" width="2" height="7" rx="1"/><rect fill="#F64E60" x="11" y="17" width="2" height="2" rx="1"/></g></svg>
                                    </div>
                                </div>
                                <div class="flex flex-col mw-60d-100m gap-05">
                                    <div class="flex flex-row flex-align-c">
                                        <span class="primary-bg primary-bg-hover border-soft padding-05 user-select-none pointer small-med" id="conf__email">E-mail megerősítése</span>
                                    </div>
                                    <span class="text-secondary smaller-light w-60d-90m">Email-címének hitelesítése még nem történt meg. Email-címének megerősítésével lehetősége nyílik, hogy fiókját vissza tudja állítani.</span>
                                </div>
                            </div>
                            ';
                        }
                    }
                    ?>
                    <div class="flex flex-row flex-align-c prst__row">
                        <span class="text-primary small prst__trig">Email értesítések</span>
                        <div class="flex flex-col">
                            <label class="switch switch-smaller">
                                <input type="checkbox" checked="checked" id="em__notif">
                                <span class="slider slider-smaller round"></span>
                            </label>
                        </div>
                    </div>
                    <div class="flex flex-row flex-align-c prst__row">
                        <span class="text-primary small prst__trig">Másolat személyes e-mailre</span>
                        <div class="flex flex-col">
                            <label class="switch switch-smaller">
                                <input type="checkbox" disabled>
                                <span class="slider slider-smaller round"></span>
                            </label>
                        </div>
                    </div>
                    <div class="flex flex-row flex-align-c prst__row">
                        <span class="text-primary small prst__trig">Ismeretlen bejelentkezés</span>
                        <div class="flex flex-col">
                            <label class="switch switch-smaller">
                                <input type="checkbox" checked="checked" id="em__notif">
                                <span class="slider slider-smaller round"></span>
                            </label>
                        </div>
                    </div>
                </div>
            </div>
            <div class="flex flex-col gap-2">
                <div class="flex flex-col gap-2">
                    <div class="flex flex-row flex-align-c flex-justify-con-sb-m prst__row">
                        <span class="text-primary small prst__trig w-fc-m">Email küldése</span>
                        <div class="flex flex-col gap-1">
                            <div class="flex flex-row flex-align-c gap-05">
                                <label class="checkbox__con flex flex-align-c">
                                    <label class="text-secondary small-med pointer user-select-none" for="sm__new__notify">Új értesítés esetén</label>
                                    <input type="checkbox" name="sm__new__notify" id="sm__new__notify" />
                                    <span class="ch__checkmark"></span>
                                </label>
                            </div>
                            <div class="flex flex-row flex-align-c gap-05">
                                <label class="checkbox__con flex flex-align-c">
                                    <label class="text-secondary small-med pointer user-select-none" for="sm__upd__profile">Fiók frissítése esetén</label>
                                    <input type="checkbox" name="sm__upd__profile" id="sm__upd__profile" checked />
                                    <span class="ch__checkmark"></span>
                                </label>
                            </div>
                            <div class="flex flex-row flex-align-c gap-05">
                                <label class="checkbox__con flex flex-align-c">
                                    <label class="text-secondary small-med pointer user-select-none" for="sm__new__feedback">Visszajelzések esetén</label>
                                    <input type="checkbox" name="sm__new__feedback" id="sm__new__feedback" />
                                    <span class="ch__checkmark"></span>
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="flex flex-row flex-align-c flex-justify-con-sb-m prst__row">
                        <span class="text-primary small prst__trig w-fc-m">További értesítések</span>
                        <div class="flex flex-col gap-1">
                            <div class="flex flex-row flex-align-c gap-05">
                                <label class="checkbox__con flex flex-align-c">
                                    <label class="text-secondary small-med pointer user-select-none" for="sm__oth__order">Rendelési értesítések</label>
                                    <input type="checkbox" name="sm__oth__order" id="sm__oth__order" checked />
                                    <span class="ch__checkmark"></span>
                                </label>
                            </div>
                            <div class="flex flex-row flex-align-c gap-05">
                                <label class="checkbox__con flex flex-align-c">
                                    <label class="text-secondary small-med pointer user-select-none" for="sm__oth__news">Újítások bemutatása</label>
                                    <input type="checkbox" name="sm__oth__news" id="sm__oth__news" />
                                    <span class="ch__checkmark"></span>
                                </label>
                            </div>
                            <div class="flex flex-row flex-align-c gap-05">
                                <label class="checkbox__con flex flex-align-c">
                                    <label class="text-secondary small-med pointer user-select-none" for="sm__oth__tips">Tippek küldése</label>
                                    <input type="checkbox" name="sm__oth__tips" id="sm__oth__tips" />
                                    <span class="ch__checkmark"></span>
                                </label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="flex flex-col gap-2">
                    <span class="text-primary bold">Feliratkozásaim kezelése</span>
                    <div class="flex flex-col gap-1">
                        <?php
                            if ($stmt = $con->prepare('SELECT * FROM e__subs WHERE uid = ?')) { 
                                $stmt->bind_param('i', $uid); $stmt->execute(); $result = $stmt->get_result();
                                if ($result->num_rows > 0) {
                                    echo '
                                    <div class="flex flex-row flex-align-c prst__row">
                                        <span class="text-primary small prst__trig">Heti hírlevelek</span>
                                        <div class="flex flex-col">
                                            <label class="switch switch-smaller">
                                                <input type="checkbox" checked="checked">
                                                <span class="slider slider-smaller round"></span>
                                            </label>
                                        </div>
                                    </div>
                                    ';
                                }
                            }
                            if ($stmt = $con->prepare('SELECT notify.pid, products.product_name FROM `notify` INNER JOIN products ON products.product_id = notify.pid WHERE notify.uid = ?')) { 
                                $stmt->bind_param('i', $uid); $stmt->execute(); $notif__res = $stmt->get_result();
                                if ($notif__res->num_rows > 0) {
                                    while ($data = $notif__res->fetch_assoc()) {
                                        echo '
                                        <div class="flex flex-row flex-align-c prst__row">
                                            <span class="text-primary small prst__trig">Készlet pótlása: <a href="/webshop/?id='.$data['pid'].'" target="_blank" class="pointer link bold user-select-none">'.$data['product_name'].'</a></span>
                                            <div class="flex flex-col">
                                                <label class="switch switch-smaller">
                                                    <input type="checkbox" checked="checked">
                                                    <span class="slider slider-smaller round"></span>
                                                </label>
                                            </div>
                                        </div>
                                        ';
                                    }
                                }
                            }
                            if (($result->num_rows + $notify__res->num_rows) < 1) { echo '<span class="text-secondary small-med">Nincsenek további feliratkozásai.</span>'; }
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="/includes/profile/script/credit.js"></script>