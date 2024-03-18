@extends('admin.layouts2.simple.master')
@section('content')
    <div class="content d-flex flex-column flex-column-fluid" id="kt_content">
        <div class="toolbar" id="kt_toolbar">
            <div id="kt_toolbar_container" class="container-fluid d-flex flex-stack">
                @include('admin.layouts2.components.bread-crumbs',['main_name'=>trans('admin_string.settings')])
            </div>
        </div>

        <div id="kt_app_content" class="app-content  flex-column-fluid ">
            <div id="kt_app_content_container" class="app-container  container-xxl ">
                <div class="card card-flush">
                    <div class="card-body">
                        <ul class="nav nav-tabs nav-line-tabs nav-line-tabs-2x border-transparent fs-4 fw-semibold mb-15">
                            <li class="nav-item">
                                <a class="nav-link text-active-primary d-flex align-items-center pb-5 active"
                                   data-bs-toggle="tab" href="#general_setting">
                                    <i class="ki-duotone ki-home fs-2 me-2"></i>
                                    {{trans('admin_string.general')}}
                                </a>
                            </li>

                            <li class="nav-item">
                                <a class="nav-link text-active-primary d-flex align-items-center pb-5"
                                   data-bs-toggle="tab" href="#email_setting">
                                    <i class="ki-duotone ki-shop fs-2 me-2">
                                        <span class="path1"></span>
                                        <span class="path2"></span>
                                        <span class="path3"></span>
                                        <span class="path4"></span>
                                        <span class="path5"></span>
                                    </i>
                                    {{trans('admin_string.email')}}
                                </a>
                            </li>

                            <li class="nav-item">
                                <a class="nav-link text-active-primary d-flex align-items-center pb-5"
                                   data-bs-toggle="tab" href="#app_setting">
                                    <i class="ki-duotone ki-home fs-2 me-2"></i>
                                    {{trans('admin_string.app')}}
                                </a>
                            </li>

                            <li class="nav-item">
                                <a class="nav-link text-active-primary d-flex align-items-center pb-5"
                                   data-bs-toggle="tab" href="#contact_info">
                                    <i class="ki-duotone ki-home fs-2 me-2"></i>
                                    {{trans('admin_string.contact_info')}}
                                </a>
                            </li>

                            <li class="nav-item">
                                <a class="nav-link text-active-primary d-flex align-items-center pb-5"
                                   data-bs-toggle="tab" href="#social_media_setting">
                                    <i class="ki-duotone ki-home fs-2 me-2"></i>
                                    {{trans('admin_string.social_media')}}
                                </a>
                            </li>
                        </ul>

                        <div class="tab-content" id="myTabContent">
                            <div class="tab-pane fade show active" id="general_setting" role="tabpanel">
                                <form id="general_setting_form" class="form" action="#">
                                    <div class="row mb-7">
                                        <div class="col-md-9 offset-md-3">
                                            <h2>{{trans('admin_string.general_settings')}}</h2>
                                        </div>
                                    </div>
                                    @foreach($settings as $setting)
                                        @if((string)$setting->setting_key === 'LOGO_IMG' || (string)$setting->setting_key === 'FAVICON_IMG' || (string)$setting->setting_key === 'WEBSITE_MAIN_IMAGE')
                                            <div class="row fv-row mb-7">
                                                <div class="col-md-3 text-md-end">
                                                    <label class="fs-6 fw-bold mb-2" for="{{$setting->setting_key}}">
                                                        {{str_replace('_',' ',ucfirst($setting->setting_key))}}
                                                        <span class="required"></span>
                                                    </label>
                                                </div>
                                                <div class="col-md-9">
                                                    @include('admin.layouts2.components.image-selection',
                                                                ['id'=>$setting->setting_key,
                                                                 'description_string'=>'Logo Thumbnail Description',
                                                                 'image'=>$setting->setting_value,
                                                                 'value'=>$setting->setting_value,
                                                                 ])
                                                </div>
                                            </div>
                                        @endif
                                        @if((string)$setting->setting_key === 'SITE_TITLE')
                                            <div class="row fv-row mb-7">
                                                <div class="col-md-3 text-md-end">
                                                    <label class="fs-6 fw-semibold form-label mt-3">
                                                        <span
                                                            class="required">  {{str_replace('_',' ',ucfirst($setting->setting_key))}}</span>
                                                        <span class="ms-1" data-bs-toggle="tooltip"
                                                              title="Set the name of the store">
	<i class="ki-duotone ki-information-5 text-gray-500 fs-6"><span class="path1"></span><span
            class="path2"></span><span class="path3"></span></i></span> </label>
                                                </div>

                                                <div class="col-md-9">
                                                    <input type="text" class="form-control form-control-solid"
                                                           name="setting_key[{{$setting->setting_key}}]"
                                                           id="{{$setting->setting_key}}"
                                                           value="{{$setting->setting_value}}"/>
                                                </div>
                                            </div>
                                        @endif
                                    @endforeach

                                    <div class="d-flex justify-content-end mt-3 text-end p-3 btn-showcase">
                                        <button class="btn btn-primary me-3" type="submit">
                                            {{trans('admin_string.common_submit')}}
                                        </button>
                                        <a href="#">
                                            <button class="btn btn-secondary" type="button">
                                                {{trans('admin_string.common_cancel')}}
                                            </button>
                                        </a>
                                    </div>
                                </form>
                            </div>

                            <div class="tab-pane fade" id="email_setting" role="tabpanel">
                                <form id="email_setting_form" class="form" action="#">
                                    <div class="row mb-7">
                                        <div class="col-md-9 offset-md-3">
                                            <h2>{{trans('admin_string.email_settings')}}</h2>
                                        </div>
                                    </div>
                                    @foreach($settings as $setting)
                                        @if((string)$setting->setting_key === 'SMTP_HOST' || (string)$setting->setting_key === 'SMTP_PORT' || (string)$setting->setting_key === 'SMTP_USERNAME'
                                        || (string)$setting->setting_key === 'SMTP_PASSWORD' || (string)$setting->setting_key === 'FROM_EMAIL' || (string)$setting->setting_key === 'FROM_EMAIL_TITLE')
                                            <div class="row fv-row mb-7">
                                                <div class="col-md-3 text-md-end">
                                                    <label class="fs-6 fw-semibold form-label mt-3">
                                                        <span
                                                            class="required">  {{str_replace('_',' ',ucfirst($setting->setting_key))}}</span>
                                                        <span class="ms-1" data-bs-toggle="tooltip"
                                                              title="Set the name of the store">
	<i class="ki-duotone ki-information-5 text-gray-500 fs-6"><span class="path1"></span><span
            class="path2"></span><span class="path3"></span></i></span> </label>
                                                </div>

                                                <div class="col-md-9">
                                                    <input type="text" class="form-control form-control-solid"
                                                           name="setting_key[{{$setting->setting_key}}]"
                                                           id="{{$setting->setting_key}}"
                                                           value="{{$setting->setting_value}}"/>
                                                </div>
                                            </div>
                                        @endif
                                        @if((string)$setting->setting_key === 'SMTP_SCHEME')
                                            <div class="row fv-row mb-7">
                                                <div class="col-md-3 text-md-end">
                                                    <label class="fs-6 fw-semibold form-label mt-3">
                                                        <span class="required">{{trans('admin_string.smtp_scheme')}}</span>
                                                    </label>
                                                </div>

                                                <div class="col-md-9">
                                                    <select id="smtp_scheme"
                                                            class="form-select form-select-solid fw-bolder"
                                                            name="setting_key[{{$setting->setting_key}}]"
                                                            data-parsley-errors-container="#smtp_scheme_error">
                                                        <option value="">{{trans('admin_string.select_option')}}</option>
                                                        <option value="SSL"
                                                                @if((string)$setting->setting_value === 'SSL') selected @endif>
                                                            {{trans('admin_string.ssl')}}
                                                        </option>
                                                        <option value="TLS"
                                                                @if((string)$setting->setting_value === 'TLS') selected @endif>
                                                            {{trans('admin_string.tls')}}
                                                        </option>
                                                    </select>
                                                </div>
                                            </div>
                                        @endif
                                    @endforeach

                                    <div class="d-flex justify-content-end mt-3 text-end p-3 btn-showcase">
                                        <button class="btn btn-primary me-3" type="submit">
                                            {{trans('admin_string.common_submit')}}
                                        </button>
                                        <a href="#">
                                            <button class="btn btn-secondary" type="button">
                                                {{trans('admin_string.common_cancel')}}
                                            </button>
                                        </a>
                                    </div>
                                </form>
                            </div>

                            <div class="tab-pane fade" id="app_setting" role="tabpanel">
                                <form id="app_setting_form" class="form" action="#">
                                    <div class="row mb-7">
                                        <div class="col-md-9 offset-md-3">
                                            <h2>{{trans('admin_string.app_settings')}}</h2>
                                        </div>
                                    </div>
                                    @foreach($settings as $setting)
                                        @if((string)$setting->setting_key === 'ANDROID_VERSION' || (string)$setting->setting_key === 'IOS_VERSION' || (string)$setting->setting_key === 'APP_STORE_LINK' || (string)$setting->setting_key === 'PLAY_STORE_LINK')
                                            <div class="row fv-row mb-7">
                                                <div class="col-md-3 text-md-end">
                                                    <label class="fs-6 fw-semibold form-label mt-3">
                                                        <span
                                                            class="required">  {{str_replace('_',' ',ucfirst($setting->setting_key))}}</span>
                                                        <span class="ms-1" data-bs-toggle="tooltip"
                                                              title="Set the name of the store">
	<i class="ki-duotone ki-information-5 text-gray-500 fs-6"><span class="path1"></span><span
            class="path2"></span><span class="path3"></span></i></span> </label>
                                                </div>

                                                <div class="col-md-9">
                                                    <input type="text" class="form-control form-control-solid"
                                                           name="setting_key[{{$setting->setting_key}}]"
                                                           id="{{$setting->setting_key}}"
                                                           value="{{$setting->setting_value}}"/>
                                                </div>
                                            </div>

                                        @endif

                                        @if( (string)$setting->setting_key === 'ANDROID_UPDATE_TEXT' || (string)$setting->setting_key === 'IOS_UPDATE_TEXT')
                                            <div class="row fv-row mb-7">
                                                <div class="col-md-3 text-md-end">
                                                    <label class="fs-6 fw-semibold form-label mt-3">
                                                        <span
                                                            class="required">  {{str_replace('_',' ',ucfirst($setting->setting_key))}}</span>
                                                        <span class="ms-1" data-bs-toggle="tooltip"
                                                              title="Set the name of the store">
	<i class="ki-duotone ki-information-5 text-gray-500 fs-6"><span class="path1"></span><span
            class="path2"></span><span class="path3"></span></i></span> </label>
                                                </div>

                                                <div class="col-md-9">
                                                        <textarea type="text" class="form-control form-control-solid"
                                                                  name="setting_key[{{$setting->setting_key}}]"
                                                                  id="{{$setting->setting_key}}">
                                                            {{ $setting->setting_value }}</textarea>
                                                </div>
                                            </div>

                                        @endif
                                        @if((string)$setting->setting_key === 'ANDROID_FORCE_UPDATE' || (string)$setting->setting_key === 'IOS_FORCE_UPDATE')
                                            <div class="row fv-row mb-7">
                                                <div class="col-md-3 text-md-end">
                                                    <label class="fs-6 fw-semibold form-label mt-3">
                                                        <span
                                                            class="required"> {{str_replace('_',' ',ucfirst($setting->setting_key))}}</span>
                                                    </label>
                                                </div>

                                                <div class="col-md-9">
                                                    <select id="smtp_scheme"
                                                            class="form-select form-select-solid fw-bolder"
                                                            name="setting_key[{{$setting->setting_key}}]"
                                                            data-parsley-errors-container="#smtp_scheme_error">
                                                        <option value="">{{trans('admin_string.select_option')}}</option>
                                                        <option value="1"
                                                                @if((int)$setting->setting_value === 1) selected @endif>
                                                            {{trans('admin_string.yes')}}
                                                        </option>
                                                        <option value="0"
                                                                @if((int)$setting->setting_value === 0) selected @endif>
                                                            {{trans('admin_string.no')}}
                                                        </option>
                                                    </select>
                                                </div>
                                            </div>
                                        @endif
                                    @endforeach

                                    <div class="d-flex justify-content-end mt-3 text-end p-3 btn-showcase">
                                        <button class="btn btn-primary me-3" type="submit">
                                            {{trans('admin_string.common_submit')}}
                                        </button>
                                        <a href="#">
                                            <button class="btn btn-secondary" type="button">
                                                {{trans('admin_string.common_cancel')}}
                                            </button>
                                        </a>
                                    </div>
                                </form>
                            </div>
                            <div class="tab-pane fade" id="contact_info" role="tabpanel">
                                <form id="contact_info_form" class="form" action="#">
                                    <div class="row mb-7">
                                        <div class="col-md-9 offset-md-3">
                                            <h2>{{trans('admin_string.contact_info_settings')}}</h2>
                                        </div>
                                    </div>
                                    @foreach($settings as $setting)
                                        @if((string)$setting->setting_key === 'CONTACT_NUMBER_1' || (string)$setting->setting_key === 'CONTACT_NUMBER_2' || (string)$setting->setting_key === 'WHATSAPP_NUMBER' || (string)$setting->setting_key === 'ZIPCODE')
                                            <div class="row fv-row mb-7">
                                                <div class="col-md-3 text-md-end">
                                                    <label class="fs-6 fw-semibold form-label mt-3">
                                                        <span
                                                            class="required">  {{str_replace('_',' ',ucfirst($setting->setting_key))}}</span>
                                                        <span class="ms-1" data-bs-toggle="tooltip"
                                                              title="Set the name of the store">
	<i class="ki-duotone ki-information-5 text-gray-500 fs-6"><span class="path1"></span><span
            class="path2"></span><span class="path3"></span></i></span> </label>
                                                </div>

                                                <div class="col-md-9">
                                                    <input type="text" class="form-control form-control-solid integer"
                                                           name="setting_key[{{$setting->setting_key}}]"
                                                           id="{{$setting->setting_key}}"
                                                           value="{{$setting->setting_value}}"/>
                                                </div>
                                            </div>

                                        @endif

                                        @if( (string)$setting->setting_key === 'ADDRESS_1' || (string)$setting->setting_key === 'ADDRESS_2')
                                            <div class="row fv-row mb-7">
                                                <div class="col-md-3 text-md-end">
                                                    <label class="fs-6 fw-semibold form-label mt-3">
                                                        <span
                                                            class="required">  {{str_replace('_',' ',ucfirst($setting->setting_key))}}</span>
                                                        <span class="ms-1" data-bs-toggle="tooltip"
                                                              title="Set the name of the store">
	<i class="ki-duotone ki-information-5 text-gray-500 fs-6"><span class="path1"></span><span
            class="path2"></span><span class="path3"></span></i></span> </label>
                                                </div>

                                                <div class="col-md-9">
                                                    <textarea type="text" class="form-control form-control-solid"
                                                              name="setting_key[{{$setting->setting_key}}]"
                                                              id="{{$setting->setting_key}}">{{ $setting->setting_value }}</textarea>
                                                </div>
                                            </div>

                                        @endif
                                        @if((string)$setting->setting_key === 'COUNTRY' || (string)$setting->setting_key === 'STATE' || (string)$setting->setting_key === 'CITY')
                                            <div class="row fv-row mb-7">
                                                <div class="col-md-3 text-md-end">
                                                    <label class="fs-6 fw-semibold form-label mt-3">
                                                        <span
                                                            class="required">  {{str_replace('_',' ',ucfirst($setting->setting_key))}}</span>
                                                        <span class="ms-1" data-bs-toggle="tooltip"
                                                              title="Set the name of the store">
	<i class="ki-duotone ki-information-5 text-gray-500 fs-6"><span class="path1"></span><span
            class="path2"></span><span class="path3"></span></i></span> </label>
                                                </div>

                                                <div class="col-md-9">
                                                    <input type="text" class="form-control form-control-solid"
                                                           name="setting_key[{{$setting->setting_key}}]"
                                                           id="{{$setting->setting_key}}"
                                                           value="{{$setting->setting_value}}"/>
                                                </div>
                                            </div>

                                        @endif

                                        @if((string)$setting->setting_key === 'ADDRESS_GOOGLE_MAP')
                                            <div class="row fv-row mb-7">
                                                <div class="col-md-3 text-md-end">
                                                    <label class="fs-6 fw-semibold form-label mt-3">
                                                        <span
                                                            class="required">  {{str_replace('_',' ',ucfirst($setting->setting_key))}}</span>
                                                        <span class="ms-1" data-bs-toggle="tooltip"
                                                              title="Set the name of the store">
	<i class="ki-duotone ki-information-5 text-gray-500 fs-6"><span class="path1"></span><span
            class="path2"></span><span class="path3"></span></i></span> </label>
                                                </div>

                                                <div class="col-md-9">
                                                    <input type="text" class="form-control form-control-solid"
                                                           name="setting_key[{{$setting->setting_key}}]"
                                                           id="{{$setting->setting_key}}"
                                                           value="{{$setting->setting_value}}"/>

                                                    <br>
                                                    <div class="alert alert-info">
                                                        <ul>
                                                            <li><b>Steps to generate the map link.</b></li>
                                                            <li>- Open, <a href="https://www.google.com/maps"
                                                                           title="https://www.google.com/maps"
                                                                           target="_blank">https://www.google.com/maps</a>
                                                            </li>
                                                            <li>- Search your address</li>
                                                            <li>- Click on Share</li>
                                                            <li>- Click on Embed Map</li>
                                                            <li>- Now Just COPY HTML and paste in the map input box.
                                                            </li>
                                                        </ul>
                                                    </div>
                                                    {{--                                                    <div id="map-container">--}}
                                                    {{--                                                        <iframe--}}
                                                    {{--                                                            width="600"--}}
                                                    {{--                                                            height="450"--}}
                                                    {{--                                                            frameborder="0"--}}
                                                    {{--                                                            style="border:0"--}}
                                                    {{--                                                            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d118147.68688962182!2d70.73889383315678!3d22.273625028792733!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3959c98ac71cdf0f%3A0x76dd15cfbe93ad3b!2sRajkot%2C%20Gujarat!5e0!3m2!1sen!2sin!4v1692618714097!5m2!1sen!2sin"--}}
                                                    {{--                                                            allowfullscreen--}}
                                                    {{--                                                        ></iframe>--}}
                                                    {{--                                                    </div>--}}
                                                </div>
                                            </div>

                                        @endif
                                    @endforeach

                                    <div class="d-flex justify-content-end mt-3 text-end p-3 btn-showcase">
                                        <button class="btn btn-primary me-3" type="submit">
                                            {{trans('admin_string.common_submit')}}
                                        </button>
                                        <a href="#">
                                            <button class="btn btn-secondary" type="button">
                                                {{trans('admin_string.common_cancel')}}
                                            </button>
                                        </a>
                                    </div>
                                </form>
                            </div>
                            <div class="tab-pane fade" id="social_media_setting" role="tabpanel">
                                <form id="social_media_form" class="form" action="#">
                                    <div class="row mb-7">
                                        <div class="col-md-9 offset-md-3">
                                            <h2>{{trans('admin_string.social_media_settings')}}</h2>
                                        </div>
                                    </div>
                                    @foreach($settings as $setting)
                                        @if((string)$setting->setting_key === 'FACEBOOK_LINK' || (string)$setting->setting_key === 'INSTAGRAM_LINK' || (string)$setting->setting_key === 'TWITTER_LINK' || (string)$setting->setting_key === 'PINTEREST_LINK' || (string)$setting->setting_key === 'DRIBBLE_LINK')
                                            <div class="row fv-row mb-7">
                                                <div class="col-md-3 text-md-end">
                                                    <label class="fs-6 fw-semibold form-label mt-3">
                                                        <span
                                                            class="required">  {{str_replace('_',' ',ucfirst($setting->setting_key))}}</span>
                                                        <span class="ms-1" data-bs-toggle="tooltip"
                                                              title="Set the name of the store">
	<i class="ki-duotone ki-information-5 text-gray-500 fs-6"><span class="path1"></span><span
            class="path2"></span><span class="path3"></span></i></span> </label>
                                                </div>

                                                <div class="col-md-9">
                                                    <input type="text" class="form-control form-control-solid"
                                                           name="setting_key[{{$setting->setting_key}}]"
                                                           id="{{$setting->setting_key}}"
                                                           value="{{$setting->setting_value}}"/>
                                                </div>
                                            </div>
                                        @endif
                                    @endforeach

                                    <div class="d-flex justify-content-end mt-3 text-end p-3 btn-showcase">
                                        <button class="btn btn-primary me-3" type="submit">
                                            {{trans('admin_string.common_submit')}}
                                        </button>
                                        <a href="#">
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
        </div>
    </div>
@endsection
@section('custom-script')
    <script>
        var general_form_url = '/general-setting-store';
        var email_setting_form_url = '/email-setting-store';
        var app_setting_form_url = '/app-setting-store';
        var contact_info_form_url = '/contact-info-store';
        var social_media_form_url = '/social-media-store';
        var redirect_url = '/setting';
    </script>
    <script>

        $(document).on('keyup', '#ADDRESS_GOOGLE_MAP', function () {
            var address = $('#ADDRESS_GOOGLE_MAP').val();
            var embedUrl = 'https://www.google.com/maps/embed?';
            if (address) {
                embedUrl += 'q=' + encodeURIComponent(address);
                $('#map-container').html('<iframe width="600" height="450" frameborder="0" style="border:0" src="' + embedUrl + '" allowfullscreen></iframe>');
            }
        })
    </script>
    <script src="{{URL::asset('assets/admin/custom/setting/setting.js')}}?v={{ time() }}"></script>
@endsection
