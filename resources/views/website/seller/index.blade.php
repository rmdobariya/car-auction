@extends('website.layouts.master')
@section('title')
    {{$user->full_name}}
@endsection
@section('content')
    <section id="vehicles" class="featured-vehicles">
        <div class="container" id="filter-part">
            @if(count($sell_vehicles) != 0 || count($featured_vehicles) != 0 || count($popular_vehicles) != 0 || count($hot_deal_vehicles) != 0)
                @if(count($sell_vehicles) > 0)
                    <div class="row">
                        <div class="col-md-12">
                            <div class="heading">
                                <h1>{{trans('web_string.car_for_sell')}}</h1>
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
                                                    src="{{asset('web/assets/images/dymand.png')}}"> {{trans('web_string.car_for_sell')}}</span>
                                        @if(!is_null(Auth::user()))
                                            @if($sell_vehicle->user_id != Auth::user()->id)
                                                <a class="like" href="#" data-id="{{$sell_vehicle->id}}"
                                                   data-user-id="{{Auth::user() ? Auth::user()->id : 0}}">
                                                    @if($count == 0)
                                                        <i class="lar la-heart"></i>
                                                    @else
                                                        <i class="las la-heart"></i>
                                                    @endif
                                                </a>
                                            @endif
                                        @else
                                            <a class="like" href="#" data-id="{{$sell_vehicle->id}}"
                                               data-user-id="{{Auth::user() ? Auth::user()->id : 0}}">
                                                <i class="lar la-heart"></i>
                                            </a>
                                        @endif
                                    </div>
                                    <div class="car-name">
                                        <div class="names">
                                            <h3>{{$sell_vehicle->vehicle_name}}</h3>
                                            <p>{{$sell_vehicle->category_name}}</p>
                                            <div class="feedback" style="visibility: hidden">
                                                <i class="las la-comments"></i>
                                                <a href="javascript:void(0)" data-bs-toggle="modal"
                                                   data-bs-target="#feedback">Feedbacks</a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="car-specifation">
                                        @if(!is_null($sell_vehicle->kms_driven))
                                            <div class="car-dt">
                                                <div class="icon">
                                                    <img src="{{asset('web/assets/images/road.png')}}" align="road">
                                                </div>
                                                <div class="detsl">
                                                    {{$sell_vehicle->kms_driven}}
                                                </div>
                                            </div>
                                        @endif
                                        @if(!is_null($sell_vehicle->mileage))
                                            <div class="car-dt">
                                                <div class="icon">
                                                    <img src="{{asset('web/assets/images/km.png')}}" align="km">
                                                </div>
                                                <div class="detsl">
                                                    {{$sell_vehicle->mileage}}
                                                </div>
                                            </div>
                                        @endif
                                        @if(!is_null($sell_vehicle->fuel_type))
                                            <div class="car-dt">
                                                <div class="icon">
                                                    <img src="{{asset('web/assets/images/petrol.png')}}" align="petrol">
                                                </div>
                                                <div class="detsl">
                                                    {{$sell_vehicle->fuel_type}}
                                                </div>
                                            </div>
                                        @endif
                                        @if(!is_null($sell_vehicle->body_type))
                                            <div class="car-dt">
                                                <div class="icon">
                                                    <img src="{{asset('web/assets/images/auto.png')}}" align="auto">
                                                </div>
                                                <div class="detsl">
                                                    {{$sell_vehicle->body_type}}
                                                </div>
                                            </div>
                                        @endif
                                    </div>
                                    <div class="car-price">
                                        <div class="initial-price-box">
                                            <p>{{trans('web_string.common_price')}}</p>
                                            <h3>SAR {{number_format($sell_vehicle->price)}}</h3>
                                        </div>
                                        <a href="#" class="place-bid-blue car_inquiry"
                                           data-id="{{$sell_vehicle->id}}">{{trans('web_string.contact_seller')}}</a>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endif
                @if(count($featured_vehicles) > 0)
                    <div class="row">
                        <div class="col-md-12">
                            <div class="heading">
                                <h1>{{trans('web_string.featured_vehicles')}}</h1>
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
                                @php
                                    $total_bids = DB::table('vehicle_bids')->where('vehicle_id',$featured_vehicle->id)->count();
                                    $height_bid = DB::table('vehicle_bids')->where('vehicle_id',$featured_vehicle->id)->max('amount');
                                @endphp
                                <div class="details-box bid-details-box">
                                    <div class="car-img">
                                        <img src="{{asset($featured_vehicle->main_image)}}" align="car">
                                        <span class="cat-tags"><img
                                                    src="{{asset('web/assets/images/dymand.png')}}"> @if($featured_vehicle->is_product == 'is_featured')
                                                {{trans('web_string.featured')}}
                                            @elseif($featured_vehicle->is_product == 'is_popular')
                                                {{trans('web_string.popular')}}
                                            @else
                                                {{trans('web_string.hot_deal')}}
                                            @endif</span>
                                        @if(!is_null(Auth::user()))
                                            @if($featured_vehicle->user_id != Auth::user()->id)
                                                <a class="like" href="#" data-id="{{$featured_vehicle->id}}"
                                                   data-user-id="{{Auth::user() ? Auth::user()->id : 0}}">
                                                    @if($count == 0)
                                                        <i class="lar la-heart"></i>
                                                    @else
                                                        <i class="las la-heart"></i>
                                                    @endif
                                                </a>
                                            @endif
                                        @else
                                            <a class="like" href="#" data-id="{{$featured_vehicle->id}}"
                                               data-user-id="{{Auth::user() ? Auth::user()->id : 0}}">
                                                <i class="lar la-heart"></i>
                                            </a>
                                        @endif
                                    </div>
                                    <div class="car-name">
                                        <div class="names">
                                            <h3>{{$featured_vehicle->vehicle_name}}</h3>
                                            <p>{{$featured_vehicle->category_name}}</p>
                                            <div class="feedback" style="visibility: hidden">
                                                <i class="las la-comments"></i>
                                                <a href="javascript:void(0)" data-bs-toggle="modal"
                                                   data-bs-target="#feedback">Feedbacks</a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="car-time-specification">
                                        <div class="time-temain" id="time-temain_{{$featured_vehicle->id}}"
                                             @if($featured_vehicle->auction_end_date <  date('Y-m-d') || $featured_vehicle->auction_start_date > date('Y-m-d')) style="visibility: hidden" @endif>
                                            <span><i class="las la-clock"></i></span>
                                            <input type="hidden" id="vehicle_id" value="{{$featured_vehicle->id}}"
                                                   class="vehicle_id">
                                            <input type="hidden" id="start_date_{{$featured_vehicle->id}}"
                                                   value="{{$featured_vehicle->auction_start_date}}">
                                            <input type="hidden" id="start_time_{{$featured_vehicle->id}}"
                                                   value="{{$featured_vehicle->auction_start_time}}">
                                            <input type="hidden" id="end_time_{{$featured_vehicle->id}}"
                                                   value="{{$featured_vehicle->auction_end_time}}">
                                            <input type="hidden" id="end_date_{{$featured_vehicle->id}}"
                                                   value="{{$featured_vehicle->auction_end_date}}">
                                            <div class="my-auction-counter"
                                                 id="my-auction-counter_{{$featured_vehicle->id}}">

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
                                    </div>
                                    @php
                                        $startDate = Carbon\Carbon::parse($featured_vehicle->auction_start_date);
                                        $endDate = Carbon\Carbon::parse($featured_vehicle->auction_end_date);
                                        $dateToCheck = Carbon\Carbon::parse(date('Y-m-d'));
                                        $startDateTime = Carbon\Carbon::parse($featured_vehicle->auction_start_date .' '. $featured_vehicle->auction_start_time);
                                        $endDateTime = Carbon\Carbon::parse($featured_vehicle->auction_end_date .' ' .$featured_vehicle->auction_end_time);
                                    @endphp
                                    <div class="car-price my-bids-price @if($dateToCheck->between($startDateTime, $endDateTime) == false) time-close @endif">
                                        <span>{{trans('web_string.bid_start')}} <b>{{Carbon\Carbon::parse($featured_vehicle->auction_start_date)->format('d M Y')}}</b></span>
                                        <span>{{trans('web_string.bid_end')}} <b>{{Carbon\Carbon::parse($featured_vehicle->auction_end_date)->format('d M Y')}}</b></span>
                                        <div class="initial-price-box">
                                            <p>{{trans('web_string.common_price')}}</p>
                                            <h3>SAR {{number_format($featured_vehicle->price)}}</h3>
                                        </div>
                                        <div class="my-bid-box">
                                            <p>{{trans('web_string.total_bids')}}</p>
                                            <h3>{{$total_bids}}</h3>
                                        </div>
                                        <div class="current-highest-bid-box">
                                            <p>{{trans('web_string.current_highest_bid')}}</p>
                                            <h3>
                                                SAR {{$total_bids == 0 ? number_format($featured_vehicle->price) : number_format($height_bid)}}</h3>
                                        </div>

                                        @if($dateToCheck->between($startDateTime, $endDateTime))
                                            <a href="javascript:void(0)" class="place-bid-blue vehicle_detail"
                                               data-id="{{$featured_vehicle->id}}">{{trans('web_string.view_auction')}}</a>
                                        @else
                                            @if($featured_vehicle->auction_start_date >= date('Y-m-d'))
                                                @if($dateToCheck->lt($startDateTime))
                                                    <a href="#"
                                                       class="place-bid-blue">{{trans('web_string.pending')}}</a>
                                                @else
                                                    <a href="javascript:void(0)"
                                                       class="place-bid-blue update-bid comtrans">{{trans('web_string.auction_close')}}</a>
                                                @endif
                                            @else
                                                <a href="javascript:void(0)"
                                                   class="place-bid-blue update-bid comtrans">{{trans('web_string.auction_close')}}</a>
                                            @endif
                                        @endif
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endif
                @if(count($popular_vehicles) > 0)
                    <div class="row">
                        <div class="col-md-12">
                            <div class="heading">
                                <h1>{{trans('web_string.popular_vehicles')}}</h1>
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
                                @php
                                    $total_bids = DB::table('vehicle_bids')->where('vehicle_id',$popular_vehicle->id)->count();
                                    $height_bid = DB::table('vehicle_bids')->where('vehicle_id',$popular_vehicle->id)->max('amount');
                                @endphp
                                <div class="details-box bid-details-box">
                                    <div class="car-img">
                                        <img src="{{asset($popular_vehicle->main_image)}}" align="car">
                                        <span class="cat-tags"><img
                                                    src="{{asset('web/assets/images/dymand.png')}}"> @if($popular_vehicle->is_product == 'is_featured')
                                                {{trans('web_string.feature')}}
                                            @elseif($popular_vehicle->is_product == 'is_popular')
                                                {{trans('web_string.popular')}}
                                            @else
                                                {{trans('web_string.hot_deal')}}
                                            @endif</span>
                                        @if(!is_null(Auth::user()))
                                            @if($popular_vehicle->user_id != Auth::user()->id)
                                                <a class="like" href="#" data-id="{{$popular_vehicle->id}}"
                                                   data-user-id="{{Auth::user() ? Auth::user()->id : 0}}">
                                                    @if($count == 0)
                                                        <i class="lar la-heart"></i>
                                                    @else
                                                        <i class="las la-heart"></i>
                                                    @endif
                                                </a>
                                            @endif
                                        @else
                                            <a class="like" href="#" data-id="{{$popular_vehicle->id}}"
                                               data-user-id="{{Auth::user() ? Auth::user()->id : 0}}">
                                                <i class="lar la-heart"></i>
                                            </a>
                                        @endif
                                    </div>
                                    <div class="car-name">
                                        <div class="names">
                                            <h3>{{$popular_vehicle->vehicle_name}}</h3>
                                            <p>{{$popular_vehicle->category_name}}</p>
                                            <div class="feedback" style="visibility: hidden">
                                                <i class="las la-comments"></i>
                                                <a href="javascript:void(0)" data-bs-toggle="modal"
                                                   data-bs-target="#feedback">Feedbacks</a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="car-time-specification">
                                        <div class="time-temain" id="time-temain_{{$popular_vehicle->id}}"
                                             @if($popular_vehicle->auction_end_date <  date('Y-m-d') || $popular_vehicle->auction_start_date > date('Y-m-d')) style="visibility: hidden" @endif>
                                            <span><i class="las la-clock"></i></span>
                                            <input type="hidden" id="vehicle_id" value="{{$popular_vehicle->id}}"
                                                   class="vehicle_id">
                                            <input type="hidden" id="start_date_{{$popular_vehicle->id}}"
                                                   value="{{$popular_vehicle->auction_start_date}}">
                                            <input type="hidden" id="start_time_{{$popular_vehicle->id}}"
                                                   value="{{$popular_vehicle->auction_start_time}}">
                                            <input type="hidden" id="end_time_{{$popular_vehicle->id}}"
                                                   value="{{$popular_vehicle->auction_end_time}}">
                                            <input type="hidden" id="end_date_{{$popular_vehicle->id}}"
                                                   value="{{$popular_vehicle->auction_end_date}}">
                                            <div class="my-auction-counter"
                                                 id="my-auction-counter_{{$popular_vehicle->id}}">

                                            </div>
                                        </div>
                                        <div class="car-specifation">
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
                                    </div>
                                    @php
                                        $startDate = Carbon\Carbon::parse($popular_vehicle->auction_start_date);
                                        $endDate = Carbon\Carbon::parse($popular_vehicle->auction_end_date);
                                        $dateToCheck = Carbon\Carbon::parse(date('Y-m-d'));
                                        $startDateTime = Carbon\Carbon::parse($popular_vehicle->auction_start_date .' '. $popular_vehicle->auction_start_time);
                                        $endDateTime = Carbon\Carbon::parse($popular_vehicle->auction_end_date .' ' .$popular_vehicle->auction_end_time);
                                    @endphp
                                    <div class="car-price my-bids-price @if($dateToCheck->between($startDateTime, $endDateTime) == false) time-close @endif">
                                        <span>{{trans('web_string.bid_start')}} <b>{{Carbon\Carbon::parse($popular_vehicle->auction_start_date)->format('d M Y')}}</b></span>
                                        <span>{{trans('web_string.bid_end')}} <b>{{Carbon\Carbon::parse($popular_vehicle->auction_end_date)->format('d M Y')}}</b></span>
                                        <div class="initial-price-box">
                                            <p>{{trans('web_string.common_price')}}</p>
                                            <h3>SAR {{number_format($popular_vehicle->price)}}</h3>
                                        </div>
                                        <div class="my-bid-box">
                                            <p>{{trans('web_string.total_bids')}}</p>
                                            <h3>{{$total_bids}}</h3>
                                        </div>
                                        <div class="current-highest-bid-box">
                                            <p>{{trans('web_string.current_highest_bid')}}</p>
                                            <h3>
                                                SAR {{$total_bids == 0 ? number_format($popular_vehicle->price) : number_format($height_bid)}}</h3>
                                        </div>

                                        @if($dateToCheck->between($startDateTime, $endDateTime))
                                            <a href="javascript:void(0)" class="place-bid-blue vehicle_detail"
                                               data-id="{{$popular_vehicle->id}}">{{trans('web_string.view_auction')}}</a>
                                        @else
                                            @if($popular_vehicle->auction_start_date >= date('Y-m-d'))
                                                @if($dateToCheck->lt($startDateTime))
                                                    <a href="#"
                                                       class="place-bid-blue">{{trans('web_string.pending')}}</a>
                                                @else
                                                    <a href="javascript:void(0)"
                                                       class="place-bid-blue update-bid comtrans">{{trans('web_string.auction_close')}}</a>
                                                @endif
                                            @else
                                                <a href="javascript:void(0)"
                                                   class="place-bid-blue update-bid comtrans">{{trans('web_string.auction_close')}}</a>
                                            @endif
                                        @endif
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endif
                @if(count($hot_deal_vehicles) > 0)
                    <div class="row">
                        <div class="col-md-12">
                            <div class="heading">
                                <h1>{{trans('web_string.hot_deals')}}</h1>
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
                                @php
                                    $total_bids = DB::table('vehicle_bids')->where('vehicle_id',$hot_deal_vehicle->id)->count();
                                    $height_bid = DB::table('vehicle_bids')->where('vehicle_id',$hot_deal_vehicle->id)->max('amount');
                                @endphp
                                <div class="details-box bid-details-box">
                                    <div class="car-img">
                                        <img src="{{asset($hot_deal_vehicle->main_image)}}" align="car">
                                        <span class="cat-tags"><img
                                                    src="{{asset('web/assets/images/dymand.png')}}"> @if($hot_deal_vehicle->is_product == 'is_featured')
                                                {{trans('web_string.featured')}}
                                            @elseif($hot_deal_vehicle->is_product == 'is_popular')
                                                {{trans('web_string.popular')}}
                                            @else
                                                {{trans('web_string.hot_deal')}}
                                            @endif</span>
                                        @if(!is_null(Auth::user()))
                                            @if($hot_deal_vehicle->user_id != Auth::user()->id)
                                                <a class="like" href="#" data-id="{{$hot_deal_vehicle->id}}"
                                                   data-user-id="{{Auth::user() ? Auth::user()->id : 0}}">
                                                    @if($count == 0)
                                                        <i class="lar la-heart"></i>
                                                    @else
                                                        <i class="las la-heart"></i>
                                                    @endif
                                                </a>
                                            @endif
                                        @else
                                            <a class="like" href="#" data-id="{{$hot_deal_vehicle->id}}"
                                               data-user-id="{{Auth::user() ? Auth::user()->id : 0}}">
                                                <i class="lar la-heart"></i>
                                            </a>
                                        @endif
                                    </div>
                                    <div class="car-name">
                                        <div class="names">
                                            <h3>{{$hot_deal_vehicle->vehicle_name}}</h3>
                                            <p>{{$hot_deal_vehicle->category_name}}</p>
                                            <div class="feedback" style="visibility: hidden">
                                                <i class="las la-comments"></i>
                                                <a href="javascript:void(0)" data-bs-toggle="modal"
                                                   data-bs-target="#feedback">Feedbacks</a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="car-time-specification">
                                        <div class="time-temain" id="time-temain_{{$hot_deal_vehicle->id}}"
                                             @if($hot_deal_vehicle->auction_end_date <  date('Y-m-d') || $hot_deal_vehicle->auction_start_date > date('Y-m-d')) style="visibility: hidden" @endif>
                                            <span><i class="las la-clock"></i></span>
                                            <input type="hidden" id="vehicle_id" value="{{$hot_deal_vehicle->id}}"
                                                   class="vehicle_id">
                                            <input type="hidden" id="start_date_{{$hot_deal_vehicle->id}}"
                                                   value="{{$hot_deal_vehicle->auction_start_date}}">
                                            <input type="hidden" id="start_time_{{$hot_deal_vehicle->id}}"
                                                   value="{{$hot_deal_vehicle->auction_start_time}}">
                                            <input type="hidden" id="end_time_{{$hot_deal_vehicle->id}}"
                                                   value="{{$hot_deal_vehicle->auction_end_time}}">
                                            <input type="hidden" id="end_date_{{$hot_deal_vehicle->id}}"
                                                   value="{{$hot_deal_vehicle->auction_end_date}}">
                                            <div class="my-auction-counter"
                                                 id="my-auction-counter_{{$hot_deal_vehicle->id}}">

                                            </div>
                                        </div>
                                        <div class="car-specifation">
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
                                    </div>
                                    @php
                                        $startDate = Carbon\Carbon::parse($hot_deal_vehicle->auction_start_date);
                                        $endDate = Carbon\Carbon::parse($hot_deal_vehicle->auction_end_date);
                                        $dateToCheck = Carbon\Carbon::parse(date('Y-m-d'));
                                         $startDateTime = Carbon\Carbon::parse($hot_deal_vehicle->auction_start_date .' '. $hot_deal_vehicle->auction_start_time);
                                        $endDateTime = Carbon\Carbon::parse($hot_deal_vehicle->auction_end_date .' ' .$hot_deal_vehicle->auction_end_time);
                                    @endphp
                                    <div class="car-price my-bids-price @if($dateToCheck->between($startDateTime, $endDateTime) == false) time-close @endif">
                                        <span>{{trans('web_string.bid_start')}} <b>{{Carbon\Carbon::parse($hot_deal_vehicle->auction_start_date)->format('d M Y')}}</b></span>
                                        <span>{{trans('web_string.bid_end')}} <b>{{Carbon\Carbon::parse($hot_deal_vehicle->auction_end_date)->format('d M Y')}}</b></span>
                                        <div class="initial-price-box">
                                            <p>{{trans('web_string.common_price')}}</p>
                                            <h3>SAR {{number_format($hot_deal_vehicle->price)}}</h3>
                                        </div>
                                        <div class="my-bid-box">
                                            <p>{{trans('web_string.total_bids')}}</p>
                                            <h3>{{$total_bids}}</h3>
                                        </div>
                                        <div class="current-highest-bid-box">
                                            <p>{{trans('web_string.current_highest_bid')}}</p>
                                            <h3>
                                                SAR {{$total_bids == 0 ? number_format($hot_deal_vehicle->price) : number_format($height_bid)}}</h3>
                                        </div>

                                        @if($dateToCheck->between($startDateTime, $endDateTime))
                                            <a href="javascript:void(0)" class="place-bid-blue vehicle_detail"
                                               data-id="{{$hot_deal_vehicle->id}}">{{trans('web_string.view_auction')}}</a>
                                        @else
                                            @if($hot_deal_vehicle->auction_start_date >= date('Y-m-d'))
                                                @if($dateToCheck->lt($startDateTime))
                                                    <a href="#"
                                                       class="place-bid-blue">{{trans('web_string.pending')}}</a>
                                                @else
                                                    <a href="javascript:void(0)"
                                                       class="place-bid-blue update-bid comtrans">{{trans('web_string.auction_close')}}</a>
                                                @endif
                                            @else
                                                <a href="javascript:void(0)"
                                                   class="place-bid-blue update-bid comtrans">{{trans('web_string.auction_close')}}</a>
                                            @endif
                                        @endif
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endif
            @else
                <h3 class="mt-3">{{$user->full_name }} {{trans('web_string.has_not_added_any_cars_yet')}}</h3>
            @endif
        </div>

    </section>
    <div class="clearfix"></div>

