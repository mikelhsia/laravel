<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SessionController extends Controller
{


	public function __construct() {
		$this->middleware('guest')->except(['destroy', 'login']);
	}

    public function create () {
    	return view('session.create');
    }

    public function store () {
    	// Authenticate the user
    	if (! auth()->attempt(request(['email', 'password']))) {
	    	// If not, redirect back
    		return back()->withErrors([
    			'message' => 'Please check your credentials and try again.'
    		]);
    	}

    	// If so, sign them in
    	// Redirect them to homepage
    	return redirect()->home();

    }

    public function destroy () {
    	auth()->logout();	

    	return redirect('/');
    }
}
