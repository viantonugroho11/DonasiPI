<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="description" content="">
  <meta name="author" content="">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>Admininstator | Dashboard</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{ asset('Admin/plugins/fontawesome-free/css/all.min.css')}}">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Tempusdominus Bbootstrap 4 -->
  <link rel="stylesheet" href="{{ asset('Admin/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css')}}">
  <!-- iCheck -->
  <link rel="stylesheet" href="{{ asset('Admin/plugins/icheck-bootstrap/icheck-bootstrap.min.css')}}">
  <link rel="stylesheet" href="{{ asset('Admin/plugins/icheck-bootstrap/icheck-bootstrap.min.css')}}">
  <!-- JQVMap -->
  <link rel="stylesheet" href="{{ asset('Admin/plugins/jqvmap/jqvmap.min.css')}}">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{ asset('Admin/dist/css/adminlte.min.css')}}">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="{{ asset('Admin/plugins/overlayScrollbars/css/OverlayScrollbars.min.css')}}">
  <!-- Daterange picker -->
  <link rel="stylesheet" href="{{ asset('Admin/plugins/daterangepicker/daterangepicker.css')}}">
  <!-- summernote -->
  <link rel="stylesheet" href="{{ asset('Admin/plugins/summernote/summernote-bs4.css')}}">
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
  {{-- toasr --}}
  <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
  @yield('scriptCss')
</head>
<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">

  <!-- Navbar -->
  @include('admin.tools.navbar')
  <!-- include -->
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  @include('admin.tools.sidebar')
  <!-- include -->

  <!-- Content Wrapper. Contains page content -->
  @yield('content')
  <!-- /.content-wrapper -->
  @include('admin.tools.footer')

  <!-- Control Sidebar -->

  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

<!-- jQuery -->
@yield('scriptjs')
{{--
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<!-- ChartJS -->
<script src="{{ asset('plugins/chart.js/Chart.min.js')}}"></script>
<!-- Sparkline -->
<script src="{{ asset('plugins/sparklines/sparkline.js')}}"></script>
<!-- JQVMap -->
<script src="{{ asset('plugins/jqvmap/jquery.vmap.min.js')}}"></script>
<script src="{{ asset('plugins/jqvmap/maps/jquery.vmap.usa.js')}}"></script>
<!-- jQuery Knob Chart -->
<script src="{{ asset('plugins/jquery-knob/jquery.knob.min.js')}}"></script>
<!-- daterangepicker -->
<script src="{{ asset('plugins/moment/moment.min.js')}}"></script>
<script src="{{ asset('plugins/daterangepicker/daterangepicker.js')}}"></script>
<!-- Tempusdominus Bootstrap 4 -->
<script src="{{ asset('plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js')}}"></script>
<!-- Summernote -->
<script src="{{ asset('plugins/summernote/summernote-bs4.min.js')}}"></script> --}}
<!-- overlayScrollbars -->
<script src="{{ asset('Admin/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js')}}"></script>
<script>
    $.widget.bridge('uibutton', $.ui.button)
</script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
{{-- <script src="{{ asset('dist/js/pages/dashboard.js')}}"></script> --}}
{{-- <script src="{{ asset('Admin/plugins/jquery/jquery.min.js')}}"></script> --}}
<script src="{{ asset('Admin/plugins/jquery-ui/jquery-ui.min.js')}}"></script>
<!-- jQuery UI 1.11.4 -->
<!-- AdminLTE App -->
<script src="{{ asset('Admin/dist/js/adminlte.js')}}"></script>
<!-- Bootstrap 4 -->
<script src="{{ asset('Admin/plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
<!-- AdminLTE for demo Admin/purposes -->
<script src="{{ asset('Admin/dist/js/demo.js')}}"></script>
</body>
</html>
