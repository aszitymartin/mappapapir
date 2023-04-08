class sendAjaxRequest {

    async sendRequest (object) {
        const returnObjectConst = {};
        await $.ajax({
            enctype: "multipart/form-data",
            type: "POST",
            url: object['url'],
            data: object['data'],
            dataType: 'json',
            cache: false,
            processData: false,
            contentType: false,
            beforeSend : function () {
                if (object['loaderContainer']['isset'] == true) {
                    document.getElementById(object['loaderContainer']['id']).innerHTML = `
                        <div class="flex flex-col flex-align-c flex-justify-con-c gap-1 small text-muted user-select-none w-fa">
                            <span><svg class='wizard_input_loading' id="loaderIcon" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="0" height="0" viewBox="0 0 24 24" version="1.1"><g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"><g><polygon points="0 0 24 0 24 24 0 24"/></g><path d="M12,4 L12,6 C8.6862915,6 6,8.6862915 6,12 C6,15.3137085 8.6862915,18 12,18 C15.3137085,18 18,15.3137085 18,12 C18,10.9603196 17.7360885,9.96126435 17.2402578,9.07513926 L18.9856052,8.09853149 C19.6473536,9.28117708 20,10.6161442 20,12 C20,16.418278 16.418278,20 12,20 C7.581722,20 4,16.418278 4,12 C4,7.581722 7.581722,4 12,4 Z" ${object['loaderContainer']['iconColor']['isset'] ? `fill="${object['loaderContainer']['iconColor']['color']}"` : `class="svg"`} fill-rule="nonzero" opacity="0.4" transform="translate(12.000000, 12.000000) scale(-1, 1) translate(-12.000000, -12.000000) "/></g></svg></span>
                            <span id="loaderText"></span>
                        </div>
                    `;
                    if (object['loaderContainer']['type'] == 'button') {
                        document.getElementById(object['loaderContainer']['id']).innerHTML = `
                            <span id="loaderButtonText"></span>
                            <svg class='wizard_input_loading' xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="${object['loaderContainer']['iconSize']['iconWidth']}px" height="${object['loaderContainer']['iconSize']['iconHeight']}px" viewBox="0 0 24 24" version="1.1"><g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"><g><polygon points="0 0 24 0 24 24 0 24"/></g><path d="M12,4 L12,6 C8.6862915,6 6,8.6862915 6,12 C6,15.3137085 8.6862915,18 12,18 C15.3137085,18 18,15.3137085 18,12 C18,10.9603196 17.7360885,9.96126435 17.2402578,9.07513926 L18.9856052,8.09853149 C19.6473536,9.28117708 20,10.6161442 20,12 C20,16.418278 16.418278,20 12,20 C7.581722,20 4,16.418278 4,12 C4,7.581722 7.581722,4 12,4 Z" ${object['loaderContainer']['iconColor']['isset'] ? `fill="${object['loaderContainer']['iconColor']['color']}"` : `class="svg"`} fill-rule="nonzero" opacity="0.4" transform="translate(12.000000, 12.000000) scale(-1, 1) translate(-12.000000, -12.000000) "/></g></svg>
                        `;
                        if (object['loaderContainer']['loaderText']['custom'] == true) {
                            document.getElementById('loaderButtonText').innerHTML = object['loaderContainer']['loaderText']['customText'];
                        } else {
                            document.getElementById('loaderButtonText').textContent = 'Betöltés folyamatban';
                        }
                    } else {
                        document.getElementById('loaderIcon').setAttribute('width', object['loaderContainer']['iconSize']['iconWidth']);
                        document.getElementById('loaderIcon').setAttribute('height', object['loaderContainer']['iconSize']['iconHeight']);
                        if (object['loaderContainer']['loaderText']['custom'] == true) {
                            document.getElementById('loaderText').innerHTML = object['loaderContainer']['loaderText']['customText'];
                        } else {
                            document.getElementById('loaderText').textContent = 'Betöltés folyamatban';
                        }
                    }
                }
            }, success: function(s) {
                if (s !== null) {
                    for (let i = 0; i < Object.keys(s).length; i++) {
                        returnObjectConst[Object.keys(s)[i]] = s[Object.keys(s)[i]];
                    }
                } else {
                    returnObjectConst.status = 'error';
                    returnObjectConst.message = 'Hiba történt a folyamat közben.';
                }
            }, error: function (e) { returnObjectConst.res = e; }
        }); return returnObjectConst;
    }

    async validateObject (object, dataName) {

        const datas = JSON.parse(object.data.get(dataName)); var emptyKeys = [];
        for (let i = 0; i < Object.keys(datas).length; i++) {
            if (Object.keys(datas)[i] != 'uid' && Object.keys(datas)[i] != 'action' && Object.keys(datas)[i] != 'attachment' && Object.keys(datas)[i] != 'ip' && Object.keys(datas)[i] != 'body') {
                if (Object.keys(datas)[i] == 'description') {
                    if (datas[Object.keys(datas)[i]].length < 12) {
                        emptyKeys.push(Object.keys(datas)[i]);
                    }
                }
                if (datas[Object.keys(datas)[i]].length < 1) {
                    emptyKeys.push(Object.keys(datas)[i]);
                }

            }
        }
        return emptyKeys;
    }

}

function sendToAjaxRequest (object) {
    const ajaxCall = new sendAjaxRequest();
    const ajaxResult = ajaxCall.sendRequest(object);
    return ajaxResult;
} async function getFromAjaxRequest (object) {
    const response = await sendToAjaxRequest(object)
    .then (response => { return response; })
    .catch (error => { return error; });
    return response;
}

async function sendAjaxValidate (object, dataName) {
    const ajaxCall = new sendAjaxRequest();
    const ajaxResult = ajaxCall.validateObject(object, dataName);
    return ajaxResult;
} async function getFromAjaxValidate (object, dataName) {
    const response = await sendAjaxValidate(object, dataName)
    .then (response => { return response; })
    .catch (error => { return error; });
    return response;
}