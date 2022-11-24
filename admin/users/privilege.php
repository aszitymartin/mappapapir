<?php include($_SERVER['DOCUMENT_ROOT'].'/includes/inc.php');
if (isset($_SESSION['loggedin'])) {
    $stmt = $con->prepare('SELECT privilege FROM customers__priv  WHERE uid = ?'); if (isset($_SESSION['loggedin'])) {$id = $_SESSION['id'];} $stmt->bind_param('i', $id);$stmt->execute(); $stmt->bind_result($privilege); $stmt->fetch();$stmt->close();
    if ($privilege != 2) { echo "<script>window.location.href='/';</script>"; }
} else { header("Location: /"); }
$guid = $_SESSION['guid']; $gname = $_SESSION['gname'];
$psql = "SELECT privilege FROM customers__priv WHERE uid = $guid"; $pres = $con->query($psql); $pdt = $pres->fetch_assoc(); $gpirv = $pdt['privilege'];
?>
<div class="flex flex-col gap-1">
    <div class="flex flex-col w-fa gap-1 border-soft item-bg box-shadow padding-1">
        <div class="flex flex-row flex-align-c flex-justify-con-sb">
            <span class="text-primary large bold"><?= $gname; ?> jogosultságai</span>
        </div><br>
        <div class="flex flex-row flex-align-c flex-justify-con-c gap-2 w-fa">
            <div class="flex flex-row-d-col-m flex-align-c flex-justify-con-c gap-1 padding-05">
                <div class="flex flex-col flex-align-c gap-1 padding-1 border-soft background-bg w-fa ease ease-scale border-trans">
                    <div class="flex flex-col flex-align-c flex-justify-con-c gap-05 w-fa">
                        <span class="text-primary bold" style="font-size: 1.6rem;">Vásárló</span>
                    </div>
                    <div class="flex flex-col flex-align-c flex-justify-con-fs gap-05 w-fa">
                        <div class="flex flex-row flex-align-c flex-justify-con-sb w-fa">
                            <span class="text-primary small-med bold">Termékek megtekintése</span>
                            <span style="color:#3db875;"><svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none"><rect opacity="0.3" x="2" y="2" width="20" height="20" rx="10" fill="currentColor"></rect><path d="M10.4343 12.4343L8.75 10.75C8.33579 10.3358 7.66421 10.3358 7.25 10.75C6.83579 11.1642 6.83579 11.8358 7.25 12.25L10.2929 15.2929C10.6834 15.6834 11.3166 15.6834 11.7071 15.2929L17.25 9.75C17.6642 9.33579 17.6642 8.66421 17.25 8.25C16.8358 7.83579 16.1642 7.83579 15.75 8.25L11.5657 12.4343C11.2533 12.7467 10.7467 12.7467 10.4343 12.4343Z" fill="currentColor"></path></svg></span>
                        </div>
                        <div class="flex flex-row flex-align-c flex-justify-con-sb w-fa">
                            <span class="text-primary small-med bold">Termékek mentése / kosárba rakása</span>
                            <span style="color:#3db875;"><svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none"><rect opacity="0.3" x="2" y="2" width="20" height="20" rx="10" fill="currentColor"></rect><path d="M10.4343 12.4343L8.75 10.75C8.33579 10.3358 7.66421 10.3358 7.25 10.75C6.83579 11.1642 6.83579 11.8358 7.25 12.25L10.2929 15.2929C10.6834 15.6834 11.3166 15.6834 11.7071 15.2929L17.25 9.75C17.6642 9.33579 17.6642 8.66421 17.25 8.25C16.8358 7.83579 16.1642 7.83579 15.75 8.25L11.5657 12.4343C11.2533 12.7467 10.7467 12.7467 10.4343 12.4343Z" fill="currentColor"></path></svg></span>
                        </div>
                        <div class="flex flex-row flex-align-c flex-justify-con-sb w-fa">
                            <span class="text-primary small-med bold">Termékek értékelése</span>
                            <span style="color:#3db875;"><svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none"><rect opacity="0.3" x="2" y="2" width="20" height="20" rx="10" fill="currentColor"></rect><path d="M10.4343 12.4343L8.75 10.75C8.33579 10.3358 7.66421 10.3358 7.25 10.75C6.83579 11.1642 6.83579 11.8358 7.25 12.25L10.2929 15.2929C10.6834 15.6834 11.3166 15.6834 11.7071 15.2929L17.25 9.75C17.6642 9.33579 17.6642 8.66421 17.25 8.25C16.8358 7.83579 16.1642 7.83579 15.75 8.25L11.5657 12.4343C11.2533 12.7467 10.7467 12.7467 10.4343 12.4343Z" fill="currentColor"></path></svg></span>
                        </div>
                        <div class="flex flex-row flex-align-c flex-justify-con-sb w-fa">
                            <span class="text-primary small-med bold">Termékek megrendelése</span>
                            <span style="color:#3db875;"><svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none"><rect opacity="0.3" x="2" y="2" width="20" height="20" rx="10" fill="currentColor"></rect><path d="M10.4343 12.4343L8.75 10.75C8.33579 10.3358 7.66421 10.3358 7.25 10.75C6.83579 11.1642 6.83579 11.8358 7.25 12.25L10.2929 15.2929C10.6834 15.6834 11.3166 15.6834 11.7071 15.2929L17.25 9.75C17.6642 9.33579 17.6642 8.66421 17.25 8.25C16.8358 7.83579 16.1642 7.83579 15.75 8.25L11.5657 12.4343C11.2533 12.7467 10.7467 12.7467 10.4343 12.4343Z" fill="currentColor"></path></svg></span>
                        </div>
                        <div class="flex flex-row flex-align-c flex-justify-con-sb w-fa">
                            <span class="text-primary small-med bold">Saját profil szerkesztése</span>
                            <span style="color:#3db875;"><svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none"><rect opacity="0.3" x="2" y="2" width="20" height="20" rx="10" fill="currentColor"></rect><path d="M10.4343 12.4343L8.75 10.75C8.33579 10.3358 7.66421 10.3358 7.25 10.75C6.83579 11.1642 6.83579 11.8358 7.25 12.25L10.2929 15.2929C10.6834 15.6834 11.3166 15.6834 11.7071 15.2929L17.25 9.75C17.6642 9.33579 17.6642 8.66421 17.25 8.25C16.8358 7.83579 16.1642 7.83579 15.75 8.25L11.5657 12.4343C11.2533 12.7467 10.7467 12.7467 10.4343 12.4343Z" fill="currentColor"></path></svg></span>
                        </div>
                        <div class="flex flex-row flex-align-c flex-justify-con-sb w-fa">
                            <span class="text-muted small-med bold">Termékek kezelése</span>
                            <span class="text-muted"><svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none"><rect opacity="0.3" x="2" y="2" width="20" height="20" rx="10" fill="currentColor"></rect><rect x="7" y="15.3137" width="12" height="2" rx="1" transform="rotate(-45 7 15.3137)" fill="currentColor"></rect><rect x="8.41422" y="7" width="12" height="2" rx="1" transform="rotate(45 8.41422 7)" fill="currentColor"></rect></svg></span>
                        </div>
                        <div class="flex flex-row flex-align-c flex-justify-con-sb w-fa">
                            <span class="text-muted small-med bold">Rednelések kezelése</span>
                            <span class="text-muted"><svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none"><rect opacity="0.3" x="2" y="2" width="20" height="20" rx="10" fill="currentColor"></rect><rect x="7" y="15.3137" width="12" height="2" rx="1" transform="rotate(-45 7 15.3137)" fill="currentColor"></rect><rect x="8.41422" y="7" width="12" height="2" rx="1" transform="rotate(45 8.41422 7)" fill="currentColor"></rect></svg></span>
                        </div>
                        <div class="flex flex-row flex-align-c flex-justify-con-sb w-fa">
                            <span class="text-muted small-med bold">Szállítások kezelése</span>
                            <span class="text-muted"><svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none"><rect opacity="0.3" x="2" y="2" width="20" height="20" rx="10" fill="currentColor"></rect><rect x="7" y="15.3137" width="12" height="2" rx="1" transform="rotate(-45 7 15.3137)" fill="currentColor"></rect><rect x="8.41422" y="7" width="12" height="2" rx="1" transform="rotate(45 8.41422 7)" fill="currentColor"></rect></svg></span>
                        </div>
                        <div class="flex flex-row flex-align-c flex-justify-con-sb w-fa">
                            <span class="text-muted small-med bold">Ügyfélszolgálat kezelése</span>
                            <span class="text-muted"><svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none"><rect opacity="0.3" x="2" y="2" width="20" height="20" rx="10" fill="currentColor"></rect><rect x="7" y="15.3137" width="12" height="2" rx="1" transform="rotate(-45 7 15.3137)" fill="currentColor"></rect><rect x="8.41422" y="7" width="12" height="2" rx="1" transform="rotate(45 8.41422 7)" fill="currentColor"></rect></svg></span>
                        </div>
                        <div class="flex flex-row flex-align-c flex-justify-con-sb w-fa">
                            <span class="text-muted small-med bold">Visszajelzések kezelése</span>
                            <span class="text-muted"><svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none"><rect opacity="0.3" x="2" y="2" width="20" height="20" rx="10" fill="currentColor"></rect><rect x="7" y="15.3137" width="12" height="2" rx="1" transform="rotate(-45 7 15.3137)" fill="currentColor"></rect><rect x="8.41422" y="7" width="12" height="2" rx="1" transform="rotate(45 8.41422 7)" fill="currentColor"></rect></svg></span>
                        </div>
                        <div class="flex flex-row flex-align-c flex-justify-con-sb w-fa">
                            <span class="text-muted small-med bold">Felhasználók kezelése</span>
                            <span class="text-muted"><svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none"><rect opacity="0.3" x="2" y="2" width="20" height="20" rx="10" fill="currentColor"></rect><rect x="7" y="15.3137" width="12" height="2" rx="1" transform="rotate(-45 7 15.3137)" fill="currentColor"></rect><rect x="8.41422" y="7" width="12" height="2" rx="1" transform="rotate(45 8.41422 7)" fill="currentColor"></rect></svg></span>
                        </div>
                    </div>
                    <div class="flex flex-col flex-align-c flex-justify-con-c gap-025 user-select-none">
                        <?php
                            if ($gpirv == 0) {
                                echo '<span class="flex label success-bg smaller-light padding-05-1 border-soft-light user-select-none">Jelenlegi</span>';
                            } else {
                                if ($privilege == 2) { echo '<span class="flex label primary-bg primary-bg-hover smaller-light padding-05-1 border-soft-light pointer user-select-none" id="setpriv__customer" onclick="changeSubs(this.id)">Váltás</span>'; }
                                else { echo '<span class="flex label primary-bg smaller-light padding-05-1 border-soft-light not-allowed user-select-none">Váltás</span>'; }
                            }
                        ?>
                    </div>
                </div>
                <div class="flex flex-col flex-align-c gap-1 padding-1 border-soft background-bg w-fa ease ease-scale border-trans">
                    <div class="flex flex-col flex-align-c flex-justify-con-c gap-05 w-fa">
                        <span class="text-primary bold" style="font-size: 1.6rem;">Személyzet</span>
                    </div>
                    <div class="flex flex-col flex-align-c flex-justify-con-fs gap-05 w-fa">
                    <div class="flex flex-row flex-align-c flex-justify-con-sb w-fa">
                            <span class="text-primary small-med bold">Termékek megtekintése</span>
                            <span style="color:#3db875;"><svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none"><rect opacity="0.3" x="2" y="2" width="20" height="20" rx="10" fill="currentColor"></rect><path d="M10.4343 12.4343L8.75 10.75C8.33579 10.3358 7.66421 10.3358 7.25 10.75C6.83579 11.1642 6.83579 11.8358 7.25 12.25L10.2929 15.2929C10.6834 15.6834 11.3166 15.6834 11.7071 15.2929L17.25 9.75C17.6642 9.33579 17.6642 8.66421 17.25 8.25C16.8358 7.83579 16.1642 7.83579 15.75 8.25L11.5657 12.4343C11.2533 12.7467 10.7467 12.7467 10.4343 12.4343Z" fill="currentColor"></path></svg></span>
                        </div>
                        <div class="flex flex-row flex-align-c flex-justify-con-sb w-fa">
                            <span class="text-primary small-med bold">Termékek mentése / kosárba rakása</span>
                            <span style="color:#3db875;"><svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none"><rect opacity="0.3" x="2" y="2" width="20" height="20" rx="10" fill="currentColor"></rect><path d="M10.4343 12.4343L8.75 10.75C8.33579 10.3358 7.66421 10.3358 7.25 10.75C6.83579 11.1642 6.83579 11.8358 7.25 12.25L10.2929 15.2929C10.6834 15.6834 11.3166 15.6834 11.7071 15.2929L17.25 9.75C17.6642 9.33579 17.6642 8.66421 17.25 8.25C16.8358 7.83579 16.1642 7.83579 15.75 8.25L11.5657 12.4343C11.2533 12.7467 10.7467 12.7467 10.4343 12.4343Z" fill="currentColor"></path></svg></span>
                        </div>
                        <div class="flex flex-row flex-align-c flex-justify-con-sb w-fa">
                            <span class="text-primary small-med bold">Termékek értékelése</span>
                            <span style="color:#3db875;"><svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none"><rect opacity="0.3" x="2" y="2" width="20" height="20" rx="10" fill="currentColor"></rect><path d="M10.4343 12.4343L8.75 10.75C8.33579 10.3358 7.66421 10.3358 7.25 10.75C6.83579 11.1642 6.83579 11.8358 7.25 12.25L10.2929 15.2929C10.6834 15.6834 11.3166 15.6834 11.7071 15.2929L17.25 9.75C17.6642 9.33579 17.6642 8.66421 17.25 8.25C16.8358 7.83579 16.1642 7.83579 15.75 8.25L11.5657 12.4343C11.2533 12.7467 10.7467 12.7467 10.4343 12.4343Z" fill="currentColor"></path></svg></span>
                        </div>
                        <div class="flex flex-row flex-align-c flex-justify-con-sb w-fa">
                            <span class="text-primary small-med bold">Termékek megrendelése</span>
                            <span style="color:#3db875;"><svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none"><rect opacity="0.3" x="2" y="2" width="20" height="20" rx="10" fill="currentColor"></rect><path d="M10.4343 12.4343L8.75 10.75C8.33579 10.3358 7.66421 10.3358 7.25 10.75C6.83579 11.1642 6.83579 11.8358 7.25 12.25L10.2929 15.2929C10.6834 15.6834 11.3166 15.6834 11.7071 15.2929L17.25 9.75C17.6642 9.33579 17.6642 8.66421 17.25 8.25C16.8358 7.83579 16.1642 7.83579 15.75 8.25L11.5657 12.4343C11.2533 12.7467 10.7467 12.7467 10.4343 12.4343Z" fill="currentColor"></path></svg></span>
                        </div>
                        <div class="flex flex-row flex-align-c flex-justify-con-sb w-fa">
                            <span class="text-primary small-med bold">Saját profil szerkesztése</span>
                            <span style="color:#3db875;"><svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none"><rect opacity="0.3" x="2" y="2" width="20" height="20" rx="10" fill="currentColor"></rect><path d="M10.4343 12.4343L8.75 10.75C8.33579 10.3358 7.66421 10.3358 7.25 10.75C6.83579 11.1642 6.83579 11.8358 7.25 12.25L10.2929 15.2929C10.6834 15.6834 11.3166 15.6834 11.7071 15.2929L17.25 9.75C17.6642 9.33579 17.6642 8.66421 17.25 8.25C16.8358 7.83579 16.1642 7.83579 15.75 8.25L11.5657 12.4343C11.2533 12.7467 10.7467 12.7467 10.4343 12.4343Z" fill="currentColor"></path></svg></span>
                        </div>
                        <div class="flex flex-row flex-align-c flex-justify-con-sb w-fa">
                            <span class="text-primary small-med bold">Termékek kezelése</span>
                            <span style="color:#3db875;"><svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none"><rect opacity="0.3" x="2" y="2" width="20" height="20" rx="10" fill="currentColor"></rect><path d="M10.4343 12.4343L8.75 10.75C8.33579 10.3358 7.66421 10.3358 7.25 10.75C6.83579 11.1642 6.83579 11.8358 7.25 12.25L10.2929 15.2929C10.6834 15.6834 11.3166 15.6834 11.7071 15.2929L17.25 9.75C17.6642 9.33579 17.6642 8.66421 17.25 8.25C16.8358 7.83579 16.1642 7.83579 15.75 8.25L11.5657 12.4343C11.2533 12.7467 10.7467 12.7467 10.4343 12.4343Z" fill="currentColor"></path></svg></span>
                        </div>
                        <div class="flex flex-row flex-align-c flex-justify-con-sb w-fa">
                            <span class="text-primary small-med bold">Rednelések kezelése</span>
                            <span style="color:#3db875;"><svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none"><rect opacity="0.3" x="2" y="2" width="20" height="20" rx="10" fill="currentColor"></rect><path d="M10.4343 12.4343L8.75 10.75C8.33579 10.3358 7.66421 10.3358 7.25 10.75C6.83579 11.1642 6.83579 11.8358 7.25 12.25L10.2929 15.2929C10.6834 15.6834 11.3166 15.6834 11.7071 15.2929L17.25 9.75C17.6642 9.33579 17.6642 8.66421 17.25 8.25C16.8358 7.83579 16.1642 7.83579 15.75 8.25L11.5657 12.4343C11.2533 12.7467 10.7467 12.7467 10.4343 12.4343Z" fill="currentColor"></path></svg></span>
                        </div>
                        <div class="flex flex-row flex-align-c flex-justify-con-sb w-fa">
                            <span class="text-primary small-med bold">Szállítások kezelése</span>
                            <span style="color:#3db875;"><svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none"><rect opacity="0.3" x="2" y="2" width="20" height="20" rx="10" fill="currentColor"></rect><path d="M10.4343 12.4343L8.75 10.75C8.33579 10.3358 7.66421 10.3358 7.25 10.75C6.83579 11.1642 6.83579 11.8358 7.25 12.25L10.2929 15.2929C10.6834 15.6834 11.3166 15.6834 11.7071 15.2929L17.25 9.75C17.6642 9.33579 17.6642 8.66421 17.25 8.25C16.8358 7.83579 16.1642 7.83579 15.75 8.25L11.5657 12.4343C11.2533 12.7467 10.7467 12.7467 10.4343 12.4343Z" fill="currentColor"></path></svg></span>
                        </div>
                        <div class="flex flex-row flex-align-c flex-justify-con-sb w-fa">
                            <span class="text-primary small-med bold">Ügyfélszolgálat kezelése</span>
                            <span style="color:#3db875;"><svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none"><rect opacity="0.3" x="2" y="2" width="20" height="20" rx="10" fill="currentColor"></rect><path d="M10.4343 12.4343L8.75 10.75C8.33579 10.3358 7.66421 10.3358 7.25 10.75C6.83579 11.1642 6.83579 11.8358 7.25 12.25L10.2929 15.2929C10.6834 15.6834 11.3166 15.6834 11.7071 15.2929L17.25 9.75C17.6642 9.33579 17.6642 8.66421 17.25 8.25C16.8358 7.83579 16.1642 7.83579 15.75 8.25L11.5657 12.4343C11.2533 12.7467 10.7467 12.7467 10.4343 12.4343Z" fill="currentColor"></path></svg></span>
                        </div>
                        <div class="flex flex-row flex-align-c flex-justify-con-sb w-fa">
                            <span class="text-muted small-med bold">Visszajelzések kezelése</span>
                            <span class="text-muted"><svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none"><rect opacity="0.3" x="2" y="2" width="20" height="20" rx="10" fill="currentColor"></rect><rect x="7" y="15.3137" width="12" height="2" rx="1" transform="rotate(-45 7 15.3137)" fill="currentColor"></rect><rect x="8.41422" y="7" width="12" height="2" rx="1" transform="rotate(45 8.41422 7)" fill="currentColor"></rect></svg></span>
                        </div>
                        <div class="flex flex-row flex-align-c flex-justify-con-sb w-fa">
                            <span class="text-muted small-med bold">Felhasználók kezelése</span>
                            <span class="text-muted"><svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none"><rect opacity="0.3" x="2" y="2" width="20" height="20" rx="10" fill="currentColor"></rect><rect x="7" y="15.3137" width="12" height="2" rx="1" transform="rotate(-45 7 15.3137)" fill="currentColor"></rect><rect x="8.41422" y="7" width="12" height="2" rx="1" transform="rotate(45 8.41422 7)" fill="currentColor"></rect></svg></span>
                        </div>
                    </div>
                    <div class="flex flex-col flex-align-c flex-justify-con-c gap-025 user-select-none">
                        <?php
                            if ($gpirv == 1) {
                                echo '<span class="flex label success-bg smaller-light padding-05-1 border-soft-light user-select-none">Jelenlegi</span>';
                            } else {
                                if ($privilege == 2) { echo '<span class="flex label primary-bg primary-bg-hover smaller-light padding-05-1 border-soft-light pointer user-select-none" id="setpriv__staff" onclick="changeSubs(this.id)">Váltás</span>'; }
                                else { echo '<span class="flex label primary-bg smaller-light padding-05-1 border-soft-light not-allowed user-select-none">Váltás</span>'; }
                            }
                        ?>
                    </div>
                </div>
                <div class="flex flex-col flex-align-c gap-1 padding-1 border-soft background-bg w-fa ease ease-scale border-trans">
                    <div class="flex flex-col flex-align-c flex-justify-con-c gap-05 w-fa">
                        <span class="text-primary bold" style="font-size: 1.6rem;">Rendszergazda</span>
                    </div>
                    <div class="flex flex-col flex-align-c flex-justify-con-fs gap-05 w-fa">
                    <div class="flex flex-row flex-align-c flex-justify-con-sb w-fa">
                        <span class="text-primary small-med bold">Termékek megtekintése</span>
                            <span style="color:#3db875;"><svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none"><rect opacity="0.3" x="2" y="2" width="20" height="20" rx="10" fill="currentColor"></rect><path d="M10.4343 12.4343L8.75 10.75C8.33579 10.3358 7.66421 10.3358 7.25 10.75C6.83579 11.1642 6.83579 11.8358 7.25 12.25L10.2929 15.2929C10.6834 15.6834 11.3166 15.6834 11.7071 15.2929L17.25 9.75C17.6642 9.33579 17.6642 8.66421 17.25 8.25C16.8358 7.83579 16.1642 7.83579 15.75 8.25L11.5657 12.4343C11.2533 12.7467 10.7467 12.7467 10.4343 12.4343Z" fill="currentColor"></path></svg></span>
                        </div>
                        <div class="flex flex-row flex-align-c flex-justify-con-sb w-fa">
                            <span class="text-primary small-med bold">Termékek mentése / kosárba rakása</span>
                            <span style="color:#3db875;"><svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none"><rect opacity="0.3" x="2" y="2" width="20" height="20" rx="10" fill="currentColor"></rect><path d="M10.4343 12.4343L8.75 10.75C8.33579 10.3358 7.66421 10.3358 7.25 10.75C6.83579 11.1642 6.83579 11.8358 7.25 12.25L10.2929 15.2929C10.6834 15.6834 11.3166 15.6834 11.7071 15.2929L17.25 9.75C17.6642 9.33579 17.6642 8.66421 17.25 8.25C16.8358 7.83579 16.1642 7.83579 15.75 8.25L11.5657 12.4343C11.2533 12.7467 10.7467 12.7467 10.4343 12.4343Z" fill="currentColor"></path></svg></span>
                        </div>
                        <div class="flex flex-row flex-align-c flex-justify-con-sb w-fa">
                            <span class="text-primary small-med bold">Termékek értékelése</span>
                            <span style="color:#3db875;"><svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none"><rect opacity="0.3" x="2" y="2" width="20" height="20" rx="10" fill="currentColor"></rect><path d="M10.4343 12.4343L8.75 10.75C8.33579 10.3358 7.66421 10.3358 7.25 10.75C6.83579 11.1642 6.83579 11.8358 7.25 12.25L10.2929 15.2929C10.6834 15.6834 11.3166 15.6834 11.7071 15.2929L17.25 9.75C17.6642 9.33579 17.6642 8.66421 17.25 8.25C16.8358 7.83579 16.1642 7.83579 15.75 8.25L11.5657 12.4343C11.2533 12.7467 10.7467 12.7467 10.4343 12.4343Z" fill="currentColor"></path></svg></span>
                        </div>
                        <div class="flex flex-row flex-align-c flex-justify-con-sb w-fa">
                            <span class="text-primary small-med bold">Termékek megrendelése</span>
                            <span style="color:#3db875;"><svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none"><rect opacity="0.3" x="2" y="2" width="20" height="20" rx="10" fill="currentColor"></rect><path d="M10.4343 12.4343L8.75 10.75C8.33579 10.3358 7.66421 10.3358 7.25 10.75C6.83579 11.1642 6.83579 11.8358 7.25 12.25L10.2929 15.2929C10.6834 15.6834 11.3166 15.6834 11.7071 15.2929L17.25 9.75C17.6642 9.33579 17.6642 8.66421 17.25 8.25C16.8358 7.83579 16.1642 7.83579 15.75 8.25L11.5657 12.4343C11.2533 12.7467 10.7467 12.7467 10.4343 12.4343Z" fill="currentColor"></path></svg></span>
                        </div>
                        <div class="flex flex-row flex-align-c flex-justify-con-sb w-fa">
                            <span class="text-primary small-med bold">Saját profil szerkesztése</span>
                            <span style="color:#3db875;"><svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none"><rect opacity="0.3" x="2" y="2" width="20" height="20" rx="10" fill="currentColor"></rect><path d="M10.4343 12.4343L8.75 10.75C8.33579 10.3358 7.66421 10.3358 7.25 10.75C6.83579 11.1642 6.83579 11.8358 7.25 12.25L10.2929 15.2929C10.6834 15.6834 11.3166 15.6834 11.7071 15.2929L17.25 9.75C17.6642 9.33579 17.6642 8.66421 17.25 8.25C16.8358 7.83579 16.1642 7.83579 15.75 8.25L11.5657 12.4343C11.2533 12.7467 10.7467 12.7467 10.4343 12.4343Z" fill="currentColor"></path></svg></span>
                        </div>
                        <div class="flex flex-row flex-align-c flex-justify-con-sb w-fa">
                            <span class="text-primary small-med bold">Termékek kezelése</span>
                            <span style="color:#3db875;"><svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none"><rect opacity="0.3" x="2" y="2" width="20" height="20" rx="10" fill="currentColor"></rect><path d="M10.4343 12.4343L8.75 10.75C8.33579 10.3358 7.66421 10.3358 7.25 10.75C6.83579 11.1642 6.83579 11.8358 7.25 12.25L10.2929 15.2929C10.6834 15.6834 11.3166 15.6834 11.7071 15.2929L17.25 9.75C17.6642 9.33579 17.6642 8.66421 17.25 8.25C16.8358 7.83579 16.1642 7.83579 15.75 8.25L11.5657 12.4343C11.2533 12.7467 10.7467 12.7467 10.4343 12.4343Z" fill="currentColor"></path></svg></span>
                        </div>
                        <div class="flex flex-row flex-align-c flex-justify-con-sb w-fa">
                            <span class="text-primary small-med bold">Rednelések kezelése</span>
                            <span style="color:#3db875;"><svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none"><rect opacity="0.3" x="2" y="2" width="20" height="20" rx="10" fill="currentColor"></rect><path d="M10.4343 12.4343L8.75 10.75C8.33579 10.3358 7.66421 10.3358 7.25 10.75C6.83579 11.1642 6.83579 11.8358 7.25 12.25L10.2929 15.2929C10.6834 15.6834 11.3166 15.6834 11.7071 15.2929L17.25 9.75C17.6642 9.33579 17.6642 8.66421 17.25 8.25C16.8358 7.83579 16.1642 7.83579 15.75 8.25L11.5657 12.4343C11.2533 12.7467 10.7467 12.7467 10.4343 12.4343Z" fill="currentColor"></path></svg></span>
                        </div>
                        <div class="flex flex-row flex-align-c flex-justify-con-sb w-fa">
                            <span class="text-primary small-med bold">Szállítások kezelése</span>
                            <span style="color:#3db875;"><svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none"><rect opacity="0.3" x="2" y="2" width="20" height="20" rx="10" fill="currentColor"></rect><path d="M10.4343 12.4343L8.75 10.75C8.33579 10.3358 7.66421 10.3358 7.25 10.75C6.83579 11.1642 6.83579 11.8358 7.25 12.25L10.2929 15.2929C10.6834 15.6834 11.3166 15.6834 11.7071 15.2929L17.25 9.75C17.6642 9.33579 17.6642 8.66421 17.25 8.25C16.8358 7.83579 16.1642 7.83579 15.75 8.25L11.5657 12.4343C11.2533 12.7467 10.7467 12.7467 10.4343 12.4343Z" fill="currentColor"></path></svg></span>
                        </div>
                        <div class="flex flex-row flex-align-c flex-justify-con-sb w-fa">
                            <span class="text-primary small-med bold">Ügyfélszolgálat kezelése</span>
                            <span style="color:#3db875;"><svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none"><rect opacity="0.3" x="2" y="2" width="20" height="20" rx="10" fill="currentColor"></rect><path d="M10.4343 12.4343L8.75 10.75C8.33579 10.3358 7.66421 10.3358 7.25 10.75C6.83579 11.1642 6.83579 11.8358 7.25 12.25L10.2929 15.2929C10.6834 15.6834 11.3166 15.6834 11.7071 15.2929L17.25 9.75C17.6642 9.33579 17.6642 8.66421 17.25 8.25C16.8358 7.83579 16.1642 7.83579 15.75 8.25L11.5657 12.4343C11.2533 12.7467 10.7467 12.7467 10.4343 12.4343Z" fill="currentColor"></path></svg></span>
                        </div>
                        <div class="flex flex-row flex-align-c flex-justify-con-sb w-fa">
                            <span class="text-primary small-med bold">Visszajelzések kezelése</span>
                            <span style="color:#3db875;"><svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none"><rect opacity="0.3" x="2" y="2" width="20" height="20" rx="10" fill="currentColor"></rect><path d="M10.4343 12.4343L8.75 10.75C8.33579 10.3358 7.66421 10.3358 7.25 10.75C6.83579 11.1642 6.83579 11.8358 7.25 12.25L10.2929 15.2929C10.6834 15.6834 11.3166 15.6834 11.7071 15.2929L17.25 9.75C17.6642 9.33579 17.6642 8.66421 17.25 8.25C16.8358 7.83579 16.1642 7.83579 15.75 8.25L11.5657 12.4343C11.2533 12.7467 10.7467 12.7467 10.4343 12.4343Z" fill="currentColor"></path></svg></span>
                        </div>
                        <div class="flex flex-row flex-align-c flex-justify-con-sb w-fa">
                            <span class="text-primary small-med bold">Felhasználók kezelése</span>
                            <span style="color:#3db875;"><svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none"><rect opacity="0.3" x="2" y="2" width="20" height="20" rx="10" fill="currentColor"></rect><path d="M10.4343 12.4343L8.75 10.75C8.33579 10.3358 7.66421 10.3358 7.25 10.75C6.83579 11.1642 6.83579 11.8358 7.25 12.25L10.2929 15.2929C10.6834 15.6834 11.3166 15.6834 11.7071 15.2929L17.25 9.75C17.6642 9.33579 17.6642 8.66421 17.25 8.25C16.8358 7.83579 16.1642 7.83579 15.75 8.25L11.5657 12.4343C11.2533 12.7467 10.7467 12.7467 10.4343 12.4343Z" fill="currentColor"></path></svg></span>
                        </div>
                    </div>
                    <div class="flex flex-col flex-align-c flex-justify-con-c gap-025 user-select-none">
                        <?php
                            if ($gpirv == 2) {
                                echo '<span class="flex label success-bg smaller-light padding-05-1 border-soft-light user-select-none">Jelenlegi</span>';
                            } else {
                                if ($privilege == 2) { echo '<span class="flex label primary-bg primary-bg-hover smaller-light padding-05-1 border-soft-light pointer user-select-none" id="setpriv__admin" onclick="changeSubs(this.id)">Váltás</span>'; }
                                else { echo '<span class="flex label primary-bg smaller-light padding-05-1 border-soft-light not-allowed user-select-none">Váltás</span>'; }
                            }
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php
    if ($privilege == 2) {
        echo '<script content-type="application/javascript">
            function changeSubs(prv) {
                var priv = prv.split("__")[1]; let pnum = 0;
                switch (priv) {
                    case "customer": pnum = 0; break;
                    case "staff": pnum = 1; break;
                    case "admin": pnum = 2; break;
                    defult: pnum = 0;
                } var pvData = new FormData(); pvData.append("uid", '.$guid.'); pvData.append("prv", priv);

                var c__wrapper = document.createElement("div"); c__wrapper.classList = "wrapper_dark fadein"; var c__box = document.createElement("div"); c__box.classList = "d__confirm popup fixed flex flex-col border-soft item-bg box-shadow padding-1";
                c__wrapper.classList.add("fadein"); c__wrapper.classList.remove("fadeout"); c__box.classList.add("padding-t-0"); c__box.classList.add("popup"); c__box.classList.remove("popout"); document.body.append(c__wrapper); c__wrapper.append(c__box); $("html").css("overflow-y", "hidden");
                c__box.innerHTML = `
                <div class="flex flex-row flex-align-c flex-justify-con-sb padding-t-1" id="cbh__con">
                    <span class="text-primary small bold">Felhasználói jog módosítása</span>
                    <div class="flex flex-row flex-align-c gap-05">
                        <span class="text-primary pointer" aria-label="Bezárás" id="cl__box"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"><rect opacity="0.3" x="2" y="2" width="20" height="20" rx="5" fill="currentColor"/><rect x="7" y="15.3137" width="12" height="2" rx="1" transform="rotate(-45 7 15.3137)" fill="currentColor"/><rect x="8.41422" y="7" width="12" height="2" rx="1" transform="rotate(45 8.41422 7)" fill="currentColor"/></svg></span>
                    </div>
                </div><br>
                <div class="flex flex-col gap-2">
                    <div class="flex flex-col flex-align-c flex-justify-con-c text-align-c text-muted user-select-none w-fa gap-1">
                        <div class="text-muted">
                            <div id="ch-us-pv-svg">
                                <svg width="128" height="128" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path opacity="0.3" d="M18 22C19.7 22 21 20.7 21 19C21 18.5 20.9 18.1 20.7 17.7L15.3 6.30005C15.1 5.90005 15 5.5 15 5C15 3.3 16.3 2 18 2H6C4.3 2 3 3.3 3 5C3 5.5 3.1 5.90005 3.3 6.30005L8.7 17.7C8.9 18.1 9 18.5 9 19C9 20.7 7.7 22 6 22H18Z" fill="currentColor"></path><path d="M18 2C19.7 2 21 3.3 21 5H9C9 3.3 7.7 2 6 2H18Z" fill="currentColor"></path><path d="M9 19C9 20.7 7.7 22 6 22C4.3 22 3 20.7 3 19H9Z" fill="currentColor"></path></svg>
                            </div>
                            <span style="font-size: .9rem !important;" id="ch-us-pv-inf">Biztos megváltoztatja <strong>'.$gname.'</strong> jogosultságait?</span>
                        </div>
                        <div class="flex flex-row flex-align-c gap-1 user-select-none" style="font-size: .9rem !important;" id="sh-us-cht-pv">
                            <span>'; if ($gpirv == 0) { echo 'Vásárló';} if ($gpirv == 1) { echo 'Személyzet';} if ($gpirv == 2) { echo 'Rendszergazda';} echo '</span>
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><rect opacity="0.5" x="18" y="13" width="13" height="2" rx="1" transform="rotate(-180 18 13)" fill="currentColor"/><path d="M15.4343 12.5657L11.25 16.75C10.8358 17.1642 10.8358 17.8358 11.25 18.25C11.6642 18.6642 12.3358 18.6642 12.75 18.25L18.2929 12.7071C18.6834 12.3166 18.6834 11.6834 18.2929 11.2929L12.75 5.75C12.3358 5.33579 11.6642 5.33579 11.25 5.75C10.8358 6.16421 10.8358 6.83579 11.25 7.25L15.4343 11.4343C15.7467 11.7467 15.7467 12.2533 15.4343 12.5657Z" fill="currentColor"/></svg>
                            <strong id="ch-to-pv"></strong>
                        </div>
                    </div>
                    <div class="flex flex-row flex-align-c flex-justify-con-fe gap-1 user-select-none" style="font-size: .7rem !important;">
                        <span class="primary-bg primary-bg-hover border-soft-light padding-05 user-select-none pointer" id="ch-us-pv">Módosítás</span>
                    </div>
                </div>
                `;
                var ctp = document.getElementById("ch-to-pv");
                if (priv == "customer") { ctp.textContent = "Vásárló"; } if (priv == "staff") { ctp.textContent = "Személyzet"; } if (priv == "admin") { ctp.textContent = "Rendszergazda"; }
                var con = document.getElementById("cbh__con");var mc = new Hammer(con);mc.get("pan").set({ direction: Hammer.DIRECTION_ALL });mc.on("pandown", function(ev) { $("#cl__box").click(); });
                $("#cl__box").click(function () { c__wrapper.classList.add("fadeout"); c__box.classList.add("popout"); setTimeout(() => { c__wrapper.remove(); $("html").css("overflow-y", "unset"); }, 200); });
                $("#ch-us-pv").click(() => { var pvData = new FormData(); pvData.append("uid", '.$guid.'); pvData.append("priv", pnum); let apiKey = "739837e232548988c86b954108794b57bd3e1dbcd6eb550bfa53e544";
                    $.getJSON("https://api.ipdata.co?api-key=" + apiKey, function(gip) { pvData.append("ip", gip.ip);
                        $.ajax({ enctype: "multipart/form-data", type: "POST", url: "/admin/users/privilege/change.php", data: pvData, dataType: "json", contentType: false, processData: false,
                            beforeSend: function () { $("#ch-us-pv").off("click");
                                document.getElementById("ch-us-pv").classList = "flex flex-row flex-align-c flex-justify-con-sb gap-1 label-secondary border-soft-light padding-025-05 smaller-light";
                                document.getElementById("ch-us-pv").innerHTML = `<span>Folyamatban</span><svg class="wizard_input_loading" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="18" height="18" viewBox="0 0 24 24" version="1.1"><g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"><g><polygon points="0 0 24 0 24 24 0 24"/></g><path d="M12,4 L12,6 C8.6862915,6 6,8.6862915 6,12 C6,15.3137085 8.6862915,18 12,18 C15.3137085,18 18,15.3137085 18,12 C18,10.9603196 17.7360885,9.96126435 17.2402578,9.07513926 L18.9856052,8.09853149 C19.6473536,9.28117708 20,10.6161442 20,12 C20,16.418278 16.418278,20 12,20 C7.581722,20 4,16.418278 4,12 C4,7.581722 7.581722,4 12,4 Z" fill="currentColor" fill-rule="nonzero" opacity="0.4" transform="translate(12.000000, 12.000000) scale(-1, 1) translate(-12.000000, -12.000000) "/></g></svg>`;
                            }, success: function(data) { document.getElementById("tabs-privilege").click();
                                document.getElementById("ch-us-pv-svg").parentNode.classList.replace("text-muted", "text-success");
                                document.getElementById("ch-us-pv-inf").innerHTML = `Sikeresen megváltoztatta <strong>'.$gname.'</strong> jogosultságait.`;
                                document.getElementById("ch-us-pv-svg").innerHTML = `<svg width="128" height="128" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><rect opacity="0.3" x="2" y="2" width="20" height="20" rx="10" fill="currentColor"/><path d="M10.4343 12.4343L8.75 10.75C8.33579 10.3358 7.66421 10.3358 7.25 10.75C6.83579 11.1642 6.83579 11.8358 7.25 12.25L10.2929 15.2929C10.6834 15.6834 11.3166 15.6834 11.7071 15.2929L17.25 9.75C17.6642 9.33579 17.6642 8.66421 17.25 8.25C16.8358 7.83579 16.1642 7.83579 15.75 8.25L11.5657 12.4343C11.2533 12.7467 10.7467 12.7467 10.4343 12.4343Z" fill="currentColor"/></svg>`;
                                document.getElementById("ch-us-pv").classList = "text-primary smaller-light pointer user-select-none link";
                                document.getElementById("ch-us-pv").textContent = `Bezárás`;
                                $("#ch-us-pv").click(() => { $("#cl__box").click(); });
                            }, error: function(data) { console.log(data);
                                document.getElementById("sh-us-cht-pv").remove();
                                document.getElementById("ch-us-pv-svg").parentNode.classList.replace("text-muted", "text-danger");
                                document.getElementById("ch-us-pv-inf").innerHTML = `Hiba lépett fel <strong>'.$gname.'</strong> jogosultságainak megváltoztatása közben.<br>Kérjük próbálja újra később.`;
                                document.getElementById("ch-us-pv-svg").innerHTML = `<svg width="128" height="128" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><rect opacity="0.3" x="2" y="2" width="20" height="20" rx="10" fill="currentColor"/><rect x="11" y="14" width="7" height="2" rx="1" transform="rotate(-90 11 14)" fill="currentColor"/><rect x="11" y="17" width="2" height="2" rx="1" transform="rotate(-90 11 17)" fill="currentColor"/></svg>`;
                                document.getElementById("ch-us-pv").classList = "text-primary smaller-light pointer user-select-none link";
                                document.getElementById("ch-us-pv").textContent = `Bezárás`;
                                $("#ch-us-pv").click(() => { $("#cl__box").click(); });
                            }
                        });   
                    });
                });
            }
        </script>';
    }
?>