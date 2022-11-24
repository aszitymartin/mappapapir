<div class="flex flex-row-d-col-m gap-1">
    <div class="flex flex-col w-fa gap-1 border-soft item-bg box-shadow padding-1">
        <div class="flex flex-row flex-align-c flex-justify-con-sb">
            <div class="flex flex-col">
                <span class="text-primary bold">Termék törlése</span>
            </div>
        </div><hr style="border: 1px solid var(--background);" class="w-fa">
        <div class="flex flex-col gap-1">
            <div class="flex flex-row-d-col-m flex-align-c flex-justify-con-sb border-soft border-warning-dotted warning-bg padding-1">
                <div class="flex flex-row-d-col-m flex-align-c gap-1">
                    <div class="flex flex-row flex-align-c gap-1">
                        <div class="flex">
                            <svg xmlns="http://www.w3.org/2000/svg" width="36" height="36" viewBox="0 0 24 24" fill="none"><rect opacity="0.3" x="2" y="2" width="20" height="20" rx="10" fill="currentColor"></rect><rect x="11" y="14" width="7" height="2" rx="1" transform="rotate(-90 11 14)" fill="currentColor"></rect><rect x="11" y="17" width="2" height="2" rx="1" transform="rotate(-90 11 17)" fill="currentColor"></rect></svg>
                        </div>
                        <div class="flex flex-col flex-align-c flex-justify-con-fs">
                            <span class="bold w-100 small">Termék eltávolítása</span>
                            <span class="text-secondary small-med">Amennyiben kívánja eltávolítani ezt a terméket a webáruházból, meg kell erősítenie tevékenységét a jelszava beírásával</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="flex flex-row">
            <ul class="flex flex-col gap-1 padding-0 list-style-none">
                <li class="flex flex-col gap-1">
                    <span class="text-secondary small bold">Termék inaktiválása</span>
                    <ul class="flex flex-col gap-05 list-style-none">
                        <li>
                            <span class="text-secondary small-med">Amennyiben csak el szeretné tűntetni a terméket a webáruházból, de nem szeretné törölni a terméket az adatbázisból, ezt az opciót válassza</span>
                        </li>
                        <li>
                            <span class="text-secondary small-med">Az inaktív státusszal ellátott termékek nem fognak megjelenni a webáruházban, nem lesz megtalálható a vásárlók által, valamint megrendelése lehetetlen lesz.</span>
                        </li>
                        <li>
                            <span class="text-secondary small-med">Amennyiben mégis meg szeretné jeleníteni ezt a terméket, a termék szerkesztése menüben, a <strong>státusz</strong> részlegnél teheti meg.</span>
                        </li>
                    </ul>
                </li>
                <li class="flex flex-col gap-1">
                    <span class="text-secondary small bold">Termék törlése</span>
                    <ul class="flex flex-col gap-05 list-style-none">
                        <li>
                            <span class="text-secondary small-med">A termék törlése esetén a terméket a megerősítést követően azonnal eltávolítjuk adatbázisunkból, és többet nem lesz elérhető az oldalon.</span>
                        </li>
                        <li>
                            <span class="text-secondary small-med">Amennyiben az eltávolított termék meg lett rendelve egy vevő által, a törlés után a terméket még kiszállítjuk.</span>
                        </li>
                        <li>
                            <span class="text-secondary small-med">A törölt termék adatait, és a termékkel kapcsolatos tevékenységeket (értékelések) nem lesz lehetősége visszaállítani.</span>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
        <hr style="border: 1px solid var(--background);" class="w-100">
        <div class="flex flex-row w-100">
            <div class="flex flex-row flex-align-c gap-1">
                <label class="cst-chb-lbl">
                    <input type="checkbox" class="absolute" id="pd-accept">
                    <span class="cst-checkbox"></span>
                </label>
                <span class="text-secondary small-med pointer link user-select-none" id="pd-accept-text" style="line-height: 2rem;">Elolvastam, és elfogadom a termék törlésére / inaktiválására vonatkozó feltételeket, és kívánom elvégezni a következő műveleteket.</span>
            </div>
        </div>
        <div class="flex flex-row flex-align-fe flex-justify-con-fe">
            <span class="background-bg text-muted border-soft-light padding-05 not-allowed small user-select-none" id="pd-con-bt">Eltávolítás</span>
        </div>
    </div>
