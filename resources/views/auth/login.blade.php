@extends('user.master')

@section('content')
<div class="section-home our-causes">
    <div class="container">
        {{-- <h2 class="title-style-1"><span class="title-under"></span></h2> --}}
        <div class="row">
            <div class="col-md-3 col-sm-3">
            </div>
            <div class="col-md-6 col-sm-6">
                <div class="cause">
                  <form method="POST" action="{{ route('login') }}">
                      @csrf
                    <h4 class="cause-title">Login</h4>
                    <div class="cause-details">
                      <div class="form-group row">
                          <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>
                          <div class="col-md-12">
                              <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                              @error('email')
                                  <span class="invalid-feedback" role="alert">
                                      <strong>{{ $message }}</strong>
                                  </span>
                              @enderror
                          </div>
                      </div>
                      <div class="form-group row">
                        <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

                        <div class="col-md-12">
                            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                            @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                      </div>

                      <div class="form-group row">
                          <div class="col-md-6 offset-md-4">
                              <div class="form-check">
                                  <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                  <label class="form-check-label" for="remember">
                                      {{ __('Remember Me') }}
                                  </label>
                              </div>
                              @if (Route::has('password.request'))
                                <a class="btn btn-link" href="{{ route('password.request') }}">
                                    {{ __('Forgot Your Password?') }}
                                </a>
                              @endif
                          </div>
                      </div>
                      <div class="form-group row mb-0">
                          <div class="col-md-6 offset-md-6">
                              <button type="submit" class="btn btn-primary col-md-12">
                                  {{ __('Login') }}
                              </button>
                          </div>
                          <div class="col-md-6 offset-md-6">
                              <a href="{{route('register')}}" class="btn btn-primary col-md-12">
                                  {{ __('Register') }}
                              </a>
                          </div>
                      </div>
                      {{-- <div class="form-group row mb-0">
                          <div class="col-md-12 offset-md-12">
                              <a href="/auth/google" class="btn btn-danger col-md-12">
                                  Login With Google
                              </a>
                          </div>
                      </div> --}}
                      {{-- selesai Goggle --}}
                      {{-- <div class="form-group row mb-0">
                        <div class="col-md-12 offset-md-12">
                            <a href="/auth/facebook" class="btn btn-blue col-md-12">
                                Login With Facebook
                            </a>
                        </div>
                      </div> --}}
                      {{-- selesai fb --}}
                      {{-- <div class="form-group row mb-0">
                        <div class="col-md-12 offset-md-12">
                          <a href="/auth/twitter" class="btn btn-success col-md-12">
                              Login With Twitter
                          </a>
                        </div>
                      </div> --}}
                      {{-- selesai Twitter --}}
                    </div>
                  </form>
                </div> <!-- /Login -->

            </div>
            {{-- Selesai Login --}}
            {{-- <div class="col-md-6 col-sm-6">

                <div class="cause">
                  <form method="POST" action="{{ route('register') }}">
                    @csrf
                    <h4 class="cause-title">Daftar</h4>
                    <div class="cause-details">
                      <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>

                            <div class="col-md-12">
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                      </div>
                      <div class="form-group row">
                        <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                        <div class="col-md-12">
                            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="nohp">

                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                      </div>
                      <div class="form-group row">
                        <label for="alamat" class="col-md-4 col-form-label text-md-right">{{ __('Address') }}</label>

                        <div class="col-md-12">
                            <input id="alamat" type="text" class="form-control @error('alamat') is-invalid @enderror" name="alamat" value="{{ old('alamat') }}" required autocomplete="alamat">

                            @error('alamat')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                      </div>
                      <div class="form-group row">
                        <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('Nomor Telepon') }}</label>

                        <div class="col-md-12">
                            <input id="nohp" type="text" class="form-control @error('nohp') is-invalid @enderror" name="nohp" value="{{ old('nohp') }}" required autocomplete="nohp">

                            @error('nohp')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                      </div>
                      <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

                            <div class="col-md-12">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

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
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                            </div>
                      </div>

                      <div class="form-group row mb-0">
                          <div class="col-md-12 offset-md-12">
                              <button type="submit" class="btn btn-primary col-md-12">
                                {{ __('Register') }}
                              </button>
                          </div>
                      </div>
                      <div class="form-group row mb-0">
                          <div class="col-md-12 offset-md-12">
                              <a href="/auth/google" class="btn btn-danger col-md-12">
                                  Register With Google
                              </a>
                          </div>
                      </div>
                    </div>
                  </form>
                </div> <!-- /Login -->

            </div> --}}

        </div>

    </div>

</div> <!-- /.our-causes -->
@endsection
