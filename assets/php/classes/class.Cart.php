<?php require_once($_SERVER['DOCUMENT_ROOT'].'/includes/inc.php');

Class Cart {

    public $returnObject;

    function addToCart ($object) {

        /*
            $object kulcsain vegigmenni, es megnezni, hogy
            minden olyan kulcs - ertek paros szerepel-e, ami
            kell a folytatashoz
        */

        $requiredItems = array ('uid', 'pid', 'ip');
        $objectKeys = array_keys((array)$object);
        if ($requiredItems !== $objectKeys) {
            $this->returnObject = [
                "status" => "error",
                "message" => "Nincs elegendő adat a folytatáshoz"
            ];
            return $this->returnObject;
        }

        $DATABASE_HOST = 'localhost';$DATABASE_USER = 'root';$DATABASE_PASS = 'eKi=0630OG';$DATABASE_NAME = 'mappapapir';$con = mysqli_connect($DATABASE_HOST, $DATABASE_USER, $DATABASE_PASS, $DATABASE_NAME); if (mysqli_connect_errno()) { die ("0"); }
        if (isset($_POST['uid'])) { $uid = $_POST['uid']; }
        else {
            $this->returnObject = [
                "status" => "error",
                "message" => "Ehhez a tevékenységhez be kell jelentkeznie."
            ]; return $this->returnObject;
        }
        if ($stmt = $con->prepare('SELECT pid FROM cart WHERE uid = ? AND pid = ?')) {
            $stmt->bind_param('ii', $uid, $_POST['pid']); $stmt->execute(); $stmt->store_result();
            if ($stmt->num_rows > 0) {
                $this->returnObject = [
                    "status" => "error",
                    "message" => "Ezt a terméket már a kosarához adta."
                ]; return $this->returnObject;
            } 
            else {
                if ($istmt = $con->prepare('INSERT INTO cart (uid, pid, quantity) VALUES (?, ?, 1)')) {
                    $istmt->bind_param('ii', $uid, $_POST['pid']); $istmt->execute(); $istmt->close(); $pid = $_POST['pid'];
                    $log_categ = "Felhasználó szerkesztése"; $log_desc = "#".$uid." felhasználó kosarába új terméket vett fel:  #".$pid;
                    if ($log = $con->prepare('INSERT INTO log (uid, ip, category, description) VALUES(?,?,?,?)')) {
                        $log->bind_param('isss', $_SESSION['id'], $_POST['ip'], $log_categ, $log_desc); $log->execute(); $log->close(); 
                        $this->returnObject = [
                            "status" => "success"
                        ]; return $this->returnObject;
                        die('0');
                    } else {
                        $this->returnObject = [
                            "status" => "error",
                            "message" => "Hiba történt a naplózás közben."
                        ]; return $this->returnObject;
                    }
                } else {
                    $this->returnObject = [
                        "status" => "error",
                        "message" => "Hiba történt a feldolgozás közben."
                    ]; return $this->returnObject;
                }
            } $stmt->close();
        } else {
            $this->returnObject = [
                "status" => "error",
                "message" => "Hiba történt a feldolgozás közben."
            ]; return $this->returnObject;
        } $con->close();

    }

    function deleteFromCart ($object) {

    }

    function updateCart ($object) {
        
    }

    function emptyCart ($object) {

    }

    function countProducts ($object) {

    }

    function productInfo ($object) {

    }

    function showProductsNotInCart ($object) {

    }

    function getResults () {
        return $this->returnObject;
    }

}

$cartAction = new Cart();
$returnObject = new stdClass();

// if (isset($_POST['uid']) && isset($_POST['action'])) {
//     switch ($_POST['action']) {
//         case 'set' :
//             $themeAction->setTheme($_POST['theme'], $_POST['uid']);
//             die(json_encode($themeAction->getResults()));
//         break;
//         case 'get' :
//             $themeAction->getTheme($_POST['uid']);
//             die(json_encode($themeAction->getResults()));
//         break;
//     }
// } else {
//     $returnObject->status = "error"; $returnObject->message = "Hiányzó adatok.";
//     die(json_encode($returnObject));
// }