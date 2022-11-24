<?php session_start(); $DATABASE_HOST = 'localhost';$DATABASE_USER = 'root';$DATABASE_PASS = 'eKi=0630OG';$DATABASE_NAME = 'mappapapir'; $con = mysqli_connect($DATABASE_HOST, $DATABASE_USER, $DATABASE_PASS, $DATABASE_NAME); if (mysqli_connect_errno()) { die ("Sikertelen csatlakozás az adatbázishoz. Kérjük próbálja meg később."); } if (isset($_SESSION['id'])) {$uid = $_SESSION['id'];} else {die('Csak bejelentkezett felhasználóink vehetik igénybe ezt a funkciót.');}
if (isset($_POST['privacy'])) { $priv = $_POST['privacy']; } else { $priv = 0; }
if ($stmt = $con->prepare('SELECT id FROM rv__r WHERE uid = ? AND rid = ?')) {
    $stmt->bind_param('ii', $_SESSION['id'], $_POST['rid']);
    $stmt->execute(); $stmt->store_result();
    if ($stmt->num_rows > 0) { die ('Ön már bejelentette ezt az értékelést.'); }
    else {
        if ($stmt = $con->prepare('INSERT INTO rv__r (uid, rid) VALUES (?, ?)')) {
            $stmt->bind_param('ii', $_SESSION['id'], $_POST['rid']);
            $stmt->execute(); die("200");
        } else { die ('Szerver oldali hiba történt. Kérjük próbálja meg később ezt a műveletet.'); }
        $stmt->close();
    }
} else { die ('Szerver oldali hiba történt. Kérjük próbálja meg később ezt a műveletet.'); }
$stmt->close();
?>