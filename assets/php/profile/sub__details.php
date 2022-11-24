<?php
if ($_POST['subid'] == 1) { $avl__free = new stdClass(); $det__free = array();
    $avl__free->available = ["Akár 4 igénybevehető kártya", "30 000 Ft felhasználhatóság", "Értesítés küldés tranzakció esetén", "Tranzakció előzmények elmentése"];
    array_push($det__free, $avl__free); die(json_encode($det__free));
} if ($_POST['subid'] == 2) { $avl__loyal = new stdClass(); $det__loyal = array();
    $avl__loyal->available = ["Akár 8 igénybevehető kártya", "50 000 Ft felhasználhatóság", "Azonos kártyatípusok használata", "Hely felszabadítása törölt kártyák esetén"];
    array_push($det__loyal, $avl__loyal); die(json_encode($det__loyal));
} if ($_POST['subid'] == 3) { $avl__enterprise = new stdClass(); $det__enterprise = array();
    $avl__enterprise->available = ["Akár 16 igénybevehető kártya", "75 000 Ft felhasználhatóság", "Másodlagos kártya funkció használata", "Statisztika vásárlási szokásairól"];
    array_push($det__enterprise, $avl__enterprise); die(json_encode($det__enterprise));
}
?>