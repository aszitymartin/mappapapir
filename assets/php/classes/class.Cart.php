<?php require_once($_SERVER['DOCUMENT_ROOT'].'/includes/inc.php');

ini_set('display_errors', 1); ini_set('display_startup_errors', 1); error_reporting(E_ALL);

Class Cart {

    public $returnObject;

    function addToCart ($object) {

        $requiredItems = array ('uid', 'pid', 'ip', 'action');
        $objectKeys = array_keys((array)$object);
        if ($requiredItems !== $objectKeys) {
            $this->returnObject = [
                "status" => "error",
                "message" => "Nincs elegendő adat a folytatáshoz"
            ];
            return $this->returnObject;
        }

        $DATABASE_HOST = 'localhost';$DATABASE_USER = 'root';$DATABASE_PASS = 'eKi=0630OG';$DATABASE_NAME = 'mappapapir';$con = mysqli_connect($DATABASE_HOST, $DATABASE_USER, $DATABASE_PASS, $DATABASE_NAME); if (mysqli_connect_errno()) { die ("0"); }
        if (isset($object['uid'])) { $uid = $object['uid']; }
        else {
            $this->returnObject = [
                "status" => "error",
                "message" => "Ehhez a tevékenységhez be kell jelentkeznie."
            ]; return $this->returnObject;
        }
        if ($stmt = $con->prepare('SELECT pid FROM cart WHERE uid = ? AND pid = ?')) {
            $stmt->bind_param('ii', $uid, $object['pid']); $stmt->execute(); $stmt->store_result();
            if ($stmt->num_rows > 0) {
                $this->returnObject = [
                    "status" => "error",
                    "message" => "Ezt a terméket már a kosarához adta."
                ]; return $this->returnObject;
            } 
            else {
                if ($istmt = $con->prepare('INSERT INTO cart (uid, pid, quantity) VALUES (?, ?, 1)')) {
                    $istmt->bind_param('ii', $uid, $object['pid']); $istmt->execute(); $istmt->close(); $pid = $object['pid'];
                    $log_categ = "Felhasználó szerkesztése"; $log_desc = "#".$uid." felhasználó kosarába új terméket vett fel:  #".$pid;
                    if ($log = $con->prepare('INSERT INTO log (uid, ip, category, description) VALUES(?,?,?,?)')) {
                        $log->bind_param('isss', $_SESSION['id'], $object['ip'], $log_categ, $log_desc); $log->execute(); $log->close(); 
                        $this->returnObject = [
                            "status" => "success"
                        ]; return $this->returnObject;
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

        $requiredItems = array ('uid', 'pid', 'ip', 'action');
        $objectKeys = array_keys((array)$object);
        if ($requiredItems !== $objectKeys) {
            $this->returnObject = [
                "status" => "error",
                "message" => "Nincs elegendő adat a folytatáshoz"
            ];
            return $this->returnObject;
        }

        $DATABASE_HOST = 'localhost';$DATABASE_USER = 'root';$DATABASE_PASS = 'eKi=0630OG';$DATABASE_NAME = 'mappapapir';$con = mysqli_connect($DATABASE_HOST, $DATABASE_USER, $DATABASE_PASS, $DATABASE_NAME); if (mysqli_connect_errno()) { die ("0"); }
        if (isset($object['uid'])) { $uid = $object['uid']; }
        else {
            $this->returnObject = [
                "status" => "error",
                "message" => "Ehhez a tevékenységhez be kell jelentkeznie."
            ]; return $this->returnObject;
        }
        if ($stmt = $con->prepare('SELECT pid FROM cart WHERE uid = ? AND pid = ?')) {
            $stmt->bind_param('ii', $uid, $object['pid']); $stmt->execute(); $stmt->store_result();
            if ($stmt->num_rows < 1) {
                $this->returnObject = [
                    "status" => "error",
                    "message" => "Ez a termék nincs a kosarához adva."
                ]; return $this->returnObject;
            } 
            else {
                if ($istmt = $con->prepare('DELETE FROM cart WHERE uid = ? AND pid = ?')) {
                    $istmt->bind_param('ii', $uid, $object['pid']); $istmt->execute(); $istmt->close(); $pid = $object['pid'];
                    $log_categ = "Felhasználó szerkesztése"; $log_desc = "#".$uid." felhasználó kosarából terméket törölt:  #".$pid;
                    if ($log = $con->prepare('INSERT INTO log (uid, ip, category, description) VALUES(?,?,?,?)')) {
                        $log->bind_param('isss', $_SESSION['id'], $object['ip'], $log_categ, $log_desc); $log->execute(); $log->close(); 
                        $this->returnObject = [
                            "status" => "success"
                        ]; return $this->returnObject;
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

    function updateCart ($object) {
        $requiredItems = array ('uid', 'pid', 'ip', 'action', 'subaction');
        $objectKeys = array_keys((array)$object);
        if ($requiredItems !== $objectKeys) {
            $this->returnObject = [
                "status" => "error",
                "message" => "Nincs elegendő adat a folytatáshoz"
            ];
            return $this->returnObject;
        }

        $DATABASE_HOST = 'localhost';$DATABASE_USER = 'root';$DATABASE_PASS = 'eKi=0630OG';$DATABASE_NAME = 'mappapapir';$con = mysqli_connect($DATABASE_HOST, $DATABASE_USER, $DATABASE_PASS, $DATABASE_NAME); if (mysqli_connect_errno()) { die ("0"); }
        if (isset($object['uid'])) { $uid = $object['uid']; }
        else {
            $this->returnObject = [
                "status" => "error",
                "message" => "Ehhez a tevékenységhez be kell jelentkeznie."
            ]; return $this->returnObject;
        }

        switch ($object['subaction']) {
            case 'add' :
                if ($stmt = $con->prepare('SELECT quantity FROM cart WHERE uid = ? AND pid = ?')) {
                    $stmt->bind_param('ii', $uid, $object['pid']); $stmt->execute(); $stmt->store_result(); $stmt->bind_result($quantity); $stmt->fetch();
                    if ($stmt->num_rows > 0) { $updatedQuantity = $quantity + 1;
                        if ($stmt = $con->prepare('UPDATE cart SET quantity = ? WHERE pid = ? AND uid = ?')) {
                            $stmt->bind_param('iii', $updatedQuantity, $object['pid'], $uid); $stmt->execute();
                            $this->returnObject = [
                                "status" => "success",
                            ]; return $this->returnObject;
                        } else {
                            $this->returnObject = [
                                "status" => "error",
                                "message" => "Hiba lépett fel az adatbázisban feldolgozás közben."
                            ]; return $this->returnObject;
                        }
                    } else {
                        $this->returnObject = [
                            "status" => "error",
                            "message" => "Hiba lépett fel az adatbázisban feldolgozás közben."
                        ]; return $this->returnObject;
                    } $stmt->close();
                } else {
                    $this->returnObject = [
                        "status" => "error",
                        "message" => "Hiba lépett fel az adatbázisban feldolgozás közben."
                    ]; return $this->returnObject;
                } $con->close();
            break;
            case 'delete' :
                if ($stmt = $con->prepare('SELECT quantity FROM cart WHERE uid = ? AND pid = ?')) {
                    $stmt->bind_param('ii', $uid, $object['pid']); $stmt->execute(); $stmt->store_result(); $stmt->bind_result($quantity); $stmt->fetch();
                    if ($stmt->num_rows > 0) { $updatedQuantity = $quantity - 1;
                        if ($updatedQuantity > 0) {
                            if ($stmt = $con->prepare('UPDATE cart SET quantity = ? WHERE pid = ? AND uid = ?')) {
                                $stmt->bind_param('iii', $updatedQuantity, $object['pid'], $uid); $stmt->execute();
                                $this->returnObject = [
                                    "status" => "success"
                                ]; return $this->returnObject;
                            } else {
                                $this->returnObject = [
                                    "status" => "error",
                                    "message" => "Hiba lépett fel az adatbázisban feldolgozás közben."
                                ]; return $this->returnObject;
                            }
                        } else {
                            if ($istmt = $con->prepare('DELETE FROM cart WHERE uid = ? AND pid = ?')) {
                                $istmt->bind_param('ii', $uid, $object['pid']); $istmt->execute(); $istmt->close();
                                $this->returnObject = [
                                    "status" => "success",
                                    "message" => "Termék sikeresen eltávolítva a kosárból."
                                ]; return $this->returnObject;
                            } else {
                                $this->returnObject = [
                                    "status" => "error",
                                    "message" => "Hiba lépett fel az adatbázisban feldolgozás közben."
                                ]; return $this->returnObject;
                            }
                        }
                    } else {
                        $this->returnObject = [
                            "status" => "error",
                            "message" => "Ez a termék nincs hozzáadva a kosarához."
                        ]; return $this->returnObject;
                    } $stmt->close();
                } else {
                    $this->returnObject = [
                        "status" => "error",
                        "message" => "Hiba lépett fel az adatbázisban feldolgozás közben."
                    ]; return $this->returnObject;
                } $con->close();
            break;
            default :
                $this->returnObject = [
                    "status" => "error",
                    "message" => "Érvénytelen kérés."
                ];
                return $this->returnObject;
            break;
        }

    }

    function emptyCart ($object) {
        $requiredItems = array ('uid', 'pid', 'ip', 'action');
        $objectKeys = array_keys((array)$object);
        if ($requiredItems !== $objectKeys) {
            $this->returnObject = [
                "status" => "error",
                "message" => "Nincs elegendő adat a folytatáshoz"
            ];
            return $this->returnObject;
        }

        $DATABASE_HOST = 'localhost';$DATABASE_USER = 'root';$DATABASE_PASS = 'eKi=0630OG';$DATABASE_NAME = 'mappapapir';$con = mysqli_connect($DATABASE_HOST, $DATABASE_USER, $DATABASE_PASS, $DATABASE_NAME); if (mysqli_connect_errno()) { die ("0"); }
        if (isset($object['uid'])) { $uid = $object['uid']; }
        else {
            $this->returnObject = [
                "status" => "error",
                "message" => "Ehhez a tevékenységhez be kell jelentkeznie."
            ]; return $this->returnObject;
        }

        if ($stmt = $con->prepare('SELECT id FROM cart WHERE uid = ?')) {
            $stmt->bind_param('i', $uid); $stmt->execute(); $stmt->store_result();
            if ($stmt->num_rows > 0) {
                if ($stmt = $con->prepare('DELETE FROM cart WHERE uid = ?')) {
                    $stmt->bind_param('i', $uid); $stmt->execute(); $stmt->store_result();
                    $log_categ = "Felhasználó szerkesztése"; $log_desc = "#".$uid." felhasználó kosara ki lett ürítve.";
                    if ($log = $con->prepare('INSERT INTO log (uid, ip, category, description) VALUES(?,?,?,?)')) {
                        $log->bind_param('isss', $_SESSION['id'], $object['ip'], $log_categ, $log_desc); $log->execute(); $log->close(); 
                        $this->returnObject = [
                            "status" => "success"
                        ]; return $this->returnObject;
                    } else {
                        $this->returnObject = [
                            "status" => "error",
                            "message" => "Hiba történt a naplózás közben."
                        ]; return $this->returnObject;
                    }
                } else {
                    $this->returnObject = [
                        "status" => "error",
                        "message" => "Hiba lépett fel az adatbázisban feldolgozás közben."
                    ]; return $this->returnObject;        
                }
            } else {
                $this->returnObject = [
                    "status" => "error",
                    "message" => "Ez a kosár jelenleg üres."
                ]; return $this->returnObject;
            }
        } else {
            $this->returnObject = [
                "status" => "error",
                "message" => "Hiba lépett fel az adatbázisban feldolgozás közben."
            ]; return $this->returnObject;
        }        

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

$postObject = json_decode($_POST['cart'], true);

if (isset($postObject['uid']) && isset($postObject['action'])) {
    switch ($postObject['action']) {
        case 'add':
            $cartAction->addToCart($postObject);
            die(json_encode($cartAction->getResults()));
        break;
        case 'delete':
            $cartAction->deleteFromCart($postObject);
            die(json_encode($cartAction->getResults()));
        break;
        case 'update':
            $cartAction->updateCart($postObject);
            die(json_encode($cartAction->getResults()));
        break;
        case 'empty':
            $cartAction->emptyCart($postObject);
            die(json_encode($cartAction->getResults()));
        break;
        case 'count':
            $cartAction->countProducts($postObject);
            die(json_encode($cartAction->getResults()));
        break;
        case 'info':
            $cartAction->productInfo($postObject);
            die(json_encode($cartAction->getResults()));
        break;
        case 'showNotInCart':
            $cartAction->showProductsNotInCart($postObject);
            die(json_encode($cartAction->getResults()));
        break;
        default:
            $returnObject->status = "error"; $returnObject->message = "Érvénytelen kérés.";
            die(json_encode($returnObject));
        break;
    }
} else {
    $returnObject->status = "error"; $returnObject->message = "Hiányzó adatok.";
    die(json_encode($returnObject));
}