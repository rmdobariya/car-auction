<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="csrf-token" content="{{ csrf_token() }}"/>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{trans('web_string.zodha')}} -  {{trans('web_string.common_forgot_password')}}</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@100;300;400;500;700;900&display=swap"
          rel="stylesheet">
    <link href="{{ asset('assets/plugins/global/plugins.bundle.css') }}" rel="stylesheet" type="text/css"/>
    <link rel="stylesheet"
          href="https://maxst.icons8.com/vue-static/landings/line-awesome/line-awesome/1.3.0/css/line-awesome.min.css">
    <link rel='stylesheet' href='https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css'>
    <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick-theme.css'>
    <link rel='stylesheet' href='https://unpkg.com/swiper@6.5.4/swiper-bundle.min.css'>
    <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.css'>
    <link rel="stylesheet" type="text/css" href="{{asset('web/assets/css/bootstrap.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('web/assets/css/style.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('web/assets/css/custom.css')}}?v={{time()}}">
    <script src="https://unpkg.com/feather-icons"></script>

</head>
<body>
<nav class="navbar navbar-expand-lg navbar-light fixed-top main-nav">
    <div class="container">
        <!-- <a class="navbar-brand" href="#">Navbar</a> -->
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
                aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        @php
            $footer_email = DB::table('site_settings')->where('setting_key','FROM_EMAIL')->first()->setting_value;
           $contact_no = DB::table('site_settings')->where('setting_key','WHATSAPP_NUMBER')->first()->setting_value;
              $app_store_link = DB::table('site_settings')->where('setting_key','APP_STORE_LINK')->first()->setting_value;
               $play_store_link = DB::table('site_settings')->where('setting_key','PLAY_STORE_LINK')->first()->setting_value;
        @endphp
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link" href="tel:{{$contact_no}}"><span>{{trans('web_string.toll_free')}}:</span> {{$contact_no}}</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="mailto:{{$footer_email}}"><span>{{trans('web_string.email')}}:</span> {{$footer_email}}</a>
                </li>
            </ul>
        </div>
    </div>
</nav>

<section id="hero">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="heading">
                    <h1>{{trans('web_string.online_auto_auction')}}</h1>
                    <p>{{trans('web_string.featuring_thousands_of')}}</p>
                </div>
            </div>
            <div class="col-md-6 col-lg-4">
                <div class="steps-box">
                    <h4>{{trans('web_string.register')}}</h4>
                    <p>{{trans('web_string.sign_up_for_a')}}</p>
                    <span>1</span>
                </div>
            </div>
            <div class="clearfix"></div>
            <div class="col-md-6 col-lg-4">
                <div class="steps-box">
                    <h4>{{trans('web_string.find')}}</h4>
                    <p>{{trans('web_string.search_out_range')}}</p>
                    <span>2</span>
                </div>
            </div>
            <div class="clearfix"></div>
            <div class="col-md-6 col-lg-4">
                <div class="steps-box">
                    <h4>{{trans('web_string.bid')}}</h4>
                    <p>{{trans('web_string.bid_in_our_online')}}</p>
                    <span>3</span>
                </div>
            </div>
            <div class="col-lg-2 col-md-3 offset-md-3 offset-lg-6">
                <div class="download-app text-center">
                    <a href="{{$app_store_link}}" target="_blank">
                        <img src="{{asset('web/assets/images/app-store.png')}}"></a>
                    <a href="{{$play_store_link}}" target="_blank">
                        <img src="{{asset('web/assets/images/google-play.png')}}"></a>
                    <p>{{trans('web_string.download_now')}}</p>
                </div>
            </div>
        </div>
    </div>
</section>

<section id="contact_us">
    <div class="container">
        <div class="row" id="contatti">
            <div class="container">
                <div class="row">
                    <h2 class="text-uppercase font-weight-bold text-dark">{{trans('web_string.common_forgot_password')}}</h2>
                    <form id="addEditForm">
                        <input type="hidden" id="email" value="{{ $email }}"
                               name="email">

                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <input type="password" class="form-control mt-2" name="new_password"
                                           placeholder="{{trans('web_string.new_password')}}">
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <input type="password" class="form-control mt-2" name="confirm_password"
                                           placeholder="{{trans('web_string.confirm_password')}}">
                                </div>
                            </div>

                            <div class="col-12 mt-2">
                                <button class="place-bid-blue" type="submit">{{trans('web_string.submit')}}</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
