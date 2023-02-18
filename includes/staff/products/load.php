<?php require_once($_SERVER['DOCUMENT_ROOT'].'/assets/alph.php'); ?>
<script>
document.getElementById('section-header').innerHTML = `<div class="flex flex-row flex-align-c gap-1"><span class="flex pointer" onclick="productHome()" aria-label="Vissza"><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1"><g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"><rect x="0" y="0" width="24" height="24"></rect><circle class="svg" opacity="0.3" cx="12" cy="12" r="10"></circle><path d="M6.96323356,15.1775211 C6.62849853,15.5122561 6.08578582,15.5122561 5.75105079,15.1775211 C5.41631576,14.842786 5.41631576,14.3000733 5.75105079,13.9653383 L10.8939067,8.82248234 C11.2184029,8.49798619 11.7409054,8.4866328 12.0791905,8.79672747 L17.2220465,13.5110121 C17.5710056,13.8308912 17.5945795,14.3730917 17.2747004,14.7220508 C16.9548212,15.0710098 16.4126207,15.0945838 16.0636617,14.7747046 L11.5257773,10.6149773 L6.96323356,15.1775211 Z" class="svg" fill-rule="nonzero" transform="translate(11.500001, 12.000001) scale(-1, 1) rotate(-270.000000) translate(-11.500001, -12.000001) "></path></g></svg></span><span class="flex header_title_heading">Termékek</span></div>`;
$('#product-body').css('height', '100%');
document.getElementById('product-body').innerHTML = `
    <div class="flex flex-col gap-1">
        <div class="theme-button-con flex flex-col" id="product-add" aria-label="Termék hozzáadása">
            <div class="product-button flex flex-row padding-1 item-bg-light border-soft ease user-select-none pointer">
                <div class="flex flex-row flex-align-c flex-justify-con-sb">
                    <div class="flex" style="margin-right: 1rem;">
                        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="3rem" height="3rem" viewBox="0 0 24 24" version="1.1">
                            <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"><rect x="0" y="0" width="24" height="24"></rect><path d="M8,3 L8,3.5 C8,4.32842712 8.67157288,5 9.5,5 L14.5,5 C15.3284271,5 16,4.32842712 16,3.5 L16,3 L18,3 C19.1045695,3 20,3.8954305 20,5 L20,21 C20,22.1045695 19.1045695,23 18,23 L6,23 C4.8954305,23 4,22.1045695 4,21 L4,5 C4,3.8954305 4.8954305,3 6,3 L8,3 Z" class="svg" opacity="0.3"></path><path d="M11,2 C11,1.44771525 11.4477153,1 12,1 C12.5522847,1 13,1.44771525 13,2 L14.5,2 C14.7761424,2 15,2.22385763 15,2.5 L15,3.5 C15,3.77614237 14.7761424,4 14.5,4 L9.5,4 C9.22385763,4 9,3.77614237 9,3.5 L9,2.5 C9,2.22385763 9.22385763,2 9.5,2 L11,2 Z" class="svg"></path><rect class="svg" opacity="0.3" x="7" y="10" width="5" height="2" rx="1"></rect><rect class="svg" opacity="0.3" x="7" y="14" width="9" height="2" rx="1"></rect></g>
                        </svg>
                    </div>
                    <div class="flex flex-col">
                        <span class="text-primary bold">Termék hozzáadása</span>
                        <span class="text-secondary small">Hozzon létre termékeket az oldalon</span>
                    </div>
                </div>
            </div>
        </div>
        <div class="theme-button-con flex flex-col" id="product-remove" aria-label="Termék eltávolítása">
            <div class="product-button flex flex-row padding-1 item-bg-light border-soft ease user-select-none pointer">
                <div class="flex flex-row flex-align-c flex-justify-con-sb">
                    <div class="flex" style="margin-right: 1rem;">
                        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="3rem" height="3rem" viewBox="0 0 24 24" version="1.1">
                            <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"><rect x="0" y="0" width="24" height="24"></rect><path d="M8,3 L8,3.5 C8,4.32842712 8.67157288,5 9.5,5 L14.5,5 C15.3284271,5 16,4.32842712 16,3.5 L16,3 L18,3 C19.1045695,3 20,3.8954305 20,5 L20,21 C20,22.1045695 19.1045695,23 18,23 L6,23 C4.8954305,23 4,22.1045695 4,21 L4,5 C4,3.8954305 4.8954305,3 6,3 L8,3 Z" class="svg" opacity="0.3"></path><path d="M11,2 C11,1.44771525 11.4477153,1 12,1 C12.5522847,1 13,1.44771525 13,2 L14.5,2 C14.7761424,2 15,2.22385763 15,2.5 L15,3.5 C15,3.77614237 14.7761424,4 14.5,4 L9.5,4 C9.22385763,4 9,3.77614237 9,3.5 L9,2.5 C9,2.22385763 9.22385763,2 9.5,2 L11,2 Z" class="svg"></path><rect class="svg" opacity="0.3" x="7" y="10" width="5" height="2" rx="1"></rect><rect class="svg" opacity="0.3" x="7" y="14" width="9" height="2" rx="1"></rect></g>
                        </svg>
                    </div>
                    <div class="flex flex-col">
                        <span class="text-primary bold">Termék eltávolítása</span>
                        <span class="text-secondary small">Távolítsa el a nem kívánt termékeket az oldalról</span>
                    </div>
                </div>
            </div>
        </div>
        <div class="theme-button-con flex flex-col" id="product-manage" aria-label="Termék kezelése">
            <div class="product-button flex flex-row padding-1 item-bg-light border-soft ease user-select-none pointer">
                <div class="flex flex-row flex-align-c flex-justify-con-sb">
                    <div class="flex" style="margin-right: 1rem;">
                        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="3rem" height="3rem" viewBox="0 0 24 24" version="1.1">
                            <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"><rect x="0" y="0" width="24" height="24"></rect><path d="M8,3 L8,3.5 C8,4.32842712 8.67157288,5 9.5,5 L14.5,5 C15.3284271,5 16,4.32842712 16,3.5 L16,3 L18,3 C19.1045695,3 20,3.8954305 20,5 L20,21 C20,22.1045695 19.1045695,23 18,23 L6,23 C4.8954305,23 4,22.1045695 4,21 L4,5 C4,3.8954305 4.8954305,3 6,3 L8,3 Z" class="svg" opacity="0.3"></path><path d="M11,2 C11,1.44771525 11.4477153,1 12,1 C12.5522847,1 13,1.44771525 13,2 L14.5,2 C14.7761424,2 15,2.22385763 15,2.5 L15,3.5 C15,3.77614237 14.7761424,4 14.5,4 L9.5,4 C9.22385763,4 9,3.77614237 9,3.5 L9,2.5 C9,2.22385763 9.22385763,2 9.5,2 L11,2 Z" class="svg"></path><rect class="svg" opacity="0.3" x="7" y="10" width="5" height="2" rx="1"></rect><rect class="svg" opacity="0.3" x="7" y="14" width="9" height="2" rx="1"></rect></g>
                        </svg>
                    </div>
                    <div class="flex flex-col">
                        <span class="text-primary bold">Termék kezelése</span>
                        <span class="text-secondary small">Termékek és adatainak kezelése</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
`;
$('#product-add').click(() => {
    document.getElementById('section-header').innerHTML = `<div class="flex flex-row flex-align-c gap-1"><span class="flex pointer" onclick="productMain()"><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1"><g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"><rect x="0" y="0" width="24" height="24"></rect><circle class="svg" opacity="0.3" cx="12" cy="12" r="10"></circle><path d="M6.96323356,15.1775211 C6.62849853,15.5122561 6.08578582,15.5122561 5.75105079,15.1775211 C5.41631576,14.842786 5.41631576,14.3000733 5.75105079,13.9653383 L10.8939067,8.82248234 C11.2184029,8.49798619 11.7409054,8.4866328 12.0791905,8.79672747 L17.2220465,13.5110121 C17.5710056,13.8308912 17.5945795,14.3730917 17.2747004,14.7220508 C16.9548212,15.0710098 16.4126207,15.0945838 16.0636617,14.7747046 L11.5257773,10.6149773 L6.96323356,15.1775211 Z" class="svg" fill-rule="nonzero" transform="translate(11.500001, 12.000001) scale(-1, 1) rotate(-270.000000) translate(-11.500001, -12.000001) "></path></g></svg></span><span class="flex header_title_heading">Termékek</span></div>`;
    $('#product-body').css('height', '100%');
    document.getElementById('product-body').innerHTML = `
        <form id="productForm" enctype="multipart/form-data" method="POST" action="add-product.php">
            <div class="product-tab flex flex-col gap-1">
                <div class="flex flex-col w-100">
                    <span class="text-secondary" style="margin-bottom: .5rem;">Termék cikkszáma</span>
                    <input type="text" name="product-id" class="staff-auth" id="product-id" placeholder="XXXXXX">
                </div>
                <div class="flex flex-col w-100">
                    <span class="text-secondary" style="margin-bottom: .5rem;">Termék mennyisége</span>
                    <span class="flex flex-row flex-justify-con-sb flex-align-c">
                        <span>
                            <input type="number" name="product-quantity" class="staff-auth" id="product-quantity" placeholder="15">
                        </span>
                        <span class="relative">
                            <div class="select">
                                <select required id="quantity-unit">
                                    <option value="db">&#9660;</option>
                                    <option value="db">db</option>
                                    <option value="tomb">tömb</option>
                                    <option value="csom">csom</option>
                                    <option value="dob">dob</option>
                                </select>
                            </div>
                        </span>
                    </span>
                </div>
                <div class="flex flex-col w-100">
                    <span class="text-secondary" style="margin-bottom: .5rem;">Termék színe</span>
                    <span class="flex flex-row flex-justify-con-sb flex-align-c">
                        <span class="flex flex-row flex-wrap gap-05">
                            <span class="product-color-radio flex flex-align-c flex-justify-con-c border-soft">
                                <input class="product-color" type="radio" id="color-black" name="product-color" value="fekete" />
                                <label class="product-color-label user-select-none" for="color-black">Fekete</label>
                            </span>
                            <span class="product-color-radio flex flex-align-c flex-justify-con-c border-soft">
                                <input class="product-color" type="radio" id="color-white" name="product-color" value="fehér" />
                                <label class="product-color-label user-select-none" for="color-white">Fehér</label>
                            </span>
                            <span class="product-color-radio flex flex-align-c flex-justify-con-c border-soft">
                                <input class="product-color" type="radio" id="color-red" name="product-color" value="piros" />
                                <label class="product-color-label user-select-none" for="color-red">Piros</label>
                            </span>
                            <span class="product-color-radio flex flex-align-c flex-justify-con-c border-soft">
                                <input class="product-color" type="radio" id="color-blue" name="product-color" value="kék" />
                                <label class="product-color-label user-select-none" for="color-blue">Kék</label>
                            </span>
                            <span class="product-color-radio flex flex-align-c flex-justify-con-c border-soft">
                                <input class="product-color" type="radio" id="color-green" name="product-color" value="zöld" />
                                <label class="product-color-label user-select-none" for="color-green">Zöld</label>
                            </span>
                            <span class="product-color-radio flex flex-align-c flex-justify-con-c border-soft">
                                <input class="product-color" type="radio" id="color-yellow" name="product-color" value="sárga" />
                                <label class="product-color-label user-select-none" for="color-yellow">Sárga</label>
                            </span>
                            <span class="product-color-radio flex flex-align-c flex-justify-con-c border-soft">
                                <input class="product-color" type="radio" id="color-orange" name="product-color" value="narancssárga" />
                                <label class="product-color-label user-select-none" for="color-orange">Narancssárga</label>
                            </span>
                            <span class="product-color-radio flex flex-align-c flex-justify-con-c border-soft">
                                <input class="product-color" type="radio" id="color-brown" name="product-color" value="barna" />
                                <label class="product-color-label user-select-none" for="color-brown">Barna</label>
                            </span>
                            <span class="product-color-radio flex flex-align-c flex-justify-con-c border-soft">
                                <input class="product-color" type="radio" id="color-purple" name="product-color" value="lila" />
                                <label class="product-color-label user-select-none" for="color-purple">Lila</label>
                            </span>
                            <span class="product-color-radio flex flex-align-c flex-justify-con-c border-soft">
                                <input class="product-color" type="radio" id="color-pink" name="product-color" value="rózsaszín" />
                                <label class="product-color-label user-select-none" for="color-pink">Rózsaszín</label>
                            </span>
                            <span class="product-color-radio flex flex-align-c flex-justify-con-c border-soft">
                                <input class="product-color" type="radio" id="color-silver" name="product-color" value="ezüst" />
                                <label class="product-color-label user-select-none" for="color-silver">Ezüst</label>
                            </span>
                            <span class="product-color-radio flex flex-align-c flex-justify-con-c border-soft">
                                <input class="product-color" type="radio" id="color-colorful" name="product-color" value="színes" />
                                <label class="product-color-label user-select-none" for="color-colorful">Színes</label>
                            </span>
                        </span>
                    </span>
                </div>
            </div>
            <div class="product-tab">
                <div class="flex flex-col gap-1 w-100">
                    <div class="flex flex-col w-100">
                        <span class="text-secondary" style="margin-bottom: .5rem;">Adja meg a termék nevét</span>
                        <input type="text" name="product-name" class="staff-auth" id="product-name" placeholder="Termék neve">
                    </div>
                    <div class="flex flex-col w-100">
                        <span class="text-secondary" style="margin-bottom: .5rem;">Adja meg a termék leírását</span>
                        <textarea class="textarea resize-none padding-1 border-soft" name="product-description" id="product-description"></textarea>
                    </div>
                </div>
            </div>
            <div class="product-tab">
                <div class="flex flex-col w-100">
                    <span class="text-secondary" style="margin-bottom: .5rem;">Termék szélessége</span>
                    <span class="flex flex-row flex-justify-con-sb flex-align-c">
                        <span>
                            <input type="number" name="product-width" class="staff-auth" id="product-width" placeholder="20">
                        </span>
                        <span class="relative">
                            <div class="select">
                                <select id="width-unit">
                                    <option value="mm">&#9660;</option>
                                    <option value="mm">mm</option>
                                    <option value="cm">cm</option>
                                </select>
                            </div>
                        </span>
                    </span>
                    <span class="text-secondary" style="margin: 1rem 0 .5rem 0;">Termék magasság</span>
                    <span class="flex flex-row flex-justify-con-sb flex-align-c">
                        <span>
                            <input type="number" name="product-height" class="staff-auth" id="product-height" placeholder="20">
                        </span>
                        <span class="relative">
                            <div class="select">
                                <select id="height-unit">
                                    <option value="mm">&#9660;</option>
                                    <option value="mm">mm</option>
                                    <option value="cm">cm</option>
                                </select>
                            </div>
                        </span>
                    </span>
                    <span class="text-secondary" style="margin: 1rem 0 .5rem 0;">Termék hossza</span>
                    <span class="flex flex-row flex-justify-con-sb flex-align-c">
                        <span>
                            <input type="number" name="product-length" class="staff-auth" id="product-length" placeholder="20">
                        </span>
                        <span class="relative">
                            <div class="select">
                                <select id="length-unit">
                                    <option value="mm">&#9660;</option>
                                    <option value="mm">mm</option>
                                    <option value="cm">cm</option>
                                </select>
                            </div>
                        </span>
                    </span>
                </div>
            </div>
            <div class="product-tab">
                <div class="flex flex-col w-100">
                    <div id="product-image-con" class="flex flex-row flex-justify-con-c gap-1">
                        <span class="flex flex-row flex-align-st flex-justify-con-c gap-05 flex-wrap" id="preview-item-con">
                            <div class="flex flex-col flex-align-c flex-justify-con-c gap-05">
                                <label class="flex flex-col flex-align-c background-bg pointer border-softer padding-1 product-image-button" for="product-image-input" style="box-shadow: var(--button-shadow) 0px 1px 4px;">
                                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="3rem" height="3rem" viewBox="0 0 24 24" version="1.1">
                                        <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"><rect class="svg" x="4" y="11" width="16" height="2" rx="1"/><rect class="svg" opacity="0.3" transform="translate(12.000000, 12.000000) rotate(-270.000000) translate(-12.000000, -12.000000) " x="4" y="11" width="16" height="2" rx="1"/></g>
                                    </svg>
                                </label>
                                <small class="text-secondary user-select-none"><em>Kép hozzáadása</em></small>
                            </div>
                            <input type="file" accept="image/*" id="product-image-input" name="product-image-input[]" required>
                        </span>
                    </div>
                    <span class="text-secondary" style="margin-top: 1rem;">Termék ára</span>
                    <span class="flex flex-row flex-justify-con-sb flex-align-c">
                        <input type="number" name="product-price" class="staff-auth" id="product-price" placeholder="XXXX">
                        <span class="relative">
                            <div class="select">
                                <select id="price-unit" required>
                                    <option value="huf">&#9660;</option>
                                    <option value="huf">HUF</option>
                                    <option value="eur">EUR</option>
                                    <option value="usd">USD</option>
                                </select>
                            </div>
                        </span>
                    </span>
                    <div class="flex flex-col w-100" style="margin-top: 1rem;">
                        <span class="text-secondary" style="margin-bottom: .5rem;">Adja meg a termék márkáját</span>
                        <input type="text" name="product-brand" class="staff-auth" id="product-brand" placeholder="Termék márkája">
                    </div>
                </div>
            </div>
        </form>
        <div class="flex flex-col margin-top-a">
            <div class="flex flex-row gap-1 flex-align-c flex-justify-con-c">
                <span class="step"></span>
                <span class="step"></span>
                <span class="step"></span>
                <span class="step"></span>
            </div>
            <div class="flex flex-row flex-align-c flex-justify-con-sb" style="margin-top: 1rem;">
                <div>
                    <div class="button button-secondary user-select-none" id="prod-back" onclick="productForm(-1)">Vissza</div>
                </div>
                <div class="button button-primary user-select-none" id="prod-next" onclick="productForm(1)">Következő</div>
            </div>
        </div>
    `;
    // Termek szinet kivalaszto gombok "checked" erteket ki lehessen kapcsolni egy masodik kattintassal
    document.querySelectorAll('input[type=radio][name=product-color]').forEach((elem) => {elem.addEventListener('click', allowUncheck);elem.previous = elem.checked;
    }); function allowUncheck(e) {if (this.previous) { this.checked = false; }
        document.querySelectorAll(`input[type=radio][name=${this.name}]`).forEach((elem) => {elem.previous = elem.checked;});
    }const script = document.createElement('script');script.id = "formJS";script.setAttribute('src', 'script/products/add.js');document.body.append(script);
    // Egyedi dropdown menu a funkciohoz
    var x, i, j, l, ll, selElmnt, a, b, c;x = document.getElementsByClassName("select");l = x.length;
    for (i = 0; i < l; i++) {
        selElmnt = x[i].getElementsByTagName("select")[0];
        ll = selElmnt.length;a = document.createElement("DIV");a.setAttribute("class", "select-selected");
        a.innerHTML = selElmnt.options[selElmnt.selectedIndex].innerHTML;x[i].appendChild(a);
        b = document.createElement("DIV");b.setAttribute("class", "select-items select-hide");
        for (j = 1; j < ll; j++) {
            c = document.createElement("DIV");c.innerHTML = selElmnt.options[j].innerHTML;
            c.addEventListener("click", function(e) {
                var y, i, k, s, h, sl, yl;s = this.parentNode.parentNode.getElementsByTagName("select")[0];
                sl = s.length;h = this.parentNode.previousSibling;
                    for (i = 0; i < sl; i++) {
                    if (s.options[i].innerHTML == this.innerHTML) {
                        s.selectedIndex = i;h.innerHTML = this.innerHTML;y = this.parentNode.getElementsByClassName("same-as-selected");yl = y.length;
                        for (k = 0; k < yl; k++) {y[k].removeAttribute("class");}
                        this.setAttribute("class", "same-as-selected");break;
                    }
                } h.click();
            }); b.appendChild(c);
        } x[i].appendChild(b);
        a.addEventListener("click", function(e) {e.stopPropagation();closeAllSelect(this);this.nextSibling.classList.toggle("select-hide");this.classList.toggle("select-arrow-active");});
    }function closeAllSelect(elmnt) {
        var x, y, i, xl, yl, arrNo = [];
        x = document.getElementsByClassName("select-items");y = document.getElementsByClassName("select-selected");xl = x.length;yl = y.length;
        for (i = 0; i < yl; i++) {if (elmnt == y[i]) {arrNo.push(i)} else {y[i].classList.remove("select-arrow-active");}}
        for (i = 0; i < xl; i++) {if (arrNo.indexOf(i)) {x[i].classList.add("select-hide");}}
    }document.addEventListener("click", closeAllSelect);
    if(window.File && window.FileList && window.FileReader) { // FILE API tamogatottsaga:
        var filesInput = document.getElementById("product-image-input");
        filesInput.addEventListener("change", function(event) {
            var efiles = event.target.files; var output = document.getElementById("product-image-con");
            for (let i = 0; i < efiles.length; i++) {
                let file = efiles[i];
                if (!file.type.match('image')) continue;
                var picReader = new FileReader();
                picReader.addEventListener("load", function (event) { // Demo kep megjelenitese
                    var picFile = event.target;var t = new Date(); var m = t.getMonth()+1; var clsid = t.getFullYear()+``+m+``+t.getDate()+``+t.getTime();var div = document.createElement("div");
                    div.classList = 'flex flex-col flex-justify-con-c flex-align-c gap-05 user-select-none white-space-nowrap overflow-hidden text-ellipsis relative';div.id = clsid;
                    div.setAttribute('title', file.name);
                    div.innerHTML = `<div id='demo${clsid}' class="flex flex-col flex-align-c flex-justify-con-c gap-05"><img id='img${clsid}' class="product-preview-image border-softer drop-shadow ease" src="`+ picFile.result +`"></div><small class="text-secondary user-select-none"><em>${file.name}</em></small>`;
                    const removePreview = document.createElement('div');removePreview.title = "Eltávolítás";removePreview.classList = "flex product-remove-preview pointer absolute";
                    removePreview.id = "removePreview"+clsid;removePreview.setAttribute("image-key", clsid);
                    removePreview.innerHTML = `<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1"><g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"><rect x="0" y="0" width="24" height="24"></rect><circle class="svg" opacity="0.3" cx="12" cy="12" r="10"></circle><path d="M12.0355339,10.6213203 L14.863961,7.79289322 C15.2544853,7.40236893 15.8876503,7.40236893 16.2781746,7.79289322 C16.6686989,8.18341751 16.6686989,8.81658249 16.2781746,9.20710678 L13.4497475,12.0355339 L16.2781746,14.863961 C16.6686989,15.2544853 16.6686989,15.8876503 16.2781746,16.2781746 C15.8876503,16.6686989 15.2544853,16.6686989 14.863961,16.2781746 L12.0355339,13.4497475 L9.20710678,16.2781746 C8.81658249,16.6686989 8.18341751,16.6686989 7.79289322,16.2781746 C7.40236893,15.8876503 7.40236893,15.2544853 7.79289322,14.863961 L10.6213203,12.0355339 L7.79289322,9.20710678 C7.40236893,8.81658249 7.40236893,8.18341751 7.79289322,7.79289322 C8.18341751,7.40236893 8.81658249,7.40236893 9.20710678,7.79289322 L12.0355339,10.6213203 Z" class="svg"></path></g></svg>`;
                    output.prepend(div);div.append(removePreview);$('#preview-item-con').hide();
                    $('#removePreview'+clsid).click(function () {div.remove();document.getElementById('product-image-input').value = "";$('#preview-item-con').show();});
                });picReader.readAsDataURL(file);
            }
        });
    } else {closeAuth(); notificationSystem(1, 2, 0, 'Hiba', 'Nem támogatott funkció!');}
    function formatSizeUnits(bytes){if(bytes>=1073741824) {bytes=(bytes/1073741824).toFixed(0)+'</strong> GB';}
        else if (bytes>=1048576){bytes=(bytes/1048576).toFixed(0)+'</strong> MB';}else if (bytes>=1024){bytes=(bytes/1024).toFixed(0)+'</strong> KB';}else if (bytes>1){bytes=bytes+'</strong> bytes';}else if (bytes==1){bytes=bytes+'</strong> byte';}
        else{bytes='</strong> byte';}return bytes;
    }
}); $('#product-remove').click(() => {
    document.getElementById('section-header').innerHTML = `<div class="flex flex-row flex-align-c gap-1"><span class="flex pointer" onclick="productMain()"><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1"><g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"><rect x="0" y="0" width="24" height="24"></rect><circle class="svg" opacity="0.3" cx="12" cy="12" r="10"></circle><path d="M6.96323356,15.1775211 C6.62849853,15.5122561 6.08578582,15.5122561 5.75105079,15.1775211 C5.41631576,14.842786 5.41631576,14.3000733 5.75105079,13.9653383 L10.8939067,8.82248234 C11.2184029,8.49798619 11.7409054,8.4866328 12.0791905,8.79672747 L17.2220465,13.5110121 C17.5710056,13.8308912 17.5945795,14.3730917 17.2747004,14.7220508 C16.9548212,15.0710098 16.4126207,15.0945838 16.0636617,14.7747046 L11.5257773,10.6149773 L6.96323356,15.1775211 Z" class="svg" fill-rule="nonzero" transform="translate(11.500001, 12.000001) scale(-1, 1) rotate(-270.000000) translate(-11.500001, -12.000001) "></path></g></svg></span><span class="flex header_title_heading">Termékek</span></div>`;
    $('#product-body').css('height', '100%');
    document.getElementById('product-body').innerHTML = `
        <form id="discount-form" enctype="multipart/form-data" method="POST" action="manage-discount.php">
            <div class="product-tab flex flex-col gap-1">
                <div class="flex flex-col w-100">
                    <input type="search" class="sidenav-search-input" style="background-color: var(--background);" onkeyup="searchDiscount()" id="discount-search" name="discount-search" placeholder="Keresés a termékek között..">
                    <div class="products-con padding-bot-05 flex flex-row flex-align-c flex-justify-con-c flex-wrap gap-05" id="discount-items-con">
                        <?php
                            include($_SERVER['DOCUMENT_ROOT'].'/includes/inc.connect.php');
                            $con->query("SET CHARACTER SET utf8mb4"); if (mysqli_connect_errno()) {header ("Location: /500");}
                            $pr_sql = "SELECT products.* FROM `products` WHERE 1 ORDER BY added ASC";
                            $pr_res = $con-> query($pr_sql);
                            if ($pr_res-> num_rows > 0) {
                                while ($product = $pr_res-> fetch_assoc()) {
                                    echo '
                                    <div class="product_card flex flex-col padding-05 box-shadow background-bg border-soft user-select-none" style="width: 8rem;">
                                        <label search-key="'; echo $product['product_brand'] . ' '; echo strtr($product['product_brand'], $unwanted_array) . ' '; echo $product['product_name'] . ' '; echo strtr($product['product_name'], $unwanted_array) . ' '; echo $product['product_price'] . ' '; echo $product['product_code']; echo '"></label>
                                        <div class="product_card_inner flex flex-col h-100">
                                            <span class="flex flex-row flex-justify-con-sb flex-align-c">
                                                <span class="product_brand small">'; echo $product['product_brand']; echo '</span>
                                                <input type="radio" class="discount_input discount-radio box-shadow" name="discountable" code="'; echo $product['product_code']; echo'" value="'; echo $product['product_id']; echo'" placeholder="'; echo $product['product_name']; echo '" required>
                                            </span>
                                            <span class="flex flex-align-c flex-justify-con-c w-100">
                                                <img class="product_image" style="width: 5rem; height: 5rem;" src="/assets/images/uploads/'; echo $product['product_image']; echo '" alt="'; echo $product['product_name']; echo '">
                                            </span>
                                            <div class="product_info">
                                                <span class="product_title small">'; echo $product['product_name']; echo '</span>
                                            </div>
                                            <div class="product_price_con flex flex-row margin-top-a">
                                                <span class="flex flex-row text-primary small bold">'; echo $product['product_price']. ' ' . strtoupper($product['product_price_unit']); echo '</small></span>
                                            </div>
                                        </div>
                                    </div> 
                                    ';
                                }
                            } else { echo '<span class="text-primary">Nincsenek megjeleníthető termékek.</span>';}
                        ?>                                                   
                    </div>
                </div>
            </div>
            <div class="product-tab">
                <div class="flex flex-col gap-1 w-100">
                    <div class="flex flex-col w-100">
                        <span class="text-secondary" style="margin-bottom: .5rem;">Erősítse meg tevékenységét</span>
                        <div class="flex flex-row flex-align-c flex-justify-con-sb gap-1">
                            <input type="password" name="disc-confirm" class="staff-auth checkable" id="disc-confirm" placeholder="Adja meg a jelszót" required>
                            <span class="flex flex-align-c flex-justify-con-c staff-auth user-select-none" style="width: fit-content !important;">
                                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="1.2rem" height="1.2rem" viewBox="0 0 24 24" version="1.1"><g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"><mask fill="white"><use xlink:href="#path-1"></use></mask><g></g><path d="M7,10 L7,8 C7,5.23857625 9.23857625,3 12,3 C14.7614237,3 17,5.23857625 17,8 L17,10 L18,10 C19.1045695,10 20,10.8954305 20,12 L20,18 C20,19.1045695 19.1045695,20 18,20 L6,20 C4.8954305,20 4,19.1045695 4,18 L4,12 C4,10.8954305 4.8954305,10 6,10 L7,10 Z M12,5 C10.3431458,5 9,6.34314575 9,8 L9,10 L15,10 L15,8 C15,6.34314575 13.6568542,5 12,5 Z" class="svg"></path></g></svg>
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </form>
        <div class="flex flex-col margin-top-a">
            <div class="flex flex-row gap-1 flex-align-c flex-justify-con-c">
                <span class="step"></span>
                <span class="step"></span>
            </div>
            <div class="flex flex-row flex-align-c flex-justify-con-sb" style="margin-top: 1rem;">
                <div>
                    <div class="button button-secondary user-select-none" id="prod-back" onclick="productForm(-1)">Vissza</div>
                </div>
                <div class="button button-primary button-disabled user-select-none" id="prod-next">Következő</div>
            </div>
        </div>
    `;
    const script = document.createElement('script');script.id = "removeJS";script.setAttribute('src', 'script/products/remove.js');document.body.append(script);
    $(document).ready(function () {var box = document.getElementsByName("discountable");for (let i = 0; i < box.length; i ++) {box[i].parentNode.parentNode.parentNode.addEventListener("click", function () {box[i].click();$('#prod-next').attr('onclick', 'productForm(1)'); $('#prod-next').removeClass('button-disabled');});}});
}); $("#product-manage").click(function () {
    document.getElementById('section-header').innerHTML = `<div class="flex flex-row flex-align-c gap-1"><span class="flex pointer" onclick="productMain()" aria-label="Vissza"><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1"><g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"><rect x="0" y="0" width="24" height="24"></rect><circle class="svg" opacity="0.3" cx="12" cy="12" r="10"></circle><path d="M6.96323356,15.1775211 C6.62849853,15.5122561 6.08578582,15.5122561 5.75105079,15.1775211 C5.41631576,14.842786 5.41631576,14.3000733 5.75105079,13.9653383 L10.8939067,8.82248234 C11.2184029,8.49798619 11.7409054,8.4866328 12.0791905,8.79672747 L17.2220465,13.5110121 C17.5710056,13.8308912 17.5945795,14.3730917 17.2747004,14.7220508 C16.9548212,15.0710098 16.4126207,15.0945838 16.0636617,14.7747046 L11.5257773,10.6149773 L6.96323356,15.1775211 Z" class="svg" fill-rule="nonzero" transform="translate(11.500001, 12.000001) scale(-1, 1) rotate(-270.000000) translate(-11.500001, -12.000001) "></path></g></svg></span><span class="flex header_title_heading">Termékek</span></div>`;
    const dscript = document.createElement('script');dscript.id = "manageForm";dscript.setAttribute('src', 'script/products/manage.js');document.body.append(dscript);
    document.getElementById('product-body').innerHTML = `
        <form id="discount-form" enctype="multipart/form-data" method="POST" >
            <div class="product-tab flex flex-col gap-1">
                <div class="flex flex-col w-100">
                    <input type="search" class="sidenav-search-input" style="background-color: var(--background);" onkeyup="searchDiscount()" id="discount-search" name="discount-search" placeholder="Keresés a termékek között..">
                    <div class="products-con padding-bot-05 flex flex-row flex-align-c flex-justify-con-c flex-wrap gap-05" id="discount-items-con">
                        <?php
                            include($_SERVER['DOCUMENT_ROOT'].'/includes/inc.connect.php');
                            $con->query("SET CHARACTER SET utf8mb4"); if (mysqli_connect_errno()) {header ("Location: /500");}
                            $pr_sql = "SELECT products.* FROM `products` WHERE 1";
                            $pr_res = $con-> query($pr_sql);
                            if ($pr_res-> num_rows > 0) {
                                while ($product = $pr_res-> fetch_assoc()) {
                                    echo '
                                    <div class="product_card flex flex-col padding-05 box-shadow background-bg border-soft user-select-none" style="width: 8rem;" pid="'; echo $product['product_id']; echo'" pcode="'; echo $product['product_code']; echo'">
                                        <label search-key="'; echo $product['product_brand'] . ' '; echo strtr($product['product_brand'], $unwanted_array) . ' '; echo $product['product_name'] . ' '; echo strtr($product['product_name'], $unwanted_array) . ' '; echo $product['product_price'] . ' '; echo $product['product_code']; echo '"></label>
                                        <div class="product_card_inner flex flex-col h-100">
                                            <span class="flex flex-row flex-justify-con-sb flex-align-c">
                                                <span class="product_brand small">'; echo $product['product_brand']; echo '</span>
                                                <input type="radio" class="discount_input discount-radio box-shadow" name="discountable" code="'; echo $product['product_code']; echo'" value="'; echo $product['product_id']; echo'" required>
                                            </span>
                                            <span class="flex flex-align-c flex-justify-con-c w-100">
                                                <img class="product_image" style="width: 5rem; height: 5rem;" src="/assets/images/uploads/'; echo $product['product_image']; echo '" alt="'; echo $product['product_name']; echo '">
                                            </span>
                                            <div class="product_info">
                                                <span class="product_title small">'; echo $product['product_name']; echo '</span>
                                            </div>
                                            <div class="product_price_con flex flex-row margin-top-a">
                                                <span class="flex flex-row text-primary small bold">'; echo $product['product_price']. ' ' . strtoupper($product['product_price_unit']); echo '</span>
                                            </div>
                                        </div>
                                    </div> 
                                    ';
                                }
                            } else { echo '<span class="text-primary">Nincsenek megjeleníthető termékek.</span>';}
                        ?>                                                   
                    </div>
                </div>
            </div>
            <div class="product-tab flex flex-col gap-1">
                <div class="flex flex-col w-100 gap-05">
                    <div class="flex flex-col">
                        <span class="text-secondary" style="margin-bottom: .5rem;">Termék cikkszáma</span>
                        <input type="text" name="product-id" class="staff-auth checkable" id="product-id" placeholder="XXXXXX">
                    </div>
                    <span class="danger small-med bold"></span>
                </div>
                <div class="flex flex-col w-100">
                    <span class="text-secondary" style="margin-bottom: .5rem;">Termék mennyisége</span>
                    <div class="flex flex-col flex-justify-con-sb flex-align-c gap-05">
                        <div class="flex flex-row">
                            <input type="number" name="product-quantity" class="staff-auth checkable" id="product-quantity" placeholder="15">
                            <span class="relative">
                                <div class="select">
                                    <select required id="quantity-unit">
                                        <option value="db">&#9660;</option>
                                        <option value="db">db</option>
                                        <option value="tomb">tömb</option>
                                        <option value="csom">csom</option>
                                        <option value="dob">dob</option>
                                    </select>
                                </div>
                            </span>
                        </div>
                        <span class="danger small-med bold flex-justify-con-l w-100"></span>
                    </div>
                </div>
                <div class="flex flex-col w-100">
                    <span class="text-secondary" style="margin-bottom: .5rem;">Termék színe</span>
                    <span class="flex flex-row flex-justify-con-sb flex-align-c">
                        <span class="flex flex-row flex-wrap gap-05">
                            <span class="product-color-radio flex flex-align-c flex-justify-con-c border-soft">
                                <input class="product-color" type="radio" id="color-black" name="product-color" value="fekete" />
                                <label class="product-color-label user-select-none" for="color-black">Fekete</label>
                            </span>
                            <span class="product-color-radio flex flex-align-c flex-justify-con-c border-soft">
                                <input class="product-color" type="radio" id="color-white" name="product-color" value="fehér" />
                                <label class="product-color-label user-select-none" for="color-white">Fehér</label>
                            </span>
                            <span class="product-color-radio flex flex-align-c flex-justify-con-c border-soft">
                                <input class="product-color" type="radio" id="color-red" name="product-color" value="piros" />
                                <label class="product-color-label user-select-none" for="color-red">Piros</label>
                            </span>
                            <span class="product-color-radio flex flex-align-c flex-justify-con-c border-soft">
                                <input class="product-color" type="radio" id="color-blue" name="product-color" value="kék" />
                                <label class="product-color-label user-select-none" for="color-blue">Kék</label>
                            </span>
                            <span class="product-color-radio flex flex-align-c flex-justify-con-c border-soft">
                                <input class="product-color" type="radio" id="color-green" name="product-color" value="zöld" />
                                <label class="product-color-label user-select-none" for="color-green">Zöld</label>
                            </span>
                            <span class="product-color-radio flex flex-align-c flex-justify-con-c border-soft">
                                <input class="product-color" type="radio" id="color-yellow" name="product-color" value="sárga" />
                                <label class="product-color-label user-select-none" for="color-yellow">Sárga</label>
                            </span>
                            <span class="product-color-radio flex flex-align-c flex-justify-con-c border-soft">
                                <input class="product-color" type="radio" id="color-orange" name="product-color" value="narancssárga" />
                                <label class="product-color-label user-select-none" for="color-orange">Narancssárga</label>
                            </span>
                            <span class="product-color-radio flex flex-align-c flex-justify-con-c border-soft">
                                <input class="product-color" type="radio" id="color-brown" name="product-color" value="barna" />
                                <label class="product-color-label user-select-none" for="color-brown">Barna</label>
                            </span>
                            <span class="product-color-radio flex flex-align-c flex-justify-con-c border-soft">
                                <input class="product-color" type="radio" id="color-purple" name="product-color" value="lila" />
                                <label class="product-color-label user-select-none" for="color-purple">Lila</label>
                            </span>
                            <span class="product-color-radio flex flex-align-c flex-justify-con-c border-soft">
                                <input class="product-color" type="radio" id="color-pink" name="product-color" value="rózsaszín" />
                                <label class="product-color-label user-select-none" for="color-pink">Rózsaszín</label>
                            </span>
                            <span class="product-color-radio flex flex-align-c flex-justify-con-c border-soft">
                                <input class="product-color" type="radio" id="color-silver" name="product-color" value="ezüst" />
                                <label class="product-color-label user-select-none" for="color-silver">Ezüst</label>
                            </span>
                            <span class="product-color-radio flex flex-align-c flex-justify-con-c border-soft">
                                <input class="product-color" type="radio" id="color-colorful" name="product-color" value="színes" />
                                <label class="product-color-label user-select-none" for="color-colorful">Színes</label>
                            </span>
                        </span>
                    </span>
                </div>
            </div>
            <div class="product-tab">
                <div class="flex flex-col gap-1 w-100">
                    <div class="flex flex-col w-100 gap-05">
                        <div class="flex flex-col">
                            <span class="text-secondary" style="margin-bottom: .5rem;">Adja meg a termék nevét</span>
                            <input type="text" name="product-name" class="staff-auth checkable" id="product-name" placeholder="Termék neve">
                        </div>
                        <span class="danger small-med bold"></span>
                    </div>
                    <div class="flex flex-col w-100 gap-05">
                        <div class="flex flex-col">
                            <span class="text-secondary" style="margin-bottom: .5rem;">Adja meg a termék leírását</span>
                            <textarea class="textarea resize-none padding-1 border-soft checkable" name="product-description" id="product-description"></textarea>
                        </div>
                        <span class="danger small-med bold"></span>
                    </div>
                </div>
            </div>
            <div class="product-tab">
                <div class="flex flex-col w-100 gap-05">
                    <div class="flex flex-col w-100">
                        <span class="text-secondary" style="margin-bottom: .5rem;">Termék szélessége</span>
                        <div class="flex flex-col flex-justify-con-sb flex-align-c gap-05">
                            <div class="flex flex-row">
                                <input type="number" name="product-width" class="staff-auth checkable" id="product-width" placeholder="20">
                                <span class="relative">
                                    <div class="select">
                                        <select required id="width-unit">
                                            <option value="mm">&#9660;</option>
                                            <option value="mm">mm</option>
                                            <option value="cm">cm</option>
                                        </select>
                                    </div>
                                </span>
                            </div>
                            <span class="danger small-med bold flex-justify-con-l w-100"></span>
                        </div>
                    </div>
                    <div class="flex flex-col w-100">
                        <span class="text-secondary" style="margin-bottom: .5rem;">Termék magasság</span>
                        <div class="flex flex-col flex-justify-con-sb flex-align-c gap-05">
                            <div class="flex flex-row">
                            <input type="number" name="product-height" class="staff-auth checkable" id="product-height" placeholder="20">
                                <span class="relative">
                                    <div class="select">
                                        <select required id="height-unit">
                                            <option value="mm">&#9660;</option>
                                            <option value="mm">mm</option>
                                            <option value="cm">cm</option>
                                        </select>
                                    </div>
                                </span>
                            </div>
                            <span class="danger small-med bold flex-justify-con-l w-100"></span>
                        </div>
                    </div>
                    <div class="flex flex-col w-100">
                        <span class="text-secondary" style="margin-bottom: .5rem;">Termék hossza</span>
                        <div class="flex flex-col flex-justify-con-sb flex-align-c gap-05">
                            <div class="flex flex-row">
                            <input type="number" name="product-length" class="staff-auth checkable" id="product-length" placeholder="20">
                                <span class="relative">
                                    <div class="select">
                                        <select required id="length-unit">
                                            <option value="mm">&#9660;</option>
                                            <option value="mm">mm</option>
                                            <option value="cm">cm</option>
                                        </select>
                                    </div>
                                </span>
                            </div>
                            <span class="danger small-med bold flex-justify-con-l w-100"></span>
                        </div>
                    </div>
                    <div class="flex flex-col w-100 gap-05">
                        <div class="flex flex-col">
                            <span class="text-secondary" style="margin-bottom: .5rem;">Termék típusa</span>
                            <input type="text" name="product-type" class="staff-auth checkable" id="product-type" placeholder="Termék típusa">
                        </div>
                        <span class="danger small-med bold"></span>
                    </div>
                </div>
            </div>
            <div class="product-tab">
                <div class="flex flex-col w-100">
                    <div id="product-image-con" class="flex flex-row flex-justify-con-c gap-1">
                        <span class="flex flex-row flex-align-st flex-justify-con-c gap-05 flex-wrap" id="preview-item-con">
                            <div class="flex flex-col flex-align-c flex-justify-con-c gap-05">
                                <label class="flex flex-col flex-align-c background-bg pointer border-softer padding-1 product-image-button" for="product-image-input" style="box-shadow: var(--button-shadow) 0px 1px 4px;">
                                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="3rem" height="3rem" viewBox="0 0 24 24" version="1.1">
                                        <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"><rect class="svg" x="4" y="11" width="16" height="2" rx="1"/><rect class="svg" opacity="0.3" transform="translate(12.000000, 12.000000) rotate(-270.000000) translate(-12.000000, -12.000000) " x="4" y="11" width="16" height="2" rx="1"/></g>
                                    </svg>
                                </label>
                                <small class="text-secondary user-select-none"><em>Kép hozzáadása</em></small>
                            </div>
                            <input type="file" accept="image/*" id="product-image-input" name="product-image-input[]" required>
                            <span id="setImage"></span>
                        </span>
                    </div>
                    <div class="flex flex-col w-100">
                        <span class="text-secondary" style="margin-bottom: .5rem;">Termék ára</span>
                        <div class="flex flex-col flex-justify-con-sb flex-align-c gap-05">
                            <div class="flex flex-row">
                                <input type="number" name="product-price" class="staff-auth checkable" id="product-price" placeholder="XXXX">
                                <span class="relative">
                                    <div class="select">
                                        <select required id="price-unit">
                                            <option value="huf">&#9660;</option>
                                            <option value="huf">HUF</option>
                                            <option value="eur">EUR</option>
                                            <option value="usd">USD</option>
                                        </select>
                                    </div>
                                </span>
                            </div>
                            <span class="danger small-med bold flex-justify-con-l w-100"></span>
                        </div>
                    </div>
                    <div class="flex flex-col w-100 gap-05">
                        <div class="flex flex-col">
                            <span class="text-secondary" style="margin-bottom: .5rem;">Termék márkája</span>
                            <input type="text" name="product-brand" class="staff-auth checkable" id="product-brand" placeholder="Termék márkája">
                        </div>
                        <span class="danger small-med bold"></span>
                    </div>
                    <div class="flex flex-col w-100 gap-05">
                        <div class="flex flex-col">
                            <span class="text-secondary" style="margin-bottom: .5rem;">Erősítse meg tevékenységét</span>
                            <input type="password" name="disc-confirm" class="staff-auth checkable" id="disc-confirm" placeholder="Adja meg a jelszót" required="">
                        </div>
                        <span class="danger small-med bold"></span>
                    </div>
                </div>
            </div>
        </form>
        <div class="flex flex-col margin-top-a">
            <div class="flex flex-row gap-1 flex-align-c flex-justify-con-c">
                <span class="step"></span><span class="step"></span><span class="step"></span><span class="step"></span><span class="step"></span>
            </div>
            <div class="flex flex-row flex-align-c flex-justify-con-sb" style="margin-top: 1rem;">
                <div><div class="button button-secondary user-select-none" id="prod-back" onclick="productForm(-1)">Vissza</div></div>
                <div class="button button-primary button-disabled user-select-none" id="prod-next">Következő</div>
            </div>
        </div>
    `; document.querySelectorAll('input[type=radio][name=product-color]').forEach((elem) => {elem.addEventListener('click', allowUncheck);elem.previous = elem.checked;
    }); function allowUncheck(e) {if (this.previous) { this.checked = false; }document.querySelectorAll(`input[type=radio][name=${this.name}]`).forEach((elem) => {elem.previous = elem.checked;});}
    // Egyedi dropdown menu a funkciohoz
    var x, i, j, l, ll, selElmnt, a, b, c;x = document.getElementsByClassName("select");l = x.length;
    for (i = 0; i < l; i++) {
        selElmnt = x[i].getElementsByTagName("select")[0];
        ll = selElmnt.length;a = document.createElement("DIV");a.setAttribute("class", "select-selected");
        a.innerHTML = selElmnt.options[selElmnt.selectedIndex].innerHTML;x[i].appendChild(a);
        b = document.createElement("DIV");b.setAttribute("class", "select-items select-hide");
        for (j = 1; j < ll; j++) {
            c = document.createElement("DIV");c.innerHTML = selElmnt.options[j].innerHTML;
            c.addEventListener("click", function(e) {
                var y, i, k, s, h, sl, yl;s = this.parentNode.parentNode.getElementsByTagName("select")[0];
                sl = s.length;h = this.parentNode.previousSibling;
                    for (i = 0; i < sl; i++) {
                    if (s.options[i].innerHTML == this.innerHTML) {
                        s.selectedIndex = i;h.innerHTML = this.innerHTML;y = this.parentNode.getElementsByClassName("same-as-selected");yl = y.length;
                        for (k = 0; k < yl; k++) {y[k].removeAttribute("class");}
                        this.setAttribute("class", "same-as-selected");break;
                    }
                } h.click();
            }); b.appendChild(c);
        } x[i].appendChild(b);
        a.addEventListener("click", function(e) {e.stopPropagation();closeAllSelect(this);this.nextSibling.classList.toggle("select-hide");this.classList.toggle("select-arrow-active");});
    }function closeAllSelect(elmnt) {
        var x, y, i, xl, yl, arrNo = [];
        x = document.getElementsByClassName("select-items");y = document.getElementsByClassName("select-selected");xl = x.length;yl = y.length;
        for (i = 0; i < yl; i++) {if (elmnt == y[i]) {arrNo.push(i)} else {y[i].classList.remove("select-arrow-active");}}
        for (i = 0; i < xl; i++) {if (arrNo.indexOf(i)) {x[i].classList.add("select-hide");}}
    }document.addEventListener("click", closeAllSelect);
    $(document).ready(function () { var box = document.getElementsByName("discountable"); var today = new Date(); collData = new FormData();
        for (let i = 0; i < box.length; i ++) {
            box[i].parentNode.parentNode.parentNode.addEventListener("click", function () {
                $(box[i]).click();$('#prod-next').removeClass('button-disabled'); collData.append('pid', box[i].parentNode.parentNode.parentNode.getAttribute('pid')); 
                $.ajax({enctype: "multipart/form-data", type: "POST", url: "actions/products/data.php", data: collData, dataType: 'json', contentType: false, processData: false, 
                    beforeSend: function () {$('#prod-next').text("Folyamatban..");},
                    success: function(data){if (data.status) {console.log(data); $('#prod-next').text("Következő"); $('#prod-next').attr('onclick', 'productForm(1)'); $('#product-id').val(data.pcode); $('#product-quantity').val(data.quantity); document.getElementById('quantity-unit').value = data.qunit; document.getElementsByClassName('select-selected')[0].innerHTML = data.qunit; document.querySelector("input[type=radio][value="+data.color+"]").checked = true; $('#product-name').val(data.name); $('#product-description').val(data.info); $('#product-width').val(data.width); $('#width-unit').val(data.wunit); document.getElementsByClassName('select-selected')[1].innerHTML = data.wunit;$('#product-height').val(data.height); $('#height-unit').val(data.hunit); document.getElementsByClassName('select-selected')[2].innerHTML = data.hunit;$('#product-length').val(data.length); $('#length-unit').val(data.lunit); document.getElementsByClassName('select-selected')[3].innerHTML = data.lunit; 
                        $('#setImage').attr('image-id',data.image);

                        var output = document.getElementById("product-image-con"); var div = document.createElement("div");
                        div.classList = 'flex flex-col flex-justify-con-c flex-align-c gap-05 user-select-none white-space-nowrap overflow-hidden text-ellipsis relative';div.id = data.image;
                        div.setAttribute('title', data.name); div.innerHTML = `<div id='demo${data.image}' class="flex flex-col flex-align-c flex-justify-con-c gap-05"><img id='img${data.image}' class="product-preview-image border-softer drop-shadow ease" src="/assets/images/uploads/`+ data.image +`"></div><small class="text-secondary user-select-none"><em>${data.name}</em></small>`;
                        const removePreview = document.createElement('div');removePreview.title = "Eltávolítás";removePreview.classList = "flex product-remove-preview pointer absolute";
                        removePreview.id = "removePreview"+data.image;removePreview.setAttribute('aria-label', 'Kép eltávolítása'); removePreview.setAttribute("image-key", data.image); removePreview.innerHTML = `<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1"><g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"><rect x="0" y="0" width="24" height="24"></rect><circle class="svg" opacity="0.3" cx="12" cy="12" r="10"></circle><path d="M12.0355339,10.6213203 L14.863961,7.79289322 C15.2544853,7.40236893 15.8876503,7.40236893 16.2781746,7.79289322 C16.6686989,8.18341751 16.6686989,8.81658249 16.2781746,9.20710678 L13.4497475,12.0355339 L16.2781746,14.863961 C16.6686989,15.2544853 16.6686989,15.8876503 16.2781746,16.2781746 C15.8876503,16.6686989 15.2544853,16.6686989 14.863961,16.2781746 L12.0355339,13.4497475 L9.20710678,16.2781746 C8.81658249,16.6686989 8.18341751,16.6686989 7.79289322,16.2781746 C7.40236893,15.8876503 7.40236893,15.2544853 7.79289322,14.863961 L10.6213203,12.0355339 L7.79289322,9.20710678 C7.40236893,8.81658249 7.40236893,8.18341751 7.79289322,7.79289322 C8.18341751,7.40236893 8.81658249,7.40236893 9.20710678,7.79289322 L12.0355339,10.6213203 Z" class="svg"></path></g></svg>`;
                        output.prepend(div);div.append(removePreview); $('#preview-item-con').hide();
                        $(removePreview).click(function () {div.remove();$('#preview-item-con').show();});

                        if(window.File && window.FileList && window.FileReader) { // FILE API tamogatottsaga:
                        var filesInput = document.getElementById("product-image-input");
                        filesInput.addEventListener("change", function(event) {
                            var efiles = event.target.files; var output = document.getElementById("product-image-con");
                            for (let i = 0; i < efiles.length; i++) {
                                let file = efiles[i]; if (!file.type.match('image')) continue; var picReader = new FileReader();
                                picReader.addEventListener("load", function (event) { // Demo kep megjelenitese
                                    var picFile = event.target;var t = new Date(); var m = t.getMonth()+1; var clsid = t.getFullYear()+``+m+``+t.getDate()+``+t.getTime();var div = document.createElement("div");
                                    div.classList = 'flex flex-col flex-justify-con-c flex-align-c gap-05 user-select-none white-space-nowrap overflow-hidden text-ellipsis relative';div.id = clsid;
                                    div.setAttribute('title', file.name); div.innerHTML = `<div id='demo${clsid}' class="flex flex-col flex-align-c flex-justify-con-c gap-05"><img id='img${clsid}' class="product-preview-image border-softer drop-shadow ease" src="`+ picFile.result +`"></div><small class="text-secondary user-select-none"><em>${file.name}</em></small>`;
                                    const removePreview = document.createElement('div');removePreview.title = "Eltávolítás";removePreview.classList = "flex product-remove-preview pointer absolute";
                                    removePreview.id = "removePreview"+clsid;removePreview.setAttribute("image-key", clsid); removePreview.innerHTML = `<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1"><g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"><rect x="0" y="0" width="24" height="24"></rect><circle class="svg" opacity="0.3" cx="12" cy="12" r="10"></circle><path d="M12.0355339,10.6213203 L14.863961,7.79289322 C15.2544853,7.40236893 15.8876503,7.40236893 16.2781746,7.79289322 C16.6686989,8.18341751 16.6686989,8.81658249 16.2781746,9.20710678 L13.4497475,12.0355339 L16.2781746,14.863961 C16.6686989,15.2544853 16.6686989,15.8876503 16.2781746,16.2781746 C15.8876503,16.6686989 15.2544853,16.6686989 14.863961,16.2781746 L12.0355339,13.4497475 L9.20710678,16.2781746 C8.81658249,16.6686989 8.18341751,16.6686989 7.79289322,16.2781746 C7.40236893,15.8876503 7.40236893,15.2544853 7.79289322,14.863961 L10.6213203,12.0355339 L7.79289322,9.20710678 C7.40236893,8.81658249 7.40236893,8.18341751 7.79289322,7.79289322 C8.18341751,7.40236893 8.81658249,7.40236893 9.20710678,7.79289322 L12.0355339,10.6213203 Z" class="svg"></path></g></svg>`;
                                    output.prepend(div);div.append(removePreview);$('#preview-item-con').hide(); $('#removePreview'+clsid).click(function () {div.remove();document.getElementById('product-image-input').value = "";$('#preview-item-con').show();});
                                });picReader.readAsDataURL(file);
                            }
                        });
                        } else {closeAuth(); notificationSystem(1, 2, 0, 'Hiba', 'Nem támogatott funkció!');}
                        $('#product-price').val(data.price); $('#price-unit').val(data.punit); document.getElementsByClassName('select-selected')[4].innerHTML = data.punit.toUpperCase();$('#product-brand').val(data.brand); $('#product-type').val(data.type);
                    }else{closeAuth(); notificationSystem(1, 2, 0, 'Hiba', 'Érvénytelen adatok.');}},
                    error: function(data){console.log(data); $('#prod-next').text("Hiba!"); closeAuth(); notificationSystem(1, 2, 0, 'Hiba', 'Szerver oldali hiba.');}
                });
            });
        }
    });
});

</script>