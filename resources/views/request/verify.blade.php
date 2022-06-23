@extends('layouts.app')
@section('content')
<div class="container">
    @include('inc.messages')
    <div class="justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="sub-heading ml-3">Request Verify Account</h3>
                    <form method="POST" action="{{ route('store.verify') }}" enctype="multipart/form-data">

                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <div class="card-mb-3" style="width: 100%">
                                <div class="card-body">
                                    <div class="form-group">
                                        <label for="npwp_number">NPWP Number</label>
                                        <input type="text" name="npwp_number" class="form-control" placeholder="NPWP Number" value="" style="width:100%;">
                                    </div>

                                    <div class="form-group">
                                        <label for="sio_file">Upload SIO (Surat Izin Operational)</label>
                                        <div class="custom-file"  style="width:100%;">
                                            <input type="file" name="sio_file" class="custom-file-input">
                                            <label class="custom-file-label" for="customFile">Choose file</label>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="sid_file">Upload SID (Surat Izin Distribusi)</label>
                                        <div class="custom-file"  style="width:100%;">
                                            <input type="file" name="sid_file" class="custom-file-input">
                                            <label class="custom-file-label" for="customFile">Choose file</label>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="bpom_file">Upload BPOM</label>
                                        <div class="custom-file"  style="width:100%;">
                                            <input type="file" name="bpom_file" class="custom-file-input">
                                            <label class="custom-file-label" for="customFile">Choose file</label>
                                        </div>
                                    </div>
                                    <input type="submit" value="Submit" class="btn btn-primary">
                                </div>
                            </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
