@extends('layouts.app')
@section('content')
<div class="container">
    @include('inc.messages')
    <div class="justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="sub-heading ml-3">Report Details</h3>
                    <form action="" method="POST" enctype="multipart/form-data">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <div class="card-mb-3" style="width: 50%">
                                <div class="card-body">
                                    <div class="form-group">
                                        <label for="industry_type">Choose Job Vacancy that you want to report</label>
                                        <div class="input-group mb-3" style="width:150%;">
                                            <select name="industry_type" id="inputGroupSelect01" class="custom-select">
                                                {{-- @foreach ($categories as $item) --}}
                                                    <option value="one" {{ old('industry_type') == 'one' ? 'selected' : '' }}>One</option>
                                                    <option value="two" {{ old('industry_type') == 'two' ? 'selected' : '' }}>Two</option>
                                                    <option value="three" {{ old('industry_type') == 'three' ? 'selected' : '' }}>Three</option>
                                                {{-- @endforeach --}}
                                            </select>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="report_file">Attachments</label>
                                        <div class="custom-file"  style="width:150%;">
                                            <input type="file" name="portofolio_file" class="custom-file-input">
                                            <label class="custom-file-label" for="customFile">Choose file</label>
                                        </div>
                                    </div>
                                    
                                    <div class="form-group">
                                        <label for="full_name">Subject</label>
                                        <input type="text" name="full_name" class="form-control" placeholder="Subject" value="" style="width:150%;">
                                    </div>

                                    <div class="form-group">
                                    <label for="details" class="form-label">Details</label>
                                    <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" style="width:150%; height:200px;"></textarea>
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