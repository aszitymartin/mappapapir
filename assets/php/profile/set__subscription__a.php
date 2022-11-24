<?php require_once($_SERVER['DOCUMENT_ROOT'].'/config/db.inc.php'); $uid = $_POST['id']; 
switch ($_POST['sub']) { case 'free': $sub = 1; $price = 0; break; case 'loyal': $sub = 2; $price = 1500; break; case 'enterprise': $sub = 3; $price = 5000; break; default: $sub = 0; $price = 0; break; } if ($sub == 0) { die('Érvénytelen csomag.'); }
if ($stmt = $con->prepare('SELECT sub FROM customers__card__subscription WHERE uid = ?')) {
    $stmt->bind_param('i', $uid);$stmt->execute(); $result = $stmt->get_result();
    if($result->num_rows > 0) { $dt = $result->fetch_assoc(); $subid = $dt['sub'];
        if ($subid == $sub) { die('A felhasználó már előfizetett erre a csomagra.'); } 
        else {
            if ($stmt = $con->prepare('UPDATE customers__card__subscription SET sub = ?, price = ? WHERE uid = ?')) {
                $stmt->bind_param('iii', $sub, $price, $uid);$stmt->execute();
                if ($stmt = $con->prepare('SELECT sid FROM customers__subpay__pool WHERE uid = ?')) {
                    $stmt->bind_param('i', $uid);$stmt->execute(); $result = $stmt->get_result(); $con->next_result();
                    if($result->num_rows > 0) { $dt = $result->fetch_assoc(); $sid = $dt['sid'];
                        if ($stmt = $con->prepare('UPDATE customers__subpay__pool SET sid = ? WHERE uid = ?')) {
                            $stmt->bind_param('ii', $sub, $uid);$stmt->execute(); $scdn = "Mappa+ kártya";
                            if ($stmt = $con->prepare('SELECT cid FROM customers__card WHERE uid = ? AND cardname LIKE ?')) {
                                $stmt->bind_param('is', $uid, $scdn);$stmt->execute(); $result = $stmt->get_result(); $con->next_result();
                                if($result->num_rows > 0) { $dt = $result->fetch_assoc(); $cid = $dt['cid'];
                                    if ($stmt = $con->prepare('SELECT cid FROM customers__subscription__payment WHERE uid = ?')) {
                                        $stmt->bind_param('i', $uid);$stmt->execute(); $result = $stmt->get_result(); $con->next_result();
                                        if($result->num_rows > 0) {
                                            if ($stmt = $con->prepare('UPDATE customers__subscription__payment SET cid = ? WHERE uid = ?')) {
                                                $stmt->bind_param('si', $cid, $uid);$stmt->execute(); $stmt->free_result(); $stmt->close(); $con->next_result();
                                                $item = 'su_'.$sub; $type = 0; $note = "csomagra való feliratkozás";
                                                if ($stmt = $con->prepare('INSERT INTO customers__transactions (uid, cid, item, price, type, note) VALUES (?, ?, ?, ?, ?, ?)')) {
                                                    $stmt->bind_param('issiis', $uid, $cid, $item, $price, $type, $note);$stmt->execute(); $stmt->free_result(); $stmt->close(); $con->next_result();
                                                    $log_categ = "Felhasználó szerkesztése"; $log_desc = "#".$uid." felhasználót feliratkoztatta a következő csomagra: " . $sub;
                                                    if ($log = $con->prepare('INSERT INTO log (uid, ip, category, description) VALUES(?,?,?,?)')) {
                                                        $log->bind_param('isss', $_SESSION['id'], $_POST['ip'], $log_categ, $log_desc); $log->execute(); $log->close(); die('200');
                                                    } else { die ("Hiba történt a folyamat közben #20"); }
                                                } else { die('Hiba történt a folyamat közben #19'); }
                                            } else { die('Hiba történt a folyamat közben #18'); }
                                        } else {
                                            if ($stmt = $con->prepare('INSERT INTO customers__subscription__payment (uid, cid) VALUES (?, ?)')) {
                                                $stmt->bind_param('is', $uid, $cid);$stmt->execute(); $stmt->free_result(); $stmt->close(); $con->next_result();
                                                $item = 'su_'.$sub; $type = 0; $note = "csomagra való feliratkozás";
                                                if ($stmt = $con->prepare('INSERT INTO customers__transactions (uid, cid, item, price, type, note) VALUES (?, ?, ?, ?, ?, ?)')) {
                                                    $stmt->bind_param('issiis', $uid, $cid, $item, $price, $type, $note);$stmt->execute(); $stmt->free_result(); $stmt->close(); $con->next_result();
                                                    $log_categ = "Felhasználó szerkesztése"; $log_desc = "#".$uid." felhasználót feliratkoztatta a következő csomagra: " . $sub;
                                                    if ($log = $con->prepare('INSERT INTO log (uid, ip, category, description) VALUES(?,?,?,?)')) {
                                                        $log->bind_param('isss', $_SESSION['id'], $_POST['ip'], $log_categ, $log_desc); $log->execute(); $log->close(); die('200');
                                                    } else { die ("Hiba történt a folyamat közben #17"); }
                                                } else { die('Hiba történt a folyamat közben #16'); }
                                            } else { die('Hiba történt a folyamat közben #15'); }
                                        }
                                    } else { die('Hiba történt a folyamat közben #14'); }
                                    if ($stmt = $con->prepare('INSERT INTO customers__subpay__pool (uid, cid, sid) VALUES (?, ?, ?)')) {
                                        $stmt->bind_param('isi', $uid, $cid, $sub);$stmt->execute(); $stmt->free_result(); $stmt->close();
                                    } else { die('Hiba történt a folyamat közben #13'); }
                                } else { die('Hiba történt a folyamat közben #12'); }
                            }
                        } else { die('Hiba történt a folyamat közben #11'); }
                    } else { $scdn = "Mappa+ kártya";
                        if ($stmt = $con->prepare('SELECT cid FROM customers__card WHERE uid = ? AND cardname LIKE ?')) {
                            $stmt->bind_param('is', $uid, $scdn);$stmt->execute(); $result = $stmt->get_result();
                            if($result->num_rows > 0) { $dt = $result->fetch_assoc(); $cid = $dt['cid'];
                                if ($stmt = $con->prepare('INSERT INTO customers__subpay__pool (uid, cid, sid) VALUES (?, ?, ?)')) { $sid = $sub;
                                    $stmt->bind_param('isi', $uid, $cid, $sid);$stmt->execute(); $stmt->free_result(); $stmt->close(); $con->next_result();
                                    if ($stmt = $con->prepare('INSERT INTO customers__subscription__payment (uid, cid) VALUES (?, ?)')) {
                                        $stmt->bind_param('is', $uid, $cid);$stmt->execute(); $stmt->free_result(); $stmt->close(); $con->next_result();
                                        $item = 'su_'.$sub; $type = 0; $note = "csomagra való feliratkozás";
                                        if ($stmt = $con->prepare('INSERT INTO customers__transactions (uid, cid, item, price, type, note) VALUES (?, ?, ?, ?, ?, ?)')) {
                                            $stmt->bind_param('issiis', $uid, $cid, $item, $price, $type, $note);$stmt->execute(); $stmt->free_result(); $stmt->close(); $con->next_result();
                                            $log_categ = "Felhasználó szerkesztése"; $log_desc = "#".$uid." felhasználót feliratkoztatta a következő csomagra: " . $sub;
                                            if ($log = $con->prepare('INSERT INTO log (uid, ip, category, description) VALUES(?,?,?,?)')) {
                                                $log->bind_param('isss', $_SESSION['id'], $_POST['ip'], $log_categ, $log_desc); $log->execute(); $log->close(); die('200');
                                            } else { die ("Hiba történt a folyamat közben #10"); }
                                        } else { die('Hiba történt a folyamat közben #9'); }
                                    } else { die('Hiba történt a folyamat közben #8'); }
                                } else { die('Hiba történt a folyamat közben #7'); }
                            } else { die('Hiba történt a folyamat közben #6'); }
                        } else { die('Hiba történt a folyamat közben #5'); }
                    }
                } else { die('Hiba történt a folyamat közben #4'); }
            } else { die('Hiba történt a folyamat közben #3'); }
        }
    } else { die('Hiba történt a folyamat közben #2'); }
} else { die('Hiba történt a folyamat közben #1'); }
?>