<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Zodha</title>
   @include('website.layouts.css')
</head>
<body>
@include('website.layouts.nav')
@yield('content')
@include('website.layouts.footer')

<!-- Modal -->
<div class="modal fade bid-model" id="carderails" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
     aria-labelledby="carderailsLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="vehicle_detail_title">Luxe Sensory 7ST</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body" id="vehicle_detail_body">
                <div class="car-details">
                    <div class="car-images">
                        <div class="product-left mb-5">
                            <div class="swiper-container product-slider mb-3">
                                <div class="swiper-wrapper">
                                    <div class="swiper-slide">
                                        <img src="{{asset('web/assets/images/car-view.jpg')}}" alt="..."
                                             class="img-fluid">
                                    </div>
                                    <div class="swiper-slide">
                                        <img src="{{asset('web/assets/images/car-view-1.jpg')}}" alt="..."
                                             class="img-fluid">
                                    </div>
                                    <div class="swiper-slide">
                                        <img src="{{asset('web/assets/images/car-view-2.jpg')}}" alt="..."
                                             class="img-fluid">
                                    </div>
                                    <div class="swiper-slide">
                                        <img src="{{asset('web/assets/images/car-view-3.jpg')}}" alt="..."
                                             class="img-fluid">
                                    </div>
                                    <div class="swiper-slide">
                                        <img src="{{asset('web/assets/images/car-view-4.jpg')}}" alt="..."
                                             class="img-fluid">
                                    </div>
                                    <div class="swiper-slide">
                                        <img src="{{asset('web/assets/images/car-view-5.jpg')}}" alt="..."
                                             class="img-fluid">
                                    </div>
                                </div>
                                <div class="swiper-button-next"></div>
                                <div class="swiper-button-prev"></div>
                            </div>

                            <div class="swiper-container product-thumbs">
                                <div class="swiper-wrapper">
                                    <div class="swiper-slide">
                                        <img src="{{asset('web/assets/images/car-view.jpg')}}" alt="..."
                                             class="img-fluid">
                                    </div>
                                    <div class="swiper-slide">
                                        <img src="{{asset('web/assets/images/car-view-1.jpg')}}" alt="..."
                                             class="img-fluid">
                                    </div>
                                    <div class="swiper-slide">
                                        <img src="{{asset('web/assets/images/car-view-2.jpg')}}" alt="..."
                                             class="img-fluid">
                                    </div>
                                    <div class="swiper-slide">
                                        <img src="{{asset('web/assets/images/car-view-3.jpg')}}" alt="..."
                                             class="img-fluid">
                                    </div>
                                    <div class="swiper-slide">
                                        <img src="{{asset('web/assets/images/car-view-4.jpg')}}" alt="..."
                                             class="img-fluid">
                                    </div>
                                    <div class="swiper-slide">
                                        <img src="{{asset('web/assets/images/car-view-5.jpg')}}" alt="..."
                                             class="img-fluid">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="car-dtlist">
                        <div class="dtl-box">
                            <div class="tit">
                                <img src="{{asset('web/assets/images/road.png')}}" align="road">
                                <p>Registration Year</p>
                            </div>
                            <div class="value">
                                <p>2019</p>
                            </div>
                        </div>
                        <div class="dtl-box">
                            <div class="tit">
                                <img src="{{asset('web/assets/images/road.png')}}" align="road">
                                <p>Make</p>
                            </div>
                            <div class="value">
                                <p>Infiniti</p>
                            </div>
                        </div>
                        <div class="dtl-box">
                            <div class="tit">
                                <img src="{{asset('web/assets/images/road.png')}}" align="road">
                                <p>Model</p>
                            </div>
                            <div class="value">
                                <p>Luxe</p>
                            </div>
                        </div>
                        <div class="dtl-box">
                            <div class="tit">
                                <img src="{{asset('web/assets/images/road.png')}}" align="road">
                                <p>Trim</p>
                            </div>
                            <div class="value">
                                <p>2.8 s</p>
                            </div>
                        </div>
                        <div class="dtl-box">
                            <div class="tit">
                                <img src="{{asset('web/assets/images/road.png')}}" align="road">
                                <p>KMs Driven</p>
                            </div>
                            <div class="value">
                                <p>69000 Km</p>
                            </div>
                        </div>
                        <div class="dtl-box">
                            <div class="tit">
                                <img src="{{asset('web/assets/images/road.png')}}" align="road">
                                <p>No. of Owners</p>
                            </div>
                            <div class="value">
                                <p>2</p>
                            </div>
                        </div>
                        <div class="dtl-box">
                            <div class="tit">
                                <img src="{{asset('web/assets/images/road.png')}}" align="road">
                                <p>Transmission</p>
                            </div>
                            <div class="value">
                                <p>Automatic</p>
                            </div>
                        </div>
                        <div class="dtl-box">
                            <div class="tit">
                                <img src="{{asset('web/assets/images/road.png')}}" align="road">
                                <p>Fuel Type</p>
                            </div>
                            <div class="value">
                                <p>Petrol</p>
                            </div>
                        </div>
                        <div class="dtl-box">
                            <div class="tit">
                                <img src="{{asset('web/assets/images/road.png')}}" align="road">
                                <p>Body Type</p>
                            </div>
                            <div class="value">
                                <p>SUV</p>
                            </div>
                        </div>
                        <div class="dtl-box">
                            <div class="tit">
                                <img src="{{asset('web/assets/images/road.png')}}" align="road">
                                <p>Registration</p>
                            </div>
                            <div class="value">
                                <p>UAE</p>
                            </div>
                        </div>
                        <div class="dtl-box">
                            <div class="tit">
                                <img src="{{asset('web/assets/images/road.png')}}" align="road">
                                <p>Mileage</p>
                            </div>
                            <div class="value">
                                <p>12 kmpl</p>
                            </div>
                        </div>
                    </div>
                    <div class="car-opt"></div>
                </div>
            </div>
        </div>
    </div>
</div>
@include('website.layouts.script')
@yield('custom-script')
</body>
</html>

