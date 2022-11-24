var tab__button = document.getElementsByClassName("pr__item"); for (let i = 0; i < tab__button.length; i++) { tab__button[i].addEventListener("click", function () { for (let j = 0; j < tab__button.length; j++) { tab__button[j].classList.remove("pr__item__active"); }if (!tab__button[i].classList.contains("pr__item__active")) { tab__button[i].classList.add("pr__item__active"); }});}
var c__wrapper = document.createElement('div'); c__wrapper.classList = "wrapper_dark fadein"; var c__box = document.createElement('div'); c__box.classList = "d__confirm popup fixed flex flex-col border-soft item-bg box-shadow padding-1";let primCc = 1;
function showPanel(evt, tabName) {
    var queryParams = new URLSearchParams(window.location.search); queryParams.set("tab", tabName.split("-")[1]);history.replaceState(null, null, "?"+queryParams.toString());
    var i, tabcontent, tablinks; 
    tabcontent = document.getElementsByClassName("tab__content"); 
    for (i = 0; i < tabcontent.length; i++) { tabcontent[i].innerHTML = ''; tabcontent[i].style.display = "none"; }
    $("#"+tabName).load('/admin/products/edit/'+tabName.split("-")[1]+'.php');
    document.getElementById(tabName).style.display = "flex";
}
const url__params = new URLSearchParams(window.location.search); const url__query__name = url__params.get("tab"); var accept__param = ["general", "advanced", "reviews"];
if (url__query__name) { if (accept__param.includes(url__query__name)) { document.getElementById("tabs-"+url__query__name).click(); } else { document.getElementById("tabs-general").click();} } else { document.getElementById("tabs-general").click(); }