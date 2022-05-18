@extends('layouts.app')
@section('content')
<div class="container">
    @include('inc.messages')
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <h4>
                    <div class="card-header" id="custom-card-header">{{ __('My Profile') }}</div>
                </h4>

                <div class="card-body">
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

                                    <ul class="timeline">
                                        <li>
                                            <a href="#">{Title}</a>
                                            <a href="#" class="float">{Year}</a>
                                            <p>{Description}</p>
                                        </li>
                                        <li>
                                            <a href="#">{Title}</a>
                                            <a href="#" class="float">{Year}</a>
                                            <p>{Description}</p>
                                        </li>
                                    </ul>

                                    {{-- <ul class="timeline">
                                        <li class="event" data-date="12:30 - 1:00pm">
                                            <h3>Registration</h3>
                                            <p>Get here on time, it's first come first serve. Be late, get turned away.</p>
                                        </li>
                                        <li class="event" data-date="2:30 - 4:00pm">
                                            <h3>Opening Ceremony</h3>
                                            <p>Get ready for an exciting event, this will kick off in amazing fashion with MOP &amp; Busta Rhymes as an opening show.</p>
                                        </li>
                                        <li class="event" data-date="5:00 - 8:00pm">
                                            <h3>Main Event</h3>
                                            <p>This is where it all goes down. You will compete head to head with your friends and rivals. Get ready!</p>
                                        </li>
                                        <li class="event" data-date="8:30 - 9:30pm">
                                            <h3>Closing Ceremony</h3>
                                            <p>See how is the victor and who are the losers. The big stage is where the winners bask in their own glory.</p>
                                        </li>
                                    </ul> --}}

                                    {{-- <div class="timeline-steps aos-init aos-animate" data-aos="fade-up">
                                        <div class="timeline-step">
                                            <div class="timeline-content" data-toggle="popover" data-trigger="hover" data-placement="top" title="" data-content="And here's some amazing content. It's very engaging. Right?" data-original-title="2003">
                                                <div class="inner-circle"></div>
                                                <p class="h6 mt-3 mb-1">2003</p>
                                                <p class="h6 text-muted mb-0 mb-lg-0">Favland Founded</p>
                                            </div>
                                        </div>
                                        <div class="timeline-step">
                                            <div class="timeline-content" data-toggle="popover" data-trigger="hover" data-placement="top" title="" data-content="And here's some amazing content. It's very engaging. Right?" data-original-title="2004">
                                                <div class="inner-circle"></div>
                                                <p class="h6 mt-3 mb-1">2004</p>
                                                <p class="h6 text-muted mb-0 mb-lg-0">Launched Trello</p>
                                            </div>
                                        </div>
                                        <div class="timeline-step">
                                            <div class="timeline-content" data-toggle="popover" data-trigger="hover" data-placement="top" title="" data-content="And here's some amazing content. It's very engaging. Right?" data-original-title="2005">
                                                <div class="inner-circle"></div>
                                                <p class="h6 mt-3 mb-1">2005</p>
                                                <p class="h6 text-muted mb-0 mb-lg-0">Launched Messanger</p>
                                            </div>
                                        </div>
                                        <div class="timeline-step">
                                            <div class="timeline-content" data-toggle="popover" data-trigger="hover" data-placement="top" title="" data-content="And here's some amazing content. It's very engaging. Right?" data-original-title="2010">
                                                <div class="inner-circle"></div>
                                                <p class="h6 mt-3 mb-1">2010</p>
                                                <p class="h6 text-muted mb-0 mb-lg-0">Open New Branch</p>
                                            </div>
                                        </div>
                                    </div> --}}

                                    <div class="form-group">
                                        <h5 class="text-primary font-weight-bold">Experience</h5>
                                        <p class="font-weight-normal">
                                            {{$portofolio[0]->experience}}
                                        </p>
                                    </div>

                                    <ul class="timeline">
                                        <li>
                                            <a href="#">{Title}</a>
                                            <a href="#" class="float">{Year}</a>
                                            <p>{Description}</p>
                                        </li>
                                        <li>
                                            <a href="#">{Title}</a>
                                            <a href="#" class="float">{Year}</a>
                                            <p>{Description}</p>
                                        </li>
                                    </ul>

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
