function showinPanelCredit(tabName, tabData) {
    var con = document.getElementById('profile-items-con'); var pactives = con.querySelectorAll('span[intab-data]'); var tabpanels = document.getElementsByClassName('credtab');
    for (let i = 0; i < pactives.length; i++) { 
        if (pactives[i].getAttribute('intab-data') != tabData) { pactives[i].classList.remove('pr__item__active'); }
        else { pactives[i].classList.add('pr__item__active'); }
    } for (let i = 0; i < tabpanels.length; i++) {
        if (tabpanels[i].id === tabData) { $("#"+tabpanels[i].id).load('/admin/users/crediting/'+tabName.split("-")[1]+'.php'); $("#"+tabpanels[i].id).css('display', 'flex'); }
        else { tabpanels[i].style.display = "none"; tabpanels[i].innerHTML = ``; }
    } var queryParams = new URLSearchParams(window.location.search); queryParams.set("credtab", tabName.split("-")[1]);history.replaceState(null, null, "?"+queryParams.toString());
} var in__url__params = new URLSearchParams(window.location.search); var in__url__query__name = in__url__params.get("credtab"); var accept__param = ["crediting", "deduction", "history"];
if (in__url__query__name) { if (accept__param.includes(in__url__query__name)) { document.getElementById("intab-"+in__url__query__name).click(); } else { document.getElementById("intab-crediting").click();} } else { document.getElementById("intab-crediting").click(); }