var isMobile;
if( /Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgentData) || window.innerWidth <= 600) {isMobile = true; 
    if (document.getElementById('header_desktop_button')) {
        $.ajax({ enctype: "multipart/form-data", type: "POST", url: "/actions/is__logged.php", dataType: 'json', contentType: false, processData: false,
            success: function(data) { if (data === 200) { document.getElementById('header_desktop_button_profile').setAttribute('onclick', 'openSidenav()'); } }
        });
    }
} else {isMobile = false;if (document.getElementById('header_desktop_button')) {
    $.ajax({ enctype: "multipart/form-data", type: "POST", url: "/actions/is__logged.php", dataType: 'json', contentType: false, processData: false,
        success: function(data) { if (data === 200) { document.getElementById('header_desktop_button').setAttribute("onclick", "openHeaderProfileActionLogged()"); } else { document.getElementById('header_desktop_button').setAttribute("onclick", "openHeaderProfileAction('desktop');"); } }
    });
}}
if (document.getElementById('header_desktop_button_profile')) {document.getElementById('header_desktop_button_profile').setAttribute('onclick', 'openHeaderProfileActionLogged()');}
var wrapper = document.createElement('div');var wizard_form_script = document.createElement('script');
wizard_form_script.setAttribute('src', '/assets/script/wizard.js');wrapper.classList = 'wrapper_dark';
wrapper.id = 'wrapper';wrapper.setAttribute('onclick', 'closeHeaderProfileAction()');var passfield;
function showPass (pass) { passfield = $('input[name='+pass+']')[0];
    if (passfield.getAttribute('type') == 'password') { $('input[name='+pass+']')[0].setAttribute('type', 'textfield');$('input[name='+pass+']')[0].parentNode.getElementsByTagName('div')[0].innerHTML = `<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1"><g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"><rect x="0" y="0" width="24" height="24"/><path d="M19.2078777,9.84836149 C20.3303823,11.0178941 21,12 21,12 C21,12 16.9090909,18 12,18 C11.6893441,18 11.3879033,17.9864845 11.0955026,17.9607365 L19.2078777,9.84836149 Z" class="svg" opacity='0.5' fill-rule="nonzero"/><path d="M14.5051465,6.49485351 L12,9 C10.3431458,9 9,10.3431458 9,12 L5.52661464,15.4733854 C3.75006453,13.8334911 3,12 3,12 C3,12 5.45454545,6 12,6 C12.8665422,6 13.7075911,6.18695134 14.5051465,6.49485351 Z" class="svg" opacity='0.5' fill-rule="nonzero"/><rect class="svg" opacity="1" transform="translate(12.524621, 12.424621) rotate(-45.000000) translate(-12.524621, -12.424621) " x="3.02462111" y="11.4246212" width="19" height="2"/></g></svg>`;}
    else {$('input[name='+pass+']')[0].setAttribute('type', 'password');$('input[name='+pass+']')[0].parentNode.getElementsByTagName('div')[0].innerHTML = `<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1"><g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"><rect x="0" y="0" width="24" height="24"/><path d="M3,12 C3,12 5.45454545,6 12,6 C16.9090909,6 21,12 21,12 C21,12 16.9090909,18 12,18 C5.45454545,18 3,12 3,12 Z" class="svg" fill-rule="nonzero" opacity="0.4"/><path d="M12,15 C10.3431458,15 9,13.6568542 9,12 C9,10.3431458 10.3431458,9 12,9 C13.6568542,9 15,10.3431458 15,12 C15,13.6568542 13.6568542,15 12,15 Z" class="svg" opacity="0.5"/></g></svg>`;}
}
var coll = document.getElementsByClassName("collapsible"); var collInn = document.getElementsByClassName("serviceItemsCollapsible"); var i, j;
for (i = 0; i < coll.length; i++) {coll[i].addEventListener("click", function() { var content = this.nextElementSibling; if (content.style.maxHeight){ content.style.maxHeight = null; } else { content.style.maxHeight = "unset"; } });}
for (j = 0; j < collInn.length; j++) {collInn[j].addEventListener("click", function() { var contentIn = this.nextElementSibling; if (contentIn.style.maxHeight){ contentIn.style.maxHeight = null; } else { contentIn.style.maxHeight = contentIn.scrollHeight + "px"; } });}
var news_item = document.getElementsByClassName('news_container'); var news_item_id; var y;
for (y = 0; y < news_item.length; y++) { news_item_id = news_item[y].id.slice(-1); news_item[y].style.backgroundImage = "url('/assets/images/news/" + news_item_id + ".jpg')"; }
var header_title =  document.getElementById('header_title'); var header_search = document.getElementById('header_search'); var header_middle = document.getElementById('header_middle'); var header_middle_backup = document.createElement('div');
header_middle_backup.id = 'header_middle'; header_middle_backup.classList.add('flex'); header_middle_backup.classList.add('flex-col');
header_middle_backup.innerHTML = `<div class='header_search_location_con'><div class='header_location_ind'><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="18px" height="18px" viewBox="0 0 24 24" version="1.1"><g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"><rect x="0" y="0" width="18" height="18"/><path d="M5,10.5 C5,6 8,3 12.5,3 C17,3 20,6.75 20,10.5 C20,12.8325623 17.8236613,16.03566 13.470984,20.1092932 C12.9154018,20.6292577 12.0585054,20.6508331 11.4774555,20.1594925 C7.15915182,16.5078313 5,13.2880005 5,10.5 Z M12.5,12 C13.8807119,12 15,10.8807119 15,9.5 C15,8.11928813 13.8807119,7 12.5,7 C11.1192881,7 10,8.11928813 10,9.5 C10,10.8807119 11.1192881,12 12.5,12 Z" class="svg" fill-rule="nonzero"/></g></svg><span onclick="window.location.href='';">6400 Kiskunhalas, Kossuth utca 13-15.</span></div></div><div class='row'><div id='header_search' class='header_search width-100'><div class='header_search_input'><input type='text' class='header_input header_input_mobile flex width-80 outline-none border-none' id='main_search' name='main_search' placeholder='Keresés termékeink között..'></div></div><div id='header_desktop_button_profile' class='header_heading_button user_action_button pointer flex flex-align-c flex-justify-con-c' onclick="openHeaderProfileAction('`+ isMobile +`');"><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1"><g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"><polygon points="0 0 24 0 24 24 0 24"/><path d="M12,11 C9.790861,11 8,9.209139 8,7 C8,4.790861 9.790861,3 12,3 C14.209139,3 16,4.790861 16,7 C16,9.209139 14.209139,11 12,11 Z" class="svg" fill-rule="nonzero" opacity="0.3"/><path d="M3.00065168,20.1992055 C3.38825852,15.4265159 7.26191235,13 11.9833413,13 C16.7712164,13 20.7048837,15.2931929 20.9979143,20.2 C21.0095879,20.3954741 20.9979143,21 20.2466999,21 C16.541124,21 11.0347247,21 3.72750223,21 C3.47671215,21 2.97953825,20.45918 3.00065168,20.1992055 Z" class="svg" fill-rule="nonzero"/></g></svg></div></div>`;
class swiperCaller { static news; }
const sideNav = document.createElement('div'); sideNav.id = 'sidenav'; sideNav.classList = "sidenav";
if (window.innerWidth > 992) { sideNav.remove();
    const swiper_news = new Swiper('.swiper-news', {slidesPerView: 3,spaceBetween: 10,direction: 'horizontal',loop: true, pagination: {el: '.swiper-pagination',},  autoplay: {delay: 5000,disableOnInteraction: false,}, });
    swiperCaller.news = swiper_news;
} else { header_middle.remove();
    if (document.getElementById('header_desktop_button')) { document.getElementById('header_desktop_button').remove(); } 
    if (document.getElementById('header_desktop_button_profile')) { document.getElementById('header_desktop_button_profile').remove(); }
    document.getElementById('header_con').append(header_middle_backup); document.body.prepend(sideNav);
    if (document.getElementById('header_desktop_button')) {
        document.getElementById('header_desktop_button').removeAttribute('onclick'); document.getElementById('header_desktop_button').setAttribute('onclick', 'openSidenav()');
        document.getElementById('header_desktop_button').innerHTML = `<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1"><g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"><rect x="0" y="0" width="24" height="24"/><rect class="svg" x="0" y="5" width="24" height="3" rx="1.5"/><rect class="svg" x="0" y="12" width="24" height="3" rx="1.5"/><rect class="svg" x="0" y="19" width="24" height="3" rx="1.5"/></g></svg>`;
    } if (document.getElementById('header_desktop_button_profile')) {
        document.getElementById('header_desktop_button_profile').removeAttribute('onclick'); document.getElementById('header_desktop_button_profile').setAttribute('onclick', 'openSidenav()');
        document.getElementById('header_desktop_button_profile').innerHTML = `<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1"><g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"><rect x="0" y="0" width="24" height="24"/><rect class="svg" x="0" y="5" width="24" height="3" rx="1.5"/><rect class="svg" x="0" y="12" width="24" height="3" rx="1.5"/><rect class="svg" x="0" y="19" width="24" height="3" rx="1.5"/></g></svg>`;
    }
    const swiper_news = new Swiper('.swiper-news', { direction: 'horizontal', loop: true, pagination: {el: '.swiper-pagination',}, autoplay: {delay: 5000,disableOnInteraction: false,},      }); 
    swiperCaller.news = swiper_news;
}

