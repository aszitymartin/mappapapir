<?php require_once($_SERVER['DOCUMENT_ROOT'].'/includes/inc.php');

class ManageOrder {

    public $returnObject;

    function changeStatus ($status, $oid, $ip) {

        include($_SERVER['DOCUMENT_ROOT'].'/includes/inc.connect.php');

        if ($updateOrderStatus = $con->prepare('UPDATE orders SET status = ? WHERE id = ?')) {
            $updateOrderStatus->bind_param('si', $status, $oid); $updateOrderStatus->execute(); $updateOrderStatus->close();
            $this->returnObject = [
                "status" => "success",
                "changes" => [
                    "status" => $status,
                    "oid" => $oid
                ]
            ];
            $log_categ = "Rendelés szerkesztése"; $log_desc = "#".$oid." Rendelés státusza módosítva lett: -> ".$status;
            $log = $con->prepare("INSERT INTO log (uid, ip, category, description) VALUES (?, ?, ?, ?)");
            $log->bind_param('isss', $_SESSION['id'], $ip, $log_categ, $log_desc); $log->execute(); $log->free_result(); $log->close();
        } else { $this->returnObject = [ "status" => "error", "message" => "Hiba történt a rendelés státuszának módosítása közben." ]; }

    }

    // function changeOrderDetails () {

    // }

    // function changeUserDetails () {

    // }
    
    // function changeInvoiceDetails () {
        
    // }

    // function changeShippingDetails () {

    // }


    function getManageResult () {
        return $this->returnObject;
    }

}

$orderData = json_decode($_POST['order'], true);
$manageOrders = new ManageOrder();

switch ($orderData['option']) {
    case "changeStatus":
        $manageOrders->changeStatus($orderData['status'], $orderData['oid'], $orderData['ip']);
        die(json_encode($manageOrders->getManageResult()));
    break;
    default :
        die(json_decode([ "status" => "error", "message" => "Ismeretlen művelet." ]));
    break;
}

?>