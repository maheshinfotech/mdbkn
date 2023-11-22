@php
    $routePrefix = request()->path();
    $parentRoute = isset($parentRoute) && $parentRoute ? config('app.admin_prefix') . $parentRoute : '';
    $userFirstCharacter = Auth::user() ? substr(Auth::user()->name, 0, 1) : '#';
    $role_id = Auth::user() ? Auth::user()->role_id : 1;
@endphp
<!doctype html>
<html lang="{{ config('app.locale') }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">

    <title>{{ config('app.app_name') }} | {{ $pageName ?? '' }}</title>

    <meta name="description"
        content="OneUI - Bootstrap 5 Admin Template &amp; UI Framework created by pixelcave and published on Themeforest">
    <meta name="author" content="pixelcave">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <meta name="robots" content="noindex, nofollow">

    <!-- Icons -->
    <link rel="shortcut icon" href="{{ asset('media/favicons/favicon.png') }}">
    <link rel="icon" sizes="192x192" type="image/png" href="{{ asset('media/favicons/favicon-192x192.png') }}">
    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('media/favicons/apple-touch-icon-180x180.png') }}">
    <link rel="stylesheet" href="{{ asset('js/plugins/datatables-bs5/css/dataTables.bootstrap5.min.css') }}">
    <link rel="stylesheet" href="{{ asset('js/plugins/datatables-buttons-bs5/css/buttons.bootstrap5.min.css') }}">
    <link rel="stylesheet" href="{{ asset('js/plugins/sweetalert2/sweetalert2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('js/plugins/select2/css/select2.min.css') }} ">
    <link rel="stylesheet" href="{{ asset('js/plugins/bootstrap-datepicker/css/bootstrap-datepicker3.min.css') }}">
    <link rel="stylesheet" href="{{ asset('js/plugins/dropzone/min/dropzone.min.css') }}">
    <link rel="stylesheet"
        href="{{ asset('js/plugins/datatables-responsive-bs5/css/responsive.bootstrap5.min.css') }}">
    <link rel="stylesheet" href="{{ asset('js/plugins/flatpickr/flatpickr.min.css') }}">
    <link rel="stylesheet" id="css-main" href="{{ asset('theme/css/oneui.min.css') }}">
    <link rel="stylesheet" href="{{ asset('js/plugins/ion-rangeslider/css/ion.rangeSlider.css') }}">
    <link rel="stylesheet" id="css-main" href="{{ asset('assets/css/custom.css?' . date('Ymdhis')) }}">

    {{-- Datatable --}}

    <style>
        .cursor-pointer {
            cursor: pointer !important;
        }
        @media screen and (max-width: 600px) {
        .dashHeading {
            font-size: medium;
        }
}
    </style>
    <!-- Modules -->

    {{-- @vite(['resources/sass/main.scss', 'resources/js/oneui/app.js']) --}}

    <!-- Alternatively, you can also include a specific color theme after the main stylesheet to alter the default color theme of the template -->
    {{-- @vite(['resources/sass/main.scss', 'resources/sass/oneui/themes/amethyst.scss', 'resources/js/oneui/app.js']) --}}
    <script src="{{ asset('js/lib/jquery.min.js') }}"></script>
    <script>
        const base = "{!! url(config('app.admin_prefix')) !!}";
    </script>
    {{-- datatables cdn start --}}
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.7.0.js"></script>
    <script src="https://cdn.datatables.net/1.13.5/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.5/js/dataTables.bootstrap5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.4.1/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.4.1/js/buttons.bootstrap5.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.4.1/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.4.1/js/buttons.print.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.4.1/js/buttons.colVis.min.js"></script>
    {{-- datatables cdn end --}}
    <script src="{{ asset('js/plugins/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('js/plugins/datatables-bs5/js/dataTables.bootstrap5.min.js') }}"></script>
    <script src="{{ asset('js/plugins/datatables-buttons/dataTables.buttons.min.js') }}"></script>
    <script src="{{ asset('js/plugins/datatables-buttons-bs5/js/buttons.bootstrap5.min.js') }}"></script>
    <script src="{{ asset('js/plugins/datatables-buttons-jszip/jszip.min.js') }}"></script>
    <script src="{{ asset('js/plugins/datatables-buttons-pdfmake/pdfmake.min.js') }}"></script>
    <script src="{{ asset('js/plugins/datatables-buttons-pdfmake/vfs_fonts.js') }}"></script>
    <script src="{{ asset('js/plugins/datatables-buttons/buttons.print.min.js') }}"></script>
    <script src="{{ asset('js/plugins/datatables-buttons/buttons.html5.min.js') }}"></script>
    <script src="{{ asset('js/plugins/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset('js/plugins/datatables-responsive-bs5/js/responsive.bootstrap5.min.js') }}"></script>
    <script src="{{ asset('js/plugins/sweetalert2/sweetalert2.min.js') }}"></script>
    <script src="{{ asset('js/plugins/jquery-validation/jquery.validate.min.js') }}"></script>
    <script src="{{ asset('js/plugins/jquery-validation/additional-methods.js') }}"></script>

    {{-- <script src="{{ asset('js/plugins/select2/js/select2.full.min.js') }}"></script> --}}
    <script src="{{ asset('js/plugins/bootstrap-notify/bootstrap-notify.min.js') }}"></script>
    <script src="{{ asset('js/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js') }}"></script>
    <script src="{{ asset('js/plugins/dropzone/min/dropzone.min.js') }}"></script>
    <script src="{{ asset('js/plugins/flatpickr/flatpickr.min.js') }}"></script>
    <script src="{{ asset('js/oneui.app.min.js') }}"></script>
    <script src="{{ asset('js/plugins/fullcalendar/index.global.min.js') }}"></script>
    <!-- <script src="{{ asset('theme/js/pages/be_comp_calendar.min.js') }}"></script> -->
    <script src="{{ asset('theme/js/pages/be_comp_calendar.js') }}"></script>
    <script src="{{ asset('js/plugins/ion-rangeslider/js/ion.rangeSlider.min.js') }}"></script>
    <script src="{{ asset('assets/js/custom.js?ver=' . time()) }}"></script>

    <script>
        One.helpersOnLoad(['js-flatpickr', 'jq-datepicker', 'jq-maxlength', 'jq-select2', 'jq-rangeslider']);
    </script>
    @yield('js')
</head>

