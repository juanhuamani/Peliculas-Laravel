<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\User;
use App\Http\Controllers\MailController;

class RegisterController extends Controller
{
    public function show(Request $request)
    {
        $usernameSend= $request->input('username');
        $emailSend= $request->input('email');
        $passwordSend= $request->input('password');

        return view('register' , compact('usernameSend' , 'emailSend' , 'passwordSend'));
    }
    
    public function register(Request $request)
    {   
        // Validate the request
        $request->validate([
            'username' => 'required|unique:users|min:3|max:20',
            'email' => 'required|email|unique:users',
            'password' => 'required',
        ]);

        // Create a new user

        $user = User::create([
            'username' => $request->username,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'remember_token' => Str::random(20),
        ]);
        
        // Send the email
        $verifyEmail = MailController::sendMail($user);

        // Redirect to the login page
        if (isset($verifyEmail['success'])) {
            return redirect('/login')->with('success', 'User registered successfully. Please verify your email.');
        } else {
            // If there is an error, delete the user
            $user->delete();
            return redirect('/register')->withErrors($verifyEmail['error']);
        }
    }
}
