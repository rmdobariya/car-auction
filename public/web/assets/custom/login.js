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

            setTimeout(function () {
                window.location.reload();
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


