@extends('admin.layouts2.simple.master')
@section('content')
    <div class="content d-flex flex-column flex-column-fluid" id="kt_content">
        <div class="toolbar" id="kt_toolbar">
            <div id="kt_toolbar_container" class="container-fluid d-flex flex-stack">
                @include('admin.layouts2.components.bread-crumbs',['main_name'=>trans('admin_string.vehicle_bids')])
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
                                <th>{{trans('admin_string.name')}}</th>
                                <th>{{trans('admin_string.amount')}}</th>
                                <th>{{trans('admin_string.is_winner')}}</th>
                                <th>{{trans('admin_string.vehicle_status')}}</th>
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
        const datatable_url = '/get-bid-list'
        const form_url = '/bid'

        $.extend(true, $.fn.dataTable.defaults, {
            columns: [
                {data: 'id', name: 'vehicles.id'},
                {data: 'user_name', name: 'users.name'},
                {data: 'user_type', name: 'users.user_type'},
                {data: 'vehicle_name', name: 'vehicle_translations.name'},
                {data: 'amount', name: 'vehicle_bids.amount'},
                {data: 'is_winner', name: 'is_winner'},
                {data: 'status', name: 'vehicles.status'},
                {data: 'action', name: 'action', orderable: false, searchable: false},
            ],
            order: [[0, 'DESC']],
        })
    </script>
    <script>
        $(document).on('click', '.payment-status-change', function () {
            const value_id = $(this).data('id')
            const status = $(this).data('status')
            console.log(11)
            Swal.fire({
                title: sweetalert_change_status,
                text: sweetalert_change_status_text,
                icon: 'warning',
                showCancelButton: !0,
                buttonsStyling: !1,
                confirmButtonText: yes_change_it,
                cancelButtonText: cancel_button_text,
                customClass: {
                    confirmButton: 'btn fw-bold btn-primary',
                    cancelButton: 'btn fw-bold btn-active-light-primary'
                },
            }).then((function (t) {
                if (t.isConfirmed) {
                    changeStatus(value_id, status)
                }
            }))
        })

        function changeStatus(value_id, status) {
            loaderView()
            axios
                .get(APP_URL + form_url + '/status' + '/' + value_id + '/' + status)
                .then(function (response) {
                    table.draw()
                    notificationToast(response.data.message, 'success')
                    loaderHide()
                })
                .catch(function (error) {
                    notificationToast(error.response.data.message, 'warning')
                    loaderHide()
                })
        }
    </script>
    <script src="{{URL::asset('assets/admin/custom/datatable.js')}}?v={{ time() }}"></script>
@endsection
