<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Zodha</title>
    @include('website.layouts.css')
</head>
<body>
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
                                    Auto Increment Bidding
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
                                    Auto increment of
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
                            <a href="#" class="place-bid-blue">Place Bid</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<div class="modal fade bid-model" id="vehicle_bid_modal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
     aria-labelledby="vehicleBidLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="vehicle_bid_label">Bid Place Modal</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body" id="vehicle_bid_body">

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
                <h5 class="modal-title" id="loginLabel">Login to Your Account</h5>
                <!-- <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button> -->
            </div>
            <div class="modal-body">
                <div class="login-form">
                    <form action="" id="loginForm" method="POST">
                        <input type="email" name="email" class="form-control" placeholder="Email">
                        <input type="password" name="password" class="form-control" placeholder="Password">
                        <div class="forgotlink text-end">
                            <a href="#" id="forgot_password">Forgot User ID/Password</a>
                        </div>
                        <input type="submit" class="place-bid-blue" name="submit" value="Sign In">
                    </form>
                    <p>Don’t have an account? <a href="javascript:void(0)" id="closelogin" data-toggle="modal"
                                                 data-target="#signup">Sign Up</a></p>
                    <b>OR</b>
                    <div class="social-login">
                        <div class="facebook">
                            <a href="{{route('socialLogin',['facebook'])}}">Sign in with <span><i class="lab la-facebook-f"></i></span></a>
                        </div>
                        <div class="gmail">
                            <a href="{{route('socialLogin',['google'])}}">Sign in with <span><img src="{{asset('web/assets/images/google.png')}}" alt="google"></span></a>
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
                <h5 class="modal-title" id="loginLabel">Create Free Account</h5>
                <!-- <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button> -->
            </div>
            <div class="modal-body">
                <div class="login-form">
                    <form action="" id="registerForm" method="POST">
                        <input type="text" name="first_name" class="form-control" placeholder="First Name">
                        <input type="text" name="last_name" class="form-control" placeholder="Last Name">
                        <input type="text" name="phone" class="form-control integer" placeholder="Mobile No.">
                        <input type="text" name="email" class="form-control" placeholder="Email">
{{--                        <input type="text" name="email" class="form-control" placeholder="Username">--}}
                        <input type="password" name="password" class="form-control" placeholder="Password">
                        <div class="select-opt">
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="user_type" id="buyer" value="buyer">
                                <label class="form-check-label" for="buyer">
                                    Buyer
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="user_type" id="seller" value="seller">
                                <label class="form-check-label" for="seller">
                                    Seller
                                </label>
                            </div>
                        </div>
                        <div class="terms-chack">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="term" name="term" id="term">
                                <label class="form-check-label" for="term">
                                    I have read the <a href="{{route('page',['terms-conditions'])}}" target="_blank">Term & Conditions</a>
                                </label>
                            </div>
                        </div>
                        <input type="submit" class="place-bid-blue" name="submit" value="Sign Up">
                    </form>
                    <p>Already have an account? <a href="#" id="closesignup" data-toggle="modal" data-target="#login">Sign
                            In</a></p>
                    <b>OR</b>
                    <div class="social-login">
                        <div class="facebook">
                            <a href="{{route('socialLogin',['facebook'])}}">Sign in with <span><i class="lab la-facebook-f"></i></span></a>
                        </div>
                        <div class="gmail">
                            <a href="{{route('socialLogin',['google'])}}">Sign in with <span><img src="{{asset('web/assets/images/google.png')}}" alt="google"></span></a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">

            </div>
        </div>
    </div>
</div>

<!-- Ask a Question Modal -->
<div class="modal fade login-model" id="ask-question" data-bs-keyboard="true" tabindex="-1" aria-labelledby="loginLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header text-center">
                <h5 class="modal-title" id="loginLabel">Ask a Question</h5>
                <p>Please contact us for specific reasons</p>
            </div>
            <div class="modal-body">
                <div class="login-form">
                    <form action="" method="POST">
                        <div class="row">
                            <div class="col-md-6">
                                <input type="text" name="fname" class="form-control" placeholder="First Name *">
                            </div>
                            <div class="col-md-6">
                                <input type="text" name="lname" class="form-control" placeholder="Last Name *">
                            </div>
                            <div class="col-md-12">
                                <input type="email" name="email" class="form-control" placeholder="Email *">
                            </div>
                            <div class="col-md-12">
                                <textarea name="questions" class="form-control" rows="4" placeholder="Comments and Questions *"></textarea>
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


<div class="modal fade login-model" id="commingsoon" data-bs-keyboard="true" tabindex="-1" aria-labelledby="loginLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header text-center">
                <h5 class="modal-title" id="loginLabel">Coming Soon...</h5>
                <p>We are launching soon. We are working hard. We are almost ready to launch. Something awesome is coming soon.</p>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="forgot_password_form" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
     aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header text-center">
                <h4 class="modal-title w-100 font-weight-bold">Forgot Password</h4>
            </div>
            <div class="modal-body mx-3">
                <div class="fv-row mb-10">
                    <div class="d-flex flex-stack mb-2">
                        <label class="form-label fw-bolder text-dark fs-6 mb-0" for="password">
                            Enter Your Email
                        </label>
                    </div>
                    <div class="position-relative mb-3" data-kt-password-meter="true">
                        <input class="form-control form-control-lg form-control-solid"
                               type="email" id="forgot_email"
                               placeholder="Email"
                               name="forgot_email"/>
                    </div>
                </div>
                <div class="text-center">
                    <button type="button" id="forgot_password_submit" class="btn btn-lg btn-primary w-100 mb-5">
                        <span class="indicator-label">Submit</span>
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
                <h4 class="modal-title w-100 font-weight-bold">Vehicle Inquiry</h4>
            </div>
            <div class="modal-body">
                <div class="login-form" id="car_inquiry_body">

                </div>
            </div>

        </div>
    </div>
</div>
@include('website.layouts.script')
@yield('custom-script')
<script src="{{URL::asset('web/assets/custom/login.js')}}?v={{ time() }}"></script>
</body>
</html>

