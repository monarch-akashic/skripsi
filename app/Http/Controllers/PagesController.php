<?php

namespace App\Http\Controllers;
use App\Rules\MatchOldPassword;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use App\Portofolio;
use App\Company;
use App\Vacancy;
use App\UserLocation;
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


    public function showNotification(){
        // $vacancies = Vacancy::where('status_open', 'Admin')->get();

        return view('pages.notification_setting')->with(['title' => 'Settings']);
    }

    public function showPassword(){
        // $vacancies = Vacancy::where('status_open', 'Admin')->get();

        return view('pages.change_password')->with(['title' => 'Settings']);
    }

    public function showLocation(){
        // $vacancies = Vacancy::where('status_open', 'Admin')->get();
        $province = DB::table('province')
        ->select('province.prov_name', 'province.prov_id')->get();
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

        return view('pages.set_location')->with(['title' => 'Settings' ,'province' => $province, 'mylat' => $mylat, 'mylong' => $mylong]);
    }

    public function setlocation(Request $request){
        // return $request;
        $this->validate($request,[
            'name' => ['required', 'string', 'max:255'],
            'location' => ['required', 'string'],
            'province' => ['required'],
            'city' => ['required'],
            'district' => ['required'],
            'postal_code' => ['required'],
            'lat' => ['required', 'string', 'max:20'],
            'lng' => ['required', 'string', 'max:20'],
        ]);

        $location = new UserLocation();
        $location->user_id = auth()->user()->id;
        $location->name = $request->input('name');
        $location->location = $request->input('location');
        $location->latitude = $request->input('lat');
        $location->longitude = $request->input('lng');
        $location->province = $request->input('province');
        $location->kota = $request->input('city');
        $location->kecamatan = $request->input('district');
        $location->kode_pos = $request->input('postal_code');
        $location->created_at = Carbon::now();
        $location->save();

        return redirect('/accounts/edit/location')->with("success","Location Saved");

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

        return redirect('/accounts/password/change')->with("success","Password changed successfully!");
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

        try {
            $location_user = UserLocation::where('user_id', auth()->user()->id)->first();
        } catch (\Throwable $th) {
            $location_user;
        }
        if($location_user){
            $mylat = $location_user->latitude;
            $mylong = $location_user->longitude;
        }else{
            //default jakarta pusat
            $mylat = -6.186486;
            $mylong = 106.834091;
        }

        foreach ($get_vacancy as $key) {

            $lat = $key->latitude;
            $lng = $key->longitude;

            $key->latitude = $this->calculateDistance($lat, $lng, $mylat, $mylong);

        }
        $sortedResult = $get_vacancy->getCollection()->sortBy('latitude')->values();
        $get_vacancy->setCollection($sortedResult);



        return view('pages.search')->with(['title' => 'Search result', 'vacancies' => $get_vacancy]);
    }

    public function location(Request $request){

        $location_user = UserLocation::where('user_id', auth()->user()->id)->first();
        if(!$location_user){
            $location = new UserLocation();
            $location->user_id = auth()->user()->id;
            $location->latitude = $request->input('latitude');
            $location->longitude = $request->input('longitude');
            $location->created_at = Carbon::now();
            $location->save();
        }

    }


    public function index(){
        $vacancies = Vacancy::where('status_open' , '!=' ,'Admin')->get();

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
        // $location_user = UserLocation::where('user_id', auth()->user()->id)->first();


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
