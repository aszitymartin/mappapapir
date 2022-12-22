<?php
$jsonUserData = json_decode($_POST['user'], true);
die(print_r($jsonUserData));

?>