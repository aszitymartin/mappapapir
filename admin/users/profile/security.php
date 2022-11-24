<?php require_once($_SERVER['DOCUMENT_ROOT'].'/includes/inc.php');
if (isset($_SESSION['loggedin'])) {
    $stmt = $con->prepare('SELECT privilege FROM customers__priv  WHERE uid = ?'); if (isset($_SESSION['loggedin'])) {$id = $_SESSION['id'];} $stmt->bind_param('i', $id);$stmt->execute(); $stmt->bind_result($privilege); $stmt->fetch();$stmt->close();
    if ($privilege != 2) { echo "<script>window.location.href='/';</script>"; }
} else { header("Location: /"); }
$uid = $_SESSION['guid'];
function get_time_ago( $time ) { $time_difference = time() - $time; if( $time_difference < 1 ) { return '< 1mp'; }
    $condition = array( 12 * 30 * 24 * 60 * 60 =>  'éve',30 * 24 * 60 * 60 => 'hónapja',24 * 60 * 60 => 'napja',60 * 60 =>  'órája',60 =>  'perce',1 =>  'másodperce');
    foreach( $condition as $secs => $str ) {$d = $time_difference / $secs;if( $d >= 1 ) {$t = round( $d );return $t . ' ' . $str . ( $t > 1 ? '' : '' ) . '';}}
}
?>
<div class="flex flex-row-d-col-m gap-1">
    <div class="flex flex-col w-fa gap-1 border-soft item-bg box-shadow padding-1">
        <div class="flex flex-row flex-align-c flex-justify-con-sb">
            <div class="flex flex-col">
                <span class="text-primary small bold">Biztonsági intézkedések</span>
                <span class="text-secondary smaller-light">Tegye még biztonságosabbá fiókját.</span>
            </div>
        </div><hr style="border: 1px solid var(--background);" class="w-fa">
        <div class="flex flex-col gap-3 w-100">
            <div class="flex flex-col gap-2">
                <div class="flex flex-col gap-1">
                    <div class="flex flex-row flex-align-c flex-justify-con-sb gap-1">
                        <div class="flex flex-col">
                            <span class="text-primary bold">Két Lépcsős Hitelesítés</span>
                            <span class="text-secondary small-med">Tegye még biztonságosabbá fiókját, egy extra hitelesítési lépéssel.</span>
                        </div>
                        <div class="flex flex-row">
                            <?php 
                                if ($stmt = $con->prepare('SELECT factor, factor__type FROM u__password WHERE uid = ?')) { $stmt->bind_param('i', $uid); $stmt->execute(); $result = $stmt->get_result(); $data = $result->fetch_assoc();
                                    if ($data['factor'] == false) {
                                        echo '
                                        <span class="flex flex-row flex-align-c gap-05 primary-bg primary-bg-hover border-soft padding-05 user-select-none pointer small-med bold">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none"><path opacity="0.3" d="M21 10.7192H3C2.4 10.7192 2 11.1192 2 11.7192C2 12.3192 2.4 12.7192 3 12.7192H6V14.7192C6 18.0192 8.7 20.7192 12 20.7192C15.3 20.7192 18 18.0192 18 14.7192V12.7192H21C21.6 12.7192 22 12.3192 22 11.7192C22 11.1192 21.6 10.7192 21 10.7192Z" fill="currentColor"/><path d="M11.6 21.9192C11.4 21.9192 11.2 21.8192 11 21.7192C10.6 21.4192 10.5 20.7191 10.8 20.3191C11.7 19.1191 12.3 17.8191 12.7 16.3191C12.8 15.8191 13.4 15.4192 13.9 15.6192C14.4 15.7192 14.8 16.3191 14.6 16.8191C14.2 18.5191 13.4 20.1192 12.4 21.5192C12.2 21.7192 11.9 21.9192 11.6 21.9192ZM8.7 19.7192C10.2 18.1192 11 15.9192 11 13.7192V8.71917C11 8.11917 11.4 7.71917 12 7.71917C12.6 7.71917 13 8.11917 13 8.71917V13.0192C13 13.6192 13.4 14.0192 14 14.0192C14.6 14.0192 15 13.6192 15 13.0192V8.71917C15 7.01917 13.7 5.71917 12 5.71917C10.3 5.71917 9 7.01917 9 8.71917V13.7192C9 15.4192 8.4 17.1191 7.2 18.3191C6.8 18.7191 6.9 19.3192 7.3 19.7192C7.5 19.9192 7.7 20.0192 8 20.0192C8.3 20.0192 8.5 19.9192 8.7 19.7192ZM6 16.7192C6.5 16.7192 7 16.2192 7 15.7192V8.71917C7 8.11917 7.1 7.51918 7.3 6.91918C7.5 6.41918 7.2 5.8192 6.7 5.6192C6.2 5.4192 5.59999 5.71917 5.39999 6.21917C5.09999 7.01917 5 7.81917 5 8.71917V15.7192V15.8191C5 16.3191 5.5 16.7192 6 16.7192ZM9 4.71917C9.5 4.31917 10.1 4.11918 10.7 3.91918C11.2 3.81918 11.5 3.21917 11.4 2.71917C11.3 2.21917 10.7 1.91916 10.2 2.01916C9.4 2.21916 8.59999 2.6192 7.89999 3.1192C7.49999 3.4192 7.4 4.11916 7.7 4.51916C7.9 4.81916 8.2 4.91918 8.5 4.91918C8.6 4.91918 8.8 4.81917 9 4.71917ZM18.2 18.9192C18.7 17.2192 19 15.5192 19 13.7192V8.71917C19 5.71917 17.1 3.1192 14.3 2.1192C13.8 1.9192 13.2 2.21917 13 2.71917C12.8 3.21917 13.1 3.81916 13.6 4.01916C15.6 4.71916 17 6.61917 17 8.71917V13.7192C17 15.3192 16.8 16.8191 16.3 18.3191C16.1 18.8191 16.4 19.4192 16.9 19.6192C17 19.6192 17.1 19.6192 17.2 19.6192C17.7 19.6192 18 19.3192 18.2 18.9192Z" fill="currentColor"/></svg>
                                            Bekapcsolás
                                        </span>
                                        ';
                                    } else {
                                        echo '
                                        <span class="flex flex-row flex-align-c gap-05 danger-bg danger-bg-hover border-soft padding-05 user-select-none pointer small-med bold">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none"><path opacity="0.3" d="M21 10.7192H3C2.4 10.7192 2 11.1192 2 11.7192C2 12.3192 2.4 12.7192 3 12.7192H6V14.7192C6 18.0192 8.7 20.7192 12 20.7192C15.3 20.7192 18 18.0192 18 14.7192V12.7192H21C21.6 12.7192 22 12.3192 22 11.7192C22 11.1192 21.6 10.7192 21 10.7192Z" fill="currentColor"/><path d="M11.6 21.9192C11.4 21.9192 11.2 21.8192 11 21.7192C10.6 21.4192 10.5 20.7191 10.8 20.3191C11.7 19.1191 12.3 17.8191 12.7 16.3191C12.8 15.8191 13.4 15.4192 13.9 15.6192C14.4 15.7192 14.8 16.3191 14.6 16.8191C14.2 18.5191 13.4 20.1192 12.4 21.5192C12.2 21.7192 11.9 21.9192 11.6 21.9192ZM8.7 19.7192C10.2 18.1192 11 15.9192 11 13.7192V8.71917C11 8.11917 11.4 7.71917 12 7.71917C12.6 7.71917 13 8.11917 13 8.71917V13.0192C13 13.6192 13.4 14.0192 14 14.0192C14.6 14.0192 15 13.6192 15 13.0192V8.71917C15 7.01917 13.7 5.71917 12 5.71917C10.3 5.71917 9 7.01917 9 8.71917V13.7192C9 15.4192 8.4 17.1191 7.2 18.3191C6.8 18.7191 6.9 19.3192 7.3 19.7192C7.5 19.9192 7.7 20.0192 8 20.0192C8.3 20.0192 8.5 19.9192 8.7 19.7192ZM6 16.7192C6.5 16.7192 7 16.2192 7 15.7192V8.71917C7 8.11917 7.1 7.51918 7.3 6.91918C7.5 6.41918 7.2 5.8192 6.7 5.6192C6.2 5.4192 5.59999 5.71917 5.39999 6.21917C5.09999 7.01917 5 7.81917 5 8.71917V15.7192V15.8191C5 16.3191 5.5 16.7192 6 16.7192ZM9 4.71917C9.5 4.31917 10.1 4.11918 10.7 3.91918C11.2 3.81918 11.5 3.21917 11.4 2.71917C11.3 2.21917 10.7 1.91916 10.2 2.01916C9.4 2.21916 8.59999 2.6192 7.89999 3.1192C7.49999 3.4192 7.4 4.11916 7.7 4.51916C7.9 4.81916 8.2 4.91918 8.5 4.91918C8.6 4.91918 8.8 4.81917 9 4.71917ZM18.2 18.9192C18.7 17.2192 19 15.5192 19 13.7192V8.71917C19 5.71917 17.1 3.1192 14.3 2.1192C13.8 1.9192 13.2 2.21917 13 2.71917C12.8 3.21917 13.1 3.81916 13.6 4.01916C15.6 4.71916 17 6.61917 17 8.71917V13.7192C17 15.3192 16.8 16.8191 16.3 18.3191C16.1 18.8191 16.4 19.4192 16.9 19.6192C17 19.6192 17.1 19.6192 17.2 19.6192C17.7 19.6192 18 19.3192 18.2 18.9192Z" fill="currentColor"/></svg>
                                            Kikapcsolás
                                        </span>
                                        ';
                                    }
                                }
                            ?>
                        </div>
                    </div>
                    <?php
                        if ($data['factor'] == true) {
                            if ($data['factor__type'] == 'sms') {
                                echo '
                                <div class="flex flex-col">
                                    <div class="flex flex-row flex-align-c flex-justify-con-sb padding-1">
                                        <div class="flex flex-col">
                                            <span class="text-primary bold small">SMS</span>
                                            <span class="text-secondary small-med">+36 30/710-6140</span>
                                        </div>
                                        <div class="flex flex-row flex-align-c gap-05">
                                            <div class="flex flex-align-c flex-justify-con-c padding-05 border-soft pr__other hover__svg pointer">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none"><path opacity="0.3" d="M21.4 8.35303L19.241 10.511L13.485 4.755L15.643 2.59595C16.0248 2.21423 16.5426 1.99988 17.0825 1.99988C17.6224 1.99988 18.1402 2.21423 18.522 2.59595L21.4 5.474C21.7817 5.85581 21.9962 6.37355 21.9962 6.91345C21.9962 7.45335 21.7817 7.97122 21.4 8.35303ZM3.68699 21.932L9.88699 19.865L4.13099 14.109L2.06399 20.309C1.98815 20.5354 1.97703 20.7787 2.03189 21.0111C2.08674 21.2436 2.2054 21.4561 2.37449 21.6248C2.54359 21.7934 2.75641 21.9115 2.989 21.9658C3.22158 22.0201 3.4647 22.0084 3.69099 21.932H3.68699Z" class="svg-blank"></path><path d="M5.574 21.3L3.692 21.928C3.46591 22.0032 3.22334 22.0141 2.99144 21.9594C2.75954 21.9046 2.54744 21.7864 2.3789 21.6179C2.21036 21.4495 2.09202 21.2375 2.03711 21.0056C1.9822 20.7737 1.99289 20.5312 2.06799 20.3051L2.696 18.422L5.574 21.3ZM4.13499 14.105L9.891 19.861L19.245 10.507L13.489 4.75098L4.13499 14.105Z" class="svg-blank"></path></svg>
                                            </div>
                                            <div class="flex flex-align-c flex-justify-con-c padding-05 border-soft pr__other hover__svg pointer">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none"><path d="M5 9C5 8.44772 5.44772 8 6 8H18C18.5523 8 19 8.44772 19 9V18C19 19.6569 17.6569 21 16 21H8C6.34315 21 5 19.6569 5 18V9Z" class="svg-blank"></path><path opacity="0.5" d="M5 5C5 4.44772 5.44772 4 6 4H18C18.5523 4 19 4.44772 19 5V5C19 5.55228 18.5523 6 18 6H6C5.44772 6 5 5.55228 5 5V5Z" class="svg-blank"></path><path opacity="0.5" d="M9 4C9 3.44772 9.44772 3 10 3H14C14.5523 3 15 3.44772 15 4V4H9V4Z" class="svg-blank"></path></svg>
                                            </div>
                                        </div>
                                    </div>
                                    <hr style="border: 1px solid var(--background);" class="w-100">
                                    <div class="flex flex-row flex-align-c flex-justify-con-c">
                                        <span class="text-secondary small-med">Ha elveszíti mobileszközét vagy biztonsági kulcsát, <a class="text-primary-light link pointer user-select-none">biztonsági kódot generálhat</a> a fiókjába való bejelentkezéshez.</span>
                                    </div>
                                </div>
                                ';
                            }
                            if ($data['factor__type'] == 'email') {
                                echo '
                                <div class="flex flex-col">
                                    <div class="flex flex-row flex-align-c flex-justify-con-sb padding-1">
                                        <div class="flex flex-col">
                                            <span class="text-primary bold small">E-mail</span>
                                            <span class="text-secondary small-med">martinaszity@icloud.com</span>
                                        </div>
                                        <div class="flex flex-row flex-align-c gap-05">
                                            <div class="flex flex-align-c flex-justify-con-c padding-05 border-soft pr__other hover__svg pointer">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none"><path opacity="0.3" d="M21.4 8.35303L19.241 10.511L13.485 4.755L15.643 2.59595C16.0248 2.21423 16.5426 1.99988 17.0825 1.99988C17.6224 1.99988 18.1402 2.21423 18.522 2.59595L21.4 5.474C21.7817 5.85581 21.9962 6.37355 21.9962 6.91345C21.9962 7.45335 21.7817 7.97122 21.4 8.35303ZM3.68699 21.932L9.88699 19.865L4.13099 14.109L2.06399 20.309C1.98815 20.5354 1.97703 20.7787 2.03189 21.0111C2.08674 21.2436 2.2054 21.4561 2.37449 21.6248C2.54359 21.7934 2.75641 21.9115 2.989 21.9658C3.22158 22.0201 3.4647 22.0084 3.69099 21.932H3.68699Z" class="svg-blank"></path><path d="M5.574 21.3L3.692 21.928C3.46591 22.0032 3.22334 22.0141 2.99144 21.9594C2.75954 21.9046 2.54744 21.7864 2.3789 21.6179C2.21036 21.4495 2.09202 21.2375 2.03711 21.0056C1.9822 20.7737 1.99289 20.5312 2.06799 20.3051L2.696 18.422L5.574 21.3ZM4.13499 14.105L9.891 19.861L19.245 10.507L13.489 4.75098L4.13499 14.105Z" class="svg-blank"></path></svg>
                                            </div>
                                            <div class="flex flex-align-c flex-justify-con-c padding-05 border-soft pr__other hover__svg pointer">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none"><path d="M5 9C5 8.44772 5.44772 8 6 8H18C18.5523 8 19 8.44772 19 9V18C19 19.6569 17.6569 21 16 21H8C6.34315 21 5 19.6569 5 18V9Z" class="svg-blank"></path><path opacity="0.5" d="M5 5C5 4.44772 5.44772 4 6 4H18C18.5523 4 19 4.44772 19 5V5C19 5.55228 18.5523 6 18 6H6C5.44772 6 5 5.55228 5 5V5Z" class="svg-blank"></path><path opacity="0.5" d="M9 4C9 3.44772 9.44772 3 10 3H14C14.5523 3 15 3.44772 15 4V4H9V4Z" class="svg-blank"></path></svg>
                                            </div>
                                        </div>
                                    </div>
                                    <hr style="border: 1px solid var(--background);" class="w-100">
                                    <div class="flex flex-row flex-align-c flex-justify-con-c">
                                        <span class="text-secondary small-med">Ha nem fér hozzá email fiókjához, <a class="text-primary-light link pointer user-select-none">biztonsági kódot generálhat</a> a fiókjába való bejelentkezéshez.</span>
                                    </div>
                                </div>
                                ';
                            }
                        }
                    ?>
                </div>
                <div class="flex flex-col gap-1">
                    <div class="flex flex-row flex-align-c flex-justify-con-sb gap-1">
                        <div class="flex flex-col">
                            <span class="text-primary bold">Bejelentkezési előzmények</span>
                        </div>
                    </div>
                    <div class="flex flex-col gap-2">
                        <table class="sess__history w-100">
                            <tr class="sessh__header">
                                <th>Terület</th>
                                <th>Státusz</th>
                                <th>Készülék</th>
                                <th>IP Cím</th>
                                <th>Idő</th>
                            </tr>
                            <?php
                            if ($sec__stmt = $con->prepare('SELECT * FROM login__attempts WHERE uid = ? ORDER BY date DESC LIMIT 15')) {
                                $sec__stmt->bind_param('i', $uid); $sec__stmt->execute(); $sec__result = $sec__stmt->get_result();
                                while ($log = $sec__result->fetch_assoc()) {
                                    echo '
                                    <tr class="sessh__body">
                                        <td>'.$log['location'].'</td>
                                        <td>';
                                        if ($log['status'] == 1) { echo '<span class="label label-success border-soft-light padding-05 bold">OK</span>'; }
                                        else { echo '<span class="label label-danger border-soft-light padding-05 bold">ERR</span>'; }
                                        echo '
                                        </td>
                                        <td>'.$log['browser'].' - '.$log['sys'].'</td>
                                        <td>'.$log['ip'].'</td>
                                        <td>'; echo get_time_ago(strtotime($log['date'])); echo '</td>
                                    </tr>
                                    ';
                                }
                            }
                            ?>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>