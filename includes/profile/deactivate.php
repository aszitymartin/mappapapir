<div class="flex flex-row-d-col-m gap-1">
    <div class="flex flex-col w-fa gap-1 border-soft item-bg box-shadow padding-1">
        <div class="flex flex-row flex-align-c flex-justify-con-sb">
            <div class="flex flex-col">
                <span class="text-primary small bold">Fiók felfüggesztése</span>
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
                            <span class="bold w-100 small">Fiók deaktiválása / törlése</span>
                            <span class="text-secondary small-med">A fokozott biztonság érdekében ehhez meg kell erősítenie e-mail-címét vagy telefonszámát a fiók deaktiválásakor vagy törlésekor.</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="flex flex-row">
            <ul class="flex flex-col gap-1 padding-0 list-style-none">
                <li class="flex flex-col gap-1">
                    <span class="text-secondary small bold">Fiók deaktiválása</span>
                    <ul class="flex flex-col gap-05 list-style-none">
                        <li>
                            <span class="text-secondary small-med">Fiókja felfüggesztését követően profilját deaktiváljuk, és kiküldünk egy utolsó emailt, abban az esetben, ha nem Ön kezdeményezte volna a fiókja felfüggesztését, hogy legyen lehetősége reagálni. Az email kiküldése után megszakítunk Önnel minden értesítési kapcsolatot, amire fel volt iratkozva.</span>
                        </li>
                        <li>
                            <span class="text-secondary small-med">Az aktív rendelései még kiszállításra kerülnek, de az utolsó termék kiszállításával a fiókja nem lesz jogosult rendelések leadására, amíg nem aktiválja újra a profilját.</span>
                        </li>
                        <li>
                            <span class="text-secondary small-med">Fiókját újra aktiválhatja, ha újból bejelentkezik a felfüggesztett profilba. Bejelentkezés után azonnal minden megszakított kapcsolatokat visszaállítunk, és újból jogosult lesz a profilja rendelések leadására.</span>
                        </li>
                    </ul>
                </li>
                <li class="flex flex-col gap-1">
                    <span class="text-secondary small bold">Fiók törlése</span>
                    <ul class="flex flex-col gap-05 list-style-none">
                        <li>
                            <span class="text-secondary small-med">Fiókja törlésénél kijelentkeztetjük Önt, majd a kijelentkezéstől számított 30 napig még tároljuk fiókja adatait. Ez a 30 nap alatt bármikor bejelentkezhet, ezzel megszakítva a törlési folyamatot.</span>
                        </li>
                        <li>
                            <span class="text-secondary small-med">30 nap elteltével az Ön fiókja véglegesen törlésre kerül, és minden adatot, ami a fiókjával kapcsolatban áll, töröljük adatbázisunkból.</span>
                        </li>
                        <li>
                            <span class="text-secondary small-med">Fiókját a 30. nap elteltével már nem tudja újra aktiválni, új profilt kell regisztrálnia, ha mégis tag szeretne lenni.</span>
                        </li>
                        <li>
                            <span class="text-secondary small-med">A folyamatban lévő termékeit még kiszállítjuk a fiókja törlése után is.</span>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
        <hr style="border: 1px solid var(--background);" class="w-100">
        <div class="flex flex-row w-100">
            <label class="checkbox__con flex flex-align-c" id="profcana__con">
                <label class="text-secondary small-med pointer user-select-none" for="profcan__accept">Elolvastam, és elfogadom a fiók törlésére / felfüggesztésére vonatkozó feltételeket, és kívánom elvégezni a következő műveleteket.</label>
                <input type="checkbox" name="profcan__accept" id="profcan__accept">
                <span class="ch__checkmark"></span>
            </label>
        </div>
        <div class="flex flex-row flex-align-fe flex-justify-con-fe">
            <span class="danger-bg-disabled padding-05 border-soft not-allowed user-select-none bold" style="font-size: .9rem;" id="cncl__account">Folytatás</span>
        </div>
    </div>
</div><script src="/includes/profile/script/deactivate.js"></script>