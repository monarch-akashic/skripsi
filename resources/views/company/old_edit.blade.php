@extends('layouts.app')
@section('content')
<div class="container">
    @include('inc.messages')
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="sub-heading">Company Profile</h4>
                    <form action="{{action('CompanyController@update', $company_info[0]->user_id)}}" method="POST" enctype="multipart/form-data">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <div class="row mb-2">
                            <div class="card-mb-3" style="width: 50%">
                                <div class="card-body">
                                    <div class="form-group">
                                        <label for="company_name">Company Name</label>
                                        <input type="text" name="company_name" class="form-control" placeholder="Company Name" value="{{$user_info->name}}">
                                    </div>

                                    <div class="form-group">
                                        <label for="tagline">Tagline</label>
                                        <input type="text" name="tagline" class="form-control" placeholder="Tagline" value="{{$company_info[0]->tagline}}">
                                    </div>

                                    <div class="form-group">
                                        <label for="background">Background</label>
                                        <input type="text" name="background" class="form-control" placeholder="Background" value="{{$company_info[0]->background}}">
                                    </div>

                                    <div class="form-group">
                                        <label for="website_link">Website Link</label>
                                        <input type="text" name="website_link" class="form-control" placeholder="Website Link" value="{{$company_info[0]->website_link}}">
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
                                        <label for="industry_type">Select Industry</label>
                                        <div class="input-group mb-3">
                                            <div class="input-group-prepend">
                                            <label class="input-group-text" for="inputGroupSelect01">Select Industry</label>
                                            </div>
                                            <select name="industry_type" id="inputGroupSelect01" class="custom-select">
                                                {{-- @foreach ($categories as $item) --}}
                                                    <option value="one" {{ $company_info[0]->industry_type == 'one' ? 'selected' : '' }}>One</option>
                                                    <option value="two" {{ $company_info[0]->industry_type == 'two' ? 'selected' : '' }}>Two</option>
                                                    <option value="three" {{ $company_info[0]->industry_type == 'three' ? 'selected' : '' }}>Three</option>
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
                                                    <option value="one" {{ $company_info[0]->company_size == 'one' ? 'selected' : '' }}>One</option>
                                                    <option value="two" {{ $company_info[0]->company_size == 'two' ? 'selected' : '' }}>Two</option>
                                                    <option value="three" {{ $company_info[0]->company_size == 'three' ? 'selected' : '' }}>Three</option>
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
                                                    <option value="one" {{ $company_info[0]->company_type == 'one' ? 'selected' : '' }}>One</option>
                                                    <option value="two" {{ $company_info[0]->company_type == 'two' ? 'selected' : '' }}>Two</option>
                                                    <option value="three" {{ $company_info[0]->company_type == 'three' ? 'selected' : '' }}>Three</option>
                                            </select>
                                        </div>
                                    </div>

                                    <input type="hidden" name="_method" value="{{ 'PUT' }}">
                                    <input type="submit" value="Update" class="btn btn-primary">
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
