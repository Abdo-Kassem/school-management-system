<?php

namespace App\Http\Controllers\Parent;

use App\Http\Controllers\Controller;
use App\Http\Requests\Parent\UpdateProfileValidation;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    public function index()
    {
        $parent = Auth::guard('parent')->user();
        return view('pages.parent.profile',compact('parent'));
    }

    public function update(UpdateProfileValidation $request) 
    {
        $parent = Auth::guard('parent')->user();

        $parent->update(
            ['email'=>$request->email,'password'=>Hash::make($request->password)]
        );

        return redirect()->route('logout');

    }
}
