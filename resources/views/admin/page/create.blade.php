@extends('admin.layouts2.simple.master')
@section('content')
    <div class="content d-flex flex-column flex-column-fluid" id="kt_content">
        <div class="toolbar" id="kt_toolbar">
            <div id="kt_toolbar_container" class="container-fluid d-flex flex-stack">
                @include('admin.layouts2.components.bread-crumbs',['main_name'=>trans('admin_string.pages')])
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

                                <div class="row">
                                    @foreach($languages as $language)
                                        <div class="mb-3 col-md-6">
                                            <div class="fv-row mb-7 fv-plugins-icon-container">
                                                <label for="{{ $language['language_code'] }}_name"
                                                       class="required fs-6 fw-bold mb-2">{{ $language['name'] }} {{trans('admin_string.name')}}
                                                </label>
                                                <input type="text" class="form-control form-control-solid"
                                                       name="{{ $language['language_code'] }}_name"
                                                       id="{{ $language['language_code'] }}_name"
                                                       @if($language['is_rtl']==1) dir="rtl" @endif
                                                       placeholder="{{ $language['name'] }} {{ trans('admin_string.name') }}"
                                                       required/>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>

                                <div class="row">
                                    <div class="fv-row mb-7 fv-plugins-icon-container">
                                        <label class="required fs-6 fw-bold mb-2" for="slug">
                                            {{ trans('admin_string.slug') }}
                                        </label>
                                        <input type="text" class="form-control form-control-solid" required
                                               name="slug"
                                               id="slug"
                                               placeholder="{{ trans('admin_string.slug') }}"/>
                                    </div>
                                </div>

                                @foreach($languages as $language)
                                    <div class="mb-3 col-md-12">
                                        <div class="fv-row mb-7 fv-plugins-icon-container">
                                            <label for="{{ $language['language_code'] }}_slug"
                                                   class="required fs-6 fw-bold mb-2">{{ $language['name'] }}  {{ trans('admin_string.description') }}
                                            </label>
                                            <textarea class="summernote form-control"
                                                      name="{{ $language['language_code'] }}_description"
                                                      id="{{ $language['language_code'] }}_description"
                                                      @if($language['is_rtl']==1) dir="rtl" @endif></textarea>
                                        </div>
                                    </div>
                                @endforeach
                            </div>

                            <div class="card-footer text-end p-3 btn-showcase">
                                <button class="btn btn-primary" type="submit">
                                    {{ trans('admin_string.common_submit') }}
                                </button>
                                <a href="{{ route('admin.page.index') }}">
                                    <button class="btn btn-secondary" type="button">
                                        {{ trans('admin_string.common_cancel') }}
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
        var form_url = '/page'
        var redirect_url = '/page'
    </script>
    <script type="text/javascript">

        $("#name").keyup(function () {
            var Text = $(this).val();
            Text = Text.toLowerCase();
            Text = Text.replace(/ /g, "-")
                .replace(/[^\w-]+/g, "");
            $("#slug").val(Text);
        });
    </script>

    <script src="{{URL::asset('assets/admin/custom/page/page.js')}}?v={{ time() }}"></script>
@endsection
