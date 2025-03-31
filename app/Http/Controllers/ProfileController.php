<?php

namespace App\Http\Controllers;

use App\Models\Avatar;
use App\Models\Product;
use App\Models\Profile;
use App\Models\Users;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

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

    public function store(Request $request) : object
    {

        $validated = $request->validate([
            'name' => 'required',
            'email' => 'required',
            'password' => 'required',
            'phone' => 'required',
        ]);

        $avatars = [
            'https://mdbcdn.b-cdn.net/img/Photos/new-templates/bootstrap-chat/ava1-bg.webp',
            'https://mdbcdn.b-cdn.net/img/Photos/new-templates/bootstrap-chat/ava2-bg.webp',
            'https://mdbcdn.b-cdn.net/img/Photos/new-templates/bootstrap-chat/ava3-bg.webp',
            'https://mdbcdn.b-cdn.net/img/Photos/new-templates/bootstrap-chat/ava4-bg.webp',
            'https://mdbcdn.b-cdn.net/img/Photos/new-templates/bootstrap-chat/ava5-bg.webp',
            'https://mdbcdn.b-cdn.net/img/Photos/new-templates/bootstrap-chat/ava6-bg.webp',
        ];

        $randomAvatar = $avatars[array_rand($avatars)];

        $user = new Profile();
        $user->name = $request->input("name");
        $user->email = $request->input("email");
        $user->password = Hash::make($request->input("password"));
        $user->phone = $request->input("phone");
        $user->save();

        Avatar::query()->create([
            'avatar_path' => $randomAvatar,
            'profile_id'=> $user->id,
        ]);

        return redirect('/')
            ->with('products', Product::all())
            ->with('users', Profile::all());
    }

    public function login(Request $request) : object{
        $validated = $request->validate([
            'email' => 'required',
            'password' => 'required',
        ]);

        $user = Profile::where('email', $request->email)->first();

        if ($user && Hash::check($request->password, $user->password)) {
            Session::put('user', $user);
            return redirect('/'); // или страница, куда перенаправлять после входа
        }

        return back()->withErrors(['email' => 'Invalid credentials.']);
    }

    public function logout() : object
    {
        Session::forget('user');
        return redirect('/login');
    }
}
