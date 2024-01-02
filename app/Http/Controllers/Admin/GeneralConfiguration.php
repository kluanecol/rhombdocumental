<?php

namespace App\Http\Controllers\Admin\GeneralConfiguration;

use Session;
use Illuminate\Support\Facades\Auth;
use App\Modules\Admin\UserCountry\Models\UserCountry;
use Illuminate\Support\Facades\Log;

class GeneralConfiguration
{
    public static function yearsArray(){

        $years = [];
        for ($i=2022; $i < 2025; $i++) {
            $years[$i] = $i;
        }

        return $years;
    }

    public static function getCurrentCountryId(){

        if ( Session::get('country') != null ) {
            return Session::get('country')->id;
        }
        else{
            if (Auth::check()) {
                $userId = Auth()->user()->id;
                $userCountries = UserCountry::join('countries','countries.id','=','users_by_countries.id_country')
                ->Where('users_by_countries.id_user',$userId)
                ->where('countries.state',1)
                ->get();

                if ( $userCountries->count() > 0 ) {
                    Session::put('countries', $userCountries);
                    Session::put('country', $userCountries[0]->country);
                    return Session::get('country')->id;
                }else{
                    Log::warning('No se encontró país asociado al usuario ID',['id' => $userId, 'userCountriesQuery' => $userCountries]);

                    Auth::logout();
                }
            }else{
                Auth::logout();
            }

        }
    }

    public static function getCurrentLanguage(){
        return Session::get('locale');
    }

    public static function getMonths(){
        if (self::getCurrentLanguage() == 'es') {
            return array("01","02","03","04","05","06","07","08","09","10","11","12");
        } else {
            return array("01","02","03","04","05","06","07","08","09","10","11","12");
        }
    }

    public static function getShifts(){
        return  [
            1 => trans('labels.dia'),
            2 => trans('labels.noche')
        ];

    }

    public static function getLanguageSubMenu(){
        return Session::get('languageOptions');
    }
}
