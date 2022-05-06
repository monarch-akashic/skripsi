@extends('layouts.app')
@section('content')
@include('inc.messages')

<div class="col-md-12 text-center">
    Create Your Company Account
</div>

<div class="row mb-2" style="padding: 2%">
    <div class="container ml-5">
        <div class="row ml-5">
            <div class="col-md-4 ml-5 mr-5">
                <label for="exampleFormControlInput1" class="form-label">Company Name</label>
                <input type="email" class="form-control" id="exampleFormControlInput1" placeholder="">
                <label for="exampleFormControlInput1" class="form-label mt-3">Tagline </label>
                <input type="email" class="form-control" id="exampleFormControlInput1" placeholder="">
                <label for="exampleFormControlInput1" class="form-label mt-3">Select Industry</label>
                <div class="input-group">
                    <select class="form-select form-control" id="inputGroupSelect02">
                        <option selected>Choose...</option>
                        <option value="1">One</option>
                        <option value="2">Two</option>
                        <option value="3">Three</option>
                    </select>
                </div>
                <label for="exampleFormControlInput1" class="form-label mt-3">Company Size</label>
                <div class="input-group">
                    <select class="form-select form-control" id="inputGroupSelect02">
                        <option selected>Choose...</option>
                        <option value="1">One</option>
                        <option value="2">Two</option>
                        <option value="3">Three</option>
                    </select>
                </div>
                <label for="exampleFormControlInput1" class="form-label mt-3">Company Type</label>
                <div class="input-group">
                    <select class="form-select form-control" id="inputGroupSelect02">
                        <option selected>Choose...</option>
                        <option value="1">One</option>
                        <option value="2">Two</option>
                        <option value="3">Three</option>
                    </select>
                </div>
            </div>

            <div class="col-md-4 ml-5">
                <label for="exampleFormControlInput1" class="form-label">Upload Logo</label>
                <div class="input-group">
                    <input type="file" class="form-control" id="inputGroupFile01">
                </div>
                <label for="exampleFormControlInput1" class="form-label mt-3">Email</label>
                <input type="email" class="form-control" id="exampleFormControlInput1" placeholder="">
                <label for="exampleFormControlInput1" class="form-label mt-3">Password</label>
                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror"
                    name="password" required autocomplete="new-password">
                <label for="exampleFormControlInput1" class="form-label mt-3">Confirm Password</label>
                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required
                    autocomplete="new-password">
                <div class="col-md-12 text-center">
                    <button type="button" id="sidebarCollapse" class="btn btn-info mt-5 mb-5">
                        <span>Sign Up</span>
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
