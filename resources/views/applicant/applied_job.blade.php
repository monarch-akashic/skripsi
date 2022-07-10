@extends('layouts.app')
@section('content')
<link rel="stylesheet" href="/css/content.css">

<div class="container">
    @include('inc.messages')
    <div class="col-md-12">
        <div class="row justify-content-center">
            <div class="card w-75 mb-3" style="width: 20em; padding: 0%; background-color: #0FC2C0">
                <div class="row">
                    <div class="card-body " style="padding: 1%; margin-left: 2em;">
                        <h5 class="card-title m-2">My Job Applied</h5>
                    </div>
                </div>
            </div>
        </div>
        <div class="row justify-content-center">
            @if (empty($vacancies[0]))
                <div class="card w-75 mb-3" style="width: 18rem;">
                    <div class="row">
                        <div class="card-body">
                            <h5 class="card-title">Currently Empty</h5>
                            {{-- <p class="card-text">{{$vacancy->age}} Age</p>
                            <p class="card-text">{{$vacancy->created_at}}</p> --}}
                        </div>
                    </div>
                </div>
            @else
                @foreach ($vacancies as $vacancy)
                    <div class="card w-75 mb-3" style="width: 18rem;">
                        <div class="row">
                            <div class="card-body">
                                <h5 class="card-title">{{$vacancy->job_name}}</h5>
                                <p class="card-text m-0">{{$vacancy->city_name}}</p>
                                <p class="card-text m-0">Applied on {{date('d-M-Y',strtotime($vacancy->created_at))}}</p>
                                <p class="card-text m-0">{{number_format($vacancy->latitude, 2)}} km</p>
                            </div>

                            <div class="card-body mr-3" style="text-align:right;">
                                {{-- <img src="/storage/img/user_dummy.jpg"  alt="..." class="round-circle ml-2 mr-2"> --}}
                                <p class="text-dark font-weight-bold" style="margin: 16px 0px 0px 0px">Status</p>
                                <p class="text-dark font-weight-bold m-0">{{$vacancy->status}}</p>
                                <a href="/myvacancy/vacancy/{{$vacancy->id}}" class="btn btn-primary">See Details</a>
                            </div>
                        </div>
                    </div>
                @endforeach
            @endif
        </div>
    </div>
</div>

@endsection
