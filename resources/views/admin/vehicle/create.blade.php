@extends('admin.layouts2.simple.master')
@section('content')
    <div class="content d-flex flex-column flex-column-fluid" id="kt_content">
        <div class="toolbar" id="kt_toolbar">
            <div id="kt_toolbar_container" class="container-fluid d-flex flex-stack">
                @include('admin.layouts2.components.bread-crumbs',['main_name'=>'Add Vehicle'])
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
                                </div>
                                <div class="row">
                                    <div class="mb-3 col-md-6">
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
                                    <div class="mb-3 col-md-6">
                                        <div class="fv-row mb-7 fv-plugins-icon-container">
                                            <label class="required fs-6 fw-bold mb-2">User</label>
                                            <select class="form-select form-select-solid fw-bold" name="user_id"
                                                    id="user_id">
                                                <option value="">Select Option</option>
                                                @foreach($users as $user)
                                                    <option
                                                        value="{{$user->id}}">{{$user->name .' ' . $user->last_name}} ({{$user->email .'/' . $user->contact_no}}) </option>
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
                                                       class="required fs-6 fw-bold mb-2">{{ $language['name'] }} Make
                                                </label>
                                                <input type="text" class="form-control form-control-solid"
                                                       name="{{ $language['language_code'] }}_make"
                                                       id="{{ $language['language_code'] }}_make"
                                                       @if($language['is_rtl']==1) dir="rtl" @endif
                                                       placeholder="{{ $language['name'] }} Make"
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
                                                       class="required fs-6 fw-bold mb-2">{{ $language['name'] }} Model
                                                </label>
                                                <input type="text" class="form-control form-control-solid"
                                                       name="{{ $language['language_code'] }}_model"
                                                       id="{{ $language['language_code'] }}_model"
                                                       @if($language['is_rtl']==1) dir="rtl" @endif
                                                       placeholder="{{ $language['name'] }} Model"
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
                                                       class="required fs-6 fw-bold mb-2">{{ $language['name'] }} Trim
                                                </label>
                                                <input type="text" class="form-control form-control-solid"
                                                       name="{{ $language['language_code'] }}_trim"
                                                       id="{{ $language['language_code'] }}_trim"
                                                       @if($language['is_rtl']==1) dir="rtl" @endif
                                                       placeholder="{{ $language['name'] }} Trim"
                                                       required/>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>

                                <div class="row">
                                    <div class="mb-3 col-md-6">
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
                                    <div class="mb-3 col-md-6">
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
                                </div>
                                <div class="row">
                                    @foreach($languages as $language)
                                        <div class="mb-3 col-md-6">
                                            <div class="fv-row mb-7 fv-plugins-icon-container">
                                                <label for="{{ $language['language_code'] }}_transmission"
                                                       class="required fs-6 fw-bold mb-2">{{ $language['name'] }}
                                                    Transmission
                                                </label>
                                                <input type="text" class="form-control form-control-solid"
                                                       name="{{ $language['language_code'] }}_transmission"
                                                       id="{{ $language['language_code'] }}_transmission"
                                                       @if($language['is_rtl']==1) dir="rtl" @endif
                                                       placeholder="{{ $language['name'] }} Transmission"
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
                                                       class="required fs-6 fw-bold mb-2">{{ $language['name'] }} Fuel
                                                    Type
                                                </label>
                                                <input type="text" class="form-control form-control-solid"
                                                       name="{{ $language['language_code'] }}_fuel_type"
                                                       id="{{ $language['language_code'] }}_fuel_type"
                                                       @if($language['is_rtl']==1) dir="rtl" @endif
                                                       placeholder="{{ $language['name'] }} Fuel Type"
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
                                                       class="required fs-6 fw-bold mb-2">{{ $language['name'] }} Body
                                                    Type
                                                </label>
                                                <input type="text" class="form-control form-control-solid"
                                                       name="{{ $language['language_code'] }}_body_type"
                                                       id="{{ $language['language_code'] }}_body_type"
                                                       @if($language['is_rtl']==1) dir="rtl" @endif
                                                       placeholder="{{ $language['name'] }} Body Type"
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
                                                    Registration
                                                </label>
                                                <input type="text" class="form-control form-control-solid"
                                                       name="{{ $language['language_code'] }}_registration"
                                                       id="{{ $language['language_code'] }}_registration"
                                                       @if($language['is_rtl']==1) dir="rtl" @endif
                                                       placeholder="{{ $language['name'] }} Registration"
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
                                                    Exterior Color
                                                </label>
                                                <input type="text" class="form-control form-control-solid"
                                                       name="{{ $language['language_code'] }}_color"
                                                       id="{{ $language['language_code'] }}_color"
                                                       @if($language['is_rtl']==1) dir="rtl" @endif
                                                       placeholder="{{ $language['name'] }} Exterior Color"
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
                                                       class="required fs-6 fw-bold mb-2">{{ $language['name'] }} Car
                                                    Type
                                                </label>
                                                <input type="text" class="form-control form-control-solid"
                                                       name="{{ $language['language_code'] }}_car_type"
                                                       id="{{ $language['language_code'] }}_car_type"
                                                       @if($language['is_rtl']==1) dir="rtl" @endif
                                                       placeholder="{{ $language['name'] }} Car Type"
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
                                                    Mileage
                                                </label>
                                                <input type="text" class="form-control form-control-solid"
                                                       name="{{ $language['language_code'] }}_mileage"
                                                       id="{{ $language['language_code'] }}_mileage"
                                                       @if($language['is_rtl']==1) dir="rtl" @endif
                                                       placeholder="{{ $language['name'] }} Mileage"
                                                       required/>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>

                                <div class="row">
                                    <div class="mb-3 col-md-6">
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

                                    <div class="mb-3 col-md-6">
                                        <div class="fv-row mb-7 fv-plugins-icon-container">
                                            <label class="required fs-6 fw-bold mb-2" for="price">
                                                Price
                                            </label>
                                            <input type="text" class="form-control form-control-solid"
                                                   name="price"
                                                   id="price"
                                                   placeholder="Price"/>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="mb-3 col-md-6">
                                        <div class="fv-row mb-7 fv-plugins-icon-container">
                                            <label class="required fs-6 fw-bold mb-2" for="auction_start_date">
                                                Auction Start Date
                                            </label>
                                            <input type="date" class="form-control form-control-solid"
                                                   name="auction_start_date"
                                                   id="auction_start_date"
                                                   placeholder="Auction Start Date"/>
                                        </div>
                                    </div>
                                    <div class="mb-3 col-md-6">
                                        <div class="fv-row mb-7 fv-plugins-icon-container">
                                            <label class="required fs-6 fw-bold mb-2" for="auction_end_date">
                                                Auction End Date
                                            </label>
                                            <input type="date" class="form-control form-control-solid"
                                                   name="auction_end_date"
                                                   id="auction_end_date"
                                                   placeholder="Auction End Date"/>
                                        </div>
                                    </div>
                                </div>


                                {{--                                <div class="row">--}}
                                {{--                                    <div class="mb-3 col-md-6">--}}
                                {{--                                        <div class="fv-row mb-7 fv-plugins-icon-container">--}}
                                {{--                                            <label class="required fs-6 fw-bold mb-2" for="auction_end_time">--}}
                                {{--                                                Auction End Time--}}
                                {{--                                            </label>--}}
                                {{--                                            <input type="time" class="form-control form-control-solid"--}}
                                {{--                                                   name="auction_end_time"--}}
                                {{--                                                   id="auction_end_time"--}}
                                {{--                                                   placeholder="Auction End Time"/>--}}
                                {{--                                        </div>--}}
                                {{--                                    </div>--}}
                                {{--                                </div>--}}

                                <div class="row">
                                    {{--                                    <div class="mb-3 col-md-6">--}}
                                    {{--                                        <div class="fv-row mb-7 fv-plugins-icon-container">--}}
                                    {{--                                            <label class="required fs-6 fw-bold mb-2" for="minimumBidIncrement">--}}
                                    {{--                                                Minimum Bid Increment Price--}}
                                    {{--                                            </label>--}}
                                    {{--                                            <input type="text" class="form-control form-control-solid integer"--}}
                                    {{--                                                   name="minimumBidIncrement"--}}
                                    {{--                                                   id="minimumBidIncrement"--}}
                                    {{--                                                   placeholder="Minimum Bid Increment Price"/>--}}
                                    {{--                                        </div>--}}
                                    {{--                                    </div>--}}
                                    <div class="mt-5 mb-3 col-md-2">
                                        <div class="fv-row mb-7 fv-plugins-icon-container">
                                            <input
                                                class="form-check-input h-20px w-20px"
                                                value="1" name="is_product"
                                                id="is_product"
                                                type="radio" data-bs-original-title=""
                                                title="">
                                            <label class="form-check-label fw-bold"
                                                   for="is-quantity-1">Is Featured</label>
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
                                                   for="is-quantity-1">Is Popular</label>
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
                                                   for="is-quantity-1">Hot Deal</label>
                                        </div>
                                    </div>
                                    <div class="mb-3 col-md-6">
                                        <div class="fv-row mb-7 fv-plugins-icon-container">
                                            <label class="required fs-6 fw-bold mb-2" for="bid_increment">
                                                Bid Increment Price
                                            </label>
                                            <input type="text" class="form-control form-control-solid integer"
                                                   name="bid_increment"
                                                   id="bid_increment"
                                                   placeholder="Bid Increment Price"/>
                                        </div>
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
                                               class="required fs-6 fw-bold mb-2">{{ $language['name'] }} Description
                                        </label>
                                        <textarea class="form-control"
                                                  name="{{ $language['language_code'] }}_description"
                                                  id="{{ $language['language_code'] }}_description"
                                                  @if($language['is_rtl']==1) dir="rtl" @endif></textarea>
                                    </div>
                                @endforeach

                                <div class="fv-row mb-7 fv-plugins-icon-container">
                                    <label class=" fs-6 fw-bold mb-2"
                                           for="image">Image
                                    </label><br>
                                    @include('admin.layouts2.components.image-selection',
                                      [
                                      'id'=>'image',
                                      'description_string'=>'',
                                      ])
                                </div>

                                <div class="form-group">
                                    <label class="required fs-6 fw-bold" for="image">Multiple Image
                                        <span
                                            class="error"></span></label><br>
                                    <div id="fine-uploader"></div>
                                </div>

                            </div>

                            <div class="card-footer text-end p-3 btn-showcase">
                                <button class="btn btn-primary" type="submit">
                                    Submit
                                </button>
                                <a href="{{ route('admin.vehicle.index') }}">
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
