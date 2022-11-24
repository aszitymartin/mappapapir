<?php session_start();
    $DATABASE_HOST = 'localhost';$DATABASE_USER = 'root';$DATABASE_PASS = 'eKi=0630OG';$DATABASE_NAME = 'mappapapir';
    $con = mysqli_connect($DATABASE_HOST, $DATABASE_USER, $DATABASE_PASS, $DATABASE_NAME);
    if (mysqli_connect_errno()) {header ("Location: /500");
        echo "
            <script>const now = new Date();const notifParams = {notifType : '1',notifIcon : '2',notifTheme : '2',notifTitle : 'Hiba',notifDesc : 'Szerver oldali hiba történt.',expiry : now.setSeconds(60)};
                localStorage.setItem('NP', JSON.stringify(notifParams));window.location.href= '../';
            </script>
        ";
    }

    $stmt = $con->prepare('SELECT customer_id, full_name, email_address, inv_company_name, inv_settlement, inv_address_line, inv_postal_code, inv_tax_id, ship_settlement, ship_address_line, ship_postal_code, phone_number, fax_number FROM customers WHERE customer_id = ?');
    if (isset($_SESSION['loggedin'])) {$id = $_SESSION['id'];}
    $stmt->bind_param('i', $id);$stmt->execute();
    $stmt->bind_result($id, $fullname, $email, $company, $settlement, $address, $postal, $tax, $shipsettlement, $shipaddress, $shippostal, $phone, $fax);
    $stmt->fetch();$stmt->close();$sql = "SELECT * FROM customers";
    if ($result = $con->query($sql)) {$product = $result->fetch_array();
    } else {header ("Location: /500");exit();}
