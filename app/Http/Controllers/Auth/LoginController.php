<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Session;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Crypt;


use App\Modules\Admin\UserCountry\Models\UserCountry;

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

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function init(Request $request)
    {
        if ($request->header('Origin') == env('KD_RHOMB_URL')) {

            Auth::loginUsingId(Crypt::decrypt($request->id), true);

            session()->put('locale', 'es');

            self::getLanguageSubmenu();

            return redirect()->route('home');

        }else{
            return redirect()->away('https://kluanecolombia.com');
        }
    }

    protected function authenticated(Request $request)
    {

        $userId = Auth()->user()->id;

        $userCountries = UserCountry::join('countries','countries.id','=','users_by_countries.id_country')
        ->Where('users_by_countries.id_user',$userId)
        ->where('countries.state',1)
        ->get();

        Session::put('countries', $userCountries);
        session()->put('locale', 'es');
        Session::put('country', $userCountries[0]->country);




    }

    public function getLanguageSubmenu(){

        $languageOptions = [
            'text' => trans('general.lenguaje'),
            'topnav_right' => true,
            'icon' => 'fas fa-glasses',
            'submenu' => [
                [
                    'text'=>'English',
                    'icon' => 'http://purecatamphetamine.github.io/country-flag-icons/3x2/US.svg"',
                    'url'=> route('lang.swap', 'en')
                ],
                [
                    'text'=>'Español',
                    'icon' => 'flag-icon flag-icon-kh',
                    'url'=> route('lang.swap', 'es')
                ]
            ]
        ];
        $_SESSION["language_options"] = $languageOptions;
    }
}
