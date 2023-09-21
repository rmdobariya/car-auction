<nav class="navbar navbar-expand-lg navbar-light fixed-top main-nav">
    <div class="container">
        <!-- <a class="navbar-brand" href="#">Navbar</a> -->
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        @php
            $email = DB::table('site_settings')->where('setting_key','FROM_EMAIL')->first()->setting_value;
           $contact_no = DB::table('site_settings')->where('setting_key','WHATSAPP_NUMBER')->first()->setting_value;
              $app_store_link = DB::table('site_settings')->where('setting_key','APP_STORE_LINK')->first()->setting_value;
               $play_store_link = DB::table('site_settings')->where('setting_key','PLAY_STORE_LINK')->first()->setting_value;
        @endphp
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link" href="#"><span>Toll Free:</span> {{$contact_no}}</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#"><span>Email:</span> {{$email}}</a>
                </li>
            </ul>
            <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link" href="{{route('/')}}">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{route('auction')}}">Auctions</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{route('page',['how-it-work'])}}">How it works?</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{route('page',['about-us'])}}">About us</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{route('contact-us')}}">Contact us</a>
                </li>
                <li class="nav-item language">
                    <div class="form-check form-switch chked">
                        <label class="form-check-label" for="flexSwitchCheckDefault">AR</label>
                        <input class="form-check-input" type="checkbox" role="switch" id="flexSwitchCheckDefault"
                               checked>
                        <label class="form-check-label" for="flexSwitchCheckDefault">EN</label>
                    </div>
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
            <div class="col-md-6 col-lg-4">
                <div class="steps-box">
                    <h4>Register</h4>
                    <p>Sign up for a Copart Middle East Standard or Premier Membership</p>
                    <span>1</span>
                </div>
            </div>
            <div class="clearfix"></div>
            <div class="col-md-6 col-lg-4">
                <div class="steps-box">
                    <h4>Find</h4>
                    <p>Search our large inventory of used & damaged vehicles</p>
                    <span>2</span>
                </div>
            </div>
            <div class="clearfix"></div>
            <div class="col-md-6 col-lg-4">
                <div class="steps-box">
                    <h4>Bid</h4>
                    <p>Bid in our online auctions across the Middle East</p>
                    <span>3</span>
                </div>
            </div>
            <div class="col-lg-2 col-md-3 offset-md-3 offset-lg-6">
                <div class="download-app text-center">
                    <a href="{{$app_store_link}}" target="_blank"
{{--                       data-bs-toggle="modal" data-bs-target="#commingsoon"--}}
                    >
                        <img src="{{asset('web/assets/images/app-store.png')}}"></a>
                    <a href="{{$play_store_link}}" target="_blank"
{{--                       data-bs-toggle="modal" data-bs-target="#commingsoon"--}}
                    >
                        <img src="{{asset('web/assets/images/google-play.png')}}"></a>
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
                    @if(is_null(Auth::user()))
                        <div class="login-btn">
                            <button class="btn btn-login" data-bs-toggle="modal" data-bs-target="#login">Login
                            </button>
                        </div>
                        <div class="reg-btn">
                            <button class="btn btn-register" data-bs-toggle="modal" data-bs-target="#signup">
                                Registration
                            </button>
                        </div>
                    @else
                        <div class="user-login-info">
                            <div class="user-name">
                                <p>Welcome <span>{{Auth::user()->full_name}}</span></p>
                            </div>
                            <div class="user-profile">
                                <a href="{{route('user-profile')}}">
                                    <img src="{{asset(Auth::user()->image)}}" alt="profile">
                                </a>
                            </div>
                        </div>

                        <div class="login-btn">
                            <a class="btn btn-login" href="{{route('/logout')}}"
                               style="background: #673AAA 0% 0% no-repeat padding-box">Logout
                            </a>
                        </div>
                    @endif
                    <!-- <div class="login-btn">
                        <button class="btn btn-login" data-bs-toggle="modal" data-bs-target="#login">Login</button>
                    </div>
                    <div class="reg-btn">
                        <button class="btn btn-register" data-bs-toggle="modal" data-bs-target="#signup">Registration</button>
                    </div> -->
                    <div class="filter-pop">
                        <div class="f-head">
                            <p>Filters</p>
                            <a href="#">Reset All</a>
                            <a href="javascript:void(0)" class="close-filter"><i class="las la-times"></i></a>
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
