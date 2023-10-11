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
    var auction_end_date = new Date(start_date);
    var targetDate = new Date(auction_end_date);
    targetDate.setHours(23);
    targetDate.setMinutes(60);
    targetDate.setSeconds(60);
    var formattedDateTime = targetDate.toISOString().slice(0, 24).replace('T', ' ');
    $("#my-auction-counter_" + id)
        .countdown(formattedDateTime, function (event) {
            $("#my-auction-counter_" + id).html(
                event.strftime('<span>Day<strong>%D</strong></span> <span>Hours<strong>%H</strong></span> <span>Mins<strong>%M</strong> </span> <span>Sec<strong>%S</strong></span>')
            );
        });
});

var $win_object = $(".win_vehicle_id");
$win_object.each(function (i) {
    var win_id = $(this).val();
    var win_start_date = $('#win_start_date_' + win_id).val()
    var win_auction_end_date = new Date(win_start_date);
    var winTargetDate = new Date(win_auction_end_date);
    winTargetDate.setHours(23);
    winTargetDate.setMinutes(60);
    winTargetDate.setSeconds(60);
    var winFormattedDateTime = winTargetDate.toISOString().slice(0, 24).replace('T', ' ');
    $("#win_my-auction-counter_" + win_id)
        .countdown(winFormattedDateTime, function (event) {
            $("#win_my-auction-counter_" + win_id).html(
                event.strftime('<span>Day<strong>%D</strong></span> <span>Hours<strong>%H</strong></span> <span>Mins<strong>%M</strong> </span> <span>Sec<strong>%S</strong></span>')
            );
        });
});
