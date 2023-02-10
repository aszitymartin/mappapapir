class sendAjaxRequest {

    constructor (object) {
        this.object = object;
    }

    sendRequest () {
        const returnObject = {};
        $.ajax({
            type: 'POST', 
            url: this.object['url'],
            data: this.object['data'],
            dataType: 'json',
            contentType: false,
            processData: false,
            success: function(s) {
                returnObject.res = s;
            }, error: function (e) {
                returnObject.res = e;
            }
        });
        return {
            result : returnObject
        };
    }

}