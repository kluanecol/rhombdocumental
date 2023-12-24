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
        $data['users'] = User::all();
        return view('admin.dashboard', $data);
    }

    public function init(Request $request)
    {
        Auth::loginUsingId(Crypt::decrypt($request->id));
        return redirect()->route('home');
    }

    public function notAuthenticated()
    {
        return view('notAuthenticated');
    }
}
