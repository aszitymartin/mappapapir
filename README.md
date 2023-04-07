# Mappa Papír
<a name="top"></a>
<!-- TABLE OF CONTENTS -->
<details>
  <summary>Tartalomjegyzék</summary>
  <ol>
    <li><a href="#előszó">Előszó</a></li>
    <li><a href="#szükséges-kellékek-és-fejlesztői-környezet">Szükséges kellékek és fejlesztői környezet</a>
      <ul>
        <li><a href="#operációs-rendszer-választása">Operációs rendszer választása</a></li>
        <li><a href="#fejlesztői-környezet-választása">Fejlesztői környezet választása</a></li>
        <li><a href="#verziókezelés">Verziókezelés</a></li>
        <li><a href="#programozási-nyelvek-kiválasztása">Programozási nyelvek kiválasztása</a>
          <ul>
            <li><a href="#frontend-nyelvek-választása">FrontEnd nyelvek választása</a></li>
            <li><a href="#backend-nyelvek-választása">BackEnd nyelvek választása</a></li>
            <li><a href="#adatbázis-kezelés">Adatbázis kezelés</a></li>
          </ul>
        </li>
        <li><a href="#kiegészítő-könyvtárak">Kiegészítő könyvtárak</a></li>
      </ul>
    </li>
    <li><a href="#telepítés-és-üzembe-helyezés">Telepítés és üzembe helyezés</a>
      <ul>
        <li><a href="#telepítés-utáni-tesztelések">Telepítés utáni tesztelések</a>
          <ul>
            <li><a href="#windows-operációs-rendszereken">Windows operációs rendszereken</a></li>
            <li><a href="#linux-operációs-rendszereken">Linux operációs rendszereken</a></li>
          </ul>
        </li>
      </ul>
    </li>
    <li><a href="#első-lépések">Első lépések</a>
      <ul>
        <li><a href="#adatbázis-szerkezetének-kialakítása">Adatbázis szerkezetének kialakítása</a>
          <ul>
            <li><a href="#felhasználókhoz-kapcsolódó-táblák">Felhasználókhoz kapcsolódó táblák</a></li>
            <li><a href="#termékekhez-kapcsolódó-táblák">Termékekhez kapcsolódó táblák</a></li>
            <li><a href="#rendeléshez-kapcsolódó-táblák">Rendeléshez kapcsolódó táblák</a></li>
            <li><a href="#oldal-alap-beállításaihoz-kapcsolódó-táblák">Oldal alap beállításaihoz kapcsolódó táblák</a></li>
            <li><a href="#termék-véleményezéséhez-kapcsolódó-táblák">Termék véleményezéséhez kapcsolódó táblák</a></li>
            <li><a href="#e-mail-és-jelszó-kezeléshez-kapcsolódó-táblák">E-mail és jelszó kezeléshez kapcsolódó táblák</a></li>
            <li><a href="#visszajelzésekhez-kapcsolódó-táblák">Visszajelzésekhez kapcsolódó táblák</a></li>
            <li><a href="#besorolatlan-táblák">Besorolatlan táblák</a></li>
          </ul>
        </li>
        <li><a href="#fájlrendszer-kialakítása-a-szerveren">Fájlrendszer kialakítása a szerveren</a>
          <ul>
            <li><a href="#mappák">Mappák</a>
              <ul>
                <li><a href="#actions">Actions</a></li>
                <li><a href="#admin">Admin</a></li>
                <li><a href="#assets">Assets</a></li>
                <li><a href="#config">Config</a></li>
                <li><a href="#errors">Errors</a></li>
                <li><a href="#feedback">Feedback</a></li>
                <li><a href="#includes">Includes</a></li>
                <li><a href="#news">News</a></li>
                <li><a href="#router">Router</a></li>
                <li><a href="#webshop">Webshop</a></li>
              </ul>
            </li>
            <li><a href="#fájlok">Fájlok</a>
              <ul>
                <li><a href="#indexphp">Index.php</a></li>
                <li><a href="#htaccess">.htaccess</a></li>
                <li><a href="#homephp">home.php</a></li>
                <li><a href="#profilephp">profile.php</a></li>
              </ul>
            </li>
          </ul>
        </li>
      </ul>
    </li>
</ol>
</details>

