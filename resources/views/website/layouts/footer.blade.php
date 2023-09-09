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
            @endphp
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
                        <span>Inquiry: <a href="mailto:{{$email}}">{{$email}}</a></span>
                    </div>
                    <div class="link">
                        <span>Support: <a href="mailto:{{$email}}">{{$email}}</a></span>
                    </div>
                    <div class="link">
                        <span>Phone: <a href="tel:{{$contact_no}}">{{$contact_no}}</a></span>
                    </div>
                </div>
                <hr>
                <div class="copyright">
                    <div class="copy">
                        <p>Copyright © {{date('Y')}} Zodha. All rights reserved.</p>
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
