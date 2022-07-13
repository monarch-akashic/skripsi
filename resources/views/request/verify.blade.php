@extends('layouts.app')
@section('content')
<div class="container">
    @if (count($errors) == 0)
        @include('inc.messages')
    @endif
    <div class="justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="sub-heading ml-3">Request Verify Account</h4>

                    @if ($flag_on_check == 1)
                        <div class="card-mb-3" style="width: 100%">
                            <div class="card-body">
                                Your verification is on progress
                            </div>
                        </div>
                    @elseif ($flag_on_check == 2)
                        <div class="card-mb-3" style="width: 100%">
                            <div class="card-body">
                                Your account is already verified
                            </div>
                        </div>
                    @else
                        @if ($previous_verify)
                            <div class="card-mb-3" style="width: 100%">
                                <div class="card-body">
                                    <label class="text-danger font-weight-bold">Rejected Notes</label>
                                    <p>
                                        {{$previous_verify->notes}}
                                    </p>
                                </div>
                            </div>
                        @endif
                        <form method="POST" action="{{ route('store.verify') }}" enctype="multipart/form-data">

                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                <div class="card-mb-3" style="width: 100%">
                                    <div class="card-body">
                                        <div class="form-group">
                                            <label for="npwp_number">NPWP Number</label>
                                            <input type="number" name="npwp_number" class="form-control @error('npwp_number') is-invalid @enderror" placeholder="NPWP Number" value="" style="width:100%;">

                                            @error('npwp_number')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>



                                        <div class="form-group">
                                            <label for="sio_file">Upload SIO (Surat Izin Operational)</label>
                                            <div class="custom-file"  style="width:100%;">
                                                <input type="file" name="sio_file" class="custom-file-input @error('sio_file') is-invalid @enderror">
                                                <label class="custom-file-label" for="customFile">Choose file</label>
                                            </div>

                                            @error('sio_file')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>

                                        <div class="form-group">
                                            <label for="sid_file">Upload SID (Surat Izin Distribusi)</label>
                                            <div class="custom-file"  style="width:100%;">
                                                <input type="file" name="sid_file" class="custom-file-input @error('sid_file') is-invalid @enderror">
                                                <label class="custom-file-label" for="customFile">Choose file</label>
                                            </div>

                                            @error('sid_file')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>

                                        <div class="form-group">
                                            <label for="bpom_file">Upload BPOM</label>
                                            <div class="custom-file"  style="width:100%;">
                                                <input type="file" name="bpom_file" class="custom-file-input @error('bpom_file') is-invalid @enderror">
                                                <label class="custom-file-label" for="customFile">Choose file</label>
                                            </div>

                                            @error('bpom_file')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                        <input type="submit" value="Submit" class="btn btn-primary">
                                    </div>
                                </div>
                        </form>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