![home](https://user-images.githubusercontent.com/105912216/230601842-594abbad-6025-457b-90f0-9375fbd8bc1c.png)

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

<p align="right">(<a href="#top">Vissza az elejére</a>)</p>

# Telepítés és üzembe helyezés

<p>Mint minden alkalmazást telepíteni kell, így a Microsoft Visual Studio Code-
ot is telepíteni kell, amihez a telepítőt a hivatalos oldalán lehet beszerezni.
Windows operációs rendszerre le kell tölteni a Xampp alkalmazást, hogy
működjön a PHP és a MySQL szerver is, ezeket a Xampp oldaláról lehet letölteni,
így egy kezelőfelületet kapunk, ahol el tudjuk indítani a webszerverünket, és az
adatbázis adminpanelét. Linuxos rendszereket az apache2 szolgáltatást
használom, mert a szolgáltatás automatikusan elindul a rendszerrel együtt, nincs
grafikus kezelőfelülete, de szerintem az nem is kell, ugyanis terminálból is el lehet
mindent érni.</p>
<h2>Telepítés utáni tesztelések</h2>
<p>Amint minden telepítés sikeresen megtörtént, teszteljük le, hogy minden
rendben van-e.<p>
<h3>Windows operációs rendszereken</h3>
<ul>
    <li>Navigáljunk el abba a mappába, ahova a Xamppot telepítettük
    (alapból a C:/xampp), majd lépjünk bele a htdocs mappába.</li>
    <li>Ezt a mappát nyissuk meg a vscode alkalmazásunkban, töröljuk a
    htdocs mappa minden előre létrehozott mappáit, fájljait és hozzunk
    létre egy index.php fájlt.</li>
    <li>A létrehozott index.php fájlba írjuk bele a következőket:
    &lt;?php phpinfo(); ?&gt;</li>
    <li>Mentsük el a fájlt, és írjuk be a böngésző címsorába, hogy: localhost</li>
    <li>Ha minden megfelelően működik, akkor böngészőnkben meg kell<li>
    jelennie egy oldalnak, ahol a telepített PHP részletes adatait
    láthatjuk.</li>
    <li>Most navigáljunk el a localhost/phpmyadmin oldalra a
    böngészőnkben.</li>
    <li>Ha minden megfelelően lett telepítve, akkor a phpmyadmin
    kezelőfelülete fog minket fogadni.</li>
</ul>
<h3>Linux operációs rendszereken</h3>
<p>A következőkben használhatjuk a terminálunkat is, vagy a grafikus módon is meg lehet oldani a tesztelést.</p>
<ul>
    <li> Navigáljunk el a /var/www/html/ mappába</li>
    <li> Töröljünk minden felesleges fájlt és mappát.</li>
    <li> Nyissuk meg a vscode alkalmazást, és ott is navigáljunk el ugyanebbe
    a mappába.</li>
    <li> Hozzunk létre egy index.php fájlt és írjuk bele a következőket: <pre><strong>&lt;?php phpinfo(); ?&gt;</strong></pre></li>
    <li> Mentsük el a fájlt, és írjuk be a böngésző címsorába, hogy: <strong>localhost</strong></li>
    <li> Ha minden megfelelően működik, akkor böngészőnkben meg kell
    jelennie egy oldalnak, ahol a telepített PHP részletes adatait
    láthatjuk.</li>
    <li> Most navigáljunk el a <strong>localhost/phpmyadmin</strong> oldalra a
    böngészőnkben.</li>
    <li> Ha minden megfelelően lett telepítve, akkor a phpmyadmin
    kezelőfelülete fog minket fogadni.</li>
</ul>

<p><em>Amennyiben nem enged létrehozni fájlokat a /var/www/html mappába, nyissuk
meg a terminálunkat és írjuk bele a következőket:</em></p>
<pre><strong>sudo chmod 777 /var/www/html/</strong></pre>

<p align="right">(<a href="#top">Vissza az elejére</a>)</p>

# Első lépések

<h2>Adatbázis szerkezetének kialakítása</h2>
<p>
Amint végeztem a megflelő szoftverek, könyvtárak és telepítésével, és üzembehelyezésével, a következő lépés az adatbázis szerkezetének kialakítása volt. Ez a folyamat kicsit több időt vett igénybe, ugyanis egy nagyobb méretű adatbázisban gondolkodtam, így a megtervezése is időigényes volt. Sajnos az adatbázisomat nem tudtam kialakítani a legelején, így menet közben kisebb-nagyobb javítgatásokon esett át, ami okozott némi kellemetlenséget, de a végére összeállt a kép.
</p>
<h3>Felhasználókhoz kapcsolódó táblák</h3>
<p>
Ahhoz, hogy a felhasználók adatait kezelni tudjuk létre kelett hozni a „customers” táblát, ahova a regisztrált felhasználó alap adatait mentjük el, mintpéldául a felhasználó nevét, e-mail címét, jelszavát, és regisztrációjának dátumát. Ezen kívűl természetesen tartalmaz még néhány adatot, de azok nem elsődlegesek az oldal működésében.
</p>

![image](https://user-images.githubusercontent.com/105912216/230589131-cb02c21e-c62c-4361-b3e2-97d6fca86e6b.png)

<h3>Táblák csoportosítása</h3>
<p>A felhasználóhoz tartozó adatok, amiket regisztrációnál adott meg, kategóriákra bontva. Ebben a csoportban a következő táblák szerepelnek</p>
<ul>
  <li>customers__ship – Szállítási adatok</li>
  <li>customers__inv – Számlázási adatok</li>
  <li>customers__lang – Nyelvi preferenciák</li>
  <li>customers__header – Automatikusan generált monogramm, színek a felhasználóhoz</li>
  <li>customers__priv – Felhasználó jogosultságai</li>
  <li>customers__money – Felhasználó egyenlegét tartalmazó tábla (Elavult)</li>
  <li>customers__token – Bejelentkezési tokenek mentése</li>
</ul>
<p>A felhasználóhoz csatolt kártyák adatai, és beállításai. </p>
<ul>
  <li>customers__card – Kártyák alap adatainak mentése</li>
  <li>customers__card__info – Kiegészítő adatok</li>
  <li>customers__card__primary – Elsődleges kártya mentése</li>
  <li>custoemrs__transactions – Egyenleg módosítás, feliratkozások kezelése</li>
  <li>customers__card__deleted – Törölt kártyák mentése</li>
</ul>
<p>Felhasználók feliratkozásainak kezelésére szóló táblák csoportosítása</p>
<ul>
  <li>customers__card__subscription</li>
  <li>customers__subpay__pool</li>
  <li>customers__subscription__data</li>
  <li>customers__subscription__payment</li>
</ul>
<p>Egyéb csoportosítások</p>
<ul>
  <li>customers__deleted – Törölt felhasználók adatai</li>
  <li>customers__deactivated – Deaktivált felhasználók</li>
</ul>
<p align="right">(<a href="#top">Vissza az elejére</a>)</p>

# Termékekhez kapcsolódó táblák
<p>Ahhoz, hogy létre tudjunk hozni termékeket az oldalon, vagy kezelni tudjuk őket, létre kell hozni egy erre a célre szolgáló táblázatot, ezért egyből csináltam is 11 darab táblát.</p>

![Screenshot from 2023-04-07 12-24-50](https://user-images.githubusercontent.com/105912216/230595328-a9e6e84f-2739-44e6-b8d2-7b46df245013.png)


<p>A táblákat itt is ugyanolyan logika alapján csoportosítottam, mint a felhasználói tábla csoportnál. Itt a „products” tábla az alap tábla, és ehhez kapcsolódik az összes olyan tábla, amelyiknek köze van a termékhez valamilyen módon. Ebben a táblában van mentve a termék neve, leírása és a fő képe, valamint a létrehozásának dátuma.</p>
<p>A products táblához a következő táblák kapcsolódnak:</p>
<ul>
    <li>products__category – Termék kategóriája</li>
    <li>products__shipping – Szállítási beállítások</li>
    <li>products__meta – Termék meta tagjainak beállítása</li>
    <li>products__review – Termékhez tartozó értékelések beállítása</li>
    <li>products__pricing – Árazás, leértékelések beállítása</li>
    <li>products__media – Termék miniatűrjei</li>
    <li>products__status – Termék státusza</li>
    <li>products__variations – Termék variációja</li>
    <li>products__search – A keresés algoritmust segítő tábla</li>
    <li>products__inventory – Raktár beállítások</li>
</ul>
<p align="right">(<a href="#top">Vissza az elejére</a>)</p>

# Rendeléshez kapcsolódó táblák
<p>A rendeléseknél el kellett gondolkoznom, hogy hogyan szeretném eltárolni az adatokat. Ugyanis, ha a vevő csak egy darab terméket szeretne rendelni egyszerre, akkor sokkal egyszerűbb dolgom lett volna, de mivel több terméket is lehet egyszerre rendelni, így a táblák kialakítása elég sajátos lett szerintem, mivel a rendelt termékeket és a mennyiségüket egyetlen sorba mentem egy pontosvesszővel a termékeket, és a mennyiségeket egy kettősponttal elválasztva. Ugyan ezzel spórolok, mivel ha a felhasználó 10 darab terméket vásárol egyszerre, nem fog 10 sort létrehozni az adatbázisomban, csak 1 darabot, viszont sokkal bonyolultabb lesz ezzel az adattal dolgozni a továbbiakban, mivel mindig ki kell nyerni az adatokat, hogy pontosan milyen termékből rendelt mennyit, és ezt mindig splittelni kell, valamint így nem tudtam kapcsolatokat teremteni a rendelések és a termékek között.</p>

![Screenshot from 2023-04-07 12-45-45](https://user-images.githubusercontent.com/105912216/230598137-de30d553-64d8-41c5-810f-6054bf1023a9.png)


<p>A logika itt is a megszokottak szerint épül fel: a fő táblám az „orders”, és ehhez a táblához kapcsolódik az a 4, ahova a rendeléshez tartozó adatokat mentem el. Az orders táblába csak a leg alapabb dolgokat mentem, mint a rendelő azonosítóját, a termék tömbböt, a rendelés státuszát és a rendelés leadásának dátumát.</p>
<p>A következő táblák kapcsolódnak még az „orders” táblához:</p>
<ul>
    <li>orders__payment – Fizetési mód és a kuponok mentése</li>
    <li>orders__ship – Szállítási mód mentése</li>
    <li>orders__invoice – Számlázási adatok tárolása</li>
    <li>orders__user – Rendelő adatainak mentése</li>
</ul>
<p align="right">(<a href="#top">Vissza az elejére</a>)</p>

# Oldal alap beállításaihoz kapcsolódó táblák
<p>A tervem az volt ezekkel a táblákkal, hogy az oldal alap beállításait ne csak közvetlenül a forráskódból tudjuk módosítani, hanem az admin panelen belül is legyen lehetőség ezeket szerkeszteni.</p>
<p>Az eddigiek szerint a felhasználó tudja módosítani az oldal nevét, ikonját mottóját, a webmesteri eléréseket, a meta tagokat, sőt még a fejlécben megjeleníthető linkeket is módosítani tudja.</p>
<p>A terveim közé tartozik az is, hogy a főoldalon, illetve a webáruház oldalon megjelenő híreket is tudjuk kezelni az admin panelen belül, ne csak a forráskódból. Erre sajnos még nincsen lehetőség, de az adatbázisban a táblái már létrevannak hozva, de kissebb optimalizálások nem ártanak neki, de az alapja megvan.</p>

![Screenshot from 2023-04-07 13-11-58](https://user-images.githubusercontent.com/105912216/230601288-f57d9812-c978-42f4-8736-9be30bb46450.png)

<p>A következő táblák vesznek így részt az oldal alap beállítási között</p>
<ul>
    <li>def__page – Oldal legalapabb beállításai</li>
    <li>def__news – Főoldalon megjelenő hírek</li>
    <li>def__news__status – Hírek státuszai</li>
    <li>def__header – Fejléc linkjei</li>
</ul>
<p align="right">(<a href="#top">Vissza az elejére</a>)</p>

# Termék véleményezéséhez kapcsolódó táblák
<p>A létrehozott termékeknél, ahol be van kapcsolva az a lehetőség, hogy lehessen írni értékelést, a bejelentkezett felhasználók írhatnak véleményt, vagy csak értékelhetik a terméket a megszokott csillagozásos rendszerrel.</p>
<p>A felhasználók beállíthatják, hogy az értékelés amit írtak az publikus legyen-e, vagy ne legyen a nevük feltüntetve az oldalon. Amennyiben nem szeretnék, hogy nevük megjelenjen, a nevük helyett egy „Privát felhasználó” szöveg fog megjelenni.</p>
<p>A felhasználók szerkeszthetik a véleményüket, illetve törölhetik is. A felhasználóknak továbbá joguk van értékelni mások véleményét, a „Hasznos” gombra kattintva az értékelés alatt. Amennyiben viszont sértőnek találják az értékelést, a felhasználó jelentheti azt az értékelést, amit majd az admin panelben meg lehet tekinteni és azt a rá jogosultak el tudják bírálni. Amennyiben tényleg sértőnek találták azt a véleményt a felhasználót akát el is lehet tiltani a további véleményezésektől.</p>

![reviews](https://user-images.githubusercontent.com/105912216/230604152-c934ab8d-9061-4afd-b1e9-7121f8eeccfa.png)

<p>A következő táblák kapcsolódnak a „reviews” táblához</p>
<ul>
    <li>rvr__w – Figyelmeztetett felhasználók</li>
    <li>rv__r – Jelentett vélemények</li>
    <li>rv__u – Hasznosnak talált vélemények</li>
</ul>
<p align="right">(<a href="#top">Vissza az elejére</a>)</p>

# E-mail és jelszó kezeléshez kapcsolódó táblák

<p>Az oldalon az e-mail címnek nem csak annyi a szerepe, hogy be tudjunk jelentkezni, hanem fel is iratkozhatunk különböző hírlevelekre, vagy értesítést kaphatunk, ha egy termék újra elérhető lesz, amit meg szeretnénk vásárolni. Ugyanakkor az e-mail még a két lépcsős hitelesítésre is szükséges. <em>(Ez a funkció jelenleg nem elérhető)</em></p>
<p>A jelszavak is több táblában vannak tárolva. Egy olyan táblában, ahol megnézzük, hogy a felhasználó használ-e két lépcsős hitelesítést, és ha igen, akkor milyen fajtát. A másik táblában pedig a jelszó változtatási előzmények vannak tárolva. Ez arra jó, ha a felhasználó meg szeretné változtatni a jelszavát, akkor meg tudjuk nézni, hogy tényleg új jelszót fog adni, vagy a jelenlegit próbálja mégegyszer beállítani.</p>

![email_password](https://user-images.githubusercontent.com/105912216/230625636-70a22b38-e1ce-471a-aaa2-7bb418e500b2.png)

<p>A következő táblák kapcsolódnak ide</p>
<ul>
    <li>e__banned – Tiltott e-mail címek</li>
    <li>e__subs – Hírlevélre feliratkozottak</li>
    <li>notify – Elfogyott termék készletfrissítésére feliratkozottak</li>
    <li>u__email – Felhasználói email címek</li>
    <li>u__password – Felhasználók jelszavai és hitelesítések</li>
    <li>u__pass__history – Jelszó előzmények</li>
</ul>
<p align="right">(<a href="#top">Vissza az elejére</a>)</p>

# Visszajelzésekhez kapcsolódó táblák
<p>Egy ilyen oldalon elengedhetetlen a vásárlók visszajelzéseire való építés. Akármilyen hibát talál a felhasználó, az jelezni tudja a megfelelő személynek, amit az admin panelen meg lehet tekinteni és kezelni is lehet.</p>

![feedback](https://user-images.githubusercontent.com/105912216/230632887-444a9711-e61f-4dc3-bb39-39cd6afc4aae.png)

<p>A felhasználó tud nyitni egy új visszajelzést, ahol le tudja írni észrevételeit, sőt még képeket is tud csatolni. Az illetékes meg tudja tekinteni az admin panelben, és tud válaszolni a visszajejzésre, valamint kezelni is tudja azokat. Tudja törölni, és a szátuszát módosítani.</p>
<p>A következő táblák voltak szükségesek ehhez</p>
<ul>
    <li>feedbacks – Visszajelzéseket itt hozza létre</li>
    <li>feedbacks_reply – A válaszok a visszajelzése itt lesznek mentve </li>
</ul>
<p align="right">(<a href="#top">Vissza az elejére</a>)</p>

# Besorolatlan táblák
<p>Akadnak olyan táblák, amiket nem lehet egy csoportba sorolni, így azokat itt említem meg.</p>

![uncategorised](https://user-images.githubusercontent.com/105912216/230665888-75f274ff-9934-43c6-bbbb-e1893d12f2fd.png)

<p>A „vouchers” táblában az aktuális kuponok találhatóak. Ennek a táblának az adatait csak a vásárlás folyamata közben veszi igénybe a program.</p>
<p>A „cart” és a „bookmarks” tábla szinte ugyan az, mivel a „cart” táblában a kosárhoz adott termékek adatai találhatóak, a „bookmarks” táblában pedig a könyvjelzőhöz adott termékek.</p>
<p>A „log” táblában található a legtöbb adat. Ide történik a naplózás. Ip címekre és kategóriákra bontva találhatóak benne az adatok.</p>
<p>A „login_attempts” táblába mentődik el minden olyan próbálkozás, amikor valaki be akart jelentkezni az oldalra. Ha olyan fiókba próbált bejelentkezni, amelyik létezik az oldalon, a fiók tulajdonosa ezt az információt meg tudja tekinteni a profil részlegen. A sikeres és a sikertelen próbálkozás is el van mentve.</p>
<p align="right">(<a href="#top">Vissza az elejére</a>)</p>

# Fájlrendszer kialakítása a szerveren
<p>Az adatbázis kialakítása után a fájlrendszer kialakítása volt a következő lépés. Ez a folyamat is elég bonyolult volt, nehéz kialakítani úgy egy összetett rendszert, hogy átlátható és könnyen kezelhető legyen. A kialakítással az volt a bajom, hogy folyton új funkciókat adtam hozzá a weboldalhoz, amiket később átalakítottam, vagy újra gondoltam teljesen, így én is bele bonyolódtam, ezért kicsit összekuszálódtak a dolgok, és tartalmaz olyan fájlokat a szerver, amit már nem használok, de nem merek kitörölni, mert az egy régebbi verzióhoz tartozik, ami működött és benne hagytam, ha netán visszatérnék az alkalmazásukhoz.</p>

![filesystem](https://user-images.githubusercontent.com/105912216/230679072-7d7d784f-23d5-4bd1-9e1b-583f2ac60407.png)

<p>A gondok ott kezdődtek, hogy nem objekt orientált programozást használtam az elején, hanem csak a folyamat végefelé kezdtem el alkalmazni, így nem lett az összes metódus átültetve egy osztályba, de a kezdeti elemek már ki lettek alakítva. Ezt orvosolni lehet, egy alaposabb átvizsgálással, és több idő ráfordításával, de addig maradtak benne felesleges, vagy ismétlődő elemek.</p>
<h2>Mappák</h2>
<h3>Actions</h3>
<p>Az „Actions” mappában megtalálhatóak az alapvető PHP scriptek, például a bejelentkeztetési, kijelentkeztetési script, és a regisztrációs script. Ezeken kívűl még megtalálható a téma kezelése, és néhány beállítási script, bár ezek nagy része már át lett helyezve egy másik gyűjtő mappába és át lett alakítva, így mostmár OOP központú lett.</p>

<h3>Admin</h3>
<p>Ebben a mappában az admin panelben elhelyezkedő scriptket vannak. Ezt a mappát nem éri el olyan felhasználó, amelyik nincsen bejelentkezve, valamint a bejelentkezett felhasználók közül is csak azok érhetik el, amelyeknek a jogosultságuk nagyobb, mint 0 (vásárló).</p>
<p>Ez a mappa is több almappár van osztva, az admin panelben megjelenő oldalak ide vannak gyűjtve, bár sajnos nem az összes, ami a mappák elnevezéséből eredő nem egyértelműség miatt történt. Ezek mappák áthelyezése tervben, van, bár nagy a valószínűsége, hogy egy jó pár elérési útvonalat át kellene írni, és úgy sem lenne biztos, hogy működne, így sajnos ezek már nem fognak áthelyezésre kerülni a záródolgozat leadása előtt.</p>

<h3>Assets</h3>
<p>Ez a mappa talán az egyik legfontosabb mappa a szerveren, ugyanis ide vannak összegyűjtve a JavaScript, PHP, CSS fájlok, valamint az oldal ikonja, a képek ide vannak feltöltve a termékekről, visszajeltésekből és a hírekről is.</p>
<p>Ebben a mappában található meg a legtöbb fájl, ugyanis ezek nagy része dinamikusan növekszik a hozzáadott termékekkel együtt.</p>

<h3>Config</h3>
<p>Ebben a mappában csak az adatbázishoz való csatlakozást létrehozó PHP script található meg.</p>

<h3>Errors</h3>
<p>Az Errors mappában megtalálható fájlok, csak a különböző hibaüzenetekre készített fájlok található meg, azokból is csak a három fő hibakódé: a 404, a 404 és az 500-as hibakódé, bár az utóbbi fájlnak nincsen sok értelme, ugyanis 500-as hibakód esetén nagy a valószínűsége, hogy nem lesz megjeleníthető ez a fájl, de a többi két fájl tökéletesen megjelenik az adott hibakódra.</p>

<h3>Feedback</h3>
<p>Ez a mappa a visszajelzések kezelésére született meg. Felépítése érdekes, mert néhány elemét nem tekintheti meg mindenki, van amelyiket csak a megfelelő jogosultsággal rendelkezők tekinthetik meg, de van olyan amit megtekinthet az is aki írta a visszajelzést. Egy közös, hogy a nem bejelentkezett felhasználók nem férnek hozzá egyik fájlhoz sem ebben a mappában.</p>

<h3>Includes</h3>
<p>Ez a mappa egy kicsit érdekesre sikeredett, mert néhány része nem tartozik ide, hanem az „assets” mappában lenne a helye, de már ittmaradtak. Természetesen ezeket át lehetne helyezni, de nem befolyásol semmit, csak az átláthatóságát a szervernek, de az a felhasználók részéről teljesen lényegtelen.</p>
<p>Itt vannak tárolva a telefonra optimalizált elemek is, például a Sidenav, vagy a fejléc, amik máshogyan jelennek meg, vagy viselkednek különböző képernyő felbontásoknál.</p>

<h3>News</h3>
<p>A News mappában a főoldalon megjelenő hírek kezelésére alkalmas oldalak jelenek meg, de mivel ezt a funkciót nem tudtam még befejezni, így nem kizárt, hogy a jövőben úgy lesz alakítva ez a mappa, hogy a webáruház részlegén megjelenő hírek kezelésére szolgáló oldalak is itt jelenjenek meg.</p>

<h3>Router</h3>
<p>Ez a mappa a legfontosabb mappa a szerveren, ugyanis ez olyan osztályokat tartalmaz, ami lehetővé teszi, hogy routolást használjak a szerveren mindenféle harmadik féltől származó kiegészítők, vagy pluginok nélkül.</p>

<h3>Webshop</h3>
<p>A Webshop mappában a webáruházhoz tartozó scriptek, oldalak találhatóak. Többek között a rendelés funkciót tartalmazó script is ebben a mappába van tárolva, valamint a termékek keresésére szolgáló kód is itt van.</p>
<p align="right">(<a href="#top">Vissza az elejére</a>)</p>

<h2>Fájlok</h2>
<p>A root mappában még található néhány fájl, vagy mappa ami vagy nem elérhető a felhasználóknak, vagy el lesz távolítva publikálásná, vagy akár olyanok amelyeket nem lett volna célszerű külön mappába helyezni.</p>
<p>A legfontosabb fájlokat emelném ki:</p>
<h3>Index.php</h3>
<p>Ez a fájl arra szolgál, hogy amint a böngészőben el akarják érni az oldalt, az összes kérés erre a fájlra fog mutatni, ami routeolási adatokat tartalmaz, hogy az adott kérés alapján hová irányítsa át a felhasználót.</p>
<h3>.htaccess</h3>
<p>Ez az a fájl ami lehetővé teszi, hogy működjön a PHP Router, ugyanis ebben a fájlban a szerver konfigurálása történik. Ezt a fájlt nem érik el a felhasználók, és ez szerencsére a szerver alapbeállításaiban van, hogy elérhetetlen legyen, ugyanis kritikus adatokat tartlamaz.</p>
<h3>home.php</h3>
<p>Erre a fájlra lesz átirányítva alapból a felhasználó, ha nem ad meg semmilyen queryt a linkben. Ebben a fájlban található meg a főoldal minden scriptje.</p>
<h3>profile.php</h3>
<p>Ez a fájl a profil oldal alapja, ide töltődnek majd be a többi fájlok, amik megjelenítik a felhasználó adatait, hogy tudja kezelni a profilját.</p>
<p align="right">(<a href="#top">Vissza az elejére</a>)</p>
