// Osszes mentett termekek kijelolese

var sltdbm = []; var delbtn = document.getElementById('dlt-bmi-slt');
function __selectbmitem (pid) {
    if (document.getElementById('sel-bm-'+pid).checked) {
        sltdbm.indexOf(pid) === -1 ? sltdbm.push(pid) : console.log();
        delbtn.classList = 'text-danger user-select-none small pointer link'; delbtn.setAttribute('onclick', 'rtubm(['+sltdbm+'])');
    } else {
        if (sltdbm.indexOf(pid) > -1) { sltdbm.splice(sltdbm.indexOf(pid), 1); delbtn.setAttribute('onclick', 'rtubm(['+sltdbm+'])'); }
        if (sltdbm.length < 1) { delbtn.classList = 'text-secondary user-select-none small'; delbtn.removeAttribute('onclick'); }
    }
}
$('#check_all_bmarked').click(() => { sltdbm = []; var items = document.getElementsByClassName('chifb');
    if (document.getElementById('check_all_bmarked').checked) {
        for (let i = 0; i < items.length; i++) {
            sltdbm.push(Number(items[i].id.split('-')[2]));
            document.getElementById(items[i].id).checked = true;
        }
        delbtn.classList = 'text-danger user-select-none small pointer link'; delbtn.setAttribute('onclick', 'rtubm(['+sltdbm+'])');
    } else { 
        for (let i = 0; i < items.length; i++) { document.getElementById(items[i].id).checked = false; sltdbm = []; }
        if (sltdbm.length < 1) { delbtn.classList = 'text-secondary user-select-none small'; delbtn.removeAttribute('onclick'); }
    }
});
