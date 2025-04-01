<?php

namespace App\Services;

use App\Models\Profile;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;

class ProfileService
{
    public function validate($request) : Request
    {
        return $request->validate([
            'name' => 'required',
            'email' => 'required',
            'password' => 'required',
            'phone' => 'required',
        ]);
    }

    public function create($request) : Profile
    {
        return Profile::query()->create([
            'name' => $request->input("name"),
            'email' => $request->input("email"),
            'password' => Hash::make($request->input("password")),
            'phone' => $request->input("phone"),
        ]);
    }

    public function validateLogin($request) : array
    {
        return $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:3',
        ]);
    }
    public function validateUpdate($request) : Request
    {
        return $request->validate([
            'name' => 'required',
            'email' => 'required',
            'password' => 'required',
            'current_passwd' => 'required',
            'repeat_passwd' => 'required',
            'phone' => 'required',
        ]);
    }

    public function update(Request $request,Profile $user) : void
    {
        $user->name = $request->input("name");
        $user->email = $request->input("email");
        $user->password = Hash::make($request->input("password"));
        $user->phone = $request->input("phone");
        $user->save();
    }

}
