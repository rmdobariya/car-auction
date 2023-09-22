@extends('admin.layouts2.simple.master')
@section('content')
    <div class="content d-flex flex-column flex-column-fluid" id="kt_content">
        <div class="toolbar" id="kt_toolbar">
            <div id="kt_toolbar_container" class="container-fluid d-flex flex-stack">
                @include('admin.layouts2.components.bread-crumbs',['main_name'=>'Vehicle Detail'])
            </div>
        </div>
        <div class="post d-flex flex-column-fluid" id="kt_post">
            <div id="kt_content_container" class="container-fluid">
                <div class="card">
                    <div class="card-header">
                        <div class="card-title">
                            <h2>Details</h2>
                        </div>
                    </div>
                    <div class="card-body pt-0">
                        <div class="table-responsive">
                            <table class="table align-middle table-row-bordered mb-0 fs-6 gy-5 min-w-300px">
                                <tbody class="fw-semibold">
                                <tr>
                                    <th class="fw-bold" scope="row">Image</th>
                                    <td>
                                        <a href="{{asset($vehicle->main_image)}}" target="_blank">
                                            <img src="{{asset($vehicle->main_image)}}" style="width: 100px">
                                        </a>
                                    </td>
                                </tr>
                                <tr>
                                    <th class="fw-bold" scope="row">Name</th>
                                    <td>{{ $vehicle->vehicle_name }}</td>
                                </tr>
                                <tr>
                                    <th class="fw-bold" scope="row">Vehicle Category</th>
                                    <td>{{ $vehicle->category_name }}</td>
                                </tr>
                                <tr>
                                    <th class="fw-bold" scope="row">Model</th>
                                    <td>({{ $vehicle->model }})</td>
                                </tr>
                                <tr>
                                    <th class="fw-bold" scope="row">Year</th>
                                    <td>{{ $vehicle->year }}</td>
                                </tr>
                                <tr>
                                    <th class="fw-bold" scope="row">Make</th>
                                    <td>{{ $vehicle->make }}</td>
                                </tr>
                                <tr>
                                    <th class="fw-bold" scope="row">Trim</th>
                                    <td>{{ $vehicle->trim }}</td>
                                </tr>
                                <tr>
                                    <th class="fw-bold" scope="row">KMS Driven</th>
                                    <td>{{ $vehicle->kms_driven }}</td>
                                </tr>
                                <tr>
                                    <th class="fw-bold" scope="row">Owners</th>
                                    <td>{{ $vehicle->owners }}</td>
                                </tr>
                                <tr>
                                    <th class="fw-bold" scope="row">Transmission</th>
                                    <td>{{ $vehicle->transmission }}</td>
                                </tr>
                                <tr>
                                    <th class="fw-bold" scope="row">Fuel Type</th>
                                    <td>{{ $vehicle->fuel_type }}</td>
                                </tr>
                                <tr>
                                    <th class="fw-bold" scope="row">Body Type</th>
                                    <td>{{ $vehicle->body_type }}</td>
                                </tr>
                                <tr>
                                    <th class="fw-bold" scope="row">Registration</th>
                                    <td>{{ $vehicle->registration }}</td>
                                </tr>
                                <tr>
                                    <th class="fw-bold" scope="row">Color</th>
                                    <td>{{ $vehicle->color }}</td>
                                </tr>
                                <tr>
                                    <th class="fw-bold" scope="row">Price</th>
                                    <td>{{ number_format($vehicle->price) }}</td>
                                </tr>
                                <tr>
                                    <th class="fw-bold" scope="row">Minimum Bid Increment Price</th>
                                    <td>{{ number_format($vehicle->minimum_bid_increment_price) }}</td>
                                </tr>
                                <tr>
                                    <th class="fw-bold" scope="row">Mileage</th>
                                    <td>{{ $vehicle->mileage }}</td>
                                </tr>
                                <tr>
                                    <th class="fw-bold" scope="row">Vehicle Type</th>
                                    <td>{{ $vehicle->type }}</td>
                                </tr>
                                <tr>
                                    <th class="fw-bold" scope="row">Short Description</th>

                                    <td>{{ $vehicle->t_short_description }}</td>
                                </tr>
                                <tr>
                                    <th class="fw-bold" scope="row">Description</th>

                                    <td>{{ $vehicle->t_description }}</td>
                                </tr>
                                <tr>
                                    <th class="fw-bold" scope="row">Status</th>
                                    <td>
                                        @if ((string)$vehicle->status === 'active')
                                            <div class="badge badge-light-success">Active</div>
                                        @else
                                            <div class="badge badge-light-danger">Inactive</div>
                                        @endif
                                    </td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="card card-flush py-4 flex-row-fluid mt-2">
                    <!--begin::Card header-->
                    <div class="card-header">
                        <div class="card-title">
                            <h2>Vehicle Image</h2>
                        </div>
                    </div>
                    <div class="card-body pt-0">
                        <div class="row">
                            @foreach($vehicle_images as $vehicle_image)
                                <div class="col-3">
                                    <a href="{{asset($vehicle_image->image)}}" target="_blank">
                                        <img src="{{asset($vehicle_image->image)}}" style="width: 150px">
                                    </a>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>

                <div class="card card-flush py-4 flex-row-fluid mt-2">
                    <!--begin::Card header-->
                    <div class="card-header">
                        <div class="card-title">
                            <h2>Vehicle Document</h2>
                        </div>
                    </div>
                    <div class="card-body pt-0">
                        <div class="row">
                            @foreach($vehicle_documents as $vehicle_document)
                                <div class="col-3">
                                    <a href="{{asset($vehicle_document->document)}}" target="_blank">
                                        <img src="{{asset($vehicle_document->document)}}" style="width: 150px">
                                    </a>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('custom-script')

@endsection
