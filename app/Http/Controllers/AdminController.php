<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Vacancy;

class AdminController extends Controller
{
    public function validateVacancy(){
        $vacancies = Vacancy::where('status_open', 'Admin')->get();
        return view('admin.check_vacancy')->with(['title' => 'Validate Vacancy', 'vacancies' => $vacancies]);
    }
}
