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
                    <form action="{{action('VacancyController@update', $vacancies->id)}}" method="POST" enctype="multipart/form-data">
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
                                            <a href="/company/{{$company_info->id}}">
                                                {!!$company_info->name!!}
                                            </a>
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
                                                        @if (!$vacancies->salary == NULL)
                                                            Rp.{{$vacancies->salary}}
                                                        @else
                                                            Rp. -
                                                        @endif
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
                                    <div class="form-group">
                                        <label for="tag" class="text-dark font-weight-bold">Tag</label>
                                        <p class="text-primary font-weight-bold">
                                            @foreach ($vacancies->tag as $item)
                                                <a href='/search/tag?tag={{$item}}'>
                                                    #{{$item}}
                                                </a>
                                            @endforeach
                                        </p>
                                    </div>

                                    <div class="form-group">
                                        <label for="location" class="text-dark font-weight-bold">Location</label>
                                        <p class="card-text">
                                            {!!$vacancies->location!!}
                                        </p>
                                    </div>

                                    <div class="mapform" >

                                        <div id="map" style="height:400px; width: 100%;" class="my-3"></div>

                                        <script>
                                            let map;
                                            function initMap() {
                                                map = new google.maps.Map(document.getElementById("map"), {
                                                    center: { lat: {{$vacancies->latitude}}, lng: {{$vacancies->longitude}} },
                                                    zoom: 18,
                                                    scrollwheel: false,
                                                });

                                                const uluru = { lat: {{$vacancies->latitude}}, lng: {{$vacancies->longitude}} };
                                                let marker = new google.maps.Marker({
                                                    position: uluru,
                                                    map: map,
                                                    draggable: false
                                                });

                                                google.maps.event.addListener(marker,'position_changed',
                                                    function (){
                                                        let lat = marker.position.lat()
                                                        let lng = marker.position.lng()
                                                        $('#lat').val(lat)
                                                        $('#lng').val(lng)
                                                    })
                                            }
                                        </script>
                                        <script async defer src="https://maps.googleapis.com/maps/api/js?key={{ env('GOOGLE_MAP_KEY') }}&callback=initMap" type="text/javascript"></script>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <input type="hidden" name="_method" value="{{ 'PUT' }}">
                        {{-- <input type="hidden" value="{{$vacancies->id}}" name="id"> --}}
                        @guest
                            {{-- <input type="submit" value="Apply" class="btn btn-primary"> --}}
                        @else
                            @if (Auth::user()->role == '0' && $vacancies->status_open == 'Admin')
                                <div class="row mb-2">
                                    <div class="card-body" style="width: 100%; padding: 0px 0px 0px 20px">
                                        <label for="notes" class="text-dark font-weight-bold">Notes</label>
                                    </div>
                                    <div class="card-body" style="text-align:right; padding: 0px 20px 0px 20px">
                                        <textarea name="notes" class="form-control @error('notes') is-invalid @enderror" id="notes" rows="2" style="width:100%; height:100px;" >{{old('notes')}}</textarea>
                                        @error('notes')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                        <p></p>

                                        <button type="submit" name="action" class="btn btn-danger" value="Reject">Reject</button>
                                        <button type="submit" name="action" class="btn btn-primary" value="Approve">Approve</button>
                                    </div>
                                </div>
                            @endif

                            @if (Auth::user()->role == '1')
                                <div class="row mb-2">
                                    <div class="card-body" style="text-align:right">
                                        <input type="submit" value="Apply" class="btn btn-primary">
                                    </div>
                                </div>
                            @endif
                            @if (Auth::user()->role == '2')
                                @if (Auth::user()->id == $company_info->id)
                                    @if ($vacancies->status_open == 'Open')
                                    <div class="row mb-2">
                                        <div class="card-body" style="text-align:right">
                                            {{-- <input type="submit" value="Update" class="btn btn-primary"> --}}
                                            {{-- <a href="/vacancy/{{$vacancies->id}}/edit" class="btn btn-primary disabled">Update</a> --}}
                                        </div>
                                    </div>
                                    @elseif($vacancies->status_open == 'Rejected')
                                        <div class="row mb-2">
                                            <div class="card-body" style="width: 100%; padding: 0px 0px 0px 20px">
                                                <label for="notes" class="text-dark font-weight-bold">Notes</label>
                                                <p class="card-text">
                                                    {!!$vacancies->notes!!}
                                                </p>
                                            </div>
                                            <div class="card-body" style="text-align:right; padding: 0px 20px 0px 20px">
                                                {{-- <button type="submit" name="action" class="btn btn-danger" value="Delete">Delete</button> --}}
                                                <button type="button" class="open-ConfirmDelete btn btn-danger" data-toggle="modal" data-target="#checkoutmodel">
                                                    Delete
                                                </button>

                                                <a href="/vacancy/{{$vacancies->id}}/edit" class="btn btn-primary">Update</a>
                                                <button type="submit" name="action" class="btn btn-primary" value="SendToAdmin">Save</button>
                                            </div>
                                        </div>
                                    @elseif($vacancies->status_open == 'Admin')
                                        <div class="row mb-2">
                                            <div class="card-body" style="text-align:right">
                                                <input type="submit" value="Update" class="btn btn-primary" disabled>
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

{{-- pop up --}}
<div class="modal fade" id="checkoutmodel" role="dialog" aria-labelledby="checkoutmodel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-custom text-white">
                <h5 class="modal-title" id="exampleModalLongTitle">Confirmation Delete?</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                Are you sure you want delete this vacancy ?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <form action="{{action('VacancyController@update', $vacancies->id)}}" method="POST" enctype="multipart/form-data">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <input type="hidden" name="_method" value="{{ 'PUT' }}">
                    <button type="submit" name="action" class="btn btn-danger" value="Delete">Delete</button>
                </form>
            </div>
        </div>
    </div>
</div>

{{-- <script>
    $(document).on("click", ".open-ConfirmDelete", function () {
        var user_id = $(this).data('user_id');
        var vacancy_id = $(this).data('vacancy_id');
        $(".modal-footer #user_id").val( user_id );
        $(".modal-footer #vacancy_id").val( vacancy_id );
    });
</script> --}}

@endsection
