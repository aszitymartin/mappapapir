<?php require_once($_SERVER['DOCUMENT_ROOT'].'/includes/inc.php');

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

        $sql = 'SELECT feedbacks.id, feedbacks.uid, feedbacks.title, feedbacks.type, feedbacks.status, feedbacks.created, customers.fullname, customers__header.initials, customers__header.color FROM feedbacks INNER JOIN customers ON customers.id = feedbacks.uid INNER JOIN customers__header ON customers__header.uid = customers.id WHERE 1 ORDER BY feedbacks.created DESC';
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
                "status" => "error",
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
                "status" => "error",
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
            $sql->bind_param('isi', $object['uid'], $object['title'], $object['type']);
            $sql->execute(); $lastId = $con->insert_id; $sql->close();

            $log_categ = "Visszajelzés küldése"; $log_desc = "#".$uid." felhasználó  új visszajelzést küldött.";
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

        if ($sql = $con->prepare('INSERT INTO feedbacks_reply (fid, uid, message, attachment) VALUES (?, ?, ?, ?)')) {
            $formatted_attachments = []; for ($i = 0; $i < count($attachment); $i++) { if (check(basename($attachment['atch' . ($i + 1)]['type']))) { array_push($formatted_attachments, upload($attachment['atch' . ($i + 1)])); } }
            $attachments = implode(';', $formatted_attachments);
            $sql->bind_param('iiss', $object['fid'], $object['uid'], $object['message'], $attachments);
            $sql->execute(); $sql->close(); $this->returnObject = [ "status" => "success" ]; return $this->returnObject;
        } else {
            $this->returnObject = [
                "status" => "error",
                "message" => "Hiba történt a folyamat közben."
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
        case 'send':
            $feedbackAction->sendFeedback($postObject);
            die(json_encode($feedbackAction->getResults()));
        break;
        default:
            $returnObject->status = "error"; $returnObject->message = "Érvénytelen kérés.";
            die(json_encode($returnObject));
        break;
    }
} else {
    if (count($attachmentObject) > 0) {
        $insertObject = $_POST;
        $feedbackAction->insertImagesToFeedback($insertObject, $attachmentObject);
        die(json_encode($feedbackAction->getResults()));
    } else {
        $returnObject->status = "error"; $returnObject->message = "Hiányzó adatok.";
        die(json_encode(($returnObject)));
    }

}