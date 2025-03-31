<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Profile;
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
}
