@extends('website.layouts.master')
@section('title')
    {{trans('web_string.my_profile')}}
@endsection
@section('content')
    <section id="vehicles" class="featured-vehicles">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <form id="updateProfileForm">
                        <div class="profile-box">
                            <div class="head">
                                <h3>Profile</h3>
                                <button type="submit" class="place-bid-blue">{{trans('web_string.update')}}</button>
                            </div>
                            <div class="profile-pic">
                                <img src="{{asset($user->image)}}" id="displayedImage" alt="profile">
                                <input type="file" id="imgupload" name="image" accept="image/*"
                                       onchange="loadFile(event)" style="display:none"/>
                                <a href="javascript:void(0)" onClick="openSelect('#imgupload')" class="edit-profile"
                                   data-bs-toggle="tooltip"
                                   title="Allowed max 2MB and only JPG, PNG, GIF files are allowed.">

                                    <i class="las la-pen"></i>
                                </a>
                                {{--                                <input type="file" id="profile_image">--}}
                                {{--                                <a href="javascript:void(0)" class="delete-profile">--}}
                                {{--                                    <i class="las la-ban"></i>--}}
                                {{--                                </a>--}}
                            </div>
                            <div class="profile-field">
                                <div class="u-pro">
                                    <label>{{trans('web_string.user_profile')}} :</label>
                                    <input type="text" class="form-control" name="ptype" readonly
                                           value="{{$user->user_type}}">
                                </div>
                                <div class="name">
                                    <input type="text" class="form-control" name="fname"
                                           placeholder="{{trans('web_string.first_name')}}"
                                           value="{{$user->name}}">
                                    <input type="text" class="form-control" name="lname"
                                           placeholder="{{trans('web_string.last_name')}}"
                                           value="{{$user->last_name}}">
                                </div>
                                <div class="emails">
                                    <input type="email" class="form-control" name="email" value="{{$user->email}}"
                                           readonly>
                                </div>
                                <div class="name">
                                    <input type="text" class="form-control" name="country_code"
                                           placeholder="Country Code"
                                           value="+966" readonly>
                                    <input type="text" class="form-control integer" name="contact_no"
                                           value="{{$user->contact_no}}" placeholder="Contact No">
                                </div>

                                @if(!is_null($user->password))
                                    <div class="emails">
                                        <a href="#" data-bs-toggle="modal"
                                           data-bs-target="#change_password">{{trans('web_string.change_password')}}</a>
                                    </div>
                                @endif
                            </div>

                        </div>
                    </form>
                </div>
                <div class="col-md-6">
                    <div class="notification-setting">
                        @if($user->is_corporate_seller == 1)
                            <p class="corporate_seller_text">{{trans('web_string.you_are_a_corporate_seller')}} <a
                                    href="{{route('seller',encrypt($user->id))}}"><u>{{trans('web_string.collection')}}</u></a>
                            </p>
                        @endif
                        <p class="corporate_seller_text">
                            <a href="#" class="review-ratting"
                               data-id="{{$user->id}}"><u>{{trans('web_string.review_for_zodha_platform')}}</u></a>
                        </p>
                        {{--                                        <div class="head">--}}
                        {{--                                            <h3>Notification Settings</h3>--}}
                        {{--                                            <a href="#" class="place-bid-blue">Update</a>--}}
                        {{--                                        </div>--}}
                        {{--                                        <div class="noti-list">--}}
                        {{--                                            <div class="list-box">--}}
                        {{--                                                <p>There are many variations of passages of Lorem Ipsum available</p>--}}
                        {{--                                                <div class="form-check form-switch chked">--}}
                        {{--                                                    <label class="form-check-label" for="onoff1">On</label>--}}
                        {{--                                                    <input class="form-check-input" type="checkbox" role="switch" id="onoff1" checked>--}}
                        {{--                                                    <label class="form-check-label" for="onoff1">Off</label>--}}
                        {{--                                                </div>--}}
                        {{--                                            </div>--}}
                        {{--                                            <div class="list-box">--}}
                        {{--                                                <p>There are many variations of passages of Lorem Ipsum available</p>--}}
                        {{--                                                <div class="form-check form-switch">--}}
                        {{--                                                    <label class="form-check-label" for="onoff2">On</label>--}}
                        {{--                                                    <input class="form-check-input" type="checkbox" role="switch" id="onoff2">--}}
                        {{--                                                    <label class="form-check-label" for="onoff2">Off</label>--}}
                        {{--                                                </div>--}}
                        {{--                                            </div>--}}
                        {{--                                            <div class="list-box">--}}
                        {{--                                                <p>There are many variations of passages of Lorem Ipsum available</p>--}}
                        {{--                                                <div class="form-check form-switch chked">--}}
                        {{--                                                    <label class="form-check-label" for="onoff3">On</label>--}}
                        {{--                                                    <input class="form-check-input" type="checkbox" role="switch" id="onoff3" checked>--}}
                        {{--                                                    <label class="form-check-label" for="onoff3">Off</label>--}}
                        {{--                                                </div>--}}
                        {{--                                            </div>--}}
                        {{--                                            <div class="list-box">--}}
                        {{--                                                <p>There are many variations of passages of Lorem Ipsum available</p>--}}
                        {{--                                                <div class="form-check form-switch chked">--}}
                        {{--                                                    <label class="form-check-label" for="onoff4">On</label>--}}
                        {{--                                                    <input class="form-check-input" type="checkbox" role="switch" id="onoff4" checked>--}}
                        {{--                                                    <label class="form-check-label" for="onoff4">Off</label>--}}
                        {{--                                                </div>--}}
                        {{--                                            </div>--}}
                        {{--                                        </div>--}}
                    </div>
                </div>
            </div>
            <div class="clearfix"></div>
            <div class="row">
                <div class="col-md-12">
                    <div class="heading">
                        <h1>{{trans('web_string.my_bids')}}</h1>
{{--                        @if($my_bid_count > 3)--}}
                            <a href="{{route('my-bids')}}">{{trans('web_string.common_view_all')}}</a>
{{--                        @endif--}}
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
                                            <a class="like" data-id="{{$bid->id}}"
                                               data-user-id="{{Auth::user() ? Auth::user()->id : 0}}">
                                                @if($count == 0)
                                                    <i class="lar la-heart"></i>
                                                @else
                                                    <i class="las la-heart"></i>
                                                @endif
                                            </a>
                                        @endif
                                    @else
                                        <a class="like" data-id="{{$bid->id}}"
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
                                         @if($bid->auction_end_date <  date('Y-m-d') || $bid->auction_start_date > date('Y-m-d')) style="visibility: hidden" @endif>
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
                                    @php
                                        $startDate = Carbon\Carbon::parse($bid->auction_start_date);
                                        $endDate = Carbon\Carbon::parse($bid->auction_end_date);
                                        $dateToCheck = Carbon\Carbon::parse(date('Y-m-d'));
                                        $startDateTime = Carbon\Carbon::parse($bid->auction_start_date .' '. $bid->auction_start_time);
                                        $endDateTime = Carbon\Carbon::parse($bid->auction_end_date .' ' .$bid->auction_end_time);
                                        $endDateTimeO = Carbon\Carbon::now();
                                        $bid_count = 0;
                                        $proof_check = null;
                                      if(!is_null(Auth::guard('web')->user())){
                                             $bid_count = DB::table('vehicle_bids')->where('user_id',Auth::guard('web')->user()->id)->count();
                                             $proof_check = DB::table('payment_proofs')->where('user_id',Auth::guard('web')->user()->id)->first();
                                             if(!is_null($proof_check)){
                                             $payment_status = $proof_check->status;
                                             }
                                        }
                                    $bid_o = DB::table('vehicle_bids')->where('vehicle_id', $bid->id)->orderBy('amount', 'desc')->first();
                                    $bid_amount = $bid->price;

                                    if (!is_null($bid_o)) {
                                    $last_bid_amount = $bid_o->amount;
                                    $bid_amount = $bid_o->amount;
                                    }
                                    @endphp
                                    @if($endDateTimeO->between($startDateTime, $endDateTime) == true)
                                        <div class="input-group">
                                        <span class="input-group-btn">
                                            <button type="button" class="btn btn-default btn-minus btn-minus-manually"
                                                    id="btn-minus"
                                                    data-minimum-bid-increment="{{$bid->bid_increment}}"
                                                    data-id="{{$bid->id}}">
                                                <i class="fas fa-minus"></i>
                                            </button>
                                        </span>
                                            <input type="text" name="amount[{{$bid->id}}]"
                                                   id="amount_{{$bid->id}}"
                                                   class="form-control input-number integer"
                                                   value="{{$bid_amount}}"
                                                   placeholder="{{trans('web_string.amount')}}"
                                                   min="{{$bid_amount}}" readonly>
                                            <span class="input-group-btn">
                                            <button type="button" class="btn btn-default btn-plus btn-plus-manually"
                                                    id="btn-plus"
                                                    data-minimum-bid-increment="{{$bid->bid_increment}}"
                                                    data-id="{{$bid->id}}">
                                                <i class="fas fa-plus"></i>
                                            </button>
                                            <a class="btn place-bid-blue-manually @if($bid_count == 0 && $payment_status == 'pending' || $payment_status == 'reject') disabled-link @endif bid-manually-submit"
                                               data-id="{{$bid->id}}">
                                                {{trans('web_string.place_bid')}}
                                            </a>
                                        </span>
                                        </div>
                                    @endif
                                </div>
                                <div
                                    class="car-price my-bids-price @if($bid->auction_end_date < date('Y-m-d') || $bid->auction_start_date > date('Y-m-d')) time-close @endif">
                                    <span>{{trans('web_string.bid_start')}} <b>{{Carbon\Carbon::parse($bid->auction_start_date)->format('d M Y')}}</b></span>
                                    <span>{{trans('web_string.bid_end')}} <b>{{Carbon\Carbon::parse($bid->auction_end_date)->format('d M Y')}}</b></span>
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
            <div class="row winning-profile">
                <div class="col-md-12">
                    <div class="heading">
                        <h1>{{trans('web_string.my_winnings')}}</h1>
                        @if($winner_count > 3)
                            <a href="{{route('my-winnings')}}">{{trans('web_string.common_view_all')}}</a>
                        @endif
                    </div>
                </div>
                <div class="clearfix"></div>
                @if(count($winner_bids) > 0)
                    <div class="col-md-12">
                        @foreach($winner_bids as $winner_bid)
                            @if(Auth::user())
                                @php
                                    $count = DB::table('wish_lists')->where('vehicle_id', $winner_bid->id)->where('user_id', Auth::user()->id)->count()
                                @endphp
                            @else
                                @php
                                    $count = 0;
                                @endphp
                            @endif
                            @php
                                $total_bids = DB::table('vehicle_bids')->where('vehicle_id',$winner_bid->id)->count();
                                $height_bid = DB::table('vehicle_bids')->where('vehicle_id',$winner_bid->id)->max('amount');
                            @endphp
                            <div class="details-box bid-details-box">
                                <div class="car-img">
                                    <img src="{{asset($winner_bid->main_image)}}" align="car">
                                    <span class="cat-tags"><img
                                            src="{{asset('web/assets/images/dymand.png')}}"> @if($winner_bid->is_product == 'is_featured')
                                            {{trans('web_string.featured')}}
                                        @elseif($winner_bid->is_product == 'is_popular')
                                            {{trans('web_string.popular')}}
                                        @else
                                            {{trans('web_string.hot_deal')}}
                                        @endif</span>
                                    @if(!is_null(Auth::user()))
                                        @if($winner_bid->user_id != Auth::user()->id)
                                            <a class="like" data-id="{{$winner_bid->id}}"
                                               data-user-id="{{Auth::user() ? Auth::user()->id : 0}}">
                                                @if($count == 0)
                                                    <i class="lar la-heart"></i>
                                                @else
                                                    <i class="las la-heart"></i>
                                                @endif
                                            </a>
                                        @endif
                                    @else
                                        <a class="like" data-id="{{$winner_bid->id}}"
                                           data-user-id="{{Auth::user() ? Auth::user()->id : 0}}">
                                            <i class="lar la-heart"></i>
                                        </a>
                                    @endif
                                </div>
                                <div class="car-name">
                                    <div class="names">
                                        <h3>{{$winner_bid->vehicle_name}}</h3>
                                        <p>{{$winner_bid->category_name}}</p>
                                        <div class="feedback" style="visibility: hidden">
                                            <i class="las la-comments"></i>
                                            <a href="javascript:void(0)" data-bs-toggle="modal"
                                               data-bs-target="#feedback">Feedbacks</a>
                                        </div>
                                    </div>
                                </div>
                                <div class="car-time-specification">
                                    <div class="time-temain"
                                         @if($winner_bid->auction_end_date < date('Y-m-d') || $winner_bid->auction_start_date > date('Y-m-d')) style="visibility: hidden @endif">
                                        <span><i class="las la-clock"></i></span>
                                        <input type="hidden" id="win_vehicle_id" value="{{$winner_bid->id}}"
                                               class="win_vehicle_id">
                                        <input type="hidden" id="win_start_date_{{$winner_bid->id}}"
                                               value="{{$winner_bid->auction_end_date}}">
                                        <div class="my-auction-counter"
                                             id="win_my-auction-counter_{{$winner_bid->id}}">

                                        </div>
                                    </div>
                                    <div class="car-specifation">
                                        <div class="car-dt">
                                            <div class="icon">
                                                <img src="{{asset('web/assets/images/road.png')}}" align="road">
                                            </div>
                                            <div class="detsl">
                                                {{$winner_bid->kms_driven}}
                                            </div>
                                        </div>
                                        <div class="car-dt">
                                            <div class="icon">
                                                <img src="{{asset('web/assets/images/km.png')}}" align="km">
                                            </div>
                                            <div class="detsl">
                                                {{$winner_bid->mileage}}
                                            </div>
                                        </div>
                                        <div class="car-dt">
                                            <div class="icon">
                                                <img src="{{asset('web/assets/images/petrol.png')}}" align="petrol">
                                            </div>
                                            <div class="detsl">
                                                {{$winner_bid->fuel_type}}
                                            </div>
                                        </div>
                                        <div class="car-dt">
                                            <div class="icon">
                                                <img src="{{asset('web/assets/images/auto.png')}}" align="auto">
                                            </div>
                                            <div class="detsl">
                                                {{$winner_bid->body_type}}
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div
                                    class="car-price my-bids-price @if($winner_bid->auction_end_date < date('Y-m-d') || $winner_bid->auction_start_date > date('Y-m-d')) time-close @endif">
                                    <span>{{trans('web_string.bid_start')}} <b>{{Carbon\Carbon::parse($winner_bid->auction_start_date)->format('d M Y')}}</b></span>
                                    <span>{{trans('web_string.bid_end')}} <b>{{Carbon\Carbon::parse($winner_bid->auction_end_date)->format('d M Y')}}</b></span>
                                    <div class="initial-price-box">
                                        <p>{{trans('web_string.common_price')}}</p>
                                        <h3>SAR {{number_format($winner_bid->price)}}</h3>
                                    </div>
                                    <div class="my-bid-box">
                                        <p>{{trans('web_string.total_bids')}}</p>
                                        <h3>{{$total_bids}}</h3>
                                    </div>
                                    <div class="current-highest-bid-box">
                                        <p>{{trans('web_string.winning_bid')}}</p>
                                        <h3>SAR {{number_format($winner_bid->amount)}}</h3>
                                    </div>
                                    @php
                                        $startDate = Carbon\Carbon::parse($winner_bid->auction_start_date);
                                        $endDate = Carbon\Carbon::parse($winner_bid->auction_end_date);
                                        $dateToCheck = Carbon\Carbon::parse(date('Y-m-d'));

                                $startDateTime = Carbon\Carbon::parse($winner_bid->auction_start_date .' '. $winner_bid->auction_start_time);
                                $endDateTime = Carbon\Carbon::parse($winner_bid->auction_end_date .' ' .$winner_bid->auction_end_time);
                                    @endphp
                                    @if($dateToCheck->between($startDateTime, $endDateTime))
                                        <a href="javascript:void(0)" class="place-bid-blue vehicle_detail"
                                           data-id="{{$winner_bid->id}}">{{trans('web_string.auction_started')}}</a>
                                    @else
                                        @if($winner_bid->auction_start_date >= date('Y-m-d'))
                                            @if($dateToCheck->lt($startDateTime))
                                                <a href="#" class="place-bid-blue">{{trans('web_string.pending')}}</a>
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
                @else
                    <h3>{{trans('web_string.you_have_not_won_any_auction')}}</h3>
                @endif
            </div>
        </div>
    </section>
    <div class="clearfix"></div>
