@extends('website.layouts.master')
@section('content')
    <section id="contact_us">
        <div class="container">
        <div class="row" id="contatti">
            <div class="container mt-5" >

                <div class="row" style="height:550px;">
                    <div class="col-md-6 maps" >
                        <iframe src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d11880.492291371422!2d12.4922309!3d41.8902102!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x28f1c82e908503c4!2sColosseo!5e0!3m2!1sit!2sit!4v1524815927977" frameborder="0" style="border:0" allowfullscreen></iframe>
                    </div>
                    <div class="col-md-6">
                        <h2 class="text-uppercase mt-3 font-weight-bold text-white">CONTACT US</h2>
                        <form action="">
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <input type="text" class="form-control mt-2" placeholder="First Name" required>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <input type="text" class="form-control mt-2" placeholder="Last Name" required>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <input type="email" class="form-control mt-2" placeholder="Email" required>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <input type="number" class="form-control mt-2" placeholder="Mobile No" required>
                                    </div>
                                </div>
                                <div class="col-12 mt-2">
                                    <div class="form-group">
                                        <textarea class="form-control" id="message" placeholder="Message" rows="3" required></textarea>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-group">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" value="" id="invalidCheck2" required>
                                            <label class="form-check-label" for="invalidCheck2">
                                                Message
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <button class="btn btn-light" type="submit">Invia</button>
                                </div>
                            </div>
                        </form>
                        <div class="text-white">
                            <h2 class="text-uppercase mt-4 font-weight-bold">dove siamo</h2>

                            <i class="fas fa-phone mt-3"></i> <a href="tel:+">(+39) 123456</a><br>
                            <i class="fas fa-phone mt-3"></i> <a href="tel:+">(+39) 123456</a><br>
                            <i class="fa fa-envelope mt-3"></i> <a href="">info@test.it</a><br>
                            <i class="fas fa-globe mt-3"></i> Piazza del Colosseo, 1, 00184 Roma<br>
                            <i class="fas fa-globe mt-3"></i> Piazza del Colosseo, 1, 00184 Roma<br>
                            <div class="my-4">
                                <a href=""><i class="fab fa-facebook fa-3x pr-4"></i></a>
                                <a href=""><i class="fab fa-linkedin fa-3x"></i></a>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
        </div>
    </section>
@endsection
