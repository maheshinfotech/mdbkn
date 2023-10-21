<!DOCTYPE html>

<html lang="en-US">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="author" content="ThemeStarz">

    <link href="{{ asset('front-site/fonts/font-awesome.css') }}" rel="stylesheet" type="text/css">

    <link href="{{ asset('front-site/fonts/elegant-fonts.css') }}" rel="stylesheet" type="text/css">

    <link href='https://fonts.googleapis.com/css?family=Lato:400,300,700,900,400italic' rel='stylesheet'
        type='text/css'>

    <link rel="stylesheet" href="{{ asset('front-site/bootstrap/css/bootstrap.css') }}" type="text/css">

    <link rel="stylesheet" href="{{ asset('front-site/css/zabuto_calendar.min.css') }}" type="text/css">

    <link rel="stylesheet" href="{{ asset('front-site/css/owl.carousel.css') }}" type="text/css">

    <link rel="stylesheet" href="{{ asset('front-site/css/trackpad-scroll-emulator.css') }}" type="text/css">

    <link rel="stylesheet" href="{{ asset('front-site/css/style.css') }}" type="text/css">

    <title>{{ config('app.app_name') }}-{{ $pageName ?? '' }}</title>

</head>

<body class="homepage">
    <div class="page-wrapper">
        <header id="page-header">
            <nav>
                <div class="left">
                    <a href-p="index.html" class="brand"><img src="{{ asset('front-site/img/logo.png') }}"
                            alt=""></a>
                </div>
                <!--end left-->
                <div class="right">
                    <div class="primary-nav has-mega-menu">
                        <ul class="navigation">
                            <li class="active "><a href="{{ url(config('app.front_prefix') . 'home') }}">Home</a>
                                {{-- <div class="wrapper">
                                    <div id="nav-homepages" class="nav-wrapper">
                                        <ul>
                                            <li><a href="index-map-version-1.html">Map Full Screen Sidebar Results</a>
                                            </li>
                                            <li><a href="index-map-version-2.html">Map Horizontal Form</a></li>
                                            <li><a href="index-map-version-3.html">Map Full Screen Form in Sidebar</a>
                                            </li>
                                            <li><a href="index-map-version-4.html">Map Form Under</a></li>
                                            <li><a href="index-map-version-5.html">Map Sidebar Grid</a></li>
                                            <li><a href="index-map-version-6.html">Map Full Screen Collapse Form</a>
                                            </li>
                                            <li><a href="index-hero-version-1.html">Hero One Input Form</a></li>
                                            <li><a href="index-hero-version-2.html">Hero Multiple Inputs</a></li>
                                            <li><a href="index-hero-version-3.html">Hero Form Under</a></li>
                                            <li><a href="index-hero-version-4.html">Hero Full Screen Slider</a></li>
                                            <li><a href="index-hero-version-5.html">Hero Coupon Slider</a></li>
                                            <li><a href="index-hero-version-6.html">Hero Interactive Slider</a></li>
                                        </ul>
                                    </div>
                                </div> --}}
                            </li>

                            {{-- <li class="has-child"><a href="#nav-listing">Listing</a>
                                <div class="wrapper">
                                    <div id="nav-listing" class="nav-wrapper">
                                        <ul>
                                            <li class="has-child"><a href="#nav-grid-listing">Grid Listing</a>
                                                <div id="nav-grid-listing" class="nav-wrapper">
                                                    <ul>
                                                        <li><a href="listing-grid-right-sidebar.html">With Right
                                                                Sidebar</a></li>
                                                        <li><a href="listing-grid-left-sidebar.html">With Left
                                                                Sidebar</a></li>
                                                        <li><a href="listing-grid-full-width.html">Full Width</a></li>
                                                        <li><a href="listing-grid-different-widths.html">Different
                                                                Widths</a></li>
                                                        <li><a href="listing-grid-3-items.html">3 Items in Row</a></li>
                                                        <li><a href="listing-grid-4-items.html">4 Items in Row</a></li>
                                                    </ul>
                                                </div>
                                            </li>
                                            <li class="has-child"><a href="#nav-row-listing">Row Listing</a>
                                                <div id="nav-row-listing" class="nav-wrapper">
                                                    <ul>
                                                        <li><a href="listing-row-right-sidebar.html">Row Right
                                                                Sidebar</a></li>
                                                        <li><a href="listing-row-left-sidebar.html">Row Left Sidebar</a>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </li>
                            <li class="mega-menu-parent has-child"><a href="#nav-pages">Pages</a>
                                <div class="wrapper">
                                    <div class="mega-menu">
                                        <div class="nav-wrapper" id="nav-pages">
                                            <div class="container">
                                                <div class="row">
                                                    <div class="col-md-3 col-sm-3">
                                                        <h4 class="heading">General</h4>
                                                        <ul>
                                                            <li><a href="faq.html">Faq</a></li>
                                                            <li><a href="pricing.html">Pricing</a></li>
                                                            <li><a href="submit.html">Submit Listing</a></li>
                                                            <li><a href="detail.html">Listing Detail</a></li>
                                                            <li><a href="detail-2.html">Listing Detail v2</a></li>
                                                            <li><a href="agents-listing.html">Agents Listing</a></li>
                                                            <li><a href="agent-detail.html">Agent Detail</a></li>
                                                        </ul>
                                                    </div>
                                                    <!--end col-md-3-->
                                                    <div class="col-md-3 col-sm-3">
                                                        <h4 class="heading">User</h4>
                                                        <ul>
                                                            <li><a href="profile.html">Profile Edit</a></li>
                                                            <li><a href="sign-in.html">Sign In</a></li>
                                                            <li><a href="register.html">Register</a></li>
                                                            <li><a href="reset-password.html">Reset Password</a></li>
                                                            <li><a href="my-listings.html">My Listings</a></li>
                                                            <li><a href="edit-listing.html">Edit Listing</a></li>
                                                            <li><a href="reviews.html">Reviews</a></li>
                                                        </ul>
                                                    </div>
                                                    <!--end col-md-3-->
                                                    <div class="col-md-3 col-sm-3">
                                                        <h4 class="heading">Other</h4>
                                                        <ul>
                                                            <li><a href="elements.html">Elements / Shortcodes</a></li>
                                                            <li><a href="404.html">404 Error Page</a></li>
                                                            <li><a href="sticky-footer.html">Sticky Footer</a></li>
                                                            <li><a href="terms-and-conditions.html">Terms &
                                                                    Conditions</a></li>
                                                            <li><a href="grid-system.html">Grid System</a></li>
                                                            <li><a href="how-it-works.html">How it Works</a></li>
                                                            <li><a href="rtl.html">RTL Support</a></li>
                                                        </ul>
                                                    </div>
                                                    <!--end col-md-3-->
                                                    <div class="col-md-3 col-sm-3">
                                                        <div class="image center overlay">
                                                            <div class="vertical-aligned-elements">
                                                                <div class="element">
                                                                    <a href="#"
                                                                        class="btn btn-default btn-framed">Submit Your
                                                                        Listing</a>
                                                                </div>
                                                            </div>
                                                            <div class="bg-transfer"><img
                                                                    src="{{ asset('front-site/img/items/10.jpg') }}"
                                                                    alt="">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <!--end col-md-3-->
                                                </div>
                                                <!--end row-->
                                            </div>
                                            <!--end container-->
                                        </div>
                                        <!--end collapse-->
                                    </div>
                                    <!--end wrapper-->
                                </div>
                                <!--end mega-menu-->
                            </li> --}}

                            {{-- <li class="has-child"><a href="">Events</a>
                                <div class="wrapper">

                                </div>
                                <!--end wrapper-->
                            </li> --}}
                            <li class="has-child"><a href="">Locations</a>
                                <div class="wrapper">
                                    <div id="nav-locations" class="nav-wrapper">
                                        <ul>
                                            <li class="has-child"><a href="#nav-locations-new-york">New York</a>
                                                <div class="nav-wrapper" id="nav-locations-new-york">
                                                    <ul>
                                                        <li class="has-child"><a href="#nav-4">Manhattan</a>
                                                            <div class="nav-wrapper" id="nav-4">
                                                                <ul>
                                                                    <li><a href="#">1</a></li>
                                                                    <li><a href="#">2</a></li>
                                                                    <li><a href="#">3</a></li>
                                                                    <li><a href="#">4</a></li>
                                                                </ul>
                                                            </div>
                                                        </li>
                                                        <li><a href="#">Brooklyn</a></li>
                                                        <li><a href="#">Staten Island</a></li>
                                                    </ul>
                                                </div>
                                            </li>
                                            <li class="has-child"><a href="#nav-5">London</a>
                                                <div class="nav-wrapper" id="nav-5">
                                                    <ul>
                                                        <li><a href="#">Abbey Wood</a></li>
                                                        <li><a href="#">Bayswater</a></li>
                                                        <li><a href="#">Forestdale</a></li>
                                                    </ul>
                                                </div>
                                            </li>
                                            <li class="has-child"><a href="#nav-6">Paris</a>
                                                <div class="nav-wrapper" id="nav-6">
                                                    <ul>
                                                        <li><a href="#">Louvre</a></li>
                                                        <li><a href="#">Bourse</a></li>
                                                        <li><a href="#">Marais</a></li>
                                                    </ul>
                                                </div>
                                            </li>
                                        </ul>
                                    </div>
                                    <!--end nav-wrapper-->
                                </div>
                                <!--end wrapper-->
                            </li>
                            <li><a href-p="blog.html">How it Works</a></li>
                            <li><a href="{{ url(config('app.front_prefix') . 'courses') }}">Classes</a></li>
                        </ul>
                        <!--end navigation-->
                    </div>
                    <!--end primary-nav-->
                    <div class="secondary-nav">
                        {{-- <a href="#" data-modal-external-file="modal_sign_in.php"
                            data-target="modal-sign-in">Sign In</a>
                        <a href="#" class="promoted" data-modal-external-file="modal_register.php"
                            data-target="modal-register">Register</a> --}}
                        <a href="{{ url(config('app.front_prefix') . 'apply-trainer') }}" class="promoted">Become a
                            Trainer</a>
                    </div>
                    <div class="secondary-nav">
                        <ul class="navigation">

                            <li class="has-child"><a>My Account (Trainer)</a>
                                <div class="wrapper">
                                    <div id="nav-locations" class="nav-wrapper">
                                        <ul>
                                            <li class=""><a
                                                    href="{{ url(config('app.front_prefix') . 'trainer-dashboard') }}">Dashboard</a>
                                            </li>
                                            <li class=""><a
                                                    href="{{ url(config('app.front_prefix') . 'profile') }}">View
                                                    Profile</a></li>
                                            <li class=""><a
                                                    href="{{ url(config('app.front_prefix') . 'forgot-password') }}">Forgot
                                                    Password</a></li>
                                            <li class=""><a
                                                    href-test="{{ url(config('app.front_prefix')) }}">Logout</a></li>
                                        </ul>
                                    </div>
                                    <!--end nav-wrapper-->
                                </div>
                                <!--end wrapper-->
                            </li>

                        </ul>
                    </div>
                    <!--end secondary-nav-->
                    {{-- <a href="#" class="btn btn-primary btn-small btn-rounded icon shadow add-listing"
                        data-modal-external-file="modal_submit.php" data-target="modal-submit">
                        <i class="fa fa-plus"></i><span>Add listing</span></a> --}}
                    <div class="nav-btn">
                        <i></i>
                        <i></i>
                        <i></i>
                    </div>
                    <!--end nav-btn-->
                </div>
                <!--end right-->
            </nav>
            <!--end nav-->
        </header>
        <div id="page-content">
            @yield('front-body')
        </div>
    </div>

    <script type="text/javascript" src="{{ asset('front-site/js/jquery-2.2.1.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('front-site/js/jquery-migrate-1.2.1.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('front-site/bootstrap/js/bootstrap.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('front-site/js/bootstrap-select.min.js') }}"></script>
    <script type="text/javascript"
        src="http://maps.google.com/maps/api/js?key=AIzaSyBEDfNcQRmKQEyulDN8nGWjLYPm8s4YB58&libraries=places"></script>

    <script type="text/javascript" src="{{ asset('front-site/js/richmarker-compiled.js') }}"></script>
    <script type="text/javascript" src="{{ asset('front-site/js/moment.js') }}"></script>
    <script type="text/javascript" src="{{ asset('front-site/js/bootstrap-datetimepicker.min.js') }}"></script>

    <script type="text/javascript" src="{{ asset('front-site/js/jquery.validate.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('front-site/js/icheck.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('front-site/js/owl.carousel.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('front-site/js/custom.js') }}"></script>
    <script type="text/javascript" src="{{ asset('front-site/js/maps.js') }}"></script>

    @yield('script')

</body>

</html>
