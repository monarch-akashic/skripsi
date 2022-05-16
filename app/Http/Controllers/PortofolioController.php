<?php

namespace App\Http\Controllers;

use App\Portofolio;
use DateTime;
use Illuminate\Foundation\Auth\User;
use Illuminate\Http\Request;
use Carbon\Carbon;

class PortofolioController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $user_info = User::find(auth()->user()->id);
        $title = 'Profile';
        return view('portofolio.create')->with(['title' => $title, 'user_info' => $user_info]);
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
        $this->validate($request,[
            'profile_image' => 'image|nullable|max:1999',
            'full_name' => ['required', 'string', 'max:255'],
            'phoneNo' => ['required', 'string', 'max:20'],
            // 'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'dob' => ['required', 'date'],

            'portofolio_file' => 'mimetypes:application/pdf|nullable|max:1999',
            'curriculum_file' => 'mimetypes:application/pdf|nullable|max:1999',
            'education' => ['required', 'min:20'],
            'experience' => ['required', 'min:20'],
            'skills' => ['required', 'min:20'],

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
        $portofolio->education = $request->input('education');
        $portofolio->experience = $request->input('experience');
        $portofolio->skills = $request->input('skills');
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
        $portofolio = Portofolio::where('user_id', $id)->get();

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
        //
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
        //
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
}
