function showinPanel(tabName, tabData) {
    document.getElementById('load-wait')?.remove();
    var con = document.getElementById('profile-items-con'); var pactives = con.querySelectorAll('span[intab-data]'); var tabpanels = document.getElementsByClassName('tabpanels');
    for (let i = 0; i < pactives.length; i++) { 
        if (pactives[i].getAttribute('intab-data') != tabData) { pactives[i].classList.remove('pr__item__active'); }
        else { pactives[i].classList.add('pr__item__active'); }
    } for (let i = 0; i < tabpanels.length; i++) {
        if (tabpanels[i].id === tabData) {
            document.getElementById(tabpanels[i].id).innerHTML = `
            <div class="flex flex-col flex-align-c flex-justify-con-c w-fa gap-1 user-select-none text-muted small">
                <svg class='wizard_input_loading' xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="8rem" height="8rem" viewBox="0 0 24 24" version="1.1"><g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"><g><polygon points="0 0 24 0 24 24 0 24"/></g><path d="M12,4 L12,6 C8.6862915,6 6,8.6862915 6,12 C6,15.3137085 8.6862915,18 12,18 C15.3137085,18 18,15.3137085 18,12 C18,10.9603196 17.7360885,9.96126435 17.2402578,9.07513926 L18.9856052,8.09853149 C19.6473536,9.28117708 20,10.6161442 20,12 C20,16.418278 16.418278,20 12,20 C7.581722,20 4,16.418278 4,12 C4,7.581722 7.581722,4 12,4 Z" fill="currentColor" fill-rule="nonzero" opacity="0.4" transform="translate(12.000000, 12.000000) scale(-1, 1) translate(-12.000000, -12.000000) "/></g></svg>
                <span>Betöltés folyamatban</span>
            </div>`; $("#"+tabpanels[i].id).load('/admin/users/profile/'+tabName.split("-")[1]+'.php'); $("#"+tabpanels[i].id).css('display', 'flex');
        }
        else { tabpanels[i].style.display = "none"; tabpanels[i].innerHTML = ``; }
    } var queryParams = new URLSearchParams(window.location.search); queryParams.set("intabs", tabName.split("-")[1]);history.replaceState(null, null, "?"+queryParams.toString());
} var in__url__params = new URLSearchParams(window.location.search); var in__url__query__name = in__url__params.get("intabs"); var accept__param = ["overview", "personal", "profile", "security", "password", "email", "cards", "invoice"];
if (in__url__query__name) { if (accept__param.includes(in__url__query__name)) { document.getElementById("intab-"+in__url__query__name).click(); } else { document.getElementById("intab-overview").click();} } else { document.getElementById("intab-overview").click(); }