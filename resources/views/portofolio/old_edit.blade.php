@extends('layouts.app')
@section('content')
<div class="container">
    @include('inc.messages')
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="sub-heading">My Profile</h4>
                    <form action="{{ action('PortofolioController@update' , $user->id) }}" method="POST" enctype="multipart/form-data">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <div class="row mb-2">
                            <div class="card-mb-3" style="width: 100%">
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
                                        <input type="text" name="full_name" class="form-control" placeholder="Full Name"
                                            value="{{ $user->name }}">
                                    </div>

                                    <div class="form-group">
                                        <label for="phoneNo">Phone Number</label>
                                        <input type="text" name="phoneNo" class="form-control"
                                            placeholder="Phone Number" value="{{ $user->phoneNo }}">
                                    </div>

                                    <div class="form-group">
                                        <label for="email">Email</label>
                                        <input type="email" name="email" class="form-control" placeholder="Email"
                                            value="{{ $user->email }}" disabled>
                                    </div>

                                    <div class="form-group">
                                        <label for="dob">Date of Birth</label>
                                        <input type="date" name="dob" class="form-control" placeholder="Date of Birth"
                                            value="{{ $user->dob }}">
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

                                <div class="card-body">
                                    <div class="form-group">
                                        <label for="education">Education</label>
                                        <button class="btn btn-sm btn-primary add_more_institute">Add row</button>
                                        {{-- <input type="text" name="education" class="form-control" placeholder="Education" value="{{ old('education') }}"> --}}
                                        <table class="table table-sm table-borderless" id="show_institute">
                                            {{-- <thead class="bg-custom text-light">
                                                <tr>
                                                    <th scope="col" class="align-middle" width="10%">Institute</th>
                                                    <th scope="col" class="align-middle" width="40%">Year</th>
                                                    <th scope="col" class="align-middle" width="40%">Description</th>
                                                    <th scope="col" class="align-middle" width="10%">
                                                        <button class="btn btn-sm btn-primary add_more">Add row</button>
                                                    </th>
                                                </tr>
                                            </thead> --}}
                                            <tbody>
                                                <tr>
                                                    <td colspan="1" style="text-align: center" class="align-middle">
                                                        <div class="input-group mb-3">
                                                            <select name="institute[]" id="inputGroupSelect01" class="custom-select">
                                                                <option value="one"
                                                                    {{ old('institute') == 'one' ? 'selected' : '' }}>
                                                                    One</option>
                                                                <option value="two"
                                                                    {{ old('institute') == 'two' ? 'selected' : '' }}>
                                                                    Two</option>
                                                                <option value="three"
                                                                    {{ old('institute') == 'three' ? 'selected' : '' }}>
                                                                    Three</option>
                                                            </select>
                                                        </div>
                                                    </td>
                                                    <td colspan="1" style="text-align: center" class="form-inline">
                                                        <input type="text" name="year_start_institute[]" class="form-control" placeholder="Year"
                                                            value="{{ old('year_start_institute') }}">
                                                        -
                                                        <input type="text" name="year_end_institute[]" class="form-control" placeholder="Year"
                                                            value="{{ old('year_end_institute') }}">
                                                    </td>
                                                    <td colspan="1" style="text-align: center">
                                                        <input type="text" name="institute_desc[]" class="form-control"
                                                            placeholder="Institute Name"
                                                            value="{{ old('institute_desc') }}">
                                                    </td>
                                                    <td colspan="1" style="text-align: center">
                                                        <button class="btn btn-sm btn-danger remove_more_institute">Remove</button>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="form-group">
                                        <label for="experience">Experience</label>
                                        {{-- <input type="text" name="experience" class="form-control" placeholder="Experience" value="{{ old('experience') }}"> --}}
                                        <button class="btn btn-sm btn-primary add_more_experience">Add row</button>
                                        {{-- <input type="text" name="education" class="form-control" placeholder="Education" value="{{ old('education') }}"> --}}
                                        <table class="table table-sm table-borderless" id="show_experience">
                                            {{-- <thead class="bg-custom text-light">
                                                <tr>
                                                    <th scope="col" class="align-middle" width="10%">Institute</th>
                                                    <th scope="col" class="align-middle" width="40%">Year</th>
                                                    <th scope="col" class="align-middle" width="40%">Description</th>
                                                    <th scope="col" class="align-middle" width="10%">
                                                        <button class="btn btn-sm btn-primary add_more">Add row</button>
                                                    </th>
                                                </tr>
                                            </thead> --}}
                                            <tbody>
                                                <tr>
                                                    <td colspan="1" style="text-align: center" class="align-middle">
                                                        <div class="input-group mb-3">
                                                            <select name="experience[]" id="inputGroupSelect01" class="custom-select">
                                                                <option value="one"
                                                                    {{ old('experience') == 'one' ? 'selected' : '' }}>
                                                                    One</option>
                                                                <option value="two"
                                                                    {{ old('experience') == 'two' ? 'selected' : '' }}>
                                                                    Two</option>
                                                                <option value="three"
                                                                    {{ old('experience') == 'three' ? 'selected' : '' }}>
                                                                    Three</option>
                                                            </select>
                                                        </div>
                                                    </td>
                                                    <td colspan="1" style="text-align: center" class="form-inline">
                                                        <input type="text" name="year_start_experience[]" class="form-control" placeholder="Year"
                                                            value="{{ old('year_start_experience') }}">
                                                        -
                                                        <input type="text" name="year_end_experience[]" class="form-control" placeholder="Year"
                                                            value="{{ old('year_end_experience') }}">
                                                    </td>
                                                    <td colspan="1" style="text-align: center">
                                                        <input type="text" name="experience_desc[]" class="form-control"
                                                            placeholder="Experience"
                                                            value="{{ old('experience_desc') }}">
                                                    </td>
                                                    <td colspan="1" style="text-align: center">
                                                        <button class="btn btn-sm btn-danger remove_more_experience">Remove</button>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="form-group">
                                        <label for="skills">Skills</label>
                                        <textarea name="skills" id="article-ckeditor" rows="5" class="form-control"
                                            placeholder="Description">{{ old('skills') }}</textarea>
                                    </div>
                                    <input type="hidden" name="_method" value="{{ 'PUT' }}">
                                    <input type="submit" value="Submit" class="btn btn-primary" id="update_btn" >
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script>
    $(document).ready(function () {
        $(".add_more_institute").click(function (e) {
            e.preventDefault();
            $("#show_institute").prepend(`
            <tr>
                <td colspan="1" style="text-align: center" class="align-middle">
                    <div class="input-group mb-3">
                        <select name="institute[]" id="inputGroupSelect01" class="custom-select">
                                <option value="one" {{ old('institute') == 'one' ? 'selected' : '' }}>One</option>
                                <option value="two" {{ old('institute') == 'two' ? 'selected' : '' }}>Two</option>
                                <option value="three" {{ old('institute') == 'three' ? 'selected' : '' }}>Three</option>
                        </select>
                    </div>
                </td>
                <td colspan="1" style="text-align: center" class="form-inline">
                    <input type="text" name="year_start_institute[]" class="form-control" placeholder="Year" value="{{ old('year_start_institute') }}">
                    -
                    <input type="text" name="year_end_institute[]" class="form-control" placeholder="Year" value="{{ old('year_end_institute') }}">
                </td>
                <td colspan="1" style="text-align: center">
                    <input type="text" name="institute_desc[]" class="form-control" placeholder="Institute Name" value="{{ old('institute_desc') }}">
                </td>
                <td colspan="1" style="text-align: center" >
                    <button class="btn btn-sm btn-danger remove_more_institute">Remove</button>
                </td>
            </tr>
            `)
        });
        $(document).on('click', '.remove_more_institute', function (e) {
            e.preventDefault();
            let row_item = $(this).parent().parent();
            $(row_item).remove();

        });
    });

