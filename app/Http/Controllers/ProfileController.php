<?php

namespace App\Http\Controllers;

use App\Models\Avatar;
use App\Models\Product;
use App\Models\Profile;
use App\Models\Users;
use http\Env\Response;
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
            'avatar_path' => 'user/avatar-default.png',
            'profile_id'=> $user->id,
        ]);

        return redirect('/sign');
    }

    public function login(Request $request) : object{
        $validated = $request->validate([
            'email' => 'required',
            'password' => 'required',
        ]);

        $user = Profile::query()->where('email', $request->email)->first();

        if ($user && Hash::check($request->password, $user->password)) {
            Session::put('user', $user);
            return redirect('/');
        }

        return redirect('/sign')->withErrors(['email' => 'Invalid credentials.']);
    }

    public function logout() : object
    {
        Session::forget('user');
        return redirect('/');
    }

    public function edit(Request $request,$id) : object{
        $validated = $request->validate([
            'name' => 'required',
            'email' => 'required',
            'password' => 'required',
            'current_passwd' => 'required',
            'repeat_passwd' => 'required',
            'phone' => 'required',
        ]);

        $user = Profile::all()->find($id);

        if(Hash::check($request->current_passwd, $user->password)
            && $request->input("password") == $request->input('repeat_passwd')){

            $user->name = $request->input("name");
            $user->email = $request->input("email");
            $user->password = Hash::make($request->input("password"));
            $user->phone = $request->input("phone");
            $user->save();
        }

        return redirect('/profile/'.$id);

    }

    public function editAvatar(Request $request, $id) : object
    {
        $request->validate([
            'images' => 'required|max:2048',
        ]);

        $user = Profile::all()->find($id);

        // Загружаем файл
        $path = $request->file('images')->store('user', 'public');

        // Если у пользователя уже есть аватар, обновляем его, иначе создаем новый
        $user->avatar()->updateOrCreate(
            [],
            ['avatar_path' => $path]
        );

        return redirect()->back();


    }
    public function info($id) : object
    {
        return view('infoProfile')
            ->with('profile', Profile::all()->find($id));
    }

    public function showProducts($id) : object
    {
        $products = Product::query()->where('profile_id', $id)->get();
        $profile = Profile::query()->find($id);

        return view('products', ['products' => $products, 'profile' => $profile]);
    }
}
