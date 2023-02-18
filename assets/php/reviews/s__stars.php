<?php
include($_SERVER['DOCUMENT_ROOT'].'/includes/inc.connect.php');
if (mysqli_connect_errno()) {die ("0"); } $pid = $_POST['pid']; $sql = "SELECT * FROM reviews WHERE pid = $pid";
if ($result = mysqli_query($con, $sql)) { $num = mysqli_num_rows($result);
    if ($num > 0) { $s__sql = "SELECT * FROM reviews WHERE pid = $pid";
        if ($s__result = mysqli_query($con, $s__sql)) { $object = new stdClass();
            while($row = mysqli_fetch_array($s__result)) { 
                if ($row['stars'] == 5) { $sql = "SELECT * FROM reviews WHERE pid = $pid AND stars = 5";
                    if ($result = mysqli_query($con, $sql)) {$num = mysqli_num_rows($result); if ($num > 0) {$object->five = $num;} }
                } if ($row['stars'] == 4) { $sql = "SELECT * FROM reviews WHERE pid = $pid AND stars = 4";
                    if ($result = mysqli_query($con, $sql)) {$num = mysqli_num_rows($result); if ($num > 0) {$object->four = $num;} }
                } if ($row['stars'] == 3) { $sql = "SELECT * FROM reviews WHERE pid = $pid AND stars = 3";
                    if ($result = mysqli_query($con, $sql)) {$num = mysqli_num_rows($result); if ($num > 0) {$object->three = $num;} }
                } if ($row['stars'] == 2) { $sql = "SELECT * FROM reviews WHERE pid = $pid AND stars = 2";
                    if ($result = mysqli_query($con, $sql)) {$num = mysqli_num_rows($result); if ($num > 0) {$object->two = $num;} }
                } if ($row['stars'] == 1) { $sql = "SELECT * FROM reviews WHERE pid = $pid AND stars = 1";
                    if ($result = mysqli_query($con, $sql)) {$num = mysqli_num_rows($result); if ($num > 0) {$object->one = $num;} }
                }
            } die(json_encode($object));
        }
    } else { echo false; die(); }
}
?>