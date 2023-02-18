<?php session_start(); include($_SERVER['DOCUMENT_ROOT'].'/includes/inc.connect.php');
$uid = $_SESSION['id']; if (!isset($_SESSION['loggedin'])) { die('43'); }
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

if ($stmt = $con->prepare('SELECT id FROM customers WHERE id = ?')) {
    $stmt->bind_param('i', $uid); $stmt->execute(); $result = $stmt->get_result(); $arr = array();
    if($result->num_rows > 0) { $data = $result->fetch_assoc(); $cuid = $data['id']."";
        $ua=getBrowser(); $agent = $ua['name']; $platform = $ua['platform']; $status = $_POST['status'];
        if ($setp__email = $con->prepare('INSERT INTO u__pass__history (uid, location, country, status, browser, device, sys, ip) VALUES (?, ?, ?, ?, ?, ?, ?, ?)')) {
            $setp__email->bind_param('ississss', $uid, $_POST['city'], $_POST['country'], $status, $agent, $_POST['device'], $platform, $_POST['ip']); $setp__email->execute(); die('200');
        } $setp__email->close();
    }
}