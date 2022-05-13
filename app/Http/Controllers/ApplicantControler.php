<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ApplicantControler extends Controller
{
    public function request()
    {
        return view('request/report');
    }
}
