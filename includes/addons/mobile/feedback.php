<?php session_start(); ?>
<div class="sidenav-theme feedback-container h-100">
    <div class="sidenav-header flex flec-row flex-align-c flex-justify-con-sb" style="margin-bottom: .5rem !important;">
        <span class="flex flex-col">
            <span class="header_title_heading">Visszajelzés küldése</span>
        </span>
        <span class="flex">
            <span class="text-primary pointer" onclick="closeSidenavAddons()">
                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"><rect x="0" y="0" width="24" height="24"/><circle class="svg" opacity="0.3" cx="12" cy="12" r="10"/><path d="M12.0355339,10.6213203 L14.863961,7.79289322 C15.2544853,7.40236893 15.8876503,7.40236893 16.2781746,7.79289322 C16.6686989,8.18341751 16.6686989,8.81658249 16.2781746,9.20710678 L13.4497475,12.0355339 L16.2781746,14.863961 C16.6686989,15.2544853 16.6686989,15.8876503 16.2781746,16.2781746 C15.8876503,16.6686989 15.2544853,16.6686989 14.863961,16.2781746 L12.0355339,13.4497475 L9.20710678,16.2781746 C8.81658249,16.6686989 8.18341751,16.6686989 7.79289322,16.2781746 C7.40236893,15.8876503 7.40236893,15.2544853 7.79289322,14.863961 L10.6213203,12.0355339 L7.79289322,9.20710678 C7.40236893,8.81658249 7.40236893,8.18341751 7.79289322,7.79289322 C8.18341751,7.40236893 8.81658249,7.40236893 9.20710678,7.79289322 L12.0355339,10.6213203 Z" class="svg" /></g>
                </svg>
            </span>
        </span>
    </div>
    <div class="theme-body">
        <div class="theme-desc text-align-c" style="margin-bottom: 1rem;">
            <span class="text-secondary text-small">Küldjön visszajelzést fejlesztőinknek, hogy kijavíthassák az Ön által talált hibákat.</span>
        </div>
        <div class="flex flex-col gap-1 h-100">
            <div class="feedback-form flex flex-col gap-1 w-100">
                <div class="feedback-form-item flex flex-col w-100">
                    <span class="text-primary bold">Rövid cím</span>
                    <span class="text-secondary small-med">Legyen konkrét, próbáljon rövid kulcsszavakat használni</span>
                    <input type="text" class="wizard_input feedback_input" name="feedback-title" id="feedback-title" placeholder='A "Hozzáadás a kedvencekhez" funkció nem működik a websop-ban' required />
                </div>
                <div class="feedback-form-item flex flex-row flex-justify-con-c flex-align-c gap-1 w-100">
                    <div class="flex flex-col gap-05 flex-justify-con-c flex-align-c">
                        <span class="relative">
                            <div class="select" style="margin-left: 0; width: 8rem;">
                                <select id="feedback-tags" required>
                                    <option value="other">&#9660;</option>
                                    <option value="webpage">Weboldal</option>
                                    <option value="webshop">Webshop</option>
                                    <option value="products">Termékek</option>
                                    <option value="orders">Rendelési</option>
                                    <option value="shipping">Szállítás</option>
                                    <option value="user">Felhasználó</option>
                                    <option value="other">Egyéb</option>
                                </select>
                            </div>
                        </span>
                        <span class="text-secondary small-med">Válasszon egy címkét</span>
                    </div>
                    <div class="flex flex-col gap-05 flex-justify-con-c flex-align-c">
                        <label class="flex flex-col flex-align-c background-bg pointer border-soft product-image-con box-shadow" for="feedback-image" style="padding: .7rem 3rem;">
                            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="2rem" height="2rem" viewBox="0 0 24 24" version="1.1">
                                <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"><polygon points="0 0 24 0 24 24 0 24"/><path d="M6,5 L18,5 C19.6568542,5 21,6.34314575 21,8 L21,17 C21,18.6568542 19.6568542,20 18,20 L6,20 C4.34314575,20 3,18.6568542 3,17 L3,8 C3,6.34314575 4.34314575,5 6,5 Z M5,17 L14,17 L9.5,11 L5,17 Z M16,14 C17.6568542,14 19,12.6568542 19,11 C19,9.34314575 17.6568542,8 16,8 C14.3431458,8 13,9.34314575 13,11 C13,12.6568542 14.3431458,14 16,14 Z" class="svg" /></g>
                            </svg>
                        </label>
                        <input type="file" class="hidden" name="feedback-image" id="feedback-image" accept="image/*" />
                        <span class="text-secondary small-med">Kép csatolása</span>
                    </div>
                </div>
                <div class="feedback-form-item flex flex-col w-100">
                    <span class="text-primary bold">Részletes leírás</span>
                    <span class="text-secondary small-med">Adjon meg minden információt, amelyet meg szeretne osztani a fejlesztővel</span>
                    <textarea class="wizard_input feedback_input textarea feedback_textarea" name="feedback-description" id="feedback-description" required></textarea>
                </div>
            </div>
            <div class="feedback-submit-container flex flex-col" style="align-items: flex-end;">
                <div class="flex button button-primary w-fc flex-justify-con-fe w-fc" id="submit-feedback">Visszajelzés küldése</div>
            </div>
        </div>
    </div>
