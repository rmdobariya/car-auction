@extends('admin.layouts2.simple.master')
@section('content')
    <div class="content d-flex flex-column flex-column-fluid" id="kt_content">
        <div class="toolbar" id="kt_toolbar">
            <div id="kt_toolbar_container" class="container-fluid d-flex flex-stack">
                @include('admin.layouts2.components.bread-crumbs',['main_name'=>trans('admin_string.banners')])
                @if(Auth::user()->can('banner-create'))
                    @include('admin.layouts2.components.create-button',['url'=>route('admin.banner.create')])
                @endif
            </div>
        </div>
        <div class="post d-flex flex-column-fluid" id="kt_post">
            <div id="kt_content_container" class="container-fluid">
                <div class="card">
                    <div class="card-header border-0 pt-6">
                        @include('admin.layouts2.components.search-text-box',['search_place_holder'=>trans('admin_string.search_banner')])
                        <div class="card-toolbar">
                            <div class="d-flex justify-content-end" data-kt-customer-table-toolbar="base">
                                @include('admin.layouts2.components.filter-button')
                                <div class="menu menu-sub menu-sub-dropdown w-300px w-md-325px" data-kt-menu="true"
                                     id="kt-toolbar-filter">
                                    <div class="px-7 py-5">
                                        <div class="fs-4 text-dark fw-bold">{{trans('admin_string.filter_options')}}</div>
                                    </div>
                                    <div class="separator border-gray-200"></div>
                                    <div class="px-7 py-5">
                                        <div class="mb-10">
                                            <label class="form-label fs-5 fw-semibold mb-3">{{trans('admin_string.filter')}}</label>
                                            <div class="d-flex flex-column flex-wrap fw-semibold"
                                                 data-kt-customer-table-filter="payment_type">
                                                <label
                                                    class="form-check form-check-sm form-check-custom form-check-solid mb-3 me-5">
                                                    <input class="form-check-input" type="checkbox" name="deleted_at"
                                                           id="deleted_at">
                                                    <span class="form-check-label text-gray-600">{{trans('admin_string.deleted_record')}} </span>
                                                </label>
                                            </div>
                                        </div>

                                        <div class="d-flex justify-content-end">
                                            <button type="reset" class="btn btn-light btn-active-light-primary me-2"
                                                    data-kt-menu-dismiss="true" data-kt-customer-table-filter="reset"
                                                    id="reset-filter">
                                                {{trans('admin_string.reset')}}
                                            </button>
                                            <button type="submit" class="btn btn-primary" id="filter"
                                                    data-kt-menu-dismiss="true"
                                                    data-kt-customer-table-filter="filter">{{trans('admin_string.apply')}}
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @include('admin.layouts2.components.selected-delete-button')
                        @include('admin.layouts2.components.status-active-inactive')
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
                                <th>{{trans('admin_string.title')}}</th>
                                <th>{{trans('admin_string.image')}}</th>
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
        const sweetalert_delete_title = '{{trans('admin_string.banner_delete')}}';
        const sweetalert_delete_text = '{{trans('admin_string.are_you_sure_delete_this_banner')}}';
        const sweetalert_restore_title = '{{trans('admin_string.banner_restore')}}';
        const sweetalert_restore_text = '{{trans('admin_string.are_you_sure_restore_this_banner')}}';
        const cancel_button_text = '{{trans('admin_string.common_cancel')}}';
        const delete_button_text = '{{trans('admin_string.common_delete')}}';
        const sweetalert_change_status = '{{trans('admin_string.banner_status_change')}}';
        const sweetalert_change_status_text = '{{trans('admin_string.are_you_sure_status_change_this_record')}}';
        const yes_change_it = '{{trans('admin_string.yes')}}';
        const form_url = '/banner'
        const datatable_url = '/get-banner-list'
        const restore_url = '/restore-banner'
        const hard_delete_url = '/hard-delete-banner'
        var arr = [];
        const multiple_select_title = '{{trans('admin_string.selected_banner_delete')}}';
        const multiple_select_text = '{{trans('admin_string.are_you_sure_selected_record_delete')}}';
        const multiple_delete_url = '/multiple-banner-delete'

        $.extend(true, $.fn.dataTable.defaults, {
            columns: [
                {data: 'check', name: 'check', orderable: false, searchable: false},
                {data: 'id', name: 'banners.id'},
                {data: 'title', name: 'banners.title'},
                {data: 'image', name: 'image'},
                {data: 'status', name: 'banners.status'},
                {data: 'action', name: 'action', orderable: false, searchable: false},
            ],
            order: [[0, 'DESC']],
        })
    </script>
    <script src="{{URL::asset('assets/admin/custom/datatable.js')}}?v={{ time() }}"></script>
@endsection
