@extends('layouts.app')
@section('content')
{{-- <div class="container"> --}}
    <div class="container light-style flex-grow-1 container-p-y">
        <h4 class="font-weight-bold py-3 mb-4">
            Account settings
        </h4>
        @if (count($errors) == 0)
            @include('inc.messages')
        @endif
        <div class="card overflow-hidden">
            <div class="row no-gutters row-bordered row-border-light">
                <div class="col-md-3 pt-0">
                    <div class="list-group list-group-flush account-settings-links">
                        <a class="list-group-item list-group-item-action"
                            href="/accounts/password/change">Change password</a>
                        <a class="list-group-item list-group-item-action active" data-toggle="list"
                            href="#account-info">Location</a>
                        <a class="list-group-item list-group-item-action"
                            href="/accounts/edit/notification">Notifications</a>
                    </div>
                </div>
                <div class="col-md-9">
                    <div class="tab-content">
                        <div class="tab-pane fade active show" id="account-info">
                            <div class="card-body pb-2">
                                <form method="POST" action="{{ route('edit.location') }}">
                                    @csrf
                                    <div class="form-group">
                                        <label for="">Name</label>
                                        <input type="text" name="name"
                                            class="form-control @error('name') is-invalid @enderror"
                                            placeholder="" value="{{ old('name') }}"
                                            style="width:100%;">

                                        @error('name')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>

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
                                    <div class="form-group">
                                        <p class="card-text">Please pin point the location</p>

                                        <div class="mapform">
                                            <input type="hidden" class="form-control" placeholder="lat" name="lat"
                                                id="lat">
                                            <input type="hidden" class="form-control" placeholder="lng" name="lng"
                                                id="lng">

                                            <div id="map" style="height:300px; width: 100%;" class="my-3"></div>
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

                                        </div>
                                    </div>
                                    <div class="text-right mt-3">
                                        <button type="submit" class="btn btn-primary">Save changes</button>&nbsp;
                                        <button type="button" class="btn btn-default">Cancel</button>
                                    </div>
                                </form>
                            </div>
                            <hr class="border-light m-0">
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
{{-- </div> --}}
@endsection
