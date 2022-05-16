@extends('layouts.app')
@section('content')
<div class="container">
    @include('inc.messages')
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="sub-heading">My Profile</h3>

                        <div class="row mb-2">
                            <div class="card-mb-3" style="width: 75%">
                                <div class="card-body">

                                    <div class="form-group">
                                        <h5 class="text-primary font-weight-bold">Full Name</h5>
                                        <p class="font-weight-bold">
                                            {{$user->name}}
                                        </p>
                                    </div>

                                    <div class="form-group">
                                        <h5 class="text-primary font-weight-bold">Phone Number</h5>
                                        <p class="font-weight-normal">
                                            {{$user->phoneNo}}
                                        </p>
                                    </div>

                                    <div class="form-group">
                                        <h5 class="text-primary font-weight-bold">Email</h5>
                                        <p class="font-weight-normal">
                                            {{$user->email}}
                                        </p>

                                    </div>

                                    <div class="form-group">
                                        <h5 class="text-primary font-weight-bold">Date of Birth</h5>
                                        <p class="font-weight-normal">
                                            {{$user->dob}}
                                        </p>
                                    </div>

                                    <div class="form-group">
                                        <h5 class="text-primary font-weight-bold">Education</h5>
                                        <p class="font-weight-normal">
                                            {{$portofolio[0]->education}}
                                        </p>
                                    </div>
                                    <div class="form-group">
                                        <h5 class="text-primary font-weight-bold">Experience</h5>
                                        <p class="font-weight-normal">
                                            {{$portofolio[0]->experience}}
                                        </p>
                                    </div>
                                    <div class="form-group">
                                        <h5 class="text-primary font-weight-bold">Skill</h5>
                                        <p class="font-weight-normal">
                                            {{$portofolio[0]->skills}}
                                        </p>
                                    </div>
                                </div>
                            </div>

                            <div class="card-mb-3" style="width: 25%">
                                <div class="card-body">
                                    <div class="profile-header-avatar" style="background-image: url('../storage/img/{{$portofolio[0]->profile_image}}')"></div>
                                    <p></p>
                                    <div class="form-group">
                                        <h5 class="text-primary font-weight-bold">Portofolio :</h5>
                                        <a href="../storage/files/portofolio/{{$portofolio[0]->portofolio_file}}" class="text-primary">
                                           MyPortofolio.pdf
                                        </a>
                                    </div>
                                    <div class="form-group">
                                        <h5 class="text-primary font-weight-bold">Curriculum Vitae :</h5>
                                        <a href="../storage/files/cv/{{$portofolio[0]->cv_file}}" class="text-primary">
                                           MyCV.pdf
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
