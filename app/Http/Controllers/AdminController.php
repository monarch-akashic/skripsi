<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Vacancy;

class AdminController extends Controller
{
    public function validateVacancy(){
        $vacancies = Vacancy::join('city', 'city.city_id', '=', 'vacancies.kota')
        ->join('companies','companies.id', '=' , 'vacancies.company_id')
        ->join('users','users.id', '=' , 'companies.user_id')
        ->whereIn('status_open' , ['Admin'])->get(['vacancies.id','vacancies.job_name','users.name','city.city_name']);

        $vacancies = $vacancies->sortBy('vacancies.created_on')->paginate(10);
        // $vacancies = Vacancy::where('status_open', 'Admin')->get();

        // return $vacancies;

        return view('admin.check_vacancy')->with(['title' => 'Validate Vacancy', 'vacancies' => $vacancies]);
    }
}
