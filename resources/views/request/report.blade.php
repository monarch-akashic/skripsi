@extends('layouts.app')
@section('content')
<div class="container">
    @include('inc.messages')
    <div class="justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="sub-heading ml-3">Report Details</h4>
                    <form method="POST" action="{{ route('store.reporting') }}" enctype="multipart/form-data">

                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <div class="card-mb-3" style="width: 50%">
                                <div class="card-body">
                                    <div class="form-group">
                                        <label for="my_vacancy">Choose Job Vacancy that you want to report</label>
                                        <div class="input-group mb-3" style="width:150%;">
                                            <select name="my_vacancy" id="inputGroupSelect01" class="custom-select">
                                                @foreach ($vacancy as $item)
                                                    <option value="{{$item->id}}" {{ old('my_vacancy') == $item->id ? 'selected' : '' }}>{{$item->job_name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="report_file">Attachments</label>
                                        <div class="custom-file"  style="width:150%;">
                                            <input type="file" name="report_file" class="custom-file-input">
                                            <label class="custom-file-label" for="customFile">Choose file</label>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="subject">Subject</label>
                                        <input type="text" name="subject" class="form-control" placeholder="Subject" value="" style="width:150%;">
                                    </div>

                                    <div class="form-group">
                                    <label for="details" class="form-label">Details</label>
                                    <textarea name="details" class="form-control" id="exampleFormControlTextarea1" rows="3" style="width:150%; height:200px;"></textarea>
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
