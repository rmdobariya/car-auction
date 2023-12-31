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
        <div class="dtl-box">
            <div class="tit">
                <img src="{{asset('web/assets/images/registration.svg')}}" align="road">
                <p>{{trans('web_string.registration_year')}}</p>
            </div>
            <div class="value">
                <p>{{$vehicle->year}}</p>
            </div>
        </div>
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
        <div class="dtl-box">
            <div class="tit">
                <img src="{{asset('web/assets/images/trim.svg')}}" align="road">
                <p>{{trans('web_string.trim')}}</p>
            </div>
            <div class="value">
                <p>{{$vehicle->trim}}</p>
            </div>
        </div>
        <div class="dtl-box">
            <div class="tit">
                <img src="{{asset('web/assets/images/kms-driven.svg')}}" align="road">
                <p>{{trans('web_string.kms_driven')}}</p>
            </div>
            <div class="value">
                <p>{{$vehicle->kms_driven}}</p>
            </div>
        </div>
        <div class="dtl-box">
            <div class="tit">
                <img src="{{asset('web/assets/images/no-of-owners.svg')}}" align="road">
                <p>{{trans('web_string.no_of_owners')}}</p>
            </div>
            <div class="value">
                <p>{{$vehicle->owners}}</p>
            </div>
        </div>
        <div class="dtl-box">
            <div class="tit">
                <img src="{{asset('web/assets/images/transmission.svg')}}" align="road">
                <p>{{trans('web_string.transmission')}}</p>
            </div>
            <div class="value">
                <p>{{$vehicle->transmission}}</p>
            </div>
        </div>
        <div class="dtl-box">
            <div class="tit">
                <img src="{{asset('web/assets/images/fuel-type.svg')}}" align="petrol">
                <p>{{trans('web_string.fuel_type')}}</p>
            </div>
            <div class="value">
                <p>{{$vehicle->fuel_type}}</p>
            </div>
        </div>
        <div class="dtl-box">
            <div class="tit">
                <img src="{{asset('web/assets/images/body-type.svg')}}" align="auto">
                <p>{{trans('web_string.body_type')}}</p>
            </div>
            <div class="value">
                <p>{{$vehicle->body_type}}</p>
            </div>
        </div>
        <div class="dtl-box">
            <div class="tit">
                <img src="{{asset('web/assets/images/registration.svg')}}" align="road">
                <p>{{trans('web_string.registration')}}</p>
            </div>
            <div class="value">
                <p>{{$vehicle->registration}}</p>
            </div>
        </div>
        <div class="dtl-box">
            <div class="tit">
                <img src="{{asset('web/assets/images/mileage.svg')}}" align="km">
                <p>{{trans('web_string.mileage')}}</p>
            </div>
            <div class="value">
                <p>{{$vehicle->mileage}}</p>
            </div>
        </div>
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
            @endphp
            @if($dateToCheck->between($startDate, $endDate))
            <a href="#" class="place-bid" data-id="{{$vehicle->id}}">{{trans('web_string.place_bid')}}</a>
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
    var start_date = '{{$vehicle->auction_end_date}}';
    var auction_end_date = new Date(start_date);
    var targetDate = new Date(auction_end_date);
    targetDate.setHours(23);
    targetDate.setMinutes(60);
    targetDate.setSeconds(60);
    var formattedDateTime = targetDate.toISOString().slice(0, 24).replace('T', ' ');
    console.log(start_date)
    $("#getting-started")
        .countdown(formattedDateTime, function(event) {
            $(this).html(
                event.strftime('<span>Day<strong>%D</strong></span> <span>Hours<strong>%H</strong></span> <span>Mins<strong>%M</strong> </span> <span>Sec<strong>%S</strong></span>')
            );
        });
    $('.place-bid').on('click', function() {
        const value_id = $(this).data('id')
        loaderView()
        axios
            .get(APP_URL + '/vehicle-bid-modal' + '/' + value_id)
            .then(function(response) {
                $('#vehicle_bid_label').html(response.data.modal_title)
                $('#vehicle_bid_body').html(response.data.data)

                $('#vehicle_bid_modal').modal('show')
                loaderHide()
            })
            .catch(function(error) {
                loaderHide()
            })

    })
</script>
