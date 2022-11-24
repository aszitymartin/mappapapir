var currentTab = 0; showTab(currentTab);
function showTab(n) { var x = document.getElementsByClassName("product-tab"); x[n].style.display = "flex";
    if (n == 0) { document.getElementById("prod-back").style.display = "none"; } else { document.getElementById("prod-back").style.display = "inline"; }
    if (n == (x.length - 1)) {document.getElementById("prod-next").innerHTML = "Kész"; } else {document.getElementById("prod-next").innerHTML = "Következő";} fixStepIndicator(n)
}
function productForm(n) { var x = document.getElementsByClassName("product-tab"); if (n == 1 && !validateForm()) return false; x[currentTab].style.display = "none"; currentTab = currentTab + n;
if (currentTab === 1) { var input = x[1].querySelectorAll('.checkable');
    $('#prod-next').click(function () {
        for (let i = 0; i < input.length; i++) {
            if (input[i].value === "") {console.log(input[i].parentNode.parentNode);input[i].parentNode.parentNode.getElementsByClassName('danger')[0].textContent = "Ezt a mezőt ki kell töltenie!";}
            else {input[i].parentNode.parentNode.getElementsByClassName('danger')[0].textContent = "";}
        }
    });
} 
if (currentTab === 2) { var input = x[2].querySelectorAll('.checkable');
    $('#prod-next').click(function () {
        for (let i = 0; i < input.length; i++) {
            if (input[i].value === "") {input[i].parentNode.parentNode.getElementsByClassName('danger')[0].textContent = "Ezt a mezőt ki kell töltenie!";}
            else {input[i].parentNode.parentNode.getElementsByClassName('danger')[0].textContent = "";}
        }
    });
} if (currentTab === 3) { var input = x[3].querySelectorAll('.checkable');
    $('#prod-next').click(function () {
        for (let i = 0; i < input.length; i++) {
            if (input[i].value === "") {input[i].parentNode.parentNode.getElementsByClassName('danger')[0].textContent = "Ezt a mezőt ki kell töltenie!";}
            else {input[i].parentNode.parentNode.getElementsByClassName('danger')[0].textContent = "";}
        }
    });
} if (currentTab === 4) { var input = x[4].querySelectorAll('.checkable');
$('#prod-next').click(function () {
    for (let i = 0; i < input.length; i++) {
        if (input[i].value === "") {input[i].parentNode.parentNode.getElementsByClassName('danger')[0].textContent = "Ezt a mezőt ki kell töltenie!";}
        else {input[i].parentNode.parentNode.getElementsByClassName('danger')[0].textContent = "";}
    }
});
}
if (currentTab >= x.length) { document.getElementById("prod-next").removeAttribute('nextPrev'); document.getElementById("prod-next").innerHTML = "Folyamatban";
    $.ajax({
        type: "POST", url: "/includes/staff/au.php", data:{id: 1 , password: document.getElementById('disc-confirm').value}, dataType: 'json',
        beforeSubmit: function () {document.getElementById("prod-next").removeAttribute('nextPrev'); document.getElementById("prod-next").innerHTML = "Folyamatban...";},
        success: function(data) {
            if (data) { var selectedItem = document.getElementsByName('discountable'); var selectedId, selectedCode; var getColor = document.getElementsByName('product-color'); var selectedColor;
                for (let i = 0; i < selectedItem.length; i++) { if (selectedItem[i].checked) { selectedId = selectedItem[i].value; selectedCode = selectedItem[i].getAttribute('code'); } }
                for (let i = 0; i < getColor.length; i++) {if (getColor[i].checked) {selectedColor = getColor[i].value;}}
                var form_data = new FormData();
                form_data.append("product-id", selectedId);
                form_data.append("product-code", $('#product-id').val());
                form_data.append("product-quantity", $('#product-quantity').val());
                form_data.append("quantity-unit", $('#quantity-unit').val());
                form_data.append("color", selectedColor);
                form_data.append("name", $('#product-name').val());
                form_data.append("info", $('#product-description').val());
                form_data.append("product-width", $('#product-width').val());
                form_data.append("width-unit", $('#width-unit').val());
                form_data.append("product-height", $('#product-height').val());
                form_data.append("height-unit", $('#height-unit').val());
                form_data.append("product-length", $('#product-length').val());
                form_data.append("length-unit", $('#length-unit').val());
                form_data.append("product-type", $('#product-type').val());
                form_data.append("image", $('#setImage').attr('image-id'));
                // form_data.append("new-image", $('#product-image-input').val());
                console.log(document.getElementById('product-image-input').files);
                if (document.getElementById('product-image-input').files.length > 0) {
                    form_data.append("product-image-input[]", document.getElementById('product-image-input').files[0]);
                } else {console.log('valami nemjo'); form_data.append("product-image-input[]", $('#setImage').attr('image-id'));}
                form_data.append("product-price", $('#product-price').val());
                form_data.append("price-unit", $('#price-unit').val());
                form_data.append("product-brand", $('#product-brand').val());
                
                $.ajax({ enctype: "multipart/form-data", type: "POST", url: "actions/products/edit.php", data: form_data, dataType: 'json', contentType: false, processData: false,
                    success: function(data) { console.log(data);
                        if (Number(data) === 0) { document.getElementById("prod-next").innerHTML = "Hiba"; notificationSystem(1, 2, 0, "Hiba", "Szerver oldali hiba történt."); closeAuth(); }
                        if (Number(data) === 30) { document.getElementById("prod-next").innerHTML = "Hiba"; closeAuth(); notificationSystem(1, 2, 0, 'Hiba', 'Ez a termék nem létezik.'); } 
                        if (Number(data) === 26) { document.getElementById("prod-next").innerHTML = "Hiba"; notificationSystem(1, 2, 0, "Hiba", "Insert hiba."); closeAuth(); }
                        if (Number(data) === 25) { document.getElementById("prod-next").innerHTML = "Hiba"; notificationSystem(1, 2, 0, "Hiba", "Prepare hiba."); closeAuth(); }
                        if (Number(data) === 1) { document.getElementById("prod-next").innerHTML = "Siker"; notificationSystem(1, 2, 0, "Siker", "Sikeresen szerkesztve!"); closeAuth(); }
                    }, error: function (data) {console.log(data);document.getElementById("prod-next").innerHTML = "Hiba"; notificationSystem(1, 2, 0, "Hiba", "Szerver oldali hiba történt."); closeAuth(); }
                });
            } else {document.getElementById("prod-next").innerHTML = "Hiba"; notificationSystem(1, 2, 0, "Hiba", "Érvénytelen jelszó."); closeAuth();}
        },
        error: function (data) {if (Number(data) === 0) {document.getElementById("prod-next").innerHTML = "Hiba"; notificationSystem(1, 2, 0, "Hiba", "Érvénytelen jelszó."); closeAuth(); }}
    }); return false;
} showTab(currentTab);
}
function validateForm() { var x, y, i, valid = true; x = document.getElementsByClassName("product-tab"); y = x[currentTab].getElementsByClassName("discount_input"); var inp = x[currentTab].querySelectorAll('.checkable');
    for (i = 0; i < y.length; i++) { if ($("input[type=radio]:checked").length < 1) {valid = false;}}
    if (currentTab === 1) {for (i = 0; i < inp.length; i++) {if (inp[0].value === "" || inp[1].value === "") {valid = false;}}}
    if (currentTab === 2) {for (i = 0; i < inp.length; i++) {if (inp[0].value === "" || inp[1].value === "") {valid = false;}}}
    if (currentTab === 3) {for (i = 0; i < inp.length; i++) {if (inp[0].value === "" || inp[1].value === "" || inp[2].value === "") {valid = false;}}}
    if (currentTab === 4) {for (i = 0; i < inp.length; i++) {if (inp[0].value === "" || inp[1].value === "" || inp[2].value === "") {valid = false;}}}
    if (valid) { document.getElementsByClassName("step")[currentTab].className += " finish";} return valid;
}
function fixStepIndicator(n) {var i, x = document.getElementsByClassName("step");for (i = 0; i < x.length; i++) { x[i].className = x[i].className.replace(" active", ""); } x[n].className += " active";}