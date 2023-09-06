<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Zodha</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@100;300;400;500;700;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://maxst.icons8.com/vue-static/landings/line-awesome/line-awesome/1.3.0/css/line-awesome.min.css">
    <link rel='stylesheet' href='https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css'>
    <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick-theme.css'>
    <link rel='stylesheet' href='https://unpkg.com/swiper@6.5.4/swiper-bundle.min.css'>
    <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.css'>
    <link rel="stylesheet" type="text/css" href="{{asset('web/assets/css/bootstrap.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('web/assets/css/style.css')}}">
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-light fixed-top main-nav">
    <div class="container">
        <!-- <a class="navbar-brand" href="#">Navbar</a> -->
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link" href="#"><span>Toll Free:</span> +97 78 456 78780</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#"><span>Email:</span> info@zodha.ae</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Contact Us</a>
                </li>
            </ul>
            <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link" href="#">Auctions</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">How it works?</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">About us</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Contact us</a>
                </li>

            </ul>
        </div>
    </div>
</nav>
<section id="hero">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="heading">
                    <h1>100% Online Auto Auctions</h1>
                    <p>Featuring thousands of Used and Salvage Cars, Trucks & SUVs for Sale</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="steps-box">
                    <h4>Register</h4>
                    <p>Sign up for a Copart Middle East Standard or Premier Membership</p>
                    <span>1</span>
                </div>
            </div>
            <div class="clearfix"></div>
            <div class="col-md-4">
                <div class="steps-box">
                    <h4>Find</h4>
                    <p>Search our large inventory of used & damaged vehicles</p>
                    <span>2</span>
                </div>
            </div>
            <div class="clearfix"></div>
            <div class="col-md-4">
                <div class="steps-box">
                    <h4>Bid</h4>
                    <p>Bid in our online auctions across the Middle East</p>
                    <span>3</span>
                </div>
            </div>
            <div class="col-md-2 offset-6">
                <div class="download-app text-center">
                    <a href="#"><img src="{{asset('web/assets/images/app-store.png')}}"></a>
                    <a href="#"><img src="{{asset('web/assets/images/google-play.png')}}"></a>
                    <p>Download Now</p>
                </div>
            </div>
            <div class="clearfix"></div>
            <div class="col-md-12">
                <div class="filter">
                    <div class="logo-icon">
                        <img src="{{asset('web/assets/images/icon.png')}}">
                    </div>
                    <div class="search-box">
                        <div class="input-group">
                            <input type="text" class="form-control" placeholder="Search by Make, Model or VIN">
                            <span class="input-group-text" id="basic-addon2"><i class="las la-search"></i></span>
                        </div>
                    </div>
                    <div class="filter-btn">
                        <button class="btn btn-filter">Filters
                            <i class="las la-angle-up"></i>
                        </button>

                    </div>
                    <div class="login-btn">
                        <button class="btn btn-login">Login</button>
                    </div>
                    <div class="reg-btn">
                        <button class="btn btn-register">Registration</button>
                    </div>
                    <div class="filter-pop">
                        <div class="f-head">
                            <p>Filters</p>
                            <a href="#">Reset All</a>
                        </div>
                        <div class="f-body">
                            <div class="row">
                                <div class="col-md-3">
                                    <label>Vehicle Condition</label>
                                    <div class="checkbox-group">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" value="" id="used">
                                            <label class="form-check-label" for="used">
                                                Used
                                            </label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" value="" id="new">
                                            <label class="form-check-label" for="new">
                                                New
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <label>Category</label>
                                    <div class="category">
                                        <select class="form-select" aria-label="Default select example">
                                            <option selected>Select Category</option>
                                            <option value="1">Category 1</option>
                                            <option value="2">Category 2</option>
                                            <option value="3">Category 3</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="price-range-slider">
                                        <p class="range-value">
                                            Price Range
                                            <input type="text" id="amount" readonly>
                                        </p>
                                        <div id="slider-range" class="range-bar"></div>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="price-range-slider">
                                        <p class="range-value">
                                            Price Range
                                            <input type="text" id="year" readonly>
                                        </p>
                                        <div id="year-range" class="range-bar"></div>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <label>Select Model</label>
                                    <div class="category">
                                        <select class="form-select" aria-label="Default select example">
                                            <option selected>Make and Model</option>
                                            <option value="1">Model 1</option>
                                            <option value="2">Model 2</option>
                                            <option value="3">Model 3</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <label>Body Type</label>
                                    <div class="category">
                                        <select class="form-select" aria-label="Default select example">
                                            <option selected>Select Body Type</option>
                                            <option value="1">Body Type 1</option>
                                            <option value="2">Body Type 2</option>
                                            <option value="3">Body Type 3</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <label>Exterior Type</label>
                                    <div class="checkbox-group color-check">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" value="" id="white">
                                            <label class="form-check-label" for="white">
                                                White
                                            </label>
                                        </div>
                                        <span class="hr"></span>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" value="" id="black">
                                            <label class="form-check-label" for="black">
                                                Black
                                            </label>
                                        </div>
                                        <span class="hr"></span>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" value="" id="grey">
                                            <label class="form-check-label" for="grey">
                                                Grey
                                            </label>
                                        </div>
                                        <span class="hr"></span>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" value="" id="silver">
                                            <label class="form-check-label" for="silver">
                                                Silver
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <label>Exterior Type</label>
                                    <div class="checkbox-group color-check">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" value="" id="warranty">
                                            <label class="form-check-label" for="warranty">
                                                Warranty Available
                                            </label>
                                        </div>
                                        <span class="hr"></span>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" value="" id="history">
                                            <label class="form-check-label" for="history">
                                                History Available
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="price-range-slider">
                                        <p class="range-value">
                                            Seller Ratings
                                            <input type="text" id="ratings" readonly>
                                        </p>
                                        <div id="ratings-range" class="range-bar"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<section id="vehicles" class="featured-vehicles">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="heading">
                    <h1>Featured Vehicles</h1>
                    <a href="#">View All</a>
                </div>
            </div>
            <div class="clearfix"></div>
            <div class="col-md-12">
                <div class="details-box">
                    <div class="car-img">
                        <img src="{{asset('web/assets/images/car.jpg')}}" align="car">
                        <span class="cat-tags"><img src="{{asset('web/assets/images/dymand.png')}}"> Featured</span>
                        <a href="#" class="like"><i class="las la-heart"></i></a>
                    </div>
                    <div class="car-name">
                        <div class="names">
                            <h3>2019 Infiniti QX80</h3>
                            <p>Luxe Sensory 7ST</p>
                        </div>
                    </div>
                    <div class="car-specifation">
                        <div class="drive">
                            <div class="icon"></div>
                        </div>
                        <div class="car-dt">
                            <div class="icon">
                                <img src="{{asset('web/assets/images/road.png')}}" align="road">
                            </div>
                            <div class="detsl">
                                20,500 km
                            </div>
                        </div>
                        <div class="car-dt">
                            <div class="icon">
                                <img src="{{asset('web/assets/images/km.png')}}" align="km">
                            </div>
                            <div class="detsl">
                                16.5 kmpl
                            </div>
                        </div>
                        <div class="car-dt">
                            <div class="icon">
                                <img src="{{asset('web/assets/images/petrol.png')}}" align="petrol">
                            </div>
                            <div class="detsl">
                                Petrol
                            </div>
                        </div>
                        <div class="car-dt">
                            <div class="icon">
                                <img src="{{asset('web/assets/images/auto.png')}}" align="auto">
                            </div>
                            <div class="detsl">
                                Auto
                            </div>
                        </div>
                    </div>
                    <div class="car-price">
                        <span>Bid Start on <b>15th Sep 2023</b></span>
                        <div class="initial-price-box">
                            <p>Initial Price</p>
                            <h3>SAR 50,000</h3>
                        </div>
                        <a href="#" class="place-bid-blue" data-bs-toggle="modal" data-bs-target="#carderails">Place Bid</a>
                    </div>
                </div>
                <div class="details-box">
                    <div class="car-img">
                        <img src="{{asset('web/assets/images/car.jpg')}}" align="car">
                        <span class="cat-tags"><img src="{{asset('web/assets/images/dymand.png')}}"> Featured</span>
                        <a href="#" class="like"><i class="lar la-heart"></i></a>
                    </div>
                    <div class="car-name">
                        <div class="names">
                            <div class="names">
                                <h3>2019 Infiniti QX80</h3>
                                <p>Luxe Sensory 7ST</p>
                            </div>
                        </div>
                    </div>
                    <div class="car-specifation">
                        <div class="car-dt">
                            <div class="icon">
                                <img src="{{asset('web/assets/images/road.png')}}" align="road">
                            </div>
                            <div class="detsl">
                                20,500 km
                            </div>
                        </div>
                        <div class="car-dt">
                            <div class="icon">
                                <img src="{{asset('web/assets/images/km.png')}}" align="km">
                            </div>
                            <div class="detsl">
                                16.5 kmpl
                            </div>
                        </div>
                        <div class="car-dt">
                            <div class="icon">
                                <img src="{{asset('web/assets/images/petrol.png')}}" align="petrol">
                            </div>
                            <div class="detsl">
                                Petrol
                            </div>
                        </div>
                        <div class="car-dt">
                            <div class="icon">
                                <img src="{{asset('web/assets/images/auto.png')}}" align="auto">
                            </div>
                            <div class="detsl">
                                Auto
                            </div>
                        </div>
                    </div>
                    <div class="car-price">
                        <span>Bid Start on <b>15th Sep 2023</b></span>
                        <div class="initial-price-box">
                            <p>Initial Price</p>
                            <h3>SAR 50,000</h3>
                        </div>
                        <a href="#" class="place-bid-blue" data-bs-toggle="modal" data-bs-target="#carderails">Place Bid</a>
                    </div>
                </div>
                <div class="details-box">
                    <div class="car-img">
                        <img src="images/car.jpg" align="car">
                        <span class="cat-tags"><img src="{{asset('web/assets/images/dymand.png')}}"> Featured</span>
                        <a href="#" class="like"><i class="lar la-heart"></i></a>
                    </div>
                    <div class="car-name">
                        <div class="names">
                            <div class="names">
                                <h3>2019 Infiniti QX80</h3>
                                <p>Luxe Sensory 7ST</p>
                            </div>
                        </div>
                    </div>
                    <div class="car-specifation">
                        <div class="car-dt">
                            <div class="icon">
                                <img src="{{asset('web/assets/images/road.png')}}" align="road">
                            </div>
                            <div class="detsl">
                                20,500 km
                            </div>
                        </div>
                        <div class="car-dt">
                            <div class="icon">
                                <img src="{{asset('web/assets/images/km.png')}}" align="km">
                            </div>
                            <div class="detsl">
                                16.5 kmpl
                            </div>
                        </div>
                        <div class="car-dt">
                            <div class="icon">
                                <img src="{{asset('web/assets/images/petrol.png')}}" align="petrol">
                            </div>
                            <div class="detsl">
                                Petrol
                            </div>
                        </div>
                        <div class="car-dt">
                            <div class="icon">
                                <img src="{{asset('web/assets/images/auto.png')}}" align="auto">
                            </div>
                            <div class="detsl">
                                Auto
                            </div>
                        </div>
                    </div>
                    <div class="car-price">
                        <span>Bid Start on <b>15th Sep 2023</b></span>
                        <div class="initial-price-box">
                            <p>Initial Price</p>
                            <h3>SAR 50,000</h3>
                        </div>
                        <a href="#" class="place-bid-blue" data-bs-toggle="modal" data-bs-target="#carderails">Place Bid</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="heading">
                    <h1>Popular Vehicles</h1>
                    <a href="#">View All</a>
                </div>
            </div>
            <div class="clearfix"></div>
            <div class="col-md-12">
                <div class="details-box">
                    <div class="car-img">
                        <img src="{{asset('web/assets/images/car.jpg')}}" align="car">
                        <span class="cat-tags"><img src="{{asset('web/assets/images/dymand.png')}}"> Featured</span>
                        <a href="#" class="like"><i class="las la-heart"></i></a>
                    </div>
                    <div class="car-name">
                        <div class="names">
                            <h3>2019 Infiniti QX80</h3>
                            <p>Luxe Sensory 7ST</p>
                        </div>
                    </div>
                    <div class="car-specifation">
                        <div class="drive">
                            <div class="icon"></div>
                        </div>
                        <div class="car-dt">
                            <div class="icon">
                                <img src="{{asset('web/assets/images/road.png')}}" align="road">
                            </div>
                            <div class="detsl">
                                20,500 km
                            </div>
                        </div>
                        <div class="car-dt">
                            <div class="icon">
                                <img src="{{asset('web/assets/images/km.png')}}" align="km">
                            </div>
                            <div class="detsl">
                                16.5 kmpl
                            </div>
                        </div>
                        <div class="car-dt">
                            <div class="icon">
                                <img src="{{asset('web/assets/images/petrol.png')}}" align="petrol">
                            </div>
                            <div class="detsl">
                                Petrol
                            </div>
                        </div>
                        <div class="car-dt">
                            <div class="icon">
                                <img src="{{asset('web/assets/images/auto.png')}}" align="auto">
                            </div>
                            <div class="detsl">
                                Auto
                            </div>
                        </div>
                    </div>
                    <div class="car-price">
                        <span>Bid Start on <b>15th Sep 2023</b></span>
                        <div class="initial-price-box">
                            <p>Initial Price</p>
                            <h3>SAR 50,000</h3>
                        </div>
                        <a href="#" class="place-bid-blue" data-bs-toggle="modal" data-bs-target="#carderails">Place Bid</a>
                    </div>
                </div>
                <div class="details-box">
                    <div class="car-img">
                        <img src="images/car.jpg" align="car">
                        <span class="cat-tags"><img src="{{asset('web/assets/images/dymand.png')}}"> Featured</span>
                        <a href="#" class="like"><i class="lar la-heart"></i></a>
                    </div>
                    <div class="car-name">
                        <div class="names">
                            <div class="names">
                                <h3>2019 Infiniti QX80</h3>
                                <p>Luxe Sensory 7ST</p>
                            </div>
                        </div>
                    </div>
                    <div class="car-specifation">
                        <div class="car-dt">
                            <div class="icon">
                                <img src="{{asset('web/assets/images/road.png')}}" align="road">
                            </div>
                            <div class="detsl">
                                20,500 km
                            </div>
                        </div>
                        <div class="car-dt">
                            <div class="icon">
                                <img src="{{asset('web/assets/images/km.png')}}" align="km">
                            </div>
                            <div class="detsl">
                                16.5 kmpl
                            </div>
                        </div>
                        <div class="car-dt">
                            <div class="icon">
                                <img src="{{asset('web/assets/images/petrol.png')}}" align="petrol">
                            </div>
                            <div class="detsl">
                                Petrol
                            </div>
                        </div>
                        <div class="car-dt">
                            <div class="icon">
                                <img src="{{asset('web/assets/images/auto.png')}}" align="auto">
                            </div>
                            <div class="detsl">
                                Auto
                            </div>
                        </div>
                    </div>
                    <div class="car-price">
                        <span>Bid Start on <b>15th Sep 2023</b></span>
                        <div class="initial-price-box">
                            <p>Initial Price</p>
                            <h3>SAR 50,000</h3>
                        </div>
                        <a href="#" class="place-bid-blue" data-bs-toggle="modal" data-bs-target="#carderails">Place Bid</a>
                    </div>
                </div>
                <div class="details-box">
                    <div class="car-img">
                        <img src="images/car.jpg" align="car">
                        <span class="cat-tags"><img src="{{asset('web/assets/images/dymand.png')}}"> Featured</span>
                        <a href="#" class="like"><i class="lar la-heart"></i></a>
                    </div>
                    <div class="car-name">
                        <div class="names">
                            <div class="names">
                                <h3>2019 Infiniti QX80</h3>
                                <p>Luxe Sensory 7ST</p>
                            </div>
                        </div>
                    </div>
                    <div class="car-specifation">
                        <div class="car-dt">
                            <div class="icon">
                                <img src="{{asset('web/assets/images/road.png')}}" align="road">
                            </div>
                            <div class="detsl">
                                20,500 km
                            </div>
                        </div>
                        <div class="car-dt">
                            <div class="icon">
                                <img src="{{asset('web/assets/images/km.png')}}" align="km">
                            </div>
                            <div class="detsl">
                                16.5 kmpl
                            </div>
                        </div>
                        <div class="car-dt">
                            <div class="icon">
                                <img src="{{asset('web/assets/images/petrol.png')}}" align="petrol">
                            </div>
                            <div class="detsl">
                                Petrol
                            </div>
                        </div>
                        <div class="car-dt">
                            <div class="icon">
                                <img src="{{asset('web/assets/images/auto.png')}}" align="auto">
                            </div>
                            <div class="detsl">
                                Auto
                            </div>
                        </div>
                    </div>
                    <div class="car-price">
                        <span>Bid Start on <b>15th Sep 2023</b></span>
                        <div class="initial-price-box">
                            <p>Initial Price</p>
                            <h3>SAR 50,000</h3>
                        </div>
                        <a href="#" class="place-bid-blue" data-bs-toggle="modal" data-bs-target="#carderails">Place Bid</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="heading">
                    <h1>Hot Deals</h1>
                    <a href="#">View All</a>
                </div>
            </div>
            <div class="clearfix"></div>
            <div class="col-md-12">
                <div class="details-box">
                    <div class="car-img">
                        <img src="{{asset('web/assets/images/car.jpg')}}" align="car">
                        <span class="cat-tags"><img src="{{asset('web/assets/images/dymand.png')}}"> Featured</span>
                        <a href="#" class="like"><i class="las la-heart"></i></a>
                    </div>
                    <div class="car-name">
                        <div class="names">
                            <h3>2019 Infiniti QX80</h3>
                            <p>Luxe Sensory 7ST</p>
                        </div>
                    </div>
                    <div class="car-specifation">
                        <div class="drive">
                            <div class="icon"></div>
                        </div>
                        <div class="car-dt">
                            <div class="icon">
                                <img src="{{asset('web/assets/images/road.png')}}" align="road">
                            </div>
                            <div class="detsl">
                                20,500 km
                            </div>
                        </div>
                        <div class="car-dt">
                            <div class="icon">
                                <img src="{{asset('web/assets/images/km.png')}}" align="km">
                            </div>
                            <div class="detsl">
                                16.5 kmpl
                            </div>
                        </div>
                        <div class="car-dt">
                            <div class="icon">
                                <img src="{{asset('web/assets/images/petrol.png')}}" align="petrol">
                            </div>
                            <div class="detsl">
                                Petrol
                            </div>
                        </div>
                        <div class="car-dt">
                            <div class="icon">
                                <img src="{{asset('web/assets/images/auto.png')}}" align="auto">
                            </div>
                            <div class="detsl">
                                Auto
                            </div>
                        </div>
                    </div>
                    <div class="car-price hot-deal">
                        <div class="initial-price-box">
                            <p>Initial Price</p>
                            <h3>SAR 50,000</h3>
                        </div>
                        <a href="#" class="place-bid-blue" data-bs-toggle="modal" data-bs-target="#carderails">Place Bid</a>
                    </div>
                </div>
                <div class="details-box">
                    <div class="car-img">
                        <img src="images/car.jpg" align="car">
                        <span class="cat-tags"><img src="{{asset('web/assets/images/dymand.png')}}"> Featured</span>
                        <a href="#" class="like"><i class="lar la-heart"></i></a>
                    </div>
                    <div class="car-name">
                        <div class="names">
                            <div class="names">
                                <h3>2019 Infiniti QX80</h3>
                                <p>Luxe Sensory 7ST</p>
                            </div>
                        </div>
                    </div>
                    <div class="car-specifation">
                        <div class="car-dt">
                            <div class="icon">
                                <img src="{{asset('web/assets/images/road.png')}}" align="road">
                            </div>
                            <div class="detsl">
                                20,500 km
                            </div>
                        </div>
                        <div class="car-dt">
                            <div class="icon">
                                <img src="{{asset('web/assets/images/km.png')}}" align="km">
                            </div>
                            <div class="detsl">
                                16.5 kmpl
                            </div>
                        </div>
                        <div class="car-dt">
                            <div class="icon">
                                <img src="{{asset('web/assets/images/petrol.png')}}" align="petrol">
                            </div>
                            <div class="detsl">
                                Petrol
                            </div>
                        </div>
                        <div class="car-dt">
                            <div class="icon">
                                <img src="{{asset('web/assets/images/auto.png')}}" align="auto">
                            </div>
                            <div class="detsl">
                                Auto
                            </div>
                        </div>
                    </div>
                    <div class="car-price hot-deal">
                        <div class="initial-price-box">
                            <p>Initial Price</p>
                            <h3>SAR 50,000</h3>
                        </div>
                        <a href="#" class="place-bid-blue" data-bs-toggle="modal" data-bs-target="#carderails">Place Bid</a>
                    </div>
                </div>
                <div class="details-box">
                    <div class="car-img">
                        <img src="images/car.jpg" align="car">
                        <span class="cat-tags"><img src="{{asset('web/assets/images/dymand.png')}}"> Featured</span>
                        <a href="#" class="like"><i class="lar la-heart"></i></a>
                    </div>
                    <div class="car-name">
                        <div class="names">
                            <div class="names">
                                <h3>2019 Infiniti QX80</h3>
                                <p>Luxe Sensory 7ST</p>
                            </div>
                        </div>
                    </div>
                    <div class="car-specifation">
                        <div class="car-dt">
                            <div class="icon">
                                <img src="{{asset('web/assets/images/road.png')}}" align="road">
                            </div>
                            <div class="detsl">
                                20,500 km
                            </div>
                        </div>
                        <div class="car-dt">
                            <div class="icon">
                                <img src="{{asset('web/assets/images/km.png')}}" align="km">
                            </div>
                            <div class="detsl">
                                16.5 kmpl
                            </div>
                        </div>
                        <div class="car-dt">
                            <div class="icon">
                                <img src="{{asset('web/assets/images/petrol.png')}}" align="petrol">
                            </div>
                            <div class="detsl">
                                Petrol
                            </div>
                        </div>
                        <div class="car-dt">
                            <div class="icon">
                                <img src="{{asset('web/assets/images/auto.png')}}" align="auto">
                            </div>
                            <div class="detsl">
                                Auto
                            </div>
                        </div>
                    </div>
                    <div class="car-price hot-deal">
                        <div class="initial-price-box">
                            <p>Initial Price</p>
                            <h3>SAR 50,000</h3>
                        </div>
                        <a href="#" class="place-bid-blue" data-bs-toggle="modal" data-bs-target="#carderails">Place Bid</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<section id="howworks">
    <div class="container">
        <div class="row">
            <div class="col-md-12 text-center">
                <div class="title">
                    <h1>How it Works</h1>
                </div>
            </div>
            <div class="clearfix"></div>
            <div class="col-md-4">
                <div class="work-box">
                    <span>1</span>
                    <h2>Register</h2>
                    <p>Sign up for a Copart Middle East Standard or Premier Membership</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="work-box">
                    <span>2</span>
                    <h2>Find</h2>
                    <p>Search our large inventory of used & damaged vehicles</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="work-box">
                    <span>3</span>
                    <h2>Bid</h2>
                    <p>Bid in our online auctionsacross the Middle East</p>
                </div>
            </div>
        </div>
    </div>
