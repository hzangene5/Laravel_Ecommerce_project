<!DOCTYPE html>
<html class="no-js" lang="fa">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>eCommerce - @yield('title')</title>

  <!-- Custom styles for this template-->
  <link href="{{ asset('/css/home.css' )}}" rel="stylesheet">
  @yield('style')

  {!! SEO::generate() !!}
</head>

<body>

  <div class="wrapper text-center">



    <div id="preloader">
      <div id="loader"></div>
    </div>









    <!-- <div id="overlayer">

      <span class="loader">
        <span class="loader-inner"> <h1>wellcome</h1></span>
      </span> -->
  </div>





  @include('home.sections.header')

  @include('home.sections.mobile_off_canvas')


  @yield('content')

  @include('home.sections.footer')

  </div>


  <!--JavaScript-->
  <script src="{{ asset('/js/home/jquery-1.12.4.min.js') }}"></script>
  <script src="{{ asset('/js/home/plugins.js') }}"></script>
  <script src="{{ asset('/js/home.js') }}"></script>


  <script>
    $(window).load(function() {
      $('#preloader').delay(500).fadeOut("fast");
      $('#loader').delay(500).fadeOut("fast");
    });
  </script>

  @include('sweetalert::alert', ['cdn' => "https://cdn.jsdelivr.net/npm/sweetalert2@9"])

  @yield('script')

  {!! GoogleReCaptchaV3::init() !!}

</body>

</html>