function disableSwipers () { swiperCaller.news.autoplay.stop(); swiperCaller.news.disable();}
function enableSwipers () { swiperCaller.news.autoplay.start(); swiperCaller.news.enable();}

function openTab(evt, tabName) {
    var i, tabcontent, tablinks; tabcontent = document.getElementsByClassName("tabcontent");
    for (i = 0; i < tabcontent.length; i++) { tabcontent[i].style.display = "none"; }
    tablinks = document.getElementsByClassName("tablinks");
    for (i = 0; i < tablinks.length; i++) { tablinks[i].className = tablinks[i].className.replace(" double_menu_active", ""); }
    document.getElementById(tabName).style.display = "flex"; evt.currentTarget.className += " double_menu_active";
}
if (document.getElementById('defaultOpen')) { document.getElementById("defaultOpen").click(); }
if (document.getElementById('prod_categ_container')) {
    document.addEventListener('DOMContentLoaded', function () {
        const ele = document.getElementById('prod_categ_container');
        ele.style.cursor = 'grab';let pos = { top: 0, left: 0, x: 0, y: 0 };
        const mouseDownHandler = function (e) {
            ele.style.cursor = 'grabbing'; ele.style.userSelect = 'none';pos = {left: ele.scrollLeft,top: ele.scrollTop,x: e.clientX,y: e.clientY,};
            document.addEventListener('mousemove', mouseMoveHandler);document.addEventListener('mouseup', mouseUpHandler);
        };
        const mouseMoveHandler = function (e) {const dx = e.clientX - pos.x;const dy = e.clientY - pos.y;ele.scrollTop = pos.top - dy;ele.scrollLeft = pos.left - dx;};
        const mouseUpHandler = function () {ele.style.cursor = 'grab';ele.style.removeProperty('user-select');document.removeEventListener('mousemove', mouseMoveHandler);document.removeEventListener('mouseup', mouseUpHandler);};
        ele.addEventListener('mousedown', mouseDownHandler);
    });
}
var profileHeaderContainer = document.createElement('div'); profileHeaderContainer.id = 'profileHeaderContainer'; var userLogged;
function setWizardHome () {profileHeaderContainer.innerHTML = `<div class='user_action_con' id='wizard_con'><div class='user_action_con_mobile_handler' id='user_action_con_mobile_handler'></div><div class='user_act_wrapper'><div class='user_act_breadcrumb wizard_brdcrmb align_right_h'><div class='user_act_breadcrumb_con'><div class='wizard_breadcrumb_item'><span class='wizard_close' onclick='closeHeaderProfileAction()'>&times;</span></div></div></div><div class='user_act_wizard'><div class='wizard_container'><div class='wizard_main_image_con'></div><div class='wizard_selection_con'><div class='wizard_sl_btn button button-primary' onclick='openRegisterForm();'>Regisztráció</div><div class='wizard_sl_btn button button-secondary' onclick='openLoginForm();'>Bejelentkezés</div></div><div class='small_info'><span>A Regisztráció gombra kattintva elfogadja feltételeinket. Az <a href="#">Adatvédelmi szabályzatunkban</a> megtudhatja, hogyan gyűjtjük, használjuk és osztjuk meg az Ön adatait, és hogyan használjuk a cookie-kat és a hasonló technológiát a <a href="#">Cookie-szabályzatunkban</a>. SMS-értesítéseket kaphat tőlünk, és bármikor <a href="#">leiratkozhat</a>.</span></div></div></div></div></div>`;}
setWizardHome();
function openHeaderProfileAction (device_type) { document.getElementsByTagName('html')[0].classList.add('stop-scroll', 'stop-scroll-mobile');
    document.body.append(wrapper); document.getElementById('header_con').append(profileHeaderContainer); document.body.style.overflowX = 'hidden'; document.body.style.width = '100%';
    document.getElementById('wizard_con').classList.remove('panelSlideDown'); document.getElementById('wizard_con').classList.add('panelSlideUp'); disableSwipers();
} function openRegisterForm () { $('#profileHeaderContainer').load('/includes/addons/register.html'); }
var currentTab = 0; var bool_fname, bool_email, bool_passw, bool_passc, bool_comus, bool_settl, bool_addri, bool_zipin, bool_taxad, bool_shset, bool_shadd, bool_shzip, bool_phone, bool_lsfax, bool_accep = false;
function validate(name) {
    if (currentTab == 0) {
        switch (name) {
            case 'register_fullname':
                if ($('input[name="register_fullname"]')[0].value.length > 6 && $('input[name="register_fullname"]')[0].value !== '') {$('input[name="register_fullname"]')[0].parentNode.lastElementChild.removeAttribute('emsg');bool_fname = true; return true;}
                else { $('input[name="register_fullname"]')[0].parentNode.lastElementChild.setAttribute('emsg', 'Érvénytelen név');bool_fname = false;return false;}
            break;
            case 'register_email':
                if ($('input[name="register_email"]')[0].value.match(/^([a-z\d!#$%&'*+\-\/=?^_`{|}~\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]+(\.[a-z\d!#$%&'*+\-\/=?^_`{|}~\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]+)*|"((([ \t]*\r\n)?[ \t]+)?([\x01-\x08\x0b\x0c\x0e-\x1f\x7f\x21\x23-\x5b\x5d-\x7e\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]|\\[\x01-\x09\x0b\x0c\x0d-\x7f\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]))*(([ \t]*\r\n)?[ \t]+)?")@(([a-z\d\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]|[a-z\d\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF][a-z\d\-._~\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]*[a-z\d\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])\.)+([a-z\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]|[a-z\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF][a-z\d\-._~\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]*[a-z\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])\.?$/i) && $('input[name="register_email"]')[0].value !== '') {$('input[name="register_email"]')[0].parentNode.lastElementChild.removeAttribute('emsg');bool_email = true;return true;}
                else { $('input[name="register_email"]')[0].parentNode.lastElementChild.setAttribute('emsg', 'Ez az email érvénytelen!');bool_email = false;return false;}
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
                else {$('input[name="register_address_invoice"]')[0].parentNode.lastElementChild.setAttribute('emsg', 'Érvénytelen cím!');bool_addri = false;return false;}
            break;
            case 'register_zip_invoice': 
                if ($('input[name="register_zip_invoice"]')[0].value.match(/^[0-9]{4}$/) && $('input[name="register_zip_invoice"]')[0].value !== '') {$('input[name="register_zip_invoice"]')[0].parentNode.lastElementChild.removeAttribute('emsg');bool_zipin = true;return true;}
                else {$('input[name="register_zip_invoice"]')[0].parentNode.lastElementChild.setAttribute('emsg', 'Érvénytelen irányítószám!');bool_zipin = false;return false;}
            break;
            case 'register_tax': 
                if ($('input[name="register_tax"]')[0].value.match(/^[0-9]{9}$/) && $('input[name="register_tax"]')[0].value !== '') {$('input[name="register_tax"]')[0].parentNode.lastElementChild.removeAttribute('emsg');bool_taxad = true;return true;}
                else {$('input[name="register_tax"]')[0].parentNode.lastElementChild.setAttribute('emsg', 'Érvénytelen adószám/adóazonosító!');bool_taxad = false;return false;}
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
} function showTab(n) {
    var x = document.getElementsByClassName("wizard_tab");x[n].style.display = "block";x[currentTab].getElementsByClassName("wizard_input")[0].focus();
    if (n == 0) {document.getElementById("wizard_prev_btn").style.display = "none";
    } else {document.getElementById("wizard_prev_btn").style.display = "flex";
    }if (n == (x.length - 1)) {document.getElementById("wizard_next_btn").innerHTML = "Beküldés";
    } else {document.getElementById("wizard_next_btn").innerHTML = "Következő";}fixStepIndicator(n);
} function nextPrev(n) {
    var x = document.getElementsByClassName("wizard_tab");
    if (n == 1 && !validateForm()) return false;
    x[currentTab].style.display = "none"; currentTab = currentTab + n;
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
    }
    showTab(currentTab);
} function validateForm() {
    var x, y, i, valid = true, con = document.getElementsByClassName("user_act_breadcrumb_con"), inp;
    x = document.getElementsByClassName("wizard_tab");
    y = x[currentTab].getElementsByTagName("input");
    inp = x[currentTab].getElementsByClassName('wizard_input')
    for (i = 0; i < y.length; i++) {if (y[i].value == "") {inp[i].parentNode.lastElementChild.innerHTML = `<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1"><g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"><rect x="0" y="0" width="24" height="24"/><rect fill="#F64E60" x="11" y="7" width="2" height="8" rx="1"/><rect fill="#F64E60" x="11" y="16" width="2" height="2" rx="1"/></g></svg>`;valid = false;}}
    if (currentTab == 0) {if (bool_fname && bool_email && bool_passw && bool_passc) {valid = true;} else {valid = false;}
    } if (currentTab == 1) {if (bool_comus && bool_settl && bool_addri && bool_zipin && bool_taxad) {valid = true;} else {valid = false;}
    } if (currentTab == 2) {if (bool_shset && bool_shadd && bool_shzip) {valid = true;} else {valid = false;}
    } if (currentTab == 3) {if (bool_phone && bool_lsfax && document.getElementById('register_accept_agreement').checked) {valid = true;
    } else {valid = false;if (!document.getElementById('register_accept_agreement').checked) {document.getElementById('register_accept_agreement').classList.add('checkbox_not_checked');$('#register_accept_agreement').click(function () {this.classList.remove('checkbox_not_checked');});}
    }}
    if (valid) {
        document.getElementsByClassName("user_act_breadcrumb_con")[currentTab].className += " breadcrumb_desc_active";document.getElementsByClassName("wizard_breadcrumb_item")[currentTab].className += " breadcrumb_desc_active";
        for (i = 0; i < con.length; i++) {
            con[i].className = con[i].className.replace(" breadcrumb_desc_active", "");
            for (var rect_index = 0; rect_index < con[i].querySelector('svg').querySelector('g').querySelectorAll('rect').length; rect_index++) {if (con[i].querySelector('svg').querySelector('g').querySelectorAll('rect')[rect_index].hasAttribute('fill')) {con[i].querySelector('svg').querySelector('g').querySelectorAll('rect')[rect_index].removeAttribute('fill');con[i].querySelector('svg').querySelector('g').querySelectorAll('rect')[rect_index].setAttribute('fill', '#0A3556');}}
            for (var path_index = 0; path_index < con[i].querySelector('svg').querySelector('g').querySelectorAll('path').length; path_index++) {if (con[i].querySelector('svg').querySelector('g').querySelectorAll('path')[path_index].hasAttribute('fill')) {con[i].querySelector('svg').querySelector('g').querySelectorAll('path')[path_index].removeAttribute('fill');con[i].querySelector('svg').querySelector('g').querySelectorAll('path')[path_index].setAttribute('fill', '#0A3556');}}
        }
    } return valid;
} function fixStepIndicator(n) {
    var i, x = document.getElementsByClassName("user_act_breadcrumb_con"), connector = document.getElementsByClassName('breadcrumb_item_connector'), svg = document.getElementsByClassName('wizard_breadcrum_icon'), g = svg[n].querySelectorAll('g'), rect = svg[n].querySelectorAll('rect'), path = svg[n].querySelectorAll('path');
    for (i = 0; i < x.length; i++) {
        x[i].className = x[i].className.replace(" breadcrumb_desc_active", "");
        for (var rect_index = 0; rect_index < x[i].querySelector('svg').querySelector('g').querySelectorAll('rect').length; rect_index++) {if (x[i].querySelector('svg').querySelector('g').querySelectorAll('rect')[rect_index].hasAttribute('fill')) {x[i].querySelector('svg').querySelector('g').querySelectorAll('rect')[rect_index].removeAttribute('fill');x[i].querySelector('svg').querySelector('g').querySelectorAll('rect')[rect_index].setAttribute('fill', '#7E8299');}}
        for (var path_index = 0; path_index < x[i].querySelector('svg').querySelector('g').querySelectorAll('path').length; path_index++) {if (x[i].querySelector('svg').querySelector('g').querySelectorAll('path')[path_index].hasAttribute('fill')) {x[i].querySelector('svg').querySelector('g').querySelectorAll('path')[path_index].removeAttribute('fill');x[i].querySelector('svg').querySelector('g').querySelectorAll('path')[path_index].setAttribute('fill', '#7E8299');}}
    } for (var connector_index = 0; connector_index < connector.length; connector_index++) {
        for (var rect_index = 0; rect_index < connector[connector_index].querySelector('svg').querySelector('g').querySelectorAll('rect').length; rect_index++) {if (connector[connector_index].querySelector('svg').querySelector('g').querySelectorAll('rect')[rect_index].hasAttribute('fill')) {connector[connector_index].querySelector('svg').querySelector('g').querySelectorAll('rect')[rect_index].removeAttribute('fill');connector[connector_index].querySelector('svg').querySelector('g').querySelectorAll('rect')[rect_index].setAttribute('fill', '#7E8299');}}
        for (var path_index = 0; path_index < connector[connector_index].querySelector('svg').querySelector('g').querySelectorAll('path').length; path_index++) {if (connector[connector_index].querySelector('svg').querySelector('g').querySelectorAll('path')[path_index].hasAttribute('fill')) {connector[connector_index].querySelector('svg').querySelector('g').querySelectorAll('path')[path_index].removeAttribute('fill');connector[connector_index].querySelector('svg').querySelector('g').querySelectorAll('path')[path_index].setAttribute('fill', '#7E8299');}}
    } x[n].className += " breadcrumb_desc_active"; for (i = 0; i < x.length; i++) {
        for (var rect_index = 0; rect_index < x[n].querySelector('svg').querySelector('g').querySelectorAll('rect').length; rect_index++) {if (x[n].querySelector('svg').querySelector('g').querySelectorAll('rect')[rect_index].hasAttribute('fill')) {x[n].querySelector('svg').querySelector('g').querySelectorAll('rect')[rect_index].removeAttribute('fill');x[n].querySelector('svg').querySelector('g').querySelectorAll('rect')[rect_index].setAttribute('fill', '#0A3556');}}
        for (var path_index = 0; path_index < x[n].querySelector('svg').querySelector('g').querySelectorAll('path').length; path_index++) {if (x[n].querySelector('svg').querySelector('g').querySelectorAll('path')[path_index].hasAttribute('fill')) {x[n].querySelector('svg').querySelector('g').querySelectorAll('path')[path_index].removeAttribute('fill');x[n].querySelector('svg').querySelector('g').querySelectorAll('path')[path_index].setAttribute('fill', '#0A3556');}}
    } for (var connector_index = 0; connector_index < connector.length; connector_index++) {
        for (var rect_index = 0; rect_index < connector[connector_index].querySelector('svg').querySelector('g').querySelectorAll('rect').length; rect_index++) {if (connector[n].querySelector('svg').querySelector('g').querySelectorAll('rect')[rect_index].hasAttribute('fill')) {connector[n].querySelector('svg').querySelector('g').querySelectorAll('rect')[rect_index].removeAttribute('fill');connector[n].querySelector('svg').querySelector('g').querySelectorAll('rect')[rect_index].setAttribute('fill', '#0A3556');}}
        for (var path_index = 0; path_index < connector[connector_index].querySelector('svg').querySelector('g').querySelectorAll('path').length; path_index++) {if (connector[n].querySelector('svg').querySelector('g').querySelectorAll('path')[path_index].hasAttribute('fill')) {connector[n].querySelector('svg').querySelector('g').querySelectorAll('path')[path_index].removeAttribute('fill');connector[n].querySelector('svg').querySelector('g').querySelectorAll('path')[path_index].setAttribute('fill', '#0A3556');}}
    } document.getElementsByClassName("wizard_breadcrumb_item")[n].className += " breadcrumb_desc_active";
} function openLoginForm () { profileHeaderContainer.innerHTML = `<div class='user_action_con' id='wizard_con'><div class='user_action_con_mobile_handler' id='user_action_con_mobile_handler'></div><div class='user_act_wrapper'><div class='user_act_breadcrumb align_left_h'><div class="user_act_breadcrumb_con"><div class="wizard_breadcrumb_item"><span class="wizard_title">Belépési adatok</span></div></div></div><div class='user_act_wizard col login_wizard_con'><div class='wizard_main_image_con wizard_login_img_con'></div><form id='wizard_login_form' method='POST' action='/actions/auth.php'><div class='wizard_tab_login'><div class='wizard_tab_main'><div class='wizard_tab_main_item'><span class='wizard_input_name'>E-mail cím</span><div class='flex row'><input class='wizard_input wizard_login_input' type='text' name='register_email' id="login__email" placeholder='mintamisi@email.hu' autocomplete='email' /></div></div><div class='wizard_tab_main_item'><span class='wizard_input_name'>Jelszó</span><div class='flex row'><input class='wizard_input wizard_login_input wizard_login_input_pass' type="password" name='register_password' id="login__password" autocomplete='new-password' style="width: 100% !important;" /><div class='wizard_input_password_show wizard_login_status' onclick="showPass('register_password')"><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1"><g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"><rect x="0" y="0" width="24" height="24"/><path d="M3,12 C3,12 5.45454545,6 12,6 C16.9090909,6 21,12 21,12 C21,12 16.9090909,18 12,18 C5.45454545,18 3,12 3,12 Z" class="svg" fill-rule="nonzero" opacity="0.4"/><path d="M12,15 C10.3431458,15 9,13.6568542 9,12 C9,10.3431458 10.3431458,9 12,9 C13.6568542,9 15,10.3431458 15,12 C15,13.6568542 13.6568542,15 12,15 Z" class="svg" opacity="0.5"/></g></svg></div></div><label class='wizard_input_info flex flex-row flex-align-c flex-justify-con-sb' id="logerr__con"><a href="#">Elfelejtett jelszó?</a></label></div></div></div></form></div><div class='wizard_act_btn_con'><div><div id='wizard_back_to_main' class='wizard_act_btn button button-secondary' onclick='wizardHome();'>Kilépés</div></div><div class='flex'><div id='wizard_next_btn' class='wizard_act_btn button button-primary' onclick="tryLogin()">Belépés</div></div></div></div></div>`;}
var logerr = document.createElement('span'); logerr.classList = "small-med text-danger"; logerr.textContent = "Hibás adatokat adott meg!";
function tryLogin () { document.getElementById("wizard_next_btn").textContent = "Ellenőrzés..."; let apiKey = '739837e232548988c86b954108794b57bd3e1dbcd6eb550bfa53e544';
    $.getJSON('https://api.ipdata.co?api-key=' + apiKey, function(data) { var log__data = new FormData();
        const getDeviceType = () => { const ua = navigator.userAgent;
            if (/(tablet|ipad|playbook|silk)|(android(?!.*mobi))/i.test(ua)) { return "tablet"; }
            if ( /Mobile|iP(hone|od)|Android|BlackBerry|IEMobile|Kindle|Silk-Accelerated|(hpw|web)OS|Opera M(obi|ini)/.test(ua)) { return "mobile";}
            return "desktop";
        }; log__data.append("email", $('#login__email').val()); log__data.append("password", $('#login__password').val()); log__data.append("device", getDeviceType()); log__data.append("ip", data.ip); log__data.append("city", data.city); log__data.append("region", data.region); log__data.append("country", data.country_name);
        $.ajax({ enctype: "multipart/form-data", type: "POST", url: "/actions/auth.php", data: log__data, dataType: 'json', contentType: false, processData: false,
            success: function(res) {
                if (res === 200) { closeHeaderProfileAction(); notificationSystem(0, 0, 0, 'Bejelentkezés', 'Sikeres bejelentkezés'); window.location.reload(true); }
                if (res === 410) { document.getElementById("wizard_next_btn").textContent = "Belépés"; document.getElementById("login__email").value = ""; document.getElementById("login__password").value = ""; if (!document.getElementById('logerr__con').contains(logerr)) { document.getElementById('logerr__con').append(logerr); } }
            }, error: function (res) { document.getElementById("wizard_next_btn").textContent = "Belépés"; document.getElementById("login__email").value = ""; document.getElementById("login__password").value = ""; if (!document.getElementById('logerr__con').contains(logerr)) { document.getElementById('logerr__con').append(logerr); } }
        });
    }); 
}
function wizardHome () { setWizardHome(); wizard_form_script.remove();}
function closeHeaderProfileAction() { document.getElementsByTagName('html')[0].classList.remove('stop-scroll', 'stop-scroll-mobile'); document.getElementById('wizard_con').classList.remove('panelSlideUp'); document.getElementById('wizard_con').classList.add('panelSlideDown');setTimeout(function () { wrapper.remove(); profileHeaderContainer.remove(); document.body.style.overflowX = 'hidden'; document.body.style.width = '100%'; wizard_form_script.remove(); }, 340); enableSwipers();}
var root = document.getElementsByTagName( 'html' )[0]; var sidenavAddon = document.createElement('div');
sidenavAddon.classList = 'sidenavAddon'; sidenavAddon.id = 'sidenavAddon';
function openSidenav() {
    document.body.prepend(sidenavAddon); root.classList.add('stop-scroll');
    document.getElementById('sidenav').innerHTML = `<span class="sidenav-loader" id="sidenav-loader"><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="64px" height="64px" viewBox="0 0 24 24" version="1.1"><g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"><g><polygon points="0 0 24 0 24 24 0 24"/></g><path d="M12,4 L12,6 C8.6862915,6 6,8.6862915 6,12 C6,15.3137085 8.6862915,18 12,18 C15.3137085,18 18,15.3137085 18,12 C18,10.9603196 17.7360885,9.96126435 17.2402578,9.07513926 L18.9856052,8.09853149 C19.6473536,9.28117708 20,10.6161442 20,12 C20,16.418278 16.418278,20 12,20 C7.581722,20 4,16.418278 4,12 C4,7.581722 7.581722,4 12,4 Z" class="svg" fill-rule="nonzero" opacity="0.3" transform="translate(12.000000, 12.000000) scale(-1, 1) translate(-12.000000, -12.000000) "/></g></svg></span>`;
    setTimeout(function () { $('#sidenav').load('/includes/addons/sidenav.php'); }, 400);
    document.getElementById("sidenav").style.width = "100%";
    var con = document.getElementById('sidenav');var mc = new Hammer(con);
    mc.get('pan').set({ direction: Hammer.DIRECTION_ALL }); mc.on("panright", function(ev) {
        sideNav.innerHTML = `<span class="sidenav-loader" id="sidenav-loader"><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="64px" height="64px" viewBox="0 0 24 24" version="1.1"><g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"><g><polygon points="0 0 24 0 24 24 0 24"/></g><path d="M12,4 L12,6 C8.6862915,6 6,8.6862915 6,12 C6,15.3137085 8.6862915,18 12,18 C15.3137085,18 18,15.3137085 18,12 C18,10.9603196 17.7360885,9.96126435 17.2402578,9.07513926 L18.9856052,8.09853149 C19.6473536,9.28117708 20,10.6161442 20,12 C20,16.418278 16.418278,20 12,20 C7.581722,20 4,16.418278 4,12 C4,7.581722 7.581722,4 12,4 Z" class="svg" fill-rule="nonzero" opacity="0.3" transform="translate(12.000000, 12.000000) scale(-1, 1) translate(-12.000000, -12.000000) "/></g></svg></span>`;
        document.getElementById("sidenav").style.width = "0"; root.classList.remove('stop-scroll'); setTimeout(function () { sideNav.innerHTML = ``; }, 400);
    });
} function closeSidenav() {
    closeSidenavAddons('theme'); closeSidenavAddons('language');
    sideNav.innerHTML = `<span class="sidenav-loader" id="sidenav-loader"><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="64px" height="64px" viewBox="0 0 24 24" version="1.1"><g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"><g><polygon points="0 0 24 0 24 24 0 24"/></g><path d="M12,4 L12,6 C8.6862915,6 6,8.6862915 6,12 C6,15.3137085 8.6862915,18 12,18 C15.3137085,18 18,15.3137085 18,12 C18,10.9603196 17.7360885,9.96126435 17.2402578,9.07513926 L18.9856052,8.09853149 C19.6473536,9.28117708 20,10.6161442 20,12 C20,16.418278 16.418278,20 12,20 C7.581722,20 4,16.418278 4,12 C4,7.581722 7.581722,4 12,4 Z" class="svg" fill-rule="nonzero" opacity="0.3" transform="translate(12.000000, 12.000000) scale(-1, 1) translate(-12.000000, -12.000000) "/></g></svg></span>`;
    document.getElementById("sidenav").style.width = "0"; root.classList.remove('stop-scroll'); setTimeout(function () { sideNav.innerHTML = ``; }, 400);
}
function openSidenavAddons (addon) {
    if (!document.getElementsByClassName('sidenav-inner')[0].contains(sidenavAddon)) { document.getElementsByClassName('sidenav-inner')[0].prepend(sidenavAddon); }
    document.getElementsByClassName('sidenav-body')[0].classList.add('stop-scroll'); document.getElementsByClassName('sidenav-body')[0].classList.add('blured');
    $.ajax({
        type: "POST", url: "/includes/addons/mobile/"+ addon +".php", data: 1, cache: false,
        beforeSend: function () {
            sidenavAddon.style.height = "100%"; sidenavAddon.style.minHeight = "100%"; sidenavAddon.innerHTML = `<span class="sidenav-loader" id="sidenav-loader"><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="64px" height="64px" viewBox="0 0 24 24" version="1.1"><g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"><g><polygon points="0 0 24 0 24 24 0 24"/></g><path d="M12,4 L12,6 C8.6862915,6 6,8.6862915 6,12 C6,15.3137085 8.6862915,18 12,18 C15.3137085,18 18,15.3137085 18,12 C18,10.9603196 17.7360885,9.96126435 17.2402578,9.07513926 L18.9856052,8.09853149 C19.6473536,9.28117708 20,10.6161442 20,12 C20,16.418278 16.418278,20 12,20 C7.581722,20 4,16.418278 4,12 C4,7.581722 7.581722,4 12,4 Z" class="svg" fill-rule="nonzero" opacity="0.3" transform="translate(12.000000, 12.000000) scale(-1, 1) translate(-12.000000, -12.000000) "/></g></svg></span>`;
        }, success: function() { $('#sidenavAddon').load('/includes/addons/mobile/'+ addon +'.php');
        }, error: function (response) {
            function checkCode (code) {
                switch (code) {
                    case 400: return "A kérés nem teljesíthető rossz szintaxis miatt.";
                    case 404: return "Az oldal, amelyet megpróbált elérni, nem létezik, vagy áthelyezték.";
                    case 403: return "Nincs hozzáférése az oldal eléréséhez!";
                }
            } sidenavAddon.innerHTML = ` <div class="flex flex-col flex-justify-con-c flex-align-c h-100"><div class="text-danger bold sidenav-error">`+ response.status +`</div><div class="text-secondary small">(${response.statusText})</div><div class="text-secondary text-align-c">${checkCode(response.status)}</div><div class="button button-primary" style="margin-top: 1rem" onclick="closeSidenavAddons('theme');">Vissza</div></div>`;
        }
    });
    var con = document.getElementById('sidenavAddon');var mc = new Hammer(con);
    mc.get('pan').set({ direction: Hammer.DIRECTION_ALL }); mc.on("pandown", function(ev) {
        closeSidenavAddons();
    });
}

const staffAddon = document.createElement('div'); staffAddon.classList = "staffAddon"; staffAddon.id = "staffAddon";
const now = new Date(); const staffTries = { triesNum : "3", triesExpiry : now.setSeconds(3600) }; const getStaffTries = localStorage.getItem('staffTries');
if (getStaffTries) { const now = new Date(); const triesParams = JSON.parse(getStaffTries); if (now.getTime() > triesParams.triesExpiry) { localStorage.removeItem('staffTries'); } }
function closeSidenavAddons (addon) { closeStaffAddon(); sideNav.classList.remove('blured'); document.getElementsByTagName( 'html' )[0].classList.remove('stop-scroll'); sidenavAddon.style.minHeight = "0"; document.getElementsByClassName('sidenav-body')[0].classList.remove('blured'); document.getElementsByClassName('sidenav-body')[0].classList.remove('stop-scroll'); sidenavAddon.style.height = "0"; }
var createNotification = document.createElement('div');createNotification.classList = 'notification notificationIn flex flex-col flex-align-c fixed';
createNotification.innerHTML = `<div class='flex flex-row notificationPadding w-100'><div class='flex'><div class='notificationIcon'><span class='skeletonSvg'></span></div><div class='flex flex-col'><div class='flex notificationTitle'><span class='skeletonTitle'></span></div><div class='flex notificationText'><span class='skeletonDesc'></span></div></div></div></div><div class='flex notificationIntervalIndicator'></div>`;
var notification = document.getElementsByClassName('notification'); var notificationTitle = document.getElementsByClassName('notificationTitle'); var notificationIcon = document.getElementsByClassName('notificationIcon');
var notificationText = document.getElementsByClassName('notificationText'); var notificationIndicator = document.getElementsByClassName('notificationIntervalIndicator'); var notificationTexts = [];
function notificationSystem(type, icon, theme, title, desc) {
    document.body.prepend(createNotification); var notificationTypes = ["success", "error", "unknown"];
    var notificationThemes = ["var(--section-title)"];
    var notificationIcons = [
        `<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="32px" height="32px" viewBox="0 0 24 24" version="1.1"><g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"><rect x="0" y="0" width="24" height="24"/><circle fill="`+ notificationThemes[theme] +`" opacity="0.3" cx="12" cy="12" r="10"/><rect fill="`+ notificationThemes[theme] +`" x="11" y="10" width="2" height="7" rx="1"/><rect fill="`+ notificationThemes[theme] +`" x="11" y="7" width="2" height="2" rx="1"/></g></svg>`,
        `<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="32px" height="32px" viewBox="0 0 24 24" version="1.1"><g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"><rect x="0" y="0" width="24" height="24"/><path d="M11.1669899,4.49941818 L2.82535718,19.5143571 C2.557144,19.9971408 2.7310878,20.6059441 3.21387153,20.8741573 C3.36242953,20.9566895 3.52957021,21 3.69951446,21 L21.2169432,21 C21.7692279,21 22.2169432,20.5522847 22.2169432,20 C22.2169432,19.8159952 22.1661743,19.6355579 22.070225,19.47855 L12.894429,4.4636111 C12.6064401,3.99235656 11.9909517,3.84379039 11.5196972,4.13177928 C11.3723594,4.22181902 11.2508468,4.34847583 11.1669899,4.49941818 Z" fill="`+ notificationThemes[theme] +`" opacity="0.3"/><rect fill="`+ notificationThemes[theme] +`" x="11" y="9" width="2" height="7" rx="1"/><rect fill="`+ notificationThemes[theme] +`" x="11" y="17" width="2" height="2" rx="1"/></g></svg>`,
        `<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="32px" height="32px" viewBox="0 0 24 24" version="1.1"><g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"><rect x="0" y="0" width="24" height="24"/><circle fill="`+ notificationThemes[theme] +`" opacity="0.3" cx="12" cy="12" r="10"/><rect fill="`+ notificationThemes[theme] +`" x="11" y="7" width="2" height="8" rx="1"/><rect fill="`+ notificationThemes[theme] +`" x="11" y="16" width="2" height="2" rx="1"/></g></svg>`
    ];
    $(document).ready(function () {
        for (let i = 0; i < notification.length; i++) {
            notificationIndicator[i].style.backgroundColor = notificationThemes[theme]; notification[i].style.color = notificationThemes[theme]; 
            notificationIcon[i].innerHTML = notificationIcons[icon]; notificationTitle[i].innerHTML = title; notificationText[i].innerHTML = desc;
        }
    });
    setTimeout(function () {
        for (let i = 0; i < notification.length; i++) {
            document.getElementsByClassName('notificationIntervalIndicator')[i].style.backgroundColor = 'transparent';
            notification[i].classList.replace("notificationIn", "notificationOut");
            setTimeout(function () { notification[i].remove(); },400);
        }
    }, 3200);
    return notificationTypes[type] + " " + notificationIcons[icon] + " " + notificationThemes[theme] + " " + title + " " + desc;
} const getNotifLocal = localStorage.getItem('NP');
if (!getNotifLocal) {}
else { const notifParams = JSON.parse(getNotifLocal); const now = new Date();
    if (now.getTime() > notifParams.expiry) { localStorage.removeItem('NP');}
    else {notificationSystem(Number(notifParams.notifType), Number(notifParams.notifIcon), Number(notifParams.notifTheme), notifParams.notifTitle, notifParams.notifDesc);setTimeout(function () { localStorage.removeItem('NP'); },5000);}
} // notificationSystem(0, 0, 0, 'Ertesites', 'Leiras');

var btn = document.querySelectorAll(".splash");
for (let i = 0; i < btn.length; i++) { btn[i].addEventListener("click", createRipple); }
function createRipple(e) { let btn = e.target; if (btn?.tagName == "svg") { btn = btn.parentNode; } if (btn?.tagName == "rect") { btn = btn.parentNode.parentNode; }
    let boundingBox = btn?.getBoundingClientRect(); let x = e.clientX - boundingBox?.left; let y = e.clientY - boundingBox?.top; let ripple = document.createElement("span"); ripple.classList.add("ripple");
    ripple.style.left = `${x}px`; ripple.style.top = `${y}px`; btn.appendChild(ripple); ripple.addEventListener("animationend", () => { ripple.remove() });
}