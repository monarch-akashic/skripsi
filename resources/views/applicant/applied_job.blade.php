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
                            <p class="card-text">{{$vacancy->city_name}}</p>
                            <p class="card-text">Applied on {{date('d-M-Y',strtotime($vacancy->created_at))}}</p>
                            <p class="card-text">{{number_format($vacancy->latitude, 2)}} km</p>
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
        </div>
    </div>
</div>

@endsection
