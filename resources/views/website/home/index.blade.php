@extends('website.layouts.master')
@section('content')
{{--    <section id="hero">--}}
{{--        <div class="container">--}}
{{--            <div class="row">--}}
{{--                <div class="col-md-12">--}}
{{--                    <div class="heading">--}}
{{--                        <h1>100% Online Auto Auctions</h1>--}}
{{--                        <p>Featuring thousands of Used and Salvage Cars, Trucks & SUVs for Sale</p>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--                <div class="col-md-4">--}}
{{--                    <div class="steps-box">--}}
{{--                        <h4>Register</h4>--}}
{{--                        <p>Sign up for a Copart Middle East Standard or Premier Membership</p>--}}
{{--                        <span>1</span>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--                <div class="clearfix"></div>--}}
{{--                <div class="col-md-4">--}}
{{--                    <div class="steps-box">--}}
{{--                        <h4>Find</h4>--}}
{{--                        <p>Search our large inventory of used & damaged vehicles</p>--}}
{{--                        <span>2</span>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--                <div class="clearfix"></div>--}}
{{--                <div class="col-md-4">--}}
{{--                    <div class="steps-box">--}}
{{--                        <h4>Bid</h4>--}}
{{--                        <p>Bid in our online auctions across the Middle East</p>--}}
{{--                        <span>3</span>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--                <div class="col-md-2 offset-6">--}}
{{--                    <div class="download-app text-center">--}}
{{--                        <a href="#"><img src="web/assets/images/app-store.png"></a>--}}
{{--                        <a href="#"><img src="web/assets/images/google-play.png"></a>--}}
{{--                        <p>Download Now</p>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--                <div class="clearfix"></div>--}}
{{--                <div class="col-md-12">--}}
{{--                    <div class="filter">--}}
{{--                        <div class="logo-icon">--}}
{{--                            <img src="web/assets/images/icon.png">--}}
{{--                        </div>--}}
{{--                        <div class="search-box">--}}
{{--                            <div class="input-group">--}}
{{--                                <input type="text" class="form-control" placeholder="Search by Make, Model or VIN">--}}
{{--                                <span class="input-group-text" id="basic-addon2"><i class="las la-search"></i></span>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                        <div class="filter-btn">--}}
{{--                            <button class="btn btn-filter">Filters--}}
{{--                                <i class="las la-angle-up"></i>--}}
{{--                            </button>--}}

{{--                        </div>--}}
{{--                        @if(is_null(Auth::user()))--}}
{{--                            <div class="login-btn">--}}
{{--                                <button class="btn btn-login" data-bs-toggle="modal" data-bs-target="#login">Login--}}
{{--                                </button>--}}
{{--                            </div>--}}
{{--                            <div class="reg-btn">--}}
{{--                                <button class="btn btn-register" data-bs-toggle="modal" data-bs-target="#signup">--}}
{{--                                    Registration--}}
{{--                                </button>--}}
{{--                            </div>--}}
{{--                        @else--}}
{{--                            <div class="user-login-info">--}}
{{--                                <div class="user-name">--}}
{{--                                    <p>Welcome <span>{{Auth::user()->full_name}}</span></p>--}}
{{--                                </div>--}}
{{--                                <div class="user-profile">--}}
{{--                                    <img src="{{asset('web/assets/images/profile-pic.jpg')}}" alt="profile">--}}
{{--                                </div>--}}
{{--                            </div>--}}

