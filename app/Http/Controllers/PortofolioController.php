<?php

namespace App\Http\Controllers;

use App\Applying;
use App\Portofolio;
use App\Category;
use DateTime;
use Illuminate\Foundation\Auth\User;
use Illuminate\Http\Request;
use Carbon\Carbon;

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
        $title = 'Create Profile';
        return view('portofolio.create')->with(['title' => $title, 'user_info' => $user_info, 'categories' => $categories]);
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

        return redirect('/portofolio/' .$user->id)->with('success', 'Profle Updated');
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

        $portofolio = Portofolio::find($id);
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
        $portofolio = Portofolio::where('user_id', $user_id)->get();

        $source = $user->dob;
        $date = new DateTime($source);
        $user->dob = $date->format('d F Y');

        if (empty($portofolio)) {
            abort(404);
        }else{
            // return $portofolio;
            return view('company.applicant.portofolio')->with(['title' => 'My Profile', 'portofolio' => $portofolio, 'user' => $user, 'vacancy_id' => $vacancy_id]);
        }
    }

    public function sendInterview($vacancy_id, $user_id)
    {
        // $applicant = Portofolio::where('user_id', $user_id)->get();
        $applicant = Portofolio::find($user_id);
        $applicant_id = User::find($applicant->user_id);
        // return $applicant_id;
        return view('company.applicant.interview')->with(['user_id' => $applicant_id, 'vacancy_id' => $vacancy_id]);
    }

    public function saveInterview(Request $request)
    {
        // return $request;
        $this->validate($request,[
            'interview_time' => ['required', 'string', 'max:255'],
            'interview_location' => ['required', 'string', 'max:255'],
            'notes' => ['required', 'string', 'max:20'],
        ]);

        $applicant = User::find($request->user_id);
        $applyings = Applying::where('vacancy_id', $request->vacancy_id)->where('applicant_id', $request->user_id)->first();

        $applyings->interview_schedule = $request->interview_time;
        $applyings->interview_location = $request->interview_location;
        $applyings->status = 'Sent to Applicant';
        $applyings->save();
        // return $applyings;

        return redirect('/vacancy/' .$applyings->vacancy_id. '/list')->with('success', 'Invitation Sent');


    }
}