?>
<div class="sidenav-inner">
    <div class="sidenav-header flex flex-row flex-align-c flex-justify-con-sb">
        <span class="flex flex-col">
            <span class="header_title_heading">Biztonság és Bejelentkezés</span>
        </span>
        <span class="flex">
            <span class="text-primary" onclick="closeSettingMenu('security')">
                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"><rect x="0" y="0" width="24" height="24"/><circle class="svg" opacity="0.3" cx="12" cy="12" r="10"/><path d="M12.0355339,10.6213203 L14.863961,7.79289322 C15.2544853,7.40236893 15.8876503,7.40236893 16.2781746,7.79289322 C16.6686989,8.18341751 16.6686989,8.81658249 16.2781746,9.20710678 L13.4497475,12.0355339 L16.2781746,14.863961 C16.6686989,15.2544853 16.6686989,15.8876503 16.2781746,16.2781746 C15.8876503,16.6686989 15.2544853,16.6686989 14.863961,16.2781746 L12.0355339,13.4497475 L9.20710678,16.2781746 C8.81658249,16.6686989 8.18341751,16.6686989 7.79289322,16.2781746 C7.40236893,15.8876503 7.40236893,15.2544853 7.79289322,14.863961 L10.6213203,12.0355339 L7.79289322,9.20710678 C7.40236893,8.81658249 7.40236893,8.18341751 7.79289322,7.79289322 C8.18341751,7.40236893 8.81658249,7.40236893 9.20710678,7.79289322 L12.0355339,10.6213203 Z" class="svg" /></g>
                </svg>
            </span>
        </span>
    </div>
    <div class="sidenav-body flex flex-col" id="sidenav-body">
        <span class="sidenav-item flex flex-row" style="background-color: var(--divider);">
            <span class="sidenav-item-group flex flex-col" style="background-color: var(--divider);">
                <span class="sidenav-item-group-item flex flex-col">
                    <span class="flex flex-row flex-align-c w-100">
                        <span class="sidenav-item-in flex flex-col w-100">
                            <div class="theme-button flex flex-align-c flex-justify-con-sb w-100" style="padding-bottom: 0;">
                                <div class="flex flex-col w-100">
                                    <span class="settings-item-title">Email</span>
                                    <span class="settings-item-info" id="email_address"><?php echo $email; ?></span>
                                </div>
                            </div>
                        </span>
                    </span>
                    <span class="warning-card flex flex-row flex-align-c" style="margin-bottom: 1rem;">
                        <span class="warning-icon flex">
                            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="1rem" height="1rem" viewBox="0 0 24 24" version="1.1">
                                <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"><rect x="0" y="0" width="24" height="24"/><circle class="svg" opacity="0.3" cx="12" cy="12" r="10"/><rect class="svg" x="11" y="7" width="2" height="8" rx="1"/><rect class="svg" x="11" y="16" width="2" height="2" rx="1"/></g>
                            </svg>
                        </span>
                        <span class="warning-text flex">E-mail megerősítése</span>
                    </span>
                </span>
                <span style="text-align: center;">
                    <hr class="sidenav-group-divider" style="text-align: right; border: 1px solid var(--items);">
                </span>
                <span class="sidenav-item-group-item flex flex-col">
                    <span class="flex flex-row flex-align-c w-100">
                        <span class="sidenav-item-in flex flex-col w-100">
                            <div class="theme-button flex flex-align-c flex-justify-con-sb w-100" style="padding-bottom: 0;">
                                <div class="flex flex-col w-100">
                                    <span class="settings-item-title">Telefon</span>
                                    <span class="settings-item-info" id="email_address"><?php echo $phone; ?></span>
                                </div>
                            </div>
                        </span>
                    </span>
                    <span class="warning-card flex flex-row flex-align-c" style="margin-bottom: 1rem;">
                        <span class="warning-icon flex">
                            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="1rem" height="1rem" viewBox="0 0 24 24" version="1.1">
                                <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"><rect x="0" y="0" width="24" height="24"/><circle class="svg" opacity="0.3" cx="12" cy="12" r="10"/><rect class="svg" x="11" y="7" width="2" height="8" rx="1"/><rect class="svg" x="11" y="16" width="2" height="2" rx="1"/></g>
                            </svg>
                        </span>
                        <span class="warning-text flex">Telefonszám megerősítése</span>
                    </span>
                </span>
            </span>
        </span>
        <span class="sidenav-item flex flex-row" style="background-color: var(--divider);">
            <span class="sidenav-item-group flex flex-col" style="background-color: var(--divider);">
                <span class="sidenav-item-group-item flex flex-col">
                    <span class="flex flex-row flex-align-c w-100">
                        <span class="sidenav-item-in flex flex-col w-100">
                            <div class="theme-button flex flex-align-c flex-justify-con-sb w-100" style="padding-bottom: 0;">
                                <div class="flex flex-col w-100">
                                    <span class="settings-item-title">Jelszó módosítása</span>
                                    <span class="settings-item-info" id="email_address">************</span>
                                </div>
                            </div>
                        </span>
                    </span>
                    <span class="warning-card flex flex-row flex-align-c" style="margin-bottom: 1rem;">
                        <span class="warning-text flex">Módosítás</span>
                    </span>
                </span>
                <span style="text-align: center;">
                    <hr class="sidenav-group-divider" style="text-align: right; border: 1px solid var(--items);">
                </span>
                <span class="sidenav-item-group-item flex flex-col">
                    <span class="flex flex-row flex-align-c w-100">
                        <span class="sidenav-item-in flex flex-col w-100">
                            <div class="theme-button flex flex-align-c flex-justify-con-sb w-100" style="padding-bottom: 0;">
                                <div class="flex flex-col w-100">
                                    <span class="settings-item-title">Kétlépcsős hitelesítés</span>
                                    <span class="settings-item-info" id="email_address">Kikapcsolva</span>
                                </div>
                            </div>
                        </span>
                    </span>
                    <span class="warning-card flex flex-row flex-align-c" style="margin-bottom: 1rem;">
                        <span class="warning-text flex">Bekapcsolás</span>
                    </span>
                </span>
            </span>
        </span>
        <span class="sidenav-item flex flex-row" style="background-color: var(--divider);">
            <span class="sidenav-item-group flex flex-col" style="background-color: var(--divider);">
                <span class="sidenav-item-group-item flex flex-col">
                    <span class="flex flex-row flex-align-c w-100">
                        <span class="sidenav-item-in flex flex-col w-100">
                            <div class="theme-button flex flex-align-c flex-justify-con-sb w-100" style="padding-bottom: 0;">
                                <div class="flex flex-col w-100">
                                    <span class="settings-item-title">Engedélyezett bejelentkezések</span>
                                    <span class="settings-item-info" id="email_address">Tekintse át azon eszközök listáját, amelyeken nem kell bejelentkezési kódot használnia</span>
                                </div>
                            </div>
                        </span>
                    </span>
                    <span class="warning-card flex flex-row flex-align-c" style="margin-bottom: 1rem;">
                        <span class="warning-text flex">Megtekintés</span>
                    </span>
                </span>
                <span style="text-align: center;">
                    <hr class="sidenav-group-divider" style="text-align: right; border: 1px solid var(--items);">
                </span>
                <span class="sidenav-item-group-item flex flex-col">
                    <span class="flex flex-row flex-align-c w-100">
                        <span class="sidenav-item-in flex flex-col w-100">
                            <div class="theme-button flex flex-align-c flex-justify-con-sb w-100" style="padding-bottom: 0;">
                                <div class="flex flex-col w-100">
                                    <span class="settings-item-title">Mentse el bejelentkezési adatait</span>
                                    <span class="settings-item-info" id="email_address">Csak az Ön által kiválasztott böngészőkön és eszközökön kerül mentésre</span>
                                </div>
                            </div>
                        </span>
                    </span>
                    <span class="warning-card flex flex-row flex-align-c" style="margin-bottom: 1rem;">
                        <span class="warning-text flex">Beállítás</span>
                    </span>
                </span>
            </span>
        </span>
    </div>
</div>