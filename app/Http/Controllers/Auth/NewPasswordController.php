<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\ResetPassword;
use App\Models\User;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Illuminate\Validation\Concerns\FilterEmailValidation;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class NewPasswordController extends Controller
{
    /**
     * Display the password reset view.
     */

     public function create($email) 
     {
        return view('auth.reset-password')->with('email',$email);
     }


    public function checkToken(Request $request)
    {
        $user = User::where('email',$request->email)->first();

        if($user) {
            return ResetPassword::where('email',$request->email)->where('token',$request->token)->exists();
        }

        return 10;
        
    }

    /**
     * Handle an incoming new password request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request)
    {

        $validator = Validator::make($request->only(['email','password']),[
            'email' => ['required', 'email'],
            'password' => ['required','regex:/^[A-Za-z]+[1-9]{6,}[A-Za-z]+$/'],
        ]);

        $messages = $validator->errors()->messages();
        $email = $request->email;

        if($request->password !== $request->password_confirmation) {
            $messages['password'][] = 'password confirmation fail';
        }

   
        if($validator->fails() || (isset($messages['password']) && count($messages['password'])>0)) {
            return view('auth.reset-password',compact('messages','email'));
        }

        $admin = User::where('email',$request->email)->first();

        if($admin->update(['password',Hash::make($request->password)])) {
            Auth::guard('web')->login($admin);
            return redirect()->route('home');
        }else {
            return redirect()->route('auth.selection');
        }
    }

    public function validation(Request $request) 
    {
        
    }
}
