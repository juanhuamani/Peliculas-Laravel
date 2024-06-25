<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\User;
use App\Http\Controllers\MailController;

class RegisterController extends Controller
{
    public function show()
    {
        return view('register');
    }
    
    public function register(Request $request)
    {   
        // Validate the request
        $request->validate([
            'username' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required',
        ]);

        // Create a new user
        $user = new User();
        $user->username = $request->username;
        $user->email = $request->email;
        $user->password = bcrypt($request->password);
        $user->remember_token = Str::random(20);

        // Save the user
        $user->save();
        
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
