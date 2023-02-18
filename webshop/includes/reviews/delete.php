<?php session_start(); include($_SERVER['DOCUMENT_ROOT'].'/includes/inc.connect.php'); if (mysqli_connect_errno()) { die ("Sikertelen csatlakozás az adatbázishoz. Kérjük próbálja meg később."); } if (isset($_SESSION['id'])) {$uid = $_SESSION['id'];} else {die('Csak bejelentkezett felhasználóink vehetik igénybe ezt a funkciót.');}
if (isset($_POST['privacy'])) { $priv = $_POST['privacy']; } else { $priv = 0; }
if ($stmt = $con->prepare('SELECT id FROM reviews WHERE uid = ? AND id = ?')) {
    $stmt->bind_param('ii', $_SESSION['id'], $_POST['rid']);
    $stmt->execute(); $stmt->store_result();
    if ($stmt->num_rows > 0) { $rid = $_POST['rid'];
        $gcpsql = "SELECT pid FROM reviews WHERE id = $rid"; $gcpres = $con->query($gcpsql); $gcp = $gcpres->fetch_assoc(); $gcpid = $gcp['pid'];
        if ($stmt = $con->prepare('DELETE FROM reviews WHERE uid = ? AND id = ?')) {
            $stmt->bind_param('ii', $_SESSION['id'], $_POST['rid']); $stmt->execute();

            $grsql = "SELECT pid FROM reviews WHERE id = $rid"; $grres = $con->query($grsql); 
            if ($grres->num_rows > 0) {
                $grdt = $grres->fetch_assoc(); $spid = $grdt['pid'];
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
            } else {
                $gmsql = "SELECT model FROM products__variations WHERE pid = $gcpid"; $gmres = $con->query($gmsql); $gmdt = $gmres->fetch_assoc(); $gmodel = $gmdt['model'];
                $gpsql = "SELECT pid FROM products__variations WHERE model LIKE '$gmodel'"; $gpres = $con->query($gpsql);
                while ($gpdt = $gpres->fetch_assoc()) { $gpid = $gpdt['pid'];
                    $sasql = "UPDATE products__search SET savg = 0 WHERE products__search.pid = $gpid"; $sasres = $con->query($sasql); $con->next_result();
                }
            }
            
            die("200");
        } else { die ('Szerver oldali hiba történt. Kérjük próbálja meg később ezt a műveletet.'); }
        $stmt->close();
    } else { die ('Ön még nem adta véleményét ehhez a termékhez.'); }        
} else { die ('Szerver oldali hiba történt. Kérjük próbálja meg később ezt a műveletet.'); }
$stmt->close();
?>