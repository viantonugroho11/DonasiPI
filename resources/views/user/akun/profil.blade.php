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

        <h1 class="page-title">Profil<span class="title-under"></span></h1>
        <p class="page-description">
            @if (!(Auth::user()->email_verified_at))
                Email Belom Terverfikasi
                <form class="d-inline" method="POST" action="{{ route('verification.resend') }}">
                    @csrf
                    <button type="submit" class="btn btn-primary col-md-12">{{ __('Verifikasi Email') }}</button>.
                </form>
            @endif
        </p>

    </div>

</div>
<div class="main-container">

    <div class="container">

        <div class="row fadeIn animated">
            <div class="col-md-2">
                <h2 class="title-style-2"><span class="title-under"></span></h2>
                <div role="presentation" class="active">
                    <a href="#home" class="btn btn-block btn-primary btn-flat" aria-controls="home" role="tab" data-toggle="tab">Profil</a>
                </div>
				{{-- <div role="presentation">
                    <a href="#profile" class="btn btn-block btn-primary btn-flat" aria-controls="profile" role="tab" data-toggle="tab">Favorit</a>
                </div> --}}
                @if (!(Auth::user()->email_verified_at))
                @else
				<div role="presentation">
                    <a href="#messages" class="btn btn-block btn-primary btn-flat" aria-controls="messages" role="tab" data-toggle="tab">Riwayat</a>
                </div>
                @endif
				<div role="presentation">
                    <a href="#settings"class="btn btn-block btn-primary btn-flat" aria-controls="settings" role="tab" data-toggle="tab">Settings</a>
                </div>
            </div>
            <div class="col-md-10">
                <div class="tab-content">
                    <div role="tabpanel" class="tab-pane active" id="home">
                        <h2 class="title-style-2">Profil<span class="title-under"></span></h2>
                        <table class="table table-style-1">
                            <tbody>
                                <tr>
                                    <td>Nama</td>
                                    <td>{{Auth::user()->name}}</td>
                                </tr>
                                <tr>
                                    <td>Email</td>
                                    <td>
                                        {{Auth::user()->email}} <br>
                                        @if (!(Auth::user()->email_verified_at))
                                        Belom Verifikasi
                                        @else
                                        Telah Verifikasi
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <td>Alamat</td>
                                    <td>{{Auth::user()->alamat}}</td>
                                </tr>
                                <tr>
                                    <td>No Telp</td>
                                    <td>{{Auth::user()->no_hp}}</td>
                                </tr>
                                <tr>
                                    <td>Jumlah Donasi</td>
                                    <td>@currency($jumlahdonasi)</td>
                                </tr>
                                <tr>
                                    <td>Bergabung</td>
                                    <td>{{Auth::user()->created_at}}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div role="tabpanel" class="tab-pane" id="profile">
                        <h2 class="title-style-2">Daftar Favorit<span class="title-under"></span></h2>
                    </div>
                    <div role="tabpanel" class="tab-pane" id="messages">
                        <h2 class="title-style-2">Riwayat Transaksi<span class="title-under"></span></h2>
                        <table class="table table-style-1">
                            <thead>
                              <tr>
                                <th>#</th>
                                <th>OrderID</th>
                                <th>Nama</th>
                                <th>Status</th>
                                <th>Tipe</th>
                                <th>Tanggal</th>
                                <th>Jumlah</th>
                              </tr>
                            </thead>
                            <tbody>
                                @php
                                $i=1;
                                @endphp
                                @foreach ($riwayat as $item)
                                <tr>
                                    <td>{{$i++}}</td>
                                    <td>{{$item->orderid}}</td>
                                    <td>{{$item->PrgNama}}</td>
                                    <td>{{$item->status}}</td>
                                    <td>{{$item->tipe}}</td>
                                    <td>{{$item->updated_at}}</td>
                                    <td>@currency($item->nominal)</td>
                                </tr>
                                @endforeach
                            </tbody>
                          </table>
                    </div>
                    <div role="tabpanel" class="tab-pane" id="settings">
                        <h2 class="title-style-2">Setting Akun<span class="title-under"></span></h2>
                        <form method="POST" action="{{ route('profiluser.ganti') }}">
                            @csrf
                            {{-- <h4 class="cause-title">Edit</h4> --}}
                            {{-- Nama --}}
                            <div class="form-group row">
                                    <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Nama') }}</label>

                                    <div class="col-md-12">
                                        <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name',Auth::user()->name )}}" required autocomplete="name" autofocus>

                                        @error('name')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                            </div>
                            {{-- email verif --}}
                            <div class="form-group row">
                                    <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                                    <div class="col-md-12">
                                        @if (!(Auth::user()->email_verified_at))
                                        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">
                                        @else
                                        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email',Auth::user()->email) }}" readonly autocomplete="email">
                                        @endif

                                        @error('email')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                            </div>
                            {{-- Nama --}}
                            <div class="form-group row">
                                <label for="nohp" class="col-md-4 col-form-label text-md-right">{{ __('No Telp') }}</label>
                                <div class="col-md-12">
                                    <input id="nohp" type="text" class="form-control @error('nohp') is-invalid @enderror" name="nohp" value="{{ old('nohp',Auth::user()->no_hp )}}" autocomplete="name" autofocus>
                                    @error('nohp')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                        {{-- Nama --}}
                            <div class="form-group row">
                                <label for="alamat" class="col-md-4 col-form-label text-md-right">{{ __('Alamat') }}</label>
                                <div class="col-md-12">
                                    <input id="alamat" type="text" class="form-control @error('alamat') is-invalid @enderror" name="alamat" value="{{ old('alamat',Auth::user()->alamat )}}" autocomplete="name" autofocus>
                                    @error('alamat')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="newsletter" class="col-md-4 col-form-label text-md-right">{{ __('Newsletter') }}</label>
                                <div class="col-md-12">
                                    <select class="form-control @error('newsletter') is-invalid @enderror" name="alamat" value="{{ old('newsletter')}}" autocomplete="newsletter" autofocus>
                                        @if (!($newsletter))
                                        <option value="ya">Ya</option>
                                        <option value="tidak">Tidak</option>
                                        @else
                                        <option value="tidak">Tidak</option>
                                        <option value="ya">Ya</option>
                                        @endif
                                    </select>
                                    {{-- <input id="" type="text" class="form-control @error('alamat') is-invalid @enderror" name="alamat" value="{{ old('name',Auth::user()->alamat )}}" autocomplete="name" autofocus> --}}
                                    @error('newsletter')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                    <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

                                    <div class="col-md-12">
                                        <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" autocomplete="new-password">

                                        @error('password')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                            </div>
                            <div class="form-group row">
                                    <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('Confirm Password') }}</label>

                                    <div class="col-md-12">
                                        <input id="password-confirm" type="password" class="form-control" name="password_confirmation" autocomplete="new-password">
                                    </div>
                            </div>
                            <div class="form-group row mb-0">
                                  <div class="col-md-12 offset-md-12">
                                      <button type="submit" class="btn btn-primary col-md-12">
                                        {{ __('Perbarui') }}
                                      </button>
                                  </div>
                            </div>
                        </form>
                    </div>
                  </div>
            </div>
        </div>
    </div>
</div> <!-- /.main-container  -->
@endsection
