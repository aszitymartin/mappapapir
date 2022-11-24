<?php require_once($_SERVER['DOCUMENT_ROOT'].'/config/db.inc.php'); $uid = $_SESSION['id'];
switch ($_POST['sub']) { case 'free': $sub = 1; break; case 'loyal': $sub = 2; break; case 'enterprise': $sub = 3; break; default: $sub = 0; break; } if ($sub == 0) { die('subscribe-invalid'); }
if ($stmt = $con->prepare('SELECT sub, date FROM customers__card__subscription WHERE uid = ?')) {
    $stmt->bind_param('i', $uid);$stmt->execute(); $result = $stmt->get_result();
    if($result->num_rows > 0) { $dt = $result->fetch_assoc(); $subid = $dt['sub']; $subdate = strtotime($dt['date']);
        if ($subid == $sub) { die('already-subscribed'); } 
        else {
            if ($stmt = $con->prepare('SELECT value FROM customers__card WHERE uid = ? AND cid = ?')) {
                $stmt->bind_param('is', $uid, $_POST['cid']);$stmt->execute(); $result = $stmt->get_result();
                if($result->num_rows > 0) { $dt = $result->fetch_assoc(); $crdval = $dt['value'];
                    if ($stmt = $con->prepare('SELECT price FROM customers__subscription__data WHERE id = ?')) {
                        $stmt->bind_param('i', $sub);$stmt->execute(); $result = $stmt->get_result();
                        if($result->num_rows > 0) { $dt = $result->fetch_assoc(); $subprice = $dt['price'];
                            if ($crdval < $subprice) { die('money-noten'); }
                            else {
                                if ($sub > $subid) { // Feliratkozas -> upgrade
                                    $discend = strtotime(date('d-m-Y H:i:s', $subdate + (1 * 10 * 24* 60 * 60)));
                                    if ($subdate < $discend) { // 10 napon belul van
                                        $subup = (int)$sub-1;
                                        if ($stmt = $con->prepare('SELECT price FROM customers__subscription__data WHERE id = ?')) {
                                            $stmt->bind_param('i', $subup);$stmt->execute(); $result = $stmt->get_result();
                                            $supr = $result->fetch_assoc(); $cursubval = $supr['price'];
                                            $disc = round(($cursubval * 100) / $subprice); $divdisc = round(($cursubval * $disc) / 100); $discprice = round($subprice - $divdisc);
                                            if ($stmt = $con->prepare('UPDATE customers__card__subscription SET sub = ?, price = ?, date = NOW() WHERE uid = ?')) {
                                                $stmt->bind_param('iii', $sub, $subprice, $uid);$stmt->execute(); $result = $stmt->get_result();
                                                if ($stmt = $con->prepare('UPDATE customers__subscription__payment SET cid = ? WHERE uid = ?')) {
                                                    $stmt->bind_param('si', $_POST['cid'], $uid);$stmt->execute(); $result = $stmt->get_result();
                                                    if ($stmt = $con->prepare('UPDATE customers__card SET value = value-? WHERE cid = ? AND uid = ?')) {
                                                        $stmt->bind_param('isi', $discprice, $_POST['cid'], $uid);$stmt->execute(); $result = $stmt->get_result();
                                                        $item = 'su_'.$sub; $type = false; $note = "csomagra való feliratkozás";
                                                        if ($stmt = $con->prepare('INSERT INTO customers__transactions (uid, cid, item, price, type, note) VALUES (?, ?, ?, ?, ?, ?)')) {
                                                            $stmt->bind_param('issiis', $uid, $_POST['cid'], $item, $discprice, $type, $note);$stmt->execute(); $result = $stmt->get_result();
                                                            die('200');
                                                        }
                                                    }   
                                                }
                                            }
                                        } 
                                    } else { // lejart
                                        if ($stmt = $con->prepare('UPDATE customers__card__subscription SET sub = ?, price = ?, date = NOW() WHERE uid = ?')) {
                                            $stmt->bind_param('iii', $sub, $subprice, $uid);$stmt->execute(); $result = $stmt->get_result();
                                            if ($stmt = $con->prepare('UPDATE customers__subscription__payment SET cid = ? WHERE uid = ?')) {
                                                $stmt->bind_param('si', $_POST['cid'], $uid);$stmt->execute(); $result = $stmt->get_result(); 
                                                if ($stmt = $con->prepare('UPDATE customers__card SET value = value-? WHERE cid = ? AND uid = ?')) {
                                                    $stmt->bind_param('isi', $subprice, $_POST['cid'], $uid);$stmt->execute(); $result = $stmt->get_result(); 
                                                    $item = 'su_'.$sub; $type = false; $note = "csomagra való feliratkozás";
                                                    if ($stmt = $con->prepare('INSERT INTO customers__transactions (uid, cid, item, price, type, note) VALUES (?, ?, ?, ?, ?, ?)')) {
                                                        $stmt->bind_param('issiis', $uid, $_POST['cid'], $item, $subprice, $type, $note);$stmt->execute(); $result = $stmt->get_result();
                                                        die('200');
                                                    }
                                                }   
                                            }   
                                        }
                                    }
                                } else if ($sub < $subid && $sub != 1) { // Feliratkozas -> downgrade
                                    $discend = strtotime(date('d-m-Y H:i:s', $subdate + (1 * 10 * 24* 60 * 60)));
                                    if ($subdate < $discend) { // 10 napon belul van
                                        $subup = (int)$sub+1;
                                        if ($stmt = $con->prepare('SELECT price FROM customers__subscription__data WHERE id = ?')) {
                                            $stmt->bind_param('i', $subup);$stmt->execute(); $result = $stmt->get_result(); 
                                            $supr = $result->fetch_assoc(); $cursubval = $supr['price'];
                                            $disc = round(($subprice * 100) / $cursubval); $divdisc = round(($subprice * $disc)) / 100; $discprice = round($subprice - $divdisc);
                                            if ($stmt = $con->prepare('UPDATE customers__card__subscription SET sub = ?, price = ?, date = NOW() WHERE uid = ?')) {
                                                $stmt->bind_param('iii', $sub, $subprice, $uid);$stmt->execute(); $result = $stmt->get_result();
                                                if ($stmt = $con->prepare('UPDATE customers__subscription__payment SET cid = ? WHERE uid = ?')) {
                                                    $stmt->bind_param('si', $_POST['cid'], $uid);$stmt->execute(); $result = $stmt->get_result(); 
                                                    if ($stmt = $con->prepare('UPDATE customers__card SET value = value-? WHERE cid = ? AND uid = ?')) {
                                                        $stmt->bind_param('isi', $discprice, $_POST['cid'], $uid);$stmt->execute(); $result = $stmt->get_result(); 
                                                        $item = 'su_'.$sub; $type = false; $note = "csomagra való feliratkozás";
                                                        if ($stmt = $con->prepare('INSERT INTO customers__transactions (uid, cid, item, price, type, note) VALUES (?, ?, ?, ?, ?, ?)')) {
                                                            $stmt->bind_param('issiis', $uid, $_POST['cid'], $item, $discprice, $type, $note);$stmt->execute(); $result = $stmt->get_result();
                                                            die('200');
                                                        }
                                                    }   
                                                }
                                            }
                                        } 
                                    } else { // lejart
                                        if ($stmt = $con->prepare('UPDATE customers__card__subscription SET sub = ?, price = ?, date = NOW() WHERE uid = ?')) {
                                            $stmt->bind_param('iii', $sub, $subprice, $uid);$stmt->execute(); $result = $stmt->get_result();
                                            if ($stmt = $con->prepare('UPDATE customers__subscription__payment SET cid = ? WHERE uid = ?')) {
                                                $stmt->bind_param('si', $_POST['cid'], $uid);$stmt->execute(); $result = $stmt->get_result();
                                                if ($stmt = $con->prepare('UPDATE customers__card SET value = value-? WHERE cid = ? AND uid = ?')) {
                                                    $stmt->bind_param('isi', $subprice, $_POST['cid'], $uid);$stmt->execute(); $result = $stmt->get_result();
                                                    $item = 'su_'.$sub; $type = false; $note = "csomagra való feliratkozás";
                                                    if ($stmt = $con->prepare('INSERT INTO customers__transactions (uid, cid, item, price, type, note) VALUES (?, ?, ?, ?, ?, ?)')) {
                                                        $stmt->bind_param('issiis', $uid, $_POST['cid'], $item, $discprice, $type, $note);$stmt->execute(); $result = $stmt->get_result();
                                                        die('200');
                                                    }
                                                }
                                            }
                                        }
                                    }
                                } else if ($sub < $subid && $sub == 1) { // Leiratkozas
                                    if ($stmt = $con->prepare('UPDATE customers__card__subscription SET sub = 1, price = 0, date = NOW() WHERE uid = ?')) {
                                        $stmt->bind_param('i', $uid);$stmt->execute(); $result = $stmt->get_result(); die('200');
                                    }
                                }
                            }
                        }
                    }
                }
            }
        }
    } else { die('subscription-invalid'); }
} else { die('prepare-error'); }
?>