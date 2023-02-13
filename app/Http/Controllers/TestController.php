<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TestController extends Controller
{
    public function user()
    {
        $divisions = [];
        return view('frontend.workshops.user', compact('divisions'));
    }
    public function plan()
    {
        return view('frontend.Dashboard.plan');
    }
    public function profileUpdate()
    {
        return view('frontend.profile-update');
    }
    public function homePage()
    {
        return view('frontend.home');
    }

    public function googleApiTest()
    {
        return view('rough.google_text_api');
    }

}