</section>
<section id="testimonial">
    <div class="container">
        <div class="row">
            <div class="col-md-12 text-center">
                <div class="title">
                    <h1>Testimonial</h1>
                </div>
            </div>
            <div class="col-md-12">
                <div class="testimonial">
                    <div class="container">
                        <div class="testimonial__inner">
                            <div class="testimonial-slider">
                                <div class="testimonial-slide">
                                    <div class="testimonial_box">
                                        <div class="testimonial_box-inner">
                                            <div class="testimonial_box-top">
                                                <div class="testimonial_box-icon">
                                                    <img src="{{asset('web/assets/images/quotes.svg')}}">
                                                </div>
                                                <div class="testimonial_box-text">
                                                    <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s.</p>
                                                </div>
                                                <div class="testimonial_box-name">
                                                    <h4>Durriyah Abida</h4>
                                                </div>
                                                <div class="testimonial_box-job">
                                                    <p>Oman</p>
                                                </div>
                                                <div class="testimonial_box-img">
                                                    <img src="https://i.ibb.co/hKgs8gm/profile.jpg" alt="profile">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="testimonial-slide">
                                    <div class="testimonial_box">
                                        <div class="testimonial_box-inner">
                                            <div class="testimonial_box-top">
                                                <div class="testimonial_box-icon">
                                                    <img src="{{asset('web/assets/images/quotes.svg')}}">
                                                </div>
                                                <div class="testimonial_box-text">
                                                    <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s.</p>
                                                </div>
                                                <div class="testimonial_box-name">
                                                    <h4>Durriyah Abida</h4>
                                                </div>
                                                <div class="testimonial_box-job">
                                                    <p>Oman</p>
                                                </div>
                                                <div class="testimonial_box-img">
                                                    <img src="https://i.ibb.co/hKgs8gm/profile.jpg" alt="profile">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="testimonial-slide">
                                    <div class="testimonial_box">
                                        <div class="testimonial_box-inner">
                                            <div class="testimonial_box-top">
                                                <div class="testimonial_box-icon">
                                                    <img src="{{asset('web/assets/images/quotes.svg')}}">
                                                </div>
                                                <div class="testimonial_box-text">
                                                    <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s.</p>
                                                </div>
                                                <div class="testimonial_box-name">
                                                    <h4>Durriyah Abida</h4>
                                                </div>
                                                <div class="testimonial_box-job">
                                                    <p>Oman</p>
                                                </div>
                                                <div class="testimonial_box-img">
                                                    <img src="https://i.ibb.co/hKgs8gm/profile.jpg" alt="profile">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="testimonial-slide">
                                    <div class="testimonial_box">
                                        <div class="testimonial_box-inner">
                                            <div class="testimonial_box-top">
                                                <div class="testimonial_box-icon">
                                                    <img src="{{asset('web/assets/images/quotes.svg')}}">
                                                </div>
                                                <div class="testimonial_box-text">
                                                    <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s.</p>
                                                </div>
                                                <div class="testimonial_box-name">
                                                    <h4>Durriyah Abida</h4>
                                                </div>
                                                <div class="testimonial_box-job">
                                                    <p>Oman</p>
                                                </div>
                                                <div class="testimonial_box-img">
                                                    <img src="https://i.ibb.co/hKgs8gm/profile.jpg" alt="profile">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</section>

