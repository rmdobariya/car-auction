@extends('website.layouts.master')
@section('title')
    {{trans('web_string.car_for_sell')}}
@endsection
@section('content')
    <section id="vehicles" class="featured-vehicles">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="heading">
                        <h1>{{trans('web_string.car_for_sell')}}</h1>
                    </div>
                </div>
                <div class="clearfix"></div>
                <div class="col-md-12">
                    @foreach($vehicles as $vehicle)
                        @if(Auth::user())
                            @php
                                $count = DB::table('wish_lists')->where('vehicle_id', $vehicle->id)->where('user_id', Auth::user()->id)->count()
                            @endphp
                        @else
                            @php
                                $count = 0;
                            @endphp
                        @endif
                        <div class="details-box">
                            <div class="car-img">
                                <img src="{{asset($vehicle->main_image)}}" align="car">
                                <span class="cat-tags"><img
                                        src="{{asset('web/assets/images/dymand.png')}}"> {{trans('web_string.car_for_sell')}}</span>
                                @if(!is_null(Auth::user()))
                                    @if($vehicle->user_id != Auth::user()->id)
                                        <a class="like" data-id="{{$vehicle->id}}"
                                           data-user-id="{{Auth::user() ? Auth::user()->id : 0}}">
                                            @if($count == 0)
                                                <i class="lar la-heart"></i>
                                            @else
                                                <i class="las la-heart"></i>
                                            @endif
                                        </a>
                                    @endif
                                @else
                                    <a class="like" data-id="{{$vehicle->id}}"
                                       data-user-id="{{Auth::user() ? Auth::user()->id : 0}}">
                                        <i class="lar la-heart"></i>
                                    </a>
                                @endif
                            </div>
                            <div class="car-name">
                                <div class="names">
                                    <h3>{{$vehicle->vehicle_name}}</h3>
                                    <p>{{$vehicle->category_name}}</p>
                                </div>
                            </div>
                            <div class="car-specifation">
                                @if(!is_null($vehicle->kms_driven))
                                    <div class="car-dt">
                                        <div class="icon">
                                            <img src="{{asset('web/assets/images/road.png')}}" align="road">
                                        </div>
                                        <div class="detsl">
                                            {{$vehicle->kms_driven}}
                                        </div>
                                    </div>
                                @endif
                                @if(!is_null($vehicle->mileage))
                                    <div class="car-dt">
                                        <div class="icon">
                                            <img src="{{asset('web/assets/images/km.png')}}" align="km">
                                        </div>
                                        <div class="detsl">
                                            {{$vehicle->mileage}}
                                        </div>
                                    </div>
                                @endif
                                @if(!is_null($vehicle->fuel_type))
                                    <div class="car-dt">
                                        <div class="icon">
                                            <img src="{{asset('web/assets/images/petrol.png')}}" align="petrol">
                                        </div>
                                        <div class="detsl">
                                            {{$vehicle->fuel_type}}
                                        </div>
                                    </div>
                                @endif
                                @if(!is_null($vehicle->body_type))
                                    <div class="car-dt">
                                        <div class="icon">
                                            <img src="{{asset('web/assets/images/auto.png')}}" align="auto">
                                        </div>
                                        <div class="detsl">
                                            {{$vehicle->body_type}}
                                        </div>
                                    </div>
                                @endif
                            </div>
                            <div class="car-price">
                                {{--                            <span>Bid Start on <b>{{Carbon\Carbon::parse($featured_vehicle->auction_start_date)->format('d M Y')}}</b></span>--}}
                                <div class="initial-price-box">
                                    <p>{{trans('web_string.common_price')}}</p>
                                    <h3>SAR {{number_format($vehicle->price)}}</h3>
                                </div>
                                <a href="#" class="place-bid-blue car_inquiry"
                                   data-id="{{$vehicle->id}}">{{trans('web_string.contact_seller')}}</a>
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
                        <h1>{{trans('web_string.how_it_works')}}</h1>
                    </div>
                </div>
                <div class="clearfix"></div>
                <div class="col-md-4">
                    <div class="work-box">
                        <span>1</span>
                        <h2>{{trans('web_string.register')}}</h2>
                        <p>{{trans('web_string.sign_up_for_a')}}</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="work-box">
                        <span>2</span>
                        <h2>{{trans('web_string.find')}}</h2>
                        <p>{{trans('web_string.search_out_range')}}</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="work-box">
                        <span>3</span>
                        <h2>{{trans('web_string.bid')}}</h2>
                        <p>{{trans('web_string.bid_in_our_online')}}</p>
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
                        <h1>{{trans('web_string.testimonial')}}</h1>
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
                        <h1 class="text-white">{{trans('web_string.news')}}</h1>
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
                                                            <a href="#">{{trans('web_string.read_now')}}</a>
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
