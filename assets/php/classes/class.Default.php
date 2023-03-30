<?php require_once($_SERVER['DOCUMENT_ROOT'].'/includes/inc.php');

// ini_set('display_errors', 1); ini_set('display_startup_errors', 1); error_reporting(E_ALL);

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

    function changeMetaTags ($object) {

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
                $object['items'][$i]['name'] . '=' . $object['items'][$i]['content']
            );
        }

        $imploded_links = implode(';', $items_array);

        if ($changeLinks = $con->prepare('UPDATE def__page SET meta = ?')) {
            $changeLinks->bind_param('s', $imploded_links); $changeLinks->execute(); $changeLinks->store_result(); $changeLinks->close();

            $logData = new stdClass();
            $logData->ip = $object['ip'];
            $logData->category = 'Meta tagok szerkesztése';
            $logData->description = '#' . $_SESSION['id'] . ' felhasználó módosította a meta tagokat : ' . $imploded_links;

            $this->log($logData);

        } else {
            $this->returnObject = [
                "status" => "error",
                "message" => "Hiba történt a folyamat közben."
            ];
            return $this->returnObject;
        }

    }

    function changeDefault ($object) {

        $requiredItems = array ('action', 'name', 'posy', 'desc', 'ip');
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

        if ($changeWebmaster = $con->prepare('UPDATE def__page SET title = ?, posy = ?, description = ?')) {
            $changeWebmaster->bind_param('sss', $object['name'], $object['posy'], $object['desc']); $changeWebmaster->execute(); $changeWebmaster->store_result();

            $logData = new stdClass();
            $logData->ip = $object['ip'];
            $logData->category = 'Oldal adatainak módosítása';
            $logData->description = '#' . $_SESSION['id'] . ' felhasználó módosította az oldal adatait.';

            $this->log($logData);

        } else {
            $this->returnObject = [
                "status" => "error",
                "message" => "Hiba történt a folyamat közben."
            ];
            return $this->returnObject;
        }

    }

    function listPageIcons () {

        if ($this->connect()['status'] == 'success') {
            $con = $this->connect()['data'];
        } else {
            $this->returnObject = [
                "status" => "error",
                "message" => "Nem sikerült kapcsolódni az adatbázishoz."
            ];
            return $this->returnObject;
        }

        $files_array = array();

        $path = $_SERVER['DOCUMENT_ROOT'] . '/assets/images/default/';
        $images = glob($path."*");
        foreach($images as $image) {
            $image_name = explode('/', $image)[count(explode('/', $image)) - 1];
            $image_date = explode('-', $image_name)[0];
            $image_creator = explode('-', $image_name)[1];
            $image_ext = explode('.', $image_name)[1];

            $image_date_year = substr($image_date, 0, 4); $image_date_month = substr($image_date, 4, 2);
            $image_date_day = substr($image_date, 6, 2); $image_date_hour = substr($image_date, 8, 2);
            $image_date_min = substr($image_date, 10, 2); $image_date_sec = substr($image_date, 12, 2);
            $d=mktime($image_date_hour, $image_date_min, $image_date_sec, $image_date_month, $image_date_day, $image_date_year);
            $file_created = date("Y-m-d H:i:s", $d);

            if ($getCreator = $con->prepare('SELECT fullname FROM customers WHERE id = ?')) {
                $getCreator->bind_param('i', $image_creator); $getCreator->execute(); $getCreator->store_result();
                $getCreator->bind_result($creator_name); $getCreator->fetch();
                $images = new stdClass();
                $images->name = $image_name;
                $images->created = $file_created;
                $images->creator = $creator_name;
                $images->ext = $image_ext;

                array_push($files_array, $images);

            } else {
                $this->returnObject = [
                    "status" => "error",
                    "message" => "Hiba történt a folyamat közben."
                ];
                return $this->returnObject;
            }

        }

        if (count($files_array) > 0) {
            $this->returnObject = [
                "status" => "success",
                "data" => $files_array
            ];
            return $this->returnObject;
        } else {
            $this->returnObject = [
                "status" => "empty"
            ];
            return $this->returnObject;
        }

    }

    function changePageIcon ($object, $attachment) {

        function check ($type) { $exten = ['png', 'jpg', 'jpeg', 'ico', 'svg', 'gif']; if (in_array($type, $exten)) { return 'true'; } else { return 'false'; } }
        function upload ($file) { $target_dir = $_SERVER['DOCUMENT_ROOT'].'/assets/images/default/'; $name = basename($file['name']); $type = $file['type']; $tmp = $file['tmp_name']; $doc = date('YmdHis') . '-' . $_SESSION['id'] . '.' . basename($type); if (move_uploaded_file($tmp, $target_dir . '' . $doc)) { return $doc; } else { return false; } }

        $requiredItems = array ('ip');
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

        if ($sql = $con->prepare('UPDATE def__page SET icon = ?')) {
            $icon = upload($attachment['icon']);
            $sql->bind_param('s', $icon);
            $sql->execute(); $sql->close();
            
            $logData = new stdClass();
            $logData->ip = $object['ip'];
            $logData->category = 'Oldal ikonjának módosítása';
            $logData->description = '#' . $_SESSION['id'] . ' felhasználó módosította az oldal ikonját: ' . $icon;

            $this->log($logData);

        } else {
            $this->returnObject = [
                "status" => "error",
                "message" => "Hiba történt a folyamat közben."
            ];
            return $this->returnObject;
        }

    }

    function changeIconFromHistory ($object) {

        $requiredItems = array ('action', 'name', 'ip');
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

        $icons = $this->listPageIcons()['data'];

        for ($i = 0; $i < count($icons); $i++) {

            if ($icons[$i]->name == $object['name']) {
                if ($sql = $con->prepare('UPDATE def__page SET icon = ?')) {
                    $sql->bind_param('s', $object['name']);
                    $sql->execute(); $sql->close();
                    
                    $logData = new stdClass();
                    $logData->ip = $object['ip'];
                    $logData->category = 'Oldal ikonjának módosítása';
                    $logData->description = '#' . $_SESSION['id'] . ' felhasználó módosította az oldal ikonját: ' . $object['name'];
        
                    $this->log($logData);
        
                } else {
                    $this->returnObject = [
                        "status" => "error",
                        "message" => "Hiba történt a folyamat közben."
                    ];
                    return $this->returnObject;
                }
            }

        }

    }

    function getResults () {
        return $this->returnObject;
    }

}

$defultAction = new Page();
$returnObject = new stdClass();

$postObject = isset($_POST['default']) ? json_decode($_POST['default'], true) : '';
$attachmentObject = $_FILES;

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
        case 'changeMetaTags':
            $defultAction->changeMetaTags($postObject);
            die(json_encode($defultAction->getResults()));
        break;
        case 'changeDefault':
            $defultAction->changeDefault($postObject);
            die(json_encode($defultAction->getResults()));
        break;
        case 'listPageIcons':
            $defultAction->listPageIcons();
            die(json_encode($defultAction->getResults()));
        break;
        case 'changeIconFromHistory':
            $defultAction->changeIconFromHistory($postObject);
            die(json_encode($defultAction->getResults()));
        break;
        default:
            $returnObject->status = "error"; $returnObject->message = "Érvénytelen kérés.";
            die(json_encode($returnObject));
        break;
    }
} else {

    if (count($attachmentObject) > 0) {
        $insertObject = $_POST;
        $defultAction->changePageIcon($insertObject, $attachmentObject);
        die(json_encode($defultAction->getResults()));
    } else {
        $returnObject->status = "error"; $returnObject->message = "Hiányzó adatok.";
        die(json_encode(($returnObject)));
    }

}

?>