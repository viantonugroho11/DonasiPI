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
    <div id="homeCarousel" class="carousel slide carousel-home" data-ride="carousel">

        <!-- Indicators -->

        @php
        $i=0;    
        @endphp
        <ol class="carousel-indicators">
          @foreach ($program1 as $item)       
          @php
          $i++;    
          @endphp
          <li data-target="#homeCarousel" data-slide-to="0" class="@if($i==1) active ?? '' @endif"></li>
          {{-- <li data-target="#homeCarousel" data-slide-to="1"></li>
          <li data-target="#homeCarousel" data-slide-to="2"></li> --}}
          @endforeach
        </ol>
        @php
        $a=0;    
        @endphp
        <div class="carousel-inner" role="listbox">
          @foreach ($program1 as $item)
          @php
          $a++;    
          @endphp
          <div class="item @if($a<=1) active @endif">

            <img src="{{ asset('asset/hitam.jpg')}}" alt="">
            {{-- <img src="{{ Storage::url('public/PhotoProgram/').$item->foto }}" alt=""> --}}

            <div class="container">

              <div class="carousel-caption">

                <h2 class="carousel-title bounceInDown animated slow">{{$item->nama}}</h2>
                <h4 class="carousel-subtitle bounceInUp animated slow ">{{ Str::limit($item->detail_singkat,50,'...')}}</h4>
                <a href="{{route('programuser.show',$item->id.$item->nama,)}}" class="btn btn-lg btn-secondary hidden-xs bounceInUp animated slow">Donasi</a>

              </div> <!-- /.carousel-caption -->

            </div>

          </div>    
          @endforeach
           <!-- /.item -->

          {{-- <div class="item">

            <img src="assets/images/slider/home-slider-2.jpg" alt="">

            <div class="container">

              <div class="carousel-caption">

                <h2 class="carousel-title bounceInDown animated slow">Together we can improve their lives</h2>
                <h4 class="carousel-subtitle bounceInUp animated slow"> So let's do it !</h4>
                <a href="#" class="btn btn-lg btn-secondary hidden-xs bounceInUp animated" data-toggle="modal" data-target="#donateModal">DONATE NOW</a>

              </div> <!-- /.carousel-caption -->

            </div>

          </div> --}}
          <!-- /.item -->

          {{-- <div class="item ">

            <img src="assets/images/slider/home-slider-3.jpg" alt="">

            <div class="container">

              <div class="carousel-caption">

                <h2 class="carousel-title bounceInDown animated slow" >A penny is a lot of money, if you have not got a penny.</h2>
                <h4 class="carousel-subtitle bounceInUp animated slow">You can make the diffrence !</h4>
                <a href="#" class="btn btn-lg btn-secondary hidden-xs bounceInUp animated slow" data-toggle="modal" data-target="#donateModal">DONATE NOW</a>

              </div> <!-- /.carousel-caption -->

            </div>

          </div> --}}
          <!-- /.item -->

        </div>

        <a class="left carousel-control" href="#homeCarousel" role="button" data-slide="prev">
          <span class="fa fa-angle-left" aria-hidden="true"></span>
          <span class="sr-only">Previous</span>
        </a>

        <a class="right carousel-control" href="#homeCarousel" role="button" data-slide="next">
          <span class="fa fa-angle-right" aria-hidden="true"></span>
          <span class="sr-only">Next</span>
        </a>

  </div><!-- /.carousel -->

  <div class="section-home about-us fadeIn animated">

      <div class="container">

          <div class="row">
            {{-- kategori --}}
            @foreach ($kategori1 as $item)
            <div class="col-3 col-md-3 col-sm-3 col-xs-3">
              {{-- <div class="col-12 col-md-12 col-sm-12"> --}}
                <div style="background-color:white;text-align: center;">

                    {{-- {{-- <div class="col-icon-wrapper">
                      <img src="{{ asset('User/images/icons/our-mission-icon.png')}}" alt="">
                    </div>
                    <h3 class="col-title">{{$item->nama}}</h3> 
                    <!-- <div class="col-details">

                      <p>Lorem ipsum dolor sit amet consect adipisscin elit proin vel lectus ut eta esami vera dolor sit amet consect</p>

                    </div> --> --}}
                    <a href="{{route('programuser',$item->nama)}}">
                        <div class="btn btn-primary" style="border-radius: 50%; border:none; padding: 5%; margin: 4px 2px;">
                            <div style="max-width: 80px; max-height: 80px; align: center;">
                                <div style="margin-left: auto;margin-right: auto;">
                                    <img src="{{ Storage::url('public/PhotoKategori/').$item->icon }}" alt="" style="max-width: 80px; max-height: 80px; width: 100%; height:100%;">
                                </div>
                            </div>
                        </div>
                        <div class="card">
                          <h5 class="col-title">{{$item->nama}}</h5>
                        </div>
                    </a>
                </div>
              {{-- </div> --}}
            </div>
            @endforeach
            @if($kategori1->count()>=3)
            <div class="col-3 col-md-3 col-sm-3 col-xs-3">
                {{-- <div class="col-12 col-md-12 col-sm-12"> --}}
                  <div style="background-color:white;text-align: center;">

                      {{-- <div class="col-icon-wrapper">
                        <img src="{{ asset('User/images/icons/our-mission-icon.png')}}" alt="">
                      </div>
                      <h3 class="col-title">{{$item->nama}}</h3> --}}
                      <!-- <div class="col-details">

                        <p>Lorem ipsum dolor sit amet consect adipisscin elit proin vel lectus ut eta esami vera dolor sit amet consect</p>

                      </div> -->
                      <a href="{{route('kategoriuser')}}">
                          <div class="btn btn-primary" style="border-radius: 50%; border:none; padding: 5%; margin: 4px 2px;">
                              <div style="max-width: 80px; max-height: 80px; align: center;">
                                  <div style="margin-left: auto;margin-right: auto;">
                                      <img src="{{ asset('asset/lainnya1.png')}}" alt=""  style="max-width: 80px; max-height: 80px; width: 100%; height:100%;">
                                  </div>
                              </div>
                          </div>
                          <h5 class="col-title">Lainnya</h5>
                      </a>
                  </div>
                {{-- </div> --}}
            </div>
            @endif
              {{-- selesai --}}
          </div>

      </div>

  </div> <!-- /.about-us -->

  {{-- <div class="section-home home-reasons">

      <div class="container">

          <div class="row"

          >

              <div class="col-md-6">

                  <div class="reasons-col  ">

                      <img src="{{ asset('User/images/reasons/we-fight-togother.jpg')}}" alt="">

                      <div class="reasons-titles">

                          <h3 class="reasons-title">We fight together</h3>
                          <h5 class="reason-subtitle">We are humans</h5>

                      </div>

                      <div class="on-hover hidden-xs">

                              <p> Lorem ipsum dolor sit amet, consectetur adipisicing elit. Tenetur praesentium, itaque facilis nesciunt ab omnis cumque similique ipsa veritatis perspiciatis, harum ad at nihil molestias, dignissimos sint consequuntur. Officia, fuga.</p>


                              <p> Lorem ipsum dolor sit amet, consectetur adipisicing elit. Tenetur praesentium, itaque facilis nesciunt ab omnis cumque similique ipsa veritatis perspiciatis, harum ad at nihil molestias, dignissimos sint consequuntur. Officia, fuga.</p>

                              <p> Lorem ipsum dolor sit amet, consectetur adipisicing elit. Tenetur praesentium, itaque facilis nesciunt ab omnis cumque similique ipsa veritatis perspiciatis, harum ad at nihil molestias, dignissimos sint consequuntur. Officia, fuga.</p>

                      </div>
                  </div>

              </div>


              <div class="col-md-6">

                  <div class="reasons-col  ">

                      <img src="{{ asset('User/images/reasons/we-care-about.jpg')}}" alt="">

                      <div class="reasons-titles">

                          <h3 class="reasons-title">WE care about others</h3>
                          <h5 class="reason-subtitle">We are humans</h5>

                      </div>

                      <div class="on-hover hidden-xs">

                              <p> Lorem ipsum dolor sit amet, consectetur adipisicing elit. Tenetur praesentium, itaque facilis nesciunt ab omnis cumque similique ipsa veritatis perspiciatis, harum ad at nihil molestias, dignissimos sint consequuntur. Officia, fuga.</p>


                              <p> Lorem ipsum dolor sit amet, consectetur adipisicing elit. Tenetur praesentium, itaque facilis nesciunt ab omnis cumque similique ipsa veritatis perspiciatis, harum ad at nihil molestias, dignissimos sint consequuntur. Officia, fuga.</p>

                              <p> Lorem ipsum dolor sit amet, consectetur adipisicing elit. Tenetur praesentium, itaque facilis nesciunt ab omnis cumque similique ipsa veritatis perspiciatis, harum ad at nihil molestias, dignissimos sint consequuntur. Officia, fuga.</p>
                      </div>
                  </div>
              </div>
          </div>
      </div>


  </div> <!-- /.home-reasons --> --}}

  <div class="section-home our-causes  ">

      <div class="container">

          <h2 class="title-style-1">Donasi<span class="title-under"></span></h2>

          <div class="row">
              @foreach ($program as $p)
              <div class="col-md-3 col-sm-6">
                  <div class="cause" style="border-radius: 25px;">
                      <img src="{{ Storage::url('public/PhotoProgram/').$p->foto }}" alt="" class="cause-img" style="border-radius: 25px;">
                      <div class="progress cause-progress">
                          <div class="progress-bar" role="progressbar" aria-valuenow="{{($p->getTransaksi->where('status','=','settlement')->sum('nominal')/$p->nominal)*100}}"
                            aria-valuemin="0" aria-valuemax="100" style="width: {{($p->getTransaksi->where('status','=','settlement')->sum('nominal')/$p->nominal)*100}}%;max-width: 100%;">
                            @if($p->getTransaksi->where('status','=','settlement')->sum('nominal')==null)
                                Rp. 0
                            @else
                                @currency($p->getTransaksi->where('status','=','settlement')->sum('nominal'))
                            @endif
                           / @currency($p->nominal)
                        </div>
                      </div>
                      <h4 class="cause-title"><a href="#">{{$p->nama}} </a></h4>
                      <div class="cause-details">
                        <p>
                            {{ Str::limit($p->detail_singkat,50,'...')}}<hr>
                        </p>
                          <hr/>
                          Batas : {{$p->batas}}
                      </div>
                      <div class="btn-holder text-center">
                        <a href="{{route('programuser.show',$p->id.$p->nama,)}}" class="btn btn-primary" style="border-radius: 25px;">Klik Me</a>
                      </div>
                  </div> <!-- /.cause -->
              </div>
              @endforeach
          </div>
      </div>
  </div> <!-- /.our-causes -->
@endsection
