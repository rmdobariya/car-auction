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

function openSelect(file) {
    $(file).trigger('click');
}

var loadFile = function (event) {
    console.log(event)
    var output = document.getElementById('displayedImage');
    output.src = URL.createObjectURL(event.target.files[0]);
    output.onload = function () {
        URL.revokeObjectURL(output.src) // free memory
    }
    let $changeImageForm = $('#updateProfileForm');
    loaderView()
    let formData = new FormData($changeImageForm[0]);
    axios
        .post(APP_URL + '/change-image', formData)
        .then(function (response) {
            $changeImageForm[0].reset();
            loaderHide();

            // setTimeout(function () {
            //     window.location.href = APP_URL + '/user-profile';
            // }, 1000);
            notificationToast(response.data.message, 'success');
        })
        .catch(function (error) {
            console.log(error);
            notificationToast(error.response.data.message, 'warning')
            loaderHide();
        });
};

var $j_object = $(".vehicle_id");
$j_object.each(function (i) {
    var id = $(this).val();
    var start_date = $('#start_date_' + id).val()
    $("#my-auction-counter_" + id)
        .countdown(start_date, function (event) {
            $("#my-auction-counter_" + id).html(
                event.strftime('<span>Day<strong>%D</strong></span> <span>Hours<strong>%H</strong></span> <span>Mins<strong>%M</strong> </span> <span>Sec<strong>%S</strong></span>')
            );
        });
});
