<?php require_once($_SERVER['DOCUMENT_ROOT'].'/includes/header.php'); ?>
<div class='flex flex-align-c flex-justify-con-c flex-col error-con'>
    <div class='error-title'>
        <h1>403</h1>
    </div>
    <div class='error-desc flex flex-align-c flex-justify-con-c flex-col'>
        <span class='error-desc-title'>Hozzáférés megtagadva!</span>
        <span class='error-desc-desc'>Nincs engedélye az elérni kívánt oldalhoz, ha úgy gondolja, hogy ez tévedés, próbálja meg felvenni a kapcsolatot a szerver adminisztrátorával.</span>
    </div>
    <div class='error-button-container'>
        <span class='button button-primary' onclick="window.location.href='/';">Kezdőlap</span>
        <span class='button button-secondary' onclick="window.location.href='/browse';">Webshop</span>
    </div>
</div>
<?php require_once($_SERVER['DOCUMENT_ROOT'].'/includes/footer.php'); ?>