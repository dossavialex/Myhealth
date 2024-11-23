<!DOCTYPE html>
<html lang="en">


<!-- index.html  21 Nov 2019 03:44:50 GMT -->
<head>
  <meta charset="UTF-8">
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
  <title>MYHEATH  - @yield('title')</title>
  <!-- General CSS Files -->
  <link rel="stylesheet" href="{{  asset('assets/css/app.min.css') }}">
  <!-- Template CSS -->
  <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/css/components.css') }}">
  <!-- Custom style CSS -->
  <link rel="stylesheet" href="{{ asset('assets/css/custom.css') }}">
  <link rel='shortcut icon' type='image/x-icon' href='{{ asset('assets/img/heart.png') }}' />
  @yield('css_form')
  @yield('css')
</head>

<body>
    @if (Session::has('error'))
        <script type="text/javascript" src="{{ asset('assets/bundles/sweetalert/sweetalert.min.js') }}"></script>
        <script type="text/javascript">
            swal("{{ session('error') }}", "Merci", "error");
        </script>
    @endif

    @if (Session::has('flash_message_success'))
        <script type="text/javascript" src="{{ asset('assets/bundles/sweetalert/sweetalert.min.js') }}"></script>
        <script type="text/javascript">
            swal("{{ session('flash_message_success') }}", "Merci", "success");
        </script>
    @endif

  <div id="app">
  <div class="loader"></div>
    <div class="main-wrapper main-wrapper-1">
      <div class="navbar-bg"></div>
     @include('partial.top_bar')
    @include('partial.side_bar')
      <!-- Main Content -->
      <div class="main-content">
        @yield('content')
      </div>
      @include('partial.footer')
    </div>
  </div>

  <!-- General JS Scripts -->
  <script src="https://cdn.jsdelivr.net/npm/quill@2.0.2/dist/quill.js"></script>

  <script src="https://code.jquery.com/jquery-3.7.1.slim.js" integrity="sha256-UgvvN8vBkgO0luPSUl2s8TIlOSYRoGFAX4jlCIm9Adc=" crossorigin="anonymous"></script>

  <script src="{{ asset('assets/js/app.min.js') }}"></script>
  @yield('scripts')

  <script src="{{ asset('assets/bundles/chocolat/dist/js/jquery.chocolat.min.js') }}"></script>
  <script src="{{ asset('assets/bundles/jquery-ui/jquery-ui.min.js') }}"></script>

  <script src="{{ asset('assets/bundles/sweetalert/sweetalert.min.js') }}"></script>
  <!-- Page Specific JS File -->
  <script src="{{ asset('assets/js/page/sweetalert.js') }}"></script>
  <!-- JS Libraies -->

  <!-- Page Specific JS File -->
  <script src="assets/js/page/index.js"></script>
  @yield('script_form')
  <!-- Template JS File -->
  <script src="{{ asset('assets/js/scripts.js') }}"></script>
  <!-- Custom JS File -->
  <script src="{{ asset('assets/js/custom.js') }}"></script>
  <script src="{{ asset('js/app.js') }}"></script>
  @auth('web')
  <script>
    window.User = id = {{ auth()->guard('web')->user()->id }}
  </script>
  @endauth

</body>


<!-- index.html  21 Nov 2019 03:47:04 GMT -->
</html>
