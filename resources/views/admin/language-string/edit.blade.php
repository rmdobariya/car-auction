@extends('admin.layouts2.simple.master')
@section('content')
    <div class="content d-flex flex-column flex-column-fluid" id="kt_content">
        <div class="toolbar" id="kt_toolbar">
            <div id="kt_toolbar_container" class="container-fluid d-flex flex-stack">
                @include('admin.layouts2.components.bread-crumbs',['main_name'=>'Edit Language String'])
            </div>
        </div>
        <div class="post d-flex flex-column-fluid" id="kt_post">
            <div id="kt_content_container" class="container-fluid">
                <div class="card">
                    <div class="card-body pt-0">
                        <form method="POST" data-parsley-validate="" id="addEditForm" role="form">
                            @csrf
                            <div class="card-body">
                                <input type="hidden" id="edit_value" value="{{$languageString->id}}" name="edit_value">
                                <input type="hidden" id="form-method" value="add">

                                <div class="fv-row mb-7 fv-plugins-icon-container">
                                    <label class="required fs-6 fw-bold mb-2" for="app_or_panel">
                                        App Or Panel
                                    </label>
                                    <select class="form-control form-control-solid select2" id="app_or_panel" name="app_or_panel" required>
                                        <option value="">Select Option</option>
                                        <option value="admin"
                                                @if($languageString->app_or_panel== 'admin') selected @endif>
                                            Admin Panel
                                        </option>
                                        <option value="web"
                                                @if($languageString->app_or_panel== 'web') selected @endif >
                                            Web
                                        </option>
                                        <option value="app"
                                                @if($languageString->app_or_panel== 'app') selected @endif >
                                            Application
                                        </option>
                                    </select>
                                </div>

                                <div class="fv-row mb-7 fv-plugins-icon-container">
                                    <label class="required fs-6 fw-bold mb-2" for="name_key">
                                        Name Key
                                    </label>
                                    <input type="text" class="form-control form-control-solid"
                                           name="name_key" id="name_key"
                                           value="{{ $languageString->name_key }}"
                                           placeholder="Key" required />
                                </div>

                                @foreach($languages as $language)
                                    <div class="fv-row mb-7 fv-plugins-icon-container">
                                        <label class="required fs-6 fw-bold mb-2" for="{{ $language['language_code'] }}_name">
                                            {{ $language['name'] }} Name </label>
                                        <textarea class="form-control form-control-solid" name="{{ $language['language_code'] }}_name"
                                                  id="{{ $language['language_code'] }}_name" rows="3" column="5"
                                                  placeholder="{{ $language['name'] }} Name" required
                                                  @if($language['is_rtl'] == 1) dir="rtl" @endif>{{ $languageString->translateOrNew($language['language_code'])->name }}</textarea>
                                    </div>
                                @endforeach
                            </div>
                            <div class="card-footer text-end p-3 btn-showcase">
                                <button class="btn btn-primary" type="submit">
                                    Submit
                                </button>
                                <a href="{{ route('admin.language-string.index') }}">
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
        var form_url = '/language-string'
        var redirect_url = '/language-string'
    </script>

    <script src="{{URL::asset('assets/admin/custom/form.js')}}?v={{ time() }}"></script>
@endsection
