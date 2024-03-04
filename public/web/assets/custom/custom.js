function funTooltip() {
    $('[data-toggle="tooltip"]').tooltip()
}

function notificationToast(message, type) {
    if (type === 'success') {
        toastr.success(message)
    } else if (type === 'warning') {
        toastr.error(message)

    }
}

function floatOnly() {
    $('.float').keypress(function (event) {
        if ((event.which !== 46 || $(this).val().indexOf('.') !== -1) && (event.which < 48 || event.which > 57)) {
            event.preventDefault();
        }
    });
}

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
$('.float').keypress(function (event) {
    if ((event.which !== 46 || $(this).val().indexOf('.') !== -1) && (event.which < 48 || event.which > 57)) {
        event.preventDefault();
    }
});

function loaderView() {
    $.blockUI({
        message: '<div class="spinner-border text-info" role="status"><span class="sr-only">Loading...</span></div>',
        css: {
            padding: 0,
            margin: 0,
            width: "25%",
            top: "40%",
            left: "35%",
            textAlign: "center",
            color: "#000",
            border: "none",
            backgroundColor: "transparent",
            cursor: "wait",
            "z-index": "99999999"
        }
    });
    $(".blockOverlay").css('z-index', 99999999999)
}

function loaderHide() {
    setTimeout(function () {
        $.unblockUI();
    }, 100)
}

$(document).on('click', '.edit-button', function () {
    window.location.href = $(this).data('href');
})

//$('.select2').select2();


function funDataTableCheck(class_name) {
    const $class_name = $('.' + class_name);
    const $table_head = $('#table_head');
    const $table_foot = $('#table_foot');

    $table_head.change(function () {
        if (this.checked) {
            $class_name.prop('checked', true);
            $table_foot.prop('checked', true);
        } else {
            $class_name.prop('checked', false);
            $table_foot.prop('checked', false);
        }
    });

    $table_foot.change(function () {
        if (this.checked) {
            $class_name.prop('checked', true);
            $table_head.prop('checked', true);
        } else {
            $class_name.prop('checked', false);
            $table_head.prop('checked', false);
        }
    });

    $class_name.change(function () {
        if (this.checked) {
            if ($class_name.filter(":checked").length === $class_name.length) {
                $table_head.prop('checked', true);
                $table_foot.prop('checked', true);
            }
        } else {
            $table_head.prop('checked', false);
            $table_foot.prop('checked', false);
        }
    });
}

function funDataTableUnCheck(class_name) {
    const $class_name = $('.' + class_name);
    const $table_head = $('#table_head');
    const $table_foot = $('#table_foot');
    $class_name.prop('checked', false);
    $table_head.prop('checked', false);
    $table_foot.prop('checked', false);
}

feather.replace()

const $clock_picker = $('.clock-picker')
const $date_picker = $('.date-picker')
if ($clock_picker.length > 0) {
    $clock_picker.flatpickr({
        enableTime: true,
        noCalendar: true,
        dateFormat: 'H:i',
        time_24hr: true
    })
}
if ($date_picker.length > 0) {
    $date_picker.flatpickr({
        enableTime: false,
        minDate: "today",
        dateFormat: 'Y-m-d'
    })
}

$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
})
$('#filterData').on('click', function () {
    // var condition = $("input[type='radio'][name='condition']:checked").val();
    var category = $('#category').val();
    var min_amount = $('#min_amount').val();
    var max_amount = $('#max_amount').val();
    var price_range = $('#amount').val();
    var model = $('#model').val();
    var make = $('#make').val();
    var body_type = $('#body_type').val();
    var ratting = $('#ratings').val();
    var city = $('#city').val();
    var exterior = $.map($('input[name="exterior"]:checked'), function (c) {
        return c.value;
    })
    window.location.href = '/filter?category=' + category + '&price_range=' + price_range + '&min_amount=' + min_amount + '&max_amount=' + max_amount +
        '&model=' + model + '&make=' + make + '&body_type=' + body_type + '&exterior=' + exterior + '&ratting=' + ratting + '&city=' + city;

})
$('#seller_filterData').on('click', function () {
    // var condition = $("input[type='radio'][name='condition']:checked").val();
    var category = $('#category').val();
    var min_amount = $('#min_amount').val();
    var max_amount = $('#max_amount').val();
    var price_range = $('#amount').val();
    var model = $('#model').val();
    var make = $('#make').val();
    var user_id = $('#user_id').val();
    var encrypt_user_id = $('#encrypt_user_id').val();
    var body_type = $('#body_type').val();
    var ratting = $('#ratings').val();
    var city = $('#city').val();
    var exterior = $.map($('input[name="exterior"]:checked'), function (c) {
        return c.value;
    })
    window.location.href = '/seller/' + encrypt_user_id + '?' + 'category=' + category + '&price_range=' + price_range + '&min_amount=' + min_amount + '&max_amount=' + max_amount +
        '&model=' + model + '&make=' + make + '&body_type=' + body_type + '&exterior=' + exterior + '&ratting=' + ratting + '&city=' + city;

})
let $askQuestionForm = $('#askQuestionForm')
$askQuestionForm.on('submit', function (e) {
    e.preventDefault()
    loaderView();
    let formData = new FormData($askQuestionForm[0]);
    axios
        .post(APP_URL + '/add-question-store', formData)
        .then(function (response) {
            $askQuestionForm[0].reset();
            loaderHide();
            $('#ask-question').modal('hide')
            window.location.reload()
            notificationToast(response.data.message, 'success');
        })
        .catch(function (error) {
            console.log(error);
            notificationToast(error.response.data.message, 'warning')
            loaderHide();
        });
})

$('#home_category').on('change', function () {
    // var condition = $("input[type='radio'][name='condition']:checked").val();
    var category = $('#home_category').val();
    if (category === 'all') {
        window.location.href = '/';
    } else {
        var min_amount = $('#min_amount').val();
        var max_amount = $('#max_amount').val();
        var price_range = $('#amount').val();
        var model = $('#model').val();
        var make = $('#make').val();
        var body_type = $('#body_type').val();
        var ratting = $('#ratings').val();
        var city = $('#city').val();
        var exterior = $.map($('input[name="exterior"]:checked'), function (c) {
            return c.value;
        })
        window.location.href = '/filter?category=' + category + '&price_range=' + price_range + '&min_amount=' + min_amount + '&max_amount=' + max_amount +
            '&model=' + model + '&make=' + make + '&body_type=' + body_type + '&exterior=' + exterior + '&ratting=' + ratting + '&city=' + city;

    }

})



