@extends('user.master')

@section('content')
<div class="section-home our-causes">
    <div class="container">
        {{-- <h2 class="title-style-1"><span class="title-under"></span></h2> --}}
        <div class="row">

            <div class="col-md-12 col-sm-12">

                <div class="cause">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    <form method="POST" action="{{ route('password.email') }}">
                        @csrf
                        <h4 class="cause-title">Password Reset</h4>
                        <div class="cause-details">
                        <div class="form-group row">
                            <label for="email" class="col-md-12 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                            <div class="col-md-12">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Send Password Reset Link') }}
                                </button>
                            </div>
                        </div>
                        </div>
                    </form>
                </div> <!-- /Login -->

            </div>
        </div>
    </div>
</div>
@endsection
