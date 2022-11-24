var c__wrapper = document.createElement('div'); c__wrapper.classList = "wrapper_dark";
var c__box = document.createElement('div'); c__box.classList = "d__confirm fixed flex flex-col border-soft item-bg box-shadow padding-1";
$('#pr__pan').click(function () { document.body.append(c__wrapper); c__wrapper.append(c__box); disableScroll();
    
    $('#cl__box').click(function () { c__wrapper.remove(); enableScroll(); });
    $('#co__box').click(function () { var dr__data = new FormData(); dr__data.append("pid", $('#d__review').attr("pid")); dr__data.append("rid", $('#d__review').attr("rid"));
        $.ajax({
            enctype: "multipart/form-data", type: "POST", url: "/assets/php/reviews/delete.php", data: dr__data, dataType: 'json', contentType: false, processData: false,
            success: function(data) { c__wrapper.remove(); document.getElementById('rev'+$('#d__review').attr("rid")).remove(); enableScroll(); window.location.reload(true); },
            error: function (data) { notificationSystem(0, 1, 0, 'Hiba!', 'Az értékelés törlése sikertelen volt.'); }
        });
    });
});