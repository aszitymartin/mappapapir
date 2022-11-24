var token = false; var response; var tokenGenerated = false; var authToken;
function shareProduct (via, id, code) { var check_data = new FormData(); check_data.append('id', id); check_data.append('code', code);
    $.ajax({
        enctype: "multipart/form-data", type: "POST", url: "/assets/products/check.php", data: check_data, dataType: 'json', contentType: false, processData: false,
        success: function(data) { response = data;
            if (Number(data) === 1) { generateToken(via, id, code); shareInit(via, id); }
            if (Number(data) === 0) { notificationSystem(0, 1, 0, "Hiba", "Nem létező termék!"); token = false; }
        }, error: function (data) { notificationSystem(0, 1, 0, "Hiba", "Sikertelen művelet!"); }
    });
}

function generateToken (via, id, code) {
    if (arguments[0] != 'undefined' && Number(arguments[1]) > 0 && arguments[2] != 'undefined') {
        const date = new Date(); var timestamp = date.getFullYear() + '' + Number(date.getUTCMonth()+1) + '' + date.getDate() + '' + date.getHours() + '' + date.getMinutes() + '' + date.getSeconds();
        token = via +'-'+ code +'-'+ id +'-'+ timestamp; tokenGenerated = true; 
        console.log('token generated.'); authToken = token; validateToken();
        return token;
    } else { return false; }
}

// Validaljuk a token ervenyesseget
function validateToken () {
    if (tokenGenerated) { // Megnezzuk, hogy a token letre lett-e hozva
        if (authToken === token) { return true; }
        else { return false; }
    } else { return false; } // Nem tortent meg a token generalasa.
}

function shareInit (via, id) {
    if (validateToken()) {
        console.log('share init true');
        switch (via) {
            case 'email': sendMail(id); break;


            case 'copy': copyItem(id); break;
            default: notificationSystem(0, 1, 0, "Hiba", "Ismeretlen művelet!");
        }
    } else {
        console.log('share init false');
        // notificationSystem(0, 1, 0, "Hiba", "Sikertelen művelet!");
    }
}

function sendMail (id) {
    if (!validateToken()) { notificationSystem(0, 1, 0, "Hiba", "Sikertelen művelet!"); }
    else { var product_data = new FormData(); product_data.append('pid', id);
        $.ajax({ enctype: "multipart/form-data", type: "POST", url: "/assets/products/info.php", data: product_data, dataType: 'json', contentType: false, processData: false,
            success: function(data) {
                document.location.href = `mailto:?subject=`+encodeURIComponent('Tekintse meg ezt a terméket')
                +`&body=`+ encodeURIComponent('Szeretném ajánlani ezt a terméket, amit a Mappa Papir webshopjában találtam.')
                +``+encodeURIComponent('\n\n'+data.brand+' — ' + data.name + ' ' + data.color.toUpperCase() + ' — ' + data.price + data.unit.toUpperCase())
                +``+encodeURIComponent('\nTermék megtekintése: http://localhost/webshop/index.php?id='+data.id+'&method=54');
            }, error: function (data) { notificationSystem(0, 1, 0, "Hiba", "Sikertelen művelet!"); }
        }); token = false;tokenGenerated = false;authToken = false;
    }
}

function copyItem (id) {
    if (!validateToken()) { notificationSystem(0, 1, 0, "Hiba", "Sikertelen művelet!"); }
    else { navigator.clipboard.writeText('http://localhost/webshop/index.php?id='+id+'&method=55'); notificationSystem(0, 0, 0, "Siker", "Mentve a vágólapra!"); }
}