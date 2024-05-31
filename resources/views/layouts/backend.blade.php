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
    {{-- <link rel="stylesheet" id="css-main" href="{{ asset('theme/css/oneui.min.css') }}"> --}}
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
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <style type="text/css" scoped>
        @import "https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700";
        body {
            font-family: 'Poppins', sans-serif;
        }
        a,
        a:hover,
        a:focus {
            color: inherit;
            text-decoration: none;
            transition: all 0.3s;
        }

        .navbar {
            padding: 15px 10px;
            background: #fff;
            border: none;
            border-radius: 0;
            margin-bottom: 40px;
            box-shadow: 1px 1px 3px rgba(0, 0, 0, 0.1);
        }

        /* ---------------------------------------------------
            SIDEBAR STYLE
        ----------------------------------------------------- */

        .wrapper {
            display: flex;
            width: 100%;
            align-items: stretch;
        }

        #sidebar {
            min-width: 250px;
            max-width: 250px;
            background: rgba(50, 53, 93, 0.9);
            color: #fff;
            transition: all 0.3s;
        }

        #sidebar.active {
            margin-left: -250px;
        }

        #sidebar .sidebar-header {
            padding: 22px;
            background: rgba(50, 53, 93, 0.9);
        }

        #sidebar ul li a {
            padding: 12px;
            padding-left: 22px;
            display: block;
        }

        #sidebar ul li a:hover {
            color: #7386D5;
            background: #fff;
        }

        #sidebar ul li.active>a,
        a[aria-expanded="true"] {
            color: #fff;
            background: #6d7fcc;
        }

        #content {
            width: 100%;
            min-height: 100vh;
            transition: all 0.3s;
        }

        @media (max-width: 768px) {
            #sidebar {
                margin-left: -250px;
            }
            #sidebar.active {
                margin-left: 0;
            }
            #sidebarCollapse span {
                display: none;
            }
        }
    </style>

    {{-- @vite(['resources/sass/main.scss', 'resources/js/oneui/app.js']) --}}

    <!-- Alternatively, you can also include a specific color theme after the main stylesheet to alter the default color theme of the template -->
    {{-- @vite(['resources/sass/main.scss', 'resources/sass/oneui/themes/amethyst.scss', 'resources/js/oneui/app.js']) --}}
    <script src="{{ asset('js/lib/jquery.min.js') }}"></script>
    <script>
        const base = "{!! url(config('app.admin_prefix')) !!}";
    </script>
    {{-- datatables cdn start --}}
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
    {{-- <script src="{{ asset('theme/js/oneui.app.min.js') }}"></script> --}}
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
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

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

    <div class="wrapper">
        <!-- Sidebar  -->
        <nav id="sidebar">
            <div class="sidebar-header">
                <h4 >Maheshwari Dharamshala</h4>
            </div>
            <div class="text-start">
                <ul class="navbar-nav justify-content-end flex-grow-1 ">
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
        </nav>

        <!-- Page Content  -->
        <div id="content">
            <nav class="navbar navbar-expand-lg navbar-light" style="background-color: rgba(50, 53, 93, 0.9);">
                <div class="container-fluid">
                    <button type="button" id="sidebarCollapse" class="btn btn-dark">
                        <i class="fa fa-caret-right"></i>
                    </button>
                    <!-- User Dropdown -->
                    <div class="dropstart d-inline-block ms-2">
                        <button type="button" class="btn btn-sm btn-light d-flex align-items-center"
                            id="page-header-user-dropdown" data-toggle="dropdown" aria-haspopup="true"
                            aria-expanded="false">
                            <img class="rounded-circle" src="{{ asset('media/avatars/avatar10.jpg') }}"
                                alt="Header Avatar" style="width: 21px;">
                            <span
                                class="d-none d-sm-inline-block ms-2 text-capitalize">{{ auth('sanctum')->user()->name ?? 'Guest' }}</span>
                            <i class="fa fa-fw fa-angle-down d-none d-sm-inline-block ms-1 mt-1"></i>
                        </button>
                        <div class="dropdown-menu dropdown-menu-md dropdown-menu-start p-0 border-0"
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
                </div>
                <!-- Please check out the Loaders page under Components category to see examples of showing/hiding it -->
                {{-- <div id="page-header-loader" class="overlay-header bg-body-extra-light">
                    <div class="content-header">
                        <div class="w-100 text-center">
                            <i class="fa fa-fw fa-circle-notch fa-spin"></i>
                        </div>
                    </div>
                </div> --}}
                <!-- END Header Loader -->
            </nav>

            <!-- Main Container -->
            <main id="main-container">
                @yield('content')
            </main>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        $(document).ready(function () {
            $('#sidebarCollapse').on('click', function () {
                $('#sidebar').toggleClass('active');
            });
        });
    </script>

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
