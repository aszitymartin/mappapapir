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

        $sql = 'SELECT feedbacks.id, feedbacks.uid, feedbacks.title, feedbacks.description, feedbacks.image, feedbacks.type, feedbacks.status, feedbacks.created, customers.fullname, customers__header.initials, customers__header.color FROM feedbacks INNER JOIN customers ON customers.id = feedbacks.uid INNER JOIN customers__header ON customers__header.uid = customers.id WHERE 1';
        $stmt = $con->query($sql);
        if ($stmt->num_rows > 0) { $feedbacksArray = array();
            while ($fd = $stmt->fetch_assoc()) {
                $feedbacksObject = new stdClass();
                $feedbacksObject->id = $fd['id'];
                $feedbacksObject->uid = $fd['uid'];
                $feedbacksObject->title = $fd['title'];
                $feedbacksObject->description = $fd['description'];
                $feedbacksObject->image = $fd['image'];
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

        $sql = 'SELECT feedbacks.id, feedbacks.uid, feedbacks.title, feedbacks.description, feedbacks.image, feedbacks.type, feedbacks.status, feedbacks.created, customers.fullname, customers__header.initials, customers__header.color FROM feedbacks INNER JOIN customers ON customers.id = feedbacks.uid INNER JOIN customers__header ON customers__header.uid = customers.id WHERE feedbacks.uid = ' . $object['uid'];
        $stmt = $con->query($sql);
        if ($stmt->num_rows > 0) { $feedbacksArray = array();
            while ($fd = $stmt->fetch_assoc()) {
                $feedbacksObject = new stdClass();
                $feedbacksObject->id = $fd['id'];
                $feedbacksObject->uid = $fd['uid'];
                $feedbacksObject->title = $fd['title'];
                $feedbacksObject->description = $fd['description'];
                $feedbacksObject->image = $fd['image'];
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

        ini_set('display_errors', 1); ini_set('display_startup_errors', 1); error_reporting(E_ALL);

        // die(print_r($object['attachment'][0]['prop']));

        $this->returnObject = [
            "status" => "error",
            "data" => $object
        ];
        return $this->returnObject;

        $requiredItems = array ('action', 'uid', 'title', 'description', 'type', 'attachment');
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

        if ($sql = $con->prepare('INSERT INTO feedbacks (uid, title, description, image, type, status) VALUES (?, ?, ?, ?, ?, 0)')) {
            $sql->bind_param('isssi', $object['uid'], $object['title'], $object['description'], $object['image'], $object['type']);
            $sql->execute(); $sql->close();
        } else {
            $this->returnObject = [
                "status" => "error",
                "message" => "Hiba történt a folyamat közben."
            ];
            return $this->returnObject;
        }

        // LOGOLAS !!

    }

    function getResults () {
        return $this->returnObject;
    }

}

$feedbackAction = new Feedback();
$returnObject = new stdClass();
$postObject = json_decode($_POST['feedback'], true);

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
    $returnObject->status = "error"; $returnObject->message = "Hiányzó adatok.";
    die(json_encode(($returnObject)));
}