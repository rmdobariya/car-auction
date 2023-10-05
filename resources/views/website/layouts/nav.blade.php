<nav class="navbar navbar-expand-lg navbar-light fixed-top main-nav">
    <div class="container">
        <!-- <a class="navbar-brand" href="#">Navbar</a> -->
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
                aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
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
                    <a class="nav-link" href="tel:{{$contact_no}}"><span>Toll Free:</span> {{$contact_no}}</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="mailto:{{$email}}"><span>Email:</span> {{$email}}</a>
                </li>
            </ul>
            <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link" href="{{route('/')}}">Home</a>
                </li>
                @if(!is_null(Auth::user()))
                    <li class="nav-item">
                        <a class="nav-link" href="{{route('auction')}}">Auctions</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{route('wishlist')}}">Wishlist</a>
                    </li>
                @endif
                <li class="nav-item">
                    <a class="nav-link" href="{{route('page',['how-it-work'])}}#contact_us">How it works?</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{route('page',['about-us'])}}#contact_us">About us</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{route('contact-us')}}#contact_us">Contact us</a>
                </li>
                @if(!is_null(Auth::user()))
                    @php
                        $count = DB::table('notifications')->where('user_id', Auth::user()->id)->where('is_read',0)->count();
                    @endphp
                    <li class="nav-item">
                        <a class="nav-link" href="{{route('notification')}}">Notifications
                            <span class="badge" style="background-color: white">{{$count}}</span>
                        </a>

                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#" data-bs-toggle="modal" data-bs-target="#ask-question">
                            <span class="fa-stack">
        <i class="fas fa-circle fa-stack-2x"></i>
        <i class="fas fa-question-circle fa-stack-1x fa-inverse"></i>
    </span>

                        </a>
                    </li>
                @endif
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
                                <p>Hi <span>{{Auth::user()->name}}</span></p>
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
                    <form id="filterForm">
                        <div class="filter-pop">
                            <div class="f-head">
                                <p>Filters</p>
                                <a href="{{route('/')}}">Reset All</a>
                                <button type="button" id="filterData">Submit</button>
                                <a href="javascript:void(0)" class="close-filter"><i class="las la-times"></i></a>
                            </div>
                            <div class="f-body">
                                <div class="row">
{{--                                    <div class="col-md-3">--}}
                                        {{--                                        <label>Vehicle Condition</label>--}}
                                        {{--                                        <div class="checkbox-group">--}}
                                        {{--                                            <div class="form-check">--}}
                                        {{--                                                <input class="form-check-input" type="checkbox" value="used"--}}
                                        {{--                                                       name="condition" id="used">--}}
                                        {{--                                                <label class="form-check-label" for="used">--}}
                                        {{--                                                    Used--}}
                                        {{--                                                </label>--}}
                                        {{--                                            </div>--}}
                                        {{--                                            <div class="form-check">--}}
                                        {{--                                                <input class="form-check-input" type="checkbox" value="new"--}}
                                        {{--                                                       name="condition" id="new">--}}
                                        {{--                                                <label class="form-check-label" for="new">--}}
                                        {{--                                                    New--}}
                                        {{--                                                </label>--}}
                                        {{--                                            </div>--}}
                                        {{--                                        </div>--}}
{{--                                    </div>--}}
                                    @php
                                        $v_categories = DB::table('vehicle_categories')->whereNull('deleted_at')->get();
                                        if(request()->get('min_amount')){
                                           $min = request()->get('min_amount');
                                        }else{
                                        $min = DB::table('vehicles')->whereNull('deleted_at')->min('price');
                                        }
                                         if(request()->get('max_amount')){
                                           $max = request()->get('max_amount');
                                         }else{
                                        $max = DB::table('vehicles')->whereNull('deleted_at')->max('price');
                                         }
                                        $min_ratting = DB::table('vehicles')->whereNull('deleted_at')->min('ratting');
                                        $max_ratting = DB::table('vehicles')->whereNull('deleted_at')->max('ratting');
                                    @endphp
                                    <div class="col-md-3">
                                        <label>Category</label>
                                        <div class="category">
                                            <select class="form-select" name="category" id="category"
                                                    aria-label="Default select example">
                                                <option value="">Select Category</option>
                                                @foreach($v_categories as $v_category) @endforeach
                                                <option value="{{$v_category->id}}"
                                                        @if(request()->get('category') == $v_category->id) selected @endif>{{$v_category->name}}</option>
                                            </select>
                                        </div>
                                    </div>

