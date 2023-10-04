@extends('website.layouts.master')
@section('content')
    <section id="contact_us">
        <div class="container">
            <div class="row" id="contatti">
                <div class="container mt-5">

                    <div class="row" style="height:550px;">
                        <input type="hidden" id="address" value="{{$address_1}}">
                        <div class="col-md-6 maps" id="map-container">
{{--                            <iframe--}}
{{--                                src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d11880.492291371422!2d12.4922309!3d41.8902102!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x28f1c82e908503c4!2sColosseo!5e0!3m2!1sit!2sit!4v1524815927977"--}}
{{--                                frameborder="0" style="border:0" allowfullscreen></iframe>--}}
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
                            <div class="text-white">

                                <i class="fas fa-phone mt-3"></i> <a href="tel:">{{$mobile_no}}</a><br>
                                <i class="fas fa-phone mt-3"></i> <a href="tel:+">{{$whatsapp_mobile_no}}</a><br>
                                <i class="fa fa-envelope mt-3"></i> <a href="">{{$email}}</a><br>
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
    <script src="https://maps.googleapis.com/maps/api/js"></script>
    <script src="{{asset('web/assets/custom/contact-us/contact_us.js')}}?v={{time()}}"></script>
@endsection
