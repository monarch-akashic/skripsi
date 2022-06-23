<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Portofolio;
use App\Company;
use App\Vacancy;
use App\Reporting;
use DateTime;
use Illuminate\Foundation\Auth\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class ApplicantControler extends Controller
{
    public function request()
    {
        // $vacancy = Transaction::where('applicant_id', auth()->user()->id)->get();

        $vacancy = DB::table('applyings')
        ->join('vacancies','applyings.vacancy_id', '=','vacancies.id')
        ->select('vacancies.id', 'vacancies.job_name')
        ->where('applyings.applicant_id', '=', auth()->user()->id)->get();

        // return $vacancy;

        return view('request.report')->with(['title' => 'Vacancy','vacancy' => $vacancy]);
    }
    public function storeReport(Request $request)
    {
        // return $request;
        if (auth()->user()->role == '2') {
            return 'This is company user';
        }else{
            $transaction = new Reporting();
            $transaction->vacancy_id = $request->my_vacancy;
            $company_id = Vacancy::where('id', $request->my_vacancy)->first();
            $transaction->company_id = $company_id->company_id;
            $transaction->applicant_id = auth()->user()->id;
            // return $company_id;
            $transaction->current_user = 6;
            $transaction->subject = $request->subject;
            $transaction->details = $request->details;
            $transaction->file = 'NO FILE';
            $transaction->notes = 'NO';

            $transaction->status = 'Check by Admin';
            $transaction->save();

            return redirect('/reporting/create')->with('success', 'Vacancy Reported');
            // return 'This is applicant';
        }
    }

    public function appliedJob(){
        $vacancies = DB::table('applyings')
        ->join('vacancies','applyings.vacancy_id', '=','vacancies.id')
        ->select('vacancies.id', 'vacancies.job_name','vacancies.latitude', 'vacancies.longitude','vacancies.created_at','vacancies.age')
        ->where('applyings.applicant_id', '=', auth()->user()->id)->get();

        // return $vacancies;

        $mylat = -6.145184361472;
        $mylong = 106.87522530555725;

        foreach ($vacancies as $key) {

            $lat = $key->latitude;
            $lng = $key->longitude;

            $key->latitude = $this->calculateDistance($lat, $lng, $mylat, $mylong);

        }

        return view('applicant.applied_job')->with(['title' => 'My Job Applied','vacancies' => $vacancies]);
    }

    private function calculateDistance($lat, $lng, $mylat, $mylong){
        $long1 = deg2rad($lng);
        $long2 = deg2rad($mylong);
        $lat1 = deg2rad($lat);
        $lat2 = deg2rad($mylat);

        //Haversine Formula
        $dlong = $long2 - $long1;
        $dlati = $lat2 - $lat1;

        $val = pow(sin($dlati/2),2)+cos($lat1)*cos($lat2)*pow(sin($dlong/2),2);

        $res = 2 * asin(sqrt($val));

        $radius = 6371;


        return ($res*$radius);
    }
}
