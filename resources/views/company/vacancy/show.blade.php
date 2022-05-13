@extends('layouts.app')
@section('content')

<div class="container">
    @include('inc.messages')
    <h4 class="sub-heading ml-3" style="display:inline-block;">Vacancies</h3>
    <a href="vacancy/create">
    <input type="submit" value="+" class="btn btn-primary">
    </a>
</div>

@endsection