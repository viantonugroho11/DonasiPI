@extends('user.master')
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

        <h1 class="page-title">{{$artikel1->nama}} <span class="title-under"></span></h1>
        <p class="page-description">
            Editor:{{$artikel1->AdmNama}}<br>Di Terbit:{{$artikel1->updated_at}}
        </p>

    </div>

</div>
<div class="main-container">

    <div class="container">

        <div class="row">
            <div class="col-md-12 fadeIn animated">
                {!!$artikel1->detail!!}
            </div>

        </div>



    </div>
</div> <!-- /.main-container  -->
@endsection
