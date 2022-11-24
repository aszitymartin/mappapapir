// Az oldal betoltesekor megjeleno, sutik beallitasara alkalmas panel letrehozasa, majd a megfelelo sutik letrehozasa a felhasznalo engedelyevel.
class cookie { constructor () { this.name = 'setup'; }

    check () { // Ellenorizzuk, hogy letezik-e a 'setup' suti
        var match = document.cookie.match(new RegExp('(^| )' + this.name + '=([^;]+)'));
        if (match) return match[2]; else essentials.__init(); document.getElementById('c__close').addEventListener('click', essentials.c__accept); document.getElementById('c__continue').addEventListener('click', essentials.c__accept);
    }

    __init () { // Panel inicializalasa, majd megjelenites az oldalon.
        var c__main = document.createElement('div'); c__main.classList = 'c__main flex user-select-none border-box'; c__main.id = 'c__id';
        c__main.innerHTML = ` 
            <div class="c__body flex padding-05">
                <div class="flex c__box"><span class="text-secondary c__small">Cookie-kat használunk a felhasználói élmény javítására és a webhely forgalmának elemzésére. A <span class="link c__link pointer">Folytatás</span> gombra kattintva Ön elfogadja a weboldalunk cookie-használatát a <a class="link c__link" href="#">cookie-kra vonatkozó szabályzatunkban</a> leírtak szerint. A <span class="link c__link pointer">beállítások</span> gombra kattintva bármikor módosíthatja a cookie-beállításokat.</span></div>
                <div class="flex flex-row flex-align-c gap-1 c__box">
                    <span class="link c__link c__small pointer" id="c__more">Beállítások</span><span class="button button-primary small-med" id="c__continue">Folytatás</span>
                    <span class="flex flex-align-c flex-justify-con-c pointer" aria-label="Bezárás" id="c__close"><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="1.5rem" height="1.5rem" viewBox="0 0 24 24" version="1.1"><g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"><g transform="translate(12.000000, 12.000000) rotate(-45.000000) translate(-12.000000, -12.000000) translate(4.000000, 4.000000)" class="svg-secondary"><rect x="0" y="7" width="16" height="2" rx="1"/><rect transform="translate(8.000000, 8.000000) rotate(-270.000000) translate(-8.000000, -8.000000) " x="0" y="7" width="16" height="2" rx="1"/></g></g></svg></span>
                </div>
            </div>
        `; document.body.prepend(c__main); $('#c__more').click(essentials.s__enable);
        return c__main;
    }

    a__cookies () { 
        var a__essential = []; var all__cookies = [];
        for (let i = 0; i < document.cookie.split(';').length; i++) { all__cookies.push(document.cookie.split(';')[i].replace(/\s/g, ''));
            if (all__cookies[i].charAt(0) === "_" && all__cookies[i].charAt(1) === "_") { a__essential.push(all__cookies[i]); }
        } return a__essential;
    }

    __essentials () {
        var w__array = []; var fd__time = new FormData();
        for (let i = 0; i < essentials.a__cookies().length; i++) { // Nelkulozhetetlen sutik szeparalasa es megjelenitese
            fd__time.append('timestamp', essentials.a__cookies()[i].split('=')[1].split('%3A')[essentials.a__cookies()[i].split('=')[1].split('%3A').length - 1]);
            w__array.push(`
                <div class="flex flex-row flex-align-c c__settings__item padding-05">
                    <div class="flex flex-align-c flex-justify-con-sb w-100 small">
                        <span class="text-primary bold">${essentials.a__cookies()[i].split('=')[0]}<span class="c__small text-secondary italic" id="exp_${essentials.a__cookies()[i].split('=')[0]}">`+
                            $.ajax({
                                enctype: "multipart/form-data", type: "POST", url: "/assets/php/timestamp.php", data: fd__time, dataType: 'json', contentType: false, processData: false,
                                success: function (data) { var a = new Date(); var b = new Date(data.timestamp); var d = (b-a); document.getElementById('exp_'+essentials.a__cookies()[i].split('=')[0]).textContent = ' ('+ Math.round(d/86400000) +' nap)'; },
                                error: function (data) { console.log(data); return 'NaN'; }
                            })
                        +`</span></span>
                        <span class="text-secondary c__small w-50">
                            A suti leirasara vonatkozo minden is ide lessz majd irva lorem.
                            ipsum dolores salvarez anches fernandez hokuszpok
                        </span>
                        <span class="flex flex-align-c flex-row gap-1">
                            <label class="switch switch-small">
                                <input type="checkbox" checked="checked" disabled>
                                <span class="slider slider-small round not-allowed"></span>
                            </label>
                            <span class="c__info pointer relative" cookie-key="${essentials.a__cookies()[i].split('=')[0]}">
                                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="1rem" height="1rem" viewBox="0 0 24 24" version="1.1"><g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"><rect x="0" y="0" width="24" height="24"/><circle class="svg" opacity="0.3" cx="12" cy="12" r="10"/><rect class="svg" x="11" y="10" width="2" height="7" rx="1"/><rect class="svg" x="11" y="7" width="2" height="2" rx="1"/></g></svg>
                            </span>
                        </span>
                    </div>
                </div>
            `);
        } if (essentials.a__cookies().length === 0 ) { w__array.push('<span class="text-secondary small-med">Még nincsenek beállítva sütik.</span>'); }
        return w__array;
    }

