@extends('layouts.app')
@section('content')
<div class="container">
    @include('inc.messages')
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <h4>
                    <div class="card-header" id="custom-card-header">{{ __('View Applicants Profile') }}</div>
                </h4>
                <div class="card-body">
                    <div class="row mb-2">
                        <div class="card-mb-3" style="width: 75%">
                            <div class="card-body">

                                <div class="form-group">
                                    <h5 class="text-primary font-weight-bold">Applicant</h5>
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
                                    style="background-image: url('/storage/img/{{ $portofolio->profile_image }}')">
                                </div>
                                <p></p>
                                <div class="form-group">
                                    <h5 class="text-primary font-weight-bold">Portofolio :</h5>
                                    <a href="../storage/files/portofolio/{{ $portofolio->portofolio_file }}"
                                        class="text-primary">
                                        MyPortofolio.pdf
                                    </a>
                                </div>
                                <div class="form-group">
                                    <h5 class="text-primary font-weight-bold">Curriculum Vitae :</h5>
                                    <a href="../storage/files/cv/{{ $portofolio->cv_file }}"
                                        class="text-primary">
                                        MyCV.pdf
                                    </a>
                                </div>
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
                                    @csrf


                                    @guest
                                        <input type="submit" value="submit" class="btn btn-primary">
                                    @else
                                        @if (Auth::user()->id == $company_info->user_id)
                                            {{-- <a class="btn btn-primary" href="/portofolio/{{$user->id}}/send-interview">Send Interview</a> --}}
                                            @if ($applyings->status == 'Check by Company')
                                                <div class="form-group">
                                                    <p class="font-weight-bold">
                                                        Do you want to interview this applicant?
                                                    </p>
                                                    <form method="POST" action="{{ route('process.interview', [$vacancy_id, $user->id] ) }}" enctype="multipart/form-data">
                                                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                                        <input type="hidden" name="user_id" value= {{ $user->id}}>
                                                        <input type="hidden" name="vacancy_id" value= {{ $vacancy_id}}>

                                                        {{-- <a class="btn btn-outline-primary" href="/vacancy/{{$vacancy_id}}/portofolio/{{$user->id}}/send-interview">No</a> --}}
                                                        <a class="btn btn-primary" href="/vacancy/{{$vacancy_id}}/portofolio/{{$user->id}}/send-interview">Send Interview</a>
                                                        <button type="submit" name="action" class="btn btn-outline-primary" value="Reject">No</button>
                                                    </form>
                                                </div>
                                            @elseif($applyings->status == 'Interview on progress')
                                                <div class="form-group">
                                                    <p class="font-weight-bold">
                                                        Finish interview?
                                                    </p>
                                                    {{-- <form method="POST" action="{{ route('process.interview', [$vacancy_id, $user->id] ) }}" enctype="multipart/form-data">
                                                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                                        <input type="hidden" name="user_id" value= {{ $user->id}}>
                                                        <input type="hidden" name="vacancy_id" value= {{ $vacancy_id}}> --}}

                                                        {{-- <a class="btn btn-outline-primary" href="/vacancy/{{$vacancy_id}}/portofolio/{{$user->id}}/send-interview">No</a> --}}
                                                        {{-- <a class="btn btn-primary" href="/vacancy/{{$vacancy_id}}/portofolio/{{$user->id}}/send-interview">Finish</a> --}}
                                                        {{-- <button type="submit" name="action" class="btn btn-primary">Finish</button> --}}
                                                        {{-- <button type="submit" name="action" class="btn btn-primary" value="Finish">Finish</button>
                                                    </form> --}}
                                                    <button type="button" data-user_id="{{$user->id}}" data-vacancy_id="{{ $vacancy_id}}" class="open-ConfirmInterview btn btn-primary" data-toggle="modal" data-target="#checkoutmodel">
                                                        Finish
                                                    </button>
                                                </div>
                                            @endif
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

{{-- pop up --}}
<div class="modal fade" id="checkoutmodel" role="dialog" aria-labelledby="checkoutmodel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-custom text-white">
                <h5 class="modal-title" id="exampleModalLongTitle">Confirmation Accepted</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                Do you want to accept this applicant ?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <form method="POST" action="{{ route('process.interview', [$vacancy_id, $user->id] ) }}" enctype="multipart/form-data">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <input type="hidden" name="user_id" value= {{ $user->id}}>
                    <input type="hidden" name="vacancy_id" value= {{ $vacancy_id}}>

                    {{-- <a class="btn btn-outline-primary" href="/vacancy/{{$vacancy_id}}/portofolio/{{$user->id}}/send-interview">No</a> --}}
                    {{-- <a class="btn btn-primary" href="/vacancy/{{$vacancy_id}}/portofolio/{{$user->id}}/send-interview">Finish</a> --}}
                    {{-- <button type="submit" name="action" class="btn btn-primary">Finish</button> --}}
                    <button type="submit" name="action" class="btn btn-outline-danger" value="Reject">Reject</button>
                    <button type="submit" name="action" class="btn btn-primary" value="Accept">Accept</button>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).on("click", ".open-ConfirmInterview", function () {
        var user_id = $(this).data('user_id');
        var vacancy_id = $(this).data('vacancy_id');
        $(".modal-footer #user_id").val( user_id );
        $(".modal-footer #vacancy_id").val( vacancy_id );
    });
</script>

@endsection
