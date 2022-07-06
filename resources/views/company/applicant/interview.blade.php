@extends('layouts.app')
@section('content')
<div class="container">
    @include('inc.messages')
    <div class="justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="sub-heading ml-3">Send Interview Schedule</h4>
                    <form method="POST" action="{{ route('store.interview', [$vacancy_id, $user_id->id] ) }}" enctype="multipart/form-data">

                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <input type="hidden" name="user_id" value= {{ $user_id->id}}>
                        <input type="hidden" name="vacancy_id" value= {{ $vacancy_id}}>
                            <div class="card-mb-3" style="width: 100%">
                                <div class="card-body">
                                    <div class="form-group">
                                        <label for="applicant">Applicant</label>
                                        <h5 class="text-primary font-weight-bold">{{ $user_id->name}}</h5>
                                    </div>

                                    <div class="form-group">
                                        <label for="phoneNo">Phone No</label>
                                        <h5 class="text-primary font-weight-bold">{{ $user_id->phoneNo}}</h5>

                                    </div>

                                    <div class="form-group">
                                        <label for="email">Email</label>
                                        <h5 class="text-primary font-weight-bold">{{ $user_id->email}}</h5>
                                    </div>

                                    <div class="form-group">
                                        <label for="interview_time" class="form-label">When</label>
                                        <input type="text" name="interview_time" class="form-control" placeholder="When" >
                                    </div>

                                    <div class="form-group">
                                        <label for="interview_location" class="form-label">Where</label>
                                        <input type="text" name="interview_location" class="form-control" placeholder="Where" >
                                    </div>

                                    <div class="form-group">
                                        <label for="notes">Notes</label>
                                        <textarea type="text" name="notes" class="form-control" placeholder="Notes" ></textarea>
                                        {{-- <h5 class="text-primary font-weight-bold">Notes</h5> --}}
                                    </div>

                                    <input type="submit" value="Send" class="btn btn-primary">
                                </div>
                            </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
