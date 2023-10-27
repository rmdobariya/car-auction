@extends('website.layouts.master')
@section('title')
    {{trans('web_string.add_car')}}
@endsection
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/css/dropify.css"/>
@section('content')
    <section id="vehicles" class="featured-vehicles">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="heading auction-detailss">
                        <h1>{{trans('web_string.car_details')}}</h1>
                        <div class="add-car-form">
                            <form id="vehicleAddForm">
                                <input type="hidden" id="edit_value" value="0" name="edit_value">
                                <input type="hidden" id="temp_time" name="temp_time" value="{{time()}}">
                                @csrf
                                <div class="row">
                                    @foreach($languages as $language)
                                        <div class="mb-1 col-md-6">
                                            <div class="fv-row mb-7 fv-plugins-icon-container">
                                                <label for="{{ $language['language_code'] }}_name"
                                                       class="required fs-6 fw-bold mb-2">{{ $language['name'] }} {{ trans('web_string.common_name') }}
                                                </label>
                                                <input type="text" class="form-control form-control-solid"
                                                       name="{{ $language['language_code'] }}_name"
                                                       id="{{ $language['language_code'] }}_name"
                                                       @if($language['is_rtl']==1) dir="rtl" @endif
                                                       placeholder="{{ $language['name'] }} {{ trans('web_string.common_name') }}"
                                                       required/>
                                            </div>
                                        </div>
                                    @endforeach
                                    <div class="mb-1 col-md-4">
                                        <div class="fv-row mb-7 fv-plugins-icon-container">
                                            <label class="required fs-6 fw-bold mb-2">{{trans('web_string.vehicle_category')}}</label>
                                            <select class="form-select form-select-solid fw-bold"
                                                    name="vehicle_category_id"
                                                    id="vehicle_category_id">
                                                <option value="">{{trans('web_string.select_option')}}</option>
                                                @foreach($vehicle_categories as $vehicle_category)
                                                    <option
                                                        value="{{$vehicle_category->id}}">{{$vehicle_category->name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="mb-1 col-md-4">
                                        <div class="fv-row mb-7 fv-plugins-icon-container">
                                            <label class="required fs-6 fw-bold mb-2" for="year">
                                                {{trans('web_string.year')}}
                                            </label>
                                            <input type="text" class="form-control form-control-solid"
                                                   name="year"
                                                   placeholder="{{trans('web_string.year')}}"/>
                                        </div>
                                    </div>
                                    <div class="mb-1 col-md-4">
                                        <div class="fv-row mb-7 fv-plugins-icon-container">
                                            <label class="required fs-6 fw-bold mb-2" for="make">
                                                {{trans('web_string.make')}}
                                            </label>
                                            <input type="text" class="form-control form-control-solid"
                                                   name="make"
                                                   id="make"
                                                   placeholder="{{trans('web_string.make')}}"/>
                                        </div>
                                    </div>
                                    <div class="mb-1 col-md-4">
                                        <div class="fv-row mb-7 fv-plugins-icon-container">
                                            <label class="required fs-6 fw-bold mb-2" for="model">
                                                {{trans('web_string.model')}}
                                            </label>
                                            <input type="text" class="form-control form-control-solid"
                                                   name="model"
                                                   id="model"
                                                   placeholder="{{trans('web_string.model')}}"/>
                                        </div>
                                    </div>
                                    <div class="mb-1 col-md-4">
                                        <div class="fv-row mb-7 fv-plugins-icon-container">
                                            <label class="required fs-6 fw-bold mb-2" for="trim">
                                                {{trans('web_string.trim')}}
                                            </label>
                                            <input type="text" class="form-control form-control-solid"
                                                   name="trim"
                                                   id="trim"
                                                   placeholder="{{trans('web_string.trim')}}"/>
                                        </div>
                                    </div>
                                    <div class="mb-1 col-md-4">
                                        <div class="fv-row mb-7 fv-plugins-icon-container">
                                            <label class="required fs-6 fw-bold mb-2" for="kms_driven">
                                                {{trans('web_string.kms_driven')}}
                                            </label>
                                            <input type="text" class="form-control form-control-solid"
                                                   name="kms_driven"
                                                   id="kms_driven"
                                                   placeholder="{{trans('web_string.kms_driven')}}"/>
                                        </div>
                                    </div>
                                    <div class="mb-1 col-md-4">
                                        <div class="fv-row mb-7 fv-plugins-icon-container">
                                            <label class="required fs-6 fw-bold mb-2" for="owners">
                                                {{trans('web_string.no_of_owners')}}
                                            </label>
                                            <input type="text" class="form-control form-control-solid integer"
                                                   name="owners"
                                                   id="owners"
                                                   placeholder="{{trans('web_string.no_of_owners')}}"/>
                                        </div>
                                    </div>
                                    <div class="mb-1 col-md-4">
                                        <div class="fv-row mb-7 fv-plugins-icon-container">
                                            <label class="required fs-6 fw-bold mb-2" for="transmission">
                                                {{trans('web_string.transmission')}}
                                            </label>
                                            <input type="text" class="form-control form-control-solid"
                                                   name="transmission"
                                                   id="transmission"
                                                   placeholder="{{trans('web_string.transmission')}}"/>
                                        </div>
                                    </div>
                                    <div class="mb-1 col-md-4">
                                        <div class="fv-row mb-7 fv-plugins-icon-container">
                                            <label class="required fs-6 fw-bold mb-2" for="fuel_type">
                                                {{trans('web_string.fuel_type')}}
                                            </label>
                                            <input type="text" class="form-control form-control-solid"
                                                   name="fuel_type"
                                                   id="fuel_type"
                                                   placeholder="{{trans('web_string.fuel_type')}}"/>
                                        </div>
                                    </div>
                                    <div class="mb-1 col-md-4">
                                        <div class="fv-row mb-7 fv-plugins-icon-container">
                                            <label class="required fs-6 fw-bold mb-2" for="body_type">
                                                {{trans('web_string.body_type')}}
                                            </label>
                                            <input type="text" class="form-control form-control-solid"
                                                   name="body_type"
                                                   id="body_type"
                                                   placeholder="{{trans('web_string.body_type')}}"/>
                                        </div>
                                    </div>
                                    <div class="mb-1 col-md-4">
                                        <div class="fv-row mb-7 fv-plugins-icon-container">
                                            <label class="required fs-6 fw-bold mb-2" for="registration">
                                                {{trans('web_string.registration')}}
                                            </label>
                                            <input type="text" class="form-control form-control-solid"
                                                   name="registration"
                                                   id="registration"
                                                   placeholder="{{trans('web_string.registration')}}"/>
                                        </div>
                                    </div>
                                    <div class="mb-1 col-md-4">
                                        <div class="fv-row mb-7 fv-plugins-icon-container">
                                            <label class="required fs-6 fw-bold mb-2" for="mileage">
                                                {{trans('web_string.mileage')}}
                                            </label>
                                            <input type="text" class="form-control form-control-solid"
                                                   name="mileage"
                                                   id="mileage"
                                                   placeholder="{{trans('web_string.mileage')}}"/>
                                        </div>
                                    </div>
                                    <div class="mb-1 col-md-4">
                                        <div class="fv-row mb-7 fv-plugins-icon-container">
                                            <label class="required fs-6 fw-bold mb-2" for="color">
                                                {{trans('web_string.exterior_color')}}
                                            </label>
                                            <input type="text" class="form-control form-control-solid"
                                                   name="color"
                                                   id="color"
                                                   placeholder="{{trans('web_string.exterior_color')}}"/>
                                        </div>
                                    </div>
                                    <div class="mb-1 col-md-4">
                                        <div class="fv-row mb-7 fv-plugins-icon-container">
                                            <label class="required fs-6 fw-bold mb-2" for="car_type">
                                                {{trans('web_string.car_type')}}
                                            </label>
                                            <input type="text" class="form-control form-control-solid"
                                                   name="car_type"
                                                   id="car_type"
                                                   placeholder="{{trans('web_string.car_type')}}"/>
                                        </div>
                                    </div>

                                </div>
                                <div class="mb-1 col-md-2">
                                    <div class="fv-row mb-7 fv-plugins-icon-container">
                                        <input
                                            class="form-check-input h-20px w-20px is_vehicle_type"
                                            value="car_for_auction" name="is_vehicle_type"
                                            id="is_vehicle_type"
                                            type="radio" data-bs-original-title=""
                                            title="">
                                        <label class="form-check-label fw-bold"
                                               for="is_vehicle_type">{{trans('web_string.car_for_auction')}}</label>
                                    </div>
                                </div>

                                <div class="mb-1 col-md-2">
                                    <div class="fv-row mb-7 fv-plugins-icon-container">
                                        <input
                                            class="form-check-input h-20px w-20px is_vehicle_type"
                                            value="car_for_sell" name="is_vehicle_type"
                                            id="is_vehicle_type"
                                            type="radio" data-bs-original-title=""
                                            title="">
                                        <label class="form-check-label fw-bold"
                                               for="is_vehicle_type">{{trans('web_string.car_for_sell')}}</label>
                                    </div>
                                </div>
                                @foreach($languages as $language)
                                    <div class="fv-row mb-7 fv-plugins-icon-container mt-2">
                                        <label for="{{ $language['language_code'] }}_short_description"
                                               class="required fs-6 fw-bold mb-2">{{ $language['name'] }} {{trans('web_string.short_description')}}
                                        </label>
                                        <input type="text" class="form-control form-control-solid"
                                               name="{{ $language['language_code'] }}_short_description"
                                               id="{{ $language['language_code'] }}_short_description"
                                               @if($language['is_rtl']==1) dir="rtl" @endif
                                               placeholder="{{ $language['name'] }} {{trans('web_string.short_description')}}"
                                               required/>
                                    </div>
                                @endforeach

                                @foreach($languages as $language)
                                    <div class="fv-row mb-7 fv-plugins-icon-container">
                                        <label for="{{ $language['language_code'] }}_description"
                                               class="required fs-6 fw-bold mb-2">{{ $language['name'] }} {{trans('web_string.description')}}
                                        </label>
                                        <textarea class="form-control"
                                                  name="{{ $language['language_code'] }}_description"
                                                  id="{{ $language['language_code'] }}_description"
                                                  @if($language['is_rtl']==1) dir="rtl" @endif></textarea>
                                    </div>
                                @endforeach
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="car-rating">
                                            <p>{{trans('web_string.rating')}}</p>
                                            <div class="rating_container secondary">
                                                <span class="rating">1</span>
                                                <span class="rating">2</span>
                                                <span class="rating">3</span>
                                                <span class="rating">4</span>
                                                <span class="rating">5</span>
                                                <input value="0" type="number" name="ratingvalue" class="ratingvalue"/>
                                            </div>

                                        </div>
                                    </div>
                                    <div class="col-md-8">
                                        <label class="required fs-6 fw-bold mb-2" for="main_image">
                                            {{trans('web_string.main_image')}}
                                        </label>
                                        <input type="file" name="main_image" id="file" class="dropify">
                                    </div>
                                </div>
                                <h1>{{trans('web_string.car_images')}}</h1>
                                <div class="row">
                                    <div id="fine-uploader"></div>
                                </div>
                                    <h1>{{trans('web_string.car_documents')}}</h1>
                                <div class="row">
                                    <div class="row">
                                        <div id="fine-uploader-document"></div>
                                    </div>
                                </div>
                                <h1>{{trans('web_string.car_auction_details')}}</h1>
                                <div class="row">
                                    <div class="mb-1 col-md-6">
                                        <div class="fv-row mb-7 fv-plugins-icon-container">
                                            <label class="required fs-6 fw-bold mb-2" for="price">
                                                {{trans('web_string.common_price')}}
                                            </label>
                                            <input type="text" name="price" class="form-control"
                                                   placeholder="{{trans('web_string.common_price')}}">
                                        </div>
                                    </div>
{{--                                    <div class="mb-1 col-md-6" id="minimumBidIncrement">--}}
{{--                                        <div class="fv-row mb-7 fv-plugins-icon-container">--}}
{{--                                            <label class="required fs-6 fw-bold mb-2" for="minimumBidIncrement">--}}
{{--                                                {{trans('web_string.minimum_bid_increment')}}--}}
{{--                                            </label>--}}
{{--                                            <input type="text" name="minimumBidIncrement" class="form-control"--}}
{{--                                                   placeholder="{{trans('web_string.minimum_bid_increment')}}">--}}
{{--                                        </div>--}}
{{--                                    </div>--}}
                                    <div class="mb-1 col-md-4" id="bid_increment">
                                        <div class="fv-row mb-7 fv-plugins-icon-container">
                                            <label class="required fs-6 fw-bold mb-2" for="car_type">
                                                {{trans('web_string.bid_increment')}}
                                            </label>
                                            <input type="text" class="form-control form-control-solid integer"
                                                   name="bid_increment"
                                                   placeholder="{{trans('web_string.bid_increment')}}"/>
                                        </div>
                                    </div>
                                </div>
                                <div class="row" id="auction_date_time_part">
                                    <div class="mb-1 col-md-3">
                                        <div class="fv-row mb-7 fv-plugins-icon-container">
                                            <label class="required fs-6 fw-bold mb-2" for="auction_start_date">
                                                {{trans('web_string.start_date')}}
                                            </label>
                                            <input type="date" name="auction_start_date" class="form-control"
                                                   placeholder="{{trans('web_string.start_date')}}">
                                        </div>
                                    </div>
                                    <div class="mb-1 col-md-3">
                                        <div class="fv-row mb-7 fv-plugins-icon-container">
                                            <label class="required fs-6 fw-bold mb-2" for="auction_start_date">
                                                {{trans('web_string.start_time')}}
                                            </label>
                                            <input type="time" name="auction_start_time" class="form-control"
                                                   placeholder="{{trans('web_string.start_time')}}">
                                        </div>
                                    </div>
                                    <div class="mb-1 col-md-3">
                                        <div class="fv-row mb-7 fv-plugins-icon-container">
                                            <label class="required fs-6 fw-bold mb-2" for="auction_start_date">
                                                {{trans('web_string.end_date')}}
                                            </label>
                                            <input type="date" name="auction_end_date" class="form-control"
                                                   placeholder="{{trans('web_string.end_date')}}">
                                        </div>
                                    </div>
                                    <div class="mb-1 col-md-3">
                                        <div class="fv-row mb-7 fv-plugins-icon-container">
                                            <label class="required fs-6 fw-bold mb-2" for="auction_start_date">
                                                {{trans('web_string.end_time')}}
                                            </label>
                                            <input type="time" name="auction_end_time" class="form-control"
                                                   placeholder="{{trans('web_string.end_time')}}">
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-md-12 text-center">
                                        <button type="submit" class="place-bid-blue">{{trans('web_string.add_car_to_auction')}}</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <div class="clearfix"></div>
    @include('admin.layouts2.components.fineUploader')
@endsection
@section('custom-script')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/js/dropify.min.js"></script>

    <script>
        var IMAGE_UPLOAD_URL = '/vehicle-image-upload'
        var IMAGE_DELETE_URL = '/vehicle-image-delete'
        var DOCUMENT_UPLOAD_URL = '/vehicle-document-upload'
        var DOCUMENT_DELETE_URL = '/vehicle-document-delete'
        $('.dropify').dropify();
    </script>
    <script src="{{asset('web/assets/custom/vehicle/vehicle.js')}}?v={{time()}}"></script>
    <script src="{{URL::asset('web/assets/custom/vehicle/imageUploader.js')}}?v={{ time() }}"></script>
@endsection
