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

    <div class="our-causes fadeIn animated">
        <div class="container">
            <h2 class="title-style-1">Donasi<span class="title-under"></span></h2>
            <div class="row">
              @foreach ($program as $p)
              <div class="col-md-3 col-sm-6">
                  <div class="cause">
                      <img src="{{ Storage::url('public/PhotoProgram/').$p->foto }}" alt="" class="cause-img">
                      <div class="progress cause-progress">
                        <div class="progress-bar" role="progressbar" aria-valuenow="{{($p->getTransaksi->where('status','=','settlement')->sum('nominal')/$p->nominal)*100}}"
                          aria-valuemin="0" aria-valuemax="100" style="width: {{($p->getTransaksi->where('status','=','settlement')->sum('nominal')/$p->nominal)*100}}%;max-width: 100%;">
                          @if($p->getTransaksi->where('status','=','settlement')
                          ->sum('nominal')==null)
                              0
                          @else
                              @currency($p->getTransaksi->where('status','=','settlement')
                              ->sum('nominal'))
                          @endif
                         / @currency($p->nominal)
                      </div>
                    </div>
                      <h4 class="cause-title"><a href="#">{{$p->nama}} </a></h4>
                      <div class="cause-details">
                          {{ Str::limit($p->detail_singkat,50,'...')}}<hr>
                          Batas : {{$p->batas}}
                      </div>
                      <div class="btn-holder text-center">
                        <a href="{{route('programuser.show',$p->id.$p->nama,)}}" class="btn btn-primary">Klik Me</a>
                      </div>
                  </div> <!-- /.cause -->
              </div>
              @endforeach
            </div>
            <div class="row">
                <div class="col-md-12 col-sm-12">
                    <div class="col-md-3 col-sm-3">
                    </div>
                    <div class="col-md-6 col-sm-6">
                        <center>
                        {!! $program->links("pagination::bootstrap-4") !!}
                        </center>
                    </div>
                    <div class="col-md-3 col-sm-3">
                    </div>
                </div>
            </div>
         </div>
    </div> <!-- /.our-causes -->
</div> <!-- /.main-container  -->
@endsection
