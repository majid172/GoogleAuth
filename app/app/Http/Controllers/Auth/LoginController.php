<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;

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
    protected $redirectTo = RouteServiceProvider::HOME;


    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }
    public function googleLogin(){
        
        return Socialite::driver('google')->redirect();
    }
    public function googleLoginCallback(){
       
        $user = Socialite::driver('google')->user();
        
        $this->registerOrLogin($user);
        // after login
        return redirect()->route('home');
    }
    public function facebookLogin(){
        
        return Socialite::driver('facebook')->redirect();
    }

    public function facebookLoginCallback(){
        $user = Socialite::driver('facebook')->user();
    }
    public function registerOrLogin($data){
        $user = User::where('email',$data->email)->first();
        if(!$user){
            $user = new User();
            $user->name = $data->name;
            $user->email = $data->email;
            $user->provide_id = $data->provide_id;
            $user->save();
        }
        Auth::login($user);
    }
}
