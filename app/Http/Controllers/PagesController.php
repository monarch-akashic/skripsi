<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Portofolio;
use App\Company;
use App\Vacancy;
use DateTime;
use Illuminate\Foundation\Auth\User;
use Carbon\Carbon;

class PagesController extends Controller
{
    public function validateVacancy(){
        $vacancies = Vacancy::where('status_open', 'Admin')->get();

        return view('admin.check_vacancy')->with(['title' => 'Validate Vacancy', 'vacancies' => $vacancies]);
    }


    // public function search(){
    //     $categories = Category::all();
    //     $data = Flower::orderBy('flower_name', 'asc')->paginate(8);
    //     return view('flowers.index')->with(['flower_name' => 'Search', 'flowers' => $data, 'min' => null, 'max' => null,'search' => null ,'categories' => $categories]);
    // }

    public function result(Request $request){
        $vacancy_search = $request->input('vacancy');

        $get_vacancy = Vacancy::where('job_name' , 'LIKE' , '%'.$vacancy_search.'%')->paginate(5);

        $mylat = -6.145184361472;
        $mylong = 106.87522530555725;

        foreach ($get_vacancy as $key) {

            $lat = $key->latitude;
            $lng = $key->longitude;

            $key->latitude = $this->calculateDistance($lat, $lng, $mylat, $mylong);

        }
        $sortedResult = $get_vacancy->getCollection()->sortBy('latitude')->values();
        $get_vacancy->setCollection($sortedResult);



        return view('pages.search')->with(['title' => 'Search result', 'vacancies' => $get_vacancy]);
    }


    public function index(){
        $vacancies = Vacancy::where('status_open' , '!=' ,'Admin')->get();


        $mylat = -6.145184361472;
        $mylong = 106.87522530555725;

        foreach ($vacancies as $key) {

            $lat = $key->latitude;
            $lng = $key->longitude;

            $key->latitude = $this->calculateDistance($lat, $lng, $mylat, $mylong);

        }


        $vacancies = $vacancies->sortBy('latitude');

        return view('pages.index')->with(['title' => 'Home','vacancies' => $vacancies]);
    }

    public function regisApplicant(){
        return view('auth.register_applicant');
    }

    public function regisCompany(){
        return view('auth.register_company');
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
