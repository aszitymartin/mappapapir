// a__action: 1 -> hasznos hozzaadas | 0 -> nemhasznos hozzaadas
// r__action: 1 -> hasznos torles    | 0 -> nemhasznos torles

var up__data = new FormData(); var down__data = new FormData();
function u__up (rid) { up__data.append('rid', rid);
    var add__data = new FormData(); add__data.append("rid", rid); add__data.append("a__action", "1");
    $.ajax({
        enctype: "multipart/form-data", type: "POST", url: "/assets/php/reviews/a__vote.php", data: add__data, dataType: 'json', contentType: false, processData: false,
        success: function(data) { document.getElementById('u__count'+rid).textContent = Number(data.up) - Number(data.down);
            document.getElementById('req__up'+rid).classList.replace('svg-hover', 'svg-active'); document.getElementById('req__up'+rid).parentElement.setAttribute('onclick', 'r__up('+rid+')');
            document.getElementById('req__down'+rid).classList.replace('svg-active', 'svg-hover'); document.getElementById('req__down'+rid).parentElement.setAttribute('onclick', 'u__down('+rid+')');
        }, error: function (data) { notificationSystem(0, 1, 0, 'Hiba!', 'Sikertelen művelet.'); }
    });
}
function u__down (rid) { down__data.append('rid', rid);
    var remove__data = new FormData(); remove__data.append("rid", rid); remove__data.append("a__action", "0");
    $.ajax({
        enctype: "multipart/form-data", type: "POST", url: "/assets/php/reviews/a__vote.php", data: remove__data, dataType: 'json', contentType: false, processData: false,
        success: function(data) { document.getElementById('u__count'+rid).textContent = Number(data.up) - Number(data.down);
            document.getElementById('req__down'+rid).classList.replace('svg-hover', 'svg-active'); document.getElementById('req__down'+rid).parentElement.setAttribute('onclick', 'r__down('+rid+')');
            document.getElementById('req__up'+rid).classList.replace('svg-active', 'svg-hover'); document.getElementById('req__up'+rid).parentElement.setAttribute('onclick', 'u__up('+rid+')');
        }, error: function (data) { notificationSystem(0, 1, 0, 'Hiba!', 'Sikertelen művelet.'); }
    });
}

function r__up (rid) { up__data.append('rid', rid);
    $.ajax({
        enctype: "multipart/form-data", type: "POST", url: "/assets/php/reviews/c__vote.php", data: up__data, dataType: 'json', contentType: false, processData: false,
        success: function(data) { var resu__data = new FormData(); resu__data.append("rid", rid); resu__data.append("r__action", "1");
            $.ajax({
                enctype: "multipart/form-data", type: "POST", url: "/assets/php/reviews/r__vote.php", data: resu__data, dataType: 'json', contentType: false, processData: false,
                success: function(data) { document.getElementById('u__count'+rid).textContent = Number(document.getElementById('u__count'+rid).textContent)-1;
                    document.getElementById('req__down'+rid).classList.replace('svg-active', 'svg-hover'); document.getElementById('req__down'+rid).parentElement.setAttribute('onclick', 'u__down('+rid+')');
                    document.getElementById('req__up'+rid).classList.replace('svg-active', 'svg-hover'); document.getElementById('req__up'+rid).parentElement.setAttribute('onclick', 'u__up('+rid+')');
                }, error: function (data) { notificationSystem(0, 1, 0, 'Hiba!', 'Sikertelen művelet.'); }
            });
        }, error: function (data) { notificationSystem(0, 1, 0, 'Hiba!', 'Ismeretlen értékelés.'); }
    });
}

function r__down (rid) { up__data.append('rid', rid);
    $.ajax({
        enctype: "multipart/form-data", type: "POST", url: "/assets/php/reviews/c__vote.php", data: up__data, dataType: 'json', contentType: false, processData: false,
        success: function(data) { var resu__data = new FormData(); resu__data.append("rid", rid); resu__data.append("r__action", "0");
            $.ajax({
                enctype: "multipart/form-data", type: "POST", url: "/assets/php/reviews/r__vote.php", data: resu__data, dataType: 'json', contentType: false, processData: false,
                success: function(data) { document.getElementById('u__count'+rid).textContent = Number(document.getElementById('u__count'+rid).textContent)+1;
                    document.getElementById('req__down'+rid).classList.replace('svg-active', 'svg-hover'); document.getElementById('req__down'+rid).parentElement.setAttribute('onclick', 'u__down('+rid+')');
                    document.getElementById('req__up'+rid).classList.replace('svg-active', 'svg-hover'); document.getElementById('req__up'+rid).parentElement.setAttribute('onclick', 'u__up('+rid+')');
                }, error: function (data) { notificationSystem(0, 1, 0, 'Hiba!', 'Sikertelen művelet.'); }
            });
        }, error: function (data) { notificationSystem(0, 1, 0, 'Hiba!', 'Ismeretlen értékelés.'); }
    });
}