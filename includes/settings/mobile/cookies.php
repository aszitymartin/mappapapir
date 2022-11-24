<?php session_start(); ?>
<div class="sidenav-theme">
    <div class="sidenav-header flex flec-row flex-align-c flex-justify-con-sb">
        <span class="flex flex-col">
            <span class="header_title_heading">Sütik beállítása</span>
        </span>
        <span class="flex">
            <span class="text-primary" onclick="closeSettingMenu('cookies')">
                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"><rect x="0" y="0" width="24" height="24"/><circle class="svg" opacity="0.3" cx="12" cy="12" r="10"/><path d="M12.0355339,10.6213203 L14.863961,7.79289322 C15.2544853,7.40236893 15.8876503,7.40236893 16.2781746,7.79289322 C16.6686989,8.18341751 16.6686989,8.81658249 16.2781746,9.20710678 L13.4497475,12.0355339 L16.2781746,14.863961 C16.6686989,15.2544853 16.6686989,15.8876503 16.2781746,16.2781746 C15.8876503,16.6686989 15.2544853,16.6686989 14.863961,16.2781746 L12.0355339,13.4497475 L9.20710678,16.2781746 C8.81658249,16.6686989 8.18341751,16.6686989 7.79289322,16.2781746 C7.40236893,15.8876503 7.40236893,15.2544853 7.79289322,14.863961 L10.6213203,12.0355339 L7.79289322,9.20710678 C7.40236893,8.81658249 7.40236893,8.18341751 7.79289322,7.79289322 C8.18341751,7.40236893 8.81658249,7.40236893 9.20710678,7.79289322 L12.0355339,10.6213203 Z" class="svg" /></g>
                </svg>
            </span>
        </span>
    </div>
    <div class="theme-body">
        <div class="theme-desc text-align-l">
            <span class="text-secondary text-small">Ön szabályozhat bizonyos sütiket, amelyeket a Mappa Papír vállalati termékeivel kapcsolatos információk gyűjtésére használunk. Emlékezni fogjuk a beállításait, és alkalmazni fogjuk azokat mindenhol, ahol be van jelentkezve a Mappa Papír oldalra.</span>
            <br><br>
            <span class="text-secondary text-small">Választásait bármikor áttekintheti vagy módosíthatja. Tudjon meg többet a cookie-król és azok használatáról a Cookie-szabályzatunkban.</span>
        </div>
        <div class="theme-button-con flex flex-col">
            <div class="theme-item flex flex-row">
                <div class="flex flex-col w-100">
                    <div class="flex flex-row w-100">
                        <div class="theme-button flex flex-align-c flex-justify-con-sb w-100">
                            <span class="text-primary" style="font-size: 1.2rem;">Elengedhetetlen Sütik</span>
                            <label class="switch">
                                <input type="checkbox" checked disabled>
                                <span class="slider round"></span>
                            </label>
                        </div>
                    </div>
                    <div class="flex flex-col" style="margin-top: 1rem;">
                    <span class="text-secondary text-small">Ezek a sütik szükségesek a Mappa Papír vállalati termékeinek használatához. Ezek szükségesek ahhoz, hogy ezek a webhelyek rendeltetésszerűen működjenek.</span>
                    </div>
                </div>
            </div>
        </div>
        <div class="theme-button-con flex flex-col">
            <div class="theme-item flex flex-row">
                <div class="flex flex-col w-100">
                    <div class="flex flex-row w-100">
                        <div class="theme-button flex flex-align-c flex-justify-con-sb w-100">
                            <span class="text-primary" style="font-size: 1.2rem;">Választható Sütik</span>
                            <label class="switch">
                                <input type="checkbox" checked>
                                <span class="slider round"></span>
                            </label>
                        </div>
                    </div>
                    <div class="flex flex-col" style="margin-top: 1rem;">
                        <span class="text-secondary text-small">Ezek a cookie-k segítenek más vállalatoknak információkat megosztani velünk az alkalmazásaikon és webhelyeiken végzett tevékenységeiről. A kapott információkat arra használjuk fel, hogy személyre szabjuk és javítsuk élményét, beleértve az Ön által látott hirdetéseket, segítsünk a vállalkozásoknak az elemzésben és a hirdetések teljesítményének mérésében, valamint a Mappa Papíron kívüli szolgáltatásokat nyújtunk, például a Mappa Papírt más alkalmazásokba és webhelyekre való bejelentkezéshez.</span>
                    </div>
                </div>
            </div>
        </div>
        <div class="theme-button-con flex flex-col">
            <div class="theme-item flex flex-row">
                <div class="flex flex-col w-100">
                    <div class="flex flex-row w-100">
                        <div class="theme-button flex flex-align-c flex-justify-con-sb w-100">
                            <span class="text-primary" style="font-size: 1.2rem;">Sütik más cégektől</span>
                            <label class="switch">
                                <input type="checkbox" checked>
                                <span class="slider round"></span>
                            </label>
                        </div>
                    </div>
                    <div class="flex flex-col" style="margin-top: 1rem;">
                        <span class="text-secondary text-small">A Mappa Papír  termékeken kívüli hirdetési és mérési szolgáltatásokhoz, elemzésekhez, valamint bizonyos funkciók biztosításához és szolgáltatásaink fejlesztéséhez más cégek eszközeit használjuk. Ezek a cégek sütiket is használnak. További információt a Cookie-szabályzatunkban talál.</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>