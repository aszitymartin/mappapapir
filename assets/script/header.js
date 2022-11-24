var isMobile;
if( /Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent) ) {isMobile = true;if (document.getElementById('header_desktop_button')) {document.getElementById('header_desktop_button').setAttribute("onclick", "openHeaderProfileActionLogged()");}} 
else {isMobile = false;if (document.getElementById('header_desktop_button')) {document.getElementById('header_desktop_button').setAttribute("onclick", "openHeaderProfileActionLogged()");}}
if (document.getElementById('header_desktop_button_profile')) {document.getElementById('header_desktop_button_profile').setAttribute('onclick', 'openHeaderProfileActionLogged()');}
var wrapper = document.createElement('div');var wizard_form_script = document.createElement('script');wizard_form_script.setAttribute('src', '/assets/script/wizard.js');
wrapper.classList = 'wrapper_dark';wrapper.id = 'wrapper';wrapper.setAttribute('onclick', 'closeHeaderProfileAction()');
var header_title =  document.getElementById('header_title');var header_search = document.getElementById('header_search');
var header_middle = document.getElementById('header_middle');var header_middle_backup = document.createElement('div');
header_middle_backup.id = 'header_middle';header_middle_backup.classList.add('flex');header_middle_backup.classList.add('flex-col');
header_middle_backup.innerHTML = `
    <div class='header_search_location_con'>
        <div class='header_location_ind' onclick="window.location.href='';">
            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="18px" height="18px" viewBox="0 0 24 24" version="1.1">
                <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"><rect x="0" y="0" width="18" height="18"/><path d="M5,10.5 C5,6 8,3 12.5,3 C17,3 20,6.75 20,10.5 C20,12.8325623 17.8236613,16.03566 13.470984,20.1092932 C12.9154018,20.6292577 12.0585054,20.6508331 11.4774555,20.1594925 C7.15915182,16.5078313 5,13.2880005 5,10.5 Z M12.5,12 C13.8807119,12 15,10.8807119 15,9.5 C15,8.11928813 13.8807119,7 12.5,7 C11.1192881,7 10,8.11928813 10,9.5 C10,10.8807119 11.1192881,12 12.5,12 Z" class="svg" fill-rule="nonzero"/></g>
            </svg>
            <span>6400 Kiskunhalas, Kossuth utca 13-15.</span>
        </div>
    </div>
    <div class='row'>
        <div id='header_search' class='header_search width-100'>
            <div class='header_search_input'>
                <input type='text' class='header_input header_input_mobile flex width-80 outline-none border-none' id='main_search' name='main_search' placeholder='Keresés termékeink között..'>
            </div>
        </div>
        <div id='header_desktop_button_profile' class='header_heading_button user_action_button pointer flex flex-align-c flex-justify-con-c' onclick="openHeaderProfileAction('`+ isMobile +`');">
            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"><polygon points="0 0 24 0 24 24 0 24"/><path d="M12,11 C9.790861,11 8,9.209139 8,7 C8,4.790861 9.790861,3 12,3 C14.209139,3 16,4.790861 16,7 C16,9.209139 14.209139,11 12,11 Z" class="svg" fill-rule="nonzero" opacity="0.3"/><path d="M3.00065168,20.1992055 C3.38825852,15.4265159 7.26191235,13 11.9833413,13 C16.7712164,13 20.7048837,15.2931929 20.9979143,20.2 C21.0095879,20.3954741 20.9979143,21 20.2466999,21 C16.541124,21 11.0347247,21 3.72750223,21 C3.47671215,21 2.97953825,20.45918 3.00065168,20.1992055 Z" class="svg" fill-rule="nonzero"/></g>
            </svg>
        </div>
    </div>
`;
const sideNav = document.createElement('div');sideNav.id = 'sidenav';sideNav.classList = "sidenav";
if (window.innerWidth > 992) {sideNav.remove();} 
else {
    header_middle.remove();
    if (document.getElementById('header_desktop_button')) {document.getElementById('header_desktop_button').remove();}
    if (document.getElementById('header_desktop_button_profile')) {document.getElementById('header_desktop_button_profile').remove();}
    document.getElementById('header_con').append(header_middle_backup); document.body.prepend(sideNav);
    if (document.getElementById('header_desktop_button')) {document.getElementById('header_desktop_button').removeAttribute('onclick');document.getElementById('header_desktop_button').setAttribute('onclick', 'openSidenav()');document.getElementById('header_desktop_button').innerHTML = `<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1"><g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"><rect x="0" y="0" width="24" height="24"/><rect class="svg" x="0" y="5" width="24" height="3" rx="1.5"/><rect class="svg" x="0" y="12" width="24" height="3" rx="1.5"/><rect class="svg" x="0" y="19" width="24" height="3" rx="1.5"/></g></svg>`;}
    if (document.getElementById('header_desktop_button_profile')) {
        document.getElementById('header_desktop_button_profile').removeAttribute('onclick');document.getElementById('header_desktop_button_profile').setAttribute('onclick', 'openSidenav()');
        document.getElementById('header_desktop_button_profile').innerHTML = `<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1"><g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"><rect x="0" y="0" width="24" height="24"/><rect class="svg" x="0" y="5" width="24" height="3" rx="1.5"/><rect class="svg" x="0" y="12" width="24" height="3" rx="1.5"/><rect class="svg" x="0" y="19" width="24" height="3" rx="1.5"/></g></svg>`;
    }
}