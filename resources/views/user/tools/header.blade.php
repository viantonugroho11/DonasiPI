<header class="main-header">
    <nav class="navbar navbar-static-top">
        <div class="navbar-top">
          <div class="container">
              {{-- <div class="row">
                <div class="col-sm-6 col-xs-12">

                    <ul class="list-unstyled list-inline header-contact">
                        <li> <i class="fa fa-phone"></i> <a href="tel:">+212 658 986 213 </a> </li>
                         <li> <i class="fa fa-envelope"></i> <a href="mailto:contact@sadaka.org">contact@sadaka.org</a> </li>
                   </ul> <!-- /.header-contact  -->

                </div>

                <div class="col-sm-6 col-xs-12 text-right">

                    <ul class="list-unstyled list-inline header-social">

                        <li> <a href="#"> <i class="fa fa-facebook"></i> </a> </li>
                        <li> <a href="#"> <i class="fa fa-twitter"></i>  </a> </li>
                        <li> <a href="#"> <i class="fa fa-google"></i>  </a> </li>
                        <li> <a href="#"> <i class="fa fa-youtube"></i>  </a> </li>
                        <li> <a href="#"> <i class="fa fa fa-pinterest-p"></i>  </a> </li>
                   </ul> <!-- /.header-social  -->

                </div>


              </div> --}}
          </div>

        </div>

        <div class="navbar-main">

          <div class="container">

            <div class="navbar-header">
              <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">

                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>

              </button>

              <a class="navbar-brand" href="{{route('home')}}">Kepedulian Masyarakat</a>

            </div>

            <div id="navbar" class="navbar-collapse collapse pull-right">

              <ul class="nav navbar-nav">

                <li><a class="{{ Request::is('/') ? 'is-active' : '' }}" href="{{route('home')}}">Home</a></li>
                {{-- <li><a href="about.html">ABOUT</a></li> --}}

                <li class="has-child"><a href="#">Kategori</a>
                    <ul class="submenu">
                       @foreach ($kategori as $item)
                       <li class="submenu-item"><a class="{{ Request::segment(2) === '/Kategori/{id}' ? 'is-active' : '' }}" href="{{route('programuser',$item->nama)}}">{{$item->nama}}</a></li>
                       @endforeach
                       @if($kategori->count()>=4)
                       <li class="submenu-item"><a class="" href="{{route('kategoriuser')}}">Lainnya</a></li>
                       @endif
                    </ul>

                </li>
                <li><a class="{{ Request::is('/Gallery') ? 'is-active' : '' }}" href="{{route('galleryuser')}}">Gallery</a></li>
                <li><a class="{{ Request::is('/Artikels') ? 'is-active' : '' }}" href="{{route('artikeluser')}}">Artikel</a></li>
                <li><a class="{{ Request::is('/Event') ? 'is-active' : '' }}" href="{{route('eventuser')}}">Event</a></li>
                @if (Auth::check())
                <li class="has-child"><a href="#">Profil</a>
                    <ul class="submenu">
                        <li class="submenu-item"><a class="" href="{{route('profiluser')}}">{{Auth::user()->name}}</a></li>
                        @if (!(Auth::user()->email_verified_at))
                            <li class="submenu-item"><a class="" href="{{route('verification.notice')}}">Email Belom Verifikasi</a></li>
                        @else
                            @if(!(Auth::user()->saldo))
                              <li class="submenu-item"><a class="" href="{{route('saldouser')}}">Saldo Kebaikan<br>Rp. 0</a></li>
                            @else
                              <li class="submenu-item"><a class="" href="{{route('saldouser')}}">Saldo Kebaikan<br>@currency(auth::user()->saldo)</a></li>
                            @endif
                        @endif
                        {{-- <li class="submenu-item"><a class="" href="">TopUp</a></li> --}}
                        <li class="submenu-item"><a class="" href="{{route('riwayatuser')}}">Riwayat Donasi</a></li>
                        <li class="submenu-item">
                                    <a class="" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                        </li>
                    </ul>
                </li>
                @else
                <li class="submenu-item"><a class="{{ request::is('/login') ? 'is-active' : '' }}" href="{{route('login')}}">Login</a></li>
                {{-- <li class="submenu-item"><a class="{{ request::is('/register') ? 'is-active' : '' }}" href="{{route('register')}}">Daftar</a></li> --}}
                @endif
              </ul>

            </div> <!-- /#navbar -->

          </div> <!-- /.container -->

        </div> <!-- /.navbar-main -->


    </nav>

</header> <!-- /. main-header -->