</div>
<script>
    $('#pd-accept-text').click(() => {
        $('#pd-accept').click();
    });
    $('#pd-accept').on('click', () => {
        if (document.getElementById('pd-accept').checked) {
            document.getElementById('pd-con-bt').classList.replace('background-bg', 'item-bg'); document.getElementById('pd-con-bt').classList.replace('text-muted', 'text-danger'); document.getElementById('pd-con-bt').classList.replace('not-allowed', 'pointer'); document.getElementById('pd-con-bt').classList.add('link');
            $("#pd-con-bt").click(() => {
                if (document.getElementById("pd-accept").checked) { 
                    c__wrapper.classList.add('fadein'); c__wrapper.classList.remove('fadeout'); c__box.classList.add('padding-t-0'); c__box.classList.add('popup'); c__box.classList.remove('popout'); document.body.append(c__wrapper); c__wrapper.append(c__box); $('html').css("overflow-y", "hidden");
                    c__box.innerHTML = `
                        <div class="flex flex-col gap-1">
                            <div class="flex flex-row flex-align-c flex-justify-con-sb padding-t-1" id="cbh__con">
                                <span class="text-primary small bold">Termék eltávolítása</span>
                                <div class="flex flex-row flex-align-c gap-05">
                                    <span class="text-primary pointer" aria-label="Bezárás" id="cl__box"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"><rect opacity="0.3" x="2" y="2" width="20" height="20" rx="5" fill="currentColor"/><rect x="7" y="15.3137" width="12" height="2" rx="1" transform="rotate(-45 7 15.3137)" fill="currentColor"/><rect x="8.41422" y="7" width="12" height="2" rx="1" transform="rotate(45 8.41422 7)" fill="currentColor"/></svg></span>
                                </div>
                            </div>
                            <div class="flex flex-row flex-align-c flex-justify-con-c">
                                <span class="text-secondary" style="font-size: .75rem !important;">A termék eltávolítása végleges és visszavonhatatlan. Amennyiben biztos döntésében, kérjük írja le a törlés okát, majd adja meg a biztonsági kulcsot.</span>
                            </div>
                            <div class="flex flex-col">
                                <div id="prod-del-editor" class="background-bg border-soft" style="height: 10rem;"></div>
                            </div>
                            <div class="flex flex-col gap-05">
                                <span class="text-primary bold small-med">Biztonsági kulcs</span>
                                <input type="text" id="del-sec-key" class="background-bg border-soft padding-1 w-fa outline-none border-none text-secondary small-med"/>
                            </div>
                            <div class="flex flex-row flex-align-c flex-justify-con-fe gap-1 w-fa">
                                <span error-data="delete"></span>
                                <div id="cnf-pd-del" class="flex flex-row flex-align-c flex-justify-con-sb gap-1 primary-bg primary-bg-hover pointer user-select-none padding-05 border-soft-light">
                                    <span class="smaller-light">Mentés</span>
                                </div>
                            </div>
                        </div>
                    `; 
                    var quill = new Quill('#prod-del-editor', { modules: { toolbar: false }, placeholder: 'Ide írja a törlés okát...', theme: 'snow' });
                    var con = document.getElementById('cbh__con'); var mc = new Hammer(con);mc.get('pan').set({ direction: Hammer.DIRECTION_ALL });mc.on("pandown", function(ev) { $('#cl__box').click(); });
                    $('#cnf-pd-del').click(() => {
                        
                    });
                    $('#cl__box').click(function () { c__wrapper.classList.add('fadeout'); c__box.classList.add('popout'); setTimeout(() => { c__wrapper.remove(); $('html').css("overflow-y", "unset"); }, 200); });
                }
            });
        } else { document.getElementById('pd-con-bt').classList.replace('item-bg', 'background-bg'); document.getElementById('pd-con-bt').classList.replace('text-danger', 'text-muted'); document.getElementById('pd-con-bt').classList.replace('pointer', 'not-allowed'); document.getElementById('pd-con-bt').classList.remove('link'); }
    });
</script>