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
                                <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d235013.74842717682!2d72.41492748914428!3d23.020474102588523!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x395e848aba5bd449%3A0x4fcedd11614f6516!2sAhmedabad%2C%20Gujarat!5e0!3m2!1sen!2sin!4v1696587977542!5m2!1sen!2sin" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
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
