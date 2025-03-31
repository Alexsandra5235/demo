<?php

namespace App\Http\Controllers;

use App\Models\Profile;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function profile($id) : object
    {
        $profile = Profile::all()->find($id);
        return view('profile')->with('profile', $profile);
    }

    public function register() : object{
        return view('register');
    }

    public function sign() : object
    {
        return view('sign');
    }
}
