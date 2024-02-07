@extends('admin.layouts2.simple.master')
@section('content')
    <div class="content d-flex flex-column flex-column-fluid" id="kt_content">
        <div class="toolbar" id="kt_toolbar">
            <div id="kt_toolbar_container" class="container-fluid d-flex flex-stack">
                @include('admin.layouts2.components.bread-crumbs',['main_name'=>trans('admin_string.Contact_us_detail')])
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
                                    <th class="fw-bold" scope="row">{{trans('admin_string.name')}}</th>
                                    <td>{{ $contact_us->name }}</td>
                                </tr>
                                <tr>
                                    <th class="fw-bold" scope="row">{{trans('admin_string.first_name')}}</th>
                                    <td>{{ $contact_us->first_name }}</td>
                                </tr>
                                <tr>
                                    <th class="fw-bold" scope="row">{{trans('admin_string.last_name')}}</th>
                                    <td>({{ $contact_us->last_name }})</td>
                                </tr>
                                <tr>
                                    <th class="fw-bold" scope="row">{{trans('admin_string.email')}}</th>
                                    <td>{{ $contact_us->email }}</td>
                                </tr>
                                <tr>
                                    <th class="fw-bold" scope="row">{{trans('admin_string.contact_no')}}</th>
                                    <td>{{ $contact_us->contact_number }}</td>
                                </tr>
                                <tr>
                                    <th class="fw-bold" scope="row">{{trans('admin_string.message')}}</th>
                                    <td>{{ $contact_us->message }}</td>
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
