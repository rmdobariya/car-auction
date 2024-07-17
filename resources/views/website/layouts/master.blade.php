<!DOCTYPE html>
<html>
<head>
    @php
        $logo = DB::table('site_settings')->where('setting_key','LOGO_IMG')->first()->setting_value;
        $favicon = DB::table('site_settings')->where('setting_key','FAVICON_IMG')->first()->setting_value;
    @endphp
    <meta charset="utf-8">
    <meta name="csrf-token" content="{{ csrf_token() }}"/>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{trans('web_string.zodha')}} - @yield('title')</title>
    <link rel="icon" href="{{ asset($logo)}}" type="image/x-icon">
    <link rel="shortcut icon" href="{{  asset($logo)}}"
          type="image/x-icon">
    @include('website.layouts.css')
</head>
<body class="@if(App::getLocale() == 'en') rtl @endif">
@include('website.layouts.nav')
@yield('content')
@include('website.layouts.footer')

<!-- bid Modal -->
<div class="modal fade bid-model" id="carderails" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
     aria-labelledby="carderailsLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="vehicle_detail_title"></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body" id="vehicle_detail_body">

            </div>
            <div class="modal-footer">
                <div class="row">
                    <div class="col-md-4">
                        <div class="auto-inc">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="" id="increment">
                                <label class="form-check-label" for="increment">
                                    {{trans('web_string.auto_increment_bidding')}}
                                </label>
                            </div>
                            <input type="text" name="increment-val" class="form-control"
                                   placeholder="Auto increment bid upto">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="auto-inc">
                            <div class="price-range-slider">
                                <p class="range-value">
                                    {{trans('web_string.auto_increment_of')}}
                                    <input type="text" id="incamount" readonly>
                                </p>
                                <div id="slider-incamount" class="range-bar"></div>
                            </div>
                            <input type="text" name="auto-inc" class="form-control"
                                   placeholder="Auto increment by (SAR)">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="bid-amoun">
                            <input type="text" name="bid-amo" class="form-control" placeholder="Bid amount">
                            <a href="#" class="place-bid-blue">{{trans('web_string.place_bid')}}</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<div class="modal fade bid-model" id="vehicle_bid_modal" data-bs-backdrop="static" data-bs-keyboard="false"
     tabindex="-1"
     aria-labelledby="vehicleBidLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="vehicle_bid_label">{{trans('web_string.bid_place_modal')}}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body" id="vehicle_bid_body">

            </div>
            <div class="modal-footer">

            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="payment_poof_modal" data-bs-backdrop="static" data-bs-keyboard="false"
     tabindex="-1"
     aria-labelledby="paymentProofLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="paymentProofLabel">{{trans('web_string.payment_proof_modal')}}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body" id="payment_poof_body">

            </div>
            <div class="modal-footer">

            </div>
        </div>
    </div>
</div>

<!-- Login Modal -->
<div class="modal fade login-model" id="login" data-bs-keyboard="true" tabindex="-1" aria-labelledby="loginLabel"
     aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header text-center">
                <h5 class="modal-title" id="loginLabel">{{trans('web_string.login_to_your_account')}}</h5>
                <!-- <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button> -->
            </div>
            <div class="modal-body">
                <div class="login-form">
                    <form action="" id="loginForm" method="POST">
                        <input type="email" name="email" class="form-control"
                               placeholder="{{trans('web_string.email')}}">
                        <input type="password" name="password" class="form-control"
                               placeholder="{{trans('web_string.password')}}">
                        <div class="forgotlink text-end">
                            <a href="#" id="forgot_password">{{trans('web_string.forgot_password')}}</a>
                        </div>
                        <input type="submit" class="place-bid-blue" name="submit"
                               value="{{trans('web_string.sign_in')}}">
                    </form>
                    <p>{{trans('web_string.dont_have_an_account')}} <a href="javascript:void(0)" id="closelogin"
                                                                       data-toggle="modal"
                                                                       data-target="#signup">{{trans('web_string.sign_up')}}</a>
                    </p>
                    <b>OR</b>
                    <div class="social-login">
                        <div class="facebook">
                            <a href="#" data-social-type="facebook"
                               class="socialSignIn">{{trans('web_string.sign_in_with')}} <span><i
                                        class="lab la-facebook-f"></i></span></a>
                        </div>
                        <div class="gmail">
                            <a href="#" data-social-type="google"
                               class="socialSignIn">{{trans('web_string.sign_in_with')}} <span><img
                                        src="{{asset('web/assets/images/google.png')}}" alt="google"></span></a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">

            </div>
        </div>
    </div>
