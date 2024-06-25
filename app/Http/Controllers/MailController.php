<?php

namespace App\Http\Controllers;

use Exception;
use App\Mail\SendVerifyMail;
use App\Models\User;
use Illuminate\Support\Facades\Mail;


class MailController extends Controller
{
    public static function sendMail(User $user)
    {
        try {
            $toEmailAddress = $user->email;
            Mail::to($toEmailAddress)->send(new SendVerifyMail($user->username, $user->remember_token));
            return ['success' => 'Email sent successfully'];
        } catch (Exception $e) {
            return ['error' => $e->getMessage() ];
        }
    }

    public function verifyEmail($user)
    {
        $user = User::where('remember_token', $user)->first();
        
        if ($user) {
            if ($user->email_verified_at == null) {
                $user->email_verified_at = now();
                $user->save();
                return redirect('/login')->with('success', 'Email verified successfully');
            } else {
                return redirect('/login')->withErrors('Email already verified');
            }
        } else {
            return redirect('/login')->withErrors('Invalid token');
        }
    }

}
