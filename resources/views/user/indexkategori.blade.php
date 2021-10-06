@extends('user.master')

@section('scriptcss')
<!-- Owl carousel -->
<link rel="stylesheet" href="{{ asset('User/css/owl.carousel.css')}}">

@endsection

@section('scriptjs')


 <!-- owl carouseljavascript file -->
 <script src="{{ asset('User/js/owl.carousel.min.js')}}"></script>

@endsection

@section('content')
    <!-- Carousel
    ================================================== -->

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
                            <div style="width: 80px; height: 80px; align: center;">
                                <div style="margin-left: auto;margin-right: auto;">
                                    <img src="{{ Storage::url('public/PhotoKategori/').$item->icon }}" alt="" style="width: 80px; height: 80px;">
                                </div>
                            </div>
                        </div>
                        <h3 class="col-title">{{$item->nama}}</h3>
                    </a>
                </div>
              {{-- </div> --}}
            </div>
            @endforeach

              {{-- selesai --}}
          </div>

      </div>

  </div> <!-- /.about-us -->
@endsection
