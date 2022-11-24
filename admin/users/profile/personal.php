<?php require_once($_SERVER['DOCUMENT_ROOT'].'/includes/inc.php');
if (isset($_SESSION['loggedin'])) {
    $stmt = $con->prepare('SELECT privilege FROM customers__priv  WHERE uid = ?'); if (isset($_SESSION['loggedin'])) {$id = $_SESSION['id'];} $stmt->bind_param('i', $id);$stmt->execute(); $stmt->bind_result($privilege); $stmt->fetch();$stmt->close();
    if ($privilege != 2) { echo "<script>window.location.href='/';</script>"; }
} else { header("Location: /"); }
$guid = $_SESSION['guid'];
$pers_sql = "SELECT customers.fullname, customers.email, customers.phone, customers.fax, customers__inv.company, customers__inv.settlement AS 'inv__settlement', customers__inv.address AS 'inv__address', customers__inv.postal AS 'inv__postal', customers__inv.tax AS 'inv__tax', customers__ship.settlement AS 'ship__settlement', customers__ship.address AS 'ship__address', customers__ship.postal AS 'ship__postal' FROM customers INNER JOIN customers__inv ON customers__inv.uid = customers.id INNER JOIN customers__ship ON customers__ship.uid = customers.id WHERE customers.id = $guid AND customers__inv.uid = $guid AND customers__ship.uid = $guid"; $pers_res = $con-> query($pers_sql);
if ($pers_res-> num_rows > 0) { $datas = $pers_res-> fetch_assoc(); }
?>
<div class="flex flex-row-d-col-m gap-1">
    <div class="flex flex-col w-fa gap-1 border-soft item-bg box-shadow padding-1">
        <div class="flex flex-row flex-align-c flex-justify-con-sb">
            <div class="flex flex-col">
                <span class="text-primary large bold">Személyes információk</span>
            </div>
            <div class="flex flex-row flex-align-c gap-1">
                <span class="text-muted small-med pointer user-select-none link" id="prcc__personal">Mégsem</span>
                <span class="flex flex-row flex-align-c flex-justify-con-c padding-05 border-soft-light primary-bg primary-bg-hover pointer user-select-none small-med" id="prsv__personal">Mentés</span>
            </div>
        </div><hr style="border: 1px solid var(--background);" class="w-fa">
        <div class="flex flex-col gap-2 w-70d-100m">
            <div class="flex flex-col gap-1">
                <div class="flex flex-row">
                    <span class="text-primary bold">Személyes adatok</span>
                </div>
                <div class="flex flex-row-d-col-m flex-align-c prst__row">
                    <span class="text-primary small prst__trig">Teljes név</span>
                    <input type="text" data-key="fullname" class="w-60d-90m text-primary border-soft background-bg padding-1-05 outline-none border-none" name="chpr__fullname" id="chpr__fullname" value="<?php echo $datas['fullname']; ?>" placeholder="Minta Misi" autocomplete="name" />
                </div>
                <div class="flex flex-row-d-col-m flex-align-c prst__row">
                    <span class="text-primary small prst__trig">Cég neve</span>
                    <input type="text" data-key="inv__company" class="w-60d-90m text-primary border-soft background-bg padding-1-05 outline-none border-none" name="chpr__company" id="chpr__company" value="<?php echo $datas['company']; ?>" placeholder="Minta Kft." autocomplete='organization' />
                </div>
            </div>
            <div class="flex flex-col gap-1">
                <div class="flex flex-row">
                    <span class="text-primary bold">Kapcsolattartási adatok</span>
                </div>
                <div class="flex flex-row-d-col-m flex-align-c prst__row">
                    <span class="text-primary small prst__trig">Telefonszám</span>
                    <input type="tel" data-key="phone" class="w-60d-90m text-primary border-soft background-bg padding-1-05 outline-none border-none" name="chpr__phone" id="chpr__phone" value="<?php echo $datas['phone']; ?>" placeholder="30 123 4567" autocomplete='tel' />
                </div>
                <div class="flex flex-row-d-col-m flex-align-c prst__row">
                    <span class="text-primary small prst__trig">Fax szám</span>
                    <input type="number" data-key="fax" class="w-60d-90m text-primary border-soft background-bg padding-1-05 outline-none border-none" name="chpr__fax" id="chpr__fax" value="<?php echo $datas['fax']; ?>" placeholder="123456789" autocomplete='off' />
                </div>
            </div>
            <div class="flex flex-col gap-1">
                <div class="flex flex-row">
                    <span class="text-primary bold">Számlázási adatok</span>
                </div>
                <div class="flex flex-row-d-col-m flex-align-c prst__row">
                    <span class="text-primary small prst__trig">Település</span>
                    <input type="text" data-key="inv__settlement" class="w-60d-90m text-primary border-soft background-bg padding-1-05 outline-none border-none" name="chpr__settlement" id="chpr__settlement" value="<?php echo $datas['inv__settlement']; ?>" placeholder="Kecskemét" autocomplete='address-level2' />
                </div>
                <div class="flex flex-row-d-col-m flex-align-c prst__row">
                    <span class="text-primary small prst__trig">Cím</span>
                    <input type="text" data-key="inv__address" class="w-60d-90m text-primary border-soft background-bg padding-1-05 outline-none border-none" name="chpr__address" id="chpr__address" value="<?php echo $datas['inv__address']; ?>" placeholder="Minta utca 1." autocomplete='address-line1' />
                </div>
                <div class="flex flex-row-d-col-m flex-align-c prst__row">
                    <span class="text-primary small prst__trig">Irányítószám</span>
                    <input type="number" data-key="inv__postal" class="w-60d-90m text-primary border-soft background-bg padding-1-05 outline-none border-none" name="chpr__postal" id="chpr__postal" value="<?php echo $datas['inv__postal']; ?>" placeholder="6000" autocomplete='postal-code' />
                </div>
                <div class="flex flex-row-d-col-m flex-align-c prst__row">
                    <span class="text-primary small prst__trig">Adószám</span>
                    <input type="number" data-key="inv__tax" class="w-60d-90m text-primary border-soft background-bg padding-1-05 outline-none border-none" name="chpr__tax" id="chpr__tax" value="<?php echo $datas['inv__tax']; ?>" placeholder="123456789" autocomplete='off' />
                </div>
            </div>
            <div class="flex flex-col gap-1">
                <div class="flex flex-row">
                    <span class="text-primary bold">Szállítási adatok</span>
                </div>
                <div class="flex flex-row-d-col-m flex-align-c prst__row">
                    <span class="text-primary small prst__trig">Település</span>
                    <input type="text" data-key="ship__settlement" class="w-60d-90m text-primary border-soft background-bg padding-1-05 outline-none border-none" name="chpr__sh__settlement" id="chpr__sh__settlement" value="<?php echo $datas['ship__settlement']; ?>" placeholder="Kecskemét" autocomplete='address-level2' />
                </div>
                <div class="flex flex-row-d-col-m flex-align-c prst__row">
                    <span class="text-primary small prst__trig">Cím</span>
                    <input type="text" data-key="ship__address" class="w-60d-90m text-primary border-soft background-bg padding-1-05 outline-none border-none" name="chpr__sh__address" id="chpr__sh__address" value="<?php echo $datas['ship__address']; ?>" placeholder="Minta utca 1." autocomplete='address-line1' />
                </div>
                <div class="flex flex-row-d-col-m flex-align-c prst__row">
                    <span class="text-primary small prst__trig">Irányítószám</span>
                    <input type="number" data-key="ship__postal" class="w-60d-90m text-primary border-soft background-bg padding-1-05 outline-none border-none" name="chpr__sh__postal" id="chpr__sh__postal" value="<?php echo $datas['ship__postal']; ?>" placeholder="6000" autocomplete='postal-code' />
                </div>
            </div>
        </div>
    </div>
</div>
<script>var guid = <?= $guid; ?>;</script>
<script src="/includes/profile/script/personal.js"></script>