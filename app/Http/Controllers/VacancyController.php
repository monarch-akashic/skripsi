<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Portofolio;
use App\Company;
use App\Vacancy;
use App\Applying;
use DateTime;
use Illuminate\Foundation\Auth\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class VacancyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $id = auth()->user()->id;
        $company = Company::where('user_id', $id)->first();
        // return $company;
        if (empty($company)) {
            return redirect('/company/create')->with('error','Please finish your company profile');

        }
        $vacancies = Vacancy::where('company_id', $company->id)->get();
        // $vacancies = Vacancy::where('company_id', $company[0]->id)->pluck('salary','job_name','status_open');
        // return ($vacancies);
        return view('company.vacancy.index')->with(['title' => 'Vacancy','vacancies' => $vacancies]);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $province = DB::table('province')
        ->select('province.prov_name', 'province.prov_id')->get();
        // return gettype($province);
        return view('company.vacancy.create')->with(['title' => 'Create Vacancy','province' => $province]);
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
            'job_name' => ['required', 'string', 'max:255'],
            'job_description' => ['required', 'string'],
            'job_requirement' => ['required', 'string'],
            'age_range_1' => ['required', 'string', 'max:20'],
            'age_range_2' => ['required', 'string', 'max:20'],
            'location' => ['required', 'string'],
            'province' => ['required'],
            'city' => ['required'],
            'district' => ['required'],
            'postal_code' => ['required'],
            'lat' => ['required', 'string', 'max:20'],
            'lng' => ['required', 'string', 'max:20'],
            // 'salary' => ['required', 'string', 'max:20'],
            // 'salary_type' => ['required', 'string', 'max:20'],
            'total_applicant' => ['required', 'string', 'max:20'],
            'working_hour_range_1' => ['required', 'string', 'max:20'],
            'working_hour_range_2' => ['required', 'string', 'max:20'],
        ]);

        $id = auth()->user()->id;
        $company_id = Company::where('user_id', $id)->get();
        $vacancy = new Vacancy();
        $vacancy->company_id = $company_id[0]->id;
        $vacancy->job_name = $request->input('job_name');
        $vacancy->job_description = $request->input('job_description');
        $vacancy->requirement = $request->input('job_requirement');
        $vacancy->age = $request->input('age_range_1').'-'.$request->input('age_range_2');
        $vacancy->salary = $request->input('salary').' '.$request->input('salary_type');
        $vacancy->status_open = 'Admin';
        $vacancy->workflow = 'Check';
        $vacancy->notes = 'NULL';
        $vacancy->working_hour = $request->input('working_hour_range_1').'-'.$request->input('working_hour_range_2');
        $vacancy->total_applicant = $request->input('total_applicant');
        $vacancy->location = $request->input('location');
        $vacancy->latitude = $request->input('lat');
        $vacancy->longitude = $request->input('lng');
        $vacancy->province = $request->input('province');
        $vacancy->kota = $request->input('city');
        $vacancy->kecamatan = $request->input('district');
        $vacancy->kode_pos = $request->input('postal_code');
        $vacancy->created_at = Carbon::now();
        $vacancy->save();

        return redirect('/vacancy')->with('success', $vacancy->job_name.' Vacancy Created');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $vacancies = Vacancy::find($id);
        $company = Company::find($vacancies->company_id)->pluck('user_id');
        $company_info = User::find($company)->first();
        return view('company.vacancy.detail')->with(['title' => $vacancies->job_name,'vacancies' => $vacancies,'company_info' => $company_info]);

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $vacancies = Vacancy::find($id)->first();
        $province = DB::table('province')
        ->select('province.prov_name', 'province.prov_id')->get();
        // $company = Company::find($vacancies->company_id)->pluck('user_id');
        // $company_info = User::find($company)->first();
        // return $company_info;
        $vacancies->age = explode('-',$vacancies->age);
        $vacancies->working_hour = explode('-',$vacancies->working_hour);
        $vacancies->salary = explode(' ',$vacancies->salary);
        // return $vacancies;

        return view('company.vacancy.edit')->with(['title' => 'Edit '.$vacancies->job_name, 'vacancies' => $vacancies, 'province' => $province]);
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
        $vacancy_id = Vacancy::find($id);

        // return auth()->user()->id;
        // return $vacancy_id;

        if (auth()->user()->role == '2') {
            $company_id = Company::where('user_id', auth()->user()->id)->first();
            // return $company_id;

            if ($company_id->id == $vacancy_id->company_id ) {
                // return $request;
                switch ($request->input('action')) {
                    case 'Save':
                        $this->validate($request,[
                            'job_name' => ['required', 'string', 'max:255'],
                            'job_description' => ['required', 'string'],
                            'job_requirement' => ['required', 'string'],
                            'age_range_1' => ['required', 'string', 'max:20'],
                            'age_range_2' => ['required', 'string', 'max:20'],
                            'location' => ['required', 'string'],
                            // 'province' => ['required'],
                            // 'city' => ['required'],
                            // 'district' => ['required'],
                            // 'postal_code' => ['required'],
                            'lat' => ['required', 'string', 'max:20'],
                            'lng' => ['required', 'string', 'max:20'],
                            // 'salary' => ['required', 'string', 'max:20'],
                            // 'salary_type' => ['required', 'string', 'max:20'],
                            'total_applicant' => ['required', 'string', 'max:20'],
                            'working_hour_range_1' => ['required', 'string', 'max:20'],
                            'working_hour_range_2' => ['required', 'string', 'max:20'],
                        ]);

                        $user_id = auth()->user()->id;
                        $company_id = Company::where('user_id', $user_id)->first();
                        $vacancy = Vacancy::find($id);
                        $vacancy->company_id = $company_id->id;
                        $vacancy->job_name = $request->input('job_name');
                        $vacancy->job_description = $request->input('job_description');
                        $vacancy->requirement = $request->input('job_requirement');
                        $vacancy->age = $request->input('age_range_1').'-'.$request->input('age_range_2');
                        $vacancy->salary = $request->input('salary').' '.$request->input('salary_type');
                        $vacancy->workflow = 'Check';
                        $vacancy->working_hour = $request->input('working_hour_range_1').'-'.$request->input('working_hour_range_2');
                        $vacancy->total_applicant = $request->input('total_applicant');
                        $vacancy->location = $request->input('location');
                        $vacancy->latitude = $request->input('lat');
                        $vacancy->longitude = $request->input('lng');

                        $vacancy->province = $request->input('province');
                        if ($request->input('city')) {
                            $vacancy->kota = $request->input('city');
                            $vacancy->kecamatan = $request->input('district');
                            $vacancy->kode_pos = $request->input('postal_code');
                        }

                        $vacancy->updated_at = Carbon::now();
                        $vacancy->save();

                        return redirect('/vacancy/'.$id)->with('success', $vacancy->job_name.' Vacancy Updated');
                    case 'Delete':
                        $vacancy = Vacancy::find($id);
                        $vacancy->delete();
                        return redirect('/vacancy')->with('success', 'Vacancy Deleted');
                    case 'SendToAdmin':
                        $vacancy = Vacancy::find($id);
                        $vacancy->status_open = 'Admin';
                        $vacancy->save();
                        return redirect('/vacancy')->with('success', 'Vacancy Saved, on check by admin');
                }


            }else{
                return 'This is other';
            }
        }elseif (auth()->user()->role == '0') {
            switch ($request->input('action')) {
                case 'Approve':
                    $this->validate($request,[
                        'notes' => ['required', 'string', 'min:10' , 'max:255'],
                    ]);
                    $vacancy_id->status_open = 'Open';
                    $vacancy_id->save();
                    return redirect('/validate')->with('success', 'Vacancy Approved');
                case 'Reject':
                    $this->validate($request,[
                        'notes' => ['required', 'string', 'min:10' , 'max:255'],
                    ]);
                    $vacancy_id->notes = $request->notes;
                    $vacancy_id->status_open = 'Rejected';
                    $vacancy_id->save();
                    return redirect('/validate')->with('success', 'Vacancy Rejected');
            }

        }
        else{
            $check_if_have_portofolio = Portofolio::where('user_id',auth()->user()->id)->first();
            // return $check_if_have_portofolio;
            if ($check_if_have_portofolio == '') {
                return redirect('/vacancy/'.$id)->with('error', 'Please Finish your portofolio');
            }

            $check_if_applied = Applying::where('vacancy_id',$id)->where('applicant_id', auth()->user()->id )->first();
            // return $check_if_applied;
            if ($check_if_applied != '') {
                return redirect('/vacancy/'.$id)->with('error', 'You already applied for this vacancy');
            } else {
                // return 'applied';
                $transaction = new Applying();
                $transaction->vacancy_id = $id;
                $transaction->company_id = $vacancy_id->company_id;
                $transaction->applicant_id = auth()->user()->id;
                $company_id = Company::where('id', $vacancy_id->company_id)->first();
                // return $company_id;
                $transaction->current_user = $company_id->user_id;
                $transaction->status = 'Check by Company';
                $transaction->save();

                return redirect('/vacancy/'.$id)->with('success', 'Vacancy Applied');
                // return 'This is applicant';
            }
        }



        // return $request;
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



    public function applyVacancy(Request $request)
    {
        return $request;
        // $id = $request->input('id');
        // return $id;

        return view('company.vacancy.detail');
    }


}
