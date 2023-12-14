<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Auth;


class AuthController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        //
    }

    public function checkIn(Request $request)
    {
        dd($request->all());

        $id_user = urldecode($request->input('id'));
        $id_user = unserialize($id_user);

        //$id_modulo = Crypt::decryptString($request->input('id_modulo'));
        //$userData = User::find($id_user);
        //dd($userData);
        auth()->loginUsingId($userData->id);

        return redirect('/welcome');
    }

}
