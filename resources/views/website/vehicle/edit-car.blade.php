@extends('website.layouts.master')
@section('title')
    {{trans('web_string.edit_car')}}
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
                                <input type="hidden" id="edit_value" value="{{$vehicle->id}}" name="edit_value">
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
                                                       value="{{ $vehicle->translateOrNew($language['language_code'])->name }}"
                                                       placeholder="{{ $language['name'] }} {{ trans('web_string.common_name') }}"
                                                       required/>
                                            </div>
                                        </div>
                                    @endforeach
                                    <div class="mb-1 col-md-4">
                                        <div class="fv-row mb-7 fv-plugins-icon-container">
                                            <label
                                                class="required fs-6 fw-bold mb-2">{{trans('web_string.vehicle_category')}}</label>
                                            <select class="form-select form-select-solid fw-bold"
                                                    name="vehicle_category_id"
                                                    id="vehicle_category_id">
                                                <option value="">{{trans('web_string.select_option')}}</option>
                                                @foreach($vehicle_categories as $vehicle_category)
                                                    <option
                                                        value="{{$vehicle_category->id}}"
                                                        @if((int)$vehicle->vehicle_category_id === $vehicle_category->id) selected @endif>{{$vehicle_category->name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="mb-1 col-md-4">
                                        <div class="fv-row mb-7 fv-plugins-icon-container">
                                            <label
                                                class="required fs-6 fw-bold mb-2">{{trans('web_string.city')}}</label>
                                            <select class="form-select form-select-solid fw-bold"
                                                    name="city"
                                                    id="city">
                                                <option value="">{{trans('web_string.select_option')}}</option>
                                                @foreach($cities as $city)
                                                    <option
                                                        value="{{$city->id}}"
                                                        @if((int)$vehicle->city_id === $city->id) selected @endif>{{$city->name}}</option>
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
                                                   value="{{$vehicle->year}}"
                                                   placeholder="{{trans('web_string.year')}}"/>
                                        </div>
                                    </div>
                                    <div class="mb-1 col-md-6">
                                        <div class="fv-row mb-7 fv-plugins-icon-container">
                                            <label class="required fs-6 fw-bold mb-2" for="kms_driven">
                                                {{trans('web_string.kms_driven')}}
                                            </label>
                                            <input type="text" class="form-control form-control-solid"
                                                   name="kms_driven"
                                                   value="{{$vehicle->kms_driven}}"
                                                   id="kms_driven"
                                                   placeholder="{{trans('web_string.kms_driven')}}"/>
                                        </div>
                                    </div>
                                    <div class="mb-1 col-md-6">
                                        <div class="fv-row mb-7 fv-plugins-icon-container">
                                            <label class="required fs-6 fw-bold mb-2" for="owners">
                                                {{trans('web_string.no_of_owners')}}
                                            </label>
                                            <input type="text" class="form-control form-control-solid integer"
                                                   name="owners"
                                                   id="owners"
                                                   value="{{$vehicle->owners}}"
                                                   placeholder="{{trans('web_string.no_of_owners')}}"/>
                                        </div>
                                    </div>
                                    @foreach($languages as $language)
                                        <div class="mb-1 col-md-6">
                                            <div class="fv-row mb-7 fv-plugins-icon-container">
                                                <label for="{{ $language['language_code'] }}_make"
                                                       class="required fs-6 fw-bold mb-2">{{ $language['name'] }} {{trans('web_string.make')}}
                                                </label>
                                                <input type="text" class="form-control form-control-solid"
                                                       name="{{ $language['language_code'] }}_make"
                                                       id="{{ $language['language_code'] }}_make"
                                                       @if($language['is_rtl']==1) dir="rtl" @endif
                                                       value="{{ $vehicle->translateOrNew($language['language_code'])->make }}"
                                                       placeholder="{{ $language['name'] }} {{trans('web_string.make')}}"
                                                       required/>
                                            </div>
                                        </div>
                                    @endforeach
                                    @foreach($languages as $language)
                                        <div class="mb-1 col-md-6">
                                            <div class="fv-row mb-7 fv-plugins-icon-container">
                                                <label for="{{ $language['language_code'] }}_model"
                                                       class="required fs-6 fw-bold mb-2">{{ $language['name'] }} {{trans('web_string.model')}}
                                                </label>
                                                <input type="text" class="form-control form-control-solid"
                                                       name="{{ $language['language_code'] }}_model"
                                                       id="{{ $language['language_code'] }}_model"
                                                       @if($language['is_rtl']==1) dir="rtl" @endif
                                                       value="{{ $vehicle->translateOrNew($language['language_code'])->model }}"
                                                       placeholder="{{ $language['name'] }} {{trans('web_string.model')}}"
                                                       required/>
                                            </div>
                                        </div>
                                    @endforeach
                                    @foreach($languages as $language)
                                        <div class="mb-1 col-md-6">
                                            <div class="fv-row mb-7 fv-plugins-icon-container">
                                                <label for="{{ $language['language_code'] }}_trim"
                                                       class="required fs-6 fw-bold mb-2">{{ $language['name'] }} {{trans('web_string.trim')}}
                                                </label>
                                                <input type="text" class="form-control form-control-solid"
                                                       name="{{ $language['language_code'] }}_trim"
                                                       id="{{ $language['language_code'] }}_trim"
                                                       @if($language['is_rtl']==1) dir="rtl" @endif
                                                       value="{{ $vehicle->translateOrNew($language['language_code'])->trim }}"
                                                       placeholder="{{ $language['name'] }} {{trans('web_string.trim')}}"
                                                       required/>
                                            </div>
                                        </div>
                                    @endforeach
                                    @foreach($languages as $language)
                                        <div class="mb-1 col-md-6">
                                            <div class="fv-row mb-7 fv-plugins-icon-container">
                                                <label for="{{ $language['language_code'] }}_transmission"
                                                       class="required fs-6 fw-bold mb-2">{{ $language['name'] }}
                                                    {{trans('web_string.transmission')}}
                                                </label>
                                                <input type="text" class="form-control form-control-solid"
                                                       name="{{ $language['language_code'] }}_transmission"
                                                       id="{{ $language['language_code'] }}_transmission"
                                                       @if($language['is_rtl']==1) dir="rtl" @endif
                                                       value="{{ $vehicle->translateOrNew($language['language_code'])->transmission }}"
                                                       placeholder="{{ $language['name'] }} {{trans('web_string.transmission')}}"
                                                       required/>
                                            </div>
                                        </div>
                                    @endforeach
                                    @foreach($languages as $language)
                                        <div class="mb-1 col-md-6">
                                            <div class="fv-row mb-7 fv-plugins-icon-container">
                                                <label for="{{ $language['language_code'] }}_fuel_type"
                                                       class="required fs-6 fw-bold mb-2">{{ $language['name'] }} {{trans('web_string.fuel_type')}}
                                                </label>
                                                <input type="text" class="form-control form-control-solid"
                                                       name="{{ $language['language_code'] }}_fuel_type"
                                                       id="{{ $language['language_code'] }}_fuel_type"
                                                       @if($language['is_rtl']==1) dir="rtl" @endif
                                                       value="{{ $vehicle->translateOrNew($language['language_code'])->fuel_type }}"
                                                       placeholder="{{ $language['name'] }} {{trans('web_string.fuel_type')}}"
                                                       required/>
                                            </div>
                                        </div>
                                    @endforeach
                                    @foreach($languages as $language)
                                        <div class="mb-1 col-md-6">
                                            <div class="fv-row mb-7 fv-plugins-icon-container">
                                                <label for="{{ $language['language_code'] }}_body_type"
                                                       class="required fs-6 fw-bold mb-2">{{ $language['name'] }} {{trans('web_string.body_type')}}
                                                </label>
                                                <input type="text" class="form-control form-control-solid"
                                                       name="{{ $language['language_code'] }}_body_type"
                                                       id="{{ $language['language_code'] }}_body_type"
                                                       @if($language['is_rtl']==1) dir="rtl" @endif
                                                       value="{{ $vehicle->translateOrNew($language['language_code'])->body_type }}"
                                                       placeholder="{{ $language['name'] }} {{trans('web_string.body_type')}}"
                                                       required/>
                                            </div>
                                        </div>
                                    @endforeach
                                    @foreach($languages as $language)
                                        <div class="mb-1 col-md-6">
                                            <div class="fv-row mb-7 fv-plugins-icon-container">
                                                <label for="{{ $language['language_code'] }}_registration"
                                                       class="required fs-6 fw-bold mb-2">{{ $language['name'] }} {{trans('web_string.registration')}}
                                                </label>
                                                <input type="text" class="form-control form-control-solid"
                                                       name="{{ $language['language_code'] }}_registration"
                                                       id="{{ $language['language_code'] }}_registration"
                                                       @if($language['is_rtl']==1) dir="rtl" @endif
                                                       value="{{ $vehicle->translateOrNew($language['language_code'])->registration }}"
                                                       placeholder="{{ $language['name'] }} {{trans('web_string.registration')}}"
                                                       required/>
                                            </div>
                                        </div>
                                    @endforeach
                                    @foreach($languages as $language)
                                        <div class="mb-1 col-md-6">
                                            <div class="fv-row mb-7 fv-plugins-icon-container">
                                                <label for="{{ $language['language_code'] }}_mileage"
                                                       class="required fs-6 fw-bold mb-2">{{ $language['name'] }} {{trans('web_string.mileage')}}
                                                </label>
                                                <input type="text" class="form-control form-control-solid"
                                                       name="{{ $language['language_code'] }}_mileage"
                                                       id="{{ $language['language_code'] }}_mileage"
                                                       @if($language['is_rtl']==1) dir="rtl" @endif
                                                       value="{{ $vehicle->translateOrNew($language['language_code'])->mileage }}"
                                                       placeholder="{{ $language['name'] }} {{trans('web_string.mileage')}}"
                                                       required/>
                                            </div>
                                        </div>
                                    @endforeach
                                    @foreach($languages as $language)
                                        <div class="mb-1 col-md-6">
                                            <div class="fv-row mb-7 fv-plugins-icon-container">
                                                <label for="{{ $language['language_code'] }}_color"
                                                       class="required fs-6 fw-bold mb-2">{{ $language['name'] }} {{trans('web_string.exterior_color')}}
                                                </label>
                                                <input type="text" class="form-control form-control-solid"
                                                       name="{{ $language['language_code'] }}_color"
                                                       id="{{ $language['language_code'] }}_color"
                                                       @if($language['is_rtl']==1) dir="rtl" @endif
                                                       value="{{ $vehicle->translateOrNew($language['language_code'])->color }}"
                                                       placeholder="{{ $language['name'] }} {{trans('web_string.exterior_color')}}"
                                                       required/>
                                            </div>
                                        </div>
                                    @endforeach
                                    @foreach($languages as $language)
                                        <div class="mb-1 col-md-6">
                                            <div class="fv-row mb-7 fv-plugins-icon-container">
                                                <label for="{{ $language['language_code'] }}_car_type"
                                                       class="required fs-6 fw-bold mb-2">{{ $language['name'] }} {{trans('web_string.car_type')}}
                                                </label>
                                                <input type="text" class="form-control form-control-solid"
                                                       name="{{ $language['language_code'] }}_car_type"
                                                       id="{{ $language['language_code'] }}_car_type"
                                                       @if($language['is_rtl']==1) dir="rtl" @endif
                                                       value="{{ $vehicle->translateOrNew($language['language_code'])->car_type }}"
                                                       placeholder="{{ $language['name'] }} {{trans('web_string.car_type')}}"
                                                       required/>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                                <div class="mb-1 col-md-2">
                                    <div class="fv-row mb-7 fv-plugins-icon-container">
                                        <input
                                            class="form-check-input h-20px w-20px is_vehicle_type"
                                            value="car_for_auction" name="is_vehicle_type"
                                            id="is_vehicle_type"
                                            @if($vehicle->is_vehicle_type == 'car_for_auction') checked @endif
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
                                            @if($vehicle->is_vehicle_type == 'car_for_sell') checked @endif
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
                                               value="{{ $vehicle->translateOrNew($language['language_code'])->short_description }}"
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
                                                  @if($language['is_rtl']==1) dir="rtl" @endif>{{ $vehicle->translateOrNew($language['language_code'])->description }}</textarea>
                                    </div>
                                @endforeach
                                <div class="row">
                                    <div class="col-md-4">
                                        <label class="required fs-6 fw-bold mb-2" for="ratting">
                                            Ratting
                                        </label>
                                        <div class="car-rating">
                                            <p>{{trans('web_string.rating')}}</p>
                                            <div class="rating_container secondary">
                                                <span class="rating @if($vehicle->ratting >= 1) active @endif">1</span>
                                                <span class="rating @if($vehicle->ratting >= 2) active @endif">2</span>
                                                <span class="rating @if($vehicle->ratting >= 3) active @endif">3</span>
                                                <span class="rating @if($vehicle->ratting >= 4) active @endif">4</span>
                                                <span class="rating @if($vehicle->ratting >= 5) active @endif">5</span>
                                                <input value="{{$vehicle->ratting}}" type="number" name="ratingvalue"
                                                       class="ratingvalue"/>
                                            </div>

                                        </div>
                                    </div>
                                    <div class="col-md-8">
                                        <label class="required fs-6 fw-bold mb-2" for="main_image">
                                            {{trans('web_string.main_image')}}
                                        </label>
                                        <input type="file" name="main_image" id="file" class="dropify"
                                               data-default-file="{{asset($vehicle->main_image)}}" data-bs-toggle="tooltip" title="Allowed max 2MB and only JPG, PNG, GIF files are allowed."
                                               value="{{$vehicle->main_image}}">
                                    </div>
                                    <b style="font-size: 32px">{{trans('web_string.car_images')}} </b>({{trans('admin_string.allow_max')}})
                                    <div class="row">
                                        <div id="car_gallery">
                                            @include('website.vehicle.car_gallery')
                                        </div>
                                        <div id="fine-uploader"></div>
                                    </div>
                                    <b style="font-size: 32px">{{trans('web_string.car_documents')}}</b>({{trans('web_string.allow_document')}})
                                    <div class="row">
                                        <div id="car_document">
                                            @include('website.vehicle.car_document')
                                        </div>
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
                                                <input type="text" name="price"
                                                       value="{{$vehicle->price}}"
                                                       class="form-control"
                                                       placeholder="{{trans('web_string.common_price')}}">
                                            </div>
                                        </div>
                                        {{--                                        <div--}}
                                        {{--                                            class="mb-1 col-md-6 @if($vehicle->is_vehicle_type == 'car_for_sell') d-none @endif"--}}
                                        {{--                                            id="minimumBidIncrement">--}}
                                        {{--                                            <div class="fv-row mb-7 fv-plugins-icon-container">--}}
                                        {{--                                                <label class="required fs-6 fw-bold mb-2" for="minimumBidIncrement">--}}
                                        {{--                                                    {{trans('web_string.minimum_bid_increment')}}--}}
                                        {{--                                                </label>--}}
                                        {{--                                                <input type="text" name="minimumBidIncrement"--}}
                                        {{--                                                       value="{{$vehicle->minimum_bid_increment_price}}"--}}
                                        {{--                                                       class="form-control"--}}
                                        {{--                                                       placeholder="{{trans('web_string.minimum_bid_increment')}}">--}}
                                        {{--                                            </div>--}}
                                        {{--                                        </div>--}}
                                        <div
                                            class="mb-1 col-md-4 @if($vehicle->is_vehicle_type == 'car_for_sell') d-none @endif"
                                            id="bid_increment">
                                            <div class="fv-row mb-7 fv-plugins-icon-container">
                                                <label class="required fs-6 fw-bold mb-2" for="car_type">
                                                    {{trans('web_string.bid_increment')}}
                                                </label>
                                                <input type="text" class="form-control form-control-solid integer"
                                                       name="bid_increment"
                                                       value="{{$vehicle->bid_increment}}"
                                                       placeholder="{{trans('web_string.bid_increment')}}"/>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row @if($vehicle->is_vehicle_type == 'car_for_sell') d-none @endif"
                                         id="auction_date_time_part">
                                        <div class="mb-1 col-md-3">
                                            <div class="fv-row mb-7 fv-plugins-icon-container">
                                                <label class="required fs-6 fw-bold mb-2" for="auction_start_date">
                                                    {{trans('web_string.start_date')}}
                                                </label>
                                                <input type="date" name="auction_start_date"
                                                       value="{{$vehicle->auction_start_date}}"
                                                       class="form-control"
                                                       placeholder="{{trans('web_string.start_date')}}">
                                            </div>
                                        </div>
                                        <div class="mb-1 col-md-3">
                                            <div class="fv-row mb-7 fv-plugins-icon-container">
                                                <label class="required fs-6 fw-bold mb-2" for="auction_start_date">
                                                    {{trans('web_string.end_date')}}
                                                </label>
                                                <input type="date" name="auction_end_date"
                                                       value="{{$vehicle->auction_end_date}}"
                                                       class="form-control"
                                                       placeholder="{{trans('web_string.end_date')}}">
                                            </div>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="row">
                                        <div class="col-md-12 text-center">
                                            <button type="submit"
                                                    class="place-bid-blue">{{trans('web_string.update_car')}}</button>
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
        document.addEventListener("DOMContentLoaded", function() {
            var label = document.querySelector("label[for='main_image']").textContent;
            var tooltipMessage = "Allowed max 2MB and only JPG, PNG, GIF files are allowed.";
            var tooltipTitle =  tooltipMessage;
            var inputElement = document.querySelector("input[name='main_image']");
            inputElement.setAttribute("title", tooltipTitle);
        });
    </script>
    <script>
        var IMAGE_UPLOAD_URL = '/vehicle-image-upload'
        var IMAGE_DELETE_URL = '/vehicle-image-delete'
        var DOCUMENT_UPLOAD_URL = '/vehicle-document-upload'
        var DOCUMENT_DELETE_URL = '/vehicle-document-delete'
        $('.dropify').dropify();
    </script>
    <script src="{{URL::asset('web/assets/custom/vehicle/imageUploader.js')}}?v={{ time() }}"></script>
    <script src="{{asset('web/assets/custom/vehicle/vehicle.js')}}?v={{time()}}"></script>
@endsection