    s__init () {
        var c__settings = document.createElement('div'); c__settings.id = "c__settings"; c__settings.classList = "c__settings flex flex-col w-100";
        c__settings.innerHTML = `
            <div class="c__settings__wrapper">
                <div class="c__settings__group flex flex-col">
                    <div class="flex flex-row">
                        <span class="text-primary small-med bold">Elengedhetetlen sütik</span>
                    </div>
                `+ essentials.__essentials() +`
                </div>
                <div class="flex flex-row w-100 flex-align-c flex-justify-con-c">
                    <span class="text-secondary text-align-c smaller"><span class="bold">Tipp: </span><span id="c__tip">`+ essentials.t__load(essentials.g__browser().browser, essentials.g__browser().version); +`</span></span>
                </div>
            </div>
        `;
        return c__settings;
    }

    g__browser () { // a kodot felhasznaltam innen: https://stackoverflow.com/a/2401861/14038646
        navigator.browserInfo = (() => {
            const { userAgent } = navigator; let match = userAgent.match(/(opera|chrome|safari|firefox|msie|trident(?=\/))\/?\s*(\d+)/i) || []; let temp;
            if (/trident/i.test(match[1])) { temp = /\brv[ :]+(\d+)/g.exec(userAgent) || []; return `IE ${temp[1] || ''}`;}
            if (match[1] === 'Chrome') { temp = userAgent.match(/\b(OPR|Edge)\/(\d+)/);
              if (temp !== null) { return temp.slice(1).join(' ').replace('OPR', 'Opera'); }
              temp = userAgent.match(/\b(Edg)\/(\d+)/); if (temp !== null) { return temp.slice(1).join(' ').replace('Edg', 'Edge (Chromium)'); }
            }
            match = match[2] ? [ match[1], match[2] ] : [ navigator.appName, navigator.appVersion, '-?' ]; temp = userAgent.match(/version\/(\d+)/i);
            if (temp !== null) { match.splice(1, 1, temp[1]); }
            return { 'browser': match[0], 'version': match[1] };
          })(); return navigator.browserInfo;
    }

    t__load (browser, version) {
        switch (browser) {
            case 'Chrome': return browser +' <span class="italic">(v'+ version +') </span> böngészőben ezen menüpontok követésével megtalálhatja és kezelheti a sütiket:  <br> <span class="bold">Beállítások</span> > <span class="bold">Adatvédelem és Biztonság</span> > <span class="bold">Sütik és egyéb webhelyadatok</span> > <span class="bold">Az összes süti és webhelyadat megtekintése</span>'; break;
            case 'Firefox': return browser +' <span class="italic">(v'+ version +') </span> böngészőben ezen menüpontok követésével megtalálhatja és kezelheti a sütiket:  <br> <span class="bold">Beállítások</span> > <span class="bold">Adatvédelem és Biztonság</span> > <span class="bold">Sütik és egyéb webhelyadatok</span> > <span class="bold">Webhelyadatok kezelése</span>'; break;
            default: return 'Ezen a böngészőn a böngésző beállításai menüben találhatja meg és kezelheti a sütiket';
        }
    }

    s__enable () {
        var i__retrive = essentials.s__init(); var c__id = document.getElementById('c__id');
        c__id.append(i__retrive); c__id.classList.add('flex-col'); $('#c__more').unbind(); $('#c__more').click(essentials.s__disable);
        // $('.c__info').click(essentials.c__info);
    }

    s__disable () {
        var c__settings = document.getElementsByClassName('c__settings'); c__settings[0].remove();
        document.getElementById('c__id').classList.remove('flex-col'); $('#c__more').unbind(); $('#c__more').click(essentials.s__enable);
    }

    c__accept () { // Sutik elfogadasa, panel eltuntetese, elengedhetetlen sutik beallitasa.
        $('#c__id').fadeOut(200); setTimeout (function () { document.getElementById('c__id').remove(); }, 200);
    }

    c__info () {

        var c__info = document.createElement('div'); c__info.id = "c__info"; c__info.classList = "c__info__box flex flex-col border-soft box-shadow item-bg padding-1";
        c__info.innerHTML = ``;



    }

}

let essentials = new cookie(); essentials.check();




// console.log(document.cookie.split(';'));