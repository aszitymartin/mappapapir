var product_bookmark = document.getElementsByClassName('product_bookmark'); var svg_size; var form_data = new FormData();
for (let i = 0; i < product_bookmark.length; i++) {
    product_bookmark[i].addEventListener('click', function (e) {
        svg_size = product_bookmark[i].getElementsByTagName('svg')[0].getAttribute('width');
        form_data.append("id", product_bookmark[i].getAttribute('keyid')); form_data.append("code", product_bookmark[i].getAttribute('code')); form_data.append("action", product_bookmark[i].getAttribute('action'));
        $.ajax({
            enctype: "multipart/form-data", type: "POST", url: "/includes/webshop/bookmark.php", data: form_data, dataType: 'json', contentType: false, processData: false,
            success: function(data) {
                var respCode = String(data).slice(0, 3); var respId = String(data).slice(3, 5); // A responsebol kapott erteket szet daraboljuk, hogy a kapott ertekeket valtozokba mentsuk a tovabbi hasznalathoz
                if (Number(respCode) === 410) {  // A statusz kod 410 (Sikeres torles)
                    for (let j = 0; j < $("[keyid="+respId+"]").length; j++) {
                        $("[keyid="+respId+"]")[j].setAttribute('action', '0');
                        $("[keyid="+respId+"]")[j].innerHTML = `<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="`+svg_size+`" height="`+svg_size+`" viewBox="0 0 24 24" version="1.1"><g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"><rect x="0" y="0" width="24" height="24"></rect><path d="M8,4 L16,4 C17.1045695,4 18,4.8954305 18,6 L18,17.726765 C18,18.2790497 17.5522847,18.726765 17,18.726765 C16.7498083,18.726765 16.5087052,18.6329798 16.3242754,18.4639191 L12.6757246,15.1194142 C12.2934034,14.7689531 11.7065966,14.7689531 11.3242754,15.1194142 L7.67572463,18.4639191 C7.26860564,18.8371115 6.63603827,18.8096086 6.26284586,18.4024896 C6.09378519,18.2180598 6,17.9769566 6,17.726765 L6,6 C6,4.8954305 6.8954305,4 8,4 Z" class="svg-stroke"></path></g></svg>`;
                    }
                } if (Number(respCode) === 200) {
                    for (let j = 0; j < $("[keyid="+respId+"]").length; j++) {
                        $("[keyid="+respId+"]")[j].setAttribute('action', '1');
                        $("[keyid="+respId+"]")[j].innerHTML = `<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="`+svg_size+`" height="`+svg_size+`" viewBox="0 0 24 24" version="1.1"><g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"><rect x="0" y="0" width="24" height="24"></rect><path d="M8,4 L16,4 C17.1045695,4 18,4.8954305 18,6 L18,17.726765 C18,18.2790497 17.5522847,18.726765 17,18.726765 C16.7498083,18.726765 16.5087052,18.6329798 16.3242754,18.4639191 L12.6757246,15.1194142 C12.2934034,14.7689531 11.7065966,14.7689531 11.3242754,15.1194142 L7.67572463,18.4639191 C7.26860564,18.8371115 6.63603827,18.8096086 6.26284586,18.4024896 C6.09378519,18.2180598 6,17.9769566 6,17.726765 L6,6 C6,4.8954305 6.8954305,4 8,4 Z" class="svg"></path></g></svg>`;
                    }
                }
            }, error: function (data) {notificationSystem(0, 1, 0, "Hiba", "Sikertelen művelet!");}
        });
    });
}
var product_card = document.getElementsByClassName('product-link');
for (let i = 0; i < product_card.length; i++) {
    product_card[i].addEventListener("click", function () {
        window.location.href = "/webshop/?id=" + product_card[i].getAttribute('auid')+"&method=50"; // A termek a trending szekciobol lett megnyitva
    });
}