</div>

<!-- Sign Up Modal -->
<div class="modal fade login-model" id="signup" data-bs-keyboard="true" tabindex="-1" aria-labelledby="loginLabel"
     aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header text-center">
                <h5 class="modal-title" id="loginLabel">{{trans('web_string.create_free_account')}}</h5>
                <!-- <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button> -->
            </div>
            <div class="modal-body">
                <div class="login-form">
                    <form action="" id="registerForm" method="POST">
                        <input type="text" name="first_name" class="form-control"
                               placeholder="{{trans('web_string.first_name')}}">
                        <input type="text" name="last_name" class="form-control"
                               placeholder="{{trans('web_string.last_name')}}">
                        <input type="text" name="phone" class="form-control integer"
                               placeholder="{{trans('web_string.mobile_no')}}.">
                        <input type="text" name="email" class="form-control"
                               placeholder="{{trans('web_string.email')}}">
                        {{--                        <input type="text" name="email" class="form-control" placeholder="Username">--}}
                        <input type="password" name="password" class="form-control"
                               placeholder="{{trans('web_string.password')}}">
                        <div class="select-opt">
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="user_type" id="buyer" value="buyer">
                                <label class="form-check-label" for="buyer">
                                    {{trans('web_string.buyer')}}
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="user_type" id="seller"
                                       value="seller">
                                <label class="form-check-label" for="seller">
                                    {{trans('web_string.seller')}}
                                </label>
                            </div>
                        </div>
                        <div class="terms-chack">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="term" name="term" id="term">
                                <label class="form-check-label" for="term">
                                    {{trans('web_string.i_have_a_read_the')}} <a
                                        href="{{route('page',['terms-conditions'])}}"
                                        target="_blank">{{trans('web_string.terms_and_conditions')}}</a>
                                </label>
                            </div>
                        </div>
                        <input type="submit" class="place-bid-blue" name="submit" value="Sign Up">
                    </form>
                    <p>{{trans('web_string.already_have_an_account')}}<a href="#" id="closesignup" data-toggle="modal"
                                                                         data-target="#login">{{trans('web_string.sign_in')}}</a>
                    </p>
                    <b>{{trans('web_string.or')}}</b>
                    <div class="social-login">
                        <div class="facebook">
                            <a href="#" data-social-type="facebook"
                               class="socialSignIn">{{trans('web_string.sign_in_with')}} <span><i
                                        class="lab la-facebook-f"></i></span></a>
                        </div>
                        <div class="gmail">
                            <a href="#" data-social-type="google"
                               class="socialSignIn">{{trans('web_string.sign_in_with')}} <span><img
                                        src="{{asset('web/assets/images/google.png')}}" alt="google"></span></a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">

            </div>
        </div>
    </div>
</div>

<div class="modal fade login-model" id="userTypeModal" data-bs-keyboard="true" tabindex="-1"
     aria-labelledby="loginLabel"
     aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header text-center">
                <h5 class="modal-title" id="loginLabel">{{trans('web_string.select_user_role')}}</h5>
            </div>
            <div class="modal-body">
                <div class="login-form">
                    <div class="select-opt">
                        <div class="form-check">
                            <input type="hidden" name="social_type" id="social_type">
                            <input class="form-check-input" type="radio" name="user_type" id="buyer" value="buyer"
                                   required>
                            <label class="form-check-label" for="buyer">
                                {{trans('web_string.buyer')}}
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="user_type" id="seller" value="seller"
                                   required>
                            <label class="form-check-label" for="seller">
                                {{trans('web_string.seller')}}
                            </label>
                        </div>
                    </div>

                    <a href="#" class="place-bid-blue" id="continue">{{trans('web_string.continue')}}</a>
                </div>
            </div>
            <div class="modal-footer">

            </div>
        </div>
    </div>
</div>

<!-- Ask a Question Modal -->
<div class="modal fade login-model" id="ask-question" data-bs-keyboard="true" tabindex="-1" aria-labelledby="loginLabel"
     aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header text-center">
                <h5 class="modal-title" id="loginLabel">{{trans('web_string.ask_a_question')}}</h5>
                <p>{{trans('web_string.please_contact_us_for')}}</p>
            </div>
            <div class="modal-body">
                <div class="login-form">
                    <form id="askQuestionForm" method="POST">
                        <div class="row">
                            <div class="col-md-6">
                                <input type="text" name="first_name" class="form-control"
                                       placeholder="{{trans('web_string.first_name')}}">
                            </div>
                            <div class="col-md-6">
                                <input type="text" name="last_name" class="form-control"
                                       placeholder="{{trans('web_string.last_name')}}">
                            </div>
                            <div class="col-md-6">
                                <input type="email" name="email" class="form-control"
                                       placeholder="{{trans('web_string.email')}}">
                            </div>
                            <div class="col-md-6">
                                <input type="text" name="mobile_no" class="form-control integer"
                                       placeholder="{{trans('web_string.mobile_no')}}">
                            </div>
                            <div class="col-md-12">
                                <textarea name="question" class="form-control" rows="4"
                                          placeholder="{{trans('web_string.comments_and_question')}}"></textarea>
                            </div>
                            <div class="col-md-12">
                                <input type="submit" class="place-bid-blue" name="submit"
                                       value="{{trans('web_string.submit')}}">
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>


