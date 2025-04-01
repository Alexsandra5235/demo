<?php

namespace App\Http\Controllers;

use App\Models\Avatar;
use App\Models\Product;
use App\Models\Profile;
use App\Services\AvatarService;
use App\Services\ProfileService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    protected ProfileService $profileService;

    protected AvatarService $avatarService;
    public function __construct(ProfileService $profileService, AvatarService $avatarService){
        $this->profileService = $profileService;
        $this->avatarService = $avatarService;
    }
    public function profile($id) : object
    {
        $profile = Profile::all()->find($id);
        return view('profile')
            ->with('profile', $profile)
            ->with('products', Product::query()->where('profile_id', $id)->get());
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

        $this->profileService->validate($request);

        $user = $this->profileService->create($request);

        Avatar::query()->create([
            'avatar_path' => 'avatar/avatar.png',
            'profile_id'=> $user->id,
        ]);

        return redirect('/sign');
    }

    public function login(Request $request) : object
    {
        $this->profileService->validateLogin($request);

        $user = Profile::query()->where('email', $request->email)->first();

        if ($user && Hash::check($request->password, $user->password)) {
            Session::put('user', $user);
            return redirect('/');
        }

        return redirect('/sign');
    }

    public function logout() : object
    {
        Session::forget('user');
        return redirect('/');
    }

    public function edit(Request $request,$id) : object{

        $this->profileService->validateUpdate($request);

        $user = Profile::all()->find($id);

        if(Hash::check($request->current_passwd, $user->password)
            && $request->input("password") == $request->input('repeat_passwd')){

            $this->profileService->update($request, $user);
        }

        return redirect('/profile/'.$id)->with('user', $user);

    }

    public function editAvatar(Request $request, $id) : object
    {
        $this->avatarService->validate($request);
        $user = Profile::all()->find($id);

        $path = $request->file('images')->store('user', 'public');

        $this->avatarService->update($user, $path);

        return redirect()->back()->with('user', $user);


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

    public function delete($id) : object
    {
        $profile = Profile::query()->find($id);

        $imagePath = $profile->avatar()->first()->avatar_path;

        $this->avatarService->delete($imagePath);

        $profile->delete();

        Session::forget('user');

        $products = Product::with('profile')->get();
        return redirect('/')
            ->with('products', $products)
            ->with('users', Profile::all());
    }
}
