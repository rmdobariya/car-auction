@extends('admin.layouts2.simple.master')
@section('content')
    <div class="content d-flex flex-column flex-column-fluid" id="kt_content">
        <div class="toolbar" id="kt_toolbar">
            <div id="kt_toolbar_container" class="container-fluid d-flex flex-stack">
                @include('admin.layouts2.components.bread-crumbs',['main_name'=>trans('admin_string.payment_proofs')])
            </div>
        </div>
        <div class="post d-flex flex-column-fluid" id="kt_post">
            <div id="kt_content_container" class="container-fluid">
                <div class="card">
                    <div class="card-body pt-0">
                        <table class="table align-middle table-row-dashed fs-6 gy-5" id="basic-1">
                            <thead>
                            <tr class="text-start text-dark-400 fw-bolder fs-7 text-uppercase gs-0">
                                <th>{{trans('admin_string.id')}}</th>
                                <th>{{trans('admin_string.user')}}</th>
                                <th>{{trans('admin_string.role')}}</th>
                                <th>{{trans('admin_string.vehicle_name')}}</th>
                                <th>{{trans('admin_string.payment_proof')}}</th>
                                <th>{{trans('admin_string.status')}}</th>
                                <th>{{trans('admin_string.action')}}</th>
                            </tr>
                            </thead>
                            <tbody class="fw-bold text-gray-600"></tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('custom-script')
    <script>
        const cancel_button_text = '{{trans('admin_string.cancel')}}';
        const delete_button_text = '{{trans('admin_string.delete')}}';
        const sweetalert_change_status = '{{trans('admin_string.bid_status_change')}}';
        const sweetalert_change_status_text = '{{trans('admin_string.are_you_sure_status_change_this_record')}}';
        const yes_change_it = '{{trans('admin_string.yes')}}';
        const datatable_url = '/get-payment-proof'
        const form_url = '/payment-proof'

        $.extend(true, $.fn.dataTable.defaults, {
            columns: [
                {data: 'id', name: 'vehicles.id'},
                {data: 'user_name', name: 'users.name'},
                {data: 'user_type', name: 'users.user_type'},
                {data: 'vehicle_name', name: 'vehicle_translations.name'},
                {data: 'payment_proof', name: 'payment_proof'},
                {data: 'status', name: 'payment_proofs.status'},
                {data: 'action', name: 'action', orderable: false, searchable: false},
            ],
            order: [[0, 'DESC']],
        })
    </script>

    <script src="{{URL::asset('assets/admin/custom/datatable.js')}}?v={{ time() }}"></script>
@endsection
