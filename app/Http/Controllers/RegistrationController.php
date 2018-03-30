<?php

namespace App\Http\Controllers;

use App\Http\Requests\RegistrationForm;
use Illuminate\Http\Request;

class RegistrationController extends Controller
{
    public function create () {
    	return view('registration.create');
    }

    public function store (RegistrationForm $form) {
    	// Validate the form
        // Move to RegistrationForm.php
//    	$this->validate(request(), [
//    		'name' => 'required',
//    		'email' => 'required|email',
//    		'password' => 'max:16|min:6|confirmed' // confirmed is implied matches password_confirmation name
//       	]);

//    	// Create and save the user
//    	$user = User::create([
//            'name' => request('name'),
//            'email' => request('email'),
//            'password' => bcrypt(request('password'))
//        ]);
//
//    	// Sign them in
//    	auth()->login($user);
//
//    	// Sending email
//        \Mail::to($user)->send(new Welcome($user));

        $form->persist();

        // Flash means session only stays at that page, refresh will cause it disappear
        session()->flash('message', 'Thank you so much for signing up');

    	// Redirect user to the homepage
    	return redirect()->home();
    }
}
