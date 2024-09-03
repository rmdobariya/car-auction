<div class="car-details">
    <div class="car-images">
        <div class="product-left mb-5">
            <div class="swiper-container product-slider mb-3">
                <div class="swiper-wrapper">
                    <div class="swiper-slide">
                        <img src="{{asset($vehicle->main_image)}}" alt="..." class="img-fluid">
                    </div>

                    @foreach($vehicle_images as $vehicle_image)
                        <div class="swiper-slide">
                            <img src="{{asset($vehicle_image->image)}}" alt="..." class="img-fluid">
                        </div>
                    @endforeach
                </div>
                <div class="swiper-button-next"></div>
                <div class="swiper-button-prev"></div>
            </div>

            <div class="swiper-container product-thumbs">
                <div class="swiper-wrapper">
                    <div class="swiper-slide">
                        <img src="{{asset($vehicle->main_image)}}" alt="..." class="img-fluid">
                    </div>
                    @foreach($vehicle_images as $vehicle_image)
                        <div class="swiper-slide">
                            <img src="{{asset($vehicle_image->image)}}" alt="..." class="img-fluid">
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
    <div class="car-dtlist">
        @if(!is_null($vehicle->year))
            <div class="dtl-box">
                <div class="tit">
                    <img src="{{asset('web/assets/images/registration.svg')}}" align="road">
                    <p>{{trans('web_string.registration_year')}}</p>
                </div>
                <div class="value">
                    <p>{{$vehicle->year}}</p>
                </div>
            </div>
        @endif
        <div class="dtl-box">
            <div class="tit">
                <img src="{{asset('web/assets/images/make.svg')}}" align="road">
                <p>{{trans('web_string.make')}}</p>
            </div>
            <div class="value">
                <p>{{$vehicle->make}}</p>
            </div>
        </div>
        <div class="dtl-box">
            <div class="tit">
                <img src="{{asset('web/assets/images/model.svg')}}" align="road">
                <p>{{trans('web_string.model')}}</p>
            </div>
            <div class="value">
                <p>{{$vehicle->model}}</p>
            </div>
        </div>
        @if(!is_null($vehicle->trim))
            <div class="dtl-box">
                <div class="tit">
                    <img src="{{asset('web/assets/images/trim.svg')}}" align="road">
                    <p>{{trans('web_string.trim')}}</p>
                </div>
                <div class="value">
                    <p>{{$vehicle->trim}}</p>
                </div>
            </div>
        @endif
        @if(!is_null($vehicle->kms_driven))
            <div class="dtl-box">
                <div class="tit">
                    <img src="{{asset('web/assets/images/kms-driven.svg')}}" align="road">
                    <p>{{trans('web_string.kms_driven')}}</p>
                </div>
                <div class="value">
                    <p>{{$vehicle->kms_driven}}</p>
                </div>
            </div>
        @endif
        {{--        <div class="dtl-box">--}}
        {{--            <div class="tit">--}}
        {{--                <img src="{{asset('web/assets/images/no-of-owners.svg')}}" align="road">--}}
        {{--                <p>{{trans('web_string.no_of_owners')}}</p>--}}
        {{--            </div>--}}
        {{--            <div class="value">--}}
        {{--                <p>{{$vehicle->owners}}</p>--}}
        {{--            </div>--}}
        {{--        </div>--}}
        @if(!is_null($vehicle->transmission))
            <div class="dtl-box">
                <div class="tit">
                    <img src="{{asset('web/assets/images/transmission.svg')}}" align="road">
                    <p>{{trans('web_string.transmission')}}</p>
                </div>
                <div class="value">
                    <p>{{$vehicle->transmission}}</p>
                </div>
            </div>
        @endif
        @if(!is_null($vehicle->fuel_type))
            <div class="dtl-box">
                <div class="tit">
                    <img src="{{asset('web/assets/images/fuel-type.svg')}}" align="petrol">
                    <p>{{trans('web_string.fuel_type')}}</p>
                </div>
                <div class="value">
                    <p>{{$vehicle->fuel_type}}</p>
                </div>
            </div>
        @endif
        @if(!is_null($vehicle->body_type))
            <div class="dtl-box">
                <div class="tit">
                    <img src="{{asset('web/assets/images/body-type.svg')}}" align="auto">
                    <p>{{trans('web_string.body_type')}}</p>
                </div>
                <div class="value">
                    <p>{{$vehicle->body_type}}</p>
                </div>
            </div>
        @endif
        @if(!is_null($vehicle->registration))
            <div class="dtl-box">
                <div class="tit">
                    <img src="{{asset('web/assets/images/registration.svg')}}" align="road">
                    <p>{{trans('web_string.registration')}}</p>
                </div>
                <div class="value">
                    <p>{{$vehicle->registration}}</p>
                </div>
            </div>
        @endif
        @if(!is_null($vehicle->mileage))
            <div class="dtl-box">
                <div class="tit">
                    <img src="{{asset('web/assets/images/mileage.svg')}}" align="km">
                    <p>{{trans('web_string.mileage')}}</p>
                </div>
                <div class="value">
                    <p>{{$vehicle->mileage}}</p>
                </div>
            </div>
        @endif
    </div>
    <div class="car-opt">
        <div class="carnm">
            <h2>{{$vehicle->category_name}}</h2>
            <p>{{$vehicle->name}}</p>
        </div>
        <div class="ini-price">
            <p>{{trans('web_string.common_price')}}</p>
            <p><span>SAR {{number_format($vehicle->price)}}</span></p>
        </div>
        <div class="int-box">
            {{-- @dd('2023-09-22' > '2023-09-26' && '2023-09-22' < '2023-10-06');--}}
            @if($bid_count > 0)
                <p><i class="las la-user"></i> {{$bid_count}} {{trans('web_string.people_are_interested')}}</p>
            @endif
            @php
                $startDate = Carbon\Carbon::parse($vehicle->auction_start_date);
                $endDate = Carbon\Carbon::parse($vehicle->auction_end_date);
                $dateToCheck = Carbon\Carbon::parse(date('Y-m-d'));
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
            @endphp
            @if($dateToCheck->between($startDate, $endDate))
                @if($payment_status != 'reject')
                    <a href="#"
                       class="place-bid mb-1  @if($bid_count == 0 && $payment_status == 'pending' || $payment_status == 'reject') disabled-link @endif"
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
            @else
                @if($vehicle->auction_start_date > date('Y-m-d'))
                    <a href="#" class="place-bid-blue">{{trans('web_string.pending')}}</a>
                @else
                    <a href="#" class="place-bid-blue">{{trans('web_string.auction_close')}}</a>
                @endif
            @endif
            @php
                if(!is_null(Auth::user())){
                $height_bid = DB::table('vehicle_bids')->where('vehicle_id',$vehicle->id)->where('user_id',Auth::user()->id)->max('amount');
                }else{
                $height_bid = DB::table('vehicle_bids')->where('vehicle_id',$vehicle->id)->max('amount');
                }
            @endphp
            <div class="current-high @if($vehicle->auction_start_date > date('Y-m-d')) d-none @endif mt-1">
                @if($height_bid == 0)
                    {{trans('web_string.bid_not_found')}}
                @else
                    <p>{{trans('web_string.current_height_bid')}}</p>
                    <p><span>SAR {{ number_format($height_bid) }}
                            @endif
                    </span>
                    </p>
            </div>
        </div>
        <div class="auction-details">
            <h3>{{trans('web_string.auction_details')}}</h3>
            <div class="createdon">
                <span><i class="las la-calendar"></i></span>
                <div class="dates">
                    <p>{{trans('web_string.created_on')}}</p>
                    <b>{{$vehicle->auction_start_date}}</b>
                </div>
            </div>
            <div class="createdon">
                <span><i class="las la-calendar"></i></span>
                <div class="dates">
                    <p>{{trans('web_string.ends_on')}}</p>
                    <b>{{$vehicle->auction_end_date}}</b>
                </div>
            </div>
            <div class="time-temain">
                <span><i class="las la-clock"></i></span>
                <div id="getting-started"></div>
            </div>
            <div class="notes">
                <h3>{{trans('web_string.seller_notes')}}</h3>
                <p>{{$vehicle->description}}</p>
            </div>
        </div>
    </div>