<section id="news">
    <div class="container">
        <div class="row">
            <div class="col-md-12 text-center">
                <div class="title ">
                    <h1 class="text-white">News</h1>
                </div>
            </div>
            <div class="col-md-12">
                <div class="testimonial">
                    <div class="container">
                        <div class="testimonial__inner">
                            <div class="testimonial-slider">
                                <div class="testimonial-slide">
                                    <div class="testimonial_box">
                                        <div class="testimonial_box-inner">
                                            <div class="testimonial_box-top">
                                                <div class="testimonial_box-text">
                                                    <div class="date">
                                                        <span>Aug 20, 2023</span>
                                                    </div>
                                                    <h1>'lorem ipsum' will uncover many web sites still in their infancy</h1>
                                                    <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s.</p>
                                                    <a href="#">Read Now</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="testimonial-slide">
                                    <div class="testimonial_box">
                                        <div class="testimonial_box-inner">
                                            <div class="testimonial_box-top">
                                                <div class="testimonial_box-text">
                                                    <div class="date">
                                                        <span>Aug 20, 2023</span>
                                                    </div>
                                                    <h1>'lorem ipsum' will uncover many web sites still in their infancy</h1>
                                                    <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s.</p>
                                                    <a href="#">Read Now</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="testimonial-slide">
                                    <div class="testimonial_box">
                                        <div class="testimonial_box-inner">
                                            <div class="testimonial_box-top">
                                                <div class="testimonial_box-text">
                                                    <div class="date">
                                                        <span>Aug 20, 2023</span>
                                                    </div>
                                                    <h1>'lorem ipsum' will uncover many web sites still in their infancy</h1>
                                                    <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s.</p>
                                                    <a href="#">Read Now</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="testimonial-slide">
                                    <div class="testimonial_box">
                                        <div class="testimonial_box-inner">
                                            <div class="testimonial_box-top">
                                                <div class="testimonial_box-text">
                                                    <div class="date">
                                                        <span>Aug 20, 2023</span>
                                                    </div>
                                                    <h1>'lorem ipsum' will uncover many web sites still in their infancy</h1>
                                                    <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s.</p>
                                                    <a href="#">Read Now</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</section>
