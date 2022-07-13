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
                            <h5 class="card-title m-2">Request Verify Account</h5>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row justify-content-center">
                <div class="card w-75 mb-3">
                    <div class="row" style="margin: 20px 20px 0px 20px">
                        <div class="card-mb-3" style="width: 70%">
                            <div class="form-group">
                                <label for="company" class="text-dark font-weight-bold">Job Offerer</label>
                                <p class="m-0">{{$user->name}}</p>
                            </div>
                        </div>
                        <div class="card-mb-3" style="width: 30%; text-align:right">
                            <div class="form-group m-0">
                                {{-- <img style="width: inherit" src="/storage/img/company/{{$company[0]->logo}}"  alt="..." class="ml-2 mr-2"> --}}
                                <div class="profile-header-avatar " style="background-image: url('/storage/img/company/{{$company[0]->logo}}')"></div>

                            </div>
                        </div>
                    </div>

                    <div class="card-mb-3" style="width: 100%">
                        <div class="card-body">
                            <div class="form-group">
                                <label for="npwp_number" class="text-dark font-weight-bold">NPWP Number</label>
                                <p class="m-0">{{$verify_data->npwp}}</p>
                            </div>

                            <div class="form-group">
                                <label for="sio_file" class="text-dark font-weight-bold">SIO (Surat Izin Operational)</label>
                                <p>
                                    <a href="/storage/files/sio/{{ $verify_data->surat_izin_operational }}"
                                        class="text-primary">
                                        Download attachment here
                                    </a>
                                </p>
                            </div>

                            <div class="form-group">
                                <label for="sid_file" class="text-dark font-weight-bold">SID (Surat Izin Distribusi)</label>
                                <p>
                                    <a href="/storage/files/sid/{{ $verify_data->surat_izin_distribusi }}"
                                        class="text-primary">
                                        Download attachment here
                                    </a>
                                </p>
                            </div>

                            <div class="form-group">
                                <label for="bpom_file" class="text-dark font-weight-bold">BPOM</label>
                                <p>
                                    <a href="/storage/files/bpom/{{ $verify_data->bpom }}"
                                        class="text-primary">
                                        Download attachment here
                                    </a>
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="row mb-2">
                        <div class="card-body mr-3" style="text-align:right">
                            @if (!$company[0]->verified)
                                <form method="POST" action="{{ route('process.verify', [$verify_data->id] ) }}" enctype="multipart/form-data">
                                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                    <input type="hidden" name="company" value="{{ $verify_data->company_id }}">
                                    <input type="hidden" name="verify" value="{{ $verify_data->id }}">
                                    <input type="hidden" name="name" value="{{ $user->name }}">

                                    <div class="form-group">
                                        <textarea name="notes" id="reply" rows="5"
                                            class="form-control @error('notes') is-invalid @enderror"
                                            placeholder="Notes">{{ old('notes') }}</textarea>
                                        @error('notes')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>

                                    <button type="submit" name="action" class="btn btn-primary" value="verify">Verify</button>
                                    <button type="submit" name="action" class="btn btn-warning" value="reject">Reject</button>
                                </form>
                            @endif
                        </div>
                    </div>
                    <script>
                        $(function() {
                            $( "form" ).submit(function() {
                                $('#loader').show();
                            });
                        });
                    </script>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
