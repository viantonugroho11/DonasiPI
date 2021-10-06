<!DOCTYPE html>
<html class="no-js">
    <head>
        <meta charset="utf-8">
        <title>Kepedulian Masyarakat</title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="author" content="">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <!-- Fonts -->
        <link href='http://fonts.googleapis.com/css?family=Open+Sans:400,300,700' rel='stylesheet' type='text/css'>
        <link href='http://fonts.googleapis.com/css?family=Dosis:400,700' rel='stylesheet' type='text/css'>
        <!-- Bootsrap -->
        {{-- <link rel="stylesheet" href="{{ asset('Admin/plugins/fontawesome-free/css/all.min.css')}}"> --}}
        <link rel="stylesheet" href="{{ asset('User/css/bootstrap.min.css')}}">
        <!-- Font awesome -->
        <link rel="stylesheet" href="{{ asset('User/css/font-awesome.min.css')}}">
        <!-- Template main Css -->
        <link rel="stylesheet" href="{{ asset('User/css/style.css')}}">
        <!-- Modernizr -->
        <script src="{{ asset('User/js/modernizr-2.6.2.min.js')}}"></script>
        @yield('scriptcss')
    </head>

    <body>

    @yield('content')


    <!--  Scripts
    ================================================== -->

    <!-- jQuery -->
    @yield('scriptjs')
    @include('user.tools.chat')
    {{-- @include('user.tools.cek') --}}
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <script>window.jQuery || document.write('<script src="assets/js/jquery-1.11.1.min.js"><\/script>')</script>
 <!-- Bootsrap javascript file -->
 <script src="{{ asset('User/js/bootstrap.min.js')}}"></script>
 <!-- Template main javascript -->
 <script src="{{ asset('User/js/main.js')}}"></script>


    <!-- Google Analytics: change UA-XXXXX-X to be your site's ID. -->
    <script>
        (function(b,o,i,l,e,r){b.GoogleAnalyticsObject=l;b[l]||(b[l]=
        function(){(b[l].q=b[l].q||[]).push(arguments)});b[l].l=+new Date;
        e=o.createElement(i);r=o.getElementsByTagName(i)[0];
        e.src='//www.google-analytics.com/analytics.js';
        r.parentNode.insertBefore(e,r)}(window,document,'script','ga'));
        ga('create','UA-XXXXX-X');ga('send','pageview');
    </script>

    </body>
</html>
