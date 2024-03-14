@extends('admin.layouts2.simple.master')
@section('content')
    <div class="content d-flex flex-column flex-column-fluid" id="kt_content">
        <div class="toolbar" id="kt_toolbar">
            <div id="kt_toolbar_container" class="container-fluid d-flex flex-stack">
                @include('admin.layouts2.components.bread-crumbs',['main_name'=>trans('admin_string.notification_detail')])
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
                                    <th class="fw-bold" scope="row">{{trans('admin_string.type')}}</th>
                                    <td>{{ str_replace('_',' ',ucfirst($notification->type)) }}</td>
                                </tr>
                                <tr>
                                    <th class="fw-bold" scope="row">{{trans('admin_string.user_name')}}</th>
                                    @php
                                        $user = DB::table('users')->where('id',$notification->user_id)->first();
                                    @endphp
                                    <td>{{ $user->name }}</td>
                                </tr>
                                @if(!is_null($notification->vehicle_id))
                                    @php
                                        $vehicle = DB::table('vehicle_translations')
                                        ->where('vehicle_id',$notification->vehicle_id)
                                        ->where('locale', App::getLocale())
                                        ->first();
                                    @endphp
                                    <tr>
                                        <th class="fw-bold" scope="row">{{trans('admin_string.vehicle_name')}}</th>
                                        <td>{{ $vehicle->name }}</td>
                                    </tr>
                                @endif

                                <tr>
                                    <th class="fw-bold" scope="row">{{trans('admin_string.first_name')}}</th>
                                    <td>({{ $notification->first_name }})</td>
                                </tr>
                                <tr>
                                    <th class="fw-bold" scope="row">{{trans('admin_string.last_name')}}</th>
                                    <td>{{ $notification->last_name }}</td>
                                </tr>
                                <tr>
                                    <th class="fw-bold" scope="row">{{trans('admin_string.email')}}</th>
                                    <td>{{ $notification->email }}</td>
                                </tr>
                                <tr>
                                    <th class="fw-bold" scope="row">{{trans('admin_string.mobile_no')}}</th>
                                    <td>{{ $notification->mobile_no }}</td>
                                </tr>
                                @if(!is_null($notification->question))
                                    <tr>
                                        <th class="fw-bold" scope="row">{{trans('admin_string.question')}}</th>
                                        <td>{{ $notification->question }}</td>
                                    </tr>
                                @endif
                                <tr>
                                    <th class="fw-bold" scope="row">{{trans('admin_string.message')}}</th>
                                    <td>{!! $notification->message !!}</td>
                                </tr>

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('custom-script')

@endsection
