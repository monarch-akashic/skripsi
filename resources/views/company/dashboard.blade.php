@extends('layouts.app')
@section('content')
<div class="container-fluid" style="margin: 8px 0px 0px 0px;">
    @include('inc.messages')
    {{-- <div class="row">
        <div class="col-xl-12 col-lg-12">
            <div class="card w-100 mb-3" style="width: 20em; padding: 0%; background-color: #0FC2C0">
                <div class="row">
                    <div class="card-body " style="padding: 1%; margin-left: 2em;">
                        <h5 class="card-title m-2">List Companies</h5>
                    </div>
                </div>
            </div>
        </div>
    </div> --}}
    <div class="row">
        {{-- <div class="col-md-12"> --}}
            <div class="col-xl-8 col-lg-7">
                <div class="card mb-4">
                    <div class="card-body">
                        <div class="chart-area">
                            {!! $chartArea->container() !!}
                            <script src="{{ $chartArea->cdn() }}"></script>
                            {!! $chartArea->script() !!}
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-4 col-lg-5">
                <div class="card mb-4">
                    <div class="card-body">
                        <div class="chart-area">
                            {!! $chartPie->container() !!}
                            <script src="{{ $chartPie->cdn() }}"></script>
                            {!! $chartPie->script() !!}
                        </div>
                    </div>
                </div>
            </div>
        {{-- </div> --}}
    </div>

    <div class="row">
        {{-- <div class="col-md-12"> --}}

            <div class="col-xl-12 col-lg-12">
                <div class="card mb-4">
                    {{-- <div class="card-body"> --}}
                        <table class="table table-striped table">
                            <thead class="bg-custom text-dark">
                                <tr>
                                    <th style="text-align: center" scope="col">#</th>
                                    <th scope="col">Job Name</th>
                                    <th style="text-align: center" scope="col">Status</th>
                                    <th style="text-align: center" scope="col">Working Hour</th>
                                    <th style="text-align: center" scope="col">Total Slot</th>
                                    <th style="text-align: center" scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $i = 1;
                                @endphp
                                @foreach ($vacancies as $item)
                                    <tr>
                                        <th class = "align-middle" width ="5%" style="text-align: center" scope="row">{{$i}}</th>
                                        <td class = "align-middle" width ="38%" scope="row"><a style="text-decoration-line: none ; color:#212529;" href="/vacancy/{{$item->id}}">{{$item->job_name}}</a></td>
                                        <td class = "align-middle" width ="15%" style="text-align: center" scope="row"><a style="text-decoration-line: none ; color:#212529;" href="/vacancy/{{$item->id}}">{{$item->status_open}}</a></td>
                                        <td class = "align-middle" width ="15%" style="text-align: center" scope="row"><a style="text-decoration-line: none ; color:#212529;" href="/vacancy/{{$item->id}}">{{$item->working_hour}}</a></td>
                                        <td class = "align-middle" width ="7%" style="text-align: center" scope="row"><a style="text-decoration-line: none ; color:#212529;" href="/vacancy/{{$item->id}}">{{$item->total_applicant}}</a></td>
                                        <td class = "align-middle" width ="20%" style="text-align: center" scope="row" >
                                            <a href="/vacancy/{{$item->id}}/list" style="text-decoration-line: none">
                                                <button type="button" class="btn btn-custom">
                                                    View List Applicant
                                                </button>
                                            </a>
                                            <a href="/vacancy/{{$item->id}}" style="text-decoration-line: none">
                                                <button type="button" class="btn btn-custom">
                                                    View Job Detail
                                                </button>
                                            </a>
                                        </td>
                                    </tr>
                                @php
                                    $i++;
                                @endphp
                                @endforeach
                            </tbody>
                          </table>
                    {{-- </div> --}}
                </div>
            </div>

        {{-- </div> --}}
    </div>
</div>

@endsection