<footer>
    <div class="container">
        <div class="row">
            <div class="col-md-2">
                <div class="f-logo">
                    <img src="{{asset('web/assets/images/logo.svg')}}" alt="logo">
                </div>
            </div>
            @php
                $footer_email = DB::table('site_settings')->where('setting_key','FROM_EMAIL')->first()->setting_value;
               $contact_no = DB::table('site_settings')->where('setting_key','WHATSAPP_NUMBER')->first()->setting_value;
               $app_store_link = DB::table('site_settings')->where('setting_key','APP_STORE_LINK')->first()->setting_value;
               $play_store_link = DB::table('site_settings')->where('setting_key','PLAY_STORE_LINK')->first()->setting_value;
            @endphp
            <div class="col-md-10">
                <div class="f-link">
                    <div class="link">
                        <p>{{trans('web_string.download_now')}}</p>
                        <a href="{{$play_store_link}}" target="_blank"
                            {{--                       data-bs-toggle="modal" data-bs-target="#commingsoon"--}}
                        >
                            <img src="{{asset('web/assets/images/google-play.png')}}" alt="google-play"></a>
                    </div>
                    <div class="link">
                        <a href="{{$app_store_link}}" target="_blank"
                            {{--                       data-bs-toggle="modal" data-bs-target="#commingsoon"--}}
                        >
                            <img src="{{asset('web/assets/images/app-store.png')}}" alt="app-store"></a>
                    </div>
                    <div class="link">
                        <span>{{trans('web_string.inquiry')}}: <a href="mailto:{{$footer_email}}">{{$footer_email}}</a></span>
                    </div>
                    <div class="link">
                        <span>{{trans('web_string.support')}}: <a href="mailto:{{$footer_email}}">{{$footer_email}}</a></span>
                    </div>
                    <div class="link">
                        <span>{{trans('web_string.phone')}}: <a href="tel:{{$contact_no}}">{{$contact_no}}</a></span>
                    </div>
                </div>
                <hr>
                <div class="copyright">
                    <div class="copy">
                        <p>{{trans('web_string.copyright')}} © {{date('Y')}} {{trans('web_string.all_right_reserved')}}.</p>
                    </div>
                    <div class="pagelink">
                        <a href="{{route('page',['terms-conditions'])}}">{{trans('web_string.terms_and_conditions')}}</a>
                        <a href="{{route('page',['privacy-policy'])}}">{{trans('web_string.privacy_policy')}}</a>
                        <a href="{{route('page',['cookie-policy'])}}">{{trans('web_string.cookies_policy')}}</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</footer>


<script src="{{asset('web/assets/js/jquery-3.6.3.min.js')}}"></script>
<script src="{{asset('web/assets/js/bootstrap.min.js')}}"></script>
<script src="{{ asset('assets/plugins/global/plugins.bundle.js') }}"></script>
<script src="{{ asset('assets/js/scripts.bundle.js') }}"></script>
<script src='https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.0/jquery-ui.min.js'></script>
<script src='https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.js'></script>
<script src='https://unpkg.com/swiper@6.5.4/swiper-bundle.min.js'></script>
{{--<script src="{{asset('web/assets/js/script.js')}}"></script>--}}
<script src="{{asset('web/assets/js/countdown.js')}}"></script>
<script src="{{ asset('assets/plugins/parsley-js/parsley.min.js') }}"></script>
<script src="{{ asset('assets/plugins/parsley-js/en.js') }}"></script>
<script src="{{ asset('assets/plugins/blockUI/blockUI.js') }}"></script>
<script src="{{ asset('assets/plugins/axios/axios.min.js') }}"></script>
<script src="{{asset('web/assets/custom/custom.js')}}?v={{time()}}"></script>
<script src="{{URL::asset('web/assets/custom/login.js')}}?v={{ time() }}"></script>


<script>
    var APP_URL = {!! json_encode(url('/')) !!};
    var redirect_url = '/'
    $("input[type=checkbox]").change(function () {
        $(this).parent().toggleClass("chked");
    });
    $("input[type=radio]").change(function () {
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

    $('html, body').animate({
        scrollTop: $('#contact_us').offset().top - 20
    }, 'slow');
</script>


</body>
</html>



