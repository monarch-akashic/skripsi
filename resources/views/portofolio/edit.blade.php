@extends('layouts.app')
@section('content')
<div class="container">
    @include('inc.messages')
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="sub-heading">Edit Profile</h4>
                    <form action="{{ action('PortofolioController@update', $portofolio->id) }}" method="POST" enctype="multipart/form-data">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <div class="row m-2">
                            <div class="card-m-3" style="width: 20%">
                                <div class="profile-header-avatar align-middle"
                                    style="background-image: url('/storage/img/{{$portofolio->profile_image}}')">
                                </div>
                            </div>
                            <div class="card-m-3" style="width: 20%">
                                <div class="form-group">
                                    <label for="profile_image">Profile Picture :</label>
                                    <div class="custom-file">
                                        <input type="file" name="profile_image" class="custom-file-input">
                                        <label class="custom-file-label" for="customFile">Choose file</label>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="full_name">Full Name</label>
                                    <input type="text" name="full_name" class="form-control" placeholder="Full Name"
                                        value="{{ $user_info->name }}">
                                </div>
                            </div>
                        </div>

                        <div class="row m-2">
                            <div class="card-m-3" style="width: 40%">
                                <div class="card-body">


                                    <div class="form-group">
                                        <label for="phoneNo">Phone Number</label>
                                        <input type="text" name="phoneNo" class="form-control"
                                            placeholder="Phone Number" value="{{ $user_info->phoneNo }}">
                                    </div>

                                    <div class="form-group">
                                        <label for="email">Email</label>
                                        <input type="email" name="email" class="form-control" placeholder="Email"
                                            value="{{ $user_info->email }}" disabled>
                                    </div>

                                    <div class="form-group">
                                        <label for="dob">Date of Birth</label>
                                        <input type="date" name="dob" class="form-control" placeholder="Date of Birth"
                                            value="{{ $user_info->dob }}">
                                    </div>
                                    <div class="form-group">
                                        <label for="portofolio_file">Portofolio :</label>
                                        <div class="custom-file">
                                            <input type="file" name="portofolio_file" class="custom-file-input">
                                            <label class="custom-file-label" for="customFile">Choose file</label>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="curriculum_file">Curriculum Vitae :</label>
                                        <div class="custom-file">
                                            <input type="file" name="curriculum_file" class="custom-file-input">
                                            <label class="custom-file-label" for="customFile">Choose file</label>
                                        </div>
                                    </div>

                                </div>


                            </div>
                            <div class="card-m-3" style="width: 60%">
                                <div class="card-body">

                                    <div class="form-group">
                                        <label for="education">Education</label>
                                        <button class="btn btn-sm btn-primary add_more_institute">Add row</button>
                                        <table class="table table-sm table-borderless" id="show_institute">
                                            <tbody>
                                                @foreach ($portofolio->education as $item)
                                                    <tr>
                                                        <td colspan="1" style="text-align: center" class="align-middle">
                                                            <div class="input-group mb-3">
                                                                <select name="institute[]" id="inputGroupSelect01" class="custom-select">
                                                                    @foreach ($categories as $category)
                                                                        <option value="{{$category->name}}"
                                                                            {{ $item['institute'] == $category->name ? 'selected' : '' }}>
                                                                            {{$category->name}}
                                                                        </option>
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                        </td>
                                                        <td colspan="1" style="text-align: center" class="form-inline">
                                                            <input style="width:5em" type="text" name="year_start_institute[]" class="form-control" placeholder="Year"
                                                                value="{{ $item['year_start_institute'] }}">
                                                            -
                                                            <input style="width:5em" type="text" name="year_end_institute[]" class="form-control" placeholder="Year"
                                                                value="{{ $item['year_end_institute'] }}">
                                                        </td>
                                                        <td colspan="1" style="text-align: center">
                                                            <input type="text" name="institute_desc[]" class="form-control"
                                                                placeholder="Institute Name"
                                                                value="{{ $item['institute_desc'] }}">
                                                        </td>
                                                        <td colspan="1" style="text-align: center">
                                                            <button class="btn btn-sm btn-danger remove_more_institute">Remove</button>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="form-group">
                                        <label for="experience">Experience</label>
                                        <button class="btn btn-sm btn-primary add_more_experience">Add row</button>
                                        <table class="table table-sm table-borderless" id="show_experience">
                                            <tbody>
                                                @foreach ($portofolio->experience as $item)
                                                    <tr>
                                                        <td colspan="1" style="text-align: center" class="align-middle">
                                                            <div class="input-group mb-3">
                                                                <select name="experience[]" id="inputGroupSelect01" class="custom-select">
                                                                    @foreach ($experience_category as $e_category)
                                                                        <option value="{{$e_category->name}}"
                                                                            {{ $item['experience'] == $e_category->name ? 'selected' : '' }}>
                                                                            {{ucfirst($e_category->name)}}
                                                                        </option>
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                        </td>
                                                        <td colspan="1" style="text-align: center" class="form-inline">
                                                            <input style="width:5em" type="text" name="year_start_experience[]" class="form-control" placeholder="Year"
                                                                value="{{ $item['year_start_experience'] }}">
                                                            -
                                                            <input style="width:5em" type="text" name="year_end_experience[]" class="form-control" placeholder="Year"
                                                                value="{{ $item['year_end_experience'] }}">
                                                        </td>
                                                        <td colspan="1" style="text-align: center">
                                                            <input type="text" name="experience_desc[]" class="form-control"
                                                                placeholder="Experience"
                                                                value="{{ $item['experience_desc'] }}">
                                                        </td>
                                                        <td colspan="1" style="text-align: center">
                                                            <button class="btn btn-sm btn-danger remove_more_experience">Remove</button>
                                                        </td>
                                                    </tr>
                                                @endforeach

                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="form-group">
                                        <label for="skill">Skill</label>
                                        <button class="btn btn-sm btn-primary add_more_skill">Add row</button>
                                        <table class="table table-sm table-borderless" id="show_skill">
                                            <tbody>
                                                <tr>
                                                    {{-- <td colspan="1" style="text-align: center" class="form-inline">
                                                        <input type="text" name="skill[]" class="form-control" placeholder="Skill"
                                                            value="{{ old('skill') }}">
                                                        <button class="m-1 btn btn-sm btn-danger remove_more_skill">Remove</button>
                                                    </td> --}}
                                                    @foreach ($portofolio->skills as $item)
                                                        <td colspan="1" style="text-align: center" class="form-inline">
                                                            <input type="text" name="skill[]" class="form-control" placeholder="Skill"
                                                                value="{{ $item }}">
                                                            <button class="m-1 btn btn-sm btn-danger remove_more_skill">Remove</button>
                                                        </td>
                                                    @endforeach
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="form-group">
                                        <label for="location">Location</label>
                                        <input type="text" name="location" class="form-control" placeholder="" value="{{$portofolio->location}}" style="width:100%;">
                                    </div>

                                        <div class="mapform" >
                                            <input type="hidden" class="form-control" placeholder="lat" name="lat" id="lat">
                                            <input type="hidden" class="form-control" placeholder="lng" name="lng" id="lng">

                                            <div id="map" style="height:300px; width: 100%;" class="my-3"></div>

                                            {{-- <script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyArJ6Y3LioLJ5u6nkDW1SOYov3B45bKbfU&callback=initMap" type="text/javascript"></script> --}}
                                            {{-- <script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyArK-WJQanOboZA3EDjmgvG33Dqqkyim3I&callback=initMap" type="text/javascript"></script> --}}

                                            <script>
                                                let map;
                                                function initMap() {
                                                    getLat =
                                                    getLong =
                                                    map = new google.maps.Map(document.getElementById("map"), {
                                                        center: { lat: {{$portofolio->latitude}}, lng: {{$portofolio->longitude}} },
                                                        zoom: 15,
                                                        scrollwheel: true,
                                                    });

                                                    const uluru = { lat: {{$portofolio->latitude}}, lng: {{$portofolio->longitude}} };
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
                                    <input type="hidden" name="_method" value="{{ 'PUT' }}">
                                    <input type="submit" value="Update" class="btn btn-primary" id="update_btn" >
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script>
    $(document).ready(function () {
        $(".add_more_institute").click(function (e) {
            e.preventDefault();
            $("#show_institute").prepend(`
            <tr>
                <td colspan="1" style="text-align: center" class="align-middle">
                    <div class="input-group mb-3">
                        <select name="institute[]" id="inputGroupSelect01" class="custom-select">
                            <option value="SD"
                                {{ old('institute') == 'SD' ? 'selected' : '' }}>
                                SD</option>
                            <option value="SMP"
                                {{ old('institute') == 'SMP' ? 'selected' : '' }}>
                                SMP</option>
                            <option value="SMA"
                                {{ old('institute') == 'SMA' ? 'selected' : '' }}>
                                SMA</option>
                            <option value="SMK"
                                {{ old('institute') == 'SMK' ? 'selected' : '' }}>
                                SMK</option>
                            <option value="D3"
                                {{ old('institute') == 'D3' ? 'selected' : '' }}>
                                D3</option>
                            <option value="S1"
                                {{ old('institute') == 'S1' ? 'selected' : '' }}>
                                S1</option>
                        </select>
                    </div>
                </td>
                <td colspan="1" style="text-align: center" class="form-inline">
                    <input style="width:5em" type="text" name="year_start_institute[]" class="form-control" placeholder="Year" value="{{ old('year_start_institute') }}">
                    -
                    <input style="width:5em" type="text" name="year_end_institute[]" class="form-control" placeholder="Year" value="{{ old('year_end_institute') }}">
                </td>
                <td colspan="1" style="text-align: center">
                    <input type="text" name="institute_desc[]" class="form-control" placeholder="Institute Name" value="{{ old('institute_desc') }}">
                </td>
                <td colspan="1" style="text-align: center" >
                    <button class="btn btn-sm btn-danger remove_more_institute">Remove</button>
                </td>
            </tr>
            `)
        });
        $(document).on('click', '.remove_more_institute', function (e) {
            e.preventDefault();
            let row_item = $(this).parent().parent();
            $(row_item).remove();

        });
    });

</script>
<script>
    $(document).ready(function () {
        $(".add_more_experience").click(function (e) {
            e.preventDefault();
            $("#show_experience").prepend(`
            <tr>
                <td colspan="1" style="text-align: center" class="align-middle">
                    <div class="input-group mb-3">
                        <select name="experience[]" id="inputGroupSelect01" class="custom-select">
                            <option value="fulltime"
                                {{ old('experience') == 'fulltime' ? 'selected' : '' }}>
                                Full Time</option>
                            <option value="magang"
                                {{ old('experience') == 'magang' ? 'selected' : '' }}>
                                Magang</option>
                        </select>
                    </div>
                </td>
                <td colspan="1" style="text-align: center" class="form-inline">
                    <input style="width:5em" type="text" name="year_start_experience[]" class="form-control" placeholder="Year" value="{{ old('year_start_experience') }}">
                    -
                    <input style="width:5em" type="text" name="year_end_experience[]" class="form-control" placeholder="Year" value="{{ old('year_end_experience') }}">
                </td>
                <td colspan="1" style="text-align: center">
                    <input type="text" name="experience_desc[]" class="form-control" placeholder="Experience" value="{{ old('experience_desc') }}">
                </td>
                <td colspan="1" style="text-align: center" >
                    <button class="btn btn-sm btn-danger remove_more_experience">Remove</button>
                </td>
            </tr>
            `)
        });
        $(document).on('click', '.remove_more_experience', function (e) {
            e.preventDefault();
            let row_item = $(this).parent().parent();
            $(row_item).remove();

        });
    });

</script>

<script>
    $(document).ready(function () {
        $(".add_more_skill").click(function (e) {
            e.preventDefault();
            $("#show_skill").prepend(`
            <tr>
                <td colspan="1" style="text-align: center" class="form-inline">
                    <input type="text" name="skill[]" class="form-control" placeholder="Skill"
                        value="{{ old('skill') }}">
                    <button class="m-1 btn btn-sm btn-danger remove_more_skill">Remove</button>
                </td>
            </tr>
            `)
        });
        $(document).on('click', '.remove_more_skill', function (e) {
            e.preventDefault();
            let row_item = $(this).parent().parent();
            $(row_item).remove();

        });
    });

</script>
@endsection
