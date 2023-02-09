<?php session_start();
// Csatlakozas az adatbazishoz
$DATABASE_HOST = 'localhost';$DATABASE_USER = 'root';$DATABASE_PASS = 'eKi=0630OG';$DATABASE_NAME = 'mappapapir'; $con = mysqli_connect($DATABASE_HOST, $DATABASE_USER, $DATABASE_PASS, $DATABASE_NAME);
if ( mysqli_connect_errno() ) {echo "<script>const now = new Date(); const notifParams = {notifType : '1',notifIcon : '2',notifTheme : '0',notifTitle : 'Hiba',notifDesc : 'Szerver oldali hiba történt.',expiry : now.setSeconds(60)};localStorage.setItem('NP', JSON.stringify(notifParams)); window.location.href= '../';</script>";}
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
	$stmt->bind_param('s', $_POST['email']); $stmt->execute(); $stmt->store_result();
    if ($stmt->num_rows > 0) { $stmt->bind_result($id, $fullname, $emailaddress, $password, $theme); $stmt->fetch();
        if (password_verify($_POST['password'], $password)) {
            // Session generalasa, kesobbi felhasznalasra alkalmas valtozok letrehozasa
            // Sutik letrehozasa, bejelentkezesi adatok mentese hogy ne kelljen ujbol bejelentkezni a session lejartaval.
            
            $ua=getBrowser(); $agent = $ua['name']. ':' . $ua['version'] . ':'. $ua['platform']; $expiry = (time() + (86400 * 365));

            $header = str_replace("=", "", base64_encode($typ . '' . $alg)); $payload =  str_replace("=", "", base64_encode("scotch.io " . strtotime(date('Y-m-d', strtotime('+1 year'))) . " " . $_POST['email']));
            $encodestring = $header . '.' . $payload; $token = hash_hmac('sha256', $encodestring, 'secret'); $exp = time() + (1 * 365 * 24* 60 * 60);
            if ($stmt = $con->prepare('INSERT INTO customers__token (uid, token, agent, expiry) VALUES (?, ?, ?, ?)')) { $stmt->bind_param('issi', $id, $token, $agent, $expiry); $stmt->execute();
                setcookie("__au__login", $token, time() + (1 * 365 * 24* 60 * 60), "/");
            }

            if ($stmt = $con->prepare('SELECT id FROM customers WHERE email = ?')) {
                $stmt->bind_param('s', $_POST['email']); $stmt->execute(); $result = $stmt->get_result(); $arr = array();
                if($result->num_rows > 0) { $data = $result->fetch_assoc(); $cuid = $data['id']."";
                    $ua=getBrowser(); $agent = $ua['name']; $platform = $ua['platform']; $status = 1;
                    if ($setp__email = $con->prepare('INSERT INTO login__attempts (uid, location, country, status, browser, device, sys, ip) VALUES (?, ?, ?, ?, ?, ?, ?, ?)')) {
                        $setp__email->bind_param('ississss', $cuid, $_POST['city'], $_POST['country'], $status, $agent, $_POST['device'], $platform, $_POST['ip']); $setp__email->execute(); 
                        if ($setp__email = $con->prepare('DELETE FROM customers__deactivated WHERE uid = ?')) {
                            $setp__email->bind_param('i', $cuid); $setp__email->execute();
                            if ($setp__email = $con->prepare('DELETE FROM customers__deleted WHERE uid = ?')) {
                                $setp__email->bind_param('i', $cuid); $setp__email->execute(); $_SESSION['loggedin'] = TRUE; $_SESSION['id'] = $cuid; die('200');
                            }
                        }
                    } $setp__email->close();
                }
            }
        } else {
            if ($stmt = $con->prepare('SELECT id FROM customers WHERE email = ?')) {
                $stmt->bind_param('s', $_POST['email']); $stmt->execute(); $result = $stmt->get_result(); $arr = array();
                if($result->num_rows > 0) { $data = $result->fetch_assoc(); $cuid = $data['id']."";
                    $ua=getBrowser(); $agent = $ua['name']; $platform = $ua['platform']; $status = 0;
                    if ($setp__email = $con->prepare('INSERT INTO login__attempts (uid, location, country, status, browser, device, sys, ip) VALUES (?, ?, ?, ?, ?, ?, ?, ?)')) {
                        $setp__email->bind_param('ississss', $cuid, $_POST['city'], $_POST['country'], $status, $agent, $_POST['device'], $platform, $_POST['ip']); $setp__email->execute(); die('410');
                    } $setp__email->close();
                }
            }
        }
    } else {
        if ($stmt = $con->prepare('SELECT id FROM customers WHERE email = ?')) {
            $stmt->bind_param('s', $_POST['email']); $stmt->execute(); $result = $stmt->get_result(); $arr = array();
            if($result->num_rows > 0) { $data = $result->fetch_assoc(); $cuid = $data['id']."";
                $ua=getBrowser(); $agent = $ua['name']; $platform = $ua['platform']; $status = 0;
                if ($setp__email = $con->prepare('INSERT INTO login__attempts (uid, location, country, status, browser, device, sys, ip) VALUES (?, ?, ?, ?, ?, ?, ?, ?)')) {
                    $setp__email->bind_param('ississss', $cuid, $_POST['city'], $_POST['country'], $status, $agent, $_POST['device'], $platform, $_POST['ip']); $setp__email->execute(); die('410');
                } $setp__email->close();
            }
        }
    }$stmt->close();
}
?>