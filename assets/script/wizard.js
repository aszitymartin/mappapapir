const formOpps = {
    waiting: `<svg class='wizard_input_loading' xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1"><g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"><g><polygon points="0 0 24 0 24 24 0 24"/></g><path d="M12,4 L12,6 C8.6862915,6 6,8.6862915 6,12 C6,15.3137085 8.6862915,18 12,18 C15.3137085,18 18,15.3137085 18,12 C18,10.9603196 17.7360885,9.96126435 17.2402578,9.07513926 L18.9856052,8.09853149 C19.6473536,9.28117708 20,10.6161442 20,12 C20,16.418278 16.418278,20 12,20 C7.581722,20 4,16.418278 4,12 C4,7.581722 7.581722,4 12,4 Z" class="svg" fill-rule="nonzero" opacity="0.4" transform="translate(12.000000, 12.000000) scale(-1, 1) translate(-12.000000, -12.000000) "/></g></svg>`,
    valid: `<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1"><g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"><polygon points="0 0 24 0 24 24 0 24"/><path d="M6.26193932,17.6476484 C5.90425297,18.0684559 5.27315905,18.1196257 4.85235158,17.7619393 C4.43154411,17.404253 4.38037434,16.773159 4.73806068,16.3523516 L13.2380607,6.35235158 C13.6013618,5.92493855 14.2451015,5.87991302 14.6643638,6.25259068 L19.1643638,10.2525907 C19.5771466,10.6195087 19.6143273,11.2515811 19.2474093,11.6643638 C18.8804913,12.0771466 18.2484189,12.1143273 17.8356362,11.7474093 L14.0997854,8.42665306 L6.26193932,17.6476484 Z" fill="#1BC5BD " fill-rule="nonzero" transform="translate(11.999995, 12.000002) rotate(-180.000000) translate(-11.999995, -12.000002) "/></g></svg>`,
    invalid : `<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1"><g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"><g transform="translate(12.000000, 12.000000) rotate(-45.000000) translate(-12.000000, -12.000000) translate(4.000000, 4.000000)" fill="#F64E60 "><rect x="0" y="7" width="16" height="2" rx="1"/><rect transform="translate(8.000000, 8.000000) rotate(-270.000000) translate(-8.000000, -8.000000) " x="0" y="7" width="16" height="2" rx="1"/></g></g></svg>`,
    important : `<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1"><g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"><rect x="0" y="0" width="24" height="24"/><rect fill="#F64E60" x="11" y="7" width="2" height="8" rx="1"/><rect fill="#F64E60" x="11" y="16" width="2" height="2" rx="1"/></g></svg>`
};
const tooltipIcons = {bell: `<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="18px" height="18px" viewBox="0 0 24 24" version="1.1"><g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"><path d="M17,12 L18.5,12 C19.3284271,12 20,12.6715729 20,13.5 C20,14.3284271 19.3284271,15 18.5,15 L5.5,15 C4.67157288,15 4,14.3284271 4,13.5 C4,12.6715729 4.67157288,12 5.5,12 L7,12 L7.5582739,6.97553494 C7.80974924,4.71225688 9.72279394,3 12,3 C14.2772061,3 16.1902508,4.71225688 16.4417261,6.97553494 L17,12 Z" class="svg"/><rect class="svg" opacity="0.3" x="10" y="16" width="4" height="4" rx="2"/></g></svg>`}
var currentTab = 0; currentTab = 0; showTab(currentTab);
var bool_fname, bool_email, bool_passw, bool_passc, bool_comus, bool_settl, bool_addri, bool_zipin, bool_taxad, bool_shset, bool_shadd, bool_shzip, bool_phone, bool_lsfax, bool_accep = false;
var wizard_input = document.getElementsByClassName('wizard_input');
for (var i = 0; i < wizard_input.length; i++) {
    $(wizard_input[i]).on('blur click', function () {
        switch(validate(this.getAttribute('name'))) {
            case true:this.parentNode.lastElementChild.innerHTML = formOpps.valid;
            break;
            case false:this.parentNode.lastElementChild.innerHTML = formOpps.invalid;
            break;
            default: this.parentNode.lastElementChild.innerHTML = formOpps.waiting;
        } if (this.value.length < 1) {this.parentNode.lastElementChild.innerHTML = formOpps.waiting;}
    });
}
for (var i = 0; i < wizard_input.length; i++) {$(wizard_input[i]).on('focus', function () {if (this.value.length < 1) {this.parentNode.lastElementChild.innerHTML = formOpps.waiting;}});}
var status_btn = document.getElementsByClassName('wizard_input_status_button'); var tooltip =  document.createElement('span');tooltip.classList.add('wizard_tooltip');
for (var i = 0; i < status_btn.length; i++) {
    status_btn[i].addEventListener('mouseenter', function() {if (this.hasAttribute('emsg')) {tooltip.innerHTML = tooltipIcons.bell +this.getAttribute('emsg');this.parentNode.append(tooltip);}});
    status_btn[i].addEventListener('mouseleave', function() {if (this.hasAttribute('emsg')) {tooltip.remove();}});
}
function validate(name) {
    if (currentTab == 0) {
        switch (name) {
            case 'register_fullname':
                if ($('input[name="register_fullname"]')[0].value.match(/^([\w]{3,})+\s+([\w\s]{3,})+$/i) && $('input[name="register_fullname"]')[0].value !== '') {$('input[name="register_fullname"]')[0].parentNode.lastElementChild.removeAttribute('emsg');bool_fname = true;return true;}
                else {$('input[name="register_fullname"]')[0].parentNode.lastElementChild.setAttribute('emsg', 'Érvénytelen név');bool_fname = false;return false;}
            break;
            case 'register_username': 
                if ($('input[name="register_username"]')[0].value.match(/\w{4,}\d+/) && $('input[name="register_username"]')[0].value !== '') {$('input[name="register_username"]')[0].parentNode.lastElementChild.removeAttribute('emsg');bool_uname = true;return true;}
                else {$('input[name="register_username"]')[0].parentNode.lastElementChild.setAttribute('emsg', 'Legalább 4 karaktert és egy számot kell tartalmaznia!');bool_uname = false;return false;}
            break;
            case 'register_email':
                if ($('input[name="register_email"]')[0].value.match(/^([a-z\d!#$%&'*+\-\/=?^_`{|}~\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]+(\.[a-z\d!#$%&'*+\-\/=?^_`{|}~\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]+)*|"((([ \t]*\r\n)?[ \t]+)?([\x01-\x08\x0b\x0c\x0e-\x1f\x7f\x21\x23-\x5b\x5d-\x7e\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]|\\[\x01-\x09\x0b\x0c\x0d-\x7f\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]))*(([ \t]*\r\n)?[ \t]+)?")@(([a-z\d\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]|[a-z\d\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF][a-z\d\-._~\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]*[a-z\d\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])\.)+([a-z\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]|[a-z\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF][a-z\d\-._~\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]*[a-z\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])\.?$/i) && $('input[name="register_email"]')[0].value !== '') {$('input[name="register_email"]')[0].parentNode.lastElementChild.removeAttribute('emsg');bool_email = true;return true;}
                else {$('input[name="register_email"]')[0].parentNode.lastElementChild.setAttribute('emsg', 'Ez az email érvénytelen!');bool_email = false;return false;}
            break;
            case 'register_password':
                if ($('input[name="register_password"]')[0].value.match(/^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*[!@#=\$%\^&\*])(?=.{8,})/) && $('input[name="register_password"]')[0].value !== '') {$('input[name="register_password"]')[0].parentNode.lastElementChild.removeAttribute('emsg');bool_passw = true;return true;}
                else {$('input[name="register_password"]')[0].parentNode.lastElementChild.setAttribute('emsg', 'A jelszó min. 8 karakteres kell, hogy legyen, szimbólumot és számot kell tartalmaznia!');bool_passw = false;return false;}
            break;
            case 'register_password_confirm':
                if ($('input[name="register_password_confirm"]')[0].value == $('input[name="register_password"]')[0].value && $('input[name="register_password_confirm"]')[0].value !== '') {$('input[name="register_password_confirm"]')[0].parentNode.lastElementChild.removeAttribute('emsg');bool_passc = true;return true;}
                else {$('input[name="register_password_confirm"]')[0].parentNode.lastElementChild.setAttribute('emsg', 'A jelszavak nem egyeznek!');bool_passc = false;return false;}
            break;
            default: return 0;
        }
    } if (currentTab == 1) {
        switch (name) {
            case 'register_company_name': 
                if ($('input[name="register_company_name"]')[0].value.match(/^([\w]{3,})+\s+([\w\s]{3,})+$/i) && $('input[name="register_company_name"]')[0].value !== '') {$('input[name="register_company_name"]')[0].parentNode.lastElementChild.removeAttribute('emsg');bool_comus = true;return true;}
                else {$('input[name="register_company_name"]')[0].parentNode.lastElementChild.setAttribute('emsg', 'Érvénytelen cégnév!');bool_comus = false;return false;}
            break;
            case 'register_settlement': 
                if ($('input[name="register_settlement"]')[0].value !== '') {$('input[name="register_settlement"]')[0].parentNode.lastElementChild.removeAttribute('emsg');bool_settl = true;return true;}
                else {$('input[name="register_settlement"]')[0].parentNode.lastElementChild.setAttribute('emsg', 'Érvénytelen település!');bool_settl = false;return false;}
            break;
            case 'register_address_invoice': 
                if ($('input[name="register_address_invoice"]')[0].value.match(/^[0-9A-Za-z\s\-]+$/) && $('input[name="register_address_invoice"]')[0].value !== '') {$('input[name="register_address_invoice"]')[0].parentNode.lastElementChild.removeAttribute('emsg');bool_addri = true;return true;}
                else {$('input[name="register_address_invoice"]')[0].parentNode.lastElementChild.setAttribute('emsg', 'Érvénytelen cím!');bool_addri = false; return false;}
            break;
            case 'register_zip_invoice': 
                if ($('input[name="register_zip_invoice"]')[0].value.match(/^[0-9]{4}$/) && $('input[name="register_zip_invoice"]')[0].value !== '') {$('input[name="register_zip_invoice"]')[0].parentNode.lastElementChild.removeAttribute('emsg');bool_zipin = true;return true;}
                else {$('input[name="register_zip_invoice"]')[0].pareuntNode.lastElementChild.setAttribute('emsg', 'Érvénytelen irányítószám!');bool_zipin = false;return false;}
            break;
            case 'register_tax': 
                if ($('input[name="register_tax"]')[0].value.match(/^[0-9]{9}$/) && $('input[name="register_tax"]')[0].value !== '') {$('input[name="register_tax"]')[0].parentNode.lastElementChild.removeAttribute('emsg');bool_taxad = true; return true;}
                else {$('input[name="register_tax"]')[0].parentNode.lastElementChild.setAttribute('emsg', 'Érvénytelen adószám/adóazonosító!');bool_taxad = false; return false;}
            break;
            default: return 0;
        }
    } if (currentTab == 2) {
        switch (name) {
            case 'register_settlement_shipping': 
                if ($('input[name="register_settlement_shipping"]')[0].value !== '') {$('input[name="register_settlement_shipping"]')[0].parentNode.lastElementChild.removeAttribute('emsg');bool_shset = true;return true;}
                else {$('input[name="register_settlement_shipping"]')[0].parentNode.lastElementChild.setAttribute('emsg', 'Érvénytelen település!');bool_shset = false;return false;}
            break;
            case 'register_address_shipping': 
                if ($('input[name="register_address_shipping"]')[0].value.match(/^[0-9A-Za-z\s\-]+$/) && $('input[name="register_address_shipping"]')[0].value !== '') {$('input[name="register_address_shipping"]')[0].parentNode.lastElementChild.removeAttribute('emsg');bool_shadd = true;return true;}
                else {$('input[name="register_address_shipping"]')[0].parentNode.lastElementChild.setAttribute('emsg', 'Érvénytelen cím!');bool_shadd = false;return false;}
            break;
            case 'register_zip_shipping': 
                if ($('input[name="register_zip_shipping"]')[0].value.match(/^[0-9]{4}$/) && $('input[name="register_zip_shipping"]')[0].value !== '') {$('input[name="register_zip_shipping"]')[0].parentNode.lastElementChild.removeAttribute('emsg');bool_shzip = true;return true;}
                else {$('input[name="register_zip_shipping"]')[0].parentNode.lastElementChild.setAttribute('emsg', 'Érvénytelen irányítószám!');bool_shzip = false;return false;}
            break;
            default: return 0;
        }
    } if (currentTab == 3) {
        switch (name) {
            case 'register_phone_number': 
                if ($('input[name="register_phone_number"]')[0].value.match(/\b\d{9}\b/g) && $('input[name="register_phone_number"]')[0].value !== '') {$('input[name="register_phone_number"]')[0].parentNode.lastElementChild.removeAttribute('emsg');bool_phone = true;return true;}
                else {$('input[name="register_phone_number"]')[0].parentNode.lastElementChild.setAttribute('emsg', 'Érvénytelen telefonszám!');bool_phone = false;return false;}
            break;
            case 'register_fax': 
                if ($('input[name="register_fax"]')[0].value.match(/^[0-9]{9}$/) && $('input[name="register_fax"]')[0].value !== '') {$('input[name="register_fax"]')[0].parentNode.lastElementChild.removeAttribute('emsg');bool_lsfax = true;return true;}
                else {$('input[name="register_fax"]')[0].parentNode.lastElementChild.setAttribute('emsg', 'Érvénytelen fax!');bool_lsfax = false;return false;}
            break;
            default: return 0;
        }
    }
}
function showTab(n) {
    var x = document.getElementsByClassName("wizard_tab");x[n].style.display = "block";
    x[currentTab].getElementsByClassName("wizard_input")[0].focus();
    if (n == 0) {document.getElementById("wizard_prev_btn").style.display = "none";
    } else {document.getElementById("wizard_prev_btn").style.display = "flex";}
    if (n == (x.length - 1)) {document.getElementById("wizard_next_btn").innerHTML = "Beküldés";
    } else {document.getElementById("wizard_next_btn").innerHTML = "Következő";}fixStepIndicator(n);
}
function nextPrev(n) {
    var x = document.getElementsByClassName("wizard_tab");
    if (n == 1 && !validateForm()) return false;
    x[currentTab].style.display = "none";currentTab = currentTab + n;
    if (currentTab >= x.length) {
        var regd = new FormData();regd.append("fullname", document.getElementById("register_fullname").value);regd.append("email", document.getElementById("register_email").value);regd.append("password", document.getElementById("register_password").value);regd.append("passconf", document.getElementById("register_password_confirm").value);regd.append("company", document.getElementById("register_company_name").value);regd.append("settlement", document.getElementById("register_settlement").value);regd.append("address", document.getElementById("register_address_invoice").value);regd.append("postal", document.getElementById("register_zip_invoice").value);regd.append("tax", document.getElementById("register_tax").value);regd.append("sh__settl", document.getElementById("register_settlement_shipping").value);regd.append("sh__addr", document.getElementById("register_address_shipping").value);regd.append("sh__zip", document.getElementById("register_zip_shipping").value);regd.append("phone", document.getElementById("register_phone_number").value);regd.append("fax", document.getElementById("register_fax").value);
        $.ajax({url: "https://api.ipdata.co?api-key=739837e232548988c86b954108794b57bd3e1dbcd6eb550bfa53e544", dataType: 'json',
            success: function (api) { regd.append("ip", api.ip);
                $.ajax({ enctype: "multipart/form-data", type: "POST", url: "/actions/register_setup.php", data: regd, dataType: 'json', contentType: false, processData: false,
                    success: function(data) { closeHeaderProfileAction(); notificationSystem(0, 0, 0, 'Regisztráció', 'Ön sikeresen regisztrált!'); },
                    error: function (data) { notificationSystem(0, 1, 0, 'Regisztráció', 'Sikertelen regisztráció!'); }
                });
            }, error: function () { notificationSystem(0, 1, 0, 'Regisztráció', 'Sikertelen kapcsolatfelvétel.'); }
        });
        return false;
    }showTab(currentTab);
}
function validateForm() {
    var x, y, i, valid = true, con = document.getElementsByClassName("user_act_breadcrumb_con"), inp;
    x = document.getElementsByClassName("wizard_tab");y = x[currentTab].getElementsByTagName("input");inp = x[currentTab].getElementsByClassName('wizard_input')
    for (i = 0; i < y.length; i++) {if (y[i].value == "") {inp[i].parentNode.lastElementChild.innerHTML = formOpps.important;valid = false;}}
    if (currentTab == 0) {
        if (bool_fname && bool_uname && bool_email && bool_passw && bool_passc) {valid = true;}
        else {valid = false;}
    } if (currentTab == 1) {
        if (bool_comus && bool_settl && bool_addri && bool_zipin && bool_taxad) {valid = true;}
        else {valid = false;}
    } if (currentTab == 2) {
        if (bool_shset && bool_shadd && bool_shzip) {valid = true;}
        else {valid = false;}
    } if (currentTab == 3) {
        if (bool_phone && bool_lsfax && document.getElementById('register_accept_agreement').checked) {valid = true;}
        else {valid = false;
            if (!document.getElementById('register_accept_agreement').checked) {document.getElementById('register_accept_agreement').classList.add('checkbox_not_checked');
                $('#register_accept_agreement').click(function () {this.classList.remove('checkbox_not_checked');});
            }
        }
    }
    if (valid) {
        document.getElementsByClassName("user_act_breadcrumb_con")[currentTab].className += " breadcrumb_desc_active";document.getElementsByClassName("wizard_breadcrumb_item")[currentTab].className += " breadcrumb_desc_active";
        for (i = 0; i < con.length; i++) { con[i].className = con[i].className.replace(" breadcrumb_desc_active", "");
            for (var rect_index = 0; rect_index < con[i].querySelector('svg').querySelector('g').querySelectorAll('rect').length; rect_index++) {
                if (con[i].querySelector('svg').querySelector('g').querySelectorAll('rect')[rect_index].hasAttribute('fill')) {
                    con[i].querySelector('svg').querySelector('g').querySelectorAll('rect')[rect_index].removeAttribute('fill');
                    con[i].querySelector('svg').querySelector('g').querySelectorAll('rect')[rect_index].setAttribute('fill', '#0A3556');
                }
            }
            for (var path_index = 0; path_index < con[i].querySelector('svg').querySelector('g').querySelectorAll('path').length; path_index++) {
                if (con[i].querySelector('svg').querySelector('g').querySelectorAll('path')[path_index].hasAttribute('fill')) {
                    con[i].querySelector('svg').querySelector('g').querySelectorAll('path')[path_index].removeAttribute('fill');
                    con[i].querySelector('svg').querySelector('g').querySelectorAll('path')[path_index].setAttribute('fill', '#0A3556');
                }
            }
        }
    } return valid;
}
function fixStepIndicator(n) {
    var i, x = document.getElementsByClassName("user_act_breadcrumb_con"), connector = document.getElementsByClassName('breadcrumb_item_connector'), svg = document.getElementsByClassName('wizard_breadcrum_icon'), g = svg[n].querySelectorAll('g'), rect = svg[n].querySelectorAll('rect'), path = svg[n].querySelectorAll('path');
    for (i = 0; i < x.length; i++) {
        x[i].className = x[i].className.replace(" breadcrumb_desc_active", "");
        for (var rect_index = 0; rect_index < x[i].querySelector('svg').querySelector('g').querySelectorAll('rect').length; rect_index++) {
            if (x[i].querySelector('svg').querySelector('g').querySelectorAll('rect')[rect_index].hasAttribute('fill')) {
                x[i].querySelector('svg').querySelector('g').querySelectorAll('rect')[rect_index].removeAttribute('fill');
                x[i].querySelector('svg').querySelector('g').querySelectorAll('rect')[rect_index].setAttribute('fill', '#7E8299');
            }
        }
        for (var path_index = 0; path_index < x[i].querySelector('svg').querySelector('g').querySelectorAll('path').length; path_index++) {
            if (x[i].querySelector('svg').querySelector('g').querySelectorAll('path')[path_index].hasAttribute('fill')) {
                x[i].querySelector('svg').querySelector('g').querySelectorAll('path')[path_index].removeAttribute('fill');
                x[i].querySelector('svg').querySelector('g').querySelectorAll('path')[path_index].setAttribute('fill', '#7E8299');
            }
        }
    }
    for (var connector_index = 0; connector_index < connector.length; connector_index++) {
        for (var rect_index = 0; rect_index < connector[connector_index].querySelector('svg').querySelector('g').querySelectorAll('rect').length; rect_index++) {
            if (connector[connector_index].querySelector('svg').querySelector('g').querySelectorAll('rect')[rect_index].hasAttribute('fill')) {
                connector[connector_index].querySelector('svg').querySelector('g').querySelectorAll('rect')[rect_index].removeAttribute('fill');
                connector[connector_index].querySelector('svg').querySelector('g').querySelectorAll('rect')[rect_index].setAttribute('fill', '#7E8299');
            }
        }
        for (var path_index = 0; path_index < connector[connector_index].querySelector('svg').querySelector('g').querySelectorAll('path').length; path_index++) {
            if (connector[connector_index].querySelector('svg').querySelector('g').querySelectorAll('path')[path_index].hasAttribute('fill')) {
                connector[connector_index].querySelector('svg').querySelector('g').querySelectorAll('path')[path_index].removeAttribute('fill');
                connector[connector_index].querySelector('svg').querySelector('g').querySelectorAll('path')[path_index].setAttribute('fill', '#7E8299');
            }
        }
    }
    // Aktiv breadcrumb element beallitasa
    x[n].className += " breadcrumb_desc_active";
    for (i = 0; i < x.length; i++) {
        for (var rect_index = 0; rect_index < x[n].querySelector('svg').querySelector('g').querySelectorAll('rect').length; rect_index++) {
            if (x[n].querySelector('svg').querySelector('g').querySelectorAll('rect')[rect_index].hasAttribute('fill')) {
                x[n].querySelector('svg').querySelector('g').querySelectorAll('rect')[rect_index].removeAttribute('fill');
                x[n].querySelector('svg').querySelector('g').querySelectorAll('rect')[rect_index].setAttribute('fill', '#0A3556');
            }
        }
        for (var path_index = 0; path_index < x[n].querySelector('svg').querySelector('g').querySelectorAll('path').length; path_index++) {
            if (x[n].querySelector('svg').querySelector('g').querySelectorAll('path')[path_index].hasAttribute('fill')) {
                x[n].querySelector('svg').querySelector('g').querySelectorAll('path')[path_index].removeAttribute('fill');
                x[n].querySelector('svg').querySelector('g').querySelectorAll('path')[path_index].setAttribute('fill', '#0A3556');
            }
        }
    }
    for (var connector_index = 0; connector_index < connector.length; connector_index++) {
        for (var rect_index = 0; rect_index < connector[connector_index].querySelector('svg').querySelector('g').querySelectorAll('rect').length; rect_index++) {
            if (connector[n].querySelector('svg').querySelector('g').querySelectorAll('rect')[rect_index].hasAttribute('fill')) {
                connector[n].querySelector('svg').querySelector('g').querySelectorAll('rect')[rect_index].removeAttribute('fill');
                connector[n].querySelector('svg').querySelector('g').querySelectorAll('rect')[rect_index].setAttribute('fill', '#0A3556');
            }
        }
        for (var path_index = 0; path_index < connector[connector_index].querySelector('svg').querySelector('g').querySelectorAll('path').length; path_index++) {
            if (connector[n].querySelector('svg').querySelector('g').querySelectorAll('path')[path_index].hasAttribute('fill')) {
                connector[n].querySelector('svg').querySelector('g').querySelectorAll('path')[path_index].removeAttribute('fill');
                connector[n].querySelector('svg').querySelector('g').querySelectorAll('path')[path_index].setAttribute('fill', '#0A3556');
            }
        }
    } document.getElementsByClassName("wizard_breadcrumb_item")[n].className += " breadcrumb_desc_active";
}