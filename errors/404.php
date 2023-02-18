<?php require_once($_SERVER['DOCUMENT_ROOT'].'/includes/header.php'); ?>


<div class='flex flex-align-c flex-justify-con-c flex-col error-con'>
    <div class='error-title'>
        <h1>404</h1>
    </div>
    <div class='error-desc flex flex-align-c flex-justify-con-c flex-col'>
        <span class='error-desc-title'>Oldal nem található</span>
        <span class='error-desc-desc'>Előfordulhat, hogy a keresett oldalt eltávolították, megváltoztatták a nevét, vagy átmenetileg nem elérhető.</span>
    </div>
    <div class='error-button-container'>
        <span class='button button-primary' onclick="window.location.href='/';">Kezdőlap</span>
        <span class='button button-secondary' onclick="window.location.href='/browse';">Webshop</span>
    </div>
</div>


<?php require_once($_SERVER['DOCUMENT_ROOT'].'/includes/footer.php'); ?>