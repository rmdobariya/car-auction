$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
})
let $vehicleAddForm = $('#vehicleAddForm')
$vehicleAddForm.on('submit', function (e) {
    e.preventDefault()
    loaderView();
    let formData = new FormData($vehicleAddForm[0]);
    axios
        .post(APP_URL + '/add-vehicle-store', formData)
        .then(function (response) {
            $vehicleAddForm[0].reset();
            loaderHide();

            setTimeout(function () {
                window.location.href = APP_URL + '/add-auction';
            }, 1000);
            notificationToast(response.data.message, 'success');
        })
        .catch(function (error) {
            console.log(error);
            notificationToast(error.response.data.message, 'warning')
            loaderHide();
        });
})
