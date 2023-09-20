@extends('website.layouts.master')
@section('content')
    <section id="vehicles" class="featured-vehicles">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="heading">
                        <h1>My Auctions</h1>
                        <div class="action-btn">
                            <a href="#">View All</a>
                            <a href="#" class="create-auction">Create Auction</a>
                        </div>
                    </div>
                </div>
                <div class="clearfix"></div>
                <div class="col-md-12">
                    <div class="auctions-list">
                        <div class="auctions-filter">
                            <select class="form-select">
                                <option>Auction Status</option>
                                <option>Completed</option>
                                <option>Waiting for Approval</option>
                                <option>Ongoing</option>
                                <option>Ongoing</option>
                            </select>
                            <div class="sdate">
                                <div class="input-group date" id="datepicker">
                                    <input type="text" class="form-control" id="date"placeholder="Auction Start Date" />
                                    <span class="input-group-append">
										<span class="input-group-text bg-light d-block">
											<i class="las la-calendar-alt"></i>
										</span>
									</span>
                                </div>
                            </div>
                            <div class="edate">
                                <div class="input-group date" id="datepicker1">
                                    <input type="text" class="form-control" id="date" placeholder="Auction End Date" />
                                    <span class="input-group-append">
										<span class="input-group-text bg-light d-block">
											<i class="las la-calendar-alt"></i>
										</span>
									</span>
                                </div>
                            </div>
                            <div class="apply-filter">
                                <input type="submit" name="filter" value="Apply" class="place-bid-blue">
                            </div>
                        </div>
                        <div class="lists">
                            <table>
                                <thead>
                                <tr>
                                    <th>Auction Start Date</th>
                                    <th>Auction End Date</th>
                                    <th>No. of Cars</th>
                                    <th>Auction Status</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    <td>25-08-2023</td>
                                    <td>25-09-2023</td>
                                    <td>13</td>
                                    <td><span class="completed">Completed</span></td>
                                    <td>
                                        <a href="#" class="view" data-bs-toggle="modal" data-bs-target="#auctiondetails"><i class="las la-eye"></i></a>
                                        <a href="#" class="edit" data-bs-toggle="modal" data-bs-target="#auction-details"><i class="las la-pencil-alt"></i></a>
                                        <a href="#" class="delete"><i class="las la-trash-alt"></i></a>
                                        <a href="#" class="download"><i class="las la-download"></i></a>
                                    </td>
                                </tr>
                                <tr>
                                    <td>25-08-2023</td>
                                    <td>25-09-2023</td>
                                    <td>13</td>
                                    <td><span class="waiting">Waiting for Approval</span></td>
                                    <td>
                                        <a href="#" class="view" data-bs-toggle="modal" data-bs-target="#auctiondetails"><i class="las la-eye"></i></a>
                                        <a href="#" class="edit" data-bs-toggle="modal" data-bs-target="#auction-details"><i class="las la-pencil-alt"></i></a>
                                        <a href="#" class="delete"><i class="las la-trash-alt"></i></a>
                                        <a href="#" class="download"><i class="las la-download"></i></a>
                                    </td>
                                </tr>
                                <tr>
                                    <td>25-08-2023</td>
                                    <td>25-09-2023</td>
                                    <td>13</td>
                                    <td><span class="ongoing">Ongoing</span></td>
                                    <td>
                                        <a href="#" class="view" data-bs-toggle="modal" data-bs-target="#auctiondetails"><i class="las la-eye"></i></a>
                                        <a href="#" class="edit" data-bs-toggle="modal" data-bs-target="#auction-details"><i class="las la-pencil-alt"></i></a>
                                        <a href="#" class="delete"><i class="las la-trash-alt"></i></a>
                                        <a href="#" class="download"><i class="las la-download"></i></a>
                                    </td>
                                </tr>
                                <tr>
                                    <td>25-08-2023</td>
                                    <td>25-09-2023</td>
                                    <td>13</td>
                                    <td><span class="completed">Completed</span></td>
                                    <td>
                                        <a href="#" class="view" data-bs-toggle="modal" data-bs-target="#auctiondetails"><i class="las la-eye"></i></a>
                                        <a href="#" class="edit" data-bs-toggle="modal" data-bs-target="#auction-details"><i class="las la-pencil-alt"></i></a>
                                        <a href="#" class="delete"><i class="las la-trash-alt"></i></a>
                                        <a href="#" class="download"><i class="las la-download"></i></a>
                                    </td>
                                </tr>
                                <tr>
                                    <td>25-08-2023</td>
                                    <td>25-09-2023</td>
                                    <td>13</td>
                                    <td><span class="waiting">Waiting for Approval</span></td>
                                    <td>
                                        <a href="#" class="view" data-bs-toggle="modal" data-bs-target="#auctiondetails"><i class="las la-eye"></i></a>
                                        <a href="#" class="edit" data-bs-toggle="modal" data-bs-target="#auction-details"><i class="las la-pencil-alt"></i></a>
                                        <a href="#" class="delete"><i class="las la-trash-alt"></i></a>
                                        <a href="#" class="download"><i class="las la-download"></i></a>
                                    </td>
                                </tr>
                                <tr>
                                    <td>25-08-2023</td>
                                    <td>25-09-2023</td>
                                    <td>13</td>
                                    <td><span class="ongoing">Ongoing</span></td>
                                    <td>
                                        <a href="#" class="view" data-bs-toggle="modal" data-bs-target="#auctiondetails"><i class="las la-eye"></i></a>
                                        <a href="#" class="edit" data-bs-toggle="modal" data-bs-target="#auction-details"><i class="las la-pencil-alt"></i></a>
                                        <a href="#" class="delete"><i class="las la-trash-alt"></i></a>
                                        <a href="#" class="download"><i class="las la-download"></i></a>
                                    </td>
                                </tr>
                                <tr>
                                    <td>25-08-2023</td>
                                    <td>25-09-2023</td>
                                    <td>13</td>
                                    <td><span class="completed">Completed</span></td>
                                    <td>
                                        <a href="#" class="view" data-bs-toggle="modal" data-bs-target="#auctiondetails"><i class="las la-eye"></i></a>
                                        <a href="#" class="edit" data-bs-toggle="modal" data-bs-target="#auction-details"><i class="las la-pencil-alt"></i></a>
                                        <a href="#" class="delete"><i class="las la-trash-alt"></i></a>
                                        <a href="#" class="download"><i class="las la-download"></i></a>
                                    </td>
                                </tr>
                                <tr>
                                    <td>25-08-2023</td>
                                    <td>25-09-2023</td>
                                    <td>13</td>
                                    <td><span class="waiting">Waiting for Approval</span></td>
                                    <td>
                                        <a href="#" class="view" data-bs-toggle="modal" data-bs-target="#auctiondetails"><i class="las la-eye"></i></a>
                                        <a href="#" class="edit" data-bs-toggle="modal" data-bs-target="#auction-details"><i class="las la-pencil-alt"></i></a>
                                        <a href="#" class="delete"><i class="las la-trash-alt"></i></a>
                                        <a href="#" class="download"><i class="las la-download"></i></a>
                                    </td>
                                </tr>
                                <tr>
                                    <td>25-08-2023</td>
                                    <td>25-09-2023</td>
                                    <td>13</td>
                                    <td><span class="ongoing">Ongoing</span></td>
                                    <td>
                                        <a href="#" class="view" data-bs-toggle="modal" data-bs-target="#auctiondetails"><i class="las la-eye"></i></a>
                                        <a href="#" class="edit" data-bs-toggle="modal" data-bs-target="#auction-details"><i class="las la-pencil-alt"></i></a>
                                        <a href="#" class="delete"><i class="las la-trash-alt"></i></a>
                                        <a href="#" class="download"><i class="las la-download"></i></a>
                                    </td>
                                </tr>
                                <tr>
                                    <td>25-08-2023</td>
                                    <td>25-09-2023</td>
                                    <td>13</td>
                                    <td><span class="completed">Completed</span></td>
                                    <td>
                                        <a href="#" class="view" data-bs-toggle="modal" data-bs-target="#auctiondetails"><i class="las la-eye"></i></a>
                                        <a href="#" class="edit" data-bs-toggle="modal" data-bs-target="#auction-details"><i class="las la-pencil-alt"></i></a>
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
            <div class="row">
                <div class="col-md-12">
                    <div class="heading">
                        <h1>Cars for Sell</h1>
                        <a href="#">View All</a>
                    </div>
                </div>
                <div class="clearfix"></div>
                <div class="col-md-12">
                    <div class="details-box">
                        <div class="car-img">
                            <img src="images/car.jpg" align="car">
                            <span class="cat-tags"><img src="images/dymand.png"> Featured</span>
                            <a href="#" class="like"><i class="las la-heart"></i></a>
                        </div>
                        <div class="car-name">
                            <div class="names">
                                <h3>2019 Infiniti QX80</h3>
                                <p>Luxe Sensory 7ST</p>
                            </div>
                        </div>
                        <div class="car-specifation">
                            <div class="drive">
                                <div class="icon"></div>
                            </div>
                            <div class="car-dt">
                                <div class="icon">
                                    <img src="images/road.png" align="road">
                                </div>
                                <div class="detsl">
                                    20,500 km
                                </div>
                            </div>
                            <div class="car-dt">
                                <div class="icon">
                                    <img src="images/km.png" align="km">
                                </div>
                                <div class="detsl">
                                    16.5 kmpl
                                </div>
                            </div>
                            <div class="car-dt">
                                <div class="icon">
                                    <img src="images/petrol.png" align="petrol">
                                </div>
                                <div class="detsl">
                                    Petrol
                                </div>
                            </div>
                            <div class="car-dt">
                                <div class="icon">
                                    <img src="images/auto.png" align="auto">
                                </div>
                                <div class="detsl">
                                    Auto
                                </div>
                            </div>
                        </div>
                        <div class="car-price">
                            <span>Bid Start on <b>15th Sep 2023</b></span>
                            <div class="initial-price-box">
                                <p>Initial Price</p>
                                <h3>SAR 50,000</h3>
                            </div>
                            <a href="#" class="place-bid-blue" data-bs-toggle="modal" data-bs-target="#carderails">Contact Seller</a>
                        </div>
                    </div>
                    <div class="details-box">
                        <div class="car-img">
                            <img src="images/car.jpg" align="car">
                            <span class="cat-tags"><img src="images/dymand.png"> Featured</span>
                            <a href="#" class="like"><i class="lar la-heart"></i></a>
                        </div>
                        <div class="car-name">
                            <div class="names">
                                <div class="names">
                                    <h3>2019 Infiniti QX80</h3>
                                    <p>Luxe Sensory 7ST</p>
                                </div>
                            </div>
                        </div>
                        <div class="car-specifation">
                            <div class="car-dt">
                                <div class="icon">
                                    <img src="images/road.png" align="road">
                                </div>
                                <div class="detsl">
                                    20,500 km
                                </div>
                            </div>
                            <div class="car-dt">
                                <div class="icon">
                                    <img src="images/km.png" align="km">
                                </div>
                                <div class="detsl">
                                    16.5 kmpl
                                </div>
                            </div>
                            <div class="car-dt">
                                <div class="icon">
                                    <img src="images/petrol.png" align="petrol">
                                </div>
                                <div class="detsl">
                                    Petrol
                                </div>
                            </div>
                            <div class="car-dt">
                                <div class="icon">
                                    <img src="images/auto.png" align="auto">
                                </div>
                                <div class="detsl">
                                    Auto
                                </div>
                            </div>
                        </div>
                        <div class="car-price">
                            <span>Bid Start on <b>15th Sep 2023</b></span>
                            <div class="initial-price-box">
                                <p>Initial Price</p>
                                <h3>SAR 50,000</h3>
                            </div>
                            <a href="#" class="place-bid-blue" data-bs-toggle="modal" data-bs-target="#carderails">Contact Seller</a>
                        </div>
                    </div>
                    <div class="details-box">
                        <div class="car-img">
                            <img src="images/car.jpg" align="car">
                            <span class="cat-tags"><img src="images/dymand.png"> Featured</span>
                            <a href="#" class="like"><i class="lar la-heart"></i></a>
                        </div>
                        <div class="car-name">
                            <div class="names">
                                <div class="names">
                                    <h3>2019 Infiniti QX80</h3>
                                    <p>Luxe Sensory 7ST</p>
                                </div>
                            </div>
                        </div>
                        <div class="car-specifation">
                            <div class="car-dt">
                                <div class="icon">
                                    <img src="images/road.png" align="road">
                                </div>
                                <div class="detsl">
                                    20,500 km
                                </div>
                            </div>
                            <div class="car-dt">
                                <div class="icon">
                                    <img src="images/km.png" align="km">
                                </div>
                                <div class="detsl">
                                    16.5 kmpl
                                </div>
                            </div>
                            <div class="car-dt">
                                <div class="icon">
                                    <img src="images/petrol.png" align="petrol">
                                </div>
                                <div class="detsl">
                                    Petrol
                                </div>
                            </div>
                            <div class="car-dt">
                                <div class="icon">
                                    <img src="images/auto.png" align="auto">
                                </div>
                                <div class="detsl">
                                    Auto
                                </div>
                            </div>
                        </div>
                        <div class="car-price">
                            <span>Bid Start on <b>15th Sep 2023</b></span>
                            <div class="initial-price-box">
                                <p>Initial Price</p>
                                <h3>SAR 50,000</h3>
                            </div>
                            <a href="#" class="place-bid-blue" data-bs-toggle="modal" data-bs-target="#carderails">Contact Seller</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="heading">
                        <h1>Featured Vehicles</h1>
                        <a href="#">View All</a>
                    </div>
                </div>
                <div class="clearfix"></div>
                <div class="col-md-12">
                    <div class="details-box">
                        <div class="car-img">
                            <img src="images/car.jpg" align="car">
                            <span class="cat-tags"><img src="images/dymand.png"> Featured</span>
                            <a href="#" class="like"><i class="las la-heart"></i></a>
                        </div>
                        <div class="car-name">
                            <div class="names">
                                <h3>2019 Infiniti QX80</h3>
                                <p>Luxe Sensory 7ST</p>
                            </div>
                        </div>
                        <div class="car-specifation">
                            <div class="car-dt">
                                <div class="icon">
                                    <img src="images/road.png" align="road">
                                </div>
                                <div class="detsl">
                                    20,500 km
                                </div>
                            </div>
                            <div class="car-dt">
                                <div class="icon">
                                    <img src="images/km.png" align="km">
                                </div>
                                <div class="detsl">
                                    16.5 kmpl
                                </div>
                            </div>
                            <div class="car-dt">
                                <div class="icon">
                                    <img src="images/petrol.png" align="petrol">
                                </div>
                                <div class="detsl">
                                    Petrol
                                </div>
                            </div>
                            <div class="car-dt">
                                <div class="icon">
                                    <img src="images/auto.png" align="auto">
                                </div>
                                <div class="detsl">
                                    Auto
                                </div>
                            </div>
                        </div>
                        <div class="car-price">
                            <span>Bid Start on <b>15th Sep 2023</b></span>
                            <div class="initial-price-box">
                                <p>Initial Price</p>
                                <h3>SAR 50,000</h3>
                            </div>
                            <a href="#" class="place-bid-blue" data-bs-toggle="modal" data-bs-target="#carderails">Place Bid</a>
                        </div>
                    </div>
                    <div class="details-box">
                        <div class="car-img">
                            <img src="images/car.jpg" align="car">
                            <span class="cat-tags"><img src="images/dymand.png"> Featured</span>
                            <a href="#" class="like"><i class="lar la-heart"></i></a>
                        </div>
                        <div class="car-name">
                            <div class="names">
                                <div class="names">
                                    <h3>2019 Infiniti QX80</h3>
                                    <p>Luxe Sensory 7ST</p>
                                </div>
                            </div>
                        </div>
                        <div class="car-specifation">
                            <div class="car-dt">
                                <div class="icon">
                                    <img src="images/road.png" align="road">
                                </div>
                                <div class="detsl">
                                    20,500 km
                                </div>
                            </div>
                            <div class="car-dt">
                                <div class="icon">
                                    <img src="images/km.png" align="km">
                                </div>
                                <div class="detsl">
                                    16.5 kmpl
                                </div>
                            </div>
                            <div class="car-dt">
                                <div class="icon">
                                    <img src="images/petrol.png" align="petrol">
                                </div>
                                <div class="detsl">
                                    Petrol
                                </div>
                            </div>
                            <div class="car-dt">
                                <div class="icon">
                                    <img src="images/auto.png" align="auto">
                                </div>
                                <div class="detsl">
                                    Auto
                                </div>
                            </div>
                        </div>
                        <div class="car-price">
                            <span>Bid Start on <b>15th Sep 2023</b></span>
                            <div class="initial-price-box">
                                <p>Initial Price</p>
                                <h3>SAR 50,000</h3>
                            </div>
                            <a href="#" class="place-bid-blue" data-bs-toggle="modal" data-bs-target="#carderails">Place Bid</a>
                        </div>
                    </div>
                    <div class="details-box">
                        <div class="car-img">
                            <img src="images/car.jpg" align="car">
                            <span class="cat-tags"><img src="images/dymand.png"> Featured</span>
                            <a href="#" class="like"><i class="lar la-heart"></i></a>
                        </div>
                        <div class="car-name">
                            <div class="names">
                                <div class="names">
                                    <h3>2019 Infiniti QX80</h3>
                                    <p>Luxe Sensory 7ST</p>
                                </div>
                            </div>
                        </div>
                        <div class="car-specifation">
                            <div class="car-dt">
                                <div class="icon">
                                    <img src="images/road.png" align="road">
                                </div>
                                <div class="detsl">
                                    20,500 km
                                </div>
                            </div>
                            <div class="car-dt">
                                <div class="icon">
                                    <img src="images/km.png" align="km">
                                </div>
                                <div class="detsl">
                                    16.5 kmpl
                                </div>
                            </div>
                            <div class="car-dt">
                                <div class="icon">
                                    <img src="images/petrol.png" align="petrol">
                                </div>
                                <div class="detsl">
                                    Petrol
                                </div>
                            </div>
                            <div class="car-dt">
                                <div class="icon">
                                    <img src="images/auto.png" align="auto">
                                </div>
                                <div class="detsl">
                                    Auto
                                </div>
                            </div>
                        </div>
                        <div class="car-price">
                            <span>Bid Start on <b>15th Sep 2023</b></span>
                            <div class="initial-price-box">
                                <p>Initial Price</p>
                                <h3>SAR 50,000</h3>
                            </div>
                            <a href="#" class="place-bid-blue" data-bs-toggle="modal" data-bs-target="#carderails">Place Bid</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="heading">
                        <h1>Popular Vehicles</h1>
                        <a href="#">View All</a>
                    </div>
                </div>
                <div class="clearfix"></div>
                <div class="col-md-12">
                    <div class="details-box">
                        <div class="car-img">
                            <img src="images/car.jpg" align="car">
                            <span class="cat-tags"><img src="images/dymand.png"> Featured</span>
                            <a href="#" class="like"><i class="las la-heart"></i></a>
                        </div>
                        <div class="car-name">
                            <div class="names">
                                <h3>2019 Infiniti QX80</h3>
                                <p>Luxe Sensory 7ST</p>
                            </div>
                        </div>
                        <div class="car-specifation">
                            <div class="car-dt">
                                <div class="icon">
                                    <img src="images/road.png" align="road">
                                </div>
                                <div class="detsl">
                                    20,500 km
                                </div>
                            </div>
                            <div class="car-dt">
                                <div class="icon">
                                    <img src="images/km.png" align="km">
                                </div>
                                <div class="detsl">
                                    16.5 kmpl
                                </div>
                            </div>
                            <div class="car-dt">
                                <div class="icon">
                                    <img src="images/petrol.png" align="petrol">
                                </div>
                                <div class="detsl">
                                    Petrol
                                </div>
                            </div>
                            <div class="car-dt">
                                <div class="icon">
                                    <img src="images/auto.png" align="auto">
                                </div>
                                <div class="detsl">
                                    Auto
                                </div>
                            </div>
                        </div>
                        <div class="car-price">
                            <span>Bid Start on <b>15th Sep 2023</b></span>
                            <div class="initial-price-box">
                                <p>Initial Price</p>
                                <h3>SAR 50,000</h3>
                            </div>
                            <a href="#" class="place-bid-blue" data-bs-toggle="modal" data-bs-target="#carderails">Place Bid</a>
                        </div>
                    </div>
                    <div class="details-box">
                        <div class="car-img">
                            <img src="images/car.jpg" align="car">
                            <span class="cat-tags"><img src="images/dymand.png"> Featured</span>
                            <a href="#" class="like"><i class="lar la-heart"></i></a>
                        </div>
                        <div class="car-name">
                            <div class="names">
                                <div class="names">
                                    <h3>2019 Infiniti QX80</h3>
                                    <p>Luxe Sensory 7ST</p>
                                </div>
                            </div>
                        </div>
                        <div class="car-specifation">
                            <div class="car-dt">
                                <div class="icon">
                                    <img src="images/road.png" align="road">
                                </div>
                                <div class="detsl">
                                    20,500 km
                                </div>
                            </div>
                            <div class="car-dt">
                                <div class="icon">
                                    <img src="images/km.png" align="km">
                                </div>
                                <div class="detsl">
                                    16.5 kmpl
                                </div>
                            </div>
                            <div class="car-dt">
                                <div class="icon">
                                    <img src="images/petrol.png" align="petrol">
                                </div>
                                <div class="detsl">
                                    Petrol
                                </div>
                            </div>
                            <div class="car-dt">
                                <div class="icon">
                                    <img src="images/auto.png" align="auto">
                                </div>
                                <div class="detsl">
                                    Auto
                                </div>
                            </div>
                        </div>
                        <div class="car-price">
                            <span>Bid Start on <b>15th Sep 2023</b></span>
                            <div class="initial-price-box">
                                <p>Initial Price</p>
                                <h3>SAR 50,000</h3>
                            </div>
                            <a href="#" class="place-bid-blue" data-bs-toggle="modal" data-bs-target="#carderails">Place Bid</a>
                        </div>
                    </div>
                    <div class="details-box">
                        <div class="car-img">
                            <img src="images/car.jpg" align="car">
                            <span class="cat-tags"><img src="images/dymand.png"> Featured</span>
                            <a href="#" class="like"><i class="lar la-heart"></i></a>
                        </div>
                        <div class="car-name">
                            <div class="names">
                                <div class="names">
                                    <h3>2019 Infiniti QX80</h3>
                                    <p>Luxe Sensory 7ST</p>
                                </div>
                            </div>
                        </div>
                        <div class="car-specifation">
                            <div class="car-dt">
                                <div class="icon">
                                    <img src="images/road.png" align="road">
                                </div>
                                <div class="detsl">
                                    20,500 km
                                </div>
                            </div>
                            <div class="car-dt">
                                <div class="icon">
                                    <img src="images/km.png" align="km">
                                </div>
                                <div class="detsl">
                                    16.5 kmpl
                                </div>
                            </div>
                            <div class="car-dt">
                                <div class="icon">
                                    <img src="images/petrol.png" align="petrol">
                                </div>
                                <div class="detsl">
                                    Petrol
                                </div>
                            </div>
                            <div class="car-dt">
                                <div class="icon">
                                    <img src="images/auto.png" align="auto">
                                </div>
                                <div class="detsl">
                                    Auto
                                </div>
                            </div>
                        </div>
                        <div class="car-price">
                            <span>Bid Start on <b>15th Sep 2023</b></span>
                            <div class="initial-price-box">
                                <p>Initial Price</p>
                                <h3>SAR 50,000</h3>
                            </div>
                            <a href="#" class="place-bid-blue" data-bs-toggle="modal" data-bs-target="#carderails">Place Bid</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section id="howworks">
        <div class="container">
            <div class="row">
                <div class="col-md-12 text-center">
                    <div class="title">
                        <h1>How it Works</h1>
                    </div>
                </div>
                <div class="clearfix"></div>
                <div class="col-md-4">
                    <div class="work-box">
                        <span>1</span>
                        <h2>Register</h2>
                        <p>Sign up for a Copart Middle East Standard or Premier Membership</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="work-box">
                        <span>2</span>
                        <h2>Find</h2>
                        <p>Search our large inventory of used & damaged vehicles</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="work-box">
                        <span>3</span>
                        <h2>Bid</h2>
                        <p>Bid in our online auctionsacross the Middle East</p>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section id="testimonial">
        <div class="container">
            <div class="row">
                <div class="col-md-12 text-center">
                    <div class="title">
                        <h1>Testimonial</h1>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="testimonial">
                        <div class="container">
                            <div class="testimonial__inner">
                                <div class="testimonial-slider">
                                    <div class="testimonial-slide">
                                        <div class="testimonial_box">
                                            <div class="testimonial_box-inner">
                                                <div class="testimonial_box-top">
                                                    <div class="testimonial_box-icon">
                                                        <img src="images/quotes.svg">
                                                    </div>
                                                    <div class="testimonial_box-text">
                                                        <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s.</p>
                                                    </div>
                                                    <div class="testimonial_box-name">
                                                        <h4>Durriyah Abida</h4>
                                                    </div>
                                                    <div class="testimonial_box-job">
                                                        <p>Oman</p>
                                                    </div>
                                                    <div class="testimonial_box-img">
                                                        <img src="https://i.ibb.co/hKgs8gm/profile.jpg" alt="profile">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="testimonial-slide">
                                        <div class="testimonial_box">
                                            <div class="testimonial_box-inner">
                                                <div class="testimonial_box-top">
                                                    <div class="testimonial_box-icon">
                                                        <img src="images/quotes.svg">
                                                    </div>
                                                    <div class="testimonial_box-text">
                                                        <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s.</p>
                                                    </div>
                                                    <div class="testimonial_box-name">
                                                        <h4>Durriyah Abida</h4>
                                                    </div>
                                                    <div class="testimonial_box-job">
                                                        <p>Oman</p>
                                                    </div>
                                                    <div class="testimonial_box-img">
                                                        <img src="https://i.ibb.co/hKgs8gm/profile.jpg" alt="profile">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="testimonial-slide">
                                        <div class="testimonial_box">
                                            <div class="testimonial_box-inner">
                                                <div class="testimonial_box-top">
                                                    <div class="testimonial_box-icon">
                                                        <img src="images/quotes.svg">
                                                    </div>
                                                    <div class="testimonial_box-text">
                                                        <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s.</p>
                                                    </div>
                                                    <div class="testimonial_box-name">
                                                        <h4>Durriyah Abida</h4>
                                                    </div>
                                                    <div class="testimonial_box-job">
                                                        <p>Oman</p>
                                                    </div>
                                                    <div class="testimonial_box-img">
                                                        <img src="https://i.ibb.co/hKgs8gm/profile.jpg" alt="profile">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="testimonial-slide">
                                        <div class="testimonial_box">
                                            <div class="testimonial_box-inner">
                                                <div class="testimonial_box-top">
                                                    <div class="testimonial_box-icon">
                                                        <img src="images/quotes.svg">
                                                    </div>
                                                    <div class="testimonial_box-text">
                                                        <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s.</p>
                                                    </div>
                                                    <div class="testimonial_box-name">
                                                        <h4>Durriyah Abida</h4>
                                                    </div>
                                                    <div class="testimonial_box-job">
                                                        <p>Oman</p>
                                                    </div>
                                                    <div class="testimonial_box-img">
                                                        <img src="https://i.ibb.co/hKgs8gm/profile.jpg" alt="profile">
                                                    </div>
                                                </div>
                                            </div>
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

    <section id="news">
        <div class="container">
            <div class="row">
                <div class="col-md-12 text-center">
                    <div class="title ">
                        <h1 class="text-white">News</h1>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="testimonial">
                        <div class="container">
                            <div class="testimonial__inner">
                                <div class="testimonial-slider">
                                    <div class="testimonial-slide">
                                        <div class="testimonial_box">
                                            <div class="testimonial_box-inner">
                                                <div class="testimonial_box-top">
                                                    <div class="testimonial_box-text">
                                                        <div class="date">
                                                            <span>Aug 20, 2023</span>
                                                        </div>
                                                        <h1>'lorem ipsum' will uncover many web sites still in their infancy</h1>
                                                        <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s.</p>
                                                        <a href="#">Read Now</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="testimonial-slide">
                                        <div class="testimonial_box">
                                            <div class="testimonial_box-inner">
                                                <div class="testimonial_box-top">
                                                    <div class="testimonial_box-text">
                                                        <div class="date">
                                                            <span>Aug 20, 2023</span>
                                                        </div>
                                                        <h1>'lorem ipsum' will uncover many web sites still in their infancy</h1>
                                                        <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s.</p>
                                                        <a href="#">Read Now</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="testimonial-slide">
                                        <div class="testimonial_box">
                                            <div class="testimonial_box-inner">
                                                <div class="testimonial_box-top">
                                                    <div class="testimonial_box-text">
                                                        <div class="date">
                                                            <span>Aug 20, 2023</span>
                                                        </div>
                                                        <h1>'lorem ipsum' will uncover many web sites still in their infancy</h1>
                                                        <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s.</p>
                                                        <a href="#">Read Now</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="testimonial-slide">
                                        <div class="testimonial_box">
                                            <div class="testimonial_box-inner">
                                                <div class="testimonial_box-top">
                                                    <div class="testimonial_box-text">
                                                        <div class="date">
                                                            <span>Aug 20, 2023</span>
                                                        </div>
                                                        <h1>'lorem ipsum' will uncover many web sites still in their infancy</h1>
                                                        <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s.</p>
                                                        <a href="#">Read Now</a>
                                                    </div>
                                                </div>
                                            </div>
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
    <div class="clearfix"></div>
@endsection
