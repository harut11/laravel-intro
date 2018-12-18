<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PublicController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function home()
    {
        \Debugbar::log(request());
        return view('public.home');
    }

    public function about()
    {
    	return view('public.about');
    }

    public function terms()
    {
        return view('public.terms');
    }

    public function privacy()
    {
        return view('public.privacy');
    }

    public function contact()
    {
        return view('public.contact');
    }

    public function changeLanguage($code)
    {
        session()->put('lang', $code);
        return redirect()->back();
    }

}
