var urli = window.location.href;
var uri = urli.split('/'); var urif = uri.filter(n => n);
if (urif[urif.length-1] == 'basket') {
    document.getElementById('ch-load').remove();
    $('#ch-it-con').load('/includes/webshop/checkout/basket.php');
}
else if (typeof(urif[urif.length-1]) == 'number' || isFinite(urif[urif.length-1])) {
    document.getElementById('ch-load').remove();
    $('#ch-it-con').load('/includes/webshop/checkout/single.php?id='+urif[urif.length-1]);
}
else { window.location.href = '/404'; }