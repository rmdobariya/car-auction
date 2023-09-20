@extends('website.layouts.master')
@section('content')
    <section id="vehicles" class="featured-vehicles">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="heading auction-detailss">
                        <h1>Auction Details</h1>
                        <div class="add-car">
                            <div class="sdate">
                                <div class="input-group date" id="datepicker2">
                                    <input type="text" class="form-control" id="date" placeholder="Auction Start Date">
                                    <span class="input-group-append">
										<span class="input-group-text bg-light d-block">
											<img src="{{asset('web/assets/images/registration-year.svg')}}">
										</span>
									</span>
                                </div>
                            </div>
                            <div class="edate">
                                <div class="input-group date" id="datepicker1">
                                    <input type="text" class="form-control" id="date" placeholder="Auction End Date">
                                    <span class="input-group-append">
										<span class="input-group-text bg-light d-block">
											<img src="{{asset('web/assets/images/registration-year.svg')}}">
										</span>
									</span>
                                </div>
                            </div>
                            <div class="action-btn">
                                <a href="{{route('add-car')}}" class="create-auction">Add Car</a>
                            </div>
                        </div>
                    </div>
                    <div class="heading">
                        <h1>Auction Cars</h1>
                        <div class="action-btn">
                            <a href="#" class="create-auction">Start Auction</a>
                        </div>
                    </div>
                </div>
                <div class="clearfix"></div>
                <div class="col-md-12">
                    <div class="auctions-list add-auction">
                        <div class="auctions-filter">
                            <div class="sdate">
                                <div class="input-group">
                                    <input type="text" class="form-control" placeholder="Search car name">
                                    <span class="input-group-text" id="basic-addon2">
										<i class="las la-search"></i>
									</span>
                                </div>
                            </div>
                            <select class="form-select">
                                <option>Search car by</option>
                                <option>New</option>
                                <option>Old</option>
                            </select>
                        </div>
                        <div class="lists">
                            <table>
                                <thead>
                                <tr>
                                    <th>Car Name</th>
                                    <th>Make</th>
                                    <th>Model</th>
                                    <th>Minimum Bid Amount</th>
                                    <th>Bid Increment</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    <td>2019 Infiniti QX80</td>
                                    <td>GMC</td>
                                    <td>SUV</td>
                                    <td>SAR 145800</td>
                                    <td>SAR 1000</td>
                                    <td>
                                        <a href="#" class="view" data-bs-toggle="modal"
                                           data-bs-target="#auctiondetails"><i class="las la-eye"></i></a>
                                        <a href="#" class="edit" data-bs-toggle="modal"
                                           data-bs-target="#auction-details"><i class="las la-pencil-alt"></i></a>
                                        <a href="#" class="delete"><i class="las la-trash-alt"></i></a>
                                        <a href="#" class="download"><i class="las la-download"></i></a>
                                    </td>
                                </tr>
                                <tr>
                                    <td>2019 Infiniti QX80</td>
                                    <td>GMC</td>
                                    <td>SUV</td>
                                    <td>SAR 145800</td>
                                    <td>SAR 1000</td>
                                    <td>
                                        <a href="#" class="view" data-bs-toggle="modal"
                                           data-bs-target="#auctiondetails"><i class="las la-eye"></i></a>
                                        <a href="#" class="edit" data-bs-toggle="modal"
                                           data-bs-target="#auction-details"><i class="las la-pencil-alt"></i></a>
                                        <a href="#" class="delete"><i class="las la-trash-alt"></i></a>
                                        <a href="#" class="download"><i class="las la-download"></i></a>
                                    </td>
                                </tr>
                                <tr>
                                    <td>2019 Infiniti QX80</td>
                                    <td>GMC</td>
                                    <td>SUV</td>
                                    <td>SAR 145800</td>
                                    <td>SAR 1000</td>
                                    <td>
                                        <a href="#" class="view" data-bs-toggle="modal"
                                           data-bs-target="#auctiondetails"><i class="las la-eye"></i></a>
                                        <a href="#" class="edit" data-bs-toggle="modal"
                                           data-bs-target="#auction-details"><i class="las la-pencil-alt"></i></a>
                                        <a href="#" class="delete"><i class="las la-trash-alt"></i></a>
                                        <a href="#" class="download"><i class="las la-download"></i></a>
                                    </td>
                                </tr>
                                <tr>
                                    <td>2019 Infiniti QX80</td>
                                    <td>GMC</td>
                                    <td>SUV</td>
                                    <td>SAR 145800</td>
                                    <td>SAR 1000</td>
                                    <td>
                                        <a href="#" class="view" data-bs-toggle="modal"
                                           data-bs-target="#auctiondetails"><i class="las la-eye"></i></a>
                                        <a href="#" class="edit" data-bs-toggle="modal"
                                           data-bs-target="#auction-details"><i class="las la-pencil-alt"></i></a>
                                        <a href="#" class="delete"><i class="las la-trash-alt"></i></a>
                                        <a href="#" class="download"><i class="las la-download"></i></a>
                                    </td>
                                </tr>
                                <tr>
                                    <td>2019 Infiniti QX80</td>
                                    <td>GMC</td>
                                    <td>SUV</td>
                                    <td>SAR 145800</td>
                                    <td>SAR 1000</td>
                                    <td>
                                        <a href="#" class="view" data-bs-toggle="modal"
                                           data-bs-target="#auctiondetails"><i class="las la-eye"></i></a>
                                        <a href="#" class="edit" data-bs-toggle="modal"
                                           data-bs-target="#auction-details"><i class="las la-pencil-alt"></i></a>
                                        <a href="#" class="delete"><i class="las la-trash-alt"></i></a>
                                        <a href="#" class="download"><i class="las la-download"></i></a>
                                    </td>
                                </tr>
                                <tr>
                                    <td>2019 Infiniti QX80</td>
                                    <td>GMC</td>
                                    <td>SUV</td>
                                    <td>SAR 145800</td>
                                    <td>SAR 1000</td>
                                    <td>
                                        <a href="#" class="view" data-bs-toggle="modal"
                                           data-bs-target="#auctiondetails"><i class="las la-eye"></i></a>
                                        <a href="#" class="edit" data-bs-toggle="modal"
                                           data-bs-target="#auction-details"><i class="las la-pencil-alt"></i></a>
                                        <a href="#" class="delete"><i class="las la-trash-alt"></i></a>
                                        <a href="#" class="download"><i class="las la-download"></i></a>
                                    </td>
                                </tr>
                                <tr>
                                    <td>2019 Infiniti QX80</td>
                                    <td>GMC</td>
                                    <td>SUV</td>
                                    <td>SAR 145800</td>
                                    <td>SAR 1000</td>
                                    <td>
                                        <a href="#" class="view" data-bs-toggle="modal"
                                           data-bs-target="#auctiondetails"><i class="las la-eye"></i></a>
                                        <a href="#" class="edit" data-bs-toggle="modal"
                                           data-bs-target="#auction-details"><i class="las la-pencil-alt"></i></a>
                                        <a href="#" class="delete"><i class="las la-trash-alt"></i></a>
                                        <a href="#" class="download"><i class="las la-download"></i></a>
                                    </td>
                                </tr>
                                <tr>
                                    <td>2019 Infiniti QX80</td>
                                    <td>GMC</td>
                                    <td>SUV</td>
                                    <td>SAR 145800</td>
                                    <td>SAR 1000</td>
                                    <td>
                                        <a href="#" class="view" data-bs-toggle="modal"
                                           data-bs-target="#auctiondetails"><i class="las la-eye"></i></a>
                                        <a href="#" class="edit" data-bs-toggle="modal"
                                           data-bs-target="#auction-details"><i class="las la-pencil-alt"></i></a>
                                        <a href="#" class="delete"><i class="las la-trash-alt"></i></a>
                                        <a href="#" class="download"><i class="las la-download"></i></a>
                                    </td>
                                </tr>

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    @include('website.layouts.component.howworks')
    @include('website.layouts.component.testimonial')
    @include('website.layouts.component.news')
    <div class="clearfix"></div>
@endsection
