<?php require_once($_SERVER['DOCUMENT_ROOT'].'/includes/inc.php');

Class Themes {

    public $returnObject;

    function setTheme ($theme, $uid) {
        $DATABASE_HOST = 'localhost';$DATABASE_USER = 'root';$DATABASE_PASS = 'eKi=0630OG';$DATABASE_NAME = 'mappapapir'; $con = mysqli_connect($DATABASE_HOST, $DATABASE_USER, $DATABASE_PASS, $DATABASE_NAME);
        
        if($setUserTheme = $con->prepare("UPDATE customers SET theme = ? WHERE id = ?")) {
            $setUserTheme->bind_param('si', $_POST['theme'], $_POST['uid']);$setUserTheme->execute();
            $this->returnObject = [
                "status" => "success",
                "theme" => $_POST['theme']
            ];
        } else {
            $this->returnObject = [
                "status" => "error",
                "message" => "Hiba történt a téma megváltoztatás közben."
            ];
        }
        
    }

    function getTheme ($uid) {
        $DATABASE_HOST = 'localhost';$DATABASE_USER = 'root';$DATABASE_PASS = 'eKi=0630OG';$DATABASE_NAME = 'mappapapir'; $con = mysqli_connect($DATABASE_HOST, $DATABASE_USER, $DATABASE_PASS, $DATABASE_NAME);
        if($getUserTheme = $con->prepare("SELECT theme FROM customers WHERE id = ?")) {
            $getUserTheme->bind_param('i', $_POST['uid']); $getUserTheme->execute(); $getUserTheme->store_result(); $getUserTheme->bind_result($userTheme); $getUserTheme->fetch(); $getUserTheme->close();
            $this->returnObject = [
                "status" => "success",
                "theme" => $userTheme
            ];
        } else {
            $this->returnObject = [
                "status" => "error",
                "message" => "Hiba történt a téma lekérdezése közben."
            ];
        }
    }

    function getResults () {
        return $this->returnObject;
    }

}

$themeAction = new Themes();
$returnObject = new stdClass();
if (isset($_POST['uid']) && isset($_POST['action'])) {
    switch ($_POST['action']) {
        case 'set' :
            $themeAction->setTheme($_POST['theme'], $_POST['uid']);
            die(json_encode($themeAction->getResults()));
        break;
        case 'get' :
            $themeAction->getTheme($_POST['uid']);
            die(json_encode($themeAction->getResults()));
        break;
    }
} else {
    $returnObject->status = "error"; $returnObject->message = "Hiányzó adatok.";
    die(json_encode($returnObject));
}

?>