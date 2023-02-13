<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
//        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        if(auth()->check()){
            return redirect()->route('dashboard');
        }else{
            return redirect()->route('login');
        }

        // Default value assign for 'range' and 'range_type'
        if(!session()->has('range_type')){
            Session::put('range', 5);       // 5 Kilometer
            Session::put('range_type', 2);  // range_type: 1=Meter, 2=Kilometer
        }

        return view('frontend.home');
    }

    public function test()
    {
        return view('frontend.test');
    }

}
