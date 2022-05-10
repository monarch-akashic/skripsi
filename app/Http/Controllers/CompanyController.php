<?php

namespace App\Http\Controllers;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Company;
use Illuminate\Support\Facades\Hash;
use App\User;
use Illuminate\Foundation\Auth\RegistersUsers;

class CompanyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
            'logo' => 'image|nullable|max:1999',
            'company_name' => ['required', 'string', 'max:255'],
            'tagline' => ['required', 'string', 'max:255'],
            'background' => ['required', 'string', 'max:255'],
            'website_link' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'industry_type' => ['required'],
            'company_size' => ['required'],
            'company_type' => ['required'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],

        ]);

        if ($request->hasFile('logo')) {
            //get just file name
            $fileName = $request->title;
            //get just ext
            $extension = $request->file('logo')->getClientOriginalExtension();
            //filename to store
            $fileNameToStore = time().'_'.$fileName.'.'.$extension;
            //upload
            $path = $request->file('logo')->storeAs('public/img/logo', $fileNameToStore);
        }else{
            $fileNameToStore = 'no_file';
        }

        // $user = new User();
        // $user->role = '2';
        // $user->name = $request->input('company_name');
        // $user->email = $request->input('email');
        // $user->password = Hash::make($request->input('password'));
        // $user->created_at = Carbon::now();
        // $user->updated_at = Carbon::now();
        // $user->save();

        $user = User::Create([
            'role' => '2',
            'name' => $request['company_name'],
            'email' => $request['email'],
            'password' => Hash::make($request['password']),
            'phoneNo' => '0',
            'dob' => '9999-12-31',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

        $company = new Company();
        $company->user_id = $user->id;
        $company->tagline = $request->input('tagline');
        $company->industry_type = $request->input('industry_type');
        $company->company_type = $request->input('company_type');
        $company->company_size = $request->input('company_size');
        $company->logo = $fileNameToStore;
        $company->background = $request->input('background');
        $company->website_link = $request->input('website_link');
        $company->created_at = Carbon::now();
        $company->updated_at = Carbon::now();
        $company->save();

        \auth()->login($user, true);
        return redirect('/');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
