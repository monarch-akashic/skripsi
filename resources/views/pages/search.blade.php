@extends('layouts.app')
@section('content')
<link rel="stylesheet" href="/css/content.css">

<div class="container">
    @include('inc.messages')
    <div class="col-md-12">
        <div class="row justify-content-center">
            <div class="card w-75 mb-3" style="width: 18rem;">
                <div class="row">
                    <div class="card-body" style="padding: 0px 0px 0px 25px ;width: 70%">
                        <h5 class="card-title">Search by Location</h5>
                    </div>
                </div>
                <div class="row">
                    <div class="card-body" style="padding: 0px 0px 0px 20px; width: 100%">
                        <form class="form-inline" action="{{ action('PagesController@result') }}" method="POST" role="search">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <input type="text" name="vacancy" class="form-control" placeholder="Search" style="margin:5px ; width: 63%; height: 40px">
                            <select name="search_type" id="inputGroupSelect01"
                                    class="custom-select"
                                    placeholder="search_type" style="margin:2px; width: 20%; height: 40px">
                                    <option value="job">Job Name</option>
                                    <option value="company">Company</option>
                            </select>
                            <input type="submit" class="btn btn-primary" style="margin-left:2px ; width: 12%; height: 40px" value="Search">
                            <select name="province" id="inputGroupSelect01"
                                    class="custom-select"
                                    placeholder="province" style="margin-left:5px ;width: 30%"">
                                    <option value="" selected>--Province--</option>
                                    @foreach($province as $item)
                                        <option value="{{ $item->prov_id }}"
                                            {{ old('province') == $item->prov_id ? 'selected' : '' }}>
                                            {{ $item->prov_name }}</option>
                                    @endforeach
                            </select>
                            <select name="city" id="inputGroupSelect01"
                                    class="custom-select "
                                    placeholder="city" style="margin-left:2px ; width: 30%">
                                    <option value="" selected>--City--</option>
                                    @foreach($city as $item)
                                        <option value="{{ $item->city_id }}"
                                            {{ old('city') == $item->city_id ? 'selected' : '' }}>
                                            {{ $item->city_name }}</option>
                                    @endforeach
                            </select>
                            <select name="district" id="inputGroupSelect01"
                                    class="custom-select "
                                    placeholder="district" style="margin-left:2px ;width: 30%"">
                                    <option value="" selected>--District--</option>
                                    @foreach($district as $item)
                                        <option value="{{ $item->dis_id }}"
                                            {{ old('district') == $item->dis_id ? 'selected' : '' }}>
                                            {{ $item->dis_name }}</option>
                                    @endforeach
                            </select>
                        </form>
                        <div class="card-body" style="padding: 0px 0px 0px 20px; width: 100%">
                            <div class="input-group mb-3 ">

                            </div>
                        </div>
                    </div>
                    <div class="card-body mr-3" style="padding: 20px 20px 0px 0px ;width: 20%; text-align:right;">
                        <a href="/search">
                            <p class="text-primary card-link">Advance Search</p>
                        </a>
                    </div>
                </div>
            </div>
            @foreach ($vacancies as $vacancy)
                <div class="card w-75 mb-3" style="width: 18rem;">
                    <div class="row">
                        <div class="card-body">
                            <h5 class="card-title">{{$vacancy->job_name}}</h5>
                            <p class="card-text m-0">{{$vacancy->name}}
                                @if ($vacancy->verified == 'Yes')
                                    <img src="/storage/img/verified.png" style="width: 22px" alt="">
                                @endif
                            </p>
                            <p class="card-text m-0">{{$vacancy->city_name}}</p>
                            <p class="card-text m-0">{{number_format($vacancy->latitude, 2)}} km</p>
                        </div>

                        <div class="card-body mr-3" style="text-align:right;">
                            <img src="/storage/img/user_dummy.jpg"  alt="..." class="round-circle ml-2 mr-2">
                            <a href="/vacancy/{{$vacancy->id}}" class="btn btn-primary">See Details</a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        <div class="row justify-content-center">
            {!!$vacancies->links()!!}
        </div>
    </div>
</div>

@endsection
