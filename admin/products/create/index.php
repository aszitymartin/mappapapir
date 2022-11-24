<?php require_once($_SERVER['DOCUMENT_ROOT'].'/includes/header.php'); if (!isset($_SESSION['loggedin'])) { echo "<script>window.location.href='/';</script>"; die(); } ?>
<script>var formatter = new Intl.NumberFormat('hu-HU', {style: 'currency',currency: 'HUF',maximumFractionDigits: 0,minimumFractionDigits: 0});</script>
<main id="main">
<div class="prod-con" id="tabs">
    <div class="w-fa">
        <div class="flex flex-row flex-align-c padding-1 padding-l-0 padding-b-0">
            <span class="text-muted small-med"><a class="link link-color pointer" href="/admin/">Admin</a> / <a class="link link-color pointer" href="/admin/?tab=products">Termékek</a> / <a class="text-muted">Létrehozás</a></span>
        </div>
        <div class="flex flex-row flex-align-c gap-2 padding-1 padding-l-0 text-muted user-select-none">
            <span onclick="showPanel(event, 'tab-general')" id="tabs-general" tab-data="general" class="pr__item padding-b-1 pointer relative">Általános <span id="tabs-general-badge"></span></span>
            <span onclick="showPanel(event, 'tab-advanced')" id="tabs-advanced" tab-data="advanced" class="pr__item padding-b-1 pointer relative">Haladó <span id="tabs-advanced-badge"></span></span>
            <span onclick="showPanel(event, 'tab-reviews')" id="tabs-reviews" tab-data="reviews" class="pr__item padding-b-1 pointer relative">Vélemények</span>
            <span onclick="showPanel(event, 'tab-save')" id="tabs-save" tab-data="save" class="pr__item padding-b-1 pointer relative">Mentés</span>
            <span onclick="showPanel(event, 'tab-import')" id="tabs-import" tab-data="import" class="pr__item padding-b-1 pointer relative">Importálás</span>
        </div>
        <div id="tab-general" class="tab__content flex-col card gap-1" style="background: transparent; padding: 0;"></div>
        <div id="tab-advanced" class="tab__content flex-col card gap-1" style="background: transparent; padding: 0;"></div>
        <div id="tab-reviews" class="tab__content flex-col card gap-1" style="background: transparent; padding: 0;"></div>
        <div id="tab-save" class="tab__content flex-col card gap-1" style="background: transparent; padding: 0;"></div>
        <div id="tab-import" class="tab__content flex-col card gap-1" style="background: transparent; padding: 0;"></div>
    </div>
</div>
</main>
<script src="/assets/script/admin/create.js" content-type="application/javascript"></script>
<script src="/assets/script/quill/dist/quill.js"></script><script src="/assets/script/tagify/dist/tagify.js"></script>
<?php require_once($_SERVER['DOCUMENT_ROOT'].'/includes/footer.php'); ?>