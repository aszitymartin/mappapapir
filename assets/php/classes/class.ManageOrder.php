<?php require_once($_SERVER['DOCUMENT_ROOT'].'/includes/inc.php');

class ManageOrder {

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

    function getInvoiceDetails ($object) {

        $requiredItems = array ('uid', 'oid');
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

        

    }

    function changeStatus ($status, $oid, $ip) {

        if ($this->connect()['status'] == 'success') {
            $con = $this->connect()['data'];
        } else {
            $this->returnObject = [
                "status" => "error",
                "message" => "Nem sikerült kapcsolódni az adatbázishoz."
            ];
            return $this->returnObject;
        }

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
    
    function changeInvoiceDetails () {
     
        $requiredItems = array ('uid', 'oid');
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

    }

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