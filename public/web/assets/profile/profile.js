$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
})
let $profileForm = $('#updateProfileForm')
$profileForm.on('submit', function (e) {
    e.preventDefault()
    loaderView();
    let formData = new FormData($profileForm[0]);
    axios
        .post(APP_URL + '/update-profile', formData)
        .then(function (response) {
            $profileForm[0].reset();
            loaderHide();

            setTimeout(function () {
                window.location.href = APP_URL + '/user-profile';
            }, 1000);
            notificationToast(response.data.message, 'success');
        })
        .catch(function (error) {
            console.log(error);
            notificationToast(error.response.data.message, 'warning')
            loaderHide();
        });
})
