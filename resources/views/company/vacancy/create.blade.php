@extends('layouts.app')
@section('content')
<div class="container">
    @include('inc.messages')
    <div class="justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="sub-heading ml-3">Create Vacancy</h3>
                    <form action="" method="POST" enctype="multipart/form-data">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <div class="card-mb-3" style="width: 50%">
                                <div class="card-body">                                  
                                    <div class="form-group">
                                        <label for="job_name">Job Name</label>
                                        <input type="text" name="job_name" class="form-control" placeholder="" value="" style="width:150%;">
                                    </div>

                                    <div class="form-group">
                                        <label for="job_desc" class="form-label">Job Description</label>
                                        <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" style="width:150%; height:200px;"></textarea>
                                    </div>

                                    <div class="form-group">
                                        <label for="job_req" class="form-label">Job Requirement</label>
                                        <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" style="width:150%; height:200px;"></textarea>
                                    </div>

                                    <div class="form-group">
                                        <label for="range_age">Range Age</label>
                                        <div class="row ml-1">
                                            <input type="text" name="range_1" class="form-control mr-3" placeholder="" value="" style="width:15%;">- 
                                            <input type="text" name="range_2" class="form-control ml-3" placeholder="" value="" style="width:15%;">
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="jloc">Location</label>
                                        <input type="text" name="loc" class="form-control" placeholder="" value="" style="width:150%;">
                                    </div>

                                    <div class="form-group">
                                        <label for="range_age">Salary</label>
                                        <div class="row ml-1">
                                            <input type="text" name="salary" class="form-control mr-3" placeholder="" value="" style="width:30%;">

                                            <select name="industry_type" id="inputGroupSelect01" class="custom-select" placeholder="hour" style="width:20%;">
                                                {{-- @foreach ($categories as $item) --}}
                                                    <option value="one" {{ old('industry_type') == 'one' ? 'selected' : '' }}>hour</option>
                                                    <option value="two" {{ old('industry_type') == 'two' ? 'selected' : '' }}>day</option>
                                                    <option value="three" {{ old('industry_type') == 'three' ? 'selected' : '' }}>month</option>
                                                {{-- @endforeach --}}
                                            </select>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="slot">Application Slots</label>
                                            <input type="text" name="slot" class="form-control mr-3" placeholder="" value="" style="width:15%;">
                                    </div>

                                    <div class="form-group">
                                        <label for="wrk_hrs">Working Hours</label>
                                        <div class="row ml-1">
                                            <input type="text" name="range_1" class="form-control mr-3" placeholder="" value="" style="width:15%;">- 
                                            <input type="text" name="range_2" class="form-control ml-3" placeholder="" value="" style="width:15%;">
                                        </div>
                                    </div>

                                    <input type="submit" value="Create" class="btn btn-primary">
                                </div>
                            </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection