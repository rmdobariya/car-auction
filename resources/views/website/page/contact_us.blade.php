@extends('website.layouts.master')
@section('content')
    <section id="contact_us">
        <div class="container">
            <div class="row" id="contatti">
                <div class="container mt-5">

                    <div class="row" style="height:550px;">
                        <input type="hidden" id="address" value="{{$address_1}}">
                        <div class="col-md-6 maps" id="map-container">
                            <div id="map-container">
                                {!! isset($address_google_map) ? $address_google_map : '' !!}
                            </div>
                        </div>
                        <div class="col-md-6">
                            <h2 class="text-uppercase mt-3 font-weight-bold text-dark">CONTACT US</h2>
                            <form id="contactUsForm">
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <input type="text" class="form-control mt-2" name="first_name" placeholder="First Name">
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <input type="text" class="form-control mt-2" name="last_name" placeholder="Last Name">
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <input type="email" class="form-control mt-2"  name="email" placeholder="Email" >
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <input type="text" class="form-control mt-2 integer"   name="mobile_no"  placeholder="Mobile No">
                                        </div>
                                    </div>
                                    <div class="col-12 mt-2">
                                        <div class="form-group">
                                            <textarea class="form-control" id="message" name="message" placeholder="Message" rows="3"></textarea>
                                        </div>
                                    </div>

                                    <div class="col-12 mt-2">
                                        <button class="place-bid-blue" type="submit">Submit</button>
                                    </div>
                                </div>
                            </form>
                            <div class="text-dark">

                                <i class="fas fa-phone mt-3"></i> <a class="text-dark" href="tel:+{{$mobile_no}}">{{$mobile_no}}</a><br>
                                <i class="fas fa-phone mt-3"></i> <a class="text-dark" href="tel:+{{$mobile_no}}">{{$whatsapp_mobile_no}}</a><br>
                                <i class="fa fa-envelope mt-3"></i> <a class="text-dark" href="mailto:{{$email}}">{{$email}}</a><br>
                                <i class="fas fa-globe mt-3"></i> {{$address_1}}<br>
                                <i class="fas fa-globe mt-3"></i> {{$address_2}}<br>

                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
@section('custom-script')
    <script src="{{asset('web/assets/custom/contact-us/contact_us.js')}}?v={{time()}}"></script>
@endsection
