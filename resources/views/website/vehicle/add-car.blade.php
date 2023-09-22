@extends('website.layouts.master')
@section('content')
    <section id="vehicles" class="featured-vehicles">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="heading auction-detailss">
                        <h1>Car Details</h1>
                        <div class="add-car-form">
                            <form id="vehicleAddForm">
                                <div class="row">
                                    <div class="col-md-4">
                                        <input type="text" name="carname" class="form-control" placeholder="Car Name *">
                                    </div>
                                    <div class="col-md-4">
                                        <input type="text" name="make" class="form-control" placeholder="Make *">
                                    </div>
                                    <div class="col-md-4">
                                        <input type="text" name="model" class="form-control" placeholder="Model *">
                                    </div>
                                    <div class="col-md-4">
                                        <input type="text" name="year" class="form-control" placeholder="Year *">
                                    </div>
                                    <div class="col-md-4">
                                        <input type="text" name="description" class="form-control"
                                               placeholder="Description *">
                                    </div>
                                    <div class="col-md-4">
                                        <input type="text" name="milage" class="form-control" placeholder="Milage">
                                    </div>
                                    <div class="col-md-4">
                                        <input type="text" name="bodType" class="form-control" placeholder="Body Type">
                                    </div>
                                    <div class="col-md-4">
                                        <input type="text" name="exterioColor" class="form-control"
                                               placeholder="Exterior Color">
                                    </div>
                                    <div class="col-md-4">
                                        <input type="text" name="carType" class="form-control" placeholder="Car Type">
                                    </div>
                                    <div class="col-md-4">
                                        <div class="car-rating">
                                            <p>Rating</p>
                                            <div class="rating_container secondary">
                                                <span class="rating">1</span>
                                                <span class="rating">2</span>
                                                <span class="rating">3</span>
                                                <span class="rating">4</span>
                                                <span class="rating">5</span>
                                                <input value="0" type="number" name="ratingvalue" class="ratingvalue"/>
                                            </div>

                                        </div>
                                    </div>
                                    <div class="col-md-8">
                                        <div class="uploads">
                                            <div id="fileList"></div>
                                            <div class="upload-filess">
                                                <p>Upload Photos *</p>
                                                <span><i class="las la-plus"></i></span>
                                                <input type="file" name="vehicleImage[]" id="file" multiple
                                                       onchange="javascript:updateList()"/>
                                            </div>
                                        </div>
                                    </div>
                                </div>
{{--                                <div class="row">--}}
{{--                                    @include('admin.layouts2.components.fineUploader')--}}
{{--                                </div>--}}
                                <h1>Car Documents</h1>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="uploads">
                                            <div id="fileList1"></div>
                                            <div class="upload-filess">
                                                <p>Upload Document *</p>
                                                <span><i class="las la-plus"></i></span>
                                                <input type="file" name="vehicleDocument[]" id="file1" multiple
                                                       onchange="javascript:updateList1()"/>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <h1>Car Auction Details</h1>
                                <div class="row">
                                    <div class="col-md-6">
                                        <input type="text" name="initialPrice" class="form-control"
                                               placeholder="Initial Price *">
                                    </div>
                                    <div class="col-md-6">
                                        <input type="text" name="minimumBidIncrement" class="form-control"
                                               placeholder="Minimum Bid Increment *">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-3">
                                        <label>Start Date</label>

                                        <input type="date" name="auction_start_date" class="form-control"
                                               placeholder="Auction Start Date">
                                    </div>
                                    <div class="col-md-3">
                                    <label>Start Time</label>

                                        <input type="time" name="auction_start_time" class="form-control"
                                               placeholder="Auction Start Time">
                                    </div>
                                    <div class="col-md-3">
                                    <label>End Date</label>

                                        <input type="date" name="auction_end_date" class="form-control"
                                               placeholder="Auction End Date">
                                    </div>
                                    <div class="col-md-3">
                                    <label>End Time</label>

                                        <input type="time" name="auction_end_time" class="form-control"
                                               placeholder="Auction End Time">
                                    </div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-md-12 text-center">
                                        <button type="submit" class="place-bid-blue">Add Car to Auction</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <div class="clearfix"></div>
@endsection
@section('custom-script')
    <script src="{{asset('web/assets/custom/vehicle/vehicle.js')}}?v={{time()}}"></script>
@endsection
