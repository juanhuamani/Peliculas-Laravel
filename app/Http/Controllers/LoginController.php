<?php

namespace App\Http\Controllers;


use App\Http\Requests\LoginRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Models\User;

class LoginController extends Controller
{
    public function index()
    {
        return view('login');
    }

    public function login(LoginRequest $request)
    {
        
        $credentials = $request->getCredentials();
        $credentials['username'] = strtolower($credentials['username']);

        $user = User::whereRaw('LOWER(username) = ?', [$credentials['username']])->first();

        if (!$user || !Auth::validate(['email' => $user->email, 'password' => $credentials['password']])) {
            return redirect('/login')->withErrors('Invalid credentials');
        }

        $user= Auth::getProvider()->retrieveByCredentials($credentials);
        Auth::login($user);

        return $this->authenticated($request, $user);
    }

    public function authenticated(Request $request, $user)
    {
        if (!$user->email_verified_at) {
            Auth::logout();
            return redirect('/login')->withErrors('Email not verified');
        } else {
            return redirect('/')->with('success', 'Welcome back, ' . $user->username);
        }
    }
}
