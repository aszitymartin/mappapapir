var urli = window.location.href;
var uri = urli.split('/');
if (uri[uri.length-1] == 'basket') { $('#ch-con').load('/includes/webshop/checkout/basket.php'); }
else if (typeof(uri[uri.length-1]) == 'number' || isFinite(uri[uri.length-1])) { $('#ch-con').load('/includes/webshop/checkout/single.php?id='+uri[uri.length-1]); }
else { window.location.href = '/404'; }