@extends('website.layouts.master')
@section('title')
    {{trans('web_string.auctions')}}
@endsection
@section('content')
    <section id="vehicles" class="featured-vehicles">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="heading">
                        <h1>My Auctions</h1>
                        @if(!is_null(Auth::user()))
                            @if(Auth::user()->user_type == 'seller')
                                <a class="add_auction" data-id="{{Auth::user()->id}}" href="#">{{trans('web_string.add_auction')}}</a>
                            @endif
                        @else
                            <a class="add_auction" data-id="0" href="#">{{trans('web_string.add_auction')}}</a>
                        @endif
{{--                        <a href="javascript:void(0)">View All</a>--}}
                    </div>
                </div>
                <div class="clearfix"></div>
                @if(count($vehicles) > 0)
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
                        @php
                            $total_bids = DB::table('vehicle_bids')->where('vehicle_id',$vehicle->id)->count();
                            $height_bid = DB::table('vehicle_bids')->where('vehicle_id',$vehicle->id)->max('amount');
                        @endphp
                        <div class="details-box bid-details-box">
                            <div class="car-img">
                                <img src="{{asset($vehicle->main_image)}}" align="car">
                                <span class="cat-tags"><img
                                        src="{{asset('web/assets/images/dymand.png')}}"> @if($vehicle->is_product == 'is_featured')
                                        {{trans('web_string.featured')}}
                                    @elseif($vehicle->is_product == 'is_popular')
                                        {{trans('web_string.popular')}}
                                    @else
                                        {{trans('web_string.hot_deal')}}
                                    @endif</span>
                                @if(!is_null(Auth::user()))
                                    @if($vehicle->user_id != Auth::user()->id)
                                        <a class="like" href="#" data-id="{{$vehicle->id}}"
                                           data-user-id="{{Auth::user() ? Auth::user()->id : 0}}">
                                            @if($count == 0)
                                                <i class="lar la-heart"></i>
                                            @else
                                                <i class="las la-heart"></i>
                                            @endif
                                        </a>
                                    @endif
                                @else
                                    <a class="like" href="#" data-id="{{$vehicle->id}}"
                                       data-user-id="{{Auth::user() ? Auth::user()->id : 0}}">
                                        <i class="lar la-heart"></i>
                                    </a>
                                @endif
                            </div>
                            <div class="car-name">
                                <div class="names">
                                    <h3>{{$vehicle->vehicle_name}}</h3>
                                    <p>{{$vehicle->category_name}}</p>
                                    <div class="feedback" style="visibility: hidden">
                                        <i class="las la-comments"></i>
                                        <a href="javascript:void(0)" data-bs-toggle="modal"
                                           data-bs-target="#feedback">Feedbacks</a>
                                    </div>
                                </div>
                            </div>
                            <div class="car-time-specification">
                                <div class="time-temain"
                                     @if($vehicle->auction_end_date <  date('Y-m-d') || $vehicle->auction_start_date > date('Y-m-d')) style="visibility: hidden" @endif>
                                    <span><i class="las la-clock"></i></span>
                                    <input type="hidden" id="vehicle_id" value="{{$vehicle->id}}"
                                           class="vehicle_id">
                                    <input type="hidden" id="start_date_{{$vehicle->id}}"
                                           value="{{$vehicle->auction_end_date}}">
                                    <div class="my-auction-counter"
                                         id="my-auction-counter_{{$vehicle->id}}">

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
                            </div>
                            <div class="car-price my-bids-price @if($vehicle->auction_end_date < date('Y-m-d') || $vehicle->auction_start_date > date('Y-m-d')) time-close @endif">
                                <span>{{trans('web_string.bid_start')}} <b>{{Carbon\Carbon::parse($vehicle->auction_start_date)->format('d M Y')}}</b></span>
                                <span>{{trans('web_string.bid_end')}} <b>{{Carbon\Carbon::parse($vehicle->auction_end_date)->format('d M Y')}}</b></span>
                                <div class="initial-price-box">
                                    <p>{{trans('web_string.common_price')}}</p>
                                    <h3>SAR {{number_format($vehicle->price)}}</h3>
                                </div>
                                <div class="my-bid-box">
                                    <p>{{trans('web_string.total_bids')}}</p>
                                    <h3>{{$total_bids}}</h3>
                                </div>
                                <div class="current-highest-bid-box">
                                    <p>{{trans('web_string.current_highest_bid')}}</p>
                                    <h3>
                                        SAR {{$total_bids == 0 ? number_format($vehicle->price) : number_format($height_bid)}}</h3>
                                </div>
                                @php
                                    $startDate = Carbon\Carbon::parse($vehicle->auction_start_date);
                                    $endDate = Carbon\Carbon::parse($vehicle->auction_end_date);
                                    $dateToCheck = Carbon\Carbon::parse(date('Y-m-d'));
                                @endphp
                                @if($dateToCheck->between($startDate, $endDate))
                                    <a href="javascript:void(0)" class="place-bid-blue vehicle_detail"
                                       data-id="{{$vehicle->id}}">{{trans('web_string.view_auction')}}</a>
                                @else
                                    @if($vehicle->auction_start_date > date('Y-m-d'))
                                        <a href="#" class="place-bid-blue">{{trans('web_string.pending')}}</a>
                                    @else
                                        <a href="javascript:void(0)"
                                           class="place-bid-blue update-bid comtrans">{{trans('web_string.auction_close')}}</a>
                                    @endif
                                @endif
                            </div>
                        </div>
                    @endforeach
                </div>
                @else
                    <h3>{{trans('web_string.no_new_auction')}}</h3>
                @endif
            </div>
        </div>
    </section>
    <div class="clearfix"></div>
