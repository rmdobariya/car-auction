@extends('website.layouts.master')
@section('title')
    {{trans('web_string.my_bids')}}
@endsection
@section('content')
    <section id="vehicles" class="featured-vehicles">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="heading">
                        <h1>{{trans('web_string.my_bids')}}</h1>
                    </div>
                </div>
                <div class="clearfix"></div>
                @if(count($bids) > 0)
                    <div class="col-md-12">
                        @foreach($bids as $bid)
                            @if(Auth::user())
                                @php
                                    $count = DB::table('wish_lists')->where('vehicle_id', $bid->id)->where('user_id', Auth::user()->id)->count()
                                @endphp
                            @else
                                @php
                                    $count = 0;
                                @endphp
                            @endif
                            @php
                                $total_bids = DB::table('vehicle_bids')->where('vehicle_id',$bid->id)->count();
                                $height_bid = DB::table('vehicle_bids')->where('vehicle_id',$bid->id)->max('amount');
                            @endphp
                            <div class="details-box bid-details-box">
                                <div class="car-img">
                                    <img src="{{asset($bid->main_image)}}" align="car">
                                    <span class="cat-tags"><img
                                            src="{{asset('web/assets/images/dymand.png')}}"> @if($bid->is_product == 'is_featured')
                                            {{trans('web_string.featured')}}
                                        @elseif($bid->is_product == 'is_popular')
                                            {{trans('web_string.popular')}}
                                        @else
                                            {{trans('web_string.hot_deal')}}
                                        @endif</span>
                                    @if(!is_null(Auth::user()))
                                        @if($bid->user_id != Auth::user()->id)
                                            <a class="like" href="#" data-id="{{$bid->id}}"
                                               data-user-id="{{Auth::user() ? Auth::user()->id : 0}}">
                                                @if($count == 0)
                                                    <i class="lar la-heart"></i>
                                                @else
                                                    <i class="las la-heart"></i>
                                                @endif
                                            </a>
                                        @endif
                                    @else
                                        <a class="like" href="#" data-id="{{$bid->id}}"
                                           data-user-id="{{Auth::user() ? Auth::user()->id : 0}}">
                                            <i class="lar la-heart"></i>
                                        </a>
                                    @endif
                                </div>
                                <div class="car-name">
                                    <div class="names">
                                        <h3>{{$bid->vehicle_name}}</h3>
                                        <p>{{$bid->category_name}}</p>
                                        <div class="feedback" style="visibility: hidden">
                                            <i class="las la-comments"></i>
                                            <a href="javascript:void(0)" data-bs-toggle="modal"
                                               data-bs-target="#feedback">Feedbacks</a>
                                        </div>
                                    </div>
                                </div>
                                <div class="car-time-specification">
                                    <div class="time-temain"
                                         @if($bid->auction_end_date <  date('Y-m-d')) style="visibility: hidden" @endif>
                                        <span><i class="las la-clock"></i></span>
                                        <input type="hidden" id="vehicle_id" value="{{$bid->id}}" class="vehicle_id">
                                        <input type="hidden" id="start_date_{{$bid->id}}"
                                               value="{{$bid->auction_end_date}}">

                                        <div class="my-auction-counter" id="my-auction-counter_{{$bid->id}}"></div>
                                    </div>
                                    <div class="car-specifation">
                                        @if(!is_null($bid->kms_driven))
                                            <div class="car-dt">
                                                <div class="icon">
                                                    <img src="{{asset('web/assets/images/road.png')}}" align="road">
                                                </div>
                                                <div class="detsl">
                                                    {{$bid->kms_driven}}
                                                </div>
                                            </div>
                                        @endif
                                        @if(!is_null($bid->mileage))
                                            <div class="car-dt">
                                                <div class="icon">
                                                    <img src="{{asset('web/assets/images/km.png')}}" align="km">
                                                </div>
                                                <div class="detsl">
                                                    {{$bid->mileage}}
                                                </div>
                                            </div>
                                        @endif
                                        @if(!is_null($bid->fuel_type))
                                            <div class="car-dt">
                                                <div class="icon">
                                                    <img src="{{asset('web/assets/images/petrol.png')}}" align="petrol">
                                                </div>
                                                <div class="detsl">
                                                    {{$bid->fuel_type}}
                                                </div>
                                            </div>
                                        @endif
                                        @if(!is_null($bid->body_type))
                                            <div class="car-dt">
                                                <div class="icon">
                                                    <img src="{{asset('web/assets/images/auto.png')}}" align="auto">
                                                </div>
                                                <div class="detsl">
                                                    {{$bid->body_type}}
                                                </div>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                                <div
                                    class="car-price my-bids-price @if($bid->auction_end_date < date('Y-m-d')) time-close @endif">
                                    <div class="initial-price-box">
                                        <p>{{trans('web_string.common_price')}}</p>
                                        <h3>SAR {{number_format($bid->price)}}</h3>
                                    </div>
                                    <div class="my-bid-box">
                                        <p>{{trans('web_string.total_bids')}}</p>
                                        <h3>{{$total_bids}}</h3>
                                    </div>
                                    <div class="current-highest-bid-box">
                                        <p>{{trans('web_string.current_highest_bid')}}</p>
                                        <h3>
                                            SAR {{$total_bids == 0 ? number_format($bid->price) : number_format($height_bid)}}</h3>
                                    </div>
                                    @php
                                        $startDate = Carbon\Carbon::parse($bid->auction_start_date);
                                        $endDate = Carbon\Carbon::parse($bid->auction_end_date);
                                        $dateToCheck = Carbon\Carbon::parse(date('Y-m-d'));
                                    @endphp
                                    @if($dateToCheck->between($startDate, $endDate))
                                        <a href="javascript:void(0)" class="place-bid-blue vehicle_detail"
                                           data-id="{{$bid->id}}">{{trans('web_string.update_bid')}}</a>
                                    @else
                                        @if($bid->auction_start_date > date('Y-m-d'))
                                            <a href="#" class="place-bid-blue">{{trans('web_string.pending')}}</a>
                                        @else
                                            <a href="javascript:void(0)"
                                               class="place-bid-blue update-bid">{{trans('web_string.auction_close')}}</a>
                                        @endif
                                    @endif
                                </div>
                            </div>
                        @endforeach
                    </div>
                @else
                    <h3>{{trans('web_string.you_have_not_placed_any_bid_yet')}}</h3>
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
            $("#my-auction-counter_" + id)
                .countdown(start_date, function (event) {
                    $("#my-auction-counter_" + id).html(
                        event.strftime('<span>Day<strong>%D</strong></span> <span>Hours<strong>%H</strong></span> <span>Mins<strong>%M</strong> </span> <span>Sec<strong>%S</strong></span>')
                    );
                });
        });

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
@endsection
