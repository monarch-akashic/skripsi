<?php

namespace App\Http\Controllers;
use App\Rules\MatchOldPassword;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use App\Portofolio;
use App\Company;
use App\Vacancy;
use DateTime;
// use Illuminate\Foundation\Auth\User;
use Carbon\Carbon;
use App\User;
use Illuminate\Support\Facades\DB;

class PagesController extends Controller
{

    // public function postCoor($id){
    //     $cities = DB::table('city')
    //     ->select('city.city_name', 'city.city_id')
    //     ->where('city.prov_id', '=', $id)->pluck('city_name','city_id');
    //     return json_encode($cities);
    // }

    public function getCity($id){
        $cities = DB::table('city')
        ->select('city.city_name', 'city.city_id')
        ->where('city.prov_id', '=', $id)->pluck('city_name','city_id');
        return json_encode($cities);
    }

    public function getDistrict($id){
    	$districts= DB::table('district')
        ->select('district.dis_name', 'district.dis_id')
        ->where('district.city_id', '=', $id)->pluck('dis_name','dis_id');
        return json_encode($districts);
    }

    public function getPostalCode($id){
    	$postalcodes= DB::table('postal_code')
        ->select('postal_code.postal_code')
        ->where('postal_code.dis_id', '=', $id)->distinct()->pluck('postal_code');
        return json_encode($postalcodes);
    }

    public function settings(){
        // $vacancies = Vacancy::where('status_open', 'Admin')->get();

        return view('pages.settings')->with(['title' => 'Settings']);
    }

    public function changePassword(Request $request)
    {
        // return $request;
        $request->validate([
            'current_password' => ['required', new MatchOldPassword],
            'new_password' => ['required','min:8'],
            'new_confirm_password' => ['same:new_password'],
        ]);

        User::find(auth()->user()->id)->update(['password'=> Hash::make($request->new_password)]);

        return redirect('/accounts/edit')->with("success","Password changed successfully!");
    }

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
