<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Sistem Peminjaman Gedung</title>

    <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome Icons -->
  <link rel="stylesheet" href="{{asset('adminLTE/plugins/fontawesome-free/css/all.min.css')}}">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{asset('adminLTE/dist/css/adminlte.min.css')}}">
  <!-- SweetAlert2 -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@10.13.0/dist/sweetalert2.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@10.13.0/dist/sweetalert2.min.css">


    {{-- loginn --}}
    <link rel="stylesheet" type="text/css" href="{{asset('loginn/vendor/bootstrap/css/bootstrap.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('loginn/fonts/font-awesome-4.7.0/css/font-awesome.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('loginn/fonts/Linearicons-Free-v1.0.0/icon-font.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('loginn/vendor/animate/animate.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('loginn/vendor/css-hamburgers/hamburgers.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('loginn/vendor/animsition/css/animsition.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('loginn/vendor/select2/select2.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('loginn/vendor/daterangepicker/daterangepicker.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('loginn/css/util.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('loginn/css/main.css')}}">



</head>
<body>
    @yield('loginn')
    <!-- jQuery -->
    <script src="{{asset('adminLTE/plugins/jquery/jquery.min.js')}}"></script>
    <!-- Bootstrap 4 -->
    <script src="{{asset('adminLTE/plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
    <!-- AdminLTE App -->
    <script src="{{asset('adminLTE/dist/js/adminlte.min.js')}}"></script>

    @stack('scriptlogin')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>

    {{-- loginn --}}
    <script src="{{asset('loginn/vendor/jquery/jquery-3.2.1.min.js')}}"></script>
	<script src="{{asset('loginn/vendor/animsition/js/animsition.min.js')}}"></script>
	<script src="{{asset('loginn/vendor/bootstrap/js/popper.js')}}"></script>
	<script src="{{asset('loginn/vendor/bootstrap/js/bootstrap.min.js')}}"></script>
	<script src="{{asset('loginn/vendor/select2/select2.min.js')}}"></script>
	<script src="{{asset('loginn/vendor/daterangepicker/moment.min.js')}}"></script>
	<script src="{{asset('loginn/vendor/daterangepicker/daterangepicker.js')}}"></script>
	<script src="{{asset('loginn/vendor/countdowntime/countdowntime.js')}}"></script>
    <script src="{{asset('loginn/js/main.js')}}"></script>

    <script>
    function myFunction() {
        var x = document.getElementById("password");
        if (x.type === "password") {
          x.type = "text";
        } else {
          x.type = "password";
        }
      }
    </script>

</body>
</html>
