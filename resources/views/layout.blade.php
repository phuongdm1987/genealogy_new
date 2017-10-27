<!doctype html>
<html lang="{{ app()->getLocale() }}">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Genealogy</title>

    <link rel="stylesheet" href="{{ asset('fonts/vendor/foundation-icons/foundation-icons.css') }}">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link rel="stylesheet" href="{{ asset('css/cropper.min.css') }}">
    @yield('css')
  </head>
  <body>
    @include('navbar')

    @include('alert')

    <!-- Main content -->
    <div class="grid-container full">
      <div class="grid-x grid-padding-x">
        <!-- Menu -->
        @if($sidebar)
          <div class="cell large-3">
            @include('sidebar')
          </div>
        @endif
        <!-- End Menu -->

        <!-- Content -->
        @if($sidebar)
          <div class="cell large-9">
            @yield('content')
          </div>
        @else
          @yield('content')
        @endif
        <!-- End Content -->

      </div>
    </div>
    <!-- End Main content -->

    <!-- Footer -->
    <div id="footer" class="grid-container full margin-top-3 padding-left-1 padding-right-1 clearfix">
      <p class="float-left">
        <small>
          Copyright &copy; 2017-<span id="year-now"></span> by <a href="https://www.facebook.com/phuongdm87">Henry Duong</a>. All rights reserved.
        </small>
      </p>
      <p class="float-right"><small><b>Version</b> 1.0.0</small></p>
    </div>
    <!-- End Footer -->

    <script src="{{ asset('js/app.js') }}"></script>
    <script type="text/javascript">
      $('#year-now').text((new Date()).getFullYear());
    </script>
    @yield('js')
  </body>
</html>
