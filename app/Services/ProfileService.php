<?php

namespace App\Services;

use App\Models\Profile;
use App\Rules\CurrentPassword;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;

class ProfileService
{
    public function validate($request) : array
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
    public function validateUpdate($request) : array
    {
        return $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'password' => 'required|min:3',
            'current_passwd' => ['required', new CurrentPassword],
            'repeat_passwd' => 'required|same:password',
            'phone' => 'required|integer',
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
