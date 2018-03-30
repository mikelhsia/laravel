<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Mail;
use App\User;
use App\Mail\Welcome;

class RegistrationForm extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required',
    		'email' => 'required|email',
    		'password' => 'max:16|min:6|confirmed' // confirmed is implied matches password_confirmation name
        ];
    }

    public function persist()
    {
        $user = User::create(
            $this->only(['name', 'email', 'password'])
        );

        // Sign them in
        auth()->login($user);

        // Sending email
        Mail::to($user)->send(new Welcome($user));
    }
}
