// Bevasarlokosar osszes elemenek kijelolese

var sltd = []; var delbtn = document.getElementById('dlt-bi-slt');
function __selectcitem (pid) {
    if (document.getElementById('sel-pd-'+pid).checked) {
        sltd.indexOf(pid) === -1 ? sltd.push(pid) : console.log();
        delbtn.classList = 'text-danger user-select-none small pointer link'; delbtn.setAttribute('onclick', 'rtuc(['+sltd+'])');
    } else {
        if (sltd.indexOf(pid) > -1) { sltd.splice(sltd.indexOf(pid), 1); delbtn.setAttribute('onclick', 'rtuc(['+sltd+'])'); }
        if (sltd.length < 1) { delbtn.classList = 'text-secondary user-select-none small'; delbtn.removeAttribute('onclick'); }
    }
}
$('#check_all_item').click(() => { sltd = []; var items = document.getElementsByClassName('chifb');
    if (document.getElementById('check_all_item').checked) {
        for (let i = 0; i < items.length; i++) {
            sltd.push(Number(items[i].id.split('-')[2]));
            document.getElementById(items[i].id).checked = true;
        }
        delbtn.classList = 'text-danger user-select-none small pointer link'; delbtn.setAttribute('onclick', 'rtuc(['+sltd+'])');
    } else { 
        for (let i = 0; i < items.length; i++) { document.getElementById(items[i].id).checked = false; sltd = []; }
        if (sltd.length < 1) { delbtn.classList = 'text-secondary user-select-none small'; delbtn.removeAttribute('onclick'); }
    }
});