{{--                            <div class="login-btn">--}}
{{--                                <a class="btn btn-login" href="{{route('/logout')}}" style="background: #673AAA 0% 0% no-repeat padding-box">Logout--}}
{{--                                </a>--}}
{{--                            </div>--}}
{{--                        @endif--}}
{{--                        <div class="filter-pop">--}}
{{--                            <div class="f-head">--}}
{{--                                <p>Filters</p>--}}
{{--                                <a href="#">Reset All</a>--}}
{{--                            </div>--}}
{{--                            <div class="f-body">--}}
{{--                                <div class="row">--}}
{{--                                    <div class="col-md-3">--}}
{{--                                        <label>Vehicle Condition</label>--}}
{{--                                        <div class="checkbox-group">--}}
{{--                                            <div class="form-check">--}}
{{--                                                <input class="form-check-input" type="checkbox" value="" id="used">--}}
{{--                                                <label class="form-check-label" for="used">--}}
{{--                                                    Used--}}
{{--                                                </label>--}}
{{--                                            </div>--}}
{{--                                            <div class="form-check">--}}
{{--                                                <input class="form-check-input" type="checkbox" value="" id="new">--}}
{{--                                                <label class="form-check-label" for="new">--}}
{{--                                                    New--}}
{{--                                                </label>--}}
{{--                                            </div>--}}
{{--                                        </div>--}}
{{--                                    </div>--}}
{{--                                    <div class="col-md-3">--}}
{{--                                        <label>Category</label>--}}
{{--                                        <div class="category">--}}
{{--                                            <select class="form-select" aria-label="Default select example">--}}
{{--                                                <option selected>Select Category</option>--}}
{{--                                                <option value="1">Category 1</option>--}}
{{--                                                <option value="2">Category 2</option>--}}
{{--                                                <option value="3">Category 3</option>--}}
{{--                                            </select>--}}
{{--                                        </div>--}}
{{--                                    </div>--}}
{{--                                    <div class="col-md-3">--}}
{{--                                        <div class="price-range-slider">--}}
{{--                                            <p class="range-value">--}}
{{--                                                Price Range--}}
{{--                                                <input type="text" id="amount" readonly>--}}
{{--                                            </p>--}}
{{--                                            <div id="slider-range" class="range-bar"></div>--}}
{{--                                        </div>--}}
{{--                                    </div>--}}
{{--                                    <div class="col-md-3">--}}
{{--                                        <div class="price-range-slider">--}}
{{--                                            <p class="range-value">--}}
{{--                                                Price Range--}}
{{--                                                <input type="text" id="year" readonly>--}}
{{--                                            </p>--}}
{{--                                            <div id="year-range" class="range-bar"></div>--}}
{{--                                        </div>--}}
{{--                                    </div>--}}
{{--                                    <div class="col-md-3">--}}
{{--                                        <label>Select Model</label>--}}
{{--                                        <div class="category">--}}
{{--                                            <select class="form-select" aria-label="Default select example">--}}
{{--                                                <option selected>Make and Model</option>--}}
{{--                                                <option value="1">Model 1</option>--}}
{{--                                                <option value="2">Model 2</option>--}}
{{--                                                <option value="3">Model 3</option>--}}
{{--                                            </select>--}}
{{--                                        </div>--}}
{{--                                    </div>--}}
{{--                                    <div class="col-md-3">--}}
{{--                                        <label>Body Type</label>--}}
{{--                                        <div class="category">--}}
{{--                                            <select class="form-select" aria-label="Default select example">--}}
{{--                                                <option selected>Select Body Type</option>--}}
{{--                                                <option value="1">Body Type 1</option>--}}
{{--                                                <option value="2">Body Type 2</option>--}}
{{--                                                <option value="3">Body Type 3</option>--}}
{{--                                            </select>--}}
{{--                                        </div>--}}
{{--                                    </div>--}}
{{--                                    <div class="col-md-6">--}}
{{--                                        <label>Exterior Type</label>--}}
{{--                                        <div class="checkbox-group color-check">--}}
{{--                                            <div class="form-check">--}}
{{--                                                <input class="form-check-input" type="checkbox" value="" id="white">--}}
{{--                                                <label class="form-check-label" for="white">--}}
{{--                                                    White--}}
{{--                                                </label>--}}
{{--                                            </div>--}}
{{--                                            <span class="hr"></span>--}}
{{--                                            <div class="form-check">--}}
{{--                                                <input class="form-check-input" type="checkbox" value="" id="black">--}}
{{--                                                <label class="form-check-label" for="black">--}}
{{--                                                    Black--}}
{{--                                                </label>--}}
{{--                                            </div>--}}
{{--                                            <span class="hr"></span>--}}
{{--                                            <div class="form-check">--}}
{{--                                                <input class="form-check-input" type="checkbox" value="" id="grey">--}}
{{--                                                <label class="form-check-label" for="grey">--}}
{{--                                                    Grey--}}
{{--                                                </label>--}}
{{--                                            </div>--}}
{{--                                            <span class="hr"></span>--}}
{{--                                            <div class="form-check">--}}
{{--                                                <input class="form-check-input" type="checkbox" value="" id="silver">--}}
{{--                                                <label class="form-check-label" for="silver">--}}
{{--                                                    Silver--}}
{{--                                                </label>--}}
{{--                                            </div>--}}
{{--                                        </div>--}}
{{--                                    </div>--}}
{{--                                    <div class="col-md-6">--}}
{{--                                        <label>Exterior Type</label>--}}
{{--                                        <div class="checkbox-group color-check">--}}
{{--                                            <div class="form-check">--}}
{{--                                                <input class="form-check-input" type="checkbox" value="" id="warranty">--}}
{{--                                                <label class="form-check-label" for="warranty">--}}
{{--                                                    Warranty Available--}}
{{--                                                </label>--}}
{{--                                            </div>--}}
{{--                                            <span class="hr"></span>--}}
{{--                                            <div class="form-check">--}}
{{--                                                <input class="form-check-input" type="checkbox" value="" id="history">--}}
{{--                                                <label class="form-check-label" for="history">--}}
{{--                                                    History Available--}}
{{--                                                </label>--}}
{{--                                            </div>--}}
{{--                                        </div>--}}
{{--                                    </div>--}}
{{--                                    <div class="col-md-3">--}}
{{--                                        <div class="price-range-slider">--}}
{{--                                            <p class="range-value">--}}
{{--                                                Seller Ratings--}}
{{--                                                <input type="text" id="ratings" readonly>--}}
{{--                                            </p>--}}
{{--                                            <div id="ratings-range" class="range-bar"></div>--}}
{{--                                        </div>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </section>--}}
    <section id="vehicles" class="featured-vehicles">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="heading">
                        <h1>Featured Vehicles</h1>
                        <a href="#">View All</a>
                    </div>
                </div>
                <div class="clearfix"></div>
                <div class="col-md-12">
                    @foreach($vehicles as $vehicle)
                        <div class="details-box">
                            <div class="car-img">
                                <img src="{{asset($vehicle->main_image)}}" align="car">
                                <span class="cat-tags">
                                    <img src="{{asset('web/assets/images/dymand.png')}}"> Featured</span>
                                <a href="#" class="like"><i class="las la-heart"></i></a>
                            </div>
                            <div class="car-name">
                                <div class="names">
                                    <h3>{{$vehicle->vehicle_name}}</h3>
                                    <p>{{$vehicle->category_name}}</p>
                                </div>
                            </div>
                            <div class="car-specifation">
                                <div class="car-dt">
                                    <div class="icon">
                                        <img src="{{asset('web/assets/images/road.png')}}" align="road">
                                    </div>
                                    <div class="detsl">
                                        {{$vehicle->kms_driven}}
                                    </div>
                                </div>
                                <div class="car-dt">
                                    <div class="icon">
                                        <img src="{{asset('web/assets/images/km.png')}}" align="km">
                                    </div>
                                    <div class="detsl">
                                        {{$vehicle->mileage}}
                                    </div>
                                </div>
                                <div class="car-dt">
                                    <div class="icon">
                                        <img src="{{asset('web/assets/images/petrol.png')}}" align="petrol">
                                    </div>
                                    <div class="detsl">
                                        {{$vehicle->fuel_type}}
                                    </div>
                                </div>
                                <div class="car-dt">
                                    <div class="icon">
                                        <img src="{{asset('web/assets/images/auto.png')}}" align="auto">
                                    </div>
                                    <div class="detsl">
                                        {{$vehicle->body_type}}
                                    </div>
                                </div>
                            </div>
                            <div class="car-price">
                                <span>Bid Start on <b>{{Carbon\Carbon::parse($vehicle->auction_start_date)->format('d M Y')}}</b></span>
                                <div class="initial-price-box">
                                    <p>Initial Price</p>
                                    <h3>SAR {{number_format($vehicle->price)}}</h3>
                                </div>
                                <a href="#" class="place-bid-blue vehicle_detail" data-id="{{$vehicle->id}}">Place
                                    Bid</a>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="heading">
                        <h1>Popular Vehicles</h1>
                        <a href="#">View All</a>
                    </div>
                </div>
                <div class="clearfix"></div>
                <div class="col-md-12">
                    @foreach($vehicles as $vehicle)
                        <div class="details-box">
                            <div class="car-img">
                                <img src="{{asset($vehicle->main_image)}}" align="car">
                                <span class="cat-tags">
                                    <img src="{{asset('web/assets/images/dymand.png')}}"> Featured</span>
                                <a href="#" class="like"><i class="las la-heart"></i></a>
                            </div>
                            <div class="car-name">
                                <div class="names">
                                    <h3>{{$vehicle->vehicle_name}}</h3>
                                    <p>{{$vehicle->category_name}}</p>
                                </div>
                            </div>
                            <div class="car-specifation">
                                <div class="drive">
                                    <div class="icon"></div>
                                </div>
                                <div class="car-dt">
                                    <div class="icon">
                                        <img src="web/assets/images/road.png" align="road">
                                    </div>
                                    <div class="detsl">
                                        {{$vehicle->kms_driven}}
                                    </div>
                                </div>
                                <div class="car-dt">
                                    <div class="icon">
                                        <img src="web/assets/images/km.png" align="km">
                                    </div>
                                    <div class="detsl">
                                        {{$vehicle->mileage}}
                                    </div>
                                </div>
                                <div class="car-dt">
                                    <div class="icon">
                                        <img src="web/assets/images/petrol.png" align="petrol">
                                    </div>
                                    <div class="detsl">
                                        {{$vehicle->fuel_type}}
                                    </div>
                                </div>
                                <div class="car-dt">
                                    <div class="icon">
                                        <img src="web/assets/images/auto.png" align="auto">
                                    </div>
                                    <div class="detsl">
                                        {{$vehicle->body_type}}
                                    </div>
                                </div>
                            </div>
                            <div class="car-price">
                                <span>Bid Start on <b>15th Sep 2023</b></span>
                                <div class="initial-price-box">
                                    <p>Initial Price</p>
                                    <h3>SAR {{number_format($vehicle->price)}}</h3>
                                </div>
                                <a href="#" class="place-bid-blue vehicle_detail" data-id="{{$vehicle->id}}">Place
                                    Bid</a>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="heading">
                        <h1>Hot Deals</h1>
                        <a href="#">View All</a>
                    </div>
                </div>
                <div class="clearfix"></div>
                <div class="col-md-12">
                    @foreach($vehicles as $vehicle)
                        <div class="details-box">
                            <div class="car-img">
                                <img src="{{asset($vehicle->main_image)}}" align="car">
                                <span class="cat-tags">
                                    <img src="{{asset('web/assets/images/dymand.png')}}"> Featured</span>
                                <a href="#" class="like"><i class="las la-heart"></i></a>
                            </div>
                            <div class="car-name">
                                <div class="names">
                                    <h3>{{$vehicle->vehicle_name}}</h3>
                                    <p>{{$vehicle->category_name}}</p>
                                </div>
                            </div>
                            <div class="car-specifation">
                                <div class="drive">
                                    <div class="icon"></div>
                                </div>
                                <div class="car-dt">
                                    <div class="icon">
                                        <img src="web/assets/images/road.png" align="road">
                                    </div>
                                    <div class="detsl">
                                        {{$vehicle->kms_driven}}
                                    </div>
                                </div>
                                <div class="car-dt">
                                    <div class="icon">
                                        <img src="web/assets/images/km.png" align="km">
                                    </div>
                                    <div class="detsl">
                                        {{$vehicle->mileage}}
                                    </div>
                                </div>
                                <div class="car-dt">
                                    <div class="icon">
                                        <img src="web/assets/images/petrol.png" align="petrol">
                                    </div>
                                    <div class="detsl">
                                        {{$vehicle->fuel_type}}
                                    </div>
                                </div>
                                <div class="car-dt">
                                    <div class="icon">
                                        <img src="web/assets/images/auto.png" align="auto">
                                    </div>
                                    <div class="detsl">
                                        {{$vehicle->body_type}}
                                    </div>
                                </div>
                            </div>
                            <div class="car-price">
                                <span>Bid Start on <b>15th Sep 2023</b></span>
                                <div class="initial-price-box">
                                    <p>Initial Price</p>
                                    <h3>SAR {{number_format($vehicle->price)}}</h3>
                                </div>
                                <a href="#" class="place-bid-blue vehicle_detail" data-id="{{$vehicle->id}}">Place
                                    Bid</a>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </section>
    <section id="howworks">
        <div class="container">
            <div class="row">
                <div class="col-md-12 text-center">
                    <div class="title">
                        <h1>How it Works</h1>
                    </div>
                </div>
                <div class="clearfix"></div>
                <div class="col-md-4">
                    <div class="work-box">
                        <span>1</span>
                        <h2>Register</h2>
                        <p>Sign up for a Copart Middle East Standard or Premier Membership</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="work-box">
                        <span>2</span>
                        <h2>Find</h2>
                        <p>Search our large inventory of used & damaged vehicles</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="work-box">
                        <span>3</span>
                        <h2>Bid</h2>
                        <p>Bid in our online auctionsacross the Middle East</p>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section id="testimonial">
        <div class="container">
            <div class="row">
                <div class="col-md-12 text-center">
                    <div class="title">
                        <h1>Testimonial</h1>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="testimonial">
                        <div class="container">
                            <div class="testimonial__inner">
                                <div class="testimonial-slider">
                                    <div class="testimonial-slide">
                                        <div class="testimonial_box">
                                            <div class="testimonial_box-inner">
                                                <div class="testimonial_box-top">
                                                    <div class="testimonial_box-icon">
                                                        <img src="web/assets/images/quotes.svg">
                                                    </div>
                                                    <div class="testimonial_box-text">
                                                        <p>Lorem Ipsum is simply dummy text of the printing and
                                                            typesetting industry. Lorem Ipsum has been the industry's
                                                            standard dummy text ever since the 1500s.</p>
                                                    </div>
                                                    <div class="testimonial_box-name">
                                                        <h4>Durriyah Abida</h4>
                                                    </div>
                                                    <div class="testimonial_box-job">
                                                        <p>Oman</p>
                                                    </div>
                                                    <div class="testimonial_box-img">
                                                        <img src="https://i.ibb.co/hKgs8gm/profile.jpg" alt="profile">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="testimonial-slide">
                                        <div class="testimonial_box">
                                            <div class="testimonial_box-inner">
                                                <div class="testimonial_box-top">
                                                    <div class="testimonial_box-icon">
                                                        <img src="web/assets/images/quotes.svg">
                                                    </div>
                                                    <div class="testimonial_box-text">
                                                        <p>Lorem Ipsum is simply dummy text of the printing and
                                                            typesetting industry. Lorem Ipsum has been the industry's
                                                            standard dummy text ever since the 1500s.</p>
                                                    </div>
                                                    <div class="testimonial_box-name">
                                                        <h4>Durriyah Abida</h4>
                                                    </div>
                                                    <div class="testimonial_box-job">
                                                        <p>Oman</p>
                                                    </div>
                                                    <div class="testimonial_box-img">
                                                        <img src="https://i.ibb.co/hKgs8gm/profile.jpg" alt="profile">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="testimonial-slide">
                                        <div class="testimonial_box">
                                            <div class="testimonial_box-inner">
                                                <div class="testimonial_box-top">
                                                    <div class="testimonial_box-icon">
                                                        <img src="web/assets/images/quotes.svg">
                                                    </div>
                                                    <div class="testimonial_box-text">
                                                        <p>Lorem Ipsum is simply dummy text of the printing and
                                                            typesetting industry. Lorem Ipsum has been the industry's
                                                            standard dummy text ever since the 1500s.</p>
                                                    </div>
                                                    <div class="testimonial_box-name">
                                                        <h4>Durriyah Abida</h4>
                                                    </div>
                                                    <div class="testimonial_box-job">
                                                        <p>Oman</p>
                                                    </div>
                                                    <div class="testimonial_box-img">
                                                        <img src="https://i.ibb.co/hKgs8gm/profile.jpg" alt="profile">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="testimonial-slide">
                                        <div class="testimonial_box">
                                            <div class="testimonial_box-inner">
                                                <div class="testimonial_box-top">
                                                    <div class="testimonial_box-icon">
                                                        <img src="web/assets/images/quotes.svg">
                                                    </div>
                                                    <div class="testimonial_box-text">
                                                        <p>Lorem Ipsum is simply dummy text of the printing and
                                                            typesetting industry. Lorem Ipsum has been the industry's
                                                            standard dummy text ever since the 1500s.</p>
                                                    </div>
                                                    <div class="testimonial_box-name">
                                                        <h4>Durriyah Abida</h4>
                                                    </div>
                                                    <div class="testimonial_box-job">
                                                        <p>Oman</p>
                                                    </div>
                                                    <div class="testimonial_box-img">
                                                        <img src="https://i.ibb.co/hKgs8gm/profile.jpg" alt="profile">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </section>

    <section id="news">
        <div class="container">
            <div class="row">
                <div class="col-md-12 text-center">
                    <div class="title ">
                        <h1 class="text-white">News</h1>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="testimonial">
                        <div class="container">
                            <div class="testimonial__inner">
                                <div class="testimonial-slider">
                                    <div class="testimonial-slide">
                                        <div class="testimonial_box">
                                            <div class="testimonial_box-inner">
                                                <div class="testimonial_box-top">
                                                    <div class="testimonial_box-text">
                                                        <div class="date">
                                                            <span>Aug 20, 2023</span>
                                                        </div>
                                                        <h1>'lorem ipsum' will uncover many web sites still in their
                                                            infancy</h1>
                                                        <p>Lorem Ipsum is simply dummy text of the printing and
                                                            typesetting industry. Lorem Ipsum has been the industry's
                                                            standard dummy text ever since the 1500s.</p>
                                                        <a href="#">Read Now</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="testimonial-slide">
                                        <div class="testimonial_box">
                                            <div class="testimonial_box-inner">
                                                <div class="testimonial_box-top">
                                                    <div class="testimonial_box-text">
                                                        <div class="date">
                                                            <span>Aug 20, 2023</span>
                                                        </div>
                                                        <h1>'lorem ipsum' will uncover many web sites still in their
                                                            infancy</h1>
                                                        <p>Lorem Ipsum is simply dummy text of the printing and
                                                            typesetting industry. Lorem Ipsum has been the industry's
                                                            standard dummy text ever since the 1500s.</p>
                                                        <a href="#">Read Now</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="testimonial-slide">
                                        <div class="testimonial_box">
                                            <div class="testimonial_box-inner">
                                                <div class="testimonial_box-top">
                                                    <div class="testimonial_box-text">
                                                        <div class="date">
                                                            <span>Aug 20, 2023</span>
                                                        </div>
                                                        <h1>'lorem ipsum' will uncover many web sites still in their
                                                            infancy</h1>
                                                        <p>Lorem Ipsum is simply dummy text of the printing and
                                                            typesetting industry. Lorem Ipsum has been the industry's
                                                            standard dummy text ever since the 1500s.</p>
                                                        <a href="#">Read Now</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="testimonial-slide">
                                        <div class="testimonial_box">
                                            <div class="testimonial_box-inner">
                                                <div class="testimonial_box-top">
                                                    <div class="testimonial_box-text">
                                                        <div class="date">
                                                            <span>Aug 20, 2023</span>
                                                        </div>
                                                        <h1>'lorem ipsum' will uncover many web sites still in their
                                                            infancy</h1>
                                                        <p>Lorem Ipsum is simply dummy text of the printing and
                                                            typesetting industry. Lorem Ipsum has been the industry's
                                                            standard dummy text ever since the 1500s.</p>
                                                        <a href="#">Read Now</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </section>
    <div class="clearfix"></div>

@endsection
@section('custom-script')
    <script>
        $('.vehicle_detail').on('click', function () {
            const value_id = $(this).data('id')
            loaderView()
            axios
                .get(APP_URL + '/vehicle-details' + '/' + value_id)
                .then(function (response) {
                    $('#vehicle_detail_title').html(response.data.modal_title)
                    $('#vehicle_detail_body').html(response.data.data)

                    $('#carderails').modal('show')
                    var mySwiper = new Swiper('.swiper-container', {
                        speed: 400,
                        loop: true,
                        slidesPerView: 1,
                        calculateHeight: true,
                        spaceBetween: 50,
                        watchActiveIndex: true,
                        prevButton: '.swiper-button-prev',
                        nextButton: '.swiper-button-next'
                    })

                    loaderHide()
                })
                .catch(function (error) {
                    loaderHide()
                })
        })
    </script>
@endsection
