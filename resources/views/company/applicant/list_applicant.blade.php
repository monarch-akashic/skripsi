@extends('layouts.app')
@section('content')
<link rel="stylesheet" href="/css/content.css">

<div class="container">
    @include('inc.messages')
    <table class="table table-striped table-sm">
        <thead class="bg-custom text-light">
            <tr>
                <th style="text-align: center" scope="col">#</th>
                <th scope="col">Applicant Name</th>
                <th style="text-align: center" scope="col">Detail</th>
            </tr>
        </thead>
        <tbody>
            @php
                $i = 1;
            @endphp
            @foreach ($applicant as $item)
                <tr>
                    <th class = "align-middle" width ="5%" style="text-align: center" scope="row">{{$i}}</th>
                    <td class = "align-middle" width ="75%" scope="row"><a style="text-decoration-line: none ; color:#212529;" href="/vacancy/{{$item->vacancy_id}}/portofolio/{{$item->getApplicantInfo->id}}">{{$item->getApplicantInfo->name}}</a></td>
                    <td class = "align-middle" width ="12%" style="text-align: center" scope="row" >
                        <a href="/vacancy/{{$item->vacancy_id}}/portofolio/{{$item->getApplicantInfo->id}}" style="text-decoration-line: none">
                            <button type="button" class="btn btn-custom">
                                View Portofolio
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
</div>

@endsection
