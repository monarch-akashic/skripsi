@extends('layouts.app')
@section('content')
<div class="container">
    @include('inc.messages')
    <div class="justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="sub-heading ml-3">Create Vacancy</h3>
                    <form action="{{action('VacancyController@store')}}" method="POST" enctype="multipart/form-data">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <div class="card-mb-3" style="width: 100%">
                                <div class="card-body">
                                    <div class="form-group">
                                        <label for="job_name">Job Name</label>
                                        <input type="text" name="job_name" class="form-control" placeholder="" value="" style="width:100%;">
                                    </div>

                                    <div class="form-group">
                                        <label for="job_description" class="form-label">Job Description</label>
                                        <textarea name="job_description" class="form-control" id="job_description" rows="3" style="width:100%; height:200px;"></textarea>
                                    </div>


                                    <div class="form-group">
                                        <label for="job_requirement">Job Requirement</label>
                                        <textarea name="job_requirement" class="form-control" id="job_requirement" rows="3" style="width:100%; height:200px;"></textarea>
                                    </div>

                                    <div class="form-group">
                                        <label for="age">Range Age</label>
                                        <div class="row ml-1">
                                            <input type="text" name="age_range_1" class="form-control mr-3" placeholder="" value="" style="width:15%;">-
                                            <input type="text" name="age_range_2" class="form-control ml-3" placeholder="" value="" style="width:15%;">
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="location">Location</label>
                                        <input type="text" name="location" class="form-control" placeholder="" value="" style="width:100%;">
                                    </div>

                                        <div class="mapform" >
                                            <input type="hidden" class="form-control" placeholder="lat" name="lat" id="lat">
                                            <input type="hidden" class="form-control" placeholder="lng" name="lng" id="lng">

                                            <div id="map" style="height:400px; width: 100%;" class="my-3"></div>

                                            {{-- <script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyArJ6Y3LioLJ5u6nkDW1SOYov3B45bKbfU&callback=initMap" type="text/javascript"></script> --}}
                                            {{-- <script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyArK-WJQanOboZA3EDjmgvG33Dqqkyim3I&callback=initMap" type="text/javascript"></script> --}}

                                            <script>
                                                let map;
                                                function initMap() {
                                                    getLat =
                                                    getLong =
                                                    map = new google.maps.Map(document.getElementById("map"), {
                                                        center: { lat: -6.145184361472, lng: 106.87522530555725 },
                                                        zoom: 15,
                                                        scrollwheel: true,
                                                    });

                                                    const uluru = { lat: -6.145184361472, lng: 106.87522530555725 };
                                                    let marker = new google.maps.Marker({
                                                        position: uluru,
                                                        map: map,
                                                        draggable: true
                                                    });

                                                    google.maps.event.addListener(marker,'position_changed',
                                                        function (){
                                                            let lat = marker.position.lat()
                                                            let lng = marker.position.lng()
                                                            $('#lat').val(lat)
                                                            $('#lng').val(lng)
                                                        })

                                                    google.maps.event.addListener(map,'click',
                                                    function (event){
                                                        pos = event.latLng
                                                        marker.setPosition(pos)
                                                    })

                                                    google.maps.event.addListenerOnce(map, 'idle',
                                                        function(){
                                                            let lat = marker.position.lat()
                                                            let lng = marker.position.lng()
                                                            $('#lat').val(lat)
                                                            $('#lng').val(lng)
                                                    });
                                                }

                                                window.initMap = this.initMap;
                                            </script>

                                            <script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyArJ6Y3LioLJ5u6nkDW1SOYov3B45bKbfU&callback=initMap" type="text/javascript"></script>
                                            {{-- <script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyArK-WJQanOboZA3EDjmgvG33Dqqkyim3I&callback=initMap" type="text/javascript"></script> --}}

                                        </div>

                                    <div class="form-group">
                                        <label for="salary">Salary</label>
                                        <div class="row ml-1">
                                            {{-- <input type="text" name="salary" class="form-control mr-3" placeholder="" value="" style="width:30%;"> --}}
                                            <a class="m-1" style="text-align: center" >Rp. </a>
                                            <input type="number" step="0.01" name="salary" id="number-input" class="form-control" placeholder="Salary" style="width: 30%">

                                            <select name="salary_type" id="inputGroupSelect01" class="custom-select" placeholder="hour" style="width:20%;">
                                                {{-- @foreach ($categories as $item) --}}
                                                    <option value="hour" {{ old('salary_type') == 'hour' ? 'selected' : '' }}>hour</option>
                                                    <option value="day" {{ old('salary_type') == 'day' ? 'selected' : '' }}>day</option>
                                                    <option value="month" {{ old('salary_type') == 'month' ? 'selected' : '' }}>month</option>
                                                {{-- @endforeach --}}
                                            </select>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="total_applicant">Application Slots</label>
                                        <div class="row ml-1">
                                            <input type="text" name="total_applicant" class="form-control mr-3" placeholder="" value="" style="width:15%;">
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="working_hour">Working Hours</label>
                                        <div class="row ml-1">
                                            <input type="text" name="working_hour_range_1" class="form-control mr-3" placeholder="" value="" style="width:15%;">-
                                            <input type="text" name="working_hour_range_2" class="form-control ml-3" placeholder="" value="" style="width:15%;">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <input type="submit" value="Create" class="btn btn-primary">
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
