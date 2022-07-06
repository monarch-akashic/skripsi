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
                                <h4 class="text-dark font-weight-bold mt-2 mb-3">
                                    Current Location
                                </h4>
                                <div class="form-group">
                                    <div class="row m-2">
                                        <div class="card-mb-3" style="width: 100%">
                                            <label for="name" class="text-dark font-weight-bold m-0">Label</label>
                                            <p class="m-0">{{$user_location->name}}</p>
                                        </div>
                                    </div>
                                    <div class="row m-2">
                                        <div class="card-mb-3" style="width: 100%">
                                            <label for="name" class="text-dark font-weight-bold m-0">Address</label>
                                            <p class="m-0">{{$user_location->location}}</p>
                                        </div>
                                    </div>
                                    <div class="row m-2">
                                        <div class="card-mb-3" style="width: 50%">
                                            <label for="name" class="text-dark font-weight-bold m-0">Province</label>
                                            <p class="m-0">{{$user_location->province}}</p>
                                        </div>
                                        <div class="card-mb-3" style="width: 50%">
                                            <label for="name" class="text-dark font-weight-bold m-0">Kota</label>
                                            <p class="m-0">{{$user_location->kota}}</p>
                                        </div>
                                    </div>
                                    <div class="row m-2">
                                        <div class="card-mb-3" style="width: 50%">
                                            <label for="name" class="text-dark font-weight-bold m-0">Kecamatan</label>
                                            <p class="m-0">{{$user_location->kecamatan}}</p>
                                        </div>
                                        <div class="card-mb-3" style="width: 50%">
                                            <label for="name" class="text-dark font-weight-bold m-0">Kode Pos</label>
                                            <p>{{$user_location->kode_pos}}</p>
                                        </div>
                                    </div>
                                    <div class="mapform" >
                                        <input type="hidden" class="form-control" placeholder="lat" name="lat" id="lat">
                                        <input type="hidden" class="form-control" placeholder="lng" name="lng" id="lng">

                                        <div id="map" style="height:400px; width: 100%;" class="my-3"></div>

                                        <script>
                                            let map;
                                            function initMap() {
                                                map = new google.maps.Map(document.getElementById("map"), {
                                                    center: { lat: {{$user_location->latitude}}, lng: {{$user_location->longitude}}},
                                                    zoom: 18,
                                                    scrollwheel: false,
                                                });

                                                const uluru = { lat: {{$user_location->latitude}}, lng: {{$user_location->longitude}} };
                                                let marker = new google.maps.Marker({
                                                    position: uluru,
                                                    map: map,
                                                    draggable: false,
                                                });

                                            }
                                        </script>

                                        <script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyArJ6Y3LioLJ5u6nkDW1SOYov3B45bKbfU&callback=initMap" type="text/javascript"></script>
                                    </div>
                                </div>
                                <div class="text-right mt-3">
                                    <a class="btn btn-primary" href="/accounts/location/edit">Change</a>
                                    {{-- <button type="button" class="btn btn-default">Cancel</button> --}}
                                </div>
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
