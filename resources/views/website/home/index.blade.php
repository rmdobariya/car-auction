@extends('website.layouts.master')
@section('content')
    <section id="vehicles" class="featured-vehicles">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="heading">
                        <h1>Cars for Sell</h1>
                        @if($car_for_sell_count > 3)
                            <a href="{{route('car-for-sell','car_for_sell')}}">View All</a>
                        @endif
                    </div>
                </div>
                <div class="clearfix"></div>
                <div class="col-md-12">
                    @foreach($sell_vehicles as $sell_vehicle)

                        @if(Auth::user())
                            @php
                                $count = DB::table('wish_lists')->where('vehicle_id', $sell_vehicle->id)->where('user_id', Auth::user()->id)->count()
                            @endphp
                        @else
                            @php
                                $count = 0;
                            @endphp
                        @endif

                        <div class="details-box">
                            <div class="car-img">
                                <img src="{{asset($sell_vehicle->main_image)}}" align="car">
                                <span class="cat-tags"><img
                                        src="{{asset('web/assets/images/dymand.png')}}"> Car For Sell</span>
                                @if(!is_null(Auth::user()))
                                    @if($sell_vehicle->user_id != Auth::user()->id)
                                        <a class="like" data-id="{{$sell_vehicle->id}}"
                                           data-user-id="{{Auth::user() ? Auth::user()->id : 0}}">
                                            @if($count == 0)
                                                <i class="lar la-heart"></i>
                                            @else
                                                <i class="las la-heart"></i>
                                            @endif
                                        </a>
                                    @endif
                                @else
                                    <a class="like" data-id="{{$sell_vehicle->id}}"
                                       data-user-id="{{Auth::user() ? Auth::user()->id : 0}}">
                                        <i class="lar la-heart"></i>
                                    </a>
                                @endif
                            </div>
                            <div class="car-name">
                                <div class="names">
                                    <h3>{{$sell_vehicle->vehicle_name}}</h3>
                                    <p>{{$sell_vehicle->category_name}}</p>
                                </div>
                            </div>
                            <div class="car-specifation">
                                <div class="car-dt">
                                    <div class="icon">
                                        <img src="{{asset('web/assets/images/road.png')}}" align="road">
                                    </div>
                                    <div class="detsl">
                                        {{$sell_vehicle->kms_driven}}
                                    </div>
                                </div>
                                <div class="car-dt">
                                    <div class="icon">
                                        <img src="{{asset('web/assets/images/km.png')}}" align="km">
                                    </div>
                                    <div class="detsl">
                                        {{$sell_vehicle->mileage}}
                                    </div>
                                </div>
                                <div class="car-dt">
                                    <div class="icon">
                                        <img src="{{asset('web/assets/images/petrol.png')}}" align="petrol">
                                    </div>
                                    <div class="detsl">
                                        {{$sell_vehicle->fuel_type}}
                                    </div>
                                </div>
                                <div class="car-dt">
                                    <div class="icon">
                                        <img src="{{asset('web/assets/images/auto.png')}}" align="auto">
                                    </div>
                                    <div class="detsl">
                                        {{$sell_vehicle->body_type}}
                                    </div>
                                </div>
                            </div>
                            <div class="car-price">
                                {{--                            <span>Bid Start on <b>{{Carbon\Carbon::parse($featured_vehicle->auction_start_date)->format('d M Y')}}</b></span>--}}
                                <div class="initial-price-box">
                                    <p>Initial Price</p>
                                    <h3>SAR {{number_format($sell_vehicle->price)}}</h3>
                                </div>
                                <a href="#" class="place-bid-blue car_inquiry" data-id="{{$sell_vehicle->id}}">Contact
                                    Seller</a>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="heading">
                        <h1>Featured Vehicles</h1>
                        @if($featured_vehicle_count > 3)
                            <a href="{{route('type-wise-car','is_featured')}}">View All</a>
                        @endif
                    </div>
                </div>
                <div class="clearfix"></div>
                <div class="col-md-12">
                    @foreach($featured_vehicles as $featured_vehicle)
                        @if(Auth::user())
                            @php
                                $count = DB::table('wish_lists')->where('vehicle_id', $featured_vehicle->id)->where('user_id', Auth::user()->id)->count()
                            @endphp
                        @else
                            @php
                                $count = 0;
                            @endphp
                        @endif
                        <div class="details-box">
                            <div class="car-img">
                                <img src="{{asset($featured_vehicle->main_image)}}" align="car">
                                <span class="cat-tags">
                                   <img src="{{asset('web/assets/images/dymand.png')}}"> Featured</span>
                                @if(!is_null(Auth::user()))
                                    @if($featured_vehicle->user_id != Auth::user()->id)
                                        <a class="like" data-id="{{$featured_vehicle->id}}"
                                           data-user-id="{{Auth::user() ? Auth::user()->id : 0}}">
                                            @if($count == 0)
                                                <i class="lar la-heart"></i>
                                            @else
                                                <i class="las la-heart"></i>
                                            @endif
                                        </a>
                                    @endif
                                @else
                                    <a class="like" data-id="{{$featured_vehicle->id}}"
                                       data-user-id="{{Auth::user() ? Auth::user()->id : 0}}">
                                        <i class="lar la-heart"></i>
                                    </a>
                                @endif
                            </div>
                            <div class="car-name">
                                <div class="names">
                                    <h3>{{$featured_vehicle->vehicle_name}}</h3>
                                    <p>{{$featured_vehicle->category_name}}</p>
                                </div>
                            </div>
                            <div class="car-specifation">
                                <div class="car-dt">
                                    <div class="icon">
                                        <img src="{{asset('web/assets/images/road.png')}}" align="road">
                                    </div>
                                    <div class="detsl">
                                        {{$featured_vehicle->kms_driven}}
                                    </div>
                                </div>
                                <div class="car-dt">
                                    <div class="icon">
                                        <img src="{{asset('web/assets/images/km.png')}}" align="km">
                                    </div>
                                    <div class="detsl">
                                        {{$featured_vehicle->mileage}}
                                    </div>
                                </div>
                                <div class="car-dt">
                                    <div class="icon">
                                        <img src="{{asset('web/assets/images/petrol.png')}}" align="petrol">
                                    </div>
                                    <div class="detsl">
                                        {{$featured_vehicle->fuel_type}}
                                    </div>
                                </div>
                                <div class="car-dt">
                                    <div class="icon">
                                        <img src="{{asset('web/assets/images/auto.png')}}" align="auto">
                                    </div>
                                    <div class="detsl">
                                        {{$featured_vehicle->body_type}}
                                    </div>
                                </div>
                            </div>
                            <div class="car-price">
                                <span>Bid Start on <b>{{Carbon\Carbon::parse($featured_vehicle->auction_start_date)->format('d M Y')}}</b></span>
                                <div class="initial-price-box">
                                    <p>Initial Price</p>
                                    <h3>SAR {{number_format($featured_vehicle->price)}}</h3>
                                </div>
                                <a href="#" class="place-bid-blue vehicle_detail" data-id="{{$featured_vehicle->id}}">Place
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
                        @if($popular_vehicle_count > 3)
                            <a href="{{route('type-wise-car','is_popular')}}">View All</a>
                        @endif
                    </div>
                </div>
                <div class="clearfix"></div>
                <div class="col-md-12">
                    @foreach($popular_vehicles as $popular_vehicle)
                        @if(Auth::user())
                            @php
                                $count = DB::table('wish_lists')->where('vehicle_id', $popular_vehicle->id)->where('user_id', Auth::user()->id)->count()
                            @endphp
                        @else
                            @php
                                $count = 0;
                            @endphp
                        @endif
                        <div class="details-box">
                            <div class="car-img">
                                <img src="{{asset($popular_vehicle->main_image)}}" align="car">
                                <span class="cat-tags">
                                   <img src="{{asset('web/assets/images/dymand.png')}}"> Popular</span>
                                @if(!is_null(Auth::user()))
                                    @if($popular_vehicle->user_id != Auth::user()->id)
                                        <a class="like" data-id="{{$popular_vehicle->id}}"
                                           data-user-id="{{Auth::user() ? Auth::user()->id : 0}}">
                                            @if($count == 0)
                                                <i class="lar la-heart"></i>
                                            @else
                                                <i class="las la-heart"></i>
                                            @endif
                                        </a>
                                    @endif
                                @else
                                    <a class="like" data-id="{{$popular_vehicle->id}}"
                                       data-user-id="{{Auth::user() ? Auth::user()->id : 0}}">
                                        <i class="lar la-heart"></i>
                                    </a>
                                @endif
                            </div>
                            <div class="car-name">
                                <div class="names">
                                    <h3>{{$popular_vehicle->vehicle_name}}</h3>
                                    <p>{{$popular_vehicle->category_name}}</p>
                                </div>
                            </div>
                            <div class="car-specifation">
                                <div class="drive">
                                    <div class="icon"></div>
                                </div>
                                <div class="car-dt">
                                    <div class="icon">
                                        <img src="{{asset('web/assets/images/road.png')}}" align="road">
                                    </div>
                                    <div class="detsl">
                                        {{$popular_vehicle->kms_driven}}
                                    </div>
                                </div>
                                <div class="car-dt">
                                    <div class="icon">
                                        <img src="{{asset('web/assets/images/km.png')}}" align="km">
                                    </div>
                                    <div class="detsl">
                                        {{$popular_vehicle->mileage}}
                                    </div>
                                </div>
                                <div class="car-dt">
                                    <div class="icon">
                                        <img src="{{asset('web/assets/images/petrol.png')}}" align="petrol">
                                    </div>
                                    <div class="detsl">
                                        {{$popular_vehicle->fuel_type}}
                                    </div>
                                </div>
                                <div class="car-dt">
                                    <div class="icon">
                                        <img src="{{asset('web/assets/images/auto.png')}}" align="auto">
                                    </div>
                                    <div class="detsl">
                                        {{$popular_vehicle->body_type}}
                                    </div>
                                </div>
                            </div>
                            <div class="car-price">
                                <span>Bid Start on <b>{{Carbon\Carbon::parse($popular_vehicle->auction_start_date)->format('d M Y')}}</b></span>
                                <div class="initial-price-box">
                                    <p>Initial Price</p>
                                    <h3>SAR {{number_format($popular_vehicle->price)}}</h3>
                                </div>
                                <a href="#" class="place-bid-blue vehicle_detail" data-id="{{$popular_vehicle->id}}">Place
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
                        @if($hot_deal_count > 3)
                            <a href="{{route('type-wise-car','is_hot_deal')}}">View All</a>
                        @endif
                    </div>
                </div>
                <div class="clearfix"></div>
                <div class="col-md-12">
                    @foreach($hot_deal_vehicles as $hot_deal_vehicle)
                        @if(Auth::user())
                            @php
                                $count = DB::table('wish_lists')->where('vehicle_id', $hot_deal_vehicle->id)->where('user_id', Auth::user()->id)->count()
                            @endphp
                        @else
                            @php
                                $count = 0;
                            @endphp
                        @endif
                        <div class="details-box">
                            <div class="car-img">
                                <img src="{{asset($hot_deal_vehicle->main_image)}}" align="car">
                                <span class="cat-tags">
                                   <img src="{{asset('web/assets/images/dymand.png')}}"> Hot Deal</span>
                                @if(!is_null(Auth::user()))
                                    @if($hot_deal_vehicle->user_id != Auth::user()->id)
                                        <a class="like" data-id="{{$hot_deal_vehicle->id}}"
                                           data-user-id="{{Auth::user() ? Auth::user()->id : 0}}">
                                            @if($count == 0)
                                                <i class="lar la-heart"></i>
                                            @else
                                                <i class="las la-heart"></i>
                                            @endif
                                        </a>
                                    @endif
                                @else
                                    <a class="like" data-id="{{$hot_deal_vehicle->id}}"
                                       data-user-id="{{Auth::user() ? Auth::user()->id : 0}}">
                                        <i class="lar la-heart"></i>
                                    </a>
                                @endif
                            </div>
                            <div class="car-name">
                                <div class="names">
                                    <h3>{{$hot_deal_vehicle->vehicle_name}}</h3>
                                    <p>{{$hot_deal_vehicle->category_name}}</p>
                                </div>
                            </div>
                            <div class="car-specifation">
                                <div class="drive">
                                    <div class="icon"></div>
                                </div>
                                <div class="car-dt">
                                    <div class="icon">
                                        <img src="{{asset('web/assets/images/road.png')}}" align="road">
                                    </div>
                                    <div class="detsl">
                                        {{$hot_deal_vehicle->kms_driven}}
                                    </div>
                                </div>
                                <div class="car-dt">
                                    <div class="icon">
                                        <img src="{{asset('web/assets/images/km.png')}}" align="km">
                                    </div>
                                    <div class="detsl">
                                        {{$hot_deal_vehicle->mileage}}
                                    </div>
                                </div>
                                <div class="car-dt">
                                    <div class="icon">
                                        <img src="{{asset('web/assets/images/petrol.png')}}" align="petrol">
                                    </div>
                                    <div class="detsl">
                                        {{$hot_deal_vehicle->fuel_type}}
                                    </div>
                                </div>
                                <div class="car-dt">
                                    <div class="icon">
                                        <img src="{{asset('web/assets/images/auto.png')}}" align="auto">
                                    </div>
                                    <div class="detsl">
                                        {{$hot_deal_vehicle->body_type}}
                                    </div>
                                </div>
                            </div>
                            <div class="car-price">
                                <span>Bid Start on <b>{{Carbon\Carbon::parse($hot_deal_vehicle->auction_start_date)->format('d M Y')}}</b></span>
                                <div class="initial-price-box">
                                    <p>Initial Price</p>
                                    <h3>SAR {{number_format($hot_deal_vehicle->price)}}</h3>
                                </div>
                                <a href="#" class="place-bid-blue vehicle_detail" data-id="{{$hot_deal_vehicle->id}}">Place
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
                                    @foreach($testimonials as $testimonial)
                                        <div class="testimonial-slide">
                                            <div class="testimonial_box">
                                                <div class="testimonial_box-inner">
                                                    <div class="testimonial_box-top">
                                                        <div class="testimonial_box-icon">
                                                            <img src="{{asset('web/assets/images/quotes.svg')}}">
                                                        </div>
                                                        <div class="testimonial_box-text">
                                                            <p>{!! $testimonial->description !!}</p>
                                                        </div>
                                                        <div class="testimonial_box-name">
                                                            <h4>{{$testimonial->title}}</h4>
                                                        </div>
                                                        <div class="testimonial_box-job">
                                                            <p>{{$testimonial->role}}</p>
                                                        </div>
                                                        <div class="testimonial_box-img">
                                                            <img src="{{asset($testimonial->image)}}" alt="profile">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
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
                                    @foreach($news as $new)
                                        <div class="testimonial-slide">
                                            <div class="testimonial_box">
                                                <div class="testimonial_box-inner">
                                                    <div class="testimonial_box-top">
                                                        <div class="testimonial_box-text">
                                                            <div class="date">
                                                                <span>{{Carbon\Carbon::parse($new->created_at)->format('M d ,Y')}}</span>
                                                            </div>
                                                            <h1>{{$new->title}}</h1>
                                                            <p>{{$new->description}}</p>
                                                            <a href="#">Read Now</a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
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

        $('.car_inquiry').on('click', function () {
            const value_id = $(this).data('id')
            loaderView()
            axios
                .get(APP_URL + '/car-inquiry' + '/' + value_id)
                .then(function (response) {
                    console.log(response.data.success)
                    if (response.data.success == true) {
                        $('#car_inquiry_title').html(response.data.modal_title)
                        $('#car_inquiry_body').html(response.data.data)

                        $('#car_inquiry').modal('show')
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
                    } else {
                        notificationToast(response.data.message, 'warning')
                    }

                    loaderHide()
                })
                .catch(function (error) {
                    loaderHide()
                })
        })


    </script>
    <script src="{{asset('web/assets/custom/home/home.js')}}?v={{time()}}"></script>
@endsection
