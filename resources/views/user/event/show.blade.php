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

        <h1 class="page-title">{{$event->nama}} <span class="title-under"></span></h1>
        <p class="page-description">
            Tanggal Pelaksanaan : {{$event->tanggal_pelaksaaan}}<br>
            Batas Pendaftaran : {{$event->batas_tanggal}}<br>
            Batas Peserta : {{$event->batas_peserta}}
        </p>

    </div>

</div>
<div class="main-container">
    <div class="container">
        <div class="row">
            <div class="col-md-12 fadeIn animated">
                {!!$event->detail!!}
            </div>
        </div>
        @if (Auth::check())
        <form role="form" action="{{route('eventuser.store')}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                       {{-- <input type="email" name="email" class="form-control" placeholder="Email" required> --}}
                       <input type="hidden" name="id_event" class="form-control" value="{{$event->id}}">
                       {{-- <input type="hidden" name="nama_donasi" class="form-control" value="{{$program->nama}}"> --}}
                    </div>
                     <div class="form-group">
                        <button type="Submit" class="btn btn-block btn-primary btn-flat">
                            <i class="fas fa-save"></i> Daftar
                        </button>
                        {{-- <button type="submit" class="btn btn-submit">Ok</button> --}}
                    </div>
                </form>
        @else
        <div class="row fadeIn animated">
            <div class="col-md-12">
                <h2 class="title-style-2"> Form Pendaftaraan<span class="title-under"></span></h2>
                <form role="form" action="{{route('eventuser.store')}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                       <input type="text" name="nama" class="form-control" placeholder="Nama" required>
                       <input type="hidden" name="id_event" class="form-control" value="{{$event->id}}">
                       {{-- <input type="hidden" name="nama_donasi" class="form-control" value="{{$program->nama}}"> --}}
                    </div>
                    <div class="form-group">
                       <input type="email" name="email" class="form-control" placeholder="Email" required>
                       <input type="hidden" name="id_event" class="form-control" value="{{$event->id}}">
                       {{-- <input type="hidden" name="nama_donasi" class="form-control" value="{{$program->nama}}"> --}}
                    </div>
                    <div class="form-group">
                       <input type="text" name="nohp" class="form-control" placeholder="nohp" required>
                       {{-- <input type="hidden" name="nama_donasi" class="form-control" value="{{$program->nama}}"> --}}
                    </div>
                    <div class="form-group alerts">
                        <div class="alert alert-success" role="alert">
                        </div>
                        <div class="alert alert-danger" role="alert">
                        </div>
                    </div>
                     <div class="form-group">
                        <button type="Submit" class="btn btn-block btn-primary btn-flat">
                            <i class="fas fa-save"></i> Daftar
                        </button>
                        {{-- <button type="submit" class="btn btn-submit">Ok</button> --}}
                    </div>
                </form>
            </div>
        </div>
        @endif
    </div>
</div> <!-- /.main-container  -->
@endsection
