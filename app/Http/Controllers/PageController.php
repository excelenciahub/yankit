<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PageController extends Controller
{
    public function about_us(Request $request){
        return view('pages.about-us');
    }
    public function terms_condition(Request $request){
        return view('pages.terms-condition');
    }
    public function privacy_policy(Request $request){
        return view('pages.privacy-policy');
    }
}
