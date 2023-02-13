<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DesignController extends Controller
{
    public function contactUs(){
        //return 'this is contact us page';
        return view('design.contact_us');
    }
    public function aboutUs(){
        //return 'this is contact us page';
        return view('design.about_us');
    }
    public function blogPage()
    {
        return view('design.blog');
    }
    public function blogDetails()
    {
        return view('design.blog-details');
    }
    public function notFound()
    {
        return view('design.not_found');
    }
}
