@extends('admin.layouts2.simple.master')
@section('content')
    <div class="content d-flex flex-column flex-column-fluid" id="kt_content">
        <div class="toolbar" id="kt_toolbar">
            <div id="kt_toolbar_container" class="container-fluid d-flex flex-stack">
                @include('admin.layouts2.components.bread-crumbs',['main_name'=>trans('admin_string.vehicle_detail')])
            </div>
        </div>
        <div class="post d-flex flex-column-fluid" id="kt_post">
            <div id="kt_content_container" class="container-fluid">
                <div class="card">
                    <div class="card-header">
                        <div class="card-title">
                            <h2>{{trans('admin_string.details')}}</h2>
                        </div>
                    </div>
                    <div class="card-body pt-0">
                        <div class="table-responsive">
                            <table class="table align-middle table-row-bordered mb-0 fs-6 gy-5 min-w-300px">
                                <tbody class="fw-semibold">
                                <tr>
                                    <th class="fw-bold" scope="row">{{trans('admin_string.image')}}</th>
                                    <td>
                                        <a href="{{asset($vehicle->main_image)}}" target="_blank">
                                            <img src="{{asset($vehicle->main_image)}}" style="width: 100px">
                                        </a>
                                    </td>
                                </tr>
                                <tr>
                                    <th class="fw-bold" scope="row">{{trans('admin_string.name')}}</th>
                                    <td>{{ $vehicle->name }}</td>
                                </tr>
                                <tr>
                                    <th class="fw-bold" scope="row">{{trans('admin_string.vehicle_category')}}</th>
                                    <td>{{ $vehicle->category_name }}</td>
                                </tr>
                                <tr>
                                    <th class="fw-bold" scope="row">{{trans('admin_string.model')}}</th>
                                    <td>({{ $vehicle->model }})</td>
                                </tr>
                                <tr>
                                    <th class="fw-bold" scope="row">{{trans('admin_string.year')}}</th>
                                    <td>{{ $vehicle->year }}</td>
                                </tr>
                                <tr>
                                    <th class="fw-bold" scope="row">{{trans('admin_string.make')}}</th>
                                    <td>{{ $vehicle->make }}</td>
                                </tr>
                                <tr>
                                    <th class="fw-bold" scope="row">{{trans('admin_string.trim')}}</th>
                                    <td>{{ $vehicle->trim }}</td>
                                </tr>
                                <tr>
                                    <th class="fw-bold" scope="row">{{trans('admin_string.kms_driven')}}</th>
                                    <td>{{ $vehicle->kms_driven }}</td>
                                </tr>
                                <tr>
                                    <th class="fw-bold" scope="row">{{trans('admin_string.no_of_owners')}}</th>
                                    <td>{{ $vehicle->owners }}</td>
                                </tr>
                                <tr>
                                    <th class="fw-bold" scope="row">{{trans('admin_string.transmission')}}</th>
                                    <td>{{ $vehicle->transmission }}</td>
                                </tr>
                                <tr>
                                    <th class="fw-bold" scope="row">{{trans('admin_string.fuel')}}</th>
                                    <td>{{ $vehicle->fuel_type }}</td>
                                </tr>
                                <tr>
                                    <th class="fw-bold" scope="row">{{trans('admin_string.body_type')}}</th>
                                    <td>{{ $vehicle->body_type }}</td>
                                </tr>
                                <tr>
                                    <th class="fw-bold" scope="row">{{trans('admin_string.registration')}}</th>
                                    <td>{{ $vehicle->registration }}</td>
                                </tr>
                                <tr>
                                    <th class="fw-bold" scope="row">{{trans('admin_string.exterior_color')}}</th>
                                    <td>{{ $vehicle->color }}</td>
                                </tr>
                                <tr>
                                    <th class="fw-bold" scope="row">{{trans('admin_string.price')}}</th>
                                    <td>{{ number_format($vehicle->price) }}</td>
                                </tr>
                                {{--                                <tr>--}}
                                {{--                                    <th class="fw-bold" scope="row">Minimum Bid Increment Price</th>--}}
                                {{--                                    <td>{{ number_format($vehicle->minimum_bid_increment_price) }}</td>--}}
                                {{--                                </tr>--}}
                                <tr>
                                    <th class="fw-bold" scope="row">{{trans('admin_string.mileage')}}</th>
                                    <td>{{ $vehicle->mileage }}</td>
                                </tr>
                                <tr>
                                    <th class="fw-bold" scope="row">{{trans('admin_string.car_type')}}</th>
                                    <td>{{ $vehicle->car_type }}</td>
                                </tr>
                                {{--                                <tr>--}}
                                {{--                                    <th class="fw-bold" scope="row">{{trans('admin_string.short_description')}}</th>--}}

                                {{--                                    <td>{{ $vehicle->short_description }}</td>--}}
                                {{--                                </tr>--}}
                                <tr>
                                    <th class="fw-bold" scope="row">{{trans('admin_string.description')}}</th>

                                    <td>{{ $vehicle->description }}</td>
                                </tr>
                                <tr>
                                    <th class="fw-bold" scope="row">{{trans('admin_string.status')}}</th>
                                    <td>
                                        @if ((string)$vehicle->status === 'pending')
                                            <div
                                                class="badge badge-light-warning">{{trans('admin_string.pending')}}</div>
                                        @elseif((string)$vehicle->status === 'approve')
                                            <div
                                                class="badge badge-light-success">{{trans('admin_string.approve')}}</div>
                                        @elseif((string)$vehicle->status === 'auction_close')
                                            <div
                                                class="badge badge-light-danger">{{trans('admin_string.auction_close')}}</div>
                                        @elseif((string)$vehicle->status === 'ongoing')
                                            <div
                                                class="badge badge-light-success">{{trans('admin_string.ongoing')}}</div>
                                        @else
                                            <div class="badge badge-light-danger">{{trans('admin_string.reject')}}</div>
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <th class="fw-bold" scope="row">{{trans('admin_string.car_report')}}</th>
                                    <td><a href="{{asset($vehicle->car_report)}}" target="_blank">View Car Report</a>
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
                            <h2>{{trans('admin_string.vehicle_image')}}</h2>
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
                            <h2>{{trans('admin_string.vehicle_document')}}</h2>
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
    <div class="card card-flush py-4 flex-row-fluid mt-2">
        <!--begin::Card header-->
        <div class="card-header">
            <div class="card-title">
                <h2>{{trans('admin_string.vehicle_bid')}}</h2>
            </div>
        </div>
        <div class="card-body pt-0">
            <table class="table align-middle table-row-dashed fs-6 gy-5" id="basic-1">
                <thead>
                <tr class="text-start text-dark-400 fw-bolder fs-7 text-uppercase gs-0">
                    <th>{{trans('admin_string.id')}}</th>
                    <th>{{trans('admin_string.user')}}</th>
                    <th>{{trans('admin_string.bid_amount')}}</th>
                    <th>{{trans('admin_string.bid_time')}}</th>
                    <th>{{trans('admin_string.is_winner')}}</th>
                </tr>
                </thead>
                <tbody class="fw-bold text-gray-600"></tbody>
            </table>
        </div>
    </div>
@endsection
@section('custom-script')
    <script>
        const datatable_url = '/get-vehicle-wise-bid-list/' + '{{$vehicle->vehicle_id}}';

        $.extend(true, $.fn.dataTable.defaults, {
            columns: [
                {data: 'id', name: 'id'},
                {data: 'user_name', name: 'users.name'},
                {data: 'amount', name: 'amount'},
                {data: 'bid_time', name: 'bid_time'},
                {data: 'is_winner', name: 'is_winner'},
            ],
            order: [[0, 'DESC']],
        })
    </script>
    <script src="{{URL::asset('assets/admin/custom/datatable.js')}}?v={{ time() }}"></script>
@endsection
