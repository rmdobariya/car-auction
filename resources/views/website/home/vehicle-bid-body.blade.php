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


        <div class="input-group">
          <span class="input-group-btn">
              <button type="button" class="btn btn-default btn-minus" id="btn-minus">
                  <i class="fas fa-solid fa-minus"></i>
              </button>
          </span>
            <input type="text" name="amount" id="amount" class="form-control input-number integer"
                   value="{{$bid_amount}}"
                   placeholder="{{trans('web_string.amount')}}" min="{{$bid_amount}}">
            <span class="input-group-btn">
              <button type="button" class="btn btn-default btn-plus" id="btn-plus">
                 <i class="fas fa-solid fa-plus"></i>
              </button>
          </span>
        </div>

{{--        <div class="mb-3 mt-3 col-md-12">--}}
{{--            <div class="fv-row mb-7 fv-plugins-icon-container">--}}
{{--                <label class="required fs-6 fw-bold mb-2" for="year">--}}
{{--                    {{trans('web_string.payment_proof')}}--}}
{{--                </label>--}}
{{--                <input type="file" class="form-control form-control-solid"--}}
{{--                       name="payment_proof"--}}
{{--                       placeholder="{{trans('web_string.payment_proof')}}"/>--}}
{{--            </div>--}}
{{--        </div>--}}

        <h4 class="mt-3">{{trans('web_string.bank_detail')}}</h4>
        @if(!empty($bank_name) || !empty($iban) || !empty($account_no) || !empty($national_id_no))
            <div class="row mb-3">
                <div class="col-md-12">
                    <table class="table">
                        <tbody>
                        @if(!empty($bank_name))
                            <tr>
                                <th scope="row">{{ trans('web_string.bank_name') }}</th>
                                <td>{{ $bank_name }}</td>
                            </tr>
                        @endif
                        @if(!empty($iban))
                            <tr>
                                <th scope="row">{{ trans('web_string.iban') }}</th>
                                <td>{{ $iban }}</td>
                            </tr>
                        @endif
                        @if(!empty($account_no))
                            <tr>
                                <th scope="row">{{ trans('web_string.account_no') }}</th>
                                <td>{{ $account_no }}</td>
                            </tr>
                        @endif
                        @if(!empty($national_id_no))
                            <tr>
                                <th scope="row">{{ trans('web_string.national_id_no') }}</th>
                                <td>{{ $national_id_no }}</td>
                            </tr>
                        @endif
                        </tbody>
                    </table>
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
    var min_bid_increment = '{{$vehicle->bid_increment}}';
    $('#btn-plus').click(function () {
        var currentValue = parseInt($('input[name="amount"]').val());
        var minValue = parseInt($('input[name="amount"]').attr('min'));
        var maxValue = parseInt($('input[name="amount"]').attr('max'));
        if (!isNaN(currentValue)) {
            $('input[name="amount"]').val(currentValue + parseInt(min_bid_increment));
        }
    });

    $('#btn-minus').click(function () {
        var currentValue = parseInt($('input[name="amount"]').val());
        var minValue = parseInt($('input[name="amount"]').attr('min'));
        var maxValue = parseInt($('input[name="amount"]').attr('max'));

        if (!isNaN(currentValue) && currentValue > minValue) {
            $('input[name="amount"]').val(currentValue - parseInt(min_bid_increment));
        }else{
            notificationToast('The minimum amount you can make is this much', 'warning')
        }
    });
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
                    window.location.reload()
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

    $('.btn-number').click(function (e) {
        e.preventDefault();

        fieldName = $(this).attr('data-field');
        type = $(this).attr('data-type');
        var input = $("input[name='" + fieldName + "']");
        var currentVal = parseInt(input.val());
        if (!isNaN(currentVal)) {
            if (type == 'minus') {

                if (currentVal > input.attr('min')) {
                    input.val(currentVal - 1).change();
                }
                if (parseInt(input.val()) == input.attr('min')) {
                    $(this).attr('disabled', true);
                }

            } else if (type == 'plus') {

                if (currentVal < input.attr('max')) {
                    input.val(currentVal + 1).change();
                }
                if (parseInt(input.val()) == input.attr('max')) {
                    $(this).attr('disabled', true);
                }

            }
        } else {
            input.val(0);
        }
    });
    $('.input-number').focusin(function () {
        $(this).data('oldValue', $(this).val());
    });
    $('.input-number').change(function () {

        minValue = parseInt($(this).attr('min'));
        maxValue = parseInt($(this).attr('max'));
        valueCurrent = parseInt($(this).val());

        name = $(this).attr('name');
        if (valueCurrent >= minValue) {
            $(".btn-number[data-type='minus'][data-field='" + name + "']").removeAttr('disabled')
        } else {
            alert('Sorry, the minimum value was reached');
            $(this).val($(this).data('oldValue'));
        }
        if (valueCurrent <= maxValue) {
            $(".btn-number[data-type='plus'][data-field='" + name + "']").removeAttr('disabled')
        } else {
            alert('Sorry, the maximum value was reached');
            $(this).val($(this).data('oldValue'));
        }


    });
    $(".input-number").keydown(function (e) {
        // Allow: backspace, delete, tab, escape, enter and .
        if ($.inArray(e.keyCode, [46, 8, 9, 27, 13, 190]) !== -1 ||
            // Allow: Ctrl+A
            (e.keyCode == 65 && e.ctrlKey === true) ||
            // Allow: home, end, left, right
            (e.keyCode >= 35 && e.keyCode <= 39)) {
            // let it happen, don't do anything
            return;
        }
        // Ensure that it is a number and stop the keypress
        if ((e.shiftKey || (e.keyCode < 48 || e.keyCode > 57)) && (e.keyCode < 96 || e.keyCode > 105)) {
            e.preventDefault();
        }
    });
</script>
