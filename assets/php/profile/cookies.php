<?php
if ($_POST['alert'] === "outdpw") {
    $expiry = (time() + (86400 * 3)); $cookie = 'alert:outdpw;status:sleep'. ':'. $expiry;
    $mac = hash_hmac('sha256', $cookie, 'saltkey256'); setcookie('__al__oupw', $cookie, $expiry, "/"); die("200");
} if ($_POST['alert'] === "emrem") {
    $expiry = (time() + (86400 * 3)); $cookie = 'alert:emrem;status:sleep'. ':'. $expiry;
    $mac = hash_hmac('sha256', $cookie, 'saltkey256'); setcookie('__al__emrem', $cookie, $expiry, "/"); die("200");
}
?>