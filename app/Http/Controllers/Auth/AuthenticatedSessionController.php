<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

class AuthenticatedSessionController extends Controller
{

    public function loginShow($type)
    {
        return view('auth.login',compact('type'));
    }

    /**
     * Handle an incoming authentication request.
     */
    public function login(LoginRequest $request)
    {
        $guardName = $request->guardName;
        $remember = isset($request->remember_me) ? true : false;

        if(Auth::guard($guardName)->attempt(['email'=>$request->email,'password'=>$request->password],$remember)) {
            return $this->redirectTo($guardName);
        }else {
            return redirect()->route('auth.selection');
        }

    }

    public function redirectTo($guardName)
    {
        if($guardName === 'student' ) {
            return redirect(RouteServiceProvider::STUDENT);
        }elseif($guardName === 'teacher' ) {
            return redirect(RouteServiceProvider::TEACHER);
        }elseif($guardName === 'parent') {
            return redirect(RouteServiceProvider::PARENT);
        }else {
            return redirect(RouteServiceProvider::HOME);
        }

    }

    

    /**
     * Destroy an authenticated session.
     */
    public function logout(Request $request)
    {
       
        Auth::guard($request->guard)->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect(route('auth.selection'));
    }
}
