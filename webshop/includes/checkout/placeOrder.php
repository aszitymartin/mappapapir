<?php
$jsonUserData = json_decode($_POST['items'], true);
die(print_r($jsonUserData));

?>