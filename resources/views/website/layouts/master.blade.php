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
    <meta name="google-site-verification" content="feVEzgHG9dtO4yAkoq9u1HGmuqVa-Qof6P-A1CB9oe4" />
    <title>{{trans('web_string.zodha')}} - @yield('title')</title>
    <link rel="icon" href="{{ asset($logo)}}" type="image/x-icon">
    <link rel="shortcut icon" href="{{  asset($logo)}}"
          type="image/x-icon">
    @include('website.layouts.css')
</head>
<body class="@if(App::getLocale() == 'en') rtl @endif">
@if(session('warning'))
    <div class="alert alert-warning" style="position: fixed;width:100%; z-index: 9999; margin: 10px 0; padding: 10px; background-color: #ffc107; color: #212529; border-radius: 5px;">
        {{ session('warning') }}
    </div>
@endif

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

<div class="modal fade bid-model" id="carForSellDerails" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
     aria-labelledby="carForSellDerailsLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="carForSellDerailsTitle"></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body" id="carForSellDerailsBody">

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

<div class="modal fade bid-model" id="payment_poof_modal" data-bs-backdrop="static" data-bs-keyboard="false"
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

<div class="modal fade bid-model" id="review_ratting_modal" data-bs-backdrop="static" data-bs-keyboard="false"
     tabindex="-1"
     aria-labelledby="reviewRattingLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="reviewRattingLabel">{{trans('web_string.review_ratting')}}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="login-form">
                    @php
                        if(!is_null(Auth::user())){
                            $reviews = DB::table('reviews')->where('user_id',Auth::user()->id)->first();
                        }else{
                            $reviews = null;
                        }
                    @endphp
                    @if(!is_null($reviews))
                        <form id="reviewRattingForm" method="POST">
                            @csrf
                            <input type="hidden" name="edit_value" value="{{ $reviews->id }}">
                            <input type="hidden" name="user_id" id="review_user_id" class="form-control" value="">
                            <div class="container">
                                <div class="row mb-3">
                                    <div class="col-md-12">
                                        <label>{{trans('web_string.review')}}</label>
                                        <textarea type="text" name="review" id="review" class="form-control"
                                                  placeholder="{{trans('web_string.review')}}"
                                                  readonly>{{$reviews->review}}</textarea>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <p>{{trans('web_string.ratting')}} </p>
                                        <div class="rated">
                                            @for($i=1; $i<=$reviews->rating; $i++)
                                                <label class="star-rating-complete" title="text">{{$i}}
                                                    stars</label>
                                            @endfor
                                        </div>
                                    </div>
                                </div>
                                {{--                                <div class="row">--}}
                                {{--                                    <div class="col-md-12">--}}
                                {{--                                        <input type="submit" class="place-bid-blue" name="submit"--}}
                                {{--                                               value="{{trans('web_string.submit')}}">--}}
                                {{--                                    </div>--}}
                                {{--                                </div>--}}
                            </div>
                        </form>
                    @else
                        <div class="row">
                            <div class="col mt-4">
                                <form id="reviewRattingForm" method="POST">
                                    @csrf
                                    <input type="hidden" name="edit_value" value="0">
                                    <input type="hidden" name="user_id" id="review_user_id" class="form-control"
                                           value="">
                                    <div class="row mb-3">
                                        <div class="col-md-12">
                                            <label>{{trans('web_string.review')}} </label>
                                            <textarea type="text" name="review" id="review" class="form-control"
                                                      placeholder="{{trans('web_string.review')}}"></textarea>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <p>{{trans('web_string.ratting')}}</p>
                                        <div class="col-md-12">
                                            <div class="rate">
                                                <input type="radio" id="star5" class="rate" name="rating" value="5"/>
                                                <label for="star5" title="text">5 stars</label>
                                                <input type="radio" checked id="star4" class="rate" name="rating"
                                                       value="4"/>
                                                <label for="star4" title="text">4 stars</label>
                                                <input type="radio" id="star3" class="rate" name="rating" value="3"/>
                                                <label for="star3" title="text">3 stars</label>
                                                <input type="radio" id="star2" class="rate" name="rating" value="2">
                                                <label for="star2" title="text">2 stars</label>
                                                <input type="radio" id="star1" class="rate" name="rating" value="1"/>
                                                <label for="star1" title="text">1 star</label>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-12">
                                            <input type="submit" class="place-bid-blue" name="submit"
                                                   value="{{trans('web_string.submit')}}">
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    @endif
                    {{--                        <div class="row mb-3">--}}
                    {{--                            <div class="col-md-12">--}}
                    {{--                                <textarea type="text" name="review" id="review" class="form-control"--}}
                    {{--                                          placeholder="{{trans('web_string.review')}}"></textarea>--}}
                    {{--                            </div>--}}
                    {{--                        </div>--}}
                    {{--                        <div class="row">--}}
                    {{--                            <div class="col-md-12">--}}
                    {{--                                <input type="submit" class="place-bid-blue" name="submit"--}}
                    {{--                                       value="{{trans('web_string.submit')}}">--}}
                    {{--                            </div>--}}
                    {{--                        </div>--}}
                    {{--                    </form>--}}
                </div>
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

                        <div class="input-group mb-3">
                            <input type="email" name="email" class="form-control" id="login_email" value="{{Session::get('login_email')}}"
                                   placeholder="{{trans('web_string.email')}}">
                            <div class="input-group-prepend">

                            </div>
                        </div>
                        <input type="password" name="password" class="form-control"
                               placeholder="{{trans('web_string.password')}}">
                        <div class="col-12 @if(!Session::has('login_otp') || Session::get('login_otp') == '') d-none @endif"
                             id="login_otp_part">
                            <input type="text" class="form-control" name="login_otp" id="login_otp" placeholder="OTP">
                        </div>
                        <div class="forgotlink text-end">
                            <a href="#" id="forgot_password">{{trans('web_string.forgot_password')}}</a>
                        </div>

                        <input class="place-bid-blue @if(Session::has('otp') || Session::get('otp') != '') d-none @endif" type="button" id="login_contact_verify" value="{{trans('web_string.sign_in')}}">
                        <input type="submit" class="place-bid-blue @if(!Session::has('otp') || Session::get('otp') == '') d-none @endif" id="login_btn" name="submit" value="{{trans('web_string.sign_in')}}" >
{{--                        <input type="submit" class="place-bid-blue" name="submit" id="login_btn"--}}
{{--                               value="{{trans('web_string.sign_in')}}" @if(!Session::has('login_otp') || Session::get('login_otp') == '') disabled @endif>--}}
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
{{--                        <input type="text" name="phone" class="form-control integer"--}}
{{--                               placeholder="{{trans('web_string.mobile_no')}}.">--}}
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text">+966</span> <!-- Update the country code as needed -->
                            </div>
                            <input type="text" name="phone" value="{{Session::get('contact_no')}}" class="form-control integer" placeholder="{{trans('web_string.mobile_no')}}" id="contact_no" @if(Session::has('contact_no') || Session::has('otp')) readonly @endif>
{{--                            <div class="input-group-prepend">--}}
{{--                                <button class="btn btn-primary" type="button" id="contact_verify"--}}
{{--                                        @if(Session::has('otp') || Session::get('otp') != '') disabled @endif>Verify--}}
{{--                                </button>--}}
{{--                            </div>--}}
                        </div>
                        <input type="text" name="email" class="form-control"
                               placeholder="{{trans('web_string.email')}}">
                        {{--                        <input type="text" name="email" class="form-control" placeholder="Username">--}}
                        <input type="password" name="password" class="form-control"
                               placeholder="{{trans('web_string.password')}}">
                        <div class="col-12 @if(!Session::has('otp') || Session::get('otp') == '') d-none @endif"
                             id="otp_part">
                                <input type="text" class="form-control" name="otp" id="otp" placeholder="OTP">
                        </div>
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
                        <input class="place-bid-blue @if(Session::has('otp') || Session::get('otp') != '') d-none @endif" type="button" id="contact_verify" value="Sign Up">
                        <input type="submit" class="place-bid-blue @if(!Session::has('otp') || Session::get('otp') == '') d-none @endif" id="sign_up_btn" name="submit" value="Sign Up" >
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
    $('#contact_verify').on('click', function (e) {
        e.preventDefault()
        let contact_no = $('#contact_no').val()
        console.log(contact_no)
        if (contact_no === '') {
            notificationToast('Please Enter Contact No', 'warning')
            return false
        }
        loaderView()
        axios
            .post(APP_URL + '/send-otp', {
                contact_no: contact_no,
            })
            .then(function (response) {
                $('#contact_no').prop('readonly',true)
                $('#otp_part').removeClass('d-none')
                $('#contact_verify').addClass('d-none')
                $('#sign_up_btn').removeClass('d-none')
                loaderHide()
                notificationToast(response.data.message, 'success')
            })
            .catch(function (error) {
                notificationToast(error.response.data.message, 'warning')
                loaderHide()
            })
    })
    $('#login_contact_verify').on('click', function (e) {
        e.preventDefault()
        let login_email = $('#login_email').val()
        if (login_email === '') {
            notificationToast('Please Enter Email', 'warning')
            return false
        }
        loaderView()
        axios
            .post(APP_URL + '/login-send-otp', {
                email: login_email,
            })
            .then(function (response) {
                $('#login_email').prop('readonly',true)
                $('#login_otp_part').removeClass('d-none')
                $('#login_contact_verify').addClass('d-none')
                $('#login_btn').removeClass('d-none')
                loaderHide()
                notificationToast(response.data.message, 'success')
            })
            .catch(function (error) {
                notificationToast(error.response.data.message, 'warning')
                loaderHide()
            })
    })

    $(document).on('click', '.socialSignIn', function () {
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

