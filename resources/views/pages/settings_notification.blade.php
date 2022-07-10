@extends('layouts.app')
@section('content')
{{-- <div class="container"> --}}
    <div class="container light-style flex-grow-1 container-p-y">
        <h4 class="font-weight-bold py-3 mb-4">
            Account settings
        </h4>
        @if (count($errors) == 0)
            @include('inc.messages')
        @endif
        <div class="card overflow-hidden">
            <div class="row no-gutters row-bordered row-border-light">
                <div class="col-md-3 pt-0">
                    <div class="list-group list-group-flush account-settings-links">
                        <a class="list-group-item list-group-item-action"
                            href="/accounts/password/change">Change password</a>
                        <a class="list-group-item list-group-item-action"
                            href="/accounts/location">Location</a>
                        <a class="list-group-item list-group-item-action active" data-toggle="list"
                            href="#account-notifications">Notifications</a>
                    </div>
                </div>
                <div class="col-md-9">
                    <div class="tab-content">
                        <div class="tab-pane fade active show" id="account-notifications">
                            <div class="card-body pb-2">
                                <form method="POST" action="{{ route('edit.notification') }}">
                                    @csrf
                                    <h6 class="mb-4">Activity</h6>
                                    <div class="form-group">
                                        <label class="switcher">
                                            @if ($user_settings->flag_email)
                                                <input type="checkbox" name= "email" checked class="switcher-input" >
                                            @else
                                                <input type="checkbox" name= "email" class="switcher-input" >
                                            @endif
                                            <span class="switcher-label">Email Notifications</span>
                                        </label>
                                    </div>
                                    <div class="form-group">
                                        <label class="switcher">
                                            @if ($user_settings->flag_notification)
                                                <input type="checkbox" name= "notification" checked class="switcher-input" >
                                            @else
                                                <input type="checkbox" name= "notification" class="switcher-input" >
                                            @endif
                                            <span class="switcher-label">Inbox Notifications</span>
                                        </label>
                                    </div>
                                    <div class="text-right mt-3">
                                        <button type="submit" class="btn btn-primary">Save changes</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
{{-- </div> --}}
@endsection
