<!DOCTYPE html>
<html>
<head>
  <title>Best Store a Ecommerce Online Shopping Category Flat Bootstrap Responsive Website Template | Login :: w3layouts</title>
  <!-- CSRF Token -->
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <!-- for-mobile-apps -->
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <meta name="keywords" content="Best Store Responsive web template, Bootstrap Web Templates, Flat Web Templates, Android Compatible web template, 
  Smartphone Compatible web template, free webdesigns for Nokia, Samsung, LG, SonyEricsson, Motorola web design" />
  <script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false);
      function hideURLbar(){ window.scrollTo(0,1); } </script>
  <!-- //for-mobile-apps -->
  <link href="{{asset('css/bootstrap.css')}}" rel="stylesheet" type="text/css" media="all" />
  <link href="{{asset('css/style.css')}}" rel="stylesheet" type="text/css" media="all" />
  <!-- js -->
  <script src="{{asset('js/jquery.min.js')}}"></script>
  <!-- //js -->
  <!-- cart -->
    <script src="{{asset('js/simpleCart.min.js')}}"> </script>
  <!-- cart -->
  <link rel="stylesheet" type="text/css" href="{{asset('css/jquery-ui.css')}}">
  <!-- for bootstrap working -->
    <script type="text/javascript" src="{{asset('js/bootstrap-3.1.1.min.js')}}"></script>
  <!-- //for bootstrap working -->
  <link href="{{asset('//fonts.googleapis.com/css?family=Open+Sans:400,300,300italic,400italic,600,600italic,700,700italic,800,800italic')}}" rel='stylesheet' type='text/css'>
  <link href="{{asset('//fonts.googleapis.com/css?family=Lato:400,100,100italic,300,300italic,400italic,700,700italic,900,900italic')}}" rel='stylesheet' type='text/css'>
  <!-- animation-effect -->
  <link href="{{asset('css/animate.min.css')}}" rel="stylesheet"> 
  <script src="{{asset('js/wow.min.js')}}"></script>
  <script>
  new WOW().init();
  </script>
  <!-- //animation-effect -->
</head>

    <body>
        
        <!-- 
        NAVBAR
        =============================================== -->
        @include('user_layouts.user_header')
        <!-- END: NAVBAR -->
        
        <!-- 
        CONTENT
        =============================================== -->
        @yield('content')

        <!-- END: CONTENT -->

        <!-- FOOTER
        =============================================== -->
        @include('user_layouts.user_footer')
        <!-- END: FOOTER -->

        <!-- Bootstrap core JavaScript
        ================================================== -->
        <!-- Placed at the end of the document so the pages load faster -->
        {{-- <script src="{{ asset('pengguna/html/assets/js/jquery.min.js') }}"></script>
        <script src="{{ asset('pengguna/html/assets/js/bootstrap.min.js') }}"></script> --}}
        {{-- <script src="{{ asset('pengguna/html/assets/js/jquery-ui.min.js') }}"></script>
        <script src="{{ asset('pengguna/html/assets/js/owl.carousel.min.js') }}"></script><!-- OWL Carousel -->
        <script src="{{ asset('pengguna/html/assets/js/lv-ripple.jquery.min.js') }}"></script><!-- BTN Material effects --> 
        <script src="{{ asset('pengguna/html/assets/js/SmoothScroll.min.js') }}"></script><!-- SmoothScroll -->
        <script src="{{ asset('pengguna/html/assets/js/jquery.TDPageEvents.min.js') }}"></script><!-- Page Events -->
        <script src="{{ asset('pengguna/html/assets/js/jquery.TDParallax.min.js') }}"></script><!-- Parallax -->
        <script src="{{ asset('pengguna/html/assets/js/jquery.TDTimer.min.js') }}"></script><!-- Timer -->
        <script src="{{ asset('pengguna/html/assets/js/selectize.min.js') }}"></script><!-- Select customize -->
        <script src="{{ asset('pengguna/html/js/main.min.js') }}"></script>
        <script src="{{ asset('pengguna/source/main.js') }}"></script> --}}

        
        {{-- <script src="{{ asset('pengguna/public/js/bootstrap-3.1.1.min.js') }}"></script> --}}

        <script>
    
            function read(id) {
                $.ajax({
                    url : '/user/read-notif/'+id,
                    method : 'GET',
                    success : function (response) {
                        console.log(response);
                    }
                });
            }
        </script>
        

        @yield('after-script')

    </body>
</html>