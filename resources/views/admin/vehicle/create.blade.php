@extends('admin.layouts2.simple.master')
@section('content')
    <div class="content d-flex flex-column flex-column-fluid" id="kt_content">
        <div class="toolbar" id="kt_toolbar">
            <div id="kt_toolbar_container" class="container-fluid d-flex flex-stack">
                @include('admin.layouts2.components.bread-crumbs',['main_name'=>trans('admin_string.add_vehicle')])
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
                                <input type="hidden" id="temp_time" name="temp_time" value="{{time()}}">
                                <input type="hidden" id="form-method" value="add">

                                {{--                                <div class="fv-row mb-7 fv-plugins-icon-container">--}}
                                {{--                                    <label class="required fs-6 fw-bold mb-2" for="name">--}}
                                {{--                                        Name--}}
                                {{--                                    </label>--}}
                                {{--                                    <input type="text" class="form-control form-control-solid"--}}
                                {{--                                           name="name"--}}
                                {{--                                           id="name"--}}
                                {{--                                           placeholder="Name"/>--}}
                                {{--                                </div>--}}
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
                                    <div class="mb-3 col-md-6">
                                        <div class="fv-row mb-7 fv-plugins-icon-container">
                                            <label
                                                class="required fs-6 fw-bold mb-2">{{trans('admin_string.vehicle_category')}}</label>
                                            <select class="form-select form-select-solid fw-bold"
                                                    name="vehicle_category_id"
                                                    id="vehicle_category_id">
                                                <option value="">{{trans('admin_string.select_option')}}</option>
                                                @foreach($vehicle_categories as $vehicle_category)
                                                    <option
                                                        value="{{$vehicle_category->id}}">{{$vehicle_category->name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="mb-3 col-md-6">
                                        <div class="fv-row mb-7 fv-plugins-icon-container">
                                            <label
                                                class="required fs-6 fw-bold mb-2">{{trans('admin_string.user')}}</label>
                                            <select class="form-select form-select-solid fw-bold" name="user_id"
                                                    id="user_id">
                                                <option value="">{{trans('admin_string.select_option')}}</option>
                                                @foreach($users as $user)
                                                    <option
                                                        value="{{$user->id}}">{{$user->name .' ' . $user->last_name}}
                                                        ({{$user->email .'/' . $user->contact_no}})
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    @foreach($languages as $language)
                                        <div class="mb-3 col-md-6">
                                            <div class="fv-row mb-7 fv-plugins-icon-container">
                                                <label for="{{ $language['language_code'] }}_make"
                                                       class="required fs-6 fw-bold mb-2">{{ $language['name'] }} {{trans('admin_string.make')}}
                                                </label>
                                                <input type="text" class="form-control form-control-solid"
                                                       name="{{ $language['language_code'] }}_make"
                                                       id="{{ $language['language_code'] }}_make"
                                                       @if($language['is_rtl']==1) dir="rtl" @endif
                                                       placeholder="{{ $language['name'] }} {{trans('admin_string.make')}}"
                                                       required/>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                                <div class="row">
                                    @foreach($languages as $language)
                                        <div class="mb-3 col-md-6">
                                            <div class="fv-row mb-7 fv-plugins-icon-container">
                                                <label for="{{ $language['language_code'] }}_model"
                                                       class="required fs-6 fw-bold mb-2">{{ $language['name'] }} {{trans('admin_string.model')}}
                                                </label>
                                                <input type="text" class="form-control form-control-solid"
                                                       name="{{ $language['language_code'] }}_model"
                                                       id="{{ $language['language_code'] }}_model"
                                                       @if($language['is_rtl']==1) dir="rtl" @endif
                                                       placeholder="{{ $language['name'] }} {{trans('admin_string.model')}}"
                                                       required/>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                                <div class="row">
                                    @foreach($languages as $language)
                                        <div class="mb-3 col-md-6">
                                            <div class="fv-row mb-7 fv-plugins-icon-container">
                                                <label for="{{ $language['language_code'] }}_trim"
                                                       class="required fs-6 fw-bold mb-2">{{ $language['name'] }} {{trans('admin_string.trim')}}
                                                </label>
                                                <input type="text" class="form-control form-control-solid"
                                                       name="{{ $language['language_code'] }}_trim"
                                                       id="{{ $language['language_code'] }}_trim"
                                                       @if($language['is_rtl']==1) dir="rtl" @endif
                                                       placeholder="{{ $language['name'] }} {{trans('admin_string.trim')}}"
                                                       required/>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>

                                <div class="row">
                                    <div class="mb-3 col-md-6">
                                        <div class="fv-row mb-7 fv-plugins-icon-container">
                                            <label class="required fs-6 fw-bold mb-2" for="kms_driven">
                                                {{trans('admin_string.kms_driven')}}
                                            </label>
                                            <input type="text" class="form-control form-control-solid"
                                                   name="kms_driven"
                                                   id="kms_driven"
                                                   placeholder="{{trans('admin_string.kms_driven')}}"/>
                                        </div>
                                    </div>
                                    <div class="mb-3 col-md-6">
                                        <div class="fv-row mb-7 fv-plugins-icon-container">
                                            <label class="required fs-6 fw-bold mb-2" for="owners">
                                                {{trans('admin_string.no_of_owners')}}
                                            </label>
                                            <input type="text" class="form-control form-control-solid integer"
                                                   name="owners"
                                                   id="owners"
                                                   placeholder="{{trans('admin_string.no_of_owners')}}"/>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    @foreach($languages as $language)
                                        <div class="mb-3 col-md-6">
                                            <div class="fv-row mb-7 fv-plugins-icon-container">
                                                <label for="{{ $language['language_code'] }}_transmission"
                                                       class="required fs-6 fw-bold mb-2">{{ $language['name'] }}
                                                    {{trans('admin_string.transmission')}}
                                                </label>
                                                <input type="text" class="form-control form-control-solid"
                                                       name="{{ $language['language_code'] }}_transmission"
                                                       id="{{ $language['language_code'] }}_transmission"
                                                       @if($language['is_rtl']==1) dir="rtl" @endif
                                                       placeholder="{{ $language['name'] }} {{trans('admin_string.transmission')}}"
                                                       required/>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>

                                <div class="row">
                                    @foreach($languages as $language)
                                        <div class="mb-3 col-md-6">
                                            <div class="fv-row mb-7 fv-plugins-icon-container">
                                                <label for="{{ $language['language_code'] }}_fuel_type"
                                                       class="required fs-6 fw-bold mb-2">{{ $language['name'] }} {{trans('admin_string.fuel')}}
                                                </label>
                                                <input type="text" class="form-control form-control-solid"
                                                       name="{{ $language['language_code'] }}_fuel_type"
                                                       id="{{ $language['language_code'] }}_fuel_type"
                                                       @if($language['is_rtl']==1) dir="rtl" @endif
                                                       placeholder="{{ $language['name'] }} {{trans('admin_string.fuel')}}"
                                                       required/>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>

                                <div class="row">
                                    @foreach($languages as $language)
                                        <div class="mb-3 col-md-6">
                                            <div class="fv-row mb-7 fv-plugins-icon-container">
                                                <label for="{{ $language['language_code'] }}_body_type"
                                                       class="required fs-6 fw-bold mb-2">{{ $language['name'] }} {{trans('admin_string.body_type')}}
                                                </label>
                                                <input type="text" class="form-control form-control-solid"
                                                       name="{{ $language['language_code'] }}_body_type"
                                                       id="{{ $language['language_code'] }}_body_type"
                                                       @if($language['is_rtl']==1) dir="rtl" @endif
                                                       placeholder="{{ $language['name'] }} {{trans('admin_string.body_type')}}"
                                                       required/>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>

                                <div class="row">
                                    @foreach($languages as $language)
                                        <div class="mb-3 col-md-6">
                                            <div class="fv-row mb-7 fv-plugins-icon-container">
                                                <label for="{{ $language['language_code'] }}_registration"
                                                       class="required fs-6 fw-bold mb-2">{{ $language['name'] }}
                                                    {{trans('admin_string.registration')}}
                                                </label>
                                                <input type="text" class="form-control form-control-solid"
                                                       name="{{ $language['language_code'] }}_registration"
                                                       id="{{ $language['language_code'] }}_registration"
                                                       @if($language['is_rtl']==1) dir="rtl" @endif
                                                       placeholder="{{ $language['name'] }} {{trans('admin_string.registration')}}"
                                                       required/>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>

                                <div class="row">
                                    @foreach($languages as $language)
                                        <div class="mb-3 col-md-6">
                                            <div class="fv-row mb-7 fv-plugins-icon-container">
                                                <label for="{{ $language['language_code'] }}_color"
                                                       class="required fs-6 fw-bold mb-2">{{ $language['name'] }}
                                                    {{trans('admin_string.exterior_color')}}
                                                </label>
                                                <input type="text" class="form-control form-control-solid"
                                                       name="{{ $language['language_code'] }}_color"
                                                       id="{{ $language['language_code'] }}_color"
                                                       @if($language['is_rtl']==1) dir="rtl" @endif
                                                       placeholder="{{ $language['name'] }} {{trans('admin_string.exterior_color')}}"
                                                       required/>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>

                                <div class="row">
                                    @foreach($languages as $language)
                                        <div class="mb-3 col-md-6">
                                            <div class="fv-row mb-7 fv-plugins-icon-container">
                                                <label for="{{ $language['language_code'] }}_car_type"
                                                       class="required fs-6 fw-bold mb-2">{{ $language['name'] }} {{trans('admin_string.car_type')}}
                                                </label>
                                                <input type="text" class="form-control form-control-solid"
                                                       name="{{ $language['language_code'] }}_car_type"
                                                       id="{{ $language['language_code'] }}_car_type"
                                                       @if($language['is_rtl']==1) dir="rtl" @endif
                                                       placeholder="{{ $language['name'] }} {{trans('admin_string.car_type')}}"
                                                       required/>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>

                                <div class="row">
                                    @foreach($languages as $language)
                                        <div class="mb-3 col-md-6">
                                            <div class="fv-row mb-7 fv-plugins-icon-container">
                                                <label for="{{ $language['language_code'] }}_mileage"
                                                       class="required fs-6 fw-bold mb-2">{{ $language['name'] }}
                                                    {{trans('admin_string.mileage')}}
                                                </label>
                                                <input type="text" class="form-control form-control-solid"
                                                       name="{{ $language['language_code'] }}_mileage"
                                                       id="{{ $language['language_code'] }}_mileage"
                                                       @if($language['is_rtl']==1) dir="rtl" @endif
                                                       placeholder="{{ $language['name'] }} {{trans('admin_string.mileage')}}"
                                                       required/>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>

                                <div class="row">
                                    <div class="mb-3 col-md-6">
                                        <div class="fv-row mb-7 fv-plugins-icon-container">
                                            <label class="required fs-6 fw-bold mb-2" for="year">
                                                {{trans('admin_string.year')}}
                                            </label>
                                            <input type="text" class="form-control form-control-solid"
                                                   name="year"
                                                   id="year"
                                                   placeholder="{{trans('admin_string.year')}}"/>
                                        </div>
                                    </div>

                                    <div class="mb-3 col-md-6">
                                        <div class="fv-row mb-7 fv-plugins-icon-container">
                                            <label class="required fs-6 fw-bold mb-2" for="price">
                                                {{trans('admin_string.price')}}
                                            </label>
                                            <input type="text" class="form-control form-control-solid"
                                                   name="price"
                                                   id="price"
                                                   placeholder="{{trans('admin_string.price')}}"/>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="mb-3 col-md-6">
                                        <div class="fv-row mb-7 fv-plugins-icon-container">
                                            <label class="required fs-6 fw-bold mb-2" for="auction_start_date">
                                                {{trans('admin_string.auction_start_date')}}
                                            </label>
                                            <input type="date" class="form-control form-control-solid"
                                                   name="auction_start_date"
                                                   id="auction_start_date"
                                                   placeholder="{{trans('admin_string.auction_start_date')}}"/>
                                        </div>
                                    </div>
                                    <div class="mb-3 col-md-6">
                                        <div class="fv-row mb-7 fv-plugins-icon-container">
                                            <label class="required fs-6 fw-bold mb-2" for="auction_end_date">
                                                {{trans('admin_string.auction_end_date')}}
                                            </label>
                                            <input type="date" class="form-control form-control-solid"
                                                   name="auction_end_date"
                                                   id="auction_end_date"
                                                   placeholder="{{trans('admin_string.auction_end_date')}}"/>
                                        </div>
                                    </div>
                                </div>


                                <div class="row">
                                    <div class="mb-3 col-md-6">
                                        <div class="fv-row mb-7 fv-plugins-icon-container">
                                            <label class="required fs-6 fw-bold mb-2" for="auction_end_time">
                                                {{trans('admin_string.auction_start_time')}}
                                            </label>
                                            <input type="time" class="form-control form-control-solid"
                                                   name="auction_start_time"
                                                   id="auction_start_time"
                                                   placeholder="{{trans('admin_string.auction_start_time')}}"/>
                                        </div>
                                    </div>
                                    <div class="mb-3 col-md-6">
                                        <div class="fv-row mb-7 fv-plugins-icon-container">
                                            <label class="required fs-6 fw-bold mb-2" for="auction_end_time">
                                                {{trans('admin_string.auction_end_time')}}
                                            </label>
                                            <input type="time" class="form-control form-control-solid"
                                                   name="auction_end_time"
                                                   id="auction_end_time"
                                                   placeholder="{{trans('admin_string.auction_end_time')}}"/>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    {{--                                                                        <div class="mb-3 col-md-6">--}}
                                    {{--                                                                            <div class="fv-row mb-7 fv-plugins-icon-container">--}}
                                    {{--                                                                                <label class="required fs-6 fw-bold mb-2" for="minimumBidIncrement">--}}
                                    {{--                                                                                    {{trans('admin_string.minimum_bid_increment_price')}}--}}
                                    {{--                                                                                </label>--}}
                                    {{--                                                                                <input type="text" class="form-control form-control-solid integer"--}}
                                    {{--                                                                                       name="minimumBidIncrement"--}}
                                    {{--                                                                                       id="minimumBidIncrement"--}}
                                    {{--                                                                                       placeholder="{{trans('admin_string.minimum_bid_increment_price')}}"/>--}}
                                    {{--                                                                            </div>--}}
                                    {{--                                                                        </div>--}}
                                    <div class="mt-5 mb-3 col-md-2">
                                        <div class="fv-row mb-7 fv-plugins-icon-container">
                                            <input
                                                class="form-check-input h-20px w-20px"
                                                value="1" name="is_product"
                                                id="is_product"
                                                type="radio" data-bs-original-title=""
                                                title="">
                                            <label class="form-check-label fw-bold"
                                                   for="is-quantity-1">{{trans('admin_string.is_featured')}}</label>
                                        </div>
                                    </div>
                                    <div class="mt-5 mb-3 col-md-2">
                                        <div class="fv-row mb-7 fv-plugins-icon-container">
                                            <input
                                                class="form-check-input h-20px w-20px"
                                                value="1" name="is_product"
                                                id="is_product"
                                                type="radio" data-bs-original-title=""
                                                title="">
                                            <label class="form-check-label fw-bold"
                                                   for="is-quantity-1">{{trans('admin_string.is_popular')}}</label>
                                        </div>
                                    </div>
                                    <div class="mt-5 mb-3 col-md-2">
                                        <div class="fv-row mb-7 fv-plugins-icon-container">
                                            <input
                                                class="form-check-input h-20px w-20px"
                                                value="1" name="is_product"
                                                id="is_product"
                                                type="radio" data-bs-original-title=""
                                                title="">
                                            <label class="form-check-label fw-bold"
                                                   for="is-quantity-1">{{trans('admin_string.hot_deal')}}</label>
                                        </div>
                                    </div>
                                    <div class="mb-3 col-md-6">
                                        <div class="fv-row mb-7 fv-plugins-icon-container">
                                            <label class="required fs-6 fw-bold mb-2" for="bid_increment">
                                                {{trans('admin_string.bid_increment_price')}}
                                            </label>
                                            <input type="text" class="form-control form-control-solid integer"
                                                   name="bid_increment"
                                                   id="bid_increment"
                                                   placeholder="{{trans('admin_string.bid_increment_price')}}"/>
                                        </div>
                                    </div>
                                </div>

                                @foreach($languages as $language)
                                    <div class="fv-row mb-7 fv-plugins-icon-container">
                                        <label for="{{ $language['language_code'] }}_short_description"
                                               class="required fs-6 fw-bold mb-2">{{ $language['name'] }}
                                            {{trans('admin_string.short_description')}}
                                        </label>
                                        <input type="text" class="form-control form-control-solid"
                                               name="{{ $language['language_code'] }}_short_description"
                                               id="{{ $language['language_code'] }}_short_description"
                                               @if($language['is_rtl']==1) dir="rtl" @endif
                                               placeholder="{{ $language['name'] }}  {{trans('admin_string.short_description')}}"
                                               required/>
                                    </div>
                                @endforeach

                                @foreach($languages as $language)
                                    <div class="fv-row mb-7 fv-plugins-icon-container">
                                        <label for="{{ $language['language_code'] }}_description"
                                               class="required fs-6 fw-bold mb-2">{{ $language['name'] }} {{trans('admin_string.description')}}
                                        </label>
                                        <textarea class="form-control"
                                                  name="{{ $language['language_code'] }}_description"
                                                  id="{{ $language['language_code'] }}_description"
                                                  @if($language['is_rtl']==1) dir="rtl" @endif></textarea>
                                    </div>
                                @endforeach

                                <div class="fv-row mb-7 fv-plugins-icon-container">
                                    <label class=" fs-6 fw-bold mb-2"
                                           for="image">{{trans('admin_string.image')}}
                                    </label><br>
                                    @include('admin.layouts2.components.image-selection',
                                      [
                                      'id'=>'image',
                                      'description_string'=>'',
                                      ])
                                </div>

                                <div class="form-group">
                                    <label class="required fs-6 fw-bold"
                                           for="image">{{trans('admin_string.multiple_image')}}
                                        <span
                                            class="error"></span></label><br>
                                    <div id="fine-uploader"></div>
                                </div>

                            </div>

                            <div class="card-footer text-end p-3 btn-showcase">
                                <button class="btn btn-primary" type="submit">
                                    {{trans('admin_string.common_submit')}}
                                </button>
                                <a href="{{ route('admin.vehicle.index') }}">
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
@include('admin.layouts2.components.fineUploader')
@section('custom-script')
    <script src="//cdn.ckeditor.com/4.22.1/standard/ckeditor.js"></script>
    <script type="text/javascript">
        $(document).ready(function () {
            $('.ckeditor').ckeditor();
        });

        CKEDITOR.replace('editer');
    </script>
    <script>
        var form_url = '/vehicle'
        var redirect_url = '/vehicle'
        var IMAGE_UPLOAD_URL = '/vehicle-image-upload'
        var IMAGE_DELETE_URL = '/vehicle-image-delete'
    </script>

    <script src="{{URL::asset('assets/admin/custom/form.js')}}?v={{ time() }}"></script>
    <script src="{{URL::asset('assets/admin/custom/imageUploader.js')}}?v={{ time() }}"></script>
@endsection
