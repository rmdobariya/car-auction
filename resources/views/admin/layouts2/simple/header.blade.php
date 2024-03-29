<div id="kt_header" style="" class="header align-items-stretch">
    <div class="container-fluid d-flex align-items-stretch justify-content-between">
        <div class="d-flex align-items-center d-lg-none ms-n2 me-2" title="Show aside menu">
            <div class="btn btn-icon btn-active-light-primary w-30px h-30px w-md-40px h-md-40px"
                 id="kt_aside_mobile_toggle">
                <span class="svg-icon svg-icon-1">
                    <span data-feather="align-justify"></span>
                </span>
            </div>
        </div>
        <button type="button" style="display: none" id="trigger_click"></button>

        <div class="d-flex align-items-stretch justify-content-between flex-lg-grow-1">
            <div class="d-flex align-items-stretch" id="kt_header_nav"></div>
            <div class="d-flex align-items-stretch flex-shrink-0">
                <!-- Notification Bell Icon with Count -->
                <div class="d-flex align-items-center ms-1 ms-lg-3" id="kt_header_user_menu_toggle">
                    <a href="{{route('admin.notification')}}">
                    <span class="menu-icon position-relative">
                        <span class="svg-icon svg-icon-2">
                            <span data-feather="bell"></span>
                        </span>
                        @php
                            $notification_count = DB::table('notifications')->where('is_read',0)->count();
                        @endphp
                        <span class="badge bg-danger rounded-circle position-absolute top-0 start-100 translate-middle">
                            {{$notification_count}}
                        </span>
                    </span>
                    </a>
                </div>
            </div>
            <div class="d-flex align-items-stretch flex-shrink-0">
                <div class="d-flex align-items-center ms-1 ms-lg-3" id="kt_header_user_menu_toggle">
                    <div class="cursor-pointer symbol symbol-30px symbol-md-40px"
                         data-kt-menu-trigger="click" data-kt-menu-attach="parent"
                         data-kt-menu-placement="bottom-end">
                        @if(Auth::guard('admin')->user()->image != '')
                            <img src="{{ asset(Auth::guard('admin')->user()->image) }}" alt="user"/>
                        @else
                            <img src="{{ asset('assets/default/sample.jpg')}}" alt="user"/>
                        @endif
                    </div>
                    <div
                        class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-800 menu-state-bg menu-state-primary fw-bold py-4 fs-6 w-275px"
                        data-kt-menu="true">
                        <div class="menu-item px-3">
                            <div class="menu-content d-flex align-items-center px-3">
                                <div class="symbol symbol-50px me-5">
                                    @if(Auth::guard('admin')->user()->image != '')
                                        <img alt="Logo" src="{{ asset(Auth::guard('admin')->user()->image) }}"/>
                                    @else
                                        <img src="{{ asset('assets/default/sample.jpg')}}" alt="user"/>
                                    @endif
                                </div>
                                <div class="d-flex flex-column">
                                    <div class="fw-bolder d-flex align-items-center fs-5">
                                        {{ Auth::guard('admin')->user()->name }}
                                    </div>
                                    <a href="#"
                                       class="fw-bold text-muted text-hover-primary fs-7">{{ Auth::guard('admin')->user()->email }}</a>
                                </div>
                            </div>
                        </div>

                        <div class="menu-item px-5" data-kt-menu-trigger="hover"
                             data-kt-menu-placement="left-start">
                            <a href="#" class="menu-link px-5">
                                <span class="menu-title position-relative">{{ trans('admin_string.language') }}
                                    <span
                                        class="fs-8 rounded bg-light px-3 py-2 position-absolute translate-middle-y top-50 end-0">
                                        @if(Auth::guard('admin')->user()->locale=='en')
                                            English
                                            <img class="w-15px h-15px rounded-1 ms-2"
                                                 src="{{ asset('assets/media/flags/united-states.svg') }}"
                                                 alt=""/>
                                        @else
                                            عربى
                                            <img class="rounded-1"
                                                 src="{{ asset('assets/media/flags/united-arab-emirates.svg') }}"
                                                 alt=""/>
                                        @endif
                                    </span>
                                </span>
                            </a>
                            <div class="menu-sub menu-sub-dropdown w-175px py-4">
                                <div class="menu-item px-3">
                                    <a href="{{ route('admin.change-locale',['en']) }}"
                                       class="menu-link d-flex px-5 @if(Auth::guard('admin')->user()->locale=='en') active @endif">
                                        <span class="symbol symbol-20px me-4">
                                            <img class="rounded-1"
                                                 src="{{ asset('assets/media/flags/united-states.svg') }}"
                                                 alt=""/>
                                        </span>English
                                    </a>
                                </div>
                                <div class="menu-item px-3">
                                    <a href="{{ route('admin.change-locale',['ar']) }}"
                                       class="menu-link d-flex px-5 @if(Auth::guard('admin')->user()->locale=='ar') active @endif">
                                        <span class="symbol symbol-20px me-4">
                                            <img class="rounded-1"
                                                 src="{{ asset('assets/media/flags/united-arab-emirates.svg') }}" alt=""/>
                                        </span>عربى
                                    </a>
                                </div>
                            </div>
                        </div>

                        <div class="separator my-2"></div>

                        <div class="menu-item px-5">
                            <a href="{{ route('admin.my-profile') }}"
                               class="menu-link px-5">{{trans('admin_string.my_profile')}}</a>
                        </div>
                        <div class="menu-item px-5">
                            <a href="{{ route('admin.change-password') }}" class="menu-link px-5">
                                <span class="menu-text">{{trans('admin_string.change_password')}}</span>
                            </a>
                        </div>

                        <div class="separator my-2"></div>

                        <div class="menu-item px-5">
                            <a href="{{ route('admin.logout') }}"
                               class="menu-link px-5">{{trans('admin_string.logout')}}</a>
                        </div>
                        <div class="separator my-2"></div>
                        <div class="menu-item px-5">
                            <div class="menu-content px-5">
                                @if(Auth::guard('admin')->user()->panel_mode==1)
                                    <label
                                        class="form-check form-switch form-check-custom form-check-solid pulse pulse-success"
                                        for="kt_user_menu_dark_mode_toggle">
                                        <input class="form-check-input w-30px h-20px" type="checkbox" value="1"
                                               name="mode" id="kt_user_menu_dark_mode_toggle"
                                               data-kt-url="{{ route('admin.change-panel-mode',[2]) }}"/>
                                        <span class="pulse-ring ms-n1"></span>
                                        <span class="form-check-label text-gray-600 fs-7">Dark Mode</span>
                                    </label>
                                @else
                                    <label
                                        class="form-check form-switch form-check-custom form-check-solid pulse pulse-success"
                                        for="kt_user_menu_dark_mode_toggle">
                                        <input class="form-check-input w-30px h-20px" type="checkbox" value="1"
                                               name="mode" id="kt_user_menu_dark_mode_toggle" checked
                                               data-kt-url="{{ route('admin.change-panel-mode',[1]) }}"/>
                                        <span class="pulse-ring ms-n1"></span>
                                        <span class="form-check-label text-gray-600 fs-7">Dark Mode</span>
                                    </label>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