@endsection
@section('custom-script')
    <script src="{{asset('web/assets/js/countdown.js')}}"></script>
    <script>
        var $j_object = $(".vehicle_id");
        $j_object.each(function (i) {
            var id = $(this).val();
            var start_date = $('#start_date_' + id).val()
            var auction_end_date = new Date(start_date);
            var targetDate = new Date(auction_end_date);
            targetDate.setHours(23);
            targetDate.setMinutes(60);
            targetDate.setSeconds(60);
            var formattedDateTime = targetDate.toISOString().slice(0, 24).replace('T', ' ');
            $("#my-auction-counter_" + id)
                .countdown(formattedDateTime, function (event) {
                    $("#my-auction-counter_" + id).html(
                        event.strftime('<span>Day<strong>%D</strong></span> <span>Hours<strong>%H</strong></span> <span>Mins<strong>%M</strong> </span> <span>Sec<strong>%S</strong></span>')
                    );
                });
        });

        $('.add_auction').on('click', function () {
            let id = $(this).data('id')
            console.log(id)
            if (id == 0) {
                notificationToast('Please First Login Or Sign Up', 'warning')
            } else {
                window.location.href = APP_URL + '/add-auction'
            }
        })
        $('.vehicle_detail').on('click', function () {
            const value_id = $(this).data('id')
            loaderView()
            axios
                .get(APP_URL + '/vehicle-details' + '/' + value_id)
                .then(function (response) {
                    $('#vehicle_detail_title').html(response.data.modal_title)
                    $('#vehicle_detail_body').html(response.data.data)

                    $('#carderails').modal('show')
                    // var mySwiper = new Swiper('.swiper-container', {
                    //     speed: 400,
                    //     loop: true,
                    //     slidesPerView: 1,
                    //     calculateHeight: true,
                    //     spaceBetween: 50,
                    //     watchActiveIndex: true,
                    //     prevButton: '.swiper-button-prev',
                    //     nextButton: '.swiper-button-next'
                    // })

                    var productSlider = new Swiper('.product-slider', {
                        spaceBetween: 0,
                        centeredSlides: false,
                        loop: true,
                        direction: 'horizontal',
                        loopedSlides: 3,
                        navigation: {
                            nextEl: ".swiper-button-next",
                            prevEl: ".swiper-button-prev",
                        },
                        resizeObserver: true,
                    });
                    var productThumbs = new Swiper('.product-thumbs', {
                        spaceBetween: 0,
                        centeredSlides: true,
                        loop: true,
                        slideToClickedSlide: true,
                        direction: 'horizontal',
                        slidesPerView: 3,
                        loopedSlides: 3,
                    });
                    productSlider.controller.control = productThumbs;
                    productThumbs.controller.control = productSlider;

                    loaderHide()
                })
                .catch(function (error) {
                    loaderHide()
                })
        })

    </script>
    <script src="{{asset('web/assets/custom/home/home.js')}}?v={{time()}}"></script>
@endsection
