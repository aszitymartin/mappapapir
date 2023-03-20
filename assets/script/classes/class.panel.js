class sendPanelRequest {

    async showPanel (object) {

        function closePanel () {

            ce__box.classList.replace("popup", "popout");
            ce__wrapper.classList.add("fadeout");
            setTimeout(() => {ce__wrapper.remove();},235);

        }

        var ce__wrapper = document.createElement('div');
        ce__wrapper.classList = "wrapper_dark fadein z-index-100";
        ce__wrapper.addEventListener('click', (e) => {
            if (e.target == ce__wrapper) { closePanel(); }
        });
        var ce__box = document.createElement('div');
        ce__box.id = object['id'];
        ce__box.classList = "d__confirm de__confirm popup fixed flex flex-col border-soft item-bg box-shadow";
        object.parent == 'body' ? document.body.append(ce__wrapper) : document.getElementById(object.parent).append(ce__wrapper);
        ce__wrapper.append(ce__box); $('html').css("overflow-y", "hidden");

        if (object['header'].isset == true) {
            var panel_header = `<div class="flex flex-row flex-align-c w-fa padding-1" id="panel-header"></div>`;
            ce__box.innerHTML = panel_header;

            if (object['header']['title'].isset == true) {
                document.getElementById('panel-header').innerHTML += `
                    <span class="text-primary bold">${object['header']['title'].title}</span>
                `;
            }

            if (object['header']['close'].isset == true) {
                document.getElementById('panel-header').classList.add('flex-justify-con-fe');
                document.getElementById('panel-header').innerHTML += `
                    <div
                        id="${object['header']['close'].id}"
                        class="user_action_button pointer flex flex-align-c flex-justify-con-c has-tooltip padding-05 relative text-primary"
                        aria-describedby="tooltip-close
                    ">
                        <svg width="${object['header']['close']['icon']['size'].width + "" + object['header']['close']['icon']['size'].unit}" height="${object['header']['close']['icon']['size'].height + "" + object['header']['close']['icon']['size'].unit}" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <rect opacity="0.3" x="2" y="2" width="20" height="20" rx="5" fill="${object['header']['close']['icon'].fill}"/>
                            <rect x="7" y="15.3137" width="12" height="2" rx="1" transform="rotate(-45 7 15.3137)" fill="${object['header']['close']['icon'].fill}"/>
                            <rect x="8.41422" y="7" width="12" height="2" rx="1" transform="rotate(45 8.41422 7)" fill="${object['header']['close']['icon'].fill}"/>
                        </svg>
                        <span class="tooltip absolute" id="tooltip-close">
                            <span key="tooltip-close" key="tooltip-close">${object['header']['close']['icon'].title}</span>
                        </span>
                    </div>
                `;
            }

            if (object['header']['title'].isset == true && object['header']['close'].isset == true) {
                document.getElementById('panel-header').classList.remove('flex-justify-con-fe');
                document.getElementById('panel-header').classList.add('flex-justify-con-sb');
            }

        }

        if (object['body'].isset == true) { ce__box.innerHTML += object['body'].html; }
        if (object['footer'].isset == true) { ce__box.innerHTML += object['footer'].html; }

        var closeActions = document.querySelectorAll('[action="close"]');
        for (let i = 0; i < closeActions.length; i++) { closeActions[i].addEventListener('click', () => { closePanel(); }); }

        var con = document.getElementById('panel-header'); var mc = new Hammer(con);
        mc.get('pan').set({ direction: Hammer.DIRECTION_ALL }); mc.on("pandown", function(ev) { closePanel(); });
        $("#" + object['header']['close'].id).click(() => { closePanel(); });

        return true;

    }

}

function sendToPanelRequest (object) {
    const ajaxCall = new sendPanelRequest();
    const ajaxResult = ajaxCall.showPanel(object);
    return ajaxResult;
} async function getFromPanelRequest (object) {
    const response = await sendToPanelRequest(object)
    .then (response => { return response; })
    .catch (error => { return error; });
    return response;
}