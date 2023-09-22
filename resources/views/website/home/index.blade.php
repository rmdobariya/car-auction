@extends('website.layouts.master')
@section('content')
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
    </script>
@endsection
