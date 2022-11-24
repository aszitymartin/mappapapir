var MONTH_NAMES = ['Január', 'Február', 'Március', 'Április', 'Május', 'Június','Július', 'Augusztus', 'Szeptember', 'Október', 'November', 'December'];
function getFormattedDate(date, prefomattedDate = false, hideYear = false) {
  var day = date.getDate(); var month = MONTH_NAMES[date.getMonth()]; var year = date.getFullYear(); var hours = date.getHours();let minutes = date.getMinutes();
  if (minutes < 10) { minutes = `0${ minutes }`; }
  if (prefomattedDate) { return `${ prefomattedDate },  ${ hours }:${ minutes }`; }
  if (hideYear) { return `${ month } ${ day }. ${ hours }:${ minutes }`; }
  return `${ year }. ${ month } ${ day }. ${ hours }:${ minutes }`;
}
function timeAgo(dateParam) { if (!dateParam) { return null; }
  var date = typeof dateParam === 'object' ? dateParam : new Date(dateParam);
  var DAY_IN_MS = 86400000; var today = new Date(); var yesterday = new Date(today - DAY_IN_MS);
  var seconds = Math.round((today - date) / 1000); var minutes = Math.round(seconds / 60);
  var isToday = today.toDateString() === date.toDateString(); var isYesterday = yesterday.toDateString() === date.toDateString();
  var isThisYear = today.getFullYear() === date.getFullYear();
  if (seconds < 5) { return 'most'; }
  else if (seconds < 60) { return `${ seconds } másodperce`; }
  else if (seconds < 90) { return 'kb egy perce'; }
  else if (minutes < 60) { return `${ minutes } perce`; }
  else if (isToday) { return getFormattedDate(date, 'Ma'); }
  else if (isYesterday) {return getFormattedDate(date, 'Tegnap'); }
  else if (isThisYear) { return getFormattedDate(date, false, true); }
  return getFormattedDate(date);
}