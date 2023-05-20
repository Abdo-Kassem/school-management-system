<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Mail\ResetPassword as MailResetPassword;
use App\Models\ResetPassword;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Password;
use Illuminate\View\View;

class PasswordResetLinkController extends Controller
{
    /**
     * Display the password reset link request view.
     */
    public function create(): View
    {
        return view('auth.forgot-password');
    }

    /**
     * Handle an incoming password reset link request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request)
    {
        $request->validate([
            'email' => ['required', 'email'],
        ]);

        $admin = User::where('email',$request->email)->first();

        if($admin) {

            $token = rand(10000,90000);

            $resetPassword = ResetPassword::where('email',$request->email)->first();

            if( ! $resetPassword) {

                ResetPassword::insert([
                    'email' => $request->email,
                    'token' => $token
                ]);

            }else {
                $token = $resetPassword->token;
            }

            Mail::to($request->email)->send(new MailResetPassword($token));

            return view('auth.reset-password')->with('email',$request->email);
            
        }else {
            return redirect()->back()->with('fail','this email not found');
        }
      
    }

}
