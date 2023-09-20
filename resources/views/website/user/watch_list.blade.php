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
                    <div class="details-box bid-details-box">
                        <div class="car-img">
                            <img src="images/car.jpg" align="car">
                            <span class="cat-tags"><img src="images/dymand.png"> Featured</span>
                            <a href="javascript:void(0)" class="like"><i class="las la-heart"></i></a>
                        </div>
                        <div class="car-name">
                            <div class="names">
                                <h3>2019 Infiniti QX80</h3>
                                <p>Luxe Sensory 7ST</p>
                                <div class="feedback">
                                    <i class="las la-comments"></i>
                                    <a href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#feedback">Feedbacks</a>
                                </div>
                            </div>
                        </div>
                        <div class="car-time-specification">
                            <div class="time-temain">
                                <span><i class="las la-clock"></i></span>
                                <div id="getting-started1"></div>
                            </div>
                            <div class="car-specifation">
                                <div class="car-dt">
                                    <div class="icon">
                                        <img src="images/road.png" align="road">
                                    </div>
                                    <div class="detsl">
                                        20,500 km
                                    </div>
                                </div>
                                <div class="car-dt">
                                    <div class="icon">
                                        <img src="images/km.png" align="km">
                                    </div>
                                    <div class="detsl">
                                        16.5 kmpl
                                    </div>
                                </div>
                                <div class="car-dt">
                                    <div class="icon">
                                        <img src="images/petrol.png" align="petrol">
                                    </div>
                                    <div class="detsl">
                                        Petrol
                                    </div>
                                </div>
                                <div class="car-dt">
                                    <div class="icon">
                                        <img src="images/auto.png" align="auto">
                                    </div>
                                    <div class="detsl">
                                        Auto
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="car-price my-bids-price">
                            <div class="initial-price-box">
                                <p>Initial Price</p>
                                <h3>SAR 50,000</h3>
                            </div>
                            <div class="my-bid-box">
                                <p>My Bid</p>
                                <h3>SAR 55,000</h3>
                            </div>
                            <div class="current-highest-bid-box">
                                <p>Current Highest Bid</p>
                                <h3>SAR 78,000</h3>
                            </div>
                            <a href="javascript:void(0)" class="place-bid-blue update-bid" data-bs-toggle="modal" data-bs-target="#carderails">View Auction</a>
                        </div>
                    </div>
                    <div class="details-box bid-details-box">
                        <div class="car-img">
                            <img src="images/car.jpg" align="car">
                            <span class="cat-tags"><img src="images/dymand.png"> Featured</span>
                            <a href="javascript:void(0)" class="like"><i class="las la-heart"></i></a>
                        </div>
                        <div class="car-name">
                            <div class="names">
                                <h3>2019 Infiniti QX80</h3>
                                <p>Luxe Sensory 7ST</p>
                                <div class="feedback">
                                    <i class="las la-comments"></i>
                                    <a href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#feedback">Feedbacks</a>
                                </div>
                            </div>
                        </div>
                        <div class="car-time-specification">
                            <div class="time-temain">
                                <span><i class="las la-clock"></i></span>
                                <div id="getting-started2"></div>
                            </div>
                            <div class="car-specifation">
                                <div class="car-dt">
                                    <div class="icon">
                                        <img src="images/road.png" align="road">
                                    </div>
                                    <div class="detsl">
                                        20,500 km
                                    </div>
                                </div>
                                <div class="car-dt">
                                    <div class="icon">
                                        <img src="images/km.png" align="km">
                                    </div>
                                    <div class="detsl">
                                        16.5 kmpl
                                    </div>
                                </div>
                                <div class="car-dt">
                                    <div class="icon">
                                        <img src="images/petrol.png" align="petrol">
                                    </div>
                                    <div class="detsl">
                                        Petrol
                                    </div>
                                </div>
                                <div class="car-dt">
                                    <div class="icon">
                                        <img src="images/auto.png" align="auto">
                                    </div>
                                    <div class="detsl">
                                        Auto
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="car-price my-bids-price">
                            <div class="initial-price-box">
                                <p>Initial Price</p>
                                <h3>SAR 50,000</h3>
                            </div>
                            <div class="my-bid-box">
                                <p>My Bid</p>
                                <h3>SAR 55,000</h3>
                            </div>
                            <div class="current-highest-bid-box">
                                <p>Current Highest Bid</p>
                                <h3>SAR 78,000</h3>
                            </div>
                            <a href="javascript:void(0)" class="place-bid-blue update-bid" data-bs-toggle="modal" data-bs-target="#carderails">View Auction</a>
                        </div>
                    </div>
                    <div class="details-box bid-details-box">
                        <div class="car-img">
                            <img src="images/car.jpg" align="car">
                            <span class="cat-tags"><img src="images/dymand.png"> Featured</span>
                            <a href="javascript:void(0)" class="like"><i class="las la-heart"></i></a>
                        </div>
                        <div class="car-name">
                            <div class="names">
                                <h3>2019 Infiniti QX80</h3>
                                <p>Luxe Sensory 7ST</p>
                                <div class="feedback">
                                    <i class="las la-comments"></i>
                                    <a href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#feedback">Feedbacks</a>
                                </div>
                            </div>
                        </div>
                        <div class="car-time-specification">
                            <div class="time-temain">
                                <span><i class="las la-clock"></i></span>
                                <div id="getting-started3"></div>
                            </div>
                            <div class="car-specifation">
                                <div class="car-dt">
                                    <div class="icon">
                                        <img src="images/road.png" align="road">
                                    </div>
                                    <div class="detsl">
                                        20,500 km
                                    </div>
                                </div>
                                <div class="car-dt">
                                    <div class="icon">
                                        <img src="images/km.png" align="km">
                                    </div>
                                    <div class="detsl">
                                        16.5 kmpl
                                    </div>
                                </div>
                                <div class="car-dt">
                                    <div class="icon">
                                        <img src="images/petrol.png" align="petrol">
                                    </div>
                                    <div class="detsl">
                                        Petrol
                                    </div>
                                </div>
                                <div class="car-dt">
                                    <div class="icon">
                                        <img src="images/auto.png" align="auto">
                                    </div>
                                    <div class="detsl">
                                        Auto
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="car-price my-bids-price">
                            <div class="initial-price-box">
                                <p>Initial Price</p>
                                <h3>SAR 50,000</h3>
                            </div>
                            <div class="my-bid-box">
                                <p>My Bid</p>
                                <h3>SAR 55,000</h3>
                            </div>
                            <div class="current-highest-bid-box">
                                <p>Current Highest Bid</p>
                                <h3>SAR 78,000</h3>
                            </div>
                            <a href="javascript:void(0)" class="place-bid-blue update-bid" data-bs-toggle="modal" data-bs-target="#carderails">View Auction</a>
                        </div>
                    </div>
                    <div class="details-box bid-details-box">
                        <div class="car-img">
                            <img src="images/car.jpg" align="car">
                            <span class="cat-tags"><img src="images/dymand.png"> Featured</span>
                            <a href="javascript:void(0)" class="like"><i class="las la-heart"></i></a>
                        </div>
                        <div class="car-name">
                            <div class="names">
                                <h3>2019 Infiniti QX80</h3>
                                <p>Luxe Sensory 7ST</p>
                                <div class="feedback">
                                    <i class="las la-comments"></i>
                                    <a href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#feedback">Feedbacks</a>
                                </div>
                            </div>
                        </div>
                        <div class="car-time-specification">
                            <div class="time-temain time-close">
                                <span><i class="las la-clock"></i></span>
                                <div id="getting-started4"></div>
                            </div>
                            <div class="car-specifation">
                                <div class="car-dt">
                                    <div class="icon">
                                        <img src="images/road.png" align="road">
                                    </div>
                                    <div class="detsl">
                                        20,500 km
                                    </div>
                                </div>
                                <div class="car-dt">
                                    <div class="icon">
                                        <img src="images/km.png" align="km">
                                    </div>
                                    <div class="detsl">
                                        16.5 kmpl
                                    </div>
                                </div>
                                <div class="car-dt">
                                    <div class="icon">
                                        <img src="images/petrol.png" align="petrol">
                                    </div>
                                    <div class="detsl">
                                        Petrol
                                    </div>
                                </div>
                                <div class="car-dt">
                                    <div class="icon">
                                        <img src="images/auto.png" align="auto">
                                    </div>
                                    <div class="detsl">
                                        Auto
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="car-price my-bids-price time-close">
                            <div class="initial-price-box">
                                <p>Initial Price</p>
                                <h3>SAR 50,000</h3>
                            </div>
                            <div class="my-bid-box">
                                <p>My Bid</p>
                                <h3>SAR 55,000</h3>
                            </div>
                            <div class="current-highest-bid-box">
                                <p>Winning Bid</p>
                                <h3>SAR 78,000</h3>
                            </div>
                            <a href="javascript:void(0)" class="place-bid-blue update-bid">Auction Closed</a>
                        </div>
                    </div>
                    <div class="details-box bid-details-box">
                        <div class="car-img">
                            <img src="images/car.jpg" align="car">
                            <span class="cat-tags"><img src="images/dymand.png"> Featured</span>
                            <a href="javascript:void(0)" class="like"><i class="las la-heart"></i></a>
                        </div>
                        <div class="car-name">
                            <div class="names">
                                <h3>2019 Infiniti QX80</h3>
                                <p>Luxe Sensory 7ST</p>
                                <div class="feedback">
                                    <i class="las la-comments"></i>
                                    <a href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#feedback">Feedbacks</a>
                                </div>
                            </div>
                        </div>
                        <div class="car-time-specification">
                            <div class="time-temain time-close">
                                <span><i class="las la-clock"></i></span>
                                <div id="getting-started5"></div>
                            </div>
                            <div class="car-specifation">
                                <div class="car-dt">
                                    <div class="icon">
                                        <img src="images/road.png" align="road">
                                    </div>
                                    <div class="detsl">
                                        20,500 km
                                    </div>
                                </div>
                                <div class="car-dt">
                                    <div class="icon">
                                        <img src="images/km.png" align="km">
                                    </div>
                                    <div class="detsl">
                                        16.5 kmpl
                                    </div>
                                </div>
                                <div class="car-dt">
                                    <div class="icon">
                                        <img src="images/petrol.png" align="petrol">
                                    </div>
                                    <div class="detsl">
                                        Petrol
                                    </div>
                                </div>
                                <div class="car-dt">
                                    <div class="icon">
                                        <img src="images/auto.png" align="auto">
                                    </div>
                                    <div class="detsl">
                                        Auto
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="car-price my-bids-price time-close">
                            <div class="initial-price-box">
                                <p>Initial Price</p>
                                <h3>SAR 50,000</h3>
                            </div>
                            <div class="my-bid-box">
                                <p>My Bid</p>
                                <h3>SAR 55,000</h3>
                            </div>
                            <div class="current-highest-bid-box">
                                <p>Winning Bid</p>
                                <h3>SAR 78,000</h3>
                            </div>
                            <a href="javascript:void(0)" class="place-bid-blue update-bid">Auction Closed</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <div class="clearfix"></div>
@endsection
