<?php require_once($_SERVER['DOCUMENT_ROOT'].'/includes/header.php'); require_once($_SERVER['DOCUMENT_ROOT'].'/includes/inc.php'); require_once($_SERVER['DOCUMENT_ROOT'].'/assets/alph.php'); $uid = $_SESSION['id'];

if (!isset($_SESSION['loggedin'])) { echo '<script>window.location.href = "/"</script>'; header('Location: /'); exit(); }
$stmt = $con->prepare('SELECT privilege FROM customers__priv  WHERE uid = ?'); if (isset($_SESSION['loggedin'])) {$id = $_SESSION['id'];} $stmt->bind_param('i', $id);$stmt->execute(); $stmt->bind_result($privilege); $stmt->fetch();$stmt->close();
function get_time_ago( $time ) {
    $time_difference = time() - $time;
    if( $time_difference < 1 ) { return '< 1mp'; }
    $condition = array( 12 * 30 * 24 * 60 * 60 =>  'éve',30 * 24 * 60 * 60 => 'hónapja',24 * 60 * 60 => 'napja',60 * 60 =>  'órája',60 =>  'perce',1 =>  'másodperce');
    foreach( $condition as $secs => $str ) {$d = $time_difference / $secs;if( $d >= 1 ) {$t = round( $d );return $t . ' ' . $str . ( $t > 1 ? '' : '' ) . '';}}
}
$getOrderDetails = $con->prepare('SELECT orders.id, status, date, orders__invoice.zip, orders__invoice.settlement, orders__invoice.address, orders__invoice.tax, orders__ship.method, orders__ship.zip AS szip, orders__ship.settlement AS ssettlement, orders__ship.address AS saddress, orders__ship.note, orders__payment.cid, orders__payment.subTotal, orders__user.fullname, orders__user.company, orders__user.email, orders__user.phone FROM orders INNER JOIN orders__invoice ON orders__invoice.oid = orders.id INNER JOIN orders__ship ON orders__ship.oid = orders.id INNER JOIN orders__payment ON orders__payment.oid = orders.id INNER JOIN orders__user ON orders__user.oid = orders.id WHERE orders.id = ?');
$getOrderDetails->bind_param('i', $params['oid']); $getOrderDetails->execute(); $getOrderDetails->store_result();
if ($getOrderDetails->num_rows() > 0) { $getOrderDetails->bind_result($getOrderId, $getOrderStatus, $getOrderDate, $getOrderZip, $getOrderSettlement, $getOrderAddress, $getOrderTax, $getOrderSMethod, $getOrderSZip, $getOrderSSettlement, $getOrderSAddress, $getOrderNote, $getOrderCid, $getOrderSubTotal, $getOrderFullname, $getOrderCompany, $getOrderEmail, $getOrderPhone); $getOrderDetails->fetch(); $getOrderDetails->close(); }
else { echo '<script>window.location.href = "/404"</script>'; header('Location: /404'); } 

