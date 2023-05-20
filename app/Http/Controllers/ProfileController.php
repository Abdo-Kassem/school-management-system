<?php

namespace App\Http\Controllers;

use App\Http\Requests\Admin\UpdateProfile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function index(): View
    {
        $admin = Auth::guard('web')->user();
        return view('pages.profile', compact('admin'));
    }

    public function update(UpdateProfile $request)
    {
        $admin = Auth::guard('web')->user();

        $admin->name = $request->name;
        $admin->email = $request->email;
        $admin->password = Hash::make($request->password);

        $admin->save();

        return redirect()->route('logout')->with('guard','web');
    }
   
}
