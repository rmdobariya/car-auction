$(function () {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    })

    var edit_value = $("#edit_value").val();
    var uploader = new qq.FineUploader({
        debug: true,
        element: document.getElementById('fine-uploader'),
        request: {
            endpoint: APP_URL + IMAGE_UPLOAD_URL,
            customHeaders: {
                "X-CSRF-Token": $("meta[name='csrf-token']").attr("content")
            }, params: {
                temp_time: $("#temp_time").val()
            },
        },
        resume: {
            enabled: true
        },
        deleteFile: {
            enabled: true,
            endpoint: APP_URL + IMAGE_DELETE_URL,
            customHeaders: {
                "X-CSRF-Token": $("meta[name='csrf-token']").attr("content")
            },
        },
        thumbnails: {
            placeholders: {
                waitingPath: JS_URL + '/assets/libs/fine-uploader/placeholders/waiting-generic.png',
                notAvailablePath: JS_URL + '/assets/libs/fine-uploader/placeholders/not_available-generic.png'
            }
        },
        validation: {
            allowedExtensions: ['jpeg', 'jpg', 'png']
        },
        retry: {
            enableAuto: false
        },
    });
});
