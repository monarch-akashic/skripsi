@extends('layouts.app')
@section('content')
<div class="container">
    @include('inc.messages')
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="sub-heading">Your Profile</h3>
                    <form action="{{action('PortofolioController@store')}}" method="POST" enctype="multipart/form-data">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <div class="row mb-2">
                            <div class="card-mb-3" style="width: 50%">
                                <div class="card-body">
                                    <div class="form-group">
                                        <label for="profile_image">Profile Picture :</label>
                                        <div class="custom-file">
                                            <input type="file" name="profile_image" class="custom-file-input">
                                            <label class="custom-file-label" for="customFile">Choose file</label>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="full_name">Full Name</label>
                                        <input type="text" name="full_name" class="form-control" placeholder="Full Name" value="{{$user_info->name}}">
                                    </div>

                                    <div class="form-group">
                                        <label for="phoneNo">Phone Number</label>
                                        <input type="text" name="phoneNo" class="form-control" placeholder="Phone Number" value="{{$user_info->phoneNo}}">
                                    </div>

                                    <div class="form-group">
                                        <label for="email">Email</label>
                                        <input type="email" name="email" class="form-control" placeholder="Email" value="{{$user_info->email}}" disabled>
                                    </div>

                                    <div class="form-group">
                                        <label for="dob">Date of Birth</label>
                                        <input type="date" name="dob" class="form-control" placeholder="Date of Birth" value="{{$user_info->dob}}">
                                    </div>

                                    <div class="form-group">
                                        <label for="portofolio_file">Portofolio :</label>
                                        <div class="custom-file">
                                            <input type="file" name="portofolio_file" class="custom-file-input">
                                            <label class="custom-file-label" for="customFile">Choose file</label>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="curriculum_file">Curriculum Vitae :</label>
                                        <div class="custom-file">
                                            <input type="file" name="curriculum_file" class="custom-file-input">
                                            <label class="custom-file-label" for="customFile">Choose file</label>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="card-mb-3" style="width: 50%">
                                <div class="card-body">
                                    <div class="form-group">
                                        <label for="education">Education</label>
                                        <input type="text" name="education" class="form-control" placeholder="Education" value="{{old('education')}}">
                                    </div>
                                    <div class="form-group">
                                        <label for="experience">Experience</label>
                                        <input type="text" name="experience" class="form-control" placeholder="Experience" value="{{old('experience')}}">
                                    </div>
                                    <div class="form-group">
                                        <label for="skills">Skills</label>
                                        <textarea name="skills" id="article-ckeditor" rows="5" class="form-control" placeholder="Description">{{old('skills')}}</textarea>
                                    </div>
                                    <input type="submit" value="Submit" class="btn btn-primary">
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
