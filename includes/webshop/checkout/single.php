<?php require_once($_SERVER['DOCUMENT_ROOT'].'/includes/inc.php');

if (isset($_SESSION['loggedin'])) {
    if (isset($_GET['id'])) {
        if (is_numeric($_GET['id'])) {
            $stmt = $con->prepare('SELECT products.id, name, thumbnail FROM products WHERE id = ?');
            $stmt->bind_param('i', $_GET['id']);$stmt->execute(); $stmt -> store_result();
            $stmt->bind_result($pid, $name, $thumbnail); $stmt->fetch();
            if ($stmt->num_rows > 0) {
                echo '
                <div class="flex flex-row-d-col-m gap-1 w-fa">
                    <div class="flex flex-col gap-1 w-fa w-70d-100m border-primary-right-d padding-05">
                        <div class="flex flex-row-d-col-m gap-1 text-align-c-m">
                            <div class="flex flex-col flex-align-c flex-justify-con-c gap-1">
                                <img src="/assets/images/uploads/'.$thumbnail.'" class="drop-shadow" style="width: 10rem; height: 10rem; object-fit: contain;" />
                                <div class="flex flex-row flex-align-c gap-1 user-select-none">
                                    <span title="Csökkentés" aria-label="Csökkentés" class="flex flex-col flex-align-c padding-025 text-muted primary-bg primary-bg-hover border-soft pointer" id="load-card">
                                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><rect x="6" y="11" width="12" height="2" rx="1" fill="currentColor"/></svg>
                                    </span>
                                    <span class="text-secondary">1</span>
                                    <span title="Növelés" aria-label="Növelés" class="flex flex-col flex-align-c padding-025 text-muted primary-bg primary-bg-hover border-soft pointer" id="load-card">
                                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><rect opacity="1" x="11" y="18" width="12" height="2" rx="1" transform="rotate(-90 11 18)" fill="currentColor"/><rect x="6" y="11" width="12" height="2" rx="1" fill="currentColor"/></svg>
                                    </span>
                                </div>
                            </div>
                            <div class="flex flex-col w-fa gap-1 text-primary">
                                <div class="flex flex-col gap-025">
                                    <a class="bold link pointer user-select-none" href="#" target="_blank">'.$name.'</a>
                                    <span class="text-secondary">3 311 Ft</span>
                                </div>
                                <div class="flex flex-col gap-025 small">
                                    <div class="flex flex-row gap-05 flex-align-c w-fa">
                                        <span class="bold">Márka:</span>
                                        <span class="text-secondary">Helect</span>
                                    </div>
                                    <div class="flex flex-row gap-05 flex-align-c w-fa">
                                        <span class="bold">Szín:</span>
                                        <span class="text-secondary">Fekete</span>
                                    </div>
                                </div>
                                <div class="flex flex-col gap-025 small">
                                    <div class="flex flex-row gap-05 flex-align-c w-fa">
                                        <span class="bold">Stílus:</span>
                                        <span class="text-secondary">Napelem és elem</span>
                                    </div>
                                    <div class="flex flex-row gap-05 flex-align-c w-fa">
                                        <span class="bold">Modell:</span>
                                        <span class="text-secondary">H1001</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="flex flex-col flex-align-fe flex-justify-con-fe text-muted padding-05 gap-1">
                            <div class="flex flex-col gap-025 small">
                                <div class="flex flex-row gap-05 flex-align-fe flex-justify-con-fe w-fa">
                                    <span class="bold">Mennyiség:</span>
                                    <span class="text-secondary">1 darab</span>
                                </div>
                                <div class="flex flex-row gap-05 flex-align-fe flex-justify-con-fe w-fa">
                                    <span class="bold">Alapár:</span>
                                    <span class="text-secondary">3 720 Ft</span>
                                </div>
                            </div>
                            <div class="flex flex-col gap-025 small">
                                <div class="flex flex-row gap-05 flex-align-fe flex-justify-con-fe w-fa">
                                    <span class="bold">Szállítási díj:</span>
                                    <span class="text-secondary">0 Ft</span>
                                </div>
                                <div class="flex flex-row gap-05 flex-align-fe flex-justify-con-fe w-fa">
                                    <span class="bold">Kezelési költség:</span>
                                    <span class="text-secondary">0 Ft</span>
                                </div>
                            </div>
                            <div class="flex flex-col gap-025 small">
                                <div class="flex flex-row gap-05 flex-align-fe flex-justify-con-fe w-fa">
                                    <span class="bold">Levonások:</span>
                                    <span class="text-secondary">0 Ft</span>
                                </div>
                                <div class="flex flex-row gap-05 flex-align-fe flex-justify-con-fe w-fa">
                                    <span class="bold">Fizetendő:</span>
                                    <span class="text-secondary">0 Ft</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="flex flex-col gap-1 w-fa text-primary">
                        <div class="flex flex-col gap-1 w-fa">
                            <span class="text-primary bold">Teljes név</span>
                            <input type="text" class="w-fa text-primary border-soft background-bg padding-1-05 outline-none border-none" placeholder="Adja meg a teljes nevét" autocomplete="fullname">
                        </div>
                        <div class="flex flex-col gap-1 w-fa">
                            <span class="text-primary bold">E-mail cím</span>
                            <input type="email" class="w-fa text-primary border-soft background-bg padding-1-05 outline-none border-none" placeholder="Adja meg az e-mail címét" autocomplete="email">
                        </div>
                    </div>
                </div>
                ';
            } else { echo 'nincs ilyen termek'; }
            $stmt->close();
        } else { echo '<script>window.location.href = "/404"</script>'; }
    } else { echo '<script>window.location.href = "/404"</script>'; }
} else { echo '<script>window.location.href = "/"</script>'; }

?>