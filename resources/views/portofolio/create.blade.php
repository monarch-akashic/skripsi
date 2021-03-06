@extends('layouts.app')
@section('content')
<div class="container">
    @if (count($errors) == 0)
        @include('inc.messages')
    @endif
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="sub-heading">Create Profile</h4>
                    <form action="{{ action('PortofolioController@store') }}" method="POST" enctype="multipart/form-data">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <div class="row m-2">
                            <div class="card-m-3" style="width: 20%">
                                <div class="profile-header-avatar align-middle"
                                    style="background-image: url('../storage/img/default_profile.jpg')">
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
                                        {{-- <input type="text" name="education" class="form-control" placeholder="Education" value="{{ old('education') }}"> --}}
                                        <table class="table table-sm table-borderless" id="show_institute">
                                            {{-- <thead class="bg-custom text-light">
                                                <tr>
                                                    <th scope="col" class="align-middle" width="10%">Institute</th>
                                                    <th scope="col" class="align-middle" width="40%">Year</th>
                                                    <th scope="col" class="align-middle" width="40%">Description</th>
                                                    <th scope="col" class="align-middle" width="10%">
                                                        <button class="btn btn-sm btn-primary add_more">Add row</button>
                                                    </th>
                                                </tr>
                                            </thead> --}}
                                            <tbody>
                                                <tr>
                                                    <td colspan="1" style="text-align: center" class="align-middle">
                                                        <div class="input-group mb-3">
                                                            <select name="institute[]" id="inputGroupSelect01" class="custom-select">
                                                                @foreach ($categories as $item)
                                                                    <option value="{{$item->name}}"

                                                                        >
                                                                        {{$item->name}}
                                                                    </option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    </td>
                                                    <td colspan="1" style="text-align: center" class="form-inline">
                                                        <input style="width:5em" type="text" name="year_start_institute[]" class="form-control" placeholder="Year"
                                                            >
                                                        -
                                                        <input style="width:5em" type="text" name="year_end_institute[]" class="form-control" placeholder="Year"
                                                            >
                                                    </td>
                                                    <td colspan="1" style="text-align: center">
                                                        <input type="text" name="institute_desc[]" class="form-control"
                                                            placeholder="Institute Name"
                                                            >
                                                    </td>
                                                    <td colspan="1" style="text-align: center">
                                                        <button class="btn btn-sm btn-danger remove_more_institute">Remove</button>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="form-group">
                                        <label for="experience">Experience</label>
                                        {{-- <input type="text" name="experience" class="form-control" placeholder="Experience" value="{{ old('experience') }}"> --}}
                                        <button class="btn btn-sm btn-primary add_more_experience">Add row</button>
                                        {{-- <input type="text" name="education" class="form-control" placeholder="Education" value="{{ old('education') }}"> --}}
                                        <table class="table table-sm table-borderless" id="show_experience">
                                            {{-- <thead class="bg-custom text-light">
                                                <tr>
                                                    <th scope="col" class="align-middle" width="10%">Institute</th>
                                                    <th scope="col" class="align-middle" width="40%">Year</th>
                                                    <th scope="col" class="align-middle" width="40%">Description</th>
                                                    <th scope="col" class="align-middle" width="10%">
                                                        <button class="btn btn-sm btn-primary add_more">Add row</button>
                                                    </th>
                                                </tr>
                                            </thead> --}}
                                            <tbody>
                                                <tr>
                                                    <td colspan="1" style="text-align: center" class="align-middle">
                                                        <div class="input-group mb-3">
                                                            <select name="experience[]" id="inputGroupSelect01" class="custom-select">
                                                                @foreach ($experience_category as $item)
                                                                    <option value="{{$item->name}}"
                                                                       >
                                                                        {{ucfirst($item->name)}}
                                                                    </option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    </td>
                                                    <td colspan="1" style="text-align: center" class="form-inline">
                                                        <input style="width:5em" type="text" name="year_start_experience[]" class="form-control" placeholder="Year"
                                                            >
                                                        -
                                                        <input style="width:5em" type="text" name="year_end_experience[]" class="form-control" placeholder="Year"
                                                            >
                                                    </td>
                                                    <td colspan="1" style="text-align: center">
                                                        <input type="text" name="experience_desc[]" class="form-control"
                                                            placeholder="Experience"
                                                            >
                                                    </td>
                                                    <td colspan="1" style="text-align: center">
                                                        <button class="btn btn-sm btn-danger remove_more_experience">Remove</button>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="form-group">
                                        <label for="skill">Skill</label>
                                        <button class="btn btn-sm btn-primary add_more_skill">Add row</button>
                                        <table class="table table-sm table-borderless" id="show_skill">
                                            <tbody>
                                                <tr>
                                                    <td colspan="1" style="text-align: center" class="form-inline">
                                                        <input type="text" name="skill[]" class="form-control" placeholder="Skill"
                                                            >
                                                        <button class="m-1 btn btn-sm btn-danger remove_more_skill">Remove</button>
                                                    </td>
                                                    {{-- <td colspan="1" style="text-align: center">
                                                        <button class="btn btn-sm btn-danger remove_more_skill">Remove</button>
                                                    </td> --}}
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                    {{-- <div class="form-group">
                                        <label for="skills">Skills</label>
                                        <textarea name="skills" id="article-ckeditor" rows="5" class="form-control"
                                            placeholder="Description">{{ old('skills') }}</textarea>
                                    </div> --}}

                                    <div class="form-group">
                                        <label for="location">Location</label>
                                        <input type="text" name="location" class="form-control @error('location') is-invalid @enderror" placeholder="" value="" style="width:100%;">
                                        @error('location')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>

                                        {{-- <div class="mapform" >
                                            <input type="hidden" class="form-control" placeholder="lat" name="lat" id="lat">
                                            <input type="hidden" class="form-control" placeholder="lng" name="lng" id="lng">

                                            <div id="map" style="height:300px; width: 100%;" class="my-3"></div>
                                            <script>
                                                let map;
                                                function initMap() {
                                                    getLat =
                                                    getLong =
                                                    map = new google.maps.Map(document.getElementById("map"), {
                                                        center: { lat: {{$mylat}}, lng: {{$mylong}} },
                                                        zoom: 15,
                                                        scrollwheel: true,
                                                    });

                                                    const uluru = { lat: {{$mylat}}, lng: {{$mylong}} };
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

                                            <script async defer src="https://maps.googleapis.com/maps/api/js?key={{ env('GOOGLE_MAP_KEY') }}&callback=initMap" type="text/javascript"></script>

                                        </div> --}}
                                    {{-- <input type="hidden" name="_method" value="{{ 'PUT' }}"> --}}
                                    <input type="submit" value="Submit" class="btn btn-primary" id="update_btn" >
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
                            @foreach ($categories as $item)
                                <option value="{{$item->name}}">
                                    {{$item->name}}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </td>
                <td colspan="1" style="text-align: center" class="form-inline">
                    <input style="width:5em" type="text" name="year_start_institute[]" class="form-control" placeholder="Year" >
                    -
                    <input style="width:5em" type="text" name="year_end_institute[]" class="form-control" placeholder="Year" >
                </td>
                <td colspan="1" style="text-align: center">
                    <input type="text" name="institute_desc[]" class="form-control" placeholder="Institute Name" ">
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
                            @foreach ($experience_category as $item)
                                <option value="{{$item->name}}">
                                    {{ucfirst($item->name)}}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </td>
                <td colspan="1" style="text-align: center" class="form-inline">
                    <input style="width:5em" type="text" name="year_start_experience[]" class="form-control" placeholder="Year" >
                    -
                    <input style="width:5em" type="text" name="year_end_experience[]" class="form-control" placeholder="Year" >
                </td>
                <td colspan="1" style="text-align: center">
                    <input type="text" name="experience_desc[]" class="form-control" placeholder="Experience" >
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
                        >
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
