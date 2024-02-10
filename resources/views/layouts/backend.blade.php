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
    {{-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous"> --}}
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
    {{-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script> --}}
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
    <script src="{{ asset('theme/js/oneui.app.min.js') }}"></script>
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
        <!-- Side Overlay-->
        <!-- Side Overlay-->
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
        <nav id="sidebar" class="" aria-label="Main Navigation" >
            <!-- Side Header -->
            <div class="content-header d-flex justify-content-center " style="background-color: rgba(50, 53, 93, 0.9); color:white;">
                <!-- Logo -->
                <a class="font-semibold text-dual mt-4" href="{{ url(config('app.admin_prefix')) }}">
                    <span class="smini-visible">
                        <i class="fa fa-circle-notch text-primary"></i>
                    </span>
                    <!-- <span class="smini-hide fs-5 tracking-wider">{{ config('app.app_name') }}</span> -->
                    <span class="text-center fw-bolder">
                        {{-- <img class="" src="{{ asset('media/logo.png') }}" alt="Header Avatar"
                            style="width: 100px;height:80px"> --}}
                            <h6 class="text-white">Maheshwari Dharamshala</h6>
                    </span>
                </a>
                <!-- END Logo -->
            </div>
            <!-- END Side Header -->

            <!-- Sidebar Scrolling -->
            <div class="js-sidebar-scroll" style="background-color: rgba(50, 53, 93, 0.9); color:white;">
                <!-- Side Navigation -->
                <div class="content-side ">
                    <ul class="nav-main">

                        @foreach ($parentMenus as $parentMenu)
                            @php
                                if ($parentMenu->is_active == 0) {
                                    continue;
                                }
                                $otherClass = count($parentMenu->childMenus) ? '' : '';
                                $otherSubClass = count($parentMenu->childMenus) ? 'nav-main-link-submenu' : '';
                                $otherAttributes = count($parentMenu->childMenus) ? "data-toggle='submenu' aria-haspopup='true' aria-expanded='false'" : '';

                                $menu_arr = $parentMenu->toArray();
                                $parentMenuOpen = '';
                                if (isset($menu_arr['child_menus']) && !empty(isset($menu_arr['child_menus']))) {
                                    foreach ($menu_arr['child_menus'] as $cm) {
                                        if (str_contains($routePrefix, $cm['menu_href'])) {
                                            $parentMenuOpen = 'open';
                                        }
                                    }
                                }

                            @endphp

                            <li class="nav-main-item text-capitalize {{ $parentMenuOpen }} {{ $otherClass }}" >
                                <a class=" nav-main-link {{ in_array(config('app.admin_prefix') . $parentMenu['menu_href'], [$routePrefix, $parentRoute]) ? 'active' : '' }} {{ $otherSubClass }}"
                                    href="{{ $parentMenu['menu_href'] ? url(config('app.admin_prefix') . $parentMenu['menu_href']) : '#' }}"
                                    {!! $otherAttributes !!}>
                                    {!! $parentMenu['menu_icon'] !!}
                                    <span class="nav-main-link-name mx-2">{{ $parentMenu['menu_placeholder'] }}</span>
                                </a>

                                @if (count($parentMenu->childMenus))
                                    <ul class="nav-main-submenu">
                                        @foreach ($parentMenu->childMenus as $childMenu)
                                            <!-- if($role_id==1 && ($childMenu->id==14 || $childMenu->id==15))
                                                continue
                                            endif -->
                                            @if ($childMenu->is_active == 0)
                                                @continue;
                                            @endif
                                            @php
                                                $is_active_menu = config('app.admin_prefix') . $childMenu['menu_href'] == $routePrefix ? 'active' : '';
                                            @endphp
                                            <li class="nav-main-item">
                                                <a class="nav-main-link {{ $is_active_menu }} "
                                                    href="{{ url(config('app.admin_prefix') . $childMenu['menu_href']) }}">
                                                    <span
                                                        class="nav-main-link-name">{{ $childMenu['menu_placeholder'] }}</span>
                                                </a>
                                            </li>
                                        @endforeach
                                    </ul>
                                @endif
                            </li>
                        @endforeach
                    </ul>
                </div>
                <!-- END Side Navigation -->
            </div>
            <!-- END Sidebar Scrolling -->
        </nav>
        <!-- END Sidebar -->
        <!-- Header -->
        <header id="page-header">
            <!-- Header Content -->
            <div class="content-header w-100" style="background-color: rgba(50, 53, 93, 0.9); color:white;">
                <!-- Left Section -->
                <div class="d-flex align-items-center">
                    <!-- Toggle Sidebar -->
                    <!-- Layout API, functionality initialized in Template._uiApiLayout()-->
                    <button type="button" class="btn btn-sm btn-alt-secondary me-2 d-lg-none" data-toggle="layout"
                    data-action="sidebar_toggle">
                        <i class="fa fa-fw fa-bars"></i>
                    </button>
                    <!-- END Toggle Sidebar -->
                </div>
                <!-- END Left Section -->

                <!-- Right Section -->
                <div class="d-flex align-items-center">
                    <!-- User Dropdown -->
                    <div class="dropdown d-inline-block ms-2">
                        <button type="button" class="btn btn-sm btn-alt-secondary d-flex align-items-center"
                            id="page-header-user-dropdown" data-bs-toggle="dropdown" aria-haspopup="true"
                            aria-expanded="false">
                            <img class="rounded-circle" src="{{ asset('media/avatars/avatar10.jpg') }}"
                                alt="Header Avatar" style="width: 21px;">
                            <span
                                class="d-none d-sm-inline-block ms-2 text-capitalize">{{ auth('sanctum')->user()->name ?? 'Guest' }}</span>
                            <i class="fa fa-fw fa-angle-down d-none d-sm-inline-block ms-1 mt-1"></i>
                        </button>
                        <div class="dropdown-menu dropdown-menu-md dropdown-menu-end p-0 border-0"
                            aria-labelledby="page-header-user-dropdown">
                            {{-- <div role="separator" class="dropdown-divider m-0"></div> --}}
                            {{-- <div class="p-2"> --}}

                            @can('update-profile', 'user')
                                <a class="dropdown-item" href="{{ route('update-profile') }}">
                                    <i class="fa-solid fa-user-pen"></i> <span class="fs-sm fw-medium mx-2">Update
                                        Profile</span>
                                </a>
                            @endCan

                            <a class="dropdown-item" href="{{ url(config('app.admin_prefix') . 'logout') }}">
                                <i class="fa-solid fa-right-from-bracket"></i> <span class="fs-sm fw-medium mx-2">Log
                                    Out</span>
                            </a>
                            {{-- </div> --}}
                        </div>
                    </div>
                    <!-- END User Dropdown -->

                    <!-- Notifications Dropdown -->
                    {{-- <div class="dropdown d-inline-block ms-2">
                        <button type="button" class="btn btn-sm btn-alt-secondary" id="page-header-notifications-dropdown" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="fa fa-fw fa-bell"></i>
                        <span class="text-primary">•</span>
                        </button>
                    </div> --}}
                    <!-- END Notifications Dropdown -->

                    <!-- Toggle Side Overlay -->
                    <!-- Layout API, functionality initialized in Template._uiApiLayout() -->
                    {{-- <button type="button" class="btn btn-sm btn-alt-secondary ms-2" data-toggle="layout" data-action="side_overlay_toggle">
                        <i class="fa fa-fw fa-list-ul fa-flip-horizontal"></i>
                    </button> --}}
                    <!-- END Toggle Side Overlay -->
                </div>
                <!-- END Right Section -->
            </div>
            <!-- Header content -->
            <!-- Please check out the Loaders page under Components category to see examples of showing/hiding it -->
            <div id="page-header-loader" class="overlay-header bg-body-extra-light">
                <div class="content-header">
                    <div class="w-100 text-center">
                        <i class="fa fa-fw fa-circle-notch fa-spin"></i>
                    </div>
                </div>
            </div>
            <!-- END Header Loader -->
        </header>
        <!-- END Header -->


        <!-- Main Container -->
        <main id="main-container">
            @yield('content')
        </main>
    </div>
    <!-- footer starts -->
    <div class="footer py-3 fixed-bottom"  style="background-color:rgba(50, 53, 93, 0.9) ;">
        <!--begin::Container-->
        <div class="container-fluid d-flex flex-column flex-md-row align-items-center justify-content-center">
            <!--begin::Copyright-->
            <div class="">
                <span class="text-white  me-1 ">© 2022 Developed by</span>
                <a href="maheshinfotech.in" target="_blank" class="text-white ">Mahesh Infotech</a>
            </div>
            <!--end::Copyright-->
        </div>
        <!--end::Container-->
    </div>
    <!--footer ends -->

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
