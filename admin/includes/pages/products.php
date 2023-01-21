<?php require_once($_SERVER['DOCUMENT_ROOT'].'/includes/inc.php'); require_once($_SERVER['DOCUMENT_ROOT'].'/assets/alph.php'); require_once($_SERVER['DOCUMENT_ROOT'].'/router/router.php'); $uid = $_SESSION['id'];
$stmt = $con->prepare('SELECT privilege FROM customers__priv  WHERE uid = ?'); if (isset($_SESSION['loggedin'])) {$id = $_SESSION['id'];} $stmt->bind_param('i', $id);$stmt->execute(); $stmt->bind_result($privilege); $stmt->fetch();$stmt->close();
function get_time_ago( $time ) {
    $time_difference = time() - $time;
    if( $time_difference < 1 ) { return '< 1mp'; }
    $condition = array( 12 * 30 * 24 * 60 * 60 =>  'éve',30 * 24 * 60 * 60 => 'hónapja',24 * 60 * 60 => 'napja',60 * 60 =>  'órája',60 =>  'perce',1 =>  'másodperce');
    foreach( $condition as $secs => $str ) {$d = $time_difference / $secs;if( $d >= 1 ) {$t = round( $d );return $t . ' ' . $str . ( $t > 1 ? '' : '' ) . '';}}
}
?>
<script src="/assets/script/chart/dist/chart.js"></script>
<script>var formatter = new Intl.NumberFormat('hu-HU', {style: 'currency',currency: 'HUF',maximumFractionDigits: 0,minimumFractionDigits: 0});</script>
<div class="flex flex-row-d-col-m gap-1">
    <div class="flex flex-col w-fa gap-1 border-soft item-bg box-shadow padding-1">
        <div class="flex flex-row flex-align-c flex-justify-con-sb">
            <span class="text-primary small bold">Termékeink</span>
            <div class="flex flex-row flex-align-c flex-justify-con-fe gap-1">
                <div class="flex flex-row flex-align-c gap-1 primary-bg primary-bg-hover border-soft-light padding-05 smaller-light pointer" onclick="__crtproduct()">Termék hozzáadása<svg width="14" height="14" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path opacity="0.3" d="M21 13H3C2.4 13 2 12.6 2 12C2 11.4 2.4 11 3 11H21C21.6 11 22 11.4 22 12C22 12.6 21.6 13 21 13Z" fill="currentColor"/><path d="M12 22C11.4 22 11 21.6 11 21V3C11 2.4 11.4 2 12 2C12.6 2 13 2.4 13 3V21C13 21.6 12.6 22 12 22Z" fill="currentColor"/></svg></div>
            </div>
        </div>
        <div class="flex flex-col gap-2 prio__con">
            <input type='hidden' id='current_page' /><input type='hidden' id='show_per_page' />
            <ul class="text-muted small-med text-align-l w-fa padding-0 margin-none" id="pagingBox">
                <?php $prod__sql = "SELECT products.id, products.name, products.thumbnail, products.added, products__variations.color, products__variations.brand, products__variations.model, products__pricing.base, products__inventory.quantity, products__inventory.unit FROM `products` INNER JOIN products__variations ON products__variations.pid = products.id INNER JOIN products__pricing ON products__pricing.pid = products.id INNER JOIN products__inventory ON products__inventory.pid = products.id WHERE 1 ORDER BY added DESC"; $prod__res = $con-> query($prod__sql); while($data = $prod__res-> fetch_assoc()) { $thmb = "'/assets/images/uploads/".$data['thumbnail']."'"; 
                    echo '
                    <li class="flex flex-row flex-align-c w-fa">
                        <div class="padding-05 w-60">
                            <div class="flex flex-row flex-align-c gap-05">
                                <div class="product-miniature border-primary pointer" style="background-image: url('.$thmb.');"></div>
                                <div class="flex flex-col gap-025">
                                    <span>'.$data['name'].'</span>
                                    <div class="flex flex-row small-med">'.$data['color'].'</div>
                                </div>
                            </div>
                        </div>
                        <div class="flex flex-row w-40">
                            <div class="flex flex-row flex-align-c w-fa padding-05">#'.$data['id'].'</div>
                            <div class="flex flex-row flex-align-c w-fa padding-05">'.$data['quantity'].' '.$data['unit'].'</div>
                            <div class="flex flex-row flex-align-c w-fa padding-05"><span class="flex flex-row flex-wrap-no">'.$data['base'].' Ft</span></div>
                            <div class="flex flex-row flex-align-c w-fa padding-05 relative">
                                <a href="/admin/products/edit/'.$data['id'].'/'; echo str_replace(',', '', str_replace(' ', '-',strtolower(strtr($data['brand'], $unwanted_array)))).'-'.str_replace(',', '', str_replace(' ', '-',strtolower(strtr($data['name'], $unwanted_array)))).'-'.str_replace(',', '', str_replace(' ', '-', strtolower(strtr($data['color'], $unwanted_array)))); echo '"  class="flex flex-row flex-align-c w-fc stockd__trigger pointer user-select-none smaller background-bg text-secondary border-soft padding-05">
                                    <span">Szerkesztés</span>
                                </a>
                            </div>
                        </div>
                    </li>
                    ';
                }
                ?>
            </ul>
            <script>
                jQuery(document).ready(function () {
                    var show_per_page = 8; 
                    var number_of_items = $('#pagingBox').children().length;
                    var number_of_pages = Math.ceil(number_of_items/show_per_page);
                    $('#current_page').val(0); $('#show_per_page').val(show_per_page);
                    var navigation_html = `<a href="javascript:previous();" class="previous_link flex flex-col flex-align-c flex-justify-con-c padding-05 border-soft-light text-primary background-bg background-bg-hover pointer user-select-none" id="prev_link"><svg width="18" height="18" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M11.2657 11.4343L15.45 7.25C15.8642 6.83579 15.8642 6.16421 15.45 5.75C15.0358 5.33579 14.3642 5.33579 13.95 5.75L8.40712 11.2929C8.01659 11.6834 8.01659 12.3166 8.40712 12.7071L13.95 18.25C14.3642 18.6642 15.0358 18.6642 15.45 18.25C15.8642 17.8358 15.8642 17.1642 15.45 16.75L11.2657 12.5657C10.9533 12.2533 10.9533 11.7467 11.2657 11.4343Z" fill="currentColor"/></svg></a>`;
                    var current_link = 0;
                    while(number_of_pages > current_link) {navigation_html += '<a class="page_link flex flex-col flex-align-c flex-justify-con-c padding-05 border-soft-light text-primary background-bg background-bg-hover pointer user-select-none" href="javascript:go_to_page(' + current_link +')" longdesc="' + current_link +'">'+ (current_link + 1) +'</a>'; current_link++; }
                    navigation_html += `<a href="javascript:next();" class="next_link flex flex-col flex-align-c flex-justify-con-c padding-05 border-soft-light text-primary background-bg background-bg-hover pointer user-select-none" id="next_link"><svg width="18" height="18" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M12.6343 12.5657L8.45001 16.75C8.0358 17.1642 8.0358 17.8358 8.45001 18.25C8.86423 18.6642 9.5358 18.6642 9.95001 18.25L15.4929 12.7071C15.8834 12.3166 15.8834 11.6834 15.4929 11.2929L9.95001 5.75C9.5358 5.33579 8.86423 5.33579 8.45001 5.75C8.0358 6.16421 8.0358 6.83579 8.45001 7.25L12.6343 11.4343C12.9467 11.7467 12.9467 12.2533 12.6343 12.5657Z" fill="currentColor"/></svg></a>`;
                    $('#page_navigation').html(navigation_html); $('#page_navigation .page_link:first').addClass('pagination-active');
                    $('#pagingBox').children().css('display', 'none'); $('#pagingBox').children().slice(0, show_per_page).css('display', 'flex');
                });
                function previous(){ new_page = parseInt($('#current_page').val()) - 1; if($('.pagination-active').prev('.page_link').length==true){ go_to_page(new_page); } }
                function next(){ new_page = parseInt($('#current_page').val()) + 1; if($('.pagination-active').next('.page_link').length==true ){ go_to_page(new_page); } }
                function go_to_page(page_num) { var show_per_page = parseInt($('#show_per_page').val()); start_from = page_num * show_per_page; end_on = start_from + show_per_page;
                    $('#pagingBox').children().css('display', 'none').slice(start_from, end_on).css('display', 'flex');
                    $('.page_link[longdesc=' + page_num +']').addClass('pagination-active').siblings('.pagination-active').removeClass('pagination-active');
                    $('#current_page').val(page_num);
                }               
                
                function __shwaction (item) { var itid = item.split("_")[1];
                    if (item.split("_")[0] == 'edt') {
                        if (__isnum(__isnum(itid)[1])) {
                            window.location.href = '/admin/products/edit/?id='+itid;
                        } else { console.log('Érvénytelen azonosítót használt.'); }
                    }
                } function __crtproduct () { window.location.href = "/admin/products/create/"; }
                function __isnum (val) { return [typeof val === 'number', val]; }
            </script>
        </div>
        <!-- <div class="flex flex-row flex-align-c flex-justify-con-fe gap-1 w-fa">
            <div id='page_navigation' class="flex flex-row flex-align-c gap-05"></div>
        </div> -->
    </div>
</div>
<script>var bal__to__form = document.getElementsByClassName('money__form'); for (let i = 0; i < bal__to__form.length; i++) { bal__to__form[i].textContent = formatter.format(bal__to__form[i].getAttribute('default-data')); }</script>