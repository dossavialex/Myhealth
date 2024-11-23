<!DOCTYPE html>
<html lang="en">


<!-- auth-register.html  21 Nov 2019 04:05:01 GMT -->
<head>
  <meta charset="UTF-8">
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
  <title>MYHEATH  - @yield('title')</title>
  <!-- General CSS Files -->
  <link rel="stylesheet" href="{{ asset('assets/css/app.min.css')}}">
  <link rel="stylesheet" href="{{asset('assets/bundles/jquery-selectric/selectric.css')}}">
  <!-- Template CSS -->
  <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
  <!--link rel="stylesheet" href="assets/css/components.css"-->
  <!-- Custom style CSS -->
  <!--link rel="stylesheet" href="assets/css/custom.css"-->
  <link rel='shortcut icon' type='image/x-icon' href='{{ asset('assets/img/heart.png') }}' />
  @yield('css_register')
</head>

<body>
  <div class="loader"></div>
  <div id="app">
    @yield('content')
  </div>
<!-- General JS Scripts -->
<script src="{{ asset('assets/js/app.min.js') }}"></script>

<!-- JS Libraies -->
<script src="{{asset('assets/bundles/jquery-pwstrength/jquery.pwstrength.min.js')}}"></script>
<script src="{{ asset('assets/bundles/jquery-selectric/jquery.selectric.min.js') }}"></script>
<!-- Page Specific JS File -->
<script src="{{asset('assets/js/page/auth-register.js')}}"></script>
<!-- Template JS File -->
<script src="{{ asset('assets/js/scripts.js') }}"></script>
<!-- Custom JS File -->
<script src="assets/js/custom.js"></script>
@yield('scripts_register')
</body>
<!-- auth-register.html  21 Nov 2019 04:05:02 GMT -->
</html>