@endsection
@section('custom-script')
    <script>
        let day_string = '{{trans('web_string.day')}}';
        let hour_string = '{{trans('web_string.hours')}}';
        let min_string = '{{trans('web_string.mins')}}';
        let sec_string = '{{trans('web_string.sec')}}';
    </script>
    <script>
        $('.review-ratting').on('click', function (e) {
            e.preventDefault();
            const value_id = $(this).data('id')
            loaderView()
            $('#review_ratting_modal').modal('show')
            $('#review_user_id').val(value_id)
            loaderHide()
        })
        $('.vehicle_detail').on('click', function (e) {
            e.preventDefault();
            const value_id = $(this).data('id')
            loaderView()
            axios
                .get(APP_URL + '/vehicle-details' + '/' + value_id)
                .then(function (response) {
                    if (response.data.reload) {
                        setTimeout(() => {
                            window.location.reload();
                        }, 5000);
                    }else {
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
                    }
                })
                .catch(function (error) {
                    loaderHide()
                })
        })
        $('.btn-plus-manually').click(function () {
            var id = $(this).data('id')
            var min_bid_increment = $(this).data('minimum-bid-increment')
            var currentValue = parseInt($('#amount_' + id).val());
            if (!isNaN(currentValue)) {
                $('#amount_' + id).val(currentValue + parseInt(min_bid_increment));
            }
        });

        $('.btn-minus-manually').click(function () {
            var id = $(this).data('id')
            var min_bid_increment = $(this).data('minimum-bid-increment')
            var currentValue = parseInt($('#amount_' + id).val());
            var minValue = parseInt($('#amount_' + id).attr('min'));

            if (!isNaN(currentValue) && currentValue > minValue) {
                $('#amount_' + id).val(currentValue - parseInt(min_bid_increment));
            } else {
                notificationToast('The minimum amount you can make is this much', 'warning')
            }
        });

        $(document).on('click', '.bid-manually-submit', function () {
            loaderView();
            var vehicle_id = $(this).data('id')
            var amount = $('#amount_' + vehicle_id).val()
            axios
                .post(APP_URL + '/vehicle-bid-store', {
                    vehicle_id: vehicle_id,
                    amount: amount,
                })
                .then(function (response) {
                    loaderHide();
                    if (response.data.reload) {
                        setTimeout(() => {
                            window.location.reload();
                        }, 5000);
                    }
                    if (response.data.success == true) {
                        window.location.reload()
                        notificationToast(response.data.message, 'success');
                    } else {
                        notificationToast(response.data.message, 'warning')
                    }

                })
                .catch(function (error) {
                    console.log(error);
                    notificationToast(error.response.data.message, 'warning')
                    loaderHide();
                });
        })
    </script>
    <script src="{{asset('web/assets/js/countdown.js')}}"></script>

    <script src="{{asset('web/assets/profile/profile.js')}}?v={{time()}}"></script>
@endsection
