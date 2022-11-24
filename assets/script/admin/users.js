function showPanel(tabName, tabData) {
    document.getElementById('load-wait')?.remove();
    var actives = document.querySelectorAll('div[tab-data]');
    for (let i = 0; i < actives.length; i++) { 
        if (actives[i].getAttribute('tab-data') != tabData) {
            actives[i].classList.remove('prfc__item__active');
        } else {
            actives[i].classList.add('prfc__item__active');
        }
    }
    var queryParams = new URLSearchParams(window.location.search); queryParams.set("tab", tabName.split("-")[1]);history.replaceState(null, null, "?"+queryParams.toString());
    var i, tabcontent, tablinks; 
    tabcontent = document.getElementsByClassName("tab__content"); 
    for (i = 0; i < tabcontent.length; i++) { tabcontent[i].innerHTML = ''; tabcontent[i].style.display = "none"; }
    $("#"+tabName).load('/admin/users/'+tabName.split("-")[1]+'.php');
    document.getElementById(tabName).style.display = "flex";
}
const url__params = new URLSearchParams(window.location.search); const url__query__name = url__params.get("tab"); var accept__param = ["overview", "cart", "bookmarks", "feedbacks", "crediting",  "privilege", "delete", "log"];
if (url__query__name) { if (accept__param.includes(url__query__name)) { document.getElementById("tabs-"+url__query__name).click(); } else { document.getElementById("tabs-overview").click();} } else { document.getElementById("tabs-overview").click(); }