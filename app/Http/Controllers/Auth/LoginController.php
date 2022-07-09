<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Laravel\Socialite\Facades\Socialite;
use App\User;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    // protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function redirectTo(){
        if(auth()->user()->role == '2'){
            $this->redirectTo = RouteServiceProvider::DASHBOARD;
            return $this->redirectTo;
        }
        $this->redirectTo = RouteServiceProvider::HOME;
        return $this->redirectTo;
    }

    public function redirectToProvider()
    {
        return Socialite::driver('google')->redirect();
    }
    public function handleProviderCallback(\Request $request)
    {
        try {
            $user_google    = Socialite::driver('google')->user();
            $user           = User::where('email', $user_google->getEmail())->first();

            if($user != null){
                \auth()->login($user, true);
                return redirect('/');
            }else{
                // return $user_google;
                $create = User::Create([
                    'email'             => $user_google->getEmail(),
                    'name'              => $user_google->getName(),
                    'role'              => 1,
                    'phoneNo'           => 0,
                    'password'          => 0,
                    'dob'               => '9999-12-31',
                    'email_verified_at' => now()
                ]);


                \auth()->login($create, true);
                return redirect('/');
            }

        } catch (\Exception $e) {
            return $e;
            return redirect()->route('login');
        }


    }
}
