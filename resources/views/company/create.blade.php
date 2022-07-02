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
                        <div class="row m-2">
                            <div class="card-m-3" style="width: 20%">
                                <div class="profile-header-avatar align-middle"
                                    style="background-image: url('../storage/img/default.jpg')">
                                </div>
                            </div>
                            <div class="card-m-3" style="width: 30%">
                                <div class="form-group">
                                    <label for="logo">Company Logo :</label>
                                    <div class="custom-file">
                                        <input type="file" name="logo" class="custom-file-input">
                                        <label class="custom-file-label" for="customFile">Choose file</label>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="company_name">Company Name</label>
                                    <input type="text" name="company_name" class="form-control @error('company_name') is-invalid @enderror" placeholder="Company Name"
                                        value="{{ $user_info->name }}">

                                    @error('company_name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row mb-2">
                            <div class="card-mb-3" style="width: 50%">
                                <div class="card-body">

                                    <div class="form-group">
                                        <label for="tagline">Tagline</label>
                                        <input type="text" name="tagline" class="form-control @error('tagline') is-invalid @enderror" placeholder="Tagline" value="{{old('tagline')}}">

                                        @error('tagline')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>



                                    <div class="form-group">
                                        <label for="description">Description</label>
                                        <input type="text" name="description" class="form-control @error('description') is-invalid @enderror" placeholder="Description" value="{{old('description')}}">

                                        @error('description')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label for="website_link">Website Link</label>
                                        <input type="text" name="website_link" class="form-control" placeholder="Website Link" value="{{old('website_link')}}">
                                    </div>

                                </div>
                            </div>

                            <div class="card-mb-3" style="width: 50%">
                                <div class="card-body">

                                    <div class="form-group">
                                        <label for="background">Background</label>
                                        <textarea name="background" class="form-control @error('background') is-invalid @enderror" id="background" rows="5" style="width:100%; ">{{old('background')}}</textarea>

                                        @error('background')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <div class="input-group mb-3">
                                            <div class="input-group-prepend">
                                                <label class="input-group-text" for="inputGroupSelect01">Select Industry</label>
                                            </div>
                                            <select name="industry_type" id="inputGroupSelect01" class="custom-select @error('industry_type') is-invalid @enderror">
                                                <option value="" disabled selected>--Select--</option>

                                                @foreach ($it_category as $item)
                                                    <option value="{{$item->name}}" {{ old('industry_type') == $item->name ? 'selected' : '' }}>{{$item->name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        @error('industry_type')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <div class="input-group mb-3">
                                            <div class="input-group-prepend">
                                                <label class="input-group-text" for="inputGroupSelect01">Company Size</label>
                                            </div>
                                            <select name="company_size" id="inputGroupSelect01" class="custom-select @error('company_size') is-invalid @enderror">
                                                <option value="" disabled selected>--Select--</option>

                                                @foreach ($is_category as $item)
                                                    <option value="{{$item->name}}" {{ old('company_size') == $item->name ? 'selected' : '' }}>{{$item->name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        @error('company_size')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>

                                    {{-- <div class="form-group">
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
                                    </div> --}}

                                </div>
                            </div>
                        </div>
                        <div class="row mb-2">
                            <div class="card-body" style="text-align:right">
                                <input type="submit" value="Save" class="btn btn-primary">
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
