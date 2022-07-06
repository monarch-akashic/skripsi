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
use App\UserLocation;
use App\Applying;

class ApplicantController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function requestReport()
    {
        // $vacancy = Transaction::where('applicant_id', auth()->user()->id)->get();

        $vacancy = DB::table('applyings')
        ->join('vacancies','applyings.vacancy_id', '=','vacancies.id')
        ->select('vacancies.id', 'vacancies.job_name')
        ->where('applyings.status', '=', 'Finish')
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

            $this->validate($request,[
                'report_file' => 'mimetypes:application/pdf|nullable|max:1999',
                'my_vacancy' => ['required', 'string', 'max:255'],
                'subject' => ['required', 'string', 'max:255'],
                'details' => ['required', 'string', 'max:255'],

            ]);

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
        ->join('city','vacancies.kota', '=','city.city_id')
        ->select('vacancies.id', 'vacancies.job_name','vacancies.latitude', 'vacancies.longitude','vacancies.age', 'city.city_name', 'applyings.created_at', 'applyings.status')
        ->where('applyings.applicant_id', '=', auth()->user()->id)->get();

        // return $vacancies;

        try {
            $location_user = UserLocation::where('user_id', auth()->user()->id)->first();
            if($location_user){
                $mylat = $location_user->latitude;
                $mylong = $location_user->longitude;
            }else{
                //default jakarta pusat
                $mylat = -6.186486;
                $mylong = 106.834091;
            }
        } catch (\Throwable $th) {
            $mylat = -6.186486;
            $mylong = 106.834091;
        }

        foreach ($vacancies as $key) {

            $lat = $key->latitude;
            $lng = $key->longitude;

            $key->latitude = $this->calculateDistance($lat, $lng, $mylat, $mylong);

        }

        return view('applicant.applied_job')->with(['title' => 'My Job Applied','vacancies' => $vacancies]);
    }

    public function checkAppliedJob($id){
        // return 'test';
        $vacancies = Vacancy::find($id);
        $company = Company::find($vacancies->company_id)->pluck('user_id');
        $company_info = User::find($company)->first();

        $applyings = Applying::where('vacancy_id', $id)->where('applicant_id', auth()->user()->id)->first();
        if (!$applyings) {
            return redirect('/myvacancy')->with('error', 'You didnt applied for that job');
        }
        // return $applyings;

        return view('company.applicant.detail_applied_job')->with(['title' => $vacancies->job_name,'vacancies' => $vacancies,'company_info' => $company_info, 'applyings' => $applyings]);
    }

    public function acceptInterview(Request $request, $id){
        $applyings = Applying::find($request->applying_id);
        $applyings->status = 'Interview on progress';
        $applyings->updated_at = Carbon::now();
        $applyings->save();
        return redirect('/myvacancy/vacancy/'.$id)->with('success', 'Interview Accepted');
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