<div class="clearfix"></div>
<footer>
    <div class="container">
        <div class="row">
            <div class="col-md-2">
                <div class="f-logo">
                    <img src="{{asset('web/assets/images/logo.svg')}}" alt="logo">
                </div>
            </div>
            <div class="col-md-10">
                <div class="f-link">
                    <div class="link">
                        <p>Download Now</p>
                        <img src="{{asset('web/assets/images/google-play.png')}}" alt="google-play">
                    </div>
                    <div class="link">
                        <img src="{{asset('web/assets/images/app-store.png')}}" alt="app-store">
                    </div>
                    <div class="link">
                        <span>Inquiry: <a href="mailto:hello@zodha.com">hello@zodha.com</a></span>
                    </div>
                    <div class="link">
                        <span>Support: <a href="mailto:support@zodha.ae">support@zodha.ae</a></span>
                    </div>
                    <div class="link">
                        <span>Phone: <a href="tel:+977845678780">+97 78 456 78780</a></span>
                    </div>
                </div>
                <hr>
                <div class="copyright">
                    <div class="copy">
                        <p>Copyright © 2023 Zodha. All rights reserved.</p>
                    </div>
                    <div class="pagelink">
                        <a href="#">Terms and conditions</a>
                        <a href="#">Privacy policy</a>
                        <a href="#">Cookies policy</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</footer>

