<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Mail\Welcome;

class RegistrationController extends Controller
{
    public function create () {
    	return view('registration.create');
    }

    public function store () {
    	// Validate the form
    	$this->validate(request(), [
    		'name' => 'required',
    		'email' => 'required|email',
    		'password' => 'max:16|min:6|confirmed' // confirmed is implied matches password_confirmation name
       	]);

    	// Create and save the user
    	$user = User::create([
            'name' => request('name'), 
            'email' => request('email'),
            'password' => bcrypt(request('password'))
        ]);

    	// Sign them in
    	auth()->login($user);

    	// Sending email
        \Mail::to($user)->send(new Welcome($user));

    	// Redirect user to the homepage
    	return redirect()->home();
    }
}
