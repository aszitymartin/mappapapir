<?php require_once($_SERVER['DOCUMENT_ROOT'].'/includes/inc.php');

Class Themes {

    public $returnObject;

    function setTheme ($theme, $uid) {
        include($_SERVER['DOCUMENT_ROOT'].'/includes/inc.connect.php');
        
        if($setUserTheme = $con->prepare("UPDATE customers SET theme = ? WHERE id = ?")) {
            $setUserTheme->bind_param('si', $theme, $uid);$setUserTheme->execute();
            $this->returnObject = [
                "status" => "success",
                "theme" => $theme
            ];
        } else {
            $this->returnObject = [
                "status" => "error",
                "message" => "Hiba történt a téma megváltoztatás közben."
            ];
        }
        
    }

    function getTheme ($uid) {
        include($_SERVER['DOCUMENT_ROOT'].'/includes/inc.connect.php');
        if($getUserTheme = $con->prepare("SELECT theme FROM customers WHERE id = ?")) {
            $getUserTheme->bind_param('i', $uid); $getUserTheme->execute(); $getUserTheme->store_result(); $getUserTheme->bind_result($userTheme); $getUserTheme->fetch(); $getUserTheme->close();
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
$postObject = json_decode($_POST['theme'], true);

if (isset($postObject['uid']) && isset($postObject['action'])) {
    switch ($postObject['action']) {
        case 'set' :
            $themeAction->setTheme($postObject['theme'], $postObject['uid']);
            die(json_encode($themeAction->getResults()));
        break;
        case 'get' :
            $themeAction->getTheme($postObject['uid']);
            die(json_encode($themeAction->getResults()));
        break;
    }
} else {
    $returnObject->status = "error"; $returnObject->message = "Hiányzó adatok.";
    die(json_encode($returnObject));
}

?>