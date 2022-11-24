<?php session_start(); $DATABASE_HOST = 'localhost';$DATABASE_USER = 'root';$DATABASE_PASS = 'eKi=0630OG';$DATABASE_NAME = 'mappapapir'; $con = mysqli_connect($DATABASE_HOST, $DATABASE_USER, $DATABASE_PASS, $DATABASE_NAME); if (mysqli_connect_errno()) { die ("Sikertelen csatlakozás az adatbázishoz. Kérjük próbálja meg később."); } if (isset($_SESSION['id'])) {$uid = $_SESSION['id'];} else {die('Csak bejelentkezett felhasználóink vehetik igénybe ezt a funkciót.');}
if (isset($_POST['privacy'])) { $priv = $_POST['privacy']; } else { $priv = 0; }
if ($stmt = $con->prepare('SELECT id FROM reviews WHERE uid = ? AND pid = ?')) {
    $stmt->bind_param('ii', $_SESSION['id'], $_POST['pid']);
    $stmt->execute(); $stmt->store_result();
    if ($stmt->num_rows > 0) { die ('Ön már egyszer véleményét adta ehhez a termékhez.'); }
    else {
        if ($stmt = $con->prepare('INSERT INTO reviews (uid, pid, description, stars, privacy) VALUES(?, ?, ?, ?, ?)')) {
            $stmt->bind_param('iisii', $_SESSION['id'], $_POST['pid'], $_POST['description'], $_POST['stars'], $priv); $stmt->execute(); $spid = $_POST['pid'];
            $gmsql = "SELECT model FROM products__variations WHERE pid = $spid"; $gmres = $con->query($gmsql); $gmdt = $gmres->fetch_assoc(); $gmodel = $gmdt['model'];
            $gpsql = "SELECT pid FROM products__variations WHERE model LIKE '$gmodel'"; $gpres = $con->query($gpsql);
            while ($gpdt = $gpres->fetch_assoc()) { $gpid = $gpdt['pid'];
                $sasql = "UPDATE products__search SET savg = 
                    (SELECT 
                        ROUND(
                            ( (5 * (SELECT COUNT(stars) FROM reviews WHERE pid = $spid AND stars = 5)) + (4 * (SELECT COUNT(stars) FROM reviews WHERE pid = $spid AND stars = 4)) + (3 * (SELECT COUNT(stars) FROM reviews WHERE pid = $spid AND stars = 3)) + (2 * (SELECT COUNT(stars) FROM reviews WHERE pid = $spid AND stars = 2)) + (1 * (SELECT COUNT(stars) FROM reviews WHERE pid = $spid AND stars = 1)) )
                            / 
                            ( (SELECT COUNT(stars) FROM reviews WHERE pid = $spid AND stars = 5) + (SELECT COUNT(stars) FROM reviews WHERE pid = $spid AND stars = 4) + (SELECT COUNT(stars) FROM reviews WHERE pid = $spid AND stars = 3) + (SELECT COUNT(stars) FROM reviews WHERE pid = $spid AND stars = 2) + (SELECT COUNT(stars) FROM reviews WHERE pid = $spid AND stars = 1) )
                        ) AS 'gavg' FROM reviews WHERE reviews.pid = $spid GROUP BY gavg
                    ) WHERE products__search.pid = $gpid
                "; $sasres = $con->query($sasql); $con->next_result();
            }
            die("200");
        } else { die ('Szerver oldali hiba történt. Kérjük próbálja meg később ezt a műveletet.'); }
        $stmt->close();
    }        
} else { die ('Szerver oldali hiba történt. Kérjük próbálja meg később ezt a műveletet.'); }
$stmt->close();
?>