{{--                                    <div class="col-md-3">--}}
{{--                                        <div class="price-range-slider">--}}
                                            {{--                                            <p class="range-value">--}}
                                            {{--                                                Price Range--}}
                                            {{--                                                <input type="text" id="year" readonly>--}}
                                            {{--                                            </p>--}}
                                            {{--                                            <div id="year-range" class="range-bar"></div>--}}
{{--                                        </div>--}}
{{--                                    </div>--}}
                                    <div class="col-md-3">
                                        <label>Make & Model</label>
                                        <div class="model">
{{--                                            <select class="form-select" name="model" id="model"--}}
{{--                                                    aria-label="Default select example">--}}
{{--                                                <option value="">Make and Model</option>--}}
{{--                                                <option value="Luxe"--}}
{{--                                                        @if(request()->get('model') == 'Luxe') selected @endif>Luxe--}}
{{--                                                </option>--}}
{{--                                                <option value="Elantra"--}}
{{--                                                        @if(request()->get('model') == 'Elantra') selected @endif>--}}
{{--                                                    Elantra--}}
{{--                                                </option>--}}
{{--                                                <option value="Top"--}}
{{--                                                        @if(request()->get('model') == 'Top') selected @endif>Top--}}
{{--                                                </option>--}}
{{--                                            </select>--}}
                                            <input type="text" class="form-control" name="model" id="model" value="{{request()->get('model')}}">
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <label>Body Type</label>
                                        <div class="category">
{{--                                            <select class="form-select" name="body_type" id="body_type"--}}
{{--                                                    aria-label="Default select example">--}}
{{--                                                <option value="">Select Body Type</option>--}}
{{--                                                <option value="sedan"--}}
{{--                                                        @if(request()->get('body_type') == 'sedan') selected @endif>--}}
{{--                                                    Sedan--}}
{{--                                                </option>--}}
{{--                                                <option value="SUV"--}}
{{--                                                        @if(request()->get('body_type') == 'SUV') selected @endif>SUV--}}
{{--                                                </option>--}}
{{--                                            </select>--}}
                                            <input type="text" class="form-control" name="body_type" id="body_type" value="{{request()->get('body_type')}}">
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="price-range-slider">
                                            <p class="range-value">
                                                Price Range
                                                <input type="text" id="amount" name="price_range" readonly>
                                                <input type="hidden" id="min_amount" name="min_amount"
                                                       value="{{request()->get('min_amount')}}" readonly>
                                                <input type="hidden" id="max_amount" name="max_amount"
                                                       value="{{request()->get('max_amount')}}" readonly>
                                            </p>
                                            <div id="slider-range-price" class="range-bar"></div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <label>Exterior Type</label>
                                        <div class="checkbox-group color-check">
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" name="exterior"
                                                       value="white" id="white"
                                                       @if(in_array('white',explode(',',request()->get('exterior')))) checked @endif>
                                                <label class="form-check-label" for="white">
                                                    White
                                                </label>
                                            </div>
                                            <span class="hr"></span>
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" name="exterior"
                                                       value="black" id="black"
                                                       @if(in_array('black',explode(',',request()->get('exterior')))) checked @endif>
                                                <label class="form-check-label" for="black">
                                                    Black
                                                </label>
                                            </div>
                                            <span class="hr"></span>
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" name="exterior"
                                                       value="grey" id="grey"
                                                       @if(in_array('grey',explode(',',request()->get('exterior')))) checked @endif>
                                                <label class="form-check-label" for="grey">
                                                    Grey
                                                </label>
                                            </div>
                                            <span class="hr"></span>
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" name="exterior"
                                                       value="silver" id="silver"
                                                       @if(in_array('silver',explode(',',request()->get('exterior')))) checked @endif>
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
                                                <input class="form-check-input" type="checkbox" name="exterior"
                                                       value="warranty"
                                                       id="warranty"
                                                       @if(in_array('warranty',explode(',',request()->get('exterior')))) checked @endif>
                                                <label class="form-check-label" for="warranty">
                                                    Warranty Available
                                                </label>
                                            </div>
                                            <span class="hr"></span>
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" name="exterior"
                                                       value="warranty"
                                                       id="history"
                                                       @if(in_array('warranty',explode(',',request()->get('exterior')))) checked @endif>
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
                                                <input type="text" id="ratings" name="ratting" readonly>
                                                <input type="hidden" id="min_ratting" name="min_ratting" readonly>
                                                <input type="hidden" id="max_ratting" name="max_ratting" readonly>
                                            </p>
                                            <div id="ratings-range" class="range-bar"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
<script>
    var min = '{{$min}}';
    var max = '{{$max}}';
    var min_ratting = '{{$min_ratting}}';
    var max_ratting = '{{$max_ratting}}';
</script>
