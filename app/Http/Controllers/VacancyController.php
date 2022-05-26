<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Portofolio;
use App\Company;
use App\Vacancy;
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
        $vacancies = Vacancy::where('company_id', $company[0]->id)->get();;
        // return $vacancies;
        return view('company.vacancy.show')->with(['title' => 'Vacancy','vacancies' => $vacancies]);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('company/vacancy/create');
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
        $id = auth()->user()->id;
        $company_id = Company::where('user_id', $id)->get();
        $vacancy = new Vacancy();
        $vacancy->company_id = $company_id[0]->id;
        $vacancy->job_name = $request->input('job_name');
        $vacancy->job_description = $request->input('job_description');
        $vacancy->requirement = $request->input('job_requirement');
        $vacancy->age = $request->input('age_range_1').'-'.$request->input('age_range_2');
        $vacancy->salary = $request->input('salary').' '.$request->input('salary_type');
        $vacancy->status_open = 'Open';
        $vacancy->working_hour = $request->input('working_hour_range_1').'-'.$request->input('working_hour_range_2');
        $vacancy->total_applicant = $request->input('total_applicant');
        $vacancy->location = $request->input('location');
        $vacancy->latitude = $request->input('lat');
        $vacancy->longitude = $request->input('lng');
        $vacancy->province = 'Province';
        $vacancy->kota = 'Kota';
        $vacancy->kecamatan = 'Kecamatan';
        $vacancy->kode_pos = 'Kode Pos';
        $vacancy->created_at = Carbon::now();;
        $vacancy->save();

        return redirect('/vacancy')->with('success', 'Vacancy Created');
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

    public function request()
    {
        return view('request.verify');
    }


}
