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
@include('user.tools.header1')
<div class="main-container">
    <div class="container gallery fadeIn animated">
        <div class="row">
            @foreach ($gallery as $item)
            <a href="{{ Storage::url('public/PhotoGallery/').$item->foto }}" class="col-md-3 col-sm-4 gallery-item lightbox">

                <img src="{{ Storage::url('public/PhotoGallery/').$item->foto }}" alt="">
                <span class="on-hover">
                    <span class="hover-caption">{{$item->nama}}</span>
                </span>
            </a>
            @endforeach
                <!-- /.gallery-item -->
        </div>
        <div class="row">
            <div class="col-md-12 col-sm-12">
                <div class="col-md-3 col-sm-3">
                </div>
                <div class="col-md-6 col-sm-6">
                    <center>
                    {!! $gallery->links("pagination::bootstrap-4") !!}
                    </center>
                </div>
                <div class="col-md-3 col-sm-3">
                </div>
            </div>
        </div>
    </div>
</div> <!-- /.main-container  -->
@endsection
