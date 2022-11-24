const staff_widget_button = document.getElementsByClassName('staff-widget-setting');
for (let i = 0; i < staff_widget_button.length; i++) {
    staff_widget_button[i].id = "staff_widget_button" + i;const staff_wrapper = document.createElement('div');
    staff_wrapper.classList = 'wrapper wrapper_transparent';staff_wrapper.id = "staff_wrapper" + i;
    const staff_widget_settings = document.createElement('div');staff_widget_settings.classList = 'staff_widget_settings flex flex-col';staff_widget_settings.id = 'staff_widget_setting' + i;
    staff_widget_settings.innerHTML = `
        <div class="menu-bg flex flex-col border-softer box-shadow-dark padding-05">
            <div class="staff_widget_item border-soft pointer hide-desktop flex-justify-con-c">
                <span class="text-secondary flex flex-align-c flex-justify-con-c">
                    <span id="menu-header-`+i+`"></span>
                    <span></span>
                </span>
            </div>
            <div class="staff_widget_item border-soft pointer">
                <span class="text-primary flex flex-align-c flex-justify-con-c">
                    <span>1 év</span>
                    <span></span>
                </span>
            </div>
            <div class="staff_widget_item border-soft pointer">
                <span class="text-primary flex flex-align-c flex-justify-con-c">
                    <span>30 nap</span>
                    <span></span>
                </span>
            </div>
            <div class="staff_widget_item border-soft pointer">
                <span class="text-primary flex flex-align-c flex-justify-con-c">
                    <span>1 hét</span>
                    <span></span>
                </span>
            </div>
            <div class="staff_widget_item border-soft pointer">
                <span class="text-primary flex flex-align-c flex-justify-con-c">
                    <span>Mai nap</span>
                    <span></span>
                </span>
            </div>
        </div>
        <div class="item-bg flex flex-col border-softer box-shadow-dark padding-05 hide-desktop" style="margin-top: .5rem;">
            <div class="staff_widget_item border-soft pointer" style="background-color: var(--item) !important;">
                <span class="text-danger flex flex-align-c flex-justify-con-c">
                    <span>Mégse</span>
                    <span></span>
                </span>
            </div>
        </div>
    `;
    document.getElementById('staff_widget_button' + i).addEventListener('click', (e) => {
        document.body.style.overflow = "hidden";document.body.style.maxHeight = "100vh";document.body.append(staff_wrapper);
        document.getElementById('staff_widget_button' + i).classList.add('widget-active');document.getElementById('staff_widget_button' + i).parentNode.parentNode.append(staff_widget_settings);
        document.getElementById('staff_wrapper' + i).classList.add('blured');document.getElementById('menu-header-'+i).textContent = document.getElementById('staff_widget_button' + i).parentNode.parentNode.getElementsByClassName('staff-info-title')[0].innerText;
        document.getElementById('staff_wrapper'+i).addEventListener('click', () => {
            document.body.style.overflow = "auto";document.body.style.maxHeight = "auto";
            document.getElementById('staff_wrapper' + i).classList.remove('blured');
            $('#staff_wrapper' + i).remove();document.getElementById('staff_widget_button' + i).classList.remove('widget-active');staff_widget_settings.remove();
        });
    });
}