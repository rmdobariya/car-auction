<script src="{{asset('web/assets/js/jquery-3.6.3.min.js')}}"></script>
<script src="{{asset('web/assets/js/bootstrap.min.js')}}"></script>
<script src="{{ asset('assets/plugins/global/plugins.bundle.js') }}"></script>
<script src="{{ asset('assets/js/scripts.bundle.js') }}"></script>
<script src='https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.0/jquery-ui.min.js'></script>
<script src='https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.js'></script>
<script src='https://unpkg.com/swiper@6.5.4/swiper-bundle.min.js'></script>
<script src="{{asset('web/assets/js/script.js')}}"></script>
<script src="{{asset('web/assets/js/countdown.js')}}"></script>
<script src="{{ asset('assets/plugins/parsley-js/parsley.min.js') }}"></script>
<script src="{{ asset('assets/plugins/parsley-js/en.js') }}"></script>
<script src="{{ asset('assets/plugins/blockUI/blockUI.js') }}"></script>
<script src="{{ asset('assets/plugins/axios/axios.min.js') }}"></script>
<script src="{{asset('web/assets/custom/custom.js')}}?v={{time()}}"></script>
<script>
    $("input[type=checkbox]").change(function () {
        $(this).parent().toggleClass("chked");
    });
    $("input[type=radio]").change(function() {
        $('.form-check').removeClass("chked");
        $(this).parent().toggleClass("chked");
    });

    $("#closelogin").click(function () {
        $("#login").modal("hide");
        $("#signup").modal("show");
        $("body").addClass("modal-open");
    });
    $("#closesignup").click(function () {
        $("#signup").modal("hide");
        $("#login").modal("show");
        $("body").addClass("modal-open");
    });

    var APP_URL = {!! json_encode(url('/')) !!};
    var JS_URL = '{{url('/')}}'
</script>
