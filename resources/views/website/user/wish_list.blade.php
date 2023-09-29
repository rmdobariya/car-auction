@extends('website.layouts.master')
@section('content')
    <section id="vehicles" class="featured-vehicles">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="heading">
                        <h1>Watchlist</h1>
                        <a href="javascript:void(0)">View All</a>
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
                        @php
                            $total_bids = DB::table('vehicle_bids')->where('vehicle_id',$vehicle->id)->count();
                            $height_bid = DB::table('vehicle_bids')->where('vehicle_id',$vehicle->id)->max('amount');
                        @endphp
                        <div class="details-box bid-details-box">
                            <div class="car-img">
                                <img src="{{asset($vehicle->main_image)}}" align="car">
                                <span class="cat-tags"><img
                                        src="{{asset('web/assets/images/dymand.png')}}"> @if($vehicle->is_product == 'is_featured') Featured @elseif($vehicle->is_product == 'is_popular') Popular @else Hot Deal @endif</span>
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
                                    <div class="feedback">
                                        <i class="las la-comments"></i>
                                        <a href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#feedback">Feedbacks</a>
                                    </div>
                                </div>
                            </div>
                            <div class="car-time-specification">
                                <div class="time-temain">
                                    <span><i class="las la-clock"></i></span>
                                    <input type="hidden" id="vehicle_id" value="{{$vehicle->id}}" class="vehicle_id">
                                    <input type="hidden" id="start_date_{{$vehicle->id}}"
                                           value="{{$vehicle->auction_start_date}}">
                                    <div class="my-auction-counter" id="my-auction-counter_{{$vehicle->id}}">

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
                            <div class="car-price my-bids-price">
                                <div class="initial-price-box">
                                    <p>Initial Price</p>
                                    <h3>SAR {{number_format($vehicle->price)}}</h3>
                                </div>
                                <div class="my-bid-box">
                                    <p>Total Bids</p>
                                    <h3>{{$total_bids}}</h3>
                                </div>
                                <div class="current-highest-bid-box">
                                    <p>Current Highest Bid</p>
                                    <h3>SAR {{$total_bids == 0 ? number_format($vehicle->price) : number_format($height_bid)}}</h3>
                                </div>
                                @php
                                    $startDate = Carbon\Carbon::parse($vehicle->auction_start_date);
                                    $endDate = Carbon\Carbon::parse($vehicle->auction_end_date);
                                    $dateToCheck = Carbon\Carbon::parse(date('Y-m-d'));
                                @endphp
                                @if($dateToCheck->between($startDate, $endDate))
                                    <a href="javascript:void(0)" class="place-bid-blue update-bid" data-bs-toggle="modal"
                                       data-bs-target="#carderails">View Auction</a>
                                @else
                                    @if($vehicle->auction_start_date > date('Y-m-d'))
                                        <a href="#" class="place-bid-blue">Pending</a>
                                    @else
                                        <a href="javascript:void(0)"
                                           class="place-bid-blue update-bid comtrans">Auction CLose</a>
                                    @endif
                                @endif
                            </div>
                        </div>
                    @endforeach
                </div>
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

        $('.add_auction').on('click', function () {
            let id = $(this).data('id')
            console.log(id)
            if (id == 0) {
                notificationToast('Please First Login Or Sign Up', 'warning')
            } else {
                window.location.href = APP_URL + '/add-auction'
            }
        })
    </script>
    <script src="{{asset('web/assets/custom/home/home.js')}}?v={{time()}}"></script>
@endsection

