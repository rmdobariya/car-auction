<div class="login-form">
    <form id="bidForm" method="POST">
        <input type="hidden" name="vehicle_id" class="form-control" value="{{$vehicle->id}}">
        <div class="row mb-3">
            <div class="col-md-12">
                <input type="text" name="last_amount" class="form-control"
                       placeholder="{{trans('web_string.current_bid_amount')}}"
                       value="{{$last_bid_amount}}" readonly>
            </div>
        </div>

        <div class="row mb-3">
            <div class="col-md-12">
                <input type="text" name="amount" class="form-control integer" value="{{$bid_amount}}"
                       placeholder="{{trans('web_string.amount')}}">
            </div>
        </div>

        <h4>Bank Detail</h4>
        @if(!empty($bank_name))
            <div class="row mb-3">
                <div class="col-md-12">
                    <label  class="fs-6 fw-bold mb-2">{{trans('web_string.bank_name')}}</label>
                    <input type="text" class="form-control" placeholder="{{trans('web_string.bank_name')}}"
                           value="{{$bank_name}}" readonly>
                </div>
            </div>
        @endif
        @if(!empty($iban))
            <div class="row mb-3">
                <div class="col-md-12">
                    <label  class="fs-6 fw-bold mb-2">{{trans('web_string.iban')}}</label>
                    <input type="text" class="form-control" placeholder="{{trans('web_string.iban')}}"
                           value="{{$iban}}" readonly>
                </div>
            </div>
        @endif
        @if(!empty($account_no))
            <div class="row mb-3">
                <div class="col-md-12">
                    <label  class="fs-6 fw-bold mb-2">{{trans('web_string.account_no')}}</label>
                    <input type="text" class="form-control" placeholder="{{trans('web_string.account_no')}}"
                           value="{{$account_no}}" readonly>
                </div>
            </div>
        @endif
        @if(!empty($national_id_no))
            <div class="row mb-3">
                <div class="col-md-12">
                    <label  class="fs-6 fw-bold mb-2">{{trans('web_string.national_id_no')}}</label>
                    <input type="text" class="form-control" placeholder="{{trans('web_string.national_id_no')}}"
                           value="{{$national_id_no}}" readonly>
                </div>
            </div>
        @endif
        @if(!empty($iban))
            <div class="row mb-3">
                <div class="col-md-12">
                    <label  class="fs-6 fw-bold mb-2">{{trans('web_string.iban')}}</label>
                    <input type="text" class="form-control" placeholder="{{trans('web_string.iban')}}"
                           value="{{$iban}}" readonly>
                </div>
            </div>
        @endif

        <div class="row">
            <div class="col-md-12">
                <input type="submit" class="place-bid-blue" name="submit" value="{{trans('web_string.submit')}}">
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
