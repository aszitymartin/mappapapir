const staff_auth_con = document.createElement('div');staff_auth_con.classList = 'staff_auth_con';staff_auth_con.id = "staff_auth_con";document.body.prepend(staff_auth_con); const staff_addon = document.getElementById('staffActionAddon');
function blur () {
    document.body.classList.add('stop-scroll');document.getElementsByTagName('main')[0].classList.add('blured');
    document.getElementsByTagName('main')[0].classList.add('pointer-event-none');document.getElementsByTagName('main')[0].classList.add('user-select-none');
    document.getElementsByTagName('footer')[0].classList.add('blured');document.getElementsByTagName('footer')[0].classList.add('pointer-event-none');document.getElementsByTagName('footer')[0].classList.add('user-select-none');
} function noblur () {
    document.body.classList.remove('stop-scroll');document.getElementsByTagName('main')[0].classList.remove('blured');
    document.getElementsByTagName('main')[0].classList.remove('pointer-event-none');document.getElementsByTagName('main')[0].classList.remove('user-select-none');
    document.getElementsByTagName('footer')[0].classList.remove('blured');document.getElementsByTagName('footer')[0].classList.remove('pointer-event-none');document.getElementsByTagName('footer')[0].classList.remove('user-select-none');
}
$('#products').click((e) => {blur();$('#staff_auth_con').css('height', '60vh');$('#staff_auth_con').load('/includes/staff/choose-prod.php');});
$('#orders').click((e) => {blur();$('#staff_auth_con').css('height', '60vh');$('#staff_auth_con').load('/includes/staff/choose-orders.php');}); 
$('#feedbacks').click((e) => {blur();$('#staff_auth_con').css('height', '60vh');$('#staff_auth_con').load('/includes/staff/feedback.php');})
function staffAuth () {blur();$('#staff_auth_con').load('/includes/staff/staffauth.php');$('#staff_auth_con').css('height', '60vh');}
function closeAuth() {noblur();staff_auth_con.innerHTML = '';$('#staff_auth_con').css('height', '0');if (document.body.contains(document.getElementById('formJS'))) {document.getElementById('formJS').remove();}}