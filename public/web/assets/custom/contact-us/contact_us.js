$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
})
let $contactUsForm = $('#contactUsForm')
$contactUsForm.on('submit', function (e) {
    e.preventDefault()
    loaderView();
    let formData = new FormData($contactUsForm[0]);
    axios
        .post(APP_URL + '/contact-us-store', formData)
        .then(function (response) {
            $contactUsForm[0].reset();
            loaderHide();
            notificationToast(response.data.message, 'success');
            window.location.reload();
        })
        .catch(function (error) {
            console.log(error);
            notificationToast(error.response.data.message, 'warning')
            loaderHide();
        });
})

    // var address = $('#address').val();
    // var embedUrl = 'https://www.google.com/maps/embed?';
    // if (address) {
    //     var encodedAddress = encodeURIComponent(address);
    //     embedUrl += 'q=' + encodedAddress;
    //     embedUrl += '&marker=' + encodedAddress;
    //     var iframeCode = '<iframe width="600" height="450" frameborder="0" style="border:0" src="' + embedUrl + '" allowfullscreen></iframe>';
    //     $('#map-container').html(iframeCode);
    // }

function initialize() {
    var mapCanvas = document.getElementById('map-container');
    var mapOptions = {
        center: new google.maps.LatLng(42.635507, -71.328928),
        zoom: 8,
        mapTypeId: google.maps.MapTypeId.ROADMAP
    }
    var map = new google.maps.Map(mapCanvas, mapOptions)
}
google.maps.event.addDomListener(window, 'load', initialize);
