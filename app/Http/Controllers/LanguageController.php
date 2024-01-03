<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use App\Modules\Admin\Country\Models\Country;
use Session;
use App\Http\Controllers\Admin\GeneralConfiguration;

class LanguageController extends Controller

{

    public function swap($lang)
    {
        session()->put('locale', $lang);
        GeneralConfiguration::setLanguageSubmenu();
        return redirect()->route('home');
    }

    public function swapcountry($idCountry)
    {
        $country = Country::Where('id',$idCountry)->first();
        Session::put('country', $country);

        GeneralConfiguration::setCountrySubmenu();
        return redirect()->route('home');
    }

}
