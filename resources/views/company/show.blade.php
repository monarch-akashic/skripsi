@extends('layouts.app')
@section('content')
<div class="container">
    @include('inc.messages')
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-body">
                    <h4 class="sub-heading">Job Offerer Profile</h3>
                    <div class="row mb-0">
                        <div class="card align-items-center" style="width: 30%; border: 0ch">
                            {{-- <div class="card-body"> --}}
                                <div class="profile-header-avatar " style="background-image: url('/storage/img/company/{{$company[0]->logo}}')"></div>
                            {{-- </div> --}}
                        </div>
                        <div class="card-mb-2" style="width: 50%">
                            <div class="card-body">
                                <div class="form-group">
                                    <h4 class="text-dark font-weight-bold">{{$user->name}}</h4>
                                    {{-- <p class="font-weight-bold">

                                    </p> --}}
                                </div>

                                <div class="form-group">
                                    <h5 class="text-dark font-weight-bold">{{$company[0]->industry_type}}</h5>
                                    <p class="font-weight-bold">
                                        {{$company[0]->tagline}}
                                    </p>
                                </div>

                                {{-- <div class="form-group">
                                    <h5 class="text-primary font-weight-bold">Tagline</h5>
                                    <p class="font-weight-bold">

                                    </p>
                                </div> --}}
                            </div>
                        </div>

                    </div>

                    <div class="row mb-2">
                        <div class="card-mb-3" style="width: 100%">
                            <div class="card-body">
                                <div class="form-group">
                                    <h5 class="text-primary font-weight-bold">Description</h5>
                                    <p class="font-weight-bold">
                                        {{$company[0]->description}}
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
                    @if ($company[0]->user_id == Auth::user()->id)
                        <div class="row mb-2">
                            <div class="card-body" style="text-align:right">
                                <a class="btn btn-primary " href="/company/{{$user->id}}/edit">Update</a>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
