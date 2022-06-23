@extends('layouts.app')
@section('content')
<div class="container">
    @include('inc.messages')
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-body">
                    <h4 class="sub-heading">Company Profile</h3>
                    <div class="row mb-2">
                        <div class="card-mb-3" style="width: 50%">
                            <div class="card-body">
                                <div class="form-group">
                                    <h5 class="text-primary font-weight-bold">Company Name</h5>
                                    <p class="font-weight-bold">
                                        {{$user->name}}
                                    </p>
                                </div>

                                <div class="form-group">
                                    <h5 class="text-primary font-weight-bold">Industry Type</h5>
                                    <p class="font-weight-bold">
                                        {{$company[0]->industry_type}}
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="card-mb-3" style="width: 50%">
                            <div class="card-body">
                                <div class="profile-header-avatar float-right" style="background-image: url('../storage/img/{{$company[0]->logo}}')"></div>

                            </div>
                        </div>
                    </div>

                    <div class="row mb-2">
                        <div class="card-mb-3" style="width: 100%">
                            <div class="card-body">
                                <div class="form-group">
                                    <h5 class="text-primary font-weight-bold">Description</h5>
                                    <p class="font-weight-bold">
                                        {{$company[0]->tagline}}
                                    </p>
                                </div>

                                <div class="form-group">
                                    <h5 class="text-primary font-weight-bold">Background</h5>
                                    <p class="font-weight-bold">
                                        {{$company[0]->background}}
                                    </p>
                                </div>

                                <div class="form-group">
                                    <h5 class="text-primary font-weight-bold">Site</h5>
                                    <p class="font-weight-bold">
                                        {{$company[0]->website_link}}
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <a class="btn btn-primary" href="/company/{{$user->id}}/edit">Update</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
