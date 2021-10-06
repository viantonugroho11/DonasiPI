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

  {{-- <div class="section-home about-us fadeIn animated">

      <div class="container">

          <div class="row">
            {{-- kategori --}}
            {{-- @foreach ($kategori as $item)
            <div class="col-3 col-md-3 col-sm-3">
              <div class="about-us-col">

                    <div class="col-icon-wrapper">
                      <img src="{{ asset('User/images/icons/our-mission-icon.png')}}" alt="">
                    </div>
                    <h3 class="col-title">{{$item->nama}}</h3> --}}
                    <!-- <div class="col-details">

                      <p>Lorem ipsum dolor sit amet consect adipisscin elit proin vel lectus ut eta esami vera dolor sit amet consect</p>

                    </div> -->
                    {{-- <a href="{{route('programuser',$item->nama)}}" class="btn btn-primary">Klik Me</a>
              </div>
            </div>
            @endforeach --}}
              {{-- selesai --}}
          {{-- </div>

      </div>

  </div> <!-- /.about-us --> --}}

  <div class="section-home our-causes  ">

      <div class="container">

          <h2 class="title-style-1">Events<span class="title-under"></span></h2>

          <div class="row">
              @foreach ($event as $item)

              <div class="col-md-3 col-sm-6">

                  <div class="cause">
                      <img src="{{ Storage::url('public/PhotoEvent/').$item->foto }}" alt="" class="cause-img">

                      <h4 class="cause-title"><a href="#">{{$item->nama}} </a></h4>
                      <div class="cause-details">
                          {{-- {{ Str::limit($item->detail_singkat,50,'...')}}<hr> --}}
                          Tanggal Pelaksanaan : {{$item->tanggal_pelaksana}}<br>
                          Batas Pendaftaran : {{$item->batas_tanggal}}<br>
                          Batas Peserta : {{$item->batas_peserta}}
                      </div>
                      <div class="btn-holder text-center">
                        <a href="{{route('eventuser.show',$item->id.$item->nama,)}}" class="btn btn-primary">Detail</a>
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
                    {!! $event->links("pagination::bootstrap-4") !!}
                    </center>
                </div>
                <div class="col-md-3 col-sm-3">
                </div>
            </div>
        </div>
      </div>
  </div> <!-- /.our-causes -->
@endsection
