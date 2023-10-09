<div class="login-form">
    <form id="bidForm" method="POST">
        <input type="hidden" name="vehicle_id" class="form-control" value="{{$vehicle->id}}">
        <div class="row mb-3">
            <div class="col-md-12">
                <input type="text" name="last_amount" class="form-control" placeholder="Current Bid Amount"
                       value="{{$last_bid_amount}}" readonly>
            </div>
        </div>
        <div class="row mb-3">
            <div class="col-md-12">
                <input type="text" name="amount" class="form-control integer" value="{{$bid_amount}}" placeholder="Amount">
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <input type="submit" class="place-bid-blue" name="submit" value="Submit">
            </div>
        </div>
    </form>
</div>

<script>
    var $bidForm = $('#bidForm')
    $bidForm.on('submit', function (e) {
        e.preventDefault()
        loaderView();
        let formData = new FormData($bidForm[0]);
        axios
            .post(APP_URL + '/vehicle-bid-store', formData)
            .then(function (response) {
                $bidForm[0].reset();
                loaderHide();
                if (response.data.success == true) {
                    $('#vehicle_bid_modal').modal('hide')
                    $('#carderails').modal('hide')
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
