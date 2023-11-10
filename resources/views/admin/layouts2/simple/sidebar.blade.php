<div id="kt_aside" class="aside aside-dark aside-hoverable" data-kt-drawer="true" data-kt-drawer-name="aside"
     data-kt-drawer-activate="{default: true, lg: false}" data-kt-drawer-overlay="true"
     data-kt-drawer-width="{default:'200px', '300px': '250px'}" data-kt-drawer-direction="start"
     data-kt-drawer-toggle="#kt_aside_mobile_toggle">
    <div class="aside-logo flex-column-auto" id="kt_aside_logo">

        <h3 class="mt-3 text-black mx-auto">
            @if(!empty($logo))
                <img alt="Logo"
                     src="{{asset($logo)}}"
                     class="h-40px logo"
                     style="background-color: white;"/>
            @else
                <img alt="Logo"
                     src="{{ asset('assets/media/logos/logo-1.png') }}"
                     class="h-40px logo"
                     style="background-color: white;"/>
            @endif
        </h3>

        <div id="kt_aside_toggle"
             class="btn btn-icon w-auto px-0 btn-active-color-primary aside-toggle btn-color-primary"
             data-kt-toggle="true"
             data-kt-toggle-state="active"
             data-kt-toggle-target="body"
             data-kt-toggle-name="aside-minimize">
            <span class="svg-icon svg-icon-1 rotate-180">
                   <span data-feather="chevrons-left"></span>
                </span>
        </div>

    </div>

    <div class="aside-menu flex-column-fluid">

        <div class="hover-scroll-overlay-y my-5 my-lg-5" id="kt_aside_menu_wrapper" data-kt-scroll="true"
             data-kt-scroll-activate="{default: false, lg: true}" data-kt-scroll-height="auto"
             data-kt-scroll-dependencies="#kt_aside_logo, #kt_aside_footer"
             data-kt-scroll-wrappers="#kt_aside_menu" data-kt-scroll-offset="0">

            <div class="menu menu-column
            menu-title-gray-800 menu-state-title-primary
            menu-state-icon-primary menu-state-bullet-primary
            menu-arrow-gray-500" id="#kt_aside_menu" data-kt-menu="true">

                <div class="menu-item">
                    <div class="menu-content pt-8 pb-2">
                        <span class="menu-section text-muted text-uppercase fs-8 ls-1">
                           Dashboard
                        </span>
                    </div>
                </div>

                <div class="menu-item">
                    <a class="menu-link {{ (request()->segment(2) == 'dashboard') ? 'active' : '' }}"
                       href="{{ route('admin.dashboard') }}">
                        <span class="menu-icon">
                            <span class="svg-icon svg-icon-2">
                                <span data-feather="grid"></span>
                             </span>
                        </span>
                        <span class="menu-title">Dashboard</span>
                    </a>
                </div>

                <div class="menu-item">
                    <div class="menu-content pt-8 pb-2">
                        <span class="menu-section text-muted text-uppercase fs-8 ls-1">
                            Setting Management
                        </span>
                    </div>
                </div>
                <div data-kt-menu-trigger="click"
                     class="menu-item menu-accordion  {{ (request()->segment(2) == 'setting' || (request()->segment(2) == 'page')) ? 'show' : '' }} ">
                <span class="menu-link">
                    <span class="menu-icon">
						<span class="menu-icon">
                            <span class="svg-icon svg-icon-2">
                                <span data-feather="settings"></span>
                             </span>
                        </span>
					</span>
                    <span class="menu-title">Setting</span>
                    <span class="menu-arrow"></span>
                </span>
                    <div class="menu-sub menu-sub-accordion menu-active-bg">
                        <div class="menu-item">
                            <a class="menu-link {{ (request()->segment(2) == 'setting') ? 'active' : '' }}"
                               href="{{ route('admin.setting.index') }}">
                                <span class="menu-bullet">
                                    <span class="bullet bullet-dot"></span>
                                </span>
                                <span class="menu-title">Setting</span>
                            </a>
                        </div>
                    </div>
{{--                    @if(Auth::user()->can('page-read') )--}}
                        <div class="menu-sub menu-sub-accordion menu-active-bg">
                            <div class="menu-item">
                                <a class="menu-link {{ (request()->segment(2) == 'page') ? 'active' : '' }}"
                                   href="{{ route('admin.page.index') }}">
                                <span class="menu-bullet">
                                    <span class="bullet bullet-dot"></span>
                                </span>
                                    <span class="menu-title">Page</span>
                                </a>
                            </div>
                        </div>
{{--                    @endif--}}

                    {{--                    <div class="menu-sub menu-sub-accordion menu-active-bg">--}}
                    {{--                        <div class="menu-item">--}}
                    {{--                            <a class="menu-link {{ (request()->segment(2) == 'faq') ? 'active' : '' }}"--}}
                    {{--                               href="{{ route('admin.faq.index') }}">--}}
                    {{--                                <span class="menu-bullet">--}}
                    {{--                                    <span class="bullet bullet-dot"></span>--}}
                    {{--                                </span>--}}
                    {{--                                <span class="menu-title">Faq</span>--}}
                    {{--                            </a>--}}
                    {{--                        </div>--}}
                    {{--                    </div>--}}

                    <div class="menu-sub menu-sub-accordion menu-active-bg">
                        <div class="menu-item">
                            <a class="menu-link {{ (request()->segment(2) == 'news') ? 'active' : '' }}"
                               href="{{ route('admin.news.index') }}">
                                <span class="menu-bullet">
                                    <span class="bullet bullet-dot"></span>
                                </span>
                                <span class="menu-title"> News</span>
                            </a>
                        </div>
                    </div>

                    <div class="menu-sub menu-sub-accordion menu-active-bg">
                        <div class="menu-item">
                            <a class="menu-link {{ (request()->segment(2) == 'testimonial') ? 'active' : '' }}"
                               href="{{ route('admin.testimonial.index') }}">
                                <span class="menu-bullet">
                                    <span class="bullet bullet-dot"></span>
                                </span>
                                <span class="menu-title"> Testimonial</span>
                            </a>
                        </div>
                    </div>

                    {{--                    <div class="menu-sub menu-sub-accordion menu-active-bg">--}}
                    {{--                        <div class="menu-item">--}}
                    {{--                            <a class="menu-link {{ (request()->segment(2) == 'banner') ? 'active' : '' }}"--}}
                    {{--                               href="{{ route('admin.banner.index') }}">--}}
                    {{--                                <span class="menu-bullet">--}}
                    {{--                                    <span class="bullet bullet-dot"></span>--}}
                    {{--                                </span>--}}
                    {{--                                <span class="menu-title">Banner</span>--}}
                    {{--                            </a>--}}
                    {{--                        </div>--}}
                    {{--                    </div>--}}
                </div>

                <div class="menu-item">
                    <a class="menu-link {{ (request()->segment(2) == 'customer') ? 'active' : '' }}"
                       href="{{ route('admin.customer.index') }}">
                               <span class="menu-icon">
                            <span class="svg-icon svg-icon-2">
                                <span data-feather="user"></span>
                             </span>
                        </span>
                        <span class="menu-title"> Customer</span>
                    </a>
                </div>
{{--                <div data-kt-menu-trigger="click"--}}
{{--                     class="menu-item menu-accordion  {{ (request()->segment(2) == 'role' || (request()->segment(2) == 'customer')) ? 'show' : '' }} ">--}}
{{--                <span class="menu-link">--}}
{{--                    <span class="menu-icon">--}}
{{--						<span class="menu-icon">--}}
{{--                            <span class="svg-icon svg-icon-2">--}}
{{--                                <span data-feather="settings"></span>--}}
{{--                             </span>--}}
{{--                        </span>--}}
{{--					</span>--}}
{{--                    <span class="menu-title">Administrator</span>--}}
{{--                    <span class="menu-arrow"></span>--}}
{{--                </span>--}}
{{--                    <div class="menu-sub menu-sub-accordion menu-active-bg">--}}
{{--                        <div class="menu-item">--}}
{{--                            <a class="menu-link {{ (request()->segment(2) == 'role') ? 'active' : '' }}"--}}
{{--                               href="{{ route('admin.role.index') }}">--}}
{{--                                <span class="menu-bullet">--}}
{{--                                    <span class="bullet bullet-dot"></span>--}}
{{--                                </span>--}}
{{--                                <span class="menu-title">Role</span>--}}
{{--                            </a>--}}
{{--                        </div>--}}
{{--                    </div>--}}

