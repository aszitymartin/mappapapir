var createNotification = document.createElement('div'); createNotification.classList = 'notification notificationIn flex flex-col flex-align-c fixed';
createNotification.innerHTML = `<div class='flex flex-row notificationPadding w-100'><div class='flex'><div class='notificationIcon'><span class='skeletonSvg'></span></div><div class='flex flex-col'><div class='flex notificationTitle'><span class='skeletonTitle'></span></div><div class='flex notificationText'><span class='skeletonDesc'></span></div></div></div></div><div class='flex notificationIntervalIndicator'></div>`;
var notification = document.getElementsByClassName('notification');var notificationTitle = document.getElementsByClassName('notificationTitle');
var notificationIcon = document.getElementsByClassName('notificationIcon');var notificationText = document.getElementsByClassName('notificationText');
var notificationIndicator = document.getElementsByClassName('notificationIntervalIndicator');var notificationTexts = [];
function notificationSystem(type, icon, theme, title, desc) {
    document.body.prepend(createNotification);var notificationTypes = ["success", "error", "unknown"];
    var notificationThemes = ["var(--section-title)"];
    var notificationIcons = [
        `<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="32px" height="32px" viewBox="0 0 24 24" version="1.1"><g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"><rect x="0" y="0" width="24" height="24"/><circle fill="`+ notificationThemes[theme] +`" opacity="0.3" cx="12" cy="12" r="10"/><rect fill="`+ notificationThemes[theme] +`" x="11" y="10" width="2" height="7" rx="1"/><rect fill="`+ notificationThemes[theme] +`" x="11" y="7" width="2" height="2" rx="1"/></g></svg>`,
        `<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="32px" height="32px" viewBox="0 0 24 24" version="1.1"><g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"><rect x="0" y="0" width="24" height="24"/><path d="M11.1669899,4.49941818 L2.82535718,19.5143571 C2.557144,19.9971408 2.7310878,20.6059441 3.21387153,20.8741573 C3.36242953,20.9566895 3.52957021,21 3.69951446,21 L21.2169432,21 C21.7692279,21 22.2169432,20.5522847 22.2169432,20 C22.2169432,19.8159952 22.1661743,19.6355579 22.070225,19.47855 L12.894429,4.4636111 C12.6064401,3.99235656 11.9909517,3.84379039 11.5196972,4.13177928 C11.3723594,4.22181902 11.2508468,4.34847583 11.1669899,4.49941818 Z" fill="`+ notificationThemes[theme] +`" opacity="0.3"/><rect fill="`+ notificationThemes[theme] +`" x="11" y="9" width="2" height="7" rx="1"/><rect fill="`+ notificationThemes[theme] +`" x="11" y="17" width="2" height="2" rx="1"/></g></svg>`,
        `<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="32px" height="32px" viewBox="0 0 24 24" version="1.1"><g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"><rect x="0" y="0" width="24" height="24"/><circle fill="`+ notificationThemes[theme] +`" opacity="0.3" cx="12" cy="12" r="10"/><rect fill="`+ notificationThemes[theme] +`" x="11" y="7" width="2" height="8" rx="1"/><rect fill="`+ notificationThemes[theme] +`" x="11" y="16" width="2" height="2" rx="1"/></g></svg>`
    ];
    $(document).ready(function () {
        for (let i = 0; i < notification.length; i++) {
            notificationIndicator[i].style.backgroundColor = notificationThemes[theme];
            notification[i].style.color = notificationThemes[theme];notificationIcon[i].innerHTML = notificationIcons[icon];
            notificationTitle[i].innerHTML = title;notificationText[i].innerHTML = desc;
        }
    });
    setTimeout(function () {
        for (let i = 0; i < notification.length; i++) {
            document.getElementsByClassName('notificationIntervalIndicator')[i].style.backgroundColor = 'transparent';
            notification[i].classList.replace("notificationIn", "notificationOut");setTimeout(function () {notification[i].remove();},400);
        }
    }, 3200);
    return notificationTypes[type] + " " + notificationIcons[icon] + " " + notificationThemes[theme] + " " + title + " " + desc;
}