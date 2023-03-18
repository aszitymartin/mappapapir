# Mappa Papír
<a name="top"></a>
<!-- TABLE OF CONTENTS -->
<details>
  <summary>Tartalomjegyzék</summary>
  <ol>
    <li><a href="#előszó">Előszó</a></li>
    <li><a href="#szükséges-kellékek-és-fejlesztői-környezet">Szükséges kellékek és fejlesztői környezet</a></li>
    <li><a href="#operációs-rendszer-választása">Operációs rendszer választása</a></li>
    <li><a href="#fejlesztői-környezet-választása">Fejlesztői környezet választása</a></li>
    <li><a href="#verziókezelés">Verziókezelés</a></li>
    <li><a href="#programozási-nyelvek-kiválasztása">Programozási nyelvek kiválasztása</a></li>
    <li><a href="#frontend-nyelvek-választása">FrontEnd nyelvek választása</a></li>
    <li><a href="#backend-nyelvek-választása">BackEnd nyelvek választása</a></li>
    <li><a href="#adatbázis-kezelés">Adatbázis kezelés</a></li>
    <li><a href="#kiegészítő-könyvtárak">Kiegészítő könyvtárak</a></li>
    <li><a href="#usage">Telepítés és üzembe helyezés</a></li>
    <li><a href="#usage">Telepítés utáni tesztelések</a></li>
    <li><a href="#usage">Windows operációs rendszereken</a></li>
    <li><a href="#usage">Linux operációs rendszereken</a></li>
</ol>
</details>