</script>
<script>
    $(document).ready(function () {
        $(".add_more_experience").click(function (e) {
            e.preventDefault();
            $("#show_experience").prepend(`
            <tr>
                <td colspan="1" style="text-align: center" class="align-middle">
                    <div class="input-group mb-3">
                        <select name="experience[]" id="inputGroupSelect01" class="custom-select">
                                <option value="one" {{ old('experience') == 'one' ? 'selected' : '' }}>One</option>
                                <option value="two" {{ old('experience') == 'two' ? 'selected' : '' }}>Two</option>
                                <option value="three" {{ old('experience') == 'three' ? 'selected' : '' }}>Three</option>
                        </select>
                    </div>
                </td>
                <td colspan="1" style="text-align: center" class="form-inline">
                    <input type="text" name="year_start_experience[]" class="form-control" placeholder="Year" value="{{ old('year_start_experience') }}">
                    -
                    <input type="text" name="year_end_experience[]" class="form-control" placeholder="Year" value="{{ old('year_end_experience') }}">
                </td>
                <td colspan="1" style="text-align: center">
                    <input type="text" name="experience_desc[]" class="form-control" placeholder="Experience" value="{{ old('experience_desc') }}">
                </td>
                <td colspan="1" style="text-align: center" >
                    <button class="btn btn-sm btn-danger remove_more_experience">Remove</button>
                </td>
            </tr>
            `)
        });
        $(document).on('click', '.remove_more_experience', function (e) {
            e.preventDefault();
            let row_item = $(this).parent().parent();
            $(row_item).remove();

        });
    });

</script>
@endsection
