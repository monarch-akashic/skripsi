@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-body">
                    <h4 class="sub-heading">Login to your account</h3>

                    <form method="POST" action="{{ route('login') }}">
                        @csrf
                        <div class="form-group row">
                            <label for="email"
                                class="col-md-12 col-form-label text-md-left">{{ __('E-Mail Address') }}</label>

                            <div class="col-md-12">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror"
                                    name="email" value="{{ old('email') }}" required autocomplete="email"
                                    autofocus>

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password"
                                class="col-md-12 col-form-label text-md-left">{{ __('Password') }}</label>

                            <div class="col-md-12">
                                <input id="password" type="password"
                                    class="form-control @error('password') is-invalid @enderror" name="password" required
                                    autocomplete="current-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>


                        <div class="form-group row mb-0">
                            <div class="col-md-12">
                                <button type="submit" class="btn btn-primary btn-lg btn-block">
                                    {{ __('Login') }}
                                </button>
                                <a class="btn btn-outline-primary btn-lg btn-block"
                                    href="{{ '/auth/redirect' }}">
                                    {{ __('Sign in with Google') }}
                                </a>

                                <hr>

                                <a>
                                    {{ __('You dont have and account?') }}
                                </a>
                                <a href="/register" class="text-primary">
                                    {{ __('Register Here') }}
                                </a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card">

                <div class="card-body">
                    <div style="font-weight: bold; font-size: 40px; color: #0FC2C0">
                        Find Your
                        Side Job
                        with
                    </div>
                    <div class="form-group m-0">
                        <img src="/storage/assets/sidejobsitewithlogo_warna.png" style="width: 100%" alt="">
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
