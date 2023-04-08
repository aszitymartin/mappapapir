<a name="top"></a>
# Mappa Papír
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
    <li><a href="#html-szerkezet">HTML Szerkezet</a>
      <ul>
        <li><a href="#fejléc-kialakítása">Fejléc kialakítása</a>
          <ul>
            <li><a href="#kijelző-méretek">Kijelző méretek</a>
              <ul>
                <li><a href="#nagyobb-kijelzőn-megjelenő-fejléc">Nagyobb kijelzőn megjelenő fejléc</a></li>
                <li><a href="#telefonokon-megjelenő-fejléc">Telefonokon megjelenő fejléc</a></li>
              </ul>
            </li>
            <li><a href="#fejlécen-elhelyezkedő-gombok">Fejlécen elhelyezkedő gombok</a>
	      <ul>
	        <li><a href="#keresés-gomb">Keresés gomb</a></li>
	        <li><a href="#profil-gomb">Profil gomb</a></li>
		<li><a href="#bevásárlókosár-gomb">Bevásárlókosár gomb</a></li>
	      </ul>
	    </li>
          </ul>
        </li>
        <li><a href="#lábléc-kialakítása">Lábléc kialakítása</a></li>
        <li><a href="#főoldal-kialakítása">Főoldal kialakítása</a>
	  <ul>
	    <li><a href="#szolgáltatások-sáv">Szolgáltatások sáv</a></li>
	    <li><a href="#kiemelt-hírek">Kiemelt hírek</a></li>
	    <li><a href="#kiemelt-kategóriák">Kiemelt kategóriák</a></li>
	    <li><a href="#legnépszerűbb-termék">Legnépszerűbb termék</a></li>
	    <li><a href="#termékek">Termékek</a></li>
	  </ul>
      	</li>
      </ul>
    </li>
    <li><a href="#autentikáció">Autentikáció</a>
      <ul>
        <li><a href="#regisztráció">Regisztráció</a>
	  <ul>
	    <li><a href="#script">Script</a></li>
	  </ul>
        </li>
        <li><a href="#bejelentkezés">Bejelentkezés</a>
	  <ul>
	    <li><a href="#script-1">Script</a></li>
	  </ul>
        </li>
        <li><a href="#kijelentkezés">Kijelentkezés</a>
	  <ul>
	    <li><a href="#script-2">Script</a></li>
	  </ul>
        </li>
      </ul>
    </li>
    <li><a href="#profil-oldal">Profil oldal</a>
      <ul>
        <li><a href="#profil-áttekintése">Profil áttekintése<a></li>
        <li><a href="#személyes-információk">Személyes információk</a></li>
        <li><a href="#fiók-információk">Fiók információk</a></li>
        <li><a href="#biztonság">Biztonság</a></li>
	<li><a href="#jelszó-kezelése">Jelszó kezelése</a></li>
        <li><a href="#email-beállítások">Email beállítások</a></li>
	<li><a href="#mentett-kártyák">Mentett kártyák</a></li>
        <li><a href="#felfüggesztés">Felfüggesztés</a></li>
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

# HTML Szerkezet

<p>Az adatbázis és a fájlrendszer kialakítása után a következő lépés a HTML szerkezet és az oldal felépítése volt. Amit már a korábbi projektjeimből megtanultam, az az hogy a header és a footer külön fájlba fog kerülni, hogy aztán csak be kelljen importálni, ne kelljen az összes oldalon újra begépelni, mivel ez hatalmas időpazarlás, és sokkal nehezebb lesz szerkeszteni ezeket a szekciókat később, így csak egy-egy fájlt kell szerkeszteni, ha módosítani akarok valamit.</p>
<h2>Fejléc kialakítása</h2>
<p>A fejlécet úgy szerettem volna kialakítani, hogy ne takarjon ki túl sok helyet az oldalból, de a szükséges adatok és gombok megtalálhatóak legyenek rajta. Mivel az oldal nem tölti ki az egész képernyőt, hanem oldalsó margókat használ, így a fejlécet sem akartam, hogy teljes szélességet használjon. Mivel nagyon unalmasnak vélem a megszokott teljes szélességű, az oldal tetejénél kezdődő sablonos fejléceket, ezért próbáltam egy egyedi stílust használni, és egy lebegő sziget szerűségre gondoltam, ami nagyon megtettszett, így ennél maradtam.</p>
<p>Természetesen a különböző képernyő felbontásoknál nem biztos, hogy megfelelően működne, vagy nézne ki ez a koncepció, így készítettem egy külön fejlécet telefonos nézetre is, ami már sajnos kicsit több helyet foglal el, de ezt még valószínűleg optimalizálni fogok, és próbálom minimalizálni a fejléc magasságát.</p>
<h2>Kijelző méretek</h2>
<h3>Nagyobb kijelzőn megjelenő fejléc</h3>
	<p>Erre a kijelzőméretre próbáltam a leg kompaktabb és a lehető leg célszerűbb stílust kialakítani, ugyanis ezt a fejlécet többen fogján látni, mint a telefonos nézetűet.</p>
  
