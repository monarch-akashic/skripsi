@extends('layouts.app')
@section('content')
<div class="container">
    @include('inc.messages')
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="sub-heading">Create Your Company Account</h3>
                    <form action="{{action('CompanyController@store')}}" method="POST" enctype="multipart/form-data">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <div class="row mb-2">
                            <div class="card-mb-3" style="width: 50%">
                                <div class="card-body">
                                    <div class="form-group">
                                        <label for="company_name">Company Name</label>
                                        <input type="text" name="company_name" class="form-control" placeholder="Company Name" value="{{old('company_name')}}">
                                    </div>

                                    <div class="form-group">
                                        <label for="tagline">Tagline</label>
                                        <input type="text" name="tagline" class="form-control" placeholder="Tagline" value="{{old('tagline')}}">
                                    </div>

                                    <div class="form-group">
                                        <label for="background">Background</label>
                                        <input type="text" name="background" class="form-control" placeholder="Background" value="{{old('background')}}">
                                    </div>

                                    <div class="form-group">
                                        <label for="website_link">Website Link</label>
                                        <input type="text" name="website_link" class="form-control" placeholder="Website Link" value="{{old('website_link')}}">
                                    </div>

                                    <div class="form-group">
                                        <label for="industry_type">Select Industry</label>
                                        <div class="input-group mb-3">
                                            <div class="input-group-prepend">
                                            <label class="input-group-text" for="inputGroupSelect01">Select Industry</label>
                                            </div>
                                            <select name="industry_type" id="inputGroupSelect01" class="custom-select">
                                                {{-- @foreach ($categories as $item) --}}
                                                    <option value="one" {{ old('industry_type') == 'one' ? 'selected' : '' }}>One</option>
                                                    <option value="two" {{ old('industry_type') == 'two' ? 'selected' : '' }}>Two</option>
                                                    <option value="three" {{ old('industry_type') == 'three' ? 'selected' : '' }}>Three</option>
                                                {{-- @endforeach --}}
                                            </select>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="company_size">Company Size</label>
                                        <div class="input-group mb-3">
                                            <div class="input-group-prepend">
                                            <label class="input-group-text" for="inputGroupSelect01">Company Size</label>
                                            </div>
                                            <select name="company_size" id="inputGroupSelect01" class="custom-select">
                                                    <option value="one" {{ old('company_size') == 'one' ? 'selected' : '' }}>One</option>
                                                    <option value="two" {{ old('company_size') == 'two' ? 'selected' : '' }}>Two</option>
                                                    <option value="three" {{ old('company_size') == 'three' ? 'selected' : '' }}>Three</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="company_type">Company Type</label>
                                        <div class="input-group mb-3">
                                            <div class="input-group-prepend">
                                            <label class="input-group-text" for="inputGroupSelect01">Company Type</label>
                                            </div>
                                            <select name="company_type" id="inputGroupSelect01" class="custom-select">
                                                    <option value="one" {{ old('company_type') == 'one' ? 'selected' : '' }}>One</option>
                                                    <option value="two" {{ old('company_type') == 'two' ? 'selected' : '' }}>Two</option>
                                                    <option value="three" {{ old('company_type') == 'three' ? 'selected' : '' }}>Three</option>
                                            </select>
                                        </div>
                                    </div>


                                </div>
                            </div>

                            <div class="card-mb-3" style="width: 50%">
                                <div class="card-body">
                                    <div class="form-group">
                                        <label for="logo">Logo :</label>
                                        <div class="custom-file">
                                            <input type="file" name="logo" class="custom-file-input">
                                            <label class="custom-file-label" for="customFile">Choose file</label>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="email">Email</label>
                                        <input type="email" name="email" class="form-control" placeholder="Email" value="{{old('email')}}">
                                    </div>

                                    <div class="form-group">
                                        <label for="password">Password</label>
                                        <input id="password"type="password" name="password" class="form-control" placeholder="Password" required autocomplete="new-password">
                                    </div>
                                    <div class="form-group">
                                        <label for="password-confirm">Confirm Password</label>
                                        <input id="password-confirm" type="password" name="password_confirmation" class="form-control" placeholder="Confirm Password" required autocomplete="new-password">
                                    </div>
                                    <input type="submit" value="Submit" class="btn btn-primary">
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
