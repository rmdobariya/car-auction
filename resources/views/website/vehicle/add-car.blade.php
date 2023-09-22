@extends('website.layouts.master')
@section('content')
    <section id="vehicles" class="featured-vehicles">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="heading auction-detailss">
                        <h1>Car Details</h1>
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
                                                       class="required fs-6 fw-bold mb-2">{{ $language['name'] }} Name
                                                </label>
                                                <input type="text" class="form-control form-control-solid"
                                                       name="{{ $language['language_code'] }}_name"
                                                       id="{{ $language['language_code'] }}_name"
                                                       @if($language['is_rtl']==1) dir="rtl" @endif
                                                       placeholder="{{ $language['name'] }} {{ trans('admin_string.common_name') }}"
                                                       required/>
                                            </div>
                                        </div>
                                    @endforeach
                                    <div class="mb-1 col-md-4">
                                        <div class="fv-row mb-7 fv-plugins-icon-container">
                                            <label class="required fs-6 fw-bold mb-2">Vehicle Category</label>
                                            <select class="form-select form-select-solid fw-bold"
                                                    name="vehicle_category_id"
                                                    id="vehicle_category_id">
                                                <option value="">Select Option</option>
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
                                                Year
                                            </label>
                                            <input type="text" class="form-control form-control-solid"
                                                   name="year"
                                                   id="year"
                                                   placeholder="Year"/>
                                        </div>
                                    </div>
                                    <div class="mb-1 col-md-4">
                                        <div class="fv-row mb-7 fv-plugins-icon-container">
                                            <label class="required fs-6 fw-bold mb-2" for="make">
                                                Make
                                            </label>
                                            <input type="text" class="form-control form-control-solid"
                                                   name="make"
                                                   id="make"
                                                   placeholder="Make"/>
                                        </div>
                                    </div>
                                    <div class="mb-1 col-md-4">
                                        <div class="fv-row mb-7 fv-plugins-icon-container">
                                            <label class="required fs-6 fw-bold mb-2" for="model">
                                                Model
                                            </label>
                                            <input type="text" class="form-control form-control-solid"
                                                   name="model"
                                                   id="model"
                                                   placeholder="Model"/>
                                        </div>
                                    </div>
                                    <div class="mb-1 col-md-4">
                                        <div class="fv-row mb-7 fv-plugins-icon-container">
                                            <label class="required fs-6 fw-bold mb-2" for="trim">
                                                Trim
                                            </label>
                                            <input type="text" class="form-control form-control-solid"
                                                   name="trim"
                                                   id="trim"
                                                   placeholder="Trim"/>
                                        </div>
                                    </div>
                                    <div class="mb-1 col-md-4">
                                        <div class="fv-row mb-7 fv-plugins-icon-container">
                                            <label class="required fs-6 fw-bold mb-2" for="kms_driven">
                                                KMs Driven
                                            </label>
                                            <input type="text" class="form-control form-control-solid"
                                                   name="kms_driven"
                                                   id="kms_driven"
                                                   placeholder="KMs Driven"/>
                                        </div>
                                    </div>
                                    <div class="mb-1 col-md-4">
                                        <div class="fv-row mb-7 fv-plugins-icon-container">
                                            <label class="required fs-6 fw-bold mb-2" for="owners">
                                                No Of Owners
                                            </label>
                                            <input type="text" class="form-control form-control-solid integer"
                                                   name="owners"
                                                   id="owners"
                                                   placeholder="No Of Owners"/>
                                        </div>
                                    </div>
                                    <div class="mb-1 col-md-4">
                                        <div class="fv-row mb-7 fv-plugins-icon-container">
                                            <label class="required fs-6 fw-bold mb-2" for="transmission">
                                                Transmission
                                            </label>
                                            <input type="text" class="form-control form-control-solid"
                                                   name="transmission"
                                                   id="transmission"
                                                   placeholder="Transmission"/>
                                        </div>
                                    </div>
                                    <div class="mb-1 col-md-4">
                                        <div class="fv-row mb-7 fv-plugins-icon-container">
                                            <label class="required fs-6 fw-bold mb-2" for="fuel_type">
                                                Fuel Type
                                            </label>
                                            <input type="text" class="form-control form-control-solid"
                                                   name="fuel_type"
                                                   id="fuel_type"
                                                   placeholder="Fuel Type"/>
                                        </div>
                                    </div>
                                    <div class="mb-1 col-md-4">
                                        <div class="fv-row mb-7 fv-plugins-icon-container">
                                            <label class="required fs-6 fw-bold mb-2" for="body_type">
                                                Body Type
                                            </label>
                                            <input type="text" class="form-control form-control-solid"
                                                   name="body_type"
                                                   id="body_type"
                                                   placeholder="Body Type"/>
                                        </div>
                                    </div>
                                    <div class="mb-1 col-md-4">
                                        <div class="fv-row mb-7 fv-plugins-icon-container">
                                            <label class="required fs-6 fw-bold mb-2" for="registration">
                                                Registration
                                            </label>
                                            <input type="text" class="form-control form-control-solid"
                                                   name="registration"
                                                   id="registration"
                                                   placeholder="Registration"/>
                                        </div>
                                    </div>
                                    <div class="mb-1 col-md-4">
                                        <div class="fv-row mb-7 fv-plugins-icon-container">
                                            <label class="required fs-6 fw-bold mb-2" for="mileage">
                                                Mileage
                                            </label>
                                            <input type="text" class="form-control form-control-solid"
                                                   name="mileage"
                                                   id="mileage"
                                                   placeholder="Mileage"/>
                                        </div>
                                    </div>
                                    <div class="mb-1 col-md-4">
                                        <div class="fv-row mb-7 fv-plugins-icon-container">
                                            <label class="required fs-6 fw-bold mb-2" for="color">
                                                Exterior Color
                                            </label>
                                            <input type="text" class="form-control form-control-solid"
                                                   name="color"
                                                   id="color"
                                                   placeholder="Exterior Color"/>
                                        </div>
                                    </div>
                                    <div class="mb-1 col-md-4">
                                        <div class="fv-row mb-7 fv-plugins-icon-container">
                                            <label class="required fs-6 fw-bold mb-2" for="car_type">
                                                Car Type
                                            </label>
                                            <input type="text" class="form-control form-control-solid"
                                                   name="car_type"
                                                   id="car_type"
                                                   placeholder="Car Type"/>
                                        </div>
                                    </div>

                                    @foreach($languages as $language)
                                        <div class="fv-row mb-7 fv-plugins-icon-container">
                                            <label for="{{ $language['language_code'] }}_short_description"
                                                   class="required fs-6 fw-bold mb-2">{{ $language['name'] }} Short
                                                Description
                                            </label>
                                            <input type="text" class="form-control form-control-solid"
                                                   name="{{ $language['language_code'] }}_short_description"
                                                   id="{{ $language['language_code'] }}_short_description"
                                                   @if($language['is_rtl']==1) dir="rtl" @endif
                                                   placeholder="{{ $language['name'] }} Short Description"
                                                   required/>
                                        </div>
                                    @endforeach

                                    @foreach($languages as $language)
                                        <div class="fv-row mb-7 fv-plugins-icon-container">
                                            <label for="{{ $language['language_code'] }}_description"
                                                   class="required fs-6 fw-bold mb-2">{{ $language['name'] }}
                                                Description
                                            </label>
                                            <textarea class="form-control"
                                                      name="{{ $language['language_code'] }}_description"
                                                      id="{{ $language['language_code'] }}_description"
                                                      @if($language['is_rtl']==1) dir="rtl" @endif></textarea>
                                        </div>
                                    @endforeach
                                    <div class="col-md-4">
                                        <div class="car-rating">
                                            <p>Rating</p>
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
                                        <div class="uploads">
                                            <div id="fileList"></div>
                                            <div class="upload-filess">
                                                <p>Upload Photos *</p>
                                                <span><i class="las la-plus"></i></span>
                                                <input type="file" name="main_image" id="file" multiple=""
                                                       onchange="javascript:updateList()">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div id="fine-uploader"></div>
                                </div>
                                <h1>Car Documents</h1>
                                <div class="row">
                                    <div class="row">
                                        <div id="fine-uploader-document"></div>
                                    </div>
                                </div>
                                <h1>Car Auction Details</h1>
                                <div class="row">
                                    <div class="mb-1 col-md-6">
                                        <div class="fv-row mb-7 fv-plugins-icon-container">
                                            <label class="required fs-6 fw-bold mb-2" for="price">
                                                Initial Price
                                            </label>
                                            <input type="text" name="price" class="form-control"
                                                   placeholder="Initial Price *">
                                        </div>
                                    </div>
                                    <div class="mb-1 col-md-6">
                                        <div class="fv-row mb-7 fv-plugins-icon-container">
                                            <label class="required fs-6 fw-bold mb-2" for="minimumBidIncrement">
                                                Minimum Bid Increment
                                            </label>
                                            <input type="text" name="minimumBidIncrement" class="form-control"
                                                   placeholder="Minimum Bid Increment *">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="mb-1 col-md-3">
                                        <div class="fv-row mb-7 fv-plugins-icon-container">
                                            <label class="required fs-6 fw-bold mb-2" for="auction_start_date">
                                                Start Date
                                            </label>
                                            <input type="date" name="auction_start_date" class="form-control"
                                                   placeholder="Auction Start Date">
                                        </div>
                                    </div>
                                    <div class="mb-1 col-md-3">
                                        <div class="fv-row mb-7 fv-plugins-icon-container">
                                            <label class="required fs-6 fw-bold mb-2" for="auction_start_date">
                                                Start Time
                                            </label>
                                            <input type="time" name="auction_start_time" class="form-control"
                                                   placeholder="Auction Start Time">
                                        </div>
                                    </div>
                                    <div class="mb-1 col-md-3">
                                        <div class="fv-row mb-7 fv-plugins-icon-container">
                                            <label class="required fs-6 fw-bold mb-2" for="auction_start_date">
                                                End Date
                                            </label>
                                            <input type="date" name="auction_end_date" class="form-control"
                                                   placeholder="Auction End Date">
                                        </div>
                                    </div>
                                    <div class="mb-1 col-md-3">
                                        <div class="fv-row mb-7 fv-plugins-icon-container">
                                            <label class="required fs-6 fw-bold mb-2" for="auction_start_date">
                                                End Time
                                            </label>
                                            <input type="time" name="auction_end_time" class="form-control"
                                                   placeholder="Auction End Time">
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-md-12 text-center">
                                        <button type="submit" class="place-bid-blue">Add Car to Auction</button>
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
    <script>
        var IMAGE_UPLOAD_URL = '/vehicle-image-upload'
        var IMAGE_DELETE_URL = '/vehicle-image-delete'
        var DOCUMENT_UPLOAD_URL = '/vehicle-document-upload'
        var DOCUMENT_DELETE_URL = '/vehicle-document-delete'
    </script>
    <script src="{{asset('web/assets/custom/vehicle/vehicle.js')}}?v={{time()}}"></script>
    <script src="{{URL::asset('web/assets/custom/vehicle/imageUploader.js')}}?v={{ time() }}"></script>
@endsection