<div class="modal fade login-model" id="commingsoon" data-bs-keyboard="true" tabindex="-1" aria-labelledby="loginLabel"
     aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header text-center">
                <h5 class="modal-title" id="loginLabel">{{trans('web_string.comming_soon')}}</h5>
                <p>{{trans('web_string.we_are_launching_soon')}}</p>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="forgot_password_form" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
     aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header text-center">
                <h4 class="modal-title w-100 font-weight-bold">{{trans('web_string.common_forgot_password')}}</h4>
            </div>
            <div class="modal-body mx-3">
                <div class="fv-row mb-10">
                    <div class="d-flex flex-stack mb-2">
                        <label class="form-label fw-bolder text-dark fs-6 mb-0" for="password">
                            {{trans('web_string.enter_your_email')}}
                        </label>
                    </div>
                    <div class="position-relative mb-3" data-kt-password-meter="true">
                        <input class="form-control"
                               type="email" id="forgot_email"
                               placeholder="{{trans('web_string.email')}}"
                               name="forgot_email"/>
                    </div>
                </div>
                <div class="text-center">
                    <button type="button" id="forgot_password_submit"
                            class="btn btn-lg btn-primary w-100 mb-5 place-bid-blue">
                        <span class="indicator-label">{{trans('web_string.submit')}}</span>
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="modal fade login-model" id="car_inquiry" data-bs-keyboard="true" tabindex="-1" aria-labelledby="loginLabel"
     aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header text-center">
                <h4 class="modal-title w-100 font-weight-bold">{{trans('web_string.vehicle_inquiry')}}</h4>
            </div>
            <div class="modal-body">
                <div class="login-form" id="car_inquiry_body">

                </div>
            </div>

        </div>
    </div>
</div>
<div class="modal fade" id="change_password" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
     aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header text-center">
                <h4 class="modal-title w-100 font-weight-bold">{{trans('web_string.change_password')}}</h4>
            </div>
            <div class="modal-body">
                <div class="login-form">
                    <form id="changePasswordForm" method="POST">
                        <div class="row">
                            <div class="col-md-12 mb-2">
                                <label for="new_password">{{trans('web_string.current_password')}}</label>
                                <input type="password" name="current_password" class="form-control"
                                       placeholder="{{trans('web_string.current_password')}}">
                            </div>
                            <div class="col-md-12 mb-2">
                                <label for="new_password">{{trans('web_string.new_password')}}</label>
                                <input type="password" name="new_password" class="form-control"
                                       placeholder="{{trans('web_string.new_password')}}">
                            </div>
                            <div class="col-md-12 mb-2">
                                <label for="new_password">{{trans('web_string.confirm_password')}}</label>
                                <input type="password" name="confirm_password" class="form-control"
                                       placeholder="{{trans('web_string.confirm_password')}}">
                            </div>
                            <div class="col-md-12">
                                <input type="submit" class="place-bid-blue" name="submit" value="Submit">
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@include('website.layouts.script')
@yield('custom-script')
<script>
    $(document).on('click', '.socialSignIn', function () {
        console.log(1213)
        $('#userTypeModal').modal('show')
        var social_type = $(this).data('social-type');
        $('#social_type').val(social_type)
    })
    $(document).on('click', '#continue', function () {
        if ($('input[name="user_type"]:checked')) {
            window.location.href = 'socialLogin/' + [$('#social_type').val()] + '/?user_type=' + [$('input[name="user_type"]:checked').val()];
        } else {
            notificationToast('User Type Is Required', 'warning')
        }
    })
    $(document).on('click', '.language-change', function () {
        let code = $('#flexSwitchCheckDefault').val()
        console.log(code)
        window.location = APP_URL + '/language/' + code
    })
</script>
<script src="{{URL::asset('web/assets/custom/login.js')}}?v={{ time() }}"></script>
</body>
</html>

