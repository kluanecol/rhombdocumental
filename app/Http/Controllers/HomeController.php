<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Crypt;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
      //  $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        //dd(User::all());
        $data['users'] = User::all()->take(20);
        return view('admin.dashboard', $data);
    }

    public function init(Request $request)
    {
        Auth::loginUsingId(Crypt::decrypt($request->id));

        //dd(Auth::user());

        return redirect()->route('indddex');
    }

    public function notAuthenticated()
    {
        return view('notAuthenticated');
    }

    public function getInfo($id)
    {

        $response = [
            'user' => User::find($id)
        ];
        return response()->json($response);
    }

    public function getInfoPost(Request $request)
    {

        $response = [
            'user' => User::find($request->id)
        ];
        return response()->json($response);
    }
}
