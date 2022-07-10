<?php

namespace App\Http\Controllers;

use App\Applying;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Company;
use Illuminate\Support\Facades\Hash;
use App\User;
use App\Verifying;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Storage;
use App\Category;
use App\Vacancy;
use App\UserLocation;
use ArielMejiaDev\LarapexCharts\Facades\LarapexChart;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\DB;
use PhpParser\Node\Stmt\Foreach_;

class CompanyController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth', ['except' => ['register']]);
    }
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
        $user_info = User::find(auth()->user()->id);
        $it_category = Category::where('type','IT')->get();
        $is_category = Category::where('type','IS')->get();
        // return $it_category;
        return view('company.create')->with(['title' => 'Create Profile', 'user_info' => $user_info, 'it_category' => $it_category,  'is_category' => $is_category]);
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
            // 'logo' => 'require|image|nullable|max:1999',
            'logo' => ['required', 'image', 'nullable', 'max:1999'],
            'company_name' => ['required', 'string', 'min:5', 'max:255'],
            'tagline' => ['required', 'string','min:10', 'max:255'],
            'description' => ['required', 'string', 'max:500'],
            'background' => ['required', 'string','min:10','max:500'],
            'website_link' => ['nullable', 'max:255'],
            // 'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'industry_type' => ['required'],
            'company_size' => ['required'],
            // 'company_type' => ['required'],
            // 'password' => ['required', 'string', 'min:8', 'confirmed'],

        ]);

        if ($request->hasFile('logo')) {
            //get just file name
            $fileName = $request->company_name;
            //get just ext
            $extension = $request->file('logo')->getClientOriginalExtension();
            //filename to store
            $fileNameToStore = time().'_'.$fileName.'.'.$extension;
            //upload
            $path = $request->file('logo')->storeAs('public/img/company', $fileNameToStore);
        }else{
            $fileNameToStore = 'default.jpg';
        }

        $user_id = auth()->user()->id;
        $user = User::find($user_id);
        $user->name = $request->input('company_name');
        $user->save();

        $company = new Company();
        $company->user_id = $user_id;
        $company->tagline = $request->input('tagline');
        $company->description = $request->input('description');
        $company->industry_type = $request->input('industry_type');
        $company->company_size = $request->input('company_size');
        // $company->company_type = $request->input('company_type');
        $company->logo = $fileNameToStore;
        $company->background = $request->input('background');
        $company->website_link = $request->input('website_link');
        $company->created_at = Carbon::now();
        $company->updated_at = Carbon::now();
        $company->save();

        return redirect('/company/'.$user_id)->with('success', 'Profile Created');

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
        $company = Company::where('user_id', $id)->get();

        if (empty($company)) {
            abort(404);
        }else{
            return view('company.show')->with(['title' => 'Company Profile', 'company' => $company, 'user' => $user]);
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

        $user_info = User::find($id);
        $company_info = Company::where('user_id', $id)->get();

        if($company_info[0]->user_id != auth()->user()->id){
            return redirect('/company/'.$id)->with('error', 'Unauthorized Page');
        }

        $it_category = Category::where('type','IT')->get();
        $is_category = Category::where('type','IS')->get();

        if (empty($company_info)) {
            abort(404);
        }else{
            return view('company.edit')->with(['title' => 'Company Profile', 'company_info' => $company_info, 'user_info' => $user_info, 'it_category' => $it_category,  'is_category' => $is_category]);
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

        $this->validate($request,[
            'logo' => 'image|nullable|max:1999',
            'company_name' => ['required', 'string', 'max:255'],
            'tagline' => ['required', 'string', 'max:255'],
            'description' => ['required', 'string', 'max:500'],
            'background' => ['required', 'string', 'max:500'],
            'website_link' => ['string', 'max:255'],
            'industry_type' => ['required'],
            'company_size' => ['required'],

        ]);

        if ($request->hasFile('logo')) {
            //get just file name
            $fileName = $request->title;
            //get just ext
            $extension = $request->file('logo')->getClientOriginalExtension();
            //filename to store
            $fileNameToStore = time().'_'.$fileName.'.'.$extension;
            //upload
            $path = $request->file('logo')->storeAs('public/img/company/', $fileNameToStore);
        }

        $user = User::find($id);
        $user->name = $request->input('company_name');
        $user->save();

        $company = Company::where('user_id', $id)->first();
        // return $company;

        if ($request->hasFile('logo')) {
            if ($company->logo != 'user_dummy.jpg') {
                Storage::delete('public/img/company/'.$company->logo);
            }
            $company->logo = $fileNameToStore;
        }

        $company->tagline = $request->input('tagline');
        $company->description = $request->input('description');
        $company->industry_type = $request->input('industry_type');
        $company->company_size = $request->input('company_size');
        // $company->company_type = $request->input('company_type');
        // $company->logo = $fileNameToStore;
        $company->background = $request->input('background');
        $company->website_link = $request->input('website_link');
        $company->updated_at = Carbon::now();
        $company->save();

        return redirect('/company/'.$id)->with('success', 'Profile Updated');
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

    public function dashboard()
    {
        if (auth()->user()->role == '1') {
            return redirect('/');
        }

        $company_id = Company::where('user_id', auth()->user()->id)->first();

        if (empty($company_id)) {
            return redirect('/company/create')->with('error','Please finish your company profile');
        }

        $to = Carbon::now();
        $from =Carbon::now()->subDays(7);

        $data = DB::table('applyings')
        ->select(DB::raw('DATE(created_at) as date'), DB::raw('count(*) as total'))
        ->groupBy('date')
        ->whereBetween('created_at', [$from, $to])
        ->where('company_id', $company_id->id)
        ->get();

        $dateto = Carbon::now()->format('l d M Y');
        $datefrom =Carbon::now()->subDays(6)->format('l d M Y');


        $total_applicant = new Collection();
        $date = new Collection();

        foreach ($data as $key) {
            $total_applicant->push($key->total);
            $date->push(Carbon::parse($key->date)->format('l d M Y'));
        }
        // return $total_applicant;

        $chartArea = LarapexChart::lineChart()
        ->setTitle('Applicant from this past week')
        ->setSubtitle($datefrom. ' to '. $dateto)
        ->addData('Total Applicant', $total_applicant->all())
        ->setXAxis($date->all());

        $data2 = DB::table('applyings')
        ->join('vacancies','applyings.vacancy_id', '=','vacancies.id')
        ->select('vacancies.job_name', DB::raw('count(*) as total'))
        ->groupBy('vacancies.job_name')
        ->where('applyings.company_id', $company_id->id)
        ->get();

        $total_applicant_pie = new Collection();
        $job_name = new Collection();

        foreach ($data2 as $key) {
            $total_applicant_pie->push($key->total);
            $job_name->push($key->job_name);
        }

        $chartPie = LarapexChart::setTitle('Applicant in every jobs')
            ->setLabels($job_name->all())
            ->setDataset($total_applicant_pie->all());

        $vacancies = Vacancy::where('company_id', $company_id->id)->get();

        foreach ($vacancies as $key) {
            $total_applicant_in_vacancy = Applying::where('vacancy_id', $key->id)->where('status' , 'Accepted')->get()->count();
            $key->total_applicant = $total_applicant_in_vacancy. '/'. $key->total_applicant;
        }

        return view('company.dashboard')->with(['vacancies' => $vacancies, 'chartPie' => $chartPie, 'chartArea' => $chartArea, 'title' => 'Dashboard']);
    }


    public function register(Request $request)
    {
        // return $request;
        $this->validate($request,[
            'company_name' => ['required', 'string', 'min:5' , 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);


        $user = User::Create([
            'role' => '2',
            'name' => $request['company_name'],
            'email' => $request['email'],
            'password' => Hash::make($request['password']),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

        \auth()->login($user, true);
        return redirect('/');

    }

    public function listApplicantVacancy($id)
    {
        $vacancy_info = Vacancy::find($id);
        // $company_info = Company::where('id', $vacancy_info->company_id)->first();
        $company_info = Company::where('id', $vacancy_info->company_id)->first();
        // return $company_info ;
        if($company_info->user_id != auth()->user()->id){
            return redirect('/vacancy')->with('error', 'Your are not authorized');
        }

        $applicant = Applying::where('vacancy_id', $id)->whereIn('status', ['Check by Company','Interview on progress', 'Interview schedule sent'])->get();

        if (empty($applicant)) {
            abort(404);
        }else{
            return view('company.applicant.list_applicant')->with(['title' => 'List of Applicant', 'applicant' => $applicant]);
        }
    }

    public function viewVerify()
    {

        $company_id = Company::where('user_id', auth()->user()->id)->first();
        // return $company_id;
        if (empty($company_id)) {
            return redirect('/company/create')->with('error','Please finish your company profile');
        }

        $on_verify = Verifying::where('company_id', $company_id->id)->where('status', 'Check by Admin')->first();
        $previous_verify = Verifying::where('company_id', $company_id->id)->where('status', 'Rejected')->orderByDesc('created_at')->first();
        // return $previous_verify;

        if($on_verify){
            $flag_on_check = 1;
        }else{
            $flag_on_check = 0;
        }
        return view('request.verify')->with(['title' => 'Request Verify', 'flag_on_check' => $flag_on_check, 'previous_verify' => $previous_verify]);

    }

    public function requestVerify(Request $request)
    {
        // return $request;
        if (auth()->user()->role == '1') {
            return 'This is applicant user';
        }else{

            $this->validate($request,[
                'npwp_number' => ['required', 'string', 'max:255'],
                'sio_file' => 'mimetypes:application/pdf|required|max:1999',
                'sid_file' => 'mimetypes:application/pdf|required|max:1999',
                'bpom_file' => 'mimetypes:application/pdf|required|max:1999',
            ]);

            $transaction = new Verifying();
            $company_id = Company::where('user_id', auth()->user()->id)->first();
            $transaction->company_id = $company_id->id;
            $transaction->current_user = 'Admin';
            $transaction->status = 'Check by Admin';
            // return $company_id;
            $transaction->npwp = $request->npwp_number;

            if ($request->hasFile('sio_file')) {
                //get just file name
                $fileName = $company_id->id;
                //get just ext
                $extension = $request->file('sio_file')->getClientOriginalExtension();
                //filename to store
                $fileNameToStore = time().'_'.$fileName.'.'.$extension;
                //upload
                $path = $request->file('sio_file')->storeAs('public/files/sio', $fileNameToStore);
            }else{
                $fileNameToStore = 'no_file';
            }

            $transaction->surat_izin_operational = $fileNameToStore;

            if ($request->hasFile('sid_file')) {
                //get just file name
                $fileName1 = $company_id->id;
                //get just ext
                $extension1 = $request->file('sid_file')->getClientOriginalExtension();
                //filename to store
                $fileNameToStore1 = time().'_'.$fileName1.'.'.$extension1;
                //upload
                $path1 = $request->file('sio_file')->storeAs('public/files/sid', $fileNameToStore1);
            }else{
                $fileNameToStore1 = 'no_file';
            }

            $transaction->surat_izin_distribusi = $fileNameToStore1;

            if ($request->hasFile('bpom_file')) {
                //get just file name
                $fileName2 = $company_id->id;
                //get just ext
                $extension2 = $request->file('bpom_file')->getClientOriginalExtension();
                //filename to store
                $fileNameToStore2 = time().'_'.$fileName2.'.'.$extension2;
                //upload
                $path2 = $request->file('bpom_file')->storeAs('public/files/bpom', $fileNameToStore2);
            }else{
                $fileNameToStore2 = 'no_file';
            }

            $transaction->bpom = $fileNameToStore2;

            $transaction->notes = '-';
            $transaction->created_at = Carbon::now();
            $transaction->updated_at = Carbon::now();

            $transaction->save();

            return redirect('/verify')->with('success', 'Request Sent');
            // return 'This is applicant';
        }
    }

}
