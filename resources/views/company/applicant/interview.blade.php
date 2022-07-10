@extends('layouts.app')
@section('content')
<div class="container">
    @if (count($errors) == 0)
        @include('inc.messages')
    @endif
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
                                        <label for="applicant" class="text-primary font-weight-bold">Applicant</label>
                                        <h5 >{{ $user_id->name}}</h5>
                                    </div>

                                    <div class="form-group">
                                        <label for="phoneNo" class="text-primary font-weight-bold">Phone No</label>
                                        <h5 >{{ $user_id->phoneNo}}</h5>

                                    </div>

                                    <div class="form-group">
                                        <label for="email" class="text-primary font-weight-bold">Email</label>
                                        <h5 >{{ $user_id->email}}</h5>
                                    </div>

                                    <div class="form-group">
                                        <label for="interview_time" class="form-label">When</label>
                                        <input type="text" name="interview_time" class="form-control @error('interview_time') is-invalid @enderror" placeholder="When" >

                                        @error('interview_time')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>


                                    <div class="form-group">
                                        <label for="interview_location" class="form-label">Where</label>
                                        <input type="text" name="interview_location" class="form-control @error('interview_location') is-invalid @enderror" placeholder="Where" >

                                        @error('interview_location')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label for="notes">Notes</label>
                                        <textarea type="text" name="notes" class="form-control @error('notes') is-invalid @enderror" placeholder="Notes" ></textarea>
                                        {{-- <h5 class="text-primary font-weight-bold">Notes</h5> --}}

                                        @error('notes')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>

                                    {{-- <input type="submit" value="Send" class="btn btn-primary"> --}}
                                    <button type="submit" name="action" class="btn btn-primary" value="Send">Send</button>
                                </div>
                            </div>
                    </form>
                    <script>
                        $(function() {
                            $( "form" ).submit(function() {
                                $('#loader').show();
                            });
                        });
                    </script>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
