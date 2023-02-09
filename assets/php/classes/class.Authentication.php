<?php require_once($_SERVER['DOCUMENT_ROOT'].'/includes/inc.php');

Class Authentication {

    public $returnObject;

    function loginUser ($object) {

    }

    function registerUser ($object) {

    }

    function logOutUser ($object) {
        
    }

    function getResults () {
        return $this->returnObject;
    }

}

/*

    loginUser:
        $object = [
            email
            password
            city
            country
            device
            ip
        ];

*/

?>