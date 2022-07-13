@extends('layouts.app')
@section('content')
<div class="container-fluid">
    @include('inc.messages')
        <div class="row justify-content-center">
            <div class="card w-75 mb-3" style="width: 20em; padding: 0%; background-color: #0FC2C0">
                <div class="row">
                    <div class="card-body " style="padding: 1%; margin-left: 2em;">
                        <h5 class="card-title m-2">Inbox</h5>
                    </div>
                </div>
            </div>
        </div>
        <div class="row justify-content-center">
            @if (empty($notifications[0]))
                <div class="card w-75 mb-3">
                    <div class="col-xl-10 col-lg-10">
                        <div class="card-body">
                            <h5 class="card-title">No Notifications</h5>
                        </div>
                    </div>
                </div>
            @else
                @foreach ($notifications as $notif)
                    <div class="card w-75 mb-3">
                        <div class="col-xl-10 col-lg-10">
                            <div class="card-body">
                                <h5 class="card-title text-dark font-weight-bold" style="margin: 0px 0px 0px 10px">{{$notif->subject}}</h5>
                                <p class="card-text" style="margin: 0px 0px 0px 10px">{{$notif->content}}</p>
                                <p class="card-text" style="margin: 0px 0px 0px 10px">{{date('d-M-Y',strtotime($notif->created_at))}}</p>
                            </div>
                        </div>
                    </div>
                @endforeach
            @endif


        </div>
        {{-- <div class="row justify-content-center">
            @if (empty($notifications[0]))
                <div class="card w-75 mb-3" style="width: 18rem;">
                    <div class="row">

                    </div>
                </div>
            @else
                @foreach ($notifications as $notif)
                    <div class="card w-75" style="width: 18rem;">
                        <div class="row justify-content-center">


                        </div>
                    </div>
                @endforeach
            @endif
        </div> --}}
</div>

@endsection
