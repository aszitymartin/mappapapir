<?php require_once($_SERVER['DOCUMENT_ROOT'].'/includes/inc.php');

// ini_set('display_errors', 1); ini_set('display_startup_errors', 1); error_reporting(E_ALL);

Class Authentication {

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

    function loginUser ($object) {

        $requiredItems = array ('ip', 'action', 'email', 'password', 'device', 'city', 'region', 'country');
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


        function getBrowser() {
            $u_agent = $_SERVER['HTTP_USER_AGENT']; $bname = 'Ismeretlen'; $platform = 'Ismeretlen'; $version= "";
            if (preg_match('/linux/i', $u_agent)) { $platform = 'Linux'; } elseif (preg_match('/macintosh|mac os x/i', $u_agent)) { $platform = 'Mac'; }
            elseif (preg_match('/windows|win32/i', $u_agent)) { $platform = 'Windows'; } if(preg_match('/MSIE/i',$u_agent) && !preg_match('/Opera/i',$u_agent)) { $bname = 'Internet Explorer'; $ub = "MSIE"; }
            elseif(preg_match('/Firefox/i',$u_agent)) { $bname = 'Firefox'; $ub = "Firefox"; } elseif(preg_match('/Chrome/i',$u_agent)) { $bname = 'Chrome'; $ub = "Chrome"; }
            elseif(preg_match('/Safari/i',$u_agent)) { $bname = 'Safari'; $ub = "Safari"; } elseif(preg_match('/Opera/i',$u_agent)) { $bname = 'Opera'; $ub = "Opera"; }
            elseif(preg_match('/Netscape/i',$u_agent)) { $bname = 'Netscape'; $ub = "Netscape"; } $known = array('Version', $ub, 'other'); $pattern = '#(?<browser>' . join('|', $known) . ')[/ ]+(?<version>[0-9.|a-zA-Z.]*)#';
            if (!preg_match_all($pattern, $u_agent, $matches)) {} $i = count($matches['browser']); if ($i != 1) { if (strripos($u_agent,"Version") < strripos($u_agent,$ub)) { $version= $matches['version'][0]; } else { $version= $matches['version'][1]; } }
            else { $version= $matches['version'][0]; } if ($version==null || $version=="") {$version="?";} return array( 'userAgent' => $u_agent, 'name' => $bname, 'version' => $version, 'platform' => $platform, 'pattern' => $pattern );
        }
        if ($stmt = $con->prepare('SELECT id, fullname, email, password, theme FROM customers WHERE email = ?')) {
            $stmt->bind_param('s', $object['email']); $stmt->execute(); $stmt->store_result();
            if ($stmt->num_rows > 0) { $stmt->bind_result($id, $fullname, $emailaddress, $password, $theme); $stmt->fetch();
                if (password_verify($object['password'], $password)) {                    
                    
                    $ua=getBrowser(); $agent = $ua['name']. ':' . $ua['version'] . ':'. $ua['platform']; $expiry = (time() + (86400 * 365));

                    $header = str_replace("=", "", base64_encode('JWTHS256')); $payload =  str_replace("=", "", base64_encode("scotch.io " . strtotime(date('Y-m-d', strtotime('+1 year'))) . " " . $object['email']));
                    $encodestring = $header . '.' . $payload; $token = hash_hmac('sha256', $encodestring, 'secret'); $exp = time() + (1 * 365 * 24* 60 * 60);
                    if ($stmt = $con->prepare('INSERT INTO customers__token (uid, token, agent, expiry) VALUES (?, ?, ?, ?)')) { $stmt->bind_param('issi', $id, $token, $agent, $expiry); $stmt->execute();
                        setcookie("__au__login", $token, time() + (1 * 365 * 24* 60 * 60), "/");
                    }

                    if ($stmt = $con->prepare('SELECT id FROM customers WHERE email = ?')) {
                        $stmt->bind_param('s', $object['email']); $stmt->execute(); $result = $stmt->get_result(); $arr = array();
                        if($result->num_rows > 0) { $data = $result->fetch_assoc(); $cuid = $data['id']."";
                            $ua=getBrowser(); $agent = $ua['name']; $platform = $ua['platform']; $status = 1;
                            if ($setp__email = $con->prepare('INSERT INTO login__attempts (uid, location, country, status, browser, device, sys, ip) VALUES (?, ?, ?, ?, ?, ?, ?, ?)')) {
                                $setp__email->bind_param('ississss', $cuid, $object['city'], $object['country'], $status, $agent, $object['device'], $platform, $object['ip']); $setp__email->execute(); 
                                if ($setp__email = $con->prepare('DELETE FROM customers__deactivated WHERE uid = ?')) {
                                    $setp__email->bind_param('i', $cuid); $setp__email->execute();
                                    if ($setp__email = $con->prepare('DELETE FROM customers__deleted WHERE uid = ?')) {
                                        $setp__email->bind_param('i', $cuid); $setp__email->execute(); $_SESSION['loggedin'] = TRUE; $_SESSION['id'] = $cuid;
                                        
                                        $this->returnObject = [
                                            "status" => "success",
                                            "email" => $object['email']
                                        ];
                                        return $this->returnObject;
                                    }
                                }
                            } $setp__email->close();
                        }
                    }
                } else {
                    if ($stmt = $con->prepare('SELECT id FROM customers WHERE email = ?')) {
                        $stmt->bind_param('s', $object['email']); $stmt->execute(); $result = $stmt->get_result(); $arr = array();
                        if($result->num_rows > 0) { $data = $result->fetch_assoc(); $cuid = $data['id']."";
                            $ua=getBrowser(); $agent = $ua['name']; $platform = $ua['platform']; $status = 0;
                            if ($setp__email = $con->prepare('INSERT INTO login__attempts (uid, location, country, status, browser, device, sys, ip) VALUES (?, ?, ?, ?, ?, ?, ?, ?)')) {
                                $setp__email->bind_param('ississss', $cuid, $object['city'], $object['country'], $status, $agent, $object['device'], $platform, $object['ip']); $setp__email->execute();
                                $this->returnObject = [
                                    "status" => "error",
                                    "message" => "Helytelen adatokat adott meg."
                                ];
                                return $this->returnObject;
                                $setp__email->close();
                            } else {
                                $this->returnObject = [
                                    "status" => "error",
                                    "message" => "Helytelen adatokat adott meg."
                                ];
                                return $this->returnObject;
                            }
                        } else {
                            $this->returnObject = [
                                "status" => "error",
                                "message" => "Helytelen adatokat adott meg."
                            ];
                            return $this->returnObject;
                        }
                    } else {
                        $this->returnObject = [
                            "status" => "error",
                            "message" => "Helytelen adatokat adott meg."
                        ];
                        return $this->returnObject;
                    }
                }
            } else {
                if ($stmt = $con->prepare('SELECT id FROM customers WHERE email = ?')) {
                    $stmt->bind_param('s', $object['email']); $stmt->execute(); $result = $stmt->get_result(); $arr = array();
                    if($result->num_rows > 0) { $data = $result->fetch_assoc(); $cuid = $data['id']."";
                        $ua=getBrowser(); $agent = $ua['name']; $platform = $ua['platform']; $status = 0;
                        if ($setp__email = $con->prepare('INSERT INTO login__attempts (uid, location, country, status, browser, device, sys, ip) VALUES (?, ?, ?, ?, ?, ?, ?, ?)')) {
                            $setp__email->bind_param('ississss', $cuid, $object['city'], $object['country'], $status, $agent, $object['device'], $platform, $object['ip']); $setp__email->execute();
                            $this->returnObject = [
                                "status" => "error",
                                "message" => "Helytelen adatokat adott meg."
                            ];
                            return $this->returnObject;
                            $setp__email->close();
                        } else {
                            $this->returnObject = [
                                "status" => "error",
                                "message" => "Helytelen adatokat adott meg."
                            ];
                            return $this->returnObject;
                        }
                    } else {
                        $this->returnObject = [
                            "status" => "error",
                            "message" => "Helytelen adatokat adott meg."
                        ];
                        return $this->returnObject;
                    }
                } else {
                    $this->returnObject = [
                        "status" => "error",
                        "message" => "Helytelen adatokat adott meg."
                    ];
                    return $this->returnObject;
                }
            }$stmt->close();
        }

    }

    function registerUser ($object) {

        $requiredItems = array ('ip', 'action', 'email', 'password', 'device', 'city', 'region', 'country');
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

        

    }

    function logOutUser ($object) {
        
        unset($_COOKIE['__au__login']); setcookie("__au__login", null, -1, '/');
        $_SESSION['loggedin'] = FALSE; unset($_SESSION['id']);
        session_start(); session_destroy();
        
        $this->returnObject = [ "status" => "success" ];
        return $this->returnObject;

    }

    function isLogged ($object) {
        
    }

    function getResults () {
        return $this->returnObject;
    }

}

$authAction = new Authentication();
$returnObject = new stdClass();

$postObject = json_decode($_POST['auth'], true);

if (isset($postObject['action'])) {
    switch ($postObject['action']) {
        case 'login':
            $authAction->loginUser($postObject);
            die(json_encode($authAction->getResults()));
        break;
        case 'register':
            $authAction->registerUser($postObject);
            die(json_encode($authAction->getResults()));
        break;
        case 'logout':
            $authAction->logOutUser($postObject);
            die(json_encode($authAction->getResults()));
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