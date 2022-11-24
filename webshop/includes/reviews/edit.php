<?php session_start(); $DATABASE_HOST = 'localhost';$DATABASE_USER = 'root';$DATABASE_PASS = 'eKi=0630OG';$DATABASE_NAME = 'mappapapir'; $con = mysqli_connect($DATABASE_HOST, $DATABASE_USER, $DATABASE_PASS, $DATABASE_NAME); if (mysqli_connect_errno()) { die ("Sikertelen csatlakozás az adatbázishoz. Kérjük próbálja meg később."); } if (isset($_SESSION['id'])) {$uid = $_SESSION['id'];} else {die("Csak bejelentkezett felhasználóink vehetik igénybe ezt a funkciót.");}
if ($stmt = $con->prepare('UPDATE reviews SET description = ?, stars = ?, privacy = ? WHERE uid = ? AND id = ?')) {
    $stmt->bind_param('siiii', $_POST['description'], $_POST['stars'], $_POST['privacy'], $_SESSION['id'], $_POST['rid']);
    $stmt->execute(); $rid = $_POST['rid'];
    $gcpsql = "SELECT pid FROM reviews WHERE id = $rid"; $gcpres = $con->query($gcpsql); $gcp = $gcpres->fetch_assoc(); $gcpid = $gcp['pid'];

    $gmsql = "SELECT model FROM products__variations WHERE pid = $gcpid"; $gmres = $con->query($gmsql); $gmdt = $gmres->fetch_assoc(); $gmodel = $gmdt['model'];
    $gpsql = "SELECT pid FROM products__variations WHERE model LIKE '$gmodel'"; $gpres = $con->query($gpsql);
    while ($gpdt = $gpres->fetch_assoc()) { $gpid = $gpdt['pid'];
        $sasql = "UPDATE products__search SET savg = 
            (SELECT 
                ROUND(
                    ( (5 * (SELECT COUNT(stars) FROM reviews WHERE pid = $gcpid AND stars = 5)) + (4 * (SELECT COUNT(stars) FROM reviews WHERE pid = $gcpid AND stars = 4)) + (3 * (SELECT COUNT(stars) FROM reviews WHERE pid = $gcpid AND stars = 3)) + (2 * (SELECT COUNT(stars) FROM reviews WHERE pid = $gcpid AND stars = 2)) + (1 * (SELECT COUNT(stars) FROM reviews WHERE pid = $gcpid AND stars = 1)) )
                    / 
                    ( (SELECT COUNT(stars) FROM reviews WHERE pid = $gcpid AND stars = 5) + (SELECT COUNT(stars) FROM reviews WHERE pid = $gcpid AND stars = 4) + (SELECT COUNT(stars) FROM reviews WHERE pid = $gcpid AND stars = 3) + (SELECT COUNT(stars) FROM reviews WHERE pid = $gcpid AND stars = 2) + (SELECT COUNT(stars) FROM reviews WHERE pid = $gcpid AND stars = 1) )
                ) AS 'gavg' FROM reviews WHERE reviews.pid = $gcpid GROUP BY gavg
            ) WHERE products__search.pid = $gpid
        "; $sasres = $con->query($sasql); $con->next_result();
    }
    
    die("200");
} else { die ('Szerver oldali hiba történt. Kérjük próbálja meg később ezt a műveletet.'); }
$stmt->close();
?>