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
        $company = Company::where('user_id', $id)->get();
        $vacancies = Vacancy::where('company_id', $company[0]->id)->get();
        // return $vacancies;
        return view('company.vacancy.index')->with(['title' => 'Vacancy','vacancies' => $vacancies]);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('company.vacancy.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        return $request;
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
        $vacancy->province = 'Province';
        $vacancy->kota = 'Kota';
        $vacancy->kecamatan = 'Kecamatan';
        $vacancy->kode_pos = 'Kode Pos';
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
        // return $vacancies;
        return view('company.vacancy.detail')->with(['title' => 'Vacancy','vacancies' => $vacancies]);

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
        $vacancy_id = Vacancy::find($id);

        // return auth()->user()->id;
        // return $vacancy_id;

        if (auth()->user()->role == '2') {
            $company_id = Company::where('user_id', auth()->user()->id)->first();
            // return $company_id;

            if ($company_id->id == $vacancy_id->company_id ) {
                return 'This is owner';
            }else{
                return 'This is other';
            }
        }elseif (auth()->user()->role == '0') {
            $vacancy_id->status_open = 'Open';
            $vacancy_id->save();
            return redirect('/validate')->with('success', 'Vacancy Approved');
        }
        else{
            $transaction = new Applying();
            $transaction->vacancy_id = $id;
            $transaction->company_id = $vacancy_id->company_id;
            $transaction->applicant_id = auth()->user()->id;
            $company_id = Company::where('id', $vacancy_id->company_id)->first();
            // return $company_id;
            $transaction->current_user = $company_id->user_id;

            $transaction->status = 'Check by Company';
            $transaction->save();

            return redirect('/')->with('success', 'Vacancy Applied');
            // return 'This is applicant';
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
