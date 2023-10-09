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
                        <div class="action-btn" style="visibility: hidden">
                            <a href="#" class="create-auction">Start Auction</a>
                        </div>
                    </div>
                </div>
                <div class="clearfix"></div>
                @if(count($vehicles))
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
                                    @foreach($vehicles as $vehicle)
                                        <tr>
                                            <td>{{$vehicle->vehicle_name}}</td>
                                            <td>{{$vehicle->make}}</td>
                                            <td>{{$vehicle->model}}</td>
                                            @if(!is_null($vehicle->minimum_bid_increment_price))
                                                <td>SAR {{$vehicle->minimum_bid_increment_price}}</td>
                                            @else
                                                <td></td>
                                            @endif
                                            @if(!is_null($vehicle->bid_increment))
                                                <td>SAR {{$vehicle->bid_increment}}</td>
                                            @else
                                                <td></td>
                                            @endif
                                            <td>
                                                <a href="#" class="view_bid" data-id="{{$vehicle->id}}"
                                                   data-bs-toggle="modal"><i class="las la-eye"></i></a>
                                                <a href="{{route('edit-car',$vehicle->id)}}" class="edit"><i
                                                        class="las la-pencil-alt"></i></a>
                                                <a href="#" class="delete-single" data-id="{{$vehicle->id}}"><i
                                                        class="las la-trash-alt"></i></a>
                                                {{--                                        <a href="#" class="download"><i class="las la-download"></i></a>--}}
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                @else
                    <h2>Car Not Found</h2>
                @endif
            </div>
        </div>
    </section>
    {{--    @include('website.layouts.component.howworks')--}}
    {{--    @include('website.layouts.component.testimonial')--}}
    {{--    @include('website.layouts.component.news')--}}
    <div class="clearfix"></div>
    <!-- Auction Details Modal -->
    <div class="modal fade bid-model" id="auctiondetails" data-bs-keyboard="false" tabindex="-1"
         aria-labelledby="auctiondetailsLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-body" id="bid_listing_model">

                </div>
            </div>
        </div>
    </div>
@endsection
@section('custom-script')
    <script src="{{asset('web/assets/custom/vehicle/vehicle.js')}}?v={{time()}}"></script>
    <script>

        $('.view_bid').on('click', function () {
            const value_id = $(this).data('id')
            loaderView()
            axios
                .get(APP_URL + '/vehicle-bid-listing' + '/' + value_id)
                .then(function (response) {
                    // $('#bid_listing_title').html(response.data.modal_title)
                    $('#bid_listing_model').html(response.data.data)

                    $('#auctiondetails').modal('show')
                    var mySwiper = new Swiper('.swiper-container', {
                        speed: 400,
                        loop: true,
                        slidesPerView: 1,
                        calculateHeight: true,
                        spaceBetween: 50,
                        watchActiveIndex: true,
                        prevButton: '.swiper-button-prev',
                        nextButton: '.swiper-button-next'
                    })

                    loaderHide()
                })
                .catch(function (error) {
                    loaderHide()
                })
        })
    </script>
@endsection
