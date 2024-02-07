@extends('admin.layouts2.simple.master')
@section('content')
    <div class="content d-flex flex-column flex-column-fluid" id="kt_content">
        <div class="toolbar" id="kt_toolbar">
            <div id="kt_toolbar_container" class="container-fluid d-flex flex-stack">
                @include('admin.layouts2.components.bread-crumbs',['main_name'=>trans('admin_string.edit_sub_admin')])
            </div>
        </div>
        <div class="post d-flex flex-column-fluid" id="kt_post">
            <div id="kt_content_container" class="container-fluid">
                <div class="card">
                    <div class="card-body pt-0">
                        <form method="POST" data-parsley-validate="" id="addEditForm" role="form">
                            @csrf
                            <div class="card-body">
                                <input type="hidden" id="edit_value" value="{{$user->id}}" name="edit_value">

                                <input type="hidden" id="form-method" value="add">
                                <div class="row">
                                    <div class="mb-3 col-md-6">
                                        <div class="fv-row mb-7 fv-plugins-icon-container">
                                            <label class="required fs-6 fw-bold mb-2">Roles</label>
                                            <select class="form-select form-select-solid fw-bold" name="role_id"
                                                    id="role_id">
                                                <option value="">{{trans('admin_string.select_option')}}</option>
                                                @foreach($roles as $role)
                                                    @if($role->name != 'Buyer' && $role->name != 'Seller')
                                                        <option
                                                            value="{{$role->id}}"
                                                            @if($user->user_type == $role->name) selected @endif>{{$role->name}}</option>
                                                    @endif
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="mb-3 col-md-6">
                                        <div class="fv-row mb-7 fv-plugins-icon-container">
                                            <label class="required fs-6 fw-bold mb-2" for="contact_no">
                                                {{trans('admin_string.contact_no')}}
                                            </label>
                                            <input type="text" class="form-control form-control-solid integer"
                                                   name="contact_no"
                                                   id="contact_no"
                                                   value="{{$user->contact_no}}"
                                                   placeholder="{{trans('admin_string.contact_no')}}"/>
                                        </div>
                                    </div>
                                </div>


                                <div class="row">
                                    <div class="mb-3 col-md-6">
                                        <div class="fv-row mb-7 fv-plugins-icon-container">
                                            <label class="required fs-6 fw-bold mb-2" for="first_name">
                                                {{trans('admin_string.contact_no')}}
                                            </label>
                                            <input type="text" class="form-control form-control-solid"
                                                   name="first_name"
                                                   id="first_name"
                                                   value="{{$user->name}}"
                                                   placeholder="{{trans('admin_string.contact_no')}}"/>
                                        </div>
                                    </div>
                                    <div class="mb-3 col-md-6">
                                        <div class="fv-row mb-7 fv-plugins-icon-container">
                                            <label class="required fs-6 fw-bold mb-2" for="last_name">
                                                {{trans('admin_string.last_name')}}
                                            </label>
                                            <input type="text" class="form-control form-control-solid"
                                                   name="last_name"
                                                   id="last_name"
                                                   value="{{$user->last_name}}"
                                                   placeholder="{{trans('admin_string.last_name')}}"/>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="mb-3 col-md-6">
                                        <div class="fv-row mb-7 fv-plugins-icon-container">
                                            <label class="required fs-6 fw-bold mb-2" for="email">
                                                {{trans('admin_string.email')}}
                                            </label>
                                            <input type="email" class="form-control form-control-solid"
                                                   name="email"
                                                   id="email"
                                                   value="{{$user->email}}"
                                                   placeholder="{{trans('admin_string.email')}}"/>
                                        </div>
                                    </div>
                                    <div class="mb-3 col-md-6">
                                        <div class="fv-row mb-7 fv-plugins-icon-container">
                                            <label class="required fs-6 fw-bold mb-2" for="password">
                                                {{trans('admin_string.password')}}
                                            </label>
                                            <input type="password" class="form-control form-control-solid"
                                                   name="password"
                                                   id="password"
                                                   placeholder="Password"/>
                                        </div>
                                    </div>
                                </div>
                                <div class="row @if($user->user_type != 'seller') d-none @endif"
                                     id="corporate_seller_part">
                                    <div class="mb-3 col-md-6">
                                        <div class="fv-row mb-7 fv-plugins-icon-container">
                                            <label class="required fs-6 fw-bold mb-2" for="is_corporate_seller">
                                                {{trans('admin_string.corporate_seller')}}
                                            </label>
                                            <input type="checkbox" class="form-check"
                                                   name="is_corporate_seller"
                                                   value="0"
                                                   id="is_corporate_seller"
                                                   @if($user->is_corporate_seller == 1) checked @endif/>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="card-footer text-end p-3 btn-showcase">
                                <button class="btn btn-primary" type="submit">
                                    {{trans('admin_string.common_submit')}}
                                </button>
                                <a href="{{ route('admin.customer.index') }}">
                                    <button class="btn btn-secondary" type="button">
                                        {{trans('admin_string.common_cancel')}}
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
        var form_url = '/sub-admin'
        var redirect_url = '/sub-admin'
    </script>
    <script>
        $('#role_id').on('change', function () {
            var val = $(this).val();
            if (val == 11) {
                $('#corporate_seller_part').removeClass('d-none')
                $('#is_corporate_seller').val(1)
            } else {
                $('#corporate_seller_part').addClass('d-none')
                $('#is_corporate_seller').val(0)
            }
        })

    </script>
    <script src="{{URL::asset('assets/admin/custom/form.js')}}?v={{ time() }}"></script>
@endsection
