@extends('admin.layouts2.simple.master')
@section('content')
    <div class="content d-flex flex-column flex-column-fluid" id="kt_content">
        <div class="toolbar" id="kt_toolbar">
            <div id="kt_toolbar_container" class="container-fluid d-flex flex-stack">
                @include('admin.layouts2.components.bread-crumbs',['main_name'=>trans('admin_string.add_faq')])
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
                                    <label class="required fs-6 fw-bold mb-2" for="question">
                                        {{trans('admin_string.question')}}
                                    </label>
                                    <input type="text" class="form-control form-control-solid"
                                           name="question"
                                           id="question"
                                           placeholder="{{trans('admin_string.question')}}"/>
                                </div>
                                <div class="fv-row mb-7 fv-plugins-icon-container">
                                    <label class="form-label">{{trans('admin_string.answer')}}</label>
                                    <textarea class="ckeditor form-control" name="answer" id="answer"></textarea>
                                </div>

                            </div>

                            <div class="card-footer text-end p-3 btn-showcase">
                                <button class="btn btn-primary" type="submit">
                                    {{trans('admin_string.common_submit')}}
                                </button>
                                <a href="{{ route('admin.faq.index') }}">
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
        var form_url = '/faq'
        var redirect_url = '/faq'
    </script>
    <script src="//cdn.ckeditor.com/4.22.1/standard/ckeditor.js"></script>
    <script type="text/javascript">
        $(document).ready(function () {
            $('.ckeditor').ckeditor();
        });
    </script>
    <script src="{{URL::asset('assets/admin/custom/form.js')}}?v={{ time() }}"></script>
@endsection
