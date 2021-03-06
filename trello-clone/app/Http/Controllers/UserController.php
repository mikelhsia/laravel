<?php

namespace App\Http\Controllers;


use App\User;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    /*********************************************
     * Login Method:
     * in here we call Auth::attempt with the credentials the user supplied.
     * If authentication is successful, we create access tokens and return them to the user.
     * This access token is what the user would always send along with all API calls to have access to the APIs.
     *
     * Register Method:
     * like the login method, we validated the user information, created an account for the user and generated
     * an access token for the user.
     *********************************************/
    public function login () {
        $status = 401;
        $response = ['error' => 'Unauthorised'];

        $credentials = [
            'email' => request('email'),
            'password' => request('password')
        ];

        if (Auth::attempt($credentials)) {
            $success['token'] = Auth::user()->createToken('MyApp')->accessToken;
            return response()->json(['success' => $success]);
        }

//        return response()->json(['error' => 'Unauthorised'], 401);
        return response()->json($response, $status);
    }

    public function register (Request $request) {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 401);
        }

        $input = $request->all();
        $input['password'] = bcrypt($input['password']);

        $user = User::create($input);
        $success['token'] = $user->createToken('MyApp')->accessToken;
        $success['name'] = $user->name;

        return response()->json(['success' => $success]);
    }

    public function getDetails () {
        return response()->json(['success' => Auth::user()]);
    }
}
