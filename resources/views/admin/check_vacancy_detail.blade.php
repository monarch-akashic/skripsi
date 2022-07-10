@extends('layouts.app')
@section('content')
<div class="container">
    @include('inc.messages')
    <div class="justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="sub-heading ml-3">Vacancy</h4>
                    <form action="{{action('VacancyController@update', $vacancies->id)}}" method="POST" enctype="multipart/form-data">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <div class="card-mb-3" style="width: 100%">
                                <div class="card-body">
                                    <div class="form-group">
                                        <label for="job_name">Job Name</label>
                                        <input type="text" name="job_name" class="form-control" placeholder="" value={{$vacancies->job_name}} style="width:100%;" disabled>
                                    </div>

                                    <div class="form-group">
                                        <label for="job_description" class="form-label">Job Description</label>
                                        <textarea name="job_description" class="form-control" id="job_description" rows="3" style="width:100%; height:200px;" disabled>{{$vacancies->job_description}}</textarea>
                                    </div>


                                    <div class="form-group">
                                        <label for="job_requirement">Job Requirement</label>
                                        <textarea name="job_requirement" class="form-control" id="job_requirement" rows="3" style="width:100%; height:200px;" disabled>{{$vacancies->requirement}}</textarea>
                                    </div>

                                    <div class="form-group">
                                        <label for="age">Range Age</label>
                                        <div class="row ml-1">
                                            <input type="text" name="age_range_1" class="form-control mr-3" placeholder="" value="{{$vacancies->age}}" style="width:30%;"disabled>
                                            {{-- <input type="text" name="age_range_2" class="form-control ml-3" placeholder="" value="" style="width:15%;"> --}}
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="location">Location</label>
                                        <input type="text" name="location" class="form-control" placeholder="" value="{{$vacancies->location}}" style="width:100%;" disabled>
                                    </div>

                                        <div class="mapform" >
                                            <input type="hidden" class="form-control" placeholder="lat" name="lat" id="lat" value="{{$vacancies->latitude}}">
                                            <input type="hidden" class="form-control" placeholder="lng" name="lng" id="lng" value="{{$vacancies->longitude}}">

                                            <div id="map" style="height:400px; width: 100%;" class="my-3"></div>

                                            <script>
                                                let map;
                                                function initMap() {
                                                    map = new google.maps.Map(document.getElementById("map"), {
                                                        center: { lat: {{$vacancies->latitude}}, lng: {{$vacancies->longitude}} },
                                                        zoom: 18,
                                                        scrollwheel: false,
                                                    });

                                                    const uluru = { lat: {{$vacancies->latitude}}, lng: {{$vacancies->longitude}} };
                                                    let marker = new google.maps.Marker({
                                                        position: uluru,
                                                        map: map,
                                                        draggable: false
                                                    });

                                                    google.maps.event.addListener(marker,'position_changed',
                                                        function (){
                                                            let lat = marker.position.lat()
                                                            let lng = marker.position.lng()
                                                            $('#lat').val(lat)
                                                            $('#lng').val(lng)
                                                        })
                                                }
                                            </script>
                                            <script async defer src="https://maps.googleapis.com/maps/api/js?key={{ env('GOOGLE_MAP_KEY') }}&callback=initMap" type="text/javascript"></script>
                                        </div>

                                    <div class="form-group">
                                        <label for="salary">Salary</label>
                                        <div class="row ml-1">
                                            <input type="text" name="salary" class="form-control mr-3" placeholder="" value="{{$vacancies->salary}}" style="width:30%;" disabled>

                                            {{-- <select name="salary_type" id="inputGroupSelect01" class="custom-select" placeholder="hour" style="width:20%;" disabled>
                                                    <option value="hour" {{ old('salary_type') == 'hour' ? 'selected' : '' }}>hour</option>
                                                    <option value="day" {{ old('salary_type') == 'day' ? 'selected' : '' }}>day</option>
                                                    <option value="month" {{ old('salary_type') == 'month' ? 'selected' : '' }}>month</option>
                                            </select> --}}
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="total_applicant">Application Slots</label>
                                            <input type="text" name="total_applicant" class="form-control mr-3" placeholder="" value="{{$vacancies->total_applicant}}" style="width:15%;" disabled>
                                    </div>

                                    <div class="form-group">
                                        <label for="working_hour">Working Hours</label>
                                        <div class="row ml-1">
                                            <input type="text" name="working_hour_range_1" class="form-control mr-3" placeholder="" value="{{$vacancies->working_hour}}" style="width:30%;" disabled>
                                            {{-- <input type="text" name="working_hour_range_2" class="form-control ml-3" placeholder="" value="" style="width:15%;"> --}}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <input type="hidden" name="_method" value="{{ 'PUT' }}">
                        {{-- <input type="hidden" value="{{$vacancies->id}}" name="id"> --}}
                        <input type="submit" value="Apply" class="btn btn-primary">
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
