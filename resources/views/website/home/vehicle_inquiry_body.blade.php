<form id="vehicleInquiryForm">
    <div class="row">
        <input type="hidden" name="user_id" id="user_id" value="{{$user->id}}">
        <input type="hidden" name="vehicle_id" id="vehicle_id" value="{{$vehicle_id}}">
        <div class="col-md-6">
            <input type="text" name="first_name" class="form-control" value="{{$user->name}}" placeholder="First Name *">
        </div>
        <div class="col-md-6">
            <input type="text" name="last_name" class="form-control" value="{{$user->last_name}}" placeholder="Last Name *">
        </div>
        <div class="col-md-12">
            <input type="email" name="email" class="form-control" value="{{$user->email}}" placeholder="Email *">
        </div>
        <div class="col-md-12">
            <textarea name="message" class="form-control" rows="4" placeholder="Comments and Questions *"></textarea>
        </div>
        <div class="col-md-12">
            <input type="submit" class="place-bid-blue" name="submit" value="Submit">
        </div>
    </div>
</form>
<script>
    var $inquiryForm = $('#vehicleInquiryForm')
    $inquiryForm.on('submit', function (e) {
        e.preventDefault()
        loaderView();
        let formData = new FormData($inquiryForm[0]);
        axios
            .post(APP_URL + '/vehicle-inquiry-store', formData)
            .then(function (response) {
                $inquiryForm[0].reset();
                loaderHide();
                if (response.data.success == true) {
                    $('#car_inquiry').modal('hide')
                    notificationToast(response.data.message, 'success');
                } else {
                    notificationToast(response.data.message, 'warning')
                }

            })
            .catch(function (error) {
                console.log(error);
                notificationToast(error.response.data.message, 'warning')
                loaderHide();
            });
    })
</script>
