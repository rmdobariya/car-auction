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
        <a href="#" class="place-bid-blue car_inquiry mb-2"
           data-id="{{$vehicle->id}}">{{trans('web_string.contact_seller')}}</a>
        <div class="auction-details">
            <div class="notes">
                <h3>{{trans('web_string.seller_notes')}}</h3>
                <p>{{$vehicle->description}}</p>
            </div>
        </div>
    </div>
</div>
<script>
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
