@extends('admin.layouts2.simple.master')
@section('content')
    <div class="content d-flex flex-column flex-column-fluid" id="kt_content">
        <div class="toolbar" id="kt_toolbar">
            <div id="kt_toolbar_container" class="container-fluid d-flex flex-stack">
                @include('admin.layouts2.components.bread-crumbs',['main_name'=>trans('admin_string.add_permission')])
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
                                    <label class="required fs-6 fw-bold mb-2"
                                           for="module_name"> {{trans('admin_string.module_name')}}
                                    </label>
                                    <input type="text" class="form-control form-control-solid" required
                                           name="module_name" data-parsley-pattern="/^[A-Za-z ]+$/"
                                           id="module_name"
                                           placeholder="{{trans('admin_string.module_name')}}"/>
                                </div>

                                <div class="col-12">
                                    <div class="form-group form-control-solid">
                                        <label class="required fs-6 fw-bold mb-2"
                                               for="name">{{trans('admin_string.choose_permission')}}
                                        </label><br>

                                        <div class="form-check form-check-inline checkbox checkbox-dark mb-0">
                                            <input class="form-check-input" id="all" name="all" type="checkbox">
                                            <label class="form-check-label"
                                                   for="all">{{trans('admin_string.select_all')}}</label>
                                        </div>
                                        @foreach($array as $value)
                                            <div class="form-check form-check-inline checkbox checkbox-dark mb-0">
                                                <input class="form-check-input" id="{{$value}}" name="{{$value}}"
                                                       value="1"
                                                       type="checkbox">
                                                <label class="form-check-label"
                                                       for="{{$value}}">{{ $value }}</label>
                                            </div>
                                        @endforeach
                                        <div class="help-block with-errors error"></div>
                                    </div>
                                </div>
                            </div>

                            <div class="card-footer text-end p-3 btn-showcase">
                                <button class="btn btn-primary" type="submit">
                                    {{trans('admin_string.common_submit')}}
                                </button>
                                <a href="{{ route('admin.role.index') }}">
                                    <button class="btn btn-secondary " type="button">
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
        var form_url = '/permission'
        var redirect_url = '/permission'

        $('#all').click(function () {
            if ($(this).is(':checked')) {
                $("#create").attr('checked', true);
                $("#update").attr('checked', true);
                $("#read").attr('checked', true);
                $("#delete").attr('checked', true);
            } else {
                $("#create").attr('checked', false);
                $("#update").attr('checked', false);
                $("#read").attr('checked', false);
                $("#delete").attr('checked', false);
            }
        });
    </script>
    <script src="{{URL::asset('assets/admin/custom/form.js')}}?v={{ time() }}"></script>
@endsection