@endsection
@section('custom-script')
    <script src="{{asset('web/assets/js/countdown.js')}}"></script>
    <script>
        let day_string = '{{trans('web_string.day')}}';
        let hour_string = '{{trans('web_string.hours')}}';
        let min_string = '{{trans('web_string.mins')}}';
        let sec_string = '{{trans('web_string.sec')}}';
    </script>
    <script>
        var $j_object = $(".vehicle_id");
        $j_object.each(function (i) {
        //     var id = $(this).val();
        //     var start_date = $('#start_date_' + id).val()
        //     var auction_end_date = new Date(start_date);
        //     var targetDate = new Date(auction_end_date);
        //     targetDate.setHours(23);
        //     targetDate.setMinutes(60);
        //     targetDate.setSeconds(60);
        //     var formattedDateTime = targetDate.toISOString().slice(0, 24).replace('T', ' ');
        //     $("#my-auction-counter_" + id)
        //         .countdown(formattedDateTime, function (event) {
        //             $("#my-auction-counter_" + id).html(
        //                 event.strftime('<span>Day<strong>%D</strong></span> <span>Hours<strong>%H</strong></span> <span>Mins<strong>%M</strong> </span> <span>Sec<strong>%S</strong></span>')
        //             );
        //         });
        // });

            $j_object.each(function (i) {
                var id = $(this).val();
                var start_date = $('#start_date_' + id).val();
                var start_time = $('#start_time_' + id).val();
                var end_date = $('#end_date_' + id).val();
                var end_time = $('#end_time_' + id).val();

                var startDateTime = new Date(start_date + ' ' + start_time);
                var endDateTime = new Date(end_date + ' ' + end_time);

                function updateCountdown() {
                    var now = new Date().getTime();
                    var timeLeft = endDateTime - now;

                    var days = Math.floor(timeLeft / (1000 * 60 * 60 * 24));
                    var hours = Math.floor((timeLeft % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
                    var minutes = Math.floor((timeLeft % (1000 * 60 * 60)) / (1000 * 60));
                    var seconds = Math.floor((timeLeft % (1000 * 60)) / 1000);

                    $("#my-auction-counter_" + id).html(
                        '<span>' + day_string + '<strong>' + days + '</strong></span> ' +
                        '<span>' + hour_string + '<strong>' + hours + '</strong></span> ' +
                        '<span>' + min_string + '<strong>' + minutes + '</strong> </span> ' +
                        '<span>' + sec_string + '<strong>' + seconds + '</strong></span>'
                    );

                    if (timeLeft < 0) {
                        clearInterval(countdownInterval);
                        $("#my-auction-counter_" + id).html("");
                        $("#time-temain_" + id).addClass("d-none");
                    }
                }

                // Update the countdown every second
                var countdownInterval = setInterval(updateCountdown, 1000);

                // Initial call to display the countdown immediately
                updateCountdown();
            });

        $('.vehicle_detail').on('click', function (e) {
            e.preventDefault();
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

        $('.car_inquiry').on('click', function (e) {
            e.preventDefault();
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
