<?php require_once($_SERVER['DOCUMENT_ROOT'].'/includes/inc.php');

if (isset($_SESSION['loggedin'])) {
    if (isset($_GET['id'])) {
        if (is_numeric($_GET['id'])) {
            $stmt = $con->prepare('SELECT name FROM products WHERE id = ?');
            $stmt->bind_param('i', $_GET['id']);$stmt->execute(); $stmt -> store_result();
            $stmt->bind_result($name); $stmt->fetch();
            if ($stmt->num_rows > 0) {
                echo '
                <div>
                    <div class="flex flex-row flex-align-c flex-justify-con-sa w-fa flex-wrap gap-1">
                        <div class="flex flex-row flex-align-c flex-justify-con-c gap-05 padding-025 border-soft">
                            <span class="flex flex-row flex-align-c flex-justify-con-c text-align-c circle background-bg padding-1 text-primary" style="width: .25rem; height: .25rem;">1</span>
                            <span class="text-primary">Vevő adatai</span>
                        </div>
                        <div class="flex flex-row flex-align-c flex-justify-con-c gap-05 padding-0-05">
                            <span class="flex flex-row flex-align-c flex-justify-con-c text-align-c circle background-bg padding-1 text-primary" style="width: .25rem; height: .25rem;">2</span>
                            <span class="text-primary">Szállítás</span>
                        </div>
                        <div class="flex flex-row flex-align-c flex-justify-con-c gap-05 padding-0-05">
                            <span class="flex flex-row flex-align-c flex-justify-con-c text-align-c circle background-bg padding-1 text-primary" style="width: .25rem; height: .25rem;">3</span>
                            <span class="text-primary">Fizetés</span>
                        </div>
                        <div class="flex flex-row flex-align-c flex-justify-con-c gap-05 padding-0-05">
                            <span class="flex flex-row flex-align-c flex-justify-con-c text-align-c circle background-bg padding-1 text-primary" style="width: .25rem; height: .25rem;">4</span>
                            <span class="text-primary">Rendelés</span>
                        </div>
                    </div><hr style="border: 1px solid var(--background);" class="w-100">
                <div><br>
                <div class="flex flex-row-d-col-m gap-1 w-fa">
                    <div class="flex flex-row-d-col-m gap-1 w-50d-100m">
                        <span>img</span>
                        <span>info</span>
                    </div>
                    <div class="w-fa">form</div>
                </div>
                ';
            } else { echo 'nincs ilyen termek'; }
            $stmt->close();
        } else { echo '<script>window.location.href = "/404"</script>'; }
    } else { echo '<script>window.location.href = "/404"</script>'; }
} else { echo '<script>window.location.href = "/"</script>'; }

?>