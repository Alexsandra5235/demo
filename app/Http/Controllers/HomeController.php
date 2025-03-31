<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Profile;
use App\Models\Users;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function home() : object
    {
        $products = Product::with('profile')->get();
        return view('home')
            ->with('products', $products)
            ->with('users', Profile::all());
    }

    public function search(Request $request) : object
    {
        $user = $request->input('user');
        $products = Product::all()->where('profile_id', $user);
        $users = Profile::all();
        return view('home',['products'=>$products, 'users'=>$users]);

    }
}
