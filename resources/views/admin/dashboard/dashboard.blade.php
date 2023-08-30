@extends('admin.layouts2.simple.master')
@section('content')
    <div class="content d-flex flex-column flex-column-fluid" id="kt_content">
        <div class="toolbar" id="kt_toolbar">
            <div id="kt_toolbar_container" class="container-fluid d-flex flex-stack">
                <div data-kt-swapper="true" data-kt-swapper-mode="prepend"
                     data-kt-swapper-parent="{default: '#kt_content_container', 'lg': '#kt_toolbar_container'}"
                     class="page-title d-flex align-items-center flex-wrap me-3 mb-5 mb-lg-0">
                    <h1 class="d-flex align-items-center text-dark fw-bolder fs-3 my-1">Dashboard</h1>
                </div>
                <div class="d-flex align-items-center gap-2 gap-lg-3">
                </div>
            </div>
        </div>

        <div class="post d-flex flex-column-fluid" id="kt_post">
            <div id="kt_content_container" class="container-fluid">
                <div class="row g-5 g-xl-8">
                    <div class="col-xl-3">
                        <a href="{{ route('admin.customer.index')}}"
                           class="card bg-warning  hoverable card-xl-stretch mb-xl-8">
                            <div class="card-body">
                                <div class="text-white fw-bolder fs-2 mb-2 mt-5">{{$seller_count}}</div>
                                <div
                                    class="text-white fw-bolder fs-2 mb-2 mt-5">Sellers
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="col-xl-3">
                        <a href="{{ route('admin.customer.index')}}"
                           class="card bg-info  hoverable card-xl-stretch mb-xl-8">
                            <div class="card-body">
                                <div class="text-white fw-bolder fs-2 mb-2 mt-5">{{$buyer_count}}</div>
                                <div
                                    class="text-white fw-bolder fs-2 mb-2 mt-5">Buyers
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="col-xl-3">
                        <a href="{{ route('admin.customer.index')}}"
                           class="card bg-success  hoverable card-xl-stretch mb-xl-8">
                            <div class="card-body">
                                <div class="text-white fw-bolder fs-2 mb-2 mt-5">{{$user_count}}</div>
                                <div
                                    class="text-white fw-bolder fs-2 mb-2 mt-5">Users
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="col-xl-3">
                        <a href="{{ route('admin.category.index')}}"
                           class="card bg-primary  hoverable card-xl-stretch mb-xl-8">
                            <div class="card-body">
                                <div class="text-white fw-bolder fs-2 mb-2 mt-5">{{$category_count}}</div>
                                <div
                                    class="text-white fw-bolder fs-2 mb-2 mt-5">Categories
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="col-xl-3">
                        <a href="{{ route('admin.vehicle.index')}}"
                           class="card bg-dark  hoverable card-xl-stretch mb-xl-8">
                            <div class="card-body">
                                <div class="text-white fw-bolder fs-2 mb-2 mt-5">{{$vehicle_count}}</div>
                                <div
                                    class="text-white fw-bolder fs-2 mb-2 mt-5">Vehicles
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
        </div>
@endsection
@section('custom-script')
@endsection
