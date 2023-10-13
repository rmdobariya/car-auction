<form id="vehicleInquiryForm">
    <div class="row">
        <input type="hidden" name="user_id" id="user_id" value="{{$user->id}}">
        <input type="hidden" name="vehicle_id" id="vehicle_id" value="{{$vehicle_id}}">
        <div class="col-md-6">
            <input type="text" name="first_name" class="form-control" value="{{$user->name}}" placeholder="{{trans('web_string.first_name')}}">
        </div>
        <div class="col-md-6">
            <input type="text" name="last_name" class="form-control" value="{{$user->last_name}}" placeholder="{{trans('web_string.last_name')}}">
        </div>

        <div class="col-md-12">
            <input type="email" name="email" class="form-control" value="{{$user->email}}" placeholder="{{trans('web_string.email')}}">
        </div>
        <div class="col-md-6">
            <input type="text" name="mobile_no" class="form-control integer" value="{{$user->contact_no}}" placeholder="{{trans('web_string.mobile_no')}}">
        </div>
        <div class="col-md-12">
            <textarea name="message" class="form-control" rows="4" placeholder="{{trans('web_string.comments_and_questions')}}"></textarea>
        </div>
        <div class="col-md-12">
            <input type="submit" class="place-bid-blue" name="submit" value="{{trans('web_string.submit')}}">
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
                    window.location.reload()
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

    function integerOnly() {
        $('.integer').keypress(function (event) {
            if (event.which !== 8 && event.which !== 0 && (event.which < 48 || event.which > 57)) {
                event.preventDefault();
            }
        });
    }
    $('.integer').keypress(function (event) {
        if (event.which !== 8 && event.which !== 0 && (event.which < 48 || event.which > 57)) {
            event.preventDefault();
        }
    });
</script>