<body>

    <!-- add class sidebar-dark for dark code -->
    <div id="page-container" class="sidebar-o enable-page-overlay side-scroll page-header-fixed main-content-narrow">
    <aside id="side-overlay">
            <!-- Side Header -->
            <div class="content-header border-bottom">
                <!-- User Avatar -->
                <a class="img-link me-1" href="javascript:void(0)">
                    <img class="img-avatar img-avatar32" src="{{ asset('media/avatars/avatar10.jpg') }}"
                        alt="">
                </a>
                <!-- END User Avatar -->

                <!-- User Info -->
                <div class="ms-2">
                    <a class="text-dark fw-semibold fs-sm" href="javascript:void(0)">John Smith</a>
                </div>
                <!-- END User Info -->

                <!-- Close Side Overlay -->
                <!-- Layout API, functionality initialized in Template._uiApiLayout() -->
                <a class="ms-auto btn btn-sm btn-alt-danger" href="javascript:void(0)" data-toggle="layout"
                    data-action="side_overlay_close">
                    <i class="fa fa-fw fa-times"></i>
                </a>
                <!-- END Close Side Overlay -->
            </div>
            <!-- END Side Header -->

            <!-- Side Content -->
            <div class="content-side">
                <p>
                    Content..
                </p>
            </div>
            <!-- END Side Content -->
        </aside>
        <!-- END Side Overlay -->
        <nav id="sidebar" aria-label="Main Navigation">
            <div class="content-header">
                <a class="fw-semibold text-dual" href="https://demo.pixelcave.com/oneui/index.html">
                    <span class="smini-visible">
                        <i class="fa fa-circle-notch text-primary"></i>
                    </span>
                    <span class="smini-hide fs-5 tracking-wider">OneUI</span>
                </a>
                <div>
                    <button type="button" class="btn btn-sm btn-alt-secondary" data-toggle="layout"
                        data-action="dark_mode_toggle">
                        <i class="far fa-moon"></i>
                    </button>
                    <div class="dropdown d-inline-block ms-1">
                        <button type="button" class="btn btn-sm btn-alt-secondary" id="sidebar-themes-dropdown"
                            data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="fa fa-brush"></i>
                        </button>
                        <div class="dropdown-menu dropdown-menu-end fs-sm smini-hide border-0"
                            aria-labelledby="sidebar-themes-dropdown">
                            <a class="dropdown-item d-flex align-items-center justify-content-between fw-medium active"
                                data-toggle="theme" data-theme="default"
                                href="https://demo.pixelcave.com/oneui/be_pages_dashboard.html#">
                                <span>Default</span>
                                <i class="fa fa-circle text-default"></i>
                            </a>
                            <a class="dropdown-item d-flex align-items-center justify-content-between fw-medium"
                                data-toggle="theme" data-theme="assets/css/themes/amethyst.min-5.8.css"
                                href="https://demo.pixelcave.com/oneui/be_pages_dashboard.html#">
                                <span>Amethyst</span>
                                <i class="fa fa-circle text-amethyst"></i>
                            </a>
                            <a class="dropdown-item d-flex align-items-center justify-content-between fw-medium"
                                data-toggle="theme" data-theme="assets/css/themes/city.min-5.8.css"
                                href="https://demo.pixelcave.com/oneui/be_pages_dashboard.html#">
                                <span>City</span>
                                <i class="fa fa-circle text-city"></i>
                            </a>
                            <a class="dropdown-item d-flex align-items-center justify-content-between fw-medium"
                                data-toggle="theme" data-theme="assets/css/themes/flat.min-5.8.css"
                                href="https://demo.pixelcave.com/oneui/be_pages_dashboard.html#">
                                <span>Flat</span>
                                <i class="fa fa-circle text-flat"></i>
                            </a>
                            <a class="dropdown-item d-flex align-items-center justify-content-between fw-medium"
                                data-toggle="theme" data-theme="assets/css/themes/modern.min-5.8.css"
                                href="https://demo.pixelcave.com/oneui/be_pages_dashboard.html#">
                                <span>Modern</span>
                                <i class="fa fa-circle text-modern"></i>
                            </a>
                            <a class="dropdown-item d-flex align-items-center justify-content-between fw-medium"
                                data-toggle="theme" data-theme="assets/css/themes/smooth.min-5.8.css"
                                href="https://demo.pixelcave.com/oneui/be_pages_dashboard.html#">
                                <span>Smooth</span>
                                <i class="fa fa-circle text-smooth"></i>
                            </a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item fw-medium" data-toggle="layout" data-action="sidebar_style_light"
                                href="javascript:void(0)">
                                <span>Sidebar Light</span>
                            </a>
                            <a class="dropdown-item fw-medium" data-toggle="layout" data-action="sidebar_style_dark"
                                href="javascript:void(0)">
                                <span>Sidebar Dark</span>
                            </a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item fw-medium" data-toggle="layout" data-action="header_style_light"
                                href="javascript:void(0)">
                                <span>Header Light</span>
                            </a>
                            <a class="dropdown-item fw-medium" data-toggle="layout" data-action="header_style_dark"
                                href="javascript:void(0)">
                                <span>Header Dark</span>
                            </a>
                        </div>
                    </div>
                    <a class="d-lg-none btn btn-sm btn-alt-secondary ms-1" data-toggle="layout"
                        data-action="sidebar_close" href="javascript:void(0)">
                        <i class="fa fa-fw fa-times"></i>
                    </a>
                </div>
            </div>
            <div class="js-sidebar-scroll simplebar-scrollable-y" data-simplebar="init">
                <div class="simplebar-wrapper" style="margin: 0px;">
                    <div class="simplebar-height-auto-observer-wrapper">
                        <div class="simplebar-height-auto-observer"></div>
                    </div>
                    <div class="simplebar-mask">
                        <div class="simplebar-offset" style="right: 0px; bottom: 0px;">
                            <div class="simplebar-content-wrapper" tabindex="0" role="region"
                                aria-label="scrollable content" style="height: 100%; overflow: hidden scroll;">
                                <div class="simplebar-content" style="padding: 0px;">
                                    <div class="content-side">
                                        <ul class="nav-main">
                                            <li class="nav-main-item">
                                                <a class="nav-main-link active"
                                                    href="https://demo.pixelcave.com/oneui/be_pages_dashboard.html">
                                                    <i class="nav-main-link-icon si si-speedometer"></i>
                                                    <span class="nav-main-link-name">Dashboard</span>
                                                </a>
                                            </li>
                                            <li class="nav-main-item">
                                                <a class="nav-main-link nav-main-link-submenu" data-toggle="submenu"
                                                    aria-haspopup="true" aria-expanded="false"
                                                    href="https://demo.pixelcave.com/oneui/be_pages_dashboard.html#">
                                                    <i class="nav-main-link-icon si si-layers"></i>
                                                    <span class="nav-main-link-name">Page Packs</span>
                                                </a>
                                                <ul class="nav-main-submenu">
                                                    <li class="nav-main-item">
                                                        <a class="nav-main-link nav-main-link-submenu"
                                                            data-toggle="submenu" aria-haspopup="true"
                                                            aria-expanded="false"
                                                            href="https://demo.pixelcave.com/oneui/be_pages_dashboard.html#">
                                                            <i class="nav-main-link-icon si si-bag"></i>
                                                            <span class="nav-main-link-name">e-Commerce</span>
                                                        </a>
                                                        <ul class="nav-main-submenu">
                                                            <li class="nav-main-item">
                                                                <a class="nav-main-link"
                                                                    href="https://demo.pixelcave.com/oneui/be_pages_ecom_dashboard.html">
                                                                    <span class="nav-main-link-name">Dashboard</span>
                                                                </a>
                                                            </li>
                                                            <li class="nav-main-item">
                                                                <a class="nav-main-link"
                                                                    href="https://demo.pixelcave.com/oneui/be_pages_ecom_orders.html">
                                                                    <span class="nav-main-link-name">Orders</span>
                                                                </a>
                                                            </li>
                                                            <li class="nav-main-item">
                                                                <a class="nav-main-link"
                                                                    href="https://demo.pixelcave.com/oneui/be_pages_ecom_order.html">
                                                                    <span class="nav-main-link-name">Order</span>
                                                                </a>
                                                            </li>
                                                            <li class="nav-main-item">
                                                                <a class="nav-main-link"
                                                                    href="https://demo.pixelcave.com/oneui/be_pages_ecom_products.html">
                                                                    <span class="nav-main-link-name">Products</span>
                                                                </a>
                                                            </li>
                                                            <li class="nav-main-item">
                                                                <a class="nav-main-link"
                                                                    href="https://demo.pixelcave.com/oneui/be_pages_ecom_product_edit.html">
                                                                    <span class="nav-main-link-name">Product
                                                                        Edit</span>
                                                                </a>
                                                            </li>
                                                            <li class="nav-main-item">
                                                                <a class="nav-main-link"
                                                                    href="https://demo.pixelcave.com/oneui/be_pages_ecom_customer.html">
                                                                    <span class="nav-main-link-name">Customer</span>
                                                                </a>
                                                            </li>
                                                        </ul>
                                                    </li>
                                                    <li class="nav-main-item">
                                                        <a class="nav-main-link nav-main-link-submenu"
                                                            data-toggle="submenu" aria-haspopup="true"
                                                            aria-expanded="false"
                                                            href="https://demo.pixelcave.com/oneui/be_pages_dashboard.html#">
                                                            <i class="nav-main-link-icon si si-handbag"></i>
                                                            <span class="nav-main-link-name">e-Commerce Store</span>
                                                        </a>
                                                        <ul class="nav-main-submenu">
                                                            <li class="nav-main-item">
                                                                <a class="nav-main-link"
                                                                    href="https://demo.pixelcave.com/oneui/be_pages_ecom_store_home.html">
                                                                    <span class="nav-main-link-name">Home</span>
                                                                </a>
                                                            </li>
                                                            <li class="nav-main-item">
                                                                <a class="nav-main-link"
                                                                    href="https://demo.pixelcave.com/oneui/be_pages_ecom_store_search.html">
                                                                    <span class="nav-main-link-name">Search
                                                                        Results</span>
                                                                </a>
                                                            </li>
                                                            <li class="nav-main-item">
                                                                <a class="nav-main-link"
                                                                    href="https://demo.pixelcave.com/oneui/be_pages_ecom_store_products.html">
                                                                    <span class="nav-main-link-name">Products
                                                                        List</span>
                                                                </a>
                                                            </li>
                                                            <li class="nav-main-item">
                                                                <a class="nav-main-link"
                                                                    href="https://demo.pixelcave.com/oneui/be_pages_ecom_store_product.html">
                                                                    <span class="nav-main-link-name">Product
                                                                        Page</span>
                                                                </a>
                                                            </li>
                                                            <li class="nav-main-item">
                                                                <a class="nav-main-link"
                                                                    href="https://demo.pixelcave.com/oneui/be_pages_ecom_store_checkout.html">
                                                                    <span class="nav-main-link-name">Checkout</span>
                                                                </a>
                                                            </li>
                                                        </ul>
                                                    </li>
                                                    <li class="nav-main-item">
                                                        <a class="nav-main-link nav-main-link-submenu"
                                                            data-toggle="submenu" aria-haspopup="true"
                                                            aria-expanded="false"
                                                            href="https://demo.pixelcave.com/oneui/be_pages_dashboard.html#">
                                                            <i class="nav-main-link-icon si si-pencil"></i>
                                                            <span class="nav-main-link-name">Blog</span>
                                                        </a>
                                                        <ul class="nav-main-submenu">
                                                            <li class="nav-main-item">
                                                                <a class="nav-main-link"
                                                                    href="https://demo.pixelcave.com/oneui/be_pages_blog_classic.html">
                                                                    <span class="nav-main-link-name">Classic</span>
                                                                </a>
                                                            </li>
                                                            <li class="nav-main-item">
                                                                <a class="nav-main-link"
                                                                    href="https://demo.pixelcave.com/oneui/be_pages_blog_list.html">
                                                                    <span class="nav-main-link-name">List</span>
                                                                </a>
                                                            </li>
                                                            <li class="nav-main-item">
                                                                <a class="nav-main-link"
                                                                    href="https://demo.pixelcave.com/oneui/be_pages_blog_grid.html">
                                                                    <span class="nav-main-link-name">Grid</span>
                                                                </a>
                                                            </li>
                                                            <li class="nav-main-item">
                                                                <a class="nav-main-link"
                                                                    href="https://demo.pixelcave.com/oneui/be_pages_blog_story.html">
                                                                    <span class="nav-main-link-name">Story</span>
                                                                </a>
                                                            </li>
                                                            <li class="nav-main-item">
                                                                <a class="nav-main-link"
                                                                    href="https://demo.pixelcave.com/oneui/be_pages_blog_story_cover.html">
                                                                    <span class="nav-main-link-name">Story Cover</span>
                                                                </a>
                                                            </li>
                                                        </ul>
                                                    </li>
                                                    <li class="nav-main-item">
                                                        <a class="nav-main-link nav-main-link-submenu"
                                                            data-toggle="submenu" aria-haspopup="true"
                                                            aria-expanded="false"
                                                            href="https://demo.pixelcave.com/oneui/be_pages_dashboard.html#">
                                                            <i class="nav-main-link-icon si si-graduation"></i>
                                                            <span class="nav-main-link-name">e-Learning</span>
                                                        </a>
                                                        <ul class="nav-main-submenu">
                                                            <li class="nav-main-item">
                                                                <a class="nav-main-link"
                                                                    href="https://demo.pixelcave.com/oneui/be_pages_elearning_courses.html">
                                                                    <span class="nav-main-link-name">Courses</span>
                                                                </a>
                                                            </li>
                                                            <li class="nav-main-item">
                                                                <a class="nav-main-link"
                                                                    href="https://demo.pixelcave.com/oneui/be_pages_elearning_course.html">
                                                                    <span class="nav-main-link-name">Course</span>
                                                                </a>
                                                            </li>
                                                            <li class="nav-main-item">
                                                                <a class="nav-main-link"
                                                                    href="https://demo.pixelcave.com/oneui/be_pages_elearning_lesson.html">
                                                                    <span class="nav-main-link-name">Lesson</span>
                                                                </a>
                                                            </li>
                                                        </ul>
                                                    </li>
                                                    <li class="nav-main-item">
                                                        <a class="nav-main-link nav-main-link-submenu"
                                                            data-toggle="submenu" aria-haspopup="true"
                                                            aria-expanded="false"
                                                            href="https://demo.pixelcave.com/oneui/be_pages_dashboard.html#">
                                                            <i class="nav-main-link-icon si si-bubbles"></i>
                                                            <span class="nav-main-link-name">Forum</span>
                                                        </a>
                                                        <ul class="nav-main-submenu">
                                                            <li class="nav-main-item">
                                                                <a class="nav-main-link"
                                                                    href="https://demo.pixelcave.com/oneui/be_pages_forum_categories.html">
                                                                    <span class="nav-main-link-name">Categories</span>
                                                                </a>
                                                            </li>
                                                            <li class="nav-main-item">
                                                                <a class="nav-main-link"
                                                                    href="https://demo.pixelcave.com/oneui/be_pages_forum_topics.html">
                                                                    <span class="nav-main-link-name">Topics</span>
                                                                </a>
                                                            </li>
                                                            <li class="nav-main-item">
                                                                <a class="nav-main-link"
                                                                    href="https://demo.pixelcave.com/oneui/be_pages_forum_discussion.html">
                                                                    <span class="nav-main-link-name">Discussion</span>
                                                                </a>
                                                            </li>
                                                        </ul>
                                                    </li>
                                                    <li class="nav-main-item">
                                                        <a class="nav-main-link nav-main-link-submenu"
                                                            data-toggle="submenu" aria-haspopup="true"
                                                            aria-expanded="false"
                                                            href="https://demo.pixelcave.com/oneui/be_pages_dashboard.html#">
                                                            <i class="nav-main-link-icon si si-magnet"></i>
                                                            <span class="nav-main-link-name">Boxed Backend</span>
                                                        </a>
                                                        <ul class="nav-main-submenu">
                                                            <li class="nav-main-item">
                                                                <a class="nav-main-link"
                                                                    href="https://demo.pixelcave.com/oneui/bd_dashboard.html">
                                                                    <span class="nav-main-link-name">Dashboard</span>
                                                                </a>
                                                            </li>
                                                            <li class="nav-main-item">
                                                                <a class="nav-main-link"
                                                                    href="https://demo.pixelcave.com/oneui/bd_search.html">
                                                                    <span class="nav-main-link-name">Search</span>
                                                                </a>
                                                            </li>
                                                            <li class="nav-main-item">
                                                                <a class="nav-main-link"
                                                                    href="https://demo.pixelcave.com/oneui/bd_simple_1.html">
                                                                    <span class="nav-main-link-name">Simple 1</span>
                                                                </a>
                                                            </li>
                                                            <li class="nav-main-item">
                                                                <a class="nav-main-link"
                                                                    href="https://demo.pixelcave.com/oneui/bd_simple_2.html">
                                                                    <span class="nav-main-link-name">Simple 2</span>
                                                                </a>
                                                            </li>
                                                            <li class="nav-main-item">
                                                                <a class="nav-main-link"
                                                                    href="https://demo.pixelcave.com/oneui/bd_image_1.html">
                                                                    <span class="nav-main-link-name">Image 1</span>
                                                                </a>
                                                            </li>
                                                            <li class="nav-main-item">
                                                                <a class="nav-main-link"
                                                                    href="https://demo.pixelcave.com/oneui/bd_image_2.html">
                                                                    <span class="nav-main-link-name">Image 2</span>
                                                                </a>
                                                            </li>
                                                            <li class="nav-main-item">
                                                                <a class="nav-main-link"
                                                                    href="https://demo.pixelcave.com/oneui/bd_video_1.html">
                                                                    <span class="nav-main-link-name">Video 1</span>
                                                                </a>
                                                            </li>
                                                            <li class="nav-main-item">
                                                                <a class="nav-main-link"
                                                                    href="https://demo.pixelcave.com/oneui/bd_video_2.html">
                                                                    <span class="nav-main-link-name">Video 2</span>
                                                                </a>
                                                            </li>
                                                        </ul>
                                                    </li>
                                                </ul>
                                            </li>
                                            <li class="nav-main-heading">User Interface</li>
                                            <li class="nav-main-item">
                                                <a class="nav-main-link nav-main-link-submenu" data-toggle="submenu"
                                                    aria-haspopup="true" aria-expanded="false"
                                                    href="https://demo.pixelcave.com/oneui/be_pages_dashboard.html#">
                                                    <i class="nav-main-link-icon si si-energy"></i>
                                                    <span class="nav-main-link-name">Blocks</span>
                                                </a>
                                                <ul class="nav-main-submenu">
                                                    <li class="nav-main-item">
                                                        <a class="nav-main-link"
                                                            href="https://demo.pixelcave.com/oneui/be_blocks_styles.html">
                                                            <span class="nav-main-link-name">Styles</span>
                                                        </a>
                                                    </li>
                                                    <li class="nav-main-item">
                                                        <a class="nav-main-link"
                                                            href="https://demo.pixelcave.com/oneui/be_blocks_options.html">
                                                            <span class="nav-main-link-name">Options</span>
                                                        </a>
                                                    </li>
                                                    <li class="nav-main-item">
                                                        <a class="nav-main-link"
                                                            href="https://demo.pixelcave.com/oneui/be_blocks_forms.html">
                                                            <span class="nav-main-link-name">Forms</span>
                                                        </a>
                                                    </li>
                                                    <li class="nav-main-item">
                                                        <a class="nav-main-link"
                                                            href="https://demo.pixelcave.com/oneui/be_blocks_themed.html">
                                                            <span class="nav-main-link-name">Themed</span>
                                                        </a>
                                                    </li>
                                                    <li class="nav-main-item">
                                                        <a class="nav-main-link"
                                                            href="https://demo.pixelcave.com/oneui/be_blocks_api.html">
                                                            <span class="nav-main-link-name">API</span>
                                                        </a>
                                                    </li>
                                                </ul>
                                            </li>
                                            <li class="nav-main-item">
                                                <a class="nav-main-link nav-main-link-submenu" data-toggle="submenu"
                                                    aria-haspopup="true" aria-expanded="false"
                                                    href="https://demo.pixelcave.com/oneui/be_pages_dashboard.html#">
                                                    <i class="nav-main-link-icon si si-trophy"></i>
                                                    <span class="nav-main-link-name">Widgets</span>
                                                </a>
                                                <ul class="nav-main-submenu">
                                                    <li class="nav-main-item">
                                                        <a class="nav-main-link"
                                                            href="https://demo.pixelcave.com/oneui/be_widgets_tiles.html">
                                                            <span class="nav-main-link-name">Tiles</span>
                                                        </a>
                                                    </li>
                                                    <li class="nav-main-item">
                                                        <a class="nav-main-link"
                                                            href="https://demo.pixelcave.com/oneui/be_widgets_users.html">
                                                            <span class="nav-main-link-name">Users</span>
                                                        </a>
                                                    </li>
                                                    <li class="nav-main-item">
                                                        <a class="nav-main-link"
                                                            href="https://demo.pixelcave.com/oneui/be_widgets_stats.html">
                                                            <span class="nav-main-link-name">Statistics</span>
                                                        </a>
                                                    </li>
                                                    <li class="nav-main-item">
                                                        <a class="nav-main-link"
                                                            href="https://demo.pixelcave.com/oneui/be_widgets_blog.html">
                                                            <span class="nav-main-link-name">Blog</span>
                                                        </a>
                                                    </li>
                                                </ul>
                                            </li>
                                            <li class="nav-main-item">
                                                <a class="nav-main-link nav-main-link-submenu" data-toggle="submenu"
                                                    aria-haspopup="true" aria-expanded="false"
                                                    href="https://demo.pixelcave.com/oneui/be_pages_dashboard.html#">
                                                    <i class="nav-main-link-icon si si-badge"></i>
                                                    <span class="nav-main-link-name">Elements</span>
                                                </a>
                                                <ul class="nav-main-submenu">
                                                    <li class="nav-main-item">
                                                        <a class="nav-main-link"
                                                            href="https://demo.pixelcave.com/oneui/be_ui_grid.html">
                                                            <span class="nav-main-link-name">Grid</span>
                                                        </a>
                                                    </li>
                                                    <li class="nav-main-item">
                                                        <a class="nav-main-link"
                                                            href="https://demo.pixelcave.com/oneui/be_ui_typography.html">
                                                            <span class="nav-main-link-name">Typography</span>
                                                        </a>
                                                    </li>
                                                    <li class="nav-main-item">
                                                        <a class="nav-main-link"
                                                            href="https://demo.pixelcave.com/oneui/be_ui_icons.html">
                                                            <span class="nav-main-link-name">Icons</span>
                                                        </a>
                                                    </li>
                                                    <li class="nav-main-item">
                                                        <a class="nav-main-link"
                                                            href="https://demo.pixelcave.com/oneui/be_ui_buttons.html">
                                                            <span class="nav-main-link-name">Buttons</span>
                                                        </a>
                                                    </li>
                                                    <li class="nav-main-item">
                                                        <a class="nav-main-link"
                                                            href="https://demo.pixelcave.com/oneui/be_ui_buttons_groups.html">
                                                            <span class="nav-main-link-name">Button Groups</span>
                                                        </a>
                                                    </li>
                                                    <li class="nav-main-item">
                                                        <a class="nav-main-link"
                                                            href="https://demo.pixelcave.com/oneui/be_ui_dropdowns.html">
                                                            <span class="nav-main-link-name">Dropdowns</span>
                                                        </a>
                                                    </li>
                                                    <li class="nav-main-item">
                                                        <a class="nav-main-link"
                                                            href="https://demo.pixelcave.com/oneui/be_ui_tabs.html">
                                                            <span class="nav-main-link-name">Tabs</span>
                                                        </a>
                                                    </li>
                                                    <li class="nav-main-item">
                                                        <a class="nav-main-link"
                                                            href="https://demo.pixelcave.com/oneui/be_ui_navigation.html">
                                                            <span class="nav-main-link-name">Navigation</span>
                                                        </a>
                                                    </li>
                                                    <li class="nav-main-item">
                                                        <a class="nav-main-link"
                                                            href="https://demo.pixelcave.com/oneui/be_ui_navigation_horizontal.html">
                                                            <span class="nav-main-link-name">Horizontal
                                                                Navigation</span>
                                                        </a>
                                                    </li>
                                                    <li class="nav-main-item">
                                                        <a class="nav-main-link"
                                                            href="https://demo.pixelcave.com/oneui/be_ui_mega_menu.html">
                                                            <span class="nav-main-link-name">Mega Menu</span>
                                                        </a>
                                                    </li>
                                                    <li class="nav-main-item">
                                                        <a class="nav-main-link"
                                                            href="https://demo.pixelcave.com/oneui/be_ui_progress.html">
                                                            <span class="nav-main-link-name">Progress</span>
                                                        </a>
                                                    </li>
                                                    <li class="nav-main-item">
                                                        <a class="nav-main-link"
                                                            href="https://demo.pixelcave.com/oneui/be_ui_alerts.html">
                                                            <span class="nav-main-link-name">Alerts</span>
                                                        </a>
                                                    </li>
                                                    <li class="nav-main-item">
                                                        <a class="nav-main-link"
                                                            href="https://demo.pixelcave.com/oneui/be_ui_tooltips.html">
                                                            <span class="nav-main-link-name">Tooltips</span>
                                                        </a>
                                                    </li>
                                                    <li class="nav-main-item">
                                                        <a class="nav-main-link"
                                                            href="https://demo.pixelcave.com/oneui/be_ui_popovers.html">
                                                            <span class="nav-main-link-name">Popovers</span>
                                                        </a>
                                                    </li>
                                                    <li class="nav-main-item">
                                                        <a class="nav-main-link"
                                                            href="https://demo.pixelcave.com/oneui/be_ui_modals.html">
                                                            <span class="nav-main-link-name">Modals</span>
                                                        </a>
                                                    </li>
                                                    <li class="nav-main-item">
                                                        <a class="nav-main-link"
                                                            href="https://demo.pixelcave.com/oneui/be_ui_images.html">
                                                            <span class="nav-main-link-name">Images Overlay</span>
                                                        </a>
                                                    </li>
                                                    <li class="nav-main-item">
                                                        <a class="nav-main-link"
                                                            href="https://demo.pixelcave.com/oneui/be_ui_timeline.html">
                                                            <span class="nav-main-link-name">Timeline</span>
                                                        </a>
                                                    </li>
                                                    <li class="nav-main-item">
                                                        <a class="nav-main-link"
                                                            href="https://demo.pixelcave.com/oneui/be_ui_ribbons.html">
                                                            <span class="nav-main-link-name">Ribbons</span>
                                                        </a>
                                                    </li>
                                                    <li class="nav-main-item">
                                                        <a class="nav-main-link"
                                                            href="https://demo.pixelcave.com/oneui/be_ui_steps.html">
                                                            <span class="nav-main-link-name">Steps</span>
                                                        </a>
                                                    </li>
                                                    <li class="nav-main-item">
                                                        <a class="nav-main-link"
                                                            href="https://demo.pixelcave.com/oneui/be_ui_animations.html">
                                                            <span class="nav-main-link-name">Animations</span>
                                                        </a>
                                                    </li>
                                                    <li class="nav-main-item">
                                                        <a class="nav-main-link"
                                                            href="https://demo.pixelcave.com/oneui/be_ui_color_themes.html">
                                                            <span class="nav-main-link-name">Color Themes</span>
                                                        </a>
                                                    </li>
                                                </ul>
                                            </li>
                                            <li class="nav-main-item">
                                                <a class="nav-main-link nav-main-link-submenu" data-toggle="submenu"
                                                    aria-haspopup="true" aria-expanded="false"
                                                    href="https://demo.pixelcave.com/oneui/be_pages_dashboard.html#">
                                                    <i class="nav-main-link-icon si si-grid"></i>
                                                    <span class="nav-main-link-name">Tables</span>
                                                </a>
                                                <ul class="nav-main-submenu">
                                                    <li class="nav-main-item">
                                                        <a class="nav-main-link"
                                                            href="https://demo.pixelcave.com/oneui/be_tables_styles.html">
                                                            <span class="nav-main-link-name">Styles</span>
                                                        </a>
                                                    </li>
                                                    <li class="nav-main-item">
                                                        <a class="nav-main-link"
                                                            href="https://demo.pixelcave.com/oneui/be_tables_responsive.html">
                                                            <span class="nav-main-link-name">Responsive</span>
                                                        </a>
                                                    </li>
                                                    <li class="nav-main-item">
                                                        <a class="nav-main-link"
                                                            href="https://demo.pixelcave.com/oneui/be_tables_helpers.html">
                                                            <span class="nav-main-link-name">Helpers</span>
                                                        </a>
                                                    </li>
                                                    <li class="nav-main-item">
                                                        <a class="nav-main-link"
                                                            href="https://demo.pixelcave.com/oneui/be_tables_datatables.html">
                                                            <span class="nav-main-link-name">DataTables</span>
                                                        </a>
                                                    </li>
                                                </ul>
                                            </li>
                                            <li class="nav-main-item">
                                                <a class="nav-main-link nav-main-link-submenu" data-toggle="submenu"
                                                    aria-haspopup="true" aria-expanded="false"
                                                    href="https://demo.pixelcave.com/oneui/be_pages_dashboard.html#">
                                                    <i class="nav-main-link-icon si si-note"></i>
                                                    <span class="nav-main-link-name">Forms</span>
                                                </a>
                                                <ul class="nav-main-submenu">
                                                    <li class="nav-main-item">
                                                        <a class="nav-main-link"
                                                            href="https://demo.pixelcave.com/oneui/be_forms_elements.html">
                                                            <span class="nav-main-link-name">Elements</span>
                                                        </a>
                                                    </li>
                                                    <li class="nav-main-item">
                                                        <a class="nav-main-link"
                                                            href="https://demo.pixelcave.com/oneui/be_forms_layouts.html">
                                                            <span class="nav-main-link-name">Layouts</span>
                                                        </a>
                                                    </li>
                                                    <li class="nav-main-item">
                                                        <a class="nav-main-link"
                                                            href="https://demo.pixelcave.com/oneui/be_forms_input_groups.html">
                                                            <span class="nav-main-link-name">Input Groups</span>
                                                        </a>
                                                    </li>
                                                    <li class="nav-main-item">
                                                        <a class="nav-main-link"
                                                            href="https://demo.pixelcave.com/oneui/be_forms_plugins.html">
                                                            <span class="nav-main-link-name">Plugins</span>
                                                        </a>
                                                    </li>
                                                    <li class="nav-main-item">
                                                        <a class="nav-main-link"
                                                            href="https://demo.pixelcave.com/oneui/be_forms_editors.html">
                                                            <span class="nav-main-link-name">Editors</span>
                                                        </a>
                                                    </li>
                                                    <li class="nav-main-item">
                                                        <a class="nav-main-link nav-main-link-submenu"
                                                            data-toggle="submenu" aria-haspopup="true"
                                                            aria-expanded="false"
                                                            href="https://demo.pixelcave.com/oneui/be_pages_dashboard.html#">
                                                            <span class="nav-main-link-name">CKEditor 5</span>
                                                        </a>
                                                        <ul class="nav-main-submenu">
                                                            <li class="nav-main-item">
                                                                <a class="nav-main-link"
                                                                    href="https://demo.pixelcave.com/oneui/be_forms_ckeditor5_classic.html">
                                                                    <span class="nav-main-link-name">Classic</span>
                                                                </a>
                                                            </li>
                                                            <li class="nav-main-item">
                                                                <a class="nav-main-link"
                                                                    href="https://demo.pixelcave.com/oneui/be_forms_ckeditor5_inline.html">
                                                                    <span class="nav-main-link-name">Inline</span>
                                                                </a>
                                                            </li>
                                                        </ul>
                                                    </li>
                                                    <li class="nav-main-item">
                                                        <a class="nav-main-link"
                                                            href="https://demo.pixelcave.com/oneui/be_forms_validation.html">
                                                            <span class="nav-main-link-name">Validation</span>
                                                        </a>
                                                    </li>
                                                </ul>
                                            </li>
                                            <li class="nav-main-heading">Develop</li>
                                            <li class="nav-main-item">
                                                <a class="nav-main-link nav-main-link-submenu" data-toggle="submenu"
                                                    aria-haspopup="true" aria-expanded="false"
                                                    href="https://demo.pixelcave.com/oneui/be_pages_dashboard.html#">
                                                    <i class="nav-main-link-icon si si-wrench"></i>
                                                    <span class="nav-main-link-name">Components</span>
                                                </a>
                                                <ul class="nav-main-submenu">
                                                    <li class="nav-main-item">
                                                        <a class="nav-main-link"
                                                            href="https://demo.pixelcave.com/oneui/be_comp_loaders.html">
                                                            <span class="nav-main-link-name">Loaders</span>
                                                        </a>
                                                    </li>
                                                    <li class="nav-main-item">
                                                        <a class="nav-main-link"
                                                            href="https://demo.pixelcave.com/oneui/be_comp_image_cropper.html">
                                                            <span class="nav-main-link-name">Image Cropper</span>
                                                        </a>
                                                    </li>
                                                    <li class="nav-main-item">
                                                        <a class="nav-main-link"
                                                            href="https://demo.pixelcave.com/oneui/be_comp_appear.html">
                                                            <span class="nav-main-link-name">Appear</span>
                                                        </a>
                                                    </li>
                                                    <li class="nav-main-item">
                                                        <a class="nav-main-link"
                                                            href="https://demo.pixelcave.com/oneui/be_comp_charts.html">
                                                            <span class="nav-main-link-name">Charts</span>
                                                        </a>
                                                    </li>
                                                    <li class="nav-main-item">
                                                        <a class="nav-main-link"
                                                            href="https://demo.pixelcave.com/oneui/be_comp_calendar.html">
                                                            <span class="nav-main-link-name">Calendar</span>
                                                        </a>
                                                    </li>
                                                    <li class="nav-main-item">
                                                        <a class="nav-main-link"
                                                            href="https://demo.pixelcave.com/oneui/be_comp_sliders.html">
                                                            <span class="nav-main-link-name">Sliders</span>
                                                        </a>
                                                    </li>
                                                    <li class="nav-main-item">
                                                        <a class="nav-main-link"
                                                            href="https://demo.pixelcave.com/oneui/be_comp_carousel.html">
                                                            <span class="nav-main-link-name">Carousel</span>
                                                        </a>
                                                    </li>
                                                    <li class="nav-main-item">
                                                        <a class="nav-main-link"
                                                            href="https://demo.pixelcave.com/oneui/be_comp_offcanvas.html">
                                                            <span class="nav-main-link-name">Offcanvas</span>
                                                        </a>
                                                    </li>
                                                    <li class="nav-main-item">
                                                        <a class="nav-main-link"
                                                            href="https://demo.pixelcave.com/oneui/be_comp_syntax_highlighting.html">
                                                            <span class="nav-main-link-name">Syntax Highlighting</span>
                                                        </a>
                                                    </li>
                                                    <li class="nav-main-item">
                                                        <a class="nav-main-link"
                                                            href="https://demo.pixelcave.com/oneui/be_comp_rating.html">
                                                            <span class="nav-main-link-name">Rating</span>
                                                        </a>
                                                    </li>
                                                    <li class="nav-main-item">
                                                        <a class="nav-main-link"
                                                            href="https://demo.pixelcave.com/oneui/be_comp_maps_vector.html">
                                                            <span class="nav-main-link-name">Vector Maps</span>
                                                        </a>
                                                    </li>
                                                    <li class="nav-main-item">
                                                        <a class="nav-main-link"
                                                            href="https://demo.pixelcave.com/oneui/be_comp_dialogs.html">
                                                            <span class="nav-main-link-name">Dialogs</span>
                                                        </a>
                                                    </li>
                                                    <li class="nav-main-item">
                                                        <a class="nav-main-link"
                                                            href="https://demo.pixelcave.com/oneui/be_comp_notifications.html">
                                                            <span class="nav-main-link-name">Notifications</span>
                                                        </a>
                                                    </li>
                                                    <li class="nav-main-item">
                                                        <a class="nav-main-link"
                                                            href="https://demo.pixelcave.com/oneui/be_comp_gallery.html">
                                                            <span class="nav-main-link-name">Gallery</span>
                                                        </a>
                                                    </li>
                                                </ul>
                                            </li>
                                            <li class="nav-main-item">
                                                <a class="nav-main-link nav-main-link-submenu" data-toggle="submenu"
                                                    aria-haspopup="true" aria-expanded="false"
                                                    href="https://demo.pixelcave.com/oneui/be_pages_dashboard.html#">
                                                    <i class="nav-main-link-icon si si-magic-wand"></i>
                                                    <span class="nav-main-link-name">Layout</span>
                                                </a>
                                                <ul class="nav-main-submenu">
                                                    <li class="nav-main-item">
                                                        <a class="nav-main-link nav-main-link-submenu"
                                                            data-toggle="submenu" aria-haspopup="true"
                                                            aria-expanded="false"
                                                            href="https://demo.pixelcave.com/oneui/be_pages_dashboard.html#">
                                                            <span class="nav-main-link-name">Page</span>
                                                        </a>
                                                        <ul class="nav-main-submenu">
                                                            <li class="nav-main-item">
                                                                <a class="nav-main-link"
                                                                    href="https://demo.pixelcave.com/oneui/be_layout_page_default.html">
                                                                    <span class="nav-main-link-name">Default</span>
                                                                </a>
                                                            </li>
                                                            <li class="nav-main-item">
                                                                <a class="nav-main-link"
                                                                    href="https://demo.pixelcave.com/oneui/be_layout_page_flipped.html">
                                                                    <span class="nav-main-link-name">Flipped</span>
                                                                </a>
                                                            </li>
                                                            <li class="nav-main-item">
                                                                <a class="nav-main-link"
                                                                    href="https://demo.pixelcave.com/oneui/be_layout_page_native_scrolling.html">
                                                                    <span class="nav-main-link-name">Native
                                                                        Scrolling</span>
                                                                </a>
                                                            </li>
                                                        </ul>
                                                    </li>
                                                    <li class="nav-main-item">
                                                        <a class="nav-main-link nav-main-link-submenu"
                                                            data-toggle="submenu" aria-haspopup="true"
                                                            aria-expanded="false"
                                                            href="https://demo.pixelcave.com/oneui/be_pages_dashboard.html#">
                                                            <span class="nav-main-link-name">Dark Mode</span>
                                                        </a>
                                                        <ul class="nav-main-submenu">
                                                            <li class="nav-main-item">
                                                                <a class="nav-main-link"
                                                                    href="https://demo.pixelcave.com/oneui/be_layout_dark_mode_on.html">
                                                                    <span class="nav-main-link-name">On</span>
                                                                </a>
                                                            </li>
                                                            <li class="nav-main-item">
                                                                <a class="nav-main-link"
                                                                    href="https://demo.pixelcave.com/oneui/be_layout_dark_mode_off.html">
                                                                    <span class="nav-main-link-name">Off</span>
                                                                </a>
                                                            </li>
                                                        </ul>
                                                    </li>
                                                    <li class="nav-main-item">
                                                        <a class="nav-main-link nav-main-link-submenu"
                                                            data-toggle="submenu" aria-haspopup="true"
                                                            aria-expanded="false"
                                                            href="https://demo.pixelcave.com/oneui/be_pages_dashboard.html#">
                                                            <span class="nav-main-link-name">Main Content</span>
                                                        </a>
                                                        <ul class="nav-main-submenu">
                                                            <li class="nav-main-item">
                                                                <a class="nav-main-link"
                                                                    href="https://demo.pixelcave.com/oneui/be_layout_content_main_full_width.html">
                                                                    <span class="nav-main-link-name">Full Width</span>
                                                                </a>
                                                            </li>
                                                            <li class="nav-main-item">
                                                                <a class="nav-main-link"
                                                                    href="https://demo.pixelcave.com/oneui/be_layout_content_main_narrow.html">
                                                                    <span class="nav-main-link-name">Narrow</span>
                                                                </a>
                                                            </li>
                                                            <li class="nav-main-item">
                                                                <a class="nav-main-link"
                                                                    href="https://demo.pixelcave.com/oneui/be_layout_content_main_boxed.html">
                                                                    <span class="nav-main-link-name">Boxed</span>
                                                                </a>
                                                            </li>
                                                        </ul>
                                                    </li>
                                                    <li class="nav-main-item">
                                                        <a class="nav-main-link nav-main-link-submenu"
                                                            data-toggle="submenu" aria-haspopup="true"
                                                            aria-expanded="false"
                                                            href="https://demo.pixelcave.com/oneui/be_pages_dashboard.html#">
                                                            <span class="nav-main-link-name">Header</span>
                                                        </a>
                                                        <ul class="nav-main-submenu">
                                                            <li class="nav-main-heading">Fixed</li>
                                                            <li class="nav-main-item">
                                                                <a class="nav-main-link"
                                                                    href="https://demo.pixelcave.com/oneui/be_layout_header_fixed_light.html">
                                                                    <span class="nav-main-link-name">Light</span>
                                                                </a>
                                                            </li>
                                                            <li class="nav-main-item">
                                                                <a class="nav-main-link"
                                                                    href="https://demo.pixelcave.com/oneui/be_layout_header_fixed_dark.html">
                                                                    <span class="nav-main-link-name">Dark</span>
                                                                </a>
                                                            </li>
                                                            <li class="nav-main-heading">Static</li>
                                                            <li class="nav-main-item">
                                                                <a class="nav-main-link"
                                                                    href="https://demo.pixelcave.com/oneui/be_layout_header_static_light.html">
                                                                    <span class="nav-main-link-name">Light</span>
                                                                </a>
                                                            </li>
                                                            <li class="nav-main-item">
                                                                <a class="nav-main-link"
                                                                    href="https://demo.pixelcave.com/oneui/be_layout_header_static_dark.html">
                                                                    <span class="nav-main-link-name">Dark</span>
                                                                </a>
                                                            </li>
                                                        </ul>
                                                    </li>
                                                    <li class="nav-main-item">
                                                        <a class="nav-main-link nav-main-link-submenu"
                                                            data-toggle="submenu" aria-haspopup="true"
                                                            aria-expanded="false"
                                                            href="https://demo.pixelcave.com/oneui/be_pages_dashboard.html#">
                                                            <span class="nav-main-link-name">Sidebar</span>
                                                        </a>
                                                        <ul class="nav-main-submenu">
                                                            <li class="nav-main-item">
                                                                <a class="nav-main-link"
                                                                    href="https://demo.pixelcave.com/oneui/be_layout_sidebar_mini.html">
                                                                    <span class="nav-main-link-name">Mini</span>
                                                                </a>
                                                            </li>
                                                            <li class="nav-main-item">
                                                                <a class="nav-main-link"
                                                                    href="https://demo.pixelcave.com/oneui/be_layout_sidebar_light.html">
                                                                    <span class="nav-main-link-name">Light</span>
                                                                </a>
                                                            </li>
                                                            <li class="nav-main-item">
                                                                <a class="nav-main-link"
                                                                    href="https://demo.pixelcave.com/oneui/be_layout_sidebar_dark.html">
                                                                    <span class="nav-main-link-name">Dark</span>
                                                                </a>
                                                            </li>
                                                            <li class="nav-main-item">
                                                                <a class="nav-main-link"
                                                                    href="https://demo.pixelcave.com/oneui/be_layout_sidebar_hidden.html">
                                                                    <span class="nav-main-link-name">Hidden</span>
                                                                </a>
                                                            </li>
                                                        </ul>
                                                    </li>
                                                    <li class="nav-main-item">
                                                        <a class="nav-main-link nav-main-link-submenu"
                                                            data-toggle="submenu" aria-haspopup="true"
                                                            aria-expanded="false"
                                                            href="https://demo.pixelcave.com/oneui/be_pages_dashboard.html#">
                                                            <span class="nav-main-link-name">Side Overlay</span>
                                                        </a>
                                                        <ul class="nav-main-submenu">
                                                            <li class="nav-main-item">
                                                                <a class="nav-main-link"
                                                                    href="https://demo.pixelcave.com/oneui/be_layout_side_overlay_visible.html">
                                                                    <span class="nav-main-link-name">Visible</span>
                                                                </a>
                                                            </li>
                                                            <li class="nav-main-item">
                                                                <a class="nav-main-link"
                                                                    href="https://demo.pixelcave.com/oneui/be_layout_side_overlay_mode_hover.html">
                                                                    <span class="nav-main-link-name">Hover Mode</span>
                                                                </a>
                                                            </li>
                                                            <li class="nav-main-item">
                                                                <a class="nav-main-link"
                                                                    href="https://demo.pixelcave.com/oneui/be_layout_side_overlay_no_page_overlay.html">
                                                                    <span class="nav-main-link-name">No Page
                                                                        Overlay</span>
                                                                </a>
                                                            </li>
                                                        </ul>
                                                    </li>
                                                    <li class="nav-main-item">
                                                        <a class="nav-main-link"
                                                            href="https://demo.pixelcave.com/oneui/be_layout_api.html">
                                                            <span class="nav-main-link-name">API</span>
                                                        </a>
                                                    </li>
                                                </ul>
                                            </li>
                                            <li class="nav-main-item">
                                                <a class="nav-main-link nav-main-link-submenu" data-toggle="submenu"
                                                    aria-haspopup="true" aria-expanded="false"
                                                    href="https://demo.pixelcave.com/oneui/be_pages_dashboard.html#">
                                                    <i class="nav-main-link-icon si si-puzzle"></i>
                                                    <span class="nav-main-link-name">Multi Level Menu</span>
                                                </a>
                                                <ul class="nav-main-submenu">
                                                    <li class="nav-main-item">
                                                        <a class="nav-main-link"
                                                            href="https://demo.pixelcave.com/oneui/be_pages_dashboard.html#">
                                                            <span class="nav-main-link-name">Link 1-1</span>
                                                        </a>
                                                    </li>
                                                    <li class="nav-main-item">
                                                        <a class="nav-main-link"
                                                            href="https://demo.pixelcave.com/oneui/be_pages_dashboard.html#">
                                                            <span class="nav-main-link-name">Link 1-2</span>
                                                        </a>
                                                    </li>
                                                    <li class="nav-main-item">
                                                        <a class="nav-main-link nav-main-link-submenu"
                                                            data-toggle="submenu" aria-haspopup="true"
                                                            aria-expanded="false"
                                                            href="https://demo.pixelcave.com/oneui/be_pages_dashboard.html#">
                                                            <span class="nav-main-link-name">Sub Level 2</span>
                                                        </a>
                                                        <ul class="nav-main-submenu">
                                                            <li class="nav-main-item">
                                                                <a class="nav-main-link"
                                                                    href="https://demo.pixelcave.com/oneui/be_pages_dashboard.html#">
                                                                    <span class="nav-main-link-name">Link 2-1</span>
                                                                </a>
                                                            </li>
                                                            <li class="nav-main-item">
                                                                <a class="nav-main-link"
                                                                    href="https://demo.pixelcave.com/oneui/be_pages_dashboard.html#">
                                                                    <span class="nav-main-link-name">Link 2-2</span>
                                                                </a>
                                                            </li>
                                                            <li class="nav-main-item">
                                                                <a class="nav-main-link nav-main-link-submenu"
                                                                    data-toggle="submenu" aria-haspopup="true"
                                                                    aria-expanded="false"
                                                                    href="https://demo.pixelcave.com/oneui/be_pages_dashboard.html#">
                                                                    <span class="nav-main-link-name">Sub Level 3</span>
                                                                </a>
                                                                <ul class="nav-main-submenu">
                                                                    <li class="nav-main-item">
                                                                        <a class="nav-main-link"
                                                                            href="https://demo.pixelcave.com/oneui/be_pages_dashboard.html#">
                                                                            <span class="nav-main-link-name">Link
                                                                                3-1</span>
                                                                        </a>
                                                                    </li>
                                                                    <li class="nav-main-item">
                                                                        <a class="nav-main-link"
                                                                            href="https://demo.pixelcave.com/oneui/be_pages_dashboard.html#">
                                                                            <span class="nav-main-link-name">Link
                                                                                3-2</span>
                                                                        </a>
                                                                    </li>
                                                                    <li class="nav-main-item">
                                                                        <a class="nav-main-link nav-main-link-submenu"
                                                                            data-toggle="submenu" aria-haspopup="true"
                                                                            aria-expanded="false"
                                                                            href="https://demo.pixelcave.com/oneui/be_pages_dashboard.html#">
                                                                            <span class="nav-main-link-name">Sub Level
                                                                                4</span>
                                                                        </a>
                                                                        <ul class="nav-main-submenu">
                                                                            <li class="nav-main-item">
                                                                                <a class="nav-main-link"
                                                                                    href="https://demo.pixelcave.com/oneui/be_pages_dashboard.html#">
                                                                                    <span
                                                                                        class="nav-main-link-name">Link
                                                                                        4-1</span>
                                                                                </a>
                                                                            </li>
                                                                            <li class="nav-main-item">
                                                                                <a class="nav-main-link"
                                                                                    href="https://demo.pixelcave.com/oneui/be_pages_dashboard.html#">
                                                                                    <span
                                                                                        class="nav-main-link-name">Link
                                                                                        4-2</span>
                                                                                </a>
                                                                            </li>
                                                                            <li class="nav-main-item">
                                                                                <a class="nav-main-link nav-main-link-submenu"
                                                                                    data-toggle="submenu"
                                                                                    aria-haspopup="true"
                                                                                    aria-expanded="false"
                                                                                    href="https://demo.pixelcave.com/oneui/be_pages_dashboard.html#">
                                                                                    <span
                                                                                        class="nav-main-link-name">Sub
                                                                                        Level 5</span>
                                                                                </a>
                                                                                <ul class="nav-main-submenu">
                                                                                    <li class="nav-main-item">
                                                                                        <a class="nav-main-link"
                                                                                            href="https://demo.pixelcave.com/oneui/be_pages_dashboard.html#">
                                                                                            <span
                                                                                                class="nav-main-link-name">Link
                                                                                                5-1</span>
                                                                                        </a>
                                                                                    </li>
                                                                                    <li class="nav-main-item">
                                                                                        <a class="nav-main-link"
                                                                                            href="https://demo.pixelcave.com/oneui/be_pages_dashboard.html#">
                                                                                            <span
                                                                                                class="nav-main-link-name">Link
                                                                                                5-2</span>
                                                                                        </a>
                                                                                    </li>
                                                                                    <li class="nav-main-item">
                                                                                        <a class="nav-main-link nav-main-link-submenu"
                                                                                            data-toggle="submenu"
                                                                                            aria-haspopup="true"
                                                                                            aria-expanded="false"
                                                                                            href="https://demo.pixelcave.com/oneui/be_pages_dashboard.html#">
                                                                                            <span
                                                                                                class="nav-main-link-name">Sub
                                                                                                Level 6</span>
                                                                                        </a>
                                                                                        <ul class="nav-main-submenu">
                                                                                            <li class="nav-main-item">
                                                                                                <a class="nav-main-link"
                                                                                                    href="https://demo.pixelcave.com/oneui/be_pages_dashboard.html#">
                                                                                                    <span
                                                                                                        class="nav-main-link-name">Link
                                                                                                        6-1</span>
                                                                                                </a>
                                                                                            </li>
                                                                                            <li class="nav-main-item">
                                                                                                <a class="nav-main-link"
                                                                                                    href="https://demo.pixelcave.com/oneui/be_pages_dashboard.html#">
                                                                                                    <span
                                                                                                        class="nav-main-link-name">Link
                                                                                                        6-2</span>
                                                                                                </a>
                                                                                            </li>
                                                                                        </ul>
                                                                                    </li>
                                                                                </ul>
                                                                            </li>
                                                                        </ul>
                                                                    </li>
                                                                </ul>
                                                            </li>
                                                        </ul>
                                                    </li>
                                                </ul>
                                            </li>
                                            <li class="nav-main-heading">Pages</li>
                                            <li class="nav-main-item">
                                                <a class="nav-main-link nav-main-link-submenu" data-toggle="submenu"
                                                    aria-haspopup="true" aria-expanded="false"
                                                    href="https://demo.pixelcave.com/oneui/be_pages_dashboard.html#">
                                                    <i class="nav-main-link-icon si si-layers"></i>
                                                    <span class="nav-main-link-name">Generic</span>
                                                </a>
                                                <ul class="nav-main-submenu">
                                                    <li class="nav-main-item">
                                                        <a class="nav-main-link"
                                                            href="https://demo.pixelcave.com/oneui/be_pages_generic_blank.html">
                                                            <span class="nav-main-link-name">Blank</span>
                                                        </a>
                                                    </li>
                                                    <li class="nav-main-item">
                                                        <a class="nav-main-link"
                                                            href="https://demo.pixelcave.com/oneui/be_pages_generic_blank_block.html">
                                                            <span class="nav-main-link-name">Blank with Block</span>
                                                        </a>
                                                    </li>
                                                    <li class="nav-main-item">
                                                        <a class="nav-main-link"
                                                            href="https://demo.pixelcave.com/oneui/be_pages_generic_search.html">
                                                            <span class="nav-main-link-name">Search</span>
                                                        </a>
                                                    </li>
                                                    <li class="nav-main-item">
                                                        <a class="nav-main-link"
                                                            href="https://demo.pixelcave.com/oneui/be_pages_generic_profile.html">
                                                            <span class="nav-main-link-name">Profile</span>
                                                        </a>
                                                    </li>
                                                    <li class="nav-main-item">
                                                        <a class="nav-main-link"
                                                            href="https://demo.pixelcave.com/oneui/be_pages_generic_profile_edit.html">
                                                            <span class="nav-main-link-name">Profile Edit</span>
                                                        </a>
                                                    </li>
                                                    <li class="nav-main-item">
                                                        <a class="nav-main-link"
                                                            href="https://demo.pixelcave.com/oneui/be_pages_generic_inbox.html">
                                                            <span class="nav-main-link-name">Inbox</span>
                                                        </a>
                                                    </li>
                                                    <li class="nav-main-item">
                                                        <a class="nav-main-link"
                                                            href="https://demo.pixelcave.com/oneui/be_pages_generic_invoice.html">
                                                            <span class="nav-main-link-name">Invoice</span>
                                                        </a>
                                                    </li>
                                                    <li class="nav-main-item">
                                                        <a class="nav-main-link"
                                                            href="https://demo.pixelcave.com/oneui/be_pages_generic_pricing_plans.html">
                                                            <span class="nav-main-link-name">Pricing Plans</span>
                                                        </a>
                                                    </li>
                                                    <li class="nav-main-item">
                                                        <a class="nav-main-link"
                                                            href="https://demo.pixelcave.com/oneui/be_pages_generic_faq.html">
                                                            <span class="nav-main-link-name">FAQ</span>
                                                        </a>
                                                    </li>
                                                    <li class="nav-main-item">
                                                        <a class="nav-main-link"
                                                            href="https://demo.pixelcave.com/oneui/be_pages_generic_team.html">
                                                            <span class="nav-main-link-name">Team</span>
                                                        </a>
                                                    </li>
                                                    <li class="nav-main-item">
                                                        <a class="nav-main-link"
                                                            href="https://demo.pixelcave.com/oneui/be_pages_generic_contact.html">
                                                            <span class="nav-main-link-name">Contact</span>
                                                        </a>
                                                    </li>
                                                    <li class="nav-main-item">
                                                        <a class="nav-main-link"
                                                            href="https://demo.pixelcave.com/oneui/be_pages_generic_support.html">
                                                            <span class="nav-main-link-name">Support</span>
                                                        </a>
                                                    </li>
                                                    <li class="nav-main-item">
                                                        <a class="nav-main-link"
                                                            href="https://demo.pixelcave.com/oneui/be_pages_generic_upgrade_plan.html">
                                                            <span class="nav-main-link-name">Upgrade Plan</span>
                                                        </a>
                                                    </li>
                                                    <li class="nav-main-item">
                                                        <a class="nav-main-link"
                                                            href="https://demo.pixelcave.com/oneui/be_pages_sidebar_mini_nav.html">
                                                            <span class="nav-main-link-name">Sidebar with Mini
                                                                Nav</span>
                                                        </a>
                                                    </li>
                                                    <li class="nav-main-item">
                                                        <a class="nav-main-link"
                                                            href="https://demo.pixelcave.com/oneui/be_pages_dashboard_v1.html">
                                                            <span class="nav-main-link-name">Dashboard v1</span>
                                                        </a>
                                                    </li>
                                                    <li class="nav-main-item">
                                                        <a class="nav-main-link"
                                                            href="https://demo.pixelcave.com/oneui/op_maintenance.html">
                                                            <span class="nav-main-link-name">Maintenance</span>
                                                        </a>
                                                    </li>
                                                    <li class="nav-main-item">
                                                        <a class="nav-main-link"
                                                            href="https://demo.pixelcave.com/oneui/op_status.html">
                                                            <span class="nav-main-link-name">Status</span>
                                                        </a>
                                                    </li>
                                                    <li class="nav-main-item">
                                                        <a class="nav-main-link"
                                                            href="https://demo.pixelcave.com/oneui/op_installation.html">
                                                            <span class="nav-main-link-name">Installation</span>
                                                        </a>
                                                    </li>
                                                    <li class="nav-main-item">
                                                        <a class="nav-main-link"
                                                            href="https://demo.pixelcave.com/oneui/op_checkout.html">
                                                            <span class="nav-main-link-name">Checkout</span>
                                                        </a>
                                                    </li>
                                                    <li class="nav-main-item">
                                                        <a class="nav-main-link"
                                                            href="https://demo.pixelcave.com/oneui/op_coming_soon.html">
                                                            <span class="nav-main-link-name">Coming Soon</span>
                                                        </a>
                                                    </li>
                                                </ul>
                                            </li>
                                            <li class="nav-main-item">
                                                <a class="nav-main-link nav-main-link-submenu" data-toggle="submenu"
                                                    aria-haspopup="true" aria-expanded="false"
                                                    href="https://demo.pixelcave.com/oneui/be_pages_dashboard.html#">
                                                    <i class="nav-main-link-icon si si-lock"></i>
                                                    <span class="nav-main-link-name">Authentication</span>
                                                </a>
                                                <ul class="nav-main-submenu">
                                                    <li class="nav-main-item">
                                                        <a class="nav-main-link"
                                                            href="https://demo.pixelcave.com/oneui/be_pages_auth_all.html">
                                                            <span class="nav-main-link-name">All</span>
                                                        </a>
                                                    </li>
                                                    <li class="nav-main-item">
                                                        <a class="nav-main-link"
                                                            href="https://demo.pixelcave.com/oneui/op_auth_signin.html">
                                                            <span class="nav-main-link-name">Sign In</span>
                                                        </a>
                                                    </li>
                                                    <li class="nav-main-item">
                                                        <a class="nav-main-link"
                                                            href="https://demo.pixelcave.com/oneui/op_auth_signin2.html">
                                                            <span class="nav-main-link-name">Sign In 2</span>
                                                        </a>
                                                    </li>
                                                    <li class="nav-main-item">
                                                        <a class="nav-main-link"
                                                            href="https://demo.pixelcave.com/oneui/op_auth_signin3.html">
                                                            <span class="nav-main-link-name">Sign In 3</span>
                                                        </a>
                                                    </li>
                                                    <li class="nav-main-item">
                                                        <a class="nav-main-link"
                                                            href="https://demo.pixelcave.com/oneui/op_auth_signup.html">
                                                            <span class="nav-main-link-name">Sign Up</span>
                                                        </a>
                                                    </li>
                                                    <li class="nav-main-item">
                                                        <a class="nav-main-link"
                                                            href="https://demo.pixelcave.com/oneui/op_auth_signup2.html">
                                                            <span class="nav-main-link-name">Sign Up 2</span>
                                                        </a>
                                                    </li>
                                                    <li class="nav-main-item">
                                                        <a class="nav-main-link"
                                                            href="https://demo.pixelcave.com/oneui/op_auth_signup3.html">
                                                            <span class="nav-main-link-name">Sign Up 3</span>
                                                        </a>
                                                    </li>
                                                    <li class="nav-main-item">
                                                        <a class="nav-main-link"
                                                            href="https://demo.pixelcave.com/oneui/op_auth_lock.html">
                                                            <span class="nav-main-link-name">Lock Screen</span>
                                                        </a>
                                                    </li>
                                                    <li class="nav-main-item">
                                                        <a class="nav-main-link"
                                                            href="https://demo.pixelcave.com/oneui/op_auth_lock2.html">
                                                            <span class="nav-main-link-name">Lock Screen 2</span>
                                                        </a>
                                                    </li>
                                                    <li class="nav-main-item">
                                                        <a class="nav-main-link"
                                                            href="https://demo.pixelcave.com/oneui/op_auth_lock3.html">
                                                            <span class="nav-main-link-name">Lock Screen 3</span>
                                                        </a>
                                                    </li>
                                                    <li class="nav-main-item">
                                                        <a class="nav-main-link"
                                                            href="https://demo.pixelcave.com/oneui/op_auth_reminder.html">
                                                            <span class="nav-main-link-name">Pass Reminder</span>
                                                        </a>
                                                    </li>
                                                    <li class="nav-main-item">
                                                        <a class="nav-main-link"
                                                            href="https://demo.pixelcave.com/oneui/op_auth_reminder2.html">
                                                            <span class="nav-main-link-name">Pass Reminder 2</span>
                                                        </a>
                                                    </li>
                                                    <li class="nav-main-item">
                                                        <a class="nav-main-link"
                                                            href="https://demo.pixelcave.com/oneui/op_auth_reminder3.html">
                                                            <span class="nav-main-link-name">Pass Reminder 3</span>
                                                        </a>
                                                    </li>
                                                    <li class="nav-main-item">
                                                        <a class="nav-main-link"
                                                            href="https://demo.pixelcave.com/oneui/op_auth_two_factor.html">
                                                            <span class="nav-main-link-name">Two Factor</span>
                                                        </a>
                                                    </li>
                                                    <li class="nav-main-item">
                                                        <a class="nav-main-link"
                                                            href="https://demo.pixelcave.com/oneui/op_auth_two_factor2.html">
                                                            <span class="nav-main-link-name">Two Factor 2</span>
                                                        </a>
                                                    </li>
                                                    <li class="nav-main-item">
                                                        <a class="nav-main-link"
                                                            href="https://demo.pixelcave.com/oneui/op_auth_two_factor3.html">
                                                            <span class="nav-main-link-name">Two Factor 3</span>
                                                        </a>
                                                    </li>
                                                </ul>
                                            </li>
                                            <li class="nav-main-item">
                                                <a class="nav-main-link nav-main-link-submenu" data-toggle="submenu"
                                                    aria-haspopup="true" aria-expanded="false"
                                                    href="https://demo.pixelcave.com/oneui/be_pages_dashboard.html#">
                                                    <i class="nav-main-link-icon si si-fire"></i>
                                                    <span class="nav-main-link-name">Error Pages</span>
                                                </a>
                                                <ul class="nav-main-submenu">
                                                    <li class="nav-main-item">
                                                        <a class="nav-main-link"
                                                            href="https://demo.pixelcave.com/oneui/be_pages_error_all.html">
                                                            <span class="nav-main-link-name">All</span>
                                                        </a>
                                                    </li>
                                                    <li class="nav-main-item">
                                                        <a class="nav-main-link"
                                                            href="https://demo.pixelcave.com/oneui/op_error_400.html">
                                                            <span class="nav-main-link-name">400</span>
                                                        </a>
                                                    </li>
                                                    <li class="nav-main-item">
                                                        <a class="nav-main-link"
                                                            href="https://demo.pixelcave.com/oneui/op_error_401.html">
                                                            <span class="nav-main-link-name">401</span>
                                                        </a>
                                                    </li>
                                                    <li class="nav-main-item">
                                                        <a class="nav-main-link"
                                                            href="https://demo.pixelcave.com/oneui/op_error_403.html">
                                                            <span class="nav-main-link-name">403</span>
                                                        </a>
                                                    </li>
                                                    <li class="nav-main-item">
                                                        <a class="nav-main-link"
                                                            href="https://demo.pixelcave.com/oneui/op_error_404.html">
                                                            <span class="nav-main-link-name">404</span>
                                                        </a>
                                                    </li>
                                                    <li class="nav-main-item">
                                                        <a class="nav-main-link"
                                                            href="https://demo.pixelcave.com/oneui/op_error_500.html">
                                                            <span class="nav-main-link-name">500</span>
                                                        </a>
                                                    </li>
                                                    <li class="nav-main-item">
                                                        <a class="nav-main-link"
                                                            href="https://demo.pixelcave.com/oneui/op_error_503.html">
                                                            <span class="nav-main-link-name">503</span>
                                                        </a>
                                                    </li>
                                                </ul>
                                            </li>
                                            <li class="nav-main-item">
                                                <a class="nav-main-link nav-main-link-submenu" data-toggle="submenu"
                                                    aria-haspopup="true" aria-expanded="false"
                                                    href="https://demo.pixelcave.com/oneui/be_pages_dashboard.html#">
                                                    <i class="nav-main-link-icon si si-cup"></i>
                                                    <span class="nav-main-link-name">Get Started</span>
                                                </a>
                                                <ul class="nav-main-submenu">
                                                    <li class="nav-main-item">
                                                        <a class="nav-main-link"
                                                            href="https://demo.pixelcave.com/oneui/gs_backend.html">
                                                            <span class="nav-main-link-name">Backend</span>
                                                        </a>
                                                    </li>
                                                    <li class="nav-main-item">
                                                        <a class="nav-main-link"
                                                            href="https://demo.pixelcave.com/oneui/gs_backend_boxed.html">
                                                            <span class="nav-main-link-name">Backend Boxed</span>
                                                        </a>
                                                    </li>
                                                    <li class="nav-main-item">
                                                        <a class="nav-main-link"
                                                            href="https://demo.pixelcave.com/oneui/gs_landing.html">
                                                            <span class="nav-main-link-name">Landing</span>
                                                        </a>
                                                    </li>
                                                    <li class="nav-main-item">
                                                        <a class="nav-main-link"
                                                            href="https://demo.pixelcave.com/oneui/gs_rtl_backend.html">
                                                            <span class="nav-main-link-name">RTL Backend</span>
                                                        </a>
                                                    </li>
                                                    <li class="nav-main-item">
                                                        <a class="nav-main-link"
                                                            href="https://demo.pixelcave.com/oneui/gs_rtl_backend_boxed.html">
                                                            <span class="nav-main-link-name">RTL Backend Boxed</span>
                                                        </a>
                                                    </li>
                                                    <li class="nav-main-item">
                                                        <a class="nav-main-link"
                                                            href="https://demo.pixelcave.com/oneui/gs_rtl_landing.html">
                                                            <span class="nav-main-link-name">RTL Landing</span>
                                                        </a>
                                                    </li>
                                                </ul>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="simplebar-placeholder" style="width: 250px; height: 735px;"></div>
                </div>
                <div class="simplebar-track simplebar-horizontal" style="visibility: hidden;">
                    <div class="simplebar-scrollbar" style="width: 0px; display: none;"></div>
                </div>
                <div class="simplebar-track simplebar-vertical" style="visibility: visible;">
                    <div class="simplebar-scrollbar"
                        style="height: 243px; display: block; transform: translate3d(0px, 0px, 0px);"></div>
                </div>
            </div>
        </nav>
        <header id="page-header">
            <div class="content-header">
                <div class="d-flex align-items-center">
                    <button type="button" class="btn btn-sm btn-alt-secondary me-2 d-lg-none"
                        data-toggle="layout" data-action="sidebar_toggle">
                        <i class="fa fa-fw fa-bars"></i>
                    </button>
                    <button type="button" class="btn btn-sm btn-alt-secondary d-md-none" data-toggle="layout"
                        data-action="header_search_on">
                        <i class="fa fa-fw fa-search"></i>
                    </button>
                    <form class="d-none d-md-inline-block"
                        action="https://demo.pixelcave.com/oneui/be_pages_generic_search.html" method="POST">
                        <div class="input-group input-group-sm">
                            <input type="text" class="form-control form-control-alt" placeholder="Search.."
                                id="page-header-search-input2" name="page-header-search-input2">
                            <span class="input-group-text border-0">
                                <i class="fa fa-fw fa-search"></i>
                            </span>
                        </div>
                    </form>
                </div>
                <div class="d-flex align-items-center">
                    <div class="dropdown d-inline-block ms-2">
                        <button type="button" class="btn btn-sm btn-alt-secondary d-flex align-items-center"
                            id="page-header-user-dropdown" data-bs-toggle="dropdown" aria-haspopup="true"
                            aria-expanded="false">
                            <img class="rounded-circle" src="./cheking-sidebar_files/avatar10.jpg"
                                alt="Header Avatar" style="width: 21px;">
                            <span class="d-none d-sm-inline-block ms-2">John</span>
                            <i class="fa fa-fw fa-angle-down d-none d-sm-inline-block opacity-50 ms-1 mt-1"></i>
                        </button>
                        <div class="dropdown-menu dropdown-menu-md dropdown-menu-end p-0 border-0"
                            aria-labelledby="page-header-user-dropdown">
                            <div class="p-3 text-center bg-body-light border-bottom rounded-top">
                                <img class="img-avatar img-avatar48 img-avatar-thumb"
                                    src="./cheking-sidebar_files/avatar10.jpg" alt="">
                                <p class="mt-2 mb-0 fw-medium">John Smith</p>
                                <p class="mb-0 text-muted fs-sm fw-medium">Web Developer</p>
                            </div>
                            <div class="p-2">
                                <a class="dropdown-item d-flex align-items-center justify-content-between"
                                    href="https://demo.pixelcave.com/oneui/be_pages_generic_inbox.html">
                                    <span class="fs-sm fw-medium">Inbox</span>
                                    <span class="badge rounded-pill bg-primary ms-2">3</span>
                                </a>
                                <a class="dropdown-item d-flex align-items-center justify-content-between"
                                    href="https://demo.pixelcave.com/oneui/be_pages_generic_profile.html">
                                    <span class="fs-sm fw-medium">Profile</span>
                                    <span class="badge rounded-pill bg-primary ms-2">1</span>
                                </a>
                                <a class="dropdown-item d-flex align-items-center justify-content-between"
                                    href="javascript:void(0)">
                                    <span class="fs-sm fw-medium">Settings</span>
                                </a>
                            </div>
                            <div role="separator" class="dropdown-divider m-0"></div>
                            <div class="p-2">
                                <a class="dropdown-item d-flex align-items-center justify-content-between"
                                    href="https://demo.pixelcave.com/oneui/op_auth_lock.html">
                                    <span class="fs-sm fw-medium">Lock Account</span>
                                </a>
                                <a class="dropdown-item d-flex align-items-center justify-content-between"
                                    href="https://demo.pixelcave.com/oneui/op_auth_signin.html">
                                    <span class="fs-sm fw-medium">Log Out</span>
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="dropdown d-inline-block ms-2">
                        <button type="button" class="btn btn-sm btn-alt-secondary"
                            id="page-header-notifications-dropdown" data-bs-toggle="dropdown" aria-haspopup="true"
                            aria-expanded="false">
                            <i class="fa fa-fw fa-bell"></i>
                            <span class="text-primary">•</span>
                        </button>
                        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-end p-0 border-0 fs-sm"
                            aria-labelledby="page-header-notifications-dropdown">
                            <div class="p-2 bg-body-light border-bottom text-center rounded-top">
                                <h5 class="dropdown-header text-uppercase">Notifications</h5>
                            </div>
                            <ul class="nav-items mb-0">
                                <li>
                                    <a class="text-dark d-flex py-2" href="javascript:void(0)">
                                        <div class="flex-shrink-0 me-2 ms-3">
                                            <i class="fa fa-fw fa-check-circle text-success"></i>
                                        </div>
                                        <div class="flex-grow-1 pe-2">
                                            <div class="fw-semibold">You have a new follower</div>
                                            <span class="fw-medium text-muted">15 min ago</span>
                                        </div>
                                    </a>
                                </li>
                                <li>
                                    <a class="text-dark d-flex py-2" href="javascript:void(0)">
                                        <div class="flex-shrink-0 me-2 ms-3">
                                            <i class="fa fa-fw fa-plus-circle text-primary"></i>
                                        </div>
                                        <div class="flex-grow-1 pe-2">
                                            <div class="fw-semibold">1 new sale, keep it up</div>
                                            <span class="fw-medium text-muted">22 min ago</span>
                                        </div>
                                    </a>
                                </li>
                                <li>
                                    <a class="text-dark d-flex py-2" href="javascript:void(0)">
                                        <div class="flex-shrink-0 me-2 ms-3">
                                            <i class="fa fa-fw fa-times-circle text-danger"></i>
                                        </div>
                                        <div class="flex-grow-1 pe-2">
                                            <div class="fw-semibold">Update failed, restart server</div>
                                            <span class="fw-medium text-muted">26 min ago</span>
                                        </div>
                                    </a>
                                </li>
                                <li>
                                    <a class="text-dark d-flex py-2" href="javascript:void(0)">
                                        <div class="flex-shrink-0 me-2 ms-3">
                                            <i class="fa fa-fw fa-plus-circle text-primary"></i>
                                        </div>
                                        <div class="flex-grow-1 pe-2">
                                            <div class="fw-semibold">2 new sales, keep it up</div>
                                            <span class="fw-medium text-muted">33 min ago</span>
                                        </div>
                                    </a>
                                </li>
                                <li>
                                    <a class="text-dark d-flex py-2" href="javascript:void(0)">
                                        <div class="flex-shrink-0 me-2 ms-3">
                                            <i class="fa fa-fw fa-user-plus text-success"></i>
                                        </div>
                                        <div class="flex-grow-1 pe-2">
                                            <div class="fw-semibold">You have a new subscriber</div>
                                            <span class="fw-medium text-muted">41 min ago</span>
                                        </div>
                                    </a>
                                </li>
                                <li>
                                    <a class="text-dark d-flex py-2" href="javascript:void(0)">
                                        <div class="flex-shrink-0 me-2 ms-3">
                                            <i class="fa fa-fw fa-check-circle text-success"></i>
                                        </div>
                                        <div class="flex-grow-1 pe-2">
                                            <div class="fw-semibold">You have a new follower</div>
                                            <span class="fw-medium text-muted">42 min ago</span>
                                        </div>
                                    </a>
                                </li>
                            </ul>
                            <div class="p-2 border-top text-center">
                                <a class="d-inline-block fw-medium" href="javascript:void(0)">
                                    <i class="fa fa-fw fa-arrow-down me-1 opacity-50"></i> Load More..
                                </a>
                            </div>
                        </div>
                    </div>
                    <button type="button" class="btn btn-sm btn-alt-secondary ms-2" data-toggle="layout"
                        data-action="side_overlay_toggle">
                        <i class="fa fa-fw fa-list-ul fa-flip-horizontal"></i>
                    </button>
                </div>
            </div>
            <div id="page-header-search" class="overlay-header bg-body-extra-light">
                <div class="content-header">
                    <form class="w-100" action="https://demo.pixelcave.com/oneui/be_pages_generic_search.html"
                        method="POST">
                        <div class="input-group">
                            <button type="button" class="btn btn-alt-danger" data-toggle="layout"
                                data-action="header_search_off">
                                <i class="fa fa-fw fa-times-circle"></i>
                            </button>
                            <input type="text" class="form-control" placeholder="Search or hit ESC.."
                                id="page-header-search-input" name="page-header-search-input">
                        </div>
                    </form>
                </div>
            </div>
            <div id="page-header-loader" class="overlay-header bg-body-extra-light">
                <div class="content-header">
                    <div class="w-100 text-center">
                        <i class="fa fa-fw fa-circle-notch fa-spin"></i>
                    </div>
                </div>
            </div>
        </header>
        <!-- END Header -->

        <!-- Main Container -->
        <main id="main-container">
            @yield('content')
        </main>
    </div>

    <script src="{{ asset('theme/js/oneui.app.min.js') }}"></script>
    <!-- Page JS Code -->
    <script src="{{ url('theme/js/pages/be_tables_datatables.min.js') }}"></script>
    @php
        $flash = request()
            ->session()
            ->get('flash_data');
        $message = '';
        $status = false;

        if ($flash) {
            $notification_class = $flash['status'] ? 'success' : 'danger';
            $message = $flash['message'];
            $status = $flash['status'];
        } elseif ($errors->any()) {
            $notification_class = 'danger';

            foreach ($errors->all() as $error) {
                $message .= "<span>$error</span><br>";
            }
        }

        $flashData = [];

        if ($message) {
            $flashData = [
                'class' => $notification_class,
                'message' => $message,
            ];
        }
    @endphp
    <script>
        let show_alert = JSON.parse('{!! isset($flashData) ? json_encode($flashData) : json_encode([]) !!}');
    </script>
    <!-- END Page Container -->
</body>
</html>
