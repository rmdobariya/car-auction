@extends('admin.layouts2.authentication.master')
@section('title', 'Forgot-Password')
@section('content')
    <div class="d-flex flex-column flex-root">
        <div class="d-flex flex-column flex-lg-row flex-column-fluid">
            <div class="d-flex flex-column flex-lg-row-auto w-xl-600px positon-xl-relative"
                 style="background-image: linear-gradient(315deg, #FF5757 0%, #FF5757 74%);">
                <div class="d-flex flex-column position-xl-fixed top-0 bottom-0 w-xl-600px scroll-y">
                    <div class="d-flex flex-row-fluid flex-column text-center p-10 pt-lg-20 justify-content-center">
                        <a class="py-9 mb-5">
                            <img alt="Logo" src="{{ asset('assets/media/logos/logo.png') }}" class="h-100px"/>
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
                                <h1 class="text-dark mb-3">{{trans('admin_string.forgot_password')}}</h1>
                            </div>
                            <input type="hidden" id="email" value="{{ $email }}"
                                   name="email">

                            <div class="row mb-2">
                                <div class="col-md-12">
                                    <label for="name" class="required fs-6 fw-bold">
                                        {{trans('admin_string.new_password')}}
                                    </label>
                                    <input type="text" class="form-control"
                                           name="new_password" id="new_password"
                                           placeholder="New Password" required/>
                                </div>
                            </div>

                            <div class="row mb-2">
                                <div class="col-md-12">
                                    <label for="confirm_password" class="required fs-6 fw-bold">
                                        {{trans('admin_string.confirm_password')}}
                                    </label>
                                    <input type="text" class="form-control"
                                           name="confirm_password" id="confirm_password"
                                           placeholder="Confirm Password" required/>
                                </div>
                            </div>
                            <div class="text-center">
                                <button type="submit" class="btn btn-lg btn-primary w-100 mb-5">
                                    <span class="indicator-label"> {{trans('admin_string.common_submit')}}</span>
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('custom-script')
    <script>
        var form_url = '/reset-password-submit'
        var redirect_url = '/login'
    </script>
    <script src="{{ asset('assets/admin/custom/form.js') }}?v={{ time() }}"></script>
@endsection



