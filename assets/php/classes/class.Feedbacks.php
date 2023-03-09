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

        if ($stmt = $con->prepare('SELECT feedbacks.id, feedbacks.uid, feedbacks.target_id, feedbacks.title, feedbacks.description, feedbacks.image, feedbacks.type, feedbacks.status, feedbacks.created, customers.fullname, customers__header.initials, customers__header.color FROM feedbacks INNER JOIN customers ON customers.id = feedbacks.uid INNER JOIN customers__header ON customers__header.uid = customers.id WHERE 1')) {
            $stmt->execute(); $stmt->store_result();
            if ($stmt->num_rows > 0) {
                $feedbacksArray = array();
                while ($stmt->fetch()) {
                    $stmt->bind_result($id, $uid, $target_id, $title, $description, $image, $type, $status, $created, $name, $initials, $color); $stmt->fetch();
                    $feedbacksObject = new stdClass();
                    $feedbacksObject->id = $id; $feedbacksObject->uid = $uid;
                    $feedbacksObject->target_id = $target_id; $feedbacksObject->title = $title;
                    $feedbacksObject->description = $description; $feedbacksObject->image = $image;
                    $feedbacksObject->type = $type; $feedbacksObject->status = $status;
                    $feedbacksObject->created = $created; $feedbacksObject->name = $name;
                    $feedbacksObject->initials = $initials; $feedbacksObject->color = $color;
                    array_push($feedbacksArray, $feedbacksObject);
                }
                $this->returnObject = [
                    "status" => "success",
                    "items" => $feedbacksArray
                ];
                return $this->returnObject;
            } 
            else {
                $this->returnObject = [
                    "status" => "error",
                    "message" => "Nincsen megjeleníthető adat."
                ]; return $this->returnObject;
            } $stmt->close();
        } else {
            $this->returnObject = [
                "status" => "error",
                "message" => "Hiba történt a feldolgozás közben."
            ]; return $this->returnObject;
        } $con->close();

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
        default:
            $returnObject->status = "error"; $returnObject->message = "Érvénytelen kérés.";
            die(json_encode($returnObject));
        break;
    }
} else {
    $returnObject->status = "error"; $returnObject->message = "Hiányzó adatok.";
    die(json_encode(($returnObject)));
}