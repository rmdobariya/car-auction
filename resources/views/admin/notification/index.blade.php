@extends('admin.layouts2.simple.master')
@section('content')
    <div class="content d-flex flex-column flex-column-fluid" id="kt_content">
        <div class="toolbar" id="kt_toolbar">
            <div id="kt_toolbar_container" class="container-fluid d-flex flex-stack">
                @include('admin.layouts2.components.bread-crumbs',['main_name'=>trans('admin_string.notifications')])
            </div>
        </div>
        <div class="post d-flex flex-column-fluid" id="kt_post">
            <div id="kt_content_container" class="container-fluid">
                <div class="card">
                    <div class="card-header border-0 pt-6">
                        @include('admin.layouts2.components.search-text-box',['search_place_holder'=>trans('admin_string.search_notification')])
                        {{--                        <div class="card-toolbar">--}}
                        {{--                            <div class="d-flex justify-content-end" data-kt-customer-table-toolbar="base">--}}
                        {{--                                <button type="button" class="btn btn-light-primary me-3" data-kt-menu-trigger="click"--}}
                        {{--                                        data-kt-menu-placement="bottom-end">--}}
                        {{--                                    <i class="ki-duotone ki-filter fs-2"><span class="path1"></span><span--}}
                        {{--                                            class="path2"></span></i> {{trans('admin_string.filter')}}--}}
                        {{--                                </button>--}}
                        {{--                                <div class="menu menu-sub menu-sub-dropdown w-300px w-md-325px" data-kt-menu="true"--}}
                        {{--                                     id="kt-toolbar-filter">--}}
                        {{--                                    <div class="px-7 py-5">--}}
                        {{--                                        <div class="fs-4 text-dark fw-bold">{{trans('admin_string.filter_options')}}</div>--}}
                        {{--                                    </div>--}}
                        {{--                                    <div class="separator border-gray-200"></div>--}}
                        {{--                                    <div class="px-7 py-5">--}}
                        {{--                                        <div class="mb-10">--}}
                        {{--                                            <label class="form-label fs-5 fw-semibold mb-3">{{trans('admin_string.filter')}}</label>--}}
                        {{--                                            <div class="d-flex flex-column flex-wrap fw-semibold"--}}
                        {{--                                                 data-kt-customer-table-filter="payment_type">--}}
                        {{--                                                <label--}}
                        {{--                                                    class="form-check form-check-sm form-check-custom form-check-solid mb-3 me-5">--}}
                        {{--                                                    <input class="form-check-input" type="checkbox" name="deleted_at"--}}
                        {{--                                                           id="deleted_at">--}}
                        {{--                                                    <span class="form-check-label text-gray-600">{{trans('admin_string.deleted_record')}} </span>--}}
                        {{--                                                </label>--}}
                        {{--                                            </div>--}}
                        {{--                                        </div>--}}

                        {{--                                        <div class="d-flex justify-content-end">--}}
                        {{--                                            <button type="reset" class="btn btn-light btn-active-light-primary me-2"--}}
                        {{--                                                    data-kt-menu-dismiss="true" data-kt-customer-table-filter="reset"--}}
                        {{--                                                    id="reset-filter">--}}
                        {{--                                                {{trans('admin_string.reset')}}--}}
                        {{--                                            </button>--}}
                        {{--                                            <button type="submit" class="btn btn-primary" id="filter"--}}
                        {{--                                                    data-kt-menu-dismiss="true"--}}
                        {{--                                                    data-kt-customer-table-filter="filter">{{trans('admin_string.apply')}}--}}
                        {{--                                            </button>--}}
                        {{--                                        </div>--}}
                        {{--                                    </div>--}}
                        {{--                                </div>--}}
                        {{--                            </div>--}}
                        {{--                        </div>--}}
                        @include('admin.layouts2.components.selected-delete-button')
                        {{--                        @include('admin.layouts2.components.status-active-inactive')--}}
                    </div>
                    <div class="card-body pt-0">
                        <table class="table align-middle table-row-dashed fs-6 gy-5" id="basic-1">
                            <thead>
                            <tr class="text-start text-dark-400 fw-bolder fs-7 text-uppercase gs-0">
                                <th class="w-10px pe-2 sorting_disabled" rowspan="1" colspan="1" aria-label=""
                                    style="width: 29.8906px;">
                                    <div class="form-check form-check-sm form-check-custom form-check-solid me-3">
                                        <input class="form-check-input" id="all_selected" type="checkbox" value="">
                                    </div>
                                </th>
                                <th>{{trans('admin_string.id')}}</th>
                                <th>{{trans('admin_string.notification_type')}}</th>
                                <th>{{trans('admin_string.user_name')}}</th>
                                <th>{{trans('admin_string.created_at')}}</th>
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
        const sweetalert_delete_title = '{{trans('admin_string.notification_delete')}}';
        const sweetalert_delete_text = '{{trans('admin_string.are_you_sure_delete_this_record')}}';
        const cancel_button_text = '{{trans('admin_string.cancel')}}';
        const delete_button_text = '{{trans('admin_string.delete')}}';
        const yes_change_it = '{{trans('admin_string.yes')}}';
        const datatable_url = '/get-notification-list'


        $.extend(true, $.fn.dataTable.defaults, {
            columns: [
                {data: 'check', name: 'check', orderable: false, searchable: false},
                {data: 'id', name: 'notifications.id'},
                {data: 'notification_type', name: 'notification_type'},
                {data: 'user_name', name: 'user_name'},
                {data: 'created_at', name: 'created_at'},
                {data: 'action', name: 'action', orderable: false, searchable: false},
            ],
            order: [[0, 'DESC']],
        })
    </script>

    <script src="{{URL::asset('assets/admin/custom/datatable.js')}}?v={{ time() }}"></script>

    <script>
        var checkedValues = [];
        $(document).on('click', 'table .form-check-input', function () {
            var checkedCount = $('tbody .form-check-input:checked').length;
            if ($(this).prop('checked')) {
                checkedValues.push(recordId);
                $('#select_delete_btn').removeClass('d-none');
                $('#selected_count').text(checkedCount)
                // console.log(checkedValues)
            } else {
                $('#select_delete_btn').addClass('d-none');
                $('#selected_count').text()
            }
        })

        $(document).on('click', '#multiple_record_delete', function () {
            console.log(checkedValues)
            Swal.fire({
                title: 'Selected Record Delete ?',
                text: 'Are You Sure Selected Record Delete',
                icon: 'warning',
                showCancelButton: !0,
                buttonsStyling: !1,
                confirmButtonText: delete_button_text,
                cancelButtonText: cancel_button_text,
                customClass: {
                    confirmButton: 'btn fw-bold btn-danger',
                    cancelButton: 'btn fw-bold btn-active-light-primary'
                }
            }).then((function (t) {
                if (t.isConfirmed) {
                    multipleDeleteRecord(checkedValues)
                }
            }))
        })

        function multipleDeleteRecord(checkedValues) {
            loaderView()
            axios
                .post(APP_URL + '/multiple-notification-delete', {
                    ids: checkedValues
                })
                .then(function (response) {
                    notificationToast(response.data.message, 'success')
                    loaderHide()
                })
                .catch(function (error) {
                    notificationToast(error.response.data.message, 'warning')
                    loaderHide()
                })

        }
    </script>
@endsection
