@extends('admin.layouts2.simple.master')
@section('content')
    <div class="content d-flex flex-column flex-column-fluid" id="kt_content">
        <div class="toolbar" id="kt_toolbar">
            <div id="kt_toolbar_container" class="container-fluid d-flex flex-stack">
                @include('admin.layouts2.components.bread-crumbs',['main_name'=>'Pages'])
                @include('admin.layouts2.components.create-button',['url'=>route('admin.page.create')])
            </div>
        </div>
        <div class="post d-flex flex-column-fluid" id="kt_post">
            <div id="kt_content_container" class="container-fluid">
                <div class="card">
                    <div class="card-header border-0 pt-6">
                        @include('admin.layouts2.components.search-text-box',['search_place_holder'=>'Search Page'])
                        @include('admin.layouts2.components.status-active-inactive')
                    </div>
                    <div class="card-body pt-0">
                        <table class="table align-middle table-row-dashed fs-6 gy-5" id="basic-1">
                            <thead>
                            <tr class="text-start text-dark-400 fw-bolder fs-7 text-uppercase gs-0">
                                <th>Id</th>
                                <th>Name</th>
                                <th>Status</th>
                                <th>Action</th>
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
        const sweetalert_delete_title = "Page Delete?"
        const sweetalert_delete_text = "Are You Sure Delete This Page"
        const cancel_button_text = "Cancel"
        const delete_button_text = "Delete"
        const sweetalert_change_status = "Page Status Change"
        const sweetalert_change_status_text = "Are You Sure Status Change This Record"
        const yes_change_it = "Yes"
        const form_url = '/page'
        const datatable_url = '/get-page-list'

        $.extend(true, $.fn.dataTable.defaults, {
            columns: [
                {data: 'id', name: 'pages.id'},
                {data: 'name', name: 'pages.name'},
                {data: 'status', name: 'pages.status'},
                {data: 'action', name: 'action', orderable: false, searchable: false},
            ],
            order: [[0, 'DESC']],
        })
    </script>
    <script src="{{URL::asset('assets/admin/custom/datatable.js')}}?v={{ time() }}"></script>
@endsection
