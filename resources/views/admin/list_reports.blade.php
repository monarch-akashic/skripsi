@extends('layouts.app')
@section('content')
<link rel="stylesheet" href="/css/content.css">
<div class="container">
    @include('inc.messages')
    <table class="table table-striped table-sm">
        <thead class="bg-custom text-dark">
            <tr>
                <th style="text-align: center" scope="col">Report ID</th>
                <th scope="col">Date</th>
                <th scope="col">Requestor</th>
                <th style="text-align: center" scope="col">Job Offerer</th>
                <th style="text-align: center" scope="col">Subject of issue</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($reports as $item)
                <tr>
                    <th class = "align-middle" width ="10%" style="text-align: center" scope="row" ><a style="text-decoration-line: none ; color:#212529;" href="/list/report/{{$item->id}}">{{$item->id}}</a></th>
                    <td class = "align-middle" width ="20%" scope="row"><a style="text-decoration-line: none ; color:#212529;" href="/list/report/{{$item->id}}">{{$item->created_at}}</a></td>
                    <td class = "align-middle" width ="20%" scope="row"><a style="text-decoration-line: none ; color:#212529;" href="/list/report/{{$item->id}}">{{$item->getApplicantInfo->name}}</a></td>
                    <td class = "align-middle" width ="20%" scope="row"style="text-align: center" >
                        <a href="/list/report/{{$item->id}}" style="text-decoration-line: none">
                            {{$item->name}}
                        </a>
                    </td>
                    <td class = "align-middle" width ="30%" style="text-align: center" scope="row">
                        <a href="/list/report/{{$item->id}}" style="text-decoration-line: none">
                            {{$item->subject}}
                        </a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>

@endsection
