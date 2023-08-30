$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
})
let $form = $('#addEditForm')
$form.on('submit', function (e) {
    e.preventDefault()
    loaderView();
    if($form[0]['description'] != undefined){
        CKEDITOR.replace( 'description' );
        CKEDITOR.instances['description'].updateElement();
        CKEDITOR.instances['description'].getData();
    }
    if($form[0]['answer'] != undefined){
        CKEDITOR.replace( 'answer' );
        CKEDITOR.instances['answer'].updateElement();
        CKEDITOR.instances['answer'].getData();
    }
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

$('#forgot_password').on('click', function () {
    $('#forgot_password_form').modal('show')
})
$('#forgot_password_submit').on('click', function () {
    let email = $('#forgot_email').val()
    console.log(email)
    if (email === '') {
        notificationToast('Please Enter Email', 'warning')
        return false
    }
    loaderView()
    axios
        .post(APP_URL + '/send-mail', {
            email: email,
        })
        .then(function (response) {
            $('#forgot_password_form').modal('hide')
            loaderHide()
            notificationToast(response.data.message, 'success')
        })
        .catch(function (error) {
            notificationToast(error.response.data.message, 'warning')
            loaderHide()
        })
})


