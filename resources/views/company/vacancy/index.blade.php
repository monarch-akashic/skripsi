@extends('layouts.app')
@section('content')

<link rel="stylesheet" href="/css/content.css">

<div class="container">
    @include('inc.messages')
    {{-- <h4 class="sub-heading ml-3 mb-5" style="display:inline-block;">Vacancies</h3>
    <a href="vacancy/create">
    <input type="submit" value="+" class="btn btn-primary">
    </a> --}}
    <div class="row justify-content-center">
        <div class="card w-75 mb-3" style="width: 20em; padding: 0%; background-color: #0FC2C0">
            <div class="row">
                <div class="card-body " style="padding: 1%; margin-left: 2em;">
                    <h5 class="card-title m-2">Vacancies</h5>
                </div>
                <div class="card-body" style="text-align:right; padding: 1%; margin-right: 2em">
                    <a href="vacancy/create" class="btn btn-dark" >
                        {{-- <input type="submit" value="+" class="btn btn-outline-light"> --}}
                        +
                    </a>
                </div>
            </div>
        </div>
    </div>

<!-- looping -->
        <div class="col-md-12">
            <div class="row justify-content-center">
                @foreach ($vacancies as $vacancy)
                    <div class="card w-75 mb-3" style="padding: 0.5em 0.5em 0.5em 1.5em;width: 18rem;">
                        <div class="row">
                            <div class="card-body">
                                <h5 class="card-title">{{$vacancy->job_name}}</h5>
                                <p class="card-text">{{$vacancy->age}} years old</p>
                                {{-- <p class="card-text">{{$vacancy->created_at}}</p> --}}
                            </div>


                            @if ($vacancy->status_open == 'Admin')
                                <div class="card-body mr-3" style="text-align:right;">
                                    <img src="/storage/img/vacancy_icon.png"  alt="..." class="ml-2 mr-2">
                                    <a href="/vacancy/{{$vacancy->id}}" class="btn btn-primary">See Details</a>
                                    <a href="/vacancy/{{$vacancy->id}}/list" class="btn btn-primary disabled" >Waiting check by Admin</a>
                                    {{-- <h5 class="card-title">On Check By Admin</h5> --}}
                                </div>
                            @elseif($vacancy->status_open == 'Rejected')
                                <div class="card-body mr-3" style="text-align:right;">
                                    <img src="/storage/img/vacancy_icon.png"  alt="..." class="ml-2 mr-2">
                                    <a href="/vacancy/{{$vacancy->id}}" class="btn btn-primary">See Details</a>
                                    <a href="/vacancy/{{$vacancy->id}}/list" class="btn btn-primary disabled">Rejected</a>
                                </div>
                            @else
                                <div class="card-body mr-3" style="text-align:right;">
                                    <img src="/storage/img/vacancy_icon.png"  alt="..." class="ml-2 mr-2">
                                    <a href="/vacancy/{{$vacancy->id}}" class="btn btn-primary">See Details</a>
                                    <a href="/vacancy/{{$vacancy->id}}/list" class="btn btn-primary">See List Applicant</a>
                                </div>
                            @endif
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
</div>
@endsection
