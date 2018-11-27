<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PublicController extends Controller
{
    public function about()
    {
    	$cities = ['Yerevan', 'Abovyan', 'Armavir'];
    	$name = 'jack';
    	$age = '25';
    	return view('public.about', compact('age', 'cities', 'name'));
    }

    public function terms()
    {
    	echo "terms and conditions";
    }

    public function privacy()
    {
    	echo "privacy policy";
    }

    public function contact()
    {
    	echo "contact us";
    }

}
