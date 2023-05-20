<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;


class Selection extends Controller
{
    public function index()
    {
        return view('auth\selection');
    }
}