</div>
<script src="{{asset('web/assets/js/countdown.js')}}"></script>
<script>
    // console.log(start_date)
    // $("#getting-started")
    //     .countdown(formattedDateTime, function (event) {
    //         $(this).html(
    //             event.strftime('<span>Day<strong>%D</strong></span> <span>Hours<strong>%H</strong></span> <span>Mins<strong>%M</strong> </span> <span>Sec<strong>%S</strong></span>')
    //         );
    //     });
    var id = '{{$vehicle->id}}';
    var start_date = '{{$vehicle->auction_end_date}}';
    var start_time = '{{$vehicle->auction_start_time}}';
    var end_date = '{{$vehicle->auction_end_date}}';
    var end_time = '{{$vehicle->auction_end_time}}';

    var startDateTime = new Date(start_date + ' ' + start_time);
    var endDateTime = new Date(end_date + ' ' + end_time);

    function updateCountdown() {
        var now = new Date().getTime();
        var timeLeft = endDateTime - now;

        var days = Math.floor(timeLeft / (1000 * 60 * 60 * 24));
        var hours = Math.floor((timeLeft % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
        var minutes = Math.floor((timeLeft % (1000 * 60 * 60)) / (1000 * 60));
        var seconds = Math.floor((timeLeft % (1000 * 60)) / 1000);

        $("#getting-started").html(
            '<span>' + day_string + '<strong>' + days + '</strong></span> ' +
            '<span>' + hour_string + '<strong>' + hours + '</strong></span> ' +
            '<span>' + min_string + '<strong>' + minutes + '</strong> </span> ' +
            '<span>' + sec_string + '<strong>' + seconds + '</strong></span>'
        );

        if (timeLeft < 0) {
            clearInterval(countdownInterval);
            $("#getting-started").html("");
            $("#time-temain_" + id).addClass("d-none");
        }
    }

    // Update the countdown every second
    var countdownInterval = setInterval(updateCountdown, 1000);

    // Initial call to display the countdown immediately
    updateCountdown();
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
</script>
