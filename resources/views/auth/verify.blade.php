@extends('user.master')

@section('content')
<div class="section-home our-causes">
    <div class="container">
        {{-- <h2 class="title-style-1"><span class="title-under"></span></h2> --}}
        <div class="row">

            <div class="col-md-12 col-sm-12">

                <div class="cause">
                    <h4 class="cause-title">{{ __('Verify Your Email Address') }}</h4>
                    <div class="cause-details">
                      @if (session('resent'))
                          <div class="alert alert-success" role="alert">
                              {{ __('A fresh verification link has been sent to your email address.') }}
                          </div>
                      @endif
                      {{ __('Before proceeding, please check your email for a verification link.') }}
                      {{ __('If you did not receive the email') }},
                      <form class="d-inline" method="POST" action="{{ route('verification.resend') }}">
                          @csrf
                          <button type="submit" class="btn btn-primary col-md-12">{{ __('click here to request another') }}</button>.
                      </form>
                    </div>
                </div> <!-- /Login -->

            </div>
        </div>
    </div>
</div>
@endsection
