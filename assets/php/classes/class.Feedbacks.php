<?php require_once($_SERVER['DOCUMENT_ROOT'].'/includes/inc.php');

// ini_set('display_errors', 1); ini_set('display_startup_errors', 1); error_reporting(E_ALL);

Class Feedback {

    public $returnObject;

    private function connect () {
        include($_SERVER['DOCUMENT_ROOT'].'/includes/inc.connect.php');
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

    function listFeedbacks ($object) {

        $requiredItems = array ('action');
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

        $sql = 'SELECT feedbacks.id, feedbacks.uid, feedbacks.title, feedbacks.type, feedbacks.status, feedbacks.created, customers.fullname, customers__header.initials, customers__header.color FROM feedbacks INNER JOIN customers ON customers.id = feedbacks.uid INNER JOIN customers__header ON customers__header.uid = customers.id ORDER BY feedbacks.created DESC';
        $stmt = $con->query($sql);
        if ($stmt->num_rows > 0) { $feedbacksArray = array();
            while ($fd = $stmt->fetch_assoc()) {
                $feedbacksObject = new stdClass();
                $feedbacksObject->id = $fd['id'];
                $feedbacksObject->uid = $fd['uid'];
                $feedbacksObject->title = $fd['title'];
                $feedbacksObject->type = $fd['type'];
                $feedbacksObject->status = $fd['status'];
                $feedbacksObject->created = $fd['created'];
                $feedbacksObject->name = $fd['fullname'];
                $feedbacksObject->initials = $fd['initials'];
                $feedbacksObject->color = $fd['color'];
                array_push($feedbacksArray, $feedbacksObject);
            }
            $this->returnObject = [
                "status" => "success",
                "data" => $feedbacksArray
            ]; return $this->returnObject;
        } else {
            $this->returnObject = [
                "status" => "empty",
                "message" => "Nincsen megjeleníthető adat."
            ]; return $this->returnObject;
        }

    }

    function listFeedbacksByUser ($object) {

        $requiredItems = array ('action', 'uid');
        $objectKeys = array_keys((array)$object);
        if ($requiredItems !== $objectKeys) {
            $this->returnObject = [
                "status" => "error",
                "message" => "Nincs elegendő adat a folytatáshoz."
            ];
            return $this->returnObject;
        }

        if ($object['uid'] == 0) {
            $this->returnObject = [
                "status" => "error",
                "message" => "Érvénytelen felhasználó."
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

        $sql = 'SELECT feedbacks.id, feedbacks.uid, feedbacks.title, feedbacks.type, feedbacks.status, feedbacks.created, customers.fullname, customers__header.initials, customers__header.color FROM feedbacks INNER JOIN customers ON customers.id = feedbacks.uid INNER JOIN customers__header ON customers__header.uid = customers.id WHERE feedbacks.uid = ' . $object['uid'] . ' ORDER BY feedbacks.created DESC';
        $stmt = $con->query($sql);
        if ($stmt->num_rows > 0) { $feedbacksArray = array();
            while ($fd = $stmt->fetch_assoc()) {
                $feedbacksObject = new stdClass();
                $feedbacksObject->id = $fd['id'];
                $feedbacksObject->uid = $fd['uid'];
                $feedbacksObject->title = $fd['title'];
                $feedbacksObject->type = $fd['type'];
                $feedbacksObject->status = $fd['status'];
                $feedbacksObject->created = $fd['created'];
                $feedbacksObject->name = $fd['fullname'];
                $feedbacksObject->initials = $fd['initials'];
                $feedbacksObject->color = $fd['color'];
                array_push($feedbacksArray, $feedbacksObject);
            }
            $this->returnObject = [
                "status" => "success",
                "data" => $feedbacksArray
            ]; return $this->returnObject;
        } else {
            $this->returnObject = [
                "status" => "empty",
                "message" => "Nincsen megjeleníthető adat."
            ]; return $this->returnObject;
        }

    }

    function listFeedbacksById ($object) {

        $requiredItems = array ('action', 'fid');
        $objectKeys = array_keys((array)$object);
        if ($requiredItems !== $objectKeys) {
            $this->returnObject = [
                "status" => "error",
                "message" => "Nincs elegendő adat a folytatáshoz."
            ];
            return $this->returnObject;
        }

        if ($object['uid'] == 0) {
            $this->returnObject = [
                "status" => "error",
                "message" => "Érvénytelen felhasználó."
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

        $sql = 'SELECT feedbacks.id, feedbacks.uid, feedbacks.title, feedbacks.type, feedbacks.status, feedbacks.created, customers.fullname, customers__header.initials, customers__header.color FROM feedbacks INNER JOIN customers ON customers.id = feedbacks.uid INNER JOIN customers__header ON customers__header.uid = customers.id WHERE feedbacks.id = ' . $object['fid'];
        $stmt = $con->query($sql);
        if ($stmt->num_rows > 0) { $feedbacksArray = array();
            while ($fd = $stmt->fetch_assoc()) {
                $feedbacksObject = new stdClass();
                $feedbacksObject->id = $fd['id'];
                $feedbacksObject->uid = $fd['uid'];
                $feedbacksObject->title = $fd['title'];
                $feedbacksObject->type = $fd['type'];
                $feedbacksObject->status = $fd['status'];
                $feedbacksObject->created = $fd['created'];
                $feedbacksObject->name = $fd['fullname'];
                $feedbacksObject->initials = $fd['initials'];
                $feedbacksObject->color = $fd['color'];
                array_push($feedbacksArray, $feedbacksObject);
            }
            $this->returnObject = [
                "status" => "success",
                "data" => $feedbacksArray
            ]; return $this->returnObject;
        } else {
            $this->returnObject = [
                "status" => "empty",
                "message" => "Nincsen megjeleníthető adat."
            ]; return $this->returnObject;
        }

    }

    function sendFeedback ($object) {

        $requiredItems = array ('action', 'uid', 'title', 'description', 'type', 'attachment', 'ip');
        $objectKeys = array_keys((array)$object);
        if ($requiredItems !== $objectKeys) {
            $this->returnObject = [
                "status" => "error",
                "message" => "Nincs elegendő adat a folytatáshoz."
            ];
            return $this->returnObject;
        }

        if ($object['uid'] == 0) {
            $this->returnObject = [
                "status" => "error",
                "message" => "Érvénytelen felhasználó."
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

        if ($sql = $con->prepare('INSERT INTO feedbacks (uid, title, type, status) VALUES (?, ?, ?, 0)')) {
            $sql->bind_param('isi', $object['uid'], htmlspecialchars($object['title'], ENT_QUOTES), $object['type']);
            $sql->execute(); $lastId = $con->insert_id; $sql->close();

            $log_categ = "Visszajelzés küldése"; $log_desc = "#".$_SESSION['id']." felhasználó  új visszajelzést küldött.";
            if ($log = $con->prepare('INSERT INTO log (uid, ip, category, description) VALUES(?,?,?,?)')) {
                $log->bind_param('isss', $object['uid'], $object['ip'], $log_categ, $log_desc); $log->execute(); $log->close(); 
                $returnData = new stdClass(); $returnData->fid = $lastId; $returnData->uid = $object['uid'];
                $this->returnObject = [
                    "status" => "success",
                    "data" => $returnData
                ];
                return $this->returnObject;
            } else {
                $this->returnObject = [
                    "status" => "error",
                    "message" => "Hiba történt a naplózás közben."
                ]; return $this->returnObject;
            }
        } else {
            $this->returnObject = [
                "status" => "error",
                "message" => "Hiba történt a folyamat közben."
            ];
            return $this->returnObject;
        }

    }

    function insertImagesToFeedback ($object, $attachment) {

        function check ($type) { $exten = ['png', 'jpg', 'jpeg']; if (in_array($type, $exten)) { return 'true'; } else { return 'false'; } }
        function upload ($file) { $target_dir = $_SERVER['DOCUMENT_ROOT'].'/assets/images/feedbacks/'; $name = basename($file['name']); $type = $file['type']; $tmp = $file['tmp_name']; $doc = substr(md5(rand()), 0, 7) . '' . date('YmdHis') . '.' . basename($type); if (move_uploaded_file($tmp, $target_dir . '' . $doc)) { return $doc; } else { return false; die('Miniatűr feltöltése meghiusúlt, a termék nem lett létrehozva.'); } }

        $requiredItems = array ('fid', 'uid', 'message');
        $objectKeys = array_keys((array)$object);
        if ($requiredItems !== $objectKeys) {
            $this->returnObject = [
                "status" => "error",
                "message" => "Nincs elegendő adat a folytatáshoz."
            ];
            return $this->returnObject;
        }

        if ($object['uid'] == 0) {
            $this->returnObject = [
                "status" => "error",
                "message" => "Érvénytelen felhasználó."
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

        if ($selectFeedbackInfo = $con->prepare('SELECT uid, status FROM feedbacks WHERE id = ?')) {
            $selectFeedbackInfo->bind_param('i', $object['fid']); $selectFeedbackInfo->execute(); $selectFeedbackInfo->store_result();
            $selectFeedbackInfo->bind_result($feedbackCreator, $feedbackStatus); $selectFeedbackInfo->fetch(); $selectFeedbackInfo->close();

            if ($feedbackStatus == 0 && $feedbackCreator != $_SESSION['id']) {
                if ($updateFeedbackStatus = $con->prepare('UPDATE feedbacks SET status = 1 WHERE id = ?')) {
                    $updateFeedbackStatus->bind_param('i', $object['fid']); $updateFeedbackStatus->execute(); $updateFeedbackStatus->close();
                }
            }

            if ($sql = $con->prepare('INSERT INTO feedbacks_reply (fid, uid, message, attachment) VALUES (?, ?, ?, ?)')) {
                $formatted_attachments = []; for ($i = 0; $i < count($attachment); $i++) { if (check(basename($attachment['atch' . ($i + 1)]['type']))) { array_push($formatted_attachments, upload($attachment['atch' . ($i + 1)])); } }
                $attachments = implode(';', $formatted_attachments);
                $sql->bind_param('iiss', $object['fid'], $object['uid'], htmlspecialchars($object['message'], ENT_QUOTES), $attachments);
                $sql->execute(); $sql->close(); $this->returnObject = [ "status" => "success" ]; return $this->returnObject;
    
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

    function showMessage ($object) {

        $requiredItems = array ('action', 'fid');
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

        if ($sql = $con->prepare('SELECT feedbacks_reply.id AS frid, feedbacks.uid AS fcuid, feedbacks_reply.uid AS fuid, message AS fmessage, attachment AS fattachment, sent AS fsent FROM feedbacks_reply INNER JOIN feedbacks ON feedbacks.id = feedbacks_reply.fid WHERE fid = ? ORDER BY feedbacks_reply.sent ASC')) {
            $sql->bind_param('i', $object['fid']); $sql->execute(); $sql->store_result(); $sql->bind_result($frid, $fcuid, $fuid, $fmessage, $fattachment, $fsent);
            $feedbacks_array = array();
            while ($sql->fetch()) {
                $replyObject = new stdClass();
                $replyObject->frid = $frid; $replyObject->ftype = $fuid == $_SESSION['id'] ? 1 : 0;
                
                if ($getSenderInfo = $con->prepare('SELECT customers.fullname, customers__header.initials, customers__header.color FROM customers INNER JOIN customers__header ON customers__header.uid = customers.id WHERE customers.id = ?')) {
                    $getSenderInfo->bind_param('i', $fuid); $getSenderInfo->execute(); $getSenderInfo->store_result(); $getSenderInfo->bind_result($cfullname, $cinitials, $ccolor); $getSenderInfo->fetch();
                    $customersObject = new stdClass();
                    $customersObject->fullname = $cfullname;
                    $customersObject->initials = $cinitials;
                    $customersObject->color = $ccolor;
                    $replyObject->sender = $customersObject;
                    $getSenderInfo->close();
                }

                $replyObject->fuid = $fuid; $replyObject->fmessage = $fmessage;
                $replyObject->fattachment = $fattachment; $replyObject->fsent = $fsent;
                array_push($feedbacks_array, $replyObject);
            } $sql->free_result(); $sql->close();

            $this->returnObject = [
                "status" => "success",
                "data" => $feedbacks_array
            ];
            return $this->returnObject;

        } else {
            $this->returnObject = [
                "status" => "error",
                "message" => "Hiba történt a folyamat közben."
            ];
            return $this->returnObject;
        }

    }

    function deleteFeedback ($object) {

        $requiredItems = array ('action', 'items', 'ip');
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

        if (count($object['items']) < 1) {
            $this->returnObject = [
                "status" => "empty"
            ];
            return $this->returnObject;
        }

        $deleteArray = array();
        for ($i = 0; $i < count($object['items']); $i++) {

            if ($getFeedback = $con->prepare('SELECT feedbacks.uid FROM feedbacks WHERE feedbacks.id = ?')) {
                $getFeedback->bind_param('i', $object['items'][$i]); $getFeedback->execute(); $getFeedback->store_result();
                $getFeedback->bind_result($fid); $getFeedback->fetch(); $getFeedback->close();
    
                $stmt = $con->prepare('SELECT privilege FROM customers__priv  WHERE uid = ?');
                $stmt->bind_param('i', $_SESSION['id']);$stmt->execute(); $stmt->bind_result($privilege); $stmt->fetch();$stmt->close();
    
                $deleteObject = new stdClass();
                $deleteObject->ip = $object['ip'];
                $deleteObject->fid = $object['items'][$i];

                array_push($deleteArray,
                    [
                        "ip" => $object['ip'],
                        "fid" => $object['items'][$i]
                    ]
                );

            } else {
                $this->returnObject = [
                    "status" => "error",
                    "message" => "Hiba történt a folyamat közben."
                ];
                return $this->returnObject;
            }

        }

        if ($fid == $_SESSION['id']) { $this->initDelete($deleteArray); }
        else { if ($privilege > 0) { $this->initDelete($deleteArray); } }

    }

    function initDelete ($object) {

        if ($this->connect()['status'] == 'success') {
            $con = $this->connect()['data'];
        } else {
            $this->returnObject = [
                "status" => "error",
                "message" => "Nem sikerült kapcsolódni az adatbázishoz."
            ];
            return $this->returnObject;
        }

        $deletedArray = array();
        for ($i = 0; $i < count($object); $i++) {

            if ($getFeedback = $con->prepare('SELECT attachment FROM feedbacks_reply WHERE fid = ?')) {
                $getFeedback->bind_param('i', $object[$i]['fid']); $getFeedback->execute(); $getFeedback->store_result();
                $getFeedback->bind_result($ftch); $attachments = array();
                while ($getFeedback->fetch()) {
    
                    if (strlen($ftch) > 0) {
    
                        $exploded = explode(';', $ftch);
                        for ($i = 0; $i < count($exploded); $i++) {
                            array_push($attachments, $exploded[$i]);
                        }
    
                    }
    
                } $getFeedback->free_result(); $getFeedback->close();
            }
    
            if (count($attachments) > 0) {
                for ($i = 0; $i < count($attachments); $i++) {
                    if (file_exists($_SERVER['DOCUMENT_ROOT'].'/assets/images/feedbacks/' . $attachments[$i])) {
                        unlink($_SERVER['DOCUMENT_ROOT'].'/assets/images/feedbacks/' . $attachments[$i]);
                    }
                }
            }
    
            if ($deleteFeedback = $con->prepare('DELETE FROM feedbacks WHERE id = ?')) {
                $deleteFeedback->bind_param('i', $object[$i]['fid']); $deleteFeedback->execute(); $deleteFeedback->close();
    
                $log_categ = "Visszajelzés törlése"; $log_desc = "#".$_SESSION['id']." felhasználó  törölte a következő visszajelzését: #". $object[$i]['fid'];
                if ($log = $con->prepare('INSERT INTO log (uid, ip, category, description) VALUES(?,?,?,?)')) {
                    $log->bind_param('isss', $_SESSION['id'], $object[$i]['ip'], $log_categ, $log_desc); $log->execute(); $log->close(); 
                    
                    $deletedObject = new stdClass();
                    $deletedObject->fid = $object[$i]['fid'];
                    $deletedObject->ip = $object[$i]['ip'];
                    
                    array_push($deletedArray, $deletedObject);

                } else {
                    $this->returnObject = [
                        "status" => "error",
                        "message" => "Hiba történt a naplózás közben."
                    ]; return $this->returnObject;
                }
            } else {
                $this->returnObject = [
                    "status" => "error",
                    "message" => "Hiba történt a folyamat közben."
                ];
                return $this->returnObject;
            }

        }

        if (count($deletedArray) > 0) {
            $this->returnObject = [ "status" => "success" ];
            return $this->returnObject;
        } else {
            $this->returnObject = [ "status" => "empty" ];
            return $this->returnObject;
        }

    }

    function getFeedbackStatus ($object) {
     
        $requiredItems = array ('action', 'items');
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

        $statusArray = array();
        for ($i = 0; $i < count($object['items']); $i++) {

            if ($getStatus = $con->prepare('SELECT status FROM feedbacks WHERE id = ?')) {
                $getStatus->bind_param('i', $object['items'][$i]); $getStatus->execute(); $getStatus->store_result();
                $getStatus->bind_result($fstatus); $getStatus->fetch(); $getStatus->free_result(); $getStatus->close();

                $statusObject = new stdClass();
                $statusObject->fid = $object['items'][$i];
                $statusObject->status = $fstatus;

                array_push($statusArray, $statusObject);

            } else {
                $this->returnObject = [
                    "status" => "error",
                    "message" => "Hiba történt a folyamat közben."
                ];
                return $this->returnObject;
            }

        }

        if (count($statusArray) > 0) {
            $this->returnObject = [
                "status" => "success",
                "data" => $statusArray
            ];
            return $this->returnObject;
        } else {
            $this->returnObject = [
                "status" => "empty"
            ];
            return $this->returnObject;
        }


    }

    function getResults () {
        return $this->returnObject;
    }

}

$feedbackAction = new Feedback();
$returnObject = new stdClass();
$postObject = json_decode($_POST['feedback'], true);
$attachmentObject = $_FILES;

if (isset($postObject['action'])) {
    switch ($postObject['action']) {
        case 'list':
            $feedbackAction->listFeedbacks($postObject);
            die(json_encode($feedbackAction->getResults()));
        break;
        case 'listByUser':
            $feedbackAction->listFeedbacksByUser($postObject);
            die(json_encode($feedbackAction->getResults()));
        break;
        case 'listById':
            $feedbackAction->listFeedbacksById($postObject);
            die(json_encode($feedbackAction->getResults()));
        break;
        case 'send':
            $feedbackAction->sendFeedback($postObject);
            die(json_encode($feedbackAction->getResults()));
        break;
        case 'showMessage':
            $feedbackAction->showMessage($postObject);
            die(json_encode($feedbackAction->getResults()));
        break;
        case 'delete':
            $feedbackAction->deleteFeedback($postObject);
            die(json_encode($feedbackAction->getResults()));
        break;
        case 'status':
            $feedbackAction->getFeedbackStatus($postObject);
            die(json_encode($feedbackAction->getResults()));
        break;
        default:
            $returnObject->status = "error"; $returnObject->message = "Érvénytelen kérés.";
            die(json_encode($returnObject));
        break;
    }
} else {
    if (count($attachmentObject) > 0 || isset($_POST['message']) === true) {
        $insertObject = $_POST;
        $feedbackAction->insertImagesToFeedback($insertObject, $attachmentObject);
        die(json_encode($feedbackAction->getResults()));
    } else {
        $returnObject->status = "error"; $returnObject->message = "Hiányzó adatok.";
        die(json_encode(($returnObject)));
    }

}