![Screenshot from 2022-05-21 18-31-53](https://user-images.githubusercontent.com/105912216/169660860-90219acd-e5c5-4b36-93c0-8a90f016a9f4.png)

# Előszó

<p>Mindig is jobban érdeklődtem a webfejlesztés iránt, mint más
programozáshoz, ezért nem meglepő, hogy egy weboldalt készítettem a
záródolgozatomként. Már a középiskolás éveim alatt is elkezdtem weboldalakat
készíteni, bár ezek sosem jutottak el a publikálás szintjére, mert útközben mindig
elveszett az érdeklődésem, vagy a lelkesedésem. De hogy honnan jött ez a
rajongás a webfejlesztés iránt?</p>
<p>Mint mindenki, és is sokat használtam az internetet, és weboldalak több
ezreit tekintettem már meg, és ahogy múlt az idő, és elkezdett érdekelni a
programozás, egyre kíváncsibb lettem, hogy mások hogyan tudtak összerakni egy
működő weboldalt. Előszőr még csak az inspectorban nézelődtem, próbáltam
megérteni az oldalak felépítését és szerkezetét. Később oktató videókat is
elkezdtem nézni, ahol kezdő szintent tanulhattam webfejlesztést, és meglepően
hamar belejöttem, így elkezdtem tudásomat továbbfejleszteni és mostmár saját
projekteken dolgoztni. Amint említettem ezek a projektek sosem lettek
publikálva, de gyakorlásnak, valamint legfőkébb tapasztalat és rutinszerzéshez
tökéletesek voltak.</p>
<p>Ahogy teltek a középiskolás évek, tanáraim egyre többet beszéltek a 13. év
végi záródolgozatról, és hogy mekkora jelentősége van. Így már elég hamar
eldöntöttem, hogy én egy webshopot szeretnék készíteni, és már 12. évben
elkezdtem az oldal vázlatát készíteni, ugyanis ezt a projektet igényesen szeretném
megcsinálni, valamint ezt az oldalt már publikálni kell. Azzal, hogy ezt projektet
elkészítem, magamnak is bizonyítok, hogy megérte a sok év gyakorlás és a be nem
fejezett weboldalak.</p>
<p>A webáruház ötlete úgy született meg, hogy egy családtagom a Mappa
Papír Kft-nél dolgozik, és megnéztem a weboldalukat, ami már több éve nem lett
frissítve és elég elavult a stílusa. Úgy döntöttem, hogy szeretnék egy jobban
átláthatóbb, kezelhetőbb, valamint modernebb webáruházat készíteni, és ha
elkészül egészében a weboldal talán még meg is próbálkozok vele, hogy az
általam készített webáruházat használják, de ez már csak másodlagos célom.</p>

<p align="right">(<a href="#top">Vissza az elejére</a>)</p>

# Szükséges kellékek és fejlesztői környezet

<h2>Operációs rendszer választása</h2>
<p>A tervezés során gondolkoztam azom, hogy milyen operációs rendszert
használjak a fejlesztés során, de mivel nem tudtam döntésre jutni, ezért Windows
operációs rendszert használtam kezdetben, ami nem tartott sokáig, így váltottam
Linuxra, amit azóta használok, és az odlal fejlesztése linuxról történt végül. Ennek
több oka is van, de a legfőbb ok az adatok biztonsága volt. Nem mertem kitenni
olyan kiszolgáltatott helyzetbe, hogy a fájljaim bármikor elveszhetnek egy
Windows frissítés közben, vagy véletlen bármi gond adódna.</p>
<h2>Fejlesztői környezet választása</h2>
<p>A fejlesztői környezet választásánal nem kellett nagyon sokat
gondolkoznom, ugyanis már régebb óta használom a Microsoft Visual Studio Code
alkalmazást a letisztultsága, a beépített GitHub szinkrinizálhatósága miatt, és
valamiért nekem ez az az IDE ami a legjobban megtetszett.</p>
<h2>Verziókezelés</h2>
<p>Az elmúlt éveimben nem használtam egy verziókezelő programot sem, így
azzal most kellett megismerkednem, így a GitHub-ra esett a választásom a
kezelhetősége és a kezdő barátsága miatt. Amíg tanultam elsajátítani a GitHub
kezelését rá kellett jönnöm, hogy nekem ezt már rég tudni kellett volna a korábbi
projektjeim fejlesztésekor is.</p>
<h2>Programozási nyelvek kiválasztása</h2>
<h3>FrontEnd nyelvek választása</h3>
<p>Maga az oldal váza HTML5-ban készült, valamint az oldal stílusát CSS3-ban
formáztam meg, mivel ez a legújabb CSS verzió, amiben már sokkal több
mindenre lehetünk képesek a CSS2-höz képest, valamint nőtt a böngészők
támogatottsága is. Ahhoz, hogy az oldalt meg is hajtsa valami JavaScriptet
használtam, ezzel együtt a jQuery könyvtárat vettem még segítségül, és ezekkel az
eszközökkel le is tudtam a FrontEnd kiválasztását.</p>
<h3>BackEnd nyelvek választása</h3>
<p>A BackEnd résznél PHP 7-et használtam, de idő közben megjelent a PHP 8
is, így menet közben váltottam át a frissebb verzióra. Szerencsére ez a váltás nem
járt semmiféle kódváltoztatással. A BackEnd-hez azért választottam PHP-t mert
nagyon tettszett a szintaktika, amit a PHP használ, valamint engem nagyon
megfogott, hogy milyen részletesen megkapjuk a hibajelentését, sőt még akkor is
szól, amikor nem kritikus hibát vétettünk, de például egy munkamenetet kétszer
indítottunk el, vagy hasonlók.</p>
<h3>Adatbázis kezelés</h3>
<p>Mivel PHP-t használok BackEnd-nek, ezért értelem szerűen MYSQL-t
használtam, már csak azért is mert iszonyat egyszerűen össze lehet kapcsolni az
adatbázist az oldalunkkal, kompatibilisek egymással, nagy a támogatottságuk, és
az SQL nyelvet tanultam meg, amit nagyon tetszik, mert részben leíró nyelv, így ha
van angol nyelvtutása valakinek, az könnyen meg fogja tudni tanulni az SQL-t is.</p>

<h2>Kiegészítő könyvtárak</h2>
<p>Az oldal elkészítése során nem szerettem volna nagyon sok kiegészítő
könyvtárakat használni, ugyanis azokat vagy importálni kell, amit azért nem
szerettem volna, mert annak a felhasználónak, aki lassúbb internettel rendelkezik,
tovább fog tartani az oldal betöltése. A másik lehetőség, hogy ezek könyvtárak
tartalmait letöltöm, és lokálisan tárolom, így nem kell még a könyvtár cdn-hez
kapcsolódni, így a lassabb kapcsolattal rendelkező felhasználóknak se fog még
lassabban tölteni az oldal. Az utóbb említett lehetőséggel éltem, amikor úgy
döntöttem, hogy az oldal működéséhez elengedhetetlen eszközöket szeretném
használni.</p>

* [Next.js](https://nextjs.org/)
* [React.js](https://reactjs.org/)
* [Vue.js](https://vuejs.org/)
* [Angular](https://angular.io/)
* [Svelte](https://svelte.dev/)
* [Laravel](https://laravel.com)
* [Bootstrap](https://getbootstrap.com)
* [JQuery](https://jquery.com)

<p align="right">(<a href="#top">Vissza az elejére</a>)</p>
