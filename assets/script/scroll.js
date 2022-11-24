// https://stackoverflow.com/a/4770179/14038646
// keys -> Letiltja az arrow key-ekkel valo navigalast. Ki van commentelve, mert ha aktiv, nem lehet a kurzort mozgatni az input mezokben.
//var keys = {37: 1, 38: 1, 39: 1, 40: 1}; 
var keys = {};
function preventDefault(e) { e.preventDefault(); }
function preventDefaultForScrollKeys(e) { if (keys[e.keyCode]) { preventDefault(e); return false; } }
var supportsPassive = false;
try { window.addEventListener("test", null, Object.defineProperty({}, 'passive', { get: function () { supportsPassive = true; } })); }
catch(e) {}
var wheelOpt = supportsPassive ? { passive: false } : false; var wheelEvent = 'onwheel' in document.createElement('div') ? 'wheel' : 'mousewheel';
function disableScroll() {
  window.addEventListener('DOMMouseScroll', preventDefault, false); window.addEventListener(wheelEvent, preventDefault, wheelOpt);
  window.addEventListener('touchmove', preventDefault, wheelOpt); window.addEventListener('keydown', preventDefaultForScrollKeys, false);
}
function enableScroll() {
    window.removeEventListener('DOMMouseScroll', preventDefault, false);window.removeEventListener(wheelEvent, preventDefault, wheelOpt); 
    window.removeEventListener('touchmove', preventDefault, wheelOpt);window.removeEventListener('keydown', preventDefaultForScrollKeys, false);
}