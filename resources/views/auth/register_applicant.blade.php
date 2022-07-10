@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="sub-heading">
                        Create your account
                    </h4>
                    <form method="POST" action="{{ route('register') }}">
                        @csrf
                        <div class="row mb-2">
                            <div class="card-mb-3" style="width: 50%">
                                <div class="card-body">
                                    <div class="form-group">
                                        <label for="name"
                                            >{{ __('Name') }}</label>
                                            <input id="name" type="text"
                                                class="form-control @error('name') is-invalid @enderror" name="name"
                                                value="{{ old('name') }}" required autocomplete="name"
                                                autofocus>

                                            @error('name')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                    </div>

                                    <div class="form-group">
                                        <label for="phoneNo"
                                            >{{ __('Phone Number') }}</label>


                                            <input id="phoneNo" type="number"
                                                class="form-control @error('phoneNo') is-invalid @enderror"
                                                name="phoneNo" value="{{ old('phoneNo') }}" required
                                                autocomplete="phoneNo" autofocus>

                                            @error('phoneNo')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror

                                    </div>



                                    <div class="form-group">
                                        <label for="dob">{{ __('Date of Birth') }}</label>


                                            <input id="dob" type="date" class="form-control @error('dob') is-invalid @enderror" name="dob"
                                                value="{{ old('dob') }}" required autocomplete="dob"
                                                >

                                            @error('dob')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror

                                    </div>


                                </div>
                            </div>
                            <div class="card-mb-3" style="width: 50%">
                                <div class="card-body">
                                    <div class="form-group">
                                        <label for="email"
                                            >{{ __('E-Mail Address') }}</label>


                                            <input id="email" type="email"
                                                class="form-control @error('email') is-invalid @enderror" name="email"
                                                value="{{ old('email') }}" required
                                                autocomplete="email">

                                            @error('email')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror

                                    </div>

                                    <div class="form-group">
                                        <label for="password"
                                            >{{ __('Password') }}</label>


                                            <input id="password" type="password"
                                                class="form-control @error('password') is-invalid @enderror"
                                                name="password" required autocomplete="new-password">

                                            @error('password')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror

                                    </div>

                                    <div class="form-group">
                                        <label for="password-confirm"
                                            >{{ __('Confirm Password') }}</label>


                                            <input id="password-confirm" type="password" class="form-control"
                                                name="password_confirmation" required autocomplete="new-password">

                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row mb-2 justify-content-center">
                            <div class="form-group" style="width: 50%">
                                <button type="submit" class="btn btn-primary btn-lg btn-block">
                                    {{ __('Sign Up') }}
                                </button>

                                <a href="/auth/redirect" class="btn btn-outline-primary btn-lg btn-block">
                                    {{ __('Sign in with Google') }}
                                </a>
                            </div>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
