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
                        <h5 class="card-title m-2">List Companies</h5>
                    </div>
                </div>
            </div>
        </div>
        <div class="row justify-content-center">
            @if (empty($companies[0]))
                <div class="card w-75 mb-3" style="width: 18rem;">
                    <div class="row">
                        <div class="card-body">
                            <h5 class="card-title">Currently Empty</h5>
                        </div>
                    </div>
                </div>
            @else
                @foreach ($companies as $company)
                    <div class="card w-75 mb-3" style="width: 18rem;">
                        <div class="row">
                            <div class="card-body">
                                <h5 class="card-title">{{$company->name}}</h5>
                            </div>

                            <div class="card-body mr-3" style="text-align:right;">
                                <img src="/storage/img/vacancy_icon.png"  alt="..." class="ml-2 mr-2">
                                <a href="/company/{{$company->user_id}}" class="btn btn-primary">See Details</a>
                                <a href="/list/company/verify/{{$company->id}}" class="btn btn-outline-primary">Review Requirement</a>
                                @if ($company->flag_block == 'X')
                                    <button type="button" data-id="{{$company->id}}" data-type="unpenalize" class="open-PenalizeCompany btn btn-outline-danger" data-toggle="modal" data-target="#checkoutmodel">
                                        Unpenalize
                                    </button>
                                @else
                                    <button type="button" data-id="{{$company->id}}" data-type="penalize" class="open-PenalizeCompany btn btn-outline-danger" data-toggle="modal" data-target="#checkoutmodel">
                                        Penalize
                                    </button>
                                @endif
                            </div>
                        </div>
                    </div>
                @endforeach
            @endif
        </div>
        <div class="row justify-content-center">
            {!!$companies->links()!!}
        </div>
    </div>
</div>
{{-- pop up --}}
<div class="modal fade" id="checkoutmodel" role="dialog" aria-labelledby="checkoutmodel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-custom text-white">
                <h5 class="modal-title" id="exampleModalLongTitle">Confirmation Penalize</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                Are you sure ?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <form method="POST" action="{{ route('process.company') }}" enctype="multipart/form-data">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <input type="hidden" name="company_id" id="company_id" value="">
                    <input type="hidden" name="type" id="type" value="">
                    <input type="submit" value="Confirm" class="btn btn-outline-danger">
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).on("click", ".open-PenalizeCompany", function () {
        var mycompany_id = $(this).data('id');
        var type = $(this).data('type');
        $(".modal-footer #company_id").val( mycompany_id );
        $(".modal-footer #type").val( type );
    });
</script>

@endsection
