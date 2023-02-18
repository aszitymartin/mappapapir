<?php session_start();
    include($_SERVER['DOCUMENT_ROOT'].'/includes/inc.connect.php');
    $stmt = $con->prepare('SELECT customer_id, full_name, email_address, inv_company_name, inv_settlement, inv_address_line, inv_postal_code, inv_tax_id, ship_settlement, ship_address_line, ship_postal_code, phone_number, fax_number, theme FROM customers WHERE customer_id = ?');
    if (isset($_SESSION['loggedin'])) {$id = $_SESSION['id'];}
    $stmt->bind_param('i', $id);$stmt->execute();
    $stmt->bind_result($id, $fullname, $email, $company, $settlement, $address, $postal, $tax, $shipsettlement, $shipaddress, $shippostal, $phone, $fax, $theme);
    $stmt->fetch();$stmt->close();$sql = "SELECT * FROM customers";
    if ($result = $con->query($sql)) {$product = $result->fetch_array();
    } else {header ("Location: /500");exit();}
?>
<div class="sidenav-inner">
    <div class="sidenav-header flex flex-row flex-align-c flex-justify-con-sb">
        <span class="flex flex-col">
            <span class="header_title_heading">Általános beállítások</span>
        </span>
        <span class="flex">
            <span class="text-primary" onclick="closeSettingMenu('general')">
                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"><rect x="0" y="0" width="24" height="24"/><circle class="svg" opacity="0.3" cx="12" cy="12" r="10"/><path d="M12.0355339,10.6213203 L14.863961,7.79289322 C15.2544853,7.40236893 15.8876503,7.40236893 16.2781746,7.79289322 C16.6686989,8.18341751 16.6686989,8.81658249 16.2781746,9.20710678 L13.4497475,12.0355339 L16.2781746,14.863961 C16.6686989,15.2544853 16.6686989,15.8876503 16.2781746,16.2781746 C15.8876503,16.6686989 15.2544853,16.6686989 14.863961,16.2781746 L12.0355339,13.4497475 L9.20710678,16.2781746 C8.81658249,16.6686989 8.18341751,16.6686989 7.79289322,16.2781746 C7.40236893,15.8876503 7.40236893,15.2544853 7.79289322,14.863961 L10.6213203,12.0355339 L7.79289322,9.20710678 C7.40236893,8.81658249 7.40236893,8.18341751 7.79289322,7.79289322 C8.18341751,7.40236893 8.81658249,7.40236893 9.20710678,7.79289322 L12.0355339,10.6213203 Z" class="svg" /></g>
                </svg>
            </span>
        </span>
    </div>
    <div class="sidenav-body">
        <div class="theme-desc text-align-c">
            <span class="text-secondary text-small">Az oldalon bármikor módosíthatja általános felhasználói adatait.</span>
        </div>
        <div class="sidenav-body" style="max-height: 75vh;">
            <div class="theme-button-con flex flex-col">
                <div class="settings-group flex flex-col">
                    <div class="settings-item settings-menu-item flex flex-row">
                        <div class="theme-button settings-padding flex flex-align-c flex-justify-con-sb w-100">
                            <div class="flex flex-col">
                                <span class="settings-item-title">Teljes név</span>
                                <span class="settings-item-info" id="full_name"><?php echo $fullname; ?></span>
                            </div>
                            <div class="flex flex-col h-100">
                                <span class="settings-menu-item-edit flex" id="fullname-edit" onclick="settingsEditGeneral('full_name', 'text', document.getElementById('full_name').innerHTML, this.id);">Szerkeszt</span>
                            </div>
                        </div>
                    </div>
                    <hr class="sidenav-group-divider settings-divider" style="text-align: right;">
                    <div class="settings-item settings-menu-item flex flex-row">
                        <div class="flex flex-col w-100">
                            <div class="flex flex-row">
                                <div class="theme-button settings-padding flex flex-align-c flex-justify-con-sb w-100">
                                    <div class="flex flex-col">
                                        <span class="settings-item-title">Email</span>
                                        <span class="settings-item-info" id="email_address"><?php echo $email; ?></span>
                                    </div>
                                    <div class="flex flex-col h-100">
                                        <span class="settings-menu-item-edit flex" id="email-edit" onclick="settingsEditGeneral('email_address', 'email', document.getElementById('email_address').innerHTML, this.id);">Szerkeszt</span>
                                    </div>
                                </div>
                            </div><!--
                            <span class="warning-card flex flex-row flex-align-c ">
                                <span class="warning-icon flex">
                                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="1rem" height="1rem" viewBox="0 0 24 24" version="1.1">
                                        <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"><rect x="0" y="0" width="24" height="24"/><circle class="svg" opacity="0.3" cx="12" cy="12" r="10"/><rect class="svg" x="11" y="7" width="2" height="8" rx="1"/><rect class="svg" x="11" y="16" width="2" height="2" rx="1"/></g>
                                    </svg>
                                </span>
                                <span class="warning-text flex">E-mail megerősítése</span>
                            </span> -->
                        </div>
                    </div>
                    <hr class="sidenav-group-divider settings-divider" style="text-align: right;">
                    <div class="settings-item settings-menu-item flex flex-row">
                        <div class="theme-button settings-padding flex flex-align-c flex-justify-con-sb w-100">
                            <div class="flex flex-col">
                                <span class="settings-item-title">Telefonszám</span>
                                <span class="settings-item-info" id='phone_number'>
                                    <?php $pn = substr($phone, 0 , 2) . " " . substr($phone, 2 , 3) . " " . substr($phone, 5 , 4);echo trim($pn);?>
                                </span>
                                <script>var str = document.getElementById('phone_number').textContent;document.getElementById('phone_number').innerHTML = str.trim();</script>
                            </div>
                            <div class="flex flex-col h-100">
                                <span class="settings-menu-item-edit flex" id="phone-edit" onclick="settingsEditGeneral('phone_number', 'tel', document.getElementById('phone_number').innerHTML.trim().replace(/\s/gm, ''), this.id);">Szerkeszt</span>
                            </div>
                        </div>
                    </div>
                    <hr class="sidenav-group-divider settings-divider" style="text-align: right;">
                    <div class="settings-item settings-menu-item flex flex-row">
                        <div class="theme-button settings-padding flex flex-align-c flex-justify-con-sb w-100">
                            <div class="flex flex-col">
                                <span class="settings-item-title">Adóazonosító</span>
                                <span class="settings-item-info" id="inv_tax_id"><?php echo $tax; ?></span>
                            </div>
                            <div class="flex flex-col h-100">
                                <span class="settings-menu-item-edit flex" id="tax-edit" onclick="settingsEditGeneral('inv_tax_id', 'number', document.getElementById('inv_tax_id').innerHTML, this.id);">Szerkeszt</span>
                            </div>
                        </div>
                    </div>
                    <hr class="sidenav-group-divider settings-divider" style="text-align: right;">
                    <div class="settings-item settings-menu-item flex flex-row">
                        <div class="theme-button settings-padding flex flex-align-c flex-justify-con-sb w-100">
                            <div class="flex flex-col">
                                <span class="settings-item-title">Faxszám</span>
                                <span class="settings-item-info" id="fax_number"><?php echo $fax; ?></span>
                            </div>
                            <div class="flex flex-col h-100">
                                <span class="settings-menu-item-edit flex" id="fax-edit" onclick="settingsEditGeneral('fax_number', 'number', document.getElementById('fax_number').innerHTML, this.id);">Szerkeszt</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="settings-group flex flex-col">
                    <div class="settings-item settings-menu-item flex flex-row">
                        <div class="theme-button settings-padding flex flex-align-c flex-justify-con-sb w-100">
                            <div class="flex flex-col">
                                <span class="settings-item-title">Cégnév</span>
                                <span class="settings-item-info" id="inv_company_name"><?php echo $company; ?></span>
                            </div>
                            <div class="flex flex-col h-100">
                                <span class="settings-menu-item-edit flex" id="inv_company-edit" onclick="settingsEditGeneral('inv_company_name', 'text', document.getElementById('inv_company_name').innerHTML, this.id);">Szerkeszt</span>
                            </div>
                        </div>
                    </div>
                    <hr class="sidenav-group-divider settings-divider" style="text-align: right;">
                    <div class="settings-item settings-menu-item flex flex-row">
                        <div class="theme-button settings-padding flex flex-align-c flex-justify-con-sb w-100">
                            <div class="flex flex-col">
                                <span class="settings-item-title">Település</span>
                                <span class="settings-item-info" id="inv_settlement"><?php echo $settlement; ?></span>
                            </div>
                            <div class="flex flex-col h-100">
                                <span class="settings-menu-item-edit flex" id="inv_settlement-edit" onclick="settingsEditGeneral('inv_settlement', 'text', document.getElementById('inv_settlement').innerHTML, this.id);">Szerkeszt</span>
                            </div>
                        </div>
                    </div>
                    <hr class="sidenav-group-divider settings-divider" style="text-align: right;">
                    <div class="settings-item settings-menu-item flex flex-row">
                        <div class="theme-button settings-padding flex flex-align-c flex-justify-con-sb w-100">
                            <div class="flex flex-col">
                                <span class="settings-item-title">Cím</span>
                                <span class="settings-item-info" id="inv_address_line"><?php echo $address; ?></span>
                            </div>
                            <div class="flex flex-col h-100">
                                <span class="settings-menu-item-edit flex" id="inv_address-edit" onclick="settingsEditGeneral('inv_address_line', 'text', document.getElementById('inv_address_line').innerHTML, this.id);">Szerkeszt</span>
                            </div>
                        </div>
                    </div>
                    <hr class="sidenav-group-divider settings-divider" style="text-align: right;">
                    <div class="settings-item settings-menu-item flex flex-row">
                        <div class="theme-button settings-padding flex flex-align-c flex-justify-con-sb w-100">
                            <div class="flex flex-col">
                                <span class="settings-item-title">Irányítószám</span>
                                <span class="settings-item-info" id="inv_postal_code"><?php echo $postal; ?></span>
                            </div>
                            <div class="flex flex-col h-100">
                                <span class="settings-menu-item-edit flex" id="inv_postal-edit" onclick="settingsEditGeneral('inv_postal_code', 'number', document.getElementById('inv_postal_code').innerHTML, this.id);">Szerkeszt</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="settings-group flex flex-col">
                    <div class="settings-item settings-menu-item flex flex-row">
                        <div class="theme-button settings-padding flex flex-align-c flex-justify-con-sb w-100">
                            <div class="flex flex-col">
                                <span class="settings-item-title">Szállítási cím</span>
                                <span class="settings-item-info" id="ship_address_line"><?php echo $shipaddress ?></span>
                            </div>
                            <div class="flex flex-col h-100">
                                <span class="settings-menu-item-edit flex" id="ship_address-edit" onclick="settingsEditGeneral('ship_address_line', 'text', document.getElementById('ship_address_line').innerHTML, this.id);">Szerkeszt</span>
                            </div>
                        </div>
                    </div>
                    <hr class="sidenav-group-divider settings-divider" style="text-align: right;">
                    <div class="settings-item settings-menu-item flex flex-row">
                        <div class="theme-button settings-padding flex flex-align-c flex-justify-con-sb w-100">
                            <div class="flex flex-col">
                                <span class="settings-item-title">Szállítási város</span>
                                <span class="settings-item-info" id="ship_settlement"><?php echo $shipsettlement ?></span>
                            </div>
                            <div class="flex flex-col h-100">
                                <span class="settings-menu-item-edit flex" id="ship_settlement-edit" onclick="settingsEditGeneral('ship_settlement', 'text', document.getElementById('ship_settlement').innerHTML, this.id);">Szerkeszt</span>
                            </div>
                        </div>
                    </div>
                    <hr class="sidenav-group-divider settings-divider" style="text-align: right;">
                    <div class="settings-item settings-menu-item flex flex-row">
                        <div class="theme-button settings-padding flex flex-align-c flex-justify-con-sb w-100">
                            <div class="flex flex-col">
                                <span class="settings-item-title">Irányítószám</span>
                                <span class="settings-item-info" id="ship_postal_code"><?php echo $shippostal; ?></span>
                            </div>
                            <div class="flex flex-col h-100">
                                <span class="settings-menu-item-edit flex" id="ship_postal-edit" onclick="settingsEditGeneral('ship_postal_code', 'number', document.getElementById('ship_postal_code').innerHTML, this.id);">Szerkeszt</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    valError.classList = 'warning-card flex flex-row flex-align-c w-100';
    function settingsEditGeneral(setting, type, value, target) {
        document.getElementById(setting).innerHTML = `<form style="margin-bottom: 1rem;"><input type='`+ type +`' id="inp-`+ setting +`" class="settings-search-input" value="`+ value +`" />    </form><span class='setting-edit-submit button button-primary' style="padding: .25rem .5rem;" onclick="saveSettingsEdit('`+ setting +`', document.getElementById('inp-`+ setting +`').value, '`+ type +`', '`+ target +`')">Mentés</span>`;
        document.getElementById(target).innerHTML = 'Mégse';document.getElementById(target).removeAttribute('onclick');document.getElementById(target).setAttribute('onclick', 'settingsRestoreEdit("'+ setting +'", "'+ type +'", "'+ value +'", "'+ target +'")');
    } function saveSettingsEdit (id, value, type, target) {
        if (validateSettingsEdit(id, value, type, target)) {
            $.ajax({
                type: "POST",url: "/actions/settings/update.php",data: {col: id,val: value,typ: type},cache: false,
                success: function(data) {settingsRestoreEdit(id, type, value, target);},
                error: function (data) {valError.innerHTML = `<span class="warning-icon flex"><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="1rem" height="1rem" viewBox="0 0 24 24" version="1.1"><g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"><rect x="0" y="0" width="24" height="24"/><circle class="svg" opacity="0.3" cx="12" cy="12" r="10"/><rect class="svg" x="11" y="7" width="2" height="8" rx="1"/><rect class="svg" x="11" y="16" width="2" height="2" rx="1"/></g></svg></span><span class="warning-text flex flex-justify-con-sb w-100"><span class='flex'>Valami hiba történt (`+ data.status +`)</span><span class='flex bold' onclick="window.location.reload(false)">Újra</span></span>`; document.getElementById(id).parentNode.append(valError);}
            });
        } else {
            valError.innerHTML = `<span class="warning-icon flex"><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="1rem" height="1rem" viewBox="0 0 24 24" version="1.1"><g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"><rect x="0" y="0" width="24" height="24"/><circle class="svg" opacity="0.3" cx="12" cy="12" r="10"/><rect class="svg" x="11" y="7" width="2" height="8" rx="1"/><rect class="svg" x="11" y="16" width="2" height="2" rx="1"/></g></svg></span><span class="warning-text flex">Érvénytelen adat</span>`;
            document.getElementById(id).parentNode.append(valError);document.getElementById('inp-'+id).value = "";document.getElementById('inp-'+id).focus();console.log(id);
        }
    } function settingsRestoreEdit (id, type, value, target) {
        if (document.getElementById(id).parentNode.lastElementChild.classList.contains('warning-card')) {document.getElementById(id).parentNode.lastElementChild.remove();}
        document.getElementById(id).innerHTML = value;document.getElementById(target).setAttribute('onclick', 'settingsEditGeneral("'+ id +'", "'+ type +'", "'+ value +'", "'+ target +'")');document.getElementById(target).innerHTML = "Szerkeszt";
    } function validateSettingsEdit (validID, validVal, validType, validTarget) {
        console.log(validID);
        switch (validID) {
            case 'full_name': 
                if ($('#inp-'+validID)[0].value.match(/^([\w]{3,})+\s+([\w\s]{3,})+$/i) && $('#inp-'+validID).value !== '') {return true;
                } else { return false; }
            break;
            case 'email_address': 
                if ($('#inp-email_address')[0].value.match(/^([a-z\d!#$%&'*+\-\/=?^_`{|}~\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]+(\.[a-z\d!#$%&'*+\-\/=?^_`{|}~\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]+)*|"((([ \t]*\r\n)?[ \t]+)?([\x01-\x08\x0b\x0c\x0e-\x1f\x7f\x21\x23-\x5b\x5d-\x7e\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]|\\[\x01-\x09\x0b\x0c\x0d-\x7f\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]))*(([ \t]*\r\n)?[ \t]+)?")@(([a-z\d\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]|[a-z\d\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF][a-z\d\-._~\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]*[a-z\d\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])\.)+([a-z\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]|[a-z\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF][a-z\d\-._~\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]*[a-z\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])\.?$/i) && $('#inp-email_address').value !== '') {return true;
                } else { return false; }
            break;
            case 'phone_number': 
                if ($('#inp-phone_number')[0].value.match(/\b\d{9}\b/g) && $('#inp-phone_number').value !== '') {return true;
                } else { return false; }
            break;
            case 'inv_tax_id': 
                if ($('#inp-inv_tax_id').value.match(/^[0-9]{9}$/) && $('#inp-inv_tax_id').value !== '') {return true;
                } else { return false; }
            break;
            case 'inv_tax_id': 
                if ($('#inp-inv_tax_id').value.match(/^[0-9]{9}$/) && $('#inp-inv_tax_id').value !== '') {return true;
                } else { return false; }
            break;
            case 'fax_number': 
                if ($('#inp-fax_number').value.match(/^[0-9]{9}$/) && $('#inp-fax_number').value !== '') {return true;
                } else { return false; }
            break;
            case 'inv_company_name': 
                if ($('#inp-inv_company_name').value.match(/^([\w]{3,})+\s+([\w\s]{3,})+$/i) && $('#inp-inv_company_name').value !== '') {return true;
                } else { return false; }
            break;
            case 'inv_settlement': 
                if ($('#inp-inv_settlement').value !== '') {return true;
                } else { return false; }
            break;
            case 'inv_address_line': 
                if ($('#inp-inv_address_line')[0].value.match(/^[0-9A-Za-z\s\-]+$/) && $('#inp-inv_address_line').value !== '') {return true;
                } else { return false; }
            break;
            case 'inv_postal_code': 
                if ($('#inp-inv_postal_code')[0].value.match(/^[0-9]{4}$/) && $('#inp-inv_postal_code').value !== '') {return true;
                } else { return false; }
            break;
            case 'ship_address_line': 
                if ($('#inp-ship_address_line')[0].value.match(/^[0-9A-Za-z\s\-]+$/) && $('#inp-ship_address_line').value !== '') {return true;
                } else { return false; }
            break;
            case 'ship_settlement': 
                if ($('#inp-ship_settlement').value !== '') {return true;
                } else { return false; }
            break;
            case 'ship_postal_code': 
                if ($('#inp-ship_postal_code')[0].value.match(/^[0-9]{4}$/) && $('#inp-ship_postal_code').value !== '') {return true;
                } else { return false; }
            break;
        }
    }
</script>