var currentTab = 0; showTab(currentTab);
function showTab(n) { var x = document.getElementsByClassName("product-tab"); x[n].style.display = "flex";
    if (n == 0) { document.getElementById("prod-back").style.display = "none"; } else { document.getElementById("prod-back").style.display = "inline"; }
    if (n == (x.length - 1)) {document.getElementById("prod-next").innerHTML = "Kész"; } else {document.getElementById("prod-next").innerHTML = "Következő";} fixStepIndicator(n)
}
function productForm(n) { var x = document.getElementsByClassName("product-tab"); if (n == 1 && !validateForm()) return false; x[currentTab].style.display = "none"; currentTab = currentTab + n;
if (currentTab === 1) { var input = x[1].querySelectorAll('.checkable');
    $('#prod-next').click(function () {
        for (let i = 0; i < input.length; i++) {
            if (input[i].value === "") {input[i].parentNode.parentNode.getElementsByClassName('danger')[0].textContent = "Ezt a mezőt ki kell töltenie!";}
            else {input[i].parentNode.parentNode.getElementsByClassName('danger')[0].textContent = "";}
        }
    });
}
if (currentTab >= x.length) { document.getElementById("prod-next").removeAttribute('nextPrev'); document.getElementById("prod-next").innerHTML = "Folyamatban";
    // Kivalasztott termek elmentese egy valtozoba, a tovabbi felhasznalas konnyedsege erdekeben
    var selectedItem = document.getElementsByName('discountable'); var selectedId, selectedCode;
    for (let i = 0; i < selectedItem.length; i++) { if (selectedItem[i].checked) { selectedId = selectedItem[i].value; selectedCode = selectedItem[i].getAttribute('code'); } }
    // FormData letrehozasa, majd a <form> osszes mezojenek erteke eltarolasa, hogy tudjuk postolni az ertekeket a PHP fajlnak
    var form_data = new FormData();form_data.append("id", selectedId); form_data.append("code", selectedCode); form_data.append("discount", document.getElementById('discount-percentage').value); 
    form_data.append("start", document.getElementById('discount-start').value); form_data.append("end", document.getElementById('discount-end').value);
    $.ajax({ // FormData elkuldese AJAX hasznalataval
        enctype: "multipart/form-data", type: "POST", url: "actions/discount/add.php", data: form_data, dataType: 'json', contentType: false, processData: false,
        success: function(data) {// Sikeres/Sikertelen akciok kimenetelenek lekezelese ertesitesekkel, hogy emberbaratabb legyen az oldal.
            if (Number(data) === 0) { document.getElementById("prod-next").innerHTML = "Hiba"; notificationSystem(1, 2, 0, "Hiba", "Szerver oldali hiba történt."); closeAuth(); }
            if (Number(data) === 30) { document.getElementById("prod-next").innerHTML = "Hiba"; closeAuth(); notificationSystem(1, 2, 0, 'Hiba', 'Ezt a terméket már leértékelték.'); } 
            if (Number(data) === 26) { document.getElementById("prod-next").innerHTML = "Hiba"; notificationSystem(1, 2, 0, "Hiba", "Insert hiba."); closeAuth(); }
            if (Number(data) === 25) { document.getElementById("prod-next").innerHTML = "Hiba"; notificationSystem(1, 2, 0, "Hiba", "Prepare hiba."); closeAuth(); }
            if (Number(data) === 1) { document.getElementById("prod-next").innerHTML = "Siker"; notificationSystem(1, 2, 0, "Siker", "Sikeresen feléve!"); closeAuth(); }
        },
        error: function (data) {console.log(data);document.getElementById("prod-next").innerHTML = "Hiba"; notificationSystem(1, 2, 0, "Hiba", "Szerver oldali hiba történt."); closeAuth(); }
    }); return false;
} showTab(currentTab);
}
function validateForm() { var x, y, i, valid = true; x = document.getElementsByClassName("product-tab"); y = x[currentTab].getElementsByClassName("discount_input"); var inp = x[1].querySelectorAll('.checkable');
    for (i = 0; i < y.length; i++) { if ($("input[type=radio]:checked").length < 1) {valid = false;}}
    if (currentTab === 1) {for (i = 0; i < inp.length; i++) {if (inp[0].value === "" || inp[1].value === "" || inp[2].value === "") {valid = false;}}}
    if (valid) { document.getElementsByClassName("step")[currentTab].className += " finish";} return valid;
}
function fixStepIndicator(n) {var i, x = document.getElementsByClassName("step");for (i = 0; i < x.length; i++) { x[i].className = x[i].className.replace(" active", ""); } x[n].className += " active";}