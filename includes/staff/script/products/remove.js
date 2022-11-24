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
    $.ajax({
        type: "POST", url: "au.php", data:{id: 1 , password: document.getElementById('disc-confirm').value}, dataType: 'json',
        beforeSubmit: function () {document.getElementById("prod-next").removeAttribute('nextPrev'); document.getElementById("prod-next").innerHTML = "Folyamatban...";},
        success: function(data) {
            if (data) {
                var selectedItem = document.getElementsByName('discountable'); var selectedId;
                for (let i = 0; i < selectedItem.length; i++) { if (selectedItem[i].checked) { selectedId = selectedItem[i].value; } }
                var form_data = new FormData();form_data.append("id", Number(selectedId));
                $.ajax({
                    enctype: "multipart/form-data", type: "POST", url: "actions/products/remove.php", data: form_data, dataType: 'json', contentType: false, processData: false,
                    success: function(data) {
                        if (Number(data) === 0) { document.getElementById("prod-next").innerHTML = "Hiba"; notificationSystem(1, 2, 0, "Hiba", "Szerver oldali hiba történt."); closeAuth(); }
                        if (Number(data) === 30) { document.getElementById("prod-next").innerHTML = "Hiba"; closeAuth(); notificationSystem(1, 2, 0, 'Hiba', 'Ezt a termék nem létezik.'); } 
                        if (Number(data) === 26) { document.getElementById("prod-next").innerHTML = "Hiba"; notificationSystem(1, 2, 0, "Hiba", "Insert hiba."); closeAuth(); }
                        if (Number(data) === 25) { document.getElementById("prod-next").innerHTML = "Hiba"; notificationSystem(1, 2, 0, "Hiba", "Prepare hiba."); closeAuth(); }
                        if (Number(data) === 1) { document.getElementById("prod-next").innerHTML = "Siker"; notificationSystem(1, 2, 0, "Siker", "Sikeresen törölve!"); closeAuth(); }
                    },
                    error: function (data) {console.log(data);document.getElementById("prod-next").innerHTML = "Hiba"; notificationSystem(1, 2, 0, "Hiba", "Szerver oldali hiba történt."); closeAuth(); }
                });
            } else {document.getElementById("prod-next").innerHTML = "Hiba"; notificationSystem(1, 2, 0, "Hiba", "Érvénytelen jelszó."); closeAuth();}
        },
        error: function (data) {if (Number(data) === 0) {document.getElementById("prod-next").innerHTML = "Hiba"; notificationSystem(1, 2, 0, "Hiba", "Érvénytelen jelszó."); closeAuth(); }}
    });  return false;
} showTab(currentTab);
}

function validateForm() { var x, y, i, valid = true; x = document.getElementsByClassName("product-tab"); y = x[currentTab].getElementsByClassName("discount_input"); var inp = x[1].querySelectorAll('.checkable');
for (i = 0; i < y.length; i++) { if ($("input[type=radio]:checked").length < 1) {valid = false;}}
if (currentTab === 1) {for (i = 0; i < inp.length; i++) {if (inp[0].value === "") {valid = false;}}}
if (valid) { document.getElementsByClassName("step")[currentTab].className += " finish"; }return valid;
} function fixStepIndicator(n) {var i, x = document.getElementsByClassName("step");for (i = 0; i < x.length; i++) { x[i].className = x[i].className.replace(" active", ""); } x[n].className += " active";}