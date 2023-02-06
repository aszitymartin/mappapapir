<?php require_once($_SERVER['DOCUMENT_ROOT'].'/includes/inc.php');

class ManageOrder {

    public $exitStatus;

    function changeStatus ($status) {
        $this->exitStatus = "success";
    }

}

?>