![header-desktop](https://user-images.githubusercontent.com/105912216/230711072-58c1f3a6-06fa-4449-875f-5e0dc263e602.png)

<small><em>Nagyobb méretű kijelzőkön megjelenő fejléc: A felhasználó be van jelentkezve</em></small>
<p>A fejléc alapvetően három részre osztódik. A bal szélén az oldal neve, valamint a cég mottója jelenik meg. Ettől kicsit jobbra, de nem egészen középen az oldal főbb linkjei jelennek meg. A jobb oldalon pedig a fontosabb gombok találhatóak, úgymint a keresés gomb, a profil gomb, és a kosár megtekintése gomb.</p>
<p>Ezek a gombok csak a bejelentkezett felhasználóknál jelenik meg, azoknak a felhasználóknak, akik nincsenek bejelentkezve, más gomb fog megjelenni a fejlécben.</p>

![header-desktop-lu](https://user-images.githubusercontent.com/105912216/230711088-069f596c-a568-4e53-be35-cbf6868db658.png)

<small><em>Nagyobb méretű kijelzőkön megjelenő fejléc: A felhasználó nincsen bejelentkezve</em></small>
<p>A szokásos keresés gomb továbbra is elérhető, de a profil és a kosár gomb helyett egy „Belépés” gomb fog megjelenni, amelyre rákattinva a felhasználó bejelentkezhet, vagy regisztrálhat egy új profilt.</p>
<h3>Telefonokon megjelenő fejléc</h3>

![header_mobile](https://user-images.githubusercontent.com/105912216/230711099-d64272a8-7a87-40ff-ae3d-f675c32c4539.png)

<small><em>Telefonos nézetnél megjelenő feljéc: A felhasználó be van jelentkezve</em></small>
<p>Telefonos nézeten már kicsit máshogy néz ki a fejléc, ugyanis itt csak kettő részre osztható az egész. Pontosabban két sorra. Az első sor is két részre van osztva: A bal oldalon a megszokott cég neve és mottója, a jobb oldalon pedig a kosár ikon. Ez a kosár ikon helyett pedig ugyanaz a „Belépés” gomb fog megjelenni, amikor nincs bejelentkezve a felhasználó, mint a nagyobb méretű kijelzőknél. </p>

![header-mobile-lu](https://user-images.githubusercontent.com/105912216/230711101-b0433c2d-f1d6-4afa-80f8-a357be4066c1.png)

<small><em>Telefonos nézetnél megjelenő feljéc: A felhasználó nincsen bejelentkezve</em></small>

<h2>Fejlécen elhelyezkedő gombok</h2>
<p>A fejlécen megjelenő gomboknak mind egyedi funkciójuk van, és ezek is eltérőek lehetnek telefonos nézetben, mint a nagy méretű képernyőkön. </p>
<h3>Keresés gomb</h3>
<p>A fejlécen elhelyezkedő gombok közül az első, és a valószínűleg a legtöbbet használt gomb a a keresés gomb. Erre kattintva egy ablak jelenik meg, ahol egy keresési mező fog megjelenni, ahova be tudjuk gépelni a keresett termék nevét, márkáját, vagy kategóriáját.</p>

![header-search](https://user-images.githubusercontent.com/105912216/230716276-9ef62b69-ad79-4b83-95b6-83eeab8c16e4.png)

<small><em>Keresési mező képe</em></small>
<p>A keresési mező alatt meg fognak jelenni a keresési javaslatok, amennyiben vannak. Amennyiben nem található termék a keresett kifejezésre, egy szöveg jelenik meg: “Nem található a keresett termék”.</p>

![header-search-keyw](https://user-images.githubusercontent.com/105912216/230716293-a77bf233-0f62-4000-80ae-f57a271bf4ef.png)

<small><em>Keresési mező: Keresett kifejezésre találat</em></small>
<p>A javaslatok alatt található egy két részre osztott szekció. A bal oldalon a “Gyakori kérdések” szekció található ami sajnos még nem működik, mivel nem jutottam még el odáig. A jobb oldalon pedig az “Ajánlott termékeink” mező található. Igazából ez a rész csak megjeleníti az utolsó 4 terméket, amit hozzáadunk az oldalhoz. Bár még annyival lehetne fokozni, hogy csak a bestseller termékeket jelenítse meg, de ez már csak a jövő kérdése.</p>

<h3>Profil gomb</h3>
<p>A fejléc jobb oldalán elhelyezkedő gombok közül a második gomb több funkciót tartalmaz. Amennyiben a felhasználó be van jelentkezve, rengeteg lehetőség közül választhat, többek között a profil megtekintése opció, de itt tudja megtekinetni a mentett termékeket, a rendelési előzményeit, vagy akár a beállításait is itt tudja módosítani, úgy mint az oldal témáját.</p>

![header-profile](https://user-images.githubusercontent.com/105912216/230716331-581ac7c1-c77a-441c-a1c0-cd88db860af5.png)

<small><em>Fejécben megjelenő profil menü ábrája</em></small>
<p>Amennyiben a felhasználó nincsen bejelentkezve, a már fentebb említett “Belépés” gomb fog megjelenni, amelyre kattintva megjelenik egy panel, ahol be tud jelentkezni, vagy regisztrálni tud egy új fiókot.</p>

<h3>Bevásárlókosár gomb</h3>
<p>A fejléc jobb oldali szekciójában az utolsó gomb a Bevásárlókosár gomb, ami a nevéből értetődően arra szolgál, hogy a kosárba adott termékeket tudjuk megtekintei és kezelni azokat. Valamint ez a funkció még arra is szolgál, hogy innen tudjuk megvásárolni csak azokat a termékeket amelyeket a kosárba adtunk, így nem kell egyesével megrendelni azokat.</p>

![header-basket](https://user-images.githubusercontent.com/105912216/230716339-1b196697-0acb-4a71-8be6-c92b32eabd57.png)

<small><em>Bevásárlókosár panel ábrája</em></small>
<p align="right">(<a href="#top">Vissza az elejére</a>)</p>

<h2>Lábléc kialakítása</h2>
<p>A lábléc kialakításánal a fő célom az volt, hogy ne legyen túlságosan zsúfolt, felesleges adatokkal telitűzdelve. Egy letisztult, egyszerű footert szerettem volna elhelyezni amely a főbb funkcionalitásait megtartva helyezkedne el az oldalak legalján.</p>

![footer](https://user-images.githubusercontent.com/105912216/230718747-831d3c5d-b49c-4547-8c80-71b16f643fac.png)

<small><em>Lábléc ábra</em></small>
<p>A footert két részre osztottam fel: Egy sort, ahol kattintható gombok vannak, például a keresés gomb, futárszolgálat információk, vagy visszajelzés gomb. Ez alatt található a cég logója, és a további linkek, például az ÁSZF link, Süti beállítások..</p>
<p align="right">(<a href="#top">Vissza az elejére</a>)</p>

<h2>Főoldal kialakítása</h2>
<p>A főoldal kialakításánál nem akartam túlzásba esni, és nem szerettem volna teli rakni mindenféle reklámmal, vagy zsúfolni az elemeket. Nem is szerettem volna túl sok terméket megjeleníteni a fő oldalon, ugyanis arra való a Webáruház oldal. Azt szerettem volna, ha a főoldal csak egy landing page lenne, és nem a termékek vásárlása lenne a fő cél. Éppen ezért helyeztem el a főoldal legelejére a szolgáltatások sávot, ahol megtekinthetik, hogy a cég milyen szolgáltatásokat nyújt.</p>
<h3>Szolgáltatások sáv</h3>
<p>A szolgáltatások résznél ki szerettem volna emelni, hogy mivel is foglalkozik igazából a cég, és nem csak irodai eszközöket ad el, hanem nyomtatással, könyv kötéssel, tervezéssel is foglalkozik. </p>

![services](https://user-images.githubusercontent.com/105912216/230718762-0c670ea2-7f6e-4548-872b-d8c2f603e1e8.png)

<small><em>Szolgáltatások sáv ábra</em></small>
<h3>Kiemelt hírek</h3>
<p>A következő elem a főoldalon a kiemelt hírek szekciója. Ez a szekció jelenleg egy újragondoláson esik át. Jelenleg csak annyi a tartalma, amennyit látunk a főoldalon a kis slideren, de szeretném, ha ezek az elemek kattinthatóak legyenek és további szöveget tudjon olvasni a felhasználó a témával kapcsolatban. </p>

![news](https://user-images.githubusercontent.com/105912216/230718764-0adcabc1-5373-42a3-a363-c03b8641aaa9.png)

<small><em>Főoldal hírek szekció ábra</em></small>
<h3>Kiemelt kategóriák</h3>
<p>Ezt a sávot csak azért adtam hozzá a főoldalhoz, hogy ne csak a termékek jelenjenek meg a főoldalon, hanem  legyen egy kis szekció, ahol láthatják a felhasználók, hogy melyik kategóriák a felkapottak az oldalon. A jelenlegi állapotban csak az első 5 kategóriát választja ki az adatbázisból és jeleníti meg azokat. Tervben van, hogy a rendelések alapján szűrje ki, hogy melyik kategóriúbol rendelték a legtöbbet, és azok alapján állítsa elő a sorrendet.</p>

![category](https://user-images.githubusercontent.com/105912216/230718773-2fd15482-39e1-48ac-910e-3d0e7417f198.png)

<small><em>Kiemelt kategóriák ábra</em></small>
<h3>Legnépszerűbb termék</h3>
<p>Ebben a szekcióban az a termék jelenik meg, amelyik a legnépszerűbb termék az értékelések alapján. A  megjelenő szekció háttérszíne a termék képének színeinek átlaga, és a rajta elhelyezkedő szöveg színe pedig a háttér szín kontrasztja, hogy jól látható legyen a szöveg, akármilyen színű is a háttér.</p>

![popular](https://user-images.githubusercontent.com/105912216/230718780-86f9eb03-f5bc-4d63-842f-d3459979f868.png)

<small><em>Legnépszerűbb termék ábra</em></small>
<h3>Termékek</h3>
<p>Ebben a szekcióban az adatbázisba felvett termékek jelennek meg, kategóriákra bontva.  A termék kártyák tervezésénél kipróbáltam több változatot is, de a jelenlegi tetszett a legjobban a letisztultsága miatt. Igyekeztem minél kevesebb adat megjelenítésével minél több információt átadni a vásárlóknak.</p>

![products](https://user-images.githubusercontent.com/105912216/230718783-0afba41f-29bc-4e34-a224-d934f5e191e9.png)

<small><em>Termékek ábra</em></small>
<p align="right">(<a href="#top">Vissza az elejére</a>)</p>

# Autentikáció

<p>Amint elkészültem a főoldallal, a következő lépés az volt, hogy ne csak úgy tudjak létrehozni felhasználókat, hogy közvetlenül az adatbázisban hozom létre, hanem akartam rá egy scriptet és front-end elemeket is. Előszőr a regisztrációval kezdtem, ami elég hosszadalmasra sikeredett, tekintve az adatok mennyiségét, amit meg kell adni, hogy a felhasználó regisztrálni tudjon.</p>
<h2>Regisztráció</h2>
<p>Regisztrálni csak akkor lehet egy fiókot, ha a felhasználó még nincsen bejelentkezve. Ez kivételesen nem igaz, ha az admin panelből szeretnénk létrehozni fiókokat, mert ott bármikor bármennyit létre lehet hozni.</p>
<p>A regisztráció úgy történik, hogy a fejlécben megjelenő “Belépés”  gombra kattintva megjelenő panelen kiválasztjuk a “Regisztráció” menüpontot és kitöltjük az űrlapot.</p>

![register](https://user-images.githubusercontent.com/105912216/230723243-0ed210f7-d8ae-45e6-ad0a-3652e65287d1.png)

<small><em>Regisztrációs panel ábra</em></small>
<h3>Script</h3>
<p>A regisztrációs script megírása elég sok időt vett igénybe, és így sem fedtem le minden hibalehetőséget. Az első hiba, amit elkövettem, hogy az adatbázisba mentéskor nem egy prepared statement-et használtam, amiben lett volna egy Transaction, hanem minden táblába íráskor egy külön prepared statementet hoztam létre, így az eredmény ugyanaz, ha az egyik folyamat közben hiba lép fel, akkor az egész regisztrációt megszakítja, és a már létrehozott adatokat törölni fogja, csak sokkal több időt vett igényben, és feleslegesn bonyolult. Ezt lehet orvosolni, és nagyon valószínű, hogy a későbbiekben újra lesz gondolva ez a script.</p>

![register_script](https://user-images.githubusercontent.com/105912216/230723251-001c52cf-ea0e-4c03-a5d0-a5bc3db39bc9.png)

<small><em>Regisztrációs Script: Egymásba ágyazott prepared statementek ábra</em></small>
<p>A script megnézi, hogy sikerült-e létrehozni a felhasználót a megadott adatokkal, és ha hiba nélkül sikerült hozzáadni az adatbázishoz, elkezdi generlálni a felhasználó kártyáját, amivel fizetni tud majd az oldalon. Ez a kártya minden felhasználónak egyedi, és csak 1 darabbal rendelkezhet fiókonként. Ennek a kártyának a lejárati dátuma 3 évre lett állítva. Amint létre lett hozva a kártya, a script beállítja ezt elsődlegesnek, és elmenti a naplózási táblába a sikeres regisztrációról szóló szöveget. Amennyiben a kártya létrehozása közben hiba történik, a felhasználó törlése kerül, és a regisztrációt újra kell kezdeni.</p>

<h2>Bejelentkezés</h2>
<p>Amint végeztem a Regisztrációs scripttel, a bejelentkezési funkció volt a következő, amit el kellett készítenem. A bejelentkezés szintént csak akkor érhető el, ha a felhasználó még nincsen bejelentkezve. Bejelentkezni a megszokott módon, a fejlécen megjelenő “Belépés” gombra kattintva lehet.</p>
<p>Itt két dolog történhet. Ha már valaki be volt jelentkezve erről a gépről az oldalra, és úgy jelentkezett ki, hogy mentette a bejelentkezési adatokat, akkor az oldal felkínálja, hogy jelentkezzen be abba a fiókba, vagy jelentkezzen be egy másikba.</p>

![login](https://user-images.githubusercontent.com/105912216/230723264-24729be6-aaeb-4467-b8c2-69fd089720e9.png)

<small><em>Bejelentkezési panel: Nincsen mentett fiók ábra</em></small>
<p>Amennyiben vannak mentve bejelentkezési adatok, az űrlap helyett meg fog jelenni a mentett felhasználók bejelentkezési adatai egy listában, és azokat kiválasztva tud bejelentkezni, a megfelelő jelszó megadása után a felhasználó.</p>
<p>Abban az esetben, ha nem szerepel a fiókja a mentettek listájában, akkor a “Bejelentkezés másik fiókkal” gombra kattintva meg kell adnia az e-mail címét és jelszavát, hogy be tudjon jelentkezni.</p>

![login-history](https://user-images.githubusercontent.com/105912216/230723280-62cc76d4-291c-4812-9ff1-52a505c2ff96.png)

<small><em>Bejelentkezési panel: Mentett fiókok listája ábra</em></small>
<h3>Script</h3>
<p>A bejelentkezés scriptje már nem vett olyan sok időt igénybe, mint a regisztrációje, ugyanis itt már lényegesen kevesebb feltételre kellett figyelni. </p>
<p>Előszőr meg kellett nézni, hogy létezik-e olyan felhasználó az adatbázisban, akinek az-e az e-mail címe, amit a felhasználó megadott a bejelentkezés során. Amennyiben nincsen, akkor a kód visszatér egy hibaüzenettel, amit a front end résznél lekezelek, hogy tudja a felhasználó, hogy pontosan mi is a hiba.</p>
<p>Amennyiben létezik felhasználó a megadott e-mail címmel meg kell nézni, hogy a jelszavak egyeznek-e. Amennyiben nem egyeznek a jelszavak, akkor egy naplózás fog megtörténni, hogy a megadott e-mail címmel valaki megpróbált bejelentkezni sikertelenül. A fiók tulajdonosa megtudja tekinteni a bejelentkezési próbálkozásokat.</p>
<p>Abban az esetben, ha az e-mail cím és a jelszó is egyezik az adatbázisban lévővel, ugyanúgy naplózás fog történni, csak annyi változik, hogy a bejelentkezés sikeresen történt meg. A naplózás után megnézzük, hogy a felhasználó fiókja jelenleg deaktiválva van-e. Amenyiben deaktiválva van, kiszedjük a fiókját a deaktiváltak közül, így már nem lesz érvényben a felfüggesztés, és használhatja tovább a fiókját.</p>
<p>Ugyanezt meg kell nézni, hogy a felhasználó jelenleg a töröltek listájában van-e. Amennyiben igen, akkor kiszedjük onnan, és folytathatja a bejelentkezést.</p>
<p>A felhasználó törlés úgy működik az oldalon, hogy amint a felhasználó törölni szeretné a fiókját, kijelentkeztetjük az oldalról és a fiókja egy olyan táblába mentődik el, amit egy event script minden nap éjfélkor mégnézi, hogy mennyi ideje van abban a táblában a fiók. Amint már a 30.napja van ott, a fiókot véglegesen törli az adatbázisból.</p>
<p>Amint a jelszó és e-mail páros helyes, jön a sütik kezelése, és egy olyan sütit hozunk létre a böngészőben, hogy akárhányszor belép az oldalra a felhasználó, megnézi, hogy létre van-e hozva az “__au__login” süti. Ebben a sütiben vannak tárolva a felhasználó egyedi tokene, amit minden bejelentkezésnél megkap. Ez arra szolgál, hogy ne jelentkeztesse ki a felhasználót az oldalról a böngésző, amint a böngésző session-je lejár, ami általában fél óra alapból. Ez egy olyan “Remember me” funkcióként lett létrehozva.</p>

![login_script](https://user-images.githubusercontent.com/105912216/230723293-3887db55-7cb5-4f7a-a751-3939c1b5fd7e.png)

<small><em>Bejelentkezési script: Süti létrehozása ábra</em></small>

<h2>Kijelentkezés</h2>
<p>A bejelentkezés után jött a kijelentkezés script, ahol szerettem volna, hogy a felhasználónak meglegyen a joga, hogy eldönthesse, hogy szeretné-e menteni a bejelentkezési adatait, hogy legközelebb könnyebb legyen a belépés, vagy teljesen törölje a böngészőből az adatait.</p>

![logout](https://user-images.githubusercontent.com/105912216/230723306-ff54222c-42e4-4033-8333-01e0e0c4a852.png)

<small><em>Kijelentkezés ábra</em></small>

<h3>Script</h3>
<p>Az autentikácós scriptek közül a kijelentkezés volt a legkönnyebb, ugyanis itt csak annyit kellett mengéznem, hogy a felhasználó szeretné-e menteni az adatait, vagy nem. Amennyiben nem, csak törlöm a session változóit, a sütiket és törlöm az egész munkamenetét.</p>
<p>Az adatok mentése funkció se volt sokkal bonyolultabb, mivel itt csak egy sütit kellett módosítanom, nem törölnöm, a kód többi része ugyanaz. Meg kellett nézni, hogy pontosan melyik azonosítóval rendelkező felhasználóról van szó, megkeresni a sütiben, hogy tényleg nincs-e ilyen, és ha nincs akkor csak hozzáfűzöm a süti végére, és folytatom a kijelentkeztetését.</p>

![logout-script](https://user-images.githubusercontent.com/105912216/230723318-db4e7f86-5109-4d15-b95c-a19449af2584.png)

<small><em>Kijelentkezési script ábra</em></small>
<p align="right">(<a href="#top">Vissza az elejére</a>)</p>

# Profil oldal

<p>A profil oldal elkészítése közben igen erősen el kellett gondolkodnom, hogy tényleg akarom-e én ezt a funkciót az oldalra. Sok értelmét nem láttam, mert ez nem egy közösségi oldal, hogy szerkesztgesse az ember a profilját, de úgy voltam vele, hogy akkor próbálok rendelés központú lenni, és olyan adatokat megjeleníteni itt, amelyek tényleg hasznosak a felhasználónak. Ez többé-kevésbé sikerült, de összességében nem bántam meg, hogy úgy döntöttem, hogy elkészítem a profil oldalt.</p>
<p>Annyit le szeretnék szögezni, hogy a profil oldal több oldalra van felosztva, és abbol néhány oldal csak demo, és nem működik. Ez több okból is így van. Van olyan oldal amelynek elkészítése több tudást vett volna igénybe és nem lett volna értelme az erőfeszítésnek ehhez a projekthez. Amennyiben viszont úgy döntök, hogy tovább szeretném fejleszteni ezt az oldalt, mert komoly terveim vannak vele, akkor mindenféleképpen tökéletesíteni fogom.</p>
<h2>Profil áttekintése</h2>
<p>Ezen az oldalon jelennek meg a felhasználó alap adatai, a rendelt termékei kategóriákra bontva, és a rendelései csoportosítva. Ezt az áttekintő oldalt a rendelésekre öszpontosítottam, ugyanis szerintem a leglényegesebb információ, hogy mire költötte az egyenlegét a felhasználó, és milyen szolgáltatást vagy terméket kapott érte.</p>

![info](https://user-images.githubusercontent.com/105912216/230730555-ea265c65-8ead-4733-ac88-4db3f8708851.png)

<small><em>Profil adatok ábra</em></small>
<p>A profil adatok részlegen jelennek meg a felhasználó alap adatai, és az e-mail címével kapcsolat információk, például, hogy aktiválva van-e az e-mail címe a felhasználóknak. Ezeket az értesítéseket ki tudja a felhasználó kapcsolni, ha zavarja őt, de 7 nap után az értesítés újra meg fog jelenni.</p>

![orders](https://user-images.githubusercontent.com/105912216/230730570-baa48314-9b4b-4218-aa51-bf2ad02e13c2.png)

<small><em>Rendelések ábra</em></small>
<p>Az áttekintés oldalon továbbá a felhasználó megtekintheti, hogy milyen kategóriákból rendelte a legtöbbet egy kördiagrammon. A diagramm mellett egy lista jelenik meg, ahol láthatja az összes eddigi rendeléseit, és azoknak a státuszát. Ezekre rákattintva megtekintheti a rendelés pontos adatait és minden információit.</p>

<h2>Személyes információk</h2>
<p>A személyes információk oldalon jelenik meg a felhasználó összes alap adata, ami szükséges lehet a rendelésekhez. Itt tudja szerkeszteni ezeket az adatokat.</p>

![edit](https://user-images.githubusercontent.com/105912216/230730577-32bb63a6-66a0-47aa-867f-c3d297628816.png)

<small><em>Személyes információk szerkeszése ábra</em></small>
<p>Az adatok szerkesztése után a szekció jobb fenti sarkában látható Mentés gombra kattintva tudja elkezdeni az adatok mentését. A script előszőr megnézi, hogy tényleg történt-e változtatás. Amennyiben nem történt akkor egy hibaüzenet jelenik meg, hogy nem történt változtatás.</p>
<p>Abban az esetben, ha mégis történt módosítás, egy panel fog megjelenni, ahol ki van listázva az összes módosított adat, hogy mire lesz módosítva. A Mentés gombra kattintva véglegesítheti a módosításokat, és amennyiben nem történt hiba a módosítás közben, egy üzenet fog megjelenni a módosítás sikerességéről.</p>

![save](https://user-images.githubusercontent.com/105912216/230730580-86af2518-965a-4577-8679-797c0a750de2.png)

<small><em>Adatok módosítása ábra</em></small>

<h2>Fiók információk</h2>
<p>A fiók információk oldalon olyan adatok szerepelnek, amelyek nem lényegesek a rendelés lebonyolításához, csak olyan adatokat lehet itt módosítani, amelyekkel még a projekt elején volt tervem, de út közben nem lettek felhasználva, így csak itt maradtak, és nincs semmilyen hasznuk. Kisebb-nagyobb próbálkozások voltak a nyelv módosítása lehetőséggel, de rájöttem, hogy annyira kevés külföldi megrendelő lesz, ha lesznek, hogy nem érte volna meg ezzel foglalkozni, hogy lefordítsam az oldalt több nyelvre is. Így a nyelvi és az időzóna beállítás csak úgy benne maradt a kódban, ha bár semmi hasznuk nincsen.</p>

![account](https://user-images.githubusercontent.com/105912216/230730591-1695613b-53db-4349-b1b4-fa877015d62f.png)

<small><em>Fiók adatainak módosítása ábra</em></small>
<p>A módosítás ugyanúgy működik, mint a személyes információk módosításánal. Megnézi, hogy történt-e módosítás, és ha igen akkor átírja az adatbázisban az adatokat.</p>

<h2>Biztonság</h2>
<p>A biztonság oldalon lehet majd bekapcsolni a két lépcsős hitelesítést, bár ez a funkció még nem működik.</p>
<p>Ennek az oldalnak az igazi lényege, hogy itt lehet megtekinteni a bejelentkezési előzményeket. Itt jelennek meg azok a próbálkozások amikor valaki próbált belépni a fiókunkba és vagy sikerült neki, vagy nem.</p>

![security](https://user-images.githubusercontent.com/105912216/230730599-d3006a98-755e-43ec-8b20-fd140c2774ee.png)

<small><em>Biztonság oldal ábra</em></small>

<h2>Jelszó kezelése</h2>
<p>A jelszó kezelése oldalon tudjuk megváltoztatni a jelszavunkat, és tudjuk megtekinteni a jelszó változtatási előzményeket. A jelszó módosításánál meg jelenik egy értesítés, ha a jelszavunk elavult. A jelszó akkor számít elavultnak, ha a felhasználó nem módosította a jelszavált már több, mint egy hónapja. Ez az értesítés azért kell, hogy kiküszöböljük azt a lehetőséget, hogy a felhasználó elfelejtse a jelszavát, vagy más megszerezhesse azt.</p>

![password](https://user-images.githubusercontent.com/105912216/230730605-bdf61dc3-3b18-457b-8a3b-9396d97496bb.png)

<small><em>Jelszó módosítása ábra</em></small>

<h2>Email beállítások</h2>
<p>Ez az az oldal, amelyik csak demó a profil oldalon, a beállítások nem működnek, ugyanis az e-mail rendszert a projekt legvégén szerettem volna megcsinálni, de idő hiánya miatt ez nem valósult meg. Terveim vannak, hogy miket szeretnék csinálni, és hogyan használnám ki az e-mail lehetőségeit, de ezt már csak akkor fogom megvalósítani, ha eladásra szánom az oldalt.</p>

![email](https://user-images.githubusercontent.com/105912216/230730608-3a58b903-8289-4f3b-a12b-cee58f2547f4.png)

<small><em>Email beállítások ábra</em></small>

<h2>Mentett kártyák</h2>
<p>A mentett kártyák oldalán tudjuk kezelni a feliratkozásainkat, és kezelhetjük a jelenlegi kártyáinkat.</p>

![cards_overview](https://user-images.githubusercontent.com/105912216/230730613-ce6b3227-c2f2-49fa-b7f8-f6e819199770.png)

<small><em>Mentett kártyák kezelése: Feliratkozások ábra</em></small>
<p>A feliratkozás rendszert csak azért tettem bele, hogy kicsit több funkcióval rendelkezzen az oldal, de ez a funkció azonnal deaktiválásra fog kerülni, amint eladásra kerülne az oldal, ugyanis ennek csak lokálisan lenne értelme. A feliratkozás rendszer arról szól, hogy alapból, amikor regisztrál egy felhasználó, generálódik hozzá egy dedikált virtuális kártya, amivel tud tranzakciókat bonyolítani az oldalon.</p>
<p>Az ingyenes, alap verzióval a felhasználó egyszerre 4 kártyát használhat, és ha töröl egy kártyát, a kártya helye ugyanúgy le lesz foglalva, mintha lenne kártyája a felhasználónak, hiába törölte. Ez a funkció azért van, hogy ne törölje ki a kártyáját a felhasználó, ha lefogyott róla az egyenleg, és generáljon egy újat helyette.</p>
<p>A törzsvásárló és a vállalati előfizetássel már nem fogja foglalni a helyet a törölt kártya, és több kártyát használhat egyszerre a felhasználó, de a feliratkozásnak van havi díja, amit egy MYSQL event figyel, minden este éjfélkor ellenőrzi, hogy mikor járt le a feliratkozó 1 hónapja, és amennyiben lejárt, levonja a szolgáltatás díját.</p>
<p>Annyi engedményt kapnak a felhasználók, ha előfizetnek egy szolgáltatásra, például vállalati, és lemondja egy héten belül, a következő előfizetésnél nem a teljes árat kell kifizetnie.</p>
<p>A következő funkció a kártyák áttekintése. A felhasználó itt láthatja, hogy milyen kártyái vannak, és a hozzá tartozó adatokat.</p>

![cards_info](https://user-images.githubusercontent.com/105912216/230730620-d78ebefd-7bc6-440a-8478-82983c723941.png)

<small><em>Mentett kártyák: Kártya információ ábra</em></small>
<p>Itt tud a felhasználó hozzá adni kártyát, kitörölni az eddigieket, vagy beállítani az elsődleges kártyát. A jobb fenti „Hozzáadás” gombra kattintva fog megjelenni egy panel, ahol a felhasználó létre hozhat magának egy új kártyát, és ki tudja cálasztani a kártya típusát. A kártya alap egyenlege az előfizetéstől függ. Amennyiben a felhasználónak nincsen előfizetése, 30 ezer forint lesz alapból a kártyáján.</p>

![cards_add](https://user-images.githubusercontent.com/105912216/230730626-756d671a-31e2-4de5-a9bd-5609b6caaa28.png)

<small><em>Metnett kártyák: Kártya hozzáadása ábra</em></small>

<p>A kártya szerkeszése funkciónál egy ugyanolyan panel fog megjelenni, mint a kártya létrehozása funkciónál, csak itt már előre ki lesznek töltve az adatok. A kártya módosításával a kártyán megtalálható egyenleg nem fog módosulni, viszont a kártya lejárati dátumát barmikor módosíthatja a felhasználó, így ha lejárt, és van még rajta összeg, akkor csak átírja a lejárati dátumot és tud vele újra fizetni. (Ezért is lesz kivéve ez a kártyás funkció)</p>

![cards_delete](https://user-images.githubusercontent.com/105912216/230730630-f7142870-f2ef-4bf6-9aae-84c4e75ed4f7.png)

<small><em>Mentett kártyák: Kártya törlése ábra</em></small>
<p>A kártya törlésénél egy panel fog megjelenni, ami kérni fogja a felhasználó jelszavát, amit ha helyesen ad meg, akkor a kártyája törtlődni fog.</p>

<h2>Felfüggesztés</h2>
<p>Ezen az oldalon a felhasználó el tudja dönteni, hogy fel szeretné-e függeszteni a profilját, vagy véglegesen törölni szeretné-e azt.</p>

![deactive](https://user-images.githubusercontent.com/105912216/230730640-ba244ea0-ff0f-471b-b512-cb5e318934cb.png)

<small><em>Felfüggesztés ábra</em></small>
<p>A felasználó választhat, hogy fel szeretné-e függeszteni a profilját, vagy teljesen törölni szeretné-e a fiókot. Mind a kettőnek megvan az előnye és hátránya, de a fiók felfüggesztését ajánlom a felhasználóknak a törlés helyett. Ahogy az az ábrán is látszik egyik művelet sem történik meg egyből, mind a kettőnek van futási ideje. Deaktiválást követően, amint a felhasználó újra belép a fiókjába, többet nem lesz a felfüggesztett státusz a fiókján. Viszont ha a törlés opciót választotta a felhasználó, a kijelentkezetése után egy 30 napos futamidő fog elindulni, így ha a felhasználó nem lép be a fiókjába 30 napon belül, akkor a fiókját és a hozzá tartozó minden adat el lesz távolítva az oldalról és nem lesz lehetőség visszaállításra. Abban az esetben, ha a felhasználó belép a 30 napos időszakban, a számláló megáll, és kikerül a törlési folyamatból.</p>

<p align="right">(<a href="#top">Vissza az elejére</a>)</p>

# Termékek

<p>A termék szekció az egyik legfontosabb elem az oldalon, ugyanis itt jelennek meg a termék adatai, itt tudja a felhasználó a kosarához adni a terméket, vagy megvásárolni azt. A termék oldal felépítése közben próbáltam a letisztultságra törekedni, de közben a lehető legtöbb információt szerettem volna közölni a vásárlóval. A termék oldal felépítése 4 elemből áll. A fő elem a bal oldalon megjelenő mező, ahol a termék képe látható, az árazásával és az akció gombokkal, amik segítségével hozzá tudja adni a kosarához a terméket, vagy a mentett elemekhez adni, vagy megvásárolni az adott terméket.</p>
<p>A fő szekció mellett jelenik meg az „Általános” oldal, a „Vélemények” oldal, és legvégül a „Hasonló termékek” oldal. Az általános és a vélemények oldalnak azonos a felépítése.</p>
<p>Egy fejléc szekciót tartalmaznak, ahol a termék neve látható, alatta az értékelései összegzése, és a termék kategóriáját megjelenítő címkék.</p>
<h2>Bestseller funkció</h2>
<p>Egy viszonylag új funkcióval bővítettem a fejlécet, ami pedig a „Bestseller” jelzés. Ez a jelzés akkor jelenik meg, ha az adott termék kategóriáján belül ez az a termék, amelyet a legtöbben vették meg.
Ezt egy algoritmus nézi meg, ami sajnos elég bonyolultra sikeredett a vásárlásokat tartalmazó adatbázis felépítése miatt.</p>

![bestseller](https://user-images.githubusercontent.com/105912216/230741253-b813d854-21a0-4524-8e55-74f7e68d966b.png)

<small><em>Bestseller algoritmus részlet ábrája</em></small>

<p>Az algoritmus megnézi, hogy az adott terméknek mi a ketegóriája, majd kiszedi az összes rendel termék azonosítóját, és megnézi, hogy az azonosítóhoz milyen ketegória tartozik. Ha a ketegória egyezik a keresettel, akkor egy számlálóhoz hozzáadja a termékhez tartozó rendelt mennyiséget, és ezekből az adatokból egy statisztikát készít. A statisztikát sorba rendezi és megnézi, hogy melyik termékből rendelték a legtöbbet, és ha megegyezik a keresett termék azonosítójával, akkor az a termék a bestseller.</p>

<h2>Összehasonlítás hasonló termékekkel</h2>
<p>Az oldal alján jelenik meg egy olyan szekció, ahol egy táblázatban láthatjuk, hogy az adott termékhez melyik más termékek hasonlítanak a legjobban, és ezeket össze lehet hasonlítani különböző szempontok alapján.</p>

![compare](https://user-images.githubusercontent.com/105912216/230741259-3f3d7529-4edc-4507-ac3c-f8b425fd31c5.png)

<small><em>Termék összehasonlítása szekció ábra</em></small

<h2>Értékelés szekció</h2>
<p>A termékekhez a bejelentkezett felhasználók tudnak értékeléseket írni, amelyek megjelennek az oldalon. Az értékelési rendszer több szempont alapján is működik. Lehet értékelést írni, ahol csak a csillagos rendszert hasznlája a felhasználó, és van olyan, amikor a véleményét is kifejtheti a termék alatt.</p>

![review_preview](https://user-images.githubusercontent.com/105912216/230741272-41d7cf82-de66-4886-b5a7-616c5300c539.png)

<small><em>Értékelések ábra</em></small>

<p>Egy új funkció, hogy az értékelés mellett megjelenik egy szöveg: “Hitelesített vásárló”, ami akkor fog megjelenni, ha az értékelés szerzője valóban megvette a szóbanforgó terméket.</p>
<p>Egy olyan algoritmust tervezek bevezetni, amelyik úgy számolja ki a termék értékeléséinek átlagát, hogy figyelembe veszi, hogy az értékelés írója valóban megvette-e a terméket. Amennyiben megvette a terméket, az értékelése nagyobb súlyzással fog beleszámítani a százalékszámításban. A jelenlegi rendszer szerint, ugyanakkora súlyzással bír a hitelesített vásárló vélemény, mint annak az értékelővel, aki nem vette meg a terméket.</p>

<h3>Értékelés írása</h3>
<p>Az értékelés írása funkció csak a bejelentkezett felhasználók számára elérhető. Az értékelés a megszokott csillagos rendszer alapján működik, és lehetősége van az értékelőnek kifejteni a véleményét is.</p>
<p>További funkció, hogy a felhasználó élhet a joggal, hogy szeretné-e hogy az értékelése mellett fel legyen-e tüntetve a neve, vagy ne. Amennyiben nem szeretne élni a lehetőséggel, a többi felhasználó annyit fog látni, hogy egy privát felhasználó értékelte a terméket.</p>

![review_write](https://user-images.githubusercontent.com/105912216/230741279-c5abacf2-bcea-4132-a732-7d7a7c36c9b4.png)

<small><em>Értékelés írása ábra</em></small>

<p>További lehetőség az értékeléssel kapcsolatban, hogy az értékelés írója bármikor szerkesztheti az értékelését, és módosíthatja annak minden elemét. Bele értve a csillagok számát, a véleményét, vagy akár a nevének feltüntetését is módosíthatja.</p>

<h3>További funkciók</h3>
<p>Egy másik funkció, hogy az értékeléseket is lehet értékelni, hogy mennyire találták az emberek hasznosnak azt a véleményt a termékkel kapcsolatban. Erre a „Hasznos” gomb szolgál az értékelések alatt. Mindig a leghasznosabb értékelés fog megjelenni legfelül, és így van sorrendbe állítva, hasznosság szerint.</p>
<p>A felhasználók természetesen jelenthetik az értékeléseket, ha sértő tartalmat foglal magába, vagy nem oda illő elemeket tartalmaz, vagy akár szándékosan próbálja lehúzni a termék értékelését. Az értékelések jelentését nem lehet visszavonni, és a visszajelzés jelentése funkcióval visszaélőket is jelzi a rendszer, így a helytelen használat szankciókat vonhat maga után. A jelentett értékeléseket látják az illetékesek az admin panelben és elbírálhatják, hogy valóban sértő-e a tartalma. Ezeket a véleményeket törölni tudják, és fel is tudják függeszteni a felhasználót, vagy megvonhatják a jogát a további értékelések írásától.</p>

<h2>Hasonló termékek szekciója</h2>
<p>Ebben a szekcióban fognak megjelenni az adott termékhez hasonló termékek, akár márka, szín, méret, vagy más feltételek alapján.</p>
<p>Ez a funkció még sajnos csak demó módban van, ugyanis az adatbázisban nem szerepel elegendő termék, hogy teljeskörő összehasonlítási algoritmust tudjak írni, így ez az oldal jelenleg üres.</p>
<p align="right">(<a href="#top">Vissza az elejére</a>)</p>
	
#Webáruház

<p>A webáruház oldal arra szolgál, hogy megjelenítse az összes terméket, ami elérhető az oldalon, kategóriákra bontva. Az oldal tetején szerepel egy banner, ahova különböző leárazással, promóciókkal kapcsolatos képeket lehet majd felvenni, de ez még nincs bevezetve, így csak egy előre megírt elemeket tartalmaz.</p>
<p>A banner szekció alatt egy hasonló elem található mint a főoldalon. Egy olyan csík helyezkedik el, ami megjeleníti a népszerű kategóriákat képpel ellátva. Ezekre a képekre kattintva szűrhet rá a keresett kategóriákra a termékek közül.</p>
<p>Ezek alatt helyezkedik el egy olyan elem, ami már nem található meg a főoldalon. A leárazott termékek listája. Itt azok a termékek jelennek meg amelyek ára jelenleg le van árazva, így könnyebben észrevehetik a vásárlók azokat.</p>
<p>Ez a szekció alatt található meg egy olyan elem, amelyik működik is, meg nem is. Ez az elem a hírlevél funkció. A bejelentkezett felhasználók megadhatják, hogy milyen e-mail címmel szeretnének feliratkozni a hírlevélre. A hírlevélre való feliratkozással jogosultak lesznek egy egyszeri alkalommal használható 2000 Ft értékű ledvezményre. Ha a felhasználó feliratkozik a hírlevélre, de még nem használta fel a kupont és leiratkozik, a kuponja elveszik és nem használhatja többet, ha újból feliratkozik, illetva az az e-mail cím amivel leiratkozott, többet nem lesz jogosult a promóció igénybevételére, akármelyik felhasználó szeretné használni.</p>
<p>A fel és le iratkozás funkció működik, csak a promóciót nem építettem még bele a vásárlás folyamatába, így a felhsználó hiába van feliratkozva, nem fogja levonni a rendszer azt a 2000 forintot.</p>

![newsletter](https://user-images.githubusercontent.com/105912216/230741292-54e7d08f-4055-4a72-8155-2bace73c31c8.png)

<small><em>Hírlevél promóció ábra</em></small>
<p align="right">(<a href="#top">Vissza az elejére</a>)</p>
	
#Keresés funkció

<p>Az fejlécében elhelyezett keresés gomb, amelyet már fentebb bemutattam a Fejléc kialakítás részben sajnos nem kapta meg az elegendő törődésemet, mint amit megérdemelne, ugyanis ez a funkció az egyik legfontosabb eleme a webáruháznak, hogy a felhasználók szűrni tudják a termékeinket.</p>
<p>A gond az, hogy a keresési algoritmus nem teljes, és néhány feltételt figyelmen kívűl hagy, vagy éppenséggel olyan terméket jelenít meg, aminek semmi köze nincs a keresett termékhez.</p>

<h2>Navigációs sáv</h2>
<p>A keresés oldal két részre van bontva. Bal oldalon helyezkedik el a navigációs sáv, ahol további szűrőket lehet alkalmazni a keresett kifejezésre. Lehet termékekre, értékelésekre, valamint ár tartományra szűrni. További szűrési lehetőség, hogy a visszatérítést és az utólagos rendelést is lehet szűrni.</p>
<p>Annyi újdonságot szeretnék még hozzá adni a navigációs sávhoz, hogy jelenjenek meg feltételek a termék variációból is, hogy azokra is lehessen szűrni.</p>

<h2>Találatok listája</h2>
<p>Az oldal többi részén a talált elemek listája jelenik meg, ahol a keresett kifejezésre, az algoritmus által megfelelőnek gondolt termékek fognak megjelenni, amikből a felhasználó választhat.</p>

![search_result](https://user-images.githubusercontent.com/105912216/230741300-87ccbce1-fd78-44f4-80d1-8a3ad246524a.png)

<small><em>Keresési találatok ábra</em></small>
<p align="right">(<a href="#top">Vissza az elejére</a>)</p>
