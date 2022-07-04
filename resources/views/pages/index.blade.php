@extends('layouts.app')
@section('content')
<link rel="stylesheet" href="/css/content.css">

<div class="container">
    @include('inc.messages')
    <div class="col-md-12">
        <div class="row justify-content-center">
            <div class="card w-75 mb-3" style="width: 18rem;">
                <div class="row">
                    <div class="card-body" style="width: 80%">
                        <h5 class="card-title">Search by Location</h5>
                        {{-- <p class="card-text"></p> --}}
                        <form class="form-inline" action="{{ action('PagesController@result') }}" method="POST" role="search">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <input type="text" name="vacancy" class="form-control" placeholder="Search" style="margin:2px ; width: 80%; height: 40px">
                            <input type="submit" class="btn btn-primary" style="margin-left:2px ; width: 10%; height: 40px" value="Search">
                        </form>
                    </div>

                    <div class="card-body mr-3" style="width: 10%; text-align:right;">
                        <h5 class="card-title">Filter</h5>

                        {{-- <img src="/storage/img/user_dummy.jpg"  alt="..." class="round-circle ml-2 mr-2">
                        <a href="/vacancy/{{$vacancy->id}}" class="btn btn-primary">See Details</a> --}}
                    </div>
                </div>
            </div>
            @foreach ($vacancies as $vacancy)
                <div class="card w-75 mb-3" style="width: 18rem;">
                    <div class="row">
                        <div class="card-body">
                            <h5 class="card-title">{{$vacancy->job_name}}</h5>
                            <p class="card-text">{{$vacancy->age}} Age</p>
                            <p class="card-text">{{$vacancy->created_at}}</p>
                            <p class="card-text">{{number_format($vacancy->latitude, 2)}} km</p>
                        </div>

                        <div class="card-body mr-3" style="text-align:right;">
                            <img src="/storage/img/user_dummy.jpg"  alt="..." class="round-circle ml-2 mr-2">
                            <a href="/vacancy/{{$vacancy->id}}" class="btn btn-primary">See Details</a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>
<input type="hidden" name="csrf-token" id="csrf-token" value="{{ csrf_token() }}">

<script>
    window.onload = function() {
        if (navigator.geolocation) {
            navigator.geolocation.watchPosition(setPosition);
        } else {
            console.log("Geolocation not supported by browser.");
        }

    }

    function setPosition(position) {
        console.log(position);
        var latitude = position.coords.latitude;
        var longitude = position.coords.longitude;

        var csrf = $("#csrf-token").val();

        $.ajax({
            type: 'POST',
            url: "{{ route('pages.location') }}",
            data: {
                _token:csrf,
                latitude: position.coords.latitude,
                longitude: position.coords.longitude
            },
            success: function(ajax) {
                console.log($.ajax);
            },
            error: function(request, error) {
                console.log(error);
            }
        });
    }
</script>

@endsection
