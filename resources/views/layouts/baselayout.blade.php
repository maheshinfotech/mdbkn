<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1.0">

    <title>{{config('app.app_name')}} | {{$title ?? ''}}</title>

    {{-- <meta name="description" content="OneUI - Bootstrap 5 Admin Template &amp; UI Framework created by pixelcave and published on Themeforest"> --}}
    <meta name="author" content="pixelcave">
    <meta name="robots" content="noindex, nofollow">

    <!-- Open Graph Meta -->
    <meta property="og:title" content="OneUI - Bootstrap 5 Admin Template &amp; UI Framework">
    <meta property="og:site_name" content="OneUI">
    <meta property="og:description" content="OneUI - Bootstrap 5 Admin Template &amp; UI Framework created by pixelcave and published on Themeforest">
    <meta property="og:type" content="website">
    <meta property="og:url" content="">
    <meta property="og:image" content="">

    <!-- Icons -->
    <!-- The following icons can be replaced with your own, they are used by desktop and mobile browsers -->
    <link rel="shortcut icon" href="{{asset('media/logo.jpg')}}">
    <link rel="icon" type="image/png" sizes="192x192" href="{{asset('media/logo.jpg')}}">
    <link rel="apple-touch -icon" sizes="180x180" href="{{asset('media/logo.jpg')}}">
    <link rel="stylesheet" id="css-main" href="{{asset('theme/css/oneui.min.css')}}">
    <link rel="stylesheet" id="" href="{{ asset('assets/css/custom.css')}}">

  </head>

  <body>

    <div id="page-container">

      <!-- Main Container -->
      <main id="main-container">
        <!-- Page Content -->
        <div class="hero-static d-flex align-items-center">
          <div class="content">
            <div class="row justify-content-center push">
              <div class="col-md-8 col-lg-6 col-xl-4">
                <!-- Sign In Block -->
                <div class="block block-rounded  mb-0">
                  <div class="block-header block-header-default d-flex justify-content-center py-3 bg-light">
                    <h3 class="mb-0 text-purple">{{ config('app.app_name') }}</h3>
                  </div>

                  <div class="block-content">
                        <div class="p-sm-3 px-lg-4 px-xxl-5 py-lg-3">

                                    <x-reusables.badge-alerts/>

                                    <!-- <h1 class="h2 mb-1">{{config('app.app_name')}}</h1> -->

                                    {{-- <p class="fw-medium text-muted text-center">
                                    <img class="" src="{{ asset('media/logo.png') }}" alt="Header Avatar" style="width: 100px;height:95px">
                                    </p> --}}

                                    @yield('content')

                               <!-- END Sign In Form -->
                        </div>
                  </div>
                </div>
                <!-- END Sign In Block -->
              </div>
            </div>

          </div>
        </div>
        <!-- END Page Content -->

      </main>
      <!-- END Main Container -->
    </div>
    <!-- END Page Container -->

    <script src="{{asset('theme/js/oneui.app.min.js')}}"></script>
  </body>
</html>