</div>
<script>
    // Egyedi dropdown menu a funkciohoz
    var x, i, j, l, ll, selElmnt, a, b, c;x = document.getElementsByClassName("select");l = x.length;
    for (i = 0; i < l; i++) {
        selElmnt = x[i].getElementsByTagName("select")[0];ll = selElmnt.length;
        a = document.createElement("DIV");a.setAttribute("class", "select-selected");
        a.innerHTML = selElmnt.options[selElmnt.selectedIndex].innerHTML;
        x[i].appendChild(a);b = document.createElement("DIV");b.setAttribute("class", "select-items select-hide");
        for (j = 1; j < ll; j++) {
            c = document.createElement("DIV");c.innerHTML = selElmnt.options[j].innerHTML;
            c.addEventListener("click", function(e) {
                var y, i, k, s, h, sl, yl;s = this.parentNode.parentNode.getElementsByTagName("select")[0];
                sl = s.length;h = this.parentNode.previousSibling;
                for (i = 0; i < sl; i++) {
                    if (s.options[i].innerHTML == this.innerHTML) {
                        s.selectedIndex = i;h.innerHTML = this.innerHTML;
                        y = this.parentNode.getElementsByClassName("same-as-selected");yl = y.length;
                        for (k = 0; k < yl; k++) {y[k].removeAttribute("class");}
                        this.setAttribute("class", "same-as-selected"); break;
                    }
                }h.click();
            }); b.appendChild(c);
        } x[i].appendChild(b);
        a.addEventListener("click", function(e) {e.stopPropagation();closeAllSelect(this);this.nextSibling.classList.toggle("select-hide");this.classList.toggle("select-arrow-active");});
    }
    function closeAllSelect(elmnt) {
        var x, y, i, xl, yl, arrNo = [];x = document.getElementsByClassName("select-items");y = document.getElementsByClassName("select-selected");xl = x.length;yl = y.length;
        for (i = 0; i < yl; i++) {
            if (elmnt == y[i]) {arrNo.push(i)
            } else {y[i].classList.remove("select-arrow-active");}
        }
        for (i = 0; i < xl; i++) {if (arrNo.indexOf(i)) {x[i].classList.add("select-hide");}}
    }
    document.addEventListener("click", closeAllSelect);
    // Feedback elkuldese a feldolgozohoz
    $('#submit-feedback').click(function () {
        var image = $("#feedback-image");var image_data = image.prop('files')[0];var form_data = new FormData(); 
        form_data.append("id", <?php echo $_SESSION['id']; ?>);form_data.append("uid", 1);form_data.append("title", document.getElementById('feedback-title').value); 
        form_data.append("description", document.getElementById('feedback-description').value);form_data.append("image", image_data); form_data.append("tags", document.getElementById('feedback-tags').value);
        $.ajax({
            enctype: "multipart/form-data", type: "POST", url: "/includes/addons/mobile/send-feedback.php", data: form_data, dataType: 'json', contentType: false, processData: false,
            success: function(data) {
                if (Number(data) === 0) { document.getElementById("submit-feedback").innerHTML = "Hiba"; notificationSystem(1, 2, 0, "Hiba", "Szerver oldali hiba történt."); closeSidenavAddons(); }
                if (Number(data) === 30) { document.getElementById("submit-feedback").innerHTML = "Hiba"; closeSidenavAddons(); notificationSystem(1, 2, 0, 'Hiba', 'Ez a cikkszám már létezik.'); } 
                if (Number(data) === 26) { document.getElementById("submit-feedback").innerHTML = "Hiba"; notificationSystem(1, 2, 0, "Hiba", "Érvénytelen adatok."); closeSidenavAddons(); }
                if (Number(data) === 25) { document.getElementById("submit-feedback").innerHTML = "Hiba"; notificationSystem(1, 2, 0, "Hiba", "Érvénytelen adatok."); closeSidenavAddons(); }
                if (Number(data) === 1) { document.getElementById("submit-feedback").innerHTML = "Siker"; notificationSystem(1, 2, 0, "Siker", "Sikeresen feléve!"); closeSidenavAddons(); }
            }, error: function (response) { notificationSystem(1, 1, 0, "Hiba!", "Hibakód: " + response.status); closeSidenavAddons();}
        });
    });
</script>