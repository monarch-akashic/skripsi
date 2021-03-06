<?php

namespace App\Http\Controllers;

use App\Applying;
use App\Portofolio;
use App\Category;
use DateTime;
use Illuminate\Foundation\Auth\User;
use Illuminate\Http\Request;
use App\Company;
use App\Notification;
use Carbon\Carbon;
use App\UserLocation;
use App\UserSetting;
use App\Vacancy;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;

use function PHPSTORM_META\type;

class PortofolioController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return redirect('/');

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $user_info = User::find(auth()->user()->id);
        $categories = Category::where('type','ED')->get();
        $experience_category = Category::where('type','EX')->get();
        $title = 'Create Profile';

        try {
            $location_user = UserLocation::where('user_id', auth()->user()->id)->first();
            if($location_user){
                $mylat = $location_user->latitude;
                $mylong = $location_user->longitude;
            }else{
                //default jakarta pusat
                $mylat = -6.186486;
                $mylong = 106.834091;
            }
        } catch (\Throwable $th) {
            $mylat = -6.186486;
            $mylong = 106.834091;
        }

        return view('portofolio.create')->with(['title' => $title, 'user_info' => $user_info, 'categories' => $categories, 'experience_category' => $experience_category, 'mylat' => $mylat, 'mylong' => $mylong]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // return $request;

        for ($i=0; $i < count($request->institute); $i++) {
            $education[$i] = [
                'institute' => $request->institute[$i],
                'year_start_institute' => $request->year_start_institute[$i],
                'year_end_institute' => $request->year_end_institute[$i],
                'institute_desc' => $request->institute_desc[$i]
            ];
        }
        for ($i=0; $i < count($request->experience); $i++) {
            $experience[$i] = [
                'experience' => $request->experience[$i],
                'year_start_experience' => $request->year_start_experience[$i],
                'year_end_experience' => $request->year_end_experience[$i],
                'experience_desc' => $request->experience_desc[$i]
            ];
        }


        // return $request->skill;

        $this->validate($request,[
            'profile_image' => 'image|nullable|max:1999',
            'full_name' => ['required', 'string', 'max:255'],
            'phoneNo' => ['required', 'string', 'max:20'],
            // 'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'dob' => ['required', 'date'],

            'portofolio_file' => 'mimetypes:application/pdf|nullable|max:1999',
            'curriculum_file' => 'mimetypes:application/pdf|nullable|max:1999',
            'location' => ['required'],
            // 'lat' => ['required'],
            // 'lng' => ['required'],

            'education.*.institute' => ['required'],
            'education.*year_start_institute' => ['required'],
            'education.*year_end_institute' => ['required'],
            'education.*institute_desc' => ['required'],

            'experience.*experience' => ['required'],
            'experience.*year_start_experience' => ['required'],
            'experience.*year_end_experience' => ['required'],
            'experience.*experience_desc' => ['required'],

            'skills.*skills' => ['required'],

        ]);

        if ($request->hasFile('profile_image')) {
            //getfilename with ext
            $fileNameWithExt3 = $request->file('profile_image')->getClientOriginalName();
            //get just file name
            $fileName3 = pathinfo($fileNameWithExt3, PATHINFO_FILENAME);
            //get just ext
            $extension3 = $request->file('profile_image')->getClientOriginalExtension();
            //filename to store
            $fileNameToStore3 = time().'_'.$fileName3.'.'.$extension3;
            //upload
            $path = $request->file('profile_image')->storeAs('public/img', $fileNameToStore3);
        }else{
            $fileNameToStore3 = 'user_dummy.jpg';
        }

        if ($request->hasFile('portofolio_file')) {
            //getfilename with ext
            $fileNameWithExt = $request->file('portofolio_file')->getClientOriginalName();
            //get just file name
            $fileName = pathinfo($fileNameWithExt, PATHINFO_FILENAME);
            //get just ext
            $extension = $request->file('portofolio_file')->getClientOriginalExtension();
            //filename to store
            $fileNameToStore = time().'_'.$fileName.'.'.$extension;
            //upload
            $path = $request->file('portofolio_file')->storeAs('public/files/portofolio', $fileNameToStore);
        }else{
            $fileNameToStore = 'no_file';
        }

        if ($request->hasFile('curriculum_file')) {
            //getfilename with ext
            $fileNameWithExt2 = $request->file('curriculum_file')->getClientOriginalName();
            //get just file name
            $fileName2 = pathinfo($fileNameWithExt2, PATHINFO_FILENAME);
            //get just ext
            $extension2 = $request->file('curriculum_file')->getClientOriginalExtension();
            //filename to store
            $fileNameToStore2 = time().'_'.$fileName2.'.'.$extension2;
            //upload
            $path = $request->file('curriculum_file')->storeAs('public/files/cv', $fileNameToStore2);
        }else{
            $fileNameToStore2 = 'no_file';
        }

        $user = User::find(auth()->user()->id);
        $user->name = $request->input('full_name');
        $user->phoneNo = $request->input('phoneNo');
        $user->dob = $request->input('dob');
        $user->save();

        $portofolio = new Portofolio();
        $portofolio->user_id = auth()->user()->id;
        $portofolio->profile_image = $fileNameToStore3;

        $portofolio->education = $education;
        $portofolio->experience = $experience;
        $portofolio->skills = $request->skill;

        $portofolio->location = $request->location;
        $portofolio->latitude = $request->lat;
        $portofolio->longitude = $request->lng;

        $portofolio->portofolio_file = $fileNameToStore;
        $portofolio->cv_file = $fileNameToStore2;
        $portofolio->created_at = Carbon::now();;
        $portofolio->save();

        return redirect('/portofolio/' .$user->id)->with('success', 'Profle Created');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = User::find($id);
        $portofolio = Portofolio::where('user_id', $id)->first();

        $source = $user->dob;
        $date = new DateTime($source);
        $user->dob = $date->format('d F Y');

        if (empty($portofolio)) {
            abort(404);
        }else{
            // return $portofolio;
            return view('portofolio.show')->with(['title' => 'My Profile', 'portofolio' => $portofolio, 'user' => $user]);
        }

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::find($id);
        $portofolio = Portofolio::where('user_id', $id)->first();
        $categories = Category::where('type','ED')->get();
        $experience_category = Category::where('type','EX')->get();

        // $source = $user->dob;
        // $date = new DateTime($source);
        // $user->dob = $date->format('d F Y');

        if (empty($portofolio)) {
            abort(404);
        }else{
            // return $experience_category;
            return view('portofolio.edit')->with(['title' => 'Edit Profile', 'portofolio' => $portofolio, 'user_info' => $user, 'categories' => $categories, 'experience_category' => $experience_category]);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // return $request;

        for ($i=0; $i < count($request->institute); $i++) {
            $education[$i] = [
                'institute' => $request->institute[$i],
                'year_start_institute' => $request->year_start_institute[$i],
                'year_end_institute' => $request->year_end_institute[$i],
                'institute_desc' => $request->institute_desc[$i]
            ];
        }
        for ($i=0; $i < count($request->experience); $i++) {
            $experience[$i] = [
                'experience' => $request->experience[$i],
                'year_start_experience' => $request->year_start_experience[$i],
                'year_end_experience' => $request->year_end_experience[$i],
                'experience_desc' => $request->experience_desc[$i]
            ];
        }


        // return $request->skill;

        $this->validate($request,[
            'profile_image' => 'image|nullable|max:1999',
            'full_name' => ['required', 'string', 'max:255'],
            'phoneNo' => ['required', 'string', 'max:20'],
            // 'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'dob' => ['required', 'date'],
            'location' => ['required'],

            'portofolio_file' => 'mimetypes:application/pdf|nullable|max:1999',
            'curriculum_file' => 'mimetypes:application/pdf|nullable|max:1999',
            'education.*institute' => ['required'],
            'education.*year_start_institute' => ['required'],
            'education.*year_end_institute' => ['required'],
            'education.*institute_desc' => ['required'],
            'experience.*experience' => ['required'],
            'experience.*year_start_experience' => ['required'],
            'experience.*year_end_experience' => ['required'],
            'experience.*experience_desc' => ['required'],
            'skills.*skills' => ['required'],

        ]);

        if ($request->hasFile('profile_image')) {
            //getfilename with ext
            $fileNameWithExt3 = $request->file('profile_image')->getClientOriginalName();
            //get just file name
            $fileName3 = pathinfo($fileNameWithExt3, PATHINFO_FILENAME);
            //get just ext
            $extension3 = $request->file('profile_image')->getClientOriginalExtension();
            //filename to store
            $fileNameToStore3 = time().'_'.$fileName3.'.'.$extension3;
            //upload
            $path = $request->file('profile_image')->storeAs('public/img', $fileNameToStore3);
        }

        if ($request->hasFile('portofolio_file')) {
            //getfilename with ext
            $fileNameWithExt = $request->file('portofolio_file')->getClientOriginalName();
            //get just file name
            $fileName = pathinfo($fileNameWithExt, PATHINFO_FILENAME);
            //get just ext
            $extension = $request->file('portofolio_file')->getClientOriginalExtension();
            //filename to store
            $fileNameToStore = time().'_'.$fileName.'.'.$extension;
            //upload
            $path = $request->file('portofolio_file')->storeAs('public/files/portofolio', $fileNameToStore);
        }

        if ($request->hasFile('curriculum_file')) {
            //getfilename with ext
            $fileNameWithExt2 = $request->file('curriculum_file')->getClientOriginalName();
            //get just file name
            $fileName2 = pathinfo($fileNameWithExt2, PATHINFO_FILENAME);
            //get just ext
            $extension2 = $request->file('curriculum_file')->getClientOriginalExtension();
            //filename to store
            $fileNameToStore2 = time().'_'.$fileName2.'.'.$extension2;
            //upload
            $path = $request->file('curriculum_file')->storeAs('public/files/cv', $fileNameToStore2);
        }

        $user = User::find(auth()->user()->id);
        $user->name = $request->input('full_name');
        $user->phoneNo = $request->input('phoneNo');
        $user->dob = $request->input('dob');
        $user->save();

        $portofolio = Portofolio::find($id);
        $portofolio->user_id = auth()->user()->id;
        // $portofolio->profile_image = $fileNameToStore3;
        if ($request->hasFile('profile_image')) {
            if ($portofolio->profile_image != 'user_dummy.jpg') {
                Storage::delete('public/img/'.$portofolio->profile_image);
            }
            $portofolio->profile_image = $fileNameToStore3;
        }
        $portofolio->education = $education;
        $portofolio->experience = $experience;
        $portofolio->skills = $request->skill;

        $portofolio->location = $request->location;
        $portofolio->latitude = $request->lat;
        $portofolio->longitude = $request->lng;

        // $portofolio->portofolio_file = $fileNameToStore;
        if ($request->hasFile('portofolio_file')) {
            $portofolio->portofolio_file = $fileNameToStore;
        }

        // $portofolio->cv_file = $fileNameToStore2;
        if ($request->hasFile('curriculum_file')) {
            $portofolio->cv_file = $fileNameToStore2;
        }

        $portofolio->updated_at = Carbon::now();;
        $portofolio->save();

        return redirect('/portofolio/' .$user->id)->with('success', 'Profle Updated!!!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }


    public function checkPortofolio($vacancy_id, $user_id)
    {
        $user = User::find($user_id);
        $portofolio = Portofolio::where('user_id', $user_id)->first();
        $applyings = Applying::where('vacancy_id', $vacancy_id)->where('applicant_id', $user_id)->first();
        $company_info = Company::where('id', $applyings->company_id)->first();
        // return $company_info;

        $source = $user->dob;
        $date = new DateTime($source);
        $user->dob = $date->format('d F Y');

        if (empty($portofolio)) {
            abort(404);
        }else{
            // return $portofolio;
            return view('company.applicant.portofolio')->with(['title' => 'Applicant Profile', 'portofolio' => $portofolio, 'user' => $user, 'vacancy_id' => $vacancy_id, 'company_info' => $company_info, 'applyings' => $applyings]);
        }
    }

    public function sendInterview($vacancy_id, $user_id)
    {
        // $applicant = Portofolio::where('user_id', $user_id)->get();
        $applicant = Portofolio::where('user_id', $user_id)->first();
        // return $applicant;
        $applicant_id = User::find($applicant->user_id);
        return view('company.applicant.interview')->with(['user_id' => $applicant_id, 'vacancy_id' => $vacancy_id]);
    }

    public function saveInterview(Request $request)
    {
        $applicant = User::where('id',$request->user_id)->first();
        $vacancy = Vacancy::where('id', $request->vacancy_id)->first();

        // return $applicant;
        $this->validate($request,[
            'interview_time' => ['required', 'string', 'max:255'],
            'interview_location' => ['required', 'string', 'max:255'],
            'notes' => ['required', 'string', 'min:10' ,'max:255'],
        ]);

        $user_settings = UserSetting::where('user_id', $request->user_id)->first();

        if (!$user_settings) {
            // return "not exist";
            $user_settings = new UserSetting();
            $user_settings->user_id = $request->user_id;
            $user_settings->flag_email = "on";
            $user_settings->flag_notification = "on";
            $user_settings->created_at = Carbon::now();
            $user_settings->updated_at = Carbon::now();
            $user_settings->save();
        }

        // return $user_settings;

        if ($user_settings->flag_email == "on") {
            Mail::to($applicant->email)->send(new \App\Mail\InterviewSchedule($request, $vacancy));
        }

        if ($user_settings->flag_notification == "on") {
            $notification = new Notification();
            $notification->user_id = $request->user_id;
            $notification->subject = 'Interview Scheduled';
            $notification->content = 'Your job apply for '.$vacancy->job_name.' has been scheduled, please check your applied jobs';
            $notification->created_at = Carbon::now();
            $notification->updated_at = Carbon::now();
            $notification->save();
        }

        $applyings = Applying::where('vacancy_id', $request->vacancy_id)->where('applicant_id', $request->user_id)->first();

        $applyings->interview_schedule = $request->interview_time;
        $applyings->interview_location = $request->interview_location;
        $applyings->notes = $request->notes;
        // $applyings->status = 'Interview on progress';
        $applyings->status = 'Interview schedule sent';
        $applyings->save();
        // return $applyings;

        return redirect('/vacancy/' .$applyings->vacancy_id. '/list')->with('success', 'Interview Invitation Sent');


    }
    public function processInterview(Request $request)
    {
        #list status
        ##Check by Company
        ##Interview schedule sent
        ##Interview on progress
        ##Rejected
        ##Decline
        ##Accepted

        // return $request;
        $applyings = Applying::where('vacancy_id', $request->vacancy_id)->where('applicant_id', $request->user_id)->first();

            switch ($request->input('action')) {
                case 'Reject':
                    $applyings->status = 'Rejected';
                    $applyings->save();

                    $vacancy = Vacancy::find($request->vacancy_id);

                    $notification = new Notification();
                    $notification->user_id = $request->user_id;
                    $notification->subject = 'Your applied job for '.$vacancy->job_name.' was rejected.';
                    $notification->content = 'Applied job for '.$vacancy->job_name.' was rejected.';
                    $notification->created_at = Carbon::now();
                    $notification->updated_at = Carbon::now();
                    $notification->save();

                    return redirect('/vacancy/' .$applyings->vacancy_id. '/list')->with('success', 'Interview Applicant Rejected');

                case 'Accept':
                    $applyings->status = 'Accepted';
                    $applyings->save();

                    $vacancy = Vacancy::find($request->vacancy_id);

                    $notification = new Notification();
                    $notification->user_id = $request->user_id;
                    $notification->subject = 'Your applied job for '.$vacancy->job_name.' was accepted.';
                    $notification->content = 'Applied job for '.$vacancy->job_name.' was accepted, please contact the job offerer for further information.';
                    $notification->created_at = Carbon::now();
                    $notification->updated_at = Carbon::now();
                    $notification->save();

                    return redirect('/vacancy/' .$applyings->vacancy_id. '/list')->with('success', 'Interview Applicant Accepted');

                case 'Decline':
                    $applyings->status = 'Decline';
                    $applyings->save();

                    $vacancy = Vacancy::find($request->vacancy_id);

                    $notification = new Notification();
                    $notification->user_id = $request->user_id;
                    $notification->subject = 'Your applied job for '.$vacancy->job_name.' was declined.';
                    $notification->content = 'Applied job for '.$vacancy->job_name.' was declined by the job offerer.';
                    $notification->created_at = Carbon::now();
                    $notification->updated_at = Carbon::now();
                    $notification->save();

                    return redirect('/vacancy/' .$applyings->vacancy_id. '/list')->with('success', 'Decline Message Sent');

                // case 'Finish':
                //     $applyings->status = 'Finish';
                //     $applyings->save();
                //     return redirect('/vacancy/' .$applyings->vacancy_id. '/list')->with('success', 'Vacancy Finish');
            }
    }

    // public function finishInterview(Request $request)
    // {
    //     // return $request;
    //     $applyings = Applying::where('vacancy_id', $request->vacancy_id)->where('applicant_id', $request->user_id)->first();

    //     $applyings->status = 'Finish';
    //     $applyings->save();
    //     // return $applyings;

    //     return redirect('/vacancy/' .$applyings->vacancy_id. '/list')->with('success', 'Vacancy Finish');


    // }
}
