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
                                        
                                        if (isset($_COOKIE['__au__history'])) {
                                            $cookieArray = explode(";", $_COOKIE['__au__history']);
                                            for ($i = 0; $i < count($cookieArray); $i++) {
                                                if ($cuid == explode(':', $cookieArray[$i])[0]) {
                                                    unset($cookieArray[$i]); break;
                                                }
                                            }
                                            setcookie("__au__history", $cuid.':'.$object['ip'].':'.$agent.';'.implode(';', $cookieArray), time() + (1 * 365 * 24* 60 * 60), "/");
                                        } else {
                                            setcookie("__au__history", $cuid.':'.$object['ip'].':'.$agent, time() + (1 * 365 * 24* 60 * 60), "/");
                                        }

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

        $requiredItems = array (
            'ip',
            'action',
            'fullname',
            'email',
            'password',
            'passconf',
            'company',
            'settlement',
            'address',
            'postal',
            'tax',
            'sh__settl',
            'sh__addr',
            'sh__zip',
            'phone',
            'fax',
            'device',
            'city',
            'region',
            'country'
        );

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

        if ($stmt = $con->prepare('SELECT id, password FROM customers WHERE email = ?')) {
            $stmt->bind_param('s', $object['email']);$stmt->execute();$stmt->store_result(); 
            if ($stmt->num_rows > 0) { echo "<script>const now = new Date();const notifParams = {notifType : '0',notifIcon : '0',notifTheme : '0',notifTitle : 'Regisztráció',notifDesc : 'Ez az email cím már foglalt!',expiry : now.setSeconds(60)};localStorage.setItem('NP', JSON.stringify(notifParams));window.location.href= '../';</script>"; exit; }
            else { $password = password_hash($object['password'], PASSWORD_DEFAULT);
                if ($stmt = $con->prepare('INSERT INTO customers (fullname, email, password, phone, fax) VALUES (?,?,?,?,?)')) {
                    $stmt->bind_param('sssii', $object['fullname'], $object['email'], $password, $object['phone'], $object['fax']); $stmt->execute();
                    if ($ep__stmt = $con->prepare('SELECT * FROM customers WHERE email = ?')) { $ep__stmt->bind_param('s', $object['email']); $ep__stmt->execute(); $ep__res = $ep__stmt->get_result(); $epd = $ep__res->fetch_assoc(); $cuid = $epd['id']; }$ep__stmt->close();
                    if ($stmt = $con->prepare('INSERT INTO customers__inv (uid, company, settlement, address, postal, tax) VALUES (?,?,?,?,?,?)')) {
                        $stmt->bind_param('isssii', $cuid, $object['company'], $object['settlement'], $object['address'], $object['postal'], $object['tax']); $stmt->execute();
                        if ($stmt = $con->prepare('INSERT INTO customers__money (uid) VALUES (?)')) {
                            $stmt->bind_param('i', $cuid); $stmt->execute();
                            if ($stmt = $con->prepare('INSERT INTO customers__ship (uid, settlement, address, postal) VALUES (?,?,?,?)')) {
                                $stmt->bind_param('issi', $cuid, $object['sh__settl'], $object['sh__addr'], $object['sh__zip']); $stmt->execute();
                                if ($ue__stmt = $con->prepare('INSERT INTO u__email (uid, email) VALUES (?, ?)')) {
                                    $ue__stmt->bind_param('is', $cuid, $object['email']); $ue__stmt->execute();
                                    if ($up__stmt = $con->prepare('INSERT INTO u__password (uid, password) VALUES (?, ?)')) {
                                        $up__stmt->bind_param('is', $cuid, $password); $up__stmt->execute();
                                        if ($pr__stmt = $con->prepare('INSERT INTO customers__priv (uid) VALUES (?)')) {
                                            $pr__stmt->bind_param('i', $cuid); $pr__stmt->execute();
                                            if ($pr__stmt = $con->prepare('INSERT INTO customers__lang (uid) VALUES (?)')) {
                                                $pr__stmt->bind_param('i', $cuid); $pr__stmt->execute();
        
                                                $fne = explode(' ', strtr($object['fullname'], $unwanted_array)); for ($i = 0; $i < sizeof($fne); $i++) { $in .= $fne[$i][0]; }
                                                $colors = array('A'=>'1abc9c','B'=>'16a085','C'=>'f1c40f','D'=>'f39c12','E'=>'2ecc71','F'=>'27ae60','G'=>'6ace27','H'=>'d35400','I'=>'3498db','J'=>'2980b9','K'=>'e74c3c','L'=>'c0392b','M'=>'9b59b6','N'=>'8e44ad','O'=>'bdc3c7','P'=>'34495e','Q'=>'2c3e50','R'=>'95a5a6','S'=>'7f8c8d','T'=>'ec87bf','U'=>'d870ad','V'=>'f69785','W'=>'9ba37e','X'=>'b49255','Y'=>'b49255','Z'=>'a94136');
                                                $key = $fne[0][0]; $getcolor = isset($colors[$key]) ? $colors[$key] : null;
                                                if ($init__stmt = $con->prepare('INSERT INTO customers__header (uid, initials, color) VALUES (?, ?, ?)')) {
                                                    $init__stmt->bind_param('iss', $cuid, $in, $getcolor); $init__stmt->execute();
                                                }
        
                                                $header = str_replace("=", "", base64_encode($object['fullname']));
                                                $cid =  strtolower(mb_substr(bin2hex($header), 1, 6) . '' . bin2hex(openssl_random_pseudo_bytes(6)));
                                                function __genshrtnum () { return rand(1000, 9999); } function __gencardcvc () { return rand(100, 999); }
                                                function __gencardnum () { $ft = rand(1000, 9999);$st = rand(1000, 9999);$tt = rand(1000, 9999);$lt = rand(1000, 9999);return $ft .''. $st .''. $tt .''. $lt; }
                                                $cardnum = __gencardnum(); $cardshort = substr($cardnum, -4); $cvc = __gencardcvc();
                                                $exp = date("Y-m-d", strtotime( date( "Y-m-d", strtotime( date("Y-m-d") ) ) . "+3 year" ) );
                                                $cardname = "Mappa+ kártya"; $cardtype = "Virtuális kártya"; $cardprovider = "Mappa Papír Kft.";
        
                                                if ($pr__stmt = $con->prepare('INSERT INTO customers__card (uid, cid, cardname, cardnum, expiry, cvc) VALUES (?, ?, ?, ?, ?, ?)')) {
                                                    $pr__stmt->bind_param('issisi', $cuid, $cid, $cardname, $cardshort, $exp, $cvc); $pr__stmt->execute(); 
                                                    if ($pr__stmt = $con->prepare('INSERT INTO customers__card__info (uid, cid, number, holder, type, provider) VALUES (?, ?, ?, ?, ?, ?)')) {
                                                        $pr__stmt->bind_param('isisss', $cuid, $cid, $cardnum, $object['fullname'], $cardtype, $cardprovider); $pr__stmt->execute();
                                                        if ($pr__stmt = $con->prepare('INSERT INTO customers__card__primary (uid, cid) VALUES (?, ?)')) {
                                                            $pr__stmt->bind_param('is', $cuid, $cid); $pr__stmt->execute(); 
                                                            if ($pr__stmt = $con->prepare('INSERT INTO customers__card__subscription (uid, sub) VALUES (?, 1)')) {
                                                                $pr__stmt->bind_param('i', $cuid); $pr__stmt->execute();
                                                                $log_categ = "Regisztráció"; $log_desc = "#".$cuid." felhasználó sikeresen regisztrált";
                                                                if ($log = $con->prepare('INSERT INTO log (uid, ip, category, description) VALUES(?,?,?,?)')) {
                                                                    $log->bind_param('isss', $cuid, $object['ip'], $log_categ, $log_desc); $log->execute(); $log->close();
                                                                    $this->returnObject = [
                                                                        "status" => "success",
                                                                        "message" => "Sikeres regisztráció."
                                                                    ];
                                                                    return $this->returnObject;
                                                                } else {
                                                                    $this->returnObject = [
                                                                        "status" => "error",
                                                                        "message" => "Hiba a naplózás közben."
                                                                    ];
                                                                    return $this->returnObject;
                                                                }
                                                            }
                                                        } else {
                                                            if ($stmt = $con->prepare('DELETE FROM customers__card WHERE cid = ?')) { $stmt->bind_param('s', $cid); $stmt->execute();
                                                                if ($stmt = $con->prepare('DELETE FROM customers__card__info WHERE cid = ?')) { $stmt->bind_param('s', $cid); $stmt->execute();
                                                                    $this->returnObject = [
                                                                        "status" => "error",
                                                                        "message" => "Hiba történt a folyamat közben."
                                                                    ];
                                                                    return $this->returnObject;
                                                                } else {
                                                                    $this->returnObject = [
                                                                        "status" => "error",
                                                                        "message" => "Hiba történt a folyamat közben."
                                                                    ];
                                                                    return $this->returnObject;
                                                                }
                                                            } else {
                                                                $this->returnObject = [
                                                                    "status" => "error",
                                                                    "message" => "Hiba történt a folyamat közben."
                                                                ];
                                                                return $this->returnObject;
                                                            }
                                                        } 
                                                    } else {
                                                        if ($stmt = $con->prepare('DELETE FROM customers__card WHERE uid = ?')) { $stmt->bind_param('i', $cuid); $stmt->execute(); 
                                                            $this->returnObject = [
                                                                "status" => "error",
                                                                "message" => "Hiba történt a folyamat közben."
                                                            ];
                                                            return $this->returnObject;
                                                        }
                                                    } $pr__stmt->close();
                                                } $pr__stmt->close();
        
                                            }
                                        } $pr__stmt->close();
                                    } $up__stmt->close();
                                } $ue__stmt->close();
                            } else {
                                if ($stmt = $con->prepare('DELETE FROM customers WHERE id = ?')) { $stmt->bind_param('i', $cuid); $stmt->execute();
                                    if ($stmt = $con->prepare('DELETE FROM customers__inv WHERE uid = ?')) { $stmt->bind_param('i', $cuid); $stmt->execute(); 
                                        if ($stmt = $con->prepare('DELETE FROM customers__money WHERE uid = ?')) { $stmt->bind_param('i', $cuid); $stmt->execute();
                                            $this->returnObject = [
                                                "status" => "error",
                                                "message" => "Hiba történt a folyamat közben."
                                            ];
                                            return $this->returnObject;
                                        }
                                    }
                                } 
                            }
                        } else {
                            if ($stmt = $con->prepare('DELETE FROM customers WHERE id = ?')) { $stmt->bind_param('i', $cuid); $stmt->execute();
                                if ($stmt = $con->prepare('DELETE FROM customers__inv WHERE uid = ?')) { $stmt->bind_param('i', $cuid); $stmt->execute();
                                    $this->returnObject = [
                                        "status" => "error",
                                        "message" => "Hiba történt a folyamat közben."
                                    ];
                                    return $this->returnObject;
                                }
                            } 
                        }
                    } else {
                        if ($stmt = $con->prepare('DELETE FROM customers WHERE email = ?')) {
                            $stmt->bind_param('s', $_POST['email']); $stmt->execute();
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
            } $stmt->close();
        } else {
            $this->returnObject = [
                "status" => "error",
                "message" => "Hiba történt a folyamat közben."
            ];
            return $this->returnObject;
        }
        $con->close();

    }

    function logOutUser () {
        
        unset($_COOKIE['__au__login']); setcookie("__au__login", null, -1, '/');
        $_SESSION['loggedin'] = FALSE; unset($_SESSION['id']);
        session_start(); session_destroy();
        
        $this->returnObject = [ "status" => "success" ];
        return $this->returnObject;

    }

    function logOutNoSave ($object) {

        $requiredItems = array ('action', 'uid');
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

        if (isset($_COOKIE['__au__history'])) { $cookieIndex;
            $cookieArray = explode(';', $_COOKIE['__au__history']);
            for ($i = 0; $i < count($cookieArray); $i++) {
                if ($object['uid'] == explode(':', $cookieArray[$i])[0]) {
                    unset($cookieArray[$i]); break;
                }
            } setcookie("__au__history", implode(';', $cookieArray), time() + (1 * 365 * 24* 60 * 60), "/");
            $this->logOutUser();
        } else {
            $this->returnObject = [
                "status" => "error",
                "message" => "Nincsen beállítva ilyen cookie."
            ];
            return $this->returnObject;
        }

    }

    function deleteLoginHistory ($object) {

        $requiredItems = array ('action', 'uid');
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

        if (isset($_COOKIE['__au__history'])) { $cookieIndex;
            $cookieArray = explode(';', $_COOKIE['__au__history']);
            for ($i = 0; $i < count($cookieArray); $i++) {
                if ($object['uid'] == explode(':', $cookieArray[$i])[0]) {
                    unset($cookieArray[$i]); break;
                }
            } setcookie("__au__history", implode(';', $cookieArray), time() + (1 * 365 * 24* 60 * 60), "/");
        } else {
            $this->returnObject = [
                "status" => "error",
                "message" => "Nincsen beállítva ilyen cookie."
            ];
            return $this->returnObject;
        }

    }

    function validateRegisterEmail ($object) {

        $requiredItems = array ('action', 'email');
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

        if ($stmt = $con->prepare('SELECT email FROM customers WHERE email = ?')) {
            $stmt->bind_param('s', $object['email']); $stmt->execute(); $stmt->store_result();
            if ($stmt->num_rows > 0) {
                $this->returnObject = [
                    "status" => "success",
                    "isFree" => false
                ];
                return $this->returnObject;
            } else {
                $this->returnObject = [
                    "status" => "success",
                    "isFree" => true
                ];
                return $this->returnObject;
            }
        } else {
            $this->returnObject = [
                "status" => "error",
                "message" => "Hiba történt a folyamat közben."
            ];
            return $this->returnObject;
        }

    }

    function getCookie ($object) {

        // setcookie("__au__history", '1:192.168.1.1:linux:2023.02.16 21:53:12;8:192.168.1.1:linux:2023.02.16 21:55:12', time() + (1 * 365 * 24* 60 * 60), "/");

        $requiredItems = array ('action', 'cookie');
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

        if (isset($_COOKIE[$object['cookie']])) {
            $this->returnObject = [
                "status" => "success",
                "cookie" => $_COOKIE[$object['cookie']]
            ];
            return $this->returnObject;
        } else {
            $this->returnObject = [
                "status" => "error",
                "message" => "A keresett cookie nem létezik."
            ];
            return $this->returnObject;
        }

    }

    function getLoginDetails ($object) {

        $requiredItems = array ('action', 'data');
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

        $loginId = explode(',', $object['data']);
        $userArray = array();
        for ($i = 0; $i < count($loginId); $i++) {

            if ($getUserInfo = $con->prepare('SELECT customers.id, initials, color, email, fullname FROM customers INNER JOIN customers__header ON customers__header.uid = customers.id WHERE customers.id = ?')) {
                $getUserInfo->bind_param('i', $loginId[$i]); $getUserInfo->execute(); $getUserInfo->store_result();
                if ($getUserInfo->num_rows > 0) {
                    $getUserInfo->bind_result($luid, $initials, $color, $email, $fullname); $getUserInfo->fetch();
                    $getUserInfo->free_result();
                    $con->next_result();

                    $userObject = new stdClass();
                    $userObject->uid = $luid;
                    $userObject->initials = $initials;
                    $userObject->color = $color;
                    $userObject->email = $email;
                    $userObject->fullname = $fullname;
                    array_push($userArray, $userObject);

                }
                $getUserInfo->close();
            } else {
                $this->returnObject = [
                    "status" => "error",
                    "message" => "Hiba történt a folyamat közben."
                ];
                return $this->returnObject;
            }

        }

        $this->returnObject = [
            "status" => "success",
            "object" => $userArray
        ];
        return $this->returnObject;

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
            $authAction->logOutUser();
            die(json_encode($authAction->getResults()));
        break;
        case 'logOutNoSave':
            $authAction->logOutNoSave($postObject);
            die(json_encode($authAction->getResults()));
        break;
        case 'deleteLoginHistory':
            $authAction->deleteLoginHistory($postObject);
            die(json_encode($authAction->getResults()));
        break;
        case 'validateEmail':
            $authAction->validateRegisterEmail($postObject);
            die(json_encode($authAction->getResults()));
        break;
        case 'getCookie':
            $authAction->getCookie($postObject);
            die(json_encode($authAction->getResults()));
        break;
        case 'getLoginDetails':
            $authAction->getLoginDetails($postObject);
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