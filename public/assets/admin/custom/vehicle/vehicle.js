$(function () {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    })

    $(document).on('click', '.delete-single', function () {
        const value_id = $(this).data('id')
        Swal.fire({
            title: 'Delete?',
            text: 'Are You Sure Delete This Entry',
            type: 'warning',
            showCancelButton: !0,
            confirmButtonColor: '#556ee6',
            cancelButtonColor: '#f46a6a'
        }).then(function (t) {
            if (t.value) {
                deleteRecord(value_id)
            }
        })
    })

    $(document).on('click', '.delete-vehicle-image', function () {
        const image_id = $(this).data('id');
        const vehicle_id = $(this).data('vehicle-id');

        Swal.fire({
            title: delete_offer_image,
            text: delete_offer_image_text,
            type: 'warning',
            showCancelButton: !0,
            confirmButtonColor: '#556ee6',
            cancelButtonColor: '#f46a6a'
        }).then(function (t) {
            if (t.value) {
                deleteVehicleImage(image_id ,vehicle_id)
            }
        })
    })
    function deleteVehicleImage(image_id, vehicle_id) {
        $.ajax({
            type: 'GET',
            url: APP_URL + '/deleteVehicleImage' + '/' + image_id,
            success: function (data) {
                notificationToast(data.message, 'success');
                getVehicleGallery(vehicle_id);

            }, error: function (data) {
                console.log('Error:', data)
            }
        })
    }

    function getVehicleGallery(vehicle_id) {
        loaderView();
        $.ajax({
            type: 'POST',
            data: {vehicle_id: vehicle_id},
            url: APP_URL + '/getVehicleGallery',
            dataType: 'html',
            success: function (response) {
                $("#gallery").html(response.data);
                loaderHide();
                window.location.reload()

            }, error: function (data) {
                console.log('Error:', data)
            }
        })
    }
})


