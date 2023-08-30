@extends('admin.layouts2.authentication.master')
@section('title', 'Login')
@section('content')
    <div class="d-flex flex-column flex-root">
        <div class="d-flex flex-column flex-lg-row flex-column-fluid">
            <div class="d-flex flex-column flex-lg-row-auto w-xl-600px positon-xl-relative"
                 style="background-image: linear-gradient(315deg, #FF5757 0%, #FF5757 74%);">
                <div class="d-flex flex-column position-xl-fixed top-0 bottom-0 w-xl-600px scroll-y">
                    <div class="d-flex flex-row-fluid flex-column text-center p-10 pt-lg-20 justify-content-center">
                        <a class="py-9 mb-5">
                            <img alt="Logo" src="{{ asset('assets/media/logos/default.svg') }}" class="h-100px"/>
                        </a>
                    </div>
                </div>
            </div>
            <div class="d-flex flex-column flex-lg-row-fluid py-10">
                <div class="d-flex flex-center flex-column flex-column-fluid">
                    <div class="w-lg-500px p-10 p-lg-15 mx-auto">
                        <form id="addEditForm">
                            @csrf
                            <div class="text-center mb-10">
                                <h1 class="text-dark mb-3">Sign in to Admin Panel</h1>
                            </div>
                            <div class="fv-row mb-10">
                                <label class="form-label fs-6 fw-bolder text-dark"
                                       for="email">Email</label>

                                <input class="form-control form-control-lg form-control-solid"
                                       name="email" type="email"
                                       placeholder="Email"
                                       id="email" autocomplete="off"/>
                            </div>

                            <div class="fv-row mb-10">
                                <div class="d-flex flex-stack mb-2">
                                    <label class="form-label fw-bolder text-dark fs-6 mb-0" for="password">
                                        Password
                                    </label>
                                    <a href="#forgot_password" id="forgot_password" class="link-primary fs-6 fw-bolder">Forgot
                                        Password ?</a>
                                </div>
                                <div class="position-relative mb-3" data-kt-password-meter="true">
                                    <input class="form-control form-control-lg form-control-solid"
                                           type="password" id="password"
                                           placeholder="Password"
                                           name="password" autocomplete="off"/>

                                    <span
                                        class="btn btn-sm btn-icon position-absolute translate-middle top-50 end-0 me-n2"
                                        data-kt-password-meter-control="visibility">
                                        <i class="bi bi-eye-slash fs-2"></i>
                                        <i class="bi bi-eye fs-2 d-none"></i>
                                    </span>
                                </div>
                            </div>
                            <div class="text-center">
                                <button type="submit" class="btn btn-lg btn-primary w-100 mb-5">
                                    <span class="indicator-label">Login</span>
                                </button>
                            </div>
                        </form>
                    </div>
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
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
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
@endsection
@section('custom-script')
    <script>
        var form_url = '/login-check';
        var redirect_url = '/dashboard';
    </script>
    <script src="{{ asset('assets/admin/custom/form.js') }}?v={{ time() }}"></script>
@endsection



