<?php session_start(); require_once($_SERVER['DOCUMENT_ROOT'].'/assets/alph.php');
    // if (isset($_SESSION['token'])) {unset($_SESSION['token']);unset($_SESSION['token_expiry']);}
    $DATABASE_HOST = 'localhost';$DATABASE_USER = 'root';$DATABASE_PASS = 'eKi=0630OG';$DATABASE_NAME = 'mappapapir';
    $con = mysqli_connect($DATABASE_HOST, $DATABASE_USER, $DATABASE_PASS, $DATABASE_NAME);
    if (mysqli_connect_errno()) {header ("Location: /500"); echo "<script>const now = new Date();const notifParams = {notifType : '1',notifIcon : '2',notifTheme : '2',notifTitle : 'Hiba',notifDesc : 'Szerver oldali hiba történt.',expiry : now.setSeconds(60)};localStorage.setItem('NP', JSON.stringify(notifParams));window.location.href= '../';</script>";}
    $stmt = $con->prepare('SELECT customers.id, customers.fullname, customers.email, customers.phone, customers.theme, customers__money.money, customers__ship.postal, customers__ship.settlement, customers__ship.address, customers__inv.company, customers__inv.settlement, customers__inv.address, customers__inv.postal, customers__inv.tax
    FROM customers INNER JOIN customers__money ON customers__money.uid = customers.id INNER JOIN customers__ship ON customers__ship.uid = customers.id INNER JOIN customers__inv ON customers__inv.uid = customers.id WHERE customers.id = ?');
    if (isset($_SESSION['loggedin'])) {$id = $_SESSION['id'];}
    $stmt->bind_param('i', $id);$stmt->execute();
    $stmt->bind_result($id, $fullname, $email, $phone, $theme, $money, $postal, $settlement, $address, $company, $inv_settlement, $inv_address, $inv_postal, $inv_tax); $stmt->fetch();$stmt->close();
?>