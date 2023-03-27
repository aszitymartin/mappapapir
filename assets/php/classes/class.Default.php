<?php require_once($_SERVER['DOCUMENT_ROOT'].'/includes/inc.php');

ini_set('display_errors', 1); ini_set('display_startup_errors', 1); error_reporting(E_ALL);

class Page {

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

    private function log ($object) {

        if ($this->connect()['status'] == 'success') {
            $con = $this->connect()['data'];
        } else {
            $this->returnObject = [
                "status" => "error",
                "message" => "Nem sikerült kapcsolódni az adatbázishoz."
            ];
            return $this->returnObject;
        }

        if ($log = $con->prepare('INSERT INTO log (uid, ip, category, description) VALUES(?,?,?,?)')) {
            $log->bind_param('isss', $_SESSION['id'], $object->ip, $object->category, $object->description); $log->execute(); $log->close(); 
            $this->returnObject = [
                "status" => "success"
            ]; return $this->returnObject;
        } else {
            $this->returnObject = [
                "status" => "error",
                "message" => "Hiba történt a naplózás közben."
            ]; return $this->returnObject;
        }

    }

    function listHeaderLinks () {

        if ($this->connect()['status'] == 'success') {
            $con = $this->connect()['data'];
        } else {
            $this->returnObject = [
                "status" => "error",
                "message" => "Nem sikerült kapcsolódni az adatbázishoz."
            ];
            return $this->returnObject;
        }

        if ($listHeaderLinks = $con->prepare('SELECT links FROM def__header')) {
            $listHeaderLinks->execute(); $listHeaderLinks->store_result(); $listHeaderLinks->bind_result($links); $listHeaderLinks->fetch();

            $this->returnObject = [
                "status" => "success",
                "data" => $links
            ];
            return $this->returnObject;

        }

    }

    function changeHeaderLink ($object) {

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

        $items_array = array();
        for ($i = 0; $i < count($object['items']); $i++) {
            array_push($items_array, 
                $object['items'][$i]['name'] . '=' . $object['items'][$i]['link']
            );
        }

        $imploded_links = implode(';', $items_array);

        if ($changeLinks = $con->prepare('UPDATE def__header SET links = ?')) {
            $changeLinks->bind_param('s', $imploded_links); $changeLinks->execute(); $changeLinks->store_result(); $changeLinks->close();

            $logData = new stdClass();
            $logData->ip = $object['ip'];
            $logData->category = 'Fejléc linkek szerkesztése';
            $logData->description = '#' . $_SESSION['id'] . ' felhasználó módosította a fejléc linkeket : ' . $imploded_links;

            $this->log($logData);

        } else {
            $this->returnObject = [
                "status" => "error",
                "message" => "Hiba történt a folyamat közben."
            ];
            return $this->returnObject;
        }

    }

    function changeWebmaster ($object) {

        $requiredItems = array ('action', 'name', 'email', 'ip');
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

        if ($changeWebmaster = $con->prepare('UPDATE def__page SET webmester = ?, email = ?')) {
            $changeWebmaster->bind_param('ss', $object['name'], $object['email']); $changeWebmaster->execute(); $changeWebmaster->store_result();

            $logData = new stdClass();
            $logData->ip = $object['ip'];
            $logData->category = 'Webmester adatainak módosítása';
            $logData->description = '#' . $_SESSION['id'] . ' felhasználó módosította a webmesteri elérhetőségeket';

            $this->log($logData);

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

$defultAction = new Page();
$returnObject = new stdClass();

$postObject = json_decode($_POST['default'], true);

if (isset($postObject['action'])) {
    switch ($postObject['action']) {
        case 'changeHeaderLink':
            $defultAction->changeHeaderLink($postObject);
            die(json_encode($defultAction->getResults()));
        break;
        case 'listHeaderLinks':
            $defultAction->listHeaderLinks();
            die(json_encode($defultAction->getResults()));
        break;
        case 'changeWebmaster':
            $defultAction->changeWebmaster($postObject);
            die(json_encode($defultAction->getResults()));
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