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

  <div class="section-home about-us fadeIn animated">

      <div class="container">

          <div class="row">
            {{-- kategori --}}
            @foreach ($kategori1 as $item)
            <div class="col-3 col-md-3 col-sm-3">
              {{-- <div class="col-12 col-md-12 col-sm-12"> --}}
                <div style="background-color:white;text-align: center;">

                    {{-- <div class="col-icon-wrapper">
                      <img src="{{ asset('User/images/icons/our-mission-icon.png')}}" alt="">
                    </div>
                    <h3 class="col-title">{{$item->nama}}</h3> --}}
                    <!-- <div class="col-details">

                      <p>Lorem ipsum dolor sit amet consect adipisscin elit proin vel lectus ut eta esami vera dolor sit amet consect</p>

                    </div> -->
                    <a href="{{route('programuser',$item->nama)}}">
                        <div class="btn btn-primary" style="border-radius: 50%; border:none; padding: 20px; margin: 4px 2px;">
                            <div style="width: 80x; height: 80px; align: center;">
                                <div style="margin-left: auto;margin-right: auto;">
                                    <img src="{{ asset('User/images/icons/our-mission-icon.png')}}" alt="">
                                </div>
                            </div>
                        </div>
                        <h3 class="col-title">{{$item->nama}}</h3>
                    </a>
                </div>
              {{-- </div> --}}
            </div>
            @endforeach
            @if($kategori1->count()>=7)
            <div class="col-3 col-md-3 col-sm-3">
                {{-- <div class="col-12 col-md-12 col-sm-12"> --}}
                  <div style="background-color:white;text-align: center;">

                      {{-- <div class="col-icon-wrapper">
                        <img src="{{ asset('User/images/icons/our-mission-icon.png')}}" alt="">
                      </div>
                      <h3 class="col-title">{{$item->nama}}</h3> --}}
                      <!-- <div class="col-details">

                        <p>Lorem ipsum dolor sit amet consect adipisscin elit proin vel lectus ut eta esami vera dolor sit amet consect</p>

                      </div> -->
                      <a href="" class="btn btn-primary" style="border-radius: 50%; border:none; padding: 20px; margin: 4px 2px;">
                          <div style="width: 150px; height: 150px; align: center;">
                              <div style="margin-left: auto;margin-right: auto;">
                                  <img src="{{ asset('User/images/icons/our-mission-icon.png')}}" alt="">
                              </div>
                              <h3 class="col-title">Lainnya</h3>
                          </div>
                      </a>
                  </div>
                {{-- </div> --}}
              </div>
            @endif
              {{-- selesai --}}
          </div>

      </div>

  </div> <!-- /.about-us -->

  <div class="section-home our-causes  ">

      <div class="container">

          <h2 class="title-style-1">Artikel<span class="title-under"></span></h2>

          <div class="row">
              @foreach ($artikel1 as $item)

              <div class="col-md-3 col-sm-6">

                  <div class="cause">
                      <img src="{{ Storage::url('public/PhotoArtikel/').$item->foto }}" alt="" class="cause-img">

                      <h4 class="cause-title"><a href="#">{{$item->nama}} </a></h4>
                      <div class="cause-details">
                          {!! Str::limit($item->detail_singkat,50,'...')!!}<hr>
                          Editor : {{$item->AdmNama}}<br>
                          Tanggal : {{$item->created_at}}
                      </div>
                      <div class="btn-holder text-center">
                        <a href="{{route('artikeluser.show',$item->id.$item->nama,)}}" class="btn btn-primary">Detail</a>
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
                    {!! $artikel1->links("pagination::bootstrap-4") !!}
                    </center>
                </div>
                <div class="col-md-3 col-sm-3">
                </div>
            </div>
        </div>
      </div>
  </div> <!-- /.our-causes -->
@endsection
