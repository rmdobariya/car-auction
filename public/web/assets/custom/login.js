$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
})
let $loginForm = $('#loginForm')
$loginForm.on('submit', function (e) {
    e.preventDefault()
    loaderView();
    let formData = new FormData($loginForm[0]);
    axios
        .post(APP_URL + '/login', formData)
        .then(function (response) {
            $loginForm[0].reset();
            loaderHide();
            if (response.data.user_type == 'seller') {
                setTimeout(function () {
                    window.location.href = 'add-auction';
                }, 1000);
            } else {
                setTimeout(function () {
                    window.location.reload();
                }, 1000);
            }

            notificationToast(response.data.message, 'success');
            $('#login').modal('hide');
        })
        .catch(function (error) {
            console.log(error);
            notificationToast(error.response.data.message, 'warning')
            loaderHide();
        });
})

let $registerform = $('#registerForm')
$registerform.on('submit', function (e) {
    e.preventDefault()
    loaderView();
    let formData = new FormData($registerform[0]);
    axios
        .post(APP_URL + '/register', formData)
        .then(function (response) {
            $registerform[0].reset();
            loaderHide();

            setTimeout(function () {
                window.location.href = APP_URL + '/';
            }, 1000);
            notificationToast(response.data.message, 'success');
            $('#login').modal('hide');
        })
        .catch(function (error) {
            console.log(error);
            notificationToast(error.response.data.message, 'warning')
            loaderHide();
        });
})

$(document).ready(function () {
    $('#forgot_password').on('click', function () {
        $('#login').modal('hide');
        setTimeout(function () {
            $('#forgot_password_form').modal('show')
        }, 1000);
    });

    $("#forgot_password_form").on('hide.bs.modal', function () {
        setTimeout(function () {
            $('body').css('overflow', 'auto');
            $('body').css('padding-right', '0px');
            $('.modal-backdrop').remove();
        }, 500);
    });
});

$('#forgot_password_submit').on('click', function () {
    let email = $('#forgot_email').val()
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

let $form = $('#addEditForm')
$form.on('submit', function (e) {
    e.preventDefault()
    let formData = new FormData($form[0])
    axios
        .post(APP_URL + '/reset-password-submit', formData)
        .then(function (response) {
            $form[0].reset();
            loaderHide();

            window.location.href = APP_URL + redirect_url


            notificationToast(response.data.message, 'success');
        })
        .catch(function (error) {
            console.log(error)
            notificationToast(error.response.data.message, 'warning')
            loaderHide();
        });
})
