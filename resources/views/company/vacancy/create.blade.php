@extends('layouts.app')
@section('content')
<div class="container">
    {{-- @include('inc.messages') --}}
    <div class="justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="sub-heading ml-3">Create Vacancy</h3>
                        <form action="{{ action('VacancyController@store') }}" method="POST"
                            enctype="multipart/form-data">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            {{-- <div class="row m-1">

                            </div> --}}
                            <div class="row mb-2">
                                <div class="card-mb-3" style="width: 50%">
                                    <div class="card-body">
                                        <div class="form-group">
                                            <label for="">Job Name</label>
                                            <input type="text" name="job_name"
                                                class="form-control @error('job_name') is-invalid @enderror"
                                                placeholder="" value="{{ old('job_name') }}"
                                                style="width:100%;">

                                            @error('job_name')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>

                                        <div class="form-group">
                                            <label for="job_description" class="form-label">Job Description</label>
                                            <textarea name="job_description"
                                                class="form-control @error('job_description') is-invalid @enderror"
                                                id="job_description" rows="3"
                                                style="width:100%; height:150px;">{{ old('job_description') }}</textarea>

                                            @error('job_description')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>


                                        <div class="form-group">
                                            <label for="job_requirement">Job Requirement</label>
                                            {{-- <textarea name="job_requirement" class="form-control" id="job_requirement" rows="3" style="width:100%; height:200px;"></textarea> --}}
                                            <textarea name="job_requirement" id="job_requirement" rows="5"
                                                class="form-control @error('job_requirement') is-invalid @enderror"
                                                placeholder="Job Requirement">{{ old('job_requirement') }}</textarea>

                                            @error('job_requirement')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>


                                        <div class="form-group">
                                            <label for="age">Range Age</label>
                                            <div class="row ml-1">
                                                <input type="number" name="age_range_1"
                                                    class="form-control  @error('age_range_1') is-invalid @enderror mr-3"
                                                    placeholder="" value="{{ old('age_range_1') }}"
                                                    style="width:15%;">
                                                -
                                                <input type="number" name="age_range_2"
                                                    class="form-control  @error('age_range_2') is-invalid @enderror ml-3"
                                                    placeholder="" value="{{ old('age_range_2') }}"
                                                    style="width:15%;">
                                            </div>
                                        </div>

                                    </div>
                                </div>



                                <div class="card-mb-3" style="width: 50%">
                                    <div class="card-body">
                                        <div class="form-group">
                                            <label for="location">Address</label>
                                            <input type="text" name="location"
                                                class="form-control @error('location') is-invalid @enderror"
                                                placeholder="" value="{{ old('location') }}"
                                                style="width:100%;">

                                            @error('location')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                        {{-- <div class="form-check-inline"> --}}
                                        <div class="form-group">
                                            <div class="input-group mb-3 ">
                                                <select name="province" id="inputGroupSelect01"
                                                    class="custom-select @error('province') is-invalid @enderror"
                                                    placeholder="province">
                                                    <option value="" disabled selected>--Province--</option>
                                                    @foreach($province as $item)
                                                        <option value="{{ $item->prov_id }}"
                                                            {{ old('province') == $item->prov_id ? 'selected' : '' }}>
                                                            {{ $item->prov_name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>

                                            @error('province')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror

                                            <div class="input-group mb-3">
                                                <select name="city" id="province" class="custom-select"
                                                    placeholder="city">
                                                    <option value="" disabled selected>--City--</option>
                                                </select>
                                            </div>
                                            <div class="input-group mb-3">
                                                <select name="district" id="city" class="custom-select"
                                                    placeholder="district">
                                                    <option value="" disabled selected>--District--</option>
                                                </select>
                                            </div>
                                            <div class="input-group mb-3">
                                                <select name="postal_code" id="district" class="custom-select"
                                                    placeholder="postal code">
                                                    <option value="" disabled selected>--Postal Code--</option>
                                                </select>
                                            </div>
                                        </div>
                                        <script>
                                            ClassicEditor
                                                .create( document.querySelector( '#job_requirement' ) )
                                                .catch( error => {
                                                    console.error( error );
                                                } );
                                        </script>
                                        <script src="{{ asset('js/jquery-3.5.1.min.js') }}">
                                        </script>
                                        <script>
                                            $(document).ready(function () {
                                                $('select[name="province"]').on('change', function () {
                                                    var prov_id = $(this).val();
                                                    if (prov_id) {
                                                        $.ajax({
                                                            url: "{{ url('/getCity/') }}/" +
                                                                prov_id,
                                                            type: "GET",
                                                            dataType: "json",
                                                            success: function (data) {
                                                                console.log(data);
                                                                $('select[name="city"]')
                                                                    .empty();
                                                                $.each(data, function (key,
                                                                    value) {
                                                                    $('select[name="city"]')
                                                                        .append(
                                                                            '<option value="' +
                                                                            key +
                                                                            '">' +
                                                                            value +
                                                                            '</option>'
                                                                            );
                                                                });
                                                            }
                                                        });
                                                    } else {
                                                        $('select[name="city"]').empty();
                                                    }
                                                });

                                                $('select[name="city"]').on('change', function () {
                                                    var city_id = $(this).val();
                                                    if (city_id) {
                                                        $.ajax({
                                                            url: "{{ url('/getDistrict/') }}/" +
                                                                city_id,
                                                            type: "GET",
                                                            dataType: "json",
                                                            success: function (data) {
                                                                console.log(data);
                                                                $('select[name="district"]')
                                                                    .empty();
                                                                $.each(data, function (key,
                                                                    value) {
                                                                    $('select[name="district"]')
                                                                        .append(
                                                                            '<option value="' +
                                                                            key +
                                                                            '">' +
                                                                            value +
                                                                            '</option>'
                                                                            );
                                                                });
                                                            }
                                                        });
                                                    } else {
                                                        $('select[name="district"]').empty();
                                                    }
                                                });

                                                $('select[name="district"]').on('change', function () {
                                                    var dis_id = $(this).val();
                                                    if (dis_id) {
                                                        $.ajax({
                                                            url: "{{ url('/getPostalCode/') }}/" +
                                                                dis_id,
                                                            type: "GET",
                                                            dataType: "json",
                                                            success: function (data) {
                                                                console.log(data);
                                                                $('select[name="postal_code"]')
                                                                    .empty();
                                                                $.each(data, function (key,
                                                                    value) {
                                                                    $('select[name="postal_code"]')
                                                                        .append(
                                                                            '<option value="' +
                                                                            value +
                                                                            '">' +
                                                                            value +
                                                                            '</option>'
                                                                            );
                                                                });
                                                            }
                                                        });
                                                    } else {
                                                        $('select[name="postal_code"]').empty();
                                                    }
                                                });
                                            });

                                        </script>
                                        <p class="card-text">Please pin point the location</p>

                                        <div class="mapform">
                                            <input type="hidden" class="form-control" placeholder="lat" name="lat"
                                                id="lat">
                                            <input type="hidden" class="form-control" placeholder="lng" name="lng"
                                                id="lng">

                                            <div id="map" style="height:300px; width: 100%;" class="my-3"></div>

                                            {{-- <script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyArJ6Y3LioLJ5u6nkDW1SOYov3B45bKbfU&callback=initMap" type="text/javascript"></script> --}}
                                            {{-- <script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyArK-WJQanOboZA3EDjmgvG33Dqqkyim3I&callback=initMap" type="text/javascript"></script> --}}

                                            <script>
                                                let map;

                                                function initMap() {
                                                    getLat =
                                                        getLong =
                                                        map = new google.maps.Map(document.getElementById("map"), {
                                                            center: {
                                                                lat: {{$mylat}},
                                                                lng: {{$mylong}}
                                                            },
                                                            zoom: 15,
                                                            scrollwheel: true,
                                                        });

                                                    const uluru = {
                                                        lat: {{$mylat}},
                                                        lng: {{$mylong}}
                                                    };
                                                    let marker = new google.maps.Marker({
                                                        position: uluru,
                                                        map: map,
                                                        draggable: true
                                                    });

                                                    google.maps.event.addListener(marker, 'position_changed',
                                                        function () {
                                                            let lat = marker.position.lat()
                                                            let lng = marker.position.lng()
                                                            $('#lat').val(lat)
                                                            $('#lng').val(lng)
                                                        })

                                                    google.maps.event.addListener(map, 'click',
                                                        function (event) {
                                                            pos = event.latLng
                                                            marker.setPosition(pos)
                                                        })

                                                    google.maps.event.addListenerOnce(map, 'idle',
                                                        function () {
                                                            let lat = marker.position.lat()
                                                            let lng = marker.position.lng()
                                                            $('#lat').val(lat)
                                                            $('#lng').val(lng)
                                                        });
                                                }

                                                window.initMap = this.initMap;

                                            </script>

                                            <script async defer
                                                src="https://maps.googleapis.com/maps/api/js?key=AIzaSyArJ6Y3LioLJ5u6nkDW1SOYov3B45bKbfU&callback=initMap"
                                                type="text/javascript"></script>
                                            {{-- <script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyArK-WJQanOboZA3EDjmgvG33Dqqkyim3I&callback=initMap" type="text/javascript"></script> --}}

                                        </div>

                                        <div class="form-group">
                                            <label for="salary">Salary</label>
                                            <div class="row ml-1">
                                                {{-- <input type="text" name="salary" class="form-control mr-3" placeholder="" value="" style="width:30%;"> --}}
                                                <a class="m-1" style="text-align: center">Rp. </a>
                                                <input type="number" step="0.01" name="salary" id="number-input"
                                                    class="form-control" placeholder="Salary"
                                                    value="{{ old('salary') }}" style="width: 30%">

                                                <select name="salary_type" id="inputGroupSelect01" class="custom-select"
                                                    placeholder="hour" style="width:20%;">
                                                    {{-- @foreach ($categories as $item) --}}
                                                    <option value="hour"
                                                        {{ old('salary_type') == 'hour' ? 'selected' : '' }}>
                                                        hour</option>
                                                    <option value="day"
                                                        {{ old('salary_type') == 'day' ? 'selected' : '' }}>
                                                        day</option>
                                                    <option value="month"
                                                        {{ old('salary_type') == 'month' ? 'selected' : '' }}>
                                                        month</option>
                                                    {{-- @endforeach --}}
                                                </select>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label for="total_applicant">Application Slots</label>
                                            <div class="row ml-1">
                                                <input type="number" name="total_applicant" class="form-control @error('total_applicant') is-invalid @enderror mr-3"
                                                    placeholder=""
                                                    value="{{ old('total_applicant') }}"
                                                    style="width:15%;">
                                            </div>
                                            @error('total_applicant')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>

                                        <div class="form-group">
                                            <label for="working_hour">Working Hours</label>
                                            <div class="row ml-1">
                                                <div class="bootstrap-timepicker">
                                                    <input type="text" name="working_hour_range_1" class="form-control timepicker @error('working_hour_range_1') is-invalid @enderror mr-3"
                                                    placeholder=""
                                                    value="{{ old('working_hour_range_1') }}"
                                                    >
                                                </div>
                                                <div class="bootstrap-timepicker">
                                                    <input type="text" name="working_hour_range_2" class="form-control timepicker @error('working_hour_range_2') is-invalid @enderror ml-3"
                                                    placeholder=""
                                                    value="{{ old('working_hour_range_2') }}"
                                                    >
                                                </div>
                                            </div>
                                            @error('working_hour_range_1')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                            @error('working_hour_range_2')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row mb-2">
                                <div class="card-body" style="text-align:right">
                                    {{-- <button type="submit" name="action" class="btn btn-primary" value="Save">Save Changes</button> --}}
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
