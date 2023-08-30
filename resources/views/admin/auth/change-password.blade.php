@extends('admin.layouts2.simple.master')
@section('content')
    <div class="content d-flex flex-column flex-column-fluid" id="kt_content">
        <div class="toolbar" id="kt_toolbar">
            <div id="kt_toolbar_container" class="container-fluid d-flex flex-stack">
                @include('admin.layouts2.components.bread-crumbs',['main_name'=>'Change Password'])
            </div>
        </div>
        <div class="post d-flex flex-column-fluid" id="kt_post">
            <div id="kt_content_container" class="container-fluid">
                <div class="card">
                    <div class="card-body pt-0">
                        <form method="POST" data-parsley-validate="" id="addEditForm" role="form">
                            @csrf
                            <div class="card-body">
                                <input type="hidden" id="edit_value" value="0" name="edit_value">
                                <input type="hidden" id="form-method" value="add">

                                <div class="fv-row mb-7 fv-plugins-icon-container">
                                    <label for="current_password" class="required fs-6 fw-bold mb-2">
                                        Current Password
                                    </label>
                                    <input type="password" class="form-control form-control-solid"
                                           name="current_password" id="current_password"
                                           placeholder="Current Password"
                                           required/>
                                </div>

                                <div class="fv-row mb-7 fv-plugins-icon-container">
                                    <label for="new_password" class="required fs-6 fw-bold mb-2">
                                        New Password
                                    </label>
                                    <input type="password" class="form-control form-control-solid"
                                           name="new_password" id="new_password"
                                           placeholder="New Password"
                                           required/>
                                </div>

                                <div class="fv-row mb-7 fv-plugins-icon-container">
                                    <label for="confirm_password" class="required fs-6 fw-bold mb-2">
                                        Confirm Password
                                    </label>
                                    <input type="password" class="form-control form-control-solid"
                                           name="confirm_password" id="confirm_password"
                                           placeholder="Confirm Password"
                                           required/>
                                </div>
                            </div>

                            <div class="card-footer text-end p-3 btn-showcase">
                                <button class="btn btn-primary" type="submit">
                                    Submit
                                </button>
                                <a href="{{ route('admin.dashboard') }}">
                                    <button class="btn btn-secondary" type="button">
                                       Cancel
                                    </button>
                                </a>
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
        var form_url = '/update-password'
        var redirect_url = '/dashboard'
    </script>
    <script src="{{URL::asset('assets/admin/custom/form.js')}}?v={{ time() }}"></script>
@endsection
