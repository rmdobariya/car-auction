@extends('website.layouts.master')
@section('title')
    {{trans('web_string.type_wise_vehicle ')}}
@endsection
@section('content')
    <section id="vehicles" class="featured-vehicles">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="heading">
                        <h1>{{$title}}</h1>
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
                                <div class="time-temain" id="time-temain_{{$vehicle->id}}"
                                     @if($vehicle->auction_end_date <  date('Y-m-d') || $vehicle->auction_start_date > date('Y-m-d')) style="visibility: hidden" @endif>
                                    <span><i class="las la-clock"></i></span>
                                    <input type="hidden" id="vehicle_id" value="{{$vehicle->id}}"
                                           class="vehicle_id">
                                    <input type="hidden" id="start_date_{{$vehicle->id}}"
                                           value="{{$vehicle->auction_start_date}}">
                                    <input type="hidden" id="start_time_{{$vehicle->id}}"
                                           value="{{$vehicle->auction_start_time}}">
                                    <input type="hidden" id="end_time_{{$vehicle->id}}"
                                           value="{{$vehicle->auction_end_time}}">
                                    <input type="hidden" id="end_date_{{$vehicle->id}}"
                                           value="{{$vehicle->auction_end_date}}">
                                    <div class="my-auction-counter"
                                         id="my-auction-counter_{{$vehicle->id}}">

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
                                @php
                                    $startDate = Carbon\Carbon::parse($vehicle->auction_start_date);
                                    $endDate = Carbon\Carbon::parse($vehicle->auction_end_date);

                                    $startDateTime = Carbon\Carbon::parse($vehicle->auction_start_date .' '. $vehicle->auction_start_time);
                                    $endDateTime = Carbon\Carbon::parse($vehicle->auction_end_date .' ' .$vehicle->auction_end_time);
                                    $dateToCheck = Carbon\Carbon::now();
    //                                    $dateToCheck = Carbon\Carbon::parse(date('Y-m-d'));
                                    $bid_count = 0;
                                    $proof_check = null;
                                    $payment_status = 'pending';
                                    if(!is_null(Auth::guard('web')->user())){
                                         $bid_count = DB::table('vehicle_bids')->where('user_id',Auth::guard('web')->user()->id)->count();
                                         $proof_check = DB::table('payment_proofs')->where('user_id',Auth::guard('web')->user()->id)->first();
                                         if(!is_null($proof_check)){
                                         $payment_status = $proof_check->status;
                                         }
                                    }
                                $bid = DB::table('vehicle_bids')->where('vehicle_id', $vehicle->id)->orderBy('amount', 'desc')->first();
                                $bid_amount = $vehicle->price;
                                if (!is_null($bid)) {
                                $last_bid_amount = $bid->amount;
                                $bid_amount = $bid->amount;
                                }
                                @endphp
                                @if($dateToCheck->between($startDateTime, $endDateTime) == true)
                                    <div class="input-group">
                                        <span class="input-group-btn">
                                            <button type="button" class="btn btn-default btn-minus btn-minus-manually"
                                                    id="btn-minus"
                                                    data-minimum-bid-increment="{{$vehicle->bid_increment}}"
                                                    data-id="{{$vehicle->id}}">
                                                <i class="fas fa-minus"></i>
                                            </button>
                                        </span>
                                        <input type="text" name="amount[{{$vehicle->id}}]"
                                               id="amount_{{$vehicle->id}}"
                                               class="form-control input-number integer"
                                               value="{{$bid_amount}}"
                                               placeholder="{{trans('web_string.amount')}}"
                                               min="{{$bid_amount}}" readonly>
                                        <span class="input-group-btn">
                                            <button type="button" class="btn btn-default btn-plus btn-plus-manually"
                                                    id="btn-plus"
                                                    data-minimum-bid-increment="{{$vehicle->bid_increment}}"
                                                    data-id="{{$vehicle->id}}">
                                                <i class="fas fa-plus"></i>
                                            </button>
                                            <a class="btn place-bid-blue-manually @if($bid_count == 0 && $payment_status == 'pending' || $payment_status == 'reject') disabled-link @endif bid-manually-submit"
                                               data-id="{{$vehicle->id}}">
                                                {{trans('web_string.place_bid')}}
                                            </a>
                                        </span>
                                    </div>
                                @endif
                            </div>

                            <div
                                class="car-price my-bids-price @if($dateToCheck->between($startDateTime, $endDateTime) == false) time-close @endif">
                                <span>Bid Start <b>{{Carbon\Carbon::parse($vehicle->auction_start_date)->format('d M Y')}}</b></span>
                                <span>Bid End <b>{{Carbon\Carbon::parse($vehicle->auction_end_date)->format('d M Y')}}</b></span>
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

                                @if($dateToCheck->between($startDateTime, $endDateTime))
                                    @if($payment_status != 'reject')
                                        <a href="#"
                                           class="place-bid mb-1  @if($bid_count == 0 && $payment_status == 'pending') disabled-link @endif"
                                           data-id="{{$vehicle->id}}">{{trans('web_string.place_bid')}}</a>
                                    @endif

                                    @if(!is_null($proof_check) && $proof_check->status == 'pending')
                                        <a class="mb-1 mt-1 waiting_for_admin_approval"
                                           data-id="{{$vehicle->id}}">{{trans('web_string.waiting_for_admin_approval')}}</a>
                                    @elseif(!is_null($proof_check) && $proof_check->status == 'approved')
                                        <a class="mb-1 mt-1 payment_proof_approved"
                                           data-id="{{$vehicle->id}}">{{trans('web_string.payment_proof_approved')}}</a>
                                    @else
                                        <a href="#" class="payment-proof mb-1"
                                           data-id="{{$vehicle->id}}">{{trans('web_string.payment_proof')}}</a>
                                        @if($payment_status == 'reject')
                                            <a class="mb-1 text-danger payment_proof_reject_by_admin"
                                               data-id="{{$vehicle->id}}">{{trans('web_string.payment_proof_reject_by_admin')}}</a>
                                        @endif
                                    @endif
                                @endif
                                @if($dateToCheck->between($startDateTime, $endDateTime))
                                    <a href="javascript:void(0)" class="place-bid-blue vehicle_detail"
                                       data-id="{{$vehicle->id}}">{{trans('web_string.view_auction')}}</a>
                                @else
                                    @if($vehicle->auction_start_date >= date('Y-m-d'))
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
    @if(count($testimonials) > 0)
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
                                                                <p>{{ $testimonial->review }}</p>
                                                            </div>
                                                            <div class="testimonial_box-name">
                                                                <h4>{{$testimonial->user_name}}</h4>
                                                            </div>
                                                            <div class="testimonial_box-job">
                                                                <div class="rated">
                                                                    @for($i=1; $i<=$testimonial->rating; $i++)
                                                                        <label class="star-rating-complete"
                                                                               title="text">{{$i}}
                                                                            stars</label>
                                                                    @endfor
                                                                </div>
                                                            </div>
                                                            <div class="testimonial_box-img">
                                                                <img src="{{asset('web/assets/images/icon.png')}}"
                                                                     alt="profile">
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
    @endif
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
    <script src="{{asset('web/assets/js/countdown.js')}}"></script>
    <script>
        let day_string = '{{trans('web_string.day')}}';
        let hour_string = '{{trans('web_string.hours')}}';
        let min_string = '{{trans('web_string.mins')}}';
        let sec_string = '{{trans('web_string.sec')}}';
    </script>
    <script>
        var $j_object = $(".vehicle_id");
        // $j_object.each(function (i) {
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

        $('.place-bid').on('click', function (e) {
            e.preventDefault();
            const value_id = $(this).data('id')
            loaderView()
            axios
                .get(APP_URL + '/vehicle-bid-modal' + '/' + value_id)
                .then(function (response) {
                    $('#vehicle_bid_label').html(response.data.modal_title)
                    $('#vehicle_bid_body').html(response.data.data)

                    $('#vehicle_bid_modal').modal('show')
                    loaderHide()
                })
                .catch(function (error) {
                    loaderHide()
                })

        })
        $('.payment-proof').on('click', function (e) {
            e.preventDefault();
            const value_id = $(this).data('id')
            loaderView()
            axios
                .get(APP_URL + '/payment-proof-modal' + '/' + value_id)
                .then(function (response) {
                    $('#paymentProofLabel').html(response.data.modal_title)
                    $('#payment_poof_body').html(response.data.data)
                    $('#carderails').modal('hide')
                    $('#payment_poof_modal').modal('show')
                    loaderHide()
                })
                .catch(function (error) {
                    loaderHide()
                })

        })

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
    <script src="{{asset('web/assets/custom/home/home.js')}}?v={{time()}}"></script>
@endsection
