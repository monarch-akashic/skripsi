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
    //Dropdown functions
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

    //Settings Functions
    public function showNotification(){
        return view('pages.settings_notification')->with(['title' => 'Settings']);
    }

    public function showPassword(){
        return view('pages.settings_change_password')->with(['title' => 'Settings']);
    }

    public function showLocation(){
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

        return view('pages.settings_set_location')->with(['title' => 'Settings' ,'province' => $province, 'mylat' => $mylat, 'mylong' => $mylong]);
    }

    public function currentLocation(){
        $user_location = UserLocation::where('user_id', auth()->user()->id)->first();

        // return $user_location;
        try {
            if($user_location == NULL){
                return redirect('/accounts/location/edit')->with("error","Location hasn't been set");
            }else{
                $province = DB::table('province')
                ->select('province.prov_name')->where('province.prov_id','=', $user_location->province)->pluck('prov_name');
                $kota = DB::table('city')
                ->select('city.city_name')->where('city.city_id','=', $user_location->kota)->pluck('city_name');
                $kecamatan = DB::table('district')
                ->select('district.dis_name')->where('district.dis_id','=', $user_location->kecamatan)->pluck('dis_name');

                $user_location->province = $province[0];
                $user_location->kota = $kota[0];
                $user_location->kecamatan = $kecamatan[0];

                // return $user_location;
                return view('pages.settings_show_location')->with(['title' => 'Settings', 'user_location' => $user_location]);
            }
        } catch (\Throwable $th) {
            // return $th;
            return redirect('/accounts/location/edit')->with("error","Location hasn't been set");
        }
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

        $user_location = UserLocation::where('user_id', auth()->user()->id)->first();
        try {
            if($user_location == NULL){
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

                return redirect('/accounts/location')->with("success","Location Saved");
            }else{
                $location = UserLocation::find($user_location->id);
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

                return redirect('/accounts/location')->with("success","Location Saved");
            }
        } catch (\Throwable $th) {
            return redirect('/accounts/location/edit')->with("error","Location hasn't been set");
        }

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

    #Main Page Functions
    public function index(){
        $vacancies = Vacancy::join('city', 'city.city_id', '=', 'vacancies.kota')
                    ->join('companies','companies.id', '=' , 'vacancies.company_id')
                    ->join('users','users.id', '=' , 'companies.user_id')
                    ->whereNotIn('status_open' , ['Admin','Rejected','Close'])->get(['vacancies.id','vacancies.job_name','vacancies.latitude','vacancies.longitude','users.name','city.city_name', 'companies.verified']);


        // return $vacancies[0];
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

        $vacancies = $vacancies->sortBy('latitude')->paginate(10);

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

    public function search(){
        $province = DB::table('province')
        ->select('province.prov_name', 'province.prov_id')->get();

        $city = DB::table('city')
        ->select('city.city_name', 'city.city_id')->get();

        $district = DB::table('district')
        ->select('district.dis_name', 'district.dis_id')->get();

        // $vacancies = Vacancy::whereNotIn('status_open',['Admin','Rejected','Close'])->paginate(10);

        $vacancies = DB::table('vacancies as v')
            ->join('companies as c','v.company_id', '=','c.id')
            ->join('users as u','u.id', '=','c.user_id')
            ->join('province as prov','prov.prov_id', '=','v.province')
            ->join('city as city','city.city_id', '=','v.kota')
            ->join('district as dist','dist.dis_id', '=','v.kecamatan')
            ->select('c.*', 'v.*', 'u.*', 'v.id' ,'prov.prov_name', 'city.city_name', 'dist.dis_name', 'c.verified')
            ->whereNotIn('v.status_open',['Admin','Rejected','Close'])
            ->get()->paginate(10);

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

        // $vacancies = $vacancies->sortBy('latitude');

        $sortedResult = $vacancies->getCollection()->sortBy('latitude')->values();
        $vacancies->setCollection($sortedResult);

        return view('pages.search')->with(['title' => 'Search','vacancies' => $vacancies, 'province' => $province, 'city' => $city, 'district' => $district]);
    }

    public function result(Request $request){
        // return $request;
        $province = DB::table('province')
        ->select('province.prov_name', 'province.prov_id')->get();
        $city = DB::table('city')
        ->select('city.city_name', 'city.city_id')->get();
        $district = DB::table('district')
        ->select('district.dis_name', 'district.dis_id')->get();

        $vacancy_search = $request->input('vacancy');

        $vacancy_province = $request->input('province');
        $vacancy_city = $request->input('city');
        $vacancy_district = $request->input('district');

        if (!$vacancy_province) {
            $vacancy_province = $province->pluck('prov_id');
        }else{
            $vacancy_province = explode(',', $request->input('province'));
        }
        if (!$vacancy_city) {
            $vacancy_city = $city->pluck('city_id');
        }else{
            $vacancy_city = explode(',', $request->input('city'));
        }
        if (!$vacancy_district) {
            $vacancy_district = $district->pluck('dis_id');
        }else{
            $vacancy_district = explode(',', $request->input('district'));
        }


        // return $vacancy_province;

        // $get_vacancy = Vacancy::where('job_name' , 'LIKE' , '%'.$vacancy_search.'%')->paginate(5);
        // $get_vacancy = Vacancy::join('companies', 'companies.id', '=', 'vacancies.company_id')
        //                 ->where('vacancies.job_name', 'LIKE' , '%'.$vacancy_search.'%')->get(['vacancies.job_name', 'companies.id']);

        if($request->input('search_type') == 'job'){
            $get_vacancy = DB::table('vacancies as v')
            ->join('companies as c','v.company_id', '=','c.id')
            ->join('users as u','u.id', '=','c.user_id')
            ->join('province as prov','prov.prov_id', '=','v.province')
            ->join('city as city','city.city_id', '=','v.kota')
            ->join('district as dist','dist.dis_id', '=','v.kecamatan')
            ->select('c.*', 'v.*', 'u.*', 'v.id' ,'prov.prov_name', 'city.city_name', 'dist.dis_name', 'c.verified')
            ->where('v.job_name', 'LIKE' , '%'.$vacancy_search.'%')
            ->whereIn('v.province' , $vacancy_province)
            ->whereIn('v.kota', $vacancy_city)
            ->whereIn('v.kecamatan', $vacancy_district)
            ->whereNotIn('v.status_open',['Admin','Rejected','Close'])
            ->get()->paginate(10);
        }elseif($request->input('search_type') == 'company'){
            $get_vacancy = DB::table('vacancies as v')
            ->join('companies as c','v.company_id', '=','c.id')
            ->join('users as u','u.id', '=','c.user_id')
            ->join('province as prov','prov.prov_id', '=','v.province')
            ->join('city as city','city.city_id', '=','v.kota')
            ->join('district as dist','dist.dis_id', '=','v.kecamatan')
            ->select('c.*', 'v.*', 'u.*', 'v.id' ,'prov.prov_name', 'city.city_name', 'dist.dis_name', 'c.verified')
            ->where('u.name', 'LIKE' , '%'.$vacancy_search.'%')
            ->whereIn('v.province' , $vacancy_province)
            ->whereIn('v.kota', $vacancy_city)
            ->whereIn('v.kecamatan', $vacancy_district)
            ->whereNotIn('v.status_open',['Admin','Rejected','Close'])
            ->get()->paginate(10);
        }else{
            $get_vacancy = DB::table('vacancies as v')
            ->join('companies as c','v.company_id', '=','c.id')
            ->join('users as u','u.id', '=','c.user_id')
            ->join('province as prov','prov.prov_id', '=','v.province')
            ->join('city as city','city.city_id', '=','v.kota')
            ->join('district as dist','dist.dis_id', '=','v.kecamatan')
            ->select('c.*', 'v.*', 'u.*', 'v.id' , 'prov.prov_name', 'city.city_name', 'dist.dis_name', 'c.verified')
            ->where('v.job_name', 'LIKE' , '%'.$vacancy_search.'%')
            ->orwhere('u.name', 'LIKE' , '%'.$vacancy_search.'%')
            ->whereNotIn('v.status_open',['Admin','Rejected','Close'])
            ->get()->paginate(10);
        }

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

        // return $get_vacancy;

        $sortedResult = $get_vacancy->getCollection()->sortBy('latitude')->values();
        $get_vacancy->setCollection($sortedResult);
        // $get_vacancy->paginate(5);

        // $get_vacancy = $get_vacancy->sortBy('latitude')->paginate(1);

        return view('pages.result')->with(['title' => 'Search result', 'vacancies' => $get_vacancy, 'province' => $province, 'city' => $city, 'district' => $district]);
    }

    public function searchTag(Request $request){
        $get_vacancy = DB::table('vacancies as v')
            ->join('companies as c','v.company_id', '=','c.id')
            ->join('users as u','u.id', '=','c.user_id')
            ->join('province as prov','prov.prov_id', '=','v.province')
            ->join('city as city','city.city_id', '=','v.kota')
            ->join('district as dist','dist.dis_id', '=','v.kecamatan')
            ->select('c.*', 'v.*', 'u.*', 'prov.prov_name', 'city.city_name', 'dist.dis_name', 'companies.verified')
            ->where('v.tag', 'LIKE' , '%'.$request->tag.'%')
            ->whereNotIn('v.status_open',['Admin','Rejected','Close'])
            ->get()->paginate(10);

        // return $request;
        $province = DB::table('province')
        ->select('province.prov_name', 'province.prov_id')->get();
        $city = DB::table('city')
        ->select('city.city_name', 'city.city_id')->get();
        $district = DB::table('district')
        ->select('district.dis_name', 'district.dis_id')->get();

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

        return view('pages.result')->with(['title' => 'Search result', 'vacancies' => $get_vacancy, 'province' => $province, 'city' => $city, 'district' => $district]);
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


}
