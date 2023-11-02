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
                    <a class="nav-link"
                       href="tel:{{$contact_no}}"><span>{{trans('web_string.toll_free')}}:</span> {{$contact_no}}</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="mailto:{{$email}}"><span>{{trans('web_string.email')}}:</span> {{$email}}
                    </a>
                </li>
            </ul>
            <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link" href="{{route('/')}}">{{trans('web_string.home')}}</a>
                </li>
                @if(!is_null(Auth::user()))
                    <li class="nav-item">
                        <a class="nav-link" href="{{route('auction')}}">{{trans('web_string.auctions')}}</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{route('wishlist')}}">{{trans('web_string.wishlist')}}</a>
                    </li>
                @endif
                <li class="nav-item">
                    <a class="nav-link"
                       href="{{route('page',['how-it-work'])}}#contact_us">{{trans('web_string.how_it_works')}}?</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link"
                       href="{{route('page',['about-us'])}}#contact_us">{{trans('web_string.about_us')}}</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{route('contact-us')}}#contact_us">{{trans('web_string.contact_us')}}</a>
                </li>
                @if(!is_null(Auth::user()))
                    @php
                        $count = DB::table('notifications')->where('user_id', Auth::user()->id)->where('is_read',0)->count();
                    @endphp
                    <li class="nav-item">
                        <a class="nav-link" href="{{route('notification')}}">{{trans('web_string.notifications')}}
                            <span class="badge" style="background-color: white">{{$count}}</span>
                        </a>

                    </li>
                @endif

                <li class="nav-item">
                    <a class="nav-link" href="#" data-bs-toggle="modal" data-bs-target="#ask-question"
                       title="Ask A Question">
                        <i class="fas fa-question-circle"></i>
                    </a>
                </li>
                <li class="nav-item language">
                    <div
                        class="form-check form-switch language-change @if((string)App::getLocale() === 'en') chked @endif">
                        <label class="form-check-label" for="flexSwitchCheckDefault">AR</label>
                        @if((string)App::getLocale() === 'en')
                            <input class="form-check-input" type="checkbox" role="switch" id="flexSwitchCheckDefault"
                                   value="ar" checked>
                        @else
                            <input class="form-check-input" type="checkbox" role="switch" id="flexSwitchCheckDefault"
                                   value="en" checked>
                        @endif
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
                    <h1>{{trans('web_string.online_auto_auction')}}</h1>
                    <p>{{trans('web_string.featuring_thousands_of')}}</p>
                </div>
            </div>
            <div class="col-md-6 col-lg-4">
                <div class="steps-box">
                    <h4>{{trans('web_string.register')}}</h4>
                    <p>{{trans('web_string.sign_up_for_a')}}</p>
                    <span>1</span>
                </div>
            </div>
            <div class="clearfix"></div>
            <div class="col-md-6 col-lg-4">
                <div class="steps-box">
                    <h4>{{trans('web_string.find')}}</h4>
                    <p>{{trans('web_string.search_out_range')}}</p>
                    <span>2</span>
                </div>
            </div>
            <div class="clearfix"></div>
            <div class="col-md-6 col-lg-4">
                <div class="steps-box">
                    <h4>{{trans('web_string.bid')}}</h4>
                    <p>{{trans('web_string.bid_in_our_online')}}</p>
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
                    <p>{{trans('web_string.download_now')}}</p>
                </div>
            </div>
            <div class="clearfix"></div>
            <div class="col-md-12 filter-fix">
                <div class="filter">
                    <div class="logo-icon">
                        <img src="{{asset('web/assets/images/icon.png')}}">
                    </div>
                    <div class="search-box">
                        <div class="input-group">
                            <input type="text" class="form-control"
                                   placeholder="{{trans('web_string.search_by_make')}}">
                            <span class="input-group-text" id="basic-addon2"><i class="las la-search"></i></span>
                        </div>
                    </div>
                    <div class="filter-btn">
                        <button class="btn btn-filter">{{trans('web_string.filters')}}
                            <i class="las la-angle-up"></i>
                        </button>

                    </div>
                    @if(is_null(Auth::user()))
                        <div class="login-btn">
                            <button class="btn btn-login" data-bs-toggle="modal"
                                    data-bs-target="#login">{{trans('web_string.login')}}
                            </button>
                        </div>
                        <div class="reg-btn">
                            <button class="btn btn-register" data-bs-toggle="modal" data-bs-target="#signup">
                                {{trans('web_string.registration')}}
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
                               style="background: #673AAA 0% 0% no-repeat padding-box">{{trans('web_string.logout')}}
                            </a>
                        </div>
                    @endif
                    <!-- <div class="login-btn">
                        <button class="btn btn-login" data-bs-toggle="modal" data-bs-target="#login">Login</button>
                    </div>
                    <div class="reg-btn">
                        <button class="btn btn-register" data-bs-toggle="modal" data-bs-target="#signup">Registration</button>
                    </div> -->
                    @if(request()->segment(1) == 'seller')
                        @php
                            $id = decrypt(request()->segment(2));
                                $user = DB::table('users')->where('id',$id)->first();
                        @endphp
                        @if($user->is_corporate_seller == 1)
                            <form id="sellerFilterForm">
                                <div class="filter-pop">
                                    <div class="f-head">
                                        <p>Filters</p>
                                        <input type="hidden" name="user_id" id="user_id" value="{{$user->id}}">
                                        <input type="hidden" name="encrypt_user_id" id="encrypt_user_id" value="{{encrypt($id)}}">
                                        <a href="{{route('seller',encrypt($id))}}">{{trans('web_string.reset_all')}}</a>
                                        <button type="button"
                                                id="seller_filterData">{{trans('web_string.submit')}}</button>
                                        <a href="javascript:void(0)" class="close-filter"><i
                                                class="las la-times"></i></a>
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
                                                <label>{{trans('web_string.category')}}</label>
                                                <div class="category">
                                                    <select class="form-select" name="category" id="category"
                                                            aria-label="Default select example">
                                                        <option
                                                            value="">{{trans('web_string.select_category')}}</option>
                                                        @foreach($v_categories as $v_category)
                                                            <option value="{{$v_category->id}}"
                                                                    @if(request()->get('category') == $v_category->id) selected @endif>{{$v_category->name}}</option>
                                                        @endforeach
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
                                                <label>{{trans('web_string.model')}}</label>
                                                <div class="model">
                                                    <input type="text" class="form-control" name="model" id="model"
                                                           value="{{request()->get('model')}}">
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <label>{{trans('web_string.make')}}</label>
                                                <div class="make">
                                                    <input type="text" class="form-control" name="make" id="make"
                                                           value="{{request()->get('make')}}">
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <label>{{trans('web_string.body_type')}}</label>
                                                <div class="category">
                                                    <input type="text" class="form-control" name="body_type"
                                                           id="body_type"
                                                           value="{{request()->get('body_type')}}">
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="price-range-slider">
                                                    <p class="range-value">
                                                        {{trans('web_string.price_range')}}
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
                                                <label>{{trans('web_string.exterior_type')}}</label>
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
                                                <label>{{trans('web_string.exterior_type')}}</label>
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
                                                        {{trans('web_string.seller_ratings')}}
                                                        <input type="text" id="ratings" name="ratting" readonly>
                                                        <input type="hidden" id="min_ratting" name="min_ratting"
                                                               readonly>
                                                        <input type="hidden" id="max_ratting" name="max_ratting"
                                                               readonly>
                                                    </p>
                                                    <div id="ratings-range" class="range-bar"></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        @else
                            <form id="filterForm">
                                <div class="filter-pop">
                                    <div class="f-head">
                                        <p>Filters</p>
                                        <a href="{{route('/')}}">{{trans('web_string.reset_all')}}</a>
                                        <button type="button" id="filterData">{{trans('web_string.submit')}}</button>
                                        <a href="javascript:void(0)" class="close-filter"><i
                                                class="las la-times"></i></a>
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
                                                <label>{{trans('web_string.category')}}</label>
                                                <div class="category">
                                                    <select class="form-select" name="category" id="category"
                                                            aria-label="Default select example">
                                                        <option
                                                            value="">{{trans('web_string.select_category')}}</option>
                                                        @foreach($v_categories as $v_category)
                                                            <option value="{{$v_category->id}}"
                                                                    @if(request()->get('category') == $v_category->id) selected @endif>{{$v_category->name}}</option>
                                                        @endforeach
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
                                                <label>{{trans('web_string.model')}}</label>
                                                <div class="model">
                                                    <input type="text" class="form-control" name="model" id="model"
                                                           value="{{request()->get('model')}}">
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <label>{{trans('web_string.make')}}</label>
                                                <div class="make">
                                                    <input type="text" class="form-control" name="make" id="make"
                                                           value="{{request()->get('make')}}">
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <label>{{trans('web_string.body_type')}}</label>
                                                <div class="category">
                                                    <input type="text" class="form-control" name="body_type"
                                                           id="body_type"
                                                           value="{{request()->get('body_type')}}">
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="price-range-slider">
                                                    <p class="range-value">
                                                        {{trans('web_string.price_range')}}
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
                                                <label>{{trans('web_string.exterior_type')}}</label>
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
                                                <label>{{trans('web_string.exterior_type')}}</label>
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
                                                        {{trans('web_string.seller_ratings')}}
                                                        <input type="text" id="ratings" name="ratting" readonly>
                                                        <input type="hidden" id="min_ratting" name="min_ratting"
                                                               readonly>
                                                        <input type="hidden" id="max_ratting" name="max_ratting"
                                                               readonly>
                                                    </p>
                                                    <div id="ratings-range" class="range-bar"></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        @endif
                    @else
                        <form id="filterForm">
                            <div class="filter-pop">
                                <div class="f-head">
                                    <p>Filters</p>
                                    <a href="{{route('/')}}">{{trans('web_string.reset_all')}}</a>
                                    <button type="button" id="filterData">{{trans('web_string.submit')}}</button>
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
                                            <label>{{trans('web_string.category')}}</label>
                                            <div class="category">
                                                <select class="form-select" name="category" id="category"
                                                        aria-label="Default select example">
                                                    <option value="">{{trans('web_string.select_category')}}</option>
                                                    @foreach($v_categories as $v_category)
                                                        <option value="{{$v_category->id}}"
                                                                @if(request()->get('category') == $v_category->id) selected @endif>{{$v_category->name}}</option>
                                                    @endforeach
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
                                            <label>{{trans('web_string.model')}}</label>
                                            <div class="model">
                                                <input type="text" class="form-control" name="model" id="model"
                                                       value="{{request()->get('model')}}">
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <label>{{trans('web_string.make')}}</label>
                                            <div class="make">
                                                <input type="text" class="form-control" name="make" id="make"
                                                       value="{{request()->get('make')}}">
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <label>{{trans('web_string.body_type')}}</label>
                                            <div class="category">
                                                <input type="text" class="form-control" name="body_type" id="body_type"
                                                       value="{{request()->get('body_type')}}">
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="price-range-slider">
                                                <p class="range-value">
                                                    {{trans('web_string.price_range')}}
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
                                            <label>{{trans('web_string.exterior_type')}}</label>
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
                                            <label>{{trans('web_string.exterior_type')}}</label>
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
                                                    {{trans('web_string.seller_ratings')}}
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
                    @endif

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
