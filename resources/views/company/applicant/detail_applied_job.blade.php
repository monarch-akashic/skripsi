@extends('layouts.app')
@section('content')
<div class="container">
    @if (count($errors) == 0)
        @include('inc.messages')
    @endif
    <div class="justify-content-center">
        <div class="col-md-12">
            <div class="card">
                {{-- <div class="row justify-content-center"> --}}
                    <div style="width: 100%; padding: 0%; background-color: #0FC2C0">
                        <div class="row">
                            <div class="card-body " style="padding: 1%; margin-left: 2em;">
                                <h3 class="card-title font-weight-bold" style="margin: 2px 2px 2px">Job Details</h3>
                            </div>
                        </div>
                    </div>
                {{-- </div> --}}
                <div class="card-body">
                    {{-- <h4 class="sub-heading">Vacancy</h4> --}}
                    <form action="{{action('ApplicantController@acceptInterview', $vacancies->id)}}" method="POST" enctype="multipart/form-data">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <div class="row mb-2">
                            <div class="card-mb-3" style="width: 50%">
                                <div class="card-body">
                                    <div class="form-group">
                                        {{-- <label for="job_name">Job Name</label> --}}
                                        <h4 class="text-dark font-weight-bold">Job Name</h4>
                                        {{-- <input type="text" name="job_name" class="form-control" placeholder="" value={{$vacancies->job_name}} style="width:100%;" > --}}
                                        <p class="card-text">
                                            {!!$vacancies->job_name!!}
                                        </p>
                                    </div>
                                </div>

                            </div>
                            <div class="card-mb-3" style="width: 50%">
                                <div class="card-body">
                                    <div class="form-group">
                                        {{-- <label for="job_name">Job Name</label> --}}
                                        <h4 class="text-dark font-weight-bold">Company</h4>
                                        {{-- <input type="text" name="job_name" class="form-control" placeholder="" value={{$vacancies->job_name}} style="width:100%;" > --}}
                                        <p class="card-text">
                                            {!!$company_info->name!!}
                                        </p>
                                    </div>

                                </div>
                            </div>
                        </div>

                        <div class="row mb-2">
                            <div class="card-mb-3" style="width: 100%">
                                <div class="card-body">
                                    <div class="form-group">
                                        <label for="job_description" class="form-label text-dark font-weight-bold">Job Description</label>
                                        {{-- <textarea name="job_description" class="form-control" id="job_description" rows="3" style="width:100%; height:200px;" disabled>{{$vacancies->job_description}}</textarea> --}}
                                        <p class="card-text">
                                            {!!$vacancies->job_description!!}
                                        </p>
                                    </div>


                                    <div class="form-group">
                                        <label for="job_requirement" class="text-dark font-weight-bold">Job Requirement</label>
                                        {{-- <textarea name="job_requirement" class="form-control" id="job_requirement" rows="3" style="width:100%; height:200px;" disabled>{!!$vacancies->requirement!!}</textarea> --}}
                                        <p class="card-text">
                                            {!!$vacancies->requirement!!}
                                        </p>
                                    </div>
                                    <div class="form-group">
                                        <table class="table table-sm table-borderless">
                                            <tbody>
                                                <tr>
                                                    <td colspan="1" style="text-align: left" class="text-dark font-weight-bold">
                                                        Salary
                                                    </td>
                                                    <td colspan="1" style="text-align: left" class="text-dark font-weight-bold">
                                                        Range Age
                                                    </td>
                                                    <td colspan="1" style="text-align: left" class="text-dark font-weight-bold">
                                                        Working Hours
                                                    </td>
                                                    <td colspan="1" style="text-align: left" class="text-dark font-weight-bold">
                                                        Application Slots
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td colspan="1" style="text-align: left">
                                                        Rp.{{$vacancies->salary}}
                                                    </td>
                                                    <td colspan="1" style="text-align: left">
                                                        {{$vacancies->age}}
                                                    </td>
                                                    <td colspan="1" style="text-align: left">
                                                        {{$vacancies->working_hour}}
                                                    </td>
                                                    <td colspan="1" style="text-align: left">
                                                        {{$vacancies->total_applicant}}
                                                    </td>
                                            </tbody>
                                        </table>
                                    </div>


                                </div>
                            </div>
                        </div>

                        @if ($applyings->status == 'Interview schedule sent' || $applyings->status == 'Interview on progress')
                            <div class="row mb-2">
                                <div class="card-body">
                                    <div class="card-mb-3" style="width: 50%">
                                        <div class="form-group">
                                            <label for="when" class="text-dark font-weight-bold">When</label>
                                            <p class="card-text">
                                                {!!$applyings->interview_schedule!!}
                                            </p>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div class="card-mb-3" style="width: 50%">
                                        <div class="form-group">
                                            <label for="where" class="text-dark font-weight-bold">Where</label>
                                            <p class="card-text">
                                                {!!$applyings->interview_location!!}
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row mb-2">
                                <div class="card-body">
                                    <div class="card-mb-3" style="width: 100%">
                                        <div class="form-group">
                                            <label for="where" class="text-dark font-weight-bold">Notes</label>
                                            <p class="card-text">
                                                {!!$applyings->notes!!}
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif

                        <div class="row mb-2">
                            <div class="card-body">
                                <div class="timeline-steps aos-init aos-animate" data-aos="fade-up">
                                    <div class="timeline-step">
                                        <div class="timeline-content" data-toggle="popover" data-trigger="hover" data-placement="top" title=""  data-original-title="2003">
                                            <div class="inner-circle"></div>
                                            {{-- <p class="h6 mt-3 mb-1">2003</p> --}}
                                            <p class="h6 text-muted mb-0 mb-lg-0">Apply Job</p>
                                        </div>
                                    </div>
                                    <div class="timeline-step">
                                        <div class="timeline-content" data-toggle="popover" data-trigger="hover" data-placement="top" title="" data-original-title="2004">
                                            <div class="inner-circle"></div>
                                            {{-- <p class="h6 mt-3 mb-1">2004</p> --}}
                                            <p class="h6 text-muted mb-0 mb-lg-0">Waiting Review</p>
                                        </div>
                                    </div>
                                    <div class="timeline-step">
                                        <div class="timeline-content" data-toggle="popover" data-trigger="hover" data-placement="top" title=""  data-original-title="2005">
                                            <div class="inner-circle"></div>
                                            {{-- <p class="h6 mt-3 mb-1">2005</p> --}}
                                            <p class="h6 text-muted mb-0 mb-lg-0">Interview</p>
                                        </div>
                                    </div>
                                    <div class="timeline-step">
                                        <div class="timeline-content" data-toggle="popover" data-trigger="hover" data-placement="top" title=""  data-original-title="2010">
                                            <div class="inner-circle"></div>
                                            {{-- <p class="h6 mt-3 mb-1">2010</p> --}}
                                            <p class="h6 text-muted mb-0 mb-lg-0">Accepted Confirmation</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>


                        {{-- <input type="hidden" name="_method" value="{{ 'PUT' }}"> --}}
                        {{-- <input type="hidden" value="{{$vacancies->id}}" name="id"> --}}
                        @guest
                            {{-- <input type="submit" value="Apply" class="btn btn-primary"> --}}
                        @else
                            @if (Auth::user()->role == '1')
                                @if (Auth::user()->id == $applyings->applicant_id)
                                    @if ($applyings->status == 'Check by Company')
                                        <div class="row mb-2">
                                            <div class="card-body" style="text-align:right">
                                                <input type="submit" value="Finish" class="btn btn-primary" disabled>
                                            </div>
                                        </div>
                                    @elseif($applyings->status == 'Interview schedule sent')
                                        <div class="row mb-2">
                                            <div class="card-body" style="text-align:right">
                                                <input type="hidden" name='applying_id' value="{{$applyings->id}}">
                                                <input type="submit" value="Finish" class="btn btn-primary">
                                            </div>
                                        </div>
                                    @endif
                                @endif
                            @endif
                        @endguest
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
