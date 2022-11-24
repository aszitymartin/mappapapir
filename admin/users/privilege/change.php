<?php session_start(); $DATABASE_HOST = 'localhost';$DATABASE_USER = 'root';$DATABASE_PASS = 'eKi=0630OG';$DATABASE_NAME = 'mappapapir'; $con = mysqli_connect($DATABASE_HOST, $DATABASE_USER, $DATABASE_PASS, $DATABASE_NAME); if (mysqli_connect_errno()) { die ("0"); }
if (isset($_POST['uid'])) {$uid = $_POST['uid'];} else { die("Nem létező felhasználó"); }
$sql = "SELECT privilege FROM customers__priv WHERE uid = $uid";
$res = $con->query($sql); $dt = $res->fetch_assoc();
if ($res->num_rows > 0) { $gpriv = $dt['privilege'];
    if ($gpriv == $_POST['priv']) { die ("A felhasználó már rendelkezik ezekkel a jogosultságokkal"); }
    else { $priv = $_POST['priv'];
        if ($istmt = $con->prepare('UPDATE customers__priv SET privilege = ? WHERE uid = ?')) {
            $istmt->bind_param('ii', $priv, $uid); $istmt->execute(); $istmt->close();
                $log_categ = "Felhasználó szerkesztése"; $log_desc = "#".$uid." felhasználó jogainak megváltoztatása ($gpriv -> $priv)";
                if ($log = $con->prepare('INSERT INTO log (uid, ip, category, description) VALUES(?,?,?,?)')) {
                    $log->bind_param('isss', $_SESSION['id'], $_POST['ip'], $log_categ, $log_desc); $log->execute(); $log->close(); die('0');
                } else { die ("Hiba történt a logolás közben."); }
        } else { die ("Hiba történt a jogosultság módosítása közben"); }
    }
} else { die ('Hiba történt a feldolgozás közben'); }
?>