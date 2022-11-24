var currentTab = 0; showTab(currentTab);
function showTab(n) {
var x = document.getElementsByClassName("product-tab"); x[n].style.display = "flex";
if (n == 0) { document.getElementById("prod-back").style.display = "none"; } else { document.getElementById("prod-back").style.display = "inline"; }
if (n == (x.length - 1)) {document.getElementById("prod-next").innerHTML = "Kész"; } else {document.getElementById("prod-next").innerHTML = "Következő";}
fixStepIndicator(n)
}

function productForm(n) {
var x = document.getElementsByClassName("product-tab"); if (n == 1 && !validateForm()) return false; x[currentTab].style.display = "none"; currentTab = currentTab + n;
if (currentTab >= x.length) {
    document.getElementById("prod-next").removeAttribute('nextPrev'); document.getElementById("prod-next").innerHTML = "Folyamatban";

    // Kivalasztott szin elmentese egy valtozoba, a tovabbi felhasznalas konnyedsege erdekeben
    var colorEl = document.getElementsByName('product-color'); var colorElVal;
    for (let i = 0; i < colorEl.length; i++) { if (colorEl[i].checked) { colorElVal = colorEl[i].value; } }

    // FormData letrehozasa, majd a <form> osszes mezojenek erteke eltarolasa, hogy tudjuk postolni az ertekeket a PHP fajlnak
    var form_data = new FormData(); var totalfiles = document.getElementById('product-image-input').files.length;
    for (var index = 0; index < totalfiles; index++) { form_data.append("product-image-input[]", document.getElementById('product-image-input').files[index]); }
    form_data.append("product-id", document.getElementById('product-id').value); form_data.append("product-quantity", document.getElementById('product-quantity').value);
    form_data.append("quantity-unit", document.getElementById('quantity-unit').value); form_data.append("product-color", colorElVal); form_data.append("product-name", document.getElementById('product-name').value);
    form_data.append("product-description", document.getElementById('product-description').value); form_data.append("product-width", document.getElementById('product-width').value);
    form_data.append("width-unit", document.getElementById('width-unit').value); form_data.append("product-height", document.getElementById('product-height').value);
    form_data.append("height-unit", document.getElementById('height-unit').value); form_data.append("product-length", document.getElementById('product-length').value);
    form_data.append("length-unit", document.getElementById('length-unit').value); form_data.append("product-price", document.getElementById('product-price').value);
    form_data.append("price-unit", document.getElementById('price-unit').value); form_data.append("product-brand", document.getElementById('product-brand').value);

    // FormData elkuldese AJAX hasznalataval
    $.ajax({
        enctype: "multipart/form-data", type: "POST", url: "actions/products/add.php", data: form_data, dataType: 'json', contentType: false, processData: false,
        // Sikeres/Sikertelen akciok kimenetelenek lekezelese ertesitesekkel, hogy emberbaratabb legyen az oldal.
        success: function(data) {
            if (Number(data) === 0) { document.getElementById("prod-next").innerHTML = "Hiba"; notificationSystem(1, 2, 0, "Hiba", "Szerver oldali hiba történt."); closeAuth(); }
            if (Number(data) === 30) { document.getElementById("prod-next").innerHTML = "Hiba"; closeAuth(); notificationSystem(1, 2, 0, 'Hiba', 'Ez a cikkszám már létezik.'); } 
            if (Number(data) === 26) { document.getElementById("prod-next").innerHTML = "Hiba"; notificationSystem(1, 2, 0, "Hiba", "Insert hiba."); closeAuth(); }
            if (Number(data) === 25) { document.getElementById("prod-next").innerHTML = "Hiba"; notificationSystem(1, 2, 0, "Hiba", "Prepare hiba."); closeAuth(); }
            if (Number(data) === 1) { document.getElementById("prod-next").innerHTML = "Siker"; notificationSystem(1, 2, 0, "Siker", "Sikeresen feléve!"); closeAuth(); }
        },
        error: function () { document.getElementById("prod-next").innerHTML = "Hiba"; notificationSystem(1, 2, 0, "Hiba", "Szerver oldali hiba történt."); closeAuth(); }
    }); return false;
}
showTab(currentTab);
}

function validateForm() {
var x, y, i, valid = true; x = document.getElementsByClassName("product-tab"); y = x[currentTab].getElementsByTagName("input");
for (i = 0; i < y.length; i++) { if (y[i].value == "") { y[i].className += " invalid"; valid = false;} }
if (valid) { document.getElementsByClassName("step")[currentTab].className += " finish"; }
return valid;
}

function fixStepIndicator(n) {
var i, x = document.getElementsByClassName("step");
for (i = 0; i < x.length; i++) { x[i].className = x[i].className.replace(" active", ""); }
x[n].className += " active";
}