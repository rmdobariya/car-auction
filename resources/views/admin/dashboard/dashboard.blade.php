@extends('admin.layouts2.simple.master')
@section('content')
    <div class="content d-flex flex-column flex-column-fluid" id="kt_content">
        <div class="toolbar" id="kt_toolbar">
            <div id="kt_toolbar_container" class="container-fluid d-flex flex-stack">
                <div data-kt-swapper="true" data-kt-swapper-mode="prepend"
                     data-kt-swapper-parent="{default: '#kt_content_container', 'lg': '#kt_toolbar_container'}"
                     class="page-title d-flex align-items-center flex-wrap me-3 mb-5 mb-lg-0">
                    <h1 class="d-flex align-items-center text-dark fw-bolder fs-3 my-1">Dashboard2</h1>
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
                           class="card bg-warning card-dash hoverable card-xl-stretch mb-xl-8">
                            <div class="card-body">
                                <div class="text-white fw-bolder fs-1">{{$seller_count}}</div>
                                <div
                                    class="text-white fw-bolder fs-3">Sellers
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="col-xl-3">
                        <a href="{{ route('admin.customer.index')}}"
                           class="card bg-info card-dash hoverable card-xl-stretch mb-xl-8">
                            <div class="card-body">
                                <div class="text-white fw-bolder fs-1">{{$buyer_count}}</div>
                                <div
                                    class="text-white fw-bolder fs-3">Buyers
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="col-xl-3">
                        <a href="{{ route('admin.customer.index')}}"
                           class="card bg-success card-dash hoverable card-xl-stretch mb-xl-8">
                            <div class="card-body">
                                <div class="text-white fw-bolder fs-1">{{$user_count}}</div>
                                <div
                                    class="text-white fw-bolder fs-3">Users
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="col-xl-3">
                        <a href="{{ route('admin.category.index')}}"
                           class="card bg-primary card-dash hoverable card-xl-stretch mb-xl-8">
                            <div class="card-body">
                                <div class="text-white fw-bolder fs-1">{{$category_count}}</div>
                                <div
                                    class="text-white fw-bolder fs-3">Categories
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="col-xl-3">
                        <a href="{{ route('admin.vehicle.index')}}"
                           class="card bg-dark card-dash hoverable card-xl-stretch mb-xl-8">
                            <div class="card-body">
                                <div class="text-white fw-bolder fs-1">{{$vehicle_count}}</div>
                                <div
                                    class="text-white fw-bolder fs-3">Vehicles
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
