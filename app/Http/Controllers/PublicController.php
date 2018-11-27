<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PublicController extends Controller
{
    public function about()
    {
    	echo "about";
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