<!-- Modal -->
<div class="modal fade bid-model" id="carderails" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="carderailsLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="carderailsLabel">Luxe Sensory 7ST</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="car-details">
                    <div class="car-images">
                        <div class="product-left mb-5">
                            <div class="swiper-container product-slider mb-3">
                                <div class="swiper-wrapper">
                                    <div class="swiper-slide">
                                        <img src="{{asset('web/assets/images/car-view.jpg')}}" alt="..."  class="img-fluid">
                                    </div>
                                    <div class="swiper-slide">
                                        <img src="{{asset('web/assets/images/car-view-1.jpg')}}" alt="..." class="img-fluid">
                                    </div>
                                    <div class="swiper-slide">
                                        <img src="{{asset('web/assets/images/car-view-2.jpg')}}" alt="..."  class="img-fluid">
                                    </div>
                                    <div class="swiper-slide">
                                        <img src="{{asset('web/assets/images/car-view-3.jpg')}}" alt="..."  class="img-fluid">
                                    </div>
                                    <div class="swiper-slide">
                                        <img src="{{asset('web/assets/images/car-view-4.jpg')}}" alt="..."  class="img-fluid">
                                    </div>
                                    <div class="swiper-slide">
                                        <img src="{{asset('web/assets/images/car-view-5.jpg')}}" alt="..."  class="img-fluid">
                                    </div>
                                </div>
                                <div class="swiper-button-next"></div>
                                <div class="swiper-button-prev"></div>
                            </div>

                            <div class="swiper-container product-thumbs">
                                <div class="swiper-wrapper">
                                    <div class="swiper-slide">
                                        <img src="{{asset('web/assets/images/car-view.jpg')}}" alt="..." class="img-fluid">
                                    </div>
                                    <div class="swiper-slide">
                                        <img src="{{asset('web/assets/images/car-view-1.jpg')}}" alt="..." class="img-fluid">
                                    </div>
                                    <div class="swiper-slide">
                                        <img src="{{asset('web/assets/images/car-view-2.jpg')}}" alt="..." class="img-fluid">
                                    </div>
                                    <div class="swiper-slide">
                                        <img src="{{asset('web/assets/images/car-view-3.jpg')}}" alt="..." class="img-fluid">
                                    </div>
                                    <div class="swiper-slide">
                                        <img src="{{asset('web/assets/images/car-view-4.jpg')}}" alt="..." class="img-fluid">
                                    </div>
                                    <div class="swiper-slide">
                                        <img src="{{asset('web/assets/images/car-view-5.jpg')}}" alt="..." class="img-fluid">
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
<script src="{{asset('web/assets/js/jquery-3.6.3.min.js')}}"></script>
<script src="{{asset('web/assets/js/bootstrap.min.js')}}"></script>
<script src='https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.0/jquery-ui.min.js'></script>
<script src='https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.js'></script>
<script src='https://unpkg.com/swiper@6.5.4/swiper-bundle.min.js'></script>
<script  src="{{asset('web/assets/js/script.js')}}"></script>
<script>
    $("input[type=checkbox]").change(function() {
        $(this).parent().toggleClass("chked");
    });
</script>
</body>
</html>

