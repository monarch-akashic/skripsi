@extends('layouts.app')
@section('content')

<link rel="stylesheet" href="/css/content.css">

<div class="container">
    @include('inc.messages')
    <h4 class="sub-heading ml-3 mb-5" style="display:inline-block;">Vacancies</h3>
    <a href="vacancy/create">
    <input type="submit" value="+" class="btn btn-primary">
    </a>
    
<!-- looping -->
        <div class="col-md-12">
            <div class="row justify-content-center">
                <div class="card w-75" style="width: 18rem;">
                    <div class="row">
                        <div class="card-body">
                            <h5 class="card-title">Job Name</h5>
                            <p class="card-text">Range Age</p>
                            <p class="card-text">Valid Time (by sistem)</p>
                        </div>

                        <div class="card-body mr-3" style="text-align:right;">
                            <img src="/storage/img/user_dummy.jpg"  alt="..." class="round-circle ml-2 mr-2">
                            <a href="#" class="btn btn-primary">See Details</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
</div>
@endsection