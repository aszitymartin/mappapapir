<?php require_once($_SERVER['DOCUMENT_ROOT'].'/assets/alph.php'); include($_SERVER['DOCUMENT_ROOT'].'/includes/inc.connect.php');
if (mysqli_connect_errno()) { echo "<script>const now = new Date();const notifParams = {notifType : '0',notifIcon : '0',notifTheme : '0',notifTitle : 'Hiba',notifDesc : 'Szerver oldali hiba történt.',expiry : now.setSeconds(60)};localStorage.setItem('NP', JSON.stringify(notifParams));window.location.href= '../';</script>"; }
if ($stmt = $con->prepare('SELECT id, password FROM customers WHERE email = ?')) {
	$stmt->bind_param('s', $_POST['email']);$stmt->execute();$stmt->store_result(); 
	if ($stmt->num_rows > 0) { echo "<script>const now = new Date();const notifParams = {notifType : '0',notifIcon : '0',notifTheme : '0',notifTitle : 'Regisztráció',notifDesc : 'Ez az email cím már foglalt!',expiry : now.setSeconds(60)};localStorage.setItem('NP', JSON.stringify(notifParams));window.location.href= '../';</script>"; exit; }
	else { $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
		if ($stmt = $con->prepare('INSERT INTO customers (fullname, email, password, phone, fax) VALUES (?,?,?,?,?)')) {
			$stmt->bind_param('sssii', $_POST['fullname'], $_POST['email'], $password, $_POST['phone'], $_POST['fax']); $stmt->execute();
			if ($ep__stmt = $con->prepare('SELECT * FROM customers WHERE email = ?')) { $ep__stmt->bind_param('s', $_POST['email']); $ep__stmt->execute(); $ep__res = $ep__stmt->get_result(); $epd = $ep__res->fetch_assoc(); $cuid = $epd['id']; }$ep__stmt->close();
			if ($stmt = $con->prepare('INSERT INTO customers__inv (uid, company, settlement, address, postal, tax) VALUES (?,?,?,?,?,?)')) {
				$stmt->bind_param('isssii', $cuid, $_POST['company'], $_POST['settlement'], $_POST['address'], $_POST['postal'], $_POST['tax']); $stmt->execute();
				if ($stmt = $con->prepare('INSERT INTO customers__money (uid) VALUES (?)')) {
					$stmt->bind_param('i', $cuid); $stmt->execute();
					if ($stmt = $con->prepare('INSERT INTO customers__ship (uid, settlement, address, postal) VALUES (?,?,?,?)')) {
						$stmt->bind_param('issi', $cuid, $_POST['sh__settl'], $_POST['sh__addr'], $_POST['sh__zip']); $stmt->execute();
						if ($ue__stmt = $con->prepare('INSERT INTO u__email (uid, email) VALUES (?, ?)')) {
							$ue__stmt->bind_param('is', $cuid, $_POST['email']); $ue__stmt->execute();
							if ($up__stmt = $con->prepare('INSERT INTO u__password (uid, password) VALUES (?, ?)')) {
								$up__stmt->bind_param('is', $cuid, $password); $up__stmt->execute();
								if ($pr__stmt = $con->prepare('INSERT INTO customers__priv (uid) VALUES (?)')) {
									$pr__stmt->bind_param('i', $cuid); $pr__stmt->execute();
									if ($pr__stmt = $con->prepare('INSERT INTO customers__lang (uid) VALUES (?)')) {
										$pr__stmt->bind_param('i', $cuid); $pr__stmt->execute();

										$fne = explode(' ', strtr($_POST['fullname'], $unwanted_array)); for ($i = 0; $i < sizeof($fne); $i++) { $in .= $fne[$i][0]; }
										$colors = array('A'=>'1abc9c','B'=>'16a085','C'=>'f1c40f','D'=>'f39c12','E'=>'2ecc71','F'=>'27ae60','G'=>'6ace27','H'=>'d35400','I'=>'3498db','J'=>'2980b9','K'=>'e74c3c','L'=>'c0392b','M'=>'9b59b6','N'=>'8e44ad','O'=>'bdc3c7','P'=>'34495e','Q'=>'2c3e50','R'=>'95a5a6','S'=>'7f8c8d','T'=>'ec87bf','U'=>'d870ad','V'=>'f69785','W'=>'9ba37e','X'=>'b49255','Y'=>'b49255','Z'=>'a94136');
										$key = $fne[0][0]; $getcolor = isset($colors[$key]) ? $colors[$key] : null;
										if ($init__stmt = $con->prepare('INSERT INTO customers__header (uid, initials, color) VALUES (?, ?, ?)')) {
											$init__stmt->bind_param('iss', $cuid, $in, $getcolor); $init__stmt->execute();
										}

										$header = str_replace("=", "", base64_encode($_POST['fullname']));
										$cid =  strtolower(mb_substr(bin2hex($header), 1, 6) . '' . bin2hex(openssl_random_pseudo_bytes(6)));
										function __genshrtnum () { return rand(1000, 9999); } function __gencardcvc () { return rand(100, 999); }
										function __gencardnum () { $ft = rand(1000, 9999);$st = rand(1000, 9999);$tt = rand(1000, 9999);$lt = rand(1000, 9999);return $ft .''. $st .''. $tt .''. $lt; }
										$cardnum = __gencardnum(); $cardshort = substr($cardnum, -4); $cvc = __gencardcvc();
										$exp = date("Y-m-d", strtotime( date( "Y-m-d", strtotime( date("Y-m-d") ) ) . "+3 year" ) );
										$cardname = "Mappa+ kártya"; $cardtype = "Virtuális kártya"; $cardprovider = "Mappa Papír Kft.";

										if ($pr__stmt = $con->prepare('INSERT INTO customers__card (uid, cid, cardname, cardnum, expiry, cvc) VALUES (?, ?, ?, ?, ?, ?)')) {
											$pr__stmt->bind_param('issisi', $cuid, $cid, $cardname, $cardshort, $exp, $cvc); $pr__stmt->execute(); 
											if ($pr__stmt = $con->prepare('INSERT INTO customers__card__info (uid, cid, number, holder, type, provider) VALUES (?, ?, ?, ?, ?, ?)')) {
												$pr__stmt->bind_param('isisss', $cuid, $cid, $cardnum, $_POST['fullname'], $cardtype, $cardprovider); $pr__stmt->execute();
												if ($pr__stmt = $con->prepare('INSERT INTO customers__card__primary (uid, cid) VALUES (?, ?)')) {
													$pr__stmt->bind_param('is', $cuid, $cid); $pr__stmt->execute(); 
													if ($pr__stmt = $con->prepare('INSERT INTO customers__card__subscription (uid, sub) VALUES (?, 1)')) {
														$pr__stmt->bind_param('i', $cuid); $pr__stmt->execute();
														$log_categ = "Regisztráció"; $log_desc = "#".$cuid." felhasználó sikeresen regisztrált";
														if ($log = $con->prepare('INSERT INTO log (uid, ip, category, description) VALUES(?,?,?,?)')) {
															$log->bind_param('isss', $cuid, $_POST['ip'], $log_categ, $log_desc); $log->execute(); $log->close(); die('200');
														} else { die ("410"); }
													}
												} else {
													if ($stmt = $con->prepare('DELETE FROM customers__card WHERE cid = ?')) { $stmt->bind_param('s', $cid); $stmt->execute();
														if ($stmt = $con->prepare('DELETE FROM customers__card__info WHERE cid = ?')) { $stmt->bind_param('s', $cid); $stmt->execute(); die("410"); }
													}
												} 
											} else {
												if ($stmt = $con->prepare('DELETE FROM customers__card WHERE uid = ?')) { $stmt->bind_param('i', $cuid); $stmt->execute(); die("410"); }
											} $pr__stmt->close();
										} $pr__stmt->close();

									}
								} $pr__stmt->close();
							} $up__stmt->close();
						} $ue__stmt->close();
					} else {
						if ($stmt = $con->prepare('DELETE FROM customers WHERE id = ?')) { $stmt->bind_param('i', $cuid); $stmt->execute();
							if ($stmt = $con->prepare('DELETE FROM customers__inv WHERE uid = ?')) { $stmt->bind_param('i', $cuid); $stmt->execute(); 
								if ($stmt = $con->prepare('DELETE FROM customers__money WHERE uid = ?')) { $stmt->bind_param('i', $cuid); $stmt->execute(); die("410"); }
							}
						} 
					}
				} else {
					if ($stmt = $con->prepare('DELETE FROM customers WHERE id = ?')) { $stmt->bind_param('i', $cuid); $stmt->execute();
						if ($stmt = $con->prepare('DELETE FROM customers__inv WHERE uid = ?')) { $stmt->bind_param('i', $cuid); $stmt->execute(); die("410"); }
					} 
				}
			} else { if ($stmt = $con->prepare('DELETE FROM customers WHERE email = ?')) { $stmt->bind_param('s', $_POST['email']); $stmt->execute(); die("410"); } }
		} else {echo "<script>const now = new Date();const notifParams = {notifType : '1',notifIcon : '2',notifTheme : '0',notifTitle : 'Hiba',notifDesc : 'Ismeretlen hiba történt.',expiry : now.setSeconds(60)};localStorage.setItem('NP', JSON.stringify(notifParams));window.location.href= '../';</script>";}
	} $stmt->close();
} else {echo "<script>const now = new Date();const notifParams = {notifType : '0',notifIcon : '0',notifTheme : '0',notifTitle : 'Hiba',notifDesc : 'Ismeretlen hiba történt.',expiry : now.setSeconds(60)};localStorage.setItem('NP', JSON.stringify(notifParams));window.location.href= '../';</script>";}
$con->close();

?>