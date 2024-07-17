@extends('admin.layouts2.simple.master')
@section('content')

    <div class="content d-flex flex-column flex-column-fluid" id="kt_content">
        <div class="toolbar" id="kt_toolbar">
            <div id="kt_toolbar_container" class="container-fluid d-flex flex-stack">
                @include('admin.layouts2.components.bread-crumbs',['main_name'=>trans('admin_string.add_role')])
            </div>
        </div>
        <div class="post d-flex flex-column-fluid" id="kt_post">
            <div id="kt_content_container" class="container-fluid">
                <div class="card">
                    <div class="card-body pt-0">
                        <form method="POST" data-parsley-validate="" id="addEditForm" role="form">
                            @csrf
                            <div class="card-body">
                                <input type="hidden" id="edit_value" value="0" name="edit_value">
                                <input type="hidden" id="form-method" value="add">
                                <div class="fv-row mb-7 fv-plugins-icon-container">
                                    <label class="required fs-6 fw-bold mb-2"
                                           for="name">{{trans('admin_string.name')}}
                                    </label>
                                    <input type="text" class="form-control form-control-solid" required
                                           name="name"
                                           id="name"
                                           placeholder="{{trans('admin_string.name')}}"/>
                                </div>
                                <div class="col-xl-12">
                                    <div class="card mg-b-20">
                                        <div class="card-header pb-0">
                                            <div class="d-flex justify-content-between"><h4 class="card-title mg-b-0">
                                                    {{trans('admin_string.permission')}}</h4>
                                            </div>
                                        </div>
                                        <div class="card-body">
                                            <div class="table-responsive">
                                                <table class="table align-middle table-row-dashed fs-6 gy-5">

                                                    @foreach($permissions as $permission)
                                                        <tr>
                                                            <th scope="row"
                                                                class="fs-6 fw-bold mb-2">
                                                                @if(App::getLocale() == 'ar')
                                                                    {{$permission->ar_module_name}}
                                                                @else
                                                                    {{$permission->module_name}}
                                                                @endif
                                                            </th>
                                                                <?php
                                                                $pers = \Spatie\Permission\Models\Permission::where('module_name', $permission->module_name)->get();
                                                                ?>
                                                            @foreach($pers as $per)
                                                                <td>
                                                                    <div
                                                                            class="form-check form-check-inline checkbox checkbox-dark mb-0">
                                                                        <label
                                                                                class="form-check form-check-sm form-check-custom form-check-solid me-5 me-lg-20">
                                                                            <input class="form-check-input"
                                                                                   type="checkbox"
                                                                                   id={{$per->id}} value="{{$per->id}}"
                                                                                   name="permission[]"/>
                                                                            <span
                                                                                    class="form-check-label">
                                                                                @if(App::getLocale() == 'ar')
                                                                                    {{$per->ar_name}}
                                                                                @else
                                                                                    {{$per->name}}
                                                                                @endif
                                                                            </span>
                                                                        </label>
                                                                    </div>
                                                                </td>
                                                            @endforeach
                                                        </tr>
                                                    @endforeach
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="card-footer text-end p-3 btn-showcase">
                                <button class="btn btn-primary" type="submit">
                                    {{trans('admin_string.common_submit')}}
                                </button>
                                <a href="{{ route('admin.role.index') }}">
                                    <button class="btn btn-secondary " type="button">
                                        {{trans('admin_string.common_cancel')}}
                                    </button>
                                </a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('custom-script')
    <script>
        var form_url = '/role'
        var redirect_url = '/role'
    </script>
    <script src="{{URL::asset('assets/admin/custom/form.js')}}?v={{ time() }}"></script>
    <script src="{{URL::asset('assets/admin/custom/role/role.js')}}?v={{ time() }}"></script>
@endsection
