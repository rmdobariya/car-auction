<footer>
    <div class="container">
        <div class="row">
            <div class="col-md-2">
                <div class="f-logo">
                    <img src="{{asset('web/assets/images/logo.svg')}}" alt="logo">
                </div>
            </div>
            @php
                $email = DB::table('site_settings')->where('setting_key','FROM_EMAIL')->first()->setting_value;
               $contact_no = DB::table('site_settings')->where('setting_key','WHATSAPP_NUMBER')->first()->setting_value;
               $app_store_link = DB::table('site_settings')->where('setting_key','APP_STORE_LINK')->first()->setting_value;
               $play_store_link = DB::table('site_settings')->where('setting_key','PLAY_STORE_LINK')->first()->setting_value;
               $snap_link = DB::table('site_settings')->where('setting_key','SNAP_LINK')->first()->setting_value;
               $twitter_link = DB::table('site_settings')->where('setting_key','TWITTER_LINK')->first()->setting_value;
               $fb_link = DB::table('site_settings')->where('setting_key','FACEBOOK_LINK')->first()->setting_value;
               $instagram_link = DB::table('site_settings')->where('setting_key','INSTAGRAM_LINK')->first()->setting_value;
               $tiktok_link = DB::table('site_settings')->where('setting_key','TIKTOK_LINK')->first()->setting_value;
            @endphp
            <div class="col-md-10">
                <div class="f-link">
                    <div class="link">
                        <p>{{trans('web_string.download_now')}}</p>
                        <a href="{{$play_store_link}}" target="_blank"
                            {{--                       data-bs-toggle="modal" data-bs-target="#commingsoon"--}}
                        >
                            <img src="{{asset('web/assets/images/google-play.png')}}" alt="google-play"></a>
                    </div>
                    <div class="link">
                        <a href="{{$app_store_link}}" target="_blank"
                            {{--                       data-bs-toggle="modal" data-bs-target="#commingsoon"--}}
                        >
                            <img src="{{asset('web/assets/images/app-store.png')}}" alt="app-store"></a>
                    </div>
                    <div class="link">
                        <span>{{trans('web_string.inquiry')}}<br> <a href="mailto:{{$email}}">{{$email}}</a></span>
                    </div>
                    <div class="link">
                        <span>{{trans('web_string.support')}}<br> <a href="mailto:{{$email}}">{{$email}}</a></span>
                    </div>
                    <div class="link">
                        <span>{{trans('web_string.phone')}}<br> <a href="tel:{{$contact_no}}">{{$contact_no}}</a></span>
                    </div>
                </div>
                <hr>
                <div class="copyright">
                    <div class="pagelink">
                        <a target="_blank" href="{{$snap_link}}" style="font-size: 30px"><i class="fa-brands fa-snapchat"></i></a>
                        <a target="_blank" href="{{$twitter_link}}" style="font-size: 30px"><i class="fa-brands fa-x-twitter"></i></a>
                        <a target="_blank" href="{{$fb_link}}" style="font-size: 30px"><i class="fa-brands fa-facebook"></i></a>
                        <a target="_blank" href="{{$instagram_link}}" style="font-size: 30px"><i class="fa-brands fa-instagram"></i></a>
                        <a target="_blank" href="{{$tiktok_link}}" style="font-size: 30px"><i class="fa-brands fa-tiktok"></i></a>
                    </div>
                </div>
                <hr>
                <div class="copyright">
                    <div class="copy">
                        <p> © {{trans('web_string.copyright')}} {{date('Y')}} Zodha.  <a href="https://promarcreative.com" target="_blank" class="textWhite text-hover-primary">Crafted by ProMar Creative</a>.</p>
                    </div>
                    <div class="pagelink">
                        <a href="{{route('page',['terms-conditions'])}}">{{trans('web_string.terms_and_conditions')}}</a>
                        <a href="{{route('page',['privacy-policy'])}}">{{trans('web_string.privacy_policy')}}</a>
                        <a href="{{route('page',['cookie-policy'])}}">{{trans('web_string.cookies_policy')}}</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</footer>
