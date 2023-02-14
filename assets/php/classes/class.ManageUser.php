<?php require_once($_SERVER['DOCUMENT_ROOT'].'/includes/inc.php');

class ManageOrder {

    public $returnObject;

    function deleteUser ($object) {

    }

    function deactivateUser ($object) {

    }


    function getManageResult () {
        return $this->returnObject;
    }

}

// $orderData = json_decode($_POST['order'], true);
// $manageOrders = new ManageOrder();

// switch ($orderData['option']) {
//     case "changeStatus":
//         $manageOrders->changeStatus($orderData['status'], $orderData['oid'], $orderData['ip']);
//         die(json_encode($manageOrders->getManageResult()));
//     break;
//     default :
//         die(json_decode([ "status" => "error", "message" => "Ismeretlen művelet." ]));
//     break;
// }

?>