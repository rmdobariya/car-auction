<div class="login-form">
    <form id="paymentProofForm" method="POST">
        <input type="hidden" name="vehicle_id" class="form-control" value="{{$vehicle->id}}">

                <div class="mb-3 mt-3 col-md-12">
                    <div class="fv-row mb-7 fv-plugins-icon-container">
                        <label class="required fs-6 fw-bold mb-2" for="year">
                            {{trans('web_string.payment_proof')}}
                        </label>
                        <input type="file" class="form-control form-control-solid"  accept="image/jpeg, image/jpg, image/png"
                               name="payment_proof" required
                               placeholder="{{trans('web_string.payment_proof')}}"/>
                    </div>
                </div>

        <div class="row">
            <div class="col-md-12">
                <input type="submit" class="place-bid-blue" name="submit" value="{{trans('web_string.submit')}}">
            </div>
        </div>

    </form>
</div>

<script>
    var $paymentProofForm = $('#paymentProofForm')
    $paymentProofForm.on('submit', function (e) {
        e.preventDefault()
        loaderView();
        let formData = new FormData($paymentProofForm[0]);
        axios
            .post(APP_URL + '/payment-proof-store', formData)
            .then(function (response) {
                $paymentProofForm[0].reset();
                loaderHide();
                if (response.data.success == true) {
                    $('#payment_poof_modal').modal('hide')
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
