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

$('.is_vehicle_type').on('click', function () {
    var val = $(this).val();
    if (val == 'car_for_sell') {
        $('#auction_date_time_part').addClass('d-none')
        $('#minimumBidIncrement').addClass('d-none')
        $('#bid_increment').addClass('d-none')
    } else {
        $('#auction_date_time_part').removeClass('d-none')
        $('#minimumBidIncrement').removeClass('d-none')
        $('#bid_increment').removeClass('d-none')
    }
})
$(document).on('click', '.delete-single', function () {
    const value_id = $(this).data('id')
    Swal.fire({
        title: 'Car Delete?',
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

function deleteRecord(image_id, vehicle_id) {
    $.ajax({
        type: 'GET',
        url: APP_URL + '/deleteCar' + '/' + image_id,
        success: function (data) {
            notificationToast(data.message, 'success');
            getVehicleGallery(vehicle_id);

        }, error: function (data) {
            console.log('Error:', data)
        }
    })
}

$(document).on('click', '.delete-vehicle-image', function () {
    const image_id = $(this).data('id');
    const vehicle_id = $(this).data('vehicle-id');

    Swal.fire({
        title: 'Car Image Delete?',
        text: 'Are You Sure Delete This Record',
        type: 'warning',
        showCancelButton: !0,
        confirmButtonColor: '#556ee6',
        cancelButtonColor: '#f46a6a'
    }).then(function (t) {
        if (t.value) {
            deleteVehicleImage(image_id, vehicle_id)
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
            $("#car_gallery").html(response.data);
            loaderHide();
            window.location.reload()

        }, error: function (data) {
            console.log('Error:', data)
        }
    })
}

$(document).on('click', '.delete-car-document', function () {
    const image_id = $(this).data('id');
    const vehicle_id = $(this).data('vehicle-id');

    Swal.fire({
        title: 'Car Document Delete?',
        text: 'Are You Sure Delete This Record',
        type: 'warning',
        showCancelButton: !0,
        confirmButtonColor: '#556ee6',
        cancelButtonColor: '#f46a6a'
    }).then(function (t) {
        if (t.value) {
            deleteVehicleDocumennt(image_id, vehicle_id)
        }
    })
})

function deleteVehicleDocumennt(image_id, vehicle_id) {
    $.ajax({
        type: 'GET',
        url: APP_URL + '/deleteVehicleDocument' + '/' + image_id,
        success: function (data) {
            notificationToast(data.message, 'success');
            getVehicleDocument(vehicle_id);

        }, error: function (data) {
            console.log('Error:', data)
        }
    })
}

function getVehicleDocument(vehicle_id) {
    loaderView();
    $.ajax({
        type: 'POST',
        data: {vehicle_id: vehicle_id},
        url: APP_URL + '/getVehicleDocument',
        dataType: 'html',
        success: function (response) {
            $("#car_document").html(response.data);
            loaderHide();
            window.location.reload()

        }, error: function (data) {
            console.log('Error:', data)
        }
    })
}



