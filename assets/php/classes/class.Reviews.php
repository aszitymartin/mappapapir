<?php require_once($_SERVER['DOCUMENT_ROOT'].'/includes/inc.php');

Class Review {

    public $returnObject;

    private function connect () {
        $DATABASE_HOST = 'localhost';$DATABASE_USER = 'root';$DATABASE_PASS = 'eKi=0630OG';$DATABASE_NAME = 'mappapapir';
        $con = mysqli_connect($DATABASE_HOST, $DATABASE_USER, $DATABASE_PASS, $DATABASE_NAME);
        if ( mysqli_connect_errno() ) {
            $this->returnObject = [
                "status" => "error",
                "message" => "Nem sikerült kapcsolódni az adatbázishoz."
            ];
            return $this->returnObject;
        } else {
            $this->returnObject = [
                "status" => "success",
                "data" => $con
            ];
            return $this->returnObject;
        }
    }

    function postReview ($object) {

        $requiredItems = array ('ip', 'action', 'pid', 'description', 'stars', 'privacy');
        $objectKeys = array_keys((array)$object);
        if ($requiredItems !== $objectKeys) {
            $this->returnObject = [
                "status" => "error",
                "message" => "Nincs elegendő adat a folytatáshoz."
            ];
            return $this->returnObject;
        } else {
            for ($i = 0; $i < count($objectKeys); $i++) {
                if (strlen($object[$requiredItems[$i]]) < 1) {
                    $this->returnObject = [
                        "status" => "error",
                        "message" => "Nincs elegendő adat a folytatáshoz."
                    ];
                    return $this->returnObject;
                }
            }
        }

        if ($this->connect()['status'] == 'success') {
            $con = $this->connect()['data'];
        } else {
            $this->returnObject = [
                "status" => "error",
                "message" => "Nem sikerült kapcsolódni az adatbázishoz."
            ];
            return $this->returnObject;
        }

        if ($object['privacy'] == false) { $priv = 0; }
        else { $priv = $object['privacy']; }

        if ($stmt = $con->prepare('SELECT id FROM reviews WHERE uid = ? AND pid = ?')) {
            $stmt->bind_param('ii', $_SESSION['id'], $object['pid']);
            $stmt->execute(); $stmt->store_result();
            if ($stmt->num_rows > 0) {
                $this->returnObject = [
                    "status" => "error",
                    "message" => "Már értékelte ezt a terméket."
                ];
                return $this->returnObject;
            }
            else {
                if ($stmt = $con->prepare('INSERT INTO reviews (uid, pid, description, stars, privacy) VALUES(?, ?, ?, ?, ?)')) {
                    $stmt->bind_param('iisii', $_SESSION['id'], $object['pid'], $object['description'], $object['stars'], $priv); $stmt->execute(); $spid = $object['pid'];
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
                    $log_categ = "Értékelés írása"; $log_desc = "#".$_SESSION['id']." véleményt írt a következő termékről:  #".$object['pid'];
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
                    return $this->returnObject;
                } else {
                    $this->returnObject = [
                        "status" => "error",
                        "message" => "Nem sikerült kapcsolódni az adatbázishoz."
                    ];
                    return $this->returnObject;
                }
                $stmt->close();
            }        
        } else {
            $this->returnObject = [
                "status" => "error",
                "message" => "Nem sikerült kapcsolódni az adatbázishoz."
            ];
            return $this->returnObject;
        }
        $stmt->close();
        
    }

    function updateReview ($object) {

        $requiredItems = array ('ip', 'action', 'rid', 'stars', 'description', 'privacy');
        $objectKeys = array_keys((array)$object);
        if ($requiredItems !== $objectKeys) {
            $this->returnObject = [
                "status" => "error",
                "message" => "Nincs elegendő adat a folytatáshoz."
            ];
            return $this->returnObject;
        }

        if ($this->connect()['status'] == 'success') {
            $con = $this->connect()['data'];
        } else {
            $this->returnObject = [
                "status" => "error",
                "message" => "Nem sikerült kapcsolódni az adatbázishoz."
            ];
            return $this->returnObject;
        }

        if ($object['privacy'] == false) { $priv = 0; }
        else { $priv = $object['privacy']; }

        if ($stmt = $con->prepare('UPDATE reviews SET description = ?, stars = ?, privacy = ? WHERE uid = ? AND id = ?')) {
            $stmt->bind_param('siiii', $object['description'], $object['stars'], $priv, $_SESSION['id'], $object['rid']);
            $stmt->execute(); $rid = $object['rid'];
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
            
            $log_categ = "Értékelés szerkesztése"; $log_desc = "#".$_SESSION['id']." szerkesztette a véleményét:  #".$object['rid'];
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
            return $this->returnObject;
        } else {
            $this->returnObject = [
                "status" => "error",
                "message" => "Nem sikerült kapcsolódni az adatbázishoz."
            ];
            return $this->returnObject;
        }
        $stmt->close();

    }

    function deleteReview ($object) {

        $requiredItems = array ('ip', 'action', 'rid');
        $objectKeys = array_keys((array)$object);
        if ($requiredItems !== $objectKeys) {
            $this->returnObject = [
                "status" => "error",
                "message" => "Nincs elegendő adat a folytatáshoz."
            ];
            return $this->returnObject;
        } else {
            for ($i = 0; $i < count($objectKeys); $i++) {
                if (strlen($object[$requiredItems[$i]]) < 1) {
                    $this->returnObject = [
                        "status" => "error",
                        "message" => "Nincs elegendő adat a folytatáshoz."
                    ];
                    return $this->returnObject;
                }
            }
        }

        if ($this->connect()['status'] == 'success') {
            $con = $this->connect()['data'];
        } else {
            $this->returnObject = [
                "status" => "error",
                "message" => "Nem sikerült kapcsolódni az adatbázishoz."
            ];
            return $this->returnObject;
        }

        if ($object['privacy'] == false) { $priv = 0; }
        else { $priv = $object['privacy']; }

        if ($stmt = $con->prepare('SELECT id FROM reviews WHERE uid = ? AND id = ?')) {
            $stmt->bind_param('ii', $_SESSION['id'], $object['rid']);
            $stmt->execute(); $stmt->store_result();
            if ($stmt->num_rows > 0) { $rid = $object['rid'];
                $gcpsql = "SELECT pid FROM reviews WHERE id = $rid"; $gcpres = $con->query($gcpsql); $gcp = $gcpres->fetch_assoc(); $gcpid = $gcp['pid'];
                if ($stmt = $con->prepare('DELETE FROM reviews WHERE uid = ? AND id = ?')) {
                    $stmt->bind_param('ii', $_SESSION['id'], $object['rid']); $stmt->execute();
        
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
                    $log_categ = "Értékelés törlése"; $log_desc = "#".$_SESSION['id']." eltávolította a véleményét.";
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
                    return $this->returnObject;
                } else {
                    $this->returnObject = [
                        "status" => "error",
                        "message" => "Nem sikerült kapcsolódni az adatbázishoz."
                    ];
                    return $this->returnObject;
                }
                $stmt->close();
            } else {
                $this->returnObject = [
                    "status" => "error",
                    "message" => "Még nem írt véleményt ehhez a termékhez."
                ];
                return $this->returnObject;
            }
        } else {
            $this->returnObject = [
                "status" => "error",
                "message" => "Nem sikerült kapcsolódni az adatbázishoz."
            ];
            return $this->returnObject;
        }
        $stmt->close();

    }

    function flagReview ($object) {

        $requiredItems = array ('ip', 'action', 'rid');
        $objectKeys = array_keys((array)$object);
        if ($requiredItems !== $objectKeys) {
            $this->returnObject = [
                "status" => "error",
                "message" => "Nincs elegendő adat a folytatáshoz."
            ];
            return $this->returnObject;
        }

        if ($this->connect()['status'] == 'success') {
            $con = $this->connect()['data'];
        } else {
            $this->returnObject = [
                "status" => "error",
                "message" => "Nem sikerült kapcsolódni az adatbázishoz."
            ];
            return $this->returnObject;
        }

        $uid = $_SESSION['id'];
        $rid = $object['rid']; $sql = "SELECT id FROM reviews WHERE id = $rid"; $res = $con-> query($sql);
        if ($res-> num_rows > 0) {
            $act__sql = "SELECT rid FROM rv__u WHERE rid = $rid AND uid = $uid"; $act__res = $con-> query($act__sql);
            if ($act__res-> num_rows > 0) {
                if ($stmt = $con->prepare('DELETE FROM rv__u WHERE rid = ? AND uid = ?')) {
                    $stmt->bind_param('ii', $object['rid'], $uid); $stmt->execute();
                    $log_categ = "Értékelés tevékenység"; $log_desc = "#".$_SESSION['id']." nem találta hasznosnak következő véleményt: #".$object['rid'];
                    if ($log = $con->prepare('INSERT INTO log (uid, ip, category, description) VALUES(?,?,?,?)')) {
                        $log->bind_param('isss', $_SESSION['id'], $object['ip'], $log_categ, $log_desc); $log->execute(); $log->close(); 
                        $this->returnObject = [
                            "status" => "success",
                            "result" => "unflagged"
                        ];
                        return $this->returnObject;
                    } else {
                        $this->returnObject = [
                            "status" => "error",
                            "message" => "Hiba történt a naplózás közben."
                        ]; return $this->returnObject;
                    }
                    return $this->returnObject;
                } else {
                    $this->returnObject = [
                        "status" => "error",
                        "message" => "Hiba történt a folyamat közben."
                    ];
                    return $this->returnObject;
                }
            } else {
                if ($stmt = $con->prepare('INSERT INTO rv__u (rid, uid) VALUES (?, ?)')) {
                    $stmt->bind_param('ii', $object['rid'], $uid); $stmt->execute();
                    $log_categ = "Értékelés tevékenység"; $log_desc = "#".$_SESSION['id']." hasznosnak találta a következő véleményt: #".$object['rid'];
                    if ($log = $con->prepare('INSERT INTO log (uid, ip, category, description) VALUES(?,?,?,?)')) {
                        $log->bind_param('isss', $_SESSION['id'], $object['ip'], $log_categ, $log_desc); $log->execute(); $log->close(); 
                        $this->returnObject = [
                            "status" => "success",
                            "result" => "flagged"
                        ];
                        return $this->returnObject;
                    } else {
                        $this->returnObject = [
                            "status" => "error",
                            "message" => "Hiba történt a naplózás közben."
                        ]; return $this->returnObject;
                    }
                    return $this->returnObject;
                }
                else {
                    $this->returnObject = [
                        "status" => "error",
                        "message" => "Hiba történt a folyamat közben."
                    ];
                    return $this->returnObject;
                }
            }
        } else {
            $this->returnObject = [
                "status" => "error",
                "message" => "Hiba történt a folyamat közben."
            ];
            return $this->returnObject;
        }

    }

    function flagCountReview ($object) {

        $requiredItems = array ('ip', 'action', 'rid');
        $objectKeys = array_keys((array)$object);
        if ($requiredItems !== $objectKeys) {
            $this->returnObject = [
                "status" => "error",
                "message" => "Nincs elegendő adat a folytatáshoz."
            ];
            return $this->returnObject;
        }

        if ($this->connect()['status'] == 'success') {
            $con = $this->connect()['data'];
        } else {
            $this->returnObject = [
                "status" => "error",
                "message" => "Nem sikerült kapcsolódni az adatbázishoz."
            ];
            return $this->returnObject;
        }

        $rid = $object['rid'];
        $sql = "SELECT COUNT(id) AS 'amount' FROM rv__u WHERE rid = $rid";
        $res = $con-> query($sql);
        $am = $res-> fetch_assoc();
        $this->returnObject = [
            "status" => "success",
            "count" => $am['amount']
        ];
        return $this->returnObject;

    }

    function reportReview ($object) {
        
        $requiredItems = array ('ip', 'action', 'rid');
        $objectKeys = array_keys((array)$object);
        if ($requiredItems !== $objectKeys) {
            $this->returnObject = [
                "status" => "error",
                "message" => "Nincs elegendő adat a folytatáshoz."
            ];
            return $this->returnObject;
        }

        if ($this->connect()['status'] == 'success') {
            $con = $this->connect()['data'];
        } else {
            $this->returnObject = [
                "status" => "error",
                "message" => "Nem sikerült kapcsolódni az adatbázishoz."
            ];
            return $this->returnObject;
        }

        if ($stmt = $con->prepare('SELECT id FROM rv__r WHERE uid = ? AND rid = ?')) {
            $stmt->bind_param('ii', $_SESSION['id'], $object['rid']);
            $stmt->execute(); $stmt->store_result();
            if ($stmt->num_rows > 0) {
                $this->returnObject = [
                    "status" => "error",
                    "message" => "Ön már jelentette ezt az értékelést."
                ];
                return $this->returnObject;
            }
            else {
                if ($stmt = $con->prepare('INSERT INTO rv__r (uid, rid) VALUES (?, ?)')) {
                    $stmt->bind_param('ii', $_SESSION['id'], $object['rid']); $stmt->execute();
                    $log_categ = "Értékelés tevékenység"; $log_desc = "#".$_SESSION['id']." jelentette a következő véleményt: #".$object['rid'];
                    if ($log = $con->prepare('INSERT INTO log (uid, ip, category, description) VALUES(?,?,?,?)')) {
                        $log->bind_param('isss', $_SESSION['id'], $object['ip'], $log_categ, $log_desc); $log->execute(); $log->close(); 
                        $this->returnObject = [
                            "status" => "success"
                        ];
                        return $this->returnObject;
                    } else {
                        $this->returnObject = [
                            "status" => "error",
                            "message" => "Hiba történt a naplózás közben."
                        ]; return $this->returnObject;
                    }
                    return $this->returnObject;
                } else {
                    $this->returnObject = [
                        "status" => "error",
                        "message" => "Hiba történt a folyamat közben."
                    ];
                    return $this->returnObject;
                }
                $stmt->close();
            }
        } else {
            $this->returnObject = [
                "status" => "error",
                "message" => "Hiba történt a folyamat közben."
            ];
            return $this->returnObject;
        }
        $stmt->close();

    }

    function getResults () {
        return $this->returnObject;
    }

}

$reviewAction = new Review();
$returnObject = new stdClass();

$postObject = json_decode($_POST['review'], true);

if (isset($postObject['action'])) {
    switch ($postObject['action']) {
        case 'post':
            $reviewAction->postReview($postObject);
            die(json_encode($reviewAction->getResults()));
        break;
        case 'update':
            $reviewAction->updateReview($postObject);
            die(json_encode($reviewAction->getResults()));
        break;
        case 'delete':
            $reviewAction->deleteReview($postObject);
            die(json_encode($reviewAction->getResults()));
        break;
        case 'flag':
            $reviewAction->flagReview($postObject);
            die(json_encode($reviewAction->getResults()));
        break;
        case 'flagCount':
            $reviewAction->flagCountReview($postObject);
            die(json_encode($reviewAction->getResults()));
        break;
        case 'report':
            $reviewAction->reportReview($postObject);
            die(json_encode($reviewAction->getResults()));
        break;
        default:
            $returnObject->status = "error"; $returnObject->message = "Érvénytelen kérés.";
            die(json_encode($returnObject));
        break;
    }
} else {
    $returnObject->status = "error"; $returnObject->message = "Hiányzó adatok.";
    die(json_encode(($returnObject)));
}

?>