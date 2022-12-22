<?php require_once($_SERVER['DOCUMENT_ROOT'].'/assets/alph.php'); require_once($_SERVER['DOCUMENT_ROOT'].'/includes/inc.php');

if (isset($_SESSION['loggedin'])) {
    if (!isset($_GET['id'])) {
        $sql = "SELECT pid FROM cart WHERE uid = " . $_SESSION['id'];
        $res = $con->query($sql);
        echo '<div class="flex flex-col prio__con gap-025" style="max-height: 290px !important;">';
        while ($dt = $res->fetch_assoc()) {
            $stmt = $con->prepare('SELECT products.id, name, thumbnail, base, discount, color, style, brand, model FROM products INNER JOIN products__pricing ON products__pricing.pid = products.id INNER JOIN products__variations ON products__variations.pid = products.id WHERE products.id = ?');
            $stmt->bind_param('i', $dt['pid']);$stmt->execute(); $stmt -> store_result();
            $stmt->bind_result($pid, $name, $thumbnail, $base, $discount, $color, $style, $brand, $model); $stmt->fetch();
            if ($stmt->num_rows > 0) {
                echo '
                    <div class="flex flex-row-d-col-m gap-1 text-align-c-m">
                        <div class="flex flex-col flex-align-c flex-justify-con-c gap-1">
                            <img src="/assets/images/uploads/'.$thumbnail.'" class="drop-shadow" style="width: 5rem; height: 5rem; object-fit: contain;" />
                            <div class="flex flex-row flex-align-c gap-1 user-select-none">
                                <span title="Csökkentés" aria-label="Csökkentés" class="splash flex flex-col flex-align-c padding-025 text-muted primary-bg primary-bg-hover border-soft pointer" id="load-card">
                                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><rect x="6" y="11" width="12" height="2" rx="1" fill="currentColor"/></svg>
                                </span>
                                <span class="text-secondary">1</span>
                                <span title="Növelés" aria-label="Növelés" class="splash flex flex-col flex-align-c padding-025 text-muted primary-bg primary-bg-hover border-soft pointer" id="load-card">
                                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><rect opacity="1" x="11" y="18" width="12" height="2" rx="1" transform="rotate(-90 11 18)" fill="currentColor"/><rect x="6" y="11" width="12" height="2" rx="1" fill="currentColor"/></svg>
                                </span>
                            </div>
                        </div>
                        <div class="flex flex-col w-fa gap-1 text-primary">
                            <div class="flex flex-col gap-025">
                                <a class="bold link pointer user-select-none" href="/product/'.$pid.'/'; echo str_replace(',', '', str_replace(' ', '-',strtolower(strtr($brand, $unwanted_array)))).'-'.str_replace(',', '', str_replace(' ', '-',strtolower(strtr($name, $unwanted_array)))).'-'.str_replace(',', '', str_replace(' ', '-', strtolower(strtr($color, $unwanted_array)))); echo '" target="_blank">'.$name.'</a>
                                <div class="flex flex-row flex-align-c w-fa gap-1">
                                    ';
                                        if ($discount > 0) {
                                            echo '
                                                <div class="flex flex-row flex-align-c gap-05">
                                                    <span class="text-secondary fbe" data-value="'. (($base * $discount) / 100) .'"></span>
                                                    <span class="flex flex-row flex-align-c flex-justify-con-c danger-bg border-soft-light padding-025 bold user-select-none smaller">-'.$discount.'%</span>
                                                </div>
                                                <span class="text-secondary fbe linethrough small-med" data-value="'.$base.'"></span>
                                            ';
                                        } else {
                                            echo '<span class="text-secondary fbe" data-value="'.$base.'"></span>';
                                        }
                                    echo '
                                </div>
                            </div>
                            <div class="flex flex-row flex-align-c flex-justify-con-sb w-fa">
                                <div class="flex flex-col gap-025 small">
                                    <div class="flex flex-row gap-05 flex-align-c w-fa">
                                        <span class="bold">Márka:</span>
                                        <span class="text-secondary">'.$brand.'</span>
                                    </div>
                                    <div class="flex flex-row gap-05 flex-align-c w-fa">
                                        <span class="bold">Szín:</span>
                                        <span class="text-secondary">'.$color.'</span>
                                    </div>
                                </div>
                                <div class="flex flex-col gap-025 small">
                                    <div class="flex flex-row gap-05 flex-align-c w-fa">
                                        <span class="bold">Stílus:</span>
                                        <span class="text-secondary">'.$style.'</span>
                                    </div>
                                    <div class="flex flex-row gap-05 flex-align-c w-fa">
                                        <span class="bold">Modell:</span>
                                        <span class="text-secondary">'.$model.'</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div><hr style="border: 1px solid var(--background);" class="w-100">
                ';
            } else { echo 'nincs ilyen termek'; }
            $stmt->close();
        }
        echo '</div>';
        echo '
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
        <script>
        var btn = document.querySelectorAll(".splash");
        for (let i = 0; i < btn.length; i++) { btn[i].addEventListener("click", createRipple); }
        function createRipple(e) { let btn = e.target; if (btn?.tagName == "svg") { btn = btn.parentNode; } if (btn?.tagName == "rect") { btn = btn.parentNode.parentNode; }
            let boundingBox = btn.getBoundingClientRect(); let x = e.clientX - boundingBox.left; let y = e.clientY - boundingBox.top; let ripple = document.createElement("span"); ripple.classList.add("ripple");
            ripple.style.left = `${x}px`; ripple.style.top = `${y}px`; btn.appendChild(ripple); ripple.addEventListener("animationend", () => { ripple.remove() });
        }
        </script>
        ';
    } else { echo '<script>window.location.href = "/404"</script>'; }
} else { echo '<script>window.location.href = "/"</script>'; }

?>
<script>
    let fbe = document.getElementsByClassName('fbe');
    for (let i = 0; i < fbe.length; i++) {
        fbe[i].innerHTML = formatter.format(fbe[i].getAttribute('data-value'));
    }
</script>