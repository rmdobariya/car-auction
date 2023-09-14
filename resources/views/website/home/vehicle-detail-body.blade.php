<div class="car-details">
    <div class="car-images">
        <div class="product-left mb-5">
            <div class="swiper-container product-slider mb-3">
                <div class="swiper-wrapper">
{{--                    @foreach($vehicle_images as $vehicle_image)--}}
                    <div class="swiper-slide">
                        <img src="{{asset($vehicle->main_image)}}" alt="..." class="img-fluid">
                    </div>
{{--                    @endforeach--}}
                </div>
                <div class="swiper-button-next"></div>
                <div class="swiper-button-prev"></div>
            </div>

            <div class="swiper-container product-thumbs">
                <div class="swiper-wrapper">
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
                <img src="web/assets/images/road.png" align="road">
                <p>Registration Year</p>
            </div>
            <div class="value">
                <p>{{$vehicle->year}}</p>
            </div>
        </div>
        <div class="dtl-box">
            <div class="tit">
                <img src="web/assets/images/road.png" align="road">
                <p>Make</p>
            </div>
            <div class="value">
                <p>{{$vehicle->make}}</p>
            </div>
        </div>
        <div class="dtl-box">
            <div class="tit">
                <img src="web/assets/images/road.png" align="road">
                <p>Model</p>
            </div>
            <div class="value">
                <p>{{$vehicle->model}}</p>
            </div>
        </div>
        <div class="dtl-box">
            <div class="tit">
                <img src="web/assets/images/road.png" align="road">
                <p>Trim</p>
            </div>
            <div class="value">
                <p>{{$vehicle->trim}}</p>
            </div>
        </div>
        <div class="dtl-box">
            <div class="tit">
                <img src="web/assets/images/road.png" align="road">
                <p>KMs Driven</p>
            </div>
            <div class="value">
                <p>{{$vehicle->kms_driven}}</p>
            </div>
        </div>
        <div class="dtl-box">
            <div class="tit">
                <img src="web/assets/images/road.png" align="road">
                <p>No. of Owners</p>
            </div>
            <div class="value">
                <p>{{$vehicle->owners}}</p>
            </div>
        </div>
        <div class="dtl-box">
            <div class="tit">
                <img src="web/assets/images/road.png" align="road">
                <p>Transmission</p>
            </div>
            <div class="value">
                <p>{{$vehicle->transmission}}</p>
            </div>
        </div>
        <div class="dtl-box">
            <div class="tit">
                <img src="web/assets/images/road.png" align="road">
                <p>Fuel Type</p>
            </div>
            <div class="value">
                <p>{{$vehicle->fuel_type}}</p>
            </div>
        </div>
        <div class="dtl-box">
            <div class="tit">
                <img src="web/assets/images/road.png" align="road">
                <p>Body Type</p>
            </div>
            <div class="value">
                <p>{{$vehicle->body_type}}</p>
            </div>
        </div>
        <div class="dtl-box">
            <div class="tit">
                <img src="web/assets/images/road.png" align="road">
                <p>Registration</p>
            </div>
            <div class="value">
                <p>{{$vehicle->registration}}</p>
            </div>
        </div>
        <div class="dtl-box">
            <div class="tit">
                <img src="web/assets/images/road.png" align="road">
                <p>Mileage</p>
            </div>
            <div class="value">
                <p>{{$vehicle->mileage}}</p>
            </div>
        </div>
    </div>
    <div class="car-opt">
        <div class="carnm">
            <h2>{{$vehicle->category_name}}</h2>
            <p>{{$vehicle->vehicle_name}}</p>
        </div>
        <div class="ini-price">
            <p>Initial Price</p>
            <p><span>SAR {{number_format($vehicle->price)}}</span></p>
        </div>
        <div class="int-box">
            <p><i class="las la-user"></i> 42 people are interested</p>
            <a href="#" class="place-bid-blue">Place Bid</a>
            <div class="current-high">
                <p>Current Highest Bid</p>
                <p><span>SAR 78,000</span></p>
            </div>
        </div>
        <div class="auction-details">
            <h3>Auction Details</h3>
            <div class="createdon">
                <span><i class="las la-calendar"></i></span>
                <div class="dates">
                    <p>Created on</p>
                    <b>15/07/2023</b>
                </div>
            </div>
            <div class="createdon">
                <span><i class="las la-calendar"></i></span>
                <div class="dates">
                    <p>Ends on</p>
                    <b>15/08/2023</b>
                </div>
            </div>
            <div class="time-temain">
                <span><i class="las la-clock"></i></span>
                <div id="getting-started"></div>
            </div>
            <div class="notes">
                <h3>Seller Notes</h3>
                <p>It is a long established fact that a reader will be distracted by the readable
                    content of a page when looking at its layout. The point of using Lorem Ipsum</p>
            </div>
        </div>
    </div>
</div>
<script src="{{asset('web/assets/js/countdown.js')}}"></script>
