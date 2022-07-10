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
                                        {{ $user->name }}
                                    </p>
                                </div>

                                <div class="form-group">
                                    <h5 class="text-primary font-weight-bold">Phone Number</h5>
                                    <p class="font-weight-normal">
                                        {{ $user->phoneNo }}
                                    </p>
                                </div>

                                <div class="form-group">
                                    <h5 class="text-primary font-weight-bold">Email</h5>
                                    <p class="font-weight-normal">
                                        {{ $user->email }}
                                    </p>

                                </div>

                                <div class="form-group">
                                    <h5 class="text-primary font-weight-bold">Date of Birth</h5>
                                    <p class="font-weight-normal">
                                        {{ $user->dob }}
                                    </p>
                                </div>



                                <div class="form-group">
                                    <h5 class="text-primary font-weight-bold">Education</h5>
                                </div>

                                <ul class="timeline">
                                    @foreach ($portofolio->education as $item)
                                        <li>
                                            <a href="#">{{$item['institute']}}</a>
                                            <a href="#" class="float">{{$item['year_start_institute']}} - {{$item['year_end_institute']}}</a>
                                            <p>{{$item['institute_desc']}}</p>
                                        </li>
                                    @endforeach
                                </ul>

                                <div class="form-group">
                                    <h5 class="text-primary font-weight-bold">Experience</h5>
                                </div>

                                <ul class="timeline">
                                    @foreach ($portofolio->experience as $item)
                                        <li>
                                            <a href="#">{{ucfirst($item['experience'])}}</a>
                                            <a href="#" class="float">{{$item['year_start_experience']}} - {{$item['year_end_experience']}}</a>
                                            <p>{{$item['experience_desc']}}</p>
                                        </li>
                                    @endforeach
                                </ul>

                                {{-- <div class="form-group"> --}}
                                    <h5 class="text-primary font-weight-bold">Skill</h5>
                                    @foreach ($portofolio->skills as $item)
                                        <li>
                                            {{$item}}
                                        </li>
                                    @endforeach
                                {{-- </div> --}}
                            </div>
                        </div>

                        <div class="card-mb-3" style="width: 25%">
                            <div class="card-body">
                                <div class="profile-header-avatar"
                                    style="background-image: url('../storage/img/{{ $portofolio->profile_image }}')">
                                </div>
                                <p></p>
                                @if ($portofolio->portofolio_file != 'no_file')
                                    <div class="form-group">
                                        <h5 class="text-primary font-weight-bold">Portofolio :</h5>
                                        <a href="../storage/files/portofolio/{{ $portofolio->portofolio_file }}"
                                            class="text-primary">
                                            MyPortofolio.pdf
                                        </a>
                                    </div>
                                @endif
                                @if ($portofolio->cv_file != 'no_file')
                                    <div class="form-group">
                                        <h5 class="text-primary font-weight-bold">Curriculum Vitae :</h5>
                                        <a href="../storage/files/cv/{{ $portofolio->cv_file }}"
                                            class="text-primary">
                                            MyCV.pdf
                                        </a>
                                    </div>
                                @endif
                                {{-- <button onclick="getLocation()">Try It</button> --}}

                                {{-- <p id="demo"></p> --}}
                            </div>
                        </div>
                    </div>
                    <div class="row mb-2">
                        <div class="card-mb-3" style="width: 100%">
                            <div class="card-body">
                                <div class="form-group">
                                    <h5 class="text-primary font-weight-bold">Alamat</h5>
                                    <p class="font-weight-normal">
                                        {{$portofolio->location}}
                                    </p>
                                </div>
                                {{-- <form action="{{ route('store') }}" method="post"> --}}
                                    {{-- @csrf --}}
                                    {{-- <div class="mapform" >
                                        <input type="hidden" class="form-control" placeholder="lat" name="lat" id="lat">
                                        <input type="hidden" class="form-control" placeholder="lng" name="lng" id="lng">

                                        <div id="map" style="height:400px; width: 100%;" class="my-3"></div>

                                        <script>
                                            let map;
                                            function initMap() {
                                                map = new google.maps.Map(document.getElementById("map"), {
                                                    center: { lat: {{$portofolio->latitude}}, lng: {{$portofolio->longitude}}},
                                                    zoom: 15,
                                                    scrollwheel: false,
                                                });

                                                const uluru = { lat: {{$portofolio->latitude}}, lng: {{$portofolio->longitude}} };
                                                let marker = new google.maps.Marker({
                                                    position: uluru,
                                                    map: map,
                                                    draggable: false,
                                                });

                                            }
                                        </script>

                                        <script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyArJ6Y3LioLJ5u6nkDW1SOYov3B45bKbfU&callback=initMap" type="text/javascript"></script>
                                    </div> --}}

                                    @guest
                                        <input type="submit" value="submit" class="btn btn-primary">
                                    @else
                                        @if (Auth::user()->role == '0')
                                            {{-- <input type="submit" value="Approve" class="btn btn-primary" disabled> --}}
                                        @endif
                                        @if (Auth::user()->role == '1' && Auth::user()->id == $portofolio->user_id)
                                            <a class="btn btn-primary" href="/portofolio/{{$portofolio->user_id}}/edit">Update</a>
                                            {{-- <input type="submit" value="Update" class="btn btn-primary"> --}}
                                        @endif
                                        @if (Auth::user()->role == '2')
                                        {{-- ### add authoriztion for vacancy = to companies --}}
                                            <a class="btn btn-primary" href="/portofolio/{{$user->id}}/send-interview">Send Interview</a>
                                        @endif
                                    @endguest
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
