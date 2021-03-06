@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-body">
                    <h4 class="sub-heading">Login to your account</h3>

                    <a href="/register/applicant" class="btn btn-primary btn-lg btn-block p-4">
                        Applicant
                    </a>
                    <a href="/register/company"class="btn btn-primary btn-lg btn-block p-4">
                        Job Offerer
                    </a>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card">

                <div class="card-body">
                    <div style="font-weight: bold; font-size: 40px; color: #0FC2C0">
                        Find Your
                        Side Job
                        with
                    </div>
                    <div class="form-group m-0">
                        <img src="/storage/assets/sidejobsitewithlogo_warna.png" style="width: 100%" alt="">
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
