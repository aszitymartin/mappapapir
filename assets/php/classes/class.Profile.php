<?php require_once($_SERVER['DOCUMENT_ROOT'].'/includes/inc.php');

// ini_set('display_errors', 1); ini_set('display_startup_errors', 1); error_reporting(E_ALL);

Class Profile {

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

    function showActivity ($object) {

        $requiredItems = array ('action', 'uid', 'time');
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

        if ($profileActivity = $con->prepare('SELECT id, ip, category, description, date FROM log WHERE uid = ?')) {
            $profileActivity->bind_param('i', $object['uid']); $profileActivity->execute(); $profileActivity->store_result();
            if ($profileActivity->num_rows > 0) {
                $profileArray = array();
                while ($profileActivity->fetch()) {
                    $profileActivity->bind_result($id, $ip, $category, $description, $date); $profileActivity->fetch();
                    $activityObject = new stdClass();
                    $activityObject->id = $id; $activityObject->ip = $ip; $activityObject->category = $category; $activityObject->description = $description; $activityObject->date = $date;
                    array_push($profileArray, $activityObject);
                }
                $this->returnObject = [
                    "status" => "success",
                    "items" => $profileArray
                ];
                return $this->returnObject;
            } else {
                $this->returnObject = [
                    "status" => "empty"
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

    function getResults () {
        return $this->returnObject;
    }

}

$profileAction = new Profile();
$returnObject = new stdClass();

$postObject = json_decode($_POST['profile'], true);

if (isset($postObject['action'])) {
    switch ($postObject['action']) {
        case 'activity':
            $profileAction->showActivity($postObject);
            die(json_encode($profileAction->getResults()));
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