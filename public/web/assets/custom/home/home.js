$(document).on('click', '.like', function () {
    var vehicle_id = $(this).data('id');
    var user_id = $(this).data('user-id');
    if (user_id == 0) {
        notificationToast("please First Login Or Signup", 'warning')
    } else {
        var $iTag = $(this).find("i");
        loaderView()
        axios
            .post(APP_URL + '/wish-list', {
                vehicle_id: vehicle_id,
                user_id: user_id,
            })
            .then(function (response) {
                loaderHide()
                notificationToast(response.data.message, 'success')
                if (response.data.is_wishlist == 1) {
                    $iTag.removeClass('lar').addClass("las")
                } else {
                    $iTag.removeClass('las').addClass("lar")
                }

            })
            .catch(function (error) {
                notificationToast(error.response.data.message, 'warning')
                loaderHide()
            })
    }
    console.log(vehicle_id)
})
