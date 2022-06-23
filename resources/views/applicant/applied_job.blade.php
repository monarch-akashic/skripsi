@extends('layouts.app')
@section('content')
<link rel="stylesheet" href="/css/content.css">

<div class="container">
    @include('inc.messages')
    <div class="col-md-12">
        <div class="row justify-content-center">
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

@endsection