{{--                    <div class="menu-sub menu-sub-accordion menu-active-bg">--}}
{{--                        <div class="menu-item">--}}
{{--                            <a class="menu-link {{ (request()->segment(2) == 'permission') ? 'active' : '' }}"--}}
{{--                               href="{{ route('admin.permission.create') }}">--}}
{{--                                                    <span class="menu-bullet">--}}
{{--                                                        <span class="bullet bullet-dot"></span>--}}
{{--                                                    </span>--}}
{{--                                <span class="menu-title">Permission</span>--}}
{{--                            </a>--}}
{{--                        </div>--}}
{{--                    </div>--}}

{{--                </div>--}}

                <div class="menu-item">
                    <a class="menu-link {{ (request()->segment(2) == 'contact-us') ? 'active' : '' }}"
                       href="{{ route('admin.contact-us.index') }}">
                        <span class="menu-icon">
                            <span class="svg-icon svg-icon-2">
                                <span data-feather="command"></span>
                             </span>
                        </span>
                        <span class="menu-title">Contact Us</span>
                    </a>
                </div>

                <div class="menu-item">
                    <a class="menu-link {{ (request()->segment(2) == 'question') ? 'active' : '' }}"
                       href="{{ route('admin.question.index') }}">
                        <span class="menu-icon">
                            <span class="svg-icon svg-icon-2">
                                <span data-feather="help-circle"></span>
                             </span>
                        </span>
                        <span class="menu-title">Question</span>
                    </a>
                </div>

                <div class="menu-item">
                    <a class="menu-link {{ (request()->segment(2) == 'category') ? 'active' : '' }}"
                       href="{{ route('admin.category.index') }}">
                        <span class="menu-icon">
                            <span class="svg-icon svg-icon-2">
                                <span data-feather="box"></span>
                             </span>
                        </span>
                        <span class="menu-title">Category</span>
                    </a>
                </div>

                <div class="menu-item">
                    <a class="menu-link {{ (request()->segment(2) == 'vehicle') ? 'active' : '' }}"
                       href="{{ route('admin.vehicle.index') }}">
                        <span class="menu-icon">
                            <span class="svg-icon svg-icon-2">
                                <span data-feather="shopping-bag"></span>
                             </span>
                        </span>
                        <span class="menu-title">Vehicle</span>
                    </a>
                </div>

                <div class="menu-item">
                    <a class="menu-link {{ (request()->segment(2) == 'language-string') ? 'active' : '' }}"
                       href="{{ route('admin.language-string.index') }}">
                        <span class="menu-icon">
                            <span class="svg-icon svg-icon-2">
                               <span data-feather="globe"></span>
                            </span>
                        </span>
                        <span class="menu-title">Language String</span>
                    </a>
                </div>

            </div>
        </div>
    </div>

    <div class="aside-footer flex-column-auto pt-5 pb-7 px-5" id="kt_aside_footer">
        <a href="#"
           target="_blank"
           class="btn btn-custom btn-primary w-100">
            <span class="btn-label text-white">Visit Website</span>
        </a>
    </div>

</div>
