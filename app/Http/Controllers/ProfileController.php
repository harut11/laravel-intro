<?php

namespace App\Http\Controllers;

use Auth;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function edit()
    {
    	$model = Auth::user();
    	return view('user.profile', compact('model'));
    }

    public function update(Request $request)
    {
    	$this->validate($request, [
			'details' => 'required|array|min:2',
			'details.first_name' => 'required|min:2|max:50',
			'details.last_name' => 'required|min:2|max:50',
    	]);
    	$model = Auth::user();
    	$model->details = $request->get('details');
    	return redirect()->back();
    }
}
