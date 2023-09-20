@extends('website.layouts.master')
@section('content')
    <section id="vehicles" class="featured-vehicles">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <form id="updateProfileForm">
                        <div class="profile-box">
                            <div class="head">
                                <h3>Profile</h3>
                                <button type="submit" class="place-bid-blue">Update</button>
                            </div>
                            <div class="profile-pic">
                                <img src="{{asset('web/assets/images/profile.jpg')}}" alt="profile">
                                <a href="javascript:void(0)" class="edit-profile">
                                    <i class="las la-pen"></i>
                                </a>
                                <a href="javascript:void(0)" class="delete-profile">
                                    <i class="las la-ban"></i>
                                </a>
                            </div>
                            <div class="profile-field">
                                <div class="u-pro">
                                    <label>User Profile :</label>
                                    <input type="text" class="form-control" name="ptype" readonly
                                           value="{{$user->user_type}}">
                                </div>
                                <div class="name">
                                    <input type="text" class="form-control" name="fname" placeholder="First Name *"
                                           value="{{$user->name}}">
                                    <input type="text" class="form-control" name="lname" placeholder="Last Name *"
                                           value="{{$user->last_name}}">
                                </div>
                                <div class="emails">
                                    <input type="email" class="form-control" name="email" value="{{$user->email}}"
                                           readonly>
                                </div>
                            </div>

                        </div>
                    </form>
                </div>
                <div class="col-md-6">
                    <div class="notification-setting">
                        <div class="head">
                            <h3>Notification Settings</h3>
                            <a href="#" class="place-bid-blue">Update</a>
                        </div>
                        <div class="noti-list">
                            <div class="list-box">
                                <p>There are many variations of passages of Lorem Ipsum available</p>
                                <div class="form-check form-switch chked">
                                    <label class="form-check-label" for="onoff1">On</label>
                                    <input class="form-check-input" type="checkbox" role="switch" id="onoff1" checked>
                                    <label class="form-check-label" for="onoff1">Off</label>
                                </div>
                            </div>
                            <div class="list-box">
                                <p>There are many variations of passages of Lorem Ipsum available</p>
                                <div class="form-check form-switch">
                                    <label class="form-check-label" for="onoff2">On</label>
                                    <input class="form-check-input" type="checkbox" role="switch" id="onoff2">
                                    <label class="form-check-label" for="onoff2">Off</label>
                                </div>
                            </div>
                            <div class="list-box">
                                <p>There are many variations of passages of Lorem Ipsum available</p>
                                <div class="form-check form-switch chked">
                                    <label class="form-check-label" for="onoff3">On</label>
                                    <input class="form-check-input" type="checkbox" role="switch" id="onoff3" checked>
                                    <label class="form-check-label" for="onoff3">Off</label>
                                </div>
                            </div>
                            <div class="list-box">
                                <p>There are many variations of passages of Lorem Ipsum available</p>
                                <div class="form-check form-switch chked">
                                    <label class="form-check-label" for="onoff4">On</label>
                                    <input class="form-check-input" type="checkbox" role="switch" id="onoff4" checked>
                                    <label class="form-check-label" for="onoff4">Off</label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="clearfix"></div>
            <div class="row">
                <div class="col-md-12">
                    <div class="heading">
                        <h1>My Bids</h1>
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
                            <a href="javascript:void(0)" class="place-bid-blue update-bid" data-bs-toggle="modal"
                               data-bs-target="#carderails">Update Bid</a>
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
                            <a href="javascript:void(0)" class="place-bid-blue update-bid" data-bs-toggle="modal"
                               data-bs-target="#carderails">Update Bid</a>
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
                            <a href="javascript:void(0)" class="place-bid-blue update-bid" data-bs-toggle="modal"
                               data-bs-target="#carderails">Update Bid</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row winning-profile">
                <div class="col-md-12">
                    <div class="heading">
                        <h1>My Winnings</h1>
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
                            <div class="cong-text">
                                <h3>Congratulations!</h3>
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
                                <p>Your winning bid</p>
                                <h3>SAR 78,000</h3>
                            </div>
                            <a href="javascript:void(0)" class="place-bid-blue update-bid">Connect with us</a>
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
                            <div class="cong-text">
                                <h3>Congratulations!</h3>
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
                                <p>Your winning bid</p>
                                <h3>SAR 78,000</h3>
                            </div>
                            <a href="javascript:void(0)" class="place-bid-blue update-bid">Connect with us</a>
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
                            <div class="cong-text">
                                <h3>Congratulations!</h3>
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
                                <p>Your winning bid</p>
                                <h3>SAR 78,000</h3>
                            </div>
                            <a href="javascript:void(0)" class="place-bid-blue update-bid">Connect with us</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <div class="clearfix"></div>
@endsection
@section('custom-script')
    <script src="{{asset('web/assets/profile/profile.js')}}"></script>
@endsection
