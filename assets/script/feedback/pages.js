var tab__button = document.getElementsByClassName("prfc__item"); for (let i = 0; i < tab__button.length; i++) { tab__button[i].parentNode.addEventListener("click", function () { for (let j = 0; j < tab__button.length; j++) { tab__button[j].classList.remove("prfc__item__active"); }if (!tab__button[i].classList.contains("prfc__item__active")) { tab__button[i].classList.add("prfc__item__active"); }});}
var c__wrapper = document.createElement('div'); c__wrapper.classList = "wrapper_dark fadein"; var c__box = document.createElement('div'); c__box.classList = "d__confirm popup fixed flex flex-col border-soft item-bg box-shadow padding-1";var primCc = 1;
function showPanel(evt, tabName) {
    var queryParams = new URLSearchParams(window.location.search); queryParams.set("tab", tabName.split("-")[1]);history.replaceState(null, null, "?"+queryParams.toString());
    var i, tabcontent, tablinks; 
    tabcontent = document.getElementsByClassName("tab__content"); 
    for (i = 0; i < tabcontent.length; i++) { tabcontent[i].innerHTML = ''; tabcontent[i].style.display = "none"; }
    $("#"+tabName).load('/feedback/pages/'+tabName.split("-")[1]+'.php');
    document.getElementById(tabName).style.display = "flex";
}
const url__params = new URLSearchParams(window.location.search); const url__query__name = url__params.get("tab"); var accept__param = ["overview", "new", "archived"];
if (url__query__name) { if (accept__param.includes(url__query__name)) { document.getElementById("tabs-"+url__query__name).click(); } else { document.getElementById("tabs-overview").click();} } else { document.getElementById("tabs-overview").click(); }