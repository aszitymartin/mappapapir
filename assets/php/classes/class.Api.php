<?php require_once($_SERVER['DOCUMENT_ROOT'].'/includes/inc.php');

// ini_set('display_errors', 1); ini_set('display_startup_errors', 1); error_reporting(E_ALL);

Class Api {

    public $returnObject;

    function getResults () {
        return $this->returnObject;
    }

    function getUserIp () {

        $url = 'https://api.ipdata.co?api-key=739837e232548988c86b954108794b57bd3e1dbcd6eb550bfa53e544';
        $data = [
        'api-key' => '739837e232548988c86b954108794b57bd3e1dbcd6eb550bfa53e544'
        ];
        $curl = curl_init($url);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_POST, false);
        curl_setopt($curl, CURLOPT_HTTPHEADER, [
        'X-RapidAPI-Host: https://api.ipdata.co?api-key=739837e232548988c86b954108794b57bd3e1dbcd6eb550bfa53e544',
        'X-RapidAPI-Key: 739837e232548988c86b954108794b57bd3e1dbcd6eb550bfa53e544',
        'Content-Type: application/json'
        ]);
        $response = curl_exec($curl);
        curl_close($curl);
        $resp = json_decode($response, true);

        $this->returnObject = [
            "ip" => $resp['ip'],
            "city" => $resp['city']
        ];
        return $this->returnObject;

    }

}

// $apiAction = new Api();
// $apiAction->getUserIp();
// die(json_encode($apiAction->getResults()));

?>