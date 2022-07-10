@extends('layouts.app')
@section('content')
<link rel="stylesheet" href="/css/content.css">
<div class="container">
    {{-- @include('inc.messages') --}}
    <div class="justify-content-center">
        <div class="col-md-12">
            <div class="row justify-content-center">
                <div class="card w-75 mb-3" style="width: 20em; padding: 0%; background-color: #0FC2C0">
                    <div class="row">
                        <div class="card-body " style="padding: 1%; margin-left: 2em;">
                            <h5 class="card-title m-2">Report Details</h5>
                        </div>
                    </div>
                </div>
            </div>
            <form method="POST" action="{{ route('process.report', [$reporting->id] ) }}" enctype="multipart/form-data">

                <div class="row justify-content-center">
                    <div class="card w-75 mb-3">
                        <div class="row" style="margin: 20px 20px 0px 20px">
                            <div class="card-mb-3" style="width: 50%">
                                <div class="form-group">
                                    <label for="applicant name" class="text-dark font-weight-bold">Applicant's Name</label>
                                    <p class="m-0">{{$applicant->name}}</p>
                                </div>
                                <div class="form-group">
                                    <label for="applicant phone" class="text-dark font-weight-bold">No Handphone</label>
                                    <p class="m-0">{{$applicant->phoneNo}}</p>
                                </div>
                                <div class="form-group">
                                    <label for="applicant email" class="text-dark font-weight-bold">Email</label>
                                    <p class="m-0">{{$applicant->email}}</p>
                                </div>
                            </div>
                            <div class="card-mb-3" style="width: 50%; ">
                                <div class="form-group">
                                    <label for="company name" class="text-dark font-weight-bold">Company</label>
                                    <p class="m-0">{{$company_info->name}}</p>
                                </div>
                                <div class="form-group">
                                    <label for="vacancy" class="text-dark font-weight-bold">Job</label>
                                    <a href="/vacancy/{{$reporting->vacancy_id}}">
                                        <p class="m-0 text-primary"><i>View Job</i></p>
                                    </a>
                                </div>
                                <div class="form-group">
                                    <label for="attachment" class="text-dark font-weight-bold">Attachment</label>
                                    <a href="/storage/report/{{$reporting->file}}">
                                        <p class="m-0 text-primary"><i>Download Here</i></p>
                                    </a>
                                </div>
                            </div>
                        </div>

                        <div class="card-mb-3" style="width: 100%">
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="subject" class="text-dark font-weight-bold">Subject</label>
                                    <p class="m-0">{{$reporting->subject}}</p>
                                </div>

                                <div class="form-group">
                                    <label for="detail" class="text-dark font-weight-bold">Details</label>
                                    <p class="m-0">{{$reporting->details}}</p>
                                </div>

                                <div class="form-group">
                                    <textarea name="reply" id="reply" rows="5"
                                        class="form-control @error('reply') is-invalid @enderror"
                                        placeholder="Reply">{{ old('reply') }}</textarea>
                                    @error('reply')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                            </div>
                        </div>
                        <div class="row mb-2">
                            <div class="card-body mr-3" style="text-align:right">
                                {{-- @if (!$company[0]->verified) --}}
                                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                        {{-- <input type="hidden" name="company" value="{{ $verify_data->company_id }}">
                                        <input type="hidden" name="verify" value="{{ $verify_data->id }}">
                                        <input type="hidden" name="name" value="{{ $user->name }}"> --}}
                                        <button type="submit" name="action" class="btn btn-primary" value="Approve">Approve</button>
                                        <button type="submit" name="action" class="btn btn-danger" value="Reject">Reject</button>
                                {{-- @endif --}}
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