?>
<main class="flex flex-col gap-1">
    <nav class="flex flex-row flex-align-c flex-justify-con-sb gap-1 w-fa">
        <span class="text-muted small-med"><a class="link link-color pointer" href="/admin/">Admin</a> / <a class="link link-color pointer" href="/admin/?tab=orders">Megrendelések</a> / #<?= $params['oid'] ?></span>
    </nav>
    <div class="flex flex-row flex-align-c gap-1">
        <div class="flex flex-row flex-justify-con-c flex-wrap-m gap-05 prio__con w-100">
            <div class="flex flex-col item-bg border-soft w-40 padding-1 gap-2">
                <div class="flex flex-row flex-align-c flex-justify-con-sb w-fa gap-05">
                    <span class="larger text-primary bold">Rendelés Részletei (#<?= $getOrderId; ?>)</span>
                    <div class="flex flex-row flex-align-c flex-justify-con-fe gap-1 user-select-none">
                        <a class="flex flex-row flex-align-c gap-1 primary-bg primary-bg-hover border-soft-light padding-05 smaller-light pointer" title="Szerkesztés" aria-label="Szekesztés"><svg width="18" height="18" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path opacity="0.3" d="M21.4 8.35303L19.241 10.511L13.485 4.755L15.643 2.59595C16.0248 2.21423 16.5426 1.99988 17.0825 1.99988C17.6224 1.99988 18.1402 2.21423 18.522 2.59595L21.4 5.474C21.7817 5.85581 21.9962 6.37355 21.9962 6.91345C21.9962 7.45335 21.7817 7.97122 21.4 8.35303ZM3.68699 21.932L9.88699 19.865L4.13099 14.109L2.06399 20.309C1.98815 20.5354 1.97703 20.7787 2.03189 21.0111C2.08674 21.2436 2.2054 21.4561 2.37449 21.6248C2.54359 21.7934 2.75641 21.9115 2.989 21.9658C3.22158 22.0201 3.4647 22.0084 3.69099 21.932H3.68699Z" fill="currentColor"/><path d="M5.574 21.3L3.692 21.928C3.46591 22.0032 3.22334 22.0141 2.99144 21.9594C2.75954 21.9046 2.54744 21.7864 2.3789 21.6179C2.21036 21.4495 2.09202 21.2375 2.03711 21.0056C1.9822 20.7737 1.99289 20.5312 2.06799 20.3051L2.696 18.422L5.574 21.3ZM4.13499 14.105L9.891 19.861L19.245 10.507L13.489 4.75098L4.13499 14.105Z" fill="currentColor"/></svg></a>
                    </div>
                </div>
                <div class="flex flex-col gap-05 padding-05 margin-top-a text-muted small">
                    <div class="flex flex-row flex-justify-con-sb gap-1 w-fa">
                        <div class="flex flex-row flex-align-c gap-05">
                            <svg width="18" height="18" viewBox="0 0 20 21" fill="none" xmlns="http://www.w3.org/2000/svg"><path opacity="0.3" d="M19 3.40002C18.4 3.40002 18 3.80002 18 4.40002V8.40002H14V4.40002C14 3.80002 13.6 3.40002 13 3.40002C12.4 3.40002 12 3.80002 12 4.40002V8.40002H8V4.40002C8 3.80002 7.6 3.40002 7 3.40002C6.4 3.40002 6 3.80002 6 4.40002V8.40002H2V4.40002C2 3.80002 1.6 3.40002 1 3.40002C0.4 3.40002 0 3.80002 0 4.40002V19.4C0 20 0.4 20.4 1 20.4H19C19.6 20.4 20 20 20 19.4V4.40002C20 3.80002 19.6 3.40002 19 3.40002ZM18 10.4V13.4H14V10.4H18ZM12 10.4V13.4H8V10.4H12ZM12 15.4V18.4H8V15.4H12ZM6 10.4V13.4H2V10.4H6ZM2 15.4H6V18.4H2V15.4ZM14 18.4V15.4H18V18.4H14Z" fill="currentColor"></path><path d="M19 0.400024H1C0.4 0.400024 0 0.800024 0 1.40002V4.40002C0 5.00002 0.4 5.40002 1 5.40002H19C19.6 5.40002 20 5.00002 20 4.40002V1.40002C20 0.800024 19.6 0.400024 19 0.400024Z" fill="currentColor"></path></svg>
                            <span>Rendelés leadva</span>
                        </div>
                        <span class="text-muted bold"><?= $getOrderDate; ?></span>
                    </div><hr style="border: 1px solid var(--background); width: 100%;">
                    <div class="flex flex-row flex-justify-con-sb gap-1 w-fa">
                        <div class="flex flex-row flex-align-c gap-05">
                            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path opacity="0.3" d="M3.20001 5.91897L16.9 3.01895C17.4 2.91895 18 3.219 18.1 3.819L19.2 9.01895L3.20001 5.91897Z" fill="currentColor"></path><path opacity="0.3" d="M13 13.9189C13 12.2189 14.3 10.9189 16 10.9189H21C21.6 10.9189 22 11.3189 22 11.9189V15.9189C22 16.5189 21.6 16.9189 21 16.9189H16C14.3 16.9189 13 15.6189 13 13.9189ZM16 12.4189C15.2 12.4189 14.5 13.1189 14.5 13.9189C14.5 14.7189 15.2 15.4189 16 15.4189C16.8 15.4189 17.5 14.7189 17.5 13.9189C17.5 13.1189 16.8 12.4189 16 12.4189Z" fill="currentColor"></path><path d="M13 13.9189C13 12.2189 14.3 10.9189 16 10.9189H21V7.91895C21 6.81895 20.1 5.91895 19 5.91895H3C2.4 5.91895 2 6.31895 2 6.91895V20.9189C2 21.5189 2.4 21.9189 3 21.9189H19C20.1 21.9189 21 21.0189 21 19.9189V16.9189H16C14.3 16.9189 13 15.6189 13 13.9189Z" fill="currentColor"></path></svg>
                            <span>Fizetési metód</span>
                        </div>
                        <span class="text-muted bold"><?= $getOrderCid; ?></span>
                    </div><hr style="border: 1px solid var(--background); width: 100%;">
                    <div class="flex flex-row flex-justify-con-sb gap-1 w-fa">
                        <div class="flex flex-row flex-align-c gap-05">
                            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M20 8H16C15.4 8 15 8.4 15 9V16H10V17C10 17.6 10.4 18 11 18H16C16 16.9 16.9 16 18 16C19.1 16 20 16.9 20 18H21C21.6 18 22 17.6 22 17V13L20 8Z" fill="currentColor"></path><path opacity="0.3" d="M20 18C20 19.1 19.1 20 18 20C16.9 20 16 19.1 16 18C16 16.9 16.9 16 18 16C19.1 16 20 16.9 20 18ZM15 4C15 3.4 14.6 3 14 3H3C2.4 3 2 3.4 2 4V13C2 13.6 2.4 14 3 14H15V4ZM6 16C4.9 16 4 16.9 4 18C4 19.1 4.9 20 6 20C7.1 20 8 19.1 8 18C8 16.9 7.1 16 6 16Z" fill="currentColor"></path></svg>
                            <span>Szállítási metód</span>
                        </div>
                        <span class="text-muted bold"><?= strtoupper($getOrderSMethod); ?></span>
                    </div>
                </div>
            </div>
            <div class="flex flex-col item-bg border-soft w-40 padding-1 gap-2">
                <div class="flex flex-row flex-align-c flex-justify-con-sb w-fa gap-05">
                    <span class="larger text-primary bold">Vevő Adatai</span>
                    <div class="flex flex-row flex-align-c flex-justify-con-fe gap-1 user-select-none">
                        <a class="flex flex-row flex-align-c gap-1 primary-bg primary-bg-hover border-soft-light padding-05 smaller-light pointer" title="Szerkesztés" aria-label="Szekesztés"><svg width="18" height="18" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path opacity="0.3" d="M21.4 8.35303L19.241 10.511L13.485 4.755L15.643 2.59595C16.0248 2.21423 16.5426 1.99988 17.0825 1.99988C17.6224 1.99988 18.1402 2.21423 18.522 2.59595L21.4 5.474C21.7817 5.85581 21.9962 6.37355 21.9962 6.91345C21.9962 7.45335 21.7817 7.97122 21.4 8.35303ZM3.68699 21.932L9.88699 19.865L4.13099 14.109L2.06399 20.309C1.98815 20.5354 1.97703 20.7787 2.03189 21.0111C2.08674 21.2436 2.2054 21.4561 2.37449 21.6248C2.54359 21.7934 2.75641 21.9115 2.989 21.9658C3.22158 22.0201 3.4647 22.0084 3.69099 21.932H3.68699Z" fill="currentColor"/><path d="M5.574 21.3L3.692 21.928C3.46591 22.0032 3.22334 22.0141 2.99144 21.9594C2.75954 21.9046 2.54744 21.7864 2.3789 21.6179C2.21036 21.4495 2.09202 21.2375 2.03711 21.0056C1.9822 20.7737 1.99289 20.5312 2.06799 20.3051L2.696 18.422L5.574 21.3ZM4.13499 14.105L9.891 19.861L19.245 10.507L13.489 4.75098L4.13499 14.105Z" fill="currentColor"/></svg></a>
                    </div>
                </div>
                <div class="flex flex-col gap-05 padding-05 margin-top-a text-muted small">
                    <div class="flex flex-row flex-justify-con-sb gap-1 w-fa">
                        <div class="flex flex-row flex-align-c gap-05">
                            <svg width="18" height="18" viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg"><path opacity="0.3" d="M16.5 9C16.5 13.125 13.125 16.5 9 16.5C4.875 16.5 1.5 13.125 1.5 9C1.5 4.875 4.875 1.5 9 1.5C13.125 1.5 16.5 4.875 16.5 9Z" fill="currentColor"></path><path d="M9 16.5C10.95 16.5 12.75 15.75 14.025 14.55C13.425 12.675 11.4 11.25 9 11.25C6.6 11.25 4.57499 12.675 3.97499 14.55C5.24999 15.75 7.05 16.5 9 16.5Z" fill="currentColor"></path><rect x="7" y="6" width="4" height="4" rx="2" fill="currentColor"></rect></svg>
                            <span>Vásárló</span>
                        </div>
                        <span class="text-muted bold"><?= $getOrderFullname; ?></span>
                    </div><hr style="border: 1px solid var(--background); width: 100%;">
                    <div class="flex flex-row flex-justify-con-sb gap-1 w-fa">
                        <div class="flex flex-row flex-align-c gap-05">
                            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path opacity="0.3" d="M21 19H3C2.4 19 2 18.6 2 18V6C2 5.4 2.4 5 3 5H21C21.6 5 22 5.4 22 6V18C22 18.6 21.6 19 21 19Z" fill="currentColor"></path><path d="M21 5H2.99999C2.69999 5 2.49999 5.10005 2.29999 5.30005L11.2 13.3C11.7 13.7 12.4 13.7 12.8 13.3L21.7 5.30005C21.5 5.10005 21.3 5 21 5Z" fill="currentColor"></path></svg>
                            <span>Email</span>
                        </div>
                        <span class="text-muted bold"><?= $getOrderEmail; ?></span>
                    </div><hr style="border: 1px solid var(--background); width: 100%;">
                    <div class="flex flex-row flex-justify-con-sb gap-1 w-fa">
                        <div class="flex flex-row flex-align-c gap-05">
                            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M5 20H19V21C19 21.6 18.6 22 18 22H6C5.4 22 5 21.6 5 21V20ZM19 3C19 2.4 18.6 2 18 2H6C5.4 2 5 2.4 5 3V4H19V3Z" fill="currentColor"></path><path opacity="0.3" d="M19 4H5V20H19V4Z" fill="currentColor"></path></svg>
                            <span>Telefon</span>
                        </div>
                        <span class="text-muted bold"><?= $getOrderPhone; ?></span>
                    </div>
                </div>
            </div>
            <div class="flex flex-col item-bg border-soft w-40 padding-1 gap-2">
                <div class="flex flex-col w-fa gap-05">
                    <span class="larger text-primary bold">Dokumentumok</span>
                </div>
                <div class="flex flex-col gap-05 padding-05 margin-top-a text-muted small">
                    <div class="flex flex-row flex-justify-con-sb gap-1 w-fa">
                        <div class="flex flex-row flex-align-c gap-05">
                            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path opacity="0.3" d="M18 21.6C16.3 21.6 15 20.3 15 18.6V2.50001C15 2.20001 14.6 1.99996 14.3 2.19996L13 3.59999L11.7 2.3C11.3 1.9 10.7 1.9 10.3 2.3L9 3.59999L7.70001 2.3C7.30001 1.9 6.69999 1.9 6.29999 2.3L5 3.59999L3.70001 2.3C3.50001 2.1 3 2.20001 3 3.50001V18.6C3 20.3 4.3 21.6 6 21.6H18Z" fill="currentColor"></path><path d="M12 12.6H11C10.4 12.6 10 12.2 10 11.6C10 11 10.4 10.6 11 10.6H12C12.6 10.6 13 11 13 11.6C13 12.2 12.6 12.6 12 12.6ZM9 11.6C9 11 8.6 10.6 8 10.6H6C5.4 10.6 5 11 5 11.6C5 12.2 5.4 12.6 6 12.6H8C8.6 12.6 9 12.2 9 11.6ZM9 7.59998C9 6.99998 8.6 6.59998 8 6.59998H6C5.4 6.59998 5 6.99998 5 7.59998C5 8.19998 5.4 8.59998 6 8.59998H8C8.6 8.59998 9 8.19998 9 7.59998ZM13 7.59998C13 6.99998 12.6 6.59998 12 6.59998H11C10.4 6.59998 10 6.99998 10 7.59998C10 8.19998 10.4 8.59998 11 8.59998H12C12.6 8.59998 13 8.19998 13 7.59998ZM13 15.6C13 15 12.6 14.6 12 14.6H10C9.4 14.6 9 15 9 15.6C9 16.2 9.4 16.6 10 16.6H12C12.6 16.6 13 16.2 13 15.6Z" fill="currentColor"></path><path d="M15 18.6C15 20.3 16.3 21.6 18 21.6C19.7 21.6 21 20.3 21 18.6V12.5C21 12.2 20.6 12 20.3 12.2L19 13.6L17.7 12.3C17.3 11.9 16.7 11.9 16.3 12.3L15 13.6V18.6Z" fill="currentColor"></path></svg>
                            <span>Számlázás</span>
                        </div>
                        <span class="text-primary-light link user-select-none pointer bold">Megtekintés</span>
                    </div><hr style="border: 1px solid var(--background); width: 100%;">
                    <div class="flex flex-row flex-justify-con-sb gap-1 w-fa">
                        <div class="flex flex-row flex-align-c gap-05">
                            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M20 8H16C15.4 8 15 8.4 15 9V16H10V17C10 17.6 10.4 18 11 18H16C16 16.9 16.9 16 18 16C19.1 16 20 16.9 20 18H21C21.6 18 22 17.6 22 17V13L20 8Z" fill="currentColor"></path><path opacity="0.3" d="M20 18C20 19.1 19.1 20 18 20C16.9 20 16 19.1 16 18C16 16.9 16.9 16 18 16C19.1 16 20 16.9 20 18ZM15 4C15 3.4 14.6 3 14 3H3C2.4 3 2 3.4 2 4V13C2 13.6 2.4 14 3 14H15V4ZM6 16C4.9 16 4 16.9 4 18C4 19.1 4.9 20 6 20C7.1 20 8 19.1 8 18C8 16.9 7.1 16 6 16Z" fill="currentColor"></path></svg>
                            <span>Szállítás</span>
                        </div>
                        <span class="text-primary-light link user-select-none pointer bold">Megtekintés</span>
                    </div><hr style="border: 1px solid var(--background); width: 100%;">
                    <div class="flex flex-row flex-justify-con-sb gap-1 w-fa">
                        <div class="flex flex-row flex-align-c gap-05">
                            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path opacity="0.3" d="M21.6 11.2L19.3 8.89998V5.59993C19.3 4.99993 18.9 4.59993 18.3 4.59993H14.9L12.6 2.3C12.2 1.9 11.6 1.9 11.2 2.3L8.9 4.59993H5.6C5 4.59993 4.6 4.99993 4.6 5.59993V8.89998L2.3 11.2C1.9 11.6 1.9 12.1999 2.3 12.5999L4.6 14.9V18.2C4.6 18.8 5 19.2 5.6 19.2H8.9L11.2 21.5C11.6 21.9 12.2 21.9 12.6 21.5L14.9 19.2H18.2C18.8 19.2 19.2 18.8 19.2 18.2V14.9L21.5 12.5999C22 12.1999 22 11.6 21.6 11.2Z" fill="currentColor"></path><path d="M11.3 9.40002C11.3 10.2 11.1 10.9 10.7 11.3C10.3 11.7 9.8 11.9 9.2 11.9C8.8 11.9 8.40001 11.8 8.10001 11.6C7.80001 11.4 7.50001 11.2 7.40001 10.8C7.20001 10.4 7.10001 10 7.10001 9.40002C7.10001 8.80002 7.20001 8.4 7.30001 8C7.40001 7.6 7.7 7.29998 8 7.09998C8.3 6.89998 8.7 6.80005 9.2 6.80005C9.5 6.80005 9.80001 6.9 10.1 7C10.4 7.1 10.6 7.3 10.8 7.5C11 7.7 11.1 8.00005 11.2 8.30005C11.3 8.60005 11.3 9.00002 11.3 9.40002ZM10.1 9.40002C10.1 8.80002 10 8.39998 9.90001 8.09998C9.80001 7.79998 9.6 7.70007 9.2 7.70007C9 7.70007 8.8 7.80002 8.7 7.90002C8.6 8.00002 8.50001 8.2 8.40001 8.5C8.40001 8.7 8.30001 9.10002 8.30001 9.40002C8.30001 9.80002 8.30001 10.1 8.40001 10.4C8.40001 10.6 8.5 10.8 8.7 11C8.8 11.1 9 11.2001 9.2 11.2001C9.5 11.2001 9.70001 11.1 9.90001 10.8C10 10.4 10.1 10 10.1 9.40002ZM14.9 7.80005L9.40001 16.7001C9.30001 16.9001 9.10001 17.1 8.90001 17.1C8.80001 17.1 8.70001 17.1 8.60001 17C8.50001 16.9 8.40001 16.8001 8.40001 16.7001C8.40001 16.6001 8.4 16.5 8.5 16.4L14 7.5C14.1 7.3 14.2 7.19998 14.3 7.09998C14.4 6.99998 14.5 7 14.6 7C14.7 7 14.8 6.99998 14.9 7.09998C15 7.19998 15 7.30002 15 7.40002C15.2 7.30002 15.1 7.50005 14.9 7.80005ZM16.6 14.2001C16.6 15.0001 16.4 15.7 16 16.1C15.6 16.5 15.1 16.7001 14.5 16.7001C14.1 16.7001 13.7 16.6 13.4 16.4C13.1 16.2 12.8 16 12.7 15.6C12.5 15.2 12.4 14.8001 12.4 14.2001C12.4 13.3001 12.6 12.7 12.9 12.3C13.2 11.9 13.7 11.7001 14.5 11.7001C14.8 11.7001 15.1 11.8 15.4 11.9C15.7 12 15.9 12.2 16.1 12.4C16.3 12.6 16.4 12.9001 16.5 13.2001C16.6 13.4001 16.6 13.8001 16.6 14.2001ZM15.4 14.1C15.4 13.5 15.3 13.1 15.2 12.9C15.1 12.6 14.9 12.5 14.5 12.5C14.3 12.5 14.1 12.6001 14 12.7001C13.9 12.8001 13.8 13.0001 13.7 13.2001C13.6 13.4001 13.6 13.8 13.6 14.1C13.6 14.7 13.7 15.1 13.8 15.4C13.9 15.7 14.1 15.8 14.5 15.8C14.8 15.8 15 15.7 15.2 15.4C15.3 15.2 15.4 14.7 15.4 14.1Z" fill="currentColor"></path></svg>
                            <span>Végösszeg</span>
                        </div>
                        <span class="text-secondary bold"><?= $getOrderSubTotal; ?> Ft</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="flex flex-row flex-align-c gap-1">
        <div class="flex flex-col item-bg border-soft w-50d-fam padding-1 gap-2">
            <div class="flex flex-row flex-align-c flex-justify-con-sb w-fa gap-05">
                <span class="larger text-primary bold">Számlázási Cím</span>
                <div class="flex flex-row flex-align-c flex-justify-con-fe gap-1 user-select-none">
                    <a class="flex flex-row flex-align-c gap-1 primary-bg primary-bg-hover border-soft-light padding-05 smaller-light pointer" title="Szerkesztés" aria-label="Szekesztés"><svg width="18" height="18" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path opacity="0.3" d="M21.4 8.35303L19.241 10.511L13.485 4.755L15.643 2.59595C16.0248 2.21423 16.5426 1.99988 17.0825 1.99988C17.6224 1.99988 18.1402 2.21423 18.522 2.59595L21.4 5.474C21.7817 5.85581 21.9962 6.37355 21.9962 6.91345C21.9962 7.45335 21.7817 7.97122 21.4 8.35303ZM3.68699 21.932L9.88699 19.865L4.13099 14.109L2.06399 20.309C1.98815 20.5354 1.97703 20.7787 2.03189 21.0111C2.08674 21.2436 2.2054 21.4561 2.37449 21.6248C2.54359 21.7934 2.75641 21.9115 2.989 21.9658C3.22158 22.0201 3.4647 22.0084 3.69099 21.932H3.68699Z" fill="currentColor"/><path d="M5.574 21.3L3.692 21.928C3.46591 22.0032 3.22334 22.0141 2.99144 21.9594C2.75954 21.9046 2.54744 21.7864 2.3789 21.6179C2.21036 21.4495 2.09202 21.2375 2.03711 21.0056C1.9822 20.7737 1.99289 20.5312 2.06799 20.3051L2.696 18.422L5.574 21.3ZM4.13499 14.105L9.891 19.861L19.245 10.507L13.489 4.75098L4.13499 14.105Z" fill="currentColor"/></svg></a>
                </div>
            </div>
            <div class="flex flex-row flex-align-c flex-justify-con-sb w-fa gap-1 text-muted">
                <div class="flex flex-col gap-025 small">
                    <span><?= $getOrderZip . ', '. $getOrderSettlement; ?></span>
                    <span><?= $getOrderAddress; ?></span>
                    <span><?= $getOrderTax; ?></span>
                </div>
                <svg class="user-select-none" width="104" height="104" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path opacity="0.3" d="M18.041 22.041C18.5932 22.041 19.041 21.5932 19.041 21.041C19.041 20.4887 18.5932 20.041 18.041 20.041C17.4887 20.041 17.041 20.4887 17.041 21.041C17.041 21.5932 17.4887 22.041 18.041 22.041Z" fill="currentColor"/><path opacity="0.3" d="M6.04095 22.041C6.59324 22.041 7.04095 21.5932 7.04095 21.041C7.04095 20.4887 6.59324 20.041 6.04095 20.041C5.48867 20.041 5.04095 20.4887 5.04095 21.041C5.04095 21.5932 5.48867 22.041 6.04095 22.041Z" fill="currentColor"/><path opacity="0.3" d="M7.04095 16.041L19.1409 15.1409C19.7409 15.1409 20.141 14.7409 20.341 14.1409L21.7409 8.34094C21.9409 7.64094 21.4409 7.04095 20.7409 7.04095H5.44095L7.04095 16.041Z" fill="currentColor"/><path d="M19.041 20.041H5.04096C4.74096 20.041 4.34095 19.841 4.14095 19.541C3.94095 19.241 3.94095 18.841 4.14095 18.541L6.04096 14.841L4.14095 4.64095L2.54096 3.84096C2.04096 3.64096 1.84095 3.04097 2.14095 2.54097C2.34095 2.04097 2.94096 1.84095 3.44096 2.14095L5.44096 3.14095C5.74096 3.24095 5.94096 3.54096 5.94096 3.84096L7.94096 14.841C7.94096 15.041 7.94095 15.241 7.84095 15.441L6.54096 18.041H19.041C19.641 18.041 20.041 18.441 20.041 19.041C20.041 19.641 19.641 20.041 19.041 20.041Z" fill="currentColor"/></svg>
            </div>
        </div>
        <div class="flex flex-col item-bg border-soft w-50d-fam padding-1 gap-2">
            <div class="flex flex-row flex-align-c flex-justify-con-sb w-fa gap-05">
                <span class="larger text-primary bold">Szállítási Cím</span>
                <div class="flex flex-row flex-align-c flex-justify-con-fe gap-1 user-select-none">
                    <a class="flex flex-row flex-align-c gap-1 primary-bg primary-bg-hover border-soft-light padding-05 smaller-light pointer" title="Szerkesztés" aria-label="Szekesztés"><svg width="18" height="18" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path opacity="0.3" d="M21.4 8.35303L19.241 10.511L13.485 4.755L15.643 2.59595C16.0248 2.21423 16.5426 1.99988 17.0825 1.99988C17.6224 1.99988 18.1402 2.21423 18.522 2.59595L21.4 5.474C21.7817 5.85581 21.9962 6.37355 21.9962 6.91345C21.9962 7.45335 21.7817 7.97122 21.4 8.35303ZM3.68699 21.932L9.88699 19.865L4.13099 14.109L2.06399 20.309C1.98815 20.5354 1.97703 20.7787 2.03189 21.0111C2.08674 21.2436 2.2054 21.4561 2.37449 21.6248C2.54359 21.7934 2.75641 21.9115 2.989 21.9658C3.22158 22.0201 3.4647 22.0084 3.69099 21.932H3.68699Z" fill="currentColor"/><path d="M5.574 21.3L3.692 21.928C3.46591 22.0032 3.22334 22.0141 2.99144 21.9594C2.75954 21.9046 2.54744 21.7864 2.3789 21.6179C2.21036 21.4495 2.09202 21.2375 2.03711 21.0056C1.9822 20.7737 1.99289 20.5312 2.06799 20.3051L2.696 18.422L5.574 21.3ZM4.13499 14.105L9.891 19.861L19.245 10.507L13.489 4.75098L4.13499 14.105Z" fill="currentColor"/></svg></a>
                </div>
            </div>
            <div class="flex flex-row flex-align-c flex-justify-con-sb w-fa gap-1 text-muted">
                <div class="flex flex-col gap-025 small">
                    <span><?= $getOrderSZip . ', '. $getOrderSSettlement; ?></span>
                    <span><?= $getOrderSAddress; ?></span>
                    <span><?= $getOrderNote; ?></span>
                </div>
                <svg width="104" height="104" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M20 8H16C15.4 8 15 8.4 15 9V16H10V17C10 17.6 10.4 18 11 18H16C16 16.9 16.9 16 18 16C19.1 16 20 16.9 20 18H21C21.6 18 22 17.6 22 17V13L20 8Z" fill="currentColor"></path><path opacity="0.3" d="M20 18C20 19.1 19.1 20 18 20C16.9 20 16 19.1 16 18C16 16.9 16.9 16 18 16C19.1 16 20 16.9 20 18ZM15 4C15 3.4 14.6 3 14 3H3C2.4 3 2 3.4 2 4V13C2 13.6 2.4 14 3 14H15V4ZM6 16C4.9 16 4 16.9 4 18C4 19.1 4.9 20 6 20C7.1 20 8 19.1 8 18C8 16.9 7.1 16 6 16Z" fill="currentColor"></path></svg>
            </div>
        </div>
    </div>
    <div class="flex flex-row flex-align-c flex-justify-con-c flex-wrap w-fa gap-1">
        <div class="flex flex-row flex-align-c flex-justify-con-c flex-wrap w-fa gap-1" id="orders-con">
            <div class="flex flex-row w-fa overflow-x-scroll hide-scroll item-bg box-shadow border-soft">
                <table class="sess__history text-muted text-align-c w-fa item-bg padding-05 table-padding-05 table-fixed compare-table text-align-c" style="border-collapse: collapse;" id="users-table">
                    <tr class="small uppercase sessh__header" style="line-height: 2;">
                        <th>
                            <label class="cst-chb-lbl">
                                <input type="checkbox" class="absolute" id="check_all_item">
                                <span class="cst-checkbox"></span>
                            </label>
                        </th>
                        <th class="text-align-l">Termék</th>
                        <th>Mennyiség</th>
                        <th>Darab Összeg</th>
                        <th>Összesen</th>
                    </tr>
                    <?php
                        $orderDetails = $con->prepare("SELECT items, subTotal, voucherDiscount FROM orders INNER JOIN orders__payment ON orders__payment.oid = orders.id WHERE orders.id = ?");
                        $orderDetails->bind_param('i', $params['oid']); $orderDetails->execute(); $orderDetails->store_result(); $orderDetails->bind_result($orderItems, $orderSubTotal, $orderVoucher); $orderDetails->fetch(); $orderDetails->close();
                        for ($i = 0; $i < count(explode(';', rtrim($orderItems, ";"))); $i++) {
                            $itemDetails = $con->prepare('SELECT name, thumbnail, base, discount FROM products INNER JOIN products__pricing ON products__pricing.pid = products.id WHERE products.id = ?');
                            $itemDetails->bind_param('i', explode(':', explode(';', $orderItems)[$i])[0]); $itemDetails->execute(); $itemDetails->store_result(); $itemDetails->bind_result($itemName, $itemThumbnail, $itemPrice, $itemDiscount); $itemDetails->fetch(); $itemDetails->free_result(); $itemDetails->close(); $con->next_result();
                            $thumbnail = "'/assets/images/uploads/".$itemThumbnail."'";
                            echo '
                                <tr>
                                    <td class="text-align-c padding-1">
                                        <label class="cst-chb-lbl">
                                            <input type="checkbox" class="absolute">
                                            <span class="cst-checkbox"></span>
                                        </label>
                                    </td>
                                    <td>
                                        <div class="flex flex-row flex-align-c gap-1">
                                            <div class="product-miniature pointer drop-shadow" style="background-image: url('.$thumbnail.');"></div>
                                            <span class="text-secondary bold">'.mb_substr($itemName, 0, 80).'</span>
                                        </div>
                                    </td>
                                    <td>'.explode(':', explode(';', $orderItems)[$i])[1].'</td>
                                    <td>'.$itemPrice.' Ft</td>
                                    <td>'.$itemPrice * explode(':', explode(';', $orderItems)[$i])[1].' Ft</td>
                                </tr>
                            ';
                        }
                    ?>
                </table>
            </div>
        </div>
    </div>
</main>
<?php require_once($_SERVER['DOCUMENT_ROOT'].'/includes/footer.php'); ?>