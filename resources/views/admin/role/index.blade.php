@extends('admin.layouts2.simple.master')
@section('content')
    <div class="content d-flex flex-column flex-column-fluid" id="kt_content">
        <div class="toolbar" id="kt_toolbar">
            <div id="kt_toolbar_container" class="container-fluid d-flex flex-stack">
                @include('admin.layouts2.components.bread-crumbs',['main_name'=>trans('admin_string.roles')])
                @if(Auth::user()->can('role-create'))
                @include('admin.layouts2.components.create-button',['url'=>route('admin.role.create')])
                @endif
            </div>
        </div>
        <div class="post d-flex flex-column-fluid" id="kt_post">
            <div id="kt_content_container" class="container-fluid">
                <div class="card">
                    <div class="card-header border-0 pt-6">
                        @include('admin.layouts2.components.search-text-box',['search_place_holder'=> trans('admin_string.search_role')])
                    </div>

                    <div class="card-body pt-0">
                        <table class="table align-middle table-row-dashed fs-6 gy-5" id="basic-1">
                            <thead>
                            <tr class="text-start text-dark-400 fw-bolder fs-7 text-uppercase gs-0">
                                <th>{{trans('admin_string.id')}}</th>
                                <th>{{trans('admin_string.name')}}</th>
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
        const sweetalert_delete_title = '{{trans('admin_string.role_delete')}}';
        const sweetalert_delete_text = '{{trans('admin_string.are_you_sure_delete_this_record')}}';
        const cancel_button_text = '{{trans('admin_string.cancel')}}';
        const delete_button_text = '{{trans('admin_string.delete')}}';
        const sweetalert_change_status = '{{trans('admin_string.role_status_change')}}';
        const sweetalert_change_status_text = '{{trans('admin_string.are_you_sure_status_change_this_record')}}';
        const yes_change_it = '{{trans('admin_string.yes')}}';
        const form_url = '/role'
        const datatable_url = '/get-role-list'

        $.extend(true, $.fn.dataTable.defaults, {
            columns: [
                { data: 'id', name: 'id' },
                { data: 'name', name: 'name' },
                { data: 'action', name: 'action', orderable: false, searchable: false },
            ],
            order: [[0, 'DESC']],
        })
    </script>
    <script src="{{URL::asset('assets/admin/custom/datatable.js')}}?v={{ time() }}"></script>
@endsection
