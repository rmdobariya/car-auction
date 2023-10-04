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
