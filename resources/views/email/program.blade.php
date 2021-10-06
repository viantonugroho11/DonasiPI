@extends('email.base')
@section('scriptcss')
<!-- PrettyPhoto -->
<link rel="stylesheet" href="{{ asset('User/css/prettyPhoto.css')}}">
@endsection

@section('scriptjs')
<!-- PrettyPhoto javascript file -->
<script src="{{ asset('User/js/jquery.prettyPhoto.js')}}"></script>
@endsection

@section('content')
<div class="text-center">

    <div class="container zoomIn animated">

        <h1 class="page-title">{{$nama}} <span class="title-under"></span></h1>
        <p class="page-description">
            Batas:{{$tanggal}}<br>Target:@currency($nominal)
        </p>

    </div>

</div>
<div class="main-container">

    <div class="container">

        <div class="row">
            <div class="col-md-12 fadeIn animated">
                {!!$detail!!}
            </div>

        </div>
    </div>
</div> <!-- /.main-container  -->
@endsection
