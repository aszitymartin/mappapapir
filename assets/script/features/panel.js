var c__wrapper = document.createElement('div'); c__wrapper.classList = "wrapper_dark";
var c__box = document.createElement('div'); c__box.classList = "d__confirm fixed flex flex-col border-soft item-bg box-shadow padding-1";
function feat__learn (feature) { document.body.append(c__wrapper); c__wrapper.append(c__box); disableScroll(); c__box.id = "c__box";
    switch (feature) {
        case 'print': $('#c__box').load('/includes/addons/features/print.html'); break;
        case 'design': $('#c__box').load('/includes/addons/features/design.html'); break;
        case 'knitting': $('#c__box').load('/includes/addons/features/knit.html'); break;
        case 'shipping': $('#c__box').load('/includes/addons/features/ship.html'); break;
    }
}