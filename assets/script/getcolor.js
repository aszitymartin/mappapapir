var nwplink = document.getElementsByClassName("nwpr__link");
for (i = 0; i < nwplink.length; i++) { nwplink[i].addEventListener("click", function () { window.location.href = "/webshop/?id="+nwplink[i].getAttribute("pid")+"&method=50"; }); }

function addImage(file) { var img = document.getElementsByClassName("dc__img"); 
    for (let dci = 0; dci < img.length; dci++) {
        img[dci].src = file; img[dci].onload = function() { var rgb = getAverageColor(img[dci]); var rgbStr = "rgb(" + rgb.r + ", " + rgb.g + ", " + rgb.b + ")"; var hsl = rgbToHsl(rgb.r, rgb.g, rgb.b); var hslStr = "hsl(" + Math.round(hsl.h * 360) + ", " + Math.round(hsl.s * 100) + "%, " + Math.round(hsl.l * 100) + "%)"; var hexStr = "#" + ("0"+rgb.r.toString(16)).slice(-2) + ("0"+rgb.g.toString(16)).slice(-2) + ("0"+rgb.b.toString(16)).slice(-2);
        var ibg = document.getElementsByClassName("dom__color"); var nwi = document.getElementsByClassName("nwst__info"); for (let dmc = 0; dmc < ibg.length; dmc++) { ibg[dmc].style.backgroundColor = rgbStr; } for (let nwf = 0; nwf < nwi.length; nwf++) { nwi[nwf].style.color = "#"+contrastingColor(hexStr.replace("#", ""));; }
        var bdgcp = document.getElementsByClassName("button-dgcp"); for (let i = 0; i < bdgcp.length; i++) { bdgcp[i].style.border = "1px solid #"+contrastingColor(hexStr.replace("#", "")); } };
    }
} function getAverageColor(img) { var canvas = document.createElement("canvas"); var ctx = canvas.getContext("2d");var width = canvas.width = img.naturalWidth;var height = canvas.height = img.naturalHeight; ctx.drawImage(img, 0, 0); var imageData = ctx.getImageData(0, 0, width, height); var data = imageData.data;
var r = 0;var g = 0;var b = 0; for (var i = 0, l = data.length; i < l; i += 4) { r += data[i]; g += data[i+1]; b += data[i+2]; } r = Math.floor(r / (data.length / 4)); g = Math.floor(g / (data.length / 4)); b = Math.floor(b / (data.length / 4)); return { r: r, g: g, b: b }; } function handleImages(files) {addImage(files); } handleImages($("#nwpr__img").attr("src"));
function rgbToHsl(r, g, b) { r /= 255; g /= 255; b /= 255;var max = Math.max(r, g, b), min = Math.min(r, g, b);var h, s, l = (max + min) / 2;if (max == min) {h = s = 0;} else {var d = max - min;s = l > 0.5 ? d / (2 - max - min) : d / (max + min);switch (max) {case r: h = (g - b) / d + (g < b ? 6 : 0); break;case g: h = (b - r) / d + 2; break;case b: h = (r - g) / d + 4; break;}h /= 6;} return { h: h, s: s, l: l }; }

function contrastingColor(color) { return (luma(color) >= 165) ? "000" : "fff"; }
function luma(color) { var rgb = (typeof color === "string") ? hexToRGBArray(color) : color; return (0.2126 * rgb[0]) + (0.7152 * rgb[1]) + (0.0722 * rgb[2]); }
function hexToRGBArray(color) { if (color.length === 3) { color = color.charAt(0) + color.charAt(0) + color.charAt(1) + color.charAt(1) + color.charAt(2) + color.charAt(2); }
else if (color.length !== 6) { throw("Invalid hex color: " + color); } var rgb = []; for (var i = 0; i <= 2; i++) { rgb[i] = parseInt(color.substr(i * 2, 2), 16); } return rgb; }