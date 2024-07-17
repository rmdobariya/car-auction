@extends('admin.layouts2.simple.master')
@section('content')
    <div class="content d-flex flex-column flex-column-fluid" id="kt_content">
        <div class="toolbar" id="kt_toolbar">
            <div id="kt_toolbar_container" class="container-fluid d-flex flex-stack">
                @include('admin.layouts2.components.bread-crumbs',['main_name'=>trans('admin_string.my_profile')])
            </div>
        </div>
        <div class="post d-flex flex-column-fluid" id="kt_post">
            <div id="kt_content_container" class="container-fluid">
                <div class="card">
                    <div class="card-body pt-0">
                        <form method="POST" data-parsley-validate="" id="addEditForm" role="form"
                              enctype="multipart/form-data">
                            @csrf
                            <div class="card-body">
                                <input type="hidden" id="edit_value" value="{{ Auth::guard('admin')->user()->id }}"
                                       name="edit_value">
                                <input type="hidden" id="form-method" value="add">

                                <div class="fv-row mb-7 fv-plugins-icon-container">
                                    <label for="name" class="required fs-6 fw-bold mb-2">
                                        {{trans('admin_string.name')}}
                                    </label>
                                    <input type="text" class="form-control form-control-solid"
                                           name="name" id="name" value="{{ Auth::guard('admin')->user()->name }}"
                                           placeholder="{{trans('admin_string.name')}}" required/>
                                </div>

                                <div class="fv-row mb-7 fv-plugins-icon-container">
                                    <label for="email" class="required fs-6 fw-bold mb-2">
                                        {{trans('admin_string.email')}}
                                    </label>
                                    <input type="email" class="form-control form-control-solid"
                                           name="email" readonly id="email"
                                           value="{{ Auth::guard('admin')->user()->email }}"
                                           placeholder="{{trans('admin_string.email')}}" required/>
                                </div>

{{--                                <div class="fv-row mb-7 fv-plugins-icon-container">--}}
{{--                                    <label class=" fs-6 fw-bold mb-2"--}}
{{--                                           for="image">{{ trans('vendor_string.image') }}--}}
{{--                                    </label><br>--}}
{{--                                    @include('vendor.layouts.components.image-selection',--}}
{{--                                      [--}}
{{--                                      'id'=>'image',--}}
{{--                                      'description_string'=>trans('vendor_string.image_thumbnail_description'),--}}
{{--                                      'image'=>Auth::guard('vendor')->user()->image--}}
{{--                                      ])--}}
{{--                                </div>--}}
                            </div>

                            <div class="card-footer text-end p-3 btn-showcase">
                                <button class="btn btn-primary" type="submit">
                                    {{trans('admin_string.common_submit')}}
                                </button>
                                <a href="{{ route('admin.dashboard') }}">
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
        const default_message = '{{trans('admin_string.drag_and_drop_a_file_to_upload')}}';
        const replace_message = '{{trans('admin_string.drag_and_drop_a_file_to_replace')}}';
        const file_remove = '{{trans('admin_string.remove')}}';
        const file_error_message = '{{trans('admin_string.something_went_wrong')}}'

        var form_url = '/updateProfile'
        var redirect_url = '/my-profile'
    </script>
    <script src="{{URL::asset('assets/admin/custom/form.js')}}?v={{ time() }}"></script>
@endsection
