<?php require_once($_SERVER['DOCUMENT_ROOT'].'/includes/header.php'); ?>


<div class='flex flex-align-c flex-justify-con-c flex-col error-con'>
    <div class='error-title'>
        <h1>500</h1>
    </div>
    <div class='error-desc flex flex-align-c flex-justify-con-c flex-col'>
        <span class='error-desc-title'>Belső Szerverhiba</span>
        <span class='error-desc-desc'>Belső szerverhibát tapasztalunk. Kérlek, próbáld újra később.</span>
    </div>
    <div class='error-button-container'>
        <span class='button button-primary' onclick="window.location.href='/';">Kezdőlap</span>
        <span class='button button-secondary' onclick="window.location.href='/browse';">Webshop</span>
    </div>
</div>


<?php require_once($_SERVER['DOCUMENT_ROOT'].'/includes/footer.php'); ?>