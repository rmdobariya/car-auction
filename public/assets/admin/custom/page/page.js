$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
})
let $form = $('#addEditForm')
$form.on('submit', function (e) {
    e.preventDefault()
    loaderView();
    let formData = new FormData($form[0])
    axios
        .post(APP_URL + form_url, formData)
        .then(function (response) {
            $form[0].reset();
            loaderHide();
            if (typeof table !== 'undefined') {
                table.draw()
                $(".btn-close").click()
                $("#edit_value").val(0)
            }
            if (typeof redirect_url !== 'undefined') {
                setTimeout(function () {
                    window.location.href = APP_URL + redirect_url
                }, 1000)
            }
            notificationToast(response.data.message, 'success');
        })
        .catch(function (error) {
            console.log(error)
            notificationToast(error.response.data.message, 'warning')
            loaderHide();
        });
})


